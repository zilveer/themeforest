(function($) { "use strict";
jQuery(document).ready(function($){
	var bxsliderProperties = ["mode","speed","slideMargin","startSlide","randomStart","slideSelector","infiniteLoop","hideControlOnEnd","easing","captions","ticker","tickerHover","adaptiveHeight","adaptiveHeightSpeed","video","responsive","useCSS","preloadImages","touchEnabled","swipeThreshold","oneToOneTouch","preventDefaultSwipeX","preventDefaultSwipeY","pager","pagerType","pagerShortSeparator","pagerSelector","pagerCustom","buildPager","controls","nextText","prevText","nextSelector","prevSelector","autoControls","startText","stopText","autoControlsCombine","autoControlsSelector","auto","pause","autoStart","autoDirection","autoHover","autoDelay","minSlides","maxSlides","moveSlides","slideWidth"];
	var bxsliderCallbacks = ["onSliderLoad","onSlideBefore","onSlideAfter","onSlideNext","onSlidePrev"];
	var jmbxsliders = [];
	var jmbxresize = false;
	$('.jm-bxslider').each(function(e){
		var $this = $(this);
		var html = $this.wrap('<div class="jmbxslider-wrap">').parent().html();
		var options = {};
		$(bxsliderProperties).each(function(){
		  if($this.data(this.toString().toLowerCase()) != undefined){
				options[this.toString()] = $this.data(this.toString().toLowerCase());
		  }
		});
		$(bxsliderCallbacks).each(function(){
			if($this.data(this.toString().toLowerCase()) != undefined){
				var callback = this.toString();
				options[this.toString()] = function(){
					var funstr = $this.data(callback.toLowerCase());
					var f=new Function (funstr);
					return f();
				}
		  }
		});
		options.slideMargin = options.slideMargin || 0;
		var newsoptions = jmbxAdjustOptions(options,$this.width());
		if($this.data('resize')||0 == 1){
			jmbxresize = true;
		}
		jmbxsliders[e] = {elem:$this.parents('.jmbxslider-wrap'),slider:$(this).bxSlider(newsoptions),options:options,html:html,resize:$this.data('resize')||0};
		$this.find('.ww-carousel-team-item img').width(newsoptions.slideWidth);
	});
	if(jmbxsliders.length > 0 && jmbxresize){
		$(window).resize(function(){
			jmbxwaitForFinalEvent(function(){
				for(var i=0; i < jmbxsliders.length; i++){
					if(jmbxsliders[i].resize == 1){
						jmbxsliders[i].slider.destroySlider();
						jmbxsliders[i].elem.html(jmbxsliders[i].html);
						$(jmbxsliders[i].options.nextSelector).html('');
						$(jmbxsliders[i].options.prevSelector).html('');
						var newsoptions = jmbxAdjustOptions(jmbxsliders[i].options,jmbxsliders[i].elem.width());
						jmbxsliders[i].slider =jmbxsliders[i].elem.find('.jm-bxslider').bxSlider(newsoptions);
						jmbxsliders[i].elem.find('.ww-carousel-team-item img').width(newsoptions.slideWidth);
					}
				}
			})
		})
	}
	setTimeout(function(){$(window).trigger('resize')},500);
	var jmbxwaitForFinalEvent = (function () {
	  var timers = {};
	  return function (callback, ms, uniqueId) {
		if (!uniqueId) {
		  uniqueId = "Don't call this twice without a uniqueId";
		}
		if (timers[uniqueId]) {
		  clearTimeout (timers[uniqueId]);
		}
		timers[uniqueId] = setTimeout(callback, ms);
	  };
	})();
	function jmbxAdjustOptions(options, container_width){
		var _options = {};
		$.extend(_options, options);
		
		if((_options.slideWidth*_options.maxSlides + (_options.slideMargin*(_options.maxSlides-1))) < container_width){
			_options.slideWidth = (container_width-(_options.slideMargin*(_options.maxSlides-1)))/_options.maxSlides;
		}else{
			_options.maxSlides = Math.floor((container_width-(_options.slideMargin*(_options.maxSlides-1)))/_options.slideWidth);
			_options.maxSlides = _options.maxSlides == 0?1:_options.maxSlides;
			_options.slideWidth = (container_width-(_options.slideMargin*(_options.maxSlides-1)))/_options.maxSlides;
		}
		return _options;
	}
})
})(jQuery);
