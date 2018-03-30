<?php

global $woocommerce, $product;

$id = ( isset($id) ) ? (int) $id : '';
$attribute_id = ( isset($attribute_id) ) ? (int) $attribute_id : '';
$show_price = ( isset($show_price) && $show_price == 'yes' ) ? true : false;
$show_cart = ( isset($show_cart) && $show_cart == 'yes' ) ? true : false;


$product = get_product( $id );
if ( ! $product->is_purchasable() ) return;
?>


<?php if ( $product->is_in_stock() && is_shop_enabled() ) : ?>	
	<?php if ($product->product_type == 'simple') : ?>
		<?php if ( $show_price ) echo $product->get_price_html(); ?>
		<?php if ( $show_cart ) : ?>
			<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
			 	<button type="submit" class="single_add_to_cart_button button"><?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'yit' ), $product->product_type); ?></button>
			</form>
		<?php endif ?>
	<?php elseif ($product->product_type == 'variable' && $attribute_id != '') : ?>
		<?php
			$attributes = $product->get_available_variations();
			foreach ($attributes as $key){
				if ( $key['variation_id'] == $attribute_id ): 
					$select = '';
					foreach ( $key['attributes'] as $key => $value ){						
						$select .= '<select name="' . $key . '" style="display: none;">	    				
					    				<option value="' . $value . '" class="active" selected="selected"></option>
					    			</select>';
					}
				endif;
			}
		?>
		<?php if ( $show_price ) :
			$variation = $product->get_child( $attribute_id );
			echo $variation->get_price_html();			
		endif ?>
		<?php if ( $show_cart ) : ?>
			<form data-product_id="<?php echo $id ?>" enctype="multipart/form-data" method="post" class="variations_form cart group" action="<?php echo esc_url( $product->add_to_cart_url() ); ?>">
				<input type="hidden" value="1" name="quantity">
			    <div class="variations">	    		
	            	<?php echo $select ?>    
			    </div>			
				<input type="hidden" value="<?php echo $attribute_id ?>" name="variation_id">
				<button class="single_add_to_cart_button button" type="submit">Add to cart</button>		
				<input type="hidden" value="<?php echo $id ?>" name="product_id">			
			</form>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>