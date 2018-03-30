/*jshint ignore:start */
document.documentElement.className += ' js_active ';
document.documentElement.className += 'ontouchstart' in document.documentElement ? ' vc_mobile ' : ' vc_desktop ';
(function(){
    var prefix = ['-webkit-','-o-','-moz-','-ms-',""];
    for (var i in prefix) { if(prefix[i]+'transform' in document.documentElement.style) document.documentElement.className += " vc_transform "; }
})();
/*
   On document ready jQuery will fire set of functions.
   If you want to override function behavior then copy it to your theme js file
   with the same name.
*/

jQuery(window).load(function() {

});
var vc_js = function() {
  vc_twitterBehaviour();
  vc_toggleBehaviour();
  vc_tabsBehaviour();
  vc_accordionBehaviour();
  vc_teaserGrid();
  vc_carouselBehaviour();
  vc_slidersBehaviour();
  vc_prettyPhoto();
  vc_googleplus();
  vc_pinterest();
  vc_progress_bar();
  vc_plugin_flexslider();
  window.setTimeout(vc_waypoints, 1500);
};
jQuery(document).ready(function($) {
    //PIRENKO
    //window.vc_js();
}); // END jQuery(document).ready

if ( typeof window['vc_plugin_flexslider'] !== 'function' ) {
    //PIRENKO
 function vc_plugin_flexslider() {
   /*jQuery('.wpb_flexslider').each(function() {
     var this_element = jQuery(this);
     var sliderSpeed = 800,
       sliderTimeout = parseInt(this_element.attr('data-interval'))*1000,
       sliderFx = this_element.attr('data-flex_fx'),
       slideshow = true;
     if ( sliderTimeout == 0 ) slideshow = false;

     this_element.flexslider({
       animation: sliderFx,
       slideshow: slideshow,
       slideshowSpeed: sliderTimeout,
       sliderSpeed: sliderSpeed,
       smoothHeight: true
     });
   });*/
 }
}

  /* Twitter
 ---------------------------------------------------------- */
if ( typeof window['vc_twitterBehaviour'] !== 'function' ) {
    function vc_twitterBehaviour() {
        jQuery('.wpb_twitter_widget .tweets').each(function(index) {
            var this_element = jQuery(this),
                tw_name = this_element.attr('data-tw_name');
                tw_count = this_element.attr('data-tw_count');

            this_element.tweet({
                username: tw_name,
                join_text: "auto",
                avatar_size: 0,
                count: tw_count,
                template: "{avatar}{join}{text}{time}",
                auto_join_text_default: "",
                auto_join_text_ed: "",
                auto_join_text_ing: "",
                auto_join_text_reply: "",
                auto_join_text_url: "",
                loading_text: '<span class="loading_tweets">loading tweets...</span>'
            });
        });
    }
}

/* Google plus
---------------------------------------------------------- */
if ( typeof window['vc_googleplus'] !== 'function' ) {
    function vc_googleplus() {
        if ( jQuery('.wpb_googleplus').length > 0 ) {
            (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
            })();
        }
    }
}

/* Pinterest
---------------------------------------------------------- */
if ( typeof window['vc_pinterest'] !== 'function' ) {
    function vc_pinterest() {
        if ( jQuery('.wpb_pinterest').length > 0 ) {
            (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'http://assets.pinterest.com/js/pinit.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                //<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
            })();
        }
    }
}

/* Progress bar
---------------------------------------------------------- */
if ( typeof window['vc_progress_bar'] !== 'function' ) {
  function vc_progress_bar() { 
    if (typeof jQuery.fn.waypoint !== 'undefined') {

        jQuery('.vc_progress_bar').waypoint(function() {
            jQuery(this).find('.vc_single_bar').each(function(index) {
            var $this = jQuery(this),
                bar = $this.find('.vc_bar'),
                val = bar.data('percentage-value');

              setTimeout(function(){ bar.css({"width" : val+'%'}); }, index*200);
            });
        }, { offset: '85%' });
    }
  }
}

/* Waypoints magic
---------------------------------------------------------- */
if ( typeof window['vc_waypoints'] !== 'function' ) {
  function vc_waypoints() {
      if (typeof jQuery.fn.waypoint !== 'undefined') {
          //NO ANIMS ON MOBILE
          if (is_mobile()) {
              jQuery('.wpb_animate_when_almost_visible').removeClass('wpb_animate_when_almost_visible');

          }
          else {
              jQuery('.wpb_animate_when_almost_visible:not(.wpb_start_animation,.vrv_manual_anim)').waypoint(function() {
                  var $this_el=jQuery(this);
                  if (!$this_el.is('[class*="delay-"]')) {
                      setTimeout(function() {
                        $this_el.addClass('wpb_start_animation');
                      },parseInt(delayer,10)+300);
                  }
                  else {
                      var classes = $this_el.attr("class").split(" ");
                      var delayer=0;
                      for (var i = 0; i < classes.length; i++) {
                          if ( classes[i].substr(0,6) === "delay-" ) { 
                              delayer=classes[i].substr(6,classes[i].length);
                              break; 
                          } 
                      }
                      setTimeout(function() {
                          $this_el.addClass('wpb_start_animation');
                      },parseInt(delayer,10)+100);
                  }
              }, { offset: '90%' });
          }
      }
    }
}

/* Toggle
---------------------------------------------------------- */
if ( typeof window['vc_toggleBehaviour'] !== 'function' ) {
    function vc_toggleBehaviour() {
        jQuery(".wpb_toggle").unbind('click').click(function(e) {
      if(jQuery(this).next().is(':animated')) {
        return false;
      }
            if ( jQuery(this).hasClass('wpb_toggle_title_active') ) {
                jQuery(this).removeClass('wpb_toggle_title_active').next().slideUp(500);
            } else {
                jQuery(this).addClass('wpb_toggle_title_active').next().slideDown(500);
            }
        });
        jQuery('.wpb_toggle_content').each(function(index) {
            if ( jQuery(this).next().is('h4.wpb_toggle') == false ) {
                jQuery('<div class="last_toggle_el_margin"></div>').insertAfter(this);
            }
        });
    }
}

/* Tabs + Tours
---------------------------------------------------------- */
if ( typeof window['vc_tabsBehaviour'] !== 'function' ) {
    function vc_tabsBehaviour($tab) {
        //PIRENKO
        jQuery(function($){$(document.body).off('click.preview', 'a')});
        jQuery('.wpb_tabs, .wpb_tour').each(function(index) {
            var $tabs,
                interval = jQuery(this).attr("data-interval"),
                tabs_array = [];
            //
            $tabs = jQuery(this).find('.wpb_tour_tabs_wrapper').tabs({
                show: function(event, ui) {},
                beforeActivate: function(event, ui) {
                    var panel = ui.panel || ui.newPanel;
                    jQuery(window).trigger("debouncedresize");
                    jQuery(window).trigger( "smartresize");
                    jQuery(panel).parent().find('li.ui-state-default').not('li.ui-state-hover').stop().animate({
                            backgroundColor:theme_options.background_color,
                    },200);
                    },
                activate: function(event, ui) {
                    var panel = ui.panel || ui.newPanel;
                    jQuery(window).trigger("debouncedresize");
                    jQuery(window).trigger( "smartresize");
                    jQuery(panel).parent().find('li.ui-state-default').not('li.ui-state-active,li.ui-state-hover').stop().animate({
                            backgroundColor:theme_options.background_color,
                    },200);
                    }
                });

            jQuery(this).find('.wpb_tab').each(function(){ tabs_array.push(this.id); });
        });
    }
}

