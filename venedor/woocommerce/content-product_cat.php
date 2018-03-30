<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;

global $venedor_layout, $venedor_sidebar;

$classes = 'product-category ' . esc_attr( apply_filters( 'product_cat_class', '', '', $category ) );
if (($venedor_layout == 'left-sidebar' || $venedor_layout == 'right-sidebar') && $venedor_sidebar)
    $classes .= ' col-md-4 col-sm-6';
else
    $classes .= ' col-md-3 col-sm-4';

?>
<li class="<?php echo esc_attr($classes) ?>">

	<?php
    /**
     * woocommerce_before_subcategory hook.
     *
     * @hooked woocommerce_template_loop_category_link_open - 10 : removed
     */
    do_action( 'woocommerce_before_subcategory', $category );
    ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );

            /**
             * woocommerce_shop_loop_subcategory_title hook.
             *
             * @hooked woocommerce_template_loop_category_title - 10 : removed
             */
            do_action( 'woocommerce_shop_loop_subcategory_title', $category );

            /**
             * woocommerce_after_subcategory_title hook.
             */
            do_action( 'woocommerce_after_subcategory_title', $category );
		?>

		<h3>
			<?php
				echo $category->name;

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?>
		</h3>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php
    /**
     * woocommerce_after_subcategory hook.
     *
     * @hooked woocommerce_template_loop_category_link_close - 10 : removed
     */
    do_action( 'woocommerce_after_subcategory', $category );
    ?>
</li>