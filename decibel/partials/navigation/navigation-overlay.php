<?php
/**
 * The right navigation
 *
 * An additional slide panel navigation
 */
?>
<div id="navbar-container-overlay">
	<span id="close-overlay-menu">&times;</span>
	<nav id="overlay-menu-container" class="table">
		<div id="overlay-menu-inner" class="table-cell">
			<?php
				/**
				 * Secondary Navigation
				 */
				wp_nav_menu(
					array(
						'theme_location' 	=> 'secondary',
						'menu_class' 		=> 'nav-menu',
						'depth' 			=> 1,
						'fallback_cb'		=> ''
					)
				);
			?>
		</div>
	</nav>
</div><!-- #navbar-container-overlay -->