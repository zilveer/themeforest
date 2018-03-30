<div class="grid-1-2 menu-wrapper">
	<?php
		if(has_nav_menu('menu-top')) {
			wp_nav_menu(array(
				'fallback_cb' => '',
				'theme_location' => 'menu-top',
				'link_before' => '<span>',
				'link_after' => '</span>',
			));
		}
	?>
</div>