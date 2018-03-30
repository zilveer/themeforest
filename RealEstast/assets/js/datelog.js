jQuery(function($) {
	var $datelog_tbl = $('#datelog_tbl');

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

	$(document).on('click', '.dl_rm', function(e) {
		e.preventDefault();

		$(this).parents('tr').remove();
	});



	$('#btn_datelog_add').on('click', function(event) {
		var current_num = $datelog_tbl.find('tr').length - 1;
		var $new_row = $('<tr></tr>');

		var $from_date = $('<td><label for="dp_from_' + current_num + '" >From</label><input type = "text"	class= "dp" data-target="storage_dp_from_' + current_num + '" /><input type="hidden" name="datelog[' + current_num + '][from]" id="storage_dp_from_' + current_num + '" /> </td>');
		var $to_date = $('<td><label for="dp_to_' + current_num + '">To </label ><input type = "text"	class= "dp" data-target="storage_dp_to_' + current_num + '" /><input type="hidden" name="datelog[' + current_num + '][to]" id="storage_dp_to_' + current_num + '" /> </td>');
		var $remove = $('<td><a href="#" class="dl_rm">Remove</a > </td>');
		$new_row.append($from_date).append($to_date).append($remove);
		$datelog_tbl.append($new_row);

		apply_datepicker_to_datelog();
	});

	apply_datepicker_to_datelog();
});