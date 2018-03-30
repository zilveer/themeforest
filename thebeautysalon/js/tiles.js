;( function( $, window, document, undefined ) {

	var defaults = {
	};

	function tiles( element, options ) {
		element.config = $.extend( {}, defaults, options );
		element.tiles = element.find('.tile');
		element.col =  element.attr('data-col');
		element.tiles_width = 0;
		element.tile_count = element.tiles.length;
		element.slideshow_speed = parseInt(element.attr( 'data-slideshow_speed' ));
		element.animation_speed = parseInt(element.attr( 'data-animation_speed' ));
		element.animation_order = element.attr( 'data-animation_order' );
		element.slideshow = element.attr( 'data-slideshow' );
	}

	$.fn.tiles = function( options ) {

		new tiles( this, options );
		var element = this;
		update_widths();

		var current = '';

		jQuery(window).load( function() {
			element.show();
			slideshow = setInterval( function(){advanceTiles()}, element.slideshow_speed );
		})

		jQuery(window).smartresize( function() {
			update_widths()
		})

		element.tiles.mouseenter( function() {
			element.find( '.image:hidden' ).fadeIn( element.animation_speed )
			$( this ).find( '.image' ).stop( true, true ).fadeOut( element.animation_speed )
			clearInterval(slideshow)
		})

		element.tiles.mouseleave(function() {
			$( this ).find( '.image' ).stop( true, true ).fadeIn( element.animation_speed )
			slideshow = setInterval( function(){advanceTiles()}, element.slideshow_speed );
		})

		function is_slideshow() {
			if( element.slideshow == 'no' ) {
				return false;
			}
			return true;
		}


		function advanceTiles() {
			if( is_slideshow() ) {
				var next = get_next_tile()
				element.tiles.eq(next).find( '.image' ).stop( true, true ).fadeOut( element.animation_speed )
				element.find( '.image:hidden' ).fadeIn( element.animation_speed )
			}
		}

		function get_next_tile() {
			var next;

			if( element.animation_order == 'asc' ) {
				if( current === '' ) {
					next = 0;
				}
				else {
					next = current + 1;
					if( current == ( element.tile_count - 1 ) ) {
						next = 0;
					}
				}
			}
			else if( element.animation_order == 'desc' ) {
				if( current === '' ) {
					next = element.tile_count - 1;
				}
				else {
					next = current - 1;
					if( current == 0 ) {
						next = element.tile_count - 1 ;
					}
				}
			}
			else {
				next = rand(0, ( element.tile_count - 1) );
			}

			current = next;
			return next;
		}

		function update_widths() {

			if( $( '.blueprint' ).hasClass( 'has-sidebar' ) ) {
				element.tiles_width = $('#blueprint-content').width() - 22;
				element.tile_size = element.tiles_width / element.col;
			}
			else {
				element.tiles_width = element.parents( '.content:first' ).width() + 88;
				element.tile_size = element.tiles_width / element.col;
			}
			element.width( element.tiles_width )
			element.tiles.width(element.tile_size);
			element.tiles.height(element.tile_size);
		}

	}

})( jQuery, window, document );


function rand (min, max) {
  var argc = arguments.length;
  if (argc === 0) {
    min = 0;
    max = 2147483647;
  } else if (argc === 1) {
    throw new Error('Warning: rand() expects exactly 2 parameters, 1 given');
  }
  return Math.floor(Math.random() * (max - min + 1)) + min;

}
