<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post, $product, $mango_settings;
$percentage="";
// sale flash
if ( $product->is_on_sale() && $mango_settings['mango_product_sale_label'] ) :
    $classes = array();
    $classes[] = $mango_settings['mango_product_sale_label_pos'];
    $classes[] = $mango_settings['mango_product_sale_label_type'];
    $text_type = $mango_settings['mango_product_sale_label_text_type'];
    if($text_type=='custom-text') {
        $text = ($mango_settings['mango_product_sale_label_text'])?$mango_settings['mango_product_sale_label_text']:__('Sale','mango');
    }else{
        if($product->product_type == 'simple') {
            $percentage = round ( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );

        }elseif($product->product_type=='variable'){
            $available_variations = $product->get_available_variations();
            $maximumper = 0;
            for ($i = 0; $i < count($available_variations); ++$i) {
                $variation_id=$available_variations[$i]['variation_id'];
                $variable_product1= new WC_Product_Variation( $variation_id );
                $regular_price = $variable_product1 ->regular_price;
                $sales_price = $variable_product1 ->sale_price;
                $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100)) ;
                if ($percentage > $maximumper && $sales_price) {
                    $maximumper = $percentage;
                }
            }
            $percentage = $maximumper;
        }
        $text = "-" . $percentage . "%";
    }
    echo apply_filters( 'woocommerce_sale_flash', '<span class="product-box '.implode(" ",$classes).'">' . $text . '</span>', $post, $product );
 endif; //end sale flash

//featured
if($product->is_featured() && $mango_settings['mango_product_featured_label']):
    $classes = array();
    $classes[] = $mango_settings['mango_product_featured_label_pos'];
    $classes[] = $mango_settings['mango_product_featured_label_type'];
    $text = ($mango_settings['mango_product_featured_label_text'])?$mango_settings['mango_product_featured_label_text']:__("Hot",'mango');
    echo '<span class="product-box '.implode(" ",$classes).'">' . $text . '</span>';
endif; //end featured

//new
if($mango_settings['mango_product_new_label']):
    $d = ($mango_settings['mango_product_new_label_time'])?$mango_settings['mango_product_new_label_time']:7;
    if(!is_numeric($d) || $d<=0 ){
        $d = 7;
    }
    if(strtotime( $post->post_date ) >= strtotime('-'.$d.' day')) {
        $classes = array ();
        $classes[ ] = $mango_settings[ 'mango_product_new_label_pos' ];
        $classes[ ] = $mango_settings[ 'mango_product_new_label_type' ];
        $text = ($mango_settings['mango_product_new_label_text'])?$mango_settings['mango_product_new_label_text']:__("New",'mango');
        echo '<span class="product-box '.implode ( " ", $classes ) . '">' .$text. '</span>';
}
endif; //end new
?>