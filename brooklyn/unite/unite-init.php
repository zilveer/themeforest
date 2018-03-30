<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * Constants
 *
 * @since     1.0.0
 * @version   1.0.0
 *
 */

/* framework version */
define( 'UT_VERSION' ,  '1.1' );

/* theme web url & theme document root */
define( 'THEME_WEB_ROOT' , get_template_directory_uri() );
define( 'THEME_DOCUMENT_ROOT' , get_template_directory() );

/* theme style web url & theme style document root */
define( 'STYLE_WEB_ROOT' , get_stylesheet_directory_uri() );
define( 'STYLE_DOCUMENT_ROOT' , get_stylesheet_directory() );

/* framework web url & framework document root */
define( 'FW_WEB_ROOT' , THEME_WEB_ROOT . '/' . 'unite' );
define( 'FW_DOCUMENT_ROOT' , THEME_DOCUMENT_ROOT . '/' . 'unite' );

/* framework custom web url & framework custom document root */
define( 'FW_STYLE_WEB_ROOT' , STYLE_WEB_ROOT . '/' . 'unite-custom' );
define( 'FW_STYLE_DOCUMENT_ROOT' , STYLE_DOCUMENT_ROOT . '/' . 'unite-custom' );

/** 
 * Load files from parent and if applicable from child
 *
 * @param    filename 
 * @param    bolean
 *
 * @return    void
 *
 * @access    private
 * @since     1.0.0
 * @version   1.1.0
 */
 
if( !function_exists('_unite_load_file') ) {
    
    function _unite_load_file( $file, $child = false ) {
        
        /* files inside parent theme */
        if( !$child ) {
            
            $file = THEME_DOCUMENT_ROOT . '/' . $file;
            
            include( $file );
            
        }
        
        /* file can be in child theme but it's not mandatory */
        if( $child ) {

            /* check for file in child theme */
            if( file_exists( STYLE_DOCUMENT_ROOT . '/' . $file ) ) { 
                
                $file = STYLE_DOCUMENT_ROOT . '/' . $file;
                
                include( $file );
                                
            /* check for file in parent theme */
            } else {                    
                
                $file = THEME_DOCUMENT_ROOT . '/' . $file;
                
                include( $file );
            
            }                
            
        }        
        
    }

}

/** 
 * Load all php files from specific folder
 *
 * @param     foldername 
 *
 * @return    void
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */
 
if( !function_exists('_unite_load_file_folder') ) {
    
    function _unite_load_file_folder( $folder, $child = false ) {
        
        /* get list of files from parent theme first */
        $files = scandir( THEME_DOCUMENT_ROOT . '/' . $folder );
        
        foreach( $files as $file ){
            
            if( $file != '.' && $file != '..' ) {
                
                _unite_load_file( $folder . $file, $child );    
                
            }
            
        }       
        
    }

}


/**
 * Load some base files first
 *
 * @since     1.0.0
 * @version   1.1.0
 *
 */

/* config theme */ 
_unite_load_file( 'unite-custom/ut-theme-config.php', true );

/* config theme */ 
_unite_load_file( 'unite/theme/unite-mobile-detect.php', true );

/* theme custom inc */
_unite_load_file_folder( 'unite-custom/includes/' , true ); 

/* theme filters and actions */
_unite_load_file( 'unite-custom/ut-theme-filters-and-actions.php', true );

/* theme helper functions file */
_unite_load_file( 'unite/core/helper/unite-helpers.php' ); 

/* theme core functions file */
_unite_load_file( 'unite/theme/unite-theme-core.php' );

/* theme base hooks */
_unite_load_file( 'unite/theme/unite-theme-hooks.php' );

/* ajax functions */
_unite_load_file( 'unite/theme/unite-theme-ajax.php' );

