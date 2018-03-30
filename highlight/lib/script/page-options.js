/**
 * This is the JS file for the page add/edit section
 * 
 * Author: Pexeto http://pexeto.com/
 */

var pexetoPageOptions={
	
	/**
	 * Loads the names of the sliders that correspond to the selected slider only.
	 */
	loadSelectedSliderNames:function(){
	//load the slider names with the initial page load
	var savedClass=jQuery('#slider_value').find('option:selected').attr('class');
	if(savedClass!=''){
		jQuery('#slider_name_value option').not('.'+savedClass).hide();
		if(!jQuery('#slider_name_value option.'+savedClass).length){
			//disable the drop down if no slider names correspond to the selected option
			jQuery('#slider_name_value').attr('disabled', 'disabled');
		}
	}
	
	//load the slider names when the slider type has been changed
	jQuery('#slider_value').change(function(){
		
		var selectedClass=jQuery(this).find('option:selected').attr('class'), 
		selectedOptions=jQuery('#slider_name_value option.'+selectedClass);
		
		if(selectedOptions.length){
			//enable the drop down if disabled
			jQuery('#slider_name_value').removeAttr('disabled');
			selectedOptions.show();
			jQuery('#slider_name_value option').not('.'+selectedClass).removeAttr('selected').hide();
		}else{
			//disable the drop down if no slider names correspond to the selected option
			jQuery('#slider_name_value').attr('disabled', 'disabled');
		}
		
	});
	}
};

jQuery(function(){
	pexetoPageOptions.loadSelectedSliderNames();
});


