(function( $ ) {


    $.log = function( text ) {
        if ( typeof(window['console']) != 'undefined' ) console.log( text );
    };

    $.swift_page_builder = {
        isMainContainerEmpty: function() {
            if ( !jQuery( '.spb_main_sortable > div' ).length ) {
                $( '.metabox-builder-content' ).addClass( 'empty-builder' );
            } else {
                $( '.metabox-builder-content' ).removeClass( 'empty-builder' );
            }
        },
        cloneSelectedImagesFromMediaTab: function( html, $ids ) {
            var $button = $( '.spb_current_active_media_button' ).removeClass( '.spb_current_active_media_button' );

            var attached_img_div = $button.next(),
                site_img_div = $button.next().next();

            var hidden_ids = attached_img_div.prev().prev(),
                img_ul = attached_img_div.find( '.gallery_widget_attached_images_list' );

            img_ul.html( html );

            var hidden_ids_value = '';
            img_ul.find( 'li' ).each(
                function() {
                    hidden_ids_value += (hidden_ids_value.length > 0 ? ',' : '') + $( this ).attr( 'media_id' );
                }
            );

            hidden_ids.val( hidden_ids_value );

            attachedImgSortable( img_ul );

            tb_remove();

        },
        galleryImagesControls: function() {
            $( '.gallery_widget_add_images' ).live(
                "click", function( e ) {

                    e.preventDefault();

                    var file_frame = "",
                        parentField = $( this ).parent().find( '.attach_image' ),
                        attachedImages = $( this ).parent().find( '.gallery_widget_attached_images_list' );

                    // If the media frame already exists, reopen it.
                    if ( file_frame ) {
                        file_frame.open();
                        return;
                    }

                    // Create the media frame.
                    file_frame = wp.media.frames.file_frame = wp.media(
                        {
                            title: jQuery( this ).data( 'uploader_title' ),
                            button: {
                                text: jQuery( this ).data( 'uploader_button_text' ),
                            },
                            multiple: false  // Set to true to allow multiple files to be selected
                        }
                    );

                    // When an image is selected, run a callback.
                    file_frame.on(
                        'select', function() {
                            // We set multiple to false so only get one image from the uploader
                            attachment = file_frame.state().get( 'selection' ).first().toJSON();

                            parentField.val( attachment.id );
                            attachedImages.empty();
                            //attachedImages.append( '<li class="added" media_id="' + attachment.id + '"><img src="' + attachment.url + '" alt="" rel="' + attachment.id + '"></li>' );
							attachedImages.append('<li class="added" media_id="'+attachment.id+'"><img src="'+attachment.url+'" alt="" rel="'+attachment.id+'"><div class="sf-close-image-bar">							<a title="Deselect" class="sf-close-delete-file" href="#">×</a>	</div></li>');

							jQuery('.sf-close-delete-file').click(function(e) {
								e.preventDefault();
								jQuery(this).parent().parent().remove();
								jQuery('.gallery_widget_attached_images_ids').val("");
								return false;

							});
                        }
                    );

                    // Finally, open the modal
                    file_frame.open();
                }
            );

            $( '.gallery_widget_img_select li' ).live(
                "click", function( e ) {
                    $( this ).toggleClass( 'added' );

                    var hidden_ids = $( this ).parent().parent().prev().prev().prev(),
                        ids_array = (hidden_ids.val().length > 0) ? hidden_ids.val().split( "," ) : new Array(),
                        img_rel = $( this ).find( "img" ).attr( "rel" ),
                        id_pos = $.inArray( img_rel, ids_array );

                    /* if not found */
                    if ( id_pos == -1 ) {
                        ids_array.push( img_rel );
                    }
                    else {
                        ids_array.splice( id_pos, 1 );
                    }

                    hidden_ids.val( ids_array.join( "," ) );

                }
            );
        },
        initializeFormEditing: function( element ) {
            //

            removeClassProcessedElements();
            $( '#spb_edit_form .wp-editor-wrap .textarea_html' ).each(
                function( index ) {
                    initTinyMce( $( this ) );
                }
            );

			// Colorpicker
            $( '.spb-colorpicker' ).minicolors();

			// Ui Slider
            if ( $( '.noUiSlider' ).length > 0 ) {
                $( '.noUiSlider' ).each(
                    function() {
                        var uislider = $( this ),
                            sliderInput = uislider.next( 'input.spb-uislider' ),
                            value = parseInt( sliderInput.val(), 10 ),
                            step = parseFloat( sliderInput.data( 'step' ) ),
                            min = parseFloat( sliderInput.data( 'min' ) ),
                            max = parseFloat( sliderInput.data( 'max' ) );


                        uislider.noUiSlider(
                            {
                                range: [min, max],
                                start: [value],
                                handles: 1,
                                step: step,
                                serialization: {
                                    to: sliderInput,
                                    resolution: 1

                                }
                            }
                        );
                    }
                );
            }

            // Select
            if ( $( '.spb-select' ).length > 0 ) {
				$( '.spb-select' ).each(
				    function() {
				        var select = $( this );

						select.chosen({
							width: '65%'
						});
					}
				);
			}

			// Buttonset
			if ( $( '.spb-buttonset' ).length > 0 ) {
				$( '.spb-buttonset' ).each(
					function() {
						var buttonset = $(this);
						buttonset.find( '.buttonset-item,.ui-button' ).button();
						buttonset.buttonset();
					}
				);
			}

			// Icon picker
            if ( $( '.icon-picker' ).length > 0 ) {
                var selectedIcon = $( '.icon-picker' ).val();
                if ( selectedIcon ) {
                    $( '.font-icon-grid' ).find( '.' + selectedIcon ).parent().addClass( 'selected' );
                }
            }

			// Icon grid
            $( '.font-icon-grid' ).on(
                'click', 'li', function() {
                    var selection = $( this ),
                        iconName = selection.find( 'i' ).attr( 'class' );

                    $( '.font-icon-grid li' ).removeClass( 'selected' );
                    selection.addClass( 'selected' );
                    selection.parent().parent().find( 'input' ).val( iconName );
					selection.parent().parent().find('input').not('.search-icon-grid').val(iconName);

                }
            );

            //            $('#spb_edit_form .gallery_widget_attached_images_list').each(function(index) {
            //                attachedImgSortable($(this));
            //            });


            // Get callback function name
            var cb = element.children( ".spb_edit_callback" );
            //
            if ( cb.length == 1 ) {
                var fn = window[cb.attr( "value" )];
                if ( typeof fn === 'function' ) {
                    var tmp_output = fn( element );
                }
            }

            $( '.spb_save_edit_form' ).unbind( 'click' ).click(
                function( e ) {
                    e.preventDefault();
                    removeClassProcessedElements();
                    saveFormEditing( element );//(element);

                }
            );

            $( '#cancel-background-options' ).unbind( 'click' ).click(
                function( e ) {
                    e.preventDefault();
                    jQuery( 'body' ).css( 'overflow', '' );
                    //$('.spb_main_sortable, #spb-elements, .spb_switch-to-builder').show();
                    $( '.spb_tinymce' ).each(
                        function() {

                            if ( tinyMCE.majorVersion >= 4 ) {
                                tinyMCE.execCommand( "mceRemoveEditor", true, $( this ).attr( 'id' ) );
                            } else {
                                tinyMCE.execCommand( "mceRemoveControl", true, $( this ).attr( 'id' ) );
                            }

                        }
                    );
                    $( '#spb_edit_form' ).html( '' ).fadeOut();
                    //$('body, html').scrollTop(current_scroll_pos);
                    $( "#publish" ).show();
                }
            );
        },
        onDragPlaceholder: function() {
            return $( '<div id="drag_placeholder"></div>' );
        },
        addLastClass: function( dom_tree ) {
            var total_width, width, next_width;
            total_width = 0;
            width = 0;
            next_width = 0;
            $dom_tree = $( dom_tree );

            $dom_tree.children( ".spb_sortable" ).removeClass( "spb_first spb_last" );
            if ( $dom_tree.hasClass( "spb_main_sortable" ) ) {
                $dom_tree.find( ".spb_sortable .spb_sortable" ).removeClass( "sortable_1st_level" );
                $dom_tree.children( ".spb_sortable" ).addClass( "sortable_1st_level" );
                $dom_tree.children( ".spb_sortable:eq(0)" ).addClass( "spb_first" );
                $dom_tree.children( ".spb_sortable:last" ).addClass( "spb_last" );
            }

            if ( $dom_tree.hasClass( "spb_column_container" ) ) {
                $dom_tree.children( ".spb_sortable:eq(0)" ).addClass( "spb_first" );
                $dom_tree.children( ".spb_sortable:last" ).addClass( "spb_last" );
            }

            $dom_tree.children( ".spb_sortable" ).each(
                function( index ) {

                    var cur_el = $( this );

                    // Width of current element
                    if ( cur_el.hasClass( "span12" )
                        || cur_el.hasClass( "spb_widget" ) ) {
                        width = 12;
                    }
                    else if ( cur_el.hasClass( "span10" ) ) {
                        width = 10;
                    }
                    else if ( cur_el.hasClass( "span9" ) ) {
                        width = 9;
                    }
                    else if ( cur_el.hasClass( "span8" ) ) {
                        width = 8;
                    }
                    else if ( cur_el.hasClass( "span6" ) ) {
                        width = 6;
                    }
                    else if ( cur_el.hasClass( "span4" ) ) {
                        width = 4;
                    }
                    else if ( cur_el.hasClass( "span3" ) ) {
                        width = 3;
                    }
                    else if ( cur_el.hasClass( "span2" ) ) {
                        width = 2;
                    }
                    total_width += width;

                    if ( total_width > 10 && total_width <= 12 ) {
                        cur_el.addClass( "spb_last" );
                        cur_el.next( '.spb_sortable' ).addClass( "spb_first" );
                        total_width = 0;
                    }
                    if ( total_width > 12 ) {
                        cur_el.addClass( 'spb_first' );
                        cur_el.prev( '.spb_sortable' ).addClass( "spb_last" );
                        total_width = width;
                    }

                    if ( cur_el.hasClass( 'spb_column' ) || cur_el.hasClass( 'spb_row' ) || cur_el.hasClass( 'spb_tabs' ) || cur_el.hasClass( 'spb_tour' ) || cur_el.hasClass( 'spb_gmaps' ) || cur_el.hasClass( 'spb_accordion' ) ) {


                        if ( cur_el.find( '.spb_element_wrapper .spb_column_container' ).length > 0 ) {
                            cur_el.removeClass( 'empty_column' );
                            cur_el.addClass( 'not_empty_column' );
                            //addLastClass(cur_el.find('.spb_element_wrapper .spb_column_container'));
                            cur_el.find( '.spb_element_wrapper .spb_column_container' ).each(
                                function( index ) {
                                    $.swift_page_builder.addLastClass( $( this ) ); // Seems it does nothing

                                    if ( $( this ).find( 'div:not(.container-helper)' ).length == 0 ) {
                                        $( this ).addClass( 'empty_column' );
                                        $( this ).html( $( '#container-helper-block' ).html() );
                                    } else {
                                        $( this ).find( '.container-helper' ).each(
                                            function() {
                                                var helper = jQuery( this );
                                                helper.appendTo( helper.parent() );
                                            }
                                        );
                                    }
                                }
                            );
                        }
                        else if ( cur_el.find( '.spb_element_wrapper .spb_column_container' ).length == 0 ) {
                            cur_el.removeClass( 'not_empty_column' );
                            cur_el.addClass( 'empty_column' );
                        }
                        else {
                            cur_el.removeClass( 'empty_column not_empty_column' );
                        }
                    }
                }
            );
        }, // endjQuery.swift_page_builder.addLastClass()
        save_spb_html: function() {
            this.addLastClass( $( ".spb_main_sortable" ) );

            var shortcodes = generateShortcodesFromHtml( $( ".spb_main_sortable" ) );

            removeClassProcessedElements();


            if ( isTinyMceActive() != true ) {
                $( '#content' ).val( shortcodes );
            } else {
                //tinyMCE.activeEditor.setContent(shortcodes, {format : 'html'});
                tinyMCE.get( 'content' ).setContent( shortcodes, {format: 'html'} );

            }
        }
    }
})( jQuery );

