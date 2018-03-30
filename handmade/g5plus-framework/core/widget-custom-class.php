<?php
// Add custom CSS to
function g5plus_custom_css_in_widget_form( $widget, $return, $instance ) {
	if ( !isset( $instance['css_class'] ) ) $instance['css_class'] = null;

	echo "<p><label for='widget-{$widget->id_base}-{$widget->number}-css_class'>". esc_html__( 'CSS Class', 'g5plus-handmade' ) .":</label>
			<input type='text' name='widget-{$widget->id_base}[{$widget->number}][css_class]' id='widget-{$widget->id_base}-{$widget->number}-css_class' value='{$instance['css_class']}' class='widefat' /></p>";

	return $instance;
}

// Update widget callback
function g5plus_custom_css_widget_update_callback( $instance, $new_instance ) {
	$instance['css_class'] = $new_instance['css_class'];
	$instance['ids']     = $new_instance['ids'];
	return $instance;
}

// Add Custom CSS Class to front end
function g5plus_custom_css_add_widget_css_class( $params ) {

	global $wp_registered_widgets, $widget_number;

	$widget_id              = $params[0]['widget_id'];
	$widget_obj             = $wp_registered_widgets[$widget_id];
	$widget_num             = $widget_obj['params'][0]['number'];
	$widget_opt             = null;

	// if Widget Logic plugin is enabled, use it's callback
	if ( in_array( 'widget-logic/widget_logic.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$widget_logic_options = get_option( 'widget_logic' );
		if ( isset( $widget_logic_options['widget_logic-options-filter'] ) && 'checked' == $widget_logic_options['widget_logic-options-filter'] ) {
			$widget_opt = get_option( $widget_obj['callback_wl_redirect'][0]->option_name );
		} else {
			$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
		}

		// if Widget Context plugin is enabled, use it's callback
	} elseif ( in_array( 'widget-context/widget-context.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$callback = isset($widget_obj['callback_original_wc']) ? $widget_obj['callback_original_wc'] : null;
		$callback = !$callback && isset($widget_obj['callback']) ? $widget_obj['callback'] : null;

		if ($callback && is_array($widget_obj['callback'])) {
			$widget_opt = get_option( $callback[0]->option_name );
		}
	}
	// Default callback
	else {
		// Check if WP Page Widget is in use
		global $post;
		$id = ( isset( $post->ID ) ? get_the_ID() : NULL );
		if ( isset( $id ) && get_post_meta( $id, '_customize_sidebars' ) ) {
			$custom_sidebarcheck = get_post_meta( $id, '_customize_sidebars' );
		}
		if ( isset( $custom_sidebarcheck[0] ) && ( $custom_sidebarcheck[0] == 'yes' ) ) {
			$widget_opt = get_option( 'widget_'.$id.'_'.substr($widget_obj['callback'][0]->option_name, 7) );
		} elseif ( isset( $widget_obj['callback'][0]->option_name ) ) {
			$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
		}
	}

	if ( isset( $widget_opt[$widget_num]['css_class'] ) && !empty( $widget_opt[$widget_num]['css_class'] ) )
		$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['css_class']} ", $params[0]['before_widget'], 1 );

	return $params;
}

// Front end hook
function g5plus_custom_css_frontend_hook() {
	if ( !is_admin() ) {
		add_filter( 'dynamic_sidebar_params','g5plus_custom_css_add_widget_css_class' );
	}
}

add_action( 'in_widget_form', 'g5plus_custom_css_in_widget_form', 10, 3 );
add_filter( 'widget_update_callback', 'g5plus_custom_css_widget_update_callback', 10, 2 );
add_action( 'wp_loaded', 'g5plus_custom_css_frontend_hook' );