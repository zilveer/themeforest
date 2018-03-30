<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="header" class="site-header" role="banner">
		<div class="site-header-inner">
			<div class="logo">
				<div class="logo-inner">
					<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php if ( esc_url( get_option( 'flow_logo' ) ) ) { ?>
							<img class="site-logo" src="<?php echo esc_url( get_option( 'flow_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
						<?php } ?>
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</a>
				</div>
			</div>
			<?php if ( function_exists( 'flow_language_selector_flags' ) ) {
					$lng_switcher = flow_language_selector_flags();
					echo $lng_switcher;
				} ?>
			<nav class="site-navigation" role="navigation">
				<h3 class="menu-toggle"><?php _e( 'Menu', 'flowthemes' ); ?></h3>
				<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_class' => 'nav-menu', 'fallback_cb' => false ) ); ?>
			</nav>
		</div>
	</header>
	
	<?php get_header( 'compact' ); ?>
