<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */


function optionsframework_option_name() {
    
    // This gets the theme name from the stylesheet (lowercase and without spaces)    
    if (function_exists('wp_get_theme')) {
        $theme_data = wp_get_theme('theme-name');
        $themename  = $theme_data->Name;
    } else {
        $theme_data = wp_get_theme(STYLESHEETPATH . '/style.css');
        $themename  = $theme_data['Name'];
    }
    $themename = preg_replace("/\W/", "", strtolower($themename));
    
    $optionsframework_settings       = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
     
    // Pull all the pages into an array
    $options_pages     = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }
    
    // If using image radio buttons, define a directory path
    $imagepath     = get_stylesheet_directory_uri() . '/includes/images/';
    $imagecolor    = get_stylesheet_directory_uri() . '/admin/theme_options/images/color-style/';
    $imagepatterns = get_stylesheet_directory_uri() . '/admin/theme_options/images/patterns-style/';
    $imagelogo     = get_stylesheet_directory_uri() . '/images/logo.png';
    $imagefavicon  = get_stylesheet_directory_uri() . '/favicon.ico';
  
    $options[] = array(
        "name" => "General",
		"icon" => "general.png",
        "type" => "heading"
    );
	
	$options[] = array(
        "name" => "Ajax",
        "desc" => "Check the box to activate the music singing continuously.",
        "id" => "active_ajax",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Disable Responsive",
        "desc" => "Check the box for disable responsive.",
        "id" => "disable_responsive",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Player",
        "desc" => "Select type of player audio or radio.",
        "id" => "player_audio_radio",
        "std" => "player_none",
        "type" => "radio",
        "options" => array(
            'player_audio' => 'Audio',
            'player_radio' => 'Radio',
			'player_none' => 'None'
        )
    );
	
	$options[] = array(
        "name" => "Language of the event date",
        "desc" => "Please select the language of the event date.",
        "id" => "lang_event",
        "std" => "lang_EN",
        "type" => "select",
        "options" => array(
            "lang_EN" => "English",
            "lang_RO" => "Romanian",
            "lang_ES" => "Spanish",
            "lang_IT" => "Italian",
            "lang_PT" => "Portuguese",
            "lang_DE" => "German",
            "lang_NE" => "Dutch",
            "lang_FR" => "French",
        )
    );
	
    $options[] = array(
        "name" => "Logo",
        "desc" => "Maximum width: 200px and height: 50px.",
        "id" => "logo_upload",
        "std" => $imagelogo,
        "type" => "upload"
    );
    
    $options[] = array(
        "name" => "Favicon",
        "desc" => "Upload favicon, width:16px and height:16px.",
        "id" => "favicon_upload",
        "std" => $imagefavicon,
        "type" => "upload"
    );
		
	$options[] = array(
        "name" => "Copyright Text",
        "desc" => "Here you can write a text on Copyright.",
        "id" => "text_copyright",
        "std" => "",
        "type" => "textarea"
    );
	
    $options[] = array(
        "name" => "Style",
		"icon" => "style.png",
        "type" => "heading"
    );
	
	$options[] = array(
        "name" => "Style",
        "desc" => "Choose a style for theme.",
        "id" => "type_style",
        "std" => "dark",
        "type" => "radio",
        "options" => array(
            'dark' => 'Dark',
            'light' => 'Light'
        )
    );

	$options[] = array(
        "name" => "Theme Color",
        "desc" => "Choose a color for links and buttons.",
        "id" => "color_picker",
        "std" => "#00cab6",
        "type" => "color"
    );
    	
	$options[] = array(
        "name" => "Primary Font",
        "desc" => "Please write the name of the font from this site http://www.google.com/fonts",
        "id" => "font_pred",
        "std" => "Open Sans",
        "type" => "text",
    );
	
	$options[] = array(
        "name" => "Secondary Font",
        "desc" => "Please write the name of the font from this site http://www.google.com/fonts",
        "id" => "font_sec",
        "std" => "Titillium Web",
        "type" => "text",
    );
	
	$options[] = array(
        "name" => "Background",
        "desc" => "Select the type of background.",
        "id" => "type_background",
        "std" => "pattern",
        "type" => "radio",
        "options" => array(
            'pattern' => 'Pattern',
            'image' => 'Image'
        )
    );
    
    $options[] = array(
        "name" => "Background Pattern",
        "desc" => "Choose a pattern for background.",
        "id" => "patterns",
        "std" => "random_grey_variations",
        "type" => "images",
        "options" => array(
            'clubber' => $imagepatterns . 's_clubber.png',
            'px_by_Gre3g' => $imagepatterns . 's_px_by_Gre3g.png',
            'random_grey_variations' => $imagepatterns . 's_random_grey_variations.png',
            'irongrip' => $imagepatterns . 's_irongrip.png',
            'darkdenim3' => $imagepatterns . 's_darkdenim3.png',
            'pinstriped_suit' => $imagepatterns . 's_pinstriped_suit.png',
            'tex2res4' => $imagepatterns . 's_tex2res4.png',
            'wild_oliva' => $imagepatterns . 's_wild_oliva.png'
        )
    );
    
    $options[] = array(
        "name" => "Background Image",
        "desc" => "",
        "id" => "background_upload",
        "type" => "upload"
    );
    
	    $options[] = array(
        "name" => "Template",
		"icon" => "template.png",
        "type" => "heading"
    );

	$options[] = array(
        "name" => "Feature in Footer",
        "desc" => "Check the box to activate rotative feature.",
        "id" => "active_feature",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Feature Number Posts",
        "desc" => "Enter number of posts here.",
        "id" => "feature_number",
        "std" => "6",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Header Features",
        "desc" => "Select features in header.",
        "id" => "header_feat",
        "std" => "header_none",
        "type" => "radio",
        "options" => array(
            'header_none' => 'None',
            'header_event' => 'Event',
            'header_banner' => 'Banner'
        )
    );
	
	$options[] = array(
        "name" => "Banner CODE",
        "desc" => "Enter your banner code.",
        "id" => "banner_code",
        "std" => "",
        "type" => "textarea"
    );
	
	$options[] = array(
        "name" => "Search in Header",
        "desc" => "Check the box to activate search in header.",
        "id" => "active_search",
        "std" => "0",
        "type" => "checkbox"
    );

	$options[] = array(
        "name" => "Social Media in Single Page",
        "desc" => "Check the box to activate Social Media in single blog.",
        "id" => "social_sng",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Previous&Next Link Posts",
        "desc" => "Check the box to activate Previous&Next posts in single blog.",
        "id" => "active_link",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Author Information",
        "desc" => "Check the box to activate author information in single blog.",
        "id" => "active_author",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Sidebar for Archive Page",
        "desc" => "Select right/left sidebar.",
        "id" => "sidebar_archive",
        "std" => "right-sidebar",
        "type" => "images",
        "options" => array(
            'left-sidebar' => $imagepath . 'OPTsidebar-left.png',
            'right-sidebar' => $imagepath . 'OPTsidebar-right.png'
        )
    );
	
	$options[] = array(
        "name" => "Audio",
        "icon" => "audio.png",
        "type" => "heading"
    );

    $options[] = array(
        "name" => "Default Player ",
        "desc" => "Select an option for the default player, we find in the home page.",
        "id" => "player_default",
        "std" => "audio",
        "type" => "radio",
        "options" => array(
            'audio' => 'Audio ID',
            'soundcloud' => 'SoundCloud'
        )
    );
	
	$options[] = array(
        "name" => "Audio ID",
        "desc" => "Enter the audio post ID to display the whole album on home page.",
        "id" => "player_id",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "SoundCloud",
        "desc" => "Enter link on SoundCloud to display on home page.",
        "id" => "player_soundcloud",
        "std" => "",
        "type" => "text"
    );
	
    $options[] = array(
        "name" => "AutoPlay",
        "desc" => "Select on or off.",
        "id" => "player_autoplay",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Player: visible/hidden",
        "desc" => "Select visible or hidden.",
        "id" => "player_opened",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'Visible',
            'false' => 'Hidden'
        )
    );
    
    $options[] = array(
        "name" => "Play Next When Finished",
        "desc" => "Select on or off.",
        "id" => "player_next",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
	
	
	$options[] = array(
        "name" => "Radio",
        "icon" => "radio.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Stream IP/Domain",
        "desc" => "Enter the IP or the domain with the port. eg: 81.92.219.14:8047",
        "id" => "radio_ip",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "AutoPlay",
        "desc" => "Select on or off.",
        "id" => "radio_autoplay",
        "std" => "TRUE",
        "type" => "radio",
        "options" => array(
            'TRUE' => 'On',
            'FALSE' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Slider",
		"icon" => "slider.png",
        "type" => "heading"
    );
	
    $options[] = array(
        "name" => "Slide Dealy",
        "desc" => "Milliseconds between slider transitions.",
        "id" => "slide_delay",
        "std" => "10000",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Animation Speed",
        "desc" => "The value in ms how long the animation.",
        "id" => "slide_animation",
        "std" => "15000",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Transition Effects",
        "desc" => "The appearance transition of this slide.",
        "id" => "slide_effects",
        "std" => "random",
        "type" => "select",
        "options" => array(
            'random' => 'Random',
            'fade' => 'Fade',
            'boxfade' => 'Fade Boxes',
			'zoomout' => 'ZoomOut',
			'zoomin' => 'ZoomIn',
			'cube' => 'Cube',
			'flyin' => 'Fly In'
        )
    );
	
	$options[] = array(
        "name" => "Social Accounts",
		"icon" => "social.png",
        "type" => "heading"
    );
	
	$options[] = array(
        "name" => "[Twitter] Account",
        "desc" => "Please enter your username twitter account. You can sign up for a API key <a href='https://dev.twitter.com/' target='_blank'>here</a>",
        "id" => "twitter_account",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "[Twitter] Consumer key",
        "desc" => "Please enter consumer key.",
        "id" => "twitter_consumer_key",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "[Twitter] Consumer secret",
        "desc" => "Please enter consumer secret.",
        "id" => "twitter_consumer_secret",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "[Twitter] Access token",
        "desc" => "Please enter access token.",
        "id" => "twitter_access_token",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "[Twitter] Access token secret",
        "desc" => "Please enter Access token secret.",
        "id" => "twitter_access_secret",
        "std" => "",
        "type" => "text"
    );
	
    $options[] = array(
        "name" => "Social Settings",
		"icon" => "social.png",
        "type" => "heading"
    );
	
	$options[] = array(
        "name" => "Social Header",
        "desc" => "Check the box to activate social icons in header.",
        "id" => "social_header",
        "std" => "0",
        "type" => "checkbox"
    );
	
	$options[] = array(
        "name" => "Logo Social Footer",
        "desc" => "Check the box to activate social icons in footer.",
        "id" => "social_footer",
        "std" => "0",
        "type" => "checkbox"
    );
	
    $options[] = array(
        "name" => "Facebook",
        "desc" => "Input facebook link.",
        "id" => "facebook",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Twitter",
        "desc" => "Input Twitter link.",
        "id" => "twitter",
        "std" => "",
        "type" => "text"
    );
    
	$options[] = array(
        "name" => "Vimeo",
        "desc" => "Input Vimeo link.",
        "id" => "vimeo",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "YouTube",
        "desc" => "Input YouTube link.",
        "id" => "youtube",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Soundcloud",
        "desc" => "Input Soundcloud link.",
        "id" => "soundcloud",
        "std" => "",
        "type" => "text"
    ); 

    $options[] = array(
        "name" => "Flickr",
        "desc" => "Input Flickr link.",
        "id" => "flickr",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Google +",
        "desc" => "Input Google + link.",
        "id" => "google",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "LinkedIN",
        "desc" => "Input LinkedIN link.",
        "id" => "linkedin",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Custom CSS",
		"icon" => "custom.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Custom CSS",
        "desc" => "Paste in your custom css here. Please avoid altering the original css files as it'll cause problems when you update the theme. ",
        "id" => "custom_css",
        "std" => "",
        "type" => "textarea"
    );
    
    $options[] = array(
        "name" => "Contact",
		"icon" => "contact.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Email Address",
        "desc" => "Enter the email address where the email from the contact form should be sent to.",
        "id" => "email_adress",
        "std" => "my@email.com",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Subject",
        "desc" => "Enter the subject for messages that are sent via the contact form.",
        "id" => "email_subject",
        "std" => "contact form mail",
        "type" => "text"
    );
    
    return $options;
}