<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

class UT_Theme_Options {
    
    /**
     * Option Array
     * @var array
     */
    private $options;
    
    /**
     * Settings Array
     * @var array
     */
    private $settings;
                    
    /**
     * Theme Options Title
     * @var string
     */
    protected $title;
    
    /**
     * Theme Options Page Slug
     * @var string
     */
    protected $menu_slug;
            
    /**
     * Constructor
     * @since     1.0.0
     * @version   1.1.0
     */
    public function __construct() {
        
        /* set title */
        $this->title = esc_html__( 'Theme Options', 'unite-admin' );
        
        /* set menu slug */
        $this->menu_slug = ut_options_key_slug();
        
        /* set options */
        $this->options = get_option( ut_options_key() );
        
        /* get settings */
        $this->settings = apply_filters( 'unite_framework_theme_settings', array() );
        
        /* load theme options */
        $this->hooks();            
                    
    }
    
    /**
     * Initiate our hooks
     * @since     1.0.0
     * @version   1.0.0
     */
    public function hooks() {
        
        /* add menu item to dashbaord */
        add_action( 'admin_menu', array( $this, 'add_options_page' ) );
       
        /* register settings */
        add_action( 'admin_init', array( $this, 'register_setting' ) );
        
        /* register sections */
        add_action( 'admin_init', array( $this, 'add_sections' ) );
  
        /* register settings */
        add_action( 'admin_init', array( $this, 'add_settings' ) );  
        
    }
            
    /**
     * Add to WordPress Menu 
     * @since     1.0.0
     * @version   1.0.0
     */
    public function add_options_page() {
        
        $this->options_page = add_submenu_page('unite-welcome-page', $this->title, $this->title, 'manage_options', $this->menu_slug, array( $this, 'admin_page_display' ) );
        
    }
    
    /**
     * Admin page markup
     * @since     1.0.0
     * @version   1.0.0
     */
    public function admin_page_display() { 
    
    ?>
            
        <!-- Start UT-Backend-Wrap -->
        <div class="ut-admin-wrap ut-admin-with-navigation clearfix" data-cookiekey="ut_theme_options_nav">
            
            <div id="ut-tool-bar" class="ut-tool-bar">
                
                <a id="ut-toolbar-save-theme-options" href="#">
                
                    <span class="ut-tool-bar-icon">
                        <i class="fa fa-floppy-o"></i>
                    </span>
                    
                    <span class="ut-tool-bar-icon-text"><?php esc_html_e( 'Save Options', 'unite-admin' ); ?></span>
                
                </a>    
                                
            </div>
            
            <?php $this->do_add_settings_section(); ?>
            
        </div>
        <!-- Close UT-Backend-Wrap -->
        
    <?php 
    
    }
    
