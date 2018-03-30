(function($, undefined) {
	"use strict";
	
	$.fn.wpvBackgroundOption = function() {
		$(this).find('.wpv-config-row.background:not(.wpvbg-loaded)').each(function() {
			var row = $(this).addClass('wpvbg-loaded'),
				size = row.find('.bg-block.bg-size'),
				repeat = row.find('.bg-block.bg-repeat'),
				position = row.find('.bg-block.bg-position');

			size.find('input').bind('change', function() {
				repeat.add(position).show();

				if($(':checked', size).val() === 'cover')
					repeat.add(position).hide();
			}).change();

		});
		return this;
	};
})(jQuery);