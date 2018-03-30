jQuery(document).ready(function($) {
	
	$('body').bind('added_to_cart', icore_update_cart);


    // Update Shopping Cart
    function icore_update_cart()
    {   

    	var menu_cart 		= jQuery('.cart_dropdown'),
    		dropdown_cart 	= menu_cart.find('.dropdown_widget_cart:eq(0)'),
    		subtotal 		= menu_cart.find('.cart_subtotal'),
    		sidebarWidget	= jQuery('.widget_shopping_cart');

    	dropdown_cart.load( window.location + ' .dropdown_widget_cart:eq(0) > *', function() 
    	{
    		var subtotal_new = dropdown_cart.find('.total');
    		subtotal_new.find('strong').remove();
    		subtotal.html(subtotal_new.html());

    		jQuery('.widget_shopping_cart, .updating').css('opacity', '1'); //woocommerce script has a racing condition in updating opacity to 1 so it doesnt always happen, this fixes the problem

    		// Hide Shopping Cart Top menu is WooCommerce shopping cart sidebar widget is displayed on the page
    		if(!sidebarWidget.length)
    		{
    			var notification = jQuery('<div class="update_succes woocommerce_message">'+menu_cart.data('success')+'</div>').prependTo(dropdown_cart);
    			dropdown_cart.css({display:'block'}).stop().animate({opacity:1}, function()
    			{
    				notification.delay(500).animate({height:0, opacity:0, paddingTop:0, paddingBottom:0}, function(){ notification.remove(); });
    				dropdown_cart.delay(1000).animate({opacity:1}, function(){ dropdown_cart.css({display:'block'}); });
    			}); 
    		}
    	} );

    }


});
