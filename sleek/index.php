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



				<?php
					if( $theme_settings->posts['featured_category'] ){
						get_template_part('loop', 'featured');
					}

					get_template_part('loop');
				?>

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