

(function($){

	var AdSpaces = function(element, options)
	{
		var elem = $(element);
		var obj = this;
		var settings = $.extend({}, options.defaults, options.current);

		var interval;
		var animation = {speed: 1000, delay: (settings.animationTime * 1000)};
		var item = {};

		var adSpacesInit = function(){
			var container = elem.find('div.elm-advertisment-spaces-container');
			var height = adSpacesHeight();
			container.css({'height': height});
			container.css({'visibility' : 'visible'});
		};

		var adSpacesMoveAuto = function(){
			if(item.count != 1){
				adSpacesMove('next');
			}
		};

		var adSpacesMove = function(direction){
			var container = elem.find('div.elm-advertisment-spaces-container');
			item.count = container.children().length;
			item.current = container.find('div.active');
			item.currentIndex = parseInt(item.current.index()+1);

			switch(direction){
				case 'next':
				var nextItemIndex = 0;
				if(item.currentIndex == item.count){
					nextItemIndex = 1;
				} else {
					nextItemIndex = item.currentIndex + 1;
				}
				container.find('div.adSpace-'+item.currentIndex).removeClass('active').fadeOut(parseInt(animation.speed/2));
				container.find('div.adSpace-'+nextItemIndex).addClass('active').fadeIn(parseInt(animation.speed));
				break;
				case 'prev':
				var prevItemIndex = 0;
				if(item.currentIndex == 1){
					prevItemIndex = item.count;
				} else {
					prevItemIndex = item.currentIndex - 1;
				}
				container.find('div.adSpace-'+item.currentIndex).removeClass('active').fadeOut(parseInt(animation.speed/2));
				container.find('div.adSpace-'+prevItemIndex).addClass('active').fadeIn(parseInt(animation.speed));
				break;
			}
		};

		var adSpacesPlay = function(){
			interval = setInterval(function(){
                adSpacesMoveAuto();
            }, animation.delay);
		};

		var adSpacesStop = function(){
			clearInterval(interval);
		};

		var adSpacesHover = function(){
			elem.hover(function(){
				adSpacesStop();
			}, function(){
				adSpacesPlay();
			});
		};

		var adSpacesHeight = function(){
			var height = 0;
			var container = elem.find('div.elm-advertisment-spaces-container');
			container.children('div.advertisment-space').each(function(){
				if(jQuery(this).height() > height){
					height = jQuery(this).height();
				}
			});
			return height;
		};

		$(window).resize(function(){
			var container = elem.find('div.elm-advertisment-spaces-container');
			var height = adSpacesHeight();
			container.css({'height': height});
		});

		adSpacesInit();

		adSpacesHover();

		adSpacesPlay();

		elem.find('.loading').fadeOut('fast');

	};

	$.fn.adSpaces = function(options){
		return this.each(function(){
			var element = $(this);
			if (element.data('adSpaces')) return;

			var adSpaces = new AdSpaces(this, options);
			element.data('adSpaces', adSpaces);
		});
	};
})(jQuery);
