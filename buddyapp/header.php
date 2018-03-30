<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="page-wrapper">
 *
 * @package WordPress
 * @subpackage BuddyApp
 * @since BuddyApp 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/css3-mediaqueries.js"></script>
    <![endif]-->

    <?php if(function_exists('bp_is_active')) { bp_head(); } ?>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<?php do_action('kleo_after_body');?>

    <!-- Document Wrapper
    ============================================= -->
    <div id="page-wrapper" class="clearfix">

        <?php
        /**
         * Included Header section using actions
         *
		 * adds topbar
         * adds primary menu
         * adds logo
         * adds page title section
         *
         * Templates used:
         * @see page-parts/_header-side.php - (outputs sidemenu)
         * @see page-parts/header-top.php - (outputs top header)
         * @see page-parts/page-title/ - (outputs page title based on theme options)
         *

         * @hooked kleo_show_header - 12

         */

        do_action( 'kleo_header' );
        ?>
