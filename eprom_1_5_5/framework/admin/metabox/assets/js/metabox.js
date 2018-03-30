
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


	/* Upload
	------------------------------------------------------------------------*/
	(function() {

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
			$( '.image-crop', el ).val( 'c' );
			$( '.image-crop-wrap', el ).hide();

			event.preventDefault();
		}
		$('.delete-image').on( 'click', delete_image );

		// Crop
		$( '.image-crop' ).change( function() {
											 
			var crop_value = $( this ).val(),
			    image_container = $( this ).parent().parent();
			
			/* Update crop value */
			$( '.image-holder', image_container ).data( 'crop', crop_value );
			
		    /* Generate new thumbnail */
			image_container.thumbGenerator();
	
		});
	})();


	/* Datepicker
	------------------------------------------------------------------------*/
	$( '.datepicker-input' ).datepicker( {
		'dateFormat': 'yy-mm-dd',
		beforeShow: function(input, inst) {
		    inst.dpDiv.addClass( '_datepicker' );
		}
	});


	/* Select Image
	------------------------------------------------------------------------*/
	$( 'ul.select-image img' ).on( 'click', function(event) {
											
		/* Variables */											
		var 
			box = $( this ).parent().parent().parent(),
			images = $( 'ul', box ),
			id = $( this ).data( 'image_id' );
			
		/* Remove class */
		$( 'img', images ).removeClass( 'selected-image' );
		
		/* Add class */
		$( this ).addClass( 'selected-image' );

		/* Add value */
		$( 'input', box ).val( id );
		
		/* Group */
		var group = id,
		    main_group = images.data( 'main-group' ),
		    group = 'group-'+group;
		    
			$( '.' + main_group ).fadeOut();
			$( '.' + group ).fadeIn();
			
		event.preventDefault();
	});
	
	$( 'ul.select-image.image-group' ).each( function() {
	    var container = $( this ).parent();
		    group = $( '.select-image-input', container ).val();
		    group = 'group-'+group;
			$('.' + group).show();
			
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
  
	$( '.colorpicker-input' ).each( function( i ) {
		var id = 'color_picker_' + i;
		$( this ).attr( 'id', id );
		$( '#' + id ).wpColorPicker();
	});
  

	/* Easy Link
	------------------------------------------------------------------------*/
	$('.easy-link').on( 'click', function( event ) {
	    $( this ).easyLink();
		event.preventDefault();
	});


	/* Media Manager
	------------------------------------------------------------------------*/
	$('.mm-ids').MediaManager();


	/* Video
	------------------------------------------------------------------------*/
	$('._video').VideoGenerator();


	/* Iframe generator
	------------------------------------------------------------------------*/
	$('.generate-iframe').IframeGenerator();



	/* Background generator
	------------------------------------------------------------------------*/
	$('.generate-bg').BgGenerator();
	


	/* Multiselect
	------------------------------------------------------------------------*/
	if ( $( '.multiselect' ).length > 0 ) {

		$( '.multiselect' ).each( function() { 
			var id = $( this ).attr( 'id' );
			$( '#' + id ).multiSelect();
		});
	}
	


	/* Switch buttons
	------------------------------------------------------------------------*/

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
				'image_id' : false
			}, options);

			var image_container = $( this ),
			    image_id = opts.image_id,
			    image_wrap = $( '.image-holder', image_container ),
			    width = image_wrap.data( 'width' ),
			    url = image_wrap.data( 'get_url' ),
			    height = image_wrap.data( 'height' ),
			    crop = image_wrap.data( 'crop' )
			
			$( '.msg-error', image_container ).hide();

			if ( image_id == false && url == true )
				image_id = $( '.image-input', image_container ).val();
			else 
				image_id = $( '.image-input', image_container ).val();
			
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
						$( '.image-crop-wrap', image_container ).hide( 400 );
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
						$( '.image-crop-wrap', image_container ).show();
					
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