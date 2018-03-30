/**
 *	Theme options
 */
;( function( $ ) {

	'use strict';

	/**
	 * Tabs
	 */
	$( '.tabs a' ).click( function( event ) {
		event.preventDefault();
		var href = $( this ).attr( 'href' );
		window.location.hash = href;
		window.scrollTo(0, 0);
	} );

	var anchor = window.location.hash;
	if ( anchor ) {
		window.scrollTo(0, 0);
			setTimeout(function() {
			window.scrollTo(0, 0);
		}, 1);
	}

	$( '.tabs' ).each(function( ){

		var current = null;          
		var id = $(this).attr( 'id' );

		if( anchor != '' && $(this).find( 'a[href="'+anchor+'"]' ).length > 0){
			current = anchor;

		}else if($.cookie( 'tab'+id ) && $(this).find( 'a[href="'+$.cookie( 'tab'+id)+'"]' ).length > 0){
			current = $.cookie( 'tab'+id);

		}else{
			current = $(this).find( 'a:first' ).attr( 'href' );
		}

		$(this).find( 'a[href="'+current+'"]' ).addClass( 'nav-tab-active' ); 
		
		$(current).siblings().hide();                          
		
		$(this).find( 'a' ).click(function(){
			var link = $(this).attr( 'href' ); 

			if(link == current){
				return false;
			}else{
				
				$(this).addClass( 'nav-tab-active' ).siblings().removeClass( 'nav-tab-active' ); 
				$(link).show().siblings().hide();   
				current = link;                  
				$.cookie( 'tab'+id,current); 
			}
		});

	});

	$( document ).ready( function() {
		$( '.wolf-theme-options-save' ).on( 'click', function( event ) {
			$( '.options-loader' ).css( { 'display' : 'inline-block' } );
		} );
	} );

} )( jQuery );