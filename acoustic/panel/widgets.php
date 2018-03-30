<?php
add_action('widgets_init', 'ci_load_widgets');

if( !function_exists('ci_load_widgets') ):
function ci_load_widgets()
{
	// The loading priority is depended on the $paths array.
	// For maximum flexibility, widgets are loaded in this order:
	// 1) Child theme specific widgets
	// 2) Child theme generic widgets
	// 3) Parent theme specific widgets
	// 4) Parent theme generic widgets
	
	$paths = array();
	if( is_child_theme() ) {
		$paths[] = get_stylesheet_directory().'/functions/widgets';
		$paths[] = get_stylesheet_directory().'/panel/widgets';
	}
	$paths[] = get_template_directory().'/functions/widgets';
	$paths[] = get_template_directory().'/panel/widgets';
	
	foreach($paths as $path)
	{
		if (is_readable($path) and $handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					$file_info = pathinfo($path.'/'.$file);
					if(empty($file_info['extension']))
						continue;
					if($file_info['extension']=='php')
						require_once($path.'/'.$file);
				}
			}
			closedir($handle);
		}
	}
}
endif;

//
// Dashboard RSS Widget
//
add_action('wp_dashboard_setup', 'ci_dashboard_add_widgets');
if( !function_exists('ci_dashboard_add_widgets') ):
function ci_dashboard_add_widgets()
{
	if( apply_filters('ci_show_dashboard_rss', true) && // Should not be shown if the filter evaluates to false
		!CI_WHITELABEL                               && // Should not be shown if the theme is white-labeled
		//ci_setting('ci_show_dashboard_rss') != 'off' && // Should not be shown if not enabled by the Panel
		current_user_can('manage_options')              // Should not be shown to non-admin users
	) {
		wp_add_dashboard_widget('ci_dashboard_widget_igniter_news', __('CSSIgniter News', 'ci_theme'), 'ci_dashboard_widget_igniter_news');
	}
}
endif;

if( !function_exists('ci_dashboard_widget_igniter_news') ):
function ci_dashboard_widget_igniter_news()
{
	$feeds = array(
		'news' => array(
			'link'         => '//www.cssigniter.com/ignite/blog/',
			'url'          => 'https://www.cssigniter.com/ignite/blog/feed/',
			'title'        => __('CSSIgniter Blog', 'ci_theme'),
			'items'        => 3,
			'show_summary' => 1,
			'show_author'  => 0,
			'show_date'    => 1,
		)
	);

	// This is cached for 12 hours by default.
	// See the 'wp_feed_cache_transient_lifetime' filter if you need to change it.
	wp_dashboard_primary_output( 'ci_dashboard_widget_igniter_news', $feeds );
}
endif;
?>