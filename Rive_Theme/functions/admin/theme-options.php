<?php

add_action('init', 'of_options');

if (!function_exists('of_options')) {

	function of_options() {
		global $of_options, $ch_fonts_default_options;
		$options = array();

		$themename = THEMENAME;

		// Populate siteoptions option in array for use in theme
		$of_options               = get_option('of_options');
		$GLOBALS['template_path'] = CH_FUNCTIONS;

		$of_categories     = array();
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
		}
		$categories_tmp = array_unshift($of_categories, "Select a category:");

		// Paypal currency codes array
		$paypal_currency_code = array('USD', 'AUD', 'CAD', 'CZK', 'DDK', 'EUR', 'HKD', 'HUF', 'JPY', 'NZD', 'PLN', 'GBP', 'SEK', 'CHF');

		// Currency codes array
		$currency_sign = array('$', 'Kč', 'Kr', '€', 'HK$', 'Ft', '¥', 'zł', '£', 'kr', 'CHF');

		// Tiled images hover effect array
		$tiled_hover_effect = array('normal', 'linear', 'ease', 'ease-in');

		// Tiled images effect array
		$tiled_image_effect = array('black_and_white', 'colored');

		// Tiled projects select from
		$tiled_select_from = array('parent page', 'exact id\'s');

		// Payment gateway used for causes
		$payment_gateway = array('PayPal', 'Authorize.net');

		// Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
		foreach ($of_pages_obj as $of_page) {
			$of_pages[$of_page->ID] = $of_page->post_name;
		}
		$of_pages_tmp = array_unshift($of_pages, "Select the Blog page:");

		// Footer Columns Array
		$footer_columns = array("1", "2", "3", "4");

		// Paths for "type" => "images"
		$layout_style = CH_ADMIN_IMAGES . '/layout/';
		$framesurl    = CH_ADMIN_IMAGES . '/image-frames/';

		// Access the WordPress Categories via an Array
		$exclude_categories = array();
		$exclude_categories_obj = get_categories('hide_empty=0');
		foreach ($exclude_categories_obj as $exclude_cat) {
			$exclude_categories[$exclude_cat->cat_ID] = $exclude_cat->cat_name;
		}

		$ch_fonts_default_options = array(
			'ch_primary_font_dark_font_face'   => 'Arial',
			'ch_primary_font_dark_font_weight' => 'normal',
			'ch_primary_font_dark_font_size'   => 13,
			'ch_primary_font_dark_line_height' => 20,
			'ch_primary_font_dark_bg'          => '#fff',

			'ch_headings_font_h1_font_face'   => 'Fjalla+One',
			'ch_headings_font_h1_font_weight' => 'normal',
			'ch_headings_font_h1_font_size'   => 26,
			'ch_headings_font_h1_line_height' => 40,
			'ch_headings_font_h1_bg'          => '#fff',

			'ch_headings_font_h2_font_face'   => 'Fjalla+One',
			'ch_headings_font_h2_font_weight' => 'normal',
			'ch_headings_font_h2_font_size'   => 24,
			'ch_headings_font_h2_line_height' => 40,
			'ch_headings_font_h2_bg'          => '#fff',

			'ch_headings_font_h3_font_face'   => 'Fjalla+One',
			'ch_headings_font_h3_font_weight' => 'normal',
			'ch_headings_font_h3_font_size'   => 23,
			'ch_headings_font_h3_line_height' => 40,
			'ch_headings_font_h3_bg'          => '#fff',

			'ch_headings_font_h4_font_face'   => 'Fjalla+One',
			'ch_headings_font_h4_font_weight' => 'normal',
			'ch_headings_font_h4_font_size'   => 21,
			'ch_headings_font_h4_line_height' => 20,
			'ch_headings_font_h4_bg'          => '#fff',

			'ch_headings_font_h5_font_face'   => 'Fjalla+One',
			'ch_headings_font_h5_font_weight' => 'normal',
			'ch_headings_font_h5_font_size'   => 19,
			'ch_headings_font_h5_line_height' => 20,
			'ch_headings_font_h5_bg'          => '#fff',

			'ch_headings_font_h6_font_face'   => 'Fjalla+One',
			'ch_headings_font_h6_font_weight' => 'normal',
			'ch_headings_font_h6_font_size'   => 16,
			'ch_headings_font_h6_line_height' => 20,
			'ch_headings_font_h6_bg'          => '#fff',

			'ch_footer_heading_font_face'   => 'Arial',
			'ch_footer_heading_weight'      => 'bold',
			'ch_footer_heading_font_size'   => 18,
			'ch_footer_heading_line_height' => 26,
			'ch_footer_heading_bg'          => '#000',

			'ch_footer_text_font_face'   => 'Arial',
			'ch_footer_text_font_weight' => 'normal',
			'ch_footer_text_font_size'   => 13,
			'ch_footer_text_line_height' => 20,
			'ch_footer_text_bg'          => '#000',

			'ch_footer_links_font_face'   => 'Arial',
			'ch_footer_links_font_weight' => 'normal',
			'ch_footer_links_font_size'   => 13,
			'ch_footer_links_line_height' => 20,
			'ch_footer_links_bg'          => '#000',

			'ch_links_font_font_face'   => 'Arial',
			'ch_links_font_font_weight' => 'normal',
			'ch_links_font_font_size'   => 13,
			'ch_links_font_line_height' => 20,
			'ch_links_font_bg'          => '#fff');

		// General options
		$options[] = array(
			"name"       => "General settings",
			"type"       => "heading",
			"menu_class" => "icon-cog-alt");

		$options[] = array(
			"name"  => "Website Logo",
			"desc"  => "Upload a custom logo for your Website.",
			"id"    => SHORTNAME . "_sitelogo",
			"order" => "",
			"type"  => "upload");


		$options[] = array(
			"name"  => "Default Layout",
			"desc"  => "Select a layout style.<br />(full, left side sidebar, right side sidebar)",
			"id"    => SHORTNAME . "_layout_style",
			"order" => "full",
			"type"  => "font-icons",
			"options" => array(
				'left'  => 'icon-th-list',
				'full'  => 'icon-menu',
				'right' => 'icon-th-list-right'));

		$options[] = array(
			"name"  => "Login Screen Logo",
			"desc"  => "Upload a custom logo.",
			"id"    => SHORTNAME . "_login_logo",
			"order" => "",
			"type"  => "upload");

		$options[] = array(
			"name"  => "Favicon",
			"desc"  => "Upload an image to use as your favicon",
			"id"    => SHORTNAME . "_favicon",
			"order" => "",
			"type"  => "upload");

		$options[] = array(
			"name"  => "Tracking Code or any other JavaScript",
			"desc"  => "Google Analytics tracking code or any other JavaScript",
			"id"    => SHORTNAME . "_tracking_code",
			"order" => "",
			"type"  => "textarea");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// Payment gateway settings
		$options[] = array(
			"name" => "Payment gateway",
			"type" => "block_open");

		$options[] = array(
			"name"    => "Currency code",
			"desc"    => "Select one of available currency codes.",
			"id"      => SHORTNAME . "_paypal_currency_code",
			"order"   => "USD",
			"type"    => "select",
			"options" => $paypal_currency_code);

		$options[] = array(
			"name"    => "Currency symbol",
			"desc"    => "Select one of available currency signs.",
			"id"      => SHORTNAME . "_currency_sign",
			"order"   => "$",
			"type"    => "select",
			"options" => $currency_sign);

		$options[] = array(
			"name"  => "Thank you page ID",
			"desc"  => "Thank you page ID",
			"id"    => SHORTNAME . "_paypal_thankyou",
			"order" => "",
			"type"  => "text");

		$options[] = array(
			"name"    => "Payment gateway",
			"desc"    => "Please select which payment gateway you would like to use for causes donations.",
			"id"      => SHORTNAME . "_payment_gateway",
			"order"   => "Select a payment gateway:",
			"type"    => "group_select",
			"options" => $payment_gateway);

		$options[] = array(
			"name"        => "Payment gateway",
			"type"        => "heading",
			"group_class" => "group_paypal",
			"no_id"       => true,
			"menu_class"  => "icon-credit-card");

		// Paypal settings
		$options[] = array(
			"name"  => "PayPal email",
			"desc"  => "PayPal business email which will receive donations",
			"id"    => SHORTNAME . "_paypal_email",
			"order" => "",
			"type"  => "text");

		$options[] = array(
			"name"  => "PayPal page logo",
			"desc"  => "Upload a custom logo for your PayPal donation page.",
			"id"    => SHORTNAME . "_paypallogo",
			"order" => "",
			"type"  => "upload");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// Open new group
		$options[] = array(
			"name"        => "",
			"type"        => "group_open",
			"group_class" => "group_authorizenet",
			"no_id"       => true);

		$options[] = array(
			"name"  => "API Login ID",
			"desc"  => "API Login ID",
			"id"    => SHORTNAME . "_api_login_id",
			"order" => "",
			"type"  => "text");

		$options[] = array(
			"name"  => "Transaction Key",
			"desc"  => "Transaction Key",
			"id"    => SHORTNAME . "_transaction_key",
			"order" => "",
			"type"  => "text");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");


		// Payment gateways close
		$options[] = array("name" => "",
			"type" => "block_close");


		// Twitter widget options
		$options[] = array(
			"name"       => "Twitter widget settings",
			"type"       => "heading",
			"menu_class" => "icon-twitter");

		$options[] = array(
			"name"  => "Consumer key",
			"desc"  => "Please enter your Twitter API consumer key",
			"id"    => SHORTNAME . "_twitter_consumer_key",
			"order" => "",
			"type"  => "text");

		$options[] = array(
			"name"  => "Consumer secret",
			"desc"  => "Please enter your Twitter API consumer secret",
			"id"    => SHORTNAME . "_twitter_consumer_secret",
			"order" => "",
			"type"  => "text");

		$options[] = array(
			"name"  => "Access token",
			"desc"  => "Please enter your Twitter API User Access token",
			"id"    => SHORTNAME . "_twitter_user_token",
			"order" => "",
			"type"  => "text");

		$options[] = array(
			"name"  => "Access token secret",
			"desc"  => "Please enter your Twitter API User Access token secret",
			"id"    => SHORTNAME . "_twitter_user_secret",
			"order" => "",
			"type"  => "text");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// Tiled images header settings
		$options[] = array(
			"name"       => "Tiled header settings",
			"type"       => "heading",
			"menu_class" => "icon-th-large");

		$options[] = array(
			"name"    => "Select projects from...",
			"desc"    => "You have two options, either to select all projects from parent page or select projects based on exact id's.",
			"id"      => SHORTNAME . "_select_projects_from",
			"order"   => "Select from:",
			"type"    => "select",
			"options" => $tiled_select_from);

		$options[] = array(
			"name"  => "Project ID's",
			"desc"  => "Specify one or more ID's separated by ';'. Example: 123;456;543;211",
			"id"    => SHORTNAME . "_project_ids",
			"order" => "",
			"type"  => "text");

		$options[] = array(
			"name"    => "Hover effect",
			"desc"    => "Tiled header image hover effect.",
			"id"      => SHORTNAME . "_tiled_hover_effect",
			"order"   => "Select a effect:",
			"type"    => "select",
			"options" => $tiled_hover_effect);

		$options[] = array(
			"name"   => "Hover effect slide speed",
			"desc"   => "Enter the desired amount of time in which hover effect should complete itself (in milliseconds).",
			"id"     => SHORTNAME . "_tiled_hover_speed",
			"order"  => "300",
			"type"   => "text",
			"slider" => "yes");

		$options[] = array(
			"name"    => "Images effect",
			"desc"    => "Tiled header image effect.",
			"id"      => SHORTNAME . "_tiled_image_effect",
			"order"   => "Select a effect:",
			"type"    => "select",
			"options" => $tiled_image_effect);

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// Homepage settions
		$options[] = array(
			"name"       => "Content slider",
			"type"       => "heading",
			"menu_class" => "icon-picture");

		$options[] = array(
			"name"    => "Slider category",
			"desc"    => "Select category that will be used for generating the slides.",
			"id"      => SHORTNAME . "_coin_slider_category",
			"order"   => "Select a category:",
			"type"    => "select",
			"options" => $of_categories);

		$options[] = array(
			"name"  => "Slider title",
			"desc"  => "Please enter slider title",
			"id"    => SHORTNAME . "_content_slider_title",
			"order" => "<span>Latest</span> News",
			"type"  => "text");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// Breadcrumbs
		$options[] = array(
			"name"       => "Breadcrumbs",
			"type"       => "heading",
			"menu_class" => "icon-cog");

		$options[] = array(
			"name"  => "Disable Breadcrumbs",
			"desc"  => "Breadcrumbs are displayed by default",
			"id"    => SHORTNAME . "_breadcrumb",
			"order" => "false",
			"type"  => "checkbox");

		$options[] = array(
			"name"  => "Breadcrumb Delimiter",
			"desc"  => "This is the symbol that will appear in between your breadcrumbs",
			"id"    => SHORTNAME . "_breadcrumb_delimiter",
			"order" => "",
			"type"  => "text");

		$options[] = array(
			"name"  => "Custom post types",
			"desc"  => "You can point to which page ID custom post types should redirect, separate everything with ':'",
			"id"    => SHORTNAME . "_breadcrumb_custom",
			"order" => "ch_staff:1270:ch_cause:1695",
			"type"  => "text");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// CSS options
		$options[] = array(
			"name"       => "CSS settings",
			"type"       => "heading",
			"menu_class" => "icon-css");

		$options[] = array(
			"name"  => "Custom CSS",
			"desc"  => "Custom CSS to your website",
			"id"    => SHORTNAME . "_custom_css",
			"order" => "",
			"type"  => "textarea");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// Javascript options
		$options[] = array(
			"name"       => "JavaScript settings",
			"type"       => "heading",
			"menu_class" => "icon-code-1");

		$options[] = array(
			"name"  => "Google Maps API Key (v2 or v3)",
			"desc"  => "Enter your Google Maps API Key (v2 or v3)",
			"id"    => SHORTNAME . "_google_maps_api_key",
			"order" => "",
			"type"  => "text");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// Typography options
		$options[] = array(
			"name"       => "Typography",
			"type"       => "heading",
			"menu_class" => "icon-font");
		
		$options[] = array(
			"name"  => "Load cyrillic font subset",
			"desc"  => "Check if you want to load this font subset.",
			"id"    => SHORTNAME . "_subset_cyrillic",
			"order" => "false",
			"type"  => "checkbox");

		$options[] = array(
			"name"  => "Load greek font subset",
			"desc"  => "Check if you want to load this font subset.",
			"id"    => SHORTNAME . "_subset_greek",
			"order" => "false",
			"type"  => "checkbox");

		$options[] = array(
			"name"  => "Load latin font subset",
			"desc"  => "Check if you want to load this font subset.",
			"id"    => SHORTNAME . "_subset_latin",
			"order" => "true",
			"type"  => "checkbox");

		$options[] = array(
			"name"  => "Load latin-extended font subset",
			"desc"  => "Check if you want to load this font subset.",
			"id"    => SHORTNAME . "_subset_latin_ext",
			"order" => "false",
			"type"  => "checkbox");

		$options[] = array(
			"name"   => "Primary font (dark)",
			"desc"   => "Primary font dark style",
			"id"     => SHORTNAME . "_primary_font_dark",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "25",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "333333");

		$options[] = array(
			"name"   => "Headings font (H1)",
			"desc"   => "Headings font style",
			"id"     => SHORTNAME . "_headings_font_h1",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "000000");

		$options[] = array(
			"name"   => "Headings font (H2)",
			"desc"   => "Headings font style",
			"id"     => SHORTNAME . "_headings_font_h2",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "000000");

		$options[] = array(
			"name"   => "Headings font (H3)",
			"desc"   => "Headings font style",
			"id"     => SHORTNAME . "_headings_font_h3",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "000000");

		$options[] = array(
			"name"   => "Headings font (H4)",
			"desc"   => "Headings font style",
			"id"     => SHORTNAME . "_headings_font_h4",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "000000");

		$options[] = array(
			"name"   => "Headings font (H5)",
			"desc"   => "Headings font style",
			"id"     => SHORTNAME . "_headings_font_h5",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "000000");

		$options[] = array(
			"name"   => "Headings font (H6)",
			"desc"   => "Headings font style",
			"id"     => SHORTNAME . "_headings_font_h6",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "000000");

		$options[] = array(
			"name"   => "Footer headings font (light)",
			"desc"   => "Footer headings font style",
			"id"     => SHORTNAME . "_footer_heading",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "ffffff");

		$options[] = array(
			"name"   => "Footer text font (light)",
			"desc"   => "Footer text font style",
			"id"     => SHORTNAME . "_footer_text",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "5d5d5d");

		$options[] = array(
			"name"   => "Normal links font",
			"desc"   => "Normal links font style",
			"id"     => SHORTNAME . "_links_font",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "266dc4");

		$options[] = array(
			"name"   => "Footer links font",
			"desc"   => "Footer links font style",
			"id"     => SHORTNAME . "_footer_links",
			"order"  => "",
			"type"   => "font",
			"min_px" => "8",
			"max_px" => "35",
			"min_ln" => "8",
			"max_ln" => "50",
			"color"  => "ffffff");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// Footer options
		$options[] = array(
			"name"       => "Footer",
			"type"       => "heading",
			"menu_class" => "icon-sitemap");

		$options[] = array(
			"name"    => "Footer Columns",
			"desc"    => "Select the number of columns you would like to display in the footer",
			"id"      => SHORTNAME . "_footer_columns",
			"order"   => "4",
			"type"    => "select",
			"options" => $footer_columns,
			"slider"  => "yes");

		// Close this group
		$options[] = array(
			"name" => "",
			"type" => "group_close");

		// 404 page settings
		$options[] = array(
			"name"       => "404 page",
			"type"       => "heading",
			"menu_class" => "icon-attention-1");

		$options[] = array(
			"name"   => "404 Page Title",
			"desc"   => "Set the page title that is displayed on the 404 Error Page",
			"id"     => SHORTNAME . "_404_title",
			"order"  => "This is somewhat embarrassing, isn't it?",
			"type"   => "text",
			"slider" => "no");

		$options[] = array(
			"name"  => "404 Message",
			"desc"  => "Set the message that is displayed on the 404 Error Page",
			"id"    => SHORTNAME . "_404_message",
			"order" => "It seems we can’t find what you’re looking for. Perhaps searching, or one of the links below, can help.",
			"type"  => "textarea");

		update_option('of_template', $options);
		update_option('of_themename', $themename);
		update_option('of_shortname', SHORTNAME);
	}
}