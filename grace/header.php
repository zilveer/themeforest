<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
?>
<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<?php
global $post;

if (isset($post)) {
	$postID = $post->ID;
	$postCustom = get_post_custom($postID);
}

if (isset($postCustom['_wp_page_template'][0])) {
	$template = $postCustom['_wp_page_template'][0];
} else {
	$template = 0;
}

?>

<title><?php
	// Detect Yoast SEO Plugin
	if (defined('WPSEO_VERSION')) {
		wp_title('');
	} else {
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page; global $paged; 

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'grace' ), max( $paged, $page ) );
	}
	?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Add CSS3 Rules here for IE 7-9
================================================== -->

<!-- Mobile Specific Metas
================================================== -->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 

<!-- Favicons
================================================== -->

<?php $themeOptions = of_get_all_options(); ?>

<?php $favicon = of_get_option('favicon'); ?>

<?php if ($favicon) { ?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>">
<?php } ?>

<?php $apple_touch_icon = of_get_option('apple_touch_icon'); ?>

<?php if ($apple_touch_icon) { ?>
<link rel="apple-touch-icon" href="<?php echo $apple_touch_icon; ?>">
<?php } ?>

<link rel="pingback" href="<?php echo get_option('siteurl') .'/xmlrpc.php';?>" />
<link rel="stylesheet" id="custom" href="<?php echo home_url() .'/?get_styles=css';?>" type="text/css" media="all" />

