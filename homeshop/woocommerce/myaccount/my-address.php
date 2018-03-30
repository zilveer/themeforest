<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();
$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Address', 'homeshop' ) );

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing Address', 'homeshop' ),
		'shipping' => __( 'Shipping Address', 'homeshop' )
	), $customer_id );
} else {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' =>  __( 'Billing Address', 'homeshop' )
	), $customer_id );
}

$oldcol = 1;
$col    = 1;
?>


	<div class="row">
							
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading">
				<h4><?php echo $page_title; ?></h4>
			</div>

			<div class="page-content">

				<p class="myaccount_address">
					<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'homeshop' ) ); ?>
				</p>
				
			</div>
			
		</div>
		
	</div>
		
		


	<div class="row">
	<?php 
	$num_address = 12;
	if(count($get_addresses) > 1) {
	$num_address = 6;
	}
	
	
	foreach ( $get_addresses as $name => $title ) : ?>

		<div class="col-lg-<?php echo $num_address; ?> col-md-<?php echo $num_address; ?> col-sm-<?php echo $num_address; ?> woocommerce-Address">
                        	
			<div class="woocommerce-Address-title carousel-heading">
				<h4><?php echo $title; ?></h4>
				
			</div>
		
			<div class="page-content">	
			
			<address>
				<?php
				$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
					'first_name'  => get_user_meta( $customer_id, $name . '_first_name', true ),
					'last_name'   => get_user_meta( $customer_id, $name . '_last_name', true ),
					'company'     => get_user_meta( $customer_id, $name . '_company', true ),
					'address_1'   => get_user_meta( $customer_id, $name . '_address_1', true ),
					'address_2'   => get_user_meta( $customer_id, $name . '_address_2', true ),
					'city'        => get_user_meta( $customer_id, $name . '_city', true ),
					'state'       => get_user_meta( $customer_id, $name . '_state', true ),
					'postcode'    => get_user_meta( $customer_id, $name . '_postcode', true ),
					'country'     => get_user_meta( $customer_id, $name . '_country', true )
				), $customer_id, $name );

				$formatted_address = WC()->countries->get_formatted_address( $address );

				if ( ! $formatted_address )
					_e( 'You have not set up this type of address yet.', 'homeshop' );
				else
					echo $formatted_address;
			?>
			</address>
			<br>
			
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="button "><?php _e( 'Edit', 'homeshop' ); ?></a>
				
			</div>
			
		</div>	
			

	<?php endforeach; ?>

	</div>



	