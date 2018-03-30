jQuery(function () {
	jQuery('.redux-opts-checkbox-hide-group').each(function () {
		var list = jQuery(document).find('[data-enabled-by=' + jQuery(this).attr('id') + ']').parents('tr');
		if (!jQuery(this).is(':checked')) {
			list.hide();
		}
		jQuery(this).on('click', function () {
			list.fadeToggle('slow');
		});
	});
});


