<?php

$meta_boxes = array(
	'title' => sprintf( __( '%1$s General Post Options', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ),
	'id' => 'mysite_post_meta_box',
	'pages' => array( 'post' ),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __( 'Layout', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can choose between a left, right, or no sidebar layout for your post.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_layout',
			'options' => array(
				'full_width' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/1.png',
				'left_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/fourth_threefourth.png',
				'right_sidebar' => THEME_ADMIN_ASSETS_URI . '/images/footer_column/threefourth_fourth.png',
			),
			'type' => 'layout'
		),
		array(
			'name' => __( 'Custom Background', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Here you can override your sites background image, you can also select to have your background image resize with your browser by checking the &quot;Full Screen Background&quot; option & to have it fade in by checking the &quot;Fade In Fullscreen Background&quot; option.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_custom_background',
			'target' => 'background',
			'type' => 'custom_background'
		),
		array(
			'name' => __( 'Custom Sidebar', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Select the custom sidebar that you'd like to be displayed on this page.<br /><br />Note:  You will need to first create a custom sidebar under the &quot;Sidebar&quot; tab in your theme's option panel before it will show up here.", MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_custom_sidebar',
			'target' => 'custom_sidebars',
			'type' => 'select'
		),
		array(
			'name' => __( 'Featured Video', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'You can paste a URL of a video here to display within your post.<br /><br />Examples on how to format the links.<br /><br />YouTube:<br /><br />http://www.youtube.com/watch?v=fxs970FMYIo<br /><br />Vimeo:<br /><br />http://vimeo.com/8736190', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_featured_video',
			'type' => 'text'
		),
		array(
			'name' => __( 'Disable Featured Image', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Check this box if you'd like to disable the featured post image from appearing on the single post, by checking this box the featured post image you have defined will only show on the blog index page and the designated widgets.", MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_disable_post_image',
			'options' => array( 'true' => __( 'Check to disable the featured image on this post', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable Breadcrumbs', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( "Here you can disable breadcrumbs on a page by page basis.  Alternatively you can globally disable breadcrumbs under the &quot;General Settings&quot; tab in your theme's option panel.", MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_disable_breadcrumbs',
			'options' => array( 'true' => __( 'Check to disable breadcrumbs on this post', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Disable Social Bookmarks', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( "By default a social bookmarks module will display when viewing your posts.<br /><br />You can choose to disable it here.", MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_disable_social_bookmarks',
			'options' => array( 'true' => __( 'Disable the Social Bookmarks Module', MYSITE_ADMIN_TEXTDOMAIN ) ),
			'type' => 'checkbox'
		),
		array(
			'name' => __( 'Intro Options', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( "This is the text that displays at the beginning of your pages and posts.<br /><br />Note:  You can set the default behaviour in the &quot;General Settings&quot; tab in your theme's option panel.", MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_intro_text',
			'options' => array( 
				'default' => sprintf( __( 'Default Intro <small><a targe href="%1$s/wp-admin/admin.php?page=mysite-options" target="_blank">(click here to edit your default intro settings)</a></small>', MYSITE_ADMIN_TEXTDOMAIN ), esc_url( get_option('siteurl') ) ),
				'title_only' => __( 'Title Only', MYSITE_ADMIN_TEXTDOMAIN ),
				'title_teaser' => __( 'Title & Teaser Text', MYSITE_ADMIN_TEXTDOMAIN ),
				'title_tweet' => __( 'Title & Latest Tweet', MYSITE_ADMIN_TEXTDOMAIN ),
				'custom' => __( 'Custom Raw Html', MYSITE_ADMIN_TEXTDOMAIN ),
				'banner' => __( 'Image Banner', MYSITE_ADMIN_TEXTDOMAIN ),
				'disable' => __( 'Completely Disable Intro', MYSITE_ADMIN_TEXTDOMAIN )
			),
			'toggle' => 'toggle_true',
			'type' => 'radio',
			'default' => 'default'
		),
		array(
			'name' => __( 'Teaser Text', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'The teaser text is the text that displays beside your title in your intro.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_intro_custom_text',
			'toggle_class' => '_intro_text_title_teaser',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Custom Raw Html', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'In case you have some custom HTML you wish to display in the intro then you may insert it here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_intro_custom_html',
			'toggle_class' => '_intro_text_custom',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Image Banner', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Use this option to place a image banner in your intro area. You can also display the title and enable automatic image resizing.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_intro_custom_banner',
			'toggle_class' => '_intro_text_banner',
			'type' => 'image_banner'
		),
		array(
			'name' => __( 'Custom CSS', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'This is a great place for doing quick custom styles.  For example if you wanted to change the site title color then you would paste this:<br /><br /><code>.logo a { color: blue; }</code><br /><br />If you are having problems styling something then ask on the support forum and we will be with you shortly.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_custom_css',
			'type' => 'textarea'
		),
		array(
			'name' => __( 'Custom JavaScript', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'In case you need to add some custom javascript you may insert it here.', MYSITE_ADMIN_TEXTDOMAIN ),
			'id' => '_custom_js',
			'type' => 'textarea'
		),
	)
);
return array(
	'load' => true,
	'options' => $meta_boxes
);

?>