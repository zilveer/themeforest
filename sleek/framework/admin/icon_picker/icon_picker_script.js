/*	Icon Picker Dialog Script
/*------------------------------------------------------------*/

(function($){
"use strict";
$(document).ready(function(){

	var $el, id, input, source;
	var $lightbox = $('.sleek-lightbox--icon-picker');
	var $icon = $lightbox.find('.sleek-icon-picker-list .item input');
	var $filter = $lightbox.find('.filter input');
	var $statusIcon = $lightbox.find('.status i');
	var $statusTitle = $lightbox.find('.status .js-title');

	// fix for css problem with misbehaving fixed div inside absolute div
	$lightbox.appendTo('body');



	// on TinyMCE button clicked
	$(document).on( 'sleek:tinymceGetIconClick', function( event, data ){
		openLightbox();
		// set save button for TinyMCE variation
		$lightbox.find('.js-save').get(0).dataEditor = data.editor;
		$lightbox.find('.js-save').get(0).shortcode = data.shortcode;
	});



	// on Widget Social picker click
	$('body').on( 'click', '.sleek-widget-social-picker .form .icon', function(){
		source = 'widget-social-picker';
		$el = $(this);

		openLightbox();
	});



	// close bg control lightbox
	$lightbox.on('click', '.js-close', function(){
		$lightbox.fadeOut();
		$('body').removeClass('sleek-lightbox-active');
	});



	// save bg control and exit lightbox
	$lightbox.on('click', '.js-save', function(){

		var value = getIconValue();

		// If in TinyMCE
		if( this.dataEditor ){

			// if shortcode get whole shortcode
			if( this.shortcode === true ){
				this.dataEditor.insertContent( '[icon]'+value+'[/icon]' );
			}else{
				// insert icon class name
				this.dataEditor.insertContent( value );
			}
		}

		// If Widget Social Picker
		if( source == 'widget-social-picker' ){
			$el.find('input').val( value );
			$el.find('i').addClass( value );
		}


		$(document).trigger('sleek:iconPicked');
		$lightbox.fadeOut();
		$('body').removeClass('sleek-lightbox-active');

	});



	// open lightbox function
	function openLightbox(value){

		if(value) {
			// set lightbox values to active ones
		}

		$lightbox.fadeIn();
		$( 'body' ).addClass( 'sleek-lightbox-active' );
	}



	// collect and return value from Icon Picker Lightbox
	function getIconValue() {
		var value = $icon.filter(':checked').val();

		return value;
	}



	// on icon select
	$icon.change(function(){
		var value = getIconValue();
		$statusIcon.removeClass().addClass( value );
		$statusTitle.html( value );
	});



	// on filter
	$filter.keyup(function(){
		var term = $(this).val();

		$icon.each(function(){

			if( $(this).val().toLowerCase().indexOf(term) == -1 ){
				$(this).parent().hide();
			}else{
				$(this).parent().show();
			}

		});
	});



}); // doc ready end
})(jQuery);
