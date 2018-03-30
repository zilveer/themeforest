/*! Copyright 2012, Ben Lin (http://dreamerslab.com/)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 1.0.14
 *
 * Requires: jQuery 1.2.3 ~ 1.9.0
 */
;(function(e){e.fn.extend({actual:function(t,n){if(!this[t]){throw'$.actual => The jQuery method "'+t+'" you called does not exist'}var r={absolute:false,clone:false,includeMargin:false};var i=e.extend(r,n);var s=this.eq(0);var o,u;if(i.clone===true){o=function(){var e="position: absolute !important; top: -1000 !important; ";s=s.clone().attr("style",e).appendTo("body")};u=function(){s.remove()}}else{var a=[];var f="";var l;o=function(){if(e.fn.jquery>="1.8.0")l=s.parents().addBack().filter(":hidden");else l=s.parents().andSelf().filter(":hidden");f+="visibility: hidden !important; display: block !important; ";if(i.absolute===true)f+="position: absolute !important; ";l.each(function(){var t=e(this);a.push(t.attr("style"));t.attr("style",f)})};u=function(){l.each(function(t){var n=e(this);var r=a[t];if(r===undefined){n.removeAttr("style")}else{n.attr("style",r)}})}}o();var c=/(outer)/g.test(t)?s[t](i.includeMargin):s[t]();u();return c}})})(jQuery);


// adds .naturalWidth() and .naturalHeight() methods to jQuery
// for retreaving a normalized naturalWidth and naturalHeight.
// by Jack Moore - jacklmoore.com
;(function($){
	var
	props = ['Width', 'Height'],
	prop;

	while (prop = props.pop()) {
		(function (natural, prop) {
			$.fn[natural] = (natural in new Image()) ? 
			function () {
				return this[0][natural];
			} : 
			function () {
				var 
				node = this[0],
				img,
				value;

				if (node.tagName.toLowerCase() === 'img') {
					img = new Image();
					img.src = node.src,
					value = img[prop];
				}
				return value;
			};
		}('natural' + prop, prop.toLowerCase()));
	}
}(jQuery));

/*!
 * geode_customSelect() - v0.0.1
 * based on jquery.customSelect() - v0.4.1
 * http://adam.co/lab/jquery/customselect/
 * 2013-05-13
 *
 * Copyright 2013 Adam Coulombe
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @license http://www.gnu.org/licenses/gpl.html GPL2 License 
 */
;(function(e){"use strict";e.fn.extend({geode_customSelect:function(t){if(typeof document.body.style.maxHeight==="undefined"){return this}var n={customClass:"customSelect",mapClass:true,mapStyle:true},t=e.extend(n,t),r=t.customClass,i=function(t,n){var r=t.find(":selected"),i=n.children(":first"),o=r.html()||"&nbsp;";i.html(o);if(r.attr("disabled")){n.addClass(s("DisabledOption"))}else{n.removeClass(s("DisabledOption"))}setTimeout(function(){n.removeClass(s("Open"));e(document).off("mouseup."+s("Open"))},60)},s=function(e){return r+e};return this.each(function(){var n=e(this),o=e("<span />").addClass(s("Inner")),u=e("<span />");n.after(u.append(o));u.addClass(r);if(t.mapClass){u.addClass(n.attr("class"))}if(t.mapStyle){u.attr("style",n.attr("style"))}n.addClass("hasCustomSelect").on("update",function(){i(n,u);var e=n.actual("outerWidth");u.css({display:"inline-block"});var t=u.actual("outerHeight");if(n.attr("disabled")){u.addClass(s("Disabled"))}else{u.removeClass(s("Disabled"))}u.css({marginLeft:"-"+e+"px",width:e,display:"inline-block"});n.css({webkitAppearance:"none",mozAppearance:"none",msAppearance:"none",appearance:"none",opacity:0,height:t,fontSize:u.css("font-size")})}).on("change",function(){u.addClass(s("Changed"));i(n,u)}).on("keyup",function(e){if(!u.hasClass(s("Open"))){n.blur();n.focus()}else{if(e.which==13||e.which==27){i(n,u)}}}).on("mousedown",function(e){u.removeClass(s("Changed"))}).on("mouseup",function(t){if(!u.hasClass(s("Open"))){if(e("."+s("Open")).not(u).length>0&&typeof InstallTrigger!=="undefined"){n.focus()}else{u.addClass(s("Open"));t.stopPropagation();e(document).one("mouseup."+s("Open"),function(t){if(t.target!=n.get(0)&&e.inArray(t.target,n.find("*").get())<0){n.blur()}else{i(n,u)}})}}}).focus(function(){u.removeClass(s("Changed")).addClass(s("Focus"))}).blur(function(){u.removeClass(s("Focus")+" "+s("Open"))}).hover(function(){u.addClass(s("Hover"))},function(){u.removeClass(s("Hover"))}).trigger("update")})}})})(jQuery);


