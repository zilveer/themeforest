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
 * YIT_Logos exists
 */
define('YIT_LOGOS', true);

/**
 * Perform logos init
 *
 * @class YIT_Logos
 * @package Yithemes
 * @since Version 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Logos{

    /**
     * @var string Version
     */
    public $version = YIT_LOGOS_VERSION;

    /**
     * @var string $logo_post_type The post type name for the post type of all logos
     */
    public $logo_post_type = 'logo';

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
     * Constructor method of the class. Add init method to the init action
     *
     * @since Version 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function __construct() {
        // define local attributes
        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/logos' );
	    $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/logos' );
	    $this->plugin_assets_url = $this->plugin_url. '/assets' ;
	    $this->plugin_assets_path = $this->plugin_path. '/assets' ;
	    $this->plugin_template_url = $this->plugin_url. '/templates' ;
	    $this->plugin_template_path = $this->plugin_path. '/templates' ;

	    // fix the base url and base path in case is the plugin
	    add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        // register post type
        add_action( 'init', array( $this, 'register_post_type' ) );

        //register metabox
        add_action( 'init', array( $this, 'add_metabox' ), 1 );

        // register custom column
        add_action( 'manage_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-'.$this->logo_post_type.'_columns', array( &$this, 'edit_columns_logo' ) );

        // enqueue scripts and styles
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        // add the shortcode for the logos
        foreach( $this->logo_shortcode_list() as $shortcode => $atts ){
            add_shortcode( $shortcode, array( &$this, 'shortcode_callback' ) );
            add_filter('yit_shortcode_'.$shortcode.'_icon', array( &$this, 'shortcode_icon'), 10, 2);
        }
        add_filter( 'yit-shortcode-plugin-init', array( &$this, 'add_shortcode' ) );

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
            'name' => __( 'Logos', 'yit' ),
            'singular_name' => __( 'Logo', 'yit' ),
            'plural_name' => __( 'Logos', 'yit' ),
            'item_name_sing' => __( 'Logo', 'yit' ),
            'item_name_plur' => __( 'Logos', 'yit' ),
            'add_new' => __( 'Add New Logo', 'yit' ),
            'add_new_item' => __( 'Add New Logo', 'yit' ),
            'all_items' => __( 'All Logos', 'yit' ),
            'edit' => __( 'Edit', 'yit' ),
            'edit_item' => __( 'Edit Logos', 'yit' ),
            'new_item' => __( 'New Logo', 'yit' ),
            'view' => __( 'View Logo', 'yit' ),
            'view_item' => __( 'View Logo', 'yit' ),
            'search_items' => __( 'Search Logos', 'yit' ),
            'not_found' => __( 'No logos', 'yit' ),
            'not_found_in_trash' => __( 'No logos in the Trash', 'yit' ),
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
            'rewrite'          => array( 'slug' => apply_filters( 'yit_logos_rewrite', 'logo' ) ),
            'menu_position'    => null,
            'supports'         => array( 'title', 'thumbnail' ),
            'description'      => "Logos",
            'menu_icon'        => 'dashicons-vault'

        );

        register_post_type( $this->logo_post_type, apply_filters( 'yit_logs_args', $args ) );

    }


    /**
     * Print metabox link
     *
     * Callback to print link metabox markup
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function print_link_metabox() {
        global $post;
        ?>
            <div class="metaboxes-tab">
                <?php wp_nonce_field( 'yit-logo-site-nonce', 'logo-site-nonce' ); ?>
                <div class="tabs-panel" style="display: block;">
                    <div class="the-metabox text clearfix">
                        <label for="logo_site"><?php _e('Link', 'yit'); ?></label>
                        <p>
                            <input type="text" id="logo_site" name="logo_site" value="<?php echo get_post_meta( $post->ID, 'logo_site', true); ?>"/>
                            <span class="inline-desc"><?php _e('Insert the link for Logo', 'yit') ?></span>
                        </p>
                    </div>
                </div>
            </div>
        <?php
    }



    /**
     * Customize link column
     *
     * Customize the columns in the table of all post types
     *
     * @param $column Column name
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function custom_columns( $column ) {
        global $post;

        switch ( $column ) {
            case "image-logos":
                if ( has_post_thumbnail() ) echo get_the_post_thumbnail( null, 'thumb' );
                break;

            case 'logo_site':
                $link = yit_get_post_meta( get_the_ID(), '_logo_site' );
                if ($link != ''):
                    echo '<a href="' . esc_url($link) . '">' . $link . '</a>';
                endif;
                break;
        }

    }



    /**
     * Add columns to Logo admin
     *
     * Edit the columns in the table of logo post types
     *
     * @param $columns array() Columns array
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function edit_columns_logo( $columns ) {
        $columns['image-logos'] = __( 'Image', 'yit' );
        $columns['logo_site'] = __( 'Link', 'yit' );
        return $columns;
    }

    /**
     * Enqueue admin script
     *
     * Enqueue backend scripts; constructor add it to admin_enqueue_scripts hook
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function admin_enqueue_scripts() {

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
        yit_enqueue_style( 'slider-logo-shortcode', $this->plugin_assets_url . '/css/logos_slider.css' );
        yit_enqueue_style( 'owl-slider', $this->plugin_assets_url . '/css/owl.css' );
    }

	/**
	 * Add handler to initialize the slider
	 *
	 * @return void
	 * @since 1.0.0
	 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
	 */
	public function add_handler() {
		static $shown;

		if ( $shown ) return;
		?>

		<script type="text/javascript">
			(function ($) {
				"use strict";

				if ( $.fn.imagesLoaded && $.fn.owlCarousel ) {
					$('.logos-slides').imagesLoaded(function(){
						var t       = $(this),
                            speed   = t.data( 'speed'),
							owl     = t.owlCarousel({
                                    autoPlay: 3000,
                                    itemsTablet: [768, 3],
                                    paginationSpeed: speed
							});

						// Custom Navigation Events
						t.closest('.logos-slider').on('click', '.next', function(e){
							e.preventDefault();
							owl.trigger('owl.next');
						});

						t.closest('.logos-slider').on('click', '.prev', function(e){
							e.preventDefault();
							owl.trigger('owl.prev');
						});
					});
				}

				if ( $.fn.BlackAndWhite ) {
					$('.bwWrapper').BlackAndWhite({
						hoverEffect : true, // default true
						// set the path to BnWWorker.js for a superfast implementation
						webworkerPath : false,
						// for the images with a fluid width and height
						responsive:true,
						speed: { //this property could also be just speed: value for both fadeIn and fadeOut
							fadeIn: 200, // 200ms for fadeIn animations
							fadeOut: 300 // 800ms for fadeOut animations
						}
					});
				}

				$("a.bwWrapper[href='#']").click(function(){ return false })

			})( jQuery );
		</script>

		<?php

		$shown = false;
	}

	/**
     * Add metabox to testimonial custom post
     *
     * Add metabox to the custom post
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function add_metabox() {

        $args = array(
            'label'    => __( 'Other Logos Info', 'yit' ),
            'pages'    => $this->logo_post_type, //or array( 'post-type1', 'post-type2')
            'context'  => 'normal', //('normal', 'advanced', or 'side')
            'priority' => 'default',
            'tabs'     => array(
                'settings' => array(
                    'label'  => __( 'Site URL', 'yit' ),
                    'fields' => array(
                        'logo_site'      => array(
                            'label' => __( 'Link', 'yit' ),
                            'desc'  => __( 'Insert the link for Logo.', 'yit' ),
                            'type'  => 'text',
                            'std'   => '' )
                    )
                )
            )
        );

        $metabox = new YIT_Metabox( 'yit-logos-info' );
        $metabox->init( $args );
    }


    /**
     * Add shortcode
     *
     * Register logos shortcode on yit_shortcode plugin
     *
     * @param $shortcodes_array array() Array of shortcodes
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function add_shortcode($shortcodes_array) {
        return array_merge($shortcodes_array, $this->logo_shortcode_list());
    }

    /**
     * Shortcode list for logos
     *
     * Return shortcode list for logos
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function logo_shortcode_list() {
        return apply_filters( 'yit_logo_shortcode_options', array(
            'logos_slider' => array(
                'title' => __('Logos slider', 'yit' ),
                'description' =>  __('Show a slider with logos', 'yit' ),
                'tab' => 'cpt',
                'in_visual_composer' => true,
                'create' => false,
                'has_content' => false,
                'attributes' => array(
                    'title' => array(
                        'title' => __('Title', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'items' => array(
                        'title' => __('N. of items', 'yit'),
                        'type' => 'number',
                        'std'  => '-1'
                    ),
                    'height' => array(
                        'title' => __('Height (px)', 'yit'),
                        'type' => 'number',
                        'std'  => '50'
                    ),
                    'speed' => array(
                        'title' => __('Speed (ms)', 'yit'),
                        'type' => 'number',
                        'std'  => '500'
                    ),
                    'active_bw' => array(
                        'title' => __('Active Black and White', 'yit'),
                        'type' => 'checkbox',
                        'std'  => 'yes'
                    )
                )
            )
        ));
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
    public function shortcode_icon($icon_url, $shortcode) {
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
    public function shortcode_callback($atts, $content = null, $shortcode) {
        $shortcode_logo = $this->logo_shortcode_list();
        $all_atts = $atts;
        $all_atts['content'] = $content;

        if( isset( $shortcode_logo[ $shortcode ]['unlimited'] ) && $shortcode_logo[ $shortcode ]['unlimited'] ) {
            $atts['content'] = $content;
        } else {
            //retrieves default atts
            $default_atts = array();

            if( !empty( $shortcode_logo[ $shortcode ]['attributes'] ) ) {
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
}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Logos() {
    return YIT_Logos::instance();
}

/**
 * Create a new YIT_LOGOS object
*/
YIT_Logos();