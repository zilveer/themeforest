<?php

class Widget_Data_PMC {




	/**
	 * HTML for import admin page
	 * @return type
	 */
	public static function import_settings_page($file) {

		?>
		<div class="widget-data import-widget-settings">
			<div class="wrap">
				<h3>WIDGETS IMPORT - SETTINGS</h3>
							<?php wp_nonce_field('import_widget_data', '_wpnonce');

								$json = self::get_widget_settings_json($file);

								if( is_wp_error($json) )
									wp_die( $json->get_error_message() );

								if( !$json || !( $json_data = json_decode( $json[0], true ) ) )
									return;

								$json_file = $json[1];
							?>
							<input type="hidden" name="import_file" value="<?php echo esc_attr( $json_file ); ?>"/>
							<input type="hidden" name="action" value="import_widget_data"/>
							<div class="title">
								<p class="widget-selection-error">*Select which widgets you wish to import</p>
								
								<div class="clear"></div>
							</div>
							<div class="sidebars">
								<?php
								if ( isset( $json_data[0] ) ) :
									foreach ( self::order_sidebar_widgets( $json_data[0] ) as $sidebar_name => $widget_list ) :
										if ( count( $widget_list ) == 0 ) {
											continue;
										}
										$sidebar_info = self::get_sidebar_info( $sidebar_name );
										if ( $sidebar_info ) : ?>
											<div class="sidebar">
												<h4><?php echo $sidebar_info['name']; ?></h4>

												<div class="widgets">
													<?php
													foreach ( $widget_list as $widget ) :
														$widget_options = false;

														$widget_type = trim( substr( $widget, 0, strrpos( $widget, '-' ) ) );
														$widget_type_index = trim( substr( $widget, strrpos( $widget, '-' ) + 1 ) );
														foreach ( $json_data[1] as $name => $option ) {
															if ( $name == $widget_type ) {
																$widget_type_options = $option;
																break;
															}
														}
														if ( !isset($widget_type_options) || !$widget_type_options )
															continue;

														$widget_title = isset( $widget_type_options[$widget_type_index]['title'] ) ? $widget_type_options[$widget_type_index]['title'] : '';
														$widget_options = $widget_type_options[$widget_type_index];
														?>
														<div class="import-form-row">
															<input class="<?php echo ($sidebar_name == 'wp_inactive_widgets') ? 'inactive' : 'active'; ?> widget-checkbox" checked type="checkbox" name="<?php echo esc_attr( printf('widgets[%s][%d]', $widget_type, $widget_type_index) ); ?>" id="<?php echo esc_attr( 'meta_' . $widget ); ?>" />
															<label for="meta_<?php echo esc_attr( 'meta_' . $widget ); ?>">&nbsp;
																<?php
																	echo ucfirst( $widget_type );
																	if( !empty( $widget_title ) )
																		echo ' - ' . $widget_title;
																?>
															</label>
														</div>
													<?php endforeach; ?>
												</div> <!-- end widgets -->
											</div> <!-- end sidebar -->
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</div> <!-- end sidebars -->
					</div>

			</div> <!-- end wrap -->
		
		<?php
	}

	public static function parse_import_data( $import_array ) {
		$sidebars_data = $import_array[0];
		$widget_data = $import_array[1];
		$current_sidebars = get_option( 'sidebars_widgets' );
		$new_widgets = array( );
		
		foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

			foreach ( $import_widgets as $import_widget ) :
				//if the sidebar exists

					$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
					$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
					$current_widget_data = get_option( 'widget_' . $title );
					$new_widget_name = self::get_new_widget_name( $title, $index );
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

	/**
	 * Output the JSON for download
	 */
	public static function export_widget_settings() {
		// @TODO check something better than just $_POST
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'export_widget_settings' ){
			header( "Content-Description: File Transfer" );
			header( "Content-Disposition: attachment; filename=widget_data.json" );
			header( "Content-Type: application/octet-stream" );
			echo self::parse_export_data( $_POST );
			exit;
		}
	}

