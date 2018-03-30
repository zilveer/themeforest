<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * YIT Faq
 *
 * Manage the Faq in the YIT Framework
 *
 * @class YIT_Faq
 * @package    Yithemes
 * @since      1.0.1
 * @author     Your Inspiration Themes
 */

class YIT_Faq {

    /**
     * @var string
     */
    public $version = YIT_FAQ_VERSION;

    /**
     * @var string
     */
    public $plugin_url;

    /**
     * @var string
     */
    public $plugin_path;

    /**
     * @var string
     */
    public $plugin_assets_url;

    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * @var string $faq_post_type The post type name for the post type of all faq
     */
    public $faq_post_type = 'faq';

    /**
     * @var string $category_faq_taxonomy the category of faq
     */
    public $category_faq_taxonomy = 'category-faq';


    /**
     * @var string $term_meta_table_name the name of faq_termmeta
     */
    public $term_meta_table_name = 'faq_termmeta';


    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function __construct() {

        global $wpdb;

        $wpdb->faq_termmeta = $wpdb->prefix . $this->term_meta_table_name;

        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/faq' );
	    $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/faq' );
	    $this->plugin_assets_url = $this->plugin_url. '/assets' ;
	    $this->plugin_assets_path = $this->plugin_path. '/assets' ;
	    $this->plugin_template_url = $this->plugin_url. '/templates' ;
	    $this->plugin_template_path = $this->plugin_path. '/templates' ;

	    // fix the base url and base path in case is the plugin
	    add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        // load the core plugins library from an yit-theme
        add_action( 'after_setup_theme', array( $this, 'add_shortcode_button' ) );

        // register taxonomy and post type
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'init', array( $this, 'register_taxonomy' ) );

        // enqueue scripts and styles
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        // add category thumbnail field
        add_action( $this->category_faq_taxonomy . '_add_form_fields', array( $this, 'add_category_thumbnail_field' ) );
        add_action( $this->category_faq_taxonomy . '_edit_form_fields', array( $this, 'edit_category_thumbnail_field' ), 10, 2 );

        // save category thumbnail field
        add_action( 'created_term', array( $this, 'category_thumbnail_field_save' ), 10, 3 );
        add_action( 'edit_term', array( $this, 'category_thumbnail_field_save' ), 10, 3 );

        // add the shortcode 'faq'
        add_shortcode( 'faq', array( $this, 'add_shortcode' ) );

