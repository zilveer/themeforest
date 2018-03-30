<?php

/*-----------------------------------------------------------------------------------

	Add image upload metaboxes to Portfolio items

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Define Metabox Fields
/*-----------------------------------------------------------------------------------*/

$prefix = 'dreamer_';


$meta_box_info = array(
	'id' => 'dreamer-meta-box-team-member-info',
	'title' => __('Additional Info', 'dreamer'),
	'page' => 'team',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	array(
			'name' =>  __('Team Member Position', 'dreamer'),
			'desc' => 'Team Member Position',
			'id' => $prefix.'team_member_position',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' =>  __('Facebook Link', 'dreamer'),
			'desc' => 'The link for the facebook profile.',
			'id' => $prefix.'facebook_link',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' =>  __('Twitter Link', 'dreamer'),
			'desc' => 'The link for the twitter profile',
			'id' => $prefix.'twitter_link',
			'type' => 'text',
			'std' => ''
		),
	array(
			'name' =>  __('Linkedin Link', 'dreamer'),
			'desc' => 'The link for the linkedin profile',
			'id' => $prefix.'linkedin_link',
			'type' => 'text',
			'std' => ''
		)
	),
	
);


add_action('admin_menu', 'dreamer_add_box_portfolio');


/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/
 
function dreamer_add_box_portfolio() {
	global $meta_box_info;
 	
	add_meta_box($meta_box_info['id'], $meta_box_info['title'], 'dreamer_show_box_team_member_info', $meta_box_info['page'], $meta_box_info['context'], $meta_box_info['priority']);

}


/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function dreamer_show_box_team_member_info() {
	global $meta_box_info, $post;
 	
	echo '<input type="hidden" name="dreamer_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_info['fields'] as $field) {
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
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
			
			break;

		}

	}
 
	echo '</table>';
}
 
add_action('save_post', 'dreamer_save_data_team_member');


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function dreamer_save_data_team_member($post_id) {
	global $meta_box_info;
 	

		// verify nonce
		if ( !isset($_POST['dreamer_meta_box_nonce']) || !wp_verify_nonce( $_POST['dreamer_meta_box_nonce'], basename(__FILE__) )) {
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
		
		foreach ($meta_box_info['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
	 
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}

}