    /**
     * Layout Form
     * @since     1.0.0
     * @version   1.1.0
     */
    public function layout_change_form() {
        
        $layouts = get_option( ut_options_layout_key() ); 
        $current = get_option( 'unite_current_options_layout' ); ?>
                
        <!-- Start UT-Layout Changer --> 
        <div class="unite-layout-manager" style="display:none;">
        
            <form id="unite-layout-manager" method="post">
                
                <header class="ut-admin-header clearfix">
                
                    <h3>
                        <?php esc_html_e( 'Manage Layouts', 'unite-admin' ); ?>
                    </h3>
                    
                    <div class="ut-manager-badge">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    
                    <a class="ut-backend-button ut-green-button ut-close-manage-layouts" href="#"><i class="fa fa-times"></i><?php esc_html_e( 'Close', 'unite-admin' ); ?></a>
                    
                </header>                
                                        
                <div class="ut-admin-panel-content grid-30 grid-parent">
                    
                    <input type="text" class="ut-option-element ut-full-width" name="layout_name" autocomplete="off">                                                           
                    <a class="ut-backend-button ut-gray-button ut-add-theme-layout" href="#"><?php esc_html_e( 'Add New Layout', 'unite-admin' ); ?></a>
                        
                </div>
                
                <div class="ut-admin-panel-content grid-70 grid-parent">
                    
                    <ul id="unite-theme-layouts">
                       
                        <li class="clearfix">
                            
                            <h4><?php esc_html_e( 'Default', 'unite-admin' ); ?></h4>
                            
                            <div class="ut-layout-actions">
                                
                                <a title="<?php esc_html_e( 'copy layout', 'unite-admin' ); ?>" 
                                   class="ut-backend-button ut-blue-button ut-layout-action" 
                                   data-layout-key="default"
                                   data-layout-action="copy_theme_layout" 
                                   data-message="<?php esc_html_e( 'Duplicate this layout?', 'unite-admin' ); ?>" href="#"><i class="fa fa-files-o"></i>
                                </a>
                                
                                <a title="<?php esc_html_e( 'preview layout', 'unite-admin' ); ?>" 
                                   class="ut-backend-button ut-gray-button" 
                                   target="_blank" 
                                   href="<?php echo get_site_url(); ?>?unite_preview_layout=default"><i class="fa fa-eye"></i>
                                </a>
                                
                                <?php $checked = empty( $current ) ? 'checked="checked"' : checked( $current, 'default', false ); ?>
                                
                                <input <?php echo $checked; ?> 
                                   id="default-layout" 
                                   class="ut-layout-action" 
                                   type="radio"
                                   data-layout-key="default"
                                   data-layout-action="activate_theme_layout"  
                                   data-message="<?php esc_html_e( 'Activate this layout?', 'unite-admin' ); ?>" 
                                   name="<?php echo ut_options_layout_key(); ?>" 
                                   value="default">
                                <label for="default-layout"></label>
                                
                            </div>
                                
                            
                        </li> 
                        
                        <?php if( !empty( $layouts ) && is_array( $layouts ) ) : ?>
                            
                            <?php foreach( $layouts as $key => $layout ) : ?>
                                
                                <li class="clearfix">
                                    
                                    <div class="ut-layout-title-wrap">
                                        
                                        <h4><?php echo $layout; ?></h4>
                                        <input id="ut-title-<?php echo esc_attr( $key ); ?>"
                                               type="text" 
                                               class="ut-option-element ut-layout-title hidden" 
                                               value="<?php echo $layout; ?>"
                                               readonly="readonly">
                                    
                                    </div>
                                    
                                    <div class="ut-layout-actions">
                                        
                                        <a title="<?php esc_html_e( 'rename layout', 'unite-admin' ); ?>" 
                                           class="ut-layout-action ut-backend-button ut-blue-button" 
                                           data-layout-key="<?php echo esc_attr( $key ); ?>" 
                                           data-layout-action="rename_theme_layout" 
                                           data-message="<?php esc_html_e( 'Rename this layout?', 'unite-admin' ); ?>" href="#"><i class="fa fa-pencil"></i>
                                        </a>
                                        
                                        <a title="<?php esc_html_e( 'copy layout', 'unite-admin' ); ?>" 
                                           class="ut-layout-action ut-backend-button ut-blue-button" 
                                           data-layout-key="<?php echo esc_attr( $key ); ?>" 
                                           data-layout-action="copy_theme_layout" 
                                           data-message="<?php esc_html_e( 'Duplicate this layout?', 'unite-admin' ); ?>" href="#"><i class="fa fa-files-o"></i>
                                        </a>
                                            
                                        <a title="<?php esc_html_e( 'preview layout', 'unite-admin' ); ?>" 
                                           class="ut-backend-button ut-gray-button" 
                                           target="_blank" 
                                           href="<?php echo get_site_url(); ?>?unite_preview_layout=<?php echo esc_attr( $key ); ?>"><i class="fa fa-eye"></i>
                                        </a>
                                           
                                        <a title="<?php esc_html_e( 'delete layout', 'unite-admin' ); ?>" 
                                           class="ut-backend-button ut-red-button ut-layout-action" 
                                           data-layout-key="<?php echo esc_attr( $key ); ?>" 
                                           data-layout-action="delete_theme_layout" 
                                           data-message="<?php esc_html_e( 'Delete this layout? This cannot be undone!', 'unite-admin' ); ?>" href="#"><i class="fa fa-trash-o"></i>
                                        </a>
                                        
                                        <input <?php checked( $current, $key ); ?> 
                                           id="<?php echo esc_attr( $key ); ?>" 
                                           class="ut-layout-action" 
                                           type="radio" 
                                           data-layout-key="<?php echo esc_attr( $key ); ?>"
                                           data-layout-action="activate_theme_layout"  
                                           data-message="<?php esc_html_e( 'Activate this layout?', 'unite-admin' ); ?>" 
                                           name="<?php echo ut_options_layout_key(); ?>" 
                                           value="<?php echo esc_attr( $key ); ?>">
                                        <label for="<?php echo esc_attr( $key ); ?>"></label>
                                        
                                    </div>
                                               
                                </li>
                                
                                    
                            <?php endforeach; ?>
                            
                        <?php endif; ?>
                    
                    </ul>                    
                    
                </div>
                
                <div class="clear"></div>            
            
            </form>
        
        </div>
        <!-- Close UT-Layout Changer -->
                
        <?php
    
    }
    
    public function switch_layout_key( $key ) {
        
        
    
    }    
    
