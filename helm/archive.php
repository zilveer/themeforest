<?php
/**
 * Archive
 *
 */
get_header(); ?>
<?php
global $pagelayout_type;
$pagelayout_type="two-column";
?>
<h1 class="entry-title">
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'mthemelocal' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'mthemelocal' ), get_the_date( 'F Y' ) ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'mthemelocal' ), get_the_date( 'Y' ) ); ?>
<?php elseif ( is_author() ) : ?>
				<?php _e( 'Author Archives: ', 'mthemelocal' ); ?> <?php echo get_query_var('author_name'); ?>
<?php else : ?>
				<?php _e( 'Archive', 'mthemelocal' ); ?>
<?php endif; ?>
			</h1>
<div class="contents-wrap float-left two-column">
<?php
	if ( have_posts() )
		the_post();
?>
	<?php
		rewind_posts();
		get_template_part( 'loop', 'archive' );
	?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
