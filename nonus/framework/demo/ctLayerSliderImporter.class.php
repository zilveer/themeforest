<?php
/**
 * Import Layer Slider
 */
class ctLayerSliderImporter {

	/**
	 * Get path to exported settings
	 * @author alex
	 * @return array
	 */
	public static function getSliderConfigs() {
		$dir = ctImport::getDemoContentBaseDir() . '/layer_slider*.json';
		$r = glob($dir);

		if($r === false){
			return array();
		}
		return $r;
	}

	/**
	 * Import settings
	 * @param null $path
	 */
	public function import($path = null) {
		if (self::isPluginActive()) {
			foreach (self::getSliderConfigs() as $config) {
				$this->importSlider($config);
			}
		}
	}

	/**
	 * Is revolution slider active?
	 * @return bool
	 */

	public static function isPluginActive() {
		return function_exists('layerslider_register_settings');
	}

	/**
	 * Adds recommendation to user
	 */

	public static function addRecommendation($html) {
		if (self::getSliderConfigs()) {
			//we have configs
			if (!self::isPluginActive()) {
				$html = $html!=''?$html:'';
				$html .= '<p>This theme comes with <strong>preconfigured</strong> Layer Slider gallery. Please <strong>install and activate</strong> Layer Slider in order to import gallery. If you are not interested in using Layer Slider please discard this message.</strong></p>';
			}
		}

		return $html;
	}

	/**
	 * Import slider
	 * @param $config
	 * @throws Exception
	 * @return array
	 */
	protected function importSlider($config) {
		// Get decoded file data
		$data = base64_decode(file_get_contents($config));
		// Parsing JSON or PHP object
		if (!$parsed = json_decode($data, true)) {
			$parsed = unserialize($data);
		}
		try {

			// Iterate over imported sliders
			if (!is_array($parsed)) {
				throw new Exception('Invalid file');
			}

			//  DB stuff
			global $wpdb;
			$table_name = $wpdb->prefix . "layerslider";

			// Import sliders
			foreach ($parsed as $item) {
				$wpdb->query(
					$wpdb->prepare("INSERT INTO $table_name (name, data, date_c, date_m)
									VALUES (%s, %s, %d, %d)",
						$item['properties']['title'], json_encode($item), time(), time()
					)
				);
			}
		} catch (Exception $e) {
			if (WP_DEBUG) {
				throw $e;
			}
		}
	}

}