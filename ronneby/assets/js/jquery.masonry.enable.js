(function($){
	"use strict";
	
	var $window = jQuery(window);
	
	$window.load(function () {
		var $container = $('#grid-folio');
		var $items = $('#grid-folio article.project');
		var columns = 3;
		var setColumns = function () {
			var width = $window.width();

			switch(true) {
				case (width > 1300): columns = 5; break;
				case (width > 1024): columns = 4; break;
				case (width > 980): columns = 3; break;
				case (width > 640): columns = 2; break;
				default: columns = 1;
			}
		};

		setColumns();
		$window.on('resize',setColumns);
		$container.observeDOM(function(){ 
			setColumns();
		});
		
		$container.masonry({
			itemSelector: '.project',
			isAnimated: true,
			columnWidth: function (containerWidth) {
				var col_width = Math.floor(containerWidth / columns);
				$items.width(col_width);
				return col_width;
			}
		});
	});
	
})(jQuery);