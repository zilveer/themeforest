<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * @package Yithemes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * YIT_Newsletter exists
 */
define('YIT_NEWSLETTER', true);

require_once( untrailingslashit( plugin_dir_path( __FILE__ ) ).'/yit-newsletter.widget.php' );

/**
 * Perform Newsletter init
 *
 * @class YIT_Newsletter
 * @package Yithemes
 * @since Version 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Newsletter{
    /**
     * @var string Version
     */
    public $version = YIT_NEWSLETTER_VERSION;

    /**
     * @var string $newsletter_post_type The post type name for the post type of all newsletter forms
     */
    public $newsletter_post_type = 'newsletter';

    /**
     * @var string Plugin url
     */
    public $plugin_url;

    /**
     * @var string Plugin path
     */
    public $plugin_path;

    /**
     * @var string plugin assets url
     */
    public $plugin_assets_url;

    /**
     * @var string plugin assets path
     */
    public $plugin_assets_path;

    /**
     * @var string plugin template url
     */
    public $plugin_template_url;

    /**
     * @var string plugin template path
     */
    public $plugin_template_path;

    /**
     * @var string $plugin_options The name for the newsletter options db entry
     */
    public $plugin_options = 'yit_newsletter_options';

    /**
     * @var string $never_show_cookie_name The name of the cookie never_show_again for newsletter popup preferences
     */
    public $never_show_again_cookie_name = '';

    /**
     * @var string $show_next_time_cookie_name The name of the cookie show_next_time for newsletter popup preferences
     */
    public $show_next_time_cookie_name = '';

    /**
     * @var object The instance of the panel
     * @since 1.0
     */
    protected $_panel = null;


    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since 1.0
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
     * Constructor method of the class.
     *
     * @since Version 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function __construct() {
        // define local attributes
        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/newsletter' );
	    $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/newsletter' );
	    $this->plugin_assets_url = $this->plugin_url. '/assets' ;
	    $this->plugin_assets_path = $this->plugin_path. '/assets' ;
	    $this->plugin_template_url = $this->plugin_url. '/templates' ;
	    $this->plugin_template_path = $this->plugin_path. '/templates' ;

	    // fix the base url and base path in case is the plugin
	    add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        // load the core plugins library from an yith-theme
        add_action( 'after_setup_theme', array( $this, 'add_plugin_panel' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts_for_panel' ), 5 );

        // register post type
        add_action( 'init', array( $this, 'register_post_type' ) );

        //register metabox
        add_action( 'admin_init', array( $this, 'add_metabox' ), 1 );

        // register custom columns for cpt
        add_filter( 'manage_edit-' . $this->newsletter_post_type . '_columns', array( $this, 'custom_columns' ) );
        add_action( 'manage_' . $this->newsletter_post_type . '_posts_custom_column', array( $this, 'edit_columns_newsletter' ), 10, 2 );

        // enqueue scripts and styles
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	    add_filter( 'woocommerce_screen_ids', array( $this, 'register_woocommerce_admin' ) );

        // add the shortcode for the newsletter
        foreach( $this->newsletter_shortcode_list() as $shortcode => $atts ){
            add_shortcode( $shortcode, array( &$this, 'shortcode_callback' ) );
            add_filter('yit_shortcode_'.$shortcode.'_icon', array( $this, 'shortcode_icon'), 10, 2);
        }
        add_filter( 'yit-shortcode-plugin-init', array( $this, 'add_shortcode' ) );


        // add newsletter form widget
        add_action( 'widgets_init', array( $this, 'register_widget' ) );

        add_filter( 'yit-admin-shortcodes', array( $this, 'yit_newsletter_form_icon' ) );

        //newsletter popup settings
        add_action( 'template_redirect', array( $this, 'init_newsletter_popup_frontend' ) );

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
		$this->plugin_assets_path = $this->plugin_path. '/assets' ;
		$this->plugin_template_url = $this->plugin_url. '/templates' ;
		$this->plugin_template_path = $this->plugin_path. '/templates' ;
	}

    /**
     * Load the core of the plugin, added to "after_theme_setup" so you can load the core only if it isn't loaded by plugin
     *
     * @return void
     * @since 1.0.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function add_plugin_panel() {
        $this->popup_newsletter_panel();
    }

    /**
     * Let plugin-fw load panel scripts on newsletter panel page
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */
    public function register_scripts_for_panel() {
        global $pagenow;

        if( 'edit.php' == $pagenow && get_current_screen()->id == 'newsletter_page_newsletter-settings-page' ){
            add_filter( 'yit_plugin_panel_asset_loading', '__return_true' );
        }
    }

    /**
     * Add options to shortcode newsletter_form and newsletter_cta
     *
     * @param $shortcodes
     *
     * @return array
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    public function yit_newsletter_form_icon( $shortcodes ){

        $icons = YIT_Plugin_Common::get_awesome_icons();

        $shortcodes['newsletter_form']['attributes']['icon_form']['options'] = $icons;
        $shortcodes['newsletter_cta']['attributes']['icon_form']['options'] = $icons;

        return $shortcodes;
    }

    /**
     * Register post type
     *
     * Constructor add this to register_post_type hook, to register a new custom post type
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function register_post_type() {
        // define labels for i18n
        $labels = array(
            'name' => __( 'Newsletter Form', 'yit' ),
            'singular_name' => __( 'Newsletter Form', 'yit' ),
            'plural_name' => __( 'Newsletter Forms', 'yit' ),
            'item_name_sing' => __( 'Form', 'yit' ),
            'item_name_plur' => __( 'Forms', 'yit' ),
            'add_new' => __( 'Add New Form', 'yit' ),
            'add_new_item' => __( 'Add New Form', 'yit' ),
            'edit' => __( 'Edit', 'yit' ),
            'edit_item' => __( 'Edit Forms', 'yit' ),
            'new_item' => __( 'New Form', 'yit' ),
            'view' => __( 'View Form', 'yit' ),
            'view_item' => __( 'View Form', 'yit' ),
            'search_items' => __( 'Search Form', 'yit' ),
            'not_found' => __( 'No Forms', 'yit' ),
            'not_found_in_trash' => __( 'No forms in the Trash', 'yit' ),
        );

        $args = array(
            'labels'           => $labels,
            'public'           => false,
            'public_queryable' => false,
            'show_ui'          => true,
            'show_in_menu'     => true,
            'query_var'        => false,
            'capability_type'  => 'post',
            'hierarchical'     => false,
            'has_archive'      => 'logo',
            'rewrite'          => array( 'slug' => apply_filters( 'yit_newsletter_forms_rewrite', 'logo' ) ),
            'menu_position'    => null,
            'supports'         => array( 'title' ),
            'description'      => "Newsletter Forms",
            'menu_icon'        => 'dashicons-email-alt'

        );

        register_post_type( $this->newsletter_post_type, apply_filters( 'yit_newsletter_forms_args', $args ) );

    }

    /**
     * Declare custom columns for newsletter custom post type
     *
     * @param $columns array Column array
     *
     * @return array
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function custom_columns( $columns ) {
        unset( $columns['date'] );

        $columns['shortcode'] = __( 'Shortcode', 'yit' );

        return $columns;
    }

    /**
     * Set the content for custom columns of custom post type declared before
     *
     * @param $column
     * @param $post_id int Actual post id
     *
     * @internal param string $colum Column name
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function edit_columns_newsletter( $column, $post_id ) {
        $post = get_post( $post_id );
        if( ! empty ( $post ) )
            switch ( $column ) {
                case 'shortcode' :
                    echo '[newsletter_form post_name="' . $post->post_name . '"]';
                    break;

            }
    }

    /**
     * Add metabox to newsletter custom post
     *
     * Add metabox to the custom post
     *
     * @return void
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_metabox() {
        // register integration type
        if( is_dir( $this->plugin_path.'/integration-type/') && ( $dir_handle = opendir( $this->plugin_path.'/integration-type/' ) ) ){
            while ( ( $file = readdir($dir_handle) ) !== false) {
                if( ! is_dir( $file ) && ! in_array( $file, array( '.', '..', '.svn' ) ) ){
                    include_once( $this->plugin_path.'/integration-type/'.$file );

                    $class_name = "YIT_Newsletter_".basename( $file, ".php" );
                    new $class_name( );
                }
            }

            closedir($dir_handle);
        }

        $integration_types = array(
            'custom' => __( 'Custom Form', 'yit' )
        );

        // let custom integration to appear in integration type select field
        $integration_types = apply_filters('yit-newsletter-integration-type', $integration_types );

        $args = array(
            'label'    => __( 'Form specification', 'yit' ),
            'pages'    => $this->newsletter_post_type,
            'context'  => 'normal',
            'priority' => 'default',
            'tabs'     => array(
                'settings' => array(
                    'label'  => __( 'Form specification', 'yit' ),
                    'fields' => array(
                        'integration' => array(
                            'label' => __( 'Form integration preset', 'yit' ),
                            'desc'  => __( 'Select what kind of newsletter service you want to use, or set a custom form.', 'yit' ),
                            'type'  => 'select',
                            'options' => $integration_types,
                            'std'   => 'mailchimp'
                        ),
                        'action' => array(
                            'label' => __( 'Form action', 'yit' ),
                            'desc' => __( 'The attribute "action" of the form.', 'yit' ),
                            'type' => 'text',
                            'std' => '',
                            'deps'     => array(
                                'ids' => '_integration',
                                'values' => 'custom'
                            )
                        ),
                        'method' => array(
                            'label' => __( 'Request Method', 'yit' ),
                            'desc' => __( 'The attribute "method" of the form.', 'yit' ),
                            'type' => 'select',
                            'options' => array(
                                'post' => __( 'POST', 'yit' ),
                                'get' => __( 'GET', 'yit' )
                            ),
                            'std' => 'post',
                            'deps'     => array(
                                'ids' => '_integration',
                                'values' => 'custom'
                            )
                        ),
                        'email-label' => array(
                            'label' => __( 'Email field label', 'yit' ),
                            'desc' => __( 'The label for "email" field', 'yit' ),
                            'type' => 'text',
                            'std' => 'Email',
                            'deps'     => array(
                                'ids' => '_integration',
                                'values' => 'custom'
                            )
                        ),
                        'email-name' => array(
                            'label' => __( 'Email field "name" attribute', 'yit' ),
                            'desc' => __( 'The attribute "name" of the email address field.', 'yit' ),
                            'type' => 'text',
                            'std' => '',
                            'deps'     => array(
                                'ids' => '_integration',
                                'values' => 'custom'
                            )
                        ),
                        'submit-label' => array(
                            'label' => __( 'Submit button label', 'yit' ),
                            'desc' => __( 'This field is not always used. Depends on the style of the form.', 'yit' ),
                            'type' => 'text',
                            'std' => 'Add Me',
                            'deps'     => array(
                                'ids' => '_integration',
                                'values' => 'custom'
                            )
                        ),
                        'hidden-fields' => array(
                            'label' => __( 'Hidden fields', 'yit' ),
                            'desc' => __( 'Type here all hidden fields names and values in serializate way. Example: name1=value1&name2=value2.', 'yit' ),
                            'type' => 'text',
                            'std' => '',
                            'deps'     => array(
                                'ids' => '_integration',
                                'values' => 'custom'
                            )
                        ),
                    )
                )
            )
        );

        // let custom integration type to register their metabox
        $args['tabs']['settings']['fields'] = apply_filters( 'yit-newsletter-metabox', $args['tabs']['settings']['fields'] );

        $metabox = new YIT_Metabox( 'yit-newsletter-form-info' );
        $metabox->init( $args );
    }

    /**
     * Get meta from Metabox Panel
     *
     * return the meta from database
     *
     * @param $meta
     * @param $post_id
     *
     * @return mixed
     * @since    1.0
     * @author   Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function get_meta( $meta, $post_id ) {
        $meta_value = get_post_meta( $post_id, $meta, true );

        if ( isset( $meta_value ) ) {
            return $meta_value;
        }
        else {
            return '';
        }
    }

    /**
     * Add shortcode
     *
     * Register newsletter shortcode on yit_shortcode plugin
     *
     * @param $shortcodes_array array() Array of shortcodes
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_shortcode( $shortcodes_array ) {
        return array_merge( $shortcodes_array, $this->newsletter_shortcode_list() );
    }

    /**
     * Shortcode list for newsletter
     *
     * Return newsletter list for logos
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function newsletter_shortcode_list() {
        $posts = get_posts( array(
            'posts_per_page' => -1,
            'post_type' => $this->newsletter_post_type
        ) );


        $options = array();
        foreach( $posts as $post ){
            $options[ $post->post_name ] = ( strcmp( $post->post_title, '' ) != 0 ) ? $post->post_title : $post->ID ;
        }

        $awesome_icons = YIT_Plugin_Common::get_awesome_icons();

        return apply_filters('yit_newsletter_shortcode_options', array(
            /* === NEWSLETTER FORM ===*/
            'newsletter_form' => array(
                'title' => __('Newsletter Form', 'yit' ),
                'description' =>  __('Show a newsletter form<br/> (If you leave empty a field, it will use the default value setted in YIT Plugins -> Newsletter)', 'yit' ),
                'tab' => 'shortcodes',
                'create' => false,
                'in_visual_composer' => true,
                'has_content' => false,
                'attributes' => array(
                    'title' => array(
                        'title' => __('Title', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'title_size' => array(
                        'title' => __('Title size', 'yit'),
                        'type' => 'number',
                        'min' => 10,
                        'max' => 99,
                        'std' => 32
                    ),
                    'title_color' => array(
                        'title' => __('Title color', 'yit'),
                        'type' => 'colorpicker',
                        'std' => '#000000'
                    ),
                    'description' => array(
                        'title' => __('Description', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'description_size' => array(
                        'title' => __('Description size', 'yit'),
                        'type' => 'number',
                        'min' => 10,
                        'max' => 99,
                        'std' => 24
                    ),
                    'description_color' => array(
                        'title' => __('Description color', 'yit'),
                        'type' => 'colorpicker',
                        'std' => '#555555'
                    ),
                    'post_name' => array(
                        'title' => __('Newsletter Form', 'yit'),
                        'type' => 'select',
                        'options' => $options,
                        'std'  => ''
                    ),
                    'icon_form' => array(
                        'title' => __( 'Newsletter Form Icon', 'yit' ),
                        'type' => 'select',
                        'options' => $awesome_icons,
                        'std' => ''
                    ),
                    'button_class' => array(
                        'title' => __( 'Form Button Class', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    )
                )
            ),
            /* === CALL TO ACTION NEWSLETTER === */
            'newsletter_cta' => array(
                'title' => __('Call to action newsletter', 'yit' ),
                'description' =>  __('Show a message with newsletter subscription', 'yit' ),
                'tab' => 'shortcodes',
                'create' => false,
                'in_visual_composer' => true,
                'has_content' => false,
                'attributes' => array(
                    'title' => array(
                        'title' => __('Title', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'title_size' => array(
                        'title' => __('Title size', 'yit'),
                        'type' => 'number',
                        'min' => 10,
                        'max' => 99,
                        'std' => 32
                    ),
                    'title_color' => array(
                        'title' => __('Title color', 'yit'),
                        'type' => 'colorpicker',
                        'std' => '#000000'
                    ),
                    'incipit' => array(
                        'title' => __('Incipit', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'incipit_size' => array(
                        'title' => __('Incipit size', 'yit'),
                        'type' => 'number',
                        'min' => 10,
                        'max' => 99,
                        'std' => 24
                    ),
                    'incipit_color' => array(
                        'title' => __('Incipit color', 'yit'),
                        'type' => 'colorpicker',
                        'std' => '#555555'
                    ),
                    'post_name' => array(
                        'title' => __('Newsletter Form', 'yit'),
                        'type' => 'select',
                        'options' => $options,
                        'std'  => ''
                    ),
                    'icon_form' => array(
                        'title' => __( 'Newsletter Form Icon', 'yit' ),
                        'type' => 'select',
                        'options' => $awesome_icons,
                        'std' => ''
                    ),
                    'button_class' => array(
                        'title' => __( 'Form Button Class', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    )
                )
            ),
        ), $options);
    }

    /**
     * Shortcode icon
     *
     * Return the shortcode icone to display on shortcode panel
     *
     * @param $icon_url string Icone url found by yit_shortcode plugin
     * @param $shortcode string Tag shortcode
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function shortcode_icon( $icon_url, $shortcode ) {
        return $this->plugin_assets_url.'/images/'.$shortcode.'.png';
    }

    /**
     * Shortcode Callback
     *
     * Callback for logos shortcode; load the correct template whit variables inserted and return the html markup
     *
     * @param $atts array() Attributes array for shortcode
     * @param $content string Shortcode content
     * @param $shortcode string Shortcode Tag
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function shortcode_callback( $atts, $content = null, $shortcode ) {
        $shortcode_logo = $this->newsletter_shortcode_list();
        $all_atts = $atts;
        $all_atts['content'] = $content;

        if( isset( $shortcode_logo[ $shortcode ]['unlimited'] ) && $shortcode_logo[ $shortcode ]['unlimited'] ) {
            $atts['content'] = $content;
        } else {
            //retrieves default atts
            $default_atts = array();

            if( ! empty( $shortcode_logo[ $shortcode ]['attributes'] ) ) {
                foreach( $shortcode_logo[ $shortcode ]['attributes'] as $name=>$type ) {
                    $default_atts[ $name ] = isset( $type['std'] ) ? $type['std'] : '';
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
            $atts['content'] = $content;
        }

        // remove validate attrs
        foreach ( $atts as $att => $v ) {
            unset( $all_atts[ $att ] );
        }

        ob_start();

        yit_plugin_get_template( $this->plugin_path, 'shortcodes/'.$shortcode.'.php', $atts );

        $shortcode_html = ob_get_clean();

        return apply_filters( 'yit_shortcode_' . $shortcode, $shortcode_html, $shortcode );
    }

    /**
     * Enqueue admin script
     *
     * Enqueue backend scripts; constructor add it to admin_enqueue_scripts hook
     *
     * @param $hook
     *
     * @return void
     * @since  1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function admin_enqueue_scripts( $hook ){

    }

	/**
	 * Register plugin admin screen as woocommerce page
	 *
	 * @param $screens array Array of registered views
	 *
	 * @return array Filtered admin views
	 * @since 1.0.0
	 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
	 */
	public function register_woocommerce_admin( $screens ) {
		$screens[] = 'newsletter_page_newsletter-settings-page';

		return $screens;
	}

    /**
     * Enqueue script
     *
     * Enqueue frontend scripts; constructor add it to wp_enqueue_scripts hook
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function enqueue_scripts() {

    }

    /**
     * Register the widget Newsletter Form
     *
     * Register the newsletter form widget, using the YIT_Newsletter_Corm class
     *
     * @return void
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function register_widget(){
        register_widget( 'YIT_Newsletter_Form' );
    }

    /**
     * Add a panel under Newsletter Custom Post Type
     *
     * add a setting page for Newsletter Plugin
     *
     *
     * @return void
     * @since    1.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function popup_newsletter_panel() {

        if ( ! empty( $this->_panel ) ) {
            return;
        }
        $admin_tabs = array(
            'general' => __( 'General', 'yit' )
        );

        if ( function_exists( "WC" ) ){
            $admin_tabs['woocommerce'] =  __( 'Woocommerce', 'yit' );
        }

        $args = array(
            'parent'       => $this->newsletter_post_type,
            'parent_page'  => 'post_type=' . $this->newsletter_post_type,
            'page'         => 'newsletter-settings-page',
            'admin-tabs'   => $admin_tabs,
            'options-path' => $this->plugin_path . '/plugin-options',
            'plugin-url'   => $this->plugin_url
        );

        $this->_panel = new YIT_Plugin_Panel( $args );

    }

    /**
     * Get option from Plugin Panel
     *
     * return the option from database
     *
     * @param $option
     *
     * @return mixed
     * @since    1.0
     * @author   Antonio La Rocca <antonio.larocca@yithems.it>
     */
    public function get_option( $option ) {

        $options = get_option( $this->plugin_options );

        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }
        else {
            return '';
        }
    }

    /**
     * Returns a list of newsletter form posts
     *
     * @return mixed[]
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithems.it>
     */
    public function get_newsletter_post(){
        $posts = get_posts(array(
            'post_type' => $this->newsletter_post_type
        ));

        if( ! empty( $posts) ){
            $array = array();

            foreach( $posts as $post ){
                $array[ $post->post_name ] = $post->post_title;
            }

            natcasesort( $array );
            //asort($array, SORT_STRING | SORT_FLAG_CASE); //only with php 5.4
            return $array;
        }
        else{
            return array();
        }
    }

    /**
     * Returns a list of woocommerce products
     *
     * @return mixed[]
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithems.it>
     */
    public function get_WC_product(){
        if( function_exists( 'WC' ) ){
            $products = get_posts( array(
                'post_type' => 'product',
                'posts_per_page' => -1
            ) );
            if( ! empty( $products ) ){
                $array = array();

                foreach( $products as $product ){
                    $array[ $product->post_name ] = $product->post_title;
                }

                natcasesort( $array );
                //asort($array, SORT_STRING | SORT_FLAG_CASE); //only with php 5.4
                return $array;
            }
            else{
                return array();
            }
        }
    }

    /**
     * Return a list of blog pages
     *
     * @return mixed[]
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithems.it>
    */
    public function get_available_pages(){
        $pages = get_pages();

        if( ! empty( $pages ) ){
            $array = array();

            foreach( $pages as $page ){
                $array[ $page->ID ] = $page->post_title;
            }

            natcasesort( $array );
            //asort( $array, SORT_STRING | SORT_FLAG_CASE ); //only with php 5.4
            return $array;
        }
        else{
            return array();
        }
    }

    /**
    */
    public function init_newsletter_popup_frontend(){
        global $wp_query;
        $this->never_show_again_cookie_name = "yit-newsletter-popup-" . basename( get_template_directory() ) . "-hide-popup-forever-" . $this->get_option( 'newsletter_popup_cookie_var' );
        $this->show_next_time_cookie_name = "yit-newsletter-popup-" . basename( get_template_directory() ) . "-hide-popup-" . $this->get_option( 'newsletter_popup_cookie_var' );

        $post = $wp_query->get_queried_object();

        if ( function_exists( 'WC' ) && ( is_shop() || is_product_category() || is_product_tag() ) ) {
            $post_id = woocommerce_get_page_id( 'shop' );
        }
        elseif ( isset( $post->ID ) ) {
            $post_id = $post->ID;
        } else {
            $post_id = 0;
        }

        if(
            $this->get_option( 'newsletter_popup_enable' ) == 'yes' &&
            ! isset( $_COOKIE[ $this->never_show_again_cookie_name ] ) &&
            (
                $this->get_option( 'newsletter_hide_policy' ) == 'always' ||
                ! isset( $_COOKIE[ $this->show_next_time_cookie_name ] )
            )
            &&
            (
                $this->get_option( 'newsletter_enabled_everywhere' ) == 'yes' ||
                (
                    is_array( $this->get_option( 'newsletter_popup_pages' ) ) &&
                    in_array( $post_id, $this->get_option( 'newsletter_popup_pages' ) )
                )
            )
        ){
            add_action( 'wp_head', array( $this, 'add_popup_style_to_head'));
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_popup_scripts' ) );
            add_action( 'wp_footer', array( $this, 'print_popup_template' ), 19 );
        }

    }

    /**
     * Adds google fonts to frontend for popup window
     *
     * @return void
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_google_fonts(){

    }

    /**
     * Adds popup stylesheet in frontend
     */
    public function enqueue_popup_scripts(){

        $this->add_google_fonts();

        $stylesheet_url = $this->get_popup_stylesheet_url();

        if( $stylesheet_url !== false ){
            wp_enqueue_style( 'yit-newsletter-popup', $stylesheet_url );
        }
        wp_enqueue_script( 'jquery-cookie', $this->plugin_assets_url . '/js/jquery.cookie.js', array( 'jquery' ) );
        wp_enqueue_script( 'jquery-yit-popup', $this->plugin_assets_url . '/js/jquery.yitpopup.min.js', array( 'jquery', 'jquery-cookie' ) );
        wp_enqueue_script( 'yit-newsletter-popup', $this->plugin_assets_url . '/js/newsletter-popup.min.js', array( 'jquery', 'jquery-cookie', 'jquery-yit-popup' ) );
        wp_localize_script( 'yit-newsletter-popup', 'yit_newsletter_popup_var', array( 'never_show_again_cookie_name' => $this->never_show_again_cookie_name, 'show_next_time_cookie_name' => $this->show_next_time_cookie_name ) );
    }

    /**
     * Print custom css in head
     *
     * @return void
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_popup_style_to_head(){
        $custom_style = $this->get_option( 'newsletter_custom_style' );
        if( $custom_style != '' ):
            ?>
            <style type="text/css" >
                <?php echo $custom_style ?>
            </style>
        <?php
        endif;
    }

    /**
     * Prints popup template before body ends
     *
     * @return void
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function print_popup_template(){
        $path = $this->get_popup_template_path();

        if( $path !== false ){
            include( $this->get_popup_template_path() );
        }
    }

    /**
     * Returns the url of the stylesheet for popup
     *
     * @return string
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    private function get_popup_stylesheet_url(){
        $plugin_path = array( 'url' => $this->plugin_assets_url . "/css/popup.css", 'path' => $this->plugin_assets_path . "/css/popup.css" );
        $template_path = array( 'url' => ( ( defined( 'YIT' ) ) ? YIT_THEME_ASSETS_URL . '/css/popup' : get_template_directory_uri() ) . "/popup.css", 'path' => ( ( defined( 'YIT' ) ) ? YIT_THEME_ASSETS_PATH . '/css/popup' : get_template_directory() ) . "/popup.css" );
        $child_path = array( 'url' => ( ( defined( 'YIT' ) ) ? str_replace( get_template_directory_uri(), get_stylesheet_directory_uri(), YIT_THEME_ASSETS_URL ) . '/css/popup' : get_stylesheet_directory_uri() ) . "/popup.css", 'path' => ( ( defined( 'YIT' ) ) ? str_replace( get_template_directory(), get_stylesheet_directory(), YIT_THEME_ASSETS_PATH ) . '/css/popup' : get_stylesheet_directory() ) . "/popup.css" );

        foreach( array( 'child_path', 'template_path', 'plugin_path' ) as $var ){
            if( file_exists( ${$var}['path'] ) ){
                return ${$var}['url'];
            }
        }

        return false;
    }

    /**
     * Returns the url of the template for popup
     *
     * @return string
     * @since 1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    private function get_popup_template_path(){
        $plugin_url = $this->plugin_template_path . "/popup/popup_template.php";
        $template_url = ( ( defined( 'YIT' ) ) ? YIT_THEME_TEMPLATES_PATH : get_template_directory() ) . "/popup/popup_template.php";
        $child_url = ( ( defined( 'YIT' ) ) ? str_replace( get_template_directory(), get_stylesheet_directory(), YIT_THEME_TEMPLATES_PATH ) : get_stylesheet_directory() ) . "/popup/popup_template.php";

        foreach( array( 'child_url', 'template_url', 'plugin_url' ) as $var ){
            if( file_exists( ${$var} ) ){
                return ${$var};
            }
        }

        return false;
    }
}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Newsletter() {
    return YIT_Newsletter::instance();
}

/**
 * Create a new YIT_NEWSLETTER object
 */
YIT_Newsletter();