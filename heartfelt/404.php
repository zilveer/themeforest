<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

get_header(); ?>

<div class="row content_row">

	<div class="large-12 columns">

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<div class="page-content">

					<header class="page-header">
						<h1 class="page-title"><?php _e( '404 Error: Nothing Found', 'heartfelt' ); ?></h1>
					</header><!-- .page-header -->

					<p><?php _e( 'We weren\'t able to find what you\'re looking for. Maybe try searching for something else?', 'heartfelt' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->

			</section><!-- .error-404 -->

		</main><!-- #main .site-main -->
		
	</div><!-- #primary .content-area -->

	</div><!-- .large-12 -->

</div><!-- .row .content_row -->

<?php get_footer(); ?>