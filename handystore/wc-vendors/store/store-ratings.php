<?php
/**
 * Display the vendor store ratings
 *
 * Override this template by copying it to yourtheme/wc-vendors/store
 *
 * @package    WCVendors_Pro
 * @version    1.2.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$vendor_shop 		= urldecode( get_query_var( 'vendor_shop' ) );
$vendor_id   		= WCV_Vendors::get_vendor_id( $vendor_shop );
$vendor_feedback 	= WCVendors_Pro_Ratings_Controller::get_vendor_feedback( $vendor_id );
$vendor_shop_url	= WCV_Vendors::get_vendor_shop_page( $vendor_id );

get_header( 'shop' ); ?>

	<?php do_action( 'woocommerce_before_main_content' ); ?>

	<h1 class="page-title"><?php _e( 'Customer Ratings', 'plumtree' ); ?></h1>

	<?php if ( $vendor_feedback ) {

		foreach ( $vendor_feedback as $vf ) {

			$customer 		= get_userdata( $vf->customer_id );
			$rating 		= $vf->rating;
			$rating_title 	= $vf->rating_title;
			$comment 		= $vf->comments;
			$post_date		= date_i18n( get_option( 'date_format' ), strtotime( $vf->postdate ) );
			$customer_name 	= ucfirst( $customer->display_name );
			$product_link	= get_permalink( $vf->product_id );
			$product_title	= get_the_title( $vf->product_id );

			// This outputs the star rating
			$stars = '';
			for ($i = 1; $i<=stripslashes( $rating ); $i++) { $stars .= "<i class='fa fa-star'></i>"; }
			for ($i = stripslashes( $rating ); $i<5; $i++) { $stars .=  "<i class='fa fa-star-o'></i>"; }
			?>

			<div class="single-rating">
				<p>
					<?php _e('Product: ', 'plumtree'); ?>
					<a href="<?php echo $product_link; ?>" target="_blank"><?php echo $product_title; ?></a>
				</p>
				<p>
					<span><?php _e( 'Posted on ', 'plumtree'); echo $post_date; ?></span>
					<?php _e( ' by ', 'plumtree'); echo $customer_name; ?>
				</p>
				<div class="review-container">
					<div class="value"><?php echo $stars; ?></div>
					<?php if ( ! empty( $rating_title ) ) { echo '<h6>'.$rating_title.'</h6><br />'; } ?>
					<p><?php echo $comment; ?></p>
				</div>
			</div>

		<?php }
	} else {  echo __( 'No ratings have been submitted for this vendor yet.', 'plumtree' ); }  ?>

	<a class="button" href="<?php echo $vendor_shop_url; ?>"><?php _e( 'Return to store', 'plumtree' ); ?></a>

	<?php do_action( 'woocommerce_after_main_content' ); ?>

	<?php do_action( 'woocommerce_sidebar' ); ?>

<?php get_footer( 'shop' ); ?>
