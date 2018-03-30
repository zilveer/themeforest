<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}
    
class UT_Font_Manager {
    
    /**
     * Fonts option key, and font manager admin page slug
     * @var string
     */
    private $key = 'unite-theme-fonts';
    
    /**
     * Fontmanager Options Title
     * @var string
     */
    protected $title = '';
    
    /**
     * Fontmanager Google API Key
     * @var string
     */
    protected $api_key = '';
    
    /**
     * Fontmanager Google Fonts
     * @var array
     */
    protected $google_fonts = '';
    
    /**
     * Constructor
     * @since   1.0.0
     * @version 1.0.0
     */
    public function __construct() {
        
        /* Title */            
        $this->title = esc_html__( 'Theme Fonts', 'unite-admin' );
        
        /* Google API Key */
        $this->api_key = get_option( 'unite_google_fonts_api_key' );
        
        /* get google fonts */
        $this->google_fonts();
        
        /* run hooks */
        $this->hooks();
        
    }
    
    /**
     * Define Google Font Source
     * @since   1.0.0
     * @version 1.0.0
     */
    public function google_fonts() {            
        
        /* check if font caching is active */
        if( apply_filters( 'ut_cache_google_fonts', false ) ) {
            
            $cached_fonts = get_transient( 'unite_cache_google_fonts' );
            
            if ( $cached_fonts  ) {
                
                /* assign google fonts */
                $this->google_fonts = $cached_fonts;
                                
                /* leave here */
                return;
            
            }
            
                
        }            
        
        /* we have a key */
        if( !empty( $this->api_key ) ) {
            
            /* get fresh list of google fonts */
            $google_fonts = json_decode( wp_remote_retrieve_body( wp_remote_get( 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . $this->api_key ) ), true );
            
            /* check response for error */
            if( isset( $google_fonts['error'] ) ) {
                
                /* Error Message Key is wrong */
            
            /* we have a valid list of fonts */
            } elseif( isset( $google_fonts['kind'] ) && $google_fonts['kind'] == 'webfonts#webfontList' ) {
                
                /* Success Message Key is valid */
                
            } else {
            
                /* fallback file */
                $google_fonts = json_decode( wp_remote_retrieve_body( wp_remote_get( FW_WEB_ROOT . '/core/admin/assets/fonts/google_fonts.json' ) ), true );
                
            }
              
        } else {
            
            /* fallback file */
            $google_fonts = json_decode( wp_remote_retrieve_body( wp_remote_get( FW_WEB_ROOT . '/core/admin/assets/fonts/google_fonts.json' ) ), true );
        
        }
        
        /* assign google fonts */
        $this->google_fonts = $google_fonts;
        
        /* build cache */
        if( apply_filters( 'ut_cache_google_fonts', false ) ) {
            
            if ( $cached_fonts === false ) {

                set_transient( 'unite_cache_google_fonts', $this->google_fonts, 60 * 60 * 48 );
                
            }
            
        }
        
    
    }
    
    /**
     * Define Google Font Array for JS
     * @since   1.0.0
     * @version 1.0.0
     */        
    public function google_font_js_array() {
        
        /* create var array for autocomplete  */
        $data = array();            
        
        if( !empty( $this->google_fonts['items'] ) && is_array( $this->google_fonts['items'] ) ) {
            
            foreach(  $this->google_fonts['items'] as $key => $google_font ) {
                
                /* label and value for jquery ui autocomplete */
                $google_font['label'] = $google_font['family'];
                $google_font['value'] = strtolower( ut_remove_trash( $google_font['family'] ) );
                                    
                $data[$key] = $google_font;                    
                
            }
            
        }
        
        return $data;
        
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
        
            add_action( 'admin_enqueue_scripts', array( $this , 'register_fontmanager_css' ) );
            add_action( 'admin_enqueue_scripts', array( $this , 'register_fontmanager_js' ) );
        
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
        
        register_setting( 
            $this->key, 
            'unite_google_fonts_api_key', 
            array( $this, 'validate_key' ) 
        );
        
        register_setting( 
            $this->key, 
            'unite_installed_google_fonts', 
            array( $this, 'validate_fonts' ) 
        );
    
    }
    
