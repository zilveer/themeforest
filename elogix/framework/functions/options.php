<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */
 
 /*
 * This is an example of how to override a default filter
 * for 'textarea' sanitization and $allowedposttags + embed and script.
 */
add_action('admin_init','optionscheck_change_santiziation', 100);
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}
function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
      $custom_allowedtags["script"] = array();
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}

function optionsframework_option_name() {

// This gets the theme name from the stylesheet
$themename = get_option( 'stylesheet' );
$themename = preg_replace("/\W/", "_", strtolower($themename) );

$optionsframework_settings = get_option( 'optionsframework' );
$optionsframework_settings['id'] = $themename;
update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {

	$bgrepeat_array = array(
			'stretch' => __('stretch', 'options_framework_theme'),
			'repeat' => __('repeat', 'options_framework_theme'),
			'repeat-x' => __('repeat-x', 'options_framework_theme'),
			'repeat-y' => __('repeat-y', 'options_framework_theme'),
			'no-repeat' => __('no-repeat', 'options_framework_theme')
		);
	$bgposition_array = array(
			'top left' => __('top left', 'options_framework_theme'),
			'top center' => __('top center', 'options_framework_theme'),
			'top right' => __('top right', 'options_framework_theme'),
			'center center' => __('center center', 'options_framework_theme'),
			'bottom left' => __('bottom left', 'options_framework_theme'),
			'bottom center' => __('bottom center', 'options_framework_theme'),
			'bottom right' => __('bottom right', 'options_framework_theme')
		);
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	$options = array();
	
/* ----------------------------------------------------- */
/* General Settings */
/* ----------------------------------------------------- */
						
	$options[] = array( "name" => "General Settings",
						"type" => "heading");
						
	$options[] = array( "name" => "Footer Text",
						"desc" => "Descriptive Text (under Footer Logo)",
						"id" => "footer_text",
						"std" => "Elogix is an incredibly powerful &amp; fully responsive WordPress Theme.",
						"type" => "textarea");
						
	$options[] = array( "name" => "Show Notification Bar",
						"desc" => "Notification Bar (Sliding Bar above Header)",
						"id" => "infobar_checkbox",
						"std" => "1",
						"type" => "checkbox"); 
						
	$options[] = array( "name" => "Notification Bar visible on Pageload?",
						"desc" => "Check if Notification Bar should be visible on Pageload. <br />Make sure to delete Cookies before testing, because the Notification Bar uses cookies - so if you see it closed even though you checked the box just delete cookies and reload the Page - also the other way round.",
						"id" => "infobar_visible",
						"std" => "1",
						"type" => "checkbox"); 
	
	$options[] = array( "name" => "Notification Bar Text (above Header)",
						"desc" => "Notification Bar descriptive Text",
						"id" => "infobar_text",
						"std" => "Elogix is an incredibly powerful &amp; fully responsive WordPress Theme. Grab your copy on <a href='http://www.themeforest.net' target='_blank'>Themeforest</a>",
						"type" => "textarea"); 
	
	$options[] = array( "name" => "Show Latestwork on Home Page",
						"desc" => "Show Latest Work on Home Page",
						"id" => "latestwork_checkbox",
						"std" => "1",
						"type" => "checkbox"); 
						
	$options[] = array( "name" => "Latest Work Text",
						"desc" => "Descriptive Text of Latest Work on Home Page",
						"id" => "latestwork_text",
						"std" => "Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada.<br /><br /><a href='#'>Show all Works</a>",
						"type" => "textarea");
						
	$options[] = array( "name" => "Show Latest Posts from Blog on Home Page",
						"desc" => "Show Latest Posts from Blog on Home Page",
						"id" => "latestposts_checkbox",
						"std" => "1",
						"type" => "checkbox"); 
						
	$options[] = array( "name" => "Latest Posts Text",
						"desc" => "Descriptive Text of Latest Posts on Home Page",
						"id" => "latestposts_text",
						"std" => "Maecenas a mi nibh, eu euismod orci. Vivamus viverra lacus vitae tortor molestie malesuada.<br /><br /><a href='#'>Show all Posts</a>",
						"type" => "textarea");
						
	$options[] = array( "name" => "Show Twitter-Feed above Footer",
						"desc" => "Show Twitter-Feed above Footer (configure your Twitter Name in Social Media)",
						"id" => "twitterfooter_checkbox",
						"std" => "1",
						"type" => "checkbox"); 
	
	$options[] = array( "name" => "Contact E-Mail",
						"desc" => "Contact Form E-Mail Address",
						"id" => "contact_email",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Contact Information",
						"desc" => "Insert your Contact Information here. This will be display beside the contact form.",
						"id" => "contact_information",
						"std" => "<h3>Contact Information</h3>
John Doe, Inc. <br />
1234 Main Street Anywhere, <br />
USA<br /><br />

Phone: 123 456 7890<br />
Fax: +49 123 456 7891<br />
Email: hello@example.com<br />
Web: example.com<br />",
						"type" => "textarea");
	
	$options[] = array( "name" => "Google Analytics Code",
						"desc" => "Insert your Google Analytics Code",
						"id" => "analytics_code",
						"std" => "",
						"type" => "textarea");
						
/* ----------------------------------------------------- */
/* Slider */
/* ----------------------------------------------------- */
						
	$options[] = array( "name" => "Slider",
						"type" => "heading");
	
	$options[] = array( "name" => "Slide 1",
						"desc" => "Image for the first slide (Width should be 980px, Height of all Slides should be the same.)",
						"id" => "slide1_upload",
						"type" => "upload");
	
	$options[] = array( "name" => "Slide 1 Caption",
						"desc" => "Caption for Slide 1",
						"id" => "slide1_caption",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Slide 1 URL",
						"desc" => "URL for Slide 1",
						"id" => "slide1_url",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Slide 2",
						"desc" => "Image for the first slide (Width should be 980px, Height of all Slides should be the same.)",
						"id" => "slide2_upload",
						"type" => "upload");
						
	$options[] = array( "name" => "Slide 2 Caption",
						"desc" => "Caption for Slide 2",
						"id" => "slide2_caption",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Slide 2 URL",
						"desc" => "URL for Slide 2",
						"id" => "slide2_url",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Slide 3",
						"desc" => "Image for the first slide (Width should be 980px, Height of all Slides should be the same.)",
						"id" => "slide3_upload",
						"type" => "upload");
						
	$options[] = array( "name" => "Slide 3 Caption",
						"desc" => "Caption for Slide 3",
						"id" => "slide3_caption",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Slide 3 URL",
						"desc" => "URL for Slide 3",
						"id" => "slide3_url",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Slide 4",
						"desc" => "Image for the first slide (Width should be 980px, Height of all Slides should be the same.)",
						"id" => "slide4_upload",
						"type" => "upload");
						
	$options[] = array( "name" => "Slide 4 Caption",
						"desc" => "Caption for Slide 4",
						"id" => "slide4_caption",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Slide 4 URL",
						"desc" => "URL for Slide 4",
						"id" => "slide4_url",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Slide 5",
						"desc" => "Image for the first slide (Width should be 980px, Height of all Slides should be the same.)",
						"id" => "slide5_upload",
						"type" => "upload");
	
	$options[] = array( "name" => "Slide 5 Caption",
						"desc" => "Caption for Slide 5",
						"id" => "slide5_caption",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Slide 5 URL",
						"desc" => "URL for Slide 5",
						"id" => "slide5_url",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Slide 6",
						"desc" => "Image for the first slide (Width should be 980px, Height of all Slides should be the same.)",
						"id" => "slide6_upload",
						"type" => "upload");
	
	$options[] = array( "name" => "Slide 6 Caption",
						"desc" => "Caption for Slide 6",
						"id" => "slide6_caption",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Slide 6 URL",
						"desc" => "URL for Slide 6",
						"id" => "slide6_url",
						"std" => "",
						"type" => "text");

/* ----------------------------------------------------- */
/* Styling */
/* ----------------------------------------------------- */
						
	$options[] = array( "name" => "Styling",
						"type" => "heading");
						
	
	$options[] = array( "name" => "Header Logo",
						"desc" => "Header Logo",
						"id" => "logo_upload",
						"type" => "upload");
						
	$options[] = array( "name" => "Header Logo Margin-Top",
						"desc" => "Margin-Top of Header Logo (Default: 45px)",
						"id" => "logo_margin",
						"std" => "45px",
						"type" => "text");
						
	$options[] = array( "name" => "Favicon",
						"desc" => "Upload a 16x16px Favicon (ico/png/gif)",
						"id" => "favicon_upload",
						"type" => "upload");
						
	$options[] = array( "name" => "Footer Logo",
						"desc" => "Footer Logo",
						"id" => "footerlogo_upload",
						"type" => "upload");
						
	$options[] = array( "name" => "Primary Color",
						"desc" => "Selected your Color.",
						"id" => "primary_colorpicker",
						"std" => "#ec7100",
						"type" => "color");
						
	$options[] = array( "name" => "Default Background Image",
						"desc" => "Choose Default Background Image",
						"id" => "bgimage_upload",
						"type" => "upload");
	
	$options[] = array( 'name' => "Background Repeat / Stretch",
						'id' => 'bgrepeat_select',
						'std' => 'stretch',
						'type' => 'select',
						'class' => 'mini', //mini, tiny, small
						'options' => $bgrepeat_array);
	
	$options[] = array( 'name' => "Background Position (if repeated)",
						'id' => 'bgposition_select',
						'std' => 'top left',
						'type' => 'select',
						'class' => 'mini', //mini, tiny, small
						'options' => $bgposition_array);
						
	/*$options[] = array( "name" =>  "Default Background",
						"desc" => "Change the Default Background CSS. Remember: The Background Settings of each Page override this Setting.",
						"id" => "default_background",
						"std" => $background_defaults, 
						"type" => "background");*/
	
	$options[] = array( "name" => "Custom CSS Code",
						"desc" => "Insert your Custom CSS",
						"id" => "css_code",
						"std" => "",
						"type" => "textarea");
						
/* ----------------------------------------------------- */
/* Social Media */
/* ----------------------------------------------------- */
						
	$options[] = array( "name" => "Social Media",
						"type" => "heading");

	$options[] = array( "name" => "Twitter Configuration API (1.1)",
						"type" => "info",
						"desc" => "You need to have a twitter App for your usage of the new Twitter API 1.1, login & create at https://dev.twitter.com/apps"
						);
	
	$options[] = array( "name" => "Twitter",
						"desc" => "Twitter Username",
						"id" => "twitter_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Twitter Consumer Key",
						"desc" => "Twitter Consumer Key",
						"id" => "twitter_ck",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Twitter Consumer Secret",
						"desc" => "Twitter Consumer Secret",
						"id" => "twitter_cs",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Twitter Access Token",
						"desc" => "Twitter Access Token",
						"id" => "twitter_at",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Twitter Access Secret",
						"desc" => "Twitter Access Secret",
						"id" => "twitter_as",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Facebook",
						"desc" => "Facebook Url",
						"id" => "facebook_url",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Dribbble",
						"desc" => "Dribbble Url",
						"id" => "dribbble_url",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Flickr",
						"desc" => "Flickr Url",
						"id" => "flickr_url",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Google",
						"desc" => "Google Url",
						"id" => "google_url",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Vimeo",
						"desc" => "Vimeo Url",
						"id" => "vimeo_url",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Youtube",
						"desc" => "Youtube Url",
						"id" => "youtube_url",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "LinkedIn",
						"desc" => "LinkedIn Url",
						"id" => "linkedin_url",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Pinterest",
						"desc" => "Pinterest Url",
						"id" => "pinterest_url",
						"std" => "",
						"type" => "text");
						

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */
									
	return $options;
}