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
 * Add Services custom post type and services shortcode to wordpress
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * YIT_Services exists
 */
define('YIT_SERVICES', true);

/**
 * Perform services init
 *
 * @class YIT_Services
 * @package Yithemes
 * @since Version 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Services{

    /**
     * @var string Version
     */
    public $version = YIT_SERVICES_VERSION;

    /**
     * @var string $service_post_type The post type name for the post type of all services
     */
    public $service_post_type = 'services';

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
     * @author Antonino Scarfì <antonino.scarfi@yithemes.it>
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
        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/services' );
	    $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/services' );
	    $this->plugin_assets_url = $this->plugin_url. '/assets' ;
	    $this->plugin_assets_path = $this->plugin_path. '/assets' ;
	    $this->plugin_template_url = $this->plugin_url. '/templates' ;
	    $this->plugin_template_path = $this->plugin_path. '/templates' ;

	    // fix the base url and base path in case is the plugin
	    add_action( 'plugins_loaded', array( $this, 'set_path_and_url_by_plugin' ) );

        // register post type
        add_action( 'init', array( $this, 'register_post_type' ) );

        // register custom columns
        add_action( 'manage_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-'.$this->service_post_type.'_columns', array( &$this, 'edit_columns_service' ) );

        // enqueue scripts and styles
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        // add the shortcode for the services
        add_action( 'after_setup_theme', array( $this, 'shortcode_init' ) );

		// load single template part for the YIThemes's themes
		add_action( 'yit_loop', array( $this, 'load_single_template' ) );
    }

	/**
	 * Fix the base path and base url of plugin
	 *
	 * As soon as the plugin is instantiated, the base path and url are from the YIT theme, but this method is hook
	 * inside 'plugins_loaded', so if it is called, the base path and url must be from plugin
	 */
	public function set_path_and_url_by_plugin() {
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
            'name' => __( 'Services', 'yit' ),
            'singular_name' => __( 'Service', 'yit' ),
            'plural_name' => __( 'Services', 'yit' ),
            'item_name_sing' => __( 'Service', 'yit' ),
            'item_name_plur' => __( 'Services', 'yit' ),
            'add_new' => __( 'Add New', 'yit' ),
            'add_new_item' => __( 'Add New Service', 'yit' ),
            'edit' => __( 'Edit', 'yit' ),
            'edit_item' => __( 'Edit Service', 'yit' ),
            'new_item' => __( 'New Service', 'yit' ),
            'view' => __( 'View', 'yit' ),
            'view_item' => __( 'View Service', 'yit' ),
            'search_items' => __( 'Search Services', 'yit' ),
            'not_found' => __( 'No Services', 'yit' ),
            'not_found_in_trash' => __( 'No Services in the Trash', 'yit' ),
        );

        $args = array(
            'labels'           => $labels,
            'public'           => true,
            'public_queryable' => false,
            'show_ui'          => true,
            'show_in_menu'     => true,
            'query_var'        => false,
            'capability_type'  => 'post',
            'hierarchical'     => false,
            'has_archive'      => 'service',
            'rewrite'          => array( 'slug' => apply_filters( 'yit_services_rewrite', 'services' ) ),
            'menu_position'    => null,
            'supports'         => array( 'title', 'editor', 'thumbnail' ),
            'description'      => __( "Services", 'yit' ),
            'menu_icon'        => 'dashicons-edit'

        );

        register_post_type( $this->service_post_type, apply_filters( 'yit_services_args', $args ) );
    }

    /**
     * Rewrite Flush
     *
     * Rewrite flush when this plugin is activated
     *
     * @return void
     * @since    1.0.0
     * @author   Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
     public function rewrite_flush(){

         $this->register_post_type();

         flush_rewrite_rules();
     }

    /**
     * Customize desc column
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
            case "desc":
                the_excerpt();
                break;
        }

    }

    /**
     * Add columns to Service admin
     *
     * Edit the columns in the table of service post types
     *
     * @param $columns array() Columns array
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function edit_columns_service( $columns ) {
        $columns['desc'] = __( 'Description', 'yit' );
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

    }

    /**
     * Init services shortcode
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function shortcode_init(){
        foreach( $this->service_shortcode_list() as $shortcode => $atts ){
            add_shortcode( $shortcode, array( &$this, 'shortcode_callback' ) );
            add_filter('yit_shortcode_'.$shortcode.'_icon', array( $this, 'shortcode_icon'), 10, 2);
        }
        add_filter( 'yit-shortcode-plugin-init', array( $this, 'add_shortcode' ) );
    }

    /**
     * Add shortcode
     *
     * Register services shortcode on yit_shortcode plugin
     *
     * @param $shortcodes_array array() Array of shortcodes
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_shortcode($shortcodes_array) {
        return array_merge($shortcodes_array, $this->service_shortcode_list());
    }

    /**
     * Shortcode list for services
     *
     * Return shortcode list for services
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function service_shortcode_list() {
        $assets = YIT_Plugin_Common::load();
        $animate = $assets['animate'];
        return array(
            'services' => array(
                'title' => __( 'Services', 'yit' ),
                'description' => __( 'Print a services type.', 'yit' ),
                'tab' => 'section',
                'create' => false,
                'in_visual_composer' => true,
                'has_content' => false,
                'attributes' => array(
                    'title' => array(
                        'title' => __( 'Title', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    ),
                    'description' => array(
                        'title' => __( 'Description', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    ),
                    'items' => array(
                        'title' => __( 'Select services', 'yit' ),
                        'type' => 'select',
                        'multiple' => true,
                        'options' => $this->yit_get_services(),
                        'std' => serialize( array() )
                    ),
                    'show_excerpt' => array(
                        'title' => __( 'Show excerpt', 'yit' ),
                        'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'excerpt_length' => array(
                        'title' => __( 'Limit words', 'yit' ),
                        'type' => 'number',
                        'std' => 10
                    ),
                    'show_title' => array(
                        'title' => 'Show title',
                        'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_border' => array(
                        'title' => __( 'Show border animation', 'yit' ),
                        'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'items_per_row' => array(
                        'title' => __( 'Items per row', 'yit' ),
                        'type' => 'select',
                        'options' => array(
                            '2' => __( '2 items', 'yit' ),
                            '3' => __( '3 items', 'yit' ),
                            '4' => __( '4 items', 'yit' ),
                            '6' => __( '6 items', 'yit' ),
                        ),
                        'std' => '4'
                    ),
                    'show_services_button' => array(
                        'title' => __( 'Show button', 'yit' ),
                        'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'services_button_text' => array(
                        'title' => __( 'Button text', 'yit' ),
                        'type' => 'text',
                        'std' => __( 'Read More', 'yit' )
                    ),
                    'services_icon_title' => array(
                        'title' => __( 'Title icon url', 'yit' ),
                        'type' => 'text',
                        'std' => ''
                    ),
                    'animate' => array(
                        'title' => __('Animation', 'yit'),
                        'type' => 'select',
                        'options' => $animate,
                        'std'  => ''
                    ),
                    'animation_delay' => array(
                        'title' => __('Animation Delay', 'yit'),
                        'type' => 'text',
                        'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                        'std'  => '0'
                    )
                )
            )
        );
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
     * Callback for services shortcode; load the correct template whit variables inserted and return the html markup
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
        $shortcode_service = $this->service_shortcode_list();
        $all_atts = $atts;
        $all_atts['content'] = $content;

        if( isset( $shortcode_service[ $shortcode ]['unlimited'] ) && $shortcode_service[ $shortcode ]['unlimited'] ) {
            $atts['content'] = $content;
        } else {
            //retrieves default atts
            $default_atts = array();

            if( !empty( $shortcode_service[ $shortcode ]['attributes'] ) ) {
                foreach( $shortcode_service[ $shortcode ]['attributes'] as $name=>$type ) {
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
     * Get services post
     *
     * @param array $array
     * @return array
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */

    public function yit_get_services( $array = array()) {

        $posts = get_posts( array( 'post_type' => $this->service_post_type ) );

        foreach( $posts as $post ){
            $array[ $post->ID ] = $post->post_title;
        }

        return $array;
    }

	/**
	 * Load single template
	 *
	 * Add the print of single template part for the YIThemes's themes. For all others templates, it's valid the
	 * standard single-services.php template of wordpress.
	 *
	 * @return void
	 * @since  1.0
	 * @author Antonino Scarfì <antonino.scarfi@yithemes.it>
	 */
	public function load_single_template() {
		if ( ! is_singular( $this->service_post_type ) ) {
			return;
		}

		yit_plugin_get_template( $this->plugin_path, 'services/single.php' );
	}
}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 */
function YIT_Services() {
    return YIT_Services::instance();
}

/**
 * Create a new YIT_Services object
 */
YIT_Services();