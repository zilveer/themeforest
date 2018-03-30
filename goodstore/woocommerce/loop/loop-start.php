<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

jaw_template_inc_counter('pagination'); 

$catalog_class = array();
if (jaw_template_get_var('catalog_mode', 'off') == 'on') {
    $catalog_class[] = 'catalog_mode_on';    
}
?>

<div class="jaw-blog <?php echo implode(' ', $catalog_class); ?>">
<div  class="row elements_iso woocommerce jaw_paginated_<?php echo jaw_template_get_counter('pagination'); ?>">
