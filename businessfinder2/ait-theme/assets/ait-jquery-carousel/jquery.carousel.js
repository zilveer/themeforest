/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


(function($, $window){

	"use strict";

	var Carousel = function(element, options)
	{
		var elem = $(element);
		var obj = this;
		var settings = $.extend({}, options.defaults, options.current);

		var interval;
		var glDirection = "right";
		var glAutoplay = 0;
		var glFading = 0;
		var glInfinite = true;
		var time = 5000;
		var visible;
		var moving = false;
		var item = {};


		var carouselInit = function(){
			if(typeof settings.glInfinite != 'undefined') {
				glInfinite = settings.glInfinite;
			}

			carouselTransform();
			carouselSetVisible();
			carouselResize();

			if(settings.layout == "box"){
				glAutoplay = typeof settings.boxEnableAutoplay != "undefined" ? settings.boxEnableAutoplay : 0;
				glFading = typeof settings.boxEnableFading != "undefined" ? settings.boxEnableFading : 0;
			} else if (settings.layout == "icon"){
				glAutoplay = typeof settings.iconEnableAutoplay != "undefined" ? settings.iconEnableAutoplay : 0;
				glFading = typeof settings.iconEnableFading != "undefined" ? settings.iconEnableFading : 0;
			} else {
				glAutoplay = typeof settings.listEnableAutoplay != "undefined" ? settings.listEnableAutoplay : 0;
				glFading = typeof settings.listEnableFading != "undefined" ? settings.listEnableFading : 0;
			}

			if(elem.hasClass('elm-testimonials')){
				carouselTransformItems();
			}

			carouselArrowsCreate();
			carouselArrowLeft();
			carouselArrowRight();
			if(glAutoplay != 0){
				carouselPlay();
				carouselHover();
			}

			if(glInfinite){
				var container = elem.find('.carousel-container');
				var items = container.find('.item').parent().clone();
				items.addClass('item-clone');
				container.append(items);
				container.prepend(container.find('.item:last').parent());
				container.css({'margin-left':-(item.width+item.gap)});
			}

			if(settings.layout != "icon"){
				elem.find('.loading').fadeOut('fast');
			}
		};

		var carouselTransformItems = function(){
			var height = carouselItemHeight();
			var container = elem.find('.carousel-container');
			container.children('div.item-box').each(function(){
				jQuery(this).find('.item-excerpt').height(height);
			});
		};

		var carouselItemHeight = function(){
			var height = 0;
			var container = elem.find('.carousel-container');

			container.children('div.item-box').each(function(){
				var excerpt = jQuery(this).find('.item-excerpt');
				if(excerpt.height() > height){
					height = excerpt.height();
				}
			});

			return height;
		};

		var carouselTransform = function(){
			if(settings.layout != 'icon'){
				elem.parent().parent().addClass('carousel-enabled');
				//elem.parent().parent().addClass('layout-'+settings.layout);
			}
			item.count = elem.find('.carousel-item').length;

			carouselRefresh();
			//elem.css({'overflow' : 'hidden'});
		};

		var carouselRefresh = function(){
			var container = elem.find('.carousel-container');

			container.removeAttr('style');
			container.find('.carousel-item').each(function(){
				$(this).removeAttr('style');
			});

			if(settings.layout == 'icon'){
				item.width = parseInt(settings.iconBoxWidth);
				var itemFirst = container.find('.carousel-item').first();
				item.gap = parseInt(itemFirst.outerWidth(true)-itemFirst.width());
				visible = Math.round(elem.parent().width() / (item.width+item.gap));

				/*container.find('.carousel-item').each(function(){
					$(this).css({'width' : item.width});
				});*/
			} else {
				item.width = parseInt(container.find('.carousel-item').first().width());
				item.gap = parseInt(container.find('.carousel-item').first().outerWidth(true)-item.width);
				visible = Math.floor(elem.parent().width() / (item.width+item.gap));

				container.find('.carousel-item').each(function(){
					$(this).css({'width' : item.width, 'margin-right' : item.gap});
				});
			}

			container.width(parseInt((item.width+item.gap)*item.count));
			if (glInfinite) {
				container.css({'margin-left':-(item.width+item.gap)});
			}

			carouselResetVisible();

			container.find('.carousel-item').css({'visibility':'visible'});

		};

		var carouselResize = function(){
			$window.resize(function(){
				/*var cWidthHack = Math.floor(elem.width()/(parseInt(settings.iconBoxWidth)+itemGap))*(parseInt(settings.iconBoxWidth)+itemGap);
				elem.width(cWidthHack-itemGap);*/

				carouselRefresh();
			});
		};

		var carouselSetVisible = function(){
			var container = elem.find('.carousel-container');
			container.find('.carousel-item').each(function(){
				$(this).removeClass('first-visible').removeClass('last-visible');
			});
			var firstVisible = parseInt(container.attr('data-first'));
			var lastVisible = parseInt(container.attr('data-first'))+(visible-1);
			carouselSetRange(firstVisible, 'first-visible');
			carouselSetRange(lastVisible, 'last-visible');
		};

		var carouselResetVisible = function(){
			var container = elem.find('.carousel-container');
			container.attr('data-first', 1);
			carouselSetVisible();
		}

		var carouselSetRange = function(id, htmlclass){
			elem.find('.carousel-item').each(function(){
				if(parseInt($(this).data('id')) == id){
					$(this).addClass(htmlclass);
				}
			});
		};

		var carouselPlay = function(){
			interval = setInterval(function(){
				carouselMoveAuto();
			}, time);
		};

		var carouselStop = function(){
			clearInterval(interval);
		};

		var carouselFade = function(direction, multiplier){
			var container = elem.find('.carousel-container');
			switch(direction){
				case "left":
					// left
					if(glInfinite){
						moving = true;
						var counter = parseInt(container.attr('data-first'));
						var localScroll = parseInt((item.width+item.gap)*multiplier);
						var move = parseInt(container.css('margin-left')) + localScroll;
						container.animate({'opacity': 0}, 250, function(){
							container.delay(500).animate({marginLeft : move}, {queue: true, duration: 100, complete: function(){
								container.find('div.item-box:first').before(container.find('div.item-box:last'));
								container.css({'margin-left':-(item.width+item.gap)});
								carouselSetVisible();
								container.delay(100).animate({'opacity': 1}, 250, function(){
									moving = false;
								});
							}});
						});
					} else {
						var firstId = 1;
						var firstVisibleId = parseInt(container.attr('data-first'));
						if(firstVisibleId > 0){
							moving = true;
							if(multiplier > parseInt(firstVisibleId - firstId)){
								var localMult = firstVisibleId - firstId;
							} else {
								var localMult = multiplier;
							}

							var localScroll = parseInt((item.width+item.gap)*localMult);
							var move = parseInt(container.css('margin-left')) + localScroll;
							container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
								container.attr('data-first', parseInt(firstVisibleId-localMult));
								carouselSetVisible();
								moving = false;
							}});
						}
					}
				break;
				case "right":
					// right
					if(glInfinite){
						moving = true;
						var counter = parseInt(container.attr('data-first'));
						var localScroll = parseInt((item.width+item.gap)*multiplier);
						var move = parseInt(container.css('margin-left')) - localScroll;
						container.animate({'opacity': 0}, 250, function(){
							container.delay(500).animate({marginLeft : move}, {queue: true, duration: 100, complete: function(){
								container.find('div.item-box:last').after(container.find('div.item-box:first'));
								container.css({'margin-left':-(item.width+item.gap)});
								carouselSetVisible();
								container.delay(100).animate({'opacity': 1}, 250, function(){
									moving = false;
								});
							}});
						});
					} else {
						var firstId = parseInt(container.attr('data-first'));
						var lastId = parseInt(container.attr('data-last'));
						var lastVisibleId = parseInt(firstId+(visible-1));
						if(lastVisibleId < lastId){
							moving = true;
							if(multiplier > parseInt(lastId - lastVisibleId)){
								var localMult = lastId - lastVisibleId;
							} else {
								var localMult = multiplier;
							}

							var localScroll = parseInt((item.width+item.gap)*localMult);
							var move = parseInt(container.css('margin-left')) - localScroll;
							container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
								container.attr('data-first', parseInt(firstId+localMult));
								carouselSetVisible();
								moving = false;
							}});
						}
					}
				break;
			}
		};

		var carouselMove = function(direction, multiplier){
			var container = elem.find('.carousel-container');
			switch(direction){
				case "left":
					// left
					if(glInfinite){
						moving = true;
						var counter = parseInt(container.attr('data-first'));
						var localScroll = parseInt((item.width+item.gap)*multiplier);
						var move = parseInt(container.css('margin-left')) + localScroll;
						container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
							container.find('div.item-box:first').before(container.find('div.item-box:last'));
							container.css({'margin-left':-(item.width+item.gap)});
							carouselSetVisible();
							moving = false;
						}});
					} else {
						var firstId = 1;
						var firstVisibleId = parseInt(container.attr('data-first'));
						if(firstVisibleId > 0){
							moving = true;
							if(multiplier > parseInt(firstVisibleId - firstId)){
								var localMult = firstVisibleId - firstId;
							} else {
								var localMult = multiplier;
							}

							var localScroll = parseInt((item.width+item.gap)*localMult);
							var move = parseInt(container.css('margin-left')) + localScroll;
							container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
								container.attr('data-first', parseInt(firstVisibleId-localMult));
								carouselSetVisible();
								moving = false;
							}});
						}
					}
				break;
				case "right":
					// right
					if(glInfinite){
						moving = true;
						var counter = parseInt(container.attr('data-first'));
						var localScroll = parseInt((item.width+item.gap)*multiplier);
						var move = parseInt(container.css('margin-left')) - localScroll;
						container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
							container.find('div.item-box:last').after(container.find('div.item-box:first'));
							container.css({'margin-left':-(item.width+item.gap)});
							carouselSetVisible();
							moving = false;
						}});
					} else {
						var firstId = parseInt(container.attr('data-first'));
						var lastId = parseInt(container.attr('data-last'));
						var lastVisibleId = parseInt(firstId+(visible-1));
						if(lastVisibleId < lastId){
							moving = true;
							if(multiplier > parseInt(lastId - lastVisibleId)){
								var localMult = lastId - lastVisibleId;
							} else {
								var localMult = multiplier;
							}

							var localScroll = parseInt((item.width+item.gap)*localMult);
							var move = parseInt(container.css('margin-left')) - localScroll;
							container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
								container.attr('data-first', parseInt(firstId+localMult));
								carouselSetVisible();
								moving = false;
							}});
						}
					}
				break;
			}
		};

		var carouselMoveManual = function(index){
			var container = elem.find('.carousel-container');
			var firstVisibleElementId = parseInt(container.attr('data-first'));
			var lastVisibleElementId = parseInt(container.attr('data-first'))+visible-1;
			var allElements = container.attr('data-last');
			/*if(index > lastVisibleElementId){
				var move = index - lastVisibleElementId;
				carouselMove('right', move);
			} else if (index < firstVisibleElementId){
				var move = firstVisibleElementId - index;
				carouselMove('left', move);
			} else {
				// in range, dont move anything
			}*/
			if(!glInfinite){
				if(glDirection == "right"){
					if(lastVisibleElementId == allElements){
						glDirection = "left";
					}
				} else {
					if(firstVisibleElementId == 1){
						glDirection = "right";
					}
				}
			}

			if(glFading != 0){
				carouselFade(glDirection, index);
			} else {
				carouselMove(glDirection, index);
			}
		};

		var carouselMoveAuto = function(){
			if(moving == false){
				carouselMoveManual(1);
			}
		};

		/* user functions */
		var carouselHover = function(){
			elem.parent().hover(function(){
				carouselStop();
			}, function(){
				carouselPlay();
			});
		};

		var carouselArrowsCreate = function(){
			// fix - do not show arrows if queried items count is less then items count available for one slide
			var itemsCount = elem.find('.carousel-item.item').length;
			if (settings.layout == 'box') {
				if (itemsCount <= (settings.boxColumns * settings.boxRows) && !glInfinite) {return;}
			}
			else {
				if (itemsCount <= settings.listColumns * settings.listRows && !glInfinite) {return;}
			}
			// Find manual added arrows
			if(settings.layout == 'icon'){
				var arrowLeft = elem.parent().parent().find('.carousel-arrow-left');
				var arrowRight = elem.parent().parent().find('.carousel-arrow-right');
			} else {
				var arrowLeft = elem.parent().find('.carousel-arrow-left');
				var arrowRight = elem.parent().find('.carousel-arrow-right');
			}

			// check if exists
			if( arrowLeft.length > 0 && arrowRight.length > 0)
			{
				arrowLeft.addClass('arrow arrow-left').show();
				arrowRight.addClass('arrow arrow-right').show();
			}
			else
			{
				// create arrows
				elem.parent().append('<div class="carousel-arrows"><div class="standard-arrows"><div class="arrow arrow-left">&lt;</div><div class="arrow arrow-right">&gt;</div></div></div>');
			}
		};

		var carouselArrowLeft = function(){
			// action for left arrow
			if(settings.layout == 'icon'){
				elem.parent().parent().find('.carousel-arrows .arrow-left, .carousel-arrow-left').css({'cursor' : 'pointer'}).click(function(){
					if(moving == false){
						//carouselMove('left', 1);
						if(glFading != 0){
							carouselFade('left', 1);
						} else {
							carouselMove('left', 1);
						}
					}
				});
			} else {
				elem.parent().find('.carousel-arrows .arrow-left, .carousel-arrow-left').css({'cursor' : 'pointer'}).click(function(){
					if(moving == false){
						//carouselMove('left', 1);
						if(glFading != 0){
							carouselFade('left', 1);
						} else {
							carouselMove('left', 1);
						}
					}
				});
			}
		};

		var carouselArrowRight = function(){
			// action for right arrow
			if(settings.layout == 'icon'){
				elem.parent().parent().find('.carousel-arrows .arrow-right, .carousel-arrow-right').css({'cursor' : 'pointer'}).click(function(){
					if(moving == false){
						//carouselMove('right', 1);
						if(glFading != 0){
							carouselFade('right', 1);
						} else {
							carouselMove('right', 1);
						}
					}
				});
			} else {
				elem.parent().find('.carousel-arrows .arrow-right, .carousel-arrow-right').css({'cursor' : 'pointer'}).click(function(){
					if(moving == false){
						//carouselMove('right', 1);
						if(glFading != 0){
							carouselFade('right', 1);
						} else {
							carouselMove('right', 1);
						}
					}
				});
			}
		};

		if(settings.layout == 'icon'){
			elem.parent().parent().parent().parent().addClass('carousel-enabled');

			var itemFirst = elem.find('.carousel-container .carousel-item').first();
			var itemGap = parseInt(itemFirst.outerWidth(true)-itemFirst.width());


			/*console.log(elem.find('.carousel-item').length);
			console.log(parseInt(settings.iconBoxWidth)+itemGap);
			console.log(elem.width());*/

			if( ( (elem.find('.carousel-item').length/2) *(parseInt(settings.iconBoxWidth)+itemGap)-itemGap > elem.width()) ) {
				// enable carousel
				var widthHack = Math.floor(elem.width()/(parseInt(settings.iconBoxWidth)+itemGap))*(parseInt(settings.iconBoxWidth)+itemGap);
				elem.width(widthHack-itemGap);

				carouselInit();
			} else {
				elem.parent().parent().parent().parent().removeClass('carousel-enabled');
				elem.parent().parent().parent().parent().addClass('carousel-disabled');
			}

			elem.parent().css({'width': 'auto'});
			elem.find('.loading').fadeOut('fast');


		} else {
			carouselInit();
		}
	};

	$.fn.carousel = function(options){
		return this.each(function(){
			var element = $(this);
			if (element.data('carousel')) return;

			var carousel = new Carousel(this, options);
			element.data('carousel', carousel);
		});
	};
})(jQuery, jQuery(window));
