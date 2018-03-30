<?php
/*===================================================================================================================
=============================================== General Settings ====================================================
=================================================================================================================== */
$options1 = array(array());

$options1[] = array("id" => "tmoption_logo_image",
					"label" => "Logo Image",
					"type" => "upload",
					"description" => "Upload Your Logo.");				
$options1[] = array("id" => "tmoption_logo_image_alt",
					"label" => "Logo Image Alt",
					"type" => "textbox",
					"description" => "Define logo image alt here.");
$options1[] = array("id" => "tmoption_showsite_description",
					"label" => "Show Site Description?",
					"type" => "select",
					"description" => "Display Site Description or Not.",
					"options" => array('no' => 'No','yes' => 'Yes'));
$options1[] = array("id" => "tmoption_favicon_icon",
					"label" => "Favicon Icon",
					"type" => "upload-1",
					"description" => "Define favicon icon path here.");

$options1[] = array("id" => "tmoption_contact_email",
					"label" => "Contact Email",
					"type" => "textbox",
					"description" => "Email ID where to receive contact emails.");
					
$options1[] = array("id" => "tmoption_control_panel",
					"label" => "Show Control Panel?",
					"type" => "select",
					"description" => "Enable or Disable Control Panel.",
					"options" => array('no' => 'No','yes' => 'Yes'));
					
$options1[] = array("id" => "tmoption_responsive",
				  "label" => "Do you want Responsive Design?",
				  "type" => "select",
				  "description" => "Enable or Disable Responsive Design.",
				  "options" => array('yes' => 'Yes','no' => 'No'));
		
$options1[] = array("id" => "tmoption_navigation_option",
					"label" => "Pagination",
					"type" => "select",
					"description" => "Choose the Pagination Option For Theme.",
					"options" => array('1' => 'Default','2' => 'Numbering'));	
					
$options1[] = array("id" => "tmoption_google_analytics_id",
					"label" => "Google Analytic ID",
					"type" => "textbox",
					"description" => "Google Analytic ID (e.g UA-8934430-55 ), If Provide then it will enable Google Analytics.");
									
$options1[] = array("label" => "Background Settings",
					"title" =>"Background Settings",
					"type" => "Title-1");
					
$options1[] = array("id" => "tmoption_texture",
					"label" => "Predefined Background Image",
					"type" => "texture",
					"std" =>"body-bg.png",
					"options" => array('body-bg.png' => 'body-bg', 'body-bg2.png'=>'body-bg2', 'body-bg3.png'=>'body-bg3', 'body-bg4.png'=>'body-bg4', 'body-bg5.png'=>'body-bg5', 'body-bg6.png'=>'body-bg6', 'body-bg7.png'=>'body-bg7', 'body-bg8.png'=>'body-bg8', 'body-bg9.png'=>'body-bg9', 'body-bg10.png'=>'body-bg10', 'body-bg11.png'=>'body-bg11', 'body-bg12.png'=>'body-bg12', 'body-bg13.png'=>'body-bg13', 'body-bg14.png'=>'body-bg14', 'body-bg15.png'=>'body-bg15', 'body-bg16.png'=>'body-bg16'),
					"description" => "Choose your body background texture image.");
					
$options1[] = array("id" => "tmoption_background_upload",
					"label" => "Upload Background Image",
					"type" => "upload-3",
					"description" => "Upload Your Background.");	
					
$options1[] = array("id" => "tmoption_back_repeat",
					"label" => "Background Repeat",
					"type" => "select",
					"description" => "Choose Background repeate.",
					"options" => array('no-repeat' => 'no-repeat','repeat' => 'repeat','repeat-x' => 'repeat-x','repeat-y' => 'repeat-y'));	
					
$options1[] = array("id" => "tmoption_back_position",
					"label" => " Background Position",
					"type" => "select",
					"description" => "Choose Backgroung position.",
					"options" => array('top+left' => 'top left','top+center' => 'top center','top+right' => 'top right','center+right' => 'center right','center+left' => 'center left','center+center' => 'center center','bottom+right' => 'bottom right','bottom+center' => 'bottom center','bottom+left' => 'bottom left'));	
				
$options1[] = array("id" => "tmoption_back_attachment",
					"label" => "Background Attachment",
					"type" => "select",
					"description" => "Choose Background attachment.",
					"options" => array('scroll' => 'Scroll','Fixed' => 'fixed'));	

$options1[] = array("id" => "tmoption_bkg_color",
					"label" => "Body Background Color",
					"type" => "textbox-1",
					"std" => "FFFFFF",
					"description" => "Change your body background color.");

$options1[] = array("id" => "tmoption_bodyfont_color",
					"label" => "Body Font Color",
					"std" => "666666",
					"type" => "textbox-1",
					"description" => "Change your body font color.");			

$options1[] = array("id" => "tmoption_bodyfont",
					"label" => "Body Font",
					"type" => "select",
					"description" => "Change your body font.",
					"options" => array('Open+Sans'=>'Open Sans','please-select'=>'please-select','Nunito'=>'Nunito','Antic'=>'Antic','Bitter'=>'Bitter','Droid+Serif'=>'Droid Serif','Philosopher'=>'Philosopher','Oxygen'=>'Oxygen','Rokkitt'=>'Rokkitt','Galdeano'=>'Galdeano','Droid+Sans'=>'Droid Sans','Oswald'=>'Oswald','Play'=>'Play','Cabin'=>'Cabin','Cuprum'=>'Cuprum','Varela'=>'Varela','Andika'=>'Andika','Ubuntu' =>'Ubuntu','Other+Fonts'=>'Other Fonts'));
					
$options1[] = array("id" => "tmoption_bodyfont_other",
					"label" => "Specified Other Body Font",
					"type" => "textbox",
					"description" => "Change your specified body font Like Arail,verdana etc.");
					
$options1[] = array("id" => "tmoption_Newsletter_title",
					"label" => "Newsletter Title",
					"type" => "textbox",
					"std" => "Sign Up for Newsletter",
					"description" => "Change your Newsletter Title name.");
					
$options1[] = array("id" => "tmoption_Newsletter_sub_title",
					"label" => "Newsletter Sub Title",
					"type" => "textbox",
					"std" => "Get One Month premiun Membership For free",
					"description" => "Change your Newsletter sub Title name.");
					
$options1[] = array("id" => "tmoption_buttonbkg_light_color",
					"label" => "Button Gradient 0% Color",
					"type" => "textbox-1",
					"std" => "F5F5F5",
					"description" => "Change your top background gradient 0% color.");				

$options1[] = array("id" => "tmoption_buttonbkg_dark_color",
					"label" => "Button Gradient 100% Color",
					"type" => "textbox-1",
					"std" => "D8D7D3",
					"description" => "Change your top background gradient 100% color.");
					
$options1[] = array("id" => "tmoption_buttonbkghover_light_color",
					"label" => "Button Hover Gradient 0% Color",
					"type" => "textbox-1",
					"std" => "E76452",
					"description" => "Change your top background gradient 0% color.");				

$options1[] = array("id" => "tmoption_buttonbkghover_dark_color",
					"label" => "Button Hover Gradient 100% Color",
					"type" => "textbox-1",
					"std" => "D43E2A",
					"description" => "Change your top background gradient 100% color.");
					
$options1[] = array("id" => "tmoption_revslider_alias",
					"label" => "Revolution Slider Alias",
					"type" => "textbox",
					"std" => "tm_homeslider",
					"description" => "Change your Revolution Slider Alias name.");		
							
$options1[] = array("id" => "tmoption_theme_color",
					"label" => "Theme Common Color",
					"type" => "textbox-1",
					"std" => "E76452",
					"description" => "Change your theme common color.");

/*===================================================================================================================
=============================================== Header Settings ====================================================
=================================================================================================================== */

