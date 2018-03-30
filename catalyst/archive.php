<?php
/**
 * Catalyst archive
 *
 */
get_header(); ?>
<div class="contents-wrap float-left two-column">
<?php
	if ( have_posts() )
		the_post();
?>

	<div class="entry-content-wrapper">
			<h1 class="entry-title">
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'mthemelocal' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'mthemelocal' ), get_the_date( 'F Y' ) ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'mthemelocal' ), get_the_date( 'Y' ) ); ?>
<?php else : ?>
				<?php _e( 'Blog Archives', 'mthemelocal' ); ?>
<?php endif; ?>
			</h1>
	<?php
		rewind_posts();
		get_template_part( 'loop', 'archive' );
	?>
	</div>



</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
