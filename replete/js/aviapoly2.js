(function($)
{
	"use strict";
	
	$.avia_utilities = $.avia_utilities || {};
	
	$.fn.aviapoly = function(passed_options) 
	{
		var win		= $(window),
		slideshows	= this,
		defaults		= 
		{
			autorotation:		false,					// autorotation true or false?
			autorotationTimer:	6,						// duration between autorotation switch in Seconds
			transitionSpeed:	900,					// animation speed
			easing:				'easeInOutQuint',		// easing for transitions
			slides:				'li',					// wich element inside the container should serve as slide
			pluginNameSpace:	'aviapoly',				// define a slider namespace
			transition:			'fx',					// "fade", "move" or "fx" (fx uses multiple blocks)
			forceMobile:		true,					// forces the mobile version to mobile devices: only slide animation and touch gestures
			captionClass:		'slideshow_caption',	//
			try_video_autoplay:	true,					// try to start video autoplay once a user opens a slideshow video for the first time
			globalDelay:		100,					// delay of appearance for multiple slideshows
			
			// variables necessary if transition is set to "fx":
			animation:			false,
			blockHeight:		'full',
			blockWidth:			'full',
			blockFx:			'easeOutQuad',
			transitionFx:		'fade',
			betweenBlockDelay:	100
			
		},
		
		methods = 
		{
			/************************************************************************
			Activates the slideshow and does some required checks
			*************************************************************************/
			activateSlider: function(slider)
			{
				methods.css3_check(slider, 'transition');
				methods.overwrite_options(slider, slider.options);
				methods.append_caption(slider);
				methods.preload(slider);
			},
			
			/*
			 * checks if the browser supports css3 features, eg transitions
			 * uses external utility function for the check
			 */
			css3_check: function(slider, property)
			{
				if(slider.isMobile){ slider.parents(':eq(0)').addClass('slideshow_mobile'); }
			
				if($.avia_utilities.supported[property] === undefined)
				{
					$.avia_utilities.supported[property] = $.avia_utilities.supports(property, ['Khtml', 'Ms', 'Webkit', 'Moz']);
				}

				if($.avia_utilities.supported[property] !== false)
				{
					slider.css_active		= true;
					slider.css_prefix		= $.avia_utilities.supported[property];
				}
			},
			
			/*
			 * overwrites the default options as well as the passed options with data attributes
			 * located in the slideshow <ul> element
			 */
			overwrite_options: function(element, array)
			{
				var htmlData = element.data(),
				i = "";
				
				for (i in htmlData)
				{
					if (htmlData.hasOwnProperty(i)) 
					{
						if(typeof htmlData[i] === "string" || typeof htmlData[i] === "number" || typeof htmlData[i] === "boolean")
						{
							array[i] = htmlData[i];
						}
					}
				}
			},
			
			/*converts data string to html and appends it to the slide*/		
			append_caption: function(slider)
			{				
				slider.slides.each(function()
				{
					var current		= $(this),
						caption		= current.data('caption'),
						container	= "div",
						link		= current.find('a'),
						className	= 'slideshow_caption',
						href		= "",
						current_caption = "";
					
					if(caption)
					{
												
						if(!$(caption).find('a').length && link.length)
						{
							/*
							href = "href='"+link.attr('href')+"'";
														container = "a";
							*/
							
							className += " caption_link";
						}
						
						
						current.addClass('withCaption');
						current_caption = $("<div class='container caption_container'><"+container+" "+href+" class=' "+className+"'><div class='slideshow_inner_caption'><div class='slideshow_align_caption'>"+caption+"</div></div></"+container+"></div>").appendTo(current);
					}
				});
			},
			
			/*
			 * preloads the slideshow images by using a external utility function
			 */
			preload: function(slider)
			{
				$.avia_utilities.preload({container: slider, single_callback:  function(){ methods.init(slider); }});
			},
			
			
			/************************************************************************
			Activation, property check and preloading done, now for the initialization
			*************************************************************************/
			
			init: function(slider)
			{
				
			
				methods.set_slide_proportions(false, false, slider);
				methods.set_video_slides(slider);
				methods.show_first_slide(slider);
				methods.bind_events(slider);
			
				if(slider.count > 0)
				{
					methods.append_controls(slider);
					methods.activate_touch_control(slider);
					methods.start_autorotation(slider);
				}
			},
			
			bind_events: function(slider)
			{
				//handle clicking on slide controls
				slider.bind('switch.'+slider.options.pluginNameSpace , function(e, target){ methods.try_slide_transition(e, target, slider); });
				
				//stop autorotation if link inside the slider is clicked
				slider.on("click", "a", function(){ methods.pause_slider(slider); });
				
				//handle click onto video slides with poster image
				slider.on("click", ".comboslide .slideshow_overlay", function()
				{
					var clicked_item = $(this).parents('.comboslide');
					
					if(clicked_item.find('img:visible').length && !clicked_item.parents('.no_combo').length)
					{	
						methods.showvideo(clicked_item, slider); 
						methods.pause_slider(slider);
						return false; 
					}
					
				});
				
				
				win.bind( 'smartresize.'+slider.options.pluginNameSpace, function()
				{	
					methods.set_slide_proportions('resize', false, slider);
				});
				
				//next button click
				slider.on( 'click','.nextSlide', function()
				{
					slider.parents('.slideshow_container:eq(0)').find('.ctrl_next').trigger('click');
				});
				
				//caption click
				slider.on( 'click','.caption_link', function()
				{
					slider.currentSlide.find('a:first').trigger('click');
				});
				
			},
			
			/************************************************************************
			SECTION: Autorotation
			*************************************************************************/	
							
			start_autorotation: function(slider)
			{
				if(slider.count)
				{
					if(slider.options.autorotation)
					{	
						slider.interval = setInterval(function()
						{
								slider.trigger('switch.'+slider.options.pluginNameSpace, ['next', slider]);
							
						}, 
						slider.options.autorotationTimer * 1000);
					}
				}
			},
			
			toogle_autorotation: function(slider)
			{
				if(slider.options.autorotation)
				{
					methods.pause_slider(slider);
				}
				else
				{
					methods.unpause_slider(slider);
				}
			},

			pause_slider: function(slider)
			{
				if(slider.pauseButton.length) { slider.pauseButton.removeClass('ctrl_active_rotation').text('Play'); }
				slider.options.autorotation = false;
				clearInterval(slider.interval);
			},
			
			unpause_slider: function(slider)
			{
				if(slider.pauseButton.length) { slider.pauseButton.addClass('ctrl_active_rotation').text('Pause'); }
				slider.options.autorotation = true;
				methods.try_slide_transition(false, 'next', slider);
				methods.start_autorotation(slider);
			},
			
			try_slide_transition: function(event, target, slider)
			{
				slider.moveDirection = false;
				target = methods.calculate_target(target, slider);
			
				if(slider.animating) { return false; }
				if(target === slider.currentIndex) { return false; }
				
				slider.nextIndex = target;
				slider.animating = true;
				slider.data('animation_active', true); 
				methods.change_slides(target, slider);
			},
			
			/************************************************************************
			SECTION: Video helper
			*************************************************************************/	
			
			set_video_slides: function(slider)
			{
				var allvideos = slider.slides.find('video, embed, object, iframe, .avia_video').length;
			
				slider.slides.each(function(i)
				{
					var currentslide	= $(this),
					classname			= 'imageslide', imageslide, videoslide, iframe, src;
					
					if(allvideos)
					{
						imageslide			= currentslide.find('img');
						videoslide			= currentslide.find('video, embed, object, iframe, .avia_video').attr('wmode','opaque');
						iframe				= currentslide.find('iframe');
						src					= iframe.attr('src');
						
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
						
						// initialy google chrome youtube fix: youtube videos need to be hidden and then shown before they respond to zIndex properties
						// now used on every video only slide
						if(classname === 'videoslide')
						{
							videoslide.css({display:"none"});
							setTimeout(function()
							{
								videoslide.css({display:"block"});
							},10);
						}
						
						currentslide.addClass(classname).find('.slideshow_media_wrap').append('<span class="slideshow_overlay"></span>');
					}					
					
				});
			},
				
							
			showvideo: function(clicked_item, slider)
			{
				var iframe	= clicked_item.find('iframe'),
					param	= clicked_item.find('param[name=movie]'),
					embed	= clicked_item.find('embed'),
					object	= clicked_item.find('object'),
					src		= "";
					
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
						embed.attr('src',src);
					}
					embed.css('display','block');
				}
				
				
				clicked_item.find('.slideshow_overlay').stop().animate({opacity:0}, function()
				{
					$(this).css({zIndex:0, visibility:'hidden', display:'none'});
				});
				
				if(!clicked_item.is('.small_image'))
				{
					clicked_item.find('.'+slider.options.captionClass).stop().animate({opacity:0}, function()
					{
						$(this).css({zIndex:0, visibility:'hidden', display:'none'});
					});
				}
				
				setTimeout(function(){
				clicked_item.find('img, canvas').stop().animate({opacity:0}, function()
				{
					$(this).css({zIndex:0, visibility:'hidden', display:'none'});
				});
				},200);
			},
				
			/************************************************************************
			SECTION: CHANGE SLIDES
			*************************************************************************/
				
			calculate_target: function(target, slider)
			{
				if(typeof target === 'object') { target = $(target).data('show-slide'); }
				switch(target)
				{
					case 'next': target = slider.currentIndex + 1; slider.moveDirection = 1000; break;
					case 'previous': target = slider.currentIndex - 1; slider.moveDirection = -1000; break;
				}
				
				
				if(slider.currentIndex > target) { slider.moveDirection = -1000; }
				if(target < 0) { target = slider.count - 1; }
				if(target === slider.count){ target = 0; }
				
				return target;
			},
			
			change_slides: function(target, slider)
			{
				slider.trigger('change_slides', [target]);
				
				methods.new_active_control(target, slider);
				slider.nextSlide = slider.slides.filter(':eq('+target+')');				
				
				methods.try_set_slide_proportions(slider);
				methods[slider.options.transition].call(this, slider);
			},
			
			try_set_slide_proportions: function(slider) //checks if the next image is smaller and resizes the container at the start of the transition
			{
				var nextImg = slider.nextSlide.find('img'),
					nextProportions;
					
				if(nextImg)
				{
					nextProportions = nextImg.data('imgw') / nextImg.data('imgh');
					
					if(nextProportions > slider.proportions && !slider.currentSlide.is('.small_image'))
					{
						slider.currentImg = nextImg;
						methods.set_slide_proportions(false, false, slider);
					}
				}
			},
			
			fade: function(slider)
			{
				var options = slider.options;
				
				methods.display_caption(slider.nextSlide);
				
				slider.nextSlide.css({display:'block', zIndex:2, opacity:0}).avia_animate({opacity:1}, options.transitionSpeed/2, 'linear');
				
				slider.currentSlide.avia_animate({opacity:0}, options.transitionSpeed, 'linear', function()
				{
					methods.change_finished(slider);
				});
			},
			
			move: function(slider)
			{
				var sliderWidth	= slider.width(),
					transition	= [],
					transition2	= [],
					modifier	= -1,
					property	= "",
					options		= slider.options;
					
				methods.display_caption(slider.nextSlide);
				
				if(slider.currentIndex > slider.nextIndex) { modifier = 1; }
				if(slider.moveDirection)
				{
					if(slider.moveDirection > 0) { modifier = -1; }
					if(slider.moveDirection < 0) { modifier =  1; }
				}
				
				
				slider.nextSlide.css({display:'block', zIndex:4, opacity:1, left:0, top:0});
				if(slider.css_active)
				{
					property  = slider.css_prefix + 'transform';
					slider.nextSlide.css(property, "translate(" + ( sliderWidth * modifier * -1) + "px,0)");
					transition[property]  = "translate(" + ( sliderWidth * modifier) + "px,0)";
					transition2[property] = "translate(0,0)";
				}
				else
				{
					slider.nextSlide.css({left:sliderWidth * modifier * -1});
					transition.left = sliderWidth * modifier;
					transition2.left = 0;
				}
				
				slider.nextSlide.avia_animate(transition2, options.transitionSpeed, options.easing, function(){methods.change_finished(slider); });
				slider.currentSlide.avia_animate(transition, options.transitionSpeed, options.easing);
			},
			
			change_finished: function(slider)
			{	
				slider.slides.css({display:'none', zIndex:1, position:'absolute', opacity:1});
				
				if(slider.currentSlide.is('.videoslide') || slider.currentSlide.is('.comboslide'))
				{
					var video = slider.currentSlide.find('iframe');
					
					if(video.length && video.css('display') == "block")
					{
						video.attr('src', video.attr('src').replace('autoplay=1','autoplay=0'));
						video.remove().appendTo(slider.currentSlide.find('.slideshow_media_wrap'));
					}
				}
				
				slider.currentSlide	= slider.nextSlide.css({display:'block', zIndex:3, left:0, top:0, position:'relative'});
				slider.currentIndex	= slider.slides.index(slider.currentSlide);
				slider.currentImg	= slider.currentSlide.find('img');
				methods.set_slide_proportions(false, false, slider);
				
				if(slider.options.transition === 'fx')
				{
					methods.clean_up_hook_fx(slider);
				}
				else
				{
					methods.clean_up_hook(slider);
				}
			},
			
			display_caption: function(slide)
			{
				if(!slide.is('.caption_animate')) return false;
				
				var easing	= 'easeOutQuint',
					title 	= slide.find('.slideshow_align_caption>h1'),
					excerpt	= slide.find('.featured_caption'),
					buttons = slide.find('.button_wrap');
					
					title.stop().attr('style',"").css({opacity:0}); 
					excerpt.stop().attr('style',"").css({opacity:0}); 
					buttons.stop().attr('style',"").css({opacity:0}); 
					
					setTimeout(function(){
						
						title.avia_animate({opacity:1, left:0, top:0}, 700, easing); 
						excerpt.avia_animate({opacity:1, left:0, top:0}, 1000, easing); 
						buttons.avia_animate({opacity:1, left:0, top:0}, 1300, easing); 
						
					}, 300);
			},
			
			set_slide_proportions: function(event, callback, slider)
			{
				slider.proportions = 16 / 9; //default width if no image is available
				
				if(slider.currentImg.length) 
				{ 
					slider.proportions = Math.round(slider.currentImg[0].width / slider.currentImg[0].height * 1000) / 1000; 
				}
				else
				{
					var iframe = slider.currentSlide.find('iframe');
					if(iframe.length)
					{
						iframe = iframe[0];
						if(iframe.width && iframe.height)
						{
							slider.proportions = Math.round(iframe.width / iframe.height * 1000) / 1000; 
						}
					}
				}
				
				
				
				var wrap		= slider.currentSlide.find('.slideshow_media_wrap'),
					border		= slider.currentSlide.is('.with_border') ? parseInt(wrap.css('padding-top'),10) + parseInt(wrap.css('padding-bottom'),10) : 0,
					modifier	= slider.currentSlide.is('.small_image') ? 3 : 1,
					properties	= {height: Math.round(((slider.width() / modifier) / slider.proportions) + border) + "px"},
					options		= slider.options;
				
				if(event && event === 'resize') 
				{
					slider.css(properties); 
				}
				else
				{
					slider.animate(properties, options.transitionSpeed, options.easing, callback);
				}
			},
			
			clean_up_hook: function(slider)
			{
				slider.animating = false;
				slider.data('animation_active', false); 
			},
			
			/************************************************************************
			VISUAL MODIFICATIONS
			*************************************************************************/
			/*displays the first element of the slideshow, a global counter is used to make all items appear in order*/
			show_first_slide: function(slider)
			{
				var firstSlide	= slider.slides.slice(0,1).css({visibility:'visible', opacity:0, zIndex:3}),
					options		= slider.options;
				
				setTimeout(function()
				{
					firstSlide.avia_animate({opacity:1}, options.transitionSpeed, options.easing, function()
					{
						methods.display_caption(firstSlide);
						slider.removeClass('preloading');
						
						if(slider.css_prefix === "-webkit-")
						{
							slider.find('img').css({"-webkit-perspective":"1000"});
						}
					}); 
					
				}, options.globalDelay * (slider.slideshowIndex + 1));
			},
			
			append_controls: function(slider)
			{
				if(slider.count > 1 )
				{
					//numeric controls
					var active_class = "class='active_item'", x, extra_class, labels = ['previous', 'pause_play', 'next']; 
					
					slider.controls.numeric = $('<div class="numeric_controls slide_controls"></div>').insertAfter(slider);
										
					slider.slides.each(function(i)
					{
						$('<a '+active_class+' href="#" data-show-slide="'+i+'" >'+(i+1)+'</a>').appendTo(slider.controls.numeric); active_class = "";
					});
					
				
					//arrow controls
					slider.controls.arrow = $('<div class="arrow_controls slide_controls"></div>').insertAfter(slider);
					
					for (x in labels)
					{
						if (labels.hasOwnProperty(x)) 
						{
							extra_class = 'class = "ctrl_'+labels[x]+'"';
							
							if(labels[x] === "pause_play")
							{
								if(slider.options.autorotation === false)
								{
									labels[x] = 'Play';
								}
								else
								{
									extra_class = 'class = "ctrl_active_rotation ctrl_'+labels[x]+'"';
									labels[x] = 'Pause';
								}
							} 
							
							if(typeof labels[x] === 'string')
							{
								$('<a '+extra_class+' href="#" data-show-slide="'+labels[x]+'" >'+labels[x]+'</a>').appendTo(slider.controls.arrow); 
							}
						}
					}
					
					slider.pauseButton = slider.controls.arrow.find('.ctrl_pause_play');
					methods.activate_controls(slider);
				}
			},
			
			
			new_active_control: function(target, slider)
			{
				var controls = slider.controls.numeric.find('a').removeClass('active_item');
				controls.filter(':eq('+target+')').addClass('active_item');
			},
			
			activate_controls: function(slider)
			{
				slider.pauseButton.bind('click', function(){ methods.toogle_autorotation(slider); return false;});
			
				slider.controls.numeric.find('a').bind('click', function()
				{ 
					methods.pause_slider(slider); slider.trigger('switch.'+slider.options.pluginNameSpace, this); return false;
				});
						
				slider.controls.arrow.find('a').not('.ctrl_pause_play').bind('click',function()
				{ 
					methods.pause_slider(slider); slider.trigger('switch.'+slider.options.pluginNameSpace, this); return false;
				});
				
				slider.controls.arrow.find('a').avia_fancy_buttons();
				
			},
			
			activate_touch_control:function(slider)
			{
				if(slider.css_active && slider.isMobile)
				{
					slider.touchPos = {};
					slider.hasMoved = false;
					
					if(slider.options.forceMobile) { slider.options.transition = 'move'; }
					
					slider.bind('touchstart', function(event)
					{
						slider.touchPos.X = event.originalEvent.touches[0].clientX;
						slider.touchPos.Y = event.originalEvent.touches[0].clientY;
					});
					
					slider.bind('touchend', function(event)
					{
						slider.touchPos = {};
		                if(slider.hasMoved) { event.preventDefault(); }
		                slider.hasMoved = false;
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
							var differenceX = event.originalEvent.touches[0].clientX - slider.touchPos.X, 
								differenceY = event.originalEvent.touches[0].clientY - slider.touchPos.Y,
								move		= false;
							
							//check if user is scrolling the window or moving the slider
							if(Math.abs(differenceX) > Math.abs(differenceY)) 
							{
								event.preventDefault();
								
								if(!slider.animating)
								{	
									if(slider.touchPos !== event.originalEvent.touches[0].clientX)
									{
										if(Math.abs(differenceX) > 50)
										{
											move = differenceX > 0 ? 'previous' : 'next';
											
											methods.pause_slider(slider);
											methods.try_slide_transition(false, move, slider);
											slider.touchPos = {};
											slider.hasMoved = true;
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
			AVIAPOLY FX FUNCTIONS
			*************************************************************************/
			
			fx: function(slider)
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
				cur_height  = slider.options.blockHeight === 'full'? slideHeight: slider.options.blockHeight;
				cur_width   = slider.options.blockWidth === 'full' ? slideWidth : slider.options.blockWidth;
			
				slider.currentOptions = 
				{
					blockHeight:	cur_height,
					blockWidth:		cur_width,
					slideHeight:	slideHeight,
					slideWidth:		slideWidth
				};
				
				slider.currentOptions = $.extend({}, slider.options, slider.currentOptions);
				methods.overwrite_options(slider.currentSlide, slider.currentOptions);
				
				
				if(slider.currentOptions.animation)
				{
					methods.use_preset_animation(slider, slider.currentOptions.animation);
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
					case 'diagonal': slider.blocks = methods.diagonal(slider.blocks, slider);  break;
					case 'random'  : slider.blocks = methods.fyrandomize(slider.blocks, slider);  break;
				}
			},
			
			generate_blocks: function(slider)
			{
				slider.blockNumber	= 0;
				var	posX			= 0,
					posY			= 0,
					generateBlocks	= true,
					nextImage		= slider.nextSlide.find('img:eq(0)').attr('src'), 
					imagestring, block, innerBlock;
				

				// start generating the blocks and add them until the whole image area
				// is filled. Depending on the options that can be only one div or quite many ;)
				while(generateBlocks)
				{					
					slider.blockNumber += 1;
					
					imagestring = '';
					block = $('<div class="avBlock avBlock'+slider.blockNumber+'"></div>').appendTo(slider).css({	
						zIndex:20, 
						position:'absolute',
						overflow:'hidden',
						display:'none',
						left:posX,
						top:posY,
						height:slider.currentOptions.blockHeight,
						width:slider.currentOptions.blockWidth
					});
					
					if(nextImage) { imagestring = '<img src="'+ nextImage +'" title="" alt="" />'; }
					
					innerBlock = $('<div class="av_innerBlock">'+imagestring+'</div>').appendTo(block).css({	
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
				var options				= {},
					animationOptions	= ["fade", "slide", "square", "square-fade", "square-random", "square-random-fade", "bar-vertical-top", "bar-vertical-side", "bar-vertical-mesh", "bar-vertical-random", "bar-horizontal-top", "bar-horizontal-side", "bar-horizontal-mesh", "bar-horizontal-random", "square-zoom", "bar-vertical-zoom", "bar-horizontal-zoom"],
					x					= slider.currentOptions.slideWidth,
					y					= slider.currentOptions.slideHeight,
					randomCount			= animationOptions.length,
					squares				= 10,
					bars_v				= 12,
					bar_h				= 6;
					
				if(x < 430)					{ squares = squares/2; bars_v = bars_v/2; bar_h = bar_h/(3/2); }
				if(!slider.css_active)		{ randomCount -= 3; } //subtract the css3 transitions 
				if(animation === 'random')	{ animation = animationOptions[Math.floor(Math.random() * randomCount)]; }
				 
				
				switch(animation)
				{
					case "fade": options = { blockHeight: y, blockWidth: x, transitionFx: 'fade', betweenBlockDelay: 50, transitionSpeed:600, order:'' }; break;
					case "slide": options = { blockHeight: y, blockWidth: x, transitionFx: 'side', betweenBlockDelay: 50, transitionSpeed:600, order:'' }; break;
				
					case "square": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'slide', betweenBlockDelay: 50, transitionSpeed:600, order:'diagonal' }; break;
					case "square-fade": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'fade', betweenBlockDelay: 50, transitionSpeed:600, order:'diagonal' }; break;
					case "square-random": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'slide', betweenBlockDelay: 50, transitionSpeed:600, order:'random' }; break;
					case "square-random-fade": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'fade', betweenBlockDelay: 50, transitionSpeed:600, order:'random' }; break;
					case "square-zoom": options = { blockHeight: Math.ceil(x/squares), blockWidth: Math.ceil(x/squares), transitionFx: 'zoom', betweenBlockDelay: 50, transitionSpeed:600, order:'diagonal' }; break;

					case "bar-vertical-top": options  = { blockHeight: y, blockWidth: Math.ceil(x/bars_v), transitionFx: 'drop', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
					case "bar-vertical-side": options  = { blockHeight: y, blockWidth: Math.ceil(x/bars_v), transitionFx: 'side-stay', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
					case "bar-vertical-mesh": options  = { blockHeight: y, blockWidth: Math.ceil(x/bars_v), transitionFx: 'mesh-vert', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
					case "bar-vertical-random": options  = { blockHeight: y, blockWidth: Math.ceil(x/bars_v), transitionFx: 'fade', betweenBlockDelay: 100, transitionSpeed:600, order:'random' }; break;
					case "bar-vertical-zoom": options  = { blockHeight: y, blockWidth: Math.ceil(x/bars_v), transitionFx: 'zoom', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;

					case "bar-horizontal-top": options  = { blockHeight: Math.ceil(y/bar_h), blockWidth: x, transitionFx: 'drop', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
					case "bar-horizontal-side": options  = { blockHeight: Math.ceil(y/bar_h), blockWidth: x, transitionFx: 'side', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
					case "bar-horizontal-mesh": options  = { blockHeight: Math.ceil(y/bar_h), blockWidth: x, transitionFx: 'mesh-hor', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
					case "bar-horizontal-random": options  = { blockHeight: Math.ceil(y/bar_h), blockWidth: x, transitionFx: 'fade', betweenBlockDelay: 100, transitionSpeed:600, order:'random' }; break;
					case "bar-horizontal-zoom": options  = { blockHeight: Math.ceil(y/bar_h), blockWidth: x, transitionFx: 'zoom', betweenBlockDelay: 100, transitionSpeed:600, order:'' }; break;
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
						var transitionObject		= [], modifier;
						transitionObject.css		= {display:'block',opacity:0};
						transitionObject.anim		= {opacity:1};
						

						switch(slider.currentOptions.transitionFx)
						{
							case 'fade':
								//default opacity fade defined above
							break;
						
							case 'drop':
								if(slider.isMobile) 
								{
									modifier = 1;
									if(slider.moveDirection < 0) { modifier = modifier * -1; }
									
									transitionObject.css[slider.css_prefix+'transform-origin'] = '0 0';
									transitionObject.css[slider.css_prefix+'transform'] = 'rotate(0deg) scale(1, 0.1) skew(0deg, 0deg)';
									transitionObject.anim[slider.css_prefix+'transform'] ='rotate(0deg) scale(1,1) skew(0deg, 0deg)';
								}
								else
								{
									transitionObject.css.height		= 1;
									transitionObject.css.width		= slider.currentOptions.blockWidth;
									
									transitionObject.anim.height	= slider.currentOptions.blockHeight;
									transitionObject.anim.width		= slider.currentOptions.blockWidth;
								}
							break;
							
							case 'side':
							
								modifier = -1;
								if(slider.moveDirection < 0) { modifier = 1; }
								if(slider.isMobile) 
								{
									modifier = modifier * -1;
									transitionObject.css[slider.css_prefix+'transform']		= 'translateX('+( slider.currentOptions.slideWidth * modifier) +'px)';
									transitionObject.anim[slider.css_prefix+'transform']	='translateX(0px)';
								
								}
								else
								{
									transitionObject.css.left= slider.currentOptions.slideWidth * modifier;
									transitionObject.anim.left	= parseInt(currentBlock.css('left'),10);
								}
							break;
							
							
							case 'side-stay':
								if(slider.isMobile) 
								{
									transitionObject.css[slider.css_prefix+'transform'] = 'rotate(0deg) scale(0.1,1) skew(0deg, 0deg)';
									transitionObject.anim[slider.css_prefix+'transform'] ='rotate(0deg) scale(1,1) skew(0deg, 0deg)';
								}
								else
								{
									transitionObject.css.width	= 1;
									transitionObject.anim.width	= slider.currentOptions.blockWidth;
								}
							break;
							
							
							case 'zoom': 
								transitionObject.css[slider.css_prefix+'transform'] = 'rotate(0deg) scale(2) skew(0deg, 0deg)';
								transitionObject.anim[slider.css_prefix+'transform'] ='rotate(0deg) scale(1) skew(0deg, 0deg)';
							break;

							
							case 'mesh-vert':
							
								modifier = -1;
								if(i % 2) { modifier = 1; }
								
								if(slider.isMobile)
								{
									transitionObject.css[slider.css_prefix+'transform'] = 'translateY('+( slider.currentOptions.slideWidth * modifier) +'px)';
									transitionObject.anim[slider.css_prefix+'transform'] ='translateY(0px)';
								}
								else
								{
									transitionObject.css.top	= slider.currentOptions.slideHeight * modifier;
									transitionObject.anim.top	= parseInt(currentBlock.css('top'),10);
								}
							break;
							
							case 'mesh-hor':
								modifier = -1;
								if(i % 2) { modifier = 1; }
								
								if(slider.isMobile)
								{
									transitionObject.css[slider.css_prefix+'transform'] = 'translateX('+( slider.currentOptions.slideWidth * modifier) +'px)';
									transitionObject.anim[slider.css_prefix+'transform'] ='translateX(0px)';
								}
								else
								{
									transitionObject.css.left  = slider.currentOptions.slideWidth * modifier;
									transitionObject.anim.left = parseInt(currentBlock.css('left'),10);
								}
								
							break;
							
							case 'slide':
								if(slider.isMobile)
								{
									transitionObject.css[slider.css_prefix+'transform'] = 'rotate(0deg) scale(0.1) skew(0deg, 0deg)';
									transitionObject.anim[slider.css_prefix+'transform'] ='rotate(0deg) scale(1) skew(0deg, 0deg)';
								}
								else
								{
									transitionObject.css.height	= 1;
									transitionObject.css.width	= 1;
									
									transitionObject.anim.height	= slider.currentOptions.blockHeight;
									transitionObject.anim.width		= slider.currentOptions.blockWidth;
								}
							break;
						
						
						}
			
					
						currentBlock.css(transitionObject.css);
						
						currentBlock.avia_animate(transitionObject.anim, slider.currentOptions.transitionSpeed, slider.currentOptions.blockFx, function()
						{ 
							if(i+1 === slider.blockNumber)
							{	
								slider.currentSlide.avia_animate({opacity:0}, 200, 'linear', function()
								{
									methods.change_finished(slider);
								});
							}
						});
						
						
					}, i*slider.currentOptions.betweenBlockDelay);
				});
			},
			
			clean_up_hook_fx: function(slider)
			{
				if(!slider.blocks || !slider.blocks.length) { return; }
				
				var fadeOut = 500;
				//if(slider.currentSlide.is('.withCaption')) { fadeOut = 500; } else { fadeOut = 10; }
				
				methods.display_caption(slider.currentSlide);
				
				slider.blocks.avia_animate({opacity:0}, fadeOut, function()
				{
					slider.blocks.remove();
					slider.animating = false;
					slider.data('animation_active', false); 
				});
			},
			
			// array sorting
			fyrandomize: function(object) 
			{	
				var length = object.length,
					objectSorted = $(object),
					newObject, temp1, temp2;
					
				if ( length === 0 ) { return false; }
				
				while ( --length ) 
				{
					newObject = Math.floor( Math.random() * ( length + 1 ) );
					temp1 = objectSorted[length];
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
				
				if ( length === 0 ) { return false; }
				for (i = 0; i<length; i += 1 ) 
				{
					objectSorted[i] = object[currentIndex];
					
					if((currentIndex % oneRow === 0 && slider.blockNumber - i > oneRow)|| (modY + 1) % oneColumn === 0)
					{						
						currentIndex -= (((oneRow - 1) * modY) - 1); modY = 0; modX += 1; onlyOne = false;
						
						if (rowend > 0)
						{
							modY = rowend; currentIndex += (oneRow -1) * modY;
						}
					}
					else
					{
						currentIndex += oneRow -1; modY += 1;
					}
					
					if((modX % (oneRow-1) === 0 && modX !== 0 && rowend === 0) || (endreached === true && onlyOne === false) )
					{	
						modX = 0.1; rowend += 1; endreached = true; onlyOne = true;
					}	
				}
				
			return objectSorted;						
			}
		};
		
		
		return this.each(function()
		{
			
			var slider	= $(this);
			
			slider.options			= $.extend({}, defaults, passed_options);
			slider.slideshowIndex	= slideshows.index(this);
			slider.slides			= slider.find(slider.options.slides);
			slider.count			= slider.slides.length;
			slider.currentIndex		= 0;
			slider.nextIndex		= 0;
			slider.currentSlide		= slider.slides.filter(':eq('+slider.currentIndex+')');
			slider.nextSlide		= slider.currentSlide;
			slider.moveDirection	= false;
			slider.currentImg		= slider.currentSlide.find('img');
			slider.isMobile			= document.documentElement.ontouchstart !== undefined ? true : false;
			slider.proportions		= 16 / 9; //default value if we got a pure video slideshow
			slider.controls			= {};
			slider.pauseButton		= {};
			slider.interval			= false;
			slider.css_active		= false;
			slider.css_prefix		= false;
			slider.animating		= false;
			slider.data('animation_active', false); 
			
			methods.activateSlider(slider);
		});
	};
}(jQuery));




/*utility functions*/


(function($)
{
	"use strict";
	
	$.avia_utilities = $.avia_utilities || {};
	
	
	
	
	/************************************************************************
	animation function
	*************************************************************************/
	$.fn.avia_animate = function(prop, speed, easing, callback)
	{
		if(typeof speed === 'function') {callback = speed; speed = false; }
		if(typeof easing === 'function'){callback = easing; easing = false;}
		if(typeof speed === 'string'){easing = speed; speed = false;}

		if(callback === undefined || callback === false){ callback = function(){}; }
		if(easing === undefined || easing === false)	{ easing = 'easeInQuad'; }
		if(speed === undefined || speed === false)		{ speed = 400; }

		if($.avia_utilities.supported.transition === undefined)
		{
			$.avia_utilities.supported.transition = $.avia_utilities.supports('transition');
		}


		if($.avia_utilities.supported.transition !== false)
		{
			var prefix		= $.avia_utilities.supported.transition + 'transition',
				cssRule		= {},
				cssProp		= {},
				thisStyle	= document.body.style,
				end			= (thisStyle.WebkitTransition !== undefined) ? 'webkitTransitionEnd' : (thisStyle.OTransition !== undefined) ? 'oTransitionEnd' : 'transitionend';

			//translate easing into css easing
			easing = $.avia_utilities.css_easings[easing];

			//create css transformation rule
			cssRule[prefix]	=  'all '+(speed/1000)+'s '+easing;
			//add namespace to the transition end trigger
			end = end + ".avia_animate";
			
			//since jquery 1.10 the items passed need to be {} and not [] so make sure they are converted properly
			for (var rule in prop)
			{
				if (prop.hasOwnProperty(rule)) { cssProp[rule] = prop[rule]; }
			}
			prop = cssProp;
			
			
			
			this.each(function()
			{
				var element	= $(this), css_difference = false, rule, current_css;

				for (rule in prop)
				{
					if (prop.hasOwnProperty(rule))
					{
						current_css = element.css(rule);

						if(prop[rule] != current_css && prop[rule] != current_css.replace(/px|%/g,""))
						{
							css_difference = true;
							break;
						}
					}
				}

				if(css_difference)
				{
					//if no transform property is set set a 3d translate to enable hardware acceleration
					if(!($.avia_utilities.supported.transition+"transform" in prop))
					{
						prop[$.avia_utilities.supported.transition+"transform"] = "translateZ(0)";
					}
					
					element.on(end,  function(event)
					{
						if(event.target != event.currentTarget) return false;

						cssRule[prefix] = "none";

						element.off(end);
						element.css(cssRule);
						setTimeout(function(){ callback.call(element); });
					});
					
					setTimeout(function(){ element.css(cssRule);},10);
					setTimeout(function(){ element.css(prop);	},20);
				}
				else
				{
					setTimeout(function(){ callback.call(element); });
				}

			});
		}
		else // if css animation is not available use default JS animation
		{
			this.animate(prop, speed, easing, callback);
		}

		return this;
	};	
	

	/************************************************************************
	swipe function
	*************************************************************************/
	$.fn.avia_swipe_trigger = function(passed_options) 
	{
		var win		= $(window),
		isMobile	= document.documentElement.ontouchstart !== undefined ? true : false,
		defaults	= 
		{
			prev: {},
			next: {}
		},
		
		methods = {
		
			activate_touch_control: function(slider)
			{
				var i, differenceX, differenceY;
				
				slider.touchPos = {};
				slider.hasMoved = false;
				
				slider.bind('touchstart', function(event)
				{
					slider.touchPos.X = event.originalEvent.touches[0].clientX;
					slider.touchPos.Y = event.originalEvent.touches[0].clientY;
				});
				
				slider.bind('touchend', function(event)
				{
					slider.touchPos = {};
	                if(slider.hasMoved) { event.preventDefault(); }
	                slider.hasMoved = false;
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
						differenceX = event.originalEvent.touches[0].clientX - slider.touchPos.X; 
						differenceY = event.originalEvent.touches[0].clientY - slider.touchPos.Y; 
						
						//check if user is scrolling the window or moving the slider
						if(Math.abs(differenceX) > Math.abs(differenceY)) 
						{
							event.preventDefault();
								
							if(slider.touchPos !== event.originalEvent.touches[0].clientX)
							{
								if(Math.abs(differenceX) > 50)
								{
								
								  //i = differenceX > 0 ? i - 1 : i + 1;
									i = differenceX > 0 ? 'prev' : 'next';
									
									if(typeof slider.options[i] === 'string')
									{
										slider.find(slider.options[i]).trigger('click', ['swipe']);
									}
									else
									{
										slider.options[i].trigger('click', ['swipe']);
									}
									
									slider.hasMoved = true;
									slider.touchPos = {};
									return false;
								}
							}
						}
	                }
				});
			}
		};
	
		return this.each(function()
		{
			if(isMobile) 
			{
				var slider	= $(this);
				
				slider.options	= $.extend({}, defaults, passed_options);
				
				methods.activate_touch_control(slider);
			}
		});
	};
	
	
	
	
	/************************************************************************
	gloabl loading function
	*************************************************************************/
	$.avia_utilities.loading = function(attach_to, delay){
		
		var loader = {
			
			active: false,
			
			show: function()
			{
				if(loader.active === false)
				{
					loader.active = true;
					loader.loading_item.css({display:'block', opacity:0});
				}
				
				loader.loading_item.stop().animate({opacity:0.7});
			},
			
			hide: function()
			{
				if(typeof delay === 'undefined'){ delay = 300; }
			
				loader.loading_item.stop().delay( delay ).animate({opacity:0}, function()
				{
					loader.loading_item.css({display:'none'});
					loader.active = false;
				});
			},
			
			attach: function()
			{
				if(typeof attach_to === 'undefined'){ attach_to = 'body';}
				
				loader.loading_item = $('<div class="avia_loading_icon"></div>').css({display:"none"}).appendTo(attach_to);
			}
		}
		
		loader.attach();
		return loader;
	};
	
	/************************************************************************
	preload images, as soon as all are loaded trigger a special load ready event
	*************************************************************************/
	$.avia_utilities.preload_images = 0;
	$.avia_utilities.preload = function(options_passed) 
	{
		var win		= $(window), 
		defaults	= 
		{
			container:			'body',
			maxLoops:			10,
			trigger_single:		true,
			single_callback:	function(){},
			global_callback:	function(){}
			
		},
		
		options		= $.extend({}, defaults, options_passed),
		
		methods		= {
		
			checkImage: function(container)
			{
				container.images.each(function()
				{
					if(this.complete === true) 
					{ 
						container.images = container.images.not(this); 
						$.avia_utilities.preload_images -= 1;
					}
				});
				
				if(container.images.length && options.maxLoops >= 0)
				{
					options.maxLoops-=1;
					setTimeout(function(){ methods.checkImage(container); }, 500);
				}
				else
				{
					$.avia_utilities.preload_images = $.avia_utilities.preload_images - container.images.length;
					methods.trigger_loaded(container);
				}
			},
			
			trigger_loaded: function(container)
			{			
				if(options.trigger_single !== false)
				{
					win.trigger('avia_images_loaded_single', [container]);
					options.single_callback.call(container);
				}
											
				if($.avia_utilities.preload_images === 0)
				{
					win.trigger('avia_images_loaded');
					options.global_callback.call();
				}
				
			}
		};
		
		if(typeof options.container === 'string'){options.container = $(options.container); }
		
		options.container.each(function()
		{
			var container		= $(this);
			
			container.images	= container.find('img');
			container.allImages	= container.images;
			
			$.avia_utilities.preload_images += container.images.length;
			setTimeout(function(){ methods.checkImage(container); }, 10);
		});
	};
	
	
	
	/************************************************************************
	CSS Easing transformation table
	*************************************************************************/
	/*
	Easing transform table from jquery.animate-enhanced plugin
	http://github.com/benbarnett/jQuery-Animate-Enhanced
	*/
	$.avia_utilities.css_easings = {
			linear:			'linear',
			swing:			'ease-in-out',
			bounce:			'cubic-bezier(0.0, 0.35, .5, 1.3)',
			easeInQuad:     'cubic-bezier(0.550, 0.085, 0.680, 0.530)' ,
			easeInCubic:    'cubic-bezier(0.550, 0.055, 0.675, 0.190)' ,
			easeInQuart:    'cubic-bezier(0.895, 0.030, 0.685, 0.220)' ,
			easeInQuint:    'cubic-bezier(0.755, 0.050, 0.855, 0.060)' ,
			easeInSine:     'cubic-bezier(0.470, 0.000, 0.745, 0.715)' ,
			easeInExpo:     'cubic-bezier(0.950, 0.050, 0.795, 0.035)' ,
			easeInCirc:     'cubic-bezier(0.600, 0.040, 0.980, 0.335)' ,
			easeInBack:     'cubic-bezier(0.600, -0.280, 0.735, 0.04)' ,
			easeOutQuad:    'cubic-bezier(0.250, 0.460, 0.450, 0.940)' ,
			easeOutCubic:   'cubic-bezier(0.215, 0.610, 0.355, 1.000)' ,
			easeOutQuart:   'cubic-bezier(0.165, 0.840, 0.440, 1.000)' ,
			easeOutQuint:   'cubic-bezier(0.230, 1.000, 0.320, 1.000)' ,
			easeOutSine:    'cubic-bezier(0.390, 0.575, 0.565, 1.000)' ,
			easeOutExpo:    'cubic-bezier(0.190, 1.000, 0.220, 1.000)' ,
			easeOutCirc:    'cubic-bezier(0.075, 0.820, 0.165, 1.000)' ,
			easeOutBack:    'cubic-bezier(0.175, 0.885, 0.320, 1.275)' ,
			easeInOutQuad:  'cubic-bezier(0.455, 0.030, 0.515, 0.955)' ,
			easeInOutCubic: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)' ,
			easeInOutQuart: 'cubic-bezier(0.770, 0.000, 0.175, 1.000)' ,
			easeInOutQuint: 'cubic-bezier(0.860, 0.000, 0.070, 1.000)' ,
			easeInOutSine:  'cubic-bezier(0.445, 0.050, 0.550, 0.950)' ,
			easeInOutExpo:  'cubic-bezier(1.000, 0.000, 0.000, 1.000)' ,
			easeInOutCirc:  'cubic-bezier(0.785, 0.135, 0.150, 0.860)' ,
			easeInOutBack:  'cubic-bezier(0.680, -0.550, 0.265, 1.55)'
		};
		
		
		
		
		
	  // ========================= smartresize ===============================

	  /*
	   * smartresize: debounced resize event for jQuery
	   *
	   * latest version and complete README available on Github:
	   * https://github.com/louisremi/jquery-smartresize
	   *
	   * Copyright 2011 @louis_remi
	   * Licensed under the MIT license.
	   */
	
	  if(!jQuery.fn.smartresize)
	  {
		  var $event = $.event,
		      resizeTimeout;
		
		  $event.special.smartresize = {
		    setup: function() {
		      $(this).bind( "resize", $event.special.smartresize.handler );
		    },
		    teardown: function() {
		      $(this).unbind( "resize", $event.special.smartresize.handler );
		    },
		    handler: function( event, execAsap ) {
		      // Save the context
		      var context = this,
		          args = arguments;
		
		      // set correct event type
		      event.type = "smartresize";
		
		      if ( resizeTimeout ) { clearTimeout( resizeTimeout ); }
		      resizeTimeout = setTimeout(function() {
		        jQuery.event.handle.apply( context, args );
		      }, execAsap === "execAsap"? 0 : 100 );
		    }
		  };
		
		  $.fn.smartresize = function( fn ) {
		    return fn ? this.bind( "smartresize", fn ) : this.trigger( "smartresize", ["execAsap"] );
		  };
	  }

}(jQuery));




// -------------------------------------------------------------------------------------------
// external controls
// -------------------------------------------------------------------------------------------

(function($)
{
	"use strict";

	$.fn.avia_external_controls = function() 
	{
		return this.each(function()
		{
			var container	= $(this),
				slider		= container.find('.slideshow'),
				controls	= container.parents('#slideshow_big').next('.thumbnails_container_wrap').find('.thumbnails_container'),
				thumbs		= "",
				index, animating, current;
				
			if(!controls.length) 
			{
				controls	= container.parents().next('.thumbnails_container_wrap').find('.thumbnails_container');
			}
			
			if(!controls.length) { return; }
			
			thumbs = controls.find('.slideThumb');
			controls.avia_content_slider();
			
			
			//next button click
			controls.delegate('.slideThumb', 'click', function(event)
			{
				animating = slider.data('animation_active'); 
				if(!animating)
				{
					index = thumbs.index(this);
					container.find('.numeric_controls a:eq('+index+')').trigger('click');
				}
			});
			
			
			
			slider.on('change_slides', function(e, target)
			{
				thumbs.removeClass('activeslideThumb');
				current = thumbs.filter(':eq('+target+')').addClass('activeslideThumb');
				controls.trigger('moveTo', [current, target]);
			});

		});
	};
}(jQuery));





// -------------------------------------------------------------------------------------------
// keyboard controls
// -------------------------------------------------------------------------------------------

(function($)
{
	"use strict";

	$.fn.avia_keyboard_controls = function(options_passed) 
	{
		var defaults	= 
		{
			37:		'.ctrl_previous',	// prev
			39:		'.ctrl_next'		// next
		},
				
		methods		= {
		
			mousebind: function(slider)
			{
				slider.hover(
					function(){  slider.mouseover	= true;  },
					function(){  slider.mouseover	= false; }
				);
			},
		
			keybind: function(slider)
			{
				$(document).keydown(function(e)
				{
				
					if(slider.mouseover && typeof slider.options[e.keyCode] !== 'undefined')
					{
						var item;
						
						if(typeof slider.options[e.keyCode] === 'string')
						{
							item = slider.find(slider.options[e.keyCode]);
						}
						else
						{
							item = slider.options[e.keyCode];
						}
						
						if(item.length)
						{
							item.trigger('click', ['keypress']);
							return false;
						}
					}
				});
			}
		};
		
	
		return this.each(function()
		{
			var slider			= $(this);
			slider.options		= $.extend({}, defaults, options_passed);
			slider.mouseover	= false;
			
			methods.mousebind(slider);
			methods.keybind(slider);

		});
	};
}(jQuery));



// -------------------------------------------------------------------------------------------
// show/hide controls
// -------------------------------------------------------------------------------------------

(function($)
{
	"use strict";
	
	$.fn.avia_base_control_hide = function() 
	{
		return this.each(function()
		{
			function show_it()
			{
				controls['prev'] = container.find('.slide_controls a.ctrl_previous');
				
				if(controls['prev'].length)
				{
				first_move = true;
			
				//if($(event.target).is('.slideshow_caption, .slideshow_inner_caption')) return;
				controls['prev'].stop().css({display:'block', opacity:0}).animate({opacity:0.8, left:'0px'}, duration, easing);
				controls['next'] = container.find('.slide_controls a.ctrl_next').stop().css({display:'block', opacity:0}).animate({opacity:0.8, right:'0px'}, duration, easing);
				}
			}
			
			function hide_it()
			{
				if(!controls['prev'].length) return;
			
				controls['prev'].stop().animate({opacity:0, left:-110}, duration, easing);
				controls['next'].stop().animate({opacity:0, right:-110 }, duration , easing , function()
				{
					controls['prev'].css({opacity:0});
					controls['next'].css({opacity:0});
				});
			}
		
		
			var container 	= $(this).parent(),
			controls 		= [],
			isMobile    	= 'ontouchstart' in document.documentElement,
			duration		= 200,
			easing			= 'easeOutQuint',
			big_wrap		= container.parents('#slideshow_big:eq(0)'),
			first_move		= false;
			
			if(big_wrap.length) container = big_wrap;
			
			if(!isMobile)
			{
				container.bind('mousemove', function()
				{ 
					if(!first_move) show_it();
				});
			
				//hover event
				container.hover( show_it, hide_it);

			}

		});
	};
})(jQuery);



// -------------------------------------------------------------------------------------------
// thumbnail slider
// -------------------------------------------------------------------------------------------

(function($)
{
	"use strict";

	$.fn.avia_content_slider = function(options_passed) 
	{
		var win		= $(window), 
		defaults	= 
		{
			pluginNameSpace:	"avia_content_slider",
			elements:			">div",
			animation_speed:	800,
			easing:				'easeInOutQuint',
			animation_property:	'margin-left',
			pos:				0,
			center:				true,
			addStructure:		true,
			endless:			true
			
		},
				
		methods		= {
		
			init: function(slider)
			{
				var namespace = slider.options.pluginNameSpace;
							
				slider.addClass('hide_controls');
				if(slider.options.addStructure) 
				{
					slider.elements.wrapAll('<div class="avc_inner_slide_wrap"></div>').wrapAll('<div class="avc_inner_slide"></div>');
				}
				slider.slidewrap	= slider.find('.avc_inner_slide_wrap');
				slider.slide		= slider.find('.avc_inner_slide');
				
				
				methods.transition_method(slider);
				methods.create_controls(slider);
				methods.set_properties(slider);
				
				//bind events
				
				win.bind( 'smartresize.'+namespace, function()
				{	
					methods.set_properties(slider);
				});
				
				slider.bind('moveTo', function(e, target, index){ methods.moveTo(slider, target, index);  });
				
				slider.control.next.on('click.'+namespace, function(e, trigger){ methods.transition(slider,  1); methods.setMoveTo(slider, e, trigger); return false;});
				slider.control.prev.on('click.'+namespace, function(e, trigger){ methods.transition(slider, -1); methods.setMoveTo(slider, e, trigger); return false;});
				
				slider.avia_swipe_trigger({next: slider.control.next, prev: slider.control.prev});
				
				if(slider.isMobile) { slider.options.endless = false; }
			},
			
			setMoveTo: function(slider, e, trigger)
			{
				if(typeof e.isTrigger === 'undefined' || typeof trigger !== 'undefined')
				{
					slider.allow_moveTo = false;
				}
			},
			
			moveTo: function(slider, target, index)
			{
				if(slider.allow_moveTo === true)
				{
					var pos = slider.positions[index] + slider.options.pos;
					
					if(pos > slider.container_width || pos < 0)
					{
						slider.control.next.trigger('click.'+slider.options.pluginNameSpace);
					}
				}
			},
			
			transition_method: function(slider)
			{
				if(slider.isMobile)
				{
					if($.avia_utilities.supported.transition === undefined)
					{
						$.avia_utilities.supported.transition = $.avia_utilities.supports('transition');
					}
					
					if($.avia_utilities.supported.transition !== false)
					{
						slider.options.animation_property = $.avia_utilities.supported.transition+'transform';
					}
				}
			},
			
			create_controls: function(slider)
			{
				var i, buttons = ['prev','next'], length = buttons.length, key;
				
					slider.control = {};
					
				for (i = 0; i < length; i += 1 )
				{
					key = buttons[i];
					slider.control[key] = $('<a class="avc_controls avc_controls_'+key+' " href="#'+key+'">'+key+'</a>').appendTo(slider);
				}
			},
			
			transition: function(slider, direction)
			{
				if(slider.animating && !slider.isMobile){ return false;}
				
				slider.animating = true;
			
				var options		= slider.options, 
					pos			= slider.options.pos,
					anim_pos	= 0, 
					property	= {},
					speed		= options.animation_speed,
					easing		= options.easing,
					skip		= false;
				
				if(typeof direction === 'number')
				{
					pos = pos - (slider.container_width * direction);
					
					//next
					if((pos * -1) === slider.slide_width)
					{ 
						if(options.endless)
						{
							pos = 0;  
						}
						else
						{
							skip = true;
						}
					}
					
					if((pos * -1) + slider.container_width > slider.slide_width)
					{
						pos = (slider.slide_width - slider.container_width) * -1; 
					}
					
					//prev
					if(pos >= slider.container_width)
					{ 
						if(options.endless)
						{
							pos = (slider.slide_width - slider.container_width) * -1; 
						}
						else
						{
							skip = true;
						}
					}
					
					if(pos > 0 && pos <= slider.container_width)
					{ 
						pos = 0; 
					}
				}
				else
				{
					speed = 200;
					easing = 'linear';
				}
				
				
				if(skip)
				{
					slider.animating = false;
				}
				else
				{
					if(slider.noscroll === true && options.center === true)
					{
						property = methods.build_property( (slider.container_width - slider.slide_width) / 2 , options.animation_property);
						slider.slide.css(property);
						slider.animating = false;
					}
					else
					{
						anim_pos = methods.scroll_to_number(pos, slider.positions);
						property = methods.build_property(anim_pos, options.animation_property);
						
						slider.options.pos = pos;
						slider.slide.avia_animate(property, speed, easing, function(){ slider.animating = false; });
					}
				}
			},
			
			build_property: function(new_pos, key)
			{
				var property = {};
				
				//build property object
				if(key === 'margin-left')
				{
					property[key] = new_pos + 'px';
				}
				else
				{
					property[key] = 'translateX('+(new_pos) +'px)';
				}
				
				return property;
			},
			
			scroll_to_number: function(pos, positions)
			{
				var i, length = positions.length, low = 0, high = 0, multiplier = 1;
				
				for (i = 0; i < length; i += 1)
				{
					if(Math.abs(pos) > positions[i])
					{
						low = positions[i];
						high = positions[i + 1];
					}
				}
				
				if(pos !== Math.abs(pos))
				{
					multiplier = multiplier * -1;
					pos = Math.abs(pos);
				}
				
				if(low - pos > high - pos)
				{
					pos = low;
				}
				pos = high;
				
				return pos * multiplier;
			},
			
			set_inner_slide_width: function(slider)
			{
				var slide_width		= 0;
				slider.positions	= [0];
				
				slider.elements.each(function()
				{
					slide_width += $(this).outerWidth(true);
					slider.positions.push(slide_width);
				});

				slider.container_width	= slider.slidewrap.width();
				slider.slide_width = slide_width;
				
				slider.slide.css({width:slide_width +"px"});
				
				if(slider.container_width < slide_width)
				{
					//sliding necessary
					slider.removeClass('hide_controls');
					slider.noscroll = false;
				}
				else
				{
					//sliding not necessary
					slider.addClass('hide_controls');
					slider.noscroll = true;
					
				}
			},
		
			set_properties: function(slider)
			{
				methods.set_inner_slide_width(slider);
				methods.transition(slider);
			}
		
		};
	
		return this.each(function()
		{
			var slider			= $(this);
			slider.options		= $.extend({}, defaults, options_passed);
			slider.elements		= slider.find(slider.options.elements);
			slider.isMobile		= document.documentElement.ontouchstart !== undefined ? true : false;
			slider.positions	= [];
			slider.noscroll		= false;
			slider.allow_moveTo = true;
			slider.animating	= false;
				
			methods.init(slider);

		});
	};
}(jQuery));







