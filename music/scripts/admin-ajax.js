jQuery(document).ready(function(){
	jQuery('.image_upload_button').each(function(){
			
		var clickedObject = jQuery(this);
		var clickedID = jQuery(this).attr('id');	
		new AjaxUpload(clickedID, {
			action: ajax_url,
			name: clickedID, // File upload name
			data: { // Additional data to send
				action: 'ntl_post_action',
				type: 'upload',
				data: clickedID 
			},
			autoSubmit: true, // Submit file after selection
			responseType: false,
			onChange: function(file, extension){},
			onSubmit: function(file, extension){
				clickedObject.text('Uploading'); // change button text, when user selects file	
				this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
				interval = window.setInterval(function(){
					var text = clickedObject.text();
					if (text.length < 13){	clickedObject.text(text + '.'); }
					else { clickedObject.text('Uploading'); } 
				}, 200);
			},
				
			onComplete: function(file, response) {
				   
				window.clearInterval(interval);
				clickedObject.text('Upload Image');	
				this.enable(); // enable upload button
					
				// If there was an error
				if(response.search('Upload Error') > -1){
					var buildReturn = '<span class="upload-error">' + response + '</span>';
					jQuery(".upload-error").remove();
					clickedObject.parent().after(buildReturn);					
				}
				else{
					var buildReturn = '<img '+response+' />';
					jQuery(".upload-error").remove();
					jQuery("#image_" + clickedID).remove();	
					clickedObject.parent().after(buildReturn);
					jQuery('img.reset_hide').fadeIn();
					var strmess = jQuery('img#image_'+clickedID).attr('src'); 
					clickedObject.next('span').fadeIn();
					clickedObject.closest('td').find('input').val(strmess);
				}
			}
		});
			
	});
			
			
	//AJAX Remove (clear option value)
	jQuery('.image_reset_button').click(function(){
			
		var clickedObject = jQuery(this);
		var clickedID = jQuery(this).attr('id');
		var theID = jQuery(this).attr('title');					
		var data = {
			action: 'ntl_post_action',
			type: 'image_reset',
			data: theID
		};					
		jQuery.post(ajax_url, data, function(response) {
			var image_to_remove = jQuery('#image_nets_themelogo');
			var button_to_hide = jQuery('.image_reset_button');
			image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
			button_to_hide.fadeOut();					
		});					
		return false; 					
	}); 
	
	jQuery('.fontpreview').click(function(){
		var theshow = jQuery(this).find('.fontshow');
		var thedata = theshow.attr('rel');
		jQuery('.fontshow:visible').fadeOut('slow');
		theshow.css('display','block');
		var data = {
			action: 'ntl_post_action',
			type: 'get_googleapi',
			data: thedata
		};
		jQuery.post(ajax_url, data, function(response) {
			theshow.find('.apiinner').html(response);
		});	
		
	});
	
	jQuery('.popclose').click(function(){
		var theshow = jQuery(this).parents('.fontshow');
		theshow.fadeOut('slow');
	});
	
	
	jQuery('.butoff').live('click', function() {
		
		var clickedid = jQuery(this);
		
		var clickedparent = clickedid.closest('.lefterinner');
		
		var elem = clickedparent.children('.optionbut');
			
		elem.addClass('butoff');
		
		clickedid.toggleClass('butoff');
		
		var value = clickedid.attr('rel');
		
		clickedparent.find('#setinputvalue').val(value);
			
		
	});
	
	jQuery('.fontprim').live('click', function() {
		
		var clickedid = jQuery(this);
		
		var clickedparent = clickedid.closest('.lefterinner');
		
		jQuery('.fontprim').each(function() {
			jQuery(this).removeClass('fontselected');
		});
		
		clickedid.toggleClass('fontselected');
		
		var value = clickedid.attr('rel');
		
		clickedparent.find('#setinputvalueprim').val(value);
			
		
	});
	
	jQuery('.fontsec').live('click', function() {
		
		var clickedid = jQuery(this);
		
		var clickedparent = clickedid.closest('.lefterinner');
		
		jQuery('.fontsec').each(function() {
			jQuery(this).removeClass('fontselected');
		});
		
		clickedid.toggleClass('fontselected');
		
		var value = clickedid.attr('rel');
		
		clickedparent.find('#setinputvaluesec').val(value);
			
		
	});
			
});			
	