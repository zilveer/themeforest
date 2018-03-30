<?php
// check if there are old options (before BigBangWP v2.0) and use them in new options panel. 
$options = get_option("bigbangwp");
if (of_get_option(BRANKIC_VAR_PREFIX . "color") != "") {
	$old_options = array("color", "logo", "logo2", "pinned_menu", "background_image", "tile_background", "boxed_stretched", "favicon", "custom_google_font", "custom_google_font_href", "extra_javascript", "extra_css", "ga", "extra_images_no", "disable_responsive", "show_panel", "short_pages_fix", "category_page_style", "category_page_style_fullwidth", "show_cats_blog_page", "show_cats_blog_single_page", "blog_single_page_style", "blog_single_page_style_fullwidth", "show_share", "show_tags_blog_page", "show_tags_blog_single_page", "hide_no_of_comments", "email_to", "email_from", "email_from_2", "email_subject", "use_captcha", "recaptcha_public_api", "recaptcha_private_api", "contact_form_title", "contact_form_location", "contact_form_zoom", "field_1", "field_1_caption", "field_1_required", "field_1_select", "field_2", "field_2_caption", "field_2_required", "field_2_select", "field_3", "field_3_caption", "field_3_required", "field_3_select", "field_4", "field_4_caption", "field_4_required", "field_4_select", "field_5", "field_5_caption", "field_5_required", "field_5_select");
	foreach($old_options as $option) {
		$option = BRANKIC_VAR_PREFIX . $option;
		if (get_option($option) != "") {
			//update new options
			$options[$option] = get_option($option);			
			//delete old option
			delete_option($option);
		}
	}
	update_option("bigbangwp", $options);

}

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	$yes_no_array = array(true => __("Yes", BRANKIC_THEME_SHORT), false => __("No", BRANKIC_THEME_SHORT));
	

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	
	// Pull all google web font families, variants and subsets
	//$google_web_fonts_families = google_web_fonts_arrays();
	//$google_web_fonts_variants = google_web_fonts_arrays("variants");
	//$google_web_fonts_subsets = google_web_fonts_arrays("subsets");

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Global Settings', BRANKIC_THEME_SHORT),
		'type' => 'heading');
		
	$options[BRANKIC_VAR_PREFIX . 'color'] = array(
		'name' => __('Choose color', BRANKIC_THEME_SHORT),
		'desc' => __('You can change color codes in bigbangwp/css/colors/', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'color',
		'std' => 'orange',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array("blue" => "Blue", 
						  "navyblue" => "Navy blue",
						  "orange" => "Orange",
						  "yellow" => "Yellow",
						  "green" => "Green",
						  "tealgreen" => "Tealgreen",
						  "red" => "Red",
						  "pink" => "Pink",
						  "purple" => "Purple",
						  "magenta" => "Magenta",
						  "cream" => "Cream"));
		
	$options[BRANKIC_VAR_PREFIX . 'logo'] = array(
		'name' => __('Logo', BRANKIC_THEME_SHORT),
		'desc' => __('Logo that sits in upper left corner', BRANKIC_THEME_SHORT),
		'std'  => BRANKIC_ROOT . "/images/logo.png",
		'id' => BRANKIC_VAR_PREFIX . 'logo',
		'type' => 'upload');
		
	$options[BRANKIC_VAR_PREFIX . 'logo2'] = array(
		'name' => __('Logo 2', BRANKIC_THEME_SHORT),
		'desc' => __('Logo in fixed header', BRANKIC_THEME_SHORT),
		'std'  => BRANKIC_ROOT . "/images/logo-min.png",
		'id' => BRANKIC_VAR_PREFIX . 'logo2',
		'type' => 'upload');
		
	$options[BRANKIC_VAR_PREFIX . 'pinned_menu'] = array(
		'name' => __('Show Pinned menu on scroll', BRANKIC_THEME_SHORT),
		'desc' => __('', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'pinned_menu',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => 'no',
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));
							
	$options[BRANKIC_VAR_PREFIX . 'background_image'] = array(
		'name' => __('Background image', BRANKIC_THEME_SHORT),
		'desc' => __('Background images from Live preview examples are located in bigbangwp/images/pattern/', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'background_image',
		'type' => 'upload');
		
	$options[BRANKIC_VAR_PREFIX . 'tile_background'] = array(
		'name' => __('Tile image', BRANKIC_THEME_SHORT),
		'desc' => __('If no is selected, image will be stretched', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'tile_background',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => 'no',
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));							

	$options[BRANKIC_VAR_PREFIX . 'boxed_stretched'] = array(
		'name' => __('Boxed or Stretched style', BRANKIC_THEME_SHORT),
		'desc' => __("Boxed is better if you're using background image", BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'boxed_stretched',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => 'stretched',
		'options' =>  array("boxed" => "Boxed", 
                            "stretched" => "Stretched"));
							
	$options[BRANKIC_VAR_PREFIX . 'favicon'] = array(
		'name' => __('Favicon', BRANKIC_THEME_SHORT),
		'desc' => __('.ico format only', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'favicon',
		'std'  => BRANKIC_ROOT . "/bra_favicon.ico",
		'type' => 'upload');
		
	$options[BRANKIC_VAR_PREFIX . 'custom_google_font'] = array(
		'name' => __('Google Font Family', BRANKIC_THEME_SHORT),
		'desc' => __("Go to Google Web Fonts web page and grab the code between h1 { and }", BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'custom_google_font',
		'std' => "font-family: 'Oswald', sans-serif;",	
		'type' => 'text');
		
	$options[BRANKIC_VAR_PREFIX . 'custom_google_font_href'] = array(
		'name' => __('URL for Google Font', BRANKIC_THEME_SHORT),
		'desc' => __("Go to Google Web Fonts web page", BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'custom_google_font_href',
		'std' => "<link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css' />",
		'type' => 'text');	
		
		
	$options[BRANKIC_VAR_PREFIX . 'extra_javascript'] = array(
		'name' => __('Extra JavaScript', BRANKIC_THEME_SHORT),
		'desc' => __("Define some extra javascript code", BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'extra_javascript',
		'std' => "jQuery(document).ready(function($) { 
});",
		'type' => 'textarea');	
		
	$options[BRANKIC_VAR_PREFIX . 'extra_css'] = array(
		'name' => __('Extra CSS', BRANKIC_THEME_SHORT),
		'desc' => __("Define some extra CSS styles", BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'extra_css',
		'std' => "",
		'type' => 'textarea');
		
	$options[BRANKIC_VAR_PREFIX . 'ga'] = array(
		'name' => __('Google Analytics tracking code', BRANKIC_THEME_SHORT),
		'desc' => __("Insert your Google Analytics tracking code (whole code)", BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'ga',
		'std' => "",
		'type' => 'textarea');								

	$options[BRANKIC_VAR_PREFIX . 'extra_images_no'] = array(
		'name' => __('Number of extra (slider) images', BRANKIC_THEME_SHORT),
		'desc' => __('Max number of extra (slider) images. These images are below Featured image in the editor', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'extra_images_no',
		'std' => '5',
		'class' => 'mini',
		'type' => 'text');
		
	$options[BRANKIC_VAR_PREFIX . 'disable_responsive'] = array(
		'name' => __('Disable responsive layout', BRANKIC_THEME_SHORT),
		'desc' => __("If you disable responsive layout website layout won't adjust to screen size of viewers device", BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'disable_responsive',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "no",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));	
							
	$options[BRANKIC_VAR_PREFIX . 'short_pages_fix'] = array(
		'name' => __('Short pages fix', BRANKIC_THEME_SHORT),
		'desc' => __("If there's not much content on the page footer will be fixed to the bottom of the page (beta version)", BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'short_pages_fix',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "no",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));
							
/*	$options[] = array(
		'name' => __('Flickr API key', BRANKIC_THEME_SHORT),
		'desc' => __('Get this key at http://www.flickr.com/services/apps/create/noncommercial/. Need it only if you\'re using FLICKR photostream', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'flickr_api_key',
		'std' => '40877bb0e10edad168a2ccee1f176fb7',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Instagram token', BRANKIC_THEME_SHORT),
		'desc' => __('Get this token at http://www.brankic1979.com/instagram/. Need it only if you\'re using Instagram photostream', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'flickr_api_key',
		'std' => '338517687.1912c81.b47c05c499c1401d90d7afcfc2bb7def',
		'type' => 'text');*/
							
	$options[BRANKIC_VAR_PREFIX . 'show_panel'] = array(
		'name' => __('Show Panel', BRANKIC_THEME_SHORT),
		'desc' => __('Show panel with style options (like on our live preview) on the left hand side', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'show_panel',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "no",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));	
		
/*	$options[] = array(
		'name' => __('Google Web Font family 1', BRANKIC_THEME_SHORT),
		'desc' => __('', BRANKIC_THEME_SHORT),
		'id' => 'bra_google_web_font_family_1',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $google_web_fonts_families);
				
	$options[] = array(
		'name' => __('Google Web Font family, variants and subsets 1', BRANKIC_THEME_SHORT),
		'desc' => __('', BRANKIC_THEME_SHORT),
		'id' => 'bra_google_web_font_family_variants_and_subsets_1',
		'std' => '',
		'class' => 'maxi',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Google Web Font family 2', BRANKIC_THEME_SHORT),
		'desc' => __('', BRANKIC_THEME_SHORT),
		'id' => 'bra_google_web_font_family_2',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $google_web_fonts_families);
				
	$options[] = array(
		'name' => __('Google Web Font family, variants and subsets 2', BRANKIC_THEME_SHORT),
		'desc' => __('', BRANKIC_THEME_SHORT),
		'id' => 'bra_google_web_font_family_variants_and_subsets_2',
		'std' => '',
		'class' => 'maxi',
		'type' => 'text');*/


/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	$options[] = array(
		'name' => __('Blog Pages', BRANKIC_THEME_SHORT),
		'type' => 'heading');
	
	$options[BRANKIC_VAR_PREFIX . 'category_page_style'] = array(
		'name' => __('Category page style', BRANKIC_THEME_SHORT),
		'desc' => __('This style is used you bring category to the WP menu, or for search result, or tag pages', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'category_page_style',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => '1',
		'options' =>  array("1" => "Style 1", 
						   "2" => "Style 2",
						   "3" => "Style 3",
						   "4" => "Style 4",
						   "5" => "Style 5",
						   "6" => "Style 6"));
							
	$options[BRANKIC_VAR_PREFIX . 'category_page_style_fullwidth'] = array(
		'name' => __('Category (search results, tag) page style', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'category_page_style_fullwidth',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => 'no',
		'options' =>  array("no" => "Sidebar", 
                            "yes" => "Full Width"));	
						
	$options[BRANKIC_VAR_PREFIX . 'blog_single_page_style'] = array(
		'name' => __('Blog single post style', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'blog_single_page_style',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "1",
		'options' =>  array("1" => "Style 1", 
						   "2" => "Style 2",
						   "3" => "Style 3",
						   "4" => "Style 4",
						   "5" => "Style 5",
						   "6" => "Style 6"));
							
	$options[BRANKIC_VAR_PREFIX . 'blog_single_page_style_fullwidth'] = array(
		'name' => __('Blog single post : Full width layout, or sidebar', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'blog_single_page_style_fullwidth',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "no",
		'options' =>  array("no" => "Sidebar", 
                            "yes" => "Full Width"));
							
	$options[BRANKIC_VAR_PREFIX . 'show_share'] = array(
		'name' => __('Show sharing options', BRANKIC_THEME_SHORT),
		'desc' => __('These options are in the file share.inc.php, so you can edit on your own', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'show_share',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "yes",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));
							
	$options[BRANKIC_VAR_PREFIX . 'show_tags_blog_page'] = array(
		'name' => __('Show tags on blog page', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'show_tags_blog_page',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "yes",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));		
							
	$options[BRANKIC_VAR_PREFIX . 'show_tags_blog_single_page'] = array(
		'name' => __('Show tags on blog single post', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'show_tags_blog_single_page',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "yes",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));
	$options[BRANKIC_VAR_PREFIX . 'show_authors_blog_page'] = array(
		'name' => __('Show authors on blog page', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'show_authors_blog_page',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "yes",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));		
							
	$options[BRANKIC_VAR_PREFIX . 'show_authors_blog_single_page'] = array(
		'name' => __('Show authors on blog single post', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'show_authors_blog_single_page',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "yes",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));							
							
	$options[BRANKIC_VAR_PREFIX . 'show_cats_blog_page'] = array(
		'name' => __('Show categories on blog page', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'show_cats_blog_page',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "yes",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));
							
	$options[BRANKIC_VAR_PREFIX . 'show_cats_blog_single_page'] = array(
		'name' => __('Show categories on blog single page', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'show_cats_blog_single_page',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "yes",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));							
	$options[BRANKIC_VAR_PREFIX . 'hide_no_of_comments'] = array(
		'name' => __('Hide number of comments if there are no comments', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'hide_no_of_comments',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "no",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));																				
	
	
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$options[] = array(
		'name' => __('Contact Page', BRANKIC_THEME_SHORT),
		'type' => 'heading');

	$user_info = wp_get_current_user();
	
	
	
	
	$options[BRANKIC_VAR_PREFIX . 'email_to'] = array(
		'name' => __('Who will receive emails', BRANKIC_THEME_SHORT),
		'desc' => __('Insert your email', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'email_to',
		'std' => $user_info->user_email,
		'type' => 'text');
		
	$options[BRANKIC_VAR_PREFIX . 'email_from'] = array(
		'name' => __('Email FROM field', BRANKIC_THEME_SHORT),
		'desc' => __('Insert email address in case you want to have static email FROM field', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'email_from',
		'std' => $user_info->user_email,
		'type' => 'text');
		
	$options[BRANKIC_VAR_PREFIX . 'email_from_2'] = array(
		'name' => __('Insert the number of email field below', BRANKIC_THEME_SHORT),
		'desc' => __("If you select email field, you'll be able to directly reply to sender", BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'email_from_2',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' =>  array("" => "I'll use static email address from above - Email FROM field", 
								   "1" => "1",
								   "2" => "2",
								   "3" => "3",
								   "4" => "4",
								   "5" => "5"));
							
	$options[BRANKIC_VAR_PREFIX . 'email_subject'] = array(
		'name' => __('Email subject', BRANKIC_THEME_SHORT),
		'desc' => __('Insert subject of the email you will receive from visitors', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'email_subject',
		'std' => 'Email from my website (BigBangWP theme)',
		'type' => 'text');
							
	$options[BRANKIC_VAR_PREFIX . 'use_captcha'] = array(
		'name' => __('Use reCaptcha', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'use_captcha',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => "no",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes"));
							
	$options[BRANKIC_VAR_PREFIX . 'recaptcha_public_api'] = array(
		'name' => __('reCaptcha public key', BRANKIC_THEME_SHORT),
		'desc' => __('Grab your keys from reCaptha website http://www.google.com/recaptcha/whyrecaptcha', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'recaptcha_public_api',
		'type' => 'text');
		
	$options[BRANKIC_VAR_PREFIX . 'recaptcha_private_api'] = array(
		'name' => __('reCaptcha private key', BRANKIC_THEME_SHORT),
		'desc' => __('Grab your keys from reCaptha website http://www.google.com/recaptcha/whyrecaptcha', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'recaptcha_private_api',
		'type' => 'text');
		
		
	$options[BRANKIC_VAR_PREFIX . 'contact_form_title'] = array(
		'name' => __('Heading above contact form', BRANKIC_THEME_SHORT),
		'desc' => __('This text will be shown above the contact form on contact page template', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'contact_form_title',
		'std' => 'Send us a message',
		'type' => 'text');

	$options[BRANKIC_VAR_PREFIX . 'contact_form_location'] = array(
		'name' => __('Location if you\'re using full-width layout', BRANKIC_THEME_SHORT),
		'desc' => __('Map with this location will be shown on contact page full width page template', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'contact_form_location',
		'std' => 'Amsterdam',
		'type' => 'text');

	$options[BRANKIC_VAR_PREFIX . 'contact_form_zoom'] = array(
		'name' => __('Zoom level (if you\'re using full-width layout)', BRANKIC_THEME_SHORT),
		'desc' => __('15 is good, less is much wider', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'contact_form_zoom',
		'std' => '15',
		'class' => 'mini',
		'type' => 'text');
		
		
		
	/// 5 times
	
for ($i = 1 ; $i <= 5 ; $i++) {
	
	$std_field = "";
	if ($i == 1) $std_field = "text";
	if ($i == 2) $std_field = "text";
	if ($i == 3) $std_field = "textarea";
	if ($i == 4) $std_field = "Nothing";
	if ($i == 5) $std_field = "Nothing";
	
	$std_caption = "";
	if ($i == 1) $std_caption = "Your Name";
	if ($i == 2) $std_caption = "Your Email";
	if ($i == 3) $std_caption = "Message";
	
	
	$options[BRANKIC_VAR_PREFIX . 'field_' . $i] = array(
		'name' => __('FIELD', BRANKIC_THEME_SHORT) . " " . $i,
		'id' => BRANKIC_VAR_PREFIX . 'field_' . $i,
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'std' => $std_field,
		'options' =>  array("Nothing" => "Nothing",
							"text" => "Text", 
							"select" => "Select",
							"textarea" => "Textarea"));	
		
	$options[BRANKIC_VAR_PREFIX . 'field_' . $i . '_caption'] = array(
		'name' => __('Caption for field', BRANKIC_THEME_SHORT) . " " . $i,
		'desc' => __('Insert caption for the field', BRANKIC_THEME_SHORT) . " " . $i,
		'id' => BRANKIC_VAR_PREFIX . 'field_' . $i . '_caption',
		'std' => $std_caption,
		'class' => 'hidden',
		'type' => 'text');	

	$options[BRANKIC_VAR_PREFIX . 'field_' . $i . '_required'] = array(
		'name' => __('Field required', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'field_' . $i . '_required',
		'type' => 'select',
		'class' => 'hidden',
		'std' => "yes",
		'options' =>  array("no" => "No", 
                            "yes" => "Yes",
                            "yes_email" => "Yes - Email"));
							
	$options[BRANKIC_VAR_PREFIX . 'field_' . $i . '_select'] = array(
		'name' => __('Field select options', BRANKIC_THEME_SHORT),
		'desc' => __('Insert options separated by comma', BRANKIC_THEME_SHORT),
		'id' => BRANKIC_VAR_PREFIX . 'field_' . $i . '_select',
		'class' => 'hidden',
		'std' => "no",
		'type' => 'text');
		
}
							
	return $options;
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

//add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { 
//$google_web_fonts_families = google_web_fonts_arrays();
?>
<style type='text/css' media='screen'>
#optionsframework .maxi .controls input, #optionsframework .maxi .controls {
  min-width: 600px;
  width: 600px;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#bra_google_web_font_family_1').change(function() {
		var selected_family = jQuery("#bra_google_web_font_family_1 option:selected").text();
		jQuery.ajax({  
			type : "POST",
			url : "<?php echo THEME_DOCUMENT_ROOT ?>/inc/somephp.php?value=" + selected_family ,   
			success : function(data, textStatus, jqXHR){ 
				jQuery("#bra_google_web_font_family_variants_and_subsets_1").attr("value", data) ;
			}  
		 });
	});
	
	jQuery('#bra_google_web_font_family_2').change(function() {
		var selected_family = jQuery("#bra_google_web_font_family_2 option:selected").text();
		jQuery.ajax({  
			type : "POST", 
			url : "<?php echo THEME_DOCUMENT_ROOT ?>/inc/somephp.php?value=" + selected_family ,   
			success : function(data, textStatus, jqXHR){ 
				jQuery("#bra_google_web_font_family_variants_and_subsets_2").attr("value", data) ;
			}  
		 });
	});

});
</script>
 
<?php
}

/* 
 * This is an example of how to override a default filter
 * for 'textarea' sanitization and $allowedposttags + embed and script.
 */
add_action('admin_init','optionscheck_change_santiziation', 100);
 
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
	
	remove_filter( 'of_sanitize_text', 'sanitize_text_field' );
    add_filter( 'of_sanitize_text', 'custom_sanitize_text_field' );
}
 
function custom_sanitize_textarea($input) {
    global $allowedposttags;
      $custom_allowedtags["script"] = array();
 
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}

function custom_sanitize_text_field($str) {
    $filtered = wp_check_invalid_utf8( $str );
 
    if ( strpos($filtered, '<') !== false ) {
        //$filtered = wp_pre_kses_less_than( $filtered );
        // This will strip extra whitespace for us.
        //$filtered = wp_strip_all_tags( $filtered, true );
    } else {
        $filtered = trim( preg_replace('/[\r\n\t ]+/', ' ', $filtered) );
    }
 
    $found = false;
    while ( preg_match('/%[a-f0-9]{2}/i', $filtered, $match) ) {
        $filtered = str_replace($match[0], '', $filtered);
        $found = true;
    }
 
    if ( $found ) {
        // Strip out the whitespace that may now exist after removing the octets.
        $filtered = trim( preg_replace('/ +/', ' ', $filtered) );
    }
 
    /**
     * Filter a sanitized text field string.
     *
     * @since 2.9.0
     *
     * @param string $filtered The sanitized string.
     * @param string $str      The string prior to being sanitized.
     */
    return apply_filters( 'sanitize_text_field', $filtered, $str );
}

?>