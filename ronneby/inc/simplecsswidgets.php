<?php
/**
 * @package Simple_CSS_For_Widgets
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $th_widgetcss_options;

if ( ( !$th_widgetcss_options = get_option( 'widget_css' ) ) || !is_array( $th_widgetcss_options ) ) 
	$th_widgetcss_options = array();

if ( is_admin() ) {
	add_action( 'sidebar_admin_setup', 'th_widget_css_expand_control' );
	add_filter( 'widget_update_callback', 'th_widget_css_widget_update_callback', 10, 3 ); 
}

add_filter( 'dynamic_sidebar_params', 'th_filter_widget' );

/**
 * Registered Callback function for the admin sidebar setup
 *
 * Augments the Widgets with extra control to specify a CSS class
 */
function th_widget_css_expand_control() {

	global $wp_registered_widgets, $wp_registered_widget_controls, $th_widgetcss_options;

	if( 'post' == strtolower( $_SERVER['REQUEST_METHOD'] ) ) {	
		foreach( (array) $_POST['widget-id'] as $widget_number => $widget_id ) {
			if ( isset( $_POST[$widget_id.'-widget_css'] ) ) {
				$th_widgetcss_options[$widget_id] = $_POST[$widget_id.'-widget_css'];
			}
		}
	}

	update_option( 'widget_css', $th_widgetcss_options );
	
	foreach ( $wp_registered_widgets as $id => $widget ) {
		if ( !$wp_registered_widget_controls[$id] ) {
			wp_register_widget_control($id,$widget['name'], 'widget_css_empty_control');
		}
		
		$wp_registered_widget_controls[$id]['callback_widget_css_redirect'] = $wp_registered_widget_controls[$id]['callback'];
		$wp_registered_widget_controls[$id]['callback'] = 'widget_css_extra_control';
		array_push( $wp_registered_widget_controls[$id]['params'], $id );	
	}	
}

/**
 * Callback function for the agumented widget control.
 *
 * Renders the text field box to the widget where the CSS class is to be specified.
 */
function widget_css_extra_control() {
		
	global $wp_registered_widget_controls, $th_widgetcss_options;

	$params = func_get_args();
	$id = array_pop( $params );
	$callback = $wp_registered_widget_controls[$id]['callback_widget_css_redirect'];

	if( is_callable( $callback ) )
		call_user_func_array( $callback, $params );		
	
	$value = !empty( $th_widgetcss_options[$id ] ) ? htmlspecialchars( stripslashes( $th_widgetcss_options[$id ] ),ENT_QUOTES ) : '';


	if( isset( $params[0]['number']) )
		$number = $params[0]['number'];
		
	if( isset( $number ) && $number == -1 ) { 
		$number="%i%"; $value="";
	}
	
	$id_disp = $id;
	
	if( isset( $number ) ) {
		$id_disp = $wp_registered_widget_controls[$id]['id_base'].'-'.$number;
	}

	echo "<p><label for='".esc_attr($id_disp)."-widget_css'>".__('CSS class', 'dfd')." <input type='text' name='".esc_attr($id_disp)."-widget_css' id='".esc_attr($id_disp)."-widget_css' value='".$value."' /></label></p>";

}

/**
 * Callback Function for widget update.
 *
 * Saves the CSS class value that has been specified for the widget.
 */
function th_widget_css_widget_update_callback( $instance, $new_instance, $this_widget )
{	
	global $th_widgetcss_options;

	$widget_id = $this_widget->id;
	
	if( isset( $_POST[$widget_id.'-widget_css'] ) ) {
		$th_widgetcss_options[$widget_id] = $_POST[$widget_id.'-widget_css'];
		update_option( 'widget_css', $th_widgetcss_options );
	}
	
	return $instance;
}

/**
 * Callback function for the dynamic_sidebar_params
 *
 * Dynamically applies the specified CSS class to the widget when it is rendered at the front end.
 */
function th_filter_widget( $params ) {

	global $th_widgetcss_options;

	if( isset( $th_widgetcss_options[$params[0]['widget_id']] ) && trim($th_widgetcss_options[$params[0]['widget_id']]) !='' ) {

		if( trim( $params[0]['before_widget']) == '' ) {
			$params[0]['before_widget'] = '<div class="'.$th_widgetcss_options[$params[0]['widget_id']].'">';
			$params[0]['after_widget'] = '</div>';				
		}
		else {
			$xml = simplexml_load_string($params[0]['before_widget']."#splt#".$params[0]['after_widget']);

			if( isset( $xml['class'] ) )
				$xml['class'] = $xml['class'].' '.$th_widgetcss_options[$params[0]['widget_id']];
			else
				$xml['class'] = $th_widgetcss_options[$params[0]['widget_id']];
				
			$processedtags = explode( '#splt#', $xml->asXML() );
			
			$params[0]['before_widget'] = $processedtags[0];
			$params[0]['after_widget'] = $processedtags[1];
		}
	}
	return $params;
}