/* Tabs + Tours
---------------------------------------------------------- */
if ( typeof window['vc_accordionBehaviour'] !== 'function' ) {
    function vc_accordionBehaviour() {
        //PIRENKO
        jQuery('.wpb_accordion').each(function(index) {
            var $tabs,
                interval = jQuery(this).attr("data-interval"),
                active_tab = !isNaN(jQuery(this).data('active-tab')) && parseInt(jQuery(this).data('active-tab')) >  0 ? parseInt(jQuery(this).data('active-tab'))-1 : false,
                collapsible =  active_tab === false || jQuery(this).data('collapsible') === 'yes';
            //
            var ac_icons = {
                header: "icon-plus-3",
                activeHeader: "icon-minus-1"
            };
            $tabs = jQuery(this).find('.wpb_accordion_wrapper').accordion({
                header: "> div > h3",
                icons: ac_icons,
                autoHeight: false,
                heightStyle: "content",
                active: active_tab,
                collapsible: true,
                navigation: true,
                activate: function(event, ui){
                    jQuery(window).trigger("debouncedresize");
                    jQuery(window).trigger( "smartresize");
                    vc_carouselBehaviour();
                }
            });
            //.tabs().tabs('rotate', interval*1000, true);
        });
    }
}

/* Teaser grid: isotope
---------------------------------------------------------- */
if ( typeof window['vc_teaserGrid'] !== 'function' ) {
    function vc_teaserGrid() {
        var layout_modes = {
            fitrows: 'fitRows',
            masonry: 'masonry'
        }
        jQuery('.wpb_grid .teaser_grid_container:not(.wpb_carousel), .wpb_filtered_grid .teaser_grid_container:not(.wpb_carousel)').each(function(){
            var $container = jQuery(this);
            var $thumbs = $container.find('.wpb_thumbnails');
            var layout_mode = $thumbs.attr('data-layout-mode');
            $thumbs.isotope({
                // options
                itemSelector : '.isotope-item',
                layoutMode : (layout_modes[layout_mode]==undefined ? 'fitRows' : layout_modes[layout_mode])
            });
            $container.find('.categories_filter a').data('isotope', $thumbs).click(function(e){
                e.preventDefault();
                var $thumbs = jQuery(this).data('isotope');
                jQuery(this).parent().parent().find('.active').removeClass('active');
                jQuery(this).parent().addClass('active');
                $thumbs.isotope({filter: jQuery(this).attr('data-filter')});
            });
            jQuery(window).bind('load resize', function() {
                $thumbs.isotope("reLayout");
            });
        });

        /*
        var isotope = jQuery('.wpb_grid ul.thumbnails');
        if ( isotope.length > 0 ) {
            isotope.isotope({
                // options
                itemSelector : '.isotope-item',
                layoutMode : 'fitRows'
            });
            jQuery(window).load(function() {
                isotope.isotope("reLayout");
            });
        }
        */
    }
}

if ( typeof window['vc_carouselBehaviour'] !== 'function' ) {
  function vc_carouselBehaviour() {
    jQuery(".wpb_carousel").each(function() {
            var $this = jQuery(this);
            if($this.data('carousel_enabled') !== true && $this.is(':visible')) {
                $this.data('carousel_enabled', true);
                var carousel_width = jQuery(this).width(),
                    visible_count = getColumnsCount(jQuery(this)),
                    carousel_speed = 500;
                if ( jQuery(this).hasClass('columns_count_1') ) {
                    carousel_speed = 900;
                }
                /* Get margin-left value from the css grid and apply it to the carousele li items (margin-right), before carousele initialization */
                var carousele_li = jQuery(this).find('.wpb_thumbnails-fluid li');
                carousele_li.css({"margin-right": carousele_li.css("margin-left"), "margin-left" : 0 });

                jQuery(this).find('.wpb_wrapper:eq(0)').jCarouselLite({
                    btnNext: jQuery(this).find('.next'),
                    btnPrev: jQuery(this).find('.prev'),
                    visible: visible_count,
                    speed: carousel_speed
                })
                    .width('100%');//carousel_width

                var fluid_ul = jQuery(this).find('ul.wpb_thumbnails-fluid');
                fluid_ul.width(fluid_ul.width()+300);

                jQuery(window).resize(function() {
                    var before_resize = screen_size;
                    screen_size = getSizeName();
                    if ( before_resize != screen_size ) {
                        window.setTimeout('location.reload()', 20);
                    }
                });
            }

    });
        /*
        if(jQuery.fn.bxSlider !== undefined ) {
            jQuery('.bxslider').each(function(){
               var $slider = jQuery(this);
               $slider.bxSlider($slider.data('settings'));
            });
        }
        */
        if(window.Swiper !== undefined) {

            jQuery('.swiper-container').each(function(){
                var $this = jQuery(this),
                    my_swiper,
                    max_slide_size = 0,
                    options = jQuery(this).data('settings');

                    if(options.mode === 'vertical') {
                        $this.find('.swiper-slide').each(function(){
                            var height = jQuery(this).outerHeight(true);
                            if(height > max_slide_size) max_slide_size = height;
                        });
                        $this.height(max_slide_size);
                        $this.css('overflow', 'hidden');
                    }
                    jQuery(window).resize(function(){
                        $this.find('.swiper-slide').each(function(){
                            var height = jQuery(this).outerHeight(true);
                            if(height > max_slide_size) max_slide_size = height;
                        });
                        $this.height(max_slide_size);
                    });
                    my_swiper = jQuery(this).swiper(jQuery.extend(options, {
                    onFirstInit: function(swiper) {
                        if(swiper.slides.length < 2) {
                            $this.find('.vc-arrow-left,.vc-arrow-right').hide();
                        } else if(swiper.activeIndex === 0  && swiper.params.loop !== true) {
                            $this.find('.vc-arrow-left').hide();
                        } else {
                            $this.find('.vc-arrow-left').show();
                        }
                    },
                    onSlideChangeStart: function(swiper) {
                        if(swiper.slides.length > 1 && swiper.params.loop !== true) {
                            if(swiper.activeIndex === 0) {
                                $this.find('.vc-arrow-left').hide();
                            } else {
                                $this.find('.vc-arrow-left').show();
                            }
                            if(swiper.slides.length-1 === swiper.activeIndex) {
                                $this.find('.vc-arrow-right').hide();
                            } else {
                                $this.find('.vc-arrow-right').show();
                            }
                        }
                    }
                }));
                $this.find('.vc-arrow-left').click(function(e){
                    e.preventDefault();
                    my_swiper.swipePrev();
                });
                $this.find('.vc-arrow-right').click(function(e){
                    e.preventDefault();
                    my_swiper.swipeNext();
                });
                my_swiper.reInit();
            });

        }

    }
}
//PIRENKO
if ( typeof window['vc_slidersBehaviour'] !== 'function' ) {
    function vc_slidersBehaviour() {
       } 
}

