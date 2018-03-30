/**
 *	Goodlayers Image Picker File
 *	---------------------------------------------------------------------
 * 	@version	1.0
 * 	@author		Goodlayers
 * 	@link		http://goodlayers.com
 * 	@copyright	Copyright (c) Goodlayers
 * 	---------------------------------------------------------------------
 * 	This file contains the jQuery script for slider image chooser
 *	---------------------------------------------------------------------
 */
 
jQuery(document).ready(function(){ 	

	// Decide to show select-image-none element for each image chooser
	jQuery('.image-picker').each(function(){
		if(jQuery(this).find('#selected-image ul').children().size() > 1 ){
			jQuery(this).find('#selected-image-none').css('display','none');
		}
	});
	
	// Bind the edit and delete image button
	jQuery('.edit-image').click(function(){
		jQuery(this).parents('li').find('#slider-detail-wrapper').fadeIn();
	});
	jQuery('.gdl-button#gdl-detail-edit-done').click(function(){
		jQuery(this).parents('#slider-detail-wrapper').fadeOut();
	});
	jQuery('.unpick-image').click(function(){
		jQuery(this).bindImagePickerUnpick();
	});
	jQuery.fn.bindImagePickerUnpick = function(){
		var deleted_image = jQuery(this);
	
		jQuery.confirm({
			'message'	: 'Are you sure to do this?',
			'buttons'	: {
				'Delete'	: {
					'class'	: 'confirm-yes',
					'action': function(){
						deleted_image.parents('li').slideUp('200',function(){
							jQuery(this).remove();
						});
						if ( deleted_image.parents('#image-picker').find('#selected-image ul').children().size() == 2 ){
							deleted_image.parents('#image-picker').find('#selected-image-none').slideDown();
						}
						deleted_image.parents('#image-picker').find('input#slider-num').attr('value',function(){
							return parseInt(jQuery(this).attr('value')) - 1;
						});
					}
				},
				'Cancel'	: {
					'class'	: 'confirm-no',
					'action': function(){ return false; }
				}
			}
		});
	};
	
	// Bind the navigation bar and call server using ajax to get the media for each page
	jQuery('div.selected-image ul').sortable({ tolerance: 'pointer', forcePlaceholderSize: true, placeholder: 'slider-placeholder', cancel: '.slider-detail-wrapper' });
	jQuery('.media-gallery-nav ul a li').click(function(){
		jQuery(this).bindImagePickerClickPage();
	});
	jQuery.fn.bindImagePickerClickPage = function(){
		var image_picker = jQuery(this).parents('#image-picker');
		var current_gallery = image_picker.find('#media-image-gallery');
		var paged = jQuery(this).attr('rel');
		current_gallery.slideUp('200');
		image_picker.find('#show-media-text').html('Loading');
		image_picker.find('#show-media-image').addClass('loading-media-image');
		jQuery.post(ajaxurl,{ action:'get_media_image', page: paged },function(data){
			paged='';
			current_gallery.html(data);
			current_gallery.find('ul li img').bind('click',function(){
				jQuery(this).bindImagePickerChooseItem();
			});
			current_gallery.find('#media-gallery-nav ul a li').bind('click',function(){
				jQuery(this).bindImagePickerClickPage();
			});
			current_gallery.slideDown('200');
			image_picker.find('#show-media-text').html('');
			image_picker.find('#show-media-image').removeClass();
		});
	}
	
	// Bind the image when user choose item
	jQuery('.image-picker').find('#media-image-gallery').find('ul li img').click(function(){
		jQuery(this).bindImagePickerChooseItem();
	});
	jQuery.fn.bindImagePickerChooseItem = function(){
		var clone = jQuery(this).parents('#image-picker').find('#default').clone(true);
		clone.find('input, textarea, select').attr('name',function(){
			return jQuery(this).attr('id') + '[]';
		});
		clone.attr('id','slider-image-init');
		clone.attr('class','slider-image-init');
		clone.css('display','none');
		clone.find('.slider-image-url').attr('value', jQuery(this).attr('attid')); 
		clone.find('img').attr('src',jQuery(this).attr('rel')); 
		clone.find('img').attr('rel', jQuery(this).attr('rel')); 
		jQuery(this).parents('#image-picker').find('#selected-image-none').slideUp();
		jQuery(this).parents('#image-picker').find('#selected-image ul').append(clone);
		jQuery(this).parents('#image-picker').find('#selected-image ul li').not('#default').slideDown('200');
		jQuery(this).parents('#image-picker').find('input#slider-num').attr('value',function(){
			return parseInt(jQuery(this).attr('value')) + 1;
		});
	}
	
});
