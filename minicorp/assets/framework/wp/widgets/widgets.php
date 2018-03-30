<?php

/* *********************************************************************************************************************
 *	Load Widgets
 */

require_once( locate_template( 'assets/framework/wp/widgets/twitter-widget.php' ) );
require_once( locate_template( 'assets/framework/wp/widgets/flickr-widget.php' ) );
require_once( locate_template( 'assets/framework/wp/widgets/dribbble-widget.php' ) );
require_once( locate_template( 'assets/framework/wp/widgets/categories-widget.php' ) );
require_once( locate_template( 'assets/framework/wp/widgets/social-widget.php' ) );
require_once( locate_template( 'assets/framework/wp/widgets/recent-posts.php' ) );

if ( ! function_exists( 'ishyoboy_widget_form_extend' ) ) {
	function ishyoboy_widget_form_extend( $instance, $widget ) {
		if ( !isset($instance['widget_width']) )
			$instance['widget_width'] = '3';

		$row = "<p>\n";
		$row .= "\t<label for='widget-{$widget->id_base}-{$widget->number}-widget_width'>" . __('Widget width:', 'ishyoboy') . "</label>\n";
		$row .= "\t<select name='widget-{$widget->id_base}[{$widget->number}][widget_width]' id='widget-{$widget->id_base}-{$widget->number}-widget_width' class='widefat'>";
		$row .= "\t<option value='3' " . selected( $instance['widget_width'], '3', false) . ">One fourth</option>\n";
		$row .= "\t<option value='4' " . selected( $instance['widget_width'], '4', false) . ">One third</option>\n";
		$row .= "\t<option value='6' " . selected( $instance['widget_width'], '6', false) . ">One half</option>\n";
		$row .= "\t<option value='12' " . selected( $instance['widget_width'], '12', false) . ">One full</option>\n";
		$row .= "\t<option value='8' " . selected( $instance['widget_width'], '8', false) . ">Two thirds</option>\n";
		$row .= "\t<option value='9' " . selected( $instance['widget_width'], '9', false) . ">Three fourths</option>\n";
		$row .= "\t</select>\n";
		$row .= "</p>\n";

		echo $row;
		return $instance;
	}
}
add_filter('widget_form_callback', 'ishyoboy_widget_form_extend', 10, 2);


function ishyoboy_widget_update( $instance, $new_instance, $old_instance ) {
    $instance['widget_width'] = $new_instance['widget_width'];
    return $instance;
}

add_filter( 'widget_update_callback', 'ishyoboy_widget_update', 10, 3 );