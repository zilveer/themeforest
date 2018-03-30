<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
$g5plus_woocommerce_loop = G5Plus_Global::get_woocommerce_loop();
$archive_product_layout =  isset($g5plus_woocommerce_loop['layout']) ? $g5plus_woocommerce_loop['layout'] : '';
?>
<?php if ($archive_product_layout == 'slider') : ?>
	</div>
<?php endif; ?>
</div>
<?php g5plus_woocommerce_reset_loop(); ?>