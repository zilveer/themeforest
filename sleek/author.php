<?php
	$theme_settings = sleek_theme_settings();
	get_header();

	$loop_classes = '';

	// get display style
	$display_style = $theme_settings->posts['archive_display_style'];

	$loop_classes .= ' loop-container--style-'.$display_style;
	if( $display_style == 'masonry' || $display_style == 'newspaper' ){
		$display_style = 'masonry';
		$loop_classes .= ' js-loop-is-masonry';
	}

?>

<!-- wrapper -->
<div id="content-wrapper" class="content-wrapper">
	<div id="content-wrapper-inside" class="content-wrapper__inside <?php echo sleek_layout_classes(); ?>">

		<div id="main-content" class="main-content">

			<!-- main content -->
			<div class="main-content__inside js-nano js-nano-main" role="main">
			<div class="nano-content">



				<?php if( have_posts() ): the_post(); ?>

					<div class="single__header">
					<div class="post__head">

						<?php get_template_part('post_badge'); ?>

						<h1><?php the_author(); ?></h1>

						<?php if( get_the_author_meta('soc_shortcode') ){
							echo ( do_shortcode( get_the_author_meta('soc_shortcode') ) );
						} ?>

						<div class="description">
							<?php echo wpautop( get_the_author_meta('description') ); ?>
						</div>

					</div>
					</div>



					<div class="sleek-blog sleek-blog--style-<?php echo $display_style; ?>">

						<div class="loop-container loop-container--wp <?php echo $loop_classes; ?>">
							<?php rewind_posts(); while (have_posts()) : the_post(); ?>

								<?php get_template_part( 'loop_item', $display_style ); ?>

							<?php endwhile; ?>
						</div>

						<?php get_template_part('pagination'); ?>

					</div>


				<?php else: ?>

					<div class="single__header">
					<div class="post__head">
						<?php $author = get_user_by( 'slug', get_query_var( 'author_name' ) ); ?>

						<div class="post__badge post__badge--author">
							<?php echo get_avatar( $author->ID, 320 ); ?>
						</div>

						<h1><?php the_author_meta( 'display_name', $author->ID); ?></h1>

						<?php if( get_the_author_meta( 'soc_shortcode', $author->ID ) ){
							echo ( do_shortcode( get_the_author_meta( 'soc_shortcode', $author->ID ) ) );
						} ?>

						<p class="description">
							<?php echo the_author_meta( 'description', $author->ID ); ?>
						</p>

					</div>
					</div>

				<?php endif; ?>

			</div>
			</div>

		</div>
		<!-- /main content -->

		<?php get_sidebar(); ?>

	</div>
	<!-- / # content wrapper inside -->
</div>
<!-- / # content wrapper -->

<?php get_footer(); ?>
