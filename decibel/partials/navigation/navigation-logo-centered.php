<?php
/**
 * The Main navigation
 */
?>
<div id="navbar-container" class="clearfix">
	<div class="wrap">
		<div id="navbar-left" class="navbar clearfix">
			<nav class="site-navigation-primary navigation main-navigation clearfix" role="navigation">
				<?php
					if ( has_nav_menu( 'primary-left' ) ) {
						/**
						 * Main Navigation
						 */
						wp_nav_menu(
							array(
								'theme_location' => 'primary-left',
								'menu_class' => 'nav-menu',
								'depth'           => 3,
								'walker'         => new Wolf_Custom_Fields_Nav_Walker(),
								'fallback_cb' => ''
							)
						);
					} else {
						echo '&nbsp;'; // force the logo to be centered when no menu
					}
				?>
			</nav><!-- #site-navigation-primary -->
		</div><!-- #navbar -->
		<?php echo wolf_logo(); ?>
		<div id="navbar-right" class="navbar clearfix">
			<nav class="site-navigation-primary navigation main-navigation clearfix" role="navigation">
				<?php
					/**
					 * Main Navigation
					 */
					wp_nav_menu(
						array(
							'theme_location' => 'primary-right',
							'menu_class' => 'nav-menu',
							'depth'           => 3,
							'walker'         => new Wolf_Custom_Fields_Nav_Walker(),
							'fallback_cb' => ''
						)
					);
				?>
			</nav><!-- #site-navigation-primary -->
		</div><!-- #navbar -->
	</div><!-- .wrap -->
</div><!-- #navbar-container -->
