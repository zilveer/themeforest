<?php
/**
 * Template Name: Page with Header without VC
 * Description: A Page Template that adds a header to pages without VC
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>

	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" role="main">
				<div class="entry-header-wrapper">
					<header class="entry-header clearfix">
						<h1 class="entry-title"><?php echo the_title();?></h1>
					</header><!-- .entry-header -->
				</div>
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>