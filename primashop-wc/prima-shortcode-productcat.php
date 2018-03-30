<?php
/**
 * The template for displaying product categories/taxonomies shortcode.
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category PrimaShop
 * @package  Templates
 * @author   PrimaThemes
 * @link     http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $woocommerce_loop, $prima_productcats_atts, $product_categories;
$atts = $prima_productcats_atts;
$atts = apply_filters( 'prima_productcats_atts', $atts );

$prima_catalog_loop = 0;
$prima_catalog_column = $atts['columns'];
$woocommerce_loop['columns'] = $atts['columns'];
if ( $atts['style'] )
	$atts['style'] = 'ps-productcat-'.$atts['style'];
?>

<div class="woocommerce ps-productcat <?php echo $atts['style']; ?>">

<?php if ( trim( $atts['title'] ) ) echo '<h2 class="ps-product-taxonomy"><span>' . $atts['title'] . '</span></h2>'; ?>

<ul class="products products-col-<?php echo $prima_catalog_column ?>">

	<?php 
	foreach ($product_categories as $category) :

		if ( is_numeric( $atts['parent'] ) && $category->parent != $atts['parent'] )
			continue;
			
		$product_category_found = true;
		$product_category = $category;

		$prima_catalog_loop++;
		if ( intval( $atts['numbers'] ) > 0 && $prima_catalog_loop > $atts['numbers'] )
			continue;
		
		$product_class = $prima_catalog_loop%2 ? ' odd' : ' even';
		if ($prima_catalog_loop%$prima_catalog_column==0) $product_class .= ' last';
		if (($prima_catalog_loop-1)%$prima_catalog_column==0) $product_class .= ' first';
		?>
		<li class="product sub-category <?php echo $product_class; ?>">

			<?php if ( $atts['show_image'] == 'yes' ) : ?>
			<div class="product-image-box">
			<a href="<?php echo get_term_link($category->slug, $category->taxonomy); ?>">
			<?php
				global $woocommerce;
				$img_args = array();
				$img_args['width'] = $atts['image_width'];
				$img_args['height'] = $atts['image_height'];
				$img_args['crop'] = ( $atts['image_crop'] == 'yes' ? true : false );
				$image_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
				$img_args['image_id'] = ($image_id) ? $image_id : null;
				$img_args['the_post_thumbnail'] = false;
				$img_args['attachment'] = false;
				$img_args['default_image'] = woocommerce_placeholder_img_src();
				$img_args['link_to_post'] = false;
				prima_image($img_args);
			?>
			</a>
			</div>
			<?php endif; ?>
			
			<?php if ( $atts['show_title'] == 'yes' ) : ?>
			<a href="<?php echo get_term_link($category->slug, $category->taxonomy); ?>">
				<h3>
				<?php echo $category->name; ?>
				<?php if ( $atts['show_count'] == 'yes' ) : ?>
					<mark class="count">(<?php echo $category->count; ?>)</mark>
				<?php endif; ?>
				</h3>
			</a>
			<?php endif; ?>

		</li><?php

	endforeach;
	?>

</ul>

</div>