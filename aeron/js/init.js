jQuery(document).ready(function($) {
    "use strict";

    var tcvpb_tipsy_opacity = (typeof tcvpb_options !== 'undefined') ? tcvpb_options.tcvpb_tipsy_opacity : 0.8;


/*********** Image Carousel ************************************************************/
    $('.tcvpb-image-carousel').each(function () {
        var $this = $(this);
        var $prev = $this.find('.tcvpb-image-carousel_prev');
        var $next = $this.find('.tcvpb-image-carousel_next');

        var items = $this.data('items');
        var margin = $this.data('margin');
        var loop = $this.data('loop') == '0' ? false : true;
        var center = $this.data('center') == '0' ? false : true;
        var stagepadding = $this.data('stagepadding');
        var startposition = $this.data('startposition');
        var navigation = $this.data('navigation') == '0' ? false : true;
        var navrewind = $this.data('navigation') == '0' ? false : true;
        var slideby = $this.data('slideby');
        var dots = $this.data('dots') == '0' ? false : true;
        var dotseach = $this.data('dotseach') == '0' ? false : true;
        var autoplay = $this.data('autoplay') == '0' ? false : true;
        var autoplaytimeout = $this.data('autoplaytimeout');
        var autoplayhoverpause = $this.data('autoplayhoverpause');
        var autoplayspeed = $this.data('autoplayspeed');
        var navspeed = $this.data('navspeed');
        var dotsspeed = $this.data('dotsspeed');
        var dragendspeed = $this.data('dragendspeed');
        var animateout = $this.data('animateout');
        var animatein = $this.data('animatein');

        var $tcvpb_image_carousel_wrapper = $this.find('.tcvpb-image-carousel-wrapper');

        $tcvpb_image_carousel_wrapper.imagesLoaded(function(){
            $tcvpb_image_carousel_wrapper.owlCarousel({
                // Most important owl features
                items: items,
                margin: margin,
                loop: loop,
                center: center,

                // Drag features
                mouseDrag: true,
                touchDrag: true,
                pullDrag: true,
                freeDrag: false,
                smartSpeed:450,

                // Padding
                stagePadding: stagepadding,

                autoWidth: false,
                startPosition: startposition,

                // Navigation
                nav: navigation,
                navRewind: navrewind,
                navText: [$prev,$next],
                slideBy: slideby,

                // Dots
                dots: dots,
                dotsEach: dotseach,

                // Speed
                autoplay: autoplay,
                autoplayTimeout: autoplaytimeout,
                autoplayHoverPause: autoplayhoverpause,
                autoplaySpeed: autoplayspeed,
                navSpeed: navspeed,
                dotsSpeed: dotsspeed,
                dragEndSpeed: dragendspeed,

                // Responsive
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    900:{
                        items: items
                    }
                },
                responsiveRefreshRate: 200,
                responsiveBaseElement: window,

                // Animations
                animateOut: animateout,
                animateIn: animatein,

            });
        });
    });


/*********** Parallax ************************************************************/
    $('.tcvpb-parallax').each(function(){
        var parallax_amount = $(this).data('parallax');
        var background_image = $(this).data('background_image');
        if(!jQuery.browser.mobile && $(window).width()>767 && background_image!==undefined){
            $(this).css('background-image', 'url(' + background_image + ')');
            $(this).parallax("50%", parallax_amount,false);
        } else{
            $(this).css('background-attachment', 'scroll');
        }
    });


    $('.tcvpb-video-bg .section_video_background').mediaelementplayer( {pauseOtherPlayers: false} );

    function tcvpb_resize_video_bg($section){
        var $video = $section.find('.tcvpb_video_background');
        $video.width('auto');
        var video_height = $video.height();
        var ratio = $video.width()/video_height;
        var difference = $section.height()-video_height;
        if(difference>0){
            $video.width((video_height+difference)*ratio);
        }
    }

    $('.tcvpb-video-bg').each(function(){
        tcvpb_resize_video_bg($(this));
        $(this).find('.tcvpb_video_background').css({'visibility':'visible'});
    });


/*********** Animations ************************************************************/
    $('.tcvpb-animo').each(function(){
        var $animated = $(this);
        var animation = $animated.data('animation');
        // var timing = $animated.data('timing');
        var duration = $animated.data('duration')/1000;
        var delay = parseInt($animated.data('delay'),10);
        $animated.waypoint({
            handler: function(direction) {
                if(!$animated.hasClass('animation_completed')){
                    if(delay>0){
                        setTimeout(function() {
                            $animated
                            .css('-webkit-animation-duration', duration+'s')
                            .css('animation-duration', duration+'s')
                            .addClass('animation_completed');
                        }, delay);
                    } else{
                        $animated
                        .css('-webkit-animation-duration', duration+'s')
                        .css('animation-duration', duration+'s')
                        .addClass('animation_completed');
                    }
                }
            },
            offset: function(){
                var trigger_pt = (typeof $animated.data('trigger_pt')!== 'undefined') ? $animated.data('trigger_pt').toString(10) : '0';
                if(trigger_pt.indexOf("%")>0){
                    trigger_pt = $animated.outerHeight()*parseInt(trigger_pt,10)/100;
                }
                var wh = $(window).height();
                var pixels = wh - parseInt(trigger_pt,10);
                return pixels;
            }
        });
    });

    function tcvpb_animate_childrens(){
        $(".tcvpb-animo-children").each(function(){
            var $animated = $(this);
            var animation = $animated.data('animation');
            var duration = $animated.data('duration')/1000;
            var delay = parseInt($animated.data('delay'),10);
            $animated.children().each(function(){
                var $element = $(this);
                $element.waypoint({
                    handler: function(direction) {
                        if(!$element.is('.animation_completed, .portfolio_empty')){ 
                            $element.addClass('animation_start');
                            setTimeout(function(){
                                var difference = ($('.animation_start').not('.animation_completed').index($element))*delay;
                                if(delay>0){
                                    setTimeout(function() {
                                        $element
                                        .css('-webkit-animation-duration', duration+'s')
                                        .css('animation-duration', duration+'s')
                                        .addClass('animation_completed');
                                    }, difference);
                                } else{
                                    $element
                                    .css('-webkit-animation-duration', duration+'s')
                                    .css('animation-duration', duration+'s')
                                    .addClass('animation_completed');
                                }
                            }, 50);
                        }
                    },
                    offset: function(){
                        var trigger_pt = (typeof $animated.data('trigger_pt')!== 'undefined') ? $animated.data('trigger_pt').toString(10) : '0';
                        if(trigger_pt.indexOf("%")>0){
                            trigger_pt = $animated.outerHeight()*parseInt(trigger_pt,10)/100;
                        }
                        var wh = $(window).height();
                        var pixels = wh - parseInt(trigger_pt,10);
                        return pixels;
                    }
                });
            });
        });
    }


/*********** Accordions ************************************************************/
    $( ".tcvpb-accordion" ).accordion({
        collapsible: true,
        active: false,
        heightStyle: "content",
        create: function( event, ui ) {
            var expanded = $(this).data("expanded");
            if(expanded===0){
                expanded = false;
            } else{
                expanded = expanded-1;
            }
            $(this).accordion( "option", "active", expanded);
        },
    });


/*********** Tabs ************************************************************/
    $(".tcvpb-tabs-tab").click(function(event) {
        event.preventDefault();
        var $this = $(this);
        var $tabs= $this.parents('.tcvpb-tabs');

        if ($this.parent().hasClass('active') || $tabs.hasClass('animating')) {
            return;
        }

        $this.parent().addClass('active');
        $this.parent().siblings().removeClass('active');

        var $old_pane = $tabs.find(".tab-pane.active_pane");
        var $new_pane = $($this.data("href"));
        var $pane_parent = $old_pane.parent();
        var auto_height;

        var effect = $tabs.data('effect');

        if ( effect==='fade' || effect==='slide' ) {
            $tabs.addClass('animating');
            $pane_parent.height($pane_parent.height());
            $old_pane.css({'opacity':'1','display':'block'});
            $new_pane.css({'opacity': '0','display':'block'});
            $pane_parent.find('.active_pane').removeClass('active_pane');

            if(effect==='slide'){
                var increasing = false;
                if ($new_pane.index() > $old_pane.index()){
                    increasing = true;
                }

                if($tabs.hasClass('tcvpb-tabs-vertical')){
                    $new_pane.css({
                        'top': ((increasing)?'100%':'-100%'),
                        'opacity':'1',
                        'display':'block',
                    });
                    $new_pane.animate({'top' : '0%'},{
                        'duration' : 300,
                        'step' : function(){
                            var offset = $(this).outerHeight()+(parseFloat($(this).css('top'))*((increasing)?-1:1));
                            $old_pane.css('top',((increasing)?'-':'')+offset+'px');
                        },
                        'complete' : function(){
                            $(this).addClass('active_pane');
                            $old_pane.hide();
                            $tabs.removeClass('animating');
                        }
                    });
                } else{
                    $new_pane.css({
                        'left': ((increasing)?'100%':'-100%'),
                        'opacity':'1',
                        'display':'block',
                    });
                    $new_pane.animate({'left' : '0%'},{
                        'duration' : 300,
                        'step' : function(){
                            var offset = $(this).outerWidth()+(parseFloat($(this).css('left'))*((increasing)?-1:1));
                            $old_pane.css('left',((increasing)?'-':'')+offset+'px');
                        },
                        'complete' : function(){
                            $(this).addClass('active_pane');
                            $old_pane.hide();
                            $tabs.removeClass('animating');
                        }
                    });

                }

                auto_height = $new_pane.outerHeight();
                $pane_parent.animate({
                    'height': auto_height+'px',
                },{
                    'duration' : 300,
                    'complete' : function(){
                        $(this).height('auto');
                    }
                });


            } else if(effect==='fade'){
                $old_pane.animate({'opacity' : '0'},{
                    'duration' : 300,
                    'complete' : function(){
                        $(this).css('display','none');
                    }
                });

                $new_pane.animate({'opacity' : '1'},{
                    'duration' : 300,
                    'complete' : function(){
                        $(this).addClass('active_pane');
                        $tabs.removeClass('animating');
                    }
                });

                auto_height = $new_pane.outerHeight();
                $pane_parent.animate({
                    'height': auto_height+'px',
                },{
                    'duration' : 300,
                    'complete' : function(){
                        $(this).height('auto');
                    }
                });

            }
        } else{
            $old_pane.removeClass('active_pane');
            $new_pane.addClass('active_pane');
        }

    });

    $('.tcvpb-tabs-timeline').each(function(){
        var $this = $(this);
        var $tabs = $this.find('.nav-tabs > li');
        var tabsCount = $tabs.length;
        $tabs.addClass('tab_par_'+tabsCount);
    });

    function tcvpb_tabs_responsive(){
        $('.tcvpb-tabs').each(function(){
            var $tabs = $(this);
            if($tabs.width() < parseInt($tabs.data('break_point'))){
                $tabs.addClass('tcvpb-tabs-fullwidthtabs');
            } else{
                $tabs.removeClass('tcvpb-tabs-fullwidthtabs');
            }
        });
    }

    tcvpb_tabs_responsive();


/*********** Event Tabs ************************************************************/
    $(".tcvpb-event-tabs-tab").click(function(event) {
        event.preventDefault();
        var $this = $(this);
        var $tabs= $this.parents('.tcvpb-event-tabs');

        if ($this.parent().hasClass('active') || $tabs.hasClass('animating')) {
            return;
        }

        $this.parent().addClass('active');
        $this.parent().siblings().removeClass('active');

        var $old_pane = $tabs.find(".tab-pane.active_pane");
        var $new_pane = $($this.data("href"));
        var $pane_parent = $old_pane.parent();
        var auto_height;

        var effect = $tabs.data('effect');

        if ( effect==='fade' || effect==='slide' ) {
            $tabs.addClass('animating');
            $pane_parent.height($pane_parent.height());
            $old_pane.css({'opacity':'1','display':'block'});
            $new_pane.css({'opacity': '0','display':'block'});
            $pane_parent.find('.active_pane').removeClass('active_pane');

            if(effect==='slide'){
                var increasing = false;
                if ($new_pane.index() > $old_pane.index()){
                    increasing = true;
                }

                if($tabs.hasClass('tcvpb-event-tabs-vertical')){
                    $new_pane.css({
                        'top': ((increasing)?'100%':'-100%'),
                        'opacity':'1',
                        'display':'block',
                    });
                    $new_pane.animate({'top' : '0%'},{
                        'duration' : 300,
                        'step' : function(){
                            var offset = $(this).outerHeight()+(parseFloat($(this).css('top'))*((increasing)?-1:1));
                            $old_pane.css('top',((increasing)?'-':'')+offset+'px');
                        },
                        'complete' : function(){
                            $(this).addClass('active_pane');
                            $old_pane.hide();
                            $tabs.removeClass('animating');
                        }
                    });
                } else{
                    $new_pane.css({
                        'left': ((increasing)?'100%':'-100%'),
                        'opacity':'1',
                        'display':'block',
                    });
                    $new_pane.animate({'left' : '0%'},{
                        'duration' : 300,
                        'step' : function(){
                            var offset = $(this).outerWidth()+(parseFloat($(this).css('left'))*((increasing)?-1:1));
                            $old_pane.css('left',((increasing)?'-':'')+offset+'px');
                        },
                        'complete' : function(){
                            $(this).addClass('active_pane');
                            $old_pane.hide();
                            $tabs.removeClass('animating');
                        }
                    });

                }

                auto_height = $new_pane.outerHeight();
                $pane_parent.animate({
                    'height': auto_height+'px',
                },{
                    'duration' : 300,
                    'complete' : function(){
                        $(this).height('auto');
                    }
                });


            } else if(effect==='fade'){
                $old_pane.animate({'opacity' : '0'},{
                    'duration' : 300,
                    'complete' : function(){
                        $(this).css('display','none');
                    }
                });

                $new_pane.animate({'opacity' : '1'},{
                    'duration' : 300,
                    'complete' : function(){
                        $(this).addClass('active_pane');
                        $tabs.removeClass('animating');
                    }
                });

                auto_height = $new_pane.outerHeight();
                $pane_parent.animate({
                    'height': auto_height+'px',
                },{
                    'duration' : 300,
                    'complete' : function(){
                        $(this).height('auto');
                    }
                });

            }
        } else{
            $old_pane.removeClass('active_pane');
            $new_pane.addClass('active_pane');
        }

    });

    function tcvpb_event_tabs_responsive(){
        $('.tcvpb-event-tabs').each(function(){
            var $tabs = $(this);
            if($tabs.width() < parseInt($tabs.data('break_point'))){
                $tabs.addClass('tcvpb-event-tabs-fullwidthtabs');
            } else{
                $tabs.removeClass('tcvpb-event-tabs-fullwidthtabs');
            }
        });
    }

    tcvpb_event_tabs_responsive();


/*********** Alert Box ************************************************************/
    $( ".tcvpb_alert_box_close" ).click(function(){
        var $parent = $(this).parent();
        $parent.animate({height:"0px", paddingTop:"0px", paddingBottom:"0px", margin:"0px", opacity:"0"},400);
    });


/*********** Nivo Slider ************************************************************/
    function tcvpb_nivo_slider(){
        $(".tcvpb-nivo-slider").each(function(){
            var $this = $(this);
            $this.nivoSlider({
                effect: $this.data('autoplay_effect'),
                slices: parseInt($this.data('slices'),10),
                boxCols: parseInt($this.data('boxcols'),10),
                boxRows: parseInt($this.data('boxrows'),10),
                animSpeed: parseInt($this.data('animation'),10),
                pauseTime: parseInt($this.data('duration'),10),
                startSlide: parseInt($this.data('startslide'),10),
                directionNav: (($this.data('directionnav')=='true')?true:false),
                controlNav: (($this.data('controlnav')=='true')?true:false),
                controlNavThumbs: (($this.data('controlnavthumbs')=='true')?true:false),
                pauseOnHover: (($this.data('pauseonhover')=='true')?true:false),
                manualAdvance: (($this.data('manualadvance')=='true')?true:false),
                prevText: $this.data('prevtext'),
                nextText: $this.data('nexttext'),
                randomStart: parseInt($this.data('randomstart'),10),
            });
        });
    }



/*********** Stats excerpt counter ************************************************************/
    function tcvpb_counter($object,interval,max,increment) {
        var number = parseInt($object.text(),10) + increment;
        if (number < max){
            setTimeout(function() {tcvpb_counter($object,interval,max,increment);} ,interval);
            $object.text(number);
        } else{
            $object.text(max);
        }
    }

    if(!jQuery.browser.mobile){
         $(".tcvpb_stats_number").each(function(){
            var $animated = $(this);
            var animation = $animated.data('animation');
            var timing = $animated.data('timing');
            var duration = $animated.data('duration')/1000;
            var delay = parseInt($animated.data('delay'),10);
            var max = $(this).data('number');
            var increment = 1;
            if (max > 50) increment = 10;
            if (max > 500) increment = 100;
            if (max > 5000) increment = 200;
            if (max > 10000) increment = 1000;
            var interval = $animated.data('duration')/(max/increment);
            $animated.text('0');
            $animated.waypoint({
                handler: function(direction) {
                    if(!$animated.hasClass('animation_completed')){
                        if(delay>0){
                            setTimeout(function() {
                                $animated.addClass('animation_completed').animo( { animation: animation, duration: duration, timing: timing} );
                                tcvpb_counter($animated, interval, max, increment);
                            }, delay);
                        } else{
                            $animated.addClass('animation_completed').animo( { animation: animation, duration: duration, timing: timing} );
                            tcvpb_counter($animated, interval, max, increment);
                        }
                    }
                },
                offset: function(){
                    var trigger_pt = (typeof $animated.data('trigger_pt')!== 'undefined') ? $animated.data('trigger_pt').toString(10) : '0';
                    if(trigger_pt.indexOf("%")>0){
                        trigger_pt = $animated.outerHeight()*parseInt(trigger_pt,10)/100;
                    }
                    var wh = $(window).height();
                    var pixels = wh - parseInt(trigger_pt,10);
                    return pixels;
                }
            });

        });

    } else{
        $(".tcvpb_stats_number").each(function() {
            var max = $(this).data("number");
            $(this).text(max);
        });
    }


/*********** Knob ************************************************************/
    $(".tcvpb_knob_wrapper").each(function(){
        var $wrapper = $(this);
        var $knob = $wrapper.find(".tcvpb_knob");
        var $number_sign = $wrapper.find(".tcvpb_knob_number_sign");
        var $number = $wrapper.find(".tcvpb_knob_number");

        $knob.knob({
            'displayInput' : false,
        });

        var canvas_width = $wrapper.find("canvas").width();

        $number_sign.css({
            'visibility' : 'visible',
            'lineHeight' : canvas_width+'px',
        });

        if(!jQuery.browser.mobile){
            $knob.val(0).trigger('change');
            $wrapper.waypoint({
                handler: function(direction) {
                    if(!$wrapper.hasClass('animation_completed')){
                        $wrapper.addClass('animation_completed');
                        $({value: 0}).animate({value: $knob.data("number")}, {
                            duration: 1000,
                            easing:'swing',
                            step: function()
                            {
                                var current = Math.ceil(this.value);
                                $knob.val(current).trigger('change');
                                $number.html(current);
                            }
                        });
                    }
                },
                offset:'95%'
            });
        } else{
            $number.html($knob.data("number"));
        }
    });


/*********** PrettyPrint ************************************************************/
    $(function(){
      window.prettyPrint && prettyPrint();
    });


/*********** Tooltip ************************************************************/
    $('.tcvpb_tooltip').tipsy({
        fade: true,
        opacity: tcvpb_tipsy_opacity,
        gravity: function(){
            var gravity = $(this).data("gravity");
            gravity = (gravity !== undefined) ? gravity : 's';
            return gravity;
        }
    });


/*********** Image Hotspots ********************************************************/



/*********** Image Hotspots ********************************************************/
    $('.tcvpb-hotspot-tooltip').tipsy({
        fade: true,
        html: true,
        opacity: tcvpb_tipsy_opacity,
        gravity: function(){
            var gravity = $(this).data("gravity");
            gravity = (gravity !== undefined) ? gravity : 's';
            return gravity;
        }
    });


/*********** Scroll Popup ********************************************************/
    $(".tcvpb-popup-wrapper").each(function(){
        var $popup = $(this);
        var $popup_shadow = $popup.find('.tcvpb-popup-shadow');
        var $popup_content = $popup.find('.tcvpb-popup-content');
        $popup_shadow.appendTo("body");
        var animation = $popup_content.data('animation');
        var duration = $popup_content.data('duration')/1000;
        var delay = parseInt($popup_content.data('delay'),10);
        $popup.waypoint({
                handler: function(direction) {
                    if(!$popup.hasClass('animation_completed')){
                        $popup.addClass('animation_completed');
                        if(delay>0){
                            setTimeout(function() {
                                $popup_content.css({display : "block", position: "fixed"}).animo( { animation: animation, duration: duration} );
                                $popup_shadow.css({display : "block"}).animo( { animation: animation, duration: duration} );
                            }, delay);
                        } else{
                            $popup_content.css({display : "block", position: "fixed"}).animo( { animation: animation, duration: duration} );
                            $popup_shadow.css({display : "block"}).animo( { animation: animation, duration: duration} );
                        }
                    }
                },
                offset: '95%'
            });
    });

    $('.tcvpb-popup-shadow').click(function(e){
        e.preventDefault();
        $('.tcvpb-popup-shadow').fadeOut();
    });


/*********** Back to Top ************************************************************/
    $('.tcvpb_divider a').click(function(e){
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, 'slow');
    });