        // add the widget 'filterable faq'
        add_action( 'widgets_init', array( $this, 'register_widget' ) );
    }

	/**
	 * Fix the base path and base url of plugin
	 *
	 * As soon as the plugin is instantiated, the base path and url are from the YIT theme, but this method is hook
	 * inside 'plugins_loaded', so if it is called, the base path and url must be from plugin
	 */
	public function set_path_and_url_by_plugin() {
        if ( file_exists( get_template_directory() . '/theme/plugins/yit-framework/' ) ) {
            return;
        }

		$this->plugin_url        = untrailingslashit( plugins_url( '/', __FILE__ ) );
		$this->plugin_path       = untrailingslashit( plugin_dir_path( __FILE__ ) );
		$this->plugin_assets_url = $this->plugin_url. '/assets' ;
	}


    /**
     * Load the core of the plugin, added to "after_theme_setup" so you can load the core only if it isn't loaded by plugin
     *
     * @return void
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function add_shortcode_button() {

        //add the shortcode button to shortcode panel
        add_filter( 'yit-shortcode-plugin-init', array( $this, 'add_shortcode_to_panel' ) );
        add_filter( 'yit_shortcode_faq_icon', array( $this, 'shortcode_icon' ), 10, 2 );
    }

    /**
     * Register post type
     *
     * Register the post type for the creation of faqs
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function register_post_type() {
        $labels = array(
            'name'               => __( 'Faq', 'yit' ),
            'singular_name'      => __( 'Faq', 'yit' ),
            'plural_name'        => __( 'Faqs', 'yit' ),
            'add_new'            => __( 'Add Faq', 'yit' ),
            'add_new_item'       => __( 'Add New Faq', 'yit' ),
            'edit_item'          => __( 'Edit Faq', 'yit' ),
            'new_item'           => __( 'New Faq', 'yit' ),
            'all_items'          => __( 'All Faqs', 'yit' ),
            'view_item'          => __( 'View Faq', 'yit' ),
            'search_items'       => __( 'Search Faqs', 'yit' ),
            'not_found'          => __( 'No Faqs found', 'yit' ),
            'not_found_in_trash' => __( 'No Faqs found in Trash', 'yit' ),
            'parent_item_colon'  => '',
            'menu_name'          => __( 'Faq', 'yit' )
        );

        $args = array(
            'labels'             => apply_filters( 'yit_faq_labels', $labels ),
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => false,
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'has_archive'        => true,
            'rewrite'            => array( 'slug' => apply_filters( 'yit_faqs_rewrite', 'faq' ) ),
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor' ),
            'menu_icon'          => 'dashicons-list-view'
        );

        register_post_type( $this->faq_post_type, apply_filters( 'yit_faq_args', $args ) );
    }


    /**
     * Register taxonomy for Faq categories
     *
     * Register the taxonomy for the creation of faq's category
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function register_taxonomy() {

        $labels = array(
            'name'          => __( 'Categories Faq', 'yit' ),
            'singular_name' => __( 'Category Faq', 'yit' ),
            'menu_name'     => __( 'Category Faq', 'yit' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => apply_filters( 'yit_taxonomy_faq_labels', $labels ),
            'show_ui'           => true,
            'query_var'         => true,
            'show_admin_column' => true
        );

        register_taxonomy( $this->category_faq_taxonomy, $this->faq_post_type, apply_filters( 'yit_faq_taxonomy_args', $args ) );

    }

    /**
     * Add the field for thumbnail upload
     *
     * Add a new field to upload a thumbnail to category faq
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function add_category_thumbnail_field() {
        ?>
        <div class="form-field">
            <label><?php _e( 'Thumbnail', 'yit' ); ?></label>

            <div id="faq_cat_thumbnail" style="float:left;margin-right:10px;" data-placeholder="<?php echo  $this->plugin_assets_url . "/images/placeholder.png"; ?>">
                <img src="<?php echo  $this->plugin_assets_url . "/images/placeholder.png"; ?>" width="60px" height="60px" />
            </div>
            <div style="line-height:60px;">
                <input type="hidden" id="faq_cat_thumbnail_id" name="faq_cat_thumbnail_id" value="" />
                <button type="submit" class="upload_image_button button"><?php _e( 'Upload/Add image', 'yit' ); ?></button>
                <button type="submit" class="remove_image_button button"><?php _e( 'Remove image', 'yit' ); ?></button>
            </div>

            <div class="clear"></div>
        </div>
    <?php
    }


    /**
     * Add the field for thumbnail upload
     *
     * Add a new field to upload a thumbnail to category faq
     *
     * @param $term
     * @param $taxonomy
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function edit_category_thumbnail_field( $term, $taxonomy ) {
        $image        = '';
        $thumbnail_id = get_metadata( 'faq_term', $term->term_id, 'thumbnail_id', true );
        if ( $thumbnail_id ) :
            $image = wp_get_attachment_url( $thumbnail_id );
        else :
            $image = $this->plugin_assets_url . "/images/placeholder.png";
        endif;

        ?>

        <tr class="form-field">
            <th scope="row" valign="top"><label><?php _e( 'Thumbnail', 'yit' ); ?></label></th>
            <td>
                <div id="faq_cat_thumbnail" style="float:left;margin-right:10px;" data-placeholder="<?php echo  $this->plugin_assets_url . "/images/placeholder.png"; ?>">
                    <img src="<?php echo $image; ?>" width="60px" height="60px" /></div>
                <div style="line-height:60px;">
                    <input type="hidden" id="faq_cat_thumbnail_id" name="faq_cat_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
                    <button type="submit" class="upload_image_button button"><?php _e( 'Upload/Add image', 'yit' ); ?></button>
                    <button type="submit" class="remove_image_button button"><?php _e( 'Remove image', 'yit' ); ?></button>
                </div>

                <div class="clear"></div>
            </td>
        </tr>
    <?php
    }


    /**
     * Save the thumbnail of category
     *
     * Save the thumbnail id as metadata for the category faq
     *
     * @param $term_id
     * @param $tt_id
     * @param $taxonomy
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    function category_thumbnail_field_save( $term_id, $tt_id, $taxonomy ) {

        if ( isset( $_POST['faq_cat_thumbnail_id'] ) ) {
            update_metadata( 'faq_term', $term_id, 'thumbnail_id', $_POST['faq_cat_thumbnail_id'], '' );
        }

    }


    /**
     * Enqueue script and styles in frontend side
     *
     * Add style and scripts to frontend
     *
     * @return void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function enqueue_scripts() {
        yit_enqueue_script( 'yit-faq-frontend', $this->plugin_assets_url . '/js/yit-faq-frontend.min.js', array( 'jquery' ), $this->version, true );
        yit_enqueue_style( 'yit-faq', $this->plugin_assets_url . '/css/yit-faq.css', $this->version );
    }

    /**
     * Enqueue script and styles in admin side
     *
     * Add style and scripts to administrator
     *
     * @return void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function admin_enqueue_scripts() {

        $screen = get_current_screen() ;

        if ( is_object( $screen ) && $screen->post_type == 'faq' ) {
            wp_enqueue_script( 'yit-faq-admin', $this->plugin_assets_url . '/js/yit-faq-admin.min.js', array( 'jquery' ), $this->version, true );
            wp_localize_script( 'yit-faq-admin', 'yit_faq_admin_l10n', array(
                'choose_image' => __( 'Choose an image', 'yit' ),
                'use_image'    => __( 'Use image', 'yit' ),
                'remove_image' => __( 'Remove image', 'yit' )
            ) );

            wp_enqueue_media();
        }

    }


    

    /**
     * Return an array with all faq categories
     *
     * All faq categories in an array, the first element of array is a general item
     * that is useful to show all categories
     *
     * @return array
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function get_faq_categories() {

        global $wpdb;

        $terms           = $wpdb->get_results( 'SELECT name, ' . $wpdb->prefix . 'terms.term_id FROM ' . $wpdb->prefix . 'terms, ' . $wpdb->prefix . 'term_taxonomy WHERE ' . $wpdb->prefix . 'terms.term_id = ' . $wpdb->prefix . 'term_taxonomy.term_id AND taxonomy = "' . $this->category_faq_taxonomy . '" ORDER BY name ASC;' );
        $categories      = array();
        $categories['0'] = __( 'All categories', 'yit' );
        if ( $terms ) :
            foreach ( $terms as $cat ) :
                $categories[$cat->term_id] = ( $cat->name ) ? $cat->name : 'ID: ' . $cat->term_id;
            endforeach;
        endif;

        return $categories;
    }

    public function add_shortcode( $atts, $content = "" ) {

        $shortcode = $this->shortcode_hook();

        $default_atts = array();

        if ( ! empty( $shortcode['faq']['attributes'] ) ) {
            foreach ( $shortcode['faq']['attributes'] as $name => $type ) {
                $default_atts[$name] = isset( $type['std'] ) ? $type['std'] : '';
                if( isset( $atts[$name] ) && $type['type'] == "checkbox"  ){
                    if ( $atts[$name] == 1 || $atts[$name] == 'yes' ){
                        $atts[$name] = 'yes';
                    }else{
                        $atts[$name] = 'no';
                    }

                }
            }
        }

        //combines with user attributes
        $atts = shortcode_atts( $default_atts, $atts );

        ob_start();

        yit_plugin_get_template( $this->plugin_path, 'shortcodes/faq.php', $atts );

        $shortcode_html = ob_get_clean();

        return apply_filters( 'yit_shortcode_faq', $shortcode_html );

    }

    /**
     * Return an array with faq options to shortcode panel
     *
     * All definition settings to add faq shortcode to Yit Shortcode Panel
     *
     * @return array
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function shortcode_hook() {

        return array(
            'faq' => array(
                'title'       => __( 'FAQ', 'yit' ),
                'description' => __( 'Show a Frequently Asked Questions', 'yit' ),
                'tab'         => 'cpt',
                'create'      => false,
                'has_content' => false,
                'in_visual_composer' => true,
                'attributes'  => array(
                    'filter'          => array(
                        'title' => __( 'Filterable', 'yit' ),
                        'type'  => 'checkbox',
                        'std'   => 'yes'
                    ),
                    'text_filterable' => array(
                        'title' => __( 'Text for filterable', 'yit' ),
                        'type'  => 'text',
                        'std'   => ''
                    ),
                    'category'        => array(
                        'title'   => __( 'Category', 'yit' ),
                        'type'    => 'checklist',
                        'options' => $this->get_faq_categories(),
                        'std'     => ''
                    ),
                )
            )
        );
    }

    /**
     * Return an array with faq options to shortcode panel
     *
     * All definition settings to add faq shortcode to Yit Shortcode Panel
     *
     * @param $shortcodes
     *
     * @return array
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function add_shortcode_to_panel( $shortcodes ) {
        return array_merge( $shortcodes, $this->shortcode_hook() );
    }

    /**
     * Return the url of the image for YIT_Shortcodes Plugin
     *
     * Add an image to shortcode panel for add the shortcode faq
     *
     * @return string
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function shortcode_icon() {
        return $this->plugin_assets_url . '/images/faq-shortcode-panel.png';
    }

    /**
     * Register the widget Faq_Filterable
     *
     * All definition settings to add faq shortcode to Yit Shortcode Panel
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function register_widget() {

        include( $this->plugin_path . '/yit-faq.widget.php' );

        register_widget( 'YIT_Faq_Filters' );
    }


}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Faq() {
    return YIT_Faq::instance();
}

/**
 * Instantiate Faq class
 *
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
YIT_Faq();
