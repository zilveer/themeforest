(function($, undefined) {
	"use strict";
	
	$(function() {
		var widget_areas = $('.widget-liquid-right');
		widget_areas.append($('#wpv-add-sidebar-ui').html());
		widget_areas.find('.sidebar-vamtam-custom').append(function() {
			return $('<span class="wpv-delete-sidebar"></span>').click(function() {
				if(!confirm('Are you sure you want to delete this widget area?')) return;

				var wrap = $(this).parent(),
					id = wrap.find('.widgets-sortables').attr('id').replace(/-(right|left)$/, '').replace(/^wpv_sidebar-/, ''),
					title = wrap.find('.sidebar-name h3'),
					name = $.trim(title.text()).replace(/ \([^\)]+\)$/, ''),
					spinner = title.find('.spinner');

				spinner.addClass('wpv-active-spinner');

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'wpv-delete-widget-area',
						name: name,
						_wpnonce: widget_areas.find('input[name="wpv-sidebars-nonce"]').val()
					},
					success: function() {
						wrap.parent().find('.sidebar-vamtam-custom:has(#wpv_sidebar-'+id+'-right), .sidebar-vamtam-custom:has(#wpv_sidebar-'+id+'-left)').slideUp();
					}
				});
			});
		});
	});
})(jQuery);