<?php
//remove_post_type_support( 'page', 'comments' );
add_post_type_support( 'page', 'comments' );

$sidebars = getSidebarsList();

$meta_box_page = array(
	'id' => 'my-meta-box',
	'title' => 'Page Options',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Select sidebar',
			'desc' => '<br/>Select sidebar, what should be showed with this post',
			'id' => 'sidebar_current',
			'type' => 'select',
			"options" => $sidebars
		),
		array(
			'name' => 'Show sidebar',
			'desc' => '<br/>Show or hide sidebar on this page.',
			'id' => 'sidebar_position',
			'type' => 'select',
			"options" => array("As in Site options|default", "Show sidebar|right", "Hide sidebar (fullwidth page)|fullwidth")
		)
	)
);
add_action('admin_menu', 'wpspace_add_box_page');

// Add meta box
function wpspace_add_box_page() {
    global $meta_box_page;
    
    add_meta_box($meta_box_page['id'], $meta_box_page['title'], 'wpspace_show_box_page', $meta_box_page['page'], $meta_box_page['context'], $meta_box_page['priority']);
}

// Callback function to show fields in meta box
function wpspace_show_box_page() {
    global $meta_box_page, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="wpspace_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($meta_box_page['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong></label></th>',
                '<td>';
        switch ($field['type']) {
		    case 'info':
                echo '<u>'.$field['desc'].'</u>';
				break;
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="'. $meta. '" size="30" style="width:30%" /><br />', '
', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">'. $meta . '</textarea>', '
', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
					$opt = explode('|', $option);
					if (count($opt) == 1) $opt[1] = my_strtolower($opt[0]);
                    echo '<option', $meta == $opt[1] ? ' selected="selected"' : '', ' value="' . $opt[1] . '"' , '>', $opt[0], '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
            case 'file':
                echo '<input type="file" name="', $field['id'], '" id="', $field['id'], '"', $meta ? '' : '', ' />';
                break;
        }
        echo     '<td>',
            '</tr>';      
    }
    
    echo '</table>';
}

add_action('save_post', 'wpspace_save_data_page');

// Save data from meta box
function wpspace_save_data_page($post_id) {
    global $meta_box_page;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    
    // verify nonce
    if (!isset($_POST['wpspace_meta_box_nonce']) || !wp_verify_nonce($_POST['wpspace_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }


    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($meta_box_page['fields'] as $field) {
        $new = isset($_POST[$field['id']]) ? $_POST[$field['id']] : '';
/*
        $old = get_post_meta($post_id, $field['id'], true);
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } else if ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
*/
        update_post_meta($post_id, $field['id'], $new);
    }
}
?>