jQuery( document ).ready(
    function( $ ) {

        var currentAsset = "";

        //Detect Changes in Asset Modal Form
        jQuery( "body" ).on('change',
            '#spb_edit_form select, #spb_edit_form radio, #spb_edit_form input[type=checkbox], #spb_edit_form input[type=hidden]',function(e){
            	check_form_dependency_fields();
            	});

		jQuery('.sf-close-delete-file').live('click', function(e) {
			e.preventDefault();
			jQuery(this).parent().parent().remove();
			jQuery('.gallery_widget_attached_images_ids').val("");

			return false;
		});

        jQuery( 'body' ).append( '<div class="spb-modal-tabs"></div>' );

        jQuery( '#cancel-small-form-background' ).live(
            "click", function() {

                jQuery( '.spb-modal-tabs' ).html( '' );
                jQuery( '.spb-modal-tabs' ).hide();
                jQuery( '#spb_edit_form' ).hide();
                jQuery( 'body' ).css( 'overflow', '' );

                return false;

            }
        );


        jQuery( '#save-small-form' ).live(
            "click", function() {

                saveSmallFormEditing();
                return false;

            }
        );


        $( '#sf_directory_calculate_coordinates' ).live(
            "click", function( e ) {
                e.preventDefault();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode(
                    {'address': jQuery( '#sf_directory_address' ).val()}, function( results, status ) {
                        jQuery( '#sf_directory_lat_coord' ).val( results[0].geometry.location.lat() );
                        jQuery( '#sf_directory_lng_coord' ).val( results[0].geometry.location.lng() );
                    }
                );

            }
        );

        $( '.spb_sortable' ).live(
            "mouseenter", function( e ) {

                e.preventDefault();

                if ( !$( 'body' ).hasClass( 'startedDragging' ) ) {
                    $( this ).find( '.controls_right:first , .column_size_wrapper:first' ).fadeIn( 100 );
                    $( this ).find( '.spb_element_wrapper' ).addClass( 'over_element_wrapper' );
                }


            }
        );

        $( '.spb_sortable' ).live(
            "mouseleave", function( e ) {

                e.preventDefault();
                $( this ).find( '.controls_right:first , .column_size_wrapper:first' ).hide()
                $( '.spb_map_pin .controls_right , .spb_map_pin .column_size_wrapper' ).show();
                $( this ).find( '.spb_element_wrapper' ).removeClass( 'over_element_wrapper' );

            }
        );


        $( '#close-fullscreen-preview' ).live(
            'click', function( e ) {
                e.preventDefault();
                jQuery( 'body' ).css( 'overflow', '' );


                $( '#spb_edit_form' ).html( '' ).fadeOut();
                //$('body, html').scrollTop(current_scroll_pos);

            }
        );


        $( "#previewpage-spb" ).click(
            function( e ) {

                e.preventDefault();

                if ( !jQuery( '.spb_main_sortable > div' ).length ) {
                    alert( "Please add some content before previewing the page." );
                } else {

                    jQuery( 'body' ).css( 'overflow', 'hidden' );
                    jQuery( '#spb_edit_form' ).html( '<div class="spb_preview_fmodal"><div class="spb_preview_fmodal_top_bar"><span class="spb_smodal_header_text">Previewing Page</span><a href="#" id="close-fullscreen-preview" style="float:right;color: #FFFEFE;padding: 15px;">Close Preview</a></div><div class="spb_preview_lockdiv"></div><div class="spb_preview_fmodal_content"><div class="spinnerholder"><div class="spinnermessage"><h4>' + jQuery( '#spb_loading' ).val() + '</h4></div><div class="importspinner">  <div class="bounce1"></div> <div class="bounce2"></div> <div class="bounce3"></div> </div></div></div></div>' ).show().css( {"padding-top": 60} );

                    jQuery( '.spb_preview_fmodal_content' ).load( $( "#post-preview" ).attr( 'href' ) );


                }
            }
        );


        $( '.asset-auto-complete' ).live(
            'input', function( event ) {

                if ( $( this ).val().length > 1 ) {

                    var str = $( this ).val();
                    str = str.toLowerCase().replace(
                        /\b[a-z]/g, function( letter ) {
                            return letter.toUpperCase();
                        }
                    );

                    var txAux = str;
                    var foundResults = false;

                    $( '.spb-content-elements > li' ).find( 'a' ).each(
                        function() {

                            if ( $( this ).html().indexOf( txAux ) < 0 )
                                $( this ).hide();
                            else {
                                $( this ).show();
                                foundResults = true;
                            }

                        }
                    );

                } else {

                    $( '.spb-content-elements > li' ).find( 'a' ).show();
                }

                if ( $( this ).val() == '' || !foundResults )
                    $( '.spb-content-elements > li' ).find( 'a' ).show();

            }
        );

		$('.search-icon-grid').live('input', function(event){

		if( $(this).val().length > 1 ) {



			 var str = $(this).val();
			 str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
   					 return letter.toUpperCase();
				});

			var txAux = str.toLowerCase();
			var foundResults = false;

			$('.font-icon-grid > li').find('span').each(function(){

				if ($(this).html().indexOf(txAux) < 0)
					$(this).parent().hide();
				else{
					$(this).parent().show();
					foundResults = true;
				}

			});

			}else{

				$('.font-icon-grid > li').show();
			}


	});



        $( "#swift_page_builder .dropable_el, #swift_page_builder .dropable_column" ).draggable(
            {
                helper: function() {
                    return $( '<div id="drag_placeholder">' + $( this ).html() + '</div>' ).appendTo( 'body' )
                },
                zIndex: 999999999999,
                //cursorAt: { right: 1, top : 15 },
                //cursor: "pointer",
                revert: "invalid",
                distance: 2,
                start: function( event, ui ) {

                    jQuery( 'body' ).addClass( 'startedDragging' );
                    jQuery( '.metabox-builder-content' ).removeClass( 'empty-builder' );
                    jQuery( '.spb-item-slideout' ).hide();
                    jQuery( '.spb-item-slideout' ).removeClass( 'selected' );
                    jQuery( '.dropdown-toggle' ).removeClass( 'selected' );
                    jQuery( '.dropdown' ).removeClass( 'open' );


                    $( '.main_wrapper' ).prepend( '<div class="newtop_sortable_element spb_first spb_last"><div class="new_element_col1"><div class="new_element_plus_sign">+</div></div><div class="new_element_col2"> <div class="newtop_element_text"> Drop Here</div></div></div>' );

                    //New code for droppable areas between elements
                    var elementpos = 0;
                    $( '.sortable_1st_level' ).each(
                        function( index ) {

                            if ( $( this ).parent().hasClass( 'spb_main_sortable' ) && $( this ).hasClass( 'spb_last' ) ) {

                                elementpos++;
                                $( this ).after( '<div class="new_sortable_element spb_first spb_last" datael-position="' + elementpos + '"><div class="new_element_col1"><div class="new_element_plus_sign">+</div></div><div class="new_element_col2"> <div class="newtop_element_text"> Drop Here</div></div></div>' );

                            }

                        }
                    );

                    var rowtop = 1;
                    $( '.spb_row .spb_column_container' ).each(
                        function( index ) {

                            jQuery( this ).prepend( '<div datael-position="1" datael-class="row_top_' + rowtop + '" class="newrowtop_sortable_element spb_first spb_last"><div class="new_element_col1"><div class="new_element_plus_sign">+</div></div><div class="new_element_col2"> <div class="newtop_element_text"> Drop Here</div></div></div>' );
                            jQuery( this ).addClass( 'row_top_' + rowtop );
                            rowtop++;
                        }
                    );

                    elementpos = 0;

                    $( '.spb_row .spb_sortable' ).each(
                        function( index ) {

                            if ( $( this ).parent().hasClass( 'spb_column_container' ) && $( this ).hasClass( 'spb_last' ) ) {

                                elementpos++;
                                $( this ).addClass( 'spb_row_' + elementpos );
                                $( this ).after( '<div class="newrow_sortable_element spb_first spb_last" datael-position="' + elementpos + '"><div class="new_element_col1"><div class="new_element_plus_sign">+</div></div><div class="new_element_col2"> <div class="newtop_element_text"> Drop Here</div></div></div>' );

                            }

                        }
                    );


                    initDroppable();

                },
                stop: function( event, ui ) {
                    jQuery( 'body' ).removeClass( 'startedDragging' );
                    //Hide new Drop Areas
                    jQuery( '.newtop_sortable_element' ).remove();
                    jQuery( '.new_sortable_element' ).remove();
                    jQuery( '.newrowtop_sortable_element' ).remove();
                    jQuery( '.newrow_sortable_element' ).remove();

                }

            }
        );
        initDroppable();

        /* Make menu elements dropable */

        //$('.dropdown-toggle').dropdown();

        $( '.dropdown-toggle' ).on(
            'click', function( e ) {

                e.preventDefault();

                $( '.dropdown-toggle' ).removeClass( 'selected' );

                if ( $( this ).hasClass( 'spb_content_elements' ) ) {

                    if ( $( '.spb-content-elements' ).hasClass( 'selected' ) ) {

                        slideout = $( this ).attr( 'data-slideout' );
                        slideoutElement = $( '.' + slideout );
                        slideoutElement.slideUp( 400 );
                        $( '.spb-content-elements' ).removeClass( 'selected' );
                        $( '.spb-item-slideout' ).removeClass( 'selected' );
                        return;
                    }

                }


                if ( !$( this ).hasClass( 'spb_prebuilt_pages' ) ) {
                    $( '.spb-prebuilt-pages-fullscreen' ).slideUp( 400 );
                    $( '.spb-prebuilt-pages-fullscreen' ).removeClass( 'selected' );
                    $( '.spb-content-elements' ).removeClass( 'selected' );
                    $( '.spb-item-slideout' ).removeClass( 'selected' );
                }

                if ( $( this ).hasClass( 'spb_prebuilt_pages' ) ) {

                    if ( $( '.spb-prebuilt-pages' ).hasClass( 'selected' ) ) {
                        slideout = $( this ).attr( 'data-slideout' );
                        slideoutElement = $( '.' + slideout );
                        slideoutElement.slideUp( 400 );
                        $( '.spb-item-slideout' ).removeClass( 'selected' );
                        return;
                    }

                }

                if ( $( this ).hasClass( 'spb_prebuilt_pages' ) ) {

                    $( '.spb-item-slideout' ).removeClass( 'selected' );
                    if ( !$( 'body' ).hasClass( 'spb-fullscreen-mode' ) ) {
                        $( '.spb-content-elements' ).removeClass( 'selected' );
                        $( '.spb-content-elements' ).hide();
                    }
                }

                if ( $( this ).hasClass( 'spb_content_elements' ) ) {
                    $( '.spb-prebuilt-pages' ).removeClass( 'selected' );
                    $( '.spb-prebuilt-pages' ).hide();
                    $( '.spb_columns' ).parent().removeClass( 'open' );

                }

                if ( $( this ).hasClass( 'spb-prebuilt-pages' ) ) {
                    $( '.spb-content-elements' ).removeClass( 'selected' );
                    $( '.spb-content-elements' ).hide();

                }

                if ( $( '#spb-elements' ).hasClass( 'subnav-fixed' ) || $( this ).hasClass( 'spb_templates' ) || $( this ).hasClass( 'spb_custom_elements' ) || $( this ).hasClass( 'spb_columns' ) ) {

                    slideOutClose();

                    if ( $( this ).parent().hasClass( 'open' ) ) {
                        $( this ).parent().removeClass( 'open' );
                        return
                    } else {
                        $( '#spb-elements .dropdown' ).removeClass( 'open' );
                        $( this ).parent().addClass( 'open' );
                    }

                } else {

                    $( '.dropdown' ).removeClass( 'open' );


                    var slideOutWrap = $( '#spb-option-slideout' ),
                        slideout = $( this ).attr( 'data-slideout' ),
                        slideoutElement = $( '.' + slideout );

                    //if ($(this).hasClass('spb_prebuilt_pages'))
                    if ( $( this ).hasClass( 'spb-prebuilt-pages-fullscreen' ) )
                        slideOutWrap = $( '.spb-prebuilt-pages-fullscreen' );

                    if ( slideoutElement.hasClass( 'selected' ) ) {
                        $( '.spb-item-slideout' ).removeClass( 'selected' );
                        $( '.spb-prebuilt-pages-fullscreen' ).removeClass( 'selected' );
                        slideoutElement.slideUp( 400 );


                        return;
                    }

                    $( this ).addClass( 'selected' );

                    if ( slideOutWrap.hasClass( 'open' ) ) {

                        slideOutClose();
                        $( '.spb-item-slideout' ).removeClass( 'selected' );

                        setTimeout(
                            function() {

                                slideoutElement.slideDown();

                            }, 600
                        );

                        slideoutElement.addClass( 'selected' );
                        slideOutWrap.removeClass( 'open' );

                    } else {

                        slideOutWrap.addClass( 'open' );
                        slideoutElement.addClass( 'selected' );
                        slideoutElement.slideDown();
                    }

                }

            }
        );

        function slideOutClose() {

            $( '.spb-item-slideout' ).slideUp( 400 );

        };

        $('#publish').click(function() {
            $('#spb_content').html("");
        });

        $( ".clickable_layout_action" ).click(
            function( e ) {

                $( '.dropdown-toggle' ).removeClass( 'selected' );
                $( '.dropdown' ).removeClass( 'open' );

            }
        );

        /* Add action for menu buttons with 'clickable_action' class name */
        $( "#spb-elements .clickable_action" ).click(
            function( e ) {
                e.preventDefault();

                if ( currentAsset == "" ) {
                    currentAsset = $( '.main_wrapper' );
                }

                if ( (jQuery( this ).hasClass( 'spb_accordion_nav' ) && currentAsset.parents( '.spb_tabs' ).length > 0)
                    || (jQuery( this ).hasClass( 'spb_tabs_nav' ) && currentAsset.parents( '.spb_accordion' ).length > 0 ) ) {
                    currentAsset = "";
                    close_elements_dropdown();
                } else {
                    getElementMarkup( currentAsset, $( this ), "initDroppable" );
                    currentAsset = "";
                    close_elements_dropdown();
                }


            }
        );

        $( ".spb-content-elements .clickable_action" ).click(
            function( e ) {

                e.preventDefault();

                if ( currentAsset == "" ) {
                    currentAsset = $( '.main_wrapper' );
                }

                getElementMarkup( currentAsset, $( this ), "initDroppable" );
                currentAsset = "";
                slideOutClose();
                close_elements_dropdown();
                $( '.spb-item-slideout' ).removeClass( 'selected' );


            }
        );

        $( "#spb-elements .clickable_layout_action" ).click(
            function( e ) {
                e.preventDefault();

                getElementMarkup( $( '.main_wrapper' ), $( this ), "initDroppable" );


            }
        );

        $( '.add-element-to-column' ).live(
            "click", function( e ) {
                e.preventDefault();

                currentAsset = $( this ).parent().parent();

                open_elements_dropdown();
            }
        );

        columnControls();
        /* Set action for column sizes and delete buttons */


        if ( $( "#swift_page_builder" ).length == 1 ) {
            $( 'div#postdivrich' ).before( '<p class="page-builder-switch"><a class="spb_switch-to-builder button-primary" style="display:none;" href="#">Swift Page Builder</a></p>' );

            var postdivrich = $( '#postdivrich' ),
                swiftPageBuilder = $( '#swift_page_builder' ),
                pageVars = getURLVars();

            $( '.spb_switch-to-builder' ).click(
                function( e ) {
                    e.preventDefault();
                    if ( postdivrich.is( ":visible" ) ) {

                        if ( !isTinyMceActive() ) {
                            if ( switchEditors != undefined )  $( '#content-tmce' ).get( 0 ).click();
                        }
                        postdivrich.hide();
                        swiftPageBuilder.show();
                        $( '#spb_js_status' ).val( "true" );
                        $( this ).html( 'Classic editor' );

                        spb_shortcodesToBuilder();
                        spb_navOnScroll();

                        // } else {
                        //	alert("Please switch default WordPress editor to 'Visual' mode first.");
                        // }
                    }
                    else {
                        jQuery.swift_page_builder.save_spb_html();
                        postdivrich.show();
                        swiftPageBuilder.hide();
                        $( '#spb_js_status' ).val( "false" );
						$(window).trigger('resize');
                        $( this ).html( 'Swift Page Builder' );

                    }
                }
            );

            if ( pageVars['spb_enabled'] && $( '#spb_js_status' ).val() === "false" ) {
                $( '.spb_switch-to-builder' ).trigger( 'click' );
            }

            /* Decide what editor to show on load
             ---------------------------------------------------------- */
            if ( $( '#spb_js_status' ).val() == 'true' && jQuery( '#wp-content-wrap' ).hasClass( 'tmce-active' ) ) {
                //if ( isTinyMceActive() == true ) {
                postdivrich.hide();
                swiftPageBuilder.show();
                $( '.spb_switch-to-builder' ).html( 'Classic editor' );

                //} else {
                //	alert("Please switch default WordPress editor to 'Visual' mode first.");
                //}

                //spb_shortcodesToBuilder();
            } else {
                postdivrich.show();
                swiftPageBuilder.hide();
                $( '.spb_switch-to-builder' ).html( 'Swift Page Builder' );
                $( '.spb_switch-to-builder' ).show();
            }
        }
        jQuery( window ).load(
            function() {
                if ( $( '#spb_js_status' ).val() == 'true' && jQuery( '#wp-content-wrap' ).hasClass( 'tmce-active' ) ) {
                    //spb_shortcodesToBuilder();
                    window.setTimeout( 'spb_shortcodesToBuilder()', 50 );
                    spb_navOnScroll();
                }
            }
        );

        /*** Toggle click (FAQ) ***/
        jQuery( ".toggle_title" ).live(
            "click", function( e ) {
                if ( jQuery( this ).hasClass( 'toggle_title_active' ) ) {
                    jQuery( this ).removeClass( 'toggle_title_active' ).next().hide();
                } else {
                    jQuery( this ).addClass( 'toggle_title_active' ).next().show();
                }
            }
        );

        /*** Gallery Controls / Site attached images ***/
        $.swift_page_builder.galleryImagesControls();
        /* Actions for gallery images handling */
        /*jQuery('.gallery_widget_attached_images_list').each(function(index) {
         attachedImgSortable(jQuery(this));
         });*/

        /*** Template System ***/
        spb_templateSystem();

        /*** Element System ***/
        spb_customElementSystem();

        $( '#swift_page_builder' ).on(
            'click', '.add-text-block-to-content', function( e ) {
                e.preventDefault();
                if ( $( this ).attr( 'parent-container' ) ) {
                    if ( $( this ).parent().parent().hasClass( 'ui-accordion-content' ) || $( this ).parent().parent().hasClass( 'ui-tabs-panel' ) ) {
                        getElementMarkup( $( this ).parent().parent(), $( '#spb_text_block' ) );
                    } else if ( $( this ).parent().parent().parent().hasClass( 'ui-accordion-content' ) || $( this ).parent().parent().parent().hasClass( 'ui-tabs-panel' ) ) {
                        getElementMarkup( $( this ).parent().parent(), $( '#spb_text_block' ) );
                    } else if ( $( this ).parent().parent().hasClass( 'spb_column_container' ) ) {
                        getElementMarkup( $( this ).parent().parent(), $( '#spb_text_block' ) );
                    } else {
                        getElementMarkup( $( $( this ).attr( 'parent-container' ) ), $( '#spb_text_block' ) );
                    }
                } else {
                    getElementMarkup( $( this ).parent().parent().parent(), $( '#spb_text_block' ) );
                }
            }
        );

        function sortElementsDropdown() {

            var mylist = $( '.spb_content_elements' ).parent().find( 'ul' );
            var listitems = mylist.children( 'li' ).get();
            listitems.sort(
                function( a, b ) {
                    var compA = $( a ).text().toUpperCase();
                    var compB = $( b ).text().toUpperCase();
                    return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
                }
            )
            $.each(
                listitems, function( idx, itm ) {
                    mylist.append( itm );
                }
            );

        }

        sortElementsDropdown();

        function sortElementsSlideout() {

            var mylist = $( '.spb-content-elements' );
            var listitems = mylist.children( 'li' ).get();
            listitems.sort(
                function( a, b ) {
                    var compA = $( a ).text().toUpperCase();
                    var compB = $( b ).text().toUpperCase();
                    return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
                }
            )
            $.each(
                listitems, function( idx, itm ) {
                    mylist.append( itm );
                }
            );

        }

        sortElementsSlideout();


        $( '.alt_background' ).live(
            'change', function() {
                $( '.altbg-preview' ).attr( 'class', 'altbg-preview' );
                $( '.altbg-preview' ).addClass( jQuery( this ).val() );
            }
        );

        $( '#clear-spb' ).on(
            'click', function( e ) {
                e.preventDefault();
                clear_page_builder_content();
            }
        );

        $( '.columns-dropdown' ).before( '<ul class="nav assetsearch" style="display:none;"><input type="text" class="asset-auto-complete" placeholder="Search Element"></ul>' );

        $( '#fullscreen-spb' ).on(
            'click', function( e ) {


                e.preventDefault();

                //If the Elements Dropdown was open when we entered in fullscreen, let's close it all

                $( '.spb-item-slideout' ).hide();
                $( '.spb-item-slideout' ).removeClass( 'selected' );
                $( '.dropdown-toggle' ).removeClass( 'selected' );
                $( '.dropdown' ).removeClass( 'open' );

                $( '.spb-prebuilt-pages' ).addClass( 'spb-prebuilt-pages-fullscreen' );
                $( '.spb-prebuilt-pages' ).removeClass( 'spb-item-slideout' );
                $( 'body' ).addClass( 'spb-fullscreen-mode' );
                $( '.normalscreen-step1' ).hide();
                $( '.previewpage-spb' ).show();
                $( '.spb-item-slideout-fullscreen' ).show();
                $( '#spb-empty' ).addClass( 'spb-empty-fullscreen' );
                $( '.assetsearch' ).show();
                $( '.fullscreen-step1' ).show();
                $( '.spb-item-slideout' ).addClass( 'spb-item-slideout-fullscreen' );
                $( '.spb-item-slideout-fullscreen' ).removeClass( 'spb-item-slideout' );
                $( '.spb-item-slideout-fullscreen' ).show();
                $( '.spb_content_elements' ).hide();
                $( '.spb-prebuilt-pages' ).hide();
                $( '#spb-option-slideout' ).addClass( 'spb-option-slideout-fullscreen-aux' );

                initDroppable();


            }
        );

        $( '#close-fullscreen-spb' ).on(
            'click', function( e ) {

                e.preventDefault();

                $( '#spb-option-slideout' ).removeClass( 'spb-option-slideout-fullscreen-aux' );
                $( '.spb-item-slideout-fullscreen' ).addClass( 'spb-item-slideout' );
                $( '.spb-item-slideout' ).removeClass( 'spb-item-slideout-fullscreen' );
                $( '.spb-item-slideout' ).hide();


                $( '.spb-content-elements > li' ).find( 'a' ).show();
                $( '.asset-auto-complete' ).val( '' );
                $( ".previewpage-spb" ).hide();
                $( '.assetsearch' ).hide();
                $( '.fullscreen-step1' ).hide();
                $( '.normalscreen-step1' ).show();
                $( '.spb-prebuilt-pages-fullscreen' ).removeClass( 'selected' );
                $( '.spb-prebuilt-pages-fullscreen' ).removeClass( 'open' );
                $( '.spb-item-slideout-fullscreen' ).hide();
                $( 'body' ).removeClass( 'spb-fullscreen-mode' );
                $( '#spb-empty' ).removeClass( 'spb-empty-fullscreen' );
                $( '.spb-prebuilt-pages' ).removeClass( 'spb-prebuilt-pages-fullscreen' );
                $( '.spb-prebuilt-pages' ).addClass( 'spb-item-slideout' );
                $( '.spb_content_elements' ).show();
                $( '.spb-item-slideout' ).hide();
                $( '.dropdown-toggle' ).removeClass( 'selected' );
                $( '.spb_templates' ).removeClass( 'open' );

            }
        );

        //Check if we are in Fullscreen Page Builder mode
        function spb_is_fullscreen() {

            if ( $( 'body' ).hasClass( 'spb-fullscreen-mode' ) ) {
                return true;
            }
            else {
                return false;
            }


        }


    }
); // end jQuery(document).ready

