<?php wp_nav_menu( array(
'theme_location'  => 'main-menu',
'menu'            => '',
'menu_class'      => 'menu',
'menu_id'         => '',
'echo'            => true,
'fallback_cb'     => 'wp_page_menu',
'link_after'      => '',
'items_wrap'     => '<select class="responsive-nav show-for-small" onchange="moveTo(this.value)" onFocus="moveTo(this.value)"><option value="">Select a page...</option>%3$s</select>',
'depth'           => 0,
'walker'  => new Walker_Nav_Menu_Dropdown()
)); ?>