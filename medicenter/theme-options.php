<?php
global $themename;
//admin menu
function theme_admin_menu() 
{
	global $themename;
	add_submenu_page("themes.php", ucfirst('medicenter'), "Theme Options", "edit_theme_options", "ThemeOptions", $themename . "_options");
}
add_action("admin_menu", "theme_admin_menu");

function theme_stripslashes_deep($value)
{
	$value = is_array($value) ?
				array_map('stripslashes_deep', $value) :
				stripslashes($value);

	return $value;
}

function slider_get_settings()
{
	echo "slider_start" . json_encode(theme_stripslashes_deep(get_option('medicenter_slider_settings_' . $_POST["id"]))) . "slider_end";
	exit();
}
add_action('wp_ajax_slider_get_settings', 'slider_get_settings');

function slider_delete()
{
	echo "slider_start" . delete_option($_POST["id"]) . "slider_end";
	exit();
}
add_action('wp_ajax_slider_delete', 'slider_delete');

function medicenter_save_options()
{
	ob_start();
	global $themename;
	if($_POST["slider_id"]!="")
	{
		$slider_id = sanitize_title($_POST["slider_id"]);
		$slider_options = array(
			"slider_image_url" => array_filter($_POST["slider_image_url"]),
			"slider_image_title" => array_filter($_POST["slider_image_title"]),
			"slider_image_subtitle" => array_filter($_POST["slider_image_subtitle"]),
			"slider_image_link" => array_filter($_POST["slider_image_link"]),
			"slider_autoplay" => $_POST["slider_autoplay"],
			"slider_navigation" => $_POST["slider_navigation"],
//			"slider_pause_on_hover" => $_POST["slider_pause_on_hover"],
			"slider_height" => (int)$_POST["slider_height"],
			"slide_interval" => (int)$_POST["slide_interval"],
			"slider_effect" => $_POST["slider_effect"],
			"slider_transition" => $_POST["slider_transition"],
			"slider_transition_speed" => (int)$_POST["slider_transition_speed"],
		);
		update_option('medicenter_slider_settings_' . $slider_id, $slider_options);
	}
	$theme_options = array(
		"favicon_url" => $_POST["favicon_url"],
		"logo_url" => $_POST["logo_url"],
		"logo_text" => $_POST["logo_text"],
		"footer_text_left" => $_POST["footer_text_left"],
		"footer_text_right" => $_POST["footer_text_right"],
		"sticky_menu" => (int)$_POST["sticky_menu"],
		"responsive" => (int)$_POST["responsive"],
		"layout" => $_POST["layout"],
		"layout_picker" => $_POST["layout_picker"],
		"direction" => $_POST["direction"],
		"animations" => $_POST["animations"],
		"collapsible_mobile_submenus" => $_POST["collapsible_mobile_submenus"],
		"google_api_code" => $_POST["google_api_code"],
		"ga_tracking_code" => $_POST["ga_tracking_code"],
		"home_page_top_hint" => $_POST["home_page_top_hint"],
		"cf_admin_name" => $_POST["cf_admin_name"],
		"cf_admin_email" => $_POST["cf_admin_email"],
		"cf_smtp_host" => $_POST["cf_smtp_host"],
		"cf_smtp_username" => $_POST["cf_smtp_username"],
		"cf_smtp_password" => $_POST["cf_smtp_password"],
		"cf_smtp_port" => $_POST["cf_smtp_port"],
		"cf_smtp_secure" => $_POST["cf_smtp_secure"],
		"cf_email_subject" => $_POST["cf_email_subject"],
		"cf_template" => $_POST["cf_template"],
		"color_scheme" => $_POST["color_scheme"],
		"site_background_color" => $_POST["site_background_color"],
		"header_background_color" => $_POST["header_background_color"],
		"body_background_color" => $_POST["body_background_color"],
		"footer_background_color" => $_POST["footer_background_color"],
		"link_color" => $_POST["link_color"],
		"link_hover_color" => $_POST["link_hover_color"],
		"footer_link_color" => $_POST["footer_link_color"],
		"footer_link_hover_color" => $_POST["footer_link_hover_color"],
		"body_headers_color" => $_POST["body_headers_color"],
		"body_headers_border_color" => $_POST["body_headers_border_color"],
		"body_text_color" => $_POST["body_text_color"],
		"timeago_label_color" => $_POST["timeago_label_color"],
		"footer_headers_color" => $_POST["footer_headers_color"],
		"footer_headers_border_color" => $_POST["footer_headers_border_color"],
		"footer_text_color" => $_POST["footer_text_color"],
		"footer_timeago_label_color" => $_POST["footer_timeago_label_color"],
		"sentence_color" => $_POST["sentence_color"],
		"quote_color" => $_POST["quote_color"],
		"logo_text_color" => $_POST["logo_text_color"],
		"body_button_color" => $_POST["body_button_color"],
		"body_button_hover_color" => $_POST["body_button_hover_color"],
		"body_button_border_color" => $_POST["body_button_border_color"],
		"body_button_border_hover_color" => $_POST["body_button_border_hover_color"],
		"footer_button_color" => $_POST["footer_button_color"],
		"footer_button_hover_color" => $_POST["footer_button_hover_color"],
		"footer_button_border_color" => $_POST["footer_button_border_color"],
		"footer_button_border_hover_color" => $_POST["footer_button_border_hover_color"],
		"menu_position_text_color" => $_POST["menu_position_text_color"],
		"menu_position_hover_text_color" => $_POST["menu_position_hover_text_color"],
		"menu_position_background_color" => $_POST["menu_position_background_color"],
		"menu_position_hover_background_color" => $_POST["menu_position_hover_background_color"],
		"submenu_position_text_color" => $_POST["submenu_position_text_color"],
		"submenu_position_hover_text_color" => $_POST["submenu_position_hover_text_color"],
		"submenu_position_border_color" => $_POST["submenu_position_border_color"],
		"submenu_position_hover_border_color" => $_POST["submenu_position_hover_border_color"],
		"dropdownmenu_background_color" => $_POST["dropdownmenu_background_color"],
		"dropdownmenu_hover_background_color" => $_POST["dropdownmenu_hover_background_color"],
		"dropdownmenu_border_color" => $_POST["dropdownmenu_border_color"],
		"form_field_text_color" => $_POST["form_field_text_color"],
		"form_field_border_color" => $_POST["form_field_border_color"],
		"form_field_active_border_color" => $_POST["form_field_active_border_color"],
		"form_button_background_color" => $_POST["form_button_background_color"],
		"form_button_hover_background_color" => $_POST["form_button_hover_background_color"],
		"form_button_text_color" => $_POST["form_button_text_color"],
		"form_button_hover_text_color" => $_POST["form_button_hover_text_color"],
		"top_hint_background_color" => $_POST["top_hint_background_color"],
		"top_hint_text_color" => $_POST["top_hint_text_color"],
		"page_top_border_color" => $_POST["page_top_border_color"],
		"divider_background_color" => $_POST["divider_background_color"],
		"date_box_color" => $_POST["date_box_color"],
		"date_box_text_color" => $_POST["date_box_text_color"],
		"date_box_comments_number_color" => $_POST["date_box_comments_number_color"],
		"date_box_comments_number_text_color" => $_POST["date_box_comments_number_text_color"],
		"gallery_box_color" => $_POST["gallery_box_color"],
		"gallery_box_text_first_line_color" => $_POST["gallery_box_text_first_line_color"],
		"gallery_box_text_second_line_color" => $_POST["gallery_box_text_second_line_color"],
		"gallery_box_hover_color" => $_POST["gallery_box_hover_color"],
		"gallery_box_hover_text_first_line_color" => $_POST["gallery_box_hover_text_first_line_color"],
		"gallery_box_hover_text_second_line_color" => $_POST["gallery_box_hover_text_second_line_color"],
		"gallery_box_border_color" => $_POST["gallery_box_border_color"],
		"gallery_box_hover_border_color" => $_POST["gallery_box_hover_border_color"],
		"timetable_box_color" => $_POST["timetable_box_color"],
		"timetable_box_hover_color" => $_POST["timetable_box_hover_color"],
		"timetable_box_text_color" => $_POST["timetable_box_text_color"],
		"timetable_box_hover_text_color" => $_POST["timetable_box_hover_text_color"],
		"timetable_box_hours_text_color" => $_POST["timetable_box_hours_text_color"],
		"timetable_box_hover_hours_text_color" => $_POST["timetable_box_hover_hours_text_color"],
		"timetable_tip_box_color" => $_POST["timetable_tip_box_color"],
//		"gallery_details_box_border_color" => $_POST["gallery_details_box_border_color"],
//		"bread_crumb_border_color" => $_POST["bread_crumb_border_color"],
		"accordion_tab_color" => $_POST["accordion_tab_color"],
		/*"accordion_item_border_color" => $_POST["accordion_item_border_color"],
		"accordion_item_border_hover_color" => $_POST["accordion_item_border_hover_color"],
		"accordion_item_border_active_color" => $_POST["accordion_item_border_active_color"],*/
		"copyright_area_border_color" => $_POST["copyright_area_border_color"],
//		"comment_reply_button_color" => $_POST["comment_reply_button_color"],
//		"post_author_link_color" => $_POST["post_author_link_color"],
//		"contact_details_box_background_color" => $_POST["contact_details_box_background_color"],
		"header_layout_type" => $_POST["header_layout_type"],
		"header_top_sidebar" => $_POST["header_top_sidebar"],
		"header_top_right_sidebar" => $_POST["header_top_right_sidebar"],
		"header_font" => $_POST["header_font"],
		"header_font_subset" => (isset($_POST["header_font_subset"]) ? $_POST["header_font_subset"] : ""),
		"subheader_font" => $_POST["subheader_font"],
		"subheader_font_subset" => (isset($_POST["subheader_font_subset"]) ? $_POST["subheader_font_subset"] : ""),
	);
	update_option($themename . "_options", $theme_options);
	$system_message = ob_get_clean();
	$_POST["system_message"] = $system_message;
	echo json_encode($_POST);
	exit();
}
add_action('wp_ajax_' . $themename . '_save', $themename . '_save_options');

function get_new_widget_name( $widget_name, $widget_index ) 
{
	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array( );
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				$all_widget_array[] = $widget;
			}
		}
	}
	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
		$widget_index++;
	}
	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}
function download_import_file($file)
{	
	$url = "http://quanticalabs.com/wptest/medicenter/files/2013/04/" . $file["name"] . "." . $file["extension"];
	
	$attachment = get_page_by_title($file["name"], "OBJECT", "attachment");
	if($attachment!=null)
		$id = $attachment->ID;
	else
	{
		$tmp = download_url($url);
		$file_array = array(
			'name' => basename($url),
			'tmp_name' => $tmp
		);

		// Check for download errors
		if(is_wp_error($tmp)) 
		{
			@unlink($file_array['tmp_name']);
			return $tmp;
		}

		$id = media_handle_sideload($file_array, 0);
		// Check for handle sideload errors.
		if(is_wp_error($id))
		{
			@unlink($file_array['tmp_name']);
			return $id;
		}
	}
    return get_attached_file($id);
}
function medicenter_import_dummy()
{
	ob_start();
	$result = array("info" => "");
	//import dummy content
	$fetch_attachments = true;
	$file = download_import_file(array(
		"name" => "dummy_images.xml",
		"extension" => "gz"
	));
	if(!is_wp_error($file))
		require_once('importer/importer.php');
	else
		$result["info"] = "Import file dummy_images.xml.gz not found! Please upload import file manually into Media library. You can find this file in 'dummy content files' directory inside zip archive downloaded from ThemeForest.";
	if($result["info"]=="")
		$result["info"] = "dummy_images.xml file content has been imported successfully!";
	$system_message = ob_get_clean();
	$result["system_message"] = $system_message;
	echo "dummy_import_start" . json_encode($result) . "dummy_import_end";
	exit();
}
add_action('wp_ajax_' . $themename . '_import_dummy', $themename . '_import_dummy');

function medicenter_import_dummy2()
{
	ob_start();
	$result = array("info" => "");
	//import dummy content
	$fetch_attachments = false;
	$file = download_import_file(array(
		"name" => "dummy-" . $_POST["version"] . ".xml",
		"extension" => "gz"
	));
	if(!is_wp_error($file))
		require_once('importer/importer.php');
	else
	{
		$result["info"] .= "Import file: dummy-" . $_POST["version"] . ".xml.gz not found! Please upload import file manually into Media library. You can find this file in 'dummy content files' directory inside zip archive downloaded from ThemeForest.";
		exit();
	}
	//set menu
	$locations = get_theme_mod('nav_menu_locations');
	$menus = wp_get_nav_menus();
	$locations['main-menu'] = $menus[0]->term_id;
	set_theme_mod('nav_menu_locations', $locations);
	//set front page
	$home = get_page_by_title('HOME');
	update_option('page_on_front', $home->ID);
	update_option('show_on_front', 'page');
	//widget import
	$response = array(
		'what' => 'widget_import_export',
		'action' => 'import_submit'
	);

	$widgets = isset( $_POST['widgets'] ) ? $_POST['widgets'] : false;
	$json_file = download_import_file(array(
		"name" => "widget_data-" . $_POST["version"],
		"extension" => "json"
	));
	if(!is_wp_error($json_file))
	{
		$json_data = file_get_contents($json_file);
		$json_data = json_decode( $json_data, true );
		$sidebars_data = $json_data[0];
		$widget_data = $json_data[1];
		$current_sidebars = get_option( 'sidebars_widgets' );
		//remove inactive widgets
		$current_sidebars['wp_inactive_widgets'] = array();
		update_option('sidebars_widgets', $current_sidebars);
		$new_widgets = array( );
		foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

			foreach ( $import_widgets as $import_widget ) :
				//if the sidebar exists
				//if ( isset( $current_sidebars[$import_sidebar] ) ) :
					$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
					$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
					$current_widget_data = get_option( 'widget_' . $title );
					$new_widget_name = get_new_widget_name( $title, $index );
					$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

					if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
						while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
							$new_index++;
						}
					}
					$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
					if ( array_key_exists( $title, $new_widgets ) ) {
						$new_widgets[$title][$new_index] = $widget_data[$title][$index];
						$multiwidget = $new_widgets[$title]['_multiwidget'];
						unset( $new_widgets[$title]['_multiwidget'] );
						$new_widgets[$title]['_multiwidget'] = $multiwidget;
					} else {
						$current_widget_data[$new_index] = $widget_data[$title][$index];
						$current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : "";
						$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : "";
						$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
						unset( $current_widget_data['_multiwidget'] );
						$current_widget_data['_multiwidget'] = $multiwidget;
						$new_widgets[$title] = $current_widget_data;
					}

				//endif;
			endforeach;
		endforeach;
		if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
			update_option( 'sidebars_widgets', $current_sidebars );

			foreach ( $new_widgets as $title => $content )
				update_option( 'widget_' . $title, $content );

		}
	}
	else
	{
		$result["info"] .= "Widgets data file not found! Please upload widgets data file manually.";
		exit();
	}
	if($result["info"]=="")
	{
		//set shop page
		$shop = get_page_by_title('Shop');
		update_option('woocommerce_shop_page_id', $shop->ID);
		//set my-account page
		$myaccount = get_page_by_title('My Account');
		update_option('woocommerce_myaccount_page_id', $myaccount->ID);
		//set cart page
		$cart = get_page_by_title('Cart');
		update_option('woocommerce_cart_page_id', $cart->ID);
		//set checkout page
		$checkout = get_page_by_title('Checkout');
		update_option('woocommerce_checkout_page_id', $checkout->ID);
		
		$hide_notice = sanitize_text_field("install");
		$notices = array_diff(get_option('woocommerce_admin_notices', array()), array("install"));
		update_option('woocommerce_admin_notices', $notices);
		do_action('woocommerce_hide_install_notice');
		
		$result["info"] = "dummy-" . $_POST["version"] . ".xml file content and widgets settings has been imported successfully!";		
		$system_message = ob_get_clean();
		$result["system_message"] = $system_message;
	}
	
	echo "dummy_import_start" . json_encode($result) . "dummy_import_end";
	exit();
}
add_action('wp_ajax_' . $themename . '_import_dummy2', $themename . '_import_dummy2');

