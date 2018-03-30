jQuery(document).ready(function () {

	jQuery('.datepicker-me').each(function(){
		var dateName = jQuery(this).attr('name');
		dateName = dateName.split('_visual');
		dateName = dateName[0];
		var thisDate = jQuery(this).val();
		var dat = Date.parse(thisDate);
		var theDate = new Date(dat);
		var timestamp = Math.round(theDate.getTime());
		jQuery('input[name='+dateName+']').val(timestamp);
	});

	if (jQuery('.datepicker-me').length > 0) {
		jQuery('.datepicker-me').datetimepicker({
			ampm: true,
			timeFormat: 'h:mm tt',
			hour: 8,
			minute: 0,
			onSelect: function(dateText, inst){
			
				var dat = Date.parse(dateText);
				var theDate = new Date(dat);
				var timestamp = Math.round(theDate.getTime());
				
				var dateName = jQuery(this).attr('name');
				dateName = dateName.split('_visual');
				dateName = dateName[0];
				
				jQuery('input[name='+dateName+']').val(timestamp);
				
			}
		});
	}
});