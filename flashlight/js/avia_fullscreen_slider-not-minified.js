/**
 * Avia Fullscreen Slider - A simple jQuery image slider that supports lazy loading and full screen images
 * (c) Copyright Christian "Kriesi" Budschedl
 * http://www.kriesi.at
 * http://www.twitter.com/kriesi/
 */

(function($)
{
	var pluginNameSpace = 'avia_fullscreen_slider',
		
		//methods used to create the slideshow
		methods = {
		
			/************************************************************************
			methods.init:
			
			initialize the slider by activating the image preloader if available and 
			then wait until images are loaded
			*************************************************************************/
			init: function()
			{
			
				//start preloading images if the preloader is available
				methods.preloadLoop.apply( this );
				
			},
			
			init_first_loaded: function()
			{
				
				//fetch slider data
				var data = this.data( pluginNameSpace );
				data.imgCounter = $();
				
				//allow animation of slides:
				data.animatingNow = false;				
				
				//append controlls and start autsolider if we got more than one slide and these options are set
				if(data.slideCount > 1)
				{
					if(data.options.appendcontrolls) methods.appendcontrolls.apply( this );
					if(data.options.autorotation === "true" || data.options.autorotation === true) methods.autorotation.apply( this );
					
				}
				methods.bindEvents.apply( this );
				
				//show caption if available
				if(data.options.appendCaption) methods.appendCaption.apply( this );
				data.allcaptions = this.find('.'+data.options.captionClass).css({display:'none'});
				methods.showCaption.apply( this );
			},
			
			preloadLoop: function()
			{
				var data = this.data( pluginNameSpace ),
					current = this,
					imageToLoad = 0,
					firstcall = true;
				
				var preloadLoopInterval = setInterval(function()
					{
						if(data.imageUrls[imageToLoad]['status'] == true || firstcall === true)
						{	
							firstcall = false;
							
							//increase the array key so we know which image is next to load. if an images has already been loaded skip that key
							while(data.imageUrls.length > imageToLoad && data.imageUrls[imageToLoad]['status'] == true)
							{
								imageToLoad ++;
							}
							
							//if all images within the array are loaded stop the iteration
							if(data.imageUrls.length <= imageToLoad)
							{
								clearInterval(preloadLoopInterval);
							}
							//if the next array image was not loaded yet do so
							else if(data.imageUrls[imageToLoad]['status'] == false)
							{
								methods.specialPreloader.apply( current , [imageToLoad, methods.imagePreloaded]);
							}
						}

					}, 100);
			},
			
			specialPreloader: function(key, callback)
			{
				var current = this,
					data = this.data( pluginNameSpace ), objImage = new Image(), current = this;
				
				$(objImage).bind('load error', function()
				{ 
					
					if(key === 0) { methods.init_first_loaded.apply( current ); }
					data.imageUrls[key]['status'] = true; 
					if(typeof callback == 'function') callback.apply( current, [objImage, key] );
				});
				
				objImage.src = data.imageUrls[key]['url'];
			},
			
			
			
			imagePreloaded: function(image, key)
			{
				var current = this,
					data = this.data( pluginNameSpace ),
					currentSlide = data.slides.filter(':eq('+key+')');
					
				var newImage = $(image).css({opacity:0}).appendTo(currentSlide);
				
				if(key === 0)
				{
					data.currentImage 		= data.currentSlide.find('img');
					data.currentImageRatio 	= image.width / image.height;
					
					//needs settimeout for chrome to detect the image size wo problems
					setTimeout(function(){ data.window.trigger('resize'); if(data.useCanvas){ methods.addCanvas.apply( current , [currentSlide, 0]); } },10);
				}
				
				
				if(!data.useCanvas)
				{
					newImage.animate({opacity:1});
				}
				else
				{
					methods.addCanvas.apply( current , [currentSlide, key]); 
				}
				
				methods.prepareSlides.apply( this , [currentSlide]);
			},
			
			/************************************************************************
			methods.resizeBg:
			
			set the size of the background image
			*************************************************************************/
	        resizeBg: function() {
					var data  = this.data( pluginNameSpace ),
						div_h = data.window.height(),
						div_w = data.window.width();
					
					
						
					if(data.useCanvas) { methods.addCanvas.apply( this ); return; }
	
	                if ( (div_w / div_h) < data.currentImageRatio ) {
	                    data.currentImage
	                        .removeClass('bgwidth')
	                        .addClass('bgheight');
	                } else {
	                    data.currentImage
	                        .removeClass('bgheight')
	                        .addClass('bgwidth');
	                }

			    //center img position
			    var current =  data.currentImage.get(0);
			   current.style.marginLeft = "-" + (data.currentImage.width()/2) + 'px';
			   current.style.marginTop =  "-" + (data.currentImage.height()/2) + 'px';
			   
       		 },
       		 
       		/************************************************************************
			methods.addCanvas:
			
			creates a canvas version of the image
			*************************************************************************/ 
			
			addCanvas: function(currentSlide, key)
			{
			
			var data 			= this.data( pluginNameSpace );
			
			if(typeof currentSlide == 'undefined') 
			{
				if(data.switched === true)
				{
					currentSlide = data.nextSlide;
				}
				else
				{
					currentSlide = data.currentSlide;
				}
			}
			
			var currentImage 	= currentSlide.find('img');
			
			if(!currentImage.length) return false;
			
			var	win_h 			= data.window.height(),
				win_w 			= data.window.width(),
				img_w 			= currentImage.get(0).width,
				img_h 			= currentImage.get(0).height,
				image 			= currentImage.get(0);
				
				var canvas = currentSlide.find('.sliderCanvas');
				
				if(!canvas.length) 
				{ 
					canvas = $('<canvas class="sliderCanvas" height="'+win_h+'" width="'+win_w+'"></canvas>').appendTo(currentSlide);
					if(key === 0) 
					canvas.css({opacity:0}).animate({opacity:1},600);
				} 
				else
				{
					canvas.attr({height:win_h, width: win_w});
				}
				
				var context = canvas.get(0).getContext('2d'),
					imgRatio = img_w / img_h,
					winRatio = win_w / win_h,
					final = [];
				
				if( data.options.cropping )
				{
					if(winRatio < imgRatio )
					{
						final['height'] = win_h;
						final['width']  = (win_h/img_h) * img_w;
					}
					else
					{
						final['width'] = win_w;
						final['height']  = (win_w/img_w) * img_h;
					}
				}
				else
				{
					if(winRatio > imgRatio )
					{
						final['height'] = win_h;
						final['width']  = (win_h/img_h) * img_w;
					}
					else
					{
						final['width'] = win_w;
						final['height']  = (win_w/img_w) * img_h;
					}
				}
				
				
				
				final['offset_top'] = (final['height'] - win_h) / -2; 
				final['offset_left'] = (final['width'] - win_w) / -2;  
				
				context.drawImage(image, final['offset_left'], final['offset_top'], final['width'], final['height'] );
				
				
				
			},
			
			
			/************************************************************************
			methods.prepareSlides:
			
			addds classnames slides so we know if they are image slides, image slides
			with video beneath or embeded videos 
			*************************************************************************/
			prepareSlides :function(currentslide)
			{
				var data = this.data( pluginNameSpace ), imageslide, videoslide, classname;
				
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
				
				currentslide.addClass(classname).append('<span class="slideshow_overlay"></span>');
				
				//google chrome youtube fix: youtube videos need to be hidden and then shown before they respond to zIndex properties
				if(classname == 'videoslide' && i == 0)
				{
					currentslide.css({display:"none"});
					setTimeout(function()
					{
						currentslide.css({display:"block"});
					},10)
				}					
			},
			
			/************************************************************************
			methods.autorotation:
			
			start the slider autorotation
			*************************************************************************/
			autorotation: function()
			{ 
				var current = this,
					data = this.data( pluginNameSpace ),
					time = (parseInt(data.options.autorotationspeed) * 1000);
					
					data.interval = setTimeout(function()
					{ 
						//switch slides
						if(!data.skipAutorotate) methods.transition.apply( current, ['next'] );							
						
						//call this function again
						if(data.interval != false) methods.autorotation.apply( current );
					},
					time);
					
					if(data.options.appendcontrolls) data.arrowControlls.play.addClass('ctrl_active').text('Pause');
			},
			
			
			/************************************************************************
			methods.autorotationStop:
			
			stop the slider autorotation
			*************************************************************************/
			autorotationStop: function()
			{ 
				var data = this.data( pluginNameSpace );
				clearTimeout(data.interval);
				data.interval = false;
				
				if(data.options.appendcontrolls && data.arrowControlls && data.arrowControlls.play && data.arrowControlls.play.length) data.arrowControlls.play.removeClass('ctrl_active').text('Play');
			},
			
			/************************************************************************
			methods.switchAutorotation:
			
			switch between active and inactive autorotation state
			*************************************************************************/
			switchAutorotation: function()
			{
				var data = this.data( pluginNameSpace );
				
				if(data.interval)
				{
					methods.autorotationStop.apply( this );
				}
				else
				{
					methods.transition.apply( this, ['next'] );
					methods.autorotation.apply( this );
				}
			},
			
			/************************************************************************
			methods.appendcontrolls:
			
			append direct controlls as well as arrow controlls to the slider
			*************************************************************************/
			appendcontrolls: function()
			{
				var data = this.data( pluginNameSpace ),
					first = 'class="active_item" ',
					singlecontroll = '',
					arrowcontroll  = '<span class="ctrl_back ctrl_arrow">Previous</span>';
					arrowcontroll += '<span class="ctrl_play ctrl_arrow">Play</span>';
					arrowcontroll += '<span class="ctrl_fwd  ctrl_arrow">Next</span>';
				
				for(var i = 0; i < data.slideCount; i++)
				{
					singlecontroll += '<a '+first+'href="#'+i+'">'+(i+1)+'</a>';
					first = '';
				}
				
				data.controllContainer = $('<div class="slidecontrolls">'+singlecontroll+'</div>').insertAfter(this);
				data.arrowControllContainer = $('<div class="arrowslidecontrolls_fullscreen">'+arrowcontroll+'</div>').insertAfter(this);
				data.controlls = data.controllContainer.find('span');
				data.arrowControlls = { 
										 prev: data.arrowControllContainer.find('.ctrl_back'), 
										 next: data.arrowControllContainer.find('.ctrl_fwd'), 
										 play: data.arrowControllContainer.find('.ctrl_play'),
										 all:  data.arrowControllContainer.find('span')
										  }; 
										  
				data.hideSidebar = $('<div class="hide_content_wrap"></div>').appendTo(data.arrowControllContainer);
				data.hideSidebar.append('<a class="hide_content no_scroll" href="#hide-content">'+data.options.hide+'</a>');
				
				
				data.options.imagecounter = data.options.imagecounter.replace(/-X-/,'<br/><span class="img_count_single">1</span>')
																	 .replace(/-Y-/,'<span class="img_all_count">'+data.slideCount+'</span>');
																	 
				data.hideSidebar.append("<div class='img_count'>"+data.options.imagecounter+"</div>");													 
				data.imgCounter = data.hideSidebar.find('.img_count_single');
				
			},
			
			/************************************************************************
			methods.setSlides:
			
			checks which slide should be displayed next and stores that information to
			the this.data.nextSlide var
			*************************************************************************/
			setSlides: function(selector)
			{
				//get slider data and set the current slide by selecting the one that is visible
				var data = this.data( pluginNameSpace ), newIndex;
				
				if(!data.animatingNow)
				{
					data.currentSlide = this.find(data.options.slides + ':visible');
					data.currentSlideIndex 	= data.slides.index(data.currentSlide);
					
					//based on the passed selector value (next/prev/integer value) get the number of the next slide
					switch (selector)
					{
						case 'next': newIndex = data.currentSlideIndex + 1 < data.slideCount  ? data.currentSlideIndex + 1 : 0;  break;
						case 'prev': newIndex = data.currentSlideIndex - 1 >= 0 ? data.currentSlideIndex - 1 : data.slideCount - 1; break;
						default: newIndex = selector;
					}
					
					//select the next slide and store it to data.nextSlide
					data.nextSlide = this.find( data.options.slides + ':eq('+newIndex+')');
					data.currentSlideIndex = newIndex;
					
					//check if the current slide is the same as the next one. if so skip the transition
					if(data.nextSlide[0] == data.currentSlide[0]) data.skipTransition = true;
				}
			},
			
			/************************************************************************
			methods.appendCaption:
			
			append a caption based on the image alt attribute
			*************************************************************************/
			appendCaption: function()
			{
				var data = this.data( pluginNameSpace ), description = false, splitdesc = [];
				
				data.slides.each(function()
				{
					var currentSlide = $(this);
					description 	 = currentSlide.find('img').attr('alt');
					
					if(description) splitdesc = description.split('::');
								
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

					if(description)
					{
						$('<span></span>').addClass(data.options.captionClass)
										  .html(description)
										  .css({display:'none', 'opacity':data.options.captionOpacity})
										  .appendTo(currentSlide); 
					}
				});
				
			},
			
			/************************************************************************
			methods.showCaption:
			
			show the caption for the current slide once the slide has been revealed
			*************************************************************************/
			showCaption: function()
			{
				var data 		= this.data( pluginNameSpace );
				
				//hide all other captions
				data.allcaptions = this.find('.'+data.options.captionClass).css({display:'none'});
				
				//select current caption
				var caption 	= data.currentSlide.find('.'+data.options.captionClass).css({display:'block', opacity:0});
					
				caption.animate({opacity: data.options.captionOpacity});
			},
			
			/************************************************************************
			methods.switchSlides:
			
			visual slide transition via jQuerys animate function
			*************************************************************************/
			fadeSlides: function()
			{
				var current = $(this), data = this.data( pluginNameSpace ), newInterval = false;
				
				if(data.imageUrls[data.currentSlideIndex]['status'] !== true)
				{
					if(data.interval)
					{
						data.skipAutorotate = true;
					}
				
					methods.specialPreloader.apply( current , [data.currentSlideIndex, function(objImage, key)
					{ 
						methods.imagePreloaded.apply( current, [objImage, key] ); 
						methods.switchSlides.apply(current);
						data.skipAutorotate = false; 
					}]);
					
					
					
					return;
				}
				
				data.imgCounter.html(data.currentSlideIndex + 1);
				data.thumbnailContainer.find('.active_thumb').removeClass('active_thumb');
				data.thumbnailContainer.find('.fullscreen_thumb:eq('+data.currentSlideIndex+')').addClass('active_thumb');
				
				if(!data.animatingNow && !data.skipTransition)
				{
					methods.beforeSwitch.apply( current );
					data.currentSlide.animate({opacity:0}, data.options.animationSpeed ,  function(){ methods.switchComplete.apply( current ); });
					
					//check the controlls and apply the active class to the correct controll
					if(data.options.appendcontrolls) data.controlls.removeClass('active_item').filter(':eq('+data.currentSlideIndex+')').addClass('active_item');
				}
				
				if(data.skipTransition) data.skipTransition = false;
			},
			
		
			
			
			/************************************************************************
			methods.moveSlides:
			
			visual sliding transition via jQuerys animate function
			*************************************************************************/
			moveSlides: function()
			{
				var current = $(this), data = this.data( pluginNameSpace );
				
				if(data.imageUrls[data.currentSlideIndex]['status'] !== true)
				{
					if(data.interval)
					{
						data.skipAutorotate = true;
					}
				
					methods.specialPreloader.apply( current , [data.currentSlideIndex, function(objImage, key)
					{ 
						methods.imagePreloaded.apply( current, [objImage, key] ); 
						methods.switchSlides.apply(current);
						data.skipAutorotate = false; 
					}]);
					
					
					
					return;
				}
				
				data.imgCounter.html(data.currentSlideIndex + 1);
				data.thumbnailContainer.find('.active_thumb').removeClass('active_thumb');
				data.thumbnailContainer.find('.fullscreen_thumb:eq('+data.currentSlideIndex+')').addClass('active_thumb');
				
				if(!data.animatingNow && !data.skipTransition)
				{
					methods.beforeSwitch.apply( current );
					
					var indexCurrent = data.slides.index(data.currentSlide),
						indexNext 	 = data.slides.index(data.nextSlide),
						direction	 = 1,
						positioning  = -1;
						movement	 = parseInt(current.width());
					
					if(indexCurrent < indexNext) direction = -1;
					
					data.nextSlide.css({opacity:1, left: ((movement * direction) * positioning)}).animate({left: 0}, data.options.animationSpeed, data.options.defaultEasing);
					data.currentSlide.animate({left: (movement * direction)}, data.options.animationSpeed, data.options.defaultEasing, function(){ methods.switchComplete.apply( current ); });
					
					//check the controlls and apply the active class to the correct controll
					if(data.options.appendcontrolls) data.controlls.removeClass('active_item').filter(':eq('+data.currentSlideIndex+')').addClass('active_item');
				}
			},
			
			/************************************************************************
			methods.beforeSwitch:
			
			execute this before the slide switching starts
			*************************************************************************/
			beforeSwitch: function()
			{
				var data = this.data( pluginNameSpace );
				
				data.animatingNow = true;
				data.currentSlide.css({zIndex:3});
				data.nextSlide.css({zIndex:2, display:'block'});
				
				
				
				//set information if resize occurs
				data.currentImage 		= data.nextSlide.find('img');
				data.currentImageRatio 	= data.currentImage.get(0).width / data.currentImage.get(0).height;

				
				//IE fix which sometimes doesnt return windows width correctly
				if(data.currentImageRatio == 0 || data.currentImage.get(0).height == 0 || data.currentImage.get(0).width)
				{ 
					data.currentImageRatio 	= data.currentImage.width() / data.currentImage.height();
				}
				
				data.switched = true;
				data.window.trigger('resize');
				
			},
			
			/************************************************************************
			methods.switchComplete:
			
			execute this once the slides have been switched
			*************************************************************************/
			switchComplete: function()
			{
				var data = this.data( pluginNameSpace );
				
				data.animatingNow = false;
				data.currentSlide.css({zIndex:2, display:'none', opacity:1});
				data.nextSlide.css({zIndex:3});
				
				//set the current slide
				data.currentSlide = data.nextSlide;
				
				
				//show image caption
				methods.showCaption.apply( this );
				
				
			},
			
			/************************************************************************
			methods.transition:
			
			switch the slides
			*************************************************************************/
			transition: function(selector, autorotation)
			{
				var data = this.data( pluginNameSpace );
			
				methods.setSlides.apply( this, [selector] );	
				//fade or slide transition
				if(data.options.transition == 'slide')
				{
					methods.moveSlides.apply( this );
				}
				else
				{
					methods.fadeSlides.apply( this );
				}
				
				if('stop_autorotation' == autorotation)
				{
					methods.autorotationStop.apply(this);
				}
			},
			
			
			
       		 
       		/************************************************************************
			methods.move_thumnails:
			
			moves thumbnails
			*************************************************************************/
	        move_thumnails: function() {
				
					var current = this, 
						data = this.data( pluginNameSpace ),
						outerContainer = $('.avia_fullscreen_slider_thumbs_outer_slide'),
						slideContainer = $('.avia_fullscreen_slider_thumbs_inner_slide'),
						outerWidth = outerContainer.width(),
						innerWidth = slideContainer.width(),
						newpos = outerWidth - parseInt(slideContainer.css('left'),10),
						thumbspace = data.thumbnails.outerWidth() + parseInt(data.thumbnails.css('margin-right'),10);
					
					if(thumbspace < 20) thumbspace = 60;
					newpos = newpos - (newpos % thumbspace);
					
					if(newpos >= innerWidth) newpos = 0;
						
					if(outerWidth < innerWidth)
					{
						slideContainer.animate({left: '-' + newpos + "px"}, 1000, "easeInOutQuint");
					}
						
       		 },

        
			
			/************************************************************************
			methods.bindEvents:
			
			bind all events for the slider
			*************************************************************************/
			bindEvents: function()
			{ 
				// actiavte portfolio sorting
				if(jQuery.fn.avia_hide_sidebar_content)
				jQuery('body').avia_hide_sidebar_content();	
			
				var current = this, data = this.data( pluginNameSpace );
				
				data.window.resize(function() {
		                methods.resizeBg.apply( current );
		        });
				
				//when any link within the slideshow is clicked stop the autorotation
				this.find('a').bind('click.'+pluginNameSpace, function(){ methods.autorotationStop.apply(current); });
				
				//show videos
				data.slides.bind('click.'+pluginNameSpace, function()
				{ 
					var clicked_item = $(this);
					
					if(clicked_item.is('.comboslide'))
					{
						methods.showvideo.apply(current, [clicked_item]); 
						methods.autorotationStop.apply(current);
						return false; 
					}
				});
				//hide captions when showing videos
				data.slides.filter('.comboslide, .videoslide').hover(
				
					function()
					{
						$(this).find('.slideshow_caption').stop().animate({opacity:0});
					},
					function()
					{
						$(this).find('.slideshow_caption').stop().animate({opacity:1});
					}
				
				);
				
				//bind thumbnail clicks
				if(data.thumbnailContainer.length)
				{
					data.thumbnails.click(function()
					{
						if($(this).is('.active_thumb')) return;
					
						var selector = data.thumbnails.index(this);
						methods.transition.apply(current, [selector, 'stop_autorotation']);
						return false;
					});	
					
					var slide_thumbnails = $('.slide_thumbnails', data.thumbnailContainer),
						thumbspace = data.thumbnails.outerWidth() + parseInt(data.thumbnails.css('margin-right'),10),
						slideContainer = $('.avia_fullscreen_slider_thumbs_inner_slide');
						
						if(thumbspace < 20) thumbspace = 60;
						newWidth = thumbspace * data.thumbnails.length;
					
					
					slideContainer.width(newWidth);
					slide_thumbnails.click(function()
					{
						methods.move_thumnails.apply(current);
						return false;
					});	
					
					var resizeTimeout;
					data.window.resize(function() {
						clearTimeout(resizeTimeout);
						resizeTimeout = setTimeout(function()
						{
		               		var outerContainer = $('.avia_fullscreen_slider_thumbs_outer_slide');
							
							if(outerContainer.width() > slideContainer.width())
							{
								slide_thumbnails.filter(':visible').fadeOut();
								slideContainer.animate({left: "0px"});
							}
							else
							{
								slide_thumbnails.not(':visible').fadeIn();
							}
								
		                },400);
		        });
					
				}
				
				
				
				
				
				//bind controll clicks
				if(data.controlls && data.controlls.length)
				{
					//bind controll clicks
					data.controlls.bind('click.'+pluginNameSpace, function()
					{ 
						var selector = this.hash.substr(1); 
						methods.transition.apply(current, [selector, 'stop_autorotation']);
						return false;
					});
				}
				
				//bind arrowControll clicks
				if(data.arrowControlls && data.arrowControlls.next.length)
				{
					//bind arrowControll clicks
					data.arrowControlls.next.bind('click.'+pluginNameSpace, function(){ methods.transition.apply(current, ['next','stop_autorotation']); return false; });
					data.arrowControlls.prev.bind('click.'+pluginNameSpace, function(){ methods.transition.apply(current, ['prev','stop_autorotation']); return false; });
					data.arrowControlls.play.bind('click.'+pluginNameSpace, function(){ methods.switchAutorotation.apply(current); return false; });
					
					
					//hide arrows if mouse cursor is not hovering slider area
					if(data.options.hideArrows) 
					{
						data.arrowControlls.all.css({opacity:0});							
						current.parent('.slideshow_container').hover(
						
							function()
							{
								data.arrowControlls.all.stop().animate({'opacity':1});
							},
							function(event)
							{
								if(!$(event.relatedTarget).is('.ctrl_arrow'))
								{
									data.arrowControlls.all.stop().animate({'opacity':0});
								}
							}
						);
					}
				}
				
				
				//bind older ios fixed background position fake:
				
				if(data.is_iOS && !data.is_iOS_5)
				{
					data.window.resize(function() 
					{
		            	current.width(data.window.width()).height(data.window.height()).css({position:'absolute'});   
		       		});
		       		
		       		data.window.scroll(function() 
					{
		            	current.css({top:data.window.scrollTop()});   
		       		});
				}
				
				
			},
			
			/************************************************************************
			methods.showvideo:
			
			hide image and show video instead
			*************************************************************************/
			showvideo: function(clicked_item)
			{
				var data = this.data( pluginNameSpace );
				
				clicked_item.find('img, canvas, .slideshow_overlay, .'+data.options.captionClass).stop().fadeOut();
				clicked_item.find('.slideshow_video').stop().fadeIn();
				
			},
			
			
			
			/************************************************************************
			methods.overwrite_defaults:
			
			lets you overwrite options for multiple sliders on one page with different 
			settings, without the need to call the slider function multiple times
			*************************************************************************/
			overwrite_options: function()
			{
				var data 	= this.data( pluginNameSpace ),
					optionsWrapper = this,
					htmlData = optionsWrapper.data(),
					i = "";
					
					for (i in htmlData)
					{
						if(typeof htmlData[i] == "string" || typeof htmlData[i] == "number" || typeof htmlData[i] == "boolean")
						{
							data.options[i] = htmlData[i];
						}
					}
					
			}
			
		};



	$.fn.avia_fullscreen_slider = function(options) 
	{
		return this.each(function()
		{
			var slider =  $(this), data = {},
			
			//default slideshow settings. can be overwritten by passing different values when calling the function 
			defaults = 
			{
				slides: 			'li',				// wich element inside the container should serve as slide
				animationSpeed: 	700,				// animation duration
				autorotation: 		"true",				// autorotation true or false?
				autorotationspeed:	3,					// duration between autorotation switch in Seconds
				appendcontrolls: 	true,				// should slidecontrolls be appended or should we use none/predefined,
				appendCaption: 		true,				// should a caption be created by using the slideshow images alt tag?,
				captionOpacity:		0.8,
				hideArrows:			false,				//hide slidecontroll arrows if mouse is not located over slider
				resizeSlider:		false,				//resizes the slider height, in case we got different sized preview images
				defaultEasing: 		'easeInOutExpo',		// default easing for animations
				captionClass:		'slideshow_caption',	// caption class
				transition:			'fade',
				cropping:			true
			};
			
			//merge default options and options passed by the user, then collect some slider data
			data.options 		= $.extend(defaults, options);
			data.slides  		= slider.find(data.options.slides).css({display:'none'});
			data.slideCount 	= data.slides.length;
			data.currentSlide 	= slider.find(data.options.slides + ':eq(0)').css({display:'block'});
			data.nextSlide	 	= slider.find(data.options.slides + ':eq(1)');
			data.interval 		= false;
			data.animatingNow 	= true;
			data.imageUrls 		= [];
			data.window 		= $(window);
			data.thumbnailContainer = $('.avia_fullscreen_slider_thumbs');
			data.thumbnails = data.thumbnailContainer.find('.fullscreen_thumb');
			data.useCanvas = false;
			data.is_iOS = navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/);
			data.is_iOS_5 = navigator.userAgent.toLowerCase().match(/(5_)/);
			
			if (document.createElement('canvas').getContext) { data.useCanvas = true; }
			//collect url strings of the images to preload
			data.slides.each(function(i)
			{
				data.imageUrls[i] = [];
				data.imageUrls[i]['url'] = $(this).data("image");
				data.imageUrls[i]['status'] = false;
			});
			
			//apply data to the slider to keep track of variables and states
			slider.data( pluginNameSpace, data );
			
			//overwrite options with slider specific options if necessary
			methods.overwrite_options.apply( slider );
			
			//initialize the slideshow
			methods.init.apply( slider );
		});
	};
})(jQuery);





