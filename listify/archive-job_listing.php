<?php
/**
 * The template for displaying Job Listings.
 *
 * Also used for all job listing taxonomy archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Listify
 */

get_header(); ?>

	<?php do_action( 'listify_output_map' ); ?>

	<div id="primary" class="container">
		<div class="row content-area">

			<?php get_sidebar( 'archive-job_listing' ); ?>

			<main id="main" class="site-main <?php if ( listify_job_listing_archive_has_sidebar() ) : ?>col-md-8 col-sm-12 <?php endif; ?>col-xs-12 job_filters--<?php echo get_theme_mod( 'listing-filters-style', 'content-box' ); ?>" role="main">
				<?php do_action( 'listify_output_results' ); ?>
			</main>

		</div>
	</div>

<?php get_footer(); ?>
