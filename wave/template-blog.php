<?php 
/*
	Template Name: Blog
*/

get_header(); 

$has_sidebar = false;
$layout = get_post_meta( get_the_ID(), $dd_sn . 'blog_layout', true );
$posts_per_page = get_post_meta( get_the_ID(), $dd_sn . 'posts_per_page', true );
$cats = get_post_meta( get_the_ID(), $dd_sn . 'blog_cats', true );

$content_class = '';

if ( $layout == '2col' ) {
	$dd_post_class = 'eight columns ';
	$dd_thumb_size = 'dd-one-half';
} elseif ( $layout == '3col' ) {
	$dd_post_class = 'one-third column ';
	$dd_thumb_size = 'dd-one-third';
} elseif ( $layout == '3col_s' ) {
	$dd_post_class = 'one-third column ';
	$content_class = 'two-thirds column ';
	$dd_thumb_size = 'dd-one-third';
	$has_sidebar = true;
} elseif ( $layout == '4col' ) {
	$dd_post_class = 'four columns ';
	$dd_thumb_size = 'dd-one-fourth';
}


?>

	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

			<div class="blog-posts masonry clearfix">

				<?php

					/* Query */

					if(is_front_page()){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }else{ $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; }
					$args = array(
						'paged' => $paged, 
						'post_type' => 'post',
						'posts_per_page' => $posts_per_page
					);

					// Categories
					if ( $cats ) {
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'category',
								'field' => 'id',
								'terms' => $cats
							)
						);
					}

					$dd_query = new WP_Query($args);

					/* Vars */

					$count = 0;

					/* Loop */

					if ($dd_query->have_posts()) : while ($dd_query->have_posts()) : $dd_query->the_post(); /* Loop the posts */ $count++;
						
							get_template_part( 'templates/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );

					endwhile; else:

						?><div class="align-center">The blog is empty. Go to WP admin &rarr; Posts &rarr; Add New.<br>You can read more about creating blog posts in the Documentation.</div><?php

					endif;

				?>

			</div><!-- .blog-posts -->

			<?php
				$num_pages = $dd_query->max_num_pages;
				dd_theme_pagination( $num_pages ); 
				wp_reset_postdata(); 
			?>

		</div><!-- #content -->

		<?php if ( $has_sidebar ) get_sidebar(); ?>

	</div><!-- .container -->

<?php get_footer(); ?>