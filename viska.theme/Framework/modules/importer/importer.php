<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 5/31/14
 * Time: 9:06 AM
 */

Class AWEImporter extends AWEThemeSettings
{

    public $default_configs;
    public function __construct($default_config)
    {
        $this->default_configs = $default_config;
        global $pagenow;
        if(is_admin())
        {
            //register import menu
            add_action('admin_menu',                        array( $this, 'register_importer_menu'));

            if(in_array("AWE-ImportData",$_REQUEST)){
                //loading scripts
                add_action( 'admin_enqueue_scripts',            array( $this, 'importer_loading_js'));

                //loading css
                add_action( 'admin_enqueue_scripts',               array( $this, 'importer_loading_css'));
            }

            //register ajax import data
            add_action( 'wp_ajax_awe_import_data',      array( $this , 'ajax_awe_import_data' ) );

        }
    }


    /**
     * Register Importer Menu
     */
    public function register_importer_menu()
    {
        add_submenu_page( 'AWE-Framework', 'Import Demo Data', 'Import Demo Data', 'manage_options', 'AWE-ImportData', array($this,'import_settings') );

    }

    /**
     * Loading CSS
     */
    public function importer_loading_js()
    {
        if(AWE_DEBUG==true)
            $min=".min";
        else
            $min="";
        wp_enqueue_script('awe-importer', AWE_JS_URL. 'importer'.$min.'.js', array("jquery"), null, false);

    }

    /**
     * Loading JS
     */
    public function importer_loading_css()
    {
        wp_enqueue_style('awe-importer', AWE_CSS_URL. 'importer.css'    ,null   ,false);
    }

    /**
     * Import Panel
     */
    public function import_settings()
    {
        include_once('importer_tpl.php');
    }

    /**
     * AJAX import demo data
     */
    public function ajax_awe_import_data()
    {
        if(check_ajax_referer('awe-import-data','_wpnonce') && isset($_REQUEST['_wp_http_referer']) && preg_match("/page=AWE-ImportData/i",$_REQUEST['_wp_http_referer']))
        {

            if ( !defined('WP_LOAD_IMPORTERS') )
            {
                define('WP_LOAD_IMPORTERS', true);
            } 
            require_once ABSPATH . 'wp-admin/includes/import.php';

            $importer_error = false;
            if ( !class_exists( 'WP_Importer' ) ) {
                $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
                if ( file_exists( $class_wp_importer ) ){
                    require_once($class_wp_importer);
                }
                else{
                    $importer_error = true;
                }
            }
            if ( !class_exists( 'WP_Import' ) ) 
            {
                $class_wp_import = AWE_ROOT_DIR . '/lib/wordpress-importer/wordpress-importer.php';
                if ( file_exists( $class_wp_import ) )
                {
                    require_once($class_wp_import);
                }else{
                    $importerError = true;
                }
                    
            }

            if($importer_error){
                echo "<div class=\"alert-box alert-error\"><strong>Error!</strong> The Auto importing script could not be loaded. please use the wordpress importer and import the XML file that is located in your themes folder manually. :(</div>";
                exit();
            }else{
                if ( class_exists( 'WP_Import' ))
                {
                    include_once( get_template_directory() . '/Framework/modules/importer/awe-import-class.php');
                }
                if(!is_file( get_template_directory() . '/config/demo_data.xml') && !is_file( get_template_directory() . '/config/demo_data.gz')){
                    echo "<div class=\"alert-box alert-error\"><strong>Error!</strong> The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the wordpress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually :(</div>";
                    exit();
                }
                else{
                    $wp_import = new AWEImport($this->default_configs);
                    $wp_import->fetch_attachments = true;
                    if(is_callable('gzopen') && is_file( get_template_directory() . '/config/demo_data.gz'))
                    {
                        $wp_import->import( get_template_directory() . '/config/demo_data.gz');
                    }else{
                        $wp_import->import( get_template_directory() . '/config/demo_data.xml');
                    }
                    $wp_import->set_menus();
                    $wp_import->set_options();
                    $wp_import->set_contact();
                    $wp_import->set_homepage();
                    $wp_import->set_profile();
                    $wp_import->set_aboutus();
                    $wp_import->set_pricing();
                    $wp_import->remove_all_posts();
                    $wp_import->set_widgets();
                }

                echo "<div class=\"alert-box alert-success\"><strong>Success!</strong> Import Demo Successfully </div>";
            }
        }else
        {
            echo "<div class=\"alert-box alert-error\"><strong>Error!</strong> Error in import </div>";
        }

        exit();
    }
}






