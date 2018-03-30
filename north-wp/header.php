<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_site_icon(); ?>
	<?php
		$id = get_queried_object_id();
		
		$snap_scroll = (get_post_meta($id, 'snap_scroll', true) == 'on' ? 'snap_scroll' : '');
		$rev_slider_alias = get_post_meta($id, 'rev_slider_alias', true);
	?>
	<?php 
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head(); 
	?>
</head>
<body <?php body_class(); ?> data-revslider="<?php echo esc_attr($rev_slider_alias); ?>">
<div id="wrapper" class="open">
	
	<!-- Start Mobile Menu -->
	<nav id="mobile-menu">
		<a href="#" class="thb-close" title="<?php _e('Close', 'north'); ?>"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="12" height="12" viewBox="1.1 1.1 12 12" enable-background="new 1.1 1.1 12 12" xml:space="preserve"><path d="M8.3 7.1l4.6-4.6c0.3-0.3 0.3-0.8 0-1.2 -0.3-0.3-0.8-0.3-1.2 0L7.1 5.9 2.5 1.3c-0.3-0.3-0.8-0.3-1.2 0 -0.3 0.3-0.3 0.8 0 1.2L5.9 7.1l-4.6 4.6c-0.3 0.3-0.3 0.8 0 1.2s0.8 0.3 1.2 0L7.1 8.3l4.6 4.6c0.3 0.3 0.8 0.3 1.2 0 0.3-0.3 0.3-0.8 0-1.2L8.3 7.1z"/></svg></a>
		<div class="custom_scroll" id="menu-scroll">
			<div>
				
				<?php if(has_nav_menu('mobile-menu')) { ?>
				  <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'mobile-menu', 'walker' => new thb_mobileDropdown ) ); ?>
				<?php } else { ?>
					<ul class="mobile-menu">
						<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>"><?php esc_html_e( 'Please assign a menu', 'north' ); ?></a></li>
					</ul>
				<?php } ?>
				<?php if (has_nav_menu('acc-menu-in') && is_user_logged_in()) { ?>
				  <?php wp_nav_menu( array( 'theme_location' => 'acc-menu-in', 'depth' => 1, 'container' => false, 'menu_class' => 'mobile-secondary-menu', 'walker' => new thb_mobileDropdown ) ); ?>
				<?php } else if (has_nav_menu('acc-menu-out') && !is_user_logged_in()) { ?>
					<?php wp_nav_menu( array( 'theme_location' => 'acc-menu-out', 'depth' => 1, 'container' => false, 'menu_class' => 'mobile-secondary-menu', 'walker' => new thb_mobileDropdown ) ); ?>
				<?php } ?> 
				<div class="social-links">
					<?php do_action( 'thb_social' ); ?>
				</div>
			</div>
		</div>
	</nav>
	<!-- End Mobile Menu -->
	
	<!-- Start Quick Cart -->
	<?php do_action( 'thb_side_cart' ); ?>
	<!-- End Quick Cart -->
	
	<!-- Start Content Container -->
	<section id="content-container">
		<!-- Start Content Click Capture -->
		<div class="click-capture"></div>
		<!-- End Content Click Capture -->
		
		<!-- Start Header -->
		<?php 
			get_template_part( 'inc/header/header-'.ot_get_option('header_style','style1').'-'.ot_get_option('logo_position','center').'' );
		?>
		<!-- End Header -->
		<?php if (is_page() && $rev_slider_alias) {?>
		<div id="home-slider">
			<?php if (function_exists('putRevSlider')) { putRevSlider($rev_slider_alias); do_action('thb_arrow_nav'); } ?>
		</div>
		<?php  } ?>
		<?php if(!empty($snap_scroll)) { ?><div class="ai-dotted ai-indicator"><span class="ai-inner1"></span><span class="ai-inner2"></span><span class="ai-inner3"></span></div><?php } ?>
		<div role="main">