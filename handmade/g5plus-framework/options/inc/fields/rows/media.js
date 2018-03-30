/*global redux_change, wp, redux, libFilter */

/**
 * Media Uploader
 * Dependencies        : jquery, wp media uploader
 * Feature added by    : Smartik - http://smartik.ws/
 * Date                  : 05.28.2013
 */

(function($){
    "use strict";

    redux.field_objects         = redux.field_objects || {};
    redux.field_objects.row_media   = redux.field_objects.row_media || {};

    var isFiltered;

    $( document ).ready(
        function() {

        }
    );

    redux.field_objects.row_media.init = function( selector ) {
        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-media:visible' );
        }
        $( selector ).each(
            function() {
                var el = $( this );
                var parent = el;

                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                isFiltered = false;

                // Remove the image button
                el.find( '.remove-image, .remove-file' ).unbind( 'click' ).on(
                    'click', function() {
                        redux.field_objects.row_media.removeFile(this, $( this ).parents().parent() );
                    }
                );
                // Upload media button
                el.find( '.media_upload_button' ).unbind().on(
                    'click', function( event ) {
                        redux.field_objects.row_media.addFile(this, event, $( this ).parents().parent() );
                    }
                );
            }
        );
    };

    // Add a file via the wp.media function
    redux.field_objects.row_media.addFile = function(el, event, selector ) {
        event.preventDefault();

        var frame;
        var jQueryel = $( this );
        var libFilter;

        // If the media frame already exists, reopen it.
        if ( frame ) {
            frame.open();
            return;
        }

        // Get library filter data
        var filter = $( selector ).find('.library-filter').data('lib-filter');

        // Must exist to do decoding
        if (filter !== undefined) {
            if (filter !== ''){
                libFilter = [];
                isFiltered = true;
                filter = decodeURIComponent(filter);
                filter = JSON.parse(filter);

                $.each(filter, function(index, value) {
                    libFilter.push(value);
                });
            }
        }

        // Create the media frame.
        frame = wp.media(
            {
                multiple: false,
                library: {
                    type: libFilter //Only allow images
                },

                // Set the title of the modal.
                title: jQueryel.data( 'choose' ),

                // Customize the submit button.
                button: {
                    // Set the text of the button.
                    text: jQueryel.data( 'update' )
                    // Tell the button not to close the modal, since we're
                    // going to refresh the page when the image is selected.
                }
            }
        );

        // When an image is selected, run a callback.
        frame.on(
            'select', function() {

                // Grab the selected attachment.
                var attachment = frame.state().get( 'selection' ).first();
                frame.close();

                var data = $( selector ).find('.data').data();

                if ( typeof redux.field_objects.row_media === 'undefined' || typeof redux.field_objects.row_media === undefined ) {
                    redux.field_objects.row_media = {};
                }

                if ( data === undefined || data.mode === 'undefined' ) {
                    data = {};
                    data.mode = "image";
                }

                if (isFiltered === true) {
                    data.mode = 0;
                }

                if (data.mode === 0) {

                } else {
                    if ( data.mode !== false) {
                        if (attachment.attributes.type !== data.mode) {
                            if (attachment.attributes.subtype !== data.mode ) {
                                return;
                            }
                        }
                    }
                }

                var fieldInputWrap = $(el).parent().parent();
                fieldInputWrap.find( '.upload' ).val( attachment.attributes.url );
                fieldInputWrap.find( '.upload-id' ).val( attachment.attributes.id );
                fieldInputWrap.find( '.upload-height' ).val( attachment.attributes.height );
                fieldInputWrap.find( '.upload-width' ).val( attachment.attributes.width );

                redux_change( $( fieldInputWrap ).find( '.upload-id' ) );

                var thumbSrc = attachment.attributes.url;
                if ( typeof attachment.attributes.sizes !== 'undefined' && typeof attachment.attributes.sizes.thumbnail !== 'undefined' ) {
                    thumbSrc = attachment.attributes.sizes.thumbnail.url;
                } else if ( typeof attachment.attributes.sizes !== 'undefined' ) {
                    var height = attachment.attributes.height;

                    for ( var key in attachment.attributes.sizes ) {
                        var object = attachment.attributes.sizes[key];

                        if ( object.height < height ) {
                            height = object.height;
                            thumbSrc = object.url;
                        }
                    }
                } else {
                    thumbSrc = attachment.attributes.icon;
                }

                fieldInputWrap.find( '.upload-thumbnail' ).val( thumbSrc );
                if ( !fieldInputWrap.find( '.upload' ).hasClass( 'noPreview' ) ) {
                    fieldInputWrap.find( '.screenshot' ).empty().hide().append( '<img class="redux-option-image" src="' + thumbSrc + '">' ).slideDown( 'fast' );
                }

                //selector.find('.media_upload_button').unbind();
                fieldInputWrap.find( '.remove-image' ).removeClass( 'hide' );//show "Remove" button
                selector.find( '.redux-background-properties' ).slideDown();
            }
        );

        // Finally, open the modal.
        frame.open();
    };

    // Function to remove the image on click. Still requires a save
    redux.field_objects.row_media.removeFile = function(el, selector ) {

        var fieldInputWrap = $(el).parent().parent();

        fieldInputWrap.find( '.remove-image' ).addClass( 'hide' );//hide "Remove" button
        fieldInputWrap.find( '.upload' ).val( '' );
        fieldInputWrap.find( '.upload-id' ).val( '' );
        fieldInputWrap.find( '.upload-height' ).val( '' );
        fieldInputWrap.find( '.upload-width' ).val( '' );
        fieldInputWrap.find( '.upload-thumbnail' ).val( '' );
        redux_change( $( fieldInputWrap ).find( '.upload-id' ) );
        selector.find( '.redux-background-properties' ).hide();

        var screenshot = fieldInputWrap.find( '.screenshot' );

        // Hide the screenshot
        screenshot.slideUp();

        $( el).unbind();

        // We don't display the upload button if .upload-notice is present
        // This means the user doesn't have the WordPress 3.5 Media Library Support
        if ( selector.find( '.section-upload .upload-notice' ).length > 0 ) {
            selector.find( '.media_upload_button' ).remove();
        }
    };
})( jQuery );