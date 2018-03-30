<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_featured_area_recipes_carousel_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_featured_area_recipes_carousel_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Featured Area Recipes Carousel", 'crazyblog' ),
				"base" => "crazyblog_featured_area_recipes_carousel_output",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/About-Us-Custom-Contents.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "attach_images",
						"class" => "",
						"heading" => esc_html__( 'Upload Images', 'crazyblog' ),
						"param_name" => "images",
						"description" => esc_html__( 'Upload featured images for this carousel', 'crazyblog' )
					),
					array(
						"type" => "attach_image",
						"heading" => esc_html__( 'Upload Icon', 'crazyblog' ),
						"param_name" => "icon",
						"description" => esc_html__( 'Upload Icon images for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Title', 'crazyblog' ),
						"param_name" => "title",
						"description" => esc_html__( 'Enter the title for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Sub Title', 'crazyblog' ),
						"param_name" => "sub_title",
						"description" => esc_html__( 'Enter the sub title for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( '2nd Sub Title', 'crazyblog' ),
						"param_name" => "secound_sub_title",
						"description" => esc_html__( 'Enter the 2nd sub title for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Button Text', 'crazyblog' ),
						"param_name" => "btn_txt",
						"description" => esc_html__( 'Enter the search button text', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Button Link', 'crazyblog' ),
						"param_name" => "btn_link",
						"description" => esc_html__( 'Enter the button link', 'crazyblog' )
					),
				),
			);
		}
	}

	public static function crazyblog_featured_area_recipes_carousel_output( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$image = explode( ',', $images );
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
		$iconSrc = wp_get_attachment_image_src( $icon, 'full' );
		$loop = (count( $image ) > 0) ? 'true' : 'false';
		?>
		<div class="main-carousel">
			<div class="img-carousel">
				<?php
				if ( !empty( $image ) && count( $image ) > 0 ) {
					foreach ( $image as $i ) {
						echo '<div class="carouselimg-div">';
						$src = wp_get_attachment_image_src( $i, 'full' );
						echo '<img src="' . esc_url( crazyblog_set( $src, '0' ) ) . '" alt="" />';
						echo '</div>';
					}
				}
				?>
			</div>
			<div class="carousel-cap">
				<span class="icon"><img src="<?php echo esc_url( crazyblog_set( $iconSrc, '0' ) ) ?>" alt="" /></span>
				<span class="sub-head"><?php echo esc_html( $sub_title ) ?></span>
				<h2><?php echo esc_html( $title ) ?></h2>
				<i><?php echo esc_html( $secound_sub_title ) ?></i>
				<?php if ( !empty( $btn_txt ) ): ?>
					<span class="btn1">
						<a href="<?php echo esc_url( $btn_link ) ?>" title=""><?php echo esc_html( $btn_txt ) ?></a>
					</span>
				<?php endif; ?>
			</div>
		</div>
		<?php 
		    $custom_script = 'jQuery(document).ready(function ($) {
		        $(".img-carousel").owlCarousel({
		            autoplay: true,
		            autoplayTimeout: 2500,
		            smartSpeed: 2000,
		            autoplayHoverPause: true,
		            loop: '.esc_js( $loop ).',
		            dots: false,
		            nav: true,
		            margin: 0,
		            mouseDrag: true,
		            singleItem: true,
		            autoHeight: true,
		            items: 1
		        });
		    });';
                    wp_add_inline_script('crazyblog_df-owl', $custom_script);
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
