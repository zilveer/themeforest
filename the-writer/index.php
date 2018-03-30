<?php get_header(); ?>
	<ul class="post-list opacity_zero" id="post-list">
		<?php if (have_posts()) :
			while (have_posts()) :	the_post(); setup_postdata($post);
				get_template_part("/functions/post-list");
			endwhile;
		else :
			get_template_part("/functions/post-empty");
		endif; ?>
	</ul>
	<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>

<?php get_footer(); ?>