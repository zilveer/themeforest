
<div class='qodef-shop-product <?php echo esc_attr($image_size_class); echo esc_html($cats);  echo esc_attr($out_stock_class);  echo esc_attr($on_sale_class);?>'>
    <div class="qodef-masonry-product-inner">
        <div class="qodef-masonry-product-image-holder">
        <?php

        echo woocommerce_get_product_thumbnail($thumb_size);

        ?>
        </div>
        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail');
        do_action( 'woocommerce_before_shop_loop_item_title' );
        add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);
        do_action('suprema_qodef_woocommerce_out_of_stock');
        ?>
        <div class="qodef-masonry-product-meta-wrapper">
            <div class="qodef-masonry-product-overlay-outer">
                <div class="qodef-masonry-product-shader"></div>
                <div class="qodef-masonry-product-table">
                    <div class="qodef-masonry-product-cell">
                        <div class="qodef-masonry-product-info">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title('<h3 class="qodef-product-list-product-title">', '</h3>'); ?>
                            </a>
                            <?php
                                //Add Product Categories and Price On Product List
                                add_action('suprema_qodef_woocommerce_after_shop_loop_item_title_masonry', 'suprema_qodef_woocommerce_shop_loop_categories', 5);
								add_action('suprema_qodef_woocommerce_after_shop_loop_item_title_masonry', 'woocommerce_template_loop_price', 10);
								
                                do_action('suprema_qodef_woocommerce_after_shop_loop_item_title_masonry');

                             ?>
                        </div>
                        <div class="qodef-masonry-product-button">
                            <?php
                            //Add Product Add to cart button
                            add_action('suprema_qodef_woocommerce_after_shop_loop_item_masonry','woocommerce_template_loop_add_to_cart',10);
                            do_action('suprema_qodef_woocommerce_after_shop_loop_item_masonry');
                            ?>
                        </div>
                        <a class="qodef-masonry-product-overlay-link" href="<?php the_permalink(); ?>"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
