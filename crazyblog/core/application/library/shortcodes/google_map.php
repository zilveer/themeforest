<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Google_Map_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_google_map_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Google Map", 'crazyblog' ),
				"base" => "crazyblog_google_map",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/Google-Map.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						
						"class" => "",
						"heading" => esc_html__( 'Longitude', 'crazyblog' ),
						"param_name" => "longitude",
						"description" => esc_html__( 'Enter the longitude for google map', 'crazyblog' ),
					),
					array(
						"type" => "textfield",
						
						"class" => "",
						"heading" => esc_html__( 'Latitude', 'crazyblog' ),
						"param_name" => "latitude",
						"description" => esc_html__( 'Enter the latitude for google map', 'crazyblog' ),
					),
					array(
						"type" => "textfield",
						
						"class" => "",
						"heading" => esc_html__( 'Zoom Level', 'crazyblog' ),
						"param_name" => "zoom_level",
						"description" => esc_html__( 'Enter the zoom level for google map', 'crazyblog' ),
					),
				)
			);
		}
	}

	public static function crazyblog_google_map( $atts = null, $content = null ) {

		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';

		ob_start();
		?>



		<div class="map">

			<div id="map-canvas" style="height:px;"></div>

		</div>

                <?php wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp', '','',true)?>
                
                <?php 
                    $google_map = 'var map;
                        function initialize() {
                                var mapOptions = {
                                        zoom:1, 
                                        scrollwheel: false,
                                        center: new google.maps.LatLng('.esc_js( $longitude ).','.esc_js( $latitude ).')
                                };
                                map = new google.maps.Map(document.getElementById("map-canvas"),
                                                mapOptions);
                        }
                        google.maps.event.addDomListener(window, "load", initialize);';
                        wp_add_inline_script('google-map', $google_map);
                    ?>

		

		<?php
		$output = ob_get_contents();

		ob_clean();

		return $output;
	}

}
