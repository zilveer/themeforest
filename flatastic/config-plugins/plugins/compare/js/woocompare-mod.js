jQuery(document).ready(function($) {

	// open popup
	$('body').on( 'yith_woocompare_open_popup woocompare_open_popup_mod', function () {

		var compare_button = $('.compare_button', window.parent.document),
			count_compare = $('.count-compare span', window.parent.document),
			data = {
				action: yith_woocompare_mod.action_recount
			};

		$.ajax({
			type: 'post',
			url: yith_woocompare.ajaxurl,
			data: data,
			success: function (response) {
				if (compare_button)
					compare_button.attr('data-amount', response);

				if (count_compare)
					count_compare.html(response);
			}
		});

	});

	$(window).on('yith_woocompare_product_removed', function () {
		$('body').trigger('woocompare_open_popup_mod');
	});

	// ##### WIDGET ######

	$('.yith-woocompare-widget').on('click', 'li a.remove, a.clear-all', function (e) {

		e.preventDefault();

		var button = $(this),
			compare_button = $('.compare_button'),
			count_compare = $('.count-compare span', window.parent.document),
			data = {
				action: yith_woocompare_mod.action_recount_after_remove,
				id: button.data('product_id')
			};

		$.ajax({
			type: 'post',
			url: yith_woocompare.ajaxurl,
			data: data,
			success: function (response) {
				compare_button.attr('data-amount', response);
				count_compare.html(response);
			}
		});

	});

});