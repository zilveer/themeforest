<?php
/**
 * Product loop
 * @package by Theme Record
 * @auther: MattMao
 */

global $tr_config;

$currency = $tr_config['currency'];
?>

<div class="product-list">
<ul class="clearfix">
<?php 
	while (have_posts()) : the_post();
	$title = get_the_title();
	$product_price = get_meta_option('product_price');
?>
	<li class="col-4-1">
	<?php if(has_post_thumbnail()) : ?>
	<div class="post-thumb post-thumb-hover post-thumb-preload">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="loader-icon">
	<?php echo get_featured_image($post_id=NULL, 'product-column', 'wp-preload-image', $title); ?>
	</a>
	</div>
	<?php endif; ?>
	<h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<?php if($product_price) : ?><div class="price meta"><span><?php echo price_currency_symbol($currency); ?></span><?php echo $product_price; ?></div><?php endif; ?>
	</li>
<?php endwhile; ?>
</ul>
</div>