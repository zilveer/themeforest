var $j = jQuery.noConflict();

$j(function(){

    $j.fn.orbit = function(options) {


        
        //Extend those options
        var options = $j.extend(defaults, options); 
	
        return this.each(function() {
        
// ==============
// ! SETUP   
// ==============
        
            //Global Variables
            var activeSlide = 0,
            	numberSlides = 0,
            	orbitWidth,
            	orbitHeight,
            	locked;
            
            //Initialize
            var orbit = $j(this).addClass('orbit'),         
            	orbitWrapper = $j('#orbit-wrapper');
           
	    	            
            //Collect all slides and set slider size of largest image
            var slides = orbit.children('img, a, div');
            slides.each(function() {
                var _slide = $j(this),
                	_slideWidth = _slide.width(),
                	_slideHeight = _slide.height();
                if(_slideWidth > orbit.width()) {
	                orbit.add(orbitWrapper).width(_slideWidth);
	                orbitWidth = orbit.width();	       			
	            }
	            if(_slideHeight > orbit.height()) {
	                orbit.add(orbitWrapper).height(_slideHeight);
	                orbitHeight = orbit.height();
				}
                numberSlides++;
            });
            
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
            	options.bullets = false;
            }
            
            //Set initial front photo z-index and fades it in
            slides.eq(activeSlide)
            	.css({"z-index" : 3})
            	.fadeIn(function() {
            		//brings in all other slides IF css declares a display: none
            		slides.css({"display":"block"})
            	});
            
// ==============
// ! TIMER   
// ==============

            //Timer Execution
            function startClock() {
            	if(!options.timer  || options.timer == 'false') { 
            		return false;
            	//if timer is hidden, don't need to do crazy calculations
            	} else {
		            clock = setInterval(function(e){
						shift("next");  
		            }, options.advanceSpeed);            		
		        //if timer is visible and working, let's do some math
            	}
	        }
	        function stopClock() {
	        	if(!options.timer || options.timer == 'false') { return false; } else {
		            timerRunning = false;
		            clearInterval(clock);
				}
	        }  
            
            //Timer Setup
            if(options.timer) {         	
                var timerHTML = '<div class="timer"></div>'
                orbitWrapper.append(timerHTML);
                var timer = $j('div.timer'),
                	timerRunning;
                if(timer.length != 0) {
                    
                    startClock();
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
	            		_captionHTML = $j(_captionLocation).html(); //get HTML from the matching HTML entity            		
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
                var directionalNavHTML = '<div class="slider-nav"><span class="right"><i class="moon-arrow-right-2"></i></span><span class="left"><i class="moon-arrow-left"></i></span></div>';
                orbitWrapper.append(directionalNavHTML);
                var leftBtn = orbitWrapper.children('div.slider-nav').children('span.left'),
                	rightBtn = orbitWrapper.children('div.slider-nav').children('span.right');
                leftBtn.click(function() { 
                    stopClock();
                    shift("prev");
                });
                rightBtn.click(function() {
                    stopClock();
                    shift("next")
                });
            }
            
// ==================
// ! BULLET NAV   
// ==================
            
            //Bullet Nav Setup
            if(options.bullets) { 
            	var bulletHTML = '<ul class="orbit-bullets"></ul>';            	
            	orbitWrapper.append(bulletHTML);
            	var bullets = $j('ul.orbit-bullets');
            	for(i=0; i<numberSlides; i++) {
            		var liMarkup = $j('<li>'+(i+1)+'</li>');
            		if(options.bulletThumbs) {
            			var	thumbName = slides.eq(i).data('thumb');
            			if(thumbName) {
            				var liMarkup = $j('<li class="has-thumb">'+i+'</li>')
            				liMarkup.css({"background" : "url("+options.bulletThumbLocation+thumbName+") no-repeat"});
            			}
            		} 
            		$j('ul.orbit-bullets').append(liMarkup);
            		liMarkup.data('index',i);
            		liMarkup.click(function() {
            			stopClock();
            			shift($j(this).data('index'));
            		});
            	}
            	setActiveBullet();
            }
            
            //Bullet Nav Execution
        	function setActiveBullet() { 
        		if(!options.bullets) { return false; } else {
	        		bullets.children('li').removeClass('active').eq(activeSlide).addClass('active');
	        	}
        	}
        	
// ====================
// ! SHIFT ANIMATIONS   
// ====================
            
            //Animating the shift!
            function shift(direction) {
        	    //remember previous activeSlide
                var prevActiveSlide = activeSlide,
                	slideDirection = direction;
                //exit function if bullet clicked is same as the current image
                if(prevActiveSlide == slideDirection) { return false; }
                //reset Z & Unlock
                function resetAndUnlock() {
                    slides
                    	.eq(prevActiveSlide)
                    	.css({"z-index" : 1});
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
                    //set to correct bullet
                     setActiveBullet();  
                     
                    //set previous slide z-index to one below what new activeSlide will be
                    slides
                    	.eq(prevActiveSlide)
                    	.css({"z-index" : 2});    
                    
                    //fade
                    if(options.animation == "fade") {
                        slides
                        	.eq(activeSlide)
                        	.css({"opacity" : 0, "z-index" : 3})
                        	.animate({"opacity" : 1}, options.animationSpeed, resetAndUnlock);
                    }
                    //horizontal-slide
                    if(options.animation == "horizontal-slide") {
                        if(slideDirection == "next") {
                            slides
                            	.eq(activeSlide)
                            	.css({"left": 940, "z-index" : 3})
                            	.animate({"left" : 0}, options.animationSpeed, resetAndUnlock);
                        }
                        if(slideDirection == "prev") {
                            slides
                            	.eq(activeSlide)
                            	.css({"left": -940, "z-index" : 3})
                            	.animate({"left" : 0}, options.animationSpeed, resetAndUnlock);
                        }
                    }
                    //vertical-slide
                    if(options.animation == "vertical-slide") { 
                        if(slideDirection == "prev") {
                            slides
                            	.eq(activeSlide)
                            	.css({"top": orbitHeight, "z-index" : 3})
                            	.animate({"top" : 0}, options.animationSpeed, resetAndUnlock);
                        }
                        if(slideDirection == "next") {
                            slides
                            	.eq(activeSlide)
                            	.css({"top": -orbitHeight, "z-index" : 3})
                            	.animate({"top" : 0}, options.animationSpeed, resetAndUnlock);
                        }
                    }
                    //push-over
                    if(options.animation == "horizontal-push") {
                        if(slideDirection == "next") {
                            slides
                            	.eq(activeSlide)
                            	.css({"left": 940, "z-index" : 3})
                            	.animate({"left" : 0}, options.animationSpeed, resetAndUnlock);
                            slides
                            	.eq(prevActiveSlide)
                            	.animate({"left" : -940}, options.animationSpeed);
                        }
                        if(slideDirection == "prev") {
                            slides
                            	.eq(activeSlide)
                            	.css({"left": -940, "z-index" : 3})
                            	.animate({"left" : 0}, options.animationSpeed, resetAndUnlock);
							slides
                            	.eq(prevActiveSlide)
                            	.animate({"left" : 940}, options.animationSpeed);
                        }
                    }
                    setCaption();
                } //lock
            }//orbit function
        });//each call
    }//orbit plugin call
})