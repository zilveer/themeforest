(function($) {

	

    $.fn.TPCarousel = function() {	
			$(this).each(function(){			
				var scroll_ul = $('ul.content',this); // get content list
				$('.tp-carousel-nav').css('display','block');
				
				//calcs
				
				var margin = parseInt($('ul.content li',this).css('margin-left')); // get padding
				var colsize = parseInt($('ul.content li',this).width()); // get column size		
				var elemh = parseInt($('ul.content li',this).height()) + 44 + 30; // get element height (li  height + arrows height)					
				var stepsize = colsize + (margin * 2);																		
				var viewportw = parseInt($(this).width()); // get viewport width
				var scroll_ul_w = 0;	//get total list real width
					$('li',scroll_ul).each(function() {
						scroll_ul_w += parseInt($(this).outerWidth());
					});
				var maxleft = viewportw - scroll_ul_w; // calc maximum left position so we cant scroll further
				
				// style elements
				$(this).css({'height':elemh+'px'});
				scroll_ul.css({'width':'9999px','position':'absolute','left':'0px'});
				$('li',scroll_ul).css({'width':colsize+'px','margin':'0px','clear':'none','padding-left':margin+'px','padding-right':margin+'px'});
			
			
			
			
				//recalc and reapply HEIGHT ONLY on load
				var lastimg = $('ul.content li img',this).last();
				var this_elem = $(this);
				lastimg.load(function(){												
					var elemh = parseInt($('ul.content li',this_elem).height()) + 44 + 30; // get element height (li  height + arrows height)											
					this_elem.css({'height':elemh+'px'});										
				});
		
		
			
		

		
				
				// scroll left			
				$('.tp-carousel-nav .left',this).click(function(){								
					if(parseInt(scroll_ul.css('left')) < 0){
						scroll_ul.animate({'left': '+='+stepsize+'px'}, 400);			
					}
					return false;
				});
				
				
				// scroll right
				$('.tp-carousel-nav .right',this).click(function(){			
					if(scroll_ul_w > viewportw){
						//scroll right only till the end of list
						if(parseInt(scroll_ul.css('left')) >= maxleft){						
							scroll_ul.animate({'left': '-='+stepsize+'px'}, 400);			
						}
					}
					
					return false;
				});
			});
		
    };

	
	

})(jQuery);

