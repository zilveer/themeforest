<?php
/**
 * The default template for displaying content
 */
?>
<div <?php post_class('content'); ?>>
	<?php the_content(); ?>
	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'striking-r' ), 'after' => '</div>' ) ); ?>
	<?php edit_post_link(__('Edit', 'striking-r'),'<footer><p class="entry_edit">','</p></footer>'); ?>
	<div class="clearboth"></div>
</div>