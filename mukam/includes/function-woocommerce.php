<?php 
if (is_plugin_active('js_composer/js_composer.php')) {
add_action( 'init', 'jk_remove_wc_breadcrumbs' );
function jk_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

/* Position of Single Product Page */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function mukam_add_to_cart() {
    global $woocommerce;
    
    ob_start();
    
    ?>
    <div class="shopping hidden-xs hidden-sm"><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><div class="shopping-cart"><i class="mukam-shop"></i></div></a><div class="shopping-hover-cart"><i class="mukam-shop pull-left"></i><p><?php echo __('Shopping Cart', 'mukam');?></p><span>(<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>) <?php echo __('Cart Subtotal:', 'mukam');?> <?php echo $woocommerce->cart->get_cart_total(); ?></span></div></div>
   
    <?php
    
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    
}

function mukam_add_to_cart_mobil() {
    global $woocommerce;
    
    ob_start();
    
    ?>
    <div class="shopping hidden-md hidden-lg"><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><div class="shopping-cart"><i class="mukam-shop"></i></div></a> </div>
    <?php
    
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
    function woocommerce_single_variation_add_to_cart_button() {
        global $product;
        ?>
        <div class="variations_button">
            <?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
            <button type="submit" class="single_add_to_cart_button buton b_inherit buton-2 buton-large"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
            <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
            <input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
            <input type="hidden" name="variation_id" class="variation_id" value="" />
        </div>
        <?php
    }
/* Recent Products sho */
function mukam_shop_recent( $atts ) {

        global $woocommerce_loop, $woocommerce, $post;

        extract(shortcode_atts(array(
            'per_page'  => '12',
            'columns'   => '4',
            'orderby' => 'date',
            'widget_title' => '',
            'per_page' => '',
            'order' => 'desc'
        ), $atts));

        $meta_query = $woocommerce->query->get_meta_query();

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page' => $per_page,
            'orderby' => $orderby,
            'order' => $order,
            'meta_query' => $meta_query
        );

        ob_start();

        $products = new WP_Query( $args );

        $woocommerce_loop['columns'] = $columns;

        if ( $products->have_posts() ) : ?>

        <div class="latestproduct">
            <?php if ($widget_title != '') {?>
              <div class="latestproduct-title"> 
              <h3><?php echo $widget_title; ?></h3>
              <div class="double-divider"></div>
              </div>
            <?php } ?>
              <div class="latestproduct-container">
                <ul id="latestproduct-carousel">

                <?php while ( $products->have_posts() ) : $products->the_post(); 
                

            if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

                                
            global $product, $woocommerce_loop;

            // Store loop count we're currently on
            if ( empty( $woocommerce_loop['loop'] ) )
                $woocommerce_loop['loop'] = 0;

            // Store column count for displaying the grid
            if ( empty( $woocommerce_loop['columns'] ) )
                $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

            // Ensure visibility
            if ( ! $product || ! $product->is_visible() )
                return;

            // Increase loop count
            $woocommerce_loop['loop']++;

            // Extra post classes
            $classes = array();
            if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
                $classes[] = 'first';
            }
            if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ){
                $classes[] = 'last';
            }
            $classes[] = " latestproduct-item";
            ?>
            <li>
            <div  <?php post_class( $classes ); ?>>
                <div class="widget-thumb">
                <?php
                    if ( has_post_thumbnail() ) {

                        $image_title        = esc_attr( get_the_title( get_post_thumbnail_id() ) );
                        $image_link         = wp_get_attachment_url( get_post_thumbnail_id() );
                        $image              = get_the_post_thumbnail( $post->ID, 'full', array(
                            'title' => $image_title
                            ) );


                        $linky = get_permalink($post->ID);

                        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '%s',$image ), $post->ID );
                        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<span class="overthumb"></span><div class="carousel-icon"><a href="%s" data-rel="prettyPhoto" class="prettyPhoto lightzoom"><i class="mukam-search"></i></a><a href="%s" class="postlink"><i class="mukam-link"></i></a></div>', $image_link, $linky ), $post->ID );

                    } else {

                        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

                    }
                ?>
                </div>
                <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

                <a href="<?php the_permalink(); ?>">

                    <?php
                        /**
                         * woocommerce_before_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_show_product_loop_sale_flash - 10
                         * @hooked woocommerce_template_loop_product_thumbnail - 10
                         */
                        
                    ?>

                    <h4><?php the_title(); ?></h4>
                    

                    

                </a>
                <?php echo $product->get_categories( ', ', '<p>' . _n( '', '', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'woocommerce' ) . ' ', '.</p>' ); ?>
                <?php
                        /**
                         * woocommerce_after_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_template_loop_price - 10
                         */
                        ?><div class="price-rating">
                                        <div class="product-price"><p><?php echo $product->get_price_html(); ?>
                                        </p>
                                        </div>
                                        
                                        <?php
                                        if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
                                        
                                        $average = $product->get_average_rating();
                                             echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"></span></div>';
                                        }?> 
                                                            
                                        <div class="clearfix"></div>
                          </div>
                          <div class="clearfix"></div>  
                        <?php
                ?>
                <div class="addtocart">
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                </div>

            </div>
            </li>
                <?php endwhile; // end of the loop. ?>
                </ul>
                <div class="clearfix"></div>
                  <a class="prev" href="#"><span><i class="icon-angle-left icon-3x"></i></span></a>
                  <a class="next" href="#"><span><i class="icon-angle-right icon-3x"></i></span></a>
              </div>
            </div>          

        <?php endif;

        wp_reset_postdata();

        return '<div class="woocommerce">' . ob_get_clean() . '</div>';
    }
    add_shortcode('mukam_shop_last', 'mukam_shop_recent');

    wpb_map( array(
   "name" => __("Shop Recent Products", 'mukam'),
   "base" => "mukam_shop_last",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array( 
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "widget_title",
        "value" => __("Title", 'mukam'),
        "description" => __("Title of Recent Products", 'mukam')
    ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Items", 'mukam'),
        "param_name" => "per_page",
        "value" => __("5", 'mukam'),
        "description" => __("How many items do you want to show in carousel?", 'mukam')
    )    
   )
) );

