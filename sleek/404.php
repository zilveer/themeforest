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

				<?php
					$post_classes = '';
					$post_classes .= ' article-single article-single--page article--widget-area article-single--404';
				?>

				<article class="<?php echo $post_classes; ?>" role="main">

					<div class="title-header">
						<div class="title-header__inwrap">

							<div class="post__badge post__badge--404">
								<div class="post__badge__inwrap"> 404 </div>
							</div>

							<h1><?php _e( 'Page not found', 'sleek' ); ?></h1>
						</div>
					</div>

					<div class="post__content">
						<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page-404-area') ); ?>
					</div>

				</article>

			</div>
			</div>

		</div> <!-- /main content -->

		<?php get_sidebar(); ?>

	</div> <!-- /# content wrapper inside -->
</div> <!-- /# content wrapper -->

<?php get_footer(); ?>