$options2 = array(array());

$options2[] = array("id" => "tmoption_header_layout",
					"label" => "Select Header Layout",
					"type" => "radio",
					"description" => "Select Header Layout.",	
					"std" =>"2",
					"options" => array('1' => '','2' => ''));
					
$options2[] = array("id" => "tmoption_header_background_upload",
					"label" => "Upload Header Background Image",
					"type" => "upload-1",
					"description" => "Upload Your Header Background Image.");	
					
$options2[] = array("id" => "tmoption_header_back_repeat",
					"label" => "Header Image Background Repeat",
					"type" => "select",
					"description" => "Choose Header Image Background repeate.",
					"options" => array('no-repeat' => 'no-repeat','repeat' => 'repeat','repeat-x' => 'repeat-x','repeat-y' => 'repeat-y'));	
					
$options2[] = array("id" => "tmoption_header_back_position",
					"label" => "Header Image Background Position",
					"type" => "select",
					"description" => "Choose Header Image Backgroung position.",
					"options" => array('top+left' => 'top left','top+center' => 'top center','top+right' => 'top right','center+right' => 'center right','center+left' => 'center left','center+center' => 'center center','bottom+right' => 'bottom right','bottom+center' => 'bottom center','bottom+left' => 'bottom left'));	
				
$options2[] = array("id" => "tmoption_header_back_attachment",
					"label" => "Header Image Background Attachment",
					"type" => "select",
					"description" => "Choose Header Image Background attachment.",
					"options" => array('scroll' => 'Scroll','Fixed' => 'fixed'));	

$options2[] = array("id" => "tmoption_header_bkg_color",
					"label" => "Header Background Color",
					"type" => "textbox-1",
					"std" => "FFFFFF",
					"description" => "Change your header background color.");

$options2[] = array("id" => "tmoption_headermenu_light_color",
					"label" => "HeaderMenu Gradient 0% Color",
					"type" => "textbox-1",
					"std" => "F5F5F5",
					"description" => "Change your top background gradient 0% color.");				

$options2[] = array("id" => "tmoption_headermenu_dark_color",
					"label" => "HeaderMenu Gradient 100% Color",
					"type" => "textbox-1",
					"std" => "D8D7D3",
					"description" => "Change your top background gradient 100% color.");
									
$options2[] = array("id" => "tmoption_navfont",
					"label" => "Navigation Font",
					"type" => "select",
					"description" => "Change your navigation font.",
					"options" => array('Open+Sans'=>'Open Sans','please-select'=>'please-select','Nunito'=>'Nunito','Droid+Sans'=>'Droid Sans','Antic'=>'Antic','Bitter'=>'Bitter','Droid+Serif'=>'Droid Serif','Philosopher'=>'Philosopher','Oxygen'=>'Oxygen','Rokkitt'=>'Rokkitt','Galdeano'=>'Galdeano','Oswald'=>'Oswald','Play'=>'Play','Cuprum'=>'Cuprum','Varela'=>'Varela','Andika'=>'Andika','Other+Fonts'=>'Other Fonts'));
					
$options2[] = array("id" => "tmoption_navfont_other",
					"label" => "Specified Other Navigation Font",
					"type" => "textbox-3",
					"std" => "Arial",
					"description" => "Change your specified navigation font.");	

$options2[] = array("id" => "tmoption_category_text",
					"label" => "Category Text",
					"type" => "textbox-3",
					"std" => "Categories",
					"description" => "Change your category text.");		
		
		
/*===================================================================================================================
=============================================== Content Settings ====================================================
=================================================================================================================== */
	
$options3[] = array("id" => "tmoption_h1font",
					"label" => "H1 Font",
					"type" => "select",
					"description" => "Change your H1 font.",
					"options" => array('Open+Sans'=>'Open Sans','please-select'=>'please-select','Nunito'=>'Nunito','Droid+Sans'=>'Droid Sans','Antic'=>'Antic','Bitter'=>'Bitter','Droid+Serif'=>'Droid Serif','Philosopher'=>'Philosopher','Oxygen'=>'Oxygen','Rokkitt'=>'Rokkitt','Galdeano'=>'Galdeano','Oswald'=>'Oswald','Play'=>'Play','Cuprum'=>'Cuprum','Varela'=>'Varela','Andika'=>'Andika','Other+Fonts'=>'Other Fonts'));
					
$options3[] = array("id" => "tmoption_h1font_other",
					"label" => "Specified Other H1 Font",
					"type" => "textbox-3",
					"std" => "Arial",
					"description" => "Change your specified H1 font.");	

$options3[] = array("id" => "tmoption_h1color",
					"label" => "H1 Color",
					"type" => "textbox-1",
					"std" => "E76453",
					"description" => "Change your H1 font color.");	
					
$options3[] = array("id" => "tmoption_h2font",
					"label" => "H2 Font",
					"type" => "select",
					"description" => "Change your H2 Font.",
					"options" => array('Open+Sans'=>'Open Sans','please-select'=>'please-select','Nunito'=>'Nunito','Droid+Sans'=>'Droid Sans','Antic'=>'Antic','Bitter'=>'Bitter','Droid+Serif'=>'Droid Serif','Philosopher'=>'Philosopher','Oxygen'=>'Oxygen','Rokkitt'=>'Rokkitt','Galdeano'=>'Galdeano','Oswald'=>'Oswald','Play'=>'Play','Cuprum'=>'Cuprum','Varela'=>'Varela','Andika'=>'Andika','Other+Fonts'=>'Other Fonts'));
					
$options3[] = array("id" => "tmoption_h2font_other",
					"label" => "Specified Other H2 Font",
					"type" => "textbox-3",
					"std" => "Arial",
					"description" => "Change your specified H2 font.");

$options3[] = array("id" => "tmoption_h2color",
					"label" => "H2 Color",
					"type" => "textbox-1",
					"std" => "E76453",
					"description" => "Change your H2 font color.");		
					
$options3[] = array("id" => "tmoption_h3font",
					"label" => "H3 Font",
					"type" => "select",
					"description" => "Change your H3 font.",
					"options" => array('Open+Sans'=>'Open Sans','please-select'=>'please-select','Nunito'=>'Nunito','Droid+Sans'=>'Droid Sans','Antic'=>'Antic','Bitter'=>'Bitter','Droid+Serif'=>'Droid Serif','Philosopher'=>'Philosopher','Oxygen'=>'Oxygen','Rokkitt'=>'Rokkitt','Galdeano'=>'Galdeano','Oswald'=>'Oswald','Play'=>'Play','Cuprum'=>'Cuprum','Varela'=>'Varela','Andika'=>'Andika','Other+Fonts'=>'Other Fonts'));
					
$options3[] = array("id" => "tmoption_h3font_other",
					"label" => "Specified Other H3 Font",
					"type" => "textbox-3",
					"std" => "Arial",
					"description" => "Change your specified H3 font.");	

$options3[] = array("id" => "tmoption_h3color",
					"label" => "H3 Color",
					"type" => "textbox-1",
					"std" => "E76453",
					"description" => "Change your H3 font color.");										
					
$options3[] = array("id" => "tmoption_h4font",
					"label" => "H4 Font",
					"type" => "select",
					"description" => "Change your H4 font.",
					"options" => array('Open+Sans'=>'Open Sans','please-select'=>'please-select','Nunito'=>'Nunito','Droid+Sans'=>'Droid Sans','Antic'=>'Antic','Bitter'=>'Bitter','Droid+Serif'=>'Droid Serif','Philosopher'=>'Philosopher','Oxygen'=>'Oxygen','Rokkitt'=>'Rokkitt','Galdeano'=>'Galdeano','Oswald'=>'Oswald','Play'=>'Play','Cuprum'=>'Cuprum','Varela'=>'Varela','Andika'=>'Andika','Other+Fonts'=>'Other Fonts'));
					
