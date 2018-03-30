<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

$price = $product->get_price();
$childrens = $product->get_children();


if ($price > 0): ?>
	<span class="price"><?php
		if (count($childrens) > 1):
			echo $product->get_price_html_from_text(); 
		endif;
		
		echo wc_price($price);
	?></span>
<?php endif;

