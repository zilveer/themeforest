<?php
/** Elderberry Widgets
  *
  * A small class to make widget creation more modular.
  *
  * @package Elderberry
  *
  */

class EB_Widgets {

	/** Class Constructor
	  *
	  * Passes our framework to the class, creates the controls adn
	  * registers the widgets.
	  *
	  * @param object $framework THe Elderberry framework class
	  *
	  */
	function __construct( $framework ) {
		$this->framework = $framework;
		$this->controls = new EB_Controls( $framework, 'widget', array( 'widgets' ) );;
		$this->widgets = $this->framework->defaults['widgets'];
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}

	/** Register Widgets
	  *
	  * This function is responsible for registering the widgets
	  * which are set up in the defaults. See the defaults.php
	  * file or the widgets.sample.php file in the samples directory
	  * for more information
	  *
	  */
	function register_widgets() {
		$default_widgets = array( 'WP_Widget_Pages', 'WP_Widget_Calendar', 'WP_Widget_Archives', 'WP_Widget_Links', 'WP_Widget_Categories', 'WP_Widget_Recent_Posts', 'WP_Widget_Search', 'WP_Widget_Tag_Cloud' );

		foreach( $this->widgets['groups'] as $widget_name => $widget ) {
			if( !empty( $widget['tabs']['main_settings']['unregister'] ) AND in_array( $widget['tabs']['main_settings']['unregister'], $default_widgets ) ) {
				unregister_widget( $widget['tabs']['main_settings']['unregister'] );
			}

			register_widget( 'eb_widget_' . $widget_name );

		}

	}

	/** Get Widget Options
	  *
	  * A function which makes widget creation faster. It is used in the
	  * constructors of classes which extend the WP_Widget class.
	  *
	  * @param string $widget_name The name of the widget we want the options for
	  *
	  * @return array $widget_options The array of widget options
	  *
	  */
	function get_widget_options( $widget_name ) {
		$widget = $this->widgets['groups'][$widget_name]['tabs']['main_settings'];
		$widget_options = array(
			'classname'   => $widget['id'],
			'description' => $widget['description']
		);
		return $widget_options;
	}

	/** Get Widget Control Options
	  *
	  * A function which makes widget creation faster. It is used in the
	  * constructors of classes which extend the WP_Widget class.
	  *
	  * @param string $widget_name The name of the widget we want the control options for
	  *
	  * @return array $control_options The array of control options
	  *
	  */
	function get_control_options( $widget_name ) {
		$widget = $this->widgets['groups'][$widget_name]['tabs']['main_settings'];
		$control_options = array(
			'width'   => $widget['width'],
			'height'  => 250,
			'id_base' => $widget['id']
		);
		return $control_options;
	}

	/** Check Widget Data
	  *
	  * Checks the widget data to make sure bad data is not saved and used
	  *
	  * @param mixed $data The data to check
	  *
	  * @return mixed $data The checked data
	  *
	  */
	function check_widget_data( $options, $widget ) {
		$default_options = $this->framework->get_control_data( 'widgets', $widget );

		foreach( $default_options as $name => $data ) {
			if( is_array( $data['default'] ) ) {
				foreach( $data['default'] as $subname => $subdata ) {
					$value = ( empty( $options[$name][$subname] ) ) ? '' : $options[$name][$subname];
					$empty_value = ( empty( $data['empty_value'][$subname] ) ) ? '' : $data['empty_value'][$subname];
					$options[$name][$subname] = $this->framework->get_checked_value( $value, $data['allow_empty'][$subname], $empty_value, $data['default'][$subname] );
				}
			}
			else {
				$value = ( empty( $options[$name] ) ) ? '' : $options[$name];

				$empty_value = ( empty( $data['empty_value'] ) ) ? '' : $data['empty_value'];
				$options[$name] = $this->framework->get_checked_value( $value, $data['allow_empty'], $empty_value, $data['default'] );
			}
		}

		foreach( $options as $name => $value ) {
			if( is_string( $value ) ) {
				$options[$name] = trim( $value );
			}
		}


		return $options;

	}


}



?>