;( function( $, window, document, undefined ) {

	var defaults = {
	};

	function product_list( element, options ) {
		element.config = $.extend( {}, defaults, options );
		element.next = element.find( '.next' );
		element.prev = element.find( '.prev' );
		element.pages = element.find('.product-page');
		element.window = element.find( '.product-page-window' );
		element.page_count = element.pages.length;
	}

	$.fn.product_list = function( options ) {

		new product_list( this, options );
		var element = this;
		current_index = 0;

		calculate_width();
		manage_buttons();
		manage_height( 0, false );

		$(window).load( function(){
			manage_height( 0 )
		})

		element.next.on( 'click', function() {
			var next_index = get_next_index();
			element.window.scrollTo( element.pages.eq(next_index), '200' );
			current_index++;
			manage_height( current_index )
			manage_buttons();
		})

		element.prev.on( 'click', function() {
			var prev_index = get_prev_index();
			element.window.scrollTo( element.pages.eq(prev_index), '200' );
			current_index--;
			manage_height( current_index )
			manage_buttons();
		})


		function get_next_index() {
			var next = current_index + 1;
			if( current_index == ( element.page_count - 1 ) ) {
				next = 0;
			}
			return next;
		}

		function get_prev_index() {
			var prev = current_index - 1;
			if( current_index == 0 ) {
				prev = element.page_count - 1;
			}
			return prev;
		}

		$(window).smartresize( function() {
			calculate_width();
			manage_height( current_index );
		})

		function calculate_width() {
			var width = element.window.width();
			element.pages.width(width);
		}

		function manage_buttons() {
			if( current_index == 0 ) {
				element.prev.hide();
			}
			else {
				element.prev.fadeIn();
			}
			if( current_index == element.page_count - 1 ) {
				element.next.hide();
			}
			else {
				element.next.fadeIn();
			}

		}

		function manage_height( index, animate ) {
			if( animate == false ) {
				element.window.height( element.pages.eq(index).height() )
			}
			else {
				element.window.animate({
					height: element.pages.eq(index).height()
				}, 800)
			}
		}


	}

})( jQuery, window, document );

