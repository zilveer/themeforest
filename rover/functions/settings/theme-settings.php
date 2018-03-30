<?php 
/**
 *  @package by Theme Record
*/

$options = array(

	array('name' => __('Theme Settings', 'TR'), 'type' => 'tab_page_title'),

	array('type' => 'tabs_head'),

	//Tab Title
	array('type' => 'tab_title_head'),
	array('name' => __('General', 'TR'), 'slug' => 'general', 'class' => 'active', 'type' => 'tab'),
	array('name' => __('Header', 'TR'), 'slug' => 'header', 'type' => 'tab'),
	array('name' => __('Slideshow', 'TR'), 'slug' => 'slideshow', 'type' => 'tab'),
	array('name' => __('Portfolio', 'TR'), 'slug' => 'portfolio', 'type' => 'tab'),
	array('name' => __('Product', 'TR'), 'slug' => 'product', 'type' => 'tab'),
	array('name' => __('Blog', 'TR'), 'slug' => 'blog', 'type' => 'tab'),
	array('name' => __('Contact', 'TR'), 'slug' => 'contact', 'type' => 'tab'),
	array('name' => __('Footer', 'TR'), 'slug' => 'footer', 'type' => 'tab'),
	array('name' => __('Twitter OAuth', 'TR'), 'slug' => 'twitter-oauth', 'type' => 'tab'),
	array('type' => 'tab_title_foot'),


	//General
	array('slug' => 'general', 'type' => 'tab_content_head'),
	array(
			'name' => __('Favicon', 'TR'),
			'desc' => __('To upload an image click on "Upload favicon" button. Once the image is as custom favicon.', 'TR'),
			'id' => 'TR_favicon',
			'std' => '',
			'title' => 'Enter a URL or upload an image for your favicon:',
			'size' => '60',
			'button' => __('Upload Favicon', 'TR'),
			'type' => 'upload'
	),
	array(
			'name' => __('Enable Responsive', 'TR'),
			'desc' => __("If you check yes, you'll globally display the site by responsive.", 'TR'),
			'id' => 'enable_responsive',
			'std' => 'yes',
			'options' => array(
				'yes' => __('Yes', 'TR'),
				'no' => __('No', 'TR')
			),
			'type' => 'radio'
	),
	array(
			'name' => __('Pagination',  'TR'),
			'id' => 'pagination',
			'std' => 'style',
			'options' => array(
				'style' => 'Style pagination',
				'default' => 'Default pagination'
			),
			'type' => 'radio'
	),
	array(
			'name' => __('Breadcrumb',  'TR'),
			'desc' => __('Check it to display the breadcrumb.',  'TR'),
			'id' => 'enable_breadcrumb',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Update notifier',  'TR'),
			'desc' => __('Check it to display the update notifier.',  'TR'),
			'id' => 'enable_update_notifier',
			'std' => 0,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Enable Announcement', 'TR'),
			'desc' => __("If you check yes, you'll globally display the top announcement.", 'TR'),
			'id' => 'enable_announcement',
			'std' => 'yes',
			'options' => array(
				'yes' => __('Yes', 'TR'),
				'no' => __('No', 'TR')
			),
			'type' => 'radio'
	),
	array(
			'name' => __('Announcement', 'TR'),
			'id' => 'announcement',
			'std' => 'This is an announcement, click the Close button on the right and it will not show again until you restart your browser.',
			'rows' => '3',
			'type' => 'textarea'
	),
	array(
			'name' => __('Google Apis', 'TR'),
			'desc' => __("Add your google fonts api here. e.g: <span>&lt;link href='http://fonts.googleapis.com/css?family=Noticia+Text' rel='stylesheet' type='text/css'&gt;</span>", 'TR'),
			'id' => 'google_apis',
			'std' => '',
			'rows' => '3',
			'type' => 'textarea'
	),
	array(
			'name' => __('Custom CSS', 'TR'),
			'desc' => __("Add only the css code without <span> &lt;style&gt;&lt;/style&gt; </span> style blocks. They are auto added. it's easy to customize your site.", 'TR'),
			'id' => 'custom_css',
			'std' => '',
			'rows' => '3',
			'type' => 'textarea'
	),
	array(
			'name' => __('Google Analytics', 'TR'),
			'desc' => __('Paste your <a href="http://www.google.com/analytics/" target="_blank">analytics code</a> here, it will get applied to each page.', 'TR'),
			'id' => 'analytics',
			'std' => '',
			'rows' => '3',
			'class' => 'no',
			'type' => 'textarea'
	),
	array('type' => 'tab_content_foot'),




	//Header
	array('slug' => 'header', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Header Height', 'TR'),
			'id' => 'header_height',
			'std' => '136',
			'size' => '5',
			'unit' => 'pixel',
			'type' => 'text'
	),
	array('name' => 'Logo', 'type' => 'tab_sub_title'),
	array(
			'name' => __('Logo Image', 'TR'),
			'desc' => __('To upload an image click on "Upload Image" button. Once the image is uploaded it will give you various options.', 'TR'),
			'id' => 'TR_logo',
			'std' => ASSETS_URI.'/images/logo.png',
			'title' => 'Enter a URL or upload an image for your logo:',
			'size' => '60',
			'button' => __('Upload Logo', 'TR'),
			'type' => 'upload'
	),
	array(
			'name' => __('Enable Text Logo', 'TR'),
			'desc' => __("If you checked this, you'll globally display the logo with text.", 'TR'),
			'id' => 'enable_site_name',
			'std' => 0,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Enable Description', 'TR'),
			'desc' => __("If you checked this, you'll globally enable the site description.", 'TR'),
			'id' => 'enable_site_desc',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Description', 'TR'),
			'desc' => __('Enter the description for your site, if you leave it blank, we will get it from the <a href="'.home_url( '/' ).'wp-admin/options-general.php">general settings</a>.', 'TR'),
			'id' => 'site_desc',
			'std' => get_bloginfo( 'description' ),
			'rows' => '3',
			'type' => 'textarea'
	),
	array(
			'name' => __('From Top', 'TR'),
			'id' => 'logo_top',
			'std' => '40',
			'size' => '5',
			'unit' => 'pixel',
			'class' => 'no',
			'type' => 'text'
	),

	array('name' => 'Menu', 'type' => 'tab_sub_title'),
	array(
			'name' => __('Depth', 'TR'),
			'desc' => __('Set it to "0", the menu level will be unlimited.', 'TR'),
			'id' => 'menu_depth',
			'std' => '3',
			'size' => '5',
			'unit' => 'level',
			'type' => 'text'
	),
	array(
			'name' => __('Sub Menu Width', 'TR'),
			'id' => 'sub_menu_width',
			'std' => '160',
			'size' => '5',
			'unit' => 'pixel',
			'class' => 'no',
			'type' => 'text'
	),

	array('name' => 'Page Header', 'type' => 'tab_sub_title'),
	array(
			'name' => __('From Top', 'TR'),
			'id' => 'page_header_top',
			'std' => '25',
			'size' => '5',
			'unit' => 'pixel',
			'type' => 'text'
	),
	array(
			'name' => __('From Bottom', 'TR'),
			'id' => 'page_header_bottom',
			'std' => '30',
			'size' => '5',
			'unit' => 'pixel',
			'class' => 'no',
			'type' => 'text'
	),
	array('type' => 'tab_content_foot'),


	//Slideshow
	array('slug' => 'slideshow', 'class' => 'hide', 'type' => 'tab_content_head'),

	array('name' => 'Revolution Sliders', 'class' => 'no', 'type' => 'tab_sub_title'),

	array(
			'name' => __('Sliders Shortcode',  'TR'),
			'desc' => __('Enter the revolution sliders shortcode here, you should create it from <a href="'.home_url( '/' ).'wp-admin/admin.php?page=revslider">Revolution Sliders</a>. Ex: [rev_slider homepage]', 'TR'),
			'id' => 'rs_shortcode',
			'std' => '',
			'rows' => '3',
			'class' => 'no',
			'type' => 'textarea'
	),

	array('name' => 'Flexslider', 'type' => 'tab_sub_title'),
	array(
			'name' => __('Enable Slideshow','TR'),
			'desc' => __('Enable or disable the slideshow for home page.','TR'),
			'id' => 'enable_slideshow',
			'std' => 'yes',
			'options' => array(
				'yes' => __('Yes','TR'),
				'no' => __('No','TR')
			),
			'type' => 'radio'
	),
	array(
			'name' => __('Speed','TR'),
			'desc' => __('Select the number for the slider speed. The unit is millisecond.','TR'),
			'id' => 'slideshow_speed',
			'std' => '5000',
			'size' => '10',
			'unit' => 'millisecond',
			'type' => 'text'
	),
	array(
			'name' => __('Duration','TR'),
			'desc' => __('Select the number for the slider duration. The unit is millisecond.','TR'),
			'id' => 'slideshow_duration',
			'std' => '1000',
			'size' => '10',
			'unit' => 'millisecond',
			'type' => 'text'
	),
	array(
			'name' => __('Animation','TR'),
			'desc' => __('Set animation, slide or fade for next/prev.','TR'),
			'id' => 'slideshow_animation',
			'std' => 'fade',
			'options' => array(
				'fade' => __('Fade','TR'),
				'slide' => __('Slide','TR')
			),
			'type' => 'radio'
	),
	array(
			'name' => __('Auto Show', 'TR'),
			'desc' => __('Auto show the slide.', 'TR'),
			'id' => 'enable_slideshow_auto',
			'std' => 'true',
			'options' => array(
				'true' => __('Yes','TR'),
				'false' => __('No','TR')
			),
			'type' => 'radio'
	),
	array(
			'name' => __('DirectionNav', 'TR'),
			'desc' => __('Display with the directionNav.', 'TR'),
			'id' => 'enable_slideshow_directionnav',
			'std' => 'true',
			'options' => array(
				'true' => __('Yes','TR'),
				'false' => __('No','TR')
			),
			'type' => 'radio'
	),
	array(
			'name' => __('ControlNav', 'TR'),
			'desc' => __('Display with the controlNav.', 'TR'),
			'id' => 'enable_slideshow_controlnav',
			'std' => 'true',
			'options' => array(
				'true' => __('Yes','TR'),
				'false' => __('No','TR')
			),
			'type' => 'radio'
	),
	array(
			'name' => __('PausePlay', 'TR'),
			'desc' => __('Display with the pausePlay.', 'TR'),
			'id' => 'enable_slideshow_pauseplay',
			'std' => 'true',
			'options' => array(
				'true' => __('Yes','TR'),
				'false' => __('No','TR')
			),
			'class' => 'no',
			'type' => 'radio'
	),
	array('type' => 'tab_content_foot'),


	//Portfolio
	array('slug' => 'portfolio', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Display Mode',  'TR'),
			'desc' => __('Set the display mode for your portfolio.',  'TR'),
			'id' => 'portfolio_display_mode',
			'std' => '1',
			'options' => array(
				'1' => '[ Classic sortable ]',
				'2' => '[ Classic sortable ] + [ Filter ]',
				'3' => '[ jQuery sortable ] + [ Filter ]'
			),
			'type' => 'radio'
	),
	array(
			'name' => __('Columns', 'TR'),
			'desc' => __('Choose a column for your portfolio list.', 'TR'),
			'id' => 'portfolio_column',
			'std' => '3',
			'options' => array(
				'2' => FUNCTIONS_URI.'/assets/images/layout/col-2-1.png',
				'3' => FUNCTIONS_URI.'/assets/images/layout/col-3-1.png',
				'4' => FUNCTIONS_URI.'/assets/images/layout/col-4-1.png'
			),
			'type' => 'img_select'
	),
	array(
			'name' => __('Posts Per Page', 'TR'),
			'desc' => __('Set how many items do you want to display in portfolio page.', 'TR'),
			'id' => 'portfolio_posts_per_page',
			'std' => '16',
			'size' => '5',
			'unit' => 'items',
			'type' => 'text'
	),
	array(
			'name' => __('Show title', 'TR'),
			'desc' => __("If you checked this, you'll globally display title.", 'TR'),
			'id' => 'enable_portfolio_title',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Show skills', 'TR'),
			'desc' => __("If you checked this, you'll globally display skills.", 'TR'),
			'id' => 'enable_portfolio_skills',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Enable Comments', 'TR'),
			'desc' => __("If you checked this, you'll globally enable the Comments.", 'TR'),
			'id' => 'enable_portfolio_comments',
			'std' => 0,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Enable Related Posts', 'TR'),
			'desc' => __("If you checked this, you'll globally enable the Related Posts.", 'TR'),
			'id' => 'enable_portfolio_related_posts',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Posts Per Page','TR'),
			'desc' => __('Set how many items do you want to display in related posts.','TR'),
			'id' => 'portfolio_related_posts_per_page',
			'std' => '8',
			'size' => '5',
			'unit' => 'items',
			'class' => 'no',
			'type' => 'text'
	),
	array('type' => 'tab_content_foot'),




	//Product
	array('slug' => 'product', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Posts Per Page', 'TR'),
			'desc' => __('Set how many items do you want to display in product page.', 'TR'),
			'id' => 'product_posts_per_page',
			'std' => '16',
			'size' => '5',
			'unit' => 'items',
			'type' => 'text'
	),
	array(
			'name' => __('Enable Comments', 'TR'),
			'desc' => __("If you checked this, you'll globally enable the Comments.", 'TR'),
			'id' => 'enable_product_comments',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Enable Related Posts', 'TR'),
			'desc' => __("If you checked this, you'll globally enable the Related Posts.", 'TR'),
			'id' => 'enable_product_related_posts',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Posts Per Page','TR'),
			'desc' => __('Set how many items do you want to display in related posts.','TR'),
			'id' => 'product_related_posts_per_page',
			'std' => '8',
			'size' => '5',
			'unit' => 'items',
			'class' => 'no',
			'type' => 'text'
	),
	array('type' => 'tab_content_foot'),




	//Blog
	array('slug' => 'blog', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Posts Per Page', 'TR'),
			'desc' => __('Set how many items do you want to display in blog page.', 'TR'),
			'id' => 'blog_posts_per_page',
			'std' => '10',
			'size' => '5',
			'unit' => 'items',
			'type' => 'text'
	),
	array(
			'name' => __('Enable Date', 'TR'),
			'desc' => __("If you checked this, you'll globally enable the date.", 'TR'),
			'id' => 'enable_blog_date',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Enable Categories', 'TR'),
			'desc' => __("If you checked this, you'll globally enable the categories.", 'TR'),
			'id' => 'enable_blog_categories',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Enable Author', 'TR'),
			'desc' => __("If you checked this, you'll globally enable the author.", 'TR'),
			'id' => 'enable_blog_author',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Enable Comments', 'TR'),
			'desc' => __("If you checked this, you'll globally enable the comments.", 'TR'),
			'id' => 'enable_blog_comments',
			'std' => 1,
			'class' => 'no',
			'type' => 'checkbox'
	),
	array('type' => 'tab_content_foot'),



	//Contact
	array('slug' => 'contact', 'class' => 'hide', 'type' => 'tab_content_head'),
	array(
			'name' => __('Contact Email', 'TR'),
			'desc' => __('Enter your email for the contact form.', 'TR'),
			'id' => 'contact_email',
			'std' => get_option('admin_email'),
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Google Map',  'TR'),
			'desc' => __('Enable the google map for the contact page.',  'TR'),
			'id' => 'enable_google_map',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Map Address', 'TR'),
			'id' => 'map_address',
			'std' => 'Athens, Greece',
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Map Zoom', 'TR'),
			'id' => 'map_zoom',
			'std' => '8',
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Map Height', 'TR'),
			'id' => 'map_height',
			'std' => '500',
			'size' => '60',
			'unit' => 'pixel',
			'type' => 'text',
	),
	array(
			'name' => __('Recaptcha',  'TR'),
			'desc' => __('Enable the recaptcha for the contact page.',  'TR'),
			'id' => 'enable_recaptcha',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Recaptcha Publickey', 'TR'),
			'desc' => __('Your reCAPTCHA public key, from the <a href="https://www.google.com/recaptcha/admin/create?app=php" target="_blank">API Signup Page</a>.', 'TR'),
			'id' => 'recaptcha_publickey',
			'std' => '',
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Recaptcha Privatekey', 'TR'),
			'desc' => __('Your reCAPTCHA private key, from the <a href="https://www.google.com/recaptcha/admin/create?app=php" target="_blank">API Signup Page</a>.', 'TR'),
			'id' => 'recaptcha_privatekey',
			'std' => '',
			'class' => 'no',
			'size' => '60',
			'type' => 'text',
	),
	array('type' => 'tab_content_foot'),



	//Footer
	array('slug' => 'footer', 'class' => 'hide', 'type' => 'tab_content_head'),
	array('name' => 'General', 'class' => 'no', 'type' => 'tab_sub_title'),
	array(
			'name' => __('Footer Widgets',  'TR'),
			'desc' => __('Display footer widgets in the bottom of site.',  'TR'),
			'id' => 'enable_footer_widgets',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Widgets Columns', 'TR'),
			'desc' => __('Choose a column for your footer widgets area.', 'TR'),
			'id' => 'footer_widgets_column',
			'std' => '3',
			'options' => array(
				'1' => FUNCTIONS_URI.'/assets/images/layout/col-1-1.png',
				'2' => FUNCTIONS_URI.'/assets/images/layout/col-2-1.png',
				'3' => FUNCTIONS_URI.'/assets/images/layout/col-3-1.png',
				'4' => FUNCTIONS_URI.'/assets/images/layout/col-4-1.png'
			),
			'type' => 'img_select'
	),
	array(
			'name' => __('Copyright Text',  'TR'),
			'desc' => __('You can add your copyright message here.',  'TR'),
			'id' => 'copyright_message',
			'std' => 'Copyright &copy; 2012 <a href="'. home_url( '/' ) . '">' .esc_attr( get_bloginfo('name') ).'</a>, All rights reserved. Design by <a href="http://themeforest.net/user/MattMao/">MattMao</a>',
			'rows' => '5',
			'class' => 'no',
			'type' => 'textarea'
	),
	array('name' => 'Contact Info', 'type' => 'tab_sub_title'),
	array(
			'name' => __('Footer Contact Info',  'TR'),
			'desc' => __('Display contact info in the bottom of site.',  'TR'),
			'id' => 'enable_footer_contact_info',
			'std' => 1,
			'type' => 'checkbox'
	),
	array(
			'name' => __('Address', 'TR'),
			'desc' => __('Enter your address for the footer contact info.', 'TR'),
			'id' => 'footer_address',
			'std' => 'Level 13, 2 Elizabeth St, Melbourne Victoria 3000 Australia',
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Phone', 'TR'),
			'desc' => __('Enter your phone for the footer contact info.', 'TR'),
			'id' => 'footer_phone',
			'std' => '+61 038376 6284',
			'size' => '60',
			'type' => 'text',
	),
	array(
			'name' => __('Email', 'TR'),
			'desc' => __('Enter your email for the footer contact info.', 'TR'),
			'id' => 'footer_email',
			'std' => get_option('admin_email'),
			'size' => '60',
			'class' => 'no',
			'type' => 'text',
	),

	array('name' => 'Social Media', 'type' => 'tab_sub_title'),
	array(
			'name' => __('Twitter', 'TR'),
			'desc' => __('e.g: http://twitter.com/username', 'TR'),
			'id' => 'twitter',
			'std' => 'http://twitter.com/username',
			'size' => '60',
			'type' => 'text'
	),
	array(
			'name' => __('Facebook', 'TR'),
			'desc' => __('e.g: http://www.facebook.com/username', 'TR'),
			'id' => 'facebook',
			'std' => 'http://www.facebook.com/username',
			'size' => '60',
			'type' => 'text'
	),
	array(
			'name' => __('Dribbble', 'TR'),
			'desc' => __('e.g: http://dribbble.com/username', 'TR'),
			'id' => 'dribbble',
			'std' => 'http://dribbble.com/username',
			'size' => '60',
			'type' => 'text'
	),
	array(
			'name' => __('Flickr', 'TR'),
			'desc' => __('e.g: http://www.flickr.com/photos/username', 'TR'),
			'id' => 'flickr',
			'std' => 'http://www.flickr.com/photos/username',
			'size' => '60',
			'type' => 'text'
	),
	array(
			'name' => __('LinkedIn', 'TR'),
			'desc' => __('e.g: http://www.linkedin.com/in/username', 'TR'),
			'id' => 'linkedin',
			'std' => 'http://www.linkedin.com/in/username',
			'size' => '60',
			'type' => 'text'
	),
	array(
			'name' => __('Google+', 'TR'),
			'desc' => __('e.g: http://plus.google.com/userID', 'TR'),
			'id' => 'google',
			'std' => 'http://plus.google.com/userID',
			'size' => '60',
			'type' => 'text'
	),
	array(
			'name' => __('Vimeo', 'TR'),
			'desc' => __('e.g: http://vimeo.com/username', 'TR'),
			'id' => 'vimeo',
			'std' => 'http://vimeo.com/username',
			'size' => '60',
			'type' => 'text'
	),
	array(
			'name' => __('Picasa', 'TR'),
			'desc' => __('e.g: https://picasaweb.google.com/userID', 'TR'),
			'id' => 'picasa',
			'std' => 'https://picasaweb.google.com/userID',
			'size' => '60',
			'type' => 'text'
	),
	array(
			'name' => __('Feedburner', 'TR'),
			'desc' => __('Enter your feedburner url, if you do not want to display this, just leave it blank.', 'TR'),
			'id' => 'feed',
			'std' => get_bloginfo('rss2_url'),
			'size' => '60',
			'class' => 'no',
			'type' => 'text'
	),

	array('type' => 'tab_content_foot'),

	//Twitter OAuth
	array('slug' => 'twitter-oauth', 'class' => 'hide', 'type' => 'tab_content_head'),

	array(
			'name' => __('Consumer Key', 'TR'),
			'id' => 'twitter_consumer_key',
			'std' => '',
			'size' => '80',
			'type' => 'text'
	),

	array(
			'name' => __('Consumer Secret', 'TR'),
			'id' => 'twitter_consumer_secret',
			'std' => '',
			'size' => '80',
			'type' => 'text'
	),

	array(
			'name' => __('Access Token', 'TR'),
			'id' => 'twitter_access_token',
			'std' => '',
			'size' => '80',
			'type' => 'text'
	),

	array(
			'name' => __('Access Token Secret', 'TR'),
			'id' => 'twitter_access_token_secret',
			'std' => '',
			'size' => '80',
			'type' => 'text'
	),

	array('type' => 'tab_content_foot'),

	array('type' => 'tabs_foot')

);

return array('auto' => true, 'name' => 'settings', 'options' => $options );

?>