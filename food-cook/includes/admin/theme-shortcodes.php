<?php
/**
 * Theme-specific shortcodes.
 *
 * @package WordPress
 * @subpackage Freschi
 * @category Core
 * @author Dahz
 * @since 1.0.0
 *
 * TABLE OF CONTENTS
 *
 * 1. View Full Article
 * 2. Custom Field
 * 3. Post Date
 * 4. Post Time
 * 5. Post Author
 * 6. Post Author Link
 * 7. Post Author Posts Link
 * 8. Post Comments
 * 9. Post Tags
 * 10. Post Categories
 * 11. Post Edit
 * 12. Copyright Text
 * 13. Credit Text
 * 14. Credit Card
 * 15. Recipe Grid & Recipe List
 * 16. Recipe Slider List
 * 17. Callout & Teaser
 * 18. Google Font
 * 19. View Author
 */
/**
 * 1. View Full Article
 *
 * This function produces a link to view the full article.
 *
 * @example <code>[view_full_article]</code> is the default usage
 */
if (!function_exists('woo_shortcode_view_full_article')) {

    function woo_shortcode_view_full_article($atts) {
        $defaults = array(
            'label' => __('Read More', 'woothemes'),
            'before' => '',
            'after' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        $atts = array_map('wp_kses_post', $atts);

        $output = sprintf('<span class="read-more">%1$s<a href="%3$s" title="%4$s">%4$s</a>%2$s</span> ', $atts['before'], $atts['after'], get_permalink(get_the_ID()), $atts['label']);
        return apply_filters('woo_shortcode_view_full_article', $output, $atts);
    }

// End woo_shortcode_view_full_article()
}

add_shortcode('view_full_article', 'woo_shortcode_view_full_article');

/**
 * 2. Custom Field
 *
 * This function produces the value of a specified custom field.
 *
 * @example <code>[woo_custom_field name="test"]</code> is the default usage
 */
if (!function_exists('woo_shortcode_custom_field')) {

    function woo_shortcode_custom_field($atts) {
        $defaults = array(
            'name' => '',
            'before' => '',
            'after' => '',
            'id' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        $post_id = get_the_ID();
        if (is_numeric($id)) {
            $post_id = $atts['id'];
        }

        $custom_field = get_post_meta($post_id, $atts['name'], true);

        $output = '';

        if ($custom_field) {
            $output = esc_attr($custom_field);
        }
        return apply_filters('woo_shortcode_custom_field', $output, $atts);
    }

// End woo_shortcode_custom_field()
}

add_shortcode('custom_field', 'woo_shortcode_custom_field');

/**
 * 3. Post Date
 *
 * This function produces the date the post in question was published.
 *
 * @example <code>[post_date]</code> is the default usage
 */
if (!function_exists('woo_shortcode_post_date')) {

    function woo_shortcode_post_date($atts) {
        $defaults = array(
            'format' => get_option('date_format'),
            'before' => '',
            'after' => '',
            'label' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        $output = sprintf('<abbr class="date time published" title="%5$s" itemprop="datePublished">%1$s%3$s%4$s%2$s</abbr> ', $atts['before'], $atts['after'], $atts['label'], get_the_time($atts['format']), get_the_time('Y-m-d\TH:i:sO'));
        return apply_filters('woo_shortcode_post_date', $output, $atts);
    }

// End woo_shortcode_post_date()
}

add_shortcode('post_date', 'woo_shortcode_post_date');

/**
 * 4. Post Time
 *
 * This function produces the time the post in question was published.
 *
 * @example <code>[post_time]</code> is the default usage
 * @example <code>[post_time format="g:i a" before="<b>" after="</b>"]</code>
 */
if (!function_exists('woo_shortcode_post_time')) {

    function woo_shortcode_post_time($atts) {
        $defaults = array(
            'format' => get_option('time_format'),
            'before' => '',
            'after' => '',
            'label' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        $output = sprintf('<abbr class="time published" title="%5$s">%1$s%3$s%4$s%2$s</abbr> ', $atts['before'], $atts['after'], $atts['label'], get_the_time($atts['format']), get_the_time('Y-m-d\TH:i:sO'));
        return apply_filters('woo_shortcode_post_time', $output, $atts);
    }

// End woo_shortcode_post_time()
}

add_shortcode('post_time', 'woo_shortcode_post_time');

/**
 * 5. Post Author
 *
 * This function produces the author of the post (display name)
 *
 * @example <code>[post_author]</code> is the default usage
 * @example <code>[post_author before="<b>" after="</b>"]</code>
 */
if (!function_exists('woo_shortcode_post_author')) {

    function woo_shortcode_post_author($atts) {
        $defaults = array(
            'before' => '',
            'after' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        $output = sprintf('<span class="author vcard">%2$s<span class="fn">%1$s</span>%3$s</span>', esc_html(get_the_author()), $atts['before'], $atts['after']);
        return apply_filters('woo_shortcode_post_author', $output, $atts);
    }

// End woo_shortcode_post_author()
}

add_shortcode('post_author', 'woo_shortcode_post_author');

/**
 * 6. Post Author Link
 *
 * This function produces the author of the post (link to author URL)
 *
 * @example <code>[post_author_link]</code> is the default usage
 * @example <code>[post_author_link before="<b>" after="</b>"]</code>
 */
if (!function_exists('woo_shortcode_post_author_link')) {

    function woo_shortcode_post_author_link($atts) {
        $defaults = array(
            'nofollow' => FALSE,
            'before' => '',
            'after' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        $author = get_the_author();

        //	Link?
        if ('' != get_the_author_meta('url')) {
            //	Build the link
            $author = '<a href="' . get_the_author_meta('url') . '" title="' . esc_attr(sprintf(__('Visit %s&#8217;s website', 'woothemes'), $author)) . '" rel="external">' . $author . '</a>';
        }

        $output = sprintf('<span class="author vcard">%2$s<span class="fn">%1$s</span>%3$s</span>', $author, $atts['before'], $atts['after']);
        return apply_filters('woo_shortcode_post_author_link', $output, $atts);
    }

// End woo_shortcode_post_author_link()
}

add_shortcode('post_author_link', 'woo_shortcode_post_author_link');

/**
 * 7. Post Author Posts Link
 *
 * This function produces the display name of the post's author, with a link to their
 * author archive screen.
 *
 * @example <code>[post_author_posts_link]</code> is the default usage
 * @example <code>[post_author_posts_link before="<b>" after="</b>"]</code>
 */
if (!function_exists('woo_shortcode_post_author_posts_link')) {

    function woo_shortcode_post_author_posts_link($atts) {
        $defaults = array(
            'before' => '',
            'after' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        // Darn you, WordPress!
        ob_start();
        the_author_posts_link();
        $author = ob_get_clean();

        $output = sprintf('<span class="author vcard">%2$s<span class="fn">%1$s</span>%3$s</span>', $author, $atts['before'], $atts['after']);
        return apply_filters('woo_shortcode_post_author_posts_link', $output, $atts);
    }

// End woo_shortcode_post_author_posts_link()
}

add_shortcode('post_author_posts_link', 'woo_shortcode_post_author_posts_link');

/**
 * 8. Post Comments
 *
 * This function produces the comment link, or a message if comments are closed.
 *
 * @example <code>[post_comments]</code> is the default usage
 * @example <code>[post_comments zero="No Comments" one="1 Comment" more="% Comments"]</code>
 */
if (!function_exists('woo_shortcode_post_comments')) {

    function woo_shortcode_post_comments($atts) {
        global $post;

        $defaults = array(
            'zero' => __(' 0 Comments ', 'woothemes'),
            'one' => __('1 Comments', 'woothemes'),
            'more' => __('% Comments', 'woothemes'),
            'hide_if_off' => 'enabled',
            'closed_text' => apply_filters('woo_post_more_comment_closed_text', __('Comments are closed', 'woothemes')),
            'before' => '',
            'after' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        if ((!get_option('woo_comments') || !comments_open() ) && $atts['hide_if_off'] === 'enabled')
            return;

        if ($post->comment_status == 'open') {
            // Darn you, WordPress!
            ob_start();
            comments_number($atts['zero'], $atts['one'], $atts['more']);
            $comments = ob_get_clean();
            $comments = sprintf('<a href="%s">%s</a>', get_comments_link(), $comments);
        } else {
            $comments = $atts['closed_text'];
        }

        $output = sprintf('<div class="fa fa-comment"> </div><span class="post-comments comments">%2$s%1$s%3$s</span>', $comments, $atts['before'], $atts['after']);
        return apply_filters('woo_shortcode_post_comments', $output, $atts);
    }

// End woo_shortcode_post_comments()
}

add_shortcode('post_comments', 'woo_shortcode_post_comments');

/**
 * 9. Post Tags
 *
 * This function produces a collection of tags for this post, linked to their
 * appropriate archive screens.
 *
 * @example <code>[post_tags]</code> is the default usage
 * @example <code>[post_tags sep=", " before="Tags: " after="bar"]</code>
 */
if (!function_exists('woo_shortcode_post_tags')) {

    function woo_shortcode_post_tags($atts) {
        $defaults = array(
            'sep' => ', ',
            'before' => __('Tags: ', 'woothemes'),
            'after' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        $tags = get_the_tag_list($atts['before'], trim($atts['sep']) . ' ', $atts['after']);

        if (!$tags)
            return;

        $output = sprintf('<p class="tags icon">%s</p> ', $tags);
        return apply_filters('woo_shortcode_post_tags', $output, $atts);
    }

// End woo_shortcode_post_tags()
}

add_shortcode('post_tags', 'woo_shortcode_post_tags');

/**
 * 10. Post Categories
 *
 * This function produces the category link list
 *
 * @example <code>[post_categories]</code> is the default usage
 * @example <code>[post_categories sep=", "]</code>
 */
if (!function_exists('woo_shortcode_post_categories')) {

    function woo_shortcode_post_categories($atts) {
        $defaults = array(
            'sep' => ', ',
            'before' => '',
            'after' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        $cats = get_the_category_list(trim($atts['sep']) . ' ');

        $cats = str_replace(' rel="category tag"', '', $cats);

        $output = sprintf('<span class="categories">%2$s%1$s%3$s</span> ', $cats, $atts['before'], $atts['after']);
        return apply_filters('woo_shortcode_post_categories', $output, $atts);
    }

// End woo_shortcode_post_categories()
}

add_shortcode('post_categories', 'woo_shortcode_post_categories');

/**
 * 11. Post Edit
 *
 * This function produces the "edit post" link for logged in users.
 *
 * @example <code>[post_edit]</code> is the default usage
 * @example <code>[post_edit link="Edit", before="<b>" after="</b>"]</code>
 */
if (!function_exists('woo_shortcode_post_edit')) {

    function woo_shortcode_post_edit($atts) {
        $defaults = array(
            'link' => __('Edit', 'woothemes'),
            'before' => '',
            'after' => ''
        );
        $atts = shortcode_atts($defaults, $atts);

        // Darn you, WordPress!
        ob_start();
        edit_post_link($atts['link'], $atts['before'], $atts['after']); // if logged in
        $edit = ob_get_clean();

        $output = $edit;
        return apply_filters('woo_shortcode_post_edit', $output, $atts);
    }

// End woo_shortcode_post_edit()
}

add_shortcode('post_edit', 'woo_shortcode_post_edit');
/**
 * 12. Copyright Text
 *
 * This function produces the default footer copyright text.
 *
 * @example <code>[site_copyright]</code> is the default usage
 */
if (!function_exists('dahz_shortcode_site_copyright')) {

    function dahz_shortcode_site_copyright($atts) {
        $defaults = array(
            'before' => '<p>',
            'after' => '</p>'
        );
        $atts = shortcode_atts($defaults, $atts);

        $output = sprintf('%1$s%3$s %4$s %5$s %2$s', $atts['before'], $atts['after'], "&copy; " . date('Y'), get_bloginfo('name') . '.', __('All Rights Reserved.', 'woothemes'));
        return apply_filters('dahz_shortcode_site_copyright', $output, $atts);
    }

// End woo_shortcode_site_copyright()
}

add_shortcode('site_copyright', 'dahz_shortcode_site_copyright');

/**
 * 13. Credit Text
 *
 * This function produces the default footer credit text.
 *
 * @example <code>[site_credit]</code> is the default usage
 */
if (!function_exists('dahz_shortcode_site_credit')) {

    function dahz_shortcode_site_credit($atts) {
        $defaults = array(
            'before' => '<p>',
            'after' => '</p>'
        );
        $atts = shortcode_atts($defaults, $atts);

        $output = sprintf('%1$s%3$s %4$s %5$s %6$s%2$s', $atts['before'], $atts['after'], __('Powered by', 'woothemes'), 'Wordpress' . '.', __('Designed by', 'woothemes'), 'Dahz');
        return do_shortcode(apply_filters('dahz_shortcode_site_credit', $output, $atts));
    }

// End woo_shortcode_site_credit()
}

add_shortcode('site_credit', 'dahz_shortcode_site_credit');

/**
 *  14. Credit Card
 *
 *    Show the icons for the credit cards
 *
 * @example
 *   [credit cards="paypal,visa,mastercard,amex,cirrus"]
 * */
function woo_credit_card_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'cards' => 'paypal,visa,mastercard,amex,cirrus'
                    ), $atts));

    $cards = explode(',', $cards);

    $html = '';
    foreach ($cards as $card) {
        $card = trim($card);
        $html .= "<img src=\"" . get_template_directory_uri() . "/includes/assets/images/credit-cards/$card.png\" alt=\"$card\" style=\"margin-right:8px\" />";
    }

    return '<span>' . $html . '</span>';
}

add_shortcode('credit', 'woo_credit_card_sc');

/**
 * PRODUCT SLIDER
 *
 * @description
 *    Add a product slider
 *
 * @example
 *   [product_slider cat=""]
 *
 * @attr
 *   id - the id of product
 * */
if (class_exists('woocommerce')) {

    function shop_product_slider_sc($atts, $content = null) {

        extract(shortcode_atts(array(
            'orderby' => 'date',
            'order' => 'desc',
            'columns' => 12,
            'number' => '',
            'cat' => '',
            'style' => '',
            'title' => ''
                        ), $atts));


        global $wpdb, $woocommerce, $product, $woocommerce_loop;


        $woocommerce_loop['columns'] = $columns;

        if (isset($atts['latest']) && $atts['latest']) {
            $orderby = 'date';
            $order = 'desc';
        }

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'ignore_sticky_posts' => 1,
            'orderby' => $orderby,
            'order' => $order,
            'meta_query' => array(
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            )
        );

        if (isset($atts['featured']) && $atts['featured']) {
            $args['meta_query'][] = array(
                'key' => '_featured',
                'value' => 'yes'
            );
        }

        if (isset($atts['best_sellers']) && $atts['best_sellers']) {
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value';
            $args['order'] = 'desc';
        }

        if (isset($atts['skus'])) {
            $skus = explode(',', $atts['skus']);
            $skus = array_map('trim', $skus);
            $args['meta_query'][] = array(
                'key' => '_sku',
                'value' => $skus,
                'compare' => 'IN'
            );
        }

        if (isset($atts['ids'])) {
            $ids = explode(',', $atts['ids']);
            $ids = array_map('trim', $ids);
            $args['post__in'] = $ids;
        }

        if (!empty($cat)) {
            $tax = 'product_cat';
            $cat = array_map('trim', explode(',', $cat));
            if (count($cat) == 1)
                $cat = $cat[0];
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $tax,
                    'field' => 'slug',
                    'terms' => $cat
                )
            );
        }

        $woocommerce_loop['setLast'] = true;
        ob_start();
        $products = new WP_Query($args);
        $id = mt_rand(99, 9999);
        if ($products->have_posts()) {
            echo ' <script>
 jQuery(window).load(function(){
 	var carousel = jQuery(".items-carousel-' . $id . '");
    carousel.carouFredSel({
                responsive: true,
                width: \'100%\',
                height: "variable",
                auto : false,
                circular    : true,
                infinite    : true,
                prev : "#items_carousel_prev-' . $id . '",
                next : "#items_carousel_next-' . $id . '",
                scroll: 2,
                swipe: {
                        onTouch: false,
                        onMouse: true,
                        easing : \'swing\',
                },
                mousewheel  : {
        items           : 1,
        easing          : \'swing\',
    },

                items: {
                width: \'230\',
                height: "variable",
                    visible: {
                        min: 1,
                        max: 4
                        }

                }

            },      {
                                                wrapper: {
                                 element         : "div",
                                 classname       : "wrapper",
                              },

                    });
  });
    </script>';

            echo '<h3 class="product-title-slider-sc">' . $title . '</h3>';
            echo '<div id="products-carousel">';
            echo '<ul class="products items-carousel-' . $id . '">';
            while ($products->have_posts()) : $products->the_post();

                wc_get_template_part( 'content', 'product' );

            endwhile; // end of the loop.

            echo '</ul>';
            echo '<div class="clearfix"></div>';
            echo '<a class="prev" id="items_carousel_prev-' . $id . '" href="#"><span>prev</span></a>';
            echo '<a class="next" id="items_carousel_next-' . $id . '" href="#"><span>next</span></a>';
            echo '</div>';
        }
        $html = ob_get_contents();
        ob_end_clean();

        wp_reset_query();
        wp_reset_postdata();
        remove_filter('posts_clauses', array($woocommerce->query, 'order_by_rating_post_clauses'));


        return $html;
    }

}
add_shortcode('product_slider', 'shop_product_slider_sc');

/**
 * 15. Recipe Grid & Recipe List
 *
 * @description
 *    show the recipe
 * @example
 *   [recipe_grid post_page="" categories="" taxonomy="" orderby="" order=""]
 *   [recipe_list post_page=""  categories="" taxonomy="" orderby="" order=""]
 * @attr
 *   per_page  - the title of the box
 *   description - the text below title
 * */
// function recipe_single_sc( $atts ) {
//     if ( empty( $atts ) ) { return; }

//     extract( shortcode_atts( array(
//         'id'    => '',
//         'style' => 'list'
//     ), $atts ) );

//     global $post;

//     $args = array(
//         'post_type'           => 'recipe',
//         'post_status'         => 'publish',
//         'posts_per_page'      => '-1',
//         'ignore_sticky_posts' => 1,
//         'post__in'            => array( $id )
//     );

//     query_posts( $args );

//     ob_start();

//     $qu = new WP_Query( $args );

//     if ( $qu->have_posts() ) :  Check if have post

//         while ( $qu->have_posts() ) : $qu->the_post(); /* Looping posts */

//             if ( $style == 'list' ) :
//                 dahz_get_template( 'content', 'content-recipelist' );
//             else :
//                 dahz_get_template( 'content', 'content-recipe' );
//             endif;

//         endwhile; /* End looping posts */

//     endif; /* End check if have post */

//     wp_reset_postdata();
//     wp_reset_query();

//     echo '<div class="fix"></div>';

//     return ob_get_clean();
// }

// add_shortcode( 'recipe_single', 'recipe_single_sc' );

function recipe_grid_sc( $atts ) {

    if ( empty( $atts ) ) { return; }

    extract( shortcode_atts( array(
        'post_page'  => '12',
        'orderby'    => 'title',
        'order'      => 'asc',
        'categories' => 'all',
        'taxonomy'   => '',
        'ids'        => '',
    ), $atts ) );

    if ($ids != '') {
        $ids = explode(',', $ids);
    }
    global $post;
    $args = array(
        'post_type' => 'recipe',
        'post_status' => 'publish',
        'posts_per_page' => $post_page,
        'ignore_sticky_posts' => 1,
        'orderby' => $orderby,
        'order' => $order,
        'post__in' => $ids,

    );
    if ($taxonomy == 'ingredient') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'ingredient',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }

    if ($taxonomy == 'recipe_type') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'recipe_type',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    if ($taxonomy == 'cuisine') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'cuisine',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    if ($taxonomy == 'course') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'course',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }

    if ($taxonomy == 'skill_level') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'skill_level',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    if ($taxonomy == 'calories') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'calories',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    query_posts($args);
    ob_start();

    $qu = new WP_Query($args);

    if ($qu->have_posts()):

        echo '<div class="recipe-content">';

        while ($qu->have_posts()) :

            $qu->the_post();

            dahz_get_template( 'content', 'content-recipe' );


        endwhile;

        echo '</div>';

    endif;
    wp_reset_query();

    return ob_get_clean();
}

add_shortcode('recipe_grid', 'recipe_grid_sc');

function recipe_list_sc($atts) {


    if (empty($atts))
        return;

    extract(shortcode_atts(array(
        'post_page' => '12',
        'orderby' => 'title',
        'order' => 'asc',
        'categories' => 'all',
        'taxonomy' => '',
        'ids' => ''
                    ), $atts));

    global $post;
    if ($ids != '') {
        $ids = explode(',', $ids);
    }
    $args = array(
        'post_type' => 'recipe',
        'post_status' => 'publish',
        'posts_per_page' => $post_page,
        'orderby' => $orderby,
        'order' => $order,
        'post__in' => $ids,
    );


    if ($taxonomy == 'ingredient') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'ingredient',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }

    if ($taxonomy == 'recipe_type') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'recipe_type',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    if ($taxonomy == 'cuisine') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'cuisine',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    if ($taxonomy == 'course') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'course',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }

    if ($taxonomy == 'skill_level') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'skill_level',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    if ($taxonomy == 'calories') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);


            $args['tax_query'][] = array(
                'taxonomy' => 'calories',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }

    query_posts($args);

    ob_start();
    $qu = new WP_Query($args);
    if ($qu->have_posts())
        while ($qu->have_posts()) :
            $qu->the_post();
            dahz_get_template( 'content', 'content-recipelist' );

        endwhile;

    wp_reset_query();

    return ob_get_clean();
}

