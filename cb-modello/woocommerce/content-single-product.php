<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly
$cb_sidebars = cb_get_sidebars($post->ID);
global $woocommerce, $product;

if ($cb_sidebars['sidebar_position'] == '' || $cb_sidebars['sidebar_position'] == 'none') {

    ?>
    <section class="section-single-product-page full-prod">
        <?php
        do_action('woocommerce_before_single_product');
        ?>
        <div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?> >
            <div class="container">
                <div class="row">
                    <?php
                    do_action('woocommerce_before_single_product_summary');
                    ?>

                    <div class="col-lg-6 col-md-12">

                        <div class="single-product-info-holder">
                            <div class="nav-area-holder">
                                <div class="row">
                                    <div class="col-xs-5">


                                        <div class="star-holder">
                                            <a href="#reviews" title="<?php _e('check reviews', 'cb-modello'); ?>">
                                                <?php
                                                if (get_option('woocommerce_enable_review_rating') == 'yes') {
                                                    $count = $product->get_rating_count();
                                                    if ($count > 0) {
                                                        $average = $product->get_average_rating();
                                                        $average = ceil($average);

                                                        for ($i = 1; $i < $average + 1; $i++) {
                                                            ?><img
                                                            src="<?php echo WP_THEME_URL; ?>/img/modello/star-on.png"
                                                            alt="1" ><?php
                                                        }
                                                        $fin_c = 5 - $average;
                                                        for ($i = 1; $i < $fin_c + 1; $i++) {
                                                            ?><img
                                                            src="<?php echo WP_THEME_URL; ?>/img/modello/star-off.png"
                                                            alt="1"><?php
                                                        }

                                                        /* echo '<div itemprop="aggregateRating" class="single_ratings" itemscope itemtype="http://schema.org/AggregateRating">';
                                                       // echo '<div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'woocommerce'), $average) . '"><span style="width:' . (($average / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong></span></div>';
                                                      // echo '<span class="number_reviews">' . sprintf(_n('%s review', '%s reviews', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">' . $count . '</span>', '') . '</span>';
                                                     // echo '<div class="cl"></div></div><div class="cl"></div>';*/
                                                    }
                                                } ?>
                                            </a>
                                        </div>


                                    </div>
                                    <div class="col-xs-7">
                                        <div class="next-prev">

                                            <?php
                                            $terms = wp_get_post_terms($post->ID, 'product_cat');
                                            foreach ($terms as $term) $cats_array[] = $term->term_id;

                                            // get all posts in current categories
                                            $query_args = array('posts_per_page' => -1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'product_cat',
                                                    'field' => 'id',
                                                    'terms' => $cats_array
                                                )));
                                            $r = new WP_Query($query_args);

                                            // show next and prev only if we have 3 or more
                                            if ($r->post_count > 2) {

                                                $prev_product_id = -1;
                                                $next_product_id = -1;

                                                $found_product = false;
                                                $i = 0;

                                                $current_product_index = $i;
                                                $current_product_id = get_the_ID();

                                                if ($r->have_posts()) {
                                                    while ($r->have_posts()) {
                                                        $r->the_post();
                                                        $current_id = get_the_ID();

                                                        if ($current_id == $current_product_id) {
                                                            $found_product = true;
                                                            $current_product_index = $i;
                                                        }
                                                        if (!isset($first_product_index)) $first_product_index = '';
                                                        $is_first = ($current_product_index == $first_product_index);

                                                        if ($is_first) {
                                                            $prev_product_id = get_the_ID(); // if product is first then 'prev' = last product
                                                        } else {
                                                            if (!$found_product && $current_id != $current_product_id) {
                                                                $prev_product_id = get_the_ID();
                                                            }
                                                        }

                                                        if ($i == 0) { // if product is last then 'next' = first product
                                                            $next_product_id = get_the_ID();
                                                        }

                                                        if ($found_product && $i == $current_product_index + 1) {
                                                            $next_product_id = get_the_ID();
                                                        }

                                                        $i++;
                                                    }

                                                    if ($prev_product_id != -1) {
                                                        ShowLinkToProduct($prev_product_id, $cats_array, "next-product", '<span>'.__('previous','cb-modello').'</span> /');
                                                    }
                                                    if ($next_product_id != -1) {
                                                        ShowLinkToProduct($next_product_id, $cats_array, "prev-product", ' <span>'.__('next','cb-modello').'</span>');
                                                    }

                                                    if ($prev_product_id != -1) {
                                                        ShowLinkToProduct($prev_product_id, $cats_array, "next-product fa fa-angle-left");
                                                    }
                                                    if ($next_product_id != -1) {
                                                        ShowLinkToProduct($next_product_id, $cats_array, "prev-product fa fa-angle-right");
                                                    }
                                                }

                                                wp_reset_query();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="brand">
                                <?php
                                $brand_id = get_post_meta(get_the_ID(), '_cb5_brand', true);
                                if ($brand_id != '') {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($brand_id), 'full');
                                    $url = $thumb['0'];
                                    ?>

                                    <img alt="" src="<?php echo $url; ?>"/>

                                <?php } ?>
                            </div>
                            <h1 itemprop="name" class="product_title entry-title">
                                <?php the_title(); ?>
                            </h1>
                            <?php $skus=get_option('cb5_skus'); 
                            if($skus=='yes') { 
                            	echo '<span class="sku_li">'.__('SKU:','cb-modello').$product->get_sku().'</span>';
                            }?>
                            <?php if ($product->is_type(array('simple', 'variable')) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku()) : ?>
                                <span itemprop="productID"
                                      class="sku_wrapper"><?php _e('Product ID:', 'woocommerce'); ?>
                                    <span class="sku"><?php echo $product->get_sku(); ?> </span>.</span>
                            <?php endif; ?>
                            <?php
                            do_action('woocommerce_single_product_summary');
                            ?>


                        </div>
                    </div>
                </div>


                <section class="section-review-comment">
                    <?php
                    do_action('woocommerce_after_single_product_summary');
                    ?>

                </section>

            </div>
        </div>
    </section>

    <!-- #product-<?php the_ID(); ?> -->
