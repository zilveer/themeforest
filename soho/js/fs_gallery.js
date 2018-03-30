var fs_body = jQuery('body');
jQuery.fn.fs_gallery = function (fs_options) {
    if (fs_options.slides.length > 1) {
        var fs_interval = setInterval('nextSlide()', fs_options.slide_time);
    }
    if (fs_options.thmb_state == 'off') {
        set_state = "fs_hide";
    } else {
        set_state = "";
    }
	if (fs_options.video_cover == '1') {
		set_video_cover = "video_cover";
		set_video_controls = '0';
	} else {
		set_video_cover = "video_fit";
		set_video_controls = '1';
	}
    if (fs_options.autoplay == 0) {
        playpause = "fs_play";
        clearInterval(fs_interval);
    } else {
        playpause = "fs_pause";
    }
    fs_body.append('<div class="fs_gallery_overlay"></div><div class="fs_gallery_wrapper"><ul class="' + fs_options.fit + ' fs_gallery_container ' + fs_options.fx + ' ' + set_video_cover + '"/></div>');
    fs_container = jQuery('.fs_gallery_container');
    if (fs_options.slides.length > 1) {
        jQuery('.fs_controls_append').prepend('<a href="javascript:void(0)" class="fs_slider_prev"/><a href="javascript:void(0)" id="fs_play-pause" class="'+playpause+'"></a><a href="javascript:void(0)" class="fs_slider_next"/>');
    }
    fs_body.append('<div class="fs_thmb_viewport ' + set_state + '"><div class="thmb-left"></div><div class="thmb-right"></div><div class="fs_thmb_wrapper"><ul class="fs_thmb_list" style="width:' + fs_options.slides.length * 80 + 'px"></ul</div></div>');
    fs_thmb = jQuery('.fs_thmb_list');
    if (fs_options.autoplay == 0) {
        fs_thmb.addClass('paused');
    }
    fs_thmb_viewport = jQuery('.fs_thmb_viewport');
    $fs_title = jQuery('.fs_title');
    $fs_descr = jQuery('.fs_descr');

    thisSlide = 0;
    while (thisSlide <= fs_options.slides.length - 1) {
        if (fs_options.slides[thisSlide].type == "image") {
            fs_container.append('<li class="fs_slide slide' + thisSlide + '" data-count="' + thisSlide + '" data-src="' + fs_options.slides[thisSlide].image + '" data-type="' + fs_options.slides[thisSlide].type + '"></li>');
        } else if (fs_options.slides[thisSlide].type == "youtube") {
            fs_container.append('<li class="fs_slide yt_slide video_slide slide' + thisSlide + '" data-count="' + thisSlide + '" data-bg="' + fs_options.slides[thisSlide].thmb + '" data-src="' + fs_options.slides[thisSlide].src + '" data-type="' + fs_options.slides[thisSlide].type + '"></li>');
        } else {
            fs_container.append('<li class="fs_slide video_slide slide' + thisSlide + '" data-id="player' + fs_options.slides[thisSlide].uniqid + '" data-count="' + thisSlide + '" data-bg="' + fs_options.slides[thisSlide].thmb + '" data-src="' + fs_options.slides[thisSlide].src + '" data-type="' + fs_options.slides[thisSlide].type + '"></li>');
        }

        if (fs_options.slides[thisSlide].type == "image") {
            fs_thmb.append('<li class="fs_slide_thmb slide' + thisSlide + '" data-count="' + thisSlide + '"><img alt="' + fs_options.slides[thisSlide].alt + ' ' + thisSlide + '" src="' + fs_options.slides[thisSlide].thmb + '"/><div class="fs_thmb_fadder"></div></li>');
        } else if (fs_options.slides[thisSlide].type == "youtube") {
            fs_thmb.append('<li class="fs_slide_thmb video_thmb yt_thmb slide' + thisSlide + '" data-count="' + thisSlide + '"><img alt="' + fs_options.slides[thisSlide].alt + ' ' + thisSlide + '" src="' + fs_options.slides[thisSlide].thmb + '"/><div class="fs_thmb_fadder"></div></li>');
        } else {
            fs_thmb.append('<li class="fs_slide_thmb video_thmb slide' + thisSlide + '" data-count="' + thisSlide + '"><img alt="' + fs_options.slides[thisSlide].alt + ' ' + thisSlide + '" src="' + fs_options.slides[thisSlide].thmb + '"/><div class="fs_thmb_fadder"></div></li>');
        }
        thisSlide++;
    }
    jQuery('li.slide0').addClass('current-slide');

    firstObj = fs_container.find('li.slide0');
    fNextObj = fs_container.find('li.slide1');
    var gallery_fixer = 0;

	if (jQuery('.gallery_post_controls').size() > 0) {
        gallery_fixer = jQuery('.gallery_post_controls').find('a').size()*65 + parseInt(jQuery('.gallery_post_controls').css('right'));
    }

    if (firstObj.attr('data-type') == 'image') {
        firstObj.attr('style', 'background:url(' + fs_container.find('li.slide0').attr('data-src') + ') no-repeat;');
    } else if (firstObj.attr('data-type') == 'youtube') {
        firstObj.attr('style', 'background:url(' + fs_options.slides[0].thmb + ') no-repeat;');
        firstObj.append('<iframe width="100%" height="100%" src="http://www.youtube.com/embed/' + fs_options.slides[0].src + '?controls='+ set_video_controls +'&autoplay=1&showinfo=0&modestbranding=1&wmode=opaque&rel=0&hd=1&disablekb=1" frameborder="0" allowfullscreen></iframe>');
		clearInterval(fs_interval);
    } else {
        firstObj.attr('style', 'background:url(' + fs_options.slides[0].thmb + ') no-repeat;');
        firstObj.append('<iframe src="http://player.vimeo.com/video/' + fs_options.slides[0].src + '?autoplay=1&loop=0&api=1&player_id=player' + fs_options.slides[0].uniqid + '" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
		clearInterval(fs_interval);
    }
    if (fs_options.slides.length > 1) {
        if (fNextObj.attr('data-type') == 'image') {
            fNextObj.attr('style', 'background:url(' + fs_container.find('li.slide1').attr('data-src') + ') no-repeat;');
        } else if (fNextObj.attr('data-type') == 'youtube') {
            fNextObj.attr('style', 'background:url(' + fs_options.slides[1].thmb + ') no-repeat;');
        } else {
            fNextObj.attr('style', 'background:url(' + fs_options.slides[1].thmb + ') no-repeat;');            
        }
    }
	if (set_video_cover == "video_cover") {
		if (jQuery(window).width() > 1024) {
			if (jQuery('iframe').size() > 0) {
				if (((window_h + 150) / 9) * 16 > window_w) {
					jQuery('iframe').height(window_h + 150).width(((window_h + 150) / 9) * 16);
					jQuery('iframe').css({
						'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
						'top': "-75px",
						'margin-top': '0px'
					});
				} else {
					jQuery('iframe').width(window_w).height(((window_w) / 16) * 9);
					jQuery('iframe').css({
						'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
						'margin-top': (-1 * jQuery('iframe').height() / 2) + 'px',
						'top': '50%'
					});
				}
			}
		} else {
			jQuery('iframe').height(window_h - jQuery('.fs_controls').height() - header.height()).width(window_w).css({
				'top': header.height()+'px',
				'margin-left' : '0px',
				'left' : '0',
				'margin-top': '0px'
			});			
		}
	}

    $fs_title.html(fs_options.slides[0].title).css('color', fs_options.slides[0].titleColor);
    $fs_descr.html(fs_options.slides[0].description).css('color', fs_options.slides[0].descriptionColor);

    if (jQuery('.gallery_post_controls').size() > 0) {
        fs_thmb_viewport.width(window_w - parseInt(fs_thmb_viewport.css('left')) - gallery_fixer);
    } else {
        fs_thmb_viewport.width(window_w - parseInt(fs_thmb_viewport.css('left')));
    }

    if (fs_options.slides.length > 1) {

        jQuery('.fs_slide_thmb').click(function () {
            goToSlide(parseInt(jQuery(this).attr('data-count')));
        });
        jQuery('.fs_slider_prev').click(function () {
            prevSlide();
        });
        jQuery('.fs_slider_next').click(function () {
            nextSlide();
        });

        jQuery(document.documentElement).keyup(function (event) {
            if ((event.keyCode == 37) || (event.keyCode == 40)) {
                prevSlide();
            } else if ((event.keyCode == 39) || (event.keyCode == 38)) {
                nextSlide();
            }
        });

		jQuery('.fs_slide').on("swipeleft",function(){
			nextSlide();
		});
		jQuery('.fs_slide').on("swiperight",function(){
			prevSlide();
		});

        jQuery('#fs_play-pause').click(function () {
            if (jQuery(this).hasClass('fs_pause')) {
                fs_thmb.addClass('paused');
                jQuery(this).removeClass('fs_pause').addClass('fs_play');
                clearInterval(fs_interval);
            } else {
                fs_thmb.removeClass('paused');
                jQuery(this).removeClass('fs_play').addClass('fs_pause');
                fs_interval = setInterval('nextSlide()', fs_options.slide_time);
            }
        });
    }
	setGalleryContainer(jQuery('.fs_gallery_container'));
    /* N E X T   S L I D E */
    nextSlide = function () {
        clearInterval(fs_interval);
        thisSlide = parseInt(fs_container.find('.current-slide').attr('data-count'));
        fs_container.find('.slide' + thisSlide).find('iframe').remove();
        thisSlide++;
        cleanSlide = thisSlide - 2;
        nxtSlide = thisSlide + 1;
        if (thisSlide == fs_container.find('li').size()) {
            thisSlide = 0;
            cleanSlide = fs_container.find('li').size() - 3;
            nxtSlide = thisSlide + 1;
        }
        if (thisSlide == 1) {
            cleanSlide = fs_container.find('li').size() - 2;
        }
        $fs_title.fadeOut(300);
        $fs_descr.fadeOut(300, function () {
            $fs_title.html(fs_options.slides[thisSlide].title).css('color', fs_options.slides[thisSlide].titleColor);
            $fs_descr.html(fs_options.slides[thisSlide].description).css('color', fs_options.slides[thisSlide].descriptionColor);
            $fs_title.fadeIn(300);
            $fs_descr.fadeIn(300);
        });

        currentObj = fs_container.find('.slide' + thisSlide);
        nextObj = fs_container.find('.slide' + nxtSlide);

        fs_container.find('.slide' + cleanSlide).attr('style', '');
        if (currentObj.attr('data-type') == 'image') {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-src') + ') no-repeat;');
        } else if (currentObj.attr('data-type') == 'youtube') {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-bg') + ') no-repeat;');
			currentObj.append('<iframe width="100%" height="100%" src="http://www.youtube.com/embed/' + currentObj.attr('data-src') + '?controls='+ set_video_controls +'&autoplay=1&showinfo=0&modestbranding=1&wmode=opaque&rel=0&hd=1&disablekb=1" frameborder="0" allowfullscreen></iframe>');
        } else {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-bg') + ') no-repeat;');
            currentObj.append(jQuery('<iframe width="100%" height="100%" src="http://player.vimeo.com/video/' + currentObj.attr('data-src') + '?api=1&amp;title=0&amp;byline=0&amp;portrait=0&autoplay=1&loop=0&controls='+ set_video_controls +'&player_id=' + currentObj.attr('data-id') + '" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>').attr('id', currentObj.attr('data-id')));
        }

        if (nextObj.attr('data-type') == 'image') {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-src') + ') no-repeat;');
        } else if (nextObj.attr('data-type') == 'youtube') {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
        } else {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
        }
        jQuery('.current-slide').removeClass('current-slide');
        jQuery('.slide' + thisSlide).addClass('current-slide');

       	if (set_video_cover == "video_cover") {
			if (jQuery(window).width() > 1024) {
				if (jQuery('iframe').size() > 0) {
					if (((window_h + 150) / 9) * 16 > window_w) {
						jQuery('iframe').height(window_h + 150).width(((window_h + 150) / 9) * 16);
						jQuery('iframe').css({
							'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
							'top': "-75px",
							'margin-top': '0px'
						});
					} else {
						jQuery('iframe').width(window_w).height(((window_w) / 16) * 9);
						jQuery('iframe').css({
							'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
							'margin-top': (-1 * jQuery('iframe').height() / 2) + 'px',
							'top': '50%'
						});
					}
				}
			} else if (jQuery(window).width() < 760) {
				jQuery('iframe').height(window_h - jQuery('.fs_controls').height() - header.height()).width(window_w).css({
					'top': header.height()+'px',
					'margin-left': -1 * window_w / 2,
					'margin-top': '0px'
				});
			}
		}
	
        if (!fs_thmb.hasClass('paused') && currentObj.attr('data-type') == 'image') {
            fs_interval = setInterval('nextSlide()', fs_options.slide_time);
        }		
    }

    /* P R E V I O U S   S L I D E */
    prevSlide = function () {
        clearInterval(fs_interval);
        thisSlide = parseInt(fs_container.find('.current-slide').attr('data-count'));
        fs_container.find('.slide' + thisSlide).find('iframe').remove();
        thisSlide--;
        nxtSlide = thisSlide - 1;
        cleanSlide = thisSlide + 2;
        if (thisSlide < 0) {
            thisSlide = fs_container.find('li').size() - 1;
            cleanSlide = 1;
        }
        if (thisSlide == fs_container.find('li').size() - 2) {
            cleanSlide = 0;
        }
        $fs_title.fadeOut(300);
        $fs_descr.fadeOut(300, function () {
            $fs_title.html(fs_options.slides[thisSlide].title).css('color', fs_options.slides[thisSlide].titleColor);
            $fs_descr.html(fs_options.slides[thisSlide].description).css('color', fs_options.slides[thisSlide].descriptionColor);
            $fs_title.fadeIn(300);
            $fs_descr.fadeIn(300);
        });

        currentObj = fs_container.find('.slide' + thisSlide);
        nextObj = fs_container.find('.slide' + nxtSlide);

        fs_container.find('.slide' + cleanSlide).attr('style', '');
        if (currentObj.attr('data-type') == 'image') {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-src') + ') no-repeat;');
        } else if (currentObj.attr('data-type') == 'youtube') {
            currentObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
			currentObj.append('<iframe width="100%" height="100%" src="http://www.youtube.com/embed/' + currentObj.attr('data-src') + '?controls='+ set_video_controls +'&autoplay=1&showinfo=0&modestbranding=1&wmode=opaque&rel=0&hd=1&disablekb=1" frameborder="0" allowfullscreen></iframe>');
        } else {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-bg') + ') no-repeat;');
            currentObj.append(jQuery('<iframe width="100%" height="100%" src="http://player.vimeo.com/video/' + currentObj.attr('data-src') + '?api=1&amp;title=0&amp;byline=0&amp;portrait=0&autoplay=1&loop=0&controls='+ set_video_controls +'&player_id=' + currentObj.attr('data-id') + '" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>').attr('id', currentObj.attr('data-id')));
        }

        if (nextObj.attr('data-type') == 'image') {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-src') + ') no-repeat;');
        } else if (nextObj.attr('data-type') == 'youtube') {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
        } else {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
        }
        jQuery('.current-slide').removeClass('current-slide');
        jQuery('.slide' + thisSlide).addClass('current-slide');

       	if (set_video_cover == "video_cover") {
			if (jQuery(window).width() > 1024) {
				if (jQuery('iframe').size() > 0) {
					if (((window_h + 150) / 9) * 16 > window_w) {
						jQuery('iframe').height(window_h + 150).width(((window_h + 150) / 9) * 16);
						jQuery('iframe').css({
							'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
							'top': "-75px",
							'margin-top': '0px'
						});
					} else {
						jQuery('iframe').width(window_w).height(((window_w) / 16) * 9);
						jQuery('iframe').css({
							'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
							'margin-top': (-1 * jQuery('iframe').height() / 2) + 'px',
							'top': '50%'
						});
					}
				}
			} else {
				jQuery('iframe').height(window_h - jQuery('.fs_controls').height() - header.height()).width(window_w).css({
					'top': header.height()+'px',
					'margin-left' : '0px',
					'left' : '0px',
					'margin-top': '0px'
				});			
			}
		}

        jQuery('.current-slide').removeClass('current-slide');
        jQuery('.slide' + thisSlide).addClass('current-slide');

        if (!fs_thmb.hasClass('paused') && currentObj.attr('data-type') == 'image') {
            fs_interval = setInterval('nextSlide()', fs_options.slide_time);
        }
        /*if (fs_thmb.find('.fs_slide_thmb.current-slide').offset().left > jQuery(window).width() - fs_thmb.find('.fs_slide_thmb.current-slide').width()) {
            if (parseInt(fs_thmb.css('left')) < fs_thmb.find('.fs_slide_thmb.current-slide').width()) {
                fs_thmb.css('left', -1 * fs_thmb.find('.fs_slide_thmb.current-slide').offset().left + jQuery(window).width() - fs_thmb.find('.fs_slide_thmb.current-slide').width());
            } else {
                fs_thmb.css('left', parseInt(fs_thmb.css('left')) - fs_thmb.find('.fs_slide_thmb.current-slide').width());
            }
        } else if (fs_thmb.find('.fs_slide_thmb.current-slide').offset().left < 0) {
            fs_thmb.css('left', parseInt(fs_thmb.css('left')) - fs_thmb.find('.fs_slide_thmb.current-slide').offset().left);
        }*/
    }

    /* S E L E C T   S L I D E */
    goToSlide = function (set_slide) {
        clearInterval(fs_interval);
        oldSlide = parseInt(fs_container.find('.current-slide').attr('data-count'));
        thisSlide = set_slide;

        $fs_title.fadeOut(300);
        $fs_descr.fadeOut(300, function () {
            $fs_title.html(fs_options.slides[thisSlide].title).css('color', fs_options.slides[thisSlide].titleColor);
            $fs_descr.html(fs_options.slides[thisSlide].description).css('color', fs_options.slides[thisSlide].descriptionColor);
            $fs_title.fadeIn(300);
            $fs_descr.fadeIn(300);
        });

        fs_container.find('.fs_slide').attr('style', '');
        fs_container.find('.fs_slide').find('iframe').remove();
        currentObj = fs_container.find('.slide' + thisSlide);
        if (currentObj.attr('data-type') == 'image') {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-src') + ') no-repeat;');
        } else if (currentObj.attr('data-type') == 'youtube') {
            currentObj.append('<iframe width="100%" height="100%" src="http://www.youtube.com/embed/' + currentObj.attr('data-src') + '?controls='+ set_video_controls +'&autoplay=1&showinfo=0&modestbranding=1&wmode=opaque&rel=0&hd=1&disablekb=1" frameborder="0" allowfullscreen></iframe>');
        } else {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-bg') + ') no-repeat;');
            currentObj.append(jQuery('<iframe width="100%" height="100%" src="http://player.vimeo.com/video/' + currentObj.attr('data-src') + '?api=1&amp;title=0&amp;byline=0&amp;portrait=0&autoplay=1&loop=0&controls='+ set_video_controls +'&player_id=' + currentObj.attr('data-id') + '" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>').attr('id', currentObj.attr('data-id')));
        }

        jQuery('.current-slide').removeClass('current-slide');
        jQuery('.slide' + thisSlide).addClass('current-slide');

        if (!fs_thmb.hasClass('paused') && currentObj.attr('data-type') == 'image') {
            fs_interval = setInterval('nextSlide()', fs_options.slide_time);
        }
        /*if (fs_thmb.find('.fs_slide_thmb.current-slide').offset().left > jQuery(window).width() - fs_thmb.find('.fs_slide_thmb.current-slide').width()) {
            fs_thmb.css('left', parseInt(fs_thmb.css('left')) - fs_thmb.find('.fs_slide_thmb.current-slide').width());
        } else if (fs_thmb.find('.fs_slide_thmb.current-slide').offset().left < 0) {
            fs_thmb.css('left', parseInt(fs_thmb.css('left')) - fs_thmb.find('.fs_slide_thmb.current-slide').offset().left);
        }*/

        /*SETUP VIDEO*/
       	if (set_video_cover == "video_cover") {
			if (jQuery(window).width() > 1024) {
				if (jQuery('iframe').size() > 0) {
					if (((window_h + 150) / 9) * 16 > window_w) {
						jQuery('iframe').height(window_h + 150).width(((window_h + 150) / 9) * 16);
						jQuery('iframe').css({
							'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
							'top': "-75px",
							'margin-top': '0px'
						});
					} else {
						jQuery('iframe').width(window_w).height(((window_w) / 16) * 9);
						jQuery('iframe').css({
							'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
							'margin-top': (-1 * jQuery('iframe').height() / 2) + 'px',
							'top': '50%'
						});
					}
				}
			} else {
				jQuery('iframe').height(window_h - jQuery('.fs_controls').height() - header.height()).width(window_w).css({
					'top': header.height()+'px',
					'margin-left' : '0px',
					'left' : '0px',
					'margin-top': '0px'
				});			
			}
		}
    }
}

