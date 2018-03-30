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
 * YIT_Sitemap exists
 */
define('YIT_SITEMAP', true);

//TODO: add metabox to pages and posts
//TODO: add options management
//TODO: add sidebar managment for shortcode template
/**
 * Perform Sitemap init
 *
 * @class YIT_Sitemap
 * @package Yithemes
 * @since Version 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Sitemap{
    /**
     * @var string Version
     */
    public $version = YIT_SITEMAP_VERSION;

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
     * @var string plugin option name
    */
    public $plugin_options = 'yit_sitemap_options';

    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * @var object The single instance of the subpanel
     * @since 1.0
     */
    protected $_subpanel = null;

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
    public function __construct(){
        // define local attributes
        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/sitemap' );
        $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/sitemap' );
        $this->plugin_assets_url = $this->plugin_url. '/assets' ;
        $this->plugin_assets_path = $this->plugin_path. '/assets' ;
        $this->plugin_template_url = $this->plugin_url. '/templates' ;
        $this->plugin_template_path = $this->plugin_path. '/templates' ;

        // fix the base url and base path in case is the plugin
        add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        //register metabox
        add_action( 'admin_init', array( $this, 'add_metabox' ) );

        //register layout panel field
        add_action( 'after_setup_theme', array( $this, 'add_panel') );
        add_action( 'after_setup_theme', array( $this, 'add_layout_panel') );
        // add the shortcode for the sitemap
        foreach( $this->sitemap_shortcode_list() as $shortcode => $atts ){
            add_shortcode( $shortcode, array( $this, 'shortcode_callback' ) );
            add_filter('yit_shortcode_'.$shortcode.'_icon', array( $this, 'shortcode_icon'), 10, 2);
        }
        add_filter( 'yit-shortcode-plugin-init', array( $this, 'add_shortcode' ) );
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
     * Add metabox to pages and post
     *
     * Add metabox to pages and posts to set sitemap visibility
     *
     * @return void
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_metabox() {
        $args = array(
            'sep-sitemap' => array(
                'type' => 'sep'
            ),
            'sitemap_display' => array(
                'label' => __( 'Display this page in the sitemap', 'yit' ),
                'desc'  => __( 'Check if you want to show this page in the sitemap', 'yit' ),
                'type'  => 'onoff',
                'std'   => 'yes'
            ),
        );
        YIT_Metabox( 'yit-page-setting' )->add_field( 'settings', $args, 'last' );
        YIT_Metabox( 'yit-post-setting' )->add_field( 'settings', $args, 'last' );

    }

    /**
     * Add Panels to dashboard
     *
     * Add a panel to YIT Plugin panel
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function add_panel() {

        if ( ! empty( $this->_subpanel ) ) {
            return;
        }

        $admin_tabs = array(
            'general'  => __( 'General', 'yit' ),
            'pages'    => __( 'Pages', 'yit' ),
            'posts'    => __( 'Posts', 'yit' ),
            'archives' => __( 'Archives', 'yit' ),
            'products' => __( 'Products', 'yit' ),
        );

        $args = array(
            'page'           => 'sitemap',
            'label'        => __( 'YIT Sitemap', 'yit' ),
            'admin-tabs'   => $admin_tabs,
            'plugin-url' => $this->plugin_url,
            'plugin-path' => $this->plugin_path,
            'options-path' => $this->plugin_path . '/plugin-options'
        );

        $this->_subpanel = new Yit_Plugin_SubPanel( $args );
    }

    /**
     * Add Panel to YIT_Layout subpanel
     *
     * Add a panel to Layout panel if YIT_sidebar is active
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_layout_panel() {
        //check if yit-sidebar in active
        if( defined('YIT_LAYOUT') ){
            //add a panel to Layout Subpanel
            YIT_Layout_Panel()->add_panel(
                array(
                    'sitemap' => array(
                        'label' => __( 'Sitemap', 'yit' ),
                        'fields' => array(
                            'display' => array(
                                'label' => __( 'Display this page in the sitemap', 'yit' ),
                                'desc' => __( 'Check if you want to show this page in the sitemap', 'yit' ),
                                'type' => 'onoff',
                                'std' => 'yes'
                            ),
                        )
                    )
                ),
                'after'
            );
        }
    }

    /**
     * Get the option with the specified id from the db
     *
     * @param $option string Option id
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function get_option($option){
        $options = get_option( $this->plugin_options );

        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }
        else {
            return '';
        }
    }

    /**
     * Add shortcode
     *
     * Register sitemap shortcode on yit_shortcode plugin
     *
     * @param $shortcodes_array array() Array of shortcodes
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_shortcode( $shortcodes_array ) {
        return array_merge( $shortcodes_array, $this->sitemap_shortcode_list() );
    }

    /**
     * Shortcode list for sitemap
     *
     * Return shortcode list for sitemap pulgin
     *
     * @return array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function sitemap_shortcode_list() {
        return array(
            /* === SITEMAP === */
            'sitemap' => array(
                'title' => __('Sitemap', 'yit' ),
                'description' =>  __('The sitemap can be configured in YIT Plugins -> Layout if YIT_Sidebar plugin is active .', 'yit' ),
                'tab' => 'shortcodes',
                'has_content' => false,
                'create' => false,
                'in_visual_composer' => true,
                'multiple' => false,
                'unlimited'   => false,
                'attributes' => array(
                    'title' => array(
                        'title' => __('Title', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    )
                )
            ),
        );
    }

    /**
     * Shortcode icon
     *
     * Return the shortcode icon to display on shortcode panel
     *
     * @param $icon_url string Icone url found by yit_shortcode plugin
     * @param $shortcode string Tag shortcode
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function shortcode_icon( $icon_url, $shortcode ) {
        return $icon_url;
    }

    /**
     * Shortcode Callback
     *
     * Callback for sitemap shortcode; load the correct template whit variables inserted and return the html markup
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
        $shortcode_logo = $this->sitemap_shortcode_list();
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
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 */
function YIT_Sitemap() {
    return YIT_Sitemap::instance();
}

/**
 * Create a new YIT_Sitemap object
 */
YIT_Sitemap();