<?php
} else {


    ?>
    <section class="section-single-product-page sidebar-single-page">
    <div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="container">
    <div class="row">
    <div class="col-xs-12 col-md-9">
        <div class="row">
            <?php
            /**
             * woocommerce_before_single_product hook
             *
             * @hooked woocommerce_show_messages - 10
             */
            do_action('woocommerce_before_single_product');
            ?>
            <?php
            /**
             * woocommerce_show_product_images hook
             * <div class="col-xs-6">
             * <div class="back">
             *
             * <?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Back to:', 'Back to:', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'cb-modello' ) . ' ', '</span>' ); ?>
             * </div>
             * </div>
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action('woocommerce_before_single_product_summary');
            ?>

            <div class="col-md-12 col-lg-5">

                <div class="single-product-info-holder">
                    <div class="nav-area-holder">
                        <div class="row">
                            <div class="col-xs-5">


                                <div class="star-holder">
                                    <a href="#reviews" title="<?php _e('check reviews', 'cb-modello'); ?>">
                                        <?php
                                        if (get_option('woocommerce_enable_review_rating') == 'yes') {
                                            $count = $product->get_rating_count();
                                            if ($count > 0) {
                                                $average = $product->get_average_rating();
                                                $average = ceil($average);

                                                for ($i = 1; $i < $average + 1; $i++) {
                                                    ?><img src="<?php echo WP_THEME_URL; ?>/img/modello/star-on.png"
                                                           alt="1" ><?php
                                                }
                                                $fin_c = 5 - $average;
                                                for ($i = 1; $i < $fin_c + 1; $i++) {
                                                    ?><img src="<?php echo WP_THEME_URL; ?>/img/modello/star-off.png"
                                                           alt="1"><?php
                                                }

                                                /* echo '<div itemprop="aggregateRating" class="single_ratings" itemscope itemtype="http://schema.org/AggregateRating">';
                                               // echo '<div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'woocommerce'), $average) . '"><span style="width:' . (($average / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong></span></div>';
                                              // echo '<span class="number_reviews">' . sprintf(_n('%s review', '%s reviews', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">' . $count . '</span>', '') . '</span>';
                                             // echo '<div class="cl"></div></div><div class="cl"></div>';*/
                                            }
                                        } ?>
                                    </a>
                                </div>


                            </div>
                            <div class="col-xs-7">
                                <div class="next-prev">

                                    <?php
                                    $terms = wp_get_post_terms($post->ID, 'product_cat');
                                    foreach ($terms as $term) $cats_array[] = $term->term_id;

                                    // get all posts in current categories
                                    $query_args = array('posts_per_page' => -1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'id',
                                            'terms' => $cats_array
                                        )));
                                    $r = new WP_Query($query_args);

                                    // show next and prev only if we have 3 or more
                                    if ($r->post_count > 2) {

                                        $prev_product_id = -1;
                                        $next_product_id = -1;

                                        $found_product = false;
                                        $i = 0;

                                        $current_product_index = $i;
                                        $current_product_id = get_the_ID();

                                        if ($r->have_posts()) {
                                            while ($r->have_posts()) {
                                                $r->the_post();
                                                $current_id = get_the_ID();

                                                if ($current_id == $current_product_id) {
                                                    $found_product = true;
                                                    $current_product_index = $i;
                                                }
                                                if (!isset($first_product_index)) $first_product_index = '';
                                                $is_first = ($current_product_index == $first_product_index);

                                                if ($is_first) {
                                                    $prev_product_id = get_the_ID(); // if product is first then 'prev' = last product
                                                } else {
                                                    if (!$found_product && $current_id != $current_product_id) {
                                                        $prev_product_id = get_the_ID();
                                                    }
                                                }

                                                if ($i == 0) { // if product is last then 'next' = first product
                                                    $next_product_id = get_the_ID();
                                                }

                                                if ($found_product && $i == $current_product_index + 1) {
                                                    $next_product_id = get_the_ID();
                                                }

                                                $i++;
                                            }
                                            if ($prev_product_id != -1) {
                                            	ShowLinkToProduct($prev_product_id, $cats_array, "next-product", '<span>'.__('previous','cb-modello').'</span> /');
                                            }
                                            if ($next_product_id != -1) {
                                            	ShowLinkToProduct($next_product_id, $cats_array, "prev-product", ' <span>'.__('next','cb-modello').'</span>');
                                            }

                                            if ($prev_product_id != -1) {
                                                ShowLinkToProduct($prev_product_id, $cats_array, "next-product fa fa-angle-left");
                                            }
                                            if ($next_product_id != -1) {
                                                ShowLinkToProduct($next_product_id, $cats_array, "prev-product fa fa-angle-right");
                                            }
                                        }

                                        wp_reset_query();
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="brand">
                        <?php
                        $brand_id = get_post_meta(get_the_ID(), '_cb5_brand', true);
                        if ($brand_id != '') {
                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($brand_id), 'full');
                            $url = $thumb['0'];
                            ?>

                            <img alt="" src="<?php echo $url; ?>"/>

                        <?php } ?>
                    </div>
                    <h1 itemprop="name" class="product_title entry-title">
                        <?php the_title(); ?>
                    </h1>
                            <?php $skus=get_option('cb5_skus'); 
                            if($skus=='yes') { 
                            	echo '<span class="sku_li">'.__('SKU:','cb-modello').$product->get_sku().'</span>';
                            }?>


                    <?php if ($product->is_type(array('simple', 'variable')) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku()) : ?>
                        <span itemprop="productID"
                              class="sku_wrapper"><?php _e('Product ID:', 'woocommerce'); ?>
                            <span class="sku"><?php echo $product->get_sku(); ?> </span>.</span>
                    <?php endif; ?>
                    <?php
                    /**
                     * woocommerce_single_product_summary hook
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     */
                    do_action('woocommerce_single_product_summary');
                    ?>

                </div>
            </div>
        </div>

        <section class="section-review-comment">
            <?php
            /**
             * woocommerce_after_single_product_summary hook
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_output_related_products - 20
             */
            do_action('woocommerce_after_single_product_summary');
            ?>

        </section>
    </div>
    <?php if ($cb_sidebars['sidebar_position'] == 'right') { ?>
<style>section.section-related-products.single-product-page.arle {
margin-right: -285px;
}</style>
    <?php } ?>

    </div>


    </div>
    </div>
    </section>


<?php
} ?>
<?php do_action('woocommerce_after_single_product'); ?>