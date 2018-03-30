(function ($) { "use strict";
	function getDirection(ev, obj) {
		var w = $(obj).width(),
			h = $(obj).height(),
			x = (ev.pageX - $(obj).offset().left - (w / 2)) * (w > h ? (h / w) : 1),
			y = (ev.pageY - $(obj).offset().top - (h / 2)) * (h > w ? (w / h) : 1),
			d = Math.round( Math.atan2(y, x) / 1.57079633 + 5 ) % 4;
		return d;
	}
	function addClass( ev, obj, state ) {
		var direction = getDirection( ev, obj ),
		class_suffix = null;
		$(obj).removeAttr('class');
		switch ( direction ) {
			case 0 : class_suffix = '-top';    break;
			case 1 : class_suffix = '-right';  break;
			case 2 : class_suffix = '-bottom'; break;
			case 3 : class_suffix = '-left';   break;
		}
		$(obj).addClass( state + class_suffix );
	}
	$.fn.jmDeriction = function () {
		this.each(function () {
			$(this).hover(function(ev){
				addClass( ev, this, 'in' );
			},function(ev){
				addClass( ev, this, 'out' );
			})
		})
	}
 })(jQuery);