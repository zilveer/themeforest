<?php get_header();?>

<!-- CORE : begin -->
<div id="core" <?php post_class( 'page-404' ); ?>
	<?php if ( lsvr_get_image_field( 'page404_bg_image' ) ) { echo ' style="background-image: url(' . lsvr_get_image_field( 'page404_bg_image' ) . ');"'; } ?>>
	<div class="container">

		<!-- PAGE CONTENT : begin -->
		<div id="page-content">

			<!-- ERROR 404 : begin -->
			<div class="error-404">

				<!-- ERROR HEADER : begin -->
				<div class="error-header">
					<h1 class="m-secondary-font"><?php echo lsvr_get_field( 'page404_title', __( '<span>404</span> Sorry, page not found.', 'beautyspot' ) ); ?></h1>
					<p><?php echo lsvr_get_field( 'page404_subtitle', __( 'The page you are looking for is no longer available or has been moved.', 'beautyspot' ) ); ?></p>
				</div>
				<!-- ERROR HEADER : end -->

				<?php if ( lsvr_get_field( 'page404_enable_search', true, true ) ) : ?>
				<div class="various-content">

					<!-- SEARCH SECTION : begin -->
					<section>
						<h2><?php _e( 'Search the site', 'beautyspot' ); ?></h2>
						<?php get_search_form() ?>
					</section>
					<!-- SEARCH SECTION : end -->

				</div>
				<?php endif; ?>

			</div>
			<!-- ERROR 404 : end -->

		</div>
		<!-- PAGE CONTENT : end -->

	</div>
</div>
<!-- CORE : end -->

<?php get_footer(); ?>