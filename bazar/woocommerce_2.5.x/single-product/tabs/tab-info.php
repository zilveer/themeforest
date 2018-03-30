<?php
/**
 * Info tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $post;
$show = yit_get_post_meta($post->ID, '_use_ask_info');
if(yit_get_option('shop-products-details-contact-form') != -1 && $show ) : ?>
	<li class="info_tab"><a href="#tab-info"><?php echo apply_filters( 'yit_ask_info_label', __('Product Enquiry', 'yit') ) ?></a></li>
<?php endif ?>