if ( typeof window['vc_prettyPhoto'] !== 'function' ) {
    function vc_prettyPhoto() {}
}
/* Helper
 ---------------------------------------------------------- */
function getColumnsCount(el) {
  var find = false,
    i = 1;

  while (find == false) {
    if (el.hasClass('columns_count_' + i)) {
      find = true;
      return i;
    }
    i++;
  }
}

var screen_size = getSizeName();
function getSizeName() {
  var screen_size = '',
    screen_w = jQuery(window).width();

  if (screen_w > 1170) {
    screen_size = "desktop_wide";
  }
  else if (screen_w > 960 && screen_w < 1169) {
    screen_size = "desktop";
  }
  else if (screen_w > 768 && screen_w < 959) {
    screen_size = "tablet";
  }
  else if (screen_w > 300 && screen_w < 767) {
    screen_size = "mobile";
  }
  else if (screen_w < 300) {
    screen_size = "mobile_portrait";
  }
  return screen_size;
}


function loadScript(url, $obj, callback) {

  var script = document.createElement("script")
  script.type = "text/javascript";

  if (script.readyState) {  //IE
    script.onreadystatechange = function () {
      if (script.readyState == "loaded" ||
        script.readyState == "complete") {
        script.onreadystatechange = null;
        callback();
      }
    };
  } else {  //Others
    /*
     script.onload = function(){

     callback();
     };
     */
  }

  script.src = url;
  $obj.get(0).appendChild(script);
}

/**
 * Prepare html to correctly display inside tab container
 *
 * @param event - ui tab event 'show'
 * @param ui - jquery ui tabs object
 */

function wpb_prepare_tab_content(event, ui) {
  var panel = ui.panel || ui.newPanel,
      $pie_charts = panel.find('.vc_pie_chart:not(.vc_ready)'),
      $carousel = panel.find('[data-ride="vc_carousel"]'),
      $ui_panel, $google_maps;
  vc_carouselBehaviour();
  vc_plugin_flexslider(panel);
  $pie_charts.length && jQuery.fn.vcChat && $pie_charts.vcChat();
  $carousel.length && jQuery.fn.carousel && $carousel.carousel('resizeAction');
  $ui_panel = panel.find('.isotope');
  $google_maps = panel.find('.wpb_gmaps_widget');
  if ($ui_panel.length > 0) {
    $ui_panel.isotope("layout");
  }
  if ($google_maps.length && !$google_maps.is('.map_ready')) {
    var $frame = $google_maps.find('iframe');
    $frame.attr('src', $frame.attr('src'));
    $google_maps.addClass('map_ready');
  }
  if(panel.parents('.isotope').length) {
    panel.parents('.isotope').each(function(){
      jQuery(this).isotope("layout");
    });
  }
}

