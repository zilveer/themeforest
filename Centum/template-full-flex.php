<?php
/**
 * Template Name: Full width page + Flex slider
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage centum
 * @since centum 1.0
 */

get_header();

$slides = ot_get_option( 'mainslider', array() );
if ( !empty( $slides )) {
	get_template_part('slider'); 
}

get_template_part( 'content', 'pagefull' ); 



get_footer(); 

?>