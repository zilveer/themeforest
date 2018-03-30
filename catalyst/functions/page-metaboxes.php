<?php
global $meta_box;
//$prefix = 'fables_';

/*
$meta_box = array(
	'id' => 'my-meta-box',
	'title' => 'Custom meta box',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Text box',
			'desc' => 'Enter something here',
			'id' => $prefix . 'text',
			'type' => 'text',
			'std' => 'Default value 1'
		),
		array(
			'name' => 'Textarea',
			'desc' => 'Enter big text here',
			'id' => $prefix . 'textarea',
			'type' => 'textarea',
			'std' => 'Default value 2'
		),
		array(
			'name' => 'Select box',
			'id' => $prefix . 'select',
			'type' => 'select',
			'options' => array('Option 1', 'Option 2', 'Option 3')
		),
		array(
			'name' => 'Select box category',
			'id' => $prefix . 'select',
			'desc' => 'Enter big text here',
			'type' => 'select',
			'options' => get_select_target_options('portfolio_category')
		),
		array(
			'name' => 'Radio',
			'id' => $prefix . 'radio',
			'desc' => 'Enter big text here',
			'type' => 'radio',
			'options' => array(
				array('name' => 'Name 1', 'value' => 'Value 1'),
				array('name' => 'Name 2', 'value' => 'Value 2')
			)
		)
	)
);
*/

$meta_box = array(
	'id' => 'my-meta-box',
	'title' => MTHEME_NAME . ' metabox',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Portfolio Style',
			'id' => MTHEME . '_portfolio_style',
			'type' => 'select',
			'desc' => 'Select Style of Porfolio',
			'options' => array('Filterable', '3 Column', '3 Column with images only', '2 Column Sidebar', '2 Column', '2 Column with images only', '1 Column', '1 Column Sidebar')
		),
		array(
			'name' => 'Portfolio Category',
			'id' => MTHEME . '_portfolio_category',
			'desc' => 'Filterable will populate all Child categories from a Parent Category. ( Useful to create Multiple Filterable Portfolios )',
			'type' => 'select',
			'options' => get_select_target_options('portfolio_category')
		),
		array(
			'name' => 'Portfolio Photo Link',
			'id' => MTHEME . '_portfolio_link',
			'type' => 'select',
			'desc' => 'Link portfolio image to lightbox or link direct to its post',
			'options' => array('Lightbox', 'Direct link')
		),
		array(
			'name' => 'Portfolio Items per page',
			'id' => MTHEME . '_portfolio_perpage',
			'type' => 'select',
			'desc' => 'Pagination does not apply for Filterable Portfolio set',
			'options' => array('list all','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20')
		),
		array(
			'name' => 'Choice of Sidebar',
			'id' => MTHEME . '_sidebar_choice',
			'type' => 'select',
			'desc' => 'For Sidebar Active Pages and Posts',
			'options' => array('Default Sidebar', 'Sidebar 1', 'Sidebar 2', 'Sidebar 3', 'Sidebar 4', 'Sidebar 5', 'Sidebar 6', 'Sidebar 7', 'Sidebar 8', 'Sidebar 9', 'Sidebar 10')
		)
	)
);

add_action('admin_init', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
	global $meta_box;
	add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box() {
	global $meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br /><div class="description">', $field['desc'] , '</div>';
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br /><div class="description">', $field['desc'], '</div>';
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select><br /><div class="description">', $field['desc'], '</div>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				echo '<br /><div class="description">', $field['desc'], '</div>';
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /><br /><div class="description">', $field['desc'], '</div>';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
	global $meta_box;
	
	// verify nonce
	if ( isset($_POST['mytheme_meta_box_nonce']) ) {
		if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ( isset($_POST['post_type']) ) {
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	}
	

	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		if ( isset($_POST[$field['id']]) ) {
			$new = $_POST[$field['id']];
		}
		
		if ( isset($new) ) {
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}			
	}
	
}

?>