    /**
     * Register our setting to WP
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_setting() {
        
        register_setting( 
            ut_options_key(), 
            ut_options_key(),
            array ( $this, 'sanitize_callback' )
        );    
        
    }
    
    /**
     * Add settings
     *
     * @return    void
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */
    public function add_sections() {
        
        /* theme options */
        foreach( (array) $this->settings as $key => $sections ) {
            
            if( 'sections' == $key ) {
                 
                 foreach( $sections as $section ) {
                                    
                     add_settings_section(
                        $section['id'],
                        $section['title'],
                        array( $this, 'display_section' ),
                        $this->menu_slug
                     );
                     
                     if ( isset( $section['subsections'] ) && is_array( $section['subsections'] ) && !empty( $section['subsections'] ) ) {
                                                    
                        foreach( $section['subsections'] as $subsection ) {
                                    
                            /* no section id or title - continue to next */
                            if ( ! isset( $subsection['id'] ) || ! isset( $subsection['title'] ) ) {
                                continue;
                            }
                                                                        
                            add_settings_section(
                                $subsection['id'],
                                $subsection['title'],
                                array( $this, 'display_section' ),
                                $this->menu_slug
                            );
                                                       
                        } /* endforeach */
                     
                     } /* endif */
                 
                 } /* endforeach */
                
            } /* endif */
                        
        } /* endforeach */        
        
    }
            
    /**
     * Add settings
     *
     * @return    void
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */
    public function add_settings($field) {
        
        /* theme options */
        foreach( (array) $this->settings as $key => $setting ) {
            
            if( 'settings' == $key ) {
                
                foreach($setting as $field) {
                    
                    add_settings_field(
                        $field['id'], 
                        $field['title'], 
                        array( $this, 'prepare_settings_field' ),
                        $this->menu_slug,
                        $field['section'],
                        $field
                    );
                
                }
                
            }
        
        }
    
    }    
    
    /**
     * Callback for add_settings_field() to build setting
     *
     * @param     array     Setting object array
     * @return    string
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */        
    public function prepare_settings_field( $args = array() ) {
        
        /* prepare args for this option field */
        $option_args = ut_prepare_settings_field( $args, 'theme_options', ut_options_key() );
       
        /* render option field */
        $this->option_callback( $option_args );
    
    }
    
    /**
     * create submenu and deepmenu for main navigation
     *
     * @param     array     Setting object array
     * @return    string
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */  
    public function create_sub_menu( $section, $deep = FALSE ) {
        
        global $wp_settings_sections;
        
        if ( isset( $section['subsections'] ) && is_array( $section['subsections'] ) && !empty( $section['subsections'] ) ) {
            
            $menu_class = $deep ? 'ut-backend-main-navigation-deepmenu' : 'ut-backend-main-navigation-submenu' ;
                                    
            echo '<ul class="' , $menu_class , '">';
            
                foreach( $section['subsections'] as $subsection ) {
                    
                    /* no section id - continue to next */
                    if ( ! isset( $subsection['id'] ) || ! isset ( $subsection['title'] )  ) {
                        continue;
                    }
                    
                    /* check if setting is registered */
                    if( array_key_exists( $section['id'] , (array) $wp_settings_sections[$this->menu_slug] ) ) { 
                        
                        if( !$deep ) {
                            
                            echo '<li><a data-lvl="2" data-title="' , $subsection['title'] , '" data-panel="' , $subsection['id'] , '" data-panel-loaded="" href="#"><i class="fa fa-angle-right"></i>' , $subsection['title'] , '</a></li>';
                            
                        } else {
                            
                            echo '<li><a data-lvl="3" data-title="' , $subsection['title'] , '" data-panel="' , $subsection['id'] , '" data-panel-loaded="" href="#"><i class="fa fa-caret-right"></i>' , $subsection['title'] , '</a></li>';
                            
                        }
                        
                        $this->create_sub_menu( $subsection, true );
                        
                    }
                    
                }
            
            echo '</ul>';
        
        }
    
    }
    
