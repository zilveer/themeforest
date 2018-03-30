<?php
global $themename;

//admin menu
function theme_admin_menu() 
{
	global $themename;
	add_submenu_page("themes.php", ucfirst('gymbase'), "Theme Options", "edit_theme_options", "ThemeOptions", $themename . "_options");
}
add_action("admin_menu", "theme_admin_menu");

function theme_stripslashes_deep($value)
{
	$value = is_array($value) ?
				array_map('stripslashes_deep', $value) :
				stripslashes($value);

	return $value;
}

function gymbase_save_options()
{
	global $themename;
	$theme_options = array(
		"favicon_url" => $_POST["favicon_url"],
		"logo_url" => $_POST["logo_url"],
		"logo_first_part_text" => $_POST["logo_first_part_text"],
		"logo_second_part_text" => $_POST["logo_second_part_text"],
		"footer_text_left" => $_POST["footer_text_left"],
		"footer_text_right" => $_POST["footer_text_right"],
		"home_page_top_hint" => $_POST["home_page_top_hint"],
		"responsive" => (int)$_POST["responsive"],
		"collapsible_mobile_submenus" => $_POST["collapsible_mobile_submenus"],
		"google_api_code" => $_POST["google_api_code"],
		"ga_tracking_code" => $_POST["ga_tracking_code"],
		"slider_image_url" => array_filter($_POST["slider_image_url"]),
		"slider_image_title" => array_filter($_POST["slider_image_title"]),
		"slider_image_subtitle" => array_filter($_POST["slider_image_subtitle"]),
		"slider_image_link" => array_filter($_POST["slider_image_link"]),
		"slider_autoplay" => $_POST["slider_autoplay"],
		"slide_interval" => (int)$_POST["slide_interval"],
		"slider_effect" => $_POST["slider_effect"],
		"slider_transition" => $_POST["slider_transition"],
		"slider_transition_speed" => (int)$_POST["slider_transition_speed"],
		"show_share_box" => $_POST["show_share_box"],
		"social_icon_type" => $_POST["social_icon_type"],
		"social_icon_url" => $_POST["social_icon_url"],
		"social_icon_target" => $_POST["social_icon_target"],
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
		"contact_logo_first_part_text" => $_POST["contact_logo_first_part_text"],
		"contact_logo_second_part_text" => $_POST["contact_logo_second_part_text"],
		"contact_phone" => $_POST["contact_phone"],
		"contact_fax" => $_POST["contact_fax"],
		"contact_email" => $_POST["contact_email"],
		"header_background_color" => $_POST["header_background_color"],
		"body_background_color" => $_POST["body_background_color"],
		"footer_background_color" => $_POST["footer_background_color"],
		"link_color" => $_POST["link_color"],
		"link_hover_color" => $_POST["link_hover_color"],
		"slider_title_color" => $_POST["slider_title_color"],
		"slider_subtitle_color" => $_POST["slider_subtitle_color"],
		"slider_text_border_color" => $_POST["slider_text_border_color"],
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
		"mobile_menu_link_color" => $_POST["mobile_menu_link_color"],
		"mobile_menu_position_background_color" => $_POST["mobile_menu_position_background_color"],
		"mobile_menu_active_link_color" => $_POST["mobile_menu_active_link_color"],
		"mobile_menu_active_position_background_color" => $_POST["mobile_menu_active_position_background_color"],
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
		"top_hint_background_color" => $_POST["top_hint_background_color"],
		"top_hint_text_color" => $_POST["top_hint_text_color"],
		"comment_reply_button_color" => $_POST["comment_reply_button_color"],
		"post_author_link_color" => $_POST["post_author_link_color"],
		"contact_details_box_background_color" => $_POST["contact_details_box_background_color"],
		"header_font" => $_POST["header_font"],
		"header_font_subset" => (isset($_POST["header_font_subset"]) ? $_POST["header_font_subset"] : ""),
		"subheader_font" => $_POST["subheader_font"],
		"subheader_font_subset" => (isset($_POST["subheader_font_subset"]) ? $_POST["subheader_font_subset"] : ""),
	);
	update_option($themename . "_options", $theme_options);
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
	$url = "http://quanticalabs.com/wptest/gymbase/files/2014/07/" . $file["name"] . "." . $file["extension"];
	
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
function gymbase_import_dummy()
{
	ob_start();
	$result = array("info" => "");
	//import dummy content
	$fetch_attachments = true;
	$file = download_import_file(array(
		"name" => "gymbase-content.xml",
		"extension" => "gz"
	));
	if(!is_wp_error($file))
		require_once('importer/importer.php');
	else
	{
		$result["info"] .= "Import file: gymbase-content.xml.gz not found! Please upload import file manually into Media library. You can find this file in main theme directory inside zip archive downloaded from ThemeForest.";
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
		"name" => "widget_data",
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
		
		$result["info"] = "gymbase-content.xml.gz file content and widgets settings has been imported successfully!";
		$system_message = ob_get_clean();
		$result["system_message"] = $system_message;
	}
	
	echo "dummy_import_start" . json_encode($result) . "dummy_import_end";
	exit();
}
add_action('wp_ajax_' . $themename . '_import_dummy', $themename . '_import_dummy');

function gymbase_import_shop_dummy()
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
		$result["info"] = "dummy_shop.xml.gz file content has been imported successfully!";
	$system_message = ob_get_clean();
	$result["system_message"] = $system_message;
	echo "dummy_import_start" . json_encode($result) . "dummy_import_end";
	exit();
}
add_action('wp_ajax_' . $themename . '_import_shop_dummy', $themename . '_import_shop_dummy');

