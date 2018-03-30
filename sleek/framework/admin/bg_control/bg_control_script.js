/*	Bg Control Dialog Script
/*------------------------------------------------------------*/

(function($){
"use strict";
$(document).ready(function(){

	var $el, id, input;
	var $lightbox = $('.sleek-lightbox--bg-control');

	var $lightboxInput = $lightbox.find('input');
	var $lightboxSelect = $lightbox.find('select');
	var $lightboxColor = $lightbox.find('.bg-color');
	var $lightboxImage = $lightbox.find('.bg-image');
	var $lightboxRepeat = $lightbox.find('.bg-repeat');
	var $lightboxSize = $lightbox.find('.bg-size');
	var $lightboxPosition = $lightbox.find('.bg-position');
	var $lightboxAttachment = $lightbox.find('.bg-attachment');
	var $lightboxPattern = $lightbox.find('.bg-pattern');
	var $lightboxPreview = $lightbox.find('.bg-control-preview');

	// fix for css problem with misbehaving fixed div inside absolute div
	// or hidden div on tag/category
	$lightbox.appendTo('body');


	// Get palettes for color picker
	var sleekPalettes = $lightboxColor.attr('data-sleek-palettes') || '';
	sleekPalettes = sleekPalettes.split(',');

	// add wp color picker control with callbacks on color field
	$lightboxColor.wpColorPicker({
		// a callback to fire whenever the color changes to a valid color
		change: updateBgColorLivePreview,
		// a callback to fire when the input is emptied or an invalid color
		clear: updateBgColorLivePreview,
		palettes: sleekPalettes
	});



	// on bg image button add media library chooser
	$('body').on('click','.js-bg-image-btn', function() {

		var custom_uploader;
		//If the uploader object has already been created, reopen the dialog
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}

		//Extend the wp.media object
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Background Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});

		//When a file is selected, grab the URL and set it as the text field's value
		custom_uploader.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$lightboxImage.val(attachment.url);
			updateBgColorLivePreview();
		});

		//Open the uploader dialog
		custom_uploader.open();
	});

	// BG Image field clear
	$('body').on('click', '.js-bg-image-remove', function(){
		$lightboxImage.val('');
		updateBgColorLivePreview();
	});



	// open bg control lightbox and set active elements and id
	$('body').on('click', '.js-bg-control-btn', function(){
		// set vars
		id = $(this).attr('data-id');
		$el = $('[data-el="'+id+'"]');
		input = $el.find('input.bg-control');

		// reset lightbox from possible TinyMCE changes
		$lightbox.find('.js-save').get(0).dataEditor = null;

		openLightbox( input.val() );
	});



	// on TinyMCE button clicked
	$(document).on( 'sleek:tinymceGetBgClick', function( event, editor ){
		openLightbox();
		// set save button for TinyMCE variation
		$lightbox.find('.js-save').get(0).dataEditor = editor;
	});



	// close bg control lightbox
	$lightbox.on('click', '.js-close', function(){
		$lightbox.fadeOut();
		$('body').removeClass('sleek-lightbox-active');
	});



	// save bg control and exit lightbox
	$lightbox.on('click', '.js-save', function(){

		var value = getBgValue();

		// If in TinyMCE
		if(this.dataEditor){

			// insert content as text into editor
			this.dataEditor.insertContent( value );

		}else{

			// set value to input field and trigger 'on change event'
			input.val( value ).change();

			// update preview
			$el.find('.sleek-bg-control-field').attr('style','background:'+value);

		}

		$lightbox.fadeOut();
		$('body').removeClass('sleek-lightbox-active');

	});



	// on lightbox field change update live preview
	$lightboxInput.change( updateBgColorLivePreview );
	$lightboxSelect.change( updateBgColorLivePreview );



	// update lightbox live preview
	function updateBgColorLivePreview(){
		// delay for WpColorPicker to successfully update value
		setTimeout(function() {
			$lightboxPreview.attr( 'style','background:'+getBgValue() );
		}, 1);

	}



	// open lightbox function
	function openLightbox(value){

		// reset lightbox fields
		$lightboxColor.val('');
		$lightboxImage.val('');
		$lightboxRepeat.val('no-repeat');
		$lightboxAttachment.val('local');
		$lightboxPosition.filter('[value="center center"]').prop('checked',true);
		$lightboxSize.val('auto');
		$lightboxPattern.filter('[value=""]').prop('checked',true);

		if(value) {
			// split multiple backgrounds
			value = value.split(',');

			var bgMain, bgMainSize, bgPattern;
			if(value.length>1){
				bgPattern = value[0];
				bgMain = value[1].replace(';','').split(' ');
				bgMainSize = value[2] ? value[2] : 'auto';
			}else{
				bgMain = value[0].replace(';','').split(' ');
				if(bgMain[1]){
					// remove first 16 chars 'background-size:'
					bgMainSize = bgMain[6].substr(16);
				}
			}

			// set lightbox values to active ones

			// if color transparent, set picker to empty
			bgMain[0] = bgMain[0] =='transparent' ? '' : bgMain[0];
			// set color value and trigger wp color picker update
			$lightboxColor.val(bgMain[0]).keyup();

			// if image proceed to repeat and position values
			if(bgMain[1]){
				// trim last character ')'
				var bgImageUrl = bgMain[1].substr(0,bgMain[1].length-1);
				// trim first 4 characters 'url('
				bgImageUrl = bgImageUrl.substr(4);

				$lightboxImage.val(bgImageUrl);
				$lightboxRepeat.val(bgMain[2]);
				$lightboxAttachment.val(bgMain[3]);
				$lightboxPosition.filter('[value="'+bgMain[4]+' '+bgMain[5]+'"]').prop('checked',true);
				$lightboxSize.val(bgMainSize);
			}

			// get pattern value and activate in lightbox
			if(bgPattern){
				bgPattern = bgPattern.split(' ');
				var bgPatternUrl = bgPattern[0];
				// trim last character ')'
				bgPatternUrl = bgPatternUrl.substr(0,bgPatternUrl.length-1);
				// trim first 4 characters 'url('
				bgPatternUrl = bgPatternUrl.substr(4);

				$lightboxPattern.filter('[value="'+bgPatternUrl+'"]').prop('checked',true);
			}
		}

		updateBgColorLivePreview();
		$lightbox.fadeIn();
		$('body').addClass('sleek-lightbox-active');
	}



	// collect and return values from BG Control Lightbox
	function getBgValue() {
		var value ='';

		if($lightboxColor.val())
			value += $lightboxColor.val();
		else
			// always have color value for proper functioning
			value += 'transparent';

		// all other main bg values wrap under if Image
		if($lightboxImage.val()) {
			value += ' url('+$lightboxImage.val()+')';

			if($lightboxRepeat.val())
				value += ' '+$lightboxRepeat.val();
			if($lightboxAttachment.val())
				value += ' '+$lightboxAttachment.val();
			if($lightboxPosition.filter(':checked').val())
				value += ' '+$lightboxPosition.filter(':checked').val();
			if($lightboxSize.val()){
				if($lightboxPattern.filter(':checked').val()){
					value += '; background-size:auto,'+$lightboxSize.val();
				}else{
					value += '; background-size:'+$lightboxSize.val();
				}
			}
		}

		// set pattern bg as second bg property
		if($lightboxPattern.filter(':checked').val()){
			value = 'url('+$lightboxPattern.filter(':checked').val()+') repeat '+$lightboxAttachment.val()+' top left,' + value;
		}

		// if value has only transparent, remove it to get truly empty bg
		if(value=='transparent')
			value = '';

		return value;
	}


}); // doc ready end
})(jQuery);
