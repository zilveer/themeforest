<?php

function xxxx_add_edit_form_multipart_encoding() {

    echo ' enctype="multipart/form-data"';

}
add_action('post_edit_form_tag', 'xxxx_add_edit_form_multipart_encoding');

$prefix = 'ag_';
 
$meta_box = array(
	'id' => 'my-meta-box',
	'title' => 'Slideshow Images',
	'page' => 'portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	array(
			'name' => __('Slide 1 Image', 'framework'),
			'desc' => '<span style="font-size:10px; color:#555;">Must be at least 500px wide. Unlimited Height.</span>',
			'id' => 'upload_image',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => '',
			'desc' => __('Select a Slide 1 Image', 'framework'),
			'id' => 'upload_image_button',
			'type' => 'button',
			'std' => 'Browse'
		),
	array(
			'name' => __('Select a Slide 2 Image', 'framework'),
			'desc' => '<span style="font-size:10px; color:#555;">Must be at least 500px wide. Unlimited Height.</span>',
			'id' => 'upload_image2',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => '',
			'desc' => __('Select a Slide 2 Image', 'framework'),
			'id' => 'upload_image_button2',
			'type' => 'button',
			'std' => 'Browse'
		),
	array(
			'name' => __('Select a Slide 3 Image', 'framework'),
			'desc' => '<span style="font-size:10px; color:#555;">Must be at least 500px wide. Unlimited Height.</span>',
			'id' => 'upload_image3',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => '',
			'desc' => __('Select a Slide 3 Image', 'framework'),
			'id' => 'upload_image_button3',
			'type' => 'button',
			'std' => 'Browse'
		),
	array(
			'name' => __('Select a Slide 4 Image', 'framework'),
			'desc' => '<span style="font-size:10px; color:#555;">Must be at least 500px wide. Unlimited Height.</span>',
			'id' => 'upload_image4',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => '',
			'desc' => __('Select a Slide 4 Image', 'framework'),
			'id' => 'upload_image_button4',
			'type' => 'button',
			'std' => 'Browse'
		),
	array(
			'name' => __('Select a Slide 5 Image', 'framework'),
			'desc' => '<span style="font-size:10px; color:#555;">Must be at least 500px wide. Unlimited Height.</span>',
			'id' => 'upload_image5',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => '',
			'desc' => __('Select a Slide 5 Image', 'framework'),
			'id' => 'upload_image_button5',
			'type' => 'button',
			'std' => 'Browse'
		),
	array(
			'name' => __('Select a Slide 6 Image', 'framework'),
			'desc' => '<span style="font-size:10px; color:#555;">Must be at least 500px wide. Unlimited Height.</span>',
			'id' => 'upload_image6',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => '',
			'desc' => __('Select a Slide 5 Image', 'framework'),
			'id' => 'upload_image_button6',
			'type' => 'button',
			'std' => 'Browse'
		),
	)
);

$meta_box_video = array(
	'id' => 'ag-meta-box-video',
	'title' => __('Video Settings', 'framework'),
	'page' => 'portfolio',
	'context' => 'side',
	'priority' => 'core',
	'fields' => array(
	array(
			'name' => __('Youtube or Vimeo URL', 'framework'),
			'desc' => __('If you are using youtube or Vimeo, please enter in the URL here.', 'framework'),
			'id' => $prefix . 'video_url',
			'type' => 'text',
			'std' => ''
		)
	),
	
);
 
add_action('admin_menu', 'mytheme_add_box');


 
// Add meta box
function mytheme_add_box() {
	global $meta_box, $meta_box_video;
 
	add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
	add_meta_box($meta_box_video['id'], $meta_box_video['title'], 'mytheme_show_video_box', $meta_box_video['page'], $meta_box_video['context'], $meta_box_video['priority']);
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
				'<th style="width:10%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong></label></th>',
				'<td>';
		switch ($field['type']) {
 
 
//If Text		
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:75%" />',
					'<br /><span style=" display:block; color:#999; line-height: 20px; margin:5px 0 0 0;">'.$field['desc'].'</span>';
				break;
 
 
//If Text Area			
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
 
 
//If Button	
 
				case 'button':
				echo '<input style="float: left; margin-top:-15px; margin-bottom:15px;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
 
	echo '</table>';
}

function mytheme_show_video_box() {
	global $meta_box_video, $post;
	
		// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 	
	echo '<p style="padding:10px 0 0 0;">'.__('These settings enable you to provide videos for your viewers to watch.', 'framework').'</p>';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_video['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;
 
			//If Button	
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
		}

	}
 
	echo '</table>';
}
 
 
add_action('save_post', 'mytheme_save_data');
 
// Save data from meta box
function mytheme_save_data($post_id) {
	global $meta_box, $meta_box_video;
 	
	if ( isset($_POST['mytheme_meta_box_nonce'])) {
	// verify nonce
	if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}  
	
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
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
 
	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
foreach ($meta_box_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
}
function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_template_directory_uri() . '/functions/js/portfolio-upload.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
function my_admin_styles() {
wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');
?>