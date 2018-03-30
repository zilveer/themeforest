<?php
/**
 * The Left navigation
 */
?>
<aside id="navbar-container-left">
	<div id="navbar-left-inner">
		<header>
			<?php echo wolf_logo(); ?>
		</header>
		<p class="site-tagline"><?php echo get_bloginfo( 'description' ); ?></p>
		<nav class="site-navigation-primary">
			<?php
				/**
				 * Main Navigation
				 */
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class' => 'nav-menu dropdown',
						'fallback_cb' => ''
					)
				);
			?>
		</nav>
		<footer>
			<?php
				$services = wolf_get_theme_option( 'menu_socials_services' );
				if ( $services ) {
					echo wolf_theme_socials( $services, '1x' );
				}
			?>
		</footer>
	</div>
</aside><!-- #navbar-container-left -->