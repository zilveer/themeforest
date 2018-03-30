<?php
namespace SupremaQodef\Modules\Shortcodes\ProductList;

use SupremaQodef\Modules\Shortcodes\Lib\ShortcodeInterface;


/**
 * Class ProductList that represents product list shortcode
 * @package SupremaQodef\Modules\Shortcodes\ProductList
 */
class ProductList implements ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    /**
     * Sets base attribute and registers shortcode with Visual Composer
     */
    public function __construct()
    {
        $this->base = 'qodef_product_list';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base attribute
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap()
    {
        vc_map(array(
            'name' => esc_html__('Select Product List', 'suprema'),
            'base' => $this->base,
            'category' => 'by SELECT',
            'icon' => 'icon-wpb-product-list extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => 'Type',
                    'param_name' => 'type',
                    'value' => array(
                        'Standard' => 'standard',
                        'Simple' => 'simple',
                        'Boxed' => 'boxed'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Columns',
                    'param_name' => 'columns',
                    'value' => array(
                        'Two' => '2',
                        'Three' => '3',
                        'Four' => '4',
                        'Five' => '5',
                        'Six' => '6'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type' => 'textfield',
                    'heading' => 'Number of Items',
                    'param_name' => 'items_number',
                    'value' => '',
                    'admin_label' => true,
                    'description' => 'Leave empty for all.'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Order By',
                    'param_name' => 'order_by',
                    'value' => array(
                        'ID' => 'id',
                        'Date' => 'date',
                        'Menu Order' => 'menu_order',
                        'Title' => 'title'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Sort Order',
                    'param_name' => 'sort_order',
                    'value' => array(
                        'Ascending' => 'ASC',
                        'Descending' => 'DESC'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Choose Sorting Taxonomy',
                    'param_name' => 'taxonomy_to_display',
                    'value' => array(
                        'Category' => 'category',
                        'Tag' => 'tag',
                        'Id' => 'id'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display.'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => 'Enter Taxonomy Values',
                    'param_name' => 'taxonomy_values',
                    'value' => '',
                    'admin_label' => true,
                    'description' => 'Separate values (category slugs, tags, or post IDs) with a comma'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Title Tag',
                    'param_name' => 'title_tag',
                    'value' => array(
                        '' => '',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6'
                    ),
                    'description' => '',
                    'group' => 'Design Options'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Display Categories',
                    'param_name' => 'display_categories',
                    'value' => array(
                        'Yes' => 'yes',
                        'No' => 'no'
                    ),
                    'description' => '',
                    'group' => 'Design Options'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Underline Product',
                    'param_name' => 'underline_element',
                    'value' => array(
                        'No' => 'no',
                        'Yes' => 'yes'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => 'Applied only for standard type of product.',
                    'dependency' => array('element' => 'type', 'value' => 'standard'),
                    'group' => 'Design Options'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Product Slider',
                    'param_name' => 'product_slider',
                    'value' => array(
                        'No' => 'no',
                        'Yes' => 'yes'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'group' => 'Product Slider'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Display Slider Navigation',
                    'param_name' => 'slider_navigation',
                    'value' => array(
                        'No' => 'no',
                        'Yes' => 'yes'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'dependency' => array('element' => 'product_slider', 'value' => 'yes'),
                    'group' => 'Product Slider'
                ),
            )
        ));
    }

    /**
     * Renders HTML for product list shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null){
        $default_atts = array(
            'type' => 'standard',
            'columns' => '4',
            'items_number' => '-1',
            'order_by' => 'date',
            'sort_order' => 'desc',
            'taxonomy_to_display' => 'category',
            'taxonomy_values' => '',
            'title_tag' => 'h5',
            'display_categories' => 'yes',
            'product_slider' => 'no',
            'slider_navigation' => 'no',
            'underline_element' => 'no',
        );

        $params = shortcode_atts($default_atts, $atts);

        $query_args = $this->getQueryArgs($params);

        $slider_holder_class = $params['product_slider'] != '' && $params['product_slider'] == 'yes' ? 'qodef-product-list-slider-holder' : '';
        $slider_class = $this->getListClass($params);
        $product_slider_data = $this->getProductSliderData($params);

        global $woocommerce_loop;
        $woocommerce_loop['columns'] = $params['columns'];

        $products = new \WP_Query($query_args);

        $html = '';

        $html .= '<div class="qodef-product-list-holder">';
        $html .= '<div class="woocommerce columns-' . $params['columns'] . ' ' . $slider_holder_class .'">';
        if($params['product_slider'] != '' && $params['product_slider'] == 'yes') {
            $html .= '<div class="products ' . $params['type'] . ' ' . $slider_class . ' " ' . suprema_qodef_get_inline_attrs($product_slider_data) .'>';
        }
        else {
            $html .= '<div class="products ' . $params['type'] . ' ' . $slider_class . '">';
        }

        if ($products->have_posts()) :

            switch ($params['type']) {
                case 'standard':
                    do_action('suprema_qodef_before_product_list_standard', $params);
                    break;
                case 'simple':
                    do_action('suprema_qodef_before_product_list_simple', $params);
                    break;
                case 'boxed':
                    do_action('suprema_qodef_before_product_list_boxed', $params);
                    break;
                default:
                    do_action('suprema_qodef_before_product_list_standard', $params);
            }

            while ($products->have_posts()) : $products->the_post();

                $post_classes = implode(' ', get_post_class() );

                $html .= '<div class="' . $post_classes . '">';
                $html .= suprema_qodef_get_shortcode_module_template_part('templates/list-' . $params['type'], 'product-list', '', $params);
                $html .= '</div>';

            endwhile;

        endif;

        woocommerce_reset_loop();
        wp_reset_postdata();

        if($params['product_slider'] != '' && $params['product_slider'] == 'yes') {
            $html .= '</div>';
        }
        else {
        $html .= '</div>';
    }
        $html .= '</div>';
        $html .= '</div>';

        return $html;

    }


    /**
     * Creates an array of args for loop
     *
     * @param $params
     * @return array
     */
    private function getQueryArgs($params)
    {

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'orderby' => $params['order_by'],
            'order' => $params['sort_order'],
            'posts_per_page' => $params['items_number'],
            'meta_query' => WC()->query->get_meta_query()
        );

        if ($params['taxonomy_to_display'] != '' && $params['taxonomy_to_display'] == 'category') {
            $args['product_cat'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] != '' && $params['taxonomy_to_display'] == 'tag') {
            $args['product_tag'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] != '' && $params['taxonomy_to_display'] == 'id') {
            $idArray = $params['taxonomy_values'];
            $ids = explode(',', $idArray);
            $args['post__in'] = $ids;
        }

        return $args;
    }

    /**
     * Return data attributes for Pie Chart
     *
     * @param $params
     * @return array
     */
    private function getProductSliderData($params) {

        $productSliderData = array();

        if(isset($params['product_slider']) && $params['product_slider'] == 'yes') {

            if(isset($params['columns'])) {
                $productSliderData['data-items-visible'] = $params['columns'];
            }

            if(isset($params['slider_navigation'])) {
                $productSliderData['data-navigation'] = $params['slider_navigation'];
            }
        }

        return $productSliderData;

    }

    private function getListClass($params) {

        $productListClass = '';

        if(isset($params['product_slider']) && $params['product_slider'] == 'yes') {

            $productListClass .= 'qodef-product-list-slider ';
        }

        if( isset($params['type']) && $params['type'] == 'standard' && isset($params['underline_element']) && $params['underline_element'] == 'yes') {
            $productListClass .= 'qodef-underline-item ';
        }

        return $productListClass;

    }

}

