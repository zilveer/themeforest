<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Admin Panel Main Functions
 * Created by CMSMasters
 * 
 */


add_action('admin_menu', 'cmsms_add_menu');
add_action('admin_init', 'cmsms_register_settings');


define('CMSMS_PAGE_BASENAME', 'cmsms-settings');


require_once(CMSMS_SETTINGS . '/inc/cmsms-helper-functions.php');
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings-general.php');
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings-style.php');
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings-logo.php');
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings-font.php');
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings-icon.php');
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings-blog.php');
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings-portfolio.php');
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings-testimonial.php');


function cmsms_get_settings() {
	$output = array();
	
	$page = cmsms_get_admin_page();
	$tab = cmsms_get_the_tab();
	
	switch ($page) {
	case CMSMS_PAGE_BASENAME:
		$cmsms_option_name = 'cmsms_options_' . CMSMS_SHORTNAME;
		$cmsms_settings_page_title = __('Theme General Settings', 'cmsmasters');	
		$cmsms_page_sections = cmsms_options_general_sections();
		$cmsms_page_fields = cmsms_options_general_fields();
		$cmsms_page_tabs = cmsms_options_general_tabs();
		
		switch ($tab) {
		case 'general':
			$cmsms_option_name = $cmsms_option_name . '_general';
			
			break;
		case 'sidebar':
			$cmsms_option_name = $cmsms_option_name . '_sidebar';
			
			break;
		case 'sitemap':
			$cmsms_option_name = $cmsms_option_name . '_sitemap';
			
			break;
		case 'archive':
			$cmsms_option_name = $cmsms_option_name . '_archive';
			
			break;
		case 'search':
			$cmsms_option_name = $cmsms_option_name . '_search';
			
			break;
		case 'error':
			$cmsms_option_name = $cmsms_option_name . '_error';
			
			break;
		case 'seo':
			$cmsms_option_name = $cmsms_option_name . '_seo';
			
			break;
		case 'code':
			$cmsms_option_name = $cmsms_option_name . '_code';
			
			break;
		case 'recaptcha':
			$cmsms_option_name = $cmsms_option_name . '_recaptcha';
			
			break;
		}
		
		break;
	case CMSMS_PAGE_BASENAME . '-style':
		$cmsms_option_name = 'cmsms_options_' . CMSMS_SHORTNAME . '_style';
		$cmsms_settings_page_title = __('Theme Appearance', 'cmsmasters');
		$cmsms_page_sections = cmsms_options_style_sections();
		$cmsms_page_fields = cmsms_options_style_fields();
		$cmsms_page_tabs = cmsms_options_style_tabs();
		
		switch ($tab) {
		case 'bg':
			$cmsms_option_name = $cmsms_option_name . '_bg';
			
			break;
		case 'header':
			$cmsms_option_name = $cmsms_option_name . '_header';
			
			break;
		case 'content':
			$cmsms_option_name = $cmsms_option_name . '_content';
			
			break;
		case 'footer':
			$cmsms_option_name = $cmsms_option_name . '_footer';
			
			break;
		}
		
		break;
	case CMSMS_PAGE_BASENAME . '-logo':
		$cmsms_option_name = 'cmsms_options_' . CMSMS_SHORTNAME . '_logo';
		$cmsms_settings_page_title = __('Theme Logo Settings', 'cmsmasters');
		$cmsms_page_sections = cmsms_options_logo_sections();
		$cmsms_page_fields = cmsms_options_logo_fields();
		$cmsms_page_tabs = cmsms_options_logo_tabs();
		
		switch ($tab) {
		case 'image':
			$cmsms_option_name = $cmsms_option_name . '_image';
			
			break;
		case 'text':
			$cmsms_option_name = $cmsms_option_name . '_text';
			
			break;
		case 'favicon':
			$cmsms_option_name = $cmsms_option_name . '_favicon';
			
			break;
		}
		
		break;
	case CMSMS_PAGE_BASENAME . '-font':
		$cmsms_option_name = 'cmsms_options_' . CMSMS_SHORTNAME . '_font';
		$cmsms_settings_page_title = __('Theme Fonts Settings', 'cmsmasters');
		$cmsms_page_sections = cmsms_options_font_sections();
		$cmsms_page_fields = cmsms_options_font_fields();
		$cmsms_page_tabs = cmsms_options_font_tabs();
		
		switch ($tab) {
		case 'content':
			$cmsms_option_name = $cmsms_option_name . '_content';
			
			break;
		case 'link':
			$cmsms_option_name = $cmsms_option_name . '_link';
			
			break;
		case 'nav':
			$cmsms_option_name = $cmsms_option_name . '_nav';
			
			break;
		case 'h1':
			$cmsms_option_name = $cmsms_option_name . '_h1';
			
			break;
		case 'h2':
			$cmsms_option_name = $cmsms_option_name . '_h2';
			
			break;
		case 'h3':
			$cmsms_option_name = $cmsms_option_name . '_h3';
			
			break;
		case 'h4':
			$cmsms_option_name = $cmsms_option_name . '_h4';
			
			break;
		case 'h5':
			$cmsms_option_name = $cmsms_option_name . '_h5';
			
			break;
		case 'h6':
			$cmsms_option_name = $cmsms_option_name . '_h6';
			
			break;
		case 'other':
			$cmsms_option_name = $cmsms_option_name . '_other';
			
			break;
		}
		
		break;
	case CMSMS_PAGE_BASENAME . '-icon':
		$cmsms_option_name = 'cmsms_options_' . CMSMS_SHORTNAME . '_icon';
		$cmsms_settings_page_title = __('Theme Icons Settings', 'cmsmasters');
		$cmsms_page_sections = cmsms_options_icon_sections();
		$cmsms_page_fields = cmsms_options_icon_fields();
		$cmsms_page_tabs = cmsms_options_icon_tabs();
		
		switch ($tab) {
		case 'heading':
			$cmsms_option_name = $cmsms_option_name . '_heading';
			
			break;
		case 'social':
			$cmsms_option_name = $cmsms_option_name . '_social';
			
			break;
		}
		
		break;
	case CMSMS_PAGE_BASENAME . '-blog':
		$cmsms_option_name = 'cmsms_options_' . CMSMS_SHORTNAME . '_blog';
		$cmsms_settings_page_title = __('Theme Blog Settings', 'cmsmasters');
		$cmsms_page_sections = cmsms_options_blog_sections();
		$cmsms_page_fields = cmsms_options_blog_fields();
		$cmsms_page_tabs = cmsms_options_blog_tabs();
		
		switch ($tab) {
		case 'page':
			$cmsms_option_name = $cmsms_option_name . '_page';
			
			break;
		case 'post':
			$cmsms_option_name = $cmsms_option_name . '_post';
			
			break;
		}
		
		break;
	case CMSMS_PAGE_BASENAME . '-portfolio':
		$cmsms_option_name = 'cmsms_options_' . CMSMS_SHORTNAME . '_portfolio';
		$cmsms_settings_page_title = __('Theme Portfolio Settings', 'cmsmasters');
		$cmsms_page_sections = cmsms_options_portfolio_sections();
		$cmsms_page_fields = cmsms_options_portfolio_fields();
		$cmsms_page_tabs = cmsms_options_portfolio_tabs();
		
		switch ($tab) {
		case 'full':
			$cmsms_option_name = $cmsms_option_name . '_full';
			
			break;
		case 'project':
			$cmsms_option_name = $cmsms_option_name . '_project';
			
			break;
		}
		
		break;
	case CMSMS_PAGE_BASENAME . '-testimonial':
		$cmsms_option_name = 'cmsms_options_' . CMSMS_SHORTNAME . '_testimonial';
		$cmsms_settings_page_title = __('Theme Testimonials Settings', 'cmsmasters');
		$cmsms_page_sections = cmsms_options_testimonial_sections();
		$cmsms_page_fields = cmsms_options_testimonial_fields();
		$cmsms_page_tabs = cmsms_options_testimonial_tabs();
		
		switch ($tab) {
		case 't_page':
			$cmsms_option_name = $cmsms_option_name . '_t_page';
			
			break;
		case 't_post':
			$cmsms_option_name = $cmsms_option_name . '_t_post';
			
			break;
		}
		
		break;
	default:
		$cmsms_option_name = '';
		$cmsms_settings_page_title = '';
		$cmsms_page_tabs = '';
		$cmsms_page_sections = '';
		$cmsms_page_fields = '';
		
		break;
	}
	
	$output['cmsms_option_name'] = $cmsms_option_name;
	$output['cmsms_page_title'] = $cmsms_settings_page_title;
	$output['cmsms_page_tabs'] = $cmsms_page_tabs;
	$output['cmsms_page_sections'] = $cmsms_page_sections;
	$output['cmsms_page_fields'] = $cmsms_page_fields;
	
	return $output;
}


