<?php
/**
 * Previews the shortcode
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

if ( !defined('ABSPATH') )
    die('You are not allowed to call this page directly.');

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html <?php language_attributes(); ?> class="no-js ie6 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html <?php language_attributes(); ?> class="no-js ie7 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html <?php language_attributes(); ?> class="no-js ie8 lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
    <?php wp_head(); ?>
    <link href="<?php bloginfo( 'stylesheet_url' ); ?>" rel="stylesheet" media="all">
    <!--<link href="<?php echo CSS_URI . oxy_get_option( 'skin', 'skin' ); ?>.css" rel="stylesheet" media="all">-->
    <!--[if lt IE 9]>
        <link href="<?php echo CSS_URI ?>ie.css" rel="stylesheet" media="all"  />
        <script src="<?php echo JS_URI ?>css3-mediaqueries.js" type="text/javascript" ></script>
        <script src="<?php echo JS_URI ?>selectivizr-min.js" type="text/javascript" ></script>
        <script src="<?php echo JS_URI ?>custom-ie.js" type="text/javascript" ></script>
     <![endif]-->
     <script src="<?php echo JS_URI ?>bootstrap.js" type="text/javascript" ></script>
     <script src="<?php echo JS_URI ?>jquery.flexslider-min.js" type="text/javascript" ></script>
     <script src="<?php echo JS_URI ?>jquery.fancybox.pack.js" type="text/javascript" ></script>
     <script src="<?php echo JS_URI ?>jquery.fancybox-media.js" type="text/javascript" ></script>
     <script src="<?php echo JS_URI ?>script.js" type="text/javascript" ></script>
     <script src="<?php echo JS_URI ?>wpscript.js" type="text/javascript" ></script>
</head>
<body>
    <div id="wrapper">
        <div id="content">
            <article>
                <?php
                    if( isset( $_GET['sc'] ) ) {
                        echo apply_filters( 'the_content', do_shortcode( stripslashes( $_GET['sc'] ) ) );
                    }
                ?>
            </article>
        </div>
    </div>
</body>
</html>