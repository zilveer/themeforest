<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package progression
 */
?>

<div id="content-container">
	<div class="content-container-pro">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ),
				'after'  => '</div>',
			) );
		?>
		<?php edit_post_link( __( 'Edit', 'progression' ), '<p class="edit-link">', '</p>' ); ?>
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		?>
	</div><!-- close .content-container-pro -->
</div>