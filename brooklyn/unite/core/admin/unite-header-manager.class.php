<?php defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );
    
class UT_Header_Manager {
    
     /**
     * Header option key, and header manager admin page slug
     * @var string
     */
     
    private $key = 'unite-header-manager';
    
    /**
     * Haedermanager Options Title
     * @var string
     */
    private $title = '';
    
    
    public function __construct() {
        
        /* Title */            
        $this->title = esc_html__( 'Theme Headers', 'unite-admin' );
        
        /* run hooks */
        $this->hooks();
        
    }    
    
    
    /**
     * Initiate our hooks
     *
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
        
            add_action( 'admin_enqueue_scripts', array( $this , 'register_headermanager_css' ) );
            add_action( 'admin_enqueue_scripts', array( $this , 'register_headermanager_js' ) );
        
        }
    
    }
    
    
    /**
     * Register Settings
     *
     * @since     1.0.0
     * @version   1.0.0
     *
     */
    
    public function register_settings() {
        
        register_setting( 
            $this->key, 
            'unite_header_settings', 
            array( $this, 'validate_settings' ) 
        );        
    
    }    
    
    /**
     * Register Sections
     *
     * @since     1.0.0
     * @version   1.0.0
     *
     */
    
    public function register_sections() {
        
        add_settings_section( 
            'unite_header_settings_section', 
            esc_html__( 'Settings', 'unite-admin' ), 
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
     *
     */
    public function display_section() { /* nothing to do here */ }
    
    
    /**
     * Add Settings Fields
     *
     * @since     1.0.0
     * @version   1.0.0
     *
     */
    
    public function register_settings_fields() {
        
        add_settings_field( 
            'unite_header_settings', 
            esc_html__( 'Header Settings', 'unite-admin' ), 
            array( $this , 'header_settings_input' ), 
            $this->key, 
            'unite_header_settings_section', 
            array( 'name' => 'unite_header_settings')
        );    
    
    }
    
    
    /**
     * Header Settings Fields
     *
     * @since     1.0.0
     * @version   1.0.0
     *
     */        
    public function header_settings_input( $args ) {
        
        /* extract args */
        extract( $args );
        
        /* get option */
        $option = get_option( $name );
        
        $data = '';
        if( $option && strlen( $option ) > 0 && $option != '' ) {
            $data = $option;
        }        
    
    }
    
    /**
     * Add to menu
     *
     * @since     1.0.0
     * @version   1.0.0
     *
     */
    public function add_menu_item() {
        
        $this->options_page = add_submenu_page( 'unite-welcome-page', $this->title, $this->title, 'manage_options', $this->key, array( $this , 'admin_page_display' ) );
        
    }
        
    
    /**
     * Header Manager Admin CSS
     *
     * @since     1.0.0
     * @version   1.0.0
     *
     */
    public function register_headermanager_css() {
        
        $min = NULL;
            
        if( !WP_DEBUG ){
            $min = '.min';
        }
        
        wp_enqueue_style(
            'unite-grid', 
            FW_WEB_ROOT . '/core/admin/assets/css/unite-responsive-grid' . $min . '.css',  
            false, 
            UT_VERSION
        );
        
        wp_enqueue_style(
            'unite-fontawesome', 
            '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome' . $min . '.css'
        );
        
        wp_enqueue_style(
            'unite-modal', 
            FW_WEB_ROOT . '/core/admin/assets/vendor/custombox/css/custombox' . $min . '.css',   
            false, 
            UT_THEME_VERSION
        );
        
        wp_enqueue_style(
            'unite-headermanager', 
            FW_WEB_ROOT . '/core/admin/assets/css/unite-header-manager-admin' . $min . '.css',   
            array('unite-modal'), 
            UT_THEME_VERSION
        );
        
    
    } 
    
    /**
     * Header Manager Admin JS
     *
     * @since     1.0.0
     * @version   1.0.0
     */
    public function register_headermanager_js() {
        
        $min = NULL;
            
        if( !WP_DEBUG ){
            $min = '.min';
        }
        
        wp_enqueue_script(
            'unite-modal',
            FW_WEB_ROOT . '/core/admin/assets/vendor/custombox/js/custombox' . $min . '.js'
        );
        
        wp_enqueue_script(
            'unite-headermanager',
            FW_WEB_ROOT . '/core/admin/assets/js/unite-header-manager-admin' . $min . '.js', 
            array(
                'jquery',
                'jquery-ui-droppable',
                'jquery-ui-draggable',
                'jquery-ui-sortable',
                'jquery-effects-highlight',
                'unite-modal'
            ),
            UT_THEME_VERSION
        );
        
    
    
    }
    
    

    
    
    
    
    
    
    
    
    /**
     * Admin Page Markup
     *
     * @since     1.0.0
     * @version   1.0.0
     *
     */
    public function admin_page_display() { ?>
            
        <!-- Start UT-Backend-Wrap -->
        <div id="ut-header-manager" class="ut-admin-wrap clearfix">
                            
            <div class="ut-backend-top-bar clearfix">
                
                <a class="ut-backend-logo hide-on-tablet hide-on-mobile" href="<?php echo get_admin_url(); ?>admin.php?page=unite-welcome-page" title="UnitedThemes">
                    <img src="<?php echo FW_WEB_ROOT . '/core/admin/assets/img/ut_logo_white.png'; ?>" alt="United Themes" />
                </a>
                
                <h2>
                    <?php esc_html_e( 'Header Manager', 'unite-admin' ); ?>                    
                </h2>
                
                <span class="hide-on-tablet hide-on-mobile">by United Themes - Framework Version: <?php echo UT_VERSION; ?></span>
                
            </div>
            <!-- Close UT-Backend-Topbar -->
            
            <!-- Start UT-Admin-Main -->                
            <div class="ut-admin-main">
                
                
                
                
                <form id="unite-header-manager-form" method="post" action="options.php" enctype="multipart/form-data" class="grid-80">
                    
                    <fieldset>
                    
                        <legend><?php esc_html_e('Upper Header Area', 'unite-admin'); ?><a href="#unite-upper-header-settings" class="unite-header-section-setting"></a></legend>
                        
                        <div id="unite-upper-header-settings" class="unite-header-settings-section">
                            
                            Settings Here! 
                        
                        </div>                        
                                        
                        <div id="unite-upper-header" data-section="upper-header" class="unite-header-section">
                        
                            <div id="unite-upper-left-header" data-inner-section="upper-left-header" class="unite-header-part">
                                
                                
                                <a class="unite-add-element" href="" data-for="upper-left-header"></a>
                                   
                            </div>
                            
                            <div id="unite-upper-center-header" data-inner-section="upper-center-header" class="unite-header-part">
                                
                                
                                <a class="unite-add-element" href="" data-for="upper-center-header"></a>
                                
                            </div>
                            
                            <div id="unite-upper-right-header" data-inner-section="upper-right-header" class="unite-header-part">
                                
                                
                                <a class="unite-add-element" href="" data-for="upper-center-header"></a>    
                                
                            </div>
                        
                        </div>
                    
                    </fieldset>
                    
                    <fieldset>
                    
                        <legend><?php esc_html_e('Middle Header Area', 'unite-admin'); ?><a href="#unite-mid-header-settings" class="unite-header-section-setting"></a></legend>
                        
                        <div id="unite-mid-header-settings" class="unite-header-settings-section">
                        
                        
                        </div>
                        
                        <div id="unite-mid-header" class="unite-header-section">
                            
                            <div id="unite-mid-left-header" data-inner-section="mid-left-header" class="unite-header-part">
                                
                                
                                <a class="unite-add-element" href="" data-for="mid-left-header"></a>
                                        
                            </div>
                            
                            <div id="unite-mid-center-header" data-inner-section="mid-center-header" class="unite-header-part">
                                    
                                
                                <a class="unite-add-element" href="" data-for="mid-center-header"></a>
                                        
                            </div>
                            
                            <div id="unite-mid-right-header" data-inner-section="mid-right-header" class="unite-header-part">
                                
                                
                                <a class="unite-add-element" href="" data-for="mid-right-header"></a>
                                    
                            </div>                    
                        
                        </div>
                    
                    </fieldset>
                    
                    <fieldset>
                        
                        <legend><?php esc_html_e('Lower Header Area', 'unite-admin'); ?><a href="#unite-lower-header-settings" class="unite-header-section-setting"></a></legend>
                        
                        <div id="unite-lower-header-settings" class="unite-header-settings-section">
                        
                        
                        </div>
                        
                        <div id="unite-lower-header" class="unite-header-section">
                            
                            <div id="unite-lower-left-header" data-inner-section="lower-left-header" class="unite-header-part">
                                
                                
                                <a class="unite-add-element" href="" data-for="lower-left-header"></a>
                                    
                            </div>
                            
                            <div id="unite-lower-center-header" data-inner-section="lower-center-header" class="unite-header-part">
                                
                                
                                <a class="unite-add-element" href="" data-for="lower-center-header"></a>
                                    
                            </div>
                            
                            <div id="unite-lower-right-header" data-inner-section="lower-right-header" class="unite-header-part">
                                
                            
                                <a class="unite-add-element" href="" data-for="lower-right-header"></a>    
                                
                            </div>                    
                        
                        </div>                    
                    
                    </fieldset>
                    
                </form>
                
                <div id="unite-header-manager-settings" class="grid-20">
                
                    Setttings
                
                </div>
            
            </div>            
            
        </div>
        
    <?php }
    
    /**
     * Validate Header Settings
     *
     * @since     1.0.0
     * @version   1.0.0
     */
    public function validate_settings( $key ) {
                    
        return $key;
        
    }
    

}

if( apply_filters( 'ut_show_header_manager', false ) ) {

    new UT_Header_Manager();

}