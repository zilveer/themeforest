<?php
/**
 * Header
 * @package by Theme Record
 * @auther: MattMao
 */

global $tr_config;
$enable_responsive = $tr_config['enable_responsive'];
$enable_announcement = $tr_config['enable_announcement'];
$announcement = $tr_config['announcement'];
$feed = $tr_config['feed'];
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<!--Begin head-->
<head>

<!--Meta Tags-->
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php if($enable_responsive == 'yes'): ?>
<!-- scaling not possible (for iphone, ipad, etc.) -->
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<?php endif; ?>

<?php echo theme_wp_seo('|'); ?>

<!--Pingbacks-->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php if($feed) { echo $feed; } else { bloginfo('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--Styles And JavaSrcipts-->
<?php
	wp_head(); 
?>

<!--End head-->
</head>

<!--Begin Body-->
<body <?php body_class(); ?>>

<div id="page" class="hfeed">

<?php if($enable_announcement == 'yes'): ?>
<div id="announcement">
	<div id="announcement-container" class="col-width">
		<div id="announcement-content"><?php echo $announcement; ?></div>		
		<a href="#" class = "close-announcement"><?php _e('Close', 'TR'); ?></a>
	</div>
</div><!--- #announcement -->
<?php endif; ?>

<div class="topbar-wrap"><div id="topborder"></div></div>
<!--Begin Header-->
<header id="site-head">

<section class="col-width clearfix">
	<?php theme_site_name(); ?>
	<?php theme_top_wp_nav(); ?>
</section>
<!--End Header-->
</header>

<div class="clear"></div>

<?php theme_page_header(); ?>