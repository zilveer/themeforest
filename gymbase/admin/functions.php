<?php
function theme_admin_init()
{
	wp_register_script("theme-colorpicker", get_template_directory_uri() . "/admin/js/colorpicker.js", array("jquery"));
	wp_register_script("theme-admin", get_template_directory_uri() . "/admin/js/theme_admin.js", array("jquery", "theme-colorpicker"));
	wp_register_script("jquery-bqq", get_template_directory_uri() . "/admin/js/jquery.ba-bbq.min.js", array("jquery"));
	wp_register_style("theme-colorpicker", get_template_directory_uri() . "/admin/style/colorpicker.css");
	wp_register_style("theme-admin-style", get_template_directory_uri() . "/admin/style/style.css");
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
	
	$data = array(
		'img_url' =>  get_template_directory_uri() . "/images/",
		'admin_img_url' =>  get_template_directory_uri() . "/admin/images/"
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
	wp_enqueue_style('theme-admin-style');
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
		$output = '<input type="button" value="' . __('Add list item', 'gymbase') . '" name="'.$settings['param_name'].'" class="button '.$settings['param_name'].' '.$settings['type'].'" style="width: auto; padding: 0 10px 1px;"/>';
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
				<h3 class="vc_panel-title">' . __('Add New List Item', 'gymbase') . '</h3>
			</div>
			<div class="modal-body wpb-edit-form" style="display: block;min-height: auto;">
				<div class="vc_row-fluid wpb_el_type_dropdown">
					<div class="wpb_element_label">' . __("Type", 'gymbase') . '</div>
					<div class="edit_form_line">
						<select class="wpb_vc_param_value wpb-input wpb-select item_type dropdown" name="item_type">
							<option selected="selected" value="items" class="items">' . __("Items list", 'gymbase') . '</option>
							<option value="info" class="info">' . __("Info list", 'gymbase') . '</option>
							<option value="scrolling" class="scrolling">' . __("Scrolling list", 'gymbase') . '</option>
							<option value="simple" class="simple">' . __("Simple list", 'gymbase') . '</option>
						</select>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_textfield">
					<div class="wpb_element_label">' . __("Text", 'gymbase') . '</div>
					<div class="edit_form_line">
						<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_content">
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_textfield">
					<div class="wpb_element_label">' . __("Value", 'gymbase') . '</div>
					<div class="edit_form_line">
						<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_value">
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_textfield">
					<div class="wpb_element_url">' . __("Url", 'gymbase') . '</div>
					<div class="edit_form_line">
						<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_url">
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_dropdown">
					<div class="wpb_element_label">' . __("Url target", 'gymbase') . '</div>
					<div class="edit_form_line">
						<select class="wpb_vc_param_value wpb-input wpb-select item_url_target dropdown" name="item_url_target">
							<option selected="selected" value="new_window">' . __("new window", 'gymbase') . '</option>
							<option value="same_window">' . __("same window", 'gymbase') . '</option>
						</select>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_dropdown">
					<div class="wpb_element_label">' . __("Icon", 'gymbase') . '</div>
					<div class="edit_form_line">
						<select class="wpb_vc_param_value wpb-input wpb-select item_type dropdown" name="item_icon">
							<option selected="selected" value="" class="">' . __("-", 'gymbase') . '</option>
							<option value="small_arrow left_black" class="small_arrow left_black">' . __("Left arrow black", 'gymbase') . '</option>
							<option value="small_arrow right_black" class="small_arrow right_black">' . __("Right arrow black", 'gymbase') . '</option>
							<option value="small_arrow top_black" class="small_arrow top_black">' . __("Top arrow black", 'gymbase') . '</option>
							<option value="small_arrow left_white" class="small_arrow left_white">' . __("Left arrow white", 'gymbase') . '</option>
							<option value="small_arrow right_white" class="small_arrow right_white">' . __("Right arrow white", 'gymbase') . '</option>
							<option value="small_arrow top_white" class="small_arrow top_white">' . __("Top arrow white", 'gymbase') . '</option>
							<option value="clock_green" class="clock_green">' . __("Clock green", 'gymbase') . '</option>
							<option value="clock_black" class="clock_black">' . __("Clock black", 'gymbase') . '</option>
							<option value="card_green" class="card_green">' . __("Card green", 'gymbase') . '</option>
							<option value="card_white" class="card_white">' . __("Card white", 'gymbase') . '</option>
						</select>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_colorpicker">
					<div class="wpb_element_label">' . __("Custom text color", 'gymbase') . '</div>
					<div class="edit_form_line">
						<div class="color-group">
							<input name="item_content_color" class="wpb_vc_param_value wpb-textinput colorpicker_field vc-color-control wp-color-picker" type="text"/>
						</div>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_colorpicker">
					<div class="wpb_element_label">' . __("Custom value color", 'gymbase') . '</div>
					<div class="edit_form_line">
						<div class="color-group">
							<input name="item_value_color" class="wpb_vc_param_value wpb-textinput colorpicker_field vc-color-control wp-color-picker" type="text"/>
						</div>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_colorpicker">
					<div class="wpb_element_label">' . __("Custom border color", 'gymbase') . '</div>
					<div class="edit_form_line">
						<div class="color-group">
							<input name="item_border_color" class="wpb_vc_param_value wpb-textinput colorpicker_field vc-color-control wp-color-picker" type="text"/>
							<span class="description clear">' . __('Set to <em>none</em> for no border', 'gymbase') . '</span>
						</div>
					</div>
				</div>
				<div class="edit_form_actions" style="padding-top: 20px;">
					<a id="add-item-shortcode" class="button-primary" href="#">' . __("Add Item", 'gymbase') . '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="cancel-item-options button" href="#">' . __("Cancel", 'gymbase') . '</a>
				</div>
			</div>
		</div>';
		return $output;
	}
}
