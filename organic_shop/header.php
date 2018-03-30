<?php 
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	// Fetch options stored in $qns_data
	global $qns_data;
	
	if(is_plugin_active('woocommerce/woocommerce.php')) {
	      global $woocommerce;
	}

?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html <?php language_attributes(); ?> class="ie6"> <![endif]-->
<!--[if IE 7]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	
	<?php 
		// Dislay Google Analytics Code
		if( $qns_data['google-analytics'] ) { 
			echo $qns_data['google-analytics'];
		}
		
		// Dislay Favicon
		if( $qns_data['favicon_url'] ) {		
			echo '<link rel="shortcut icon" href="' . $qns_data['favicon_url'] . '" type="image/x-icon" />';
		}
	?>
	
	<!-- Title -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css"  media="all"  />
	
	<?php // Load Google Fonts
		echo google_fonts();
	?>
	
	<!-- RSS Feeds & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head() ?>
	
	<?php // Load Custom CSS 
		echo custom_css(); 
	?>
	
<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

	<!-- BEGIN .wrapper -->
	<div class="wrapper">
		
		<!-- BEGIN .topbar -->
		<div class="topbar clearfix">
			
			<?php echo display_social(); ?>
			
			<!-- BEGIN .topbar-right -->
			<div class="topbar-right clearfix">			
				
				<?php // Display WooCommerce links
					if( $qns_data['top-right-chk-acc'] and is_plugin_active('woocommerce/woocommerce.php') ) {
				
						// Get "My Account" page URL
						$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
						if ( $myaccount_page_id ) {
					  		$myaccount_page_url = get_permalink( $myaccount_page_id );
						}
				?>
				
					<ul class="clearfix">
						<li class="checkout-icon"><a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>"><?php _e('Checkout','qns'); ?></a></li>
						<li class="myaccount-icon"><a href="<?php echo $myaccount_page_url; ?>"><?php _e('My Account','qns'); ?></a></li>
						
						<?php if ( is_user_logged_in() ) {
							echo '<li class="logout-icon"><a href="' . wp_logout_url(home_url()) . '">' . __('Logout','qns') . '</a></li>';
						} ?>
						
					</ul>	
				
				<?php } ?>

				<?php if ( has_nav_menu( 'secondary' ) ) { ?>

					<!-- Secondary Menu -->
					<?php wp_nav_menu( array(
						'theme_location' => 'secondary',
						'container' =>false,
						'items_wrap' => '<ul class="clearfix">%3$s</ul>',
						'echo' => true,
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0 )
				 	); ?>

				<?php } ?>
				
				<?php if(is_plugin_active('woocommerce/woocommerce.php')) { ?>
				
					<div class="cart-top">
						<p><a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'qns'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'qns'), $woocommerce->cart->cart_contents_count);?></a></p>
					</div>
				
				<?php } ?>
				
			<!-- END .topbar-right -->
			</div>
		
		<!-- END .topbar -->
		</div>
		
		<?php if( $qns_data['text_logo'] ) : ?>
			<div id="site-title">
				<h1>
					<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
				</h1>
			</div>

		<?php elseif( !empty($qns_data['image_logo']['url']) ) : ?>
			<div id="site-title" class="site-title-image">
				<h1>
					<a href="<?php echo home_url(); ?>"><img src="<?php echo $qns_data['image_logo']['url']; ?>" alt="" /></a>
				</h1>
			</div>

		<?php else : ?>	
			<div id="site-title">
				<h1>
					<a href="<?php echo home_url(); ?>"><?php _e('Organic <span>shop</span>','qns'); ?></a>
				</h1>
			</div>
		<?php endif ?>

		<!-- BEGIN .main-menu-wrapper -->
		<div id="main-menu-wrapper" class="clearfix">
			
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'container' =>false,
				'items_wrap' => '<ul id="main-menu" class="fl clearfix">%3$s</ul>',
				'fallback_cb' => 'wp_page_menu_qns',
				'echo' => true,
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'depth' => 0 )
			); ?>
			
			<?php if( $qns_data['main_menu_search'] ) {	?>
			
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="menu-search" class="fr">
				<input type="text" name="s" />
				
				<?php if( $qns_data['menu_search_type'] == 'product-search' ) {	?>
					<input type="hidden" name="post_type" value="product" />
				<?php } ?>
				
			</form>
		
			<?php } ?>
			
		<!-- END .main-menu-wrapper -->	
		</div>