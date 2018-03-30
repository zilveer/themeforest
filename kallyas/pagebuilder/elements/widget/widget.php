<?php if(! defined('ABSPATH')){ return; }
/*
	Name: WIDGET
	Description: This element will generate an empty element with an unique ID that can be used as an achor point
	Class: ZnWidgetElement
	Category: widgets
	Level: 3

*/

class ZnWidgetElement extends ZnElements {

	function options() {

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						'id'          => 'options_wrapper',
						'class'       => 'zn_widget_options_container',
						'type'        => 'options_wrapper',
						'option_file'	=> dirname ( __FILE__ ) .'/options.php'
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#GAiAelvoOg4',
				'docs'    => 'http://support.hogash.com/documentation/anchor-point-element/',
				'copy'    => $uid,
				'general' => true,
			)),



		);

		return $options;

	}

	function element(){

		$options = $this->data['options'];

		$classes=array();
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		if( empty( $options ) ) { return; }

		?>
		<div class="zn-widget-module <?php echo implode(' ', $classes); ?>" <?php echo $attributes; ?>>
			<?php

			global $wp_widget_factory;

			// Widget class
			$widget_option = $this->opt('widget');
			if( ! empty( $this->data['widget'] ) ) {
				$widget_slug = $this->data['widget'];
			}
			else if( ! empty( $widget_option ) ) {
				$widget_slug = $widget_option;
			}

			if( ! empty($widget_slug) && isset($wp_widget_factory->widgets[$widget_slug])) {

				// Widget instance
				$factory_instance   = $wp_widget_factory->widgets[$widget_slug];
				$widget_class       = get_class($factory_instance);
				$widget_instance    = new $widget_class($factory_instance->id_base, $factory_instance->name, $factory_instance->widget_options);

				// Get saved options
				$saved_options = ! empty( $this->data['options'] ) ? $this->data['options'] : array();

				// Widget settings
				$settings_key       = 'widget-' . $widget_instance->id_base;
				$widget_settings    = isset( $saved_options[$settings_key][0] ) ? $saved_options[$settings_key][0] : array();

				// Render the widget
				the_widget($widget_slug, $widget_settings, array('widget_id' => 'znpb_widget' . $this->data['uid']));
			}
			else if( isset( $widget_slug ) && ZNPB()->is_active_editor ) {

				// Widget doesn't exist!
				printf( _x( '%s does not exists.', '%s stands for widget slug.', 'zn_framework' ), $widget_slug );

			}

			?>
		</div>
		<?php
	}

}

?>
