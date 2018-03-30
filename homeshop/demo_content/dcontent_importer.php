<?php 
add_action( 'wp_ajax_content_import', 'wp_ajax_content_import' );
function wp_ajax_content_import () {
content_import();
}

function demo_widgets_import() {
		echo "<br/>Loading widgets  <br/>";
		
			// Add data to widgets
			$widgets_json = get_template_directory_uri() . '/demo_content/homeshop-widget-data.json';
			$widgets_json = wp_remote_get( $widgets_json );
			$widget_data = $widgets_json['body'];
			$import_widgets = content_import_widget_data( $widget_data );
			
			echo "<br/>Widgets Loaded  <br/>";
}

function demo_import_theme_options() {


	echo "Loading theme options <br/>";
			// Import Theme Options
			$theme_options_file = get_template_directory_uri() . '/demo_content/homeshop-demo-settings.txt';

			
		$data = file_get_contents($theme_options_file);
		if(isset($data)&&($data!='')){
		parse_str($data,$output);
			$test; $test1; $test2; $test3; $test4;
			$upload = $output['theme_url'];
			$home = json_decode(stripslashes_deep($output['sense_home']));
			if(is_array($home)) {
				foreach ($home as $value) {
					$test[] = (array)$value;
				}
			}
			$output['home'] = $test;
			unset($output['sense_home']);

			$contact_icon = json_decode(stripslashes_deep($output['contact_icon']));
			if(is_array($contact_icon)) {
				foreach ($contact_icon as $value) {
					$value->icon = str_replace( $upload, UPLOAD_URL, $value->icon);
					$test2[] = (array)$value;
				}
			}
			$output['contact_icon'] = $test2;
			
			$soc = json_decode(stripslashes_deep($output['sense_soc']));
			if(is_array($soc)) {
				foreach ($soc as $value) {
					$value->icon = str_replace( $upload, UPLOAD_URL, $value->icon);
					$test1[] = (array)$value;
				}
			}
			$output['soc'] = $test1;
			
			$form = json_decode(stripslashes_deep($output['sense_contact_form']));
			if(is_array($form)) {
				foreach ($form as $value) {
					$test2[] = (array)$value;
				}
			}
			$output['contact_form'] = $test2;
			
			$teams = json_decode(stripslashes_deep($output['sense_teams']));
			if(is_array($teams)) {
				foreach ($teams as $value) {
					$value->img = str_replace( $upload, UPLOAD_URL, $value->img);
					$test3[] = (array)$value;
				}
			}
			$output['teams'] = $test3;
			
			$services = json_decode(stripslashes_deep($output['sense_services']));
			if(is_array($services)) {
				foreach ($services as $value) {
					$value->img = str_replace( $upload, UPLOAD_URL, $value->img);
					$test4[] = (array)$value;
				}
			}
			$output['services'] = $test4;
			
			unset($output['sense_home']);
			unset($output['sense_soc']);
			unset($output['contact_icon']);
			unset($output['sense_soc_about']);
			unset($output['sense_teams']);
			unset($output['sense_contact_form']);
			unset($output['sense_contact_form']);
			unset($output['sense_services']);
			foreach ($output as $key => $value) {
				$value = str_replace($upload, UPLOAD_URL, $value);
				update_option('sense_'.$key, $value);
			}
			echo "<br/>Theme  options loaded  <br/>";
		}else{
			echo "<br/>Theme  options have not been loaded  <br/>";
		}
}