// -------------------------------------------------------------------------------------------
// sidebar & content hideing
// -------------------------------------------------------------------------------------------


// -------------------------------------------------------------------------------------------
// sidebar & content hideing
// -------------------------------------------------------------------------------------------



(function($)
{
	$.fn.avia_hide_sidebar_content = function() 
	{
		var pluginNameSpace 	= 'avia_portfolio_sort', 
			transition1			= 'easeOutQuint',
			transition			= 'easeOutQuint',
			animating 			= false,
			link 				= $('.hide_content'), 
			linkBack 			= $('.return_content'),
			thumbnails 			= $('.avia_fullscreen_slider_thumbs'),
			imagecount 			= $('.img_count'),
			duration			= 1500,
			durationBetween		= 100,
			sidebars			= $('.sidebar'),
			sidebar1			= $('.sidebar1'),
			sidebar2			= $('.sidebar2'),
			win 				= $(window),
			overlay				= $('.background_overlay'),
			main 				= $( '#main' ),
			main_mini			= $('.entry-mini'),
			windowwWidth		= main.width(),
			showContent			= false,
			catch_clicks		= false,
			originalPos			= {sb_pos1: parseInt(sidebar1.css('left'), 10), sb_pos2: parseInt(sidebar2.css('left'), 10), main_pos: parseInt(main.css('left'),10), main_mini_pos: parseInt(main_mini.css('right'),10) };
			
			
		var	methods				= {
		
				keyboard_nav: function()
				{
					var thumbs = thumbnails.find('.fullscreen_thumb');
					
					if(thumbs.length){
					
						$(document).keydown(function(e)
						{
							if(catch_clicks)
							{
								var activethumb = thumbs.filter('.active_thumb'),
								thumbindex	= thumbs.index(activethumb),
								nextactive  = "";
																
								if (e.keyCode == 37) 
								{ 
									if(thumbindex - 1 < 0)
									{
										nextactive = thumbs.length - 1;
									}
									else
									{
										nextactive = thumbindex - 1;
									}
									thumbs.filter(':eq('+nextactive+')').trigger('click');
									return false;
								}
								else if (e.keyCode == 39) 
								{ 
								
									if(thumbindex + 1 > thumbs.length - 1)
									{
										nextactive = 0;
									}
									else
									{
										nextactive = thumbindex + 1;
									}
									thumbs.filter(':eq('+nextactive+')').trigger('click');
									return false;
								}
							}
						});
						
					}
				},
		
				set_sidebar: function()
				{
					//check for older ie versions
					if(!jQuery.support.leadingWhitespace)
					{
						jQuery('#wrap_all, #main, #main .container').css({minHeight:win.height() - 66});
					}
				
					sidebars.each(function()
					{
						var current 			= $(this),
							sidebar_inner		= $('.inner_sidebar', this),
							sb_offset			= sidebar_inner.offset(),
							sb_check_val		= sidebar_inner.height() + sb_offset.top + 66;
						
						if(!current.is('.sidebar_absolute')) sb_check_val = sb_check_val - win.scrollTop();
										
						if(sb_check_val > win.height()) 
						{ 
							current.addClass('sidebar_absolute'); 
						}
						else
						{
							current.removeClass('sidebar_absolute'); 
						}
					});
					
				},
			
				hideContent: function()
				{
					if(!animating)
					{
						originalPos			= {	sb_pos1: parseInt(sidebar1.css('left'), 10), 
												sb_pos2: parseInt(sidebar2.css('left'), 10), 
												main_pos: parseInt(main.css('left'),10), 
												main_mini_pos: parseInt(main_mini.css('right'),10) 
											};
											
						animating = true;
						catch_clicks = true;
						var animateThis = {left:-windowwWidth*2};
						var animateThis2= {right:-windowwWidth};
						link.fadeOut();
						imagecount.fadeIn();
						sidebar1.animate(animateThis, duration, transition1);
						main_mini.animate(animateThis2, duration, transition1, function(){ main_mini.css({zIndex:0}); }); 
						
						
						setTimeout(function()
						{ 
							linkBack.css({display:'block'}).animate({bottom:0}, 300); 
							thumbnails.css({display:'block'}).animate({bottom:0}, 300);
							win.trigger('resize'); 
							
							if(showContent)
							{
								$('body').removeClass('instant_gallery');
								
							}
						}, 400);
							
						setTimeout(function()
						{ 
							if(jQuery.support.opacity) { overlay.animate({opacity:0});}else{overlay.css({display:'none'});}
							main.animate(animateThis, duration, transition1, function(){ main.css({zIndex:0}); animating = false; }); 
							
						}, 
						durationBetween);
						
						setTimeout(function()
						{ 
							sidebar2.animate(animateThis, duration, transition1);
						}, 
						durationBetween * 2);
					}
					return false;
				},
				
				showContent: function()
				{
					if(!animating)
					{
						catch_clicks = false;
						animating = true;
						var animateThis = {left:-windowwWidth};
						
						sidebar2.animate({left:originalPos.sb_pos2}, duration, transition, function()
						{
							sidebar2.attr('style','');
						});
						
						setTimeout(function()
						{ 
							main.css({zIndex:10}).animate({left:originalPos.main_pos}, duration, transition);
						}, 
						durationBetween);
						
						linkBack.animate({bottom:-80}, 300);
						thumbnails.animate({bottom:-80}, 300, function()
						{
							thumbnails.css({display:'none'})
							linkBack.css({display:'none'})
						});
						link.fadeIn();
						imagecount.fadeOut();

						
						setTimeout(function()
						{ 
							if(jQuery.support.opacity) {  overlay.animate({opacity:1}); } else {overlay.css({display:'block'});}
							
							main_mini.animate({right:originalPos.main_mini_pos}, duration, transition1, function(){ main_mini.css({zIndex:0}); }); 
							sidebar1.animate({left:originalPos.sb_pos1}, duration, transition, function()
							{
								animating = false;
								sidebar1.attr('style','');
							});
						}, 
						durationBetween*2);
					}
					return false;
				}
			
			};
			
	
		return this.each(function()
		{
		
			link.bind('click.'+pluginNameSpace, methods.hideContent);
			linkBack.bind('click.'+pluginNameSpace, methods.showContent);
			win.resize(methods.set_sidebar).trigger('resize');
			
			methods.keyboard_nav();
			
			if($('body').is('.instant_gallery'))
			{
				showContent = true;
				link.trigger('click');
			}
		});
	}
})(jQuery);	

