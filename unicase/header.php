<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package unicase
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php unicase_html_tag_schema(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site wrapper">
	<?php
	do_action( 'unicase_before_header' ); ?>
	<!-- ============================================================= HEADER ============================================================= -->
	<header <?php unicase_header_class();?>>
		<?php
		/**
			 * @hooked unicase_skip_links - 0
			 * @hooked unicase_social_icons - 10
			 * @hooked unicase_site_branding - 20
			 * @hooked unicase_secondary_navigation - 30
			 * @hooked unicase_product_search - 40
			 * @hooked unicase_primary_navigation - 50
			 * @hooked unicase_header_cart - 60
			 */
		do_action( 'unicase_header' ); ?>
	</header><!-- /.site-header -->
	<!-- ============================================================= HEADER : END ============================================================= -->

	<?php
	/**
	 * @hooked unicase_hook_jumbotron - 5
	 * @hooked woocommerce_breadcrumb - 10
	 */
	do_action( 'unicase_before_content' ); ?>

	<div id="content" class="<?php echo esc_attr( apply_filters( 'unicase_site_content_classes', 'site-content' ) ); ?>" tabindex="-1">

		<?php

		do_action( 'unicase_content_top' ); ?>
