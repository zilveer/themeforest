<?php

require_once('content_types/post.php');
require_once('content_types/page.php');
require_once('content_types/product.php');
require_once('content_types/portfolio.php');
require_once('content_types/faq.php');
require_once('content_types/block.php');

// Return Content Type Labels
function venedor_labels($singular_name, $name, $title = FALSE) {
    if( !$title )
        $title = $name;
        
    return array(
        "name" => $title,
        "singular_name" => $singular_name,
        "add_new" => "Add New",
        "add_new_item" => sprintf( "Add New %s", $singular_name),
        "edit_item" => sprintf( "Edit %s", $singular_name),
        "new_item" => sprintf( "New %s", $singular_name),
        "view_item" => sprintf( "View %s", $name),
        "search_items" => sprintf( "Search %s", $name),
        "not_found" => sprintf( "No %s found", $name),
        "not_found_in_trash" => sprintf( "No %s found in Trash", $name),
        "parent_item_colon" => ""
    );
}

// Return Taxonomy Labels
function venedor_labels_tax($singular_name, $name) {
    return array(
        "name" => $name,
        "singular_name" => $singular_name,
        "search_items" => sprintf( "Search %s", $name),
        "all_items" => sprintf( "All %s", $name),
        "parent_item" => sprintf( "Parent %s", $singular_name),
        "parent_item_colon" => sprintf( "Parent %s:", $singular_name),
        "edit_item" => sprintf( "Edit %", $singular_name),
        "update_item" => sprintf( "Update %s", $singular_name),
        "add_new_item" => sprintf( "Add New %s", $singular_name),
        "new_item_name" => sprintf( "New %s Name", $singular_name),
        "menu_name" => $name,
    );
}

// Return Meta Labels
function venedor_labels_meta($name, $title, $desc, $type, $std = "", $class = null, $options = null) {
    return array(
        "name" => $name,  
        "title" => $title,
        "description" => $desc,
        "type" => $type,
        "std" => $std,
        "class" => $class,
        "options" => $options
    );
}

// Show Meta Boxes
function venedor_show_meta_boxes($meta_boxes) {
    if (!isset($meta_boxes)) 
        return;
        
    echo '<div class="postoptions">';
    foreach ($meta_boxes as $meta_box) {
        venedor_show_meta_box($meta_box);
    }
    echo'</div>';
}

// Show Meta Box
function venedor_show_meta_box($meta_box) {

    if ( isset( $_GET['post'] ) ) {
        $post_id = (int)( $_GET['post'] );
        $post    = get_post( $post_id );
    }
    else {
        $post = $GLOBALS['post'];
    }
    
    $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
    
    if ($meta_box_value == "")
        $meta_box_value = $meta_box['std'];

    echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

    if ($meta_box['type'] == "text") { // text
        echo '<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
        echo '<div class="box-option">';
        echo '<input type="text" id="'.$meta_box['name'].'" name="'.$meta_box['name'].'" value="'.stripslashes($meta_box_value).'" size="50%" />';
        echo '</div>';
        echo '<div class="box-info"><label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label></div>';  
        echo '</div></div>';
    }
    if ($meta_box['type'] == "customselect") { // custom select
        echo '<div class="metabox">';
        echo '<h3>'.$meta_box['title'].'</h3><div class="metainner">';
        echo '<div class="box-option">';
        echo '<select name="'.$meta_box['name'].'" id="'.$meta_box['name'].'">';
        echo '<option value="">select</option>';
        if (is_array($meta_box['options'])) {
            foreach ($meta_box['options'] as $key => $value) {
                echo '<option value="'.$key.'"'.($meta_box_value == $key ? ' selected="selected"' : '').'>'.$value.'</option>';
            }
        }        
        echo '</select>';        
        echo '</div>';
        echo '<div class="box-info"><label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label></div>';
        echo '</div></div>';
    }
    if ($meta_box['type'] == "upload") { // upload image
        echo '<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
        echo '<div class="box-option">';
        echo "<label for='upload_image'>";
        echo '<input value="'.stripslashes($meta_box_value).'" type="text" name="'.$meta_box['name'].'"  id="'.$meta_box['name'].'" size="50%" />';
        echo '<br/><input class="button_upload_image button" id="'.$meta_box['name'].'" type="button" value="Upload Image" />&nbsp;';
        echo '<input class="button_remove_image button" id="'.$meta_box['name'].'" type="button" value="Remove Image" />';
        echo '</label>';
        echo '</div></div></div>';
    }
    if ($meta_box['type'] == "textarea") { // textarea
        echo '<div class="metabox"><h3 style="float:none;">'.$meta_box['title'].'</h3><div class="metainner">';
        echo '<div class="box-option">';
        wp_editor( $meta_box_value, $meta_box['name'] );
        echo '</div>';
        echo '<div class="box-info"><label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label></div>';
        echo '</div></div>';
    }
    if (($meta_box['type'] == 'radio') && (!empty($meta_box['options']))) { // radio buttons
        echo '<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
        echo '<div class="box-option radio">';
        foreach ($meta_box['options'] as $key => $value) {
            echo '<input type="radio" id="'.$meta_box['name'].'_'.$key.'" name="'.$meta_box['name'].'"  value="' . $key . '" ' . (isset($meta_box_value) && ($meta_box_value == $key) ? ' checked="checked"' : '') . '/><label for="'.$meta_box['name'].'_'.$key.'"> ' . $value . ' </label>&nbsp; ' . "\n";
        }
        echo '</div>';
        echo '<div class="box-info"><label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label></div>';
        echo '</div></div>';
    }
    if ($meta_box['type'] == "checkbox") {  // checkbox
        if ( $meta_box_value == $meta_box['name'] ) { 
            $checked = "checked=\"checked\""; 
        } else { 
            $checked = ""; 
        } 
        echo '<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
        echo '<div class="box-option checkbox">';
        echo '<label><input type="checkbox" name="'.$meta_box['name'].'" value="'.$meta_box['name'].'" '.$checked.' /> '.$meta_box['description'].'</label></div>';
        echo '</div></div>';
    }
    if (($meta_box['type'] == 'multi_checkbox') && (!empty($meta_box['options']))) { // radio buttons
        echo '<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
        echo '<div class="box-option">';
        foreach ($meta_box['options'] as $key => $value) {
            echo '<input type="checkbox" id="'.$meta_box['name'].'_'.$key.'" name="'.$meta_box['name'].'[]" value="' . $key . '" ' . ((isset($meta_box_value) && in_array($key, explode(',', $meta_box_value))) ? ' checked="checked"' : '') . '/><label for="'.$meta_box['name'].'_'.$key.'"> ' . $value . ' </label>&nbsp; ' . "\n";
        }
        echo '</div>';
        echo '<div class="box-info"><label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label></div>';
        echo '</div></div>';
    }
}

