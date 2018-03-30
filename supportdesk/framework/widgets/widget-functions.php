<?php

// Allow Shortcodes in widgets
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

// Add Custom Blog Widget
require("widget-blog.php");

// Add Custom KB Articles Widget
require("widget-kb-articles.php");

// Add Custom KB Cateogires Widget
require("widget-kb-categories.php");
 
/**
 * Modify Exsisting Widgets
 */ 
 function st_custom_tag_cloud_widget($args) {
	$args['largest'] = 13; //largest tag
	$args['smallest'] = 8; //smallest tag
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'st_custom_tag_cloud_widget' );

add_filter('wp_list_categories', 'add_span_cat_count');
function add_span_cat_count($links) {
$links = str_replace('</a> (', '</a> <span>', $links);
$links = str_replace(')', '</span>', $links);
return $links;
}



// Add class input to all widgets
function st_widget_form_extend( $instance, $widget ) {
	if ( !isset($instance['classes']) )
		$instance['classes'] = null;

	$row = "<p>\n";
	$row .= "\t<label for='widget-{$widget->id_base}-{$widget->number}-classes'>Additional Classes <small>(separate with spaces)</small></label>\n";
	$row .= "\t<input type='text' name='widget-{$widget->id_base}[{$widget->number}][classes]' id='widget-{$widget->id_base}-{$widget->number}-classes' class='widefat' value='{$instance['classes']}'/>\n";
	$row .= "</p>\n";

	echo $row;
	return $instance;
}
add_filter('widget_form_callback', 'st_widget_form_extend', 10, 2);

function st_widget_update( $instance, $new_instance ) {
	$instance['classes'] = $new_instance['classes'];
	return $instance;
}
add_filter( 'widget_update_callback', 'st_widget_update', 10, 2 );

function st_dynamic_sidebar_params( $params ) {
	global $wp_registered_widgets;
	$widget_id	= $params[0]['widget_id'];
	$widget_obj	= $wp_registered_widgets[$widget_id];
	$widget_opt	= get_option($widget_obj['callback'][0]->option_name);
	$widget_num	= $widget_obj['params'][0]['number'];

	if ( isset($widget_opt[$widget_num]['classes']) && !empty($widget_opt[$widget_num]['classes']) )
		$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );

	return $params;
}
add_filter( 'dynamic_sidebar_params', 'st_dynamic_sidebar_params' );