add_shortcode('recipe_list', 'recipe_list_sc');

/**
 * Recipe Slider list
 *
 * @description
 *    show the recipe
 * @example
 *   [recipe_slider per_page="" tax="" categories="" taxonomy="" orderby="" order=""]
 *
 * @attr
 *   per_page  - the title of the box
 *   description - the text below title
 * */
function recipe_slider_sc($atts) {
    global $post;

    if (empty($atts))
        return;

    extract(shortcode_atts(array(
        'version' => '1',
        'tax' => '',
        'per_page' => '4',
        'orderby' => 'title',
        'order' => 'asc',
        'categories' => 'all',
        'taxonomy' => '',

    ), $atts));

    $args = array(
        'post_type' => 'recipe',
        'post_status' => 'publish',
        'posts_per_page' => $per_page,
        'orderby' => $orderby,
        'order' => $order
    );

    if ($taxonomy == 'ingredient') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);

            $args['tax_query'][] = array(
                'taxonomy' => 'ingredient',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }

    if ($taxonomy == 'recipe_type') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);

            $args['tax_query'][] = array(
                'taxonomy' => 'recipe_type',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    if ($taxonomy == 'cuisine') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);

            $args['tax_query'][] = array(
                'taxonomy' => 'cuisine',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    if ($taxonomy == 'course') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);

            $args['tax_query'][] = array(
                'taxonomy' => 'course',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }

    if ($taxonomy == 'skill_level') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);

            $args['tax_query'][] = array(
                'taxonomy' => 'skill_level',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }
    if ($taxonomy == 'calories') {
        if ($categories != 'all') {

            // string to array
            $str = $categories;
            $arr = explode(',', $str);

            $args['tax_query'][] = array(
                'taxonomy' => 'calories',
                'field' => 'slug',
                'terms' => $arr
            );
        }
    }

    query_posts($args);
    ob_start();

    $slider_query = new WP_Query($args);

    if ($version == '1'):
        echo "<section class='slider'><div class='sh-banner'></div><div class='sc-rlp-slider-1'>";

        if ( $slider_query->have_posts() ) :
            while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                <div id="post-<?php the_ID(); ?>">
                <?php
                    $terms              = get_the_terms( $post->ID, 'cuisine' );
                    if ( $terms && !is_wp_error( $terms ) ) :
                        $output_cat_recipe = get_the_term_list( $post->ID, 'cuisine', __('In ', 'woothemes'), ', ', '') . ' | ';
                    endif;

                    get_the_image(array(
                        'order' => array('featured', 'default'),
                        'featured' => true,
                        'default' => esc_url(get_template_directory_uri() . '/includes/assets/images/image.jpg'),
                        'size' => 'thumbnail-blog',
                        'link_to_post' => false,
                        'before' => '<div class="content-full-sh-img">',
                        'after' => '</div>'
                    )); ?>

                    <div class="sh-slide">
                        <div class="content-full-sh">
                            <p class="feat-rec"><?php _e('Featured Recipes', 'woothemes') ?></p>
                            <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                            <div class="box-info-list">
                                <div class="rating">
                                    <?php woo_fnc_the_recipe_rating($post->ID); ?>
                                    <span><?php echo woo_fnc_get_avg_rating($post->ID); ?> <?php esc_html_e( 'of 5', 'woothemes' ); ?></span>

                                    <?php
                                    $cook_time  = woo_fnc_convert_to_hours( get_post_meta( $post->ID, 'RECIPE_META_cook_time', true ) );
                                    $yield      = get_post_meta( $post->ID, 'RECIPE_META_yield', true ); ?>

                                    <?php if ( !empty( $cook_time ) ) : ?>
                                        <span class="value"><em class="fa fa-time"></em>   <?php echo $cook_time; ?> <?php _e('Minutes', 'woothemes'); ?> </span>
                                    <?php endif; ?>

                                    <?php if ( !empty( $yield ) ) : ?>
                                        <span class="value"><em class="fa fa-cutlery"></em>   <?php echo $yield; ?>  </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <p><?php echo woo_fnc_word_trim( get_the_excerpt(), 30, ' ... ' ); ?><a href="<?php the_permalink(); ?>"><?php _e('Read more', 'woothemes'); ?></a></p>

                            <div class="post-meta">
                                <span class="small" itemprop="datePublished"><?php _e('on ', 'post datetime', 'woothemes'); ?></span>
                                <?php echo do_shortcode('[post_date after=" |"]'); ?>
                                <?php echo $output_cat_recipe; ?>
                                <span class="small"><?php _e('By', 'woothemes'); ?> </span> <?php echo do_shortcode('[post_author_posts_link after=" | "]') . do_shortcode('[post_comments]') . do_shortcode('[post_edit]'); ?></div>
                            </div>
                        </div>
                    </div>
      <?php endwhile;
        endif;

        echo '</div></section>';
    else:
        echo "<section class='slider'><div class='sc-rlp-slider-2'>";

        if ( $slider_query->have_posts() ) :
            while ($slider_query->have_posts()) : $slider_query->the_post();
                dahz_get_template( 'content', 'content-recipelist' );
            endwhile;
        endif;
        echo '</div></section>';
    endif;

    wp_reset_query();

    return ob_get_clean();
}

