<?php
if ( !defined('ABSPATH') ) exit;

if ( !isset( $content_width ) ) {
	$content_width = 960;
}

$color_scheme = TMM::get_option( "color_scheme" );
if ( empty( $color_scheme ) ) {
	$color_scheme = 1;
}

global $post;

$page_id = 0;
if (is_object($post) && (is_single() || is_page() || is_front_page()) ) {
	$page_id = $post->ID;
}

$page_id = apply_filters('tmm_post_id', $page_id);

$body_styles = '';
if ($page_id > 0) {
	$body_styles = TMM_Helper::get_page_backround( $page_id );
}

if (!empty($body_styles)) {
	$body_styles = ' style="' . $body_styles . '"';
}

// Checks if the page content is empty
function empty_content($str) {
	return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
}

if (is_object($post) && empty_content($post->post_content) && is_page_template('default')) {
	$page_content = ' has-no-content';
} else {
	$page_content = ' has-content';
}

?>
<!DOCTYPE html>
<!--[if gte IE 9]><!-->	<html class="ie9 no-js" <?php language_attributes(); ?>>    <!--<![endif]-->
<!--[if !IE]><!-->	    <html class="not-ie no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<?php get_template_part( 'header/header', 'seocode' ); ?>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<!--[if ie]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
		<?php echo TMM::get_option( "tracking_code" ); ?>
	</head>

<body <?php body_class(); ?><?php echo $body_styles; ?>>

<!-- Mobile Nav toggle -->
<input id="toggle-main-nav" class="toggle-main-nav" type="checkbox" />

<div class="wrapper">
	<div class="wrapper-inner">

	<?php if (TMM::get_option('boxed_layout')) { ?>
	<div class="page-wrap">
	<?php } ?>

	<div id="fb-root"></div>

	<!-- - - - - - - - - - - - Header - - - - - - - - - - - - - -->

	<?php get_template_part('header/header', 'default'); ?>

	<!-- - - - - - - - - - - - end Header - - - - - - - - - - - - - -->


	<!-- - - - - - - - - - - Slider - - - - - - - - - - - - - -->

	<?php tmm_page_slider( $page_id ); ?>

	<!-- - - - - - - - - - - end Slider - - - - - - - - - - - - - -->


	<!-- - - - - - - - - - - Search Panel - - - - - - - - - - - - - -->

	<?php get_template_part( 'frontpage', 'search-panel' ); ?>

	<!-- - - - - - - - - - end Search Panel - - - - - - - - - - - - -->


	<!-- - - - - - - - - - - - - - - Content - - - - - - - - - - - - - - - - -->

	<div id="content" class="<?php echo tmm_get_sidebar_position() ?>">

		<?php tmm_layout_content($page_id, 'before_full_width'); ?>

		<div class="container">
		<div class="row">

		<?php if ( tmm_get_sidebar_position() == 'no_sidebar' ) { ?>
		<main id="main" class="col-xs-12<?php echo $page_content; ?>">
		<?php } ?>

		<?php if ( tmm_get_sidebar_position() != 'no_sidebar' ) { ?>
		<main id="main" class="col-md-9 col-sm-12<?php echo $page_content; ?>">
		<?php } ?>