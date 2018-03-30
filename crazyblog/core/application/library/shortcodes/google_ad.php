<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_google_ad_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_google_ad_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Ad Banner", 'crazyblog' ),
				"base" => "crazyblog_google_ad",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/ad-Banner.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Ad Type:", 'crazyblog' ),
						"param_name" => "ad_type",
						"value" => array(
							esc_html__( 'Google AdSens', 'crazyblog' ) => 'google_ad',
							esc_html__( 'Self Ad', 'crazyblog' ) => 'self'
						),
						"description" => esc_html__( "Choose Anyone method for ad.", 'crazyblog' )
					),
					array(
						"type" => "attach_image",
						"class" => "",
						"heading" => esc_html__( "Ad Image", 'crazyblog' ),
						"param_name" => "ad_image",
						"value" => '',
						"description" => esc_html__( "Upload Ad Image", 'crazyblog' ),
						'dependency' => array(
							'element' => 'ad_type',
							'value' => 'self',
						),
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Image Link:", 'crazyblog' ),
						"param_name" => "image_link",
						"value" => "",
						"description" => esc_html__( "Enter Ad Link.", 'crazyblog' ),
						'dependency' => array(
							'element' => 'ad_type',
							'value' => 'self',
						),
					),
					array(
						"type" => "textarea_raw_html",
						"class" => "",
						"heading" => esc_html__( "Google Code:", 'crazyblog' ),
						"param_name" => "google_code",
						"value" => "",
						"description" => esc_html__( "Enter Google AdSens Code.", 'crazyblog' ),
						'dependency' => array(
							'element' => 'ad_type',
							'value' => 'google_ad',
						),
					),
				)
			);
		}
	}

	public static function crazyblog_google_ad( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$ad_img = wp_get_attachment_image_src( $ad_image, '750x90' );
		?>
		<?php if ( $ad_type == "self" ) : ?>
			<div class="centred">
				<a href="<?php echo esc_url( $image_link ); ?>" title=""><img alt="" src="<?php echo esc_url( crazyblog_set( $ad_img, '0' ) ); ?>"></a>
			</div>
		<?php elseif ( $ad_type == "google_ad" ) : ?>
			<div class="centred">
				<?php
				if ( function_exists( 'crazyblog_crazyblog_decrypt' ) ) {
					echo rawurldecode( crazyblog_crazyblog_decrypt( $google_code ) );
				}
				?>
			</div>
		<?php endif; ?>


		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