+function($){"use strict";function Plugin(action,options){var args;return args=Array.prototype.slice.call(arguments,1),this.each(function(){var $this,data;$this=$(this),data=$this.data("vc.accordion"),data||(data=new Accordion($this,$.extend(!0,{},options)),$this.data("vc.accordion",data)),"string"==typeof action&&data[action].apply(data,args)})}var Accordion,clickHandler,old,hashNavigation;Accordion=function($element,options){this.$element=$element,this.activeClass="vc_active",this.animatingClass="vc_animating",this.useCacheFlag=void 0,this.$target=void 0,this.$targetContent=void 0,this.selector=void 0,this.$container=void 0,this.animationDuration=void 0,this.index=0},Accordion.transitionEvent=function(){var transition,transitions,el;el=document.createElement("vcFakeElement"),transitions={transition:"transitionend",MSTransition:"msTransitionEnd",MozTransition:"transitionend",WebkitTransition:"webkitTransitionEnd"};for(transition in transitions)if("undefined"!=typeof el.style[transition])return transitions[transition]},Accordion.emulateTransitionEnd=function($el,duration){var callback,called;called=!1,duration||(duration=250),$el.one(Accordion.transitionName,function(){called=!0}),callback=function(){called||$el.trigger(Accordion.transitionName)},setTimeout(callback,duration)},Accordion.DEFAULT_TYPE="collapse",Accordion.transitionName=Accordion.transitionEvent(),Accordion.prototype.controller=function(action){var $this;$this=this.$element,"string"!=typeof action&&(action=$this.data("vcAction")||this.getContainer().data("vcAction")),"undefined"==typeof action&&(action=Accordion.DEFAULT_TYPE),"string"==typeof action&&Plugin.call($this,action)},Accordion.prototype.isCacheUsed=function(){var useCache,that;return that=this,useCache=function(){return!1!==that.$element.data("vcUseCache")},"undefined"==typeof this.useCacheFlag&&(this.useCacheFlag=useCache()),this.useCacheFlag},Accordion.prototype.getSelector=function(){var findSelector,$this;return $this=this.$element,findSelector=function(){var selector;return selector=$this.data("vcTarget"),selector||(selector=$this.attr("href")),selector},this.isCacheUsed()?("undefined"==typeof this.selector&&(this.selector=findSelector()),this.selector):findSelector()},Accordion.prototype.findContainer=function(){var $container;return $container=this.$element.closest(this.$element.data("vcContainer")),$container.length||($container=$("body")),$container},Accordion.prototype.getContainer=function(){return this.isCacheUsed()?("undefined"==typeof this.$container&&(this.$container=this.findContainer()),this.$container):this.findContainer()},Accordion.prototype.getTarget=function(){var selector,that,getTarget;return that=this,selector=that.getSelector(),getTarget=function(){var element;return element=that.getContainer().find(selector),element.length||(element=that.getContainer().filter(selector)),element},this.isCacheUsed()?("undefined"==typeof this.$target&&(this.$target=getTarget()),this.$target):getTarget()},Accordion.prototype.getTargetContent=function(){var $target,$targetContent;return $target=this.getTarget(),this.isCacheUsed()?("undefined"==typeof this.$targetContent&&($targetContent=$target,$target.data("vcContent")&&($targetContent=$target.find($target.data("vcContent")),$targetContent.length||($targetContent=$target)),this.$targetContent=$targetContent),this.$targetContent):$target.data("vcContent")&&($targetContent=$target.find($target.data("vcContent")),$targetContent.length)?$targetContent:$target},Accordion.prototype.getTriggers=function(){var i;return i=0,this.getContainer().find("[data-vc-accordion]").each(function(){var accordion,$this;$this=$(this),accordion=$this.data("vc.accordion"),"undefined"==typeof accordion&&($this.vcAccordion(),accordion=$this.data("vc.accordion")),accordion&&accordion.setIndex&&accordion.setIndex(i++)})},Accordion.prototype.setIndex=function(index){this.index=index},Accordion.prototype.getIndex=function(){return this.index},Accordion.prototype.triggerEvent=function(event){var $event;"string"==typeof event&&($event=$.Event(event),this.$element.trigger($event))},Accordion.prototype.getActiveTriggers=function(){var $triggers;return $triggers=this.getTriggers().filter(function(){var $this,accordion;return $this=$(this),accordion=$this.data("vc.accordion"),accordion.getTarget().hasClass(accordion.activeClass)})},Accordion.prototype.changeLocationHash=function(){var id,$target;$target=this.getTarget(),$target.length&&(id=$target.attr("id")),id&&(history.pushState?history.pushState(null,null,"#"+id):location.hash="#"+id)},Accordion.prototype.isActive=function(){return this.getTarget().hasClass(this.activeClass)},Accordion.prototype.getAnimationDuration=function(){var findAnimationDuration,that;return that=this,findAnimationDuration=function(){var $targetContent,duration;return"undefined"==typeof Accordion.transitionName?"0s":($targetContent=that.getTargetContent(),duration=$targetContent.css("transition-duration"),duration=duration.split(",")[0])},this.isCacheUsed()?("undefined"==typeof this.animationDuration&&(this.animationDuration=findAnimationDuration()),this.animationDuration):findAnimationDuration()},Accordion.prototype.getAnimationDurationMilliseconds=function(){var duration;return duration=this.getAnimationDuration(),"ms"===duration.substr(-2)?parseInt(duration):"s"===duration.substr(-1)?Math.round(1e3*parseFloat(duration)):void 0},Accordion.prototype.isAnimated=function(){return parseFloat(this.getAnimationDuration())>0},Accordion.prototype.show=function(){var $target,that,$targetContent;that=this,$target=that.getTarget(),$targetContent=that.getTargetContent(),that.isActive()||(that.isAnimated()?(that.triggerEvent("beforeShow.vc.accordion"),$target.queue(function(next){$targetContent.one(Accordion.transitionName,function(){$target.removeClass(that.animatingClass),$targetContent.attr("style",""),that.triggerEvent("afterShow.vc.accordion")}),Accordion.emulateTransitionEnd($targetContent,that.getAnimationDurationMilliseconds()+100),next()}).queue(function(next){$targetContent.attr("style",""),$targetContent.css({position:"absolute",visibility:"hidden",display:"block"});var height=$targetContent.height();$targetContent.data("vcHeight",height),$targetContent.attr("style",""),next()}).queue(function(next){$targetContent.height(0),$targetContent.css({"padding-top":0,"padding-bottom":0}),next()}).queue(function(next){$target.addClass(that.animatingClass),$target.addClass(that.activeClass),that.changeLocationHash(),that.triggerEvent("show.vc.accordion"),next()}).queue(function(next){var height=$targetContent.data("vcHeight");$targetContent.animate({height:height},{duration:that.getAnimationDurationMilliseconds(),complete:function(){$targetContent.data("events")||$targetContent.attr("style","")}}),$targetContent.css({"padding-top":"","padding-bottom":""}),next()})):($target.addClass(that.activeClass),that.triggerEvent("show.vc.accordion")))},Accordion.prototype.hide=function(){var $target,that,$targetContent;that=this,$target=that.getTarget(),$targetContent=that.getTargetContent(),that.isActive()&&(that.isAnimated()?(that.triggerEvent("beforeHide.vc.accordion"),$target.queue(function(next){$targetContent.one(Accordion.transitionName,function(){$target.removeClass(that.animatingClass),$targetContent.attr("style",""),that.triggerEvent("afterHide.vc.accordion")}),Accordion.emulateTransitionEnd($targetContent,that.getAnimationDurationMilliseconds()+100),next()}).queue(function(next){$target.addClass(that.animatingClass),$target.removeClass(that.activeClass),that.triggerEvent("hide.vc.accordion"),next()}).queue(function(next){var height=$targetContent.height();$targetContent.height(height),next()}).queue(function(next){$targetContent.animate({height:0},that.getAnimationDurationMilliseconds()),$targetContent.css({"padding-top":0,"padding-bottom":0}),next()})):($target.removeClass(that.activeClass),that.triggerEvent("hide.vc.accordion")))},Accordion.prototype.toggle=function(){var $this;$this=this.$element,this.isActive()?Plugin.call($this,"hide"):Plugin.call($this,"show")},Accordion.prototype.dropdown=function(){var $this,that;that=this,$this=this.$element,this.isActive()?Plugin.call($this,"hide"):(Plugin.call($this,"show"),$(document).on("click.vc.accordion.data-api.dropdown",function(e){var isTarget;isTarget=$(e.target).closest(that.getTarget()).length,isTarget||(Plugin.call($this,"hide"),$(document).off(e))}))},Accordion.prototype.collapse=function(){var $this,$triggers;$this=this.$element,$triggers=this.getActiveTriggers().filter(function(){return $this[0]!==this}),$triggers.length&&Plugin.call($triggers,"hide"),Plugin.call($this,"show")},Accordion.prototype.collapseAll=function(){var $this,$triggers;$this=this.$element,$triggers=this.getActiveTriggers().filter(function(){return $this[0]!==this}),$triggers.length&&Plugin.call($triggers,"hide"),Plugin.call($this,"toggle")},Accordion.prototype.showNext=function(){var $triggers,$activeTriggers,activeIndex;if($triggers=this.getTriggers(),$activeTriggers=this.getActiveTriggers(),$triggers.length){if($activeTriggers.length){var lastActiveAccordion;lastActiveAccordion=$activeTriggers.eq($activeTriggers.length-1).vcAccordion().data("vc.accordion"),lastActiveAccordion&&lastActiveAccordion.getIndex&&(activeIndex=lastActiveAccordion.getIndex())}activeIndex>-1&&activeIndex+1<$triggers.length?Plugin.call($triggers.eq(activeIndex+1),"controller"):Plugin.call($triggers.eq(0),"controller")}},Accordion.prototype.showPrev=function(){var $triggers,$activeTriggers,activeIndex;if($triggers=this.getTriggers(),$activeTriggers=this.getActiveTriggers(),$triggers.length){if($activeTriggers.length){var lastActiveAccordion;lastActiveAccordion=$activeTriggers.eq($activeTriggers.length-1).vcAccordion().data("vc.accordion"),lastActiveAccordion&&lastActiveAccordion.getIndex&&(activeIndex=lastActiveAccordion.getIndex())}activeIndex>-1?activeIndex-1>=0?Plugin.call($triggers.eq(activeIndex-1),"controller"):Plugin.call($triggers.eq($triggers.length-1),"controller"):Plugin.call($triggers.eq(0),"controller")}},Accordion.prototype.showAt=function(index){var $triggers;$triggers=this.getTriggers(),$triggers.length&&index&&index<$triggers.length&&Plugin.call($triggers.eq(index),"controller")},Accordion.prototype.scrollToActive=function(){var that,$targetElement,offset,delay,speed;that=this,offset=1,delay=300,speed=300,$targetElement=$(this.getTarget()),$targetElement.length&&this.$element.length&&setTimeout(function(){var posY=$targetElement.offset().top-$(window).scrollTop()-that.$element.outerHeight()*offset;0>posY&&$("html, body").animate({scrollTop:$targetElement.offset().top-that.$element.outerHeight()*offset},speed)},delay)},old=$.fn.vcAccordion,$.fn.vcAccordion=Plugin,$.fn.vcAccordion.Constructor=Accordion,$.fn.vcAccordion.noConflict=function(){return $.fn.vcAccordion=old,this},clickHandler=function(e){var $this;$this=$(this),e.preventDefault(),Plugin.call($this,"controller")},hashNavigation=function(){
  //REMOVE CONFLICT WITH THEME SINGLE PORTFOLIO PAGES
  /*var hash,$targetElement,$accordion,offset,delay,speed;
  offset=.2,delay=300,speed=0,hash=window.location.hash,hash&&($targetElement=$(hash),$targetElement.length&&($accordion=$targetElement.find("[data-vc-accordion][href="+hash+"],[data-vc-accordion][data-vc-target="+hash+"]"),$accordion.length&&(setTimeout(function(){$("html, body").animate({scrollTop:$targetElement.offset().top-$(window).height()*offset},speed)},delay),$accordion.trigger("click"))))*/
},window.addEventListener("hashchange",hashNavigation,!1),$(document).on("click.vc.accordion.data-api","[data-vc-accordion]",clickHandler),$(document).ready(hashNavigation),$(document).on("afterShow.vc.accordion",function(e){Plugin.call($(e.target),"scrollToActive")})}(window.jQuery);


