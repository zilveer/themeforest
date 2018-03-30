/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $, window ) {


	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );


	// Not needed now

	//var ListableImageModal = typeof window.ListableImageModal === 'undefined' ? {} : window.ListableImageModal,
	//	Attachment = wp.media.model.Attachment,
	//	frames = [],
	//	imageControl, l10n;
	//
	//// Link any localized strings.
	//l10n = ListableImageModal.l10n = typeof ListableImageModal.l10n === 'undefined' ? {} : ListableImageModal.l10n;
	//
	///**
	// * customizerImageControl module object.
	// */
	//customizerImageControl = function( el, options ) {
	//	var defaults, settings;
	//
	//	this.$el = $( el );
	//
	//	// Search within the context of the control.
	//	this.$target = this.$el.find( "." + this.$el.attr( 'data-target' ) );
	//
	//	defaults = {
	//		frame: {
	//			id: 'listable-image-modal',
	//			title: l10n.frameTitle,
	//			updateText: l10n.frameUpdateText,
	//			multiple: false
	//		},
	//		mediaType: 'image',
	//		returnProperty: 'id'
	//	};
	//
	//	options = options || {};
	//	options.frame = options.frame || {};
	//	this.settings = _.extend( {}, defaults, options );
	//	this.settings.frame = _.extend( {}, defaults.frame, options.frame );
	//
	//	/**
	//	 * Initialize a media frame.
	//	 *
	//	 * @returns {wp.media.view.MediaFrame.Select}
	//	 */
	//	this.frame = function() {
	//		var frame = frames[ this.settings.frame.id ];
	//
	//		if ( frame ) {
	//			frame.control = this;
	//			return frame;
	//		}
	//
	//		frame = wp.media({
	//			title: this.settings.frame.title,
	//			library: {
	//				type: this.settings.mediaType
	//			},
	//			button: {
	//				text: this.settings.frame.updateText
	//			},
	//			multiple: this.settings.frame.multiple
	//		});
	//
	//		frame.control = this;
	//		frames[ this.settings.frame.id ] = frame;
	//
	//		// Update the selected image in the media library based on the image in the control.
	//		frame.on( 'open', function() {
	//			var selection = this.get( 'library' ).get( 'selection' ),
	//				attachment, ids;
	//
	//			if ( frame.control.$target.length ) {
	//				ids = frame.control.$target.val();
	//				if ( ids && '' !== ids && -1 !== ids && '0' !== ids ) {
	//					attachment = Attachment.get( ids );
	//					attachment.fetch();
	//				}
	//			}
	//
	//			selection.reset( attachment ? [ attachment ] : [] );
	//		});
	//
	//		// Update the control when an image is selected from the media library.
	//		frame.state( 'library' ).on( 'select', function() {
	//			var selection = this.get( 'selection' );
	//			frame.control.setAttachments( selection );
	//			frame.control.$el.trigger( 'selectionChange.listableimagemodal', [ selection ] );
	//		});
	//
	//		return frame;
	//	};
	//
	//	/**
	//	 * Set the control's attachments.
	//	 *
	//	 * @param {Array} attachments An array of wp.media.model.Attachment objects.
	//	 */
	//	this.setAttachments = function( attachments ) {
	//		// Insert the selected attachment id into the target element.
	//		if ( this.$target.length ) {
	//			this.$target.val( attachments.pluck( 'id' ) ).trigger( 'input' );
	//		}
	//	};
	//};
	//
	//_.extend( ListableImageModal, {
	//	/**
	//	 * Retrieve a media selection control object.
	//	 *
	//	 * @param {Object} el HTML element.
	//	 *
	//	 * @returns {Control}
	//	 */
	//	getControl: function( el ) {
	//		var control, $control;
	//
	//		$control = $( el ).closest( '.listable-image-modal-control' );
	//		control = $control.data( 'media-control' );
	//
	//		if ( ! control ) {
	//			control = new customizerImageControl( $control );
	//			$control.data( 'media-control', control );
	//		}
	//
	//		return control;
	//	}
	//});
	//
	//$(function(){
	//	var api = wp.customize,
	//		$container = $( '.widgets-holder-wrap, .editwidget, .wp-core-ui' );
	//
	//	// Open the media library frame when the button or image are clicked.
	//	$container.on( 'click', '.listable-image-modal-control__choose, .listable-image-modal-control img', function( e ) {
	//		e.preventDefault();
	//		ListableImageModal.getControl( this ).frame().open();
	//	});
	//
	//	$container.on( 'click', '.listable-image-modal-control__clear', function( e ) {
	//		var $control = $( e.target ).parent(),
	//			$input = $control.find('input' ),
	//			option_id = $input.attr('name');
	//
	//		console.log( $input );
	//
	//		$control.removeClass('has-image');
	//		$control.find('img' ).remove();
	//		$input.val('');
	//		$input.trigger('change');
	//	});
	//
	//	// Update the image preview in the widget when an image is selected.
	//	$container.on( 'selectionChange.listableimagemodal', function( e, selection ) {
	//		var $control = $( e.target ),
	//			model = selection.first(),
	//			sizes = model.get( 'sizes' ),
	//			size, image;
	//
	//		var input = $( e.target ).find( 'input' );
	//		console.log( input );
	//		input.trigger('change');
	//
	//		if ( sizes ) {
	//			size = sizes.medium || sizes.thumbnail; //default to thumbnail if medium is not available
	//		}
	//
	//		size = size || model.toJSON();
	//		image = $( '<img />', { src: size.url });
	//
	//		$control.find( 'img' ).remove().end()
	//			.prepend( image )
	//			.addClass( 'has-image' );
	//	});
	//});

	//these hold the ajax responses
	var responseRaw = null;
	var res = null;
	var stepNumber = 0;
	var numberOfSteps = 10;

	// when the customizer is ready prepare our fields events
	wp.customize.bind( 'ready', function() {
		import_demodata();
	} );

	function import_demodata() {

		//The demo data import-----------------------------------------------------
		var importButton = jQuery( '#wpGrade_import_demodata_button' ),
			container = jQuery( '#customize-control-listable_options-import_demodata_button_control' );

		var saveData = {
			container: container,
			ajaxUrl: $( 'input[name=wpGrade_import_ajax_url]', container ).val(),
			optionSlug: $( 'input[name=wpGrade_options_page_slug]', container ).val(),
			nonceImportPostsPages: $( 'input[name=wpGrade-nonce-import-posts-pages]', container ).val(),
			nonceImportThemeOptions: $( 'input[name=wpGrade-nonce-import-theme-options]', container ).val(),
			nonceImportWidgets: $( 'input[name=wpGrade-nonce-import-widgets]', container ).val(),
			ref: $( 'input[name=_wp_http_referer]', container ).val()
		};

		//this is the ajax queue
		var this_data = {},
			resultcontainer = $( '.wpGrade-import-results', this_data.container );
			qInst = $.qjax( {
				timeout: 3000,
				ajaxSettings: {
					type: "POST",
					url: ajaxurl
				},
				onQueueChange: function( length ) {

					if ( length == 0 ) {
						if ( res.errors == false ) {

							setTimeout( function() {
								resultcontainer.append( '<i>' + listable_admin_js_texts.import_all_done + '</i><br />' );
							}, 1000 );

							setTimeout( function() {
								resultcontainer.append( '<h3>' + listable_admin_js_texts.import_phew + '</h3><br /><p>' + listable_admin_js_texts.import_success_note + listable_admin_js_texts.import_success_reload + listable_admin_js_texts.import_success_warning + '</p>' );
							}, 1000 );

						} else {
							//we have errors
							//re-enable the import button
							button.removeClass( 'button-disabled' );

							setTimeout( function() {
								resultcontainer.append( '<i>' + listable_admin_js_texts.import_failed + '</i><br />' );
							}, 1000 );
						}

						// we are done, let the user see what has been done
						import_end_loading();
					}
				},
				onError: function() {
					//stop everything on error
					if ( res.errors != null && res.errors != false ) {
						qInst.Clear();

						// we are done, let the user see what has been done
						import_end_loading();
					}
				},
//				onTimeout: function(current) {
//				},
				onStart: function() {
					//show the loader and some messages
					import_start_loading();
				},
				onStop: function() {
					//stop everything on error
					if ( res.errors != null && res.errors != false ) {
						qInst.Clear();

						// we are done, let the user see what has been done
						import_end_loading();
					}
				}
			} );

		//bind to click
		importButton.bind( 'click', {set: saveData}, function( receivedData ) {

			this_data = receivedData.data.set;

			var button = $( this );

			if ( button.is( '.wpGrade_button_inactive' ) ) return false;

			var activate = confirm( listable_admin_js_texts.import_confirm );

			if ( activate == false ) return false;

			//show loader
			$( '.wpGrade-loading-wrap', this_data.container ).css( {
				opacity: 0,
				display: "block",
				visibility: 'visible'
			} ).removeClass( "hidden" ).animate( {opacity: 1} );
			//disable the import button
			button.addClass( 'button-disabled' );
			resultcontainer.removeClass( 'hidden' );
			resultcontainer.append( '<br /><i>' + listable_admin_js_texts.import_working + '</i><br />' );

			//queue the calls
			ajax_import_theme_options(resultcontainer, this_data);
			ajax_import_widgets(resultcontainer, this_data);
			ajax_import_posts_pages_stepped(resultcontainer, this_data);

			return false;
		} );
	}

	function ajax_import_posts_pages_stepped(resultcontainer, this_data) {
		//add to queue the calls to import the posts, pages, custom posts, etc
		stepNumber = 0;
		while ( stepNumber < numberOfSteps ) {
			stepNumber++;
			qInst.Queue( {
				type: "POST",
				url: this_data.ajaxUrl,
				data: {
					action: 'wpGrade_ajax_import_posts_pages',
					_wpnonce: this_data.nonceImportPostsPages,
					_wp_http_referer: this_data.ref,
					step_number: stepNumber,
					number_of_steps: numberOfSteps
				}
			} )
				.fail( function( response ) {
					responseRaw = response;
					res = wpAjax.parseAjaxResponse( response, 'notifier' );
					resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />' );
				} )
				.done( function( response ) {
					responseRaw = response;
					res = wpAjax.parseAjaxResponse( response, 'notifier' );
					if ( res != null && res.errors != null ) {
						if ( res.errors == false ) {
							if ( res.responses[0] != null ) {
								resultcontainer.append( '<i>' + listable_admin_js_texts.import_posts_step + ' ' +  + res.responses[0].supplemental.stepNumber + ' of ' + res.responses[0].supplemental.numberOfSteps + '</i><br />' );
								//for debuging purposes
								resultcontainer.append( '<div style="display:none;visibility:hidden;">Return data:<br />' + res.responses[0].data + '</div>' );
							} else {
								resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />' + listable_admin_js_texts.import_error + ' ' + res.responses[0].data );
							}
						}
						else {
							if ( res.responses[0] != null ) {
								resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />( ' + res.responses[0].errors[0].message + ' )<br/>' );
							} else {
								resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + '</i><br />' + listable_admin_js_texts.import_error + ' ' + res.responses[0].data );
							}
						}
					} else {
						resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_posts_failed + ' ' + listable_admin_js_texts.import_try_reload + ' </i><br />' );
					}
				} );
		}
	}

	function ajax_import_theme_options(resultcontainer, this_data) {
		//make the call for importing the theme options
		qInst.Queue( {
			type: "POST",
			url: this_data.ajaxUrl,
			data: {
				action: 'wpGrade_ajax_import_theme_options',
				_wpnonce: this_data.nonceImportThemeOptions,
				_wp_http_referer: this_data.ref
			}
		} )
			.fail( function( response ) {
				responseRaw = response;
				res = wpAjax.parseAjaxResponse( response, 'notifier' );
				resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_theme_options_failed + '</i><br />' );
			} )
			.done( function( response ) {
				responseRaw = response;
				res = wpAjax.parseAjaxResponse( response, 'notifier' );
				if ( res != null && res.errors != null ) {
					if ( res.errors == false ) {
						resultcontainer.append( '<i>' + listable_admin_js_texts.import_theme_options_done + '</i><br />' );
						//for debuging purposes
						resultcontainer.append( '<div style="display:none;visibility:hidden;">Return data:<br />' + res.responses[0].data + '</div>' );
					}
					else {
						resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_theme_options_error + ': ' + res.responses[0].errors[0].message + ' )<br/><br/>' );
					}
				} else {
					resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_theme_options_failed + '</i><br />' );
				}
			} );
	}

	function ajax_import_widgets(resultcontainer, this_data) {
		//make the call for importing the widgets and the menus
		qInst.Queue( {
			type: "POST",
			url: this_data.ajaxUrl,
			data: {
				action: 'wpGrade_ajax_import_widgets',
				_wpnonce: this_data.nonceImportWidgets,
				_wp_http_referer: this_data.ref
			}
		} )
			.fail( function() {
				responseRaw = response;
				res = wpAjax.parseAjaxResponse( response, 'notifier' );
				resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_widgets_failed + '</i><br />' );
			} )
			.done( function( response ) {
				responseRaw = response;
				res = wpAjax.parseAjaxResponse( response, 'notifier' );
				if ( res != null && res.errors != null ) {
					if ( res.errors == false ) {
						resultcontainer.append( '<i>' + listable_admin_js_texts.import_widgets_done + '</i><br />' );

						//for debuging purposes
						resultcontainer.append( '<div style="display:none;visibility:hidden;">Return data:<br />' + res.responses[0].data + '</div>' );
					}
					else {
						resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_widgets_error + ': '  + res.responses[0].errors[0].message + ' )<br/><br/>' );
					}
				} else {
					resultcontainer.append( '<i style="color:red">' + listable_admin_js_texts.import_widgets_failed + '</i><br />' );
				}
			} );
	}

	var import_start_loading = function() {
		// make the iframe preview loading
		wp.customize.previewer.send( 'loading-initiated' );

	};

	var import_end_loading = function() {
		// and refresh the iframe
		wp.customize.previewer.refresh();
	};

} )( jQuery, window );
