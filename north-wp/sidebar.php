<?php $id = $wp_query->get_queried_object_id();
			$sidebar = get_post_meta($id, 'sidebar_set', true);
			$sidebar_pos = get_post_meta($id, 'sidebar_position', true); ?>
<aside class="sidebar small-12 large-4 columns<?php if ($sidebar_pos == 'left') { echo ' medium-pull-8'; }?>" role="complementary">
	<?php 
	
		##############################################################################
		# Display the asigned sidebar
		##############################################################################

	?>
	<?php 
   	if (is_page()) {
   		$sidebar = get_post_meta($post->ID, 'sidebar_set', true);
   		if(is_active_sidebar($sidebar)) {
   			dynamic_sidebar($sidebar);
   		}
   	} else {
   		dynamic_sidebar('blog');
   	}
   	?>
</aside>