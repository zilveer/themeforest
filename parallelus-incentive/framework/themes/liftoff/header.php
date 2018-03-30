<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till main content
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
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<style type="text/css">
	<?php

	// Text colors
	$link_color      = get_options_data('design-settings', 'link-color');
	$link_hover      = get_options_data('design-settings', 'link-hover-color');
	$underline       = get_options_data('design-settings', 'underline-links');
	$underline_hover = get_options_data('design-settings', 'underline-links-hover');
	$text_color      = get_options_data('design-settings', 'text-color');
	$heading_color   = get_options_data('design-settings', 'heading-text-color');
	$link_styles     = '';
	$hover_styles    = '';

	if ($link_color) $link_styles .= 'color: '. $link_color .';';
	if ($underline) $link_styles .= 'text-decoration: underline;';
	if ($link_styles) {
		echo 'a, .widget-area .widget a:hover, .comments-link a:hover, .entry-meta a:hover, .entry-header .entry-title a:hover, footer[role="contentinfo"] a { '. $link_styles .' }';
		echo '@media screen and (min-width: 600px) { .main-navigation li ul li a:hover { background-color: '. $link_color .' } }';
	}
	if ($link_hover) $hover_styles .= 'color: '. $link_hover .';';
	if ($underline_hover) $hover_styles .= 'text-decoration: underline;';
	if ($hover_styles) {
		echo 'a:hover, footer[role="contentinfo"] a:hover { '. $hover_styles .' }';
	}

	if ($text_color) echo 'body { color: '. $text_color .' }';
	if ($heading_color) echo 'h1, h2, h3, h4, h5, h6, .entry-header .entry-title a { color: '. $heading_color .' }';

	// Header styles
	$header_color      = get_options_data('design-settings', 'header-text-color');
	$header_background = get_options_data('design-settings', 'header-background-color');
	$header_image      = get_options_data('design-settings', 'header-background-image');
	$header_pos_x      = get_options_data('design-settings', 'header-background-image-pos-x', 'left');
	$header_pos_y      = get_options_data('design-settings', 'header-background-image-pos-y', 'top');
	$header_repeat     = get_options_data('design-settings', 'header-background-image-repeat', 'no-repeat');
	$header_styles     = '';

	if ($header_color)  $header_styles .= 'color: '. $header_color .';';
	if ($header_background)  $header_styles .= 'background-color: '. $header_background .';';
	if ($header_image) {
		$header_styles .= 'background-image: url('. $header_image .');';
		if ($header_repeat == 'fixed') { 
			$header_pos = $header_repeat;
			$header_repeat = 'no-repeat'; 
		} else { 
			$header_pos = $header_pos_x .' '. $header_pos_y;
		}
		$header_styles .= 'background-position: '. $header_pos .';';
		$header_styles .= 'background-repeat: '. $header_repeat .';';
	}
	if ($header_styles) {
		echo '#masthead { '. $header_styles .' }';
	}

	// logo links
	if ($header_color) {
		echo '.site-header h1 a, .site-header h2 a, .site-header h1 a:hover, .site-header h2 a:hover { color: '. $header_color .' }';
	}

	// Footer styles
	$footer_color      = get_options_data('design-settings', 'footer-text-color');
	$footer_background = get_options_data('design-settings', 'footer-background-color');
	$footer_image      = get_options_data('design-settings', 'footer-background-image');
	$footer_pos_x      = get_options_data('design-settings', 'footer-background-image-pos-x');
	$footer_pos_y      = get_options_data('design-settings', 'footer-background-image-pos-y');
	$footer_repeat     = get_options_data('design-settings', 'footer-background-image-repeat');
	$footer_styles     = '';

	if ($footer_color) $footer_styles .= 'color: '. $footer_color .';';
	if ($footer_background) $footer_styles .= 'background-color: '. $footer_background .';';
	if ($footer_image) {
		$footer_styles .= 'background-image: url('. $footer_image .');';
		if ($footer_repeat == 'fixed') { 
			$footer_pos = $footer_repeat;
			$footer_repeat = 'no-repeat'; 
		} else { 
			$footer_pos = $footer_pos_x .' '. $footer_pos_y;
		}
		$footer_styles .= 'background-position: '. $footer_pos .';';
		$footer_styles .= 'background-repeat: '. $footer_repeat .';';
	}
	if ($footer_styles) {
		echo '#footer { '. $footer_styles .' }';
	}

	echo stripslashes(htmlspecialchars_decode(get_options_data('content-options', 'custom-css')));

	?>
</style>
<script type="text/javascript">
	<?php echo stripslashes(htmlspecialchars_decode(get_options_data('content-options', 'custom-js'))); ?>
</script>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" role="banner">
		<div class="site-header page-width">
			<hgroup class="header-title"><?php
				// Site title/logo
				$logo_image   = get_options_data('design-settings', 'logo');
				$logo_title   = get_options_data('design-settings', 'logo-title'); 
				$logo_tagline = get_options_data('design-settings', 'logo-tagline');
				$logo_link    = get_options_data('design-settings', 'logo-link');

				// Set defaults
				$logo_title   = ($logo_title) ? $logo_title : get_bloginfo('name'); 
				$logo_link    = ($logo_link) ? $logo_link : home_url('/'); 

				if (!$logo_image) {
					// Text logo
					echo '<h1 class="site-title"><a href="'. esc_url( $logo_link ) .'" title="'. esc_attr( $logo_title ) .'" rel="home">'. $logo_title .'</a></h1>';
					if ($logo_tagline) {
						// Tagline
						echo '<h2 class="site-description">'. bloginfo( 'description' ) .'</h2>';
					}

				} else {
					// Image logo
					echo '<h1 class="site-title"><a href="'. esc_url( $logo_link ) .'" title="'. esc_attr( $logo_title ) .'" rel="home"><img src="'. $logo_image .'" alt="'. esc_attr( $logo_title ) .'"></a></h1>';
				}
			?>
			</hgroup>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h3 class="menu-toggle"><?php _e( 'Menu', 'liftoff' ); ?></h3>
				<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'liftoff' ); ?>"><?php _e( 'Skip to content', 'liftoff' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav><!-- #site-navigation -->
			<div class="clear"></div>
		</div>
		<div class="entry-content page-width">
			<?php 
			
			// Header Content
			echo wpautop(stripslashes(htmlspecialchars_decode(get_options_data('content-options', 'header-content')))); 

			?>
		</div>
		<div class="clear"></div>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
		<?php do_action('output_layout','start'); ?>