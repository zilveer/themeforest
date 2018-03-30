<?php
/**
 * Template Part Name: Page Header Sticky
 *
 * @package smartfood
 */
?>

<div id="header-dropin" class="hide-mobile">
	
	<div class="container">
		<div class="row">
		
				<div class="col-sm-4" id="sticky-nav-1">
					<nav id="sticky-main" class="site-navigation primary-navigation" <?php tdp_attr( 'menu', 'primary' ); ?>>
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'container'       => '',
								'menu_class'      => 'sf-menu',
								'fallback_cb'     => '',
								'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
							)
						); ?>
					</nav>
				</div>
				<div class="col-sm-4" id="sticky-logo">
					<?php tdp_logo(true);?>
				</div>
				<div class="col-sm-4" id="sticky-nav-2">
					<nav id="sticky-secondary" class="site-navigation secondary-navigation" <?php tdp_attr( 'menu', 'secondary' ); ?>>
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'secondary',
								'container'       => '',
								'menu_class'      => 'sf-menu',
								'fallback_cb'     => '',
								'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
							)
						); ?>
					</nav>
				</div>

				<div class="clearfix"></div>

		</div>
	</div>

</div>
