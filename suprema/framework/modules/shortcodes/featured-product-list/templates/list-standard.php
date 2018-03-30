<li class="qodef-product">
    <div class="qodef-product-featured-image-holder">
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'suprema_qodef_p_featured_woocommerce_before_shop_loop_item' );
        ?>
			<?php

			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 *
			 */
			do_action( 'suprema_qodef_p_featured_woocommerce_before_shop_loop_item_title' );

			?>
    </div>
    <div class="qodef-product-featured-info">
        <?php

        /**
         * woocommerce_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 5
         * @hooked suprema_qodef_get_product_list_title - 10, 1
         */
        do_action( 'suprema_qodef_p_featured_woocommerce_shop_loop_item_title', $params);

        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action( 'suprema_qodef_p_featured_woocommerce_after_shop_loop_item_title');
		
		
		 /**
         * suprema_qodef_woocommerce_shop_loop_item_categories hook.
         *
         * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
         *
         */
        do_action( 'suprema_qodef_p_featured_woocommerce_shop_loop_item_categories' );
        ?>
    </div>
</li>