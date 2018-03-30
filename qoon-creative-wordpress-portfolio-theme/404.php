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
<body>
<style>footer { display:none !important}</style>
<div class="error_holder">
<div class="oi_text_logo"><a href="<?php echo esc_url(home_url('/')); ?>" class="oi_text_logo_a"><?php if(isset($oi_qoon_options['oi_logo_text'])){ echo esc_attr($oi_qoon_options['oi_logo_text']);};?></a><span class="oi_site_description"><?php if(isset($oi_qoon_options['oi_logo_descr'])){ echo esc_attr($oi_qoon_options['oi_logo_descr']);}; ?></span></div>
<h1 class="text-center"><?php _e('Oops, 404 Error','qoon-creative-wordpress-portfolio-theme');?></h1>
<h5><?php _e('The page you were looking for could not be found.','qoon-creative-wordpress-portfolio-theme');?></h5>
<br>
<a class="btn_example" href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home','qoon-creative-wordpress-portfolio-theme');?></a>
</div>
<?php get_footer(); ?>
