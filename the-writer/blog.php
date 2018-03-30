<?php
/*
Template Name: Blog
*/
get_header(); ?>
<div class="archives-container">
	<div class="category-title-container">
		<h2 class="category-title"><?php the_title(); ?></h2>
	</div>

	<ul class="post-list opacity_zero">
		<?php  $args = array( "post_type" => "post", "paged" => $paged );
			$wp_query = new WP_Query($args);
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				global $post;
				get_template_part("/functions/post-list");
			endwhile; ?>
	</ul>
	<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
</div>
<?php get_footer(); ?>