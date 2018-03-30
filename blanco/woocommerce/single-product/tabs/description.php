<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

if ( $post->post_content ) : ?>
	<div class="panel entry-content" id="tab-description">
	
		<?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', ETHEME_DOMAIN)); ?>
		
		<h2><?php echo $heading; ?></h2>
		
		<?php the_content(); ?>
	
	</div>
<?php endif; ?>
<?php if (etheme_get_option('custom_tab') && etheme_get_option('custom_tab') != '' ) : ?>
    <div class="panel entry-content" id="custom">
    	<?php  etheme_option('custom_tab'); ?>
    </div>
<?php endif; ?>	
<?php if ( etheme_get_custom_field('_etheme_custom_tab1') ) : ?>
    <div class="panel entry-content" id="custom2">
    	<?php etheme_custom_field('_etheme_custom_tab1') ?>
    </div>
<?php endif; ?>	
<?php if ( etheme_get_custom_field('_etheme_custom_tab2') ) : ?>
    <div class="panel entry-content" id="custom3">
    	<?php etheme_custom_field('_etheme_custom_tab2') ?>
    </div>
<?php endif; ?>	