function content_import() {
	
	global $wpdb;

	// Before we start, check if user has permissions
	if ( current_user_can('manage_options') ) {

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
		// Ensure WordPress Importer Class
		if ( ! class_exists( 'WP_Importer' ) ) include ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		// Deactivate WP Importer Plugin (to eliminate false "falses")
		deactivate_plugins( '/wordpress-importer/wordpress-importer.php', true );
		// Ensure WordPress Importer Plugin
		if ( ! class_exists( 'WP_Import' ) ) include get_template_directory() . '/demo_content/wordpress-importer.php';
		// With both of them loaded
		if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) {

			echo "<br/>Importing demo content <br/>";
			$dcontent = new WP_Import();

			// Basic dummy content import
			$theme_xml = get_template_directory() . '/demo_content/homeshop-democontent.xml.gz';
			$dcontent->fetch_attachments = true;
			ob_start();
			$dcontent->import($theme_xml);
			ob_end_clean();

			echo "Loading menus";
			// Set Menu locations for imported menus
			$locations = get_theme_mod( 'nav_menu_locations' );
			$menus = wp_get_nav_menus();
			if( $menus ) {
				foreach( $menus as $menu ) {
					if ( $menu->name == 'main' ) { // This name should be taken from the demo
						$locations['main_navigation'] = $menu->term_id;
						
					} elseif ( $menu->name == 'top' ) { // This name should be taken from the demo
						$locations['top_navigation'] = $menu->term_id;
					}
					
					 elseif ( $menu->name == 'infromation' ) { // This name should be taken from the demo
						$locations['mega_main_sidebar_menu'] = $menu->term_id;
					}
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations );

		


			
			// Revolution Slider Demo Content
			
			if (class_exists('RevSlider')) {

				$rev_path = get_template_directory() . '/demo_content';
			
				$sliders_needle_revolution = array(
					'slider-rev-large.zip'
				);

				foreach ($sliders_needle_revolution as $zip_path) {
					$slider = new RevSlider();
					$slider->importSliderFromPost(true, true, trailingslashit($rev_path) . $zip_path);
				}

			}
			
			


			// Set reading options
			$homepage = get_page_by_title( 'Home' );
			$posts_page = get_page_by_title( 'Blog' );
			if ( $homepage->ID && $posts_page->ID ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $homepage->ID );
				update_option( 'page_for_posts', $posts_page->ID );
			}		
			// That's it! Go back to options-helper.php and then return to ajax call.
			
			
			
			
			mad_mega_menu_options_backup();

			
			
			
			
			echo "<br/>Demo content imported<br/>";
		}
	}
}





		function mad_mega_menu_options_backup() {
			global $mega_main_menu;
			$file = MAD_BASE_PATH . 'demo_content/mega-main-menu-backup.txt';
			
			$backup_file_content = mm_common::get_url_content( $file );

			if ( $backup_file_content !== false && ( $options_backup = json_decode( $backup_file_content, true ) ) ) {
				if ( isset( $options_backup['last_modified'] ) ) {
					$options_backup['last_modified'] = time() + 30;
					update_option( $mega_main_menu->constant[ 'MM_OPTIONS_NAME' ], $options_backup );
				}
			}
		}




// Parsing Widgets Function
// http://wordpress.org/plugins/widget-settings-importexport/
function content_import_widget_data( $widget_data ) {
	$json_data = $widget_data;
	$json_data = json_decode( $json_data, true );

	$sidebar_data = $json_data[0];
	$widget_data = $json_data[1];

	foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
		$widgets[ $widget_data_title ] = '';
		foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
			if( is_int( $widget_data_key ) ) {
				$widgets[$widget_data_title][$widget_data_key] = 'on';
			}
		}
	}
	unset($widgets[""]);

	foreach ( $sidebar_data as $title => $sidebar ) {
		$count = count( $sidebar );
		for ( $i = 0; $i < $count; $i++ ) {
			$widget = array( );
			$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
			$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
			if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
				unset( $sidebar_data[$title][$i] );
			}
		}
		$sidebar_data[$title] = array_values( $sidebar_data[$title] );
	}

	foreach ( $widgets as $widget_title => $widget_value ) {
		foreach ( $widget_value as $widget_key => $widget_value ) {
			$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
		}
	}

	$sidebar_data = array( array_filter( $sidebar_data ), $widgets );

	content_parse_import_data( $sidebar_data );
}

