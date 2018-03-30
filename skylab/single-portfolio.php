<?php
/**
 * The Template for displaying single portfolio.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>

	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" class="clearfix" role="main">

			<?php if ( have_posts() ) : ?>
			
				<?php while ( have_posts() ) : the_post(); ?>
				
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<?php $remove_single_portfolio_heading = ot_get_option( 'remove_single_portfolio_heading' ); ?>
					<?php if ( $remove_single_portfolio_heading == 'enable' ) { ?>
						<div class="entry-header-wrapper">
							<header class="entry-header clearfix">
								<h1 class="entry-title"><?php echo the_title();?></h1>
							</header><!-- .entry-header -->
						</div>
					<?php } ?>
					
					<div class="portfolio-content clearfix">
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div><!-- .portfolio-content -->
				</div><!-- id="post-<?php the_ID(); ?>" -->

				<?php endwhile; // end of the loop. ?>
				
			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>