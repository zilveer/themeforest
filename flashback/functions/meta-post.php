<?php
 /*
 / Theme Meta
*/

$prefix = 'si_';

$video_meta = array(
	'id' => 'si-video-meta',
	'title' => __('Video Post Settings', 'shorti'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
		array(
			'name' =>  __('Video Embed', 'shorti'),
			'desc' => 'Embed code for video at 280px width by 210px height',
			'id' => $prefix.'video_embed',
			'type' => 'textarea',
			'std' => ''
		)
	),
	
);

$quote_meta = array(
	'id' => 'si-quote-meta',
	'title' => __('Quote Post Settings', 'shorti'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'low',
	'fields' => array(
		array(
			'name' =>  __('Quote Author', 'shorti'),
			'desc' => 'Author of quote',
			'id' => $prefix.'quote',
			'type' => 'text',
			'std' => ''
		)
	),
	
);

add_action('admin_menu', 'si_add_box_page');


// ADD TO EDIT PAGE
 
function si_add_box_page() {
	global $video_meta, $quote_meta;
 	
	add_meta_box($video_meta['id'], $video_meta['title'], 'si_video_info', $video_meta['page'], $video_meta['context'], $video_meta['priority']);
	add_meta_box($quote_meta['id'], $quote_meta['title'], 'si_quote_info', $quote_meta['page'], $quote_meta['context'], $quote_meta['priority']);

}


// CALLBACK FUNCTION TO SHOW FIELDS IN META BOX

function si_video_info() {
	global $video_meta, $post;
 	
	echo '<input type="hidden" name="si_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($video_meta['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			// text  
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			// textarea  
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;  

		}

	}
 
	echo '</table>';
}

function si_quote_info() {
	global $quote_meta, $post;
 	
	echo '<input type="hidden" name="si_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($quote_meta['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			// text  
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			// textarea  
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;  

		}

	}
 
	echo '</table>';
}

add_action('save_post', 'si_save_data_post');

// Save data when post is edited
 	
function si_save_data_post($post_id) {

	global $video_meta, $quote_meta;
	
	// verify nonce
	if ( !isset($_POST['si_meta_box_nonce']) || !wp_verify_nonce($_POST['si_meta_box_nonce'], basename(__FILE__))) {
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
	
	foreach ($video_meta['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
	foreach ($quote_meta['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}