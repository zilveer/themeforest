<?php 

/**
 * Build theme options
 * Uses the Ebor_Options class found in the ebor-framework plugin
 * Panels are WP 4.0+!!!
 * 
 * @since 1.0.0
 * @author tommusrhodus
 */
if( class_exists('Ebor_Options') ){
	$ebor_options = new Ebor_Options;
	
	/**
	 * Variables
	 */
	$theme = wp_get_theme();
	$theme_name = $theme->get( 'Name' );
	$footer_default = 'Modify this text from "appearance => customise"';
	$footer_layouts = ebor_get_footer_options();
	$header_layouts = ebor_get_header_options();
	$team_layouts = array_flip(ebor_get_team_layouts());
	$blog_layouts = array_flip(ebor_get_blog_layouts());
	$portfolio_layouts = array_flip(ebor_get_portfolio_layouts());
	$page_titles = array_flip(ebor_get_page_title_options());
	$post_types = get_post_types();
	
	$shop_archive_layouts = array(
		'sidebar-left' => 'Left Sidebar',
		'sidebar-right' => 'Right Sidebar',
		'4col' => 'No Sidebar (4 Columns)',
		'3col' => 'No Sidebar (3 Columns)',
		'2col' => 'No Sidebar (2 Columns)',
	);
	
	$shop_product_layouts = array(
		'sidebar-left' => 'Left Sidebar',
		'sidebar-right' => 'Right Sidebar',
		'sidebar-none' => 'No Sidebar'
	);
	
	$site_layouts = array(
		'normal-layout' => 'Full Width',
		'boxed-layout' => 'Boxed'	
	);
	
	$social_options = ebor_get_icons();
	foreach( $social_options as $social ){
		$new_social_options[$social] = ucfirst(str_replace('ti-', '', $social));	
	}
	
	$fonts_description = 'Fonts: ' . $theme_name . ' uses Google Fonts, <a href="https://www.google.com/fonts" target="_blank">all of which are viewable here</a>. Unlike some themes, ' . $theme_name . ' does not load all of these fonts into these options, in avoiding this ' . $theme_name . ' can work faster and more reliably.<br /><br />
	
	To customize the fonts on your website use the URL above and the inputs below accordingly. Full details of this process (and the default values) can be found in the theme documentation!';
	
	/**
	 * Default stuff
	 * 
	 * Each of these is a default option that appears in each theme, demo data, favicons and a custom css input
	 * 
	 * @since 1.0.0
	 * @author tommusrhodus
	 */
	$ebor_options->add_panel( $theme_name . ': Demo Data', 5, '');
	$ebor_options->add_panel( $theme_name . ': Styling Settings', 205, 'All of the controls in this section directly relate to the styling page of ' . $theme_name);
	$ebor_options->add_section('demo_data_section', 'Import Demo Data', 10, $theme_name . ': Demo Data', '<strong>Please read this before importing demo data via this control:</strong><br /><br />The demo data this will install includes images from my demo site with <strong>heavy blurring applied</strong> this is due to licensing restrictions. Simply replace these images with your own.<br /><br />Note that this process can take up to 15mins on slower servers, go make a cup of tea. If you havn\'t had a notification in 30mins, use the fallback method outlined in the written documentation.<br /><br />');
	$ebor_options->add_section('custom_css_section', 'Custom CSS', 40, $theme_name . ': Styling Settings');
	$ebor_options->add_setting('demo_import', 'demo_import', 'Import Demo Data', 'demo_data_section', '', 10);
	$ebor_options->add_setting('textarea', 'custom_css', 'Custom CSS', 'custom_css_section', '', 30);
	
	/**
	 * Panels
	 * 
	 * add_panel($name, $priority, $description)
	 * 
	 * @since 1.0.0
	 * @author tommusrhodus
	 */
	$ebor_options->add_panel( $theme_name . ': Site Settings', 210, 'All of the controls in this section directly relate to the site settings of ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Header Settings', 215, 'All of the controls in this section directly relate to the header and logos of ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Blog Settings', 225, 'All of the controls in this section directly relate to the control of blog items within ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Portfolio Settings', 230, 'All of the controls in this section directly relate to the control of portfolio items within ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Team Settings', 235, 'All of the controls in this section directly relate to the control of team items within ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Shop Settings', 240, 'All of the controls in this section directly relate to the control of shop items within ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Footer Settings', 290, 'All of the controls in this section directly relate to the control of the footer within ' . $theme_name);
	$ebor_options->add_panel( $theme_name . ': Visual Composer Settings', 295, 'All of the controls in this section directly relate to the control of visual composer within ' . $theme_name);
	
	/**
	 * Sections
	 * 
	 * add_section($name, $title, $priority, $panel, $description)
	 * 
	 * @since 1.0.0
	 * @author tommusrhodus
	 */
	//Styling
	$ebor_options->add_section('fonts_section', 'Fonts', 5, $theme_name . ': Styling Settings', $fonts_description);
	$ebor_options->add_section('buttons_section', 'Buttons', 5, $theme_name . ': Styling Settings');
	
	$ebor_options->add_section('site_layout_section', 'Site Layout', 10, $theme_name . ': Site Settings');
	$ebor_options->add_section('site_sliders_section', 'Site Sliders Settings', 15, $theme_name . ': Site Settings');
	
	//Blog Sections
	$ebor_options->add_section('blog_settings', 'Blog Settings', 1, $theme_name . ': Blog Settings');
	
	//Blog Title
	$ebor_options->add_section('blog_title_section', 'Blog Title Bar', 15, $theme_name . ': Blog Settings');
	$ebor_options->add_setting('select', 'foundry_blog_header_layout', 'Blog Title Layout', 'blog_title_section', 'left-short-grey', 5, $page_titles);
	$ebor_options->add_setting('input', 'blog_title', 'Blog Title', 'blog_title_section', 'Our Journal', 10);
	$ebor_options->add_setting('select', 'foundry_blog_header_show_posttitle', 'Show Post Title (instead of Blog Title) on single Posts.', 'blog_title_section', 'no', 12, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('input', 'blog_subtitle', 'Blog Subtitle', 'blog_title_section', 'The blog subtitle', 15);
	$ebor_options->add_setting('image', 'foundry_blog_header_image', 'Blog Header Background', 'blog_title_section', '', 20);
	
	//portfolio Title
	$ebor_options->add_section('portfolio_title_section', 'Portfolio Title Bar', 15, $theme_name . ': Portfolio Settings');
	$ebor_options->add_setting('select', 'foundry_portfolio_header_layout', 'Portfolio Title Layout', 'portfolio_title_section', 'left-short-grey', 5, $page_titles);
	$ebor_options->add_setting('input', 'portfolio_title', 'Portfolio Title', 'portfolio_title_section', 'Our Portfolio', 10);
	$ebor_options->add_setting('input', 'portfolio_subtitle', 'Portfolio Subtitle', 'portfolio_title_section', 'The portfolio subtitle', 15);
	$ebor_options->add_setting('image', 'foundry_portfolio_header_image', 'Portfolio Header Background', 'portfolio_title_section', '', 20);
	
	//team Title
	$ebor_options->add_section('team_title_section', 'Team Title Bar', 15, $theme_name . ': Team Settings');
	$ebor_options->add_setting('select', 'foundry_team_header_layout', 'Team Title Layout', 'team_title_section', 'left-short-grey', 5, $page_titles);
	$ebor_options->add_setting('input', 'team_title', 'Team Title', 'team_title_section', 'Our Team', 10);
	$ebor_options->add_setting('input', 'team_subtitle', 'Team Subtitle', 'team_title_section', 'The team subtitle', 15);
	$ebor_options->add_setting('image', 'foundry_team_header_image', 'Team Header Background', 'team_title_section', '', 20);
	
	//shop Title
	$ebor_options->add_section('shop_title_section', 'Shop Title Bar', 15, $theme_name . ': Shop Settings');
	$ebor_options->add_setting('select', 'foundry_shop_header_layout', 'Shop Title Layout', 'shop_title_section', 'left-short-grey', 5, $page_titles);
	$ebor_options->add_setting('input', 'shop_title', 'Shop Title', 'shop_title_section', 'Our Shop', 10);
	$ebor_options->add_setting('input', 'shop_subtitle', 'Shop Subtitle', 'shop_title_section', 'The shop subtitle', 15);
	$ebor_options->add_setting('image', 'foundry_shop_header_image', 'Shop Header Background', 'shop_title_section', '', 20);
	
	//Shop Sections
	$ebor_options->add_section('shop_layout_section', 'Shop Layouts', 10, $theme_name . ': Shop Settings');
	
	//Portfolio Sections
	$ebor_options->add_section('portfolio_text_section', 'Portfolio Settings', 15, $theme_name . ': Portfolio Settings');
	$ebor_options->add_section('team_text_section', 'Team Settings', 10, $theme_name . ': Team Settings');
	$ebor_options->add_section('blog_text_section', 'Blog Settings', 5, $theme_name . ': Blog Settings');
	
	//Header Settings
	$ebor_options->add_section('logo_settings_section', 'Logo Settings', 10, $theme_name . ': Header Settings');
	$ebor_options->add_section('footer_social_settings_section', 'Footer Icons Settings', 40, $theme_name . ': Footer Settings', '');
	$ebor_options->add_section('header_layout_section', 'Header Layout', 5, $theme_name . ': Header Settings', 'This setting controls the theme header site-wide. If you need to you can override this setting on specific posts and pages from within that posts edit screen.');
	$ebor_options->add_section('sub_header_layout_section', 'Sub Header Settings', 10, $theme_name . ': Header Settings', 'This setting controls the theme header site-wide. If you need to you can override this setting on specific posts and pages from within that posts edit screen.');
	
	//Footer Settings
	$ebor_options->add_section('footer_layout_section', 'Footer Layout', 5, $theme_name . ': Footer Settings', 'This setting controls the theme footer site-wide. If you need to you can override this setting on specific posts and pages from within that posts edit screen.');
	$ebor_options->add_section('subfooter_settings_section', 'Sub-Footer Settings', 30, $theme_name . ': Footer Settings');
	$ebor_options->add_section('footer_social_settings_section', 'Footer Icons Settings', 40, $theme_name . ': Footer Settings', 'These social icons are only shown in certain footer layouts.');
	$ebor_options->add_section('footer_modal_section', 'Footer Modal Settings', 45, $theme_name . ': Footer Settings', '');
	
	/**
	 * Instagram API Stuff
	 */
	$ebor_options->add_section('instagram_api_section', $theme_name . ': Instagram Settings', 340, false, '<code>IMPORTANT NOTE:</code> This is the Instagram setup section for the theme, it requires an Access Token and Client ID.<br /><br />Due to how Instagram have set their API you have to register as a developer with Instagram for this to work.<br /><br />For setup details, <a href="https://tommusrhodus.ticksy.com/article/7566" target="_blank">please read this</a>');
	$ebor_options->add_setting('input', 'instagram_token', 'Instagram Access Token', 'instagram_api_section', '', 5);
	$ebor_options->add_setting('input', 'instagram_client', 'Instagram Client ID', 'instagram_api_section', '', 10);
	
	//Visual Composer 
	$ebor_options->add_section('visual_composer_section', 'Visual Composer Settings', 10, $theme_name . ': Visual Composer Settings');
	
	/**
	 * Settings (The Actual Options)
	 * Repeated settings are stepped using a for() loop and counter
	 * 
	 * add_setting($type, $option, $title, $section, $default, $priority, $select_options)
	 * 
	 * @since 1.0.0
	 * @author tommusrhodus
	 */
	//Visual Composer
	$ebor_options->add_setting('select', 'foundry_vc_redirect_post', 'Redirect standard template for posts?', 'visual_composer_section', 'yes', 5, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_vc_redirect_portfolio', 'Redirect standard template for portfolio posts?', 'visual_composer_section', 'yes', 10, array('yes' => 'Yes', 'no' => 'No')); 
	$ebor_options->add_setting('select', 'foundry_vc_redirect_team', 'Redirect standard template for team posts?', 'visual_composer_section', 'yes', 15, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_vc_redirect_page', 'Redirect standard template for pages?', 'visual_composer_section', 'yes', 20, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_vc_redirect_product', 'Redirect standard template for products?', 'visual_composer_section', 'yes', 25, array('yes' => 'Yes', 'no' => 'No'));
	
	//Fonts
	$ebor_options->add_setting('select', 'foundry_site_layout', 'Site Layout', 'site_layout_section', 'normal-layout', 30, $site_layouts);
	$ebor_options->add_setting('select', 'show_breadcrumbs', 'Show breadcrumbs in page titles?', 'site_layout_section', 'yes', 35, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_use_parallax', 'Use Parallax Images? Yes means you get parallax background images, but also smooth scrolling. No means that parallax scrolling images will be disabled, but normal window scrolling will return.', 'site_layout_section', 'yes', 40, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_parallax_version', 'Foundry Parallax Version, alter if you have any visual anomalies in Chrome, all other browsers are unaffected.', 'site_layout_section', '3d', 40, array('3d' => 'Default (Better Performance)', '2d' => 'Safe Mode (Slower Performance)'));
	$ebor_options->add_setting('select', 'foundry_use_custom_forms', 'Use Foundry custom form elements?', 'site_layout_section', 'yes', 45, array('yes' => 'Yes', 'no' => 'No'));
	
	//Slider Settings
	$ebor_options->add_setting('select', 'hero_autoplay', 'Autoplay Hero Sliders?', 'site_sliders_section', 'false', 35, array('true' => 'Yes', 'false' => 'No'));
	$ebor_options->add_setting('input', 'hero_timer', 'If Autoplaying, Set Delay in Milliseconds', 'site_sliders_section', '3000', 40);
	$ebor_options->add_setting('select', 'hero_animation', 'Hero Slider Animation', 'site_sliders_section', 'fade', 45, array('fade' => 'Fade Between Slides', 'slide' => 'Slide Between Slides'));
	
	//Fonts
	$ebor_options->add_setting('input', 'body_font', 'Body Font', 'fonts_section', 'Open Sans', 10);
	$ebor_options->add_setting('textarea', 'body_font_url', 'Body Font URL Parameter', 'fonts_section', 'http://fonts.googleapis.com/css?family=Open+Sans:400,500,600', 15);
	$ebor_options->add_setting('input', 'heading_font', 'Heading Font', 'fonts_section', 'Raleway', 20);
	$ebor_options->add_setting('textarea', 'heading_font_url', 'Heading Font URL Parameter', 'fonts_section', 'http://fonts.googleapis.com/css?family=Raleway:100,400,300,500,600,700', 25);
	
	//Buttons
	$ebor_options->add_setting('select', 'button_style', 'Button Style - Note: enabling rounded buttons does not affect tabs, accorions etc (certain element will remain regular by design)', 'buttons_section', 'btn-regular', 45, array('btn-regular' => 'Regular Buttons', 'btn-rounded' => 'Rounded Buttons'));

	//Colour Options
	$ebor_options->add_setting('color', 'foundry_colour_white', 'Light Wrapper Colour', 'colors', '#FFFFFF', 1);
	$ebor_options->add_setting('color', 'foundry_colour_secondary', 'Dark Wrapper Colour', 'colors', '#f8f8f8', 5);
	$ebor_options->add_setting('color', 'foundry_colour_dark', 'Black Wrapper Colour', 'colors', '#292929', 7);
	$ebor_options->add_setting('color', 'foundry_colour_primary', 'Highlight Colour', 'colors', '#47b475', 10);
	$ebor_options->add_setting('color', 'foundry_colour_lightgrey', 'Body Font Colour', 'colors', '#666666', 15);
	$ebor_options->add_setting('color', 'foundry_colour_lightblack', 'Headings Font Colour', 'colors', '#222222', 20);
	$ebor_options->add_setting('color', 'foundry_colour_red', 'Red Colour', 'colors', '#e31d3b', 25);
	$ebor_options->add_setting('color', 'foundry_colour_darkgrey', 'Dark Grey Colour', 'colors', '#cccccc', 30);

	//Portfolio options
	$ebor_options->add_setting('select', 'portfolio_layout', 'Portfolio Archives Layout', 'portfolio_text_section', 'parallax', 30, $portfolio_layouts);
	$ebor_options->add_setting('input', 'portfolio_all', 'Portfolio Filters "All"', 'portfolio_text_section', 'All', 10);
	
	//Blog Options
	$ebor_options->add_setting('select', 'foundry_post_layout', 'Blog Posts Layout', 'blog_text_section', 'sidebar-right', 10, $shop_product_layouts);
	$ebor_options->add_setting('select', 'blog_layout', 'Blog Archives Layout', 'blog_text_section', 'masonry-sidebar-right', 15, $blog_layouts);
	$ebor_options->add_setting('select', 'blog_sharing', 'Show Post Sharing Buttons on Single Posts?.', 'blog_text_section', 'no', 20, array('yes' => 'Yes', 'no' => 'No'));
	
	//Team Options
	$ebor_options->add_setting('select', 'team_layout', 'Team Archives Layout', 'team_text_section', 'box', 30, $team_layouts);
	
	//Logo Options
	$ebor_options->add_setting('image', 'custom_logo', 'Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/img/logo-dark.png', 5);
	$ebor_options->add_setting('image', 'custom_logo_light', 'Light Logo', 'logo_settings_section', EBOR_THEME_DIRECTORY . 'style/img/logo-light.png', 10);
	$ebor_options->add_setting('range', 'logo_height', 'Logo Height (60 Default)(% height of bar)', 'logo_settings_section', '60', 15, array('min' => '0', 'max' => '100', 'step' => '1'));
	$ebor_options->add_setting('range', 'nav_height', 'Nav Height (55 Default)', 'logo_settings_section', '55', 15, array('min' => '55', 'max' => '110', 'step' => '1'));
	
	//Footer Options
	$ebor_options->add_setting('textarea', 'foundry_footer_copyright', 'Copyright Message', 'subfooter_settings_section', $footer_default, 20);
	$ebor_options->add_setting('image', 'alt_footer_logo', 'Footer Logo (Overrides header logo being used in certain footers)', 'subfooter_settings_section', '', 25);
	
	//Header Layout Option
	$ebor_options->add_setting('select', 'header_layout', 'Global Header Layout', 'header_layout_section', 'bar-extended', 5, $header_layouts);
	$ebor_options->add_setting('select', 'foundry_header_search', 'Show search bar in header?', 'header_layout_section', 'yes', 10, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_header_cart', 'Show shopping cart in header?', 'header_layout_section', 'yes', 15, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_header_wpml', 'Show language selectors in header?', 'header_layout_section', 'yes', 20, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_header_button', 'Show CTA button in header?', 'header_layout_section', 'no', 25, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_header_social', 'Show social icons in header?', 'header_layout_section', 'no', 30, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('select', 'foundry_header_utility_social', 'Show social icons in header utility area?', 'header_layout_section', 'no', 32, array('yes' => 'Yes', 'no' => 'No'));
	$ebor_options->add_setting('range', 'nav_right_margin', 'Nav Right Margin (32 Default)', 'header_layout_section', '32', 35, array('min' => '32', 'max' => '150', 'step' => '1'));
	$ebor_options->add_setting('range', 'dropdown_width', 'Dropdown Menu Width (200 Default)', 'header_layout_section', '200', 40, array('min' => '200', 'max' => '300', 'step' => '1'));
	$ebor_options->add_setting('select', 'perm_fixed_nav', 'Permanent fix Nav to top of screen? (disabled on mobile)(May appear under WordPress admin bar whilst logged in)', 'header_layout_section', 'no', 45, array('yes' => 'Yes', 'no' => 'No'));
	
	$ebor_options->add_setting('input', 'cta_url', 'Call to Action Button URL', 'sub_header_layout_section', '', 10);
	$ebor_options->add_setting('input', 'cta_text', 'Call to Action Button Text', 'sub_header_layout_section', 'Build Yours »', 15);
	$ebor_options->add_setting('select', 'header_address_icon', 'Header Address Icon', 'sub_header_layout_section', 'ti-location-arrow', 17, $new_social_options);
	$ebor_options->add_setting('input', 'foundry_header_address', 'Utility Header Address', 'sub_header_layout_section', '68 Cardamon Place, Melbourne Vic 3000', 20);
	$ebor_options->add_setting('select', 'header_email_icon', 'Header Email Icon', 'sub_header_layout_section', 'ti-email', 22, $new_social_options);
	$ebor_options->add_setting('input', 'foundry_header_email', 'Utility Header Email', 'sub_header_layout_section', 'hello@foundry.net', 25);
	$ebor_options->add_setting('input', 'nav_button_url', 'Call to Action Button URL (Nav Area)', 'sub_header_layout_section', '#', 26);
	$ebor_options->add_setting('input', 'nav_button_text', 'Call to Action Button Text (Nav Area)', 'sub_header_layout_section', 'Button Text', 27);
	
	//Shop Layouts
	$ebor_options->add_setting('select', 'foundry_shop_layout', 'Shop Page Layout', 'shop_layout_section', 'sidebar-right', 5, $shop_archive_layouts);
	$ebor_options->add_setting('select', 'foundry_product_layout', 'Product Posts Layout', 'shop_layout_section', 'sidebar-right', 10, $shop_product_layouts);
	
	//Footer Layouts
	$ebor_options->add_setting('select', 'footer_layout', 'Global Footer Layout', 'footer_layout_section', 'widgets', 5, $footer_layouts);
	
	$ebor_options->add_setting('textarea', 'foundry_footer_modal_content', 'Footer Modal Content (Leave blank for no modal)', 'footer_modal_section', '', 20);
	$ebor_options->add_setting('input', 'foundry_footer_modal_cookie', 'Footer Modal Cookie Name', 'footer_modal_section', '', 25);
	$ebor_options->add_setting('select', 'foundry_footer_modal_colour', 'Footer Modal Background', 'footer_modal_section', 'bg-white', 35, array('bg-white' => 'White Background', 'bg-dark' => 'Dark Background'));
	
	//Footer Icons
	for( $i = 1; $i < 5; $i++ ){
		$ebor_options->add_setting('select', 'footer_social_icon_' . $i, 'Footer Social Icon ' . $i, 'footer_social_settings_section', 'none', 20 + $i + $i, $new_social_options);
		$ebor_options->add_setting('input', 'footer_social_url_' . $i, 'Footer Social URL ' . $i, 'footer_social_settings_section', '', 21 + $i + $i);
	}
	
	//Header icons
	for( $i = 1; $i < 5; $i++ ){
		$ebor_options->add_setting('select', 'header_social_icon_' . $i, 'Header Social Icon ' . $i, 'sub_header_layout_section', 'none', 30 + $i + $i, $new_social_options);
		$ebor_options->add_setting('input', 'header_social_url_' . $i, 'Header Social URL ' . $i, 'sub_header_layout_section', '', 31 + $i + $i);
	}
}