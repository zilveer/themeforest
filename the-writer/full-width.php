<?php 
/*
Template Name: Full-Width
*/

get_header();
?>
<div class="full-width">
<?php
	if (have_posts()) :
		while (have_posts()) :	the_post(); setup_postdata($post);
			get_template_part("/functions/post-view");
		endwhile;
	else :
		get_template_part("/functions/post-empty");
	endif;
?>
</div>
<?php get_footer(); ?>