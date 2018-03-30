<div class="edd-cart-item bag-product">
	<div class="bag-product-title edd-cart-item-title">{item_title}</div>
	<div class="bag-product-price edd-cart-item-price"><?php _e( "Unit Price:", 'swiftframework' ); ?> {item_amount}</div>
	<div class="bag-product-quantity edd-cart-item-quantity"><?php _e( "Quantity:", 'swiftframework' ); ?> <span class="quantity">{item_quantity}</span></div>
	<a href="{remove_url}" data-cart-item="{cart_item_id}" data-download-id="{item_id}" data-action="edd_remove_from_cart" class="remove edd-remove-from-cart">&times;</a>
</div>