function open_elements_dropdown() {
    jQuery( '.spb_content_elements:first' ).trigger( 'click' );
}

function close_elements_dropdown() {
    jQuery( '.spb_content_elements' ).parents( '.content-dropdown' ).removeClass( 'open' );
    jQuery( '.spb_content_elements' ).removeClass( 'selected' );
}

function open_layouts_dropdown() {
    jQuery( '.spb_popular_layouts:first' ).trigger( 'click' );
}

function open_custom_elements_dropdown() {
    jQuery( '.spb_custom_elements:first' ).trigger( 'click' );
}

/**
 * Swift Page Builder class
 */

function spb_templateSystem() {
    jQuery( '#spb_save_template' ).live(
        "click", function( e ) {
            e.preventDefault();


            var template_name = prompt( "Please enter a name to save the template as.", '' );
            if ( template_name != null && template_name != "" ) {
                var template = generateShortcodesFromHtml( jQuery( ".spb_main_sortable" ) );

                removeClassProcessedElements();
                var data = {
                    action: 'spb_save_template',
                    template: template,
                    template_name: template_name
                };

                jQuery.post(
                    ajaxurl, data, function( response ) {
                        jQuery( '.spb_templates_ul' ).html( response );
                    }
                );
            } else {
                alert( "There has been an error. Please try again." );
            }
        }
    );

    jQuery( '.sf_prebuilt_template a' ).live(
        "click", function( e ) {
            e.preventDefault();

            var data = {
                action: 'sf_load_template',
                template_id: jQuery( this ).attr( 'data-template_id' )
            };

            jQuery.post(
                ajaxurl, data, function( response ) {
                    jQuery( '.spb_main_sortable' ).append( response ).find( ".spb_init_callback" ).each(
                        function( index ) {
                            var fn = window[jQuery( this ).attr( "value" )];
                            if ( typeof fn === 'function' ) {
                                fn( jQuery( this ).closest( '.spb_content_element' ) );
                            }
                        }
                    );

                    initDroppable();
                    save_spb_html();
                }
            );

            jQuery( '.spb-item-slideout' ).slideUp( 400 );
            jQuery( '.spb-prebuilt-pages-fullscreen' ).slideUp( 400 );
            jQuery( '.spb_prebuilt_pages' ).removeClass( 'selected' );
            jQuery( '.spb_prebuilt_pages' ).removeClass( 'open' );
            jQuery( '.spb-prebuilt-pages-fullscreen' ).removeClass( 'selected' );
            jQuery( '.spb-prebuilt-pages-fullscreen' ).removeClass( 'open' );
            jQuery( '.spb-item-slideout' ).removeClass( 'open' );
            jQuery( '.spb-item-slideout' ).removeClass( 'selected' );


        }
    );

    jQuery( '.spb_template_li a' ).live(
        "click", function( e ) {
            e.preventDefault();
            var data = {
                action: 'spb_load_template',
                template_id: jQuery( this ).attr( 'data-template_id' )
            };

            jQuery.post(
                ajaxurl, data, function( response ) {
                    jQuery( '.spb_main_sortable' ).append( response ).find( ".spb_init_callback" ).each(
                        function( index ) {
                            var fn = window[jQuery( this ).attr( "value" )];
                            if ( typeof fn === 'function' ) {
                                fn( jQuery( this ).closest( '.spb_content_element' ) );
                            }
                        }
                    );
                    //
                    initDroppable();
                    save_spb_html();
                }
            );

            jQuery( this ).parents( '.custom-templates-nav' ).find( '.dropdown' ).removeClass( 'open' );
        }
    );

    jQuery( '.spb_remove_template' ).live(
        "click", function( e ) {
            e.preventDefault();
            var template_name = jQuery( this ).closest( '.spb_template_li' ).find( 'a' ).text();
            var answer = confirm( "Confirm deletion of '" + template_name + "' template, or press Cancel to leave. This action cannot be undone." );
            if ( answer ) {

                var data = {
                    action: 'spb_delete_template',
                    template_id: jQuery( this ).closest( '.spb_template_li' ).find( 'a' ).attr( 'data-template_id' )
                };

                jQuery.post(
                    ajaxurl, data, function( response ) {
                        jQuery( '.spb_templates_ul' ).html( response );
                    }
                );
            }
        }
    );
}

function spb_customElementSystem() {
    jQuery( '.element-save' ).live(
        "click", function( e ) {
            e.preventDefault();


            var element_name = prompt( "Please enter a name to save the element as.", '' );
            if ( element_name != null && element_name != "" ) {
                var element = generateShortcodesFromHtml( jQuery( this ).closest( '.spb_sortable' ), true );
                removeClassProcessedElements();

                var data = {
                    action: 'spb_save_element',
                    element: element,
                    element_name: element_name
                };

                jQuery.post(
                    ajaxurl, data, function( response ) {
                        jQuery( '.spb_custom_elements_ul' ).html( response );
                    }
                );
            } else {
                alert( "There has been an error. Please try again." );
            }
        }
    );

    jQuery( '.spb_elements_li a' ).live(
        "click", function( e ) {
            e.preventDefault();
            var data = {
                action: 'spb_load_element',
                element_id: jQuery( this ).attr( 'data-element_id' )
            };

            jQuery.post(
                ajaxurl, data, function( response ) {
                    jQuery( '.spb_main_sortable' ).append( response ).find( ".spb_init_callback" ).each(
                        function( index ) {
                            var fn = window[jQuery( this ).attr( "value" )];
                            if ( typeof fn === 'function' ) {
                                fn( jQuery( this ).closest( '.spb_content_element' ) );
                            }
                        }
                    );
                    //
                    initDroppable();
                    save_spb_html();
                }
            );


            jQuery( this ).parents( '.custom-elements-nav' ).find( '.dropdown' ).removeClass( 'open' );
        }
    );

    jQuery( '.spb_remove_element' ).live(
        "click", function( e ) {
            e.preventDefault();
            var element_name = jQuery( this ).closest( '.spb_elements_li' ).find( 'a' ).text();
            var answer = confirm( "Confirm deletion of '" + element_name + "', or press Cancel to leave. This action cannot be undone." );
            if ( answer ) {

                var data = {
                    action: 'spb_delete_element',
                    element_id: jQuery( this ).closest( '.spb_elements_li' ).find( 'a' ).attr( 'data-element_id' )
                };

                jQuery.post(
                    ajaxurl, data, function( response ) {
                        jQuery( '.spb_custom_elements_ul' ).html( response );
                    }
                );
            }
        }
    );
}

// fix sub nav on scroll
var $win, $nav, navTop, isFixed = 0;
function spb_navOnScroll() {
    $win = jQuery( window );
    $nav = jQuery( '#spb-elements' );

    if ( jQuery( '#spb-elements' ).is( ":visible" ) ) {
        navTop = jQuery( '#spb-elements' ).length && jQuery( '#spb-elements' ).offset().top - 28;
    } else {

        navTop = jQuery( '#swift_page_builder' ).offset().top - 28;
    }

    isFixed = 0;

    spb_processScroll();
    $win.on( 'scroll', spb_processScroll );
}
function spb_processScroll() {
    var i,
        scrollTop = $win.scrollTop();

    if ( scrollTop >= navTop && !isFixed ) {
        isFixed = 1;
        $nav.addClass( 'subnav-fixed' )

    } else if ( scrollTop <= navTop && isFixed ) {
        isFixed = 0;
        $nav.removeClass( 'subnav-fixed' );
        jQuery( '#spb-elements .dropdown' ).removeClass( 'open' )
    }
}


function hideEditFormSaveButton() {
    jQuery( '#spb_edit_form .edit_form_actions' ).hide();
}
function showEditFormSaveButton() {
    jQuery( '#spb_edit_form .edit_form_actions' ).show();
}

function check_form_dependency_fields() {

    jQuery("#spb_edit_form .depency-field").each(function( index ) {

    		var field_operator = jQuery(this).attr('data-parent-operator');
    		var field_value = jQuery(this).attr('data-parent-value');

    		switch ( field_operator ) {
   				case '=':
				case 'equals':
					if (jQuery('#spb_edit_form  .'+jQuery(this).attr('data-parent-id')).val() == field_value) {
						//Show the depency field
						jQuery(this).removeClass("hide");
					} else {
						//Hide the depency field
						jQuery(this).addClass("hide");
					}
					break;
				case '!=':
				case 'not':
					var field_values_array = jQuery(this).attr('data-parent-value').split(',');
					var logical_statement = '';
					var current_field = jQuery(this);
					var valid_counter = 0;

					jQuery.each(field_values_array, function(index, value) {
						logical_statement = jQuery('#spb_edit_form  .'+current_field.attr('data-parent-id')).val() != value.trim();
						if ( logical_statement ) {
							valid_counter++;
						}
					});

					if ( valid_counter == field_values_array.length ) {
						//Show the depency field
						jQuery(this).removeClass("hide");
					} else {
						//Hide the depency field
						jQuery(this).addClass("hide");
					}
					break;
				case 'or':
					var field_values_array = jQuery(this).attr('data-parent-value').split(',');
					var logical_statement = '';
					var current_field = jQuery(this);
					var valid_counter = 0;

					jQuery.each(field_values_array, function(index, value) {
						logical_statement = jQuery('#spb_edit_form  .'+current_field.attr('data-parent-id')).val() != value.trim();
						if ( logical_statement ) {
							valid_counter++;
						}
					});

					if ( valid_counter == field_values_array.length ) {
						//Hide the depency field
						jQuery(this).addClass("hide");
					} else {
						//Show the depency field
						jQuery(this).removeClass("hide");
					}
					break;
			}

     });
}

