<?php

/*************************************************************************************
 *	Add MetaBox to Page edit page
 *************************************************************************************/

$om_page_meta_box=array (
	'sidebar' => array (
		'id' => 'om-post-meta-box-sidebar',
		'name' => __('Sidebar', 'om_theme'),
		'callback' => 'om_page_meta_box_sidebar',
		'fields' => array (
			array (
				'name' => __('Choose the sidebar','om_theme'),
				'desc' => '',
				'id' => OM_THEME_SHORT_PREFIX.'sidebar',
				'type' => 'sidebar',
				'std' => ''
			),
		),
	),
	
);
 
function om_add_page_meta_box() {
	global $om_page_meta_box;
	
	foreach($om_page_meta_box as $metabox) {
		add_meta_box(
			$metabox['id'],
			$metabox['name'],
			$metabox['callback'],
			'page',
			'normal',
			'high'
		);
	}
 
}
add_action('add_meta_boxes', 'om_add_page_meta_box');

/*************************************************************************************
 *	MetaBox Callbacks Functions
 *************************************************************************************/

function om_page_meta_box_sidebar() {
	global $om_page_meta_box;

	echo om_generate_page_meta_box($om_page_meta_box['sidebar']['fields']);
}

/*************************************************************************************
 *	MetaBox Generator
 *************************************************************************************/

function om_generate_page_meta_box($fields) {
	global $post;

	$output='';

	$output.= '<input type="hidden" name="om_page_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
 
	$output.= '<table class="form-table">';
 
	foreach ($fields as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
	
			case 'sidebar':
				$output.= '
					<tr>
						<th style="width:25%">
							<label for="'.$field['id'].'"><strong>'.$field['name'].'</strong>
							<div class="howto">'. $field['desc'].'</div>
						</th>
						<td>
							<select name="'.$field['id'].'" id="'.$field['id'].'"/><option value="">'.__('Main Sidebar','om_theme').'</option>
				';
				$sidebars_num=intval(get_option(OM_THEME_PREFIX."sidebars_num"));
				for($i=1;$i<=$sidebars_num;$i++)
				{
					$output.='<option value="'.$i.'" '.($meta==$i?' selected="selected"':'').'>'.__('Main Alternative Sidebar','om_theme').' '.$i.'</option>';
				}
				$output .='			
							</select>
						</td>
					</tr>
				';
			break;


		}

	}
	$output.= '</table>';
	
	return $output;
}

/*************************************************************************************
 *	Save MetaBox data
 *************************************************************************************/

function om_save_page_metabox($post_id) {
	global $om_page_meta_box;
 
	if (!isset($_POST['om_page_meta_box_nonce']) || !wp_verify_nonce($_POST['om_page_meta_box_nonce'], basename(__FILE__))) {
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
 
 	foreach ($om_page_meta_box as $metabox_key=>$metabox)
 	{
		foreach ($metabox['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
	 
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}

}
add_action('save_post', 'om_save_page_metabox');

