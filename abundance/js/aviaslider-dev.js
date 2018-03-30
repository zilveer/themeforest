/**
 * AviaSlider - A jQuery image slider
 * (c) Copyright Christian "Kriesi" Budschedl
 * http://www.kriesi.at
 * http://www.twitter.com/kriesi/
 * For sale on ThemeForest.net
 */

/* this prevents dom flickering, needs to be outside of dom.ready event: */
document.documentElement.className += ' js_active ';
/*end dom flickering =) */



(function($)
{
	$.fn.aviaSlider= function(variables) 
	{
		var defaults = 
		{
			blockSize: {height: 'full', width:'full'},
			autorotationSpeed:3,		// duration between autorotation switch in Seconds
			slides: 'li',				// wich element inside the container should serve as slide
			animationSpeed: 900,		// animation duration
			autorotation: true,			// autorotation true or false?
			appendControlls: '',		// element to apply controlls to
			slideControlls: 'items',	// controlls, yes or no?
			betweenBlockDelay:60,
			display: 'topleft',
			switchMovement: false,
			showText: true,	
			captionReplacement: false,		//if this is set the element will be used for caption instead of the alt tag
			transition: 'fade',			//slide, fade or drop	
			backgroundOpacity:0.8,		// opacity for background
			transitionOrder: ['diagonaltop', 'diagonalbottom','topleft', 'bottomright', 'random'],
			hideArrows: true
		};
			 
		return this.each(function()
		{
			
			var options = $.extend(defaults, variables);
			
			var slideWrapper = $(this),									//wrapper element
				optionsWrapper = slideWrapper.parents('.slideshow_container'), //optionswrapper: contains classnames that override passed js values
				slides = slideWrapper.find(options.slides),				//single slide container
				slideImages	= slides.find('img'),						//slide image within container
				slideCount 	=	slides.length,							//number of slides
				slideWidth =	slides.width(),							//width of slidecontainer
				slideHeight= slides.height(),							//height of slidecontainer
				blockNumber = 0,										//how many blocks do we need
				currentSlideNumber = 0,									//which slide is currently shown
				reverseSwitch = false,									//var to set the starting point of the transition
				currentTransition = 0,									//var to set which transition to display when rotating with 'all'
				current_class = 'active_item',							//currently active controller item
				controlls = '',
				controllThumbs = optionsWrapper.find('.thumbnails_container li'),
				skipSwitch = true,										//var to check if performing transition is allowed
				interval ='',
				blockSelection ='',
				blockSelectionJQ ='',
				arrowControlls = '',
				blockOrder = [];	
				
												
						
			//slider methods that controll the whole behaviour of the slideshow	
			slideWrapper.methods = {
								
				options_overwrite: function()
				{				
					if(optionsWrapper.length)
					{
						var block_width  = /block_width__(\d+|full)/,
							block_height = /block_height__(\d+|full)/,
							transition   = /transition_type__(slide|fade|drop)/,
							autoInterval = /autoslidedelay__(\d+)/;
							direction = /direction__(\w+)/;
						
						var matchWidth =  block_width.exec(optionsWrapper[0].className),
							matchHeight = block_height.exec(optionsWrapper[0].className),
							matchTrans =  transition.exec(optionsWrapper[0].className),
							matchInterval = autoInterval.exec(optionsWrapper[0].className),
							matchDirection = direction.exec(optionsWrapper[0].className);
				
						if(matchWidth != null)    { options.blockSize.width = matchWidth[1];	  }
						if(matchHeight != null)   { options.blockSize.height = matchHeight[1];	  }
						if(matchTrans != null)    { options.transition = matchTrans[1];			  }
						if(matchInterval != null) { options.autorotationSpeed = matchInterval[1]; }
						if(matchDirection != null)
						{ 
							if(matchDirection[1] == 'all') options.transitionOrder = ['diagonaltop', 'diagonalbottom','topleft', 'bottomright', 'random'];
							if(matchDirection[1] == 'diagonal') options.transitionOrder = ['diagonaltop', 'diagonalbottom'];
							if(matchDirection[1] == 'winding') options.transitionOrder = ['topleft', 'bottomright'];
							if(matchDirection[1] == 'random') options.transitionOrder = ['random'];
						}
						
						if(optionsWrapper.is('.autoslide_false')) options.autorotation = false;
						if(optionsWrapper.is('.autoslide_true')) options.autorotation = true;
						
					}
				},
				
				//initialize slider and create the block with the size set in the default/options object
				init: function()
				{	
					slideWrapper.methods.options_overwrite();
					
					//check if either width or height should be full container width			
					if (options.blockSize.height == 'full') 
					{ 
						options.blockSize.height = slideHeight; 
					} 
					else 
					{ 
						options.blockSize.height = parseInt(options.blockSize.height)
					}
					
					if (options.blockSize.width == 'full') 
					{
						options.blockSize.width = slideWidth; 
					} 
					else 
					{
						options.blockSize.width = parseInt(options.blockSize.width)
					}
					
				
				
					var posX = 0,
						posY = 0,
						generateBlocks = true,
						bgOffset = '';
					
					// make sure to display the first image in the list at the top
					slides.filter(':first').css({'z-index':'3',display:'block'});
						
					// start generating the blocks and add them until the whole image area
					// is filled. Depending on the options that can be only one div or quite many ;)
					while(generateBlocks)
					{
						blockNumber ++;
						bgOffset = "-"+posX +"px -"+posY+"px";
						
						$('<div class="kBlock"></div>').appendTo(slideWrapper).css({	
								zIndex:20, 
								position:'absolute',
								display:'none',
								left:posX,
								top:posY,
								height:options.blockSize.height,
								width:options.blockSize.width,
								backgroundPosition:bgOffset
							});
				
						
						posX += options.blockSize.width;
						
						if(posX >= slideWidth)
						{
							posX = 0;
							posY += options.blockSize.height;
						}
						
						if(posY >= slideHeight)
						{	
							//end adding Blocks
							generateBlocks = false;
						}
					}
					
					//setup directions
					blockSelection = slideWrapper.find('.kBlock');
					blockOrder['topleft'] = blockSelection;
					blockOrder['bottomright'] = $(blockSelection.get().reverse());
					blockOrder['diagonaltop'] = slideWrapper.methods.kcubit(blockSelection);
					blockOrder['diagonalbottom'] = slideWrapper.methods.kcubit(blockOrder['bottomright']);
					blockOrder['random'] = slideWrapper.methods.fyrandomize(blockSelection);
					
					
					//save image in case of flash replacements, will be available in the the next script version
					slides.each(function()
					{
						$.data(this, "data", { img: $(this).find('img').attr('src')});
					});
					
					
					if(slideCount <= 1)
					{
						slideWrapper.aviaImagePreloader();
					}
					else
					{
						slideWrapper.aviaImagePreloader({},slideWrapper.methods.preloadingDone);
						slideWrapper.methods.appendControlls();
						slideWrapper.methods.appendControllArrows();
					}
					
					slideWrapper.methods.addDescription();
					slideWrapper.methods.videoBehaviour();	
				},
				
				videoBehaviour: function()
				{	
					var videoItem, videoSlide, imageSlide;
					slides.each(function()
					{
						imageSlide= $('img', this);
						videoItem = $('.slideshow_video', this);
						embedVideo = $('.avia_video, iframe, embed, object', this);
						videoSlide = $(this);
						
						if((imageSlide.length && videoItem.length) || (imageSlide.length && embedVideo.length))
						{
							videoSlide.addClass('comboslide').append('<span class="slideshow_overlay"></span>');
						}
						
						if(videoItem.length)
						{
							videoSlide.addClass('videoSlideContainer');
						}
						else if(embedVideo.length)
						{
							videoSlide.addClass('videoSlideContainerEmbed');
						}
						
					});
					
					
					$('.videoSlideContainer img, .videoSlideContainer .slideshow_overlay', slideWrapper).bind('click', function()
					{
						var parent = $(this).parents('li:eq(0)');
						parent.find('img, .slideshow_overlay').fadeOut();
						parent.find('.slideshow_video').stop().fadeIn();

					});
					
				},
				
				//appends the click controlls after an element, if that was set in the options array
				appendControlls: function()
				{	
					if (options.slideControlls == 'items')
					{	
						var elementToAppend = options.appendControlls || slideWrapper[0];
						controlls = $('<div></div>').addClass('slidecontrolls').insertAfter(elementToAppend);
						
						slides.each(function(i)
						{	
							var controller = $('<a href="#" class="ie6fix '+current_class+'"></a>').appendTo(controlls);
							controller.bind('click', {currentSlideNumber: i}, slideWrapper.methods.switchSlide);
							current_class = "";
						});	
						
						controlls.width(controlls.width()).css('float','none');
					}
					return this;
					
				},
				
				appendControllArrows: function()
				{
					var elementToAppend = options.appendControlls || slideWrapper[0];
					arrowControlls = $('<div></div>').insertAfter(elementToAppend)
													 .addClass('arrowslidecontrolls');
					
					arrowControlls.html('<a class="ctrl_fwd ctrl_arrow" href=""></a><a class="ctrl_back ctrl_arrow" href=""></a>');
					
					$('.ctrl_back', arrowControlls).bind('click', {currentSlideNumber: 'prev'}, slideWrapper.methods.switchSlide);
					$('.ctrl_fwd', arrowControlls).bind('click', {currentSlideNumber: 'next'}, slideWrapper.methods.switchSlide);
					
					if(options.hideArrows) 
					{
						
						var arrowItems = arrowControlls.find('a');
						arrowItems.css({opacity:0});							
						slideWrapper.hover(
						
							function()
							{
								arrowItems.stop().animate({'opacity':1});
							},
							function(event)
							{
								if(!$(event.relatedTarget).is('.ctrl_arrow'))
								{
									arrowItems.stop().animate({'opacity':0});
								}
							}
						);
					}
				},
				
				// adds the image description from an alttag 
				addDescription: function()
				{	
					if(options.showText)
					{
						slides.each(function()
						{	
						
							var currentSlide = $(this);
							
							if(options.captionReplacement)
							{
								var description = currentSlide.find(options.captionReplacement).css({display:'block','opacity':options.backgroundOpacity});
								
							}
							else
							{
								var	description = currentSlide.find('img').attr('alt'),
									splitdesc = description.split('::');
								
								
								
								if(splitdesc[0] != "" )
								{
									if(splitdesc[1] != undefined )
									{
										description = "<strong>"+splitdesc[0] +"</strong>"+splitdesc[1]; 
									}
									else
									{
										description = splitdesc[0];
									}
								}
	
								if(description != "")
								{
									$('<div></div>').addClass('slideshow_caption')
													.html(description)
													.css({display:'block', 'opacity':options.backgroundOpacity})
													.appendTo(currentSlide.find('a')); 
								}
							}
						});
					}
				},
				
				preloadingDone: function()
				{	
					skipSwitch = false;
					optionsWrapper.data('animationActive', false);
					
					if($.browser.msie)
					{
						slides.css({'backgroundColor':'#000000','backgroundImage':'none'});
					}
					else
					{
						slides.css({'backgroundImage':'none'});
					}
					
					
					if(options.autorotation && options.autorotation != 2) 
					{
						slideWrapper.methods.autorotate();
						slideImages.bind("click", function(){ clearInterval(interval); });
					}
				},
				
				autorotate: function()
				{	
					var time = parseInt(options.autorotationSpeed) * 1000 + parseInt(options.animationSpeed) + (parseInt(options.betweenBlockDelay) * blockNumber);
				
					interval = setInterval(function()
					{ 	
						currentSlideNumber ++;
						if(currentSlideNumber == slideCount) currentSlideNumber = 0;
						
						slideWrapper.methods.switchSlide();
					},
					time);
				},
				
				switchSlide: function(passed)
				{ 
					var noAction = false;
						
					if(passed != undefined && !skipSwitch)
					{	
						if(currentSlideNumber != passed.data.currentSlideNumber)
						{	
							if(passed.data.currentSlideNumber == 'next')
							{
								currentSlideNumber = currentSlideNumber + 1;
								if(currentSlideNumber > slideCount-1 ) currentSlideNumber = 0;
							}
							else if(passed.data.currentSlideNumber == 'prev')
							{
								currentSlideNumber = currentSlideNumber - 1;
								if (currentSlideNumber < 0) currentSlideNumber = slideCount -1;
							}
							else
							{
								currentSlideNumber = passed.data.currentSlideNumber;
							}
						}
						else
						{
							noAction = true;
							optionsWrapper.data('animationActive', true);
						}
					}
										
					if(passed != undefined) clearInterval(interval);
					
					if(!skipSwitch && noAction == false)
					{	
						optionsWrapper.data('animationActive', true);
						skipSwitch = true;
						var currentSlide = slides.filter(':visible'),
							nextSlide = slides.filter(':eq('+currentSlideNumber+')'),
							nextURL = $.data(nextSlide[0], "data").img,	
							nextImageBG = 'url('+nextURL+')';	
							if(options.slideControlls)
							{	
								controlls.find('.active_item').removeClass('active_item');
								controlls.find('a:eq('+currentSlideNumber+')').addClass('active_item');									
							}
							
						controllThumbs.filter('.activeslideThumb').removeClass('activeslideThumb').find('img').css({opacity:0.7});
						controllThumbs.filter(':eq('+currentSlideNumber+')').addClass('activeslideThumb').find('img').css({opacity:1});

						blockSelectionJQ = blockOrder[options.display];
						
						//workarround to make more than one flash movies with the same classname possible
						slides.find('>a>img').css({opacity:1,visibility:'visible'});
							
						//switchmovement
						if(options.switchMovement && (options.display == "topleft" || options.display == "diagonaltop"))
						{
								if(reverseSwitch == false)
								{	
									blockSelectionJQ = blockOrder[options.display];
									reverseSwitch = true;							
								}
								else
								{	
									if(options.display == "topleft") blockSelectionJQ = blockOrder['bottomright'];
									if(options.display == "diagonaltop") blockSelectionJQ = blockOrder['diagonalbottom'];
									reverseSwitch = false;							
								}
						}	
						
						if(options.display == 'random')
						{
							blockSelectionJQ = slideWrapper.methods.fyrandomize(blockSelection);
						}

						if(options.display == 'all')
						{
							blockSelectionJQ = blockOrder[options.transitionOrder[currentTransition]];
							currentTransition ++;
							if(currentTransition >=  options.transitionOrder.length) currentTransition = 0;
						}
						

						//fire transition
						blockSelectionJQ.css({backgroundImage: nextImageBG, backgroundColor: '#000000'}).each(function(i)
						{	
							
							var currentBlock = $(this);
							setTimeout(function()
							{	
								var transitionObject = new Array();
								if(options.transition == 'drop')
								{
									transitionObject['css'] = {height:1, width:options.blockSize.width, display:'block',opacity:0};
									transitionObject['anim'] = {height:options.blockSize.height,width:options.blockSize.width,opacity:1};
								}
								else if(options.transition == 'fade')
								{
									transitionObject['css'] = {display:'block',opacity:0};
									transitionObject['anim'] = {opacity:1};
								}
								else
								{
									transitionObject['css'] = {height:1, width:1, display:'block',opacity:0};
									transitionObject['anim'] = {height:options.blockSize.height,width:options.blockSize.width,opacity:1};
								}
							
								currentBlock
								.css(transitionObject['css'])
								.animate(transitionObject['anim'],options.animationSpeed, function()
								{ 
									if(i+1 == blockNumber)
									{	
										slideWrapper.methods.changeImage(currentSlide, nextSlide);
									}
								});
							}, i*options.betweenBlockDelay);
						});
						
					} // end if(!skipSwitch && noAction == false)
					
					return false;
				},
				
				changeImage: function(currentSlide, nextSlide)
				{	
					currentSlide.css({zIndex:0, display:'none'});
					if(currentSlide.is('.videoSlideContainer'))
					{
						currentSlide.wrapInner('<div class="videowrap_temp" />');
						var videwrap = $('.videowrap_temp', currentSlide),
							clone = videwrap.clone(true);
						videwrap.remove();
						currentSlide.append(clone);
					}
					
					nextSlide.css({zIndex:3, display:'block'});
					nextSlide.find('img').css({display:'block',opacity:1});
					blockSelectionJQ.fadeOut(800, function(){ skipSwitch = false; optionsWrapper.data('animationActive', false); });
				},
				
				// array sorting
				fyrandomize: function(object) 
				{	
					var length = object.length,
						objectSorted = $(object);
						
					if ( length == 0 ) return false;
					
					while ( --length ) 
					{
						var newObject = Math.floor( Math.random() * ( length + 1 ) ),
							temp1 = objectSorted[length],
							temp2 = objectSorted[newObject];
						objectSorted[length] = temp2;
						objectSorted[newObject] = temp1;
					}
					return objectSorted;
				},
				
				kcubit: function(object)
				{
					var length = object.length, 
						objectSorted = $(object),	
						currentIndex = 0,		//index of the object that should get the object in "i" applied
						rows = Math.ceil(slideHeight / options.blockSize.height),
						columns = Math.ceil(slideWidth / options.blockSize.width),
						oneColumn = blockNumber/columns,
						oneRow = blockNumber/rows,
						modX = 0,
						modY = 0,
						i = 0,
						rowend = 0,
						endreached = false,
						onlyOne = false; 
					
					if ( length == 0 ) return false;
					for (i = 0; i<length; i++ ) 
					{
						objectSorted[i] = object[currentIndex];
						
						if((currentIndex % oneRow == 0 && blockNumber - i > oneRow)|| (modY + 1) % oneColumn == 0)
						{						
							currentIndex -= (((oneRow - 1) * modY) - 1); modY = 0; modX ++; onlyOne = false;
							
							if (rowend > 0)
							{
								modY = rowend; currentIndex += (oneRow -1) * modY;
							}
						}
						else
						{
							currentIndex += oneRow -1; modY ++;
						}
						
						if((modX % (oneRow-1) == 0 && modX != 0 && rowend == 0) || (endreached == true && onlyOne == false) )
						{	
							modX = 0.1; rowend ++; endreached = true; onlyOne = true;
						}	
					}
					
				return objectSorted;						
				}
			};
			
			slideWrapper.methods.init();	
		});
	};
})(jQuery);




