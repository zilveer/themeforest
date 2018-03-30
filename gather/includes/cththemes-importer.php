<?php 

add_action( 'wp_ajax_cththemes_import', 'cththemes_import_callback' );
function cththemes_import_callback() 
{
    global $wpdb; 

    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

    // Load Importer API
    require_once ABSPATH . 'wp-admin/includes/import.php';

    if ( ! class_exists( 'WP_Importer' ) ) {
        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        if ( file_exists( $class_wp_importer ) )
        {
            require $class_wp_importer;
        }
    }

    if ( ! class_exists( 'WP_Import' ) ) {
        $class_wp_importer = get_template_directory() ."/includes/wordpress-importer.php";
        if ( file_exists( $class_wp_importer ) )
            require $class_wp_importer;
    }


    if ( class_exists( 'WP_Import' ) ) 
    { 
        $import_filepath = get_template_directory() ."/includes/demo_data_xml/gather.xml" ; // Get the xml file from directory 

        include_once get_template_directory() .'/includes/cththemes-import.php';

        $wp_import = new cththemes_import();
        $wp_import->fetch_attachments = true;
        $wp_import->import($import_filepath);

        $wp_import->check();

    }
    die(); // this is required to return a proper result
}