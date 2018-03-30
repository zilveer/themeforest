
/* When DOM is fully loaded */ 
jQuery(document).ready(function($) {
	

	/* Datepicker
	------------------------------------------------------------------------*/
	$( '.datepicker-input' ).datepicker( {
		'dateFormat': 'yy-mm-dd',
		beforeShow: function(input, inst) {
		    inst.dpDiv.addClass( '_datepicker' );
		}
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
        $( this ).parents( '.box-row' ).find( '.sortable-list' ).find( '.no-save' ).removeClass( 'no-save' );
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
		 				$( '#muttleypanel-notices' ).notify( 'create', {
							title: 'Success!',
							text: 'Item are removed.'
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


	/* Color Picker
	------------------------------------------------------------------------*/

	if ( $.inArray( 'colorpicker',  muttleypanel_vars.used_plugins ) !== -1 ) {
  
		$( '.colorpicker-input' ).each( function( i ) {
			var id = 'color_picker_' + i;
			$( this ).attr( 'id', id );
			$( '#' + id ).wpColorPicker();
		});
  
	}


	/* Syntax Highlight
	------------------------------------------------------------------------*/
	
	if ( $.inArray( 'code_editor',  muttleypanel_vars.used_plugins ) !== -1 ) {

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

		$( '.muttleypanel-menu a' ).on( 'click', function(){

			if ( $( '.muttleypanel-tab:visible .code-editors' ).length ) {
            	css_editor.refresh();
				js_editor.refresh();
			}
		} );
	}


	/* Cufon Fonts
	------------------------------------------------------------------------*/

	if ( $.inArray( 'cufon_fonts', muttleypanel_vars.used_plugins ) !== -1 ) {

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
	if ( $.inArray( 'easy_link', muttleypanel_vars.used_plugins ) !== -1 ) {
		
		$('.easy-link').on( 'click', function( event ) {
		    $( this ).easyLink();
			event.preventDefault();
		});
	}


	/* Video Generator
	------------------------------------------------------------------------*/
	if ( $.inArray( 'video', muttleypanel_vars.used_plugins ) !== -1 && $( '._video' ).length ) {
		$( '._video' ).VideoGenerator();
	}


	/* Iframe generator
	------------------------------------------------------------------------*/
	if ( $.inArray( 'iframe_generator', muttleypanel_vars.used_plugins ) !== -1 && $( '.generate-iframe' ).length ) {
		$('.generate-iframe').IframeGenerator();
	}


	/* Background generator
	------------------------------------------------------------------------*/
	if ( $.inArray( 'bg_generator', muttleypanel_vars.used_plugins ) !== -1 && $('.generate-bg').length ) {
		$('.generate-bg').BgGenerator();
	}


	/* Multiselect
	------------------------------------------------------------------------*/
	if ( $.inArray( 'multiselect', muttleypanel_vars.used_plugins ) !== -1 ) {
		if ( $( '.multiselect' ).length > 0 ) {

			$( '.multiselect' ).each( function() { 
				var id = $( this ).attr( 'id' );
				$( '#' + id ).multiSelect();
			});
		}
	}


	/* Switch buttons
	------------------------------------------------------------------------*/
	if ( $.inArray( 'switch_button', muttleypanel_vars.used_plugins ) !== -1 ) {
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