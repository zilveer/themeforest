<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
            <?php if( is_product() ): ?>
                <div id="content-shop" class="span<?php echo ( yit_get_sidebar_layout() == 'sidebar-no' && yit_product_form_position_is('in-content') ) ? 12 : 9 ?> content group">
            <?php else : ?>
                <div id="content-shop" class="span<?php echo ( yit_get_sidebar_layout() == 'sidebar-no' ) ? 12 : 9 ?> content group">
            <?php endif; ?>