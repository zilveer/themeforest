<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$page_title = ( $load_address === 'billing' ) ? esc_html__( 'Billing Address', 'crazyblog' ) : esc_html__( 'Shipping Address', 'crazyblog' );
crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-select2' ) );
wc_print_notices();

if ( !$load_address ) :
	wc_get_template( 'myaccount/my-address.php' );
else :
	?>
	<form method="post" class="billing-sec">
		<h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3>
		<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>
		<?php foreach ( $address as $key => $field ) : ?>
			<?php woocommerce_form_field( $key, $field, !empty( $_POST[$key] ) ? wc_clean( $_POST[$key] ) : $field['value']  ); ?>
		<?php endforeach; ?>
		<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
		<p>
			<input type="submit" class="button dark-btns" name="save_address" value="<?php esc_attr_e( 'Save Address', 'crazyblog' ); ?>" />
			<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
			<input type="hidden" name="action" value="edit_address" />
		</p>
	</form>
	<?php
	$custom_script = 'jQuery(document).ready(function ($) {
			$("#billing_country, #shipping_country").select2();
		});';
	wp_add_inline_script( 'crazyblog_select2', $custom_script );
endif;

