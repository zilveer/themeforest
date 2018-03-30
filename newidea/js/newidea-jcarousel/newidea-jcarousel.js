/*
 * New Idea Jcarousel
 * Extra by http://themefocus.co
 *
 * Copyright 2012, ThemeFocus
 */
(function($) {
	
	 function newideaJcarouselInit(element, options){
		
		var settings = $.extend({
		'vertical':false,
		'scroll':1,
        'showNumber':3,
		'itemHeight':150,
		'ease':'',
		'time':'fast'
	}, options);
	
		var index = 0;
		var items = $(element).children('.jcarousel-item');
		var bool = false;
		var scrollNumber = settings.itemHeight * settings.scroll;
		
		$(element).wrap('<div class="newidea-jcarousel"></div>');
		$(element).after('<div class="jcarousel-prev jcarousel-btn"></div><div class="jcarousel-next jcarousel-btn"></div>');
		
		$(element).siblings('.jcarousel-btn').click(function(e) {
			if(bool) return false;
            if($(this).hasClass('jcarousel-prev-disabled') || $(this).hasClass('jcarousel-next-disabled')){
				return false;
			}
			bool = true;
			var beforeNumber = $(element).css('top');
			var nextNumber;
			if($(this).hasClass('jcarousel-prev')){
				//prev
				index += -settings.scroll;
				nextNumber = (parseInt(beforeNumber) + scrollNumber);
				$(element).animate({'top':nextNumber + 'px'},settings.time,settings.ease,moveComplete);
			}else{
				//next
				index += settings.scroll;
				nextNumber = (parseInt(beforeNumber) - scrollNumber);
				$(element).animate({'top':nextNumber + 'px'},settings.time,settings.ease,moveComplete);
			}
			
			refreshBtnStatus();
			
        });
		
		function moveComplete(){
			bool = false;
		}
		
		//refresh btn status
		function refreshBtnStatus(){
			if(index <=0){
				$(element).siblings('.jcarousel-prev').removeClass('jcarousel-prev-active');
				if($(element).siblings('.jcarousel-prev').hasClass('jcarousel-prev-disabled')){
					
				}else{
					$(element).siblings('.jcarousel-prev').addClass('jcarousel-prev-disabled');
				}
			}else{
				$(element).siblings('.jcarousel-prev').removeClass('jcarousel-prev-disabled');
				$(element).siblings('.jcarousel-prev').addClass('jcarousel-prev-active');
			}

			if(index + settings.showNumber < items.length){
				$(element).siblings('.jcarousel-next').removeClass('jcarousel-next-disabled');
				if($(element).siblings('.jcarousel-next').hasClass('jcarousel-next-active')){
					
				}else{
					$(element).siblings('.jcarousel-next').addClass('jcarousel-next-active');
				}
			}else{
				$(element).siblings('.jcarousel-next').removeClass('jcarousel-next-active');
				$(element).siblings('.jcarousel-next').addClass('jcarousel-next-disabled');
			}
		}
		
		refreshBtnStatus();
		
	 }
	
	$.fn.newideaJcarousel = function(options){
		 return this.each(function(key, value){ newideaJcarouselInit(this, options)});
	}


})(jQuery);