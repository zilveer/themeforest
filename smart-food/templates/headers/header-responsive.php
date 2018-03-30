<?php
/**
 * Template Part Name: Responsive Header
 *
 * @package smartfood
 */

?>
<div id="mobile-nav" class="display-mobile">
	<div class="trigger-mobile-wrapper">
		<a href="#" class="display-menu"><?php _e('Menu', 'smartfood');?><i class="fa fa-list"></i></a>
	</div>
	<nav class="mainMenu menu-hidden" id="responsive-menu">
    	<?php if( has_nav_menu( 'responsive' ) ) {
    	    wp_nav_menu( array( 
    	        'theme_location' => 'responsive', 
    	        'container'      => '', 
    	        'menu_id'        => 'js-menu',
    	        'menu_class'     => 'menu' ) ); 
    	} ?>
    </nav>
</div>