add_shortcode('recipe_slider', 'recipe_slider_sc');

/**
 *  17. Callout & Teaser
 *
 *   Show the callout and teaser
 *
 * @example
 *   [teaser img="your-image-url"]
 *   [teaserbox title="" button="" link="" buttonsize="" buttoncolor="" target="_blank"]Your Content[/teaserbox]
 *   [callout]
 *   [box][/box]
 * */
function woo_teaser_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'img' => ''
                    ), $atts));

    if ($img == '') {
        $return = "";
    } else {
        $return = "<div class='teaser-img'><img src='" . $img . "' /></div>";
    }

    return '<div class="teaser">' . $return . '' . do_shortcode($content) . '</div>';
}

/* ----------------------------------------------------------------------------------- */

function woo_teaserbox_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'button' => '',
        'buttonsize' => 'normal',
        'buttoncolor' => '',
        'buttonbackground' => '',
        'link' => '',
        'bgcolor' => '',
        'bgimage'   => '',
        'repeat' => 'no-repeat',
        'target' => '_self',
        'background_size' => '',
                    ), $atts));

    $style = '';
    if ( $bgimage != '' ) {
        $style = 'style="background:url(' . $bgimage . ')' . $repeat . ' top left; background-size:' . $background_size . '"';
    } elseif ( $bgimage == '' ) {
        $style = 'style="background:' . $bgcolor . '"';
    }

    return '<div class="teaserbox" ' . $style . '><div class="inner"><h2 class="highlight">' . $title . '</h2>' . do_shortcode($content) . '<br /><a class="button ' . $buttonsize . ' " style="color:' . $buttoncolor . '!important;background-color:' . $buttonbackground . ' !important;" href="' . $link . '" target="' . $target . '">' . $button . '</a></div></div>';
}

