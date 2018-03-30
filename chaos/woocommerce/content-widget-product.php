<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<div <?php post_class('item-col'); ?>>
	<div class="product-wrapper">
		<div class="list-col4">
			<div class="product-image">
				<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
					<?php echo $product->get_image(); ?>
				</a>
			</div>
		</div>
		<div class="list-col8">
			<h2 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="price-box"><?php echo $product->get_price_html(); ?></div>
			<div class="ratings"><?php echo $product->get_rating_html(); ?></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>