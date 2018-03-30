jQuery( function ( $ )
{
	'use strict';
	function update_sorter_value($item_ul) {
		var value_enable = '';
		var value_all = '';
		$(' > li > input', $item_ul).each(function() {
			value_all += '||' + $(this).val();
			if ($(this).is( ':checked' )) {
				value_enable += '||' + $(this).val();
			}
		});
		if (value_enable != '') {
			value_enable = value_enable.substring(2);
		}
		if (value_all != '') {
			value_all = value_all.substring(2);
		}
		$('> input[data-enable]', $item_ul.parent()).val(value_enable);
		$('> input[data-sort]', $item_ul.parent()).val(value_all);
	};

	$(".rwmb-sorter-inner > li > input").change(function () {
		update_sorter_value($(this).parent().parent());
	});

	$( ".rwmb-sorter-inner" ).sortable({
		placeholder: "ui-sortable-placeholder",
		update: function( event, ui ) {
			var $item_ul = $(event.target);
			update_sorter_value($item_ul);
		}
	});
} );
