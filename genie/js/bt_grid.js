(function($) {

	window.bt_no_posts = false;
	window.bt_loading_grid = false;

	$( document ).ready(function() {
		// Masonry
		var container = document.querySelector( '.gridWall' );
		
		window.bt_cat_slug = $( '.gridWall' ).data( 'cat-slug' );
		if ( window.bt_cat_slug == undefined ) {
			window.bt_cat_slug = '';
		}
		
		window.bt_limit = $( '.gridWall' ).data( 'limit' );
		if ( window.bt_limit == undefined ) {
			window.bt_limit = '0';
		}		

		window.bt_msnry = new Masonry( container, {
			// options
			columnWidth: '.gridSizer',
			itemSelector: '.gridItem',
			transitionDuration: '0s',
			hiddenStyle: { opacity: 0 },
			visibleStyle: { opacity: 0 }
		});
		
		$( 'div.more' ).addClass( 'fixed' );			
		$( '#bt_loader' ).css( 'opacity', '1' );
		
		window.bt_loading_grid = true;
		bt_load_posts( '.gridWall' );
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
			bt_load_posts( '.gridWall' );
		}
	});
	
	window.bt_ajax_elems_all = [];
	
	var bt_load_posts = function( target ) {
		if ( typeof window.bt_grid_offset === 'undefined' ) window.bt_grid_offset = 0;
		var data = {
			'action': 'bt_get_grid',
			'offset': window.bt_grid_offset,
			'cat_slug': window.bt_cat_slug,
			'limit': window.bt_limit
		};
		window.bt_grid_offset = window.bt_grid_offset + 12;		
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
						$( window.bt_ajax_elems[i] ).find( '.mediaBox' ).attr( 'data-hw', $post[ i ].hw );
						$( window.bt_ajax_elems[i] ).find( '.slideBox' ).attr( 'data-hw', $post[ i ].hw );
					}
					
					$( window.bt_ajax_elems[i] ).attr( 'data-i', i );

					$( target ).append( window.bt_ajax_elems[i] );
					
					$( '.sbPort' ).slick({
						arrows: true,
						infinite: true,
						dots: false,
						slidesToShow: 1,
						slidesToScroll: 1
					});
					
					$( '.slideBox' ).each(function() { 
						$( this ).find( '.slick-slide' ).not( '.slick-cloned' ).find( 'a' ).magnificPopup({
							type: 'image',
							// other options
							gallery:{
								enabled:true
							},
							closeMarkup:'<button class="mfp-close" type="button" title="%title%"></button>',
							closeBtnInside:false
						});
					});
					
					$( '.gallGrid' ).each(function() { 
						$( this ).find( 'a' ).magnificPopup({
							type: 'image',
							// other options
							gallery:{
								enabled:true
							},
							closeMarkup:'<button class="mfp-close" type="button" title="%title%"></button>',
							closeBtnInside:false
						});
					});
					
					window.bt_msnry.appended( window.bt_ajax_elems[i] );
					
					bt_masonry_tweak();
					
					window.bt_msnry.layout();
					
					imagesLoaded( window.bt_ajax_elems[i], function() {
						var i = $( this.elements[0] ).attr( 'data-i' );
						$( this.elements[0] ).css( { 'transition-delay': i * .1 + 's', 'transition-duration': '.4s', 'transition-property': 'opacity', 'opacity': '1' } );
						window.bt_msnry.layout(); // grid gallery
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
		if ( $( '.gridWall' ).hasClass( 'wide' ) ) {
			if ( $( '.content.grid' ).width() > 1025 ) {
				var x = Math.floor( $( '.content.grid' ).width() / 4 );
			} else if ( $( '.content.grid' ).width() > 820 ) {
				var x = Math.floor( $( '.content.grid' ).width() / 3 );
			} else if ( $( '.content.grid' ).width() > 480 ) {
				var x = Math.floor( $( '.content.grid' ).width() / 2 );
			} else {
				var x = Math.floor( $( '.content.grid' ).width() );
			}
		} else {
			if ( $( window ).width() > 820 ) {
				var x = Math.floor( $( '.gutter' ).innerWidth() / 3 );
			} else if ( $( window ).width() > 480 ) {
				var x = Math.floor( $( '.gutter' ).innerWidth() / 2 );
			} else {
				var x = Math.floor( $( '.gutter' ).innerWidth() );
			}
		}
		$( '.gridSizer' ).innerWidth( x );
		$( '.gridItem' ).innerWidth( x );
		var padding = $( '.gridItem' ).innerWidth() - $( '.gridItem' ).width();
		$( '.mediaBox' ).each(function() {
			if ( $( this ).attr( 'data-hw' ) != undefined ) {
				$( this ).height( Math.floor( ( x - padding ) * $( this ).attr( 'data-hw' ) ) );
			}
		});
		$( '.slideBox' ).each(function() {
			if ( $( this ).attr( 'data-hw' ) != undefined ) {
				$( this ).height( Math.floor( ( x - padding ) * $( this ).attr( 'data-hw' ) ) );
			}		
		});
	}	

})( jQuery );