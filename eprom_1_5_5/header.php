<!DOCTYPE html>
<?php global $r_option, $woocommerce; ?>
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if IE 10 ]>   <html <?php language_attributes(); ?> class="ie10"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> >
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<?php if (isset($r_option['responsive']) && $r_option['responsive'] == 'on') : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php endif; ?>
	<title><?php wp_title('|', true, 'right'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if (isset($r_option['favicon']) && $r_option['favicon'] != '') : ?>
	<link rel="icon" href="<?php echo $r_option['favicon']; ?>"/>
	<link rel="shortcut icon" href="<?php echo $r_option['favicon']; ?>"/>
	<?php endif; ?>
	<style type="text/css">
		<?php  
		   /* BG */
		   if (is_page() || is_single()) {
				$page_header_bg = get_post_meta($wp_query->post->ID, '_page_header_bg', true);
				if (isset($page_header_bg) && $page_header_bg != '') {
					$page_header_bg = substr_replace($page_header_bg ,' !important;',-1);
					echo "#page-header {\n" . theme_path($page_header_bg) . "\n}\n";
				}
			}
		?>
	</style>
	<?php wp_head();?>
</head>
<body  <?php body_class(); ?>>
<!--[if lte IE 7]>
<div id="ie-message"><p><?php _e('You are using Internet Explorer 7.0 or older to view this site. Your browser is an eight year old browser which does not display modern web sites properly. Please upgrade to a newer browser to fully enjoy the web. <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">Upgrade your browser</a>', SHORT_NAME); ?></p></div>
<![endif]-->
<section id="main-wrapper">
<?php if (QTRANS && isset($r_option['qtrans_widget']) && $r_option['qtrans_widget'] == 'on') : ?>
<!-- qtranslate plugin -->
<section id="qtrans-language-chooser">
	<div class="container">
		<?php 
			$qtrans_display_type = 'text';
			if (isset($r_option['qtrans_display_type']))
				$qtrans_display_type = $r_option['qtrans_display_type'];
			echo qtrans_generateLanguageSelectCode($qtrans_display_type, 'qtrans-header-lang-chooser'); 
		?>	
	</div>
</section>
<!-- /qtranslate plugin -->
<?php endif; ?>

<?php if ( ! isset( $r_option['top_menu'] ) || $r_option['top_menu'] == 'on' ) : ?>
<!-- top menu -->
<div id="top-wrap" class="clearfix">
	<nav class="container clearfix" role="navigation">
		<?php if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'top_menu' ) ) { ?>
		<?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top_menu' ) ); ?>
		<?php } ?>
		<?php
			echo '<ul class="nav top-right-nav">';
			if ( class_exists( 'woocommerce' ) ) {
				echo '<li class="cart cart-wrap">';
				r_cart_details();
				echo '</li>';
				echo '<li class="checkout"><a href="'.esc_url($woocommerce->cart->get_checkout_url()).'"><i class="icon icon-checkmark"></i>'.__('Checkout','woothemes').'</a></li>';
			}


			echo '<li class="search">';
			get_search_form();
			echo '</li>';
			echo '</ul>';

		?>
	</nav>
</div>
<!-- /top menu -->
<?php endif; ?>

<!-- header -->
<header id="header">
	<div class="container">
		<?php if (isset($r_option['logo']) && $r_option['logo'] != '') : ?>
		<a id="logo" href="<?php echo home_url(); ?>" title="<?php esc_attr(bloginfo('name', 'display')); ?>" ><img src="<?php echo $r_option['logo']; ?>" title="<?php esc_attr(bloginfo('name', 'display')); ?>" alt="<?php esc_attr(bloginfo('name', 'display')); ?>" /></a>
		<!-- /logo -->
		<?php endif; ?>
		<!-- nav -->
		<?php 
			if (has_nav_menu('main')) wp_nav_menu(array('walker' => new RMenu_Walker_Nav_Menu, 'theme_location' => 'main', 'container' => 'nav', 'container_id' => 'main-nav'));
			else echo '<p class="warning" style="width:50%;position:absolute;right:0">' . __('The main menu has not selected location or does not exist. Go to Wordpress > Appearance > Menus and set your menu.', SHORT_NAME) . '</p>';
		?>
		<!-- /nav -->
	</div>
</header>