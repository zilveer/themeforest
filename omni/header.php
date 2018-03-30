<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package omni
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

$menu_position = cs_get_customize_option( 'menu_position' );

$page_meta = get_post_meta( get_the_ID(), 'custom_sidebar_options', true );
if ( isset( $page_meta['meta-menu-position'] ) && ! ( empty( $page_meta['meta-menu-position'] ) ) && ! ( 'default' === $page_meta['meta-menu-position'] ) ) {
	$menu_position = $page_meta['meta-menu-position'];
}

if ( 'menu-vertical' === $menu_position ) {
	$menu_align_class = 'sidebar-menu-added';
} else {
	$menu_align_class = '';
}

if ( isset( $page_meta['menu_stick_to_bottom'] ) && ( true === $page_meta['menu_stick_to_bottom'] ) ) {
	$menu_stick_class = 'menu-stick';
} else {
	$menu_stick_class = '';
}

if ( isset( $page_meta['header_transparent'] ) && ( true === $page_meta['header_transparent'] ) ) {
	$transparent_header_class = 'transparent-header';
} else {
	$transparent_header_class = '';
}

$custom_color_scheme = cs_get_customize_option( 'predefined_color_schemes' );
if(empty($custom_color_scheme) || ('custom' === $custom_color_scheme)){
	$custom_color_scheme = 'theme-1';
}

$blog_hide_date = cs_get_customize_option( 'blog_date_display' );

$blog_page_meta = get_post_meta( get_the_ID(), '_custom_page_options', true );

if ( isset( $blog_page_meta['meta_show_date'] ) && ! empty( $blog_page_meta['meta_show_date'] ) && ! ( 'default' === $blog_page_meta['meta_show_date'] ) ) {
	if ( 'enable' === $blog_page_meta['meta_show_date'] ) {
		$blog_hide_date = true;
	} elseif ( 'disable' === $blog_page_meta['meta_show_date'] ) {
		$blog_hide_date = false;
	}
}

if ( isset( $blog_hide_date ) && true === $blog_hide_date ) {
	$blog_hide_date_class = 'blog-date-hide';
} else {
	$blog_hide_date_class = '';
}

$mobile_devices_no_animation = cs_get_customize_option( 'disable_mobile_animations' );

if(isset($mobile_devices_no_animation) && true === $mobile_devices_no_animation){
	$no_mobile_animation_class = 'no-mobile-animation';
}else{
	$no_mobile_animation_class = '';
}
?>

<body data-theme="<?php echo esc_attr($custom_color_scheme);?>" <?php body_class( $menu_align_class . ' ' . $menu_stick_class . ' ' . $transparent_header_class.' '.$blog_hide_date_class.' '.$no_mobile_animation_class ); ?>>
<div id="main-wrapper">
<?php if ( ! is_404() && ! is_page_template( 'page-templates/coming-soon.php' ) ) {
	get_template_part( 'template-parts/head', 'default' );
}
