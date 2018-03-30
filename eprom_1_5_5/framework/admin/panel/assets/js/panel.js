
/* When DOM is fully loaded */ 
jQuery(document).ready(function($) {
	

	/* Small helpers
	 ------------------------------------------------------------------------*/

	/* Current time */
	function current_time() {
		var currentdate = new Date(); 
		var datetime = currentdate.getHours() + ":" + pad( currentdate.getMinutes(), 2 ) + ":" + pad( currentdate.getSeconds(), 2 );
		return datetime;
	}

	/* Pad */
	function pad( str, max ) { 
		str = str.toString(); 
		function main( str, max ){ 
			return str.length < max ? main( '0' + str, max ): str; 
		} 
		return main( str, max ); 
	}


	/* UI
	------------------------------------------------------------------------*/

	// GENERIC JQUERY UI SETUP
	$( '._button' ).button();


	/* Navigation
	 ------------------------------------------------------------------------*/

	// Code editor
	if ( $.inArray( 'code_editor',  panel_vars.used_plugins ) !== -1 ) 
		code_editor = true;
	else
		code_editor = false;


	// Store variables
    var 
    	menu_head = $( '.panel-menu > li > a' ),
        menu_body = $( '.panel-menu li > .panel-sub-menu' );

    // Create breadcrumbs
    $( '.panel-menu li a' ).each( function(i) {
    	var
    		id = $( this ).data( 'tab_id' ),
    		sub = $( this ).next(),
    		ul = null;

    	if ( sub.length > 0 ) {

    		ul = $( this ).parent().find( 'ul' ).clone();
    		ul.find( 'a' ).contents().unwrap().attr( 'id', '' );
    		ul = '<ul>' + ul.html() + '</ul>';
    		$( '#' + id ).find( '.panel-breadcrumb div:last-child' ).append( ul );
    	}


    });

    //  Breadcrumb animation
    function breadcrumb( el, eq ) {

    	var
    		offset = - ( eq * 20 );

    	el.animate( {
    		top: offset
    	});
    }
    
    // Open the first tab on load
	menu_head.first()
		.addClass( 'active' )
		.next()
		.slideDown( 'normal' )
		.find( 'a:first' )
		.addClass( 'active' );

	/* Display first tab */
	$( '.panel-tab:first' ).css( 'display', 'block' );
	if ( $( '.panel-tab:first' ).find( '.panel-tab' ).length > 0 ) {
		$( '.panel-tab:first .panel-tab:first' ).css( 'display', 'block' );
	}


	// Click function
    menu_head.on( 'click', function( event ) {
			
			var 
				sub = $( this ).next(),
				id = $( this ).data( 'tab_id' ),
				tab = $( '#' + id );


        // Disable header links
        event.preventDefault();

        // Show and hide the tabs on click
        if ( !$(this).hasClass( 'active' ) ) {

        	// Hide all tabs
			$( '.panel-tab' ).css( 'display', 'none' );

			// Show main tab
			tab.fadeIn( 500 );
            menu_body.slideUp( 'normal' );
            $( this ).next().stop( true, true ).slideToggle( 'normal' );
            menu_head.removeClass( 'active' );
            menu_body.find( 'a' ).removeClass( 'active' );
            $( this ).addClass( 'active' );
            $( this ).next().find( 'li:first a' ).addClass( 'active' );
            $( '.panel-tab:visible .panel-tab:first' ).css( 'display', 'block' );

            // Breadcrumbs
            breadcrumb( $( '.panel-breadcrumb ul', tab ), 0 );

            // Editors
            if ( code_editor ) {
	            if ( $('#custom_css').length > 0 )
	            	css_editor.refresh();
	            if ( $('#custom_js').length > 0 )
					js_editor.refresh();
			}
        }

    });


    // Click function
    menu_body.find( 'li > a' ).on( 'click', function( event ) {

			var
				id = $( this ).data( 'tab_id' ),
				tab = $( '#' + id ),
				main_tab = null,
				eq = null;

			if ( !$( this ).hasClass( 'active' ) ) {
				menu_body.find( 'a' ).removeClass( 'active' );
				$( this ).addClass( 'active' );
				$( '.panel-tab:visible .panel-tab' ).css( 'display', 'none' );
				main_tab = $( '.panel-tab:visible > .panel-breadcrumb ul' );
				tab.fadeIn( 500 );

				// Breadcrumbs
				eq = $( this ).parent().index();
				breadcrumb( main_tab, eq );

				// Editors
				if ( code_editor ) { 
	            	if ( $('#custom_css').length > 0 )
	            		css_editor.refresh();
	            	if ( $('#custom_js').length > 0 )
						js_editor.refresh();
				}
			}
        event.preventDefault();
    });

    /* Respnsive menu */
    $( '#show-res-nav' ).on( 'click', function( event ){
    	if ( $( '#panel-sidebar' ).hasClass( 'mobile-nav' ) ) {
			$( '#panel-sidebar' ).removeClass( 'mobile-nav' );
    	} else {
    		$( '#panel-sidebar' ).addClass( 'mobile-nav' );
    	}
    	event.preventDefault();
    });


	/* Save Settings
 	------------------------------------------------------------------------*/

	$( '#_save, #_save_mobile' ).on( 'click', function() {
		
		/* Show progress bar */ 
		NProgress.start();
		 
		/* Update editor content */
        $( '.custom-tiny-editor' ).each( function() {
											   
			/* Only for visual editor */
			if ( $( this ).children().hasClass( 'tmce-active' ) ) {
				var editor_id = $( this ).data( 'id' );
				editor_id = '#' + editor_id;
				var editor_content = $( editor_id + '_ifr', this ).contents().find( 'body' ).html();
				if ( editor_content ) {
				   if ( editor_content == '' || editor_content == '<p><br></p>' || editor_content == '<p><br data-mce-bogus="1"></p>' ) {
				   		editor_content = '';
				   	}
				   $( 'textarea' + editor_id, this ).val( editor_content );
				}
			}
		});

		var 
			data = {
				action: 'panel_save',
				data: $( '#r_panel_form' ).serializePost()
	    	};

        $.ajax({
			url: ajaxurl,
			data: data,
			type: 'POST',
			success: function( response ) {
				
				if ( response == 'import_error' ) {

					/* Show notice */
					$( '#panel-notices' ).notify( 'create' , {
						title: 'Error!',
						text: 'Import error @ ' + current_time() + '.'
					});

					NProgress.done();
					
					return false;
				}

				/* Parse JSON object */
				response = JSON.parse( response );
				var is_import = false;
				
				/* If import */
				if ( $( '#data-import-wrap :input' ).length > 0 && $( '#data-import-wrap :input' ).val() != '' ) is_import = true;
				
				$( '#r_panel_form :input' ).each( function ( i ) {
															 
					var input_name = $( this ).attr( 'name' );
					var input_val = $( this ).val();
					var response_val = response[ input_name ];
					
					/* Inputs */
					if ( response_val != undefined & response_val != input_val ) {
						$( this ).val( response[input_name] );
					}
				
				});

				/* Default colorpicker value */
				if ( $.inArray( 'color',  panel_vars.used_plugins ) !== -1 ) {
  
					$( '.colorpicker-input' ).each( function() {
					    if ( $( this ).val() != '' ) {
							var hex = $( this ).val();
							$( this ).next().css( 'background-color', hex );
						}
					});
				}
				
				/* TinyMCE update content */
				$( '.custom-tiny-editor' ).each( function() {
					var editor_id = $( this ).data( 'id' );
					editor_id = '#' + editor_id;
					var saved_content = $( 'textarea' + editor_id, this ).val();
					$( editor_id + '_ifr', this ).contents().find( 'body' ).html( saved_content );
				});
				
				/* Hide progress bar */ 
				NProgress.done();

				/* If import */
				if ( is_import ) {

					/* Show notice */
					$( '#panel-notices' ).notify( 'create' , {
						title: 'Success!',
						text: 'New settings are imported @ ' + current_time() + '.'
					});

					setTimeout(function(){
						location.reload();
					}, 2000);

					return false;
				}

				/* Show notice */
				$( '#panel-notices' ).notify( 'create' , {
					title: 'Success!',
					text: 'Settings are saved @ ' + current_time() + '.'
				});
	    	}
		});
		return false;
	});
	
	/* Autosave */
	if ( $( '#panel' ).data('autosave') == true ) {
		$( '#_save' ).trigger('click');
	}


	/* Import Data
	------------------------------------------------------------------------*/	
	$( '.data-import' ).toggle( function () {
		$textarea = '<textarea name="import" style="height:200px;overflow:auto" cols="" rows=""></textarea>';									        
		$( '#data-import-wrap .input-wrap' ).append($textarea);
		$( '#data-import-wrap' ).slideDown(400);
	    return false;
											  
	}, function () {
		$( '#data-import-wrap' ).slideUp( function() {
			$( '#data-import-wrap .input-wrap :input' ).remove();
		});
	    return false;
		
	});


    /* Notices
	------------------------------------------------------------------------*/
	$( '#panel-notices' ).notify();


	/* Upload
	------------------------------------------------------------------------*/
	(function() {

		if ( $.inArray( 'add_image',  panel_vars.used_plugins ) === -1 ) return;

		var 
			target_input,
			image_container,
			_orig_send_attachment = wp.media.editor.send.attachment;
		
		upload_item = function () {

			var send_attachment_bkp = wp.media.editor.send.attachment,
				button = $( this );

			wp.media.editor.send.attachment = function( props, attachment ){

				// Get only images
				if ( attachment.type != 'image' ) {
					return false;
				}
			   	var 
					target_url = attachment.url,
					get_url = image_container.find( '.image-holder' ).data( 'get_url' );
	            	image_id = attachment.id;

	            // Fill input field
	            if ( get_url != undefined && get_url == true ) {
	            	// Add SRC to input
	            	target_input.val( target_url );
	            } else {
		            // Add ID to hidden input
		            target_input.val( image_id );
	        	}

	        	image_container.thumbGenerator( { 'image_id': image_id } );

			}

			image_container = $( this ).parent();
			target_input = image_container.find( 'input' );

			wp.media.editor.open( button );

			return false;
		};
		
		$( '.upload-image' ).on( 'click', upload_item );
		
		/* Image Delete button */
		var delete_image = function( event ) {
			var el = $( this ).parent();
			$( this ).hide();
			$( '.image-holder img', el ).fadeOut().remove();
			$( '.msg-dotted', el ).fadeIn();
			$( '.upload-image', el ).fadeIn();
			$( '.image-input', el ).val( '' );

			event.preventDefault();
		}
		$('.delete-image').on( 'click', delete_image );
	})();


	/* Sortable List
	------------------------------------------------------------------------*/
	$( '.sortable' ).sortable({
		handle: $('.sortable-list .drag-item'),
		axis: 'y'
	});
	
	/* Add new static item */
    $( '.box-row .add-new-item' ).on( 'click', function () { 
   
        var new_item = $( this).parents( '.box-row' ).find( '.new-item ul' ).html();
        $( this ).parents( '.box-row' ).find( '.sortable-list' ).append( new_item );
		$( this ).parents( '.box-row' ).find( '.sortable' ).sortable( {
		    handle: $( '.sortable-list .drag-item' ),
		    axis: 'y'
	    });
		return false;
    });
	

	/* Delete item */
	var delete_item = function() {
		var current_item = $( this );
 
		/* Show Dialog */
		$('<div/>')
		.text('These item will be permanently deleted and cannot be recovered. Are you sure?.')
		.appendTo( 'body' )
		.dialog( {
			title: 'Delete Item',
			modal: false,
			width: 400,
			hide: 'fade',
			show: 'fade',
			dialogClass :'ui-custom ui-custom-dialog',
			buttons: [
				{
					text: 'Delete item',
					'class': 'ui-button-delete',
					click: function() {
						current_item.parents( 'li:eq(0)' ).fadeOut( 400, function () {
							$( this ).remove();
						});

						/* Show notice */
		 				$( '#panel-notices' ).notify( 'create', {
							title: 'Success!',
							text: 'Item are removed @ ' + current_time() + '.'
						});

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
				$(event.target).parent().find( '.ui-button-delete span' ).prepend( '<i class="fa icon fa-trash-o"></i>' );

				/* Add helper class to overlay layer */
				$( '.ui-widget-overlay' ).addClass( 'ui-custom-overlay' );

				/* Center dialog */
				$(window).resize( function() {
    				$(event.target).dialog( 'option', 'position', 'center' );
				});
    		}

		});

    };

	/* Bind click function (delete row) */
    $( 'body' ).on( 'click', '.sortable-list .delete-item', delete_item );


	/* Datepicker
	------------------------------------------------------------------------*/
	$( '.datepicker-input' ).datepicker( {
		'dateFormat': 'yy-mm-dd'
	});


	/* Range
	------------------------------------------------------------------------*/
	$( '.range' ).each( function() {
		var 
			input = $( this ).find( 'input' ),
			slider = $( this ).find( '.range-slider' ),
			val = input.val(),
			min = input.data( 'min' ),
			max = input.data( 'max' ),
			step = input.data( 'step' );

		slider.slider( {
			orientation: 'horizontal',
			range: 'min',
			animate: true,
			min: min,
			max: max,
			value: val,
			setp: step,
			slide: function( event, ui ) {
				input.val( ui.value );
			}
    	});
		
		// Focus out
		input.focusout( function() {
    		var val = $( this ).val();
    		slider.slider( 'value', val );
		});

	});


	/* Selected Group
	------------------------------------------------------------------------*/
	$( '.select-group' ).each( function() {
	    var group = $( this ).val();

	    	// strip out all whitespace
	    	group = group.replace( /\s/g, '_' );

	    	// convert the string to all lowercase
	    	group = group.toLowerCase();

	    	// Create group
		    group = 'group-' + group;
			$( '.' + group ).show();
	});
											 
	$( '.select-group' ).change( function() {
											 
		var group = $( this ).val(),
		    main_group = $( this ).data( 'main-group' );

		    // strip out all whitespace
	    	group =  group.replace( /\s/g, '_' );

	    	// convert the string to all lowercase
	    	group =  group.toLowerCase();
		    group = 'group-' + group;
		    
			$( '.' + main_group ).hide();
			$( '.' + group ).fadeIn();
	
	});


	/* EXTERNAL PLUGINS
	------------------------------------------------------------------------*/


	/* Color Picker
	------------------------------------------------------------------------*/

	if ( $.inArray( 'colorpicker',  panel_vars.used_plugins ) !== -1 ) {
  
		$( '.colorpicker-input' ).each( function( i ) {
			var id = 'color_picker_' + i;
			$( this ).attr( 'id', id );
			$( '#' + id ).wpColorPicker();
		});
  
	}


	/* Syntax Highlight
	------------------------------------------------------------------------*/
	
	if ( $.inArray( 'code_editor',  panel_vars.used_plugins ) !== -1 ) {

		/* CSS */
		if ( $('#custom_css').length > 0 ) {
			var css_editor = CodeMirror.fromTextArea(document.getElementById('custom_css'), {
				 lineNumbers: true,
				 matchBrackets: true,
				 autoClearEmptyLines: true,
				 onBlur: function() { css_editor.save(); },
				 theme: 'default',
			     mode: 'text/css'
			});
		}
		
		/* JS */
		if ( $('#custom_js').length > 0 ) {
			var js_editor = CodeMirror.fromTextArea(document.getElementById('custom_js'), {
				 lineNumbers: true,
				 matchBrackets: true,
				 autoClearEmptyLines: true,
				 onBlur: function() { js_editor.save();},
				 theme: 'default',
			     mode: 'text/javascript'
			});
		}
	}


	/* Cufon Fonts
	------------------------------------------------------------------------*/

	if ( $.inArray( 'cufon_fonts', panel_vars.used_plugins ) !== -1 ) {

		var 
			cufon_id = $( '#cufon-id' ).text();
		
		/* Build fonts array */
		function build_fonts() {
			$( '#cufon-fonts' ).val('');
			var fonts = '';
			var fonts_length = $( '#cufon-list li.selected' ).size();
			
			$( '#cufon-list li.selected' ).each( function( i ) {
			    var font_file_name = $( '.cufon-file-name', this ).text();
			    fonts += font_file_name;
			    if ( i < fonts_length - 1 ) 
			    	fonts += '|';
			});
			
			$( '#cufon-fonts' ).val( fonts );
			return false;
		}
		
		/* Build fonts helpers tags */
	    function build_fonts_tags() {
			$( '#cufon-tags span' ).remove();
			
			$( '#cufon-list li.selected' ).each( function( i ) {
			    var font_name = $( '.cufon-font-name', this ).text();
			    $( '#cufon-tags' ).append( '<span class="cufon-tag">' + font_name + '</span>' );
			});
			
			/* Add click functions */
			$( '#cufon-tags span' ).click( function(){
				var font_name = $( this ).text();
				var code = 'Cufon.replace("HTML elements to replace", {fontFamily : "' + font_name + '", hover: "true"});'
			    var txt = $( '#cufon-code');
				if ( txt.val() == '' ) txt.val( txt.val() + code );
				else txt.val( txt.val() + '\n' + code );
				return false;
			});
			
			return false;
		}
		
		function insert_text( element, valor ){
		    var element_dom = document.getElementsByName( element )[0];
			if ( document.selection ) {
				element_dom.focus();
				sel = document.selection.createRange();
				sel.text = valor;
				return;
			}
			if ( element_dom.selectionStart || element_dom.selectionStart == '0' ) {
				var 
					t_start = element_dom.selectionStart,
					t_end = element_dom.selectionEnd,
					val_start = element_dom.value.substring( 0, t_start ),
					val_end = element_dom.value.substring( t_end,element_dom.value.length );
				element_dom.value = val_start + valor + val_end;
			} else {
			    element_dom.value += valor;
			}
		}
		
		/* Click function*/
		$( '#cufon-list li' ).click( function(){
			if($( this ).is( '.selected' ) ){
				if ($( '#cufon-list li.selected' ).size() > 1 )
			    	$( this ).removeClass( 'selected' );
			} else {
			    $( this ).addClass( 'selected' );
			}
			build_fonts();
			build_fonts_tags();
			return false;
		});
		
		build_fonts_tags();
	}


	/* Easy Link
	------------------------------------------------------------------------*/
	if ( $.inArray( 'easy_link', panel_vars.used_plugins ) !== -1 ) {
		
		$('.easy-link').on( 'click', function( event ) {
		    $( this ).easyLink();
			event.preventDefault();
		});
	}


	/* Easy Link
	------------------------------------------------------------------------*/
	if ( $.inArray( 'video', panel_vars.used_plugins ) !== -1 ) {
		$('._video').VideoGenerator();
	}


	/* Iframe generator
	------------------------------------------------------------------------*/
	if ( $.inArray( 'iframe_generator', panel_vars.used_plugins ) !== -1 ) {
		$('.generate-iframe').IframeGenerator();
	}


	/* Background generator
	------------------------------------------------------------------------*/
	if ( $.inArray( 'bg_generator', panel_vars.used_plugins ) !== -1 ) {
		$('.generate-bg').BgGenerator();
	}


	/* Multiselect
	------------------------------------------------------------------------*/
	if ( $.inArray( 'multiselect', panel_vars.used_plugins ) !== -1 ) {
		if ( $( '.multiselect' ).length > 0 ) {

			$( '.multiselect' ).each( function() { 
				var id = $( this ).attr( 'id' );
				$( '#' + id ).multiSelect();
			});
		}
	}


	/* Switch buttons
	------------------------------------------------------------------------*/
	if ( $.inArray( 'switch_button', panel_vars.used_plugins ) !== -1 ) {
		$( '.switch-wrap > select' ).each( function( i, item ) {

			// Show groups
			if ( $( this ).hasClass( 'switch-group' ) && $( this ).val() == 'on' ) {

			    var main_group = $( this ).data('main-group'),
					group = $( this ).attr('id');

					group = '.group-' + group + '.' + main_group;

					$( group ).show();
			}

			$( item ).toggleSwitch( {
				highlight: $( item ).data('highlight'),
				width: 25,
				change: function( e, val ) {
    				var 
    					e = $( e.target ).parent().parent(),
    					sel = e.find( 'select' ),
    					val = sel.val();

    				if ( val == undefined ) return;

    				if ( sel.hasClass( 'switch-group' ) ) {
	    				var main_group = sel.data('main-group'),
							group = sel.attr( 'id' ),
							group = '.group-' + group + '.' + main_group;

						if ( val == 'on' ) 
							$(group).fadeIn();
						else
							$(group).fadeOut();
					}
  				}
			});
		});
	}

});


/*------------------------------------------------------------------------

 Small Plugins

------------------------------------------------------------------------*/	


/* Serialize Post
------------------------------------------------------------------------*/
;(function($) {

    $.fn.serializePost = function() {  
        var data = {};  
        var formData = this.serializeArray();  
        for ( var i = formData.length; i--; ) {  
            var name = formData[i].name;  
            var value = formData[i].value;  
            var index = name.indexOf( '[]' );  
            if ( index > -1 ) {  
                name = name.substring( 0, index );  
                if ( !( name in data ) ) {  
                    data[name] = [];  
                }  
                data[name].push(value);  
            }  
            else  
                data[name] = value;  
        }  
        return data;  
    };

})(jQuery);


/* Thumb Generator
------------------------------------------------------------------------*/
;(function($) {
	$.fn.thumbGenerator = function( options ) {
		
	    return this.each( function() {

	    	var opts = $.extend({
				'image_id' : 0
			}, options);

			var image_container = $( this ),
			    image_id = opts.image_id,
			    image_wrap = $( '.image-holder', image_container ),
			    width = image_wrap.data( 'width' ),
			    height = image_wrap.data( 'height' ),
			    crop = image_wrap.data( 'crop' )
			
			$( '.msg-error', image_container ).hide();
			
			var data = {
				action: 'thumb_generator',
				id: image_id,
				crop: crop,
				width: width,
				height: height
			};
						
			$( '.ajax-loader', image_container ).fadeIn( 400 );
			
			/* If the image doesn't exists */
			$.ajax({
				url: ajaxurl,
				data: data,
				type: 'POST',
				success: function( response ) {
										
					if ( response == 'error' ) {
						$( '.ajax-loader', image_container ).fadeOut( 400 );
						$( '.msg-error', image_container ).fadeIn( 400 );
						return;
					}
						
					var image = new Image();
					response = response.replace( /\&amp;/g, '&' );
					
					/* Loading new image */
					$( image ).load( function() {
						image_wrap.html( image );
						$( '.ajax-loader', image_container ).hide();
						$( this ).hide().fadeIn( 400 );
						$( '.upload-image', image_container ).hide();
						$( '.msg-dotted', image_container ).hide();
						$( '.delete-image', image_container ).show();
					
					}).attr({
							src: response,
							alt: image_id
					});
	            }
			});
			
			return;
		});
	};
})(jQuery);