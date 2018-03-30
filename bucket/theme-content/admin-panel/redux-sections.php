<?php

$sections = array();

// General Options
// ------------------------------------------------------------------------
$sections[] = array(
	'icon' => 'database-1',
	'icon_class' => '',
	'title' => __('General', 'bucket'),
	'desc' => sprintf('<p class="description">'.__('General settings contains options that have a site-wide effect like defining your site branding (including logo and other icons).', 'bucket').'</p>',wpgrade::themename()),
	'fields' => array(
		array(
			'id' => 'main_logo',
			'type' => 'media',
			'title' => __('Main Logo', 'bucket'),
			'subtitle' => __('If there is no image uploaded, plain text will be used instead (generated from the site\'s name).', 'bucket'),
		),
		array(
			'id' => 'use_retina_logo',
			'type' => 'switch',
			'title' => __('Retina 2x Logo', 'bucket'),
			'subtitle' => __('To be Retina-ready you need to add a 2x logo image (double the dimensions of the 1x logo above).', 'bucket'),
		),
		array(
			'id' => 'retina_main_logo',
			'type' => 'media',
			'title' => __('Retina 2x Logo Image', 'bucket'),
			'required' => array('use_retina_logo', 'equals', 1)
		),
		array(
			'id' => 'favicon',
			'type' => 'media',
			'title' => __('Favicon', 'bucket'),
			'subtitle' => __('Upload a 16px x 16px image that will be used as a favicon.', 'bucket'),
		),
		array(
			'id' => 'apple_touch_icon',
			'type' => 'media',
			'title' => __('Apple Touch Icon', 'bucket'),
			'subtitle' => __('You can customize the icon for the Apple touch shortcut to your website. The size of this icon must be 77x77px.', 'bucket')
		),
		array(
			'id' => 'metro_icon',
			'type' => 'media',
			'title' => __('Metro Icon', 'bucket'),
			'subtitle' => __('The size of this icon must be 144x144px.', 'bucket')
		),
		array(
			'id' => 'enable_lazy_loading_images',
			'type' => 'switch',
			'title' => __('Enable Images Lazy Loading?', 'bucket'),
			'subtitle' => __('Enable this to allow us to lazy load the images so you will increase your page loading speed.', 'bucket'),
			'default' => '1',
		),
	)
);


// Style Options
// ------------------------------------------------------------------------
$sections[] = array(
	'icon' => "params",
	'icon_class' => '',
	'class'           => 'has-customizer customizer-only',
	'title' => __('Style', 'bucket'),
	'desc' => '<p class="description">'.__('The style options control the general styling of the site, like accent color and Google Web Fonts. You can choose custom fonts for various typography elements with font weight, char set, size and/or height. You also have a live preview for them.', 'bucket').'</p>',
	'type' => 'customizer_section',
	'fields' => array(
		array(
			'id' => 'main_color',
			'type' => 'color',
			'title' => __('Main Color', 'bucket'),
			'subtitle' => __('Use the color picker to change the main color of the site to match your brand color.', 'bucket'),
			'default' => '#fb4834',
			'validate' => 'color',
			'transparent' => false,
			'compiler' => true,
		),

		array(
			'id'=>'typography-info',
			'desc'=> '<h3>'.__('Typography', 'bucket').'</h3>',
			'type' => 'info'
		),
		array(
			'id' => 'use_google_fonts',
			'type' => 'switch',
			'title' => __('Do you need custom web fonts?', 'bucket'),
			'subtitle' => __('Tap into the massive <a href="http://www.google.com/fonts/">Google Fonts</a> collection (with Live preview).', 'bucket'),
			'default' => '0',
			'compiler' => false,
		),
		// Headings Font
		array(
			'id' => 'google_titles_font',
			'type' => 'customizer_typography',
			'color' => false,
			'font-size'=>false,
            'line-height'=>false,
            'text-align' => false,
			'required' => array('use_google_fonts', '=', 1),
			'title' => __('Headings Font', 'bucket'),
			'subtitle' => __('Font for titles and headings.', 'bucket'),
			'compiler' => false,
		),
		// Navigation Font
		array(
			'id' => 'google_nav_font',
			'type' => 'customizer_typography',
			'color' => false,
			'font-size'=>false,
            'line-height'=>false,
            'text-align' => false,
			'required' => array('use_google_fonts', '=', 1),
			'title' => __('Navigation Font', 'bucket'),
			'subtitle' => __('Font for navigation menu.', 'bucket'),
			'compiler' => false,
		),
		// Body Font
		array(
			'id'=>'google_body_font',
			'type' => 'customizer_typography',
			'color' => false,
			'text-align' => false,
			'required' => array('use_google_fonts', '=', 1),
			'title' => __('Body Font', 'bucket'),
			'subtitle'=> __('Font for content text and widget text.', 'bucket'),
			'compiler' => false,
		),
		array(
			'id'=>'layout-info',
			'desc'=> __('<h3>Layout</h3>', 'bucket'),
			'type' => 'info'
		),
		array(
			'id' => 'layout_boxed',
			'type' => 'switch',
			'title' => __('Boxed Layout', 'bucket'),
			'subtitle' => __('With Boxed Layout enabled you can use an image as background (go to Appearance - Background).', 'bucket'),
			'default' => '0'
		),
	)
);

