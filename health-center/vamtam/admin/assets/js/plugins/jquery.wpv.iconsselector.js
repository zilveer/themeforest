(function($, undefined) {
	"use strict";

	$.ajax({
		type: 'POST',
		url: ajaxurl,
		data: {
			action: 'wpv-get-icon-list'
		},
		success: function(icons) {
			window.VamtamIconsCache = icons;

			$(document).trigger('vamtam-icons-loaded');
		}
	});

	$.fn.wpvIconsSelector = function(atts) {
		var all_icons = $('.wpv-config-icons-selector', this);

		(function() {
			var browser = /MSIE (\d+)/.exec(navigator.userAgent);
			if(browser && browser[1] !== 8) return;

			var refresh = function() {
				all_icons.find(':radio.checked').removeClass('checked');
				all_icons.find(':checked').addClass('checked');
			};

			all_icons.find(':radio').unbind('change.wpvicons').bind('change.wpvicons', refresh);
			refresh();
		})();

		(function() {
			var init = function(self, icons) {
				var initial = self.find(':checked'),
					checked = initial.val(),
					id = initial.prop('name') || (new Date().getTime()).toString(16),
					wrapper = self.find('.icons-wrapper');

				initial.remove();

				var single_icon = function(key, icon) {
					var radio = $('<input type="radio" />').attr('name', id).attr('id', id+key).val(key),
						label = $('<label class="single-icon" />').attr('for', id+key).html(icon);

					if(key === checked)
						radio.attr('checked', 'checked');

					return radio.add(label);
				};

				for(var key in icons) {
					wrapper.append(single_icon(key, icons[key]));
				}

				wrapper.removeClass('spinner');

				self.addClass('icons-loaded')
					.find('.icons-filter').bind('change paste keydown keyup search', function() {
					var search = $(this).val().toLowerCase();
					self.find('label:has(span[title])').show().each(function() {
						if(!$(this).find('span').attr('title').toLowerCase().match(search))
							$(this).hide();
					});
				});

				setTimeout(function() {
					scrollIcons(self);
				}, 100);
			};

			var scrollIcons = function(self) {
				self.each(function() {
					$(this).find('.icons-wrapper').scrollTop(0); // reset the inital position
					$(this).find('.icons-wrapper').scrollTop($(this).find(':checked + label').offset().top - $(this).find('.icons-wrapper').offset().top);
				});
			};

			all_icons.filter(':not(.icons-loaded)').each(function() {
				var self = $(this);

				if(window.VamtamIconsCache) {
					init(self, window.VamtamIconsCache);
				} else {
					$(document).one('vamtam-icons-loaded', function() {
						init(self, window.VamtamIconsCache);
					});
				}
			});

			all_icons.filter('.icons-loaded').each(function() {
				var self = $(this);

				if(typeof atts === 'string') {
					switch(atts) {
						case 'scroll':
							scrollIcons(self);
						break;
					}
				}
			});
		})();

		return this;
	};
})(jQuery);