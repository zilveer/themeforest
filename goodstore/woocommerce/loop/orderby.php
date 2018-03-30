<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $woocommerce, $wp_query;

?>

<div class="woo-orderby-form">
    <?php
    $catalog_orderby = apply_filters('woocommerce_catalog_orderby', array(
        'menu_order' => __('Sort by default sorting', 'jawtemplates'),
        'popularity' => __('Sort by popularity', 'jawtemplates'),
        'rating' => __('Sort by average rating', 'jawtemplates'),
        'date' => __('Sort by newness', 'jawtemplates'),
        'price-asc' => __('Sort by price: low to high', 'jawtemplates'),
        'price-desc' => __('Sort by price: high to low', 'jawtemplates')
    ));

    if (get_option('woocommerce_enable_review_rating') == 'no') {
        unset($catalog_orderby['rating']);
    }
    ?>
    <?php
        $ordeby_lis = array();
        $sortby = '';
        $gete = $_GET;
        
        foreach ($catalog_orderby as $id => $name) {
            if (!$sortby) {
                $sortby = $name;
            }
            $class = '';
            if (selected($orderby, $id, false)) {
                $class = 'class="woo-orderby-form-item-selected"';
                $sortby = esc_attr($name);
            }
                        
            $gete['orderby'] = esc_attr($id);
            $ordeby_lis[] = '<li value="" ' . $class . '><a href="?' . esc_attr(build_query($gete)) . '">' . esc_attr($name) . '</a></li>';
        }
        
        ?>
    <div class="woo-orderby-form-list-title">        
        <span><?php echo $sortby; ?></span>
        <span aria-hidden="true" class="icon-arrow-down-gs"></span>
    </div>
    <ul class="woo-orderby-form-list">
        <?php echo implode($ordeby_lis); ?>
    </ul>
</div> 