/*********** Team Member ************************************************************/
    $('.tcvpb_team_member_modal_link').click(function(e){
        e.preventDefault();
        var $parent = $(this).closest('.tcvpb_team_member');
        var $modal = $parent.find('.tcvpb_team_member_modal');
        var $section = $parent.closest('.tcvpb_section_dd');
        $modal.detach().appendTo('body').fadeIn().addClass('tcvpb_team_member_modal_opened');
        $parent.addClass('tcvpb_team_member_with_opened_modal');
    });
    $('.tcvpb_team_member_modal_close').click(function(e){
        e.preventDefault();
        $(this).parent().fadeOut('slow', function(){
            $(this).detach().appendTo($('.tcvpb_team_member_with_opened_modal')).removeClass('tcvpb_team_member_modal_opened');
            $('.tcvpb_team_member_with_opened_modal').removeClass('tcvpb_team_member_with_opened_modal');
        });
    });
    $(document).on('keydown', function(e) {
        if ( e.keyCode === 27 ) { //ESC
            $('.tcvpb_team_member_modal_opened').fadeOut('slow', function(){
                $(this).detach().appendTo($('.tcvpb_team_member_with_opened_modal')).removeClass('tcvpb_team_member_modal_opened');
                $('.tcvpb_team_member_with_opened_modal').removeClass('tcvpb_team_member_with_opened_modal');
            });
        }
    });


