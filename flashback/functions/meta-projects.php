<?php

// Meta fields

$prefix = 'si_';

$project_meta = array(
	'id' => 'si-project-meta',
	'title' => __('Project Settings', 'shorti'),
	'page' => 'project',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  __('Custom home project url?', 'shorti'),
			'desc' => 'If url is defined, home project will link to the url instead of the single project page.',
			'id' => $prefix.'project_external',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' =>  __('Link to PrettyPhoto (lightbox)', 'shorti'),
			'desc' => 'Typing "yes" into this box will make the project popup a large preview instead of linking to the single project page.',
			'id' => $prefix.'project_popup',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' =>  __('Button url', 'shorti'),
			'desc' => 'URL for single project page button. (e.g. http://themeforest.net/)',
			'id' => $prefix.'project_url',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' =>  __('Project Image #2', 'shorti'),
			'desc' => '',
			'id' => $prefix.'project_img_two',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Project Image #3', 'shorti'),
			'desc' => '',
			'id' => $prefix.'project_img_three',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Project Image #4', 'shorti'),
			'desc' => '',
			'id' => $prefix.'project_img_four',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Project Image #5', 'shorti'),
			'desc' => '',
			'id' => $prefix.'project_img_five',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Project Image #6', 'shorti'),
			'desc' => '',
			'id' => $prefix.'project_img_six',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Background Image #1', 'shorti'),
			'desc' => 'If left blank, featured image will be used.',
			'id' => $prefix.'project_bg_one',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Background Image #2', 'shorti'),
			'desc' => 'If left blank, featured image will be used.',
			'id' => $prefix.'project_bg_two',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Background Image #3', 'shorti'),
			'desc' => 'If left blank, featured image will be used.',
			'id' => $prefix.'project_bg_three',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Background Image #4', 'shorti'),
			'desc' => 'If left blank, featured image will be used.',
			'id' => $prefix.'project_bg_four',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Background Image #5', 'shorti'),
			'desc' => 'If left blank, featured image will be used.',
			'id' => $prefix.'project_bg_five',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Video Embed', 'shorti'),
			'desc' => '',
			'id' => $prefix.'project_video',
			'type' => 'textarea',
			'std' => ''
		)
	),
	
);

add_action('admin_menu', 'si_add_box_project');


// Add to edit page
 
function si_add_box_project() {
	global $project_meta;
 	
	add_meta_box($project_meta['id'], $project_meta['title'], 'si_project_info', $project_meta['page'], $project_meta['context'], $project_meta['priority']);

}


// Callback function to show fields in meta box

function si_project_info() {
	global $project_meta, $post;
 	
	echo '<input type="hidden" name="si-project-meta_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
 
	echo '<table class="form-table">';
 
	foreach ($project_meta['fields'] as $field) {
	
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
			
			// select  
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'. $option['label'] .'</option>';
				
				} 
				
				echo'</select>';
			
			break;  
			
			// checkbox  
			case 'checkbox':
			
				echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
				  
			    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/> 
			        <label for="'.$field['id'].'">'.$field['desc'].'</label>';  
			break;  
			
			// button	
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
			
			// uploader 
			case 'uploader':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '_btn" id="', $field['id'], '_btn" value="Browse" />';
				echo 	'</td>';
			
			break;
			
			// editor
			case 'editor':
					echo wp_editor($meta, $field['name'], array('textarea_rows'=>10));
			break;

		}

	}
 
	echo '</table>';
}

add_action('save_post', 'si_save_data_project');

// Save data when post is edited
 	
function si_save_data_project($post_id) {

	global $project_meta;
	
	// verify nonce
	if ( !isset($_POST['si-project-meta_nonce']) || !wp_verify_nonce($_POST['si-project-meta_nonce'], basename(__FILE__))) {
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
	
	foreach ($project_meta['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}