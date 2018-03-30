<?php
/**
 * Template Name: Full width page + Revo Slider
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
$slider = get_post_meta($post->ID, 'incr_page_revolution', true);

if($slider) {
	echo '<section class="slider">';	putRevSlider($slider); echo "</section>";
}

get_template_part( 'content', 'pagefull' ); 



get_footer(); 

?>