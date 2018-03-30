<?php get_header();?>

<?php
global $wp_query;
$total_results = $wp_query->found_posts;
$search_query = get_search_query();
?>

<!-- CORE : begin -->
<div id="core" <?php post_class(); ?>>

	<!-- PAGE HEADER : begin -->
	<div id="page-header">
		<div class="container">
			<h1 class="m-secondary-font"><?php echo @sprintf( __( 'Search results for "%s"', 'beautyspot' ), $search_query ); ?>, <?php echo @sprintf( __( '%d found', 'beautyspot' ) , $total_results ) ?></h1>
			<?php get_template_part( 'title', 'breadcrumb' ); ?>
		</div>
	</div>
	<!-- PAGE HEADER : begin -->

	<div class="container">

		<!-- PAGE CONTENT : begin -->
		<div id="page-content">

			<!-- SEARCH RESULTS : begin -->
			<div class="search-results">

				<?php get_search_form() ?>

				<!-- DIVIDER : begin -->
				<hr class="c-divider m-medium">
				<!-- DIVIDER : end -->

				<?php if ( have_posts() ) : ?>

					<!-- RESULTS LIST : begin -->
					<ul class="results-list">

						<?php while ( have_posts() ) : the_post(); ?>

							<!-- RESULT ITEM : begin -->
							<li>
								<h2 class="item-title m-secondary-font"><?php the_title(); ?></h2>
								<p class="item-link"><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></p>
								<div class="item-text various-content"><?php echo wpautop( do_shortcode( get_the_excerpt() ) ); ?></div>
							</li>
							<!-- RESULT ITEM : end -->

						<?php endwhile; ?>

					</ul>
					<!-- RESULTS LIST : end -->

					<?php lsvr_pagination(); ?>

				<?php else : ?>

					<div class="various-content">
						<p class="c-alert-message m-info max-width-400 margin-sides-auto"><i class="ico fa fa-info-circle"></i><?php _e( 'No results found.', 'beautyspot' ); ?></p>
					</div>

				<?php endif; ?>

			</div>
			<!-- SEARCH RESULTS : end -->

		</div>
		<!-- PAGE CONTENT : end -->

	</div>

</div>
<!-- CORE : end -->

<?php get_footer(); ?>