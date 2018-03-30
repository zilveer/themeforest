/*------------------------------------------------------------------------
 Easy Link Plugin
 Copyright: Rascals Themes
 www: http://rascals.eu
------------------------------------------------------------------------*/

;(function($) {

	$.fn.easyLink = function( absolute ) {

		return this.each( function () {

			var  
				target_container = $( this ).parent(),
				target_input = $( '.link-input', target_container ),
				box = $( '#_easy_link' ),
				ul_wrap = $( '#link-results', box ),
				ul = $( 'ul', box ),
				ajax_timeout,
				timeout = 500,
				pagenum,
				s;
			
			
			/* Display links */
			var _display_links = function() {
				
				var 
					data = {
						action: 'easy_link_ajax',
						page_num: pagenum,
						s: s
					};
						
				$( '.ajax-loader', box ).show();
				
				$.ajax( {
					url: ajaxurl,
					data: data,
					type: 'POST',
					success: function( response ) {
								
						if ( response == 'end pages' ) {
							$( '.ajax-loader', box ).hide();
						    ul_wrap.unbind( 'scroll', _scroll_box );
							return;
						}

					    ul.append( response );
						$( '.ajax-loader', box ).hide();
						pagenum ++;
						_get_link();
						ul_wrap.bind( 'scroll', _scroll_box );
					}
				});
			};
			
			/* Scroll Box */
			function _scroll_box( e ) {
	            var elem = $( e.currentTarget );
	            if ( elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight()-2 ) {
					
					if ( ajax_timeout !== undefined ) 
	                    clearTimeout( ajax_timeout );
						
					ul_wrap.unbind( 'scroll', _scroll_box );
	                ajax_timeout = setTimeout( _display_links, timeout );
					
					return false;
				}
			}
			
		    /* Search */
			function _search() {
			    $( '#link_search' ).keyup( function() {
														
					if ( ajax_timeout !== undefined ) {
	                    clearTimeout( ajax_timeout );
	                }								
					s = $( this ).val();
					
					if ( s === undefined ) return;

					ul.html( '' );
					pagenum = 1;
	                ajax_timeout = setTimeout( _display_links, timeout );
		        });
			}
			
			/* Get Link */
			function _get_link() {
				if ( $( 'li', ul ).length > 0 ) {
					$( 'li', ul ).each( function() {
					    $( this ).click( function() {
							var permalink = $( '.permalink', this ).text();
							$( 'li', ul ).removeClass( 'selected' );
							$( this ).addClass( 'selected' );
							$( '#link_target', box ).val( permalink );
							return false;
						});
					
					});
				}	
			}
			
		    /* Dialog */
			$( '#_easy_link' ).dialog( {
				title: 'Insert Link',
				modal: false,
				width: 600,
				height: 'auto',
				dialogClass: 'ui-custom ui-custom-dialog',
				buttons: [
				{
					text: 'Insert Link',
					'class': 'ui-button-insert',
					click: function() {
						var target_val = $( '#link_target', box ).val();
						if ( target_val != '' ) target_input.val( target_val );
						$( this ).dialog( 'close' );
					}
				},
				{
					text: 'Cancel',
					'class': 'ui-button-cancel',
					click: function() {
						$(this).dialog('close');
					}
				}
				],
				open: function ( event, ui ) {

        			/* Buttons icons */
					$(event.target).parent().find( '.ui-button-cancel span' ).prepend( '<i class="fa icon fa-times"></i>' );
					$(event.target).parent().find( '.ui-button-insert span' ).prepend( '<i class="fa icon fa-external-link"></i>' );

					/* Add helper class to overlay layer */
					$( '.ui-widget-overlay' ).addClass( 'ui-custom-overlay' );

					/* Mobile Resizable */
					var init_width = $( window ).width();

					if ( init_width <= 768 ) {
						$( event.target ).parent().css( 'max-width', '90%' );
					}

					$( event.target ).dialog( 'option', 'position', 'center' );

					$( window ).resize( function() {

						var windowWidth = $( window ).width();

						if ( windowWidth <= 768 ) {
							$( event.target ).parent().css( 'max-width', '90%' );
						} else {
							$( event.target ).parent().css( 'max-width', '600px' );
						}
    					$( event.target ).dialog( 'option', 'position', 'center' );
					});

        			s = '';
					pagenum = 1;
					_search();
					_display_links();
    			},
    			close: function () {
        			ul.html( '' );
					$( '#link_search' ).val( '' );
					_display_links = null;
    			}

			});	
		});
	};

})(jQuery);