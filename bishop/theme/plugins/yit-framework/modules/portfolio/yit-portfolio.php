<?php
/**
 * @package Yithemes
 * @version 1.0
 */

/**
 * YIT Portfolio
 *
 * Manage the portfolio features in the YIT Framework
 *
 * @class YIT_Portfolio
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Portfolio {

    /**
     * @var string
     * @since 1.0
     */
    public $version = YIT_PORTFOLIO_VERSION;

    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * @var string
     * @since 1.0
     */
    public $plugin_url;

    /**
     * @var string
     * @since 1.0
     */
    public $plugin_path;

    /**
     * @var string $portfolios_post_type The post type name for the post type of all portfolios
     * @since 1.0
     */
    public $portfolios_post_type = 'portfolios';

    /**
     * @var string $post_type_prefix The post type of each portfolio
     * @since 1.0
     */
    public $post_type_prefix = 'po_';

    /**
     * @var \YIT_CPT_Unlimited Manage the object of cptu
     * @since 1.0
     */
    public $cptu = null;

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
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function __construct() {

        // define the url and path of plugin
        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/portfolio' );
	    $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/portfolio' );

	    // fix the base url and base path in case is the plugin
	    add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        // Register CPTU
        add_action( 'after_setup_theme', array( $this, 'register_cptu' ), 20 );

        // admin
        add_action( 'admin_init', array( $this, 'customize_table_list_columns' ) );

        // frontend
        add_filter( 'yit_cptu_frontend_vars', array( $this, 'frontend_vars' ), 10, 2 );

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
	}

    /**
     * Register the Custom Post Type Unlimited
     *
     * @return void
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function register_cptu() {
        include_once( YIT_CORE_PLUGIN_PATH . '/lib/yit-cpt-unlimited.php' );

        $this->cptu = new YIT_CPT_Unlimited( array(
            'name'              => $this->portfolios_post_type,
            'post_type_prefix'  => $this->post_type_prefix,
            'labels'            => array(
                'main_name' => __( 'Portfolio', 'yit' ),
                'singular'  => __( 'Portfolio', 'yit' ),
                'plural'    => __( 'Portfolios', 'yit' ),
                'menu'      => __( 'Portfolio', 'yit' )
            ),
            'plugin_path'       => $this->plugin_path,
            'plugin_url'        => $this->plugin_url,
            'manage_layouts'    => true,
            'add_multiuploader' => true,
			'sortable'          => true,
            'has_single'        => true,
            'has_taxonomy'      => true,
            'label_item_sing'   => __( 'Project', 'yit' ),
            'label_item_plur'   => __( 'Projects', 'yit' ),
            'shortcode_name'    => 'portfolio',
            'shortcode_icon'    => $this->plugin_url . '/images/shortcode-icon.png',
            'menu_icon'         => 'dashicons-portfolio',
            'layout_option'     => '_type'
        ) );
    }

    /**
     * Get the portfolio instance of the object
     *
     * @param $portfolio
     *
     * @return \YIT_Portfolio_Object
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public static function get_portfolio( $portfolio ) {
        include_once( dirname(__FILE__) . '/yit-portfolio-object.php' );

        return YIT_Portfolio_Object::instance( $portfolio );
    }

    /**
     * Actions to customize the columns of table list
     *
     * @return array
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function customize_table_list_columns() {
        add_filter( 'manage_edit-' . $this->portfolios_post_type . '_columns', array( $this, 'portfolios_define_columns' ) );
        add_action( 'manage_' . $this->portfolios_post_type . '_posts_custom_column' , array( $this, 'portfolios_change_columns' ), 10, 2 );

        // CPTs
        $args = array(
            'post_type' => $this->portfolios_post_type,
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );
        $post_types = get_posts( $args );

        foreach ( $post_types as $pt ) {
            $post_type = get_post_meta( $pt->ID, '_post_type', true );
            add_filter( 'manage_edit-' . $post_type . '_columns', array( $this, 'table_items_define_columns' ) );
            add_action( 'manage_' . $post_type . '_posts_custom_column' , array( $this, 'table_items_change_columns' ), 10, 2 );
        }
    }

    /**
     * Define the columns to use in the list table of main portfolios post type
     *
     * @param $columns array The columns used in the list table
     *
     * @return array
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function portfolios_define_columns( $columns ) {
        unset( $columns['date'] );

        $columns['layout']     = __( 'Layout', 'yit' );
        $columns['items']      = __( 'Items', 'yit' );
        $columns['shortcode']  = __( 'Shortcode', 'yit' );

        return $columns;
    }

    /**
     * Change the content of each column of the table list
     *
     * @param $column string The current column
     * @param $post_id int The current post ID
     *
     * @return void
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function portfolios_change_columns( $column, $post_id ) {
        $portfolio = $this->get_portfolio( get_post( $post_id ) );

        switch ( $column ) {
            case 'layout' :
                echo ( ! empty( $portfolio->config->layout ) ) ? $this->cptu->layouts[ $portfolio->config->layout ]['name'] : '';
                break;

            case 'items' :
                echo ( ! empty( $portfolio->name ) ) ? wp_count_posts( get_post_meta( $post_id, '_post_type', true ) )->publish : '';
                break;

            case 'shortcode' :
                echo ( ! empty( $portfolio->name ) ) ? '[portfolio name="' . $portfolio->name . '"]' : '';
                break;

        }
    }

    /**
     * Define the columns to use in the list table of main portfolios post type
     *
     * @param $columns array The columns used in the list table
     *
     * @return array
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function table_items_define_columns( $columns ) {
        if ( ! isset( $_REQUEST['post_type'] ) ) {
            return $columns;
        }

        $portfolio = YIT_Portfolio()->get_portfolio( str_replace( $this->post_type_prefix, '', $_GET['post_type'] ) );

        $columns = array(
            'cb' => $columns['cb'],
            'thumbnail' => __( 'Thumbnail', 'yit' ),
            'title' => $columns['title'],
            'content' => __( 'Excerpt', 'yit' )
        );

        $columns[ 'taxonomy-' . $portfolio->config->taxonomy ] = $columns[ 'taxonomy-' . $portfolio->config->taxonomy ];

        return $columns;
    }

    /**
     * Change the content of each column of the table list
     *
     * @param $column string The current column
     * @param $post_id int The current post ID
     *
     * @return void
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function table_items_change_columns( $column, $post_id ) {

        switch ( $column ) {
            case 'thumbnail' :
                echo get_the_post_thumbnail( $post_id, array( 60, 60 ) );
                break;

            case 'content' :
                the_excerpt();
                break;

        }
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
        if ( $post_type != $this->portfolios_post_type ) {
            return $vars;
        }

        $vars['portfolio'] = YIT_Portfolio()->get_portfolio( $vars['name'] );
        if ( ! is_singular( $this->portfolios_post_type ) ) {
            $vars['portfolio']->init_query();
        }

        return $vars;
    }

    /**
     * Check if a post is a portfolios
     *
     * @param $post_type
     *
     * @return bool
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function is( $post_type )  {

        $regex = "#^{$this->post_type_prefix}#";

        if( is_int( $post_type ) ){
            $post_type = get_post_type( $post_type );
        }elseif( is_object( $post_type ) ){

            if( is_a( $post_type, 'WP_Post' ) ){
                $post_type = get_post_type( $post_type );
            }elseif( is_a( $post_type, 'WP_Query' ) ) {
                $post_type = get_post_type( $post_type->post );
            }else{
                return false;
            }
        }

        return preg_match( $regex, $post_type ) === 1 ? true : false;
    }

}

/**
 * Main instance of plugin
 *
 * @return \YIT_Portfolio
 * @since  1.0
 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
 */
function YIT_Portfolio() {
    return YIT_Portfolio::instance();
}

/**
 * Instantiate Portfolio class
 *
 * @since  1.0
 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
 */
YIT_Portfolio();