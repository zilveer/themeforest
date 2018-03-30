<?php
/**
 * Single Product Tabs
 */
?>
<div id="product-tabs" class="woocommerce_tabs">
	<ul class="tabs">
		<?php do_action('woocommerce_product_tabs'); ?>
	</ul>
	<div class="containers">
	    <?php do_action('woocommerce_product_tab_panels'); ?>
	</div>
</div>