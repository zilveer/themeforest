<?php
/**
 * Single Product Tabs
 */

// Get tabs
ob_start();

do_action('woocommerce_product_tabs'); 

$tabs = trim( ob_get_clean() );

if ( ! empty( $tabs ) ) : ?>
	<div class="tabs">
		<ul class="tabNavigation clearfix">
			<?php echo $tabs; ?>
		</ul>
		<?php do_action('woocommerce_product_tab_panels'); ?>
	</div>
<?php endif; ?>