<?php global $product;

if (isset($r->post->ID)) {
	$r_post_id = $r->post->ID;
} else {
	$r_post_id = null;
}

$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail( $r_post_id, array(120, 120) ) : woocommerce_placeholder_img( 'shop_thumbnail' );

if (function_exists('dfd_aq_resize')) {
	$thumbnail_src = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id($r_post_id) ) : woocommerce_placeholder_img_src();
	$thumbnail_url = dfd_aq_resize($thumbnail_src, 80, 80, true, true);
	
	if(!$thumbnail_url) {
		$thumbnail_url = $thumbnail_src;
	}

	$thumbnail_url = '<img src="'.esc_url($thumbnail_url).'" alt="" />';
}

?>
<li>
	<div class="product_thumbnail"><?php echo $thumbnail_url; ?></div>
	<div class="product_summary">
		<a href="<?php the_permalink() ?>" title="<?php echo esc_attr($product->get_title()); ?>"><?php echo esc_html($product->get_title()); ?></a>
		<?php echo $product->get_price_html() ?>
		<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
	</div>
</li>