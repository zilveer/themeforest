<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_space_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_space_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Crazyblog Space", 'crazyblog' ),
				"base" => "crazyblog_space",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/About-Us-Custom-Contents.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						
						"class" => "",
						"heading" => esc_html__( "Margin:", 'crazyblog' ),
						"param_name" => "margin",
						"value" => "",
						"description" => esc_html__( "Enter margin from top and bottom of this shortcode.", 'crazyblog' ),
					),
				)
			);
		}
	}

	public static function crazyblog_space( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$height = (!empty( $margin )) ? $margin : 70;
		?>
		<div style="float:left; width: 100%; height: <?php echo esc_attr( $height ) ?>px"></div>

		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
