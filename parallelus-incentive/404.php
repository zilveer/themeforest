<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<article id="post-0" class="post error404 no-results not-found">

				<?php 
				// Check for custom 404 page content
				$error_page = (get_options_data('options-page', 'error-content')) ? get_options_data('options-page', 'error-content') : 'default';

				if ($error_page == 'default') {
					?>
					<div style="text-align: center">
					<i class="fa fa-exclamation" style="font-size: 120px; color: #ccc"></i>
					<header class="entry-header">
						<h1 style="font-size: 72px;"><?php _e( 'Whaaaaat??!?!!1', 'framework' ); ?></h1>
					</header>
					<div class="entry-content">
						<p style="font-size: 20px; margin-bottom:40px;"><?php _e( "It seems the page you're looking for isn't here.<br>Try looking somewhere else and you might get lucky!", 'framework' ); ?></p>
						<?php get_search_form(); ?>
						<p>&nbsp;</p>
					</div><!-- .entry-content -->
					<?php
				} else {
					
					// Get the custom error page
					$errorContent = new WP_Query( 'page_id='.$error_page );

					while ( $errorContent->have_posts() ) : $errorContent->the_post();
						the_content();
					endwhile;
				} ?>
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>