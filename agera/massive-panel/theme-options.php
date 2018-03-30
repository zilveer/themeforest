<?php
/*-----------------------------------------------------------------------------------*/
/*	This is a setup file for Massive Panel
/*-----------------------------------------------------------------------------------*/

function mp_options() {

	$shortname = "agera";
    // Sidebar Array
    $sidebar_array = array("left" => "Left", "right" => "Right", "none" => "None");
    $template_root = get_template_directory_uri();

    // Socials Array
    $social_array = array(
        "email" => array("email.png", "email us", "support@mpcreation.pl"),
        "dirbbble" => array("dribbble.png", "dribbble", "http://dribbble.com/mpc"),
        "forrst" => array("forrst.png", "forrst", "http://forrst.com/people/mpc"),
        "facebook" => array("facebook.png", "facebook", "http://www.facebook.com/MassivePixelCreation"),
        "twitter" => array("twitter.png", "twitter", "http://twitter.com/#!/mpcreation"),
        "blog" => array("website.png", "blog", "http://www.blog.mpcreation.pl"),
        // "documentation" => array("documentation.png", "http://www.mpcreation.pl/themeforest/documentation/agera/", ""),
        "forums" => array("forums.png", "support forums", "http://www.support.mpcreation.pl"));

    //number of footer columns
    $number_of_columns = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5');

    // this array is used for images example (first attribute of the image is used as a description for the image, the second is the path
    $images_array = array("Agera Original" => "patterns/header/p1.png",
        "Pattern 2" => "patterns/header/p2.png",
        "Pattern 3" => "patterns/header/p3.png",
        "Pattern 4" => "patterns/header/p4.png",
        "Pattern 5" => "patterns/header/p5.png",
        "Pattern 6" => "patterns/header/p6.png",
        "Pattern 7" => "patterns/header/p7.png",
        "Pattern 8" => "patterns/header/p8.png",
        "Pattern 9" => "patterns/header/p9.png",
        "Pattern 10" => "patterns/header/p10.png",
		"Pattern 11" => "patterns/header/p11.png",
        "No Pattern" => "patterns/p12.png");

    $images_footer_array = array("Agera Original" => "patterns/p1-original.jpg",
	"Patern 1" => "patterns/p1.png",
        "Pattern 2" => "patterns/p2.png",
        "Pattern 3" => "patterns/p3.png",
        "Pattern 4" => "patterns/p4.png",
        "Pattern 5" => "patterns/p5.png",
        "Pattern 6" => "patterns/p6.png",
        "Pattern 7" => "patterns/p7.png",
        "Pattern 8" => "patterns/p8.png",
        "Pattern 9" => "patterns/p9.png",
        "Pattern 10" => "patterns/p10.png",
		"Pattern 11" => "patterns/p10.png",
        "No Pattern" => "patterns/p12.png");


    // This array is only used as an example
    $test_array = array("one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");
	$lbox_or_link_array = array("lightbox" => "Lightbox","post_link" => "Link to Post");

    // this array is used for the portfolio module
    $columns_array = array("1" => "1", "2" => "2", "3" => "3", "4" => "4");

   // Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the portfolio categories into an array
    $portfolio_categories = array();
   // $portfolio_categories = $options_categories;
    $portfolio_categories_obj = get_categories(array(
                    'taxonomy' => 'portfolio_cat',
                    'hide_empty' => 0
                     ));
    /*print_r($portfolio_categories_obj);*/
	if($portfolio_categories_obj != null){
		foreach ($portfolio_categories_obj as $category) {
			$portfolio_categories[$category->slug] = $category->cat_name;
		}
    }

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}

	// Options for single page - Portfolio and Blog
	$options_single = array("blog" => "Blog", "portfolio" => "Portfolio");


	// Pull all the pages that are type protfolio
	$portfolio_pages = array();
	$portfolio_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$portfolio_pages[''] = 'Select a page:';
	foreach ($portfolio_pages_obj as $page) {
		if(get_post_meta( $page->ID, '_wp_page_template', true) == "portfolio.php" || get_post_meta( $page->ID, '_wp_page_template', true) == "portfolio-no-flip.php") // nazwe default zmieniamy na nazwe template naprzyklad portfolio.php
    		$portfolio_pages[$page->ID] = $page->post_title;
	}


    $options = array();

	// General section
	$options[] = array( "name" => "General", // When option is type section that mean that it will be displayed as button on the left
						"icon" => "settings.png", // icon has to be placed in massive-panel/images/icons folder
						"type" => "section");

	$options[] = array( "name" => "Main Settings", // Options of type heading represent tabs for sections
						"type" => "heading");


	$options[] = array( "name" => "Image Logo",
					"desc" => "Choose image (jpeg, jpg, gif, png) which will be displayed as your logo.",
					"desc-pos" => "top",
					"id" => $shortname."_image_logo",
					"type" => "upload",
					"std" => $template_root.'/images/logo.png',
					"hide" => array(
							"state" => "true",
							"desc" => "To display bitmap logo in the header of your website use this option.",
							"related" => $shortname."_logo_link",
							"std" => "checked"
						)
					);

	$options[] = array( "name" => "Add Text Logo", // this defines the heading of the option
						"desc" => "Here you need to type the text that will be displayed as your logo.", // this is the field/option description
						"desc-pos" => "top", // choose position of the description (top, right, bottom)
						"id"   => $shortname."_logo_link", // the id must be unique, it is used to call back the propertie inside the theme
						"std"  => "", // deafult value of the text
						"help" => "false", // should the help icon be displayed (not working yet, better add this to your settings)
						"help-desc"  => "This is some help text", // text for the help tool tip
						"validation" => "nohtml", /* Each text field can be specialy validated, if the text wont be using HTML tags you can choose here 'nohtml' ect. Choose Between: numeric, multinumeric, nohtml, url, email or dont set it for standard  validation*/
						"type" => "text-big",
						"hide" => array(
								"state" => "true",
								"desc" => "To use simple text as website logo, use this option.",
								"related" => $shortname."_image_logo"
								)

						);

	$options[] = array( "name" => "Search Text", // this defines the heading of the option
						"desc" => "Please type the text that will be displayed in the header search field.", // this is the field/option description
						"id"   => $shortname."_search_text", // the id must be unique, it is used to call back the propertie inside the theme
						"std"  => "Search", // deafult value of the text
						"help" => "false", // should the help icon be displayed (not working yet, better add this to your settings)
						"help-desc"  => "This is some help text", // text for the help tool tip
						"validation" => "nohtml", /* Each text field can be specialy validated, if the text wont be using HTML tags you can choose here 'nohtml' ect. Choose Between: numeric, multinumeric, nohtml, url, email or dont set it for standard  validation*/
						"type" => "text-small");

	$options[] = array( "name" => "Copyright Text",
						"desc" => "This field specifies the copyright text that will be displayed in the special footer widget.",
						"id" => $shortname."_copyright_text",
						"std" => "&#169; 2012 Agera, All Rights Reserved MassivePixelCreation",
						"help" => "false",
						"help-desc"  => "This is some help text",
						"validation" => "",
						"type" => "textarea");

	$options[] = array( "name" => "404 Page Background",
					"desc" => "Choose image (jpeg, jpg, gif, png) which will be displayed as your logo.",
					"desc-pos" => "top",
					"id" => $shortname."_404",
					"type" => "upload",
					"std" => $template_root.'/images/orange.jpg',
					"hide" => array(
							"state" => "true",
							"desc" => "To display bitmap logo in the header of your website use this option.",
							"related" => $shortname."_404_bg",
							"std" => "checked"
						)
					);

	$options[] = array( "name" => "Archive Page Background",
					"desc" => "Choose image (jpeg, jpg, gif, png) which will be displayed as your logo.",
					"desc-pos" => "top",
					"id" => $shortname."_archive",
					"type" => "upload",
					"std" => $template_root.'/images/orange.jpg',
					"hide" => array(
							"state" => "true",
							"desc" => "To display bitmap logo in the header of your website use this option.",
							"related" => $shortname."_archive_bg",
							"std" => "checked"
						)
					);

	$options[] = array( "name" => "Footer Shown By Default",
					"desc" => "Specify if the footer should be shown by default.",
					"desc-pos" => "right",
					"id" => $shortname."_footer",
					"std" => "0",
					"type" => "checkbox");


	///////////////////////////////////////////////////////////////////////////


	$options[] = array( "name" => "Color Template", // Options of type heading represent tabs for sections
						"type" => "heading");

	$options[] = array( "name" => "Body Color",
						"desc" => "This is the main color for the text and other body parts",
						"help" => "false",
						"help-desc"  => "This is some help text",
						"id" => $shortname."_body_color",
						"std" => "#515151",
						"type" => "color");

	$options[] = array( "name" => "Menu Font Color",
						"desc" => "This value specifies menu font color",
						"help" => "false",
						"help-desc"  => "This is some help text",
						"id" => $shortname."_menu_color",
						"std" => "#414141",
						"type" => "color");

	$options[] = array( "name" => "Menu Font Color Selected",
						"desc" => "This value specifies menu font color when item is selected.",
						"help" => "false",
						"help-desc"  => "This is some help text",
						"id" => $shortname."_menu_selected_color",
						"std" => "#ffffff",
						"type" => "color");

	$options[] = array( "name" => "Active Color",
					"desc" => "This is the alternative color which is used for links and other active areas.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_active_color",
					"std" => "#F9625B",
					"type" => "color");

	$options[] = array( "name" => "Heading Color",
					"desc" => "This color value is used for heading.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_heading_color",
					"std" => "#313131",
					"type" => "color");

	$options[] = array( "name" => "Header Background Color",
					"desc" => "This value specifies the color of header background.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_header_color",
					"std" => "#ffffff",
					"type" => "color");

	$options[] = array( "name" => "Background Color",
					"desc" => "This value specifies the color of page background.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_color",
					"std" => "#ffffff",
					"type" => "color");

	$options[] = array( "name" => "Footer Background Color",
					"desc" => "This value specifies the color of footer background.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_footer_color",
					"std" => "#ffffff",
					"type" => "color");

	$options[] = array( "name" => "Portfolio Back Font Color",
					"desc" => "This value specifies the color of portfolio text after hover.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_back_folio_color",
					"std" => "#ffffff",
					"type" => "color");


	$options[] = array( "name" => "Portfolio Filter Background Color",
					"desc" => "This value specifies the color of portfolio filter background.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_folio_color",
					"std" => "#f5f5f5",
					"type" => "color");

	$options[] = array( "name" => "Post Meta Background Color",
					"desc" => "This value specifies the color of portfolio filter background.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_meta_color",
					"std" => "#f8f8f8",
					"type" => "color");

	$options[] = array( "name" => "HR lines Color",
					"desc" => "This value specifies the color of each hr line (for example those under each heading) .",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_hr_color",
					"std" => "#e9e9e9",
					"type" => "color");

	$options[] = array( "name" => "Post Meta Heading Color",
						"desc" => "This value specifies post meta heading color",
						"help" => "false",
						"help-desc"  => "This is some help text",
						"id" => $shortname."_meta_heading_color",
						"std" => "#414141",
						"type" => "color");


	$options[] = array( "name" => "Contact Form Background Color",
					"desc" => "This value specifies the color of contact form & comment form inputs background.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_color",
					"std" => "#f8f8f8",
					"type" => "color");

	$options[] = array( "name" => "Contact Form Text Color",
					"desc" => "This value specifies the color of contact form & comment form inputs text.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_text_contact_color",
					"std" => "#616161",
					"type" => "color");

	$options[] = array( "name" => "Contact Form Background Color on Focus",
					"desc" => "This value specifies the color of contact form & comment form inputs background on focus.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_focus_color",
					"std" => "#f0f0f0",
					"type" => "color");

	$options[] = array( "name" => "Contact Form Background Color on Error",
					"desc" => "This value specifies the color of contact form & comment form inputs background on error.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_error_color",
					"std" => "#F9625B",
					"type" => "color");

	$options[] = array( "name" => "Contact Form Label Color on Error",
					"desc" => "This value specifies the color of contact form & comment form labels on error.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_labels_error_color",
					"std" => "#F9625B",
					"type" => "color");

	$options[] = array( "name" => "Contact Form Text Color on Error",
					"desc" => "This value specifies the color of contact form & comment form text on error.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_contact_error_color",
					"std" => "#FFFFFF",
					"type" => "color");

	$options[] = array( "name" => "Contact Form Submit Button Background",
					"desc" => "This value specifies the color of contact form & comment form submit button background.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_submit",
					"std" => "#F9625B",
					"type" => "color");

	$options[] = array( "name" => "Contact Form Submit Button Text",
					"desc" => "This value specifies the color of contact form & comment form submit button text.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_color_contact_submit",
					"std" => "#FFFFFF",
					"type" => "color");

	$options[] = array( "name" => "Contact Form Submit Button Background on Hover",
					"desc" => "This value specifies the color of contact form & comment form submit button background on hover.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_submit_hover",
					"std" => "#F9625B",
					"type" => "color");

	$options[] = array( "name" => "Contact Form Submit Button Text on Hover",
					"desc" => "This value specifies the color of contact form & comment form submit button text on hover.",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_color_contact_submit_hover",
					"std" => "#242424",
					"type" => "color");


	$options[] = array( "name" => "Highlight Background Color",
					"desc" => "This color is used as highlight background color",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_highlight_color",
					"std" => "#F9625B",
					"type" => "color");

	$options[] = array( "name" => "Highlight Text Color",
					"desc" => "This color is used as highlight text color",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"id" => $shortname."_highlight_text_color",
					"std" => "#ffffff",
					"type" => "color");


	////////////////////////////////////////////

		$options[] = array( "name" => "Comments",
							"type" => "heading");



		$options[] = array( "name" => "Comment Name Error",
							"desc" => "This option lets you customize the message displayed when there is a name error.",
							"id" => $shortname."_comment_name_error",
							"std" => "Please enter a valid name.",
							"type" => "text-small");

		$options[] = array( "name" => "Comment Email Error",
							"desc" => "This option lets you customize the message displayed when there is a email error.",
							"id" => $shortname."_comment_email_error",
							"std" => "Please enter a valid email.",
							"type" => "text-small");

		$options[] = array( "name" => "Comment Comment Error",
							"desc" => "This option lets you customize the message displayed when there is a comment error.",
							"id" => $shortname."_comment_comment_error",
							"std" => "Your comment must be at least 5 charcters long.",
							"type" => "text-small");

	////////////////////////////////////////////////////////////////////////////

	$options[] = array( "name" => "Portfolio", // Options of type heading represent tabs for sections
						"icon" => "portfolio.png",
						"type" => "section");

	$options[] = array( "name" => "Main", // Options of type heading represent tabs for sections
						"type" => "heading");

	$options[] = array("name" => "Setup Portfolio",
               	"desc" => "Please choose portoflio page you wish to setup, then please select the number of columns you would like to display and finaly choose categories you want to display.",
                "desc-pos" => "top",
                "id" => $shortname."_portfolio",
                "std" => '',
                "portfolio-pages" => $portfolio_pages,
                "desc-portfolio-page" => "Choose Portfolio page you wish to setup.",
                "options-categories" => $portfolio_categories,
                "desc-categories" => "Choose portfolio categories you would like to display on your page.",
                "options-columns" => $columns_array,
                "desc-columns"	=> "Choose number of columns you want to display.",
                "options-radio" => $sidebar_array,
                "desc-posts" => "Choose number of portfolio items you would like to display per page.",
                "type" => "choose-portfolio");

	// Contact section
	$options[] = array( "name" => "Contact", // When option is type section that mean that it will be displayed as button on the left
						"icon" => "phone.png", // icon has to be placed in massive-panel/images/icons folder
						"type" => "section");

	$options[] = array( "name" => "Contact Form", // Options of type heading represent tabs for sections
						"type" => "heading");

	$options[] = array( "name" => "Contact Form Email", // this defines the heading of the option
					"desc" => "Specify your contact email.", // this is the field/option description
					"id"   => $shortname."_contact_email", // the id must be unique, it is used to call back the propertie inside the theme
					"std"  => "", // deafult value of the text
					"help" => "false", // should the help icon be displayed (not working yet, better add this to your settings)
					"help-desc"  => "This is some help text", // text for the help tool tip
					"validation" => "nohtml", /* Each text field can be specialy validated, if the text wont be using HTML tags you can choose here 'nohtml' ect. Choose Between: numeric, multinumeric, nohtml, url, email or dont set it for standard  validation*/
					"type" => "text-small");

	$options[] = array( "name" => "Name",
						"desc" => "This option lets you customize the label inside the Name field.",
						"id" => $shortname."_cf_name",
						"std" => "Name",
						"type" => "text-small");

	$options[] = array( "name" => "Email",
						"desc" => "This option lets you customize the label inside the Email field.",
						"id" => $shortname."_cf_email",
						"std" => "Email",
						"type" => "text-small");

	$options[] = array( "name" => "Message",
						"desc" => "This option lets you customize the label inside the Message field.",
						"id" => $shortname."_cf_message",
						"std" => "Message",
						"type" => "text-small");

	$options[] = array( "name" => "Send Button",
						"desc" => "This option lets you customize the label of send button.",
						"id" => $shortname."_cf_send",
						"std" => "Send",
						"type" => "text-small");

	$options[] = array( "name" => "Name Error",
						"desc" => "This option lets you customize the message displayed when there is a name error.",
						"id" => $shortname."_cf_name_error",
						"std" => "Please enter a valid name.",
						"type" => "text-small");

	$options[] = array( "name" => "Email Error",
						"desc" => "This option lets you customize the message displayed when there is an email error.",
						"id" => $shortname."_cf_email_error",
						"std" => "Please enter a valid email address.",
						"type" => "text-small");

	$options[] = array( "name" => "Message Error",
						"desc" => "This option lets you customize the message displayed when there is a message error.",
						"id" => $shortname."_cf_message_error",
						"std" => "Message must be at least 5 characters.",
						"type" => "text-small");

	$options[] = array( "name" => "Message Sent",
						"desc" => "This option lets you customize the message displayed when the message is successfully sent.",
						"id" => $shortname."_cf_success",
						"std" => "Thank you, message was successfully sent.",
						"type" => "text-small");

	$options[] = array( "name" => "Message Not Sent",
						"desc" => "This option lets you customize the message displayed when the message is not sent.",
						"id" => $shortname."_cf_error",
						"std" => "There was an error submitting the form.",
						"type" => "text-small");


	////////////////////////////////////////////////////////////////


	// Social Networks section
	$options[] = array( "name" => "Social Networks", // When option is type section that mean that it will be displayed as button on the left
						"icon" => "wire.png", // icon has to be placed in massive-panel/images/icons folder
						"type" => "section");

	$options[] = array( "name" => "Social Icons", // Options of type heading represent tabs for sections
						"type" => "heading");

	$options[] = array( "name" => "Facebook Icon",
						"desc" => "Choose this option if you want to display Facebook Icon in the footer.",
						"id" => $shortname."_facebook_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Facebook Link",
					"desc" => "Specify Facebook account url.",
					"id"   => $shortname."_facebook_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Twitter Icon",
						"desc" => "Choose this option if you want to display Twitter Icon in the footer.",
						"id" => $shortname."_twitter_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Twitter Link",
					"desc" => "Specify Twitter account url.",
					"id"   => $shortname."_twitter_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Google+ Icon",
						"desc" => "Choose this option if you want to display Google+ Icon in the footer.",
						"id" => $shortname."_google_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Google+ Link",
					"desc" => "Specify Google+  account url.",
					"id"   => $shortname."_google_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "RSS Icon",
						"desc" => "Choose this option if you want to display RSS Icon in the footer.",
						"id" => $shortname."_rss_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "RSS Link",
					"desc" => "Specify RSS url.",
					"id"   => $shortname."_rss_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Dribbble Icon",
						"desc" => "Choose this option if you want to display Dribbble Icon in the footer.",
						"id" => $shortname."_dribbble_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Dribbble Link",
					"desc" => "Specify Dribbble account url.",
					"id"   => $shortname."_dribbble_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Vimeo Icon",
						"desc" => "Choose this option if you want to display Vimeo Icon in the footer.",
						"id" => $shortname."_vimeo_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Vimeo Link",
					"desc" => "Specify Vimeo account url.",
					"id"   => $shortname."_vimeo_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Forrst Icon",
						"desc" => "Choose this option if you want to display Forrst Icon in the footer.",
						"id" => $shortname."_forrst_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Forrst Link",
					"desc" => "Specify Forrst account url.",
					"id"   => $shortname."_forrst_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Flickr Icon",
						"desc" => "Choose this option if you want to display Flickr Icon in the footer.",
						"id" => $shortname."_flickr_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Flickr Link",
					"desc" => "Specify Flickr account url.",
					"id"   => $shortname."_flickr_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Deviant Art Icon",
						"desc" => "Choose this option if you want to display Deviant Art Icon in the footer.",
						"id" => $shortname."_deviant_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Deviant Art Link",
					"desc" => "Specify Deviant Art account url.",
					"id"   => $shortname."_deviant_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Digg Icon",
						"desc" => "Choose this option if you want to display Digg Icon in the footer.",
						"id" => $shortname."_digg_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Digg Link",
					"desc" => "Specify Digg account url.",
					"id"   => $shortname."_digg_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "LinkedIn Icon",
						"desc" => "Choose this option if you want to display LinkedIn Icon in the footer.",
						"id" => $shortname."_linkedin_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "LinkedIn Link",
					"desc" => "Specify LinkedIn account url.",
					"id"   => $shortname."_linkedin_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Picasa Icon",
						"desc" => "Choose this option if you want to display Picasa Icon in the footer.",
						"id" => $shortname."_picasa_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Picasa Link",
					"desc" => "Specify Picasa account url.",
					"id"   => $shortname."_picasa_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "StumbleUpon Icon",
						"desc" => "Choose this option if you want to display StumbleUpon Icon in the footer.",
						"id" => $shortname."_stumble_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "StumbleUpon Link",
					"desc" => "Specify StumbleUpon account url.",
					"id"   => $shortname."_stumble_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Instagram Icon",
						"desc" => "Choose this option if you want to display Instagram Icon in the footer.",
						"id" => $shortname."_instagram_icon",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Instagram Link",
					"desc" => "Specify Instagram account url.",
					"id"   => $shortname."_instagram_link",
					"std"  => "#",
					"help" => "false",
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	////////////////////////////////////////////



    // header settings, main heading and socials
    $options[] = array("name" => "Greetings, I am Massive Panel", // this is the main heading from thr header
        "desc" => "use me wisely to customize your theme.", // this is the line of description used in the header
        "type" => "top-header");

    $options[] = array("options" => $social_array,
        "type" => "top-socials");

    return $options;
}

/* ----------------------------------------------------------------------------------- */
/* 	Contextual Help
  /*----------------------------------------------------------------------------------- */

function mp_options_page_contextual_help() {
    $text = "<h3>" . __('Massive Panel Settings - Contextual Help', 'agera') . "</h3>";
    $text .= "<p>" . __('Contextual Help Goes Here', 'agera') . "</p>";

    return $text;
}

?>