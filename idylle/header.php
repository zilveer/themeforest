<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Idylle
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<?php
if( function_exists('fw_get_db_settings_option') ) {
	
    /*Body Classes*/
	if(fw_get_db_settings_option('petals_mobile') == 'yes'){
		add_filter( 'body_class', 'petals_mobile' );
		function petals_mobile( $classes = '') {
			$classes[] = 'petals_mobile';
			return $classes;
		}	
	}
}
?>

<body <?php body_class(); ?>>

<?php
	if( is_front_page() ){ 
		get_template_part('inc/header', 'main'); 
	}else {
		get_template_part('inc/header', 'default'); 
	}
?>