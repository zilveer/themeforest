<?php
/**
 * Edit address form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$page_title = ( $load_address === 'billing' ) ? __( 'Billing Address', 'woocommerce' ) : __( 'Shipping Address', 'woocommerce' );
do_action( 'woocommerce_before_edit_account_address_form' ); 
extract(etheme_account_sidebar());

?>

<div class="row-fluid">
	<?php if ($sidebar): ?>
		<div class="span3">
			<?php 

				do_action('etheme_before_account_sidebar');

				if ( has_nav_menu( 'account-menu' ) ) : ?>
					<?php wp_nav_menu(array(
						'theme_location' => 'account-menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'container_class' => 'widget_nav_menu',
						'link_after' => '',
						'depth' => 4,
						'fallback_cb' => false
					)); ?>
				<?php else: ?>
					<br>
                    <h4 class="a-center install-menu-info">Set your account menu in <em>Apperance &gt; Menus</em></h4>
				<?php endif;

			?>
		</div>
	<?php endif ?>
	<div class="span<?php echo $span; ?>">
		<?php wc_print_notices(); ?>

		<?php if ( ! $load_address ) : ?>
		
			<?php wc_get_template( 'myaccount/my-address.php' ); ?>
		
		<?php else : ?>
		
			<form method="post">
		
				<h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3>
		
				<?php foreach ( $address as $key => $field ) : ?>
		
					<?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>
		
				<?php endforeach; ?>
					<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>
				<p>
					<input type="submit" class="button" name="save_address" value="<?php _e( 'Save Address', ETHEME_DOMAIN ); ?>" />
					<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
					<input type="hidden" name="action" value="edit_address" />
				</p>
		
			</form>
		
		<?php endif; ?>
	</div>
</div>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>