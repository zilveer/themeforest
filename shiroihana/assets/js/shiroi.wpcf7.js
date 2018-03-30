!function($) {

	if( ! $.fn.wpcf7InitForm ) {
		return;
	}

	var old_wpcf7InitForm = $.fn.wpcf7InitForm;
	$.fn.wpcf7InitForm = function() {
		// Move the response output to the top of the form
		var $responseOutput = $(this).find('div.wpcf7-response-output');
		$responseOutput.insertBefore( 
			$responseOutput.closest( '.wpcf7-form' ).children(':visible').first() );

		old_wpcf7InitForm.apply( this, arguments );
	};

	var old_wpcf7AjaxSuccess = $.wpcf7AjaxSuccess;
	$.wpcf7AjaxSuccess = function(data, status, xhr, $form) {
		if (! $.isPlainObject(data) || $.isEmptyObject(data))
			return;

		old_wpcf7AjaxSuccess.apply( this, arguments );

		// Remove Bootstrap .has-error class
		$form.find('.has-error').removeClass('has-error');

		if (data.invalids) {
			$.each(data.invalids, function(i, n) {
				// Bootstrap .has-error class
				$form.find(n.into).addClass('has-error');
			});
		}
	}

	$.fn.wpcf7Placeholder = function() {
		// Remove placeholder plugin
		return this;
	};

	var old_wpcf7NotValidTip = $.fn.wpcf7NotValidTip;
	$.fn.wpcf7NotValidTip = function(message) {
		old_wpcf7NotValidTip.apply( this, arguments );
		return this.each(function() {
			$(this).find('span.wpcf7-not-valid-tip').addClass('help-block');
		});
	};

}(jQuery);