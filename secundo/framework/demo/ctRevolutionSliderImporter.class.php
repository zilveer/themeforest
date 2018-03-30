<?php

/**
 * Import revolution slider
 */
class ctRevolutionSliderImporter {

	/**
	 * Get path to exported settings
	 * @author alex
	 * @return array
	 */
	public static function getSliderConfigs() {
		$dir = ctImport::getDemoContentBaseDir() . '/revolution_slider*.zip';
		$r   = glob( $dir );

		if ( ! $r ) {

			//try legacy version
			$dir = ctImport::getDemoContentBaseDir() . '/revolution_slider*.txt';
			$r   = glob( $dir );
		}

		if ( $r === false ) {
			return array();
		}

		return $r;
	}

	/**
	 * Returns all sliders
	 * @return mixed
	 */

	protected function getAllSliders() {
		global $wpdb;
		$table_name = $wpdb->prefix . GlobalsRevSlider::TABLE_SLIDERS_NAME;

		return $wpdb->get_results( $wpdb->prepare("SELECT * FROM %s",$table_name), ARRAY_A );
	}

	/**
	 * Export sliders
	 */

	public function export() {
		if ( self::isPluginActive() ) {
			$sliders = $this->getAllSliders();

			foreach ( $sliders as $s ) {

				$slider = new RevSlider();
				$slider->initByID( $s['id'] );
				ob_start();
				if ( ! method_exists( $slider, 'exportSlider' ) ) {
					throw new Exception( "RevSlider exporter is not compatible with this version." );
				}
				$slider->exportSlider( false );
				header( 'Content-type: text/html' );
				header_remove( "Content-Disposition" );
				$data = ob_get_clean();
				//WP_Filesystem();
				//global $wp_filesystem;
				//$wp_filesystem->put_contents( ctImport::getDemoContentBaseDir() . '/revolution_slider_' . $s['alias'] . '.zip', $data );
				file_put_contents( ctImport::getDemoContentBaseDir() . '/revolution_slider_' . $s['alias'] . '.zip', $data );
			}
		}
	}

	/**
	 * Import settings
	 *
	 * @param null $path
	 */
	public function import( $path = null ) {
		if ( self::isPluginActive() ) {
			//remove notice about premium stuff
			update_option( 'revslider-valid-notice', 'false' );

			ob_start();
			foreach ( self::getSliderConfigs() as $config ) {
				$this->importSlider( $config );
			}
			ob_get_clean();//no output from sliders
		}
	}

	/**
	 * Is revolution slider active?
	 * @return bool
	 */

	public static function isPluginActive() {
		return class_exists( 'GlobalsRevSlider' );
	}

	/**
	 * Adds recommendation to user
	 */

	public static function addRecommendation( $html ) {
		if ( self::getSliderConfigs() ) {
			//we have configs
			if ( ! self::isPluginActive() ) {
				$html = $html != '' ? $html : '';
				$html .= '<p>This theme comes with <strong>preconfigured</strong> Revolution Slider gallery. Please <strong>install and activate</strong> Revolution Slider in order to import gallery. If you are not interested in using Revolution Slider please discard this message.</strong></p>';
			}
		}

		return $html;
	}

	/**
	 * Import slider
	 *
	 * @param $config
	 *
	 * @throws Exception
	 * @return array
	 */
	protected function importSlider( $config ) {
		if ( strpos( $config, '.zip' ) === false ) {
			return $this->importLegacyConfig( $config );
		}

		//let's import new version

		$slider = new RevSlider();

		$_FILES["import_file"]["tmp_name"] = $config;

		$slider->importSliderFromPost();
	}

	/**
	 * Imports old config
	 *
	 * @param $config
	 *
	 * @throws Exception
	 */

	protected function importLegacyConfig( $config ) {
		global $wpdb;
		//we take name/alias/shortcode from file name
		$name = str_replace( array( 'revolution_slider_', '.txt' ), '', basename( $config ) );


		$slider = new RevSlider();
		try {
			$sliderId = $slider->createSliderFromOptions( array(
				'main'   => array(
					'title' => $name,
					'alias' => $name
				),
				'params' => array()
			) );
		} catch ( Exception $e ) {
			//already exists - let's leave it as is
			return;
		}

		//create a slider
		try {
			$slider->initByID( $sliderId );

			//get content array
			//WP_Filesystem();
			//global $wp_filesystem;
			//$content   = @$wp_filesystem->get_contents( $config );
			$content   = @file_get_contents( $config );
			$arrSlider = @unserialize( $content );
			if ( empty( $arrSlider ) ) {
				UniteFunctionsRev::throwError( "Wrong export slider file format!" );
			}

			//update slider params

			$sliderParams              = $arrSlider["params"];
			$sliderParams["title"]     = $name;
			$sliderParams["alias"]     = $name;
			$sliderParams["shortcode"] = '[rev_slider ' . $name . ']';

			if ( isset( $sliderParams["background_image"] ) ) {
				$sliderParams["background_image"] = UniteFunctionsWPRev::getImageUrlFromPath( $sliderParams["background_image"] );
			}

			$json_params = json_encode( $sliderParams );
			$arrUpdate   = array( "params" => $json_params );
			$wpdb->update( GlobalsRevSlider::$table_sliders, $arrUpdate, array( "id" => $sliderId ) );

			//-------- Slides Handle -----------


			//create all slides
			$arrSlides = $arrSlider["slides"];
			foreach ( $arrSlides as $slide ) {

				$params = $slide["params"];
				$layers = $slide["layers"];

				//convert params images:
				if ( isset( $params["image"] ) ) {
					$params["image"] = UniteFunctionsWPRev::getImageUrlFromPath( $params["image"] );
				}

				//convert layers images:
				foreach ( $layers as $key => $layer ) {
					if ( isset( $layer["image_url"] ) ) {
						$layer["image_url"] = UniteFunctionsWPRev::getImageUrlFromPath( $layer["image_url"] );
						$layers[ $key ]     = $layer;
					}
				}

				//create new slide
				$arrCreate                = array();
				$arrCreate["slider_id"]   = $sliderId;
				$arrCreate["slide_order"] = $slide["slide_order"];
				$arrCreate["layers"]      = json_encode( $layers );
				$arrCreate["params"]      = json_encode( $params );

				$wpdb->insert( GlobalsRevSlider::$table_slides, $arrCreate );
			}

		} catch ( Exception $e ) {
			if ( WP_DEBUG ) {
				throw $e;
			}
		}

		return true;
	}

}