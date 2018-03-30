<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="qodef-accordion-holder qodef-accordion qodef-boxed clearfix woocommerce-accordions wc-tabs-wrapper">
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<h6 class="clearfix qodef-title-holder">
				<span class="qodef-tab-title">
					<span class="qodef-tab-title-inner">
						<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
					</span>
				</span>
			</h6>
			<div class="qodef-accordion-content">
				<div class="qodef-accordion-content-inner">
					<?php call_user_func( $tab['callback'], $key, $tab ); ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>