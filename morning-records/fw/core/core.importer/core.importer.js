// Morning records Importer script

jQuery(document).ready(function(){
	"use strict";

	// Start import
	jQuery('.trx_importer_section').on('click', '.trx_buttons input[type="button"]', function() {
		"use strict";
		var last_id = jQuery(this).data('last_id');
		if (!last_id) last_id = 0;
		var last_slider = jQuery(this).data('last_slider');
		if (!last_slider) last_slider = 0;
		var steps = [];
		var clear_tables = '';
		var demo_type = jQuery('#trx_importer_form [name="demo_type"]:checked').val();
		jQuery(this).parents('form').find('input[type="checkbox"]').each(function() {
			"use strict";
			var name = jQuery(this).attr('name');
			if (jQuery(this).get(0).checked) {
				clear_tables += (clear_tables ? ',' : '') + name.substr(7); // Remove 'import_' from name - save only slug into var clear_tables
				var step = {
					action: name,
					data: {
						demo_type: demo_type
					}
				};
				if (name=='import_posts') {
					step.data['last_id'] = last_id;
				}
				steps.push(step);
			} else
				jQuery('#trx_importer_progress .'+name).hide();
		});
		steps.unshift({
			action: 'import_start',
			data: { 
				clear_tables: clear_tables,
				demo_type: demo_type
			}
		});
		steps.push({
			action: 'import_end',
			data: { 
				demo_type: demo_type
			}
		});
		// Start import
		jQuery('#trx_importer_form').hide();
		jQuery('#trx_importer_progress').fadeIn();
		MORNING_RECORDS_STORAGE['importer_error_messages'] = '';
		MORNING_RECORDS_STORAGE['importer_ignore_errors'] = true;
		morning_records_importer_do_action(steps, 0);
	});
});

// Call specified action (step)
function morning_records_importer_do_action(steps, idx) {
	"use strict";
	if ( !jQuery('#trx_importer_progress .'+steps[idx].action+' .import_progress_status').hasClass('step_in_progress') )
		jQuery('#trx_importer_progress .'+steps[idx].action+' .import_progress_status').addClass('step_in_progress').html('0%');
	// AJAX query params
	var data = {
		ajax_nonce: MORNING_RECORDS_STORAGE['ajax_nonce'],
		action: 'morning_records_importer_start_import',
		importer_action: steps[idx].action
	};
	// Additional params depend current step
	for (var i in steps[idx].data)
		data[i] = steps[idx].data[i];
	// Send request to server
	jQuery.post(MORNING_RECORDS_STORAGE['ajax_url'], data, function(response) {
		"use strict";
		var rez = {};
		try {
			rez = JSON.parse(response);
		} catch (e) {
			rez = { error: MORNING_RECORDS_STORAGE['ajax_error']+':<br>'+response };
			console.log(response);
		}
		if (rez.error === '' || MORNING_RECORDS_STORAGE['importer_ignore_errors']) {
			if (rez.error !== '') 
				MORNING_RECORDS_STORAGE['importer_error_messages'] += '<p class="error_message">' + rez.error + '</p>';
			var action = rez.action;
			if (rez.result >= 100) {
				jQuery('#trx_importer_progress .'+action+' .import_progress_status').html('');
				jQuery('#trx_importer_progress .'+action+' .import_progress_status').removeClass('step_in_progress').addClass('step_complete'+(rez.error ? ' step_complete_with_error' : ''));
				idx++;
			} else {
				jQuery('#trx_importer_progress .'+action+' .import_progress_status').html(rez.result + '%');
				if (typeof steps[idx].data['last_id'] != 'undefined') steps[idx].data['last_id']++;
				steps[idx].data['attempt'] = (typeof rez.attempt != 'undefined') ? rez.attempt : 0;
			}
			// Do next action
			if (idx < steps.length) {
				morning_records_importer_do_action(steps, idx);
			} else {
				if (MORNING_RECORDS_STORAGE['importer_error_messages']) {
					jQuery('#trx_importer_progress').removeClass('notice-info').addClass('notice-error').append('<h4>' + MORNING_RECORDS_STORAGE['importer_error_msg'] + '</h4>' + MORNING_RECORDS_STORAGE['importer_error_messages']);
				} else {
					jQuery('#trx_importer_progress').removeClass('notice-info').addClass('notice-success');
					jQuery('.trx_importer_progress_complete').show();
				}
			}
		} else {
			// Add Error block above Import section
			jQuery('#trx_importer_progress').removeClass('notice-info').addClass('notice-error').css({'paddingTop': '1em', 'paddingBottom': '1em'}).html(rez.error);
		}
	});
}