function cmsms_create_settings_field($args = array()) {
	$defaults = array( 
		'id' => 'default_field', 
		'title' => __('Default Field', 'cmsmasters'), 
		'desc' => __('This is a default description.', 'cmsmasters'), 
		'std' => '', 
		'type' => 'text', 
		'section' => 'main_section', 
		'choices' => array(), 
		'class' => '' 
	);
	
	extract(wp_parse_args($args, $defaults));
	
	$field_args = array( 
		'type' => $type, 
		'id' => $id, 
		'desc' => $desc, 
		'std' => $std, 
		'choices' => $choices, 
		'label_for' => $id, 
		'class' => $class 
	);
	
	add_settings_field( 
		$id, 
		$title, 
		'cmsms_form_field_fn', 
		__FILE__, 
		$section, 
		$field_args 
	);
}


function cmsms_register_settings() {
	$settings_output = cmsms_get_settings();
	$cmsms_option_name = $settings_output['cmsms_option_name'];
	
	register_setting($cmsms_option_name, $cmsms_option_name, 'cmsms_validate_options');
	
	if (!empty($settings_output['cmsms_page_sections'])) {
		foreach ($settings_output['cmsms_page_sections'] as $id => $title) {
			add_settings_section($id, $title, 'cmsms_section_fn', __FILE__);
		}
	}
	
	if (!empty($settings_output['cmsms_page_fields'])) {
		foreach ($settings_output['cmsms_page_fields'] as $option) {
			cmsms_create_settings_field($option);
		}
	}
}


function cmsms_settings_scripts() {
	wp_register_style('cmsms_theme_settings_css', get_template_directory_uri() . '/framework/admin/settings/css/cmsms-theme-settings.css', array(), '1.0.0', 'screen');
	
	wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('cmsms_theme_settings_css');
	
	
	wp_register_script('cmsms_theme_settings_js', get_template_directory_uri() . '/framework/admin/settings/js/cmsms-theme-settings.js', array('jquery', 'farbtastic'), '1.0.0', true);
	wp_register_script('cmsms_theme_settings_js_toggle', get_template_directory_uri() . '/framework/admin/settings/js/cmsms-theme-settings-toggle.js', array('jquery'), '1.0.0', true);
	
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('cmsms_theme_settings_js');
    wp_enqueue_script('cmsms_theme_settings_js_toggle');
	
	
	wp_enqueue_media();
}


function cmsms_add_menu() {
	$settings_output = cmsms_get_settings();
	
	add_menu_page( 
		__('Theme Settings', 'cmsmasters'), 
		__('Theme Settings', 'cmsmasters'), 
		'manage_options', 
		CMSMS_PAGE_BASENAME, 
		'cmsms_settings_page_fn', 
		'', 
		115 
	); 
	
	
	$cmsms_settings_general = add_submenu_page( 
		CMSMS_PAGE_BASENAME, 
		__('Theme General Settings', 'cmsmasters'), 
		__('General', 'cmsmasters'), 
		'manage_options', 
		CMSMS_PAGE_BASENAME, 
		'cmsms_settings_page_fn' 
	);
	
	add_action('load-' . $cmsms_settings_general, 'cmsms_settings_scripts');
	
	
	$cmsms_settings_style = add_submenu_page( 
		CMSMS_PAGE_BASENAME, 
		__('Theme Appearance', 'cmsmasters'), 
		__('Appearance', 'cmsmasters'), 
		'manage_options', 
		CMSMS_PAGE_BASENAME . '-style', 
		'cmsms_settings_page_fn' 
	);
	
	add_action('load-' . $cmsms_settings_style, 'cmsms_settings_scripts');
	
	
	$cmsms_settings_logo = add_submenu_page( 
		CMSMS_PAGE_BASENAME, 
		__('Theme Logo Settings', 'cmsmasters'), 
		__('Logo', 'cmsmasters'), 
		'manage_options', 
		CMSMS_PAGE_BASENAME . '-logo', 
		'cmsms_settings_page_fn' 
	);
	
	add_action('load-' . $cmsms_settings_logo, 'cmsms_settings_scripts');
	
	
	$cmsms_settings_font = add_submenu_page( 
		CMSMS_PAGE_BASENAME, 
		__('Theme Fonts Settings', 'cmsmasters'), 
		__('Fonts', 'cmsmasters'), 
		'manage_options', 
		CMSMS_PAGE_BASENAME . '-font', 
		'cmsms_settings_page_fn' 
	);
	
	add_action('load-' . $cmsms_settings_font, 'cmsms_settings_scripts');
	
	
	$cmsms_settings_icon = add_submenu_page( 
		CMSMS_PAGE_BASENAME, 
		__('Theme Icons Settings', 'cmsmasters'), 
		__('Icons', 'cmsmasters'), 
		'manage_options', 
		CMSMS_PAGE_BASENAME . '-icon', 
		'cmsms_settings_page_fn' 
	);
	
	add_action('load-' . $cmsms_settings_icon, 'cmsms_settings_scripts');
	
	
	$cmsms_settings_blog = add_submenu_page( 
		CMSMS_PAGE_BASENAME, 
		__('Theme Blog Settings', 'cmsmasters'), 
		__('Blog', 'cmsmasters'), 
		'manage_options', 
		CMSMS_PAGE_BASENAME . '-blog', 
		'cmsms_settings_page_fn' 
	);
	
	add_action('load-' . $cmsms_settings_blog, 'cmsms_settings_scripts');
	
	
	$cmsms_settings_portfolio = add_submenu_page( 
		CMSMS_PAGE_BASENAME, 
		__('Theme Portfolio Settings', 'cmsmasters'), 
		__('Portfolio', 'cmsmasters'), 
		'manage_options', 
		CMSMS_PAGE_BASENAME . '-portfolio', 
		'cmsms_settings_page_fn' 
	);
	
	add_action('load-' . $cmsms_settings_portfolio, 'cmsms_settings_scripts');
	
	
	$cmsms_settings_testimonial = add_submenu_page( 
		CMSMS_PAGE_BASENAME, 
		__('Theme Testimonials Settings', 'cmsmasters'), 
		__('Testimonials', 'cmsmasters'), 
		'manage_options', 
		CMSMS_PAGE_BASENAME . '-testimonial', 
		'cmsms_settings_page_fn' 
	);
	
	add_action('load-' . $cmsms_settings_testimonial, 'cmsms_settings_scripts');
}


