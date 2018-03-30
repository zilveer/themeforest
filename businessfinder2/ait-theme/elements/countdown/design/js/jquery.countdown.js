

(function($){

	var Countdown = function(element, options)
	{
		var elem = $(element);
		var obj = this;
		var settings = $.extend({}, options.defaults, options.current);

		var interval;
		var time = {};

		var countdownInit = function(){
			time.start = new Date(settings.startDate.replace(new RegExp('-', 'g'), '/'));
			time.end = new Date(settings.endDate.replace(new RegExp('-', 'g'), '/'));
			time.now = new Date(settings.now);

			countdownRefresh();
			countdownStart();
		};

		var countdownSetTime = function(){
			time.total = Math.floor((time.end.getTime() - time.start.getTime()) / (24*60*60*1000));
			time.days = Math.floor((time.end.getTime() - time.now.getTime()) / (24*60*60*1000));
			time.mod = (time.end.getTime() - time.now.getTime()) % (24*60*60*1000);
			time.hours = Math.floor(time.mod / (60*60*1000));
			time.mod = time.mod % (60*60*1000);
			time.minutes = Math.floor(time.mod / (60*1000));
			time.mod = time.mod % (60*1000);
			time.seconds = Math.floor(time.mod / (1000));
		};

		var countdownSetOption = function(type){
			var container1 = elem.find('.'+type+'-container');
			var container2 = elem.find('.'+type+'-container .clock-icon');
			var ctn = container2.children('canvas').get(0);
			var ctx = ctn.getContext('2d');
			ctx.clearRect(0, 0, ctn.width, ctn.height);
			ctx.beginPath();

			ctx.shadowBlur    	= 10;
			ctx.shadowOffsetX 	= 0;
			ctx.shadowOffsetY 	= 0;
			ctx.shadowColor 	= 'none';
			ctx.lineWidth 		= settings.lineWidth;

			if(settings.countdownRound == ""){
				ctx.strokeStyle 	= settings.backColor;
			} else {
				ctx.strokeStyle 	= settings.countdownRound;
			}
			ctx.arc((ctn.width/2),(ctn.width/2),((ctn.width-ctx.lineWidth)/2), deg(0), deg(360));
			ctx.stroke();

			if(settings.countdownColor == ""){
				ctx.strokeStyle 	= settings.frontColor;
			} else {
				ctx.strokeStyle 	= settings.countdownColor;
			}

			ctx.beginPath();
			switch(type){
				case 'days':
					ctx.arc((ctn.width/2),(ctn.width/2),((ctn.width-ctx.lineWidth)/2), deg(0), deg((360/time.total)*(time.days)));
					container1.find('.clock-data .'+type+'-value').text(time.days);
				break;
				case 'hours':
					ctx.arc((ctn.width/2),(ctn.width/2),((ctn.width-ctx.lineWidth)/2), deg(0), deg(15*time.hours));
					container1.find('.clock-data .'+type+'-value').text(time.hours);
				break;
				case 'minutes':
					ctx.arc((ctn.width/2),(ctn.width/2),((ctn.width-ctx.lineWidth)/2), deg(0), deg(6*time.minutes));
					container1.find('.clock-data .'+type+'-value').text(time.minutes);
				break;
				case 'seconds':
					ctx.arc((ctn.width/2),(ctn.width/2),((ctn.width-ctx.lineWidth)/2), deg(0), deg(6*time.seconds));
					container1.find('.clock-data .'+type+'-value').text(time.seconds);
				break;
			}
			ctx.stroke();
		};

		var countdownStart = function(){
			interval = setInterval(function(){
				if((time.end.getTime() - time.now.getTime()) >= 0){
					time.now.setSeconds(time.now.getSeconds()+1);
					countdownRefresh();
				} else {
					countdownStop();
					countdownFinished();
				}
			}, 1000);
		};

		var countdownStop = function(){
			clearInterval(interval);
		};

		var countdownRefresh = function(){
			countdownSetTime();

			countdownSetOption('days');
			countdownSetOption('hours');
			countdownSetOption('minutes');
			countdownSetOption('seconds');
		};

		var countdownFinished = function(){
			elem.find('.clock-container').hide();
			elem.find('.clock-done').show();
		};

		var deg = function(deg){
			return (Math.PI / 180) * deg - (Math.PI / 180) * 90;
		}

		countdownInit();
	};

	$.fn.countdown = function(options){
		return this.each(function(){
			var element = $(this);
			if (element.data('countdown')) return;

			var countdown = new Countdown(this, options);
			element.data('countdown', countdown);
		});
	};
})(jQuery);
