<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $organique_woocommerce_loop;

// Store loop count we're currently on
if ( empty( $organique_woocommerce_loop['loop'] ) ) {
	$organique_woocommerce_loop['loop'] = 0;
}

// Increase loop count
$organique_woocommerce_loop['loop']++;

if ( 1 !== $organique_woocommerce_loop['loop'] &&  1 === $organique_woocommerce_loop['loop'] % 2 ) {
	echo '<div class="clearfix  visible-xs"></div>';
}
if ( 1 !== $organique_woocommerce_loop['loop'] &&  1 === $organique_woocommerce_loop['loop'] % 4 ) {
	echo '<div class="clearfix  hidden-xs"></div>';
}

?>


<div class="col-xs-6 col-sm-3">
	<div class="products__single">

		<figure class="products__image">
			<?php
				/**
				 * woocommerce_before_subcategory hook.
				 *
				 * @hooked woocommerce_template_loop_category_link_open - 10
				 */
				do_action( 'woocommerce_before_subcategory', $category );

				/**
				 * woocommerce_before_subcategory_title hook.
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );

				/**
				 * woocommerce_after_subcategory hook.
				 *
				 * @hooked woocommerce_template_loop_category_link_close - 10
				 */
				do_action( 'woocommerce_after_subcategory', $category );
			?>
		</figure>

		<h5 class="products__title">

			<?php
				// output of hook:
				// do_action( 'woocommerce_shop_loop_subcategory_title', $category );

				echo $category->name;

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?>
		</h5>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook.
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</div>
</div>
