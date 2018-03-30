<?php
global $post_meta_box;
//$prefix = 'fables_';

/*
$post_meta_box = array(
	'id' => 'my-post-meta-box',
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

$post_meta_box = array(
	'id' => 'my-post-meta-box',
	'title' => MTHEME_NAME . ' metabox',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Post Head Options',
			'id' => MTHEME . '_post_head_options',
			'type' => 'select',
			'desc' => 'Select your choice of post header',
			'options' => array('Default', 'Fullwidth Image', 'Video', 'Fullwidth Video', 'Nivo Slides', 'Fullwidth Nivo Slides')
		),
		array(
			'name' => 'Post Summary',
			'id' => MTHEME . '_post_summary_type',
			'type' => 'select',
			'desc' => 'Post summary display type',
			'options' => array('Show image', 'Show video', 'Show nivo slides')
		),
		array(
			'name' => 'Post video type',
			'id' => MTHEME . '_post_video_type',
			'type' => 'select',
			'desc' => 'Select type of Video',
			'options' => array('No Video', 'Youtube', 'Vimeo')
		),
		array(
			'name' => 'Post Video ID',
			'id' => MTHEME . '_post_video',
			'type' => 'text',
			'desc' => 'Enter video ID'
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

add_action('admin_init', 'post_theme_add_box');

// Add meta box
function post_theme_add_box() {
	global $post_meta_box;
	add_meta_box($post_meta_box['id'], $post_meta_box['title'], 'post_theme_show_box', $post_meta_box['page'], $post_meta_box['context'], $post_meta_box['priority']);
}

// Callback function to show fields in meta box
function post_theme_show_box() {
	global $post_meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($post_meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:300px" />',
					'<br /><div class="description">', $field['desc'] , '</div>';
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:300px">', $meta ? $meta : $field['std'], '</textarea>',
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

add_action('save_post', 'post_theme_save_data');

// Save data from meta box
function post_theme_save_data($post_id) {
	global $post_meta_box;
	
	// verify nonce
	if ( isset($_POST['post_theme_meta_box_nonce']) ) {
		if (!wp_verify_nonce($_POST['post_theme_meta_box_nonce'], basename(__FILE__))) {
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
	

	foreach ($post_meta_box['fields'] as $field) {
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