/* =========================================================
 * vc-tabs.js v1.0.0
 * =========================================================
 * Copyright 2013 Wpbakery
 *
 * Visual composer Tabs
 * ========================================================= */
+ function ( $ ) {
  'use strict';

  var Tabs, old, clickHandler, changeHandler;

  /**
   * Tabs object definition
   * @param element
   * @constructor
   */
  Tabs = function ( element, options ) {
    this.$element = $( element );
    this.activeClass = 'vc_active';
    this.tabSelector = '[data-vc-tab]';

    // cached vars
    this.useCacheFlag = undefined;
    this.$target = undefined;
    this.selector = undefined;
    this.$targetTab = undefined;
    this.$relatedAccordion = undefined;
    this.$container = undefined;
  };

  /**
   * Is cache used
   * @returns {boolean}
   */
  Tabs.prototype.isCacheUsed = function () {
    var useCache, that;
    that = this;
    useCache = function () {
      return false !== that.$element.data( 'vcUseCache' );
    };

    if ( undefined === this.useCacheFlag ) {
      this.useCacheFlag = useCache();
    }

    return this.useCacheFlag;
  };

  /**
   * Get container
   * @returns {*|Number}
   */
  Tabs.prototype.getContainer = function () {
    if ( ! this.isCacheUsed() ) {
      return this.findContainer();
    }

    if ( undefined === this.$container ) {
      this.$container = this.findContainer();
    }

    return this.$container;
  };

  /**
   * Find container
   * @returns {window.jQuery}
   */
  Tabs.prototype.findContainer = function () {
    var $container;
    $container = this.$element.closest( this.$element.data( 'vcContainer' ) );
    if ( ! $container.length ) {
      $container = $( 'body' );
    }
    return $container;
  };

  /**
   * Get container accordions
   * @returns {*}
   */
  Tabs.prototype.getContainerAccordion = function () {
    return this.getContainer().find( '[data-vc-accordion]' );
  };

  /**
   * Get selector
   * @returns {*}
   */
  Tabs.prototype.getSelector = function () {
    var findSelector, $this;

    $this = this.$element;
    findSelector = function () {
      var selector;

      selector = $this.data( 'vcTarget' );
      if ( ! selector ) {
        selector = $this.attr( 'href' );
      }

      return selector;
    };

    if ( ! this.isCacheUsed() ) {
      return findSelector();
    }

    if ( undefined === this.selector ) {
      this.selector = findSelector();
    }

    return this.selector;
  };

  /**
   * Get target
   * @returns {*}
   */
  Tabs.prototype.getTarget = function () {
    var selector;
    selector = this.getSelector();

    if ( ! this.isCacheUsed() ) {
      return this.getContainer().find( selector );
    }

    if ( undefined === this.$target ) {
      this.$target = this.getContainer().find( selector );
    }

    return this.$target;
  };

  /**
   * Get related accordion
   * @returns {*}
   */
  Tabs.prototype.getRelatedAccordion = function () {
    var tab, filterElements;

    tab = this;

    filterElements = function () {
      var $elements;

      $elements = tab.getContainerAccordion().filter( function () {
        var $that, accordion;
        $that = $( this );

        accordion = $that.data( 'vc.accordion' );

        if ( undefined === accordion ) {
          $that.vcAccordion();
          accordion = $that.data( 'vc.accordion' );
        }

        return tab.getSelector() === accordion.getSelector();
      } );

      if ( $elements.length ) {
        return $elements;
      }

      return undefined;
    };
    if ( ! this.isCacheUsed() ) {
      return filterElements();
    }

    if ( undefined === this.$relatedAccordion ) {
      this.$relatedAccordion = filterElements();
    }

    return this.$relatedAccordion;
  };

  /**
   * Trigger event
   * @param event
   */
  Tabs.prototype.triggerEvent = function ( event ) {
    var $event;
    if ( 'string' === typeof event ) {
      $event = $.Event( event );
      this.$element.trigger( $event );
    }
  };

  /**
   * Get target tab
   * @returns {*|Number}
   */
  Tabs.prototype.getTargetTab = function () {
    var $this;
    $this = this.$element;

    if ( ! this.isCacheUsed() ) {
      return $this.closest( this.tabSelector );
    }

    if ( undefined === this.$targetTab ) {
      this.$targetTab = $this.closest( this.tabSelector );
    }

    return this.$targetTab;
  };

  /**
   * Tab Clicked
   */
  Tabs.prototype.tabClick = function () {

    this.getRelatedAccordion().trigger( 'click' );
  };

  /**
   * Tab Show
   */
  Tabs.prototype.show = function () {
    // if showed no need to do anything
    if ( this.getTargetTab().hasClass( this.activeClass ) ) {
      return;
    }

    this.triggerEvent( 'show.vc.tab' );

    this.getTargetTab().addClass( this.activeClass );
  };

  /**
   * Tab Hide
   */
  Tabs.prototype.hide = function () {
    // if showed no need to do anything
    if ( ! this.getTargetTab().hasClass( this.activeClass ) ) {
      return;
    }

    this.triggerEvent( 'hide.vc.tab' );

    this.getTargetTab().removeClass( this.activeClass );
  };

  //Tabs.prototype

  // Tabs plugin definition
  // ==========================
  function Plugin( action, options ) {
    var args;

    args = Array.prototype.slice.call( arguments, 1 );
    return this.each( function () {
      var $this, data;

      $this = $( this );
      data = $this.data( 'vc.tabs' );
      if ( ! data ) {
        data = new Tabs( $this, $.extend( true, {}, options ) );
        $this.data( 'vc.tabs', data );
      }
      if ( 'string' === typeof action ) {
        data[ action ].apply( data, args );
      }
    } );
  }

  old = $.fn.vcTabs;

  $.fn.vcTabs = Plugin;
  $.fn.vcTabs.Constructor = Tabs;

  // Tabs no conflict
  // ==========================
  $.fn.vcTabs.noConflict = function () {
    $.fn.vcTabs = old;
    return this;
  };

  // Tabs data-api
  // =================

  clickHandler = function ( e ) {
    var $this;
    $this = $( this );
    e.preventDefault();
    Plugin.call( $this, 'tabClick' );
  };

  changeHandler = function ( e ) {
    var caller;
    caller = $( e.target ).data( 'vc.accordion' );

    if ( undefined === caller.getRelatedTab ) {
      /**
       * Get related tab from accordion
       * @returns {*}
       */
      caller.getRelatedTab = function () {
        var findTargets;

        findTargets = function () {
          var $targets;
          $targets = caller.getContainer().find( '[data-vc-tabs]' ).filter( function () {
            var $this, tab;
            $this = $( this );

            tab = $this.data( 'vc.accordion' );
            if ( undefined === tab ) {
              $this.vcAccordion();
            }
            tab = $this.data( 'vc.accordion' );

            return tab.getSelector() === caller.getSelector();
          } );

          return $targets;
        };

        if ( ! caller.isCacheUsed() ) {
          return findTargets();
        }

        if ( undefined === caller.relatedTab ) {
          caller.relatedTab = findTargets();
        }

        return caller.relatedTab;
      };
    }

    Plugin.call( caller.getRelatedTab(), e.type );
  };

  $( document ).on( 'click.vc.tabs.data-api', '[data-vc-tabs]', clickHandler );
  $( document ).on( 'show.vc.accordion hide.vc.accordion', changeHandler );
}( window.jQuery );
/* =========================================================
 * vc-tta-autoplay.js v1.0.0
 * =========================================================
 * Copyright 2013 Wpbakery
 *
 * Visual composer tabs, tours, accordion auto play
 * ========================================================= */
