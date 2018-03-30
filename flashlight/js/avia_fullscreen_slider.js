/**
 * Avia Fullscreen Slider - A simple jQuery image slider that supports lazy loading and full screen images
 * (c) Copyright Christian "Kriesi" Budschedl
 * http://www.kriesi.at
 * http://www.twitter.com/kriesi/
 */

(function ($) {
    var h = 'avia_fullscreen_slider',
        methods = {
            init: function () {
                methods.preloadLoop.apply(this)
            },
            init_first_loaded: function () {
                var a = this.data(h);
                a.imgCounter = $();
                a.animatingNow = false;
                if (a.slideCount > 1) {
                    if (a.options.appendcontrolls) methods.appendcontrolls.apply(this);
                    if (a.options.autorotation === "true" || a.options.autorotation === true) methods.autorotation.apply(this)
                }
                methods.bindEvents.apply(this);
                if (a.options.appendCaption) methods.appendCaption.apply(this);
                a.allcaptions = this.find('.' + a.options.captionClass).css({
                    display: 'none'
                });
                methods.showCaption.apply(this)
            },
            preloadLoop: function () {
                var a = this.data(h),
                    current = this,
                    imageToLoad = 0,
                    firstcall = true;
                var b = setInterval(function () {
                    if (a.imageUrls[imageToLoad]['status'] == true || firstcall === true) {
                        firstcall = false;
                        while (a.imageUrls.length > imageToLoad && a.imageUrls[imageToLoad]['status'] == true) {
                            imageToLoad++
                        }
                        if (a.imageUrls.length <= imageToLoad) {
                            clearInterval(b)
                        } else if (a.imageUrls[imageToLoad]['status'] == false) {
                            methods.specialPreloader.apply(current, [imageToLoad, methods.imagePreloaded])
                        }
                    }
                }, 100)
            },
            specialPreloader: function (a, b) {
                var c = this,
                    data = this.data(h),
                    objImage = new Image(),
                    c = this;
                $(objImage).bind('load error', function () {
                    if (a === 0) {
                        methods.init_first_loaded.apply(c)
                    }
                    data.imageUrls[a]['status'] = true;
                    if (typeof b == 'function') b.apply(c, [objImage, a])
                });
                objImage.src = data.imageUrls[a]['url']
            },
            imagePreloaded: function (a, b) {
                var c = this,
                    data = this.data(h),
                    currentSlide = data.slides.filter(':eq(' + b + ')');
                var d = $(a).css({
                    opacity: 0
                }).appendTo(currentSlide);
                if (b === 0) {
                    data.currentImage = data.currentSlide.find('img');
                    data.currentImageRatio = a.width / a.height;
                    setTimeout(function () {
                        data.window.trigger('resize');
                        if (data.useCanvas) {
                            methods.addCanvas.apply(c, [currentSlide, 0])
                        }
                    }, 10)
                }
                if (!data.useCanvas) {
                    d.animate({
                        opacity: 1
                    })
                } else {
                    methods.addCanvas.apply(c, [currentSlide, b])
                }
                methods.prepareSlides.apply(this, [currentSlide])
            },
            resizeBg: function () {
                var a = this.data(h),
                    div_h = a.window.height(),
                    div_w = a.window.width();
                if (a.useCanvas) {
                    methods.addCanvas.apply(this);
                    return
                }
                if ((div_w / div_h) < a.currentImageRatio) {
                    a.currentImage.removeClass('bgwidth').addClass('bgheight')
                } else {
                    a.currentImage.removeClass('bgheight').addClass('bgwidth')
                }
                var b = a.currentImage.get(0);
                b.style.marginLeft = "-" + (a.currentImage.width() / 2) + 'px';
                b.style.marginTop = "-" + (a.currentImage.height() / 2) + 'px'
            },
            addCanvas: function (a, b) {
                var c = this.data(h);
                if (typeof a == 'undefined') {
                    if (c.switched === true) {
                        a = c.nextSlide
                    } else {
                        a = c.currentSlide
                    }
                }
                var d = a.find('img');
                if (!d.length) return false;
                var e = c.window.height(),
                    win_w = c.window.width(),
                    img_w = d.get(0).width,
                    img_h = d.get(0).height,
                    image = d.get(0);
                var f = a.find('.sliderCanvas'), firstrun = false;
                if (!f.length) {
                	firstrun = true;
                    f = $('<canvas class="sliderCanvas" height="' + e + '" width="' + win_w + '"></canvas>').appendTo(a);
                    if (b === 0) f.css({
                        opacity: 0
                    }).animate({
                        opacity: 1
                    }, 600)
                } else {
                    f.attr({
                        height: e,
                        width: win_w
                    })
                }
                
                var g = f.get(0).getContext('2d'),
                    imgRatio = img_w / img_h,
                    winRatio = win_w / e,
                    final = [];
                if (c.options.cropping) {
                    if (winRatio < imgRatio) {
                        final['height'] = e;
                        final['width'] = (e / img_h) * img_w
                    } else {
                        final['width'] = win_w;
                        final['height'] = (win_w / img_w) * img_h
                    }
                } else {
                    if (winRatio > imgRatio) {
                        final['height'] = e;
                        final['width'] = (e / img_h) * img_w
                    } else {
                        final['width'] = win_w;
                        final['height'] = (win_w / img_w) * img_h
                    }
                }
                final['offset_top'] = (final['height'] - e) / -2;
                final['offset_left'] = (final['width'] - win_w) / -2;
                
                
                try{
					g.drawImage(image, final['offset_left'], final['offset_top'], final['width'], final['height']);
				}
				catch(err)
				{
					setTimeout(function()
					{
						g.drawImage(image, final['offset_left'], final['offset_top'], final['width'], final['height']);
						if(window.console && window.console.log) console.log(image);
					},50)
				}
            	
            
            },
            prepareSlides: function (a) {
                var b = this.data(h),
                    imageslide, videoslide, classname;
                imageslide = a.find('img');
                videoslide = a.find('video, embed, object, iframe, .avia_video');
                if (imageslide.length && videoslide.length) {
                    classname = 'comboslide'
                } else if (videoslide.length) {
                    classname = 'videoslide'
                } else if (imageslide.length) {
                    classname = 'imageslide'
                }
                a.addClass(classname).append('<span class="slideshow_overlay"></span>');
                if (classname == 'videoslide' && i == 0) {
                    a.css({
                        display: "none"
                    });
                    setTimeout(function () {
                        a.css({
                            display: "block"
                        })
                    }, 10)
                }
            },
            autorotation: function () {
                var a = this,
                    data = this.data(h),
                    time = (parseInt(data.options.autorotationspeed) * 1000);
                data.interval = setTimeout(function () {
                    if (!data.skipAutorotate) methods.transition.apply(a, ['next']);
                    if (data.interval != false) methods.autorotation.apply(a)
                }, time);
                if (data.options.appendcontrolls) data.arrowControlls.play.addClass('ctrl_active').text('Pause')
            },
            autorotationStop: function () {
                var a = this.data(h);
                clearTimeout(a.interval);
                a.interval = false;
                if (a.options.appendcontrolls && a.arrowControlls && a.arrowControlls.play && a.arrowControlls.play.length) a.arrowControlls.play.removeClass('ctrl_active').text('Play')
            },
            switchAutorotation: function () {
                var a = this.data(h);
                if (a.interval) {
                    methods.autorotationStop.apply(this)
                } else {
                    methods.transition.apply(this, ['next']);
                    methods.autorotation.apply(this)
                }
            },
            appendcontrolls: function () {
                var a = this.data(h),
                    first = 'class="active_item" ',
                    singlecontroll = '',
                    arrowcontroll = '<span class="ctrl_back ctrl_arrow">Previous</span>';
                arrowcontroll += '<span class="ctrl_play ctrl_arrow">Play</span>';
                arrowcontroll += '<span class="ctrl_fwd  ctrl_arrow">Next</span>';
                for (var i = 0; i < a.slideCount; i++) {
                    singlecontroll += '<a ' + first + 'href="#' + i + '">' + (i + 1) + '</a>';
                    first = ''
                }
                a.controllContainer = $('<div class="slidecontrolls">' + singlecontroll + '</div>').insertAfter(this);
                a.arrowControllContainer = $('<div class="arrowslidecontrolls_fullscreen">' + arrowcontroll + '</div>').insertAfter(this);
                a.controlls = a.controllContainer.find('span');
                a.arrowControlls = {
                    prev: a.arrowControllContainer.find('.ctrl_back'),
                    next: a.arrowControllContainer.find('.ctrl_fwd'),
                    play: a.arrowControllContainer.find('.ctrl_play'),
                    all: a.arrowControllContainer.find('span')
                };
                a.hideSidebar = $('<div class="hide_content_wrap"></div>').appendTo(a.arrowControllContainer);
                a.hideSidebar.append('<a class="hide_content no_scroll" href="#hide-content">' + a.options.hide + '</a>');
                a.options.imagecounter = a.options.imagecounter.replace(/-X-/, '<br/><span class="img_count_single">1</span>').replace(/-Y-/, '<span class="img_all_count">' + a.slideCount + '</span>');
                a.hideSidebar.append("<div class='img_count'>" + a.options.imagecounter + "</div>");
                a.imgCounter = a.hideSidebar.find('.img_count_single')
            },
            setSlides: function (a) {
                var b = this.data(h),
                    newIndex;
                if (!b.animatingNow) {
                    b.currentSlide = this.find(b.options.slides + ':visible');
                    b.currentSlideIndex = b.slides.index(b.currentSlide);
                    switch (a) {
                    case 'next':
                        newIndex = b.currentSlideIndex + 1 < b.slideCount ? b.currentSlideIndex + 1 : 0;
                        break;
                    case 'prev':
                        newIndex = b.currentSlideIndex - 1 >= 0 ? b.currentSlideIndex - 1 : b.slideCount - 1;
                        break;
                    default:
                        newIndex = a
                    }
                    b.nextSlide = this.find(b.options.slides + ':eq(' + newIndex + ')');
                    b.currentSlideIndex = newIndex;
                    if (b.nextSlide[0] == b.currentSlide[0]) b.skipTransition = true
                }
            },
            appendCaption: function () {
                var b = this.data(h),
                    description = false,
                    splitdesc = [];
                b.slides.each(function () {
                    var a = $(this);
                    description = a.find('img').attr('alt');
                    if (description) splitdesc = description.split('::');
                    if (splitdesc[0] != "") {
                        if (splitdesc[1] != undefined) {
                            description = "<strong>" + splitdesc[0] + "</strong>" + splitdesc[1]
                        } else {
                            description = splitdesc[0]
                        }
                    }
                    if (description) {
                        $('<span></span>').addClass(b.options.captionClass).html(description).css({
                            display: 'none',
                            'opacity': b.options.captionOpacity
                        }).appendTo(a)
                    }
                })
            },
            showCaption: function () {
                var a = this.data(h);
                a.allcaptions = this.find('.' + a.options.captionClass).css({
                    display: 'none'
                });
                var b = a.currentSlide.find('.' + a.options.captionClass).css({
                    display: 'block',
                    opacity: 0
                });
                b.animate({
                    opacity: a.options.captionOpacity
                })
            },
            fadeSlides: function () {
                var c = $(this),
                    data = this.data(h),
                    newInterval = false;
                if (data.imageUrls[data.currentSlideIndex]['status'] !== true) {
                    if (data.interval) {
                        data.skipAutorotate = true
                    }
                    methods.specialPreloader.apply(c, [data.currentSlideIndex,
                        function (a, b) {
                            methods.imagePreloaded.apply(c, [a, b]);
                            methods.switchSlides.apply(c);
                            data.skipAutorotate = false
                        }
                    ]);
                    return
                }
                data.imgCounter.html(data.currentSlideIndex + 1);
                data.thumbnailContainer.find('.active_thumb').removeClass('active_thumb');
                data.thumbnailContainer.find('.fullscreen_thumb:eq(' + data.currentSlideIndex + ')').addClass('active_thumb');
                if (!data.animatingNow && !data.skipTransition) {
                    methods.beforeSwitch.apply(c);
                    data.currentSlide.animate({
                        opacity: 0
                    }, data.options.animationSpeed, function () {
                        methods.switchComplete.apply(c)
                    });
                    if (data.options.appendcontrolls) data.controlls.removeClass('active_item').filter(':eq(' + data.currentSlideIndex + ')').addClass('active_item')
                }
                if (data.skipTransition) data.skipTransition = false
            },
            moveSlides: function () {
                var c = $(this),
                    data = this.data(h);
                if (data.imageUrls[data.currentSlideIndex]['status'] !== true) {
                    if (data.interval) {
                        data.skipAutorotate = true
                    }
                    methods.specialPreloader.apply(c, [data.currentSlideIndex,
                        function (a, b) {
                            methods.imagePreloaded.apply(c, [a, b]);
                            methods.switchSlides.apply(c);
                            data.skipAutorotate = false
                        }
                    ]);
                    return
                }
                data.imgCounter.html(data.currentSlideIndex + 1);
                data.thumbnailContainer.find('.active_thumb').removeClass('active_thumb');
                data.thumbnailContainer.find('.fullscreen_thumb:eq(' + data.currentSlideIndex + ')').addClass('active_thumb');
                if (!data.animatingNow && !data.skipTransition) {
                    methods.beforeSwitch.apply(c);
                    var d = data.slides.index(data.currentSlide),
                        indexNext = data.slides.index(data.nextSlide),
                        direction = 1,
                        positioning = -1;
                    movement = parseInt(c.width());
                    if (d < indexNext) direction = -1;
                    data.nextSlide.css({
                        opacity: 1,
                        left: ((movement * direction) * positioning)
                    }).animate({
                        left: 0
                    }, data.options.animationSpeed, data.options.defaultEasing);
                    data.currentSlide.animate({
                        left: (movement * direction)
                    }, data.options.animationSpeed, data.options.defaultEasing, function () {
                        methods.switchComplete.apply(c)
                    });
                    if (data.options.appendcontrolls) data.controlls.removeClass('active_item').filter(':eq(' + data.currentSlideIndex + ')').addClass('active_item')
                }
            },
            beforeSwitch: function () {
                var a = this.data(h);
                a.animatingNow = true;
                a.currentSlide.css({
                    zIndex: 3
                });
                a.nextSlide.css({
                    zIndex: 2,
                    display: 'block'
                });
                a.currentImage = a.nextSlide.find('img');
                a.currentImageRatio = a.currentImage.get(0).width / a.currentImage.get(0).height;
                if (a.currentImageRatio == 0 || a.currentImage.get(0).height == 0 || a.currentImage.get(0).width) {
                    a.currentImageRatio = a.currentImage.width() / a.currentImage.height()
                }
                a.switched = true;
                a.window.trigger('resize')
            },
            switchComplete: function () {
                var a = this.data(h);
                a.animatingNow = false;
                a.currentSlide.css({
                    zIndex: 2,
                    display: 'none',
                    opacity: 1
                });
                a.nextSlide.css({
                    zIndex: 3
                });
                a.currentSlide = a.nextSlide;
                methods.showCaption.apply(this)
            },
            transition: function (a, b) {
                var c = this.data(h);
                methods.setSlides.apply(this, [a]);
                if (c.options.transition == 'slide') {
                    methods.moveSlides.apply(this)
                } else {
                    methods.fadeSlides.apply(this)
                } if ('stop_autorotation' == b) {
                    methods.autorotationStop.apply(this)
                }
            },
            move_thumnails: function () {
                var a = this,
                    data = this.data(h),
                    outerContainer = $('.avia_fullscreen_slider_thumbs_outer_slide'),
                    slideContainer = $('.avia_fullscreen_slider_thumbs_inner_slide'),
                    outerWidth = outerContainer.width(),
                    innerWidth = slideContainer.width(),
                    newpos = outerWidth - parseInt(slideContainer.css('left'), 10),
                    thumbspace = data.thumbnails.outerWidth() + parseInt(data.thumbnails.css('margin-right'), 10);
                if (thumbspace < 20) thumbspace = 60;
                newpos = newpos - (newpos % thumbspace);
                if (newpos >= innerWidth) newpos = 0;
                if (outerWidth < innerWidth) {
                    slideContainer.animate({
                        left: '-' + newpos + "px"
                    }, 1000, "easeInOutQuint")
                }
            },
            bindEvents: function () {
                if (jQuery.fn.avia_hide_sidebar_content) jQuery('body').avia_hide_sidebar_content();
                var b = this,
                    data = this.data(h);
                data.window.resize(function () {
                    methods.resizeBg.apply(b)
                });
                this.find('a').bind('click.' + h, function () {
                    methods.autorotationStop.apply(b)
                });
                data.slides.bind('click.' + h, function () {
                    var a = $(this);
                    if (a.is('.comboslide')) {
                        methods.showvideo.apply(b, [a]);
                        methods.autorotationStop.apply(b);
                        return false
                    }
                });
                data.slides.filter('.comboslide, .videoslide').hover(function () {
                    $(this).find('.slideshow_caption').stop().animate({
                        opacity: 0
                    })
                }, function () {
                    $(this).find('.slideshow_caption').stop().animate({
                        opacity: 1
                    })
                });
                if (data.thumbnailContainer.length) {
                    data.thumbnails.click(function () {
                        if ($(this).is('.active_thumb')) return;
                        var a = data.thumbnails.index(this);
                        methods.transition.apply(b, [a, 'stop_autorotation']);
                        return false
                    });
                    var c = $('.slide_thumbnails', data.thumbnailContainer),
                        thumbspace = data.thumbnails.outerWidth() + parseInt(data.thumbnails.css('margin-right'), 10),
                        slideContainer = $('.avia_fullscreen_slider_thumbs_inner_slide');
                    if (thumbspace < 20) thumbspace = 60;
                    newWidth = thumbspace * data.thumbnails.length;
                    slideContainer.width(newWidth);
                    c.click(function () {
                        methods.move_thumnails.apply(b);
                        return false
                    });
                    var d;
                    data.window.resize(function () {
                        clearTimeout(d);
                        d = setTimeout(function () {
                            var a = $('.avia_fullscreen_slider_thumbs_outer_slide');
                            if (a.width() > slideContainer.width()) {
                                c.filter(':visible').fadeOut();
                                slideContainer.animate({
                                    left: "0px"
                                })
                            } else {
                                c.not(':visible').fadeIn()
                            }
                        }, 400)
                    })
                }
                if (data.controlls && data.controlls.length) {
                    data.controlls.bind('click.' + h, function () {
                        var a = this.hash.substr(1);
                        methods.transition.apply(b, [a, 'stop_autorotation']);
                        return false
                    })
                }
                if (data.arrowControlls && data.arrowControlls.next.length) {
                    data.arrowControlls.next.bind('click.' + h, function () {
                        methods.transition.apply(b, ['next', 'stop_autorotation']);
                        return false
                    });
                    data.arrowControlls.prev.bind('click.' + h, function () {
                        methods.transition.apply(b, ['prev', 'stop_autorotation']);
                        return false
                    });
                    data.arrowControlls.play.bind('click.' + h, function () {
                        methods.switchAutorotation.apply(b);
                        return false
                    });
                    if (data.options.hideArrows) {
                        data.arrowControlls.all.css({
                            opacity: 0
                        });
                        b.parent('.slideshow_container').hover(function () {
                            data.arrowControlls.all.stop().animate({
                                'opacity': 1
                            })
                        }, function (a) {
                            if (!$(a.relatedTarget).is('.ctrl_arrow')) {
                                data.arrowControlls.all.stop().animate({
                                    'opacity': 0
                                })
                            }
                        })
                    }
                }
                if (data.is_iOS && !data.is_iOS_5) {
                    data.window.resize(function () {
                        b.width(data.window.width()).height(data.window.height()).css({
                            position: 'absolute'
                        })
                    });
                    data.window.scroll(function () {
                        b.css({
                            top: data.window.scrollTop()
                        })
                    })
                }
            },
            showvideo: function (a) {
                var b = this.data(h);
                a.find('img, canvas, .slideshow_overlay, .' + b.options.captionClass).stop().fadeOut();
                a.find('.slideshow_video').stop().fadeIn()
            },
            overwrite_options: function () {
                var a = this.data(h),
                    optionsWrapper = this,
                    htmlData = optionsWrapper.data(),
                    i = "";
                for (i in htmlData) {
                    if (typeof htmlData[i] == "string" || typeof htmlData[i] == "number" || typeof htmlData[i] == "boolean") {
                        a.options[i] = htmlData[i]
                    }
                }
            }
        };
    $.fn.avia_fullscreen_slider = function (b) {
        return this.each(function () {
            var a = $(this),
                data = {}, defaults = {
                    slides: 'li',
                    animationSpeed: 700,
                    autorotation: "true",
                    autorotationspeed: 3,
                    appendcontrolls: true,
                    appendCaption: true,
                    captionOpacity: 0.8,
                    hideArrows: false,
                    resizeSlider: false,
                    defaultEasing: 'easeInOutExpo',
                    captionClass: 'slideshow_caption',
                    transition: 'fade',
                    cropping: true
                };
            data.options = $.extend(defaults, b);
            data.slides = a.find(data.options.slides).css({
                display: 'none'
            });
            data.slideCount = data.slides.length;
            data.currentSlide = a.find(data.options.slides + ':eq(0)').css({
                display: 'block'
            });
            data.nextSlide = a.find(data.options.slides + ':eq(1)');
            data.interval = false;
            data.animatingNow = true;
            data.imageUrls = [];
            data.window = $(window);
            data.thumbnailContainer = $('.avia_fullscreen_slider_thumbs');
            data.thumbnails = data.thumbnailContainer.find('.fullscreen_thumb');
            data.useCanvas = false;
            data.is_iOS = navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/);
            data.is_iOS_5 = navigator.userAgent.toLowerCase().match(/(5_)/);
            if (document.createElement('canvas').getContext) {
                data.useCanvas = true
            }
            data.slides.each(function (i) {
                data.imageUrls[i] = [];
                data.imageUrls[i]['url'] = $(this).data("image");
                data.imageUrls[i]['status'] = false
            });
            a.data(h, data);
            methods.overwrite_options.apply(a);
            methods.init.apply(a)
        })
    }
})(jQuery);





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
				
					sidebars.each(function(i)
					{
						var isMobile 			= 'ontouchstart' in document.documentElement,
							current 			= $(this),
							sidebar_inner		= $('.inner_sidebar', this),
							sb_offset			= sidebar_inner.offset(),
							sb_check_val		= sidebar_inner.height() + sb_offset.top + 66,
							cont				= $('.arrowslidecontrolls_fullscreen'),
							mini				= $('.entry-mini'); 
						
						if(isMobile) mini.addClass('entry-mini-fixed');
						
						if(!current.is('.sidebar_absolute')) sb_check_val = sb_check_val - win.scrollTop();
										
						if(sb_check_val > win.height() || isMobile) 
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
				
					sidebars.each(function(i)
					{
						var isMobile 			= 'ontouchstart' in document.documentElement,
							current 			= $(this),
							sidebar_inner		= $('.inner_sidebar', this),
							sb_offset			= sidebar_inner.offset(),
							sb_check_val		= sidebar_inner.height() + sb_offset.top + 66,
							cont				= $('.arrowslidecontrolls_fullscreen'),
							mini				= $('.entry-mini'); 
						
						if(isMobile) mini.addClass('entry-mini-fixed');
						
						if(!current.is('.sidebar_absolute')) sb_check_val = sb_check_val - win.scrollTop();
										
						if(sb_check_val > win.height() || isMobile) 
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
