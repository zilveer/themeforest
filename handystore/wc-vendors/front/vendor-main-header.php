<?php
/**
 *  Vendor Main Header - Hooked into archive-product page
*
 *  THIS FILE WILL LOAD ON VENDORS STORE URLs (such as yourdomain.com/vendors/bobs-store/)
 *
 * @author WCVendors
 * @package WCVendors
 * @version 1.3.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
*		Template Variables available
*   $vendor : 			For pulling additional user details from vendor account.  This is an array.
*   $vendor_id  : 		current vendor user id number
*   $shop_name : 		Store/Shop Name (From Vendor Dashboard Shop Settings)
*   $shop_description : Shop Description (completely sanitized) (From Vendor Dashboard Shop Settings)
*   $seller_info : 		Seller Info(From Vendor Dashboard Shop Settings)
*		$vendor_email :		Vendors email address
*		$vendor_login : 	Vendors user_login name
*		$vendor_shop_link : URL to the vendors store
*/

/* Get Variables */
global $wpdb;

$logo_src = get_user_meta( $vendor_id, 'pv_logo_image', true );
$logo_pos = get_user_meta( $vendor_id, 'pv_logo_position', true );
$featured_carousel = get_user_meta( $vendor_id, 'pv_featured_carousel', true );

if ( $logo_src && $logo_src != '') {
	$id = $wpdb->get_var( $wpdb->prepare(
			"SELECT ID FROM $wpdb->posts WHERE BINARY guid = %s",
			$logo_src
	) );
	$store_icon = wp_get_attachment_image( $id, 'pt-vendor-main-logo' );
}

switch ($logo_pos) {
	case 'left':
		$logo_class = ' col-lg-4 col-md-4 col-sm-12';
		$heading_class = ' col-lg-8 col-md-8 col-sm-12';
	break;
	case 'center':
		$logo_class = ' col-lg-12 col-md-12 col-sm-12 center-pos';
		$heading_class = ' col-lg-12 col-md-12 col-sm-12 center-pos';
	break;
	case 'right':
		$logo_class = ' col-md-4 col-lg-4 col-sm-12 col-lg-push-8 col-md-push-8 right-pos';
		$heading_class = ' col-lg-8 col-md-8 col-sm-12 col-lg-pull-4 col-md-pull-4';
	break;
}

if ($logo_src == '') {
	$heading_class = ' col-lg-12 col-md-12 col-sm-12 center-pos';
}

if ( pt_show_layout() == 'layout-one-col' ) {
	$slides = 4;
} else {
	$slides = 3;
}

$meta_query   = WC()->query->get_meta_query();
$meta_query[] = array(
	'key'   => '_featured',
	'value' => 'yes'
);

$args = array(
	'post_type'	=> 'product',
	'post_status'	=> 'publish',
	'author_name'	=> $vendor->user_nicename,
	'ignore_sticky_posts'	=> 1,
	'posts_per_page'	=> -1,
	'orderby'	=> 'date',
	'order'	=> 'desc',
	'meta_query' => $meta_query,
);

$products = new WP_Query( $args ); ?>

<div class="vendors-shop-description">

	<div class="row">
		<?php if ( $logo_src && $logo_src!='') : ?>
			<div class="logo-wrap<?php echo esc_attr($logo_class);?>">
				<?php echo $store_icon; ?>
			</div>
		<?php endif; ?>
		<div class="vendors-title-wrap<?php echo esc_attr($heading_class); ?>">
			<h1><?php echo esc_attr($shop_name); ?></h1>
		</div>
	</div>

	<div class="entry-vendor-content"><?php echo $shop_description; ?></div>

	<?php if ( $featured_carousel == 'on' && $products->have_posts() ) : ?>
		<div class="pt-woo-shortcode with-slider"
			 data-owl="container"
			 data-owl-slides="<?php echo esc_attr($slides); ?>"
			 data-owl-type="woo_shortcode"
			 data-owl-navi="custom"
		>
			<div class="title-wrapper">
				<h3><?php _e('Special Offers', 'plumtree')?></h3>
				<div class="slider-navi">
					<span class="prev"></span>
					<span class="next"></span>
				</div>
			</div>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php wp_reset_postdata(); ?>
		</div>
	<?php endif; ?>

</div>
