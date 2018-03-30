<?php
/**
 * The template for displaying the feedback form for vendor ratings
 *
 * Override this template by copying it to yourtheme/wc-vendors/front/ratings
 *
 * @package    WCVendors_Pro
 * @version    1.2.5
 */
?>

<?php  wc_print_notices(); ?>

<?php if ( isset( $_GET[ 'wcv_order_id' ] ) ) : ?>

<h2><?php _e('Rate your experience', 'plumtree'); ?></h2>

<p>
<?php printf( __( 'Order #<mark class="order-number">%s</mark> was placed on <mark class="order-date">%s</mark> and is currently <mark class="order-status">%s</mark>.', 'plumtree' ), $order->get_order_number(), date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ), wc_get_order_status_name( $order->get_status() ) ); ?>
</p>

<form method="post" name="wcv_feedback" class="wcv-form">

<?php

$fn = 0;

foreach ( $products as $product ) {
	$product_id = $product['product_id'];
	$product_feedback = wp_filter_object_list( $feedback, array( 'product_id' => $product_id ) );
	if ( !empty( $product_feedback ) ) $product_feedback = reset( $product_feedback );
	$vendor_id = WCV_Vendors::get_vendor_from_product( $product_id );
	$shop_name = WCV_Vendors::is_vendor( $vendor_id )
			? sprintf( '<a href="%s">%s</a>', WCV_Vendors::get_vendor_shop_page( $vendor_id), WCV_Vendors::get_vendor_shop_name( $vendor_id ) )
			: get_bloginfo( 'name' );

	$comments = $product_feedback ? $product_feedback->comments : '';
	$rating_title = $product_feedback ? $product_feedback->rating_title : '';

	// Does the product exist ?
	if ( is_string( get_post_status( $product['product_id'] ) ) ) {
		echo '<a href="' . get_permalink( $product_id ) . '">' . $product['name'] . '</a>'. __( ' from ', 'plumtree') .$shop_name.'</br>';
	} else {
		echo $product['name'] . __( ' from ', 'plumtree') .$shop_name.'</br>';
	}

	echo '<div class="stars-container">';
	for ($i=5; $i > 0; $i--) {
		$checked = $product_feedback ? checked( $product_feedback->rating, $i, false ) : '';
		echo '<input type="radio" id="wcv-star-rating-'.$fn.'-'.$i.'" name="wcv-feedback['.$fn.'][star-rating]" value="' . $i .'" '.$checked.'>';
		echo '<label for="wcv-star-rating-'.$fn.'-'.$i.'" class="wcv_star-rating">';
		/*for ($ii = 1; $ii<=$i; $ii++) { echo "<i class='fa fa-star'></i>"; } */
		echo '</label>';
	} echo '</div>'; ?>
	<p></p>
	<p>
		<input type="text" name="wcv-feedback[<?php echo $fn; ?>][rating_title]" style="width:60%" value="<?php echo $rating_title; ?>" placeholder="<?php _e( 'Title', 'plumtree'); ?>" />
	</p>
	<p>
		<textarea name="wcv-feedback[<?php echo $fn; ?>][comments]" style="width:60%" placeholder="<?php _e( '(e.g. delivery experience, item as described, quality of customer service)', 'plumtree'); ?>"><?php echo $comments; ?></textarea>
	</p>
	<input type="hidden" name="wcv-feedback[<?php echo $fn; ?>][vendor_id]" value="<?php echo $vendor_id; ?>">
	<input type="hidden" name="wcv-feedback[<?php echo $fn; ?>][product_id]" value="<?php echo $product_id; ?>">
	<input type="hidden" name="wcv-feedback[<?php echo $fn; ?>][customer_id]" value="<?php echo get_current_user_id(); ?>">
	<?php if ($product_feedback) : ?>
	<input type="hidden" name="wcv-feedback[<?php echo $fn; ?>][feedback_id]" value="<?php echo $product_feedback->id; ?>">
	<?php endif; ?>
	<br/>
	<br/>
<?php
	$fn++;
} ?>

<p><input type="submit" value="<?php _e('Submit Feedback', 'plumtree'); ?>"></p>
<input type="hidden" name="wcv-order_id" value="<?php echo $order->get_order_number(); ?>">
<?php  wp_nonce_field( 'wcv-submit_feedback', '_wcv-submit_feedback'); ?>
<input type="hidden" name="action" value="post">

</form>

<?php else : ?>
<?php endif; ?>
