
<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <body> starts
 *
 * @package Wish
 */
    $redux_wish = wish_redux();
    


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( !is_page_template( 'blank.php' ) ) { ?>
<header>
<?php get_template_part( 'template-parts/content', 'header' ); ?>
</header>
<?php } ?>