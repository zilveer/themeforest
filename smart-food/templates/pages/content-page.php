<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package smartfood
 */
?>
	
<?php the_content(); ?>
<?php
	wp_link_pages( array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'smartfood' ),
		'after'  => '</div>',
	) );
?>

<footer class="entry-footer">
	<?php edit_post_link( __( 'Edit', 'smartfood' ), '<span class="edit-link">', '</span>' ); ?>
</footer><!-- .entry-footer -->