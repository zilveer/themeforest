<?php
/* Template Name: Archives */
get_header();

rewind_posts();
wp_reset_postdata(); ?>
<div class="archives-container">
    <div class="category-title-container">
        <?php while ( have_posts() ) :
                the_post(); ?>
            <h2 class="category-title"><?php the_title(); ?></h2>
            <?php the_excerpt(); ?>
        <?php endwhile; ?>
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