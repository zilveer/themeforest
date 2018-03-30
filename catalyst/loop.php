<?php
/**
 * Catalyst Loop
 *
 */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php // get_sidebar(); ?>

				<?php
					get_template_part( 'post', 'summary' );
				?>

<?php endwhile; // end of the loop. ?>
<?php include ( MTHEME_INCLUDES . '/navigation.php' ); ?>
