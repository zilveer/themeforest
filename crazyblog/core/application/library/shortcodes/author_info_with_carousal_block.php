<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_author_info_with_carousal_block_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_author_info_with_carousal_block_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Block", 'crazyblog' ),
				"base" => "crazyblog_author_info_with_carousal_block",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/one-features-post.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"as_child" => array( 'only' => 'crazyblog_author_info_with_carousal' ),
				"content_element" => true,
				"show_settings_on_create" => true,
				"is_container" => true,
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Title', 'crazyblog' ),
						"param_name" => "title",
						"description" => esc_html__( 'Enter the title', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Sub Title', 'crazyblog' ),
						"param_name" => "subtitle",
						"description" => esc_html__( 'Enter the sub title', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Facebook Link", 'crazyblog' ),
						"param_name" => "fb_link",
						"description" => esc_html__( "Enter Facebook Profile link", 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Twitter Link", 'crazyblog' ),
						"param_name" => "tw_link",
						"description" => esc_html__( "Enter Twitter Profile link", 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Google Plus Link", 'crazyblog' ),
						"param_name" => "gp_link",
						"description" => esc_html__( "Enter Google Plus Profile link", 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Pinterest Link", 'crazyblog' ),
						"param_name" => "rd_link",
						"description" => esc_html__( "Enter pinterest Profile link", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_author_info_with_carousal_block( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		?>
		<div class="carousel-data">
			<h2><?php echo esc_html( $title ) . '<span>' . esc_html( $subtitle ) . '</span>'; ?></h2>
			<ul class="textcarousel-social">
				<?php if ( !empty( $fb_link ) ): ?><li><a href="<?php echo esc_url( $fb_link ) ?>" title=""><i class="fa fa-facebook"></i></a></li><?php endif; ?>
				<?php if ( !empty( $tw_link ) ): ?><li><a href="<?php echo esc_url( $tw_link ) ?>" title=""><i class="fa fa-twitter"></i></a></li><?php endif; ?>
				<?php if ( !empty( $gp_link ) ): ?><li><a href="<?php echo esc_url( $gp_link ) ?>" title=""><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
				<?php if ( !empty( $rd_link ) ): ?><li><a href="<?php echo esc_url( $rd_link ) ?>" title=""><i class="fa fa-pinterest"></i></a></li><?php endif; ?>
			</ul>
		</div>
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
