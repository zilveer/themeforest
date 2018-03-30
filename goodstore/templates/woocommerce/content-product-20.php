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
    // allowing shortcodes in short description - only for list box style
    add_filter('the_excerpt', 'do_shortcode');
    ?>

    <article id="product-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-9', 'product-style-20', 'product-animate', $catalog_mode_class)); ?>   
             sort_name="<?php echo esc_attr(StrToLower(get_the_title())); ?>"  
             sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
             sort_rating="<?php echo esc_attr(($post->rating > 0) ? ((int) ($post->rating * 50)) : '0'); ?>" 
             sort_popular="<?php echo esc_attr(get_comments_number()); ?>"
             >
                 <?php
                 $class = '';
                 if (jwOpt::get_option('woo_animation', 'simple') != 'off') {
                     $gallery = $product->get_gallery_attachment_ids();
                     $gallery = array_slice($gallery, 0, 3);
                     if (sizeof($gallery) > 0) {
                         $class .= "has-thumbnails ";
                     }
                     $class .= 'hower_image_' . jwOpt::get_option('woo_animation', 'simple');
                 }
                 ?>
        <div class="box <?php echo esc_attr($class); ?>">
            <?php do_action('woocommerce_before_shop_loop_item'); ?>



            <div class="images ">
                <div class="image ">
                    <?php
                    echo '<a href="' . esc_url($link) . '" title="' . esc_attr(get_the_title()) . '">';
                    jwUtils::the_post_thumbnail('woo-size');
                    foreach ((array) $gallery as $k => $gal) {
                        echo  wp_get_attachment_image($gal, "woo-size", false, array('class'=>'woo_second_image','id' => 'woo_second_image_'.$k));
                    }
                    echo '</a>';
                    ?>    

                    <?php if ($product->is_featured()) { ?>
                        <div class="featured-bar">
                            <span><?php _e('Featured product', 'jawtemplates') ?></span>
                        </div>
                    <?php } ?>
                </div>
                <div class="thumbnails">
                    <?php
                    foreach ((array) $gallery as $k => $gal) {
                        echo  wp_get_attachment_image($gal, "woo-size", false, array('class'=>'woo_thumbnail_image','data-thumbnail'=> esc_attr($k)));
                    }
                    ?>
                </div>
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
                <div class="rating <?php echo esc_attr(implode(' ', $class_rating)); ?>">
                    <?php echo $rating; ?>  <!-- RATING -->
                    <div class="clear"></div>
                </div>
                <?php echo jwUtils::crop_length(get_the_excerpt(), jwOpt::get_option('letter_excerpt', -1)); ?>  
                <div class="product-box-controlls">
                    <?php
                       if($woo_signedin_price) {
                            echo '<div class="price-container">';
                            wc_get_template('single-product/price.php');
                            echo '</div>';
                        }
                    ?>          
                
                    <div class="product-box-buttons">
                        <div class="addtocart">
                            <?php wc_get_template('loop/add-to-cart.php'); ?>
                        </div>

                        <?php if (is_plugin_active('yith-woocommerce-wishlist/init.php')) { ?>
                            <div class="addtowishlist">
                                <span class="icon-plus-circle2"></span><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
                <?php do_action('woocommerce_after_shop_loop_item'); ?>
        </div>
        
    </article>

    <?php
} 