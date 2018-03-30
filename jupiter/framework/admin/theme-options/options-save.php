<?php

add_action('wp_ajax_mk_theme_save', 'mk_theme_save');
function mk_theme_save() {
    
    check_ajax_referer('mk-ajax-theme-options', 'security');
    
    $data = $_POST;
    
    $button_clicked = $_POST['button_clicked'];
    
    
    if ($button_clicked == 'save_theme_options_top' || $button_clicked == 'save_theme_options_bottom') {
        
        unset($data['security'], $data['action']);
        
        if (!is_array(get_option(THEME_OPTIONS))) {
            $options = array();
        } 
        else {
            $options = get_option(THEME_OPTIONS);
        }
        
        $data = is_array($data) ? array_map('stripslashes_deep', $data) : stripslashes($data);
        
        if (!empty($data)) {
            if (update_option(THEME_OPTIONS, $data) && update_option('mk_jupiter_flush_rules', 1)) {
                
                update_option(THEME_OPTIONS . '_backup', $data);
                update_option(THEME_OPTIONS_BUILD, uniqid());
                $static = new Mk_Static_Files(false);
                $static->DeleteThemeOptionStyles(true);

                wp_die('1');
            } else {
                $static = new Mk_Static_Files(false);
                $static->DeleteThemeOptionStyles(true);
                wp_die('2');
            }
        }  else {
            $static = new Mk_Static_Files(false);
            $static->DeleteThemeOptionStyles(true);
            wp_die('0');
        }
    } 
    elseif ($button_clicked == 'reset_theme_options') {
        
        delete_option(THEME_OPTIONS);

        update_option(THEME_OPTIONS_BUILD, uniqid());
        $static = new Mk_Static_Files(false);
        $static->DeleteThemeOptionStyles(true);
        wp_die('3');
    } 
    elseif ($button_clicked == 'import_theme_options') {
        $import_data = $_POST['theme_import_options'];
        $import_data = base64_decode($import_data);
        $import_data_unserilized = $import_data ? unserialize($import_data) : false;
        
        if (!empty($import_data_unserilized) && is_array($import_data_unserilized)) {
            if (update_option(THEME_OPTIONS, $import_data_unserilized)) {
                $static = new Mk_Static_Files(false);
                $static->DeleteThemeOptionStyles(true);
                wp_die('4');
                update_option(THEME_OPTIONS_BUILD, uniqid());
            } 
            else {
                wp_die('5');
            }
        } 
        else {
            wp_die('5');
            // nothing will occure if the field is empty
            
            
        }
    }
}