/* Recent Products */

function mukam_featured_products( $atts ) {

        global $woocommerce_loop;

        extract(shortcode_atts(array(
            'per_page'  => '12',
            'columns'   => '4',
            'orderby' => 'date',
            'widget_title' => '',
            'per_page' => '',            
            'order' => 'desc'
        ), $atts));

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page' => $per_page,
            'orderby' => $orderby,
            'order' => $order,
            'meta_query' => array(
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                ),
                array(
                    'key' => '_featured',
                    'value' => 'yes'
                )
            )
        );

        ob_start();

        $products = new WP_Query( $args );

        $woocommerce_loop['columns'] = $columns;

        if ( $products->have_posts() ) : ?>
        <div class="featuredproduct-title">
                  <h3><?php echo $widget_title; ?></h3>
                  <div class="double-divider"></div>
                  <div class="clearfix"></div>
                  </div>
                <div class="featuredproduct-item-container">
                <?php while ( $products->have_posts() ) : $products->the_post(); 

                if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

                ?><?php                    
                global $product, $woocommerce_loop, $post;

                // Store loop count we're currently on
                if ( empty( $woocommerce_loop['loop'] ) )
                    $woocommerce_loop['loop'] = 0;

                // Store column count for displaying the grid
                if ( empty( $woocommerce_loop['columns'] ) )
                    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

                // Ensure visibility
                if ( ! $product || ! $product->is_visible() )
                    return;

                // Increase loop count
                $woocommerce_loop['loop']++;

                // Extra post classes
                $classes = array();
                if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
                    $classes[] = 'first';
                }
                if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
                    $classes[] = 'last';
                }
                $classes[] = "featuredproduct-item";
                ?>

                <div  <?php post_class( $classes ); ?>>
                    <div class="widget-thumb">
                    <?php
                        if ( has_post_thumbnail() ) {

                            $image_title        = esc_attr( get_the_title( get_post_thumbnail_id() ) );
                            $image_link         = wp_get_attachment_url( get_post_thumbnail_id() );
                            $image              = get_the_post_thumbnail( $post->ID, 'full', array(
                                'title' => $image_title
                                ) );


                            $linky = get_permalink($post->ID);

                            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '%s',$image ), $post->ID );
                            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<span class="overthumb"></span><div class="carousel-icon"><a href="%s" data-rel="prettyPhoto" class="prettyPhoto lightzoom"><i class="mukam-search"></i></a><a href="%s" class="postlink"><i class="mukam-link"></i></a></div>', $image_link, $linky ), $post->ID );

                        } else {

                            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

                        }
                    ?>
                    </div>
                    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

                    <a href="<?php the_permalink(); ?>">

                        <?php
                            /**
                             * woocommerce_before_shop_loop_item_title hook
                             *
                             * @hooked woocommerce_show_product_loop_sale_flash - 10
                             * @hooked woocommerce_template_loop_product_thumbnail - 10
                             */
                            
                        ?>

                        <h4><?php the_title(); ?></h4>
                        

                        

                    </a>
                    <?php echo $product->get_categories( ', ', '<p>' . _n( '', '', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'woocommerce' ) . ' ', '.</p>' ); ?>
                    <?php
                            /**
                             * woocommerce_after_shop_loop_item_title hook
                             *
                             * @hooked woocommerce_template_loop_price - 10
                             */
                            ?><div class="price-rating">
                                            <div class="product-price"><p><?php echo $product->get_price_html(); ?>
                                            </p>
                                            </div>
                                            
                                            <?php
                                            if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
                                            
                                            $average = $product->get_average_rating();
                                                 echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"></span></div>';
                                            }?> 
                                                                
                                            <div class="clearfix"></div>
                              </div>
                              <div class="clearfix"></div>  
                            <?php
                    ?>
                    <div class="addtocart">
                    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                    </div>

                </div>
                <?php endwhile; // end of the loop. ?>

            
                </div>
        <?php endif;

        wp_reset_postdata();

        return '<div class="woocommerce">' . ob_get_clean() . '</div>';
    }
add_shortcode('mukam_featured_product', 'mukam_featured_products');

wpb_map( array(
   "name" => __("Shop Featured Products", 'mukam'),
   "base" => "mukam_featured_product",
   "class" => "",
   "icon" => "icon-wpb-vc_extend",
   "category" => 'Content',
   'admin_enqueue_css' => array(get_template_directory_uri().'/css/vc_extend.css'),
   "params" => array( 
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Title", 'mukam'),
        "param_name" => "widget_title",
        "value" => __("Title", 'mukam'),
        "description" => __("Title of Recent Products", 'mukam')
    ),
        array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => __("Items", 'mukam'),
        "param_name" => "per_page",
        "value" => __("5", 'mukam'),
        "description" => __("How many items do you want to show in carousel?", 'mukam')
    )    
   )
) );    
}