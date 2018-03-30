<?php
/**
 * Content Wrappers
 * @version 1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

$layout = yiw_layout_page(); ?>
<div class="layout-<?php echo $layout ?> group">
    <div id="content" class="group">

    <?php
    if ( $layout == 'sidebar-no' ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
        add_filter('loop_shop_columns', create_function('', 'return 5;'));
    }