$options3[] = array("id" => "tmoption_h4font_other",
					"label" => "Specified Other H4 Font",
					"type" => "textbox-3",
					"std" => "Arial",
					"description" => "Change your specified H4 font.");	

$options3[] = array("id" => "tmoption_h4color",
					"label" => "H4 Color",
					"type" => "textbox-1",
					"std" => "E76453",
					"description" => "Change your H4 font color.");	
					
$options3[] = array("id" => "tmoption_h5font",
					"label" => "H5 Font",
					"type" => "select",
					"description" => "Change your H5 font.",
					"options" => array('Open+Sans'=>'Open Sans','please-select'=>'please-select','Nunito'=>'Nunito','Droid+Sans'=>'Droid Sans','Antic'=>'Antic','Bitter'=>'Bitter','Droid+Serif'=>'Droid Serif','Philosopher'=>'Philosopher','Oxygen'=>'Oxygen','Rokkitt'=>'Rokkitt','Galdeano'=>'Galdeano','Oswald'=>'Oswald','Play'=>'Play','Cuprum'=>'Cuprum','Varela'=>'Varela','Andika'=>'Andika','Other+Fonts'=>'Other Fonts'));
					
$options3[] = array("id" => "tmoption_h5font_other",
					"label" => "Specified Other H5 Font",
					"type" => "textbox-3",
					"std" => "Arial",
					"description" => "Change your specified H5 font.");	

$options3[] = array("id" => "tmoption_h5color",
					"label" => "H5 Color",
					"type" => "textbox-1",
					"std" => "E76453",
					"description" => "change your H5 font color.");	
					
$options3[] = array("id" => "tmoption_h6font",
					"label" => "H6 Font",
					"type" => "select",
					"description" => "Change your H6 font.",
					"options" => array('Open+Sans'=>'Open Sans','please-select'=>'please-select','Nunito'=>'Nunito','Droid+Sans'=>'Droid Sans','Antic'=>'Antic','Bitter'=>'Bitter','Droid+Serif'=>'Droid Serif','Philosopher'=>'Philosopher','Oxygen'=>'Oxygen','Rokkitt'=>'Rokkitt','Galdeano'=>'Galdeano','Oswald'=>'Oswald','Play'=>'Play','Cuprum'=>'Cuprum','Varela'=>'Varela','Andika'=>'Andika','Other+Fonts'=>'Other Fonts'));
					
$options3[] = array("id" => "tmoption_h6font_other",
					"label" => "Specified Other H6 Font",
					"type" => "textbox-3",
					"std" => "Arial",
					"description" => "Change your specified H6 font.");		

$options3[] = array("id" => "tmoption_h6color",
					"label" => "H6 Color",
					"type" => "textbox-1",
					"std" => "E76453",
					"description" => "Change your H6 font color.");		
					
$options3[] = array("id" => "tmoption_link_color",
					"label" => "Link Color",
					"type" => "textbox-1",
					"std" => "777777",
					"description" => "Change your link color.");	
					
$options3[] = array("id" => "tmoption_hoverlink_color",
					"label" => "Link Hover Color",
					"type" => "textbox-1",
					"std" => "E76453",
					"description" => "Change your link Hover color.");	
		
/*===================================================================================================================
=============================================== Footer Settings ====================================================
=================================================================================================================== */

$options4 = array(array());

$options4[] = array("id" => "tmoption_footerbkg_color",
					"label" => "Footer Background Color",
					"type" => "textbox-1",
					"std" => "FAFAFA",
					"description" => "Change your footer background color.");

$options4[] = array("id" => "tmoption_footerlink_color",
					"label" => "Footer Link Color",
					"type" => "textbox-1",
					"std" => "464E55",
					"description" => "Change your footer link color.");	
					
$options4[] = array("id" => "tmoption_footerhoverlink_color",
					"label" => "Footer Link Hover Color",
					"type" => "textbox-1",
					"std" => "87CFC5",
					"description" => "Change your footer link hover color.");
					
$options4[] = array("id" => "tmoption_footerfont",
					"label" => "Footer Font",
					"type" => "select",
					"description" => "Change your Footer font.",
					"options" => array('Open+Sans'=>'Open Sans','please-select'=>'please-select','Nunito'=>'Nunito','Droid+Sans'=>'Droid Sans','Antic'=>'Antic','Bitter'=>'Bitter','Droid+Serif'=>'Droid Serif','Philosopher'=>'Philosopher','Oxygen'=>'Oxygen','Rokkitt'=>'Rokkitt','Galdeano'=>'Galdeano','Oswald'=>'Oswald','Play'=>'Play','Cabin'=>'Cabin','Cuprum'=>'Cuprum','Varela'=>'Varela','Andika'=>'Andika','Ubuntu' =>'Ubuntu','Other+Fonts'=>'Other Fonts'));		
					
$options4[] = array("id" => "tmoption_footerfont_other",
					"label" => "Specified Other Footer Font",
					"type" => "textbox-3",
					"std" => "Arial",
					"description" => "Change your specified Footer font.");			

$options4[] = array("id" => "tmoption_footer_slog",
					"label" => "Footer copyright",
					"type" => "textbox",
					"description" => "Enter your copyright statement here.",
					"std" => "Templatemela.");	
					
$options4[] = array("id" => "tmoption_footer_link",
					"label" => "Footer copyright Link",
					"type" => "textbox",
					"description" => "Enter your copyright link here.",
					"std" => "www.google.com");


					
/*===================================================================================================================
=============================================== Portfolio Settings ==================================================
=================================================================================================================== */


/*$options5 = array(array());

$options5[] = array("id" => "tmoption_portfolio_cat",
					"label" => "Filter Portfolio?",
					"type" => "select",
					"description" => "Display portfolio filter?",
					"options" => array('yes' => 'Yes','no' => 'No'));
					
$options5[] = array("id" => "tmoption_portfolio_layout",
					"label" => "Portfolio Layout",
					"type" => "select",
					"description" => "Choose the portfolio layout If Display all Portfolio 'No'.",
					"options" => array('2' => 'Two Column','3' => 'Three Column','4' => 'Four Column'));
			
$options5[] = array("id" => "tmoption_portfolio_perpage",
					"label" => "Portfolio per page",
					"type" => "textbox",
					"description" => "Enter the number of portfolio shown per page If Display all Portfolio 'No'.",
					"std" => "4");		*/

				
/*===================================================================================================================
=============================================== Top Bar Settings ====================================================
=================================================================================================================== */

$options6 = array(array());
					
$options6[] = array("id" => "tmoption_show_topbar",
					"label" => "Show Top Bar",
					"type" => "select",
					"description" => "Displays Top bar.",
					"options" => array('yes' => 'Yes','no' => 'No'));	
					
$options6[] = array("id" => "tmoption_topbar_light_color",
					"label" => "TopBar Gradient 0% Color",
					"type" => "textbox-1",
					"std" => "F5F5F5",
					"description" => "Change your top background gradient 0% color.");				

$options6[] = array("id" => "tmoption_topbar_dark_color",
					"label" => "TopBar Gradient 100% Color",
					"type" => "textbox-1",
					"std" => "D8D7D3",
					"description" => "Change your top background gradient 100% color.");

$options6[] = array("id" => "tmoption_topbar_bkg_color",
					"label" => "Top Bar Background Color",
					"type" => "textbox-1",
					"std" => "F5F5F5",
					"description" => "Change your topbar background color.");
					
$options6[] = array("id" => "tmoption_topbar_text_color",
					"label" => "Top Bar Text Color",
					"type" => "textbox-1",
					"std" => "767676",
					"description" => "Change your topbar text color.");
					
