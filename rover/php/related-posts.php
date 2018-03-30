<?php
/**
 * Related Posts
 * @package by Theme Record
 * @auther: MattMao
*/


#
#Related Works
#
if ( !function_exists( 'theme_related_post' ) )
{
	function theme_related_post($type, $taxonomy, $show_title, $show_skills, $posts_per_page) 
	{
	?>
	<div class="related-post-lists post-slide-list post-carousel">
		<h3 class="title"><?php echo __('Related Works', 'TR'); ?></h3>
		<ul class="clearfix">
		<?php
			$related_posts = get_posts_related_by_taxonomy($taxonomy, $posts_per_page);
			while ($related_posts->have_posts()) : $related_posts->the_post();	

			$title = get_the_title();
			$size = 'column-4';


			#
			#Get icon
			#
			$media_type = get_meta_option('portfolio_type');

			switch($media_type)
			{
				case 'image': $icon = 'item-image'; break;
				case 'slideshow': $icon = 'item-gallery'; break;
				case 'video': $icon = 'item-video'; break;
				case 'audio': $icon = 'item-audio'; break;
			}

			//Get item class
			$item_class = 'class="item post-item '.$icon.'"';

		?>
		<li <?php echo $item_class; ?>>
		<?php if(has_post_thumbnail()) : ?>
		<div class="post-thumb post-thumb-hover post-thumb-preload">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="loader-icon" rel="bookmark">
		<?php echo get_featured_image($post_id=NULL, $size, 'wp-preload-image', $title); ?>
		</a>
		</div>
		<?php endif; ?>
		<?php if($show_title == true): ?>
		<h1 class="item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; ?>
		<?php if($show_skills == true): ?><?php echo get_the_term_list( get_the_ID(), 'portfolio-category', '<div class="cats meta">', ', ', '</div>' ); ?><?php endif; ?>
		</li>
		<?php endwhile; wp_reset_postdata(); ?>
		</ul>
	</div>
	<?php
	}
}



#
#Related Products
#
if ( !function_exists( 'theme_related_product' ) )
{
	function theme_related_product($taxonomy, $currency, $posts_per_page) 
	{
	?>
	<div class="related-product-lists post-slide-list post-carousel">
		<h3 class="title"><?php echo __('Related Products', 'TR'); ?></h3>
		<ul class="clearfix">
		<?php
			$related_posts = get_posts_related_by_taxonomy($taxonomy, $posts_per_page);
			while ($related_posts->have_posts()) : $related_posts->the_post();	

			$title = get_the_title();
			$product_price = get_meta_option('product_price');
			$size = 'product-column';
		?>
		<li>
		<?php if(has_post_thumbnail()) : ?>
		<div class="post-thumb post-thumb-hover post-thumb-preload">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="loader-icon" rel="bookmark">
		<?php echo get_featured_image($post_id=NULL, $size, 'wp-preload-image', $title); ?>
		</a>
		</div>
		<?php endif; ?>
		<h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php if($product_price) : ?><div class="price meta"><span><?php echo price_currency_symbol($currency); ?></span><?php echo $product_price; ?></div><?php endif; ?>
		</li>
		<?php endwhile; wp_reset_postdata(); ?>
		</ul>
	</div>
	<?php
	}
}



#
#Get related posts by taxonomy
#
function get_posts_related_by_taxonomy($taxonomy, $posts_per_page, $args=array())
{
	global $post;
	$post_id = $post->ID;
	$query = new WP_Query();
	$terms = wp_get_object_terms($post_id, $taxonomy);
	if (count($terms)) 
	{
		// Assumes only one term for per post in this taxonomy
		$post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
		$post = get_post($post_id);
		$args = wp_parse_args($args,array(
		  'post_type' => $post->post_type, 
		  'post__not_in' => array($post_id),
		  'taxonomy' => $taxonomy,
		  'term' => $terms[0]->slug,
		  'exclude' => $post,
		  'posts_per_page' => $posts_per_page
		));

		$query = new WP_Query($args);
	}
	return $query;
}

?>