// Article Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => 'pencil-1',
	'title' => __('Articles', 'bucket'),
	'desc' => sprintf('<p class="description">'.__('Article options control the various aspects related to displaying posts both in archives and single articles. You can control things like excerpt length and social sharing.', 'bucket').'</p>',wpgrade::themename()),
	'fields' => array(
		array(
			'id' => 'title_position',
			'type' => 'select',
			'title' => __('Single Post Title Position', 'bucket'),
			'subtitle' => __('Choose where to display the article title and meta tags.', 'bucket'),
			'options' => array(
				'above' => 'Above the Featured Image',
				'below' => 'Below the Featured Image'
			),
			'default' => 'below',
			'select2' => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => -1, // this way the search box will be disabled
				'allowClear' => false // don't allow a empty select
			)
		),
		array(
			'id' => 'blog_single_show_title_meta_info',
			'type' => 'switch',
			'title' => __('Show Post Title Extra Info', 'bucket'),
			'subtitle' => __('Do you want to show the date and the author under the title?', 'bucket'),
			'default' => '1',
		),
		array(
			'id' => 'blog_single_share_links_twitter',
			'type' => 'checkbox',
			'title' => __('Twitter Share Link', 'bucket'),
			'desc' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
		),
		array(
			'id' => 'blog_single_share_links_facebook',
			'type' => 'checkbox',
			'title' => __('Facebook Share Link', 'bucket'),
			'desc' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
		),
		array(
			'id' => 'blog_single_share_links_googleplus',
			'type' => 'checkbox',
			'title' => __('Google+ Share Link', 'bucket'),
			'desc' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
		),
		array(
			'id' => 'blog_single_share_links_pinterest',
			'type' => 'checkbox',
			'title' => __('Pinterest Share Link', 'bucket'),
			'desc' => '',
			'default' => '1',
			'required' => array('blog_single_show_share_links', '=', 1)
		),
		array(
			'id' => 'blog_single_share_links_position',
			'type' => 'select',
			'title' => __('Share Links Position', 'bucket'),
			'subtitle' => __('Choose where to display the share links.', 'bucket'),
			'options' => array(
				'top' => 'Top',
				'bottom' => 'Bottom',
				'both' => 'Both Top & Bottom',
			),
			'default' => 'bottom',
			'select2' => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => -1, // this way the search box will be disabled
				'allowClear' => false // don't allow a empty select
			),
			'required' => array('blog_single_show_share_links', '=', 1)
		),
		array(
			'id' => 'blog_single_show_author_box',
			'type' => 'switch',
			'title' => __('Show Author Info Box', 'bucket'),
			'subtitle' => __('Do you want to show author info box with avatar and description bellow the post?', 'bucket'),
			'default' => '1',
		),
		array(
			'id'=>'blog-archive-info',
			'desc'=> __('<h3>Blog Archive</h3>', 'bucket'),
			'type' => 'info'
		),
		array(
			'id' => 'blog_layout',
			'type' => 'image_select',
			'title' => __('Blog Posts Layout', 'bucket'),
			'subtitle' => __('Choose the layout for blog areas (eg. blog archive page, categories, search results).', 'bucket'),
			'default' => 'masonry',
			'options' => array(
				'masonry' => array('Masonry', 'img' => wpgrade::resourceuri('images/blog-masonry.png')),
				'classic' => array('Classic', 'img' => wpgrade::resourceuri('images/blog-classic.png')),
			)
		),
		array(
			'id' => 'blog_excerpt_length',
			'type' => 'text',
			'title' => __('Excerpt Length', 'bucket'),
			'subtitle' => __('Set the number of words for posts excerpt.', 'bucket'),
			'default' => '20',
		),
		array(
			'id' => 'blog_excerpt_more_text',
			'type' => 'text',
			'title' => __('Excerpt "More" Text', 'bucket'),
			'subtitle' => __('Change the default [...] with something else (leave empty if you want to remove it).', 'bucket'),
			'default' => '..',
		),
		array(
			'id' => 'blog_archive_show_cat_billboard',
			'type' => 'switch',
			'title' => __('Show Slider On Category Pages?', 'bucket'),
			'subtitle' => __('Check this if you want to display at the top of your category archives a slider with the posts marked as making part of the category slider.', 'bucket'),
			'default' => '1',
		),
		array(
			'id' => 'blog_cat_slider_transition',
			'type' => 'select',
			'title' => __('Slider transition', 'bucket'),
			'options' => array(
					'move' => __('Slide/Move', 'bucket'),
					'fade' => __('Fade', 'bucket'),
			),
			'default' => 'move',
			'select2' => array( // here you can provide params for the select2 jquery call
			    'minimumResultsForSearch' => -1, // this way the search box will be disabled
				'allowClear' => false // don't allow a empty select
			),
			'required' => array('blog_archive_show_cat_billboard', '=', 1)
		),
		array(
			'id' => 'blog_cat_slider_autoplay',
			'type' => 'switch',
			'title' => __('Slider autoplay', 'bucket'),
			'default' => '0',
			'required' => array('blog_archive_show_cat_billboard', '=', 1)
		),
		array(
			'id' => 'blog_cat_slider_delay',
			'type' => 'text',
			'title' => __('Autoplay delay between slides (in milliseconds)', 'bucket'),
			'default' => '2000',
			'required' => array('blog_archive_show_cat_billboard', '=', 1)
		)
	)
);

