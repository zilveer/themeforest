<?php
/**
 * Template Name: Portfolio
 * Description: A Page Template that adds a portfolio to pages
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

get_header(); ?>

	<div id="main" class="clearfix">

		<div id="primary">
				<header class="entry-header">
					<h1 class="entry-title-lead"><?php echo the_title();?></h1>
				</header><!-- .entry-header -->
			
			<div id="content" role="main">
			
			<?php $portfolios_per_page = ot_get_option( 'portfolios_per_page' ); ?>
			
				<div id="block-portfolio" class="clearfix">
					
					<div id="portfolio" class="clearfix">	
						<?php $wp_query = new WP_Query(); ?>
						<?php $wp_query->query('post_type=portfolio&posts_per_page='.$portfolios_per_page.'&post_status=publish'.'&paged='.$paged); ?>
							
						<?php  if ( $wp_query->have_posts() ) : ?>

							<?php /* Start the Loop */ ?>
							<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

								<?php get_template_part( 'content-summary' ); ?>

							<?php endwhile; ?>
								
							<?php wp_reset_query(); ?>
							
						<?php else : ?>
									
							<div class="entry-content clearfix">
								<p class="no-found"><?php _e( 'No portfolios found, please add some portfolios.', 'mega' ); ?></p>
							</div><!-- .entry-content -->

						<?php endif; ?>
					</div><!-- #portfolio -->	
					
				</div><!-- #block-portfolio-wrapper -->
			
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>