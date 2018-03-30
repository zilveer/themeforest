<?php
	$theme_settings = sleek_theme_settings();
	get_header();
?>

<!-- wrapper -->
<div id="content-wrapper" class="content-wrapper">
	<div id="content-wrapper-inside" class="content-wrapper__inside <?php echo sleek_layout_classes(); ?>">

		<div id="main-content" class="main-content">

			<!-- main content -->
			<div class="main-content__inside js-nano js-nano-main" role="main">
			<div class="nano-content">



				<?php get_template_part('title_header'); ?>

				<?php get_template_part('loop'); ?>



				<!-- If no results, show search-results widget area -->
				<?php if( !have_posts() ): ?>

					<div class="article-single article-single--page article--widget-area article-single--search-no-results">

						<div class="post__content">
							<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('search-results') ); ?>
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