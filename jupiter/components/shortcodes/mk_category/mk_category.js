(function($) {
    'use strict';

    var core = MK.core,
    	path = MK.core.path;

    // TODO: Repair after Rifat. He repeated The same code twice - other same code is in photoalbum (why by the way?!).
    // Split it into two separate components when you see reusage
    MK.component.Category = function( el ) {
        var init = function(){
			core.loadDependencies([ path.plugins + 'pixastic.js' ], function() {
         		blurImage($('.blur-image-effect .mk-loop-item .item-holder '));
         	});

			core.loadDependencies([ path.plugins + 'minigrid.js' ], masonry);
        };

        var blurImage = function($item) {
         	return $item.each(function() {
				var $_this = $(this);

				var img = $_this.find('.item-thumbnail');

				img.clone().addClass("blur-effect item-blur-thumbnail").removeClass('item-thumbnail').prependTo(this);

				var blur_this = $(".blur-effect", this);
					blur_this.each(function(index, element){
						if (img[index].complete === true) {
							Pixastic.process(blur_this[index], "blurfast", {amount:0.5});
						}
						else {
							blur_this.load(function () {
								Pixastic.process(blur_this[index], "blurfast", {amount:0.5});
							});
						}
					});
			});
        };

        // TODO: find other shortcodes like this design and make it as a component
        var masonry = function() {
        	if(!$('.js-masonry').length) return;

	        function grid() {
	            minigrid({
		            container: '.js-masonry',
		            item: '.js-masonry-item',
		            gutter: 0
	            });
	        }

	        grid();
	        $(window).on('resize', grid);
        };

        return {
         	init : init
        };
    };

})(jQuery);







