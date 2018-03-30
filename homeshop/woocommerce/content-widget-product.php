<?php 
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


global $product; 
$num_rating = (int) $product->get_average_rating();
?>

	<tr>
		<td class="product-thumbnail">
		 <a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		  <?php echo $product->get_image(); ?>
		 </a>
		</td>
		<td class="product-info">
			<p><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo product_max_charlength_text($product->get_title(), (int) get_option('sense_num_product_title')); ?></a></p>
			
			 <?php if (  get_option('woocommerce_enable_review_rating') != 'no'  ){ ?>
			  <div class="rating readonly-rating" data-score="<?php echo $num_rating; ?>"></div>
			  <?php } ?>
			 
			<span class="price"><?php echo $product->get_price_html(); ?></span>
		</td>
	</tr>

