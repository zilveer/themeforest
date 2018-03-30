

(function($){


	var PriceTable = function(element, options)
	{
		var elem = $(element);
		var settings = $.extend({}, options.defaults, options.current);

		var tableHeightFix = function(){
			var heights = {header: 0, footer: 0};
			var highiestRowInLine = [];

			elem.find('.ptable-item-wrap .table-row').each(function(i){
				highiestRowInLine[i] = 0;
			});

			elem.find('.ptable-item-wrap').each(function(){
				var lHeights = {header: $(this).children('.table-header').height(), footer: $(this).children('.table-footer').height()};
				if(lHeights.header > heights.header){
					heights.header = lHeights.header;
				}
				if(lHeights.footer > heights.footer){
					heights.footer = lHeights.footer;
				}
				// body
				$(this).find('.table-row').each(function(i){
					if($(this).height() > highiestRowInLine[i]){
						highiestRowInLine[i] = $(this).height();
					}
				});
			});

			elem.find('.ptable-item-wrap').each(function(){
				$(this).children('.table-header').height(heights.header);
				$(this).children('.table-footer').height(heights.footer);
				$(this).find('.table-row').each(function(i){
					$(this).height(highiestRowInLine[i]);
				});
			});
		};

		var clearHeight = function(){
			elem.find('.ptable-item-wrap').each(function(){
				$(this).children('.table-header').removeAttr('style');
				$(this).children('.table-footer').removeAttr('style');
				$(this).find('.table-row').each(function(i){
					$(this).removeAttr('style');
				});
			});
		}

		var resize = function(){
			$(window).resize(function(){
				clearHeight();
				tableHeightFix();
			});
		};

		tableHeightFix();

		resize();
	};

	$.fn.pricetable = function(options){
		return this.each(function(){
			var element = $(this);
			if (element.data('pricetable')) return;

			var pricetable = new PriceTable(this, options);
			element.data('pricetable', pricetable);
		});
	};
})(jQuery);