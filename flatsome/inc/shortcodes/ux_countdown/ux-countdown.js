Flatsome.behavior('ux-countdown', {
 attach: function (context) {
	jQuery('[data-countdown]', context).each(function () {
		 var $this = jQuery(this), finalDate = jQuery(this).data('countdown');
		 var t_hour = jQuery(this).data('text-hour'), t_min = jQuery(this).data('text-min'), t_week = jQuery(this).data('text-week'), t_plural = jQuery(this).data('text-plural'), t_day = jQuery(this).data('text-day'), t_sec = jQuery(this).data('text-sec');
		 $this.countdown(finalDate).on('update.countdown', function (event) {
		      var format = '<span>%H<strong>'+t_hour+'%!H:'+t_plural+';</strong></span><span>%M<strong>'+t_min+'</strong></span><span>%S<strong>'+t_sec+'</strong></span>';
		      if(event.offset.days > 0) { format = '<span>%-d<strong>'+t_day+'%!d:'+t_plural+';</strong></span>' + format; }
	   		  if(event.offset.weeks > 0) { format = '<span>%-w<strong>'+t_week+'%!w:'+t_plural+';</strong></span>' + format; }
			  jQuery(this).html(event.strftime(format));
		 }).on('finish.countdown', function (event) {
		 	  jQuery(this).addClass('ended');
		 });
	});
 }
});
