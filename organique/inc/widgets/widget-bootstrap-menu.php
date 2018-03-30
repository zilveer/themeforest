<?php
/**
 * Boostrap menu
 * =============
 * Extends the original WP Menu Widget
 *
 * @package Organique
 */


class WP_Boostrap_Nav_Menu_Widget extends WP_Nav_Menu_Widget {
	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		wp_nav_menu( array(
			'fallback_cb' => '',
			'menu' => $nav_menu,
			'menu_class' => 'nav nav-pills nav-stacked',
			'depth' => 3,
		) );

		echo $args['after_widget'];
	}
} // class WP_Boostrap_Nav_Menu_Widget
unregister_widget( 'WP_Nav_Menu_Widget' ); // unregister default widget and only register the new one
add_action( 'widgets_init', create_function( '', 'register_widget( "WP_Boostrap_Nav_Menu_Widget" );' ) );
