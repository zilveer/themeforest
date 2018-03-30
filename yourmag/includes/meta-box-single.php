<?php
$prefix = 'r_';

$meta_box_single = array(
	'id' => 'my-meta-box',
	'title' => 'Single post settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

	    array(
			'name' => 'Custom post excerpt',
			'desc' => 'Write a small text for excerpt of posts',
			'id' => $prefix . 'post_text',
			'type' => 'textarea',
			'std' => ''
		),

	    array(
			'name' => 'Custom Read more',
			'desc' => 'Write a small text instead Read more text',
			'id' => $prefix . 'custom_read_more',
			'type' => 'text',
			'std' => ''
		),
		
	    array(
			'name' => 'Custom Read more - Link',
			'desc' => 'Write a custom link instead default (ex. on other site)',
			'id' => $prefix . 'custom_rm_link',
			'type' => 'text',
			'std' => ''
		),		
		
	    array(
			'name' => 'Thumbnail - Variant',
			'desc' => 'Select layout for post thumbnail',
			'id' => $prefix . 'post_thumb_var',
			'type' => 'select',
            "options" => array('Standard', 'Small', 'Full width', 'Full width - Parallax', 'Full width Carousel', 'Video Parallax'),
			'std' => ''
		),	

		array(
			'name' => 'Hide Thumbnail (Standard)',
			'id' => $prefix . 'post_thumbnail',
			'type' => 'checkbox',
			'desc' => 'Check the box to hide the post thumbnail'
		),
		
		array(
			'name' => 'Show Video (Standard)',
			'id' => $prefix . 'post_video',
			'type' => 'checkbox',
			'desc' => 'Check the box to show video'
		),

		array(
			'name' => 'Youtube video',
			'desc' => 'Paste the video, only after the symbol "v =" (ex: http://www.youtube.com/watch?v=UJ1MOWg15Ec, UJ1MOWg15Ec - only this code)',
			'id' => $prefix . 'youtube',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => 'Vimeo video',
			'desc' => 'Insert the video id (ex: http://vimeo.com/76709460, 76709460 - ID)',
			'id' => $prefix . 'vimeo',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => 'Show Slider in post',
			'id' => $prefix . 'post_slider',
			'type' => 'checkbox',
			'desc' => 'Check the box to show Slider in single post'
		),
		
	    array(
			'name' => 'Slider image 1',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_1',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button1',
			'type' => 'button',
			'std' => 'Browse'
		),

	    array(
			'name' => 'Slider image 1 - Title',
			'desc' => 'Write Title for image 1',
			'id' => $prefix . 'title_slider_image_1',
			'type' => 'text',
			'std' => ''
		),		
	

	    array(
			'name' => 'Slider image 2',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_2',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button2',
			'type' => 'button',
			'std' => 'Browse'
		),
		
	    array(
			'name' => 'Slider image 2 - Title',
			'desc' => 'Write Title for image 2',
			'id' => $prefix . 'title_slider_image_2',
			'type' => 'text',
			'std' => ''
		),			


		array(
			'name' => 'Slider image 3',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_3',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button3',
			'type' => 'button',
			'std' => 'Browse'
		),
		
	    array(
			'name' => 'Slider image 3 - Title',
			'desc' => 'Write Title for image 3',
			'id' => $prefix . 'title_slider_image_3',
			'type' => 'text',
			'std' => ''
		),		
		
		array(
			'name' => 'Slider image 4',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_4',
			'type' => 'text',
			'std' => ''
		),

		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button4',
			'type' => 'button',
			'std' => 'Browse'
		),
		
	    array(
			'name' => 'Slider image 4 - Title',
			'desc' => 'Write Title for image 4',
			'id' => $prefix . 'title_slider_image_4',
			'type' => 'text',
			'std' => ''
		),		
		
		array(
			'name' => 'Slider image 5',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_5',
			'type' => 'text',
			'std' => ''
		),
	
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button5',
			'type' => 'button',
			'std' => 'Browse'
		),
		
	    array(
			'name' => 'Slider image 5 - Title',
			'desc' => 'Write Title for image 5',
			'id' => $prefix . 'title_slider_image_5',
			'type' => 'text',
			'std' => ''
		),		
	
		array(
			'name' => 'Slider image 6',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_6',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button6',
			'type' => 'button',
			'std' => 'Browse'
		),
				
	    array(
			'name' => 'Slider image 6 - Title',
			'desc' => 'Write Title for image 6',
			'id' => $prefix . 'title_slider_image_6',
			'type' => 'text',
			'std' => ''
		),	

		array(
			'name' => 'Slider image 7',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_7',
			'type' => 'text',
			'std' => ''
		),
				
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button7',
			'type' => 'button',
			'std' => 'Browse'
		),		
				
	    array(
			'name' => 'Slider image 7 - Title',
			'desc' => 'Write Title for image 7',
			'id' => $prefix . 'title_slider_image_7',
			'type' => 'text',
			'std' => ''
		),	
		
		array(
			'name' => 'Slider image 8',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_8',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button8',
			'type' => 'button',
			'std' => 'Browse'
		),	
			
	    array(
			'name' => 'Slider image 8 - Title',
			'desc' => 'Write Title for image 8',
			'id' => $prefix . 'title_slider_image_8',
			'type' => 'text',
			'std' => ''
		),	

		array(
			'name' => 'Slider image 9',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_9',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button9',
			'type' => 'button',
			'std' => 'Browse'
		),
				
	    array(
			'name' => 'Slider image 9 - Title',
			'desc' => 'Write Title for image 9',
			'id' => $prefix . 'title_slider_image_9',
			'type' => 'text',
			'std' => ''
		),	

		array(
			'name' => 'Slider image 10',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_10',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button10',
			'type' => 'button',
			'std' => 'Browse'
		),		
				
	    array(
			'name' => 'Slider image 10 - Title',
			'desc' => 'Write Title for image 10',
			'id' => $prefix . 'title_slider_image_10',
			'type' => 'text',
			'std' => ''
		),			
		
		
	    array(
			'name' => 'Slider image 11',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_11',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button11',
			'type' => 'button',
			'std' => 'Browse'
		),

	    array(
			'name' => 'Slider image11 - Title',
			'desc' => 'Write Title for image 11',
			'id' => $prefix . 'title_slider_image_11',
			'type' => 'text',
			'std' => ''
		),		
	

	    array(
			'name' => 'Slider image 12',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_12',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button12',
			'type' => 'button',
			'std' => 'Browse'
		),
		
	    array(
			'name' => 'Slider image 12 - Title',
			'desc' => 'Write Title for image 12',
			'id' => $prefix . 'title_slider_image_12',
			'type' => 'text',
			'std' => ''
		),			


		array(
			'name' => 'Slider image 13',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_13',
			'type' => 'text',
			'std' => ''
		),
		
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button13',
			'type' => 'button',
			'std' => 'Browse'
		),
		
	    array(
			'name' => 'Slider image 13 - Title',
			'desc' => 'Write Title for image 13',
			'id' => $prefix . 'title_slider_image_13',
			'type' => 'text',
			'std' => ''
		),		
		
		array(
			'name' => 'Slider image 14',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_14',
			'type' => 'text',
			'std' => ''
		),

		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button14',
			'type' => 'button',
			'std' => 'Browse'
		),
		
	    array(
			'name' => 'Slider image 14 - Title',
			'desc' => 'Write Title for image 14',
			'id' => $prefix . 'title_slider_image_14',
			'type' => 'text',
			'std' => ''
		),		
		
		array(
			'name' => 'Slider image 15',
			'desc' => 'Insert the full path to your image',
			'id' => $prefix . 'slider_image_15',
			'type' => 'text',
			'std' => ''
		),
	
		array(
			'name' => '',
			'desc' => 'Select an After Image',
			'id' => $prefix . 'upload_image_button15',
			'type' => 'button',
			'std' => 'Browse'
		),
		
	    array(
			'name' => 'Slider image 15 - Title',
			'desc' => 'Write Title for image 15',
			'id' => $prefix . 'title_slider_image_15',
			'type' => 'text',
			'std' => ''
		),	
	)
);


