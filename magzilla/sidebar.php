<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/
global $ft_option, $fave_sidebar;
?>

<aside class="sidebar" itemscope itemtype="http://schema.org/WPSideBar">
	<?php  
	if( is_active_sidebar($fave_sidebar) ) {
		dynamic_sidebar( $fave_sidebar );
	}
	?>
</aside><!-- .sidebar -->	