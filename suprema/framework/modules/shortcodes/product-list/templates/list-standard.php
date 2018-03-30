
    <div class="qodef-product-standard-image-holder">
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'suprema_qodef_pl_standard_woocommerce_before_shop_loop_item' );
        ?>
        <span class="qodef-original-image">
					<?php

                    /**
                     * woocommerce_before_shop_loop_item_title hook.
                     *
                     * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     *
                     */
                    do_action( 'suprema_qodef_pl_standard_woocommerce_before_shop_loop_item_title' );

                    ?>
					</span>
					<span class="qodef-hover-image">
					<?php

                    /**
                     * woocommerce_before_shop_loop_item_title hook.
                     *
                     * @hooked suprema_qodef_woocommerce_shop_loop_hover_image - 10
                     *
                     */
                    do_action('suprema_qodef_pl_standard_woocommerce_shop_loop_item_hover_image');

                    ?>
					</span>
        <?php

        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_link_close - 15
         *
         */

        do_action('suprema_qodef_pl_standard_woocommerce_shop_loop_item_hover_link_close')

        ?>

        <div class="qodef-product-standard-button-holder">

            <?php
            /**
             * woocommerce_before_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_add_to_cart - 5
             *
             */
            do_action('suprema_qodef_pl_standard_woocommerce_shop_loop_product_simple_button');
            ?>
        </div>
    </div>
    <div class="qodef-product-standard-info-top">
        <?php

        /**
         * suprema_qodef_woocommerce_shop_loop_item_categories hook.
         *
         * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
         *
         */
        do_action( 'suprema_qodef_pl_standard_woocommerce_shop_loop_item_categories' );

        /**
         * woocommerce_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 5
         * @hooked suprema_qodef_get_product_list_title - 10, 1
         */
        do_action( 'suprema_qodef_pl_standard_woocommerce_shop_loop_item_title', $params);

        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_price - 10
         * @hooked suprema_qodef_woocommrece_template_loop_wishlist - 15
         */
        do_action( 'suprema_qodef_pl_standard_woocommerce_after_shop_loop_item_title');
        ?>
    </div>
