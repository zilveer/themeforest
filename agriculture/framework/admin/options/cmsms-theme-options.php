<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Post, Page & Project Options Functions
 * Created by CMSMasters
 * 
 */


require_once(CMSMS_OPTIONS . '/cmsms-theme-options-general.php');
require_once(CMSMS_OPTIONS . '/cmsms-theme-options-post.php');
require_once(CMSMS_OPTIONS . '/cmsms-theme-options-page.php');
require_once(CMSMS_OPTIONS . '/cmsms-theme-options-project.php');
require_once(CMSMS_OPTIONS . '/cmsms-theme-options-testimonial.php');
require_once(CMSMS_OPTIONS . '/cmsms-theme-options-product.php');


global $custom_meta_fields, 
	$custom_post_meta_fields, 
	$custom_page_meta_fields, 
	$custom_project_meta_fields, 
	$custom_testimonial_meta_fields, 
	$custom_product_meta_fields;


if ( 
	(isset($_GET['post_type']) && $_GET['post_type'] == 'page') || 
	(isset($_POST['post_type']) && $_POST['post_type'] == 'page') || 
	(isset($_GET['post']) && get_post_type($_GET['post']) == 'page') 
) {
	$custom_all_meta_fields = array_merge($custom_page_meta_fields, $custom_meta_fields);
} elseif ( 
	(isset($_GET['post_type']) && $_GET['post_type'] == 'project') || 
	(isset($_POST['post_type']) && $_POST['post_type'] == 'project') || 
	(isset($_GET['post']) && get_post_type($_GET['post']) == 'project') 
) {
	$custom_all_meta_fields = array_merge($custom_project_meta_fields, $custom_meta_fields);
} elseif ( 
	(isset($_GET['post_type']) && $_GET['post_type'] == 'testimonial') || 
	(isset($_POST['post_type']) && $_POST['post_type'] == 'testimonial') || 
	(isset($_GET['post']) && get_post_type($_GET['post']) == 'testimonial') 
) {
	$custom_all_meta_fields = array_merge($custom_testimonial_meta_fields, $custom_meta_fields);
} elseif ( 
	(isset($_GET['post_type']) && $_GET['post_type'] == 'product') || 
	(isset($_POST['post_type']) && $_POST['post_type'] == 'product') || 
	(isset($_GET['post']) && get_post_type($_GET['post']) == 'product') 
) {
	$custom_all_meta_fields = array_merge($custom_product_meta_fields, $custom_meta_fields);
} elseif ( 
	(!isset($_GET['action']) && !isset($_GET['post_type'])) || 
	(!isset($_GET['action']) && isset($_GET['post_type']) && $_GET['post_type'] != 'testimonial') || 
	(isset($_POST['post_type']) && $_POST['post_type'] == 'post') || 
	(isset($_GET['post']) && get_post_type($_GET['post']) == 'post') 
) {
	$custom_all_meta_fields = array_merge($custom_post_meta_fields, $custom_meta_fields);
}


