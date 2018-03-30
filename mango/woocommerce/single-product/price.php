<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product,$mango_settings;
if ( $mango_settings[ 'mango_show_price' ] ) 
{
	?>
	<div class="product-price-container" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		
		<p class="price"><?php echo $product->get_price_html(); ?></p>

		<meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
		<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
		<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

	</div>
	<?php 
} 
 
 if ( $mango_settings[ 'mango_show_add_to_cart_button' ] )
{}else{
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}
	?>

<?php if($mango_settings[ 'mango_show_add_to_cart_button' ]==0){ ?>
<div class="send-enquiry">
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne2">
				<h4 class="panel-title enq">
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
						<i class="fa fa-envelope"></i> <?php _e('Send Enquiry','mango');?>
						<span class="panel-icon"></span>
					</a>
				</h4>
			</div><!-- End .panel-heading -->
			<div id="collapseOne2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne2">
				<div class="panel-body">
				<?php echo do_shortcode($mango_settings['mango_send_enquiry']); ?>
				</div><!-- End .panel-body -->
			</div><!-- End .panel-collapse -->
		</div><!-- End .panel -->
	</div><!-- End .panel-group -->
 </div>
<?php } ?>