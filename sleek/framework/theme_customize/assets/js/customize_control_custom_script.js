/*	Custom Customize Control Scripts
/*------------------------------------------------------------*/

(function($){
"use strict";
$(document).ready(function(){



/*------------------------------------*/
/*  Image Upload
/*------------------------------------*/

$('.sleek-image-upload-field').each(function(){
	var $el 	= $(this);
	var $btn 	= $el.find('.js-sleek-image-upload-button');
	var $input 	= $el.find('input');
	var $img 	= $el.find('img');
	var $remove = $el.find('.js-bg-image-remove');

	// on upload image button add media library chooser
	$btn.click(function() {

		var custom_uploader;
		//If the uploader object has already been created, reopen the dialog
		if (custom_uploader) {
			custom_uploader.open();
			return;
		}

		//Extend the wp.media object
		custom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});

		//When a file is selected, grab the URL and set it as the text field's value
		custom_uploader.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$btn.text('Change Image');
			$input.val(attachment.url);
			$input.keyup();
		});

		//Open the uploader dialog
		custom_uploader.open();
	});

	// on input keyup update image preview
	$input.keyup(function(){
		$img.attr('src',$input.val());
		// trigger WP Customizer 'on change event';
		$input.change();
	});

	// on remove clear input and update btn text
	$remove.click(function(){
		// trigger WP Customizer 'on change event';
		$input.val('').keyup();
		$btn.text('Upload Image');
	});
});




/*------------------------------------*/
/*  Font Control
/*------------------------------------*/

$('.sleek-font-control-field').each(function(){
	var $el 	= $(this);
	var $input 	= $el.find('[name="font-control"]');
	var $family = $el.find('[name="font-family"]');
	var $style 	= $el.find('[name="font-style"]');
	var $size 	= $el.find('[name="font-size"]');
	var $line 	= $el.find('[name="line-height"]');

	$family.chosen();

	// on family change, update styles list
	$family.change(function(){
		var styles = $('option:selected',this).attr('data-styles');
		styles = styles.split(',');

		$style.html('');
		$.each( styles, function(key,value) {
			var selected = value == 'regular' ? 'selected' : '';
			$style.append('<option value="'+value+'" '+selected+'>'+value+'</option>');
		});

		updateValue();
	});

	// on any field change, trigger update main customize field
	$style.change(updateValue);
	$size.change(updateValue);
	$line.change(updateValue);
	$size.keyup(updateValue);
	$line.keyup(updateValue);

	// collect values into string and add to customize field
	function updateValue(){
		$input.val( $family.val()+'|'+$style.val()+'|'+$size.val()+'|'+$line.val() );
		// trigger WP Customize field change
		$input.change();
	}
});


}); // doc ready end
})(jQuery);
