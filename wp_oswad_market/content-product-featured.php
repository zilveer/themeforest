<?php
/**
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Oswad Market
 * @since WD_Responsive
 */
?>
<?php
	global $featured_datas,$product,$post,$woocommerce_loop;
	$old_prod = $product;
	$old_post = $post;
	$old_woocommerce_loop = $woocommerce_loop;
	$product = wc_get_product( $featured_datas['id'] );
	$post = $product->post;
	if( isset($product) && is_object($product) && $product->is_visible() ):
		$_title = $product->get_title();
		$_cart_uri = $product->add_to_cart_url();
		$_upsell = $product->get_upsells( );
		if( count($_upsell)>4 )
			$_upsell = array_slice($_upsell, 0, 4); 
		$_price_html = $product->get_price_html();
		$_sku = $product->get_sku( );
		$_permalink = get_permalink( $featured_datas['id'] );
				
?>		
		<li class="wd_product_feature featured_product_wrapper product type-product status-publish">
			<ul class="product_big_layout">
				<?php woocommerce_get_template_part( 'content', 'product' ); ?>
			</ul>
			<?php if( (int)$featured_datas['show_upsell'] && count($_upsell) > 0 ):?>
			<div class="product_upsells">
				<h4 class="heading-title"><?php _e('We also recommend','wpdance');?></h4>
				<ul>
				<?php 
					foreach( $_upsell as $_prod_id ){
						global $post;
						$thumb = get_post_thumbnail_id($_prod_id);
						echo "<li>";
						echo "<a href=\"".get_permalink( $_prod_id )."\">";
						echo wp_get_attachment_image( $thumb , 'prod_tini_thumb', false, array('class' => 'mini_thumb upsell_thumb') );
						echo "</a>";
						echo "</li>";
					}
				?>
				</ul>
			</div>
			<?php endif;?>
		</li>
		
		
<?php		
		remove_action( 'woocommerce_before_shop_loop_item_title', 'custom_product_thumbnail', 10 );			
		add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );			
		
	endif;
	$product = $old_prod;
	$post = $old_post;
	$woocommerce_loop = $old_woocommerce_loop;
	
?>