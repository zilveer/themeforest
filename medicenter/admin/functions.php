<?php
function theme_admin_init()
{
	wp_register_script("theme-colorpicker", get_template_directory_uri() . "/admin/js/colorpicker.js", array("jquery"));
	wp_register_script("theme-admin", get_template_directory_uri() . "/admin/js/theme_admin.js", array("jquery", "theme-colorpicker"));
	wp_register_script("jquery-bqq", get_template_directory_uri() . "/admin/js/jquery.ba-bbq.min.js", array("jquery"));
	wp_register_style("theme-colorpicker", get_template_directory_uri() . "/admin/style/colorpicker.css");
	wp_register_style("theme-admin-style", get_template_directory_uri() . "/admin/style/style.css");
	wp_register_style("theme-admin-style-rtl", get_template_directory_uri() . "/admin/style/rtl.css");
}
add_action("admin_init", "theme_admin_init");

function theme_admin_print_scripts()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-bqq');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('theme-admin');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_style("google-font-open-sans", "//fonts.googleapis.com/css?family=Open+Sans:400,600");
	
	$sidebars = array(
		"default" => array(
			array(
				"name" => "header",
				"label" => __("header", 'medicenter')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'medicenter')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'medicenter')
			)
		),
		"template-blog.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'medicenter')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'medicenter')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'medicenter')
			)
		),
		"single.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'medicenter')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'medicenter')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'medicenter')
			)
		),
		"single-features.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'medicenter')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'medicenter')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'medicenter')
			)
		),
		"search.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'medicenter')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'medicenter')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'medicenter')
			)
		),
		"template-default-without-breadcrumbs.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'medicenter')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'medicenter')
			)
		),
		"template-home.php" => array(
			array(
				"name" => "top",
				"label" => __("top", 'medicenter')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'medicenter')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'medicenter')
			)
		),
		"404.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'medicenter')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'medicenter')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'medicenter')
			)
		)
	);
	//get theme sidebars
	$theme_sidebars = array();
	$theme_sidebars_array = get_posts(array(
		'post_type' => 'medicenter_sidebars',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));
	for($i=0; $i<count($theme_sidebars_array); $i++)
	{
		$theme_sidebars[$i]["id"] = $theme_sidebars_array[$i]->ID;
		$theme_sidebars[$i]["title"] = $theme_sidebars_array[$i]->post_title;
	}
	//get theme sliders
	$sliderAllShortcodeIds = array();
	$allOptions = wp_load_alloptions();
	foreach($allOptions as $key => $value)
	{
		if(substr($key, 0, 26)=="medicenter_slider_settings")
			$sliderAllShortcodeIds[] = $key;
	}
	//get revolution sliders
	if(is_plugin_active('revslider/revslider.php'))
	{
		global $wpdb;
		$rs = $wpdb->get_results( 
		"
		SELECT id, title, alias
		FROM ".$wpdb->prefix."revslider_sliders
		ORDER BY id ASC LIMIT 100
		"
		);
		if($rs) 
		{
			foreach($rs as $slider)
			{
				$sliderAllShortcodeIds[] = "revolution_slider_settings_" . $slider->alias;
			}
		}
	}
	//get layer sliders
	if(is_plugin_active('LayerSlider/layerslider.php'))
	{
		global $wpdb;
		$ls = $wpdb->get_results(
		"
		SELECT id, name, date_c
		FROM ".$wpdb->prefix."layerslider
		WHERE flag_hidden = '0' AND flag_deleted = '0'
		ORDER BY date_c ASC LIMIT 999
		"
		);
		$layer_sliders = array();
		if($ls)
		{
			foreach($ls as $slider)
			{
				$sliderAllShortcodeIds[] = "aaaaalayer_slider_settings_" . $slider->id;
			}
		}
	}
	//sort slider ids
	sort($sliderAllShortcodeIds);
	$data = array(
		'img_url' =>  get_template_directory_uri() . "/images/",
		'admin_img_url' =>  get_template_directory_uri() . "/admin/images/",
		'sidebar_label' => __('Sidebar', 'medicenter'),
		'slider_label' => __('Main Slider', 'medicenter'),
		'sidebars' => $sidebars,
		'theme_sidebars' => $theme_sidebars,
		'page_sidebars' => get_post_meta(get_the_ID(), "medicenter_page_sidebars", true),
		'theme_sliders' => $sliderAllShortcodeIds,
		'main_slider' => get_post_meta(get_the_ID(), "main_slider", true)
	);
	//pass data to javascript
	$params = array(
		'l10n_print_after' => 'config = ' . json_encode($data) . ';'
	);
	wp_localize_script("theme-admin", "config", $params);
}

function theme_admin_print_scripts_colorpicker()
{	
	wp_enqueue_script('theme-admin');
	wp_enqueue_script('theme-colorpicker');
	wp_enqueue_style('theme-colorpicker');
}

