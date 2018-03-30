<?php get_header(); ?>
	<div class="category-title-container">
		<h2 class="category-title"><?php _e( 'Search Results' , 'ocmx' ); ?></h2>
		<p><?php _e("Following are your search results for", "ocmx"); ?> <strong>"<?php the_search_query(); ?>"</strong></p>
	</div>

	<ul class="post-list opacity_zero">
		<?php if ( have_posts() ) :
			while ( have_posts() ) :
				the_post(); setup_postdata($post);
				get_template_part("/functions/post-list");
			endwhile;
		else :
			get_template_part("/functions/post-empty");
		endif; ?>
	</ul>
	<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>

<?php get_footer(); ?>