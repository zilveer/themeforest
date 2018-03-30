(function($) {

	window.cGallery = window.cGallery || {};

	var gallery = gallery || {
		archive: null
	};

	cGallery.Archive = function() {
		var self = this;

		$( '.gallery-overlay-trigger' ).magnificPopup({
			type: 'ajax',
			ajax: {
				settings: {
					type: 'GET',
					data: { 'view': 'singular' }
				}
			},
			gallery: {
				enabled: true,
				preload: [1,1]
			},
			callbacks: {
				open: function() {
					$( 'body' ).addClass( 'gallery-overlay' );
				},
				close: function() {
					$( 'body' ).removeClass( 'gallery-overlay' );
				},
				lazyLoad: function(item) {
					var $thumb = $( item.el ).data( 'src' );
				},
				parseAjax: function(mfpResponse) {
					mfpResponse.data = $(mfpResponse.data).find( '#main' );
				}
			}
		});

		if ( window.location.hash ) {
			var hash = window.location.hash.substring(1);

			if ( $( 'a[href="' + hash + '"]:first' ).length ) {
				$( $( 'a[href="' + hash + '"]:first' ) ).trigger( 'click' );
			}
		}
	}

	$(document).on( 'ready', function() {
		gallery.archive = new cGallery.Archive();
	});

})(jQuery);
