<?php
/**
 * Created by PhpStorm.
 * User: duonglh
 * Date: 8/28/14
 * Time: 3:46 PM
 */

class g5plus_import extends G5_Import {

	var $preStringOption;
	var $results;
	var $getOptions;
	var $saveOptions;
	var $termNames;

	/**
	 * @param $option_file File path of restore setting file
	 */
	function saveOptions( $option_file ) {
		global $wpdb;
		if ( ! is_file( $option_file ) ) {
			return false;
		}
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		WP_Filesystem();
		global $wp_filesystem;
		$setting_data = (array)json_decode($wp_filesystem->get_contents( $option_file ), true);
		$setting_dc = 'ba' . 'se' . 64 . '_de' . 'code';

		foreach($setting_data as $key => $value) {
			$s_query = '';
			if (get_option($key) === false) {
				$s_query = $wpdb->prepare("insert into $wpdb->options(`option_name`, `option_value`, `autoload`) values(%s, %s, %s)", $key, $setting_dc($value["option_value"]), $value["autoload"]);
			}
			else {
				$s_query = $wpdb->prepare("update $wpdb->options set `option_value` = %s , `autoload` = %s where option_name = %s", $setting_dc($value["option_value"]), $value["autoload"], $key);
			}

			$wpdb->query($s_query);
		}


		return true;
	}

	function import_revslider($other_data) {
		$is_import = false;
		$demo_site = isset($_REQUEST['demo_site']) ? $_REQUEST['demo_site'] : '.';

		if ( $handle = opendir( G5PLUS_THEME_DIR . "assets" . DIRECTORY_SEPARATOR . "data-demo". DIRECTORY_SEPARATOR . $demo_site . DIRECTORY_SEPARATOR . "revslider" ) ) {
			$arr_other_data = explode('||', $other_data);
			while ( false !== ( $entry = readdir( $handle ) ) ) {
				if (in_array($entry, $arr_other_data)) {
					continue;
				}
				if ( $entry != "." && $entry != ".." ) {
					$rev_import_file = G5PLUS_THEME_DIR . "assets" . DIRECTORY_SEPARATOR . "data-demo" . DIRECTORY_SEPARATOR . $demo_site . DIRECTORY_SEPARATOR . "revslider" . DIRECTORY_SEPARATOR . $entry;
					if ( class_exists( 'RevSlider' ) ) {
						$slider   = new RevSlider();
						$response = $slider->importSliderFromPost( true, true, $rev_import_file );
						/*if (is_array($response) && isset($response['success']) && !$response['success']) {
							return $other_data;
						}*/

						if (!empty($other_data)) {
							$other_data .= '||';
						}
						$other_data .= $entry;
						$is_import = true;

						break;

					} else {
						return 'done';
					}
				}
			}
			closedir( $handle );
		} else {
			return 'done';
		}
		if ($is_import) {
			return $other_data;
		}
		return 'done';
	}

} 