    /**
     * Prints out all settings sections added to our settings page
     *
     * @global    $wp_settings_sections   Storage array of all settings sections added to admin pages
     * @global    $wp_settings_fields     Storage array of settings fields and info about their pages/sections
     *
     * @return    string
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */         
    public function do_add_settings_section() {
        
        global $wp_settings_sections, $wp_settings_fields;

        if ( ! isset( $wp_settings_sections ) || ! isset( $wp_settings_sections[$this->menu_slug] ) ) {
            return false;
        }
        
        /* wpml language settings */
        $language_settings = ut_language_defaults();
        
        /* store active section */
        $active_section = isset( $_COOKIE['ut_theme_options_nav'] ) ? $_COOKIE['ut_theme_options_nav'] : ''; ?>
        
        <?php if( !empty( $language_settings ) && ( $language_settings['default'] != $language_settings['current'] ) ) : ?>
        
        <div class="grid-100">
            
            <div class="ut-alert ut-alert-info"><?php esc_html_e( 'You have switched to a secondary language. In order to translate the Theme Option Panel please use WPML String Translation.','unite-admin' ); ?></div>
            
        </div>              
        
        <?php endif; ?>
                    
        <div class="ut-backend-top-bar clearfix">
            
            <a class="ut-backend-logo hide-on-tablet hide-on-mobile" href="<?php echo get_admin_url(); ?>admin.php?page=unite-welcome-page" title="UnitedThemes">
                <img src="<?php echo FW_WEB_ROOT . '/core/admin/assets/img/ut_logo_white.png'; ?>" alt="United Themes" />
            </a>
            
            <h2>
                <?php echo $this->title; ?>                    
            </h2>
            
            <span class="hide-on-tablet hide-on-mobile">by United Themes - Framework Version: <?php echo UT_VERSION; ?></span>
            
            <div class="ut-backend-top-bar-actions">
                
                <a class="ut-backend-button ut-green-button hide-on-tablet hide-on-mobile ut-manage-layouts" title="<?php esc_html_e( 'Manage Layouts', 'unite-admin' ); ?>"><i class="fa fa-list-alt"></i><?php esc_html_e( 'Manage Layouts', 'unite-admin' ); ?></a>
                <button form="unite-theme-options" name="submit" id="submit" class="ut-backend-button ut-blue-button hide-on-desktop" type="submit"><?php esc_html_e( 'Save', 'unite-admin' ); ?></button>
                
            </div>                
            
        </div>
        <!-- Close UT-Backend-Topbar -->
        
        <?php $this->layout_change_form(); ?>        
                
        <!-- Start UT-Backend-Navigation -->
        <div class="ut-backend-navigation-wrap">
            
            <ul class="ut-backend-main-navigation">
            
            <?php
            
            /* loop trough available section */
            foreach( (array) $this->settings as $key => $sections ) {
                
                if( 'sections' == $key ) {
                    
                    $menu_counter = 1;
                     
                    foreach( $sections as $section ) {
                        
                        /* no section id - continue to next */
                        if ( ! isset( $section['id'] ) || ! isset( $section['title'] ) ) {
                            continue;
                        } 
                        
                        /* check if setting is registered */
                        if( array_key_exists( $section['id'] , (array) $wp_settings_sections[$this->menu_slug] ) ) { 
                            
                            $current       = ( $active_section == $section['id'] ) ? 'ut-current' : '' ;
                            $fallback      = ( $menu_counter == 1 ) ? 'ut-menu-fallback-item' : '';

                            // $submenu_state = ( $active_section == $section['id'] ) ? 'ut-show' : 'ut-hide'; 
                                
                            echo '<li class="' , $current , '">';
                                
                                echo '<a class="' , $fallback , '" data-lvl="1" data-title="' , $section['title'] , '" data-panel="' , $section['id'] , '" href="#"><i class="fa ' , $section['icon'] , '"></i>' , $section['title'] , '</a>';
                                
                                $this->create_sub_menu( $section );
                            
                            echo '</li>';                          
                            
                            $menu_counter++;
                                    
                        } 
                        
                    } /* endforeach */
                    
                }
            
            } ?>
            
            </ul>
        </div>
        <!-- Close UT-Backend-Navigation -->
        
        <!-- Start UT-Admin-Main --> 
        <div class="ut-admin-main clearfix">
            
            <form id="unite-theme-options" method="post" action="options.php">
            
            <?php settings_fields( ut_options_key() ); ?>
                    
            <!-- Start UT-Admin-Header -->
            <header class="ut-admin-header hide-on-tablet hide-on-mobile clearfix">
                
                <h3 class="ut-admin-header-title">
                    Backend Topic Title
                    <!-- <span> Topic Title Description</span> //@todo -->
                </h3>
                
                <button name="submit" id="submit" class="ut-backend-button ut-blue-button ut-submit-button-top" type="submit"><?php esc_html_e( 'Save', 'unite-admin' ); ?></button>
                
            </header>
            <!-- Cose UT-Admin-Header -->
            
            <div class="ut-breadcrumb">
                
                <ul>
                    <li class="ut-breadcrumb-root"><i class="fa fa-globe"></i></li>
                    <li class="level-1"></li>
                    <li class="level-2"></li>
                    <li class="level-3 ut-hide"></li>
                </ul>
                
            </div>
            
            <?php 
            
            $section_counter = 1;
                
            foreach ( (array) $wp_settings_sections[$this->menu_slug] as $section ) {
                
                if( isset( $active_section ) && $active_section == $section['id'] ) {
            
                    $section_state_class = 'ut-show';
                
                } elseif( empty( $active_section ) && $section_counter == 1 ) {
                
                    $section_state_class = 'loaded';
                    
                } else {
                
                    $section_state_class = 'ut-hide';
                
                }
                        
                echo '<div class="ut-admin-panel-group ' , $section_state_class , '" id="' , $section['id'] , '">';
                
                    $this->do_add_settings_field( $section['id'] ); 
                
                echo '</div>';
                
                $section_counter++;
                
            } ?>
            
            </form>
            
        </div>                
        <!-- Close UT-Admin-Main -->
        
        <!-- <div class="ut-backend-footer-bar clearfix">
            
            Footer
        
        </div> -->
        
        
    <?php
    
    }
            