var max_left = 0,
max_right = jQuery('.fs_thmb_viewport').width() - jQuery('.fs_thmb_list').width(),
step = 80,
intRuned = false;

jQuery(document).ready(function ($) {
	html.addClass('no-thmb-left');
	if (jQuery('.gallery_post_controls').size() > 0) {
		jQuery('.gallery_post_controls').width(jQuery('.gallery_post_controls').find('a').size()*65);
	}
    var fs_thmb_list = jQuery('.fs_thmb_list');
    fs_thmb_list.mousedown(function () {
        fs_thmb_list.addClass('clicked');
    });
    fs_thmb_list.mouseup(function () {
        fs_thmb_list.removeClass('clicked');
    });

	setw = Math.floor((window_w - (jQuery('.gallery_post_controls').find('a').size()*65) - parseInt(jQuery('.fs_thmb_viewport').css('left'))- parseInt(jQuery('.gallery_post_controls').css('right')))/80)*80;	
	jQuery('.fs_thmb_viewport').width(setw);
	
	if (window_w > 1200) {
		jQuery('.thmb-left').hover(function(e){
			intRuned = true;
			scrollThmbs = setInterval('scrollThmb("right")', 350);
		}, function(e) {
			if (intRuned == true) {
				clearInterval(scrollThmbs);
				intRuned = false;
			}
		});
		jQuery('.thmb-right').hover(function(e){
			intRuned = true;
			scrollThmbs = setInterval('scrollThmb("left")', 350);
		}, function(e) {
			if (intRuned == true) {
				clearInterval(scrollThmbs);
				intRuned = false;
			}
		});	
	} else {
		jQuery('.thmb-left').click(function(){
			scrollThmb("right");
		});
		jQuery('.thmb-right').click(function(){
			scrollThmb("left");
		});		
	}
	if (window_w < 760) {
		jQuery('.fs_title_wrapper').css('top', header.height());
	}
});

