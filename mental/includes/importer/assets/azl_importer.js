/*
 * Azelab Importer scripts
 */

jQuery(function($){

	var settings = {
		steps: [
			{action: 'azl_import_init', message: 'Preparing to import... '},
		]
	};

	var steps = [];

	var import_file = '';

	var $log_block = $('#azl_importer_log');

	function request() {
		if(steps.length == 0) return;

		$log_block.append(steps[0].message);

		var post_data = {action: steps[0].action, import_file: import_file};

		if(steps[0].post_data != undefined)
			post_data = $.extend(post_data, steps[0].post_data);

		$.ajax({
			url: ajaxurl,
			type: 'post',
			data: post_data,
			dataType: 'json',
			success: function(result) {
				$log_block.append(result.msg + ' ('+ result.import_msgs +' )' +'\n');
				if(result.result == 'ok') {
					steps.shift();
					if(result.steps != undefined) steps.push.apply(steps, result.steps);
					request();
				}
			},
			error: function(result)
			{
				$log_block.append('Some error occured! ' + result.msg + '\n');
			}
		});
	}

	$('#azl_import_start').click(function(e){
		e.preventDefault();
		if( ! confirm('Are you sure?')) return false;
		steps = settings.steps.slice(0);
		import_file = $('#azl_importer_import_file').val();
		request();
	});

});