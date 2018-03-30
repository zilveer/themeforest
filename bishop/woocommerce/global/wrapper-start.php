<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

yit_get_template( 'primary/start-primary.php' );

$sidebar = yit_get_sidebars();
$content_cols = 12;
$content_order = '';

if ( $sidebar['layout'] == 'sidebar-left' ) {
    $content_cols -= 3;
    $content_order = ' col-sm-push-3';

} elseif ( $sidebar['layout'] == 'sidebar-right' ) {
    $content_cols -= 3;

} elseif ( $sidebar['layout'] == 'sidebar-double' && $sidebar['sidebar-left'] != '-1' ) {
    $content_cols -= 6;
    $content_order = ' col-sm-push-3';
}
?>

<!-- START CONTENT -->
<div class="content col-sm-<?php echo $content_cols ?><?php echo $content_order ?> clearfix" role="main">