function cmsms_section_fn($desc) {
	$tab = cmsms_get_the_tab();
	
	switch ($tab) {
	default:
		break;
	}
}


function cmsms_form_field_fn($args = array()) {

	$cmsms_option = cmsms_get_global_options();

	extract($args);
	
	$settings_output = cmsms_get_settings();
	
	$cmsms_option_name = $settings_output['cmsms_option_name'];
	
	$options = get_option($cmsms_option_name);
	
	if (!isset($options[$id])) {
		$options[$id] = $std;
	}
	
	$field_class = ($class != '') ? ' ' . $class : '';
	
	switch ($type) {
	case 'text':
		$options[$id] = esc_attr(stripslashes($options[$id]));
		
		echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="' . $cmsms_option_name . '[' . $id . ']" value="' . $options[$id] . '" />' . 
		(($desc != '') ? '<br />' . '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'multi-text':
		foreach ($choices as $item) {
			$item = explode('|', $item);
			$item[0] = esc_html($item[0]);
			
			if (!empty($options[$id])) {
				foreach ($options[$id] as $option_key => $option_val) {
					if ($item[1] == $option_key) {
						$value = $option_val;
					}
				}
			} else {
				$value = '';
			}
			
			echo '<span>' . $item[0] . ':</span> ' . 
			'<input class="' . $field_class . '" type="text" id="' . $id . '|' . $item[1] . '" name="' . $cmsms_option_name . '[' . $id . '|' . $item[1] . ']" value="' . $value . '" />' . 
			'<br />';
		}
		
		echo (($desc != '') ? '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'textarea':
		$options[$id] = esc_html(stripslashes($options[$id]));
		
		echo '<textarea class="textarea' . $field_class . '" type="text" id="' . $id . '" name="' . $cmsms_option_name . '[' . $id . ']" rows="5" cols="30">' . $options[$id] . '</textarea>' . 
		(($desc != '') ? '<br />' . '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'select':
		echo '<select id="' . $id . '" class="select' . $field_class . '" name="' . $cmsms_option_name . '[' . $id . ']">';
		
		foreach ($choices as $item) {
			$item = explode('|', $item);
			$item[0] = esc_html($item[0]);
			
			$selected = ($options[$id] == $item[1]) ? ' selected="selected"' : '';
			
			echo '<option value="' . $item[1] . '"' . $selected . '>' . $item[0] . '</option>';
		}
		
		echo '</select>' . 
		(($desc != '') ? '<br />' . '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'select_sidebar':
		echo '<select id="' . $id . '" class="select' . $field_class . '" name="' . $cmsms_option_name . '[' . $id . ']">' . 
			'<option value="">' . __('None', 'cmsmasters') . ' &nbsp;</option>' . 
			'<option value="default"' . (($options[$id] !== '' && $options[$id] === 'default') ? ' selected="selected"' : '') . '>' . __('Default Sidebar', 'cmsmasters') . ' &nbsp;</option>';
		
		foreach ($cmsms_option[CMSMS_SHORTNAME . '_sidebar'] as $sidebar_id => $sidebar_name) {
			echo '<option value="' . generateSlug($sidebar_name, 45) . '"' . (($options[$id] !== '' && $options[$id] === generateSlug($sidebar_name, 45)) ? ' selected="selected"' : '') . '>' . $sidebar_name . ' &nbsp;</option>';
		}
		
		echo '</select>' . 
		'<br />' . 
		(($desc != '') ? '<br />' . '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'checkbox':
		echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="' . $cmsms_option_name . '[' . $id . ']" value="1" ' . checked($options[$id], 1, false) . ' /> &nbsp;' . 
		(($desc != '') ? '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'multi-checkbox':
		foreach ($choices as $item) {
			$item = explode('|', $item);
			$item[0] = esc_html($item[0]);
			$checked = '';
			
			if (isset($options[$id][$item[1]]) && $options[$id][$item[1]] == 'true') {
				$checked = ' checked="checked"';
			}
			
			echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '|' . $item[1] . '" name="' . $cmsms_option_name . '[' . $id . '|' . $item[1] . ']" value="1"' . $checked . ' /> &nbsp;' . 
			'<label for="' . $id . '|' . $item[1] . '">' . $item[0] . '</label>' . 
			'<br />';
		}
		
		echo (($desc != '') ? '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'number':
		$options[$id] = esc_attr(stripslashes($options[$id]));
		
		echo '<input class="small-text' . $field_class . '" type="number" id="' . $id . '" name="' . $cmsms_option_name . '[' . $id . ']" value="' . $options[$id] . '" />' . 
		(($desc != '') ? ' &nbsp; ' . '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'radio':
		foreach ($choices as $item) {
			$item = explode('|', $item);
			$item[0] = esc_html($item[0]);
			
			echo '<input class="radio' . $field_class . '" type="radio" id="' . $id . '|' . $item[1] . '" name="' . $cmsms_option_name . '[' . $id . ']" value="' . $item[1] . '" ' . checked($options[$id], $item[1], false) . ' /> &nbsp;' . 
			'<label for="' . $id . '|' . $item[1] . '">' . $item[0] . '</label>' . 
			'<br />';
		}
		
		echo (($desc != '') ? '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'radio_img':
		foreach ($choices as $item) {
			$item = explode('|', $item);
			$item[0] = esc_html($item[0]);
			
			echo '<div style="text-align:center; float:left; margin-right:20px;">' . 
				'<input class="radio' . $field_class . '" type="radio" id="' . $id . '|' . $item[2] . '" name="' . $cmsms_option_name . '[' . $id . ']" value="' . $item[2] . '" ' . checked($options[$id], $item[2], false) . ' />' . 
				'<br />' . 
				'<label for="' . $id . '|' . $item[2] . '">' . 
					'<img src="' . $item[1] . '" alt="' . $item[0] . '" title="' . $item[0] . '" />' . 
					'<br />' . 
					$item[0] . 
				'</label>' . 
			'</div>';
		}
		
		echo (($desc != '') ? '<div style="clear:both;"></div>' . '<br />' . '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'color':
		$options[$id] = esc_attr(stripslashes($options[$id]));
		
		echo '<input type="text" id="' . $id . '" name="' . $cmsms_option_name . '[' . $id . ']" value="' . $options[$id] . '" class="my-color-field" data-default-color="' . $std . '" />' . 
		'<br />' . 
		'<span class="description">' . 
			(($desc != '') ? $desc . '<br />' : '') . 
		'</span>' . 
		'<script type="text/javascript">' . 
			'jQuery(document).ready(function () { ' . 
				'(function ($) { ' . 
					"$('#" . $id . "').wpColorPicker(); " . 
				'} )(jQuery); ' . 
			'} ); ' . 
		'</script>';
		
		break;
	case 'upload':
		$options[$id] = esc_attr(stripslashes($options[$id]));
		
		$image = $std;
		
		echo '<span id="' . $id . '_std" class="custom_std_image" style="display:none;">' . get_template_directory_uri() . '/framework/admin/inc/img/image.png</span>' . 
		'<span id="' . $id . '_default" class="custom_default_image" style="display:none;">' . (($std == '' && $image == '') ? get_template_directory_uri() . '/framework/admin/inc/img/image.png' : $image) . '</span>';
		
		if ( 
			isset($options[$id]) && 
			$options[$id] != '' && 
			$options[$id] != $std 
		) {
			if (is_numeric($options[$id])) {
				$image = wp_get_attachment_image_src($options[$id], 'medium');
				
				$image = $image[0];
			} else {
				$image = $options[$id];
			}
		}
		
		echo '<input id="' . $id . '" name="' . $cmsms_option_name . '[' . $id . ']" type="hidden" class="custom_upload_image" value="' . ((isset($options[$id]) && $options[$id] != $std) ? $options[$id] : $std) . '" />' . 
		'<img src="' . ((isset($options[$id]) && $options[$id] != '') ? $image : get_template_directory_uri() . '/framework/admin/inc/img/image.png') . '" id="' . $id . '_preview" class="custom_preview_image" alt="" />' . 
		'<br />' . 
		'<input id="' . $id . '_button" class="custom_upload_image_button button" type="button" value="' . __('Choose Image', 'cmsmasters') . '" />' . 
		' &nbsp; &nbsp; ' . 
		'<small>' . 
			'<a href="#" id="' . $id . '_clear" class="custom_clear_image_button">' . __('Default Image', 'cmsmasters') . '</a>' . 
		'</small>' . 
		'<small>&nbsp; ' . 
			'<a href="#" id="' . $id . '_remove" class="custom_remove_image_button"> [x] ' . __('Remove', 'cmsmasters') . '</a>' . 
		'</small>' . 
		'<div style="clear:both;"></div>' . 
		(($desc != '') ? '<br />' . '<span class="description">' . $desc . '</span>' : '') . 
		'<script type="text/javascript">' . 
			'jQuery(document).ready(function () { ' . 
				'(function ($) { ' . 
					"$('#" . $id . "_button').bind('click', function (e) { " . 
						'e.preventDefault(); ' . 
						'$(e.target).cmsmsMediaUploader( { ' . 
							"frameId : 'cmsms-" . $id . "-media-frame', " . 
							"frameClass : 'media-frame cmsms-media-frame cmsms-" . $id . "-media-frame', " . 
							"frameTitle : '" . __('Choose image', 'cmsmasters') . "', " . 
							"frameButton : '" . __('Choose', 'cmsmasters') . "', " . 
							'multiple : false ' . 
						'} ); ' . 
					'} ); ' . 
				'} )(jQuery); ' . 
			'} ); ' . 
		'</script>';
		
		break;
	case 'typorgaphy':
		$system_font = (in_array('system_font', $choices)) ? true : false;
		$google_font = (in_array('google_font', $choices)) ? true : false;
		$font_color = (in_array('font_color', $choices)) ? true : false;
		$font_size = (in_array('font_size', $choices)) ? true : false;
		$line_height = (in_array('line_height', $choices)) ? true : false;
		$font_weight = (in_array('font_weight', $choices)) ? true : false;
		$font_style = (in_array('font_style', $choices)) ? true : false;
		
		if ($system_font) {
			echo '<div class="cmsms_admin_block">' . 
				'<select class="select" id="' . $id . '_system_font" name="' . $cmsms_option_name . '[' . $id . '_system_font]">';
				
				foreach (cmsms_system_fonts_list() as $key => $value) {
					echo '<option value="' . $key . '"' . (($options[$id . '_system_font'] == $key) ? ' selected="selected"' : '') . '>' . $value .'</option>';
				}
				
				echo '</select>' . 
				' &nbsp; ' . 
				'<label for="' . $id . '_system_font">' . __('System Font', 'cmsmasters') . '</label>' . 
			'</div>';
		}
		
		if ($google_font) {
			echo '<div class="cmsms_admin_block">' . 
				'<select class="select" id="' . $id . '_google_font" name="' . $cmsms_option_name . '[' . $id . '_google_font]">';
				
				foreach (cmsms_google_fonts_list() as $key => $value) {
					echo '<option value="' . $key . '"' . (($options[$id . '_google_font'] == $key) ? ' selected="selected"' : '') . '>' . $value .'</option>';
				}
				
				echo '</select>' . 
				' &nbsp; ' . 
				'<label for="' . $id . '_google_font">' . __('Google Font', 'cmsmasters') . '</label>' . 
			'</div>';
		}
		
		if ($font_color) {
			echo '<div class="cmsms_admin_block" style="padding-bottom:20px;">' . 
				'<input type="text" id="' . $id . '_font_color" name="' . $cmsms_option_name . '[' . $id . '_font_color]" value="' . $options[$id . '_font_color'] . '" class="my-color-field" data-default-color="' . $std['font_color'] . '" />' . 
				' &nbsp; ' . 
				'<label for="' . $id . '_font_color" style="padding-bottom:15px;">' . __('Font Color', 'cmsmasters') . '</label>' . 
			'</div>' . 
			'<script type="text/javascript">' . 
				'jQuery(document).ready(function () { ' . 
					'(function ($) { ' . 
						"$('#" . $id . "_font_color').wpColorPicker(); " . 
					'} )(jQuery); ' . 
				'} ); ' . 
			'</script>';
		}
		
		if ($font_size) {
			echo '<div class="cmsms_admin_block">' . 
				'<input class="small-text" type="text" id="' . $id . '_font_size_number" name="' . $cmsms_option_name . '[' . $id . '_font_size]" value="' . $options[$id . '_font_size'] . '" /> ' . 
				' &nbsp; ' . 
				'<label for="' . $id . '_font_size_number">' . __('Font Size', 'cmsmasters') . ' <em>(' . __('in pixels', 'cmsmasters') . ')</em></label>' . 
			'</div>';
		}
		
		if ($line_height) {
			echo '<div class="cmsms_admin_block">' . 
				'<input class="small-text" type="text" id="' . $id . '_line_height_number" name="' . $cmsms_option_name . '[' . $id . '_line_height]" value="' . $options[$id . '_line_height'] . '" /> ' . 
				' &nbsp; ' . 
				'<label for="' . $id . '_line_height_number">' . __('Line Height', 'cmsmasters') . ' <em>(' . __('in pixels', 'cmsmasters') . ')</em></label>' . 
			'</div>';
		}
		
		if ($font_weight) {
			echo '<div class="cmsms_admin_block">' . 
				'<select class="select" id="' . $id . '_font_weight" name="' . $cmsms_option_name . '[' . $id . '_font_weight]">';
				
				foreach (cmsms_font_weight_list() as $key => $value) {
					echo '<option value="' . $key . '"' . (($options[$id . '_font_weight'] == $key) ? ' selected="selected"' : '') . '>' . $value .'</option>';
				}
				
				echo '</select>' . 
				' &nbsp; ' . 
				'<label for="' . $id . '_font_weight">' . __('Font Weight', 'cmsmasters') . '</label>' . 
			'</div>';
		}
		
		if ($font_style) {
			echo '<div class="cmsms_admin_block">' . 
				'<select class="select" id="' . $id . '_font_style" name="' . $cmsms_option_name . '[' . $id . '_font_style]">';
				
				foreach (cmsms_font_style_list() as $key => $value) {
					echo '<option value="' . $key . '"' . (($options[$id . '_font_style'] == $key) ? ' selected="selected"' : '') . '>' . $value .'</option>';
				}
				
				echo '</select>' . 
				' &nbsp; ' . 
				'<label for="' . $id . '_font_style">' . __('Font Style', 'cmsmasters') . '</label>' . 
			'</div>';
		}
		
		echo (($desc != '') ? '<span class="description">' . $desc . '</span>' : '');
		
		break;
	case 'sidebar':
		echo '<script type="text/javascript"> ' . 
			'jQuery(document).ready(function () { ' . 
				"jQuery('.sidebar_management').on('click', '.sidebar_del', function () { " . 
					"var del_sidebar_number = Number(jQuery('#custom_sidebars_number').val()) - 1; " . 
					"jQuery('#custom_sidebars_number').val(del_sidebar_number); " . 
					'jQuery(this).parent().remove(); ' . 
					'var li_input = undefined, ' . 
						"li_input_val = '';" . 
					'for (var n = 1; n <= del_sidebar_number; n += 1) { ' . 
						"li_input = jQuery('.sidebar_management ul li:eq(' + (n - 1) + ')').find('input[type=\"hidden\"]');" . 
						"li_input_val = li_input.attr('name').split('_-_');" . 
						"jQuery('.sidebar_management ul li:eq(' + (n - 1) + ')').find('input[type=\"hidden\"]').attr( { name :  li_input_val[0] + '_-_' + n + ']'} );" . 
					'} ' . 
					'return false; ' . 
				'} ); ' . 
				"jQuery('#add_sidebar').click(function () { " . 
					"if (jQuery('#new_sidebar_name').val() !== '') { " . 
						"var sidebar_number = Number(jQuery('#custom_sidebars_number').val()) + 1; " . 
						"jQuery('#custom_sidebars_number').val(sidebar_number); " . 
						"jQuery('.sidebar_management ul').append('<li>' + " . 
							"'<a href=\"#\" class=\"sidebar_del\">" . __('Delete', 'cmsmasters') . "</a> ' + " . 
							"jQuery('#new_sidebar_name').val() + " . 
							"'<input type=\"hidden\" name=\"" . $cmsms_option_name . "[" . $id . "_-_' + sidebar_number + ']\" value=\"' + jQuery('#new_sidebar_name').val() + '\" />' + " . 
						"'</li>'); " . 
						"jQuery('#new_sidebar_name').val(''); " . 
					'}' . 
					'return false; ' . 
				'} ); ' . 
			'} ); ' . 
		'</script>' . 
		(($desc != '') ? '<span class="description">' . $desc . '</span>' . '<br />' . '<br />': '') . 
		'<div class="sidebar_management">' . 
			'<p>' . 
				'<input class="all-options" type="text" id="new_sidebar_name" />' . 
				'<input class="button" type="button" id="add_sidebar" value="' . __('Add Sidebar', 'cmsmasters') . '" />' . 
			'</p>' . 
			'<div></div>' . 
			'<ul>';
			
			if (isset($options[$id]) && is_array($options[$id])) {
				$i = 0;
				
				foreach($options[$id] as $sidebar) {
					$i++;
					
					echo '<li>' . 
						'<a href="#" class="sidebar_del">' . __('Delete', 'cmsmasters') . '</a> ' . 
						$sidebar . 
						'<input type="hidden" name="' . $cmsms_option_name . '[' . $id . '_-_' . $i . ']" value="' . $sidebar . '" />' . 
					'</li>';
				}
			}
			
			echo '</ul>' . 
			'<input id="custom_sidebars_number" type="hidden" name="' . $cmsms_option_name . '[' . $id . '_number]" value="' . ((isset($options[$id]) && is_array($options[$id])) ? $i : 0) . '" />' . 
		'</div>';
		
		break;
	case 'heading':
		echo (($desc != '') ? '<span class="description">' . $desc . '</span>' . '<br />' . '<br />' : '') . 
		'<div class="icon_management">' . 
			'<p>' . 
				'<input id="' . $id . '_button" class="heading_upload_image_button button" type="button" value="' . __('Add Icons', 'cmsmasters') . '" />' . 
			'</p>' . 
			'<div></div>' . 
			'<ul>';
			
			if (isset($options[$id]) && is_array($options[$id])) {
				$i = 0;
				
				foreach($options[$id] as $icon) {
					$image = wp_get_attachment_image_src($icon, 'thumbnail');
					
					$image = $image[0];
					
					$i++;
					
					echo '<li>' . 
						'<div>' . 
							'<img src="' . $image . '" alt="" class="icon_list_image" />' . 
							'<input type="hidden" name="' . $cmsms_option_name . '[' . $id . '_-_' . $i . ']" value="' . $icon . '" />' . 
						'</div>' . 
						'<a href="#" class="icon_del" title="' . __('Delete', 'cmsmasters') . '">' . __('Delete', 'cmsmasters') . '</a> ' . 
					'</li>';
				}
			}
			
			echo '</ul>' . 
			'<input id="heading_icons_number" type="hidden" name="' . $cmsms_option_name . '[' . $id . '_number]" value="' . $i . '" />' . 
		'</div>' . 
		'<script type="text/javascript">' . 
			'jQuery(document).ready(function () { ' . 
				'(function ($) { ' . 
					"$('#" . $id . "_button').bind('click', function (e) { " . 
						'e.preventDefault(); ' . 
						'$(e.target).cmsmsMediaUploader( { ' . 
							"frameId : 'cmsms-" . $id . "-media-frame', " . 
							"frameClass : 'media-frame cmsms-media-frame cmsms-" . $id . "-media-frame', " . 
							"frameTitle : '" . __('Choose heading icons', 'cmsmasters') . "', " . 
							"frameButton : '" . __('Choose', 'cmsmasters') . "', " . 
							"optionName : '" . $cmsms_option_name . "', " . 
							"optionID : '" . $id . "', " . 
							"deleteText : '" . __('Delete', 'cmsmasters') . "', " . 
							'multiple : true ' . 
						'} ); ' . 
					'} ); ' . 
				'} )(jQuery); ' . 
			'} ); ' . 
		'</script>';
		
		break;
	case 'social':
		echo (($desc != '') ? '<span class="description">' . $desc . '</span>' . '<br />' . '<br />': '') . 
		'<div class="icon_management">' . 
			'<p>' . 
				'<img src="" class="icon_preview_image" alt="" style="display:none;" />' . 
				'<small style="display:none;">' . 
					'<a href="#" class="icon_clear_image_button">[X] ' . __('Cancel', 'cmsmasters') . '</a>' . 
				'</small>' . 
				'<span class="cl"></span>' . 
				'<span class="icon_upload_link" style="display:none;">' . 
					'<input class="my-color-field" type="text" id="new_icon_color" value="#000000" data-default-color="#000000" />' . 
					'<label for="new_icon_color">' . __('Choose Color for This Icon', 'cmsmasters') . '</label>' . 
					'<br />' . 
					'<input class="all-options" type="text" id="new_icon_link" /> ' . 
					'<label for="new_icon_link">' . __('Enter Link for This Icon', 'cmsmasters') . '</label>' . 
					'<br />' . 
					'<input type="checkbox" id="new_icon_target" value="true" /> ' . 
					'<label for="new_icon_target">' . __('Open Link in a New Tab', 'cmsmasters') . '</label>' . 
				'</span>' . 
				'<span class="cl"></span>' . 
				'<input class="icon_upload_image all-options" type="hidden" id="new_icon_name" />' . 
				'<input id="' . $id . '_button" class="icon_upload_image_button button" type="button" value="' . __('Choose new social icon image', 'cmsmasters') . '" />' . 
				'<span class="cl"><br /></span>' . 
				'<input class="button-primary" type="button" id="add_icon" value="' . __('Add Icon', 'cmsmasters') . '" />' . 
				'<input class="button-primary" type="button" id="edit_icon" value="' . __('Save Icon', 'cmsmasters') . '" style="display:none;" />' . 
			'</p>' . 
			'<div></div>' . 
			'<ul>';
			
			if (isset($options[$id]) && is_array($options[$id])) {
				$i = 0;
				
				foreach($options[$id] as $icon) {
					$icon_array = explode('|', $icon);
					
					if (is_numeric($icon_array[0])) {
						$image = wp_get_attachment_image_src($icon_array[0], 'thumbnail');
						
						$image = $image[0];
					} else {
						$image = $icon_array[0];
					}
					
					$i++;
					
					echo '<li>' . 
						'<div>' . 
							'<img src="' . $image . '" alt="" class="icon_list_image" />' . 
							'<input type="hidden" id="' . $cmsms_option_name . '_' . $id . '_-_' . $i . '" name="' . $cmsms_option_name . '[' . $id . '_-_' . $i . ']" value="' . $icon . '" />' . 
						'</div>' . 
						'<a href="#" class="icon_del" title="' . __('Delete', 'cmsmasters') . '">' . __('Delete', 'cmsmasters') . '</a> ' . 
						'<a href="#" class="icon_edit" title="' . __('Edit', 'cmsmasters') . '">' . __('Edit', 'cmsmasters') . '</a> ' . 
					'</li>';
				}
			}
			
			echo '</ul>' . 
			'<input id="custom_icons_number" type="hidden" name="' . $cmsms_option_name . '[' . $id . '_number]" value="' . $i . '" />' . 
		'</div>' . 
		'<script type="text/javascript"> ' . 
			'jQuery(document).ready(function () { ' . 
				"jQuery('#add_icon').click(function () { " . 
					"if (jQuery('#new_icon_name').val() !== '') { " . 
						"var icon_number = Number(jQuery('#custom_icons_number').val()) + 1; " . 
						"jQuery('#custom_icons_number').val(icon_number); " . 
						"jQuery('.icon_management ul').append('<li>' + " . 
							"'<div>' + " . 
								"'<img src=\"' + jQuery('#new_icon_name').parent().find('.icon_preview_image').attr('src') + '\" alt=\"\" class=\"icon_list_image\" />' + " . 
								"'<input type=\"hidden\" id=\"" . $cmsms_option_name . "_" . $id . "_-_' + icon_number + '\" name=\"" . $cmsms_option_name . "[" . $id . "_-_' + icon_number + ']\" value=\"' + jQuery('#new_icon_name').val() + '|' + jQuery('#new_icon_color').val() + '|' + jQuery('#new_icon_link').val() + '|' + ((jQuery('#new_icon_target').is(':checked')) ? 'true' : 'false') + '\" />' + " . 
							"'</div>' + " . 
							"'<a href=\"#\" class=\"icon_del\" title=\"" . __('Delete', 'cmsmasters') . "\">" . __('Delete', 'cmsmasters') . "</a> ' + " . 
							"'<a href=\"#\" class=\"icon_edit\" title=\"" . __('Edit', 'cmsmasters') . "\">" . __('Edit', 'cmsmasters') . "</a> ' + " . 
						"'</li>'); " . 
						"jQuery('#new_icon_name').val(''); " . 
						"jQuery('#new_icon_color').val('#000000'); " . 
						"jQuery('#new_icon_link').val(''); " . 
						"jQuery('.icon_preview_image').attr( { src : '' } ).hide();" . 
						"jQuery('.icon_clear_image_button').parent().hide();" . 
						"jQuery('.icon_upload_link').hide();" . 
					'}' . 
					'return false; ' . 
				'} ); ' . 
				'(function ($) { ' . 
					"$('#" . $id . "_button').bind('click', function (e) { " . 
						'e.preventDefault(); ' . 
						'$(e.target).cmsmsSocialUploader( { ' . 
							"frameId : 'cmsms-" . $id . "-media-frame', " . 
							"frameClass : 'media-frame cmsms-media-frame cmsms-" . $id . "-media-frame', " . 
							"frameTitle : '" . __('Choose heading icons', 'cmsmasters') . "', " . 
							"frameButton : '" . __('Choose', 'cmsmasters') . "', " . 
							"optionName : '" . $cmsms_option_name . "', " . 
							"optionID : '" . $id . "' " . 
						'} ); ' . 
					'} ); ' . 
				'} )(jQuery); ' . 
			'} ); ' . 
		'</script>';
		
		break;
	}
}


function cmsms_settings_page_fn() {
	$settings_output = cmsms_get_settings();
	$current_tab = cmsms_get_the_tab();
	
	echo '<div class="wrap">';
	
	cmsms_settings_page_header();
	
	echo '<form action="options.php" method="post" class="cmsms_admin_page"' . (($current_tab == 'recaptcha') ? ' style="background-color:#fdffc6; padding:35px 0 15px 25px; margin:-14px 0 0;"' : '') . '>';
	
	settings_fields($settings_output['cmsms_option_name']);
	
	do_settings_sections(__FILE__);
	
	echo '<p class="submit">' . 
				'<input name="submit" type="submit" class="button-primary" value="' . __('Save Changes', 'cmsmasters') . '" />' . 
			'</p>' . 
		'</form>' . 
	'</div>';
}


function cmsms_validate_options($input) {
	$valid_input = array();
	
	$settings_output = cmsms_get_settings();
	$options = $settings_output['cmsms_page_fields'];
	
	foreach ($options as $option) {
		switch ($option['type']) {
		case 'text':
			switch ($option['class']) {
			case 'numeric':
				$input[$option['id']] = trim($input[$option['id']]);
				
				$valid_input[$option['id']] = (is_numeric($input[$option['id']])) ? $input[$option['id']] : __('Expecting a Numeric value!', 'cmsmasters');
				
				if (is_numeric($input[$option['id']]) == false) {
					add_settings_error(
						$option['id'],
						CMSMS_SHORTNAME . '_txt_numeric_error',
						__('Expecting a Numeric value! Please fix.', 'cmsmasters'),
						'error'
					);
				}
				
				break;
			case 'multinumeric':
				$input[$option['id']] = trim($input[$option['id']]);
				
				if ($input[$option['id']] != '') {
					$valid_input[$option['id']] = (preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) == 1) ? $input[$option['id']] : __('Expecting comma separated numeric values', 'cmsmasters');
				} else {
					$valid_input[$option['id']] = $input[$option['id']];
				}
				
				if ($input[$option['id']] != '' && preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) != 1) {
					add_settings_error(
						$option['id'],
						CMSMS_SHORTNAME . '_txt_multinumeric_error',
						__('Expecting comma separated numeric values! Please fix.','cmsmasters'),
						'error'
					);
				}
				
				break;
			case 'nohtml':
				$input[$option['id']] = sanitize_text_field($input[$option['id']]);
				
				$valid_input[$option['id']] = addslashes($input[$option['id']]);
				
				break;
			case 'url':
				$input[$option['id']] = trim($input[$option['id']]);
				
				$valid_input[$option['id']] = esc_url_raw($input[$option['id']]);
				
				break;
			case 'email':
				$input[$option['id']] = trim($input[$option['id']]);
				
				if ($input[$option['id']] != '') {
					$valid_input[$option['id']] = (is_email($input[$option['id']]) !== false) ? $input[$option['id']] : __('Invalid email! Please re-enter!', 'cmsmasters');
				} elseif ($input[$option['id']] == '') {
					$valid_input[$option['id']] = __('This setting field cannot be empty! Please enter a valid email address.', 'cmsmasters');
				}
				
				if (is_email($input[$option['id']]) == false || $input[$option['id']] == '') {
					add_settings_error(
						$option['id'],
						CMSMS_SHORTNAME . '_txt_email_error',
						__('Please enter a valid email address.', 'cmsmasters'),
						'error'
					);
				}
				
				break;
			default:
				$allowed_html = array( 
					'a' => array( 
						'href' => array(), 
						'title' => array() 
					), 
					'b' => array(), 
					'em' => array(), 
					'i' => array(), 
					'strong' => array() 
				);
				
				$input[$option['id']] = trim($input[$option['id']]);
				$input[$option['id']] = force_balance_tags($input[$option['id']]);
				$input[$option['id']] = wp_kses( $input[$option['id']], $allowed_html);
				
				$valid_input[$option['id']] = addslashes($input[$option['id']]);
				
				break;
			}
			
			break;
		case 'multi-text':
			$textarray = array();
			$text_values = array();
			
			foreach ($option['choices'] as $k => $v) {
				$pieces = explode('|', $v);
				
				$text_values[] = $pieces[1];
			}
			
			foreach ($text_values as $v) {
				if (!empty($input[$option['id'] . '|' . $v])) {
					switch ($option['class']) {
						case 'numeric':
							$input[$option['id'] . '|' . $v] = trim($input[$option['id'] . '|' . $v]);
							
							$input[$option['id'] . '|' . $v] = (is_numeric($input[$option['id'] . '|' . $v])) ? $input[$option['id'] . '|' . $v] : '';
						break;
						
						default:
							$input[$option['id'] . '|' . $v] = sanitize_text_field($input[$option['id'] . '|' . $v]);
							$input[$option['id'] . '|' . $v] = addslashes($input[$option['id'] . '|' . $v]);
						break;
					}
					
					$textarray[$v] = $input[$option['id'] . '|' . $v];
				} else {
					$textarray[$v] = '';
				}
			}
			
			if (!empty($textarray)) {
				$valid_input[$option['id']] = $textarray;
			}
			
			break;
		case 'textarea':
			switch ($option['class']) {
			case 'inlinehtml':
				$input[$option['id']] = trim($input[$option['id']]);
				$input[$option['id']] = force_balance_tags($input[$option['id']]);
				$input[$option['id']] = addslashes($input[$option['id']]);
				
				$valid_input[$option['id']] = wp_filter_kses($input[$option['id']]);
				
				break;
			case 'nohtml':
				$input[$option['id']] = sanitize_text_field($input[$option['id']]);
				
				$valid_input[$option['id']] = addslashes($input[$option['id']]);
				
				break;
			case 'allowlinebreaks':
				$input[$option['id']] = wp_strip_all_tags($input[$option['id']]);
				
				$valid_input[$option['id']] = addslashes($input[$option['id']]);
				
				break;
			default:
				$allowed_html = array( 
					'script' => array( 
						'type' => array() 
					), 
					'style' => array( 
						'type' => array(), 
						'media' => array() 
					), 
					'a' => array( 
						'href' => array(), 
						'title' => array(),
						'target' => array(),
						'style' => array(),
						'id' => array(), 
						'class' => array()
					), 
					'b' => array(), 
					'blockquote' => array( 
						'cite' => array() 
					), 
					'br' => array(), 
					'dd' => array(), 
					'dl' => array(), 
					'dt' => array(), 
					'em' => array(), 
					'i' => array(), 
					'li' => array(), 
					'ol' => array(), 
					'p' => array(
						'style' => array(), 
						'id' => array(), 
						'class' => array()
					), 
					'span' => array(
						'style' => array(), 
						'id' => array(), 
						'class' => array()
					), 
					'div' => array(
						'style' => array(), 
						'id' => array(), 
						'class' => array()
					), 
					'img' => array( 
						'src' => array(), 
						'alt' => array(),
						'style' => array(), 
						'class' => array()
					), 
					'q' => array( 
						'cite' => array() 
					), 
					'strong' => array(), 
					'ul' => array(), 
					'h1' => array( 
						'align' => array(), 
						'class' => array(), 
						'id' => array(), 
						'style' => array() 
					), 
					'h2' => array( 
						'align' => array(), 
						'class' => array(), 
						'id' => array(), 
						'style' => array() 
					), 
					'h3' => array( 
						'align' => array(), 
						'class' => array(), 
						'id' => array(), 
						'style' => array() 
					), 
					'h4' => array( 
						'align' => array(), 
						'class' => array(), 
						'id' => array(), 
						'style' => array() 
					), 
					'h5' => array( 
						'align' => array(), 
						'class' => array(), 
						'id' => array(), 
						'style' => array() 
					), 
					'h6' => array( 
						'align' => array(), 
						'class' => array(), 
						'id' => array(), 
						'style' => array() 
					) 
				);
				
				$input[$option['id']] = trim($input[$option['id']]);
				$input[$option['id']] = force_balance_tags($input[$option['id']]);
				$input[$option['id']] = wp_kses($input[$option['id']], $allowed_html);
				
				$valid_input[$option['id']] = addslashes($input[$option['id']]);
				
				break;
			}
			
			break;
		case 'select':
			$select_values = array();
			
			foreach ($option['choices'] as $k => $v) {
				$pieces = explode('|', $v);
				
				$select_values[] = $pieces[1];
			}
			
			$valid_input[$option['id']] = (in_array($input[$option['id']], $select_values) ? $input[$option['id']] : '');
			
			break;
		case 'checkbox':
			if (!isset($input[$option['id']])) {
				$input[$option['id']] = null;
			}
			
			$valid_input[$option['id']] = (($input[$option['id']] == 1) ? 1 : 0);
			
			break;
		case 'multi-checkbox':
			$checkboxarray = array();
			$check_values = array();
			
			foreach ($option['choices'] as $k => $v) {
				$pieces = explode('|', $v);
				
				$check_values[] = $pieces[1];
			}
			
			foreach ($check_values as $v) {
				if (!empty($input[$option['id'] . '|' . $v])) {
					$checkboxarray[$v] = 'true';
				} else {
					$checkboxarray[$v] = 'false';
				}
			}
			
			if (!empty($checkboxarray)) {
				$valid_input[$option['id']] = $checkboxarray;
			}
			
			break;
		case 'number':
			$input[$option['id']] = trim($input[$option['id']]);
			$valid_input[$option['id']] = (is_numeric($input[$option['id']])) ? $input[$option['id']] : __('Number!', 'cmsmasters');
			
			if (is_numeric($input[$option['id']]) == false) {
				add_settings_error(
					$option['id'],
					CMSMS_SHORTNAME . '_txt_numeric_error',
					__('Expecting a Numeric value! Please fix.', 'cmsmasters'),
					'error'
				);
			}
			
			break;
		case 'radio':
			$select_values = array();
			
			foreach ($option['choices'] as $k => $v) {
				$pieces = explode('|', $v);
				
				$select_values[] = $pieces[1];
			}
			
			$valid_input[$option['id']] = (in_array($input[$option['id']], $select_values) ? $input[$option['id']] : '');
			
			break;
		case 'radio_img':
			$select_values = array();
			
			foreach ($option['choices'] as $k => $v) {
				$pieces = explode('|', $v);
				
				$select_values[] = $pieces[2];
			}
			
			$valid_input[$option['id']] = (in_array($input[$option['id']], $select_values) ? $input[$option['id']] : '');
			
			break;
		case 'typorgaphy':
			foreach ($option['choices'] as $v) {
				if (!empty($input[$option['id'] . '_' . $v])) {
					$valid_input[$option['id'] . '_' . $v] = $input[$option['id'] . '_' . $v];
				} else {
					$valid_input[$option['id'] . '_' . $v] = '';
				}
			}
			
			break;
		case 'sidebar':
			$valid_vals = array();
			
			for ($n = 1, $i = $input[$option['id'] . '_number']; $n <= $i; $n++) {
				$valid_vals[] = $input[$option['id'] . '_-_' . $n];
			}
			
			if (!empty($valid_vals)) {
				$valid_input[$option['id']] = $valid_vals;
			}
			
			break;
		case 'heading':
			$valid_vals = array();
			
			for ($n = 1, $i = $input[$option['id'] . '_number']; $n <= $i; $n++) {
				$valid_vals[] = $input[$option['id'] . '_-_' . $n];
			}
			
			if (!empty($valid_vals)) {
				$valid_input[$option['id']] = $valid_vals;
			}
			
			break;
		case 'social':
			$valid_vals = array();
			
			for ($n = 1, $i = $input[$option['id'] . '_number']; $n <= $i; $n++) {
				$valid_vals[] = $input[$option['id'] . '_-_' . $n];
			}
			
			if (!empty($valid_vals)) {
				$valid_input[$option['id']] = $valid_vals;
			}
			
			break;
		default:
			$valid_input[$option['id']] = $input[$option['id']];
			
			break;
		}
	}
	
	return $valid_input;
}


function cmsms_show_msg($message, $msgclass = 'info') {
	echo '<div id="message" class="' . $msgclass . '">' . $message . '</div>';
}


function cmsms_admin_msgs() {
	global $pagenow;
	
	$cmsms_settings_pg = (isset($_GET['page'])) ? strpos($_GET['page'], CMSMS_PAGE_BASENAME) : '';
	
	$set_errors = get_settings_errors(); 
	
	if ($pagenow == 'admin.php' && current_user_can('manage_options') && $cmsms_settings_pg !== false && !empty($set_errors)) {
		if ($set_errors[0]['code'] == 'settings_updated' && isset($_GET['settings-updated'])) {
			cmsms_show_msg('<p><strong>' . $set_errors[0]['message'] . '</strong></p>', 'updated');
		} else {
			foreach ($set_errors as $set_error) {
				cmsms_show_msg('<p class="setting-error-message" title="' . $set_error['setting'] . '">' . $set_error['message'] . '</p>', 'error');
			}
		}
	}
}

add_action('admin_notices', 'cmsms_admin_msgs');


function cmsms_add_global_options() {
	$cmsms_option_names = array( 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_general', 
			cmsms_options_general_fields('general') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_sidebar', 
			cmsms_options_general_fields('sidebar') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_sitemap', 
			cmsms_options_general_fields('sitemap') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_archive', 
			cmsms_options_general_fields('archive') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_search', 
			cmsms_options_general_fields('search') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_error', 
			cmsms_options_general_fields('error') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_seo', 
			cmsms_options_general_fields('seo') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_code', 
			cmsms_options_general_fields('code') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_recaptcha', 
			'' 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_style_bg', 
			cmsms_options_style_fields('bg') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_style_header', 
			cmsms_options_style_fields('header') 
		),
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_style_content', 
			cmsms_options_style_fields('content') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_style_footer', 
			cmsms_options_style_fields('footer') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_logo_image', 
			cmsms_options_logo_fields('image') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_logo_text', 
			cmsms_options_logo_fields('text') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_logo_favicon', 
			cmsms_options_logo_fields('favicon') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_content', 
			cmsms_options_font_fields('content') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_link', 
			cmsms_options_font_fields('link') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_nav', 
			cmsms_options_font_fields('nav') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_h1', 
			cmsms_options_font_fields('h1') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_h2', 
			cmsms_options_font_fields('h2') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_h3', 
			cmsms_options_font_fields('h3') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_h4', 
			cmsms_options_font_fields('h4') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_h5', 
			cmsms_options_font_fields('h5') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_h6', 
			cmsms_options_font_fields('h6') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_font_other', 
			cmsms_options_font_fields('other') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_icon_heading', 
			cmsms_options_icon_fields('heading') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_icon_social', 
			cmsms_options_icon_fields('social') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_blog_page', 
			cmsms_options_blog_fields('page') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_blog_post', 
			cmsms_options_blog_fields('post') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_portfolio_full', 
			cmsms_options_portfolio_fields('full') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_portfolio_project', 
			cmsms_options_portfolio_fields('project') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_testimonial_t_page', 
			cmsms_options_testimonial_fields('t_page') 
		), 
		array( 
			'cmsms_options_' . CMSMS_SHORTNAME . '_testimonial_t_post', 
			cmsms_options_testimonial_fields('t_post') 
		) 
	);
	
	foreach ($cmsms_option_names as $cmsms_option_name) {
		$start_options = array();
		
		if ($cmsms_option_name[1] !== '') {
			foreach ($cmsms_option_name[1] as $selected_option) {
				if ( 
					is_array($selected_option['std']) && 
					$selected_option['id'] !== CMSMS_SHORTNAME . '_social_icons' 
				) {
					foreach ($selected_option['std'] as $key => $value) {
						$start_options[$selected_option['id'] . '_' . $key] = $value;
					}
				} else {
					$start_options[$selected_option['id']] = $selected_option['std'];
				}
			}
			
			if (count($start_options) == 1) {
				foreach ($start_options as $key => $val) {
					if (empty($val)) {
						$start_options_val = '';
					} else {
						$start_options_val = $start_options;
					}
				}
			} else {
				$start_options_val = $start_options;
			}
		} else {
			$start_options_val = '';
		}
		
		if (get_option($cmsms_option_name[0]) == false) {
			add_option($cmsms_option_name[0], $start_options_val, '', 'yes');
		}
	}
}


function cmsms_get_global_options() {
	$cmsms_option = array();
	
	$cmsms_option_names = array( 
		'cmsms_options_' . CMSMS_SHORTNAME . '_general', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_sidebar', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_sitemap', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_archive', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_search', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_error', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_seo', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_code', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_recaptcha', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_style_bg', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_style_header', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_style_content', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_style_footer', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_logo_image', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_logo_text', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_logo_favicon', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_content', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_link', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_nav', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_h1', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_h2', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_h3', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_h4', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_h5', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_h6', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_font_other', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_icon_heading', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_icon_social', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_blog_page', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_blog_post', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_portfolio_full', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_portfolio_project', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_testimonial_t_page', 
		'cmsms_options_' . CMSMS_SHORTNAME . '_testimonial_t_post' 
	);
	
	foreach ($cmsms_option_names as $cmsms_option_name) {
		if (get_option($cmsms_option_name) != false) {
			$option = get_option($cmsms_option_name);
			
			$cmsms_option = array_merge($cmsms_option, $option);
		}
	}
	
	return $cmsms_option;
}