// Header Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => 'note-1',
	'title' => __('Header', 'bucket'),
	'desc' => '<p class="description">'.__('Header options allow you to control both the visual and functional aspect of the site header. You can choose various layouts, show or hide elements, and change the color scheme (light or dark).', 'bucket').'</p>',
	'fields' => array(
		array(
			'id' => 'header_type',
			'type' => 'image_select',
			'title' => __('Header Layout Style', 'bucket'),
			'subtitle' => __('Choose the layout for the header area.', 'bucket'),
			'default' => 'type1',
			'options' => array(
				'type1' => array('Type 1', 'img' => wpgrade::resourceuri('images/header-type1.png')),
				'type2' => array('Type 2', 'img' => wpgrade::resourceuri('images/header-type2.png')),
				'type3' => array('Type 3', 'img' => wpgrade::resourceuri('images/header-type3.png')),
			)
		),
		array(
			'id' => 'header_728_90_ad',
			'type' => 'ace_editor',
			'title' => __('Header Ad Code', 'bucket'),
			'subtitle' => __('Paste here the code for the header ad (optimally 720x90px). We will also parse any shortcodes present.', 'bucket'),
			'required' => array('header_type', 'equals', 'type2'),
			'default' => '<a class="header-ad-link" href="#"><img src="http://placehold.it/728x90" alt="#" /></a>',
			'mode' => 'html',
			'theme' => 'chrome',
		),
		array(
			'id' => 'nav_inverse_top',
			'type' => 'switch',
			'title' => __('Header Top Nav Inverse', 'bucket'),
			'subtitle' => __('Inverse the contrast of the header top navigation bar (black text on white background).', 'bucket'),
			'default' => '0'
		),
		array(
			'id' => 'nav_inverse_main',
			'type' => 'switch',
			'title' => __('Header Main Nav Inverse', 'bucket'),
			'subtitle' => __('Inverse the contrast of the main navigation bar including sub-menus and mega-menus (black text on white background).', 'bucket'),
			'default' => '0'
		),
		array(
			'id' => 'nav_show_header_search',
			'type' => 'switch',
			'title' =>  __('Show Header Search Form', 'bucket'),
			'subtitle' => __('Display the search form in the header (it\'s position may vary depending the Header Type).', 'bucket'),
			'default' => '1'
		),
		array(
			'id' => 'nav_main_sticky',
			'type' => 'switch',
			'title' =>  __('Sticky Main Navigation', 'bucket'),
			'subtitle' => __('Pin the Main Navigation to the top of the screen when scrolling down.', 'bucket'),
			'default' => '0'
		)
	)
);

