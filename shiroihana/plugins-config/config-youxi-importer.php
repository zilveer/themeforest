<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

if( ! function_exists( 'shiroi_youxi_importer_demos' ) ):

function shiroi_youxi_importer_demos( $demos ) {

	return array_merge( $demos, array(
		'default' => array(
			'screenshot' => get_template_directory_uri() . '/screenshot.png', 
			'name' => __( 'Default', 'shiroi' ), 
			'content' => array(
				'wp' => array(
					'xml' => get_template_directory() . '/demo/shiroihana.wordpress.2015-05-11.xml', 
					'attachments_baseurl' => 'http://pub.youxithemes.com/placeholders/shiroi-hana', 
					'attachments_dir' => get_template_directory() . '/demo/attachments'
				), 
				'widgets' => '{"default-sidebar":{"text-2":{"title":"About Me","text":"<img src=\"http:\/\/placehold.it\/640x427\/f0f0f0\" alt=\"me\">\r\n\r\nThis man is a knight in shining armor. I\'m generally confused most of the time. Only you could make those words cute.","filter":true},"instagram-widget-2":{"title":"Instagram Feed","username":"kinfolk","count":12},"social-widget-2":{"title":"Follow Me","items":[{"url":"#","title":"#","icon":"facebook"},{"url":"#","title":"#","icon":"twitter"},{"url":"#","title":"#","icon":"instagram"},{"url":"#","title":"#","icon":"youtube"},{"url":"#","title":"#","icon":"vimeo"},{"url":"#","title":"#","icon":"pinterest"},{"url":"#","title":"#","icon":"dribbble"},{"url":"#","title":"#","icon":"flickr"}]},"text-3":{"title":"Advertisement","text":"<a href=\"http:\/\/www.themeforest.net?ref=nagaemas\"><img src=\"http:\/\/placehold.it\/290x210\/f0f0f0\"><\/a>","filter":false},"twitter-widget-2":{"title":"Latest Tweets","username":"envato","count":2},"tag_cloud-2":{"title":"Browse Tags","taxonomy":"post_tag"},"posts-widget-2":{"title":"Latest in Fashion","posts_per_page":3,"category__not_in":{"1":"8","2":"46","3":"13","4":"32","5":"27","6":"17","7":"23"},"tag__not_in":[],"order":"DESC","orderby":"date"}},"footer_widget_area_1":{"text-4":{"title":"Shiroi Hana","text":"Shiroi Hana &ndash; \u767d\u3044\u82b1, &ldquo;White Flowers&rdquo; is a typography focused WordPress blogging theme perfect for daily or hobby bloggers.\r\n\r\nWith three different post layouts and support for WordPress post formats, you can get your blog up and running in minutes.","filter":true}},"footer_widget_area_2":{"flickr-widget-2":{"title":"Flickr Feed","flickr_id":"52617155@N08","limit":12}},"footer_widget_area_3":{"categories-2":{"title":"Browse Categories","count":1,"hierarchical":0,"dropdown":0}},"footer_widget_area_4":{"posts-widget-3":{"title":"Random Posts","posts_per_page":2,"category__not_in":[],"tag__not_in":[],"meta_display":"category","order":"DESC","orderby":"rand"}}}', 
				'nav_menu_locations' => array(
					'primary-menu' => 'main-menu', 
					'secondary-menu' => 'secondary-menu'
				)
			)
		)
	));
}
endif;
add_filter( 'youxi_importer_demos', 'shiroi_youxi_importer_demos' );

if( ! function_exists( 'shiroi_youxi_importer_tasks' ) ):

function shiroi_youxi_importer_tasks( $tasks ) {
	unset( $tasks['theme-options'], $tasks['customizer-options'], $tasks['frontpage_displays'] );
	return $tasks;
}
endif;
add_filter( 'youxi_importer_tasks', 'shiroi_youxi_importer_tasks' );