    /**
     * Register Sections
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_sections() {
        
        add_settings_section( 
            'unite_google_fonts_api_key_section', 
            esc_html__( 'Google Font Key', 'unite-admin' ), 
            array( $this, 'display_section' ), 
            $this->key
        );
        
        add_settings_section( 
            'unite_installed_google_fonts_section', 
            esc_html__( 'Installed Google Fonts', 'unite-admin' ), 
            array( $this, 'display_section' ), 
            $this->key
        );
    
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
    
    
    /**
     * Add Settings Fields
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_settings_fields() {
        
        add_settings_field( 
            'unite_google_fonts_api_key', 
            esc_html__( 'Google Font API Key', 'unite-admin' ), 
            array( $this , 'api_key_input' ), 
            $this->key, 
            'unite_google_fonts_api_key_section', 
            array( 'name' => 'unite_google_fonts_api_key')
        );
        
        add_settings_field( 
            'unite_installed_google_fonts', 
            esc_html__( 'Installed Google Fonts', 'unite-admin' ), 
            array( $this , 'google_fonts_input' ), 
            $this->key, 
            'unite_installed_google_fonts_section', 
            array( 'name' => 'unite_installed_google_fonts')
        );
    
    }
    
    
    /**
     * API Key Input Field
     * @since     1.0.0
     * @version   1.0.0
     */        
    public function api_key_input( $args ) {
        
        /* extract args */
        extract( $args );
        
        /* get option */
        $option = get_option( $name );
        
        $data = '';
        if( $option && strlen( $option ) > 0 && $option != '' ) {
            $data = $option;
        }
                
        echo '<input autocomplete="off" value="' . $option . '" type="text" name="' . $name . '" class="ut-full-width ut-option-element">';
    
    }
    