$options6[] = array("id" => "tmoption_topbar_link_color",
					"label" => "Top Bar Link Color",
					"type" => "textbox-1",
					"std" => "767676",
					"description" => "Change your topbar links color.");
					
$options6[] = array("id" => "tmoption_topbar_link_hover_color",
					"label" => "Top Bar Link Hover Color",
					"type" => "textbox-1",
					"std" => "E76453",
					"description" => "Change your topbar links hover color.");

$options6[] = array("label" => "Contact Information Settings",
					"title" =>"Contact Information Settings",
					"type" => "Title-1");
					
$options6[] = array("id" => "tmoption_show_topbar_contact",
					"label" => "Show Contact Information",
					"type" => "select",
					"description" => "Displays Contact Information.",
					"options" => array('yes' => 'Yes','no' => 'No'));
					
/*$options6[] = array("id" => "tmoption_topbar_address",
					"label" => "Address",
					"std" => " ",
					"type" => "textbox",
					"description" => "Change your topbar address.");*/
					
$options6[] = array("id" => "tmoption_topbar_phone",
					"label" => "Phone",
					"std" => ": 00-0000-000",
					"type" => "textbox",
					"description" => "Change your topbar phone.");
					
/*$options6[] = array("id" => "tmoption_topbar_email",
					"label" => "Email",
					"std" => " ",
					"type" => "textbox",
					"description" => "Change your topbar email.");	

$options6[] = array("id" => "tmoption_topbar_email_link",
					"label" => "Email Link",
					"std" => "",
					"type" => "textbox",
					"description" => "Change your topbar email link.");*/

$options6[] = array("label" => "Social Links Settings",
					"title" =>"Social Links Settings",
					"type" => "Title-1");
					
$options6[] = array("id" => "tmoption_show_topbar_social",
					"label" => "Show Social Links",
					"type" => "select",
					"description" => "Displays social links.",
					"options" => array('no' => 'No','yes' => 'Yes'));
					
$options6[] = array("id" => "tmoption_topbar_twitter",
					"label" => "Twitter",
					"std" => "#",
					"type" => "textbox",
					"description" => "Change your topbar twitter link.");

$options6[] = array("id" => "tmoption_topbar_facebook",
					"label" => "Facebook",
					"std" => "#",
					"type" => "textbox",
					"description" => "Change your topbar facebook link.");
					
$options6[] = array("id" => "tmoption_topbar_google_plus",
					"label" => "Goolge Plus",
					"std" => "#",
					"type" => "textbox",
					"description" => "Change your topbar google plus link.");
					
$options6[] = array("id" => "tmoption_topbar_linkedin",
					"label" => "Linkedin",
					"std" => "#",
					"type" => "textbox",
					"description" => "Change your topbar linkedin link.");
					
$options6[] = array("id" => "tmoption_topbar_youtube",
					"label" => "Youtube",
					"std" => "#",
					"type" => "textbox",
					"description" => "Change your topbar youtube link.");

$options6[] = array("id" => "tmoption_topbar_rss",
					"label" => "RSS",
					"std" => "#",
					"type" => "textbox",
					"description" => "Change your topbar rss link.");
					
$options6[] = array("id" => "tmoption_topbar_pinterest",
					"label" => "Pinterest",
					"std" => "#",
					"type" => "textbox",
					"description" => "Change your topbar pinterest link.");
					
$options6[] = array("id" => "tmoption_topbar_skype",
					"label" => "Skype",
					"std" => "#",
					"type" => "textbox",
					"description" => "Change your topbar skype link.");

//=============================================== Shop Settings ==================================================================

$options7 = array(array());
					
$options7[] = array("id" => "tmoption_shop_items",
					"label" => "Products per Shop Page",	
					"type" => "textbox", 
					"std" => "9",				
					"description" => "Dispaly number of products on shop page for pagination");
					
$options7[] = array("id" => "tmoption_shop_items_per_row",
					"label" => "All Products per row",	
					"type" => "textbox", 
					"std" => "3",				
					"description" => "Change number of products per one row");
					
$options7[] = array("id" => "tmoption_related_items",
					"label" => "Related Products",	
					"type" => "textbox", 
					"std" => "8",				
					"description" => "Dispaly number of products on shop page for pagination");
					
$options7[] = array("id" => "tmoption_related_items_per_row",
					"label" => "Related Products per row",	
					"type" => "textbox", 
					"std" => "4",				
					"description" => "Change number of products per one row");
					
$options7[] = array("id" => "tmoption_upsells_items",
					"label" => "Upsell Products",	
					"type" => "textbox", 
					"std" => "8",				
					"description" => "Dispaly number of products on shop page for pagination");
					
$options7[] = array("id" => "tmoption_upsells_items_per_row",
					"label" => "Upsell Products per row",	
					"type" => "textbox", 
					"std" => "4",				
					"description" => "Change number of products per one row");
?>
<!-- =========================================== Call Font Script =========================================== -->

<div class="main-block">
<div class="icon-templatemela"><img src="<?php echo get_option( 'siteurl' ).'/wp-content/themes/'.get_option( 'template' ).'/templatemela/logo.png'; ?>" /></div>
<h2 class="title-themeset">TemplateMela - Theme Settings</h2>
<?php  global $result;   
	if ($result=='success') 
	 echo '<div class="updated settings-error" id="setting-error-settings_updated"><p><strong>Settings saved.</strong></p></div>';
