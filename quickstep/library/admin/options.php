<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

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
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
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


	// JQuery Easing Effects
	$easing =	 array(
		'linear'           => 'linear',
		'swing'            => 'swing',
		'jswing'           => 'jswing',
		'easeInQuad'       => 'easeInQuad',
		'easeOutQuad'      => 'easeOutQuad',
		'easeInOutQuad'    => 'easeInOutQuad',
		'easeInCubic'      => 'easeInCubic',
		'easeOutCubic'     => 'easeOutCubic',
		'easeInOutCubic'   => 'easeInOutCubic',
		'easeInQuart'      => 'easeInQuart',
		'easeOutQuart'     => 'easeOutQuart',
		'easeInOutQuart'   => 'easeInOutQuart',
		'easeInQuint'      => 'easeInQuint',
		'easeOutQuint'     => 'easeOutQuint',
		'easeInOutQuint'   => 'easeInOutQuint',
		'easeInSine'       => 'easeInSine',
		'easeOutSine'      => 'easeOutSine',
		'easeInOutSine'    => 'easeInOutSine',
		'easeInExpo'       => 'easeInExpo',
		'easeOutExpo'      => 'easeOutExpo',
		'easeInOutExpo'    => 'easeInOutExpo',
		'easeInCirc'       => 'easeInCirc',
		'easeOutCirc'      => 'easeOutCirc',
		'easeInOutCirc'    => 'easeInOutCirc',
		'easeInElastic'    => 'easeInElastic',
		'easeOutElastic'   => 'easeOutElastic',
		'easeInOutElastic' => 'easeInOutElastic',
		'easeInBack'       => 'easeInBack',
		'easeOutBack'      => 'easeOutBack',
		'easeInOutBack'    => 'easeInOutBack',
		'easeInBounce'     => 'easeInBounce',
		'easeOutBounce'    => 'easeOutBounce',
		'easeInOutBounce'  => 'easeInOutBounce'
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
		'plixi'       => 'Plixi',
		'rss'         => 'RSS',
		'skype'       => 'Skype',
		'stumbleupon' => 'StumbleUpon',
		'tumblr'      => 'Tumblr',
		'twitter'     => 'Twitter',
		'vimeo'       => 'Vimeo',
		'youtube'     => 'YouTube'
		);
	
	// Header Opacity
	$opacity = array(
		'100' => '100%',
		'90'  => '90%',
		'80'  => '80%',
		'70'  => '70%',
		'60'  => '60%',
		'50'  => '50%',
		'40'  => '40%',
		'30'  => '30%',
		'20'  => '20%',
		'10'  => '10%',
		'0'   => '0%'
		);
		
	// Google Fonts
	$google_fonts = array_merge(
		array( '' => __('Theme Default', 'qs_framework') ),
		qs_google_fonts()
	);
	
	// Base Style Options
	$base_styles = array(
		'light' => 'Light',
		'dark'  => 'Dark'
		);
		
	// Header Positions
	$header_positions = array(
		'fixed'     => 'Fixed',
		'absolute'  => 'Static',
		'fadein'	=> 'Fade In',
		'hidden'	=> 'Hidden'
		);
				
	$options = array();

	// Prefix
	$prefix = 'qs_';
	
	/* ---------------------------------------------------------------------- */
	/*	General
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('General', 'qs_framework'),
						'type' => 'heading');
						
	$options[] = array( 'name' => __('Logo', 'qs_framework'),
						'desc' => sprintf( __('A logo with a height of 80px or less is best.  Otherwise you can add in custom CSS to change the header.', 'qs_framework')),
						'id'   => $prefix . 'logo',
						'std'  => QS_BASE_URL.'images/logo.png',
						'type' => 'upload');

	$options[] = array( 'name' => __('Fav Icon', 'qs_framework'),
						'desc' => sprintf( __('Dimensions should be 16px x 16px', 'qs_framework') ),
						'id'   => $prefix . 'favicon',
						'type' => 'upload');

	$options[] = array( 'name' => __('Custom Javascript', 'qs_framework'),
						'desc' => sprintf( __('Add any custom javascript you want in here (for example, your Google Analytics code). Don\'t add the opening and closing script tags.')),
						'id'   => $prefix . 'custom_js',
						'type' => 'textarea');
						
	$options[] = array( 'name' => __('Custom CSS', 'qs_framework'),
						'desc' => sprintf( __('Add any custom styling you want directly in here.  Don\'t add the opening and closing script tags.')),
						'id'   => $prefix . 'custom_css`',
						'type' => 'textarea');
						
	$options[] = array( 'name'    => __('Enable One Page', 'qs_framework'),
						'desc'    => __('If enabled, your site will display as a one page scrolling theme.', 'qs_framework'),
						'id'      => $prefix . 'one_page',
						'type'    => 'checkbox',
						'std'     => '1',);
        
	$options[] = array( 'name'    => __('Page Scroll Easing', 'qs_framework'),
						'desc'    => __('The transition effect of scrolling between pages.', 'qs_framework'),
						'id'      => $prefix . 'scrollto_easing',
						'type'    => 'select',
						'std'     => 'swing',
						'options' => $easing);

	$options[] = array( 'name'  => __('Page Scrolling Speed', 'qs_framework'),
						'desc'  => __('Enter the time to scroll from one one page to the next in milliseconds (i.e., 2300 is 2.3 seconds).', 'qs_framework'),
						'id'    => $prefix . 'scrollto_speed',
						'std'     => '1600',
						'type'  => 'text');


	/* ---------------------------------------------------------------------- */
	/*	Body
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('Body', 'qs_framework'),
						'type' => 'heading');
							
	$options[] = array( 'name'    => __('Base Style', 'qs_framework'),
						'desc'    => __('This is the base for your scheme.  It controls whether many of the smaller elements are light or dark.', 'qs_framework'),
						'id'      => $prefix . 'style_base',
						'std'     => 'light',
						'type'    => 'select',
						'options' => $base_styles);
						
	$options[] = array( 'name' => __('Main Font', 'qs_framework'),
						'desc' => __('Basic font style for the site.', 'qs_framework'),
						'id'   => $prefix . 'main_font',
						'std'  => array(
							"size"  => "12px",
							"face"  => '"helvetica',
							"style" => "normal",
							"color" => "#999999"
						),
						'type' => 'typography');

	$options[] = array( 'name'    => __('Heading Font', 'qs_framework'),
						'desc'    => __('Font style for all headings.', 'qs_framework') . '<p> <input type="button" value="Preview Font" onclick="googleFontPreview(\'' . $prefix . 'main_heading_font\');" />',
						'id'      => $prefix . 'heading_font',
						'std'     => 'Open+Sans:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic&subset=greek-ext,vietnamese,cyrillic,latin,latin-ext,greek,cyrillic-ext',
						'type'    => 'select',
						'options' => $google_fonts);	
											
	$options[] = array( 'name' => __('Accent Color', 'qs_framework'),
						'desc' => __('This is your theme\'s main color.', 'qs_framework'),
						'id'   => $prefix . 'accent',
						'std'  => '#ff6b59',
						'type' => 'color');
						
	$options[] = array( 'name' => __('Link Color', 'qs_framework'),
						'desc' => __('Your theme will use this color for all links (when not hovered).', 'qs_framework'),
						'id'   => $prefix . 'link_color',
						'std'  => '#333333',
						'type' => 'color');
						
	$options[] = array( 'name' => __('Button Background Color', 'qs_framework'),
						'desc' => __('Background color for all buttons.', 'qs_framework'),
						'id'   => $prefix . 'button_bg_color',
						'std'  => '#666666',
						'type' => 'color');
						
	$options[] = array( 'name' => __('Button Text Color', 'qs_framework'),
						'desc' => __('Text color for all buttons.', 'qs_framework'),
						'id'   => $prefix . 'button_text_color',
						'std'  => '#ffffff',
						'type' => 'color');
						
	$options[] = array( 'name' => __('Heading Color', 'qs_framework'),
						'desc' => __('This is the color used for all headings.', 'qs_framework'),
						'id'   => $prefix . 'heading_color',
						'std'  => '#464646',
						'type' => 'color');
			
	$options[] = array( 'name' => __('Background', 'qs_framework'),
						'desc' => __('This is the site\'s default background color or photo.', 'qs_framework'),
						'id'   => $prefix . 'background',
						'std'  => array(
								'color'      => '#fbfbfb',
								'image'      => '',
								'repeat'     => 'repeat',
								'position'   => 'top center',
								'attachment' => 'scroll'
							), 
						'type' => 'background');


	/* ---------------------------------------------------------------------- */
	/*	Header
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('Header', 'qs_framework'),
						'type' => 'heading');
						
	$options[] = array( 'name'    => __('Header Position', 'qs_framework'),
						'desc'    =>  __('If checked the header will scroll with the page so that the navigation is always accessible.  Otherwise, it sits at the top of the page.', 'qs_framework'),
						'id'      => $prefix . 'header_position',
						'type'    => 'select',
						'std'     => 'fixed',
						'options' => $header_positions);

	$options[] = array( 'name' => __('Fade In Height', 'qs_framework'),
						'desc' => __('Set the height you want the header to appear (if position is set to fade in).', 'qs_framework'),
						'id'   => $prefix . 'header_fade_height',
						'std'  => '600',
						'type' => 'text');
						
	$options[] = array( 'name'    => __('Header Opacity', 'qs_framework'),
						'desc'    => __('Set the transparency of the header.  100% is completely solid, while 0% is transparent.', 'qs_framework'),
						'id'      => $prefix . 'header_opacity',
						'std'     => '100', 
						'type'    => 'select',
						'options' => $opacity);
												
	$options[] = array( 'name'    => __('Navigation Font', 'qs_framework'),
						'desc'    => __('Font for the navigation.', 'qs_framework') . ' <p> <input type="button" value="Preview Font" onclick="googleFontPreview(\'' . $prefix . 'blockquote_heading_font\');" />',
						'id'      => $prefix . 'nav_font',
						'std'     => 'PT+Serif:regular,italic,bold,bolditalic&subset=cyrillic,latin',
						'type'    => 'select',
						'options' => $google_fonts);
												
	$options[] = array( 'name' => __('Header Background', 'qs_framework'),
						'desc' => __('The color used for your header/navigation area.', 'qs_framework'),
						'id'   => $prefix . 'header',
						'std'  => '#ffffff', 
						'type' => 'color');
						
	$options[] = array( 'name' => __('Header Border', 'qs_framework'),
						'desc' => __('Header Border Color', 'qs_framework'),
						'id'   => $prefix . 'header_border',
						'std'  => '#f7f7f7', 
						'type' => 'color');

	$options[] = array( 'name' => __('Navigation Link Color', 'qs_framework'),
						'desc' => __('Color for the navigation links in the header.', 'qs_framework'),
						'id'   => $prefix . 'nav_link_color',
						'std'  => '#666666', 
						'type' => 'color');
	/* ---------------------------------------------------------------------- */
	/*	Footer
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('Footer', 'qs_framework'),
						'type' => 'heading');
						
	$options[] = array( 'name' => __('Footer Text', 'qs_framework'),
						'desc' => sprintf( __('This is the text (HTML) placed in the footer.', 'qs_framework')),
						'id'   => $prefix . 'footer_text',
						'std'  => "[two_third]\n<span style=\"padding:10px 0;display:block;\">QuickStep &copy; 2012\n<a href=\"http://themeluxe.com\" target=\"_blank\">Theme Luxe</a></span>\n[/two_third]\n[one_third_last][social][/one_third_last]",
						'type' => 'textarea');

	$options[] = array( 'name' => __('Footer Background Color', 'qs_framework'),
						'desc' => __('The background color for the footer of the site.', 'qs_framework'),
						'id'   => $prefix . 'footer_bg_color',
						'std'  => '#212121', 
						'type' => 'color');
						
	$options[] = array( 'name' => __('Footer Text Color', 'qs_framework'),
						'desc' => __('Color for text in the footer area.', 'qs_framework'),
						'id'   => $prefix . 'footer_text_color',
						'std'  => '#999999', 
						'type' => 'color');
						
	$options[] = array( 'name' => __('Footer Link Color', 'qs_framework'),
						'desc' => __('Color for all links in the footer.', 'qs_framework'),
						'id'   => $prefix . 'footer_link_color',
						'std'  => '#ffffff', 
						'type' => 'color');
						
	$options[] = array( 'name' => __('Footer Widgets Background Color', 'qs_framework'),
						'desc' => __('The background color for the footer of the site.', 'qs_framework'),
						'id'   => $prefix . 'footer_widgets_bg_color',
						'std'  => '#363839', 
						'type' => 'color');
						
	$options[] = array( 'name' => __('Footer Widgets Text Color', 'qs_framework'),
						'desc' => __('Color for text in the footer area.', 'qs_framework'),
						'id'   => $prefix . 'footer_widgets_text_color',
						'std'  => '#999999', 
						'type' => 'color');
						
	$options[] = array( 'name' => __('Footer Widgets Heading Color', 'qs_framework'),
						'desc' => __('Color for text in the footer area.', 'qs_framework'),
						'id'   => $prefix . 'footer_widgets_heading_color',
						'std'  => '#ffffff', 
						'type' => 'color');
						
	$options[] = array( 'name' => __('Footer Widgets Link Color', 'qs_framework'),
						'desc' => __('Color for all links in the footer.', 'qs_framework'),
						'id'   => $prefix . 'footer_widgets_link_color',
						'std'  => '#ffffff', 
						'type' => 'color');
						
						
	/* ---------------------------------------------------------------------- */
	/*	Portfolio / Blog
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('Portfolio & Blog', 'qs_framework'),
						'type' => 'heading');

	$options[] = array( 'name'    => __('Portfolio Pretty Photo', 'qs_framework'),
						'desc'    =>  __('Allows images to be zoomed when clicked in the portfolio.', 'qs_framework'),
						'id'      => $prefix . 'portfolio_prettyphoto',
						'type'    => 'checkbox',
						'std'     => '1');
						
	$options[] = array( 'name'    => __('Blog Pretty Photo', 'qs_framework'),
						'desc'    =>  __('Allows blog images to be zoomed when clicked.', 'qs_framework'),
						'id'      => $prefix . 'blog_prettyphoto',
						'type'    => 'checkbox',
						'std'     => '1');
						
	$options[] = array( 'name'    => __('Portfolio Picture Opacity', 'qs_framework'),
						'desc'    => __('If enabled the portfolio pictures are set to 70% opacity and return to normal when hovered.', 'qs_framework'),
						'id'      => $prefix . 'portfolio_opacity',
						'type'    => 'checkbox',
						'std'     => '1');

	$options[] = array( 'name'    => __('Blog Picture Opacity', 'qs_framework'),
						'desc'    => __('If enabled the blog pictures are set to 70% opacity and return to normal when hovered.', 'qs_framework'),
						'id'      => $prefix . 'blog_opacity',
						'type'    => 'checkbox',
						'std'     => '1');




	/* ---------------------------------------------------------------------- */
	/*	Social
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('Social', 'qs_framework'),
						'type' => 'heading');				

	$options[] = array( 'name' => __('Behance', 'qs_framework'),
						'desc' => __('Behance profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_behance',
						'type' => 'text');

	$options[] = array( 'name' => __('Delicious', 'qs_framework'),
						'desc' => __('Delicious profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_delicious',
						'type' => 'text');

	$options[] = array( 'name' => __('deviantART', 'qs_framework'),
						'desc' => __('deviantART profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_deviantart',
						'type' => 'text');

	$options[] = array( 'name' => __('Digg', 'qs_framework'),
						'desc' => __('Digg profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_digg',
						'type' => 'text');
						
	$options[] = array( 'name' => __('Digg 2', 'qs_framework'),
						'desc' => __('Digg profile URL (this icon uses the logo instead of the word \'digg\'.', 'qs_framework'),
						'id'   => $prefix . 'social_digg2',
						'type' => 'text');

	$options[] = array( 'name' => __('Dribbble', 'qs_framework'),
						'desc' => __('Dribbble profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_dribbble',
						'type' => 'text');

	$options[] = array( 'name' => __('Facebook', 'qs_framework'),
						'desc' => __('Facebook profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_facebook',
						'type' => 'text');

	$options[] = array( 'name' => __('Flickr', 'qs_framework'),
						'desc' => __('Flickr profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_flickr',
						'type' => 'text');

	$options[] = array( 'name' => __('Forrst', 'qs_framework'),
						'desc' => __('Forrst profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_forrst',
						'type' => 'text');

	$options[] = array( 'name' => __('Google', 'qs_framework'),
						'desc' => __('Google profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_google',
						'type' => 'text');
						
	$options[] = array( 'name' => __('Google 2', 'qs_framework'),
						'desc' => __('Google profile URL (this icon uses the capital \'G\' for the logo).', 'qs_framework'),
						'id'   => $prefix . 'social_google2',
						'type' => 'text');

	$options[] = array( 'name' => __('Grooveshark', 'qs_framework'),
						'desc' => __('Grooveshark profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_grooveshark',
						'type' => 'text');

	$options[] = array( 'name' => __('Last.fm', 'qs_framework'),
						'desc' => __('Last.fm profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_lastfm',
						'type' => 'text');

	$options[] = array( 'name' => __('LinkedIn', 'qs_framework'),
						'desc' => __('LinkedIn profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_linkedin',
						'type' => 'text');

	$options[] = array( 'name' => __('MySpace', 'qs_framework'),
						'desc' => __('MySpace profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_myspace',
						'type' => 'text');

	$options[] = array( 'name' => __('Pinterest', 'qs_framework'),
						'desc' => __('Pinterest profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_pinterest',
						'type' => 'text');

	$options[] = array( 'name' => __('RSS Feed URL', 'qs_framework'),
						'desc' => __('RSS feed URL.', 'qs_framework'),
						'id'   => $prefix . 'social_rss',
						'type' => 'text');

	$options[] = array( 'name' => __('Skype', 'qs_framework'),
						'desc' => __('Skype profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_skype',
						'type' => 'text');

	$options[] = array( 'name' => __('Tumblr', 'qs_framework'),
						'desc' => __('Tumblr profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_tumblr',
						'type' => 'text');

	$options[] = array( 'name' => __('Twitter', 'qs_framework'),
						'desc' => __('Twitter Profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_twitter',
						'type' => 'text');
						
	$options[] = array( 'name' => __('Twitter 2', 'qs_framework'),
						'desc' => __('Twitter Profile URL (this icon uses the Twitter bird instead of the letter).', 'qs_framework'),
						'id'   => $prefix . 'social_twitter2',
						'type' => 'text');

	$options[] = array( 'name' => __('Vimeo', 'qs_framework'),
						'desc' => __('Vimeo profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_vimeo',
						'type' => 'text');

	$options[] = array( 'name' => __('YouTube', 'qs_framework'),
						'desc' => __('YouTube profile URL.', 'qs_framework'),
						'id'   => $prefix . 'social_youtube',
						'type' => 'text');

        
        /* ---------------------------------------------------------------------- */
	/*	AJAX Settings
	/* ---------------------------------------------------------------------- */

	$options[] = array( 'name' => __('AJAX', 'qs_framework'),
						'type' => 'heading');

	$options[] = array( 'name'    => __('Separate Blog Posts', 'qs_framework'),
						'desc'    => __('If checked your blog posts will load in a separate page.', 'qs_framework'),
						'id'      => $prefix . 'separate_posts',
						'type'    => 'checkbox',
						'std'     => '0',);
        
	$options[] = array( 'name'    => __('Separate Blog Tags', 'qs_framework'),
						'desc'    => __('If checked your blog post tags and meta information will load in a separate page.', 'qs_framework'),
						'id'      => $prefix . 'separate_tags',
						'type'    => 'checkbox',
						'std'     => '0',);

	$options[] = array( 'name'    => __('Separate Portfolio Items', 'qs_framework'),
						'desc'    => __('If checked your portfolio items will load in a separate page.', 'qs_framework'),
						'id'      => $prefix . 'separate_portfolio',
						'type'    => 'checkbox',
						'std'     => '0',);
        
	$options[] = array( 'name'    => __('Separate Sidebar Links', 'qs_framework'),
						'desc'    => __('If checked your sidebar and widget links will load in a separate page.', 'qs_framework'),
						'id'      => $prefix . 'separate_sidebar',
						'type'    => 'checkbox',
						'std'     => '0',);

	return $options;

}