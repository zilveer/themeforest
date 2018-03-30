
/*------------------------------------------------------------------------
 Background Generator Plugin
 Copyright: Rascals Themes
 www: http://rascals.eu
------------------------------------------------------------------------*/

;(function($) {

jQuery.fn.BgGenerator = function( options ) {
		
	return this.each(function(i) {		  
		var opts = $.extend({
			'null' : 0
		}, options);
		   
		/* List variables */
		var container = $( this ).parent(),
		    target = $( '.bg-generator-input', container ),
			box = $( '#_bg-generator' );
		
		/* Open dialog box */
		$( '.generate-bg', container ).on( 'click', function(event) {
			_generator_box();
		    event.preventDefault();						 
		});
		
		/* Delete BG */
		$( 'body').on( 'click', '.delete-bg', function( event ) { 
			$( '.bg-generator-wrap', container ).slideUp( 400, function() {
			    target.val( '' );
			});
			$( this ).hide();
			$( '.generate-bg', container ).show();
			event.preventDefault();
		});
		
		/* Background Generator Box */
		function _generator_box() {
			$( '#_bg-generator' ).dialog( {
				title: 'Background Generator',
				modal: false,
				width: 600,
				height: 'auto',
				dialogClass :'ui-custom ui-custom-dialog',
				buttons: [
				{
					text: 'Generate Background',
					'class': 'ui-button-generate-bg',
					click: function() {

						var type = $( '.bg-type', box).val();
							color = '',
							image_url = '',
							pos = '',
							repeat = '',
							att = '',
							bg = ''
						
						/* None */
						if ( type == 'none' ) {
							bg = 'background: none;';
							target.val( '' );
							target.val( bg );
							$( '.bg-generator-wrap', container ).slideDown();
							$( '.delete-bg', container ).show();
							$( '.generate-bg', container ).hide();
							$( this ).dialog( 'close' );
							return;
						}

						/* Color or Image */
						if ( type == 'color' || type == 'image' ) {

						/* Color */
						if ( $( '#bg-color-transparent', box ).is( ':checked' ) ) 
							color = 'transparent';
						else
							color = $( '.colorpicker-input', box ).val();

						/* Only Color */
						if ( type == 'color' ) {
							bg = 'background: ' + color + ';';
							target.val( '' );
							target.val( bg );
							$( '.bg-generator-wrap', container ).slideDown();
							$( '.delete-bg', container ).show();
							$( '.generate-bg', container ).hide();
							$( this ).dialog( 'close' );
							return;
						}

						/* Image */
						file = $( '#bg-file', box ).val();

						/* Position */
						pos = $( '.bg-pos', box ).val();
						if (pos == 'custom' ) pos = $( '#bg-custom-pos', box ).val();

						/* Repeat */
						repeat = $( '#bg-repeat', box ).val();

						/* Attachment */
						att = $( '#bg-att', box ).val();

						/* Generate Background */
						bg = 'background: ' + color + ' url( ' + file + ' ) ' + pos + ' ' + repeat + ' ' + att + ';';

						target.val( '' );
						target.val( bg );
						$( '.bg-generator-wrap', container ).slideDown();
						$( '.delete-bg', container ).show();
						$( '.generate-bg', container ).hide();

						$(this).dialog( 'close' );
						}
						
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
				
				open: function( event, ui ) {

					/* Buttons icons */
					$(event.target).parent().find( '.ui-button-cancel span' ).prepend( '<i class="fa icon fa-times"></i>' );
					$(event.target).parent().find( '.ui-button-generate-bg span' ).prepend( '<i class="fa icon fa-magic"></i>' );

					/* Add helper class to overlay layer */
					$( '.ui-widget-overlay' ).addClass( 'ui-custom-overlay' );

					/* Resizable */
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

					/* Type */
					$( '.bg-type', box ).change( function() {						 
						var type = $(this).val();
						if ( type == 'color' ) {
							$( '.color-group' ).fadeIn();
							$( '.file-group' ).hide();
						} else if (type == 'image' ) {
							$( '.file-group' ).fadeIn();
							$( '.color-group' ).fadeIn();
						} else if (type == 'empty' || type == 'none' ){
							$( '.file-group' ).hide();
							$( '.color-group' ).hide();
					}

					});
					 
					/* Transparent */
					$( '#bg-color-transparent', box).click( function() {
						if ( $(this).is( ':checked' ) ) {
							$( '.wp-picker-container', box ).css( 'opacity', 0 );
						} else {
							$( '.wp-picker-container', box ).css( 'opacity', 1 );
						}
					});

					/* Position */
					$( '.bg-pos', box).change( function(){						 
						var type = $(this).val();
						if ( type == 'custom' ) {
							$( '.custom-pos-group' ).fadeIn();
						} else {
							$( '.custom-pos-group' ).hide();
						}
						 
					});
				},
				close: function() { 
				
				}
			});
		}
			
	});
}

})(jQuery);