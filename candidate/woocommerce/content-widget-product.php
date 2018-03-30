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


global $product; ?>
<li>
	<div class="featured-image">
		<?php echo $product->get_image(); ?>
	</div>
	<div class="shop-item-content">
		<h6><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>" ><?php echo $product->get_title(); ?></a></h6>
		<span class="price"><?php echo $product->get_price_html(); ?></span>
		
		<?php 
		$average = $product->get_average_rating();
		?>
		<div class="shop-rating read-only-small" data-score="<?php echo esc_html( $average ); ?>"></div>
		
	</div>
</li>