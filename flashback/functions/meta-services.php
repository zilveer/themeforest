<?php

// Skill meta

$prefix = 'si_';

$service_meta = array(
	'id' => 'si-service-meta',
	'title' => __('Service Settings', 'shorti'),
	'page' => 'service',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  __('Icon', 'shorti'),
			'desc' => 'e.g. icon-wrench',
			'id' => $prefix.'service_icon',
			'type' => 'text',
			'std' => 'icon-wrench'
		),
	    array(
	        'name' =>  __('Button URL', 'shorti'),
			'desc' => __('e.g. www.google.com', 'shorti'),
	        'id' => $prefix.'service_button_url',
	        'type' => 'text',
	        'std' => ''
	    ),
	    array(
	        'name' =>  __('Button Text', 'shorti'),
			'desc' => __('', 'shorti'),
	        'id' => $prefix.'service_button_text',
	        'type' => 'text',
	        'std' => __('Get a quote', 'shorti')
	    ),
	    array(
	        'name' =>  __('Last Column?', 'shorti'),
			'desc' => __('Type "yes" if it is the last column of a row', 'shorti'),
	        'id' => $prefix.'service_last',
	        'type' => 'text',
	        'std' => ''
	    )
	),
	
);

add_action('admin_menu', 'si_add_box_service');


// ADD TO EDIT PAGE
 
function si_add_box_service() {
	global $service_meta;
 	
	add_meta_box($service_meta['id'], $service_meta['title'], 'si_service_info', $service_meta['page'], $service_meta['context'], $service_meta['priority']);

}


// CALLBACK FUNCTION TO SHOW FIELDS IN META BOX

function si_service_info() {
	global $service_meta, $post;
 	
	echo '<input type="hidden" name="si-service-meta_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($service_meta['fields'] as $field) {
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

		}

	}
 
	echo '</table>';
}

add_action('save_post', 'si_save_data_service');

// Save data when post is edited
 	
function si_save_data_service($post_id) {

	global $service_meta;
	
	// verify nonce
	if ( !isset($_POST['si-service-meta_nonce']) || !wp_verify_nonce($_POST['si-service-meta_nonce'], basename(__FILE__))) {
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
	
	foreach ($service_meta['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}