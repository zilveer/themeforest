<?php
/*
* Theme Name: QOON -  Creative WordPress Portfolio Theme
* Author: OrangeIdea
* Text Domain: qoon-creative-wordpress-portfolio-theme
* Domain Path: /languages
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php $oi_qoon_options = get_option('oi_qoon_options'); $allowed_html_array = wp_kses_allowed_html( 'post' )?>
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {?>
    <link rel="shortcut icon" href="<?php  echo esc_url(stripslashes($oi_qoon_options['oi_header_favicon']['url']));?>">
    <?php };?>
    <?php wp_head(); ?>
</head>
<?php get_template_part( 'framework/layout/layout', $oi_qoon_options['site-layout'] );?>


