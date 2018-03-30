<?php
/**
 * The Header for our theme.
 *
 * @package progression
 * @since progression 1.0
 */
?><!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>  <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
<?php if (get_theme_mod( 'header_fix_progression', '0')) : ?><div id="fixed-header-pro"><?php endif ?>
<header<?php if (get_theme_mod( 'logo_left_progression', '0')) : ?> id="logo-left"<?php endif ?>>
		<div class="width-container"><div id="logo-pro"><h1 id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'logo_upload', get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo get_theme_mod( 'logo_width', '180' ); ?>" /></a></h1></div></div>
		<nav>
			<div class="width-container">
				<div id="primary-left-nav"><div class="logo_container"></div><?php wp_nav_menu( array('theme_location' => 'primary-left', 'depth' => 4, 'menu_class' => 'sf-menu', 'fallback_cb' => false) ); ?></div>
				<div id="primary-right-nav"><div class="logo_container"></div><?php wp_nav_menu( array('theme_location' => 'primary-right', 'depth' => 4, 'menu_class' => 'sf-menu', 'fallback_cb' => false) ); ?></div>
			</div>
			<div class="clearfix"></div>
		</nav>
		<div id="mobile-menu">
			<div class="width-container">
				<?php wp_nav_menu( array('theme_location' => 'primary-left', 'depth' => 4, 'menu_class' => 'phone-menu', 'fallback_cb' => false) ); ?>	
				<?php wp_nav_menu( array('theme_location' => 'primary-right', 'depth' => 4, 'menu_class' => 'phone-menu', 'fallback_cb' => false) ); ?>
			</div>
		</div>
	<div class="clearfix"></div>
	<?php get_template_part( 'header', 'background' ); ?>
</header>
<?php if (get_theme_mod( 'header_fix_progression', '0')) : ?></div><?php endif ?>

<?php if(is_page()): ?><?php if(get_post_meta($post->ID, 'progression_category_slug', true)): ?>
	<div id="pro-home-slider"><?php echo apply_filters('the_content', get_post_meta($post->ID, 'progression_category_slug', true)); ?></div>
<?php endif; ?><?php endif; ?>