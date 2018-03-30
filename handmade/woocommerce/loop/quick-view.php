<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/17/2015
 * Time: 4:26 PM
 */
global $g5plus_options;
$product_quick_view = $g5plus_options['product_quick_view'];
if ($product_quick_view == 0) {
    return;
}
?>
<a data-toggle="tooltip" data-placement="top" title="<?php esc_html_e('Quick view', 'g5plus-handmade') ?>" class="product-quick-view" data-product_id="<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>