?>
<div class="tab_main">
<!-- =========================================== Start Tab =============================================== -->
<div id="tab-container" class='tab-container'>
  <ul class='etabs'>
    <li class="tab first"> <a href="#General" title="General Settings"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/general_setting.png" alt="general"/> <span class="title">
      <?php echo __('General','templatemela');?>
      </span></a> </li>
    <li class="tab topbar"> <a href="#Topbar"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/topbar_setting.png" alt="color"/> <span class="title">
      <?php echo __('Topbar','templatemela');?>
      </span></a> </li>
    <li class="tab header"> <a href="#Header"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/header_setting.png" alt="color"/> <span class="title">
      <?php echo __('Header','templatemela');?>
      </span></a> </li>
    <li class="tab"> <a href="#Content"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/content_settings.png" alt="color"/> <span class="title">
      <?php echo __('Content','templatemela');?>
      </span></a> </li>
    <li class="tab"> <a href="#Footer"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/footer_settings.png" alt="color"/> <span class="title">
      <?php echo __('Footer','templatemela');?>
      </span></a> </li>
    <?php /*?><li class="tab"> <a href="#portfolio"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/portfolio_setting.png" alt="portfolio"/> <span class="title">
      <?php echo __('Portfolio','templatemela');?>
      </span></a> </li><?php */?>
    <li class="tab"> <a href="#shop"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/shop_setting.png" alt="blog"/> <span class="title">
      <?php echo __('Shop','templatemela');?>
      </span></a> </li>
  </ul>
  <!-- Start Panel-container -->
  <div class='panel-container'>
    <!-- =========================================== Start General Setting =========================================== -->
    <div id="General">
      <form enctype="multipart/form-data" method="post" id="settingForm1" name="settingForm1">
        <input type="hidden" name="action" value="save_options1"  />
        <?php 
	 if(!isset( $_REQUEST['action'])) {$_REQUEST['action']=''; }
	 if(!isset( $_REQUEST['reset1'])) {$_REQUEST['reset1']=''; }
       if ( 'save_options1' == $_REQUEST['action'] )
       {
 			foreach ($options1 as $value) {
				if(!isset( $value['id'] )) {$value['id']=''; }
				if(isset( $value['id'] ) && isset($_REQUEST[ $value['id'] ] )){
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
				}
						
			} 
      	} 
	    else if( 'reset1' == $_REQUEST['reset1'] )
        {
 	    	foreach ($options1 as $value) 
	    	{
				if(!isset( $value['id'] )) {$value['id']=''; }
				delete_option( $value['id'] ); 
          	}
        }
    	?>
        <div class="form-table">
        <div class="background-title">
          <label>
          <?php echo __('General Settings', 'templatemela'); ?>
          </label>
        </div>
        <?php
       $i= 0;
	   foreach ($options1 as $value) { 
	   if(!isset( $value['type'] )) {$value['type'] =''; }
	   switch ( $value['type'] ) {
	 

	 case 'textbox':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else {  	 if(!isset( $value['std'] )) {$value['std'] =''; }  echo stripslashes($value['std']); } ?>" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--odd-even-->
        <?php
		break;
		
	case 'upload': ?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            <br />
            <br />
            <?php if(get_option('tmoption_logo_image') != '') { ?>
            <img src="<?php echo get_option('tmoption_logo_image');?>" id="slider_logodisplay"/>&nbsp;<a id="slider_remove_link1" href="javascript:removeImage1();"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/remove.png" /></a>
            <?php } ?>
            <script>
			function removeImage1() {
				document.getElementById("tmoption_logo_image").value="";
				document.getElementById("slider_logodisplay").src="";
				document.getElementById("slider_remove_link1").innerHTML="";					
			}
		</script>
          </div>
          <div class="content">
            <input style=" <?php if($value['id'] != 'tmoption_logo_image') { echo 'display:none' ; } ?> " class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo get_option($value['id']); ?>" />
            <input id="upload_image_button" class="button-primary" type="button" value="Upload Logo" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--even odd setting-->
        <?php	break;
		
	case 'select':	?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <select class="select_input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
              <?php foreach ($value['options'] as $op_id => $suboption) { ?>
              <option value="<?php echo $op_id; ?>" <?php if (get_option($value['id']) == $op_id) { echo ' selected="selected"'; } ?>><?php echo $suboption; ?></option>
              <?php } ?>
            </select>
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--even-Odd-->
        <?php	break; //end Switch
		
	case 'textbox-1':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <?php if ( get_option( $value['id'] ) != "") { 
			$stylecolor =  stripslashes(get_option( $value['id'] )); 
			} else { 
			$stylecolor = stripslashes($value['std']); } 
			$stylecolor = 'style="background-color:#'.$stylecolor.'"';?>
            <input class="regular-text1" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" <?php echo $stylecolor; ?> />
            <span class="description"><?php echo $value['description']; echo get_option( $value['id']);?></span> </div>
        </div>
        <!--odd-even-->
        <?php	break;
		
	case 'upload-1': ?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            <br />
            <br />
            <?php if(get_option('tmoption_favicon_icon') != '') { ?>
            <img src="<?php echo get_option('tmoption_favicon_icon');?>" id="slider_favicondisplay"/>&nbsp;<a id="slider_remove_link2" href="javascript:removeImage2();"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/remove.png" /></a>
            <?php }	?>
            <script>
			function removeImage2() {
				document.getElementById("tmoption_favicon_icon").value="";
				document.getElementById("slider_favicondisplay").src="";
				document.getElementById("slider_remove_link2").innerHTML="";					
			}
		</script>
          </div>
          <div class="content">
            <input class"favicon-upload" style="<?php if($value['id'] != 'tmoption_favicon_icon') { echo 'display:none' ; } ?> " class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo get_option($value['id']); ?>" />
            <input id="upload_favicon_icon" class="button-primary" type="button" value="Upload Favicon Icon" />
            <span class="description"><?php echo $value['description']; ?></span><br />
          </div>
        </div>
        <!--even odd setting-->
        <?php	break;
		
	case 'upload-3': ?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            <br />
            <br />
            <?php if(get_option('tmoption_background_upload') != '') { ?>
            <img src="<?php echo get_option('tmoption_background_upload');?>" id="slider_backgrounddisplay"/>&nbsp;<a id="slider_remove_link3" href="javascript:removeImage3();"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/remove.png" /></a>
            <?php } ?>
            <script>
			function removeImage3() {
				document.getElementById("tmoption_background_upload").value="";
				document.getElementById("slider_backgrounddisplay").src="";
				document.getElementById("slider_remove_link3").innerHTML="";					
			}
		</script>
          </div>
          <div class="content">
            <input style=" <?php if($value['id'] != 'tmoption_background_upload') { echo 'display:none' ; } ?> " class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo get_option($value['id']); ?>" />
            <input id="upload_backgroundimage_button" class="button-primary" type="button" value="Upload Image" />
            <span class="description"><?php echo $value['description']; ?></span><br />
          </div>
        </div>
        <!--even odd setting-->
        <?php	break;
		
	case 'texture': 	
		?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
          <?php } else { ?>
          <div class="even setting_main">
            <?php }
	    $img_dir = get_template_directory_uri() .'/images/megnor/colorpicker/pattern/';
		?>
            <div class="title">
              <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            </div>
            <div class="content">
              <div class="tm_content">
                <div class="thumb-sel"> <img class="thumb" src="<?php if ( get_option( $value['id'] ) != ""){echo $img_dir.get_option($value['id']);}else{echo $img_dir.$value['std'];} ?>" /> <span id="switch" class="close"></span> </div>
                <div class="thumb-list">
                  <ul>
                    <?php foreach ($value['options'] as $opt_key => $opt_val) { 
		    if ( get_option( $value['id'] ) != "")   {
            if($opt_key == get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";}
            } else {
            if($opt_key == ($value['std'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }
            } ?>
                    <li>
                      <input type="radio" name="<?php echo $value['id'] ?>" value="<?php echo $opt_key ?>" <?php echo $checked; ?>/>
                      <img class="thumb" src="<?php echo $img_dir.$opt_key ?>" title="<?php echo $opt_val ?>" /> </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <span class="description"><?php echo $value['description']; ?></span> </div>
          </div>
          <?php break;
		
	case 'Title-1':		
		 if(!isset( $value['id'] )) {$value['id'] =''; }
		?>
          <div class="background-title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <?php break;
		
		}
	   $i++;
      }?>
        </div>
        <!--from-table-->
        <div class="submit">
          <input type="submit" value="Save Changes" class="button-primary" name="Submit" >
        </div>
      </form>
      <!--mainform-->
      <!-- reset Button -->
      <div class="reset-option">
        <form enctype="multipart/form-data" method="post" id="settingForm1" name="settingFormx"  >
          <p class="submit">
            <input type="hidden" name="reset1" value="reset1" />
            <input type="submit" value="Set Default" class="button-primary" name="reset"/>
          </p>
        </form>
      </div>
      <!-- End Reset Button -->
    </div>
    <!--general-setting-->
    <div style="clear:both"></div>
    <!-- =========================================== End General Settings =========================================== -->
    <!-- =========================================== Start Top bar Settings =========================================== -->
    <div id="Topbar">
      <form enctype="multipart/form-data" method="post" id="settingForm6" name="settingForm6"  >
        <input type="hidden" name="action" value="save_options6" />
        <?php

	if(!isset( $_REQUEST['action'] )) {$_REQUEST['action']=''; }
	if(!isset( $_REQUEST['reset6'] )) {$_REQUEST['reset6']=''; }
    if ( 'save_options6' == $_REQUEST['action'] )
     {
	 
 		foreach ($options6 as $value) {
				if(!isset( $value['id'] )) {$value['id']=''; }
				
				if(isset( $value['id'] ) && isset($_REQUEST[ $value['id'] ] )){
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
				}
		}
	    } 
		
     else if( 'reset6' == $_REQUEST['reset6'] )
      {
 	    foreach ($options6 as $value) 
	     {
				 if(!isset( $value['id'] )) {$value['id']=''; }
				 delete_option( $value['id'] ); 
        }
      }
    ?>
        <div class="form-table">
        <div class="background-title">
          <label>
          <?php echo __('Topbar Settings', 'templatemela'); ?>
          </label>
        </div>
        <?php
     foreach ($options6 as $value) { 
		if(!isset( $value['type'] )) {$value['type'] =''; }
	switch ( $value['type'] ) {
	
		case 'select':	?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <select class="select_input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
              <?php foreach ($value['options'] as $op_id => $suboption) { ?>
              <option value="<?php echo $op_id; ?>" <?php if (get_option($value['id']) == $op_id) { echo ' selected="selected"'; } ?>><?php echo $suboption; ?></option>
              <?php } ?>
            </select>
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--even-Odd-->
        <?php	break; //end Switch
		case 'textbox':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
            <span class="description"><?php echo $value['description']; echo get_option( $value['id']);?></span> </div>
        </div>
        <!--odd-even-->
        <?php
			
		break;
		case 'textbox-3':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--odd-even-->
        <?php
		break;
		
		case 'textbox-1':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
          <?php } else { ?>
          <div class="even setting_main">
            <?php }?>
            <div class="title">
              <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            </div>
            <div class="content">
              <?php if ( get_option( $value['id'] ) != "") { 
			$stylecolor =  stripslashes(get_option( $value['id'] )); 
			} else { 
			$stylecolor = stripslashes($value['std']); } 
			$stylecolor = 'style="background-color:#'.$stylecolor.'"'; ?>
              <input class="regular-text1" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" <?php echo $stylecolor; ?> />
              <span class="description"><?php echo $value['description']; echo get_option( $value['id']);?></span> </div>
          </div>
          <!--odd-even-->
          <?php
	break;
	
	case 'Title-1':		
	if(!isset( $value['id'] )) {$value['id'] =''; }
	?>
          <div class="background-title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <?php break;
		
		   }
		$i++;
      }
?>
        </div>
        <!--form table-->
        <div class="submit">
          <input type="submit" value="Save Changes" class="button-primary" name="Submit" >
        </div>
      </form>
      <!-- reset Button -->
      <div class="reset-option">
        <form enctype="multipart/form-data" method="post" id="settingForm6" name="settingForm6"   >
          <p class="submit">
            <input type="hidden" name="reset6" value="reset6" />
            <input type="submit" value="Set Default" class="button-primary" name="reset"/>
          </p>
        </form>
      </div>
      <!-- End Reset Button -->
    </div>
    <!---#color-->
    <script type="text/javascript">
function Ajax(){

var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('tab_main').innerHTML=xmlHttp.responseText;
		return false;
	}
}
xmlHttp.send(null);
}
window.onload=function(){
}
</script>
    <div style="clear:both"></div>
    <!-- =========================================== End Top bar Settings =========================================== -->
    <!-- =========================================== Start Shop Settings =========================================== -->
    <div id="shop">
      <form enctype="multipart/form-data" method="post" id="settingForm7" name="settingForm7" >
        <input type="hidden" name="action" value="save_options7" />
        <?php
	if(!isset( $_REQUEST['action'])) {$_REQUEST['action']=''; }	
	if(!isset( $_REQUEST['reset7'])) {$_REQUEST['reset7']=''; }	
	
       if ( 'save_options7' == $_REQUEST['action'] )
        {
 	    	foreach ($options7 as $value) {
	    	
				if(!isset( $value['id'] )) {$value['id']=''; }
				if(isset( $value['id'] ) && isset($_REQUEST[ $value['id'] ] )){
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
				}

			} 
	     } 
       else if( 'reset7' == $_REQUEST['reset7'] )
         {
 	     foreach ($options7 as $value) 
	     {
		 delete_option( $value['id'] ); 
         }
      }
     ?>
        <div class="form-table">
        <div class="background-title">
         <label>
            <?php echo __('Shop Settings', 'templatemela'); ?>
          </label>
        </div>
        <?php
        foreach ($options7 as $value) { 
if(!isset( $value['type'])) {$value['type']=''; }	
	    switch ( $value['type'] ) {
	
	case 'textbox':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo get_option($value['id']); ?>" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--odd-even-->
        <?php break;
			
	case 'select':	?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
          <?php } else { ?>
          <div class="even setting_main">
            <?php }?>
            <div class="title">
              <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            </div>
            <div class="content">
              <select class="select_input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $op_id => $suboption) { ?>
                <option value="<?php echo $op_id; ?>" <?php if (get_option($value['id']) == $op_id) { echo ' selected="selected"'; } ?>><?php echo $suboption; ?></option>
                <?php } ?>
              </select>
              <span class="description"><?php echo $value['description']; ?></span> </div>
          </div>
          <!--even-Odd-->
          <?php	break; //end Switch
       }
     $i++;
    }
   ?>
        </div>
        <!--form-table-->
        <div class="submit">
          <input type="submit" value="Save Changes" class="button-primary" name="Submit" >
        </div>
      </form>
      <!-- reset Button -->
      <div class="reset-option">
        <form enctype="multipart/form-data" method="post" id="settingForm7" name="settingFormx" >
          <p class="submit">
            <input type="hidden" name="reset7" value="reset7" />
            <input type="submit" value="Set Default" class="button-primary" name="reset"/>
          </p>
        </form>
      </div>
      <!-- End Reset Button -->
    </div>
    <!-- =========================================== End Shop Settings =========================================== -->
    <!-- =========================================== Start Header Settings =========================================== -->
    <div id="Header">
      <form enctype="multipart/form-data" method="post" id="settingForm2" name="settingForm2"  >
        <input type="hidden" name="action" value="save_options2" />
        <?php

	if(!isset( $_REQUEST['action'] )) {$_REQUEST['action']=''; }
	if(!isset( $_REQUEST['reset2'] )) {$_REQUEST['reset2']=''; }
    if ( 'save_options2' == $_REQUEST['action'] )
     {
 		foreach ($options2 as $value) {
				if(!isset( $value['id'] )) {$value['id']=''; }
				if(isset( $value['id'] ) && isset($_REQUEST[ $value['id'] ] )){
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
				}
		}
	    } 
     else if( 'reset2' == $_REQUEST['reset2'] )
      {
 	    foreach ($options2 as $value) 
	     {
				 if(!isset( $value['id'] )) {$value['id']=''; }
				 delete_option( $value['id'] ); 
        }
      }
    ?>
        <div class="form-table">
        <div class="background-title">
			<label>
          <?php echo __('Header Settings', 'templatemela'); ?>
		  	</label>
        </div>
        <?php
     foreach ($options2 as $value) { 
		if(!isset( $value['type'] )) {$value['type'] =''; }
	switch ( $value['type'] ) {
	
		case 'select':	?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <select class="select_input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
              <?php foreach ($value['options'] as $op_id => $suboption) { ?>
              <option value="<?php echo $op_id; ?>" <?php if (get_option($value['id']) == $op_id) { echo ' selected="selected"'; } ?>><?php echo $suboption; ?></option>
              <?php } ?>
            </select>
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--even-Odd-->
        <?php	break; //end Switch
		
		case 'textbox-3':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--odd-even-->
        <?php
		break;
		
		case 'textbox-1':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <?php if ( get_option( $value['id'] ) != "") { 
			$stylecolor =  stripslashes(get_option( $value['id'] )); 
			} else { 
			$stylecolor = stripslashes($value['std']); } 
			$stylecolor = 'style="background-color:#'.$stylecolor.'"'; ?>
            <input class="regular-text1" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" <?php echo $stylecolor; ?> />
            <span class="description"><?php echo $value['description']; echo get_option( $value['id']);?></span> </div>
        </div>
        <!--odd-even-->
        <?php
			
		break;
			
		
case 'texture': 
		
		?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }
	            
				
								$img_dir = get_template_directory_uri().'/templatemela/images/';
								?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <div class="tm_content">
              <div class="thumb-sel"> <img class="thumb" src="<?php if ( get_option( $value['id'] ) != ""){echo $img_dir.get_option($value['id']);}else{echo $img_dir.$value['std'];} ?>" /> <span id="switch" class="close"></span> </div>
              <div class="thumb-list">
                <ul>
                  <?php foreach ($value['options'] as $opt_key => $opt_val) { 
					    if ( get_option( $value['id'] ) != "")   {
                        if($opt_key == get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";}
                        } else {
                        if($opt_key == ($value['std'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }
                         } ?>
                  <li>
                    <input type="radio" name="<?php echo $value['id'] ?>" value="<?php echo $opt_key ?>" <?php echo $checked; ?>/>
                    <img class="thumb" src="<?php echo $img_dir.$opt_key ?>" title="<?php echo $opt_val ?>" /> </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <?php
				break;
		case 'upload': ?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input style=" <?php if($value['id'] != 'tmoption_background_upload') { echo 'display:none' ; } ?> " class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo get_option($value['id']); ?>" />
            <input id="upload_image_button1" class="button-primary" type="button" value="Upload Image" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--even odd setting-->
        <?php	break;
		
		case 'upload-1': ?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
          <?php } else { ?>
          <div class="even setting_main">
            <?php }?>
            <div class="title">
              <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
              <br />
              <br />
              <?php if(get_option('tmoption_header_background_upload') != '') { ?>
              <img src="<?php echo get_option('tmoption_header_background_upload');?>" id="slider_backgrounddisplay1" class="thumb"/>&nbsp;<a id="slider_remove_link31" href="javascript:removeImage31();"><img src="<?php echo get_template_directory_uri(); ?>/images/megnor/admin/remove.png" /></a>
              <?php } ?>
              <script>
			function removeImage31() {
				document.getElementById("tmoption_header_background_upload").value="";
				document.getElementById("slider_backgrounddisplay1").src="";
				document.getElementById("slider_remove_link31").innerHTML="";					
			}
		</script>
            </div>
            <div class="content">
              <input style=" <?php if($value['id'] != 'tmoption_header_background_upload') { echo 'display:none' ; } ?> " class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo get_option($value['id']); ?>" />
              <input id="upload_backgroundimage_button" class="button-primary" type="button" value="Upload Image" />
              <span class="description"><?php echo $value['description']; ?></span><br />
            </div>
          </div>
          <!--even odd setting-->
          <?php	break;
		case 'Title-1':		
		 if(!isset( $value['id'] )) {$value['id'] =''; }
		?>
          <div class="background-title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <?php break;
		  
		  case 'radio':?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content cont-layout">
            <?php
			 foreach ($value['options'] as $key=>$option) {
			 if ( get_option( $value['id'] ) != "")   {
			 if($key == get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";}
			} else {
			if($key == ($value['std'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }
			} ?>
            <div class="cont-layout-option">
              <input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> />
              <br/>
              <?php if($key == '1'){?>
              <img src="<?php echo get_template_directory_uri() . '/images/megnor/admin/header1.png' ?>" alt="" />
              <?php } ?>
              <?php if($key == '2'){?>
              <img src="<?php echo get_template_directory_uri() . '/images/megnor/admin/header2.png' ?>" alt="" />
              <?php } ?>
              <?php if($key == '3'){?>
              <img src="<?php echo get_template_directory_uri() . '/images/megnor/admin/header3.png' ?>" alt="" />
              <?php } ?>
              <?php if($key == '4'){?>
              <img src="<?php echo get_template_directory_uri() . '/images/megnor/admin/header4.png' ?>" alt="" />
              <?php } ?>
              <br/>
              <?php // echo $option; ?>
            </div>
            <?php } ?>
          </div>
          <?php	break;		
		
		   }
		$i++;
      }
?>
        </div>
        <!--form table-->
        <div class="submit">
          <input type="submit" value="Save Changes" class="button-primary" name="Submit" >
        </div>
      </form>
      <!-- reset Button -->
      <div class="reset-option">
        <form enctype="multipart/form-data" method="post" id="settingForm2" name="settingFormx"   >
          <p class="submit">
            <input type="hidden" name="reset2" value="reset2" />
            <input type="submit" value="Set Default" class="button-primary" name="reset"/>
          </p>
        </form>
      </div>
      <!-- End Reset Button -->
    </div>
    <!---#color-->
    <script type="text/javascript">
function Ajax(){

var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('tab_main').innerHTML=xmlHttp.responseText;
		return false;
	}
}
xmlHttp.send(null);
}
window.onload=function(){
}
</script>
    <!-- =========================================== Start Content Settings =========================================== -->
    <div id="Content">
      <form enctype="multipart/form-data" method="post" id="settingForm3" name="settingForm3" >
        <input type="hidden" name="action" value="save_options3" />
        <?php
	 if(!isset( $_REQUEST['action'])) {$_REQUEST['action']=''; }
	 if(!isset( $_REQUEST['reset3'])) {$_REQUEST['reset3']=''; }

       if ( 'save_options3' == $_REQUEST['action'] )
           {
 	    	foreach ($options3 as $value) {
	    	
				if(!isset( $value['id'] )) {$value['id']=''; }
				if(isset( $value['id'] ) && isset($_REQUEST[ $value['id'] ] )){
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
				}

			 }
 
	     } 
       else if( 'reset3' == $_REQUEST['reset3'] )
         {
 	     foreach ($options3 as $value) 
	     {
			 if(!isset( $value['id'] )) {$value['id']=''; }
			 delete_option( $value['id'] ); 
         }
      }
     ?>
        <div class="form-table">
        <div class="background-title">
          <label>
          <?php echo __('Content Settings', 'templatemela'); ?>
          </label>
        </div>
        <?php
        foreach ($options3 as $value) { 
	    switch ( $value['type'] ) {

		
		case 'select':
		
		?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <select class="select_input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
              <?php foreach ($value['options'] as $op_id => $suboption) { ?>
              <option value="<?php echo $op_id; ?>" <?php if (get_option($value['id']) == $op_id) { echo ' selected="selected"'; } ?>><?php echo $suboption; ?></option>
              <?php } ?>
            </select>
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <?php
		break;
		
		case 'textbox-3':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--odd-even-->
        <?php
		break;
		
		case 'textbox-1':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <?php if ( get_option( $value['id'] ) != "") { 
					$stylecolor =  stripslashes(get_option( $value['id'] )); 
					} else { 
					$stylecolor = stripslashes($value['std']); } 
					$stylecolor = 'style="background-color:#'.$stylecolor.'"'; ?>
            <input class="regular-text1" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" <?php echo $stylecolor; ?> />
            <span class="description"><?php echo $value['description']; echo get_option( $value['id']);?></span> </div>
        </div>
        <!--odd-even-->
        <?php
			
		break;
		case 'textbox':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
          <?php } else { ?>
          <div class="even setting_main">
            <?php }?>
            <div class="title">
              <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            </div>
            <div class="content">
              <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
              <span class="description"><?php echo $value['description']; echo get_option( $value['id']);?></span> </div>
          </div>
          <!--odd-even-->
          <?php
			
		break;
       }
     $i++;
    }
   ?>
        </div>
        <!--form-table-->
        <div class="submit">
          <input type="submit" value="Save Changes" class="button-primary" name="Submit" >
        </div>
      </form>
      <!-- reset Button -->
      <div class="reset-option">
        <form enctype="multipart/form-data" method="post" id="settingForm3" name="settingFormx" >
          <p class="submit">
            <input type="hidden" name="reset3" value="reset3" />
            <input type="submit" value="Set Default" class="button-primary" name="reset"/>
          </p>
        </form>
      </div>
      <!-- End Reset Button -->
    </div>
    <!--Font-->
    <!-- =========================================== Start Footer Settings =========================================== -->
    <div id="Footer">
      <form enctype="multipart/form-data" method="post" id="settingForm4" name="settingForm4"  >
        <input type="hidden" name="action" value="save_options4" />
        <?php
	 if(!isset( $_REQUEST['action'])) {$_REQUEST['action']=''; }
	 if(!isset( $_REQUEST['reset4'])) {$_REQUEST['reset4']=''; }

    if ( 'save_options4' == $_REQUEST['action'] )
     {
 		foreach ($options4 as $value) {
				if(!isset( $value['id'] )) {$value['id']=''; }
				if(isset( $value['id'] ) && isset($_REQUEST[ $value['id'] ] )){
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
				}

		}
	    } 
     else if( 'reset4' == $_REQUEST['reset4'] )
      {
 	    foreach ($options4 as $value) 
	     {
			 if(!isset( $value['id'] )) {$value['id']=''; }
			 delete_option( $value['id'] ); 
        }
      }
    ?>
        <div class="form-table">
        <div class="background-title">
          <label>
          <?php echo __('Footer Settings', 'templatemela'); ?>
          </label>
        </div>
        <?php
     foreach ($options4 as $value) { 
	if(!isset( $value['type'])) {$value['type']=''; }
	switch ( $value['type'] ) {
	
		case 'select':	?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <select class="select_input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
              <?php foreach ($value['options'] as $op_id => $suboption) { ?>
              <option value="<?php echo $op_id; ?>" <?php if (get_option($value['id']) == $op_id) { echo ' selected="selected"'; } ?>><?php echo $suboption; ?></option>
              <?php } ?>
            </select>
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--even-Odd-->
        <?php	break; //end Switch
		
		case 'textbox-3':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--odd-even-->
        <?php
		break;
		
		case 'textbox-1':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <?php if ( get_option( $value['id'] ) != "") { 
					$stylecolor =  stripslashes(get_option( $value['id'] )); 
					} else { 
					$stylecolor = stripslashes($value['std']); } 
					$stylecolor = 'style="background-color:#'.$stylecolor.'"'; ?>
            <input class="regular-text1" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" <?php echo $stylecolor; ?> />
            <span class="description"><?php echo $value['description']; echo get_option( $value['id']);?></span> </div>
        </div>
        <!--odd-even-->
        <?php
			
		break;
			
		
case 'texture': 
		
		?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }
	        $img_dir = get_template_directory_uri().'/images/megnor/admin/';
			?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <div class="tm_content">
              <div class="thumb-sel"> <img class="thumb" src="<?php if ( get_option( $value['id'] ) != ""){echo $img_dir.get_option($value['id']);}else{echo $img_dir.$value['std'];} ?>" /> <span id="switch" class="close"></span> </div>
              <div class="thumb-list">
                <ul>
                  <?php foreach ($value['options'] as $opt_key => $opt_val) { 
				if ( get_option( $value['id'] ) != "")   {
				if($opt_key == get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";}
				} else {
				if($opt_key == ($value['std'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }
				 } ?>
                  <li>
                    <input type="radio" name="<?php echo $value['id'] ?>" value="<?php echo $opt_key ?>" <?php echo $checked; ?>/>
                    <img class="thumb" src="<?php echo $img_dir.$opt_key ?>" title="<?php echo $opt_val ?>" /> </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <?php break;
	case 'upload': ?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input style=" <?php if($value['id'] != 'tmoption_background_upload') { echo 'display:none' ; } ?> " class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo get_option($value['id']); ?>" />
            <input id="upload_image_button1" class="button-primary" type="button" value="Upload Image" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--even odd setting-->
        <?php	break;
		case 'textbox':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
          <?php } else { ?>
          <div class="even setting_main">
            <?php }?>
            <div class="title">
              <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            </div>
            <div class="content">
              <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
              <span class="description"><?php echo $value['description']; ?></span> </div>
          </div>
          <!--odd-even-->
          <?php
			
		break;
		
		   }
		$i++;
      }
?>
        </div>
        <!--form table-->
        <div class="submit">
          <input type="submit" value="Save Changes" class="button-primary" name="Submit" >
        </div>
      </form>
      <!-- reset Button -->
      <div class="reset-option">
        <form enctype="multipart/form-data" method="post" id="settingForm4" name="settingFormx"   >
          <p class="submit">
            <input type="hidden" name="reset4" value="reset4" />
            <input type="submit" value="Set Default" class="button-primary" name="reset"/>
          </p>
        </form>
      </div>
      <!-- End Reset Button -->
    </div>
    <!---#color-->
    <!-- =========================================== End Footer Settings =========================================== -->
    <!-- =========================================== Start Portfolio Settings =========================================== -->
   <?php /*?> <div id="portfolio">
      <form enctype="multipart/form-data" method="post" id="settingForm5" name="settingForm5" >
        <input type="hidden" name="action" value="save_options5" />
        <?php
	if(!isset( $_REQUEST['action'])) {$_REQUEST['action']=''; }	
	if(!isset( $_REQUEST['reset5'])) {$_REQUEST['reset5']=''; }	
	
       if ( 'save_options5' == $_REQUEST['action'] )
        {
 	    	foreach ($options5 as $value) {
	    	
				if(!isset( $value['id'] )) {$value['id']=''; 
				if(isset( $value['id'] ) && isset($_REQUEST[ $value['id'] ] )){
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
				}

			} 
	     } 
       else if( 'reset5' == $_REQUEST['reset5'] )
         {
 	     foreach ($options5 as $value) 
	     {
			 if(!isset( $value['id'] )) {$value['id']=''; }
			 delete_option( $value['id'] ); 
         }
      }
     ?>
        <div class="form-table">
        <div class="background-title">
          <label>
          <?php echo __('Portfolio Settings', 'templatemela'); ?>
          </label>
        </div>
        <?php
        foreach ($options5 as $value) { 
if(!isset( $value['type'])) {$value['type']=''; }	
	    switch ( $value['type'] ) {
	
	case 'textbox':?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
        <?php } else { ?>
        <div class="even setting_main">
          <?php }?>
          <div class="title">
            <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
          </div>
          <div class="content">
            <input class="regular-text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
            <span class="description"><?php echo $value['description']; ?></span> </div>
        </div>
        <!--odd-even-->
        <?php break;
		
	case 'select':	
		?>
        <?php if( $i % 2 != 0) { ?>
        <div class="odd setting_main">
          <?php } else { ?>
          <div class="even setting_main">
            <?php }?>
            <div class="title">
              <label for="<?php echo $value['id']; ?>"><?php echo $value['label']; ?></label>
            </div>
            <div class="content">
              <select class="select_input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $op_id => $suboption) { ?>
                <option value="<?php echo $op_id; ?>" <?php if (get_option($value['id']) == $op_id) { echo ' selected="selected"'; } ?>><?php echo $suboption; ?></option>
                <?php } ?>
              </select>
              <span class="description"><?php echo $value['description']; ?></span> </div>
          </div>
          <?php
		break;
       }
     $i++;
    }
   ?>
        </div>
        <!--form-table-->
        <div class="submit">
          <input type="submit" value="Save Changes" class="button-primary" name="Submit" >
        </div>
      </form>
      <!-- reset Button -->
      <div class="reset-option">
        <form enctype="multipart/form-data" method="post" id="settingForm5" name="settingFormx" >
          <p class="submit">
            <input type="hidden" name="reset5" value="reset5" />
            <input type="submit" value="Set Default" class="button-primary" name="reset"/>
          </p>
        </form>
      </div>
      <!-- End Reset Button -->
    </div>
    <div id="ajax-response"></div>
    <br class="clear">
  </div>
</div>
<div id="ajax-response"></div>
<?php */?>