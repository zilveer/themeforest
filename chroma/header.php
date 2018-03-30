<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo get_theme_mod('t2t_customizer_favicon'); ?>" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png">
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<div id="loader"><span class="spinner"></span></div>
	
	<?php if(get_theme_mod("t2t_customizer_header_layout") == "horizontal") { ?>
		<?php get_template_part("header-horizontal"); ?>
	<?php } else { ?>
		<?php get_template_part("header-vertical"); ?>
	<?php } ?>