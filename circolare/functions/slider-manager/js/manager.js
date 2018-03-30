jQuery(document).ready(function() {
	
	// calls appendo
	jQuery('#manager_form_wrap').appendo({
		allowDelete: false,
		labelAdd: 'Add New Slide',
		subSelect: 'li.slide:last'
	});
	
	// slide delete button
	jQuery('#manager_form_wrap li.slide .remove_slide').live('click', function() {
		if(jQuery('#manager_form_wrap li.slide').size() == 1) {
			alert('Sorry, you need at least one slide');	
		}
		else {
			jQuery(this).parent().slideUp(300, function() {
				jQuery(this).remove();	
			})	
		}
		return false;
	});
	
	// jQuery UI sortable
	jQuery("#manager_form_wrap").sortable({
			placeholder: 'slide-highlight'
	});

	
});