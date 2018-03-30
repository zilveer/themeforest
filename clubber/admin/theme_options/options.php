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
    
    // Pull all the categories into an array
    $options_categories     = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }
    
    // Pull all the pages into an array
    $options_pages     = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }
    
    // If using image radio buttons, define a directory path
    $imagepath     = get_stylesheet_directory_uri() . '/admin/theme_options/images/';
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
        "name" => "Language of the Date",
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
        "name" => "Responsive",
        "desc" => "Check the box to activate responsive for site.",
        "id" => "active_resp",
        "std" => "0",
        "type" => "checkbox"
    );
	
    $options[] = array(
        "name" => "Logo",
        "desc" => "Maximum width:300px and height:100px.",
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
        "name" => "Google Analytics CODE",
        "desc" => "Enter your Google Analytics or other tracking code here.",
        "id" => "analytics_code",
        "std" => "",
        "type" => "textarea"
    );

    $options[] = array(
        "name" => "Template",
		"icon" => "template.png",
        "type" => "heading"
    );

    $options[] = array(
        "name" => "Homepage slide",
        "desc" => "Check the box to activate slider.",
        "id" => "active_slide",
        "std" => "0",
        "type" => "checkbox"
    );
    
    $options[] = array(
        "name" => "Number of Slides",
        "desc" => "Enter number of slides here.",
        "id" => "nr_slide",
        "std" => "5",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Slide delay",
        "desc" => "Milliseconds between slide transitions.",
        "id" => "seconds_slide",
        "std" => "5000",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Player: AutoPlay",
        "desc" => "Select on/off",
        "id" => "audio_auto",
        "std" => "off_play",
        "type" => "radio",
        "options" => array(
		    "on_play" => "On",
			"off_play" => "Off"
		)
    );
    
    $options[] = array(
        "name" => "Sidebar Layout for Single Page Blog",
        "desc" => "Select right/left sidebar.",
        "id" => "blog_images",
        "std" => "right-blog-sidebar",
        "type" => "images",
        "options" => array(
            'left-blog-sidebar' => $imagepath . 'left-sidebar.png',
            'right-blog-sidebar' => $imagepath . 'right-sidebar.png'
        )
    );

    $options[] = array(
        "name" => "Sidebar Layout for Single Page Events",
        "desc" => "Select right/left sidebar.",
        "id" => "event_images",
        "std" => "right-event-sidebar",
        "type" => "images",
        "options" => array(
            'left-event-sidebar' => $imagepath . 'left-sidebar.png',
            'right-event-sidebar' => $imagepath . 'right-sidebar.png'
        )
    );
     
    $options[] = array(
        "name" => "Number of Videos per page",
        "desc" => "Enter number of Videos here.",
        "id" => "nr_videos",
        "std" => "8",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Number of Audio per page",
        "desc" => "Enter number of Audio here.",
        "id" => "nr_audio",
        "std" => "8",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Number of Photos per page",
        "desc" => "Enter number of Photos here.",
        "id" => "nr_photos",
        "std" => "8",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Number of Events per page",
        "desc" => "Enter number of Events here.",
        "id" => "nr_events",
        "std" => "5",
        "type" => "text"
    );
  
    $options[] = array(
        "name" => "Style",
		"icon" => "style.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Style",
        "desc" => "Choose a style for theme.",
        "id" => "style_pred",
        "std" => "dark_style",
        "type" => "radio",
        "options" => array(
			"dark_style" => "Dark",
			"light_style" => "Light"
		)
    );
    
    $options[] = array(
        "name" => "Theme Color",
        "desc" => "Choose a color for links and buttons.",
        "id" => "color",
        "std" => "02c0f8",
        "type" => "images",
        "options" => array(
            '02c0f8' => $imagecolor . '02c0f8.png',
            '18cecf' => $imagecolor . '18cecf.png',
            'ff0000' => $imagecolor . 'ff0000.png',
            'fdb813' => $imagecolor . 'fdb813.png',
            'ef65a3' => $imagecolor . 'ef65a3.png',
            'ff1190' => $imagecolor . 'ff1190.png',
            'f75c46' => $imagecolor . 'f75c46.png',
            '888888' => $imagecolor . '888888.png'
        )
    );
    
    $options[] = array(
        "name" => "Fonts",
        "desc" => "Choose a font for your Headings, Buttons and Menu.",
        "id" => "font_pred",
        "std" => "Dosis",
        "type" => "select",
        "options" => array(
		    "Dosis" => "Dosis (default)",
			"Cuprum" => "Cuprum",
			"Amaranth" => "Amaranth",
			"Signika" => "Signika",
			"Anaheim" => "Anaheim",
			"Titillium Web" => "Titillium Web",
			"Gudea" => "Gudea",
			"Signika Negative" => "Signika Negative",
			"Port Lligat Sans" => "Port Lligat Sans",
			"Gentium Basic" => "Gentium Basic"
		)
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
        "std" => "clubber",
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
        "name" => "Photo (lightbox)",
		"icon" => "photo.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Animation Speed",
        "desc" => "Select slow, normal or fast for animation speed.",
        "id" => "photo_animation",
        "std" => "fast",
        "type" => "select",
        "options" => array(
            'slow' => 'Slow',
            'normal' => 'Normal',
            'fast' => 'Fast'
        )
    );
      
    $options[] = array(
        "name" => "Slideshow",
        "desc" => "Interval time in ms",
        "id" => "photo_slideshow",
        "std" => "5000",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Opacity",
        "desc" => "Value between 0 and 1.",
        "id" => "photo_opacity",
        "std" => "0.80",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Show Title",
        "desc" => "Select on or off for show title.",
        "id" => "photo_title",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Social Media",
        "desc" => "The social media icons are appearing.",
        "id" => "photo_social",
        "std" => "off",
        "type" => "radio",
        "options" => array(
            'on' => 'On',
            'off' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Autoplay Videos",
        "desc" => "Automatically start videos.",
        "id" => "photo_videos",
        "std" => "true",
        "type" => "radio",
        "options" => array(
            'true' => 'On',
            'false' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Download Images",
        "desc" => "Select on or off for the possibility of image download.",
        "id" => "photo_download",
        "std" => "off",
        "type" => "radio",
        "options" => array(
            'on' => 'On',
            'off' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Theme",
        "desc" => "Here you can select a theme for lightbox.",
        "id" => "photo_theme",
        "std" => "pp_default",
        "type" => "select",
        "options" => array(
            'pp_default' => 'Default',
            'light_rounded' => 'Light Rounded',
            'dark_rounded' => 'Dark Rounded',
            'light_square' => 'Light Squar',
            'dark_square' => 'Dark Square',
            'facebook' => 'Facebook'
        )
    );
    
    $options[] = array(
        "name" => "Social Media",
		"icon" => "social.png",
        "type" => "heading"
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
        "name" => "Digg",
        "desc" => "Input Digg link.",
        "id" => "digg",
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
        "name" => "Vimeo",
        "desc" => "Input Vimeo link.",
        "id" => "vimeo",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "RSS",
        "desc" => "Input RSS link.",
        "id" => "rss",
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
        "name" => "VK",
        "desc" => "Input VK link.",
        "id" => "vk",
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
        "name" => "LastFM",
        "desc" => "Input LastFM link.",
        "id" => "lastfm",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Pinterest",
        "desc" => "Input Pinterest link.",
        "id" => "pinterest",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Amazon",
        "desc" => "Input Amazon link.",
        "id" => "amazon",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Beatport",
        "desc" => "Input Beatport link.",
        "id" => "beatport",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "MySpace",
        "desc" => "Input MySpace link.",
        "id" => "myspace",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "Instagram",
        "desc" => "Input Instagram link.",
        "id" => "instagram",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "SoundCloud",
        "desc" => "Input SoundCloud link.",
        "id" => "soundcloud",
        "std" => "",
        "type" => "text"
    );
	
	$options[] = array(
        "name" => "MixCloud",
        "desc" => "Input MixCloud link.",
        "id" => "mixcloud",
        "std" => "",
        "type" => "text"
    );
	
		$options[] = array(
        "name" => "Tumblr",
        "desc" => "Input Tumblr link.",
        "id" => "tumblr",
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