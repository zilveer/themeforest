<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

	<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
		<?php 
			$icon = '';
			switch($endpoint) {
				case 'orders':
					$icon = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="account_icon" x="0" y="0" width="92" height="108" viewBox="0 0 92 108" enable-background="new 0 0 92 107.997" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M92 36.7L74.5 2.2c0-1.2-1-2.2-2.2-2.2h-19.4l0 0L39.4 0H19.7c-1.2 0-2.2 1-2.2 2.2L0 36.7c0 0.3 0.1 0.6 0.2 0.9C0.1 38 0 38.4 0 38.9v64.8c0 2.4 2 4.3 4.4 4.3h83.2c2.4 0 4.4-1.9 4.4-4.3V38.9c0-0.4-0.1-0.9-0.2-1.3C91.9 37.3 92 37 92 36.7zM71.2 4.3l15.3 30.2H57v0h-0.5L53.3 4.3H71.2zM43.8 4.3h4.4l4.4 30.2H39.4L43.8 4.3zM39.4 38.9h13.1v30.2H39.4V38.9zM20.8 4.3h18.1l-3.4 30.2h-0.5v0H5.5L20.8 4.3zM87.6 103.7H4.4V38.9h30.7v34.6h21.9V38.9h30.7V103.7zM13.1 95h13.1v-4.3H13.1V95zM30.7 95h8.8v-4.3h-8.8V95z"/></svg>';
					break;
				case 'edit-address':
					$icon = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="account_icon" x="0" y="0" width="92" height="93.7" viewBox="0 0 92 93.7" enable-background="new 0 0 92 93.667" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 24.7v4c0 0 3.9-4 8.6-4 6.9 0 15.4 4 15.4 4v-4c0 0-8.5-4-15.3-4C16 20.7 12 24.7 12 24.7zM12 64.7v4c0 0 3.9-4 8.6-4 6.9 0 15.4 4 15.4 4v-4c0 0-8.5-4-15.3-4C16 60.7 12 64.7 12 64.7zM12 44.7v4c0 0 3.9-4 8.6-4 6.9 0 15.4 4 15.4 4v-4c0 0-8.5-4-15.3-4C16 40.7 12 44.7 12 44.7zM56 44.7v4c0 0 8.5-4 15.4-4 4.7 0 8.6 4 8.6 4v-4c0 0-4-4-8.7-4C64.5 40.7 56 44.7 56 44.7zM67.7 0.7C56.4 0.7 46 6.8 46 6.8S35.6 0.7 24.3 0.7C11.2 0.7 0 6.8 0 6.8v85.9c0 0 11.6-6.1 24.9-6.1C35.9 86.6 46 92.7 46 92.7s10.1-6.1 21.1-6.1C80.4 86.6 92 92.7 92 92.7V6.8C92 6.8 80.8 0.7 67.7 0.7zM44 87.2c-4.3-2-11.4-4.6-19.1-4.6 -8.3 0-15.9 2.2-20.9 4.1V9.3C7.6 7.7 15.6 4.7 24.3 4.7c10 0 19.5 5.5 19.6 5.6l0.1 0V87.2zM88 86.6c-5-1.9-12.6-4.1-20.9-4.1 -7.7 0-14.8 2.6-19.1 4.6V10.3l0.1 0C48.1 10.2 57.7 4.7 67.7 4.7 76.4 4.7 84.4 7.7 88 9.3V86.6zM56 28.7c0 0 8.5-4 15.4-4 4.7 0 8.6 4 8.6 4v-4c0 0-4-4-8.7-4 -6.9 0-15.3 4-15.3 4V28.7zM56 64.7v4c0 0 8.5-4 15.4-4 4.7 0 8.6 4 8.6 4v-4c0 0-4-4-8.7-4C64.5 60.7 56 64.7 56 64.7z"/></svg>';
					break;
				case 'edit-account':
					$icon = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="account_icon" x="0" y="0" width="101" height="97.9" viewBox="0 0 101 97.9" enable-background="new 0 0 100.965 97.921" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M60.5 39.7l2-3.6 10.1-17.7L41.1 0 29 21.2l0 0.1L2.7 67.5h0l-1.3 2.3L0 72.1l6.3 25.9 25.3-7.4L60.5 39.7 60.5 39.7zM9.2 92.9L4.4 73.2l23.9 14L9.2 92.9zM30.7 83.8L6.2 69.5l26.3-46.2 24.5 14.3L30.7 83.8zM34.5 19.8l8.1-14.2L67.1 19.9l-8.1 14.2L34.5 19.8zM44.4 93.8v4.1h56.6v-4.1H44.4z"/></svg>';
					break;
				case 'customer-logout':
					$icon = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="account_icon" x="0" y="0" width="98" height="98" viewBox="0 0 98 98" enable-background="new 0 0 98 98" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M49 0C21.9 0 0 21.9 0 49s21.9 49 49 49c27.1 0 49-21.9 49-49S76.1 0 49 0zM49 93.7C24.3 93.7 4.3 73.7 4.3 49 4.3 24.3 24.3 4.3 49 4.3c24.7 0 44.7 20 44.7 44.7C93.7 73.7 73.7 93.7 49 93.7zM65.6 32.4c-0.8-0.8-2.2-0.8-3 0L49 46 35.4 32.4c-0.8-0.8-2.2-0.8-3 0 -0.8 0.8-0.8 2.2 0 3l13.6 13.6L32.4 62.6c-0.8 0.8-0.8 2.2 0 3 0.8 0.8 2.2 0.8 3 0l13.6-13.6 13.6 13.6c0.8 0.8 2.2 0.8 3 0 0.8-0.8 0.8-2.2 0-3L52 49 65.6 35.5C66.4 34.6 66.4 33.3 65.6 32.4z"/></svg>';
					break;
				case 'payment-methods':
					$icon = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="account_icon" x="0" y="0" width="100" height="64" viewBox="0 0 100 64" enable-background="new 0 0 100 64" xml:space="preserve"><path d="M94.3 0H5.7C2.5 0 0 2.4 0 5.6v52.7C0 61.6 2.5 64 5.7 64h88.7c3.2 0 5.7-2.4 5.7-5.6V5.6C100 2.4 97.5 0 94.3 0zM96 58c0 1.1-0.9 2-2 2H6c-1.1 0-2-0.9-2-2V6c0-1.1 0.9-2 2-2h88c1.1 0 2 0.9 2 2V58zM28 32H15v4h13V32zM47 36v-4H34L34 36H47zM53 36h13l0-4H53V36zM72 32v4h13l-0.1-4H72zM15 45h47v-4H15V45z"/></svg>';
					break;
				case 'downloads':
					$icon = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="account_icon" x="0" y="0" width="71.9" height="82" viewBox="270.5 463.5 71.9 82" enable-background="new 270.503 463.5 71.906 82.004" xml:space="preserve"><path d="M323.5 510.5l-3.4-3.4 -10.9 11V463.5h-4.8v54.6l-10.9-11 -3.4 3.4 16.7 16.7L323.5 510.5zM342.5 526.4c0-0.4 0-0.8-0.1-1.2 -0.2-1-1.2-1.7-2.1-1.7 -1.1 0-2 0.8-2.1 1.9 -0.1 0.4 0 0.8 0 1.2 0 4.2 0 8.4 0 12.6v1.9h-63.2v-1.7c0-4.2 0-8.4 0-12.6 0-0.5 0-0.9 0-1.4 -0.1-1.1-1.1-1.9-2.1-1.9 -1 0-2 0.8-2.2 1.8 0 0.2 0 0.4 0 0.6 0 5.7 0 11.4 0 17.1 0 0.2 0 0.3 0 0.5 0.1 1.1 0.9 1.9 2 2 0.5 0.1 1 0 1.5 0h64.8c0.2 0 0.4 0 0.6 0 2.3 0 2.9-0.7 2.9-3C342.5 537.2 342.5 531.8 342.5 526.4z"/></svg>';
					break;
				case 'subscriptions':
					$icon = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="account_icon" x="0" y="0" width="99" height="67" viewBox="256.5 470.5 99 67" enable-background="new 256.5 470.5 98.999 67" xml:space="preserve"><path d="M350.1 470.5h-88.2c-3 0-5.4 2.4-5.4 5.4v56.2c0 3 2.4 5.4 5.4 5.4h88.2c3 0 5.4-2.4 5.4-5.4v-56.2C355.5 472.9 353.1 470.5 350.1 470.5zM306.4 516.9c-1 1-1.7 1-2.7 0l-40.3-42.3h85L306.4 516.9zM288.7 507.3l-28.1 24.2v-53.7L288.7 507.3zM291.6 510.3l9.1 9.6c1.3 1.3 2.8 2 4.3 2s3-0.7 4.3-2l10.7-10.8c0.1 0.2 0.2 0.4 0.4 0.5l26.8 23.7h-82.3L291.6 510.3zM350.8 530.8l-27.6-24.3c-0.1-0.1-0.2-0.1-0.4-0.2l28.5-28.6v54C351.2 531.4 351 531.1 350.8 530.8z"/></svg>';
					break;
			}
		?>
		<div class="small-12 medium-6 large-4 columns">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="account-icon-box <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<div>
					<?php echo $icon; ?><br>
					<?php echo esc_html( $label ); ?>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
<?php do_action( 'woocommerce_after_account_navigation' ); ?>
