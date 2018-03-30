/**
 * aviapoly Slider - A responsive jQuery image slider with advanced transition effects
 * (c) Copyright Christian "Kriesi" Budschedl
 * http://www.kriesi.at
 * http://www.twitter.com/kriesi/
 *
 */
 
 
(function($)
{
	$.fn.aviapoly = function(set_options, overwrite_methods) 
	{	
		var defaults = 
			{
				animation: false,
				pluginNameSpace: 'aviapoly',
				transition: 'aviapoly_fx',
				blockHeight: 'full',
				blockWidth:	'full',
				transitionFx: 'fade',
				betweenBlockDelay: 100,
				transitionSpeed:600,
				cssEasing: 	'cubic-bezier(0.250, 0.460, 0.450, 0.940)',		// easing for CSS transition
				easing: 'easeOutQuad'										// easing for JS transitions
			},
			
			options = $.extend({}, defaults, set_options),
		
			methods = 
			{

				aviapoly_fx: function(slider)
				{	
					//set height and widh of the slider
					methods.set_slide_option(slider);
					
					//generate the blocks for the next transition based on the slide options set above
					methods.generate_blocks(slider);
					
					//get all blocks, sort them and position them as needed
					methods.perpare_blocks(slider);
					
					//fire the transition
					setTimeout(function(){ methods.start_block_transition(slider); }, 100);
				},
				
				set_slide_option: function(slider)
				{
					var cur_height, cur_width, slideWidth = slider.width(), slideHeight = slider.height();
					//check if either width or height should be full container width			
					cur_height  = options.blockHeight == 'full'? slideHeight: options.blockHeight;
					cur_width   = options.blockWidth == 'full' ? slideWidth : options.blockWidth;
				
					slider.currentOptions = 
					{
						blockHeight: 	cur_height,
						blockWidth: 	cur_width,
						slideHeight:	slideHeight,
						slideWidth:		slideWidth
					};
					
					slider.currentOptions = $.extend({}, slider.options, slider.currentOptions);
					slider.methods.overwrite_options(slider.currentSlide, slider.currentOptions);
					
					
					if(slider.currentOptions.animation)
					{
						slider.methods.use_preset_animation(slider, slider.currentOptions.animation);
					}
				},
				
				
				
				perpare_blocks: function(slider)
				{
					slider.blocks = slider.find('.avBlock');
					
					if(slider.css_active && slider.isMobile)
					{
						if (slider.moveDirection > 0)
						{
							slider.blocks = $(slider.blocks.get().reverse()); 
						} 
					} 
					else if (slider.moveDirection < 0) 
					{ 
						slider.blocks = $(slider.blocks.get().reverse()); 
					}
					
					switch(slider.currentOptions.order)
					{
						case 'diagonal': slider.blocks = slider.methods.diagonal(slider.blocks, slider);  break;
						case 'random'  : slider.blocks = slider.methods.fyrandomize(slider.blocks, slider);  break;
					}
				},
				
				generate_blocks: function(slider)
				{
					slider.blockNumber 	= 0;
					var	posX 			= 0,
						posY 			= 0,
						generateBlocks 	= true,
						nextImage		= slider.nextSlide.find('img:eq(0)').attr('src'); 
					

					
					// start generating the blocks and add them until the whole image area
					// is filled. Depending on the options that can be only one div or quite many ;)
					while(generateBlocks)
					{					
						slider.blockNumber ++;
						
						var block = $('<div class="avBlock avBlock'+slider.blockNumber+'"></div>').appendTo(slider).css({	
								zIndex:20, 
								position:'absolute',
								overflow:'hidden',
								display:'none',
								left:posX,
								top:posY,
								height:slider.currentOptions.blockHeight,
								width:slider.currentOptions.blockWidth
							});
						
						var imagestring = '';
						if(nextImage) imagestring = '<img src="'+ nextImage +'" title="" alt="" />';
						
						var innerBlock = $('<div class="av_innerBlock">'+imagestring+'</div>').appendTo(block).css({	
								position:'absolute',
								left:-posX,
								top:-posY,
								height: slider.currentOptions.slideHeight,
								width:slider.currentOptions.slideWidth
							});
						
						posX += slider.currentOptions.blockWidth;
						
						if(posX >= slider.currentOptions.slideWidth)
						{
							posX = 0;
							posY += slider.currentOptions.blockHeight;
						}

						if(posY >= slider.currentOptions.slideHeight)
						{	
							//end adding Blocks
							generateBlocks = false;
						}
					} // end while
				},
				
				use_preset_animation: function(slider, animation)
				{
					var options = {},
						animationOptions = ["fade", "slide", "square", "square-fade", "square-random", "square-random-fade", "bar-vertical-top", "bar-vertical-side", "bar-vertical-mesh", "bar-vertical-random", "bar-horizontal-top", "bar-horizontal-side", "bar-horizontal-mesh", "bar-horizontal-random", "square-zoom", "bar-vertical-zoom", "bar-horizontal-zoom"],
						x = slider.currentOptions.slideWidth,
						y = slider.currentOptions.slideHeight,
						randomCount = animationOptions.length;
					
					if(!slider.css_active)	randomCount -= 3; //subtract the css3 transitions
					if(animation == 'random') animation = animationOptions[Math.floor(Math.random() * randomCount)];
					var squares = 8;
					
					switch(animation)
					{
						case "fade": options = { blockHeight: y, blockWidth: x, transitionFx: 'fade', betweenBlockDelay: 50, transitionSpeed:600, order:'' }; break;
						case "slide": options = { blockHeight: y, blockWidth: x, transitionFx: 'side', betweenBlockDelay: 50, transitionSpeed:600, order:'' }; break;
					
						case "square": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'slide', betweenBlockDelay: 50, transitionSpeed:600, order:'diagonal' }; break;
						case "square-fade": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'fade', betweenBlockDelay: 50, transitionSpeed:600, order:'diagonal' }; break;
						case "square-random": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'slide', betweenBlockDelay: 50, transitionSpeed:600, order:'random' }; break;
						case "square-random-fade": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'fade', betweenBlockDelay: 50, transitionSpeed:600, order:'random' }; break;
						case "square-zoom": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'zoom', betweenBlockDelay: 50, transitionSpeed:600, order:'diagonal' }; break;

						case "bar-vertical-top": options  = { blockHeight: y, blockWidth: Math.ceil(x/12), transitionFx: 'drop', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
						case "bar-vertical-side": options  = { blockHeight: y, blockWidth: Math.ceil(x/12), transitionFx: 'side-stay', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
						case "bar-vertical-mesh": options  = { blockHeight: y, blockWidth: Math.ceil(x/12), transitionFx: 'mesh-vert', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
						case "bar-vertical-random": options  = { blockHeight: y, blockWidth: Math.ceil(x/12), transitionFx: 'fade', betweenBlockDelay: 100, transitionSpeed:600, order:'random' }; break;
						case "bar-vertical-zoom": options  = { blockHeight: y, blockWidth: Math.ceil(x/12), transitionFx: 'zoom', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;

						case "bar-horizontal-top": options  = { blockHeight: Math.ceil(y/6), blockWidth: x, transitionFx: 'drop', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
						case "bar-horizontal-side": options  = { blockHeight: Math.ceil(y/6), blockWidth: x, transitionFx: 'side', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
						case "bar-horizontal-mesh": options  = { blockHeight: Math.ceil(y/6), blockWidth: x, transitionFx: 'mesh-hor', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
						case "bar-horizontal-random": options  = { blockHeight: Math.ceil(y/6), blockWidth: x, transitionFx: 'fade', betweenBlockDelay: 100, transitionSpeed:600, order:'random' }; break;
						case "bar-horizontal-zoom": options  = { blockHeight: Math.ceil(y/6), blockWidth: x, transitionFx: 'zoom', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
					}
					
					$.extend(slider.currentOptions, options);

				},
				
				start_block_transition: function(slider)
				{
					//fire transition
					slider.blocks.each(function(i)
					{	
						var currentBlock = $(this);
						
						setTimeout(function()
						{	
							var transitionObject = new Array();
							transitionObject['css']  = {display:'block',opacity:0};
							transitionObject['anim'] = {opacity:1};

							switch(slider.currentOptions.transitionFx)
							{
								case 'fade':
									//default opacity fade defined above
								break;
							
								case 'drop':
									if(slider.isMobile) 
									{
										var modifier = 1;
										if(slider.moveDirection < 0) modifier = modifier * -1;
										
										transitionObject['css'][slider.css_prefix+'transform-origin'] = '0 0';
										transitionObject['css'][slider.css_prefix+'transform'] = 'rotate(0deg) scale(1, 0.1) skew(0deg, 0deg)';
										transitionObject['anim'][slider.css_prefix+'transform'] ='rotate(0deg) scale(1,1) skew(0deg, 0deg)';
									}
									else
									{
										transitionObject['css']['height'] 	= 1;
										transitionObject['css']['width']  	= slider.currentOptions.blockWidth;
										
										transitionObject['anim']['height']  = slider.currentOptions.blockHeight;
										transitionObject['anim']['width']  	= slider.currentOptions.blockWidth;
									}
								break;
								
								case 'side':
								
									var modifier = -1;
									if(slider.moveDirection < 0) modifier = 1;
									if(slider.isMobile) 
									{
										modifier = modifier * -1;
										transitionObject['css'][slider.css_prefix+'transform'] = 'translateX('+( slider.currentOptions.slideWidth * modifier) +'px)';
										transitionObject['anim'][slider.css_prefix+'transform'] ='translateX(0px)';
									
									}
									else
									{
										transitionObject['css']['left']  = slider.currentOptions.slideWidth * modifier;
										transitionObject['anim']['left'] = parseInt(currentBlock.css('left'),10);
									}
								break;
								
								
								case 'side-stay':
									if(slider.isMobile) 
									{
										transitionObject['css'][slider.css_prefix+'transform'] = 'rotate(0deg) scale(0.1,1) skew(0deg, 0deg)';
										transitionObject['anim'][slider.css_prefix+'transform'] ='rotate(0deg) scale(1,1) skew(0deg, 0deg)';
									}
									else
									{
										transitionObject['css']['width']  	= 1;
										transitionObject['anim']['width']  	= slider.currentOptions.blockWidth;
									}
								break;
								
								
								case 'zoom': 
									transitionObject['css'][slider.css_prefix+'transform'] = 'rotate(0deg) scale(2) skew(0deg, 0deg)';
									transitionObject['anim'][slider.css_prefix+'transform'] ='rotate(0deg) scale(1) skew(0deg, 0deg)';
								break;
	
								
								case 'mesh-vert':
								
									var modifier = -1;
									if(i % 2) modifier = 1;
									
									if(slider.isMobile)
									{
										transitionObject['css'][slider.css_prefix+'transform'] = 'translateY('+( slider.currentOptions.slideWidth * modifier) +'px)';
										transitionObject['anim'][slider.css_prefix+'transform'] ='translateY(0px)';
									}
									else
									{
										transitionObject['css']['top']  = slider.currentOptions.slideHeight * modifier;
										transitionObject['anim']['top'] = parseInt(currentBlock.css('top'),10);
									}
								break;
								
								case 'mesh-hor':
									var modifier = -1;
									if(i % 2) modifier = 1;
									
									if(slider.isMobile)
									{
										transitionObject['css'][slider.css_prefix+'transform'] = 'translateX('+( slider.currentOptions.slideWidth * modifier) +'px)';
										transitionObject['anim'][slider.css_prefix+'transform'] ='translateX(0px)';
									}
									else
									{
										transitionObject['css']['left']  = slider.currentOptions.slideWidth * modifier;
										transitionObject['anim']['left'] = parseInt(currentBlock.css('left'),10);
									}
									
								break;
								
								case 'slide':
									if(slider.isMobile)
									{
										transitionObject['css'][slider.css_prefix+'transform'] = 'rotate(0deg) scale(0.1) skew(0deg, 0deg)';
										transitionObject['anim'][slider.css_prefix+'transform'] ='rotate(0deg) scale(1) skew(0deg, 0deg)';
									}
									else
									{
										transitionObject['css']['height'] 	= 1;
										transitionObject['css']['width']  	= 1;
										
										transitionObject['anim']['height']  = slider.currentOptions.blockHeight;
										transitionObject['anim']['width']  	= slider.currentOptions.blockWidth;
									}
								break;
							
							
							}
				
						
							currentBlock.css(transitionObject['css']);
														
							slider.methods.animate(currentBlock, transitionObject['anim'], function()
							{ 
								if(i+1 == slider.blockNumber)
								{	
									slider.methods.change_finished(false, slider);
								}
							}, true);
							
							
						}, i*slider.currentOptions.betweenBlockDelay);
					});
				},
				
				clean_up_hook: function(slider)
				{
					if(!slider.blocks || !slider.blocks.length) return;
					
					slider.methods.remove_css_transition(slider.blocks);
				
					var fadeOut = 10;
					if(slider.currentSlide.is('.withCaption')) fadeOut = 500;
					
					slider.blocks.animate({opacity:0}, fadeOut, function()
					{
						slider.blocks.remove();
						slider.animating 	= false;
					});
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
				
				diagonal: function(object, slider)
				{
					var length = object.length, 
						objectSorted = $(object),	
						currentIndex = 0,		//index of the object that should get the object in "i" applied
						rows = Math.ceil(slider.currentOptions.slideHeight / slider.currentOptions.blockHeight),
						columns = Math.ceil(slider.currentOptions.slideWidth / slider.currentOptions.blockWidth),
						oneColumn = slider.blockNumber/columns,
						oneRow = slider.blockNumber/rows,
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
						
						if((currentIndex % oneRow == 0 && slider.blockNumber - i > oneRow)|| (modY + 1) % oneColumn == 0)
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
 		
		return this.avia_base_slider(options, methods);
	}
	
})(jQuery);
 
 
 
/**
 * Avia Base Slider - A responsive jQuery image slider, capable of displaying video and a good starting point for modified slideshows 
 * (c) Copyright Christian "Kriesi" Budschedl
 * http://www.kriesi.at
 * http://www.twitter.com/kriesi/
 *
 * Help Sources:
 * http://www.w3schools.com/css3/css3_user_interface.asp
 * http://googlecode.blogspot.com/2010/08/css3-transitions-and-transforms-in.html
 * http://stackoverflow.com/questions/5819912/webkit-transition-end-in-mozilla-and-opera
 * http://www.the-art-of-web.com/css/css-animation/
 * http://matthewlein.com/ceaser/
 * http://www.zackgrossbart.com/hackito/touchslider/
 * http://www.sitepen.com/blog/2008/07/10/touching-and-gesturing-on-the-iphone/
 * http://www.learningjquery.com/2007/10/a-plugin-development-pattern
 * http://fluidproject.org/blog/2008/08/04/in-praise-of-jqueryextend/
 */


/* this prevents dom flickering, needs to be outside of dom.ready event: */
document.documentElement.className += ' js_active ';
/*end dom flickering =) */


(function($)
{
	var slideshow_counter = 0;
	
	$.fn.avia_base_slider = function(options, overwrite_methods) 
	{
		var pluginNameSpace = 'avia_base',
		
		resize_helper	= function()
		{
			var $window = $(window), resize_timeout = "";
			$window.bind('resize.'+pluginNameSpace, function(){	
				clearTimeout(resize_timeout);
				resize_timeout =  setTimeout(function(){$window.trigger('resize_finished.'+pluginNameSpace)}, 500);
			});
		};
		
	
		//activate helper
		if(this.length)
		{
			resize_helper();
		}
	
		//iterate over all slideshows
		return this.each(function()
		{	
			slideshow_counter++;
						
			var slider =  $(this), 
			
			methods = {
			
				preload: function(slider)
				{
					methods.append_caption();
					var delay = 0, fadeInSpeed = 0;
					if(slider.options.globalDelay)
					{
						delay = slideshow_counter * slider.options.globalDelay;
						fadeInSpeed = 10;
					}
					
					slider.aviaImagePreloader({fadeInSpeed: fadeInSpeed, globalDelay: delay },function(){ methods.init.apply( slider ); });
				},
					
				init: function()
				{
				
					methods.init_hook(slider);
					methods.overwrite_options(slider, slider.options);
					methods.set_slide_proportions(false, function(){ methods.img_ready_hook(slider) }, true);
					methods.set_video_slides();
					methods.bind_events();
					methods.css_setup_and_display();
					methods.append_controls();
					methods.activate_touch_control();
					methods.start_autorotation();
				},
				
				init_hook: function(slider)
				{
					//blank function which can be used to modify the slider behaviour by another plugin building upon it
				},
				
				img_ready_hook: function(slider)
				{
					//blank function which can be used to modify the slider behaviour by another plugin building upon it
				},
				
				first_img_displayed_hook: function(slider)
				{
					//blank function which can be used to modify the slider behaviour by another plugin building upon it
					slider.removeClass('preloading');
				},
				
				bind_events: function()
				{
					//handle resizing
					var win = $(window);
					win.bind('resize.'+pluginNameSpace, methods.set_slide_proportions);
					
					//handle clicking on slide controls
					slider.bind('switch.'+pluginNameSpace , methods.try_slide_transition);
					
					//slide transitioning
					slider.slides.bind("webkitTransitionEnd oTransitionEnd OTransitionEnd transitionend mozTransitionEnd",  methods.change_finished);
					
					//stop autorotation if link inside the slider is clicked
					slider.find('a').bind('click.'+pluginNameSpace, methods.pause_slider);
				
					//show videos
					slider.slides.bind('click.'+pluginNameSpace, function()
					{ 
						var clicked_item = $(this);
						
						if(clicked_item.is('.comboslide'))
						{
							if(clicked_item.find('img:visible').length)
							{	
								methods.showvideo(clicked_item); 
								methods.pause_slider();
								return false; 
							}
						}
					});
				},
				
				set_slide_proportions: function(event, callback)
				{
					slider.proportions = 16 / 9; //default width if no image is available
					if(slider.currentImg) slider.proportions = slider.currentImg.width / slider.currentImg.height;
					var properties = {height:slider.width() / slider.proportions};
					
					if(event && event.originalEvent && event.originalEvent.type == 'resize') 
					{
						methods.remove_css_transition(slider);
						slider.css(properties); 
					}
					else
					{
						methods.animate(slider, properties, callback, true);
					}
				},
				
				try_set_slide_proportions: function() //checks if the next image is smaller and resizes the container at the start of the transition
				{
					var nextImg = slider.nextSlide.find('img').get(0);
					
					if(nextImg)
					{
						var	nextProportions = nextImg.width / nextImg.height;
						
						if(nextProportions > slider.proportions)
						{
							slider.currentImg = nextImg;
							methods.set_slide_proportions(false);
						}
					}
				},
								
				css_setup_and_display: function()
				{
					slider.currentSlide.css({zIndex: 3, opacity:0, visibility:'visible'});
					slider.slides.each(function(i)
					{
						if($.browser.msie) $(this).css({backgroundColor:'#000000'}); //fix iebug where images appear buggy
						$(this).css({position:'absolute'}).addClass('slide_number_'+ (i+1));
					});

					//display the fist slide. default jquery animation is sufficient
					slider.currentSlide.animate({opacity:1}, 1200, function()
					{
						methods.first_img_displayed_hook(slider);
					});
					
				},
				/************************************************************************
				SECTION: Video helper
				*************************************************************************/	
				
				set_video_slides: function()
				{
					slider.slides.each(function(i)
					{
						var currentslide 	= $(this);
						var imageslide 		= currentslide.find('img');
						var videoslide		= currentslide.find('video, embed, object, iframe, .avia_video').attr('wmode','opaque');
						var iframe			= currentslide.find('iframe');
						var src 			= iframe.attr('src');
						var classname		= 'emptyslide';
						
						if(src)
						{
							if(src.indexOf('?') !== -1)
							{
								src += "&wmode=opaque";
							}
							else
							{
								src += "?wmode=opaque";
							}
							
							iframe.attr('src', src);
						}
						
						if(imageslide.length && videoslide.length)
						{
							classname = 'comboslide';
						}
						else if(videoslide.length)
						{
							classname = 'videoslide';
						}
						else if(imageslide.length)
						{
							classname = 'imageslide';
						}
						
						currentslide.addClass(classname).append('<span class="slideshow_overlay"></span>');
						
						// initialy google chrome youtube fix: youtube videos need to be hidden and then shown before they respond to zIndex properties
						// now used on every video only slide
						if(classname == 'videoslide')
						{
							videoslide.css({display:"none"});
							setTimeout(function()
							{
								videoslide.css({display:"block"});
							},10)
						}					
						
					});
				},
				
							
				showvideo: function(clicked_item)
				{
					var iframe 	= clicked_item.find('iframe'),
						param	= clicked_item.find('param[name=movie]'),
						embed	= clicked_item.find('embed')
						object	= clicked_item.find('object')
						src = "";
						
					//try to activate autoplay
					if(iframe.length)
					{
						src = iframe.attr('src');
						if(src && slider.options.try_video_autoplay)
						{
							src += "&autoplay=1";
							iframe.attr('src', src);
						}
						
						iframe.css('display','block');
					}
					
					if(object.length)
					{
						src = param.val();
						if(src && slider.options.try_video_autoplay)
						{
							if(src.indexOf('?') !== -1){ src += "&amp;autoplay=1"; }
							else { src += "?autoplay=1"; }
							param.val(src);
						}
						object.css('display','block');
					}
					
					if(embed.length)
					{
						src = embed.attr('src');
						if(src && slider.options.try_video_autoplay)
						{
							if(src.indexOf('?') !== -1){ src += "&amp;autoplay=1"; }
							else { src += "?autoplay=1"; }
							embed.attr('src',src)
						}
						embed.css('display','block');
					}
					
					clicked_item.find('.slideshow_overlay, .'+slider.options.captionClass).stop().animate({opacity:0}, function()
					{
						$(this).css({zIndex:0, visibility:'hidden', display:'none'});
					});
					
					setTimeout(function(){
					clicked_item.find('img, canvas').stop().animate({opacity:0}, function()
					{
						$(this).css({zIndex:0, visibility:'hidden', display:'none'});
					});
					},200);
				},

				
				/************************************************************************
				SECTION: Animation helper
				*************************************************************************/
				
				set_css_transition: function(element)
				{
					var property 	= slider.css_prefix + 'transition',
						transition  = [];
						
					transition[property] = 'all '+(slider.options.transitionSpeed/1000)+'s '+slider.options.cssEasing;
					element.css(transition);
				},
				
				remove_css_transition: function(element)
				{
					var property 	= slider.css_prefix + 'transition',
						transition  = [];
						
					transition[property] = "none";
					element.css(transition);
				},
				
				animate: function(element, properties, callback, callback_by_timeout)
				{
				
					if(slider.css_active)
					{
						setTimeout(function(){ methods.set_css_transition(element); },10);
						setTimeout(function(){ element.css(properties); },20);
						if(callback && callback_by_timeout) setTimeout(function(){callback.call();}, slider.options.transitionSpeed);
					}
					else
					{
						element.animate(properties, slider.options.transitionSpeed, slider.options.easing, callback);
					}
				
				},
				
				
				/************************************************************************
				SECTION: ADD controls
				*************************************************************************/
				
				append_controls: function()
				{
					if(slider.count > 1 && (!slider.isMobile ||  slider.isMobile && !slider.options.forceMobile))
					{
						slider.controls.numeric = $('<div class="numeric_controls slide_controls"></div>').insertAfter(slider);
						
						//numeric controls
						var active_class = "class='active_item'";
						slider.slides.each(function(i)
						{
							$('<a '+active_class+' href="#" data-show-slide="'+i+'" >'+(i+1)+'</a>').appendTo(slider.controls.numeric); active_class = "";
						});
						
					
						//arrow controls
						var labels = ['previous', 'pause_play', 'next']; 
						slider.controls.arrow = $('<div class="arrow_controls slide_controls"></div>').insertAfter(slider); 
						for (x in labels)
						{
							var extra_class = 'class = "ctrl_'+labels[x]+'"';
							
							if(labels[x] == "pause_play")
							{
								if(slider.options.autorotation == false)
								{
									labels[x] = 'Play';
								}
								else
								{
									extra_class = 'class = "ctrl_active_rotation ctrl_'+labels[x]+'"';
									labels[x] = 'Pause';
								}
							} 
							
							if(typeof labels[x] == 'string')
							{
								$('<a '+extra_class+' href="#" data-show-slide="'+labels[x]+'" >'+labels[x]+'</a>').appendTo(slider.controls.arrow); 
							}
						}
						
						slider.pauseButton = slider.controls.arrow.find('.ctrl_pause_play');
						methods.activate_controls();
					}
				},
				
				activate_controls: function()
				{
					slider.pauseButton.bind('click', function(){ methods.toogle_autorotation(); return false;})	
				
					slider.controls.numeric.find('a').bind('click', function()
					{ 
						methods.pause_slider(); slider.trigger('switch.'+pluginNameSpace, this); return false;
					});
							
					slider.controls.arrow.find('a').not('.ctrl_pause_play').bind('click',function()
					{ 
						methods.pause_slider(); slider.trigger('switch.'+pluginNameSpace, this); return false;
					})	
						
				},
				
				new_active_control: function(target)
				{
					var controls = slider.controls.numeric.find('a').removeClass('active_item');
					controls.filter(':eq('+target+')').addClass('active_item');
				},
				
				activate_touch_control:function()
				{
					if(slider.css_active && slider.isMobile)
					{
						slider.touchPos = {};
						if(slider.options.forceMobile) slider.options.transition = 'move';
						
						slider.bind('touchstart', function(event)
						{
							slider.touchPos.X = event.originalEvent.touches[0].clientX;
							slider.touchPos.Y = event.originalEvent.touches[0].clientY;
						});
						
						slider.bind('touchend', function(event)
						{
							slider.touchPos = {};
			                event.preventDefault();
						});
						
						slider.bind('touchmove', function(event)
						{
							if(!slider.touchPos.X) 
							{
								slider.touchPos.X = event.originalEvent.touches[0].clientX;
								slider.touchPos.Y = event.originalEvent.touches[0].clientY;
							}
							else
							{
								var differenceX = event.originalEvent.touches[0].clientX - slider.touchPos.X; 
								var differenceY = event.originalEvent.touches[0].clientY - slider.touchPos.Y; 
								
								//check if user is scrolling the window or moving the slider
								if(Math.abs(differenceX) > Math.abs(differenceY)) 
								{
									event.preventDefault();
									
									if(!slider.animating)
									{	
										if(slider.touchPos != event.originalEvent.touches[0].clientX)
										{
											if(Math.abs(differenceX) > 50)
											{
												var move = differenceX > 0 ? 'previous' : 'next';
												
												methods.pause_slider();
												methods.try_slide_transition(false, move);
												slider.touchPos = {};
												return false;
						                	}
						                }
						
					                }
				                }
			                }
		            	});
					}
				},
								
				
				/************************************************************************
				SECTION: Autorotation
				*************************************************************************/	
							
				start_autorotation: function()
				{
					if(slider.count)
					{
						slider.interval = setInterval(function()
						{
							if(slider.options.autorotation)
							{	
								slider.trigger('switch.'+pluginNameSpace, 'next');
							}
						}, 
						slider.options.autorotationTimer * 1000);
					}
				},
				
				
				toogle_autorotation: function()
				{
					if(slider.options.autorotation)
					{
						methods.pause_slider();
					}
					else
					{
						methods.unpause_slider();
					}
				},

				pause_slider: function()
				{
					if(slider.pauseButton.length) slider.pauseButton.removeClass('ctrl_active_rotation').text('Play');
					slider.options.autorotation = false;
					clearInterval(slider.interval);
				},
				
				unpause_slider: function()
				{
					if(slider.pauseButton.length) slider.pauseButton.addClass('ctrl_active_rotation').text('Pause');
					slider.options.autorotation = true;
					methods.try_slide_transition(false, 'next');
					methods.start_autorotation();
				},
				
				try_slide_transition: function(event, target)
				{
					slider.moveDirection = false;
					target = methods.calculate_target(target);
				
					if(slider.animating) return false;
					if(target == slider.currentIndex) return false;
					
					slider.nextIndex = target;
					slider.animating = true;
					methods.change_slides(target);
				},
				
				/************************************************************************
				SECTION: Append Caption
				*************************************************************************/
				
				append_caption: function(slider_passed)
				{
					if(slider_passed) slider = slider_passed;
					
					slider.slides.each(function()
					{
						var current 	= $(this),
							caption 	= current.data('caption'),
							container 	= "div",
							link 		= current.find('a'),
							href		= "";
						
						if(caption)
						{
							if(!$(caption).find('a').length && link.length)
							{
								href = "href='"+link.attr('href')+"'";
								container = "a";
							}
							
							current.addClass('withCaption');
							var current_caption = $("<"+container+" "+href+" class='slideshow_caption'><div class='slideshow_inner_caption'><div class='slideshow_align_caption'>"+caption+"</div></div></"+container+">").appendTo(current);
						}
					});
					
					
					
				},
				
				/************************************************************************
				SECTION: CHANGE SLIDES
				*************************************************************************/
				
				calculate_target: function(target)
				{
					if(typeof target == 'object') target = $(target).data('show-slide');
					switch(target)
					{
						case 'next': target = slider.currentIndex + 1; slider.moveDirection = 1000; break;
						case 'previous': target = slider.currentIndex - 1; slider.moveDirection = -1000; break;
					}
					
					if(slider.currentIndex > target) slider.moveDirection = -1000;
					if(target < 0) target = slider.count - 1;
					if(target == slider.count) target = 0;
					
					return target;
				},
				
				change_slides: function(target)
				{
					
					methods.new_active_control(target);
					slider.nextSlide = slider.slides.filter(':eq('+target+')');
					methods.try_set_slide_proportions();
					methods[slider.options.transition].call(this, slider);
				},
				
				fade: function()
				{
					slider.nextSlide.css({display:'block', zIndex:2, opacity:1});
					methods.animate(slider.currentSlide, {opacity:0}, methods.change_finished);
				},
				
				move: function()
				{
					var sliderWidth = slider.width(),
						transition  = [],
						transition2  = [],
						modifier 	= -1;
					
					if(slider.currentIndex > slider.nextIndex) modifier = 1;
					if(slider.moveDirection)
					{
						if(slider.moveDirection > 0) modifier = -1;
						if(slider.moveDirection < 0) modifier =  1;
					}
					
					
					slider.nextSlide.css({display:'block', zIndex:4, opacity:1, left:0, top:0});
					if(slider.css_active)
					{
						var property  = slider.css_prefix + 'transform';
						
						slider.nextSlide.css(property, "translate(" + ( sliderWidth * modifier * -1) + "px,0)");
						transition[property]  = "translate(" + ( sliderWidth * modifier) + "px,0)";
						transition2[property] = "translate(0,0)";
					}
					else
					{
						slider.nextSlide.css({left:sliderWidth * modifier * -1});
						transition['left'] = sliderWidth * modifier;
						transition2['left'] = 0;
					}
					
					methods.animate(slider.nextSlide,    transition2, methods.change_finished);
					methods.animate(slider.currentSlide, transition);
				},
				
				change_finished: function(event, slider_passed)
				{	
					if(slider_passed) slider = slider_passed;
					
					if(event) methods.remove_css_transition($(event.target));
					slider.slides.css({display:'none', zIndex:1});
					
					slider.currentSlide	= slider.nextSlide.css({display:'block', zIndex:3, left:0, top:0});
					slider.currentIndex	= slider.slides.index(slider.currentSlide);
					slider.currentImg	= slider.currentSlide.find('img').get(0);
					methods.set_slide_proportions();
					methods.clean_up_hook(slider);
					
				},
				
				clean_up_hook: function(slider)
				{
					//blank fanction which can be used to modify the slider behaviour by another plugin building upon it
					slider.animating 	= false;
				},
				
				
				/************************************************************************
				methods.overwrite_defaults:
				
				lets you overwrite options for multiple sliders on one page with different 
				settings, without the need to call the slider function multiple times
				*************************************************************************/
				overwrite_options: function(element, array)
				{
					var htmlData = element.data(),
					i = "";
					
					for (i in htmlData)
					{
					
						if(typeof htmlData[i] == "string" || typeof htmlData[i] == "number" || typeof htmlData[i] == "boolean")
						{
							array[i] = htmlData[i];
						}
					}
						
				},
				
				css3_transition_check: function()
				{
					if("webkitTransition" in document.body.style)
					{
						slider.css_active		= true;
						slider.css_prefix		= "-webkit-";
					}
					 
					if("msTransition" in document.body.style)
					{
						slider.css_active		= true;
						slider.css_prefix		= "-ms-";
					}
					
					if("MozTransition" in document.body.style)
					{
						slider.css_active		= true;
						slider.css_prefix		= "-moz-";
					}
					
					if("OTransition" in document.body.style)
					{
						slider.css_active		= true;
						slider.css_prefix		= "-o-";
					}
					
					if("transition" in document.body.style)
					{
						slider.css_active		= true;
						slider.css_prefix		= "";
					}
					/**/

				}
				
			},
			
			//default slideshow settings. can be overwritten by passing different values when calling the function 
			defaults = 
			{
				autorotation: 		false,				// autorotation true or false?
				autorotationTimer:	6,					// duration between autorotation switch in Seconds
				transitionSpeed: 	400,				// animation speed
				cssEasing: 			'cubic-bezier(0.560, 0.000, 0.070, 1.000)',		// easing for CSS transition
				easing: 			'easeInOutQuint',	// easing for JS transitions
				slides: 			'li',				// wich element inside the container should serve as slide
				pluginNameSpace:	'avia_base',		// define a plugin namespace
				transition:			'move',				// fade or move the slider
				forceMobile:		 false,				// forces the mobile version to mobile devices: only fade animation and touch gestures
				captionClass:		'slideshow_caption',//
				try_video_autoplay:	 true,				// try to start video autoplay once a user opens a slideshow video for the first time
				globalDelay:		0					// delay of appearance for multiple slideshows
			};
			
			//merge default options and options passed by the user, then collect some slider data
			slider.methods			= $.extend(methods, $.fn.avia_base_slider.methods , overwrite_methods);
			slider.options 			= $.extend({}, defaults, $.fn.avia_base_slider.defaults, options);
			slider.slides			= slider.find(slider.options.slides);
			slider.count 			= slider.slides.length;
			slider.animating		= false;
			slider.currentIndex		= 0;
			slider.nextIndex		= 0;
			slider.currentSlide		= slider.slides.filter(':eq('+slider.currentIndex+')');
			slider.nextSlide		= slider.currentSlide;
			slider.moveDirection	= false;
			slider.currentImg		= slider.currentSlide.find('img').get(0);
			slider.isMobile 		= 'ontouchstart' in document.documentElement;
			slider.proportions		= 16 / 9; //default value if we got a pure video slideshow
			slider.controls			= {};
			slider.pauseButton		= {};
			slider.interval 		= false;
			slider.css_active		= false;
			slider.css_prefix		= false;
			
			if(slider.options.pluginNameSpace) pluginNameSpace = slider.options.pluginNameSpace;
			
			methods.css3_transition_check();
			methods.preload(slider);
		
	});
	
}
	
})(jQuery);








// -------------------------------------------------------------------------------------------
// show/hide controls
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_base_control_hide = function() 
	{
		return this.each(function()
		{
			var container 	= $(this).parent();
			var controls;
			var isMobile    = 'ontouchstart' in document.documentElement
			
			if(!isMobile)
			{
					//next button click
					container.delegate('.nextSlide', 'click', function()
					{
						container.find('.ctrl_next').trigger('click');
					});
					
					
					/*
					container.delegate('.slideshow_caption, .slideshow_inner_caption', 'mouseleave', function(event)
					{
						container.trigger('mouseenter');
					});
					
					container.delegate('.slideshow_caption, .slideshow_inner_caption', 'mouseenter', function(event)
					{
						container.trigger('mouseleave');
					});
		*/
					
					
					//hover event
					container.hover(function(event)
					{
						//if($(event.target).is('.slideshow_caption, .slideshow_inner_caption')) return;
						controls = container.find('.slide_controls a').stop().css({display:'block', opacity:0}).animate({opacity:0.9});
					},
					
					function(event)
					{
						if(!controls) return;
					
						controls.stop().animate({opacity:0}, function()
						{
							controls.css({opacity:0});
						});
					});
			
			}

		});
	};
})(jQuery);



// -------------------------------------------------------------------------------------------
// external controls
// -------------------------------------------------------------------------------------------

(function($)
{
	$.fn.avia_external_controls = function() 
	{
		return this.each(function()
		{
			var container 	= $(this).parent();
			var controls 	= container.next('.thumbnails_container'),
				thumbs 		= controls.find('.slideThumb');

			if(!controls.length) return;
			
			//next button click
			controls.delegate('.slideThumb', 'click', function(event)
			{
				thumbs.removeClass('activeslideThumb');
				var current = $(this).addClass('activeslideThumb');
				var index = thumbs.index(this);
				container.find('.numeric_controls a:eq('+index+')').trigger('click');
			});

		});
	};
})(jQuery);



// -------------------------------------------------------------------------------------------
// image preloader
// -------------------------------------------------------------------------------------------

(function($)
{
	var aviaGlobalCount = 0

	$.fn.aviaImagePreloader = function(variables, callback) 
	{
		var defaults = 
		{
			css_before_show:{},
			css_show:{},
			fadeInSpeed: 800,
			delay:0,
			maxLoops: 10,
			thisData: {},
			globalDelay:0,
			data: ''
		};
		
		var options 	= $.extend(defaults, variables),
			isMobile	= 'ontouchstart' in document.documentElement;
		
		aviaGlobalCount = aviaGlobalCount + this.find('img').length;
		
		return this.each(function()
		{
			var container 	= $(this),
				images		= $('img', this),
				parent = images.parent(),
				imageCount = images.length,
				interval = '',
				greyscale_active = container.parents('.greyscale-active').length || container.is('.greyscale-active'),
				allImages = images ;
			
			if(isMobile) greyscale_active = false;			
			
			var methods = 
			{
				checkImage: function()
				{
					images.each(function(i)
					{
						if(this.complete == true) 
						{
							images = images.not(this);
							if(greyscale_active) methods.greyscaler(this);
						}
					});
					
					if(images.length && options.maxLoops >= 0)
					{
						options.maxLoops--;
						setTimeout(methods.checkImage, 500);
					}
					else
					{
						methods.showImages();
					}
					
					
				},
				
				showImages: function()
				{
					setTimeout(function()
					{
						allImages.each(function(i)
						{
							var currentImage = $(this);
							methods.showSingleImage(currentImage, i);
						});
					},
					options.globalDelay);
				},
				
				showSingleImage: function(currentImage, i)
				{	
					aviaGlobalCount --;
					
					if(options.css_before_show) currentImage.css(options.css_before_show);
					if(options.css_show) currentImage.animate(options.css_show, options.fadeInSpeed);
					
					if(allImages.length == i+1) 
					{
						if(aviaGlobalCount == 0) { $(window).trigger('avia_images_loaded'); }
						
						methods.callback(i);
					}
				},
				
				callback: function()
				{		
					if (variables instanceof Function) { callback = variables; }
					if (callback  instanceof Function) { callback.call(options.thisData, options.data);  }
				},
				
				greyscaler: function(image)
				{
					var clone, $img = $(image);
				
					if ($.browser.msie && $.browser.version < 9) 
					{
						clone = img.clone().addClass('greyscale-image').appendTo(img);
						
						var cloneEl = clone.get(0);
						cloneEl.src = currentImage.attr('src');
						cloneEl.style.filter = "progid:DXImageTransform.Microsoft.BasicImage(grayScale=1)";
					} 
					else 
					{
						clone = avia_grayscale(image, $img)
						clone.insertAfter($img).addClass('greyscale-image');
					}
				},
				
				greyscale_bindings: function()
				{
					$(".greyscale-active").delegate(".flex_column", "mouseenter", function() 
					{
						var column 	= $(this), image = column.find('.greyscale-image');
					  	image.stop().animate({opacity:0},200);
					}
					).delegate(".flex_column", "mouseleave", function() 
					{
						var column 	= $(this), image = column.find('.greyscale-image');
					  	image.stop().animate({opacity:1},200);
					});

				}
			};
			
			if(greyscale_active) methods.greyscale_bindings();
			if(!images.length) { methods.callback(); if(aviaGlobalCount == 0) { $(window).trigger('avia_images_loaded'); } return }
			
			methods.checkImage();

		});
	};
})(jQuery);






function avia_grayscale(image, $img)
{
		var canvas = document.createElement('canvas');
		var ctx = canvas.getContext('2d');
		var newData = $img.data();
		
		if(newData.imgh > 0)
		{
			canvas.width = newData.imgw;
			canvas.height = newData.imgh;
		}
		else
		{
			var w = $img.attr('width'), h = $img.attr('height');
			if(w && h)
			{
				canvas.width = w;
				canvas.height = h;
			}
		}
		
	  	ctx.drawImage(image, 0, 0); 
		var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
		for(var y = 0; y < imgPixels.height; y++){
			for(var x = 0; x < imgPixels.width; x++){
				var i = (y * 4) * imgPixels.width + x * 4;
				var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
				imgPixels.data[i] = avg; 
				imgPixels.data[i + 1] = avg; 
				imgPixels.data[i + 2] = avg;
			}
		}
		ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
		
		return jQuery(canvas);
		  
		
    }









jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});









function avia_log(text) 
{
	var ios = navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/);
	( (window.console && console.log && !ios) || (window.opera && opera.postError && !ios) ||  avia_text_log).call(this, text);
	
	function avia_text_log(text)
	{
		var logfield = jQuery('.avia_logfield');
		if(!logfield.length) logfield = jQuery('<pre class="avia_logfield"></pre>').appendTo('body').css({	zIndex:100000, 
																											padding:"20px", 
																											backgroundColor:"#ffffff", 
																											position:"fixed", 
																											top:0, right:0, 
																											width:"300px",
																											borderColor:"#cccccc",
																											borderWidth:"1px",
																											borderStyle:'solid',
																											height:"600px",
																											overflow:'scroll',
																											display:'block',
																											zoom:1
																											});
		var val = logfield.html();
		var text = avia_get_object(text);
		logfield.html(val + "\n<br/>" + text);
	}
	
	function avia_get_object(obj)
	{
		var sendreturn = obj;
		
		if(typeof obj == 'object' || typeof obj == 'array')
		{
			for (i in obj)
			{
				sendreturn += "'"+i+"': "+obj[i] + "<br/>";
			}
		}
		
		return sendreturn;
	}
}