    /**
     * Google Font Input Fields 
     * @since     1.0.0
     * @version   1.0.0
     */        
    public function google_fonts_input( $args ) {
    
        /* extract args */
        extract( $args );
        
        /* get option */
        $option = get_option( $name );
        
        $data = '';
        if( $option && strlen( $option ) > 0 && $option != '' ) {
            $data = $option;
        }
        
        //ut_print( $data );
        
        if( !empty( $option ) && is_array( $option ) ) {
            
            foreach( $option as $google_font ) {
                
                //ut_print( $google_font );
                
            }                
        
        }
    
    
    }
    
    
    public function get_font_settings_box() { 
        
        $family = !empty( $_POST['familiy'] ) ? trim($_POST['familiy']) : '';
        
        if( empty( $family ) ) {
            
            /* error message font not found */
            echo '<div class="ut-alert ut-alert-warning">' . esc_html__('Font Family Empty. Please try again.', 'unite-admin') . '</div>';
            exit;
            
        }
                
        $font_key = $this->get_google_array_key( 'family', $family );
        $google_font = array();        
                
        /* record found */
        if( isset( $font_key ) && !is_bool( $font_key ) ) {
            
            $google_font = $this->google_fonts['items'][$font_key];   
        
        } else{
            
            /* error no valid font familiy */
            echo '<div class="ut-alert ut-alert-warning">' . esc_html__('No font record found. Please try again or contact support.', 'unite-admin') . '</div>';
            exit;
            
        }
        
        ?>
        
        <section id="unite_font_id_<?php echo strtolower( ut_remove_trash( $google_font['family'] ) ); ?>" class="ut-single-google-font ut-admin-panel clearfix">
                                    
            <header class="ut-admin-panel-header">
                
                <h3 class="ut-admin-panel-header-title">
                    <?php echo $google_font['family']; ?>
                    <input type="hidden" name="unite_installed_google_fonts[<?php echo strtolower( ut_remove_trash( $google_font['family'] ) ); ?>][family]" value="<?php echo $google_font['family']; ?>"/>
                </h3>
                
                <span class="ut-admin-panel-description">
                    <?php echo esc_html__( 'Version:', 'unite-admin' ) . ' ' . $google_font['version'] ?>
                </span>
                
                <div class="ut-admin-panel-actions ut-hide">
                    <a href="#"><i class="fa fa fa-angle-down"></i></a>
                    <a data-fontid="<?php echo $font_key; ?>" data-fontfamily="<?php echo strtolower( ut_remove_trash( $google_font['family'] ) ); ?>" class="ut-delete-google-font" href="#"><i class="fa fa-trash-o"></i></a>
                    <a data-fontid="<?php echo $font_key; ?>" data-fontfamily="<?php echo strtolower( ut_remove_trash( $google_font['family'] ) ); ?>" class="ut-restore-google-font ut-hide" href="#"><i class="fa fa-recycle"></i></a>
                </div>
                
            </header>
            
            <div class="ut-admin-panel-content clearfix">
                
                <div class="grid-50">
                
                    <h5><?php esc_html_e( 'Available Font Variants', 'unite-admin'); ?></h5>
                    
                    <?php foreach( $google_font['variants'] as $variant ) : ?>
                        
                        <label class="ut-checkbox-label">                                                 
                        
                            <input type="checkbox" name="unite_installed_google_fonts[<?php echo strtolower( ut_remove_trash( $google_font['family'] ) ); ?>][variants][]" value="<?php echo $variant; ?>"/>
                            <span class="ut-checkbox"></span>
                            <span class="ut-checkbox-description"><?php echo esc_attr( $variant ); ?></span>
                         
                        </label>      
                            
                    <?php endforeach; ?>
                
                </div>
                
                <div class="grid-50">
                
                    <h5><?php esc_html_e( 'Available Font Subsets', 'unite-admin'); ?></h5>
                    
                    <?php foreach( $google_font['subsets'] as $subset ) : ?>
                        
                        <label class="ut-checkbox-label">
                        
                            <input type="checkbox" name="unite_installed_google_fonts[<?php echo strtolower( ut_remove_trash( $google_font['family'] ) ); ?>][subsets][]" value="<?php echo $subset; ?>" />
                            <span class="ut-checkbox"></span>
                            <span class="ut-checkbox-description"><?php echo esc_attr( $subset ); ?></span>
                        
                        </label>
                    
                    <?php endforeach; ?>
                
                </div>
                
                <div class="clear"></div>
                
                <div>
                
                    <button data-fontid="<?php echo $font_key; ?>" data-fontfamily="<?php echo strtolower( ut_remove_trash( $google_font['family'] ) ); ?>" class="ut-backend-button ut-blue-button ut-preview-google-font" type="submit"><?php esc_html_e( 'Preview Font', 'unite-admin' ); ?></button>
                    <button data-fontid="<?php echo $font_key; ?>" data-fontfamily="<?php echo strtolower( ut_remove_trash( $google_font['family'] ) ); ?>" class="ut-backend-button ut-blue-button ut-add-google-font" type="submit"><?php esc_html_e( 'Add to Collection', 'unite-admin' ); ?></button>
                
                </div>
                
            </div>
            
        </section>

        <?php
        
        exit; 
    
    }
    
    
    /**
     * Return Google Array Key
     * @since     1.0.0
     * @version   1.0.0
     */
    public function get_google_array_key( $field, $value ) {
       
       if( !empty( $this->google_fonts['items'] ) && is_array( $this->google_fonts['items'] ) ) {
       
           foreach( $this->google_fonts['items'] as $key => $font ) {
              
              if ( isset( $font[$field] ) && $font[$field] === $value ) {
                                  
                 return $key;
                 
              }
              
           }
       
       }
       
       return false;
       
    }        
    
    
    /**
     * Admin page markup
     * @since     1.0.0
     * @version   1.0.0
     */
    public function admin_page_display() { 
    
       $google_fonts = get_option( 'unite_installed_google_fonts' ); ?>
       
       <!-- Start UT-Backend-Wrap -->
       <div class="ut-admin-wrap ut-admin-with-navigation clearfix">
            
            <div class="ut-backend-top-bar clearfix">
                
                <a class="ut-backend-logo hide-on-tablet hide-on-mobile" href="<?php echo get_admin_url(); ?>admin.php?page=unite-welcome-page" title="UnitedThemes">
                    <img src="<?php echo FW_WEB_ROOT . '/core/admin/assets/img/ut_logo_white.png'; ?>" alt="United Themes" />
                </a>
                
                <h2>
                    <?php echo $this->title; ?>                   
                </h2>
                
                <span class="hide-on-tablet hide-on-mobile">by United Themes - Framework Version: <?php echo UT_VERSION; ?></span>
                
                <div class="ut-backend-top-bar-actions">
                
                    <button form="unite-font-manager-form" name="submit" id="submit" class="ut-backend-button ut-blue-button hide-on-desktop" type="submit"><?php esc_html_e('Save Fonts' , 'unite-admin'); ?></button>
                
                </div>
                
            </div>
            <!-- Close UT-Backend-Topbar -->
            
            <!-- Start UT-Backend-Navigation -->
            <div class="ut-backend-navigation-wrap">
            
                <ul class="ut-backend-main-navigation">
                    
                    <li><a class="ut-menu-fallback-item" data-title="<?php echo esc_html_e( 'Manage Fonts', 'unite-admin' ); ?>" data-panel="manage-fonts" href="#"><i class="fa fa-angle-right"></i><?php echo esc_html_e( 'Manage Fonts', 'unite-admin' ); ?></a></li>
                    <li><a data-title="<?php echo esc_html_e( 'Google API', 'unite-admin' ); ?>" data-panel="google-api" href="#"><i class="fa fa-angle-right"></i><?php echo esc_html_e( 'Google API', 'unite-admin' ); ?></a></li>                    
                
                </ul>
            
            </div>
            <!-- Close UT-Backend-Navigation -->
            
            <!-- Start UT-Admin-Main -->                        
            <div class="ut-admin-main">
                
                <!-- Start UT-Admin-Header -->
                <header class="ut-admin-header hide-on-tablet hide-on-mobile clearfix">
                    
                    <h3 class="ut-admin-header-title">
                        Manage Fonts
                    </h3>
                    
                    <button form="unite-font-manager-form" name="submit" id="submit" class="ut-backend-button ut-blue-button ut-submit-button-top" type="submit"><?php esc_html_e('Save Fonts' , 'unite-admin'); ?></button>
                    
                </header>
                <!-- Cose UT-Admin-Header -->
                
                <div class="ut-admin-panel-group ut-show" id="manage-fonts">
                    
                    <section id="ut-font-search-panel" class="ut-admin-panel clearfix">
                                
                        <header class="ut-admin-panel-header">
                            
                            <h3 class="ut-admin-panel-header-title"><?php esc_html_e( 'Search Fonts' , 'unite-admin' ); ?></h3>
                            <span class="ut-admin-panel-description"><?php esc_html_e( 'Type to search your desired font. A full list of avilable fonts can be found at:' , 'unite-admin' ); ?> <a href="https://www.google.com/fonts" target="_blank" title="Google Fonts"><?php esc_html_e( 'Google', 'unite-admin' ); ?></a></span>
                            
                        </header>
                        
                        <div class="ut-admin-panel-content clearfix">
                            
                            <input autocomplete="off" type="text" class="ut-full-width" id="ut_google_font_selector">
                        
                        </div>
                            
                    </section>
                    
                    <div class="ut-admin-panel-group-parent">
                    
                        <div class="grid-50">
                                                
                            <section class="ut-admin-panel clearfix">
                                
                                <form id="unite-font-manager-form" method="post" action="options.php" enctype="multipart/form-data">
                                        
                                    <header class="ut-admin-panel-header">
                                        
                                        <h3 class="ut-admin-panel-header-title"><?php esc_html_e( 'Font Collection' , 'unite-admin' ); ?></h3>
                                        <span class="ut-admin-panel-description"><?php esc_html_e( 'All your current installed fonts.' , 'unite-admin' ); ?></span>
                                        
                                    </header>
                                        
                                    <div class="ut-admin-panel-content clearfix">
                                        
                                        <div id="ut-google-font-collection" class="ut-sortable-fonts">
                                                                                
                                            <?php if( !empty( $google_fonts ) && is_array( $google_fonts ) ) : ?>
                                            
                                                <?php foreach( (array) $google_fonts as $font => $settings ) : ?>
                                                    
                                                    <?php
                                                                                                        
                                                        /* get font config */
                                                        $font_key = $this->get_google_array_key('family', $settings['family'] );
                                                                                                        
                                                        if( isset( $font_key ) && !is_bool( $font_key ) ) {
                                                            
                                                            $font_config = $this->google_fonts['items'][$font_key];   
                                                        
                                                        }
                                                    
                                                    ?>
                                                    
                                                    <section id="unite_font_id_<?php echo $font; ?>" class="ut-admin-panel clearfix">
                                                        
                                                        <header class="ut-admin-panel-header">
                                    
                                                            <h3 class="ut-admin-panel-header-title">
                                                                <?php echo $font_config['family']; ?>
                                                                <input type="hidden" name="unite_installed_google_fonts[<?php echo $font; ?>][family]" value="<?php echo $font_config['family']; ?>"/>                                                            
                                                            </h3>
                                                            
                                                            <span class="ut-admin-panel-description">
                                                                <?php echo $font_config['version']; ?>
                                                            </span>
                                                            
                                                            <div class="ut-admin-panel-actions">
                                                                <a href="#"><i class="fa fa fa-angle-down"></i></a>
                                                                <a data-fontid="<?php echo $font_key; ?>" data-fontfamily="<?php echo $font; ?>" class="ut-delete-google-font" href="#"><i class="fa fa-trash-o"></i></a>
                                                                <a data-fontid="<?php echo $font_key; ?>" data-fontfamily="<?php echo $font; ?>" class="ut-restore-google-font ut-hide" href="#"><i class="fa fa-recycle"></i></a>
                                                            </div>
                                                            
                                                        </header>
                                                        
                                                        <div class="ut-admin-panel-content clearfix">                                                    
                                                            
                                                            <div class="grid-50">
                                                            
                                                                <h5><?php esc_html_e( 'Available Font Variants', 'unite-admin'); ?></h5>
                                                    
                                                                    <?php foreach( $font_config['variants'] as $variant ) : ?>
                                                                                                                                        
                                                                        <label class="ut-checkbox-label">          
                                                                            
                                                                            <?php $checked = !empty( $settings['variants'] ) && in_array( $variant, $settings['variants'] ) ? 'checked="checked"' : ''; ?>
                                                                                
                                                                            <input <?php echo $checked; ?> type="checkbox" name="unite_installed_google_fonts[<?php echo $font; ?>][variants][]" value="<?php echo $variant; ?>"/>
                                                                            <span class="ut-checkbox"></span>
                                                                            <span class="ut-checkbox-description"><?php echo esc_attr( $variant ); ?></span>
                                                                         
                                                                        </label>      
                                                                            
                                                                    <?php endforeach; ?>
                                                                
                                                                </div>
                                                            
                                                            <div class="grid-50">
                                                            
                                                                <h5><?php esc_html_e( 'Available Font Subsets', 'unite-admin'); ?></h5>
                                                                
                                                                <?php foreach( $font_config['subsets'] as $subset ) : ?>
                                                                    
                                                                    <label class="ut-checkbox-label"> 
                                                                        
                                                                        <?php $checked = !empty( $settings['subsets'] ) && in_array( $subset, $settings['subsets'] ) ? 'checked="checked"' : ''; ?>
                                                                        
                                                                        <input <?php echo $checked; ?> type="checkbox" name="unite_installed_google_fonts[<?php echo $font; ?>][subsets][]" value="<?php echo $subset; ?>" />
                                                                        <span class="ut-checkbox"></span>
                                                                        <span class="ut-checkbox-description"><?php echo esc_attr( $subset); ?></span>
                                                                    
                                                                    </label>
                                                                
                                                                <?php endforeach; ?>                                
                                                            
                                                            </div>
                                                            
                                                            <div class="clear"></div>
                                                            
                                                            <div>
                                                                
                                                                <button data-fontid="<?php echo $font_key; ?>" data-fontfamily="<?php echo $font; ?>" class="ut-backend-button ut-blue-button ut-preview-google-font" type="submit"><?php esc_html_e( 'Preview Font', 'unite-admin'); ?></button>
                                                                <button data-fontid="<?php echo $font_key; ?>" data-fontfamily="<?php echo $font; ?>" class="ut-backend-button ut-blue-button ut-delete-google-font" type="submit"><?php esc_html_e( 'Remove from Collection', 'unite-admin'); ?></button>
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                    </section>
                                                
                                                <?php endforeach; ?>
                                            
                                            <?php endif; ?>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <?php settings_fields( $this->key ); ?>
                                    
                                </form>
                                    
                            </section>
                        
                        </div>
                        
                        <div class="grid-50">
                         
                            <section class="ut-admin-panel clearfix">
                                
                                <header class="ut-admin-panel-header">
                                
                                    <h3 class="ut-admin-panel-header-title"><?php esc_html_e( 'Trash' , 'unite-admin' ); ?></h3>
                                
                                </header>
                                
                                <div class="ut-admin-panel-content clearfix">
                                
                                    <div id="ut-google-font-trash" class="ut-sortable-fonts">
                                    
                                    </div>
                                    
                                </div>                                                        
                                
                            </section>                
                        
                        </div>
                
                    </div>
                    
                </div>
                
                <div class="ut-admin-panel-group ut-hide" id="google-api">                                              

                    <section class="ut-admin-panel clearfix">
                        
                        <header class="ut-admin-panel-header">
                            
                            <h3 class="ut-admin-panel-header-title"><?php esc_html_e( 'Google Font API Key', 'unite-admin' ); ?></h3>
                            <span class="ut-admin-panel-description"><?php esc_html_e( '(optional) If you own a valid Google Font API Key, please insert it here. This allows the theme to have the most curret fonts always available. However the theme itself has a fallback file which is updated with every theme update as well.', 'unite-admin' ); ?></span>
                            
                        </header>
                        
                        <div class="ut-admin-panel-content clearfix">
                            
                            <?php $key = get_option( 'unite_google_fonts_api_key' ); ?>
                                                                    
                            <input form="unite-font-manager-form" value="<?php echo esc_html( $key ); ?>" type="text" name="unite_google_fonts_api_key" class="ut-full-width ut-option-element">
                            <button form="unite-font-manager-form" name="submit" id="submit" class="ut-backend-button ut-green-button" type="submit"><?php esc_html_e('Save' , 'unite-admin'); ?></button>
                                
                        </div>
                        
                    </section>
                
                </div>
                
            </div>
            
       </div>
       <!-- Close UT-Backend-Wrap -->
       
       <div class="ut-options-overlay">
       
            <div class="ut-preview-google-font-wrap">
                                    
                <section class="ut-admin-panel clearfix">
                    
                    <div id="ut-preview-google-font" class="ut-admin-panel-content clearfix">
                        
                        <h1>Grumpy wizards make toxic brew for the evil Queen and Jack.</h1>
                        
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
                        At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, 
                        consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
                        At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                        
                        <!-- <p class="ut-google-font-variants"></p> -->
                            
                    </div>
                    
                    <div class="ut-admin-panel-content clearfix">
                        <button class="ut-backend-button ut-green-button close" type="submit"><?php esc_html_e('Close' , 'unite-admin'); ?></button>
                    </div>
                    
                </section>
                
           </div>       
       
       </div>
       
       
           
       <?php 
    
    }
    
    
    
