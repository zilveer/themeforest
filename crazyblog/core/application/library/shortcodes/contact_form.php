<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_contact_form_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_contact_form_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Contact Form", 'crazyblog' ),
				"base" => "crazyblog_contact_form",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/contact-form.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Select Form", 'crazyblog' ),
						"param_name" => "form",
						"value" => array_flip( crazyblog_get_posts_array( 'crazyblog_forms', false ) ),
						"description" => esc_html__( "Select form to show in contact section", 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Form Title', 'crazyblog' ),
						"param_name" => "form_title",
						"description" => esc_html__( 'Enter Form Title', 'crazyblog' ),
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Show Map:", 'crazyblog' ),
						"param_name" => "show_map",
						"value" => array(
							esc_html__( 'True', 'crazyblog' ) => 'true',
							esc_html__( 'False', 'crazyblog' ) => 'false',
						),
						"description" => esc_html__( "Make it true to show map with contact form", 'crazyblog' )
					),
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

	public static function crazyblog_contact_form( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		?>
		<div class="contact-page">
			<div class="row">
				<div class="<?php echo esc_attr( ($show_map == "true") ? "col-md-7" : "col-md-12"  ); ?>">
					<?php
					echo '<div class="comment-form">';
					echo '<h4 class="simple-heading">' . esc_html( $form_title ) . '</h4>';
					do_shortcode( '[crazyblog_form id="' . $form . '"]' );
					echo '</div>';
					?>
				</div>
				<?php if ( $show_map == "true" ) : ?>
					<div class="col-md-5">
						<div class="map">
							<div id="map-canvas"></div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( $show_map == "true" ) : ?>
			<?php wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp', '', '', true ) ?>
			<?php $zoom_attr = esc_js( ($zoom_level) ? 'zoom:' . esc_js( $zoom_level ) . ',' : ''  ); ?>
			<?php
			$google_map = 'var map;
				function initialize() {
					var mapOptions = {
                                                ' . $zoom_attr . '
						scrollwheel: false,
						center: new google.maps.LatLng(' . esc_js( $longitude ) . ',' . esc_js( $latitude ) . ')
					};
					map = new google.maps.Map(document.getElementById("map-canvas"),
							mapOptions);
				}
				google.maps.event.addDomListener(window, "load", initialize);';
			wp_add_inline_script( 'google-map', $google_map );
			?>
		<?php endif; ?>
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
