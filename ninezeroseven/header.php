<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<!-- Mobile Specific Metas
  ================================================== -->

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<?php
global $wbc907_data;
wp_head();
?>
</head>

<body <?php body_class(); ?>>


	<?php do_action( 'wbc907_before_page_content' ); ?>

	<!-- Up Anchor -->
	<span class="anchor-link wbc907-top" id="up"></span>

	<?php wbc907_menu_bar_output(); ?>

	<!-- Page Wrapper -->
	<div class="page-wrapper">

	<?php do_action( 'wbc907_after_wrapper' );?>
