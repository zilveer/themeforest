<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header( 'shop' );

global $woocommerce_loop, $porto_settings;

if (!(isset($woocommerce_loop['category-view']) && $woocommerce_loop['category-view'])) {
    $woocommerce_loop['category-view'] = isset($porto_settings['category-view-mode']) ? $porto_settings['category-view-mode'] : '';

    $term = get_queried_object();
    if ($term && isset($term->taxonomy) && isset($term->term_id)) {
        $cols = get_metadata($term->taxonomy, $term->term_id, 'product_cols', true);
        if (!$cols)
            $cols = $porto_settings['product-cols'];

        $addlinks_pos = get_metadata($term->taxonomy, $term->term_id, 'addlinks_pos', true);
        if (!$addlinks_pos)
            $addlinks_pos = $porto_settings['category-addlinks-pos'];

        $view_mode = get_metadata($term->taxonomy, $term->term_id, 'view_mode', true);

        $woocommerce_loop['columns'] = $cols;
        $woocommerce_loop['addlinks_pos'] = $addlinks_pos;
        if ($view_mode)
            $woocommerce_loop['category-view'] = $view_mode;
    }
}

if (is_shop()) {
    $woocommerce_loop['columns'] = $porto_settings['shop-product-cols'];
}

$js_wc_prdctfltr = false;
if (class_exists('WC_Prdctfltr')) {
    $porto_settings['category-ajax'] = false;
}

if ($porto_settings['category-ajax']) {
    // fix price slider issue
    $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    wp_register_script( 'wc-jquery-ui-touchpunch', WC()->plugin_url() . '/assets/js/jquery-ui-touch-punch/jquery-ui-touch-punch' . $suffix . '.js', array( 'jquery-ui-slider' ), WC_VERSION, true );
    wp_register_script( 'wc-price-slider', WC()->plugin_url() . '/assets/js/frontend/price-slider' . $suffix . '.js', array( 'jquery-ui-slider', 'wc-jquery-ui-touchpunch' ), WC_VERSION, true );
    wp_enqueue_script( 'wc-price-slider' );
}
?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20 : removed
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h2 class="page-title"><?php woocommerce_page_title(); ?></h2>

		<?php endif; ?>

        <?php
            /**
             * woocommerce_archive_description hook.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
        ?>

		<?php if ( have_posts() ) : ?>

            <div class="shop-loop-before clearfix"<?php if (!is_search() && !woocommerce_products_will_display()) echo ' style="display:none;"' ?>>
			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20 : removed
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>
            </div>

            <div class="archive-products">

                <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

            </div>

            <div class="shop-loop-after clearfix"<?php if (!is_search() && !woocommerce_products_will_display()) echo ' style="display:none;"' ?>>
			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>
            </div>

        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

            <div class="shop-loop-before clearfix" style="display:none;"></div>

            <div class="archive-products">
			    <?php wc_get_template( 'loop/no-products-found.php' ); ?>
            </div>

            <div class="shop-loop-after clearfix" style="display:none;"></div>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>