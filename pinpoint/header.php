<!DOCTYPE html>

<!-- OPEN html -->
<html <?php language_attributes(); ?>>

	<!-- OPEN head -->
	<head>
		
		<?php
			
			$options = get_option('sf_pinpoint_options');
			
			$enable_responsive = $options['enable_responsive'];
			$header_layout = $options['logo_layout'];
			$page_layout = $options['page_layout'];
			$logo = $options['logo_upload'];
			if ($logo == "") {
			$logo = get_template_directory_uri() . '/images/logo.png';
			}
			$enable_logo_fade = $options['enable_logo_fade'];
			$enable_page_shadow = $options['enable_page_shadow'];
			$header_phone_number = __($options['header_phone_number'], 'swiftframework');
			$header_social_icons = $options['header_social_icons'];
			$header_social_config = $options['header_social_config'];
			$enable_mini_header = $options['enable_mini_header'];
			$enable_nav_indicator = $options['enable_nav_indicator'];
			$enable_nav_shadow = $options['enable_nav_shadow'];
			$enable_menu_dividers = $options['enable_menu_dividers'];
			$enable_accent_bar = $options['enable_accent_bar'];
			
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
			if ($enable_accent_bar) {
			$nav_class .= "nav-accent-bar";
			}
			
			if (isset($_GET['layout'])) {
				$page_layout = $_GET['layout'];
			}
		?>
		
		<!--////////////////////////////////////
		/// SITE TITLE
		////////////////////////////////////////-->
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
		
		
		<!--////////////////////////////////////
		/// SITE META
		////////////////////////////////////////-->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />	
		<?php if ($enable_responsive) { ?><meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1"><?php } ?>
				
		<!--////////////////////////////////////
		/// PINGBACK & FAVICON
		////////////////////////////////////////-->
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php $favicon = $options['custom_favicon'];?>
		<?php if ($favicon != "") { ?><link rel="shortcut icon" href="<?php echo $favicon; ?>" /><?php } ?>


	    <!--////////////////////////////////////
	    /// LEGACY HTML5 SUPPORT
	    ////////////////////////////////////////-->
	    <!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		
		<!--////////////////////////////////////
		/// GOOGLE FONT LOADER
		////////////////////////////////////////-->
		<?php
			$options = get_option('sf_pinpoint_options');
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
		
		<!-- WordPress Hook -->
		<?php wp_head(); ?>
	
	<!-- CLOSE head -->
	</head>
		
	<!-- OPEN body -->
	<body <?php body_class(); ?>>
		
		<!-- OPEN Social Scripts -->
		<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "ur-72c8cf80-2647-2464-a894-abc33849d467", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
		<!-- CLOSE Social Scripts -->
	
		<noscript>
			<div class="no-js-alert">
				<?php _e("Please enable JavaScript to view this website.", "swiftframework"); ?>
			</div>
		</noscript>
		
		<?php if ($page_layout == "fullwidth") { ?>
		<div id="container" class="fullwidth-layout">
		<?php } else { ?>
		<div id="boxed-container">
		<div id="container" class="container boxed-layout <?php echo $page_class; ?>">
		<?php } ?>
			
			<?php if (function_exists('bcn_display') || function_exists('yoast_breadcrumb')) { ?>	
			<div class="breadcrumbs-wrap">
				<?php if ($page_layout == "fullwidth") { ?>
				<div class="container">
				<div class="sixteen columns">
				<?php } ?>
					<div id="breadcrumbs">
						<?php 
							if (function_exists('bcn_display')) {
								bcn_display();
							} else if (function_exists('yoast_breadcrumb')) {
								yoast_breadcrumb("","");
							}
						 ?>
					</div>
				<?php if ($page_layout == "fullwidth") { ?>
				</div>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
	
			<div id="header-section" class="<?php echo $header_layout; ?> <?php echo $logo_class; ?> clearfix">
			
				<?php if ($page_layout == "fullwidth") { ?>
				<div class="container">
				<?php } ?>
				
				<header class="sixteen columns">
				
					<?php if ($header_layout == "logo-right") { ?>
					
					<div class="header-items nine columns alpha">
						<?php if ($header_social_icons) { ?>
						<div class="social-wrap"><?php echo do_shortcode($header_social_config); ?></div>
						<?php } else { ?>
						<div class="header-spacer"></div>
						<?php } ?>
						<h3 class="phone-number"><?php echo do_shortcode($header_phone_number); ?></h3>
					</div>
					
					<div id="logo" class="six columns offset-by-one omega">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
						</a>
						<h1><?php bloginfo('name'); ?></h1>
					</div>
					
					<?php } else if ($header_layout == "logo-center") { ?>
					
					<div class="header-items one-third column alpha">
						<?php if ($header_social_icons) { ?>
						<div class="social-wrap"><?php echo do_shortcode($header_social_config); ?></div>
						<?php } ?>
					</div>
					
					<div id="logo" class="one-third column">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
						</a>
						<h1><?php bloginfo('name'); ?></h1>
					</div>
					
					<div class="header-items one-third column omega">
						<h3 class="phone-number"><?php echo do_shortcode($header_phone_number); ?></h3>
					</div>
					
					<?php } else if ($header_layout == "logo-full") { ?>
					
					<div id="logo">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
						</a>
						<h1><?php bloginfo('name'); ?></h1>
					</div>
					
					<div class="header-items six columns">
						<?php if ($header_social_icons) { ?>
						<div class="social-wrap"><?php echo do_shortcode($header_social_config); ?></div>
						<?php } else { ?>
						<div class="header-spacer"></div>
						<?php } ?>
						<h3 class="phone-number"><?php echo do_shortcode($header_phone_number); ?></h3>
					</div>

					<?php } else { ?>
					
					<div id="logo" class="six columns alpha">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
						</a>
						<h1><?php bloginfo('name'); ?></h1>
					</div>
					
					<div class="header-items nine columns offset-by-one omega">
						<?php if ($header_social_icons) { ?>
						<div class="social-wrap"><?php echo do_shortcode($header_social_config); ?></div>
						<?php } else { ?>
						<div class="header-spacer"></div>
						<?php } ?>
						<h3 class="phone-number"><?php echo do_shortcode($header_phone_number); ?></h3>
					</div>
					
					<?php } ?>
									
				</header>
				
				<?php if ($page_layout == "fullwidth") { ?>
				</div>
				<?php } ?>
				
			</div>
			
			<div id="aux-area">
			
				<?php		
					$show_subscribe = $options['show_sub_icon'];
					$show_search = $options['show_search_icon'];
					$show_translation = $options['show_translation_icon'];
					$show_login = $options['show_login_icon'];
					$subscribe_action_url = $options['sub_action_url'];
				?>
			
				<?php if ($page_layout == "fullwidth") { ?>
				<div class="container">
				<?php } ?>
				
				<?php if ($show_search) { ?>
				<div id="header-search" class="full-width">
					<form method="get" id="header-searchform" action="<?php echo home_url(); ?>/">
						<input type="text" placeholder="<?php _e("Type something and hit enter to search", "swiftframework"); ?>" name="s" id="s" />
					</form>
				</div>
				<?php } ?>
				
				<?php if ($show_subscribe) { ?>
				<div id="header-subscribe" class="full-width">
					<form action="<?php echo $subscribe_action_url; ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="<?php _e("Enter your email address and hit enter to subscribe", "swiftframework"); ?>" required>
					</form>
				</div>
				<?php } ?>
				
				<?php if ($show_translation) { ?>
				<div id="header-translation" class="full-width">
					<?php 
						if (function_exists( 'language_flags' )) {
							language_flags();
						}
					?>
				</div>
				<?php } ?>
				
				<?php if ($show_login) { ?>
				<div id="header-login" class="full-width clearfix">
					<?php if (!is_user_logged_in()) { ?>
					<form action="<?php echo home_url(); ?>/wp-login.php" autocomplete="off" method="post">
					<input type="text" name="log" id="username" value="" placeholder="<?php _e("Enter your username", "swiftframework"); ?>" size="20" />
					<input type="password" name="pwd" id="password" placeholder="<?php _e("Then enter your password and hit enter", "swiftframework"); ?>" size="20" />
					<input type="submit" name="submit" value="Send" id="submit" class="button" style="visibility: hidden;height: 0;" />
					    <p style="visibility: hidden;margin-bottom: 0;">
					       <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
					    </p>
					</form>
					<a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" class="recover-password"><?php _e("Forgotten your login details?", "swiftframework"); ?></a>
					<?php } else { ?>
					<a href="<?php echo wp_logout_url( home_url() ); ?>" class="logout-link"><?php _e("Click here to logout", "swiftframework"); ?></a>
					<span><?php _e("or", "swiftframework"); ?></span>
					<a href="<?php echo get_admin_url(); ?>" class="admin-link"><?php _e("Click here to go to the admin area", "swiftframework"); ?></a>
					<?php }?>
				</div>
				<?php } ?>
				
				<?php if ($page_layout == "fullwidth") { ?>
				</div>
				<?php } ?>
				
			</div>
	
			<div id="nav-section" class="<?php echo $nav_class; ?> clearfix">
			
				<?php if ($page_layout == "fullwidth") { ?>
				<div class="container">
				<div class="sixteen columns">
				<?php } ?>
	
				<div class="nav-wrap clearfix">
		
					<!-- OPEN #main-navigation -->
					<nav id="main-navigation" class="twelve columns alpha">

						<?php
						if(function_exists('wp_nav_menu')) {
						wp_nav_menu(array(
						'theme_location' => 'Main_Navigation',
						'fallback_cb' => ''
						)); }
						?>

					<!-- CLOSE #main-navigation -->
					</nav>

					<!-- OPEN #mobile-navigation -->
					<nav id="mobile-navigation">
					<span class="selected-option"><?php _e("- Menu -", "swiftframework"); ?></span>
					<?php
						dropdown_menu( array(

							'theme_location' => 'Main_Navigation',

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
							<span class="tooltip"><?php _e("Subscribe", "swiftframework"); ?><span class="arrow"></span></span>
						</div>
						<?php } ?>
						<?php if ($show_search) { ?>
						<div class="control-item">
							<a id="search-activate" href="#"><i class="icon-search"></i></a>
							<span class="tooltip"><?php _e("Search", "swiftframework"); ?><span class="arrow"></span></span>
						</div>
						<?php } ?>
						<?php if ($show_translation) { ?>
						<div class="control-item">
							<a id="translation-activate" href="#"><i class="icon-globe"></i></a>
							<span class="tooltip"><?php _e("Languages", "swiftframework"); ?><span class="arrow"></span></span>
						</div>
						<?php } ?>
						<?php if ($show_login) { ?>
						<div class="control-item">
							<a id="login-activate" href="#"><i class="icon-lock"></i></a>
							<span class="tooltip"><?php _e("Account", "swiftframework"); ?><span class="arrow"></span></span>
						</div>
						<?php } ?>
					</div>

				</div>
				
				<?php if ($page_layout == "fullwidth") { ?>
				</div>
				</div>
				<?php } ?>			
		
			</div>
			
			<?php if ($enable_mini_header) { ?>
			
			<div id="mini-header" class="<?php echo $nav_class; ?>">
				<?php if ($page_layout == "fullwidth") { ?>
				<div class="container">
				<div class="sixteen columns">
				<?php } ?>
				<div class="nav-wrap clearfix">	
					<!-- OPEN #main-navigation -->
					<nav id="mini-navigation" class="twelve columns alpha">

						<?php
						if(function_exists('wp_nav_menu')) {
						wp_nav_menu(array(
						'theme_location' => 'Main_Navigation',
						'fallback_cb' => ''
						)); }
						?>

					<!-- CLOSE #main-navigation -->
					</nav>
					
					<?php if ($show_search) { ?>
					<div id="mini-search" class="four columns omega">
						<form method="get" action="<?php echo home_url(); ?>/">
							<input type="text" name="s" />
						</form>
						<a href="#" class="mini-search-link"><i class="icon-search"></i></a>
					</div>
					<?php } ?>
				</div>
				<?php if ($page_layout == "fullwidth") { ?>
				</div>
				</div>
				<?php } ?>
			</div>
			
			<?php } ?>
				
			<!-- OPEN #main-container -->
			<div id="main-container" class="clearfix">
				
				<?php if ($page_layout == "fullwidth") { ?>
				<!-- OPEN #page-wrap -->
				<div id="page-wrap">
				<?php } else { ?>
				<div class="container">
				
				<!-- OPEN #page-wrap -->
				<div id="page-wrap" class="sixteen columns">
				<?php } ?>