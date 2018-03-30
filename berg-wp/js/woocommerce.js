
(function($) {
	'use strict';

$(document).ready(function() {
	

	$('body').on('click', 'input.minus', function(e) {
		var current = parseInt(jQuery(this).parent().find('.input-text.qty').val(), 10);
		if (current > 1) {
			var qty = jQuery(this).parent().find('.input-text.qty');
			qty.val(current-1);
		}
	});

	$('body').on('click', 'input.plus', function(e) {
		var current = parseInt(jQuery(this).parent().find('.input-text.qty').val(), 10);
		var qty = jQuery(this).parent().find('.input-text.qty');
		jQuery(qty).val(current+1);

	});
});

})(jQuery);