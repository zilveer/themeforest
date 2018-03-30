<?php
/**
 * Theme Option Defaults and Functions
 *
 * Options Framework Plugin by Devin Price
 * http://wordpress.org/extend/plugins/options-framework/
 */

/**
 * Change location of options.php
 * The Options Framework (if installed) that options.php (this file) is in non-standard location
 */

function options_framework_location_override() {
    return array( RISEN_INC_REL . '/options.php' );
}

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

if ( ! function_exists( 'optionsframework_option_name' ) ) {

	function optionsframework_option_name() {

		$optionsframework_settings = get_option( 'optionsframework' );
		$optionsframework_settings['id'] = 'risen'; // set explicitly so that same ID is used for both parent and child

		update_option( 'optionsframework', $optionsframework_settings );

	}

}

/**
 * Get Option Value
 *
 * This gets the option value saved in Options Framework
 * If no value saved or if plugin not activated, it gets the default value from risen_option_default()
 */

if ( ! function_exists( 'risen_option' ) ) {

	function risen_option( $name ) {

		$default = risen_option_default( $name ); // if there is a default value

		if ( function_exists( 'of_get_option' ) ) { // Options Framework is active
			$value = trim( of_get_option( $name, $default ) ); // if user has not saved this option yet, use default - this makes "reality" match the defaults that show in options
		} else { // Plugin not installed/activated, use default value from risen_option_default()
			$value = $default; // Check if default value exists
		}

		// filtering helps with demo style picker
		$value = apply_filters( 'risen_option', $value, $name );

		return $value;

	}

}

/**
 * Show a link to the theme options page if the Options Framework plugin is not installed
 */

function risen_options_inactive() {

	// optionsframework_init for Options Framework 1.7; optionsframework_add_page for older (removed in 1.7)
	if ( ! function_exists( 'optionsframework_add_page' ) && ! function_exists( 'optionsframework_init' ) && current_user_can( 'edit_theme_options' ) ) {
		add_theme_page( 'themes.php', __( 'Theme Options', 'risen' ), 'edit_theme_options', 'options-framework', 'optionsframework_page_notice' );
	}

}

/**
 * Displays a notice on the theme options page if the Options Framework plugin is not installed
 * This information from Jason Schuller and James Lao was useful: http://theme.it/how-to-display-an-admin-notice-for-required-theme-plugins/
 */

if ( ! function_exists( 'optionsframework_page_notice' ) ) {

    function optionsframework_page_notice() {

		$title = __( 'Theme Options', 'risen' );
		$plugin_url = network_admin_url( 'plugin-install.php?s=' . urlencode( '"Options Framework"' ) . '&tab=search' );

		$multimedia_word = strtolower( risen_option( 'multimedia_word_plural' ) );

		$plugins_url = admin_url( 'plugins.php' );

echo <<< HTML

        <div class="wrap">

			<h2>$title</h2>

			<p>
				<b>Please install the <a href="$plugin_url">Options Framework</a> plugin to use the theme options.</b>
				If you already installed it but still see this message, <a href="$plugins_url">activate</a> the plugin.
			</p>

			<p>
				Once the plugin is activated you will have options to:
			</p>

			<ul class="ul-disc">
				<li>Upload your logo</li>
				<li>Choose colors, fonts and background</li>
				<li>Edit slider and homepage settings</li>
				<li>Manage social media icons</li>
				<li>Edit settings for $multimedia_word, gallery, events and blog</li>
				<li>Configure the contact form</li>
				<li>Configure Google Maps</li>
				<li>Insert Google Analytics code</li>
				<li>Upload your favicon</li>
				<li>And more...</li>
			</ul>

			<p>Currently the theme is using default settings.</p>

        </div>

HTML;

    }

}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 */

