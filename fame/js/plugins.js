// Avoid `console` errors in browsers that lack a console. (from HTML5BP)
(function(){"use strict";var e;var d=function(){};var b=["assert","clear","count","debug","dir","dirxml","error","exception","group","groupCollapsed","groupEnd","info","log","markTimeline","profile","profileEnd","table","time","timeEnd","timeStamp","trace","warn"];var c=b.length;var a=(window.console=window.console||{});while(c--){e=b[c];if(!a[e]){a[e]=d;}}}());

/**
 * functions for running callback function in mass frequency events
 * like resize, mousemove, scroll
 */
var throttle=function(f,e){"use strict";e||(e=100);var d=null,c=+new Date,b=false,a=0;return function(){var h=+new Date,i=this,g=arguments,j=function(){clearTimeout(d);f.apply(i,g);c=a=h;b=true;d=setTimeout(function(){if(a!==c){j()}},e)};if(!b||h-c>e){j()}else{a=h}}},
    debounce=function(d,a,b){"use strict";var e;return function c(){var h=this,g=arguments,f=function(){if(!b){d.apply(h,g);}e=null};if(e){clearTimeout(e)}else{if(b){d.apply(h,g)}}e=setTimeout(f,a||100)}};


//hover intent
(function(a){"use strict";a.fn.hoverIntent=function(k,j){var l={sensitivity:7,interval:100,timeout:0};l=a.extend(l,j?{over:k,out:j}:k);var n,m,h,d;var e=function(f){n=f.pageX;m=f.pageY;};var c=function(g,f){f.hoverIntent_t=clearTimeout(f.hoverIntent_t);if((Math.abs(h-n)+Math.abs(d-m))<l.sensitivity){a(f).unbind("mousemove",e);f.hoverIntent_s=1;return l.over.apply(f,[g])}else{h=n;d=m;f.hoverIntent_t=setTimeout(function(){c(g,f)},l.interval)}};var i=function(g,f){f.hoverIntent_t=clearTimeout(f.hoverIntent_t);f.hoverIntent_s=0;return l.out.apply(f,[g])};var b=function(o){var g=jQuery.extend({},o);var f=this;if(f.hoverIntent_t){f.hoverIntent_t=clearTimeout(f.hoverIntent_t)}if(o.type=="mouseenter"){h=g.pageX;d=g.pageY;a(f).bind("mousemove",e);if(f.hoverIntent_s!=1){f.hoverIntent_t=setTimeout(function(){c(g,f)},l.interval)}}else{a(f).unbind("mousemove",e);if(f.hoverIntent_s==1){f.hoverIntent_t=setTimeout(function(){i(g,f)},l.timeout)}}};return this.bind("mouseenter",b).bind("mouseleave",b)}})(jQuery);


// IOS 6 fix setTimeout during Touch events
(function(g){"use strict";if(!navigator.userAgent.match(/OS 6(_\d)+/i)){return;}var a={};var d={};var e=g.setTimeout;var f=g.setInterval;var h=g.clearTimeout;var c=g.clearInterval;function i(p,m,k){var o,j=k[0],l=(p===f);function n(){if(j){j.apply(g,arguments);if(!l){delete m[o];j=null;}}}k[0]=n;o=p.apply(g,k);m[o]={args:k,created:Date.now(),cb:j,id:o};return o;}function b(p,n,j,q){var k=j[q];if(!k){return;}var l=(p===f);n(k.id);if(!l){var m=k.args[1];var o=Date.now()-k.created;if(o<0){o=0;}m-=o;if(m<0){m=0;}k.args[1]=m}function r(){if(k.cb){k.cb.apply(g,arguments);if(!l){delete j[q];k.cb=null}}}k.args[0]=r;k.created=Date.now();k.id=p.apply(g,k.args)}g.setTimeout=function(){return i(e,a,arguments)};g.setInterval=function(){return i(f,d,arguments)};g.clearTimeout=function(k){var j=a[k];if(j){delete a[k];h(j.id)}};g.clearInterval=function(k){var j=d[k];if(j){delete d[k];c(j.id)}};g.addEventListener("scroll",function(){var j;for(j in a){b(e,h,a,j)}for(j in d){b(f,c,d,j)}})}(window));


//touch event handler
function addTouchEvent(c,g){"use strict";var f,d,k,h,e=false,i=false,b=function(l){if(l.touches.length===1){h=Number(new Date());f=l.touches[0].pageX;d=l.touches[0].pageY;c.addEventListener("touchmove",a,false);c.addEventListener("touchend",j,false)}},a=function(l){k=f-l.touches[0].pageX;e=(Math.abs(k)<Math.abs(l.touches[0].pageY-d));if(e){i=true}if(!i){l.preventDefault()}},j=function(l){c.removeEventListener("touchmove",a,false);if(!i&&!(k===null)){if(k>0){g.left(l)}else{g.right(l)}}c.removeEventListener("touchend",j,false);f=null;d=null;k=null;i=false};c.addEventListener("touchstart",b,false)};


