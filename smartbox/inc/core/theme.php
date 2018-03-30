<?php
/**
 * Main theme class file
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

/**
 * Main theme bootstrap class.
 *
 * @since 1.0
 */
class OxyTheme
{
    /**
     * Holds array of all theme options
     *
     * @since 1.0
     * @access public
     * @var array
     */
    public $theme;


    /**
     * Constructior, this should be called from functions.php in a theme or child theme
     *
     * @since 1.0
     * @param array $theme array of all theme options to use in construction this theme
     */
    function __construct( $theme ) {
        // store theme options
        $this->theme = $theme;

        // load theme defines
        $this->defines();

        // load textdomains for admin / front
        if( is_admin() ) {
            load_theme_textdomain( THEME_ADMIN_TD, get_template_directory().'/inc/languages');
        }
        else {
            load_theme_textdomain( THEME_FRONT_TD, get_template_directory().'/languages');
        }

        // call init function on init
        add_action( 'init', array( &$this, 'init' ) );
        add_action( 'widgets_init', array( &$this, 'load_widgets' ) );

        // load admin class if we are admin
        if( is_admin() ) {
            include CORE_DIR . 'admin/themeadmin.php';
            $admin = new OxyThemeAdmin( $this );
        }

        // load theme options
        global $oxy_theme_options;
        $oxy_theme_options = get_option( THEME_SHORT . '-options' );

        // add sidebars
        $this->load_sidebars();

        // load admin bar
        add_action( 'admin_bar_menu', array( &$this, 'admin_bar_menu' ), 81 );


        // auto install stuff on theme activation
        add_action('after_switch_theme',  array( &$this, 'on_theme_install' ));
    }

    /**
     * Creates all #defines for the theme
     *
     * @since 1.0
     */
    function defines() {
        // create defines
        define( 'THEME_NAME', $this->theme['theme_name'] );
        define( 'THEME_SHORT', $this->theme['theme_short'] );

        // directories
        define( 'THEME_DIR', get_template_directory() );

        define( 'INCLUDES_DIR', THEME_DIR . '/inc/' );
        //define( 'CACHE_DIR', THEME_DIR . '/cache/' );

        define( 'MODULES_DIR', INCLUDES_DIR . 'modules/' );
        define( 'CORE_DIR', INCLUDES_DIR . 'core/' );
        define( 'OPTIONS_DIR', INCLUDES_DIR . 'options/' );

        define( 'WIDGETS_DIR', OPTIONS_DIR . 'widgets/' );

        define( 'ADMIN_DIR', CORE_DIR . 'admin/' );
        define( 'ADMIN_OPTIONS_DIR', CORE_DIR . 'options/' );
        define( 'ADMIN_FORMS_DIR', ADMIN_DIR . 'forms/' );

        // core directories
        //define( 'CLASSES_DIR', CORE_DIR . 'classes/' );

        // URIs
        define( 'THEME_URI', get_template_directory_uri());
        define( 'INCLUDES_URI', THEME_URI . '/inc/' );

        define( 'ADMIN_OPTIONS_URI', INCLUDES_URI . 'core/options/' );

        define( 'MODULES_URI', THEME_URI . '/inc/modules/' );
        define( 'IMAGES_URI', THEME_URI . '/images/' );
        define( 'JS_URI', THEME_URI . '/javascripts/' );
        define( 'CSS_URI', THEME_URI . '/stylesheets/' );
        //define( 'CACHE_URI', THEME_URI . '/cache/' );

        define( 'ADMIN_ASSETS_URI', THEME_URI . '/inc/core/admin/assets/' );
        define( 'ADMIN_JS_URI', ADMIN_ASSETS_URI . 'js/' );
        define( 'ADMIN_CSS_URI', ADMIN_ASSETS_URI . 'css/' );


        // text domains
        define( 'THEME_FRONT_TD', 'frontend_' . $this->theme['text_domain'] );
        define( 'THEME_ADMIN_TD', 'admin_' . $this->theme['text_domain'] );
    }

    /**
     * Initialise theme
     *
     * @return void
     * @since 1.0
     **/
    function init() {
        $this->load_shortcodes();
    }


    function load_sidebars() {
        foreach( $this->theme['sidebars'] as $id => $info ) {
            if ($id == 'footer'){
                global $oxy_theme_options;
                $footer_columns = $oxy_theme_options['footer_columns'];
                if( $footer_columns == 3 ){
                    $this->register_sidebar( 'Footer middle', 'Middle footer section', '', 'footer-middle');
                }
                else if( $footer_columns == 4 ){
                    $this->register_sidebar( 'Footer middle-left', 'Middle-left footer section', '', 'footer-middle-left');
                    $this->register_sidebar( 'Footer middle-right', 'Middle-right footer section', '', 'footer-middle-right');
                }
            }
            else{
                $this->register_sidebar( $info[0], $info[1], '', $id );
            }
        }
    }

    function register_sidebar( $name , $desc='' , $class='', $id=null ) {
        if ($class == 'widget_tag_cloud'){
            $class = 'tags-widget';
        }
        $options = array(
            'name' => $name,
            'description'=> $desc,
            'before_widget' => '<div id="%1$s" class="sidebar-widget ' . $class  . ' %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="sidebar-header">',
            'after_title' => '</h3>',
        );
        if( null !== $id ) {
            $options['id'] = $id;
        }
        register_sidebar( $options );
    }

    function load_widgets() {
        // load default overrides
        require_once WIDGETS_DIR . 'default_overrides.php';
        // load theme specific widgets
        if( isset( $this->theme['widgets'] ) ) {
            foreach( $this->theme['widgets'] as $class => $file ) {
                require_once WIDGETS_DIR . $file;
                register_widget( $class );
            }
        }
    }

    function load_shortcodes() {
        require_once OPTIONS_DIR . 'shortcodes/shortcodes.php';
    }

    /**
     * Adds theme options to admin bar
     *
     * @since 1.0
     */
    function admin_bar_menu( $wp_admin_bar ) {
        if( !is_super_admin() || !is_admin_bar_showing() || !current_user_can("manage_options") ) {
            return;
        }
        global $wp_admin_bar;
        // load all page data
        $pages = array();
        foreach( $this->theme['option-pages'] as $option_page_file ) {
            $page_data = include OPTIONS_DIR . 'option-pages/' . $option_page_file . '.php';
            if( $page_data !== false ) {
                $pages[] = $page_data;
            }
        }

        // create base main menu
        foreach( $pages as $page_data ) {
            if( $page_data['main_menu'] == true ) {
                $wp_admin_bar->add_node( array( 'id' => THEME_SHORT , 'title' => THEME_NAME . ' ' . __('Theme', THEME_ADMIN_TD) , 'href' => admin_url( 'admin.php?page=' . $page_data['slug'] ) ) );
                break;
            }
        }

        // get dashboard menu and add all submenus to the admin bar using admin-menu as a parent menu
        foreach( $pages as $page_data ) {
            $wp_admin_bar->add_node( array( 'id' => $page_data['slug'], 'title' => $page_data['menu_title'], 'href' => admin_url( 'admin.php?page=' . $page_data['slug'] ), 'parent' => THEME_SHORT ) );

        }
    }

    function on_theme_install(){
    }
}