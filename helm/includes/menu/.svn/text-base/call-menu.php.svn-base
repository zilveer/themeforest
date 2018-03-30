<div class="homemenu">
<?php

function mtheme_nav_fallback() {
   require (TEMPLATEPATH . "/includes/menu/fallbackmenu.php");
}

if ( function_exists('wp_nav_menu') ) { 
// If 3.0 menus exist
//	wp_nav_menu( array( 'container' => '', 'theme_location' => 'top_menu', 'fallback_cb' => 'mtheme_nav_fallback' ) );
wp_nav_menu( array(
 'container' =>false,
 'theme_location' => 'top_menu',
 'menu_class' => 'menu',
 'echo' => true,
 'before' => '',
 'after' => '',
 'link_before' => '',
 'link_after' => '',
 'depth' => 0,
 'fallback_cb' => 'mtheme_nav_fallback',
 'walker' => new description_walker())
);

} else {
	// Else show the regular Menu
	require (TEMPLATEPATH . "/includes/menu/menu.php");
} 

?>
</div>