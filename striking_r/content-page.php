<?php
/**
 * The default template for displaying page content in page.php template
 */
?>
<div class="entry content entry-content type-page">
	<?php the_content(); ?>
	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'striking-r' ), 'after' => '</div>' ) ); ?>
	<?php edit_post_link(__('Edit', 'striking-r'),'<footer><p class="entry_edit">','</p></footer>'); ?>
	<div class="clearboth"></div>
</div>