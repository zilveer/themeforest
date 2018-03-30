<?php 
	$id = get_queried_object_id();
	$page_menu = (get_post_meta($id, 'page_menu', true) !== '' ? get_post_meta($id, 'page_menu', true) : false);
	
	$header_cart = ot_get_option('header_cart');
	$header_search = ot_get_option('header_search');
	$header_wishlist = ot_get_option('header_wishlist');
?>
<header class="header row style2" role="banner">
	<div class="small-4 columns menu-holder">
			<a href="#" class="mobile-toggle"><i class="fa fa-bars"></i></a>
			<nav id="nav" role="navigation">
				<?php if ($page_menu) { ?>
					<?php wp_nav_menu( array( 'menu' => $page_menu, 'depth' => 3, 'container' => false, 'menu_class' => 'sf-menu', 'walker' => new thb_MegaMenu  ) ); ?>
				<?php } else if (has_nav_menu('nav-menu')) { ?>
				  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'sf-menu', 'walker' => new thb_MegaMenu  ) ); ?>
				<?php } else { ?>
					<ul class="sf-menu">
						<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>"><?php esc_html_e( 'Please assign a menu', 'north' ); ?></a></li>
					</ul>
				<?php } ?>
			</nav>
	</div>
	<div class="small-12 medium-4 columns logo">
		<?php if (ot_get_option('logo')) { $logo = ot_get_option('logo'); } else { $logo = THB_THEME_ROOT. '/assets/img/logo-light.png'; } ?>
		<?php if (ot_get_option('logo_dark')) { $logo_dark = ot_get_option('logo_dark'); } else { $logo_dark = THB_THEME_ROOT. '/assets/img/logo-dark.png'; } ?>
		<a href="<?php echo esc_url(home_url()); ?>" class="logolink">
			<img src="<?php echo esc_attr($logo); ?>" class="logoimg bg--light" alt="<?php bloginfo('name'); ?>"/>
			<img src="<?php echo esc_attr($logo_dark); ?>" class="logoimg bg--dark" alt="<?php bloginfo('name'); ?>"/>
		</a>
	</div>
	<div class="small-12 medium-4 columns account-holder">
		<a href="#" class="mobile-toggle"><i class="fa fa-bars"></i></a>
		<?php if ($header_wishlist != 'off') { do_action( 'thb_quick_wishlist' ); } ?>
		<?php if ($header_search != 'off') { do_action( 'thb_quick_search' ); } ?>
		<div class="secondary-menu-holder">
		<?php if (has_nav_menu('acc-menu-in') && is_user_logged_in()) { ?>
		  <?php wp_nav_menu( array( 'theme_location' => 'acc-menu-in', 'depth' => 1, 'container' => false, 'walker' => new thb_MegaMenu ) ); ?>
		<?php } else if (has_nav_menu('acc-menu-out') && !is_user_logged_in()) { ?>
			<?php wp_nav_menu( array( 'theme_location' => 'acc-menu-out', 'depth' => 1, 'container' => false, 'walker' => new thb_MegaMenu ) ); ?>
		<?php } ?> 
		</div>
		<?php if ($header_cart != 'off') { do_action( 'thb_quick_cart' ); } ?>
	</div>
</header>