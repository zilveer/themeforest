<?php

function homeShop_add_admin() {
    $of_page = add_theme_page( 'HomeShop Options', 'HomeShop Options', 'edit_theme_options', 'siteoptions', 'siteoptions_options_page' );
	
	 add_theme_page( 'HomeShop Data', 'HomeShop Data', 'edit_theme_options', 'sitedata', 'data_options_page' );
}
add_action( 'admin_menu', 'homeShop_add_admin' );


function data_options_page() {

require_once (dirname( __FILE__ ) . '/../demo_content/dcontent_importer.php');

$data_action = '';
if( isset($_POST['data_action']) ) {
$data_action = $_POST['data_action'];
}
?>
		<div class="widget-data export-widget-settings">


		<div class="wrap">
		
				<h2>Import DEMO data</h2>
				<div id="notifier" style="display: none;"></div>
				<form action="" method="post" id="widget-export-settings">
				<input name="data_action" class="button-bottom button-primary" type="submit" value="Import Demo Settings and Data"/>
				<hr/>
			
				<input name="data_action" class="button-bottom button-primary" type="submit" value="Import Demo Theme Options"/>
				<hr/>

				<input name="data_action" class="button-bottom button-primary" type="submit" value="Import Demo Widgets"/>
			<?php


if($data_action == 'Import Demo Settings and Data') {

content_import();
}

if($data_action == 'Import Demo Theme Options') {

demo_import_theme_options();
}

if($data_action == 'Import Demo Widgets') {

demo_widgets_import();
}

			?>
				</form>
			</div> <!-- end wrap -->
		</div> <!-- end export-widget-settings -->
<?php


}





