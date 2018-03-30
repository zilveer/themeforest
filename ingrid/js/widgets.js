//WIDGETS - option to remove them

jQuery(document).ready(function() {

	
	jQuery('[id^=ub_wa_]').each(function(){		
		var html = jQuery(this).find('.description').html();
		jQuery(this).find('.description').html(html+'<br /><br /><a href="widgets.php?remove_w_a='+jQuery(this).attr('id')+'">Click here to remove this area</a>');
	});

	
});