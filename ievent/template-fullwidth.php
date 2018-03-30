<?php get_header(); ?>



<?php 
	/** Template Name: Fullwidth  */
		while(have_posts()): the_post();           
			the_content();
		endwhile;
?>

<?php get_footer(); ?>