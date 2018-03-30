jQuery(document).ready(function($) {
	"use strict";
	var key = 'AIzaSyADGgZTyxEE4SGeUU3nAhQAZu7aZcqSkUM';
	$.getJSON("https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key="+key, function(data) {
		"use strict";
		var html = '';
		/* render options */
		for(var i = 0; i < data.items.length; i++ ){
			var font = data.items[i].family;
			html = html+'<option value="'+font+'">'+font+'</option>';
		}
		/* add options */
		$('.google_font_select').each(function () {
			"use strict";
			var value = $(this).attr('data-value');
			$(this).append(html);
			if(value != '' && value != undefined){
				$(this).val(value);
			}
		});
		html = null;
	});
});