/* Updates ids order in hidden input field, on drag-n-drop reorder */
function updateSelectedImagesOrderIds( img_ul ) {
    var img_ids = new Array();

    jQuery( img_ul ).find( '.added img' ).each(
        function() {
            img_ids.push( jQuery( this ).attr( "rel" ) );
        }
    );

    jQuery( img_ul ).parent().prev().prev().val( img_ids.join( ',' ) );
}

/* Takes ids from hidden field and clone li's */
function cloneSelectedImages( site_img_div, attached_img_div ) {
    var hidden_ids = jQuery( attached_img_div ).prev().prev(),
        ids_array = (hidden_ids.val().length > 0) ? hidden_ids.val().split( "," ) : new Array(),
        img_ul = attached_img_div.find( '.gallery_widget_attached_images_list' );

    img_ul.html( '' );

    jQuery.each(
        ids_array, function( index, value ) {
            jQuery( site_img_div ).find( 'img[rel=' + value + ']' ).parent().clone().appendTo( img_ul );
        }
    );
    attachedImgSortable( img_ul );
}

function attachedImgSortable( img_ul ) {
    jQuery( img_ul ).sortable(
        {
            forcePlaceholderSize: true,
            placeholder: "widgets-placeholder",
            cursor: "move",
            items: "li",
            update: function() {
                updateSelectedImagesOrderIds( img_ul );
            }
        }
    );
}


/* Get content from tinyMCE editor and convert it to Page Builder Assets
 ---------------------------------------------------------- */
function spb_shortcodesToBuilder() {
    var content = spb_getContentFromTinyMCE();

    if ( jQuery.trim( content ).length > 0 && jQuery.trim( content ).substr(
            0, 1
        ) != "[" && jQuery.trim( content ).substr( 0, 5 ) != "<span" ) {
        alert( "By switching to the page builder, any content not in page builder assets will be removed for consistency." );
        //content = '[spb_text_block pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]' + content + '[/spb_text_block]';
        if ( isTinyMceActive() ) {
            tinyMCE.get( 'content' ).setContent( content );
        } else {
            content = jQuery( '#content' ).text( content );
        }
    }

    jQuery( '.spb_main_sortable' ).html( jQuery( '#spb_loading' ).val() );
    jQuery( '.spb_switch-to-builder' ).hide();


    var data = {
        action: 'spb_shortcodes_to_builder',
        content: content
    };

    jQuery.post(
        ajaxurl, data, function( response ) {

            jQuery( '.spb_main_sortable' ).html( response );
            spb_elements_hide_controls( true );
            jQuery.swift_page_builder.isMainContainerEmpty();
            jQuery( '.spb_switch-to-builder' ).show();
            //
            //console.log(response);
            jQuery.swift_page_builder.addLastClass( jQuery( ".spb_main_sortable" ) );
            initDroppable();

            //Fire INIT callback if it is defined
            jQuery( '.spb_main_sortable' ).find( ".spb_init_callback" ).each(
                function( index ) {
                    var fn = window[jQuery( this ).attr( "value" )];
                    if ( typeof fn === 'function' ) {
                        fn( jQuery( this ).closest( '.spb_sortable' ) );
                    }
                }
            );
        }
    );


}

/* get content from tinyMCE editor
 ---------------------------------------------------------- */
function spb_getContentFromTinyMCE() {
    var content = '';

    //if ( tinyMCE.activeEditor ) {
    if ( isTinyMceActive() ) {
        var spb_ed = tinyMCE.get( 'content' ); // get editor instance
        content = spb_ed.save();
    } else {
        content = jQuery( '#content' ).text();
    }
    return content;
}


function moved( e ) {

    var sortables = jQuery( ".spb_sortable" );

    //Dragged item's position++
    var dpos = draggedItem.position();
    var d = {
        top: dpos.top,
        bottom: dpos.top + draggedItem.height(),
        left: dpos.left,
        right: dpos.left + draggedItem.width()
    };

    //Find sortable elements covered by draggedItem
    var hoveredOver = sortables.not( draggedItem ).filter(
        function() {
            var t = jQuery( this );
            var pos = t.position();

            //This spb_sortable's position++
            var p = {
                top: pos.top,
                bottom: pos.top + t.height(),
                left: pos.left,
                right: pos.left + t.width()
            };

            //itc = intersect
            var itcTop = p.top <= d.bottom;
            var itcBtm = d.top <= p.bottom;
            var itcLeft = p.left <= d.right;
            var itcRight = d.left <= p.right;
            var itcDivx = false;
            var itcDivy = false;

            var difx = d.left - p.left;
            var dify = p.bottom - d.bottom;
            dify = Math.abs( dify );

            if ( difx < (t.width()) && difx > 0 ) {
                itcDivx = true;
            }

            if ( dify < (t.height()) && dify > 0 ) {
                itcDivy = true;
            }

            return itcTop && itcBtm && itcLeft && itcRight && itcDivx && itcDivy;
        }
    );


    hoveredOver.each(
        function() {

            if ( jQuery( this ).hasClass( 'spb_first' ) ) {
                jQuery( this ).removeClass( 'spb_first' );

            }

        }
    );
};

function spb_elements_hide_controls( display ) {
    if ( display ) {
        jQuery( '.controls_right , .column_size_wrapper' ).hide();
        jQuery( '.spb_map_pin .controls_right , .spb_map_pin .column_size_wrapper' ).show();
    } else {
        jQuery( '.controls_right , .column_size_wrapper' ).show();
    }

}


/* This makes layout elements droppable, so user can drag
 them from on column to another and sort them (re-order)
 within the current column
 ---------------------------------------------------------- */
function initDroppable() {


    jQuery( '.spb_sortable_container:not(.not-sortable)' ).sortable(
        {

            forcePlaceholderSize: true,
            opacity: 0.9,
            connectWith: ".spb_sortable_container",
            placeholder: "widgets-placeholder",
            helper: function( event, ui ) {
                return jQuery( '<div id="itemHelper" class="spb_content_element spb_sortable sortable_1st_level span4 spb_first spb_last"><div class="controls sidebar-name"> <div class="column_size_wrapper" style="display: none;"></div></div><div class="spb_element_wrapper"></div></div>' ).appendTo( 'body' )
            },
            //	tolerance: 'pointer',
            tolerance: 'intersect',
            scrollSensitivity: 120,
            distance: 5,
            cursorAt: {left: 80, top: 80},
            cursor: "move",
            cancel: '.spb_map_pin',
            start: function( event, ui ) {

                ui.helper.addClass( ui.item.attr( "data-element_type" ) );
                ui.helper.width( 230 );
                ui.helper.height( 104 );
                ui.helper.css( {minHeight: 104} );
                ui.helper.find( '.spb_element_wrapper' ).addClass( ui.item.attr( "data-element_type" ) + '_helper' );
                //jQuery(window).mousemove(moved);

                if ( ui.item.hasClass( 'span12' ) ) {
                    ui.placeholder.css( {maxWidth: ui.item.width()} );
                }
                else {
                    if ( ui.item.hasClass( 'spb_last' ) ) {
                        ui.placeholder.removeClass( 'widgets-placeholder' );
                        ui.placeholder.addClass( 'widgets-placeholder-last' );
                    }
                    ui.placeholder.css( {maxWidth: ui.item.width() / 100 * 85} );
                }


                jQuery( '#spb_content' ).addClass( 'sorting-started' );
                draggedItem = ui.item;
                jQuery( 'body' ).addClass( 'startedDragging' );

            },
            receive: function( event, ui ) {

                if ( ui.item.hasClass( 'spb_column' ) && ui.item.parents( '.spb_column' ).length > 0 ) {
                    jQuery( ui.sender ).sortable( 'cancel' );
                }

                if ( ui.item.hasClass( 'spb_accordion' ) && ui.item.parents( '.spb_tabs' ).length > 0 ) {
                    jQuery( ui.sender ).sortable( 'cancel' );
                }

                if ( ui.item.hasClass( 'spb_tabs' ) && ui.item.parents( '.spb_accordion' ).length > 0 ) {
                    jQuery( ui.sender ).sortable( 'cancel' );
                }
            },
            stop: function( event, ui ) {


                jQuery( '#spb_content' ).removeClass( 'sorting-started' );
                jQuery( window ).unbind( "mousemove", moved );
                jQuery.swift_page_builder.addLastClass( ".spb_main_sortable" );
                jQuery( 'body' ).removeClass( 'startedDragging' );


            },
            update: function() {

                jQuery.swift_page_builder.save_spb_html();
                removeClassProcessedElements();

            },

            beforeStop: function( event, ui ) {

                if ( ui.item.hasClass( 'not-column-inherit' ) && ui.placeholder.parent().hasClass( 'not-column-inherit' ) && ui.placeholder.parents( '.spb_row' ).length <= 0 ) {
                    return false;
                }

            }
        }
    ).disableSelection();


    jQuery( '.spb_column_container' ).sortable(
        {
            connectWith: ".spb_column_container, .spb_main_sortable",
            forcePlaceholderSize: true,
            placeholder: "widgets-placeholder",
            cursor: 'move',
            items: "div.spb_sortable",
            cancel: '.spb_gmaps',
            update: function() {

                jQuery.swift_page_builder.save_spb_html();
            }
        }
    );

    jQuery( '.spb_main_sortable' ).droppable(
        {
            greedy: true,
            accept: ".dropable_el, .dropable_column",
            drop: function( event, ui ) {
                //console.log(jQuery(this));

                getElementMarkup( jQuery( this ), ui.draggable, "addLastClass" );

            }
        }
    );


    jQuery( '.spb_row' ).droppable(
        {
            greedy: true,
            //tolerance: 'touch',
            accept: function( dropable_el ) {

                if ( dropable_el.hasClass( 'dropable_el' ) && jQuery( this ).hasClass( 'ui-droppable' ) && dropable_el.hasClass( 'not_dropable_in_third_level_nav' ) ) {
                    return false;
                } else if ( dropable_el.hasClass( 'dropable_el' ) == true || dropable_el.hasClass( 'dropable_column' ) == true ) {
                    return true;
                }

            },
            drop: function( event, ui ) {

                jQuery( this ).parent().removeClass( "spb_ui-state-active" );
                getElementMarkup( jQuery( this ), ui.draggable, "addLastClass" );
                spb_elements_hide_controls( false );
                jQuery( ui.item ).removeClass( 'controls_back' );
            }
        }
    );


    jQuery( '.spb_row' ).sortable(
        {
            connectWith: ".spb_column_container, .spb_main_sortable, .spb_row",
            //connectWith: " .spb_main_sortable",

            forcePlaceholderSize: true,
            placeholder: "widgets-placeholder",
            helper: function( event, ui ) {
                return jQuery( '<div id="itemHelper" class="spb_content_element spb_sortable sortable_1st_level span4 spb_first spb_last"><div class="controls sidebar-name"> <div class="column_size_wrapper" style="display: none;"></div></div><div class="spb_element_wrapper"></div></div>' ).appendTo( 'body' )
            },
            cursor: 'move',
            start: function( event, ui ) {

                ui.helper.addClass( ui.item.attr( "data-element_type" ) );
                ui.helper.width( 230 );
                ui.helper.height( 104 );
                ui.helper.css( {minHeight: 104} );
                ui.helper.find( '.spb_element_wrapper' ).addClass( ui.item.attr( "data-element_type" ) + '_helper' );
                //jQuery(window).mousemove(moved);

                if ( ui.item.hasClass( 'span12' ) ) {
                    ui.placeholder.css( {maxWidth: ui.item.width()} );
                }
                else {
                    ui.placeholder.css( {maxWidth: ui.item.width() / 100 * 85} );
                }

                jQuery( '#spb_content' ).addClass( 'sorting-started' );
                jQuery( '.spb_row' ).addClass( 'sorting-started' );
                draggedItem = ui.item;
                jQuery( 'body' ).addClass( 'startedDragging' );


            },
            stop: function() {

                jQuery( '#spb_content' ).removeClass( 'sorting-started' );
                jQuery( '.spb_row' ).removeClass( 'sorting-started' );
                jQuery.swift_page_builder.addLastClass( ".spb_main_sortable" );
                jQuery( 'body' ).removeClass( 'startedDragging' );

            },

            items: "div.spb_sortable:not(.spb_row)",
            //items: "div.spb_sortable:not(.spb_column)",
            update: function() {

                jQuery.swift_page_builder.save_spb_html();
                removeClassProcessedElements();

            },
        }
    );

    jQuery( '.spb_column_container' ).droppable(
        {
            greedy: true,
            accept: function( dropable_el ) {

                if ( dropable_el.hasClass( 'spb_accordion_nav' ) && jQuery( this ).parents( '.spb_tabs' ).length > 0 ) {
                    return false;
                }

                if ( dropable_el.hasClass( 'dropable_el' ) && jQuery( this ).hasClass( 'ui-droppable' ) && dropable_el.hasClass( 'not_dropable_in_third_level_nav' ) ) {
                    return false;
                } else if ( dropable_el.hasClass( 'dropable_el' ) == true ) {
                    return true;
                }

                if ( jQuery( this ).parents( '.spb_column' ).length > 0 && dropable_el.hasClass( 'dropable_column' ) ) {
                    return false;
                }

                if ( jQuery( this ).parents( '.spb_row' ).length > 0 && dropable_el.hasClass( 'dropable_column' ) ) {
                    return true;
                }

            },
            drop: function( event, ui ) {
                //console.log(jQuery(this));

                jQuery( this ).parent().removeClass( "spb_ui-state-active" );
                getElementMarkup( jQuery( this ), ui.draggable, "addLastClass" );
                spb_elements_hide_controls( false );
                jQuery( ui.item ).removeClass( 'controls_back' );
            }
        }
    );


    jQuery( '.newtop_sortable_element' ).droppable(
        {
            greedy: true,
            accept: ".dropable_el, .dropable_column, .spb_sortable",
            hoverClass: "topelementover",
            zIndex: 99999999,
            drop: function( event, ui ) {

                getElementMarkup( jQuery( '.main_wrapper' ), ui.draggable, "topElement" );
                spb_elements_hide_controls( false );
                jQuery( ui.item ).removeClass( 'controls_back' );

                return false;


            }
        }
    );

    jQuery( '.new_sortable_element' ).droppable(
        {
            greedy: true,
            accept: ".dropable_el, .dropable_column",
            hoverClass: "topelementover",
            zIndex: 99999999,
            drop: function( event, ui ) {

                if ( jQuery( this ).hasClass( 'new_sortable_element' ) ) {
                    getElementMarkup( jQuery( this ), ui.draggable, "newElementDrop" );
                } else {
                    getElementMarkup( jQuery( this ), ui.draggable, "newRowElementDrop" );
                }

                jQuery( '.newtop_sortable_element' ).remove();
                jQuery( '.new_sortable_element' ).remove();
                jQuery( '.newrowtop_sortable_element' ).remove();
                jQuery( '.newrow_sortable_element' ).remove();
                jQuery.swift_page_builder.save_spb_html();

            }
        }
    );

    jQuery( '.newrowtop_sortable_element,  .newrow_sortable_element' ).droppable(
        {
            greedy: true,
            accept: function( dropable_el ) {

                if ( dropable_el.hasClass( 'dropable_el' ) ) {

                    return true;
                }
                if ( jQuery( this ).parents( '.spb_column' ).length > 0 && dropable_el.hasClass( 'dropable_column' ) ) {
                    return false;
                }

                if ( jQuery( this ).parents( '.spb_row' ).length > 0 && dropable_el.hasClass( 'dropable_column' ) ) {
                    return true;
                }

            },
            hoverClass: "topelementover",
            zIndex: 99999999,
            drop: function( event, ui ) {

                if ( jQuery( this ).hasClass( 'new_sortable_element' ) ) {
                    getElementMarkup( jQuery( this ), ui.draggable, "newElementDrop" );
                } else {
                    getElementMarkup( jQuery( this ), ui.draggable, "newRowElementDrop" );
                }

                jQuery( '.newtop_sortable_element' ).remove();
                jQuery( '.new_sortable_element' ).remove();
                jQuery( '.newrowtop_sortable_element' ).remove();
                jQuery( '.newrow_sortable_element' ).remove();
                jQuery.swift_page_builder.save_spb_html();

            }
        }
    );


}


