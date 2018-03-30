
(function($){


	var Portfolio = function(element, options)
	{
		var elem = $(element);
		var settings = $.extend({}, options.defaults, options.current);
		var quicksandOptions = {filter: 'all', sort: 'numeric', reverse: false};

		var setTileSize = function(){
			var tileWidth = computeWidth();
			var tileHeight = computeHeight();
			elem.find('ul.portfolio-items-wrapper').children().each(function(){
				$(this).css({'width': tileWidth/*, 'height': tileHeight*/});
			});
		};
		var computeWidth = function(){
			result = 0;
			elem.find('ul.portfolio-items-wrapper').children().each(function(){
				// fix for items not containing an image
				if($(this).find('.item-visible').children('img').data('width') != null){
					result = $(this).find('.item-visible').children('img').data('width');
				}
			});
			return result;
		};
		var computeHeight = function(){
			var iheight = imageHeight();
			var dheight = descrHeight();
			var height = toInt(iheight+dheight);
			return height;
		};
		var imageHeight = function(){
			result = 0;
			if(settings['imageHeight'] == 0){
				result = computeWidth();
			} else {
				//var igap = imageGap();
				result = toInt(settings['imageHeight'])/*+igap*/;
			}
			return result;
		};
		var imageGap = function(){
			result = 0;
			elem.find('ul.portfolio-items-wrapper').children().each(function(){
				var img = jQuery(this).find('.portfolio-item-img');
				var igap = toInt(img.outerHeight(true)-img.outerHeight());
				if(result < igap){
					result = igap;
				}
			});
			return result;
		};
		var descrHeight = function(){
			result = 0;
			if(settings['imageDescription']){
				elem.find('ul.portfolio-items-wrapper').children().each(function(){
					var desc = jQuery(this).find('.portfolio-item-desc');
					var gap = toInt(desc.outerHeight(true)-desc.height());
					if(result < jQuery(this).find('.portfolio-item-desc').height()){
						result = toInt(jQuery(this).find('.portfolio-item-desc').height()+gap);
					}
				});
			}
			return toInt(result);
		};
		var containerHeight = function(){
			var rows = Math.ceil(elem.find('ul.portfolio-items-wrapper li').length / settings['columns']);
			var height = elem.find('ul.portfolio-items-wrapper li:first').outerHeight(true);
			return toInt(rows*height);
		};
		var orderItems = function(){
			var container = elem.find('ul.portfolio-items-wrapper');
			var backup = container.clone();
			var order = elem.find('.order-wrap .selected').attr('data-ait-portfolio-order');
			if(order == 'ascending'){
				quicksandOptions.reverse = false;
			} else {
				quicksandOptions.reverse = true;
			}
			quicksandOptions.sort = elem.find('.sort-by-wrap .selected').attr('data-ait-portfolio-sort');
		};
		var setFilter = function(){
			var container = elem.find('ul.portfolio-items-wrapper');
			var backup = container.clone();

			elem.find('ul.category li a').click(function(e){
				e.preventDefault();
				quicksandOptions.filter = $(this).attr('data-ait-portfolio-filter');
				quicksand(container, backup);
				$(this).parent().parent().parent().find('div.selected span').html($(this).attr('data-ait-portfolio-title'));
			});
		};
		var setSort = function(){
			var container = elem.find('ul.portfolio-items-wrapper');
			var backup = container.clone();

			elem.find('ul.sort-by li a').click(function(e){
				e.preventDefault();
				quicksandOptions.sort = $(this).attr('data-ait-portfolio-sort');
				quicksand(container, backup);
				$(this).parent().parent().parent().find('div.selected span').html($(this).text());
			});
		};
		var setOrder = function(){
			var container = elem.find('ul.portfolio-items-wrapper');
			var backup = container.clone();

			elem.find('ul.order li a').click(function(e){
				e.preventDefault();
				var order = $(this).attr('data-ait-portfolio-order');
				if(order == 'ascending'){
					quicksandOptions.reverse = false;
				} else {
					quicksandOptions.reverse = true;
				}
				quicksand(container, backup);
				$(this).parent().parent().parent().find('div.selected span').html($(this).text());
			});
		};
		var setDropDownMenus = function(){
			elem.find('div.filter-wrapper').hover(function(){
				$(this).find('ul').stop(true,true).slideDown();
			},function(){
				$(this).find('ul').stop(true,true).slideUp();
			});
		};
		var elementHover = function(){
			elem.find('div.portfolio-item-img').unbind('mouseenter mouseleave');
			elem.find('div.portfolio-item-img').hover(function(){
				$(this).children('a').children('div.portfolio-item-icon').css({'background-color': 'rgba(51, 51, 51, 0.8)'});
				$(this).children('a').children('div.portfolio-item-icon').stop(true, true).fadeIn('slow');
			},function(){
				$(this).children('a').children('div.portfolio-item-icon').stop(true, true).fadeOut('slow');
				$(this).children('a').children('div.portfolio-item-icon').css({'background-color': 'none'});
			});
		};
		var elementAction = function(){
			if(settings['display'] == "colorbox"){
				elem.find('ul.portfolio-items-wrapper').children().each(function(){
					var href = '';
					if($(this).children('div.portfolio-item-img').hasClass('portfolio-item-type-image')){
						// image
						rel = $(this).children('div.portfolio-item-img').children('a').attr('data-rel');
						href = $(this).children('div.portfolio-item-img').children('a').attr('href');
						$(this).children('div.portfolio-item-img').colorbox({
							'rel'           : rel,
							'href'          : href,
							'transition'    : 'elastic',
							'speed'         : 600,
							'maxWidth'      : "95%", //elem.parent().width(),
							'maxHeight'     : "95%", //toInt(elem.parent().width()/1.5)
						});
					} else if($(this).children('div.portfolio-item-img').hasClass('portfolio-item-type-video')) {
						// video
						iframe = true;
						rel = $(this).children('div.portfolio-item-img').children('a').attr('data-rel');
						href = $(this).children('div.portfolio-item-img').children('a').attr('href');
						if(href.indexOf("youtube") != -1){
							var regExp = /(?:youtube(?:-nocookie)?\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i;
							var match = href.match(regExp);
							href = "https://www.youtube.com/embed/" + match[1] + "?wmode=opaque&amp;showinfo=0&amp;enablejsapi=1"
						}else{
							var regExp = /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/;
							var match = href.match(regExp);
							href = "https://player.vimeo.com/video/"+match[3]+"?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff";
						}
						$(this).children('div.portfolio-item-img').colorbox({
							'iframe'        : iframe,
							'rel'           : rel,
							'href'          : href,
							'transition'    : 'elastic',
							'speed'         : 600,
							'innerWidth'    : elem.parent().width(),
							'innerHeight'   : toInt(elem.parent().width()/1.5),
							'maxWidth'      : "95%", //elem.parent().width(),
							'maxHeight'     : "95%", //toInt(elem.parent().width()/1.5)
						});
					} else {
						// website
						type = 'iframe';
						href = $(this).children('div.portfolio-item-img').children('a').attr('href');
						/*$(this).children('div.portfolio-item-img').click(function(){
							window.open(href);
						});*/
					}
				});
			} else {
				// direct link
			}
		};
		var toInt = function(string){
			return parseInt(string, 10);
		};
		var quicksand = function(container, data){
			var filtered;
			var sorting;

			if(quicksandOptions.filter == 'all') {
				filtered = data.find('li');
			} else {
				filtered = data.find('li[class~=' + quicksandOptions.filter + ']');
			}

			sorting = filtered.sorted({
				reversed: quicksandOptions.reverse,
				by: function($v) {
					data = ait.utils.getDataAttr($v, 'portfolio-sort-params');
					return data[quicksandOptions.sort];
				}
			});

			container.quicksand(sorting, {
				duration: 750,
				easing: 'jswing',
				adjustWidth: 'auto'
			}, function(){
				elementHover();
			});
		};
		var fitItems = function(container, items, useRound){
			var containerWidth = container.width()/*+toInt(settings['imageOffset'])*/;
			var itemWidth = items.children('li').first().outerWidth(true);

			if(useRound){
				var result = Math.round((containerWidth/itemWidth)) != 0 ? Math.round((containerWidth/itemWidth))*itemWidth : itemWidth;
			} else {
				var result = Math.floor((containerWidth/itemWidth)) != 0 ? Math.floor((containerWidth/itemWidth))*itemWidth : itemWidth;
			}

			return result;
		};
		var resizeItems = function(){
			$(window).resize(function(){
				elem.find('ul.portfolio-items-wrapper').width(fitItems(elem, elem.find('ul.portfolio-items-wrapper'), (elem.parent().width() >= 1200)));
				elem.find('ul.portfolio-items-wrapper').css({'height': 'auto'});
			});
		};


		setTileSize();
		//elem.find('ul.portfolio-items-wrapper').css({'height': containerHeight()});
		elem.find('ul.portfolio-items-wrapper').width(fitItems(elem, elem.find('ul.portfolio-items-wrapper'), true));

		resizeItems();

		setSort();
		setOrder();
		setFilter();

		orderItems();

		setDropDownMenus();
		elementHover();
		elementAction();

		if(!settings.progressive){
			elem.find('div.loading').delay(1000).fadeOut('fast');
			elem.parent().parent().addClass('load-finished');
			/*elem.find('div.filters-wrapper').delay(1000).queue(function(next){
				$(this).addClass('load-finished');
				next();
			});
			elem.find('ul.portfolio-items-wrapper').delay(1000).queue(function(next){
				$(this).addClass('load-finished');
				next();
			});*/
		}
	};

	$.fn.portfolio = function(options){
		return this.each(function(){
			var element = $(this);
			if (element.data('portfolio')) return;

			var portfolio = new Portfolio(this, options);
			element.data('portfolio', portfolio);
		});
	};
})(jQuery);
