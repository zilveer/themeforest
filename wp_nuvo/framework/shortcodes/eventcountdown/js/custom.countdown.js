jQuery(document).ready(function ($) {
	"use strict";
	/* element */
	var select = $('#event_countdown');
	var data_count = select.attr('data-count');
	var server_offset = select.attr('data-timezone');
	/* get local time zone */
	var offset = (new Date()).getTimezoneOffset();
	offset = (- offset / 60) - server_offset;
	
	if(data_count != undefined){
		var data_label = select.attr('data-label');
		
		if(data_label != undefined && data_label != ''){
			data_label = data_label.split(',')
		} else {
			data_label = ['DAYS','HOURS','MINUTES','SENCONDS'];
		}
		
		data_count = data_count.split(',')
		
		var austDay = new Date(data_count[0],parseInt(data_count[1]) - 1,data_count[2],parseInt(data_count[3]) + offset,data_count[4],data_count[5]);
		
		select.countdown({
			until: austDay,
			layout:'<ul><li class="cs-count-day"><span>'+data_label[0]+'</span><span>{dn}</span></li><li class="cs-count-hours"><span>'+data_label[1]+'</span><span>{hn}</span></li><li class="cs-count-minutes"><span>'+data_label[2]+'</span><span>{mn}</span></li><li class="cs-count-sencond"><span>'+data_label[3]+'</span><span>{sn}</span></li></ul>'
		});
	}
});