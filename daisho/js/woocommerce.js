/**
 * Contains functions necessary to run Isotope.
 *
 * @TODO: On variable product pages variations can have separate images
 *        and WooCommerce updates the first product image with variation
 *        image but the scripts don't fully consider that. It partially
 *        works but it requires further adjustments.
 */
( function( $ ) {

	'use strict';

	$(document).ready(function(){
		var sync1 = $(".images-inner");
		var sync2 = $(".thumbnails");

		sync1.owlCarousel({
			autoHeight: true,
			singleItem: true,
			navigation: true,
			pagination: false,
			afterAction: syncPosition,
			responsiveRefreshRate : 200
		});

		sync2.owlCarousel({
			margin: 5,
			items: 4,
			itemsDesktop: [1199,4],
			itemsDesktopSmall: [979,3],
			itemsTablet: [768,4],
			itemsMobile: [479,3],
			navigation: false,
			pagination:false,
			responsiveRefreshRate : 100,
			afterInit : function(el){
				el.find(".owl-item").eq(0).addClass("synced");
			}
		});

		function syncPosition(el){
			var current = this.currentItem;
			sync2.find(".owl-item").removeClass("synced").eq(current).addClass("synced");
			if(sync2.data("owlCarousel") !== undefined){
				center(current)
			}
		}

		sync2.on("click", ".owl-item", function(e){
			e.preventDefault();
			var number = $(this).data("owlItem");
			sync1.trigger("owl.goTo",number);
		});

		function center(number){
			var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
			var num = number;
			var found = false;
			for(var i in sync2visible){
			if(num === sync2visible[i]){
				var found = true;
			}
		}

		if(found===false){
			if(num>sync2visible[sync2visible.length-1]){
			sync2.trigger("owl.goTo", num - sync2visible.length+2)
			}else{
				if(num - 1 === -1){
					num = 0;
				}
				sync2.trigger("owl.goTo", num);
			}
			} else if(num === sync2visible[sync2visible.length-1]){
				sync2.trigger("owl.goTo", sync2visible[1])
			} else if(num === sync2visible[0]){
				sync2.trigger("owl.goTo", num-1)
			}

		}

	});

	$('.woocommerce-page .product .images .images-inner .item').each(function(){
		var items = [];
		var nodes = [];
		$(this).nextAll().andSelf().each(function(){
			nodes.push(this);
		});
		$(this).prevAll().each(function(){
			nodes.push(this);
		});
		var $nodes = $(nodes);
		$nodes.each(function(){
			var imageSrc = $(this).attr('data-image-src');
			items[items.length] = { src: imageSrc };
		});
		var itemsLength = items.length;

		$(this).find('img').magnificPopup({
			callbacks: {
				beforeOpen: function(){
					if(this.items.length > itemsLength){
						this.items.shift();
					}
					if($(this.ev[0]).attr('data-o_src') && $(this.ev[0]).attr('data-o_src') != $(this.ev[0]).attr('src')){
						this.items.unshift({
							src: $(this.ev[0]).attr('src')
						});
						this.updateItemHTML();
					}
				}
			},
			closeOnContentClick: true,
			gallery: {
				enabled: true,
				navigateByImgClick: false
			},
			items: items,
			image: {
				verticalFit: false
			},
			type: 'image',
			showCloseBtn: false
		});
	});

} )( jQuery );
