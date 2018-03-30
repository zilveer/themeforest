<?php
/**
 * Single For Product
 * @package by Theme Record
 * @auther: MattMao
 */
get_header();

global $tr_config;

#Get Meta
$product_price = get_meta_option('product_price');
$product_weight = get_meta_option('product_weight');
$product_dimensions = get_meta_option('product_dimensions');
$product_colour = get_meta_option('product_colour');
$product_size = get_meta_option('product_size');

#Get Options
$enable_comments = $tr_config['enable_product_comments'];
$enable_related_posts = $tr_config['enable_product_related_posts'];
$posts_per_page = $tr_config['product_related_posts_per_page'];
$add_to_cart = $tr_config['add_to_cart_text'];
$shop_cart_page_id = $tr_config['shop_cart_page_id'];
$currency = $tr_config['currency'];
?>

<div id="main" class="fullwidth">

<!--Begin Content-->
<article id="content">
	<?php if (have_posts()) : the_post(); ?>

	<div class="post post-product-single clearfix" id="post-<?php the_ID(); ?>">

		<?php theme_post_gallery('product'); ?>

		<div class="post-meta">
			<h1 class="title"><?php the_title(); ?></h1>
			<div class="product-form clearfix">
			<?php if($product_price) : ?><div class="price meta"><span><?php echo price_currency_symbol($currency); ?></span><?php echo $product_price; ?></div><?php endif; ?>
			<div class="form">
			<form action="<?php echo get_page_link($shop_cart_page_id); ?>" method="post" class="add-form">
			<label><b><?php _e('QTY:', 'TR'); ?></b></label>
			<input type="text" name="product_qty" value="1" />
			<input type="hidden" name="product_id" value="<?php echo get_the_ID(); ?>" />
			<input type="hidden" name="product_action" value="add" />
			<input type="submit" value="<?php echo $add_to_cart; ?>" class="add-to-cart-button button" />
			</form>
			</div>
			</div>
			<!--End Product Form-->
			<div class="product-desc"><?php echo theme_description(300); ?></div> 
		</div>
		<!--End Meta-->

		<div class="clear"></div>

		<div class="post-entry">
			<nav>
			<ul class="tabs clearfix">
				<li><a href="#description" class="tab active"><?php _e('Description', 'TR'); ?></a></li>
				<li><a href="#attributes" class="tab"><?php _e('Additional', 'TR'); ?></a></li>
				<?php if(comments_open() && $enable_comments == true) : ?><li><a href="#reviews" class="tab"><?php _e('Reviews', 'TR'); ?></a></li><?php endif; ?>
			</ul>
			</nav>
			<div class="tabs-content">
				<div id="description" class="tab-description post-format active"><?php the_content(); ?></div>
				<div id="attributes" class="tab-attributes hide">
				<table>
					<?php if($product_weight) : ?>
					<tr><td><b><?php _e('Weight:', 'TR'); ?></b></td><td><?php echo $product_weight; ?></td></tr>
					<?php endif; ?>
					<?php if($product_dimensions) : ?>
					<tr><td><b><?php _e('Dimensions:', 'TR'); ?></b></td><td><?php echo $product_dimensions; ?></td></tr>
					<?php endif; ?>
					<?php if($product_colour) : ?>
					<tr><td><b><?php _e('Colour:', 'TR'); ?></b></td><td><?php echo $product_colour; ?></td></tr>
					<?php endif; ?>
					<?php if($product_size) : ?>
					<tr><td><b><?php _e('Size:', 'TR'); ?></b></td><td><?php echo $product_size; ?></td></tr>
					<?php endif; ?>
				</table>
				</div>
				<?php if(comments_open() && $enable_comments == true) : ?>
				<div id="reviews" class="tab-reviews hide">
				<?php comments_template( '', true ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<!--End Post Entry-->

	</div>
	<!--End Product Single-->

	<?php endif; ?>
</article>
<!--End Content-->

</div>
<!-- #main -->

<?php
	if($enable_related_posts == true) {
		echo '<div class="footer-related-posts">';
		echo '<div class="col-width">';
		theme_related_product('product-category', $currency, $posts_per_page);
		echo '</div>';
		echo '</div>';
	}
?>

<?php get_footer(); ?>