// Footer Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => 'tag-1',
	'title' => __('Footer', 'bucket'),
	'desc' => '<p class="description">'.__('Footer related options including Copyright Text. Other footer elements including widgets and menus can be set from Appearance - Widgets/Menus admin page. ', 'bucket').'</p>',
	'fields' => array(
		array(
			'id' => 'posts_stats',
			'type' => 'switch',
			'title' => __('Posts Stats', 'bucket'),
			'subtitle' => __('Display a monthly based vertical bar graph for posts.', 'bucket'),
			'default' => '1',
		),
		array(
			'id' => 'back_to_top',
			'type' => 'switch',
			'title' => __('Back to Top Link', 'bucket'),
			'subtitle' => __('Add a link that helps users jump to the top of the page (instead of pressing "Home" key).', 'bucket'),
			'default' => '1',
		),
		array(
			'id' => 'copyright_text',
			'type' => 'editor',
			'title' => __('Copyright Text', 'bucket'),
			'subtitle' => sprintf(__('Text that will appear in footer left area (eg. Copyright 2013 %s | All Rights Reserved).', 'bucket'),wpgrade::themename()),
			'default' => 'Copyright &copy; 2015 '. wpgrade::themename() .' | All rights reserved.',
			'rows' => 3,
		),
	)
);

$sections[] = array(
    'type' => 'divide',
);


