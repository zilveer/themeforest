(function($) {

	$( document ).ready(function() {

		// User Agent on HTML tag
		var doc = document.documentElement;
		doc.setAttribute( 'data-useragent', navigator.userAgent );
		// /User Agent on HTML tag

		// Language Bar
		$( '.socNtools ul > li.lang a' ).click(function ( event ) {
			event.preventDefault();
			$( this ).next().slideToggle( 250 );
		});

		$( '.socNtools ul > li.lang ul li a' ).unbind( 'click' );
		$( '.socNtools ul > li.lang ul li a' ).click(function () {
			$( this ).parent().parent().slideUp( 250 );
		});
		// /Language Bar


		// Search Port
		$( '.socNtools li.search' ).click(function ( event ) {
			event.preventDefault();
			$( '.ssPort' ).addClass( 'open' );
		});

		$( '.closeSearch' ).click(function () {
			$( '.ssPort' ).removeClass( 'open' );
		});
		// /Search Port


		// Input on focus...
		$('input[type="text"],input[type="email"]').addClass( 'untouched' );
		$.fn.ToggleInputValue = function(){
			return $( this ).each(function(){
				var Input = $( this );
				var default_value = Input.val();

				Input.focus(function() {
					if ( Input.val() == default_value ) Input.val( '' );
				}).blur(function(){
						if ( Input.val().length == 0 ) Input.val( default_value );
					});

				$(document).on( 'change', 'input[type="text"]', function() {
					if ( ( Input.val() == default_value) || ( Input.val().length == 0 ) ) {
						$( Input ).removeClass( 'touched' ).addClass( 'untouched' );
					}
					else {
						$( Input ).removeClass( 'untouched' ).addClass( 'touched' );
					}
				});

			});
		}
		$('input[type="text"],input[type="email"]').ToggleInputValue();
		// /Input on focus...


		// Smooth back to top
		$(function () {
			$( '.toTop' ).click(function () {
				$( 'html, body' ).animate({ scrollTop: 0 }, 600);
			});
		});

		$( window ).scroll(function() {
			if( $( window ).scrollTop() + $( window ).height() > $( document ).height() - 100 ) {
				$( '.toTop' ).addClass( 'shown' );
			}
			else {
				$( '.toTop' ).removeClass( 'shown' );
			}
		});


		// Accordion

		$( '.accTitle' ).click(function (){
			if ( $( this ).hasClass( 'on' ) ) {
				$( this ).removeClass( 'on' ).next().slideUp(250);
			}
			else {
				$( '.accTitle' ).removeClass('on');
				$( '.accContent' ).slideUp(250);
				$( this ).addClass( 'on' ).next().slideDown(250);
			}

		});


        // From enquire misc js
            // Header tools
            $('.toolsToggler').click(function() {
                $(this).toggleClass('on').next().next().toggleClass('open');
            });

	});

})( jQuery );