jQuery(document).on("click", ".close_controls", function () {
	show_hide_controls();
});

function show_hide_controls() {
	if (html.hasClass('hide_controls')) {
		html.removeClass('hide_controls');
		if (jQuery('#wpadminbar').size() > 0) {
			setHeight = myWindow.height() - header.height() - jQuery('#wpadminbar').height() - jQuery('.fs_controls').height();
			jQuery('.fs_gallery_container').height(setHeight).css('top', header.height() + jQuery('#wpadminbar').height() +'px');
		} else {
			setHeight = myWindow.height() - header.height() - jQuery('.fs_controls').height();
			jQuery('.fs_gallery_container').height(setHeight).css('top', header.height()+'px');
		}			
		
	} else {
		html.addClass('hide_controls');
		setHeight = myWindow.height();
		jQuery('.fs_gallery_container').height(setHeight).css('top', '0px');
	}	
}

jQuery(window).resize(function () {
	setw = Math.floor((window_w - (jQuery('.gallery_post_controls').find('a').size()*65) - parseInt(jQuery('.fs_thmb_viewport').css('left'))- parseInt(jQuery('.gallery_post_controls').css('right')))/80)*80;
	jQuery('.fs_thmb_viewport').width(setw);
   	if (set_video_cover == "video_cover") {
		if (jQuery(window).width() > 1024) {
			if (jQuery('iframe').size() > 0) {
				if (((window_h + 150) / 9) * 16 > window_w) {
					jQuery('iframe').height(window_h + 150).width(((window_h + 150) / 9) * 16);
					jQuery('iframe').css({
						'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
						'top': "-75px",
						'margin-top': '0px'
					});
				} else {
					jQuery('iframe').width(window_w).height(((window_w) / 16) * 9);
					jQuery('iframe').css({
						'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
						'margin-top': (-1 * jQuery('iframe').height() / 2) + 'px',
						'top': '50%'
					});
				}
			}
		} else {
			jQuery('iframe').height(window_h - jQuery('.fs_controls').height() - header.height()).width(window_w).css({
				'top': header.height()+'px',
				'margin-left' : '0px',
				'left' : '0px',
				'margin-top': '0px'
			});			
		}
	}
	setGalleryContainer(jQuery('.fs_gallery_container'));
});

function setGalleryContainer(contClass) {	
	if (!html.hasClass('hide_controls')) {
		if (jQuery('#wpadminbar').size() > 0) {
			setHeight = myWindow.height() - header.height() - jQuery('#wpadminbar').height() - jQuery('.fs_controls').height();
			contClass.height(setHeight).css('top', header.height() + jQuery('#wpadminbar').height() + 'px');	
		} else {
			setHeight = myWindow.height() - header.height() - jQuery('.fs_controls').height();
			contClass.height(setHeight).css('top', header.height() + 'px');	
		}
	} else {
		setHeight = myWindow.height();
		jQuery('.fs_gallery_container').height(setHeight).css('top', '0px');	
	}
}