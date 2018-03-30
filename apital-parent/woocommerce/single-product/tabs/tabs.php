<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
    <div class="w-tabs w-col w-col-12" data-duration-in="300" data-duration-out="100">
        <div class="w-tab-menu">
            <?php foreach ( $tabs as $key => $tab ) :?>
                <a class="w-tab-link w--current w-clearfix w-inline-block tab" data-w-tab="Tab <?php echo esc_attr($key) ?>">
                    <div class="tab-txt"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></div>
                </a>
                <?php endforeach;?>
        </div>
        <div class="w-tab-content">
            <?php foreach ( $tabs as $key => $tab ):?>
                <div class="w-tab-pane w--tab-active" data-w-tab="Tab <?php echo esc_attr($key) ?>">
                    <div class="space"></div>
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>
                <?php endforeach;?>
        </div>
    </div>
<?php endif; ?>
