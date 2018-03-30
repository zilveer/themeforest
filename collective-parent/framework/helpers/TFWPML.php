<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

if( !function_exists('tf_is_plugin_active_for_network') )
{
    function tf_is_plugin_active_for_network( $plugin ) {
        if ( !is_multisite() )
            return false;

        $plugins = get_site_option( 'active_sitewide_plugins');
        if ( isset($plugins[$plugin]) )
            return true;

        return false;
    }
}

if( !function_exists( 'tf_is_plugin_active' ) )
{
    function tf_is_plugin_active( $plugin ) {
        return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || tf_is_plugin_active_for_network( $plugin );
    }
}

if(!function_exists('tf_table_exists'))
{
    // Check if the desired table exists, in case it exists return true, in other case return false
    function tf_table_exists($table_name, $wp_prefix = true)
    {
        global $wpdb;

        if($wp_prefix)
        {
            $table_name = $wpdb->prefix . $table_name;
        }

        $tables_list = $wpdb->get_results( $wpdb->prepare("SHOW TABLES LIKE %s", $table_name) );

        if( ( !is_wp_error( $tables_list ) OR ( !is_null( $tables_list ) ) ) AND count( $tables_list ) > 0 )
        {
            return true;
        }

        return false;
    }
}

if(!function_exists('tf_table_isEmpty'))
{
    // Check if the desired table is not empty, in case it is empty return 0, in other case return number of rows
    function tf_table_isEmpty($table_name, $wp_prefix = true)
    {
        global $wpdb;

        if($wp_prefix)
        {
            $table_name = $wpdb->prefix . $table_name;
        }

        $number = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

        return (int)$number;
    }
}

function tfwpml_save_admin_options($value, $option)
{
    if( ( $option['type'] == 'upload' ) OR ( $option['type'] == 'text' ) OR ( $option['type'] == 'textarea' ) )
    {
        icl_register_string('ThemeFuse', $option['id'], $value);
    }
}
function tfwpml_save_sldier_options($value, $option)
{
    icl_register_string('ThemeFuse', $option, $value);
}

function tfwpml_get_admin_options($value, $option)
{
    $translation = icl_t('ThemeFuse', $option, $value);
    if(!$translation)
        return $value;
    return $translation;
}

function tfwpml_addFROM_table($current_string = '', $tables_list = array(), $prefix = true)
{
    global $wpdb;

    if( ( !is_array($tables_list ) ) OR ( empty($tables_list) ))
    {
        return $current_string;
    }
    
    $string = '';

    for( $i = 0; $i < count($tables_list); $i++ )
    {
        $string .= ($prefix) ? $wpdb->prefix . $tables_list[$i] : $tables_list[$i];
        
        if( $i < count($tables_list) - 1 )
        {
            $string .= ', ';
        }
        
    }
    
    if( ( is_string($current_string) ) AND $current_string != '' )
    {
        $string .= ', ' . $current_string;
    }    
    
    return $string;
}

function tfwpml_add_tables_for_seek( $current_string )
{
    return tfwpml_addFROM_table($current_string, array('icl_translations AS ilc_trans'));
}

function tfwpml_add_where_for_seek( $current_string )
{
    $lang =  substr( get_locale(), 0, 2 );
    $post_type = TF_SEEK_HELPER::get_post_type();
    $where = "AND p.ID = ilc_trans.element_id AND ilc_trans.element_type = 'post_" . $post_type . "' AND ilc_trans.language_code = '" . $lang . "' ";

    return $current_string . $where;
}

function tfwpml_addWPML_search_params($languages)
{
    $search_link = '';

    foreach($_GET as $key=>$item)
    {
        if($key != 's')
        {
            $search_link .= '&' . $key . '=' . $item;
        }
    }

    foreach($languages as $code => $language)
    {
        $languages[$code]['url'] .= $search_link;
    }

    return $languages;
}

if( ( tf_is_plugin_active('sitepress-multilingual-cms/sitepress.php') ) AND ( ( tf_table_exists('icl_translations') OR ( tf_table_isEmpty('icl_translations') > 0 ) ) ) )
{
    add_filter('get_search_sql_from', 'tfwpml_add_tables_for_seek');
    add_filter('get_search_sql_where', 'tfwpml_add_where_for_seek');
    add_filter('icl_ls_languages', 'tfwpml_addWPML_search_params');
}

if( ( tf_is_plugin_active('sitepress-multilingual-cms/sitepress.php') ) AND (tf_is_plugin_active( 'wpml-string-translation/plugin.php' ) ) )
{
    add_filter( 'admin_text_value', 'tfwpml_save_admin_options', 10 ,2);
    add_filter( 'tfuse_options_value', 'tfwpml_get_admin_options', 10, 2 );

    add_filter( 'tfuse_slider_value', 'tfwpml_save_sldier_options', 10 ,2);
    add_filter( 'tfuse_sldier_value', 'tfwpml_get_admin_options', 10, 2 );
}
