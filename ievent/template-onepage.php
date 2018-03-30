<?php 

//Template Name: One-Page

get_header(); ?>

<?php 
	/** Template Name: Home  */
		while(have_posts()): the_post();           
			the_content();
		endwhile;
?>

<?php get_footer(); ?>