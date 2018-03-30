<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

	<!--// OPEN HEAD //-->
	<head>
		<?php
			$options = get_option('sf_flexform_options');
			$enable_responsive = $options['enable_responsive'];
			$is_responsive = "responsive-fluid";
			if (!$enable_responsive) {
				$is_responsive = "responsive-fixed";
			}
			$header_layout = $options['logo_layout'];
			$page_layout = $options['page_layout'];
			$logo = $retina_logo = "";
			if (isset($options['logo_upload'])) {
			$logo = $options['logo_upload'];
			}
			if (isset($options['retina_logo_upload'])) {
			$retina_logo = $options['retina_logo_upload'];
			}
			if ($logo == "") {
			$logo = get_template_directory_uri() . '/images/logo.png';
			}
			if ($retina_logo == "") {
			$retina_logo = $logo;
			}
			
			$enable_logo_fade = $options['enable_logo_fade'];
			$enable_page_shadow = $options['enable_page_shadow'];
			$enable_top_bar = $options['enable_top_bar'];
			$top_bar_menu = $options['top_bar_menu'];
			$top_bar_social_icons = $options['top_bar_social_icons'];
			$show_sub = $options['show_sub'];
			$show_translation = $options['show_translation'];
			$show_account = $options['show_account'];
			$show_cart = $options['show_cart'];
			$sub_code = $options['sub_code'];
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			
			$enable_mini_header = $options['enable_mini_header'];
			$enable_nav_indicator = $options['enable_nav_indicator'];
			
			$enable_header_shadow = $options['enable_header_shadow'];
			
			$page_class = $logo_class = $nav_class = "";
			
			if ($enable_page_shadow) { 
			$page_class = "page-shadow ";
			}
			
			if ($enable_logo_fade) {
			$logo_class = "logo-fade";
			}
			
			if ($enable_nav_indicator) {
			$nav_class .= "nav-indicator ";
			}
			
			$enable_nav_search = 1;
			
			if (isset($options['enable_nav_search'])) {
				$enable_nav_search = $options['enable_nav_search'];
			}
						
			if (isset($_GET['layout'])) {
				$page_layout = $_GET['layout'];
			}
			
			global $post;
			$extra_page_class = "";
			if ($post) {
				$extra_page_class = get_post_meta($post->ID, 'sf_extra_page_class', true);
				$hide_page_header = get_post_meta($post->ID, 'sf_hide_page_header', true);
				$hide_page_footer = get_post_meta($post->ID, 'sf_hide_page_footer', true);
				
				if ($hide_page_header) {
					$page_class .= "hide-header ";
				}
				
				if ($hide_page_footer) {
					$page_class .= "hide-footer ";
				}
			}
		?>
		
		<!--// SITE TITLE //-->
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		
		
		<!--// SITE META //-->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />	
		<?php if ($enable_responsive) { ?><meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"><?php } ?>
		
		
		<!--// PINGBACK & FAVICON //-->
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php if (isset($options['custom_favicon'])) { ?><link rel="shortcut icon" href="<?php echo $options['custom_favicon']; ?>" /><?php } ?>
				
		<?php
			$options = get_option('sf_flexform_options');
			
			$custom_fonts = $google_font_one = $google_font_two = $google_font_three = "";

			$body_font_option = $options['body_font_option'];
			if (isset($options['google_standard_font'])) {
			$google_standard_font = explode(':', $options['google_standard_font']);
			$google_font_one = str_replace("+", " ", $google_standard_font[0]);
			}
			$headings_font_option = $options['headings_font_option'];
			if (isset($options['google_heading_font'])) {
			$google_heading_font = explode(':', $options['google_heading_font']);
			$google_font_two = str_replace("+", " ", $google_heading_font[0]);
			}
			
			$menu_font_option = $options['menu_font_option'];
			if (isset($options['google_menu_font'])) {
			$google_menu_font = explode(':', $options['google_menu_font']);
			$google_font_three = str_replace("+", " ", $google_menu_font[0]);
			}
			
			    
			if ($body_font_option == "google" && $google_font_one != "") {
				$custom_fonts .= "'".$google_font_one."', ";
			}
			if ($headings_font_option == "google" && $google_font_two != "") {
				$custom_fonts .= "'".$google_font_two."', ";
			}
			if ($menu_font_option == "google" && $google_font_three != "") {
				$custom_fonts .= "'".$google_font_three."', ";
			}
			
			$fontdeck_js = $options['fontdeck_js'];
		?>
		<?php if (($body_font_option == "google") || ($headings_font_option == "google") || ($menu_font_option == "google")) { ?>
		<!--// GOOGLE FONT LOADER //-->
		<script>
			var html = document.getElementsByTagName('html')[0];
			html.className += '  wf-loading';
			setTimeout(function() {
			  html.className = html.className.replace(' wf-loading', '');
			}, 3000);
			
			WebFontConfig = {
			    google: { families: [<?php echo $custom_fonts; ?> 'Vidaloka'] }
			};
			
			(function() {
				document.getElementsByTagName("html")[0].setAttribute("class","wf-loading")
				//  NEEDED to push the wf-loading class to your head
				document.getElementsByTagName("html")[0].setAttribute("className","wf-loading")
				// for IE…
			
			var wf = document.createElement('script');
				wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				 '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'false';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
			})();
		</script>
		<?php } ?>
		<?php if (($body_font_option == "fontdeck") || ($headings_font_option == "fontdeck") || ($menu_font_option == "fontdeck")) { ?>
		<!--// FONTDECK LOADER //-->
		<?php echo $fontdeck_js; ?>
		<?php } ?>
		
			<!--// LEGACY HTML5 SUPPORT //-->
			<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/excanvas.compiled.js"></script>
		<![endif]-->
		
		<!--// WORDPRESS HEAD HOOK //-->
		<?php wp_head(); ?>
	
	<!--// CLOSE HEAD //-->
	</head>
	
	<!--// OPEN BODY //-->
	<body <?php body_class($page_class . ' ' . $is_responsive . ' ' . $extra_page_class); ?>>
		
		<?php if (is_single()) { ?>
		<!--// SOCIAL SCRIPTS //-->
		<script type="text/javascript" src="//ws.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "ur-72c8cf80-2647-2464-a894-abc33849d467", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
		<?php } ?>
		
		<!--// NO JS ALERT //-->
		<noscript>
			<div class="no-js-alert"><?php _e("Please enable JavaScript to view this website.", "swiftframework"); ?></div>
		</noscript>
				
		<!--// OPEN #container //-->
		<?php if ($page_layout == "fullwidth") { ?>
		<div id="container">
		<?php } else { ?>
		<div id="container" class="boxed-layout">
		<?php } ?>
			
			<?php if ($enable_top_bar) { ?>
			
			<!--// OPEN TOP BAR //-->
			<?php if ($top_bar_menu) { ?>
			<div id="top-bar" class="top-bar-menu-left">
			<?php } else { ?>
			<div id="top-bar" class="top-bar-menu-right">
			<?php } ?>
				<div class="container">
					<div class="row">
						<a href="#" class="visible-phone show-menu"><?php _e("Select a page", "swiftframework"); ?><i class="icon-angle-down"></i></a>
						<nav id="top-bar-menu" class="top-menu span8 clearfix">						
							<div id="aux-nav">
								<ul class="menu">
									<?php if ($show_cart) { ?>
									<li class="parent aux-cart">
										<a href="#" class="cart-menu-item"><?php _e("Cart", "swiftframework"); ?></a>
										<ul id="header-cart" class="sub-menu">
											<?php global $woocommerce; ?>
											<?php if ($woocommerce) { ?>
											<li>
												<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
											</li>
											<?php } else { ?>
											<li>
												<div><?php _e("Please install WooCommerce", "swiftframework"); ?></div>
											</li>
											<?php } ?>
										</ul>
									</li>
									<?php } ?>
									<?php if ($show_sub) { ?>
									<li class="parent aux-subscribe">
										<a href="#"><?php _e("Subscribe", "swiftframework"); ?></a>
										<ul class="sub-menu">
											<li>
												<div id="header-subscribe" class="clearfix">
													<?php echo do_shortcode($sub_code); ?>
												</div>
											</li>
										</ul>
									</li>
									<?php } ?>
									<?php if ($show_account) { ?>
									<li class="parent">
										<a href="#"><?php _e("Account", "swiftframework"); ?></a>
										<ul class="sub-menu aux-account">
											<?php if (!is_user_logged_in()) { ?>
											<li>
												<div id="header-login" class="clearfix">
													<form action="<?php echo wp_login_url(); ?>" autocomplete="off" method="post" class="clearfix">
													<label for="username">Username</label>
													<input type="text" name="log" id="username" value="" placeholder="<?php _e("Username", "swiftframework"); ?>" size="20" />
													<label for="username">Password</label>
													<input type="password" name="pwd" id="password" placeholder="<?php _e("Password", "swiftframework"); ?>" size="20" />
													<input type="submit" name="submit" value="Login" id="submit" class="sf-button slightlyrounded accent"/>
													<div class="link-wrap">
													<a href="<?php echo site_url('/wp-login.php?action=register&amp;redirect_to=' . get_permalink()); ?>" class="register"><?php _e("Register", "swiftframework"); ?></a>
													<span> / </span>
													<a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" class="recover-password"><?php _e("Forgot login?", "swiftframework"); ?></a>
													</div>
													</form>
												</div>
											</li>
											<?php } else { ?>
											<li>
												<?php if ( $myaccount_page_id ) { ?>
												<a href="<?php echo get_permalink( $myaccount_page_id ); ?>" class="admin-link"><?php _e("My Account", "swiftframework"); ?></a>
												<?php } else { ?>
												<a href="<?php echo get_admin_url(); ?>" class="admin-link"><?php _e("WordPress Admin", "swiftframework"); ?></a>
												<?php } ?>
											</li>
											<li>
												<a href="<?php echo wp_logout_url( home_url() ); ?>" class="logout-link"><?php _e("Logout", "swiftframework"); ?></a>
											</li>
											<?php } ?>
										</ul>
									</li>
									<?php } ?>
									<?php if ($show_translation) { ?>
									<li class="parent aux-languages">
										<a href="#" class="languages-menu-item"><span><?php _e("Languages", "swiftframework"); ?></span></a>
										<ul id="header-languages" class="sub-menu">
											<?php
												if (function_exists( 'language_flags' )) {
													language_flags();
												}
											?>
										</ul>
									</li>
									<?php } ?>
								</ul>
							</div>	
							<?php
								if(function_exists('wp_nav_menu')) {
								wp_nav_menu(array(
								'theme_location' => 'top_bar_menu',
								'fallback_cb' => ''
								)); }
							?>
						</nav>
						<div id="top-bar-social" class="span4 clearfix">
							<?php echo do_shortcode($top_bar_social_icons); ?>
						</div>
					</div>
				</div>
			<!--// CLOSE TOP BAR //-->
			</div>
			<?php } ?>
			
			<!--// OPEN #header-section //-->
			<div id="header-section" class="<?php echo $header_layout; ?> <?php echo $logo_class; ?> clearfix">
			
				<div class="container">
				
					<header class="row">
					
						<div id="logo" class="span3 clearfix">
							<a href="<?php echo home_url(); ?>">
								<img class="standard" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
								<img class="retina" src="<?php echo $retina_logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
							</a>
						</div>
						
						<!--// OPEN NAV SECTION //-->
						<div id="nav-section" class="<?php echo $nav_class; ?> span9 clearfix">
							<div class="nav-wrap clearfix">
								
								<!--// OPEN MAIN NAV //-->
								<a href="#" class="visible-phone show-menu"><?php _e("Select a page", "swiftframework"); ?><i class="icon-angle-down"></i></a>
								<nav id="main-navigation">
									
									<?php
									if(function_exists('wp_nav_menu')) {
									wp_nav_menu(array(
									'theme_location' => 'main_navigation',
									'fallback_cb' => ''
									)); }
									?>
			
								<!--// CLOSE MAIN NAV //-->
								</nav>
								
								<?php if ($enable_nav_search) { ?>
								
								<div id="nav-search">
									<a href="#" class="nav-search-link"><i class="icon-search"></i></a>
									<form method="get" action="<?php echo home_url(); ?>/">
										<input type="text" name="s" autocomplete="off" />
									</form>
								</div>
								
								<?php } ?>
											
							</div>
						<!--// CLOSE NAV SECTION //-->
						</div>
	
					</header>
				</div>
			</div>
			
			<?php if ($enable_mini_header) { ?>
			
			<!--// OPEN #mini-header //-->
			<div id="mini-header" class="<?php echo $header_layout; ?> clearfix">
				<div class="container">
					<div class="nav-wrap row clearfix">	
						
						<div id="mini-logo" class="span3 clearfix">
							<a href="<?php echo home_url(); ?>">
								<img class="standard" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
								<img class="retina" src="<?php echo $retina_logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
							</a>
						</div>
						
						<div class="mini-nav-wrap span9 clearfix">
						
							<div class="nav-wrap clearfix">
								
								<!--// OPEN #main-navigation //-->
								<nav id="mini-navigation">
			
									<?php
									if(function_exists('wp_nav_menu')) {
									wp_nav_menu(array(
									'theme_location' => 'main_navigation',
									'fallback_cb' => ''
									)); }
									?>
			
								<!--// OPEN #main-navigation //-->
								</nav>
								
							</div>
						
						</div>
						
					</div>
				</div>
			<!--// CLOSE #mini-header //-->
			</div>
			
			<?php } ?>
				
			<!--// OPEN #main-container //-->
			<div id="main-container" class="clearfix">
				
				<?php if ($enable_header_shadow) { ?>
				<div id="header-shadow"></div>
				<?php } ?>
				
				<?php
					if (is_page()) {
						$show_posts_slider = get_post_meta($post->ID, 'sf_posts_slider', true);
						$rev_slider_alias = get_post_meta($post->ID, 'sf_rev_slider_alias', true);
						if ($show_posts_slider) {
							get_posts_slider();
						} else if ($rev_slider_alias != "") { ?>
							<div class="home-slider-wrap">
								<?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
							</div>
						<?php }
					}
				?>
				
				<!--// OPEN .container //-->
				<div class="container">
				
					<!--// OPEN #page-wrap //-->
					<div id="page-wrap">
					