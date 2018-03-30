<?php
/**
 * The template for displaying products shortcode.
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

global $woocommerce, $woocommerce_loop, $prima_products_atts;
$atts = $prima_products_atts;
$atts = apply_filters( 'prima_products_atts', $atts );

$prima_catalog_loop = 0;
$prima_catalog_column = $atts['columns'];
$woocommerce_loop['columns'] = $atts['columns'];
?>

<?php if (have_posts()) : ?>

<div class="woocommerce ps-products">

<?php if ( trim( $atts['title'] ) ) echo '<h2 class="ps-products-title"><span>' . $atts['title'] . '</span></h2>'; ?>

<?php 
if ( trim( $atts['title'] ) && $atts['link_to_shop'] == 'yes' ) 
	echo '<a class="ps-products-link" href="'.prima_get_wc_shop_url().'">'.__('Visit Shop &rarr;', 'primathemes').'</a>';
?>

<ul class="products products-col-<?php echo $prima_catalog_column ?> ">

	<?php 
	while (have_posts()) : the_post(); 
	
		global $product;
		if (!$product->is_visible()) continue; 
		
		$prima_catalog_loop++;
		$classes = array();
		$classes[] = $prima_catalog_loop%2 ? ' odd' : ' even';
		if ($prima_catalog_loop%$prima_catalog_column==0) $classes[] = ' last';
		if (($prima_catalog_loop-1)%$prima_catalog_column==0) $classes[] = ' first';
		?>
		
		<li <?php post_class( $classes ); ?>>
			
			<a href="<?php the_permalink() ?>">
			
				<?php if ( $atts['product_image'] == 'yes' ) : ?>
					<?php if ( intval( $atts['image_width'] ) > 0 && intval( $atts['image_height'] ) > 0 ) : ?>
						<?php
							$img_args = array();
							$img_args['width'] = $atts['image_width'];
							$img_args['height'] = $atts['image_height'];
							$img_args['crop'] = ( $atts['image_crop'] == 'yes' ? true : false );
							$img_args['default_image'] = woocommerce_placeholder_img_src();
							$img_args['image_scan'] = false;
							$img_args['link_to_post'] = false;
							prima_image($img_args);
						?>
					<?php else : ?>
						<?php woocommerce_template_loop_product_thumbnail(); ?>
					<?php endif; ?>

					<?php if ( class_exists( 'WC_pif' ) ) : ?>
						<?php global $product, $woocommerce; ?>
						<?php $attachment_ids = $product->get_gallery_attachment_ids(); ?>
						<?php if ( $attachment_ids ) : ?>
							<?php $secondary_image_id = $attachment_ids['0']; ?>
							<?php if ( intval( $atts['image_width'] ) > 0 && intval( $atts['image_height'] ) > 0 ) : ?>
								<?php
									$img_args = array();
									$img_args['width'] = $atts['image_width'];
									$img_args['height'] = $atts['image_height'];
									$img_args['crop'] = ( $atts['image_crop'] == 'yes' ? true : false );
									$img_args['default_image'] = woocommerce_placeholder_img_src();
									$img_args['image_scan'] = false;
									$img_args['link_to_post'] = false;
									$img_args['image_id'] = $secondary_image_id;
									$img_args['image_class'] = 'secondary-image attachment-shop-catalog';
									prima_image($img_args);
								?>
							<?php else : ?>
								<?php echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) ); ?>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
				
				<?php if ( $atts['product_saleflash'] == 'yes' ) woocommerce_show_product_loop_sale_flash(); ?>
				
				<?php if ( $atts['product_title'] == 'yes' ) echo '<h3>'.get_the_title().'</h3>'; ?>
		
				<?php if ( $atts['product_rating'] == 'yes' ) woocommerce_template_loop_rating(); ?>
				
				<?php if ( $atts['product_price'] == 'yes' ) woocommerce_template_loop_price(); ?>
			
			</a>
			
			<?php if ( $atts['product_excerpt'] == 'yes' ) prima_wc_product_excerpt(); ?>
			
			<?php do_action( 'prima_shortcode_product_button_before', $prima_products_atts ); ?>
			
			<?php if ( $atts['product_button'] == 'yes' ) woocommerce_template_loop_add_to_cart(); ?>
			
			<?php do_action( 'prima_shortcode_product_button_after', $prima_products_atts ); ?>
			
		</li><?php 
		
	endwhile;
	
	?>

</ul>

</div>

<?php else : ?>

	<?php echo '<p class="woocommerce-info">'.__('No products found which match your selection.', 'primathemes').'</p>'; ?>

<?php endif; ?>