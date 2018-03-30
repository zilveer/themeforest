(function($, undefined) {
	"use strict";
	
	$(function() {
		var groups = [{
			options: '#vamtam-post-format-options',
			select: '#post-formats-select'
		}, {
			options: '#vamtam-portfolio-format-options',
			select: '#vamtam-portfolio-formats-select'
		}];

		_.each(groups, function(group) {
			var post_formats = $(group.options);
			if(post_formats.length) {
				var pf_tabs = post_formats.find('.wpv-meta-tabs').hide(),
					pf_select = $(group.select);

				pf_select.find(':radio').change(function() {
					var checked = pf_select.find(':checked'),
						format_name = checked.prop('id') || 'post-format-'+checked.val(),
						tab = pf_tabs.find('li.wpv-'+ format_name + ' a');

					tab.click();

					pf_tabs.parent().find('.wpv-config-row.wpv-all-formats').appendTo($(tab.attr('href')));
				}).change();

				post_formats.insertBefore($('#postdivrich')).addClass( 'wpv-repositioned' );
			}
		});
	});
})(jQuery);