<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Import / Export backup data
 *
 * @since 1.0.0
 */
class YIT_Backup {

    /**
     * WP Tables to backup
     *
     * @var array
     *
     */
    public static $wptables = array(
        'posts',
        'postmeta',
        'terms',
        'term_taxonomy',
        'term_relationships',
        'comments',
        'commentmeta'
    );


    /**
     * Export backup
     *
     */
    public static function export_backup() {
        global $wpdb, $yiw_wptables;

        $db = array();  // all backup will be in this array

        // retrive all values of tables
        foreach( self::$wptables as $table )
        {
            if( $table == 'posts' )
                $where = " WHERE post_type <> 'revision'";
            else
                $where = '';

            $db[$table] = $wpdb->get_results( "SELECT * FROM {$wpdb->$table}{$where}", ARRAY_A );
        }

        $tables = apply_filters( 'yit_sample_data_tables', array() );
        $tables = apply_filters( 'yit_sample_data_tables_export', $tables );
        if ( ! empty( $tables ) )
            foreach ( $tables as $table ) {
                if( $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->prefix}{$table}'" ) == $wpdb->prefix . $table )
                { $db[$table] = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}{$table}", ARRAY_A ); }
            }

        // options
        $theme = get_option( 'stylesheet' );

        $options = array(
            yit_get_model('panel')->option_name,
            'sidebars_widgets',
            'show_on_front',
            'page_on_front',
            'page_for_posts',
            'widget%',
            'theme\_mods\_%'
        );
        $options = apply_filters( 'yit_sample_data_options', $options );
        $options = apply_filters( 'yit_sample_data_options_export', $options );



        $sql_options = array();
        foreach ( $options as $option ) {
            if ( strpos( $option, '%' ) !== FALSE )
                $operator = 'LIKE';
            else
                $operator = '=';
            $sql_options[] = "option_name $operator '$option'";
        }

        $sql_options = implode( ' OR ', $sql_options );

        $sql = "SELECT option_name, option_value, autoload FROM {$wpdb->options} WHERE $sql_options;";

        $db['options'] = $wpdb->get_results( $sql, ARRAY_A );

        array_walk_recursive( $db, 'yit_convert_url', 'in_export' );
        //yit_debug($db); die;

        $info['content'] = gzcompress( base64_encode( serialize( $db ) ) );
        $info['filename'] = get_option('template') . '_export_' . time() . '.gz';

        do_action( 'yit_after_export' );

        return $info;

    }


