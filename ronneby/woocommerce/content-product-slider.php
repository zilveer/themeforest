<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.2.10
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $dfd_ronneby;

$categ = $product->get_categories();
$term = get_term_by('name', strip_tags($categ), 'product_cat');
$subtitle = get_post_meta($product->id, 'dfd_product_product_subtitle', true);

$stock = $product->is_in_stock() ? '' : '<span class="dfd-woo-stock">'.esc_html__('Out of stock','dfd').'</span>';

$catalogue_mode = (isset($dfd_ronneby['woocommerce_catalogue_mode']) && $dfd_ronneby['woocommerce_catalogue_mode']);
$product_style = (isset($dfd_ronneby['woo_products_loop_style']) && $dfd_ronneby['woo_products_loop_style']) ? $dfd_ronneby['woo_products_loop_style'] : 'style-1';

$wrap_class = (isset($dfd_ronneby['woo_category_content_alignment']) && $dfd_ronneby['woo_category_content_alignment']) ? $dfd_ronneby['woo_category_content_alignment'] : 'text-center';

$buttons_color_scheme = (isset($dfd_ronneby['woo_products_buttons_color_scheme']) && $dfd_ronneby['woo_products_buttons_color_scheme']) ? $dfd_ronneby['woo_products_buttons_color_scheme'] : 'dfd-buttons-dark';
?>
<div class="product <?php echo esc_attr($product_style) ?>">
	<div class="prod-wrap <?php echo esc_attr($wrap_class) ?>">
	
		<?php do_action('woocommerce_before_shop_loop_item'); ?>
		<div class="woo-cover">
			<div class="prod-image-wrap woo-entry-thumb">

			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */

			do_action('woocommerce_before_shop_loop_item_title');
			?>
				<?php if(!$catalogue_mode): ?>
					<a href="<?php the_permalink(); ?>" class="link"></a>
				<?php endif; ?>
				<?php echo $stock; ?>
			</div>
		</div>
		<?php if(!$catalogue_mode): ?>
			<div class="woo-title-wrap">
				<div class="heading">
					<div class="dfd-folio-categories">
						<?php get_template_part('templates/woo', 'term'); ?>
					</div>
					<div class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<?php if(!empty($subtitle)) : ?>
						<div class="subtitle"><?php echo $subtitle; ?></div>
					<?php endif; ?>
					<div class="price-wrap">
						<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
					</div>
					<div class="rating-section">
						<?php woocommerce_get_template_part('loop/rating'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php if(strcmp($product_style, 'style-2') === 0) : ?>
			<div class="additional-price <?php echo esc_attr($buttons_color_scheme) ?>">
				<div>
					<?php do_action('woocommerce_after_shop_loop_item_title') ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>