<?php

//let's remove those wrappers for shops

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// and add ours
add_action( 'woocommerce_before_main_content', 'trizzy_output_content_wrapper', 10 );
add_action( 'woocommerce_after_main_content', 'trizzy_output_content_wrapper_end', 10 );

function trizzy_output_content_wrapper(){
     echo '';
}

function trizzy_output_content_wrapper_end(){
     echo '';
}

// move breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'trizzy_woocommerce_breadcrumb', 'woocommerce_breadcrumb', 10 );



// remove products counter
remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );

remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary','woocommerce_template_single_rating', 30 );


remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail', 10 );


add_action( 'woocommerce_before_shop_loop_item_title', 'trizzy_before_shop_loop_item_title');

function trizzy_before_shop_loop_item_title(){
      global $product;
    if ( !$product->is_in_stock() ) {
        echo '<span class="onsale soldout">'; _e('Sold Out','trizzy'); echo '</span>';
    }
}
// fixing categories widget to match HTML from Trizzy HTML
add_filter('woocommerce_product_categories_widget_args', 'trizzy_product_category_widget',10,3);

function trizzy_product_category_widget($list_args){
    $list_args['walker'] = new TrizzyWC_Product_Cat_List_Walker;
    return $list_args;
}

class TrizzyWC_Product_Cat_List_Walker extends Walker {

    var $tree_type = 'product_cat';
    var $db_fields = array ( 'parent' => 'parent', 'id' => 'term_id', 'slug' => 'slug' );

    /**
     * @see Walker::start_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of category. Used for tab indentation.
     * @param array $args Will only append content if style argument value is 'list'.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] )
            return;

        $indent = str_repeat("\t", $depth);
        $output .= "$indent<ul class='children'>\n";
    }

    /**
     * @see Walker::end_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of category. Used for tab indentation.
     * @param array $args Will only append content if style argument value is 'list'.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] )
            return;

        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    /**
     * @see Walker::start_el()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $category Category data object.
     * @param int $depth Depth of category in reference to parents.
     * @param integer $current_object_id
     */
    public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
        $output .= '<li class="cat-item cat-item-' . $cat->term_id;

        if ( $args['current_category'] == $cat->term_id ) {
            $output .= ' current-cat';
        }

        if ( $args['has_children'] && $args['hierarchical'] ) {
            $output .= ' cat-parent';
        }

        if ( $args['current_category_ancestors'] && $args['current_category'] && in_array( $cat->term_id, $args['current_category_ancestors'] ) ) {
            $output .= ' current-cat-parent';
        }

        $output .=  '"><a href="' . get_term_link( (int) $cat->term_id, 'product_cat' ) . '">' . __( $cat->name, 'woocommerce' );

        if ( $args['show_count'] ) {
            $output .= ' <span class="count">(' . $cat->count . ')</span>';
        }
        $output .=  '</a>';
    }
    /**
     * @see Walker::end_el()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $page Not used.
     * @param int $depth Depth of category. Not used.
     * @param array $args Only uses 'list' for whether should append to output.
     */
    public function end_el( &$output, $cat, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }

}


// Fixing breadcrumbs
add_filter( 'woocommerce_breadcrumb_defaults', 'trizzy_woocommerce_breadcrumbs' );
function trizzy_woocommerce_breadcrumbs() {

    return array(
            'delimiter'   => ' ',
            'wrap_before' => '<nav id="breadcrumbs" itemprop="breadcrumb"><ul>',
            'wrap_after'  => '</ul></nav>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Shop', 'breadcrumb', 'trizzy' ),
        );
}

// not sure if that works
add_filter('single_product_small_thumbnail_size','trizzy_category_thumbnails_size');
function trizzy_category_thumbnails_size($size){
    return 'shop_catalog';
}


/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'astrum_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes for woocommerce
 */
