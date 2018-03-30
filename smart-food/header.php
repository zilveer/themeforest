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

	if(is_page()) : 

		get_template_part( 'templates/headers/header', 'page' );

	elseif(is_home()) :

		get_template_part( 'templates/headers/header', 'blog' );

	elseif(is_post_type_archive( 'wprm_menu' ) || is_tax('menu_category') ) :

		get_template_part( 'templates/headers/header', 'archive' );

	elseif(function_exists('tribe_is_event_category') && tribe_is_event_category() || function_exists('tribe_is_month') && tribe_is_month() || function_exists('tribe_is_list_view') && tribe_is_list_view() || function_exists('tribe_is_day') && tribe_is_day()) : 

		get_template_part( 'templates/headers/header', 'events' );

	elseif(is_singular( 'tribe_events' )) :

		get_template_part( 'templates/headers/header', 'evtitle' );

	else:

		get_template_part( 'templates/headers/header', 'regular' );

	endif;

	if(tdp_option('sticky_header') && !wp_is_mobile()) : 

		get_template_part( 'templates/headers/header', 'sticky' );

	endif; 

?>
</div>
<!-- End Header -->
<div class="clearfix"></div>