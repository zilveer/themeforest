<?php
   /**
    * The template for displaying the header
    *
    * Displays all of the head element and everything up until the "site-content" div.
    *
    * @package WordPress
    * @subpackage Monarch
    * @since Monarch 1.0
    */
?>
<?php monarch_private_site(); ?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); ?> class="no-js">

   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="profile" href="http://gmpg.org/xfn/11">
      <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
      <?php endif; ?>
      <!--[if lt IE 9]>
      <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5shiv.min.js"></script>
      <![endif]-->
      <?php wp_head(); ?>
   </head>

<body <?php body_class(); ?>>

<div class="body-bg clearfix">
<div class="wrapper clearfix">
