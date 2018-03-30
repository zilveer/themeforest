<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

class UT_Admin_home {
    
    /**
     * Slug
     * @var string
     */
    private $key = 'unite-home';    
    
     /**
     * Theme Data
     * @var array
     */
    private $theme = array(); 
    
    /**
     * Home Title
     * @var string
     */
    protected $title = '';
        
    /**
     * Constructor
     * @since     1.0.0
     * @version   1.0.0
     */
    public function __construct() {
        
        $this->title = esc_html__( 'Welcome', 'unite-admin' );
        $this->hooks();
            
    }
    
     /**
     * Initiate our hooks
     * @since     1.0.0
     * @version   1.0.0
     */
    public function hooks() {
        
        $this->theme = wp_get_theme();
        
        /* add menu item */
        add_action( 'admin_menu' , array( $this , 'add_menu_item' ) );
        
    }
    
    /**
     * Add to menu
     * @since     1.0.0
     * @version   1.0.0
     */
    public function add_menu_item() {
            
        $this->options_page = add_menu_page(
            esc_html( $this->theme ),
            esc_html( $this->theme ),
            'manage_options',
            'unite-welcome-page',
            array( $this , 'admin_page_display' ),
            THEME_WEB_ROOT .'/unite-custom/admin/assets/img/icons/theme_icon.png',
            60
        );
        
    }
    
    /**
     * Fetch Theme Feeds for Cross Marketing
     * @since     1.1.0
     * @version   1.0.0
     */ 
    function fetch_theme_feeds() {
        
        // @ todo
    
    } 
    
