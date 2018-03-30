<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 4/4/15
 * Time: 2:32 PM
 */
class Zorka_Product_Featured_Widget extends  G5Plus_Widget {
    public function __construct() {
        global $wpdb;
        $categories = array();

        $categories['zorka_featured_items'] = 'Featured';
        $categories['zorka_sale_off_items'] = 'Sale off';
        $categories['zorka-top-rated-items'] = 'Top rated';
        if(class_exists( 'WooCommerce' )){
            $product_categories = $wpdb->get_results( "SELECT * FROM $wpdb->terms
                                       WHERE term_id IN (SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy='product_cat' and count  > 0)");
            if ( is_array( $product_categories ) ) {
                foreach ( $product_categories as $cat ) {
                    $categories[$cat->slug] = $cat->name;
                }
            }
            $this->widget_cssclass    = 'widget-product-featured-items';
            $this->widget_description = esc_html__("Product Featured Items", 'zorka' );
            $this->widget_id          = 'widget-product-featured-items';
            $this->widget_name        = esc_html__('Zorka: Product Featured Items', 'zorka' );
            $this->settings           = array(
                'category' => array(
                    'type' => 'select',
                    'std' =>'',
                    'label' => esc_html__('Select product from','zorka'),
                    'options' => $categories
                ),
                'per_page' => array(
                    'type' => 'number',
                    'std' =>'4',
                    'label' => esc_html__('Per page','zorka')
                )

            );
        }
        parent::__construct();
    }

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $class_custom   = empty( $instance['class_custom'] ) ? '' : apply_filters( 'widget_class_custom', $instance['class_custom'] );
        $category   = empty( $instance['category'] ) ? '' : apply_filters( 'widget_featured_items', $instance['category'] );
        $per_page   = empty( $instance['per_page'] ) ? '' : apply_filters( 'widget_per_page', $instance['per_page'] );
        $widget_id = $args['widget_id'];

        echo wp_kses_post($before_widget);

        $args = array();
        $meta_query    = WC()->query->get_meta_query();

        switch($category){
            case 'zorka_featured_items':{
                $meta_query[] = array(
                    'key'   => '_featured',
                    'value' => 'yes'
                );
                $args = array(
                    'posts_per_page'	=> $per_page,
                    'orderby' 			=> 'ID',
                    'order' 			=> 'DESC',
                    'no_found_rows' 	=> 1,
                    'post_status' 		=> 'publish',
                    'post_type' 		=> 'product',
                    'meta_query' 		=> $meta_query
                );
                break;
            }
            case 'zorka_sale_off_items':{
                $product_ids_on_sale = wc_get_product_ids_on_sale();
                $args = array(
                    'posts_per_page'	=> $per_page,
                    'orderby' 			=> 'ID',
                    'order' 			=> 'DESC',
                    'no_found_rows' 	=> 1,
                    'post_status' 		=> 'publish',
                    'post_type' 		=> 'product',
                    'meta_query' 		=> $meta_query,
                    'post__in'			=> array_merge( array( 0 ), $product_ids_on_sale )
                );
                break;
            }
            case 'zorka-top-rated-items':{
                $args = array(
                    'posts_per_page'	=> $per_page,
                    'orderby' 			=> 'ID',
                    'order' 			=> 'DESC',
                    'no_found_rows' 	=> 1,
                    'post_status' 		=> 'publish',
                    'post_type' 		=> 'product',
                    'meta_query' 		=> $meta_query
                );
                add_filter( 'posts_clauses', array($this, 'zorka_order_by_rating_post_clauses' ) );
                break;
            }
            default:{
                $args = array(
                    'post_type'				=> 'product',
                    'post_status' 			=> 'publish',
                    'ignore_sticky_posts'	=> 1,
                    'orderby' 				=> 'ID',
                    'order' 				=> 'DESC',
                    'posts_per_page' 		=> $per_page,
                    'meta_query' 			=> $meta_query,
                    'tax_query' 			=> array(
                        array(
                            'taxonomy' 		=> 'product_cat',
                            'terms' 		=> $category,
                            'field' 		=> 'slug',
                            'operator' 		=> 'IN'
                        )
                    )
                );
                break;
            }
        }

        global $woocommerce_loop;
        $woocommerce_loop_columns = $woocommerce_loop['columns'];
        ob_start();
        $products = new WP_Query( $args );
        if($category=='zorka-top-rated-items'){
            remove_filter( 'posts_clauses', array($this, 'zorka_order_by_rating_post_clauses' ) );
        }


        if ( $products->have_posts() ) : ?>
            <div data-col="4" class="product-listing woocommerce row clearfix columns-4 product_animated">
            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                <?php wc_get_template_part( 'content-featured-widget', 'product'); ?>
            <?php endwhile; // end of the loop. ?>
            </div>
            <?php
                $woocommerce_loop['loop'] = '';
                $woocommerce_loop['columns'] = $woocommerce_loop_columns ;
            ?>
        <?php else: ?>
            <div class="item-not-found"><?php esc_html_e('No item found','zorka') ?></div>
        <?php endif;

        wp_reset_postdata();

        echo sprintf('<div class="woocommerce columns-4 product-featured-widget">%s</div>',ob_get_clean());

        echo wp_kses_post($after_widget);
    }

    function zorka_order_by_rating_post_clauses( $args ) {
        global $wpdb;

        $args['where'] .= " AND $wpdb->commentmeta.meta_key = 'rating' ";

        $args['join'] .= "
                LEFT JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
                LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
            ";

        $args['orderby'] = "$wpdb->commentmeta.meta_value DESC";

        $args['groupby'] = "$wpdb->posts.ID";

        return $args;
    }
}
if (!function_exists('zorka_register_widget_product_featured')) {
    function zorka_register_widget_product_featured() {
        register_widget('Zorka_Product_Featured_Widget');
    }
    add_action('widgets_init', 'zorka_register_widget_product_featured', 1);
}