function gymbase_options() 
{
	global $themename;
	if(isset($_POST["action"]) && $_POST["action"]==$themename . "_save")
	{
		$theme_options = (array)get_option($themename . "_options");
		$theme_options = array(
			"logo_url" => $_POST["logo_url"],
			"logo_first_part_text" => $_POST["logo_first_part_text"],
			"logo_second_part_text" => $_POST["logo_second_part_text"],
			"footer_text_left" => $_POST["footer_text_left"],
			"footer_text_right" => $_POST["footer_text_right"],
			"home_page_top_hint" => $_POST["home_page_top_hint"],
			"responsive" => (int)$_POST["responsive"],
			"collapsible_mobile_submenus" => '',
			"google_api_code" => $_POST["google_api_code"],
			"ga_tracking_code" => $_POST["ga_tracking_code"],
			"slider_image_url" => array_filter($_POST["slider_image_url"]),
			"slider_image_title" => array_filter($_POST["slider_image_title"]),
			"slider_image_subtitle" => array_filter($_POST["slider_image_subtitle"]),
			"slider_image_link" => array_filter($_POST["slider_image_link"]),
			"slider_autoplay" => $_POST["slider_autoplay"],
			"slide_interval" => (int)$_POST["slide_interval"],
			"slider_effect" => $_POST["slider_effect"],
			"slider_transition" => $_POST["slider_transition"],
			"slider_transition_speed" => (int)$_POST["slider_transition_speed"],
			"show_share_box" => $_POST["show_share_box"],
			"social_icon_type" => $_POST["social_icon_type"],
			"social_icon_url" => $_POST["social_icon_url"],
			"social_icon_target" => $_POST["social_icon_target"],
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
			"contact_logo_first_part_text" => $_POST["contact_logo_first_part_text"],
			"contact_logo_second_part_text" => $_POST["contact_logo_second_part_text"],
			"contact_phone" => $_POST["contact_phone"],
			"contact_fax" => $_POST["contact_fax"],
			"contact_email" => $_POST["contact_email"],
			"header_background_color" => $_POST["header_background_color"],
			"body_background_color" => $_POST["body_background_color"],
			"footer_background_color" => $_POST["footer_background_color"],
			"link_color" => $_POST["link_color"],
			"link_hover_color" => $_POST["link_hover_color"],
			"slider_title_color" => $_POST["slider_title_color"],
			"slider_subtitle_color" => $_POST["slider_subtitle_color"],
			"slider_text_border_color" => $_POST["slider_text_border_color"],
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
			"mobile_menu_link_color" => $_POST["mobile_menu_link_color"],
			"mobile_menu_position_background_color" => $_POST["mobile_menu_position_background_color"],
			"mobile_menu_active_link_color" => $_POST["mobile_menu_active_link_color"],
			"mobile_menu_active_position_background_color" => $_POST["mobile_menu_active_position_background_color"],
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
			"top_hint_background_color" => $_POST["top_hint_background_color"],
			"top_hint_text_color" => $_POST["top_hint_text_color"],
			"comment_reply_button_color" => $_POST["comment_reply_button_color"],
			"post_author_link_color" => $_POST["post_author_link_color"],
			"contact_details_box_background_color" => $_POST["contact_details_box_background_color"],
			"header_font" => $_POST["header_font"],
			"subheader_font" => $_POST["subheader_font"]
		);
		update_option($themename . "_options", $theme_options);
	}
	$theme_options = array(
		"favicon_url" => '',
		"logo_url" => '',
		"logo_first_part_text" => '',
		"logo_second_part_text" => '',
		"footer_text_left" => '',
		"footer_text_right" => '',
		"home_page_top_hint" => '',
		"responsive" => '',
		"collapsible_mobile_submenus" => '',
		"google_api_code" => '',
		"ga_tracking_code" => '',
		"slider_image_url" => '',
		"slider_image_title" => '',
		"slider_image_subtitle" => '',
		"slider_image_link" => '',
		"slider_autoplay" => '',
		"slide_interval" => '',
		"slider_effect" => '',
		"slider_transition" => '',
		"slider_transition_speed" => '',
		"show_share_box" => '',
		"social_icon_type" => '',
		"social_icon_url" => '',
		"social_icon_target" => '',
		"footer_text_left" => '',
		"footer_text_right" => '',
		"cf_admin_name" => '',
		"cf_admin_email" => '',
		"cf_smtp_host" => '',
		"cf_smtp_username" => '',
		"cf_smtp_password" => '',
		"cf_smtp_port" => '',
		"cf_smtp_secure" => '',
		"cf_email_subject" => '',
		"cf_template" => '',
		"contact_logo_first_part_text" => '',
		"contact_logo_second_part_text" => '',
		"contact_phone" => '',
		"contact_fax" => '',
		"contact_email" => '',
		"header_background_color" => '',
		"body_background_color" => '',
		"footer_background_color" => '',
		"link_color" => '',
		"link_hover_color" => '',
		"slider_title_color" => '',
		"slider_subtitle_color" => '',
		"slider_text_border_color" => '',
		"body_headers_color" => '',
		"body_headers_border_color" => '',
		"body_text_color" => '',
		"body_text2_color" => '',
		"footer_headers_color" => '',
		"footer_headers_border_color" => '',
		"footer_text_color" => '',
		"timeago_label_color" => '',
		"sentence_color" => '',
		"logo_first_part_text_color" => '',
		"logo_second_part_text_color" => '',
		"body_button_color" => '',
		"body_button_hover_color" => '',
		"body_button_border_color" => '',
		"body_button_border_hover_color" => '',
		"footer_button_color" => '',
		"footer_button_hover_color" => '',
		"footer_button_border_color" => '',
		"footer_button_border_hover_color" => '',
		"menu_link_color" => '',
		"menu_link_border_color" => '',
		"menu_active_color" => '',
		"menu_active_border_color" => '',
		"menu_hover_color" => '',
		"menu_hover_border_color" => '',
		"submenu_background_color" => '',
		"submenu_hover_background_color" => '',
		"submenu_color" => '',
		"submenu_hover_color" => '',
		"mobile_menu_link_color" => '',
		"mobile_menu_position_background_color" => '',
		"mobile_menu_active_link_color" => '',
		"mobile_menu_active_position_background_color" => '',
		"form_hint_color" => '',
		"form_field_text_color" => '',
		"form_field_border_color" => '',
		"form_field_active_border_color" => '',
		"date_box_color" => '',
		"date_box_text_color" => '',
		"date_box_comments_number_text_color" => '',
		"date_box_comments_number_border_color" => '',
		"date_box_comments_number_hover_border_color" => '',
		"gallery_box_color" => '',
		"gallery_box_text_first_line_color" => '',
		"gallery_box_text_second_line_color" => '',
		"gallery_box_hover_color" => '',
		"gallery_box_hover_text_first_line_color" => '',
		"gallery_box_hover_text_second_line_color" => '',
		"timetable_box_color" => '',
		"timetable_box_hover_color" => '',
		"gallery_details_box_border_color" => '',
		"bread_crumb_border_color" => '',
		"accordion_item_border_color" => '',
		"accordion_item_border_hover_color" => '',
		"accordion_item_border_active_color" => '',
		"copyright_area_border_color" => '',
		"top_hint_background_color" => '',
		"top_hint_text_color" => '',
		"comment_reply_button_color" => '',
		"post_author_link_color" => '',
		"contact_details_box_background_color" => '',
		"header_font" => '',
		"header_font_subset" => '',
		"subheader_font" => '',
		"subheader_font_subset" => ''
	);
	$theme_options = theme_stripslashes_deep(array_merge($theme_options, get_option($themename . "_options")));
?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2><?php echo ucfirst('gymbase');?> Options</h2>
	</div>
	<?php 
	if(isset($_POST["action"]) && $_POST["action"]==$themename . "_save")
	{
	?>
	<div class="updated"> 
		<p>
			<strong>
				<?php _e('Options saved', 'gymbase'); ?>
			</strong>
		</p>
	</div>
	<?php
	}
	//get google fonts	
	$fontsArray = gb_get_google_fonts();	
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
						<a href="http://themeforest.net/item/gymbase-responsive-gym-fitness-wordpress-theme/2732248?ref=quanticalabs" title="GymBase - Responsive Gym Fitness WordPress Theme">
							Gymbase
						</a>
					</h3>
					<h5>Responsive Gym Fitness WordPress Theme</h5>
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
						<?php _e('Main', 'gymbase'); ?>
						<span class="general"></span>
					</a>
				</li>
				<li>
					<a href="#tab-slider">
						<?php _e('Slider', 'gymbase'); ?>
						<span class="plugin"></span>
					</a>
				</li>
				<li>
					<a href="#tab-contact-form">
						<?php _e('Contact Form', 'gymbase'); ?>
						<span class="plugin"></span>
					</a>
				</li>
				<li>
					<a href="#tab-social-share">
						<?php _e('Social Share', 'gymbase'); ?>
						<span class="plugin"></span>
					</a>
				</li>
				<li>
					<a href="#tab-contact-details">
						<?php _e('Contact Details', 'gymbase'); ?>
						<span class="plugin"></span>
					</a>
				</li>
				<li>
					<a href="#tab-colors">
						<?php _e('Colors', 'gymbase'); ?>
						<span class="general"></span>
					</a>
					<ul class="submenu">
						<li>
							<a href="#tab-colors_general">
								<?php _e('General', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_text">
								<?php _e('Text', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_buttons">
								<?php _e('Buttons', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_menu">
								<?php _e('Menu', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_forms">
								<?php _e('Forms', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_miscellaneous">
								<?php _e('Miscellaneous', 'gymbase'); ?>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#tab-fonts">
						<?php _e('Fonts', 'gymbase'); ?>
						<span class="font"></span>
					</a>
				</li>
			</ul>
			<div id="tab-main" class="settings" style="display: block;">
				<h3><?php _e('Main', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="import_dummy"><?php _e('DUMMY CONTENT IMPORT', 'gymbase'); ?></label>
						<div>
							<input type="button" class="button" name="<?php echo $themename;?>_import_dummy" id="import_dummy" value="<?php _e('Import dummy content', 'gymbase'); ?>" />
							<img id="dummy_content_preloader" src="<?php echo get_template_directory_uri();?>/admin/images/ajax-loader.gif" />
							<img id="dummy_content_tick" src="<?php echo get_template_directory_uri();?>/admin/images/tick.png" />
							<div id="dummy_content_info"></div>
						</div>
					</li>
					<?php
					if(is_plugin_active('woocommerce/woocommerce.php')):
					?>
					<li>
						<label for="import_shop_dummy"><?php _e('DUMMY SHOP CONTENT IMPORT', 'gymbase'); ?></label>
						<input type="button" class="button" name="<?php echo esc_attr($themename);?>_import_shop_dummy" id="import_shop_dummy" value="<?php esc_attr_e('Import shop dummy content', 'gymbase'); ?>" />
						<img id="dummy_shop_content_preloader" src="<?php echo get_template_directory_uri();?>/admin/images/ajax-loader.gif" />
						<img id="dummy_shop_content_tick" src="<?php echo get_template_directory_uri();?>/admin/images/tick.png" />
						<div id="dummy_shop_content_info"></div>
					</li>
					<?php
					endif;
					?>
					<li>
						<label for="favicon_url"><?php _e('FAVICON URL', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo (isset($theme_options["favicon_url"]) ? esc_attr($theme_options["favicon_url"]) : ""); ?>" id="favicon_url" name="favicon_url">
							<input type="button" class="button" name="<?php echo esc_attr($themename);?>_upload_button" id="favicon_url_upload_button" value="<?php esc_attr_e('Insert favicon', 'gymbase'); ?>" />
						</div>
					</li>
					<li>
						<label for="logo_url"><?php _e('LOGO URL', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_url"]); ?>" id="logo_url" name="logo_url">
							<input type="button" class="button" name="<?php echo $themename;?>_upload_button" id="logo_url_upload_button" value="<?php _e('Insert logo', 'gymbase'); ?>" />
						</div>
					</li>
					<li>
						<label for="logo_first_part_text"><?php _e('LOGO FIRST PART TEXT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_first_part_text"]); ?>" id="logo_first_part_text" name="logo_first_part_text">
						</div>
					</li>
					<li>
						<label for="logo_second_part_text"><?php _e('LOGO SECOND PART TEXT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_second_part_text"]); ?>" id="logo_second_part_text" name="logo_second_part_text">
						</div>
					</li>
					<li>
						<label for="footer_text_left"><?php _e('FOOTER TEXT LEFT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["footer_text_left"]); ?>" id="footer_text_left" name="footer_text_left">
						</div>
					</li>
					<li>
						<label for="footer_text_right"><?php _e('FOOTER TEXT RIGHT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["footer_text_right"]); ?>" id="footer_text_right" name="footer_text_right">
						</div>
					</li>
					<li>
						<label for="home_page_top_hint"><?php _e('HOME PAGE TOP HINT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["home_page_top_hint"]); ?>" id="home_page_top_hint" name="home_page_top_hint">
						</div>
					</li>
					<li>
						<label for="responsive"><?php _e('RESPONSIVE', 'gymbase'); ?></label>
						<div>
							<select id="responsive" name="responsive">
								<option value="1"<?php echo ((int)$theme_options["responsive"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["responsive"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="collapsible_mobile_submenus"><?php _e('Collapsible mobile submenus', 'gymbase'); ?></label>
						<div>
							<select id="collapsible_mobile_submenus" name="collapsible_mobile_submenus">
								<option value="1"<?php echo (!isset($theme_options["collapsible_mobile_submenus"]) || (int)$theme_options["collapsible_mobile_submenus"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["collapsible_mobile_submenus"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="google_api_code"><?php _e('Google Maps API Key', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["google_api_code"]); ?>" id="google_api_code" name="google_api_code">
							<span class="description"><?php printf(__('You can generate API Key <a href="%s" target="_blank" title="Generate API Key">here</a>', 'gymbase'), "https://developers.google.com/maps/documentation/javascript/get-api-key"); ?></span>
						</div>
					</li>
					<li>
						<label for="ga_tracking_code"><?php _e('Google Analytics tracking code', 'gymbase'); ?></label>
						<div>
							<textarea id="ga_tracking_code" name="ga_tracking_code"><?php echo esc_attr($theme_options["ga_tracking_code"]); ?></textarea>
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-slider" class="settings">
				<h3><?php _e('Slider', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<?php
					$slides_count = count($theme_options["slider_image_url"]);
					if($slides_count==0)
						$slides_count = 3;
					for($i=0; $i<$slides_count; $i++)
					{
					?>
					<li class="slider_image_url_row">
						<label><?php _e('SLIDER IMAGE URL', 'gymbase'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_url_<?php echo ($i+1); ?>" name="slider_image_url[]" value="<?php echo esc_attr($theme_options["slider_image_url"][$i]); ?>" />
							<input type="button" class="button" name="<?php echo $themename;?>_upload_button" id="<?php echo $themename;?>_slider_image_url_button_<?php echo ($i+1); ?>" value="<?php _e('Browse', 'gymbase'); ?>" />
						</div>
					</li>
					<li class="slider_image_title_row">
						<label><?php _e('SLIDER IMAGE TITLE', 'gymbase'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_title_<?php echo ($i+1); ?>" name="slider_image_title[]" value="<?php echo esc_attr($theme_options["slider_image_title"][$i]); ?>" />
						</div>
					</li>
					<li class="slider_image_subtitle_row">
						<label><?php _e('SLIDER IMAGE SUBTITLE', 'gymbase'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_subtitle_<?php echo ($i+1); ?>" name="slider_image_subtitle[]" value="<?php echo esc_attr($theme_options["slider_image_subtitle"][$i]); ?>" />
						</div>
					</li>
					<li class="slider_image_link_row">
						<label><?php _e('SLIDER IMAGE LINK', 'gymbase'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="<?php echo $themename;?>_slider_image_link_<?php echo ($i+1); ?>" name="slider_image_link[]" value="<?php echo esc_attr($theme_options["slider_image_link"][$i]); ?>" />
						</div>
					</li>
					<?php
					}
					?>
					<li>
						<input type="button" class="button" name="<?php echo $themename;?>_add_new_button" id="<?php echo $themename;?>_add_new_button" value="<?php _e('Add slider image', 'gymbase'); ?>" />
					</li>
					<li>
						<label><?php _e('AUTOPLAY', 'gymbase'); ?></label>
						<div>
							<select id="slider_autoplay" name="slider_autoplay">
								<option value="true"<?php echo ($theme_options["slider_autoplay"]=="true" ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
								<option value="false"<?php echo ($theme_options["slider_autoplay"]=="false" ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="slide_interval"><?php _e('SLIDE INTERVAL:', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" id="slide_interval" name="slide_interval" value="<?php echo (int)esc_attr($theme_options["slide_interval"]); ?>" />
						</div>
					</li>
					<li>
						<label for="slider_effect"><?php _e('EFFECT:', 'gymbase'); ?></label>
						<div>
							<select id="slider_effect" name="slider_effect">
								<option value="scroll"<?php echo ($theme_options["slider_effect"]=="scroll" ? " selected='selected'" : "") ?>><?php _e('scroll', 'gymbase'); ?></option>
								<option value="none"<?php echo ($theme_options["slider_effect"]=="none" ? " selected='selected'" : "") ?>><?php _e('none', 'gymbase'); ?></option>
								<option value="directscroll"<?php echo ($theme_options["slider_effect"]=="directscroll" ? " selected='selected'" : "") ?>><?php _e('directscroll', 'gymbase'); ?></option>
								<option value="fade"<?php echo ($theme_options["slider_effect"]=="fade" ? " selected='selected'" : "") ?>><?php _e('fade', 'gymbase'); ?></option>
								<option value="crossfade"<?php echo ($theme_options["slider_effect"]=="crossfade" ? " selected='selected'" : "") ?>><?php _e('crossfade', 'gymbase'); ?></option>
								<option value="cover"<?php echo ($theme_options["slider_effect"]=="cover" ? " selected='selected'" : "") ?>><?php _e('cover', 'gymbase'); ?></option>
								<option value="uncover"<?php echo ($theme_options["slider_effect"]=="uncover" ? " selected='selected'" : "") ?>><?php _e('uncover', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="slider_transition"><?php _e('TRANSITION:', 'gymbase'); ?></label>
						<div>
							<select id="slider_transition" name="slider_transition">
								<option value="swing"<?php echo ($theme_options["slider_transition"]=="swing" ? " selected='selected'" : "") ?>><?php _e('swing', 'gymbase'); ?></option>
								<option value="linear"<?php echo ($theme_options["slider_transition"]=="linear" ? " selected='selected'" : "") ?>><?php _e('linear', 'gymbase'); ?></option>
								<option value="easeInQuad"<?php echo ($theme_options["slider_transition"]=="easeInQuad" ? " selected='selected'" : "") ?>><?php _e('easeInQuad', 'gymbase'); ?></option>
								<option value="easeOutQuad"<?php echo ($theme_options["slider_transition"]=="easeOutQuad" ? " selected='selected'" : "") ?>><?php _e('easeOutQuad', 'gymbase'); ?></option>
								<option value="easeInOutQuad"<?php echo ($theme_options["slider_transition"]=="easeInOutQuad" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuad', 'gymbase'); ?></option>
								<option value="easeInCubic"<?php echo ($theme_options["slider_transition"]=="easeInCubic" ? " selected='selected'" : "") ?>><?php _e('easeInCubic', 'gymbase'); ?></option>
								<option value="easeOutCubic"<?php echo ($theme_options["slider_transition"]=="easeOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeOutCubic', 'gymbase'); ?></option>
								<option value="easeInOutCubic"<?php echo ($theme_options["slider_transition"]=="easeInOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeInOutCubic', 'gymbase'); ?></option>
								<option value="easeInOutCubic"<?php echo ($theme_options["slider_transition"]=="easeInOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeInOutCubic', 'gymbase'); ?></option>
								<option value="easeInQuart"<?php echo ($theme_options["slider_transition"]=="easeInQuart" ? " selected='selected'" : "") ?>><?php _e('easeInQuart', 'gymbase'); ?></option>
								<option value="easeOutQuart"<?php echo ($theme_options["slider_transition"]=="easeOutQuart" ? " selected='selected'" : "") ?>><?php _e('easeOutQuart', 'gymbase'); ?></option>
								<option value="easeInOutQuart"<?php echo ($theme_options["slider_transition"]=="easeInOutQuart" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuart', 'gymbase'); ?></option>
								<option value="easeInSine"<?php echo ($theme_options["slider_transition"]=="easeInSine" ? " selected='selected'" : "") ?>><?php _e('easeInSine', 'gymbase'); ?></option>
								<option value="easeOutSine"<?php echo ($theme_options["slider_transition"]=="easeOutSine" ? " selected='selected'" : "") ?>><?php _e('easeOutSine', 'gymbase'); ?></option>
								<option value="easeInOutSine"<?php echo ($theme_options["slider_transition"]=="easeInOutSine" ? " selected='selected'" : "") ?>><?php _e('easeInOutSine', 'gymbase'); ?></option>
								<option value="easeInExpo"<?php echo ($theme_options["slider_transition"]=="easeInExpo" ? " selected='selected'" : "") ?>><?php _e('easeInExpo', 'gymbase'); ?></option>
								<option value="easeOutExpo"<?php echo ($theme_options["slider_transition"]=="easeOutExpo" ? " selected='selected'" : "") ?>><?php _e('easeOutExpo', 'gymbase'); ?></option>
								<option value="easeInOutExpo"<?php echo ($theme_options["slider_transition"]=="easeInOutExpo" ? " selected='selected'" : "") ?>><?php _e('easeInOutExpo', 'gymbase'); ?></option>
								<option value="easeInQuint"<?php echo ($theme_options["slider_transition"]=="easeInQuint" ? " selected='selected'" : "") ?>><?php _e('easeInQuint', 'gymbase'); ?></option>
								<option value="easeOutQuint"<?php echo ($theme_options["slider_transition"]=="easeOutQuint" ? " selected='selected'" : "") ?>><?php _e('easeOutQuint', 'gymbase'); ?></option>
								<option value="easeInOutQuint"<?php echo ($theme_options["slider_transition"]=="easeInOutQuint" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuint', 'gymbase'); ?></option>
								<option value="easeInCirc"<?php echo ($theme_options["slider_transition"]=="easeInCirc" ? " selected='selected'" : "") ?>><?php _e('easeInCirc', 'gymbase'); ?></option>
								<option value="easeOutCirc"<?php echo ($theme_options["slider_transition"]=="easeOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeOutCirc', 'gymbase'); ?></option>
								<option value="easeInOutCirc"<?php echo ($theme_options["slider_transition"]=="easeInOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeInOutCirc', 'gymbase'); ?></option>
								<option value="easeInElastic"<?php echo ($theme_options["slider_transition"]=="easeInElastic" ? " selected='selected'" : "") ?>><?php _e('easeInElastic', 'gymbase'); ?></option>
								<option value="easeOutElastic"<?php echo ($theme_options["slider_transition"]=="easeOutElastic" ? " selected='selected'" : "") ?>><?php _e('easeOutElastic', 'gymbase'); ?></option>
								<option value="easeInOutElastic"<?php echo ($theme_options["slider_transition"]=="easeInOutElastic" ? " selected='selected'" : "") ?>><?php _e('easeInOutElastic', 'gymbase'); ?></option>
								<option value="easeInBack"<?php echo ($theme_options["slider_transition"]=="easeInBack" ? " selected='selected'" : "") ?>><?php _e('easeInBack', 'gymbase'); ?></option>
								<option value="easeOutBack"<?php echo ($theme_options["slider_transition"]=="easeOutBack" ? " selected='selected'" : "") ?>><?php _e('easeOutBack', 'gymbase'); ?></option>
								<option value="easeInOutBack"<?php echo ($theme_options["slider_transition"]=="easeOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeInOutBack', 'gymbase'); ?></option>
								<option value="easeInBounce"<?php echo ($theme_options["slider_transition"]=="easeInBounce" ? " selected='selected'" : "") ?>><?php _e('easeInBounce', 'gymbase'); ?></option>
								<option value="easeOutBounce"<?php echo ($theme_options["slider_transition"]=="easeOutBounce" ? " selected='selected'" : "") ?>><?php _e('easeOutBounce', 'gymbase'); ?></option>
								<option value="easeInOutBounce"<?php echo ($theme_options["slider_transition"]=="easeInOutBounce" ? " selected='selected'" : "") ?>><?php _e('easeInOutBounce', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="slider_transition_speed"><?php _e('TRANSITION SPEED:', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" id="slider_transition_speed" name="slider_transition_speed" value="<?php echo (int)esc_attr($theme_options["slider_transition_speed"]); ?>" />
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-contact-form" class="settings">
				<h3><?php _e('Contact Form', 'gymbase'); ?></h3>
				<h4><?php _e('ADMIN EMAIL CONFIG', 'gymbase');	?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_admin_name"><?php _e('NAME', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_name"]); ?>" id="cf_admin_name" name="cf_admin_name">
						</div>
					</li>
					<li>
						<label for="cf_admin_email"><?php _e('EMAIL', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_email"]); ?>" id="cf_admin_email" name="cf_admin_email">
						</div>
					</li>
				</ul>
				<h4><?php _e('ADMIN SMTP CONFIG (OPTIONAL)', 'gymbase'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_smtp_host"><?php _e('HOST', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_host"]); ?>" id="cf_smtp_host" name="cf_smtp_host">
						</div>
					</li>
					<li>
						<label for="cf_smtp_username"><?php _e('USERNAME', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_username"]); ?>" id="cf_smtp_username" name="cf_smtp_username">
						</div>
					</li>
					<li>
						<label for="cf_smtp_password"><?php _e('PASSWORD', 'gymbase'); ?></label>
						<div>
							<input type="password" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_password"]); ?>" id="cf_smtp_password" name="cf_smtp_password">
						</div>
					</li>
					<li>
						<label for="cf_smtp_port"><?php _e('PORT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_port"]); ?>" id="cf_smtp_port" name="cf_smtp_port">
						</div>
					</li>
					<li>
						<label for="cf_smtp_secure"><?php _e('SMTP SECURE', 'gymbase'); ?></label>
						<div>
							<select id="cf_smtp_secure" name="cf_smtp_secure">
								<option value=""<?php echo ($theme_options["cf_smtp_secure"]=="" ? " selected='selected'" : "") ?>>-</option>
								<option value="ssl"<?php echo ($theme_options["cf_smtp_secure"]=="ssl" ? " selected='selected'" : "") ?>><?php _e('ssl', 'gymbase'); ?></option>
								<option value="tls"<?php echo ($theme_options["cf_smtp_secure"]=="tls" ? " selected='selected'" : "") ?>><?php _e('tls', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
				</ul>
				<h4><?php _e('EMAIL CONFIG', 'gymbase'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_email_subject"><?php _e('EMAIL SUBJECT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_email_subject"]); ?>" id="cf_email_subject" name="cf_email_subject">
						</div>
					</li>
					<li>
						<label for="cf_template"><?php _e('TEMPLATE', 'gymbase'); ?></label>
						<div>
							<?php wp_editor($theme_options["cf_template"], "cf_template");?>
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-social-share" class="settings">
				<h3><?php _e('Social Share', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="show_share_box"><?php _e('Show share box', 'gymbase'); ?></label>
						<div>
							<select id="show_share_box" name="show_share_box">
								<option value="false"<?php echo (isset($theme_options["show_share_box"]) && $theme_options["show_share_box"]=="false" ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
								<option value="true"<?php echo (isset($theme_options["show_share_box"]) && $theme_options["show_share_box"]=="true" ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>								
							</select>
							<span class="description"><?php _e("Share box will be displayed at the end of each post, just before post author and categories information.", 'gymbase'); ?></span>
						</div>
					</li>
					<?php 
					$social_icons = array(
						"facebook",
						"google",
						"skype",
						"twitter",
						"instagram",
						"linkedin",
						"mail",
						"reddit",
						"stumbleupon",
						"tumblr",
						"pinterest",
					);
					$slides_count = (isset($theme_options["social_icon_url"]) ? count($theme_options["social_icon_url"]) : 0);
					if($slides_count==0)
						$slides_count = 4;
					for($i=0; $i<$slides_count; $i++)
					{
					?>
					<li class="social_icon_type_row">
						<label><?php echo ($i+1) . ". "; _e('Social icon type', 'gymbase'); ?></label>
						<div>
							<select name="social_icon_type[]" id="<?php echo $themename;?>_social_icon_type_<?php echo ($i+1); ?>">
								<?php
								foreach($social_icons as $social_icon):
									?>
									<option value="<?php echo $social_icon; ?>"<?php echo (isset($theme_options['social_icon_type'][$i]) && $social_icon==$theme_options['social_icon_type'][$i] ? " selected='selected'" : "") ?>><?php echo $social_icon; ?></option>
									<?php
								endforeach;
								?>
							</select>			
						</div>
					</li>
					<li class="social_icon_url_row">
						<label><?php echo ($i+1) . ". "; _e('Social icon url', 'gymbase'); ?></label>
						<div>
							<input class="regular-text" type="text" name="social_icon_url[]" value="<?php echo (isset($theme_options["social_icon_url"][$i]) ? esc_attr($theme_options["social_icon_url"][$i]) : ""); ?>"  id="<?php echo $themename;?>_social_icon_url_<?php echo ($i+1); ?>"/>
							<span class="description"><?php _e("Use <strong>{URL}</strong> constant to have current post url in the link. You can also use <strong>{TITLE}</strong> variable and {MEDIA_URL} variable. Example: http://www.facebook.com/sharer.php?u=<strong>{URL}</strong> You can use <a href='http://www.sharelinkgenerator.com/' target='_blank'>Share Link Generator</a> to create share link", 'gymbase'); ?></span>
						</div>
					</li>
					<li class="social_icon_target_row">
						<label><?php echo ($i+1) . ". "; _e('Social icon target', 'gymbase'); ?></label>
						<div>
							<select name="social_icon_target[]" id="<?php echo $themename;?>_social_icon_target_<?php echo ($i+1); ?>">
								<option value="same_window"<?php echo (isset($theme_options["social_icon_target"][$i]) && $theme_options["social_icon_target"][$i]=="same_window" ? " selected='selected'" : ""); ?>><?php _e("same window", 'gymbase'); ?></option>
								<option value="new_window"<?php echo (isset($theme_options["social_icon_target"][$i]) && $theme_options["social_icon_target"][$i]=="new_window" ? " selected='selected'" : ""); ?>><?php _e("new window", 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<?php
					}
					?>
					<li>
						<input type="button" class="button" name="<?php echo $themename;?>_add_new_icon_button" id="<?php echo $themename;?>_add_new_icon_button" value="<?php _e('Add social icon', 'gymbase'); ?>" />
					</li>
				</ul>
			</div>
			<div id="tab-contact-details" class="settings">
				<h3><?php _e('Contact Details', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="contact_logo_first_part_text"><?php _e('CONTACT LOGO FIRST PART TEXT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_logo_first_part_text"]); ?>" id="contact_logo_first_part_text" name="contact_logo_first_part_text">
						</div>
					</li>
					<li>
						<label for="contact_logo_second_part_text"><?php _e('CONTACT LOGO SECOND PART TEXT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_logo_second_part_text"]); ?>" id="contact_logo_second_part_text" name="contact_logo_second_part_text">
						</div>
					</li>
					<li>
						<label for="contact_phone"><?php _e('CONTACT PHONE', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_phone"]); ?>" id="contact_phone" name="contact_phone">
						</div>
					</li>
					<li>
						<label for="contact_fax"><?php _e('CONTACT FAX', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_fax"]); ?>" id="contact_fax" name="contact_fax">
						</div>
					</li>
					<li>
						<label for="contact_email"><?php _e('CONTACT EMAIL', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_email"]); ?>" id="contact_phone" name="contact_email">
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-colors" class="settings">
				<h3><?php _e('Colors', 'gymbase'); ?></h3>
				<div id="tab-colors_general" class="subsettings">
					<h4><?php _e('GENERAL', 'gymbase'); ?></h4>
					<ul class="form_field_list">
						<li>
							<label for="header_background_color"><?php _e('Header background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["header_background_color"]) ? esc_attr($theme_options["header_background_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["header_background_color"]); ?>" id="header_background_color" name="header_background_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="body_background_color"><?php _e('Body background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_background_color"]) ? esc_attr($theme_options["body_background_color"]) : "151515"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_background_color"]); ?>" id="body_background_color" name="body_background_color" data-default-color="151515">
							</div>
						</li>
						<li>
							<label for="footer_background_color"><?php _e('Footer background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_background_color"]) ? esc_attr($theme_options["footer_background_color"]) : "303030"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_background_color"]); ?>" id="footer_background_color" name="footer_background_color" data-default-color="303030">
							</div>
						</li>
						<li>
							<label for="link_color"><?php _e('Link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["link_color"]) ? esc_attr($theme_options["link_color"]) : "59B42D"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["link_color"]); ?>" id="link_color" name="link_color" data-default-color="59B42D">
							</div>
						</li>
						<li>
							<label for="link_hover_color"><?php _e('Link hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["link_hover_color"]) ? esc_attr($theme_options["link_hover_color"]) : "59B42D"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["link_hover_color"]); ?>" id="link_hover_color" name="link_hover_color" data-default-color="59B42D">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_text" class="subsettings">
					<h4><?php _e('TEXT', 'gymbase'); ?></h4>
					<ul class="form_field_list">
						<li>
							<label for="slider_title_color"><?php _e('Slider title color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["slider_title_color"]) ? esc_attr($theme_options["slider_title_color"]) : "ffffff"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["slider_title_color"]); ?>" id="slider_title_color" name="slider_title_color" data-default-color="ffffff">
							</div>
						</li>
						<li>
							<label for="slider_subtitle_color"><?php _e('Slider subtitle color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["slider_subtitle_color"]) ? esc_attr($theme_options["slider_subtitle_color"]) : "ffffff"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["slider_subtitle_color"]); ?>" id="slider_subtitle_color" name="slider_subtitle_color" data-default-color="ffffff">
							</div>
						</li>
						<li>
							<label for="slider_text_border_color"><?php _e('Slider text border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["slider_text_border_color"]) ? esc_attr($theme_options["slider_text_border_color"]) : "ffffff"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["slider_text_border_color"]); ?>" id="slider_text_border_color" name="slider_text_border_color" data-default-color="ffffff">
							</div>
						</li>
						<li>
							<label for="body_headers_color"><?php _e('Body headers color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_headers_color"]) ? esc_attr($theme_options["body_headers_color"]) : "ffffff"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_headers_color"]); ?>" id="body_headers_color" name="body_headers_color" data-default-color="ffffff">
							</div>
						</li>
						<li>
							<label for="body_headers_border_color"><?php _e('Body headers border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_headers_border_color"]) ? esc_attr($theme_options["body_headers_border_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_headers_border_color"]); ?>" id="body_headers_border_color" name="body_headers_border_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="body_text_color"><?php _e('Body text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_text_color"]) ? esc_attr($theme_options["body_text_color"]) : "C5C5C5"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_text_color"]); ?>" id="body_text_color" name="body_text_color" data-default-color="C5C5C5">
							</div>
						</li>
						<li>
							<label for="body_text2_color"><?php _e('Body text 2 color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_text2_color"]) ? esc_attr($theme_options["body_text2_color"]) : "999999"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_text2_color"]); ?>" id="body_text2_color" name="body_text2_color" data-default-color="999999">
							</div>
						</li>
						<li>
							<label for="footer_headers_color"><?php _e('Footer headers color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_headers_color"]) ? esc_attr($theme_options["footer_headers_color"]) : "ffffff"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_headers_color"]); ?>" id="footer_headers_color" name="footer_headers_color" data-default-color="ffffff">
							</div>
						</li>
						<li>
							<label for="footer_headers_border_color"><?php _e('Footer headers border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_headers_border_color"]) ? esc_attr($theme_options["footer_headers_border_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_headers_border_color"]); ?>" id="footer_headers_border_color" name="footer_headers_border_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="footer_text_color"><?php _e('Footer text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_text_color"]) ? esc_attr($theme_options["footer_text_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_text_color"]); ?>" id="footer_text_color" name="footer_text_color" data-default-color="515151">
							</div>
						</li>
						<li>
							<label for="timeago_label_color"><?php _e('Timeago label color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["timeago_label_color"]) ? esc_attr($theme_options["timeago_label_color"]) : "59B42D"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timeago_label_color"]); ?>" id="timeago_label_color" name="timeago_label_color" data-default-color="59B42D">
							</div>
						</li>
						<li>
							<label for="sentence_color"><?php _e('Sentence color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["sentence_color"]) ? esc_attr($theme_options["sentence_color"]) : "59B42D"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["sentence_color"]); ?>" id="sentence_color" name="sentence_color" data-default-color="59B42D">
							</div>
						</li>
						<li>
							<label for="logo_first_part_text_color"><?php _e('Logo first part text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["logo_first_part_text_color"]) ? esc_attr($theme_options["logo_first_part_text_color"]) : "59B42D"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["logo_first_part_text_color"]); ?>" id="logo_first_part_text_color" name="logo_first_part_text_color" data-default-color="59B42D">
							</div>
						</li>
						<li>
							<label for="logo_second_part_text_color"><?php _e('Logo second part text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["logo_second_part_text_color"]) ? esc_attr($theme_options["logo_second_part_text_color"]) : "000000"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["logo_second_part_text_color"]); ?>" id="logo_second_part_text_color" name="logo_second_part_text_color" data-default-color="000000">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_buttons" class="subsettings">
					<h4><?php _e('BUTTONS', 'gymbase');?></h4>
					<ul class="form_field_list">
						<li>
							<label for="body_button_color"><?php _e('Body button text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_color"]) ? esc_attr($theme_options["body_button_color"]) : "ffffff"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_color"]); ?>" id="body_button_color" name="body_button_color" data-default-color="ffffff">
							</div>
						</li>
						<li>
							<label for="body_button_hover_color"><?php _e('Body button text hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_hover_color"]) ? esc_attr($theme_options["body_button_hover_color"]) : "ffffff"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_hover_color"]); ?>" id="body_button_hover_color" name="body_button_hover_color" data-default-color="ffffff">
							</div>
						</li>
						<li>
							<label for="body_button_border_color"><?php _e('Body button border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_border_color"]) ? esc_attr($theme_options["body_button_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_border_color"]); ?>" id="body_button_border_color" name="body_button_border_color" data-default-color="515151">
							</div>
						</li>
						<li>
							<label for="body_button_border_hover_color"><?php _e('Body button border hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_border_hover_color"]) ? esc_attr($theme_options["body_button_border_hover_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_border_hover_color"]); ?>" id="body_button_border_hover_color" name="body_button_border_hover_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="footer_button_color"><?php _e('Footer button text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_color"]) ? esc_attr($theme_options["footer_button_color"]) : "999999"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_color"]); ?>" id="footer_button_color" name="footer_button_color" data-default-color="999999">
							</div>
						</li>
						<li>
							<label for="footer_button_hover_color"><?php _e('Footer button text hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_hover_color"]) ? esc_attr($theme_options["footer_button_hover_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_hover_color"]); ?>" id="footer_button_hover_color" name="footer_button_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="footer_button_border_color"><?php _e('Footer button border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_border_color"]) ? esc_attr($theme_options["footer_button_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_border_color"]); ?>" id="footer_button_border_color" name="footer_button_border_color" data-default-color="515151">
							</div>
						</li>
						<li>
							<label for="footer_button_border_hover_color"><?php _e('Footer button border hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_border_hover_color"]) ? esc_attr($theme_options["footer_button_border_hover_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_border_hover_color"]); ?>" id="footer_button_border_hover_color" name="footer_button_border_hover_color" data-default-color="409915">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_menu" class="subsettings">
					<h4><?php _e('MENU', 'gymbase');?></h4>
					<ul class="form_field_list">
						<li>
							<label for="menu_link_color"><?php _e('Link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["menu_link_color"]) ? esc_attr($theme_options["menu_link_color"]) : "888888"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_link_color"]); ?>" id="menu_link_color" name="menu_link_color" data-default-color="888888">
							</div>
						</li>
						<li>
							<label for="menu_link_border_color"><?php _e('Link border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["menu_link_border_color"]) ? esc_attr($theme_options["menu_link_border_color"]) : "59B42D"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_link_border_color"]); ?>" id="menu_link_border_color" name="menu_link_border_color" data-default-color="59B42D">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="menu_active_color"><?php _e('Active color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["menu_active_color"]) ? esc_attr($theme_options["menu_active_color"]) : "000000"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_active_color"]); ?>" id="menu_active_color" name="menu_active_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="menu_active_border_color"><?php _e('Active border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["menu_active_border_color"]) ? esc_attr($theme_options["menu_active_border_color"]) : "59B42D"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_active_border_color"]); ?>" id="menu_active_border_color" name="menu_active_border_color" data-default-color="59B42D">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="menu_hover_color"><?php _e('Hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["menu_hover_color"]) ? esc_attr($theme_options["menu_hover_color"]) : "000000"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_hover_color"]); ?>" id="menu_hover_color" name="menu_hover_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="menu_hover_border_color"><?php _e('Hover border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["menu_hover_border_color"]) ? esc_attr($theme_options["menu_hover_border_color"]) : "59B42D"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_hover_border_color"]); ?>" id="menu_hover_border_color" name="menu_hover_border_color" data-default-color="59B42D">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="submenu_background_color"><?php _e('Submenu background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["submenu_background_color"]) ? esc_attr($theme_options["submenu_background_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_background_color"]); ?>" id="submenu_background_color" name="submenu_background_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="submenu_hover_background_color"><?php _e('Submenu hover background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["submenu_hover_background_color"]) ? esc_attr($theme_options["submenu_hover_background_color"]) : "F0F0F0"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_hover_background_color"]); ?>" id="submenu_hover_background_color" name="submenu_hover_background_color" data-default-color="F0F0F0">
							</div>
						</li>
						<li>
							<label for="submenu_color"><?php _e('Submenu link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["submenu_color"]) ? esc_attr($theme_options["submenu_color"]) : "888888"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_color"]); ?>" id="submenu_color" name="submenu_color" data-default-color="888888">
							</div>
						</li>
						<li>
							<label for="submenu_hover_color"><?php _e('Submenu hover link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["submenu_hover_color"]) ? esc_attr($theme_options["submenu_hover_color"]) : "000000"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_hover_color"]); ?>" id="submenu_hover_color" name="submenu_hover_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="mobile_menu_link_color"><?php _e('Mobile menu link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["mobile_menu_link_color"]) ? esc_attr($theme_options["mobile_menu_link_color"]) : "000000"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["mobile_menu_link_color"]); ?>" id="mobile_menu_link_color" name="mobile_menu_link_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="mobile_menu_position_background_color"><?php _e('Mobile menu position background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["mobile_menu_position_background_color"]) ? esc_attr($theme_options["mobile_menu_position_background_color"]) : "F0F0F0"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["mobile_menu_position_background_color"]); ?>" id="mobile_menu_position_background_color" name="mobile_menu_position_background_color" data-default-color="F0F0F0">
							</div>
						</li>
						<li>
							<label for="mobile_menu_active_link_color"><?php _e('Mobile menu active link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["mobile_menu_active_link_color"]) ? esc_attr($theme_options["mobile_menu_active_link_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["mobile_menu_active_link_color"]); ?>" id="mobile_menu_active_link_color" name="mobile_menu_active_link_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="mobile_menu_active_position_background_color"><?php _e('Mobile menu active position background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["mobile_menu_active_position_background_color"]) ? esc_attr($theme_options["mobile_menu_active_position_background_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["mobile_menu_active_position_background_color"]); ?>" id="mobile_menu_active_position_background_color" name="mobile_menu_active_position_background_color" data-default-color="409915">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_forms" class="subsettings">
					<h4><?php _e('FORMS', 'gymbase');?></h4>
					<ul class="form_field_list">
						<li>
							<label for="form_hint_color"><?php _e('Form hint color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["form_hint_color"]) ? esc_attr($theme_options["form_hint_color"]) : "C5C5C5"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_hint_color"]); ?>" id="form_hint_color" name="form_hint_color" data-default-color="C5C5C5">
							</div>
						</li>
						<li>
							<label for="form_field_text_color"><?php _e('Form field text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["form_field_text_color"]) ? esc_attr($theme_options["form_field_text_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_text_color"]); ?>" id="form_field_text_color" name="form_field_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="form_field_border_color"><?php _e('Form field border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["form_field_border_color"]) ? esc_attr($theme_options["form_field_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_border_color"]); ?>" id="form_field_border_color" name="form_field_border_color" data-default-color="515151">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="form_field_active_border_color"><?php _e('Form field active border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["form_field_active_border_color"]) ? esc_attr($theme_options["form_field_active_border_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_active_border_color"]); ?>" id="form_field_active_border_color" name="form_field_active_border_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_miscellaneous" class="subsettings">
					<h4><?php _e('MISCELLANEOUS', 'gymbase'); ?></h4>
					<ul class="form_field_list">
						<li>
							<label for="date_box_color"><?php _e('Date box background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_color"]) ? esc_attr($theme_options["date_box_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_color"]); ?>" id="date_box_color" name="date_box_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="date_box_text_color"><?php _e('Date box text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_text_color"]) ? esc_attr($theme_options["date_box_text_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_text_color"]); ?>" id="date_box_text_color" name="date_box_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="date_box_comments_number_text_color"><?php _e('Date box comments number text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_comments_number_text_color"]) ? esc_attr($theme_options["date_box_comments_number_text_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_comments_number_text_color"]); ?>" id="date_box_comments_number_text_color" name="date_box_comments_number_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="date_box_comments_number_border_color"><?php _e('Date box comments number border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_comments_number_border_color"]) ? esc_attr($theme_options["date_box_comments_number_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_comments_number_border_color"]); ?>" id="date_box_comments_number_border_color" name="date_box_comments_number_border_color" data-default-color="515151">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="date_box_comments_number_hover_border_color"><?php _e('Date box comments number hover border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_comments_number_hover_border_color"]) ? esc_attr($theme_options["date_box_comments_number_hover_border_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_comments_number_hover_border_color"]); ?>" id="date_box_comments_number_hover_border_color" name="date_box_comments_number_hover_border_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="gallery_details_box_border_color"><?php _e('Gallery details box border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_details_box_border_color"]) ? esc_attr($theme_options["gallery_details_box_border_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_details_box_border_color"]); ?>" id="gallery_details_box_border_color" name="gallery_details_box_border_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="gallery_box_color"><?php _e('Gallery box color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_color"]) ? esc_attr($theme_options["gallery_box_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_color"]); ?>" id="gallery_box_color" name="gallery_box_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="gallery_box_text_first_line_color"><?php _e('Gallery box text first line color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_text_first_line_color"]) ? esc_attr($theme_options["gallery_box_text_first_line_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_text_first_line_color"]); ?>" id="gallery_box_text_first_line_color" name="gallery_box_text_first_line_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="gallery_box_text_second_line_color"><?php _e('Gallery box text second line color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_text_second_line_color"]) ? esc_attr($theme_options["gallery_box_text_second_line_color"]) : "000000"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_text_second_line_color"]); ?>" id="gallery_box_text_second_line_color" name="gallery_box_text_second_line_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_color"><?php _e('Gallery box hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_hover_color"]) ? esc_attr($theme_options["gallery_box_hover_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_hover_color"]); ?>" id="gallery_box_hover_color" name="gallery_box_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_text_first_line_color"><?php _e('Gallery box hover text first line color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_hover_text_first_line_color"]) ? esc_attr($theme_options["gallery_box_hover_text_first_line_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_hover_text_first_line_color"]); ?>" id="gallery_box_hover_text_first_line_color" name="gallery_box_hover_text_first_line_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_text_second_line_color"><?php _e('Gallery box hover text second line color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_hover_text_second_line_color"]) ? esc_attr($theme_options["gallery_box_hover_text_second_line_color"]) : "000000"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_hover_text_second_line_color"]); ?>" id="gallery_box_hover_text_second_line_color" name="gallery_box_hover_text_second_line_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="timetable_box_color"><?php _e('Timetable box color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["timetable_box_color"]) ? esc_attr($theme_options["timetable_box_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timetable_box_color"]); ?>" id="timetable_box_color" name="timetable_box_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="timetable_box_hover_color"><?php _e('Timetable box hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["timetable_box_hover_color"]) ? esc_attr($theme_options["timetable_box_hover_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timetable_box_hover_color"]); ?>" id="timetable_box_hover_color" name="timetable_box_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="bread_crumb_border_color"><?php _e('Bread crumb border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["bread_crumb_border_color"]) ? esc_attr($theme_options["bread_crumb_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["bread_crumb_border_color"]); ?>" id="bread_crumb_border_color" name="bread_crumb_border_color" data-default-color="515151">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="accordion_item_border_color"><?php _e('Accordion item border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["accordion_item_border_color"]) ? esc_attr($theme_options["accordion_item_border_color"]) : "353535"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_color"]); ?>" id="accordion_item_border_color" name="accordion_item_border_color" data-default-color="353535">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="accordion_item_border_hover_color"><?php _e('Accordion item border hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["accordion_item_border_hover_color"]) ? esc_attr($theme_options["accordion_item_border_hover_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_hover_color"]); ?>" id="accordion_item_border_hover_color" name="accordion_item_border_hover_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="accordion_item_border_active_color"><?php _e('Accordion item border active color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["accordion_item_border_active_color"]) ? esc_attr($theme_options["accordion_item_border_active_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_active_color"]); ?>" id="accordion_item_border_active_color" name="accordion_item_border_active_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="copyright_area_border_color"><?php _e('Copyright area border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["copyright_area_border_color"]) ? esc_attr($theme_options["copyright_area_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["copyright_area_border_color"]); ?>" id="copyright_area_border_color" name="copyright_area_border_color" data-default-color="515151">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="top_hint_background_color"><?php _e('Top hint background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["top_hint_background_color"]) ? esc_attr($theme_options["top_hint_background_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["top_hint_background_color"]); ?>" id="top_hint_background_color" name="top_hint_background_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="top_hint_text_color"><?php _e('Top hint text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["top_hint_text_color"]) ? esc_attr($theme_options["top_hint_text_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["top_hint_text_color"]); ?>" id="top_hint_text_color" name="top_hint_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="comment_reply_button_color"><?php _e('Comment reply button color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["comment_reply_button_color"]) ? esc_attr($theme_options["comment_reply_button_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["comment_reply_button_color"]); ?>" id="comment_reply_button_color" name="comment_reply_button_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="post_author_link_color"><?php _e('Post author link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["post_author_link_color"]) ? esc_attr($theme_options["post_author_link_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["post_author_link_color"]); ?>" id="post_author_link_color" name="post_author_link_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="contact_details_box_background_color"><?php _e('Contact details box background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["contact_details_box_background_color"]) ? esc_attr($theme_options["contact_details_box_background_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["contact_details_box_background_color"]); ?>" id="contact_details_box_background_color" name="contact_details_box_background_color" data-default-color="FFFFFF">
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div id="tab-fonts" class="settings">
				<h3><?php _e('Fonts', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="header_font"><?php _e('Header font', 'gymbase'); ?></label>
						<div>
							<select id="header_font" name="header_font">
								<option<?php echo (isset($theme_options["header_font"]) && $theme_options["header_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default (Droid Sans)", 'gymbase'); ?></option>
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
							<label class="font_subset" for="header_font_subset" style="<?php echo (!empty($theme_options["header_font"]) ? "display: block;" : ""); ?>"><?php _e('Header font subset', 'gymbase'); ?></label>
							<select id="header_font_subset" class="font_subset" name="header_font_subset[]" multiple="multiple" style="<?php echo (!empty($theme_options["header_font"]) ? "display: block;" : ""); ?>">
								<?php
								if(!empty($theme_options["header_font"]))
								{
									$fontExplode = explode(":", $theme_options["header_font"]);
									$font_subset = gb_get_google_font_subset($fontExplode[0]);
									foreach($font_subset as $subset)
										echo "<option value='" . $subset . "' " . (in_array($subset, $theme_options["header_font_subset"]) ? "selected='selected'" : "") . ">" . $subset . "</option>";							
								}
								?>
							</select>
						</div>
					</li>
					<li>
						<label for="subheader_font"><?php _e('Subheader font', 'gymbase'); ?></label>
						<div>
							<select id="subheader_font" name="subheader_font">
								<option<?php echo (isset($theme_options["subheader_font"]) && $theme_options["subheader_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default (Droid Serif)", 'gymbase'); ?></option>
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
							<label class="font_subset" for="subheader_font_subset" style="<?php echo (!empty($theme_options["subheader_font"]) ? "display: block;" : ""); ?>"><?php _e('Subheader font subset', 'gymbase'); ?></label>
							<select id="subheader_font_subset" class="font_subset" name="subheader_font_subset[]" multiple="multiple" style="<?php echo (!empty($theme_options["subheader_font"]) ? "display: block;" : ""); ?>">
								<?php
								if(!empty($theme_options["subheader_font"]))
								{
									$fontExplode = explode(":", $theme_options["subheader_font"]);
									$font_subset = gb_get_google_font_subset($fontExplode[0]);
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
}
?>