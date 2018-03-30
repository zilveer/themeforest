<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

// Get tabs
ob_start();

do_action('woocommerce_product_tabs');

$tabs = trim( ob_get_clean() );

if ( ! empty( $tabs ) ) : ?>
	
    <div class="grid_12">
        <div class="woocommerce_tabs">
            <div class="grid_4 alpha omega">
                <ul class="tabs">
                    <?php echo $tabs; ?>
                </ul>
            </div>
            <div class="grid_8 alpha omega">
                <?php do_action('woocommerce_product_tab_panels'); ?>
            </div>
            <div class="clr"></div>
        </div>
    </div>

<?php endif; ?>