function astrum_woocommerce_image_dimensions() {
    $catalog = array(
        'width'     => '420',   // px
        'height'    => '535',   // px
        'crop'      => 1        // true
        );

    $single = array(
        'width'     => '560',   // px
        'height'    => '632',   // px
        'crop'      => 1        // true
        );

    $thumbnail = array(
        'width'     => '130',   // px
        'height'    => '130',   // px
        'crop'      => 0        // false
        );

    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
    update_option( 'shop_single_image_size', $single );         // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
}


// single product
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash');

function trizzy_add_section_start($html){
    $html = '<section class="linking">';
    echo $html;
}
add_action( 'woocommerce_single_product_summary', 'trizzy_add_section_start',  25 );

function trizzy_add_section_end($html){
    $html = '</section>';
    echo $html;
}
add_action( 'woocommerce_single_product_summary', 'trizzy_add_section_end',  35 );


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    ob_start();
    ?>
     <div class="cart-btn">
        <a href="#" class="button adc"><?php echo WC()->cart->get_cart_subtotal(); ?></a>
    </div>
    <?php

    $fragments['div.cart-btn'] = ob_get_clean();
    return $fragments;
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_summary_fragment');
function woocommerce_header_add_to_cart_summary_fragment( $fragments ) {
    global $woocommerce;

    ob_start();
    ?>
    <div class="cart-amount">
        <span><?php echo sprintf(_n('%d item', '%d items', WC()->cart->cart_contents_count, 'trizzy'), WC()->cart->cart_contents_count);?> <?php _e('in the shopping cart','trizzy') ?></span>
    </div>
    <?php

    $fragments['div.cart-amount'] = ob_get_clean();
    return $fragments;
}


add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_content_fragment');
function woocommerce_header_add_to_cart_content_fragment( $fragments ) {
    global $woocommerce;

    ob_start();?>

        <ul>
        <?php
        if (sizeof($woocommerce->cart->cart_contents)>0) :
            foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                $_product = $cart_item['data'];
                if ($_product->exists() && $cart_item['quantity']>0) :
                   echo '<li class="cart_list_product"><a href="' . esc_url( get_permalink( intval( $cart_item['product_id'] ) ) ) . '">';
                   //echo $_product->get_image();
                   echo get_the_post_thumbnail( $_product->id, 'cart-square-thumb');
                   echo apply_filters( 'woocommerce_cart_widget_product_title', $_product->get_title(), $_product ) . '</a>';
                   if($_product instanceof woocommerce_product_variation && is_array($cart_item['variation'])) :
                       echo woocommerce_get_formatted_variation( $cart_item['variation'] );
                     endif;
                   echo '<span class="quantity">' . $cart_item['quantity'] . ' &times; ' . woocommerce_price( $_product->get_price() ) . '</span></li>';
                endif;
            endforeach;
        else:
            echo '<li class="empty">' . __( 'No products in the cart.', 'trizzy' ) . '</li>';
        endif; ?>
        </ul>

    <?php $fragments['div.cart-list ul'] = ob_get_clean();
    return $fragments;
}

