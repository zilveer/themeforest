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
global $product; ?>
<li class="firstItem">
	<div class="media">
		<a class="pull-left" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo $product->get_image(array(60,60)); ?>
		</a>
		<div class="media-body">
			<h4 class="media-heading"><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo $product->get_title(); ?></a></h4>
			<span class="small-coast"><?php echo $product->get_price_html(); ?></span>
			<div class="rating">
				<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
			</div>
		</div>
	</div>
</li>