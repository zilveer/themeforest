

(function($){

	var Testimonials = function(element, options)
	{
		var elem = $(element);
		var obj = this;
		var settings = $.extend({}, options.defaults, options.current);

		var interval;
		var animation = {speed: 1000, delay: 5000};
		var item = {};

		var testimonialsInit = function(){
			var container = elem.find('ul.testimonials');
			//var height = container.find('li#testimonial-1').css('height');
			var height = testimonialsHeight();
			container.css({'height': height});
			container.parent().css({'visibility' : 'visible'});
		};

		var testimonialsMoveAuto = function(){
			if(item.count != 1){
				testimonialsMove('next');
			}
		};

		var testimonialsMove = function(direction){
			var container = elem.find('ul.testimonials');
			item.count = container.children().length;
			item.current = container.find('li.active');
			item.currentIndex = parseInt(item.current.index()+1);

			switch(direction){
				case 'next':
				var nextItemIndex = 0;
				if(item.currentIndex == item.count){
					nextItemIndex = 1;
				} else {
					nextItemIndex = item.currentIndex + 1;
				}
				//container.css('height', container.find('li#testimonial-'+nextItemIndex).css('height'));
				container.find('li.testimonial-'+item.currentIndex).removeClass('active').fadeOut(parseInt(animation.speed/2));
				container.find('li.testimonial-'+nextItemIndex).addClass('active').fadeIn(parseInt(animation.speed));
				break;
				case 'prev':
				var prevItemIndex = 0;
				if(item.currentIndex == 1){
					prevItemIndex = item.count;
				} else {
					prevItemIndex = item.currentIndex - 1;
				}
				//container.css('height', container.find('li#testimonial-'+prevItemIndex).css('height'));
				container.find('li.testimonial-'+item.currentIndex).removeClass('active').fadeOut(parseInt(animation.speed/2));
				container.find('li.testimonial-'+prevItemIndex).addClass('active').fadeIn(parseInt(animation.speed));
				break;
			}
		};

		var testimonialsPlay = function(){
			interval = setInterval(function(){
                testimonialsMoveAuto();
            }, animation.delay);
		};

		var testimonialsStop = function(){
			clearInterval(interval);
		};

		var testimonialsArrowLeft = function(){
			elem.find('div.testimonial-arrows div.arrow-left').stop(true, true).click(function(){
				testimonialsStop();
				testimonialsMove('prev');
			});
		};
		var testimonialsArrowRight = function(){
			elem.find('div.testimonial-arrows div.arrow-right').stop(true, true).click(function(){
				testimonialsStop();
				testimonialsMove('next');
			});
		};

		var testimonialsHover = function(){
			elem.hover(function(){
				testimonialsStop();
			}, function(){
				testimonialsPlay();
			});
		};

		var testimonialsHeight = function(){
			var height = 0;
			var container = elem.find('ul.testimonials');
			container.children('li').each(function(){
				if(jQuery(this).height() > height){
					height = jQuery(this).height();
				}
			});
			return height;
		};

		$(window).resize(function(){
			var container = elem.find('ul.testimonials');
			//var height = container.find('li#testimonial-1').css('height');
			var height = testimonialsHeight();
			container.css({'height': height});
		});

		testimonialsInit();

		testimonialsHover();
		testimonialsArrowLeft();
		testimonialsArrowRight();

		testimonialsPlay();
	};

	$.fn.testimonials = function(options){
		return this.each(function(){
			var element = $(this);
			if (element.data('testimonials')) return;

			var testimonials = new Testimonials(this, options);
			element.data('testimonials', testimonials);
		});
	};
})(jQuery);