/*! Plugin for Cycle2; Copyright (c) 2012 M. Alsup; ver: 20121120 */
/*;(function(a){"use strict";var b="ontouchend"in document;a.event.special.swipe=a.event.special.swipe||{scrollSupressionThreshold:10,durationThreshold:1e3,horizontalDistanceThreshold:30,verticalDistanceThreshold:75,setup:function(){var b=a(this);b.bind("touchstart",function(c){function g(b){if(!f)return;var c=b.originalEvent.touches?b.originalEvent.touches[0]:b;e={time:(new Date).getTime(),coords:[c.pageX,c.pageY]},Math.abs(f.coords[0]-e.coords[0])>a.event.special.swipe.scrollSupressionThreshold&&b.preventDefault()}var d=c.originalEvent.touches?c.originalEvent.touches[0]:c,e,f={time:(new Date).getTime(),coords:[d.pageX,d.pageY],origin:a(c.target)};b.bind("touchmove",g).one("touchend",function(c){b.unbind("touchmove",g),f&&e&&e.time-f.time<a.event.special.swipe.durationThreshold&&Math.abs(f.coords[0]-e.coords[0])>a.event.special.swipe.horizontalDistanceThreshold&&Math.abs(f.coords[1]-e.coords[1])<a.event.special.swipe.verticalDistanceThreshold&&f.origin.trigger("swipe").trigger(f.coords[0]>e.coords[0]?"swipeleft":"swiperight"),f=e=undefined})})}},a.event.special.swipeleft=a.event.special.swipeleft||{setup:function(){a(this).bind("swipe",a.noop)}},a.event.special.swiperight=a.event.special.swiperight||a.event.special.swipeleft})(jQuery);

/* Plugin for Cycle2; Copyright (c) 2012 M. Alsup; v20130909 */
/*(function(e){"use strict";function t(t){return{preInit:function(e){e.slides.css(n)},transition:function(i,n,s,o,r){var l=i,c=e(n),a=e(s),d=l.speed/2;t.call(a,-90),a.css({display:"block","background-position":"-90px",opacity:1}),c.css("background-position","0px"),c.animate({backgroundPosition:90},{step:t,duration:d,easing:l.easeOut||l.easing,complete:function(){i.API.updateView(!1,!0),a.animate({backgroundPosition:0},{step:t,duration:d,easing:l.easeIn||l.easing,complete:r})}})}}}function i(t){return function(i){var n=e(this);n.css({"-webkit-transform":"rotate"+t+"("+i+"deg)","-moz-transform":"rotate"+t+"("+i+"deg)","-ms-transform":"rotate"+t+"("+i+"deg)","-o-transform":"rotate"+t+"("+i+"deg)",transform:"rotate"+t+"("+i+"deg)"})}}var n,s=document.createElement("div").style,o=e.fn.cycle.transitions,r=void 0!==s.transform||void 0!==s.MozTransform||void 0!==s.webkitTransform||void 0!==s.oTransform||void 0!==s.msTransform;r&&void 0!==s.msTransform&&(s.msTransform="rotateY(0deg)",s.msTransform||(r=!1)),r?(o.flipHorz=t(i("Y")),o.flipVert=t(i("X")),n={"-webkit-backface-visibility":"hidden","-moz-backface-visibility":"hidden","-o-backface-visibility":"hidden","backface-visibility":"hidden"}):(o.flipHorz=o.scrollHorz,o.flipVert=o.scrollVert||o.scrollHorz)})(jQuery);

/*!
	Zoom v1.7.11 - 2013-11-12
	Enlarge images on click or mouseover.
	(c) 2013 Jack Moore - http://www.jacklmoore.com/zoom
	license: http://www.opensource.org/licenses/mit-license.php
*/
;(function(o){var t={url:!1,callback:!1,target:!1,duration:120,on:"mouseover",touch:!0,onZoomIn:!1,onZoomOut:!1,magnify:1};o.zoom=function(t,n,e,i){var u,c,a,m,r,l,s,f=o(t).css("position");return o(t).css({position:/(absolute|fixed)/.test(f)?f:"relative",overflow:"hidden"}),e.style.width=e.style.height="",o(e).addClass("zoomImg").css({position:"absolute",top:0,left:0,opacity:0,width:e.width*i,height:e.height*i,border:"none",maxWidth:"none"}).appendTo(t),{init:function(){c=o(t).outerWidth(),u=o(t).outerHeight(),n===t?(m=c,a=u):(m=o(n).outerWidth(),a=o(n).outerHeight()),r=(e.width-c)/m,l=(e.height-u)/a,s=o(n).offset()},move:function(o){var t=o.pageX-s.left,n=o.pageY-s.top;n=Math.max(Math.min(n,a),0),t=Math.max(Math.min(t,m),0),e.style.left=t*-r+"px",e.style.top=n*-l+"px"}}},o.fn.zoom=function(n){return this.each(function(){var e,i=o.extend({},t,n||{}),u=i.target||this,c=this,a=document.createElement("img"),m=o(a),r="mousemove.zoom",l=!1,s=!1;(i.url||(e=o(c).find("img"),e[0]&&(i.url=e.data("src")||e.attr("src")),i.url))&&(a.onload=function(){function t(t){e.init(),e.move(t),m.stop().fadeTo(o.support.opacity?i.duration:0,1,o.isFunction(i.onZoomIn)?i.onZoomIn.call(a):!1)}function n(){m.stop().fadeTo(i.duration,0,o.isFunction(i.onZoomOut)?i.onZoomOut.call(a):!1)}var e=o.zoom(u,c,a,i.magnify);"grab"===i.on?o(c).on("mousedown.zoom",function(i){1===i.which&&(o(document).one("mouseup.zoom",function(){n(),o(document).off(r,e.move)}),t(i),o(document).on(r,e.move),i.preventDefault())}):"click"===i.on?o(c).on("click.zoom",function(i){return l?void 0:(l=!0,t(i),o(document).on(r,e.move),o(document).one("click.zoom",function(){n(),l=!1,o(document).off(r,e.move)}),!1)}):"toggle"===i.on?o(c).on("click.zoom",function(o){l?n():t(o),l=!l}):"mouseover"===i.on&&(e.init(),o(c).on("mouseenter.zoom",t).on("mouseleave.zoom",n).on(r,e.move)),i.touch&&o(c).on("touchstart.zoom",function(o){o.preventDefault(),s?(s=!1,n()):(s=!0,t(o.originalEvent.touches[0]||o.originalEvent.changedTouches[0]))}).on("touchmove.zoom",function(o){o.preventDefault(),e.move(o.originalEvent.touches[0]||o.originalEvent.changedTouches[0])}),o.isFunction(i.callback)&&i.callback.call(a)},a.src=i.url,o(c).one("zoom.destroy",function(){o(c).off(".zoom"),m.remove()}))})},o.fn.zoom.defaults=t})(window.jQuery);

