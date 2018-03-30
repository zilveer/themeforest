<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js ie lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js ie lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-ie" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

    <meta charset="utf-8">

    <title><?php wp_title('|'); ?></title>

	<?php
	global $dfd_ronneby;
	if(isset($dfd_ronneby['custom_favicon']['url']) && $dfd_ronneby['custom_favicon']['url']) : ?>
		<link rel="icon" type="image/png" href="<?php echo esc_url($dfd_ronneby['custom_favicon']['url']) ?>" />
	<?php endif; ?>
	<?php if(isset($dfd_ronneby['custom_favicon_iphone']['url']) && $dfd_ronneby['custom_favicon_iphone']['url']) : ?>
		<link rel="apple-touch-icon" href="<?php echo esc_url($dfd_ronneby['custom_favicon_iphone']['url']) ?>">
	<?php endif; ?>
	<?php if(isset($dfd_ronneby['custom_favicon_ipad']['url']) && $dfd_ronneby['custom_favicon_ipad']['url']) : ?>
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url($dfd_ronneby['custom_favicon_ipad']['url']) ?>">
	<?php endif; ?>
	<?php if(isset($dfd_ronneby['custom_favicon_iphone_retina']['url']) && $dfd_ronneby['custom_favicon_iphone_retina']['url']) : ?>
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url($dfd_ronneby['custom_favicon_iphone_retina']['url']) ?>">
	<?php endif; ?>
	<?php if(isset($dfd_ronneby['custom_favicon_ipad_retina']['url']) && $dfd_ronneby['custom_favicon_ipad_retina']['url']) : ?>
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url($dfd_ronneby['custom_favicon_ipad_retina']['url']) ?>">
	<?php endif; ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--[if lte IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/excanvas.compiled.js"></script>
    <![endif]-->

	<?php dfd_custom_page_style(); ?>

    <?php wp_head(); ?>
	
	<?php dfd_print_head_js(); ?>

</head>