	/**
	 * Parse JSON import file and load
	 */
	public static function ajax_import_widget_data($file) {
		$response = array(
			'what' => 'widget_import_export',
			'action' => 'import_submit'
		);
		

		$json_data = file_get_contents( $file );
		$json_data = json_decode( $json_data, true );
		$sidebar_data = $json_data[0];
		$widget_data = $json_data[1];
		foreach ( $sidebar_data as $title => $sidebar ) {
			$count = count( $sidebar );
			for ( $i = 0; $i < $count; $i++ ) {
				$widget = array( );
				$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
				$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
				if ( !isset( $widget_data[$widget['type']][$widget['type-index']] ) ) {
					unset( $sidebar_data[$title][$i] );
				}
			}
			$sidebar_data[$title] = array_values( $sidebar_data[$title] );
		}

		foreach ( $widget_data as $widget_title => $widget_value ) {
			foreach ( $widget_value as $widget_key => $widget_value ) {
				$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
			}
		}

		$sidebar_data = array( array_filter( $sidebar_data ), $widgets );
		$response['id'] = ( self::parse_import_data( $sidebar_data ) ) ? true : new WP_Error( 'widget_import_submit', 'Unknown Error' );
		

	}

	/**
	 * Read uploaded JSON file
	 * @return type
	 */
	public static function get_widget_settings_json($file) {
		$widget_settings = $file;


		$file_contents = file_get_contents( $widget_settings );
		return array( $file_contents, $widget_settings );
	}

	/**
	 * Upload JSON file
	 * @return boolean
	 */
	public static function upload_widget_settings_file($file) {
		if ( isset( $file ) ) {
			add_filter( 'upload_mimes', array( __CLASS__, 'json_upload_mimes' ) );

			$upload = wp_handle_upload( $file, array( 'test_form' => false ) );

			remove_filter( 'upload_mimes', array( __CLASS__, 'json_upload_mimes' ) );
			return $upload;
		}

		return false;
	}

	/**
	 *
	 * @param string $widget_name
	 * @param string $widget_index
	 * @return string
	 */
	public static function get_new_widget_name( $widget_name, $widget_index ) {
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

	/**
	 *
	 * @global type $wp_registered_sidebars
	 * @param type $sidebar_id
	 * @return boolean
	 */
	public static function get_sidebar_info( $sidebar_id ) {
		global $wp_registered_sidebars;

		//since wp_inactive_widget is only used in widgets.php
		if ( $sidebar_id == 'wp_inactive_widgets' )
			return array( 'name' => 'Inactive Widgets', 'id' => 'wp_inactive_widgets' );

		foreach ( $wp_registered_sidebars as $sidebar ) {
			if ( isset( $sidebar['id'] ) && $sidebar['id'] == $sidebar_id )
				return $sidebar;
		}

		return false;
	}

	/**
	 *
	 * @param array $sidebar_widgets
	 * @return type
	 */
	public static function order_sidebar_widgets( $sidebar_widgets ) {
		$inactive_widgets = false;

		//seperate inactive widget sidebar from other sidebars so it can be moved to the end of the array, if it exists
		if ( isset( $sidebar_widgets['wp_inactive_widgets'] ) ) {
			$inactive_widgets = $sidebar_widgets['wp_inactive_widgets'];
			unset( $sidebar_widgets['wp_inactive_widgets'] );
			$sidebar_widgets['wp_inactive_widgets'] = $inactive_widgets;
		}

		return $sidebar_widgets;
	}

	/**
	 * Add mime type for JSON
	 * @param array $existing_mimes
	 * @return string
	 */
	public static function json_upload_mimes( $existing_mimes = array( ) ) {
		$existing_mimes['json'] = 'application/json';
		return $existing_mimes;
	}

}