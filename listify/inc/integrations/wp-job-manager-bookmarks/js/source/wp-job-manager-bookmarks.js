(function($) {
	'use strict';

	var listifyWPJobManagerBookmarks = {
		cache: {
			$document: $(document),
			$window: $(window)
		},

		bindEvents: function() {
			var self = this;

			this.cache.$document.on( 'ready', function() {
				$( '.site' ).on( 'click', '.bookmark-notice', function(e) {
					e.preventDefault();

					self.openModal( $(this) );
				});
			});
		},

		openModal: function(el) {
			var $button = el;
			var $form = $button.parent().parent();

			$.magnificPopup.open({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'scroll',
				items: {
					src:
						'<div class="popup">' +
						'<h2 class="popup-title">' + el.text() + '</h2>' +
							$form.prop( 'outerHTML' ) +
						'</div>'
				}
			});
		}
	};

	listifyWPJobManagerBookmarks.bindEvents();

})(jQuery);