+ function ( $ ) {
  'use strict';

  var Plugin, TtaAutoPlay, old;

  Plugin = function ( action, options ) {
    var args;

    args = Array.prototype.slice.call( arguments, 1 );
    return this.each( function () {
      var $this, data;

      $this = $( this );
      data = $this.data( 'vc.tta.autoplay' );
      if ( ! data ) {
        data = new TtaAutoPlay( $this,
          $.extend( true, {}, TtaAutoPlay.DEFAULTS, $this.data( 'vc-tta-autoplay' ), options ) );
        $this.data( 'vc.tta.autoplay', data );
      }
      if ( 'string' === typeof action ) {
        data[ action ].apply( data, args );
      } else {
        data.start( args ); // start the auto play by default
      }
    } );
  };

  /**
   * AutoPlay constuctor
   * @param $element
   * @param options
   * @constructor
   */
  TtaAutoPlay = function ( $element, options ) {
    this.$element = $element;
    this.options = options;
  };

  TtaAutoPlay.DEFAULTS = {
    delay: 5000,
    pauseOnHover: true,
    stopOnClick: true
  };

  /**
   * Method called on timeout hook call
   */
  TtaAutoPlay.prototype.show = function () {
    this.$element.find( '[data-vc-accordion]:eq(0)' ).vcAccordion( 'showNext' );
  };

  /**
   * Check is container has set window.setInterval
   *
   * @returns {boolean}
   */
  TtaAutoPlay.prototype.hasTimer = function () {
    return undefined !== this.$element.data( 'vc.tta.autoplay.timer' );
  };

  /**
   * Set for container window.setInterval and save it in data-attribute
   *
   * @param windowInterval
   */
  TtaAutoPlay.prototype.setTimer = function ( windowInterval ) {
    this.$element.data( 'vc.tta.autoplay.timer', windowInterval );
  };

  /**
   * Get containers timer from data-attributes
   *
   * @returns {*|Number}
   */
  TtaAutoPlay.prototype.getTimer = function () {
    return this.$element.data( 'vc.tta.autoplay.timer' );
  };

  /**
   * Removes from container data-attributes timer
   */
  TtaAutoPlay.prototype.deleteTimer = function () {
    this.$element.removeData( 'vc.tta.autoplay.timer' );
  };

  /**
   * Starts the autoplay timer with multiple call preventions
   */
  TtaAutoPlay.prototype.start = function () {
    var $this,
      that;

    $this = this.$element;
    that = this;

    /**
     * Local method called when accordion title being clicked
     * Used to stop autoplay
     *
     * @param e {jQuery.Event}
     */
    function stopHandler( e ) {
      e.preventDefault && e.preventDefault();

      if ( that.hasTimer() ) {
        Plugin.call( $this, 'stop' );
      }
    }

    /**
     * Local method called when mouse hovers a [data-vc-tta-autoplay] element( this.$element )
     * Used to pause/resume autoplay
     *
     * @param e {jQuery.Event}
     */
    function hoverHandler( e ) {
      e.preventDefault && e.preventDefault();

      if ( that.hasTimer() ) {
        Plugin.call( $this, 'mouseleave' === e.type ? 'resume' : 'pause' );
      }
    }

    if ( ! this.hasTimer() ) {
      this.setTimer( window.setInterval( this.show.bind( this ), this.options.delay ) );

      // On switching tab by click it stop/clears the timer
      this.options.stopOnClick && $this.on( 'click.vc.tta.autoplay.data-api',
        '[data-vc-accordion]',
        stopHandler );

      // On hover it pauses/resumes the timer
      this.options.pauseOnHover && $this.hover( hoverHandler );
    }
  };

  /**
   * Resumes the paused autoplay timer
   */
  TtaAutoPlay.prototype.resume = function () {
    if ( this.hasTimer() ) {
      this.setTimer( window.setInterval( this.show.bind( this ), this.options.delay ) );
    }
  };

  /**
   * Stop the autoplay timer
   */
  TtaAutoPlay.prototype.stop = function () {
    this.pause();
    this.deleteTimer();
    // Remove bind events in TtaAutoPlay.prototype.start method
    this.$element.off( 'click.vc.tta.autoplay.data-api mouseenter mouseleave' );
  };

  /**
   * Pause the autoplay timer
   */
  TtaAutoPlay.prototype.pause = function () {
    var timer;

    timer = this.getTimer();
    if ( undefined !== timer ) {
      window.clearInterval( timer );
    }
  };

  old = $.fn.vcTtaAutoPlay;

  $.fn.vcTtaAutoPlay = Plugin;

  $.fn.vcTtaAutoPlay.Constructor = TtaAutoPlay;

  /**
   * vcTtaAutoPlay no conflict
   * @returns {$.fn.vcTtaAutoPlay}
   */
  $.fn.vcTtaAutoPlay.noConflict = function () {
    $.fn.vcTtaAutoPlay = old;
    return this;
  };

  /**
   * Find all autoplay elements and start the timer
   */
  function startAutoPlay() {
    $( '[data-vc-tta-autoplay]' ).each( function () {
      $( this ).vcTtaAutoPlay();
    } );
  }

  /**
   *
   */
  $( document ).ready( startAutoPlay );
}( window.jQuery );

