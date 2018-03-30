<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

class Unite_Demo_Importer {
    
    /**
     * Demo Importer Page Slug
     * @var string
     */
    protected $key = 'unite-demo-importer';
    
    /**
     * Demo Importer Title
     * @var string
     */
    protected $title = '';
    
    
    /**
     * Flag imported to prevent duplicates
     *
     * @since 1.0.0
     * @var array
     */
    public $imported = array( 
        'trashhello'    => false,
        'sidebarcleanup'=> false,
        'content'       => false, 
        'menus'         => false, 
        'options'       => false, 
        'widgets'       => false 
    );        
    
    /**
     * Copy of the object for easy reference.
     *
     * @since 1.0.0
     * @var object
     */
    private static $instance;
    
    /**
     * Set name of the theme default sidebar
     *
     * sidebar will be reseted when using importer
     *
     * @since 1.0.0
     * @var string
     */
    public $theme_default_sidebar_id;
        
    /**
     * Set name of the available theme demos
     *
     * @since 1.0.0
     * @var array
     */
    public $theme_demos;
    
     /**
     * Constructor
     * @since     1.0.0
     * @version   1.0.0
     */
    public function __construct() {
        
        self::$instance = $this;
        
        $this->title                = apply_filters( 'unite_demo_importer_name' , esc_html__( 'Theme Demos', 'unite-admin' ) );
        $this->demo_files_path      = apply_filters( 'unite_demo_importer_files_path', THEME_DOCUMENT_ROOT . '/unite-custom/demo-importer/data' );
        $this->demo_files_default   = apply_filters( 'unite_demo_importer_files_default', THEME_DOCUMENT_ROOT . '/unite-custom/demo-importer/data/default' );
        
        $this->demo_files_web_path  = apply_filters( 'unite_demo_importer_files_path', THEME_WEB_ROOT . '/unite-custom/demo-importer/data' );
        
        /* demo content files */
        $this->theme_demo_file      = apply_filters( 'unite_demo_importer_demo_file'    , $this->demo_files_default . '/xml/demo.xml' );
        $this->theme_demo_alt_file  = apply_filters( 'unite_demo_importer_demo_alt_file', $this->demo_files_default . '/xml/demo.xml.gz' );
        
        /* demo theme options file */
        $this->theme_options_file   = apply_filters( 'unite_demo_importer_options_file', $this->demo_files_default . '/theme-options/options.txt' );
        
        /* demo widget file */
        $this->theme_widgets_file   = apply_filters( 'unite_demo_importer_widgets_file', $this->demo_files_default . '/widgets/widget_data.json' );
                    
        $this->already_imported     = get_option( 'unite_imported_demo' );
        
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
            
            /* load custom css */
            add_action( 'admin_enqueue_scripts', array( $this, 'register_demo_importer_admin_css' ) );
            
            /* load js */
            add_action( 'admin_enqueue_scripts', array( $this, 'register_demo_importer_admin_js' ) );
            
            /* meta checker */
            add_filter( 'add_post_metadata', array( $this, 'check_previous_meta' ), 10, 5 );
            
        }
        
        /* add menu item */
        add_action( 'admin_menu' , array( $this , 'add_menu_item' ) );
        
        /* import flag */
        add_action( 'unite_demo_importer_import_end', array( $this, 'after_wp_importer' ) );
        
