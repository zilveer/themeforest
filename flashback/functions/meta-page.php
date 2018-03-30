<?php
 /*
 / Page Meta
*/

$prefix = 'si_';

$page_meta = array(
	'id' => 'si-page-meta',
	'title' => __('Page Settings', 'shorti'),
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
		array(
	        'name' =>  __('Hide Page Title?', 'shorti'),
			'desc' => 'Type "yes" to hide page title.',
			'id' => $prefix.'page_title',
			'type' => 'text',
			'std' => ''
	    ),
	    array(
	        'name' =>  __('Page Icon', 'shorti'),
			'desc' => 'Optional icon next to page title. (e.g. icon-arrow-right)',
			'id' => $prefix.'page_icon',
			'type' => 'text',
			'std' => ''
	    ),
		array(
			'name' => __('Background Image', 'shorti'),
			'desc' => 'Optional custom background image.',
			'id' => $prefix.'page_bg',
			'type' => 'uploader',
			'std' => ''
		),
		array(
			'name' =>  __('Secondary Textbox', 'shorti'),
			'desc' => 'Optional content aside from main content (only some pages)',
			'id' => $prefix.'page_second',
			'type' => 'textarea',
			'std' => ''
		)
		
	),
	
);

$page_meta_portfolio = array(
	'id' => 'si-page-meta-portfolio',
	'title' => __('Portfolio Settings', 'shorti'),
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
		array(
			'name' =>  __('Category ID', 'shorti'),
			'desc' => 'Only applies to pages with the Portfolio template selected.',
			'id' => $prefix.'page_project_id',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' =>  __('Category Slug', 'shorti'),
			'desc' => 'Only applies to pages with the Portfolio template selected.',
			'id' => $prefix.'page_project_slug',
			'type' => 'text',
			'std' => ''
		)
		
	),
	
);

$page_meta_services = array(
	'id' => 'si-page-meta-services',
	'title' => __('Service Settings', 'shorti'),
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
		array(
			'name' =>  __('Category Slug', 'shorti'),
			'desc' => 'Only applies to pages with the Service template selected.',
			'id' => $prefix.'page_service_slug',
			'type' => 'text',
			'std' => ''
		)
		
	),
	
);

add_action('admin_menu', 'si_add_box_post');


// ADD TO EDIT PAGE
 
function si_add_box_post() {
	global $page_meta, $page_meta_portfolio, $page_meta_services;
 	
	add_meta_box($page_meta['id'], $page_meta['title'], 'si_page_info', $page_meta['page'], $page_meta['context'], $page_meta['priority']);
	add_meta_box($page_meta_portfolio['id'], $page_meta_portfolio['title'], 'si_page_portfolio', $page_meta_portfolio['page'], $page_meta_portfolio['context'], $page_meta_portfolio['priority']);
	add_meta_box($page_meta_services['id'], $page_meta_services['title'], 'si_page_services', $page_meta_services['page'], $page_meta_services['context'], $page_meta_services['priority']);

}


// CALLBACK FUNCTION TO SHOW FIELDS IN META BOX

function si_page_info() {
	global $page_meta, $post;
 	
	echo '<input type="hidden" name="si_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($page_meta['fields'] as $field) {
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

function si_page_portfolio() {
	global $page_meta_portfolio, $post;
 	
	echo '<input type="hidden" name="si_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($page_meta_portfolio['fields'] as $field) {
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

		}

	}
 
	echo '</table>';
}

function si_page_services() {
	global $page_meta_services, $post;
 	
	echo '<input type="hidden" name="si_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($page_meta_services['fields'] as $field) {
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

		}

	}
 
	echo '</table>';
}

// Save data when post is edited
 	
function si_save_data_page($post_id) {

	global $page_meta, $page_meta_portfolio, $page_meta_services;
	
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
	
	foreach ($page_meta['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
	foreach ($page_meta_portfolio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
	foreach ($page_meta_services['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}
add_action('save_post', 'si_save_data_page');