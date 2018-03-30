<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_sponsers_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_sponsers_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Sponsers", 'crazyblog' ),
				"base" => "crazyblog_sponsers_output",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/About-Us-Custom-Contents.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "attach_images",
						"class" => "",
						"heading" => esc_html__( 'Upload Images', 'crazyblog' ),
						"param_name" => "images",
						"description" => esc_html__( 'Upload sponsers images', 'crazyblog' )
					),
				),
			);
		}
	}

	public static function crazyblog_sponsers_output( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$image = explode( ',', $images );
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
		?>
		<div class="sponsor-sec">
			<div class="sponsor-carousel">
				<?php
				if ( !empty( $image ) && count( $image ) > 0 ) {
					foreach ( $image as $i ) {
						$src = wp_get_attachment_image_src( $i, 'full' );
						echo '<div class="sponsor-div"><a href="#" title=""><img src="' . esc_url( crazyblog_set( $src, '0' ) ) . '" alt="" /></a></div>';
					}
				}
				?>
			</div>
		</div>
		<?php 
                    $custom_script = 'jQuery(document).ready(function ($) {
				$(".sponsor-carousel").owlCarousel({
					autoplay: false,
					autoplayTimeout: 2500,
					smartSpeed: 2000,
					autoplayHoverPause: true,
					loop: false,
					items: 5,
					dots: false,
					nav: true,
					margin: 20,
					singleItem: true,
					autoHeight: true,
					responsiveClass: true,
					responsive: {
						0: {items: 2},
						480: {items: 3},
						900: {items: 4},
						1200: {items: 5}
					}
				});
			});';
		wp_add_inline_script('crazyblog_df-owl', $custom_script);
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
