<?php
/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function eet_options_page_sections() {
	
 	$sections = array();
	// $sections[$id] 				= __($title, 'eet_textdomain');
	$sections['general'] 		= __('General Options', 'eet_textdomain');
	$sections['translation'] 		= __('Translation Options', 'eet_textdomain');
	$sections['social'] 	= __('Social Network Options', 'eet_textdomain');
	
	return $sections;	
}

/**
 * Define our form fields (settings) 
 *
 * @return array
 */
function eet_options_page_fields() {
	// Text Form Fields section
	$options[] = array(
		"section" => "general",
		"id"      => eet_SHORTNAME . "_lolo",
		"title"   => __( 'Logo URI', 'eet_textdomain' ),
		"desc"    => __( 'Enter the URI of your logo', 'eet_textdomain' ),
		"type"    => "textlogo",
		"std"     => __('','eet_textdomain'),
		"class"   => 'url'
	);
	

	$options[] = array(
		"section" => "general",
		"id"      => eet_SHORTNAME . "_hp_posts",
		"title"   => __( 'Homepage Pages', 'eet_textdomain' ),
		"desc"    => __( 'Enter the IDs of the pages that you would like to display on Homepage, separated by comma (e.g. 4, 23, 56).', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "general",
		"id"      => eet_SHORTNAME . "_blog",
		"title"   => __( 'Blog layout', 'eet_textdomain' ),
		"desc"    => __( 'Select the blog layout you would like to use', 'eet_textdomain' ),
		"type"    => "select",		
		"std"     => __('Numbered Navigation','eet_textdomain'),
		"choices" => array( "Numbered Navigation", "Navigation with Arrows")  
	);
		
	
	$options[] = array(
		"section" => "general",
		"id"      => eet_SHORTNAME . "_email",
		"title"   => __( 'Contact Page Email', 'eet_textdomain' ),
		"desc"    => __( 'Enter your email. Emails from Contact page will be sent to this email.', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "general",
		"id"      => eet_SHORTNAME . "_map",
		"title"   => __( 'Contact Page Map', 'eet_textdomain' ),
		"desc"    => __( 'Embed the Google Map that you would like to display. Make sure that it\'s 920x300px for best visual results! (more details in help file).', 'eet_textdomain' ),
		"type"    => "textarea",
		"std"     => __('','eet_textdomain'),
		"class" => "dejosve"
	);

	$options[] = array(
		"section" => "general",
		"id"      => eet_SHORTNAME . "_butcolor",
		"title"   => __( 'Button Color', 'eet_textdomain' ),
		"desc"    => __( 'Enter the hex value of a color for buttons.', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('0065b1','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "general",
		"id"      => eet_SHORTNAME . "_butcolorho",
		"title"   => __( 'Button Hover Color', 'eet_textdomain' ),
		"desc"    => __( 'Enter the hex value of a color for hover effect of buttons.', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('333333','eet_textdomain')		
	);
	

	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_tr_rm",
		"title"   => __( '"Read More" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "read more" label', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('read more','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_tr_nm",
		"title"   => __( '"Name" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Name:" label, to be displayed in Contact page', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Name:','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_tr_em",
		"title"   => __( '"Email" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Email:" label, to be displayed in Contact page', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Email:','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_tr_se",
		"title"   => __( '"Send Email" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Send Email" label, to be displayed in Contact page', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Send Email','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_trc_comm",
		"title"   => __( '"Comments" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Comments" label, to be displayed in Comments Form', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Comments','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_trc_lar",
		"title"   => __( '"Leave a reply" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Leave a reply" label, to be displayed in Comments Form', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Leave a reply','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_trc_repl",
		"title"   => __( '"Reply" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Reply" label, to be displayed in Comments Form', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Reply','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_trc_name",
		"title"   => __( '"Your Name" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Your Name" label, to be displayed in Comments Form', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Your Name','eet_textdomain')		
	);		
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_trc_website",
		"title"   => __( '"Your Website" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Your Website" label, to be displayed in Comments Form', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Website','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_trc_email",
		"title"   => __( '"Your Email" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Your Email" label, to be displayed in Comments Form', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Your Email','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_trc_comme",
		"title"   => __( '"Your Comment" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Your Comment" label, to be displayed in Comments Form', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Your Comment','eet_textdomain')		
	);
	
	$options[] = array(
		"section" => "translation",
		"id"      => eet_SHORTNAME . "_trc_pco",
		"title"   => __( '"Post Comment" label', 'eet_textdomain' ),
		"desc"    => __( 'Enter the text of the "Post Comment" label, to be displayed in Comments Form', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => __('Post Comment','eet_textdomain')		
	);
	
	
	$options[] = array(
		"section" => "social",
		"id"      => eet_SHORTNAME . "_socttwitter",
		"title"   => __( 'Twitter Footer Icon', 'eet_textdomain' ),
		"desc"    => __( 'Enter your Twitter username to display Twitter icon linking to your Twitter profile in footer. ', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => ""
	);
	
	$options[] = array(
		"section" => "social",
		"id"      => eet_SHORTNAME . "_socfb",
		"title"   => __( 'Facebook Footer Icon', 'eet_textdomain' ),
		"desc"    => __( 'Enter link to your Facebook profile to display Facebook icon linking to your Facebook profile in footer. (including the \'http://\') ', 'eet_textdomain' ),
		"type"    => "text",
		"std"     => ""
	);
	
	$options[] = array(
		"section" => "social",
		"id"      => eet_SHORTNAME . "_socrss",
		"title"   => __( 'RSS Footer Icon', 'eet_textdomain' ),
		"desc"    => __( 'Display RSS feed icon in footer?', 'eet_textdomain' ),
		"type"    => "select",
		"std"     => "yes",
		"choices" => array( "Yes", "No")  
	);
	
	return $options;	
}

/**
 * Contextual Help
 */
function eet_options_page_contextual_help() {
	
/*	$text 	= "<h3>" . __('eet Settings - Contextual Help','eet_textdomain') . "</h3>";
	$text 	.= "<p>" . __('Contextual help goes here. You may want to use different html elements to format your text as you want.','eet_textdomain') . "</p>";
	
	// must return text! NOT echo
	return $text;*/
} ?>