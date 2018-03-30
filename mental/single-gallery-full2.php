<?php
/**
 * Single Gallery item template: slider style 2
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
			<div id="layerslider-singlework2" class="ls-fullheight ls-nobullets ls-nonav" style="width: 100%; height: 1080px;">

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

						<?php if ( ! empty( $slide['title'] ) && ! get_mental_option( 'gallery_single_full_hide_title' ) ): ?>
							<p class="ls-l ls-mental-title" style="top:60%; left:0; margin-left: 5%% !important;"
							   data-ls="offsetxin:0;durationin:2000;delayin:500;easingin:easeOutElastic;rotatexin:-90;transformoriginin:50% top 0;offsetxout:-200;durationout:1000;">
								<?php echo esc_html( $slide['title'] ); ?>
							</p>
						<?php endif ?>
						<?php if ( ! empty( $slide['description'] ) ): ?>
							<p class="ls-l ls-mental-desrc" style="top:70%; left:0; margin-left: 5% !important;"
							   data-ls="offsetxin:0;durationin:2000;delayin:700;easingin:easeOutElastic;rotatexin:-90;transformoriginin:50% top 0;offsetxout:-200;durationout:1000;">
								<?php echo esc_html( $slide['description'] ); ?>
							</p>
						<?php endif ?>

					</div>
				<?php endforeach;?>

				<div class="ls-mental-nav">
					<div class="ls-mental-nav-container">
						<span class="ls-mn-counter"><em>01</em>/03</span><a href="#" class="ls-mn-prev"></a><a href="#" class="ls-mn-next"></a>
					</div>
				</div>

				<?php if( ! get_mental_option( 'gallery_single_full_hide_social' ) && get_mental_option( 'social_block_show' ) ): ?>
					<div class="ls-mental-bottombar2">
						<span><?php _e( 'Share', 'mental' ) ?></span>
						<?php get_template_part( 'blocks/social-share' ) ?>
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

