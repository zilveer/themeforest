    jQuery(document).ready(function(){
		jQuery('#current_sidebar li a.sidebar_del').click(function(){
			if(confirm('Are you sure you want to delete this sidebar? (this can not be undone)'))
			{
				sTarget = jQuery(this).attr('href');
				sSidebar = jQuery(this).attr('rel');
				objTarget = jQuery(this).parent('li');
				
				jQuery.ajax({
  		    		type: 'POST',
  		    		url: sTarget,
  		    		data: 'sidebar_id='+sSidebar,
  		    		success: function(msg){ 
  		    			objTarget.fadeOut();
  		    		}
		    	});
			}
			
			return false;
		});
		
		jQuery('a.image_del').click(function(){
			if(confirm('Are you sure you want to delete this image? (this can not be undone)'))
			{
				sTarget = jQuery(this).attr('href');
				sFieldId = jQuery(this).attr('rel');
				objTarget = jQuery('#'+sFieldId+'_wrapper');
				
				jQuery.ajax({
  		    		type: 'POST',
  		    		url: sTarget,
  		    		data: 'field_id='+sFieldId,
  		    		success: function(msg){ 
  		    			objTarget.fadeOut();
  		    		}
		    	});
			}
			
			return false;
		});
		
		jQuery('#current_sidebar li a.sidebar_del').click(function(){
			if(confirm('Are you sure you want to delete this sidebar? (this can not be undone)'))
			{
				sTarget = jQuery(this).attr('href');
				sSidebar = jQuery(this).attr('rel');
				objTarget = jQuery(this).parent('li');
				
				jQuery.ajax({
  		    		type: 'POST',
  		    		url: sTarget,
  		    		data: 'sidebar_id='+sSidebar,
  		    		success: function(msg){ 
  		    			objTarget.fadeOut();
  		    		}
		    	});
			}
			
			return false;
		});
		
		jQuery('#pp_advance_clear_cache').click(function(){
			if(confirm('Are you sure you want to clear all cache'))
			{
				sTarget = jQuery(this).attr('href');
				
				jQuery.ajax({
  		    		type: 'POST',
  		    		url: sTarget,
  		    		data: 'method=clear_cache',
  		    		success: function(msg){ 
  		    			jQuery('#pp_advance_clear_cache').html('Successfully cleared. Click here to clear cache files again');
  		    		}
		    	});
			}
			
			return false;
		});
		
		jQuery('#pp_panel a').click(function(){
			jQuery('#pp_panel a').removeClass('nav-tab-active');
			jQuery(this).addClass('nav-tab-active');
			
			jQuery('.rm_section').css('display', 'none');
			jQuery(jQuery(this).attr('href')).css('display', 'block');
			jQuery('#current_tab').val(jQuery(this).attr('href'));
			
			return false;
		});
		
		jQuery('.color_picker').each(function()
		{	
			var inputID = jQuery(this).attr('id');
			
			jQuery(this).ColorPicker({
				color: jQuery(this).val(),
				onShow: function (colpkr) {
					jQuery(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					jQuery(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb, el) {
					jQuery('#'+inputID).val('#' + hex);
					jQuery('#'+inputID+'_bg').css('backgroundColor', '#' + hex);
				}
			});	
			
			jQuery(this).css('visibility', 'hidden');
		});
		
		jQuery('.iphone_checkboxes').iphoneStyle({
  			checkedLabel: 'YES',
  			uncheckedLabel: 'NO'
		});
		
		jQuery('.rm_section').css('display', 'none');
		
		if(self.document.location.hash == '')
		{
			jQuery('#pp_panel_general_a').click();
		}
		else
		{
			jQuery(self.document.location.hash+'_a').trigger('click');
		}
		
		jQuery( ".pp_sortable" ).sortable({
			placeholder: "ui-state-highlight",
			create: function(event, ui) { 
				myCheckRel = jQuery(this).attr('rel');
			
				var order = jQuery(this).sortable('toArray');
            	jQuery('#'+myCheckRel).val(order);
			},
			update: function(event, ui) {
				myCheckRel = jQuery(this).attr('rel');
			
				var order = jQuery(this).sortable('toArray');
            	jQuery('#'+myCheckRel).val(order);
			}
		});
		jQuery( ".pp_sortable" ).disableSelection();
		
		jQuery(".pp_checkbox input").change(function(){
			myCheckId = jQuery(this).val();
			myCheckRel = jQuery(this).attr('rel');
			myCheckTitle = jQuery(this).attr('alt');
			
			if (jQuery(this).is(':checked')) { 
				jQuery('#'+myCheckRel).append('<li id="'+myCheckId+'_sort" class="ui-state-default">'+myCheckTitle+'</li>');
			} 
			else
			{
				jQuery('#'+myCheckId+'_sort').remove();
			}

			var order = jQuery('#'+myCheckRel).sortable('toArray');

            jQuery('#'+myCheckRel+'_data').val(order);
		});
		
		jQuery("#pp_font").change(function(){
			jQuery("#pp_font_family").attr('value', jQuery("#pp_font option:selected").attr('data-family'));
		
			var ppCufonFont = 'http://fonts.googleapis.com/css?family='+jQuery(this).val();
			jQuery('#google_fonts-css').attr('href', ppCufonFont);
			
			if(jQuery("#pp_font option:selected").attr('data-family') != '')
			{
				jQuery('#pp_sample_text').css('font-family', '"'+jQuery("#pp_font option:selected").attr('data-family')+'"');
			}
			else
			{
				jQuery('#pp_sample_text').css('font-family', 'Gnuolane');
			}
		});
				
});