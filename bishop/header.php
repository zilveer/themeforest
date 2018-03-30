<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * @package    WordPress
 * @subpackage Your Inspiration Themes
 * @author     Your Inspiration Themes Team <info@yithemes.com>
 *
 */

?><!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8 no-js" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">
<!--<![endif]-->

<!-- START HEAD -->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if( yit_get_option( 'general-activate-responsive' ) == 'yes' ) : ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php endif; ?>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php  echo YIT_THEME_ASSETS_URL; ?>/js/html5shiv.js"></script>
      <script src="<?php  echo YIT_THEME_ASSETS_URL; ?>/js/respond.min.js"></script>
    <![endif]-->
    <?php wp_head() ?>
</head>
<!-- END HEAD -->

<!-- START BODY -->
<body <?php body_class() ?> id="home">

    <?php
    /**
     * @see yit_header
     */
    do_action( 'yit_header' ) ?>