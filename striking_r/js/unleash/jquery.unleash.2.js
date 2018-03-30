 /**
  * jQuery Unleash v2
  *
  * Accordion jQuery image slider
  *
  * Created by Ali Alaa 2011-2012
  *
  * http://themeforest.net/user/alialaa
  *
  */
 ;
 (function ($, window, document, undefined) {


     var pluginName = "unleash",
         defaults = {
             slide_height: 330,
             slide_width: 700,
             max_width: 1000,
             full_screen: false,
             rtl: false,
             Event: "click",
             duration: 700,
             slide_duration: 6000,
             initially_open_slide: 0,
             collapse_on_mouseout: false,
             easing: "easeOutQuad",
             container_class: '.unleash_container',
             captionTitleClassName: '.upper_text',
             captionClassName: '.lower_text',
             caption_animation: "double",
             double_dist: ["28%", "28%", "28%", "28%", "28%", "28%"],
             slideshow: true,
             hide_controls: false,
             pause_onmouseover: true,
             caption_animation_easing: "easeInOutBack"
         };

     // The actual plugin constructor

     function Plugin(element, options) {
         this.element = element;
         this.options = $.extend({}, defaults, options);
         this._defaults = defaults;
         this._name = pluginName;

         this.init();
     }

     Plugin.prototype = {

         init: function () {
             $this = this;
             $element = $(this.element);
             $opts = $this.options;

             animationProperties = {};

             if ($opts.rtl) {
                 direction = "right";
             } else {
                 direction = "left";
             }

             $this.construct();

             if ($opts.slideshow) {
                 $($opts.container_class).append(' <div class="unleash_loader_bg"><div class="unleash_loader"></div></div><div class="unleash_buttons"><div class="unleash_prev"></div><div class="unleash_play_pause"></div><div class="unleash_next"></div></div>');

                 $('.unleash_play_pause').addClass('unleash_pause');
                 if ($opts.initially_open_slide == 0) {
                     $this.OpenSlide(0);
                     opened = 1;
                 }
                 $this.play($opts.duration);
                 playing = true;
             } else {
                 $('.unleash_play_pause').addClass('unleash_play');
                 playing = false;
             }


             $('.unleash_play_pause').click(function () {
                 if ($('.unleash_loader').is(':animated')) {
                     $this.pause();
                     playing = false;
                 } else {
                     $this.play(0);
                     playing = true;
                 }
             });

             $('.unleash_next').click(function () {
                 $this.goToNext();

             });
             $('.unleash_prev').click(function () {
                 $this.goToPrev();
             });


             if ($opts.hide_controls) {
                 $('.unleash_buttons').hide()
             }

/*$element.children().hide();
			$(window).load(function() {
				$element.children().fadeIn(1200);
				});*/

             $(window).resize(function () {
                 $this.construct();
                 if (($opts.initially_open_slide == 0) && (opened == 0)) {
                     $this.CloseAll();
                 } else {
                     $this.OpenSlide($this.CurrentSlide());
                 }
             });

             $element.children(this).mouseover(function () {
                 if ($opts.pause_onmouseover) {
                     $this.pause();
                 }
                 if ($opts.hide_controls) {
                     $('.unleash_buttons').show()
                 }
             });

             switch ($opts.Event) {
             case "hover":

                 $element.children(this).hover(function () {
                     var slide = $(this).index() + 1;
                     var curr = $this.CurrentSlide();
					 opened = 1;
                     $this.OpenSlide(slide);
                     if (curr != slide) {

                         if ($opts.pause_onmouseover) {
                             $this.stopSlideshow();
                         } else {
                             $this.stopSlideshow();
                             $this.play($opts.duration);
                         }
                     }
                 });
                 break;
             case "click":
                 $element.children(this).click(function () {
                     var slide = $(this).index() + 1;
                     var curr = $this.CurrentSlide();
					 opened = 1;
                     $this.OpenSlide(slide);
                     if (curr != slide) {

                         if ($opts.pause_onmouseover) {
                             $this.stopSlideshow();
                         } else {
                             $this.stopSlideshow();
                             $this.play($opts.duration);
                         }
                     }
                 });
                 break;
             }

             $($opts.container_class).mouseleave(function () {
                 if ($opts.hide_controls) {
                     $('.unleash_buttons').hide()
                 }
             });

             $(this.element).mouseleave(function () {

                 if ($opts.collapse_on_mouseout) {
                     $this.CloseAll();
                 }
                 if ($opts.slideshow && playing) {
                     $this.play();
                 } else {
                     if ($opts.slideshow && !playing) {
                         $this.pause();
                     }
                 }
             });


             if ($opts.initially_open_slide != 0) {
                 $this.OpenSlide($opts.initially_open_slide);
             }


         },
         construct: function () {
             var $this = this,
                 $elem = $(this.element),
                 $opts = $this.options,
                 width = $elem.parent(this).innerWidth(),
                 slide_height = $opts.slide_height,
                 slide_width = $opts.slide_width,
                 max_width = $opts.max_width,
                 ratio = width / max_width,
                 height = ratio * width,
                 new_slide_width = Math.floor(slide_width * ratio),
                 new_slide_height = slide_height * ratio,
                 slides = $elem.children(this).length,
                 gap = (width) / (slides);

             caption_width = $opts.caption_width;
             caption_height = $opts.caption_height;

             if ($opts.full_screen) {
                 $elem.width($(window).width()).height($(window).height());
                 $elem.children(this).width(new_slide_width).height("100%");
             } else {
                 $elem.width(width).height(new_slide_height);
                 $elem.children(this).width(new_slide_width).height(new_slide_height);
             }




             $elem.find($opts.captionClassName).each(function (i) {
                 switch ($opts.caption_animation) {
                 case "pop-up":
                     $(this).css("bottom", -$(this).outerHeight(true) + "px");
                     break;
                 case "opacity":
                     $(this).css({
                         bottom: "0px",
                         opacity: 0
                     });
                     break;
                 case "rotate":
                     $this.rotate($(this), -90);
                     var marg = Math.floor($(this).css("margin-top").replace("px", ""));
                     $(this).css("bottom", (-$(this).outerWidth() / 2 - $(this).outerHeight(true) + marg) + "px");
                     break;
                 case "alwaysshow":
                     $(this).css("bottom", "0px");
                     break;
                 case "double":
                     $(this).css("bottom", -$(this).outerHeight(true) + "px");
                     $elem.find($opts.captionTitleClassName).css("top", -$(this).outerHeight(true) + "px");
                     break;
                 default:
                     $(this).css("bottom", -$(this).height() + "px");
                 }

             });

             $($elem.children(this)).each(function (i) {
                 $(this).css(
                 direction, (i * gap) + 'px');
             });

         },

         OpenSlide: function (slide) {
             var $this = this,
                 $opts = $this.options,
                 current_slider_width = $element.width(),
                 current_slide_width = $element.children(this).eq(slide - 1).width(),
                 slides = $element.children(this).length,
                 gap = (current_slider_width - current_slide_width) / (slides - 1);
             $element.children(this).removeClass('active');

             if (slide != 0) {
                 $element.children(this).eq(slide - 1).addClass('active');


                 $element.children(this).each(function (i) {

                     if ((i / (slide - 1)) > 1) {
                         s = current_slide_width - gap;

                     } else {
                         s = 0;
                     }
                     var val = (i * gap) + s + 'px';
                     animationProperties[direction] = val;
                     $(this).stop().animate(animationProperties, {
                         duration: $opts.duration,
                         easing: $opts.easing
                     });
                 });
                 this.AnimateCaption(slide);
             }
         },
         AnimateCaption: function (slide) {
             var $this = this,
                 $opts = $this.options;


             switch ($opts.caption_animation) {
             case "pop-up":
                 $element.find($opts.captionClassName).each(function (index) {
                     var $this = $(this);
                     $this.animate({
                         bottom: -$this.outerHeight(true)
                     }, {
                         queue: false,
                         duration: $opts.duration,
                         easing: $opts.caption_animation_easing
                     });
                 });
                 $element.find($opts.captionClassName).eq(slide - 1).animate({
                     bottom: '0px'
                 }, {
                     queue: false,
                     duration: $opts.duration,
                     easing: $opts.caption_animation_easing
                 });

                 break;
             case "opacity":
                 $element.find($opts.captionClassName).each(function (index) {
                     var $this = $(this);
                     $this.animate({
                         opacity: 0
                     }, {
                         queue: false,
                         duration: $opts.duration,
                         easing: $opts.caption_animation_easing
                     });
                 });
                 $element.find($opts.captionClassName).eq(slide - 1).animate({
                     opacity: 1
                 }, {
                     queue: false,
                     duration: $opts.duration,
                     easing: $opts.caption_animation_easing
                 });
                 break;
             case "rotate":

                 break;
             case "alwaysshow":
                 $(this).css("bottom", "0px");
                 break;
             case "double":


                 $element.find($opts.captionTitleClassName).each(function (index) {
                     var $this = $(this);
                     $this.animate({
                         top: -$(this).outerHeight(true)
                     }, {
                         queue: false,
                         duration: $opts.duration,
                         easing: $opts.caption_animation_easing
                     });
                 });
                 $element.find($opts.captionClassName).each(function (index) {
                     var $this = $(this);
                     $this.animate({
                         bottom: -$(this).outerHeight(true)
                     }, {
                         queue: false,
                         duration: $opts.duration,
                         easing: $opts.caption_animation_easing
                     });
                 });


                 $element.find($opts.captionTitleClassName).eq(slide - 1).animate({
                     top: $opts.double_dist[slide - 1]
                 }, {
                     queue: false,
                     duration: $opts.duration,
                     easing: $opts.caption_animation_easing
                 });

                 $element.find($opts.captionClassName).eq(slide - 1).animate({
                     bottom: $opts.double_dist[slide - 1]
                 }, {
                     queue: false,
                     duration: $opts.duration,
                     easing: $opts.caption_animation_easing
                 });

                 break;
             default:
             }


         },
         CloseAll: function () {
             var $this = this,
                 $opts = $this.options,
                 current_slider_width = $element.width(),
                 slides = $element.children(this).length,
                 gap = (current_slider_width) / (slides);


             $element.children(this).each(function (i) {
                 $(this).removeClass('active');

                 var val = (i * gap) + 'px'
                 animationProperties[direction] = val;
                 $(this).stop().animate(animationProperties, {
                     duration: $opts.duration,
                     easing: $opts.easing
                 });

             });

             switch ($opts.caption_animation) {
             case "pop-up":
                 $element.find($opts.captionClassName).each(function (index) {
                     var $this = $(this);
                     $this.animate({
                         bottom: -$this.outerHeight(true)
                     }, {
                         queue: false,
                         duration: $opts.duration,
                         easing: $opts.caption_animation_easing
                     });
                 });

                 break;
             case "opacity":
                 $element.find($opts.captionClassName).each(function (index) {
                     var $this = $(this);
                     $this.animate({
                         opacity: 0
                     }, {
                         queue: false,
                         duration: $opts.duration,
                         easing: $opts.caption_animation_easing
                     });
                 });
                 break;
             case "double":


                 $element.find($opts.captionTitleClassName).each(function (index) {
                     var $this = $(this);
                     $this.animate({
                         top: -$(this).outerHeight(true)
                     }, {
                         queue: false,
                         duration: $opts.duration,
                         easing: $opts.caption_animation_easing
                     });
                 });
                 $element.find($opts.captionClassName).each(function (index) {
                     var $this = $(this);
                     $this.animate({
                         bottom: -$(this).outerHeight(true)
                     }, {
                         queue: false,
                         duration: $opts.duration,
                         easing: $opts.caption_animation_easing
                     });
                 });

                 break;
             case "rotate":

                 break;
             case "alwaysshow":
                 $(this).css("bottom", "0px");
                 break;
             default:
             }

         },
         CurrentSlide: function () {
             var current = $element.find('.active').index();
             return current + 1;
         },
         NumberOfSlides: function () {
             var slides = $element.children().length;
             return slides;
         },
         next: function () {
             var $this = this,
                 slides = $this.NumberOfSlides(),
                 current = $this.CurrentSlide();

             if (current == slides) return 1;
             else return current + 1;

         },
         prev: function () {
             var $this = this,
                 slides = $this.NumberOfSlides(),
                 current = $this.CurrentSlide();

             if (current == 1) return slides;
             else return current - 1;
         },
         goToNext: function () {
             var $this = this;
             var nxt = $this.next();
             if ($('.unleash_loader').is(':animated')) {
                 $this.OpenSlide(nxt);
                 $this.pause();
                 $('.unleash_loader').css("left", "-100%");
                 $this.play($opts.duration);
             } else {
                 $this.OpenSlide(nxt);
                 $this.pause();
                 $('.unleash_loader').css("left", "-100%");
             }
         },
         goToPrev: function () {
             var $this = this;
             var prv = $this.prev();
             if ($('.unleash_loader').is(':animated')) {
                 $this.OpenSlide(prv);
                 $this.pause();
                 $('.unleash_loader').css("left", "-100%");
                 $this.play($opts.duration);
             } else {
                 $this.OpenSlide(prv);
                 $this.pause();
                 $('.unleash_loader').css("left", "-100%");
             }
         },
         play: function (delay) {
             var $this = this,
                 $this = this,
                 $opts = $this.options,
                 remaining_dur = Math.abs($('.unleash_loader').position().left / $('.unleash_loader').width()),
                 duration = remaining_dur * $opts.slide_duration;
             $('.unleash_play_pause').addClass('unleash_pause').removeClass('unleash_play');

/*if( $this.CurrentSlide() == 0) {
				$this.OpenSlide(1)
				}*/


             for (i = 0; i <= 100; i++) {
                 $('.unleash_loader').delay(delay).animate({
                     left: "0%"
                 }, {
                     queue: true,
                     duration: duration,
                     easing: "linear",

                     complete: function () {
                         var nxt = $this.next();
                         $this.OpenSlide(nxt);
                         $('.unleash_loader').css("left", "-100%");

                     }

                 });
                 duration = $opts.slide_duration;
             }


         },
         pause: function () {
             var $this = this,
                 $this = this,
                 $opts = $this.options,
                 duration = $opts.slide_duration;

             $('.unleash_play_pause').addClass('unleash_play').removeClass('unleash_pause');
             $('.unleash_loader').stop(true);

         },
         stopSlideshow: function () {
             var $this = this;
             $this.pause();
             $('.unleash_loader').css("left", "-100%");

         }


     },



     $.fn[pluginName] = function (options) {
         return this.each(function () {
             if (!$.data(this, "plugin_" + pluginName)) {
                 $.data(this, "plugin_" + pluginName, new Plugin(this, options));
             }
         });
     }

 })(jQuery, window, document);