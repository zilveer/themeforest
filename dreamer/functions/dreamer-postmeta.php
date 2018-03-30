<?php

/*-----------------------------------------------------------------------------------

	Add Post Format meta boxes

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Define Metabox Fields
/*-----------------------------------------------------------------------------------*/

$prefix = 'hex_';


$meta_box_video = array(
	'id' => 'dreamer-meta-box-video',
	'title' =>  __('Video Settings', 'dreamer'),
	'page' => 'post',
	'context' => 'normal',
	'std' => '1',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Embeded Code','dreamer'),
				"desc" => __('If you\'re not using self hosted video then you can include embeded code here. Best viewed at 360px wide.','dreamer'),
				"id" => $prefix."video_embed",
				"type" => "textarea"
			)
	)
	
	
);


$meta_box_audio = array(
	'id' => 'dreamer-meta-box-audio',
	'title' =>  __('Audio Settings', 'dreamer'),
	'page' => 'post',
	'context' => 'normal',
	'std' => '1',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Embeded Code','dreamer'),
				"desc" => __('If you\'re not using self hosted video then you can include embeded code here. Best viewed at 360px wide.','dreamer'),
				"id" => $prefix."audio_embed",
				"type" => "textarea"
			)
	),
	
	
);




add_action('admin_menu', 'theme_add_box');


/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/
 
function theme_add_box() {
	global $meta_box_video, $meta_box_audio;
 
	
	add_meta_box($meta_box_video['id'], $meta_box_video['title'], 'theme_show_box_video', $meta_box_video['page'], $meta_box_video['context'], $meta_box_video['priority']);

	add_meta_box($meta_box_audio['id'], $meta_box_audio['title'], 'theme_show_box_audio', $meta_box_audio['page'], $meta_box_audio['context'], $meta_box_audio['priority']);
}


/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/


function theme_show_box_video() {
	global $meta_box_video, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="dreamernal_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_video['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;

		}

	}
 
	echo '</table>';
}




function theme_show_box_audio() {
	global $meta_box_audio, $post;

	echo '<p style="padding:10px 0 0 0;">'.__('Note that for audio, you must supply both MP3 and OGG files to satisfy all browsers.', 'dreamer').'</p>';

	// Use nonce for verification
	echo '<input type="hidden" name="dreamer_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_audio['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			//If Text		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;

		}

	}
 
	echo '</table>';
}
 
add_action('save_post', 'theme_save_data');


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function theme_save_data($post_id) {
	global $meta_box_video, $meta_box_audio;
 
	// verify nonce
	if ( !isset($_POST['dreamernal_meta_box_nonce']) || !wp_verify_nonce( $_POST['dreamernal_meta_box_nonce'], basename(__FILE__) )) {
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

	
	foreach ($meta_box_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}




	foreach ($meta_box_audio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}
