<?php
/**
 * Loop
 *
 */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php // get_sidebar(); ?>

				<?php
					require (TEMPLATEPATH . "/post-summary.php");
				?>

<?php endwhile; // end of the loop. ?>
<?php require ( MTHEME_INCLUDES . '/navigation.php' ); ?>