// Social and SEO options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "thumbs-up-1",
	'icon_class' => '',
	'title' => __('Social and SEO', 'bucket'),

	'desc' => '<p class="description">'.__('Social and SEO options allow you to input your social links and choose where to display them. Then you can set the social SEO related info added in the meta tags or used in various widgets.', 'bucket').'</p>',
	'fields' => array(
        array(
            'id' => 'social_icons',
            'type' => 'text_sortable',
            'title' => __('Social Icons', 'bucket'),
            'subtitle' => sprintf(__('Define and reorder your social links.<br /><b>Note:</b> These will be displayed in the "%s Social Links" widget so you can put them anywhere on your site. Only those filled will appear.<br /><br /><strong> You need to imput the entire URL (ie. http://twitter.com/username)</strong>', 'bucket'),wpgrade::themename()),
            'desc' => __('Icons provided by <strong>FontAwesome</strong> and <strong>Entypo</strong>.', 'bucket'),
			'checkboxes' => array(
				'widget'=> __('Widget', 'bucket'),
				'header'=> __('Header', 'bucket')
			),
            'options' => array(
                'flickr' => __('Flickr', 'bucket'),
                'tumblr' => __('Tumblr', 'bucket'),
                'pinterest' => __('Pinterest', 'bucket'),
                'instagram' => __('Instagram', 'bucket'),
                'behance' => __('Behance', 'bucket'),
                'fivehundredpx' => __('500px', 'bucket'),
                'deviantart' => __('DeviantART', 'bucket'),
                'dribbble' => __('Dribbble', 'bucket'),
                'twitter' => __('Twitter', 'bucket'),
                'facebook' => __('Facebook', 'bucket'),
                'gplus' => __('Google+', 'bucket'),
                'youtube' => __('Youtube', 'bucket'),
                'vimeo' => __('Vimeo', 'bucket'),
                'linkedin' => __('LinkedIn', 'bucket'),
                'skype' => __('Skype', 'bucket'),
                'soundcloud' => __('SoundCloud', 'bucket'),
                'digg' => __('Digg', 'bucket'),
                'lastfm' => __('Last.FM', 'bucket'),
                'appnet' => __('App.net', 'bucket'),
                'rss' => __('RSS Feed', 'bucket'),
            )
        ),

//		array(
//			'id'=>"social_icons",
//			'type' => 'group',//doesnt need to be called for callback fields
//			'title' => __('Social Icons', 'bucket'),
//			'subtitle' => __('Group any items together.', 'bucket'),
//			'desc' => __('No limit as to what you can group. Just don\'t try to group a group.', 'bucket'),
//			'groupname' => __('Social Icon', 'bucket'), // Group name
//			'subfields' => array(
//				array(
//					'id'=>'social_icons_name',
//					'type' => 'text',
//					'title' => __('Social Icon Name', 'bucket'),
//					'subtitle'=> __('This will apear as alt text on icon', 'bucket'),
//				),
//				array(
//					'id'=>'social_icons_url',
//					'type' => 'text',
//					'title' => __('Link', 'bucket'),
//					'subtitle' => __('Here you put your subtitle', 'bucket'),
//				),
//				array(
//					'id' => 'social_icons_image_type',
//					'type' => 'image_select',
//					'title' => __('Icon Type', 'bucket'),
//					'options' => array(
//						'image' => array( __('Image', 'bucket' ), 'img' => 'images/align-right.png' ),
//						'font-awesome'=> array( __('Font Awesome', 'bucket'), 'img' => 'images/align-left.png' )
//					),
//					'default' => 'image',
//				),
//				array(
//					'id'=>'social_icons_image',
//					'type' => 'media',
//					'title' => __('Image', 'bucket'),
//					'subtitle' => __('Upload the image.', 'bucket'),
//					'required' => array('social_icons_image_type', '=', 'image'),
//				),
//				array(
//					'id'=>'social_icons_font_awesome',
//					'type' => 'text',
//					'title' => __('Icon Name', 'bucket'),
//					'subtitle' => __('Here you can write a font-awesome class name (e.g. fa-facebook).', 'bucket'),
//					'required' => array('social_icons_image_type', '=', 'font-awesome'),
//				),
//			),
//		),

		array(
			'id' => 'social_icons_target_blank',
			'type' => 'switch',
			'title' => __('Open social icons links in new a window?', 'bucket'),
			'subtitle' => __('Do you want to open social links in a new window ?', 'bucket'),
			'default' => '1',
		),
		array(
			'id' => 'prepare_for_social_share',
			'type' => 'switch',
			'title' => __('Add Social Meta Tags', 'bucket'),
			'subtitle' => __('Let us properly prepare your theme for the social sharing and discovery by adding the needed metatags in the <head> section.', 'bucket'),
			'default' => '1',
		),
		array(
			'id' => 'facebook_id_app',
			'type' => 'text',
			'title' => __('Facebook Application ID', 'bucket'),
			'subtitle' => __('Enter the Facebook Application ID of the Fan Page which is associated with this website. You can create one <a href="https://developers.facebook.com/apps">here</a>.', 'bucket'),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'facebook_admin_id',
			'type' => 'text',
			'title' => __('Facebook Admin ID', 'bucket'),
			'subtitle' => __('The id of the user that has administrative privileges to your Facebook App so you can access the <a href="https://www.facebook.com/insights/">Facebook Insights</a>.', 'bucket'),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'google_page_url',
			'type' => 'text',
			'title' => __('Google+ Publisher', 'bucket'),
			'subtitle' => __('Enter your Google Plus page ID (example: https://plus.google.com/<b>105345678532237339285</b>) here if you have set up a "Google+ Page".', 'bucket'),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'twitter_card_site',
			'type' => 'text',
			'title' => __('Twitter Site Username', 'bucket'),
			'subtitle' => __('The Twitter username of the entire site. The username for the author will be taken from the author\'s profile (skip the @)', 'bucket'),
			'required' => array('prepare_for_social_share', '=', 1)
		),
		array(
			'id' => 'social_share_default_image',
			'type' => 'media',
			'title' => __('Default Social Share Image', 'bucket'),
			'desc' => __('If an image is uploaded, this will be used for content sharing if you don\'t upload a custom image with your content (at least 200px wide recommended).', 'bucket'),
		),
		array(
			'id' => 'use_twitter_widget',
			'type' => 'switch',
			'title' => __('Use Twitter Widget', 'bucket'),
			'subtitle' => __('Just a widget to show your latest tweets (Twitter API v1.1 compatible). You can add it in your blog or footer sidebars.<div class="description">', 'bucket'),
			'default' => '1',
		),
		array(
			'id' => 'info_about_twitter_app',
			'type' => 'info',
			'title' => __('Important Note : ', 'bucket'),
			'desc' => __('<div>In order to use the Twitter widget you will need to create a Twitter application <a href="https://dev.twitter.com/apps/new" >here</a> and get your own key, secrets and access tokens. This is due to the changes that Twitter made to it\'s API (v1.1). Please note that these defaults are used on the theme demo site but they might be disabled at any time, so we <strong>strongly</strong> recommend you to input your own bellow.</div>', 'bucket'),
			'required' => array('use_twitter_widget', '=', 1)
		),
		array(
			'id' => 'twitter_consumer_key',
			'type' => 'text',
			'title' => __('Consumer Key', 'bucket'),
			'default' => 'UGciUkPwjDpCRyEqcGsbg',
			'required' => array('use_twitter_widget', '=', 1)
		),
		array(
			'id' => 'twitter_consumer_secret',
			'type' => 'text',
			'title' => __('Consumer Secret', 'bucket'),
			'default' => 'nuHkqRLxKTEIsTHuOjr1XX5YZYetER6HF7pKxkV11E',
			'required' => array('use_twitter_widget', '=', 1)
		),
		array(
			'id' => 'twitter_oauth_access_token',
			'type' => 'text',
			'title' => __('Oauth Access Token', 'bucket'),
			'default' => '205813011-oLyghRwqRNHbZShOimlGKfA6BI4hk3KRBWqlDYIX',
			'required' => array('use_twitter_widget', '=', 1)
		),
		array(
			'id' => 'twitter_oauth_access_token_secret',
			'type' => 'text',
			'title' => __('Oauth Access Token Secret', 'bucket'),
			'default' => '4LqlZjf7jDqmxqXQjc6MyIutHCXPStIa3TvEHX9NEYw',
			'required' => array('use_twitter_widget', '=', 1)
		),
	)
);

