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
$tabs           = apply_filters( 'woocommerce_product_tabs', array() );
$enable_builder = get_post_meta( get_the_ID(), 'enable_builder', true );
if ( ! empty( $tabs ) ) : ?>
    <div class="site-content content-width wrapper">
	<div class="pixcode  pixcode--tabs  single-product-tabs content-builder-<?php echo ( empty( $enable_builder ) ) ? 'off' : $enable_builder; ?>">
		<ul class="tabs__nav  product__tabs">

			<?php
			$first = true;
			foreach ( $tabs as $key => $tab ) :
				if ( $first ) {
					$classname = " current";
					$first     = false;
				} else {
					$classname = "";
				} ?>

				<li>
					<a class="<?php echo $key . "_tab" . $classname ?>" data-toggle="tab"
					   href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php endforeach; ?>

		</ul>
		<div class="pixcode--tabs__content  tabs__content">
			<?php
			$first = true;
			foreach ( $tabs as $key => $tab ) :
				if ( $first ) {
					$classname = "";
					$first     = false;
				} else {
					$classname = " hide";
				} ?>

				<div class="tabs__pane tabs__pane--<?php echo $key ?> <?php echo $classname ?>" id="tab-<?php echo $key ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ) ?>
				</div>

			<?php endforeach; ?>
		</div>
	</div>
	</div>

<?php endif; ?>