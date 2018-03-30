<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

/**
 * Add a page option in admin area
 *
 * @class YIT_Panel
 * @package    Yithemes
 * @since      1.0.0
 * @author     Your Inspiration Themes
 */
class YIT_Panel extends YIT_Object {

    /**
     * Submenu Pages
     *
     * @var array an array contains a list of submenu pages
     */
    protected $_submenuPages = array();

    /**
     * Theme Options file
     *
     * @var string Path to 'panel.php' file
     */
    protected $_panelFile = '/panel/panel.php';

    /**
     * Theme Options
     *
     * @var array
     */
    protected $_panel = array();

    /**
     * Theme info
     *
     * @var WP_Theme
     */
    public $theme;

     /**
     * Panel css selectors
     *
     * @var array
     */
    protected $_css_rules = array();

    /**
     * Constructor
     *
     * @since  Version 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function __construct() {
        $this->theme = wp_get_theme();

        //actions
        add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
        add_action( 'admin_menu', array( $this, 'add_submenu_page' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    /**
     * Create the theme menu in admin area
     *
     * In order to load new submenu pages just add a new class within
     * the panel/ folder in core or theme.
     *
     * @since  Version 2.0.0
     * @return void
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function add_menu_page() {
        $logo = YIT_CORE_ASSETS_URL . '/images/yithemes-icon.png';

        $admin_logo = yit_get_option( "admin-logo-menu" );

        if ( isset( $admin_logo ) && ! empty( $admin_logo ) && $admin_logo != "" ) {
            $logo = $admin_logo;
        }

        //create menu page
        add_menu_page(
            $this->theme->Name,
            $this->theme->Name,
            'manage_options',
            'yit_panel',
            NULL,
            $logo,
            61
        );

        //load new sub menu pages
        $submenuPaths = apply_filters( 'yit_panel_submenu_paths', array(
            YIT_THEME_PATH . '/yit/panel',
            YIT_CORE_PATH . '/yit/panel',
        ) );

        foreach ( $submenuPaths as $path ) {
            $path .= '/*.php';
            foreach ( (array) glob( $path ) as $submenu ) {
                if ( !$submenu ) { continue; }

                $class                                 = 'YIT_Panel_' . basename( $submenu, '.php' );
                
                if ( ! class_exists( $class  ) ) {
                    include_once $submenu;
                    $class                                 = new $class();
                    $this->_submenuPages[ $class->priority ] = $class;
                }
            }
        }
    }

    /**
     * Add submenu pages
     *
     * @since  Version 2.0.0
     * @return void
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function add_submenu_page() {
        ksort( $this->_submenuPages );
        foreach ( $this->_submenuPages as $submenu ) {
            add_submenu_page(
                'yit_panel',
                $submenu->page_title,
                $submenu->menu_title,
                'manage_options',
                $submenu->slug,
                array( $submenu, 'display_page' )
            );
        }
    }

    /**
     * Get Theme Options From File
     *
     * @TODO: load files only if YIT_DEBUG = true or theme updated
     *
     * @return array
     * @since  2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function get_panel() {
        if ( ! empty( $this->_panel ) ) {
            return $this->_panel;

        } elseif ( ! is_admin() && false !== get_transient('yit_panel') ) {
            $this->_panel = get_transient('yit_panel');
            return $this->_panel;
        }

        return $this->get_theme_options_from_files();
    }

    /**
     * Retrieve theme options from setting files
     *
     * @return array
     * @since  2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function get_theme_options_from_files() {
        if ( empty( $this->_panel ) ) {
            $panel = include_once YIT_THEME_PATH . $this->_panelFile;
            $template_paths = apply_filters( 'yit_panel_template_paths', array(YIT_THEME_PATH) );

            if ( isset( $panel ) && ! empty( $panel ) ) {
                foreach ( $panel as $folder => $tabs ) {
                    foreach ( $tabs as $tab => $subtabs ) {
                        foreach ( $subtabs as $subtab ) {
                            foreach( $template_paths as $path ){
                                $file = $path . '/panel/' . $folder . '/' . $tab . '/' . $subtab . '.php';
                                if ( file_exists( $file ) ) {
                                    $this->_panel[ $folder ][ $tab ][ $subtab ] = include $file;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }

        set_transient( 'yit_panel', $this->_panel );

        return $this->_panel;
    }

    /**
     * Enqueue scripts and stylesheets
     *
     * @param $hook
     *
     * @since  Version 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @return void
     */
    public function enqueue( $hook ) {
        wp_enqueue_style( 'yit-panel', YIT_CORE_ASSETS_URL . '/css/panel.css' );


        if ( strpos( YIT_Request()->get('page'), 'yit_panel' ) !== false ) {

            wp_enqueue_style( 'jquery-ui-overcast', YIT_CORE_ASSETS_URL . '/css/overcast/jquery-ui-1.8.9.custom.css', false, '1.8.9', 'all' );
            wp_enqueue_style( 'yit-font-awesome', YIT_CORE_ASSETS_URL . '/css/font-awesome.min.css', false, '', 'all' );
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_media();

            wp_enqueue_script( 'jquery-ui' );
            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script( 'jquery-ui-mouse' );
            wp_enqueue_script( 'jquery-ui-button' );
            wp_enqueue_script( 'jquery-ui-dialog' );
            wp_enqueue_script( 'jquery-ui-slider' );
            wp_enqueue_script( 'jquery-ui-widget' );
            wp_enqueue_script( 'jquery-ui-sortable' );

            $wp_enqueue_script = function_exists( 'yit_enqueue_script' ) ? 'yit_enqueue_script' : 'wp_enqueue_script';

            $wp_enqueue_script( 'yit-panel', YIT_CORE_ASSETS_URL . '/js/admin/panel.js', array( 'jquery' ), YIT_CORE_VERSION, true );
            $wp_enqueue_script( 'yit-spinner', YIT_CORE_ASSETS_URL . '/js/admin/panel.spinner.js', array( 'jquery' ), '0.0.1', true );
            $wp_enqueue_script( 'yit-typography', YIT_CORE_ASSETS_URL . '/js/admin/panel.typography.js', array( 'jquery' ), '0.0.1', true );
            $wp_enqueue_script( 'yit-types', YIT_CORE_ASSETS_URL . '/js/admin/panel.types.js', array( 'jquery', 'wp-color-picker' ), YIT_CORE_VERSION, true );

            wp_localize_script( 'yit-panel', 'yit_panel_l10n', array(
                'submit_loading' => __( 'Loading...', 'yit' ),
                'yit_panel_refresh_color_nonce' => YIT_Request()->create_nonce('refresh-color')
            ) );
        }
    }

