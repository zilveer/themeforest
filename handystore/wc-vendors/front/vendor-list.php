<?php
/*
*	Template Variables available
*   $shop_name : pv_shop_name
*   $shop_description : pv_shop_description (completely sanitized)
*   $shop_link : the vendor shop link
*   $vendor_id  : current vendor id for customization
*/

global $wpdb;
/* Get Logo if exists */
$logo_src = get_user_meta( $vendor_id, 'pv_logo_image', true );

if ( $logo_src && $logo_src != '') {
	$id = $wpdb->get_var( $wpdb->prepare(
			"SELECT ID FROM $wpdb->posts WHERE BINARY guid = %s",
			$logo_src
	) );
	$store_icon = wp_get_attachment_image( $id, 'full' );
}

/* Get Seller Info */
$seller_info = get_user_meta( $vendor_id, 'pv_seller_info', true );

/* Get number of products published by vendor */
$args = array(
	'post_type' => 'product',
	'post_status' => 'publish',
	'author' => $vendor_id,
	'posts_per_page' => -1 );
$vendor_products = new WP_Query( $args );
$vendor_products_count = $vendor_products->found_posts;
wp_reset_postdata();
?>

<li class="single-vendor">
	<div class="inner-vendor-content row">

		<div class="vendor-img-wrapper col-xs-12 col-sm-6 col-md-3">
			<?php if ($store_icon) { echo $store_icon; }
						else { echo get_avatar($vendor_id, 200); } ?>
		</div>

		<div class="vendor-description-wrapper col-xs-12 col-sm-6 col-md-9">
			<a href="<?php echo esc_url($shop_link); ?>">
				<h3><?php echo esc_attr($shop_name); ?></h3>
			</a>
			<div class="short-description">
				<?php echo $seller_info; ?>
			</div>
		</div>

		<div class="additional-info col-xs-12">
			<span class="total-products"><?php echo esc_html__('Products in total: ', 'plumtree').esc_attr($vendor_products_count); ?></span>
			<a class="btn btn-default rounded link-to-vendor" href="<?php echo esc_url($shop_link); ?>" rel="nofollow"><?php echo esc_html__('Visit Vendor Store', 'plumtree'); ?></a>
		</div>

	</div>
</li>
