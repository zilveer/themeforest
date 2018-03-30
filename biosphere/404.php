<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

	<div class="container">

		<div id="content">

			<div class="lb-overlay-wrapper">

				<div class="lb-overlay-title"><?php _e( 'Error 404: Page Not Found', 'dd_string' ); ?></div>

				<div class="lb-overlay-descr"><?php _e( 'Looks like something went wrong. The page you are looking for could not be found', 'dd_string' ); ?></div>

				<div class="lb-overlay-form">

					<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">

						<div class="lb-overlay-form-search">
							<input type="text" value="" name="s" placeholder="<?php _e( 'SEARCH THE SITE', 'dd_string' ); ?>">
						</div><!-- .lb-overlay-form-search -->

						<div class="lb-overlay-form-submit">

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'BACK TO HOMEPAGE &rarr;', 'dd_string' ); ?></a>

						</div><!-- .lb-overlay-form-submit -->

					</form>

				</div><!-- .lb-overlay-form -->

				<span class="lb-overlay-or"><?php _e( 'Or', 'dd_string' ); ?></span>

			</div><!-- .lb-overlay-wrapper -->

			<h2 class="section-title-2"><?php _e( 'Take a look at the causes we are supporting', 'dd_string' ); ?></h2>

			<div class="causes causes-listing clearfix">

				<?php

					/* Query */

					if(is_front_page()){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }else{ $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; }
					$args = array(
						'paged' => $paged, 
						'post_type' => 'dd_causes',
						'posts_per_page' => 8
					);
					$dd_query = new WP_Query($args);

					/* Vars */

					$dd_count = 0;
					$dd_max_count = 4;

					/* Loop */

					if ($dd_query->have_posts()) : while ($dd_query->have_posts()) : $dd_query->the_post(); /* Loop the posts */ $dd_count++;
						
							get_template_part( 'templates/causes', '' );

					endwhile; else:

						?><div class="align-center"><?php _e( 'There are no causes yet.', 'dd_string' ); ?></div><?php

					endif; wp_reset_query();

				?>

			</div><!-- .causes -->

			<?php wp_reset_postdata(); ?>

		</div><!-- #content -->
		
	</div><!-- .container -->

<?php get_footer(); ?>