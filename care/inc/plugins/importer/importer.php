<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Demo data importer
*	--------------------------------------------------------------------- 
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) die;


// Include importer in back-end
add_action( 'admin_init', 'mnky_importer' );
function mnky_importer() {
    global $wpdb;

    if ( current_user_can( 'manage_options' ) && isset( $_GET['import_data_content'] ) ) {
		
		// Define importer
        if ( ! defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); 

		// Load Importer API
		if ( ! class_exists( 'WP_Importer' ) ) {
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			if ( file_exists( $class_wp_importer ) )
				require $class_wp_importer;
		}

        if ( ! class_exists('WP_Import') ) {
            $wp_import = MNKY_PLUGINS . '/importer/wordpress-importer.php';
            require $wp_import;
        }
		

        if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) {

            $importer = new WP_Import();
            
			// Import demo data
            $theme_xml = MNKY_PLUGINS . '/importer/data/theme_data.xml';
            $importer->fetch_attachments = true;
            ob_start();
            $importer->import($theme_xml);
            ob_end_clean();

			
            // Assign imported menus
            $locations = get_theme_mod( 'nav_menu_locations' );
            $registred_menus = wp_get_nav_menus();

            if( $registred_menus ) {
                foreach( $registred_menus as $menu ) {
                    if( $menu->name == 'Main Menu' ) {
                        $locations['primary'] = $menu->term_id;
                    }
                }
            }

            set_theme_mod( 'nav_menu_locations', $locations );


            // Add widgets to sidebars
            $widget_data = MNKY_PLUGINS . '/importer/data/widget_data.wie';
			mnky_process_import_file( $widget_data );


            // Change "Settings/Reading" options
            $front_page = get_page_by_title( 'Home' );
            $posts_page = get_page_by_title( 'Health Blog' );
            if($front_page->ID && $posts_page->ID) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $front_page->ID); // Set front page
                update_option('page_for_posts', $posts_page->ID); // Set blog Page
            }

            // Redirect to success page
            wp_redirect( admin_url( 'themes.php?page=ot-theme-options#section_import_successful' ) );
        }
    }
}


// Widget Importer & Exporter (http://wordpress.org/plugins/widget-importer-exporter/)
function mnky_process_import_file( $widget_data ) {

	// Get file and decode
	$data = file_get_contents( $widget_data );
	$data = json_decode( $data );

	// Import the widget data
	mnky_import_data( $data );

}

// Available widgets
function mnky_available_widgets() {

	global $wp_registered_widget_controls;

	$widget_controls = $wp_registered_widget_controls;
	$available_widgets = array();

	foreach ( $widget_controls as $widget ) {
		if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes
			$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
			$available_widgets[$widget['id_base']]['name'] = $widget['name'];
		}
	}

	return apply_filters( 'mnky_available_widgets', $available_widgets );
}

// Import widget JSON data
function mnky_import_data( $data ) {

	global $wp_registered_sidebars;

	$data = apply_filters( 'mnky_import_data', $data );

	// Get all available widgets site supports
	$available_widgets = mnky_available_widgets();

	// Get all existing widget instances
	$widget_instances = array();
	foreach ( $available_widgets as $widget_data ) {
		$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
	}

	// Begin results
	$results = array();

	// Loop import data's sidebars
	foreach ( $data as $sidebar_id => $widgets ) {

		// Skip inactive widgets
		// (should not be in export file)
		if ( 'wp_inactive_widgets' == $sidebar_id ) {
			continue;
		}

		// Check if sidebar is available on this site
		// Otherwise add widgets to inactive, and say so
		if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
			$sidebar_available = true;
			$use_sidebar_id = $sidebar_id;
			$sidebar_message_type = 'success';
			$sidebar_message = '';
		} else {
			$sidebar_available = false;
			$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
			$sidebar_message_type = 'error';
			$sidebar_message = __( 'Sidebar does not exist in theme (using Inactive)', 'wordpress-importer' );
		}

		// Result for sidebar
		$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
		$results[$sidebar_id]['message_type'] = $sidebar_message_type;
		$results[$sidebar_id]['message'] = $sidebar_message;
		$results[$sidebar_id]['widgets'] = array();

		// Loop widgets
		foreach ( $widgets as $widget_instance_id => $widget ) {

			$fail = false;

			// Get id_base (remove -# from end) and instance ID number
			$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
			$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

			// Does site support this widget?
			if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
				$fail = true;
				$widget_message_type = 'error';
				$widget_message = __( 'Site does not support widget', 'wordpress-importer' ); // explain why widget not imported
			}

			// Filter to modify settings before import
			// Do before identical check because changes may make it identical to end result (such as URL replacements)
			$widget = apply_filters( 'mnky_widget_settings', $widget );

			// Does widget with identical settings already exist in same sidebar?
			if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

				// Get existing widgets in this sidebar
				$sidebars_widgets = get_option( 'sidebars_widgets' );
				$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

				// Loop widgets with ID base
				$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
				foreach ( $single_widget_instances as $check_id => $check_widget ) {

					// Is widget in same sidebar and has identical settings?
					if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

						$fail = true;
						$widget_message_type = 'warning';
						$widget_message = __( 'Widget already exists', 'wordpress-importer' ); // explain why widget not imported

						break;

					}
	
				}

			}

			// No failure
			if ( ! $fail ) {

				// Add widget instance
				$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
				$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
				$single_widget_instances[] = (array) $widget; // add it

					// Get the key it was given
					end( $single_widget_instances );
					$new_instance_id_number = key( $single_widget_instances );

					// If key is 0, make it 1
					// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
					if ( '0' === strval( $new_instance_id_number ) ) {
						$new_instance_id_number = 1;
						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
						unset( $single_widget_instances[0] );
					}

					// Move _multiwidget to end of array for uniformity
					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
						$multiwidget = $single_widget_instances['_multiwidget'];
						unset( $single_widget_instances['_multiwidget'] );
						$single_widget_instances['_multiwidget'] = $multiwidget;
					}

					// Update option with new widget
					update_option( 'widget_' . $id_base, $single_widget_instances );

				// Assign widget instance to sidebar
				$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
				$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
				$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
				update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

				// Success message
				if ( $sidebar_available ) {
					$widget_message_type = 'success';
					$widget_message = __( 'Imported', 'wordpress-importer' );
				} else {
					$widget_message_type = 'warning';
					$widget_message = __( 'Imported to Inactive', 'wordpress-importer' );
				}

			}

			// Result for widget instance
			$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
			$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = $widget->title ? $widget->title : __( 'No Title', 'wordpress-importer' ); // show "No Title" if widget instance is untitled
			$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
			$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

		}
	}
}