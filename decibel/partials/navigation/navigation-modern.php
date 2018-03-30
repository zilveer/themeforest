<?php
/**
 * The modern type navigation
 */
?>
<div id="navbar-modern-container">
	<div id="navbar-modern" class="navbar clearfix">
		<!-- <span id="close-menu">&times;</span> -->
		<nav id="site-navigation-primary-modern" class="navigation main-navigation clearfix" role="navigation">
			<?php 
				/**
				 * Primary menu
				 */
				wp_nav_menu(
					array(
						'theme_location' 	=> 'primary', 
						'menu_class'	 	=> 'nav-menu',
						'menu_id'       	 	=> 'modern-menu',
						'depth' 			=> 1,
						'fallback_cb'		=> ''
					) 
				); 
			?>
		</nav><!-- #site-navigation-primary -->
	</div><!-- #navbar -->
</div>
