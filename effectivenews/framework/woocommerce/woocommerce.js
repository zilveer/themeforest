jQuery(document).ready(function($) {
	
        $('body').on('click', '.add_to_cart_button', function()
	{
		jQuery(this).parents('.product:eq(0)').addClass('mom_adding_loading').removeClass('mom_added_check');
		var nel = $('#navigation .nav-button.nav-cart').find('.numofitems');
		var num = nel.data('num');
		nel.text(num+1);
		nel.data('num', num+1);
		
	})
	
	$('body').bind('added_to_cart', function()
	{
		jQuery('.mom_adding_loading').removeClass('mom_adding_loading').addClass('mom_added_check');
	});

/*----------------------------
	Prettyephoto
----------------------------*/
(function($) {
$(function() {

	// Lightbox
	$("a.zoom").prettyPhoto({
		hook: 'data-rel',
		social_tools: false,
		horizontal_padding: 20,
		opacity: 0.8,
		deeplinking: false
	});
	$("a[data-rel^='prettyPhoto']").prettyPhoto({
		hook: 'data-rel',
		social_tools: false,
		horizontal_padding: 20,
		opacity: 0.8,
		deeplinking: false
	});

});
})(jQuery);

 
});