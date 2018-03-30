<?php
$alt_slider = array('Slidershow','Accordion Slider');

$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
	if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
		while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
			if(stristr($alt_stylesheet_file, ".css") !== false) {
				$alt_stylesheets[] = $alt_stylesheet_file;
			}
		}	
	}
}

// Get the style path currently selected
function themeteam_style_path() {

	$style = $_REQUEST[style];
	
	if ($style != '') {

		$style_path = $style;

	} else {
		
		$stylesheet = get_option('themeteam_alt_stylesheet');
		$style_path = str_replace(".css","",$stylesheet);
	
	}
	
	echo 'styles/'.$style_path;
	
}

// Image Alignment radio box
$options_message_type = array("testimonials" => "Testimonials","twitter" => "Twitter","individualmessage" => "Individual Message","nomessage" => "Do not display message"); 
$options_message_layout = array("single" => "Single message with button","none" => "None"); 
$options_featured_layout = array("postsandrecent" => "2 Sticky Posts and Recent Posts","3featured" => "3 Sticky Posts","4featured" => "4 Sticky Posts", "none" => "Display None","custom" => "Custom Content");
$options_footer_layout = array("default" => "Default Predefined Style", "custom" => "Custom Content");
$options_slider_layout = array("full_image" => "Theme Team Full Image Slider", "normal_width" => "Normal Width Slider","nivo" => "Nivo Slider - Images Only");

$options_cufon = array(
	"Aller.font.js" => "Aller Light",
	"Andika.font.js" => "Andika Basic",
	"Bebas.font.js" => "Bebas Neue",
	"Caviar_Dreams-Bold.font.js" => "Caviar Dreams",
	"Caviar_Dreams.font.js" => "Caviar Dreams-Bold",
	"Colaborate.font.js" => "ColaborateLight",
	"Colaborate-Bold.font.js" => "Colaborate-Bold",
	"Delicious.font.js" => "Delicious",
	"Delicious-Bold.font.js" => "Delicious-Bold",
	"Geosans.font.js" => "GeosansLight",
	"Lane-Narrow.js" => "Lane - Narrow",
	"Lobster.font.js" => "Lobster 1.3",
	"League_Gothic.font.js" => "League Gothic",
	"Mido.font.js" => "Mido",
	"Miso.font.js" => "Miso",
	"PT_Sans.font.js" => "PT Sans",
	"PT_Sans-Bold.font.js" => "PT Sans-Bold",
	"Sansation.font.js" => "Sansation",
	"Sansation-Bold.font.js" => "Sansation-Bold",
	"Segan.font.js" => "Segan",
	"Tallys.font.js" => "Tallys",
	"Yanone_Kaffeesatz.font.js" => "Yanone Kaffeesatz",
	"Yanone_Kaffeesatz-Bold.font.js" => "Yanone Kaffeesatz-Bold"  
);
$options_enable_cufon = array("yes" => "Yes", "no" => "No");
$options_enable_tabbed_area = array("yes" => "Yes", "no" => "No");
$options_button_color = array(
	"default" => "default",
	"slateblue" => "Slate Blue",
	"camel" => "Camel",
	"coffee" => "Coffee",
	"darkgreen" => "Dark Green",
	"darkred" => "Dark Red",
	"darkpurple" => "Dark Purple",
	"green" => "Green",
	"darkyellow" => "Dark Yellow",
	"lightblue" => "Light Blue",
	"lightgreen" => "Light Green",
	"ochre" => "Ochre",
	"blue" => "Blue",
	"greymetal" => "Greymetal",
	"skyblue" => "Sky Blue",
	"grey" => "Grey",
	"red" => "Red",
	"yellow" => "Yellow",
	"purple" => "Purple"
);
$options_bg_tile = array(
	"bg_checkerboard.png" => "Checkerboard",
	"bg_film.png" => "Film",
	"bg_fractures.png" => "Fractures",
	"bg_tartan_bold.png" => "Tartan Bold",
	"bg_tartan_light.png" => "Tartan Light",
	"bg_vertical_waves.png" => "Vertical Waves",
	"bg_wainscoating.png" => "Wainscoating",
	"bg_wood_paneling.png" => "Wood Paneling",
	"bg_wood.png" => "Wood"	
);

