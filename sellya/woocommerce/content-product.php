<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $woocommerce_loop, $wpdb, $post, $smof_data;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ){
	$woocommerce_loop['loop'] = 0;
}
//if(!isset($woocommerce_loop['sds_product_loop']) || empty($woocommerce_loop['sds_product_loop'])){
//    $woocommerce_loop['sds_product_loop'] = 0;
//}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibilty
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;
//$woocommerce_loop['sds_product_loop']++;

$altimgclass = $smof_data['sellya_product_alt_image_setting'] != 0? ' havealtimg':'';

?>
<li class="span <?php
	if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['loop'] == 1 )
//	if ( ( $woocommerce_loop['sds_product_loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
		echo 'span-first-child';
	
        echo $altimgclass;
        ?>">
	<div class="pbox">
	
	 <?php do_action( 'woocommerce_before_shop_loop_item' ); 
         ?>
	<div class="image">
	  <a href="<?php the_permalink(); ?>">
		  <?php
			  /**
			   * woocommerce_before_shop_loop_item_title hook
			   *
			   * @hooked woocommerce_show_product_loop_sale_flash - 10
			   * @hooked woocommerce_template_loop_product_thumbnail - 10
			   */
			  do_action( 'woocommerce_before_shop_loop_item_title' );
		  ?>          	
	  </a>  
	</div>
	
         <?php 
         
         if($smof_data['sellya_product_alt_image_setting'] == 0){?>
           
	  <div class="description hidden-phone hidden-tablet"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></div>
	  <div class="rating hidden-phone hidden-tablet">
      		<div id="reviews">
                    <div id="comments">
				
                	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                    	<?php echo $product->get_rating_html();?>
                        </div>
                    </div><!--#comments-->
                </div><!--#reviews-->
          </div><!--.rating-->
            <?php } else{?>
                <div class="description hidden-phone hidden-tablet">
                <?php
                    $attchments  = $product->get_gallery_attachment_ids();
                    if(isset($attchments[0])){
                        echo wp_get_attachment_image($attchments[0],'thumbnail',false,array('class'=>"product-img-alt attchment-thumbnail"));
                    }
                    else{
                        the_post_thumbnail('thumbnail');
                    }
                    ?>
                    <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
                </div>
            <?php }?>
          
	  <div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
	
	  <?php
		  /**
		   * woocommerce_after_shop_loop_item_title hook
		   *
		   * @hooked woocommerce_template_loop_price - 10
		   */
		   do_action( 'woocommerce_after_shop_loop_item_title' );
	  ?>
	
	    
	  <div class="cart"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>
	  <div class="clear"></div>
	</div>

</li>