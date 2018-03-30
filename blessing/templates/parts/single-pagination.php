<?php
if ($post_data['post_type'] == 'lesson') {
	echo trim(ancora_get_lessons_links($parent_id, $post_data['post_id'], array(
		'header' => __('Course Content', 'ancora'),
		'show_prev_next' => true
		)));
} else {
	wp_link_pages( array( 
		'before' => '<nav class="pagination_single" role="navigation"><span class="pager_pages">' . __( 'Pages:', 'ancora' ) . '</span>',
		'after' => '</nav>',
		'link_before' => '<span class="pager_numbers">',
		'link_after' => '</span>'
		)
	); 
}
?>