/*
 * jQuery Nivo Slider v3.2
 * http://nivo.dev7studios.com
 *
 * Copyright 2012, Dev7studios
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */
/*jshint ignore: start */
(function(e){var t=function(t,n){var r=e.extend({},e.fn.nivoSlider.defaults,n);var i={currentSlide:0,currentImage:"",totalSlides:0,running:false,paused:false,stop:false,controlNavEl:false};var s=e(t);s.data("nivo:vars",i).addClass("nivoSlider");var o=s.children();o.each(function(){var t=e(this);var n="";if(!t.is("img")){if(t.is("a")){t.addClass("nivo-imageLink");n=t}t=t.find("img:first")}var r=r===0?t.attr("width"):t.width(),s=s===0?t.attr("height"):t.height();if(n!==""){n.css("display","none")}t.css("display","none");i.totalSlides++});if(r.randomStart){r.startSlide=Math.floor(Math.random()*i.totalSlides)}if(r.startSlide>0){if(r.startSlide>=i.totalSlides){r.startSlide=i.totalSlides-1}i.currentSlide=r.startSlide}if(e(o[i.currentSlide]).is("img")){i.currentImage=e(o[i.currentSlide])}else{i.currentImage=e(o[i.currentSlide]).find("img:first")}if(e(o[i.currentSlide]).is("a")){e(o[i.currentSlide]).css("display","block")}var u=e("<img/>").addClass("nivo-main-image");u.attr("src",i.currentImage.attr("src")).show();s.append(u);e(window).resize(function(){s.children("img").width(s.width());u.attr("src",i.currentImage.attr("src"));u.stop().height("auto");e(".nivo-slice").remove();e(".nivo-box").remove()});s.append(e('<div class="nivo-caption"></div>'));var a=function(t){var n=e(".nivo-caption",s);if(i.currentImage.attr("title")!=""&&i.currentImage.attr("title")!=undefined){var r=i.currentImage.attr("title");if(r.substr(0,1)=="#")r=e(r).html();if(n.css("display")=="block"){setTimeout(function(){n.html(r)},t.animSpeed)}else{n.html(r);n.stop().fadeIn(t.animSpeed)}}else{n.stop().fadeOut(t.animSpeed)}};a(r);var f=0;if(!r.manualAdvance&&o.length>1){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}if(r.directionNav){s.append('<div class="nivo-directionNav"><a class="nivo-prevNav">'+r.prevText+'</a><a class="nivo-nextNav">'+r.nextText+"</a></div>");e(s).on("click","a.nivo-prevNav",function(){if(i.running){return false}clearInterval(f);f="";i.currentSlide-=2;d(s,o,r,"prev")});e(s).on("click","a.nivo-nextNav",function(){if(i.running){return false}clearInterval(f);f="";d(s,o,r,"next")})}if(r.controlNav){i.controlNavEl=e('<div class="nivo-controlNav"></div>');s.after(i.controlNavEl);for(var l=0;l<o.length;l++){if(r.controlNavThumbs){i.controlNavEl.addClass("nivo-thumbs-enabled");var c=o.eq(l);if(!c.is("img")){c=c.find("img:first")}if(c.attr("data-thumb"))i.controlNavEl.append('<a class="nivo-control" rel="'+l+'"><img src="'+c.attr("data-thumb")+'" alt="" /></a>')}else{i.controlNavEl.append('<a class="nivo-control" rel="'+l+'">'+(l+1)+"</a>")}}e("a:eq("+i.currentSlide+")",i.controlNavEl).addClass("active");e("a",i.controlNavEl).bind("click",function(){if(i.running)return false;if(e(this).hasClass("active"))return false;clearInterval(f);f="";u.attr("src",i.currentImage.attr("src"));i.currentSlide=e(this).attr("rel")-1;d(s,o,r,"control")})}if(r.pauseOnHover){s.hover(function(){i.paused=true;clearInterval(f);f=""},function(){i.paused=false;if(f===""&&!r.manualAdvance){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}})}s.bind("nivo:animFinished",function(){u.attr("src",i.currentImage.attr("src"));i.running=false;e(o).each(function(){if(e(this).is("a")){e(this).css("display","none")}});if(e(o[i.currentSlide]).is("a")){e(o[i.currentSlide]).css("display","block")}if(f===""&&!i.paused&&!r.manualAdvance){f=setInterval(function(){d(s,o,r,false)},r.pauseTime)}r.afterChange.call(this)});var h=function(t,n,r){if(e(r.currentImage).parent().is("a"))e(r.currentImage).parent().css("display","block");e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").width(t.width()).css("visibility","hidden").show();var i=e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").parent().is("a")?e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").parent().height():e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").height();for(var s=0;s<n.slices;s++){var o=Math.round(t.width()/n.slices);if(s===n.slices-1){t.append(e('<div class="nivo-slice" name="'+s+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block !important; top:0; left:-"+(o+s*o-o)+'px;" /></div>').css({left:o*s+"px",width:t.width()-o*s+"px",height:i+"px",opacity:"0",overflow:"hidden"}))}else{t.append(e('<div class="nivo-slice" name="'+s+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block !important; top:0; left:-"+(o+s*o-o)+'px;" /></div>').css({left:o*s+"px",width:o+"px",height:i+"px",opacity:"0",overflow:"hidden"}))}}e(".nivo-slice",t).height(i);u.stop().animate({height:e(r.currentImage).height()},n.animSpeed)};var p=function(t,n,r){if(e(r.currentImage).parent().is("a"))e(r.currentImage).parent().css("display","block");e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").width(t.width()).css("visibility","hidden").show();var i=Math.round(t.width()/n.boxCols),s=Math.round(e('img[src="'+r.currentImage.attr("src")+'"]',t).not(".nivo-main-image,.nivo-control img").height()/n.boxRows);for(var o=0;o<n.boxRows;o++){for(var a=0;a<n.boxCols;a++){if(a===n.boxCols-1){t.append(e('<div class="nivo-box" name="'+a+'" rel="'+o+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block; top:-"+s*o+"px; left:-"+i*a+'px;" /></div>').css({opacity:0,left:i*a+"px",top:s*o+"px",width:t.width()-i*a+"px"}));e('.nivo-box[name="'+a+'"]',t).height(e('.nivo-box[name="'+a+'"] img',t).height()+"px")}else{t.append(e('<div class="nivo-box" name="'+a+'" rel="'+o+'"><img src="'+r.currentImage.attr("src")+'" style="position:absolute; width:'+t.width()+"px; height:auto; display:block; top:-"+s*o+"px; left:-"+i*a+'px;" /></div>').css({opacity:0,left:i*a+"px",top:s*o+"px",width:i+"px"}));e('.nivo-box[name="'+a+'"]',t).height(e('.nivo-box[name="'+a+'"] img',t).height()+"px")}}}u.stop().animate({height:e(r.currentImage).height()},n.animSpeed)};var d=function(t,n,r,i){var s=t.data("nivo:vars");if(s&&s.currentSlide===s.totalSlides-1){r.lastSlide.call(this)}if((!s||s.stop)&&!i){return false}r.beforeChange.call(this);if(!i){u.attr("src",s.currentImage.attr("src"))}else{if(i==="prev"){u.attr("src",s.currentImage.attr("src"))}if(i==="next"){u.attr("src",s.currentImage.attr("src"))}}s.currentSlide++;if(s.currentSlide===s.totalSlides){s.currentSlide=0;r.slideshowEnd.call(this)}if(s.currentSlide<0){s.currentSlide=s.totalSlides-1}if(e(n[s.currentSlide]).is("img")){s.currentImage=e(n[s.currentSlide])}else{s.currentImage=e(n[s.currentSlide]).find("img:first")}if(r.controlNav){e("a",s.controlNavEl).removeClass("active");e("a:eq("+s.currentSlide+")",s.controlNavEl).addClass("active")}a(r);e(".nivo-slice",t).remove();e(".nivo-box",t).remove();var o=r.effect,f="";if(r.effect==="random"){f=new Array("sliceDownRight","sliceDownLeft","sliceUpRight","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","fade","boxRandom","boxRain","boxRainReverse","boxRainGrow","boxRainGrowReverse");o=f[Math.floor(Math.random()*(f.length+1))];if(o===undefined){o="fade"}}if(r.effect.indexOf(",")!==-1){f=r.effect.split(",");o=f[Math.floor(Math.random()*f.length)];if(o===undefined){o="fade"}}if(s.currentImage.attr("data-transition")){o=s.currentImage.attr("data-transition")}s.running=true;var l=0,c=0,d="",m="",g="",y="";if(o==="sliceDown"||o==="sliceDownRight"||o==="sliceDownLeft"){h(t,r,s);l=0;c=0;d=e(".nivo-slice",t);if(o==="sliceDownLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);n.css({top:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="sliceUp"||o==="sliceUpRight"||o==="sliceUpLeft"){h(t,r,s);l=0;c=0;d=e(".nivo-slice",t);if(o==="sliceUpLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);n.css({bottom:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="sliceUpDown"||o==="sliceUpDownRight"||o==="sliceUpDownLeft"){h(t,r,s);l=0;c=0;var b=0;d=e(".nivo-slice",t);if(o==="sliceUpDownLeft"){d=e(".nivo-slice",t)._reverse()}d.each(function(){var n=e(this);if(c===0){n.css("top","0px");c++}else{n.css("bottom","0px");c=0}if(b===r.slices-1){setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1.0"},r.animSpeed)},100+l)}l+=50;b++})}else if(o==="fold"){h(t,r,s);l=0;c=0;e(".nivo-slice",t).each(function(){var n=e(this);var i=n.width();n.css({top:"0px",width:"0px"});if(c===r.slices-1){setTimeout(function(){n.animate({width:i,opacity:"1.0"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({width:i,opacity:"1.0"},r.animSpeed)},100+l)}l+=50;c++})}else if(o==="fade"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:t.width()+"px"});m.animate({opacity:"1.0"},r.animSpeed*2,"",function(){t.trigger("nivo:animFinished")})}else if(o==="slideInRight"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:"0px",opacity:"1"});m.animate({width:t.width()+"px"},r.animSpeed*2,"",function(){t.trigger("nivo:animFinished")})}else if(o==="slideInLeft"){h(t,r,s);m=e(".nivo-slice:first",t);m.css({width:"0px",opacity:"1",left:"",right:"0px"});m.animate({width:t.width()+"px"},r.animSpeed*2,"",function(){m.css({left:"0px",right:""});t.trigger("nivo:animFinished")})}else if(o==="boxRandom"){p(t,r,s);g=r.boxCols*r.boxRows;c=0;l=0;y=v(e(".nivo-box",t));y.each(function(){var n=e(this);if(c===g-1){setTimeout(function(){n.animate({opacity:"1"},r.animSpeed,"",function(){t.trigger("nivo:animFinished")})},100+l)}else{setTimeout(function(){n.animate({opacity:"1"},r.animSpeed)},100+l)}l+=20;c++})}else if(o==="boxRain"||o==="boxRainReverse"||o==="boxRainGrow"||o==="boxRainGrowReverse"){p(t,r,s);g=r.boxCols*r.boxRows;c=0;l=0;var w=0;var E=0;var S=[];S[w]=[];y=e(".nivo-box",t);if(o==="boxRainReverse"||o==="boxRainGrowReverse"){y=e(".nivo-box",t)._reverse()}y.each(function(){S[w][E]=e(this);E++;if(E===r.boxCols){w++;E=0;S[w]=[]}});for(var x=0;x<r.boxCols*2;x++){var T=x;for(var N=0;N<r.boxRows;N++){if(T>=0&&T<r.boxCols){(function(n,i,s,u,a){var f=e(S[n][i]);var l=f.width();var c=f.height();if(o==="boxRainGrow"||o==="boxRainGrowReverse"){f.width(0).height(0)}if(u===a-1){setTimeout(function(){f.animate({opacity:"1",width:l,height:c},r.animSpeed/1.3,"",function(){t.trigger("nivo:animFinished")})},100+s)}else{setTimeout(function(){f.animate({opacity:"1",width:l,height:c},r.animSpeed/1.3)},100+s)}})(N,T,l,c,g);c++}T--}l+=100}}};var v=function(e){for(var t,n,r=e.length;r;t=parseInt(Math.random()*r,10),n=e[--r],e[r]=e[t],e[t]=n);return e};var m=function(e){if(this.console&&typeof console.log!=="undefined"){console.log(e)}};this.stop=function(){if(!e(t).data("nivo:vars").stop){e(t).data("nivo:vars").stop=true;m("Stop Slider")}};this.start=function(){if(e(t).data("nivo:vars").stop){e(t).data("nivo:vars").stop=false;m("Start Slider")}};r.afterLoad.call(this);return this};e.fn.nivoSlider=function(n){return this.each(function(r,i){var s=e(this);if(s.data("nivoslider")){return s.data("nivoslider")}var o=new t(this,n);s.data("nivoslider",o)})};e.fn.nivoSlider.defaults={effect:"random",slices:15,boxCols:8,boxRows:4,animSpeed:500,pauseTime:3e3,startSlide:0,directionNav:true,controlNav:true,controlNavThumbs:false,pauseOnHover:true,manualAdvance:false,prevText:"Prev",nextText:"Next",randomStart:false,beforeChange:function(){},afterChange:function(){},slideshowEnd:function(){},lastSlide:function(){},afterLoad:function(){}};e.fn._reverse=[].reverse})(jQuery)

/*jshint ignore: end */
