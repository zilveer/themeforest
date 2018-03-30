<?php
namespace SupremaQodef\Modules\Shortcodes\FeaturedProductList;

use SupremaQodef\Modules\Shortcodes\Lib\ShortcodeInterface;


/**
 * Class FeaturedProductList that represents product list shortcode
 * @package SupremaQodef\Modules\Shortcodes\FeaturedProductList
 */
class FeaturedProductList implements ShortcodeInterface
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
        $this->base = 'qodef_featured_product_list';

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
    public function vcMap(){
        vc_map(array(
            'name' => esc_html__('Select Featured Product List', 'suprema'),
            'base' => $this->base,
            'category' => 'by SELECT',
            'icon' => 'icon-wpb-featured-product-list extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => 'Type',
                    'param_name' => 'type',
                    'value' => array(
                        'Sale' => 'sale',
                        'Best Sellers' => 'best-sellers',
                        'Featured' => 'featured'
                    ),
                    'save_always' => true,
                    'admin_label' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => 'Number of Product',
                    'param_name'  => 'number',
                    'admin_label' => true,
                    'description' => 'Number of products to show (default value is 4)'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Order By',
                    'param_name' => 'order_by',
                    'value' => array(
                        'Title' => 'title',
                        'Date' => 'date',
                        'ID' => 'id',
                        'Menu Order' => 'menu_order'

                    ),
                    'save_always' => true,
                    'dependency'  => array('element' => 'type', 'value' =>  array('sale', 'featured')),
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
                    'dependency'  => array('element' => 'type', 'value' =>  array('sale', 'featured')),
                    'admin_label' => true
                )
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
            'type' => 'sale',
            'order_by' => 'title',
            'sort_order' => 'asc',
            'number' => '4'
        );

        $params = shortcode_atts($default_atts, $atts);
        $query_args = $this->getQueryArgs($params);
        $products = new \WP_Query($query_args);

        $html = '';
        $html .= '<div class="qodef-product-list-holder">';
        $html .= '<div class="woocommerce">';
		$html .= '<ul class="qodef-featured-products ' . $params['type'] . '">';

        if ($products->have_posts()) :
		
			do_action('suprema_qodef_before_featured_product_list', $params);
		
            while ($products->have_posts()) : $products->the_post();
                $html .= suprema_qodef_get_shortcode_module_template_part('templates/list-standard', 'featured-product-list', '', $params);
            endwhile; // end of the loop.
        endif;

        woocommerce_reset_loop();
        wp_reset_postdata();

        $html .= '</ul>';
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
    private function getQueryArgs($params){

        global $woocommerce;

        switch($params['type']){
            case 'sale':
                $args = array(
                    'posts_per_page' => $params['number'],
                    'orderby'        => $params['order_by'],
                    'order'          => $params['sort_order'],
                    'post_status'    => 'publish',
                    'post_type'      => 'product',
                    'no_found_rows'  => 1,
                    'meta_query'     => WC()->query->get_meta_query(),
                    'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
                );
            break;

            case 'best-sellers':
                $args = array(
                    'post_type'           => 'product',
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => 1,
                    'posts_per_page'      => $params['number'],
                    'meta_key'            => 'total_sales',
                    'orderby'             => 'meta_value_num'
                );
            break;

            case 'featured':
                $args = array(
                    'post_type'           => 'product',
                    'post_status'         => 'publish',
                    'posts_per_page' => $params['number'],
                    'orderby'        => $params['order_by'],
                    'order'          => $params['sort_order'],
                    'meta_key' => '_featured',
                    'meta_value' => 'yes',
                );
            break;
        }

        return $args;

    }


}

