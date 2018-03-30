<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="site-wrapper">
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php wolf_meta_head(); ?>

	<!-- Title -->
	<title><?php wp_title( '' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php  bloginfo( 'rss2_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
		<script src="<?php echo esc_url( get_template_directory_uri() . '/js/lib/html5shiv.min.js' ); ?>" type="text/javascript"></script>
	<![endif]-->
	<?php wolf_head(); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wolf_body_start(); ?>
<div class="site-container">
<?php wolf_site_content_start(); ?>
<div id="page" class="hfeed site pusher">
	<div id="page-content">

	<?php wolf_header_before(); ?>
	<header id="masthead" class="site-header clearfix" role="banner">
		<?php wolf_header_start(); ?>

		<?php wolf_header_end(); ?>
	</header><!-- #masthead -->
	<?php wolf_header_after(); ?>

	<?php wolf_content_before(); ?>
	<div id="main" class="site-main clearfix">
		<div class="site-wrapper">
		<?php wolf_content_start(); ?>