// Custom Code
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "database-1",
	'icon_class' => '',
	'title' => __('Custom Code', 'bucket'),
	'desc' => '<p class="description">'.__('You can change the site style and behaviour by adding custom scripts to all pages within your site using the custom code areas below.', 'bucket').'</p>',
	'fields' => array(
		array(
			'id' => 'custom_css',
			'type' => 'ace_editor',
			'title' => __('Custom CSS', 'bucket'),
			'subtitle' => __('Enter your custom CSS code. It will be included in the head section of the page.', 'bucket'),
			'desc' => '', //__('', 'bucket'),
			'mode' => 'css',
			'theme' => 'chrome',
			'compiler' => true,
		),
		array(
			'id' => 'inject_custom_css',
			'type' => 'select',
			'title' => __('Apply Custom CSS', 'bucket'),
			'subtitle' => sprintf(__('Select how to insert the custom CSS into your site.', 'bucket'),wpgrade::themename()),
			'default' => 'inline',
			'compiler' => true,
			'options' => array( 'inline' => __('Inline <em>(recommended)</em>', 'bucket'), 'file' => __('Write To File (might require file permissions)', 'bucket')),
			'select2' => array( // here you can provide params for the select2 jquery call
			    'minimumResultsForSearch' => -1, // this way the search box will be disabled
				'allowClear' => false // don't allow a empty select
			)
		),
		array(
			'id' => 'custom_js',
			'type' => 'ace_editor',
			'title' => __('Custom JavaScript (header)', 'bucket'),
			'subtitle' => __('Enter your custom Javascript code. This code will be loaded in the head section', 'bucket'),
			'mode' => 'text',
			'compiler' => true,
			'theme' => 'chrome'
		),
		array(
			'id' => 'custom_js_footer',
			'type' => 'ace_editor',
			'title' => __('Custom JavaScript (footer)', 'bucket'),
			'subtitle' => __('This javascript code will be loaded in the footer. You can paste here your <strong>Google Analytics tracking code</strong> (or for what matters any tracking code) and we will put it on every page.', 'bucket'),
			'mode' => 'text',
			'compiler' => true,
			'theme' => 'chrome'
		),
	)
);

