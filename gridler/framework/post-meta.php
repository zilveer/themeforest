<?php

/*-----------------------------------------------------------------------------------

	Add Post Format meta boxes

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Define Metabox Fields
/*-----------------------------------------------------------------------------------*/


$meta_box_quote = array(
	'id' => 'theme-meta-box-quote',
	'title' =>  __('Quote Settings', 'framework'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('The Quote','framework'),
				"desc" => __('Write your quote in this field.','framework'),
				"id" => 'theme_quote',
				"type" => "textarea"
			),
	),
	
	
);

$meta_box_link = array(
	'id' => 'theme-meta-box-link',
	'title' =>  __('Link Settings', 'framework'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('The URL','framework'),
				"desc" => __('Insert the URL you wish to link to.','framework'),
				"id" => 'theme_link_url',
				"type" => "text"
			),
	),
	
);


$meta_box_audio = array(
	'id' => 'theme-meta-box-audio',
	'title' =>  __('Audio Settings', 'framework'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('MP3 File URL','framework'),
				"desc" => __('The URL to the .mp3 audio file','framework'),
				"id" => 'theme_audio_mp3',
				"type" => "text"
			),
		array( "name" => __('OGA File URL','framework'),
				"desc" => __('The URL to the .oga, .ogg audio file','framework'),
				"id" => 'theme_audio_ogg',
				"type" => "text"
			)
	),
	
	
);

$meta_box_video = array(
	'id' => 'theme-meta-box-video',
	'title' => 'Video Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	array(
			'name' => 'Youtube or Vimeo URL',
			'desc' => __('Enter in the page URL here.', 'framework'),
			'id' => 'theme_video_url',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => 'Video Height (Thumb)',
			'desc' => __('Please enter the video height for the video thumbnail. 300 = (300px).', 'framework'),
			'id' => 'theme_video_height_thumb',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => 'Video Height',
			'desc' => __('Please enter the video height. 300 = (300px).', 'framework'),
			'id' => 'theme_video_height',
			'type' => 'text',
			'std' => ''
		),
	array( "name" => __('M4V File URL','framework'),
				"desc" => __('The URL to the .m4v video file','framework'),
				"id" => 'theme_video_m4v',
				"type" => "text"
			),
	array( "name" => __('OGV File URL','framework'),
				"desc" => __('The URL to the .ogv video file','framework'),
				"id" => 'theme_video_ogv',
				"type" => "text"
			),
	array( "name" => __('Video Poster','framework'),
				"desc" => __('The preview image','framework'),
				"id" => 'theme_video_poster',
				"type" => "text"
			)
	),
	
);

$meta_box_video_portfolio = array(
	'id' => 'theme-meta-box-video-portfolio',
	'title' => 'Video Settings',
	'page' => 'theme_portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	array(
			'name' => 'Youtube or Vimeo URL',
			'desc' => __('Enter in the page URL here.', 'framework'),
			'id' => 'theme_video_url_portfolio',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => 'Video Height (Thumb)',
			'desc' => __('Please enter the video height for the video thumbnail. 300 = (300px).', 'framework'),
			'id' => 'theme_video_height_thumb_portfolio',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' => 'Video Height',
			'desc' => __('Please enter the video height. 300 = (300px).', 'framework'),
			'id' => 'theme_video_height_portfolio',
			'type' => 'text',
			'std' => ''
		),
	array( "name" => __('M4V File URL','framework'),
				"desc" => __('The URL to the .m4v video file','framework'),
				"id" => 'theme_video_m4v_portfolio',
				"type" => "text"
			),
	array( "name" => __('OGV File URL','framework'),
				"desc" => __('The URL to the .ogv video file','framework'),
				"id" => 'theme_video_ogv_portfolio',
				"type" => "text"
			),
	array( "name" => __('Video Poster','framework'),
				"desc" => __('The preview image','framework'),
				"id" => 'theme_video_poster_portfolio',
				"type" => "text"
			)
	),
	
);


add_action('admin_menu', 'theme_add_box');


/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/
 
function theme_add_box() {
	global $meta_box_quote, $meta_box_link, $meta_box_audio, $meta_box_video, $meta_box_video_portfolio;
 
	add_meta_box($meta_box_quote['id'], $meta_box_quote['title'], 'theme_show_box_quote', $meta_box_quote['page'], $meta_box_quote['context'], $meta_box_quote['priority']);
	add_meta_box($meta_box_link['id'], $meta_box_link['title'], 'theme_show_box_link', $meta_box_link['page'], $meta_box_link['context'], $meta_box_link['priority']);
	add_meta_box($meta_box_audio['id'], $meta_box_audio['title'], 'theme_show_box_audio', $meta_box_audio['page'], $meta_box_audio['context'], $meta_box_audio['priority']);
	add_meta_box($meta_box_video['id'], $meta_box_video['title'], 'theme_show_box_video', $meta_box_video['page'], $meta_box_video['context'], $meta_box_video['priority']);
	add_meta_box($meta_box_video_portfolio['id'], $meta_box_video_portfolio['title'], 'theme_show_box_video_portfolio', $meta_box_video_portfolio['page'], $meta_box_video_portfolio['context'], $meta_box_video_portfolio['priority']);
}


/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function theme_show_box_quote() {
	global $meta_box_quote, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="theme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_quote['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If textarea		
			case 'textarea':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;

		}

	}
 
	echo '</table>';
}

function theme_show_box_link() {
	global $meta_box_link, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="theme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_link['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;

		}

	}
 
	echo '</table>';
}

function theme_show_box_audio() {
	global $meta_box_audio, $post;
	
	echo '<p style="padding:10px 0 0 0;">'.__('An MP3 must be supplied but for total cross browser support please supply an OGG file.', 'framework').'</p>';

	// Use nonce for verification
	echo '<input type="hidden" name="theme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_audio['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			//If Text		
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
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

function theme_show_box_video() {
	global $meta_box_video, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('These settings enable you to embed videos into your posts.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="theme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
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

function theme_show_box_video_portfolio() {
	global $meta_box_video_portfolio, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('These settings enable you to embed videos into your portfolio pages.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="theme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_video_portfolio['fields'] as $field) {
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

add_action('save_post', 'theme_save_data');

/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function theme_save_data($post_id) {
	global $meta_box_quote, $meta_box_link, $meta_box_audio, $meta_box_video, $meta_box_video_portfolio;
 
	// verify nonce
	if (!wp_verify_nonce($_POST['theme_meta_box_nonce'], basename(__FILE__))) {
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
 
	foreach ($meta_box_quote['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
	foreach ($meta_box_link['fields'] as $field) {
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
			update_post_meta($post_id, $field['id'],stripslashes(htmlspecialchars($new)));
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
	
	foreach ($meta_box_video_portfolio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	

}

