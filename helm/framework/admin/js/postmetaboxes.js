jQuery(document).ready(function($) {

	$("#theme-media-button").click(function(){ 
		$(".insert-media").trigger('click');
	});
	
	var sidebarlist;
	sidebarlist = $('.page_style img.of-radio-img-selected').attr("data-value");
	if (sidebarlist=="nosidebar") {
		$('.sidebar_choice').hide();
	}

	var videoembedcode;
	videoembedcode = $('.portfolio_header img.of-radio-img-selected').attr("data-value");

	if (videoembedcode!="Video") {
		$('.videoembed').hide();
	}

	var linkmethod;
	linkmethod = $('.thumbnail_linktype img.of-radio-img-selected').attr("data-value");

	if (linkmethod=="meta_thumbnail_direct") {
		$('.portfoliolinktype').hide();
	}

	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');

		if ( $(this).parent().hasClass('trigger_element') ) {
			var toggleClass=$(this).parent().find('span').attr("data-toggleClass");
			var toggleAction=$(this).parent().find('span').attr("data-toggleAction");
			var toggleTrigger=$(this).parent().find('span').attr("data-toggleTrigger");
			var SteppingStone=$(this).attr("data-value");

			if ( SteppingStone==toggleTrigger && toggleAction=="hide" && toggleAction!="show") {
				$(toggleClass).slideUp('fast');
			}
			if ( SteppingStone!=toggleTrigger && toggleAction=="hide" && toggleAction!="show") {
				$(toggleClass).slideDown('fast');
			}

			if ( SteppingStone==toggleTrigger && toggleAction=="show" && toggleAction!="hide" ) {
				$(toggleClass).slideDown('fast');
			}
			if ( SteppingStone!=toggleTrigger && toggleAction=="show" && toggleAction!="hide" ) {
				$(toggleClass).slideUp('fast');
			}
		}

		/**
		datavalue = $(".page_style img.of-radio-img-selected").attr("data-value");
		if (datavalue=="nosidebar") {
			$('.sidebar_choice').slideUp('fast');
		} else {
			$('.sidebar_choice').slideDown('fast');
		}
		**/
	});


	//jQuery( ".ranger-bar :text" ).slider();
	$('.ranger-bar :text').each(function(index) {
	                // get input ID
					var inputField = $(this);
	                var inputId = $(this).attr('id');
	                // get input value
	                var inputValue = parseInt($(this).val());
	                // get input max
	                var inputMin = parseInt($(this).attr('min'));
					var inputMax = parseInt($(this).attr('max'));

	                $('#'+inputId+'_slider').slider({
						range: "min",
	                    value: inputValue,
	                    max: inputMax,
	                    min: inputMin,
	                    slide: function(event, ui){

	                        $(inputField).val(ui.value);

	                    }
	                });
	            });
	
				$( ".ranger-bar :text" ).change(function() {
					var inputField = $(this);
					var inputId = $(this).attr('id');
					var inputMin = parseInt($(this).attr('min'));
					var inputMax = parseInt($(this).attr('max'));
					var inputValue = parseInt($(this).val());
					
					if (inputValue > inputMax ) { 
						inputValue=inputMax;
						$(inputField).val(inputValue);
					}
					if (inputValue < inputMin ) { 
						inputValue=inputMin;
						$(inputField).val(inputValue);
					}
				    $('#'+inputId+'_slider').slider( "value", inputValue );
				});
	

	jQuery(".selectbox select").each(function(){
	  jQuery(this).wrap('<div class="selectbox"/>');
		jQuery(this).after("<span class='selecttext'></span><span class='select-arrow'></span>");
		var val = jQuery(this).children("option:selected").text();
		jQuery(this).next(".selecttext").text(val);
		jQuery(this).change(function(){
			var val = jQuery(this).children("option:selected").text();
			jQuery(this).next(".selecttext").text(val);
		});
	});

	var imageWrapper = jQuery('#image-meta-box');
	var linkWrapper = jQuery('#link-meta-box');
	var videoWrapper = jQuery('#video-meta-box');
	var quoteWrapper = jQuery('#quote-meta-box');
	var audioWrapper = jQuery('#audio-meta-box');
	var videoWrapper = jQuery('#video-meta-box');
	var galleryWrapper = jQuery('#gallery-meta-box');
	
	var imageSelector = jQuery('#post-format-image');
	var audioSelector = jQuery('#post-format-audio');
	var quoteSelector = jQuery('#post-format-quote');
	var linkSelector = jQuery('#post-format-link');
	var videoSelector = jQuery('#post-format-video');
	var gallerySelector = jQuery('#post-format-gallery');
	
	
	hideAll();
	showCheckedChoice();

	var postmetaChoice = jQuery('#post-formats-select input');
	
	postmetaChoice.change( function() {
	
		var thisElement = jQuery(this).val();

		switch ( thisElement ) {

			case 'quote' :
			quoteWrapper.css('display', 'block');
			DisplaySelected(quoteWrapper);
			break;
			
			case 'gallery' :
			galleryWrapper.css('display', 'block');
			DisplaySelected(galleryWrapper);
			break;

			case 'video' :
			videoWrapper.css('display', 'block');
			DisplaySelected(videoWrapper);
			break;

			case 'link' :
			linkWrapper.css('display', 'block');
			DisplaySelected(linkWrapper);
			break;	
			
			case 'image' :
			imageWrapper.css('display', 'block');
			DisplaySelected(imageWrapper);
			break;
			
			case 'audio' :
			audioWrapper.css('display', 'block');
			DisplaySelected(audioWrapper);
			break;
			
			default :
			quoteWrapper.css('display', 'none');
			galleryWrapper.css('display', 'none');
			videoWrapper.css('display', 'none');
			linkWrapper.css('display', 'none');
			audioWrapper.css('display', 'none');
			imageWrapper.css('display', 'none');

		}
		
	});


	var postmetaWP36 = jQuery('.post-format-options a');
	
	postmetaWP36.click( function() {
	
		var thisElement = jQuery(this).data('wp-format');

		switch ( thisElement ) {

			case 'quote' :
			quoteWrapper.css('display', 'block');
			DisplaySelected(quoteWrapper);
			break;
			
			case 'gallery' :
			galleryWrapper.css('display', 'block');
			DisplaySelected(galleryWrapper);
			break;

			case 'video' :
			videoWrapper.css('display', 'block');
			DisplaySelected(videoWrapper);
			break;

			case 'link' :
			linkWrapper.css('display', 'block');
			DisplaySelected(linkWrapper);
			break;	
			
			case 'image' :
			imageWrapper.css('display', 'block');
			DisplaySelected(imageWrapper);
			break;
			
			case 'audio' :
			audioWrapper.css('display', 'block');
			DisplaySelected(audioWrapper);
			break;
			
			default :
			quoteWrapper.css('display', 'none');
			galleryWrapper.css('display', 'none');
			videoWrapper.css('display', 'none');
			linkWrapper.css('display', 'none');
			audioWrapper.css('display', 'none');
			imageWrapper.css('display', 'none');

		}
		
	});
		
	function DisplaySelected(elementSelected) {
		hideAll();
		elementSelected.css('display', 'block');
	}
	
	function hideAll() {
		videoWrapper.css('display', 'none');
		galleryWrapper.css('display', 'none');
		quoteWrapper.css('display', 'none');
		linkWrapper.css('display', 'none');
		audioWrapper.css('display', 'none');
		imageWrapper.css('display', 'none');	
	}
	
	function showCheckedChoice() {
	
		if(quoteSelector.is(':checked')) {
			quoteWrapper.css('display', 'block');
		}
			
		if(linkSelector.is(':checked')) {
			linkWrapper.css('display', 'block');
		}
		
		if(audioSelector.is(':checked')) {
			audioWrapper.css('display', 'block');
		}
		
		if(gallerySelector.is(':checked')) {
			galleryWrapper.css('display', 'block');
		}
		
		if(videoSelector.is(':checked')) {
			videoWrapper.css('display', 'block');
		}
			
		if(imageSelector.is(':checked')) {
			imageWrapper.css('display', 'block');
		}


		var selectedElement = jQuery('.post-format-options .active').data('wp-format');
		//console.log(selectedElement);
		if (typeof selectedElement != 'undefined') {
			switch ( selectedElement ) {
				case 'quote' :
				quoteWrapper.css('display', 'block');
				DisplaySelected(quoteWrapper);
				break;
				
				case 'gallery' :
				galleryWrapper.css('display', 'block');
				DisplaySelected(galleryWrapper);
				break;

				case 'video' :
				videoWrapper.css('display', 'block');
				DisplaySelected(videoWrapper);
				break;

				case 'link' :
				linkWrapper.css('display', 'block');
				DisplaySelected(linkWrapper);
				break;	
				
				case 'image' :
				imageWrapper.css('display', 'block');
				DisplaySelected(imageWrapper);
				break;
				
				case 'audio' :
				audioWrapper.css('display', 'block');
				DisplaySelected(audioWrapper);
				break;
				
				default :
				quoteWrapper.css('display', 'none');
				galleryWrapper.css('display', 'none');
				videoWrapper.css('display', 'none');
				linkWrapper.css('display', 'none');
				audioWrapper.css('display', 'none');
				imageWrapper.css('display', 'none');

			}
		}
			
	}
});