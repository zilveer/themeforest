<!DOCTYPE html>
<!--[if lt IE 7]><html class="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->


<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php if (ot_get_option('favicon')){
		echo '<link rel="shortcut icon" href="'. esc_url(ot_get_option('favicon')) .'" />';
	} 

	if (ot_get_option('ipad_favicon_retina')){
		echo '<link rel="apple-touch-icon" sizes="152x152" href="'. esc_url(ot_get_option('ipad_favicon_retina')) .'" >';
	} 

	if (ot_get_option('iphone_favicon_retina')){
		echo '<link rel="apple-touch-icon" sizes="120x120" href="'. esc_url(ot_get_option('iphone_favicon_retina')) .'" >';
	}

	if (ot_get_option('ipad_favicon')){
		echo '<link rel="apple-touch-icon" sizes="76x76" href="'. esc_url(ot_get_option('ipad_favicon')) .'" >';
	} 

	if (ot_get_option('iphone_favicon')){
		echo '<link rel="apple-touch-icon" href="'. esc_url(ot_get_option('iphone_favicon')) .'" >';
	} ?>
		
	<?php wp_head(); ?>
</head>
	
<body <?php body_class(); ?>>
	<div id="wrapper">
		
		<?php if( ot_get_option('top_bar', 'off') != 'off' ) {
			get_sidebar('top');
		} ?>
		
		<header id="site-header" role="banner">
			<div id="header-wrapper">
				<div id="header-container" class="clearfix">
					<div id="site-logo">
						<?php get_template_part( 'logo' ); // Include logo.php ?>
					</div>
					
					<nav id="site-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu-container', 'fallback_cb' => 'mnky_no_menu') ); ?>
						
						<?php if( class_exists( 'WooCommerce' ) && ot_get_option('cart_button') != 'off' ) : ?>
							<div class="header_cart_wrapper">
								<?php global $woocommerce; ?>
								<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'craftsman' ); ?>" class="header_cart_link" >
									<?php woocommerce_cart_button(); ?>
								</a>	
								<?php if( ot_get_option('cart_widget') != 'off' ) {
									woocommerce_cart_widget();
								} ?>
							</div>
						<?php endif; ?>
						
						<?php if( ot_get_option('search_button') != 'off' ) : ?>
							<button id="trigger-header-search" class="search_button" type="button">
								<i class="fa fa-search"></i>
							</button>
						<?php endif; ?>		
							
					</nav><!-- #site-navigation -->
										
					<?php if( ot_get_option('search_button') != 'off' ) : ?>
						<div class="header-search">
							<?php get_search_form(); ?>
						</div>
					<?php endif; ?>					
								
					<a href="#mobile-site-navigation" class="toggle-mobile-menu"><i class="fa fa-bars"></i></a>
				</div><!-- #header-container -->
			</div><!-- #header-wrapper -->	
		</header><!-- #site-header -->	
		
		<?php get_template_part( 'title' ); // Include title.php ?>
		
		<div id="main" class="clearfix">