/* ----------------------------------------------------------------------------------- */

function woo_callout_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'button' => '',
        'buttonsize' => 'normal',
        'buttoncolor' => '',
        'buttonbackground' => '',
        'link' => '',
        'background' => '',
        'target' => '_self',
        'buttonmargin' => '0px'
                    ), $atts));
    return '<div class="callout" style="background:' . $background . ' !important;"><div class="inner fix"><div class="callout-content">
      				<h2 class="highlight">' . $title . '</h2>' . do_shortcode($content) . '
      			</div><div class="callout-button" style="margin:' . $buttonmargin . ';">
      				<a class="button ' . $buttonsize . ' " style="color:' . $buttoncolor . '!important;background-color:' . $buttonbackground . ' !important;" href="' . $link . '" target="' . $target . '">' . $button . '</a>
      			</div></div></div>';
}

function woo_box_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'style' => '1'
                    ), $atts));
    return '<div class="description fix style-' . $style . '">' . do_shortcode($content) . '</div>';
}

/**
 * 18. Google Font
 *
 * Show the Google Font
 *
 * @example
 * [googlefont font="" size="" margin="20px 0 10px 0"]Your Text...[/googlefont]
 * */
function woo_googlefont_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'font' => 'Open Sans',
        'size' => '36px',
        'margin' => '0px',
        'float' => '',
        'color' => '',
        'align' => ''
                    ), $atts));

    $google = preg_replace("/ /", "+", $font);

    return '<link href="http://fonts.googleapis.com/css?family=' . $google . '" rel="stylesheet" type="text/css">
      			<div class="googlefont" style="font-family:\'' . $font . '\', serif !important; font-size:' . $size . ' !important; margin: ' . $margin . ' !important;float:' . $float . ';color:' . $color . ';text-align:' . $align . ';">' . do_shortcode($content) . '</div>';
}

