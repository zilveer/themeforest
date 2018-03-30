<li <?php  post_class() ?> >
    <div class="qodef-product-simple-holder">
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         * @hooked woocommerce_show_product_loop_sale_flash - 5
         * @hooked qode_get_woocommerce_out_of_stock - 5
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action('qode_action_pl_simple_woocommerce_before_shop_loop_item');
        ?>

        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         *
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         *
         */
        do_action('qode_action_pl_simple_woocommerce_before_shop_loop_item_title');
        ?>

        <?php

        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_link_close - 15
         *
         */

        do_action('qode_action_pl_simple_woocommerce_shop_loop_item_hover_link_close');
        ?>
    </div>
    <div class="qodef-product-simple-overlay">
        <div class="qodef-product-simple-overlay-outer">
            <div class="qodef-product-simple-overlay-inner">
                <?php
                /**
                 *
                 * @hooked woocommerce_template_loop_product_link_open - 5
                 * @hooked woocommerce_template_loop_product_link_close - 1
                 */
                do_action( 'qode_action_pl_simple_woocommerce_shop_loop_item_overlay' );
                ?>
                <div class="qodef-product-standard-title">
                    <?php
                    /**
                     * woocommerce_shop_loop_item_title hook.
                     *
                     * @hooked woocommerce_template_loop_product_link_open - 5
                     * @hooked woocommerce_template_loop_product_title - 10
                     * @hooked woocommerce_template_loop_product_link_close - 15
                     */
                    do_action( 'qode_action_pl_simple_woocommerce_shop_loop_item_title' );
                    ?>
                </div>
                <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook.
                 *
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action('qode_action_pl_simple_woocommerce_after_shop_loop_item_title');
                ?>
            </div>
        </div>
    </div>
</li>