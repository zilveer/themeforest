/*
 * jQuery Orbit Plugin 1.2.3
 * www.ZURB.com/playground
 * Copyright 2010, ZURB
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
*/


(function($) {

    $.fn.orbit = function(options) {

        //Defaults to extend options
        var defaults = {
			width: 940,                         //width of the images
			height: 250,                        //height of the images
			thumbWidth: 80,                     //width of the thumbnails
			thumbHeight: 60,                    //height of the thumbnails
			thumbOffsetX: 30,                    //width of the image container
            animation: 'fade', 		// fade, horizontal-slide, vertical-slide, horizontal-push
            animationSpeed: 600, 				// how fast animtions are
            timer: false, 						// true or false to have the timer
            advanceSpeed: 4000, 				// if timer is enabled, time between transitions 
            pauseOnHover: false, 				// if you hover pauses the slider
            startClockOnMouseOut: false, 		// if clock should start on MouseOut
            startClockOnMouseOutAfter: 1000, 	// how long after MouseOut should the timer start again
            directionalNav: true, 				// manual advancing directional navs
            captions: true, 					// do you want captions?
            captionAnimation: 'fade', 			// fade, slideOpen, none
            captionAnimationSpeed: 600, 		// if so how quickly should they animate in
            afterSlideChange: function(){} 		// empty function 
     	};  
        
        //Extend those options
        var options = $.extend(defaults, options); 
	
        return this.each(function() {
        
// ==============
// ! SETUP   
// ==============
            //Global Variables
            var activeSlide = 0,
			    prevActiveSlide = 0,
            	numberSlides = 0,
				counter = 0,
				thumbXCounter = 0,
            	locked,
				thumbContainerWidth = 0,
				thumbContainerMaskWidth = options.width - 180;
				images = [];
				            
            //Initialize
            var orbit = $(this).addClass('orbit'),         
            	orbitWrapper = orbit.wrap('<div class="orbit-wrapper" />').parent();
			orbitWrapper.width(options.width).height(options.height)
            orbit.add(options.width).width(options.width).height(options.height);
			
			orbit.children().hide();
	    	         
            //Collect all slides and set slider size of largest image
            var slides = orbit.children('img, a, div');
            slides.each(function() {
                var img;
				if($(this).is('img')) { img = $(this) }
				else { img = $(this).find('img:first') }
				
				images[numberSlides] = 	img.get(0).src;
				thumbContainerWidth += options.thumbWidth + options.thumbOffsetX;
                numberSlides++;
            });
			
			thumbContainerWidth -= options.thumbOffsetX;
			orbit.prepend("<img src='"+images[0]+"' width="+options.width+" style='display: block;' class='orbit-first-image' /><img src='"+images[0]+"' width="+options.width+" style='display: block;' class='orbit-second-image' />");
            
			//Animation locking functions
            function unlock() {
                locked = false;
            }
            function lock() { 
                locked = true;
            }
            
            //If there is only a single slide remove nav, timer and bullets
            if(slides.length == 1) {
            	options.directionalNav = false;
            	options.timer = false;
            }
            
// ==============
// ! TIMER   
// ==============

            //Timer Execution
            function startClock() {
            	if(!options.timer  || options.timer == 'false') { 
            		return false;
            	//if timer is hidden, don't need to do crazy calculations
            	} else if(timer.is(':hidden')) {
		            clock = setInterval(function(e){
						shift("next");  
		            }, options.advanceSpeed);            		
		        //if timer is visible and working, let's do some math
            	} else {
		            timerRunning = true;
		            pause.removeClass('active')
		            clock = setInterval(function(e){
		                var degreeCSS = "rotate("+degrees+"deg)"
		                degrees += 2
		                rotator.css({ 
		                    "-webkit-transform": degreeCSS,
		                    "-moz-transform": degreeCSS,
		                    "-o-transform": degreeCSS
		                });
		                if(degrees > 180) {
		                    rotator.addClass('move');
		                    mask.addClass('move');
		                }
		                if(degrees > 360) {
		                    rotator.removeClass('move');
		                    mask.removeClass('move');
		                    degrees = 0;
		                    shift("next");
		                }
		            }, options.advanceSpeed/180);
				}
	        }
	        function stopClock() {
	        	if(!options.timer || options.timer == 'false') { return false; } else {
		            timerRunning = false;
		            clearInterval(clock);
		            pause.addClass('active');
				}
	        }  
            
            //Timer Setup
            if(options.timer) {         	
                var timerHTML = '<div class="timer"><span class="mask"><span class="rotator"></span></span><span class="pause"></span></div>'
                orbitWrapper.append(timerHTML);
                var timer = $('div.timer'),
                	timerRunning;
                if(timer.length != 0) {
                    var rotator = $('div.timer span.rotator'),
                    	mask = $('div.timer span.mask'),
                    	pause = $('div.timer span.pause'),
                    	degrees = 0,
                    	clock; 
                    startClock();
                    timer.click(function() {
                        if(!timerRunning) {
                            startClock();
                        } else { 
                            stopClock();
                        }
                    });
                    if(options.startClockOnMouseOut){
                        var outTimer;
                        orbitWrapper.mouseleave(function() {
                            outTimer = setTimeout(function() {
                                if(!timerRunning){
                                    startClock();
                                }
                            }, options.startClockOnMouseOutAfter)
                        })
                        orbitWrapper.mouseenter(function() {
                            clearTimeout(outTimer);
                        })
                    }
                }
            }  
	        
	        //Pause Timer on hover
	        if(options.pauseOnHover) {
		        orbitWrapper.mouseenter(function() {
		        	stopClock(); 
		        });
		   	}
            
// ==============
// ! CAPTIONS   
// ==============
                     
            //Caption Setup
            if(options.captions) {
                var captionHTML = '<div class="orbit-caption"></div>';
                orbitWrapper.append(captionHTML);
                var caption = orbitWrapper.children('.orbit-caption');
            	setCaption();
            }
			
			//Caption Execution
            function setCaption() {
            	if(!options.captions || options.captions =="false") {
            		return false; 
            	} else {
	            	var _captionLocation = slides.eq(activeSlide).data('caption'); //get ID from rel tag on image
	            		_captionHTML = $(_captionLocation).html(); //get HTML from the matching HTML entity            		
	            	//Set HTML for the caption if it exists
	            	if(_captionHTML) {
	            		caption
		            		.attr('id',_captionLocation) // Add ID caption
		                	.html(_captionHTML); // Change HTML in Caption 
		                //Animations for Caption entrances
		             	if(options.captionAnimation == 'none') {
		             		caption.show();
		             	}
		             	if(options.captionAnimation == 'fade') {
		             		caption.fadeIn(options.captionAnimationSpeed);
		             	}
		             	if(options.captionAnimation == 'slideOpen') {
		             		caption.slideDown(options.captionAnimationSpeed);
		             	}
	            	} else {
	            		//Animations for Caption exits
	            		if(options.captionAnimation == 'none') {
		             		caption.hide();
		             	}
		             	if(options.captionAnimation == 'fade') {
		             		caption.fadeOut(options.captionAnimationSpeed);
		             	}
		             	if(options.captionAnimation == 'slideOpen') {
		             		caption.slideUp(options.captionAnimationSpeed);
		             	}
	            	}
				}
            }
            
// ==================
// ! DIRECTIONAL NAV   
// ==================

            //DirectionalNav { rightButton --> shift("next"), leftButton --> shift("prev");
            if(options.directionalNav) {
            	if(options.directionalNav == "false") { return false; }
                var directionalNavHTML = '<div class="slider-nav"></div>';
				$(directionalNavHTML).css('top', options.height);
                orbitWrapper.append(directionalNavHTML);
				if(thumbContainerWidth > thumbContainerMaskWidth) {
					orbitWrapper.children('.slider-nav').append('<a href="" class="right"></a><a href="" class="left"></a>');
                var leftBtn = orbitWrapper.children('div.slider-nav').children('a.left'),
                	rightBtn = orbitWrapper.children('div.slider-nav').children('a.right');
                leftBtn.click(function() { 
                    stopClock();
					if(locked || orbitWrapper.find('.orbit-thumbnails').position().left >= 0) { return false }
					lock();
					thumbXCounter += options.thumbWidth+options.thumbOffsetX;
					orbitWrapper.find('.orbit-thumbnails').animate({'left': '+='+(options.thumbWidth+options.thumbOffsetX)}, 300, unlock);
					orbitWrapper.find('.orbit-active-arrow').stop().animate({'left': '+='+(options.thumbWidth+options.thumbOffsetX)}, 300);
					return false;
                });
                rightBtn.click(function() {
                    stopClock();
					var thumbnailsX = orbitWrapper.find('.orbit-thumbnails').position().left-10;
					var excessWidth = (orbitWrapper.find('.orbit-thumbnails-container').width())-(slides.length*(options.thumbWidth+options.thumbOffsetX));
					if(locked || thumbnailsX <= excessWidth) { return false }
					lock();
					thumbXCounter -= options.thumbWidth+options.thumbOffsetX;
					orbitWrapper.find('.orbit-thumbnails').animate({'left': '-='+(options.thumbWidth+options.thumbOffsetX)}, 300, unlock);
					orbitWrapper.find('.orbit-active-arrow').stop().animate({'left': '-='+(options.thumbWidth+options.thumbOffsetX)}, 300);
					return false;
                });
				}
            }
            
// ==================
// ! THUMB NAV   
// ==================

			var thumbnails = "<div class='orbit-thumbnails-container' style='width:"+(options.width-180)+"px;'><div class='orbit-active-arrow'></div><ul class='orbit-thumbnails clearfix'></ul></div>";
			orbitWrapper.children('div.slider-nav').append(thumbnails);
			
			for(i=0; i<numberSlides; i++) {
				var	thumb = slides.eq(i).data('thumb');
				var liMarkup = $("<li style='height: "+(options.thumbHeight)+"px; left: "+(i*(options.thumbOffsetX+options.thumbWidth))+"px;'><div style='width:"+options.thumbWidth+"px; height:"+options.thumbHeight+"px;'><img src='"+thumb+"' width="+(options.thumbWidth)+" /></div></li>");
				
				orbitWrapper.find('.orbit-thumbnails').append(liMarkup);
				liMarkup.data('index',i);
				
				$(liMarkup).hover(
				  function() { 
					  $(this).toggleClass('orbit-thumbnail-hover');
				  },
				  function() {
					   $(this).toggleClass('orbit-thumbnail-hover');
				  }
				);
				
				liMarkup.click(function() {
					stopClock();
					shift($(this).data('index'));
				});
			}
            
        	function setActiveThumb() {
				orbitWrapper.find('.orbit-active-arrow:hidden').css('display', 'block');
				orbitWrapper.find('.orbit-active-arrow').stop().animate({'left': orbitWrapper.find('.orbit-thumbnails li').eq(activeSlide).position().left + options.thumbWidth*0.5 + thumbXCounter}, 300);
				orbitWrapper.find('.orbit-thumbnails li').eq(prevActiveSlide).stop().animate({'top': 24}, 300).removeClass('orbit-thumbnail-active');
				orbitWrapper.find('.orbit-thumbnails li').eq(activeSlide).stop().animate({'top': 15}, 300).addClass('orbit-thumbnail-active');
				
        	}
			
			function checkLink() {
				orbit.css('cursor', 'auto');
				orbit.unbind('click');
				if($(slides[activeSlide]).is('a')) {
					orbit.css('cursor', 'pointer');
					orbit.bind('click', function() {
						window.open(slides[activeSlide].href, slides[activeSlide].target);
						return false;	
					});
				}
			}
			
			orbitWrapper.find('.orbit-thumbnails li').eq(activeSlide).find('img').load(function() {
				setActiveThumb();
			});
			
			checkLink();
			setCaption();
        	
// ====================
// ! SHIFT ANIMATIONS   
// ====================
            
            //Animating the shift!
            function shift(direction) {
				
        	    //remember previous activeSlide
                prevActiveSlide = activeSlide,
                slideDirection = direction;
                //exit function if bullet clicked is same as the current image
                if(prevActiveSlide == slideDirection) { return false; }
				
                //reset Z & Unlock
                function resetAndUnlock() {
                    unlock();
                    options.afterSlideChange.call(this);
                }
                if(slides.length == "1") { return false; }
                if(!locked) {
                    lock();
					 //deduce the proper activeImage
                    if(direction == "next") {
                        activeSlide++
                        if(activeSlide == numberSlides) {
                            activeSlide = 0;
                        }
                    } else if(direction == "prev") {
                        activeSlide--
                        if(activeSlide < 0) {
                            activeSlide = numberSlides-1;
                        }
                    } else {
                        activeSlide = direction;
                        if (prevActiveSlide < activeSlide) { 
                            slideDirection = "next";
                        } else if (prevActiveSlide > activeSlide) { 
                            slideDirection = "prev"
                        }
                    }
					
					counter++;
					orbit.children('img').eq(counter % 2).attr('src', images[activeSlide]);
				    orbit.children('img').eq((counter-1) % 2).css('z-index', 0);
					
                    //set to correct thumb
                     setActiveThumb();
					 checkLink();
                    
                    //fade
                    if(options.animation == "fade") {
                        orbit.children('img').eq(counter % 2)
                        	.css({"opacity" : 0, "z-index" : 3})
                        	.animate({"opacity" : 1}, options.animationSpeed, resetAndUnlock);
                    }
                    //horizontal-slide
                    if(options.animation == "horizontal-slide") {
                        if(slideDirection == "next") {
                            orbit.children('img').eq(counter % 2)
                            	.css({"left": options.width, "z-index" : 3})
                            	.animate({"left" : 0}, options.animationSpeed, resetAndUnlock);
                        }
                        if(slideDirection == "prev") {
                            orbit.children('img').eq(counter % 2)
                            	.css({"left": -options.width, "z-index" : 3})
                            	.animate({"left" : 0}, options.animationSpeed, resetAndUnlock);
                        }
                    }
                    //vertical-slide
                    if(options.animation == "vertical-slide") { 
                        if(slideDirection == "prev") {
                            orbit.children('img').eq(counter % 2)
                            	.css({"top": options.height, "z-index" : 3})
                            	.animate({"top" : 0}, options.animationSpeed, resetAndUnlock);
                        }
                        if(slideDirection == "next") {
                            orbit.children('img').eq(counter % 2)
                            	.css({"top": -options.height, "z-index" : 3})
                            	.animate({"top" : 0}, options.animationSpeed, resetAndUnlock);
                        }
                    }
                    //push-over
                    if(options.animation == "horizontal-push") {
                        if(slideDirection == "next") {
                            orbit.children('img').eq(counter % 2)
                            	.css({"left": options.width, "z-index" : 3})
                            	.animate({"left" : 0}, options.animationSpeed, resetAndUnlock);
                             orbit.children('img').eq((counter-1) % 2)
                            	.animate({"left" : -options.width}, options.animationSpeed);
                        }
                        if(slideDirection == "prev") {
                            orbit.children('img').eq(counter % 2)
                            	.css({"left": -options.width, "z-index" : 3})
                            	.animate({"left" : 0}, options.animationSpeed, resetAndUnlock);
							 orbit.children('img').eq((counter-1) % 2)
                            	.animate({"left" : options.width}, options.animationSpeed);
                        }
                    }
                    setCaption();
                } //lock
            }//orbit function
        });//each call
    }//orbit plugin call
})(jQuery);
        