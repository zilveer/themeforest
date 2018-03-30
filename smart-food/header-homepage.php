<?php
/**
 * The header for our theme.
 *
 * @package smartfood
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php tdp_attr( 'body' ); ?>>

<!-- Header -->
<div class="row">
<?php 
	
	get_template_part( 'templates/headers/header', 'responsive' );

	get_template_part( 'templates/headers/header', 'homepage' );

	if(tdp_option('sticky_header')) : 

		get_template_part( 'templates/headers/header', 'sticky' );

	endif; 

?>
</div>
<!-- End Header -->
<div class="clearfix"></div>