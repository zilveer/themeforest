/**
 * Aviacordion Slider - A jQuery acordion slider with video support
 * (c) Copyright Christian "Kriesi" Budschedl
 * http://www.kriesi.at
 * http://www.twitter.com/kriesi/
 * version 3: introduces comboslide detection and fade in/out of preview images
 */


(function($)
{
	var pluginNameSpace = 'aviacordion',
		
		//methods used to create the slideshow
		methods = {
		
			/************************************************************************
			methods.init:
			
			initialize the slider by activating the image preloader if available and 
			then wait until images are loaded
			*************************************************************************/
			init: function()
			{
				//prepare slides
				methods.prepareSlides.apply( this );
			
				//start preloading images if the preloader is available
				if(jQuery.fn.aviaImagePreloader)
				{
					this.aviaImagePreloader({thisData: this, delay:500}, methods.preloadingDone);
				}
				else
				{
					methods.preloadingDone.apply( this );
				}
			},
			
			/************************************************************************
			methods.preloadingDone:
			
			once images are pre loaded execute all necessary functions for the slider
			like applying controlls and starting autorotation
			*************************************************************************/
			preloadingDone: function()
			{

				//fetch slider data
				var data = this.data( pluginNameSpace );
				
				//allow animation of slides:
				data.animatingNow = false;
				
				//now that the preloading was done increase the width ff all slides to prevent flickering when they move
				data.slides.css({width: data.expandedSlide});
				
				methods.addBehavior.apply( this );
				
				if(data.options.autorotation)
				{
					methods.autorotation.apply( this );
				}
				
				this.find('.slideshow_overlay').css({visibility:'visible'});
				this.find('.heading_clone').each(function(i)
				{
					var current = $(this);
					
					setTimeout(function()
					{
						current.animate({opacity:0.8});
					}, i * 100);
					
				});
				
			},
			
			/************************************************************************
			methods.prepareSlides:
			
			addds classnames slides so we know if they are image slides, image slides
			with video beneath or embeded videos 
			*************************************************************************/
			prepareSlides :function()
			{
				var data = this.data( pluginNameSpace ), currentslide, imageslide, videoslide, classname;
				
				data.slides.each(function(i)
				{
					currentslide 	= $(this);
					imageslide 		= currentslide.find('img');
					videoslide		= currentslide.find('video, embed, object, iframe, .avia_video');
					
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
					
					currentslide.addClass(classname);
					$('<span class="slideshow_overlay"></span>').css({'visibility':'hidden'}).appendTo(currentslide);

			
					/*aviacordion additions*/
					var positionData = {
						this_slides_position: i * data.slideWidth,							 // position if no item is active
						pos_active_higher: i * data.minimizedSlide,							 // position of the item if a higher item is active
						pos_active_lower: ((i-1) * data.minimizedSlide) + data.expandedSlide // position of the item if a lower item is active
					}
					
					//save data of each slide via jquerys data method	
					currentslide.data( pluginNameSpace, positionData );
					
					
					//set base properties	
					currentslide.css({zIndex:i+1, left: i * data.slideWidth, display:'block', width:(data.slideWidth+2)}); // +2 to prevent flickering of items bellow the items that need to be loaded yet				
					currentslide.append('<div class="shadow"></div>');
					
					methods.cloneCaption(currentslide);
					
					
				});
				var clones = this.find('.heading_clone'), newheight = 0;
				clones.each(function(){var cloneH = $(this).height(); newheight = cloneH > newheight ? cloneH : newheight; })
				clones.css({width:data.slideWidth, height: newheight, paddingRight:data.expandedSlide, opacity:0 });
			},
			
			/************************************************************************
			methods.cloneCaption:
			
			clones the available caption and creates the alternate caption versions
			that appear in closed state
			*************************************************************************/
			cloneCaption: function(currentslide)
			{
				var	real_excerpt 		= currentslide.find('.slideshow_caption').css({'-webkit-text-size-adjust':'none'}),			// wrapper to center the excerpt content verticaly
					real_excerpt_height = real_excerpt.css({display:'block'}).outerHeight(),		// height of the excerpt content
					slide_heading 		= currentslide.find('h1:eq(0)'),  					// slide heading
					cloned_heading 		= slide_heading.clone().appendTo(currentslide)
													   .wrap('<div class="heading_clone">').wrap('<div class="center_helper"></div>'),
					currentslidelink	= currentslide.find('a').not('.slideshow_caption a'),
					captionlink 		= real_excerpt.find('a'),
					lightboxlink 		= currentslide.find('a').not('.slideshow_caption a').filter('a[rel^="prettyPhoto"], a[rel^="lightbox"], a[href$=jpg], a[href$=png], a[href$=gif], a[href$=jpeg], a[href$=".mov"] , a[href$=".swf"] , a[href*="vimeo.com"] , a[href*="youtube.com"] , a[href*="screenr.com"]');
													   
					
					if(currentslidelink.length && !captionlink.length)
					{
						real_excerpt.css({cursor:'pointer'}).click(function()
						{ 
							if(lightboxlink.length)
							{
								currentslidelink.trigger('click');
							}
							else
							{
								top.location.href = currentslidelink.attr('href');
							}
						});
					}
									   
					real_excerpt.css({opacity:0.8, bottom: '-'+real_excerpt_height+'px'});								
					clone_height = cloned_heading.height();
			},
			
			addBehavior: function()
			{
				var current = this, data = this.data( pluginNameSpace );
				
				if(data.isIos)
				{
					data.slides.each(function()
					{
						var slide   = $(this),
							overlay = $('<div class="ios_overlay"></div>').appendTo(slide).css({position:'absolute',top:0,left:0,right:0,bottom:0,zIndex:1000});
					});
					
				}
				
				//show videos
				data.slides.bind('click.'+pluginNameSpace, function()
				{ 
					
					var clicked_item = $(this);
					
					if(data.isIos)
					{	
						data.slides.find('.ios_overlay').css({display:'block'});
						var overlay = clicked_item.find('.ios_overlay:visible');
						
						if(overlay.length)
						{
							overlay.css({display:'none'});
						}
					}
					
					
					if(!data.isIos && clicked_item.is('.comboslide'))
					{
						methods.showvideo.apply(current, [clicked_item]); 
						methods.autorotationStop.apply(current);
						 return false; 
					}
				}).bind(data.options.event+"."+pluginNameSpace,  function(event, continue_autoslide)
				{
					
					//stop autoslide on userinteraction
					if(!continue_autoslide)
					{
						methods.autorotationStop.apply( current );
					}
					
					var currentslide = $(this);
					var objData = currentslide.data( pluginNameSpace );
					var index = data.slides.index(currentslide);
					var cloned_heading = currentslide.find('.heading_clone');
					var	real_excerpt = currentslide.find('.slideshow_caption');
					var excerpt_content = real_excerpt.find('.featured_caption').length;
					
					currentslide.stop().animate({	left: objData.pos_active_higher},
													data.options.animationSpeed, data.options.easing);
													
					cloned_heading.stop().animate({bottom:"-" + cloned_heading.height()});
					
					if(excerpt_content) real_excerpt.stop().animate({bottom:0});
					
					data.slides.each(function(j)
					{
						if (index != j)
						{	
							var current = $(this),
							    currentobjData = current.data( pluginNameSpace ),
								new_pos = currentobjData.pos_active_higher;
								
							if(index  < j) { new_pos = currentobjData.pos_active_lower; }
							
							current.stop().animate({	left:  new_pos },
														data.options.animationSpeed, data.options.easing);
						}
					});
					
					
					
				}).bind("mouseleave."+pluginNameSpace,  function()
				{
					
							var currentslide = $(this),
							cloned_heading = currentslide.find('.heading_clone'),
							real_excerpt = currentslide.find('.slideshow_caption'),
							real_excerpt_height = real_excerpt.outerHeight();
							
							cloned_heading.stop().animate({bottom:0});
							real_excerpt.stop().animate({bottom:'-'+real_excerpt_height+'px'});
							
				});
				
				
				
				//set mouseout event: expand all slides to no-slide-active position and width
				this.bind("mouseleave."+pluginNameSpace, function()
				{
					data.slides.each(function(i)
					{
						var currentslide = $(this),
							objData = currentslide.data( pluginNameSpace ),
							new_pos = objData.this_slides_position;
							
							currentslide.stop().animate({left: new_pos},data.options.animationSpeed, data.options.easing);
							
							if(data.isIos)
							{
								currentslide.find('.ios_overlay').css({display:'block'});
							}
					});
					
				});
				
			}, 
			
			/************************************************************************
			methods.autorotation:
			
			start the slider autorotation
			*************************************************************************/
			autorotation: function()
			{ 
				var current = this,
					data = this.data( pluginNameSpace ),
					time = (parseInt(data.options.autorotationSpeed) * 1000),
					index = 0,
					firstrun = true;
					
					data.interval = setInterval(function()
					{ 
						if(index == data.slideCount)
						{
							data.slides.filter(':eq('+(index - 1)+')').trigger("mouseleave."+ pluginNameSpace);
							index = 0;
							firstrun = true;
							current.trigger("mouseleave."+ pluginNameSpace);					
						}
						else
						{
							if(!firstrun) data.slides.filter(':eq('+(index - 1)+')').trigger("mouseleave."+ pluginNameSpace);
							data.slides.filter(':eq('+index+')').trigger(data.options.event+"."+pluginNameSpace,[true]);
							
							index++;
							firstrun = false;
						}
					},
					time);
			},
			
			
			/************************************************************************
			methods.autorotationStop:
			
			stop the slider autorotation
			*************************************************************************/
			autorotationStop: function()
			{ 
				var data = this.data( pluginNameSpace );
				clearInterval(data.interval);
				data.interval = false;
			},
			
						
			
			/************************************************************************
			methods.showvideo:
			
			hide image and show video instead
			*************************************************************************/
			showvideo: function(clicked_item)
			{
				var data = this.data( pluginNameSpace ),
					image = clicked_item.find('img'),
					newWidth = image.width(),
					newHeight = image.height();
				
				clicked_item.find('img, canvas, .slideshow_overlay, .'+data.options.captionClass).stop().fadeOut();
				clicked_item.find('.slideshow_video').stop().fadeIn();
				clicked_item.find('.slideshow_video iframe, .slideshow_video embed, .slideshow_video object').height(newHeight).width(newWidth);
				
			},
			
			
			/************************************************************************
			methods.overwrite_defaults:
			
			lets you overwrite options for multiple sliders on one page with different 
			settings, without the need to call the slider function multiple times
			*************************************************************************/
			overwrite_options: function()
			{
				var data 	= this.data( pluginNameSpace ),
					optionsWrapper = this.parents('.slideshow_container:eq(0)');
					
					if(optionsWrapper.length)
					{
						var autoInterval = /autoslidedelay__(\d+)/;
						var matchInterval = autoInterval.exec(optionsWrapper[0].className);

						if(matchInterval != null) { data.options.autorotationSpeed = matchInterval[1]; }
						if(optionsWrapper.is('.autoslide_false')) 	data.options.autorotation = false;
						if(optionsWrapper.is('.autoslide_true')) 	data.options.autorotation = true;
						
					}
			}
			
		};



	$.fn.aviaCordion = function(options) 
	{
		return this.each(function()
		{
			var slider =  $(this), data = {},
			
			//default slideshow settings. can be overwritten by passing different values when calling the function 
			defaults = 
			{
				event: 				'mouseover',		//which event should be used to trigger the sliding
				slides: 			'li',				// wich element inside the container should serve as slide
				animationSpeed: 	900,				// animation duration
				easing: 			'easeOutQuint',		// animation easing
				autorotation: 		true,				// autorotation true or false?
				autorotationSpeed:	5,					// duration between autorotation switch in Seconds
				appendControlls: 	true,				// should slidecontrolls be appended or should we use none/predefined,
				captionOpacity:		0.8,
				captionClass:		'slideshow_caption'	// caption class
			};
			
			//merge default options and options passed by the user, then collect some slider data
			data.options 		= $.extend(defaults, options);
			data.slides  		= slider.find(data.options.slides).css({display:'none'});
			data.slideCount 	= data.slides.length;
			data.currentSlide 	= slider.find(data.options.slides + ':eq(0)').css({display:'block'});
			data.nextSlide	 	= slider.find(data.options.slides + ':eq(1)');
			data.interval 		= false;
			data.animatingNow 	= true;
			data.isIos			= navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/);
			
			if(data.isIos) data.options.event = 'click';
			
			//accordion specials
			data.expandedSlide	= data.slides.width();					// size of a slide when expanded, defined in css, class ".featured" by default
			data.slideWidth		= slider.width() / data.slideCount;		// width of the slides
			data.minimizedSlide	= (slider.width() - data.expandedSlide) / (data.slideCount - 1), // remaining width is shared among the non-active slides
			
			
			
			
			//apply data to the slider to keep track of variables and states
			slider.data( pluginNameSpace, data );
			
			//overwrite options with slider specific options if necessary
			methods.overwrite_options.apply( slider );
			
			//initialize the slideshow
			methods.init.apply( slider );
		});
	};
})(jQuery);