function my_editor_style_single() {

    global $current_screen;

    switch ($current_screen->post_type) {

    case 'post':

        break;

    case 'page':

        break;

    case 'acf': // CPT

        //echo '<script>alert("post");</script>';

        break;

    }

}

add_action( 'admin_head', 'my_editor_style_single' );

add_action('admin_menu', 'mytheme_add_box_single');

// Add meta box
function mytheme_add_box_single() {
	global $meta_box_single;
	
	add_meta_box($meta_box_single['id'], $meta_box_single['title'], 'mytheme_show_box_single', $meta_box_single['page'], $meta_box_single['context'], $meta_box_single['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box_single() {
	global $meta_box_single, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_single_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($meta_box_single['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" class="input_style" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:100%" />',
					'<br />', $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" class="input_style" id="', $field['id'], '" cols="60" rows="4" style="width:100%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<div class="on_off"><input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /></div>';
				break;
				
				case 'button':
				echo '<input type="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'mytheme_save_data_single');

// Save data from meta box
function mytheme_save_data_single($post_id) {
	global $meta_box_single;
	
	// verify nonce
	if ( !isset($_POST['mytheme_meta_box_single_nonce']) || !wp_verify_nonce( $_POST['mytheme_meta_box_single_nonce'], basename(__FILE__) )) {
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
	
	foreach ($meta_box_single['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

function single_options_styles() {  
   
wp_register_style( 'single_opt_style', BASE_URL . 'css/single_opt_style.css', null, false );
wp_enqueue_style('single_opt_style');
}
add_action( 'admin_enqueue_scripts', 'single_options_styles' ); 


 function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', get_bloginfo('template_url') . '/functions/my-script.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');

wp_register_script('post_image_uploader', BASE_URL . 'options/js/post_image_uploader.js');
wp_enqueue_script('post_image_uploader');

}

function my_admin_styles() {
wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');
?>