add_filter( 'woocommerce_pagination_args','trizzy_woocommerce_pagination_args',10);
function trizzy_woocommerce_pagination_args($array) {
    $array['prev_text'] = '';
    $array['next_text'] = '';
    return $array;
}


 function trizzy_wishlist_get_share_links( $url ) {
        $normal_url = $url;
        $url = urlencode( $url );
        $title = urlencode( get_option( 'yith_wcwl_socials_title' ) );
        $twitter_summary = str_replace( '%wishlist_url%', '', get_option( 'yith_wcwl_socials_text' ) );
        $summary = urlencode( str_replace( '%wishlist_url%', $normal_url, get_option( 'yith_wcwl_socials_text' ) ) );
        $imageurl = urlencode( get_option( 'yith_wcwl_socials_image_url' ) );

        $html  = '<div class="share-buttons margin-top-35">';
        $html .= '<ul>';
        $html .= ' <li class="active"><a href="#" class="">' . __( 'Share', 'trizzy' ) . '</a></li>';

        if( get_option( 'yith_wcwl_share_fb' ) == 'yes' )
        { $html .= '<li class="share-facebook" style="display: none;"><a target="_blank" href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=' . $title . '&amp;p[url]=' . $url . '&amp;p[summary]=' . $summary . '&amp;p[images][0]=' . $imageurl . '" title="' . __( 'Facebook', 'trizzy' ) . '">Facebook</a></li>'; }

        if( get_option( 'yith_wcwl_share_twitter' ) == 'yes' )
        { $html .= '<li class="share-twitter" style="display: none;"><a target="_blank"  href="https://twitter.com/share?url=' . $url . '&amp;text=' . $twitter_summary . '" title="' . __( 'Twitter', 'trizzy' ) . '">Twitter</a></li>'; }

        if( get_option( 'yith_wcwl_share_pinterest' ) == 'yes' )
        { $html .= '<li class="share-pinit" style="display: none;"><a target="_blank" href="http://pinterest.com/pin/create/button/?url=' . $url . '&amp;description=' . $summary . '&media=' . $imageurl . '" onclick="window.open(this.href); return false;">Pin it</a></li>'; }

        if( get_option( 'yith_wcwl_share_googleplus' ) == 'yes' )
        { $html .= '<li  class="share-gplus" style="display: none;"><a target="_blank" href="https://plus.google.com/share?url=' . $url . '&amp;title="' . $title . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'>Google Plus</a></li>'; }

        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }

    add_filter( 'wc_add_to_cart_message', 'trizzy_add_to_cart_message', 10, 2 );
    function trizzy_add_to_cart_message($message, $product_id) {

        if ( is_array( $product_id ) ) {

            $titles = array();

            foreach ( $product_id as $id ) {
                $titles[] = get_the_title( $id );
            }

            $added_text = sprintf( __( 'Added &quot;%s&quot; to your cart.', 'woocommerce' ), join( __( '&quot; and &quot;', 'woocommerce' ), array_filter( array_merge( array( join( '&quot;, &quot;', array_slice( $titles, 0, -1 ) ) ), array_slice( $titles, -1 ) ) ) ) );

        } else {
            $added_text = sprintf( __( '&quot;%s&quot; was successfully added to your cart.', 'woocommerce' ), get_the_title( $product_id ) );
        }

    // Output success messages
        if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) :

            $return_to  = apply_filters( 'woocommerce_continue_shopping_redirect', wp_get_referer() ? wp_get_referer() : home_url() );

        $message    = sprintf('<a href="%s" class=" wc-forward">%s</a> %s', $return_to, __( 'Continue Shopping &rarr;', 'woocommerce' ), $added_text );

        else :

            $message    = sprintf('<a href="%s" class=" wc-forward">%s</a> %s', get_permalink( wc_get_page_id( 'cart' ) ), __( 'View Cart &rarr;', 'trizzy' ), $added_text );

        endif;

        return $message;
    }


function trizzy_remove__widget() {
    unregister_widget('WC_Widget_Recent_Reviews');
}
add_action( 'widgets_init', 'trizzy_remove__widget' );

/* Search box */

class Incremental_Suggest {

    static function on_load() {

        add_action( 'init', array( __CLASS__, 'init' ) );
    }

    static function init() {


        //add_action( 'get_search_form', array( __CLASS__, 'get_search_form' ) );
        add_action( 'wp_print_footer_scripts', array( __CLASS__, 'wp_print_footer_scripts' ), 11 );
        add_action( 'wp_ajax_incremental_suggest', array( __CLASS__, 'wp_ajax_incremental_suggest' ) );
        add_action( 'wp_ajax_nopriv_incremental_suggest', array( __CLASS__, 'wp_ajax_incremental_suggest' ) );
        wp_enqueue_script( 'suggest' );
    }


    //static function get_search_form( $form ) {



      //  return $form;
    //}

