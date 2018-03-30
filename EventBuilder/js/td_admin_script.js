/*-----------------------------------------------------------------------------------*/
/*	Custom Script
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function($) {

	//ADD
	$('#day-program-criterion').hide();
	$('#submit-day-program-item').on('click', function() {		
		$newItem = $('#day-program-criterion .option-item').clone().appendTo('#day-program').show();
		if ($newItem.prev('.option-item').size() == 1) {
			var id = parseInt($newItem.prev('.option-item').attr('id')) + 1;
		} else {
			var id = 0;	
		}
		$newItem.attr('id', id);

		var criterionText = 'Program Item ' + (id+1);
		$newItem.children('span:eq(0)').text(criterionText);

		var nameText = 'day-program[' + id + '][0]';
		$newItem.find('.full-criteria-hour .criteria-hour').attr('id', nameText).attr('name', nameText);

		var nameText = 'day-program[' + id + '][1]';
		$newItem.find('.full-criteria-name .criteria-name').attr('id', nameText).attr('name', nameText);

		var nameText = 'day-program[' + id + '][2]';
		$newItem.find('.full-criteria-desc .criteria-desc').attr('id', nameText).attr('name', nameText);

		//event handler for newly created element
		$newItem.children('.delete-submit-day-program-item').on('click', function () {
			$(this).parent('.option-item').remove();
		});

	});
	
	//DELETE
	$('.delete-submit-day-program-item').on('click', function() {
		$(this).parent('.option-item').remove();
	});


	// ADD Property Review
	$('#template_criterion').hide();
	$('#submit_add_criteria').on('click', function() {		
		$newItem = $('#template_criterion .option_item').clone().appendTo('#review_criteria').show();
		if ($newItem.prev('.option_item').size() == 1) {
			var id = parseInt($newItem.prev('.option_item').attr('id')) + 1;
		} else {
			var id = 0;	
		}
		$newItem.attr('id', id);

		var criterionText = 'Criterion ' + (id+1);
		$newItem.children('span:eq(0)').text(criterionText);

		var nameText = 'property_review_option[' + id + '][0]';
		$newItem.children('.criteria_name').attr('id', nameText).attr('name', nameText);

		var sliderValue = 'property_review_option['+ id +'][1]';
		$newItem.children('.slider_value').attr('id', sliderValue).attr('name', sliderValue);
		
		var criterionText = 'Color (ex: #ff0000) ' + (id+1);
		$newItem.children('span:eq(2)').text(criterionText);

		var nameText = 'property_review_option[' + id + '][2]';
		$newItem.children('.criteria_color').attr('id', nameText).attr('name', nameText);

		//event handler for newly created element
		$newItem.children('.button_del_criteria').on('click', function () {
			$(this).parent('.option_item').remove();
		});

		//activate slider
		$newItem.children('.rating_slider').slider({
			range: 'max',
			min: 1,
		    max: 5,
		    value: 5,
			slide: function (e, ui) {
				var rating_value = $(this).slider('option','value');
				$(this).next(".slider_value").val( ui.value );
			}
		});
		$newItem.children('.slider_value').val( 5 );
	});
	
	//DELETE
	$('.button_del_criteria').on('click', function() {
		$(this).parent('.option_item').remove();
	});
	
	
	//event handler for newly created element
	$('.button_update_overal_rating').on('click', function () {
		var sum = 0;
		var totalID = -1;
		$('input.slider_value').each(function() {
			sum += Number($(this).val());
			totalID += 1;
		});
				
		var review_overal_sum = sum/totalID;
		var new_review_overal_sum = review_overal_sum.toFixed(1);
		$('#review-result').attr('value', new_review_overal_sum);
	});

	//RATING SLIDER NEW
	$rating_slider = jQuery(".rating_slider");
	$rating_slider.slider({
		range: 'max',
		min: 1,
	    max: 5,
		create: function (e, ui) {
				var start_value = jQuery(this).next('.slider_value').attr('value');
				jQuery(this).slider('option','value', start_value);
			},
		slide: function (e, ui) {
			var rating_value = $(this).slider('option','value');
			$(this).next(".slider_value").val( ui.value );
		}
	});

	// User avatar
	var file_frame;
 
  	$('.additional-user-image').on('click', function( event ){
 
	    event.preventDefault();
	 
	    // If the media frame already exists, reopen it.
	    if ( file_frame ) {
	      	file_frame.open();
	      	return;
	    }
	 
	    // Create the media frame.
	    file_frame = wp.media.frames.file_frame = wp.media({
	      	title: $( this ).data( 'uploader_title' ),
	      	button: {
	        	text: $( this ).data( 'uploader_button_text' ),
	      	},
	      	multiple: false  // Set to true to allow multiple files to be selected
	    });
	 
	    // When an image is selected, run a callback.
	    file_frame.on( 'select', function() {
	      	// We set multiple to false so only get one image from the uploader
	      	attachment = file_frame.state().get('selection').first().toJSON();
	 
	      	// Do something with attachment.id and/or attachment.url here
	      	var url = '';
            url = attachment['url'];
            jQuery('#user_meta_image').val(url);
            jQuery( "img#your_image_url_img" ).attr({
                src: url
            });
	    });
	 
	    // Finally, open the modal
	    file_frame.open();

  	});

	/* Grab our vars ---------------------------------------------------------------*/
	var linkOptions = $('#themesdojo-metabox-post-link'),
    	linkTrigger = $('#post-format-link'),
    	quoteOptions = $('#themesdojo-metabox-post-quote'),
    	quoteTrigger = $('#post-format-quote'),
    	audioOptions = $('#themesdojo-metabox-post-audio'),
    	audioTrigger = $('#post-format-audio'),
    	videoOptions = $('#themesdojo-metabox-post-video'),
    	videoTrigger = $('#post-format-video'),
    	quoteOptions = $('#themesdojo-metabox-post-quote'),
    	quoteTrigger = $('#post-format-quote'),
    	group = jQuery('#post-formats-select input');

    /* Hide and show sections as needed --------------------------------------------*/
    themesdojoHideAll(null);	
	
	group.change( function() {
		themesdojoHideAll(null);		
		
		if($(this).val() == 'link') {
			linkOptions.css('display', 'block');
		} else if($(this).val() == 'audio') {
			audioOptions.css('display', 'block');
		} else if($(this).val() == 'video') {
			videoOptions.css('display', 'block');
		} else if($(this).val() == 'quote') {
			quoteOptions.css('display', 'block');
		}
	});
		
	if(linkTrigger.is(':checked'))
		linkOptions.css('display', 'block');
		
	if(audioTrigger.is(':checked'))
		audioOptions.css('display', 'block');
		
	if(videoTrigger.is(':checked'))
		videoOptions.css('display', 'block');
	if(quoteTrigger.is(':checked'))
		quoteOptions.css('display', 'block');
		
    function themesdojoHideAll(notThisOne) {
		videoOptions.css('display', 'none');
		linkOptions.css('display', 'none');
		audioOptions.css('display', 'none');
		quoteOptions.css('display', 'none');
    }

    $("#event_start_time").timePicker({
		show24Hours: false,
		separator: ':',
		step: 30
	});

	$("#event_end_time").timePicker({
		show24Hours: false,
		separator: ':',
		step: 30
	});

});