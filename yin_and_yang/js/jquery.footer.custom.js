/*-----------------------------------------------------------------------------------*/
/*	Custom Footer JS
/*-----------------------------------------------------------------------------------*/

jQuery.fn.topLink = function(settings) {
	settings = jQuery.extend({
		min: 1,
		fadeSpeed: 200,
		ieOffset: 50
	}, settings);
	return this.each(function() {
		//listen for scroll
		var el = jQuery(this);
		el.css('display','none'); //in case the user forgot
		jQuery(window).scroll(function() {
			if(!jQuery.support.hrefNormalized) {
				el.css({
					'position': 'absolute',
					'top': jQuery(window).scrollTop() + jQuery(window).height() - settings.ieOffset
				});
			}
			if(jQuery(window).scrollTop() >= settings.min)
			{
				el.fadeIn(settings.fadeSpeed);
			}
			else
			{
				el.fadeOut(settings.fadeSpeed);
			}
		});
	});
};

(function($) {
	"use strict";
		
	/*-----------------------------------------------------------------------------------*/
	/* Lavalamp Navigation effects
	/*-----------------------------------------------------------------------------------*/
	
	// Activate lavalamp only on non-touch devices    	
	if (jQuery().lavaLamp && !Modernizr.touch) {
		
		$('.sub-menu li').addClass('noLava'); // Disable the lavalamp effect on drop-down menu links 
		$('.current-menu-item, .current-menu-ancestor, .current_page_parent').addClass('selectedLava');
		
	    WebFont.load({
	    	custom: {
	        	families: ['Lato:n7']
	      	},
		  	active: function() {
			  	// Activate the lavalamp effect on the menu once the custom font has been loaded
	        	$('.menu-container > ul').lavaLamp({ fx: 'easeOutBack', speed: 700, returnDelay: 800 });
	      	}
	    });
  
	}

		
	/*-----------------------------------------------------------------------------------*/
	/*	Prevent document scrolling, when the footer widgets slideout is open, 
	/*	but enable scrolling within the slideout itself.
	/*-----------------------------------------------------------------------------------*/
	
	$("#scroller").bind('touchstart', function(ev) {
	    if ($(this).scrollTop() === 0) $(this).scrollTop(1);
	    var scrollTop = document.getElementById('scroller').scrollTop;
	    var scrollHeight = document.getElementById('scroller').scrollHeight;
	    var offsetHeight = document.getElementById('scroller').offsetHeight;
	    var contentHeight = scrollHeight - offsetHeight;
	    if (contentHeight == scrollTop) $(this).scrollTop(scrollTop-1);
	});
	
	
	/*-----------------------------------------------------------------------------------*/
	/* jQuery Transit plugin
	/*-----------------------------------------------------------------------------------*/
	
	// Delegate .transition() calls to .animate() if the browser can't do CSS transitions.
	if (!$.support.transition) {
		$.fn.transition = $.fn.animate;
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Isotope
	/*-----------------------------------------------------------------------------------*/
	
	var $portfolioContainer = $('#isotope-trigger');
	var $filter = $('.portfolio-filter');
	var $filterBtn = $('.filter-btn');
	var $filterLiElements = $('.portfolio-filter li');
	var $filterLinks = $('.portfolio-filter .filter-link');
	var $window = $(window);	
	
	/* Display the filter categories, or hide them */
	function toggleFilter() {
		$(this).toggleClass('filter-active');
		
		if(Modernizr.csstransitions) { 
			if (!$filter.hasClass('stop')) { // Continue if the filter categories don't have a class "stop"
				$filter.show();
	        	$filter.stop().transition({ opacity: 1, y: '0px' }, 350).addClass('stop'); // Show the categories and add the class "stop"
			} else { 
		        $filter.transition({ opacity: 0, y: '20px' }, 350, function () { $(this).hide(); }).removeClass('stop'); // Hide the categories and remove "stop"
			}
		}
		else {
			if($(this).hasClass('filter-active')) {
				// Show	
				$filter.show();
				$filter.stop().animate({ opacity: 1 }, 350);	
			}
			else {
				// Hide
				$filter.stop().animate({ opacity: 0 }, 350, function () { $(this).hide(); });
			}
		}
	}
	
	$filterBtn.click(toggleFilter);
	
	function filterPortfolio(e) {	
		$filterLiElements.removeClass('active'); 
		$(this).parent().addClass('active');
		
		/* filter items with an isotope filter animation, when one of the filter links are clicked, under the condition that we are not on a taxonomy template */
		if(!$('body').hasClass('tax-portfolio_category')) {	
			e.preventDefault();
			
			var selector = $(this).attr('data-filter');
			$portfolioContainer.isotope({ filter: selector });
		}
	}
	
	$filterLinks.click(filterPortfolio);
	
	function initIsotope() {
		$portfolioContainer.isotope({
			itemSelector: '.isotope-item',
			transitionDuration: '0.47s',
			masonry: {
                columnWidth: '.onioneye-grid-sizer'
			}
        });
	}
	
	/* Initialize Isotope */ 
	$portfolioContainer.imagesLoaded(function() {
		initIsotope();
        
        $window.on('resize', function() {        	
        	initIsotope();
        });
    });
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Superfish Drop-Down Menu
	/*-----------------------------------------------------------------------------------*/
	
	if ( jQuery().superfish ) {
		
		$('.menu-container ul').superfish({
			delay: 700,
			animation: { opacity: 'show', height: 'show' },
			speed: 250,
			speedOut: 150,
			autoArrows: false,
			dropShadows: false
		}); 
		
		$('.mobile-menu').superfish({
			delay: 700,
			animation: { opacity: 'show', height: 'show' },
			speed: 250,
			speedOut: 250,
			autoArrows: false,
			dropShadows: false
		}); 
		
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Drop-down Page
	/*-----------------------------------------------------------------------------------*/
		
	var $dropDownWrapper = $('#dropdown-wrapper');
	var $dropDownBtn = $('#dropdown-trigger');
	
	function toggleDropDownPage() {
		var pageHeight = $('.dropdown-page').outerHeight(true); // Get the height, while including the top and bottom padding of the drop-down page
		var wrapperHeight = $dropDownWrapper.height();
			
		// Animate the height of the wrapper, depending on the current state (visible or not)			
		if( wrapperHeight == 0 ) {
			$('.drop-down-arrows').addClass('arrow-up');
			
			if(Modernizr.csstransitions) {
				$dropDownWrapper.transition({ height: pageHeight }, 500, 'cubic-bezier(0.645, 0.045, 0.355, 1.000)', function() {
					$(this).css('height', 'auto');
				});	
			}
			else {
				$dropDownWrapper.animate({ height: pageHeight }, 500, 'cubic-bezier(0.645, 0.045, 0.355, 1.000)', function() {
					$(this).css('height', 'auto');	
				});	
			}
		}
		else {
			$('.drop-down-arrows').removeClass('arrow-up');
			
			if(Modernizr.csstransitions) {
				$dropDownWrapper.height($('.dropdown-page').outerHeight(true));
				$dropDownWrapper.transition({ height: 0 }, 500, 'cubic-bezier(0.645, 0.045, 0.355, 1.000)');	
			}
			else {
				$dropDownWrapper.animate({ height: 0 }, 500, 'cubic-bezier(0.645, 0.045, 0.355, 1.000)');	
			}
		}
		
		$('html, body').animate({ scrollTop: 0 }, 200, 'easeOutCubic');
	}
	
	if ($dropDownWrapper.length) { 
		$dropDownBtn.click(toggleDropDownPage);		
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Footer Overlay Widgets
	/*-----------------------------------------------------------------------------------*/
	
	var $overlayHandle = $('.overlay-handle');
	var $overlayContainer = $('.slide-out-div');
	var $closeBtn = $('.close-slide-out');
	var $toTopBtn = $('#back-to-top');	
		
	function toggleFooterOverlay(e) {
		if($overlayContainer.hasClass('inactive')) {
			/* Show the footer overlay */ 
			
			$overlayContainer.transition({ y: 0 }, 700, 'cubic-bezier(0.645, 0.045, 0.355, 1.000)', function() {
				$(this).addClass('scroll-enabled'); // Make the overlay scrollable
				
				if(Modernizr.mq('only screen and (max-width: 960px), only screen and (max-height: 600px)')) {
					$overlayHandle.css('opacity', 0);
					$toTopBtn.css('opacity', 0);
				}
			});  
			
			if(Modernizr.mq('only screen and (max-width: 960px), only screen and (max-height: 600px)')) {
				// Show the close (x) button on smaller screen sizes
				$closeBtn.show();
				$closeBtn.transition({ opacity: .7, rotate: '180deg', delay: 400 }, 400, 'cubic-bezier(0.645, 0.045, 0.355, 1.000)');
			}
			
			$overlayContainer.removeClass('inactive').addClass('active');
		}
		else {
			/* Hide the footer overlay */
			
			$closeBtn.transition({ opacity: 0, rotate: '0deg' }, 250, function () { $(this).hide(); });

			$overlayContainer.transition({ y: '100%' }, 500, 'cubic-bezier(0.645, 0.045, 0.355, 1.000)', function() {
				$(this).scrollTop(0); // Reset the scrollbar to its initial position inside the overlay
				$(this).removeClass('scroll-enabled'); // Disable the scrolling inside the overlay 
				$(this).find('input').trigger('blur'); // Close mobile keyboard if open	
				
				if($overlayHandle.css('opacity') !== 0 || $toTopBtn.css('opacity') !== 0) {
					// Hide the overlay toggle button and the back to top button on close
					$overlayHandle.transition({ opacity: 1 }, 350);
					$toTopBtn.transition({ opacity: 1 }, 350);
				}
			});
			$overlayContainer.removeClass('active').addClass('inactive');
		}
	}
	
	if ($overlayHandle.length) { 
		$overlayHandle.click(toggleFooterOverlay);	
		$closeBtn.click(toggleFooterOverlay);
	}
		
	
	/*-----------------------------------------------------------------------------------*/
	/*	Scroll back to top
	/*-----------------------------------------------------------------------------------*/
	
	var $toTopBtn = $('#back-to-top');
	
	$toTopBtn.topLink({
		min: 200,
		fadeSpeed: 400
	});
	
	//smoothscroll
	$toTopBtn.click(function(e) {
		e.preventDefault();
		$('html, body').animate({ scrollTop: 0 }, 700, 'easeOutCubic');
	});
	

	/*-----------------------------------------------------------------------------------*/
	/*	Responsive Videos
	/*-----------------------------------------------------------------------------------*/
	
	$('.main-content, .tabbed-content, .single-portfolio-item').fitVids(); 
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Comment Form Placeholders for IE9
	/*-----------------------------------------------------------------------------------*/
		
	if ($('html').hasClass('ie9')) {
		
		var authorPlaceholder = $('#commentform #author').attr('placeholder');
		var emailPlaceholder = $('#commentform #email').attr('placeholder');
		var urlPlaceholder = $('#commentform #url').attr('placeholder');
		var commentPlaceholder = $('#commentform #comment').attr('placeholder');		
				
		$('#commentform #author').val(authorPlaceholder);
		$('#commentform #email').val(emailPlaceholder);
		$('#commentform #url').val(urlPlaceholder);
		$('#commentform #comment').val(commentPlaceholder);
		
		$('#commentform input, #commentform textarea').focus(function() {
			if($(this).attr('id') == 'author') {
				if ($(this).val() == authorPlaceholder) { $(this).val(''); }
			}
			else if($(this).attr('id') == 'email') {
				if ($(this).val() == emailPlaceholder) { $(this).val(''); }
			}
			else if($(this).attr('id') == 'url') {
				if ($(this).val() == urlPlaceholder) { $(this).val(''); }
			}
			else if($(this).attr('id') == 'comment') {
				if ($(this).val() == commentPlaceholder) { $(this).val(''); }
			}
		});
		
		$('#commentform input, #commentform textarea').blur(function() {
			if($(this).attr('id') == 'author') {
				if ($(this).val() == '') { $(this).val(authorPlaceholder); }
			}		
			else if($(this).attr('id') == 'email') {
				if ($(this).val() == '') { $(this).val(emailPlaceholder); }
			}
			else if($(this).attr('id') == 'url') {
				if ($(this).val() == '') { $(this).val(urlPlaceholder); }
			}
			else if($(this).attr('id') == 'comment') {
				if ($(this).val() == '') { $(this).val(commentPlaceholder); }
			}
		});
	
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Fix iOS Safari and IE9+ buggy viewport units
	/*-----------------------------------------------------------------------------------*/

	window.viewportUnitsBuggyfill.init();
	
	
})( jQuery );