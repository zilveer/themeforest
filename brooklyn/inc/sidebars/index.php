<?php if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'UT_Sidebar_Settings_Old' ) ) :

    class UT_Sidebar_Settings_Old {
        
        private $dir;
        private $file;
        private $assets_dir;
        private $assets_url;
    
        public function __construct( $file ) {
            
            $this->dir = dirname( $file );
            $this->file = $file;
            $this->assets_dir = trailingslashit( $this->dir ) . 'assets';
            $this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $file ) ) );
    
            // register plugin settings
            add_action( 'admin_init' , array( &$this , 'register_settings' ) );
    
            // add settings page to menu
            add_action( 'admin_menu' , array( &$this , 'add_menu_item' ) );    
            
            // necessary scripts 
            if ( isset($_GET['page']) && $_GET['page'] == 'ut_sidebar_settings' ) {
                add_action('admin_print_styles' , array( &$this, 'register_sidebar_scripts' ));
            }
            
        }
        
        public function register_sidebar_scripts() {
                
                /* styles */
                wp_enqueue_style( 'ut-portfolio-single-css' , THEME_WEB_ROOT . '/inc/sidebars/ut-sidebar-manager.css', 10, 2 );
                
                /* scripts */
                wp_enqueue_script( 'jquery-ui-accordion' );
                wp_enqueue_script('ut-portfolio-single-js'	, THEME_WEB_ROOT . '/inc/sidebars/ut-sidebar-manager.js', array('jquery'), '1.0' , true );
                
        
        }
        
        public function add_menu_item() {
            add_submenu_page( 'unite-welcome-page' , 'Theme Sidebars' , 'Theme Sidebars' , 'publish_pages' , 'ut_sidebar_settings' ,  array( &$this , 'settings_page' ) );
        }
    
        public function register_settings() {
            
            // Unlimited Sidebars
            add_settings_section( 'unlimited_sidebars' , 'Unlimited Sidebars' , array( &$this , 'main_settings' ) , 'ut_sidebar_settings' );
            
            // Add settings section
            // add_settings_section( 'main_settings' , 'Blog Sidebar Settings' , array( &$this , 'main_settings' ) , 'ut_sidebar_settings' );
            
            if ( class_exists( 'woocommerce' ) ) {
                // add_settings_section( 'woo_settings'  , 'Woocommerce Sidebar Settings' , array( &$this , 'main_settings' ) , 'ut_sidebar_settings' );
            }
            
            // Add settings fields
            // add_settings_field( 'ut_default_sidebar_align' , __( 'Blog Sidebar Align:' , 'unitedthemes' ) , array( &$this , 'ut_default_sidebar_align' )  , 'ut_sidebar_settings' , 'main_settings' );            
            // add_settings_field( 'ut_primary_default_sidebar' , __( 'Blog Primary Sidebar:' , 'unitedthemes' ) , array( &$this , 'ut_primary_default_sidebar' )  , 'ut_sidebar_settings' , 'main_settings' );
            // add_settings_field( 'ut_secondary_default_sidebar' , __( 'Blog Secondary Sidebar:' , 'unitedthemes' ) , array( &$this , 'ut_secondary_default_sidebar' )  , 'ut_sidebar_settings' , 'main_settings' );
            
            /* woocommerce default sidebars - only show this set when plugin is active */
            if ( class_exists( 'woocommerce' ) ) {
            
                //add_settings_field( 'ut_default_wocommerce_sidebar_align' , __( 'Woocommerce Sidebar Align:' , 'unitedthemes' ) , array( &$this , 'ut_default_wocommerce_sidebar_align' )  , 'ut_sidebar_settings' , 'woo_settings' );            
                //add_settings_field( 'ut_primary_wocommerce_default_sidebar' , __( 'Woocommerce Primary Sidebar:' , 'unitedthemes' ) , array( &$this , 'ut_primary_wocommerce_default_sidebar' )  , 'ut_sidebar_settings' , 'woo_settings' );
                //add_settings_field( 'ut_secondary_wocommerce_default_sidebar' , __( 'Woocommerce Secondary Sidebar:' , 'unitedthemes' ) , array( &$this , 'ut_secondary_wocommerce_default_sidebar' )  , 'ut_sidebar_settings' , 'woo_settings' );
            
            }
            
            add_settings_field( 'ut_theme_sidebars' , __( 'Individual Sidebars:' , 'unitedthemes' ) , array( &$this , 'ut_theme_sidebars' )  , 'ut_sidebar_settings' , 'unlimited_sidebars' );
                        
            // Register settings fields
            register_setting( 'ut_sidebar_settings' , 'ut_default_sidebar_align' , array( &$this , 'validate_field' ) );
            register_setting( 'ut_sidebar_settings' , 'ut_primary_default_sidebar' , array( &$this , 'validate_field' ) );
            register_setting( 'ut_sidebar_settings' , 'ut_secondary_default_sidebar' , array( &$this , 'validate_field' ) );
            
            /* woocommerce default sidebars settings - only show this set when plugin is active */
            if ( class_exists( 'woocommerce' ) ) {
                
                register_setting( 'ut_sidebar_settings' , 'ut_default_wocommerce_sidebar_align' , array( &$this , 'validate_field' ) );
                register_setting( 'ut_sidebar_settings' , 'ut_primary_wocommerce_default_sidebar' , array( &$this , 'validate_field' ) );
                register_setting( 'ut_sidebar_settings' , 'ut_secondary_wocommerce_default_sidebar' , array( &$this , 'validate_field' ) );
                
            }          
            
            register_setting( 'ut_sidebar_settings' , 'ut_theme_sidebars' , array( &$this , 'validate_sidebars' ) );
                        
            
        }
    
        public function main_settings() { 
            
            //echo '<p>' . __( 'Manage Sidebars.' , 'unitedthemes' ) . '</p>'; 
        
        }
        
        public function ut_default_sidebar_align() {
            
            $option = get_option('ut_default_sidebar_align');
            
            $data = '';
            if( $option && strlen( $option ) > 0 && $option != '' ) {
                $data = $option;
            }
            
            echo '<select class="postform" name="ut_default_sidebar_align" >';
                
                echo '<option value="none" ' . selected( 'none' , $data , false ) . '>' . __( 'No Sidebars', 'unitedthemes'  ) . '</option>';
                echo '<option value="left" ' . selected( 'left' , $data , false ) . '>' . __( 'Sidebar Left', 'unitedthemes'  ) . '</option>';
                echo '<option value="right" ' . selected( 'right' , $data , false ) . '>' . __( 'Sidebar Right', 'unitedthemes'  ) .'</option>';
                echo '<option value="both" ' . selected( 'both' , $data , false ) . '>' . __( 'Sidebar Left and Right', 'unitedthemes'  ) . '</option>';
                
            echo '</select>';
            
            
        }            
        
        public function ut_primary_default_sidebar() {
            
            global $wp_registered_sidebars;
            
            $option = get_option('ut_primary_default_sidebar');
            
            $data = '';
            if( $option && strlen( $option ) > 0 && $option != '' ) {
                $data = $option;
            }
            
            echo '<select class="postform" name="ut_primary_default_sidebar">';
            
            foreach( $wp_registered_sidebars as $key => $sidebar ) {
                
                echo '<option value="' . $key . '" ' . selected( $key , $data , false ) . '>' . $sidebar['name']. '</option>';
                
            }
            
            echo '</select>';            
            
        }
        
        public function ut_secondary_default_sidebar() {
            
            global $wp_registered_sidebars;
            
            $option = get_option('ut_secondary_default_sidebar');
            
            $data = '';
            if( $option && strlen( $option ) > 0 && $option != '' ) {
                $data = $option;
            }
            
            echo '<select class="postform" name="ut_secondary_default_sidebar">';
            
            foreach( $wp_registered_sidebars as $key => $sidebar ) {
                
                echo '<option value="' . $key . '" ' . selected( $key , $data , false ) . '>' . $sidebar['name']. '</option>';
                
            }
            
            echo '</select>';
                    
        }
        
        public function ut_default_wocommerce_sidebar_align() {
            
            $option = get_option('ut_default_wocommerce_sidebar_align');
            
            $data = '';
            if( $option && strlen( $option ) > 0 && $option != '' ) {
                $data = $option;
            }
            
            echo '<select class="postform" name="ut_default_wocommerce_sidebar_align" >';
                
                echo '<option value="none" ' . selected( 'none' , $data , false ) . '>' . __( 'No Sidebars', 'unitedthemes'  ) . '</option>';
                echo '<option value="left" ' . selected( 'left' , $data , false ) . '>' . __( 'Sidebar Left', 'unitedthemes'  ) . '</option>';
                echo '<option value="right" ' . selected( 'right' , $data , false ) . '>' . __( 'Sidebar Right', 'unitedthemes'  ) .'</option>';
                echo '<option value="both" ' . selected( 'both' , $data , false ) . '>' . __( 'Sidebar Left and Right', 'unitedthemes'  ) . '</option>';
                
            echo '</select>';
            
            
        }            
        
        public function ut_primary_wocommerce_default_sidebar() {
            
            global $wp_registered_sidebars;
            
            $option = get_option('ut_primary_wocommerce_default_sidebar');
            
            $data = '';
            if( $option && strlen( $option ) > 0 && $option != '' ) {
                $data = $option;
            }
            
            echo '<select class="postform" name="ut_primary_wocommerce_default_sidebar">';
            
            foreach( $wp_registered_sidebars as $key => $sidebar ) {
                
                echo '<option value="' . $key . '" ' . selected( $key , $data , false ) . '>' . $sidebar['name']. '</option>';
                
            }
            
            echo '</select>';            
            
        }
        
        public function ut_secondary_wocommerce_default_sidebar() {
            
            global $wp_registered_sidebars;
            
            $option = get_option('ut_secondary_wocommerce_default_sidebar');
            
            $data = '';
            if( $option && strlen( $option ) > 0 && $option != '' ) {
                $data = $option;
            }
            
            echo '<select class="postform" name="ut_secondary_wocommerce_default_sidebar">';
            
            foreach( $wp_registered_sidebars as $key => $sidebar ) {
                
                echo '<option value="' . $key . '" ' . selected( $key , $data , false ) . '>' . $sidebar['name']. '</option>';
                
            }
            
            echo '</select>';
                    
        }
        
        public function ut_theme_sidebars() {
        
            $option = get_option('ut_theme_sidebars');
            
            $data = '';
            if( $option && is_array( $option ) > 0 && $option != '' ) {
                $data = $option;
            }
            
            $counter =0;

            echo '<div id="ut-sidebars" class="ut-repeat-loop">';
                
                /* loop through custom sidebars */
                if( is_array( $data ) ) foreach ( (array)$data as $value ) {
                                        
                    echo '<div class="widgets-holder-wrap closed ut-repeat-group">';
                        
                        echo '<div class="ut-sidebar-title sidebar-name">';
                            echo '<div class="sidebar-name-arrow"><br></div>';
                            echo '<h3>'; 
                                echo '<span>' . $value['sidebarname'] . '</span>';
                                echo '<span class="ut-dodelete dashicons dashicons-trash"></span>';
                            echo '</h3>';
                        echo '</div>';
                        
                        echo '<div>';
                            
                            echo '<div class="widget-top"><div class="widget-title"><h4>' . __('Sidebar Name' , 'unitedthemes') . '</h4></div></div>';
                            echo '<div class="widget-inside">';
                                
                                echo '<p><label>' . __('Please insert a unique name:' , 'unitedthemes') . '<br />';
                                echo '<input name="ut_theme_sidebars[' . $counter . '][sidebarname]" type="text" class="ut-sidebar-name regular-text" value="' . $value['sidebarname'] . '"></label></p>';
                                echo '<input name="ut_theme_sidebars[' . $counter . '][sidebar_id]" type="hidden" class="ut-sidebar-name regular-text" value="' . $value['sidebar_id'] . '">';
                            
                            echo '</div><br />';
                            
                            echo '<div class="widget-top"><div class="widget-title"><h4>' . __('Description' , 'unitedthemes') . ' </h4></div></div>';                            
                            echo '<div class="widget-inside">';
                            
                                echo '<p><label>' . __('optional description:' , 'unitedthemes') . '<br />';
                                
                                    $description = ( isset($value['sidebardesc']) && $value['sidebardesc'] != '' ) ? $value['sidebardesc'] : '';
                                    echo '<textarea name="ut_theme_sidebars[' . $counter . '][sidebardesc]" rows="3">' . $description . '</textarea>';
                                
                                echo '</p>';
                                
                             echo '</div>';
                             
                        echo '</div>';
                        
                    
                    echo '</div>';
                    
                    $counter++;
                    
                }
                
                /* dummy */
                echo '<div class="widgets-holder-wrap ut-repeat-group ut-to-copy">';
                    
                    
                    echo '<div class="ut-sidebar-title sidebar-name">';
                        echo '<div class="sidebar-name-arrow"><br></div>';
                        echo '<h3>'; 
                            echo '<span>' . __('New Sidebar' , 'unitedthemes') . '</span>';
                            echo '<span class="ut-dodelete dashicons dashicons-trash"></span>';
                        echo '</h3>';
                    echo '</div>';
                    
                    echo '<div>';
                        
                        echo '<div class="widget-top"><div class="widget-title"><h4>' . __('Sidebar Name' , 'unitedthemes') . '</h4></div></div>';
                            
                            echo '<div class="widget-inside">';
                                
                                echo '<p><label>' . __('Please insert a unique name:' , 'unitedthemes') . '<br />';
                                echo '<input data-rel="ut_theme_sidebars" type="text" class="ut-sidebar-name regular-text" value=""></label></p>';
                            
                            echo '</div><br />';
                            
                            echo '<div class="widget-top"><div class="widget-title"><h4>' . __('Description' , 'unitedthemes') . ' </h4></div></div>';                            
                            echo '<div class="widget-inside">';
                            
                                echo '<p><label>' . __('optional description:' , 'unitedthemes') . '<br />';
                                
                                    echo '<textarea rows="3"></textarea>';
                                
                                echo '</p>';
                                
                             echo '</div>';
                        
                    echo '</div>';
                    
                echo '</div>';
                
                echo '<button class="ut-docopy button icon add">' . __('Add Sidebar', 'unitedthemes') . '</button>';
                
            echo '</div>';
            
            
        }

        public function validate_field( $slug ) {
            if( $slug && strlen( $slug ) > 0 && $slug != '' ) {
                $slug = urlencode( strtolower( str_replace( ' ' , '-' , $slug ) ) );
            }
            return $slug;
        }
            
        public function validate_sidebars( $input ) {
                        
            $clean = array();
            
            /* sanitize array */
            if( is_array( $input ) ) {
                
                foreach($input as $id => $sidebar ) {
                    
                    if( !empty( $sidebar['sidebarname'] ) ) {
                        $clean[$id]['sidebarname'] = sanitize_text_field($sidebar['sidebarname']);                        
                    }
                    
                    if( !empty( $sidebar['sidebardesc'] ) ) {
                        $clean[$id]['sidebardesc'] = sanitize_text_field($sidebar['sidebardesc']);
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
    
        public function settings_page() {
    
            echo '<div id="ut-sidebar-manager" class="wrap">
                    <div class="icon32" id="icon-options-general"><br/></div>
                    <h2 class="ut-settings-title">' . __('Sidebar Settings' , 'unitedthemes') . '</h2>
                    <form method="post" action="options.php" enctype="multipart/form-data">';
                    
                    // echo '<blockquote>' . __('These are your global sidebar settings, there is an option field for each post, where you can define your own custom sidebar settings for each page' , 'unitedthemes') . '</blockquote>';
                        
                    settings_fields( 'ut_sidebar_settings' );
                    do_settings_sections( 'ut_sidebar_settings' );
    
                  echo '<p class="submit">
                            <input name="Submit" type="submit" class="button-primary" value="' . esc_attr( __( 'Save Settings' , 'unitedthemes' ) ) . '" />
                        </p>
                    </form>
                  </div>';
        }
        
    }
    
    new UT_Sidebar_Settings_Old( __FILE__ );

endif;