/* ----------------------------------------------------------------------------------- */
/* Testimonial
  /*----------------------------------------------------------------------------------- */

function woo_testimonial_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'author' => '',
        'img' => ''
                    ), $atts));
    return '<div class="testimonial"><em>' . do_shortcode($content) . '</em></div><div class="testimonial-img"><img src="' . $img . '"></div><div class="testimonial-author">' . $author . '</div><div class="clear"></div>';
}

add_shortcode('testimonial', 'woo_testimonial_sc');

/* ----------------------------------------------------------------------------------- */
/* 	Lists
  /*----------------------------------------------------------------------------------- */

function woo_list_style_sc($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));
    $out = '<ul class="styled-list">' . do_shortcode($content) . '</ul>';
    return $out;
}

add_shortcode('list', 'woo_list_style_sc');
/* ----------------------------------------------------------------------------------- */

function woo_item_list_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'icon' => 'ok'
                    ), $atts));
    $out = '<li><i class="fa fa-' . $icon . '"></i>' . do_shortcode($content) . '</li>';
    return $out;
}

add_shortcode('list_item', 'woo_item_list_sc');
/* ----------------------------------------------------------------------------------- */
/* 	Member
  /*----------------------------------------------------------------------------------- */

function woo_member_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'img' => '',
        'name' => '',
        'role' => '',
        'twitter' => '',
        'facebook' => '',
        'google' => '',
        'linkedin' => '',
        'mail' => '',
                    ), $atts));

    if ($img == '') {
        $return = "";
    } else {
        $return = "<img src='" . $img . "' />";
    }

    if ($twitter != '' || $facebook != '' || $skype != '' || $google != '' || $linkedin != '' || $mail != '') {
        $return7 = '<div class="member-social"><ul>';
        $return8 = '</ul></div>';

        if ($twitter != '') {
            $return2 = '<li><a href="' . $twitter . '" class="fa fa-twitter" target="_blank" title="Twitter"></a></li>';
        } else {
            $return2 = '';
        }

        if ($facebook != '') {
            $return3 = '<li><a href="' . $facebook . '" target="_blank" class="fa fa-facebook" title="Facebook"></a></li>';
        } else {
            $return3 = '';
        }

        if ($google != '') {
            $return4 = '<li><a href="' . $google . '" target="_blank" class="fa fa-google-plus" title="Google+"></a></li>';
        } else {
            $return4 = '';
        }


        if ($linkedin != '') {
            $return5 = '<li><a href="' . $linkedin . '" target="_blank" class="fa fa-linkedin" title="Linkedin"></a></li>';
        } else {
            $return5 = '';
        }

        if ($mail != '') {
            $return6 = '<li><a href="mailto:' . $mail . '" class="fa fa-envelope" title="Mail"></a></li>';
        } else {
            $return6 = '';
        }
    } else {
        $return2 = '';
        $return3 = '';
        $return4 = '';
        $return5 = '';
        $return6 = '';
        $return7 = '';
        $return8 = '';
    }
    return '<div class="member"><div class="member-image">' . $return . '' . $return7 . '' . $return2 . '' . $return3 . '' . $return4 . '' . $return5 . '' . $return6 . '' . $return8 . '</div>
      	<h4>' . $name . '</h4>
      	<h3 class="member-role">' . $role . '</h3>' . do_shortcode($content) . '</div>';
}

