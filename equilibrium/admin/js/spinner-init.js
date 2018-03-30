jQuery().ready(function($) {
	var initSpinner = function() {
	$('input[type=number]').each(function() {
		var $input = $(this);
		$input.spinner({
			min: $input.attr('min'),
			max: $input.attr('max'),
			step: $input.attr('step')
		});
	});
};

if(!Modernizr.inputtypes.number){
	$(document).ready(initSpinner);
};
});	