<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $venedor_settings, $venedor_product_slider, $venedor_product_view, $venedor_layout, $venedor_sidebar;

$class = '';
if (($venedor_layout == 'left-sidebar' || $venedor_layout == 'right-sidebar') && $venedor_sidebar)
    $class .= " products-narrow";
else
    $class .= " products-wide";
if ($venedor_settings['category-calc-height']) 
    $class .= ' calc-height';
if (!$venedor_settings['category-hover']) 
    $class .= ' no-hover';
if ($venedor_settings['category-addcart-icon']) 
    $class .= ' use-icon';
if ($venedor_settings['category-align'] == 'left') 
    $class .= ' align-left';
if ($venedor_product_slider)
    $class .= ' product-carousel owl-carousel';
if (!$venedor_settings['product-price'])
    $class .= ' noprice-on-image';
if ($venedor_settings['category-product-desc'])
    $class .= ' show-desc';
?>
<div class="product-row">
<?php if ($venedor_product_slider) : ?>
<div class="products grid row clearfix<?php echo $class ?>">
<?php else: ?>
<ul class="products <?php echo esc_attr($venedor_product_view ? $venedor_product_view : $venedor_settings['category-view']) ?> row clearfix<?php echo $class ?>">
<?php endif; ?>