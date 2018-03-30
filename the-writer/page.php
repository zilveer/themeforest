<?php get_header();
	if (have_posts()) :
		while (have_posts()) :	the_post(); setup_postdata($post);
			get_template_part("/functions/post-view");
		endwhile;
	else :
		get_template_part("/functions/post-empty");
	endif;

	comments_template();
get_footer(); ?>