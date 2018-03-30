<?php
/**
* 
* The template for displaying the header.
* 
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
	<!-- Full Screen Background -->
	<div class="full-screen-bg"><div class="screen-inner"></div></div>
	
	<!-- HEADER -->

	<header id="main-header">

		<div id="top-bar">
			<div class="container clearfix">

				<?php van_logo();?>
				
				<?php if ( van_get_option("header_social") ): ?>
					<div id="header-social">
						<?php van_social_networks(); ?>
					</div><!-- #header-social -->						
				<?php endif; ?>

			</div><!-- .container -->
		</div><!-- #top-bar -->

		<div id="main-nav-wrap" class="container content clearfix <?php echo !van_get_option("sticky_nav") ? 'disabled-sticky' : ''; ?>" >

			<nav id="main-navigation" role="navigation">

				<div class="mobile-nav">
					<?php van_menu_select(array( 'menu_name' => 'PrimaryNav', 'id' => 'PrimaryNav' )); ?>
				</div>
				
				<div class="main-nav">

					<?php wp_nav_menu( array('theme_location' => 'PrimaryNav', 'menu_class'  => 'clearfix','fallback_cb' => 'van_nav_alert') ); ?>

				</div>

			</nav><!-- #main-navigation -->

			<?php if ( van_get_option("nav_search") ): ?>
				<div id="header-search">
					<form method="get" class="searchform clearfix" action="<?php echo esc_url( home_url() ); ?>/" role="search">
						<a href="#" class="search-icn icon icon-search"></a>
						<input type="text" name="s" placeholder="<?php _e('Type and hit enter to search...','van') ?>">
					</form>            	
				</div><!-- #header-search -->					
			<?php endif; ?>

		</div><!-- #main-nav-wrap -->

	</header><!-- #main-header -->

	<!-- MAIN -->
		
<div id="main-wrap" class="container <?php echo van_sidebar_layout(); ?>">