// Save Post Data
function venedor_save_postdata($post_id, $meta_boxes) {
    
    global $post;
    
    if (!isset($meta_boxes)) 
        return;
    
    foreach ($meta_boxes as $meta_box) {
        if ( !isset($_POST[$meta_box['name'].'_noncename']))
            return $post_id;
            
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ) ) {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        } else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }
        
        $meta_box_value = get_post_meta($post_id, $meta_box['name'], true);
        
        if (!isset($_POST[$meta_box['name']])) {
            delete_post_meta($post_id, $meta_box['name'], $meta_box_value);
            continue;
        }
        
        $data = $_POST[$meta_box['name']];
            
        if (is_array($data))
            $data = implode(',', $data);
        
        if (!$meta_box_value && !$data)
            add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif ($data != $meta_box_value)
            update_post_meta($post_id, $meta_box['name'], $data);
        elseif (!$data)
            delete_post_meta($post_id, $meta_box['name'], $meta_box_value);        
    }
}

// Show Taxonomy Add Meta Boxes
function venedor_show_tax_add_meta_boxes($meta_boxes) {
    if (!isset($meta_boxes))
        return;
        
    foreach ($meta_boxes as $meta_box) {
        venedor_show_tax_add_meta_box($meta_box);
    }
}

// Show Taxonomy Add Meta Box
function venedor_show_tax_add_meta_box($meta_box) {
    
    echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
    
    if ($meta_box['type'] == "text") { // text
        echo '<div class="form-field"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';                
        echo '<input type="text" id="'.$meta_box['name'].'" name="'.$meta_box['name'].'" />';
        if ($meta_box['description']) echo '<p>'. $meta_box['description'] .'</p>';
        echo '</div>';
    }
    if ($meta_box['type'] == "customselect") { // custom select
        echo '<div class="form-field">';
        echo '<label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';
        echo '<select name="'.$meta_box['name'].'" id="'.$meta_box['name'].'">';
        echo '<option value="">select</option>';
        if (is_array($meta_box['options'])) {
            foreach ($meta_box['options'] as $key => $value) {
                echo '<option value="'.$key.'">'.$value.'</option>';
            }
        }
        echo '</select>';
        if ($meta_box['description']) echo '<p>'. $meta_box['description'] .'</p>';
        echo '</div>';
    }
    if ($meta_box['type'] == "upload") { // upload image
        echo '<div class="form-field">';
        echo '<label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';
        echo "<label for='upload_image'>";
        echo '<input style="margin-bottom:5px;" type="text" name="'.$meta_box['name'].'"  id="'.$meta_box['name'].'" />';
        echo '<br/><button class="button_upload_image button" id="'.$meta_box['name'].'">Upload Image</button>&nbsp;';
        echo '<button class="button_remove_image button" id="'.$meta_box['name'].'">Remove Image</button>';
        echo '</label>';
        if ($meta_box['description']) echo '<p>'. $meta_box['description'] .'</p>';
        echo '</div>';
    }
    if ($meta_box['type'] == "textarea") { // textarea
        echo '<div class="form-field">';
        echo '<label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';
        wp_editor( '', $meta_box['name'] );
        if ($meta_box['description']) echo '<p>'. $meta_box['description'] .'</p>';
        echo '</div>';
    }
    if (($meta_box['type'] == 'radio') && (!empty($meta_box['options']))) { // radio buttons
        echo '<div class="form-field">';
        echo '<label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';
        foreach ($meta_box['options'] as $key => $value) {
            echo '<input style="display:inline-block; width:auto;" type="radio" id="'.$meta_box['name'].'_'.$key.'" name="'.$meta_box['name'].'"  value="' . $key . '"/><label style="display:inline-block" for="'.$meta_box['name'].'_'.$key.'"> ' . $value . ' </label>&nbsp; ' . "\n";
        }
        if ($meta_box['description']) echo '<p>'. $meta_box['description'] .'</p>';
        echo '</div>';
    }
    if ($meta_box['type'] == "checkbox") { // checkbox
        echo '<div class="form-field">';
        echo '<label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';
        echo '<label><input style="display:inline-block; width:auto;" type="checkbox" name="'.$meta_box['name'].'" value="'.$meta_box['name'].'" /> '.$meta_box['description'].'</label>';
        echo '</div>';
    }
    if (($meta_box['type'] == 'multi_checkbox') && (!empty($meta_box['options']))) { // radio buttons
        echo '<div class="form-field">';
        echo '<label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';
        foreach ($meta_box['options'] as $key => $value) {
            echo '<input style="display:inline-block; width:auto;" type="checkbox" id="'.$meta_box['name'].'_'.$key.'" name="'.$meta_box['name'].'[]" value="' . $key . '" /><label style="display:inline-block" for="'.$meta_box['name'].'_'.$key.'"> ' . $value . ' </label>&nbsp; ' . "\n";
        }
        if ($meta_box['description']) echo '<p>'. $meta_box['description'] .'</p>';
        echo '</div>';
    }
}

