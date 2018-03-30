<?php
/**
 * Main theme admin class file
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

include ADMIN_OPTIONS_DIR . 'options.php';
include ADMIN_OPTIONS_DIR . 'option.php';
include INCLUDES_DIR . 'backend.php';
/**
 * Main theme admin bootstrap class
 *
 * @since 1.0
 */
class OxyThemeAdmin
{
    /**
     * Stores array of theme setuop options
     *
     * @since 1.0
     * @access public
     * @var array
     */
    public $theme;

    /**
     * Main theme options
     *
     * @var Object
     **/
    public $options;

    /**
     * Constructior, called if the theme is_admin by †he main Theme class
     *
     * @since 1.0
     * @param array $options array of all theme options to use in construction this theme
     */
    function __construct( $theme ) {
        global $oxy_theme_version;
        $oxy_theme_version = '1.5.8';

        $this->theme = $theme;
        // load admin defines
        $this->defines();
        // initialise admin
        add_action('admin_init', array( &$this , 'admin_init' ) );
        // enqueue option page scripts
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        // create theme options
        $this->options = new OxyOptions( $theme->theme['option-pages'] );

        $this->register_metaboxes();

    }

    /**
     * called on admin_init
     *
     * @since 1.0
     */
    function admin_init() {
        // register admin js & css
        $this->register_resources();
        // initialise media upload class ( for media options )
        require_once ADMIN_DIR . 'media-upload.php';
        $media_upload = new OxyMediaUpload();

        require_once ADMIN_SC_DIR . 'shortcode-admin.php';
        $shortcode_admin = new ShortcodeAdmin( $this->theme );
    }

    function defines() {
        define( 'ADMIN_SC_DIR', ADMIN_DIR . 'shortcodes/' );
        define( 'ADMIN_IMAGES_URI', THEME_URI . '/inc/core/images/' );
    }

    function register_resources() {
        // register a ui theme css
        wp_register_style( 'jquery-ui-theme', ADMIN_CSS_URI . 'jquery-ui/smoothness/theme.min.css' );

        wp_register_style( 'oxy-option-page', ADMIN_CSS_URI . 'options/oxy-option-page.css' );
    }

    function check_theme_compatible() {
        $version = get_bloginfo( 'version' );
        $this->errors = array();

        if( version_compare( $version, $this->options['min_wp_ver'], '<' ) ) {
            $this->errors[] = sprintf( __('Version %s is incompatible with this theme minimum version %s', THEME_ADMIN_TD), $version, $this->options['min_wp_ver'] );
        }

        if( !empty( $this->errors ) ) {
            add_action( 'init', array( &$this, 'admin_warning' ) );
        }

    }

    function admin_enqueue_scripts( $hook ) {
        global $pagenow;
        if( 'admin.php' == $pagenow || 'post-new.php' == $pagenow || 'post.php' == $pagenow ) {
            $screen = get_current_screen();
            // enqueue script only for pages.
            switch( $screen->id ) {
                case 'page':
                case 'oxy_timeline':
                    wp_enqueue_script( 'oxy-ajax-metaboxes-page', INCLUDES_URI . 'options/metaboxes/ajax-metaboxes-page.js' , array('jquery', 'rwmb-map') );
                    wp_localize_script( 'oxy-ajax-metaboxes-page', 'theme', THEME_SHORT );
                break;
                case 'oxy_slideshow_image':
                    wp_enqueue_script( 'oxy-ajax-metaboxes-slideshow', INCLUDES_URI . 'options/metaboxes/ajax-metaboxes-slideshow.js' , array('jquery') );
                    wp_localize_script( 'oxy-ajax-metaboxes-slideshow', 'theme', THEME_SHORT );
                break;
                case 'oxy_portfolio_image':
                    wp_enqueue_script( 'oxy-ajax-metaboxes-page', INCLUDES_URI . 'options/metaboxes/ajax-metaboxes-page.js' , array('jquery', 'rwmb-map') );
                    wp_enqueue_script( 'oxy-ajax-metaboxes-portfolio-image', INCLUDES_URI . 'options/metaboxes/ajax-metaboxes-portfolio-image.js' , array('jquery') );
                    wp_localize_script( 'oxy-ajax-metaboxes-page', 'theme', THEME_SHORT );
                    wp_localize_script( 'oxy-ajax-metaboxes-portfolio-image', 'theme', THEME_SHORT );
                break;
                case 'oxy_service':
                    wp_enqueue_script( 'oxy-ajax-metaboxes-page', INCLUDES_URI . 'options/metaboxes/ajax-metaboxes-page.js' , array('jquery', 'rwmb-map') );
                    wp_localize_script( 'oxy-ajax-metaboxes-page', 'theme', THEME_SHORT );
                    wp_enqueue_script( 'oxy-ajax-metaboxes-slideshow', INCLUDES_URI . 'options/metaboxes/ajax-metaboxes-slideshow.js' , array('jquery') );
                    wp_localize_script( 'oxy-ajax-metaboxes-slideshow', 'theme', THEME_SHORT );
                break;
            }
        }
    }

    function admin_warning() {
        $msg = '<div class="error">';
        foreach( $this->errors as $error ) {
            $msg .= '<p>' . $error . '</p>';
        }
        $msg .=  '</div>';
        echo $msg;
    }

    function register_metaboxes(){
        // Include the meta box script
        require_once MODULES_DIR . 'meta-box/meta-box.php';
        include OPTIONS_DIR . '/metaboxes/theme-metaboxes.php';
    }
}
