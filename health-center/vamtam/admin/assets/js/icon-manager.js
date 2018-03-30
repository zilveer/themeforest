(function($, undefined) {
	'use strict';

	$.WPV = $.WPV || {};

	$.WPV.icon_manager = {
		init: function() {
			var file_frame,
				selected_zip;

			$(document).on('click', '.vamtam-upload-icon-font', function( e ) {
				file_frame = wp.media.frames.file_frame = wp.media({
					multiple: false,
					library: {
						type: 'application/zip'
					}
				});

				file_frame.on( 'select', function() {
					var attachment = file_frame.state().get('selection').first();
					selected_zip = attachment.id;


					$( '.vamtam-icon-font-setup .step-1 .step-in-progress' ).text( attachment.attributes.filename ).show();
					$( '.vamtam-icon-font-setup .postbox-container.step-2' ).removeClass( 'inactive' );
				});

				file_frame.open();
				e.preventDefault();
			});

			$(document).on('click', '.vamtam-process-icon-font', function( e ) {
				e.preventDefault();

				var self = $(this);

				self.siblings( '.step-in-progress' ).show();

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'wpv-process-icon-font',
						selected: selected_zip,
						_ajax_nonce: $(this).data('nonce')
					},
					dataType: 'json',
					success: function(data) {
						self.siblings( '.step-in-progress' ).hide();

						var result = '';

						if ( 'error' in data ) {
							result = data.error;
						} else {
							for ( var name in data ) {
								result += 'custom-' + name + ': <svg width="32" height="32" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">';

								for( var i = 0; i < data[name].length; i++ ) {
									result += '<path d="' + data[name][i] + '" fill="#666"/>';
								}

								result += '</svg><br>';
							}
						}

						// $( '.vamtam-icon-font-setup .postbox-container' ).addClass( 'inactive' );
						$( '.vamtam-icon-font-setup .postbox-container.step-3' ).removeClass( 'inactive' ).find( '.result-generated' ).html( result ).parent().show();
					}
				});
			});
		},
	};

	$.WPV.icon_manager.init();

})(jQuery);