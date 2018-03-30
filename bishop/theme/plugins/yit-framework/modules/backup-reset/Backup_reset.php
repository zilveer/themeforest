<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
if ( ! defined( 'YIT_BACKUP_RESET' ) ) {
    exit( 'Direct access forbidden.' );
}

/**
 *
 *
 * @class Backup_Reset
 * @package    Yithemes
 * @since      2.0.0
 * @author     Your Inspiration Themes
 *
 */

class YIT_Backup_Reset {

    protected $_backups_upload_dir = '';

    protected $_backups_list = array();

    public $importer_uploads_url;

    protected $_table_file = 'export-data-table.php';

    protected $_import_options = 'import-data-table.php';

    public $tables = array();

    public $import_options = array();

    public $version = YIT_BACKUP_RESET_VERSION;


    /**
     * Constructor Method
     *
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function __construct() {

        $this->_backups_upload_dir = YIT_BACKUP_RESET_PATH . 'backups/';
        $this->_backups_list       = $this->get_backups_list();

        add_action( 'admin_enqueue_scripts', array( $this, 'backup_localize_script' ) );
        add_action( 'wp_ajax_yit_delete_cache_folder', array( $this, 'delete_cache_data' ) );
        add_action( 'wp_ajax_yit_restore_default_value', array( $this, 'reset_theme_option' ) );
        add_action( 'wp_ajax_yit_delete_resized_image', array( $this, 'delete_resized_images' ) );
        add_action( 'wp_ajax_yit_create_backup', array( $this, 'create_backup' ) );
        add_action( 'wp_ajax_yit_delete_backup', array( $this, 'delete_backup' ) );
        add_action( 'wp_ajax_yit_restore_backup', array( $this, 'restore_backup' ) );
        add_action( 'admin_init', array( $this, 'import_export_data' ), 20 );

        /* === ADD YITH PRE-LAUNCH SUPPORT === */
        if( defined( 'YITH_PRELAUNCH' ) && YITH_PRELAUNCH ){
            add_action( 'wp_ajax_yit_restore_default_prelaunch_value', array( $this, 'reset_prelaunch_options' ) );
        }
    }

    public function backup_localize_script() {
        wp_localize_script( 'yit-panel', 'backup_delete_restore', array(
            'delete'             => __( 'Are you sure you want to delete "%filename%" backup file ?', 'yit' ),
            'restore'            => __( 'Are you sure you want to restore "%filename%" backup file ?', 'yit' ),
            'import'             => __( 'Are you sure you want to import data file ? Note: All your data will be lost! ', 'yit' ),
            'import_no_file'     => __( 'You must select a file to upload! ', 'yit' ),
            'import_please_wait' => __( 'Please Wait, Import in progress... ', 'yit' ),
        ) );
    }

    /**
     * Delete Cache
     *
     * Delete Cache data from /chace directory
     *
     * @return void
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function delete_cache_data() {
        $dir = get_stylesheet_directory() . '/cache/';

        // get query string params
        $action = YIT_Request()->post( 'action' );
        $die    = YIT_Request()->post( 'die' );

        $echo = true;
        if ( $action && ( $action == 'import_data' || $action == 'install-sampledata' ) ) {
            $echo = false;
        }

        if ( is_dir( $dir ) ) {

            $files = scandir( $dir );

            //removes . and .. from files list
            unset( $files[0], $files[1] );

            foreach ( $files as $file ) {
                /* Prevent Error if find a special .svn file on cache folder  */
                if( $file == '.svn' ){
                    continue;
                }

                if ( ! @unlink( $dir . $file ) && $echo ) {
                    YIT_Registry::get_instance()->message->addMessage( __( 'Error. Unable to delete the cache!', 'yit' ), 'error' );
                    YIT_Registry::get_instance()->message->printGlobalMessages();

                    if ( $die ) {
                        die();
                    }
                }
            }
        }

        if ( $echo ) {
            if ( $die ) {
                //ajax call
                YIT_Registry::get_instance()->message->addMessage( __( 'Cache deleted successfully!', 'yit' ) );
                YIT_Registry::get_instance()->message->printGlobalMessages();

                die();
            }
        }
    }


    /**
     * Delete Cache
     *
     * Delete Theme Options CSS from Cache directory
     *
     * @param $file_name
     *
     * @internal param string $file the name of file to delete
     *
     * @return void
     * @since    2.0.0
     * @author   Andrea Grillo <andrea.grillo@yithemes.it>
     */
    public function delete_css_from_cache( $file_name ) {
        global $wpdb;

        $dir = get_stylesheet_directory() . '/cache/';

        if ( is_dir( $dir ) ) {

            if ( is_multisite() ) {
                $site_id   = $wpdb->blogid != 0 ? '-' . $wpdb->blogid : '';
                $file_name = str_replace( '.css', $site_id . '.css', $file_name );
            }

            $css_file = $dir . $file_name;

            if ( file_exists( $css_file ) ) {
                @unlink( $css_file );
            }
        }
    }

    /**
     * Reset Theme Option
     *
     * Reset Theme Option to defaults
     *
     * @return void
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function reset_theme_option() {
        $return = YIT_Registry::get_instance()->options->reset_options();

        if ( $return === true ) {
            YIT_Registry::get_instance()->message->addMessage( __( 'Theme Options resetted successfully!', 'yit' ) );
        }
        else {
            YIT_Registry::get_instance()->message->addMessage( __( 'Error. Unable to reset the theme options! Your options may be already set to deafults', 'yit' ), 'error' );
        }

        $this->delete_css_from_cache( YIT_Css()->get_stylesheet_name() );

        YIT_Registry::get_instance()->message->printGlobalMessages();

        die();
    }

    /**
     * Reset Prelaunch Options
     *
     * Reset  Prelaunch Options to defaults
     *
     * @return void
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    public function reset_prelaunch_options() {

        $check = false;

        if ( class_exists( 'YITH_Prelaunch_Admin' ) ) {

            global $yith_prelaunch_options;

            foreach( $yith_prelaunch_options as $tab ) {
                foreach( $tab['sections'] as $section ) {
                    foreach ( $section['fields'] as $id => $value ) {
                        if ( isset( $value['std'] ) && isset( $id ) ) {
                            $check = true;
                            update_option( $id, $value['std'] );
                        }
                    }
                }
            }
        }

        if ( $check ) {
            YIT_Registry::get_instance()->message->addMessage( __( 'YITH Prelanch Options resetted successfully!', 'yit' ), 'updated' );
        }
        else {
            YIT_Registry::get_instance()->message->addMessage( __( 'Error. Unable to reset the YITH Prelanch options!', 'yit' ), 'error' );
        }

        YIT_Registry::get_instance()->message->printGlobalMessages();

        if ( YIT_Request()->is_ajax ) {
            die();
        }
    }

    /**
     * Delete Resized Images
     *
     * Delete all images that matches the pattern *-*x*
     *
     * @return void
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function delete_resized_images() {
        $count = array( 'success' => 0, 'error' => 0 );

        $wp_upload_dir = wp_upload_dir();
        $uploads_dir   = $wp_upload_dir['basedir'];

        foreach ( scandir( $uploads_dir ) as $yfolder ) {
            if ( ! ( is_dir( "$uploads_dir/$yfolder" ) && ! in_array( $yfolder, array( '.', '..' ) ) ) ) {
                continue;
            }

            $yfolder = basename( $yfolder );
            foreach ( scandir( "$uploads_dir/$yfolder" ) as $mfolder ) {
                if ( ! ( is_dir( "$uploads_dir/$yfolder/$mfolder" ) && ! in_array( $mfolder, array( '.', '..' ) ) ) ) {
                    continue;
                }

                $mfolder = basename( $mfolder );
                $images  = (array) glob( "$uploads_dir/$yfolder/$mfolder/*-*x*.*" );
                foreach ( $images as $image ) {
                    $filename = basename( $image );
                    if ( ! preg_match( '/([0-9]{1,4})x([0-9]{1,4})(@2x)?.(jpg|jpeg|png|gif)/', $filename ) ) {
                        continue;
                    }

                    if ( unlink( $image ) ) {
                        $count['success'] ++;
                    }
                    else {
                        $count['error'] ++;
                    }
                }
            }
        }

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            if ($count['error'] == 0) {
                YIT_Registry::get_instance()->message->addMessage( sprintf( _n('%s image deleted!','%s images deleted!', $count['success'], 'yit'), $count['success'] ) );
            } else {
                YIT_Registry::get_instance()->message->addMessage(__('Error. Unable to delete the images!', 'yit'), 'error');
            }

            YIT_Registry::get_instance()->message->printGlobalMessages();
            die();
        }
    }

    /**
     * Create a backup file
     *
     * This method create an encrypt backup file to save theme options settings
     * The file will be save in <theme_folder>/theme/assets/backups
     *
     * @param string $name the file name
     *
     * @return void
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     *
     */
    public function create_backup( $name = '' ) {

        $options = YIT_Registry::get_instance()->options->get_options_from_prefix( YIT_Registry::get_instance()->options->options_name );

        if ( $_POST['backup_name'] ) {
            $name = preg_replace( "/[^a-zA-Z0-9_-]/", "", trim( str_replace( ' ', '-', $_POST['backup_name'] ) ) );
        }

        $name = ! empty( $name ) ? $name : 'backup';
        $name = yit_avoid_duplicate( $name, $this->_backups_list );

        array_walk_recursive( $options, array( $this, 'convert_url' ), 'in_export' );
        $error = file_put_contents( $this->_backups_upload_dir . $name, base64_encode( serialize( $options[YIT_Registry::get_instance()->options->options_name] ) ) );

        if ( ! $error ) {
            YIT_Registry::get_instance()->message->addMessage( __( 'Error. Unable to create backup!', 'yit' ), 'error' );
        }
        else {
            YIT_Registry::get_instance()->message->addMessage( __( 'Success. Backup created!', 'yit' ) );
        }

        YIT_Registry::get_instance()->message->printGlobalMessages();

        echo '<div class="hide" id="backup-temp-name" data-name="' . $name . '"></div>';

        die();
    }

    /**
     * Convert the url in exported/imported data
     *
     * Change the url from the original path with a placeholder
     *
     * @param $item string
     * @param $key  string
     * @param $type string
     *
     * @since  1.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @return void
     */
    public function convert_url( &$item, $key, $type ) {

        if ( ! isset( $this->importer_uploads_url ) ) {
            $upload_dir                 = wp_upload_dir();
            $this->importer_uploads_url = $upload_dir['baseurl'];
        }

        if ( ! isset( $this->importer_content_url ) ) {
            $this->importer_content_url = content_url();
        }

        if ( ! isset( $this->importer_site_url ) ) {
            $this->importer_site_url = site_url() . '/';
        }

        if( yit_string_is_serialized( $item ) ){
            $item = maybe_unserialize( $item );
            $item_type = 'serialized';
        }elseif( yit_string_is_json( $item ) ){
            $item = json_decode( $item, true );
            $item_type = 'json_encoded';
        }else {
            $item_type = 'string';
        }

        switch ( $type ) {

            case 'in_import' :
                if ( ! is_object( $item ) && ! is_a( $item, '__PHP_Incomplete_Class' ) ) {
                    if ( is_array( $item ) ) {
                        array_walk_recursive( $item, array( $this, 'convert_url' ), $type );
                        if( $item_type == 'serialized' ){
                            $item = serialize( $item );
                        } elseif( $item_type == 'json_encoded' ) {
                            $item = json_encode( $item );
                        }
                    }
                    else {
                        $item = str_replace( '%uploadsurl%', $this->importer_uploads_url, $item );
                        $item = str_replace( '%contenturl%', $this->importer_content_url, $item );
                        $item = str_replace( '%siteurl%', $this->importer_site_url, $item );
                    }
                }
                break;

            case 'in_export' :
                if ( ! is_object( $item ) && ! is_a( $item, '__PHP_Incomplete_Class' ) ) {
                    if ( is_array( $item ) ) {
                        array_walk_recursive( $item, array( $this, 'convert_url' ), $type );
                        if( $item_type == 'serialized' ){
                            $item = serialize( $item );
                        } elseif( $item_type == 'json_encoded' ) {
                            $item = json_encode( $item );
                        }
                    }
                    else {
                        $parsed_site_url = @parse_url( $this->importer_site_url );
                        $item            = str_replace( $this->importer_uploads_url, '%uploadsurl%', $item );
                        $item            = str_replace( str_replace( $parsed_site_url['scheme'] . '://' . $parsed_site_url['host'], '', $this->importer_uploads_url ), '%uploadsurl%', $item );
                        $item            = str_replace( $this->importer_content_url, '%contenturl%', $item );
                        $item            = str_replace( $this->importer_site_url, '%siteurl%', $item );
                    }
                }
                break;
        }
    }

    /**
     * Get the list of backup file stored
     *
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @return array backup files list
     */
    public function get_backups_list() {

        $backups_list = array();

        if ( $directory_handle = opendir( $this->_backups_upload_dir ) ) {

            while ( ( $file = readdir( $directory_handle ) ) !== false ) {
                if ( ! is_dir( $file ) && $file != '.svn' ) {
                    $backups_list[] = $file;
                }
            }

            closedir( $directory_handle );
        }

        return $backups_list;
    }

    /**
     * Delete a backup file
     *
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @return void
     */
    public function delete_backup() {
        if ( ! isset( $_POST['backup_name'] ) ) {
            $response = false;
        }
        else {
            $backup_name = $_POST['backup_name'];
            if ( $directory_handle = opendir( $this->_backups_upload_dir ) ) {
                while ( ( $file = readdir( $directory_handle ) ) !== false ) {
                    if ( ! is_dir( $file ) && $file == $backup_name ) {
                        $response = @unlink( $this->_backups_upload_dir . $file );
                    }
                }
                closedir( $directory_handle );
            }
        }

        if ( ! $response ) {
            YIT_Registry::get_instance()->message->addMessage( __( 'Error. Unable to delete backup file!', 'yit' ), 'error' );
        }
        else {
            YIT_Registry::get_instance()->message->addMessage( __( 'Success. Backup file deleted!', 'yit' ) );
        }

        YIT_Registry::get_instance()->message->printGlobalMessages();

        die();
    }


    /**
     * Restore a backup file
     *
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @return void
     */
    public function restore_backup() {

        global $wpdb;

        if ( ! isset( $_POST['backup_name'] ) ) {
            $response = false;
        }
        else {
            $response    = true;
            $backup_file = $this->_backups_upload_dir . $_POST['backup_name'];
            $options     = unserialize( base64_decode( file_get_contents( $backup_file ) ) );

            $response = YIT_Registry::get_instance()->options->save_options( $options );
        }

        if ( ! $response ) {
            YIT_Registry::get_instance()->message->addMessage( __( 'Error. Unable to restore backup file!', 'yit' ), 'error' );
        }
        else {
            YIT_Registry::get_instance()->message->addMessage( __( 'Success. Backup file restored!', 'yit' ) );
        }

        YIT_Registry::get_instance()->message->printGlobalMessages();
        die();
    }

    public function import_export_data() {
        $this->tables         = include_once( YIT_BACKUP_RESET_CONFIG_PATH . '/' . $this->_table_file );
        $this->import_options = include_once( YIT_BACKUP_RESET_CONFIG_PATH . '/' . $this->_import_options );

        if ( isset( $_REQUEST['yit_download'] ) ) {
            $this->_export_data();
        }
        elseif ( isset( $_REQUEST['upload'] ) ) {
            $this->_import_data();
        }
        else {
            return false;
        }
    }

    protected function _export_data() {

        if ( ! isset( $_GET['yit_download'] ) ) {
            return;
        }

        global $wpdb;

        $db = array(); // all backup will be in this array

        // retrive all values of tables
        foreach ( $this->tables['wp'] as $table ) {
            if ( $table == 'posts' ) {
                $where = " WHERE post_type <> 'revision'";
            }
            else {
                $where = '';
            }

            $db[$table] = $wpdb->get_results( "SELECT * FROM {$wpdb->$table}{$where}", ARRAY_A );
        }

        if ( ! empty( $this->tables['plugins'] ) ) {
            foreach ( $this->tables['plugins'] as $table_prefix ) {
                $tables = $wpdb->get_results( "SHOW TABLES LIKE '{$wpdb->prefix}{$table_prefix}'", ARRAY_A );
                if ( count( $tables ) != 0 ) {
                    foreach ( $tables as $key => $table_array ) {
                        foreach ( $table_array as $k => $table ) {
                            $table_no_prefix = preg_replace( "/^{$wpdb->prefix}/", '', $table );
                            $db[$table_no_prefix] = $wpdb->get_results( "SELECT * FROM {$table}", ARRAY_A );
                        }
                    }
                }
            }
        }

        $sql_options = array();
        foreach ( $this->tables['options'] as $option ) {
            if ( strpos( $option, '%' ) !== FALSE ) {
                $operator = 'LIKE';
            }
            else {
                $operator = '=';
            }
            $sql_options[] = $wpdb->prepare( "option_name $operator %s", $option );
        }

        $sql_options = implode( ' OR ', $sql_options );

        $sql = "SELECT option_name, option_value, autoload FROM {$wpdb->options} WHERE $sql_options;";

        $db['options'] = $wpdb->get_results( $sql, ARRAY_A );

        $db[YIT_Custom_Style()->slug] = YIT_Custom_Style()->get_file_content();

        array_walk_recursive( $db, array( $this, 'convert_url' ), 'in_export' );

        //fire an action before gz file download
        do_action_ref_array( 'yit_backup_reset_before_download_gz', array( &$db ) );

        $info['content']  = gzcompress( base64_encode( serialize( $db ) ) );
        $info['filename'] = get_option( 'template' ) . '_export_' . time() . '.gz';

        header( "Content-type: application/gzip-compressed" );
        header( "Content-Disposition: attachment; filename={$info['filename']}" );
        header( "Content-Length: " . strlen( $info['content'] ) );
        header( "Content-Transfer-Encoding: binary" );
        header( 'Accept-Ranges: bytes' );
        header( "Pragma: no-cache" );
        header( "Expires: 0" );

        echo $info['content'];
    }


    protected function _import_data() {

        global $wpdb;

        $error = '';

        if ( isset( $_FILES['import-file'] ) && empty( $file ) ) {
            if ( ! isset( $_FILES['import-file'] ) ) {
                wp_die( __( "The file you have insert doesn't valid.", 'yit' ) );
            }

            switch ( substr( $_FILES['import-file']['name'], - 3 ) ) {

                case 'xml' :
                    $error = sprintf( __( 'The file you have insert is a WordPress eXtended RSS (WXR) file. You need to use this into the %s admin page to import this file. Here only <b>.gz</b> file are allowed.', 'yit' ), admin_url( 'import.php', false ) );
                    break;
                case 'zip' :
                case 'rar' :
                    $error = sprintf( __( 'The file you have insert is a ZIP or RAR file, that it doesn\'t allowed in this case. Here only <b>.gz</b> file are allowed.', 'yit' ) );
                    break;
            }

            if ( substr( $_FILES['import-file']['name'], - 2 ) != 'gz' ) {
                $error = sprintf( __( 'The file you have insert is not a valid file. Here only <b>.gz</b> file are allowed.', 'yit' ) );
            }

            if ( $error != '' ) {
                YIT_Registry::get_instance()->message->addMessage( $error, 'error' );
                return false;
            }
        }

        if( YIT_Request()->post('sampledata') == 'true' ){
            $check_file = YIT_Request()->post('file');
            $file = ! empty( $check_file )  ? $check_file : 'default.gz';
            $wp_remote_get_result = wp_remote_get( $file, array( 'redirection' => 50, 'timeout' => 50 ) );
            $content_file = wp_remote_retrieve_body( $wp_remote_get_result );
        }else{
            $file = empty( $file ) ? $_FILES['import-file']['tmp_name'] : $file;
            $content_file = file_get_contents( $file );
        }

        if( $content_file  ){
            // get db encoded
            $db = unserialize( base64_decode( gzuncompress( $content_file ) ) );

            array_walk_recursive( $db, array( $this, 'convert_url' ), 'in_import' );

            if ( ! is_array( $db ) ) {
                wp_die( __( 'An error encoured during during import. Please try again.', 'yit' ) );
            }

            set_time_limit( 0 );

            // tables
            $tables     = array_keys( $db );
            $db_tables  = $wpdb->get_col( "SHOW TABLES" );
            $theme_name = is_child_theme() ? strtolower( wp_get_theme()->parent()->get( 'Name' ) ) : strtolower( wp_get_theme()->get( 'Name' ) );

            foreach ( $tables as $key => $table ) {

                if ( $table != 'options' && in_array( ( $wpdb->prefix . $table ), $db_tables ) ) {
                    // delete all row of each table
                    if( ! in_array( $table, array( 'users', 'usermeta' ) )  ) {
                        $wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}{$table}" );
                    }

                    // insert new data
                    $error_data = array();

                    $insert = array();
                    foreach ( $db[$table] as $id => $data ) {
                        $insert[] = $this->_makeInsertSQL( $data );
                    }

                    if ( ! empty( $db[$table] ) ) {

                        $num_rows    = count( $insert );
                        $step        = 5000;
                        $insert_step = intval( ceil( $num_rows / $step ) );
                        $fields      = implode( '`, `', array_keys( $db[$table][0] ) );

                        for ( $i = 0; $i < $insert_step; $i ++ ) {

                            $insert_row = implode( ', ', array_slice( $insert, ( $i * $step ), $step ) );
                            $wpdb->query( "INSERT INTO `{$wpdb->prefix}{$table}` ( `$fields` ) VALUES " . $insert_row );
                        }
                    }
                }
                elseif ( $table == 'options' ) {

                    $options_iterator = new ArrayIterator( $db[ $table ] );

                    foreach ( $options_iterator as $id => $data ) {

                        if( $data['option_name'] == ( 'theme_mods_' . $theme_name ) ) {
                            $data_child = $data;
                            $data_child['option_name'] = $data_child['option_name'] . '-child';
                            $options_iterator->append( $data_child );
                        }

                        $fields  = implode( "`,`", array_keys( $data ) );
                        $values  = implode( "', '", array_values( array_map( 'esc_sql', $data ) ) );
                        $updates = '';

                        foreach ( $data as $k => $v ) {
                            $v = esc_sql( $v );
                            $updates .= "{$k} = '{$v}',";
                        }

                        $updates = substr( $updates, 0, - 1 );

                        $query = "INSERT INTO {$wpdb->prefix}{$table}
                                  (`{$fields}`)
                                VALUES
                                  ('{$values}')
                                ON DUPLICATE KEY UPDATE
                                  {$updates};";

                        $wpdb->query( $query );
                    }
                } elseif ( function_exists( 'YIT_Custom_Style' ) && $table == YIT_Custom_Style()->slug ) {
                    $custom_style_file = locate_template( YIT_Custom_Style()->filename );
                    if ( '' != $custom_style_file && is_writeable( $custom_style_file ) ) {
                        $f = fopen( $custom_style_file, 'w' );
                        if ( $f !== false ) {
                            fwrite( $f, $db[$table] );
                            fclose( $f );
                        }
                    }
                }
            }

            //fire an action after import file
            do_action( 'yit_backup_reset_after_file_import', $db );

            $this->delete_cache_data();

            YIT_Registry::get_instance()->message->addMessage( __( 'Content and Data imported correctly!', 'yit' ) );

            if( 'install-sampledata' == YIT_Request()->post( 'action' ) ) {
                YIT_Registry::get_instance()->message->printGlobalMessages();
            }
        }else{
            $error = 'Attention: an error occurred. It is impossible to automatically import your sample data in you installation.
                      To use your data, please use the manual installation: ';
            $error .= '<a href="' . YIT_WPADMIN_URL . '/admin.php?page=yit_panel_backup_and_reset#yit-panel-backup-theme_options_backups">';
            $error .= wp_get_theme() . __(' &#8594; Backup & Reset &#8594; Import and Export Data', 'yit' );
            $error .= '</a>';

            YIT_Registry::get_instance()->message->addMessage( $error, 'error', 'panel' );
            YIT_Registry::get_instance()->message->printMessages();
        }

        if( YIT_Request()->is_ajax ) {
            die();
        }

        return true;
    }

    protected function _makeInsertSQL( $data ) {
        global $wpdb;

        $fields           = array_keys( $data );
        $formatted_fields = array();
        foreach ( $fields as $field ) {
            if ( isset( $wpdb->field_types[$field] ) ) {
                $form = $wpdb->field_types[$field];
            }
            else {
                $form = '%s';
            }
            $formatted_fields[] = $form;
        }
        $insert_data = implode( ', ', $formatted_fields );
        return $wpdb->prepare( "( $insert_data )", $data );
    }
}

