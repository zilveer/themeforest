<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class( get_option('foundry_site_layout', 'normal-layout') . ' parallax-' . get_option('foundry_parallax_version', '3d') . ' ' . get_option('button_style', 'btn-regular') ); ?>>

<?php
	/**
	 * First, we need to check if we're going to override the header layout (with post meta)
	 * Or if we're going to display the global choice from the theme options.
	 * This is what ebor_get_header_layout is in charge of.
	 */
	get_template_part('inc/content-nav', ebor_get_header_layout());
?>

<div class="main-container">