<?php
	/* 
	 * enqueue threaded comments support.
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	// Load head elements
	wp_head();
?>

<!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="<?php echo PARENT_URL; ?>/javascripts/selectivizr.js"></script>
<![endif]-->

</head>

<?php
$sidebar_position = tb_default($themeOptions['page_layout'], 'right');
$body_class_sidebar = "sidebar-position-$sidebar_position";

$site_layout = tb_default($themeOptions['site_layout'], 'wide');
$body_class_layout = "layout-$site_layout";

$specific_background_height = tb_default($themeOptions['specific_background_height'], 0);
?>

<body <?php body_class("$body_class_sidebar $body_class_layout"); ?>>

	<a name="top" id="top"></a>

	<?php

	if ($specific_background_height && $site_layout == 'box') {
		?>
		<div id="background"></div>
		<div id="backgroundShadow"></div>
		<?php
	}
	?>

	<?php
	$showPromoLine = of_get_option('show_promo_line', 1);
	if ($showPromoLine) { ?>
	
	<div id="promoLine">
		<div class="bckg"></div>
		<div class="container"><div class="sixteen columns">
			<div class="left"><?php echo of_get_option('promo_line_content'); ?></div>
			
			<?php
			$social_link_facebook = isset($themeOptions['social_link_facebook']) ? $themeOptions['social_link_facebook'] : FALSE;	
			$social_link_twitter = isset($themeOptions['social_link_twitter']) ? $themeOptions['social_link_twitter'] : FALSE;
			$social_link_google_plus = isset($themeOptions['social_link_google_plus']) ? $themeOptions['social_link_google_plus'] : FALSE;
			$social_link_instagram = isset($themeOptions['social_link_instagram']) ? $themeOptions['social_link_instagram'] : FALSE;
			$social_link_tumblr = isset($themeOptions['social_link_tumblr']) ? $themeOptions['social_link_tumblr'] : FALSE;
			$social_link_pinterest = isset($themeOptions['social_link_pinterest']) ? $themeOptions['social_link_pinterest'] : FALSE;
			$social_link_picassa = isset($themeOptions['social_link_picassa']) ? $themeOptions['social_link_picassa'] : FALSE;
			$social_link_flickr = isset($themeOptions['social_link_flickr']) ? $themeOptions['social_link_flickr'] : FALSE;
			$social_link_youtube = isset($themeOptions['social_link_youtube']) ? $themeOptions['social_link_youtube'] : FALSE;
			$social_link_vimeo = isset($themeOptions['social_link_vimeo']) ? $themeOptions['social_link_vimeo'] : FALSE;
			$social_link_deviantart = isset($themeOptions['social_link_deviantart']) ? $themeOptions['social_link_deviantart'] : FALSE;
			$social_link_forrst = isset($themeOptions['social_link_forrst']) ? $themeOptions['social_link_forrst'] : FALSE;
			$social_link_email = isset($themeOptions['social_link_email']) ? $themeOptions['social_link_email'] : FALSE;
			?>
			
			<div class="right">

				<?php if ($social_link_facebook) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_facebook); ?>"><span aria-hidden="true" class="icon-facebook-2"></span></a>
				<?php } ?>
				
				<?php if ($social_link_twitter) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_twitter); ?>"><span aria-hidden="true" class="icon-twitter"></span></a>
				<?php } ?>
				
				<?php if ($social_link_google_plus) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_google_plus); ?>"><span aria-hidden="true" class="icon-google-plus"></span></a>
				<?php } ?>
				
				<?php if ($social_link_instagram) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_instagram); ?>"><span aria-hidden="true" class="icon-instagram"></span></a>
				<?php } ?>
				
				<?php if ($social_link_tumblr) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_tumblr); ?>"><span aria-hidden="true" class="icon-tumblr"></span></a>
				<?php } ?>
				
				<?php if ($social_link_pinterest) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_pinterest); ?>"><span aria-hidden="true" class="icon-pinterest-2"></span></a>
				<?php } ?>
				
				<?php if ($social_link_picassa) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_picassa); ?>"><span aria-hidden="true" class="icon-picassa"></span></a>
				<?php } ?>
				
				<?php if ($social_link_flickr) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_flickr); ?>"><span aria-hidden="true" class="icon-flickr"></span></a>
				<?php } ?>
				
				<?php if ($social_link_youtube) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_youtube); ?>"><span aria-hidden="true" class="icon-youtube"></span></a>
				<?php } ?>
				
				<?php if ($social_link_vimeo) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_vimeo); ?>"><span aria-hidden="true" class="icon-vimeo"></span></a>
				<?php } ?>
				
				<?php if ($social_link_deviantart) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_deviantart); ?>"><span aria-hidden="true" class="icon-deviantart-2"></span></a>
				<?php } ?>
				
				<?php if ($social_link_forrst) { ?>
				<a class="iconLink" href="<?php echo esc_url($social_link_forrst); ?>"><span aria-hidden="true" class="icon-forrst-2"></span></a>
				<?php } ?>
				
				<?php if ($social_link_email) { ?>
				<a class="iconLink" href="<?php echo esc_url('mailto:' . $social_link_email); ?>"><span aria-hidden="true" class="icon-mail"></span></a>
				<?php } ?>				
			</div>
		</div></div>
	</div>
	
	<?php
	}
	
	$show_ornament_line = tb_default($themeOptions['show_ornament_line'], 1);
		
	if ($site_layout == 'wide') {
		st_navbar('wide');
		
		if ($show_ornament_line) {
			echo '<div class="width100 ornamentLine"></div>';
		}
		
		?>
		
		<div class="clear"></div>
		
		<div id="wrap" class="width100">
		
		<?php
		
		if ($specific_background_height && (!$template || $template != 'page-home-wide-slider.php')) {
			?>
			<div id="background"></div>
			<div id="backgroundShadow"></div>
			<?php
		}
		
		if (!$template || $template != 'page-home-wide-slider.php') { ?>
		
		<div class="container">
		<div id="contentarea">
		
		<?php
		
		}
	} else {
	
	?>

	<div id="wrap" class="container">
	<?php
	st_above_header();
	st_header();
	st_below_header();
	st_navbar();
	?>
	
	<?php
	if ($show_ornament_line) {
		echo '<div class="ornamentLine"></div>';
	}
	?>
	<!-- CONTENT AREA -->
	<div class="clear"></div>
	<div id="contentarea">
	
	<?php			
	}
	?>