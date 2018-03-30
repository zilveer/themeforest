<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

class UT_Sidebar_Settings {
        
    /**
     * Sidebar option key, and sidebar admin page slug
     * @var string
     */
    private $key = 'unite-sidebars';
    
    /**
     * Sidebar Options Title
     * @var string
     */
    protected $title = '';
            
    /**
     * Unlimited Sidebars Title
     * @var string
     */
    protected $title_sidebars = '';
            
    /**
     * Blog Sidebars Title
     * @var string
     */
    protected $title_blog_sidebars = '';
            
    /**
     * Woocommerce Sidebars Title
     * @var string
     */
    protected $title_woo_sidebars = '';

    /**
     * Constructor
     * @since     1.0.0
     * @version   1.0.0
     */
    public function __construct() {
        
        $this->title                      = apply_filters( 'unite_sidebar_options_name' , esc_html__( 'Theme Sidebars', 'unite-admin' ) );
        $this->title_sidebars             = esc_html__( 'Unlimited Sidebars', 'unite-admin' );
        $this->title_blog_sidebars        = esc_html__( 'Blog Sidebar Settings', 'unite-admin' );
        $this->title_blog_single_sidebars = esc_html__( 'Blog Single Post Sidebar Settings', 'unite-admin' );
        $this->title_page_sidebars        = esc_html__( 'Page Sidebar Settings', 'unite-admin' );
        $this->title_woo_sidebars         = esc_html__( 'Woocommerce Sidebar Settings', 'unite-admin' );
        
        /* run hooks */
        $this->hooks();
            
    }
    
    /**
     * Initiate our hooks
     * @since     1.0.0
     * @version   1.0.0
     */
    public function hooks() {
        
        /* register settings */
        add_action( 'admin_init' , array( $this , 'register_settings' ) );
        
        /* register section */
        add_action( 'admin_init' , array( $this , 'register_sections' ) );
        
        /* register settings fields */
        add_action( 'admin_init' , array( $this , 'register_settings_fields' ) );
        
        /* add menu item */
        add_action( 'admin_menu' , array( $this , 'add_menu_item' ) );
        
        /* necessary scripts */ 
        if ( isset($_GET['page']) && $this->key == $_GET['page'] ) {
            
            /* load css */
            add_action( 'admin_enqueue_scripts', array( $this, 'register_sidebar_css' ) );
            
            /* load js */
            add_action( 'admin_enqueue_scripts', array( $this, 'register_sidebar_js' ) );
            
        }           
        
    }
    
    /**
     * Add to menu
     * @since     1.0.0
     * @version   1.0.0
     */
    public function add_menu_item() {
        
        $this->options_page = add_submenu_page('unite-welcome-page', $this->title, $this->title, 'manage_options', $this->key, array( $this , 'admin_page_display' ) );
        
    }
    
    /**
     * Register Settings
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_settings() {
        
        /* register blog sidebar settings */
        register_setting( 
            $this->key, 
            'unite_blog_sidebar_align', 
            array( $this, 'validate_field' )
        );
        
        register_setting( 
            $this->key, 
            'unite_blog_primary_sidebar', 
            array( $this, 'validate_field' ) 
        );
        
        if( apply_filters( 'ut_activate_secondary_sidebar', true ) ) {
        
            register_setting( 
                $this->key, 
                'unite_blog_secondary_sidebar', 
                array( $this, 'validate_field' ) 
            );
        
        }
        
        /* register blog single sidebar settings */
        register_setting( 
            $this->key, 
            'unite_blog_single_sidebar_align', 
            array( $this, 'validate_field' )
        );
        
        register_setting( 
            $this->key, 
            'unite_blog_single_primary_sidebar', 
            array( $this, 'validate_field' ) 
        );
        
        if( apply_filters( 'ut_activate_secondary_sidebar', true ) ) {
        
            register_setting( 
                $this->key, 
                'unite_blog_single_secondary_sidebar', 
                array( $this, 'validate_field' ) 
            );
        
        }
        
        /* register page sidebar settings */
        register_setting( 
            $this->key, 
            'unite_page_sidebar_align', 
            array( $this, 'validate_field' )
        );
        
        register_setting( 
            $this->key, 
            'unite_page_primary_sidebar', 
            array( $this, 'validate_field' ) 
        );
        
        if( apply_filters( 'ut_activate_secondary_sidebar', true ) ) {
        
            register_setting( 
                $this->key, 
                'unite_page_secondary_sidebar', 
                array( $this, 'validate_field' ) 
            );
        
        }
        
