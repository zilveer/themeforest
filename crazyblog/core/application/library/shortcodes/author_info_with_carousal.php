<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_author_info_with_carousal_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_author_info_with_carousal_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Author Info With Carousal", 'crazyblog' ),
				"base" => "crazyblog_author_info_with_carousal",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/one-features-post.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"as_parent" => array( 'only' => 'crazyblog_author_info_with_carousal_block' ),
				"content_element" => true,
				"show_settings_on_create" => true,
				"is_container" => true,
				"params" => array(
					array(
						"type" => "attach_image",
						"class" => "",
						"heading" => esc_html__( 'Background Image', 'crazyblog' ),
						"param_name" => "bg",
						"description" => esc_html__( 'Upload Background Image for this image', 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_author_info_with_carousal( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$src = (!empty( $bg )) ? wp_get_attachment_image_url( $bg, 'full' ) : '';
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
		?>
		<div class="featured-textcarousel">
			<img src="<?php echo esc_url( $src ) ?>" alt="" />
			<div class="text-carousel">
				<?php echo wp_kses_post( $contents ); ?>
			</div>
		</div>
		<?php $text_carousel = 'jQuery(document).ready(function ($) {
				$(".text-carousel").owlCarousel({
					autoplay: true,
					autoplayTimeout: 2500,
					smartSpeed: 2000,
					autoplayHoverPause: true,
					loop: false,
					dots: false,
					nav: false,
					margin: 0,
					mouseDrag: true,
					singleItem: true,
					autoHeight: true,
					items: 1,
					animateIn: "fadeIn",
					animateOut: "fadeOut"
				});
			});';
                        wp_add_inline_script('crazyblog_df-owl', $text_carousel);
		$output = ob_get_contents();
		ob_clean();
		return do_shortcode( $output );
	}

}