    /**
     * Fontmanager Admin CSS
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_fontmanager_css() {
        
        $min = NULL;
            
        if( !WP_DEBUG ){
            $min = '.min';
        }
        
        /* grid css file */
        wp_enqueue_style(
            'unite-grid', 
            FW_WEB_ROOT . '/core/admin/assets/css/unite-responsive-grid.css',  
            false, 
            UT_VERSION
        );
        
        /* fontawesome css file */
        wp_enqueue_style(
            'unite-fontawesome', 
            '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome' . $min . '.css'
        );
        
        /* admin ui css file */
        wp_enqueue_style(
            'unite-admin',
            FW_WEB_ROOT . '/core/admin/assets/css/unite-admin.css', 
            false, 
            UT_VERSION
        ); 
        
        /* fontmanager css file */
        wp_enqueue_style(
            'unite-fontmanager', 
            FW_WEB_ROOT . '/core/admin/assets/css/unite-fontmanager-admin.css', 
            false, 
            UT_VERSION
        );
     
    }
    
    /**
     * Admin Fontmanager JS
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_fontmanager_js() {
    
        wp_enqueue_script(
            'unite-fontmanager-js', 
            FW_WEB_ROOT . '/core/admin/assets/js/unite-fontmanager-admin.js', 
            array('jquery', 'jquery-ui-autocomplete', 'jquery-ui-droppable', 'jquery-ui-draggable', 'jquery-ui-sortable', 'jquery-ui-accordion', 'jquery-effects-highlight'), 
            UT_VERSION
        );
        
        $localized_array = array(
            'fonts' => $this->google_font_js_array(),
        );
        
        wp_localize_script( 'unite-fontmanager-js', 'unite_google_fonts', $localized_array );            
    
    }
    
    
    /**
     * Validate Google API Key
     * @since     1.0.0
     * @version   1.0.0
     */
    public function validate_key( $key ) {
        
        return sanitize_text_field( $key );
        
    }
    
    /**
     * Validate Selected Fonts
     * @since     1.0.0
     * @version   1.0.0
     */
    public function validate_fonts( $key ) {
                    
        /* @todo sanitize font settings array */
        return $key;
        
    }
    

}

/* get it started */
if( apply_filters( 'ut_google_fonts', true ) ) {
    
    $ut_font_manager = new UT_Font_Manager(); 
    
    add_action( 'wp_ajax_get_font_settings_box', array( $ut_font_manager, 'get_font_settings_box' ) );
    
    
}
    
