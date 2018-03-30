<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>
        </div><!--end column-->
        <div class="xlg-margin visible-sm visible-xs"></div><!-- space -->
<?php woocommerce_get_sidebar(); ?>
    </div><!--end row-->
</div><!--end container-->

<?php 
global $mango_settings;
 if(class_exists('WC_Vendors') ){
if($mango_settings['mango_wcvendors_product_moreproducts']){
if(is_product()){
	mango_more_seller_product();
	
}
}}
 if(is_product()){ mango_woocommerce_show_product();  } 
 
 ?>