    /**
     * Import backup data
     *
     * @param $file array
     * @return bool
     *
     */
    public static function import_backup( $file = '' ) {
        global $wpdb, $yiw_wptables;

        $wpdb->show_errors();

        $error = '';

        if( isset( $_FILES['import-file'] ) && empty( $file ) ) {
            if( !isset( $_FILES['import-file'] ) )
                wp_die( __( "The file you have insert doesn't valid.", 'yit' ) );

            switch ( substr( $_FILES['import-file']['name'], -3 ) ) {

                case 'xml' :
                    $error = sprintf( __( 'The file you have insert is a WordPress eXtended RSS (WXR) file. You need to use this into the %s admin page to import this file. Here only <b>.gz</b> file are allowed. <a href="%s" title="Tools -> Import">Tools -> Import</a>', 'yit' ), admin_url( 'import.php', false ) );
                    break;
                case 'zip' :
                case 'rar' :
                    $error = sprintf( __( 'The file you have insert is a ZIP or RAR file, that it doesn\'t allowed in this case. Here only <b>.gz</b> file are allowed. <a href="%s" title="Tools -> Import">Tools -> Import</a>', 'yit' ), admin_url( 'import.php', false ) );
                    break;
            }

            if ( substr( $_FILES['import-file']['name'], -2 ) != 'gz' ) {
                $error = sprintf( __( 'The file you have insert is not a valid file. Here only <b>.gz</b> file are allowed. <a href="%s" title="Tools -> Import">Tools -> Import</a>', 'yit' ), admin_url( 'import.php', false ) );
            }

            if( $error != '' ) {
                yit_get_model('message')->addMessage($error, 'error');
                return false;
            }
        }

        $file = empty( $file ) ? $_FILES['import-file']['tmp_name'] : $file;

        // get db encoded
        $content_file = file_get_contents( $file );

        $db = unserialize( base64_decode( gzuncompress( $content_file ) ) );

        //yit_debug($db); die;
        array_walk_recursive( $db, 'yit_convert_url', 'in_import' );
        //yit_debug($db); die;

        if( !is_array( $db ) )
            wp_die( __( 'An error encoured during during import. Please try again.', 'yit' ) );

        set_time_limit(0);

        // tables
        foreach( self::$wptables as $table ) {
            // delete all row of each table
            $wpdb->query( "TRUNCATE TABLE {$wpdb->$table}" );

            // insert new data
            $error_data = array();

            $insert = array();
            foreach( $db[$table] as $id => $data ) {
                $insert[] = YIT_Backup::_makeInsertSQL( $data );
            }

            if ( ! empty( $db[$table] ) ) {
                $insert = implode( ', ', $insert );
                $fields = implode( '`, `', array_keys( $db[$table][0] ) );
                //wp_die("INSERT INTO `{$wpdb->$table}` ( `$fields` ) VALUES " . $insert);
                $wpdb->query( "INSERT INTO `{$wpdb->$table}` ( `$fields` ) VALUES " . $insert );
            }
        }

        $tables = apply_filters( 'yit_sample_data_tables', array() );
        $tables = apply_filters( 'yit_sample_data_tables_import', $tables );
        if ( ! empty( $tables ) )
            foreach ( $tables as $table ) {
                if ( ! isset( $db[$table] ) ) continue;

                if( $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->prefix}{$table}'" ) == $wpdb->prefix . $table ) {
                    #yiw_string_( '<p></p><p><strong>', '// ' . $table, '</strong><br />' );

                    // delete all row of each table
                    $wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}{$table}" );
                    #yiw_string_( '', sprintf( __( 'Truncated %s table', 'yit' ), $wpdb->prefix . $table ), '...<br />' );

                    // insert new data
                    $insert = array();
                    foreach( $db[$table] as $id => $data ) {
                        $insert[] = YIT_Backup::_makeInsertSQL( $data );
                    }

                    if ( ! empty( $db[$table] ) ) {
                        $insert = implode( ', ', $insert );
                        $fields = implode( '`, `', array_keys( $db[$table][0] ) );
                        $wpdb->query( "INSERT INTO `{$wpdb->prefix}{$table}` ( `$fields` ) VALUES " . $insert );
                    }
                }
            }

        # yiw_string_( '<p></p><p><strong>', '// options', '</strong><br />' );

        // delete options
        $theme = get_option( 'stylesheet' );

        $options = array(
            yit_get_model('panel')->option_name,
            'sidebars_widgets',
            'show_on_front',
            'page_on_front',
            'page_for_posts',
            'widget%',
            'theme\_mods\_%'
        );
        $options = apply_filters( 'yit_sample_data_options', $options );
        $options = apply_filters( 'yit_sample_data_options_import', $options );

        $sql_options = array();
        foreach ( $options as $option ) {
            if ( strpos( $option, '%' ) !== FALSE )
                $operator = 'LIKE';
            else
                $operator = '=';
            $sql_options[] = "option_name $operator '$option'";
        }

        $sql_options = implode( ' OR ', $sql_options );

        $sql = "DELETE FROM {$wpdb->options} WHERE $sql_options;";

        #if( $wpdb->query( $sql ) )
        #yiw_string_( '', sprintf( __( 'Deleted value from %s table', 'yit' ), $wpdb->options ), '...<br />' );
        #else
        #yiw_string_( '', sprintf( __( 'Error during deleting from %s table (SQL: %s)', 'yit' ), $wpdb->options, $sql ), '...<br />' );
        $wpdb->query( $sql );

        // update options
        $error_data = array();
        $check = $wpdb->get_results( "SELECT * FROM {$wpdb->options} WHERE option_id = 1", ARRAY_A );
        foreach( $db['options'] as $id => $option )
        {
            if ( ! isset( $check['blog_id'] ) )
                unset( $option['blog_id'] );

            if( $wpdb->insert( $wpdb->options, $option ) )
                $insert = true;
            else
                $insert = false;

            // save the ID that has error, to show.
            if( !$insert )
                $wpdb->print_error();//$error_data[] = $option['option_name'];
        }

        #if( $insert )
        #    yiw_string_( '', sprintf( __( 'Insert new values, into %s table', 'yit' ), $wpdb->options ), '...</p>' );
        #else
        #    yiw_string_( '', sprintf( __( 'Error during insert new values (IDs: %s), into %s table', 'yit' ), implode( $error_data, ' ' ), $wpdb->options ), '...</p>' );

        # echo '</p>';

        yit_delete_cache_callback();

        do_action( 'yit_after_import' );

        return true;

    }

    protected static function _makeInsertSQL( $data ) {
        global $wpdb;

        $fields = array_keys( $data );
        $formatted_fields = array();
        foreach ( $fields as $field ) {
            if ( isset( $wpdb->field_types[$field] ) )
                $form = $wpdb->field_types[$field];
            else
                $form = '%s';
            $formatted_fields[] = $form;
        }
        $insert_data = implode( ', ', $formatted_fields );
        return $wpdb->prepare( "( $insert_data )", $data );
    }
}

/**
 * Convert URLs
 *
 */
if( !function_exists('yit_convert_url') ) {
    function yit_convert_url( &$item, $key, $type ) {

        global $importer_uploads_url, $importer_site_url;

        if ( ! isset( $importer_uploads_url ) ) {
            $uploads = wp_upload_dir();
            $importer_uploads_url = YIT_WPCONTENT_URL;
        }

        if ( ! isset( $importer_site_url ) ) {
            $importer_site_url = YIT_SITE_URL;
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
                        array_walk_recursive( $item, "yit_convert_url", $type );
                        if( $item_type == 'serialized' ){
                            $item = serialize( $item );
                        } elseif( $item_type == 'json_encoded' ) {
                            $item = json_encode( $item );
                        }
                    }
                    else {
                        $item = str_replace( '%uploadsurl%', $importer_uploads_url, $item );
                        $item = str_replace( '%siteurl%', $importer_site_url, $item );
                    }
                }

                break;

            case 'in_export' :

                if ( ! is_object( $item ) && ! is_a( $item, '__PHP_Incomplete_Class' ) ) {
                    if ( is_array( $item ) ) {
                        array_walk_recursive( $item, "yit_convert_url", $type );
                        if( $item_type == 'serialized' ){
                            $item = serialize( $item );
                        } elseif( $item_type == 'json_encoded' ) {
                            $item = json_encode( $item );
                        }
                    }
                    else {
                        $parsed_site_url = @parse_url( site_url() );
                        $item = str_replace( $importer_uploads_url, '%uploadsurl%', $item );
                        $item = str_replace( str_replace( $parsed_site_url['scheme'] . '://' . $parsed_site_url['host'], '', $importer_uploads_url ), '%uploadsurl%', $item );
                        $item = str_replace( $importer_site_url, '%siteurl%', $item );
                    }
                }

                break;

        }

    }
}