/* ----------------------------------------------------------------------------------- */
/* 	Latest Blog
  /*----------------------------------------------------------------------------------- */

function woo_bloglist_sc($atts) {
    extract(shortcode_atts(array(
        'posts' => '4',
        'title' => 'Latest Blog Entries',
        'show_title' => 'yes',
        'categories' => ''
    ), $atts));

    global $post;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $posts,
        'order'          => 'DESC',
        'orderby'        => 'date',
        'post_status'    => 'publish'
    );

    if ($categories != '') {
        // string to array
        $str = $categories;
        $arr = explode(',', $str);

        $args['tax_query'] = array(
            'taxonomy'  => 'category',
            'field'     => 'slug',
            'terms'     => $arr
        );
    }

    query_posts($args);
    $out = '';



    if (have_posts()) :

        if ($show_title == 'yes') {
            $out .= '<h3 class="blog-title-sc">' . $title . '</h3>';
        }

        while (have_posts()) : the_post();
            $blog_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array(60, 60));
            $out .= '<div class="latest-blog-list clearfix">
					<div class="blog-list-item-description">';
            if (has_post_thumbnail()) {
                $out .= '<div class="blog-list-image">
		<img src="' . $blog_thumbnail[0] . '" width="' . $blog_thumbnail[1] . '" height="' . $blog_thumbnail[2] . '" class="thumbnail">
		</div>';
            }
            $out .= '<h4 class="title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h4>
		<div class="post-meta">
		<span class="small"><div class="fa fa-calendar"></div> ' . do_shortcode('[post_date]') . '<span class="vertical-bar">&#124; </span> ' . do_shortcode('[post_comments]') . '</span></div>
					</div>
					</div>';

        endwhile;

        $out .='<div class="clear"></div>';

        wp_reset_postdata();

    endif;

    return $out;
}

add_shortcode('bloglist', 'woo_bloglist_sc');

/* ----------------------------------------------------------------------------------- */
/* 	Latest Blog
  /*----------------------------------------------------------------------------------- */
if (!function_exists('blogpost_reset_loop')) {

    /**
     * Reset the loop's index and columns when we're done outputting a product loop.
     *
     * @access public
     * @subpackage	Loop
     * @return void
     */
    function blogpost_reset_loop() {
        global $blogpost_loop;
        // Reset loop/columns globals when starting a new loop
        $blogpost_loop['loop'] = $blogpost_loop['columns'] = '';
    }

}
add_filter('loop_end', 'blogpost_reset_loop');

