jQuery(document).ready(function($) {
	$( "#ci_cpt_discography_date" ).datepicker({
		dateFormat: 'yy-mm-dd',
	});

	//
	// Events
	//
	$( "#ci_cpt_events_date_printable" ).datepicker({
		altField: '#ci_cpt_events_date',
		altFormat: 'yy-mm-dd'
	});

	$( "#ci_cpt_events_time" ).timepicker({
		ampm: false,
		timeFormat: 'HH:mm',
		stepMinute: 5
	});

	var isEnabled = $('#ci_cpt_event_recurrent').prop('checked');
	var datetime = $('#event_datetime');
	var recurrent = $('#event_recurrent');

	if (isEnabled) { 
		datetime.hide();
		recurrent.show(); 
	} 
	else { 
		datetime.show();
		recurrent.hide(); 
	}

	$('#ci_cpt_event_recurrent').click(function(){
		var datetime = $('#event_datetime');
		var recurrent = $('#event_recurrent');
		if ($(this).prop('checked')) {
			datetime.hide();
			recurrent.show(); 
		}
		else {
			datetime.show();
			recurrent.hide(); 
		}
	});


	//
	// Discography tracks (repeating fields)
	//
	$('#ci_repeating_tracks .tracks').sortable({
		update: renumberTracks
	});


	// Repeating fields
	_sortable();

	var repeating_fields = $('.ci-repeating-fields');
	repeating_fields.each(function(){
		var add_field = $(this).find('.ci-repeating-add-field');
		add_field.click(function(){
			var repeatable_area = $(this).siblings('.inner');
			var fields = repeatable_area.children('.field-prototype').clone(true).removeClass('field-prototype').removeAttr('style').appendTo(repeatable_area);
			renumberTracks();
			return false;
		});
	})

	$('body').on('click', '.ci-repeating-remove-field', function() {
		var field = $(this).parents('.post-field');
		field.remove();
		renumberTracks();
		return false;
	});


	function renumberTracks() {
		var $i = 1;
		var $tbody = $( "table.tracks" ).find( "tbody:not(.field-prototype)" );

		$tbody.each( function() {
			$( this ).find( ".track-num" ).text( $i );
			$i++;
		} );
	}

});

_sortable = function() {
	jQuery('.ci-repeating-fields .inner').sortable({ placeholder: 'ui-state-highlight' });
}
