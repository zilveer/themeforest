<?php
/**
 * The template for displaying 404 pages (not found).
 * 
 * @package berg-wp
 */

get_header(); ?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main row" role="main">

			<section class="error-404 not-found col-md-12">
				<header class="page-header">
					<h1 class="error">404</h1>
					<h2 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'BERG'); ?></h2>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'BERG'); ?></p>
					<div class="widget">
					<?php get_search_form(); ?>
					</div>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
	berg_getFooter();
	get_template_part('footer'); 
?>