/*jshint browser:true */
/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

;(function( $ ){

  'use strict';

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement("div");
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        'iframe[src*="player.vimeo.com"]',
        'iframe[src*="youtube.com"]',
        'iframe[src*="youtube-nocookie.com"]',
        'iframe[src*="kickstarter.com"][src*="video.html"]',
        'object',
        'embed'
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not('object object'); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(count){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + count;
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+'%');
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );

// Sticky Plugin v1.0.0 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky
// Description: Makes an element on the page stick on the screen as you scroll
//       It will only set the 'top' and 'position' of your element, you
//       might need to adjust the width in some cases.

(function($) {
  var defaults = {
      topSpacing: 0,
      bottomSpacing: 0,
      className: 'is-sticky',
      wrapperClassName: 'sticky-wrapper',
      center: false,
      getWidthFrom: ''
    },
    $window = $(window),
    $document = $(document),
    sticked = [],
    windowHeight = $window.height(),
    scroller = function() {
      var scrollTop = $window.scrollTop(),
        documentHeight = $document.height(),
        dwh = documentHeight - windowHeight,
        extra = (scrollTop > dwh) ? dwh - scrollTop : 0;

      for (var i = 0; i < sticked.length; i++) {
        var s = sticked[i],
          elementTop = s.stickyWrapper.offset().top,
          etse = elementTop - s.topSpacing - extra;

        if (scrollTop <= etse) {
          if (s.currentTop !== null) {
            s.stickyElement
              .css('position', '')
              .css('top', '');
            s.stickyElement.parent().removeClass(s.className);

            // REMOVE CALLBACK EVENT
            if (typeof defaults.unSticky == 'function') { 
              defaults.unSticky.call(this);
            }            

            s.currentTop = null;
          }
        }
        else {
          var newTop = documentHeight - s.stickyElement.outerHeight()
            - s.topSpacing - s.bottomSpacing - scrollTop - extra;
          if (newTop < 0) {
            newTop = newTop + s.topSpacing;
          } else {
            newTop = s.topSpacing;
          }
          if (s.currentTop != newTop) {
            s.stickyElement
              .css('position', 'fixed')
              .css('top', newTop);

            if (typeof s.getWidthFrom !== 'undefined') {
              s.stickyElement.css('width', $(s.getWidthFrom).width());
            }

            s.stickyElement.parent().addClass(s.className);

            // ADD CALLBACK EVENT
            if (typeof defaults.isSticky == 'function') { 
                defaults.isSticky.call(this);
            }            

            s.currentTop = newTop;
          }
        }
      }
    },
    resizer = function() {
      windowHeight = $window.height();
    },
    methods = {
      init: function(options) {
        var o = $.extend(defaults, options);
        return this.each(function() {
          var stickyElement = $(this);

          var stickyId = stickyElement.attr('id');
          var wrapper = $('<div></div>')
            .attr('id', stickyId + '-sticky-wrapper')
            .addClass(o.wrapperClassName);
          stickyElement.wrapAll(wrapper);

          if (o.center) {
            stickyElement.parent().css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});
          }

          if (stickyElement.css("float") == "right") {
            stickyElement.css({"float":"none"}).parent().css({"float":"right"});
          }

          var stickyWrapper = stickyElement.parent();
          stickyWrapper.css('height', stickyElement.outerHeight());
          sticked.push({
            topSpacing: o.topSpacing,
            bottomSpacing: o.bottomSpacing,
            stickyElement: stickyElement,
            currentTop: null,
            stickyWrapper: stickyWrapper,
            className: o.className,
            getWidthFrom: o.getWidthFrom
          });
        });
      },
      update: scroller,
      unstick: function(options) {
        return this.each(function() {
          var unstickyElement = $(this);

          var removeIdx = -1;
          for (var i = 0; i < sticked.length; i++) 
          {
            if (sticked[i].stickyElement.get(0) == unstickyElement.get(0))
            {
                removeIdx = i;
            }
          }
          if(removeIdx != -1)
          {
            sticked.splice(removeIdx,1);
            unstickyElement.unwrap();
            unstickyElement.removeAttr('style');
          }
        });
      }
    };

  // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
  if (window.addEventListener) {
    window.addEventListener('scroll', scroller, false);
    window.addEventListener('resize', resizer, false);
  } else if (window.attachEvent) {
    window.attachEvent('onscroll', scroller);
    window.attachEvent('onresize', resizer);
  }

  $.fn.sticky = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };

  $.fn.unstick = function(method) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.unstick.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }

  };
  $(function() {
    setTimeout(scroller, 0);
  });
})(jQuery);

