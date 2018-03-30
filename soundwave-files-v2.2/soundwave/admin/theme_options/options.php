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
    $imagefavicon  = get_stylesheet_directory_uri() . '/images/favicon.ico';
    
    $options[] = array(
        "name" => "General",
        "icon" => "general.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Non-Stop Music Player",
        "desc" => "Check the box to activate the music player.",
        "id" => "active_ajax",
        "std" => "0",
        "type" => "checkbox"
    );
    
    $options[] = array(
        "name" => "Active Player",
        "desc" => "Check the box to activate slider.",
        "id" => "active_player",
        "std" => "0",
        "type" => "checkbox"
    );
    
    $options[] = array(
        "name" => "Audio/Radio",
        "desc" => "Select type of player audio or radio.",
        "id" => "player_audio_radio",
        "std" => "player_audio",
        "type" => "radio",
        "options" => array(
            'player_audio' => 'Audio',
            'player_radio' => 'Radio'
        )
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
        "name" => "Number of Artists per page",
        "desc" => "Enter number of Artists here.",
        "id" => "nr_artists",
        "std" => "8",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Number of Dj Mixes per page",
        "desc" => "Enter number of Dj Mixes here.",
        "id" => "nr_mixes",
        "std" => "8",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Style",
        "icon" => "style.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Theme Color",
        "desc" => "Choose a color for links and buttons.",
        "id" => "color_wize",
        "std" => "18cecf",
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
        "std" => "Lato",
        "type" => "select",
        "options" => array(
            "Lato" => "Lato",
            "Dosis" => "Dosis",
            "Amaranth" => "Amaranth",
            "Signika" => "Signika",
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
        "name" => "Slider",
        "icon" => "slider.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Slider",
        "desc" => "Check the box to activate slider.",
        "id" => "slider_active",
        "std" => "0",
        "type" => "checkbox"
    );
    
    $options[] = array(
        "name" => "Slider Type",
        "desc" => "Select the slider type.",
        "id" => "slider_type",
        "std" => "slider_small",
        "type" => "radio",
        "options" => array(
            'slider_small' => 'Small',
            'slider_large' => 'Large'
        )
    );
    
    $options[] = array(
        "name" => "Number of Slides",
        "desc" => "Enter number of slides here.",
        "id" => "slider_number",
        "std" => "5",
        "type" => "text"
    );
      
    $options[] = array(
        "name" => "Slideshow Speed",
        "desc" => "Milliseconds between slider transitions.",
        "id" => "slider_speed_slideshow",
        "std" => "3000",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Animation Speed",
        "desc" => "Milliseconds between slider transitions.",
        "id" => "slider_speed_animation",
        "std" => "500",
        "type" => "text"
    );
    
    
    $options[] = array(
        "name" => "Audio",
        "icon" => "audio.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "AutoPlay",
        "desc" => "Select on or off.",
        "id" => "player_autoplay",
        "std" => "autoplay_off",
        "type" => "radio",
        "options" => array(
            'autoplay_on' => 'On',
            'autoplay_off' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Player: visible/hidden",
        "desc" => "Select visible or hidden.",
        "id" => "player_opened",
        "std" => "opened_open",
        "type" => "radio",
        "options" => array(
            'opened_open' => 'Visible',
            'opened_closed' => 'Hidden'
        )
    );
    
    $options[] = array(
        "name" => "Play Next When Finished",
        "desc" => "Select on or off.",
        "id" => "player_next",
        "std" => "next_on",
        "type" => "radio",
        "options" => array(
            'next_on' => 'On',
            'next_off' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Audio for Home page",
        "desc" => "Enter the audio post ID to display the whole album on Home page.",
        "id" => "player_id",
        "std" => "",
        "type" => "text"
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
        "std" => "radio_autoplay_off",
        "type" => "radio",
        "options" => array(
            'radio_autoplay_on' => 'On',
            'radio_autoplay_off' => 'Off'
        )
    );
    
    $options[] = array(
        "name" => "Player: visible/hidden",
        "desc" => "Select visible or hidden.",
        "id" => "radio_opened",
        "std" => "radio_opened_visible",
        "type" => "radio",
        "options" => array(
            'radio_opened_visible' => 'Visible',
            'radio_opened_hidden' => 'Hidden'
        )
    );
    
    $options[] = array(
        "name" => "Title",
        "desc" => "Enter the title of the radio post.",
        "id" => "radio_title",
        "std" => "",
        "type" => "text"
    );
    
    $options[] = array(
        "name" => "Informations",
        "desc" => "Enter information about radio.",
        "id" => "radio_info",
        "std" => "",
        "type" => "text"
    );

    $options[] = array(
        "name" => "Social Media",
        "icon" => "social.png",
        "type" => "heading"
    );
    
    $options[] = array(
        "name" => "Icons Social Header",
        "desc" => "Check the box to activate social icons in header.",
        "id" => "social_header",
        "std" => "0",
        "type" => "checkbox"
    );
    
    $options[] = array(
        "name" => "Icons Social Footer",
        "desc" => "Check the box to activate social icons in footer.",
        "id" => "social_footer",
        "std" => "0",
        "type" => "checkbox"
    );
    
    $options[] = array(
        "name" => "Logo Social",
        "desc" => "Check the box to activate social logo in footer.",
        "id" => "social_logo",
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
        "name" => "Resident Advisor",
        "desc" => "Input Resident Advisor link.",
        "id" => "resident",
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