/*********** Progress Bar ************************************************************/
    if(!jQuery.browser.mobile){
        $(".tcvpb_meter .tcvpb_meter_percentage").width(0).each(function(){
            var $bar = $(this);
            var newwidth = $bar.data("percentage") + '%';
            $bar.waypoint({
                handler: function(direction) {
                    if(!$bar.hasClass('animation_completed')){
                        $bar.addClass('animation_completed').animate({width: newwidth}, {
                            duration:1500,
                            step: function(now) {
                                $bar.find('span').html(Math.floor(now) + '%');
                                var above_tenths = Math.floor(now/10);
                                for(var i=1; i<=above_tenths; i++){
                                    $bar.addClass('tcvpb_meter_above'+above_tenths*10);
                                }
                            }
                        });
                    }
                },
                offset: 'bottom-in-view'
            });
        });
    } else{
        $(".tcvpb_meter .tcvpb_meter_percentage").each(function(){
            var $bar = $(this);
            var newwidth = $bar.data("percentage");
            $bar.css('width', newwidth+'%');
            for(var i=0; i<=newwidth; i++){
                var above_tenths = Math.floor(i/10);
                $bar.addClass('tcvpb_meter_above'+above_tenths*10);
            }

        });
    }


/*********** Progress Bar Vertical ************************************************************/
    if(!jQuery.browser.mobile){
        $(".tcvpb_progress_bar_vertical .tcvpb_meter_vertical .tcvpb_meter_percentage_vertical").height(0).each(function(){
            var $bar = $(this);
            var newheight = $bar.data("percentage") + '%';
            $bar.waypoint({
                handler: function(direction) {
                    if(!$bar.hasClass('animation_completed')){
                        $bar.addClass('animation_completed').animate({height: newheight}, {
                            duration:1500,
                            step: function(now) {
                                $bar.find('span').html(Math.floor(now) + '%');
                                var above_tenths = Math.floor(now/10);
                                for(var i=1; i<=above_tenths; i++){
                                    $bar.addClass('tcvpb_meter_above'+above_tenths*10);
                                }
                            }
                        });
                    }
                },
                offset: 'bottom-in-view'
            });

        });
    } else{
        $(".tcvpb_progress_bar_vertical .tcvpb_meter_vertical .tcvpb_meter_percentage_vertical").each(function(){
            var $bar = $(this);
            var newheight = $bar.data("percentage");
            $bar.css('height', newheight+'%');
            for(var i=0; i<=newheight; i++){
                var above_tenths = Math.floor(i/10);
                $bar.addClass('tcvpb_meter_above'+above_tenths*10);
            }

        });
    }