//set up options
$options[] = array(	"name" => "General Options",
					"type" => "heading");
					
$options[] = array(	"name" => "Custom Logo",
					"desc" => "Enter a URL or upload an image for the banner.",
					"id" => "themeteam_logo_upload",
					"std" => "",
					"css" => "normal",
					"type" => "logo_upload");					

$options[] = array("name" => "Enable Breadcrumbs",
					"id" => $shortname."_enable_breadcrumbs",
					"std" => "yes",
					"type" => "radio",
					"css" => "normal",
					"options" => array("true" => 'Yes', 'false' => 'No'));

$options[] = array( "name" => "Common Button Color",
					"desc" => "Select the Common Button Color.",
					"id" => $shortname."_button_color",
					"std" => "",
					"type" => "select",
					"css" => "normal",
					"options" => $options_button_color);

$options[] = array(	"name" => "BG Color",
					"type" => "subsection");

$options[] = array(	"name" => "Enable Default BG",
					"id" => $shortname."_custom_bg",
					"std" => "",
					"options" => array("bg_default" => 'Enable'),
					"css" => "normal",
					"type" => "radio");

$options[] = array(	"name" => "Enable Custom BG Color",
					"id" => $shortname."_custom_bg",
					"std" => "",
					"options" => array("bg_color" => 'Enable'),
					"css" => "none",
					"type" => "radio");

$options[] = array(	"name" => "Background Color",
					"id" => $shortname."_color_bg",
					"std" => "",
					"css" => "normal",
					"type" => "colorpicker");					

$options[] = array(	"name" => "Enable Custom BG Tiled Image",
					"id" => $shortname."_custom_bg",
					"std" => "",
					"options" => array("bg_tile" => 'Enable'),
					"css" => "none",
					"type" => "radio");

$options[] = array( "name" => "Pattern Image",
					"desc" => "Select the Pattern Image.",
					"id" => $shortname."_pattern_bg",
					"std" => "bg_wood.png",
					"type" => "select",
					"css" => "normal",
					"options" => $options_bg_tile);

$options[] = array(	"name" => "Pattern BG Color",
					"id" => $shortname."_full_color_bg",
					"std" => "",
					"desc" => "Pick the color to display under the patterned background.",
					"css" => "normal",
					"type" => "colorpicker");
					
/*$options[] = array(	"name" => "Color Picker 1",
					"desc" => "select the color",
					"id" => $shortname."_color_picker_1",
					"std" => "",
					"type" => "colorpicker");
$options[] = array(	"name" => "Color Picker 2",
					"desc" => "select the color",
					"id" => $shortname."_color_picker_2",
					"std" => "",
					"type" => "colorpicker");
*/
$options[] = array(	"name" => "Other Options",
					"type" => "subsection");
					
$options[] = array(	"name" => "Google Analytics",
					"desc" => "Please paste your Google Analytics (or other) tracking code here.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"css" => "normal",
					"type" => "textarea");

$options[] = array(	"name" => "Contact Email",
					"desc" => "Enter the Email Address that you would like to use to receive contact us emails",
					"id" => $shortname."_email_contact",
					"std" => "test@test.com",
					"css" => "normal",
					"type" => "text");					
					
$options[] = array(	"name" => "Homepage Options",
					"type" => "heading");

$options[] = array( "name" => "Select Slider Type",
					"desc" => "Select the Slider Type.",
					"id" => $shortname."_featured_slider_type",
					"std" => "normal_width",
					"type" => "select",
					"css" => "normal",
					"options" => $options_slider_layout);