    /**
     * Admin page markup
     * @since    1.0
     * @version  1.0.0
     */
    public function admin_page_display() { ?>
                    
        <div id="unite-home-welcome" class="clearfix">
            
            <?php $theme = wp_get_theme(); ?>
            
            <div class="unite-hero-unit">
                <h1>
                    <?php printf( esc_html__( 'Welcome to %1$s!', 'unite-admin' ), esc_html( $theme ) ); ?>
                </h1>
                <p><?php esc_html_e( 'Thank you for purchasing our theme. We\'re as excited as you are about the possibilities before you. Finally, its going to be far less complicated to make your WordPress website pages look and feel the way you want. We’ve assembled some links to get you started with the theme, maintain your site and help you to get an overview of all features available.', 'unite-admin' ); ?></p>
            </div>
            
            <div class="grid-33 tablet-grid-50 mobile-grid-100 unite-home-box">
                
                <div class="unite-home-box-inner">
                
                    <h3><?php esc_html_e( 'Theme Options', 'unite-admin' ); ?></h3>
                    <img alt="<?php esc_html_e( 'Theme Options', 'unite-admin' ); ?>" src="<?php echo FW_WEB_ROOT; ?>/core/admin/assets/img/icons/theme-options.png">
                    
                    <p class="unite-home-box-description"><?php esc_html_e( 'The main tool to manage the visual appearance of the theme as well as the global main settings.', 'unite-admin' ); ?></p>
                    
                    <a class="button button-primary button-hero" href="<?php echo get_admin_url(); ?>admin.php?page=<?php echo apply_filters( 'ut_theme_options_page', 'unite-theme-options' ); ?>"><?php esc_html_e( 'Load Theme Options', 'unite-admin' ); ?></a>
                
                </div>
                
            </div>
            
            <div class="grid-33 tablet-grid-50 mobile-grid-100 unite-home-box">
                
                <div class="unite-home-box-inner">
                
                    <h3><?php esc_html_e( 'Demo Importer', 'unite-admin' ); ?></h3>
                    <img alt="<?php esc_html_e( 'Demo Importer', 'unite-admin' ); ?>" src="<?php echo FW_WEB_ROOT; ?>/core/admin/assets/img/icons/theme-demo-importer.png">
                    
                    <p class="unite-home-box-description"><?php esc_html_e( 'Our unique One Click Demo Importer for a quick and easy setup. No need to deal with XML files! Simply choose your desired layout, load it and enjoy!', 'unite-admin' ); ?></p>
                    
                    <a class="button button-primary button-hero" href="<?php echo get_admin_url(); ?>admin.php?page=<?php echo apply_filters( 'ut_demo_importer_page', 'unite-demo-importer' ); ?>"><?php esc_html_e( 'Load Demo Importer', 'unite-admin' ); ?></a>
                    
                </div>
                
            </div>            
            
            <?php if( apply_filters( 'ut_activate_sidebars', true ) ) : ?>
            
            <div class="grid-33 tablet-grid-50 mobile-grid-100 unite-home-box">
                
                <div class="unite-home-box-inner">
                    
                    <h3><?php esc_html_e( 'Sidebar Management', 'unite-admin' ); ?></h3>                        
                    <img alt="<?php esc_html_e( 'Sidebar Management', 'unite-admin' ); ?>" src="<?php echo FW_WEB_ROOT; ?>/core/admin/assets/img/icons/theme-sidebar-options.png">
                    
                    <p class="unite-home-box-description"><?php printf( esc_html__( 'A sidebar tool to create and manage sidebars. After creating a sidebar simply add widgets as usual %s.', 'unite-admin' ), '<a href="' . get_admin_url() . 'widgets.php">' . esc_html__( 'here', 'unite-admin' ) . '</a>' ); ?></p>
                    
                    <a class="button button-primary button-hero" href="<?php echo get_admin_url(); ?>admin.php?page=<?php echo apply_filters( 'ut_sidebars_page', 'unite-sidebars' ); ?>"><?php esc_html_e( 'Manage Sidebars', 'unite-admin' ); ?></a>
                    
                </div>
                
            </div>
            
            <?php endif; ?>
            
            <?php if( apply_filters( 'ut_google_fonts', true ) ) : ?>
            
            <div class="grid-33 tablet-grid-50 mobile-grid-100 unite-home-box">
                
                <div class="unite-home-box-inner">
                
                    <h3><?php esc_html_e( 'Theme Fonts', 'unite-admin' ); ?></h3>                      
                    <img alt="<?php esc_html_e( 'Theme Fonts', 'unite-admin' ); ?>" src="<?php echo FW_WEB_ROOT; ?>/core/admin/assets/img/icons/theme-fonts.png">                        
                    
                    <p class="unite-home-box-description"><?php printf( esc_html__( 'Integrate your desired %1$s into your website with the help of our font management tool. Fonts added to the theme are getting available inside the %2$s automatically.', 'unite-admin' ), '<a target="_blank" href="https://www.google.com/fonts">' . esc_html__( 'Google Font', 'unite-admin' ) . '</a>' , '<a href="' . get_admin_url() . 'admin.php?page=unite-theme-options">' . esc_html__( 'Theme Options', 'unite-admin' ) . '</a>' ); ?></p>
                    
                    <a class="button button-primary button-hero" href="<?php echo get_admin_url(); ?>admin.php?page=unite-theme-fonts"><?php esc_html_e( 'Manage Theme Fonts', 'unite-admin' ); ?></a>
                    
                </div>
                    
            </div>
            
            <?php endif; ?>
            
            <?php if( apply_filters( 'ut_show_header_manager', false ) ) : ?>
            
            <div class="grid-33 tablet-grid-50 mobile-grid-100 unite-home-box">
                
                <div class="unite-home-box-inner">
                
                    <h3><?php esc_html_e( 'Header Manager', 'unite-admin' ); ?></h3>                      
                    <img alt="<?php esc_html_e( 'Header Manager', 'unite-admin' ); ?>" src="<?php echo FW_WEB_ROOT; ?>/core/admin/assets/img/icons/theme-header-manager.png">                        
                    
                    <p class="unite-home-box-description"></p>
                    
                    <a class="button button-primary button-hero" href="<?php echo get_admin_url(); ?>admin.php?page=unite-header-manager"><?php esc_html_e( 'Manage Theme Headers', 'unite-admin' ); ?></a>
                    
                </div>
                    
            </div>
            
            <?php endif; ?>
           
            <div class="grid-33 tablet-grid-50 mobile-grid-100 unite-home-box">
                
                <div class="unite-home-box-inner">
                
                    <h3><?php esc_html_e( 'Theme Health Status', 'unite-admin' ); ?></h3>                      
                    <img alt="<?php esc_html_e( 'Theme Health Status', 'unite-admin' ); ?>" src="<?php echo FW_WEB_ROOT; ?>/core/admin/assets/img/icons/theme-health-status.png">                        
                    
                    <p class="unite-home-box-description"><?php esc_html_e( 'The System Health Status report is a vital tool for troubleshooting issues with your site. With a wide variety of sections and fields, you can check software versions, server settings and WordPress configuration.', 'unite-admin' ); ?></p>
                    
                    <a class="button button-primary button-hero" href="<?php echo get_admin_url(); ?>admin.php?page=unite-theme-info"><?php esc_html_e( 'View Health Status', 'unite-admin' ); ?></a>
                    
                </div>
                    
            </div>
            
            <div class="grid-33 tablet-grid-50 mobile-grid-100 unite-home-box">
                
                <div class="unite-home-box-inner">
                
                    <h3><?php esc_html_e( 'Theme Support', 'unite-admin' ); ?></h3>
                    <img alt="<?php esc_html_e( 'Theme Support', 'unite-admin' ); ?>" src="<?php echo FW_WEB_ROOT; ?>/core/admin/assets/img/icons/theme-support.png">
                    
                    <p class="unite-home-box-description"><?php esc_html_e( 'We consider support as important as our theme development. If you need help, get all of your questions answered quickly with exclusive access to our dedicated support forum. It’s free and easy to use.', 'unite-admin' ); ?></p>
                            
                    <a class="button button-primary button-hero" href="http://helpdesk.unitedthemes.com/"><?php esc_html_e( 'Go to Theme Support', 'unite-admin' ); ?></a>
                    
                </div>
                    
            </div>
                       
            <!-- <div class="grid-33 tablet-grid-50 mobile-grid-100 unite-home-box">
                
                <div class="unite-home-box-inner">
                
                    <h3><?php esc_html_e( 'Theme Documentation', 'unite-admin' ); ?></h3>
                    <img alt="<?php esc_html_e( 'Theme Documentation', 'unite-admin' ); ?>" src="<?php echo FW_WEB_ROOT; ?>/core/admin/assets/img/icons/theme-documentation.png">                        
            
                    <p class="unite-home-box-description"><?php esc_html_e( '', 'unite-admin' ); ?></p>
                    
                    <a class="button button-primary button-hero" href="http://knowledgebase.unitedthemes.com/"><?php esc_html_e( 'Go to Theme Documentation', 'unite-admin' ); ?></a>
                    
                </div>
                
            </div>-->
            
            <?php if( apply_filters( 'ut_show_export_import', false ) ) : ?>
                
                <div class="grid-33 tablet-grid-50 mobile-grid-100 unite-home-box">
                    
                    <div class="unite-home-box-inner">
                        
                        <h3><?php esc_html_e( 'Theme Options Import / Export', 'unite-admin' ); ?></h3>
                        <img alt="<?php esc_html_e( 'Theme Options Import / Export', 'unite-admin' ); ?>" src="<?php echo FW_WEB_ROOT; ?>/core/admin/assets/img/icons/theme-import-export.png">
                        
                        <p class="unite-home-box-description"><?php esc_html_e( 'Easily migrate or backup theme, sidebar and font settings. This does not execute an entire backup.', 'unite-admin' ); ?></p>
                        
                        <a class="button button-primary button-hero" href="<?php echo get_admin_url(); ?>admin.php?page=unite-import-export"><?php esc_html_e( 'Load Import / Export', 'unite-admin' ); ?></a>
                        
                    </div> 
                        
                </div>
            
            <?php endif; ?>
                              
    
        </div>            
        
    <?php /* end admin page display */
    
    }
    
}

new UT_Admin_home();