/**
 * This is a slider with small thumbnail previews. When the smaller thumbnail is clicked,
 * a bigger preview image fades in. Also there is a pagination included for the thumbnails
 * so that when there are more of them included, they are separated by pages and users can
 * navigate through them using navigation arrows.
 * 
 * @author Pexeto
 * http://pexeto.com
 */

(function($){
	$.fn.slider=function(options){
		var defaults={
			interval:4000,   //the interval between changing the images when autoplay is turned on (in miliseconds)
			autoplay:true,   //if set to false, images won't be changed automatically, only users will be able to do it
			imgPerScroll:9,  //the number of small thumbnail images per scroll (page)
			thumbContainerId:'slider-navigation',  //the ID of the div that will contain the small thumbnails
			scrollSpeed:700,  //the speed of the thumbnail scroll (in miliseconds)
			pauseInterval:5000,  //the pause interval (in miliseconds)- when an user clicks on an image or arrow, the autoplay pauses for this interval of time
			pauseOnHover:true
		};
		
		options=$.extend(defaults, options);
		var api, timer=-1, images=[], current, root, thumbContainer, containerNum=0, inAnimation=false, descBox, descBottom=0,windowFocus=true;
		
		
		
		root=$(this);
		thumbContainer=$('#'+options.thumbContainerId);
		current=root.find('img:first').toggleClass('current').show();
		
		
		/**
		 * Inits the slider.
		 */
		function init(){
				
			if(root.find('img').length>0){
				setDescription();
				thumbContainer.css({visibility:'visible'});
				
				root.find('.loading').hide();
				
				getImages();
				printScrollable();
				
				$('.right').click(function(){
					api.next(500);
				});
				
				//set the timer
				if(options.autoplay){
					setTimer();
					setWindowEvents();
				}
			}
		}
		
		function setDescription(){
			
			//append the description div
			descBox=$('<div id="description-box" ></div>');
			root.find('div:first').append(descBox);
		}
		
		/**
		 * Inserts the bigger images into an array for further use.
		 */
		function getImages(){
			root.find('img').each(function(i){
				var img=$(this).data('index', i);
				images.push(img);
				if(options.pauseOnHover && options.autoplay){
					img.hover(function(){
						stopSlider();
					},function(){
						setTimeout(function(){setTimer();}, options.interval);
					});
				}
			});
			
			var title=images[0].attr('title');
			if(title){
				descBox.html('<p>'+title+'</p>').animate({bottom:descBottom}, 700);
			}
		}
		
		/**
		 * Prints the thumbnail container.
		 */
		function printScrollable(){	
			thumbContainer.find('img:first').addClass('active');
			
			//display navigation arrows if there are more than one scrollable page
			containerNum=thumbContainer.find('div.items div').length;
			if(containerNum>1){
				$('<a class="prev browse" id="left-arrow"></a><a class="next browse" id="right-arrow"></a>').insertBefore(thumbContainer);
			}else{
				//$('#slider-navigation-container').css({paddingLeft:30});
			}
			
			
			//enable the scrollable plugin
			//var scrollable=thumbContainer.scrollable({speed:options.scrollableSpeed, left:'#left-arrow', right:'#right-arrow'});
			
		
				var scrollable=pexetoSite.setScrollable();
				api = scrollable.data("scrollable");	
			
			
			
			setClickHandlers();
		}
		
		/**
		 * Set click event event handlers for the thumbnail images and navigation arrows.
		 */
		function setClickHandlers(){
			thumbContainer.find('img').each(function(i){
				var img=$(this);
				img.click(function(){
					if(current.data('index')!==i && !inAnimation){
						showCurrent(images[i]);
						$(".items img").removeClass("active");
						img.addClass("active");
						
						if(options.autoplay){
							pause();
						}
					}
				}).hover(function(){
					$(this).css({cursor:'pointer'});
				});
			});
			
			//pause the autoplay on arrow click
			thumbContainer.siblings('.browse').click(function(){
				if(options.autoplay){
				pause();
				}
			}).mouseover(function(){
				$(this).css({cursor:'pointer'});
			});
			
			$('#left-arrow').mousedown(function(){
				$(this).animate({marginLeft:-3}, 100);
			}).mouseup(function(){
				$(this).animate({marginLeft:0}, 100);
			});
			
			$('#right-arrow').mousedown(function(){
				$(this).animate({marginRight:-3}, 100);
			}).mouseup(function(){
				$(this).animate({marginRight:0}, 100);
			});
		}
		
		function setWindowEvents(){
			$(window).focus(function(){
				windowFocus=true;
				if(timer===-1){
					setTimer();
				}
			});

			$(window).blur(function(){
				windowFocus=false;
				if(timer!==-1){
					stopSlider();
				}
			});
		}
		
		/**
		 * Stops the autoplay.
		 */
		function stopSlider(){
			window.clearInterval(timer);
			timer=-1;
		}
		
		/**
		 * Pauses the autoplay.
		 */
		function pause(){
			stopSlider();
			setTimeout(function(){setTimer();}, options.pauseInterval);
		}
		
		/**
		 * Shows the image that has been selected.
		 * @param the image object to display
		 */
		function showCurrent(img){
			descBox.stop().css({bottom:-100});
			inAnimation=true;
			img.toggleClass('current').fadeIn(function(){
				var title=img.attr('title');
				if(title){
					descBox.html('<p>'+title+'</p>').animate({bottom:descBottom}, 700);
				}
				inAnimation=false;
			});
			
			current.fadeOut(function(){
				current.removeClass('current');	
			});
			current=img;
		}
		
		/**
		 * Sets the timer for autoplay.
		 */
		function setTimer(){
			if(timer===-1 && windowFocus){
				timer = window.setInterval(function(){showNext();}, options.interval);
			}
		}
		
		/**
		 * Shows the next image, used when autoplay is enabled.
		 */
		function showNext(){
			var nextIndex=current.data('index')===(images.length-1)?0:Number(current.data('index'))+1,
				next=images[nextIndex],
				nextContPosition=parseInt(nextIndex/options.imgPerScroll,10),
				apiIndex=api.getIndex();
			if(nextContPosition!==apiIndex){
				api.seekTo(nextContPosition, options.scrollSpeed);
			}
			
			$(".items img").removeClass('active').eq(nextIndex).addClass('active');
			
			showCurrent(next);
			
		}
		

		if(root.length>0){
			init();
		}
		
	};
}(jQuery));