$options[] = array( "name" => "Select Pages",
					"desc" => "Select the pages you would like to display in the slider.",
					"id" => $shortname."_featured_slider_ids",
					"std" => null,
					"css" => "normal",
					"type" => "checkboxselect");
					
$options[] = array(	"name" => "Featured Slider Pages",
					"desc" => "Enter a comma seperated list of the page id's that you would like to display in the slider",
					"id" => $shortname."_featured_slider_ids",
					"std" => "",
					"css" => "normal",
					"type" => "text");

$options[] = array(	"name" => "Message Box",
					"type" => "subsection");

$options[] = array( "name" => "Message Layout",
					"desc" => "Select Which message layout to display on front page.",
					"id" => $shortname."_message_layout",
					"std" => "",
					"type" => "radio",
					"css" => "normal",
					"options" => $options_message_layout); 

$options[] = array(	"name" => "Message",
					"desc" => "If you chose Single Message enter message here.",
					"id" => $shortname."_individual_message_text",
					"css" => "normal",
					"type" => "textarea");

$options[] = array(	"name" => "Message Button Text",
					"desc" => "If you chose Single Message enter Button text here.",
					"id" => $shortname."_individual_button_text",
					"css" => "normal",
					"type" => "text");
					
$options[] = array(	"name" => "Message Button Link",
					"desc" => "If you chose Single Message enter Link here.",
					"id" => $shortname."_individual_link",
					"css" => "normal",
					"type" => "text");						

$options[] = array(	"name" => "Twitter Area",
					"type" => "subsection");
					
$options[] = array(	"name" => "Twitter Name",
					"desc" => "If you chose Twitter enter Twitter name here.",
					"id" => $shortname."_twitter_message",
					"css" => "normal",
					"type" => "text");
					
/*$options[] = array(	"name" => "Twitter Limit",
					"desc" => "If you chose Twitter enter Twitter limit here.",
					"id" => $shortname."_twitter_limit",
					"std" => "5",
					"css" => "normal",
					"type" => "text");*/
$options[] = array(	"name" => "Tabbed Category Listing Area",
					"type" => "subsection");					

$options[] = array( "name" => "Tabbed Area - Disable/Enable",
					"desc" => "Select weather to enable or disable this area.",
					"id" => $shortname."_tabbed_area",
					"std" => "yes",
					"type" => "radio",
					"css" => "normal",
					"options" => $options_enable_tabbed_area); 
					
$options[] = array(	"name" => "Featured Posts Area",
					"type" => "subsection");

$options[] = array( "name" => "Featured Posts Layout",
					"desc" => "Select Which Featured Posts layout to display on front page.",
					"id" => $shortname."_featured_layout",
					"std" => "postsandrecent",
					"type" => "radio",
					"css" => "normal",
					"options" => $options_featured_layout);					

$options[] = array(	"name" => "Custom Content",
					"desc" => "If you chose Custom Content enter content here.",
					"id" => $shortname."_custom_content",
					"type" => "editor");
																				
$options[] = array(	"name" => "Footer Options",
					"type" => "heading"); 

$options[] = array(	"name" => "Footer Link 1 Text",
					"desc" => "Enter the text for the footer link here.",
					"id" => $shortname."_footer1_header",
					"std" => "Privacy Statement",
					"css" => "normal",
					"type" => "text");

$options[] = array(	"name" => "Footer Link 1 URL ",
					"desc" => "Enter the URL for the footer link here.",
					"id" => $shortname."_footer1_url",
					"std" => "",
					"css" => "normal",
					"type" => "text");
						
$options[] = array(	"name" => "Footer Link 2 Text",
					"desc" => "Enter the text for the footer link here.",
					"id" => $shortname."_footer2_header",
					"std" => "Terms & Conditions",
					"css" => "normal",
					"type" => "text");

$options[] = array(	"name" => "Footer Link 2 URL ",
					"desc" => "Enter the URL for the footer link here.",
					"id" => $shortname."_footer2_url",
					"std" => "",
					"css" => "normal",
					"type" => "text");