// Utilities - Theme Auto Update + Import Demo Data
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "truck",
	'icon_class' => '',
	'title' => __('Utilities', 'bucket'),
	'desc' => '<p class="description">'.__('Utilities help you keep up-to-date with new versions of the theme. Also you can import the demo data from here.', 'bucket').'</p>',
	'fields' => array(
		array(
			'id'=>'import-demo-data-info',
			'desc'=> __('<h3>Import Demo Data</h3>
				<p class="description">'.__('Here you can import the demo data and get on your way of setting up the site like the theme demo.', 'bucket').'</p>', 'bucket'),
			'type' => 'info'
		),
		array(
			'id' => 'wpGrade_import_demodata_button',
			'type' => 'info',
			'desc' =>
			'
				<input type="hidden" name="wpGrade-nonce-import-posts-pages" value="'.wp_create_nonce ('wpGrade_nonce_import_demo_posts_pages').'" />
						<input type="hidden" name="wpGrade-nonce-import-theme-options" value="'.wp_create_nonce ('wpGrade_nonce_import_demo_theme_options').'" />
						<input type="hidden" name="wpGrade-nonce-import-widgets" value="'.wp_create_nonce ('wpGrade_nonce_import_demo_widgets').'" />
						<input type="hidden" name="wpGrade_import_ajax_url" value="'.admin_url("admin-ajax.php").'" />

						<a href="#" class="button button-primary" id="wpGrade_import_demodata_button">
							'.__('Import demo data', 'bucket').'
						</a>

						<div class="wpGrade-loading-wrap hidden">
							<span class="wpGrade-loading wpGrade-import-loading"></span>
							<div class="wpGrade-import-wait">
								'.__('Please wait a few minutes (between 1 and 3 minutes usually, but depending on your hosting it can take longer) and <strong>don\'t reload the page</strong>. You will be notified as soon as the import has finished!', 'bucket').'
							</div>
						</div>

						<div class="wpGrade-import-results hidden"></div>
						<div class="hr"><div class="inner"><span>&nbsp;</span></div></div>
					',
		),

		array(
			'id' => 'enable_acf_ui',
			'type' => 'switch',
			'title' => __('Enable Advanced Custom Fields Settings', 'bucket'),
			'subtitle' => __(' Advanced Custom Fields plugin is already included in Bucket, instead of installing it again you can enable it from here.', 'bucket'),
			'default' => '0'
		),

		array(
			'id' => 'admin_panel_options',
			'type' => 'switch',
			'title' => __('Admin Panel Options', 'bucket'),
			'subtitle' => __('Here you can copy/download your current admin option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).', 'bucket'),
		),

		array(
			'id' => 'theme_options_import',
			'type' => 'import_export',
			'required' => array('admin_panel_options', '=', 1)
		),
	)
);

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	// WooCommerce
	// ------------------------------------------------------------------------
	$sections[] = array(
		'icon' => "cart",
		'icon_class' => '',
		'title' => __('WooCommerce', 'bucket'),
		'desc' => '<p class="description">'.__('WooCommerce options!', 'bucket').'</p>',
		'fields' => array(
			array(
				'id' => 'enable_woocommerce_support',
				'type' => 'switch',
				'title' => __('Enable WooCommerce Support', 'bucket'),
				'subtitle' => __('Turn this off to avoid loading the WooCommerce assets (CSS and JS).', 'bucket'),
				'default' => '1',
			),
//			array(
//				'id' => 'woocommerce_products_numbers',
//				'type' => 'text',
//				'title' => __('Products per page', 'bucket'),
//				'subtitle' => __('Select the number of products per page.This must be numeric.', 'bucket'),
//				'validate' => 'numeric',
//				'default' => '12',
//				'class' => 'small-text'
//			),
		)
	);
}

// Help and Support
// ------------------------------------------------------------------------

$sections[] = array(
	'icon' => "cd-1",
	'icon_class' => '',
	'title' => __('Help and Support', 'bucket'),
	'desc' => '<p class="description">'.__('If you had anything less than a great experience with this theme please contact us now. You can also find answers in our community site, or official articles and tutorials in our knowledge base.', 'bucket').'</p>
		<ul class="help-and-support">
			<li>
				<a href="http://bit.ly/19G56H1">
					<span class="community-img"></span>
					<h4>Community Answers</h4>
					<span class="description">Get Help from other people that are using this theme.</span>
				</a>
			</li>
			<li>
				<a href="http://bit.ly/19G5cyl">
					<span class="knowledge-img"></span>
					<h4>Knowledge Base</h4>
					<span class="description">Getting started guides and useful articles to better help you with this theme.</span>
				</a>
			</li>
			<li>
				<a href="http://bit.ly/new-ticket">
					<span class="community-img"></span>
					<h4>Submit a Ticket</h4>
					<span class="description">File a ticket for a personal response from our support team.</span>
				</a>
			</li>
		</ul>
	',
	'fields' => array(

	)
);


return $sections;
