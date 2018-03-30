<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php echo ( is_home() || is_front_page() ) ? bloginfo('name') : wp_title('| ', true, 'right'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="wrapper">

	<header id="sub-header">
		
		<div class="one_half">
			<?php echo wpautop(htmlspecialchars_decode(esc_textarea(get_option('header_left','configure in "appearance" => "customise" => "header"')))); ?>
		</div>
		
		<div class="one_half last">
			<?php echo wpautop(htmlspecialchars_decode(esc_textarea(get_option('header_right','configure in "appearance" => "customise" => "header"')))); ?>
		</div>
		<div class="clear"></div><!--clear floats-->
		
	</header>