function medicenter_import_shop_dummy()
{
	ob_start();
	$result = array("info" => "");
	//import dummy content
	$fetch_attachments = true;
	$file = download_import_file(array(
		"name" => "dummy-shop.xml",
		"extension" => "gz"
	));
	if(!is_wp_error($file))
		require_once('importer/importer.php');
	else
		$result["info"] = "Import file dummy_shop.xml.gz not found! Please upload import file manually into Media library. You can find this file in 'dummy content files' directory inside zip archive downloaded from ThemeForest.";
	if($result["info"]=="")
		$result["info"] = "dummy_shop.xml file content has been imported successfully!";
	$system_message = ob_get_clean();
	$result["system_message"] = $system_message;
	echo "dummy_import_start" . json_encode($result) . "dummy_import_end";
	exit();
}
add_action('wp_ajax_' . $themename . '_import_shop_dummy', $themename . '_import_shop_dummy');

function medicenter_options() 
{
	global $themename;
	/*if($_POST["action"]==$themename . "_save")
	{
		$theme_options = (array)get_option($themename . "_options");
		if($_POST[$themename . "_submit"]=="Save Main Options")
		{
			$theme_options_main = array(
				"logo_url" => $_POST["logo_url"],
				"logo_text" => $_POST["logo_text"],
				"footer_text_left" => $_POST["footer_text_left"],
				"footer_text_right" => $_POST["footer_text_right"],
				"responsive" => (int)$_POST["responsive"],
				"layout" => $_POST["layout"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_main));
			$selected_tab = 0;
		}
		else if($_POST[$themename . "_submit"]=="Save Slider Options")
		{
			$theme_options_backgrounds = array(
				"slider_image_url" => array_filter($_POST["slider_image_url"]),
				"slider_image_title" => array_filter($_POST["slider_image_title"]),
				"slider_image_subtitle" => array_filter($_POST["slider_image_subtitle"]),
				"slider_image_link" => array_filter($_POST["slider_image_link"]),
				"slider_autoplay" => $_POST["slider_autoplay"],
				"slide_interval" => (int)$_POST["slide_interval"],
				"slider_effect" => $_POST["slider_effect"],
				"slider_transition" => $_POST["slider_transition"],
				"slider_transition_speed" => (int)$_POST["slider_transition_speed"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_backgrounds));
			$selected_tab = 1;
		}
		else if($_POST[$themename . "_submit"]=="Save Contact Form Options")
		{
			$theme_options_contact_form = array(
				"cf_admin_name" => $_POST["cf_admin_name"],
				"cf_admin_email" => $_POST["cf_admin_email"],
				"cf_smtp_host" => $_POST["cf_smtp_host"],
				"cf_smtp_username" => $_POST["cf_smtp_username"],
				"cf_smtp_password" => $_POST["cf_smtp_password"],
				"cf_smtp_port" => $_POST["cf_smtp_port"],
				"cf_smtp_secure" => $_POST["cf_smtp_secure"],
				"cf_email_subject" => $_POST["cf_email_subject"],
				"cf_template" => $_POST["cf_template"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_contact_form));
			$selected_tab = 2;
		}
		else if($_POST[$themename . "_submit"]=="Save Colors Options")
		{
			$theme_options_colors = array(
				"header_background_color" => $_POST["header_background_color"],
				"body_background_color" => $_POST["body_background_color"],
				"footer_background_color" => $_POST["footer_background_color"],
				"link_color" => $_POST["link_color"],
				"link_hover_color" => $_POST["link_hover_color"],
				"body_headers_color" => $_POST["body_headers_color"],
				"body_headers_border_color" => $_POST["body_headers_border_color"],
				"body_text_color" => $_POST["body_text_color"],
				"body_text2_color" => $_POST["body_text2_color"],
				"footer_headers_color" => $_POST["footer_headers_color"],
				"footer_headers_border_color" => $_POST["footer_headers_border_color"],
				"footer_text_color" => $_POST["footer_text_color"],
				"timeago_label_color" => $_POST["timeago_label_color"],
				"sentence_color" => $_POST["sentence_color"],
				"logo_first_part_text_color" => $_POST["logo_first_part_text_color"],
				"logo_second_part_text_color" => $_POST["logo_second_part_text_color"],
				"body_button_color" => $_POST["body_button_color"],
				"body_button_hover_color" => $_POST["body_button_hover_color"],
				"body_button_border_color" => $_POST["body_button_border_color"],
				"body_button_border_hover_color" => $_POST["body_button_border_hover_color"],
				"footer_button_color" => $_POST["footer_button_color"],
				"footer_button_hover_color" => $_POST["footer_button_hover_color"],
				"footer_button_border_color" => $_POST["footer_button_border_color"],
				"footer_button_border_hover_color" => $_POST["footer_button_border_hover_color"],
				"menu_link_color" => $_POST["menu_link_color"],
				"menu_link_border_color" => $_POST["menu_link_border_color"],
				"menu_active_color" => $_POST["menu_active_color"],
				"menu_active_border_color" => $_POST["menu_active_border_color"],
				"menu_hover_color" => $_POST["menu_hover_color"],
				"menu_hover_border_color" => $_POST["menu_hover_border_color"],
				"submenu_background_color" => $_POST["submenu_background_color"],
				"submenu_hover_background_color" => $_POST["submenu_hover_background_color"],
				"submenu_color" => $_POST["submenu_color"],
				"submenu_hover_color" => $_POST["submenu_hover_color"],
				"form_hint_color" => $_POST["form_hint_color"],
				"form_field_text_color" => $_POST["form_field_text_color"],
				"form_field_border_color" => $_POST["form_field_border_color"],
				"form_field_active_border_color" => $_POST["form_field_active_border_color"],
				"date_box_color" => $_POST["date_box_color"],
				"date_box_text_color" => $_POST["date_box_text_color"],
				"date_box_comments_number_text_color" => $_POST["date_box_comments_number_text_color"],
				"date_box_comments_number_border_color" => $_POST["date_box_comments_number_border_color"],
				"date_box_comments_number_hover_border_color" => $_POST["date_box_comments_number_hover_border_color"],
				"gallery_box_color" => $_POST["gallery_box_color"],
				"gallery_box_text_first_line_color" => $_POST["gallery_box_text_first_line_color"],
				"gallery_box_text_second_line_color" => $_POST["gallery_box_text_second_line_color"],
				"gallery_box_hover_color" => $_POST["gallery_box_hover_color"],
				"gallery_box_hover_text_first_line_color" => $_POST["gallery_box_hover_text_first_line_color"],
				"gallery_box_hover_text_second_line_color" => $_POST["gallery_box_hover_text_second_line_color"],
				"timetable_box_color" => $_POST["timetable_box_color"],
				"timetable_box_hover_color" => $_POST["timetable_box_hover_color"],
				"gallery_details_box_border_color" => $_POST["gallery_details_box_border_color"],
				"bread_crumb_border_color" => $_POST["bread_crumb_border_color"],
				"accordion_item_border_color" => $_POST["accordion_item_border_color"],
				"accordion_item_border_hover_color" => $_POST["accordion_item_border_hover_color"],
				"accordion_item_border_active_color" => $_POST["accordion_item_border_active_color"],
				"copyright_area_border_color" => $_POST["copyright_area_border_color"],
				"comment_reply_button_color" => $_POST["comment_reply_button_color"],
				"post_author_link_color" => $_POST["post_author_link_color"],
				"contact_details_box_background_color" => $_POST["contact_details_box_background_color"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_colors));
			$selected_tab = 3;
		}
		else if($_POST[$themename . "_submit"]=="Save Fonts Options")
		{
			$theme_options_fonts = array(
				"header_font" => $_POST["header_font"],
				"subheader_font" => $_POST["subheader_font"]
			);
			update_option($themename . "_options", array_merge($theme_options, $theme_options_fonts));
			$selected_tab = 4;
		}
		else
		{
			$theme_options = array(
				"logo_url" => $_POST["logo_url"],
				"logo_first_part_text" => $_POST["logo_first_part_text"],
				"logo_second_part_text" => $_POST["logo_second_part_text"],
				"footer_text_left" => $_POST["footer_text_left"],
				"footer_text_right" => $_POST["footer_text_right"],
				"responsive" => (int)$_POST["responsive"],
				"slider_image_url" => array_filter($_POST["slider_image_url"]),
				"slider_image_title" => array_filter($_POST["slider_image_title"]),
				"slider_image_subtitle" => array_filter($_POST["slider_image_subtitle"]),
				"slider_image_link" => array_filter($_POST["slider_image_link"]),
				"slider_autoplay" => $_POST["slider_autoplay"],
				"slide_interval" => (int)$_POST["slide_interval"],
				"slider_effect" => $_POST["slider_effect"],
				"slider_transition" => $_POST["slider_transition"],
				"slider_transition_speed" => (int)$_POST["slider_transition_speed"],
				"footer_text_left" => $_POST["footer_text_left"],
				"footer_text_right" => $_POST["footer_text_right"],
				"cf_admin_name" => $_POST["cf_admin_name"],
				"cf_admin_email" => $_POST["cf_admin_email"],
				"cf_smtp_host" => $_POST["cf_smtp_host"],
				"cf_smtp_username" => $_POST["cf_smtp_username"],
				"cf_smtp_password" => $_POST["cf_smtp_password"],
				"cf_smtp_port" => $_POST["cf_smtp_port"],
				"cf_smtp_secure" => $_POST["cf_smtp_secure"],
				"cf_email_subject" => $_POST["cf_email_subject"],
				"cf_template" => $_POST["cf_template"],
				"header_background_color" => $_POST["header_background_color"],
				"body_background_color" => $_POST["body_background_color"],
				"footer_background_color" => $_POST["footer_background_color"],
				"link_color" => $_POST["link_color"],
				"link_hover_color" => $_POST["link_hover_color"],
				"body_headers_color" => $_POST["body_headers_color"],
				"body_headers_border_color" => $_POST["body_headers_border_color"],
				"body_text_color" => $_POST["body_text_color"],
				"body_text2_color" => $_POST["body_text2_color"],
				"footer_headers_color" => $_POST["footer_headers_color"],
				"footer_headers_border_color" => $_POST["footer_headers_border_color"],
				"footer_text_color" => $_POST["footer_text_color"],
				"timeago_label_color" => $_POST["timeago_label_color"],
				"sentence_color" => $_POST["sentence_color"],
				"logo_first_part_text_color" => $_POST["logo_first_part_text_color"],
				"logo_second_part_text_color" => $_POST["logo_second_part_text_color"],
				"body_button_color" => $_POST["body_button_color"],
				"body_button_hover_color" => $_POST["body_button_hover_color"],
				"body_button_border_color" => $_POST["body_button_border_color"],
				"body_button_border_hover_color" => $_POST["body_button_border_hover_color"],
				"footer_button_color" => $_POST["footer_button_color"],
				"footer_button_hover_color" => $_POST["footer_button_hover_color"],
				"footer_button_border_color" => $_POST["footer_button_border_color"],
				"footer_button_border_hover_color" => $_POST["footer_button_border_hover_color"],
				"menu_link_color" => $_POST["menu_link_color"],
				"menu_link_border_color" => $_POST["menu_link_border_color"],
				"menu_active_color" => $_POST["menu_active_color"],
				"menu_active_border_color" => $_POST["menu_active_border_color"],
				"menu_hover_color" => $_POST["menu_hover_color"],
				"menu_hover_border_color" => $_POST["menu_hover_border_color"],
				"submenu_background_color" => $_POST["submenu_background_color"],
				"submenu_hover_background_color" => $_POST["submenu_hover_background_color"],
				"submenu_color" => $_POST["submenu_color"],
				"submenu_hover_color" => $_POST["submenu_hover_color"],
				"form_hint_color" => $_POST["form_hint_color"],
				"form_field_text_color" => $_POST["form_field_text_color"],
				"form_field_border_color" => $_POST["form_field_border_color"],
				"form_field_active_border_color" => $_POST["form_field_active_border_color"],
				"date_box_color" => $_POST["date_box_color"],
				"date_box_text_color" => $_POST["date_box_text_color"],
				"date_box_comments_number_text_color" => $_POST["date_box_comments_number_text_color"],
				"date_box_comments_number_border_color" => $_POST["date_box_comments_number_border_color"],
				"date_box_comments_number_hover_border_color" => $_POST["date_box_comments_number_hover_border_color"],
				"gallery_box_text_first_line_color" => $_POST["gallery_box_text_first_line_color"],
				"gallery_box_text_second_line_color" => $_POST["gallery_box_text_second_line_color"],
				"gallery_box_hover_color" => $_POST["gallery_box_hover_color"],
				"gallery_box_hover_text_first_line_color" => $_POST["gallery_box_hover_text_first_line_color"],
				"gallery_box_hover_text_second_line_color" => $_POST["gallery_box_hover_text_second_line_color"],
				"timetable_box_color" => $_POST["timetable_box_color"],
				"timetable_box_hover_color" => $_POST["timetable_box_hover_color"],
				"gallery_details_box_border_color" => $_POST["gallery_details_box_border_color"],
				"bread_crumb_border_color" => $_POST["bread_crumb_border_color"],
				"accordion_item_border_color" => $_POST["accordion_item_border_color"],
				"accordion_item_border_hover_color" => $_POST["accordion_item_border_hover_color"],
				"accordion_item_border_active_color" => $_POST["accordion_item_border_active_color"],
				"copyright_area_border_color" => $_POST["copyright_area_border_color"],
				"comment_reply_button_color" => $_POST["comment_reply_button_color"],
				"post_author_link_color" => $_POST["post_author_link_color"],
				"contact_details_box_background_color" => $_POST["contact_details_box_background_color"],
				"header_font" => $_POST["header_font"],
				"subheader_font" => $_POST["subheader_font"]
			);
			update_option($themename . "_options", $theme_options);
			$selected_tab = 0;
		}
	}*/
	$theme_options = array(
		"favicon_url" => '',
		"logo_url" => '',
		"logo_text" => '',
		"footer_text_left" => '',
		"footer_text_right" => '',
		"sticky_menu" => '',
		"responsive" => '',
		"layout" => '',
		"layout_picker" => '',
		"direction" => '',
		"animations" => '',
		"collapsible_mobile_submenus" => '',
		"google_api_code" => '',
		"ga_tracking_code" => '',
		"home_page_top_hint" => '',
		"cf_admin_name" => '',
		"cf_admin_email" => '',
		"cf_smtp_host" => '',
		"cf_smtp_username" => '',
		"cf_smtp_password" => '',
		"cf_smtp_port" => '',
		"cf_smtp_secure" => '',
		"cf_email_subject" => '',
		"cf_template" => '',
		"color_scheme" => '',
		"site_background_color" => '',
		"header_background_color" => '',
		"body_background_color" => '',
		"footer_background_color" => '',
		"link_color" => '',
		"link_hover_color" => '',
		"footer_link_color" => '',
		"footer_link_hover_color" => '',
		"body_headers_color" => '',
		"body_headers_border_color" => '',
		"body_text_color" => '',
		"timeago_label_color" => '',
		"footer_headers_color" => '',
		"footer_headers_border_color" => '',
		"footer_text_color" => '',
		"footer_timeago_label_color" => '',
		"sentence_color" => '',
		"quote_color" => '',
		"logo_text_color" => '',
		"body_button_color" => '',
		"body_button_hover_color" => '',
		"body_button_border_color" => '',
		"body_button_border_hover_color" => '',
		"footer_button_color" => '',
		"footer_button_hover_color" => '',
		"footer_button_border_color" => '',
		"footer_button_border_hover_color" => '',
		"menu_position_text_color" => '',
		"menu_position_hover_text_color" => '',
		"menu_position_background_color" => '',
		"menu_position_hover_background_color" => '',
		"submenu_position_text_color" => '',
		"submenu_position_hover_text_color" => '',
		"submenu_position_border_color" => '',
		"submenu_position_hover_border_color" => '',
		"dropdownmenu_background_color" => '',
		"dropdownmenu_hover_background_color" => '',
		"dropdownmenu_border_color" => '',
		"form_field_text_color" => '',
		"form_field_border_color" => '',
		"form_field_active_border_color" => '',
		"form_button_background_color" => '',
		"form_button_hover_background_color" => '',
		"form_button_text_color" => '',
		"form_button_hover_text_color" => '',
		"top_hint_background_color" => '',
		"top_hint_text_color" => '',
		"page_top_border_color" => '',
		"divider_background_color" => '',
		"date_box_color" => '',
		"date_box_text_color" => '',
		"date_box_comments_number_color" => '',
		"date_box_comments_number_text_color" => '',
		"gallery_box_color" => '',
		"gallery_box_text_first_line_color" => '',
		"gallery_box_text_second_line_color" => '',
		"gallery_box_hover_color" => '',
		"gallery_box_hover_text_first_line_color" => '',
		"gallery_box_hover_text_second_line_color" => '',
		"gallery_box_border_color" => '',
		"gallery_box_hover_border_color" => '',
		"timetable_box_color" => '',
		"timetable_box_hover_color" => '',
		"timetable_box_text_color" => '',
		"timetable_box_hover_text_color" => '',
		"timetable_box_hours_text_color" => '',
		"timetable_box_hover_hours_text_color" => '',
		"timetable_tip_box_color" => '',
		"accordion_tab_color" => '',
		"copyright_area_border_color" => '',
		"header_layout_type" => '',
		"header_top_sidebar" => '',
		"header_top_right_sidebar" => '',
		"header_font" => '',
		"header_font_subset" => '',
		"subheader_font" => '',
		"subheader_font_subset" => ''
	);
	$theme_options = theme_stripslashes_deep(array_merge($theme_options, get_option($themename . "_options")));
	$sliderAllShortcodeIds = array();
	$allOptions = wp_load_alloptions();
	foreach($allOptions as $key => $value)
	{
		if(substr($key, 0, 26)=="medicenter_slider_settings")
			$sliderAllShortcodeIds[] = $key;
	}
	//sort slider ids
	sort($sliderAllShortcodeIds);
?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2><?php echo ucfirst('medicenter');?> Options</h2>
	</div>
	<?php
	if(isset($_POST["action"]) && $_POST["action"]==$themename . "_save")
	{
	?>
	<div class="updated"> 
		<p>
			<strong>
				<?php _e('Options saved', 'medicenter'); ?>
			</strong>
		</p>
	</div>
	<?php
	}
	//get google fonts
	$fontsArray = mc_get_google_fonts();
	?>
	<form class="theme_options" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="theme-options-panel">
		<div class="header">
			<div class="header_left">
				<h3>
					<a href="http://themeforest.net/user/QuanticaLabs/portfolio?ref=QuanticaLabs" title="QuanticaLabs">
						QuanticaLabs
					</a>
				</h3>
				<h5>Theme Options</h5>
			</div>
			<div class="header_right">
				<div class="description">
					<h3>
						<a href="http://themeforest.net/item/medicenter-responsive-medical-wordpress-theme/4718613?ref=QuanticaLabs" title="MediCenter - Responsive Medical Health WordPress Theme">
							MediCenter
						</a>
					</h3>
					<h5>Responsive Medical Health WordPress Theme</h5>
				</div>
				<a class="logo" href="http://themeforest.net/user/QuanticaLabs/portfolio?ref=QuanticaLabs" title="QuanticaLabs">
					&nbsp;
				</a>
			</div>
		</div>
		<div class="content clearfix">
			<ul class="menu">
				<li>
					<a href='#tab-main' class="selected">
						<?php _e('Main', 'medicenter'); ?>
						<span class="general"></span>
					</a>
				</li>
				<li>
					<a href="#tab-slider">
						<?php _e('Slider', 'medicenter'); ?>
						<span class="slider"></span>
					</a>
				</li>
				<li>
					<a href="#tab-contact-form">
						<?php _e('Contact Form', 'medicenter'); ?>
						<span class="contact_form"></span>
					</a>
				</li>
				<li>
					<a href="#tab-colors">
						<?php _e('Colors', 'medicenter'); ?>
						<span class="colors"></span>
					</a>
					<ul class="submenu">
						<li>
							<a href="#tab-colors_general">
								<?php _e('General', 'medicenter'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_text">
								<?php _e('Text', 'medicenter'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_buttons">
								<?php _e('Buttons', 'medicenter'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_menu">
								<?php _e('Menu', 'medicenter'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_forms">
								<?php _e('Forms', 'medicenter'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_miscellaneous">
								<?php _e('Miscellaneous', 'medicenter'); ?>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#tab-header">
						<?php _e('Header', 'medicenter'); ?>
						<span class="header"></span>
					</a>
				</li>
				<li>
					<a href="#tab-fonts">
						<?php _e('Fonts', 'medicenter'); ?>
						<span class="font"></span>
					</a>
				</li>
			</ul>
			<div id="tab-main" class="settings" style="display: block;">
				<h3><?php _e('Main', 'medicenter'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="logo_url"><?php _e('DUMMY CONTENT IMPORT', 'medicenter'); ?></label>
						<select id="import_dummy_version" name="import_dummy_version" style="float: left; margin-right: 10px;">
							<option value="blue"><?php _e('blue', 'medicenter'); ?></option>
							<option value="blue_no_animations"><?php _e('blue (no animations)', 'medicenter'); ?></option>
							<option value="green"><?php _e('green', 'medicenter'); ?></option>
							<option value="green_no_animations"><?php _e('green (no animations)', 'medicenter'); ?></option>
							<option value="orange"><?php _e('orange', 'medicenter'); ?></option>
							<option value="orange_no_animations"><?php _e('orange (no animations)', 'medicenter'); ?></option>
							<option value="red"><?php _e('red', 'medicenter'); ?></option>
							<option value="red_no_animations"><?php _e('red (no animations)', 'medicenter'); ?></option>
							<option value="turquoise"><?php _e('turquoise', 'medicenter'); ?></option>
							<option value="turquoise_no_animations"><?php _e('turquoise (no animations)', 'medicenter'); ?></option>
							<option value="violet"><?php _e('violet', 'medicenter'); ?></option>
							<option value="violet_no_animations"><?php _e('violet (no animations)', 'medicenter'); ?></option>
						</select>
						<input type="button" class="button" name="<?php echo $themename;?>_import_dummy" id="import_dummy" value="<?php _e('Import dummy content', 'medicenter'); ?>" />
						<img id="dummy_content_preloader" src="<?php echo get_template_directory_uri();?>/admin/images/ajax-loader.gif" />
						<img id="dummy_content_tick" src="<?php echo get_template_directory_uri();?>/admin/images/tick.png" />
						<div id="dummy_content_info"></div>
						<div class="clearfix"></div>
					</li>
					<?php
					if(is_plugin_active('woocommerce/woocommerce.php')):
					?>
					<li>
						<label for="import_shop_dummy"><?php _e('DUMMY SHOP CONTENT IMPORT', 'medicenter'); ?></label>
						<input type="button" class="button" name="<?php echo esc_attr($themename);?>_import_shop_dummy" id="import_shop_dummy" value="<?php esc_attr_e('Import shop dummy content', 'medicenter'); ?>" />
						<img id="dummy_shop_content_preloader" src="<?php echo get_template_directory_uri();?>/admin/images/ajax-loader.gif" />
						<img id="dummy_shop_content_tick" src="<?php echo get_template_directory_uri();?>/admin/images/tick.png" />
						<div id="dummy_shop_content_info"></div>
					</li>
					<?php
					endif;
					?>
					<li>
						<label for="favicon_url"><?php _e('FAVICON URL', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo (isset($theme_options["favicon_url"]) ? esc_attr($theme_options["favicon_url"]) : ""); ?>" id="favicon_url" name="favicon_url">
							<input type="button" class="button" name="<?php echo esc_attr($themename);?>_upload_button" id="favicon_url_upload_button" value="<?php esc_attr_e('Insert favicon', 'medicenter'); ?>" />
						</div>
					</li>
					<li>
						<label for="logo_url"><?php _e('LOGO URL', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo isset($theme_options["logo_url"]) ? esc_attr($theme_options["logo_url"]) : ""; ?>" id="logo_url" name="logo_url">
							<input type="button" class="button" name="<?php echo $themename;?>_upload_button" id="logo_url_upload_button" value="<?php _e('Insert logo', 'medicenter'); ?>" />
						</div>
					</li>
					<li>
						<label for="logo_text"><?php _e('LOGO TEXT', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo isset($theme_options["logo_text"]) ? esc_attr($theme_options["logo_text"]) : ""; ?>" id="logo_text" name="logo_text">
						</div>
					</li>
					<li>
						<label for="footer_text_left"><?php _e('FOOTER TEXT LEFT', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo isset($theme_options["footer_text_left"]) ? esc_attr($theme_options["footer_text_left"]) : ""; ?>" id="footer_text_left" name="footer_text_left">
						</div>
					</li>
					<li>
						<label for="footer_text_right"><?php _e('FOOTER TEXT RIGHT', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo isset($theme_options["footer_text_right"]) ? esc_attr($theme_options["footer_text_right"]) : ""; ?>" id="footer_text_right" name="footer_text_right">
						</div>
					</li>
					<li>
						<label for="home_page_top_hint"><?php _e('HOME PAGE TOP HINT', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo isset($theme_options["home_page_top_hint"]) ? esc_attr($theme_options["home_page_top_hint"]) : ""; ?>" id="home_page_top_hint" name="home_page_top_hint">
						</div>
					</li>
					<li>
						<label for="sticky_menu"><?php _e('STICKY MENU', 'medicenter'); ?></label>
						<div>
							<select id="sticky_menu" name="sticky_menu">
								<option value="0"<?php echo (isset($theme_options["sticky_menu"]) && (int)$theme_options["sticky_menu"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'medicenter'); ?></option>
								<option value="1"<?php echo (isset($theme_options["sticky_menu"]) && (int)$theme_options["sticky_menu"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="responsive"><?php _e('RESPONSIVE', 'medicenter'); ?></label>
						<div>
							<select id="responsive" name="responsive">
								<option value="1"<?php echo (isset($theme_options["responsive"]) && (int)$theme_options["responsive"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'medicenter'); ?></option>
								<option value="0"<?php echo (isset($theme_options["responsive"]) && (int)$theme_options["responsive"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="layout"><?php _e('LAYOUT', 'medicenter'); ?></label>
						<div>
							<select id="layout" name="layout">
								<option value="wide"<?php echo (isset($theme_options["layout"]) && $theme_options["layout"]=="wide" ? " selected='selected'" : "") ?>><?php _e('wide', 'medicenter'); ?></option>
								<option value="boxed"<?php echo (isset($theme_options["layout"]) && $theme_options["layout"]=="boxed" ? " selected='selected'" : "") ?>><?php _e('boxed', 'medicenter'); ?></option>
								<option value="fullwidth"<?php echo (isset($theme_options["layout"]) && $theme_options["layout"]=="fullwidth" ? " selected='selected'" : "") ?>><?php _e('full width', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="layout_picker"><?php _e('SHOW LAYOUT PICKER', 'medicenter'); ?></label>
						<div>
							<select id="layout_picker" name="layout_picker">
								<option value="0"<?php echo (isset($theme_options["layout_picker"]) && !(int)$theme_options["layout_picker"] ? " selected='selected'" : "") ?>><?php _e('no', 'medicenter'); ?></option>
								<option value="1"<?php echo (isset($theme_options["layout_picker"]) && (int)$theme_options["layout_picker"] ? " selected='selected'" : "") ?>><?php _e('yes', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="direction"><?php _e('Direction', 'medicenter'); ?></label>
						<div>
							<select id="direction" name="direction">
								<option value="default" <?php echo (isset($theme_options["direction"]) && $theme_options["direction"]=="default" ? " selected='selected'" : "") ?>><?php _e('Default', 'medicenter'); ?></option>
								<option value="ltr" <?php echo (isset($theme_options["direction"]) && $theme_options["direction"]=="ltr" ? " selected='selected'" : "") ?>><?php _e('LTR', 'medicenter'); ?></option>
								<option value="rtl" <?php echo (isset($theme_options["direction"]) && $theme_options["direction"]=="rtl" ? " selected='selected'" : "") ?>><?php _e('RTL', 'medicenter'); ?></option>	
							</select>
						</div>
					</li>
					<li>
						<label for="animations"><?php _e('Animations', 'medicenter'); ?></label>
						<div>
							<select id="animations" name="animations">
								<option value="1" <?php echo (isset($theme_options["animations"]) && (int)$theme_options["animations"]==1 ? " selected='selected'" : "") ?>><?php _e('enabled', 'medicenter'); ?></option>
								<option value="0" <?php echo (isset($theme_options["animations"]) && (int)$theme_options["animations"]==0 ? " selected='selected'" : "") ?>><?php _e('disabled', 'medicenter'); ?></option>	
							</select>
						</div>
					</li>
					<li>
						<label for="collapsible_mobile_submenus"><?php _e('Collapsible mobile submenus', 'medicenter'); ?></label>
						<div>
							<select id="collapsible_mobile_submenus" name="collapsible_mobile_submenus">
								<option value="1"<?php echo (!isset($theme_options["collapsible_mobile_submenus"]) || (int)$theme_options["collapsible_mobile_submenus"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'medicenter'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["collapsible_mobile_submenus"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="google_api_code"><?php _e('Google Maps API Key', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["google_api_code"]); ?>" id="google_api_code" name="google_api_code">
							<label class="small_label"><?php printf(__('You can generate API Key <a href="%s" target="_blank" title="Generate API Key">here</a>', 'medicenter'), "https://developers.google.com/maps/documentation/javascript/get-api-key"); ?></label>
						</div>
					</li>
					<li>
						<label for="ga_tracking_code"><?php _e('Google Analytics tracking code', 'medicenter'); ?></label>
						<div>
							<textarea id="ga_tracking_code" name="ga_tracking_code"><?php echo (isset($theme_options["ga_tracking_code"]) ? esc_attr($theme_options["ga_tracking_code"]) : ""); ?></textarea>							
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-slider" class="settings">
				<h3><?php _e('Slider', 'medicenter'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="edit_slider_id"><?php _e('Choose slider id for edit', 'medicenter'); ?></label>
						<div>
							<select id="edit_slider_id" name="edit_slider_id">
								<option value="-1">choose...</option>
								<?php
									for($i=0; $i<count($sliderAllShortcodeIds); $i++)
										echo "<option value='$sliderAllShortcodeIds[$i]'>" . substr($sliderAllShortcodeIds[$i], 27) . "</option>";
								?>
							</select>
							<img style="display: none; cursor: pointer;" id="slider_delete_button" src="<?php echo get_template_directory_uri();?>/images/delete.png" alt="del" title="<?php _e('Delete this slider', 'medicenter'); ?>" />
							<span id="slider_ajax_loader" style="display: none;"><img style="margin-bottom: -3px;" src="<?php echo get_template_directory_uri();?>/admin/images/ajax-loader.gif" /></span>
						</div>
					</li>
					<li class="slider_image_title_row">
						<label><?php _e('Or type new slider id to create new one', 'medicenter'); ?></label>
						<div>
							<input class="regular-text" type="text" id="slider_id" name="slider_id" value="" />
						</div>
					</li>
					<?php
					$slides_count = !empty($theme_options["slider_image_url"]) ? count($theme_options["slider_image_url"]) : 0;
					if($slides_count==0)
						$slides_count = 3;
					for($i=0; $i<$slides_count; $i++)
					{
					?>
					<li class="slider_image_url_row">
						<label><?php _e('SLIDER IMAGE URL', 'medicenter'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_url_<?php echo ($i+1); ?>" name="slider_image_url[]" value="" />
							<input type="button" class="button" name="<?php echo $themename;?>_upload_button" id="<?php echo $themename;?>_slider_image_url_button_<?php echo ($i+1); ?>" value="<?php _e('Browse', 'medicenter'); ?>" />
						</div>
					</li>
					<li class="slider_image_title_row">
						<label><?php _e('SLIDER IMAGE TITLE', 'medicenter'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_title_<?php echo ($i+1); ?>" name="slider_image_title[]" value="" />
						</div>
					</li>
					<li class="slider_image_subtitle_row">
						<label><?php _e('SLIDER IMAGE SUBTITLE', 'medicenter'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_subtitle_<?php echo ($i+1); ?>" name="slider_image_subtitle[]" value="" />
						</div>
					</li>
					<li class="slider_image_link_row">
						<label><?php _e('SLIDER IMAGE LINK', 'medicenter'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_link_<?php echo ($i+1); ?>" name="slider_image_link[]" value="" />
						</div>
					</li>
					<?php
					}
					?>
					<li>
						<input type="button" class="button" name="<?php echo $themename;?>_add_new_button" id="<?php echo $themename;?>_add_new_button" value="<?php _e('Add slider image', 'medicenter'); ?>" />
					</li>
					<li>
						<label><?php _e('AUTOPLAY', 'medicenter'); ?></label>
						<div>
							<select id="slider_autoplay" name="slider_autoplay">
								<option value="1"><?php _e('yes', 'medicenter'); ?></option>
								<option value="0"><?php _e('no', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label><?php _e('NAVIGATION', 'medicenter'); ?></label>
						<div>
							<select id="slider_navigation" name="slider_navigation">
								<option value="1"><?php _e('yes', 'medicenter'); ?></option>
								<option value="0"><?php _e('no', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<?php
					/*<li>
						<label><?php _e('PAUSE ON HOVER', 'medicenter'); ?></label>
						<div>
							<select id="slider_pause_on_hover" name="slider_pause_on_hover">
								<option value="0"><?php _e('no', 'medicenter'); ?></option>
								<option value="1"><?php _e('yes', 'medicenter'); ?></option>
							</select>
						</div>
					</li>*/
					?>
					<li>
						<label for="slider_height"><?php _e('SLIDER HEIGHT (px):', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" id="slider_height" name="slider_height" value="670" />
						</div>
					</li>
					<li>
						<label for="slide_interval"><?php _e('SLIDE INTERVAL (ms):', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" id="slide_interval" name="slide_interval" value="5000" />
						</div>
					</li>
					<li>
						<label for="slider_effect"><?php _e('EFFECT:', 'medicenter'); ?></label>
						<div>
							<select id="slider_effect" name="slider_effect">
								<option value="scroll"><?php _e('scroll', 'medicenter'); ?></option>
								<option value="none"><?php _e('none', 'medicenter'); ?></option>
								<option value="directscroll"><?php _e('directscroll', 'medicenter'); ?></option>
								<option value="fade"><?php _e('fade', 'medicenter'); ?></option>
								<option value="crossfade"><?php _e('crossfade', 'medicenter'); ?></option>
								<option value="cover"><?php _e('cover', 'medicenter'); ?></option>
								<option value="uncover"><?php _e('uncover', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="slider_transition"><?php _e('TRANSITION:', 'medicenter'); ?></label>
						<div>
							<select id="slider_transition" name="slider_transition">
								<option value="swing"><?php _e('swing', 'medicenter'); ?></option>
								<option value="linear"><?php _e('linear', 'medicenter'); ?></option>
								<option value="easeInQuad"><?php _e('easeInQuad', 'medicenter'); ?></option>
								<option value="easeOutQuad"><?php _e('easeOutQuad', 'medicenter'); ?></option>
								<option value="easeInOutQuad"><?php _e('easeInOutQuad', 'medicenter'); ?></option>
								<option value="easeInCubic"><?php _e('easeInCubic', 'medicenter'); ?></option>
								<option value="easeOutCubic"><?php _e('easeOutCubic', 'medicenter'); ?></option>
								<option value="easeInOutCubic"><?php _e('easeInOutCubic', 'medicenter'); ?></option>
								<option value="easeInOutCubic"><?php _e('easeInOutCubic', 'medicenter'); ?></option>
								<option value="easeInQuart"><?php _e('easeInQuart', 'medicenter'); ?></option>
								<option value="easeOutQuart"><?php _e('easeOutQuart', 'medicenter'); ?></option>
								<option value="easeInOutQuart"><?php _e('easeInOutQuart', 'medicenter'); ?></option>
								<option value="easeInSine"><?php _e('easeInSine', 'medicenter'); ?></option>
								<option value="easeOutSine"><?php _e('easeOutSine', 'medicenter'); ?></option>
								<option value="easeInOutSine"><?php _e('easeInOutSine', 'medicenter'); ?></option>
								<option value="easeInExpo"><?php _e('easeInExpo', 'medicenter'); ?></option>
								<option value="easeOutExpo"><?php _e('easeOutExpo', 'medicenter'); ?></option>
								<option value="easeInOutExpo"><?php _e('easeInOutExpo', 'medicenter'); ?></option>
								<option value="easeInQuint"><?php _e('easeInQuint', 'medicenter'); ?></option>
								<option value="easeOutQuint"><?php _e('easeOutQuint', 'medicenter'); ?></option>
								<option value="easeInOutQuint"><?php _e('easeInOutQuint', 'medicenter'); ?></option>
								<option value="easeInCirc"><?php _e('easeInCirc', 'medicenter'); ?></option>
								<option value="easeOutCirc"><?php _e('easeOutCirc', 'medicenter'); ?></option>
								<option value="easeInOutCirc"><?php _e('easeInOutCirc', 'medicenter'); ?></option>
								<option value="easeInElastic"><?php _e('easeInElastic', 'medicenter'); ?></option>
								<option value="easeOutElastic"><?php _e('easeOutElastic', 'medicenter'); ?></option>
								<option value="easeInOutElastic"><?php _e('easeInOutElastic', 'medicenter'); ?></option>
								<option value="easeInBack"><?php _e('easeInBack', 'medicenter'); ?></option>
								<option value="easeOutBack"><?php _e('easeOutBack', 'medicenter'); ?></option>
								<option value="easeInOutBack"><?php _e('easeInOutBack', 'medicenter'); ?></option>
								<option value="easeInBounce"><?php _e('easeInBounce', 'medicenter'); ?></option>
								<option value="easeOutBounce"><?php _e('easeOutBounce', 'medicenter'); ?></option>
								<option value="easeInOutBounce"><?php _e('easeInOutBounce', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="slider_transition_speed"><?php _e('TRANSITION SPEED (ms):', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" id="slider_transition_speed" name="slider_transition_speed" value="750" />
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-contact-form" class="settings">
				<h3><?php _e('Contact Form', 'medicenter'); ?></h3>
				<h4><?php _e('ADMIN EMAIL CONFIG', 'medicenter');	?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_admin_name"><?php _e('NAME', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo (isset($theme_options["cf_admin_name"]) ? esc_attr($theme_options["cf_admin_name"]) : ""); ?>" id="cf_admin_name" name="cf_admin_name">
						</div>
					</li>
					<li>
						<label for="cf_admin_email"><?php _e('EMAIL', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo (isset($theme_options["cf_admin_email"]) ? esc_attr($theme_options["cf_admin_email"]) : ""); ?>" id="cf_admin_email" name="cf_admin_email">
						</div>
					</li>
				</ul>
				<h4><?php _e('ADMIN SMTP CONFIG (OPTIONAL)', 'medicenter'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_smtp_host"><?php _e('HOST', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo (isset($theme_options["cf_smtp_host"]) ? esc_attr($theme_options["cf_smtp_host"]) : ""); ?>" id="cf_smtp_host" name="cf_smtp_host">
						</div>
					</li>
					<li>
						<label for="cf_smtp_username"><?php _e('USERNAME', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo (isset($theme_options["cf_smtp_username"]) ? esc_attr($theme_options["cf_smtp_username"]) : ""); ?>" id="cf_smtp_username" name="cf_smtp_username">
						</div>
					</li>
					<li>
						<label for="cf_smtp_password"><?php _e('PASSWORD', 'medicenter'); ?></label>
						<div>
							<input type="password" class="regular-text" value="<?php echo (isset($theme_options["cf_smtp_password"]) ? esc_attr($theme_options["cf_smtp_password"]) : ""); ?>" id="cf_smtp_password" name="cf_smtp_password">
						</div>
					</li>
					<li>
						<label for="cf_smtp_port"><?php _e('PORT', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo (isset($theme_options["cf_smtp_port"]) ? esc_attr($theme_options["cf_smtp_port"]) : ""); ?>" id="cf_smtp_port" name="cf_smtp_port">
						</div>
					</li>
					<li>
						<label for="cf_smtp_secure"><?php _e('SMTP SECURE', 'medicenter'); ?></label>
						<div>
							<select id="cf_smtp_secure" name="cf_smtp_secure">
								<option value=""<?php echo (isset($theme_options["cf_smtp_secure"]) && $theme_options["cf_smtp_secure"]=="" ? " selected='selected'" : "") ?>>-</option>
								<option value="ssl"<?php echo (isset($theme_options["cf_smtp_secure"]) && $theme_options["cf_smtp_secure"]=="ssl" ? " selected='selected'" : "") ?>><?php _e('ssl', 'medicenter'); ?></option>
								<option value="tls"<?php echo (isset($theme_options["cf_smtp_secure"]) && $theme_options["cf_smtp_secure"]=="tls" ? " selected='selected'" : "") ?>><?php _e('tls', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
				</ul>
				<h4><?php _e('EMAIL CONFIG', 'medicenter'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_email_subject"><?php _e('EMAIL SUBJECT', 'medicenter'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo (isset($theme_options["cf_email_subject"]) ? esc_attr($theme_options["cf_email_subject"]) : ""); ?>" id="cf_email_subject" name="cf_email_subject">
						</div>
					</li>
					<li>
						<label for="cf_template"><?php _e('TEMPLATE', 'medicenter'); ?></label>
						<div>
							Available shortcodes:<br><strong>[first_name]</strong>, <strong>[last_name]</strong>, <strong>[date]</strong>, <strong>[social_security_number]</strong>, <strong>[phone_number]</strong>, <strong>[email]</strong>, <strong>[message]</strong><br><br>
							<?php wp_editor(isset($theme_options["cf_template"]) ? $theme_options["cf_template"] : "", "cf_template");?>
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-colors" class="settings">
				<h3><?php _e('Colors', 'medicenter'); ?></h3>
				<h4><?php _e('COLOR SCHEME', 'medicenter'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="color_scheme"><?php _e('Color scheme', 'medicenter'); ?></label>
						<div>
							<select id="color_scheme" name="color_scheme">
								<option value="blue"<?php echo (isset($theme_options["color_scheme"]) && $theme_options["color_scheme"]=="blue" ? " selected='selected'" : "") ?>><?php _e('blue (default)', 'medicenter'); ?></option>
								<option value="green"<?php echo (isset($theme_options["color_scheme"]) && $theme_options["color_scheme"]=="green" ? " selected='selected'" : "") ?>><?php _e('green', 'medicenter'); ?></option>
								<option value="orange"<?php echo (isset($theme_options["color_scheme"]) && $theme_options["color_scheme"]=="orange" ? " selected='selected'" : "") ?>><?php _e('orange', 'medicenter'); ?></option>
								<option value="red"<?php echo (isset($theme_options["color_scheme"]) && $theme_options["color_scheme"]=="red" ? " selected='selected'" : "") ?>><?php _e('red', 'medicenter'); ?></option>
								<option value="turquoise"<?php echo (isset($theme_options["color_scheme"]) && $theme_options["color_scheme"]=="turquoise" ? " selected='selected'" : "") ?>><?php _e('turquoise', 'medicenter'); ?></option>
								<option value="violet"<?php echo (isset($theme_options["color_scheme"]) && $theme_options["color_scheme"]=="violet" ? " selected='selected'" : "") ?>><?php _e('violet', 'medicenter'); ?></option>
							</select>
						</div>
					</li>
				</ul>
				<div id="tab-colors_general" class="subsettings">
					<h4><?php _e('GENERAL', 'medicenter'); ?></h4>
					<ul class="form_field_list">
						<li>
							<label for="site_background_color"><?php _e('Site background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["site_background_color"]) ? esc_attr($theme_options["site_background_color"]) : 'D8D8D8'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["site_background_color"]) ? esc_attr($theme_options["site_background_color"]) : ""); ?>" id="site_background_color" name="site_background_color" data-default-color="D8D8D8">
							</div>
						</li>
						<li>
							<label for="header_background_color"><?php _e('Header background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["header_background_color"]) ? esc_attr($theme_options["header_background_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["header_background_color"]) ? esc_attr($theme_options["header_background_color"]) : ""); ?>" id="header_background_color" name="header_background_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="body_background_color"><?php _e('Body background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["body_background_color"]) ? esc_attr($theme_options["body_background_color"]) : 'F8F8F8'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["body_background_color"]) ? esc_attr($theme_options["body_background_color"]) : ""); ?>" id="body_background_color" name="body_background_color" data-default-color="F8F8F8">
							</div>
						</li>
						<li>
							<label for="footer_background_color"><?php _e('Footer background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_background_color"]) ? esc_attr($theme_options["footer_background_color"]) : '202020'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_background_color"]) ? esc_attr($theme_options["footer_background_color"]) : ""); ?>" id="footer_background_color" name="footer_background_color" data-default-color="202020">
							</div>
						</li>
						<li>
							<label for="link_color"><?php _e('Link color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["link_color"]) ? esc_attr($theme_options["link_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["link_color"]) ? esc_attr($theme_options["link_color"]) : ""); ?>" id="link_color" name="link_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="link_hover_color"><?php _e('Link hover color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["link_hover_color"]) ? esc_attr($theme_options["link_hover_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["link_hover_color"]) ? esc_attr($theme_options["link_hover_color"]) : ""); ?>" id="link_hover_color" name="link_hover_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="footer_link_color"><?php _e('Footer link color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_link_color"]) ? esc_attr($theme_options["footer_link_color"]) : 'D5D5D5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_link_color"]) ? esc_attr($theme_options["footer_link_color"]) : ""); ?>" id="footer_link_color" name="footer_link_color" data-default-color="D5D5D5">
							</div>
						</li>
						<li>
							<label for="footer_link_hover_color"><?php _e('Footer link hover color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_link_hover_color"]) ? esc_attr($theme_options["footer_link_hover_color"]) : 'D5D5D5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_link_hover_color"]) ? esc_attr($theme_options["footer_link_hover_color"]) : ""); ?>" id="link_hover_color" name="footer_link_hover_color" data-default-color="D5D5D5">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_text" class="subsettings">
					<h4><?php _e('TEXT', 'medicenter'); ?></h4>
					<ul class="form_field_list">
						<li>
							<label for="body_headers_color"><?php _e('Body headers color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["body_headers_color"]) ? esc_attr($theme_options["body_headers_color"]) : '000000'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["body_headers_color"]) ? esc_attr($theme_options["body_headers_color"]) : ""); ?>" id="body_headers_color" name="body_headers_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="body_headers_border_color"><?php _e('Body headers border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["body_headers_border_color"]) ? esc_attr($theme_options["body_headers_border_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["body_headers_border_color"]) ? esc_attr($theme_options["body_headers_border_color"]) : ""); ?>" id="body_headers_border_color" name="body_headers_border_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="body_text_color"><?php _e('Body text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["body_text_color"]) ? esc_attr($theme_options["body_text_color"]) : '666666'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["body_text_color"]) ? esc_attr($theme_options["body_text_color"]) : ""); ?>" id="body_text_color" name="body_text_color" data-default-color="666666">
							</div>
						</li>
						<li>
							<label for="timeago_label_color"><?php _e('Timeago label color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["timeago_label_color"]) ? esc_attr($theme_options["timeago_label_color"]) : '909090'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["timeago_label_color"]) ? esc_attr($theme_options["timeago_label_color"]) : ""); ?>" id="timeago_label_color" name="timeago_label_color" data-default-color="909090">
							</div>
						</li>
						<li>
							<label for="footer_headers_color"><?php _e('Footer headers color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_headers_color"]) ? esc_attr($theme_options["footer_headers_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_headers_color"]) ? esc_attr($theme_options["footer_headers_color"]) : ""); ?>" id="footer_headers_color" name="footer_headers_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="footer_headers_border_color"><?php _e('Footer headers border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_headers_border_color"]) ? esc_attr($theme_options["footer_headers_border_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_headers_border_color"]) ? esc_attr($theme_options["footer_headers_border_color"]) : ""); ?>" id="footer_headers_border_color" name="footer_headers_border_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="footer_text_color"><?php _e('Footer text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_text_color"]) ? esc_attr($theme_options["footer_text_color"]) : '909090'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_text_color"]) ? esc_attr($theme_options["footer_text_color"]) : ""); ?>" id="footer_text_color" name="footer_text_color" data-default-color="909090">
							</div>
						</li>
						<li>
							<label for="footer_timeago_label_color"><?php _e('Footer timeago label color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_timeago_label_color"]) ? esc_attr($theme_options["footer_timeago_label_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_timeago_label_color"]) ? esc_attr($theme_options["footer_timeago_label_color"]) : ""); ?>" id="footer_timeago_label_color" name="footer_timeago_label_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
						<li>
							<label for="sentence_color"><?php _e('Sentence color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["sentence_color"]) ? esc_attr($theme_options["sentence_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["sentence_color"]) ? esc_attr($theme_options["sentence_color"]) : ""); ?>" id="sentence_color" name="sentence_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="quote_color"><?php _e('Quote color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["quote_color"]) ? esc_attr($theme_options["quote_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["quote_color"]) ? esc_attr($theme_options["quote_color"]) : ""); ?>" id="quote_color" name="quote_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="logo_text_color"><?php _e('Logo text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["logo_text_color"]) ? esc_attr($theme_options["logo_text_color"]) : '000000'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["logo_text_color"]) ? esc_attr($theme_options["logo_text_color"]) : ""); ?>" id="logo_text_color" name="logo_text_color" data-default-color="000000">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_buttons" class="subsettings">
					<h4><?php _e('BUTTONS', 'medicenter');?></h4>
					<ul class="form_field_list">
						<li>
							<label for="body_button_color"><?php _e('Body button text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["body_button_color"]) ? esc_attr($theme_options["body_button_color"]) : '666666'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["body_button_color"]) ? esc_attr($theme_options["body_button_color"]) : ""); ?>" id="body_button_color" name="body_button_color" data-default-color="666666">
							</div>
						</li>
						<li>
							<label for="body_button_hover_color"><?php _e('Body button text hover color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["body_button_hover_color"]) ? esc_attr($theme_options["body_button_hover_color"]) : '000000'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["body_button_hover_color"]) ? esc_attr($theme_options["body_button_hover_color"]) : ""); ?>" id="body_button_hover_color" name="body_button_hover_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="body_button_border_color"><?php _e('Body button border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["body_button_border_color"]) ? esc_attr($theme_options["body_button_border_color"]) : 'E0E0E0'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["body_button_border_color"]) ? esc_attr($theme_options["body_button_border_color"]) : ""); ?>" id="body_button_border_color" name="body_button_border_color" data-default-color="E0E0E0">
							</div>
						</li>
						<li>
							<label for="body_button_border_hover_color"><?php _e('Body button border hover color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["body_button_border_hover_color"]) ? esc_attr($theme_options["body_button_border_hover_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["body_button_border_hover_color"]) ? esc_attr($theme_options["body_button_border_hover_color"]) : ""); ?>" id="body_button_border_hover_color" name="body_button_border_hover_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
						<li>
							<label for="footer_button_color"><?php _e('Footer button text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_button_color"]) ? esc_attr($theme_options["footer_button_color"]) : '909090'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_button_color"]) ? esc_attr($theme_options["footer_button_color"]) : ""); ?>" id="footer_button_color" name="footer_button_color" data-default-color="909090">
							</div>
						</li>
						<li>
							<label for="footer_button_hover_color"><?php _e('Footer button text hover color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_button_hover_color"]) ? esc_attr($theme_options["footer_button_hover_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_button_hover_color"]) ? esc_attr($theme_options["footer_button_hover_color"]) : ""); ?>" id="footer_button_hover_color" name="footer_button_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="footer_button_border_color"><?php _e('Footer button border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_button_border_color"]) ? esc_attr($theme_options["footer_button_border_color"]) : '353535'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_button_border_color"]) ? esc_attr($theme_options["footer_button_border_color"]) : ""); ?>" id="footer_button_border_color" name="footer_button_border_color" data-default-color="353535">
							</div>
						</li>
						<li>
							<label for="footer_button_border_hover_color"><?php _e('Footer button border hover color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["footer_button_border_hover_color"]) ? esc_attr($theme_options["footer_button_border_hover_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["footer_button_border_hover_color"]) ? esc_attr($theme_options["footer_button_border_hover_color"]) : ""); ?>" id="footer_button_border_hover_color" name="footer_button_border_hover_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_menu" class="subsettings">
					<h4><?php _e('MENU', 'medicenter');?></h4>
					<ul class="form_field_list">
						<li>
							<label for="menu_position_text_color"><?php _e('Position text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["menu_position_text_color"]) ? esc_attr($theme_options["menu_position_text_color"]) : '888888'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["menu_position_text_color"]) ? esc_attr($theme_options["menu_position_text_color"]) : ""); ?>" id="menu_position_text_color" name="menu_position_text_color" data-default-color="888888">
							</div>
						</li>
						<li>
							<label for="menu_position_hover_text_color"><?php _e('Position hover text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["menu_position_hover_text_color"]) ? esc_attr($theme_options["menu_position_hover_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["menu_position_hover_text_color"]) ? esc_attr($theme_options["menu_position_hover_text_color"]) : ""); ?>" id="menu_position_hover_text_color" name="menu_position_hover_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="menu_position_background_color"><?php _e('Position background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["menu_position_background_color"]) ? esc_attr($theme_options["menu_position_background_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["menu_position_background_color"]) ? esc_attr($theme_options["menu_position_background_color"]) : ""); ?>" id="menu_position_background_color" name="menu_position_background_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="menu_position_hover_background_color"><?php _e('Position hover background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["menu_position_hover_background_color"]) ? esc_attr($theme_options["menu_position_hover_background_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["menu_position_hover_background_color"]) ? esc_attr($theme_options["menu_position_hover_background_color"]) : ""); ?>" id="menu_position_hover_background_color" name="menu_position_hover_background_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
						<li>
							<label for="submenu_position_text_color"><?php _e('Submenu position text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["submenu_position_text_color"]) ? esc_attr($theme_options["submenu_position_text_color"]) : '888888'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["submenu_position_text_color"]) ? esc_attr($theme_options["submenu_position_text_color"]) : ""); ?>" id="menu_position_text_color" name="submenu_position_text_color" data-default-color="888888">
							</div>
						</li>
						<li>
							<label for="submenu_position_hover_text_color"><?php _e('Submenu position hover text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["submenu_position_hover_text_color"]) ? esc_attr($theme_options["submenu_position_hover_text_color"]) : '000000'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["submenu_position_hover_text_color"]) ? esc_attr($theme_options["submenu_position_hover_text_color"]) : ""); ?>" id="submenu_position_hover_text_color" name="submenu_position_hover_text_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="submenu_position_border_color"><?php _e('Submenu position border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["submenu_position_border_color"]) ? esc_attr($theme_options["submenu_position_border_color"]) : 'E8E8E8'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["submenu_position_border_color"]) ? esc_attr($theme_options["submenu_position_border_color"]) : ""); ?>" id="submenu_position_border_color" name="submenu_position_border_color" data-default-color="E8E8E8">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="submenu_position_hover_border_color"><?php _e('Submenu position hover border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["submenu_position_hover_border_color"]) ? esc_attr($theme_options["submenu_position_hover_border_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["submenu_position_hover_border_color"]) ? esc_attr($theme_options["submenu_position_hover_border_color"]) : ""); ?>" id="submenu_position_border_color" name="submenu_position_hover_border_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="dropdownmenu_background_color"><?php _e('Dropdown menu background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["dropdownmenu_background_color"]) ? esc_attr($theme_options["dropdownmenu_background_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["dropdownmenu_background_color"]) ? esc_attr($theme_options["dropdownmenu_background_color"]) : ""); ?>" id="dropdownmenu_background_color" name="dropdownmenu_background_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="dropdownmenu_hover_background_color"><?php _e('Dropdown menu hover background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["dropdownmenu_hover_background_color"]) ? esc_attr($theme_options["dropdownmenu_hover_background_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["dropdownmenu_hover_background_color"]) ? esc_attr($theme_options["dropdownmenu_hover_background_color"]) : ""); ?>" id="dropdownmenu_hover_background_color" name="dropdownmenu_hover_background_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
						<li>
							<label for="dropdownmenu_border_color"><?php _e('Dropdown menu border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["dropdownmenu_border_color"]) ? esc_attr($theme_options["dropdownmenu_border_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["dropdownmenu_border_color"]) ? esc_attr($theme_options["dropdownmenu_border_color"]) : ""); ?>" id="dropdownmenu_border_color" name="dropdownmenu_border_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_forms" class="subsettings">
					<h4><?php _e('FORMS', 'medicenter');?></h4>
					<ul class="form_field_list">
						<li>
							<label for="form_field_text_color"><?php _e('Form field text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["form_field_text_color"]) ? esc_attr($theme_options["form_field_text_color"]) : '000000'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["form_field_text_color"]) ? esc_attr($theme_options["form_field_text_color"]) : ""); ?>" id="form_field_text_color" name="form_field_text_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="form_field_border_color"><?php _e('Form field top border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["form_field_border_color"]) ? esc_attr($theme_options["form_field_border_color"]) : 'E0E0E0'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["form_field_border_color"]) ? esc_attr($theme_options["form_field_border_color"]) : ""); ?>" id="form_field_border_color" name="form_field_border_color" data-default-color="E0E0E0">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="form_field_active_border_color"><?php _e('Form field active top border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["form_field_active_border_color"]) ? esc_attr($theme_options["form_field_active_border_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["form_field_active_border_color"]) ? esc_attr($theme_options["form_field_active_border_color"]) : ""); ?>" id="form_field_active_border_color" name="form_field_active_border_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="form_button_background_color"><?php _e('Form button background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["form_button_background_color"]) ? esc_attr($theme_options["form_button_background_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["form_button_background_color"]) ? esc_attr($theme_options["form_button_background_color"]) : ""); ?>" id="form_button_background_color" name="form_button_background_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="form_button_hover_background_color"><?php _e('Form button hover background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["form_button_hover_background_color"]) ? esc_attr($theme_options["form_button_hover_background_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["form_button_hover_background_color"]) ? esc_attr($theme_options["form_button_hover_background_color"]) : ""); ?>" id="form_button_hover_background_color" name="form_button_hover_background_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
						<li>
							<label for="form_button_text_color"><?php _e('Form button text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["form_button_text_color"]) ? esc_attr($theme_options["form_button_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["form_button_text_color"]) ? esc_attr($theme_options["form_button_text_color"]) : ""); ?>" id="form_button_text_color" name="form_button_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="form_button_hover_text_color"><?php _e('Form button hover text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["form_button_hover_text_color"]) ? esc_attr($theme_options["form_button_hover_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["form_button_hover_text_color"]) ? esc_attr($theme_options["form_button_hover_text_color"]) : ""); ?>" id="form_button_hover_text_color" name="form_button_hover_text_color" data-default-color="FFFFFF">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_miscellaneous" class="subsettings">
					<h4><?php _e('MISCELLANEOUS', 'medicenter'); ?></h4>
					<ul class="form_field_list">
						<li>
							<label for="top_hint_background_color"><?php _e('Top hint background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["top_hint_background_color"]) ? esc_attr($theme_options["top_hint_background_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["top_hint_background_color"]) ? esc_attr($theme_options["top_hint_background_color"]) : ""); ?>" id="top_hint_background_color" name="top_hint_background_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
						<li>
							<label for="top_hint_text_color"><?php _e('Top hint text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["top_hint_text_color"]) ? esc_attr($theme_options["top_hint_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["top_hint_text_color"]) ? esc_attr($theme_options["top_hint_text_color"]) : ""); ?>" id="top_hint_text_color" name="top_hint_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="page_top_border_color"><?php _e('Page top border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["page_top_border_color"]) ? esc_attr($theme_options["page_top_border_color"]) : 'F0F0F0'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["page_top_border_color"]) ? esc_attr($theme_options["page_top_border_color"]) : ""); ?>" id="page_top_border_color" name="page_top_border_color" data-default-color="F0F0F0">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="divider_background_color"><?php _e('Divider background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["divider_background_color"]) ? esc_attr($theme_options["divider_background_color"]) : 'E0E0E0'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["divider_background_color"]) ? esc_attr($theme_options["divider_background_color"]) : ""); ?>" id="divider_background_color" name="divider_background_color" data-default-color="E0E0E0">
							</div>
						</li>
						<li>
							<label for="date_box_color"><?php _e('Date box background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["date_box_color"]) ? esc_attr($theme_options["date_box_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["date_box_color"]) ? esc_attr($theme_options["date_box_color"]) : ""); ?>" id="date_box_color" name="date_box_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="date_box_text_color"><?php _e('Date box text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["date_box_text_color"]) ? esc_attr($theme_options["date_box_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["date_box_text_color"]) ? esc_attr($theme_options["date_box_text_color"]) : ""); ?>" id="date_box_text_color" name="date_box_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="date_box_comments_number_color"><?php _e('Date box comments number background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["date_box_comments_number_color"]) ? esc_attr($theme_options["date_box_comments_number_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["date_box_comments_number_color"]) ? esc_attr($theme_options["date_box_comments_number_color"]) : ""); ?>" id="date_box_comments_number_color" name="date_box_comments_number_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
						<li>
							<label for="date_box_comments_number_text_color"><?php _e('Date box comments number text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["date_box_comments_number_text_color"]) ? esc_attr($theme_options["date_box_comments_number_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["date_box_comments_number_text_color"]) ? esc_attr($theme_options["date_box_comments_number_text_color"]) : ""); ?>" id="date_box_comments_number_text_color" name="date_box_comments_number_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="gallery_box_color"><?php _e('Gallery box background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["gallery_box_color"]) ? esc_attr($theme_options["gallery_box_color"]) : 'F0F0F0'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["gallery_box_color"]) ? esc_attr($theme_options["gallery_box_color"]) : ""); ?>" id="gallery_box_color" name="gallery_box_color" data-default-color="F0F0F0">
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_color"><?php _e('Gallery box hover background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["gallery_box_hover_color"]) ? esc_attr($theme_options["gallery_box_hover_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["gallery_box_hover_color"]) ? esc_attr($theme_options["gallery_box_hover_color"]) : ""); ?>" id="gallery_box_hover_color" name="gallery_box_hover_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
						<li>
							<label for="gallery_box_text_first_line_color"><?php _e('Gallery box text first line color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["gallery_box_text_first_line_color"]) ? esc_attr($theme_options["gallery_box_text_first_line_color"]) : '000000'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["gallery_box_text_first_line_color"]) ? esc_attr($theme_options["gallery_box_text_first_line_color"]) : ""); ?>" id="gallery_box_text_first_line_color" name="gallery_box_text_first_line_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="gallery_box_text_second_line_color"><?php _e('Gallery box text second line color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["gallery_box_text_second_line_color"]) ? esc_attr($theme_options["gallery_box_text_second_line_color"]) : '666666'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["gallery_box_text_second_line_color"]) ? esc_attr($theme_options["gallery_box_text_second_line_color"]) : ""); ?>" id="gallery_box_text_second_line_color" name="gallery_box_text_second_line_color" data-default-color="666666">
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_text_first_line_color"><?php _e('Gallery box hover text first line color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["gallery_box_hover_text_first_line_color"]) ? esc_attr($theme_options["gallery_box_hover_text_first_line_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["gallery_box_hover_text_first_line_color"]) ? esc_attr($theme_options["gallery_box_hover_text_first_line_color"]) : ""); ?>" id="gallery_box_hover_text_first_line_color" name="gallery_box_hover_text_first_line_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_text_second_line_color"><?php _e('Gallery box hover text second line color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["gallery_box_hover_text_second_line_color"]) ? esc_attr($theme_options["gallery_box_hover_text_second_line_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["gallery_box_hover_text_second_line_color"]) ? esc_attr($theme_options["gallery_box_hover_text_second_line_color"]) : ""); ?>" id="gallery_box_hover_text_second_line_color" name="gallery_box_hover_text_second_line_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="gallery_box_border_color"><?php _e('Gallery box border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["gallery_box_border_color"]) ? esc_attr($theme_options["gallery_box_border_color"]) : 'E0E0E0'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["gallery_box_border_color"]) ? esc_attr($theme_options["gallery_box_border_color"]) : ""); ?>" id="gallery_box_border_color" name="gallery_box_border_color" data-default-color="E0E0E0">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_border_color"><?php _e('Gallery box hover border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["gallery_box_hover_border_color"]) ? esc_attr($theme_options["gallery_box_hover_border_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["gallery_box_hover_border_color"]) ? esc_attr($theme_options["gallery_box_hover_border_color"]) : ""); ?>" id="gallery_box_hover_border_color" name="gallery_box_hover_border_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="timetable_box_color"><?php _e('Timetable box background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["timetable_box_color"]) ? esc_attr($theme_options["timetable_box_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["timetable_box_color"]) ? esc_attr($theme_options["timetable_box_color"]) : ""); ?>" id="timetable_box_color" name="timetable_box_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="timetable_box_hover_color"><?php _e('Timetable box hover background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["timetable_box_hover_color"]) ? esc_attr($theme_options["timetable_box_hover_color"]) : '42B3E5'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["timetable_box_hover_color"]) ? esc_attr($theme_options["timetable_box_hover_color"]) : ""); ?>" id="timetable_box_hover_color" name="timetable_box_hover_color" data-default-color="42B3E5" data-default-color-green="7CBA3D" data-default-color-orange="ffa800" data-default-color-red="f37548" data-default-color-turquoise="00b6cc" data-default-color-violet="9187c4">
							</div>
						</li>
						<li>
							<label for="timetable_box_text_color"><?php _e('Timetable box text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["timetable_box_text_color"]) ? esc_attr($theme_options["timetable_box_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["timetable_box_text_color"]) ? esc_attr($theme_options["timetable_box_text_color"]) : ""); ?>" id="timetable_box_text_color" name="timetable_box_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="timetable_box_hover_text_color"><?php _e('Timetable box hover text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["timetable_box_hover_text_color"]) ? esc_attr($theme_options["timetable_box_hover_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["timetable_box_hover_text_color"]) ? esc_attr($theme_options["timetable_box_hover_text_color"]) : ""); ?>" id="timetable_box_hover_text_color" name="timetable_box_hover_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="timetable_box_hours_text_color"><?php _e('Timetable box hours text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["timetable_box_hours_text_color"]) ? esc_attr($theme_options["timetable_box_hours_text_color"]) : 'A6C3FF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["timetable_box_hours_text_color"]) ? esc_attr($theme_options["timetable_box_hours_text_color"]) : ""); ?>" id="timetable_box_hours_text_color" name="timetable_box_hours_text_color" data-default-color="A6C3FF" data-default-color-green="BBE095" data-default-color-orange="FFCE70" data-default-color-red="FFBD9C" data-default-color-turquoise="98DEF5" data-default-color-violet="B0BDFF">
							</div>
						</li>
						<li>
							<label for="timetable_box_hover_hours_text_color"><?php _e('Timetable box hover hours text color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["timetable_box_hover_hours_text_color"]) ? esc_attr($theme_options["timetable_box_hover_hours_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["timetable_box_hover_hours_text_color"]) ? esc_attr($theme_options["timetable_box_hover_hours_text_color"]) : ""); ?>" id="timetable_box_hover_hours_text_color" name="timetable_box_hover_hours_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="timetable_tip_box_color"><?php _e('Timetable tip box background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["timetable_tip_box_color"]) ? esc_attr($theme_options["timetable_tip_box_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["timetable_tip_box_color"]) ? esc_attr($theme_options["timetable_tip_box_color"]) : ""); ?>" id="timetable_tip_box_color" name="timetable_tip_box_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="accordion_tab_color"><?php _e('Accordion tab color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["accordion_tab_color"]) ? esc_attr($theme_options["accordion_tab_color"]) : '3156A3'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["accordion_tab_color"]) ? esc_attr($theme_options["accordion_tab_color"]) : ""); ?>" id="accordion_tab_color" name="accordion_tab_color" data-default-color="3156A3" data-default-color-green="008238" data-default-color-orange="cb451b" data-default-color-red="c03427" data-default-color-turquoise="006688" data-default-color-violet="3e4c94">
							</div>
						</li>
						<li>
							<label for="copyright_area_border_color"><?php _e('Copyright area border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["copyright_area_border_color"]) ? esc_attr($theme_options["copyright_area_border_color"]) : '353535'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["copyright_area_border_color"]) ? esc_attr($theme_options["copyright_area_border_color"]) : ""); ?>" id="copyright_area_border_color" name="copyright_area_border_color" data-default-color="353535">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<?php /*<li>
							<label for="gallery_details_box_border_color"><?php _e('Gallery details box border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo esc_attr($theme_options["gallery_details_box_border_color"]); ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_details_box_border_color"]); ?>" id="gallery_details_box_border_color" name="gallery_details_box_border_color">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="bread_crumb_border_color"><?php _e('Bread crumb border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo esc_attr($theme_options["bread_crumb_border_color"]); ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["bread_crumb_border_color"]); ?>" id="bread_crumb_border_color" name="bread_crumb_border_color">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="accordion_item_border_color"><?php _e('Accordion item border color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo esc_attr($theme_options["accordion_item_border_color"]); ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_color"]); ?>" id="accordion_item_border_color" name="accordion_item_border_color">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="accordion_item_border_hover_color"><?php _e('Accordion item border hover color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo esc_attr($theme_options["accordion_item_border_hover_color"]); ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_hover_color"]); ?>" id="accordion_item_border_hover_color" name="accordion_item_border_hover_color">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>
						<li>
							<label for="accordion_item_border_active_color"><?php _e('Accordion item border active color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo esc_attr($theme_options["accordion_item_border_active_color"]); ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_active_color"]); ?>" id="accordion_item_border_active_color" name="accordion_item_border_active_color">
								<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
							</div>
						</li>						
						<li>
							<label for="comment_reply_button_color"><?php _e('Comment reply button color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo esc_attr($theme_options["comment_reply_button_color"]); ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["comment_reply_button_color"]); ?>" id="comment_reply_button_color" name="comment_reply_button_color">
							</div>
						</li>
						<li>
							<label for="post_author_link_color"><?php _e('Post author link color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo esc_attr($theme_options["post_author_link_color"]); ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["post_author_link_color"]); ?>" id="post_author_link_color" name="post_author_link_color">
							</div>
						</li>
						<li>
							<label for="contact_details_box_background_color"><?php _e('Contact details box background color', 'medicenter'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo esc_attr($theme_options["contact_details_box_background_color"]); ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["contact_details_box_background_color"]); ?>" id="contact_details_box_background_color" name="contact_details_box_background_color">
							</div>
						</li>*/ ?>
					</ul>
				</div>
			</div>
			<div id="tab-header" class="settings">
				<h3><?php _e('Header', 'medicenter'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="header_layout_type"><?php _e('Header layout type', 'medicenter'); ?></label>
						<div>
							<select id="header_layout_type" name="header_layout_type">
								<option<?php echo (!empty($theme_options["header_layout_type"]) && (int)$theme_options["header_layout_type"]==1 ? " selected='selected'" : ""); ?>  value="1"><?php _e("Type 1", 'medicenter'); ?></option>
								<option<?php echo (!empty($theme_options["header_layout_type"]) && (int)$theme_options["header_layout_type"]==2 ? " selected='selected'" : ""); ?>  value="2"><?php _e("Type 2", 'medicenter'); ?></option>
								<option<?php echo (!empty($theme_options["header_layout_type"]) && (int)$theme_options["header_layout_type"]==3 ? " selected='selected'" : ""); ?>  value="3"><?php _e("Type 3", 'medicenter'); ?></option>
								<option<?php echo (!empty($theme_options["header_layout_type"]) && (int)$theme_options["header_layout_type"]==4 ? " selected='selected'" : ""); ?>  value="4"><?php _e("Type 4", 'medicenter'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="header_top_sidebar"><?php _e('Header top sidebar', 'medicenter'); ?></label>
						<div>
						<?php
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
						?>
						<select id="header_top_sidebar" name="header_top_sidebar">
							<option value="" <?php echo (empty($theme_options["header_top_sidebar"]) ? " selected='selected'" : ""); ?>><?php _e("none", 'medicenter'); ?></option>
							<?php
							foreach($theme_sidebars as $theme_sidebar)
							{
								?>
								<option value="<?php echo (!empty($theme_sidebar["id"]) ? esc_attr($theme_sidebar["id"]) : ""); ?>"<?php echo (isset($theme_options["header_top_sidebar"]) && $theme_options["header_top_sidebar"]==$theme_sidebar["id"] ? " selected='selected'" : ""); ?>><?php echo (!empty($theme_sidebar["title"]) ? $theme_sidebar["title"] : ""); ?></option>
								<?php
							}
							?>
						</select>
						</div>
					</li>
					<li id="header_top_right_sidebar_container"<?php echo (isset($theme_options["header_layout_type"]) && (int)$theme_options["header_layout_type"]!=2 ? ' style="display: none;"' : ''); ?>>
						<label for="header_top_right_sidebar"><?php _e('Header top right sidebar', 'medicenter'); ?></label>
						<div>
						<select id="header_top_right_sidebar" name="header_top_right_sidebar">
							<option value="" <?php echo (empty($theme_options["header_top_right_sidebar"]) ? " selected='selected'" : ""); ?>><?php _e("none", 'medicenter'); ?></option>
							<?php
							foreach($theme_sidebars as $theme_sidebar)
							{
								?>
								<option value="<?php echo (!empty($theme_sidebar["id"]) ? esc_attr($theme_sidebar["id"]) : ""); ?>"<?php echo (isset($theme_options["header_top_right_sidebar"]) && $theme_options["header_top_right_sidebar"]==$theme_sidebar["id"] ? " selected='selected'" : ""); ?>><?php echo (!empty($theme_sidebar["title"]) ? $theme_sidebar["title"] : ""); ?></option>
								<?php
							}
							?>
						</select>
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-fonts" class="settings">
				<h3><?php _e('Fonts', 'medicenter'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="header_font"><?php _e('Header font', 'medicenter'); ?></label>
						<div>
							<select id="header_font" name="header_font">
								<option<?php echo (empty($theme_options["header_font"]) ? " selected='selected'" : ""); ?>  value=""><?php _e("Default (PT Sans)", 'medicenter'); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo (isset($theme_options["header_font"]) && $theme_options["header_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo (isset($theme_options["header_font"]) && $theme_options["header_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family; ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
							<img class="theme_font_subset_preloader" src="<?php echo get_template_directory_uri();?>/admin/images/ajax-loader.gif" />
							<label class="font_subset" for="header_font_subset" style="<?php echo (!empty($theme_options["header_font"]) ? "display: block;" : ""); ?>"><?php _e('Header font subset', 'medicenter'); ?></label>
							<select id="header_font_subset" class="font_subset" name="header_font_subset[]" multiple="multiple" style="<?php echo (!empty($theme_options["header_font"]) ? "display: block;" : ""); ?>">
								<?php
								if(!empty($theme_options["header_font"]))
								{
									$fontExplode = explode(":", $theme_options["header_font"]);
									$font_subset = mc_get_google_font_subset($fontExplode[0]);
									foreach($font_subset as $subset)
										echo "<option value='" . $subset . "' " . (in_array($subset, $theme_options["header_font_subset"]) ? "selected='selected'" : "") . ">" . $subset . "</option>";							
								}
								?>
							</select>
						</div>
					</li>
					<li>
						<label for="subheader_font"><?php _e('Subheader font', 'medicenter'); ?></label>
						<div>
							<select id="subheader_font" name="subheader_font">
								<option<?php echo (empty($theme_options["subheader_font"]) ? " selected='selected'" : ""); ?>  value=""><?php _e("Default (PT Sans)", 'medicenter'); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo (isset($theme_options["subheader_font"]) && $theme_options["subheader_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo (isset($theme_options["subheader_font"]) && $theme_options["subheader_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family; ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
							<img class="theme_font_subset_preloader" src="<?php echo get_template_directory_uri();?>/admin/images/ajax-loader.gif" />
							<label class="font_subset" for="subheader_font_subset" style="<?php echo (!empty($theme_options["subheader_font"]) ? "display: block;" : ""); ?>"><?php _e('Subheader font subset', 'medicenter'); ?></label>
							<select id="subheader_font_subset" class="font_subset" name="subheader_font_subset[]" multiple="multiple" style="<?php echo (!empty($theme_options["subheader_font"]) ? "display: block;" : ""); ?>">
								<?php
								if(!empty($theme_options["subheader_font"]))
								{
									$fontExplode = explode(":", $theme_options["subheader_font"]);
									$font_subset = mc_get_google_font_subset($fontExplode[0]);
									foreach($font_subset as $subset)
										echo "<option value='" . $subset . "' " . (in_array($subset, $theme_options["subheader_font_subset"]) ? "selected='selected'" : "") . ">" . $subset . "</option>";							
								}
								?>
							</select>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="footer">
			<div class="footer_left">
				<ul class="social-list">
					<li><a target="_blank" href="http://www.facebook.com/QuanticaLabs/" class="social-list-facebook" title="Facebook"></a></li>
					<li><a target="_blank" href="https://twitter.com/quanticalabs" class="social-list-twitter" title="Twitter"></a></li>
					<li><a target="_blank" href="http://www.flickr.com/photos/76628486@N03" class="social-list-flickr" title="Flickr"></a></li>
					<li><a target="_blank" href="http://themeforest.net/user/QuanticaLabs?ref=QuanticaLabs" class="social-list-envato" title="Envato"></a></li>
					<li><a target="_blank" href="http://quanticalabs.tumblr.com/" class="social-list-tumblr" title="Tumblr"></a></li>
					<li><a target="_blank" href="http://quanticalabs.deviantart.com/" class="social-list-deviantart" title="Deviantart"></a></li>
				</ul>
			</div>
			<div class="footer_right">
				<input type="hidden" name="action" value="<?php echo $themename; ?>_save" />
				<input type="submit" name="submit" value="Save Options" />
				<img id="theme_options_preloader" src="<?php echo get_template_directory_uri();?>/admin/images/ajax-loader.gif" />
				<img id="theme_options_tick" src="<?php echo get_template_directory_uri();?>/admin/images/tick.png" />
			</div>
		</div>
	</form>
	<?php
	//print_r($fontsArray->items);
	/*
	?>
	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="<?php echo $themename; ?>-options-tabs">
		<ul class="nav-tabs">
			<li class="nav-tab">
				<a href="#tab-main">
					<?php _e('Main', 'medicenter'); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-slider">
					<?php _e('Slider', 'medicenter'); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-contact-form">
					<?php _e('Contact Form', 'medicenter'); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-contact-details">
					<?php _e('Contact Details', 'medicenter'); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-colors">
					<?php _e('Colors', 'medicenter'); ?>
				</a>
			</li>
			<li class="nav-tab">
				<a href="#tab-fonts">
					<?php _e('Fonts', 'medicenter'); ?>
				</a>
			</li>
		</ul>
		<div id="tab-main">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php _e('Main', 'medicenter'); ?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_url"><?php _e('Logo url', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_url"]); ?>" id="logo_url" name="logo_url">
							<input type="button" class="button" name="<?php echo $themename;?>_upload_button" id="logo_url_upload_button" value="<?php _e('Insert logo', 'medicenter'); ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_first_part_text"><?php _e('Logo first part text', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_first_part_text"]); ?>" id="logo_first_part_text" name="logo_first_part_text">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_second_part_text"><?php _e('Logo second part text', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_second_part_text"]); ?>" id="logo_second_part_text" name="logo_second_part_text">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_text_left"><?php _e('Footer text left', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["footer_text_left"]); ?>" id="footer_text_left" name="footer_text_left">
							<span class="description"><?php _e('Can be text or any html', 'medicenter'); ?>.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_text_right"><?php _e('Footer text right', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["footer_text_right"]); ?>" id="footer_text_right" name="footer_text_right">
							<span class="description"><?php _e('Can be text or any html', 'medicenter'); ?>.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="home_page_top_hint"><?php _e('Home page top hint', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["home_page_top_hint"]); ?>" id="home_page_top_hint" name="home_page_top_hint">
							<span class="description"><?php _e('Can be text or any html', 'medicenter'); ?>.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="responsive"><?php _e('Responsive', 'medicenter'); ?></label>
						</th>
						<td>
							<select id="responsive" name="responsive">
								<option value="1"<?php echo ((int)$theme_options["responsive"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'medicenter'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["responsive"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'medicenter'); ?></option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Main Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-slider">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php _e('Slider', 'medicenter'); ?>
						</th>
					</tr>
					<?php
					$slides_count = count($theme_options["slider_image_url"]);
					if($slides_count==0)
						$slides_count = 3;
					for($i=0; $i<$slides_count; $i++)
					{
					?>
					<tr class="slider_image_url_row">
						<td>
							<label><?php _e('Slider image url', 'medicenter'); echo " " . ($i+1); ?></label>
						</td>
						<td>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_url_<?php echo ($i+1); ?>" name="slider_image_url[]" value="<?php echo esc_attr($theme_options["slider_image_url"][$i]); ?>" />
							<input type="button" class="button" name="<?php echo $themename;?>_upload_button" id="<?php echo $themename;?>_slider_image_url_button_<?php echo ($i+1); ?>" value="<?php _e('Browse', 'medicenter'); ?>" />
						</td>
					</tr>
					<tr class="slider_image_title_row">
						<td>
							<label><?php _e('Slider image title', 'medicenter'); echo " " . ($i+1); ?></label>
						</td>
						<td>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_title_<?php echo ($i+1); ?>" name="slider_image_title[]" value="<?php echo esc_attr($theme_options["slider_image_title"][$i]); ?>" />
						</td>
					</tr>
					<tr class="slider_image_subtitle_row">
						<td>
							<label><?php _e('Slider image subtitle', 'medicenter'); echo " " . ($i+1); ?></label>
						</td>
						<td>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_subtitle_<?php echo ($i+1); ?>" name="slider_image_subtitle[]" value="<?php echo esc_attr($theme_options["slider_image_subtitle"][$i]); ?>" />
						</td>
					</tr>
					<tr class="slider_image_link_row">
						<td>
							<label><?php _e('Slider image link', 'medicenter'); echo " " . ($i+1); ?></label>
						</td>
						<td>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_link_<?php echo ($i+1); ?>" name="slider_image_link[]" value="<?php echo esc_attr($theme_options["slider_image_link"][$i]); ?>" />
						</td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td></td>
						<td>
							<input type="button" class="button" name="<?php echo $themename;?>_add_new_button" id="<?php echo $themename;?>_add_new_button" value="<?php _e('Add slider image', 'medicenter'); ?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label><?php _e('Autoplay', 'medicenter'); ?></label>
						</td>
						<td>
							<select id="slider_autoplay" name="slider_autoplay">
								<option value="true"<?php echo ($theme_options["slider_autoplay"]=="true" ? " selected='selected'" : "") ?>><?php _e('yes', 'medicenter'); ?></option>
								<option value="false"<?php echo ($theme_options["slider_autoplay"]=="false" ? " selected='selected'" : "") ?>><?php _e('no', 'medicenter'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="slide_interval"><?php _e('Slide interval:', 'medicenter'); ?></label>
						</td>
						<td>
							<input type="text" class="regular-text" id="slide_interval" name="slide_interval" value="<?php echo (int)esc_attr($theme_options["slide_interval"]); ?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="slider_effect"><?php _e('Effect:', 'medicenter'); ?></label>
						</td>
						<td>
							<select id="slider_effect" name="slider_effect">
								<option value="scroll"<?php echo ($theme_options["slider_effect"]=="scroll" ? " selected='selected'" : "") ?>><?php _e('scroll', 'medicenter'); ?></option>
								<option value="none"<?php echo ($theme_options["slider_effect"]=="none" ? " selected='selected'" : "") ?>><?php _e('none', 'medicenter'); ?></option>
								<option value="directscroll"<?php echo ($theme_options["slider_effect"]=="directscroll" ? " selected='selected'" : "") ?>><?php _e('directscroll', 'medicenter'); ?></option>
								<option value="fade"<?php echo ($theme_options["slider_effect"]=="fade" ? " selected='selected'" : "") ?>><?php _e('fade', 'medicenter'); ?></option>
								<option value="crossfade"<?php echo ($theme_options["slider_effect"]=="crossfade" ? " selected='selected'" : "") ?>><?php _e('crossfade', 'medicenter'); ?></option>
								<option value="cover"<?php echo ($theme_options["slider_effect"]=="cover" ? " selected='selected'" : "") ?>><?php _e('cover', 'medicenter'); ?></option>
								<option value="uncover"<?php echo ($theme_options["slider_effect"]=="uncover" ? " selected='selected'" : "") ?>><?php _e('uncover', 'medicenter'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="slider_transition"><?php _e('Transition:', 'medicenter'); ?></label>
						</td>
						<td>
							<select id="slider_transition" name="slider_transition">
								<option value="swing"<?php echo ($theme_options["slider_transition"]=="swing" ? " selected='selected'" : "") ?>><?php _e('swing', 'medicenter'); ?></option>
								<option value="linear"<?php echo ($theme_options["slider_transition"]=="linear" ? " selected='selected'" : "") ?>><?php _e('linear', 'medicenter'); ?></option>
								<option value="easeInQuad"<?php echo ($theme_options["slider_transition"]=="easeInQuad" ? " selected='selected'" : "") ?>><?php _e('easeInQuad', 'medicenter'); ?></option>
								<option value="easeOutQuad"<?php echo ($theme_options["slider_transition"]=="easeOutQuad" ? " selected='selected'" : "") ?>><?php _e('easeOutQuad', 'medicenter'); ?></option>
								<option value="easeInOutQuad"<?php echo ($theme_options["slider_transition"]=="easeInOutQuad" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuad', 'medicenter'); ?></option>
								<option value="easeInCubic"<?php echo ($theme_options["slider_transition"]=="easeInCubic" ? " selected='selected'" : "") ?>><?php _e('easeInCubic', 'medicenter'); ?></option>
								<option value="easeOutCubic"<?php echo ($theme_options["slider_transition"]=="easeOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeOutCubic', 'medicenter'); ?></option>
								<option value="easeInOutCubic"<?php echo ($theme_options["slider_transition"]=="easeInOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeInOutCubic', 'medicenter'); ?></option>
								<option value="easeInOutCubic"<?php echo ($theme_options["slider_transition"]=="easeInOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeInOutCubic', 'medicenter'); ?></option>
								<option value="easeInQuart"<?php echo ($theme_options["slider_transition"]=="easeInQuart" ? " selected='selected'" : "") ?>><?php _e('easeInQuart', 'medicenter'); ?></option>
								<option value="easeOutQuart"<?php echo ($theme_options["slider_transition"]=="easeOutQuart" ? " selected='selected'" : "") ?>><?php _e('easeOutQuart', 'medicenter'); ?></option>
								<option value="easeInOutQuart"<?php echo ($theme_options["slider_transition"]=="easeInOutQuart" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuart', 'medicenter'); ?></option>
								<option value="easeInSine"<?php echo ($theme_options["slider_transition"]=="easeInSine" ? " selected='selected'" : "") ?>><?php _e('easeInSine', 'medicenter'); ?></option>
								<option value="easeOutSine"<?php echo ($theme_options["slider_transition"]=="easeOutSine" ? " selected='selected'" : "") ?>><?php _e('easeOutSine', 'medicenter'); ?></option>
								<option value="easeInOutSine"<?php echo ($theme_options["slider_transition"]=="easeInOutSine" ? " selected='selected'" : "") ?>><?php _e('easeInOutSine', 'medicenter'); ?></option>
								<option value="easeInExpo"<?php echo ($theme_options["slider_transition"]=="easeInExpo" ? " selected='selected'" : "") ?>><?php _e('easeInExpo', 'medicenter'); ?></option>
								<option value="easeOutExpo"<?php echo ($theme_options["slider_transition"]=="easeOutExpo" ? " selected='selected'" : "") ?>><?php _e('easeOutExpo', 'medicenter'); ?></option>
								<option value="easeInOutExpo"<?php echo ($theme_options["slider_transition"]=="easeInOutExpo" ? " selected='selected'" : "") ?>><?php _e('easeInOutExpo', 'medicenter'); ?></option>
								<option value="easeInQuint"<?php echo ($theme_options["slider_transition"]=="easeInQuint" ? " selected='selected'" : "") ?>><?php _e('easeInQuint', 'medicenter'); ?></option>
								<option value="easeOutQuint"<?php echo ($theme_options["slider_transition"]=="easeOutQuint" ? " selected='selected'" : "") ?>><?php _e('easeOutQuint', 'medicenter'); ?></option>
								<option value="easeInOutQuint"<?php echo ($theme_options["slider_transition"]=="easeInOutQuint" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuint', 'medicenter'); ?></option>
								<option value="easeInCirc"<?php echo ($theme_options["slider_transition"]=="easeInCirc" ? " selected='selected'" : "") ?>><?php _e('easeInCirc', 'medicenter'); ?></option>
								<option value="easeOutCirc"<?php echo ($theme_options["slider_transition"]=="easeOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeOutCirc', 'medicenter'); ?></option>
								<option value="easeInOutCirc"<?php echo ($theme_options["slider_transition"]=="easeInOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeInOutCirc', 'medicenter'); ?></option>
								<option value="easeInElastic"<?php echo ($theme_options["slider_transition"]=="easeInElastic" ? " selected='selected'" : "") ?>><?php _e('easeInElastic', 'medicenter'); ?></option>
								<option value="easeOutElastic"<?php echo ($theme_options["slider_transition"]=="easeOutElastic" ? " selected='selected'" : "") ?>><?php _e('easeOutElastic', 'medicenter'); ?></option>
								<option value="easeInOutElastic"<?php echo ($theme_options["slider_transition"]=="easeInOutElastic" ? " selected='selected'" : "") ?>><?php _e('easeInOutElastic', 'medicenter'); ?></option>
								<option value="easeInBack"<?php echo ($theme_options["slider_transition"]=="easeInBack" ? " selected='selected'" : "") ?>><?php _e('easeInBack', 'medicenter'); ?></option>
								<option value="easeOutBack"<?php echo ($theme_options["slider_transition"]=="easeOutBack" ? " selected='selected'" : "") ?>><?php _e('easeOutBack', 'medicenter'); ?></option>
								<option value="easeInOutBack"<?php echo ($theme_options["slider_transition"]=="easeOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeInOutBack', 'medicenter'); ?></option>
								<option value="easeInBounce"<?php echo ($theme_options["slider_transition"]=="easeInBounce" ? " selected='selected'" : "") ?>><?php _e('easeInBounce', 'medicenter'); ?></option>
								<option value="easeOutBounce"<?php echo ($theme_options["slider_transition"]=="easeOutBounce" ? " selected='selected'" : "") ?>><?php _e('easeOutBounce', 'medicenter'); ?></option>
								<option value="easeInOutBounce"<?php echo ($theme_options["slider_transition"]=="easeInOutBounce" ? " selected='selected'" : "") ?>><?php _e('easeInOutBounce', 'medicenter'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="slider_transition_speed"><?php _e('Transition speed:', 'medicenter'); ?></label>
						</td>
						<td>
							<input type="text" class="regular-text" id="slider_transition_speed" name="slider_transition_speed" value="<?php echo (int)esc_attr($theme_options["slider_transition_speed"]); ?>" />
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Slider Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-contact-form">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Admin email config', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_admin_name"><?php _e('Name', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_name"]); ?>" id="cf_admin_name" name="cf_admin_name">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_admin_email"><?php _e('Email', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_email"]); ?>" id="cf_admin_email" name="cf_admin_email">
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<br />
						</th>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Admin SMTP config (optional)', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_host"><?php _e('Host', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_host"]); ?>" id="cf_smtp_host" name="cf_smtp_host">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_username"><?php _e('Username', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_username"]); ?>" id="cf_smtp_username" name="cf_smtp_username">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_password"><?php _e('Password', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="password" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_password"]); ?>" id="cf_smtp_password" name="cf_smtp_password">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_port"><?php _e('Port', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_port"]); ?>" id="cf_smtp_port" name="cf_smtp_port">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_smtp_secure"><?php _e('SMTP Secure', 'medicenter'); ?></label>
						</th>
						<td>
							<select id="cf_smtp_secure" name="cf_smtp_secure">
								<option value=""<?php echo ($theme_options["cf_smtp_secure"]=="" ? " selected='selected'" : "") ?>>-</option>
								<option value="ssl"<?php echo ($theme_options["cf_smtp_secure"]=="ssl" ? " selected='selected'" : "") ?>><?php _e('ssl', 'medicenter'); ?></option>
								<option value="tls"<?php echo ($theme_options["cf_smtp_secure"]=="tls" ? " selected='selected'" : "") ?>><?php _e('tls', 'medicenter'); ?></option>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<br />
						</th>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php _e('Email config', 'medicenter'); ?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_email_subject"><?php _e('Email subject', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_email_subject"]); ?>" id="cf_email_subject" name="cf_email_subject">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="cf_template"><?php _e('Template', 'medicenter'); ?></label>
						</th>
						<td></td>
					</tr>
					<tr valign="top">
						<td colspan="2">
							<?php the_editor($theme_options["cf_template"], "cf_template");?>
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Contact Form Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-contact-details">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Contact Details', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_logo_first_part_text"><?php _e('Contact logo first part text', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_logo_first_part_text"]); ?>" id="contact_logo_first_part_text" name="contact_logo_first_part_text">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_logo_second_part_text"><?php _e('Contact logo second part text', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_logo_second_part_text"]); ?>" id="contact_logo_second_part_text" name="contact_logo_second_part_text">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_phone"><?php _e('Contact phone', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_phone"]); ?>" id="contact_phone" name="contact_phone">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_fax"><?php _e('Contact fax', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_fax"]); ?>" id="contact_fax" name="contact_fax">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_email"><?php _e('Contact email', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_email"]); ?>" id="contact_phone" name="contact_email">
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Contact Details Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-colors">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('General', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="header_background_color"><?php _e('Header background color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["header_background_color"]); ?>" id="header_background_color" name="header_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_background_color"><?php _e('Body background color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_background_color"]); ?>" id="body_background_color" name="body_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_background_color"><?php _e('Footer background color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_background_color"]); ?>" id="footer_background_color" name="footer_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="link_color"><?php _e('Link color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["link_color"]); ?>" id="link_color" name="link_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="link_hover_color"><?php _e('Link hover color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["link_hover_color"]); ?>" id="link_hover_color" name="link_hover_color">
						</td>
					</tr>
					<tr>
						<td style="padding: 0;">
							<p>
								<input type="submit" value="<?php _e('Save Colors Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
							</p>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Text', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_headers_color"><?php _e('Body headers color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_headers_color"]); ?>" id="body_headers_color" name="body_headers_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_headers_border_color"><?php _e('Body headers border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_headers_border_color"]); ?>" id="body_headers_border_color" name="body_headers_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_text_color"><?php _e('Body text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_text_color"]); ?>" id="body_text_color" name="body_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_text2_color"><?php _e('Body text 2 color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_text2_color"]); ?>" id="body_text2_color" name="body_text2_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_headers_color"><?php _e('Footer headers color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_headers_color"]); ?>" id="footer_headers_color" name="footer_headers_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_headers_border_color"><?php _e('Footer headers border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_headers_border_color"]); ?>" id="footer_headers_border_color" name="footer_headers_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_text_color"><?php _e('Footer text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_text_color"]); ?>" id="footer_text_color" name="footer_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="timeago_label_color"><?php _e('Timeago label color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timeago_label_color"]); ?>" id="timeago_label_color" name="timeago_label_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="sentence_color"><?php _e('Sentence color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["sentence_color"]); ?>" id="sentence_color" name="sentence_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_first_part_text_color"><?php _e('Logo first part text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["logo_first_part_text_color"]); ?>" id="logo_first_part_text_color" name="logo_first_part_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="logo_second_part_text_color"><?php _e('Logo second part text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["logo_second_part_text_color"]); ?>" id="logo_second_part_text_color" name="logo_second_part_text_color">
						</td>
					</tr>
					<tr>
						<td style="padding: 0;">
							<p>
								<input type="submit" value="<?php _e('Save Colors Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
							</p>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Buttons', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_button_color"><?php _e('Body button text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_color"]); ?>" id="body_button_color" name="body_button_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_button_hover_color"><?php _e('Body button text hover color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_hover_color"]); ?>" id="body_button_hover_color" name="body_button_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_button_border_color"><?php _e('Body button border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_border_color"]); ?>" id="body_button_border_color" name="body_button_border_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="body_button_border_hover_color"><?php _e('Body button border hover color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_border_hover_color"]); ?>" id="body_button_border_hover_color" name="body_button_border_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_button_color"><?php _e('Footer button text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_color"]); ?>" id="footer_button_color" name="footer_button_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_button_hover_color"><?php _e('Footer button text hover color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_hover_color"]); ?>" id="footer_button_hover_color" name="footer_button_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_button_border_color"><?php _e('Footer button border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_border_color"]); ?>" id="footer_button_border_color" name="footer_button_border_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="footer_button_border_hover_color"><?php _e('Footer button border hover color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_border_hover_color"]); ?>" id="footer_button_border_hover_color" name="footer_button_border_hover_color">
						</td>
					</tr>
					<tr>
						<td style="padding: 0;">
							<p>
								<input type="submit" value="<?php _e('Save Colors Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
							</p>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Menu', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_link_color"><?php _e('Link color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_link_color"]); ?>" id="menu_link_color" name="menu_link_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_link_border_color"><?php _e('Link border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_link_border_color"]); ?>" id="menu_link_border_color" name="menu_link_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_active_color"><?php _e('Active color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_active_color"]); ?>" id="menu_active_color" name="menu_active_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_active_border_color"><?php _e('Active border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_active_border_color"]); ?>" id="menu_active_border_color" name="menu_active_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_hover_color"><?php _e('Hover color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_hover_color"]); ?>" id="menu_hover_color" name="menu_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="menu_hover_border_color"><?php _e('Hover border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_hover_border_color"]); ?>" id="menu_hover_border_color" name="menu_hover_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="submenu_background_color"><?php _e('Submenu background color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_background_color"]); ?>" id="submenu_background_color" name="submenu_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="submenu_hover_background_color"><?php _e('Submenu hover background color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_hover_background_color"]); ?>" id="submenu_hover_background_color" name="submenu_hover_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="submenu_color"><?php _e('Submenu link color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_color"]); ?>" id="submenu_color" name="submenu_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="submenu_hover_color"><?php _e('Submenu hover link color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_hover_color"]); ?>" id="submenu_color" name="submenu_hover_color">
						</td>
					</tr>
					<tr>
						<td style="padding: 0;">
							<p>
								<input type="submit" value="<?php _e('Save Colors Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
							</p>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Forms', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="form_hint_color"><?php _e('Form hint color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_hint_color"]); ?>" id="form_hint_color" name="form_hint_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="form_field_text_color"><?php _e('Form field text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_text_color"]); ?>" id="form_field_text_color" name="form_field_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="form_field_border_color"><?php _e('Form field border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_border_color"]); ?>" id="form_field_border_color" name="form_field_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="form_field_active_border_color"><?php _e('Form field active border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_active_border_color"]); ?>" id="form_field_active_border_color" name="form_field_active_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Miscellaneous', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="date_box_color"><?php _e('Date box background color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_color"]); ?>" id="date_box_color" name="date_box_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="date_box_text_color"><?php _e('Date box text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_text_color"]); ?>" id="date_box_text_color" name="date_box_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="date_box_comments_number_text_color"><?php _e('Date box comments number text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_comments_number_text_color"]); ?>" id="date_box_comments_number_text_color" name="date_box_comments_number_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="date_box_comments_number_border_color"><?php _e('Date box comments number border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_comments_number_border_color"]); ?>" id="date_box_comments_number_border_color" name="date_box_comments_number_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="date_box_comments_number_hover_border_color"><?php _e('Date box comments number hover border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_comments_number_hover_border_color"]); ?>" id="date_box_comments_number_hover_border_color" name="date_box_comments_number_hover_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="gallery_box_color"><?php _e('Gallery box color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_color"]); ?>" id="gallery_box_color" name="gallery_box_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="gallery_box_hover_color"><?php _e('Gallery box hover color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_hover_color"]); ?>" id="gallery_box_hover_color" name="gallery_box_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="timetable_box_color"><?php _e('Timetable box color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timetable_box_color"]); ?>" id="timetable_box_color" name="timetable_box_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="timetable_box_hover_color"><?php _e('Timetable box hover color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timetable_box_hover_color"]); ?>" id="timetable_box_hover_color" name="timetable_box_hover_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="gallery_details_box_border_color"><?php _e('Gallery details box border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_details_box_border_color"]); ?>" id="gallery_details_box_border_color" name="gallery_details_box_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="bread_crumb_border_color"><?php _e('Bread crumb border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["bread_crumb_border_color"]); ?>" id="bread_crumb_border_color" name="bread_crumb_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="accordion_item_border_color"><?php _e('Accordion item border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_color"]); ?>" id="accordion_item_border_color" name="accordion_item_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="accordion_item_border_hover_color"><?php _e('Accordion item border hover color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_hover_color"]); ?>" id="accordion_item_border_hover_color" name="accordion_item_border_hover_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="accordion_item_border_active_color"><?php _e('Accordion item border active color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_active_color"]); ?>" id="accordion_item_border_active_color" name="accordion_item_border_active_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="copyright_area_border_color"><?php _e('Copyright area border color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["copyright_area_border_color"]); ?>" id="copyright_area_border_color" name="copyright_area_border_color">
							<span class="description"><?php _e('Enter \'none\' for no border', 'medicenter'); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="top_hint_background_color"><?php _e('Top hint background color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["top_hint_background_color"]); ?>" id="top_hint_background_color" name="top_hint_background_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="top_hint_text_color"><?php _e('Top hint text color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["top_hint_text_color"]); ?>" id="top_hint_text_color" name="top_hint_text_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="comment_reply_button_color"><?php _e('Comment reply button color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["comment_reply_button_color"]); ?>" id="comment_reply_button_color" name="comment_reply_button_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="post_author_link_color"><?php _e('Post author link color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["post_author_link_color"]); ?>" id="post_author_link_color" name="post_author_link_color">
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="contact_details_box_background_color"><?php _e('Contact details box background color', 'medicenter'); ?></label>
						</th>
						<td>
							<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["contact_details_box_background_color"]); ?>" id="contact_details_box_background_color" name="contact_details_box_background_color">
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Colors Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<div id="tab-fonts">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th colspan="2" scope="row" style="font-weight: bold;">
							<?php
							_e('Fonts', 'medicenter');
							?>
						</th>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="header_font"><?php _e('Header font', 'medicenter'); ?></label>
						</th>
						<td>
							<select id="header_font" name="header_font">
								<option<?php echo ($theme_options["header_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default", 'medicenter'); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo ($theme_options["header_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo ($theme_options["header_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family; ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="subheader_font"><?php _e('Subheader font', 'medicenter'); ?></label>
						</th>
						<td>
							<select id="subheader_font" name="subheader_font">
								<option<?php echo ($theme_options["subheader_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default", 'medicenter'); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo ($theme_options["subheader_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo ($theme_options["subheader_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo $fontsArray->items[$i]->family; ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<p>
				<input type="submit" value="<?php _e('Save Fonts Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
			</p>
		</div>
		<p>
			<input type="hidden" name="action" value="<?php echo $themename; ?>_save" />
			<input type="submit" value="<?php _e('Save All Options', 'medicenter'); ?>" class="button-primary" name="<?php echo $themename; ?>_submit">
		</p>
		<input type="hidden" id="<?php echo $themename; ?>-selected-tab" value="<?php echo $selected_tab;?>" />
	</form>
<?php
	*/
}
?>