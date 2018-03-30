(function($, undefined) {
	'use strict';

	$(function() {
		var dropdown = $('.fixed-header-box .cart-dropdown'),
			link = $('.vamtam-cart-dropdown-link'),
			count = $('.products', link),
			widget = $('.widget', dropdown),
			isVisible = false;

		$('body').bind('added_to_cart wc_fragments_refreshed wc_fragments_loaded', function() {
			var count_val = parseInt( $.cookie( 'woocommerce_items_in_cart' ) || 0, 10 );

			if ( count_val > 0 ) {
				var count_real = 0;
				$( '.widget_shopping_cart:first li .quantity' ).each( function() {
					count_real += parseInt( $( this ).clone().children().remove().end().contents().text(), 10 );
				} );
				count.text( count_real );
				count.removeClass( 'cart-empty' );
				dropdown.removeClass( 'hidden' );
				$(this).addClass( 'header-cart-visible' );

			} else {
				count.addClass( 'cart-empty' );
				count.text( '0' );
				// dropdown.addClass('hidden');
				// $(this).removeClass('header-cart-visible');
			}

		});

		var open = 0;

		var showCart = function() {
			open = +new Date();
			dropdown.addClass('state-hover');
			widget.stop(true, true).fadeIn(300, function() {
				isVisible = true;
			});
		};

		var hideCart = function() {
			var elapsed = new Date() - open;

			if(elapsed > 1000) {
				dropdown.removeClass('state-hover');
				widget.stop(true, true).fadeOut(300, function() {
					isVisible = false;
				});
			} else {
				setTimeout(function() {
					if(!dropdown.is(':hover')) {
						hideCart();
					}
				}, 1000 - elapsed);
			}
		};

		dropdown.bind('mouseenter', function() {
			showCart();
		}).bind('mouseleave', function() {
			hideCart();
		});

		link.not('.no-dropdown').bind('click', function(e) {
			if(isVisible) {
				hideCart();
			} else {
				showCart();
			}

			e.preventDefault();
		});
	});
})(jQuery);