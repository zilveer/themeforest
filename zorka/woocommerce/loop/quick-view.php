<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/23/2015
 * Time: 2:19 PM
 */
global $zorka_data;
$enable_quick_view = isset($zorka_data['enable-quick-view']) ? $zorka_data['enable-quick-view'] : 1;
if ($enable_quick_view == 0) return;
?>
<a data-toggle="tooltip" title="<?php esc_html_e('Quick view','zorka') ?>" class="product-quick-view" data-product_id="<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><i class="pe-7s-search"></i></a>