function siteoptions_options_page(){
	$options = array();
		$options[] = array( "name" => "General", "std" => "General",
			"type" => "heading");
		

		$options[] = array( "name" => "Favicon",
					"type" => "upload",
					"id" => "site_icon",
					"std" => get_option('sense_site_icon')
					);
		
		
		$options[] = array( "name" => "Success Message Newsletter Form",
					"type" => "text",
					"id" => "added_text_newsletter",
					"std" => get_option('sense_added_text_newsletter')
					);	

		$options[] = array( "name" => "Invalid Email Message Newsletter Form",
					"type" => "text",
					"id" => "added_text_newsletter2",
					"std" => get_option('sense_added_text_newsletter2')
					);	
		
		$options[] = array( "name" => "Breadcrumbs",
					"type" => "radio",
					"id" => "show_breadcrumbs",
					"std" => get_option('sense_show_breadcrumbs'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);	
		
		$options[] = array( "name" => "Mobile sidebar position",
					"type" => "radio",
					"id" => "settings_sidebar_mobile",
					"std" => get_option('sense_settings_sidebar_mobile'),
					"options" => array(
						"top"=>"Top",
						"bottom"=>"Bottom"
						)
					);
		
		
		$options[] = array( "name" => "Mobile top search",
					"type" => "radio",
					"id" => "settings_search_mobile",
					"std" => get_option('sense_settings_search_mobile'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
					
					
		
		
		$options[] = array( "name" => "",
					"type" => "info",
					"std" => '<h5 class="title">Settings Logo</h5>',
					);	
		$options[] = array( "name" => "",
					"type" => "radio",
					"id" => "settings_logo",
					"std" => get_option('sense_settings_logo'),
					"options" => array(
						"show_image"=>"Image Logo",
						"show_text"=>"Text Logo"
						)
					);

		$options[] = array( "name" => "Text Logo",
					"type" => "text",
					"id" => "logo_text_loft",
					"std" => get_option('sense_logo_text_loft')
					);
		$options[] = array( "name" => "Logo Font Size",
					"type" => "text",
					"id" => "logo_size_loft",
					"std" => get_option('sense_logo_size_loft')
					);
		$options[] = array( "name" => "Logo Color",
					"type" => "color",
					"id" => "logo_color",
					"default" => "#7fcae8",
					"std" => ""
					);
		$options[] = array( "name" => "Logo Font Family",
					"type" => "select",
					"id" => "logo_font_family",
					"std" => get_option('sense_logo_font_family'),
					"options" => get_fonts()
					);
		$options[] = array( "name" => "Logo Image",
					"type" => "upload",
					"id" => "logo_image_loft",
					"std" => get_option('sense_logo_image_loft'),
					);		
		
		$options[] = array( "name" => "Style Header",
					"type" => "select",
					"id" => "style_header",
					"std" => get_option('sense_style_header'),
					"options" => array(
						"style1"=>"Style 1",
						"style2"=>"Style 2",
						"style3"=>"Style 3",
						"style4"=>"Style 4",
						"style5"=>"Style 5",
						"style6"=>"Style 6"
						)
					);			

		$options[] = array( "name" => "Show Header Search",
					"type" => "radio",
					"id" => "show_header_search",
					"std" => get_option('sense_show_header_search'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);	
					
		$options[] = array( "name" => "Show Header Languages",
					"type" => "radio",
					"id" => "show_languages",
					"std" => get_option('sense_show_languages'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);		
		
		$options[] = array( "name" => "Show Header Text",
					"type" => "radio",
					"id" => "show_header_info",
					"std" => get_option('sense_show_header_info'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);	
		
		$options[] = array( "name" => "Header Text",
					"type" => "textarea",
					"id" => "header_text",
					"std" => get_option('sense_header_text')
					);
		
		
		$options[] = array( "name" => "Read More Text",
					"type" => "text",
					"id" => "more_text",
					"id" => "more_text",
					"std" => get_option('sense_more_text')
					);	
		
		$options[] = array( "name" => "",
					"type" => "info",
					"std" => '<h4 style="color:#2A2B2D;" >Background Settings</h4>',
					);				
					
					
		$options[] = array( "name" => "Background Image",
					"type" => "upload",
					"id" => "bg_image_homeshop",
					"std" => get_option('sense_bg_image_homeshop'),
					);	
					
		$options[] = array( "name" => "Settings Background Repeat",
					"type" => "select",
					"id" => "settings_bg_repeat",
					"std" => get_option('sense_settings_bg_repeat'),
					"options" => array(
						"no-repeat"=>"No Repeat",
						"repeat"=>"Repeat All",
						"repeat-x"=>"Repeat Horizontally",
						"repeat-y"=>"Repeat Vertically"
						)
					);			
					
		$options[] = array( "name" => "Settings Background Attachment",
					"type" => "select",
					"id" => "settings_background_attachment",
					"std" => get_option('sense_settings_background_attachment'),
					"options" => array(
						"fixed"=>"Fixed",
						"scroll"=>"Scroll"
						)
					);			
					
					
		$options[] = array( "name" => "Background Main Color",
					"type" => "color",
					"id" => "bg_main_color",
					"std" => "#7fcae8",
					"default" => "#7fcae8"
					);
					
		$options[] = array( "name" => "Settings Background",
					"type" => "select",
					"id" => "settings_bg",
					"std" => get_option('sense_settings_bg'),
					"options" => array(
						"show_all"=>"Image+Color",
						"show_color"=>"Color",
						"show_img"=>"Image"
						)
					);

		
		$options[] = array( "name" => "Background Container Top Color",
					"type" => "color",
					"id" => "bg_top_color",
					"default" => "#e0f2f6",
					"std" => "#e0f2f6"
					);
					
		$options[] = array( "name" => "Background Container Bottom Color",
					"type" => "color",
					"id" => "bg_bottom_color",
					"default" => "#dde3e6",
					"std" => "#dde3e6"
					);			
					
		$options[] = array( "name" => "Background Container Opacity",
					"type" => "text",
					"id" => "bg_opacity",
					"std" => get_option('sense_bg_opacity')
					);				
		
		
		
	
		
		
		
		
		$options[] = array( "name" => "",
					"type" => "info",
					"std" => '<h4 style="color:#2A2B2D;" >Mailchimp Api Settings</h4>',
					);	
		$options[] = array( "name" => "Enter your Mailchimp Api",
					"type" => "text",
					"id" => "mailchimp_api",
					"std" => get_option('sense_mailchimp_api')
					);	

		$options[] = array( "name" => "Enter your Mailchimp Id",
					"type" => "text",
					"id" => "mailchimp_id",
					"std" => get_option('sense_mailchimp_id')
					);				
		
		$options[] = array( "name" => "Enter your Mailchimp data center(e.g. us4)",
					"type" => "text",
					"id" => "mailchimp_center",
					"std" => get_option('sense_mailchimp_center')
					);			

		
	
		$options[] = array( "name" => "Google Analytics",
					"type" => "other_text",
					"id" => "google_analytics",
					"std" => get_option('sense_google_analytics')
					);
		$options['export'] = array( "name" => "Export",
					"type" => "other_text",
					"id" => "export",
					"std" => ''
					);
		$options[] = array( "name" => "Get Export Text",
					"type" => "button",
					"id" => "export_btn",
					"std" => ''
					);
		$options[] = array( "name" => "Import",
					"type" => "other_text",
					"id" => "import",
					"std" => ''
					);
		$options[] = array( "name" => "Import Data",
					"type" => "button",
					"id" => "import_btn",
					"std" => ''
					);
						
						
						
						
						
						
						
	////////////////////////////color//////////////////////////////////////////////////////		
	$options[] = array( "name" => "color", "std" => "Theme Color Settings",
				"type" => "heading");
	
	$options[] = array( "name" => "Icon Login create color(middle)",
					"type" => "color",
					"id" => "login_create_color",
					"std" => "#9b59b6",
					"default" => "#9b59b6"
					);

	$options[] = array( "name" => "Text Login create color(middle)",
					"type" => "color",
					"id" => "text_login_create_color",
					"std" => "#7a8188",
					"default" => "#7a8188"
					);
	$options[] = array( "name" => "Link Login create color(middle)",
					"type" => "color",
					"id" => "link_login_create_color",
					"std" => "#1f2228",
					"default" => "#1f2228"
					);
					
					
	$options[] = array( "name" => "Button Create An Account color(middle)",
					"type" => "color",
					"id" => "button_login_create_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);				
		
	$options[] = array( "name" => "Button Create An Account Hover color(middle)",
					"type" => "color",
					"id" => "button_login_create_hover_color",
					"std" => "#2c3e50",
					"default" => "#2c3e50"
					);				
					
	$options[] = array( "name" => "Button Login color",
					"type" => "color",
					"id" => "login_color",
					"std" => "#f5791f",
					"default" => "#f5791f"
					);	

	$options[] = array( "name" => "Button Login hover color",
					"type" => "color",
					"id" => "login_hover_color",
					"std" => "#d35400",
					"default" => "#d35400"
					);


	$options[] = array( "name" => "Button Category (shop page)",
					"type" => "color",
					"id" => "button_category_shop_color",
					"std" => "#f7f7f7",
					"default" => "#f7f7f7"
					);


	$options[] = array( "name" => "Button Hover Category (shop page)",
					"type" => "color",
					"id" => "button_category_shop_hover_color",
					"std" => "#1abc9c",
					"default" => "#1abc9c"
					);

	$options[] = array( "name" => "Button Background Next/Prev (shop page)",
					"type" => "color",
					"id" => "button_gray_shop_color",
					"std" => "#f7f7f7",
					"default" => "#f7f7f7"
					);
	$options[] = array( "name" => "Button Text Next/Prev (shop page)",
					"type" => "color",
					"id" => "button_gray_text_shop_color",
					"std" => "#1f2228",
					"default" => "#1f2228"
					);
					
	$options[] = array( "name" => "Button Background Hover Next/Prev (shop page)",
					"type" => "color",
					"id" => "button_gray_hover_shop_color",
					"std" => "#dde3e6",
					"default" => "#dde3e6"
					);

	$options[] = array( "name" => "Button Text Hover Next/Prev (shop page)",
					"type" => "color",
					"id" => "button_gray_text_hover_shop_color",
					"std" => "#3498db",
					"default" => "#3498db"
					);

	$options[] = array( "name" => "Button Coupon/Update (shop page)",
					"type" => "color",
					"id" => "shop_coupon_color",
					"std" => "#2ecc71",
					"default" => "#2ecc71"
					);	

	$options[] = array( "name" => "Button Coupon/Update hover (shop page)",
					"type" => "color",
					"id" => "shop_coupon_hover_color",
					"std" => "#21bf64",
					"default" => "#21bf64"
					);				
					
	$options[] = array( "name" => "Button Grid hover (shop page)",
					"type" => "color",
					"id" => "shop_grid_hover_color",
					"std" => "#889196",
					"default" => "#889196"
					);	
		
	$options[] = array( "name" => "Button Grid Icon (shop page)",
					"type" => "color",
					"id" => "icon_grid_color",
					"std" => "#ffffff",
					"default" => "#ffffff"
					);	
		
	$options[] = array( "name" => "Category (wishlist page)",
					"type" => "color",
					"id" => "category_wishlist_color",
					"std" => "#9b59b6",
					"default" => "#9b59b6"
					);	
					
	$options[] = array( "name" => "Button Tags (compare page)",
					"type" => "color",
					"id" => "button_category_campare_color",
					"std" => "#fff",
					"default" => "#fff"
					);


	$options[] = array( "name" => "Button Hover Tags (compare page)",
					"type" => "color",
					"id" => "button_category_campare_hover_color",
					"std" => "#1abc9c",
					"default" => "#1abc9c"
					);
					
					
					
	$options[] = array( "name" => "Button Checkout (top cart)",
					"type" => "color",
					"id" => "button_checkout_top_color",
					"std" => "#f5791f",
					"default" => "#f5791f"
					);	

	$options[] = array( "name" => "Button Checkout Hover (top cart)",
					"type" => "color",
					"id" => "button_checkout_top_hover_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);	

	$options[] = array( "name" => "Button View Cart (top cart)",
					"type" => "color",
					"id" => "button_view_top_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);	

	$options[] = array( "name" => "Button View Cart Hover (top cart)",
					"type" => "color",
					"id" => "button_view_top_hover_color",
					"std" => "#2c3e50",
					"default" => "#2c3e50"
					);	

	$options[] = array( "name" => "Button Remove and Border (top cart)",
					"type" => "color",
					"id" => "button_remove_top_color",
					"std" => "#f5791f",
					"default" => "#f5791f"
					);	


	$options[] = array( "name" => "Footer Link Hover",
					"type" => "color",
					"id" => "footer_link_hover_color",
					"std" => "#e74c3c",
					"default" => "#e74c3c"
					);	

		
	$options[] = array( "name" => "Add new comment color (blog)",
					"type" => "color",
					"id" => "add_comment_color",
					"std" => "#3498db",
					"default" => "#3498db"
					);	

	$options[] = array( "name" => "Add new comment hover color (blog)",
					"type" => "color",
					"id" => "add_comment_hover_color",
					"std" => "#2980b9",
					"default" => "#2980b9"
					);
								

	$options[] = array( "name" => "Button Print color (blog)",
					"type" => "color",
					"id" => "page_print_color",
					"std" => "#e74c3c",
					"default" => "#e74c3c"
					);	

	$options[] = array( "name" => "Button Print hover color (blog)",
					"type" => "color",
					"id" => "page_print_hover_color",
					"std" => "#c0392b",
					"default" => "#c0392b"
					);			
				
				
	$options[] = array( "name" => "Button Send color (blog)",
					"type" => "color",
					"id" => "page_send_color",
					"std" => "#1abc9c",
					"default" => "#1abc9c"
					);	

	$options[] = array( "name" => "Button Send hover color (blog)",
					"type" => "color",
					"id" => "page_send_hover_color",
					"std" => "#16a085",
					"default" => "#16a085"
					);				
				
				
	$options[] = array( "name" => "Button More color (blog)",
					"type" => "color",
					"id" => "page_more_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);	

	$options[] = array( "name" => "Button More hover color (blog)",
					"type" => "color",
					"id" => "page_more_hover_color",
					"std" => "#2c3e50",
					"default" => "#2c3e50"
					);					
				
				
	$options[] = array( "name" => "Button Submit Comment (blog)",
					"type" => "color",
					"id" => "page_submit_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);	

	$options[] = array( "name" => "Button Submit Comment hover (blog)",
					"type" => "color",
					"id" => "page_submit_hover_color",
					"std" => "#2c3e50",
					"default" => "#2c3e50"
					);				
				
	
	$options[] = array( "name" => "Sidebar Dropdown Color",
					"type" => "color",
					"id" => "button_sidebar_dropdown_color",
					"std" => "#9b59b6",
					"default" => "#9b59b6"
					);
	
	$options[] = array( "name" => "Sidebar Dropdown Hover Color",
					"type" => "color",
					"id" => "button_sidebar_dropdown_hover_color",
					"std" => "#9b59b6",
					"default" => "#9b59b6"
					);
	
	$options[] = array( "name" => "Button Send Contact Form",
					"type" => "color",
					"id" => "send_submit_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);				


	$options[] = array( "name" => "Button Hover Send Contact Form",
					"type" => "color",
					"id" => "send_submit_hover_color",
					"std" => "#2c3e50",
					"default" => "#2c3e50"
					);				
				
				
				
				
				
				
				
				
				
				
				
	
	
	$options[] = array( "name" => "Basic link color",
					"type" => "color",
					"id" => "basic_link_color",
					"std" => "#1f2228",
					"default" => "#1f2228"
					);
	$options[] = array( "name" => "Basic link hover color",
					"type" => "color",
					"id" => "basic_link_hover_color",
					"std" => "#3498db",
					"default" => "#3498db"
					);
	
	
	$options[] = array( "name" => "Background color for the main block titles",
					"type" => "color",
					"id" => "bg_main_block_title_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);								
	
	$options[] = array( "name" => "Background color for the main block arrows hover",
					"type" => "color",
					"id" => "bg_main_block_title_arrhover_color",
					"std" => "#2c3e50",
					"default" => "#2c3e50"
					);	
	
	$options[] = array( "name" => "Background color for the block title in tabs",
					"type" => "color",
					"id" => "bg_block_title_tabs_color",
					"std" => "#a1aaaf",
					"default" => "#a1aaaf"
					);				

	$options[] = array( "name" => "Background color for the active block title in tabs",
					"type" => "color",
					"id" => "bg_block_title_tabs_active_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);	

	$options[] = array( "name" => "Price color",
					"type" => "color",
					"id" => "price_color",
					"std" => "#e74c3c",
					"default" => "#e74c3c"
					);	

	$options[] = array( "name" => "Add to Cart button color",
					"type" => "color",
					"id" => "add_cart_color",
					"std" => "#f5791f",
					"default" => "#f5791f"
					);	

	$options[] = array( "name" => "Add to Cart button hover color",
					"type" => "color",
					"id" => "add_cart_hover_color",
					"std" => "#d35400",
					"default" => "#d35400"
					);
					
	$options[] = array( "name" => "Wishlist button color",
					"type" => "color",
					"id" => "wishlist_color",
					"std" => "#e74c3c",
					"default" => "#e74c3c"
					);	

	$options[] = array( "name" => "Wishlist button hover color",
					"type" => "color",
					"id" => "wishlist_hover_color",
					"std" => "#c0392b",
					"default" => "#c0392b"
					);

	$options[] = array( "name" => "Compare button color",
					"type" => "color",
					"id" => "compare_color",
					"std" => "#3498db",
					"default" => "#3498db"
					);	

	$options[] = array( "name" => "Compare button hover color",
					"type" => "color",
					"id" => "compare_hover_color",
					"std" => "#2980b9",
					"default" => "#2980b9"
					);
				
	$options[] = array( "name" => "Checkout button color",
					"type" => "color",
					"id" => "checkout_color",
					"std" => "#f5791f",
					"default" => "#f5791f"
					);	

	$options[] = array( "name" => "Checkout button hover color",
					"type" => "color",
					"id" => "checkout_hover_color",
					"std" => "#2c3e50",
					"default" => "#2c3e50"
					);

	
	
	$options[] = array( "name" => "Quick view button color",
					"type" => "color",
					"id" => "quick_view_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);	

	$options[] = array( "name" => "Quick view button hover color",
					"type" => "color",
					"id" => "quick_view_hover_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);

	
	
	
	$options[] = array( "name" => "Register color",
					"type" => "color",
					"id" => "register_color",
					"std" => "#3498db",
					"default" => "#3498db"
					);	

	$options[] = array( "name" => "Register hover color",
					"type" => "color",
					"id" => "register_hover_color",
					"std" => "#2980b9",
					"default" => "#2980b9"
					);
	
	$options[] = array( "name" => "Remove color",
					"type" => "color",
					"id" => "remove_color",
					"std" => "#34495e",
					"default" => "#34495e"
					);	

	$options[] = array( "name" => "Remove hover color",
					"type" => "color",
					"id" => "remove_hover_color",
					"std" => "#2c3e50",
					"default" => "#2c3e50"
					);
	
	$options[] = array( "name" => "Back to top color",
					"type" => "color",
					"id" => "back_top_color",
					"std" => "#ffffff",
					"default" => "#ffffff"
					);	

	$options[] = array( "name" => "Back to top hover color",
					"type" => "color",
					"id" => "back_top_hover_color",
					"std" => "#f7f7f7",
					"default" => "#f7f7f7"
					);
	
		
	$options[] = array( "name" => "Back to top icon color",
					"type" => "color",
					"id" => "back_top_icon_color",
					"std" => "#596067",
					"default" => "#596067"
					);	

	$options[] = array( "name" => "Back to top icon hover color",
					"type" => "color",
					"id" => "back_top_icon_hover_color",
					"std" => "#596067",
					"default" => "#596067"
					);

	$options[] = array( "name" => "Submit (Newsletter) color",
					"type" => "color",
					"id" => "submit_newsletter_color",
					"std" => "#2ecc71",
					"default" => "#2ecc71"
					);	

	$options[] = array( "name" => "Submit (Newsletter) hover color",
					"type" => "color",
					"id" => "submit_newsletter_hover_color",
					"std" => "#21bf64",
					"default" => "#21bf64"
					);

	$options[] = array( "name" => "Labels color for Sale",
					"type" => "color",
					"id" => "labels_color",
					"std" => "#e74c3c",
					"default" => "#e74c3c"
					);	

	$options[] = array( "name" => "Labels color for Stock",
					"type" => "color",
					"id" => "labels_color_stock",
					"std" => "#e74c3c",
					"default" => "#e74c3c"
					);	

	$options[] = array( "name" => "Labels color for Hot",
					"type" => "color",
					"id" => "labels_color_hot",
					"std" => "#e74c3c",
					"default" => "#e74c3c"
					);	




		
						
		////////////////////////////Header//////////////////////////////////////////////////////////////////////////////////////////////////////////	
		$options[] = array( "name" => "Header", "std" => "Header",
					"type" => "heading"
					);	
	
		$options[] = array( "name" => "Background color for search area",
					"type" => "color",
					"id" => "bg_search_top_color",
					"default" => "#34495e",
					"std" => "#34495e"
					);			
					
		
		$options[] = array( "name" => "Background color for search button",
					"type" => "color",
					"id" => "bg_search_top_btn_color",
					"default" => "#1abc9c",
					"std" => "#1abc9c"
					);	
		$options[] = array( "name" => "Background color for search button hover",
					"type" => "color",
					"id" => "bg_search_top_btn_hover_color",
					"default" => "#16a085",
					"std" => "#16a085"
					);	
		
		$options[] = array( "name" => "Background color for “Product Compare” block",
					"type" => "color",
					"id" => "bg_compare_top_color",
					"default" => "#3498db",
					"std" => "#3498db"
					);	
		
		$options[] = array( "name" => "Background color for “Product Compare” block hover",
					"type" => "color",
					"id" => "bg_compare_hover_top_color",
					"default" => "#2980b9",
					"std" => "#2980b9"
					);	
		
		$options[] = array( "name" => "Background color for “Wishlist” block",
					"type" => "color",
					"id" => "bg_wishlist_top_color",
					"default" => "#e74c3c",
					"std" => "#e74c3c"
					);	
		
		$options[] = array( "name" => "Background color for “Wishlist” block hover",
					"type" => "color",
					"id" => "bg_wishlist_hover_top_color",
					"default" => "#c0392b",
					"std" => "#c0392b"
					);	
		
		$options[] = array( "name" => "Background color for “Shopping Cart” block",
					"type" => "color",
					"id" => "bg_cart_top_color",
					"default" => "#f5791f",
					"std" => "#f5791f"
					);	
		
		$options[] = array( "name" => "Background color for “Shopping Cart” block hover",
					"type" => "color",
					"id" => "bg_cart_hover_top_color",
					"default" => "#d35400",
					"std" => "#d35400"
					);	
		
		$options[] = array( "name" => "Background color for “Languages” block",
					"type" => "color",
					"id" => "bg_languages_top_color",
					"default" => "#34495e",
					"std" => "#34495e"
					);	
		
		$options[] = array( "name" => "Background color for “Languages” block hover",
					"type" => "color",
					"id" => "bg_languages_hover_top_color",
					"default" => "#2c3e50",
					"std" => "#2c3e50"
					);	
		
		$options[] = array( "name" => "Background color for “Currency” block",
					"type" => "color",
					"id" => "bg_currency_top_color",
					"default" => "#34495e",
					"std" => "#34495e"
					);	
		
		$options[] = array( "name" => "Background color for “Currency” block hover",
					"type" => "color",
					"id" => "bg_currency_hover_top_color",
					"default" => "#2c3e50",
					"std" => "#2c3e50"
					);	
		
		
		
		
		
		
					
		/////////////////////////Typorgraphy////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$options[] = array( "name" => "Typorgraphy", "std" => "Typorgraphy",
					"type" => "heading"
					);
		
		
		$options[] = array( "name" => "Basic Text",
					"type" => "select2",
					"id" => "basic_text_styles",
					"std" => get_option('sense_basic_text_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "size_basic_text",
					"std" => get_option('sense_size_basic_text'),
					"options" => get_font_size(14)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "basic_font",
					"std" => get_option('sense_basic_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "basic_font_color",
					"std" => "#596067",
					"default" => "#596067"
					);
					
					
		$options[] = array( "name" => "Block Titles",
					"type" => "select2",
					"id" => "page_title_styles",
					"std" => get_option('sense_page_title_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "size_page_title",
					"std" => get_option('sense_size_page_title'),
					"options" => get_font_size(18)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "page_title_font",
					"std" => get_option('sense_page_title_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "page_title_font_color",
					"std" => "#fff",
					"default" => "#fff"
					);
					
		

		$options[] = array( "name" => "Copyright Text",
					"type" => "select2",
					"id" => "copyright_text_styles",
					"std" => get_option('sense_copyright_text_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "copyright_text_size",
					"std" => get_option('sense_copyright_text_size'),
					"options" => get_font_size(14)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "copyright_font",
					"std" => get_option('sense_copyright_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "copyright_font_color",
					"std" => "#7a8188",
					"default" => "#7a8188"
					);





		$options[] = array( "name" => "Footer Titles",
					"type" => "select2",
					"id" => "footer_titles_styles",
					"std" => get_option('sense_footer_titles_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "footer_titles_size",
					"std" => get_option('sense_footer_titles_size'),
					"options" => get_font_size(18)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "footer_titles_font",
					"std" => get_option('sense_footer_titles_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "footer_titles_font_color",
					"std" => "#596067",
					"default" => "#596067"
					);

					
					
					
					
		$options[] = array( "name" => "Header Text (top line)",
					"type" => "select2",
					"id" => "header_text_styles",
					"std" => get_option('sense_header_text_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "header_text_size",
					"std" => get_option('sense_header_text_size'),
					"options" => get_font_size(13)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "header_text_font",
					"std" => get_option('sense_header_text_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "header_text_font_color",
					"std" => "#1f2228",
					"default" => "#1f2228"
					);

					
					
					
					
					
					
		$options[] = array( "name" => "Small Text (post date, comment date, etc.)",
					"type" => "select2",
					"id" => "small_text_styles",
					"std" => get_option('sense_small_text_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "small_text_size",
					"std" => get_option('sense_small_text_size'),
					"options" => get_font_size(12)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "small_text_font",
					"std" => get_option('sense_small_text_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "small_text_font_color",
					"std" => "#7a8188",
					"default" => "#7a8188"
					);

					
					
		
		$options[] = array( "name" => "H1",
					"type" => "select2",
					"id" => "h1_text",
					"std" => get_option('sense_h1_text'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "text_h1",
					"std" => get_option('sense_text_h1'),
					"options" => get_font_size(28)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h1_font",
					"std" => get_option('sense_h1_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h1_font_color",
					"std" => "#596067",
					"default" => "#596067"
					);
		
		
		$options[] = array( "name" => "H2",
					"type" => "select2",
					"id" => "h2_text",
					"std" => get_option('sense_h2_text'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "text_h2",
					"std" => get_option('sense_text_h2'),
					"options" => get_font_size(24)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h2_font",
					"std" => get_option('sense_h2_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h2_font_color",
					"std" => "#596067",
					"default" => "#596067"
					);
					
					
		$options[] = array( "name" => "H3",
					"type" => "select2",
					"id" => "h3_text",
					"std" => get_option('sense_h3_text'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "text_h3",
					"std" => get_option('sense_text_h3'),
					"options" => get_font_size(20)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h3_font",
					"std" => get_option('sense_h3_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h3_font_color",
					"std" => "#596067",
					"default" => "#596067"
					);
					
					
		$options[] = array( "name" => "H4",
					"type" => "select2",
					"id" => "h4_text",
					"std" => get_option('sense_h4_text'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "text_h4",
					"std" => get_option('sense_text_h4'),
					"options" => get_font_size(18)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h4_font",
					"std" => get_option('sense_h4_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h4_font_color",
					"std" => "#596067",
					"default" => "#596067"
					);
					
					
		$options[] = array( "name" => "H5",
					"type" => "select2",
					"id" => "h5_text",
					"std" => get_option('sense_h5_text'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "text_h5",
					"std" => get_option('sense_text_h5'),
					"options" => get_font_size(16)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h5_font",
					"std" => get_option('sense_h5_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h5_font_color",
					"std" => "#596067",
					"default" => "#596067"
					);
					
					
		$options[] = array( "name" => "H6",
					"type" => "select2",
					"id" => "h6_text",
					"std" => get_option('sense_h6_text'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "text_h6",
					"std" => get_option('sense_text_h6'),
					"options" => get_font_size(14)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h6_font",
					"std" => get_option('sense_h6_font'),
					"options" => get_fonts('Roboto')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h6_font_color",
					"std" => "#596067",
					"default" => "#596067"
					);
		
					


					
////////////////////////Contact///////////////////////////////////////////////////////////////////////////////////////////////////////////////			
		$options[] = array( "name" => "Contact", "std" => "Contact",
					"type" => "heading");
		
		$options[] = array( "name" => "Google Map Address (34.001,-118.469)",
					"type" => "text",
					"id" => "contact_urlmaps1",
					"std" => get_option('sense_contact_urlmaps1')
					);
					
		$options[] = array( "name" => "Google Map Markers (34.001,-118.469)",
					"type" => "text",
					"id" => "contact_urlmaps2",
					"std" => get_option('sense_contact_urlmaps2')
					);

		$options[] = array( "name" => "Map Icon Image",
					"type" => "upload",
					"id" => "map_image_loft",
					"std" => get_option('sense_map_image_loft'),
					);	
		
		/////////////////////////404///////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$options[] = array( "name" => "404", "std" => "404",
					"type" => "heading");
		$options[] = array( "name" => "Text top",
					"type" => "textarea",
					"id" => "text_top",
					"std" => stripslashes(get_option('sense_text_top'))
					);
		$options[] = array( "name" => "Text bottom",
					"type" => "textarea",
					"id" => "text_bottom",
					"std" => get_option('sense_text_bottom')
					);			
			
		
					
					
		////////////////////////////Shop/////////////////////////////////////////////////////////////////////////////////////////			
		$options[] = array( "name" => "shop", "std" => "Shop",
					"type" => "heading");
		
		
			$options[] = array( "name" => "Category info position",
					"type" => "radio",
					"id" => "settings_category_pos",
					"std" => get_option('sense_settings_category_pos'),
					"options" => array(
						"top"=>"Top",
						"bottom"=>"Bottom"
						)
					);
		
		
		$options[] = array( "name" => "Zoom on/off",
					"type" => "radio",
					"id" => "thumb_zoom",
					"std" => get_option('sense_thumb_zoom'),
					"options" => array(
						"show"=>"On",
						"hide"=>"Off"
						)
					);
		
		$options[] = array( "name" => "Number Products",
					"type" => "text",
					"id" => "num_product",
					"std" => get_option('sense_num_product')
					);	
	
		$options[] = array( "name" => "Number Columns Products",
					"type" => "select",
					"id" => "column_products",
					"std" => get_option('sense_column_products'),
					"options" => array(
						"col-lg-12 col-md-12 col-sm-12"=>"Column 1",
						"col-lg-6 col-md-6 col-sm-6"=>"Column 2",
						"col-lg-4 col-md-4 col-sm-4"=>"Column 3",
						"col-lg-3 col-md-6 col-sm-6"=>"Column 4",
						"col-lg-2 col-md-6 col-sm-6"=>"Column 6"
						)
					);		
	
		$options[] = array( "name" => "Number Columns Products Mobile",
					"type" => "select",
					"id" => "column_products_mobile",
					"std" => get_option('sense_column_products_mobile'),
					"options" => array(
						"col-xs-12"=>"Column 1",
						"col-xs-6"=>"Column 2"
						)
					);		
					
					
		$options[] = array( "name" => "Limit Title Product",
					"type" => "text",
					"id" => "num_product_title",
					"std" => get_option('sense_num_product_title')
					);	
	
		$options[] = array( "name" => "Limit Short Description",
					"type" => "text",
					"id" => "num_product_short_des",
					"std" => get_option('sense_num_product_short_des')
					);	
		
	
		$options[] = array( "name" => "Wishlist link page",
					"type" => "text",
					"id" => "link_wishlist",
					"std" => get_option('sense_link_wishlist')
					);	

		$options[] = array( "name" => "Compare link page",
					"type" => "text",
					"id" => "link_compare",
					"std" => get_option('sense_link_compare')
					);	


					
		$options[] = array( "name" => "Sidebar Category Position",
					"type" => "select",
					"id" => "sidebar_cat",
					"std" => get_option('sense_sidebar_cat'),
					"options" => array(
						"left"=>"Left",
						"right"=>"Right",
						"none"=>"None"
						)
					);	
		
		$options[] = array( "name" => "Category Thumbnail",
					"type" => "radio",
					"id" => "thumb_cat",
					"std" => get_option('sense_thumb_cat'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);



		$options[] = array( "name" => "Show Header Compare",
					"type" => "radio",
					"id" => "show_compare",
					"std" => get_option('sense_show_compare'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);				
					
		$options[] = array( "name" => "Show Header Wishlist",
					"type" => "radio",
					"id" => "show_wishlist",
					"std" => get_option('sense_show_wishlist'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);	
					
		$options[] = array( "name" => "Show Header Cart",
					"type" => "radio",
					"id" => "show_cart",
					"std" => get_option('sense_show_cart'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);	
					
		$options[] = array( "name" => "Show Header Currency",
					"type" => "radio",
					"id" => "show_currency",
					"std" => get_option('sense_show_currency'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);	
					
		$options[] = array( "name" => "Quick View",
					"type" => "radio",
					"id" => "quick_view",
					"std" => get_option('sense_quick_view'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);	

		$options[] = array( "name" => "Product Reviews",
					"type" => "radio",
					"id" => "product_reviews",
					"std" => get_option('sense_product_reviews'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
					
					
					
		$options[] = array( "name" => "Product Search Page",
					"type" => "radio",
					"id" => "product_search_type",
					"std" => get_option('sense_product_search_type'),
					"options" => array(
						"list"=>"List",
						"grid"=>"Grid"
						)
					);			
					
					
		$options[] = array( "name" => "Sidebar Product Search Page",
					"type" => "select",
					"id" => "sidebar_search_page",
					"std" => get_option('sense_sidebar_search_page'),
					"options" => array(
						"left"=>"Left",
						"right"=>"Right",
						"full"=>"Full"
						)
					);				
					
					
					
		$options[] = array( "name" => "Product Short Description",
					"type" => "radio",
					"id" => "short_des",
					"std" => get_option('sense_short_des'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);			
				


		$options[] = array( "name" => "Show Related Products",
					"type" => "radio",
					"id" => "show_related",
					"std" => get_option('sense_show_related'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);


		$options[] = array( "name" => "Show Recently Viewed Products",
					"type" => "radio",
					"id" => "show_recently",
					"std" => get_option('sense_show_recently'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
			

		$options[] = array( "name" => "Show Custom Tab",
					"type" => "radio",
					"id" => "custom_tab",
					"std" => get_option('sense_custom_tab'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);



	/* --------------------------------------------------------- */
	/*	Share Product Settings
	/* --------------------------------------------------------- */			
		$options[] = array( "name" => "",
					"type" => "info",
					"std" => '<h4 style="color:#2A2B2D;" >Share Product Settings</h4>',
					);				
								
		$options[] = array( "name" => "Show social links",
					"type" => "radio",
					"id" => "share-product-enable",
					"std" => get_option('sense_share-product-enable'),
					"options" => array(
						"on"=>"Show",
						"off"=>"Hide"
						)
					);			

		$options[] = array( "name" => "Enable Facebook Share",
					"type" => "radio",
					"id" => "share-product-facebook",
					"std" => get_option('sense_share-product-facebook'),
					"options" => array(
						"on"=>"Show",
						"off"=>"Hide"
						)
					);			


		$options[] = array( "name" => "Enable Twitter Share",
					"type" => "radio",
					"id" => "share-product-twitter",
					"std" => get_option('sense_share-product-twitter'),
					"options" => array(
						"on"=>"Show",
						"off"=>"Hide"
						)
					);			


		$options[] = array( "name" => "Enable Linkedin Share",
					"type" => "radio",
					"id" => "share-product-linkedin",
					"std" => get_option('sense_share-product-linkedin'),
					"options" => array(
						"on"=>"Show",
						"off"=>"Hide"
						)
					);			


		$options[] = array( "name" => "Enable Google + Share",
					"type" => "radio",
					"id" => "share-product-googleplus",
					"std" => get_option('sense_share-product-googleplus'),
					"options" => array(
						"on"=>"Show",
						"off"=>"Hide"
						)
					);			


		$options[] = array( "name" => "Enable Pinterest Share",
					"type" => "radio",
					"id" => "share-product-pinterest",
					"std" => get_option('sense_share-product-pinterest'),
					"options" => array(
						"on"=>"Show",
						"off"=>"Hide"
						)
					);			


		$options[] = array( "name" => "Enable VK Share",
					"type" => "radio",
					"id" => "share-product-vk",
					"std" => get_option('sense_share-product-vk'),
					"options" => array(
						"on"=>"Show",
						"off"=>"Hide"
						)
					);			


		$options[] = array( "name" => "Enable Tumblr Share",
					"type" => "radio",
					"id" => "share-product-tumblr",
					"std" => get_option('sense_share-product-tumblr'),
					"options" => array(
						"on"=>"Show",
						"off"=>"Hide"
						)
					);			


		$options[] = array( "name" => "Enable Xing Share",
					"type" => "radio",
					"id" => "share-product-xing",
					"std" => get_option('sense_share-product-xing'),
					"options" => array(
						"on"=>"Show",
						"off"=>"Hide"
						)
					);			





					
		////////////////////////////footer/////////////////////////////////////////////////////////////////////////////////////////			
		$options[] = array( "name" => "footer", "std" => "Footer settings",
					"type" => "heading");
		
		$options[] = array( "name" => "Show Footer",
					"type" => "radio",
					"id" => "show_footer",
					"std" => get_option('sense_show_footer'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);	
					
					
		$options[] = array( "name" => "Payment Image",
					"type" => "upload",
					"id" => "footer_payment",
					"std" => get_option('sense_footer_payment'),
					);		
					
		$options[] = array( "name" => "Footer Text",
					"type" => "textarea",
					"id" => "footer_text",
					"std" => get_option('sense_footer_text')
					);
					
					
		$options[] = array( "name" => "Show Row 1 widgets",
					"type" => "radio",
					"id" => "settings_fsidebar1",
					"std" => get_option('sense_settings_fsidebar1'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);			
		$options[] = array( "name" => "Sidebar Columns",
					"type" => "select",
					"id" => "fsidebar1_columns",
					"std" => get_option('sense_fsidebar1_columns'),
					"options" => array(
						"1"=>"1",
						"2"=>"2",
						"3"=>"3",
						"4"=>"4"
						)
					);	
					
		$options[] = array( "name" => "Show Row 2 widgets",
					"type" => "radio",
					"id" => "settings_fsidebar2",
					"std" => get_option('sense_settings_fsidebar2'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);						
		$options[] = array( "name" => "Sidebar Columns",
					"type" => "select",
					"id" => "fsidebar2_columns",
					"std" => get_option('sense_fsidebar2_columns'),
					"options" => array(
						"1"=>"1",
						"2"=>"2",
						"3"=>"3",
						"4"=>"4"
						)
					);	
		
		$options[] = array( "name" => "Background Color",
					"type" => "color",
					"id" => "footer_color1",
					"std" => "#f7f7f7",
					"default" => "#f7f7f7"
					);			
					
		
					
					
				?><style type="text/css">
					.form_select_color{background-color: <?php echo get_option('sense_theme_color') ?>}
					div.pattern{background-image: url('<?php
					$path = substr(get_option('sense_theme_pattern'), -5, 1);
					echo get_template_directory_uri().'/images/pattern'.$path.'.png' ?>')}
				</style>
				<?php
				
		
		$export_data = '';
        // $return = options_generator($options);

		$home = get_option('sense_home');
		if(isset($home)&&($home!='')){
	        foreach (get_option('sense_home') as $value) { ?>
	        	<?php $font = str_replace(" ", "+", stripslashes_deep($value['font-family'])); ?>
	        	<?php $font = str_replace("'", "", $font); ?>
	            <link href="http://fonts.googleapis.com/css?family=<?php echo $font; ?>" rel="stylesheet" />
	  <?php }; 
    	}; ?>
<div class="admin-main clearfix" id="truethemes_container">

  <form action="" enctype="multipart/form-data" id="ofform">
  
  	<input type="hidden" name="theme_url" id="theme_url_hiden" value="" />

	<aside class="admin-aside">
		<div id="admin-logo">
			<a href="#"><img src="<?php echo get_template_directory_uri()?>/admin/images/admin-logo.png" alt="" /></a>
		</div><!--/ #cms-logo-->
		<nav id="admin-nav" class="admin-nav">
			<ul>
				<li class="current option-general"><a href="#option-general" title="General">General</a></li>
			    <li class="option-typorgraphy"><a href="#option-typorgraphy" title="Typorgraphy">Typorgraphy</a></li>
			    <li class="option-color"><a href="#option-color" title="Color">Color</a></li>
				<li class="option-404"><a href="#option-404" title="404">404</a></li>
                <li class="option-shop"><a href="#option-shop" title="shop">Shop</a></li>
                <li class="option-header"><a href="#option-header" title="header">Header</a></li>
                <li class="option-footer"><a href="#option-footer" title="footer">Footer</a></li>
			</ul>
		</nav><!--/ .admin-nav-->
		
		<div id="save_status"><?php _e( 'Please save your changes', 'homeshop' ) ?></div>
		<div id="save_window">
			<?php _e( 'You successfully saved your changes!', 'homeshop' ) ?>
		</div>
		
	</aside><!--/ .admin-aside-->
	<section class="admin-content">
		<div class="heading-holder clearfix">
			
			<h3 class="heading-title"><?php _e( 'Theme Options', 'homeshop' ) ?></h3>

			<ul class="optional-links">
				<li class="publish-to"><a href="#"><?php _e( 'Save All Changes', 'homeshop' ) ?></a></li>
			</ul><!--/ .optional-links-->
		</div><!--/ .heading-holder-->
		
	    <?php 
    		options_generator($options);
		?>
		
	
		<div class="footer-holder clearfix">
			Copyright &copy; 2013-2014 <a href="#">ClickCMS</a>. All rights reserved.
		</div>
	</section>
	
  </form>
	


	
</div>
<!--wrap-->
<?php admin_script(); ?>
<?php
}




function options_generator($options, $postId = null){
	$output = '';
	$menu = '';                                 
	$counter = 0;
	foreach ($options as $value) {
		$counter++;
		$val = '';
		$select_value = ''; 
		$output = '';
		if(isset($value['container'])){
			$output .= '<div class="'. esc_attr($value['container']) .'">';
		} 
		if($value['type']!='heading'  && $value['type']!='select3' ){
			$output .= '<h5 class="title">'. esc_html($value['name']) .'</h5>';
		}
		switch ( $value['type'] ) {
		case 'imageabout':
			$icons = get_option('sense_soc');
			$output = '';
			$output = ' <div id="soc_items"> ';
			if(isset($icons)&&(!empty($icons)))
			{
			    foreach ($icons as $value) 
				{
			      	$output .= '<div class="soc_item">
								<span class="soc_name">'. esc_html($value['name']) .'</span>
								<div class="sense_upload_block">
										<input class="sense_upload_url" type="hidden" id="'. esc_attr($value['name']) .'" name="'. esc_attr($value['name']) .'" value="'. esc_attr($value['icon']) .'" />
										<a id="upload_'. esc_attr($value['name']) .'_button" class="button sense_upload_image_button add-field">Upload Image</a>
										<a id="delete_'. esc_attr($value['name']) .'_button" class="hide button sense_delete_image_button remove-field">Delete Image</a>
										<div class="image_preview"><img alt="" src="'. esc_url($value['icon']) .'" />
										</div>
									</div>
								<span class="delete_icon button remove-field">Delete title</span>
							</div>';
				}
			}
			$output .= ' </div>
			<div class = "image_about">
							<label for="soc_name">Image Name: </label>
							<input name="soc_name2" id="soc_name2" />
							<a class="add-field"  id="add_soc2">Load Image</a>
						</div>';
						
						
						
		break;
		case 'contacticon':
			$icons_contact = get_option('contact_icon');
			$output = '';
			$output = ' <div id="contact_icon_items"> ';
			if(isset($icons_contact)&&(!empty($icons_contact)))
			{
			    foreach ($icons_contact as $value) 
				{
			      	$output .= '<div class="contact_icon_item">
								<span class="icon_name">'. $value['name'] .'</span> link: 
								<input class="soc_url" value="'. esc_url($value['url']) .'"/>
								<div class="sense_upload_block">
										<input class="sense_upload_url" type="hidden" id="'. esc_attr($value['name']) .'" name="'. esc_attr($value['name']) .'" value="'. esc_attr($value['icon']) .'" />
										<a id="upload_'. esc_attr($value['name']) .'_button" class="button sense_upload_image_button add-field">Upload Image</a>
										<a id="delete_'. esc_attr($value['name']) .'_button" class="hide button sense_delete_image_button remove-field">Delete Image</a>
										<div class="image_preview"><img alt="" src="'. esc_url($value['icon']) .'" />
										</div>
									</div>
								<span class="delete_icon button remove-field">Delete title</span>
							</div>';
				}
			}
			$output .= ' </div>
			<div class = "image_about">
							<label for="icon_name">Field Text: </label>
							<input name="contact_icon_name" id="contact_icon_name" />
							<a class="add-field"  id="add_contact_icon">Load Image</a>
						</div>';
						
						
						
		break;
		case 'text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="form_input" name="'. esc_attr($value['id']) .'" id="'. esc_attr($value['id']) .'" type="'. $value['type'] .'" value="'. $val .'" /><br/>';
		break;
		case 'select':
			$output .= '<select class="form_select" name="'. esc_attr($value['id']) .'" id="'. esc_attr($value['id']) .'">';
			$select_value = get_option($value['id']);
			foreach ($value['options'] as $val => $option) {
				$selected = '';
				 if($select_value != '') {
					 if ( $select_value == $val) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $val) { $selected = ' selected="selected"'; }
				 }
				 $output .= '<option '. $selected . ' value="'.$val.'"'.'>';
				 $output .= $option;
				 $output .= '</option>';
			 } 
			 $output .= '</select></br></br>';
		break;
		
		case 'select2':
			$output .= '   <select class="form_select" name="'. esc_attr($value['id']) .'" id="'. esc_attr($value['id']) .'">';
			$select_value = get_option($value['id']);
			foreach ($value['options'] as $val => $option) {
				$selected = '';
				 if($select_value != '') {
					 if ( $select_value == $val) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $val) { $selected = ' selected="selected"'; }
				 }
				 $output .= '<option '. $selected . ' value="'.$val.'"'.'>';
				 $output .= $option;
				 $output .= '</option>';
			 } 
			 $output .= '</select>';
		break;
		case 'select3':
			$output .= '   <select class="form_select" name="'. esc_attr($value['id']) .'" id="'. esc_attr($value['id']) .'">';
			$select_value = get_option($value['id']);
			foreach ($value['options'] as $val => $option) {
				$selected = '';
				 if($select_value != '') {
					 if ( $select_value == $val) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $val) { $selected = ' selected="selected"'; }
				 }
				 $output .= '<option '. $selected . ' value="'.$val.'"'.'>';
				 $output .= $option;
				 $output .= '</option>';
			 } 
			 $output .= '</select>';
		break;
		
		
		case 'select_pattern':
			$output .= '<select class="form_select_pattern" name="'. esc_attr($value['id']) .'" id="'. esc_attr($value['id']) .'">';
			$select_value = get_option($value['id']);
			$tt = 1;
			foreach ($value['options'] as $val => $option) {
				$selected = '';
				 if($select_value != '') {
					 if ( $select_value == $val) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $val) { $selected = ' selected="selected"'; }
				 }
				 $output .= '<option '. $selected . 'class="pattern'.$tt.'"'.' value="'.$val.'"'.'>';
				 $output .= $option;
				 $output .= '</option>';
				 $tt++;
			 } 
			 $output .= '</select><div class="pattern"></div></br></br>';
		break;
		case 'select_color':
			$output .= '<select class="form_select_color" name="'. esc_attr($value['id']) .'" id="'. esc_attr($value['id']) .'">';
			$select_value = get_option($value['id']);
			$tt = 1;
			foreach ($value['options'] as $val => $option) {
				$selected = '';
				 if($select_value != '') {
					 if ( $select_value == $val) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $val) { $selected = ' selected="selected"'; }
				 }
				 $output .= '<option '. $selected . ' class="selected_color color'.$tt.'"'.' value="'.$val.'"'.'>';
				 $output .= $option;
				 $output .= '<div></div>';
				 $output .= '</option>';
				 $tt++;
			 } 
			 $output .= '</select></br></br>';
		break;

		case "radio2":
			$output .='<div class="radio '. esc_attr($value['id']) .'">';
			 $select_value = get_option( $value['id']);
			 foreach ($value['options'] as $key => $option) { 
				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .='<label class="'. esc_attr($key) .'" ><input class="of-input of-radio" type="radio" name="'. esc_attr($value['id']) .'" value="'. $key .'" '. $checked .' />' . $option .'</label>';
			}
			$output .='</div>';
		break;
		
		case 'button2':
			$output = '<h5 class="title">'.$value['name'].'</h5>';
			$output.= '<a id="'. esc_attr($value['id']) .'">'.$value['name'].'</a>';
		break;
		
				case 'button3':
			$output = '<h5 class="title">'.$value['name'].'</h5>';
			$output.= '<input type="submit" name="'. esc_attr($value['id']) .'"  value="'.$value['name'].'"/>';
		break;
		
		case 'button':
			$output = '<a id="'. esc_attr($value['id']) .'">'.$value['name'].'</a>';
		break;
		case 'other_text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<textarea name="'. esc_attr($value['id']) .'" id="'. esc_attr($value['id']) .'">'.stripslashes($val).'</textarea><br/>';
		break;
		case 'textarea':
			echo $output;
			$output = '';
			if($postId==null){$std = get_option($value['id']);}else{$std = get_post_meta($postId, $value['id'], true);};
			if( $std != "") { $ta_value = stripslashes( $std );};
			wp_editor($value['std'], $value['id'], array('media_buttons'=>false));
			// $output .= '<textarea id="'.$value['id'].'" name="'.$value['id'].'">'.$std.'</textarea>';
		break;
		case "radio":
			$output .='<div class="radio-holder">';
			 $select_value = get_option( $value['id']);
			 foreach ($value['options'] as $key => $option) { 
				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .='<label><input class="of-input of-radio" type="radio" name="'. esc_attr($value['id']) .'" value="'. $key .'" '. $checked .' />' . $option .'</label>';
			}
			$output .='</div>';
		break;
		case "checkbox": 
		   $std = $value['std'];  
		   $saved_std = get_option($value['id']);
		   $checked = '';
			if(!empty($saved_std)) {
				if($saved_std == 'true') {
				$checked = 'checked="checked"';
				}
				else{
				   $checked = '';
				}
			}
			elseif( $std == 'true') {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';
			}
			$output .= '<input type="checkbox" class="checkbox form_check" name="'.  esc_attr($value['id']) .'" id="'. esc_attr($value['id']) .'" value="true" '. $checked .' />'.$value['name'].'<br/>';

		break;
		case "upload":
			echo $output;
			$std = "";
			$class = "";
			$output = ''; 
			if(isset($value['class'])){$cl1 = ' '.$value['class'];}
			if($postId==null){$std = get_option('sense_'.$value['id']);}else{$std = get_post_meta($postId, $value['id'], true);};
			siteoptions_uploader_function($value['id'],$value['name'],$std, $class);
		break;
		
		case "color":
			$val = $value['std'];
			$def = $value['default'];
			
			$stored  = get_option( 'sense_'.$value['id'] );
			if ( $stored != "") { $val = $stored; }
			
			$output .= '
			<input name="'. esc_attr($value['id']) .'" type="text" id="'. esc_attr($value['id']) .'" value="'. $val .'" data-default-color="'. $def .'">';
			
			$output .= '<script type="text/javascript">
			jQuery(document).ready(function($) {   
				$("#'. $value['id'] .'").wpColorPicker();
			});           
			</script>'; 
		break;
		
	
		 
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;
		case "custom_type":
			echo $output;
			$output = '';
			$func = $value['function'];
			// echo ($func);
			$func();
		break;
		case "heading":

			if($counter >= 2){
			   $output .= '</div></div></div>'."\n";
			}
			$jquery_click_hook = preg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			$jquery_click_hook = str_replace(" ", "", $jquery_click_hook );
			$jquery_click_hook = "option-" . $jquery_click_hook;
			$menu .= '<li class="'. esc_attr($jquery_click_hook) .'" ><a title="'.  esc_attr($value['name']) .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="container">'."\n";
			$output .= '<div class="group" id="'. esc_attr($jquery_click_hook)  .'"><div class="sub-heading clearfix"><h4 class="sub-heading-title">'.$value['std'].'</h4></div><div class="main-holder clearfix">'."\n";
			
		break;
		
		case "breaking_list":
			global $post;
		
			$args = array('numberposts'=> -1);
			$myposts = get_posts($args);
			$output = '<ul class="breaking_news">';
			foreach( $myposts as $post ) : setup_postdata($post);
				if(get_meta_option('breaking_news') == 'true')
				{
					$output .= '<li class="list_item"><a href="'. esc_url(get_edit_post_link()) .'">'. get_the_title() .'</a></li>';
				}
				 
			endforeach;
			$output .= '</ul>';
		break;
			
		case "slider_list":
			global $post;
		
			$args = array('numberposts'=> -1);
			$myposts = get_posts($args);
			$output = '<ul class="slider_list">';
			foreach( $myposts as $post ) : setup_postdata($post);
				if(get_meta_option('posts_slider') == 'true')
				{
					$output .= '<li class="list_item"><a href="'. esc_url(get_edit_post_link()) .'">'. get_the_title() .'</a></li>';
				}
				 
			endforeach;
			$output .= '</ul>';
		break;
			
		case "editor_list":
			global $post;
		
			$args = array('numberposts'=> -1);
			$myposts = get_posts($args);
			$output = '<ul class="editors_list">';
			foreach( $myposts as $post ) : setup_postdata($post);
				if(get_meta_option('posts_editors') == 'true')
				{
					$output .= '<li class="list_item"><a href="'. esc_url(get_edit_post_link()) .'">'. get_the_title() .'</a></li>';
				}
				 
			endforeach;
			$output .= '</ul>';
		break;	
                                 
		}
		if(isset($value['container'])){
			$output .= '</div>';
		} 
		echo $output;

	}
	$output = '';
		echo $output;	

    return array($menu, $output);
}




function siteoptions_uploader_function($id, $name, $std, $cl){
	$uploader = '';
    $upload = get_option($id);
	$val = $std;
	$img = '';
	$hidden_class = 'hide ';
	?>
		<div class="sense_upload_block">
	    	<input class="sense_upload_url" type="hidden" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($id); ?>" value="<?php echo $std; ?>" />
			<a id="upload_<?php echo $id; ?>_button" class="button sense_upload_image_button add-field">Upload Image</a>
			<?php if ( $std!='' ): ?>
				<?php $img = '<img alt="" src="'.$std.'" />';
					  $hidden_class = '';
				?>
			<?php endif; ?>
			<a id="delete_<?php echo esc_attr($id); ?>_button" class="<?php echo esc_attr($hidden_class); ?>button sense_delete_image_button remove-field">Delete Image</a>
			<div class="image_preview"><?php echo $img; ?></div>
		</div>
	<?php
}

add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');

function of_ajax_callback() {
	global $wpdb;
	global $post;
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'image_reset'){
			$id = 'sense_'.$_POST['data']; // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	}elseif($save_type == 'save_home'){
		$home_data = $_POST['data'];
		update_option('sense_home', stripslashes_deep($home_data));
	}elseif($save_type == 'save_services'){	
		$home_data = $_POST['data'];
		update_option('sense_services', $home_data);
	}elseif($save_type == 'save_teams'){	
		$home_data = $_POST['data'];
		update_option('sense_teams', $home_data);
	}elseif($save_type == 'save_contact_form'){
		$form_data = $_POST['data'];
		update_option('sense_contact_form', $form_data);
	}elseif($save_type == 'save_soc'){
		$form_data = $_POST['data'];
		update_option('sense_soc', $form_data);
	}elseif($save_type == 'save_contact_icon'){
		$form_data = $_POST['data'];
		update_option('contact_icon', $form_data);
	}elseif($save_type == 'import'){
		$data = $_POST['data'];
		if(isset($data)&&($data!='')){
		parse_str($data,$output);
			$test; $test1; $test2; $test3; $test4;
			$upload = $output['theme_url'];
			$home = json_decode(stripslashes_deep($output['sense_home']));
			foreach ($home as $value) {
				$test[] = (array)$value;
			}
			$output['home'] = $test;
			unset($output['sense_home']);

			$contact_icon = json_decode(stripslashes_deep($output['contact_icon']));
			foreach ($contact_icon as $value) {
				$value->icon = str_replace( $upload, UPLOAD_URL, $value->icon);
				$test2[] = (array)$value;
			}
			$output['contact_icon'] = $test2;
			
			$soc = json_decode(stripslashes_deep($output['sense_soc']));
			foreach ($soc as $value) {
				$value->icon = str_replace( $upload, UPLOAD_URL, $value->icon);
				$test1[] = (array)$value;
			}
			$output['soc'] = $test1;
			
			$form = json_decode(stripslashes_deep($output['sense_contact_form']));
			foreach ($form as $value) {
				$test2[] = (array)$value;
			}
			$output['contact_form'] = $test2;
			
			$teams = json_decode(stripslashes_deep($output['sense_teams']));
			foreach ($teams as $value) {
				$value->img = str_replace( $upload, UPLOAD_URL, $value->img);
				$test3[] = (array)$value;
			}
			$output['teams'] = $test3;
			
			$services = json_decode(stripslashes_deep($output['sense_services']));
			foreach ($services as $value) {
				$value->img = str_replace( $upload, UPLOAD_URL, $value->img);
				$test4[] = (array)$value;
			}
			$output['services'] = $test4;
			
			unset($output['sense_home']);
			unset($output['sense_soc']);
			unset($output['contact_icon']);
			unset($output['sense_soc_about']);
			unset($output['sense_teams']);
			unset($output['sense_contact_form']);
			unset($output['sense_contact_form']);
			unset($output['sense_services']);
			foreach ($output as $key => $value) {
				$value = str_replace($upload, UPLOAD_URL, $value);
				update_option('sense_'.$key, $value);
			}
			print_r($data);
			echo "Import Success";
		}else{
			echo "Import Error!";
		}
	}elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = $_POST['data'];
		parse_str($data,$output);
		foreach ($output as $key => $value) {
			update_option('sense_'.$key, trim(stripslashes_deep($value)));
		}
		
	}elseif($save_type=='send_email'){
		$owner_email = get_option('admin_email');
		$headers = 'From:' . $_POST['data']["header_email"];
		$subject = 'A message from your site visitor ' . $_POST['data']["name"];
		$messageBody = "";
		foreach (get_option('sense_contact_form') as $value) {
			$messageBody .= $value['label'].': ' . $_POST['data'][$value['name']] . "\n";
		}
		try{
			if(!mail($owner_email, $subject, $messageBody, $headers)){
				throw new Exception('mail failed');
			}else{
				echo 'mail sent';
			}
		}catch(Exception $e){
			echo $e->getMessage() ."\n";
		}
	}

  die();

}




function get_theme_pattern(){
return array(
	get_template_directory_uri()."/images/patterns/pattern1.png"=>"pattern1",
	get_template_directory_uri()."/images/patterns/pattern2.png"=>"pattern2",
	get_template_directory_uri()."/images/patterns/pattern3.png"=>"pattern3",
	get_template_directory_uri()."/images/patterns/pattern4.png"=>"pattern4",
	get_template_directory_uri()."/images/patterns/pattern5.png"=>"pattern5",
	get_template_directory_uri()."/images/patterns/pattern6.png"=>"pattern6",
	get_template_directory_uri()."/images/patterns/pattern7.png"=>"pattern7",
	get_template_directory_uri()."/images/patterns/pattern8.png"=>"pattern8"
	  
);
}

function get_theme_color(){
return array(
	"red"=>"",
	"blue"=>"",
	"orange"=>"",
	"green"=>"",
	"grey"=>"",
	"dark_blue"=>"",
	"dark_grey"=>""
);
}
function get_fonts($font_family=''){
return array(
	$font_family=>$font_family,
	"Abel"=>"Abel",
	"Abril Fatface"=>"Abril Fatface",
	"Aclonica"=>"Aclonica",
	"Acme"=>"Acme",
	"Actor"=>"Actor",
	"Adamina"=>"Adamina",
	"Advent Pro"=>"Advent Pro",
	"Aguafina Script"=>"Aguafina Script",
	"Aladin"=>"Aladin",
	"Aldrich"=>"Aldrich",
	"Alex Brush"=>"Alex Brush",
	"Alfa Slab One"=>"Alfa Slab One",
	"Alice"=>"Alice",
	"Alike Angular"=>"Alike Angular",
	"Alike"=>"Alike",
	"Allan"=>"Allan",
	"Allerta Stencil"=>"Allerta Stencil",
	"Allerta"=>"Allerta",
	"Allura"=>"Allura",
	"Almendra SC"=>"Almendra SC",
	"Almendra"=>"Almendra",
	"Amaranth"=>"Amaranth",
	"Amatic SC"=>"Amatic SC",
	"Amethysta"=>"Amethysta",
	"Andada"=>"Andada",
	"Andika"=>"Andika",
	"Annie+Use+Your+Telescope"=>"Annie Use Your Telescope",
	"Anonymous Pro"=>"Anonymous Pro",
	"Antic Didone"=>"Antic Didone",
	"Antic Slab"=>"Antic Slab",
	"Antic"=>"Antic",
	"Anton"=>"Anton",
	"Arapey"=>"Arapey",
	"Arbutus"=>"Arbutus",
	"Architects Daughter"=>"Architects Daughter",
	"Arimo"=>"Arimo",
	"Arizonia"=>"Arizonia",
	"Armata"=>"Armata",
	"Artifika"=>"Artifika",
	"Arvo"=>"Arvo",
	"Asap"=>"Asap",
	"Asset"=>"Asset",
	"Astloch"=>"Astloch",
	"Asul"=>"Asul",
	"Atomic Age"=>"Atomic Age",
	"Aubrey"=>"Aubrey",
	"Average"=>"Average",
	"Averia Gruesa Libre"=>"Averia Gruesa Libre",
	"Averia Libre"=>"Averia Libre",
	"Averia Sans Libre"=>"Averia Sans Libre",
	"Averia Serif Libre"=>"Averia Serif Libre", 
	"Bad Script"=>"Bad Script",
	"Balthazar"=>"Balthazar",
	"Bangers"=>"Bangers",
	"Basic"=>"Basic",
	"Baumans"=>"Baumans",
	"Belgrano"=>"Belgrano",
	"Bentham"=>"Bentham",
	"Berkshire Swash"=>"Berkshire Swash",
	"Bevan"=>"Bevan",
	"Bigshot One"=>"Bigshot One",
	"Bilbo Swash Caps"=>"Bilbo Swash Caps",
	"Bilbo"=>"Bilbo",
	"Bitter"=>"Bitter",
	"Black Ops One"=>"Black Ops One",
	"Bonbon"=>"Bonbon",
	"Boogaloo"=>"Boogaloo",
	"Bowlby One SC"=>"Bowlby One SC",
	"Bowlby One"=>"Bowlby One",
	"Brawler"=>"Brawler",
	"Bree Serif"=>"Bree Serif",
	"Bubblegum Sans"=>"Bubblegum Sans",
	"Buenard"=>"Buenard",
	"Butcherman"=>"Butcherman",
	"Butterfly Kids"=>"Butterfly Kids",
	"Cabin Condensed"=>"Cabin Condensed",
	"Cabin Sketch"=>"Cabin Sketch",
	"Cabin"=>"Cabin",
	"Caesar Dressing"=>"Caesar Dressing",
	"Cagliostro"=>"Cagliostro",
	"Calligraffitti"=>"Calligraffitti",
	"Cambo"=>"Cambo",
	"Candal"=>"Candal",
	"Cantarell"=>"Cantarell",
	"Cantata One"=>"Cantata One",
	"Cardo"=>"Cardo",
	"Carme"=>"Carme",
	"Carter One"=>"Carter One",
	"Caudex"=>"Caudex",
	"Cedarville Cursive"=>"Cedarville Cursive",
	"Ceviche One"=>"Ceviche One",
	"Changa One"=>"Changa One",
	"Chango"=>"Chango",
	"Chelsea Market"=>"Chelsea Market",
	"Cherry Cream Soda"=>"Cherry Cream Soda",
	"Chewy"=>"Chewy",
	"Chicle"=>"Chicle",
	"Chivo"=>"Chivo",
	"Coda"=>"Coda",
	"Codystar"=>"Codystar",
	"Comfortaa"=>"Comfortaa",
	"Coming Soon"=>"Coming Soon",
	"Concert One"=>"Concert One",
	"Condiment"=>"Condiment",
	"Contrail One"=>"Contrail One",
	"Convergence"=>"Convergence",
	"Cookie"=>"Cookie",
	"Copse"=>"Copse",
	"Corben"=>"Corben",
	"Cousine"=>"Cousine",
	"Coustard"=>"Coustard",
	"Covered By Your Grace"=>"Covered By Your Grace",
	"Crafty Girls"=>"Crafty Girls",
	"Creepster"=>"Creepster",
	"Crete Round"=>"Crete Round",
	"Crimson Text"=>"Crimson Text",
	"Crushed"=>"Crushed",
	"Cuprum"=>"Cuprum",
	"Cutive"=>"Cutive",
	"Damion"=>"Damion",
	"Dancing Script"=>"Dancing Script",
	"Dawning of a New Day"=>"Dawning of a New Day",
	"Days One"=>"Days One",
	"Delius Swash Caps"=>"Delius Swash Caps",
	"Delius Unicase"=>"Delius Unicase",
	"Delius"=>"Delius",
	"Devonshire"=>"Devonshire",
	"Didact Gothic"=>"Didact Gothic",
	"Diplomata SC"=>"Diplomata SC",
	"Diplomata"=>"Diplomata",
	"Doppio One"=>"Doppio One",
	"Dorsa"=>"Dorsa",
	"Dr Sugiyama"=>"Dr Sugiyama",
	"Droid Sans Mono"=>"Droid Sans Mono",
	"Droid Sans"=>"Droid Sans",
	"Droid Serif"=>"Droid Serif",
	"Duru Sans"=>"Duru Sans",
	"Dynalight"=>"Dynalight",
	"EB Garamond"=>"EB Garamond",
	"Eater"=>"Eater",
	"Economica"=>"Economica",
	"Electrolize"=>"Electrolize",
	"Emblema One"=>"Emblema One",
	"Emilys Candy"=>"Emilys Candy",
	"Engagement"=>"Engagement",
	"Enriqueta"=>"Enriqueta",
	"Erica One"=>"Erica One",
	"Esteban"=>"Esteban",
	"Euphoria Script"=>"Euphoria Script",
	"Ewert"=>"Ewert",
	"Exo"=>"Exo",
	"Expletus Sans"=>"Expletus Sans",
	"Fanwood Text"=>"Fanwood Text",
	"Fascinate Inline"=>"Fascinate Inline",
	"Fascinate"=>"Fascinate",
	"Federant"=>"Federant",
	"Federo"=>"Federo",
	"Felipa"=>"Felipa",
	"Fjord One"=>"Fjord One",
	"Flamenco"=>"Flamenco",
	"Flavors"=>"Flavors",
	"Fondamento"=>"Fondamento",
	"Fontdiner Swanky"=>"Fontdiner Swanky",
	"Forum"=>"Forum",
	"Francois One"=>"Francois One",
	"Fredoka One"=>"Fredoka One",
	"Fresca"=>"Fresca",
	"Frijole"=>"Frijole",
	"Fugaz One"=>"Fugaz One",
	"Galdeano"=>"Galdeano",
	"Gentium Basic"=>"Gentium Basic",
	"Gentium Book Basic"=>"Gentium Book Basic",
	"Geo"=>"Geo",
	"Geostar Fill"=>"Geostar Fill",
	"Geostar"=>"Geostar",
	"Germania One"=>"Germania One",
	"Give You Glory"=>"Give You Glory",
	"Glass Antiqua"=>"Glass Antiqua",
	"Glegoo"=>"Glegoo",
	"Gloria Hallelujah"=>"Gloria Hallelujah",
	"Goblin One"=>"Goblin One",
	"Gochi Hand"=>"Gochi Hand",
	"Gorditas"=>"Gorditas",
	"Goudy Bookletter 1911"=>"Goudy Bookletter 1911",
	"Graduate"=>"Graduate",
	"Gravitas One"=>"Gravitas One",
	"Gruppo"=>"Gruppo",
	"Gudea"=>"Gudea",
	"Habibi"=>"Habibi",
	"Hammersmith One"=>"Hammersmith One",
	"Handlee"=>"Handlee",
	"Happy Monkey"=>"Happy Monkey",
	"Henny Penny"=>"Henny Penny",
	"Herr Von Muellerhoff"=>"Herr Von Muellerhoff",
	"Holtwood One SC"=>"Holtwood One SC",
	"Homemade Apple"=>"Homemade Apple",
	"Homenaje"=>"Homenaje",
	"IM Fell DW Pica SC"=>"IM Fell DW Pica SC",
	"IM Fell DW Pica"=>"IM Fell DW Pica",
	"IM Fell Double Pica SC"=>"IM Fell Double Pica SC",
	"IM Fell Double Pica"=>"IM Fell Double Pica",
	"IM Fell English SC"=>"IM Fell English SC",
	"IM Fell English"=>"IM Fell English",
	"IM Fell French Canon SC"=>"IM Fell French Canon SC",
	"IM Fell French Canon"=>"IM Fell French Canon",
	"IM Fell Great Primer SC"=>"IM Fell Great Primer SC",
	"IM Fell Great Primer"=>"IM Fell Great Primer",
	"Iceberg"=>"Iceberg",
	"Iceland"=>"Iceland",
	"Imprima"=>"Imprima",
	"Inconsolata"=>"Inconsolata",
	"Inder"=>"Inder",
	"Indie Flower"=>"Indie Flower",
	"Inika"=>"Inika",
	"Irish Grover"=>"Irish Grover",
	"Irish Growler"=>"Irish Growler",
	"Istok Web"=>"Istok Web",
	"Italiana"=>"Italiana",
	"Italianno"=>"Italianno",
	"Jim Nightshade"=>"Jim Nightshade",
	"Jockey One"=>"Jockey One",
	"Jolly Lodger"=>"Jolly Lodger",
	"Josefin Sans"=>"Josefin Sans Regular 400",
	"Josefin Slab"=>"Josefin Slab Regular 400",
	"Judson"=>"Judson",
	"Julee"=>"Julee",
	"Junge"=>"Junge",
	"Jura"=>" Jura Regular",
	"Just Another Hand"=>"Just Another Hand",
	"Just Me Again Down Here"=>"Just Me Again Down Here",
	"Kameron"=>"Kameron",
	"Karla"=>"Karla",
	"Kaushan Script"=>"Kaushan Script",
	"Kelly Slab"=>"Kelly Slab",
	"Kenia"=>"Kenia",
	"Knewave"=>"Knewave",
	"Kotta One"=>"Kotta One",
	"Kranky"=>"Kranky",
	"Kreon"=>"Kreon",
	"Kristi"=>"Kristi",
	"Krona One"=>"Krona One",
	"La Belle Aurore"=>"La Belle Aurore",
	"Lancelot"=>"Lancelot",
	"Lato"=>"Lato",
	"League Script"=>"League Script",
	"Leckerli One"=>"Leckerli One",
	"Ledger"=>"Ledger",
	"Lekton"=>" Lekton",
	"Lemon"=>"Lemon",
	"Lilita One"=>"Lilita One",
	"Limelight"=>" Limelight",
	"Linden Hill"=>"Linden Hill",
	"Lobster Two"=>"Lobster Two",
	"Lobster"=>"Lobster",
	"Londrina Outline"=>"Londrina Outline",
	"Londrina Shadow"=>"Londrina Shadow",
	"Londrina Sketch"=>"Londrina Sketch",
	"Londrina Solid"=>"Londrina Solid",
	"Lora"=>"Lora",
	"Love Ya Like A Sister"=>"Love Ya Like A Sister",
	"Loved by the King"=>"Loved by the King",
	"Luckiest Guy"=>"Luckiest Guy",
	"Lusitana"=>"Lusitana",
	"Lustria"=>"Lustria",
	"Macondo Swash Caps"=>"Macondo Swash Caps",
	"Macondo"=>"Macondo",
	"Magra"=>"Magra",
	"Maiden Orange"=>"Maiden Orange",
	"Mako"=>"Mako",
	"Marck Script"=>"Marck Script",
	"Marko One"=>"Marko One",
	"Marmelad"=>"Marmelad",
	"Marvel"=>"Marvel",
	"Mate SC"=>"Mate SC",
	"Mate"=>"Mate",
	"Maven Pro"=>" Maven Pro",
	"Meddon"=>"Meddon",
	"MedievalSharp"=>"MedievalSharp",
	"Medula One"=>"Medula One",
	"Megrim"=>"Megrim",
	"Merienda One"=>"Merienda One",
	"Merriweather"=>"Merriweather",
	"Metamorphous"=>"Metamorphous",
	"Metrophobic"=>"Metrophobic",
	"Michroma"=>"Michroma",
	"Miltonian Tattoo"=>"Miltonian Tattoo",
	"Miltonian"=>"Miltonian",
	"Miniver"=>"Miniver",
	"Miss Fajardose"=>"Miss Fajardose",
	"Miss Saint Delafield"=>"Miss Saint Delafield",
	"Modern Antiqua"=>"Modern Antiqua",
	"Molengo"=>"Molengo",
	"Monofett"=>"Monofett",
	"Monoton"=>"Monoton",
	"Monsieur La Doulaise"=>"Monsieur La Doulaise",
	"Montaga"=>"Montaga",
	"Montez"=>"Montez",
	"Montserrat"=>"Montserrat",
	"Mountains of Christmas"=>"Mountains of Christmas",
	"Mr Bedford"=>"Mr Bedford",
	"Mr Dafoe"=>"Mr Dafoe",
	"Mr De Haviland"=>"Mr De Haviland",
	"Mrs Saint Delafield"=>"Mrs Saint Delafield",
	"Mrs Sheppards"=>"Mrs Sheppards",
	"Muli"=>"Muli Regular",
	"Mystery Quest"=>"Mystery Quest",
	"Neucha"=>"Neucha",
	"Neuton"=>"Neuton",
	"News Cycle"=>"News Cycle",
	"Niconne"=>"Niconne",
	"Nixie One"=>"Nixie One",
	"Nobile"=>"Nobile",
	"Nokora"=>"Nokora",
	"Norican"=>"Norican",
	"Nosifer"=>"Nosifer",
	"Noticia Text"=>"Noticia Text",
	"Nova Cut"=>"Nova Cut",
	"Nova Flat"=>"Nova Flat",
	"Nova Mono"=>"Nova Mono",
	"Nova Oval"=>"Nova Oval",
	"Nova Round"=>"Nova Round",
	"Nova Script"=>"Nova Script",
	"Nova Slim"=>"Nova Slim",
	"Nova Square"=>"Nova Square",
	"Numans"=>"Numans",
	"Nunito"=>" Nunito Regular",
	"OFL Sorts Mill Goudy TT"=>"OFL Sorts Mill Goudy TT",
	"Old Standard TT"=>"Old Standard TT",
	"Oldenburg"=>"Oldenburg",
	"Open Sans Condensed"=>"Open Sans Condensed",
	"Orbitron"=>"Orbitron Regular (400)",
	"Original Surfer"=>"Original Surfer",
	"Oswald"=>"Oswald",
	"Over the Rainbow"=>"Over the Rainbow",
	"Overlock SC"=>"Overlock SC",
	"Overlock"=>"Overlock",
	"Ovo"=>"Ovo",
	"PT Mono"=>"PT Mono",
	"PT Sans Caption"=>"PT Sans Caption",
	"PT Sans Narrow"=>"PT Sans Narrow",
	"PT Sans"=>"PT Sans",
	"PT Serif Caption"=>"PT Serif Caption",
	"PT Serif"=>"PT Serif",
	"Pacifico"=>"Pacifico",
	"Parisienne"=>"Parisienne",
	"Passero One"=>"Passero One",
	"Passion One"=>"Passion One",
	"Patrick Hand"=>"Patrick Hand",
	"Patua One"=>"Patua One",
	"Paytone One"=>"Paytone One",
	"Permanent Marker"=>"Permanent Marker",
	"Petrona"=>"Petrona",
	"Philosopher"=>"Philosopher",
	"Piedra"=>"Piedra",
	"Pinyon Script"=>"Pinyon Script",
	"Plaster"=>"Plaster",
	"Play"=>"Play",
	"Playball"=>"Playball",
	"Playfair Display"=>" Playfair Display",
	"Podkova"=>" Podkova",
	"Poiret One"=>"Poiret One",
	"Poller One"=>"Poller One",
	"Poly"=>"Poly",
	"Pompiere"=>"Pompiere",
	"Pontano Sans"=>"Pontano Sans",
	"Port Lligat Sans"=>"Port Lligat Sans",
	"Port Lligat Slab"=>"Port Lligat Slab",
	"Prata"=>"Prata",
	"Princess Sofia"=>"Princess Sofia",
	"Prociono"=>"Prociono",
	"Prosto One"=>"Prosto One",
	"Puritan"=>"Puritan",
	"Quantico"=>"Quantico",
	"Quattrocento Sans"=>"Quattrocento Sans",
	"Quattrocento"=>"Quattrocento",
	"Questrial"=>"Questrial",
	"Quicksand"=>"Quicksand",
	"Qwigley"=>"Qwigley",
	"Radley"=>"Radley",
	"Rammetto One"=>"Rammetto One",
	"Rancho"=>"Rancho",
	"Rationale"=>"Rationale",
	"Redressed"=>"Redressed",
	"Reenie Beanie"=>"Reenie Beanie",
	"Revalia"=>"Revalia",
	"Ribeye Marrow"=>"Ribeye Marrow",
	"Ribeye"=>"Ribeye",
	"Righteous"=>"Righteous",
	"Rochester"=>"Rochester",
	"Rock Salt"=>"Rock Salt",
	"Rokkitt"=>"Rokkitt",
	"Ropa Sans"=>"Ropa Sans",
	"Rosario"=>"Rosario",
	"Rouge Script"=>"Rouge Script",
	"Ruda"=>"Ruda",
	"Ruge Boogie"=>"Ruge Boogie",
	"Ruluko"=>"Ruluko",
	"Ruslan Display"=>"Ruslan Display",
	"Ruthie"=>"Ruthie",
	"Sail"=>"Sail",
	"Salsa"=>"Salsa",
	"Sancreek"=>"Sancreek",
	"Sansita One"=>"Sansita One",
	"Sarina"=>"Sarina",
	"Satisfy"=>"Satisfy",
	"Schoolbell"=>"Schoolbell",
	"Seaweed Script"=>"Seaweed Script",
	"Sevillana"=>"Sevillana",
	"Shadows Into Light Two"=>"Shadows Into Light Two",
	"Shadows Into Light"=>"Shadows Into Light",
	"Shanti"=>"Shanti",
	"Share"=>"Share",
	"Shojumaru"=>"Shojumaru",
	"Short Stack"=>"Short Stack",
	"Sigmar One"=>"Sigmar One",
	"Signika Negative"=>"Signika Negative",
	"Signika"=>"Signika",
	"Simonetta"=>"Simonetta",
	"Sirin Stencil"=>"Sirin Stencil",
	"Six Caps"=>"Six Caps",
	"Slackey"=>"Slackey",
	"Smokum"=>"Smokum",
	"Smythe"=>"Smythe",
	"Snippet"=>"Snippet",
	"Sofia"=>"Sofia",
	"Sonsie One"=>"Sonsie One",
	"Sorts Mill Goudy"=>"Sorts Mill Goudy",
	"Special Elite"=>"Special Elite",
	"Spicy Rice"=>"Spicy Rice",
	"Spinnaker"=>"Spinnaker",
	"Spirax"=>"Spirax",
	"Squada One"=>"Squada One",
	"Stardos Stencil"=>"Stardos Stencil",
	"Stint Ultra Condensed"=>"Stint Ultra Condensed",
	"Stint Ultra Expanded"=>"Stint Ultra Expanded",
	"Stoke"=>"Stoke",
	"Sue Ellen Francisco"=>"Sue Ellen Francisco",
	"Sunshiney"=>"Sunshiney",
	"Supermercado One"=>"Supermercado One",
	"Swanky and Moo Moo"=>"Swanky and Moo Moo",
	"Syncopate"=>"Syncopate",
	"Tangerine"=>"Tangerine",
	"Telex"=>"Telex",
	"Tenor Sans"=>" Tenor Sans",
	"Terminal Dosis Light"=>"Terminal Dosis Light",
	"Terminal Dosis"=>"Terminal Dosis Regular",
	"The Girl Next Door"=>"The Girl Next Door",
	"Tinos"=>"Tinos",
	"Titan One"=>"Titan One",
	"Trade Winds"=>"Trade Winds",
	"Trochut"=>"Trochut",
	"Trykker"=>"Trykker",
	"Tulpen One"=>"Tulpen One",
	"Ubuntu Condensed"=>"Ubuntu Condensed",
	"Ubuntu Mono"=>"Ubuntu Mono",
	"Ubuntu"=>"Ubuntu",
	"Ultra"=>"Ultra",
	"Uncial Antiqua"=>"Uncial Antiqua",
	"UnifrakturMaguntia"=>"UnifrakturMaguntia",
	"Unkempt"=>"Unkempt",
	"Unlock"=>"Unlock",
	"Unna"=>"Unna",
	"VT323"=>"VT323",
	"Varela Round"=>"Varela Round",
	"Varela"=>"Varela",
	"Vast Shadow"=>"Vast Shadow",
	"Vibur"=>"Vibur",
	"Vidaloka"=>"Vidaloka",
	"Viga"=>"Viga",
	"Voces"=>"Voces",
	"Volkhov"=>"Volkhov",
	"Vollkorn"=>"Vollkorn",
	"Voltaire"=>"Voltaire",
	"Waiting for the Sunrise"=>"Waiting for the Sunrise",
	"Wallpoet"=>"Wallpoet",
	"Walter Turncoat"=>"Walter Turncoat",
	"Wellfleet"=>"Wellfleet",
	"Wire One"=>"Wire One",
	"Yanone Kaffeesatz"=>"Yanone Kaffeesatz",
	"Yellowtail"=>"Yellowtail",
	"Yeseva One"=>"Yeseva One",
	"Yesteryear"=>"Yesteryear",
	"Zeyada"=>"Zeyada",
);



}

function get_styles($style = ''){
return array(
	$style=>$style,
	"normal"=>"Normal",
	"italic"=>"Italic"
);
}




function get_font_size($size = ''){
return array(
	$size.'px'=>$size.'px',
	"9px"=>"9px",
	"10px"=>"10px",
	"11px"=>"11px",
	"12px"=>"12px",
	"13px"=>"13px",
	"14px"=>"14px",
	"15px"=>"15px",
	"16px"=>"16px",
	"17px"=>"17px",
	"18px"=>"18px",
	"19px"=>"19px",
	"20px"=>"20px",
	"21px"=>"21px",
	"22px"=>"22px",
	"23px"=>"23px",
	"24px"=>"24px",
	"25px"=>"25px",
	"26px"=>"26px",
	"27px"=>"27px",
	"28px"=>"28px",
	"29px"=>"29px",
	"30px"=>"30px",
	"31px"=>"31px",
	"32px"=>"32px",
	"33px"=>"33px",
	"34px"=>"34px",
	"35px"=>"35px",
	"36px"=>"36px",
	"37px"=>"37px",
	"38px"=>"38px",
	"39px"=>"39px",
	"40px"=>"40px",
	"41px"=>"41px",
	"42px"=>"42px",
	"43px"=>"43px",
	"44px"=>"44px",
	"45px"=>"45px",
	"46px"=>"46px",
	"47px"=>"47px",
	"48px"=>"48px",
	"49px"=>"49px",
	"50px"=>"50px",
	"51px"=>"51px",
	"52px"=>"52px",
	"53px"=>"53px",
	"54px"=>"54px",
	"55px"=>"55px",
	"56px"=>"56px",
	"57px"=>"57px",
	"58px"=>"58px",
	"59px"=>"59px",
	"60px"=>"60px",
	"61px"=>"61px",
	"62px"=>"62px",
	"63px"=>"63px",
	"64px"=>"64px",
	"65px"=>"65px",
	"66px"=>"66px",
	"67px"=>"67px",
	"68px"=>"68px",
	"69px"=>"69px",
	"70px"=>"70px",
	"71px"=>"71px",
	"72px"=>"72px"
);
}


function base_font(){
	return array(
	""=>"select font family",
			'Open Sans'										=>'Open Sans',
			'Arial, Helvetica, sans-serif'					=> 'Arial',
			'Courier New'				=> 'Courier New',
			'Arial Black'				=> 'Arial Black',
			'Georgia, Times, serif'		=> 'Georgia',
			'PT Sans'							=> 'PT Sans',
			'Tahoma, Geneva, sans-serif'					=> 'Tahoma',
			'Times New Roman'				=> 'Times New Roman',
			'Trebuchet MS'	=> 'Trebuchet MS',
			'Verdana, Geneva, sans-serif'					=> 'Verdana'
			);
			}


function base_category(){
	$arr_cat = array();
	$args = array('type' => 'post');
	$categories=  get_categories($args);  
  	foreach ($categories as $category) 
	{  
		
		$option = $category->cat_name;  
		$arr_cat[$option] = $option;
		  
	  } 
	return $arr_cat;
	}
	
	
function base_posts($select = ''){
	$entries = array();
	$entries = get_posts('orderby=ID&numberposts=-1&order=ASC&post_type=static_block');
	$options1 = array();
	$options2 = array();
	if($select != '') {
		$options2[1] = 'None';
		foreach($entries as $key => $entry) {
		if($key == $select) {
		$options1[$entry->ID] = $entry->post_title;
		} else {
		$options2[$entry->ID] = $entry->post_title;
		}
		}
		$options = $options1 + $options2;
	} else {
		$options[0] = 'None';
		foreach($entries as $key => $entry) {
			$options[$entry->ID] = $entry->post_title;
		}
	}
	
	return $options;
}

	
	
	
?>