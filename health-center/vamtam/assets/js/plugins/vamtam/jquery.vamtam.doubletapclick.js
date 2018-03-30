(function($, undefined) {
	'use strict';

	$.fn.wpvDoubleTapClick = function() {
		var self = this;

		if(Modernizr.touch) {
			var currently_active;

			$(self).bind('click', function(e) {
				if(currently_active !== this) {
					e.preventDefault();
					currently_active = this;
				}

				e.stopPropagation();
			});

			$(window).bind('click.sub-menu-double-tap', function() {
				currently_active = undefined;
			});
		}

		return self;
	};
})(jQuery);