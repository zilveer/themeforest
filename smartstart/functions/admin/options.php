<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = function_exists('wp_get_theme') ? wp_get_theme()->Name : get_current_theme();
	$themename = preg_replace( "/\W/", "", strtolower( $themename ) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );

}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 */

function optionsframework_options() {

	// Background Defaults
	$background_defaults = array(
		'color'      => '#fff',
		'image'      => '',
		'repeat'     => 'repeat',
		'position'   => 'top center',
		'attachment' => 'scroll'
	);

	// Yes-No	
	$yes_no = array(
		'1' => __('Yes', 'ss_framework'),
		'0' => __('No', 'ss_framework')
	);
	
	// Slider effects
	$slider_effects = array(
		'blindX'          => 'blindX',
		'blindY'          => 'blindY',
		'blindZ'          => 'blindZ',
		'cover'           => 'cover',
		'curtainX'        => 'curtainX',
		'curtainY'        => 'curtainY',
		'fade'            => 'fade',
		'fadeZoom'        => 'fadeZoom',
		'growX'           => 'growX',
		'growY'           => 'growY',
		'none'            => 'none',
		'scrollUp'        => 'scrollUp',
		'scrollDown'      => 'scrollDown',
		'scrollLeft'      => 'scrollLeft',
		'scrollRight'     => 'scrollRight',
		'fixedScrollHorz' => 'scrollHorz',
		'scrollVert'      => 'scrollVert',
		'shuffle'         => 'shuffle',
		'slideX'          => 'slideX',
		'slideY'          => 'slideY',
		'toss'            => 'toss',
		'turnUp'          => 'turnUp',
		'turnDown'        => 'turnDown',
		'turnLeft'        => 'turnLeft',
		'turnRight'       => 'turnRight',
		'uncover'         => 'uncover',
		'wipe'            => 'wipe',
		'zoom'            => 'zoom'
	);
	
	// Slider speeds
	$slider_speeds = array(
		'900' => __('Slow', 'ss_framework'),
		'600' => __('Normal', 'ss_framework'),
		'300' => __('Fast', 'ss_framework')
	);
	
	// Slider timeouts (autoplay)
	$slider_timeouts = array(
		'0' => __('Disable', 'ss_framework'),
		'3000'  => sprintf( __('%d Seconds', 'ss_framework'), '3'),
		'5000'  => sprintf( __('%d Seconds', 'ss_framework'), '5'),
		'10000' => sprintf( __('%d Seconds', 'ss_framework'), '10')
	);

	// Social Links
	$social_links = array(
		'behance'     => 'Behance',
		'delicious'   => 'Delicious',
		'deviantart'  => 'deviantART',
		'digg'        => 'Digg',
		'dribbble'    => 'Dribbble',
		'dropbox'     => 'Dropbox',
		'facebook'    => 'Facebook',
		'flickr'      => 'Flickr',
		'forrst'      => 'Forrst',
		'github'      => 'GitHub',
		'google'      => 'Google',
		'ichat'       => 'iChat',
		'lastfm'      => 'Last.fm',
		'linkedin'    => 'LinkedIn',
		'mobypicture' => 'Mobypicture',
		'myspace'     => 'MySpace',
		'picasa'      => 'Picasa',
		'pinterest'   => 'Pinterest',
		'plixi'       => 'Plixi',
		'rss'         => 'RSS',
		'skype'       => 'Skype',
		'stumbleupon' => 'StumbleUpon',
		'tumblr'      => 'Tumblr',
		'twitter'     => 'Twitter',
		'vimeo'       => 'Vimeo',
		'youtube'     => 'YouTube'
	);
	
	// Google Fonts
	$google_fonts = array_merge(
		array( '' => __('None / Default', 'ss_framework') ),
		ss_framework_get_google_fonts()
	);
		
	// Img assests path
	$imagepath = SS_BASE_URL . 'functions/assets/img/';
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ( $options_categories_obj as $category ) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = __('Select a page:', 'ss_framework');
	foreach ( $options_pages_obj as $page ) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	$options = array();

	// Prefix
	$prefix = 'ss_';
	
	/* ---------------------------------------------------------------------- */
	/*	General Settings
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('General Settings', 'ss_framework'),
						'type' => 'heading');
						
	$options[] = array( 'name' => __('Logo', 'ss_framework'),
						'desc' => sprintf( __('Keep in mind that if the new logo is a much bigger, you may have to edit some header styling properties. %1$s The default logo height is %2$s.', 'ss_framework'), '<p>', '86px' ),
						'id'   => $prefix . 'logo',
						'type' => 'upload');

	$options[] = array( 'name' => __('Favicon', 'ss_framework'),
						'desc' => sprintf( __('Favicon (or bookmark icon) will be shown in address bar. The image dimension should be %1$s and the file format %2$s.', 'ss_framework'), '16px*16px', 'png' ),
						'id'   => $prefix . 'favicon',
						'type' => 'upload');
						
	$options[] = array( 'name' => __('Site Structure', 'ss_framework'),
						'desc' => __('This settings will determine page structure in all regular pages and posts. However the option can be overwritten by a single pages and posts.', 'ss_framework'),
						'id'      => $prefix . 'site_structure',
						'std'     => '2cr',
						'type'    => 'images',
						'options' => array(
							'1col' => $imagepath . '1col.png',
							'2cl'  => $imagepath . '2cl.png',
							'2cr'  => $imagepath . '2cr.png'
							)
						);

	$options[] = array( 'name' => __('Footer Bottom', 'ss_framework'),
						'desc' => sprintf( __('This will placed below the actual footer, if any content exist. %1$s HTML tags are allowed.', 'ss_framework'), '<p>'),
						'id'   => $prefix . 'footer_bottom',
						'std'  => "<ul>\n<li>SmartStart © 2012</li>\n<li><a href=\"#\">Legal Notice</a></li>\n<li><a href=\"#\">Terms</a></li>\n</ul>",
						'type' => 'textarea');

	$options[] = array( 'name' => __('Custom JS', 'ss_framework'),
						'desc' => sprintf( __('Here you can add any custom scripts to your site. Great place for example for Google Analytics tracking code. %1$s You don\'t need to add %2$s tags.'), '<p>', '<code>&lt;script&gt;</code>'),
						'id'   => $prefix . 'custom_js',
						'type' => 'code');

	/* ---------------------------------------------------------------------- */
	/*	Styling Settings
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('Styling', 'ss_framework'),
						'type' => 'heading');
							
	$options[] = array( 'name' => __('Color Scheme', 'ss_framework'),
						'desc' => __('This color will be used as a site primary color.', 'ss_framework'),
						'id'   => $prefix . 'color_scheme',
						'std'  => '#f15a23',
						'type' => 'color');
						
	$options[] = array( 'name' => __('Background', 'ss_framework'),
						'desc' => __('Set site background.', 'ss_framework'),
						'id'   => $prefix . 'background',
						'std'  => $background_defaults, 
						'type' => 'background');

	$options[] = array( 'name' => __('Typography', 'ss_framework'),
						'desc' => __('Set site typography.', 'ss_framework'),
						'id'   => $prefix . 'typography',
						'std'  => array(
							"size"  => "11px",
							"face"  => '"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif',
							"style" => "normal",
							"color" => "#909090"
						),
						'type' => 'typography');

	$options[] = array( 'name'    => __('Main Heading Font', 'ss_framework'),
						'desc'    => __('This font will be used in every heading and also in forms.', 'ss_framework') . '<p> <input type="button" value="Preview Font" onclick="googleFontPreview(\'' . $prefix . 'main_heading_font\');" class="button" />',
						'id'      => $prefix . 'main_heading_font',
						'std'     => 'Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese',
						'type'    => 'select',
						'options' => $google_fonts);

	$options[] = array( 'name'    => __('Blockquote Heading Font', 'ss_framework'),
						'desc'    => __('This font will be used in blockquotes.', 'ss_framework') . ' <p> <input type="button" value="Preview Font" onclick="googleFontPreview(\'' . $prefix . 'blockquote_heading_font\');" class="button" />',
						'id'      => $prefix . 'blockquote_heading_font',
						'std'     => 'PT+Serif:regular,italic,bold,bolditalic&subset=cyrillic,latin',
						'type'    => 'select',
						'options' => $google_fonts);

	$options[] = array( 'name' => __('Custom CSS', 'ss_framework'),
						'desc' => __('Here you can add any custom styles to your site.', 'ss_framework'),
						'id'   => $prefix . 'custom_css',
						'type' => 'code');

	/* ---------------------------------------------------------------------- */
	/*	Portfolio Settings
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('Portfolio', 'ss_framework'),
						'type' => 'heading');

	$options[] = array( 'name'    => __('Portfolio page', 'ss_framework'),
						'desc'    => sprintf( __('Select the portfolio page to fix any navigation issues (correct highlighting etc.). %1$s Remember also to insert %2$s shortcode to that same page!', 'ss_framework'), '<p>', '<code>[portfolio]</code>' ),
						'id'      => $prefix . 'portfolio_parent',
						'type'    => 'select',
						'options' => $options_pages);

	$options[] = array( 'name'    => __('Portfolio category filter', 'ss_framework'),
						'desc'    =>  __('This setting will determine if category filter is always open or only on mouse over.', 'ss_framework'),
						'id'      => $prefix . 'portfolio_category_filter',
						'type'    => 'select',
						'std'     => '0',
						'options' => $yes_no);

	$options[] = array( 'name'    => __('Enable lightbox in Portfolio page', 'ss_framework'),
						'desc'    =>  __('This setting will determine can thumbnails be zoomed in Portfolio page.', 'ss_framework'),
						'id'      => $prefix . 'portfolio_lightbox',
						'type'    => 'select',
						'std'     => '1',
						'options' => $yes_no);

	$options[] = array( 'name'    => __('Enable lightbox in single project page', 'ss_framework'),
						'desc'    =>  __('This setting will determine can thumbnails be zoomed in single project page.', 'ss_framework'),
						'id'      => $prefix . 'single_project_lightbox',
						'type'    => 'select',
						'std'     => '1',
						'options' => $yes_no);

	$options[] = array( 'name'    => __('Project Slider - Animation effect', 'ss_framework'),
						'desc'    => __('Transition type for the animation.', 'ss_framework'),
						'id'      => $prefix . 'project_slider_effect',
						'type'    => 'select',
						'std'     => 'fixedScrollHorz',
						'options' => $slider_effects);

	$options[] = array( 'name'    => __('Project Slider - Animation speed', 'ss_framework'),
						'desc'    => __('Speed of the animation transition.', 'ss_framework'),
						'id'      => $prefix . 'project_slider_speed',
						'type'    => 'select',
						'std'     => '600',
						'options' => $slider_speeds);
						
	$options[] = array( 'name' => __('Project Slider - Use custom animation speed', 'ss_framework'),
						'desc' => __('This will overwritten the animation speed setting above.', 'ss_framework'),
						'id'   => $prefix . 'use_custom_project_slider_speed',
						'type' => 'checkbox');

	$options[] = array( 'name'  => __('Project Slider - Custom animation speed', 'ss_framework'),
						'desc'  => __('Value is in milliseconds (1 second = 1000ms).', 'ss_framework'),
						'id'    => $prefix . 'custom_project_slider_speed',
						'class' => 'hidden',
						'type'  => 'text');

	$options[] = array( 'name'    => __('Project Slider - Slider autoplay', 'ss_framework'),
						'desc'    => __('Time between slide transitions.', 'ss_framework'),
						'id'      => $prefix . 'project_slider_timeout',
						'type'    => 'select',
						'std'     => '0',
						'options' => $slider_timeouts);

	$options[] = array( 'name' => __('Project Slider - Use custom autoplay', 'ss_framework'),
						'desc' => __('This will overwritten the autoplay setting above.', 'ss_framework'),
						'id'   => $prefix . 'use_custom_project_slider_timeout',
						'type' => 'checkbox');

	$options[] = array( 'name'  => __('Project Slider - Custom autoplay', 'ss_framework'),
						'desc'  => __('Value is in milliseconds (1 second = 1000ms).', 'ss_framework'),
						'id'    => $prefix . 'custom_project_slider_timeout',
						'class' => 'hidden',
						'type'  => 'text');

	/* ---------------------------------------------------------------------- */
	/*	Blog Settings
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('Blog', 'ss_framework'),
						'type' => 'heading');

	$options[] = array( 'name'    => __('Post Meta - Show post date', 'ss_framework'),
						'desc'    =>  __('Display post date in the blog post meta section.', 'ss_framework'),
						'id'      => $prefix . 'post_date',
						'type'    => 'checkbox',
						'std'     => '1');

	$options[] = array( 'name'    => __('Post Meta - Show post categories', 'ss_framework'),
						'desc'    =>  __('Display post categories in the blog post meta section.', 'ss_framework'),
						'id'      => $prefix . 'post_categories',
						'type'    => 'checkbox',
						'std'     => '0');

	$options[] = array( 'name'    => __('Post Meta - Show post tags', 'ss_framework'),
						'desc'    =>  __('Display post tags in the blog post meta section.', 'ss_framework'),
						'id'      => $prefix . 'post_tags',
						'type'    => 'checkbox',
						'std'     => '1');

	$options[] = array( 'name'    => __('Post Meta - Show post comments', 'ss_framework'),
						'desc'    =>  __('Display post comments in the blog post meta section.', 'ss_framework'),
						'id'      => $prefix . 'post_comments',
						'type'    => 'checkbox',
						'std'     => '1');

	$options[] = array( 'name'    => __('Post Meta - Show post author', 'ss_framework'),
						'desc'    =>  __('Display post author in the blog post meta section.', 'ss_framework'),
						'id'      => $prefix . 'post_author',
						'type'    => 'checkbox',
						'std'     => '0');

	$options[] = array( 'name'    => __('Gallery Slider - Animation effect', 'ss_framework'),
						'desc'    => __('Transition type for the animation.', 'ss_framework'),
						'id'      => $prefix . 'gallery_slider_effect',
						'type'    => 'select',
						'std'     => 'fixedScrollHorz',
						'options' => $slider_effects);

	$options[] = array( 'name'    => __('Gallery Slider - Animation speed', 'ss_framework'),
						'desc'    => __('Speed of the animation transition.', 'ss_framework'),
						'id'      => $prefix . 'gallery_slider_speed',
						'type'    => 'select',
						'std'     => '600',
						'options' => $slider_speeds);
						
	$options[] = array( 'name' => __('Gallery Slider - Use custom animation speed', 'ss_framework'),
						'desc' => __('This will overwritten the animation speed setting above.', 'ss_framework'),
						'id'   => $prefix . 'use_custom_gallery_slider_speed',
						'type' => 'checkbox');

	$options[] = array( 'name'  => __('Gallery Slider - Custom animation speed', 'ss_framework'),
						'desc'  => __('Value is in milliseconds (1 second = 1000ms).', 'ss_framework'),
						'id'    => $prefix . 'custom_gallery_slider_speed',
						'class' => 'hidden',
						'type'  => 'text');

	$options[] = array( 'name'    => __('Gallery Slider - Slider autoplay', 'ss_framework'),
						'desc'    => __('Time between slide transitions.', 'ss_framework'),
						'id'      => $prefix . 'gallery_slider_timeout',
						'type'    => 'select',
						'std'     => '0',
						'options' => $slider_timeouts);

	$options[] = array( 'name' => __('Gallery Slider - Use custom autoplay', 'ss_framework'),
						'desc' => __('This will overwritten the autoplay setting above.', 'ss_framework'),
						'id'   => $prefix . 'use_custom_gallery_slider_timeout',
						'type' => 'checkbox');

	$options[] = array( 'name'  => __('Gallery Slider - Custom autoplay', 'ss_framework'),
						'desc'  => __('Value is in milliseconds (1 second = 1000ms).', 'ss_framework'),
						'id'    => $prefix . 'custom_gallery_slider_timeout',
						'class' => 'hidden',
						'type'  => 'text');

	/* ---------------------------------------------------------------------- */
	/*	Social Media
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('Social Media', 'ss_framework'),
						'type' => 'heading');
								
	$options[] = array( 'name' => __('Contact Info - Address', 'ss_framework'),
						'desc' => __('The address for Smart Contact Info widget.', 'ss_framework'),
						'id'   => $prefix . 'contact_info_address',
						'std'  => '',
						'type' => 'text');
								
	$options[] = array( 'name' => __('Contact Info - Phone', 'ss_framework'),
						'desc' => __('The phone for Smart Contact Info widget.', 'ss_framework'),
						'id'   => $prefix . 'contact_info_phone',
						'std'  => '',
						'type' => 'text');
								
	$options[] = array( 'name' => __('Contact Info - Email', 'ss_framework'),
						'desc' => __('The email for Smart Contact Info widget.', 'ss_framework'),
						'id'   => $prefix . 'contact_info_email',
						'std'  => '',
						'type' => 'text');

	$options[] = array( 'name' => __('Social Links', 'ss_framework'),
						'desc' => __('Select the social icons for Smart Social Links widget.', 'ss_framework'),
						'id'   => $prefix . 'social_links_widget',
						'type' => 'multicheck',
						'options' => $social_links);

	$options[] = array( 'name' => __('Behance Profile URL', 'ss_framework'),
						'desc' => __('Your Behance profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_behance',
						'type' => 'text');

	$options[] = array( 'name' => __('Delicious Profile URL', 'ss_framework'),
						'desc' => __('Your Delicious profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_delicious',
						'type' => 'text');

	$options[] = array( 'name' => __('deviantART Profile URL', 'ss_framework'),
						'desc' => __('Your deviantART profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_deviantart',
						'type' => 'text');

	$options[] = array( 'name' => __('Digg Profile URL', 'ss_framework'),
						'desc' => __('Your Digg profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_digg',
						'type' => 'text');

	$options[] = array( 'name' => __('Dribbble Profile URL', 'ss_framework'),
						'desc' => __('Your Dribbble profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_dribbble',
						'type' => 'text');

	$options[] = array( 'name' => __('Dropbox Profile URL', 'ss_framework'),
						'desc' => __('Your Dropbox profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_dropbox',
						'type' => 'text');

	$options[] = array( 'name' => __('Facebook Profile URL', 'ss_framework'),
						'desc' => __('Your Facebook profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_facebook',
						'type' => 'text');

	$options[] = array( 'name' => __('Flickr Profile URL', 'ss_framework'),
						'desc' => __('Your Flickr profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_flickr',
						'type' => 'text');

	$options[] = array( 'name' => __('Forrst Profile URL', 'ss_framework'),
						'desc' => __('Your Forrst profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_forrst',
						'type' => 'text');

	$options[] = array( 'name' => __('GitHub Profile URL', 'ss_framework'),
						'desc' => __('Your GitHub profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_github',
						'type' => 'text');

	$options[] = array( 'name' => __('Google Profile URL', 'ss_framework'),
						'desc' => __('Your Google profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_google',
						'type' => 'text');

	$options[] = array( 'name' => __('iChat Profile URL', 'ss_framework'),
						'desc' => __('Your iChat profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_ichat',
						'type' => 'text');

	$options[] = array( 'name' => __('Last.fm Profile URL', 'ss_framework'),
						'desc' => __('Your Last.fm profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_lastfm',
						'type' => 'text');

	$options[] = array( 'name' => __('LinkedIn Profile URL', 'ss_framework'),
						'desc' => __('Your LinkedIn profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_linkedin',
						'type' => 'text');

	$options[] = array( 'name' => __('Mobypicture Profile URL', 'ss_framework'),
						'desc' => __('Your Mobypicture profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_mobypicture',
						'type' => 'text');

	$options[] = array( 'name' => __('MySpace Profile URL', 'ss_framework'),
						'desc' => __('Your MySpace profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_myspace',
						'type' => 'text');

	$options[] = array( 'name' => __('Picasa Profile URL', 'ss_framework'),
						'desc' => __('Your Picasa profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_picasa',
						'type' => 'text');

	$options[] = array( 'name' => __('Pinterest Profile URL', 'ss_framework'),
						'desc' => __('Your Pinterest profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_pinterest',
						'type' => 'text');

	$options[] = array( 'name' => __('RSS Feed URL', 'ss_framework'),
						'desc' => __('The site RSS feed URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_rss',
						'type' => 'text');

	$options[] = array( 'name' => __('Plixi Profile URL', 'ss_framework'),
						'desc' => __('Your Plixi profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_plixi',
						'type' => 'text');

	$options[] = array( 'name' => __('Skype Profile URL', 'ss_framework'),
						'desc' => __('Your Skype profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_skype',
						'type' => 'text');

	$options[] = array( 'name' => __('StumbleUpon Profile URL', 'ss_framework'),
						'desc' => __('Your StumbleUpon profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_stumbleupon',
						'type' => 'text');

	$options[] = array( 'name' => __('Tumblr Profile URL', 'ss_framework'),
						'desc' => __('Your Tumblr profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_tumblr',
						'type' => 'text');

	$options[] = array( 'name' => __('Twitter Username', 'ss_framework'),
						'desc' => __('Your Twitter username.', 'ss_framework'),
						'id'   => $prefix . 'social_links_twitter',
						'type' => 'text');

	$options[] = array( 'name' => __('Vimeo Profile URL', 'ss_framework'),
						'desc' => __('Your Vimeo profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_vimeo',
						'type' => 'text');

	$options[] = array( 'name' => __('YouTube Profile URL', 'ss_framework'),
						'desc' => __('Your YouTube profile URL.', 'ss_framework'),
						'id'   => $prefix . 'social_links_youtube',
						'type' => 'text');

	return $options;

}