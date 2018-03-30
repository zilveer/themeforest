<?php
/*
Template Name: Onepage Template
Author: Vedmant <vedmant@gmail.com>
*/
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>
<?php get_header(); ?>

<?php if ( get_mental_option( 'show_menubar' ) ) { get_template_part( 'blocks/menubar' ); } ?>

<div id="main" role="main">

	<?php $footer_parallax_effect = ( get_mental_option( 'footer_parallax' ) && get_mental_option( 'footer_show' ) )? true : false ; ?>

	<?php if ( $footer_parallax_effect ): ?>
	<div class="parallax-footer">
	<?php endif ?>

	<?php
	$onepage_settings = get_post_meta( get_the_ID(), 'onepage', true );

	$slider = get_post_meta( get_the_ID(), 'onepage_top_slider', true );
	if( !empty($slider) && !empty($slider['gallery']) ):
		$slides = $slider['gallery'];
	?>

		<div class="section st-no-padding">
			<section>
				<div id="layerslider" class="ls-fullheight <?php if(@$onepage_settings['top_content_height'] == '100-menu') echo 'ls-fullheight-menu'; ?> ls-nobullets" style="width: 100%; height: 1080px;">

					<?php foreach ( $slides as $slide ): ?>

						<?php $image = wp_get_attachment_image_src( $slide['imgid'], 'full' ) ?>

						<div class="ls-slide" data-ls="slidedelay: 5000; transition2d:5;">
							<img src="<?php echo esc_attr($image[0]) ?>" class="ls-bg" alt="background">

							<p class="ls-l ls-mental-title-onepage" style="top:30%; left:50%;"  data-ls="offsetxin:0;durationin:2000;delayin:500;easingin:easeOutElastic;rotatexin:-90;transformoriginin:50% top 0;offsetxout:-200;durationout:1000;">
								<?php echo esc_html($slide['title']); ?>
							</p>

							<p class="ls-l ls-mental-desrc" style="top:40%; left:50%;"  data-ls="offsetxin:0;durationin:2000;delayin:700;easingin:easeOutElastic;rotatexin:-90;transformoriginin:50% top 0;offsetxout:-200;durationout:1000;">
								<?php echo esc_html($slide['description']); ?>
							</p>
							<a class="ls-l ls-mental-scrollunder" style="top:90%; left:50%;"  data-ls="offsetxin:0;durationin:2000;delayin:700;easingin:easeOutElastic;rotatexin:-90;transformoriginin:50% top 0;offsetxout:-200;durationout:1000;"></a>
						</div>

					<?php endforeach ?>

				</div>
				<!-- layerslider -->
			</section>
		</div>
		<!-- section -->

	<?php elseif ( ! empty( $onepage_settings['top_content'] ) ): ?>

		<div class="onepage-top-section <?php if($onepage_settings['top_content_height'] == '100') echo 'ots-full'; ?> <?php if($onepage_settings['top_content_height'] == '100-menu') echo 'ots-full-menu'; ?>">

			<?php echo do_shortcode($onepage_settings['top_content']) ?>

		</div>

	<?php endif ?>

	<?php get_template_part( 'blocks/topmenu-onepage' ); ?>

	<?php if ( have_posts() ): while( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; ?>

	<?php else: ?>

		<h2><?php _e( 'Sorry, nothing to display.', 'mental' ); ?></h2>

	<?php endif; ?>

	<?php if ( $footer_parallax_effect ): ?>
	</div>
	<?php endif ?>

	<?php if ( get_mental_option( 'footer_show' ) ) get_template_part( 'blocks/widget-footer' ) ?>

</div> <!-- main -->

<?php get_footer(); ?>
