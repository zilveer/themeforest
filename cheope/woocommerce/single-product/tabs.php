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
	<?php
		if(yit_get_sidebar_layout() != 'sidebar-no') :
			$span_class= "span".  (yit_get_option( 'shop-sidebar-width' )  != '2' ? 9 : 10);
		else :
			$span_class= "span12";
		endif
	?>
	<div class="woocommerce-tabs <?php echo apply_filters( 'yit_product_tabs_span_class', $span_class ) ?>">
		<ul class="tabs">
			<?php echo $tabs; ?>
		</ul>
		<?php do_action('woocommerce_product_tab_panels'); ?>
	</div>
<?php endif; ?>