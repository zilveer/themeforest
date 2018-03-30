

(function($){


	var Charts = function(element, options)
	{
		var elem = $(element);
		var settings = $.extend({}, options.defaults, options.current);
		var interval;

		var chartsInit = function(){
			var container = elem.find('.counter-display');
			if(settings.chartType == "textbox"){
				chartsAnimate(container.children('.type-text'), null);
			} else {
				var ctn = container.children('canvas').get(0);
				var ctx = ctn.getContext('2d');

				chartsSetColor(ctx, settings.counterBaseColor);
				ctx.shadowBlur    	= 10;
				ctx.shadowOffsetX 	= 0;
				ctx.shadowOffsetY 	= 0;
				ctx.shadowColor 	= 'none';
				chartsSetLine(ctx, settings.counterThickness);

				chartsAnimate(ctx, ctn);
			}
		};

		var chartsDrawGauge = function(ctx, ctn, currentVal){
			ctx.clearRect(0, 0, ctn.width, ctn.height);
			chartsSetLine(ctx, settings.counterThickness);
			chartsDrawGaugeFull(ctx, ctn);
			if(settings.counterBaseColor == ""){
				chartsSetColor(ctx, settings.frontColor);
			} else {
				chartsSetColor(ctx, settings.counterBaseColor);
			}
			ctx.beginPath();
			ctx.arc((ctn.width/2), (ctn.width/2), ((ctn.width-ctx.lineWidth)/2), deg(0), deg(3.6*currentVal));
			ctx.stroke();
		};

		var chartsDrawGaugeFull = function(ctx, ctn){
			if(settings.counterBottomColor == ""){
				chartsSetColor(ctx, settings.backColor);
			} else {
				chartsSetColor(ctx, settings.counterBottomColor);
			}
			ctx.beginPath();
			ctx.arc((ctn.width/2), (ctn.width/2), ((ctn.width-ctx.lineWidth)/2), deg(0), deg(3.6*100));
			ctx.stroke();
		};

		// ready pie chart - not drawing correctly on ff and ie - must repair in future ;)
		var chartsDrawPie = function(ctx, ctn, currentVal){
			ctx.clearRect(0, 0, ctn.width, ctn.height);
			chartsSetLine(ctx, ctn.width/2);
			chartsDrawPieFull(ctx, ctn);
			if(settings.counterBaseColor == ""){
				chartsSetColor(ctx, settings.frontColor);
			} else {
				chartsSetColor(ctx, settings.counterBaseColor);
			}
			ctx.beginPath();
			ctx.arc((ctn.width/2), (ctn.width/2), ((ctn.width-ctx.lineWidth)/2), deg(0), deg(3.6*currentVal));
			ctx.stroke();
		};

		var chartsDrawPieFull = function(ctx, ctn){
			if(settings.counterBottomColor == ""){
				chartsSetColor(ctx, settings.backColor);
			} else {
				chartsSetColor(ctx, settings.counterBottomColor);
			}
			ctx.beginPath();
			ctx.arc((ctn.width/2), (ctn.width/2), ((ctn.width-ctx.lineWidth)/2), deg(0), deg(3.6*100));
			ctx.stroke();
		};
		// ready pie chart - not drawing correctly on ff and ie - must repair in future ;)

		var chartsDrawLine = function(ctx, ctn, currentVal){
			ctx.clearRect(0, 0, ctn.width, ctn.height);
			chartsSetLine(ctx, settings.counterThickness);
			chartsDrawLineFull(ctx, ctn);
			if(settings.counterBaseColor == ""){
				chartsSetColor(ctx, settings.frontColor);
			} else {
				chartsSetColor(ctx, settings.counterBaseColor);
			}
			ctx.beginPath();
			ctx.fillRect(0, 0, ((ctn.width/100)*currentVal), ctx.lineWidth);
			ctx.stroke();
		};

		var chartsDrawLineFull = function(ctx, ctn){
			if(settings.counterBottomColor == ""){
				chartsSetColor(ctx, settings.backColor);
			} else {
				chartsSetColor(ctx, settings.counterBottomColor);
			}
			ctx.beginPath();
			ctx.fillRect(0, 0, ctn.width, ctx.lineWidth);
			ctx.stroke();
		};

		var chartsDrawText = function(ctx, ctn, currentVal){
			ctx.html(currentVal);
		};

		var chartsSetColor = function(ctx, color){
			ctx.strokeStyle = color;
			ctx.fillStyle   = color;
		};

		var chartsSetLine = function(ctx, size){
			ctx.lineWidth = size;
		};

		var chartsAnimate = function(context, content){
			var start = 0;
			var end = elem.data('percent');
			interval = setInterval(function(){
				if(start < end){
					start = start + 1;
					switch(settings.chartType){
						case "gauge":
						chartsDrawGauge(context, content, start);
						break;
						/*case "pie":
						chartsDrawPie(context, content, start);
						break;*/
						case "line":
						chartsDrawLine(context, content, start);
						break;
						case "textbox":
						chartsDrawText(context, content, start);
						break;
						default:
						console.log(settings.chartType + " not implemented");
						break;
					}
				} else {
					clearInterval(interval);
				}
			},25);
		};

		var deg = function(deg){
			return (Math.PI / 180) * deg - (Math.PI / 180) * 90;
		}

		chartsInit();
	};

	$.fn.charts = function(options){
		return this.each(function(){
			var element = $(this);
			if (element.data('charts')) return;

			var charts = new Charts(this, options);
			element.data('charts', charts);
		});
	};
})(jQuery);