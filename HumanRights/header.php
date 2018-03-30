<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WPCharming
 */
global $wpc_option;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wpcharming' ); ?></a>	
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<?php if(has_nav_menu('topbar')) { ?>
			<ul class="topbar-menu">	
		   	   <?php wp_nav_menu( array('theme_location' => 'topbar', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>
		    </ul>
			<?php }	?>
			<div class="header-left">
				<div class="site-branding">
					<?php if ( wpcharming_option('site_logo', false, 'url') !== '' ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php echo wpcharming_option('site_logo', false, 'url'); ?>" alt="<?php echo get_bloginfo( 'name' ) ?>" />
					</a>
					<?php } else { ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php } ?>
				</div><!-- /.site-branding -->
			</div>
			<?php if ( $wpc_option['enable_header_widget'] ) { ?>
			<?php if ( is_active_sidebar( 'header-right' ) ) { ?>
			<div class="header-right">
				<div class="header-right-widgets clearfix">
					<?php dynamic_sidebar('header-right'); ?>
				</div>
			</div>
			<?php } ?>
			<?php } ?>
		</div>
	</header><!-- #masthead -->
	<nav id="site-navigation" class="main-navigation <?php if ( wpcharming_option('header_fixed') ) echo 'fixed-on' ?>" role="navigation">
		<div class="container">
			<?php if(has_nav_menu('primary')) { ?>
			<div id="nav-toggle"><i class="fa fa-bars"></i></div>
			<ul class="wpc-menu">	
		   	   <?php wp_nav_menu( array('theme_location' => 'primary', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>
		    </ul>
			<?php }	?>
			
			<?php if ( $wpc_option['header_social'] ) { ?>
			<ul class="nav-social">
				<?php if ( !empty( $wpc_option['header_use_social']['twitter']) && $wpc_option['header_use_social']['twitter'] == 1 && $wpc_option['twitter'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['twitter']); ?>" title="Twitter"><i class="fa fa-twitter"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['header_use_social']['facebook']) && $wpc_option['header_use_social']['facebook'] == 1 && $wpc_option['facebook'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['facebook']); ?>" title="Facebook"><i class="fa fa-facebook-official"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['header_use_social']['linkedin']) && $wpc_option['header_use_social']['linkedin'] == 1 && $wpc_option['linkedin'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['linkedin']); ?>" title="Linkedin"><i class="fa fa-linkedin-square"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['header_use_social']['yelp']) && $wpc_option['header_use_social']['yelp'] == 1 && $wpc_option['yelp'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['yelp']); ?>" title="Yelp"><i class="fa fa-yelp"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['header_use_social']['pinterest']) && $wpc_option['header_use_social']['pinterest'] == 1 && $wpc_option['pinterest'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['pinterest']); ?>" title="Pinterest"><i class="fa fa-pinterest"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['header_use_social']['google']) && $wpc_option['header_use_social']['google'] == 1 && $wpc_option['google'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['google']); ?>" title="Google Plus"><i class="fa fa-google-plus"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['header_use_social']['instagram']) && $wpc_option['header_use_social']['instagram'] == 1 && $wpc_option['instagram'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['instagram']); ?>" title="Instagram"><i class="fa fa-instagram"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['header_use_social']['flickr']) && $wpc_option['header_use_social']['flickr'] == 1 && $wpc_option['flickr'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['flickr']); ?>" title="Flickr"><i class="fa fa-flickr"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['header_use_social']['youtube']) && $wpc_option['header_use_social']['youtube'] == 1 && $wpc_option['youtube'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['youtube']); ?>" title="Youtube"><i class="fa fa-youtube-play"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['header_use_social']['email']) && $wpc_option['header_use_social']['email'] == 1 && $wpc_option['email'] !== '' ) { ?><a href="<?php echo wp_kses_post($wpc_option['email']); ?>" title="Email"><i class="fa fa-envelope"></i></a> <?php } ?>
			</ul>
			<?php } ?>

		</div>
	</nav><!-- #site-navigation -->

	<div id="content" class="site-content">