$options[] = array(	"name" => "Copyright",
					"desc" => "Enter the Copyright date and copyright holder name. Copyright symbol, &#169; will be added automatically",
					"id" => $shortname."_copyright",
					"std" => "2010",
					"css" => "normal",
					"type" => "text");

$options[] = array(	"name" => "Font Color Options",
					"type" => "heading");

$options[] = array(	"name" => "Logo and Navigation Font colors",
					"type" => "subsection");
										
$options[] = array(	"name" => "Logo Text Color",
					"id" => $shortname."_logo_font",
					"std" => "",
					"desc" => "Pick the color of the Logo Text.",
					"css" => "normal",
					"type" => "colorpicker");					

$options[] = array(	"name" => "Navigation Text Color",
					"id" => $shortname."_navigation_font",
					"std" => "",
					"desc" => "Pick the color of the Navigation Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Navigation Title Text Color",
					"id" => $shortname."_navigation_title_font",
					"std" => "",
					"desc" => "Pick the color of the Navigation Title Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Navigation Title Hover Text Color",
					"id" => $shortname."_navigation_title_hover_font",
					"std" => "",
					"desc" => "Pick the color of the Navigation Hover Title Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Navigation Hover Text Color",
					"id" => $shortname."_navigation_hover_font",
					"std" => "",
					"desc" => "Pick the color of the Navigation Hover Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Slider Content Font colors",
					"type" => "subsection");
					
$options[] = array(	"name" => "Slider Content Header Text Color",
					"id" => $shortname."_slider_content_header_font",
					"std" => "",
					"desc" => "Pick the color of the Slider Content Header Text.",
					"css" => "normal",
					"type" => "colorpicker");
					
$options[] = array(	"name" => "Slider Content Text Color",
					"id" => $shortname."_slider_content_font",
					"std" => "",
					"desc" => "Pick the color of the Slider Content Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Message Font colors",
					"type" => "subsection");

$options[] = array(	"name" => "Homepage Meassage Text Color",
					"id" => $shortname."_message_font",
					"std" => "",
					"desc" => "Pick the color of the Homepage Meassage Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Footer Font colors",
					"type" => "subsection");

$options[] = array(	"name" => "Footer Text Color",
					"id" => $shortname."_footer_font",
					"std" => "",
					"desc" => "Pick the color of the Footer Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Footer Link Text Color",
					"id" => $shortname."_footer_link_font",
					"std" => "",
					"desc" => "Pick the color of the Footer Link Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Subpage Title Font colors",
					"type" => "subsection");

$options[] = array(	"name" => "Subpage Title Text Color",
					"id" => $shortname."_subpage_title_font",
					"std" => "",
					"desc" => "Pick the color of the Footer Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Breadcrumbs Font colors",
					"type" => "subsection");

$options[] = array(	"name" => "Breadcrumbs Text Color",
					"id" => $shortname."_breadcrumbs_font",
					"std" => "",
					"desc" => "Pick the color of the Breadcrumbs Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Breadcrumbs Link Text Color",
					"id" => $shortname."_breadcrumbs_link_font",
					"std" => "",
					"desc" => "Pick the color of the Breadcrumbs Link Text.",
					"css" => "normal",
					"type" => "colorpicker");

$options[] = array(	"name" => "Cufon Options",
					"type" => "heading");

$options[] = array( "name" => "Enable Cufon Font Replacement",
				   	"desc" => "Cufon replacement will effect h1,h2,h3,h4,h5,h6 and menu items",
				   	"id" =>  $shortname."_enable_cufon",
				   	"type" => "radio",
				   	"std" => "no",
				   	"css" => "normal",
				   	"options" => $options_enable_cufon
				  );

$options[] = array( "name" => "Select Cufon Font",
					"desc" => "Select the Cufon font you would like to use on the site.",
					"id" => $shortname."_cufon_font",
					"std" => null,
					"type" => "radio_ibutton",
					"css" => "normal",
					"options" => $options_cufon);
?>