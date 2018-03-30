(function ($) {

	$(function () {

		$('#mad_woof_options').sortable({
			update: function (event, ui) {
				var woof_sort_order = [];

				$.each($(this).children('li'), function (index, value) {
					woof_sort_order.push($(this).data('key'));
				});
				$('input[name="mad_woof_settings[items_order]"]').val(woof_sort_order.toString());
			},
			placeholder: 'mad-woof-options-highlight'
		});

		$(document).on('mad_colorpicker', function () {
			$('.mad-colorpicker').each(function () {
				$(this).wpColorPicker();
			});
		}).trigger('mad_colorpicker');

		$('.js_cache_count_data_clear').on('click', function () {
			var data = {
				action: "woof_cache_count_data_clear"
			};
			jQuery.post(ajaxurl, data, function () {
			});
			return false;
		});

		$(document).on('change', '.mad_woof_select_type', function () {

			var $this = $(this),
				nonce = $this.data('nonce'),
				container = $this.parents('li').find('.mad_woof_placeholder').html(''),
				value = $this.val();

			switch (value) {
				case 'color':
				case 'label':

					var spinner = container.next('.spinner').show(),
						data = {
							action   : 'mad_woof_select_type',
							attribute: $this.data('attribute'),
							value    : value,
							_wpnonce : nonce
						};

					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						dataType: 'json',
						success: function (response) {
							container.html(response.content);
							$(document).trigger('mad_colorpicker');
						},
						complete: function () {
							container.show(0);
							spinner.hide();
						}
					});

				break;
				default:
					container.hide(0);
				break;
			}

		});

	});

})(jQuery);