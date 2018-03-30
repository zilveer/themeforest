<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, you will find a 
 * tag.php for Tag archives, category.php for Category archives, and author.php 
 * for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

	<div class="page-width">
		<section id="primary" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'liftoff' ), '<span>' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'liftoff' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'liftoff' ) ) . '</span>' );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'liftoff' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'liftoff' ) ) . '</span>' );
						else :
							_e( 'Archives', 'liftoff' );
						endif;
					?></h1>
				</header><!-- .archive-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/* Include the post format-specific template for the content. If you want to
					 * this in a child theme then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					?>
					<div class="content-list">
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div>
					<?php
				endwhile;

				liftoff_content_nav( 'nav-below' );
				?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>