// -------------------------------------------------------------------------------------------
// image preloader
// -------------------------------------------------------------------------------------------




/*allow external controlls like thumbnails*/
(function($)
{
	$.fn.aviaSlider_externalControlls = function(options) 
	{
		return this.each(function()
		{
			var defaults = 
			{
				slideControllContainer: '.slidecontrolls',
				newControllContainer: '.thumbnails_container',
				newControllElement: '.slideThumb',
				scrolling:'vertical',
				easing: 'easeInOutCirc',
				itemOpacity: 0.7,
				transitionTime: 2000
			};
			
			var options = $.extend(defaults, options);
		
			
		
			//click events
			var container				= $(this).parent('div'),
				element_container 		= $(options.newControllContainer, container).css({left:0, top:0}),
				element_container_wrap 	= element_container.parent('div'),
				elements_new 			= element_container.find(options.newControllElement).css({cursor:'pointer'}),
				elements_old 			= $(options.slideControllContainer, container).find('a');
			
			
			elements_new.find('img').css({opacity: options.itemOpacity});
			elements_new.filter(':eq(0)').find('img').css({opacity: 1});
			element_container.find('.style_border').css({opacity: 0.4});
			
			elements_new.bind('click', function()
			{
				if(container.data('animationActive') == true || $(this).is('.activeslideThumb')) return;
				
				var index = elements_new.index(this);
				elements_old.filter(':eq('+index+')').trigger('click');
				elements_new.removeClass('activeslideThumb').find('img').css({opacity: options.itemOpacity});
				$(this).addClass('activeslideThumb').find('img').css({opacity: 1});
				return false;
			});
			
		
			//add scroll event
			if(!options.scrolling) return false;
				
			if((options.scrolling == 'vertical' && element_container.height() > element_container_wrap.height()) || (options.scrolling == 'horizontal' && element_container.width() > element_container_wrap.width()))
			{
				var el_height = elements_new.outerHeight(true),
					el_width  = elements_new.outerWidth(true),
					button_prev = $('<a href="#" class="thumb_prev thumb_button">Previous</a>').css('opacity',0).appendTo(element_container_wrap),
					button_next = $('<a href="#" class="thumb_next thumb_button">Next</a>').css('opacity',0).appendTo(element_container_wrap),
					buttons 	= $('.thumb_button');
					
					button_prev.bind('click', {direction: -1}, slide);
					button_next.bind('click', {direction:  1}, slide);
					
					element_container_wrap.hover(
						function(){ buttons.stop().animate({opacity:1}); },
						function(){ buttons.stop().animate({opacity:0}); }
					);
			}

			
			function slide(obj)
			{
				var multiplier 	= obj.data.direction, 
					maxScroll	= "",
					animate 	= {};
				
				if(options.scrolling == 'vertical') 
				{
					maxScroll	= element_container_wrap.height() - element_container.height();
					animate 	= {top: '-='+ (el_height * multiplier)};
					
					if((maxScroll >  parseInt(element_container.css('top'),10) - (el_height * multiplier)) && multiplier === 1) 
					{
						animate = {top: 0};
					}
					else if(parseInt(element_container.css('top'),10) >= 0  && multiplier === -1) 
					{
						animate = {top: maxScroll};
					}
				}
				
				
				if(options.scrolling == 'horizontal') 
				{
					maxScroll = element_container_wrap.width() - element_container.width();
					animate = {left:'-='+ (el_width  * multiplier)};
					
					if((maxScroll >  parseInt(element_container.css('left'),10) - (el_width * multiplier)) && multiplier === 1) 
					{
						animate = {left: 0};
					}
					else if(parseInt(element_container.css('left'),10) >= 0  && multiplier === -1) 
					{
						animate = {left: maxScroll};
					}
				}
								
				element_container.animate(animate, options.easing); 
				return false;
			}

		});
	}
})(jQuery);

