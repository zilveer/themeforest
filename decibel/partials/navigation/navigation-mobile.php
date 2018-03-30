<?php
/**
 * The mobile navigation
 */
?>
<div id="navbar-mobile-container">
	<div id="navbar-mobile" class="navbar clearfix">
		<!-- <span id="close-menu">&times;</span> -->
		<nav id="site-navigation-primary-mobile" class="navigation main-navigation clearfix" role="navigation">

			<?php
				/**
				 * Mobile menu
				 */
				if ( 'logo-centered' == wolf_get_theme_option( 'menu_position' ) ) :

					wp_nav_menu(
						array(
							'theme_location' 	=> 'primary-left',
							'menu_class' 		=> 'nav-menu dropdown',
							'menu_id'        	=> 'mobile-menu',
							'fallback_cb'		=> ''
						)
					);
					wp_nav_menu(
						array(
							'theme_location' 	=> 'primary-right',
							'menu_class' 		=> 'nav-menu dropdown',
							'menu_id'        	=> 'mobile-menu',
							'fallback_cb'		=> ''
						)
					);
				else :

					wp_nav_menu(
						array(
							'theme_location' 	=> 'primary',
							'menu_class' 		=> 'nav-menu dropdown',
							'menu_id'        	=> 'mobile-menu',
							'fallback_cb'		=> ''
						)
					);
				endif;
			?>
		</nav><!-- #site-navigation-primary -->
	</div><!-- #navbar -->
</div>