    static function wp_print_footer_scripts() {

        ?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#s').suggest('<?php echo admin_url( 'admin-ajax.php' ); ?>' + '?action=incremental_suggest');
        });
    </script><?php
    }

    static function wp_ajax_incremental_suggest() {
        // Default ordering args
        $posts = get_posts( array(
            's'             => $_REQUEST['q'],
            'post_type'     => 'product',
            'post_status'   => 'publish',
            'meta_query'            => array(
                array(
                    'key'           => '_visibility',
                    'value'         => array('catalog', 'visible'),
                    'compare'       => 'IN'
                )
            ),
        ));

        $titles = wp_list_pluck( $posts, 'post_title' );
        $titles = array_map( 'esc_html', $titles );
        echo implode( "\n", $titles );
       /* if(empty($titles)) {
        echo "Nothing found";
        }*/
        die;
    }
}

Incremental_Suggest::on_load();



function trizzy_advanced_search_query($q) {

    if ( ! $q->is_main_query() ) return;
    if ( ! $q->is_post_type_archive() ) return;

    if ( ! is_admin() && is_shop() ) {
        if(isset($_GET['trizzy_search'])) {
            // get array of $_GET for custom ps
            $woo_search_attributes = ot_get_option('pp_woosearch_attr',array());


            if( isset($_GET['trizzy_product_cat']) ){
                if( is_array($_GET['trizzy_product_cat'])) {
                    $cat = implode(',',$_GET['trizzy_product_cat']);
                } else {
                    $cat = $_GET['trizzy_product_cat'];
                }

               $q->set('product_cat', $cat);
               /* $q->set( 'tax_query', array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => $cat, // Don't display products in the membership category on the shop page . For multiple category , separate it with comma.
                
                    )));*/

            }
            $customattr = array();
            foreach ($woo_search_attributes as $attr) {
                if( isset($_GET['trizzy_'.$attr]) ){
                       $customattr[] = array(
                            'taxonomy' => $attr,
                            'field' => 'slug',
                            'terms' =>  $_GET['trizzy_'.$attr],
                            'include_children' => false,
                            'operator' => 'IN'
                            );
                }
            }
            if(!empty( $customattr)) {
                $q->set('tax_query', array(array(
                            'relation' => 'AND',
                            $customattr,
                )));
            }
         

        }
    }

    return $q;
}
add_action('pre_get_posts', 'trizzy_advanced_search_query', 10);


/**
 * Add more descriptive page title to some taxonomy term
 *
 * @param string $title    Page title.
 * @param string $sep      Title separator.
 * @return string
 **/
function trizzy_fix_woo_title( $title, $sep = null ) {

    if ( is_search() ) {
        $query_search = get_search_query();

        if( isset($_GET['s']) && empty($_GET['s'])) {
            $page_title = __( 'Search Results', 'trizzy' );
        } else {
            $page_title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'trizzy' ), get_search_query() );
        }
        if ( get_query_var( 'paged' ) )
            $page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'trizzy' ), get_query_var( 'paged' ) );

    } elseif ( is_tax() ) {

        $page_title = single_term_title( "", false );

    } else {

        $shop_page_id = wc_get_page_id( 'shop' );
        $page_title   = get_the_title( $shop_page_id );

    }



    return $title;
}

add_filter( 'woocommerce_page_title', 'trizzy_fix_woo_title',10,2 );


function trizzy_woocommerce_page_title(){
      if ( is_search() ) {
        if( isset($_GET['s']) && empty($_GET['s'])) {
            $page_title = __( 'Search Results', 'trizzy' );
        } else {
          $page_title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'trizzy' ), get_search_query() );
        }
          if ( get_query_var( 'paged' ) )
              $page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'trizzy' ), get_query_var( 'paged' ) );
      } elseif ( is_tax() ) {
         $page_title = sprintf( __( 'Category: %s', 'trizzy' ), single_term_title( "", false ) );
      } else {
         $page_title   = __('All products','trizzy');
      }
      return $page_title;
  }

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
    global $post;
    $layout = get_post_meta($post->ID, 'pp_sidebar_layout', TRUE); ;

    if($layout == 'full-width') {
        $args['columns'] = 4; // arranged in 2 columns
        $args['posts_per_page'] = 4; // 4 related products
    } else {
        $args['columns'] = 3; // arranged in 2 columns
        $args['posts_per_page'] = 3; // 4 related products
    }
    return $args;
}