function content_parse_import_data( $import_array ) {
	global $wp_registered_sidebars;
	$sidebars_data = $import_array[0];
	$widget_data = $import_array[1];
	$current_sidebars = get_option( 'sidebars_widgets' );
	$new_widgets = array( );

	foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

		foreach ( $import_widgets as $import_widget ) :
			//if the sidebar exists
			if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
				$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
				$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
				$current_widget_data = get_option( 'widget_' . $title );
				$new_widget_name = content_get_new_widget_name( $title, $index );
				$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

				if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
					while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
						$new_index++;
					}
				}
				$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
				if ( array_key_exists( $title, $new_widgets ) ) {
					$new_widgets[$title][$new_index] = $widget_data[$title][$index];
					$multiwidget = $new_widgets[$title]['_multiwidget'];
					unset( $new_widgets[$title]['_multiwidget'] );
					$new_widgets[$title]['_multiwidget'] = $multiwidget;
				} else {
					$current_widget_data[$new_index] = $widget_data[$title][$index];
					$current_multiwidget = $current_widget_data['_multiwidget'];
					$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
					$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
					unset( $current_widget_data['_multiwidget'] );
					$current_widget_data['_multiwidget'] = $multiwidget;
					$new_widgets[$title] = $current_widget_data;
				}

			endif;
		endforeach;
	endforeach;

	if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
		update_option( 'sidebars_widgets', $current_sidebars );

		foreach ( $new_widgets as $title => $content )
			update_option( 'widget_' . $title, $content );

		return true;
	}

	return false;
}

function content_get_new_widget_name( $widget_name, $widget_index ) {
	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array( );
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				$all_widget_array[] = $widget;
			}
		}
	}
	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
		$widget_index++;
	}
	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}



function content_export_widget_settings() {
		// @TODO check something better than just $_POST
		
			header( "Content-Description: File Transfer" );
			header( "Content-Disposition: attachment; filename=widget_data.json" );
			header( "Content-Type: application/octet-stream" );
			unset($_POST['action']);
			unset($_POST['_wpnonce']);
			unset($_POST['_wp_http_referer']);
			echo content_parse_export_data();
			exit;
		
	}

	function content_parse_export_data() {
		$sidebars_array = get_option( 'sidebars_widgets' );
		$sidebar_export = array( );
		foreach ( $sidebars_array as $sidebar => $widgets ) {
			if ( !empty( $widgets ) && is_array( $widgets ) ) {
				foreach ( $widgets as $sidebar_widget ) {
						$sidebar_export[$sidebar][] = $sidebar_widget;
					
				}
			}
		}
		$widgets = array( );
		foreach ( $posted_array as $k => $v ) {
			$widget = array( );
			$widget['type'] = trim( substr( $k, 0, strrpos( $k, '-' ) ) );
			$widget['type-index'] = trim( substr( $k, strrpos( $k, '-' ) + 1 ) );
			$widget['export_flag'] = ($v == 'on') ? true : false;
			$widgets[] = $widget;
		}
		$widgets_array = array( );
		foreach ( $widgets as $widget ) {
			$widget_val = get_option( 'widget_' . $widget['type'] );
			$widget_val = apply_filters( 'widget_data_export', $widget_val, $widget['type'] );
			$multiwidget_val = $widget_val['_multiwidget'];
			$widgets_array[$widget['type']][$widget['type-index']] = $widget_val[$widget['type-index']];
			if ( isset( $widgets_array[$widget['type']]['_multiwidget'] ) )
				unset( $widgets_array[$widget['type']]['_multiwidget'] );

			$widgets_array[$widget['type']]['_multiwidget'] = $multiwidget_val;
		}
		unset( $widgets_array['export'] );
		$export_array = array( $sidebar_export, $widgets_array );
		$json = json_encode( $export_array );
		return $json;
	}



?>