if( is_admin() ) {
    
    /* theme activation hook */
    _unite_load_file( 'unite-custom/ut-theme-activation.php', true );
    
    /* plugin activation class */ 
    _unite_load_file( 'unite/theme/unite-plugin-activation.php' );
    
    /* plugin activation function*/ 
    _unite_load_file( 'unite-custom/plugins/ut-theme-plugin-activation.php' );

}

/* widgets */
_unite_load_file_folder( 'unite-custom/widgets/', true ); 


/**
 * Init Class
 *
 * @since     1.0.0
 * @version   1.0.0
 *
 */
if ( ! class_exists( 'UT_Loader' ) ) {

    class UT_Loader {
        
        /**
         * The loader that's responsible for maintaining and registering all hooks that power
         * the theme.
         *
         * @since    1.1.0
         * @access   protected
         * @var      UT_Loader  $loader  Maintains and registers all hooks for the framework.
         */
        protected $loader;
         
        /**
         * The current version of the framework.
         *
         * @since    1.0.0
         * @access   protected
         * @var      string    $version    The current version of the framework.
         */
        protected $version;                
        
        
       /**
         * The domain specified for this theme.
         *
         * @since    1.0.0
         * @access   private
         * @var      string    $domain
         */
        private $domain;
        
                
        /**
         * Define the core functionality.
         *
         * Load the dependencies, and set the hooks for the admin area and the public-facing side of the site.
         *
         * @since    1.0.0
         */
        public function __construct() {
            
            /* framework version */
            $this->version = UT_VERSION;
            
            /* language domain */
            $this->domain = apply_filters( 'unite_domain_languages', array( 'unite', 'unite-admin' ) );
            
            /* file dependencies */
            $this->load_dependencies();
            
            /* language domain */
            $this->set_locale();
            
            /* admin hooks */
            $this->define_admin_hooks();            
            
        }
        
        /**
         * Load the required dependencies for this theme.
         *
         *
         * Create an instance of the loader which will be used to register the hooks
         * with WordPress.
         *
         * @since    1.0.0
         * @access   private
         */
        private function load_dependencies() {
        
            /**
             * The class responsible for orchestrating the actions and filters of the core.
             */
            _unite_load_file( 'unite/unite-framework-loader.php' );  
            
            /* helper functions for both sides */
            $this->helper_includes();
            
            /* theme related custom files */
            $this->theme_custom_includes();
            
            /* include option type files for admin */
            $this->option_types_includes();
            
            /* include required core admin files */
            $this->admin_includes();
            
            /* include metabox files */
            $this->theme_metabox_includes();
            
            /* include taxonomy option files */
            $this->theme_taxonomy_includes();
            
            /* initialize loader */
            $this->loader = new Unite_Theme_Loader();            
        
        }
                      
        /**
         * Define the locale for this theme for internationalization.
         *
         * @since    1.0.0
         * @access   private
         */
        private function set_locale() {
    
            $this->loader->add_action( 'after_setup_theme', $this, 'load_languages' );
    
        }
                
        /** 
         * Load language domain
         *
         * @return    void
         *
         * @access    public
         * @since     1.0.0
         * @version   1.0.0
         */
        public function load_languages() {
            
            /*
             * Make theme available for translation.
             * Translations can be filed in the /languages/ directory.
             */             
            
            foreach( $this->domain as $domain ) {
                
                if ( $loaded = load_theme_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain ) ) {
                    
                    return $loaded;
                    
                } elseif ( $loaded = load_theme_textdomain( $domain, get_stylesheet_directory() . '/languages' ) ) {
                    
                    return $loaded;
                    
                } else {
                    
                    load_theme_textdomain( $domain, get_template_directory() . '/languages' );
                    
                }
            
            }
        
        }        
        
        /**
         * Register all of the hooks related to the admin area functionality
         * of the framework.
         *
         * @since    1.1.0
         * @access   private
         */
        private function define_admin_hooks() {
                        
            $this->loader->add_action( 'admin_enqueue_scripts', $this, 'enqueue_admin_css' );
            $this->loader->add_action( 'admin_enqueue_scripts', $this, 'enqueue_admin_js' );

            /* start theme cuztomizer */            
            if ( is_admin() ) {
            
                $ut_theme_customizer = new UT_Theme_Customizer(); 
                $this->loader->add_action( 'customize_register', $ut_theme_customizer, 'customize_register' );            
            
            }
            
            /* admin notification markup */
            $this->loader->add_action( 'admin_footer', $this, 'notification_overlay' );
            
        }      
                       
        /**
         * Include custom files
         *
         * @return    void
         *
         * @access    private
         * @since     1.0.0
         * @version   1.0.0
         */
        private function theme_custom_includes() {                     
            
            /* theme custom option files */
            $files = apply_filters( 'unite_theme_custom_includes_options', array(
                'options/ut-theme-options',
                'options/customizer/ut-theme-customizer'
            ) );            
            
            foreach ( $files as $file ) {
                _unite_load_file( "unite-custom/{$file}.php" );
            }
            
            
            /* array of files for front and dashboard */
            $files = apply_filters( 'unite_theme_custom_includes_core', array(      
                'ut-theme-menu',
                'ut-theme-functions',
                'ut-theme-setup',
                'ut-theme-sidebars',
            ) );
            
            foreach ( $files as $file ) {
                _unite_load_file( "unite-custom/{$file}.php" , true );
            }
            
            
            /* array of files for front only */
            if ( !is_admin() ) {
                
                /* array of files only for theme front */
                $files = apply_filters( 'unite_theme_custom_includes', array( 
                    'ut-theme-hooks',
                    'ut-theme-scripts',
                    'ut-theme-extras',
                    'ut-theme-template-tags',
                    'ut-theme-custom-css'
                ) );
                
                foreach ( $files as $file ) {
                    _unite_load_file( "unite-custom/{$file}.php" , true );
                }            
            
            }
        
        }
        
        /**
         * Include helper files
         *
         * @return    void
         *
         * @access    private
         * @since     1.0.0
         * @version   1.0.0
         */
        private function helper_includes() {
        
            /* array of files */
            $files = apply_filters( 'unite_helper_includes', array(  
                'unite-filters',
                'unite-sanitize',
                'unite-css-parser',
                'unite-js-parser'
            ) );
            
            foreach ( $files as $file ) {
                _unite_load_file( "unite/core/helper/{$file}.php" );
            }            
        
        }
        
        /**
         * Include option type files
         *
         * @return    void
         *
         * @access    private
         * @since     1.0.0
         * @version   1.0.0
         */
        private function option_types_includes() {
            
            /* check if admin page is displaying, otherwise leave here */
            if ( ! is_admin() ) {
                return false;
            }
            
            /* array of files */
            $files = apply_filters( 'unite_option_types_includes', array(
                'alert',
                'background',
                'button',
                'border',
                'category-checkbox',
                'category-select',
                'category-select-by-id',
                'checkbox',
                'colorpicker',
                'colorscheme',
                'css',
                'datepicker',
                'editor',
                'grid-slider',
                'group',
                'info',
                'icons',
                'js',
                'measurement',
                // 'numericslider', @todo
                'page-checkbox',
                'page-select',
                // 'post-type-checkbox', @todo
                // 'post-type-select', @todo
                'post-checkbox',
                'post-select',
                'range',
                'radio',
                'radio_image',
                'select',
                'sidebar-select',
                'slider',
                'sortable',
                'switch',
                // 'tag-checkbox', @todo
                // 'tag-select', @todo
                'tag-suggest',
                'taxonomy-checkbox',
                'taxonomy-select',
                'text',
                'textarea',
                'tinymce',
                'typography',
                'upload'
            ) );
            
            foreach ( $files as $file ) {
                _unite_load_file( "unite/core/admin/option-types/{$file}.php" );            
            }
            
        }        
        
        /**
         * Include admin files
         *
         * @return    void
         *
         * @access    private
         * @since     1.0.0
         * @version   1.0.0
         */
        private function admin_includes() {
        
            /* check if admin page is displaying, otherwise leave here */
            if ( ! is_admin() ) {
                return false;
            }
            
            /* array of files */
            $files = apply_filters( 'unite_admin_includes', array( 
                'unite-admin-functions',
                'unite-home.class',
                'unite-theme-options.class',
                'unite-sidebars.class',
                'unite-fonts.class',
                'unite-theme-customizer.class',                
                'unite-metaboxes.class',
                'unite-taxonomy-options.class',                
                'unite-demo-importer.class',
                'unite-import-export.class',
                'unite-header-manager.class',
                'unite-theme-info.class'
            ) );
            
            foreach ( $files as $file ) {
                _unite_load_file( "unite/core/admin/{$file}.php" );
            }            
            
            /* demo importer config*/ 
            _unite_load_file( 'unite-custom/demo-importer/ut-demo-importer-config.php' );
            
        }
        
                
        /**
         * Include metabox files
         *
         * @return    void
         *
         * @access    private
         * @since     1.0.0
         * @version   1.0.0
         */
        private function theme_metabox_includes() {
            
            /* cache already included file names */            
            $already_included = array();
            
            /* try to load child theme files first */
            foreach ( glob( STYLE_DOCUMENT_ROOT . '/unite-custom/metaboxes/*.php') as $filename ){
                    
                include_once( $filename );
                array_push( $already_included, $filename );
                
            }
            
            /* now try to load metaboxes from parent theme */
            foreach ( glob( THEME_DOCUMENT_ROOT . '/unite-custom/metaboxes/*.php') as $filename ){
                
                if( !in_array( $filename, $already_included ) ) {
                    include_once( $filename );
                }
                
            } 
            
            /* load core metaboxes */
            foreach ( glob( THEME_DOCUMENT_ROOT . '/unite/core/admin/metaboxes/*.php') as $filename ){
                include_once( $filename );
            }
        
        }
        
        /**
         * Include taxonomy option files
         *
         * @return    void
         *
         * @access    private
         * @since     1.0.0
         * @version   1.0.0
         */
        private function theme_taxonomy_includes() {
            
            /* check if admin page is displaying if not, leave here */
            if ( !is_admin() ) {
                return false;
            }
            
            /* cache already included file names */            
            $already_included = array();
            
            /* try to load child theme files first */
            foreach ( glob(STYLE_DOCUMENT_ROOT . '/unite-custom/options/taxonomies/*.php') as $filename ){
                    
                include_once( $filename );
                array_push( $already_included, $filename );
                
            }
            
            /* now try to load metaboxes from parent theme */
            foreach ( glob(THEME_DOCUMENT_ROOT . '/unite-custom/options/taxonomies/*.php') as $filename ){
                
                if( !in_array( $filename, $already_included ) ) {
                    include_once( $filename );
                }
                
            }    
        
        }
        
        /**
         * Load CSS files
         *
         * @return    void
         *
         * @access    private
         * @since     1.1.0
         * @version   1.0.0
         */
        
        public function enqueue_admin_css() {
            
            if ( !is_admin() ) {
                return false;
            }
            
            $min = NULL;
            
            if( !WP_DEBUG ){
                $min = '.min';
            }            
            
            /* modal */
            wp_enqueue_style(
                'unite-modal', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/modal/css/jquery.modal' . $min . '.css', 
                false, 
                UT_VERSION
            );
            
            /* modal theme */
            wp_enqueue_style(
                'unite-modal-theme', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/modal/css/jquery.modal.theme-unite' . $min . '.css', 
                false, 
                UT_VERSION
            );  
            
            /* minicolors */
            wp_enqueue_style(
                'unite-minicolors', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/minicolors/css/jquery.minicolors' . $min . '.css', 
                false, 
                UT_VERSION
            ); 
            
            /* admin ui css file */
            wp_enqueue_style(
                'unite-admin', 
                FW_WEB_ROOT . '/core/admin/assets/css/unite-admin' . $min . '.css', 
                false, 
                UT_VERSION
            );
            
            /* fontawesome css file */
            wp_enqueue_style(
                'unite-fontawesome', 
                '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome' . $min . '.css'
            );
            
            /* grid css file */
            wp_enqueue_style(
                'unite-grid', 
                FW_WEB_ROOT . '/core/admin/assets/css/unite-responsive-grid' . $min . '.css',  
                false, 
                UT_VERSION
            );
            
            /* helper css */
            wp_enqueue_style(
                'unite-helpers', 
                FW_WEB_ROOT . '/theme/assets/css/unite-helpers' . $min . '.css', 
                false, 
                UT_VERSION
            );
            
            /* iconpicker css */
            wp_enqueue_style(
                'unite-iconpicker', 
                FW_WEB_ROOT . '/core/admin/assets/css/unite-fonticonpicker' . $min . '.css', 
                false, 
                UT_VERSION
            );
            
            wp_enqueue_style(
                'unite-iconpicker-theme', 
                FW_WEB_ROOT . '/core/admin/assets/css/unite-fonticonpicker-theme' . $min . '.css', 
                false, 
                UT_VERSION
            );
            
            /* tag editor css */
            wp_enqueue_style(
                'unite-tag-editor', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/tagEditor/css/jquery.tag-editor' . $min . '.css', 
                false, 
                UT_VERSION
            );
            
            /* tooltipster css */
            wp_enqueue_style(
                'unite-tooltipster', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/tooltipster/css/tooltipster' . $min . '.css', 
                false, 
                UT_VERSION
            );
        
        }
                
        /**
         * Load JS files
         *
         * @return    void
         *
         * @access    private
         * @since     1.1.0
         * @version   1.0.0
         */
        
        public function enqueue_admin_js() {
            
            if ( !is_admin() ) {
                return false;
            }
            
            $min = NULL;
            
            if( !WP_DEBUG ){
                $min = '.min';
            }
            
            /* wp form */    
            wp_enqueue_script('jquery-form');
        
            /* wp media */
            wp_enqueue_media();
            
            /* modal */
            wp_enqueue_script(
                'unite-modal', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/modal/js/jquery.modal' . $min . '.js', 
                array('jquery'), 
                UT_VERSION
            );
            
            /* minicolors */
            wp_enqueue_script(
                'unite-minicolors', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/minicolors/js/jquery.minicolors' . $min . '.js', 
                array(), 
                UT_VERSION
            );
                            
            /* ace editor */
            wp_enqueue_script(
                'unite-ace-js', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/ace/ace.js', 
                array(), 
                UT_VERSION
            );
            
            /* dependency */
            wp_enqueue_script(
                'unite-dependency-js', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/dependency/js/deps' . $min . '.js', 
                array(), 
                UT_VERSION
            );
            
            /* cookie */
            wp_enqueue_script(
                'unite-cookie-js', 
                FW_WEB_ROOT . '/core/admin/assets/js/unite-ckie' . $min . '.js', 
                array(), 
                UT_VERSION
            );
            
            /* theme options ajax */
            wp_enqueue_script(
                'unite-save-options', 
                FW_WEB_ROOT . '/core/admin/assets/js/unite-save-options' . $min . '.js', 
                array(
                    'jquery',
                    'jquery-form'
                ), 
                UT_VERSION
            );
            
            /* iconpicker */
            wp_enqueue_script(
                'unite-iconpicker', 
                FW_WEB_ROOT . '/core/admin/assets/js/unite-fonticonpicker' . $min . '.js', 
                array(
                    'jquery',
                    'jquery-form'
                ), 
                UT_VERSION
            );
            
            /* tag editor */
            wp_enqueue_script(
                'unite-caret', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/caret/js/jquery.caret' . $min . '.js', 
                array(
                    'jquery'
                ), 
                UT_VERSION
            );
            
            /* tag editor */
            wp_enqueue_script(
                'unite-tag-editor', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/tagEditor/js/jquery.tag-editor' . $min . '.js', 
                array(
                    'unite-caret',
                    'jquery'
                ), 
                UT_VERSION
            );
            
            /* tooltipster */
            wp_enqueue_script(
                'unite-tooltipster', 
                FW_WEB_ROOT . '/core/admin/assets/vendor/tooltipster/js/jquery.tooltipster' . $min . '.js', 
                array(
                    'jquery'
                ), 
                UT_VERSION
            );

            /* metabox */
            wp_enqueue_script(
                'unite-metabox-js', 
                FW_WEB_ROOT . '/core/admin/assets/js/unite-metabox' . $min . '.js', 
                array(
                    'jquery'
                ), 
                UT_VERSION
            );
            
            /* admin */
            wp_enqueue_script(
                'unite-admin-js', 
                FW_WEB_ROOT . '/core/admin/assets/js/unite-admin' . $min . '.js', 
                array(
                    'jquery',
                    'jquery-ui-autocomplete',
                    'jquery-ui-accordion',
                    'jquery-ui-slider',
                    'unite-tooltipster',
                    'unite-minicolors',
                    'unite-ace-js',
                    'unite-cookie-js',
                    'unite-dependency-js'
                ), 
                UT_VERSION
            );
            
            $localized_array = array(
                'SaveOptionsNonce'  => wp_create_nonce( 'unite-ajax-save-nonce' ),
                'SaveLayoutsNonce'  => wp_create_nonce( 'unite-ajax-layout-change-nonce' )
            );
    
            /* localized script admin */
            wp_localize_script( 'unite-admin-js', 'unite', $localized_array );
            wp_localize_script( 'unite-admin-js', 'unite_js_translation',_ut_recognized_js_translation_strings() );
                    
        
        }
        
        /**
         * Notification Overlay
         *
         * @since    1.0.0
         */
        public function notification_overlay() { ?>
            
            <div class="ut-options-overlay">
                
                <div class="ut-overlay-message ut-success">
                    <div class="ut-icon-wrap">
                        <i class="fa fa-check"></i>
                    </div>
                    <p><?php esc_html_e( 'Theme Options have been saved.', 'unite' ); ?></p>
                </div>
                
                <div class="ut-overlay-message ut-info">
                    <span class="ut-icon-wrap">
                        <i class="fa fa-info"></i>
                    </span>
                    <p><?php esc_html_e( 'You are not allowed to save theme options.', 'unite' ); ?></p>
                </div>
                
                <div class="ut-overlay-message ut-error">
                    <span class="ut-icon-wrap">
                        <i class="fa fa-times"></i>
                    </span>
                    <p>
                        <span><?php esc_html_e( 'An Error occured while saving the theme options.', 'unite' ); ?></span>
                        <button class="ut-view-message ut-backend-button ut-red-button" href="#"><i class="fa fa-list-alt"></i><?php esc_html_e( 'Show Error','unite' ); ?></button>
                        <button class="ut-close-overlay-message ut-backend-button ut-green-button" href="#"><i class="fa fa-times"></i><?php esc_html_e( 'Close','unite' ); ?></button>
                    </p>
                </div>
                
                <div class="ut-popup-message">
                    
                    <p class="ut-error-message ut-alert ut-alert-danger"></p>
                
                </div>
                
                <div class="ut-loader">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>      
                
            </div>        
        
        <?php }        
        
        /**
         * Run the loader to execute all of the hooks with WordPress.
         *
         * @since    1.0.0
         */
        public function run() {
            
            $this->loader->run();
            
        }        
                
    }    
   
}

function run_unite_framework() {

	$unite = new UT_Loader();
	$unite->run();

}
run_unite_framework();