/*********** Portfolio ************************************************************/
    $('.ABp_latest_portfolio').each(function (){
        var $this = $(this);
        var $prev = $this.find('.portfolio_prev');
        var $next = $this.find('.portfolio_next');
        $this.find('ul').carouFredSel({
            prev: $prev,
            next: $next,
            auto: false,
            width: '100%',
            scroll: 1,
        });

    });


/*********** Counter ************************************************************/
    $('.tcvpb_countdown.simple_style').each(function() {
        var $this = $(this);
        var countDownString = $this.data("value");

        function update_countown_element($element,number){
            $element.html(number);
            var $span = $element.next('span');
            if(parseInt(number) == 1){
                $span.html($span.data("singular"));
            } else{
                $span.html($span.data("plural"));
            }
        }

        // $this.find('.simple.countdown.year').countdown(countDownString).on('update.countdown', function(event){
        //     update_countown_element($(this),event.strftime('%Y'));
        // });

        // $this.find('.simple.countdown.month').countdown(countDownString).on('update.countdown', function(event){
        //     update_countown_element($(this),event.strftime('%m'));
        // });

        // $this.find('.simple.countdown.day').countdown(countDownString).on('update.countdown', function(event){
        //     update_countown_element($(this),event.strftime('%d'));
        // });

        // $this.find('.simple.countdown.hour').countdown(countDownString).on('update.countdown', function(event){
        //     update_countown_element($(this),event.strftime('%H'));
        // });

        // $this.find('.simple.countdown.minute').countdown(countDownString).on('update.countdown', function(event){
        //     update_countown_element($(this),event.strftime('%M'));
        // });

        // $this.find('.simple.countdown.second').countdown(countDownString).on('update.countdown', function(event){
        //     update_countown_element($(this),event.strftime('%S'));
        // });

        $('.tcvpb_countdown.simple_style.date_format_2').each(function() {
                var $this = $(this), finalDate = $(this).data('value');
                $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('<div class="tcvpb_countdown_inner"><div class="simple countdown week">%w</div><span>weeks</span></div><div class="tcvpb_countdown_inner"><div class="simple countdown day">%d</div><span>days</span></div><div class="tcvpb_countdown_inner"><div class="simple countdown day">%H</div><span>hours</span></div><div class="tcvpb_countdown_inner"><div class="simple countdown day">%M</div><span>minutes</span></div><div class="tcvpb_countdown_inner"><div class="simple countdown day">%S</div><span>seconds</span></div>'));
            });
        });

        $('.tcvpb_countdown.simple_style.date_format_3').each(function() {
                var $this = $(this), finalDate = $(this).data('value');
                $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('<div class="tcvpb_countdown_inner"><div class="simple countdown day">%D</div><span>days</span></div><div class="tcvpb_countdown_inner"><div class="simple countdown day">%H</div><span>hours</span></div><div class="tcvpb_countdown_inner"><div class="simple countdown day">%M</div><span>minutes</span></div><div class="tcvpb_countdown_inner"><div class="simple countdown day">%S</div><span>seconds</span></div>'));
            });
        });

        $('.tcvpb_countdown.simple_style.date_format_1').each(function() {
            $this.find('.simple.countdown.year').countdown(countDownString).on('update.countdown', function(event){
                update_countown_element($(this),event.strftime('%Y'));
            });

            $this.find('.simple.countdown.month').countdown(countDownString).on('update.countdown', function(event){
                update_countown_element($(this),event.strftime('%m'));
            });

            $this.find('.simple.countdown.day').countdown(countDownString).on('update.countdown', function(event){
                update_countown_element($(this),event.strftime('%d'));
            });

            $this.find('.simple.countdown.hour').countdown(countDownString).on('update.countdown', function(event){
                update_countown_element($(this),event.strftime('%H'));
            });

            $this.find('.simple.countdown.minute').countdown(countDownString).on('update.countdown', function(event){
                update_countown_element($(this),event.strftime('%M'));
            });

            $this.find('.simple.countdown.second').countdown(countDownString).on('update.countdown', function(event){
                update_countown_element($(this),event.strftime('%S'));
            });
        });

    });


    $('.tcvpb_countdown.flip_style').each(function() {
        var $this = $(this);
        var countDownString = $this.data("value");

        function zeroPad(num, places) {
          var zero = places - num.toString().length + 1;
          return Array(+(zero > 0 && zero)).join("0") + num;
        }

        function update_flip_countown_element($element,new_number,if_negative){
            var current_number = parseInt($element.find('.count.curr').html());
            if(current_number!=new_number && !$element.hasClass('in_a_flip')){
                var $span = $element.find('span');
                if(parseInt(new_number) == 1){
                    $span.html($span.data("singular"));
                } else{
                    $span.html($span.data("plural"));
                }
                setTimeout(function(){
                    $element.addClass('flip in_a_flip');
                },5);
                setTimeout(function(){
                    $element.find('.count.curr').html(zeroPad(new_number, 2));
                },510);
                setTimeout(function(){
                    $element.removeClass('flip in_a_flip');
                    new_number = (new_number-1 === -1) ? if_negative : new_number-1;
                    $element.find('.count.next').html(zeroPad(new_number, 2));
                },600);
            }
        }

        $this.find('.flip_element.year .count.curr.top').countdown(countDownString).on('update.countdown', function(event){
            update_flip_countown_element($(this).parent(),event.strftime('%Y'),0);
        });

        $this.find('.flip_element.month .count.curr.top').countdown(countDownString).on('update.countdown', function(event){
            update_flip_countown_element($(this).parent(),event.strftime('%m'),11);
        });

        $this.find('.flip_element.day .count.curr.top').countdown(countDownString).on('update.countdown', function(event){
            update_flip_countown_element($(this).parent(),event.strftime('%d'),30);
        });

        $this.find('.flip_element.hour .count.curr.top').countdown(countDownString).on('update.countdown', function(event){
            update_flip_countown_element($(this).parent(),event.strftime('%H'),23);
        });

        $this.find('.flip_element.minute .count.curr.top').countdown(countDownString).on('update.countdown', function(event){
            update_flip_countown_element($(this).parent(),event.strftime('%M'),59);
        });

        $this.find('.flip_element.second .count.curr.top').countdown(countDownString).on('update.countdown', function(event){
            update_flip_countown_element($(this).parent(),event.strftime('%S'),59);
        });

     });

