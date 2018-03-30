jQuery(document).ready(function($) {
	"use strict";
	/* multiple-field */
	$(document.body).on('change', '.multiple-field select', function(e) {
		"use strict";
		var values = $(this).val();
		$(this).parent().find('input').val(values.join(','));
		return;
	});
	/* color */
	$(document.body).on('click', '.color-field input', function(e) {
		$(this).colpick({
			layout : 'rgbhex',
			colorScheme : 'dark',
			submit : 0,
			onChange : function(hsb, hex, rgb, el, bySetColor) {
				$(el).css('border-color', '#' + hex);
				$(el).val('#' + hex);
			}
		})
	});
	/* icon */
	var icon_field;
	$(document.body).on('click', '.icon-field input', function(e) {
		"use strict";
		icon_field = $(this);
		return;
	});
	$(document.body).on('click', '#TB_ajaxContent ul li', function(e) {
		"use strict";
		var icon_class = $(this).find('i').attr('class');
		$(icon_field).val(icon_class);
		$(icon_field).parent().find('i').attr('class',icon_class);
		return;
	});
	/* booking setting */
	var td_date = $(".form-table tr:eq(3)");
	var td_time = $(".form-table tr:eq(4)")
	td_date.find('input').attr('placeholder','Y-m-d');
	td_time.find('input').attr('placeholder','H:i A');
	td_date.find('.description a').attr('href','http://xdsoft.net/jqplugins/datetimepicker/');
	td_time.find('.description a').attr('href','http://xdsoft.net/jqplugins/datetimepicker/');
});