        /* add notices */
        if ( isset( $_GET['page'] ) && $this->key == $_GET['page'] ) {
        
            add_action( 'admin_notices', array( $this, 'show_notices' ) );        
        
        }
        
    }
    
    /**
     * Add to menu
     * @since     1.0.0
     * @version   1.0.0
     */
    public function add_menu_item() {
        
        add_submenu_page( 'unite-welcome-page', $this->title, $this->title, 'manage_options', $this->key, array( $this , 'admin_page_display' ) );
        
    }
    
    /**
     * Show Notices
     * @since     1.0.0
     * @version   1.0.0
     */
    public function show_notices() {
        
        /* upload folder is not writeable */
        if( !is_writable( ABSPATH . 'wp-content/uploads/' ) ) :
        
            echo '<div class="error">';
                echo '<p>' , esc_html__( 'Your upload folder is not writeable or does not exist! The importer won\'t be able to import properly. You can try to upload an image into your Media Library , so WordPress will create this folder for you or please check the folder permissions or existence for', 'unite-admin' ) , '</p>';
                echo ABSPATH . 'wp-content/uploads/';
            echo '</div>';
        
        endif;
        
        /* upload folder is not writeable */
        if( !is_writable( ABSPATH . 'wp-content/' ) ) :
        
            echo '<div class="error">';
                echo '<p>' , esc_html__( 'Your wp-content folder is not writeable! The importer won\'t be able to import properly. Please check the folder permissions for', 'unite-admin' ) , '</p>';
                echo ABSPATH . 'wp-content/';
            echo '</div>';
        
        endif;
        
        /* upload folder is not writeable */
        if( WP_DEBUG ) :
        
            echo '<div class="error">';
                echo '<p>' , esc_html__( 'Please deactivate WP_DEBUG before importing!', 'unite-admin' ) , ' Learn more here: <a href="https://codex.wordpress.org/WP_DEBUG" target="_blank">WP DEBUG</a></p>';
            echo '</div>';
        
        endif;
    
    }
        
    public function available_demos() {}    
    
    public function admin_page_display() { ?>
        
        <?php $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : ''; ?>
        <?php $button = !$this->already_imported ? esc_html__( 'Run Demo Importer' , 'unite-admin' ) : esc_html__( 'Run Demo Importer again!' , 'unite-admin' ); ?>
        
        <form id="ut-demo-importer" method="post">
        
        <!-- Start UT-Backend-Wrap -->
        <div class="ut-admin-wrap clearfix">
            
            <div class="ut-backend-top-bar clearfix">
                
                <a class="ut-backend-logo hide-on-tablet hide-on-mobile" href="<?php echo get_admin_url(); ?>admin.php?page=unite-welcome-page" title="UnitedThemes">
                    <img src="<?php echo FW_WEB_ROOT . '/core/admin/assets/img/ut_logo_white.png'; ?>" alt="United Themes" />
                </a>
                
                <h2>
                    <?php esc_html_e( 'Unite Demo Importer', 'unite-admin' ); ?>                    
                </h2>
                
                <span> <?php esc_html_e( 'The fastest way to setup your theme!', 'unite-admin' ); ?> </span>           
                
            </div>
            <!-- Close UT-Backend-Topbar -->
            
            <!-- Start UT-Admin-Main -->                
            <div class="ut-admin-main">                        
                    
                <!-- Start UT-Admin-Header -->
                <header class="ut-admin-header clearfix">
                    
                    <h3 class="ut-admin-header-title">
                        <?php esc_html_e( 'Information', 'unite-admin' ); ?>
                    </h3>
                    
                </header>
                <!-- Cose UT-Admin-Header -->
                
                <?php if( !empty( $this->already_imported ) ) : ?>
                
                <div class="ut-breadcrumb">
            
                    <ul>
                        <li class="ut-breadcrumb-root"><i class="fa fa-info"></i></li>
                        <li><?php esc_html_e('Demo already imported', 'unite-admin'); ?></li>
                    </ul>
                    
                </div>
                
                <?php endif; ?> 
                
                <div class="ut-admin-panel-group ut-show">
                    
                    <section class="ut-admin-panel">
                        
                        <div class="ut-admin-panel-content clearfix">
                            
                            <?php foreach( $this->available_demos() as $demo => $settings ) : ?>
                                
                                <div class="xml">
                                    <input type="radio" id="<?php echo $demo; ?>" name="ut_demo_file" value="<?php echo $demo; ?>" checked class="ut-choose-demo-radio">
                                    <label class="ut-choose-demo-img" for="<?php echo $demo; ?>">
                                        <img src="<?php echo $this->demo_files_web_path; ?>/<?php echo $demo; ?>/img/poster.jpg" />                    
                                    </label>
                                    <h3 class="xml-name"><?php echo $settings['name']; ?></h3>
                                    <div class="xml-actions">
                                        <a target="_blank" href="<?php echo $settings['link']; ?>" class="button button-primary"><?php _e('Preview' , 'unite-admin'); ?></a>
                                    </div>
                                </div>
                            
                            <?php endforeach; ?>                                                        
                            
                        </div>
                    
                    </section>                    
                    
                    <section class="ut-admin-panel">
                        
                        <div class="ut-admin-panel-content clearfix">
                            
                            <table class="form-table">
                            
                                <tbody>
                                    
                                    <tr valign="top">
                                        <th scope="row"><?php esc_html_e( 'General', 'unite-admin' ) ; ?></th>
                                        <td>
                                        <ul>
                                            <li><i class="fa fa-caret-right"></i> <?php esc_html_e( 'We recommend to run this importer on a clean WordPress installation, but this is not mandatory.' , 'unite-admin' ); ?></li>
                                            <li><i class="fa fa-caret-right"></i> <?php esc_html_e( 'Please install all required plugins before running the importer.' , 'unite-admin' ); ?></li>
                                            <li><i class="fa fa-caret-right"></i> <?php esc_html_e( 'To reset your installation we can recommend this plugin here:' , 'unite-admin' ); ?> <a href="http://wordpress.org/plugins/wordpress-database-reset/">Wordpress Database Reset</a></li>
                                            <li><i class="fa fa-caret-right"></i> <?php esc_html_e( 'No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified. Except the "Hello World" post, which will be moved to trash.', 'unite-admin' ); ?></li>
                                            <li><i class="fa fa-caret-right"></i> <?php esc_html_e( 'Demo related content like posts, pages, images, widgets and menus will get imported.', 'unite-admin' ); ?></li>
                                            <li><i class="fa fa-caret-right"></i> <?php esc_html_e( 'Importing can take a couple of minutes.', 'unite-admin' ); ?></li>
                                        </ul>
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr valign="top">
                                        <th scope="row"><?php esc_html_e( 'Use GZIP files for import?', 'unite-admin' ) ; ?></th>
                                        <td>
                                            <input type="checkbox" name="unite_demo_importer_use_gzip"> <br />
                                            <span class="ut-inline-notification"><?php esc_html_e( 'If you are experiencing issue while importing the demo content, please activate GZIP files for your import and the demo importer will use a different import file.', '' ); ?></span>
                                        </td>
                                    </tr>
                                    
                                    <tr valign="top">
                                        <th scope="row"></th>
                                        <td>
                                            
                                            <input type="hidden" name="unite_demo_importer_nonce" value="<?php echo wp_create_nonce( 'unite-demo-importer-nonce' ); ?>" />
                                            <button data-loading="<?php esc_html_e( 'Loading', 'unite-admin' ); ?>" type="submit" id="ut-start-importer" class="ut-backend-button ut-green-button" id="submit" name="submit">
                                                <span><?php echo $button; ?></span>
                                                <i class="fa fa-cog fa-spin"></i>    
                                            </button>
                                            <input type="hidden" name="action" value="run-import" />
                                            
                                        </td>
                                    </tr>
                                    
                                </tbody>
                                
                            </table>                                   
                        
                        </div>
                    
                    </section>
                        
                    <?php if( 'run-import' == $action && check_admin_referer( 'unite-demo-importer-nonce' , 'unite_demo_importer_nonce') ) : ?>
                        
                        <section class="ut-admin-panel">
                        
                        <header class="ut-admin-panel-header">
                        
                            <h3 class="ut-admin-panel-header-title"><?php esc_html_e( 'Import Status', 'unite-admin' ); ?></h3>
                        
                        </header>
                        
                        <div class="ut-admin-panel-content clearfix">
                            
                            <div class="ut-alert ut-alert-info" style="margin-bottom:0px;">
                            
                                <?php $this->process_imports(); ?>
                            
                            </div>
                            
                        </div>
                        
                        </section>
                    
                    <?php endif; ?>
                
                </div>                                     
            
            </div>                
            <!-- Close UT-Admin-Main -->
        
        </div>
        <!-- Close UT-Backend-Wrap -->            
        
        </form>
        
    <?php }
    
    /**
     * Process all imports
     *
     * @params $content
     * @params $options
     * @params $widgets
     *
     * @since 1.0.0
     *
     * @return null
     */
    public function process_imports( $trash_hello = true, $sidebar_cleanup = true, $content = true, $options = true, $menus = true, $widgets = true ) {
        
        /* check for alternative import file */
        $unite_demo_importer_use_gzip = isset( $_REQUEST['unite_demo_importer_use_gzip'] ) ? $_REQUEST['unite_demo_importer_use_gzip'] : '';
        $demo_content_file = $unite_demo_importer_use_gzip == 'on' ? $this->theme_demo_alt_file : $this->theme_demo_file;
        
        /* trash "Hello World" post. */
        if( $trash_hello ) {
            wp_trash_post( 1 );
            $this->imported['trashhello'] = true;                
        }
        
        /* remove default widgets from default theme sidebar */
        if( $sidebar_cleanup ) {                
            $this->delete_default_widgets();            
        }            
        
        /* start import of xml file first */
        if ( $content && !empty( $demo_content_file ) && is_file( $demo_content_file ) ) {
            $this->import_demo_content( $demo_content_file );
        }
        
        /* start import of theme options and sidebars*/
        if ( $options && !empty( $this->theme_options_file ) && is_file( $this->theme_options_file ) ) {
            $this->import_demo_theme_options( $this->theme_options_file );
        }
        
        /* assign menus */
        if( $menus ) {
            $this->import_demo_navigations();    
        }
        
        /* start import of theme widgets */
        if ( $widgets && !empty( $this->theme_widgets_file ) && is_file( $this->theme_widgets_file ) ) {
            $this->import_demo_widgets( $this->theme_widgets_file );
        }

        do_action( 'unite_demo_importer_import_end' );

    }
    
    /**
     * Avoids adding duplicate meta causing arrays in arrays from WP_importer
     *
     * @param null    $continue
     * @param unknown $post_id
     * @param unknown $meta_key
     * @param unknown $meta_value
     * @param unknown $unique
     *
     * @since 1.0.0
     *
     * @return
     */
    public function check_previous_meta( $continue, $post_id, $meta_key, $meta_value, $unique ) {

        $old_value = get_metadata( 'post', $post_id, $meta_key );

        if ( count( $old_value ) == 1 ) {

            if ( $old_value[0] === $meta_value ) {

                return false;

            } elseif ( $old_value[0] !== $meta_value ) {

                update_post_meta( $post_id, $meta_key, $meta_value );
                return false;

            }

        }

    }
    
     /**
     * Delete default widget
     *
     * Gather site's widgets into array with ID base, name, etc.
     * Used by export and import functions.
     *
     * @since 1.0.0
     *
     * @global array $wp_registered_widget_updates
     * @return array Widget information
     */
    function delete_default_widgets() {
        
        $sidebars_widgets = get_option( 'sidebars_widgets' );
        
        if( isset( $sidebars_widgets[$this->theme_default_sidebar_id] ) ) {
            
            /* reset sidebar */                
            $sidebars_widgets[$this->theme_default_sidebar_id] = array();
            
            /* update sidebars */
            update_option( 'sidebars_widgets',  $sidebars_widgets );
            
            /* set import flag */
            $this->imported['sidebarcleanup'] = true;
            
        }
        
    }        
            
    /**
     * Available widgets
     *
     * Gather site's widgets into array with ID base, name, etc.
     * Used by export and import functions.
     *
     * @since 1.0.0
     *
     * @global array $wp_registered_widget_updates
     * @return array Widget information
     */
    function available_widgets() {

        global $wp_registered_widget_controls;

        $widget_controls = $wp_registered_widget_controls;

        $available_widgets = array();

        foreach ( $widget_controls as $widget ) {

            if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) {

                $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
                $available_widgets[$widget['id_base']]['name'] = $widget['name'];

            }

        }

        return apply_filters( 'unite_demo_importer_widget_available_widgets', $available_widgets );

    }
    
    /**
     * Import Demo Content
     *
     * @since   1.0.0
     * @version 1.0.0
     */
    public function import_demo_content( $file ) {

        if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

        require_once ABSPATH . 'wp-admin/includes/import.php';

        $importer_error = false;

        if ( !class_exists( 'WP_Importer' ) ) {

            $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

            if ( file_exists( $class_wp_importer ) ){

                require_once( $class_wp_importer );

            } else {

                $importer_error = true;

            }

        }

        if ( !class_exists( 'WP_Import' ) ) {
            
            $class_wp_import = FW_DOCUMENT_ROOT .'/core/admin/inc/vendor/wordpress-importer.php';
                
            if ( file_exists( $class_wp_import ) ) {
            
                require_once( $class_wp_import );
                
            } else {
                
                $importer_error = true;
            
            }

        }

        if( $importer_error ){

            die( "Error on import" );

        } else {

            if( !is_file( $file ) ){

                echo "Error"; //@todo message

            } else {

                $wp_import = new WP_Import();
                $wp_import->fetch_attachments = true;
                ob_start();
                $wp_import->import( $file );
                ob_end_clean();
                $this->imported['content'] = true;

            }

        }

        do_action( 'unite_demo_importer_after_theme_content_import' );


    }
    
    /**
     * Import Theme Options
     *
     * @since   1.0.0
     * @version 1.0.0
     */
    public function import_demo_theme_options( $file ) {

        /* does the File exist? */
        if ( file_exists( $file ) ) {

            /* Get file contents and decode */
            $data = file_get_contents( $file );
            $data = ut_base_decode( $data );				
            $data = maybe_unserialize( $data  );
            
            /* only if there is data */
            if ( !empty( $data ) && is_array( $data ) ) {
                
                $data = ut_load_theme_option( $data );
                
                if( $data ) {
                    
                    $this->imported['options'] = true;
                    
                }
                
                do_action( 'unite_demo_importer_after_theme_options_import' );

            }


        } else {
            
            wp_die( esc_html__( 'Theme options Import file could not be found.', 'unite-admin' ), '', array( 'back_link' => true ) );
            
        }

    }
    
    
    public function import_demo_navigations() {}
    
    
    /**
     * Import Widgets
     *
     * @since   1.0.0
     * @version 1.0.0
     */
    public function import_demo_widgets( $file ) {
        
        /* does the File exist? */
        if ( file_exists( $file ) ) {
        
            $data = file_get_contents( $file );
            $data = json_decode( $data );
            
            /* process widget import */
            $this->widget_import_results = $this->import_widgets( $data );
            
        } else {
            
            wp_die( esc_html__( 'Theme widgets Import file could not be found.', 'unite-admin' ), '', array( 'back_link' => true ) );
        
        }
    
    }
    
    /**
     * Import widget JSON data, based on widget import export
     *	     
     * @global array $wp_registered_sidebars
     * @param object $data JSON widget data from .json file
     * @return array Results array
     *
     * @since   1.0.0
     * @version 1.0.0         
     */
    public function import_widgets( $data ) {

        global $wp_registered_sidebars;

        if ( empty( $data ) || ! is_object( $data ) ) {
            return;
        }

        /* hook before import */
        $data = apply_filters( 'unite_demo_importer_before_widgets_import', $data );

        /* Get all available widgets site supports */
        $available_widgets = $this->available_widgets();

        /* Get all existing widget instances */
        $widget_instances = array();
        foreach ( $available_widgets as $widget_data ) {
            $widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
        }

        /* Begin results */
        $results = array();

        // Loop import data's sidebars
        foreach ( $data as $sidebar_id => $widgets ) {

            // Skip inactive widgets
            // (should not be in export file)
            if ( 'wp_inactive_widgets' == $sidebar_id ) {
                continue;
            }

            // Check if sidebar is available on this site
            // Otherwise add widgets to inactive, and say so
            if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
                $sidebar_available = true;
                $use_sidebar_id = $sidebar_id;
                $sidebar_message_type = 'success';
                $sidebar_message = '';
            } else {
                $sidebar_available = false;
                $use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
                $sidebar_message_type = 'error';
                $sidebar_message = esc_html__( 'Sidebar does not exist in theme (using Inactive)', 'unite-admin' );
            }

            // Result for sidebar
            $results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
            $results[$sidebar_id]['message_type'] = $sidebar_message_type;
            $results[$sidebar_id]['message'] = $sidebar_message;
            $results[$sidebar_id]['widgets'] = array();

            // Loop widgets
            foreach ( $widgets as $widget_instance_id => $widget ) {

                $fail = false;

                // Get id_base (remove -# from end) and instance ID number
                $id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
                $instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

                // Does site support this widget?
                if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
                    $fail = true;
                    $widget_message_type = 'error';
                    $widget_message = esc_html__( 'Site does not support widget', 'unite-admin' ); // explain why widget not imported
                }

                // Filter to modify settings before import
                // Do before identical check because changes may make it identical to end result (such as URL replacements)
                $widget = apply_filters( 'unite_demo_importer_widget_settings_import', $widget );

                // Does widget with identical settings already exist in same sidebar?
                if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

                    // Get existing widgets in this sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' );
                    $sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

                    // Loop widgets with ID base
                    $single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
                    foreach ( $single_widget_instances as $check_id => $check_widget ) {

                        // Is widget in same sidebar and has identical settings?
                        if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

                            $fail = true;
                            $widget_message_type = 'warning';
                            $widget_message = esc_html__( 'Widget already exists', 'unite-admin' ); // explain why widget not imported

                            break;

                        }

                    }

                }

                // No failure
                if ( ! $fail ) {

                    // Add widget instance
                    $single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
                    $single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
                    $single_widget_instances[] = (array) $widget; // add it

                    // Get the key it was given
                    end( $single_widget_instances );
                    $new_instance_id_number = key( $single_widget_instances );

                    // If key is 0, make it 1
                    // When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
                    if ( '0' === strval( $new_instance_id_number ) ) {
                        $new_instance_id_number = 1;
                        $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
                        unset( $single_widget_instances[0] );
                    }

                    // Move _multiwidget to end of array for uniformity
                    if ( isset( $single_widget_instances['_multiwidget'] ) ) {
                        $multiwidget = $single_widget_instances['_multiwidget'];
                        unset( $single_widget_instances['_multiwidget'] );
                        $single_widget_instances['_multiwidget'] = $multiwidget;
                    }

                    // Update option with new widget
                    update_option( 'widget_' . $id_base, $single_widget_instances );

                    // Assign widget instance to sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
                    $new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
                    $sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
                    update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

                    // Success message
                    if ( $sidebar_available ) {
                        $widget_message_type = 'success';
                        $widget_message = esc_html__( 'Imported', 'unite-admin' );
                    } else {
                        $widget_message_type = 'warning';
                        $widget_message = esc_html__( 'Imported to Inactive', 'unite-admin' );
                    }

                }

                // Result for widget instance
                $results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
                $results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = $widget->title ? $widget->title : esc_html__( 'No Title', 'unite-admin' ); // show "No Title" if widget instance is untitled
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

            }

        }

        $this->imported['widgets'] = true;

        /* hook after import */
        do_action( 'unite_demo_importer_after_widgets_import' );

        /* return results */
        return apply_filters( 'unite_demo_importer_widget_results', $results );
    
    }
    
    
    /**
     * Hook after content import
     * @since     1.0.0
     * @version   1.0.0
     */
    public function after_wp_importer() {

        do_action( 'unite_demo_importer_after_content_import' );
        
        esc_html_e( 'Import Done!', 'unite-admin' ); 
        
        update_option( 'unite_imported_demo', $this->imported );

    }
    
    public function register_demo_importer_admin_css() {

        wp_register_style(
            'unite-demo-importer', 
            FW_WEB_ROOT . '/core/admin/assets/css/unite-demo-importer.css', 
            false, 
            UT_VERSION
        );
        
        wp_enqueue_style( 'unite-demo-importer' );            
    
    }
    
    public function register_demo_importer_admin_js() {

        wp_register_script(
            'unite-demo-importer-js', 
            FW_WEB_ROOT . '/core/admin/assets/js/unite-demo-importer.js', 
            array( 'jquery' ), 
            UT_VERSION
        );
        
        wp_enqueue_script( 'unite-demo-importer-js' );            
    
    }
    
}
    
