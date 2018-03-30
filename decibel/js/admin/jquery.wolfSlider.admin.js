var WolfSliderParams =  WolfSliderParams || {};

;( function( $ ) {

	'use strict';

	if ( WolfSliderParams.isSlideAdminPage ) {
		$( '#edit-slug-box' ).hide();
	}
	
	var val = $( 'select#_wolf_slide_type' ).val();

	if ( 'video' === val ) {
		$( '#box_wolf_slide_image' ).hide();
		$( '#box_wolf_slide_video' ).show();
	} else {
		$( '#box_wolf_slide_image' ).show();
		$( '#box_wolf_slide_video' ).hide();
	}

/*-----------------------------------------------------------------------------------*/
/*	Uploader
/*-----------------------------------------------------------------------------------*/
	$( '.wolf-slider-set-img, .wolf-slider-set-bg' ).click( function( e ) {
		e.preventDefault();
		var $el = $( this ).parent(),
			uploader = wp.media({
			title : 'Choose an image',
			library : { type : 'image'},
			multiple : false
		})
		.on( 'select', function(){
			var selection = uploader.state().get('selection'),
				attachment = selection.first().toJSON();
			$('input', $el).val(attachment.id);
			$('img', $el).attr('src', attachment.url).show();
		})
		.open();
	});

	$( '.wolf-slider-set-file' ).click(function(e){
		e.preventDefault();
		var $el = $( this ).parent(),
			uploader = wp.media({
			title : 'Choose a file',
			multiple : false
		})
		.on( 'select', function(){
			var selection = uploader.state().get('selection'),
				attachment = selection.first().toJSON();
			$('input', $el).val(attachment.url);
			$('span', $el).html(attachment.url).show();
		})
		.open();
	});


/*-----------------------------------------------------------------------------------*/
/*	Reset Image preview
/*-----------------------------------------------------------------------------------*/

	$('.wolf-slider-reset-img, .wolf-slider-reset-bg').click(function(){
		
		$( this ).parent().find('input').val('');
		$( this ).parent().find('.wolf-slider-img-preview').hide();
		return false;

	});

	$('.wolf-slider-reset-file').click(function(){
		
		$( this ).parent().find('input').val('');
		$( this ).parent().find('span').empty();
		return false;

	});

	$( 'select#_wolf_slide_type' ).on( 'change', function () {
		var val = $( 'select#_wolf_slide_type' ).val();

		if ( 'video' === val ) {
			$( '#box_wolf_slide_image' ).hide();
			$( '#box_wolf_slide_video' ).show();
		} else {
			$( '#box_wolf_slide_image' ).show();
			$( '#box_wolf_slide_video' ).hide();
		}
	} );

} )( jQuery );