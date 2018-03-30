<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_featured_text_full_width_parallax_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_featured_text_full_width_parallax_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Featured Text Full Width Parallax", 'crazyblog' ),
				"base" => "crazyblog_featured_text_full_width_parallax_output",
				"icon" => crazyblog_URI . '',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Title', 'crazyblog' ),
						"param_name" => "title",
						"description" => esc_html__( 'Enter the title for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Sub Title', 'crazyblog' ),
						"param_name" => "sub_title",
						"description" => esc_html__( 'Enter the sub title for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Button Text', 'crazyblog' ),
						"param_name" => "btn_txt",
						"description" => esc_html__( 'Enter the button text for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Button Link', 'crazyblog' ),
						"param_name" => "btn_link",
						"description" => esc_html__( 'Enter the button link for this section', 'crazyblog' )
					),
				),
			);
		}
	}

	public static function crazyblog_featured_text_full_width_parallax_output( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		?>
		<div class="fashion-parallax">
			<span><?php echo wp_kses_post( $title ) ?></span>
			<strong><?php echo wp_kses_post( $sub_title ) ?></strong>
			<?php if ( !empty( $btn_txt ) ): ?>
				<a class="simple-btn" href="<?php echo esc_url( $btn_link ) ?>" title=""><?php echo esc_html( $btn_txt ) ?></a>
			<?php endif; ?>
		</div>
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