/*global jQuery */
/*!
* FitText.js 1.2
*
* Copyright 2011, Dave Rupert http://daverupert.com
* Released under the WTFPL license
* http://sam.zoy.org/wtfpl/
*
* Date: Thu May 05 14:23:00 2011 -0600
*/

;(function(e){e.fn.fitText=function(t,n){var r=t||1,i=e.extend({minFontSize:Number.NEGATIVE_INFINITY,maxFontSize:Number.POSITIVE_INFINITY},n);return this.each(function(){var t=e(this);var n=function(){t.css("font-size",Math.max(Math.min(t.width()/(r*10),parseFloat(i.maxFontSize)),parseFloat(i.minFontSize)))};n();e(window).on("resize.fittext orientationchange.fittext",n)})}})(jQuery);

/*!
 * jQuery Browser Plugin v0.0.6
 * https://github.com/gabceb/jquery-browser-plugin
 *
 * Original jquery-browser code Copyright 2005, 2013 jQuery Foundation, Inc. and other contributors
 * http://jquery.org/license
 *
 * Modifications Copyright 2013 Gabriel Cebrian
 * https://github.com/gabceb
 *
 * Released under the MIT license
 *
 * Date: 2013-07-29T17:23:27-07:00
 */
 ;(function(e,t,n){"use strict";var r,i;e.uaMatch=function(e){e=e.toLowerCase();var t=/(opr)[\/]([\w.]+)/.exec(e)||/(chrome)[ \/]([\w.]+)/.exec(e)||/(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec(e)||/(webkit)[ \/]([\w.]+)/.exec(e)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e)||/(msie) ([\w.]+)/.exec(e)||e.indexOf("trident")>=0&&/(rv)(?::| )([\w.]+)/.exec(e)||e.indexOf("compatible")<0&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e)||[];var n=/(ipad)/.exec(e)||/(iphone)/.exec(e)||/(android)/.exec(e)||/(windows phone)/.exec(e)||/(win)/.exec(e)||/(mac)/.exec(e)||/(linux)/.exec(e)||/(cros)/i.exec(e)||[];return{browser:t[3]||t[1]||"",version:t[2]||"0",platform:n[0]||""}};r=e.uaMatch(t.navigator.userAgent);i={};if(r.browser){i[r.browser]=true;i.version=r.version;i.versionNumber=parseInt(r.version)}if(r.platform){i[r.platform]=true}if(i.android||i.ipad||i.iphone||i["windows phone"]){i.mobile=true}if(i.cros||i.mac||i.linux||i.win){i.desktop=true}if(i.chrome||i.opr||i.safari){i.webkit=true}if(i.rv){var s="msie";r.browser=s;i[s]=true}if(i.opr){var o="opera";r.browser=o;i[o]=true}if(i.safari&&i.android){var u="android";r.browser=u;i[u]=true}i.name=r.browser;i.platform=r.platform;e.browser=i})(jQuery,window);