    /**
     * Print out the settings fields for a particular settings section
     *
     * @global    $wp_settings_fields Storage array of settings fields and their pages/sections
     *
     * @param     string    $page Slug title of the admin page who's settings fields you want to show.
     * @param     string    $section Slug title of the settings section who's fields you want to show.
     * @return    string
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */        
    public function do_add_settings_field( $section ) {
        
        global $wp_settings_fields;
       
        if ( !isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$this->menu_slug] ) || !isset( $wp_settings_fields[$this->menu_slug][$section] ) ) {
            return;
        }

        foreach ( (array) $wp_settings_fields[$this->menu_slug][$section] as $field ) {
            
            $class = isset( $field['args']['class'] ) ? $field['args']['class'] : '';
            
            if( $field['args']['type'] != 'info' ) {
                            
            echo '<section class="ut-admin-panel clearfix ' , esc_attr( $class ) , '">';
                               
                call_user_func( $field['callback'], $field['args'] );                
            
            echo '</section>';
            
            } else {
                
                call_user_func( $field['callback'], $field['args'] );
            
            }
            
        }                        
    
    }
    
    
    /**
     * Callback for add_settings_section()
     *
     * @return    string
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */
    public function display_section() { 
    
        /* nothing to do here */ 
        return;
    
    }        
    
    /**
     * Call function to render the option field
     *
     * @return    string
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */
    public function option_callback( $settings ) {
                    
        $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
       
        if ( function_exists( $function_by_type ) ) {

            $this->before_option_output( $settings );
                
                /* settings grid */
                $settings['grid'] = 'grid-60 mobile-grid-100';
                
                /* call function */
                if( function_exists( $function_by_type ) ) {
                    
                    call_user_func( $function_by_type, $settings, $settings['type'] );
                    
                } else {
                            
                    /* @todo - add error message markup */
                    esc_html_e( 'Function does not exist!', 'unite-admin' );
                    
                }
                
            $this->after_option_output( $settings );
            
        } else {
          
          echo '<p>' . esc_html( __( 'This function does not exist.', 'unite-admin' ) ) . '</p>';
          
        }

    }
    
    
    private function before_option_output( $settings ) {
        
        /* no header for special option types */
        if( $settings['type'] == 'info' ) {
            return;
        }
        
        /* render option*/        
        echo '<header class="ut-admin-panel-header grid-40 mobile-grid-100 clearfix" data-action="collapse" data-collapse-panel="' , $settings['id'] , '">';
            
            echo '<h3 class="ut-admin-panel-header-title ' , ( empty( $settings['desc'] ) ? 'no-description' : '' ) , '">' , $settings['title'] , '</h3>';
            
            if( !empty( $settings['desc'] ) ) {
                
                echo '<span class="ut-admin-panel-description">' , $settings['desc'] , '</span>';
                                
            }
            
            //echo '<div class="ut-admin-panel-actions"><a href="#"><i class="fa fa-angle-down"></i></a></div>';                
            
        echo '</header>';
    
    }
    
    
    private function after_option_output() {
           
        echo '<div class="clear"></div>';
    
    }
    
    /**
     * Sanitize callback for register_setting()
     *
     * @return    string
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */
    public function sanitize_callback( $input ) {
        
        $sanitized_options = array();
                    
        foreach( $input as $id => $value ) {                
            
            $sanitized_options[$id] = ut_sanitize_option( $value, $this->get_option_type( $id ), $id, 'theme_options' );
               
        }            
        
        return $sanitized_options;
        
    }
                
    /**
     * return option type by option id
     *
     * @return    string
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */        
    public function get_option_type( $id ) {
        
        if( empty( $id ) ) {
            return;
        }        
        
        foreach( (array) $this->settings as $key => $settings ) {
            
            if( 'settings' == $key ) {
                 
                 foreach( $settings as $setting ) {
                    
                    if( $id == $setting['id'] ) {
                        
                        return $setting['type'];
                        
                    }                           
                 
                 }
                
            }
                        
        }
    
    }        
    
    /**
     * returns an entire settings section on ajax request 
     *
     * @todo
     * @return    string
     *
     * @access    public
     * @since     1.1.0
     * @version   1.0.0
     */   
    
    public function load_settings_section() {
        
        global $wp_settings_sections, $wp_settings_fields;
        
        if ( ! isset( $wp_settings_sections ) || ! isset( $wp_settings_sections[$this->menu_slug] ) ) {
            return false;
        }   
        
        if( !isset( $_REQUEST['section_id'] ) || empty( $_REQUEST['section_id'] ) ) {
            return false;
        }
            
        foreach ( (array) $wp_settings_sections[$this->menu_slug] as $section ) {
            
            if( $_REQUEST['section_id'] == $section['id'] ) {
                
                echo '<div class="ut-admin-panel-group id="' . $section['id'] . '">';    
                
                    $this->do_add_settings_field( $section['id'] );    
                
                echo '</div>';        
                    
            }
        
        }
        
    }
    
    /**
     * Ajax JSON Response
     *
     * @return    void
     *
     * @access    public
     * @since     1.1.0
     * @version   1.0.0
     */
    public function ajax_json_message( $status = 'warning', $message = '' ) {
        
        if( empty( $message ) ) {
            return;
        }
        
        header( "Content-Type: application/json" );
        echo json_encode( array( 
            'status' => $status,
            'text'   => $message,  
        ) );
        
        exit;            
    
    }
    
    /**
     * Rename Theme Layout
     *
     * @return    void
     *
     * @access    public
     * @since     1.1.0
     * @version   1.0.0
     */
    public function rename_theme_layout() {
        
        /* get nonce */
        $nonce = $_REQUEST['save-nonce'];
                
        /* check if nonce is set and correct */
        if ( ! wp_verify_nonce( $nonce, 'unite-ajax-layout-change-nonce' ) ) {
            die ( 'Busted!');
        }
        
        if ( current_user_can( 'manage_options' ) ) {
            
            /* available layouts */
            $existing_layouts = get_option( ut_options_layout_key() );
            
            /* get layout id */
            $id       = mysql_real_escape_string( $_REQUEST['ut_layout_id'] );
            $new_name = mysql_real_escape_string( $_REQUEST['ut-layout-name'] );
            
            /* check if we have an existing layout */
            if( is_array( $existing_layouts ) && array_key_exists( $id, $existing_layouts )  ) {
                
                /* new name */
                $existing_layouts[$id] = $new_name;
                
                /* update layouts */
                update_option( ut_options_layout_key(), $existing_layouts );
                
                $this->ajax_json_message('success', esc_html__( 'Successfully renamed!', 'unite-admin' ) );
            
            }
        
        }
        
        exit;        
    
    }
    
    /**
     * Copy Theme Layout
     *
     * @return    void
     *
     * @access    public
     * @since     1.1.0
     * @version   1.0.0
     */
    public function copy_theme_layout() {
                
        /* get nonce */
        $nonce = $_REQUEST['save-nonce'];
                
        /* check if nonce is set and correct */
        if ( ! wp_verify_nonce( $nonce, 'unite-ajax-layout-change-nonce' ) ) {
            die ( 'Busted!');
        }
        
        if ( current_user_can( 'manage_options' ) ) {
            
            /* available layouts */
            $existing_layouts = get_option( ut_options_layout_key() );
            
            /* get layout id */
            $id = mysql_real_escape_string( $_REQUEST['ut_layout_id'] );
            
            /* check if we have an existing layout */
            if( is_array( $existing_layouts ) && array_key_exists( $id, $existing_layouts ) || $id == 'default' ) {
                
                $layout_to_copy = ( $id == 'default') ? ut_options_key() : $id;
                 
                if( get_option( $layout_to_copy ) ) {
                                        
                    $new_layout = uniqid( 'unite_theme_options_' );
                    
                    $existing_layouts[$new_layout] = isset( $existing_layouts[$id] ) ? $existing_layouts[$id] . '(copy)' :  'Default (copy)';
                    
                    /* copy settings */
                    update_option( $new_layout, get_option( $layout_to_copy ) );
                           
                    /* update layouts */                    
                    update_option( ut_options_layout_key(), $existing_layouts );                    
                    
                    $this->ajax_json_message('success', esc_html__( 'Layout copied!', 'unite-admin' ) );
                    
                }                
                
                
            }
            
        
        }
        
        exit;        
    
    }    
    
    /**
     * Delete Theme Layout
     *
     * @return    void
     *
     * @access    public
     * @since     1.1.0
     * @version   1.0.0
     */
    public function delete_theme_layout() {
                        
        /* get nonce */
        $nonce = $_REQUEST['save-nonce'];
                
        /* check if nonce is set and correct */
        if ( ! wp_verify_nonce( $nonce, 'unite-ajax-layout-change-nonce' ) ) {
            die ( 'Busted!');
        }
        
        if ( current_user_can( 'manage_options' ) ) {
        
            /* available layouts */
            $existing_layouts = get_option( ut_options_layout_key() );
            
            /* parse theme options data */
            $id = mysql_real_escape_string( $_REQUEST['ut_layout_id'] );
                        
            if( $id == "default" ) {
                
                $this->ajax_json_message('warning', esc_html__( 'You cannot delete the default layout!', 'unite-admin' ) );        
                
            }
            
            if( is_array( $existing_layouts ) && array_key_exists( $id, $existing_layouts ) ) {
                
                /* delete from existing layouts */                
                unset( $existing_layouts[$id] );
                
                /* update current layout */
                update_option( ut_options_layout_key(), $existing_layouts );
                
                /* leave here - default layout cannot be deleted */
                $this->ajax_json_message('warning', esc_html__( 'Layout has been deleted!', 'unite-admin' ) ); 
                            
            } else {
            
                /* leave here - no layout name submitted */
                $this->ajax_json_message('warning', esc_html__( 'This is not a valid layout!', 'unite-admin' ) );                           
            
            }
        
        }
                
        exit;    
    
    }
    
    /**
     * Activate Theme Layout
     *
     * @return    void
     *
     * @access    public
     * @since     1.1.0
     * @version   1.0.0
     */
    public function activate_theme_layout() {
        
        /* get nonce */
        $nonce = $_REQUEST['save-nonce'];
                
        /* check if nonce is set and correct */
        if ( ! wp_verify_nonce( $nonce, 'unite-ajax-layout-change-nonce' ) ) {
            die ( 'Busted!');
        }
        
        /* only proceed if current has permissions */
        if ( current_user_can( 'manage_options' ) ) {
        
            /* available layouts */
            $existing_layouts = get_option( ut_options_layout_key() );
            
            /* parse theme options data */
            $id = $_REQUEST['ut_layout_id'];
                                    
            if( is_array( $existing_layouts ) &&  array_key_exists( $id, $existing_layouts ) || $id == 'default' ) {
                
                if( get_option( 'unite_current_options_layout' ) ) {
                    
                    /* update current layout */
                    update_option( 'unite_current_options_layout', $id );
                    
                } else {
                    
                    /* add option the first time */
                    add_option( 'unite_current_options_layout', $id );
                
                }
                
                $this->ajax_json_message('success', esc_html__( 'Layout has been activated!', 'unite-admin' ) );
                
            } else {
                
                /* leave here - no layout name submitted */
                $this->ajax_json_message('warning', esc_html__( 'This is not a valid layout!', 'unite-admin' ) );                 
                            
            }
        
        }
        
        exit;    
    
    }
    
    /**
     * Save Theme Layouts
     *
     * @return    void
     *
     * @access    public
     * @since     1.1.0
     * @version   1.0.0
     */          
    public function save_theme_layouts() {
    
        /* get nonce */
        $nonce = $_REQUEST['save-nonce'];
        
        /* check if nonce is set and correct */
        if ( ! wp_verify_nonce( $nonce, 'unite-ajax-layout-change-nonce' ) ) {
            die ( 'Busted!');
        }
        
        /* only proceed if current has permissions */
        if ( current_user_can( 'manage_options' ) ) {
        
            do_action('ut_save_theme_layouts');
            
            /* parse theme options data */
            $name = mysql_real_escape_string( $_REQUEST['layouts_name'] );
                            
            if( empty( $name ) ) {
                
                /* leave here - no layout name submitted */
                $this->ajax_json_message('warning', esc_html__( 'Please enter a layout name!', 'unite-admin' ) );                               
                
            }
                        
            /* get existing layouts */
            $existing_layouts = get_option( ut_options_layout_key() );
            
            /* new layout id */
            $new_layout      = uniqid( 'unite_theme_options_' );
            
            /* layout id already exists - just in case */            
            if( is_array( $existing_layouts ) && array_key_exists( $new_layout, $existing_layouts ) ) {
                $new_layout = uniqid( 'unite_theme_options_' );
            }
                        
            /* assign new layout */
            $existing_layouts[$new_layout] = $name;
            
            /* update option */      
            update_option( ut_options_layout_key(), $existing_layouts );
                        
            /* ajax response */                                
            $this->ajax_json_message('success', esc_html__( 'Layout added!', 'unite-admin' ) );
        
        }
        
        exit;        
    
    }   
    
    
    /**
     * Save Theme Options
     *
     * @return    void
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */          
    public function save_theme_options() {
        
        /* get nonce */
        $nonce = $_REQUEST['save-nonce'];
        
        /* check if nonce is set and correct */
        if ( ! wp_verify_nonce( $nonce, 'unite-ajax-save-nonce' ) ) {
            die ( 'Busted!');
        }
        
        /* only proceed if current has permissions */
        if ( current_user_can( 'manage_options' ) ) {
            
            do_action('ut_save_theme_options');
            
            /* parse theme options data */
            parse_str( $_REQUEST['options'], $options );                
            
            if( empty( $options[ut_options_key()] ) ) {
                
                /* leave here - no options submitted */
                header( "Content-Type: application/json" );
                echo json_encode( array( 'status' => 'success' ) );
                exit;
                 
            }
            
            /* sanitize options */
            $options = $this->sanitize_callback( $options[ut_options_key()] );
            
            $new_settings = array();
                            
            /* loop through options */                
            foreach( (array) $this->settings as $key => $settings ) {
            
                if( 'settings' == $key ) {
                    
                    foreach( $settings as $setting ) {
                        
                        if( isset( $options[$setting['id']] ) && '' != $options[$setting['id']] ) {
                            
                            $new_settings[$setting['id']] = $options[$setting['id']];
                            
                        }
                        
                    }
                    
                    // @ todo fetch settings stored in db to compare with not loaded sections                                    
                
                }
            
            }                
            
            /* check if WPML is active */
            if( ut_wpml_activated() ) {
                                    
                /* register for wpml */
                $this->manage_wpml_translation( $new_settings );                
                
            }
            
            /* update theme options */
            update_option( ut_options_key(), $new_settings );
            
            /* assign response */
            $response = json_encode( array( 'status' => 'success' ) );
        
        } else {
            
            $response = json_encode( array( 'status' => 'info' ) );
        
        }
        
        /* create response for admin */
        header( "Content-Type: application/json" );
        echo $response;
                        
        exit;
        
    }        
    
    /**
     * Register sanitized theme option for WPML String Translation
     *
     * @return    void
     *
     * @access    public
     * @since     1.0.0
     * @version   1.0.0
     */  
    
    public function manage_wpml_translation( $new_settings, $parent = NULL, $type = NULL ) {
        
        $wpml_field_support = apply_filters( 'ut_wpml_field_support', array( 'text', 'textarea', 'editor', 'sortable' ) );
        
        foreach ( $new_settings as $k => $v ) {
            
            $type = $this->get_option_type( $k ) ? $this->get_option_type( $k ) :  $type;
                            
            if ( !is_array( $v ) && in_array( $type, $wpml_field_support ) ) {

                $prefix = $parent ? $parent . '_' : '';
                                    
                /* add translation */
                $this->add_wpml_translation( $prefix . $k, $v );
                
            }
            
            if ( is_array( $v ) && in_array( $type, $wpml_field_support ) ) {
                
                $this->manage_wpml_translation( $v, $k, $type );
            
            } 
        
        }
    
    }
    
    /**
     * Add WPML Translation String
     *
     * @return    void
     *
     * @access    private
     * @since     1.0.0
     * @version   1.0.0
     */        
    public function add_wpml_translation( $name, $value ) {
        
        if( empty( $name ) ) {
            return;
        }
        
        if( function_exists( 'icl_register_string' ) ) {
        
            icl_register_string( 'Theme Options', $name, $value );
        
        }
        
    }
    
    /**
     * Remove WPML Translation String
     *
     * @return    void
     *
     * @access    private
     * @since     1.0.0
     * @version   1.0.0
     */        
    public function remove_wpml_translation( $name ) {
        
        if( empty( $name ) ) {
            return;    
        }
        
        if( function_exists( 'icl_unregister_string' ) ) {
        
            icl_unregister_string( 'Theme Options', $name );        
        
        }
        
    }        
    
    /**
     * Include files
     *
     * @return    void
     *
     * @access    private
     * @since     1.0.0
     * @version   1.0.0
     */       
    private function load_file( $file ){
        
        include_once( $file );
      
    }
    
    
    
}

if( apply_filters( 'ut_show_theme_options', true ) ) {

    /* get it started */
    $ut_theme_options = new UT_Theme_Options();
    
    /* ajax actions */    
    add_action( 'wp_ajax_save_theme_options'    , array( $ut_theme_options, 'save_theme_options' ) );
    add_action( 'wp_ajax_save_theme_layouts'    , array( $ut_theme_options, 'save_theme_layouts' ) );
    add_action( 'wp_ajax_activate_theme_layout' , array( $ut_theme_options, 'activate_theme_layout' ) );
    add_action( 'wp_ajax_delete_theme_layout'   , array( $ut_theme_options, 'delete_theme_layout' ) );
    add_action( 'wp_ajax_copy_theme_layout'     , array( $ut_theme_options, 'copy_theme_layout' ) );
    add_action( 'wp_ajax_rename_theme_layout'   , array( $ut_theme_options, 'rename_theme_layout' ) );

}

    
