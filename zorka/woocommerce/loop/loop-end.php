<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $zorka_product_layout;
?>
<?php if (isset($zorka_product_layout) && ($zorka_product_layout  == 'slider')) : ?>
    </div>
<?php endif; ?>
</div>
<?php zorka_woocommerce_reset_loop(); ?>

