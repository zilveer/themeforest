<?php
/**
 * Single Gallery item template: slider style 1
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>

<?php get_header(); ?>

<?php if ( get_mental_option( 'show_menubar' ) ) { get_template_part( 'blocks/menubar' ); } ?>

<div id="main" role="main">

	<div class="section st-no-padding">
		<section>
			<div id="layerslider-singlework1" class="ls-fullheight ls-nobullets" style="width: 100%; height: 1080px;">

				<?php
				if( get_mental_option('gallery_single_full_show_around') ) {
					$slides = mental_get_slides_around();
				} else {
					$slides = mental_get_post_slides();
				}
				?>

				<?php foreach ( $slides as $slide ) : ?>
					<div class="ls-slide <?php echo ! empty( $slide['current_post'] ) ? 'current-post-slide' : ''; ?>"
					     data-title="<?php echo esc_html( $slide['title'] ); ?>" data-ls="slidedelay: 5000; transition2d:5;">

						<?php if ( !empty( $slide['embed'] ) ): ?>
							<?php if( !empty( $slide['image_large'] ) ): ?>
								<img class="ls-bg" src="<?php echo esc_url( $slide['image_large'] ); ?>" alt="layer-background">
							<?php endif; ?>
							<div class="ls-l" style="width: 100% !important; height: 100% !important;">
								<div class="fullsize-embed">
									<?php echo mental_escape_iframe( $slide['embed'] ); ?>
								</div>
							</div>
						<?php else: ?>
							<img src="<?php echo esc_url( $slide['image_large'] ); ?>" class="ls-bg" alt="background">
						<?php endif ?>

					</div>
				<?php endforeach; ?>

				<?php if( ! get_mental_option( 'gallery_single_full_hide_title' ) || ! get_mental_option( 'gallery_single_full_hide_social' ) ): ?>

					<div class="ls-mental-bottombar">
						<?php if( ! get_mental_option( 'gallery_single_full_hide_social' ) && get_mental_option( 'social_block_show' ) ): ?>
							<div class="mb-social">
								<span><?php _e( 'Share', 'mental' ) ?></span>
								<?php get_template_part( 'blocks/social-share' ) ?>
							</div>
						<?php endif ?>
						<?php if( ! get_mental_option( 'gallery_single_full_hide_title' ) ): ?>
							<p id="lsmb-title"></p>
						<?php endif ?>
					</div>

				<?php endif ?>

				<?php if( $bck2gl_link = mental_get_back_to_gallery_link() ): ?>
					<div class="ls-mental-back2gallery"><a href="<?php echo esc_url($bck2gl_link); ?>" aria-hidden="true" class="icon_grid-2x2" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Back to Gallery', 'mental'); ?>"></a></div>
				<?php endif ?>

			</div>
			<!-- layerslider -->
		</section>
	</div>
	<!-- section -->

</div> <!-- main -->

<?php get_footer(); ?>

