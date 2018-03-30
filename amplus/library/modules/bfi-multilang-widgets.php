<?php

// Some code is from the plugin http://wordpress.org/extend/plugins/widget-logic/
// and referenced from http://wordpress.stackexchange.com/questions/66293/how-to-add-an-extra-field-in-all-wordpress-available-widgets

// this displays the new fields for the widget in the admin as well as saves new field data
add_action('sidebar_admin_setup', 'bfi_multilang_widgets_setup');

// this is in charge of getting the base_id of the widget currently being processed
add_action('dynamic_sidebar', 'bfi_multilang_widget_display');
// using the base_id of above, change the title of the widget
add_filter('widget_title', 'bfi_multilang_widget_title', 10, 3);
// using the base_id of above, change the text of the widget (only applicable in some widgets)
add_filter('widget_text', 'bfi_multilang_widget_text', 10, 2);

// this is a custom filter for adding new translatable text
add_filter('widget_translate', 'bfi_multilang_widget_translate', 10, 2);
// filter above should be called like this:
// apply_filters('widget_translate', $text, $fieldName)

// this is a custom filter for adding new translation fields in widgets
add_action('widget_translate_form', 'bfi_multilang_widget_form', 10, 3);
// action above should be called like this:
// do_action('widget_translate_form', $instanceID, $fieldID, $fieldLabel)


// this displays the new fields for the widget in the admin as well as saves new field data
function bfi_multilang_widgets_setup() {
    // Check first if multilanguage is enabled
    $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
    if (!$languages) return;
    
    $languages = unserialize($languages);
    if (!count($languages)) return;
    
    // continue
    global $wp_registered_widgets, $wp_registered_widget_controls, $wl_options;
    
    // save the language data
    if ($_POST) {
        // loop through all post data and find the ones that match our language fields
        foreach ($_POST as $key => $value) {
            if (!preg_match('#^bfi_lang_widget_#', $key)) continue;
            
            // save the data
            bfi_update_option($key, $value);
        }
    }

    // ADD EXTRA WIDGET LOGIC FIELD TO EACH WIDGET CONTROL
    // pop the widget id on the params array (as it's not in the main params so not provided to the callback)
    foreach ( $wp_registered_widgets as $id => $widget )
    {   // controll-less widgets need an empty function so the callback function is called.
        if (!$wp_registered_widget_controls[$id])
            wp_register_widget_control($id,$widget['name'], 'widget_logic_empty_control');
            
        $wp_registered_widget_controls[$id]['callback_wl_redirect'] = $wp_registered_widget_controls[$id]['callback'];
        $wp_registered_widget_controls[$id]['callback'] = 'widget_logic_extra_control';
        array_push( $wp_registered_widget_controls[$id]['params'], $id );   
    }
    
    
}

// added to widget functionality in 'widget_logic_expand_control' (above)
function widget_logic_empty_control() {}


// added to widget functionality in 'widget_logic_expand_control' (above)
function widget_logic_extra_control() {
    global $wp_registered_widget_controls, $wl_options;

    $params = func_get_args();
    $id = array_pop($params);

    // go to the original control function
    $callback = $wp_registered_widget_controls[$id]['callback_wl_redirect'];
    if ( is_callable($callback) )
        call_user_func_array($callback, $params);       

    // dealing with multiple widgets - get the number. if -1 this is the 'template' for the admin interface
    $number=$params[0]['number'];
    if ($number==-1)
        $number="%i%";
    $instanceID=$id;
    if ( isset($number) ) 
        $instanceID = $wp_registered_widget_controls[$id]['id_base'].'-'.$number;
    
    // Add in the new fields
    bfi_multilang_widget_form($instanceID, "title", "Title");

    // for the Text widget, add a new field for the text
    if ($wp_registered_widget_controls[$id]['name'] == "Text") {
        bfi_multilang_widget_form($instanceID, "text", "Text", true);
    }
}


// this is a custom filter for adding new translation fields in widgets
function bfi_multilang_widget_form($instanceID, $fieldID, $fieldLabel, $isTextArea = false) {
    // Only do this if multilanguage is enabled
    $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
    if (!$languages) return;
    
    $languages = unserialize($languages);
    if (!count($languages)) return;
    
    
    // loop through languages and create fields
    foreach ($languages as $language => $locale) {
        $languageNames = bfi_list_languages();
        $languageName = $languageNames[$language];
        
        $fieldName = "bfi_lang_widget_{$instanceID}_{$fieldID}_{$language}";
        $value = bfi_get_option($fieldName);
        if (function_exists('esc_textarea')) {
            $value = esc_textarea($value);
        }

        if (!$isTextArea) {
            echo "<p><label for='$fieldName'>$fieldLabel: <span class='lang_note'>".__("Language", BFI_I18NDOMAIN)." $languageName ($language)</span><input class='widefat' type='text' name='$fieldName' id='$fieldName' value='$value'/></label></p>";
        } else {
            echo "<p><label for='$fieldName'>$fieldLabel: <span class='lang_note'>".__("Language", BFI_I18NDOMAIN)." $languageName ($language)</span><textarea class='widefat' type='text' name='$fieldName' id='$fieldName' rows='8' cols='20'>$value</textarea></label></p>";
        }
    }
}


// this is in charge of getting the base_id of the widget currently being processed
function bfi_multilang_widget_display($wp_registered_widgets) {
    // remember the instance ID of the widget, we'll use this in the functions below
    global $BFIMultilangAdminWidgetID;
    $BFIMultilangAdminWidgetID = $wp_registered_widgets['id'];
}


// using the base_id of above, change the title of the widget
function bfi_multilang_widget_title($title, $instance = '', $idBase = '') {
    return bfi_multilang_widget_translate($title, "title");
}


// using the base_id of above, change the text of the widget (only applicable in some widgets)
function bfi_multilang_widget_text($text, $instance = '') {
    return bfi_multilang_widget_translate($text, "text");
}


// this is a custom filter for adding new translatable text
function bfi_multilang_widget_translate($text, $fieldName) {
    // if multilanguage isn't enabled, don't do anything
    if (!isset($_SESSION) || !isset($_SESSION['l'])) return $text;

    // get the widget instance ID
    global $BFIMultilangAdminWidgetID;
    
    // get the translated text from the theme options
    $newText = stripslashes(bfi_get_option("bfi_lang_widget_{$BFIMultilangAdminWidgetID}_{$fieldName}_{$_SESSION['l']}"));

    // use the translated text if possible
    return $newText ? $newText : $text;
}
