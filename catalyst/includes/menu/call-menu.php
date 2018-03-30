<div class="homemenu">		
<?php

function mtheme_nav_fallback() {
   include (TEMPLATEPATH . "/includes/menu/fallbackmenu.php");
}

if ( function_exists('wp_nav_menu') ) { 
	// If 3.0 menus exist
	wp_nav_menu( array( 'container' => '', 'theme_location' => 'top_menu', 'fallback_cb' => 'mtheme_nav_fallback' ) );

} else {
	// Else show the regular Menu
	include (TEMPLATEPATH . "/includes/menu/menu.php");
} 

?>
<div class="clear"></div>
</div>
<div class="clear"></div>