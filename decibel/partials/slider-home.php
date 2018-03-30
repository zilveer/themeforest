<?php
/**
 * Home page featured post slider
 */

$loop = wolf_get_slide_loop();

$slider_speed = wolf_get_theme_option( 'slider_speed' ) ? absint( wolf_get_theme_option( 'slider_speed' ) ) : 5000;
$pause_on_hover = wolf_get_theme_option( 'slider_speed' ) ?  'true' : 'false';
$slideshow = wolf_get_theme_option( 'slider_autoplay' ) ?  'true' : 'false';
/* The loop */ ?>
<?php if ( $loop->have_posts() ) : ?>
	<script type="text/javascript">
		jQuery( document ).ready(function(){
			var defaultTransition = ( Modernizr.isTouch ) ? 'slide' : 'fade',
				homeSliderTransition = WolfThemeParams.sliderEffect;
			if ( 'auto' === WolfThemeParams.sliderEffect ) {
				homeSliderTransition = defaultTransition;
			}
			jQuery( '#featured-post-wolf-slider' ).wolfslider( {
				animation: 'fade',
				slideshow : <?php echo esc_attr( $slideshow ); ?>,
				pauseOnHover: <?php echo esc_attr( $pause_on_hover ); ?>,
				slideshowSpeed : <?php echo absint( $slider_speed ); ?>
			} );
		} );
	</script>
	<div class="wolf-slider-container content-light-font">
		<div id="featured-post-wolf-slider" class="wolf-slider flexslider">
			<ul class="slides">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); 
			?>
				<?php $img_url = wolf_get_post_thumbnail_url( 'extra-large' ); ?>
				<li class="slide wolf-slide slide-<?php echo esc_attr( get_post_type() ); ?> wolf-slide-text-align-left caption-valign-middle" id="post-slide-<?php the_ID(); ?>">
					<span class="wolf-slide-bg parallax-inner" style="background:url('<?php echo esc_url( $img_url ); ?>') 50% 50% no-repeat; background-size:cover;"></span>
					<span class="header-overlay"></span>
					<?php get_template_part( 'partials/slider-home', 'caption' ); ?>
				</li>
			<?php endwhile; wp_reset_postdata(); ?>
			</ul>
		</div>
	</div>
<?php endif; ?>