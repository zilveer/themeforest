<?php
/**
 * Relatest Posts from the same Category
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/

global $ft_option, $related_css, $related_posts;

$posts_to_show =  $ft_option['single_related_posts_to_show'];

if($ft_option['single_related_posts_by'] == 'related_tags'){
	/***************** Start by Tag *********************/
	$tags = wp_get_post_tags($post->ID);
	if ($tags):
	  $tag_ids = array(); 
	  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id; 
	  $args=array( 
		'tag__in' => $tag_ids, 
		'post__not_in' => array($post->ID), 
		'posts_per_page'=> $posts_to_show
	  );      
	  $related_posts = get_posts( $args );
	endif;
	/***************** End by Tag *********************/
}else{
	$categories = get_the_category( $post->ID );
	if ($categories):
	  $cat_ids = array(); 
	  foreach($categories as $individual_cat) $cat_ids[] = $individual_cat->term_id; 
	  $args=array( 
		'category__in' => $cat_ids,
		'post__not_in' => array( $post->ID ),
		'posts_per_page' => $posts_to_show
	  );      
	  $related_posts = get_posts( $args );
	endif;
}
if( $related_posts ) {
?>

<div class="related-post">
	<div class="module-top clearfix">
		<h4 class="module-title"><?php echo $ft_option["single_related_title"]; ?></h4>
	</div><!-- module-top -->
	<div class="module-body">
		<div class="row">
			
			<?php foreach( $related_posts as $post ): setup_postdata( $post ); ?>

			<div class="fave_related_post <?php echo esc_attr( $related_css ); ?>">
				<div class="featured-image-wrap">
					<?php get_template_part( 'inc/article', 'icon' ); ?>

					<div class="category-label"><?php get_template_part('inc/post', 'cats'); ?></div>
					<a href="<?php the_permalink(); ?>">
						<img itemprop="image" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), 370, 278, true, true, true ); ?>" alt="<?php the_title(); ?>">
					</a>
				</div><!-- featured-image-wrap -->
				<article class="post">
					<h2 itemprop="headline" class="post-title module-small-title"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<ul class="list-inline post-meta">
						<?php get_template_part( 'inc/post', 'meta' ); ?>
					</ul><!-- .post-meta -->
					
					<div class="post-content post-small-content" itemprop="articleBody">
						<p><?php echo fave_clean_excerpt( '110', true ); ?></p>
					</div><!-- post-content -->
				</article><!-- .module-5-post -->
			</div><!-- col-lg-6 col-md-6 col-sm-12 col-xs-12 -->

			<?php endforeach; ?>	
			
		</div><!-- .row -->
	</div><!-- module-body -->
</div><!-- related-post -->

<?php
}
wp_reset_postdata();
?>