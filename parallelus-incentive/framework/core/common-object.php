<?php
/*
 *  Based on the work of Henrik Melin and Kal Ström's "More Fields", "More Types" and "More Taxonomies" plugins.
 *  http://more-plugins.se/
*/

$runway_framework = 'RUNWAY_FRAMEWORK';

if ( !defined( $runway_framework ) ) {
	class Runway_Object {

		public $settings, $filter, $data_modified, $data_default;

		function __construct( $settings ) {
			$this->settings = $settings;
			if ( isset( $settings['alias'] ) && !empty( $settings['alias'] ) )
				$this->slug = sanitize_title( $settings['alias'] );
			else
				$this->slug = sanitize_title( $settings['name'] );
			$this->init( $settings );
			$this->filter = str_replace( '-', '_', sanitize_title( $this->settings['name'] ) ) . '_saved';
			$this->data_default = array();
			$this->data_modified = array();
			$this->data_loaded = array();

			add_action( 'init', array( &$this, 'load_save_files' ) );
		}

		/**
		* This function is intentionally left blank
		*
		* Overwritten by indiviudal plugin admin objects, if needed.
		**/			
		function init( $settings ) { }

		function load_save_files() {
			// Read in saved files
			$dir = plugin_dir_path( $this->settings['file'] ) . 'saved/';

			if ( is_dir( $dir ) ) {
				// Pre PHP 5 compatablity
				if ( is_callable( 'scandir' ) )
					$ls = scandir( $dir );
				else {
					$ls = array();
					$dh  = opendir( $dir );
					while ( false !== ( $filename = readdir( $dh ) ) ) {
						if ( $filename[0] != '.' ) $ls[] = $filename;
					}
				}

				$pts = array();
				foreach ( $ls as $l ) if ( strpos( $l, '.php' ) ) $pts[] = $l;
					foreach ( $pts as $file ) require $dir . $file;
					$this->data = $this->load_objects();
			}

		}

		function object_to_array( $data ) {
			if ( is_object( $data ) ) $data = get_object_vars( $data );
			return is_array( $data ) ? array_map( array( &$this, 'object_to_array' ), $data ) : $data;
		}

		function get_objects( $keys = array() ) {
			if ( empty( $this->data_loaded ) ) $this->data_loaded = $this->load_objects();
			if ( !empty( $keys ) ) {
				$ret = array();
				foreach ( $keys as $key ) {
					foreach ( (array) $this->data_loaded[$key] as $name => $var ) {
						$ret[$name] = $this->data_loaded[$key][$name];
					}
				}
				return $ret;
			}
			return $this->data_loaded;
		}

		function load_objects( $data = array() ) {
			$plugin = get_option( $this->settings['option_key'], array() );

			$data['_framework'] = $this->object_to_array( $plugin );
			if ( !$data['_framework'] ) $data['_framework'] = array();

			$saved = $this->saved_data();
			$data['_framework_saved'] = $this->object_to_array( $saved );
			if ( !$data['_framework_saved'] ) $data['_framework_saved'] = array();
			foreach ( (array) $this->data_modified as $key => $item ) {
				// Remove the defaults
				if ( array_key_exists( $key, (array) $this->data_default ) )
					unset( $this->data_modified[$key] );
				/*
				if (array_key_exists($key, $data['_framework']))
					unset($this->data_modified[$key]);
				if (array_key_exists($key, (array) $data['_framework_saved']))
					unset($this->data_modified[$key]);
				*/
			}

			$data['_other'] = $this->object_to_array( $this->data_modified );
			if ( !$data['_other'] ) $data['_other'] = array();

			$data['_default'] = $this->object_to_array( $this->data_default );
			if ( !$data['_default'] ) $data['_default'] = array();

			$this->data_loaded = $data;
			return $data;
		}

		function saved_data() {
			$data = array();
			$saved = array();
			$saved = apply_filters( $this->filter, $saved );
			foreach ( $saved as $key => $type ) {
				$data[$key] = $type;
				$data[$key]['file'] = true;
			}

			return $data;
		}
		
		function elsewhere_data( $data, $wpdata ) {
			// Get the stuff defined elsewhere
			foreach ( $wpdata as $key => $item ) {
				if ( in_array( $key, (array) $this->settings['default_keys'] ) ) continue;
				$item = $this->object_to_array( $item );
				$data[$key] = $item;
				$data[$key]['file'] = true;
				$data[$key]['other'] = true;
			}
			return $data;
		}

		/*
		**      POPULATE
		**
		*/
		function populate( $page, $options = array() ) {
			// These are the single value variables
			foreach ( (array) $this->settings['fields']['var'] as $field ) {
				if ( !is_array( $field ) ) {
					if ( array_key_exists( $field, (array) $page ) ) {
						$options[$field] = $page[$field];
					} else {
						$options[$field] = false;
					}
				} else {
					// Arrays, may be associative
					foreach ( (array) $this->settings['fields']['array'] as $k => $f ) {
						if ( !is_array( $f ) ) {
							if ( array_key_exists( $f, (array) $page ) )
								$options[$f] = $page[$f];
							// $options[$f] = (array_key_exists($f, (array) $page)) ? $page[$f] : array();
						} else {
							foreach ( (array) $f as $f2 ) {
								if ( array_key_exists( $f2, (array) $page[$k] ) )
									$options[$k][$f2] = $page[$k][$f2];
								// $options[$k][$f2] = (array_key_exists($f2, (array) $page[$k])) ? $page[$k][$f2] : false;
							}
						}
					}
				}
			}
			return $options;
		}
	}
}

if ( !is_callable( '__d' ) ) {
	function __d( $d ) {
		if ( !defined( 'THEME_FRAMEWORK_DEV' ) ) return false;
		if ( !$d ) return false;
		echo '<pre>';
		print_r( $d );
		echo '</pre>';
	}
}