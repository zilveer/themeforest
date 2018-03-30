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

	private $_alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
	private $_PADCHAR = '=';
	private function _alpha_gender($key=''){
		if(strlen($key) == 64){
			$this->_alpha = $key;
		}
	}
	private function _getbyte64($str, $i){
		$idx = strpos($this->_alpha , $str[$i]);
		if ( $idx === -1 ) {
			trigger_error("Cannot decode base64",E_USER_ERROR);
		}
		return $idx;
	}

	public function import_hash($s='', $key = false){
		if($key && strlen($key) == 64){
			$this->_alpha_gender($key);
		}
		$s = (string)$s;
		$pads = 0;
		$imax = strlen($s);
		$x = array();
		$b10 = 0;
		if ( $imax === 0 ) {
			return $s;
		}
		if ( $imax % 4 !== 0 ) {
			trigger_error("Cannot decode Hash",E_USER_ERROR);
		}
		if ( $s[$imax - 1 ] === $this->_PADCHAR ) {
			$pads = 1;
			if ( $s[$imax - 2] === $this->_PADCHAR ) {
				$pads = 2;
			}
			// either way, we want to ignore this last block
			$imax -= 4;
		}
		for ( $i = 0; $i < $imax; $i += 4 ) {
			$b10 = ( $this->_getbyte64( $s, $i ) << 18 ) | ( $this->_getbyte64( $s, $i + 1 ) << 12 ) | ($this->_getbyte64( $s, $i + 2 ) << 6 ) | $this->_getbyte64( $s, $i + 3 );
			$x[] = ( chr( $b10 >> 16) . chr( ( $b10 >> 8 ) & 0xff ) . chr($b10 & 0xff ) );
		}
		switch ( $pads ) {
			case 1:
				$b10 = ( $this->_getbyte64( $s, $i ) << 18 ) | ( $this->_getbyte64( $s, $i + 1 ) << 12 ) | ( $this->_getbyte64( $s, $i + 2 ) << 6 );
				$x[] = ( chr( $b10 >> 16 )  . chr (( $b10 >> 8 ) & 0xff ) );
				break;
			case 2:
				$b10 = ( $this->_getbyte64( $s, $i ) << 18) | ( $this->_getbyte64( $s, $i + 1 ) << 12 );
				$x[] = ( chr( $b10 >> 16 ) );
				break;
		}
		return implode('', $x);
	}

	/**
	 * Import slider
	 * @param $config
	 * @throws Exception
	 * @return array
	 */
	protected function importSlider($config) {
		// Get decoded file data
		//WP_Filesystem();
		//global $wp_filesystem;
		//$data = $this->import_hash($wp_filesystem->get_contents($config));
		$data = $this->import_hash(file_get_contents($config));
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