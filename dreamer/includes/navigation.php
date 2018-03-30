<?php wp_nav_menu( array(
	'theme_location'  => 'main-menu',
	'menu'            => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'link_after'      => '',
	'items_wrap'      => '<ul class="right" id="%1$s">%3$s</ul>',
	'depth'           => 0
)); ?>