function woo_blog_sc($atts) {
    extract(shortcode_atts(array(
        'posts'         => '4',
        'title'         => 'Latest From The Blog',
        'show_title'    => 'yes',
        'categories'    => '',
        'columns'       => '3'
    ), $atts ) );

    global $post, $blogpost_loop;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $posts,
        'order'          => 'DESC',
        'category_name'   => $categories,
        'orderby'        => 'date',
        'post_status'    => 'publish'
    );

    if ($categories != '') {
        // string to array
        $str = $categories;
        $arr = explode(',', $str);

        $args['tax_query'] = array(
            'taxonomy'  => 'category',
            'field'     => 'slug',
            'terms'     => $arr
        );
    }

    $cstm_query = new WP_Query($args);
    $out = '';


    if ($cstm_query->have_posts()) :

        if ($show_title == 'yes') {
            $out .= '<h3 class="blog-title-sc">' . $title . '</h3>';
        }

        $out .= '<div class="latest-blog">';

        while ($cstm_query->have_posts()) : $cstm_query->the_post();

            $blog_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog-grid-thumb-sc');

            $out .= '<div class="blog-item columns">';

            if (has_post_thumbnail()) {
                $out .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '" class="blog-img"><img src="' . $blog_thumbnail[0] . '" class="thumbnail"/><div class="blog-overlay">';

                if (has_post_format('audio')) {
                    $out .= '<span class="post-icon audio"></span>';
                }
                if (has_post_format('gallery')) {
                    $out .= '<span class="post-icon imagegallery"></span>';
                }
                if (has_post_format('link')) {
                    $out .= '<span class="post-icon link"></span>';
                }
                if (has_post_format('quote')) {
                    $out .= '<span class="post-icon quote"></span>';
                }
                if (has_post_format('video')) {
                    $out .= '<span class="post-icon video"></span>';
                }
                if (get_post_format() == false) {
                    $out .= '<span class="post-icon standard"></span>';
                }

                $out .= '</div></a>';
            }

            $out .= '<div class="blog-item-description">
			<h4 class="title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h4>
			<div class="post-meta">
			<span class="small"><div class="fa fa-calendar"></div> ' . do_shortcode('[post_date after=" |"]') . do_shortcode('[post_comments]') . '</span></div>
			<div class="blog-list-item-excerpt"><p>' . woo_fnc_word_trim(get_the_excerpt(), '15') . '... </p><div class="post-more">' . do_shortcode('[view_full_article]') . '</div></div>
					</div>';

            $out .='<div class="blog-border"></div></div>';

        endwhile;

        $out .='</div>';

        wp_reset_postdata();

    endif;

    return $out;
}

add_shortcode('blog', 'woo_blog_sc');

/* linked */

function woo_linked_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => 'See all',
        'link' => '',
        'color' => '#bf9764',
                    ), $atts));

    return '<div class="linked-more"><a href="' . $link . '" style="color:' . $color . ';"><span>' . $title . '</span></a></div>';
}

add_shortcode('linked_more', 'woo_linked_sc');

/* ----------------------------------------------------------------------------------- */
/* Toggle */
/* ----------------------------------------------------------------------------------- */

function woo_toggles_sc($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'icon' => '',
        'open' => "false"
                    ), $atts));

    if ($icon == '') {
        $return = "";
    } else {
        $return = "<i class='fa fa-" . $icon . "'></i>";
    }

    if ($open == "true") {
        $return2 = "onacc";
    } else {
        $return2 = '';
    }

    return '<div class="accordionButton ' . $return2 . '"><h4>' . $return . '' . $title . '</h4></div><div class="accordionContent"><p>' . do_shortcode($content) . '</p></div>';
}

/* ----------------------------------------------------------------------------------------------------- */

add_shortcode('teaserbox', 'woo_teaserbox_sc');
add_shortcode('teaser', 'woo_teaser_sc');
add_shortcode('callout', 'woo_callout_sc');
add_shortcode('box', 'woo_box_sc');

add_shortcode('googlefont', 'woo_googlefont_sc');

add_shortcode('member', 'woo_member_sc');
add_shortcode('toggles', 'woo_toggles_sc');

/* ------------------------------------------------------------------------------------------------- */

/* ------------------------------------------------------------------------*
 * MISC
 * ------------------------------------------------------------------------ */

// [ingredients] short code
function show_ingredients($atts, $content = null) {

    extract(
            shortcode_atts(array(
        'title' => ''
                    ), $atts));

    global $post;

    $ingredients = get_post_meta($post->ID, 'RECIPE_META_ingredients');
    $ingredients_count = count($ingredients[0]);


    if (empty($title)) {
        $ingredients_html = '<h3>' . __('Ingredients', 'woothemes') . '</h3>';
    } else {
        $ingredients_html = '<h3>' . $title . '</h3>';
    }

    if ($ingredients_count >= 1) {
        $ingredients_html .= '<ul class="ingre">';

        foreach ($ingredients as $key) {
            $ingredients_html .= '<li itemprop="ingredients">'.implode('</li><li itemprop="ingredients">', $key). '</li>';
        }

        $ingredients_html .= '</ul>';
    } else {
        $ingredients_html .= '<p>' . __('No Ingredients Found ! ', 'woothemes') . '</p>';
    }

    return $ingredients_html;
}

add_shortcode('ingredients', 'show_ingredients');

// [method] short code
function show_method_steps($atts, $content = null) {

    extract(
            shortcode_atts(array(
        'title' => __('Instructions', 'woothemes')
                    ), $atts));

    global $post;

    $method_steps = get_post_meta($post->ID, 'RECIPE_META_method_steps');

    $steps_count = count($method_steps[0]);

    if (empty($title)) {
        $method_html = '<h3>' . __('Method', 'woothemes') . '</h3>';
    } else {
        $method_html = '<h3>' . $title . '</h3>';
    }
    if ($steps_count >= 1) {
        $method_html .= "<ol class='method_step' itemprop='recipeInstructions'>";

        foreach ($method_steps as $key) {

            $method_html .= '<li>'.implode('</li><li>', $key). '</li>';
        }
        $method_html .= "</ol>";
    } else {
        $method_html .= '<p>' . __('No Steps Found ! ', 'woothemes') . '</p>';
    }
    return $method_html;
}

add_shortcode('method', 'show_method_steps');

/**
 * 19. View Author
 *
 * @description
 *    show the author
 * @example
 *   [author text="" title="The Author" show_title="yes" num="2" role=""]
 *
 * @attr
 *   per_page  - the title of the box
 *   description - the text below title
 * */
function show_author_sc( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'text'        => '',
        'title'       => 'The Author',
        'show_title'  => 'yes',
        'num'         => '2',
        'role'        => ''
    ), $atts));

    ob_start();
    global $woo_options, $wpdb;

    if ( $show_title == 'yes' ) {
        echo '<h3 class="blog-title-sc">' . $title . '</h3>';
    }

    echo "<ul class='authorlist'>";

    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    }

    $paged = 1;
    $user_list = woo_get_users($num, $paged, $role);
    $count = 0;

    foreach ($user_list as $author) {

        if (get_the_author_meta('exclude', $author->ID) != 1) {
            /* custom profile fields */

            $count++;
            echo "<li>";
            echo "<a href=\"" . get_bloginfo('url') . "/?author=";
            echo $author->ID;
            echo "\">";
            echo get_avatar($author->ID);
            echo "</a>";
            echo '<div>';
            echo "<a title='" . get_the_author_meta('display_name', $author->ID) . "' href=\"" . get_bloginfo('url') . "/?author=";
            echo $author->ID;
            echo "\">";
            the_author_meta('display_name', $author->ID);
            echo "</a>";
            echo "</div>";
            echo "</li>";
        } // End If Statement
    } // End For Loop
    echo "</ul>";
    echo "<div class='fix'></div><p>" . $text . "</p>";
    return ob_get_clean();
}

