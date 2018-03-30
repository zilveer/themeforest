jQuery(document).ready(function($) {
	
    cart_dropdown_menu();

	//Shopping Cart Menu Hover function
	function cart_dropdown_menu()
	{
		var dropdown = jQuery('.cart_dropdown'), subelement = dropdown.find('.dropdown_widget');


		jQuery('.cart_dropdown_link, .hidecart-icon').toggle(
			function()
			{
			  subelement.stop().animate({
				right: '0'
			 }, 300);
			jQuery('.hidecart-icon').addClass('close-icon');

			},
			function()
			{
			  subelement.stop().animate({
				right: '-=282'
			  }, 300);
			jQuery('.hidecart-icon').removeClass('close-icon');     

			});

	}


});