if ( ! function_exists( 'optionsframework_options' ) ) {

	function optionsframework_options() {

		$options = array();

		// Font Options
		$font_options = array();
		$risen_google_web_fonts = risen_google_web_fonts();
		foreach ( $risen_google_web_fonts as $font_name => $font_data ) { // loop fonts
			$font_options[$font_name] = $font_name . ( ! empty( $font_data['type'] ) ? ' (' . $font_data['type'] . ')' : '' );
		}
		ksort( $font_options ); // alphabetical

		// Branding

		$options[] = array(
			"name" => _x( 'Styles', 'options', 'risen' ),
			"type" => "heading"
		);

			// Base Style (Light or Dark)
			$options[] = array(
				"name"		=> __( 'Base Style', 'risen' ),
				"id"		=> "base_style",
				"type"		=> "radio",
				"options"	=> risen_base_styles(), // options based on what is in the styles directory
				"desc"		=> __( 'Choose a light or dark appearance then customize colors, background and fonts below.', 'risen' ),
				"std"		=> risen_option_default( 'base_style' )
			);

			// Solid Color

			$options[] = array(
				"name"		=> __( 'Main Color', 'risen' ),
				"id" 		=> "main_color",
				"type" 		=> "color",
				"desc" 		=> __( 'The menu bar and other elements use this.', 'risen' ),
				"std"		=> risen_option_default( 'main_color' )
			);

			// Link Color

			$options[] = array(
				"name"		=> __( 'Link Color', 'risen' ),
				"id" 		=> "link_color",
				"type" 		=> "color",
				"std"		=> risen_option_default( 'link_color' )
			);

			// Background Type

			$options[] = array(
				"name"		=> __( 'Background Type', 'risen' ),
				"id" 		=> "background_type",
				"type" 		=> "radio",
				"options" => array(
					'color'				=> __( 'Solid Color', 'risen' ),
					'preset'			=> __( 'Preset Background', 'risen' ),
					'upload'			=> __( 'Custom Upload', 'risen' )
				),
				"std"		=> risen_option_default( 'background_type' ),
				"desc" 		=> __( 'Use a solid color, preset background (some of which can be colored) or upload your own image/pattern.', 'risen' ),
				"class"		=> ""
			);

			// Background Image (Presets)

			$background_preset_options = array();
			$background_presets = risen_background_image_presets();
			foreach ( $background_presets as $image_file => $background_data ) {

				// if image exists in child theme, use it; otherwise use parent theme's file
				$thumb_url = risen_locate_template_uri( 'images/backgrounds/' . $background_data['thumb'] );

				if ( ! empty( $thumb_url ) ) {
					$background_preset_options[$image_file] = $thumb_url;
				}

			}

			$options[] = array(
				"name"		=> __( 'Background Image (Preset)', 'risen' ),
				"id" 		=> "background_image_preset",
				"type" 		=> "images",
				"options"	=> $background_preset_options,
				"std"		=> risen_option_default( 'background_image_preset' ),
				"desc" 		=> __( 'If the preset background you choose is semi-transparent, you can choose a background color that will show through it.', 'risen' ),
				"class"		=> "background-type-preset"
			);

			// Background Image (Upload)

			$options[] = array(
				"name" 	=> __( 'Background Image (Upload)', 'risen' ),
				"desc" 	=> __( 'Upload your own custom background image.', 'risen' ),
				"id" 	=> "background_image_upload",
				"type" 	=> "upload",
				"class"	=> "background-type-upload"
			);

			// Background Fullscreen (Upload)

			$options[] = array(
				"name" 	=> __( 'Background Image Fullscreen', 'risen' ),
				"desc" 	=> __( 'Scale the background to cover the whole screen (ideal for large photos)', 'risen' ),
				"id" 	=> "background_image_upload_fullscreen",
				"type" 	=> "checkbox",
				"class"	=> "background-type-upload"
			);

			// Background Repeat (Upload)

			$options[] = array(
				"name"		=> __( 'Background Image Repeat', 'risen' ),
				"id" 		=> "background_image_upload_repeat",
				"type" 		=> "radio",
				"options" => array(
					'repeat'	=> _x( 'Repeat', 'background image', 'risen' ),
					'repeat-x'	=> __( 'Repeat Horizontally', 'risen' ),
					'repeat-y'	=> __( 'Repeat Vertically', 'risen' ),
					'no-repeat'	=> __( 'No Repeat', 'risen' )
				),
				"std"		=> risen_option_default( 'background_image_upload_repeat' ),
				"desc" 		=> __( 'Choose whether or not you want your uploaded background to tile.', 'risen' ),
				"class"		=> "background-type-upload background-no-fullscreen"
			);

			// Background Attachment (Upload)

			$options[] = array(
				"name"		=> __( 'Background Image Attachment', 'risen' ),
				"id" 		=> "background_image_upload_attachment",
				"type" 		=> "radio",
				"options" => array(
					'scroll'	=> _x( 'Scroll', 'background image', 'risen' ),
					'fixed'		=> _x( 'Fixed', 'background image', 'risen' )
				),
				"std"		=> risen_option_default( 'background_image_upload_attachment' ),
				"desc" 		=> __( 'The default is for your background image to scroll with the page. You can also make it fixed.', 'risen' ),
				"class"		=> "background-type-upload background-no-fullscreen"
			);

			// Background Position (Upload)

			$options[] = array(
				"name"		=> __( 'Background Image Position (CSS)', 'risen' ),
				"id" 		=> "background_image_upload_position",
				"type" 		=> "text",
				"desc" 		=> __( 'This is an optional field in which you can enter a value for the <a href="http://www.w3.org/TR/css3-background/#the-background-position" target="_blank">CSS background-position</a> property.', 'risen' ),
				"class"		=> "mini background-type-upload background-no-fullscreen"
			);

			// Background Size (Upload)

			$options[] = array(
				"name"		=> __( 'Background Image Size (CSS)', 'risen' ),
				"id" 		=> "background_image_upload_size",
				"type" 		=> "text",
				"desc" 		=> __( 'This is an optional field in which you can enter a value for the <a href="http://www.w3.org/TR/css3-background/#the-background-size" target="_blank">CSS background-size</a> property.', 'risen' ),
				"class"		=> "mini background-type-upload background-no-fullscreen"
			);

			// Background Color

			$options[] = array(
				"name"		=> __( 'Background Color', 'risen' ),
				"id" 		=> "background_color",
				"type" 		=> "color",
				"std"		=> risen_option_default( 'background_color' ),
				"desc" 		=> "If you use a background image, note that semi-transparent images will show this color through while solid background images will override this.",
				"class"		=> "background-type-color background-type-preset background-type-upload"
			);

			// Body Font

			$options[] = array(
				"name"		=> __( 'Body Font', 'risen' ),
				"id" 		=> "body_font",
				"type" 		=> "select",
				"options" 	=> $font_options,
				"std"		=> risen_option_default( 'body_font' ),
				"desc" 		=> __( 'Font used for main content. <b>Browsing Tip:</b> select a font then use your keyboard\'s up and down arrows for quicker viewing.', 'risen' ),
				"class"		=> ""
			);

			// Menu Font

			$options[] = array(
				"name"		=> __( 'Menu / Labels Font', 'risen' ),
				"id" 		=> "menu_font",
				"type" 		=> "select",
				"options" 	=> $font_options,
				"std"		=> risen_option_default( 'menu_font' ),
				"desc" 		=> __( 'Font used for menu bar and labels.', 'risen' ),
				"class"		=> ""
			);

			// Heading Font

			$options[] = array(
				"name"		=> __( 'Heading Font', 'risen' ),
				"id" 		=> "heading_font",
				"type" 		=> "select",
				"options" 	=> $font_options,
				"std"		=> risen_option_default( 'heading_font' ),
				"desc" 		=> __( 'Font used for headings, home intro and tagline.', 'risen' ),
				"class"		=> ""
			);

			// Character Sets

			$options[] = array(
				"name"		=> __( 'Character Sets (Optional)', 'risen' ),
				"id" 		=> "font_subsets",
				"type" 		=> "text",
				"desc" 		=> __( 'Some <a href="http://www.google.com/webfonts/" target="_blank">Google Web Fonts</a> support multiple character sets (e.g. <i>latin, cyrillic, greek, khmer, vietnamese</i>). If no character set is specified, <i>latin</i> is used &mdash; and that is adequate in most cases. If necessary, enter multiple character sets separated by commas.', 'risen' ),
				"class"		=> "risen-option-wide"
			);

		// Header

		$options[] = array(
			"name" => _x( 'Header', 'options', 'risen' ),
			"type" => "heading"
		);

			// Logo Image

			$options[] = array(
				"name" 	=> __( 'Logo Image', 'risen' ),
				"desc" 	=> sprintf( __( 'Logo should be PNG with height no greater than 80 pixels. A width less than 300 pixels is preferred for a good fit on most mobile phones. Tagline is set in WordPress <a href="%s">General Settings</a>.', 'risen' ), admin_url( 'options-general.php' ) ),
				"id" 	=> "logo",
				"type" 	=> "upload"
			);

			// No Padding

			$options[] = array(
				"desc" 	=> __( 'No left padding', 'risen' ),
				"id" 	=> "logo_no_left_padding",
				"type" 	=> "checkbox"
			);

			// Retina Logo Image

			$options[] = array(
				"name" 	=> __( 'Retina Logo Image', 'risen' ),
				"desc" 	=> __( 'Optionally provide a logo image for Retina devices. It should be exactly twice as big as the regular logo. You must also provide the regular logo image above.', 'risen' ),
				"id" 	=> "logo_hidpi",
				"type" 	=> "upload"
			);

			// Header Social Media Icons

			$options[] = array(
				"name" 	=> __( 'Header Icons', 'risen' ),
				"desc" 	=> sprintf( __( 'Enter your social media URL\'s (one per line) in the order you want icons to be shown in the header. Icons exist for the following: %s. For RSS, you can enter the [feed_url] shortcode or a FeedBurner URL. <b>Note:</b> if your menu is large and you have many icons, they will not show in order to make room for the menu (reduce your icons or menu).', 'risen' ), risen_icon_sites() ),
				"id" 	=> "header_icon_urls",
				"std" 	=> risen_option_default( 'header_icon_urls' ),
				"type" 	=> "textarea"
			);


		// Footer

		$options[] = array(
			"name" => _x( 'Footer', 'options', 'risen' ),
			"type" => "heading"
		);

			// Footer Social Media Icons

			$options[] = array(
				"name" 	=> __( 'Footer Icons', 'risen' ),
				"desc" 	=> sprintf( __( 'Enter your social media URL\'s (one per line) in the order you want icons to be shown in the footer. Icons exist for the following: %s. For RSS, you can enter the [feed_url] shortcode or a FeedBurner URL.', 'risen' ), risen_icon_sites() ),
				"id" 	=> "footer_icon_urls",
				"std" 	=> risen_option_default( 'footer_icon_urls' ),
				"type" 	=> "textarea"
			);

			// Address Line

			$options[] = array(
				"name"	=> __( 'Address', 'risen' ),
				"desc" 	=> __( 'Optionally enter your address on one line to show in the footer.', 'risen' ),
				"id" 	=> "footer_address",
				"std" 	=> risen_option_default( 'footer_address' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

			// Non-church Icon

			$options[] = array(
				"desc" 	=> __( 'Use generic icon', 'risen' ),
				"id" 	=> "footer_address_non_church",
				"type" 	=> "checkbox"
			);

			// Phone

			$options[] = array(
				"name"	=> __( 'Phone', 'risen' ),
				"desc" 	=> __( 'Optionally enter your phone number to show in the footer.', 'risen' ),
				"id" 	=> "footer_phone",
				"std" 	=> risen_option_default( 'footer_phone' ),
				"type" 	=> "text"
			);

			// Copyright

			$options[] = array(
				"name"	=> __( 'Copyright', 'risen' ),
				"desc" 	=> sprintf( __( '[copyright_symbol], [current_year] and [site_name] shortcodes can be used. Site name is set in WordPress <a href="%s">General Settings</a>.', 'risen' ), admin_url( 'options-general.php' ) ),
				"id" 	=> "footer_copyright",
				"std" 	=> risen_option_default( 'footer_copyright' ),
				"type" 	=> "textarea"
			);

		// Homepage

		$options[] = array(
			"name" => _x( 'Homepage', 'options', 'risen' ),
			"type" => "heading"
		);

			// Show Slider

			$options[] = array(
				"name" 	=> __( 'Enable Slider', 'risen' ),
				"desc" 	=> __( 'Show slider on homepage', 'risen' ),
				"id" 	=> "slider_enabled",
				"std" 	=> risen_option_default( 'slider_enabled' ),
				"type" 	=> "checkbox"
			);

			// Slider Automation

			$options[] = array(
				"name" 	=> __( 'Slider Automation', 'risen' ),
				"desc" 	=> __( 'Automatically transition to the next slide (see below)', 'risen' ),
				"id" 	=> "slider_slideshow",
				"type" 	=> 'checkbox',
				"std" 	=> risen_option_default( 'slider_slideshow' )
			);

			// Slider Speed

			$options[] = array(
				"name" 	=> __( 'Slider Speed', 'risen' ),
				"desc" 	=> __( 'If Slider Automation is enabled, this is how many seconds to wait before proceeding to the next slide.', 'risen' ),
				"id" 	=> "slider_speed",
				"type" 	=> 'text',
				"std" 	=> risen_option_default( 'slider_speed' ),
				"class" => 'mini'
			);

			// Intro Message

			$options[] = array(
				"name" 	=> __( 'Intro Message', 'risen' ),
				"desc" 	=> __( 'Optionally provide a short welcome message to show on the homepage. You may want to spice up a portion by making it bold with HTML (e.g. "&lt;b&gt;Welcome to Risen.&lt;/b&gt; The rest...").', 'risen' ),
				"id"	=> "home_intro",
				"std" 	=> risen_option_default( 'home_intro' ),
				"type"	=> "textarea"
			);

		// Multimedia (Sermons)

		$options[] = array(
			"name" => risen_option( 'multimedia_word_plural' ),
			"type" => "heading"
		);

			// Multimedia Word

			$options[] = array(
				"name" 	=> __( 'Plural &quot;Multimedia&quot; Word', 'risen' ),
				"desc" 	=> __( 'You can change the name of the multimedia features throughout the site and admin interface.', 'risen' ),
				"id" 	=> "multimedia_word_plural",
				"std" 	=> risen_option_default( 'multimedia_word_plural' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

			$options[] = array(
				"name" 	=> __( 'Singular &quot;Multimedia&quot; Word', 'risen' ),
				"id" 	=> "multimedia_word_singular",
				"std" 	=> risen_option_default( 'multimedia_word_singular' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

			// Per Page

			$options[] = array(
				"name" 	=> __( 'Items Per Page', 'risen' ),
				"desc" 	=> __( 'The number of multimedia items to show per page.', 'risen' ),
				"id" 	=> "multimedia_per_page",
				"std" 	=> risen_option_default( 'multimedia_per_page' ),
				"type" 	=> "text",
				"class" => "mini"
			);

			// Header Image

			$options[] = array(
				"name" 	=> __( 'Header Image', 'risen' ),
				"desc" 	=> __( '<i>Archives</i> &mdash; Show the header image from the page using the Multimedia template.', 'risen' ),
				"id" 	=> "multimedia_header_image_archives",
				"std" 	=> risen_option_default( 'multimedia_header_image_archives' ),
				"type" 	=> "checkbox"
			);

			$options[] = array(
				"desc" 	=> __( '<i>Single Item</i> &mdash; Show the header image from the page using the Multimedia template (unless item has its own).', 'risen' ),
				"id" 	=> "multimedia_header_image_single",
				"std" 	=> risen_option_default( 'multimedia_header_image_single' ),
				"type" 	=> "checkbox"
			);

			// Category Page Title

			$options[] = array(
				"name" 	=> __( 'Category Page Title', 'risen' ),
				"desc" 	=> __( 'This is the title format that multimedia category pages use. The [category] shortcode is automatically replaced.', 'risen' ),
				"id" 	=> "multimedia_category_title",
				"std" 	=> risen_option_default( 'multimedia_category_title' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

			// Tag Page Title

			$options[] = array(
				"name" 	=> __( 'Tag Page Title', 'risen' ),
				"desc" 	=> __( 'This is the title format that multimedia tag pages use. The [tag] shortcode is automatically replaced.', 'risen' ),
				"id" 	=> "multimedia_tag_title",
				"std" 	=> risen_option_default( 'multimedia_tag_title' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

			// Date Archive Page Title

			$options[] = array(
				"name" 	=> __( 'Date Archive Page Title', 'risen' ),
				"desc" 	=> __( 'This is the title format that multimedia date archives use. The [date] shortcode is automatically replaced.', 'risen' ),
				"id" 	=> "multimedia_archive_title",
				"std" 	=> risen_option_default( 'multimedia_archive_title' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

			// Speaker Page Title

			$options[] = array(
				"name" 	=> __( 'Speaker Page Title', 'risen' ),
				"desc" 	=> __( 'This is the title format that multimedia speaker pages use. The [speaker] shortcode is automatically replaced.', 'risen' ),
				"id" 	=> "multimedia_speaker_title",
				"std" 	=> risen_option_default( 'multimedia_speaker_title' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

		// Gallery

		$options[] = array(
			"name" => _x( 'Gallery', 'theme options', 'risen' ),
			"type" => "heading"
		);

			// Categories Order

			$options[] = array(
				"name" 	=> __( 'Categories Order', 'risen' ),
				"desc" 	=> __( 'This controls the order in which categories are listed on the page using the Gallery Categories template.', 'risen' ),
				"id" 	=> "gallery_categories_order",
				"options"	=> array(
					'alphabetical'	=> _x( 'Alphabetical', 'sorting', 'risen' ),
					'new_to_old'	=> _x( 'Newest First', 'sorting', 'risen' ),
					'old_to_new'	=> _x( 'Oldest First', 'sorting', 'risen' ),
					'count'			=> _x( 'Highest Count', 'sorting', 'risen' )
				),
				"std" 	=> risen_option_default( 'gallery_categories_order' ),
				"type" 	=> "select"
			);

			// Per Page

			$options[] = array(
				"name" 	=> __( 'Images/Videos Per Page', 'risen' ),
				"desc" 	=> __( 'The number of gallery items to show per page.', 'risen' ),
				"id" 	=> "gallery_per_page",
				"std" 	=> risen_option_default( 'gallery_per_page' ),
				"type" 	=> "text",
				"class" => "mini"
			);

			// Gallery Page

			$options[] = array(
				"name" 	=> __( 'Main Gallery Page', 'risen' ),
				"desc" 	=> __( 'Specify a gallery page for category and single item pages to inherit a header image and sidebar from (see below). This also assists with the breadcrumb path.', 'risen' ),
				"id" 	=> "gallery_page_id",
				"options" => risen_page_options(),
				"std" 	=> risen_option_default( 'gallery_page_id' ),
				"type" 	=> "select"
			);

			// Header Image

			$options[] = array(
				"name" 	=> __( 'Header Image', 'risen' ),
				"desc" 	=> __( '<i>Single Category Page</i> &mdash; Show the header image and sidebar from the page specified above.', 'risen' ),
				"id" 	=> "gallery_page_inherit_archives",
				"std" 	=> risen_option_default( 'gallery_page_inherit_archives' ),
				"type" 	=> "checkbox"
			);

			$options[] = array(
				"desc" 	=> __( '<i>Single Image/Video Page</i> &mdash; Show the header image from the page specified above.', 'risen' ),
				"id" 	=> "gallery_page_inherit_single",
				"std" 	=> risen_option_default( 'gallery_page_inherit_single' ),
				"type" 	=> "checkbox"
			);

			// Category Page Title

			$options[] = array(
				"name" 	=> __( 'Single Category Page Title', 'risen' ),
				"desc" 	=> __( 'This is the title format that single category pages use. The [category] shortcode is automatically replaced.', 'risen' ),
				"id" 	=> "gallery_category_title",
				"std" 	=> risen_option_default( 'gallery_category_title' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

		// Events

		$options[] = array(
			"name" => _x( 'Events', 'theme options', 'risen' ),
			"type" => "heading"
		);

			// Per Page

			$options[] = array(
				"name" 	=> __( 'Events Per Page', 'risen' ),
				"desc" 	=> __( 'The number of events to show per page.', 'risen' ),
				"id" 	=> "events_per_page",
				"std" 	=> risen_option_default( 'events_per_page' ),
				"type" 	=> "text",
				"class" => "mini"
			);

			// Header Image

			$options[] = array(
				"name" 	=> __( 'Header Image', 'risen' ),
				"desc" 	=> __( '<i>Single Event Page</i> &mdash; Show header from the page using the Upcoming or Past Events template (unless event has its own).', 'risen' ),
				"id" 	=> "events_header_image_single",
				"std" 	=> risen_option_default( 'events_header_image_single' ),
				"type" 	=> "checkbox"
			);

		// Blog

		$options[] = array(
			"name" => _x( 'Blog', 'theme options', 'risen' ),
			"type" => "heading"
		);

			// Header Image

			$options[] = array(
				"name" 	=> __( 'Header Image', 'risen' ),
				"desc" 	=> __( '<i>Archives</i> &mdash; Show the header image from the page using the Blog template.', 'risen' ),
				"id" 	=> "blog_header_image_archives",
				"std" 	=> risen_option_default( 'blog_header_image_archives' ),
				"type" 	=> "checkbox"
			);

			$options[] = array(
				"desc" 	=> __( '<i>Single Item</i> &mdash; Show the header image from the page using the Blog template (unless item has its own).', 'risen' ),
				"id" 	=> "blog_header_image_single",
				"std" 	=> risen_option_default( 'blog_header_image_single' ),
				"type" 	=> "checkbox"
			);

			// Category Page Title

			$options[] = array(
				"name" 	=> __( 'Category Page Title', 'risen' ),
				"desc" 	=> __( 'This is the title format that blog category pages use. The [category] shortcode is automatically replaced.', 'risen' ),
				"id" 	=> "blog_category_title",
				"std" 	=> risen_option_default( 'blog_category_title' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

			// Tag Page Title

			$options[] = array(
				"name" 	=> __( 'Tag Page Title', 'risen' ),
				"desc" 	=> __( 'This is the title format that blog tag pages use. The [tag] shortcode is automatically replaced.', 'risen' ),
				"id" 	=> "blog_tag_title",
				"std" 	=> risen_option_default( 'blog_tag_title' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

			// Date Archive Page Title

			$options[] = array(
				"name" 	=> __( 'Date Archive Page Title', 'risen' ),
				"desc" 	=> __( 'This is the title format that blog date archives use. The [date] shortcode is automatically replaced.', 'risen' ),
				"id" 	=> "blog_archive_title",
				"std" 	=> risen_option_default( 'blog_archive_title' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

			// Author Page Title

			$options[] = array(
				"name" 	=> __( 'Author Page Title', 'risen' ),
				"desc" 	=> __( 'This is the title format that blog author pages use. The [author] shortcode is automatically replaced.', 'risen' ),
				"id" 	=> "blog_author_title",
				"std" 	=> risen_option_default( 'blog_author_title' ),
				"type" 	=> "text",
				"class"		=> "risen-option-wide"
			);

		// Contact Form

		$options[] = array(
			"name" => __( 'Contact Form', 'risen' ),
			"type" => "heading"
		);

			// Contacts

			$options[] = array(
				"name" 	=> __( 'Contacts', 'risen' ),
				"desc" 	=> sprintf( __( 'You can enter multiple contacts here to show in a "To" selector on the contact form. Each contact should be made up of a name and e-mail address separated by a comma. An example contact would be <i>John Smith, email@whatever.com</i>. Enter one contact per line.', 'risen' ), risen_icon_sites() ),
				"id" 	=> "contacts",
				"std" 	=> risen_option_default( 'contacts' ),
				"type" 	=> "textarea"
			);

			// Public Key

			$options[] = array(
				"name" 	=> _x( 'reCAPTCHA Site Key', 'recaptcha', 'risen' ),
				"desc" 	=> __( 'Optionally provide your <a href="https://www.google.com/recaptcha/admin/create" target="_blank">reCAPTCHA</a> keys if you want to add spam protection to the contact form.', 'risen' ),
				"id" 	=> "recaptcha_public_key",
				"std" 	=> '',
				"class"		=> "risen-option-wide",
				"type" 	=> 'text'
			);

			// Private Key

			$options[] = array(
				"name" 	=> _x( 'reCAPTCHA Secret Key', 'recaptcha', 'risen' ),
				"id" 	=> "recaptcha_private_key",
				"std" 	=> '',
				"class"		=> "risen-option-wide",
				"type" 	=> 'text'
			);

		// Other

		$options[] = array(
			"name" => _x( 'Other', 'options', 'risen' ),
			"type" => "heading"
		);

			// Google Maps API Key
			$options[] = array(
				"name" 	=> __( 'Google Maps API Key', 'risen' ),
				"desc" 	=> __( 'An API Key for Google Maps is required for showing maps on events and locations. <a href="http://stevengliebe.com/projects/wordpress-themes/risen/docs/#theme-options" target="_blank">Get an API Key</a>.', 'risen' ),
				"id" 	=> "gmaps_api_key",
				"std" 	=> '',
				"type" 	=> 'text',
				"class"		=> "risen-option-wide"
			);

			// Google Analytics

			$options[] = array(
				"name" 	=> __( 'Google Analytics', 'risen' ),
				"desc" 	=> __( 'Enter your <a href="http://www.google.com/analytics/" target="_blank">Google Analytics</a> Property ID (UA-######-#). Google Analytics JavaScript with your Property ID inserted will be added before the close of &lt;head&gt;.', 'risen' ),
				"id"	=> "ga_property_id",
				"type"	=> "text",
				"class"	=> "mini"
			);

			// Breadcrumbs

			$options[] = array(
				"name" 	=> __( 'Breadcrumb Path', 'risen' ),
				"desc" 	=> __( 'Show a navigational breadcrumb path at the top of subpages.', 'risen' ),
				"id" 	=> "breadcrumbs",
				"std" 	=> risen_option_default( 'breadcrumbs' ),
				"type" 	=> "checkbox"
			);

			// Favicon

			$options[] = array(
				"name" 	=> __( 'Favicon', 'risen' ),
				"desc" 	=> __( 'Upload the <a href="http://en.wikipedia.org/wiki/Favicon" target="_blank">favicon</a> ICO file you want to use.', 'risen' ),
				"id" 	=> "favicon",
				"type" 	=> "upload"
			);

		return $options;

	}

}

/**
 * Default Options
 * Used by risen_option() before Options Framework is activated
 * Also used by risen_option() before user saves their own Theme Options
 * Also used by ../options.php (main theme directory) to pre-populate Theme Options forms
 */

if ( ! function_exists( 'risen_option_default' ) ) {

	function risen_option_default( $option ) {

		$defaults = array();

		// Get cached defaults
		// risen_option() uses this and is run dozens of times per pageload
		// (risen_background_image_presets and risen_get_page_id_by_template are too intensive to run like that)
		$transient = 'risen_default_options';
		$defaults = get_transient( $transient );

		// No cache, set defaults then cache
		if ( false === $defaults ) {

			// Styles
			$defaults['base_style'] 						= 'light';
			$defaults['main_color'] 						= '#6a8fab';
			$defaults['link_color'] 						= '#6a8fab';
			$defaults['background_color'] 					= '#f0f0f0';
			$defaults['background_type'] 					= 'preset';
			$defaults['background_image_preset']			= key( risen_background_image_presets() ); // first item array
			$defaults['background_image_upload_repeat']		= 'repeat';
			$defaults['background_image_upload_attachment']	= 'scroll';
			$defaults['body_font']							= 'Open Sans';
			$defaults['menu_font']							= 'Open Sans';
			$defaults['heading_font']						= 'Shadows Into Light Two';

		// Header
$defaults['header_icon_urls'] = <<< TEXT
[feed_url]
http://twitter.com
http://facebook.com
https://plus.google.com
TEXT;

		// Footer
$defaults['footer_icon_urls'] = <<< TEXT
[feed_url]
http://www.apple.com/itunes
http://twitter.com
http://facebook.com
https://plus.google.com
http://pinterest.com
http://youtube.com
http://vimeo.com
http://flickr.com
http://instagram.com
http://foursquare.com
TEXT;

			$defaults['footer_address']						= '442 Church St, San Diego, CA 92117';
			$defaults['footer_phone']						= '(817) 555-3462';
			$defaults['footer_copyright']					= 'Copyright [copyright_symbol] [current_year] [site_name]. Powered by <a href="https://churchthemes.com" rel="nofollow">churchthemes.com</a>.';
			$defaults['slider_enabled']						= '1';
			$defaults['slider_slideshow']					= '1';
			$defaults['slider_speed']						= '6'; // seconds
			$defaults['home_intro']							= '<b>Welcome to Risen.</b> Our mission is to guide people of all backgrounds into a personal relationship with Jesus Christ.';
			$defaults['multimedia_word_plural']				= 'Sermons';
			$defaults['multimedia_word_singular']			= 'Sermon';
			$defaults['multimedia_header_image_archives']	= '1';
			$defaults['multimedia_header_image_single']		= '1';
			$defaults['multimedia_category_title']			= '[category]';
			$defaults['multimedia_tag_title']				= "Sermons tagged with '[tag]'";
			$defaults['multimedia_speaker_title']			= 'Sermons by [speaker]';
			$defaults['multimedia_archive_title']			= 'Sermons from [date]';
			$defaults['multimedia_per_page']				= '10';

			$defaults['gallery_categories_order']			= 'alphabetical';
			$defaults['gallery_per_page']					= '12';
			$defaults['gallery_page_id']					= risen_get_page_id_by_template( 'tpl-gallery-categories.php' );
			$defaults['gallery_page_inherit_archives']		= '1';
			$defaults['gallery_page_inherit_single']		= ''; // none to leave more room for images/videos
			$defaults['gallery_category_title']				= '[category]';

			$defaults['events_per_page']					= '10';
			$defaults['events_header_image_single']			= '1';

			$defaults['blog_header_image_archives']			= '1';
			$defaults['blog_header_image_single']			= '1';
			$defaults['blog_category_title']				= '[category]';
			$defaults['blog_tag_title']						= "Posts tagged with '[tag]'";
			$defaults['blog_archive_title']					= 'Posts from [date]';
			$defaults['blog_author_title']					= 'Posts by [author]';

			$defaults['custom_home_title']					= '[site_name] - [tagline]';
			$defaults['custom_subpage_title']				= '[page_title] - [site_name]';
			$defaults['breadcrumbs']						= '1';

$defaults['contacts'] = <<< TEXT
Church Office, office@somechurch.com
Bob Smith (Senior Pastor), pastor@somechurch.com
Gary Jones (Executive Pastor), gary@somechurch.com
Julie Johnson (Pastor's Assistant), julie@somechurch.com
North Campus, north@somechurch.com
South Campus, south@somechurch.com
TEXT;

			// Allow filtering
			$defaults = apply_filters( 'risen_option_defaults', $defaults );

			// Cache defaults
			// 10 seconds good enough for one page load
			set_transient( $transient, $defaults, 10 );

		}

		// Give default
		if ( isset( $defaults[$option] ) ) {
			return $defaults[$option];
		}

	}

}
