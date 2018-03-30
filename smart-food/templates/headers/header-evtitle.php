<?php
/**
 * Template Part Name: Page Header Events
 *
 * @package smartfood
 */

$alt_logo = true;

?>
<header <?php tdp_attr( 'header' ); ?>>

	<div class="nav-main" id="nav-main">
		<div class="container">
			<div class="row">

				<div class="col-md-4 col-sm-12 col-xs-12 hide-mobile" id="left-menu-wrapper">
					
					<nav id="main" class="site-navigation primary-navigation" <?php tdp_attr( 'menu', 'primary' ); ?>>
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

				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="site-logo" id="site-logo">
					<?php tdp_logo($alt_logo);?>
					</div>
				</div>

				<div class="col-md-4 col-sm-12 col-xs-12 hide-mobile">
					
					<nav id="secondary" class="site-navigation secondary-navigation" <?php tdp_attr( 'menu', 'secondary' ); ?>>
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

	<div id="subheader-static">
		<div class="container">
			<div class="row clearfix">
			
			<h1><?php echo single_post_title(); ?></h1>

			<?php if ( function_exists( 'breadcrumb_trail' ) && !is_404() ) echo breadcrumb_trail(); ?>

			</div>
		</div>
	</div>
	
</header>