function trizzy_products_per_page( $args ) {
    $products = ot_get_option('pp_wooitems');
    return $products;
}
add_filter( 'loop_shop_per_page', 'trizzy_products_per_page', 20 );



add_filter( 'woocommerce_available_variation', 'my_variation', 10, 3);
function my_variation( $data, $product, $variation ) {
    $attachment_id = get_post_thumbnail_id( $variation->get_variation_id() );
    $attachment    = wp_get_attachment_image_src( $attachment_id,  'shop-small-thumb' );
    $data['image_thumb'] = $attachment[0];
    return $data;
}


add_action( 'init', 'trizzy_price_filter_init');
function trizzy_price_filter_init() {
    if( is_active_widget( false, false, 'woocommerce_price_filter', true ) ){

    } else {
        if ( ot_get_option('pp_woosearch_price_on','off') == 'on' && !is_admin() ) {
            $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
            wp_register_script( 'wc-jquery-ui-touchpunch', WC()->plugin_url() . '/assets/js/frontend/jquery-ui-touch-punch' . $suffix . '.js', array( 'jquery-ui-slider' ), WC_VERSION, true );
            wp_register_script( 'wc-price-slider', WC()->plugin_url() . '/assets/js/frontend/price-slider' . $suffix . '.js', array( 'jquery-ui-slider', 'wc-jquery-ui-touchpunch' ), WC_VERSION, true );
            wp_localize_script( 'wc-price-slider', 'woocommerce_price_slider_params', array(
                'currency_symbol'   => get_woocommerce_currency_symbol(),
                'currency_pos'      => get_option( 'woocommerce_currency_pos' ),
                'min_price'         => isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '',
                'max_price'         => isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : ''
            ) );
            wp_enqueue_script('wc-price-slider');

            add_filter( 'loop_shop_post_in', 'trizzy_price_filter' );
        }
    }
}

 function trizzy_price_filter( $filtered_posts = array() ) {
        global $wpdb;

        if ( isset( $_GET['max_price'] ) || isset( $_GET['min_price'] ) ) {

            $matched_products = array();
            $min              = isset( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : 0;
            $max              = isset( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : 9999999999;

            $matched_products_query = apply_filters( 'woocommerce_price_filter_results', $wpdb->get_results( $wpdb->prepare( '
                SELECT DISTINCT ID, post_parent, post_type FROM %1$s
                INNER JOIN %2$s ON ID = post_id
                WHERE post_type IN ( "product", "product_variation" )
                AND post_status = "publish"
                AND meta_key IN ("' . implode( '","', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) . '")
                AND meta_value BETWEEN %3$d AND %4$d
            ', $wpdb->posts, $wpdb->postmeta, $min, $max ), OBJECT_K ), $min, $max );

            if ( $matched_products_query ) {
                foreach ( $matched_products_query as $product ) {
                    if ( $product->post_type == 'product' ) {
                        $matched_products[] = $product->ID;
                    }
                    if ( $product->post_parent > 0 && ! in_array( $product->post_parent, $matched_products ) ) {
                        $matched_products[] = $product->post_parent;
                    }
                }
            }

            // Filter the id's
            if ( 0 === sizeof( $filtered_posts ) ) {
                $filtered_posts = $matched_products;
            } else {
                $filtered_posts = array_intersect( $filtered_posts, $matched_products );

            }
            $filtered_posts[] = 0;
        }

        return (array) $filtered_posts;
    }
?>