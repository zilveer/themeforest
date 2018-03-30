<?php
/**
 * Brands Carousel
 *
 * @author 		Transvelo
 * @package 	Unicase/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$carouselID = uniqid();
?>
<!-- ============================================================= SECTION - BRANDS ============================================================= -->
<section class="brands-carousel">

	<?php if( apply_filters( 'unicase_show_brands_carousel_title', TRUE ) ) : ?>
	<h3 class="section-title"><?php echo apply_filters( 'unicase_brands_carousel_title', $title ); ?></h3>
	<?php endif; ?>

	<div id="owl-brands-<?php echo esc_attr( $carouselID ); ?>" class="owl-brands owl-carousel unicase-owl-carousel owl-outer-nav">
		
		<?php foreach ( $terms as $term ) :	?>
		
		<div class="item">
			<figure>
				<figcaption class="text-overlay">
					<div class="info">
						<h4><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a></h4>
					</div><!-- /.info -->
				</figcaption>
			<?php 
				$thumbnail_id 	= get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );

				if ( $thumbnail_id ) {
					$image_attributes = wp_get_attachment_image_src( $thumbnail_id, 'full' );
					
					if( $image_attributes ) {
						$image_src = $image_attributes[0];
					}
				} else {
					$image_src = wc_placeholder_img_src();
				}

				$image_src = str_replace( ' ', '%20', $image_src ); 
			?>
				<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" class="img-responsive">
			</figure>
		</div><!-- /.item -->

		<?php endforeach; ?>
		
	</div><!-- /.owl-carousel -->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#owl-brands-<?php echo esc_attr( $carouselID ); ?>").owlCarousel({
			    autoplayHoverPause: true,
			    navRewind: true,
			    items: 5,
			    <?php if( is_rtl() ) : ?>
                rtl: true,
                <?php endif; ?>
			    dots: false,
			    nav : true,
			    navText: ["", ""],
			    stagePadding: 1,
			    <?php if( $disable_touch_drag ) : ?>
                touchDrag: false,
                <?php endif; ?>
			    responsive:{
			        0:{
			            items:1,
			        },
			        600:{
			            items:2,
			        },
			        1000:{
			            items:5,
			        }
			    }
			});
		});
	</script>
</section>
<!-- ============================================================= SECTION - BRANDS : END ============================================================= -->