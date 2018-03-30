<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 4/4/15
 * Time: 9:18 AM
 */
class Zorka_Product_Category_Widget extends  G5Plus_Widget {
    public function __construct() {
        global $wpdb;
        $categories = array();
        if(class_exists( 'WooCommerce' )){
            $product_categories = $wpdb->get_results( "SELECT * FROM $wpdb->terms
                                       WHERE term_id IN (SELECT term_id FROM $wpdb->term_taxonomy WHERE taxonomy='product_cat' and parent  = 0)");
            if ( is_array( $product_categories ) ) {
                foreach ( $product_categories as $cat ) {
                    $categories[$cat->slug] = $cat->name;
                }
            }
            $this->widget_cssclass    = 'widget-product-category';
            $this->widget_description = esc_html__("Product Category", 'zorka' );
            $this->widget_id          = 'widget-product-categories';
            $this->widget_name        = esc_html__('Zorka: Product Category', 'zorka' );
            $this->settings           = array(
                'title'  => array(
                    'type'  => 'text',
                    'std'   => '',
                    'label' => esc_html__('Title', 'zorka' )
                ),
                'category' => array(
                    'type' => 'select',
                    'std' =>'',
                    'label' => esc_html__('Category','zorka'),
                    'options' => $categories
                ),
                'col_width' => array(
                    'type' => 'select',
                    'std' =>'',
                    'label' => esc_html__('Width','zorka'),
                    'options' => array(
                        '12' => esc_html__('Full width','zorka'),
                        '3' => '1/4',
                        '4' => '1/3',
                        '6' => '1/2',
                        '8' => '2/3'
                    )
                ),
                'sub_description'  => array(
                    'type'  => 'text-area',
                    'std'   => '',
                    'label' => esc_html__('Sub Description', 'zorka' )
                )
            );
        }

        parent::__construct();
    }

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $sub_description  = empty( $instance['sub_description'] ) ? '' : apply_filters( 'widget_sub_description', $instance['sub_description'] );
        $class_custom   = empty( $instance['class_custom'] ) ? '' : apply_filters( 'widget_class_custom', $instance['class_custom'] );
        $title   = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
        $category   = empty( $instance['category'] ) ? '' : apply_filters( 'widget_category', $instance['category'] );
        $col_width   = empty( $instance['col_width'] ) ? '' : apply_filters( 'widget_col_width', $instance['col_width'] );
        $widget_id = $args['widget_id'];

        $args = array(
            'orderby'           => 'name',
            'order'             => 'ASC',
            'hide_empty'        => true,
        );
        $term = $this->get_term_info($category);
        echo '<div class="widget-product-wapper col-md-'.$col_width. '">';
        echo wp_kses_post($before_widget);

        if(empty($title))
            $title = $term['name'];
        if(empty($sub_description))
            $sub_description = $term['excerpt'];

        ?>
        <div class="widget-product-category <?php echo esc_attr($class_custom) ?>">
            <h6><?php echo esc_html($title);?></h6>
            <div class="sub-description">
                <?php echo wp_kses_post($sub_description) ?>
            </div>
            <div class="cate-info">
                <div class="cate-img"><img width="70" height="93" alt="<?php echo esc_attr($title) ?>" src="<?php echo esc_url($term['thumbnail']) ?>"></div>
                <div class="sub-cate">
                    <ul>
                        <?php foreach ($term['sub_terms'] as $sub_term) { ?>
                            <li><a href="<?php echo get_term_link( (int)$sub_term->term_id, 'product_cat') ?>"><?php echo esc_html($sub_term->name) ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php
        echo wp_kses_post($after_widget);
        echo '</div>';
    }

    function get_term_info($parent_slug){
        global $wpdb;
        $result = array(
            'id' =>'',
            'name' => '',
            'slug' => '',
            'thumbnail' => '',
            'excerpt' => '',
            'sub_terms' => array()
        );
        $parent_term = $wpdb->get_row( "SELECT t1.term_id, t1.description, t1.count, t2.name, t2.slug
                                        FROM $wpdb->term_taxonomy as t1 INNER JOIN $wpdb->terms as t2 ON t1.term_id = t2.term_id
                                        WHERE t2.slug = '$parent_slug'");
        if(isset($parent_term)){

            $result['id'] = $parent_term->term_id;
            $result['name'] = $parent_term->name;
            $result['slug'] = $parent_term->slug;
            $result['excerpt'] = $parent_term->description;
            $result['sub_terms'] =  $wpdb->get_results( "SELECT * FROM $wpdb->terms
                                       WHERE term_id IN (SELECT term_id FROM $wpdb->term_taxonomy WHERE parent = $parent_term->term_id) ");

            $table_woocommerce_termmeta = $wpdb->prefix.'woocommerce_termmeta';
            $thumnail_info = $wpdb->get_row( "SELECT * FROM $table_woocommerce_termmeta
                                       WHERE woocommerce_term_id = $parent_term->term_id AND meta_key='thumbnail_id' ");
            if(isset($thumnail_info)){
                $thumnail_id = $thumnail_info->meta_value;
                $result['thumbnail'] = wp_get_attachment_url($thumnail_id );
            }
        }
        return $result;
    }

}

if (!function_exists('zorka_register_widget_product_category')) {
    function zorka_register_widget_product_category() {
        register_widget('Zorka_Product_Category_Widget');
    }
    add_action('widgets_init', 'zorka_register_widget_product_category', 1);
}
