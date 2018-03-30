<?php
/**
 * Products Category Widget
 *
 * @author        WooThemes
 * @category      Widgets
 * @package       WooCommerce/Widgets
 * @version       1.6.4
 * @extends    WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class YIT_Widget_Products_Category extends WP_Widget {

    /**
     * constructor
     *
     * @access public
     * @return void
     */
    function __construct() {

        /* Widget variable settings. */
        $this->woo_widget_idbase = 'yit_products_category';

        /* Widget settings. */
        $widget_ops = array( 'classname' => 'yit_products_category', 'description' => __( 'Display a list of products of a specific category.', 'yit' ) );

        /* Create the widget. */
        WP_Widget::__construct('yit-products-category', 'YIT Products Category', $widget_ops);
    }

    /**
     * widget function.
     *
     * @see WP_Widget
     * @access public
     *
     * @param array $args
     * @param array $instance
     *
     * @return void
     */
    function widget( $args, $instance ) {

        global $woocommerce;

        ob_start();
        extract( $args );

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Products Category', 'yit' ) : $instance['title'], $instance, $this->id_base );

        if ( ! $number = (int) $instance['number'] ) {
            $number = 10;
        }
        else {
            if ( $number < 1 ) {
                $number = 1;
            }
            else {
                if ( $number > 15 ) {
                    $number = 15;
                }
            }
        }

        $query_args = array(
            'posts_per_page'      => $number,
            'post_status'         => 'publish',
            'post_type'           => 'product',
            'ignore_sticky_posts' => 1,
            'product_cat' => $instance['product_cat'],
        );

        switch ( $instance['show'] ) {
            case 'featured':
                $query_args['meta_query'][] = array(
                    'key'   => '_featured',
                    'value' => 'yes'
                );
                break;

            case 'onsale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $query_args['post__in'] = $product_ids_on_sale;
                break;

            case 'recent':
                $query_args['orderby']  = 'date';
                break;

            default:
                $quary_args['orderby'] = 'rand';
                break;

        }

        if ( isset( $instance['hide_free'] ) && 1 == $instance['hide_free'] ) {
            $query_args['meta_query'][] = array(
                'key'     => '_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'DECIMAL',
            );
        }

        $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
        $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();

        $r = new WP_Query( $query_args );

         if ( $r->have_posts() ) {

            echo $before_widget;

            if ( $title ) {
                echo $before_title . $title . $after_title;
            }

            echo '<div class="clear"></div>';
            echo '<ul class="product_list_widget">';

            $number = 1;

            while ( $r->have_posts() ) {

                $r->the_post();
                
                /**
                 * Fix issue with Visual Composer: print reviews template
                 */
                $r->post->comment_status = false;

                wc_get_template( 'content-widget-product.php' );

                $number ++;
            }

            echo '</ul>';

            echo $after_widget;
        }

        wp_reset_postdata();

        $content = ob_get_clean();

        if ( isset( $args['widget_id'] ) ) {
            $cache[$args['widget_id']] = $content;
        }

        echo $content;
    }


    /**
     * update function.
     *
     * @see WP_Widget->update
     * @access public
     *
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
    function update( $new_instance, $old_instance ) {
        $instance              = $old_instance;
        $instance['title']     = strip_tags( $new_instance['title'] );
        $instance['number']    = (int) $new_instance['number'];
        $instance['hide_free'] = 0;
        $instance['product_cat'] = $new_instance['product_cat'];
        $instance['show'] = $new_instance['show'];

        if ( isset( $new_instance['hide_free'] ) ) {
            $instance['hide_free'] = 1;
        }

        return $instance;
    }

    /**
     * form function.
     *
     * @see WP_Widget->form
     * @access public
     *
     * @param array $instance
     *
     * @return void
     */
    function form( $instance ) {

        $defaults = array(
            'title' => '',
            'number' => 2,
            'hide_free' => 0,
            'product_cat' => '',
            'show' => 'all'
        );

        $instance = wp_parse_args( $instance, $defaults );

        $product_category = get_terms( 'product_cat' );

        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'yit' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number', 'yit' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'product_cat' ); ?>"><?php _e( 'Product Category', 'yit' ) ?>
                <select class="widefat" id="<?php echo $this->get_field_id( 'product_cat' ); ?>" name="<?php echo $this->get_field_name( 'product_cat' ); ?>">
                    <?php foreach( $product_category as $category => $cat ): ?>
                        <option value="<?php echo $cat->slug; ?>" <?php selected( $instance['product_cat'], $cat->slug ) ?>><?php echo $cat->name ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'show' ); ?>"><?php _e( 'Show', 'yit' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'show' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>">
                <option value="all" <?php selected( $instance['show'], 'all' ) ?>><?php _e( 'All Products', 'yit'); ?></option>
                <option value="onsale" <?php selected( $instance['show'], 'onsale' ) ?>><?php _e( 'On-Sale Products', 'yit'); ?></option>
                <option value="featured" <?php selected( $instance['show'], 'featured' ) ?>><?php _e( 'Featured Products', 'yit'); ?></option>
                <option value="recent" <?php selected( $instance['show'], 'recent' ) ?>><?php _e( 'Most Recent Products', 'yit' ); ?></option>
            </select>
        </p>

        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'hide_free' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_free' ) ); ?>" type="checkbox"<?php echo $instance['hide_free']; ?> />
            <label for="<?php echo $this->get_field_id( 'hide_free' ); ?>"><?php _e( 'Hide free products', 'yit' ); ?></label>
        </p>

    <?php
    }
}