// Show Taxonomy Add Meta Boxes
function venedor_show_tax_edit_meta_boxes($tag, $taxonomy, $meta_boxes) {
    if (!isset($meta_boxes))
        return;
        
    foreach ($meta_boxes as $meta_box) {
        venedor_show_tax_edit_meta_box($tag, $taxonomy, $meta_box);
    }
}

// Show Taxonomy Add Meta Box
function venedor_show_tax_edit_meta_box($tag, $taxonomy, $meta_box) {
    
    echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
    
    $meta_box_value = get_metadata($tag->taxonomy, $tag->term_id, $meta_box['name'], true);
        
    if ($meta_box_value == "")
        $meta_box_value = $meta_box['std'];
    
    if ($meta_box['type'] == "text") { // text
        echo '<tr class="form-field">';
        echo '<th scope="row" valign="top"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label></th>';
        echo '<td>';
        echo '<input type="text" id="'.$meta_box['name'].'" name="'.$meta_box['name'].'" value="'.stripslashes($meta_box_value).'" size="50%" />';
        if ($meta_box['description']) echo '<p class="description">'. $meta_box['description'] .'</p>';
        echo '</td></tr>';
    }
    if ($meta_box['type'] == "customselect") { // custom select
        echo '<tr class="form-field">';
        echo '<th scope="row" valign="top"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label></th>';
        echo '<td>';
        echo '<select name="'.$meta_box['name'].'" id="'.$meta_box['name'].'">';
        echo '<option value="">select</option>';
        if (is_array($meta_box['options'])) {
            foreach ($meta_box['options'] as $key => $value) {
                echo '<option value="'.$key.'"'.($meta_box_value == $key ? ' selected="selected"' : '').'>'.$value.'</option>';
            }
        }
        echo '</select>';
        if ($meta_box['description']) echo '<p class="description">'. $meta_box['description'] .'</p>';       
        echo '</td></tr>';
    }
    if ($meta_box['type'] == "upload") { // upload image
        echo '<tr class="form-field">';
        echo '<th scope="row" valign="top"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label></th>';
        echo '<td>';
        echo "<label for='upload_image'>";
        echo '<input style="margin-bottom:5px;" value="'.stripslashes($meta_box_value).'" type="text" name="'.$meta_box['name'].'"  id="'.$meta_box['name'].'" size="50%" />';
        echo '<br/><button class="button_upload_image button" id="'.$meta_box['name'].'">Upload Image</button>&nbsp;';
        echo '<button class="button_remove_image button" id="'.$meta_box['name'].'">Remove Image</button>';
        echo '</label>';
        if ($meta_box['description']) echo '<p class="description">'. $meta_box['description'] .'</p>';       
        echo '</td></tr>';
    }
    if ($meta_box['type'] == "textarea") { // textarea
        echo '<tr class="form-field">';
        echo '<th colspan="2" scope="row" valign="top"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label></th>';
        echo '<tr><td colspan="2">';
        wp_editor( $meta_box_value, $meta_box['name'] );
        if ($meta_box['description']) echo '<p class="description">'. $meta_box['description'] .'</p>';       
        echo '</td></tr>';
    }
    if (($meta_box['type'] == 'radio') && (!empty($meta_box['options']))) { // radio buttons
        echo '<tr class="form-field">';
        echo '<th scope="row" valign="top"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label></th>';
        echo '<td>';
        foreach ($meta_box['options'] as $key => $value) {
            echo '<input style="display:inline-block; width:auto;" type="radio" id="'.$meta_box['name'].'_'.$key.'" name="'.$meta_box['name'].'"  value="' . $key . '" ' . (isset($meta_box_value) && ($meta_box_value == $key) ? ' checked="checked"' : '') . '/><label for="'.$meta_box['name'].'_'.$key.'"> ' . $value . ' </label>&nbsp; ' . "\n";
        }
        if ($meta_box['description']) echo '<p class="description">'. $meta_box['description'] .'</p>';       
        echo '</td></tr>';
    }
    if ($meta_box['type'] == "checkbox") {  // checkbox
        if ( $meta_box_value == $meta_box['name'] ) { 
            $checked = "checked=\"checked\""; 
        } else { 
            $checked = ""; 
        } 
        echo '<tr class="form-field">';
        echo '<th scope="row" valign="top"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label></th>';
        echo '<td>';
        echo '<label><input style="display:inline-block; width:auto;" type="checkbox" name="'.$meta_box['name'].'" value="'.$meta_box['name'].'" '.$checked.' /> '.$meta_box['description'].'</label>';
        echo '</td></tr>';
    }
    if (($meta_box['type'] == 'multi_checkbox') && (!empty($meta_box['options']))) { // radio buttons
        echo '<tr class="form-field">';
        echo '<th scope="row" valign="top"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label></th>';
        echo '<td>';
        foreach ($meta_box['options'] as $key => $value) {
            echo '<input style="display:inline-block; width:auto;" type="checkbox" id="'.$meta_box['name'].'_'.$key.'" name="'.$meta_box['name'].'[]" value="' . $key . '" ' . ((isset($meta_box_value) && in_array($key, explode(',', $meta_box_value))) ? ' checked="checked"' : '') . '/><label for="'.$meta_box['name'].'_'.$key.'"> ' . $value . ' </label>&nbsp; ' . "\n";
        }
        if ($meta_box['description']) echo '<p class="description">'. $meta_box['description'] .'</p>';       
        echo '</td></tr>';
    }
}

