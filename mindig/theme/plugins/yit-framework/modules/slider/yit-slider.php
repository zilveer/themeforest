<?php
/**
 * YIT Slider
 *
 * Manage the slider features in the YIT Framework
 *
 * @class YIT_Slider
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Slider {

    /**
     * @var string
     * @since 1.0
     */
    public $version = YIT_SLIDER_VERSION;

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
     * @var string $sliders_post_type The post type name for the post type of all sliders
     * @since 1.0
     */
    public $sliders_post_type = 'sliders';

    /**
     * @var string $post_type_prefix The post type of each slider
     * @since 1.0
     */
    public $post_type_prefix = 'sl_';

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
        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/slider' );
        $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/slider' );

        // fix the base url and base path in case is the plugin
        add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        // Register CPTU
        add_action( 'after_setup_theme', array( $this, 'register_cptu' ), 20 );

        // admin
        add_action( 'admin_init', array( $this, 'customize_table_list_columns' ) );
        add_action( 'after_setup_theme', array( $this, 'add_metaboxes' ), 10 );

        // frontend
        add_filter( 'yit_cptu_frontend_vars', array( $this, 'frontend_vars' ), 10, 2 );

        // TODO Aggiungere metabox nelle impostazioni di pagina e nel plugin del layout di Emanuela
        add_action( 'init', array( $this, 'add_slider_option_layout' ) );

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
            'name'              => $this->sliders_post_type,
            'post_type_prefix'  => $this->post_type_prefix,
            'labels'            => array(
                'main_name' => __( 'Slider', 'yit' ),
                'singular'  => __( 'Slider', 'yit' ),
                'plural'    => __( 'Sliders', 'yit' ),
                'menu'      => __( 'Slider', 'yit' )
            ),
            'plugin_path'       => $this->plugin_path,
            'plugin_url'        => $this->plugin_url,
            'manage_layouts'    => true,
            'add_multiuploader' => true,
            'sortable'          => true,
            'has_single'        => false,
            'has_taxonomy'      => false,
            'label_item_sing'   => __( 'Slide', 'yit' ),
            'label_item_plur'   => __( 'Slides', 'yit' ),
            'shortcode_name'    => 'slider',
            'shortcode_icon'    => $this->plugin_url . '/images/shortcode-icon.png',
            'menu_icon'         => 'dashicons-images-alt2',
            'layout_option'     => '_type'
        ) );

    }

    /**
     * Get the slider instance of the object
     *
     * @param $slider
     *
     * @return \YIT_Slider_Object
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public static function get_slider( $slider ) {
        include_once( dirname(__FILE__) . '/yit-slider-object.php' );

        return YIT_Slider_Object::instance( $slider );
    }

    /**
     * Actions to customize the columns of table list
     *
     * @return array
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function customize_table_list_columns() {
        add_filter( 'manage_edit-' . $this->sliders_post_type . '_columns', array( $this, 'sliders_define_columns' ) );
        add_action( 'manage_' . $this->sliders_post_type . '_posts_custom_column' , array( $this, 'sliders_change_columns' ), 10, 2 );

        // CPTs
        $args = array(
            'post_type' => $this->sliders_post_type,
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );
        $post_types = get_posts( $args );

        foreach ( $post_types as $pt ) {
			$post_type = get_post_meta( $pt->ID, '_post_type', true );
            add_filter( 'manage_edit-' . $post_type . '_columns', array( $this, 'table_items_define_columns' ) );
            add_action( 'manage_' . $post_type . '_posts_custom_column', array( $this, 'table_items_change_columns' ), 10, 2 );
        }
    }

    /**
     * Define the columns to use in the list table of main sliders post type
     *
     * @param $columns array The columns used in the list table
     *
     * @return array
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function sliders_define_columns( $columns ) {
        unset( $columns['date'] );

        $columns['type']       = __( 'Type', 'yit' );
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
    public function sliders_change_columns( $column, $post_id ) {
        $slider = $this->get_slider( get_post( $post_id ) );

        switch ( $column ) {
            case 'type' :
                echo isset( $this->cptu->layouts[ $slider->config->layout ] ) ? $this->cptu->layouts[ $slider->config->layout ]['name'] : '';
                break;

            case 'items' :
				echo ( ! empty( $slider->name ) ) ? wp_count_posts( get_post_meta( $post_id, '_post_type', true ) )->publish : '';
                break;

            case 'shortcode' :
                echo ! empty( $slider->name ) ? '[slider name="' . $slider->name . '"]' : '';
                break;

        }
    }

    /**
     * Define the columns to use in the list table of main sliders post type
     *
     * @param $columns array The columns used in the list table
     *
     * @return array
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function table_items_define_columns( $columns ) {
        $columns = array(
            'cb' => $columns['cb'],
            'thumbnail' => __( 'Thumbnail', 'yit' ),
            'title' => $columns['title']
        );

	 	$post_name = str_replace( $this->post_type_prefix, '', $_REQUEST['post_type'] );
		$slider = $this->get_slider( $post_name );
		$layout = $slider->config->layout;

		if ( ! isset( $this->cptu->layouts[ $layout ]['columns'] ) || empty( $this->cptu->layouts[ $layout ]['columns'] ) ) {
			return $columns;
		}

		foreach ( $this->cptu->layouts[ $layout ]['columns'] as $column => $val ) {
			$columns[ sanitize_title( $column ) ] = $column;
		}

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

        }

		$post_name = str_replace( $this->post_type_prefix, '', $_REQUEST['post_type'] );
		$slider = $this->get_slider( $post_name );
		$layout = $slider->config->layout;

		if ( ! isset( $this->cptu->layouts[ $layout ]['columns'] ) || empty( $this->cptu->layouts[ $layout ]['columns'] ) ) {
			return;
		}

		foreach ( $this->cptu->layouts[ $layout ]['columns'] as $c => $val ) {
			if ( sanitize_title( $c ) != $column ) continue;

			preg_match( '/%([a-z0-9-_]+)%/', $val, $match );
			if ( isset( $match[1] ) ) {
				$val = str_replace( '%' . $match[1] . '%', $slider->get( $match[1], "post_id={$post_id}" ), $val );
			}

			echo $val;
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
        if ( $post_type != $this->sliders_post_type ) {
            return $vars;
        }

        $vars['slider'] = YIT_Slider()->get_slider( $vars['name'] );
        $vars['slider']->init_query();

        //wpml fix
        $vars['post_type'] = $vars['slider']->post_type;
        $vars['layout'] = $vars['slider']->config->layout;

        return $vars;
    }

    /**
     * Add the metaboxes in the page settings of YIThemes themes and add the field in the layout plugin of YIT
     *
     * @return void
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function add_metaboxes() {

        $sliders = get_posts( "post_type={$this->sliders_post_type}&posts_per_page=-1" );

        $options = array( 'none' => __( 'None', 'yit' ) );
        foreach ( $sliders as $slider ) {
            $options[ $slider->post_name ] = $slider->post_title;
        }

        $field = array(
            'slider_name' => array(
                'label'   => __( 'Slider', 'yit' ),
                'desc'    => __( 'Select the slider to use in this page', 'yit' ),
                'type'    => 'select',
                'options' => $options,
                'std'     => ''
            )
        );
        YIT_Metabox( 'yit-page-setting' )->add_field( 'header', $field, 'first' );
    }

    /**
     * Add the slider option in the layout settings of YIT Layout plugin
     *
     * @return void
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public function add_slider_option_layout() {
        if ( ! function_exists( 'YIT_Layout_Panel' ) ) {
            return;
        }

        $sliders = get_posts( "post_type={$this->sliders_post_type}&posts_per_page=-1" );

        $options = array( 'none' => __( 'None', 'yit' ) );
        foreach ( $sliders as $slider ) {
            $options[ $slider->post_name ] = $slider->post_title;
        }
        $field = array(
            'slider_name' => array(
                'label'   => __( 'Slider', 'yit' ),
                'desc'    => __( 'Select the slider to use in this page', 'yit' ),
                'type'    => 'select',
                'options' => $options,
                'std'     => ''
            ),
        );

        YIT_Layout_Panel()->add_option( 'header', array(
            'sep3'                    => array(
                'type' => 'sep'
            ),
        ) );
        YIT_Layout_Panel()->add_option( 'header', $field );
    }

}

/**
 * Main instance of plugin
 *
 * @return \YIT_Slider
 * @since  1.0
 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
 */
function YIT_Slider() {
    return YIT_Slider::instance();
}

/**
 * Instantiate Slider class
 *
 * @since  1.0
 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
 */
YIT_Slider();
