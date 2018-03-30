/**
 * This is the script for the content slider - it slides between different items with different content set to them.
 * @author Pexeto
 * http://pexeto.com
 */


(function($){
	$.fn.pexetoSlider=function(options){
		var defaults={
			//set the default options (can be overwritten from the calling function)
			containerWidth:0,
			autoplay:false,
			animationInterval:3000, //the interval between each animation when autoplay set to true
			pauseOnHover:true, //if true the animation will be paused when the mouse is over the slider
			pauseInterval:5000, //the time that the animation will be paused after a click
			animationSpeed:900,
			easing:'easeInOutExpo',
			arrows:true,
			buttons:true,
			
			//selectors
			leftId:'slider-left',
			rightId:'slider-right',
			arrowClass:'slider-browse',
			ulSel:'#slider-ul',
			navigationId:'content-slider-navigation',
			selectedClass:'selected'
		};
		
	
	var options=$.extend(defaults, options);
	var root=null, 
		ul=null,
		navigation=null,
		navigationLi=null,
		containerWidth=0,
		itemNum=0,
		currentIndex=0,
		timer=0,
		stopped=true,
		inAnimation=false,
		isIE=false;
	
	root=$(this);
	ul=$(options.ulSel);
	containerWidth=options.containerWidth?options.containerWidth:parseFloat(root.css('width'))+30;
	
	/**
	 * Inits the slider - calls the main functionality.
	 */
	function init(){
		//get the items number
		itemNum=ul.find('li').length;
		//set the width to the ul depending on the item number
		ul.css({width:itemNum*containerWidth+500}).find('li').show();
		bindEventHandlers();
		
		if($.browser.msie){
			isIE=true;
		}
		
		if(options.arrows){
			setArrows();
		}
		
		if(options.buttons){
			setNavigation();
		}
		
		if(options.autoplay){
			startAnimation();
		}
	}
	
	/**
	 * Binds event handlers for the main slider functionality.
	 */
	function bindEventHandlers(){
		ul.bind('changeSlide', function(e, index){
				ul.stop().animate({marginLeft:['-'+index*containerWidth,options.easing]}, options.animationSpeed);
				if(options.buttons){
					navigationLi.trigger('slideChanged');
				}
		});
		
		if(options.autoplay && options.pauseOnHover){
			//pause the animation when hovered
			root.hover(stopAnimation,startAnimation);
		}
	}
	
	/**
	 * Adds arrows to the slider and sets event handler functions to them.
	 */
	function setArrows(){
		
		var fadeSpeed=isIE?0:1000;

		//right arrow
		$('<a />', {'class':options.arrowClass, id:options.rightId, href:''})
		.insertBefore(root)
		.click(function(e){
			e.preventDefault();
			pause();
			callNextSlide();
		})
		.mousedown(function(){
				$(this).animate({marginRight:-2}, 100); })
		.mouseup(function(){
				$(this).animate({marginRight:0}, 100); })
		.fadeIn(fadeSpeed);
		
		//left arrow
		$('<a />', {'class':options.arrowClass, id:options.leftId, href:''})
		.insertBefore(root)
		.click(function(e){
			e.preventDefault();
			pause();
			if(currentIndex>0){
				ul.trigger('changeSlide', [--currentIndex]);
			}
		})
		.mousedown(function(){
				$(this).animate({marginLeft:-2}, 100); })
		.mouseup(function(){
				$(this).animate({marginLeft:0}, 100);
			})
		.fadeIn(fadeSpeed);
		
	}
	
	/**
	 * Adds navigation buttons to the slider and sets event handler functions to them.
	 */
	function setNavigation(){
		//generate the buttons
		var html='';
		navigation=$('<ul />', {id:options.navigationId});
		for(var i=0; i<itemNum; i++){
			html+='<li><span></span></li>';
		}
		
		navigation.html(html);
		root.append(navigation);
		//navigation.fadeIn(700);
		
		navigationLi=navigation.find('li');
		
		//add event handlers
		navigationLi.bind('click', function(e){
			e.stopPropagation();
			pause();
			var index = navigationLi.index($(this));
			if(currentIndex!==index){
				currentIndex=index;
				ul.trigger('changeSlide', [index]);
			}
		})
		.bind('slideChanged', function(){
			var index = navigationLi.index($(this));
			if(currentIndex===index){
				$(this).addClass(options.selectedClass);
			}else{
				$(this).removeClass(options.selectedClass);
			}
				
		})
		.eq(0).addClass(options.selectedClass);
		
		root.hover(function(){
			if(isIE){
				navigation.fadeIn(0);
			}else{
				navigation.stop().fadeIn(function(){
					navigation.animate({opacity:1},0);
				});
			}
		}, function(){
			if(isIE){
				navigation.hide();
			}else{
				navigation.stop().animate({opacity:0});
			}
		});
		
	}
	
	/**
	 * Starts the animation.
	 */
	function startAnimation(){
		if(options.autoplay && stopped){
			stopped=false;
			timer=window.setInterval(callNextSlide, options.animationInterval);
		}
	}
	
	/**
	 * Triggers a changeSlide event to display the next slide.
	 */
	function callNextSlide(){
		currentIndex=(currentIndex<itemNum-1)?++currentIndex:0;
		ul.trigger('changeSlide', [currentIndex]);
	}
	
	/**
	 * Stops the animation.
	 */
	function stopAnimation(){
		if(options.autoplay){
			window.clearInterval(timer);
			timer=-1;
			stopped=true;
		}
	}
	
	/**
	 * Pauses the animation.
	 */
	function pause(){
		if(options.autoplay){
			window.clearInterval(timer);
			timer=-1;
			if(!stopped){
				window.setTimeout(startAnimation, options.pauseInterval);
			}
			stopped=true;
		}
	}
	
	
	init();
	
	};
		
}(jQuery));