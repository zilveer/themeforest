jQuery(document).ready(function($) {
	var date, c_year, c_month;
	var calendar = $('.event-calendar').fullCalendar({
		header : {
			left : 'prev',
			center : 'title',
			right : 'next'
		},
		aspectRatio: 0,
		windowResize: function(view) {
			event_resize();
			event_row_size();
		},
		dayClick: function(date, jsEvent, view) {
			
			if($( window ).width() >= 992 ) return;
			
			$('#event-calendar-modal .modal-body').html('<span style="text-align: center;">loading...</span>');
			
			$.post(events.ajaxurl, {
				'action' : 'cshero_events_date',
				'day' : date._d.getDate(),
				'month' : date._d.getMonth() + 1,
				'year' : date._d.getFullYear(),
			}, function(response) {
				$('#event-calendar-modal .modal-body').html(response);
			});
			
			$('.event-calendar-modal').trigger('click');
		}
	});
	/** load */
	date = calendar.fullCalendar('getDate');
	c_month = date._d.getMonth() + 1;
	c_year = date._d.getFullYear();
	getevents(c_month, c_year);
	event_row_size();
	/** prev events */
	$('.cs-calendar').on('click', 'button.fc-prev-button', function() {
		date = calendar.fullCalendar('getDate');
		c_month = date._d.getMonth() + 1;
		c_year = date._d.getFullYear();
		getevents(c_month, c_year);
		event_row_size();
	});
	/** next events */
	$('.cs-calendar').on('click', 'button.fc-next-button', function() {
		date = calendar.fullCalendar('getDate');
		c_month = date._d.getMonth() + 1;
		c_year = date._d.getFullYear();
		getevents(c_month, c_year);
		event_row_size();
	});
	/** hover in */
	$('.cs-calendar').on('mouseenter', '.fc-day-number', function() {
		var data_date = $(this).attr('data-date');
		var day = $(this).parents('.fc-row').find(".fc-bg td[data-date='"+data_date+"']");
		if(!day.hasClass('fc-other-month')) {
			day.css({'background-color': '#00bdad'});
		}
	});
	/** hover out */
	$('.cs-calendar').on('mouseout', '.fc-day-number', function() {
		var data_date = $(this).attr('data-date');
		var day = $(this).parents('.fc-row').find(".fc-bg td[data-date='"+data_date+"']");
		if(day.hasClass('fc-event-items')){
			day.css({'background-color': '#ffa42e'});
		} else {
			day.removeAttr('style');
		}
	});
	/** add */
	$('.fc-right button').html('<span>Next Month</span><i class="fa fa-arrow-right"></i>');
	$('.fc-left button').html('<i class="fa fa-arrow-left"></i><span>Previous Month</span>');
	/** get events */
	function getevents(month, year) {
		$('.fc-day-grid-container').css({opacity: '0.2'});
		$.post(events.ajaxurl, {
			'action' : 'cshero_events_month',
			'month' : month,
			'year' : year,
		}, function(response) {
			response = $.parseJSON(response);
			$.each(response,function(index, value){
				calendar.fullCalendar('renderEvent', value);
				event_background();
				event_resize();
			});
			$('.fc-day-grid-container').css({opacity: '1'});
			event_row_size();
			event_remove_a();
		});
	}
	/** event day color */
	function event_background() {
		$('.fc-event-container').each(function() {
			var tds = $(this).parent('tr').find('td');
			var href = $(this).find('a').attr('href');
			tds.each(function(index) {
				if($(this).hasClass('fc-event-container')){
					var row = $(this).parents('.fc-row');
					var day = row.find(".fc-bg td:eq("+index+")");
					var day_text = row.find(".fc-content-skeleton td:eq("+index+")");
					day_text.html('<a href="'+href+'">'+day_text.text()+'</a>');
					day.addClass('fc-event-items');
					day.css({'background-color': '#ffa42e'});
				}
			});
		});
	}
	/** resize */
	function event_resize() {
		$_window = $( window ).width();
		if($_window < 992){
			$('.fc-event-container').css({display: 'none'});
		} else {
			$('.fc-event-container').removeAttr('style');
		}
	}
	/** row size */
	function event_row_size() {
		var day_width;
		$_window = $( window ).width();
		$('.fc-widget-content').each(function() {
			if($(this).find('.fc-event-container').length == 0 || $_window < 992){
				var select = $(this).find('.fc-day:first-child');
				day_width = select.width();
				$(this).css({'height':day_width+'px'});
			} else {
				$(this).removeAttr('style');
			}
		})
	}
	/** remove href from day. */
	function event_remove_a() {
		$('td.fc-day-number a').attr('href', 'javascript:void(0)');
	}
});