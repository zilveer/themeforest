<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="product-category product-item-wrap">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
		<div class="product-category-inner">
			<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>
		</a>

		<div class="product-category-info text-center">
			<h3 class="product-name p-font">
				<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
					<?php echo esc_html($category->name);
					if ( $category->count > 0 )
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">(' . $category->count . ')</span>', $category );
					?>
				</a>
			</h3>
		</div>
		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>
		</div>
	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>
