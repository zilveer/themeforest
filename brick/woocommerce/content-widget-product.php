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
 * @see     http://docs.woothemes.com/document/template-structure/
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
	<div class="product_list_widget_image_wrapper">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo qode_kses_img($product->get_image()); ?>		
		</a>
	</div>	
	<div class="product_list_widget_info_wrapper">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<span class="product-title"><?php echo esc_html($product->get_title()); ?></span>
		</a>
		<?php if ( ! empty( $show_rating ) ) echo wp_kses($product->get_rating_html(), array(
        'div' => array(
            'class' => true,
            'title' => true,
            'style' => true,
            'id' => true
        ),
        'span' => array(
            'style' => true,
            'class' => true,
            'id' => true,
            'title' => true
        ),
        'strong' => array(
            'class' => true,
            'id' => true,
            'style' => true,
            'title' => true
        ))); ?>
		<?php echo wp_kses_post($product->get_price_html()); ?>
	</div>
</li>