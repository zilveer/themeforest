<?php
/**
 *  loop that displays a page.
 */
?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						

					<div class="entry-page-wrapper entry-content clearfix">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mthemelocal' ), 'after' => '</div>' ) ); ?>
					</div>
					<?php edit_post_link( __('edit this entry','mthemelocal') ,'<p class="edit-entry">','</p>'); ?>	
			
			
		</div><!-- .entry-content -->

	<?php endwhile; else: ?>
<?php endif; ?>