<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="wrapper">
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="utf-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<title><?php wp_title(':'); ?></title>
	<meta name="description" content="<?php echo get_mental_seo_description() ?>">

	<?php if ( get_mental_option( 'fav_icon' ) ): ?>
		<link href="<?php echo wp_get_attachment_url( get_mental_option( 'fav_icon' ) ); ?>" rel="shortcut icon">
	<?php endif ?>
	<?php if ( get_mental_option( 'apple_icon' ) ): ?>
		<link href="<?php echo wp_get_attachment_url( get_mental_option( 'apple_icon' ) ); ?>" rel="apple-touch-icon-precomposed">
	<?php endif ?>

	<?php get_template_part('blocks/head-seo'); ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> <?php if(is_page_template('page-onepage.php')) echo 'data-spy="scroll" data-target=".top-main-menu-scrollspy" data-offset="60"' ?><?php if(is_page_template('page-full-onepage.php')) echo 'data-offset="4"' ?>>
	<?php get_template_part( 'blocks/preloader' ); ?>
	<?php get_template_part( 'blocks/custom-styles' ); ?>
	<script type="text/javascript">
		// Open page with hidden menu-bar on mobile screen less than 700px
		if(window.innerWidth < 738){
			var body_element = document.getElementsByTagName('body')[0];
			body_element.className = body_element.className.replace(/\bmenu-bar-opened\b/,'')
		}
	</script>
	<!--[if lt IE 9]>
	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<?php if(get_mental_option('scroll_to_top')): ?>
		<a href="#" id="azl_scroll_up"><i class="fa fa-angle-up"></i></a>
	<?php endif; ?>

	<div id="wrapper">
