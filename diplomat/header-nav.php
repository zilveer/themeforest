<?php
$wp_nav_menu_html = wp_nav_menu(array(
	'theme_location' => 'primary',
	'menu_id' => 'menu-primary-menu',
	'container_class' => 'menu-primary-menu-container',
	'walker' => new TMM_Mega_Menu(),
	'echo' => 0
));

if(!empty($wp_nav_menu_html)){
	echo $wp_nav_menu_html;
}else{
	wp_page_menu(array('menu_class' => 'menu-primary-menu-container'));
}
?>