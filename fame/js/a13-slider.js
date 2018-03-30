/*
	Inspired by	: Supersized www.buildinternet.com/project/supersized
*/
var A13_slider_debug = false;

/*global Modernizr, A13, addTouchEvent, debounce, YT, $f, _V_ */
(function($){
    "use strict";

    $.a13slider = function(options){
        // Default Options
        var defaultOptions = {

            // Functionality
            parent                  :   document.body, //where will be embeded main element
            autoplay                :   1,             // Slideshow starts playing automatically
            slide_interval          :   5000,          // Length between transitions
            transition              :   1,             // 0-None, 1-Fade, 2-Carousel
            transition_speed        :   750,           // Speed of transition

            // Size & Position
            //Always: Image will never exceed browser width or height (Ignores min. dimensions)
            //Landscape: Landscape images will not exceed browser width
            //Portrait: Portrait images will not exceed browser height
            //When Needed: Best for small images that shouldn't be stretched
            fit_variant             :   0,             // 0-always, 1-landscape, 2-portrait, 3-when_needed
            horizontal_center       :   1,             // Horizontally center background
            vertical_center         :   1,             // Vertically center background

            // Components
            slide_links             :   'num',         // Individual links for each slide (Options: false, 'num', 'name', 'blank')
            progress_bar            :   1,             // Timer for each slide
            slides                  :   {}             //here we will send slides with JSON format
        };


        /* Global Variables
         ----------------------------*/
        var album = this,
            vo          = $.extend({},defaultOptions, options), //options of slide show
            $parent     = $(vo.parent),
            slides      = vo.slides,        //params of each slide
            slides_num  = slides.length,    //number of slides
            all_slides  = {},               //$el.find('li')
            $load_item  = {},               //items that will fade in when ready
            $el         = {},               //our main element
            fit_variant = vo.fit_variant,

            slide_id_pre    = 'ss-slide-',
            p_bar_enabled   = vo.progress_bar,
            slide_links     = vo.slide_links,
            slideshow_interval_time = vo.slide_interval,

            //Minor animation times
            minorShowTime = 300,
            minorHideTime = 200,

            // Elements
            play_button,    // Play/Pause button
            next_slide,     // Next slide button
            prev_slide,     // Prev slide button
            slide_list,     // Slide link list($)
            slide_list_li,  // Slide link children(<li>)
            slide_caption,  // Slide title
            progress_bar,

            // Internal variables
            current_slide           =   0,          // Current slide number
            theme_loaded            =   false,
            in_animation            =   false,      // Prevents animations from stacking
            is_paused               =   false,      // Tracks paused on/off
            is_video_playing        =   false,      // Tracks paused on/off
            slideshow_interval_id   =   false,      // Stores slideshow timer
            progress_delay          =   false,      // Delay after resize before resuming slideshow
            update_images           =   false,      // Trigger to update images after slide jump
            loadYouTubeAPI          =   false,      // Bool if YT API should load
            loadVimeoAPI            =   false,      // Bool if Vimeo API should load
            loadNativeVideoAPI      =   false,      // Bool if Native Video API should load
            videos                  =   {} ,        // videos from options

            isTouch = Modernizr.touch,
            hidden  = {                             //css for hidden elements
                opacity : 1,
                visibility : 'hidden',
                left: '-100%'
            },

            /***** small helpers functions *****/
            clean_prev_slide = function(slide){
                slide.css(hidden);
            },
            
            getField = function(field){
                return (typeof slides[current_slide][field] === 'undefined')? "" : slides[current_slide][field];
            };


        /* Calls functions in order
         ----------------------------*/
        album.start = function(){
            album.prepareEnv();
            album.prepareSlides();
        };

        /* Prepares Vars and HTML
		----------------------------*/
        album.prepareEnv = function(){
            // Add in slide markers
            var thisSlide = 0,
                slideSet = '',
				markers = '',
				markerContent,
                ts; //this slide from array


            ts = slides[thisSlide];
            //collect slides
			while(thisSlide <= slides_num-1){
				//Determine slide link content
				switch(slide_links){
					case 'num':
						markerContent = thisSlide+1;
						break;
					case 'name':
						markerContent = ts.title;
						break;
					case 'blank':
						markerContent = '';
						break;
				}

				slideSet = slideSet+'<li id="'+slide_id_pre+thisSlide+'" class="slide-'+thisSlide+'"></li>';

                //collect video info
                if(ts.type === 'video'){
                    //check which API is needed
                    if(ts.movie_type === 'youtube' && loadYouTubeAPI !== 'loaded'){
                        loadYouTubeAPI = true;
                    }
                    else if(ts.movie_type === 'vimeo' && loadVimeoAPI !== 'loaded'){
                        loadVimeoAPI = true;
                    }
                    else if(ts.movie_type === 'html5' && loadNativeVideoAPI !== 'loaded'){
                        loadNativeVideoAPI = true;
                    }

                    //copy video details
                    videos[slide_id_pre+thisSlide] = ts;
                }

                // Slide links
                if (slide_links){
                    markers += '<li class="slide-link-'+thisSlide + (thisSlide === 0 ? ' current-slide' : '') + '">'+
                               '<a>'+markerContent+'</a></li>';
                }

				thisSlide++;
                ts = slides[thisSlide];
			}

            album.loadVideoApi();

            //Place Elements
            A13.addLoader($parent);

            $parent.append('' +
                '<ul id="a13-slider"></ul>' +
                '<span id="prevslide" class="slider-arrow load-item" /><span id="nextslide" class="slider-arrow load-item" />' +
                '<div id="a13-slider-caption"><div class="title"></div><div class="desc"></div></div>' +
                '<span id="play-button" />' +
                '<div id="progress-back"><div id="progress-bar" /></div>' +
                '');

            $el = $('#a13-slider');
            //append ready html
			if (slide_links){
                if(slides_num > 1 ){
                    $parent.append('<ul id="slide-list" class="load-item">'+markers+'</ul>');
                }
                //fill vars
                slide_list      = $('#slide-list');
                slide_list_li   = slide_list.children();
            }

			$el.append(slideSet);
            //fill vars
            all_slides      = $el.find('li').css(hidden); //hide all slides also
            play_button     = $('#play-button');
            next_slide		= $('#nextslide');
            prev_slide		= $('#prevslide');
            progress_bar	= $('#progress-bar');
            slide_caption	= $('#a13-slider-caption');
        };


        /* Load first visible items and runs start slider as callback
		----------------------------*/
        album.prepareSlides = function(){
            //load prev
			if (slides_num > 2){
                album.fillSlide(slides_num - 1, 'prevslide');
			}

			// Set current image
            album.fillSlide(current_slide, 'activeslide', 1);

            //load next
            if (slides_num > 1){
                // Set next image
                album.fillSlide(current_slide + 1);
            }
        };


        /* Loads and sets other elements needed for interaction with slider
         ----------------------------*/
        album.loadTheme = function(){
            if(theme_loaded){
                return;
            }
            theme_loaded = true;

            //hide arrows if not needed
            if (slides_num < 2){
                next_slide.add(prev_slide).remove();
            }

            // Hide elements to be faded in on load
            $el.css('visibility','hidden');
            $load_item = $parent.find('.load-item');
            $load_item.hide();
        };


        /* Launch Slider
         ----------------------------*/
        album.launch = function(){
            $el.css('visibility','visible');

            //IE 8 has problems with proper order of functions...
            if(!($load_item instanceof jQuery)){
                album.loadTheme();
            }

            //Hide loading animation
            A13.removeLoader();

            // Call function for before slide transition
            album.beforeAnimation('next', true);
            $load_item.css('visibility', 'visible').fadeIn(minorShowTime);
            album.events();

            // Start slide show if auto-play enabled
            if(vo.autoplay && slides_num > 1){
                slideshow_interval_id = setTimeout(album.nextSlide, slideshow_interval_time);	// Initiate slide interval
                album.playToggle2('play');
            }
            else{

                album.playToggle2('pause');
                is_paused = true;	// Mark as paused
            }
        };


        /* Bind events
         ----------------------------*/
        album.events = function(){
            // Keyboard Navigation
            $(document.documentElement).keyup(function (event) {
                if(in_animation){ return false;	}	// Abort if currently animating

                var key = event.keyCode;

                // Left Arrow or Down Arrow
                if ((key === 37) || (key === 40)){
                    clearTimeout(slideshow_interval_id);	// Stop slideshow, prevent buildup
                    album.prevSlide();

                    // Right Arrow or Up Arrow
                } else if ((key === 39) || (key === 38)) {
                    clearTimeout(slideshow_interval_id);	// Stop slideshow, prevent buildup
                    album.nextSlide();

                    // Spacebar
                } else if (key === 32) {
                    clearTimeout(slideshow_interval_id);	// Stop slideshow, prevent buildup
                    album.playToggle();
                }

                return true;
            });

            next_slide.click(album.nextSlide);
            prev_slide.click(album.prevSlide);
            play_button.click(album.playToggle);
            $el.on('click', 'li',{}, function(){
                album.playToggle();
            });

            //Touch event(changing slides)
            if(isTouch && slides_num > 1){
                addTouchEvent($el[0], {
                    right: album.prevSlide,
                    left: album.nextSlide
                });
            }

            if (slide_links){
                // Slide marker clicked
                slide_list_li.click(function(e){
                    e.preventDefault();

                    album.goTo(slide_list_li.index(this));
                });
            }


            // Adjust image when browser is resized
            $(window).resize(debounce(function(){
                album.resizeNow();

                // Delay progress bar on resize
                if (p_bar_enabled && !in_animation && !is_video_playing){
                    album.progressBarStop();

                    if (slideshow_interval_id || (slides_num - 1 > 0)){
                        clearTimeout(slideshow_interval_id);
                    }

                    if (!progress_delay){
                        // Delay slideshow from resuming so Chrome can refocus images
                        progress_delay = setTimeout(function() {
                            if (!is_paused){
                                album.progressBar();
                                slideshow_interval_id = setTimeout(album.nextSlide, slideshow_interval_time);
                            }
                            progress_delay = false;
                        }, 1000);
                    }
                }

            }, 250));

        };


        /* Loads APIs for Video types
         ----------------------------*/
        album.loadVideoApi = function(){
            //load Youtube API
            if(loadYouTubeAPI === true){
                //this function will run when YT API will load
                window.onYouTubeIframeAPIReady = function() {
                    if(A13_slider_debug){ console.log('Youtube Api ready!'); }
                    album.YT_ready(true);
                };

                //load YT API
                (function(){
                    var tag = document.createElement('script');
                    tag.src = "//www.youtube.com/iframe_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                })();

            }

            //load Vimeo API
            if(loadVimeoAPI === true){
                //load VIMEO API
                (function(){
                    var tag = document.createElement('script');
                    tag.src = "http://a.vimeocdn.com/js/froogaloop2.min.js";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                })();
            }

            //load native video API
            if(loadNativeVideoAPI === true){
                //load VideoJS API
                (function(){
                    var tag = document.createElement('script');
                    tag.src = "http://vjs.zencdn.net/c/video.js";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                })();
            }
        };

        /* Define YT_ready function.
         ----------------------------*/
        album.YT_ready = (function(){
            var onReady_funcs = [], api_isReady = false;
            /* @param func function     Function to execute on ready
             * @param func Boolean      If true, all queued functions are executed
             * @param b_before Boolean  If true, the func will added to the first
             position in the queue*/
            return function(func, b_before){
                if (func === true) {
                    api_isReady = true;
                    for (var i=0; i<onReady_funcs.length; i++){
                        // Removes the first func from the array, and execute func
                        onReady_funcs.shift()();
                    }
                }
                else if(typeof func === "function") {
                    if (api_isReady){ func(); }
                    else { onReady_funcs[b_before?"unshift":"push"](func); }
                }
            };
        })();

        /* Init player so it can be manipulated by API
         ----------------------------*/
        album.initPlayer = function(playerId, onReady){
            var current = videos[playerId],
                frame = $el.find('#'+playerId).find('iframe').get(0);

            //if player is initialized already
            if(typeof current.player !== 'undefined'){
                return;
            }

            if(typeof onReady !== 'function'){
                //empty function
                onReady = function(){};
            }

            if(A13_slider_debug){ console.log('init player', playerId, onReady.toString(), current.movie_type); }

            if(current.movie_type === 'youtube'){
                //cause youTube iframe API breaks on firefox when using iframes
                //we will grab parameters and then switch iframe with div with same id
                var elem    = $el.find('#'+playerId).find('div'),
                    vid_id  = elem.data('vid_id'),
                    width   = elem.data('width'),
                    height  = elem.data('height');

                current.player = new YT.Player(elem.get(0), {
                    height: height,
                    width: width,
                    videoId: vid_id,
                    playerVars : {wmode: 'transparent'},
                    events: {
                        'onReady'       : onReady,
                        'onStateChange' : album.videoStateChange
                    }
                });
            }

            else if(current.movie_type === 'vimeo'){
                if(typeof $f !== 'undefined'){
                    current.player = $f(frame);
                    current.player.addEvent('ready', function() {
                        current.player.addEvent('pause', function(){ album.videoStateChange(2); });
                        current.player.addEvent('play', function(){ album.videoStateChange(1, playerId); });
                        current.player.addEvent('finish', function(){ album.videoStateChange(0); });

                        onReady();
                    });
                }
                else{
                    if(A13_slider_debug){ console.log('Vimeo API NOT loaded!'); }
                    //try again after 0.5s
                    setTimeout(function(){ album.initPlayer(playerId, onReady); }, 500);
                }
            }

            else if(current.movie_type === 'html5'){
                if(typeof _V_ !== 'undefined'){

                    var vid = $(frame).contents().find('#example_video_1');

                    current.player = _V_(vid.get(0));
                    current.player.ready(function(){
                        current.player.on('pause', function(){ album.videoStateChange(2); });
                        current.player.on('play', function(){ album.videoStateChange(1); });
                        current.player.on('ended', function(){ album.videoStateChange(0); });

                        //resize video to full size
                        vid.css({
                            height : '100%',
                            width  : '100%'
                        });

                        onReady();
                    });
                }
                else{
                    if(A13_slider_debug){ console.log('HTML5 Video API NOT loaded!'); }
                    //try again after 0.5s
                    setTimeout(function(){ album.initPlayer(playerId, onReady); }, 500);
                }
            }
        };

        /* Plays Video
         ----------------------------*/
        album.playVideo = function(){
            var playerId = slide_id_pre+current_slide,
                current = videos[playerId],
                type;
            if(A13_slider_debug){ console.log('play video', playerId, 'no type yet'); }

            //if no such player
            if(typeof current === 'undefined'){
                return;
            }
            type = current.movie_type;
            if(A13_slider_debug){ console.log('play video', playerId, type); }

            //helper function
            var play = function(){
                if(type === 'youtube'){ current.player.playVideo(); }
                else if(type === 'vimeo'){ current.player.api('play'); }
                else if(type === 'html5'){ current.player.play(); }
            };

            //player not initialized yet
            if(typeof current.player === 'undefined'){
                //helper function
                var init = function(){
                    album.initPlayer(playerId, function(){ play(); } );
                };

                if(type === 'youtube'){ album.YT_ready( function(){ init(); }); }
                else if(type === 'vimeo'){ init(); }
                else if(type === 'html5'){ init(); }
            }
            else{
                play();
            }
        };

        /* Stops playing video
         ----------------------------*/
        album.pauseVideo = function(playerId){
            if(typeof playerId === 'undefined'){
                playerId = slide_id_pre+current_slide;
            }
            var current = videos[playerId],
//                player = '',
                type;

            //if no such player
            if(typeof current === 'undefined'){
                return;
            }

            type = current.movie_type;

            if(A13_slider_debug){ console.log('pause video', playerId, type); }

            //helper function
            var pause = function(){
                if(type === 'youtube' && typeof current.player !== 'undefined' && typeof current.player.pauseVideo !== 'undefined'){ current.player.pauseVideo(); }
                else if(type === 'vimeo' && typeof current.player !== 'undefined' && typeof current.player.api !== 'undefined'){ current.player.api('pause'); }
                else if(type === 'html5' && typeof current.player !== 'undefined' && typeof current.player.pause !== 'undefined'){ current.player.pause(); }
            };

            //player not initialized yet
            if(typeof current.player === 'undefined'){
                //helper function
                var init = function(){
                    album.initPlayer(playerId, function(){ pause(); } );
                };

                if(type === 'youtube'){ album.YT_ready( function(){ init(); }); }
                else if(type === 'vimeo'){ init(); }
                else if(type === 'html5'){ init(); }
            }
            else{
                pause();
            }
        };

        /* Video events handling
         ----------------------------*/
        album.videoStateChange = function(event, playerId){
            /*
            * VIMEO & VideoJS change returns number
            * Youtube change returns event object
            * */
            var state = event;

            if(typeof state === 'object'){
                state = event.data;
            }

            if(A13_slider_debug){ console.log('player state: ' + state, typeof event, playerId); }

            //if playing
            if(state === 1){
                //protection for auto playing vimeo video after YT player initialization
                //it may play when it is not visible
                //only vimeo video return playerId on state change
                if(typeof playerId !== 'undefined' && playerId !== slide_id_pre+current_slide){
                    videos[playerId].player.api('pause');
                    return;
                }

                //stops slide show things on video playback
                album.stoppu();
                is_video_playing = true;
            }
            //if video ended and slide show is not paused
            else{
                is_video_playing = false;

                if(state === 0 && !is_paused){
                    album.nextSlide();
                }
            }
        };


        /* Resize Images
          ----------------------------*/
		album.resizeNow = function(image){
            var elem = (typeof image === 'undefined')? $el.find('img') : $(image);

            //  Resize each image
            elem.each(function(){
                var thisSlide = $(this),
                    orgH  = thisSlide.data('origHeight'),
                    orgW  = thisSlide.data('origWidth'),
                    ratio = (orgH/orgW).toFixed(2),	// Define image ratio

                    // Gather browser size
                    browserwidth    = $el.width(),
                    browserheight   = $el.height(),
                    fit_always      = fit_variant === 0,
                    fit_landscape   = fit_variant === 1,
                    fit_portrait    = fit_variant === 2,
                    fit_when_needed = fit_variant === 3,

                    resizeWidth = function(){
                        thisSlide.width(browserwidth);
                        thisSlide.height(browserwidth * ratio);
                    },

                    resizeHeight = function(){
                        thisSlide.height(browserheight);
                        thisSlide.width(browserheight / ratio);
                    };

                /*-----Resize Image-----*/
                if (fit_when_needed){
                    //reset
                    thisSlide.css({
                        width: orgW,
                        height: orgH
                    });

                    if( orgH > browserheight || orgW > browserwidth){
                        if ((browserheight/browserwidth) > ratio){
                            resizeWidth();
                        } else {
                            resizeHeight();
                        }
                    }
                }
                else if (fit_always){
                    if ((browserheight/browserwidth) > ratio){
                        resizeWidth();
                    } else {
                        resizeHeight();
                    }
                }
                else{	// Normal Resize
                    if ((browserheight/browserwidth) > ratio){
                        // If landscapes are set to fit
                        if(fit_landscape && ratio < 1){
                            resizeWidth();
                        }
                        else{
                            resizeHeight();
                        }
                    } else {
                        // If portraits are set to fit
                        if(fit_portrait && ratio >= 1){
                            resizeHeight();
                        }else{
                            resizeWidth();
                        }
                    }
                }
                /*-----End Image Resize-----*/

                // Horizontally Center
                if (vo.horizontal_center){
                    thisSlide.css('left', (browserwidth - thisSlide.width())/2);
                }

                // Vertically Center
                if (vo.vertical_center){
                    thisSlide.css('top', (browserheight - thisSlide.height())/2);
                }

            });
		};


        /* Filling empty slides when need
         ----------------------------*/
        album.fillSlide = function(loadSlide, bonusClass, firstSlide){
            var targetSlide = all_slides.eq(loadSlide),
                slide_type  = slides[loadSlide].type,
                addClass    = (typeof bonusClass !== 'undefined'),
                first       = (typeof firstSlide !== 'undefined'),
                imageLink, item;

            //if slide is empty
            if (!targetSlide.html()){
                if(slide_type === 'image'){
                    imageLink = (slides[loadSlide].url) ? "href='" + slides[loadSlide].url + "'" : "";	// If link exists, build it
                    item = $('<img src="" />');

                    //add classes to li
                    targetSlide.addClass('image-loading' + (addClass? ' '+bonusClass : '')).css(hidden);

                    item
                        .appendTo(targetSlide).wrap('<a ' + imageLink + '></a>')
                        .load(function(){
                            album._origDim($(this));
                            album.resizeNow(this);
                            targetSlide.removeClass('image-loading');
                            item.hide().fadeIn(minorShowTime);
                            if(first){album.launch();}
                        })
                        .attr('src', slides[loadSlide].image);

                    if(first){album.loadTheme();}
                }
                else if(slide_type === 'video'){
                    targetSlide
                        .addClass('image-loading' + (addClass? ' '+bonusClass : ''))
                        .css(hidden)
                        .append('<iframe src="'+slides[loadSlide].image+'" />');


                    if(slides[loadSlide].movie_type === 'youtube'){
                        //cause youTube iframe API breaks on firefox when using iframes
                        //we will grab parameters and then switch iframe with div with same id
                        var frame = targetSlide.find('iframe'),
                            vid_id = frame.attr('src'),
                            width = frame.width(),
                            height = frame.height(),
                            temp;

                        //search for video id
                        temp = /embed\/([a-zA-Z0-9\-_]+)\??/ig.exec(vid_id);
                        if(temp !== null && temp.length === 2){
                            vid_id = temp[1];
                        }

                        //insert empty div & remove old iframe
                        $('<div/>',{
                            'data-vid_id': vid_id,
                            'data-width': width,
                            'data-height': height
                        }).insertBefore(frame);
                        frame.remove();
                    }

                    if(first){
                        album.loadTheme();
                        album.launch();

                        //if first slide is video with autoplay enabled
                        if(slide_type === 'video'){
                            if(getField('autoplay')){
                                //stop things(interval, progress bar)
                                album.stoppu();
                                //play video
                                album.afterAnimation();
                            }
                            else{
                                album.pauseVideo();//need for YT video if it is first slide
                            }
                        }

                    }
                }

                if(first){ targetSlide.attr('style',''); } //clear init hide for first slide
            }
        };


        /* Change Slide
		----------------------------*/
		album.changeSlide = function(isPrev){
            if(typeof isPrev === 'undefined'){ isPrev = false; }

			// Abort if currently animating
			if(in_animation){ return false; }
            // Otherwise set animation marker
            else{ in_animation = true; }

            clearTimeout(slideshow_interval_id);

            // Find active slide
			var	oldSlide = all_slides.filter('.activeslide'),
                speed = vo.transition_speed;

            if(oldSlide){
                //pause playing video
                album.pauseVideo(oldSlide.attr('id'));
            }

			// Get the slide number of new slide
            if(isPrev){
                current_slide = current_slide <= 0 ?  slides_num - 1 : current_slide-1 ;
            }
            else{
                current_slide = current_slide + 1 === slides_num ? 0 : current_slide+1;
            }

            //clean old prev slide
            all_slides.filter('.prevslide').removeClass('prevslide');
            // Remove active class & update previous slide
            oldSlide.removeClass('activeslide').addClass('prevslide');

            var afterCB = function(){ clean_prev_slide(oldSlide);},
                nowSlide = all_slides.eq(current_slide),
                loadNextSlide = (current_slide === slides_num - 1) ? 0 : current_slide + 1,	// Determine next slide for preload;
                loadPrevSlide = (current_slide === 0) ? slides_num - 1 : current_slide - 1;	// Determine next slide for preload;

            //if slide was not filled yet
            album.fillSlide(loadNextSlide);
            album.fillSlide(loadPrevSlide);


			// Call function for before slide transition
			album.beforeAnimation( isPrev? 'prev' : 'next' );

			//Update slide markers
			if (slide_links){
                slide_list_li.filter('.current-slide').removeClass('current-slide');
                slide_list_li.eq(current_slide).addClass('current-slide');
			}

           nowSlide.css({visibility:'hidden'}).addClass('activeslide');	// Update active slide

            switch(vo.transition){
                case 0:	// No transition
                    nowSlide.css({visibility:'visible', left: ''}); in_animation = false; afterCB(); album.afterAnimation();
                    break;
                case 1:	// Fade
                    nowSlide.css({ visibility : 'visible', opacity : 0, left: ''}).animate({opacity : 1}, speed, album.afterAnimation);
                    oldSlide.animate({opacity : 0}, speed, afterCB);
                    break;
                case 2:	// Carousel
                    nowSlide.css({ visibility : 'visible', left : (isPrev? -$el.width() : $el.width())}).animate({left:0}, speed, album.afterAnimation);
                    if(isPrev){
                        oldSlide.css({left : 0}).animate({left: $el.width()}, speed, afterCB );
                    }
                    else{
                        oldSlide.animate({left: -$el.width()}, speed, afterCB );
                    }
                    break;
            }

            return false;
		};

        album.prevSlide = function(){
            if (slides_num > 1){
                album.changeSlide(true);
            }
        };

        album.nextSlide = function(){
            if (slides_num > 1){
                album.changeSlide();
            }
        };


		/* Play/Pause Toggle
		* Calls
		----------------------------*/
        album.playToggle = function(){
            if (in_animation || slides_num < 2){ return false; }		// Abort if currently animating

            if (is_paused){

                is_paused = false;

                album.playToggle2('play');

                // Resume slideshow
                slideshow_interval_id = setTimeout(album.nextSlide, slideshow_interval_time);

            }
            else{

                is_paused = true;

                album.playToggle2('pause');

                clearTimeout(slideshow_interval_id);

            }

            return false;

        };

        /* support for video */
        album.playToggle2 = function(state, forVideoPlayback){
            //paused for video playback
            if(typeof forVideoPlayback !== 'undefined' && forVideoPlayback === true){
                //just clear progress bar
                if (state === 'play'){
                    if(p_bar_enabled){
                        album.progressBar();
                    }
                }
                else if (state === 'pause'){
                    if(p_bar_enabled){
                        album.progressBarStop();
                    }
                }

                return;
            }



            var big_play = $('#big-play'),
                current = all_slides.eq(current_slide);

            if(!big_play.length){
                big_play = $('<div id="big-play" />');
            }

            //no big play above videos to not confuse anyone
            if(getField('type') !== 'video'){
                big_play.appendTo(current);
            }

            if (state === 'play'){
                play_button.addClass(state).removeClass('pause').text(play_button.data('pause'));
                big_play.addClass(state).removeClass('pause');

                if(p_bar_enabled){
                    album.progressBar();
                }
            }
            else if (state === 'pause'){
                play_button.addClass(state).removeClass('play').text(play_button.data('play'));
                big_play.addClass(state).removeClass('play');

                if(p_bar_enabled){
                    album.progressBarStop();
                }
            }

            if(big_play.parent().length){
                big_play.attr('style','').animate({
                    height : big_play.height() * 1.5,
                    width : big_play.width() * 1.5,
                    marginLeft: parseInt(big_play.css('margin-left'), 10) * 1.5,
                    marginTop: parseInt(big_play.css('margin-top'), 10) * 1.5,
                    opacity: 0
                }, 400, function(){ big_play.hide(); });
            }
        };


        /* stops slide show things on video playback
		----------------------------*/
        album.stoppu = function(){
            album.playToggle2('pause', true);

            clearTimeout(slideshow_interval_id);
        };


        /* Go to specific slide
		----------------------------*/
        album.goTo = function(targetSlide){
			if (in_animation){return;}		// Abort if currently animating

			// If target outside range
			if(targetSlide < 0){
				targetSlide = 0;
			}
            else if(targetSlide > slides_num-1){
				targetSlide = slides_num - 1;
			}

			if (current_slide === targetSlide){return;}

            album.fillSlide(targetSlide);
            update_images = 1;
			// If ahead of current position
			if(current_slide < targetSlide){
				// Adjust for new next slide
				current_slide = targetSlide-1; //need to go step back
                album.nextSlide();
			}
			//Otherwise it's before current position
            else if(current_slide > targetSlide){
				// Adjust for new prev slide
				current_slide = targetSlide+1; //need to go step forward
                album.prevSlide();
			}
		};


		/* Save Original Dimensions of images
		----------------------------*/
		album._origDim = function(targetSlide){
			targetSlide.data('origWidth', targetSlide.width()).data('origHeight', targetSlide.height());
		};


		album.afterAnimation = function(){
			// Update previous slide
            //MAY NOT BE NEEDED
			if (update_images){
                var setPrev = (current_slide - 1 < 0) ? slides_num - 1 : current_slide-1;
				update_images = false;
				all_slides.filter('.prevslide').removeClass('prevslide');
				all_slides.eq(setPrev).addClass('prevslide');
			}

			in_animation = false;

            //if current slide is video with auto-play option
            if(getField('type') === 'video' && getField('autoplay')){

                //play video
                album.playVideo();
            }
            else{
                //if current slide is video initialize API
                if(getField('type') === 'video'){
                    album.initPlayer(slide_id_pre+current_slide);
                }

                // Resume slideshow
                if (!is_paused){
                    slideshow_interval_id = setTimeout(album.nextSlide, slideshow_interval_time);
                }
            }

            if (p_bar_enabled && !is_paused){
                if(getField('type') === 'video' && getField('autoplay')){
                    //don't show progress bar if video has autoplay
                    return;
                }

                album.progressBar();
            }
		};

        album.beforeAnimation = function(direction, firstRun){
            var title       = getField('title'),
                desc        = getField('desc'),
                bg_color    = getField('bg_color'),
                div_title   = slide_caption.find('div.title'),
                div_desc    = slide_caption.find('div.desc'),
                now_big     = all_slides.eq(current_slide),
                showTime    = minorShowTime, //cause we overwrite this
                hideTime    = minorHideTime; //cause we overwrite this

            //photo bg color
            now_big.css('background-color', bg_color);

            if(p_bar_enabled){
                album.progressBarStop();
            }

            if(firstRun){
                showTime = 0;
                hideTime = 0;
            }

            //add caption
            if (title.length || desc.length){
                div_title.html(title);
                div_desc.html(desc);
                slide_caption.fadeIn(showTime);
            }
            else{
                slide_caption.fadeOut(hideTime, function(){
                    div_title.empty();
                    div_desc.empty();
                });
            }
        };

        album.progressBar = function(){
            var parent = progress_bar.parent().parent();

            progress_bar
                .stop()
                .css( 'width' , 0)
                .animate({
                    width : parent.width()
                }, slideshow_interval_time, 'linear');
        };

        album.progressBarStop = function(){
            progress_bar
                .stop()
                .css( 'width' , 0);
        };

        // Make it go!
        album.start();
	};

    $.fn.a13slider = function(options){
        return this.each(function(){
            $.a13slider(options);
        });
    };
})(jQuery);