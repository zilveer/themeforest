<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

<!-- Supreme - A Responsive Magazine/Blog WordPress Theme - Designed & Developed by Swift Ideas ( www.swiftideas.net ) -->

	<!--// OPEN HEAD //-->
	<head>
		
		<?php
			$options = get_option('sf_supreme_options');
			
			$theme_detailing = get_option('theme_detailing', 'light');
			$enable_responsive = $options['enable_responsive'];
			$header_layout = $options['logo_layout'];
			$page_layout = $options['page_layout'];
			$logo = $options['logo_upload'];
			$retina_logo = $options['retina_logo_upload'];
			if ($logo == "") {
			$logo = get_template_directory_uri() . '/images/logo.png';
			}
			if ($retina_logo == "") {
			$retina_logo = $logo;
			}
			
			$enable_logo_fade = $options['enable_logo_fade'];
			$enable_page_shadow = $options['enable_page_shadow'];
			$enable_top_bar = $options['enable_top_bar'];
			$top_bar_social_icons = $options['top_bar_social_icons'];
			$header_ad_config = $options['header_ad_config'];
			$enable_mini_header = $options['enable_mini_header'];
			$enable_nav_indicator = $options['enable_nav_indicator'];
			$enable_nav_shadow = $options['enable_nav_shadow'];
			$enable_menu_dividers = $options['enable_menu_dividers'];
			
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
			if ($enable_nav_shadow) {
			$nav_class .= "nav-shadow ";
			}
			if ($enable_menu_dividers) {
			$nav_class .= "menu-dividers ";
			}
			
			if (isset($_GET['layout'])) {
				$page_layout = $_GET['layout'];
			}
		?>
		
		<!--// SITE TITLE //-->
		<?php
			global $page, $paged;
			echo "<title>";
			// Add the blog name.
			bloginfo( 'name' );
			wp_title( '|', true, 'left' );
			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";
			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', 'swiftframework' ), max( $paged, $page ) );
			echo "</title>";
		?>
		
		<!--// SITE META //-->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />	
		<?php if ($enable_responsive) { ?><meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"><?php } ?>
				
				
		<!--// PINGBACK & FAVICON //-->
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php $favicon = $options['custom_favicon'];?>
		<?php if ($favicon != "") { ?><link rel="shortcut icon" href="<?php echo $favicon; ?>" /><?php } ?>


	    <!--[if lt IE 9]>
	    <!--// LEGACY HTML SUPPORT //-->
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<!--// GOOGLE FONT LOADER //-->
		<?php
			$options = get_option('sf_supreme_options');
			$use_custom_font_one = $options['use_custom_font_one'];
			$custom_font_one = explode(':', $options['standard_font']);
			$use_custom_font_two = $options['use_custom_font_two'];
			$custom_font_two = explode(':', $options['heading_font']);
			$use_custom_font_impact = $options['use_custom_font_impact'];
			$custom_font_impact = explode(':', $options['impact_font']);
			$custom_fonts = "";
			$google_font_one = str_replace("+", " ", $custom_font_one[0]);
			$google_font_two = str_replace("+", " ", $custom_font_two[0]);
			$google_font_impact = str_replace("+", " ", $custom_font_impact[0]);
			    
			if ($use_custom_font_one) {
				$custom_fonts .= "'".$google_font_one."', ";
			}
			if ($use_custom_font_two) {
				$custom_fonts .= "'".$google_font_two."', ";
			}
			if ($use_custom_font_impact) {
				$custom_fonts .= "'".$google_font_impact."', ";
			}
		?>
		<script>
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
		
				
		<!--// WORDPRESS HEADER HOOK //-->
		<?php wp_head(); ?>
	
	
	<!--// CLOSE HEAD //-->
	</head>
	
		
	<!--// OPEN BODY //-->
	<body <?php body_class($theme_detailing . ' ' . $page_class); ?>>
		
		<!-- OPEN Social Scripts -->
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "ur-72c8cf80-2647-2464-a894-abc33849d467", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
		<!-- CLOSE Social Scripts -->
	
		<noscript>
			<div class="no-js-alert">
				<?php _e("Please enable JavaScript to view this website.", "swiftframework"); ?>
			</div>
		</noscript>
		
		<?php if ($enable_top_bar) { ?>
		<?php if ($page_layout == "fullwidth") { ?>
		<div id="top-bar">
		<?php } else { ?>
		<div id="top-bar" class="boxed-layout">
		<?php } ?>
			<div class="container">
				<nav id="top-bar-menu" class="top-menu twelve columns clearfix">
				
					<div id="top-bar-date"><?php echo date(get_option('date_format')); ?></div>
					
					<?php
						if(function_exists('wp_nav_menu')) {
						wp_nav_menu(array(
						'theme_location' => 'top_bar_menu',
						'fallback_cb' => ''
						)); }
					?>
				</nav>
				
				<nav id="mobile-top-bar-menu" class="mobile-nav">
				<span class="selected-option"><?php _e("- Menu -", "swiftframework"); ?></span>
				<?php
					dropdown_menu( array(

						'theme_location' => 'top_bar_menu',

					    // You can alter the blanking text eg. "- Navigate -" using the following
					    'dropdown_title' => '-- Menu --',

					    // indent_string is a string that gets output before the title of a
					    // sub-menu item. It is repeated twice for sub-sub-menu items and so on
					    'indent_string' => '- ',

					    // indent_after is an optional string to output after the indent_string
					    // if the item is a sub-menu item
					    'indent_after' => ''

					) );
				?>
				<!-- CLOSE #mobile-navigation -->
				</nav>
				<div id="top-bar-social" class="four columns">
					<?php echo do_shortcode($top_bar_social_icons); ?>
				</div>
			</div>
		</div>
		
		<?php } ?>
		
		<?php if (is_active_sidebar('sitewide-ad-widget')) { ?>
		<div id="sitewide-ad">
		<?php dynamic_sidebar('sitewide-advert'); ?>
		</div>
		<?php } ?>
		
		<?php if ($page_layout == "fullwidth") { ?>
		<div id="container">
		<?php } else { ?>
		<div id="container" class="boxed-layout">
		<?php } ?>
	
			<div id="header-section" class="<?php echo $header_layout; ?> <?php echo $logo_class; ?> clearfix">
			
				<div class="container">
				
					<header class="sixteen columns">
					
						<?php if ($header_layout == "logo-right") { ?>
						
							<?php if (is_active_sidebar('header-ad-widget')) { ?>
							<div class="header-advert nine columns alpha">
							<?php dynamic_sidebar('header-advert'); ?>
							</div>
							<?php } else { ?>
							<div class="header-advert nine columns alpha">
								<?php echo $header_ad_config; ?>
							</div>
							<?php } ?>
							
							<div id="logo" class="seven columns omega">
								<a href="<?php echo home_url(); ?>">
									<img class="standard" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
									<img class="retina" src="<?php echo $retina_logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
								</a>
							</div>
							
						<?php } else if ($header_layout == "logo-full") { ?>
						
							<div id="logo">
								<a href="<?php echo home_url(); ?>">
									<img class="standard" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
									<img class="retina" src="<?php echo $retina_logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
								</a>
							</div>
							
							<?php if (is_active_sidebar('header-ad-widget')) { ?>
							<div class="header-advert nine columns">
							<?php dynamic_sidebar('header-advert'); ?>
							</div>
							<?php } else { ?>
							<div class="header-advert nine columns">
								<?php echo $header_ad_config; ?>
							</div>
							<?php } ?>
						
						<?php } else { ?>
						
							<div id="logo" class="seven columns alpha">
								<a href="<?php echo home_url(); ?>">
									<img class="standard" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
									<img class="retina" src="<?php echo $retina_logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
								</a>
							</div>
							
							<?php if (is_active_sidebar('header-ad-widget')) { ?>
							<div class="header-advert nine columns omega">
							<?php dynamic_sidebar('header-advert'); ?>
							</div>
							<?php } else { ?>
							<div class="header-advert nine columns omega">
								<?php echo $header_ad_config; ?>
							</div>
							<?php } ?>
						
						<?php } ?>
										
					</header>
				
				</div>
				
			</div>
			
			<div id="aux-area">
			
				<?php		
					$show_subscribe = $options['show_sub_icon'];
					$show_search = $options['show_search_icon'];
					$show_translation = $options['show_translation_icon'];
					$show_login = $options['show_login_icon'];
					$subscribe_action_url = $options['sub_action_url'];
				?>
			
				<div class="container">
				
					<?php if ($show_search) { ?>
			
					<div id="header-search" class="sixteen columns">
						<form method="get" id="header-searchform" action="<?php echo home_url(); ?>/">
							<input type="text" placeholder="<?php _e("Type something and hit enter to search", "swiftframework"); ?>" name="s" id="s" />
						</form>
					</div>
					
					<?php } ?>
					
					<?php if ($show_subscribe) { ?>
					
					<div id="header-subscribe" class="sixteen columns">
						<form action="<?php echo $subscribe_action_url; ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="<?php _e("Enter your email address and hit enter to subscribe", "swiftframework"); ?>" required>
						</form>
					</div>
					
					<?php } ?>
					
					<?php if ($show_translation) { ?>
					
					<div id="header-translation" class="sixteen columns">
						<?php 
							if (function_exists( 'language_flags' )) {
								language_flags();
							}
						?>
					</div>
					
					<?php } ?>
					
					<?php if ($show_login) { ?>
					
					<div id="header-login" class="sixteen columns clearfix">
						<?php if (!is_user_logged_in()) { ?>
						<form action="<?php echo wp_login_url(); ?>" autocomplete="off" method="post">
						<input type="text" name="log" id="username" value="" placeholder="<?php _e("Enter your username", "swiftframework"); ?>" size="20" />
						<input type="password" name="pwd" id="password" placeholder="<?php _e("Then enter your password and hit enter", "swiftframework"); ?>" size="20" />
						<input type="submit" name="submit" value="Send" id="submit" class="button" style="visibility: hidden;height: 0;" />
						</form>
						<a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" class="recover-password"><?php _e("Forgotten your login details?", "swiftframework"); ?></a>
						<?php } else { ?>
						<a href="<?php echo wp_logout_url( home_url() ); ?>" class="logout-link"><?php _e("Click here to logout", "swiftframework"); ?></a>
						<span><?php _e("or", "swiftframework"); ?></span>
						<a href="<?php echo get_admin_url(); ?>" class="admin-link"><?php _e("Click here to go to the admin area", "swiftframework"); ?></a>
						<?php }?>
					</div>
					
					<?php } ?>
					
				</div>
				
			</div>
	
			<div id="nav-section" class="<?php echo $nav_class; ?> clearfix">
				<div class="container">
					<div class="nav-wrap sixteen columns clearfix">
						<!-- OPEN #main-navigation -->
						<nav id="main-navigation" class="twelve columns alpha">
							
							<?php
							if(function_exists('wp_nav_menu')) {
							wp_nav_menu(array(
							'theme_location' => 'main_navigation',
							'fallback_cb' => ''
							)); }
							?>
	
						<!-- CLOSE #main-navigation -->
						</nav>
	
						<!-- OPEN #mobile-navigation -->
						<nav id="mobile-navigation" class="mobile-nav">
						<span class="selected-option"><?php _e("- Menu -", "swiftframework"); ?></span>
						<?php
							dropdown_menu( array(
	
								'theme_location' => 'main_navigation',
	
							    // You can alter the blanking text eg. "- Navigate -" using the following
							    'dropdown_title' => '-- Menu --',
	
							    // indent_string is a string that gets output before the title of a
							    // sub-menu item. It is repeated twice for sub-sub-menu items and so on
							    'indent_string' => '- ',
	
							    // indent_after is an optional string to output after the indent_string
							    // if the item is a sub-menu item
							    'indent_after' => ''
	
							) );
						?>
						<!-- CLOSE #mobile-navigation -->
						</nav>
	
						<div id="menubar-controls" class="four columns omega">
							<?php if ($show_subscribe) { ?>
							<div class="control-item">
								<a id="subscribe-activate" href="#"><i class="icon-envelope-alt"></i></a>
								<span class="tooltip aux"><?php _e("Subscribe", "swiftframework"); ?><span class="arrow"></span></span>
							</div>
							<?php } ?>
							<?php if ($show_search) { ?>
							<div class="control-item">
								<a id="search-activate" href="#"><i class="icon-search"></i></a>
								<span class="tooltip aux"><?php _e("Search", "swiftframework"); ?><span class="arrow"></span></span>
							</div>
							<?php } ?>
							<?php if ($show_translation) { ?>
							<div class="control-item">
								<a id="translation-activate" href="#"><i class="icon-globe"></i></a>
								<span class="tooltip aux"><?php _e("Languages", "swiftframework"); ?><span class="arrow"></span></span>
							</div>
							<?php } ?>
							<?php if ($show_login) { ?>
							<div class="control-item">
								<a id="login-activate" href="#"><i class="icon-lock"></i></a>
								<span class="tooltip aux"><?php _e("Account", "swiftframework"); ?><span class="arrow"></span></span>
							</div>
							<?php } ?>
						</div>
	
					</div>
				
				</div>

			</div>
			
			<?php if ($enable_mini_header) { ?>
			
			<div id="mini-header" class="<?php echo $nav_class; ?>">
				<div class="container">
					<div class="nav-wrap sixteen columns clearfix">	
						<!-- OPEN #main-navigation -->
						<nav id="mini-navigation" class="twelve columns alpha">
	
							<?php
							if(function_exists('wp_nav_menu')) {
							wp_nav_menu(array(
							'theme_location' => 'main_navigation',
							'fallback_cb' => ''
							)); }
							?>
	
						<!-- CLOSE #main-navigation -->
						</nav>
						<div id="mini-search" class="four columns omega">
							<form method="get" action="<?php echo home_url(); ?>/">
								<input type="text" name="s" />
							</form>
							<a href="#" class="mini-search-link"><i class="icon-search"></i></a>
						</div>
					</div>
				</div>
			</div>
			
			<?php } ?>
				
			<!-- OPEN #main-container -->
			<div id="main-container" class="clearfix">
				
				<?php
					if (is_page()) {
						$show_posts_ticker = get_post_meta($post->ID, 'sf_posts_ticker', true);
						$show_posts_slider = get_post_meta($post->ID, 'sf_posts_slider', true);
						$rev_slider_alias = get_post_meta($post->ID, 'sf_rev_slider_alias', true);
						
						if ($show_posts_ticker) {
							get_news_ticker();
						}
						
						if ($show_posts_slider) {
							get_posts_slider();
						} else if ($rev_slider_alias != "") { ?>
							<div class="home-slider-wrap">
								<?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
							</div>
						<?php }
					}
				?>
				
				<div class="container">
				
					<!-- OPEN #page-wrap -->
					<div id="page-wrap" class="sixteen columns">
					