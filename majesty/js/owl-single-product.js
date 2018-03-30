(function( $ ) {
   "use strict";
   function syncPosition(el){
		var current = this.currentItem;
		var id = this.$elem.context.id;
		var imgthumb = $('.shop-thumb-slide .thumb-img-slider');
		imgthumb.find(".owl-item").removeClass("current").eq(current).addClass("current");
		if(imgthumb.data("owlCarousel") !== undefined){
			center(current)
		}
	}
	function center(number){
		var thumbImgvisible = $('.shop-thumb-slide .thumb-img-slider').data("owlCarousel").owl.visibleItems;
		var num = number;
		var found = false;
		for(var i in thumbImgvisible){
		  if(num === thumbImgvisible[i]){
			var found = true;
		  }
		}

		if(found===false){
			if(num>thumbImgvisible[thumbImgvisible.length-1]){
				$('.shop-thumb-slide .thumb-img-slider').trigger("owl.goTo", num - thumbImgvisible.length+2)
			} else {
				if( num - 1 === -1 ){
					num = 0;
				}
				$('.shop-thumb-slide .thumb-img-slider').trigger("owl.goTo", num);
			}
		} else if( num === thumbImgvisible[thumbImgvisible.length-1] ){
			$('.shop-thumb-slide .thumb-img-slider').trigger("owl.goTo", thumbImgvisible[1]);
		} else if(num === thumbImgvisible[0]){
			$('.shop-thumb-slide .thumb-img-slider').trigger("owl.goTo", num-1);
		}

	}
    $.fn.shopsinglecarousel = function() {
		if( $('.shop-thumb-slide').length > 0 ) {
			var singImg  = $('.shop-thumb-slide .single-img-slider');
			var thumbImg = $('.shop-thumb-slide .thumb-img-slider');/*.thumbnails*/
			var direction = 'ltr';
			var navtext = ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"];
			if( $('body').hasClass('rtl') ) {
				direction = 'rtl';
				navtext = ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"];
			}
			singImg.owlCarousel({
				direction: direction,
				singleItem : true,
				slideSpeed : 1000,
				navigation: true,
				navigationText:navtext,
				pagination:false,
				responsiveRefreshRate : 200,
				afterAction : syncPosition
			});
			thumbImg.owlCarousel({
				items : 4,
				itemsDesktop      : [1199,4],
				itemsDesktopSmall     : [979,4],
				itemsTablet       : [768,3],
				itemsMobile       : [479,2],
				pagination:false,
				navigation : false,
				navigationText:["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsiveRefreshRate : 100,
				afterInit : function(el){
				  el.find(".owl-item").eq(0).addClass("current");
				}
			});
			thumbImg.on("click", ".owl-item", function(e){
				e.preventDefault();
				var number = $(this).data("owlItem");
				singImg.trigger("owl.goTo",number);
			});
		}
	}
	$(function() {
		$.fn.shopsinglecarousel();
	});
	
})(jQuery);