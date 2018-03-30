<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$myaccount_ad_link = ot_get_option('myaccount-ad-link');
$myaccount_ad = ot_get_option('myaccount-advertisement', 'off');
?>
<div id="my-account-main" class="woocommerce-MyAccount-content">
	<div class="account_wrapper">
		<nav class="woocommerce-MyAccount-navigation row expanded no-row-padding">
			<?php if ($myaccount_ad === 'on') { ?>
			<div class="small-12 medium-6 large-4 columns">
				<a href="<?php echo esc_url( $myaccount_ad_link ); ?>" class="account-icon-box image">
				</a>
			</div>
			<?php } ?>
			<?php
				/**
				 * My Account navigation.
				 *
				 * @since 2.6.0
				 */
				 do_action( 'woocommerce_account_navigation' ); 
			?>
		</nav>
	</div>
</div>