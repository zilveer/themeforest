function refreshContentBlock(){
	// Disable for mobile
	//if(jQuery(window).width() <= 767){
	jQuery('body').append(jQuery('<div class="width-test"></div>'));
	var mediaQuery = parseInt(jQuery('.width-test').css('max-width'), 10);
	jQuery('.width-test').remove();
	if(mediaQuery == 767){
		contentBlockScroll.disable();
		jQuery('.content-block-wrapper-inner').css({'width' : '', 'margin-left' : '', 'transform' : 'none'});
		jQuery('.content-block').css({'width' : '', 'margin-right' : ''});
		return;
	}
	
	// Reset dimensions
	/* if(jQuery(window).width() <= 1000){
		jQuery('.content-block').removeClass('grid_4');
		jQuery('.content-block').addClass('grid_6');
	}else{
		jQuery('.content-block').removeClass('grid_6');
		jQuery('.content-block').addClass('grid_4');
	} */
	jQuery('.content-block-wrapper-inner').css({'width' : ''});
	jQuery('.content-block').css({'width' : '', 'margin-right' : ''});

	// Get new values
	var itemWidth = parseInt(jQuery('.content-block').width());
	var itemMargin = parseInt(jQuery('.content-block').css('margin-right'));
	var totalWidth = (jQuery('.content-block').length) * (itemWidth + itemMargin) - itemMargin;
	
	// Update with new values
	jQuery('.content-block').css({'width' : itemWidth, 'margin-right' : itemMargin});
	jQuery('.content-block:last-child').css({'margin-right' : '0'});
	jQuery('.content-block-wrapper-inner').css({'width' : totalWidth});

	contentBlockScroll.refresh();
	contentBlockScroll.scrollToPage(contentBlockScroll.currPageX, 0, 0);
}
function inactiveArrows(){
	if(currentItem <= 1){
		jQuery('.cb-left').addClass('cb-left-inactive');
	}else{
		jQuery('.cb-left').removeClass('cb-left-inactive');
	}
	if(contentBlockScroll.pagesX.length - 3 <= currentItem){
		jQuery('.cb-right').addClass('cb-right-inactive');
	}else{
		jQuery('.cb-right').removeClass('cb-right-inactive');
	}
}
		
var currentItem = 0;
var startY = 0;
var contentBlockScroll;
jQuery(document).ready(function(){
	var wrapper = jQuery('<div class="content-block-container"><div class="content-block-wrapper"><div class="content-block-wrapper-inner"></div></div></div>');
	jQuery('.content-block').wrapAll(wrapper);
	
	// RTL
	if(jQuery('body').hasClass('rtl')){
		jQuery('.content-block-container').attr('dir', 'ltr');
		jQuery('.content-block').attr('dir', 'rtl');
	}
	
	var DOMElement = jQuery('.content-block-wrapper').get(0);
	if(DOMElement != null){
		jQuery('.content-block-container').prepend('<div class="cb-left"></div>');
		jQuery('.content-block-container').append('<div class="cb-right"></div>');
		
		var arrowsTopPosition = jQuery('.content-block').attr('data-arrows-top-position');
		if(arrowsTopPosition != ''){
			jQuery('.cb-left, .cb-right').css('top', arrowsTopPosition);
		}
		
		/**
		 * Setup iScroll 4
		 * @return {void} Updates contentBlockScroll variable 
		 */
		contentBlockScroll = new iScroll(DOMElement, {
			snap: 'div.content-block',
			bounce: false,
			bounceLock: false,
			momentum: false,
			hScrollbar: false,
			vScrollbar: false,
			hScroll: true,
			vScroll: false,
			snapThreshold: 2,
			wheelAction: 'none',
			onBeforeScrollStart: function(e){
				e.preventDefault();
			},
			onScrollStart: function(){},
			onScrollMove: function(e){},
			onScrollEnd: function(){},
			onRefresh: function(){},
			onDestroy: function(){},
		});

		// Disable drag functionality
		contentBlockScroll.disable();

		// Refresh blocks and arrows
		jQuery(window).resize(function(){
			refreshContentBlock();
		});
		refreshContentBlock();
		inactiveArrows();
		
		// Create controls
		jQuery('.cb-right').on('click', function(){
			if(contentBlockScroll.pagesX.length - 3 <= currentItem){
			}else{
				currentItem = currentItem + 2;
				contentBlockScroll.scrollToPage(currentItem, 0, 300);
				inactiveArrows();
			}
		});
		jQuery('.cb-left').on('click', function(){
			if(currentItem <= 1){
			}else{
				currentItem = currentItem - 2;
				contentBlockScroll.scrollToPage(currentItem, 0, 300);
				inactiveArrows();
			}
		});
		
		// RTL
		if(jQuery('body').hasClass('rtl')){
			contentBlockScroll.scrollToElement(jQuery('.content-block')[jQuery('.content-block').length - 1], 0);
			currentItem = contentBlockScroll.pagesX.length - 2;
			inactiveArrows();
		}
	}
});