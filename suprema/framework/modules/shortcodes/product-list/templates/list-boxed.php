
    <div class="qodef-product-boxed-holder">
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'suprema_qodef_pl_boxed_woocommerce_before_shop_loop_item' );

        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         * @hooked woocommerce_template_loop_product_link_close - 15
         *
         */
        do_action( 'suprema_qodef_pl_boxed_woocommerce_before_shop_loop_item_title' );
        ?>
        <div class="qodef-product-boxed-overlay">
            <div class="qodef-product-boxed-overlay-outer">
                <div class="qodef-product-boxed-overlay-inner">
                    <?php
                    /**
                     * woocommerce_shop_link_overlay hook.
                     *
                     * @hooked woocommerce_template_loop_product_link_open - 5
                     * @hooked woocommerce_template_loop_product_link_close - 10
                     */
                    do_action( 'suprema_qodef_pl_simple_woocommerce_link_overlay');
                    /**
                     * woocommerce_shop_loop_item_title hook.
                     *
                     * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
                     * @hooked woocommerce_template_loop_product_link_open - 10
                     * @hooked suprema_qodef_get_product_list_title - 15, 1
                     */
                    do_action( 'suprema_qodef_pl_boxed_woocommerce_shop_loop_item_title', $params );

                    /**
                     * woocommerce_after_shop_loop_item_title hook.
                     *
                     * @hooked woocommerce_template_loop_product_link_close - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'suprema_qodef_pl_boxed_woocommerce_after_shop_loop_item_title' );

                    ?>
                </div>
            </div>
        </div>
    </div>
