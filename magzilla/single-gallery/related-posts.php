<?php
/**
 * Relatest Posts from the same Category
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/

global $ft_option, $related_css, $post;

$tags = wp_get_post_terms($post->ID, 'gallery-categories', array("fields" => "all"));
$terms_id = $tags[0]->term_id;

$galleries_to_show =  $ft_option['single_related_galleries_to_show'];

$args = array(
'posts_per_page' => $galleries_to_show,
'post__not_in' => array( $post->ID ),
'tax_query' => array(
	array(
		'taxonomy' => 'gallery-categories',
		'field' => 'id',
		'terms' => $terms_id
	)
)
);
$query = new WP_Query( $args ); 

if($query->have_posts()):
?>

<div class="related-post">
	<div class="module-top clearfix">
		<h4 class="module-title"><?php echo $ft_option["gallery_single_related_title"]; ?></h4>
	</div><!-- module-top -->
	<div class="module-body">
		<div class="row">
			
			<?php while($query->have_posts()): $query->the_post(); ?>


			<div class="<?php echo esc_attr( $related_css ); ?>">
				<div class="featured-image-wrap">
					<?php get_template_part( 'inc/article', 'icon' ); ?>

					<div class="category-label"><?php get_template_part( 'inc/post', 'cats' ); ?></div>
					<a href="<?php the_permalink(); ?>">
						<img class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), 370, 278, true, true, true ); ?>" alt="<?php the_title(); ?>">
					</a>
				</div><!-- featured-image-wrap -->
				<article class="post">
					<h2 class="post-title module-small-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<ul class="list-inline post-meta">
						<?php get_template_part( 'inc/post', 'meta' ); ?>
					</ul><!-- .post-meta -->
					
					<div class="post-content post-small-content">
						<p><?php echo fave_clean_excerpt( '110', true ); ?></p>
					</div><!-- post-content -->
				</article><!-- .module-5-post -->
			</div><!-- col-lg-6 col-md-6 col-sm-12 col-xs-12 -->

			<?php endwhile; ?>	
			
		</div><!-- .row -->
	</div><!-- module-body -->
</div><!-- related-post -->

<?php
endif;
wp_reset_postdata();
?>