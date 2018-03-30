jQuery(function(){
	jQuery('.datepicker_display').each(function(){
		jQuery(this).datepicker({
			altField:jQuery(this).data('target'),
			altFormat:"yymmdd"
		}).keyup(function(e){
			if (e.keyCode == 8 || e.keyCode == 46) {
				jQuery.datepicker._clearDate(this);
				jQuery(jQuery(this).data('target')).attr('value', '');
			}
				});
	})
});
