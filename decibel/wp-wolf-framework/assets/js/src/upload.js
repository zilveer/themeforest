/*-----------------------------------------------------------------------------------*/
/*	Uploader
/*-----------------------------------------------------------------------------------*/
var WolfAdminParams =  WolfAdminParams || {};

;( function( $ ) {

	'use strict';

	$( document ).on( 'click', '.wolf-options-set-img, .wolf-options-set-bg', function( e ) {
		e.preventDefault();
		var $el = $( this ).parent();
		var uploader = wp.media({
			title : WolfAdminParams.chooseImage,
			library : { type : 'image'},
			multiple : false
		})
		.on( 'select', function(){
			var selection = uploader.state().get('selection');
			var attachment = selection.first().toJSON();
			$('input', $el).val(attachment.id);
			$('img', $el).attr('src', attachment.url).show();
		})
		.open();
	});


	$( document ).on( 'click', '.wolf-options-set-file', function(e){
		e.preventDefault();
		var $el = $( this ).parent();
		var uploader = wp.media({
			title : WolfAdminParams.chooseFile,
			multiple : false
		})
		.on( 'select', function(){
			var selection = uploader.state().get('selection');
			var attachment = selection.first().toJSON();
			$('input', $el).val(attachment.url);
			$('span', $el).html(attachment.url).show();
		})
		.open();
	});


/*-----------------------------------------------------------------------------------*/
/*	Reset Image preview
/*-----------------------------------------------------------------------------------*/

	$( document ).on( 'click', '.wolf-options-reset-img, .wolf-options-reset-bg', function(){

		$( this ).parent().find('input').val('');
		$( this ).parent().find('.wolf-options-img-preview').hide();
		return false;

	});

	$( document ).on( 'click', '.wolf-options-reset-file', function(){

		$( this ).parent().find('input').val('');
		$( this ).parent().find('span').empty();
		return false;

	});

/*-----------------------------------------------------------------------------------*/
/*	Tipsy
/*-----------------------------------------------------------------------------------*/

	$( '.hastip' ).tipsy( { fade: true, gravity: 's' } );

} )( jQuery );
