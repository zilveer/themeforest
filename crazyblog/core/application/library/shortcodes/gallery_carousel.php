<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_gallery_carousel_VC_ShortCode extends crazyblog_VC_ShortCode {

	static $counter = 0;

	public static function crazyblog_gallery_carousel_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Gallery Carousel", 'crazyblog' ),
				"base" => "crazyblog_gallery_carousel",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/gallery-carousel.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Gallery Post', 'crazyblog' ),
						"param_name" => "selected_post",
						"value" => crazyblog_get_posts_array( 'crazyblog_gallery', true ),
						"description" => esc_html__( 'Choose one post to show your gallery', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Show Social", 'crazyblog' ),
						"param_name" => "show_social",
						"value" => array_flip( array( 'true' => esc_html__( 'True', 'crazyblog' ), 'false' => esc_html__( 'False', 'crazyblog' ) ) ),
						"description" => esc_html__( "Hide/Show social icon on gallery carousel", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_gallery_carousel( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl', 'df-poptrox' ) );
		$args = array(
			'post_type' => 'crazyblog_gallery',
			'post_status' => 'publish',
			'p' => $selected_post,
		);
		$query = new WP_Query( $args );
		$settings = crazyblog_opt();
		$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
		?>

		<div class="gallery-footer">
			<?php if ( !empty( $social ) && $show_social == "true" ) : ?>
				<div class="footer-links">
					<?php foreach ( $social as $s ) : ?>
						<a href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>" title="" style="background:<?php echo esc_attr( crazyblog_set( $s, 'icon_color' ) ); ?>"><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i><span><?php echo esc_html( crazyblog_set( $s, 'icon_title' ) ); ?></span></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<div id="gallery-carousel<?php echo esc_attr( self::$counter ) ?>" class="gallery-carousel">
				<?php
				if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
						$post_meta = get_post_meta( get_the_ID(), 'crazyblog_crazyblog_gallery_meta', true );
						$gallery = explode( ",", crazyblog_set( crazyblog_set( crazyblog_set( $post_meta, 'galleries_setting' ), '0' ), 'gallery_opt' ) );

						if ( !empty( $gallery ) ) : foreach ( $gallery as $g ) :
								$image_url = crazyblog_set( wp_get_attachment_image_src( $g, 'crazyblog_376x350' ), '0' );
								?>
								<div class="gallery-item">
									<img alt="" src="<?php echo esc_url( $image_url ); ?>">
									<a href="<?php echo esc_url( wp_get_attachment_url( $g ) ); ?>" title="" ><i class="fa fa-search"></i></a>
								</div>
								<?php
							endforeach;
						endif;
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>

		<?php 
		    $custom_script = 'jQuery(document).ready(function ($) {

		        var foo = jQuery("#gallery-carousel'.esc_js( self::$counter ).'");
		        foo.poptrox({
		            usePopupNav: true,
		        });
		        jQuery(".gallery-carousel").owlCarousel({
		            autoplay: true,
		            autoplayTimeout: 2500,
		            smartSpeed: 2000,
		            autoplayHoverPause: true,
		            loop: true,
		            dots: false,
		            nav: false,
		            margin: 0,
		            mouseDrag: true,
		            autoHeight: true,
		            items: 6,
		            responsive: {
		                1200: {items: 6},
		                980: {items: 4},
		                768: {items: 3},
		                480: {items: 2},
		                0: {items: 1}
		            }
		        });
		    });'; 
                wp_add_inline_script('crazyblog_df-owl', $custom_script);
		self::$counter++;
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