/* Easing for soft slide in thumbs */
jQuery.extend(jQuery.easing,{easeOutSine:function(e,f,a,h,g){return h*Math.sin(f/g*(Math.PI/2))+a;},
    easeOutExpo: function (x, t, b, c, d) {
        "use strict";
        return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
    }});

/*! Copyright (c) 2013 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.1.3
 *
 * Requires: 1.2.2+
 */
(function(a){if(typeof define==="function"&&define.amd){define(["jquery"],a)}else{if(typeof exports==="object"){module.exports=a}else{a(jQuery)}}}(function(e){var d=["wheel","mousewheel","DOMMouseScroll","MozMousePixelScroll"];var g="onwheel" in document||document.documentMode>=9?["wheel"]:["mousewheel","DomMouseScroll","MozMousePixelScroll"];var f,a;if(e.event.fixHooks){for(var b=d.length;b;){e.event.fixHooks[d[--b]]=e.event.mouseHooks}}e.event.special.mousewheel={setup:function(){if(this.addEventListener){for(var h=g.length;h;){this.addEventListener(g[--h],c,false)}}else{this.onmousewheel=c}},teardown:function(){if(this.removeEventListener){for(var h=g.length;h;){this.removeEventListener(g[--h],c,false)}}else{this.onmousewheel=null}}};e.fn.extend({mousewheel:function(h){return h?this.bind("mousewheel",h):this.trigger("mousewheel")},unmousewheel:function(h){return this.unbind("mousewheel",h)}});function c(h){var i=h||window.event,n=[].slice.call(arguments,1),p=0,k=0,j=0,m=0,l=0,o;h=e.event.fix(i);h.type="mousewheel";if(i.wheelDelta){p=i.wheelDelta}if(i.detail){p=i.detail*-1}if(i.deltaY){j=i.deltaY*-1;p=j}if(i.deltaX){k=i.deltaX;p=k*-1}if(i.wheelDeltaY!==undefined){j=i.wheelDeltaY}if(i.wheelDeltaX!==undefined){k=i.wheelDeltaX*-1}m=Math.abs(p);if(!f||m<f){f=m}l=Math.max(Math.abs(j),Math.abs(k));if(!a||l<a){a=l}o=p>0?"floor":"ceil";p=Math[o](p/f);k=Math[o](k/a);j=Math[o](j/a);n.unshift(h,p,k,j);return(e.event.dispatch||e.event.handle).apply(this,n)}}));


/* FitVids.js / jquery.fitvids.min.js */
(function(a){"use strict";a.fn.fitVids=function(b){var c={customSelector:null},d=document.createElement("div"),e=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0];return d.className="fit-vids-style",d.innerHTML="&shy;<style>               .fluid-width-video-wrapper {                 width: 100%;                              position: relative;                       padding: 0;                            }                                                                                   .fluid-width-video-wrapper iframe,        .fluid-width-video-wrapper object,        .fluid-width-video-wrapper embed {           position: absolute;                       top: 0;                                   left: 0;                                  width: 100%;                              height: 100%;                          }                                       </style>",e.parentNode.insertBefore(d,e),b&&a.extend(c,b),this.each(function(){var b=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com']","object","embed"];c.customSelector&&b.push(c.customSelector);var d=a(this).find(b.join(","));d.each(function(){var b=a(this);if(!("embed"===this.tagName.toLowerCase()&&b.parent("object").length||b.parent(".fluid-width-video-wrapper").length)){var c="object"===this.tagName.toLowerCase()||b.attr("height")&&!isNaN(parseInt(b.attr("height"),10))?parseInt(b.attr("height"),10):b.height(),d=isNaN(parseInt(b.attr("width"),10))?b.width():parseInt(b.attr("width"),10),e=c/d;if(!b.attr("id")){var f="fitvid"+Math.floor(999999*Math.random());b.attr("id",f)}b.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*e+"%"),b.removeAttr("height").removeAttr("width")}})})}})(jQuery);


/*
 * jQuery resize event - v1.1 - 3/14/2010
 * http://benalman.com/projects/jquery-resize-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($,h,c){var a=$([]),e=$.resize=$.extend($.resize,{}),i,k="setTimeout",j="resize",d=j+"-special-event",b="delay",f="throttleWindow";e[b]=250;e[f]=true;$.event.special[j]={setup:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.add(l);$.data(this,d,{w:l.width(),h:l.height()});if(a.length===1){g()}},teardown:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.not(l);l.removeData(d);if(!a.length){clearTimeout(i)}},add:function(l){if(!e[f]&&this[k]){return false}var n;function m(s,o,p){var q=$(this),r=$.data(this,d);r.w=o!==c?o:q.width();r.h=p!==c?p:q.height();n.apply(this,arguments)}if($.isFunction(l)){n=l;return m}else{n=l.handler;l.handler=m}}};function g(){i=h[k](function(){a.each(function(){var n=$(this),m=n.width(),l=n.height(),o=$.data(this,d);if(m!==o.w||l!==o.h){n.trigger(j,[o.w=m,o.h=l])}});g()},e[b])}})(jQuery,this);