<?php
/**
 * Woocommerce custom modifications
 * in this file you can override functions from plugin/woocommerce/woocommerce.php
 */


/**
 *
 *Overwrite default woocommerce cart widget
 *
 **/

if (!function_exists('override_woocommerce_widgets')) {
    function override_woocommerce_widgets()
    {
        if (class_exists('WC_Widget_Cart')) {
            unregister_widget('WC_Widget_Cart');


            class Custom_WooCommerce_Widget_Cart extends WC_Widget_Cart
            {
                public function widget($args, $instance)
                {
                    extract($args);

                    //if ( is_cart() || is_checkout() ) return;

                    $title = apply_filters('widget_title', empty($instance['title']) ? __('Cart', 'woocommerce') : $instance['title'], $instance, $this->id_base);
                    $hide_if_empty = empty($instance['hide_if_empty']) ? 0 : 1;

                    //output raw html
                    echo $before_widget;//no escape required

                    if ($title)
                        //$before_title . $title . $after_title;//no escape required

                        if ($hide_if_empty)
                            echo '<div class="hide_cart_widget_if_empty">';

                    // Insert cart widget placeholder - code in woocommerce.js will update this on page load
                    echo '<div class="widget_shopping_cart_content"></div>';

                    if ($hide_if_empty)
                        echo '</div>';

                    echo $after_widget;//no escape required

                }
            }

            new Custom_WooCommerce_Widget_Cart();
            register_widget('Custom_WooCommerce_Widget_Cart');
        }
    }
}
//add_action('widgets_init', 'override_woocommerce_widgets', 15);




//add_action( 'woocommerce_after_shop_loop_item_title', 'ct_woocommerce_product_excerpt', 7, 2);
if (!function_exists('ct_woocommerce_product_excerpt'))
{
    function ct_woocommerce_product_excerpt()
    {
        $content_length = 4;
        global $post;
        $content = $post->post_excerpt;
        $wordarray = explode(' ', $content, $content_length + 1);
        if(count($wordarray) > $content_length) :
            array_pop($wordarray);
            array_push($wordarray, '...');
            $content = implode(' ', $wordarray);
            $content = force_balance_tags($content);
        endif;
        echo "<div class='excerpt'><p>$content</p></div>";
    }
}


/**
 *
 * Change number of upsell products on product page
 * Set your own value for 'posts_per_page'
 *
 */
if (!function_exists('woocommerce_output_upsells')) {
    function woocommerce_output_upsells()
    {
        woocommerce_upsell_display(4, 4); // Display 3 products in rows of 3
    }
}
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
//add_action('woocommerce_after_single_product', 'woocommerce_output_upsells', 15);


/**
 *
 * Single Product Notices
 *
 */
if (!function_exists('woo_related_products_limit')) {
    /**
     *
     * Change number of related products on product page
     * Set your own value for 'posts_per_page'
     *
     */
    function woo_related_products_limit()
    {
        global $product;

        $args['posts_per_page'] = 4;
        return $args;
    }
}


if (!function_exists('ct_related_products_args')) {
    function ct_related_products_args($args)
    {

        $args['posts_per_page'] = 3; // 3 related products
        $args['columns'] = 3; // arranged in 3 columns
        return $args;
    }
}
add_filter('woocommerce_output_related_products_args', 'ct_related_products_args');



/**
 *
 * Single Product Share
 *
 */

if (!function_exists('ct_wooshare')) {
    function ct_wooshare()
    {
        global $post;

        $thumb_id = get_post_thumbnail_id();
        $thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
        if (isset($thumb_url[0])) {
            $thumbSrc = $thumb_url[0];
        } else {
            $thumbSrc = '';
        }


        echo '
    <h4 class="color-motive uppercase">' . __('Share this product', 'ct_theme') . '</h4>
    <ul class="socials">
        <li>
            <a href="' . esc_url('http://www.facebook.com/sharer.php?u=' . get_permalink()) . '" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
        </li>
        <li>
            <a href="' . esc_url('https://twitter.com/share?url=' . get_permalink()) . '" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
        </li>
        <li>
            <a href="' . esc_url('https://plus.google.com/share?url=' . get_permalink()) . '" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google +"><i class="fa fa-google-plus"></i></a>
        </li>
        <li>
            <a href="' . esc_url('mailto:?subject=' . get_the_title() . '&body=' . apply_filters('woocommerce_short_description', $post->post_excerpt) . get_permalink()) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="' . __('Mail', 'ct_theme') . '"><i class="fa fa-envelope"></i></a>
        </li>
    </ul>';
    }
}
/*remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
add_action('ct_product_share', 'woocommerce_template_single_sharing');
add_action('woocommerce_share', 'ct_wooshare');*/



/**
 *
 * Ensure cart contents update when products are added to the cart via AJAX
 *
 */
if (!function_exists('woocommerce_header_add_to_cart_fragment')) {
    function woocommerce_header_add_to_cart_fragment($fragments)
    {
        global $woocommerce;
        ob_start();
        ?>
        <span
            class="ct-wooCart-numberItems"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?></span>
        <?php
        $fragments['.ct-wooCart .ct-wooCart-numberItems'] = ob_get_clean();
        return $fragments;
    }
}
//add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');




// Add product arrow navigations to header

function ct_product_go_back_links()
{
    $shop_page_url = get_permalink(woocommerce_get_page_id('shop'));
    $product_cats = wp_get_post_terms(get_the_ID(), 'product_cat');
    $prev = get_next_post();
    $next = get_previous_post();


    if($prev || $next){
        echo '<div class="ct-productPagination">';
        if($prev){
            echo'<a href="'. get_permalink($prev->ID).'"
               class="ct-productPagination-left">'. __('<i class="fa fa-arrow-left"></i>', 'ct_theme') .'</a>';
        }
        if($next){
            echo'<a href="'. get_permalink($next->ID).'"
               class="ct-productPagination-right">'. __('<i class="fa fa-arrow-right"></i>', 'ct_theme') .'</a>';
        }
        echo '</div>';
    }

}

//add_action( 'ct_woo_custom_product_navigation', 'ct_product_go_back_links', 1);