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
 * Add Feature Tab custom post type and Feature Tab shortcode to wordpress
 *
 * @package Yithemes
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * YIT_Feature_Tab exists
 */
define( 'YIT_FEATURE_TAB', true );

/**
 * Perform feature tabs init
 *
 * @class YIT_Feature_Tabs
 * @package Yithemes
 * @since   Version 1.0.0
 * @author  Your Inspiration Themes
 */
class YIT_Feature_Tabs {
    /**
     * @var string Version
     */
    public $version = YIT_FEATURE_TAB_VERSION;

    /**
     * @var string $feature_tab_post_type The post type name for the post type of all feature tabs
     */
    public $feature_tab_post_type = 'feature-tabs';

    /**
     * @var string $post_type_prefix The post type of each portfolio
     * @since 1.0
     */
    public $post_type_prefix = 'ft_';

    /**
     * @var object Manage the object of cptu
     * @since 1.0
     */
    protected $cptu = null;

    /**
     * @var string Plugin url
     */
    public $plugin_url;

    /**
     * @var string Plugin path
     */
    public $plugin_path;

    /**
     * @var string Plugin assets url
     */
    public $plugin_assets_url;

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
     * @since  1.0
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
     * @since  Version 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function __construct() {
        // define local attributes
        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/feature-tabs' );
	    $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/feature-tabs' );
	    $this->plugin_assets_url = $this->plugin_url. '/assets' ;
	    $this->plugin_assets_path = $this->plugin_path. '/assets' ;
	    $this->plugin_template_url = $this->plugin_url. '/templates' ;
	    $this->plugin_template_path = $this->plugin_path. '/templates' ;

	    // fix the base url and base path in case is the plugin
	    add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        // Register CPTU
        add_action( 'after_setup_theme', array( $this, 'register_cptu' ), 20 );
        //TODO: aggiungere custom columns ai tipi custom secondari

        // register custom columns
        add_action( 'admin_init', array( $this, 'register_columns' ) );

        //register metabox
        add_action( 'init', array( $this, 'add_metabox' ), 1 );

        // frontend
        add_filter( 'yit_cptu_frontend_vars', array( $this, 'frontend_vars' ), 10, 2 );

        // enqueue scripts and styles
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
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
     * Register the custom post type unlimited
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function register_cptu() {
        include_once( YIT_CORE_PLUGIN_PATH . '/lib/yit-cpt-unlimited.php' );
        $this->cptu = new YIT_CPT_Unlimited(
            array(
                'name'             => $this->feature_tab_post_type,
                'post_type_prefix' => $this->post_type_prefix,
                'labels'           => array(
                    'main_name' => __( 'Feature Tab', 'yit' ),
                    'singular'  => __( 'Feature Tab', 'yit' ),
                    'plural'    => __( 'Feature Tabs', 'yit' ),
                    'menu'      => __( 'Feature Tab', 'yit' )
                ),
                'plugin_path'      => $this->plugin_path,
                'plugin_url'       => $this->plugin_url,
                'label_item_sing'   => __( 'Tab', 'yit' ),
                'label_item_plur'   => __( 'Tabs', 'yit' ),
                'manage_layout'    => false,
                'shortcode_name'   => 'feature_tab',
                'shortcode_icon'   => $this->plugin_url . '/assets/images/shortcode-icon.png',
                'menu_icon'        => 'dashicons-exerpt-view',
            )
        );
    }

    /**
     * Add metabox to contact form custom post
     *
     * Add metabox to the custom post
     *
     * @return void
     * @since  1.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function add_metabox() {

        // Sohw this advice just when i'm in inserting mode
        if(!isset($_GET["post"])) {
            $args = array(
                'label'    => __( 'Publish the features tab to configure it.', 'yit' ),
                'pages'    => $this->feature_tab_post_type,
                'context'  => 'normal', //('normal', 'advanced', or 'side')
                'priority' => 'default'
            );

            $metabox = new YIT_Metabox( 'yit-features-tab-form-info' );
            $metabox->init( $args );
        }
    }

    /**
     * Get the feature tab instance of the object
     *
     * @param $feature_tab string
     *
     * @return null|object|\YIT_Feature_Tab_Object /YIT_Feature_Tab_Object
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public static function get_feature_tab( $feature_tab ) {
        include_once( dirname( __FILE__ ) . '/yit-feature-tabs-object.php' );

        return YIT_Feature_Tab_Object::instance( $feature_tab );
    }

    /**
     * Define the variables for the frontend of the shortcode
     *
     * @param $vars
     * @param $post_type
     *
     * @return array
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function frontend_vars( $vars, $post_type )  {
        if ( $post_type != $this->feature_tab_post_type ) {
            return $vars;
        }

        $vars['baseurl']      = $this->plugin_url;
        $vars['basepath']     = $this->plugin_path;
        $vars['features_tab'] = $this->get_feature_tab( $vars['name'] );
        $vars['features_tab']->init_query();

        return $vars;
    }

    /**
     * Register columns for feature tabs and secondary cpt
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function register_columns(){
        add_filter( 'manage_edit-' . $this->feature_tab_post_type . '_columns', array( $this, 'custom_columns' ) );
        add_action( 'manage_' . $this->feature_tab_post_type . '_posts_custom_column', array( $this, 'edit_columns_feature_tab' ), 10, 2 );

        $args = array( 'post_type' => $this->feature_tab_post_type, 'posts_per_page' => - 1, 'order' => 'ASC' );
        $ft = get_posts( $args );

        if( ! empty( $ft ) ){
            foreach($ft as $pt){
            	$post_type = get_post_meta( $pt->ID, '_post_type', true );
                add_filter( 'manage_edit-' . $post_type . '_columns', array( $this, 'subsection_custom_columns'));
                add_action( 'manage_' . $post_type . '_posts_custom_column', array( $this, 'edit_columns_subsection'), 10, 2 );
            }
        }
    }

    /**
     * Declare custom columns for feature tabs custom post type
     *
     * @param $columns array Column array
     *
     * @return array
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function custom_columns( $columns ) {
        unset( $columns['date'] );

        $columns['items']     = __( 'Items', 'yit' );
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
    public function edit_columns_feature_tab( $column, $post_id ) {
        $feature_tab = $this->get_feature_tab( get_post( $post_id ) );

        switch ( $column ) {
            case 'items' :
                echo ( ! empty( $feature_tab->name ) ) ? wp_count_posts( get_post_meta( $post_id, '_post_type', true ) )->publish : '';
                break;

            case 'shortcode' :
                echo ( ! empty( $feature_tab->name ) ) ? '[feature_tab name="' . $feature_tab->name . '"]' : '';
                break;

        }
    }

    /**
     * Declare custom columns for feature tabs secondary custom post type
     *
     * @param $columns array
     *
     * @return array
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function subsection_custom_columns( $columns ) {
        unset( $columns['date'] );
        unset( $columns['title'] );

        $columns['image-feature'] = __( 'Image', 'yit' );
        $columns['title'] = __( 'Title', 'yit' );
        $columns['desc-feature'] = __( 'Description', 'yit' );

        return $columns;
    }

    /**
     * Set the content for custom columns of custom post type declared before
     *
     * @param $column string Column name
     * @param $post_id int Post id
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function edit_columns_subsection( $column, $post_id ) {
        switch ( $column ) {
            case 'image-feature' :
                if ( has_post_thumbnail( $post_id ) ) echo get_the_post_thumbnail( $post_id );
                break;
            case 'desc-feature' :
                the_excerpt();
                break;
        }
    }

    /**
     * Enqueue scripts for admin pages
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function admin_enqueue_scripts() {

    }

    /**
     * Enqueue scripts for public pages
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function enqueue_scripts() {
        yit_enqueue_style( 'yit-feature-tab', $this->plugin_assets_url . '/css/featurestab.css' );
    }




}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 */
function YIT_Feature_Tabs() {
    return YIT_Feature_Tabs::instance();
}

/**
 * Create a new YIT_Feature_Tabs object
 */
YIT_Feature_Tabs();