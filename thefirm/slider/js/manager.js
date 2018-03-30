jQuery(document).ready(function($) {
	
	// calls appendo
	$('#manager_form_wrap').appendo({
		allowDelete: false,
		labelAdd: 'Add New Image',
		subSelect: 'li.slide:last'
	});
	
	// slide delete button
	$('#manager_form_wrap li.slide .remove_slide').live('click', function() {
		if($('#manager_form_wrap li.slide').size() == 1) {
			alert('Sorry, you need at least one image');	
		}
		else {
			$(this).parent().slideUp(300, function() {
				$(this).remove();	
			})	
		}
		return false;
	});
	
	// jQuery UI sortable
	$("#manager_form_wrap").sortable({
			placeholder: 'slide-highlight'
	});
	
});