function cmsms_admin_enqueue_scripts($hook) {
	if ( 
		($hook == 'post.php') || 
		($hook == 'post-new.php') 
	) {
		wp_register_style('cmsms_theme_options_css', get_template_directory_uri() . '/framework/admin/options/css/cmsms-theme-options.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_style('cmsms_theme_options_css');
		
		
		wp_register_script('cmsms_theme_options_js', get_template_directory_uri() . '/framework/admin/options/js/cmsms-theme-options.js', array('jquery'), '1.0.0', true);
		wp_register_script('cmsms_theme_options_js_hide', get_template_directory_uri() . '/framework/admin/options/js/cmsms-theme-options-toggle.js', array('jquery'), '1.0.0', true);
		
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('cmsms_theme_options_js');
		wp_enqueue_script('cmsms_theme_options_js_hide');
	}
}

add_action('admin_enqueue_scripts', 'cmsms_admin_enqueue_scripts');


function show_cmsms_meta_box() {
	global $post, 
		$custom_all_meta_fields;
	
	
	$cmsms_option = cmsms_get_global_options();
	
	
	echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';
	
	foreach ($custom_all_meta_fields as $field) {
		$custom_fields = get_post_custom($post->ID);
		
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		if (!array_key_exists($field['id'], $custom_fields) && isset($field['std']) && $meta === '') {
			$meta = $field['std'];
		}
		
		if (!isset($field['hide'])) {
			$field['hide'] = 'false';
		}
		
		if ( 
			$field['type'] != 'tabs' && 
			$field['type'] != 'tab_start' && 
			$field['type'] != 'tab_finish' && 
			$field['type'] != 'content_start' && 
			$field['type'] != 'content_finish' 
		) {
			echo '<tr class="cmsms_tr_' . $field['type'] . '"' . (($field['hide'] == 'true') ? ' style="display:none;"' : '') . '>' . 
				'<th>' . 
					'<label for="' . $field['id'] . '">' . $field['label'] . '</label>' . '</th>' . 
				'<td>';
		}
		
		switch ($field['type']) {
		case 'tab_start':
			echo '<div id="' . $field['id'] . '" class="nav-tab-content' . (($field['std'] === 'true') ? ' nav-tab-content-active' : '') . '">' . 
				'<table class="form-table">';
			
			break;
		case 'tab_finish':
			echo '</table>' . 
			'</div>';
			
			break;
		case 'content_start':
			echo '<table id="' . $field['id'] . '" class="form-table' . (($field['box'] === 'true') ? ' cmsms_box' : '') . '"' . (($field['hide'] === 'true') ? ' style="display:none;"' : '') . '>';
			
			break;
		case 'content_finish':
			echo '</table>';
			
			break;
		case 'tabs':
			echo '<h4 class="nav-tab-wrapper" id="' . $field['id'] . '">';
			
			foreach ($field['options'] as $option) {
				echo '<a href="#' . $option['value'] . '" class="nav-tab' . (($field['std'] === $option['value']) ? ' nav-tab-active' : '') . '">' . $option['label'] . '</a>';
			}
			
			echo '</h4>';
			
			break;
		case 'text':
			echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" />' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'textcode':
			echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . htmlspecialchars(stripslashes($meta)) . '" size="30" />' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'text_long':
			echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="70" />' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'number':
			echo '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="5" />' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'textarea':
			echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" cols="50" rows="4">' . $meta . '</textarea>' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'checkbox':
			echo '<input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '" value="true"' . (($meta === 'false') ? '' : ' checked="checked"') . ' /> &nbsp; ' . 
			'<label for="' . $field['id'] . '">' . $field['desc'] . '</label>';
			
			break;
		case 'radio':
			foreach ($field['options'] as $option) {
				echo '<input type="radio" name="' . $field['id'] . '" id="' . $field['id'] . '_' . $option['value'] . '" value="' . $option['value'] . '"' . (($meta === $option['value']) ? ' checked="checked"' : '') . ' /> &nbsp; ' . 
				'<label for="' . $field['id'] . '_' . $option['value'] . '">' . $option['label'] . '</label>' . 
				'<br />';
			}
			
			echo '<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'radio_img':
			echo '<table>' . 
				'<tr>';
			
			$i = 0;
			
			foreach ($field['options'] as $option) {
				if ($i > 2) {
					echo '</tr><tr>';
					
					$i = 0;
				}
				
				echo '<td>' . 
					'<label for="' . $field['id'] . '_' . $option['value'] . '">' . 
						'<img src="' . $option['img'] . '" alt="' . $option['label'] . '" />' . 
						'<br />' . 
						'<input type="radio" name="' . $field['id'] . '" id="' . $field['id'] . '_' . $option['value'] . '" value="' . $option['value'] . '"' . (($meta === $option['value']) ? ' checked="checked"' : '') . ' />' . 
						$option['label'] . 
					'</label>' . 
				'</td>';
				
				$i++;
			}
			
			echo '</tr>' . 
			'</table>' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'radio_img_pj':
			echo '<table>' . 
				'<tr>';
			
			$i = 0;
			
			foreach ($field['options'] as $option) {
				if ($i > 2) {
					echo '</tr><tr>';
					
					$i = 0;
				}
				
				echo '<td>' . 
					'<label for="' . $field['id'] . '_' . $option['value'] . '">' . 
						'<img src="' . $option['img'] . '" alt="' . $option['label'] . '" />' . 
						'<br />' . 
						'<input type="radio" name="' . $field['id'] . '" id="' . $field['id'] . '_' . $option['value'] . '" value="' . $option['value'] . '" data-size="' . $option['size'] . '"' . (($meta === $option['value']) ? ' checked="checked"' : '') . ' />' . 
						$option['label'] . 
					'</label>' . 
				'</td>';
				
				if ($meta === $option['value']) {
					$pj_size = $option['size'];
				}
				
				$i++;
			}
			
			echo '</tr>' . 
			'</table>' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '<strong class="pj_size">' . $pj_size . '</strong></span>';
			
			break;
		case 'checkbox_group':
			$i = 0;
			
			foreach ($field['options'] as $option) {
				echo '<input type="checkbox" value="' . $option['value'] . '" name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '_' . $option['value'] . '"' . (($meta && in_array($option['value'], $meta)) ? ' checked="checked"' : '') . ' /> &nbsp; ' . 
				'<label for="' . $field['id'] . '_' . $option['value'] . '">' . $option['label'] . '</label>' . 
				'<br />';
				
				$i++;
			}
			
			echo '<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'select':
			echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
			
			foreach ($field['options'] as $option) {
				echo '<option value="' . $option['value'] . '"' . (($meta === $option['value']) ? ' selected="selected"' : '') . '>' . $option['label'] . ' &nbsp;</option>';
			}
			
			echo '</select>' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'select_sidebar':
			echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">' . 
				'<option value="">' . __('Default Sidebar', 'cmsmasters') . ' &nbsp;</option>';
			
			if (!empty($cmsms_option[CMSMS_SHORTNAME . '_sidebar'])) {
				foreach ($cmsms_option[CMSMS_SHORTNAME . '_sidebar'] as $sidebar_id => $sidebar_name) {
					echo '<option value="' . generateSlug($sidebar_name, 45) . '"' . (($meta !== '' && $meta === generateSlug($sidebar_name, 45)) ? ' selected="selected"' : '') . '>' . $sidebar_name . ' &nbsp;</option>';
				}
			}
			
			echo '</select>' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'select_slider':
			$sliderManager = new cmsmsSliderManager();
			
			$sliders = $sliderManager->getSliders();
			
			echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">' . 
				'<option value="">' . __('Select Slider', 'cmsmasters') . ' &nbsp;</option>';
			
			if (!empty($sliders)) {
				foreach ($sliders as $slider) {
					echo '<option value="' . $slider['id'] . '"' . (($meta !== '' && (int) $meta === $slider['id']) ? ' selected="selected"' : '') . '>' . $slider['name'] . ' &nbsp;</option>';
				}
			}
			
			echo '</select>' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'select_post_categ':
			$categories = get_categories();
			
			echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">' . 
				'<option value="">' . __('Select Blog Category', 'cmsmasters') . ' &nbsp;</option>';
			
			foreach ($categories as $category) {
				echo '<option value="' . $category->cat_ID . '"' . (($meta !== '' && $meta === $category->cat_ID) ? ' selected="selected"' : '') . '>' . $category->cat_name . ' &nbsp;</option>';
			}
			
			echo '</select>' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'select_project_type':
			$types = get_terms('pj-categs', array( 
				'orderby' => 'name', 
				'hide_empty' => 0 
			));
			
			echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">' . 
				'<option value="">' . __('Select Project Type', 'cmsmasters') . ' &nbsp;</option>';
			
			if (is_array($types) && !empty($types)) {
				foreach ($types as $type) {
					echo '<option value="' . $type->slug . '"' . (($meta !== '' && $meta === $type->slug) ? ' selected="selected"' : '') . '>' . $type->name . ' &nbsp;</option>';
				}
			}
			
			echo '</select>' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'select_tl_categ':
			$tl_categs = get_terms('tl-categs', array( 
				'hide_empty' => 0 
			));
			
			echo '<select name="' . $field['id'] . '" id="' . $field['id'] . '">' . 
				'<option value="">' . __('Select Testimonial Category', 'cmsmasters') . ' &nbsp;</option>';
			
			if (is_array($tl_categs) && !empty($tl_categs)) {
				foreach ($tl_categs as $tl_categ) {
					echo '<option value="' . $tl_categ->slug . '"' . (($meta !== '' && $meta === $tl_categ->slug) ? ' selected="selected"' : '') . '>' . $tl_categ->name . ' &nbsp;</option>';
				}
			}
			
			echo '</select>' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'image':
			$image = $field['std'];
			
			if (is_numeric($image)) {
				$image = wp_get_attachment_image_src($image, 'medium');
				
				$image = $image[0];
			}
			
			echo '<span class="custom_std_image" style="display:none">' . get_template_directory_uri() . '/framework/admin/inc/img/image.png</span>' . 
			'<span class="custom_default_image" style="display:none">' . (($field['std'] == '' && $image == '') ? get_template_directory_uri() . '/framework/admin/inc/img/image.png' : $image) . '</span>';
			
			if (is_numeric($meta)) {
				$image = wp_get_attachment_image_src($meta, 'medium');
				
				$image = $image[0];
			}
			
			echo '<input id="' . $field['id'] . '" name="' . $field['id'] . '" type="hidden" class="custom_upload_image" value="' . (($meta === 'false') ? '' : $meta) . '" />' . 
			'<img src="' . (($meta === 'false' || $image == '') ? get_template_directory_uri() . '/framework/admin/inc/img/image.png' : $image) . '" class="custom_preview_image" alt="" style="max-width:250px;" />' . 
			'<br />' . 
			'<input id="' . $field['id'] . '_image_button" class="cmsms_options_upload_image_button button" type="button" value="' . __('Choose Image', 'cmsmasters') . '" />' . 
			'<small>&nbsp; ' . 
				'<a href="#" class="custom_clear_image_button">' . (($field['cancel'] == 'true') ? __('Cancel', 'cmsmasters') : __('Default Image', 'cmsmasters')) . '</a>' . 
			'</small>' . 
			'<small>&nbsp; ' . 
				'<a href="#" class="custom_remove_image_button"> [x] ' . __('Remove', 'cmsmasters') . '</a>' . 
			'</small>' . 
			'<div style="clear:both;"></div>' . 
			'<br />' . 
			'<span class="description">' . $field['desc'] . '</span>' . 
			'<script type="text/javascript">' . 
				'jQuery(document).ready(function () { ' . 
					'(function ($) { ' . 
						"$('#" . $field['id'] . "_image_button').bind('click', function (e) { " . 
							'e.preventDefault(); ' . 
							'$(e.target).cmsmsMediaUploader( { ' . 
								"frameId : 'cmsms-" . $field['id'] . "-media-frame', " . 
								"frameClass : 'media-frame cmsms-media-frame cmsms-" . $field['id'] . "-media-frame', " . 
								"frameTitle : '" . __('Choose image', 'cmsmasters') . "', " . 
								"frameButton : '" . __('Choose', 'cmsmasters') . "', " . 
								'multiple : false ' . 
							'} ); ' . 
						'} ); ' . 
					'} )(jQuery); ' . 
				'} ); ' . 
			'</script>';
			
			break;
		case 'color':
			echo '<input type="text" id="' . $field['id'] . '" name="' . $field['id'] . '" value="' . $meta . '" class="my-color-field" data-default-color="' . $field['std'] . '" />' . 
			'<script type="text/javascript">' . 
				'jQuery(document).ready(function () { ' . 
					'(function ($) { ' . 
						"$('#" . $field['id'] . "').wpColorPicker(); " . 
					'} )(jQuery); ' . 
				'} ); ' . 
			'</script>';
			
			break;
		case 'icon':
			echo '<input type="hidden" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" />' . 
			'<ul class="cmsms_heading_icons_list">';
			
			if (!empty($cmsms_option[CMSMS_SHORTNAME . '_heading_icons'])) {
				foreach ($cmsms_option[CMSMS_SHORTNAME . '_heading_icons'] as $icon_numb => $icon_id) {
					$image = wp_get_attachment_image_src($icon_id, 'thumbnail');
					
					echo '<li id="cmsms_heading_icon_' . $icon_numb . '" class="cmsms_heading_icon ' . (($meta !== '' && $meta === $icon_id) ? ' selected' : '') . '">' . 
						'<a href="' . $icon_id . '">' . 
							'<img src="' . $image[0] . '" alt="" />' . 
						'</a>' . 
					'</li>';
				}
			} else {
				echo '<li>' . __('Add new heading icons', 'cmsmasters') . ' <a href="' . admin_url() . 'admin.php?page=cmsms-settings-icon&tab=heading">' . __('here', 'cmsmasters') . '</a>.</li>';
			}
			
			echo '</ul>' . 
			'<div style="clear:both;"></div>' . 
			'<a href="#" class="cmsms_heading_icons_cancel">' . __('Cancel', 'cmsmasters') . '</a>' . 
			'<div style="clear:both;"></div>' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'repeatable':
			echo '<ul id="' . $field['id'] . '-repeatable" class="custom_repeatable">';
			
			$i = 0;
			
			if ($meta) {
				foreach ($meta as $row) {
					if ($row !== '') {
						echo '<li>' . 
							'<span class="sort hndle">|||</span>' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '[' . $i . ']" value="' . $row . '" size="30" />' . 
							'<a class="repeatable-remove button" href="#">x</a>' . 
						'</li>';
					} else if ($i === 0) {
						echo '<li style="display:none;">' . 
							'<span class="sort hndle">|||</span>' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '[' . $i . ']" value="" size="30" />' . 
							'<a class="repeatable-remove button" href="#">x</a>' . 
						'</li>';
					}
					
					$i++;
				}
			} else {
				echo '<li style="display:none;">' . 
					'<span class="sort hndle">|||</span>' . 
					'<input type="text" name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '[' . $i . ']" value="" size="30" />' . 
					'<a class="repeatable-remove button" href="#">x</a>' . 
				'</li>';
			}
			
			echo '</ul>' . 
			'<a class="repeatable-add button" href="#">+</a>' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'repeatable_link':
			$post_items = get_posts(array( 
				'post_type'	=> 'post', 
				'posts_per_page' => -1 
			));
			
			$page_items = get_posts(array( 
				'post_type'	=> 'page', 
				'posts_per_page' => -1 
			));
			
			$project_items = get_posts(array( 
				'post_type'	=> 'project', 
				'posts_per_page' => -1 
			));
			
			echo '<div class="ovh">' . 
				'<div class="fl"><strong>' . __('Title', 'cmsmasters') . '</strong></div>' . 
				'<div class="fl"><strong>' . __('Link', 'cmsmasters') . '</strong></div>' . 
			'</div>' . 
			'<ul id="' . $field['id'] . '-repeatable" class="custom_repeatable">';
			
			$i = 0;
			
			if ($meta !== '') {
				foreach ($meta as $row) {
					if ($row[0] !== '' && $row[1] !== '') {
						echo '<li>' . 
							'<span class="sort hndle"></span>' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . '][0]" id="' . $field['id'] . '[' . $i . '][0]" value="' . $row[0] . '" size="10" class="cmsms_name" />' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . '][1]" id="' . $field['id'] . '[' . $i . '][1]" value="' . $row[1] . '" size="25" class="cmsms_link" />' . 
							'<a class="repeatable-remove button" href="#">x</a>' . 
						'</li>';
					} else if ($i === 0) {
						echo '<li style="display:none;">' . 
							'<span class="sort hndle"></span>' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . '][0]" id="' . $field['id'] . '[' . $i . '][0]" value="" size="10" class="cmsms_name" />' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . '][1]" id="' . $field['id'] . '[' . $i . '][1]" value="" size="25" class="cmsms_link" />' . 
							'<a class="repeatable-remove button" href="#">x</a>' . 
						'</li>';
					}
					
					$i++;
				}
			} else {
				echo '<li style="display:none;">' . 
					'<span class="sort hndle"></span>' . 
					'<input type="text" name="' . $field['id'] . '[' . $i . '][0]" id="' . $field['id'] . '[' . $i . '][0]" value="" size="10" class="cmsms_name" />' . 
					'<input type="text" name="' . $field['id'] . '[' . $i . '][1]" id="' . $field['id'] . '[' . $i . '][1]" value="" size="25" class="cmsms_link" />' . 
					'<a class="repeatable-remove button" href="#">x</a>' . 
				'</li>';
			}
			
			echo '</ul>' . 
			'<select name="' . $field['id'] . '-select" id="' . $field['id'] . '-select">' . 
				'<optgroup label="' . __('Blank Field', 'cmsmasters') . '">' . 
					'<option value="">' . __('Select Link', 'cmsmasters') . '</option>' . 
				'</optgroup>' . 
				'<optgroup label="' . __('Posts', 'cmsmasters') . '">';
			
			foreach ($post_items as $post_item) {
				echo '<option value="' . get_permalink($post_item->ID) . '">' . $post_item->post_title . '</option>';
			}
			
			echo '</optgroup>' . 
				'<optgroup label="' . __('Pages', 'cmsmasters') . '">';
			
			foreach ($page_items as $page_item) {
				echo '<option value="' . get_permalink($page_item->ID) . '">' . $page_item->post_title . '</option>';
			}
			
			echo '</optgroup>' . 
				'<optgroup label="' . __('Projects', 'cmsmasters') . '">';
			
			foreach ($project_items as $project_item) {
				echo '<option value="' . get_permalink($project_item->ID) . '">' . $project_item->post_title . '</option>';
			}
			
			echo '</optgroup>' . 
			'</select> &nbsp; ' . 
			'<a class="repeatable-link-add button" href="#">+</a>' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'repeatable_multiple':
			echo '<div class="ovh">' . 
				'<div class="fl"><strong>' . __('Title', 'cmsmasters') . '</strong></div>' . 
				'<div class="fl"><strong>' . __('Values', 'cmsmasters') . '</strong></div>' . 
			'</div>' . 
			'<ul id="' . $field['id'] . '-repeatable" class="custom_repeatable">';
			
			$i = 0;
			
			if ($meta !== '') {
				foreach ($meta as $row) {
					if ($row[0] !== '' && $row[1] !== '') {
						echo '<li>' . 
							'<span class="sort hndle"></span>' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . '][0]" id="' . $field['id'] . '[' . $i . '][0]" value="' . $row[0] . '" size="10" class="cmsms_name" />' . 
							'<textarea name="' . $field['id'] . '[' . $i . '][1]" id="' . $field['id'] . '[' . $i . '][1]" cols="25" rows="2" class="cmsms_val">' . $row[1] . '</textarea>' . 
							'<a class="repeatable-remove button" href="#">x</a>' . 
						'</li>';
					} else if ($i === 0) {
						echo '<li style="display:none;">' . 
							'<span class="sort hndle"></span>' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . '][0]" id="' . $field['id'] . '[' . $i . '][0]" value="" size="10" class="cmsms_name" />' . 
							'<textarea name="' . $field['id'] . '[' . $i . '][1]" id="' . $field['id'] . '[' . $i . '][1]" cols="25" rows="2" class="cmsms_val"></textarea>' . 
							'<a class="repeatable-remove button" href="#">x</a>' . 
						'</li>';
					}
					
					$i++;
				}
			} else {
				echo '<li style="display:none;">' . 
					'<span class="sort hndle"></span>' . 
					'<input type="text" name="' . $field['id'] . '[' . $i . '][0]" id="' . $field['id'] . '[' . $i . '][0]" value="" size="10" class="cmsms_name" />' . 
					'<textarea name="' . $field['id'] . '[' . $i . '][1]" id="' . $field['id'] . '[' . $i . '][1]" cols="25" rows="2" class="cmsms_val"></textarea>' . 
					'<a class="repeatable-remove button" href="#">x</a>' . 
				'</li>';
			}
			
			echo '</ul>' . 
			'<a class="repeatable-multiple-add button" href="#">+</a>' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'repeatable_media':
			echo '<select name="' . $field['id'] . '-select" id="' . $field['id'] . '-select">' . 
				'<option value="">' . __('Select Format', 'cmsmasters') . ' &nbsp;</option>';
			
			foreach ($field['media'] as $key => $value) {
				echo '<option value="' . $key . '">' . $value . '</option>';
			}
			
			echo '</select> &nbsp; ' . 
			'<a class="repeatable-media-add button" href="#">+</a>' . 
			'<br />' . 
			'<ul id="' . $field['id'] . '-repeatable" class="custom_repeatable">';
			
			$i = 0;
			
			if ($meta !== '') {
				foreach ($meta as $row) {
					if ($row[1] !== '') {
						echo '<li>' . 
							'<input type="text" readonly="readonly" name="' . $field['id'] . '[' . $i . '][0]" id="' . $field['id'] . '[' . $i . '][0]" value="' . $row[0] . '" size="5" class="cmsms_format" />' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . '][1]" id="' . $field['id'] . '[' . $i . '][1]" value="' . $row[1] . '" size="30" class="cmsms_link" />' . 
							'<a class="repeatable-remove button" href="#">x</a>' . 
						'</li>';
					} else if ($i === 0) {
						echo '<li style="display:none;">' . 
							'<input type="text" readonly="readonly" name="' . $field['id'] . '[' . $i . '][0]" id="' . $field['id'] . '[' . $i . '][0]" value="" size="5" class="cmsms_format" />' . 
							'<input type="text" name="' . $field['id'] . '[' . $i . '][1]" id="' . $field['id'] . '[' . $i . '][1]" value="" size="30" class="cmsms_link" />' . 
							'<a class="repeatable-remove button" href="#">x</a>' . 
						'</li>';
					}
					
					$i++;
				}
			} else {
				echo '<li style="display:none;">' . 
					'<input type="text" readonly="readonly" name="' . $field['id'] . '[' . $i . '][0]" id="' . $field['id'] . '[' . $i . '][0]" value="" size="5" class="cmsms_format" />' . 
					'<input type="text" name="' . $field['id'] . '[' . $i . '][1]" id="' . $field['id'] . '[' . $i . '][1]" value="" size="30" class="cmsms_link" />' . 
					'<a class="repeatable-remove button" href="#">x</a>' . 
				'</li>';
			}
			
			echo '</ul>' . 
			'<span class="description">' . $field['desc'] . '</span>';
			
			break;
		case 'images_list':
			if ($meta !== '') {
				$ids = array();
				$meta_array = explode(',', $meta);
				
				foreach ($meta_array as $meta_val) {
					$ids[] = str_replace('img_', '', $meta_val);
				}
			}
			
			echo '<a href="#" id="' . $field['id'] . '_images_button" class="button open_gallery_post_image_list">' . __('Choose images', 'cmsmasters') . '</a>' . 
			'<ul class="gallery_post_image_list selected_list">';
			
			if ($meta !== '') {
				foreach ($ids as $id) {
					$image = wp_get_attachment_image_src($id, 'thumbnail');
					
					echo '<li>' . 
						'<a href="' . $id . '" style="background-image:url(' . $image[0] . ');">' . 
							'<span></span>' . 
						'</a>' . 
					'</li>';
				}
			}
			
			echo '</ul>' . 
			'<input type="hidden" id="' . $field['id'] . '" name="' . $field['id'] . '" value="' . $meta . '" class="gallery_post_images" />' . 
			'<span class="description">' . $field['desc'] . '</span>' . 
			'<script type="text/javascript">' . 
				'(function ($) { ' . 
					"$(document.body).delegate('#" . $field['id'] . "_images_button', 'click', function (e) { " . 
						'e.preventDefault(); ' . 
						'$(e.target).cmsmsMediaUploader( { ' . 
							"frameId : 'cmsms-" . $field['id'] . "-media-frame', " . 
							"frameClass : 'media-frame cmsms-media-frame cmsms-" . $field['id'] . "-media-frame', " . 
							"frameTitle : '" . __('Choose images', 'cmsmasters') . "', " . 
							"frameButton : '" . __('Choose', 'cmsmasters') . "', " . 
							'multiple : true ' . 
						'} ); ' . 
					'} ); ' . 
				'} )(jQuery); ' . 
			'</script>';
			
			break;
		}
		
		if ( 
			$field['type'] != 'tabs' && 
			$field['type'] != 'tab_start' && 
			$field['type'] != 'tab_finish' && 
			$field['type'] != 'content_start' && 
			$field['type'] != 'content_finish' 
		) {
			echo '</td>' . 
			'</tr>';
		}
	}
}


function save_custom_meta($post_id) {
    global $custom_all_meta_fields;
	
	if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($custom_all_meta_fields as $field) {
		if ( 
			$field['type'] != 'tabs' && 
			$field['type'] != 'tab_start' && 
			$field['type'] != 'tab_finish' && 
			$field['type'] != 'content_start' && 
			$field['type'] != 'content_finish' 
		) {
			$old = get_post_meta($post_id, $field['id'], true);
			
			if (isset($_POST[$field['id']])) {
				$new = $_POST[$field['id']];
			} else {
				$new = '';
			}
			
			if ( 
				($field['type'] == 'checkbox' && $new === '') || 
				($field['type'] == 'image' && $new === '') 
			) {
				$new = 'false';
			}
			
			if (isset($new) && $new !== '' && $new !== $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif (isset($old) && $new === '') {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}
}

add_action('save_post', 'save_custom_meta');

