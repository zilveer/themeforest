jQuery(document).ready(function ($) {
	"use strict";
	/*same height*/
	var biggestHeight = 0;
	$('.ww-same-height').find('div.cs-latestEvents').each(function(){
		if($(this).height() > biggestHeight){
            biggestHeight = $(this).height();
        }
	});
	$('.ww-same-height').find('div.cs-latestEvents').height(biggestHeight);
	/*end*/
	$('.cs-eventHeader').each(function(){
		"use strict";
		slideshow(this, 0);
	});
	$(document.body).on('click','.cs-eventHeader',function(e){
		"use strict";
		slideshow(this, 500);
	});
	function slideshow(param, time) {
		"use strict";
		var selected = $(param).parent().parent();
		var content_height = selected.find('.cs-latestEvents').outerHeight(true);
		if(!$(param).hasClass('active')){
			selected.animate({'bottom':(selected.find('.cs-eventBody').outerHeight()-selected.find('.cs-latestEvents').outerHeight())}, time);
			$(param).addClass('active');
		} else {
			selected.css({'position':'relative'}).animate({'bottom':-content_height+'px'}, time);
			$(param).removeClass('active');
		}
	}
});