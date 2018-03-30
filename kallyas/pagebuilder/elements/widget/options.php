<?php if(! defined('ABSPATH')){ return; }

global $wp_widget_factory;

// Get saved options
$options = ! empty( $_POST['element_options'] ) ? $_POST['element_options'] : array();

// Widget class
if( ! empty( $_POST['element_options']['widget'] ) ) {
	$widget_slug = $_POST['element_options']['widget'];
}
else if( ! empty( $options['options'] ) ) {
	$widget_slug = $options['options']['widget'];
}

if(isset($widget_slug) && isset($wp_widget_factory->widgets[$widget_slug])) {

	// Widget instance
	$factory_instance   = $wp_widget_factory->widgets[$widget_slug];
	$widget_class       = get_class($factory_instance);
	$widget_instance    = new $widget_class($factory_instance->id_base, $factory_instance->name, $factory_instance->widget_options);

	// Widget title
	echo '<h3 class="zn-pb-widget-options">' . $widget_instance->name . ' '.__( 'Widget Options', 'zn_framework' ).'</h3>';


	// Widget settings
	$settings_key = 'widget-' . $widget_instance->id_base;
	$saved_options = ! empty( $options['options'] ) ? $options['options'] : array();
	$widget_settings    = isset( $saved_options[$settings_key][0] ) ? $saved_options[$settings_key][0] : array();

	// Widget form
	echo '<div class="zn-pb-widget-fields">';
	$widget_instance->form($widget_settings);
	echo '</div>';
	// This will help us pass the widget slug to saved options
	echo '<input type="hidden" name="widget" value="' . $widget_slug . '" />';

}
else if(isset($widget_slug)) {

	// Widget doesn't exist!
	printf( _x( '%s does not exists.', '%s stands for widget slug.', 'zn_framework' ), $widget_slug );
}
