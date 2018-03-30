/*-----------------------------------------------------------------------------------*/
/*	Custom Header JS
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function($) {
	"use strict";
	
	/*-----------------------------------------------------------------------------------*/
	/*	Portfolio Item Ajax Call
	/*-----------------------------------------------------------------------------------*/
	
	var current_post_id = '';
	var $itemWrapper = $('.portfolio-item-wrapper');
	var $mainContent = $('.main-content');
	   		
   	var getProjectViaAjax = function(e) {
	   	
	   	if($(this).hasClass('active-thumbnail-link')) 
	   		return false;
	   	
	   	showLoaderImg();
	   		   	
   		var post_id = $(this).attr('data-post_id');
   		current_post_id = post_id;
      	var $prev = $('.project-link[data-post_id="' + post_id + '"]' ).parent().prev('.portfolio-item');
      	var $next = $('.project-link[data-post_id="' + post_id + '"]' ).parent().next('.portfolio-item');
      	var prev_item_id = '';
      	var next_item_id = '';
      	
      	// Get the id's of previous and next projects
      	if($prev.length && $next.length) {
      		prev_item_id = $prev.find('.project-link').attr('data-post_id');
      		next_item_id = $next.find('.project-link').attr('data-post_id');
      	}
      	else if($prev.length) {
      		prev_item_id = $prev.find('.project-link').attr('data-post_id');
      	}
      	else if($next.length) {
      		next_item_id = $next.find('.project-link').attr('data-post_id');
      	}
      	
      	$('.single-img-loader').css('opacity', 1);
	
		closeProject();
			
      	$.ajax({
        	type : "post",
        	context: this,
         	dataType : "json",
         	url : headJS.ajaxurl,
         	data : { action: "eq_get_ajax_project", post_id : post_id, prev_post_id : prev_item_id, next_post_id : next_item_id},
         	beforeSend: function() {
         		$('.project-link[data-post_id="' + post_id + '"]').addClass('active-thumbnail-link'); // Activate the overlay over the current project
		 		
				$('html, body').animate({ 
			 		scrollTop: $itemWrapper.offset().top - parseInt($mainContent.css('padding-top'), 10)
			 	}, 300, 'easeOutCubic');		
         	},
         	success: function(response) {
	         	/* Will be called when all the animations on the itemWrapper finish; i.e. when the previous item finishes closing. */
	         	$itemWrapper.promise().done(function() {
	            	$itemWrapper.html(response['html']);
	            	$itemWrapper.find('.single-portfolio-item').css('opacity', 0).fitVids();
	            	            	
	            	singleImageLoaded(); // Show the single image and remove the loading indicator gif
	            	
	            	var $flexSlider = $('.oy-flexslider');
	            	    	
			    	if($flexSlider.length) {				
						// Find and set the proper height for the slider, before the slider starts.									
						if($flexSlider.find('img:first').attr('height')) {
							$flexSlider.height(getInitialFlexSliderHeight($flexSlider.find('img:first').attr('width'), $flexSlider.find('img:first').attr('height')));	
						}
					}
				});
         	},
         	complete: function() { 
	         	/* Will be called when all the animations on the itemWrapper finish; i.e. when the previous item finishes closing. */
	         	$itemWrapper.promise().done(function() {   	
			    	sliderImagesLoaded(); // Initialize the slider after all images have been loaded and remove the loading indicator gif
					openProject();
					initPortfolioNav();				
					hideLoaderImg();
					$itemWrapper.find('.single-portfolio-item').stop().animate({ opacity: 1 }, 600);
				});
			}
      	});
      	
      	e.preventDefault();
   		
   	}
	
	$('.project-link').click(getProjectViaAjax);
	
	function openProject() {
						
		var projectHeight = $('.single-portfolio-item').outerHeight(true);
				
		if( $itemWrapper.hasClass( 'closed-project' ) ) {
			$itemWrapper.removeClass( 'closed-project' );	
		}					
								
		$itemWrapper.animate({
			height: projectHeight
		}, 800, 'easeOutQuart', function() {
			$(this).css({ 'overflow': 'visible', 'height': 'auto' });
		});
		
	} 
	  	
   	function closeProject() {
   		
   		var $clickedObject = $(this);
   		
   		// If the project was closed by clicking the close (x) button, add the "closed-project" class to the div wrapper that holds the ajax projects, so that the portfolio filter
   		// doesn't activate the overlay for the closed project, when the filtering animation ends. 
   		if( $clickedObject.hasClass('close-current-post') ) {
   			$itemWrapper.addClass('closed-project');
   		}
   		
   		// Remove the overlay from the current project that is being closed
   		$('.active-thumbnail-link').removeClass('active-thumbnail-link');
					
		$itemWrapper.find('.single-portfolio-item').stop().animate({
			opacity: 0
		}, 200);
			
		$itemWrapper.stop().animate({
			height: 0
		}, 600, 'easeOutQuart', function() {
			$(this).css('overflow', 'hidden');
			
			if( $clickedObject.hasClass('close-current-post') ) {
   				$(this).empty();
   			}
		});
		
	}

	
	/*-----------------------------------------------------------------------------------*/
	/*	Portfolio Slider
	/*-----------------------------------------------------------------------------------*/
	
	function initSlider() {
   		
	   	if( jQuery().flexslider ) {
			$('.oy-flexslider').flexslider({
				namespace: 'oy-flex-',
				selector: '.oy-slides > li',
				slideshow: false,
				animationSpeed: 690,
				easing: 'easeOutCubic',
				smoothHeight: true,
				useCSS: true,
				after: function() {
					BackgroundCheck.refresh();
				},
				start: function(slider) {					
					// Show the next slide when the current slide (image) is clicked.
					$('.oy-slides li img').click(function(event){
				        event.preventDefault();
				        slider.flexAnimate(slider.getTarget("next"));
				    });	
				    
				    initBgCheck();
				}
			});
		}
		
	}
	
	function sliderImagesLoaded() {
		if($('.oy-flexslider').length) {				
			$('.oy-flexslider').find('img').imagesLoaded(function() { 
				initSlider(); 
				$('.oy-flex-img-loader').stop().animate({ opacity: 0 }, 500); 
			});	
		}
	}
	
	function getInitialFlexSliderHeight(width, height) {
		var imgWidth = Math.abs(width);
		var imgHeight = Math.abs(height);
		var contentWidth = $('.metabox-media-files').outerWidth();
	    
	    if(imgWidth > contentWidth) { 
	    	return Math.round(contentWidth / (imgWidth / imgHeight));
	    } 
	    else {
		    return Math.round(imgHeight);
	    }
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Project Loader 
	/*-----------------------------------------------------------------------------------*/
	
	var $overlayLoader = $('.overlay-loader');
	
	function showLoaderImg() {
		$overlayLoader.css('visibility', 'visible');
		$overlayLoader.fadeIn(500);
	}
	function hideLoaderImg() {
		$overlayLoader.fadeOut(500);
	}
	
	$('.pager a').click(showLoaderImg);
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Background Check
	/*-----------------------------------------------------------------------------------*/
	
	function initBgCheck() {
		BackgroundCheck.init({
			targets: '.oy-flex-prev, .oy-flex-next, .oy-flex-control-paging',
			images: '.oy-slider-img'
		});
	}
   	
   	
   	/*-----------------------------------------------------------------------------------*/
	/*	Portfolio Navigation
	/*-----------------------------------------------------------------------------------*/
	
	function initPortfolioNav() {
		$('.prev-portfolio-post, .next-portfolio-post').click(getProjectViaAjax);
		$('.prev-portfolio-post, .next-portfolio-post').click(showLoaderImg);
		$('.close-post').click(closeProject);
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Single portfolio image
	/*-----------------------------------------------------------------------------------*/
	
	function singleImageLoaded() {
		$('.metabox-media-files').imagesLoaded(function() {  		
    		$('.single-img-container').stop().animate({ opacity: 1 }, 500); 
    		$('.single-img-loader').stop().animate({ opacity: 0 }, 500); 
    	});
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Initialize all necessary portfolio elements in the single portfolio view
	/*-----------------------------------------------------------------------------------*/
	
	if($('body').hasClass('single-portfolio')) {
		initPortfolioNav();
		singleImageLoaded();
		sliderImagesLoaded();
	}
	
	
});