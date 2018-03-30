<?php
/**
 * The right navigation
 *
 * An additional slide panel navigation
 */
?>
<aside id="navbar-container-right">
	<div id="navbar-right-inner">
		<span id="close-side-panel" class="toggle-add-menu">&times;</span>
		<?php if ( has_nav_menu( 'secondary' ) ) : ?>
			<nav id="side-menu-container">
				<?php
					/**
					 * Secondary Navigation
					 */
					wp_nav_menu(
						array(
							'theme_location' => 'secondary',
							'menu_class' => 'secondary-nav-menu',
							'depth' => 1,
							'fallback_cb' => ''
						)
					);
				?>
			</nav>
		<?php endif; ?>
		<?php get_sidebar( 'menu' ); ?>
	</div>
</aside><!-- #navbar-container -->