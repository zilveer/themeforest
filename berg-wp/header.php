<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package berg-wp
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<?php
if (YSettings::g('theme_custom_css') != '') {
?>
<style>
<?php echo YSettings::g('theme_custom_css'); ?>
</style>
<?php
}

if (YSettings::g('scrollbar_handle_color') != '#aeaeae') {
?>
<style>
::-webkit-scrollbar {
  background-color: <?php echo YSettings::g('scrollbar_background_color'); ?> !important;
}
::-webkit-scrollbar-thumb {
  background: <?php echo YSettings::g('scrollbar_handle_color'); ?> !important;
}
::-webkit-scrollbar-thumb:hover,
::-webkit-scrollbar-thumb:active {
  background: <?php echo YSettings::g('scrollbar_handle_color_active'); ?> !important;
}
</style>
<?php
}
if (YSettings::g('mobile_homepage_logo_width') != '100') {
?>
<?php 
	$width = YSettings::g('mobile_homepage_logo_width');
	
	$max_width = (substr($width, -1)!="%" ? $width . "%" : $width);
?>
<style>
.mobile-nav .logo {
	max-width: <?php echo $max_width; ?> !important;
}
</style>
<?php
}
?>
<?php
$intro = berg_getIntro();

$classes = array('yo-anim-enabled');
$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'original');
$img_url = $img_url[0];
$page_meta = get_post_meta(berg_getPageId());
$nav_opacity = 100;
$classesNav = '';

if (isset($page_meta['_wp_page_template']) && $page_meta['_wp_page_template'][0] == 'restaurant.php') {
	$classes[] = 'fullpage-scroll no-smooth-scroll';
}

if (!is_search()) {
	if ($intro == false) {
		$classes['intro'] = 'no-intro';

		if (isset($page_meta['_wp_page_template'][0]) && $page_meta['_wp_page_template'][0] == 'homepage.php') {
			$classes['intro'] = '';
			$classes[] = 'home-page';
		}
	}
	if(isset($page_meta['_wp_page_template'][0]) && $page_meta['_wp_page_template'][0] == 'homepage2.php' ) {
		if (isset($page_meta['nav_settings'][0])) {
			$section_nav = $page_meta['nav_settings'][0];

			if ($section_nav != 'default') {
				if ($section_nav == 'show') {
					$classes[] = 'show-nav'; 
				}
			} else {
				if (YSettings::g('berg_nav_show') == 1) {
					$classes[] = 'show-nav'; 
				}
			}
		} else {
			if (YSettings::g('berg_nav_show') == 1) {
				$classes[] = 'show-nav'; 
			}
		}
	} else {
		if (isset($page_meta['nav_settings'][0])) {
			$section_nav = $page_meta['nav_settings'][0];

			if ($section_nav != 'default') {
				if ($section_nav == 'show') {
					$classes[] = 'show-nav'; 
				}
			} else {
				if (YSettings::g('berg_nav_show') == 1) {
					$classes[] = 'show-nav'; 
				}
			}
		} else {
			if (YSettings::g('berg_nav_show') == 1) {
				$classes[] = 'show-nav'; 
			}
		}
	}

	if (isset($page_meta['nav_transparent'][0])) {
		$nav_opacity = $page_meta['nav_transparent'][0];

		if ($nav_opacity != 'default') {
			$classesNav = $nav_opacity; 
		} else {
			$classesNav = YSettings::g('berg_nav_transparent');
		}
	} else {
		$classesNav = YSettings::g('berg_nav_transparent');
	}

	if (isset($page_meta['nav_position'][0])) {
		$nav_position = $page_meta['nav_position'][0];

		if ($nav_position == 'center') {
			$classes[] = 'nav-center'; 
		}
	}
} else {
	if (YSettings::g('berg_nav_show', 1) == 1) {
		$classes[] = 'show-nav';
	}

	$classes[] = 'no-intro';
	$classesNav = YSettings::g('berg_nav_transparent');
}

if (YSettings::g('disable_smooth_scroll', '0') == '1') {
	$classes[] = 'no-smooth-scroll';
}

if (YSettings::g('mobile_sticky_navigation', '0') == '1') {
	$classes[] = 'sticky-nav';
}

$after = '';

if (class_exists('Woocommerce')) {
	if (function_exists('icl_object_id')) {
		$shopPageID = (int)icl_object_id(get_option('woocommerce_shop_page_id'), 'page', true);
	} else {
		$shopPageID = get_option('woocommerce_shop_page_id');
	}

	if (YSettings::g('woocommerce_show_in_navbar', 1) == 1) {
		$after .= '<li class="menu-item '. ((is_shop()) ? 'current-menu-item' : '') .'"><a href="'.get_permalink($shopPageID).'"><span><i class="icon-bag"></i> '.get_the_title($shopPageID).' </span></a></li>';
	}
}
$navType = YSettings::g('navigation_type');
if($navType == '2') {
	$classesNav = '';
}


?>
<body <?php body_class($classes); ?>>
<?php
$preloaderLogoSettings = YSettings::g('logo_animation');

$hideOnMobile = (YSettings::g('disable_logo_animation_mobile') == '1') ? 'hidden-xs hidden-sm' : '';

$loaderImage = YSettings::g('loading_image');
if(isset($loaderImage['url'])) :
$loaderImage = $loaderImage['url'];

?>
<?php if ($preloaderLogoSettings == 'all' && $loaderImage != ''): ?>

<div id="preloader" class="<?php echo $hideOnMobile; ?>">
	<div id="status">
		<div class="loading-wrapper">
			<img src="<?php echo $loaderImage;?>" alt="<?php _e('Loading', 'BERG'); ?>" />
		</div>
	</div>
	<div id="status-loaded"></div>
</div>

<?php elseif (($preloaderLogoSettings == 'homepage' && $loaderImage != '') && is_front_page()): ?>

<div id="preloader" class="<?php echo $hideOnMobile; ?>">
	<div id="status">
		<div class="loading-wrapper">
			<img src="<?php echo $loaderImage;?>" alt="<?php _e('Loading', 'BERG'); ?>" />
		</div>
	</div>
	<div id="status-loaded"></div>
</div>

<?php endif; ?>
<?php endif; ?>

<?php
	berg_migrate();
	include(THEME_INCLUDES.'/navigation/nav.php');

?>
	<div class="content-wrapper" style="opacity: 0">

<?php
if ($intro != false) {
	get_template_part('intro', $intro);
}
?>