add_shortcode('author', 'show_author_sc');

/**
 * 20.Parallax bg
 *
 * Show Parallax bg
 *
 * @example
 *
 *
 *   [parallax img_bg="" height="" padding=""  width="" width="" img_pos="" speed="" float=""] your content [/parallax]
 * */
function parallax_sc( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'img_bg'    => '',
        'height'    => '480px',
        'padding'   => '20px 0',
        'width'     => '100%',
        'class'     => 'parout',
        'img_pos'   => '50%',
        'speed'     => '0.5',
    ), $atts ) );

    $var = '.' . $class;
    ?>

    <script>
        jQuery(document).ready(function($) {

            var fullscreenPar = jQuery('.one-col #parallax .parallax_out'),
                    containerPar = jQuery('#main, #main-shop'),
                    ParOffsetl = containerPar.offset().left,
                    containerPar2 = jQuery('#parallax .parallax_content'),
                    windowWidth = jQuery(window).width();




            $('<?php echo $var; ?>').parallax('<?php echo $img_pos; ?>', '<?php echo $speed; ?>');



            totwidthl = ParOffsetl;

            fullscreenPar.find('.one-col #parallax .parallax_out').css('width', windowWidth);

            fullscreenPar.css('margin-left', '-' + totwidthl + 'px');
            fullscreenPar.css("padding-right", function(index) {

                totwidth = ParOffsetl + ParOffsetl;
                return  totwidth;

            });
            containerPar2.css('padding-left', ParOffsetl);




        });

    </script>
    <?php
    // wp_enqueue_script('parallax');

    $out = '<div id="parallax" ><div class="parallax_out ' . $class . '" style="background: url(' . $img_bg . ')50% 0 no-repeat fixed;  height:' . $height . ';">
 <div class="parallax_content">

  <div class="parallax_in" style="padding:' . $padding . ';">'
            . do_shortcode($content) .
            '</div>

</div>
</div>

  </div>';
    return $out;
}

add_shortcode('parallax', 'parallax_sc');

function facebook_login_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'text' => 'Login / Register with Facebook',
                    ), $atts));
    ob_start();
    global $post;
    ?>
    <a href="<?php echo wp_login_url(); ?>?loginFacebook=1&redirect=<?php echo the_permalink(); ?>"  class="button facebook-button" onclick="window.location = '<?php echo wp_login_url(); ?>?loginFacebook=1&redirect=' + window.location.href;
                return false;"><i class="fa fa-facebook"></i> <?php echo $text; ?></a>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

add_shortcode('facebook_login_button', 'facebook_login_shortcode');


/* ----------------------------------------------------------------------------------- */
/*  Gap Dividers
  /*----------------------------------------------------------------------------------- */

function woo_gap_sc($atts, $content = null) {

    extract(shortcode_atts(array(
        'height' => '20'
                    ), $atts));

    if ($height == '') {
        $return = '';
    } else {
        $return = 'style="height: ' . $height . 'px;"';
    }

    return '<div class="clear"></div><div class="gap" ' . $return . '></div>';
}

add_shortcode('gap', 'woo_gap_sc');

/* ----------------------------------------------------------------------------------- */
/*  Gap Dividers
  /*----------------------------------------------------------------------------------- */

function woo_full_width_wrap_sc($atts, $content = null) {

    extract(shortcode_atts(array(
        'background' => '#fcfcfc',
        'padding_left' => '',
        'padding_right' => '',
        'height' => '80px'
                    ), $atts));

//       if($height == '') {
//       $return = '';
//     }
//     else{
//       $return = 'style="height: '.$height.'px;"';
//     }

    return '<div style="overflow:hidden;margin-left:-1000px;padding:0 1000px;width: 100%;"><div class="full-width-wrap" style="background:' . $background . ';padding-left:' . $padding_left . ';padding-right:' . $padding_right . ';min-height:' . $height . ';">' . do_shortcode($content) . '</div></div>';
}

//add_shortcode( 'full_width', 'woo_full_width_wrap_sc' );



/* ----------------------------------------------------------------------------------- */
/* Add TinyMCE Buttons to Editor */
/* ----------------------------------------------------------------------------------- */
add_action('init', 'add_button');

function add_button() {
    global $pagenow;

    if ((current_user_can('edit_posts') && current_user_can('edit_pages') ) && get_user_option('rich_editing') == 'true' && ( in_array($pagenow, array('post.php', 'post-new.php', 'page-new.php', 'page.php')) )) {
        add_filter('mce_external_plugins', 'add_plugin');
        add_filter('mce_buttons_3', 'register_button_3');
        add_filter('mce_buttons_4', 'register_button_4');
    }
}

// Define Position of TinyMCE Icons
function register_button_3($buttons) {
    array_push($buttons, "teaser", "teaserbox", "iconbox", "member", "skill", "blog", "bloglist", "testimonial", "recipe_grid", "recipe_list", /* "recipe_single", */ "recipe_slider", "product_slider", "author", "callout", "gap");
    return $buttons;
}

function register_button_4($buttons) {
    array_push($buttons, "toggles", "tooltip", "list", "linked_more", "googlefont", "twocol_one", "threecol_one", "threecol_two", "fourcol_one", "fourcol_three", "fivecol_one", "parallax", "facebooklogin", "creditcard");
    return $buttons;
}

function add_plugin($plugin_array) {
    $plugin_array['creditcard'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['list'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['member'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['socialmedia'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    // $plugin_array['recipe_single'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['recipe_grid'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['recipe_list'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['recipe_slider'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['product_slider'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['toggles'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['linked_more'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['googlefont'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['author'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['twocol_one'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['threecol_one'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['threecol_two'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['fourcol_one'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['fourcol_three'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['fivecol_one'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['teaser'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['teaserbox'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['callout'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['blog'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['bloglist'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['testimonial'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['parallax'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['facebooklogin'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';
    $plugin_array['gap'] = get_template_directory_uri() . '/includes/admin/extensions/tinymce/tinymce.js';

    return $plugin_array;
}
?>