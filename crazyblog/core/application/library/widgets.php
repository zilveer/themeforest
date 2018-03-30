<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Widgets {

	static protected $_widgets = array(
		'about',
		'post_tabber',
		'fancy_popular_posts',
		'social',
		'commented_posts',
		'about_with_newsletter',
		'about_author',
		'overlay_recent_posts',
		'simple_recent_posts',
		'recent_posts_carousel',
		'blog_authors',
		'blog_rules',
		'gallery',
		'newsletter',
		'media_box',
	);

	static public function register() {

		$widgets_ = array();

		foreach ( self::$_widgets as $widget ) {

			$widgets_[crazyblog_ROOT . 'core/application/library/widgets/' . strtolower( $widget ) . '.php'] = $widget;
		}



		$widgets_ = apply_filters( 'crazyblog_extend_widgets_', $widgets_ );

		foreach ( $widgets_ as $path => $register ) {

			require_once( $path );

			$widget_class = 'crazyblog_' . $register . '_Widget';

			register_widget( $widget_class );
		}
	}

}

// Widget Filter for child theme



/*add_filter('crazyblog_extend_widgets_', 'sh_test' );

function sh_test( $array )

{

	$path = array();

	$path[crazyblog_ROOT.'news.php'] = 'news';

	return array_merge( $array, $path );

}*/