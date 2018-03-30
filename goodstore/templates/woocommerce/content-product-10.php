<?php
/**
 * The default template for displaying product/small content
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

    <article id="product-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-2', 'product-style-10', $catalog_mode_class)); ?>   
             sort_name="<?php echo esc_attr(StrToLower(get_the_title())); ?>"  
             sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
             sort_rating="<?php echo esc_attr(($post->rating > 0) ? ((int) ($post->rating * 50)) : '0'); ?>" 
             sort_popular="<?php echo esc_attr(get_comments_number());     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }                ?>"
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

                jwUtils::the_post_thumbnail('woo-size-category');
                 if (isset($gallery[0])) {
                    echo wp_get_attachment_image($gallery[0], "woo-size-category", false, array('class' => 'woo_second_image'));
                }
                echo '</a>';
                ?>

                <?php if ($product->is_featured()) { ?>
                    <div class="featured-bar">
                        <span><?php _e('Featured product', 'jawtemplates') ?></span>
                    </div>
                <?php } ?>
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
                <h2>
                    <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="post_name"><?php echo jwUtils::crop_length(get_the_title(), jwOpt::get_option('letter_excerpt_title', -1)); ?></a>
                </h2>   <!-- Title -->

                <?php
                   if($woo_signedin_price) {
                        echo '<div class="price-container">';
                        wc_get_template('single-product/price.php');
                        echo '</div>';
                    }
                ?>
            </div>
            <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
            <?php do_action('woocommerce_after_shop_loop_item'); ?>
        </div>
    </article>
    <?php
}