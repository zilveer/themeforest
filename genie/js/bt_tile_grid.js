(function($) {

	window.bt_no_posts = false;
	window.bt_loading_grid = false;

	$( document ).ready(function() {
		// Masonry
		var container = document.querySelector( '.tilesWall' );
		
		window.bt_cat_slug = $( '.tilesWall' ).data( 'cat-slug' );
		if ( window.bt_cat_slug == undefined ) {
			window.bt_cat_slug = '';
		}	

		window.bt_limit = $( '.tilesWall' ).data( 'limit' );
		if ( window.bt_limit == undefined ) {
			window.bt_limit = '0';
		}			

		window.bt_msnry = new Masonry( container, {
			// options
			columnWidth: '.gridSizer',
			itemSelector: '.gridItem',
			gutter: 0,
			transitionDuration: '0s',
			hiddenStyle: { opacity: 0 },
			visibleStyle: { opacity: 0 }
		});

		$( 'div.more' ).addClass( 'fixed' );
		$( '#bt_loader' ).css( 'opacity', '1' );
		
		window.bt_loading_grid = true;
		bt_load_posts( '.tilesWall' );
	});
	
	$( window ).resize(function() {
		bt_masonry_tweak();
		setTimeout(function() { window.bt_msnry.layout(); }, 500 );
		var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
		if ( iOS ) {
			setTimeout(function() { bt_masonry_tweak();window.bt_msnry.layout(); }, 1500 );
		}
	});
	
	$( window ).scroll(function() {
		if ( $( window ).scrollTop() + $( window ).height() >= $( document ).height() - 400 && ! window.bt_no_posts && ! window.bt_loading_grid ) {
			window.bt_loading_grid = true;
			bt_load_posts( '.tilesWall' );
		}
	});
	
	window.bt_ajax_elems_all = [];
	
	var bt_load_posts = function( target ) {
		if ( typeof window.bt_grid_offset === 'undefined' ) window.bt_grid_offset = 0;
		var data = {
			'action': 'bt_get_tile_grid',
			'offset': window.bt_grid_offset,
			'cat_slug': window.bt_cat_slug,
			'limit': window.bt_limit
		};
		window.bt_grid_offset = window.bt_grid_offset + 16;
		$( '#bt_loader' ).css( 'opacity', '1' );
		$.ajax({
			type: 'POST',
			url: window.BTAJAXURL,
			data: data,
			async: true,
			success: function( response ) {
			
				if ( response.indexOf( 'no_posts' ) == 0 ) {
					$( '#bt_loader' ).css( 'opacity', '0' );
					$( '#bt_loader' ).hide();
					$( '#bt_no_more' ).fadeIn();
					window.bt_no_posts = true;
					return;
				}

				$post = JSON.parse( response );

				window.bt_ajax_elems = [];
				
				$( 'div.more' ).removeClass( 'fixed' );
				$( '#bt_loader' ).css( 'opacity', '0' );

				for ( var i = 0; i < $post.length; i++ ) {
					var elem = document.createElement( 'div' );
					elem.className = 'gridItem';

					$( elem ).append( $post[ i ].html );
					
					window.bt_ajax_elems.push( elem );
					window.bt_ajax_elems_all.push( elem );
				}

				for ( var i = 0; i < window.bt_ajax_elems.length; i++ ) {

					if ( $post[ i ].hw != '' ) {
						$( window.bt_ajax_elems[ i ] ).find( '.mediaBox' ).attr( 'data-hw', $post[ i ].hw );
					}
					
					$( window.bt_ajax_elems[ i ] ).attr( 'data-i', i );

					$( target ).append( window.bt_ajax_elems[ i ] );

					window.bt_msnry.appended( window.bt_ajax_elems[ i ] );

					bt_masonry_tweak();
					
					window.bt_msnry.layout();
					
					$( window.bt_ajax_elems[ i ] ).find( '.tileAnchor' ).mouseenter(function() {
						$( this ).next().addClass( 'fx' );
						$( this ).siblings( 'header' ).addClass( 'fx' );
					});
					
					var touchtime;
					$( window.bt_ajax_elems[ i ] ).find( '.tileAnchor' ).on( 'touchstart', function(e) {
						touchtime = Date.now();
					});					
					
					$( window.bt_ajax_elems[ i ] ).find( '.tileAnchor' ).on( 'touchend', function(e) {
						if ( Date.now() - touchtime < 150 ) {
							var el = $( this );
							var link = el.attr( 'href' );
							window.location = link;
						}
					});					
					
					$( window.bt_ajax_elems[ i ] ).find( '.tileAnchor' ).mouseleave(function() {
						$( this ).next().removeClass( 'fx' );
						$( this ).siblings( 'header' ).removeClass( 'fx' );
					});
								
				}
				
				for ( var i = 0; i < window.bt_ajax_elems.length; i++ ) {
					imagesLoaded( window.bt_ajax_elems[ i ], function() {
						var i = $( this.elements[0] ).attr( 'data-i' );

						$( this.elements[0] ).css( { 'transition-delay': i * .1 + 's', 'transition-duration': '.4s', 'transition-property': 'opacity', 'opacity': '1' } );

					});
				}
				
				setTimeout(function() { 
					for ( var i = 0; i < window.bt_ajax_elems_all.length; i++ ) {

						$( window.bt_ajax_elems_all[ i ] ).css( { 'transition-delay': i * .1 + 's', 'transition-duration': '.4s', 'transition-property': 'opacity', 'opacity': '1' } );

					}
				}, 10000 );
				
				$( 'div.content' ).removeClass( 'preLoad' );

				window.bt_loading_grid = false;
				
			},
			error: function( xhr, status, error ) {
				$( '#bt_loader' ).css( 'opacity', '0' );
			}
		});
	}
	
	var bt_masonry_tweak = function() {
		if ( $( window ).width() > 1280 ) {
			var x = Math.ceil( $( '.content.tiles' ).width() / 4 )
			$( '.tilesWall' ).width( 4 * x + 1 );		
		} else if ( $( window ).width() > 960 ) {
			var x = Math.ceil( $( '.content.tiles' ).width() / 3 )
			$( '.tilesWall' ).width( 3 * x + 1 );
		} else if ( $( window ).width() > 660 ) {
			var x = Math.ceil( $( '.content.tiles' ).width() / 2 )
			$( '.tilesWall' ).width( 2 * x + 1 );
		} else {
			var x = Math.ceil( $( '.content.tiles' ).width() )
			$( '.tilesWall' ).width( x + 1 );
		}
		$( '.gridSizer' ).innerWidth( x );
		$( '.gridItem' ).innerWidth( x );
		$( '.mediaBox' ).each(function() {
			$( this ).height( Math.floor( x * $( this ).attr( 'data-hw' ) ) - 1 );
		});
		
		var highest = 0;
		var lowest = 100000;
		var variance = 0;
		$( '.mediaBox' ).each(function() {
			if ( $( this ).height() > highest ) {
				highest = $( this ).height();
				variance++;
			}
			if ( $( this ).height() < lowest ) {
				lowest = $( this ).height();
				variance++
			}			
		});
		variance = variance - 2;
		var hlr = Math.round( highest / lowest );
		if ( variance == 1 && hlr == 2 ) {
			$( '.mediaBox' ).each(function() {
				if ( $( this ).height() == highest ) {
					$( this ).height( hlr * lowest + 1 );
				}
			});
		}
	}

})( jQuery );