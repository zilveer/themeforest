
/*------------------------------------------------------------------------
 Iframe Generator Plugin
 Copyright: Rascals Themes
 www: http://rascals.eu
------------------------------------------------------------------------*/

;(function($) {

jQuery.fn.IframeGenerator = function( options ) {
		
	return this.each(function( i ) {		  
		var opts = $.extend( {
			'null': 0
		}, options );
		   
		/* List variables */
		var 
			container = $( this ).parent(),
			target = $( '.iframe-generator-input ', container),
			box = $( '#_iframe-generator' );
		
		/* Generate Iframe */
		$( '.generate-iframe', container ).on( 'click', function() {
			_generator_box();
		    return false;				 
		});
	
		/* Delete Iframe */
		$( '.delete-iframe', container ).on( 'click', function(){
			$( '.iframe-generator-wrap', container ).slideUp( 400, function() {
			    target.val( '' );
			});
			$( this ).hide();
			$( '.generate-iframe', container ).show();

			return false;
		});
		
		/* Dialog */
		function _generator_box() {
			$( '#_iframe-generator' ).dialog( {
				title: 'Iframe Generator',
				modal: false,
				width: 600,
				height: 'auto',
				dialogClass :'ui-custom ui-custom-dialog',
				buttons: [
					{
						text: 'Generate Iframe',
						'class': 'ui-button-generate-iframe',
						click: function() {
							var
								iframe_content = $( '#iframe-content' ).val();
								iframe_content = $( iframe_content ),
								iframe = $( iframe_content ).filter( 'iframe' );
							if ( iframe.attr( 'src' ) != undefined ) {
								var
									src = iframe.attr( 'src' ),
									width = iframe.attr( 'width' ),
									height = iframe.attr( 'height' );

								iframe_code = src + '|' + width + '|' + height;
								target.val( iframe_code );

								$( '.msg-error', container).slideUp( 400 );
							  	$( '.iframe-generator-wrap', container).slideDown( 400 );
							  	$( '.delete-iframe', container).show();
							  	$( '.generate-iframe', container ).hide();
							} else {
								$( '.msg-error', container).slideDown( 400 );
							}
								$( this ).dialog( 'close' );
						}
					},
					{
						text: 'Cancel',
						'class': 'ui-button-cancel',
						click: function() {
							$( this ).dialog( 'close' );
						}
					}
				],
				open: function ( event, ui ) {

	        		/* Buttons icons */
					$(event.target).parent().find( '.ui-button-cancel span' ).prepend( '<i class="fa icon fa-times"></i>' );
					$(event.target).parent().find( '.ui-button-generate-iframe span' ).prepend( '<i class="fa icon fa-magic"></i>' );

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
	    		}

			});
		}
		
	});
}

})(jQuery);