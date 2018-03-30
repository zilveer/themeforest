<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Visual Content Composer
 * Created by CMSMasters
 * 
 */


function cmsms_composer_enqueue_scripts($hook) {
	if ( 
		$hook == 'post-new.php' || 
		($hook == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
	) {
		wp_register_style('cmsms_content_composer_css', get_template_directory_uri() . '/framework/admin/composer/css/cmsms-content-composer.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_style('cmsms_content_composer_css');
		
		
		wp_enqueue_script('jquery-ui-draggable');
		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_script('jquery-ui-sortable');
		
		
		wp_register_script('cmsms_content_composer_js', get_template_directory_uri() . '/framework/admin/composer/js/cmsms-content-composer.js', array('jquery'), '1.0.0', true);
		wp_register_script('cmsms_content_composer_uploader_js', get_template_directory_uri() . '/framework/admin/composer/js/cmsms-content-composer-uploader.js', array('jquery'), '1.0.0', true);
		
		wp_enqueue_script('cmsms_content_composer_js');
		wp_enqueue_script('cmsms_content_composer_uploader_js');
	}
}

add_action('admin_enqueue_scripts', 'cmsms_composer_enqueue_scripts');



function show_cmsms_composer_meta_box() {
	global $post;
	
	
	$admin_post_object = $post;
	
	
	$meta = get_post_meta($post->ID, 'cmsms_content_composer_text', true);
	
	
	$option_query = new WP_Query(array( 
		'orderby' => 'ID', 
		'order' => 'ASC', 
		'post_type' => 'content_template', 
		'posts_per_page' => -1 
	));
	
	
	echo '<input type="hidden" name="custom_composer_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />' . 
	'<div class="cmsms_composer_container">' . 
		'<div class="cmsms_composer_buttons_container">' . 
			'<div class="cmsms_composer_templates_container_wrap">' . 
				'<a href="#" id="cmsms_clear_content" class="button">' . __('Clear Composer Content', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_pattern_save" class="button">' . __('Add New Template', 'cmsmasters') . '</a>' . 
				'<select name="cmsms_pattern_list" id="cmsms_pattern_list">' . 
					'<option value="">' . __('Select Composer Template...', 'cmsmasters') . '</option>';
				
				
				if ($option_query->have_posts()) : 
					while ($option_query->have_posts() ) : $option_query->the_post();
						echo '<option value="cmsms_template_' . get_the_ID() . '">' . get_the_title() . '</option>';
					endwhile;
				endif;
				
				
				echo '</select>' . 
				'<a href="#" id="cmsms_pattern_load" class="button">' . __('Insert Selected Template', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_pattern_delete" class="button">' . __('Delete Selected Template', 'cmsmasters') . '</a>' . 
			'</div>' . 
			'<div class="cmsms_composer_buttons_container_wrap1">' . 
				'<a href="#" id="cmsms_composer_column16" class="button cmsms_composer_buttons one_sixth" title="' . __('Column', 'cmsmasters') . '" data-width="one_sixth" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column15" class="button cmsms_composer_buttons one_fifth" title="' . __('Column', 'cmsmasters') . '" data-width="one_fifth" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column14" class="button cmsms_composer_buttons one_fourth" title="' . __('Column', 'cmsmasters') . '" data-width="one_fourth" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column13" class="button cmsms_composer_buttons one_third" title="' . __('Column', 'cmsmasters') . '" data-width="one_third" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column25" class="button cmsms_composer_buttons two_fifth" title="' . __('Column', 'cmsmasters') . '" data-width="two_fifth" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column12" class="button cmsms_composer_buttons one_half" title="' . __('Column', 'cmsmasters') . '" data-width="one_half" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column35" class="button cmsms_composer_buttons three_fifth" title="' . __('Column', 'cmsmasters') . '" data-width="three_fifth" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column23" class="button cmsms_composer_buttons two_third" title="' . __('Column', 'cmsmasters') . '" data-width="two_third" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column34" class="button cmsms_composer_buttons three_fourth" title="' . __('Column', 'cmsmasters') . '" data-width="three_fourth" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column45" class="button cmsms_composer_buttons four_fifth" title="' . __('Column', 'cmsmasters') . '" data-width="four_fifth" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column56" class="button cmsms_composer_buttons five_sixth" title="' . __('Column', 'cmsmasters') . '" data-width="five_sixth" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_column11" class="button cmsms_composer_buttons one_first" title="' . __('Column', 'cmsmasters') . '" data-width="one_first" data-folder="column" data-type="">' . __('Column', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_divider1" class="button cmsms_composer_buttons one_first" title="' . __('Divider', 'cmsmasters') . '" data-width="one_first" data-folder="divider" data-type="divider">' . __('Divider', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_clear1" class="button cmsms_composer_buttons one_first" title="' . __('Clear', 'cmsmasters') . '" data-width="one_first" data-folder="divider" data-type="clear">' . __('Clear', 'cmsmasters') . '</a>' . 
			'</div>' . 
			'<div class="cmsms_composer_buttons_container_wrap2">' . 
				'<a href="#" id="cmsms_composer_text" class="button cmsms_composer_buttons one_first" title="' . __('Content Block', 'cmsmasters') . '" data-width="one_first" data-folder="text" data-type="">' . __('Content Block', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_box" class="button cmsms_composer_buttons one_first" title="' . __('Information Box', 'cmsmasters') . '" data-width="one_first" data-folder="box" data-type="box">' . __('Information Box', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_block" class="button cmsms_composer_buttons one_first" title="' . __('Featured Block', 'cmsmasters') . '" data-width="one_first" data-folder="box" data-type="block">' . __('Featured Block', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_color" class="button cmsms_composer_buttons one_first" title="' . __('Colored Block', 'cmsmasters') . '" data-width="one_first" data-folder="box" data-type="color">' . __('Colored Block', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_person" class="button cmsms_composer_buttons one_first" title="' . __('Person Block', 'cmsmasters') . '" data-width="one_first" data-folder="person" data-type="">' . __('Person Block', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_tab" class="button cmsms_composer_buttons one_first" title="' . __('Tabs', 'cmsmasters') . '" data-width="one_first" data-folder="tab" data-type="tab">' . __('Tabs', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_toggle" class="button cmsms_composer_buttons one_first" title="' . __('Toggles', 'cmsmasters') . '" data-width="one_first" data-folder="tab" data-type="toggle">' . __('Toggles', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_tour" class="button cmsms_composer_buttons one_first" title="' . __('Tour', 'cmsmasters') . '" data-width="one_first" data-folder="tab" data-type="tour">' . __('Tour', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_price" class="button cmsms_composer_buttons one_first" title="' . __('Pricing Table', 'cmsmasters') . '" data-width="one_first" data-folder="price" data-type="">' . __('Pricing Table', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_stat" class="button cmsms_composer_buttons one_first" title="' . __('Stats', 'cmsmasters') . '" data-width="one_first" data-folder="stat" data-type="">' . __('Stats', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_video_embed" class="button cmsms_composer_buttons one_first" title="' . __('Embedded Video', 'cmsmasters') . '" data-width="one_first" data-folder="video" data-type="embed">' . __('Embedded Video', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_video_html5" class="button cmsms_composer_buttons one_first" title="' . __('HTML5 Video', 'cmsmasters') . '" data-width="one_first" data-folder="video" data-type="html5">' . __('HTML5 Video', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_video_single" class="button cmsms_composer_buttons one_first" title="' . __('Single Video Player', 'cmsmasters') . '" data-width="one_first" data-folder="video" data-type="single">' . __('Single Video Player', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_video_multi" class="button cmsms_composer_buttons one_first" title="' . __('Multiple Video Player', 'cmsmasters') . '" data-width="one_first" data-folder="video" data-type="multiple">' . __('Multiple Video Player', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_audio_html5" class="button cmsms_composer_buttons one_first" title="' . __('HTML5 Audio', 'cmsmasters') . '" data-width="one_first" data-folder="audio" data-type="html5">' . __('HTML5 Audio', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_audio_single" class="button cmsms_composer_buttons one_first" title="' . __('Single Audio Player', 'cmsmasters') . '" data-width="one_first" data-folder="audio" data-type="single">' . __('Single Audio Player', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_audio_multi" class="button cmsms_composer_buttons one_first" title="' . __('Multiple Audio Player', 'cmsmasters') . '" data-width="one_first" data-folder="audio" data-type="multiple">' . __('Multiple Audio Player', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_post" class="button cmsms_composer_buttons one_first" title="' . __('Post Types', 'cmsmasters') . '" data-width="one_first" data-folder="post" data-type="">' . __('Post Types', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_slider" class="button cmsms_composer_buttons one_first" title="' . __('Content Slider', 'cmsmasters') . '" data-width="one_first" data-folder="slider" data-type="">' . __('Content Slider', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_clients" class="button cmsms_composer_buttons one_first" title="' . __('Clients Slider', 'cmsmasters') . '" data-width="one_first" data-folder="clients" data-type="">' . __('Clients Slider', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_map" class="button cmsms_composer_buttons one_first" title="' . __('Google Map', 'cmsmasters') . '" data-width="one_first" data-folder="map" data-type="">' . __('Google Map', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_email" class="button cmsms_composer_buttons one_first" title="' . __('Contact Form', 'cmsmasters') . '" data-width="one_first" data-folder="email" data-type="">' . __('Contact Form', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_divider2" class="button cmsms_composer_buttons one_first" title="' . __('Divider', 'cmsmasters') . '" data-width="one_first" data-folder="divider" data-type="divider">' . __('Divider', 'cmsmasters') . '</a>' . 
				'<a href="#" id="cmsms_composer_clear2" class="button cmsms_composer_buttons one_first" title="' . __('Clear', 'cmsmasters') . '" data-width="one_first" data-folder="divider" data-type="clear">' . __('Clear', 'cmsmasters') . '</a>' . 
			'</div>' . 
			'<div style="clear:both;"></div>' . 
		'</div>' . 
		'<div id="cmsms_composer_content" class="cmsms_composer_content deactivated">' . urldecode($meta) . '</div>' . 
		'<textarea name="cmsms_content_composer_text" id="cmsms_content_composer_text" cols="100" rows="10">' . $meta . '</textarea>' . 
		'<div id="cmsms_composer_message_saved" class="cmsms_updated">' . 
			'<p>' . __('Visual composer template was saved successfully.', 'cmsmasters') . '</p>' . 
		'</div>' . 
		'<div id="cmsms_composer_message_added" class="cmsms_updated">' . 
			'<p>' . __('Visual composer template was added successfully.', 'cmsmasters') . '</p>' . 
		'</div>' . 
		'<div id="cmsms_composer_message_deleted" class="cmsms_error">' . 
			'<p>' . __('Visual composer template was deleted successfully.', 'cmsmasters') . '</p>' . 
		'</div>' . 
		'<input type="hidden" id="cmsms_composer_url" name="cmsms_composer_url" value="' . get_template_directory_uri() . '" />' . 
		'<input type="hidden" id="cmsms_composer_plus_text" name="cmsms_composer_plus_text" value="' . __('Wider', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_composer_minus_text" name="cmsms_composer_minus_text" value="' . __('Narrower', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_composer_delete_text" name="cmsms_composer_delete_text" value="' . __('Delete', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_composer_edit_text" name="cmsms_composer_edit_text" value="' . __('Edit', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_composer_copy_text" name="cmsms_composer_copy_text" value="' . __('Copy', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_composer_check_column_text" name="cmsms_composer_check_column_text" value="' . __('Align Column Right', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_composer_check_divider_text" name="cmsms_composer_check_divider_text" value="' . __('Show Divider Line', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_composer_shortcode_text" name="cmsms_composer_shortcode_text" value="' . __('Shortcode', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_composer_del_question" name="cmsms_composer_del_question" value="' . __("Do you really want delete this element?\nAll data from this element will be lost!", 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_composer_clear_question" name="cmsms_composer_clear_question" value="' . __("Do you really want to remove all composer content?\nAll data will be lost!", 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_template_save_question" name="cmsms_template_save_question" value="' . __('Enter the name for your template.', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_template_save_alert" name="cmsms_template_save_alert" value="' . __('Error! Enter valid name.', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_template_list_alert" name="cmsms_template_list_alert" value="' . __('Error! Select content template.', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_template_del_question" name="cmsms_template_del_question" value="' . __("Do you really want delete this template?\nAll data from this template will be lost!", 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_slider_title" name="cmsms_slider_title" value="' . __('Choose slider images', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_slider_button" name="cmsms_slider_button" value="' . __('Choose', 'cmsmasters') . '" />' . 
		'<input type="hidden" id="cmsms_person_title" name="cmsms_person_title" value="' . __('Choose person block images', 'cmsmasters') . '" />' . 
	'</div>';
	
	
	wp_reset_query();
	
	
	$post = $admin_post_object;
}


function add_custom_composer_meta_box() {
	add_meta_box( 
		'cmsms_composer_meta_box', 
		__('Visual Content Composer', 'cmsmasters'), 
		'show_cmsms_composer_meta_box', 
		'', 
		'normal', 
		'high' 
	);
}



function save_custom_composer_meta($post_id) {
	if (!isset($_POST['custom_composer_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_composer_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
	
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	
	
	if ($_POST['post_type'] == 'page') {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	
	$old = get_post_meta($post_id, 'cmsms_content_composer_text', true);
	
	
	if (isset($_POST['cmsms_content_composer_text'])) {
		$new = $_POST['cmsms_content_composer_text'];
	} else {
		$new = '';
	}
	
	
	if (isset($new) && $new !== $old) {
		update_post_meta($post_id, 'cmsms_content_composer_text', $new);
	} elseif (isset($old) && $new === '') {
		delete_post_meta($post_id, 'cmsms_content_composer_text', $old);
	}
}



if ( 
	(isset($_GET['post_type']) && $_GET['post_type'] == 'page') || 
	(isset($_POST['post_type']) && $_POST['post_type'] == 'page') || 
	(isset($_GET['post']) && get_post_type($_GET['post']) == 'page') || 
	(isset($_GET['post_type']) && $_GET['post_type'] == 'project') || 
	(isset($_POST['post_type']) && $_POST['post_type'] == 'project') || 
	(isset($_GET['post']) && get_post_type($_GET['post']) == 'project') || 
	(!isset($_GET['action']) && !isset($_GET['post_type'])) || 
	(!isset($_GET['action']) && isset($_GET['post_type']) && $_GET['post_type'] != 'testimonial' && $_GET['post_type'] != 'product') || 
	(isset($_POST['post_type']) && $_POST['post_type'] == 'post') || 
	(isset($_GET['post']) && get_post_type($_GET['post']) == 'post') 
) {
	add_action('add_meta_boxes', 'add_custom_composer_meta_box');
	
	
	add_action('save_post', 'save_custom_composer_meta');
}

