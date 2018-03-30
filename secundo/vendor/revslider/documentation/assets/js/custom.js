(function($) {
	
	var win, 
	hash,
	images, 
	winHeight,
	sections = [],
	firstLoad = true,
	secs = $('section'),
	sectionLength = secs.length,
	nav = $('.nav li').on('click', updateNav);
	secs.each(function(i) {sections[i] = $(this);});
	
	$(document).ready(function() {
        
		images = [];
		$('img').each(function(i) {images[i] = $(this);});
		
		win = $(window).on('hashchange', updateNav).on('scroll', scrolled).on('resize', checkSize);
		updateNav();
		checkSize();
		
    });
	
	function checkSize() {
	
		winHeight = win.height();
		scrolled();
		
	}
	
	// combine lazy load and nav sniffer into the same function
	function scrolled() {
		
		var scrTop = win.scrollTop();
		if(!scrTop) return;
		
		/* lazy load */
		var len = images.length, i;
		if(len) {
			
			var img, offset, 
			index, high, toPop = [];
			
			for(i = 0 ; i < len; i++) {
				
				img = images[i];
				high = img.attr('height');
				offset = img.offset().top;
				
				if(offset <= scrTop + winHeight && offset + parseInt(high, 10) >= scrTop) {
					
					var par = img.parent().css({width: img.attr('width'), height: high}).addClass('img-loading'),
					newImg = $('<img class="img-new img-replace" />').data('par', par).one('load', loaded).insertAfter(img);
					newImg.attr('src', img.attr('data-src'));
					toPop[toPop.length] = img;
					
				}
				
			}
			
			len = toPop.length;
			for(i = 0; i < len; i++) {
				
				index = images.indexOf(toPop[i]);
				if(index !== -1) images.splice(index, 1);
				
			}
			
		}
		
		/* navigation */
		var section, 
		height,
		tops;
		nav.removeClass('active');
		
		for(i = 0; i < sectionLength; i++) {
			
			section = sections[i];
			height = section.outerHeight(true);
			tops = section.offset().top;
			
			if(tops - 300 <= scrTop && tops + height - 300 >= scrTop) {
				
				$('.nav a[href=#' + section.attr('id') + ']').parent().addClass('active');
				break;
				
			}
			
		}
		
	}
	
	function loaded() {
		
		var $this = $(this);
		$this.data('par').removeClass('img-loading');
		$this.removeData('par').removeClass('img-replace');
		
	}
	
	function updateNav(event) {
		
		nav.removeClass('active');
		if(event && event.type === 'click') {

			$(this).addClass('active');
			
		}
		else {
		
			hash = location.hash;
			if(hash) {
				
				$('.nav a[href=' + hash + ']').parent().addClass('active');
				
				if(!firstLoad) {
					updateSection();
				}
				else {
					firstLoad = false;
					setTimeout(updateSection, 500);
				}
				
			}
			
		}
		
		scrolled();
		
	}
	
	function updateSection() {
	
		$(hash)[0].scrollIntoView();
		
	}
	
})(jQuery);