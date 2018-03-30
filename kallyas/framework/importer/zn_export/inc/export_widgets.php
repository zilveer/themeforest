<?php if(! defined('ABSPATH')){ return; }
if(!defined('ABSPATH')) {
	die("Don't call this file directly.");
}

if ( ! class_exists( 'ZnWidgetsExporter' ) ) {
	class ZnWidgetsExporter
	{

		private $file_name = 'widgets.txt';

		function __construct(){

		}

		function render_page() {
			 //$widgets_json = $this->build_widgets_json();
			 //echo $widgets_json;
		}

		function do_deploy(){
			$export_file = fopen( THEME_BASE . '/template_helpers/dummy_content/'. $this->file_name, 'w' );

			$content = $this->build_widgets_json();
			fwrite( $export_file, $content );

		}

		function do_export(){

			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $this->file_name );
			header( 'Content-Type: text/plain; charset=' . get_option( 'blog_charset' ), true );

			$widgets_json = $this->build_widgets_json();
			echo $widgets_json;

			die();
		}

		function get_all_widgets() {
			global $wp_registered_widget_controls;

			$widget_controls = $wp_registered_widget_controls;

			$available_widgets = array();

			foreach ( $widget_controls as $widget ) {

				if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

					$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
					$available_widgets[$widget['id_base']]['name'] = $widget['name'];

				}

			}

			return $available_widgets;

		}

		function build_widgets_json(){
			// Get all available widgets site supports
			$available_widgets = $this->get_all_widgets();

			// Get all widget instances for each widget
			$widget_instances = array();
			foreach ( $available_widgets as $widget_data ) {

				// Get all instances for this ID base
				$instances = get_option( 'widget_' . $widget_data['id_base'] );

				// Have instances
				if ( ! empty( $instances ) ) {

					// Loop instances
					foreach ( $instances as $instance_id => $instance_data ) {

						// Key is ID (not _multiwidget)
						if ( is_numeric( $instance_id ) ) {
							$unique_instance_id = $widget_data['id_base'] . '-' . $instance_id;
							$widget_instances[$unique_instance_id] = $instance_data;
						}

					}

				}

			}

			// Gather sidebars with their widget instances
			$sidebars_widgets = get_option( 'sidebars_widgets' ); // get sidebars and their unique widgets IDs
			$sidebars_widget_instances = array();
			foreach ( $sidebars_widgets as $sidebar_id => $widget_ids ) {

				// Skip inactive widgets
				if ( 'wp_inactive_widgets' == $sidebar_id ) {
					continue;
				}

				// Skip if no data or not an array (array_version)
				if ( ! is_array( $widget_ids ) || empty( $widget_ids ) ) {
					continue;
				}

				// Loop widget IDs for this sidebar
				foreach ( $widget_ids as $widget_id ) {

					// Is there an instance for this widget ID?
					if ( isset( $widget_instances[$widget_id] ) ) {

						// Add to array
						$sidebars_widget_instances[$sidebar_id][$widget_id] = $widget_instances[$widget_id];

					}

				}

			}
			
			// Replace image id's
			// TODO : Set a general options for replace image ids !!!
			if ( 1==1 ) {
				
				$sidebars_widget_instances = $this->replace_images_deep($sidebars_widget_instances);
				//$sidebars_widget_instances = str_replace('wp-content/uploads/', 'zn-content/uploads/', $sidebars_widget_instances);
			}

			// Encode the data for file contents
			return json_encode( $sidebars_widget_instances );

		}

		function replace_images_deep( $array ){
			if ( ! is_array(  $array ) ) { return str_replace('wp-content/uploads/', 'zn-content/uploads/', $array); }
			
			$new_array = array();
			
			foreach( $array as $key => $value ){
				$new_array[$key] = $this->replace_images_deep( $value );
			}
			
			return $new_array;
		}
		
	}
	
}


?>
