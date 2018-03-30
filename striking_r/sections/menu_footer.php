<?php
if(!function_exists('theme_section_menu_footer')){
/**
 * The default template for displaying menu in the pages
 */
function theme_section_menu_footer(){
	return wp_nav_menu(array( 
			'theme_location' => 'footer-menu',
			'container' => 'nav',
			'container_id' => 'footer_menu',
			'fallback_cb' => '',
			'walker' => new Theme_Walker_Nav_Menu_Footer
		));
}
}