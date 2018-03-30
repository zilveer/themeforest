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
            if (delta > 0) {
                var background_y = $this.outerHeight() - background_h + delta;
                $this.css('cssText', 'background-position: 0px ' + background_y + 'px !important');
            }
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
    $('.stripe-video-wrap').each(function () {
        var $this = $(this),$video = $this.find('video'),speedFactor=$(this).data('stellar-background-ratio')||0.7,ratio=0,video_bottom=0;
        var video_height = 0;
        var el_height = $(this).outerHeight();
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
                'height': video_height + 'px',
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
    })

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