/*********** Image Carousel ************************************************************/
    $('.tcvpb-carousel').each(function (){
        var $prev = $(this).find('.carousel_prev');
        var $next = $(this).find('.carousel_next');


        var $autoPlay = $(this).data("autoplay") == '0' ? false : true;
        var $items = $(this).data("items");
        var $effect = $(this).data("effect");
        var $easing = $(this).data("easing");
        var $duration = $(this).data("duration");

        $(this).find('ul').carouFredSel({
            prev: $prev,
            next: $next,
            width: '100%',
            play: true,
            auto: $autoPlay,
            scroll: {
                items: $items,
                fx: $effect,
                easing: $easing,
                duration: $duration,
            }
        });
    });


    /*********** Google Maps ************************************************************/
    function initialize_gmap($element) {
        var myLatlng = new google.maps.LatLng($element.data('lat'),$element.data('lng'));
        var auto_center_zoom = ($element.data('auto_center_zoom') == 1 ? true : false);
        var scrollwheel = ($element.data('scrollwheel') == 1 ? true : false);
        var mapTypeControl = ($element.data('maptypecontrol') == 1 ? true : false);
        var panControl = ($element.data('pancontrol') == 1 ? true : false);
        var zoomControl = ($element.data('zoomcontrol') == 1 ? true : false);
        var scaleControl = ($element.data('scalecontrol') == 1 ? true : false);
        var styles = (typeof tcvpb_options !== 'undefined') ? tcvpb_options.tcvpb_custom_map_style : '';
        var map_type = google.maps.MapTypeId.ROADMAP;

        if ($element.data('map_type') == 'SATELLITE') map_type = google.maps.MapTypeId.SATELLITE;
        if ($element.data('map_type') == 'HYBRID') map_type = google.maps.MapTypeId.HYBRID;
        if ($element.data('map_type') == 'TERRAIN') map_type = google.maps.MapTypeId.TERRAIN;

        var mapOptions = {
            zoom: parseInt($element.data('zoom'),10),
            center: myLatlng,
            mapTypeId: map_type,
            styles: jQuery.parseJSON(styles),
            scrollwheel: scrollwheel,
            mapTypeControl: mapTypeControl,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.BOTTOM_CENTER
            },
            panControl: panControl,
            panControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            zoomControl: zoomControl,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: scaleControl,
            scaleControlOptions: {
                position: google.maps.ControlPosition.BOTTOM_LEFT
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            }
        };

        var elemnt_id = $element.attr('id');
        var bounds = new google.maps.LatLngBounds();
        var map = new google.maps.Map(document.getElementById(elemnt_id), mapOptions);

        var c = 0;
        var markers = [];
        var infoWindowContent = [];
        var marker_icons = [];
        $element.siblings('.tcvpb_google_map_marker').each(function(){
            var $marker = $(this);
            markers[c] = [$marker.data('title'), $marker.data('lat'),$marker.data('lng'),$marker.data('icon')];
            infoWindowContent[c] = ['<div class="info_content">' + '<h3>' + $marker.data('title') + '</h3>' + '<p>' + $marker.html() + '</p>' + '</div>'];
            c++;
        });

        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(), marker, i;

        // Loop through our array of markers & place each one on the map
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0],
                icon: markers[i][3]
            });
            // Allow each marker to have an info window
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));
        }
        if(auto_center_zoom){
            map.fitBounds(bounds);
        }
    }

    $('.tcvpb_google_map').each(function(){
        google.maps.event.addDomListener(window, 'load', initialize_gmap($(this)));
    });



    $(window).load(function() {
        /*********** Image Masonry ********************************************************/
        var $masonry_container = $('.tcvpb-image-masonry');
        $masonry_container.masonry({
          itemSelector: '.image-masonry',
        });

        tcvpb_animate_childrens();
        tcvpb_nivo_slider();
    });


    $(window).resize(function() {
        $(".tcvpb_knob_wrapper").each(function(){
            var $number_sign = $(this).find(".tcvpb_knob_number_sign");
            var canvas_width = $(this).find("canvas").width();
            $number_sign.css({
                'lineHeight' : canvas_width+'px',
            });
        });

        $('.tcvpb-video-bg').each(function(){
            tcvpb_resize_video_bg($(this));
        });

        tcvpb_tabs_responsive();

    });

});



/**
 * jQuery.browser.mobile (http://detectmobilebrowser.com/)
 *
 * jQuery.browser.mobile will be true if the browser is a mobile device
 *
 **/
(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);