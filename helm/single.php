<?php
/*
*  Single Page
*/
?>
<?php get_header(); ?>
<?php
$blogpost_style= get_post_meta($post->ID, MTHEME . '_blogpost_style', true);
if ($blogpost_style != "Fullwidth without sidebar") {
	get_template_part( 'loop', 'single' );
} else {
	get_template_part( 'loop', 'single_fullwidth' );
}
?>