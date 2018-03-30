<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<?php wp_link_pages(array(
		'before' => '<div class="g5plus-page-links"><span class="g5plus-page-links-title">' . esc_html__('Pages:', 'g5plus-handmade') . '</span>',
		'after' => '</div>',
		'link_before' => '<span class="g5plus-page-link">',
		'link_after' => '</span>',
	)); ?>

</div>