<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php echo ( is_home() || is_front_page() ) ? bloginfo('name') : wp_title('| ', true, 'right'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'menu-' . get_option('menu_style','side') . ' ' . get_option('mobile_menu','mobile-dropdown') ); ?>>

<div class="wrapper <?php if( get_option('boxed_wrapper', '0') == 1 ) echo 'boxed'; ?>">

	<?php if( get_option('header_left') || get_option('header_right') ) : ?>
		<header id="sub-header">
			
			<div class="one_half">
				<?php echo wpautop(htmlspecialchars_decode(esc_textarea(get_option('header_left','configure in "appearance" => "customise" => "header"')))); ?>
			</div>
			
			<div class="one_half last">
				<?php echo wpautop(htmlspecialchars_decode(esc_textarea(get_option('header_right','configure in "appearance" => "customise" => "header"')))); ?>
			</div>
			<div class="clear"></div><!--clear floats-->
			
		</header>
	<?php endif; ?>
	
	<?php 
		get_template_part( 'content', get_option('menu_style','side') );
		
		if ( function_exists('yoast_breadcrumb') )
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');