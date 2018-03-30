<?php
if($post->post_parent) {
	$children = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&depth=1&echo=0');
}
else {
	$children = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&depth=1&echo=0');
}
if ($children) { ?>
	<ul class="filter-children">
		<?php if($post->post_parent): ?>
		<li><a href='<?php echo get_permalink($post->post_parent); ?>'><?php echo get_the_title($post->post_parent); ?></a></li>
		<?php else: ?>
		<li class="current_page_item"><a href='<?php echo get_permalink($post->ID); ?>'><?php echo get_the_title($post->ID); ?></a></li>
		<?php endif; ?>
		<?php echo $children; ?>
	</ul>
<?php } else { ?>
<?php } ?>