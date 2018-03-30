<?php
/**
 * The Main navigation
 */
?>
<div id="navbar-container" class="clearfix">
	<div class="wrap">
		<?php echo wolf_logo(); ?>
		<div id="navbar" class="navbar clearfix">
			<nav class="site-navigation-primary navigation main-navigation clearfix" role="navigation">
				<?php
					/**
					 * Primary Menu
					 */
					if ( 'logo-centered' == wolf_get_theme_option( 'menu_position' ) ) :

						wp_nav_menu(
							array(
								'theme_location' 	=> 'primary-left',
								'menu_class' 		=> 'nav-menu',
								'depth'			=> 3,
								'walker'		=> new Wolf_Custom_Fields_Nav_Walker(),
								'fallback_cb'		=> ''
							)
						);
						wp_nav_menu(
							array(
								'theme_location' 	=> 'primary-right',
								'menu_class' 		=> 'nav-menu',
								'depth'			=> 3,
								'walker'		=> new Wolf_Custom_Fields_Nav_Walker(),
								'fallback_cb'		=> ''
							)
						);

					else :

						wp_nav_menu(
							array(
								'theme_location' 	=> 'primary',
								'menu_class' 		=> 'nav-menu',
								'depth'			=> 3,
								'walker'		=> new Wolf_Custom_Fields_Nav_Walker(),
								'fallback_cb'		=> ''
							)
						);
					endif;
				?>
			</nav><!-- #site-navigation-primary -->
		</div><!-- #navbar -->
	</div><!-- .wrap -->
</div><!-- #navbar-container -->
