<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

$gorilla_mobile_class = $gorilla_smoothscrolling_class = $stick_nav_class = $stick_sidebar_class = $is_search = "";

global $gorilla_is_mobile, $gorilla_featured_area, $gorilla_layout_enable_home_intro;

if($gorilla_is_mobile){
  $gorilla_mobile_class = "mobile-device";
}
else {
  $gorilla_mobile_class = "no-mobile-device";
}

if(get_theme_mod("gorilla_enable_smoothscrolling") == true){
	$gorilla_smoothscrolling_class = "smooth-scrolling";
}

if(get_theme_mod('gorilla_enable_stickynav',true)){
	$stick_nav_class = "sticky-nav";
}

if(get_theme_mod('gorilla_enable_stickysidebar',true)){
	$stick_sidebar_class = "sticky-sidebar";
}

if(!get_theme_mod('gorilla_topbar_search_check',true)){
	$is_search = "no-search";
}

?>

<!DOCTYPE html>
<!--[if IE 9]><html class="ie9 <?php echo esc_attr($gorilla_mobile_class); ?>" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="<?php echo esc_attr($gorilla_mobile_class); ?>" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if(get_theme_mod('gorilla_upload_favicon')) : ?>
	<link rel="shortcut icon" href="<?php echo get_theme_mod('gorilla_upload_favicon'); ?>" />
	<?php endif; ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
	
</head>

<?php

?>

<body <?php body_class(array($gorilla_smoothscrolling_class, $stick_nav_class, $stick_sidebar_class, $is_search)); ?>>

<div id="wrapper">

		<div class="main-navigation-wrapper">

			<?php if(get_theme_mod('gorilla_topbar_social_check',true)) : ?>
			<div id="top-social-items">
				<div id="top-social-items-inner">
				
					<?php if(get_theme_mod('gorilla_facebook',true)) : ?><a href="<?php echo esc_url(get_theme_mod('gorilla_facebook','#')); ?>" target="_blank"><i class="fa fa-facebook"></i></a><?php endif; ?>
					<?php if(get_theme_mod('gorilla_twitter',true)) : ?><a href="<?php echo esc_url(get_theme_mod('gorilla_twitter','#')); ?>" target="_blank"><i class="fa fa-twitter"></i></a><?php endif; ?>
					<?php if(get_theme_mod('gorilla_instagram',true)) : ?><a href="<?php echo esc_url(get_theme_mod('gorilla_instagram','#')); ?>" target="_blank"><i class="fa fa-instagram"></i></a><?php endif; ?>
					<?php if(get_theme_mod('gorilla_pinterest',true)) : ?><a href="<?php echo esc_url(get_theme_mod('gorilla_pinterest','#')); ?>" target="_blank"><i class="fa fa-pinterest"></i></a><?php endif; ?>
					<?php if(get_theme_mod('gorilla_linkedin')) : ?><a href="<?php echo esc_url(get_theme_mod('gorilla_linkedin')); ?>" target="_blank"><i class="fa fa-linkedin"></i></a><?php endif; ?>
					<?php if(get_theme_mod('gorilla_google')) : ?><a href="<?php echo esc_url(get_theme_mod('gorilla_google')); ?>" target="_blank"><i class="fa fa-google-plus"></i></a><?php endif; ?>
					<?php if(get_theme_mod('gorilla_tumblr')) : ?><a href="<?php echo esc_url(get_theme_mod('gorilla_tumblr')); ?>" target="_blank"><i class="fa fa-tumblr"></i></a><?php endif; ?>
					<?php if(get_theme_mod('gorilla_youtube')) : ?><a href="<?php echo esc_url(get_theme_mod('gorilla_youtube')); ?>" target="_blank"><i class="fa fa-youtube"></i></a><?php endif; ?>
					<?php if(get_theme_mod('gorilla_bloglovin')) : ?><a href="<?php echo esc_url(get_theme_mod('gorilla_bloglovin')); ?>" target="_blank"><i class="fa fa-heart"></i></a><?php endif; ?>
				
				</div>
			</div>
			<?php endif; ?>
	
			<div class="container clearfix">
				
				<nav class="main-navigation clearfix <?php echo esc_attr($is_search); ?>">
				<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu','fallback_cb' => 'gorilla_menu_add_alert' ) ); ?>
				</nav>
					
				<div class="menu-mobile"></div>
				
				<?php if(get_theme_mod('gorilla_topbar_search_check', true)) : ?>
				<div class="top-search-area">
					<a href="#"><i class="fa fa-search"></i></a>
					<div class="search-form-area">
						<?php get_search_form(); ?>
					</div>
				</div>
				<?php endif; ?>
				
			</div>

		</div>

		<header id="main-header">
			<div id="main-top-wrapper">
				<div class="container">
					
					<div id="logo">
						
						<?php if(!get_theme_mod('gorilla_logo')) : ?>	
							<h1><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<h1><a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url(get_theme_mod('gorilla_logo')); ?>"<?php if(get_theme_mod('gorilla_logo_width')) echo ' width="'.esc_attr(get_theme_mod('gorilla_logo_width')).'"'; ?><?php if(get_theme_mod('gorilla_logo_height')) echo ' height="'.esc_attr(get_theme_mod('gorilla_logo_height')).'"'; ?> alt="<?php bloginfo( 'name' ); ?>" /></a></h1>
						<?php endif; ?>
						
					</div>

					<?php if($gorilla_layout_enable_home_intro) : ?>

					<div class="layout-title-container">
						<div class="layout-title">
							<?php if (get_theme_mod( 'gorilla_layout_title' )) : ?>
								<h3><?php echo wp_kses(get_theme_mod( 'gorilla_layout_title' ), wp_kses_allowed_html( 'post' )); ?></h3>
								<?php if (get_theme_mod( 'gorilla_layout_sub' )) : ?>
								<span class="sub-title"><?php echo wp_kses(get_theme_mod( 'gorilla_layout_sub' ), wp_kses_allowed_html( 'post' )); ?></span>
								<?php endif; ?>
							<?php endif; ?>

							<?php if (get_theme_mod( 'gorilla_layout_text' )) : ?>
							<div class="layout-text">
								<p><?php echo wp_kses(get_theme_mod( 'gorilla_layout_text' ), wp_kses_allowed_html( 'post' )); ?></p>
							</div>
							<?php endif; ?>

						</div>
					</div>
					<?php endif; ?>
					
				</div>
			</div>
		
		</header>

		<?php if($gorilla_featured_area == true && (is_home() || is_front_page())) :
			do_action( 'gorilla_featured_slider_container' );
		endif; ?>	