        /* register woocommerce sidebar settings */
        if ( class_exists( 'woocommerce' ) ) {
            
            register_setting( 
                $this->key,
                'unite_woocommerce_sidebar_align',
                array( $this , 'validate_field' )
            );
            
            register_setting( 
                $this->key,
                'unite_primary_woocommerce_sidebar',
                array( $this , 'validate_field' )
            );
            
             if( apply_filters( 'ut_activate_secondary_sidebar', true ) ) {
            
                register_setting(
                    $this->key,
                    'unite_secondary_woocommerce_sidebar',
                    array( $this , 'validate_field' ) 
                );
            
            }
            
        }
        
        /* register theme default sidebars */
        register_setting( 
            $this->key,
            'unite_theme_sidebars',
            array( $this , 'validate_sidebars' ) 
        );
        
    }        
    
    /**
     * Register Sections
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_sections() {
       
        /* add settings sections */
        add_settings_section(
            'unite_theme_sidebars',
            $this->title_sidebars ,
            array( $this, 'display_section' ),
            $this->key 
        );
        
        add_settings_section(
            'unite_blog_sidebars',
            $this->title_blog_sidebars, 
            array( $this, 'display_section' ), 
            $this->key
        );
        
        add_settings_section(
            'unite_blog_single_sidebars',
            $this->title_blog_single_sidebars, 
            array( $this, 'display_section' ), 
            $this->key
        );  
        
        add_settings_section(
            'unite_page_sidebars',
            $this->title_page_sidebars, 
            array( $this, 'display_section' ), 
            $this->key
        ); 
        
        /* add woocommerce settings section */
        if ( class_exists( 'woocommerce' ) ) {
            
            add_settings_section(
                'unite_woo_sidebars',
                $this->title_woo_sidebars,
                array( $this , 'display_section' ), 
                $this->key
            );
            
        }            
    
    }        
    
    /**
     * Add Settings Fields
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_settings_fields() {            
        
        /* unlimited sidebars */
        add_settings_field(
            'unite_theme_sidebars',
            esc_html__( 'Sidebars:', 'unite-admin' ),
            array( $this , 'theme_sidebars' ), 
            $this->key,
            'unite_theme_sidebars',
            array( 'name' => 'unite_theme_sidebars') 
        );
        
        /* default blog sidebars */
        add_settings_field( 
            'unite_blog_primary_sidebar',
            esc_html__( 'Blog Primary Sidebar:', 'unite-admin' ),
            array( $this , 'sidebar_select' ),
            $this->key,
            'unite_blog_sidebars',
            array( 'name' => 'unite_blog_primary_sidebar')
        );
        
        if( apply_filters( 'ut_activate_secondary_sidebar', true ) ) {
        
            add_settings_field(
                'unite_blog_secondary_sidebar',
                esc_html__( 'Blog Secondary Sidebar:', 'unite-admin' ), 
                array( $this , 'sidebar_select' ),
                $this->key,
                'unite_blog_sidebars',
                array( 'name' => 'unite_blog_secondary_sidebar') 
            );
        
        }
        
        /* default blog sidebar align */
        add_settings_field(
            'unite_blog_sidebar_align',
            esc_html__( 'Blog Sidebar Align:', 'unite-admin' ),
            array( $this , 'sidebar_align' ),
            $this->key, 
            'unite_blog_sidebars',
            array( 'name' => 'unite_blog_sidebar_align') 
        );
        
        /* default blog single sidebars */
        add_settings_field( 
            'unite_blog_single_primary_sidebar',
            esc_html__( 'Blog Single Post Primary Sidebar:', 'unite-admin' ),
            array( $this , 'sidebar_select' ),
            $this->key,
            'unite_blog_single_sidebars',
            array( 'name' => 'unite_blog_single_primary_sidebar')
        );
        
        if( apply_filters( 'ut_activate_secondary_sidebar', true ) ) {
        
            add_settings_field(
                'unite_blog_single_secondary_sidebar',
                esc_html__( 'Blog Single Post Secondary Sidebar:', 'unite-admin' ), 
                array( $this , 'sidebar_select' ),
                $this->key,
                'unite_blog_single_sidebars',
                array( 'name' => 'unite_blog_single_secondary_sidebar') 
            );
        
        }
        
        /* default blog sidebar align */
        add_settings_field(
            'unite_blog_single_sidebar_align',
            esc_html__( 'Blog Single Post Sidebar Align:', 'unite-admin' ),
            array( $this , 'sidebar_align' ),
            $this->key, 
            'unite_blog_single_sidebars',
            array( 'name' => 'unite_blog_single_sidebar_align') 
        );
        
        /* default page sidebars */
        add_settings_field( 
            'unite_page_primary_sidebar',
            esc_html__( 'Page Primary Sidebar:', 'unite-admin' ),
            array( $this , 'sidebar_select' ),
            $this->key,
            'unite_page_sidebars',
            array( 'name' => 'unite_page_primary_sidebar')
        );
        
        if( apply_filters( 'ut_activate_secondary_sidebar', true ) ) {
        
            add_settings_field(
                'unite_page_secondary_sidebar',
                esc_html__( 'Page Secondary Sidebar:', 'unite-admin' ), 
                array( $this , 'sidebar_select' ),
                $this->key,
                'unite_page_sidebars',
                array( 'name' => 'unite_page_secondary_sidebar') 
            );
        
        }
        
        /* default blog sidebar align */
        add_settings_field(
            'unite_page_sidebar_align',
            esc_html__( 'Page Sidebar Align:', 'unite-admin' ),
            array( $this , 'sidebar_align' ),
            $this->key, 
            'unite_page_sidebars',
            array( 'name' => 'unite_page_sidebar_align') 
        );
        
        /* woocommerce default sidebars */
        if ( class_exists( 'woocommerce' ) ) {
        
            if( apply_filters( 'ut_activate_secondary_sidebar', true ) ) {
            
                add_settings_field(
                    'unite_woo_secondary_sidebar',
                    esc_html__( 'Woocommerce Secondary Sidebar:', 'unite-admin' ),
                    array( $this , 'sidebar_select' ),
                    $this->key,
                    'unite_woo_sidebars',
                    array( 'name' => 'unite_woo_secondary_sidebar') 
                );
            
            }
            
            add_settings_field(
                'unite_woo_primary_sidebar',
                esc_html__( 'Woocommerce Primary Sidebar:', 'unite-admin' ),
                array( $this , 'sidebar_select' ),
                $this->key,
                'unite_woo_sidebars',
                array( 'name' => 'unite_woo_primary_sidebar')
            );
            
            add_settings_field(
                'unite_woo_sidebar_align',
                esc_html__( 'Woocommerce Sidebar Align:', 'unite-admin' ),
                array( $this , 'sidebar_align' ),
                $this->key,
                'unite_woo_sidebars',
                array( 'name' => 'unite_woo_sidebar_align') 
            );
        
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
    public function display_section() { /* nothing to do here */ }
            
    
    public function sidebar_align($args) {
        
        /* extract args */
        extract($args);
        
        /* get option */
        $option = get_option( $name );
        
        $data = '';
        if( $option && strlen( $option ) > 0 && $option != '' ) {
            $data = $option;
        }
        
        echo '<select class="postform" name="' . $name . '" >';
        
            foreach( _ut_recognized_sidebar_align() as $key => $align ) {
                
                if( $key != 'default' ) {
                    echo '<option value="' , $key , '"  ' , selected( $key  , $data , false ) , '>' , esc_html( $align ) , '</option>';     
                }
                
            }
        
        echo '</select>';                       
        
    }          
    
    public function sidebar_select($args) {
        
        global $wp_registered_sidebars;
        
        /* extract args */
        extract( $args );     
        
        /* get option */
        $option = get_option( $name );
        
        $data = '';
        if( $option && strlen( $option ) > 0 && $option != '' ) {
            $data = $option;
        }
        
        $sidebar_exceptions = apply_filters('ut_strip_sidebars_from_options', array() );
        
        echo '<select class="postform" name="' . $name . '">';
        
            foreach( $wp_registered_sidebars as $key => $sidebar ) {
                
                if( !in_array( $key, $sidebar_exceptions ) ) {
                
                    echo '<option value="' . $key . '" ' . selected( $key , $data , false ) . '>' . $sidebar['name']. '</option>';
                
                }
                
            }
        
        echo '</select>';            
        
    }
    
    
    public function theme_sidebars($args) {
        
        /* extract args */
        extract($args);
        
        $option = get_option($name);
        
        $data = '';
        if( $option && is_array( $option ) > 0 && $option != '' ) {
            $data = $option;
        }
        
        $counter = 0;            
            
        echo '<div id="ut-sidebars" class="ut-repeat-loop">';
            
            /* loop through custom sidebars */
            if( is_array( $data ) ) foreach ( (array) $data as $value ) {  ?>
                                    
                <div class="widgets-holder-wrap closed ut-repeat-group">
                    
                    <div class="ut-sidebar-title sidebar-name">
                        <div class="sidebar-name-arrow"><br></div>
                        <h3> 
                            <span> <?php echo esc_html( $value['sidebarname'] ); ?> </span>
                           <span class="ut-dodelete dashicons dashicons-trash"></span>
                        </h3>
                    </div>
                    
                    <div>
                    
                        <div class="ut-admin-panel-content clearfix">
                            
                            <label><?php esc_html_e('Please insert a unique name:' , 'unite-admin'); ?></label>
                            <input autocomplete="off" name="unite_theme_sidebars[<?php echo $counter; ?>][sidebarname]" type="text" class="ut-sidebar-name regular-text" value="<?php echo esc_html( $value['sidebarname'] ); ?>">
                            <input name="unite_theme_sidebars[<?php echo $counter; ?>][sidebar_id]" type="hidden" class="ut-sidebar-name regular-text" value="<?php echo esc_html( $value['sidebar_id'] ); ?>">
                            
                        </div>
    
                        
                        <div class="ut-admin-panel-content clearfix">
                            
                            <label><?php esc_html_e( 'Optional description:' , 'unite-admin' ); ?></label>                               
                            <?php $description = ( isset( $value['sidebardesc'] ) && $value['sidebardesc'] != '' ) ? esc_html( $value['sidebardesc'] ) : ''; ?>
                            <textarea name="unite_theme_sidebars[<?php echo $counter; ?>][sidebardesc]" rows="3"><?php echo $description; ?></textarea>
                            
                        </div>                        
                         
                    </div>
                    
                
                </div>
                
            <?php $counter++; } ?>                
                
            <div class="widgets-holder-wrap ut-repeat-group ut-to-copy">
                
                
                <div class="ut-sidebar-title sidebar-name">
                    <div class="sidebar-name-arrow"><br></div>
                    <h3>
                        <span><?php esc_html_e('New Sidebar' , 'unite-admin'); ?></span>
                        <span class="ut-dodelete dashicons dashicons-trash"></span>
                    </h3>
                </div>
                
                <div>
                    
                    <div class="ut-admin-panel-content clearfix">
                        
                        <label><?php esc_html_e('Please insert a unique name:' , 'unite-admin'); ?></label>
                        <input autocomplete="off" data-rel="unite_theme_sidebars" type="text" class="ut-sidebar-name regular-text" value="">   
                        
                    </div>
                    
                    <div class="ut-admin-panel-content clearfix">
                        
                        <label><?php esc_html_e('Optional description:' , 'unite-admin'); ?></label>
                        <textarea rows="3"></textarea>
                        
                    </div>
                    
                </div>
                
            </div>
            
            <button class="ut-backend-button ut-blue-button ut-docopy"><?php esc_html_e('Add Sidebar', 'unite-admin'); ?></button>
            
        </div>
        
        
    <?php }        
    
    /**
     * Admin page markup
     * @since  1.0
     */
    public function admin_page_display() { 
        
        global $wp_settings_sections;
        
        ?>
        
        <form method="post" action="options.php" enctype="multipart/form-data">
        
        <!-- Start UT-Backend-Wrap -->
        <div id="ut-sidebar-manager" class="ut-admin-wrap ut-admin-with-navigation clearfix">                
                        
            <div class="ut-backend-top-bar clearfix">
                
                <a class="ut-backend-logo" href="<?php echo get_admin_url(); ?>admin.php?page=unite-welcome-page" title="UnitedThemes">
                    <img src="<?php echo FW_WEB_ROOT . '/core/admin/assets/img/ut_logo_white.png'; ?>" alt="United Themes" />
                </a>
                
                <h2>
                    <?php echo esc_html( get_admin_page_title() ); ?>                    
                </h2>
                
                <span>by United Themes - Framework Version: <?php echo UT_VERSION; ?></span>
                
            </div>
            <!-- Close UT-Backend-Topbar -->
            
            <!-- Start UT-Backend-Navigation -->
            <div class="ut-backend-navigation-wrap">
                
                <ul class="ut-backend-main-navigation">
                    
                    <?php $menu_counter = 1; ?>
                    
                    <?php foreach ( (array) $wp_settings_sections[$this->key] as $section ) : ?>
                        
                        <?php $fallback = ( $menu_counter == 1 ) ? 'ut-menu-fallback-item' : ''; ?>
                                                        
                        <li>
                            <a class="<?php echo $fallback; ?>" data-title="<?php echo esc_attr( $section['title'] ); ?>" data-panel="<?php echo esc_attr( $section['id'] ); ?>" href="#"><i class="fa fa-angle-right"></i><?php echo esc_html( $section['title'] ); ?></a>
                        </li>
                    
                    <?php $menu_counter++; endforeach; ?>
                
                </ul>
            
            </div>
            
            <!-- Start UT-Admin-Main -->                
            <div class="ut-admin-main">
            
                <!-- Start UT-Admin-Header -->
                <header class="ut-admin-header clearfix">
                    
                    <h3 class="ut-admin-header-title">
                        Unlimited Sidebars
                    </h3>
                    
                    <button name="submit" id="submit" class="ut-backend-button ut-blue-button ut-submit-button-top" type="submit"><?php esc_html_e( 'Save', 'unite-admin' ); ?></button>                        
                    
                </header>
                <!-- Cose UT-Admin-Header -->
                
                <?php settings_fields( $this->key ); ?>
                <?php $this->do_add_settings_section(); ?>                        
            
            </div>                
            <!-- Close UT-Admin-Main -->
        
        </div>
        <!-- Close UT-Backend-Wrap -->
    
        </form>
        
    <?php }
    
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
    
        global $wp_settings_sections;
        
        if ( ! isset( $wp_settings_sections ) || ! isset( $wp_settings_sections[$this->key] ) ) {
            return false;
        }            
        
        foreach ( (array) $wp_settings_sections[$this->key] as $section ) {
            
            echo '<div class="ut-admin-panel-group" id="' , $section['id'] , '">';
            
                $this->do_add_settings_field( $section['id'] ); 
            
            echo '</div>';                
        
        }
        
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
       
        if ( !isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$this->key] ) || !isset( $wp_settings_fields[$this->key][$section] ) ) {
            return;
        }

        foreach ( (array) $wp_settings_fields[$this->key][$section] as $field ) {
                                            
            echo '<section class="ut-admin-panel clearfix">';
                
                $this->before_option_output( $field );
                
                echo '<div class="ut-admin-panel-content clearfix">';
                
                    call_user_func( array( $this, $field['callback'][1] ), $field['args'] );
                
                echo '</div>';
                
            echo '</section>';
            
        }                        
    
    }
    
    private function before_option_output( $settings ) {
    
        /* render option*/        
        echo '<header class="ut-admin-panel-header">';
            
            echo '<h3 class="ut-admin-panel-header-title">' , $settings['title'] , '</h3>';
        
        echo '</header>';
    
    }
    
    
    /**
     * Sidebar Admin CSS
     * @since  1.0
     */
    public function register_sidebar_css() {
        
        /* @todo : check for wordpress styles - currently deactivated for some reason */
        
        wp_enqueue_style(
            'unite-sidebar', 
            FW_WEB_ROOT . '/core/admin/assets/css/unite-sidebar-admin.css', 
            false, 
            UT_VERSION
        ); 
     
    }
    
    
    /**
     * Admin page JS
     * @since  1.0
     */
    public function register_sidebar_js() {
    
        wp_enqueue_script(
            'unite-sidebar-js', 
            FW_WEB_ROOT . '/core/admin/assets/js/unite-sidebar-admin.js', 
            array('jquery' ,  'jquery-ui-accordion'), 
            UT_VERSION
        );
    
    }
    
    
    /**
     * Field Validation
     * @since  1.0
     */
    public function validate_field( $slug ) {
        
        return sanitize_text_field( $slug );
        
    }
    
    /**
     * Field Validation
     * @since  1.0
     */
    public function validate_sidebars( $input ) {
                    
        $clean = array();
        
        /* sanitize array */
        if( is_array( $input ) ) {
            
            foreach($input as $id => $sidebar ) {
                
                if( !empty( $sidebar['sidebarname'] ) ) {
                    $clean[$id]['sidebarname'] = sanitize_text_field( $sidebar['sidebarname'] );
                }
                
                if( !empty( $sidebar['sidebardesc'] ) ) {
                    $clean[$id]['sidebardesc'] = sanitize_text_field( $sidebar['sidebardesc'] );
                }
                
                if( !empty( $sidebar['sidebar_id'] ) ) {
                    
                    /* re assign sidebar id */
                    $clean[$id]['sidebar_id'] = sanitize_text_field($sidebar['sidebar_id']);
                    
                } else {
                    
                    /* create a unique id for first sidebar saving */
                    $clean[$id]['sidebar_id'] = uniqid('ut_sidebar_');
                
                }
                
            }

        }
                  
        return $clean;
            
    }                  

}

/* get it started */
if( apply_filters( 'ut_activate_sidebars', true ) ) {
    $ut_sidebars = new UT_Sidebar_Settings();    
}   