/**
* Detect Element Resize Plugin for jQuery
*
* https://github.com/sdecima/javascript-detect-element-resize
* Sebastian Decima
*
* version: 0.5
**/
/*;(function(e){function f(){if(!n){var e='.resize-triggers { visibility: hidden; } .resize-triggers, .resize-triggers > div, .contract-trigger:before { content: " "; display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%; overflow: hidden; } .resize-triggers > div { background: #eee; overflow: auto; } .contract-trigger:before { width: 200%; height: 200%; }',t=document.head||document.getElementsByTagName("head")[0],r=document.createElement("style");r.type="text/css";if(r.styleSheet){r.styleSheet.cssText=e}else{r.appendChild(document.createTextNode(e))}t.appendChild(r)}}var t=document.attachEvent,n=false;var r=e.fn.resize;e.fn.resize=function(e){return this.each(function(){if(this==window)r.call(jQuery(this),e);else addResizeListener(this,e)})};e.fn.removeResize=function(e){return this.each(function(){removeResizeListener(this,e)})};if(!t){var i=function(){var e=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||function(e){return window.setTimeout(e,20)};return function(t){return e(t)}}();var s=function(){var e=window.cancelAnimationFrame||window.mozCancelAnimationFrame||window.webkitCancelAnimationFrame||window.clearTimeout;return function(t){return e(t)}}();function o(e){var t=e.__resizeTriggers__,n=t.firstElementChild,r=t.lastElementChild,i=n.firstElementChild;r.scrollLeft=r.scrollWidth;r.scrollTop=r.scrollHeight;i.style.width=n.offsetWidth+1+"px";i.style.height=n.offsetHeight+1+"px";n.scrollLeft=n.scrollWidth;n.scrollTop=n.scrollHeight}function u(e){return e.offsetWidth!=e.__resizeLast__.width||e.offsetHeight!=e.__resizeLast__.height}function a(e){var t=this;o(this);if(this.__resizeRAF__)s(this.__resizeRAF__);this.__resizeRAF__=i(function(){if(u(t)){t.__resizeLast__.width=t.offsetWidth;t.__resizeLast__.height=t.offsetHeight;t.__resizeListeners__.forEach(function(n){n.call(t,e)})}})}}window.addResizeListener=function(e,n){if(t)e.attachEvent("onresize",n);else{if(!e.__resizeTriggers__){if(getComputedStyle(e).position=="static")e.style.position="relative";f();e.__resizeLast__={};e.__resizeListeners__=[];(e.__resizeTriggers__=document.createElement("div")).className="resize-triggers";e.__resizeTriggers__.innerHTML='<div class="expand-trigger"><div></div></div>'+'<div class="contract-trigger"></div>';e.appendChild(e.__resizeTriggers__);o(e);e.addEventListener("scroll",a,true)}e.__resizeListeners__.push(n)}};window.removeResizeListener=function(e,n){if(t)e.detachEvent("onresize",n);else{e.__resizeListeners__.splice(e.__resizeListeners__.indexOf(n),1);if(!e.__resizeListeners__.length){e.removeEventListener("scroll",a);e.__resizeTriggers__=!e.removeChild(e.__resizeTriggers__)}}}})(jQuery);*/