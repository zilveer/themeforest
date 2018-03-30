
<?php

$option_tabs = array(
	'mysite_generalsettings_tab' => __( 'General Settings', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_homepage_tab' => __( 'Homepage', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_skins_tab' => __( 'Skins', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_imageresizing_tab' => __( 'Image Resizing', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_slideshow_tab' => __( 'Slideshow', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_blog_tab' => __( 'Blog', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_sidebar_tab' => __( 'Sidebar', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_footer_tab' => __( 'Footer', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_sociable_tab' => __( 'Sociable', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_seo_tab' => __( 'SEO', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_special_pages' => __( 'Specialty Pages', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_mobile_tab' => __( 'Responsive & Mobile', MYSITE_ADMIN_TEXTDOMAIN ),
	'mysite_advanced_tab' => __( 'Advanced', MYSITE_ADMIN_TEXTDOMAIN )
);

$options = array(
	
	/**
	 * Navigation
	 */
	array(
		'name' => $option_tabs,
		'type' => 'navigation'
	),
	
	/**
	 * General Settings
	 */
	array(
		'name' => array( 'mysite_generalsettings_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Logo Settings', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose whether you wish to display a custom logo or your site title.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'display_logo',
			'options' => array(
				'true' => __( 'Custom Image Logo', MYSITE_ADMIN_TEXTDOMAIN ),
				'' => sprintf( __( 'Display Site Title <small><a href="%1$s/wp-admin/options-general.php" target="_blank">(click here to edit site title)</a></small>', MYSITE_ADMIN_TEXTDOMAIN ), esc_url( get_option('siteurl') ) )
			),
			'type' => 'radio'
		),
		array(
			'name' => __( 'Custom Image Logo', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Upload an image to use as your logo.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'logo_url',
			'type' => 'upload'
		),
		array(
			'name' => __( 'Custom Favicon', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Upload an image to use as your favicon.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'favicon_url',
			'type' => 'upload'
		),
		array(
			'name' => __( 'Intro Default Options', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose the default behaviour for your intro that displays at the beginning of your pages and posts.<br /><br />Note:  This is just the default behaviour, you can still choose to override this setting when editing your posts and pages.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'intro_options',
			'options' => array( 
				'title_only' => __( 'Title Only', MYSITE_ADMIN_TEXTDOMAIN ),
				'title_teaser' => __( 'Title &amp; Teaser Text', MYSITE_ADMIN_TEXTDOMAIN ),
				'title_tweet' => __( 'Title &amp; Latest Tweet', MYSITE_ADMIN_TEXTDOMAIN ),
				'custom' => __( 'Custom Raw Html', MYSITE_ADMIN_TEXTDOMAIN ),
				'disable' => __( 'Completely Disable Intro', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle' => 'toggle_true',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Teaser Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The teaser text is the text that displays beside your title in your intro.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'custom_teaser',
			'toggle_class' => 'intro_options_title_teaser',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Custom Raw Html', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'In case you have some custom HTML you wish to display in the intro then you may insert it here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'custom_teaser_html',
			'toggle_class' => 'intro_options_custom',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Page Layout', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between a left, right, or no sidebar layout for your pages. This will be the default layout for all pages <br /><br />Note: You can override the layout on a page by page basis.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'page_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/1.png',
				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fourth_threefourth.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/threefourth_fourth.png',
			),
			'type' => 'layout'
		),
		array(
			'name' => __( 'Twitter API Settings', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => sprintf( __( 'This will be used for all twitter related features.  You may still use a different twitter username to override the default.<br /><br />Example:  When using the twitter widget you may choose a username to use instead of the default.<br /><br />For help on setting up your Twitter API copy & paste the link below into your web browser:<br /><code>%1$s</code>', MYSITE_ADMIN_TEXTDOMAIN ), 'http://mysitemyway.com/docs/index.php/General_Settings#Twitter_API_Settings' ),
			'id' => array(
				'twitter_id' => 'Twitter Username:',
				'twitter_api_key' => sprintf( __( 'Twitter API Consumer Key: <small><a href="%1$s" target="_blank">(find out how to get your Key)</a></small>', MYSITE_ADMIN_TEXTDOMAIN ), 'http://mysitemyway.com/docs/index.php/General_Settings#Twitter_API_Settings' ),
				'twitter_api_secret' => sprintf( __( 'Twitter API Consumer Secret Key: <small><a href="%1$s" target="_blank">(find out how to get your Secret Key)</a></small>', MYSITE_ADMIN_TEXTDOMAIN ), 'http://mysitemyway.com/docs/index.php/General_Settings#Twitter_API_Settings' ),
			),
			'type' => 'text'
		),
		array(
			'name' => __( 'Extra Header Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This will display in your header.<br /><br />It is usually used for a phone number or something similar.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'extra_header',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'Disable Comments on Pages', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check if you want to disable comments on pages.<br /><br />This will globally override your "Allow comments." option under your pages "Discussion" settings.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'disable_page_comments',
			'options' => array( 'true' => __( 'Globally Disable Comments on Pages', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),	
		array(
			'name' => __( 'Disable Cufon', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Cufon font replacement is a javascript tool which is used in various areas of the theme including headings, menus, buttons, etc etc.<br /><br />Check if you wish to disable this.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'disable_cufon',
			'options' => array( 'true' => __( 'Globally Disable Cufon Font Replacement', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable Breadcrumbs', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check if you do not want breadcrumbs to display anywhere in your site.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'disable_breadcrumbs',
			'options' => array( 'true' => __( 'Globally Disable Breadcrumbs', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Breadcrumb Delimiter', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This is the symbol that will appear in between your breadcrumbs.<br /><br />Some common examples would be:<br /><br /><code>/ > - , :: >></code>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'breadcrumb_delimiter',
			'htmlentities' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'Google Analytics Code', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' =>  __( 'After signing up with Google Analytics paste the code that it gives you here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'analytics_code',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Custom CSS', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This is a great place for doing quick custom styles.  For example if you wanted to change the site title color then you would paste this:<br /><br /><code>.logo a { color: blue; }</code><br /><br />If you are having problems styling something then ask on the support forum and we will be with you shortly.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'custom_css',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Custom JavaScript', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'In case you need to add some custom javascript you may insert it here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'custom_js',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Additional Headers', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'What you enter here will be added verbatim to your header. You can enter whatever additional headers you want here, even references to stylesheets.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'additional_headers',
			'type' => 'textarea'
		),
		
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Homepage
	 */
	array(
		'name' => array( 'mysite_homepage_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Homepage Layout', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between a left, right, or no sidebar layout for your homepage.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'homepage_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/1.png',
				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fourth_threefourth.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/threefourth_fourth.png',
			),
			'type' => 'layout'
		),
		array(
			'name' => __( 'Call to Action Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This is the intro text that displays just below your slider on the left hand side.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'homepage_teaser_text',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Call to Action Button Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You may change the text for your call to action button.<br /><br />This is the button that displays just below the slider on the right hand side.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'teaser_button_text',
			'type' => 'text'
		),
		array(
			'name' => __( 'Call to Action Button Settings', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can link the button to a page, set a custom link, or disable it.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'teaser_button',
			'options' => array( 
				'page' =>  __( 'Link to a Page', MYSITE_ADMIN_TEXTDOMAIN ),
				'custom' => __( 'Define a Custom link', MYSITE_ADMIN_TEXTDOMAIN ),
				'disable' => __( 'Disable Button', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle' => 'toggle_true',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Link to Page', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose a page to set as your link.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'teaser_button_page',
			'target' => 'page',
			'toggle_class' => 'teaser_button_page',
			'type' => 'select',
		),
		array(
			'name' => __( 'Custom link', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Place a URL to set as your link.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'teaser_button_custom',
			'toggle_class' => 'teaser_button_custom',
			'type' => 'text'
		),
		array(
			'name' => __( 'Custom Homepage Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can add some custom content to your homepage.<br /><br />This will display under the slider and call to action button.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'content',
			'type' => 'editor'
		),
		array(
			'name' => __( 'Additional Homepage Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose additional page content to display on your homepage.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => "mainpage_content",
			'target' => 'page',
			'type' => 'select'
		),
		array(
			'name' => __( 'Disable Slider', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check to disable your slider on the homepage.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'home_slider_disable',
			'options' => array( 'true' => __( 'Disable Homepage Slider', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Display Blog Posts', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check to display your blog posts in the homepage content.<br /><br />You can control how many posts you wish to display in Dashboard -> Settings -> Reading.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'frontpage_blog',
			'options' => array( 'display_teaser_title' => __( 'Display Blog Posts on Homepage', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Homepage Outro Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This is the text that will display right above your footer.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'homepage_footer_teaser',
			'type' => 'textarea'
		),

	
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Skins
	 */
	array(
		'name' => array( 'mysite_skins_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
		
		array(
			'name' => __( 'Skin Generator Options', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'From here you can organize, create, and upload new skins to use.<br /><br />Download Skins:<br />http://mysitemyway.com/skins', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'skin_generator',
			'options' => array( 
				'choose' => __( 'Choose a Skin', MYSITE_ADMIN_TEXTDOMAIN ),
				'create' => __( 'Create a New Skin', MYSITE_ADMIN_TEXTDOMAIN ),
				'manage' => __( 'Manage Skins', MYSITE_ADMIN_TEXTDOMAIN )
				),
			'default' => 'choose',
			'toggle' => 'toggle_true',
			'type' => 'skin_generator'
		),
		array(
			'name' => __( 'Available Skins', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select a skin to use with your theme.<br /><br />To upload new skins that you have downloaded click on the Manage Skins radio button.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'style_variations',
			'default' => '',
			'target' => 'style_variations',
			'toggle_class' => 'skin_generator_choose',
			'type' => 'skin_select'
		),
		
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Image Resizing
	 */
	
	array(
		'name' => array( 'mysite_imageresizing_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Disable Image Resizing', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check to disable all image resizing.<br /><br />Images will be displayed in the dimensions as they were uploaded.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'image_resize',
			'options' => array( 'true' => __( 'Disable Image Resizing', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Type of Image Resizing', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose whether you wish to use the TimThumb resize script or Wordpress image resizing.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'image_resize_type',
			'options' => array( 
				'wordpress' => __( 'Built in WordPress', MYSITE_ADMIN_TEXTDOMAIN ),
				'timthumb' => __( 'Timthumb', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'type' => 'radio'
		),
		array(
			'name' => __( 'Auto Featured Image', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'By default features such as the portfolio and blog will use the "featured image" in your posts.<br /><br />Check this if you wish to use the first image uploaded to your post instead of the featured image.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'auto_img',
			'options' => array( 'true' => __( 'Enable Auto Featured Image Selection', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => "checkbox"
		),
		array(
			'name' => __( 'Images Sizes for Full Width Layouts', MYSITE_ADMIN_TEXTDOMAIN ),
			'type' => 'toggle_start'
		),
		
		array(
			'name' => __( 'One Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the one column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'one_column_portfolio_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Two Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the two column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'two_column_portfolio_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Three Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the three column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'three_column_portfolio_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Four Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the four column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'four_column_portfolio_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Portfolio Single Post', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the portfolio single images to use.<br /><br />These are the images displayed on the portfolio single post.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'portfolio_single_full_full',
			'type' => 'resize'
		),
	
		array(
			'name' => __( 'One Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the one column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'one_column_blog_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Two Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the two column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'two_column_blog_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Three Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the three column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'three_column_blog_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Four Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the four column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'four_column_blog_full',
			'type' => 'resize'
		),
	
		array(
			'name' => __( 'Small Post List', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "small" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'small_post_list_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Medium Post List', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "medium" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'medium_post_list_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Large Post List', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "large" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a full width layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'large_post_list_full',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Additional Posts Module', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the additional posts thumbnails to use.<br /><br />These are the images displayed in the additional posts module.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'additional_posts_grid_full',
			'type' => 'resize'
		),
				
		array(
			'type' => 'toggle_end'
		),
		
		array(
			'name' => __( 'Images Sizes for Right Sidebar Layouts', MYSITE_ADMIN_TEXTDOMAIN ),
			'type' => 'toggle_start'
		),
		
		array(
			'name' => __( 'One Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the one column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'one_column_portfolio_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Two Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the two column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'two_column_portfolio_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Three Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the three column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'three_column_portfolio_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Four Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the four column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'four_column_portfolio_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Portfolio Single Post', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the portfolio single images to use.<br /><br />These are the images displayed on the portfolio single post.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'portfolio_single_full_big',
			'type' => 'resize'
		),

		array(
			'name' => __( 'One Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the one column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'one_column_blog_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Two Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the two column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'two_column_blog_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Three Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the three column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'three_column_blog_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Four Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the four column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'four_column_blog_big',
			'type' => 'resize'
		),

		array(
			'name' => __( 'Small Post List', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "small" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'small_post_list_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Medium Post List', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "medium" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'medium_post_list_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Large Post List', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "large" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a right sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'large_post_list_big',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Additional Posts Module', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the additional posts thumbnails to use.<br /><br />These are the images displayed in the additional posts module.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'additional_posts_grid_big',
			'type' => 'resize'
		),

		array(
			'type' => 'toggle_end'
		),
		
		array(
			'name' => __( 'Images Sizes for Left Sidebar Layouts', MYSITE_ADMIN_TEXTDOMAIN ),
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'One Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the one column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'one_column_portfolio_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Two Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the two column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'two_column_portfolio_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Three Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the three column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'three_column_portfolio_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Four Column Portfolio', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the four column portfolio images to use.<br /><br />These are the images displayed with the portfolio grid shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'four_column_portfolio_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Portfolio Single Post', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the portfolio single images to use.<br /><br />These are the images displayed on the portfolio single post.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'portfolio_single_full_small',
			'type' => 'resize'
		),

		array(
			'name' => __( 'One Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the one column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'one_column_blog_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Two Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the two column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'two_column_blog_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Three Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the three column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'three_column_blog_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Four Column Blog', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the four column blog images to use.<br /><br />These are the images displayed with the blog grid shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'four_column_blog_small',
			'type' => 'resize'
		),

		array(
			'name' => __( 'Small Post List', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "small" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'small_post_list_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Medium Post List', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "medium" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'medium_post_list_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Large Post List', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the "large" list thumbnails to use.<br /><br />These are the images displayed with the blog and portfolio list shortcode in a left sidebar layout.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'large_post_list_small',
			'type' => 'resize'
		),
		array(
			'name' => __( 'Additional Posts Module', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the dimensions that you would like the additional posts thumbnails to use.<br /><br />These are the images displayed in the additional posts module.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'additional_posts_grid_small',
			'type' => 'resize'
		),

		array(
			'type' => 'toggle_end'
		),
		
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Slideshow
	 */
	array(
		'name' => array( 'mysite_slideshow_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Choose Slider Type', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'To get started choose which slider you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'homepage_slider',
			'target' => 'slider',
			'toggle' => 'toggle_true',
			'type' => 'select',
		),
		array(
			'name' => __( 'Advanced Slider Settings', MYSITE_ADMIN_TEXTDOMAIN ),
			'toggle_class' => 'slider_option_toggle',
			'type' => 'toggle_start'
		),
		array(
			'name' => __( 'Transition Effects', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'With the Nivo slider there are a few transition effects that you can use.<br /><br />To use them all click on random.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'nivo_effect',
			'target' => 'nivo_effects',
			'toggle_class' => 'homepage_slider_nivo_slider',
			'type' => 'select',
		),
		array(
			'name' => __( 'Segments', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input a number for how many segments (slices) you want the transitions to use.<br /><br />It would be best to stick between 5 - 15 for best results.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'nivo_slices',
			'toggle_class' => 'homepage_slider_nivo_slider',
			'type' => 'text'
		),
		array(
			'name' => __( 'Animation Speed', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input a number to use for the animation speed.  This is the speed at which the transitions play.<br /><br />This number is in milliseconds so common values would be 1000 - 5000.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'nivo_anim_speed',
			'toggle_class' => 'homepage_slider_nivo_slider',
			'type' => 'text'
		),
		array(
			'name' => __( 'Static Slider Content', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( '', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'static_slider_content',
			'options' => array( 
				'none' => __( 'None', MYSITE_ADMIN_TEXTDOMAIN ),
				'content_left' => __( 'Float Left', MYSITE_ADMIN_TEXTDOMAIN ),
				'content_right' => __( 'Float Right', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle' => 'toggle_true',
			'toggle_class' => 'homepage_slider_responsive_slider',
			'type' => 'select'
		),
		array(
			'name' => __( 'Static Slider Content Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( '', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'static_slider_content_text',
			'default' => '',
			'toggle_class' => 'homepage_slider_responsive_slider static_slider_content_content_left static_slider_content_content_right toggle_prime_homepage_slider toggle_sub_static_slider_content',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Transition Effects', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( '', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'responsive_effect',
			'options' => array( 
				'fade' => __( 'Fade', MYSITE_ADMIN_TEXTDOMAIN ),
				'slide' => __( 'Slide', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_responsive_slider',
			'type' => 'select',
		),
		array(
			'name' => __( 'Transition Direction', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( '', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'responsive_direction',
			'options' => array( 
				'horizontal' => __( 'Horizontal', MYSITE_ADMIN_TEXTDOMAIN ),
				'vertical' => __( 'Vertical', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_responsive_slider',
			'type' => 'select',
		),
		array(
			'name' => __( 'Animation Speed', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input a number to use for the animation speed.  This is the speed at which the transitions play.<br /><br />This number is in milliseconds so common values would be 1000 - 5000.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'responsive_anim_speed',
			'toggle_class' => 'homepage_slider_responsive_slider',
			'type' => 'text'
		),
		array(
			'name' => __( 'Slider Transition Speed', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input a number to use for the transition speed.  This is the speed which determines how long an image is displayed before transitioning to the next.<br /><br />This number is in milliseconds so common values would be 1000 - 5000.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slider_speed',
			'type' => 'text'
		),
		array(
			'name' => __( 'Disable Slider Transitions', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This will stop automatic sliding which will leave it to the user to navigate through the images.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slider_disable_trans',
			'options' => array( 'true' => __( 'Disable Automatic Slider Transitions', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable Pause On Hover', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'By default the slider will stop sliding when you hover over it.<br /><br />Check to disable this.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slider_hover_pause',
			'options' => array( 'true' => __( 'Disable Pause On Hover', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'default' => '',
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable Navigation Arrows', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( '', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'responsive_direction_nav',
			'options' => array( 'true' => __( 'Disable Navigation Arrows', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'default' => '',
			'toggle_class' => 'homepage_slider_responsive_slider',
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable Navigation Dots', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( '', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'responsive_dots_nav',
			'options' => array( 'true' => __( 'Disable Navigation Dots', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'toggle_class' => 'homepage_slider_responsive_slider',
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Randomize Slide Order', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( '', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'responsive_randomize',
			'options' => array( 'true' => __( 'Randomize Slide Order', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'toggle_class' => 'homepage_slider_responsive_slider',
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Stop Slider Transitions', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( '', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'responsive_slider_transitions',
			'options' => array( 'true' => __( 'Stop Slider Transitions on Last Image', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'toggle_class' => 'homepage_slider_responsive_slider',
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Slider Fade Speed', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The speed of the fade animations.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slider_fade_speed',
			'options' => array( 
				'slow' => __( 'Slow', MYSITE_ADMIN_TEXTDOMAIN ),
				'fast' => __( 'Fast', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_fading_slider homepage_slider_scrolling_slider',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Slider Navigation Style', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between having dots or thumbnails for the slider navigation.<br /><br />If choosing thumbnails then they will be automatically generated and resized.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slider_nav',
			'options' => array( 
				'thumb' => __( 'Image Thumbnails', MYSITE_ADMIN_TEXTDOMAIN ),
				'dots' => __( 'Nav Dots', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_fading_slider homepage_slider_scrolling_slider',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Next &amp; Prev Buttons', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The Nivo slider comes with next and previous buttons which you can choose to disable, display on hover, or always show.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'nivo_direction_nav',
			'options' => array( 
				'button' => __( 'Always Display Next &amp; Previous Buttons', MYSITE_ADMIN_TEXTDOMAIN ),
				'button_hover' => __( 'Display Next &amp; Previous Buttons on Hover', MYSITE_ADMIN_TEXTDOMAIN ),
				'disable' => __( 'Disable Next &amp; Previous Buttons', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle_class' => 'homepage_slider_nivo_slider',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Display Nav Dots', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Checking this will display dots along the bottom where the user can navigate between images.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'nivo_control_nav',
			'options' => array( 'true' => __( 'Display Navigation Dots', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'toggle_class' => 'homepage_slider_nivo_slider',
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Display Slider on Every Page', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Checking this will enable the slider to display on every page.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slider_page',
			'options' => array( 'true' => __( 'Display Homepage Slider on all Pages', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Slider Source', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose whether to populate the slider here or from your post categories.<br /><br />If you choose from post categories then you can set the images when editing your posts.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slider_custom',
			'options' => array( 
				'custom' => __( 'Custom Define Slides Below', MYSITE_ADMIN_TEXTDOMAIN ),
				'categories' => __( 'Automatically Create Slides from Blog Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			),
			'toggle' => 'toggle_true',
			'type' => 'radio'
		),
		array(
			'name' => __( 'Number of Slides', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter the number of slider images to display (default is 5)', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slider_cat_count',
			'toggle_class' => 'slider_custom_categories',
			'type' => 'text'
		),
		
		array(
			'type' => 'toggle_end'
		),

		array(
			'name' => __( 'Slideshow', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slideshow',
			'toggle_class' => 'slider_custom_custom',
			'type' => 'slideshow'
		),
		array(
			'name' => __( 'Slider Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'slider_cats',
			'target' => 'cat',
			'toggle_class' => 'slider_custom_categories',
			'type' => 'multidropdown'
		),
		
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Blog
	 */
	array(
		'name' => array( 'mysite_blog_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Blog Page', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose one of your pages to use as a blog page.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_page',
			'target' => 'page',
			'type' => 'select'
		),
		array(
			'name' => __( 'Blog Layout', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Your blog posts will use the layout you select here.<br /><br />If you want an image to display in the layout then do not forget to set your featured image when editing your posts.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'blog_layout',
			'options' => array(
				'blog_layout1' => THEME_ADMIN_ASSETS_URI . '/images/blog_layout/blog_layout1.png',
				'blog_layout2' => THEME_ADMIN_ASSETS_URI . '/images/blog_layout/blog_layout2.png',
				'blog_layout3' => THEME_ADMIN_ASSETS_URI . '/images/blog_layout/blog_layout3.png'
			),
			'type' => 'layout'
		),
		array(
			'name' => __( 'Post Layout', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between a left, right, or no sidebar layout for your posts. This will be the default layout for all posts <br /><br />Note: You can override the layout on a post by post basis.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'post_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/1.png',
				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fourth_threefourth.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/threefourth_fourth.png',
			),
			'type' => 'layout'
		),
		array(
			'name' => __( 'Exclude Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose certain categories to exclude from your blog page.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'exclude_categories',
			'target' => 'cat',
			'type' => 'multidropdown'
		),
		array(
			'name' => __( 'Popular &amp; Related Posts', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'By default a popular / related posts module will display on your posts.  You can choose how to display it or disable it here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'post_like_module',
			'options' => array( 
				'tab' => __( 'Display in a Tabbed Layout', MYSITE_ADMIN_TEXTDOMAIN ),
				'column' => __( 'Display in a Column Layout', MYSITE_ADMIN_TEXTDOMAIN ),
				'disable' => __( 'Disable Popular &amp; Related Posts Module', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'type' => 'radio'
		),
		array(
			'name' => __( 'Comments &amp; Trackbacks', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose whether you want your comments and trackbacks bundled together or separated in tabs.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'post_comment_styles',
			'options' => array( 
				'tab' => __( 'Display in Separate Tabs', MYSITE_ADMIN_TEXTDOMAIN ),
				'list' => __( 'Display Together in a List', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'type' => 'radio'
		),
		array(
			'name' => __( 'Display Full Blog Posts', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'By default blog posts will be displayed as excerpts.<br /><br />Checking this will display the full content of your post.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'display_full',
			'options' => array( 'true' => __( 'Display Full Blog Posts on Blog Index Page', MYSITE_ADMIN_TEXTDOMAIN ) ), 
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable About Author', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'By default an about the author module will display when viewing your posts.<br /><br />You can choose to disable it here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'disable_post_author',
			'options' => array( 'true' => __( 'Disable the About Author Module', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable Post Nav', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'By default your posts will display links at the bottom to your other posts.<br /><br />Check this to disable those links.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'disable_post_nav',
			'options' => array( 'true' => __( 'Disable Post Navigation Module', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable Social Bookmarks', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'By default a social bookmarks module will display when viewing your posts.<br /><br />You can choose to disable it here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'social_bookmarks',
			'options' => array( 'true' => __( 'Disable the Social Bookmarks Module', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'URL shortening', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose to have certain links automatically use the bit.ly URL shortening service.<br /><br />For example the social icons on each post will use bit.ly URLs when this is checked.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'url_shortening',
			'options' => array( 'true' => __( 'Enable bit.ly URL Shortening', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'toggle' => 'toggle_true',
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'bit.ly Login', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the Username for your bit.ly account here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'bitly_login',
			'toggle_class' => 'url_shortening_true',
			'type' => 'text'
		),
		array(
			'name' => __( 'bit.ly API Key', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Input the API key for your bit.ly account here.<br /><br />You can find this by logging in at bit.ly and navigating to your settings page.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'bitly_api',
			'toggle_class' => 'url_shortening_true',
			'type' => 'text'
		),
		array(
			'name' => __( 'Disable Meta Options', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The post meta will display under the title on your blog page.<br /><br />You can choose sections to disable here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'disable_meta_options',
			'options' => array(
				'author_meta' => 'Disable Author Meta',
				'date_meta' => 'Disable Date Meta',
				'comments_meta' => 'Disable Comments Meta',
				'categories_meta' => 'Disable Categories Meta',
				'tags_meta' => 'Disable Tags Meta'
			),
			'type' => 'checkbox'
		),
	
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Sidebar
	 */
	array(
		'name' => array( 'mysite_sidebar_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Create New Sidebar', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can create additional sidebars to use.<br /><br />To display your new sidebar then you will need to select it in the &quot;Custom Sidebar&quot; dropdown when editing a post or page.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'custom_sidebars',
			'type' => 'sidebar'
		),
	
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Footer
	 */
	array(
		'name' => array( 'mysite_footer_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Footer Column layout', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select which column layout you would like to display with your footer.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'footer_columns',
			'options' => array(
				'1' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/1.png',
				'2' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/2.png',
				'3' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/3.png',
				'4' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/4.png',
				'5' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/5.png',
				'6' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/6.png',
				
				'third_twothird' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/third_twothird.png',
				'fourth_threefourth' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fourth_threefourth.png',
				'fourth_fourth_half' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fourth_fourth_half.png',
				'sixth_fivesixth' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/sixth_fivesixth.png',
				'third_sixth_sixth_sixth_sixth' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/third_sixth_sixth_sixth_sixth.png',
				'half_sixth_sixth_sixth' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/half_sixth_sixth_sixth.png',
				
				'twothird_third' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/twothird_third.png',
				'threefourth_fourth' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/threefourth_fourth.png',
				'half_fourth_fourth' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/half_fourth_fourth.png',
				'fivesixth_sixth' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fivesixth_sixth.png',
				'sixth_sixth_sixth_sixth_third' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/sixth_sixth_sixth_sixth_third.png',
				'sixth_sixth_sixth_half' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/sixth_sixth_sixth_half.png'
			),
			'type' => 'layout'
		),
		array(
			'name' => __( 'Disable Footer Widgets', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this if you do not wish to display any widgets with your footer.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'footer_disable',
			'options' => array( 'true' => __( 'Disable All Footer Widgets', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Footer Outro Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This text will display just above your footer.<br /><br />By default it will display on all pages.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'footer_teaser',
			'default' => '',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Copyright Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can display copyright information here.  It will show below your footer on the left hand side.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'footer_text',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
	
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Sociable
	 */
	array(
		'name' => array( 'mysite_sociable_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Sociable', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Sociable Generator', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'sociable',
			'type' => 'sociable'
		),
		
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * SEO
	 */
	array(
		'name' => array( 'mysite_seo_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Home Title', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This will be the title of your homepage. If not set, the default blog title will get used.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_home_title',
			'rows' => 2,
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Home Description', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The META description for your homepage. The default is no META description if this is not set.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_home_description',
			'rows' => 2,
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Home Keywords (comma separated)', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'A comma separated list of your most important keywords for your site that will be written as META keywords on your homepage.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_home_keywords',
			'rows' => 2,
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Canonical URLs', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This option will automatically generate Canonical URLS for your entire WordPress installation. This will help to prevent duplicate content penalties by Google.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_can',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Post Title Format', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The following macros are supported:<ul><li>%blog_title% - Your blog title</li><li>%blog_description% - Your blog description</li><li>%post_title% - The original title of the post</li><li>%category_title% - The (main) category of the post</li><li>%category% - Alias for %category_title%</li><li>%post_author_login% - This post\'s author\' login</li><li>%post_author_nicename% - This post\'s author\' nicename</li><li>%post_author_firstname% - This post\'s author\' first name (capitalized)</li><li>%post_author_lastname% - This post\'s author\' last name (capitalized)</li></ul>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_post_title_format',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'Page Title Format', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The following macros are supported:<ul><li>%blog_title% - Your blog title</li><li>%blog_description% - Your blog description</li><li>%page_title% - The original title of the page</li><li>%page_author_login% - This page\'s author\' login</li><li>%page_author_nicename% - This page\'s author\' nicename</li><li>%page_author_firstname% - This page\'s author\' first name (capitalized)</li><li>%page_author_lastname% - This page\'s author\' last name (capitalized)</li></ul>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_page_title_format',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'Category Title Format', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The following macros are supported:<ul><li>%blog_title% - Your blog title</li><li>%blog_description% - Your blog description</li><li>%category_title% - The original title of the category</li><li>%category_description% - The description of the category</li></ul>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_category_title_format',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'Archive Title Format', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The following macros are supported:<ul><li>%blog_title% - Your blog title</li><li>%blog_description% - Your blog description</li><li>%date% - The original archive title given by wordpress, e.g. "2007" or "2007 August"</li></ul>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_archive_title_format',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'Tag Title Format', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The following macros are supported:<ul><li>%blog_title% - Your blog title</li><li>%blog_description% - Your blog description</li><li>%tag% - The name of the tag</li></ul>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_tag_title_format',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'Search Title Format', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The following macros are supported:<ul><li>%blog_title% - Your blog title</li><li>%blog_description% - Your blog description</li><li>%search% - What was searched for</li></ul>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_search_title_format',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'Description Format', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The following macros are supported:<ul><li>%blog_title% - Your blog title</li><li>%blog_description% - Your blog description</li><li>%description% - The original description as determined by the theme, e.g. the excerpt if one is set or an auto-generated one if that option is set</li><li>%wp_title% - The original wordpress title, e.g. post_title for posts</li></ul>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_description_format',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( '404 Title Format', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The following macros are supported:<ul><li>%blog_title% - Your blog title</li><li>%blog_description% - Your blog description</li><li>%request_url% - The original URL path, like "/url-that-does-not-exist/"</li><li>%request_words% - The URL path in readable form, like "Url That Does Not Exist"</li><li>%404_title% - Additional 404 title input"</li></ul>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_404_title_format',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'Paged Format', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This string gets appended/prepended to titles when they are for paged index pages (like home or archive pages).The following macros are supported:<ul><li>%page% - The page number</li></ul>', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_paged_format',
			'default' => '',
			'htmlspecialchars' => true,
			'type' => 'text'
		),
		array(
			'name' => __( 'SEO for Custom Post Types', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this to enable SEO support for Custom Post Types on this site.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_enablecpost',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Enable SEO Support for Custom Post Types', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which post types you want to have SEO support on the edit.php screen.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_posttypecolumns',
			'target' => 'post_types',
			'type' => 'multidropdown'
		),
		array(
			'name' => __( 'Use Categories for META keywords', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this if you want your categories for a given post used as the META keywords for this post (in addition to any keywords and tags you specify on the post edit page).', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_use_categories',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Use Tags for META keywords', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this if you want your tags for a given post used as the META keywords for this post (in addition to any keywords you specify on the post edit page).', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_use_tags_as_keywords',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Dynamically Generate Keywords for Posts Page', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this if you want the keywords on your blog index page to be dynamically generated from the keywords of the posts showing on that page. If unchecked, it will use the keywords set in the edit page screen for the posts page.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_dynamic_postspage_keywords',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Use noindex for Categories', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this for excluding category pages from being crawled. Useful for avoiding duplicate content.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_category_noindex',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Use noindex for Archives', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this for excluding archive pages from being crawled. Useful for avoiding duplicate content.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_archive_noindex',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Use noindex for Tag Archives', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this for excluding tag pages from being crawled. Useful for avoiding duplicate content.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_tags_noindex',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Autogenerate Descriptions', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this and your META descriptions will get autogenerated if there\'s no excerpt.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_generate_descriptions',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Capitalize Category Titles', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Check this and Category Titles will have the first letter of each word capitalized.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_cap_cats',
			'options' => array( 'true' => '' ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Exclude Pages', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter any comma separated pages here to be excluded by your themes SEO settings. This is helpful when using plugins which generate their own non-WordPress dynamic pages. <code>Ex: /forum/,/contact/</code> For instance, if you want to exclude the virtual pages generated by a forum plugin, all you have to do is give <code>forum</code> or <code>/forum</code> or <code>/forum/</code> or and any URL with the word "forum" in it, such as <code>http://mysite.com/forum</code> or <code>http://mysite.com/forum/someforumpage</code> will be excluded from your themes SEO settings.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_ex_pages',
			'rows' => 2,
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Additional Post Headers', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'What you enter here will be copied verbatim to your header on post pages. You can enter whatever additional headers you want here, even references to stylesheets.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_post_meta_tags',
			'rows' => 2,
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Additional Page Headers', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'What you enter here will be copied verbatim to your header on pages. You can enter whatever additional headers you want here, even references to stylesheets.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_page_meta_tags',
			'rows' => 2,
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Additional Home Headers', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'What you enter here will be copied verbatim to your header on the home page. You can enter whatever additional headers you want here, even references to stylesheets.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'seo_home_meta_tags',
			'rows' => 2,
			'type' => 'textarea'
		),
		
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Special Pages
	 */
	array(
		'name' => array( 'mysite_special_pages' => $option_tabs ),
		'type' => 'tab_start'
	),
		array(
			'name' => __( 'Archives', MYSITE_ADMIN_TEXTDOMAIN ),
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Archive Layout', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between a left, right, or no sidebar layout for your archive pages.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'archive_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/1.png',
				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fourth_threefourth.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/threefourth_fourth.png',
			),
			'type' => 'layout'
		),
		array(
			'name' => __( 'Archive Custom Sidebar', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Select the custom sidebar that you'd like to be displayed on your archive pages.<br /><br />Note:  You will need to first create a custom sidebar under the &quot;Sidebar&quot; tab in your theme's option panel before it will show up here.", MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'archive_custom_sidebar',
			'target' => 'custom_sidebars',
			'type' => 'select'
		),
		array(
			'name' => __( 'Archive Custom Background', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Here you can override your sites background image on your archive pages, you can also select to have your background image resize with your browser by checking the &quot;Full Screen Background&quot; option & to have it fade in by checking the &quot;Fade In Fullscreen Background&quot; option.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'archive_custom_background',
			'target' => 'background',
			'type' => 'custom_background'
		),

		array(
			'type' => 'toggle_end'
		),
		
		array(
			'name' => __( 'Search', MYSITE_ADMIN_TEXTDOMAIN ),
			'type' => 'toggle_start'
		),

		array(
			'name' => __( 'Search Layout', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between a left, right, or no sidebar layout for your search pages.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'search_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/1.png',
				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fourth_threefourth.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/threefourth_fourth.png',
			),
			'type' => 'layout'
		),
		array(
			'name' => __( 'Search Custom Sidebar', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Select the custom sidebar that you'd like to be displayed on your search pages.<br /><br />Note:  You will need to first create a custom sidebar under the &quot;Sidebar&quot; tab in your theme's option panel before it will show up here.", MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'search_custom_sidebar',
			'target' => 'custom_sidebars',
			'type' => 'select'
		),
		array(
			'name' => __( 'Search Custom Background', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Here you can override your sites background image on your search pages, you can also select to have your background image resize with your browser by checking the &quot;Full Screen Background&quot; option & to have it fade in by checking the &quot;Fade In Fullscreen Background&quot; option.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'search_custom_background',
			'target' => 'background',
			'type' => 'custom_background'
		),

		array(
			'type' => 'toggle_end'
		),
		
		array(
			'name' => __( '404', MYSITE_ADMIN_TEXTDOMAIN ),
			'type' => 'toggle_start'
		),

		array(
			'name' => __( '404 Layout', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between a left, right, or no sidebar layout for your 404 page.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'four_04_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/1.png',
				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fourth_threefourth.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/threefourth_fourth.png',
			),
			'type' => 'layout'
		),
		array(
			'name' => __( '404 Custom Sidebar', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Select the custom sidebar that you'd like to be displayed on your 404 page.<br /><br />Note:  You will need to first create a custom sidebar under the &quot;Sidebar&quot; tab in your theme's option panel before it will show up here.", MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'four_04_custom_sidebar',
			'target' => 'custom_sidebars',
			'type' => 'select'
		),
		array(
			'name' => __( '404 Custom Background', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Here you can override your sites background image on your 404 page, you can also select to have your background image resize with your browser by checking the &quot;Full Screen Background&quot; option & to have it fade in by checking the &quot;Fade In Fullscreen Background&quot; option.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'four_04_custom_background',
			'target' => 'background',
			'type' => 'custom_background'
		),

		array(
			'type' => 'toggle_end'
		),
		
	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Mobile
	 */
	array(
		'name' => array( 'mysite_mobile_tab' => $option_tabs ),
		'type' => 'tab_start'
	),

		array(
			'name' => __( 'Responsive Layout Options', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which devices if any you want your site to display a responsive version on.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'responsive_options',
			'options' => array( 
				'site' => __( 'Make my Site Responsive on all Devices', MYSITE_ADMIN_TEXTDOMAIN ),
				'mobile' => __( 'Make my Site Responsive for Mobile Devices', MYSITE_ADMIN_TEXTDOMAIN ),
				'disable' => __( 'Don\'t Make my Site Responsive', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'type' => 'radio'
		),

		array(
			'name' => __( 'Mobile Device Slider Options', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose what to display in the slider area of your website on mobile devices', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'mobile_slider',
			'options' => array( 
				'default_slider' => __( 'Convert my Default Slider to Responsive', MYSITE_ADMIN_TEXTDOMAIN ),
				'custom_content' => __( 'Load Custom Defined Content', MYSITE_ADMIN_TEXTDOMAIN ),
				'disable_slider' => __( 'Disable Slider for Mobile Devices', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle' => 'toggle_true',
			'type' => 'radio'
		),

		array(
			'name' => __( 'Custom Defined Mobile Device Slider Content', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Enter the content that you\'d like displayed in place of your slider on mobile devices.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'mobile_slider_custom',
			'toggle_class' => 'mobile_slider_custom_content',
			'type' => 'textarea'
		),

		array(
			'name' => __( 'Disable Shortcodes for Mobile Device', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'For further speed optimization on mobile devices you can optionally disable the following shortcodes/scripts when viewed on mobile devices only.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'mobile_disable_shortcodes',
			'options' => array(
				'galleria' => 'Disable Galleria Shortcode',
				'slider' => 'Disable Slider Shortcode',
				'tooltips' => 'Disable Tooltips Shortcode',
				'jcarousel' => 'Disable jCarousel Shortcode'
			),
			'type' => 'checkbox'
		),

		array(
			'name' => __( 'Mobile Custom CSS', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Add CSS that you would like displayed on mobile devices only.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'mobile_custom_css',
			'type' => 'textarea'
		),

		array(
			'name' => __( 'Mobile Custom JavaScript', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Add Javascript that you would like to add to mobile devices only. ', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'mobile_custom_js',
			'type' => 'textarea'
		),

		array(
			'name' => __( 'Custom Mobile User Agents', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Add additional comma separated custom mobile user agents.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'custom_user_agents',
			'type' => 'textarea'
		),

	array(
		'type' => 'tab_end'
	),
	
	/**
	 * Advanced
	 */
	array(
		'name' => array( 'mysite_advanced_tab' => $option_tabs ),
		'type' => 'tab_start'
	),
	
		array(
			'name' => __( 'Custom Admin Logo', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Upload an image to replace the default Mysitemyway logo.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'admin_logo_url',
			'type' => 'upload'
		),
		array(
			'name' => __( 'Import Options', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Copy your export code here to import your theme settings.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'import_options',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Export Options', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'When moving your site to a new Wordpress installation you can export your theme settings here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => 'export_options',
			'type' => 'export_options'
		),
		
	array(
		'type' => 'tab_end'
	),
	
);

return array(
	'load' => true,
	'name' => 'options',
	'options' => $options
);
	
?>