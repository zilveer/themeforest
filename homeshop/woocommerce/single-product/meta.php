<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
$attributes = $product->get_attributes();

?>
<?php do_action( 'woocommerce_product_meta_start' ); ?>
	<table>



		<?php 
		$product_terms = wp_get_object_terms($post->ID, 'product_brand');
		if(!empty($product_terms) && 1>4) { ?>
		
		<tr>
			<td><?php _e( 'Brand', 'homeshop' ) ?></td>
			
			<td>
			
				<?php if(!is_wp_error( $product_terms )){
		
					foreach($product_terms as $term){
					echo '<a href="'.get_term_link($term->slug, 'product_brand').'">'.$term->name.'</a> ';
					}
				} ?>

			</td>

		</tr>	
		
		<?php } ?>
		
		
		
		
		
		
		
		
		
		<?php 	if (  $product->is_purchasable() ) {
		$availability = $product->get_availability();
		if ( $availability['availability'] ) {
		?>
		<tr>
			<td><?php _e( 'Availability', 'homeshop' ); ?></td>
			<?php echo apply_filters( 'woocommerce_stock_html', '<td>' . esc_html( $availability['availability'] ) . '</td>', $availability['availability'] ); ?>
			
		</tr>
		<?php } } ?>
	
	
		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) { ?>
		<tr>
			<td><?php _e( 'Product code', 'homeshop' ); ?></td>
			<td><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'n/a', 'homeshop' ); ?></td>
		</tr>
		<?php } ?>
		
	</table>
	

	
	<?php
	
	if ( $post->post_excerpt ) {
	?>
	<div class="item-description" itemprop="description" style="padding-right: 20px;" >
		<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
	</div>
	<?php
		
		}
	?>
	
	
	
	
	<?php if ( $product->enable_dimensions_display() && ($product->has_dimensions() || $product->has_weight() )) : ?>
        <strong><?php _e( 'Product Dimensions', 'homeshop' ) ?></strong>
		<table>
		<?php if ( $product->has_weight() ) : $has_row = true; ?>
			<tr class="">
				<td><?php _e( 'Weight', 'homeshop' ) ?></td>
				<td class="product_weight"><?php echo $product->get_weight() . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $product->has_dimensions() ) : $has_row = true; ?>
			<tr class="">
				<td><?php _e( 'Dimensions', 'homeshop' ) ?></td>
				<td class="product_dimensions"><?php echo $product->get_dimensions(); ?></td>
			</tr>
		<?php endif; ?>
		</table>
	<?php endif; ?>

   
	
<?php do_action( 'woocommerce_product_meta_end' ); ?>



