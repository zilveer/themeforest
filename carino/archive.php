<?php
/**
* The template for displaying Archive pages.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

get_header(); 

$van_page_type = van_page_type(); 
?>

<div id="main-content" class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?>">

		<div class="page-header">

			<?php if ( have_posts() ): ?>

				<div class="page-title">

					<h1>

						<?php if ( is_day() ) : ?>

							<?php printf( __( 'Daily Archives: <span>%s</span>', 'van' ), get_the_date() ); ?>
						
						<?php elseif ( is_month() ) : ?>

							<?php printf( __( 'Monthly Archives: <span>%s</span>', 'van' ), get_the_date( 'F Y' ) ); ?>
						
						<?php elseif ( is_year() ) : ?>

							<?php printf( __( 'Yearly Archives: <span>%s</span>', 'van' ), get_the_date( 'Y' ) ); ?>
						
						<?php else : ?>

							<?php _e( 'Blog Archives', 'van' ); ?>
						
						<?php endif; ?>
					
					</h1>
					
				</div>

			<?php endif; ?>

		</div><!-- .page-head -->

		<?php if ( have_posts() ) : ?>

			<div id="posts-outer">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', get_post_format() );  ?>

				<?php endwhile;?>

			</div><!-- #posts-outer -->

			<?php van_get_pagination(); ?>

		<?php else: ?>
			<?php get_template_part( 'partials/content', 'none' ); ?>
		<?php endif; ?>

</div><!-- #main-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>