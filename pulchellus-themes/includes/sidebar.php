<?php

	global $wp_query;
	
	if (isset($wp_query->post->ID)) {
		$page_id = $wp_query->post->ID;
	} else {
		$page_id =  false;
	}
	
	if(is_home()) {
		
		if('page' == get_option('show_on_front')) {
			if(is_front_page() && get_option('page_on_front')) {
				$page_id = get_option('page_on_front');
			} else if (get_option('page_for_posts')) {
				$page_id = get_option('page_for_posts');
			} else {
				$page_id = false;
			}
		}
	}
	if($page_id) {
		$sidebar = get_post_meta( $page_id, THEME_NAME.'_sidebar_select', true );
	}
	if ( $sidebar=='' ) {
		$sidebar='default';
	}

?>
				  <!-- Sidebar -->
				  <div class="five columns" id="sidebar">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
						<?php endif; ?>
					<!-- END Sidebar -->
					</div>
