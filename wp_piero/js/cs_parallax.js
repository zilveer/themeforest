    (function($) { "use strict";
    jQuery(document).ready(function ($) {
    var window_height = $(window).height();
    var window_width = $(window).width();
    $('.stripe-parallax-bg').each(function () {
    var $this = $(this),
    element_h = $this.outerHeight(),
    background_w = $this.data('background-width'),
    background_h = $this.data('background-height'),
    ratio = background_w / background_h;
	if($this.hasClass('stripe-video-wrap')) return;
    var speedFactor = $this.data('stellar-background-ratio');
    var backgroundsize = 'background-size:auto ' + background_h + 'px !important';
    var adjustbackground = function(){
    window_height = $(window).height();
    element_h = $this.outerHeight();
    background_h = element_h + (window_height) * (1-speedFactor);
    background_w = background_h*ratio;
    if(background_w < $this.outerWidth()){
    background_w = $this.outerWidth();
    background_h = background_w/ratio;
    }
    backgroundsize = 'background-size:auto ' + background_h + 'px !important';
    };
    var doScroll = function(){
    //if ($(window).width() < 768) return;
    var delta = Math.round(isappears($this) * (1-speedFactor));
    //if (delta > 0) {
    var background_y = $this.outerHeight() - background_h + delta;
    $this.css('cssText', backgroundsize + ';background-position: 50% ' + background_y + 'px !important;');
    //}
    };
    adjustbackground();
    $(window).bind('resize', function () {
    adjustbackground();
    doScroll();
    }).bind('load',function(){
    adjustbackground();
    doScroll();
    }).bind('scroll', doScroll);
    });
    /*Video parallax*/
    $('.stripe-video-wrap,.videohtml5_wrap').each(function () {
		var $this = $(this),$video = $this.find('video'),speedFactor=$(this).data('stellar-background-ratio')||0.7,ratio=0,video_bottom=0;
		var video_height = 0;
		var el_height = $(this).outerHeight();
		if($this.hasClass('stripe-parallax-bg')){
			$video.bind('loadeddata', function(){
			adjustvideo();
			doScroll();
			});
			var adjustvideo = function(){
			ratio = $video.data('ratio');
			//video_height = $(window).width() / ratio;
			video_height = el_height + (el_height + window_height) * (1 - speedFactor);
			if (video_height < $(window).width() / ratio) {
			video_height = $(window).width() / ratio
			}
			$video.css({
			'width': video_height * ratio + 'px',
			'maxWidth': video_height * ratio + 'px',
			bottom: 0
			});
			}
			if (speedFactor == 1) return;
			var doScroll = function(){
			if ($(window).width() < 768) return;
			$video.attr(
			{
			'appear':isappears($this),
			'delta':Math.round(isappears($this) * (1-speedFactor))
			}
			);
			var delta = Math.round(isappears($this) * (1-speedFactor));
			$video.css({
			bottom: (0 - delta) + 'px'
			})
			};
			adjustvideo();
			doScroll();
			$(window).bind('scroll', doScroll).bind('resize',function(){
			adjustvideo();
			doScroll();
			});
		}
		/*Video btn */
		if($('.exp-videobg-control-btn',$this).length > 0){
			var video = $this.find('video');
			var content = $this.find('.stripe-video-content');
			if(content.length < 1) content = $this.find('.content_wrap');
			video.bind("ended", function() {
			   content.fadeTo( "slow", 1 );
			   $(this).addClass('video-pause').removeClass('video-play');
			});
			video.bind("play", function() {
			   content.fadeTo( "slow", 0 );
			   $(this).addClass('video-pause').removeClass('video-pause');
			});
			video.bind("pause", function() {
			   content.fadeTo( "slow", 1 );
			   $(this).addClass('video-pause').removeClass('video-play');
			});
			video.bind("playing", function() {
			   content.fadeTo( "slow", 0 );
			   $(this).addClass('video-play').removeClass('video-pause');
			});
			$('.exp-videobg-control-btn',$this).click(function(e){
				//console.log('click button');
				e.stopPropagation();
				playVideo(video);	
			})
			$('.ww-video-bg,.stripe-video-content,video',$this).click(function(e){
				e.stopPropagation();
				pauseVideo(video);	
			})
		}
    })
	function playVideo(video){
		if (video.get(0).paused == true) {
			video.get(0).play();
		} else {
			video.get(0).pause();
		}
	}
	function pauseVideo(video){
		if (video.get(0).paused != true) {
			video.get(0).pause();
		}
	}
	/*End Video btn */
    function isappears(element) {
    var scrolltop = $(window).scrollTop(),top = $(element).offset().top;
    if(top < $(window).height()){
    return scrolltop;
    }
    if ((scrolltop + $(window).height()) >= ($(element).offset().top)) {
    return scrolltop + $(window).height() - $(element).offset().top;
    }
    return 0;
    }
    });
    })(jQuery);
