<nav class="qodef-fullscreen-menu">
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'popup-navigation' ,
				'container'  => '',
				'container_class' => '',
				'menu_class' => '',
				'menu_id' => '',
				'fallback_cb' => 'top_navigation_fallback',
				'link_before' => '<span>',
				'link_after' => '</span>',
				'walker' => new SupremaQodefFullscreenNavigationWalker()
			)
		);
	?>
</nav>