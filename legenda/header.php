<!doctype html>
<html <?php language_attributes(); ?> <?php et_html_tag_schema(); ?>>
<head>
    <?php global $etheme_responsive, $woocommerce;; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=1200">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10" >
    <?php if($etheme_responsive): ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <?php endif; ?>
	<link rel="shortcut icon" href="<?php echo et_get_favicon(); ?>" />
	<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', ETHEME_DOMAIN ), max( $paged, $page ) );

		?></title>
		
        <!--[if IE 9]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri().'/css/'; ?>ie9.css"><![endif]-->
        
		<?php
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>
        
</head>
<?php
	$ht = ''; $ht = apply_filters('custom_header_filter',$ht);

	if ($ht == 9) {
	 	$ht = 'transparent';
	}
?>
<body <?php body_class($ht); ?>>
	<?php if(etheme_get_option('mobile_loader')): ?>
		<div class="mobile-loader hidden-desktop">
			<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>
			<h5><?php _e('Loading the content...', ETHEME_DOMAIN); ?></h5>
		</div>
	<?php endif; ?>

	<div class="mobile-nav side-block">
		<div class="close-mobile-nav close-block"><?php _e('Navigation', ETHEME_DOMAIN) ?></div>
		<?php 
			wp_nav_menu(array(
				'theme_location' => 'mobile-menu'
			)); 
		?>

		<?php if (etheme_get_option('top_links')): ?>
			<div class="mobile-nav-heading"><i class="fa fa-user"></i><?php _e('Account', ETHEME_DOMAIN); ?></div>
			<?php etheme_top_links(array('popups' => false)); ?>
		<?php endif; ?>	

		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('mobile-sidebar')): ?>
			
		<?php endif; ?>

		<?php if (etheme_get_option('search_form')): ?>
			<div class="search">
					<?php echo etheme_search(array()); ?>
			</div>
		<?php endif ?>
	</div>

	<?php if(etheme_get_option('right_panel')): ?>
		<div class="side-area side-block hidden-phone hidden-tablet">
			<div class="close-side-area close-block"><i class="icon-remove"></i></div>
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('right-panel-sidebar')): ?>
				
				<div class="sidebar-widget">
					<h6><?php _e('Add any widgets you want in Apperance->Widgets->"Right side panel area"', ETHEME_DOMAIN) ?></h6>
				</div>

			<?php endif; ?>	
		</div>
	<?php endif; ?>	

	<?php $ht = ''; $ht = apply_filters('custom_header_filter',$ht); ?>


	<?php if (etheme_get_option('fixed_nav')): ?>
		<div class="fixed-header-area fixed-menu-type<?php etheme_option('menu_type'); ?> hidden-phone">
			<div class="fixed-header">
				<div class="container">
					<div class="menu-wrapper">
                        
					    <div class="menu-icon hidden-desktop"><i class="icon-reorder"></i></div>
						<div class="logo-with-menu">
							<?php etheme_logo(); ?>
						</div>

						<div class="modal-buttons">
							<?php if (class_exists('Woocommerce') && etheme_get_option('top_links')): ?>
	                        	<a href="#" class="shopping-cart-link hidden-desktop" data-toggle="modal" data-target="#cartModal">&nbsp;</a>
							<?php endif ?>
							<?php if (is_user_logged_in() && etheme_get_option('top_links')): ?>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="my-account-link hidden-desktop">&nbsp;</a>
							<?php elseif(etheme_get_option('top_links')): ?>
								<a class="popup-with-form my-account-link hidden-tablet hidden-desktop" href="#loginModal">&nbsp;</a>
							<?php endif ?>
							<?php if (etheme_get_option('search_form')): ?>
								<a class="popup-with-form search-link" href="#searchModal">&nbsp;</a>
							<?php endif ?>
						</div>

						<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
							<?php wp_nav_menu(array(
								'theme_location' => 'main-menu',
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 4,
								'fallback_cb' => false,
								'walker' => new Et_Navigation
							)); ?>
						<?php else: ?>
							<p class="install-info">Set your main menu in <strong>Apperance &gt; Menus</strong></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif ?>
	
	<?php if (etheme_get_option('top_panel')): ?>
		<div class="top-panel">
			<div class="container">
				<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('top-panel-sidebar')): ?>
					
					<div class="sidebar-widget">
						<h6><?php _e('Add any widgets you want in Apperance->Widgets->"Hidden top panel area"', ETHEME_DOMAIN) ?></h6>
					</div>

				<?php endif; ?>	
			</div>
		</div>
	<?php endif ?>

	<div class="page-wrapper">

	 <?php if ($ht == 9) {
	 	$ht = '4 transparent';
	 } 
	 	$ht .= ' ' . etheme_get_option('header_color_scheme');
	 ?>

	<div class="header-wrapper<?php if(etheme_get_option('fade_animation')): ?> fade-in delay1<?php endif; ?> header-type-<?php echo $ht; ?>">
		<?php if (etheme_get_option('top_bar')): ?>
			<div class="top-bar">
				<div class="container">
					<div class="row-fluid">
						<div class="languages-area">
							<?php if(etheme_get_option('languages_area') && (!function_exists('dynamic_sidebar') || !dynamic_sidebar('languages-sidebar'))): ?>
									<div class="languages hidden-phone">
										<ul class="links">
											<li class="active"><a href="#">EN</a></li>
											<li><a href="#">DE</a></li>
											<li><a href="#">ES</a></li>
											<li><a href="#">FR</a></li>
										</ul>
									</div>
							<?php endif; ?>	
						</div>
						
						<?php if (etheme_get_option('top_panel')): ?>
							<div class="show-top-panel hidden-phone"></div>
						<?php endif ?>
						
						<?php if (etheme_get_option('search_form')): ?>
							<div class="search hide-input a-right">
								<a class="popup-with-form search-link" href="#searchModal">search</a>
							</div>
						<?php endif ?>

						<?php if (class_exists('Woocommerce')): ?>
                        	<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="shopping-cart-link" ><span><?php _e('Cart', ETHEME_DOMAIN) ?></span><span class="price-summ cart-totals"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></a>
                        	
						<?php endif ?>


						<?php if (is_user_logged_in() && etheme_get_option('top_links')): ?>
							<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="my-account-link hidden-desktop">&nbsp;</a>
						<?php elseif(etheme_get_option('top_links')): ?>
							<a class="popup-with-form my-account-link hidden-tablet hidden-desktop" href="#loginModal">&nbsp;</a>
						<?php endif ?>



						<?php if (etheme_get_option('top_links')): ?>
							<div class="top-links hidden-phone a-center">
								<?php etheme_top_links(); ?>
							</div>
						<?php endif ?>

						<?php if (class_exists('YITH_WCWL') && etheme_get_option('wishlist_link')): $wl = new YITH_WCWL(array());?>
							<div class="fl-r wishlist-link">
								<a href="<?php echo $wl->get_wishlist_url(); ?>"><i class="icon-heart-empty"></i><span><?php _e('Wishlist', ETHEME_DOMAIN) ?></span></a>
							</div>
						<?php endif ?>
						<?php if(etheme_get_option('right_panel')): ?>
							<div class="side-area-icon hidden-phone hidden-tablet"><i class="icon-reorder"></i></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif ?>

		<header class="header header<?php echo $ht; if(!et_is_woo_exists()){echo " without-woocommerce";} ?>">

			<div class="container">
				<div class="table-row">

    				<?php if (etheme_get_option('search_form')): ?>
    					<div class="search search-left hidden-phone hidden-tablet a-left">
								<?php echo etheme_search(array()); ?>
    					</div>
    				<?php endif ?>
                    
					<div class="logo"><?php etheme_logo(); ?></div>

					<?php if (etheme_get_option('search_form')): ?>
						<div class="search search-center hidden-phone hidden-tablet">
							<div class="site-description hidden-phone hidden-tablet"><?php bloginfo( 'description' ); ?></div>
								<?php echo etheme_search(array()); ?>
						</div>
					<?php endif ?>

					<?php if($ht == 8 && etheme_get_option('search_form')): ?>
						<div class="search hide-input a-right">
	
							<a class="popup-with-form search-link" href="#searchModal">search</a>
						</div>
					<?php endif; ?>

		            <?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
	                    <?php etheme_top_cart(); ?>
		            <?php endif ;?> 
					<div class="menu-icon hidden-desktop"><i class="icon-reorder"></i></div>
				</div>
			</div>

		</header>
		<div class="main-nav visible-desktop">
			<div class="double-border">
				<div class="container">
					<div class="menu-wrapper menu-type<?php etheme_option('menu_type'); ?>">
						<div class="logo-with-menu">
							<?php etheme_logo(); ?>
						</div>
						<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
							<?php wp_nav_menu(array(
								'theme_location' => 'main-menu',
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 4,
								'fallback_cb' => false,
								'walker' => new Et_Navigation
							)); ?>
						<?php else: ?>
							<br>
							<p class="install-info">Set your main menu in <strong>Apperance &gt; Menus</strong></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<?php if($ht == 8): ?>
			<div class="languages-area">
				<?php if((!function_exists('dynamic_sidebar') || !dynamic_sidebar('languages-sidebar'))): ?>
					<div class="languages">
						<ul class="links">
							<li class="active">EN</li>
							<li><a href="#">FR</a></li>
							<li><a href="#">GE</a></li>
						</ul>
					</div>
					<div class="currency">
						<ul class="links">
							<li><a href="#">£</a></li>
							<li><a href="#">€</a></li>
							<li class='active'>$</li>
						</ul>
					</div>
				<?php endif; ?>	
			</div>
		<?php endif; ?>	
	</div>