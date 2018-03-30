<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     99.99
 */

  global $pmc_data;
  
	if($pmc_data['catwootype'] == 1 && !isset($_GET['shop'])){
		 get_template_part('woocommerce/archive-product_template_2');
	}
	if($pmc_data['catwootype'] == 2 && !isset($_GET['shop'])){
		get_template_part('woocommerce/archive-product_template_1');
	}
	if(isset($_GET['shop']) == 'sidebar'){
		get_template_part('woocommerce/archive-product_template_1');
	}	
?>