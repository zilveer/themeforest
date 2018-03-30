<?php
function candidate_add_admin() {
    $of_page = add_theme_page( 'Candidate Options', 'Candidate Options', 'edit_theme_options', 'siteoptions', 'siteoptions_options_page' );
	
	 add_theme_page( 'Candidate Data', 'Candidate Data', 'edit_theme_options', 'sitedata', 'candidate_data_options_page' );
}
add_action( 'admin_menu', 'candidate_add_admin' );


function candidate_data_options_page() {

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
		
		$options[] = array( "name" => "Show button to top",
					"type" => "radio",
					"id" => "show_button_to_top",
					"std" => get_option('sense_show_button_to_top'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
		
		
		$options[] = array( "name" => "Content Animation",
					"type" => "radio",
					"id" => "settings_animate",
					"std" => get_option('sense_settings_animate'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
					
		$options[] = array( "name" => "Content Loading",
					"type" => "radio",
					"id" => "settings_loading",
					"std" => get_option('sense_settings_loading'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
					
					
		$options[] = array( "name" => "Title Top Form",
					"type" => "textarea",
					"id" => "top_title1",
					"std" => get_option('sense_top_title1')
					);				
					
		$options[] = array( "name" => "Text1 Top Form",
					"type" => "text",
					"id" => "top_text1",
					"std" => get_option('sense_top_text1')
					);			
					
		$options[] = array( "name" => "Text2 Top Form",
					"type" => "text",
					"id" => "top_text2",
					"std" => get_option('sense_top_text2')
					);					
			
		$options[] = array( "name" => "Success Message Top Form",
					"type" => "text",
					"id" => "added_text_newsletter",
					"std" => get_option('sense_added_text_newsletter')
					);	

		$options[] = array( "name" => "Invalid Email Message Top Form",
					"type" => "text",
					"id" => "added_text_newsletter2",
					"std" => get_option('sense_added_text_newsletter2')
					);	

		
		$options[] = array( "name" => "",
					"type" => "info",
					"std" => '<h4 style="color:#2A2B2D;" >Settings Logo</h4>',
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

		$options[] = array( "name" => "Logo Image",
					"type" => "upload",
					"id" => "logo_image_loft",
					"std" => get_option('sense_logo_image_loft'),
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
					"std" => "#7fcae8"
					);
		$options[] = array( "name" => "<p class='logo_font_family'>Logo Font Family</p>",
					"type" => "select",
					"id" => "logo_font_family",
					"std" => get_option('sense_logo_font_family'),
					"options" => get_fonts()
					);
		
		
		
	
		
		
		
		$options[] = array( "name" => "",
					"type" => "info",
					"std" => '<h4 style="color:#2A2B2D;" >Customize Box</h4>',
					);	
		$options[] = array( "name" => "",
					"type" => "radio",
					"id" => "settings_show",
					"std" => get_option('sense_settings_show'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
		
		$options[] = array( "name" => "Settings Layout Type",
					"type" => "select",
					"id" => "settings_bg",
					"std" => get_option('sense_settings_bg'),
					"options" => array(
						"wide"=>"Wide",
						"boxed-layout"=>"Boxed"
						)
					);

					
		$options[] = array( "name" => "Theme Pattern Scheme",
					"type" => "radio2",
					"id" => "settings_layout_img",
					"std" => get_option('sense_settings_layout_img'),
					"options" => array(
						"pattern_1"=>'<label style="display: inline-block; margin-left: 10px;" ><img src="'. get_template_directory_uri() .'/img/background/1-thumb.jpg" ></label>',
						"pattern_2"=>'<label style="display: inline-block; margin-left: 10px;" ><img src="'. get_template_directory_uri() .'/img/background/2-thumb.jpg" ></label>',
						"pattern_3"=>'<label style="display: inline-block; margin-left: 10px;" ><img src="'. get_template_directory_uri() .'/img/background/3-thumb.jpg" ></label>'
						)
					);				
					
		$options[] = array( "name" => "Background Color",
					"type" => "color",
					"id" => "select_bg_color1",
					"default" => "#f2f4f9",
					"std" => "#f2f4f9"
					);			
					
		$options[] = array( "name" => "Setting Background Image",
					"type" => "select",
					"id" => "checkboxbackground1",
					"std" => get_option('sense_checkboxbackground1'),
					"options" => array(
						"color"=>"Color",
						"custom"=>"Custom Image",
						"theme"=>"Theme Image"
						)
					);			
					
		$options[] = array( "name" => "Custom Background Image",
					"type" => "upload",
					"id" => "background1",
					"std" => get_option('sense_background1')
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
					
		$options[] = array( "name" => "Title Sermon Page",
					"type" => "text",
					"id" => "sermon_title",
					"std" => get_option('sense_sermon_title')
					);			
		
		$options[] = array( "name" => "Title Event Page",
					"type" => "text",
					"id" => "event_title1",
					"std" => get_option('sense_event_title1')
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
						
						
						
						
						
						
						
	////////////////////////////Color set/////////////////////////////////////////////////////////////////////////////	
	$options[] = array( "name" => "Color", "std" => "Theme Color Settings",
				"type" => "heading");
	
			
	$options[] = array( "name" => "Accent color 1 (blue)",
					"type" => "color",
					"id" => "accent1_color",
					"std" => "#63b2f5",
					"default" => "#63b2f5"
					);
	
	$options[] = array( "name" => "Accent color 2 (red)",
					"type" => "color",
					"id" => "accent2_color",
					"std" => "#a82512",
					"default" => "#a82512"
					);
	
	$options[] = array( "name" => "Color 3 (dark blue)",
					"type" => "color",
					"id" => "accent3_color",
					"std" => "#274472",
					"default" => "#274472"
					);
	
	$options[] = array( "name" => "Color 4 (white)",
					"type" => "color",
					"id" => "accent4_color",
					"std" => "#fafbfd",
					"default" => "#fafbfd"
					);
	
	$options[] = array( "name" => "Сolor 5 (grey)",
					"type" => "color",
					"id" => "accent5_color",
					"std" => "#e2eaf2",
					"default" => "#e2eaf2"
					);
	
	$options[] = array( "name" => "Color 6 (blue-gray)",
					"type" => "color",
					"id" => "accent6_color",
					"std" => "#ebf4fc",
					"default" => "#ebf4fc"
					);
	
	$options[] = array( "name" => "Background button (gray)",
					"type" => "color",
					"id" => "gray_btn_color",
					"std" => "#e2eaf2",
					"default" => "#e2eaf2"
					);
					
	$options[] = array( "name" => "Background container (gray-bg)",
					"type" => "color",
					"id" => "gray_bg_color",
					"std" => "#f2f4f9",
					"default" => "#f2f4f9"
					);
	
	
	$options[] = array( "name" => "Footer Background Color",
					"type" => "color",
					"id" => "footer_color1",
					"std" => "#274472",
					"default" => "#274472"
					);		
	$options[] = array( "name" => "Background color for the main header",
					"type" => "color",
					"id" => "bg_main_header_color",
					"std" => "#274472",
					"default" => "#274472"
					);		
					
	$options[] = array( "name" => "Background color for the Top Form",
					"type" => "color",
					"id" => "bg_form_header_color",
					"std" => "#324e79",
					"default" => "#324e79"
					);

	$options[] = array( "name" => "Submit (Top Form) Icon color",
					"type" => "color",
					"id" => "submit_newsletter_color_icon",
					"std" => "#fff",
					"default" => "#fff"
					);					
					
	$options[] = array( "name" => "Submit (Top Form) color",
					"type" => "color",
					"id" => "submit_newsletter_color",
					"std" => "#63B2F5",
					"default" => "#63B2F5"
					);				
					
	$options[] = array( "name" => "Submit (Top Form) hover color",
					"type" => "color",
					"id" => "submit_newsletter_hover_color",
					"std" => "#4174c5",
					"default" => "#4174c5"
					);

	$options[] = array( "name" => "Submit (Top Form) Border Bottom color",
					"type" => "color",
					"id" => "topform_border_bottom_color",
					"std" => "#bfc8d7",
					"default" => "#bfc8d7"
					);	
					

	$options[] = array( "name" => "Submit (Top Form) Border Bottom  Hover color",
					"type" => "color",
					"id" => "hover_topform_border_bottom_color",
					"std" => "#579dd9",
					"default" => "#579dd9"
					);						
					
					
					
	$options[] = array( "name" => "Header quote  color",
					"type" => "color",
					"id" => "header_blockquote_color",
					"std" => "#50688c",
					"default" => "#50688c"
					);	
					
	$options[] = array( "name" => "Background color for the Banner Donate",
					"type" => "color",
					"id" => "bg_banner_donate_color",
					"std" => "#ede1e2",
					"default" => "#ede1e2"
					);								
					
	$options[] = array( "name" => "Color for the Banner Donate Text",
					"type" => "color",
					"id" => "text_banner_donate_color",
					"std" => "#a82512",
					"default" => "#a82512"
					);						
					
					
	$options[] = array( "name" => "Color for the Banner Icon",
					"type" => "color",
					"id" => "banner_icon_color",
					"std" => "#c6d0dc",
					"default" => "#c6d0dc"
					);						
					
	$options[] = array( "name" => "Color for the Banner Icon Hover",
					"type" => "color",
					"id" => "banner_icon_hover_color",
					"std" => "#9ccbf8",
					"default" => "#9ccbf8"
					);

	$options[] = array( "name" => "Color for the Banner Title Hover",
					"type" => "color",
					"id" => "banner_title_hover_color",
					"std" => "#fff",
					"default" => "#fff"
					);
	$options[] = array( "name" => "Color for the Banner Text Hover",
					"type" => "color",
					"id" => "banner_text_hover_color",
					"std" => "#dbe7f2",
					"default" => "#dbe7f2"
					);


	
	
	$options[] = array( "name" => "Color for the Donate Button Border Top",
					"type" => "color",
					"id" => "donate_border_top_color",
					"std" => "#be2e17",
					"default" => "#be2e17"
					);	
	
	$options[] = array( "name" => "Color for the Donate Button Border Bottom",
					"type" => "color",
					"id" => "donate_border_bottom_color",
					"std" => "#911f0f",
					"default" => "#911f0f"
					);	
	
	
	$options[] = array( "name" => "Color for the Donate Button Border Top Hover",
					"type" => "color",
					"id" => "hover_donate_border_top_color",
					"std" => "#d3311a7",
					"default" => "#d3311a"
					);	
	
	$options[] = array( "name" => "Color for the Donate Button Border Bottom Hover",
					"type" => "color",
					"id" => "hover_donate_border_bottom_color",
					"std" => "#911f0f",
					"default" => "#911f0f"
					);	
	
	
	$options[] = array( "name" => "Color for the Donate Button Hover",
					"type" => "color",
					"id" => "donate_button_hover_color",
					"std" => "#d3311a",
					"default" => "#d3311a"
					);	
					
					
					
	$options[] = array( "name" => "Color for the Button Campaign Hover",
					"type" => "color",
					"id" => "banner_campaign_hover_color",
					"std" => "#324e79",
					"default" => "#324e79"
					);	
	
	
	$options[] = array( "name" => "Color for the Basic Button Border Top",
					"type" => "color",
					"id" => "button_border_top_color",
					"std" => "#f3f7fa",
					"default" => "#f3f7fa"
					);	
	
	$options[] = array( "name" => "Color for the Basic Button Border Bottom",
					"type" => "color",
					"id" => "button_border_bottom_color",
					"std" => "#bfc8d7",
					"default" => "#bfc8d7"
					);	
					
					
	$options[] = array( "name" => "Color for the Basic Hover Button Border Top",
					"type" => "color",
					"id" => "hover_button_border_top_color",
					"std" => "#7cc5f8",
					"default" => "#7cc5f8"
					);	
	
	$options[] = array( "name" => "Color for the Basic Hover Button Border Bottom",
					"type" => "color",
					"id" => "hover_button_border_bottom_color",
					"std" => "#579dd9",
					"default" => "#579dd9"
					);					
	
	$options[] = array( "name" => "Color for the Basic Button Arrow",
					"type" => "color",
					"id" => "button_arrow_color",
					"std" => "#808ca4",
					"default" => "#808ca4"
					);		
	
	$options[] = array( "name" => "Color for the Hover Basic Button Arrow",
					"type" => "color",
					"id" => "button_arrow_color_hover",
					"std" => "#fff",
					"default" => "#fff"
					);	
	
	
	
	$options[] = array( "name" => "Color for the Campaign Banner Title",
					"type" => "color",
					"id" => "title_button_rotator_color",
					"std" => "#fff",
					"default" => "#fff"
					);						
	
	$options[] = array( "name" => "Color for the Campaign Banner Title Top",
					"type" => "color",
					"id" => "title_top_button_rotator_color",
					"std" => "#274472",
					"default" => "#274472"
					);	
	
	$options[] = array( "name" => "Color for the Campaign Banner Pagination",
					"type" => "color",
					"id" => "button_rotator_color",
					"std" => "#a3cef3",
					"default" => "#a3cef3"
					);		


    $options[] = array( "name" => "Color for the Image Banner Border Top",
					"type" => "color",
					"id" => "image_banner_border_top_color",
					"std" => "#f3f7fa",
					"default" => "#f3f7fa"
					);	
	
	$options[] = array( "name" => "Color for the Image Banner Border Bottom",
					"type" => "color",
					"id" => "image_banner_border_bottom_color",
					"std" => "#BFC8D7",
					"default" => "#BFC8D7"
					);	 

    $options[] = array( "name" => "Color for the Hover Image Banner Border Top",
					"type" => "color",
					"id" => "image_banner_border_top_color_hover",
					"std" => "#7CC5F8",
					"default" => "#7CC5F8"
					);	
	
	$options[] = array( "name" => "Color for the Hover Image Banner Border Bottom",
					"type" => "color",
					"id" => "image_banner_border_bottom_color_hover",
					"std" => "#BFC8D7",
					"default" => "#BFC8D7"
					);	 


	$options[] = array( "name" => "Color for the Hover Image Banner Background",
					"type" => "color",
					"id" => "image_banner_bg_color_hover",
					"std" => "#4174c5",
					"default" => "#4174c5"
					);	 
					
	$options[] = array( "name" => "Color for the Image Banner Title",
					"type" => "color",
					"id" => "image_banner_title_color",
					"std" => "#fff",
					"default" => "#fff"
					);	 				
					
					
					


	
	$options[] = array( "name" => "Link color",
					"type" => "color",
					"id" => "basic_link_color",
					"std" => "#4174c5",
					"default" => "#4174c5"
					);
	
	$options[] = array( "name" => "Link Hover Color",
					"type" => "color",
					"id" => "basic_link_color_hover",
					"std" => "#274472",
					"default" => "#274472"
					);
	
	$options[] = array( "name" => "Tab icon color",
					"type" => "color",
					"id" => "tab_icon_color",
					"std" => "#808ca4",
					"default" => "#808ca4"
					);			
					
	$options[] = array( "name" => "Tab content background color",
					"type" => "color",
					"id" => "tab_content_bg_color",
					"std" => "#ffffff",
					"default" => "#ffffff"
					);				
					
	$options[] = array( "name" => "Add to Cart icon color",
					"type" => "color",
					"id" => "add_cart_icon_color",
					"std" => "#c37d78",
					"default" => "#c37d78"
					);	

	$options[] = array( "name" => "Add to Cart icon color(single product)",
					"type" => "color",
					"id" => "add_cart_single_icon_color",
					"std" => "#d6aaa7",
					"default" => "#d6aaa7"
					);	
					
	$options[] = array( "name" => "Add to Cart button hover color",
					"type" => "color",
					"id" => "add_cart_hover_color",
					"std" => "#d3311a",
					"default" => "#d3311a"
					);				
					
	$options[] = array( "name" => "Shop info alert-box color",
					"type" => "color",
					"id" => "shop_alert_info_color",
					"std" => "#d8e1f1",
					"default" => "#d8e1f1"
					);			
	

	$options[] = array( "name" => "Color for the Twitter button background",
					"type" => "color",
					"id" => "bg_twitter_button_color",
					"std" => "#40bff5",
					"default" => "#40bff5"
					);
	
	$options[] = array( "name" => "Color for the Twitter button text",
					"type" => "color",
					"id" => "text_twitter_button_color",
					"std" => "#fff",
					"default" => "#fff"
					);
	
	$options[] = array( "name" => "Color for the Twitter button border top",
					"type" => "color",
					"id" => "bg_twitter_border_top_color",
					"std" => "#53d2f8",
					"default" => "#53d2f8"
					);
					
	$options[] = array( "name" => "Color for the Twitter button border bottom",
					"type" => "color",
					"id" => "bg_twitter_border_bottom_color",
					"std" => "#36a6d6",
					"default" => "#36a6d6"
					);
					
	$options[] = array( "name" => "Color for the Twitter button background hover",
					"type" => "color",
					"id" => "bg_twitter_button_hover_color",
					"std" => "#e2eaf2",
					"default" => "#e2eaf2"
					);

	$options[] = array( "name" => "Color for the Twitter button icon",
					"type" => "color",
					"id" => "bg_twitter_button_icon_color",
					"std" => "#b1e1fa",
					"default" => "#b1e1fa"
					);

	$options[] = array( "name" => "Color for the Hover Twitter button icon",
					"type" => "color",
					"id" => "bg_twitter_button_icon_color_hover",
					"std" => "#40BFF5",
					"default" => "#40BFF5"
					);
					
	$options[] = array( "name" => "Color for the menu hover button",
					"type" => "color",
					"id" => "bg_menu_hover_color",
					"std" => "#63b2f5",
					"default" => "#63b2f5"
					);
					
	$options[] = array( "name" => "Color for the menu hover border top button",
					"type" => "color",
					"id" => "bg_menu_border_top_hover_color",
					"std" => "#7cc5f8",
					"default" => "#7cc5f8"
					);				
					
	$options[] = array( "name" => "Color for the menu hover border bottom button",
					"type" => "color",
					"id" => "bg_menu_border_bottom_hover_color",
					"std" => "#579dd9",
					"default" => "#579dd9"
					);


	$options[] = array( "name" => "Color for the menu border top",
					"type" => "color",
					"id" => "bg_menu_border_top_color",
					"std" => "#fff",
					"default" => "#fff"
					);
					
	$options[] = array( "name" => "Color for the menu border bottom",
					"type" => "color",
					"id" => "bg_menu_border_bottom_color",
					"std" => "#dee0e5",
					"default" => "#dee0e5"
					);
					
	$options[] = array( "name" => "Color for the menu arrow",
					"type" => "color",
					"id" => "bg_menu_icon_color",
					"std" => "#a8abae",
					"default" => "#a8abae"
					);

	$options[] = array( "name" => "Color for the menu bg",
					"type" => "color",
					"id" => "bg_menu_main_color",
					"std" => "#f2f4f9",
					"default" => "#f2f4f9"
					);

					
	$options[] = array( "name" => "Color for the menu hover text button",
					"type" => "color",
					"id" => "bg_menu_text_hover_color",
					"std" => "#fff",
					"default" => "#fff"
					);					
	
					
	
	$options[] = array( "name" => "Color for the highlight text",
					"type" => "color",
					"id" => "highlight_color",
					"std" => "#fff",
					"default" => "#fff"
					);	
	
	$options[] = array( "name" => "Color for the highlight background",
					"type" => "color",
					"id" => "highlight_color_bg",
					"std" => "#4174c5",
					"default" => "#4174c5"
					);	
	
	$options[] = array( "name" => "Color for the Footer Border",
					"type" => "color",
					"id" => "footer_border_color",
					"std" => "#324e79",
					"default" => "#324e79"
					);	
	
	$options[] = array( "name" => "Color for the Footer Text",
					"type" => "color",
					"id" => "footer_text_color",
					"std" => "#97acc3",
					"default" => "#97acc3"
					);	
	
	$options[] = array( "name" => "Color for the Footer Link",
					"type" => "color",
					"id" => "footer_text_color_link",
					"std" => "#e2eaf2",
					"default" => "#e2eaf2"
					);	
	
	$options[] = array( "name" => "Color for the Footer Link Hover",
					"type" => "color",
					"id" => "footer_text_color_link_hover",
					"std" => "#63b2f5",
					"default" => "#63b2f5"
					);	
	
	
	
	$options[] = array( "name" => "Color for the Calendar Month Line",
					"type" => "color",
					"id" => "calendar_line_color",
					"std" => "#ecedf1",
					"default" => "#ecedf1"
					);	
	
	$options[] = array( "name" => "Color for the Calendar Month Line Hover",
					"type" => "color",
					"id" => "calendar_line_color_hover",
					"std" => "#81c7f8",
					"default" => "#81c7f8"
					);	
	
	
	
	$options[] = array( "name" => "Color for the Form Border",
					"type" => "color",
					"id" => "form_border_color",
					"std" => "#dee0e5",
					"default" => "#dee0e5"
					);			
	
	$options[] = array( "name" => "Color for the Form Background",
					"type" => "color",
					"id" => "form_bg_color",
					"std" => "#fafbfd",
					"default" => "#fafbfd"
					);	
	
	$options[] = array( "name" => "Color for the Form Text",
					"type" => "color",
					"id" => "form_text_color",
					"std" => "#95999e",
					"default" => "#95999e"
					);	
	$options[] = array( "name" => "Color for the Pricing Table pricing-title",
					"type" => "color",
					"id" => "pricing_title_color",
					"std" => "#63b2f5",
					"default" => "#63b2f5"
					);	
	$options[] = array( "name" => "Color for the Pricing Table pricing-price",
					"type" => "color",
					"id" => "pricing_price_color",
					"std" => "#274472",
					"default" => "#274472"
					);	
	$options[] = array( "name" => "Color for the Pricing Text pricing-text",
					"type" => "color",
					"id" => "pricing_text_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);	
	$options[] = array( "name" => "Color for the Pricing Text background",
					"type" => "color",
					"id" => "pricing_text_bg_color",
					"std" => "#fafbfd",
					"default" => "#fafbfd"
					);	
	
	
	$options[] = array( "name" => "Background color for the Audio Progress",
					"type" => "color",
					"id" => "bg_audio_pr_color",
					"std" => "#324e79",
					"default" => "#324e79"
					);
	
	$options[] = array( "name" => "Background color for the Audio",
					"type" => "color",
					"id" => "bg_audio_color",
					"std" => "#274472",
					"default" => "#274472"
					);
					
	$options[] = array( "name" => "Border color for the Audio Progress",
					"type" => "color",
					"id" => "border_audio_pr_color",
					"std" => "#808ca4",
					"default" => "#808ca4"
					);
	
	
	$options[] = array( "name" => "Сolor for the Audio Text",
					"type" => "color",
					"id" => "bg_audio_text_color",
					"std" => "#97acc3",
					"default" => "#97acc3"
					);
					
	$options[] = array( "name" => "Background color for the Audio Button",
					"type" => "color",
					"id" => "bg_audio_btn_color",
					"std" => "#fff",
					"default" => "#fff"
					);
					
					
					
	$options[] = array( "name" => "Background color for the Media Button",
					"type" => "color",
					"id" => "bg_media_btn_color",
					"std" => "#101e33",
					"default" => "#101e33"
					);				
					
	
	$options[] = array( "name" => "Background color for the Media Button Twitter",
					"type" => "color",
					"id" => "twitter_bg_media_btn_color",
					"std" => "#55acee",
					"default" => "#55acee"
					);	

	$options[] = array( "name" => "Background color for the Media Button Facebook",
					"type" => "color",
					"id" => "facebook_bg_media_btn_color",
					"std" => "#3b5998",
					"default" => "#3b5998"
					);	
	
	$options[] = array( "name" => "Icon color for the Media Button",
					"type" => "color",
					"id" => "icon_media_btn_color",
					"std" => "#fff",
					"default" => "#fff"
					);					
	
	
	$options[] = array( "name" => "Price color",
					"type" => "color",
					"id" => "price_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);			
	
	
	$options[] = array( "name" => "Mobile Menu Text Color",
					"type" => "color",
					"id" => "mobile_text_color",
					"std" => "#1774A8",
					"default" => "#1774A8"
					);	
					
	$options[] = array( "name" => "Mobile Menu Icon Color",
					"type" => "color",
					"id" => "mobile_icon_color",
					"std" => "#444",
					"default" => "#444"
					);					
					
	$options[] = array( "name" => "Mobile Menu Icon Color Hover",
					"type" => "color",
					"id" => "mobile_icon_color_hover",
					"std" => "#fff",
					"default" => "#fff"
					);					
					
					
					
					
	$options[] = array( "name" => "Blog Date Color",
					"type" => "color",
					"id" => "blog_date_color",
					"std" => "#f2f4f9",
					"default" => "#f2f4f9"
					);	

	$options[] = array( "name" => "Events Date Color",
					"type" => "color",
					"id" => "events_date_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);	
				
				
	$options[] = array( "name" => "Increase/decrease Button Color",
					"type" => "color",
					"id" => "increase_button_color",
					"std" => "#808ca4",
					"default" => "#808ca4"
					);	
	$options[] = array( "name" => "Increase/decrease Button Background Color",
					"type" => "color",
					"id" => "increase_button_bg_color",
					"std" => "#e2eaf2",
					"default" => "#e2eaf2"
					);	
					
	////////////////////////////Header////////////////////////////////////////////////////////////////////////////////////////////	
		$options[] = array( "name" => "Header", "std" => "Header",
					"type" => "heading"
					);	

		$options[] = array( "name" => "Sticky Header",
					"type" => "radio",
					"id" => "show_sticky_header",
					"std" => get_option('sense_show_sticky_header'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);			
					
		
		$options[] = array( "name" => "Type Form",
					"type" => "select",
					"id" => "type_form_header",
					"std" => get_option('sense_type_form_header'),
					"options" => array(
						"mailchimp"=>"Mailchimp",
						"search"=>"Search",
						"events"=>"Events"
						)
					);		

		$options[] = array( "name" => "Event Post Id",
					"type" => "text",
					"id" => "header_event_id",
					"std" => get_option('sense_header_event_id')
					);
					
		$options[] = array( "name" => "Top Form",
					"type" => "radio",
					"id" => "show_topform",
					"std" => get_option('sense_show_topform'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);			
		
		$options[] = array( "name" => "Header Slogan",
					"type" => "radio",
					"id" => "show_slogan_top",
					"std" => get_option('sense_show_slogan_top'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);			
		
		
		$options[] = array( "name" => "Header Slogan Text",
					"type" => "textarea",
					"id" => "header_text",
					"std" => get_option('sense_header_text')
					);
		

		$options[] = array( "name" => "Show Breadcrumb",
					"type" => "radio",
					"id" => "show_breadcrumb",
					"std" => get_option('sense_show_breadcrumb'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);			
		
		
		
		$options[] = array( "name" => "Show Breadcrumb/Title",
					"type" => "radio",
					"id" => "show_breadcrumb_title",
					"std" => get_option('sense_show_breadcrumb_title'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);		
		
		
		
		
		/////////////////////////Typorgraphy//////////////////////////////////////////////////////////////////////////////////////////	
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
					"options" => get_font_size(15)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "basic_font",
					"std" => get_option('sense_basic_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "basic_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);
					
					
		$options[] = array( "name" => "Page Title",
					"type" => "select2",
					"id" => "page_title_styles",
					"std" => get_option('sense_page_title_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "size_page_title",
					"std" => get_option('sense_size_page_title'),
					"options" => get_font_size(30)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "page_title_font",
					"std" => get_option('sense_page_title_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "page_title_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);
		

		$options[] = array( "name" => "Page List",
					"type" => "select2",
					"id" => "page_list_styles",
					"std" => get_option('sense_page_list_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "page_list_size",
					"std" => get_option('sense_page_list_size'),
					"options" => get_font_size(15)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "page_list_font",
					"std" => get_option('sense_page_list_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "page_list_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);	


		$options[] = array( "name" => "Newsletter text",
					"type" => "select2",
					"id" => "page_newsletter_styles",
					"std" => get_option('sense_page_newsletter_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "page_newsletter_size",
					"std" => get_option('sense_page_newsletter_size'),
					"options" => get_font_size(14)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "page_newsletter_font",
					"std" => get_option('sense_page_newsletter_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "page_newsletter_font_color",
					"std" => "#e2eaf2",
					"default" => "#e2eaf2"
					);	

					
		
		$options[] = array( "name" => "Breadcrumb",
					"type" => "select2",
					"id" => "breadcrumb_styles",
					"std" => get_option('sense_breadcrumb_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "size_breadcrumb",
					"std" => get_option('sense_size_breadcrumb'),
					"options" => get_font_size(13)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "breadcrumb_font",
					"std" => get_option('sense_breadcrumb_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "breadcrumb_font_color",
					"std" => "#95999e",
					"default" => "#95999e"
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
					"options" => get_font_size(15)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "copyright_font",
					"std" => get_option('sense_copyright_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "copyright_font_color",
					"std" => "#808ca4",
					"default" => "#808ca4"
					);



		$options[] = array( "name" => "Sidebar Banner Style1 Titles",
					"type" => "select2",
					"id" => "banner1_sidebar_titles_styles",
					"std" => get_option('sense_banner1_sidebar_titles_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "banner1_sidebar_titles_size",
					"std" => get_option('sense_banner1_sidebar_titles_size'),
					"options" => get_font_size(18)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "banner1_sidebar_titles_font",
					"std" => get_option('sense_banner1_sidebar_titles_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "banner1_sidebar_titles_font_color",
					"std" => "#274472",
					"default" => "#274472"
					);

					
		$options[] = array( "name" => "Sidebar Banner Style2 Titles",
					"type" => "select2",
					"id" => "banner2_sidebar_titles_styles",
					"std" => get_option('sense_banner2_sidebar_titles_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "banner2_sidebar_titles_size",
					"std" => get_option('sense_banner2_sidebar_titles_size'),
					"options" => get_font_size(24)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "banner2_sidebar_titles_font",
					"std" => get_option('sense_banner2_sidebar_titles_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "banner2_sidebar_titles_font_color",
					"std" => "#274472",
					"default" => "#274472"
					);
			
		
		$options[] = array( "name" => "Sidebar Banner Text",
					"type" => "select2",
					"id" => "banner1_sidebar_text_styles",
					"std" => get_option('sense_banner1_sidebar_text_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "banner1_sidebar_text_size",
					"std" => get_option('sense_banner1_sidebar_text_size'),
					"options" => get_font_size(15)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "banner1_sidebar_text_font",
					"std" => get_option('sense_banner1_sidebar_text_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "banner1_sidebar_text_font_color",
					"std" => "#808ca4",
					"default" => "#808ca4"
					);


		

		$options[] = array( "name" => "Sidebar Widget Titles",
					"type" => "select2",
					"id" => "sidebar_titles_styles",
					"std" => get_option('sense_sidebar_titles_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "sidebar_titles_size",
					"std" => get_option('sense_sidebar_titles_size'),
					"options" => get_font_size(18)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "sidebar_titles_font",
					"std" => get_option('sense_sidebar_titles_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "sidebar_titles_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);

					
					
					
		$options[] = array( "name" => "Footer Widget Titles",
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
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "footer_titles_font_color",
					"std" => "#e2eaf2",
					"default" => "#e2eaf2"
					);			
			



		$options[] = array( "name" => "Footer List",
					"type" => "select2",
					"id" => "footer_list_styles",
					"std" => get_option('sense_footer_list_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "footer_list_size",
					"std" => get_option('sense_footer_list_size'),
					"options" => get_font_size(15)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "footer_list_font",
					"std" => get_option('sense_footer_list_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "footer_list_font_color",
					"std" => "#e2eaf2",
					"default" => "#e2eaf2"
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
					"options" => get_font_size(14)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "header_text_font",
					"std" => get_option('sense_header_text_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "header_text_font_color",
					"std" => "#97acc3",
					"default" => "#97acc3"
					);

					
					
					
		$options[] = array( "name" => "Post Day Text",
					"type" => "select2",
					"id" => "post_day_styles",
					"std" => get_option('sense_post_day_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "post_day_size",
					"std" => get_option('sense_post_day_size'),
					"options" => get_font_size(36)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "post_day_font",
					"std" => get_option('sense_post_day_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "post_day_font_color",
					"std" => "#95999e",
					"default" => "#95999e"
					);						
					
					
		$options[] = array( "name" => "Post Month Text",
					"type" => "select2",
					"id" => "post_month_styles",
					"std" => get_option('sense_post_month_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "post_month_size",
					"std" => get_option('sense_post_month_size'),
					"options" => get_font_size(18)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "post_month_font",
					"std" => get_option('sense_post_month_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "post_month_font_color",
					"std" => "#95999e",
					"default" => "#95999e"
					);						
					
					
					
					
					
					
					
					
					
					
					
		$options[] = array( "name" => "Small Text (post author, category, etc.)",
					"type" => "select2",
					"id" => "small_text_styles",
					"std" => get_option('sense_small_text_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "small_text_size",
					"std" => get_option('sense_small_text_size'),
					"options" => get_font_size(13)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "small_text_font",
					"std" => get_option('sense_small_text_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "small_text_font_color",
					"std" => "#95999e",
					"default" => "#95999e"
					);

			
		$options[] = array( "name" => "Menu Text",
					"type" => "select2",
					"id" => "menu_styles",
					"std" => get_option('sense_menu_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "menu_size",
					"std" => get_option('sense_menu_size'),
					"options" => get_font_size(16)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "menu_font",
					"std" => get_option('sense_menu_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "menu_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);

			
		
		$options[] = array( "name" => "Submenu Text",
					"type" => "select2",
					"id" => "submenu_styles",
					"std" => get_option('sense_submenu_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "submenu_size",
					"std" => get_option('sense_submenu_size'),
					"options" => get_font_size(15)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "submenu_font",
					"std" => get_option('sense_submenu_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "submenu_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);


		$options[] = array( "name" => "Issue Title",
					"type" => "select2",
					"id" => "issue_styles",
					"std" => get_option('sense_issue_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "issue_size",
					"std" => get_option('sense_issue_size'),
					"options" => get_font_size(18)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "issue_font",
					"std" => get_option('sense_issue_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "issue_font_color",
					"std" => "#4174c5",
					"default" => "#4174c5"
					);
		
		
		
		
		
		$options[] = array( "name" => "Statistic Number",
					"type" => "select2",
					"id" => "stat_styles",
					"std" => get_option('sense_stat_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "stat_size",
					"std" => get_option('sense_stat_size'),
					"options" => get_font_size(48)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "stat_font",
					"std" => get_option('sense_stat_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "stat_font_color",
					"std" => "#fff",
					"default" => "#fff"
					);
		
		
		
		$options[] = array( "name" => "Statistic Title",
					"type" => "select2",
					"id" => "stat_title_styles",
					"std" => get_option('sense_stat_title_styles'),
					"options" => get_styles('normal')
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "stat_title_size",
					"std" => get_option('sense_stat_title_size'),
					"options" => get_font_size(13)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "stat_title_font",
					"std" => get_option('sense_stat_title_font'),
					"options" => get_fonts('Arimo')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "stat_title_font_color",
					"std" => "#fff",
					"default" => "#fff"
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
					"options" => get_font_size(30)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h1_font",
					"std" => get_option('sense_h1_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h1_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
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
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h2_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
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
					"options" => get_font_size(18)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h3_font",
					"std" => get_option('sense_h3_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h3_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
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
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h4_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
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
					"options" => get_font_size(18)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h5_font",
					"std" => get_option('sense_h5_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h5_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
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
					"options" => get_font_size(16)
					);
		$options[] = array( "name" => "",
					"type" => "select3",
					"id" => "h6_font",
					"std" => get_option('sense_h6_font'),
					"options" => get_fonts('Open Sans')
					);
		$options[] = array( "name" => "",
					"type" => "color",
					"id" => "h6_font_color",
					"std" => "#3e474c",
					"default" => "#3e474c"
					);
		
					


////////////////////////portfolio///////////////////////////////////////////////////////////////////////////////////////////////////////////////			
		$options[] = array( "name" => "Portfolio", "std" => "Portfolio",
					"type" => "heading");
		
		$options[] = array( "name" => "All Projects URL",
					"type" => "text",
					"id" => "projects_url",
					"std" => get_option('sense_projects_url')
					);	

		$options[] = array( "name" => "Number Projects",
					"type" => "text",
					"id" => "projects_num",
					"std" => get_option('sense_projects_num')
					);	

		$options[] = array( "name" => "Number Projects(Template 4 columns)",
					"type" => "text",
					"id" => "projects_num4",
					"std" => get_option('sense_projects_num4')
					);	

		$options[] = array( "name" => "Show Media Share",
					"type" => "radio",
					"id" => "show_share_madia",
					"std" => get_option('sense_show_share_madia'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);	

////////////////////////testimonials///////////////////////////////////////////////////////////////////////////////////////////////////////////////			
		$options[] = array( "name" => "Testimonials", "std" => "Testimonials",
					"type" => "heading");
		
		$options[] = array( "name" => "Testimonials Title",
					"type" => "text",
					"id" => "testimonials_title",
					"std" => get_option('sense_testimonials_title')
					);	

		$options[] = array( "name" => "Number Testimonials",
					"type" => "text",
					"id" => "testimonials_num",
					"std" => get_option('sense_testimonials_num')
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
			
		
					
					
		////////////////////////////shop/////////////////////////////////////////////////////////////////////////////////////////			
		$options[] = array( "name" => "shop", "std" => "Shop",
					"type" => "heading");
		
	
		
		// $options[] = array( "name" => "Sidebar Category Position",
					// "type" => "select",
					// "id" => "sidebar_cat",
					// "std" => get_option('sense_sidebar_cat'),
					// "options" => array(
						// "left"=>"Left",
						// "right"=>"Right"
						// )
					// );	
				
		$options[] = array( "name" => "Sidebar Position",
					"type" => "select",
					"id" => "settings_sidebar_shop",
					"std" => get_option('sense_settings_sidebar_shop'),
					"options" => array(
						"full"=>"None",
						"left"=>"Left",
						"right"=>"Right"
						)
					);
		
		$options[] = array( "name" => "Number Products",
					"type" => "text",
					"id" => "num_product",
					"std" => get_option('sense_num_product')
					);	
		
		
		
		
		////////////////////////////post/////////////////////////////////////////////////////////////////////////////////////////			
		$options[] = array( "name" => "post", "std" => "Post",
					"type" => "heading");
		
			
		
		$options[] = array( "name" => "Read More Text",
					"type" => "text",
					"id" => "more_text",
					"id" => "more_text",
					"std" => get_option('sense_more_text')
					);	
		
		
		
		$options[] = array( "name" => "Show Author Post(single)",
					"type" => "radio",
					"id" => "show_author_single",
					"std" => get_option('sense_show_author_single'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);	
					
		$options[] = array( "name" => "Related Posts(single)",
					"type" => "radio",
					"id" => "show_single_related",
					"std" => get_option('sense_show_single_related'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);					
					
		$options[] = array( "name" => "Show Author Post Related(single)",
					"type" => "radio",
					"id" => "show_author_single_related",
					"std" => get_option('sense_show_author_single_related'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);				
					
		
		
		
		

		$options[] = array( "name" => "Show Share Link(single)",
					"type" => "radio",
					"id" => "show_share_single",
					"std" => get_option('sense_show_share_single'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);	

		$options[] = array( "name" => "Show Share facebook(single)",
					"type" => "radio",
					"id" => "show_share_facebook_single",
					"std" => get_option('sense_show_share_facebook_single'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);	


$options[] = array( "name" => "Show Share twitter(single)",
					"type" => "radio",
					"id" => "show_share_twitter_single",
					"std" => get_option('sense_show_share_twitter_single'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);	


$options[] = array( "name" => "Show Share google(single)",
					"type" => "radio",
					"id" => "show_share_google_single",
					"std" => get_option('sense_show_share_google_single'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);	


$options[] = array( "name" => "Show Share pinterest(single)",
					"type" => "radio",
					"id" => "show_share_pinterest_single",
					"std" => get_option('sense_show_share_pinterest_single'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);	

$options[] = array( "name" => "Show Share email(single)",
					"type" => "radio",
					"id" => "show_share_email_single",
					"std" => get_option('sense_show_share_email_single'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);	

$options[] = array( "name" => "Show Share LinkedIn(single)",
					"type" => "radio",
					"id" => "show_share_linkedin_single",
					"std" => get_option('sense_show_share_linkedin_single'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);	


$options[] = array( "name" => "Show Share Reddit(single)",
					"type" => "radio",
					"id" => "show_share_reddit_single",
					"std" => get_option('sense_show_share_reddit_single'),
					"options" => array(
						"_show"=>"Show",
						"_hide"=>"Hide"
						)
					);	






		
					
					
					
					
		$options[] = array( "name" => "Sidebar on default blog(index)",
					"type" => "select",
					"id" => "settings_sidebar_blog",
					"std" => get_option('sense_settings_sidebar_blog'),
					"options" => array(
						"full"=>"None",
						"left"=>"Left",
						"right"=>"Right"
						)
					);
		
		
		$options[] = array( "name" => "Sidebar on archive page",
					"type" => "select",
					"id" => "settings_sidebar_category",
					"std" => get_option('sense_settings_sidebar_category'),
					"options" => array(
						"full"=>"None",
						"left"=>"Left",
						"right"=>"Right"
						)
					);
					
					
		$options[] = array( "name" => "Style category page",
					"type" => "select",
					"id" => "settings_category_blog",
					"std" => get_option('sense_settings_category_blog'),
					"options" => array(
						"style1"=>"Style 1",
						"style2"=>"Style 2"
						)
					);			
					
		////////////////////////////footer/////////////////////////////////////////////////////////////////////////////////////////			
		$options[] = array( "name" => "footer", "std" => "Footer",
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
					
					
			
					
		$options[] = array( "name" => "Footer Text",
					"type" => "textarea",
					"id" => "footer_text",
					"std" => get_option('sense_footer_text')
					);
					
					
					
					
		$options[] = array( "name" => "Show Footer Social Button",
					"type" => "radio",
					"id" => "show_footer_soc",
					"std" => get_option('sense_show_footer_soc'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);				
						
			$options[] = array( "name" => "Facebook URL Link",
					"type" => "text",
					"id" => "footer_url1",
					"std" => get_option('sense_footer_url1')
					);

			$options[] = array( "name" => "Twitter URL Link",
					"type" => "text",
					"id" => "footer_url2",
					"std" => get_option('sense_footer_url2')
					);

			$options[] = array( "name" => "Google Plus URL Link",
					"type" => "text",
					"id" => "footer_url3",
					"std" => get_option('sense_footer_url3')
					);

			$options[] = array( "name" => "Youtube URL Link",
					"type" => "text",
					"id" => "footer_url4",
					"std" => get_option('sense_footer_url4')
					);

			$options[] = array( "name" => "Flickr URL Link",
					"type" => "text",
					"id" => "footer_url5",
					"std" => get_option('sense_footer_url5')
					);

			$options[] = array( "name" => "Email URL Link",
					"type" => "text",
					"id" => "footer_url6",
					"std" => get_option('sense_footer_url6')
					);

					
			$options[] = array( "name" => "LinkedIn URL Link",
					"type" => "text",
					"id" => "footer_url7",
					"std" => get_option('sense_footer_url7')
					);
		
			$options[] = array( "name" => "Instagram URL Link",
					"type" => "text",
					"id" => "footer_url8",
					"std" => get_option('sense_footer_url8')
					);
		
			$options[] = array( "name" => "Reddit URL Link",
					"type" => "text",
					"id" => "footer_url9",
					"std" => get_option('sense_footer_url9')
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
			    <li class="option-portfolio"><a href="#option-portfolio" title="Portfolio">Portfolio</a></li>
			    <li class="option-testimonials"><a href="#option-testimonials" title="Testimonials">Testimonials</a></li>
			    <li class="option-post"><a href="#option-post" title="Post">Post</a></li>
				<li class="option-404"><a href="#option-404" title="404">404</a></li>
                <li class="option-shop"><a href="#option-shop" title="shop">Shop</a></li>
                <li class="option-header"><a href="#option-header" title="header">Header</a></li>
                <li class="option-footer"><a href="#option-footer" title="footer">Footer</a></li>
			</ul>
		</nav><!--/ .admin-nav-->
		
		<div id="save_status"><?php _e( 'Please save your changes', 'candidate' ) ?></div>
		<div id="save_window">
			<?php _e( 'You successfully saved your changes!', 'candidate' ) ?>
		</div>
		
	</aside><!--/ .admin-aside-->
	
	<section class="admin-content">
		<div class="heading-holder clearfix">
			
			<h3 class="heading-title"><?php _e( 'Theme Options', 'candidate' ) ?></h3>

			<ul class="optional-links">
				<li class="publish-to"><a href="#"><?php _e( 'Save All Changes', 'candidate' ) ?></a></li>
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
			$output .= '<div class="'.$value['container'].'">';
		} 
		if($value['type']!='heading'  && $value['type']!='select3' ){
			$output .= '<h5 class="title">'.$value['name'].'</h5>';
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
								<span class="soc_name">'. $value['name'] .'</span>
								<div class="sense_upload_block">
										<input class="sense_upload_url" type="hidden" id="'. $value['name'] .'" name="'. $value['name'] .'" value="'. $value['icon'] .'" />
										<a id="upload_'. $value['name'] .'_button" class="button sense_upload_image_button add-field">Upload Image</a>
										<a id="delete_'. $value['name'] .'_button" class="hide button sense_delete_image_button remove-field">Delete Image</a>
										<div class="image_preview"><img alt="" src="'.$value['icon'].'" />
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
								<input class="soc_url" value="'. $value['url'] .'"/>
								<div class="sense_upload_block">
										<input class="sense_upload_url" type="hidden" id="'. $value['name'] .'" name="'. $value['name'] .'" value="'. $value['icon'] .'" />
										<a id="upload_'. $value['name'] .'_button" class="button sense_upload_image_button add-field">Upload Image</a>
										<a id="delete_'. $value['name'] .'_button" class="hide button sense_delete_image_button remove-field">Delete Image</a>
										<div class="image_preview"><img alt="" src="'.$value['icon'].'" />
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
			$output .= '<input class="form_input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" /><br/>';
		break;
		case 'select':
			$output .= '<select class="form_select" name="'. $value['id'] .'" id="'. $value['id'] .'">';
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
			$output .= '   <select class="form_select" name="'. $value['id'] .'" id="'. $value['id'] .'">';
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
			$output .= '   <select class="form_select" name="'. $value['id'] .'" id="'. $value['id'] .'">';
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
			$output .= '<select class="form_select_pattern" name="'. $value['id'] .'" id="'. $value['id'] .'">';
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
			$output .= '<select class="form_select_color" name="'. $value['id'] .'" id="'. $value['id'] .'">';
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
			$output .='<div class="radio '.$value['id'].'">';
			 $select_value = get_option( $value['id']);
			 foreach ($value['options'] as $key => $option) { 
				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .='<label class="'.$key.'" ><input class="of-input of-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'</label>';
			}
			$output .='</div>';
		break;
		

		case 'button':
			$output = '<a id="'.$value['id'].'">'.$value['name'].'</a>';
		break;
		case 'other_text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<textarea name="'. $value['id'] .'" id="'. $value['id'] .'">'.stripslashes($val).'</textarea><br/>';
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
				$output .='<label><input class="of-input of-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'</label>';
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
			$output .= '<input type="checkbox" class="checkbox form_check" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />'.$value['name'].'<br/>';

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
			<input name="'. $value['id'] .'" type="text" id="'. $value['id'] .'" value="'. $val .'" data-default-color="'. $def .'">';
			
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
			$menu .= '<li class="'.$jquery_click_hook.'" ><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="container">'."\n";
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><div class="sub-heading clearfix"><h4 class="sub-heading-title">'.$value['std'].'</h4></div><div class="main-holder clearfix">'."\n";
			
		break;
		
		case "breaking_list":
			global $post;
		
			$args = array('numberposts'=> -1);
			$myposts = get_posts($args);
			$output = '<ul class="breaking_news">';
			foreach( $myposts as $post ) : setup_postdata($post);
				if(get_meta_option('breaking_news') == 'true')
				{
					$output .= '<li class="list_item"><a href="'.get_edit_post_link().'">'.get_the_title().'</a></li>';
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
					$output .= '<li class="list_item"><a href="'.get_edit_post_link().'">'.get_the_title().'</a></li>';
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
					$output .= '<li class="list_item"><a href="'.get_edit_post_link().'">'.get_the_title().'</a></li>';
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
	    	<input class="sense_upload_url" type="hidden" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $std; ?>" />
			<a id="upload_<?php echo $id; ?>_button" class="button sense_upload_image_button add-field">Upload Image</a>
			<?php if ( $std!='' ): ?>
				<?php $img = '<img alt="" src="'.$std.'" />';
					  $hidden_class = '';
				?>
			<?php endif; ?>
			<a id="delete_<?php echo $id; ?>_button" class="<?php echo $hidden_class; ?>button sense_delete_image_button remove-field">Delete Image</a>
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
	"Amiri"=>"Amiri",
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
	"Fira Sans"=>"Fira Sans",
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
	"Lato"=>"Lato",
	"Lateef"=>"Lateef",
	"Lancelot"=>"Lancelot",
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
	"Oxygen"=>"Oxygen",
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
	"Roboto"=>"Roboto",
	"Roboto Slab"=>"Roboto Slab",
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
	"Scheherazade"=>"Scheherazade",
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
);}




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
);}


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
			);}


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