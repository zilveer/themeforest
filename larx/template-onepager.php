<?php

/* Template Name: Homepage / One Pager */

$post = $wp_query->post;
get_header();
		
	if (have_posts()) : while (have_posts()) : the_post();?>
		<div id="th_onepage_wrapper"> <?php
			the_content();?>
		</div> <?php

	endwhile; endif;   

get_footer(); 
 
?>