    /**
     * Enqueue scripts and stylesheets
     *
     * @param string|\the $key   the array key to search
     * @param string|\the $value the value of array key to search
     *
     * @since  Version 2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @return mixed array
     */
    public function get_option_by( $key='css', $value='all' ) {

        $return = array();
        foreach ( $this->get_panel() as $subpage => $page_options ) {
            foreach ( $page_options as $tab_path => $options ) {
                if ( empty( $options ) ) {
                    continue;
                }
                foreach ( $options as $option ) {
                    foreach ( $option as $index => $attribute ) {
                        if( $key == 'css' && $value == 'all' ) {
                            $return[] = $option[$index];
                        } elseif ( isset( $option[ $index ][ $key ] ) && $option[ $index ][ $key ] == $value ) {
                            $return[] = $option[$index];
                        }
                    }
                }
            }
        }
        return $return;
    }

    /* Return the specif css selectors for the theme options general
     *
     * @param string|\the $key   the array key to search
     *
     * @since  Version 2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
     * @return string
     */
    public function get_selectors( $id ){

        if( empty( $this->_css_rules ) ){
            $this->_css_rules = include_once( YIT_THEME_PATH . '/css-selectors.php' );
        }

        return $this->_css_rules[ $id ];
    }
}

if ( ! function_exists( 'YIT_Panel' ) ) {
    /**
     * Return the instance of YIT_Panel class
     *
     * @return \YIT_Panel
     * @since    2.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function YIT_Panel() {
        return YIT_Registry::get_instance()->panel;
    }
}