function theme_admin_print_scripts_all()
{
	global $theme_options;
	wp_enqueue_style('theme-admin-style');
	if((is_rtl() || (isset($theme_options['direction']) && $theme_options["direction"]=='rtl')) && (empty($_COOKIE["mc_direction"]) || $_COOKIE["mc_direction"]!="LTR"))
		wp_enqueue_style('theme-admin-style-rtl');
}

function theme_admin_menu_theme_options() 
{
	add_action("admin_print_scripts", "theme_admin_print_scripts_all");
	add_action("admin_print_scripts-post-new.php", "theme_admin_print_scripts");
	add_action("admin_print_scripts-post.php", "theme_admin_print_scripts");
	add_action("admin_print_scripts-appearance_page_ThemeOptions", "theme_admin_print_scripts");
	add_action("admin_print_scripts-widgets.php", "theme_admin_print_scripts_colorpicker");
	add_action("admin_print_scripts-appearance_page_ThemeOptions", "theme_admin_print_scripts_colorpicker");
	add_action("admin_print_scripts-post-new.php", "theme_admin_print_scripts_colorpicker");
	add_action("admin_print_scripts-post.php", "theme_admin_print_scripts_colorpicker");
}
add_action("admin_menu", "theme_admin_menu_theme_options");

//visual composer
if(function_exists("vc_add_shortcode_param"))
{
	//dropdownmulti
	vc_add_shortcode_param('dropdownmulti' , 'dropdownmultiple_settings_field');
	function dropdownmultiple_settings_field($settings, $value)
	{	
		$value = ($value==null ? array() : $value);
		if(!is_array($value))
			$value = explode(",", $value);
		$output = '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'" multiple>';
				foreach ( $settings['value'] as $text_val => $val ) {
					if ( is_numeric($text_val) && is_string($val) || is_numeric($text_val) && is_numeric($val) ) {
						$text_val = $val;
					}
					$text_val = __($text_val, "js_composer");
				   // $val = strtolower(str_replace(array(" "), array("_"), $val));
					$selected = '';
					if ( in_array($val,$value) ) $selected = ' selected="selected"';
					$output .= '<option class="'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
				}
				$output .= '</select>';
		return $output;
	}
	//hidden
	vc_add_shortcode_param('hidden', 'hidden_settings_field');
	function hidden_settings_field($settings, $value) 
	{
	   return '<input name="'.$settings['param_name']
				 .'" class="wpb_vc_param_value wpb-textinput '
				 .$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'
				 .$value.'"/>';
	}
	//readonly
	vc_add_shortcode_param('readonly', 'cs_readonly_settings_field');
	function cs_readonly_settings_field($settings, $value) 
	{
	   return '<input name="'.esc_attr($settings['param_name'])
				 .'" class="wpb_vc_param_value wpb-textinput '
				 .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" readonly="readonly" value="'
				 .esc_attr($value).'"/>';
	}
	//add item button
	vc_add_shortcode_param('listitem' , 'listitem_settings_field');
	function listitem_settings_field($settings, $value)
	{
		$value = explode(",", $value);
		$output = '<input type="button" value="' . __('Add list item', 'medicenter') . '" name="'.$settings['param_name'].'" class="button '.$settings['param_name'].' '.$settings['type'].'" style="width: auto; padding: 0 10px 1px;"/>';
		return $output;
	}
	//add item window
	vc_add_shortcode_param('listitemwindow' , 'listitemwindow_settings_field');
	function listitemwindow_settings_field($settings, $value)
	{
		$value = explode(",", $value);
		$output = '<div class="listitemwindow vc_panel vc_shortcode-edit-form" name="'.$settings['param_name'].'">
			<div class="vc_panel-heading">
				<a class="vc_close" href="#" title="Close panel"><i class="vc_icon"></i></a>
				<h3 class="vc_panel-title">' . __('Add New List Item', 'medicenter') . '</h3>
			</div>
			<div class="modal-body wpb-edit-form" style="display: block;min-height: auto;">
				<div class="vc_row-fluid wpb_el_type_dropdown">
					<div class="wpb_element_label">' . __("Type", 'medicenter') . '</div>
					<div class="edit_form_line">
						<select class="wpb_vc_param_value wpb-input wpb-select item_type dropdown" name="item_type">
							<option selected="selected" value="items" class="items">' . __("Items list", 'medicenter') . '</option>
							<option value="info" class="info">' . __("Info list", 'medicenter') . '</option>
							<option value="scrolling" class="scrolling">' . __("Scrolling list", 'medicenter') . '</option>
							<option value="simple" class="simple">' . __("Simple list", 'medicenter') . '</option>
						</select>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_textfield">
					<div class="wpb_element_label">' . __("Text", 'medicenter') . '</div>
					<div class="edit_form_line">
						<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_content">
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_textfield">
					<div class="wpb_element_label">' . __("Value", 'medicenter') . '</div>
					<div class="edit_form_line">
						<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_value">
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_textfield">
					<div class="wpb_element_url">' . __("Url", 'medicenter') . '</div>
					<div class="edit_form_line">
						<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_url">
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_dropdown">
					<div class="wpb_element_label">' . __("Url target", 'medicenter') . '</div>
					<div class="edit_form_line">
						<select class="wpb_vc_param_value wpb-input wpb-select item_url_target dropdown" name="item_url_target">
							<option selected="selected" value="new_window">' . __("new window", 'medicenter') . '</option>
							<option value="same_window">' . __("same window", 'medicenter') . '</option>
						</select>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_dropdown">
					<div class="wpb_element_label">' . __("Icon", 'medicenter') . '</div>
					<div class="edit_form_line">
						<select class="wpb_vc_param_value wpb-input wpb-select item_type dropdown" name="item_icon">
							<option selected="selected" value="">' . __("-", 'medicenter') . '</option>
							<option value="left_black">' . __("Left arrow black", 'medicenter') . '</option>
							<option value="right_black">' . __("Right arrow black", 'medicenter') . '</option>
							<option value="top_black">' . __("Top arrow black", 'medicenter') . '</option>
							<option value="left_white">' . __("Left arrow white", 'medicenter') . '</option>
							<option value="right_white">' . __("Right arrow white", 'medicenter') . '</option>
							<option value="top_white">' . __("Top arrow white", 'medicenter') . '</option>
							<option value="square">' . __("Square", 'medicenter') . '</option>
							<option value="mark">' . __("Mark", 'medicenter') . '</option>
							<option value="tick">' . __("Tick", 'medicenter') . '</option>
						</select>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_colorpicker">
					<div class="wpb_element_label">' . __("Custom text color", 'medicenter') . '</div>
					<div class="edit_form_line">
						<div class="color-group">
							<input name="item_content_color" class="wpb_vc_param_value wpb-textinput colorpicker_field vc-color-control wp-color-picker" type="text"/>
						</div>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_colorpicker">
					<div class="wpb_element_label">' . __("Custom value color", 'medicenter') . '</div>
					<div class="edit_form_line">
						<div class="color-group">
							<input name="item_value_color" class="wpb_vc_param_value wpb-textinput colorpicker_field vc-color-control wp-color-picker" type="text"/>
						</div>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_colorpicker">
					<div class="wpb_element_label">' . __("Custom border color", 'medicenter') . '</div>
					<div class="edit_form_line">
						<div class="color-group">
							<input name="item_border_color" class="wpb_vc_param_value wpb-textinput colorpicker_field vc-color-control wp-color-picker" type="text"/>
							<span class="description clear">' . __('Set to <em>none</em> for no border', 'medicenter') . '</span>
						</div>
					</div>
				</div>
				<div class="edit_form_actions" style="padding-top: 20px;">
					<a id="add-item-shortcode" class="button-primary" href="#">' . __("Add Item", 'medicenter') . '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="cancel-item-options button" href="#">' . __("Cancel", 'medicenter') . '</a>
				</div>
			</div>
		</div>';
		return $output;
	}
}
/*
//attach_images_custom
vc_add_shortcode_param('attach_images_custom' , attach_images_custom_settings_field);
function attach_images_custom_settings_field($settings, $value)
{
	$param_line = '';
	
	// TODO: More native way
	$param_value = wpb_removeNotExistingImgIDs($value);
	$param_line .= '<input type="hidden" class="wpb_vc_param_value gallery_widget_attached_images_ids '.$settings['param_name'].' '.$settings['type'].'" name="'.$settings['param_name'].'" value="'.$param_value.'" ' . $dependency . '/>';
	//$param_line .= '<a class="button gallery_widget_add_images" href="#" title="'.__('Add images', "js_composer").'">'.__('Add images', "js_composer").'</a>';
	$param_line .= '<div class="gallery_widget_attached_images">';
	$param_line .= '<ul class="gallery_widget_attached_images_list">';
	$param_line .= ($param_value != '') ? fieldAttachedImages(explode(",", $param_value)) : '';
	$param_line .= '</ul>';
	$param_line .= '</div>';
	$param_line .= '<div class="gallery_widget_site_images">';
	// $param_line .= siteAttachedImages(explode(",", $param_value));
	$param_line .= '</div>';
	$param_line .= '<a class="gallery_widget_add_images" href="#" title="'.__('Add images', "js_composer").'">'.__('Add images', "js_composer").'</a>';//class: button
	//$param_line .= '<div class="wpb_clear"></div>';
	for($i=0; $i<count(explode(",", $param_value)); $i++)
	{
		$param_line .= '<div class="row-fluid wpb_el_type_textfield">
				<div class="wpb_element_label">' . __("Text", 'medicenter') . '</div>
				<div class="edit_form_line">
					<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_content' . $i . '">
				</div>
			</div>';
	}
	return $param_line;
}*/
?>