// Save Tax Data
function venedor_save_taxdata( $term_id, $tt_id, $taxonomy, $meta_boxes ) {
    if (!isset($meta_boxes))
        return;
        
    foreach ($meta_boxes as $meta_box) {
        if ( !isset($_POST[$meta_box['name'].'_noncename']))
            return;
        
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ) ) {
            return;
        }
        
        $meta_box_value = get_metadata($taxonomy, $term_id, $meta_box['name'], true);
        
        if (!isset($_POST[$meta_box['name']])) {
            delete_metadata($taxonomy, $term_id, $meta_box['name'], $meta_box_value);
            continue;
        }
        
        $data = $_POST[$meta_box['name']];
            
        if (is_array($data))
            $data = implode(',', $data);
        
        if (!$meta_box_value && !$data)
            add_metadata($taxonomy, $term_id, $meta_box['name'], $data, true);
        elseif ($data != $meta_box_value)
            update_metadata($taxonomy, $term_id, $meta_box['name'], $data);
        elseif (!$data)
            delete_metadata($taxonomy, $term_id, $meta_box['name'], $meta_box_value);
    }
}

// Create Meta Table
function create_metadata_table($table_name, $type) {
    global $wpdb;

    if (!empty ($wpdb->charset))
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
    if (!empty ($wpdb->collate))
        $charset_collate .= " COLLATE {$wpdb->collate}";

    if (!$wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
        $sql = "CREATE TABLE {$table_name} (
            meta_id bigint(20) NOT NULL AUTO_INCREMENT,
            {$type}_id bigint(20) NOT NULL default 0,
            meta_key varchar(255) DEFAULT NULL,
            meta_value longtext DEFAULT NULL,
            UNIQUE KEY meta_id (meta_id)
        ) {$charset_collate};";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

?>
