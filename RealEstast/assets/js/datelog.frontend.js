jQuery(function($){
	function apply_datepicker_to_datelog() {
		jQuery('.dp').each(function() {
			var that = this;
			$(this).datepicker({
				dateFormat: 'yy/mm/dd',
				altField: '#' + $(that).data('target'),
				altFormat: 'yymmdd'
			});
		});
	}

	apply_datepicker_to_datelog();
});