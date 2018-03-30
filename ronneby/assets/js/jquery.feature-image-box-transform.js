(function($) {
	"use strict";
	$.fn.featureImageBoxTransform = function(options) {

		var settings = $.extend({
			deg: -25,
			itemClass: null,
			height: 215,
			margin_right: 18
		}, options);
		
		var $this;
		
		var deg2rad = function(deg) {
			return Math.abs(deg) * (Math.PI / 180);
		};
		
		var build = function() {
			var float, margin_left, $itemWidth, $imageWidth, deg, margin_left_picture, margin_left_picture_container;
			var documentWidth = $(document).width();
			var $containerWidth = $this.width();
			var $cathetus = Math.round(settings.height * deg2rad(settings.deg));
			
			
			switch(true) {
				case (documentWidth <= 800):
					deg = 0;
					float = 'none';
					margin_left = 0;
					$itemWidth = $containerWidth;
					$imageWidth = $itemWidth;
					margin_left_picture_container = 0;
					margin_left_picture = 0;
					
					break;
				default: 
					deg = settings.deg;
					float = 'left';
				
					margin_left = 0;
					$itemWidth = Math.round(($containerWidth - $cathetus) / 3) - settings.margin_right;
					$imageWidth = $itemWidth + $cathetus + settings.margin_right;
					margin_left_picture_container = Math.round(($cathetus+5) / 2);
					margin_left_picture = -Math.floor(($cathetus-10) / 2);
			}
			
			var $items = $this.children(settings.itemClass);
			var css_transform = function(deg) {
				return {
					'-webkit-transform': 'skew('+deg+'deg)',
					'-moz-transform': 'skew('+deg+'deg)',
					'-o-transform': 'skew('+deg+'deg)',
					'-ms-transform': 'skew('+deg+'deg)'
				};
			};
			
			$items.each(function() {
				var $picture_container = $(this).find('.picture');
				var $picture_wrap = $(this).find('.picture-mask');
				var $picture = $picture_wrap.find('img');
				var $feature_title = $(this).find('.feature-title');
				
				$(this)
					.removeClass('four')
					.removeClass('columns')
					.css('float', float)
					.width($itemWidth)
					.css({
						'margin-right': settings.margin_right,
						'margin-left': margin_left
					});
					
				$picture_container
					.css(css_transform(deg))
					.css('margin-left', margin_left_picture_container)
					.css('width', '100%')
					.css('height', settings.height);
				$picture_wrap.css('height', settings.height);
				$picture
					.css(css_transform(deg * (-1)))
					.css('position', 'absolute')
					.css('max-width', 'none')
					.css('left', margin_left_picture)
					.width($imageWidth);
			
				var shift_top = Math.round(($picture.height() - $picture_wrap.height())/2);
				
				$picture.css('top', -shift_top);
				
				$feature_title.css(css_transform(deg * (-1)));
			});
		};
		
		$(window).resize(function() {
			build();
		});

		return this.each(function() {
			$this = $(this);
			
			build();
		});

	};

})(jQuery);