/* Get initial html markup for content element. This function
 use AJAX to run do_shortcode and then place output code into
 main content holder
 ---------------------------------------------------------- */
function getElementMarkup( target, element, action ) {

    var data = {
        action: 'spb_get_element_backend_html',
        //column_index: jQuery(".spb_main_sortable .spb_sortable").length + 1,
        element: element.attr( 'id' ),
        data_element: element.attr( 'data-element' ),
        data_width: element.attr( 'data-width' )
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(
        ajaxurl, data, function( response ) {
            //alert('Got this from the server: ' + response);
            //jQuery(target).append(response);

            //Fire INIT callback if it is defined
            //jQuery(response).find(".spb_init_callback").each(function(index) {
            target.removeClass( 'empty_column' );
            elementpos = 1;

            if ( action == 'topElement' ) {

                jQuery( target ).prepend( response ).find( ".spb_init_callback" ).each(
                    function( index ) {
                        var fn = window[jQuery( this ).attr( "value" )];
                        if ( typeof fn === 'function' ) {
                            fn( jQuery( this ).closest( '.spb_content_element' ).removeClass( 'empty_column' ) );
                        }
                    }
                );
            } else if ( action == 'newElementDrop' ) {


                jQuery( '.sortable_1st_level' ).each(
                    function( index ) {

                        if ( jQuery( this ).parent().hasClass( 'spb_main_sortable' ) && jQuery( this ).hasClass( 'spb_last' ) ) {

                            if ( parseInt( jQuery( target ).attr( "datael-position" ) ) == elementpos ) {

                                if ( jQuery( this ).hasClass( 'spb_row' ) ) {

                                    if ( jQuery( target ).hasClass( 'newrowtop_sortable_element' ) ) {
                                        jQuery( this ).find( '.spb_column_container' ).prepend( response );
                                    } else {
                                        if ( jQuery( target ).hasClass( 'new_sortable_element' ) ) {
                                            jQuery( this ).after( response );
                                        }
                                        else {
                                            jQuery( this ).find( '.spb_column_container' ).append( response );
                                        }
                                    }

                                } else {
                                    jQuery( this ).after( response );
                                }


                                jQuery( '.main_wrapper' ).find( ".spb_init_callback" ).each(
                                    function( index ) {
                                        var fn = window[jQuery( this ).attr( "value" )];

                                        if ( typeof fn === 'function' ) {
                                            fn( jQuery( this ).closest( '.spb_content_element' ).removeClass( 'empty_column' ) );
                                        }
                                    }
                                );

                            }
                            elementpos++;

                        }

                    }
                );

            }


            else if ( action == 'newRowElementDrop' ) {


                if ( jQuery( target ).hasClass( 'newrowtop_sortable_element' ) ) {


                    jQuery( '.spb_row .spb_column_container' ).each(
                        function( index ) {

                            if ( jQuery( this ).hasClass( jQuery( target ).attr( "datael-class" ) ) ) {
                                jQuery( this ).prepend( response );
                            }


                        }
                    );

                } else {

                    jQuery( '.spb_row' ).find( '.spb_sortable' ).each(
                        function( index ) {

                            if ( parseInt( jQuery( target ).attr( "datael-position" ) ) == elementpos ) {

                                jQuery( '.spb_row_' + elementpos ).after( response );

                            }

                            elementpos++;

                        }
                    );
                }

            }
            else {

                jQuery( target ).append( response ).find( ".spb_init_callback" ).each(
                    function( index ) {
                        var fn = window[jQuery( this ).attr( "value" )];
                        if ( typeof fn === 'function' ) {
                            fn( jQuery( this ).closest( '.spb_content_element' ).removeClass( 'empty_column' ) );
                        }
                    }
                );
            }

            jQuery.swift_page_builder.isMainContainerEmpty();
            ////

            jQuery( ".spb_sortable" ).removeClass( "spb_row_1" );
            jQuery( ".spb_sortable" ).removeClass( "spb_row_2" );
            jQuery( ".spb_sortable" ).removeClass( "spb_row_3" );
            jQuery( ".spb_sortable" ).removeClass( "spb_row_4" );
            jQuery( ".spb_sortable" ).removeClass( "spb_row_5" );
            jQuery( ".spb_sortable" ).removeClass( "spb_row_6" );
            jQuery( ".spb_sortable" ).removeClass( "spb_row_7" );
            jQuery( ".spb_sortable" ).removeClass( "spb_row_8" );
            jQuery( ".spb_sortable" ).removeClass( "spb_row_9" );
            jQuery( ".spb_sortable" ).removeClass( "spb_row_10" );
            jQuery( ".spb_sortable" ).removeClass( "row_top_1" );
            jQuery( ".spb_sortable" ).removeClass( "row_top_2" );
            jQuery( ".spb_sortable" ).removeClass( "row_top_3" );
            jQuery( ".spb_sortable" ).removeClass( "row_top_4" );
            jQuery( ".spb_sortable" ).removeClass( "row_top_5" );

            //initTabs();
            //if (action == 'initDroppable') { initDroppable(); }
            initDroppable();
            save_spb_html();
            spb_elements_hide_controls( true );


        }
    );

} // end getElementMarkup()


/* Set action for column size and delete buttons
 ---------------------------------------------------------- */
function columnControls() {
    jQuery( document ).on(
        'click', '.column_delete', function( e ) {
            e.preventDefault();
            var answer = confirm( "If you'd like to delete this block, press OK. If you want to return, press Cancel." );
            if ( answer ) {
                $parent = jQuery( this ).closest( ".spb_sortable" );

                if ( $parent.parents( '.spb_gmaps' ).length > 0 ) {
                    jQuery( this ).closest( ".spb_sortable" ).parent().remove();
                }
                jQuery( this ).closest( ".spb_sortable" ).remove();
                $parent.addClass( 'empty_column' );
                save_spb_html();
            }
        }
    );
    jQuery( document ).on(
        'click', '.column_clone', function( e ) {
            e.preventDefault();
            var closest_el = jQuery( this ).closest( ".spb_sortable" ),
                cloned = closest_el.clone();
            cloned.find( '.spb_element_wrapper' ).removeClass( 'over_element_wrapper' );
            cloned.insertAfter( closest_el ).hide().fadeIn();

            if ( cloned.hasClass( 'spb_tabs' ) ) {

                cloned.find( '.ui-tabs-nav span' ).each(
                    function( index ) {
                        updateTabTitleIds( jQuery( this ).text() );
                    }
                );
            }

            cloned.find( '.controls_right , .column_size_wrapper' ).hide();

            //Fire INIT callback if it is defined
            cloned.find( '.spb_initialized' ).removeClass( 'spb_initialized' );
            cloned.find( ".spb_init_callback" ).each(
                function( index ) {
                    var fn = window[jQuery( this ).attr( "value" )];
                    if ( typeof fn === 'function' ) {
                        fn( cloned );
                    }
                }
            );

            save_spb_html();
            initDroppable();
        }
    );

    jQuery( ".spb_sortable .spb_sortable .column_popup" ).live(
        "click", function( e ) {
            e.preventDefault();
            var answer = confirm( "Press OK to pop (move) section to the top level, Cancel to leave" );
            if ( answer ) {
                jQuery( this ).closest( ".spb_sortable" ).appendTo( '.spb_main_sortable' );//insertBefore('.spb_main_sortable div.spb_clear:last');
                initDroppable();
                save_spb_html();
            }
        }
    );

    jQuery( ".column_edit, .column_edit_trigger" ).live(
        "click", function( e ) {
            e.preventDefault();
            //jQuery('body,html').animate({ scrollTop: 0});
            var element = jQuery( this ).closest( '.spb_sortable' );
            showEditForm( element );

        }
    );


    jQuery( ".column_increase" ).live(
        "click", function( e ) {
            e.preventDefault();
            var column = jQuery( this ).closest( ".spb_sortable" ),
                sizes = getColumnSize( column );
            if ( sizes[1] ) {
                column.removeClass( sizes[0] ).addClass( sizes[1] );
                /* get updated column size */
                sizes = getColumnSize( column );
                jQuery( column ).find( ".column_size:first" ).html( sizes[3] );
                save_spb_html();

            }
        }
    );

    jQuery( ".column_decrease" ).live(
        "click", function( e ) {
            e.preventDefault();
            var column = jQuery( this ).closest( ".spb_sortable" ),
                sizes = getColumnSize( column );

            if ( sizes[2] ) {
                column.removeClass( sizes[0] ).addClass( sizes[2] );


                /* get updated column size */
                sizes = getColumnSize( column );
                jQuery( column ).find( ".column_size:first" ).html( sizes[3] );
                save_spb_html();
            }
        }
    );
} // end columnControls()


//Function to avoid that the same spb_element is processed more than once
function removeClassProcessedElements() {

    jQuery( ".spb_sortable" ).removeClass( "spb_element_processed" );


}


/* Show widget small form(used for tabs, accordion, tour)
 ---------------------------------------------------------- */

function showEditSmallForm( element ) {

    var tab_name = '', element_name = '', icon = '', spb_modal_html = '';

    //Just for precaution to avoid duplicated elements
    if ( !jQuery( 'body' ).hasClass( 'edited-form-element' ) ) {

        element.parent().addClass( 'edited-form-element' );

        //if it's a Tab Element
        if ( element.parent().parent().hasClass( 'ui-tabs-nav' ) ) {
            tab_name = element.parent().find( 'span' ).text();
            element_name = 'Tabs';
            if ( element.parent().attr( 'data-title-icon' ) ) {
                icon = element.parent().attr( 'data-title-icon' );
            }
        } else {
            tab_name = element.parent().find( '.title-text' ).text();
            element_name = 'Accordion';
            if ( element.parent().attr( 'data-title-icon' ) ) {
                icon = element.parent().attr( 'data-title-icon' );
            }
        }

        if ( jQuery( 'body' ).find( 'edit-small-modal' ).length <= 0 ) {
            //jQuery( 'body' ).css( 'overflow', 'hidden' );
            jQuery( '#spb_edit_form' ).html( '<div class="spb-loading-message">' + jQuery( '#spb_loading' ).val() + '</div>' ).show().css( {"padding-top": 60} );

            var data = {
                action: 'spb_show_small_edit_form',
                element_name: element_name,
                tab_name: tab_name,
                icon: icon
            };

            jQuery.post(
                ajaxurl, data, function( response ) {
                    jQuery( '.spb-modal-tabs' ).html( response );
                    jQuery( '.spb-modal-tabs' ).show();
                    jQuery( '#spb_edit_form' ).html( '' );
                }
            );

        }
    }

    //jQuery( 'body' ).css( 'overflow', 'hidden' );

    return false;
}

function updateTabTitleIds( title ) {

	var id_title = title.replace(/[^A-Za-z0-9\-_]/g, '');

    if ( jQuery( '.ui-tabs-nav span:contains("' + title + '")' ).length > 1 ) {

        jQuery( '.ui-tabs-nav span:contains("' + title + '")' ).each(
            function( index ) {
                if ( index == 0 ) {

                    new_tab_id = jQuery.trim( id_title );
                }
                else {
                    new_tab_id = jQuery.trim( id_title ) + '-' + index;
                }

                jQuery( this ).parent().parent().attr( 'id', new_tab_id );

            }
        );

    } else {
        jQuery( '.ui-tabs-nav span:contains("' + title + '")' ).parent().parent().attr( 'id', id_title );

    }
}

function updateAccordionTitleIds( title ) {

	var id_title = title.toLowerCase().replace(/[^A-Za-z0-9\-_]/g, '-');

    if ( jQuery( '.ui-accordion-header .title-text:contains("' + title + '")' ).length > 1 ) {

        jQuery( '.ui-accordion-header .title-text:contains("' + title + '")' ).each(
            function( index ) {
                if ( index == 0 ) {

                    new_tab_id = jQuery.trim( id_title );
                }
                else {
                    new_tab_id = jQuery.trim( id_title ) + '-' + index;
                }

                jQuery( this ).parent().attr( 'accordion_id', new_tab_id );

            }
        );

    } else {
        jQuery( '.ui-accordion-header .title-text:contains("' + title + '")' ).parent().attr( 'accordion_id', id_title );

    }
}

function saveSmallFormEditing() {

    element = jQuery( '.edited-form-element' );
    tab_title = jQuery( '.small_form_title' ).val();

    if ( element.parent().hasClass( 'ui-tabs-nav' ) ) {
        element.find( 'span' ).text( tab_title );

    } else {
        element.find( '.title-text' ).text( tab_title );
    }

    element.attr( 'data-title-icon', jQuery( '.small_form_icon' ).val() );

    if( element.hasClass('ui-accordion-header') ){
		new_tab_id = updateAccordionTitleIds( tab_title );
	}else{
		new_tab_id = updateTabTitleIds( tab_title );
	}

    element.removeClass( 'edited-form-element' );
    jQuery( '.spb-modal-tabs' ).html( '' );
    jQuery( '.spb-modal-tabs' ).hide();
    jQuery( '#spb_edit_form' ).hide();
    jQuery( 'body' ).css( 'overflow', '' );


    save_spb_html();

    return false;

}

/* Show widget edit form
 ---------------------------------------------------------- */
var current_scroll_pos = 0;
function showEditForm( element ) {
    //current_scroll_pos = jQuery('body, html').scrollTop();
    var element_shortcode = generateShortcodesFromHtml( element, true ),
        element_type = element.attr( "data-element_type" );

    //jQuery( 'body' ).css( 'overflow', 'hidden' );
    jQuery( '#spb_edit_form' ).html( '<div class="spb-loading-message">' + jQuery( '#spb_loading' ).val() + '</div>' ).show().css( {"padding-top": 60} );
    //jQuery( "#publish" ).hide(); // hide main publish button
    //jQuery('.spb_main_sortable, #spb-elements, .spb_switch-to-builder').hide();

    var data = {
        action: 'spb_show_edit_form',
        element: element_type,
        shortcode: element_shortcode

    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(
        ajaxurl, data, function( response ) {
            jQuery( '#spb_edit_form' ).html( response ).css( {"padding-top": 0} );
            jQuery.swift_page_builder.initializeFormEditing( element );
			check_form_dependency_fields();
        }
    );
}


function saveFormEditing( element ) {
    jQuery( "#publish" ).show(); // show main publish button
    jQuery( '.spb_main_sortable, #spb-elements, .spb_switch-to-builder' ).show();
    removeClassProcessedElements();

    var isMapPin = element.hasClass( "spb_map_pin" ) ? true : false;

	if ( element.hasClass('spb_section') ) {
		element.find('.page-name-holder').empty();
	}

    //save data
    jQuery( "#spb_edit_form .spb_param_value" ).each(
        function( index ) {
            var element_to_update = jQuery( this ).attr( "name" ),
                new_value = '';

            // Textfield - input
            if ( jQuery( this ).hasClass( "textfield" ) ) {
                new_value = jQuery( this ).val();
            }
            // Color - input
            else if ( jQuery( this ).hasClass( "colorpicker" ) ) {
                new_value = jQuery( this ).val();
            }
            // Slider - input
            else if ( jQuery( this ).hasClass( "uislider" ) ) {
                new_value = jQuery( this ).val();
            }
            else if ( jQuery( this ).hasClass( "icon-picker" ) ) {
                new_value = jQuery( this ).val();
            }
            else if ( jQuery( this ).hasClass( "buttonset" ) ) {
                new_value = jQuery( this ).parent().find(':radio:checked').data('id');
            }
            // Dropdown - select
            else if ( jQuery( this ).hasClass( "dropdown" ) || jQuery( this ).hasClass( "dropdown-id" ) ) {
                new_value = jQuery( this ).val(); // get selected element

                if ( jQuery( this ).hasClass( 'responsive_vis' ) || jQuery( this ).hasClass( 'row_responsive_vis' ) || jQuery( this ).hasClass( 'col_responsive_vis' ) ) {
                    var responsive_vis_icons = element.find( '.spb_element_wrapper' ).find( '.responsive-vis-indicator > .icons' );

                    if ( new_value === "hidden-lg_hidden-md" ) {
                        responsive_vis_icons.html( '<i class="fa-tablet"></i><i class="fa-mobile"></i>' );
                    } else if ( new_value === "hidden-sm" ) {
                        responsive_vis_icons.html( '<i class="fa-desktop"></i><i class="fa-mobile"></i>' );
                    } else if ( new_value === "hidden-lg_hidden-md_hidden-sm" ) {
                        responsive_vis_icons.html( '<i class="fa-mobile"></i>' );
                    } else if ( new_value === "hidden-xs_hidden-sm" ) {
                        responsive_vis_icons.html( '<i class="fa-desktop"></i>' );
                    } else if ( new_value === "hidden-xs" ) {
                        responsive_vis_icons.html( '<i class="fa-desktop"></i><i class="fa-tablet"></i>' );
                    } else {
	                     responsive_vis_icons.html( 'All' );
                    }

                }

                var all_classes_ar = new Array(),
                    all_classes = '';
                jQuery( this ).find( 'option' ).each(
                    function() {
                        var val = jQuery( this ).attr( 'value' );
                        all_classes_ar.push( val ); //populate all posible dropdown values
                    }
                );

                all_classes = all_classes_ar.join( " " ); // convert array to string

                //element.removeClass(all_classes).addClass(new_value); // remove all possible class names and add only selected one
                element.find( '.spb_element_wrapper' ).removeClass( all_classes ).addClass( new_value ); // remove all possible class names and add only selected one
            }
            else if ( jQuery( this ).hasClass( "select-multiple" ) ) {

                var selected = jQuery( this ).val();

                if ( selected ) {
                    all_selected = selected.join( "," ); // convert array to string
                    new_value = all_selected; // get selected element
                }
                //element.removeClass(all_classes).addClass(new_value); // remove all possible class names and add only selected one
                //element.find('.wpb_element_wrapper').removeClass(all_classes).addClass(new_value); // remove all possible class names and add only selected one
            }
			else if ( jQuery( this ).hasClass( "select-multiple-id" ) ) {

			    var selected = jQuery( this ).val();

			    if ( selected ) {
			        all_selected = selected.join( "," ); // convert array to string
			        new_value = all_selected; // get selected element
			    }
			    //element.removeClass(all_classes).addClass(new_value); // remove all possible class names and add only selected one
			    //element.find('.wpb_element_wrapper').removeClass(all_classes).addClass(new_value); // remove all possible class names and add only selected one
			}
            // WYSIWYG field
            else if ( jQuery( this ).hasClass( "textarea_html" ) ) {
                new_value = getTinyMceHtml( jQuery( this ) );
                //Hide Multi Layer Parallax Image if added Parallax Text
                if ( new_value != '' && jQuery( this ).hasClass( "content" ) && jQuery( this ).closest( '.spb_edit_wrap' ).find( '.layer_image' ).length > 0 ) {
                    element.find( '.column_edit_trigger' ).addClass( 'hide-layer-image' );
                    element.find( '.attachment-medium' ).addClass( 'hide-layer-img' );
                }
                if ( new_value == '' && jQuery( this ).hasClass( "content" ) && jQuery( this ).closest( '.spb_edit_wrap' ).find( '.layer_image' ).length > 0 ) {
                    element.find( '.column_edit_trigger' ).removeClass( 'hide-layer-image' );
                    element.find( '.attachment-medium' ).removeClass( 'hide-layer-img' );

                }

            }
            // Check boxes
            else if ( jQuery( this ).hasClass( "spb-checkboxes" ) ) {
                var posstypes_arr = new Array();
                jQuery( this ).closest( '.edit_form_line' ).find( 'input' ).each(
                    function( index ) {
                        var self = jQuery( this );
                        element_to_update = self.attr( "name" );
                        if ( self.is( ':checked' ) ) {
                            posstypes_arr.push( self.attr( "id" ) );
                        }
                    }
                );
                if ( posstypes_arr.length > 0 ) {
                    new_value = posstypes_arr.join( ',' );
                }
            }
            // Exploded textarea
            else if ( jQuery( this ).hasClass( "exploded_textarea" ) ) {
                new_value = jQuery( this ).val().replace( /\n/g, "," );
            }
            // Regular textarea
            else if ( jQuery( this ).hasClass( "textarea" ) ) {
                new_value = jQuery( this ).val();
            }
            // Encoded textarea
            else if ( jQuery( this ).hasClass( "textarea_encoded" ) ) {
                new_value = base64_encode( rawurlencode( jQuery( this ).val() ) );
                element.find( '[name=' + element_to_update + '_code]' ).val(  new_value );
                new_value = jQuery( "<div/>" ).text( new_value ).html();
            }
            else if ( jQuery( this ).hasClass( "textarea_raw_html" ) ) {
                new_value = jQuery( this ).val();
                element.find( '[name=' + element_to_update + '_code]' ).val( base64_encode( rawurlencode( new_value ) ) );
                new_value = jQuery( "<div/>" ).text( new_value ).html();
            }
            // Attach images
            else if ( jQuery( this ).hasClass( "attach_images" ) ) {
                new_value = jQuery( this ).val();
            }
            else if ( jQuery( this ).hasClass( "attach_image" ) ) {
                new_value = jQuery( this ).val();
                /* KLUDGE: to change image */
                if ( jQuery( this ).hasClass( "layer_image" ) ) {
                    var $thumbnail = element.find( '[name=' + element_to_update + ']' ).next( '.attachment-medium' );
                } else {
                    var $thumbnail = element.find( '[name=' + element_to_update + ']' ).next( '.attachment-thumbnail' );
                }


                $thumbnail.attr( 'src', jQuery( this ).parent().find( 'li.added img' ).attr( 'src' ) );
                if ( new_value != '' ) {
                    $thumbnail.next().addClass( 'image-exists' );
                	$thumbnail.show();
				}else{
					$thumbnail.next().removeClass('image-exists');
					$thumbnail.hide();
				}

            }

            element_to_update = element_to_update.replace( 'spb_tinymce_', '' );
			if ( element.find( '.' + element_to_update ).is( 'div, h1,h2,h3,h4,h5,h6, span, i, b, strong, button' ) ) {

				//element.find('.'+element_to_update).html(new_value);
				element.find( '[name=' + element_to_update + ']' ).html( new_value );
			} else {
				//element.find('.'+element_to_update).val(new_value);
				element.find( '[name=' + element_to_update + ']' ).val( new_value );
			}
        }
    );

    // Map Asset Functions
    if ( isMapPin ) {
        var address = element.find( '[name=address]' ).html(),
            pintitle = element.find( '[name=pin_title]' ).html(),
            pinLatitude = element.find( '[name=pin_latitude]' ),
            pinLongitude = element.find( '[name=pin_longitude]' );

        // Set the lat & long
        if ( address !== "" ) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode(
                {'address': address}, function( results, status ) {
                    pinLatitude.val( results[0].geometry.location.lat() );
                    pinLongitude.val( results[0].geometry.location.lng() );
                }
            );
        } else {
            element.find( '[name=address]' ).html( jQuery( "[name=address]" ).attr( 'data-previous-text' ) );
        }

        // Set the pin title
        if ( !pintitle || pintitle === "" ) {
            pintitle = address;
            pintitle = pintitle.length > 15 ? pintitle.substring( 0, 12 ) + '...' : pintitle;
        }
        jQuery( '#' + jQuery( element ).parent().attr( "aria-labelledby" ) ).find( 'span' ).html( pintitle );
    }

    // Get callback function name
    var cb = element.children( ".spb_save_callback" );
    //
    if ( cb.length == 1 ) {
        var fn = window[cb.attr( "value" )];
        if ( typeof fn === 'function' ) {
            var tmp_output = fn( element );
        }
    }

    save_spb_html();
    jQuery( '#spb_edit_form' ).html( '' ).hide();
    jQuery( 'body' ).css( 'overflow', '' );
    //jQuery('body, html').scrollTop(current_scroll_pos);
}

function getTinyMceHtml( obj ) {

    var mce_id = obj.attr( 'id' ),
        html_back;

    // Switch back to visual editor
    window.switchEditors.go( mce_id, 'tmce' );

    try {
        html_back = tinyMCE.get( mce_id ).getContent();
        if ( tinyMCE.majorVersion >= 4 ) {
            tinyMCE.execCommand( "mceRemoveEditor", true, mce_id );
        } else {
            tinyMCE.execCommand( "mceRemoveControl", true, mce_id );
        }
    }
    catch ( err ) {
        html_back = switchEditors.wpautop( obj.val() );
    }

    return html_back;
}

function initTinyMce( element ) {
    var qt, textfield_id = element.attr( "id" ),
        form_line = element.closest( '.edit_form_line' ),
        content_holder = form_line.find( '.spb-textarea.textarea_html' );
    content = content_holder.val();

    window.tinyMCEPreInit.mceInit[textfield_id] = _.extend(
        {}, tinyMCEPreInit.mceInit['content'], {
            resize: 'vertical',
            height: 200
        }
    );

    if ( _.isUndefined( tinyMCEPreInit.qtInit[textfield_id] ) ) {
        window.tinyMCEPreInit.qtInit[textfield_id] = _.extend(
            {}, tinyMCEPreInit.qtInit['replycontent'], {
                id: textfield_id
            }
        );
    }

    element.val( content_holder.val() );
    qt = quicktags( window.tinyMCEPreInit.qtInit[textfield_id] );
    QTags._buttonsInit();
    window.switchEditors.go( textfield_id, 'tmce' );

    if ( tinymce.majorVersion >= "4" ) {
        tinymce.execCommand( 'mceAddEditor', true, textfield_id );
    }
}

function isTinyMceActive() {
    var rich = (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden();
    return rich;
}

/* This function helps when you need to determine current
 column size.

 Returns Array("current size", "larger size", "smaller size", "size string");
 ---------------------------------------------------------- */
function getColumnSize( column ) {
    if ( column.hasClass( "span12" ) ) //full-width
        return new Array( "span12", "span12", "span9", "1/1" );

    else if ( column.hasClass( "span9" ) ) //three-fourth
        return new Array( "span9", "span12", "span8", "3/4" );

    else if ( column.hasClass( "span8" ) ) //two-third
        return new Array( "span8", "span9", "span6", "2/3" );

    else if ( column.hasClass( "span6" ) ) //one-half
        return new Array( "span6", "span8", "span4", "1/2" );

    else if ( column.hasClass( "span4" ) ) // one-third
        return new Array( "span4", "span6", "span3", "1/3" );

    else if ( column.hasClass( "span3" ) ) // one-fourth
        return new Array( "span3", "span4", "span2", "1/4" );
    else if ( column.hasClass( "span2" ) ) // one-fourth
        return new Array( "span2", "span3", "span2", "1/6" );
    else
        return false;
} // end getColumnSize()

function getAltColumnSize( column ) {
    if ( column.hasClass( "span12" ) ) //full-width
        return new Array( "span12", "span12", "span9", "1/1" );

    else if ( column.hasClass( "span9" ) ) //three-fourth
        return new Array( "span9", "span12", "span6", "3/4" );

    else if ( column.hasClass( "span6" ) ) //one-half
        return new Array( "span6", "span9", "span3", "1/2" );

    else if ( column.hasClass( "span3" ) ) // one-fourth
        return new Array( "span3", "span6", "span2", "1/4" );
    else if ( column.hasClass( "span2" ) ) // one-fourth
        return new Array( "span2", "span3", "span2", "1/6" );
    else
        return false;
} // end getAltColumnSize()

/* This functions goes throw the dom tree and automatically
 adds 'last' class name to the columns elements.
 ---------------------------------------------------------- */
function addLastClass( dom_tree ) {
    return jQuery.swift_page_builder.addLastClass( dom_tree );
    //jQuery(dom_tree).children(".column:first").addClass("first");
    //jQuery(dom_tree).children(".column:last").addClass("last");
} // endjQuery.swift_page_builder.addLastClass()

/* This functions copies html code into custom field and
 then on page reload/refresh it is used to build the
 initial layout.
 ---------------------------------------------------------- */
function save_spb_html() {

    jQuery.swift_page_builder.addLastClass( jQuery( ".spb_main_sortable" ) );

    var shortcodes = generateShortcodesFromHtml( jQuery( ".spb_main_sortable" ) );
    removeClassProcessedElements();

    if ( isTinyMceActive() != true ) {
        jQuery( '#content' ).val( shortcodes );
    } else {
        //tinyMCE.activeEditor.setContent(shortcodes, {format : 'html'});
        //		if (tinyMCE.get('excerpt')) {
        //		tinyMCE.get('excerpt').setContent(shortcodes);
        //		}
        if ( tinyMCE.get( 'content' ) ) {
            tinyMCE.get( 'content' ).setContent( shortcodes );
        }
    }

    jQuery.swift_page_builder.isMainContainerEmpty();
}

function clear_page_builder_content() {

    var answer = confirm( "This will clear the contents of the page, are you sure?" );
    if ( answer ) {
        if ( isTinyMceActive() != true ) {
            jQuery( '#content' ).val( '' );
        } else {
            tinyMCE.activeEditor.setContent( '' );
        }


        jQuery( '#spb_content' ).find( ".spb_sortable" ).remove();
        jQuery( '#spb_content' ).find( ".new_sortable_element" ).remove();
        jQuery( '#spb_content' ).find( ".newtop_sortable_element" ).remove();
        save_spb_html();


    }
}

/* Generates shortcode values
 ---------------------------------------------------------- */
var current_top_level = null;
function generateShortcodesFromHtml( dom_tree, single_element ) {
    var output = '';
    if ( single_element ) {
        // this is used to generate shortcode for a single content element
        selector_to_go_through = jQuery( dom_tree );
    } else {
        selector_to_go_through = jQuery( dom_tree ).children( ".spb_sortable" );
    }

    selector_to_go_through.each(
        function( index ) {
            //jQuery(dom_tree.selector+" > .spb_sortable").each(function(index) {
            var element = jQuery( this ),
                current_top_level = element,
                sc_base = element.find( '.spb_sc_base' ).val(),
                column_el_width = getColumnSize( element ),
                params = '',
                sc_ending = ']';
            //New Validation to avoid duplicated text
            if ( !element.hasClass( "spb_element_processed" ) ) {


                if ( element.parent().hasClass( 'spb_column_container' ) ) {
                    element.addClass( "spb_element_processed" );
                }

                element.children( '.spb_element_wrapper' ).children( '.spb_param_value' ).each(
                    function( index ) {
                        var param_name = jQuery( this ).attr( "name" ),
                            new_value = '';
                        if ( jQuery( this ).hasClass( "textfield" ) ) {
                            if ( jQuery( this ).is( 'div, h1,h2,h3,h4,h5,h6, span, i, b, strong' ) ) {
                                new_value = jQuery( this ).html();
                            } else if ( jQuery( this ).is( 'button' ) ) {
                                new_value = jQuery( this ).text();
                            } else {
                                new_value = jQuery( this ).val();
                            }
                        }
                        else if ( jQuery( this ).hasClass( "colorpicker" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "uislider" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "buttonset" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "icon-picker" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "dropdown" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "dropdown-id" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "select-multiple" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "select-multiple-id" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "textarea_encoded" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "textarea_raw_html" ) && element.children( '.spb_sortable' ).length == 0 ) {
                            content_value = jQuery( this ).next( '.' + param_name + '_code' ).val();
                            sc_ending = ']' + content_value + '[/' + sc_base + ']';
                        }
                        else if ( jQuery( this ).hasClass( "textarea_html" ) && element.children( '.spb_sortable' ).length == 0 ) {
                            content_value = jQuery( this ).html();
                            sc_ending = ']' + content_value + '[/' + sc_base + ']';
                        }
                        else if ( jQuery( this ).hasClass( "posttypes" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "exploded_textarea" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "textarea" ) ) {
                            if ( jQuery( this ).is( 'div, h1,h2,h3,h4,h5,h6, span, i, b, strong' ) ) {
                                new_value = jQuery( this ).html();
                            } else {
                                new_value = jQuery( this ).val();
                            }
                        }
                        else if ( jQuery( this ).hasClass( "attach_images" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "attach_image" ) ) {
                            new_value = jQuery( this ).val();
                        }
                        else if ( jQuery( this ).hasClass( "widgetised_sidebars" ) ) {
                            new_value = jQuery( this ).val();
                        }

                        new_value = jQuery.trim( new_value );
                        if ( new_value != '' ) {
                            params += ' ' + param_name + '="' + new_value + '"';
                        }
                    }
                );


                params += ' width="' + column_el_width[3] + '"'

                if ( element.hasClass( "spb_first" ) || element.hasClass( "spb_last" ) ) {
                    var spb_first = (element.hasClass( "spb_first" )) ? 'first' : '';
                    var spb_last = (element.hasClass( "spb_last" )) ? 'last' : '';
                    var pos_space = (element.hasClass( "spb_last" ) && element.hasClass( "spb_first" )) ? ' ' : '';
                    params += ' el_position="' + spb_first + pos_space + spb_last + '"';
                }

                // Get callback function name
                var cb = element.children( ".spb_shortcode_callback" );
                //
                if ( cb.length == 1 ) {
                    var fn = window[cb.attr( "value" )];
                    if ( typeof fn === 'function' ) {
                        var tmp_output = fn( element );
                    }
                }


                output += '[' + sc_base + params + sc_ending + ' ';

                //deeper
                //if ( element.children('.spb_element_wrapper').children('.spb_column_container').children('.spb_sortable').length > 0 ) {
                if ( element.children( '.spb_element_wrapper' ).find( '.spb_column_container' ).length > 0 ) {
                    //output += generateShortcodesFromHtml(element.children('.spb_element_wrapper').children('.spb_column_container'));

                    // Get callback function name
                    var cb = element.children( ".spb_shortcode_callback" ),
                        inner_element_count = 0;
                    //
                    element.children( '.spb_element_wrapper' ).find( '.spb_column_container' ).each(
                        function( index ) {

                            var sc = generateShortcodesFromHtml( jQuery( this ) );
                            //Fire SHORTCODE GENERATION callback if it is defined
                            if ( cb.length == 1 && !jQuery( this ).hasClass( 'map_pin_wrapper' ) ) {
                                var fn = window[cb.attr( "value" )];
                                if ( typeof fn === 'function' ) {
                                    var tmp_output = fn( current_top_level, inner_element_count );
                                }
                                sc = " " + tmp_output.replace( "%inner_shortcodes", sc ) + " ";

                                //sc = " " + tmp_output.replace("%inner_shortcodes", sc);
                                inner_element_count++;
                            }

                             if ( sc.trim() == '[spb_accordion_tab title=""]  [/spb_accordion_tab]'
							     || sc.trim() == '[spb_accordion_tab title="" icon=""]  [/spb_accordion_tab]'
							     || sc.trim() == '[spb_accordion_tab title=""  accordion_id="" icon=""]  [/spb_accordion_tab]' ){
                                sc = "";
                            }


                            output += sc;
                        }
                    );

                    output += '[/' + sc_base + '] ';
                }
                jQuery( '.spb_column_container' ).removeClass( 'converted' );
            }
        }
    );

    return output;
} // end generateShortcodesFromHtml()

/* This function adds a class name to the div#drag_placeholder,
 and this helps us to give a style to the draging placeholder
 ---------------------------------------------------------- */
function renderCorrectPlaceholder( event, ui ) {
    jQuery( "#drag_placeholder" ).addClass( "column_placeholder" ).html( "Drag and drop me into the editor" );
}


/* Custom Callbacks
 ---------------------------------------------------------- */


/* Tabs Callbacks
 ---------------------------------------------------------- */
function spbTabsInitCallBack( element ) {
    element.find( '.spb_tabs_holder' ).not( '.spb_initialized' ).each(
        function( index ) {
            jQuery( this ).addClass( 'spb_initialized' );
            //var tab_counter = 4;
            //
            var $tabs,
                add_btn = jQuery( this ).closest( '.spb_element_wrapper' ).find( '> .tab_controls .add_tab' );
            //
            $tabs = jQuery( this ).tabs(
                {
                    panelTemplate: '<div class="row-fluid spb_column_container empty_column spb_sortable_container not-column-inherit">' + jQuery( '#container-helper-block' ).html() + '</div>',
                    add: function( event, ui ) {
                        var tabs_count = jQuery( this ).tabs( "length" ) - 1;
                        jQuery( this ).tabs( "select", tabs_count );
                        //
                        save_spb_html();
                    }
                }
            );

            var sort_axis = ( jQuery( this ).closest( '.spb_sortable' ).hasClass( 'spb_tour' )) ? 'y' : 'x';
            $tabs.find( ".ui-tabs-nav" ).sortable(
                {
                    axis: sort_axis,
                    stop: function( event, ui ) {
                        $tabs.find( 'ul li' ).each(
                            function( index ) {
                                var href = jQuery( this ).find( 'a' ).attr( 'href' ).replace( "#", "" );
                                $tabs.find( 'div.spb_column_container#' + href ).appendTo( $tabs );
                            }
                        );
                        //
                        save_spb_html();
                    }
                }
            );
            //

            add_btn.click(
                function( e ) {
                    e.preventDefault();
                    var tab_title = ( jQuery( this ).closest( '.spb_sortable' ).hasClass( 'spb_tour' )) ? 'Slide' : 'Tab',
                        tabs_count = jQuery( this ).parent().parent().find( '.ui-tabs-nav li' ).length + 1,
                        tabs_asset = jQuery( this ).parent().parent().find( '.spb_tabs_holder' ),
                        tabs_nav = tabs_asset.find( '.ui-tabs-nav' );

                    if ( jQuery( this ).closest( '.spb_sortable' ).hasClass( 'spb_gmaps' ) ) {
                        var tab_title = 'Pin';
                        tabs_count = jQuery( this ).parent().parent().find( '.spb_map_pin' ).length + 1;

                    }

                    if ( jQuery( this ).closest( '.spb_sortable' ).hasClass( 'spb_multilayer_parallax' ) ) {
                        var tab_title = 'Layer';
                        tabs_count = jQuery( this ).parent().parent().find( '.spb_multilayer_parallax_layer' ).length + 1;

                    }


                    if ( jQuery( this ).closest( '.spb_sortable' ).hasClass( 'spb_tour' ) ) {
                        tabs_nav.append( '<li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tab-' + tabs_count + '" aria-labelledby="ui-id-' + tabs_count + '" aria-selected="false" style="top: 0px;"><a href="#tab-' + tabs_count + '" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-' + tabs_count + '"><span>' + tab_title + ' ' + tabs_count + '</span></a><a class="delete_tab"></a><a class="edit_tab"></a></li>' );

                        tabs_asset.append( '<div id="tab-' + tabs_count + '" class="row-fluid spb_column_container spb_sortable_container not-column-inherit ui-sortable ui-droppable ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-' + tabs_count + '" role="tabpanel" aria-expanded="true" aria-hidden="false"><div data-element_type="spb_text_block" class="spb_text_block spb_content_element spb_sortable span12 spb_first spb_last ui-sortable-helper"><input type="hidden" class="spb_sc_base" name="element_name-spb_text_block" value="spb_text_block"><div class="controls sidebar-name"> <div class="column_size_wrapper"> <a class="column_decrease" href="#" title="Decrease width"></a> <span class="column_size">1/1</span> <a class="column_increase" href="#" title="Increase width"></a> </div><div class="controls_right"> <a class="column_popup" href="#" title="Pop up"></a> <a class="column_edit" href="#" title="Edit"></a> <a class="column_clone" href="#" title="Clone"></a> <a class="column_delete" href="#" title="Delete"></a></div></div><div class="spb_element_wrapper clearfix"><input type="hidden" class="spb_param_value title textfield " name="title" value=""><input type="hidden" class="spb_param_value icon textfield " name="icon" value=""><div class="spb_param_value holder content textarea_html " name="content"><p> This is a text block. Click the edit button to change this text. </p></div><input type="hidden" class="spb_param_value pb_margin_bottom dropdown " name="pb_margin_bottom" value="no"><input type="hidden" class="spb_param_value pb_border_bottom dropdown " name="pb_border_bottom" value="no"><input type="hidden" class="spb_param_value el_class textfield " name="el_class" value=""></div> <!-- end .spb_element_wrapper --></div> <!-- end #element-spb_text_block --></div>' );
                    }
                    else if ( jQuery( this ).closest( '.spb_sortable' ).hasClass( 'spb_gmaps' ) ) {
                        tabs_nav.append( '<li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tab-' + tabs_count + '" aria-labelledby="ui-id-' + tabs_count + '" aria-selected="false" style="top: 0px;"><a href="#tab-' + tabs_count + '" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-' + tabs_count + '"><span>' + tab_title + ' ' + tabs_count + '</span></a></li>' );
                        tabs_asset.append( '<div id="map-tab-' + tabs_count + '" class="row-fluid spb_column_container map_pin_wrapper spb_sortable_container not-column-inherit ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="map-ui-id-' + tabs_count + '" role="tabpanel" aria-expanded="true" aria-hidden="true"><div data-element_type="spb_map_pin" class="spb_map_pin spb_content_element spb_sortable span12"><input type="hidden" class="spb_sc_base" name="element_name-spb_map_pin" value="spb_map_pin"><div class="controls sidebar-name"> <div class="controls_right" style="display: block; opacity: 1;"> <a class="column_edit" href="#" title="Edit"></a> <a class="column_delete" href="#" title="Delete"></a></div></div><div class="spb_element_wrapper"><div class="spb_param_value holder textfield pin_title" name="pin_title"> New Pin</div><div class="spb_param_value holder address textfield " name="address">Click the edit button to change the map pin details.</div><input type="hidden" class="spb_param_value pin_latitude textfield " name="pin_latitude" value=""><input type="hidden" class="spb_param_value pin_longitude textfield " name="pin_longitude" value=""><input type="hidden" class="spb_param_value pin_image attach_image " name="pin_image" value=""><div class="spb_param_value content textarea_html hide-shortcode " name="content">This is a map pin. Click the edit button to change it.</div></div> <!-- end .spb_element_wrapper --></div> <!-- end #element-spb_map_pin --></div>' );
                    }
                    else if ( jQuery( this ).closest( '.spb_sortable' ).hasClass( 'spb_multilayer_parallax' ) ) {
                        tabs_nav.append( '<li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tab-' + tabs_count + '" aria-labelledby="ui-id-' + tabs_count + '" aria-selected="false" style="top: 0px;"><a href="#tab-' + tabs_count + '" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-' + tabs_count + '"><span>' + tab_title + ' ' + tabs_count + '</span></a></li>' );
                        tabs_asset.append( '<div id="layer-tab-' + tabs_count + '" class="row-fluid spb_column_container spb_sortable_container not-column-inherit ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="map-ui-id-' + tabs_count + '" role="tabpanel" aria-expanded="true" aria-hidden="true"><div data-element_type="spb_multilayer_parallax_layer" class="spb_multilayer_parallax_layer spb_content_element spb_sortable span12"><input type="hidden" class="spb_sc_base" name="element_name-spb_multilayer_parallax_layer" value="spb_multilayer_parallax_layer"><div class="controls sidebar-name"><div class="controls_right" style="display: block;"> <a class="column_edit" href="#" title="Edit"></a><a class="column_delete" href="#" title="Delete"></a></div></div><div class="spb_element_wrapper over_element_wrapper"><div class="spb_param_value holder layer_title textfield " name="layer_title">' + tab_title + ' ' + tabs_count + '</div><input type="hidden" class="spb_param_value layer_image attach_image " name="layer_image" value=""><img width="150" height="150" src="" class="attachment-medium" alt="" title=""><a href="#" class="column_edit_trigger"><i class="spb-icon-single-image"></i>No image yet! Click here to select it now.</a><input type="hidden" class="spb_param_value layer_type dropdown " name="layer_type" value=""><input type="hidden" class="spb_param_value layer_bg_pos dropdown " name="layer_bg_pos" value=""><input type="hidden" class="spb_param_value layer_depth dropdown " name="layer_depth" value=""><div class="spb_param_value content textarea_html " name="content"></div></div> <!-- end .spb_element_wrapper --></div> <!-- end #element-spb_multilayer_parallax_layer --></div>' );
                    } else {

                        tabs_nav.append( '<li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tab-' + tabs_count + '" aria-labelledby="ui-id-' + tabs_count + '" aria-selected="false" style="top: 0px;"><a href="#tab-' + tabs_count + '" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-' + tabs_count + '"><span>' + tab_title + ' ' + tabs_count + '</span></a><a class="edit_tab"></a><a class="delete_tab"></a></li>' );
                        tabs_asset.append( '<div id="tab-' + tabs_count + '" class="row-fluid spb_column_container spb_sortable_container not-column-inherit ui-tabs-panel ui-widget-content ui-corner-bottom ui-sortable ui-droppable" aria-labelledby="ui-id-' + tabs_count + '" role="tabpanel" aria-expanded="false" aria-hidden="true" style="display: none;"><div data-element_type="spb_text_block" class="spb_text_block spb_content_element spb_sortable span12 spb_first spb_last"><input type="hidden" class="spb_sc_base" name="element_name-spb_text_block" value="spb_text_block"><div class="controls sidebar-name"><div class="controls_right"> <a class="column_popup" href="#" title="Pop up"></a> <a class="column_edit" href="#" title="Edit"></a> <a class="column_clone" href="#" title="Clone"></a> <a class="column_delete" href="#" title="Delete"></a></div></div><div class="spb_element_wrapper clearfix"><input type="hidden" class="spb_param_value title textfield " name="title" value=""><input type="hidden" class="spb_param_value icon textfield " name="icon" value=""><div class="spb_param_value holder content textarea_html " name="content"><p> This is a text block. Click the edit button to change this text. </p></div><input type="hidden" class="spb_param_value pb_margin_bottom dropdown " name="pb_margin_bottom" value="no"><input type="hidden" class="spb_param_value pb_border_bottom dropdown " name="pb_border_bottom" value="no"><input type="hidden" class="spb_param_value el_class textfield " name="el_class" value=""></div> <!-- end .spb_element_wrapper --></div> <!-- end #element-spb_text_block --></div>' );

                    }

                    $tabs.tabs( 'refresh' );
                    //tab_counter++;

                    jQuery( document ).on(
                        'click', '.ui-tabs-nav .edit_tab', function() {

                            showEditSmallForm( jQuery( this ) );
                            return false;

                        }
                    );

                    jQuery( document ).on(
                        'click', '.ui-tabs-nav .delete_tab', function() {

                            var tab_name = jQuery( this ).parent().text(),
                                tab_pos = jQuery( this ).closest( 'li' ).index(),
                                alt_tab_pos = tab_pos + 1;

                            if ( tab_pos < 0 ) {
                                return false;
                            }

                            var answer = confirm( "If you'd like to delete the '" + tab_name + "' tab, press OK. If you want to return, press Cancel." );

                            if ( answer ) {
                                tab_id = $tabs.find( '.ui-tabs-nav li:eq(' + tab_pos + ')' ).attr( 'aria-controls' );
                                $tabs.find( '.ui-tabs-nav li:eq(' + tab_pos + ')' ).remove();
                                if ( $tabs.closest( '.spb_sortable' ).hasClass( 'spb_tour' ) ) {
                                    $tabs.find( '#tab-' + alt_tab_pos ).remove();
                                    $tabs.find( '#tab-slide-' + alt_tab_pos ).remove();
                                }
                                else {

                                    $tabs.find( '#' + tab_id ).remove();
                                    $tabs.find( '#tab-' + tab_id ).remove();
                                }
                                //
                                $tabs.tabs( 'refresh' );
                                save_spb_html();
                            }
                            return false;
                        }
                    );


                    initDroppable();
                    save_spb_html();
                }
            );


            function setTabButtons() {
                jQuery( '.ui-tabs-nav .edit_tab' ).click(
                    function() {

                        showEditSmallForm( jQuery( this ) );
                        return false;

                    }
                );

                jQuery( '.ui-tabs-nav .delete_tab' ).click(
                    function() {
                        var tab_name = jQuery( this ).parent().text(),
                            tab_pos = jQuery( this ).closest( 'li' ).index(),
                            alt_tab_pos = tab_pos + 1;

                        if ( tab_pos < 0 ) {
                            return false;
                        }

                        var answer = confirm( "If you'd like to delete the '" + tab_name + "' tab, press OK. If you want to return, press Cancel." );
                        if ( answer ) {
                            tab_id = $tabs.find( '.ui-tabs-nav li:eq(' + tab_pos + ')' ).attr( 'aria-controls' );
                            $tabs.find( '.ui-tabs-nav li:eq(' + tab_pos + ')' ).remove();
                            if ( $tabs.closest( '.spb_sortable' ).hasClass( 'spb_tour' ) ) {
                                $tabs.find( '#tab-' + alt_tab_pos ).remove();
                                $tabs.find( '#tab-slide-' + alt_tab_pos ).remove();
                            }
                            else {

                                $tabs.find( '#' + tab_id ).remove();
                                $tabs.find( '#tab-' + tab_id ).remove();
                            }
                            //
                            $tabs.tabs( 'refresh' );
                            save_spb_html();
                        }
                        return false;
                    }
                );
            }

            setTabButtons();

        }
    );

    initDroppable();
}


function spbTabsGenerateShortcodeCallBack( current_top_level, inner_element_count ) {
    var tab_title = current_top_level.find( ".ui-tabs-nav li:eq(" + inner_element_count + ") a" ).text();
    var tab_title_icon = '', tab_title_id = '';

    //Grab the icon value
    if ( current_top_level.find( ".ui-tabs-nav li:eq(" + inner_element_count + ")" ).attr( 'data-title-icon' ) ) {
        tab_title_icon = current_top_level.find( ".ui-tabs-nav li:eq(" + inner_element_count + ")" ).attr( 'data-title-icon' );
    }
    //Grab the id value
    if ( current_top_level.find( ".ui-tabs-nav li:eq(" + inner_element_count + ")" ).attr( 'id' ) ) {
        tab_title_id = current_top_level.find( ".ui-tabs-nav li:eq(" + inner_element_count + ")" ).attr( 'id' );
    }

    output = '[spb_tab title="' + tab_title + '" icon="' + tab_title_icon + '" id="' + tab_title_id + '"] %inner_shortcodes [/spb_tab]';
    if ( inner_element_count == null )
        output = '';
    return output;

}

/* Accordion Callback
 ---------------------------------------------------------- */
function spbAccordionInitCallBack( element ) {

    element.find( '.spb_accordion_holder' ).not( '.spb_initialized' ).each(
        function( index ) {
            jQuery( this ).addClass( 'spb_initialized' );
            //var tab_counter = 4;
            //
            var $tabs,
                add_btn = jQuery( this ).closest( '.spb_element_wrapper' ).find( '.add_tab' );
            //

            $tabs = jQuery( this ).accordion(
                {
                    header: "> div > h3",
                    autoHeight: true,
                    heightStyle: "content"
                }
            )
                .sortable(
                {
                    axis: "y",
                    handle: "h3",
                    stop: function( event, ui ) {
                        // IE doesn't register the blur when sorting
                        // so trigger focusout handlers to remove .ui-state-focus
                        ui.item.children( "h3" ).triggerHandler( "focusout" );
                        //
                        save_spb_html();
                    }
                }
            );

            setAccordionButtons();

            add_btn.click(
                function( e ) {
                    e.preventDefault();
                    var tab_title = 'Section',
                        section_template = '<div class="group"><h3><a class="title-text" href="#">Section</a><a class="delete_tab"></a><a class="edit_tab"></a></h3><div class="row-fluid spb_column_container spb_sortable_container not-column-inherit"></div></div>';
                    $tabs.append( section_template );
                    $tabs.accordion( "destroy" )
                        .accordion(
                        {
                            header: "> div > h3",
                            autoHeight: true,
                            heightStyle: "content"
                        }
                    )
                        .sortable(
                        {
                            axis: "y",
                            handle: "h3",
                            stop: function( event, ui ) {
                                // IE doesn't register the blur when sorting
                                // so trigger focusout handlers to remove .ui-state-focus
                                ui.item.children( "h3" ).triggerHandler( "focusout" );
                                //
                                save_spb_html();
                            }
                        }
                    );

                    //$tabs.tabs( "add", "#tabs-" + tabs_count, tab_title );
                    //tab_counter++;
                    //
                    //setAccordionButtons();
                    initDroppable();
                    save_spb_html();
                }
            );

            function setAccordionButtons() {
                jQuery( '.spb_accordion_holder .delete_tab' ).live(
                    'click', function( e ) {

                        e.preventDefault();

                        var tab_name = jQuery( this ).parent().text();

                        var answer = confirm( "If you'd like to delete the '" + tab_name + "' section, press OK. If you want to return, press Cancel." );
                        if ( answer ) {
                            jQuery( this ).parent().closest( '.group' ).remove();
                            //
                            save_spb_html();
                        }
                    }
                );

                jQuery( document ).on(
                    'click', '.spb_accordion_holder .edit_tab', function() {
                        showEditSmallForm( jQuery( this ) );
                        return false;
                    }
                );
            }
        }
    );
    initDroppable();
}

function spbAccordionGenerateShortcodeCallBack( current_top_level, inner_element_count ) {

    var tab_title_icon = '', accordion_title_id = '';
    var tab_title = current_top_level.find( ".group:eq(" + inner_element_count + ") > h3" ).text();

    if ( current_top_level.find( ".group:eq(" + inner_element_count + ") > h3" ).attr( 'data-title-icon' ) ) {
        tab_title_icon = current_top_level.find( ".group:eq(" + inner_element_count + ") > h3" ).attr( 'data-title-icon' );
    }

    //Grab the id value
    if (current_top_level.find( ".group:eq(" + inner_element_count + ") > h3" ).attr( 'accordion_id' ) ) {
        accordion_title_id =  current_top_level.find( ".group:eq(" + inner_element_count + ") > h3" ).attr( 'accordion_id' );
    }

    output = '[spb_accordion_tab title="' + tab_title + '" accordion_id="' + accordion_title_id + '" icon="' + tab_title_icon + '"] %inner_shortcodes [/spb_accordion_tab]';

    return output;
}

/* Message box Callbacks
 ---------------------------------------------------------- */
function spbMessageInitCallBack( element ) {
    var el = element.find( '.spb_param_value.color' );
    var class_to_set = el.val();
    el.closest( '.spb_element_wrapper' ).addClass( class_to_set );
}

/* Text Separator Callbacks
 ---------------------------------------------------------- */
function spbTextSeparatorInitCallBack( element ) {
    var el = element.find( '.spb_param_value.title_align' );
    var class_to_set = el.val();
    el.closest( '.spb_element_wrapper' ).addClass( class_to_set );
}

/* Button Callbacks
 ---------------------------------------------------------- */

//function spbButtonInitCallBack(element) {
//	var el_class = element.find('.spb_param_value.color').val() + ' ' + element.find('.spb_param_value.size').val() + ' ' + element.find('.spb_param_value.icon').val();
//	//
//	element.find('button.title').attr({ "class" : "spb_param_value title textfield btn " + el_class });
//
//	var icon = element.find('.spb_param_value.icon').val();
//	if ( icon != 'none' && element.find('button i.icon').length == 0  ) {
//		element.find('button.title').append(' <i class="icon"></i>');
//	}
//}
//
//function spbButtonSaveCallBack(element) {
//	var el_class = element.find('.spb_param_value.color').val() + ' ' + element.find('.spb_param_value.size').val() + ' ' + element.find('.spb_param_value.icon').val();
//	//
//	element.find('.spb_element_wrapper').removeClass(el_class);
//	element.find('button.title').attr({ "class" : "spb_param_value title textfield btn " + el_class });
//
//	var icon = element.find('.spb_param_value.icon').val();
//	if ( icon != 'none' && element.find('button i.icon').length == 0 ) {
//		element.find('button.title').append(' <i class="icon"></i>');
//	} else {
//		element.find('button.title i.icon').remove();
//	}
//}

/* Get URL Vars
 ---------------------------------------------------------- */
function getURLVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice( window.location.href.indexOf( '?' ) + 1 ).split( '&' );
    for ( var i = 0; i < hashes.length; i++ ) {
        hash = hashes[i].split( '=' );
        vars.push( hash[0] );
        vars[hash[0]] = hash[1];
    }
    return vars;
}

/* URL Encoding
 ---------------------------------------------------------- */
function rawurldecode( str ) {
    return decodeURIComponent( str + '' );
}
function rawurlencode( str ) {
    str = (str + '').toString();
    return encodeURIComponent( str ).replace( /!/g, '%21' ).replace( /'/g, '%27' ).replace(
        /\(/g, '%28'
    ).replace( /\)/g, '%29' ).replace( /\*/g, '%2A' );
}
function base64_decode( data ) {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, dec = "", tmp_arr = [];
    if ( !data ) {
        return data;
    }
    data += '';
    do {
        h1 = b64.indexOf( data.charAt( i++ ) );
        h2 = b64.indexOf( data.charAt( i++ ) );
        h3 = b64.indexOf( data.charAt( i++ ) );
        h4 = b64.indexOf( data.charAt( i++ ) );
        bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;
        o1 = bits >> 16 & 0xff;
        o2 = bits >> 8 & 0xff;
        o3 = bits & 0xff;
        if ( h3 == 64 ) {
            tmp_arr[ac++] = String.fromCharCode( o1 );
        } else if ( h4 == 64 ) {
            tmp_arr[ac++] = String.fromCharCode( o1, o2 );
        } else {
            tmp_arr[ac++] = String.fromCharCode( o1, o2, o3 );
        }
    } while ( i < data.length );
    dec = tmp_arr.join( '' );
    dec = this.utf8_decode( dec );
    return dec;
}
function base64_encode( data ) {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, enc = "", tmp_arr = [];
    if ( !data ) {
        return data;
    }
    data = this.utf8_encode( data + '' );
    do {
        o1 = data.charCodeAt( i++ );
        o2 = data.charCodeAt( i++ );
        o3 = data.charCodeAt( i++ );
        bits = o1 << 16 | o2 << 8 | o3;
        h1 = bits >> 18 & 0x3f;
        h2 = bits >> 12 & 0x3f;
        h3 = bits >> 6 & 0x3f;
        h4 = bits & 0x3f;
        tmp_arr[ac++] = b64.charAt( h1 ) + b64.charAt( h2 ) + b64.charAt( h3 ) + b64.charAt( h4 );
    } while ( i < data.length );
    enc = tmp_arr.join( '' );
    var r = data.length % 3;
    return (r ? enc.slice( 0, r - 3 ) : enc) + '==='.slice( r || 3 );
}
function utf8_decode( str_data ) {
    var tmp_arr = [], i = 0, ac = 0, c1 = 0, c2 = 0, c3 = 0;
    str_data += '';
    while ( i < str_data.length ) {
        c1 = str_data.charCodeAt( i );
        if ( c1 < 128 ) {
            tmp_arr[ac++] = String.fromCharCode( c1 );
            i++;
        } else if ( c1 > 191 && c1 < 224 ) {
            c2 = str_data.charCodeAt( i + 1 );
            tmp_arr[ac++] = String.fromCharCode( ((c1 & 31) << 6) | (c2 & 63) );
            i += 2;
        } else {
            c2 = str_data.charCodeAt( i + 1 );
            c3 = str_data.charCodeAt( i + 2 );
            tmp_arr[ac++] = String.fromCharCode( ((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63) );
            i += 3;
        }
    }
    return tmp_arr.join( '' );
}
function utf8_encode( argString ) {
    if ( argString === null || typeof argString === "undefined" ) {
        return "";
    }
    var string = (argString + '');
    var utftext = "", start, end, stringl = 0;
    start = end = 0;
    stringl = string.length;
    for ( var n = 0; n < stringl; n++ ) {
        var c1 = string.charCodeAt( n );
        var enc = null;
        if ( c1 < 128 ) {
            end++;
        } else if ( c1 > 127 && c1 < 2048 ) {
            enc = String.fromCharCode( (c1 >> 6) | 192 ) + String.fromCharCode( (c1 & 63) | 128 );
        } else {
            enc = String.fromCharCode( (c1 >> 12) | 224 ) + String.fromCharCode( ((c1 >> 6) & 63) | 128 ) + String.fromCharCode( (c1 & 63) | 128 );
        }
        if ( enc !== null ) {
            if ( end > start ) {
                utftext += string.slice( start, end );
            }
            utftext += enc;
            start = end = n + 1;
        }
    }
    if ( end > start ) {
        utftext += string.slice( start, stringl );
    }
    return utftext;
}
