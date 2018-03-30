<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

class UT_Import_Export {
    
    /**
     * Import Export option key, and sidebar admin page slug
     * @var string
     */
    private $key = 'unite-import-export';

    /**
     * Import Export Title
     * @var string
     */
    protected $title = '';
    
    
    /**
     * Constructor
     * @since     1.0.0
     * @version   1.0.0
     */
    public function __construct() {
        
        $this->title = esc_html__( 'Import / Export', 'unite-admin' );
        
        /* run hooks */
        $this->hooks();
            
    }
    
    /**
     * Initiate our hooks
     * @since     1.0.0
     * @version   1.0.0
     */
    public function hooks() {
        
        /* necessary scripts */ 
        if ( isset( $_GET['page'] ) && $this->key == $_GET['page'] ) {
            
            /* load js */
            add_action( 'admin_enqueue_scripts', array( $this , 'enqueue_import_js' ) );
        
        }
        
        /* add menu item */
        add_action( 'admin_menu' , array( $this , 'add_menu_item' ) );
        
        /* import */
        add_action( 'admin_init', array( $this, 'import_settings' ) );
        
        
        if ( isset( $_GET['page'] ) && $this->key == $_GET['page'] ) {
            
            /* add notices after import */
            add_action( 'admin_notices', array( $this, 'show_notices' ) );
        
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
     * Admin page markup
     * @since    1.0
     * @version  1.0.0
     */
    public function admin_page_display() { ?>
        
        <form id="ut-importer-export-form" method="post" action="?page=<?php echo $this->key; ?>">
        
        <!-- Start UT-Backend-Wrap -->
        <div class="ut-admin-wrap clearfix">
            
            <div class="ut-backend-top-bar clearfix">
                
                <a class="ut-backend-logo hide-on-tablet hide-on-mobile" href="<?php echo get_admin_url(); ?>admin.php?page=unite-welcome-page" title="UnitedThemes">
                    <img src="<?php echo FW_WEB_ROOT . '/core/admin/assets/img/ut_logo_white.png'; ?>" alt="United Themes" />
                </a>
                
                <h2>
                    <?php esc_html_e( 'Unite Import / Export Tool', 'unite-admin' ); ?>                    
                </h2>
                
                <span class="hide-on-tablet hide-on-mobile">by United Themes - Framework Version: <?php echo UT_VERSION; ?></span>
                
            </div>
            <!-- Close UT-Backend-Topbar -->
                            
            <!-- Start UT-Admin-Main -->                
            <div class="ut-admin-main">
                
                <!-- Start UT-Admin-Header -->
                <header class="ut-admin-header clearfix">
                    
                    <h3 class="ut-admin-header-title">
                        <?php esc_html_e( 'Theme Options', 'unite-admin' ); ?>
                    </h3>
                    
                </header>
                <!-- Cose UT-Admin-Header -->
                
                <div class="ut-breadcrumb">
                
                    <ul>
                        <li class="ut-breadcrumb-root"><i class="fa fa-info"></i></li>
                        <li><?php esc_html_e( 'Only for theme options!', 'unite-admin' ); ?></li>
                    </ul>
                    
                </div>
                
                <div class="ut-admin-panel-group ut-show">
                
                    <section class="ut-admin-panel">
                        
                        <!-- Start UT-Admin-Header -->
                        <header class="ut-admin-panel-header">
                                
                            <h3 class="ut-admin-panel-header-title "><?php esc_html_e( 'Export', 'unite-admin' ); ?></h3>
                            <span class="ut-admin-panel-description"><?php esc_html_e( 'Theme and Sidebar Options to export. Place the content of this field inside the import field of your new installation.', 'unite-admin' ); ?></span>
                        
                        </header>
                        <!-- Cose UT-Admin-Header -->
                        
                        <div class="ut-admin-panel-content clearfix">
                            
                            <?php 
                            
                            /* fetch theme layouts */
                            $current_theme_layouts = get_option( ut_options_layout_key() );
                            
                            if( is_array( $current_theme_layouts ) && !empty( $current_theme_layouts ) ) {
                                
                                $export_array['unite_theme_supports_layouts'] = true;
                                                        
                                foreach( $current_theme_layouts as $key => $layout ) {
                                    
                                    /* create theme layout list */
                                    $export_array['unite_theme_layouts'][$key] = $layout;
                                    
                                    /* get layout options */    
                                    $layout_options = get_option( $key ); 
                                    
                                    /* create layout options */ 
                                    $export_array['unite_theme_layouts_options'][$key] = $layout_options;
                                    
                                }
                            
                            }
                            
                            /* fetch theme options */
                            $current_theme_options = get_option( ut_options_key() );                                        
                            $export_array[ut_options_key()] = $current_theme_options;
                            
                            /* fetch dynamic sidebars */
                            $option_to_export = get_option('unite_theme_sidebars'); /* dynamic sidebars */                       
                            $export_array['unite_theme_sidebars'] = $option_to_export;
                            
                            /* fetch sidebar options */
                            $option_to_export = get_option('unite_blog_sidebar_align'); /* blog sidebar align  */                       
                            $export_array['unite_theme_sidebar_settings']['unite_blog_sidebar_align'] = $option_to_export;
                            
                            $option_to_export = get_option('unite_blog_primary_sidebar'); /* blog primary sidebar */                       
                            $export_array['unite_theme_sidebar_settings']['unite_blog_primary_sidebar'] = $option_to_export;
                            
                            $option_to_export = get_option('unite_page_sidebar_align'); /* page sidebar align */                       
                            $export_array['unite_theme_sidebar_settings']['unite_page_sidebar_align'] = $option_to_export;
                            
                            $option_to_export = get_option('unite_page_primary_sidebar'); /* page primary sidebar */                       
                            $export_array['unite_theme_sidebar_settings']['unite_page_primary_sidebar'] = $option_to_export;
                            
                            /* serialize export array */                            
                            $export_array = maybe_serialize($export_array);
                             
                            ?>
                            
                            <textarea id="unite_options_export" class="ut-full-width ut-option-element"><?php echo ut_base_encode( $export_array ); ?></textarea>
                          
                        </div>
                    
                    </section>
                    
                    <section class="ut-admin-panel">
                        
                        <!-- Start UT-Admin-Header -->
                        <header class="ut-admin-panel-header">
                                
                            <h3 class="ut-admin-panel-header-title "><?php esc_html_e( 'Import', 'unite-admin' ); ?></h3>
                            <span class="ut-admin-panel-description"><?php esc_html_e( 'Theme and Sidebar Options to import. Place the content of the old installation export field inside this one and hit "Import".', 'unite-admin' ); ?></span>
                        
                        </header>
                        <!-- Cose UT-Admin-Header -->
                        
                        <div class="ut-admin-panel-content clearfix">
                            
                            <textarea name="unite_import_options" id="unite_import_options" class="ut-full-width ut-option-element"></textarea>
        
                            <input type="hidden" name="unite_import_export" value="unite_run_import" />
                            <input type="hidden" name="unite_import_export_nonce" value="<?php echo wp_create_nonce( 'unite-import-export-nonce' ); ?>" />
                            <input type="submit" value="<?php esc_html_e( 'Import' , 'unite-admin' ); ?>" class="button button-primary" id="submit" name="submit">
                            
                        </div>
                    
                    </section>
                
                </div>
            
            </div>                
            <!-- Close UT-Admin-Main -->
        
        </div>
        <!-- Close UT-Backend-Wrap -->
        
        </form>
        
    <?php }        
    
    public function import_settings() {
                                       
        /* check for import */
        if( !empty( $_REQUEST['unite_import_options'] ) && isset( $_REQUEST['unite-import-export'] ) && $_REQUEST['unite-import-export'] == 'unite_run_import' ) {
            
            /* get nonce */
            $nonce = $_REQUEST['unite_import_export_nonce'];
            
            /* check if nonce is set and correct */
            if ( ! wp_verify_nonce( $nonce, 'unite-import-export-nonce' ) ) {
                wp_die( 'Busted!');
            }                
            
            if ( current_user_can( 'manage_options' ) ) {
            
                $import = ut_base_decode( $_REQUEST['unite_import_options'] );
                
                if( is_serialized( $import ) ) {
                                                                                                                
                    /* run import function */
                    $import = ut_load_theme_option( maybe_unserialize( $import ) );
                    
                } else {
                    
                    wp_redirect( admin_url( 'themes.php?page=' . $this->key . '&unite_notification=error' ) );     
                
                }
            
            } else {
            
                 wp_redirect( admin_url( 'themes.php?page=' . $this->key . '&unite_notification=permission' ) );
            
            }
            
            if( $import ) {
                
                wp_redirect( admin_url( 'themes.php?page=' . $this->key . '&unite_notification=success' ) );
                
            } else {
                
                wp_redirect( admin_url( 'themes.php?page=' . $this->key . '&unite_notification=error' ) );
            
            }                
        
        } 
    
    }
    
    
    public function show_notices() {
        
        /* wrong permissions */
        if( isset( $_GET['unite_notification'] ) && $_GET['unite_notification'] == 'error' ) {
        
            echo '<div class="error">';
                echo '<p>' , esc_html__( 'An Error occured during your import, please contact your site administrator!', 'unite-admin' ) , '</p>';
            echo '</div>';
        
        } 
        
        /* wrong permissions */
        if( isset( $_GET['unite_notification'] ) && $_GET['unite_notification'] == 'permission' ) {
        
            echo '<div class="error">';
                echo '<p>' , esc_html__( 'You are not allowed to import theme options!', 'unite-admin' ) , '</p>';
            echo '</div>';
        
        }            
        
        /* update was successful */
        if( isset( $_GET['unite_notification'] ) && $_GET['unite_notification'] == 'success' ) {
        
            echo '<div class="updated">';
                echo '<p>' , esc_html__( 'Import was successful!', 'unite-admin' ) , '</p>';
            echo '</div>';
        
        }
        
    
    }
    
    public function enqueue_import_js() {

        wp_register_script(
            'unite-importer-exporter', 
            FW_WEB_ROOT . '/core/admin/assets/js/unite-import-export.js', 
            array('jquery'), 
            UT_VERSION
        );
        
        wp_enqueue_script('unite-importer-exporter');
        
        $localized_array = array(
            'message'  => esc_html__( 'Are you sure? The import will start immediately!', 'unite-admin' ),
        );

        /* localized script admin */
        wp_localize_script( 'unite-importer-exporter', 'unite_importer', $localized_array ); 
        
        
    }
    
       
}

/* get it started */
if( apply_filters( 'ut_show_export_import', false ) ) {
    
    new UT_Import_Export();    
    
}

