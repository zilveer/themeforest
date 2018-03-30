<?php
/**
 * The default template for displaying product/color content
 */
?>

<?php
if (class_exists('WooCommerce')) {

    global $post, $product;
    $class = "";

    if (!$product || !$product->is_visible())
        return;

    $link = get_permalink();
    if (jaw_template_get_var('catalog_mode', 'off') == 'on') {
        $link = add_query_arg('catalog_mode', 'on', $link);
    }
    $catalog_mode_class = '';
    if (jwOpt::get_option('woo_catalog') == '1') {
        $catalog_mode_class = 'catalog_mode_on';
    }
    $woo_signedin_price=true;
    if(jwOpt::get_option("woo_signedin_price",0) == 1 && !is_user_logged_in()) {
        $woo_signedin_price=false;
    }
    $thirspartyplugins = false;
    if (is_plugin_active('gema75_woocommerce_badges/woocommerce_badges.php')) {
        $thirspartyplugins = true;
    }
    ?>

    <article id="product-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-3', 'product-style-1', 'product-animate', $catalog_mode_class)); ?>   
             sort_name="<?php echo esc_attr(StrToLower(get_the_title())); ?>"  
             sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
             sort_rating="<?php echo esc_attr(($post->rating > 0) ? ((int) ($post->rating * 50)) : '0'); ?>" 
             sort_popular="<?php echo esc_attr(get_comments_number()); ?>"
             >
        <div class="box ">
            <?php do_action('woocommerce_before_shop_loop_item'); ?>
            <?php
            if (jwOpt::get_option('woo_animation', 'simple') != 'off') {
                $gallery = $product->get_gallery_attachment_ids();
                if (isset($gallery[0])) {
                    $class = 'hower_image_' . jwOpt::get_option('woo_animation', 'simple');
                }
            }
            ?>
            <div class="image <?php echo esc_attr($class); ?>">
                <?php
                echo '<a href="' . esc_url($link) . '" title="' . esc_attr(get_the_title()) . '">';
                jwUtils::the_post_thumbnail('woo-size');
                 if (isset($gallery[0])) {
                    echo wp_get_attachment_image($gallery[0], "woo-size", false, array('class' => 'woo_second_image'));
                }
                echo '</a>';
                ?>          
            </div>

            <?php
            if ($thirspartyplugins) {
                do_action('woocommerce_before_shop_loop_item_title');
            } else {
            echo '<div class="product-info-bar">';
                do_action('woocommerce_before_shop_loop_item_title');
            echo '</div>';
            }
            ?>

            <div class="product-box">

                <?php
                $class_rating = array();
                $rating = jwRender::metaRating();

                if (strlen(trim($rating)) == 0) {
                    $class_rating[] = "rating-none";
                }
                ?>

                <h2 class="<?php echo esc_attr(implode(' ', $class_rating)); ?>">
                    <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="post_name"><?php echo jwUtils::crop_length(get_the_title(), jwOpt::get_option('letter_excerpt_title', -1)); ?></a>
                </h2>   <!-- Title -->
                <?php echo jwUtils::crop_length(jwRender::get_the_excerpt(), jwOpt::get_option('letter_excerpt', -1)); ?>
                <div class="clear"></div>   
                <div class="product-box-info">



                    <div class="rating <?php echo esc_attr(implode(' ', $class_rating)); ?>">
                        <?php echo $rating; ?>  <!-- RATING -->
                        <div class="clear"></div>
                    </div>
                    <?php
                       if($woo_signedin_price) {
                            echo '<div class="price-container">';
                            wc_get_template('single-product/price.php');
                            echo '</div>';
                        }
                    ?>
                    <div class="clear"></div>                
                </div>
                <div class="product-box-buttons">
                    <div class="addtocart">
                        <?php wc_get_template('loop/add-to-cart.php'); ?>
                    </div>

                    <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php')) { ?>
                        <div class="addtowishlist">
                            <span class="icon-plus-circle2"></span><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                        </div>
                    <?php } ?>

                    <div class="clear"></div>    
                </div>

                <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
                <?php do_action('woocommerce_after_shop_loop_item'); ?>

                <div class="clear"></div>
            </div> 
        </div>
    </article>

    <?php
} 