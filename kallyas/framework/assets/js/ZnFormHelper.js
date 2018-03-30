(function($){
	"use strict";

	$.ZnFormHelper = function(){};

	$.ZnFormHelper.prototype = {

		get_form_values : function(scope)
		{
			var $inputs = $(':input',scope);
			var values = {};
			$inputs.each(function() {
				if( $(this).hasClass( 'zn_group_options_container' ) ) {
					values[this.name] = jQuery.parseJSON( $(this).val() );
				}
				else{
					values[this.name] = $(this).val();
				}
			});

			var new_data = values;

			//console.log( new_data );

			return new_data;
		}
	}
})(jQuery);
