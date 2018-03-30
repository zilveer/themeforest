<?php
/**
 * The Header for our theme.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme03
 * @since G1_Theme03 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?><!DOCTYPE html>
<!--[if IE 7 ]>
<html class="no-js lt-ie10 lt-ie9 lt-ie8" id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8 ]>
<html class="no-js lt-ie10 lt-ie9" id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9 ]>
<html class="no-js lt-ie10" id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !IE ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( '', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php do_action( 'g1_before_page' ); ?>
<div id="page">
    <div id="g1-top">
	<?php 
		/* Executes a custom hook.
		 * If you want to add some content before the g1-header, hook into 'g1_header_before' action.
		 */	
		do_action( 'g1_header_before' );
	?>
	<!-- BEGIN #g1-header -->
    <div id="g1-header-waypoint">
	<div id="g1-header" class="g1-header" role="banner">
        <div class="g1-layout-inner">
            <?php
                /* Executes a custom hook.
                 * If you want to add some content before the g1-primary-bar, hook into 'g1_header_begin' action.
                 */
                do_action( 'g1_header_begin' );
            ?>

            <div id="g1-primary-bar">
                <?php G1_Theme()->render_site_id(); ?>
                <!-- END #g1-primary-nav -->
            </div><!-- END #g1-primary-bar -->

            <?php
                /* Executes a custom hook.
                 * If you want to add some content after the g1-primary-bar, hook into 'g1_header_end' action.
                 */
                do_action( 'g1_header_end' );
            ?>

		</div>

        <?php
        if ( 'none' !== g1_get_theme_option( 'general', 'scroll_to_top', 'standard' ) ) {
            echo '<p id="g1-back-to-top"><a href="#page">' . __( 'Top', 'g1_theme' ) . '</a></p>';
        }
        ?>

        <?php get_template_part( 'template-parts/g1_background', 'header' ); ?>
	</div>
    </div>
	<!-- END #g1-header -->	

	<?php
		/* Executes a custom hook.
		 * If you want to add some content after the g1-header, hook into 'g1_header_after' action.
		 */
		do_action( 'g1_header_after' );
	?>

	<?php
		/* Executes a custom hook.
		 * If you want to add some content before the g1-content, hook into 'g1_content_before' action.
		 */	
		do_action( 'g1_content_before' );
	?>

	<?php get_template_part( 'g1_precontent' ); ?>


        <div class="g1-background">
        </div>
    </div>


	<!-- BEGIN #g1-content -->
	<div id="g1-content" class="g1-content">
        <div class="g1-layout-inner">
            <?php
                /* Executes a custom hook.
                 * If you want to add some content before the g1-content-area, hook into 'g1_content_begin' action.
                 */
                do_action( 'g1_content_begin' );
            ?>
            <div id="g1-content-area">