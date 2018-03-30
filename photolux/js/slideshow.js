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
	$.fn.pexetoSlideshow=function(options){
		var defaults={
			interval:4000,   //the interval between changing the images when autoplay is turned on (in miliseconds)
			autoplay:true,   //if set to false, images won't be changed automatically, only users will be able to do it
			imgPerScroll:4,  //the number of small thumbnail images per scroll (page)
			thumbContainerId:'slider-navigation',  //the ID of the div that will contain the small thumbnails
			sliderNavSel:'#slider-navigation-container',
			scrollSpeed:700,  //the speed of the thumbnail scroll (in miliseconds)
			pauseInterval:5000,  //the pause interval (in miliseconds)- when an user clicks on an image or arrow, the autoplay pauses for this interval of time
			pauseOnHover:true,
			hideContent:true,
			hideText:"Hide Menu",
			showText:"Show Menu",
			closedClass:"closed",
			fullWidth:true
		};
		
		options=$.extend(defaults, options);
		var api, 
			timer=-1, 
			images=[], 
			current, 
			root, 
			thumbContainer, 
			sliderNavContainer = $(options.sliderNavSel),
			containerNum=0, 
			inAnimation=false, 
			windowFocus=true, 
			hideButton=null, 
			navHidden=false, 
			navInAnimation=false,
			header = $('#header'),
			footer = $('#footer'),
			headerHeight=header.outerHeight() || 200,
			footerHeight=footer.outerHeight() || 47,
			currentHeight=0;
		
		
		
		root=$(this);
		thumbContainer=$('#'+options.thumbContainerId);
		current=root.find('img:first');
		
		
		/**
		 * Inits the slider.
		 */
		function init(){

				
			if(root.find('img').length>0){
				thumbContainer.css({visibility:'visible'});
				
				root.find('.loading').hide();

				calculateElementsHeight();
				sliderNavContainer.css({bottom:footerHeight-1});

				if(!options.fullWidth){
					setContainerHeight();
				}
				
				getImages();
				printScrollable();
				
				$('.right').click(function(){
					api.next(500);
				});
				
				
				$(window).one("load",function(){
					if(options.autoplay){
						//set the timer
						setTimer();
					}
					if(options.hideContent){
						calculateElementsHeight();
						if(!options.fullWidth){
							setContainerHeight();
						}
						setHidingFunctionality();
						hideNavigation();
					}
				});
				
				if(options.autoplay){
					setWindowEvents();
				}

				
				
				
			}
		}

		
		/**
		 * Set the wrapper container height according to the window height.
		 * For full-height slideshow only.
		 */
		function setContainerHeight(){
			var windowHeight=$(window).height(),
				additionalHeight = navHidden?0:headerHeight+footerHeight;

			currentHeight=windowHeight-(additionalHeight);
			root.height(currentHeight);
		}
		
		function centerImage(image){

			var windowWidth=$(window).width(),
				displayWidth = Math.round(image.width*currentHeight/image.height),
				left = displayWidth>windowWidth?-(displayWidth-windowWidth)/2:0;
			image.img.css({left:left});
		}
		
		function setHidingFunctionality(){
			hideButton=$('<div id="hide-button"><span>'+options.hideText+'</span></div>');
			header.append(hideButton);
			
			hideButton.click(function(){
				if(!navInAnimation){
					if(navHidden){
						showNavigation();
					}else{
						hideNavigation();
					}
				}
			});
		}
		
		function showNavigation(){
			navInAnimation=true;
			hideButton.removeClass(options.closedClass).find("span").text(options.hideText);
			calculateElementsHeight();
			
			if(!options.fullWidth){
				root.animate({height:'-='+(headerHeight+footerHeight)}, 500);
			}
			if(footerHeight!==0){
				footer.animate({height:"show", opacity:1}, 500);
			}
			sliderNavContainer.animate({bottom:footerHeight-1}, 500);
			header.animate({marginTop:0}, 500, function(){
				navInAnimation=false;
				navHidden=false;

				$(window).trigger('resize');
			});
		}
		
		function hideNavigation(){
			navInAnimation=true;
			hideButton.addClass(options.closedClass).find("span").text(options.showText);
			
			if(!options.fullWidth){
				root.animate({height:'+='+(headerHeight+footerHeight)}, 500);
			}
			footer.animate({height:"hide", opacity:0}, 500);
			sliderNavContainer.animate({bottom:0}, 500);
			header.animate({marginTop:-headerHeight}, 500, function(){
				navInAnimation=false;
				navHidden=true;
			});
			
			
		}
		
		/**
		 * Inserts the bigger images into an array for further use.
		 */
		function getImages(){
			root.find('img').each(function(i){
				var img=$(this).data('index', i);
				images[i]={img:img};
				
				(function(i){
					img.onPexetoImagesLoaded({callback:function(){
						$(this).hide().css({visibility:"visible"});
						images[i].imgLoaded=true;
						if(images[i].thumbLoaded){
							showThumbnail(i);
						}
						
						//resize the image to fit the window for full width layout
						images[i].width=$(this).width();
						images[i].height=$(this).height();
						if(options.fullWidth){	
							resizeImage(images[i]);
						}else{
							centerImage(images[i]);
						}
					}
					});
				})(i);
				
				
			});
			
			var repositionImage = options.fullWidth?function(val){
					resizeImage(val);
				}:function(val){
					setContainerHeight();
					centerImage(val);
				};
			
			$(window).on("resize orientationchange", function(){
				calculateElementsHeight();

				$.each(images, function(i, val){
					repositionImage(val);
				});

				if(!navHidden){
					sliderNavContainer.css({bottom:footerHeight-1});
				}else{
					header.css({marginTop:-headerHeight});
				}
			});
		}

		function calculateElementsHeight(){
			if($(window).height()<400){
				footer.hide();
				footerHeight=0;
			}else{
				if(!footer.is(':visible') && !navHidden){
					footer.show().css({opacity:1});
				}
				footerHeight= footer.outerHeight() || 47;
			}
			headerHeight=header.outerHeight() || 200;
			
		}

		
		function resizeImage(image) {
			var theWindow = $(window), 
				$bg = image.img, 
				aspectRatio = image.width / image.height,
				winWidth = theWindow.width(),
				winHeight = theWindow.height();

			

			if ((winWidth / winHeight) < aspectRatio) {
				
				root.css( {
					height : winHeight,
					width : 'auto',
					minWidth : 0,
					minHeight : 0
				});
				var newRatio = winHeight / image.height;
				$bg.css( {
							height : winHeight,
							width : 'auto',
							minWidth : 0,
							minHeight : 0,
							marginLeft : -(image.width * newRatio - winWidth) / 2
						});
			} else {
				
				root.css( {
					height : 'auto',
					width : '100%',
					minWidth : 0,
					minHeight : 0
				});
				$bg.css( {
					height : 'auto',
					width : '100%',
					minWidth : 0,
					minHeight : 0,
					marginLeft : 0
				});
			}

		}
		
		function showThumbnail(i){
			if(images[i].imgLoaded && images[i].thumbLoaded){
				images[i].thumb.animate({opacity:1}, 800).parent().css({backgroundImage:'none'});
				if(i===0){
					images[i].img.toggleClass('current').fadeIn(1100);
					root.removeClass("loading");
				}
			}
		}
		
		/**
		 * Prints the thumbnail container.
		 */
		function printScrollable(){	
			thumbContainer.find('img:first').addClass('active');
			
			//display navigation arrows if there are more than one scrollable page
			containerNum=thumbContainer.find('div.items div').not(".thumbnail-wrapper").length;
			if(containerNum>1){
				$('<a class="prev browse" id="left-arrow"></a><a class="next browse" id="right-arrow"></a>').insertBefore(thumbContainer);
			}
			
			//enable the scrollable plugin
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
				images[i].thumb=$(this);
				
				img.click(function(){
					if(current.data('index')!==i && !inAnimation && images[i].imgLoaded && images[i].thumbLoaded){
						showCurrent(images[i].img);
						$(".items img").removeClass("active");
						img.addClass("active");
						
						pause();
					}
				}).hover(function(){
					$(this).css({cursor:'pointer'});
				});
				
				(function(i){
					img.onPexetoImagesLoaded({callback:function(){
							images[i].thumbLoaded=true;
							if(images[i].imgLoaded){
								showThumbnail(i);
							}
						}
					});
				})(i);
			});
			
			//pause the autoplay on arrow click
			thumbContainer.siblings('.browse').click(function(){
				pause();
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
		 * Pauses the autoplay.
		 */
		function pause(){
			stopSlider();
			setTimeout(function(){setTimer();}, options.pauseInterval);
		}
		
		/**
		 * Stops the autoplay.
		 */
		function stopSlider(){
			window.clearInterval(timer);
			timer=-1;
		}
		
		/**
		 * Shows the image that has been selected.
		 * @param the image object to display
		 */
		function showCurrent(img){
			var animSpeed = 1000;
			inAnimation=true;
			img.toggleClass('current').css({opacity:0, display:'block'}).animate({opacity:1}, animSpeed, function(){
				var title=img.attr('title');
				inAnimation=false;
			});
			
			current.fadeOut(animSpeed, function(){
				current.removeClass('current');	
			});
			current=img;
		}
		
		/**
		 * Sets the timer for autoplay.
		 */
		function setTimer(){
			if(options.autoplay && timer===-1 && windowFocus){
				timer = window.setInterval(function(){showNext();}, options.interval);
			}
		}
		
		/**
		 * Shows the next image, used when autoplay is enabled.
		 */
		function showNext(){
			var nextIndex=current.data('index')===(images.length-1)?0:Number(current.data('index'))+1,
				next=images[nextIndex].img,
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