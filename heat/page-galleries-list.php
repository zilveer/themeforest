<?php
/**
 * Template Name: Galleries List
 * Description: A Page Template that adds a galleries list to pages
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
			
			<?php $galleries_per_page = ot_get_option( 'galleries_per_page' ); ?>
			
				<div id="block-galleries-list-wrapper" class="clearfix">
					
					<div id="galleries-list" class="clearfix">
							
						<?php $wp_query = new WP_Query(); ?>
						<?php $wp_query->query('post_type=gallery&posts_per_page='.$galleries_per_page.'&post_status=publish'.'&paged='.$paged); ?>
							
						<?php  if ( $wp_query->have_posts() ) : ?>

							<?php /* Start the Loop */ ?>
							<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

								<?php get_template_part( 'content-summary-galleries-list' ); ?>

							<?php endwhile; ?>
								
							<?php wp_reset_query(); ?>
							
						<?php else : ?>
									
							<div class="entry-content clearfix">
								<p class="no-found"><?php _e( 'No galleries found, please add some galleries.', 'mega' ); ?></p>
							</div><!-- .entry-content -->

						<?php endif; ?>
					</div><!-- #galleries-list -->
					
				</div><!-- #block-galleries-list-wrapper -->
			
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>