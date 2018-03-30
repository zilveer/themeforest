<?php
/* Template Name: Blog */
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php
	global $paged, $page;
	query_posts( array('post_type' =>'post', 'paged' =>($paged?$paged:get_query_var('page'))) );
	get_template_part( 'loop' , 'blog' );
?>
<?php get_footer(); ?>
