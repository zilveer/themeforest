// @codekit-append "atoms/plugins/easing.js";
// @codekit-append "atoms/plugins/velocity.min.js";
// @codekit-append "atoms/plugins/ripple.js";
// @codekit-append "atoms/plugins/waves.js";
// @codekit-append "atoms/plugins/layzr.js";

// @codekit-append "atoms/plugins/mfp.js";
// @codekit-append "atoms/plugins/before-after.js";
// @codekit-append "atoms/plugins/parallax.js";
// @codekit-append "atoms/plugins/tooltip.js";
// @codekit-append "atoms/plugins/custom-scrollbar.js";
// @codekit-append "atoms/plugins/custom-select.js";
// @codekit-append "atoms/plugins/isotope.js";
// @codekit-append "atoms/plugins/jquery.filterade.js";


// @codekit-append "atoms/retinizer.js";
// @codekit-append "atoms/custom-touch-events.js";
// @codekit-append "atoms/jquery.event.move.js";
// @codekit-append "atoms/in-viewport.js";
// @codekit-append "atoms/element-exists.js";
// @codekit-append "atoms/photo-scroller.js";
// @codekit-append "atoms/shortcode-scroller.js";
// @codekit-append "atoms/main-navigation.js";
// @codekit-append "atoms/header.js";
// @codekit-append "atoms/soc-icons.js";
// @codekit-append "atoms/mobile-header.js";
// @codekit-append "atoms/floating-menu.js";
// @codekit-append "atoms/custom-menu.js";
// @codekit-append "atoms/filter.js";
// @codekit-append "atoms/onepage.js";

// @codekit-append "atoms/hovers.js";
// @codekit-append "atoms/forms.js";
// @codekit-append "atoms/fullwidth-row.js";
// @codekit-append "atoms/misc.js";

// @codekit-append "atoms/masonry-initialisation.js";
// @codekit-append "atoms/custom-resize.js";
// @codekit-append "atoms/ajax.js";
// @codekit-append "atoms/dtPostsJQueryFilter.js";





/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
/*if(typeof jQuery.easing["jswing"] === typeof undefined){*/
	jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,t,n,r,i){return jQuery.easing[jQuery.easing.def](e,t,n,r,i)},easeInQuad:function(e,t,n,r,i){return r*(t/=i)*t+n},easeOutQuad:function(e,t,n,r,i){return-r*(t/=i)*(t-2)+n},easeInOutQuad:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t+n;return-r/2*(--t*(t-2)-1)+n},easeInCubic:function(e,t,n,r,i){return r*(t/=i)*t*t+n},easeOutCubic:function(e,t,n,r,i){return r*((t=t/i-1)*t*t+1)+n},easeInOutCubic:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t+n;return r/2*((t-=2)*t*t+2)+n},easeInQuart:function(e,t,n,r,i){return r*(t/=i)*t*t*t+n},easeOutQuart:function(e,t,n,r,i){return-r*((t=t/i-1)*t*t*t-1)+n},easeInOutQuart:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t+n;return-r/2*((t-=2)*t*t*t-2)+n},easeInQuint:function(e,t,n,r,i){return r*(t/=i)*t*t*t*t+n},easeOutQuint:function(e,t,n,r,i){return r*((t=t/i-1)*t*t*t*t+1)+n},easeInOutQuint:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t*t+n;return r/2*((t-=2)*t*t*t*t+2)+n},easeInSine:function(e,t,n,r,i){return-r*Math.cos(t/i*(Math.PI/2))+r+n},easeOutSine:function(e,t,n,r,i){return r*Math.sin(t/i*(Math.PI/2))+n},easeInOutSine:function(e,t,n,r,i){return-r/2*(Math.cos(Math.PI*t/i)-1)+n},easeInExpo:function(e,t,n,r,i){return t==0?n:r*Math.pow(2,10*(t/i-1))+n},easeOutExpo:function(e,t,n,r,i){return t==i?n+r:r*(-Math.pow(2,-10*t/i)+1)+n},easeInOutExpo:function(e,t,n,r,i){if(t==0)return n;if(t==i)return n+r;if((t/=i/2)<1)return r/2*Math.pow(2,10*(t-1))+n;return r/2*(-Math.pow(2,-10*--t)+2)+n},easeInCirc:function(e,t,n,r,i){return-r*(Math.sqrt(1-(t/=i)*t)-1)+n},easeOutCirc:function(e,t,n,r,i){return r*Math.sqrt(1-(t=t/i-1)*t)+n},easeInOutCirc:function(e,t,n,r,i){if((t/=i/2)<1)return-r/2*(Math.sqrt(1-t*t)-1)+n;return r/2*(Math.sqrt(1-(t-=2)*t)+1)+n},easeInElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return-(u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o))+n},easeOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return u*Math.pow(2,-10*t)*Math.sin((t*i-s)*2*Math.PI/o)+r+n},easeInOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i/2)==2)return n+r;if(!o)o=i*.3*1.5;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);if(t<1)return-.5*u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)+n;return u*Math.pow(2,-10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)*.5+r+n},easeInBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*(t/=i)*t*((s+1)*t-s)+n},easeOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*((t=t/i-1)*t*((s+1)*t+s)+1)+n},easeInOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;if((t/=i/2)<1)return r/2*t*t*(((s*=1.525)+1)*t-s)+n;return r/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+n},easeInBounce:function(e,t,n,r,i){return r-jQuery.easing.easeOutBounce(e,i-t,0,r,i)+n},easeOutBounce:function(e,t,n,r,i){if((t/=i)<1/2.75){return r*7.5625*t*t+n}else if(t<2/2.75){return r*(7.5625*(t-=1.5/2.75)*t+.75)+n}else if(t<2.5/2.75){return r*(7.5625*(t-=2.25/2.75)*t+.9375)+n}else{return r*(7.5625*(t-=2.625/2.75)*t+.984375)+n}},easeInOutBounce:function(e,t,n,r,i){if(t<i/2)return jQuery.easing.easeInBounce(e,t*2,0,r,i)*.5+n;return jQuery.easing.easeOutBounce(e,t*2-i,0,r,i)*.5+r*.5+n}})/*}*/

/*! VelocityJS.org (1.2.3). (C) 2014 Julian Shapiro. MIT @license: en.wikipedia.org/wiki/MIT_License */
/*! VelocityJS.org jQuery Shim (1.0.1). (C) 2014 The jQuery Foundation. MIT @license: en.wikipedia.org/wiki/MIT_License. */
!function(a){function b(a){var b=a.length,d=c.type(a);return"function"===d||c.isWindow(a)?!1:1===a.nodeType&&b?!0:"array"===d||0===b||"number"==typeof b&&b>0&&b-1 in a}if(!a.jQuery){var c=function(a,b){return new c.fn.init(a,b)};c.isWindow=function(a){return null!=a&&a==a.window},c.type=function(a){return null==a?a+"":"object"==typeof a||"function"==typeof a?e[g.call(a)]||"object":typeof a},c.isArray=Array.isArray||function(a){return"array"===c.type(a)},c.isPlainObject=function(a){var b;if(!a||"object"!==c.type(a)||a.nodeType||c.isWindow(a))return!1;try{if(a.constructor&&!f.call(a,"constructor")&&!f.call(a.constructor.prototype,"isPrototypeOf"))return!1}catch(d){return!1}for(b in a);return void 0===b||f.call(a,b)},c.each=function(a,c,d){var e,f=0,g=a.length,h=b(a);if(d){if(h)for(;g>f&&(e=c.apply(a[f],d),e!==!1);f++);else for(f in a)if(e=c.apply(a[f],d),e===!1)break}else if(h)for(;g>f&&(e=c.call(a[f],f,a[f]),e!==!1);f++);else for(f in a)if(e=c.call(a[f],f,a[f]),e===!1)break;return a},c.data=function(a,b,e){if(void 0===e){var f=a[c.expando],g=f&&d[f];if(void 0===b)return g;if(g&&b in g)return g[b]}else if(void 0!==b){var f=a[c.expando]||(a[c.expando]=++c.uuid);return d[f]=d[f]||{},d[f][b]=e,e}},c.removeData=function(a,b){var e=a[c.expando],f=e&&d[e];f&&c.each(b,function(a,b){delete f[b]})},c.extend=function(){var a,b,d,e,f,g,h=arguments[0]||{},i=1,j=arguments.length,k=!1;for("boolean"==typeof h&&(k=h,h=arguments[i]||{},i++),"object"!=typeof h&&"function"!==c.type(h)&&(h={}),i===j&&(h=this,i--);j>i;i++)if(null!=(f=arguments[i]))for(e in f)a=h[e],d=f[e],h!==d&&(k&&d&&(c.isPlainObject(d)||(b=c.isArray(d)))?(b?(b=!1,g=a&&c.isArray(a)?a:[]):g=a&&c.isPlainObject(a)?a:{},h[e]=c.extend(k,g,d)):void 0!==d&&(h[e]=d));return h},c.queue=function(a,d,e){function f(a,c){var d=c||[];return null!=a&&(b(Object(a))?!function(a,b){for(var c=+b.length,d=0,e=a.length;c>d;)a[e++]=b[d++];if(c!==c)for(;void 0!==b[d];)a[e++]=b[d++];return a.length=e,a}(d,"string"==typeof a?[a]:a):[].push.call(d,a)),d}if(a){d=(d||"fx")+"queue";var g=c.data(a,d);return e?(!g||c.isArray(e)?g=c.data(a,d,f(e)):g.push(e),g):g||[]}},c.dequeue=function(a,b){c.each(a.nodeType?[a]:a,function(a,d){b=b||"fx";var e=c.queue(d,b),f=e.shift();"inprogress"===f&&(f=e.shift()),f&&("fx"===b&&e.unshift("inprogress"),f.call(d,function(){c.dequeue(d,b)}))})},c.fn=c.prototype={init:function(a){if(a.nodeType)return this[0]=a,this;throw new Error("Not a DOM node.")},offset:function(){var b=this[0].getBoundingClientRect?this[0].getBoundingClientRect():{top:0,left:0};return{top:b.top+(a.pageYOffset||document.scrollTop||0)-(document.clientTop||0),left:b.left+(a.pageXOffset||document.scrollLeft||0)-(document.clientLeft||0)}},position:function(){function a(){for(var a=this.offsetParent||document;a&&"html"===!a.nodeType.toLowerCase&&"static"===a.style.position;)a=a.offsetParent;return a||document}var b=this[0],a=a.apply(b),d=this.offset(),e=/^(?:body|html)$/i.test(a.nodeName)?{top:0,left:0}:c(a).offset();return d.top-=parseFloat(b.style.marginTop)||0,d.left-=parseFloat(b.style.marginLeft)||0,a.style&&(e.top+=parseFloat(a.style.borderTopWidth)||0,e.left+=parseFloat(a.style.borderLeftWidth)||0),{top:d.top-e.top,left:d.left-e.left}}};var d={};c.expando="velocity"+(new Date).getTime(),c.uuid=0;for(var e={},f=e.hasOwnProperty,g=e.toString,h="Boolean Number String Function Array Date RegExp Object Error".split(" "),i=0;i<h.length;i++)e["[object "+h[i]+"]"]=h[i].toLowerCase();c.fn.init.prototype=c.fn,a.Velocity={Utilities:c}}}(window),function(a){"object"==typeof module&&"object"==typeof module.exports?module.exports=a():"function"==typeof define&&define.amd?define(a):a()}(function(){return function(a,b,c,d){function e(a){for(var b=-1,c=a?a.length:0,d=[];++b<c;){var e=a[b];e&&d.push(e)}return d}function f(a){return p.isWrapped(a)?a=[].slice.call(a):p.isNode(a)&&(a=[a]),a}function g(a){var b=m.data(a,"velocity");return null===b?d:b}function h(a){return function(b){return Math.round(b*a)*(1/a)}}function i(a,c,d,e){function f(a,b){return 1-3*b+3*a}function g(a,b){return 3*b-6*a}function h(a){return 3*a}function i(a,b,c){return((f(b,c)*a+g(b,c))*a+h(b))*a}function j(a,b,c){return 3*f(b,c)*a*a+2*g(b,c)*a+h(b)}function k(b,c){for(var e=0;p>e;++e){var f=j(c,a,d);if(0===f)return c;var g=i(c,a,d)-b;c-=g/f}return c}function l(){for(var b=0;t>b;++b)x[b]=i(b*u,a,d)}function m(b,c,e){var f,g,h=0;do g=c+(e-c)/2,f=i(g,a,d)-b,f>0?e=g:c=g;while(Math.abs(f)>r&&++h<s);return g}function n(b){for(var c=0,e=1,f=t-1;e!=f&&x[e]<=b;++e)c+=u;--e;var g=(b-x[e])/(x[e+1]-x[e]),h=c+g*u,i=j(h,a,d);return i>=q?k(b,h):0==i?h:m(b,c,c+u)}function o(){y=!0,(a!=c||d!=e)&&l()}var p=4,q=.001,r=1e-7,s=10,t=11,u=1/(t-1),v="Float32Array"in b;if(4!==arguments.length)return!1;for(var w=0;4>w;++w)if("number"!=typeof arguments[w]||isNaN(arguments[w])||!isFinite(arguments[w]))return!1;a=Math.min(a,1),d=Math.min(d,1),a=Math.max(a,0),d=Math.max(d,0);var x=v?new Float32Array(t):new Array(t),y=!1,z=function(b){return y||o(),a===c&&d===e?b:0===b?0:1===b?1:i(n(b),c,e)};z.getControlPoints=function(){return[{x:a,y:c},{x:d,y:e}]};var A="generateBezier("+[a,c,d,e]+")";return z.toString=function(){return A},z}function j(a,b){var c=a;return p.isString(a)?t.Easings[a]||(c=!1):c=p.isArray(a)&&1===a.length?h.apply(null,a):p.isArray(a)&&2===a.length?u.apply(null,a.concat([b])):p.isArray(a)&&4===a.length?i.apply(null,a):!1,c===!1&&(c=t.Easings[t.defaults.easing]?t.defaults.easing:s),c}function k(a){if(a){var b=(new Date).getTime(),c=t.State.calls.length;c>1e4&&(t.State.calls=e(t.State.calls));for(var f=0;c>f;f++)if(t.State.calls[f]){var h=t.State.calls[f],i=h[0],j=h[2],n=h[3],o=!!n,q=null;n||(n=t.State.calls[f][3]=b-16);for(var r=Math.min((b-n)/j.duration,1),s=0,u=i.length;u>s;s++){var w=i[s],y=w.element;if(g(y)){var z=!1;if(j.display!==d&&null!==j.display&&"none"!==j.display){if("flex"===j.display){var A=["-webkit-box","-moz-box","-ms-flexbox","-webkit-flex"];m.each(A,function(a,b){v.setPropertyValue(y,"display",b)})}v.setPropertyValue(y,"display",j.display)}j.visibility!==d&&"hidden"!==j.visibility&&v.setPropertyValue(y,"visibility",j.visibility);for(var B in w)if("element"!==B){var C,D=w[B],E=p.isString(D.easing)?t.Easings[D.easing]:D.easing;if(1===r)C=D.endValue;else{var F=D.endValue-D.startValue;if(C=D.startValue+F*E(r,j,F),!o&&C===D.currentValue)continue}if(D.currentValue=C,"tween"===B)q=C;else{if(v.Hooks.registered[B]){var G=v.Hooks.getRoot(B),H=g(y).rootPropertyValueCache[G];H&&(D.rootPropertyValue=H)}var I=v.setPropertyValue(y,B,D.currentValue+(0===parseFloat(C)?"":D.unitType),D.rootPropertyValue,D.scrollData);v.Hooks.registered[B]&&(g(y).rootPropertyValueCache[G]=v.Normalizations.registered[G]?v.Normalizations.registered[G]("extract",null,I[1]):I[1]),"transform"===I[0]&&(z=!0)}}j.mobileHA&&g(y).transformCache.translate3d===d&&(g(y).transformCache.translate3d="(0px, 0px, 0px)",z=!0),z&&v.flushTransformCache(y)}}j.display!==d&&"none"!==j.display&&(t.State.calls[f][2].display=!1),j.visibility!==d&&"hidden"!==j.visibility&&(t.State.calls[f][2].visibility=!1),j.progress&&j.progress.call(h[1],h[1],r,Math.max(0,n+j.duration-b),n,q),1===r&&l(f)}}t.State.isTicking&&x(k)}function l(a,b){if(!t.State.calls[a])return!1;for(var c=t.State.calls[a][0],e=t.State.calls[a][1],f=t.State.calls[a][2],h=t.State.calls[a][4],i=!1,j=0,k=c.length;k>j;j++){var l=c[j].element;if(b||f.loop||("none"===f.display&&v.setPropertyValue(l,"display",f.display),"hidden"===f.visibility&&v.setPropertyValue(l,"visibility",f.visibility)),f.loop!==!0&&(m.queue(l)[1]===d||!/\.velocityQueueEntryFlag/i.test(m.queue(l)[1]))&&g(l)){g(l).isAnimating=!1,g(l).rootPropertyValueCache={};var n=!1;m.each(v.Lists.transforms3D,function(a,b){var c=/^scale/.test(b)?1:0,e=g(l).transformCache[b];g(l).transformCache[b]!==d&&new RegExp("^\\("+c+"[^.]").test(e)&&(n=!0,delete g(l).transformCache[b])}),f.mobileHA&&(n=!0,delete g(l).transformCache.translate3d),n&&v.flushTransformCache(l),v.Values.removeClass(l,"velocity-animating")}if(!b&&f.complete&&!f.loop&&j===k-1)try{f.complete.call(e,e)}catch(o){setTimeout(function(){throw o},1)}h&&f.loop!==!0&&h(e),g(l)&&f.loop===!0&&!b&&(m.each(g(l).tweensContainer,function(a,b){/^rotate/.test(a)&&360===parseFloat(b.endValue)&&(b.endValue=0,b.startValue=360),/^backgroundPosition/.test(a)&&100===parseFloat(b.endValue)&&"%"===b.unitType&&(b.endValue=0,b.startValue=100)}),t(l,"reverse",{loop:!0,delay:f.delay})),f.queue!==!1&&m.dequeue(l,f.queue)}t.State.calls[a]=!1;for(var p=0,q=t.State.calls.length;q>p;p++)if(t.State.calls[p]!==!1){i=!0;break}i===!1&&(t.State.isTicking=!1,delete t.State.calls,t.State.calls=[])}var m,n=function(){if(c.documentMode)return c.documentMode;for(var a=7;a>4;a--){var b=c.createElement("div");if(b.innerHTML="<!--[if IE "+a+"]><span></span><![endif]-->",b.getElementsByTagName("span").length)return b=null,a}return d}(),o=function(){var a=0;return b.webkitRequestAnimationFrame||b.mozRequestAnimationFrame||function(b){var c,d=(new Date).getTime();return c=Math.max(0,16-(d-a)),a=d+c,setTimeout(function(){b(d+c)},c)}}(),p={isString:function(a){return"string"==typeof a},isArray:Array.isArray||function(a){return"[object Array]"===Object.prototype.toString.call(a)},isFunction:function(a){return"[object Function]"===Object.prototype.toString.call(a)},isNode:function(a){return a&&a.nodeType},isNodeList:function(a){return"object"==typeof a&&/^\[object (HTMLCollection|NodeList|Object)\]$/.test(Object.prototype.toString.call(a))&&a.length!==d&&(0===a.length||"object"==typeof a[0]&&a[0].nodeType>0)},isWrapped:function(a){return a&&(a.jquery||b.Zepto&&b.Zepto.zepto.isZ(a))},isSVG:function(a){return b.SVGElement&&a instanceof b.SVGElement},isEmptyObject:function(a){for(var b in a)return!1;return!0}},q=!1;if(a.fn&&a.fn.jquery?(m=a,q=!0):m=b.Velocity.Utilities,8>=n&&!q)throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");if(7>=n)return void(jQuery.fn.velocity=jQuery.fn.animate);var r=400,s="swing",t={State:{isMobile:/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),isAndroid:/Android/i.test(navigator.userAgent),isGingerbread:/Android 2\.3\.[3-7]/i.test(navigator.userAgent),isChrome:b.chrome,isFirefox:/Firefox/i.test(navigator.userAgent),prefixElement:c.createElement("div"),prefixMatches:{},scrollAnchor:null,scrollPropertyLeft:null,scrollPropertyTop:null,isTicking:!1,calls:[]},CSS:{},Utilities:m,Redirects:{},Easings:{},Promise:b.Promise,defaults:{queue:"",duration:r,easing:s,begin:d,complete:d,progress:d,display:d,visibility:d,loop:!1,delay:!1,mobileHA:!0,_cacheValues:!0},init:function(a){m.data(a,"velocity",{isSVG:p.isSVG(a),isAnimating:!1,computedStyle:null,tweensContainer:null,rootPropertyValueCache:{},transformCache:{}})},hook:null,mock:!1,version:{major:1,minor:2,patch:2},debug:!1};b.pageYOffset!==d?(t.State.scrollAnchor=b,t.State.scrollPropertyLeft="pageXOffset",t.State.scrollPropertyTop="pageYOffset"):(t.State.scrollAnchor=c.documentElement||c.body.parentNode||c.body,t.State.scrollPropertyLeft="scrollLeft",t.State.scrollPropertyTop="scrollTop");var u=function(){function a(a){return-a.tension*a.x-a.friction*a.v}function b(b,c,d){var e={x:b.x+d.dx*c,v:b.v+d.dv*c,tension:b.tension,friction:b.friction};return{dx:e.v,dv:a(e)}}function c(c,d){var e={dx:c.v,dv:a(c)},f=b(c,.5*d,e),g=b(c,.5*d,f),h=b(c,d,g),i=1/6*(e.dx+2*(f.dx+g.dx)+h.dx),j=1/6*(e.dv+2*(f.dv+g.dv)+h.dv);return c.x=c.x+i*d,c.v=c.v+j*d,c}return function d(a,b,e){var f,g,h,i={x:-1,v:0,tension:null,friction:null},j=[0],k=0,l=1e-4,m=.016;for(a=parseFloat(a)||500,b=parseFloat(b)||20,e=e||null,i.tension=a,i.friction=b,f=null!==e,f?(k=d(a,b),g=k/e*m):g=m;;)if(h=c(h||i,g),j.push(1+h.x),k+=16,!(Math.abs(h.x)>l&&Math.abs(h.v)>l))break;return f?function(a){return j[a*(j.length-1)|0]}:k}}();t.Easings={linear:function(a){return a},swing:function(a){return.5-Math.cos(a*Math.PI)/2},spring:function(a){return 1-Math.cos(4.5*a*Math.PI)*Math.exp(6*-a)}},m.each([["ease",[.25,.1,.25,1]],["ease-in",[.42,0,1,1]],["ease-out",[0,0,.58,1]],["ease-in-out",[.42,0,.58,1]],["easeInSine",[.47,0,.745,.715]],["easeOutSine",[.39,.575,.565,1]],["easeInOutSine",[.445,.05,.55,.95]],["easeInQuad",[.55,.085,.68,.53]],["easeOutQuad",[.25,.46,.45,.94]],["easeInOutQuad",[.455,.03,.515,.955]],["easeInCubic",[.55,.055,.675,.19]],["easeOutCubic",[.215,.61,.355,1]],["easeInOutCubic",[.645,.045,.355,1]],["easeInQuart",[.895,.03,.685,.22]],["easeOutQuart",[.165,.84,.44,1]],["easeInOutQuart",[.77,0,.175,1]],["easeInQuint",[.755,.05,.855,.06]],["easeOutQuint",[.23,1,.32,1]],["easeInOutQuint",[.86,0,.07,1]],["easeInExpo",[.95,.05,.795,.035]],["easeOutExpo",[.19,1,.22,1]],["easeInOutExpo",[1,0,0,1]],["easeInCirc",[.6,.04,.98,.335]],["easeOutCirc",[.075,.82,.165,1]],["easeInOutCirc",[.785,.135,.15,.86]]],function(a,b){t.Easings[b[0]]=i.apply(null,b[1])});var v=t.CSS={RegEx:{isHex:/^#([A-f\d]{3}){1,2}$/i,valueUnwrap:/^[A-z]+\((.*)\)$/i,wrappedValueAlreadyExtracted:/[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,valueSplit:/([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi},Lists:{colors:["fill","stroke","stopColor","color","backgroundColor","borderColor","borderTopColor","borderRightColor","borderBottomColor","borderLeftColor","outlineColor"],transformsBase:["translateX","translateY","scale","scaleX","scaleY","skewX","skewY","rotateZ"],transforms3D:["transformPerspective","translateZ","scaleZ","rotateX","rotateY"]},Hooks:{templates:{textShadow:["Color X Y Blur","black 0px 0px 0px"],boxShadow:["Color X Y Blur Spread","black 0px 0px 0px 0px"],clip:["Top Right Bottom Left","0px 0px 0px 0px"],backgroundPosition:["X Y","0% 0%"],transformOrigin:["X Y Z","50% 50% 0px"],perspectiveOrigin:["X Y","50% 50%"]},registered:{},register:function(){for(var a=0;a<v.Lists.colors.length;a++){var b="color"===v.Lists.colors[a]?"0 0 0 1":"255 255 255 1";v.Hooks.templates[v.Lists.colors[a]]=["Red Green Blue Alpha",b]}var c,d,e;if(n)for(c in v.Hooks.templates){d=v.Hooks.templates[c],e=d[0].split(" ");var f=d[1].match(v.RegEx.valueSplit);"Color"===e[0]&&(e.push(e.shift()),f.push(f.shift()),v.Hooks.templates[c]=[e.join(" "),f.join(" ")])}for(c in v.Hooks.templates){d=v.Hooks.templates[c],e=d[0].split(" ");for(var a in e){var g=c+e[a],h=a;v.Hooks.registered[g]=[c,h]}}},getRoot:function(a){var b=v.Hooks.registered[a];return b?b[0]:a},cleanRootPropertyValue:function(a,b){return v.RegEx.valueUnwrap.test(b)&&(b=b.match(v.RegEx.valueUnwrap)[1]),v.Values.isCSSNullValue(b)&&(b=v.Hooks.templates[a][1]),b},extractValue:function(a,b){var c=v.Hooks.registered[a];if(c){var d=c[0],e=c[1];return b=v.Hooks.cleanRootPropertyValue(d,b),b.toString().match(v.RegEx.valueSplit)[e]}return b},injectValue:function(a,b,c){var d=v.Hooks.registered[a];if(d){var e,f,g=d[0],h=d[1];return c=v.Hooks.cleanRootPropertyValue(g,c),e=c.toString().match(v.RegEx.valueSplit),e[h]=b,f=e.join(" ")}return c}},Normalizations:{registered:{clip:function(a,b,c){switch(a){case"name":return"clip";case"extract":var d;return v.RegEx.wrappedValueAlreadyExtracted.test(c)?d=c:(d=c.toString().match(v.RegEx.valueUnwrap),d=d?d[1].replace(/,(\s+)?/g," "):c),d;case"inject":return"rect("+c+")"}},blur:function(a,b,c){switch(a){case"name":return t.State.isFirefox?"filter":"-webkit-filter";case"extract":var d=parseFloat(c);if(!d&&0!==d){var e=c.toString().match(/blur\(([0-9]+[A-z]+)\)/i);d=e?e[1]:0}return d;case"inject":return parseFloat(c)?"blur("+c+")":"none"}},opacity:function(a,b,c){if(8>=n)switch(a){case"name":return"filter";case"extract":var d=c.toString().match(/alpha\(opacity=(.*)\)/i);return c=d?d[1]/100:1;case"inject":return b.style.zoom=1,parseFloat(c)>=1?"":"alpha(opacity="+parseInt(100*parseFloat(c),10)+")"}else switch(a){case"name":return"opacity";case"extract":return c;case"inject":return c}}},register:function(){9>=n||t.State.isGingerbread||(v.Lists.transformsBase=v.Lists.transformsBase.concat(v.Lists.transforms3D));for(var a=0;a<v.Lists.transformsBase.length;a++)!function(){var b=v.Lists.transformsBase[a];v.Normalizations.registered[b]=function(a,c,e){switch(a){case"name":return"transform";case"extract":return g(c)===d||g(c).transformCache[b]===d?/^scale/i.test(b)?1:0:g(c).transformCache[b].replace(/[()]/g,"");case"inject":var f=!1;switch(b.substr(0,b.length-1)){case"translate":f=!/(%|px|em|rem|vw|vh|\d)$/i.test(e);break;case"scal":case"scale":t.State.isAndroid&&g(c).transformCache[b]===d&&1>e&&(e=1),f=!/(\d)$/i.test(e);break;case"skew":f=!/(deg|\d)$/i.test(e);break;case"rotate":f=!/(deg|\d)$/i.test(e)}return f||(g(c).transformCache[b]="("+e+")"),g(c).transformCache[b]}}}();for(var a=0;a<v.Lists.colors.length;a++)!function(){var b=v.Lists.colors[a];v.Normalizations.registered[b]=function(a,c,e){switch(a){case"name":return b;case"extract":var f;if(v.RegEx.wrappedValueAlreadyExtracted.test(e))f=e;else{var g,h={black:"rgb(0, 0, 0)",blue:"rgb(0, 0, 255)",gray:"rgb(128, 128, 128)",green:"rgb(0, 128, 0)",red:"rgb(255, 0, 0)",white:"rgb(255, 255, 255)"};/^[A-z]+$/i.test(e)?g=h[e]!==d?h[e]:h.black:v.RegEx.isHex.test(e)?g="rgb("+v.Values.hexToRgb(e).join(" ")+")":/^rgba?\(/i.test(e)||(g=h.black),f=(g||e).toString().match(v.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g," ")}return 8>=n||3!==f.split(" ").length||(f+=" 1"),f;case"inject":return 8>=n?4===e.split(" ").length&&(e=e.split(/\s+/).slice(0,3).join(" ")):3===e.split(" ").length&&(e+=" 1"),(8>=n?"rgb":"rgba")+"("+e.replace(/\s+/g,",").replace(/\.(\d)+(?=,)/g,"")+")"}}}()}},Names:{camelCase:function(a){return a.replace(/-(\w)/g,function(a,b){return b.toUpperCase()})},SVGAttribute:function(a){var b="width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";return(n||t.State.isAndroid&&!t.State.isChrome)&&(b+="|transform"),new RegExp("^("+b+")$","i").test(a)},prefixCheck:function(a){if(t.State.prefixMatches[a])return[t.State.prefixMatches[a],!0];for(var b=["","Webkit","Moz","ms","O"],c=0,d=b.length;d>c;c++){var e;if(e=0===c?a:b[c]+a.replace(/^\w/,function(a){return a.toUpperCase()}),p.isString(t.State.prefixElement.style[e]))return t.State.prefixMatches[a]=e,[e,!0]}return[a,!1]}},Values:{hexToRgb:function(a){var b,c=/^#?([a-f\d])([a-f\d])([a-f\d])$/i,d=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;return a=a.replace(c,function(a,b,c,d){return b+b+c+c+d+d}),b=d.exec(a),b?[parseInt(b[1],16),parseInt(b[2],16),parseInt(b[3],16)]:[0,0,0]},isCSSNullValue:function(a){return 0==a||/^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(a)},getUnitType:function(a){return/^(rotate|skew)/i.test(a)?"deg":/(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(a)?"":"px"},getDisplayType:function(a){var b=a&&a.tagName.toString().toLowerCase();return/^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(b)?"inline":/^(li)$/i.test(b)?"list-item":/^(tr)$/i.test(b)?"table-row":/^(table)$/i.test(b)?"table":/^(tbody)$/i.test(b)?"table-row-group":"block"},addClass:function(a,b){a.classList?a.classList.add(b):a.className+=(a.className.length?" ":"")+b},removeClass:function(a,b){a.classList?a.classList.remove(b):a.className=a.className.toString().replace(new RegExp("(^|\\s)"+b.split(" ").join("|")+"(\\s|$)","gi")," ")}},getPropertyValue:function(a,c,e,f){function h(a,c){function e(){j&&v.setPropertyValue(a,"display","none")}var i=0;if(8>=n)i=m.css(a,c);else{var j=!1;if(/^(width|height)$/.test(c)&&0===v.getPropertyValue(a,"display")&&(j=!0,v.setPropertyValue(a,"display",v.Values.getDisplayType(a))),!f){if("height"===c&&"border-box"!==v.getPropertyValue(a,"boxSizing").toString().toLowerCase()){var k=a.offsetHeight-(parseFloat(v.getPropertyValue(a,"borderTopWidth"))||0)-(parseFloat(v.getPropertyValue(a,"borderBottomWidth"))||0)-(parseFloat(v.getPropertyValue(a,"paddingTop"))||0)-(parseFloat(v.getPropertyValue(a,"paddingBottom"))||0);return e(),k}if("width"===c&&"border-box"!==v.getPropertyValue(a,"boxSizing").toString().toLowerCase()){var l=a.offsetWidth-(parseFloat(v.getPropertyValue(a,"borderLeftWidth"))||0)-(parseFloat(v.getPropertyValue(a,"borderRightWidth"))||0)-(parseFloat(v.getPropertyValue(a,"paddingLeft"))||0)-(parseFloat(v.getPropertyValue(a,"paddingRight"))||0);return e(),l}}var o;o=g(a)===d?b.getComputedStyle(a,null):g(a).computedStyle?g(a).computedStyle:g(a).computedStyle=b.getComputedStyle(a,null),"borderColor"===c&&(c="borderTopColor"),i=9===n&&"filter"===c?o.getPropertyValue(c):o[c],(""===i||null===i)&&(i=a.style[c]),e()}if("auto"===i&&/^(top|right|bottom|left)$/i.test(c)){var p=h(a,"position");("fixed"===p||"absolute"===p&&/top|left/i.test(c))&&(i=m(a).position()[c]+"px")}return i}var i;if(v.Hooks.registered[c]){var j=c,k=v.Hooks.getRoot(j);e===d&&(e=v.getPropertyValue(a,v.Names.prefixCheck(k)[0])),v.Normalizations.registered[k]&&(e=v.Normalizations.registered[k]("extract",a,e)),i=v.Hooks.extractValue(j,e)}else if(v.Normalizations.registered[c]){var l,o;l=v.Normalizations.registered[c]("name",a),"transform"!==l&&(o=h(a,v.Names.prefixCheck(l)[0]),v.Values.isCSSNullValue(o)&&v.Hooks.templates[c]&&(o=v.Hooks.templates[c][1])),i=v.Normalizations.registered[c]("extract",a,o)}if(!/^[\d-]/.test(i))if(g(a)&&g(a).isSVG&&v.Names.SVGAttribute(c))if(/^(height|width)$/i.test(c))try{i=a.getBBox()[c]}catch(p){i=0}else i=a.getAttribute(c);else i=h(a,v.Names.prefixCheck(c)[0]);return v.Values.isCSSNullValue(i)&&(i=0),t.debug>=2&&console.log("Get "+c+": "+i),i},setPropertyValue:function(a,c,d,e,f){var h=c;if("scroll"===c)f.container?f.container["scroll"+f.direction]=d:"Left"===f.direction?b.scrollTo(d,f.alternateValue):b.scrollTo(f.alternateValue,d);else if(v.Normalizations.registered[c]&&"transform"===v.Normalizations.registered[c]("name",a))v.Normalizations.registered[c]("inject",a,d),h="transform",d=g(a).transformCache[c];else{if(v.Hooks.registered[c]){var i=c,j=v.Hooks.getRoot(c);e=e||v.getPropertyValue(a,j),d=v.Hooks.injectValue(i,d,e),c=j}if(v.Normalizations.registered[c]&&(d=v.Normalizations.registered[c]("inject",a,d),c=v.Normalizations.registered[c]("name",a)),h=v.Names.prefixCheck(c)[0],8>=n)try{a.style[h]=d}catch(k){t.debug&&console.log("Browser does not support ["+d+"] for ["+h+"]")}else g(a)&&g(a).isSVG&&v.Names.SVGAttribute(c)?a.setAttribute(c,d):a.style[h]=d;t.debug>=2&&console.log("Set "+c+" ("+h+"): "+d)}return[h,d]},flushTransformCache:function(a){function b(b){return parseFloat(v.getPropertyValue(a,b))}var c="";if((n||t.State.isAndroid&&!t.State.isChrome)&&g(a).isSVG){var d={translate:[b("translateX"),b("translateY")],skewX:[b("skewX")],skewY:[b("skewY")],scale:1!==b("scale")?[b("scale"),b("scale")]:[b("scaleX"),b("scaleY")],rotate:[b("rotateZ"),0,0]};m.each(g(a).transformCache,function(a){/^translate/i.test(a)?a="translate":/^scale/i.test(a)?a="scale":/^rotate/i.test(a)&&(a="rotate"),d[a]&&(c+=a+"("+d[a].join(" ")+") ",delete d[a])})}else{var e,f;m.each(g(a).transformCache,function(b){return e=g(a).transformCache[b],"transformPerspective"===b?(f=e,!0):(9===n&&"rotateZ"===b&&(b="rotate"),void(c+=b+e+" "))}),f&&(c="perspective"+f+" "+c)}v.setPropertyValue(a,"transform",c)}};v.Hooks.register(),v.Normalizations.register(),t.hook=function(a,b,c){var e=d;return a=f(a),m.each(a,function(a,f){if(g(f)===d&&t.init(f),c===d)e===d&&(e=t.CSS.getPropertyValue(f,b));else{var h=t.CSS.setPropertyValue(f,b,c);"transform"===h[0]&&t.CSS.flushTransformCache(f),e=h}}),e};var w=function(){function a(){return h?B.promise||null:i}function e(){function a(){function a(a,b){var c=d,e=d,g=d;return p.isArray(a)?(c=a[0],!p.isArray(a[1])&&/^[\d-]/.test(a[1])||p.isFunction(a[1])||v.RegEx.isHex.test(a[1])?g=a[1]:(p.isString(a[1])&&!v.RegEx.isHex.test(a[1])||p.isArray(a[1]))&&(e=b?a[1]:j(a[1],h.duration),a[2]!==d&&(g=a[2]))):c=a,b||(e=e||h.easing),p.isFunction(c)&&(c=c.call(f,y,x)),p.isFunction(g)&&(g=g.call(f,y,x)),[c||0,e,g]}function l(a,b){var c,d;return d=(b||"0").toString().toLowerCase().replace(/[%A-z]+$/,function(a){return c=a,""}),c||(c=v.Values.getUnitType(a)),[d,c]}function n(){var a={myParent:f.parentNode||c.body,position:v.getPropertyValue(f,"position"),fontSize:v.getPropertyValue(f,"fontSize")},d=a.position===I.lastPosition&&a.myParent===I.lastParent,e=a.fontSize===I.lastFontSize;I.lastParent=a.myParent,I.lastPosition=a.position,I.lastFontSize=a.fontSize;var h=100,i={};if(e&&d)i.emToPx=I.lastEmToPx,i.percentToPxWidth=I.lastPercentToPxWidth,i.percentToPxHeight=I.lastPercentToPxHeight;else{var j=g(f).isSVG?c.createElementNS("http://www.w3.org/2000/svg","rect"):c.createElement("div");t.init(j),a.myParent.appendChild(j),m.each(["overflow","overflowX","overflowY"],function(a,b){t.CSS.setPropertyValue(j,b,"hidden")}),t.CSS.setPropertyValue(j,"position",a.position),t.CSS.setPropertyValue(j,"fontSize",a.fontSize),t.CSS.setPropertyValue(j,"boxSizing","content-box"),m.each(["minWidth","maxWidth","width","minHeight","maxHeight","height"],function(a,b){t.CSS.setPropertyValue(j,b,h+"%")}),t.CSS.setPropertyValue(j,"paddingLeft",h+"em"),i.percentToPxWidth=I.lastPercentToPxWidth=(parseFloat(v.getPropertyValue(j,"width",null,!0))||1)/h,i.percentToPxHeight=I.lastPercentToPxHeight=(parseFloat(v.getPropertyValue(j,"height",null,!0))||1)/h,i.emToPx=I.lastEmToPx=(parseFloat(v.getPropertyValue(j,"paddingLeft"))||1)/h,a.myParent.removeChild(j)}return null===I.remToPx&&(I.remToPx=parseFloat(v.getPropertyValue(c.body,"fontSize"))||16),null===I.vwToPx&&(I.vwToPx=parseFloat(b.innerWidth)/100,I.vhToPx=parseFloat(b.innerHeight)/100),i.remToPx=I.remToPx,i.vwToPx=I.vwToPx,i.vhToPx=I.vhToPx,t.debug>=1&&console.log("Unit ratios: "+JSON.stringify(i),f),i}if(h.begin&&0===y)try{h.begin.call(o,o)}catch(r){setTimeout(function(){throw r},1)}if("scroll"===C){var u,w,z,A=/^x$/i.test(h.axis)?"Left":"Top",D=parseFloat(h.offset)||0;h.container?p.isWrapped(h.container)||p.isNode(h.container)?(h.container=h.container[0]||h.container,u=h.container["scroll"+A],z=u+m(f).position()[A.toLowerCase()]+D):h.container=null:(u=t.State.scrollAnchor[t.State["scrollProperty"+A]],w=t.State.scrollAnchor[t.State["scrollProperty"+("Left"===A?"Top":"Left")]],z=m(f).offset()[A.toLowerCase()]+D),i={scroll:{rootPropertyValue:!1,startValue:u,currentValue:u,endValue:z,unitType:"",easing:h.easing,scrollData:{container:h.container,direction:A,alternateValue:w}},element:f},t.debug&&console.log("tweensContainer (scroll): ",i.scroll,f)}else if("reverse"===C){if(!g(f).tweensContainer)return void m.dequeue(f,h.queue);"none"===g(f).opts.display&&(g(f).opts.display="auto"),"hidden"===g(f).opts.visibility&&(g(f).opts.visibility="visible"),g(f).opts.loop=!1,g(f).opts.begin=null,g(f).opts.complete=null,s.easing||delete h.easing,s.duration||delete h.duration,h=m.extend({},g(f).opts,h);var E=m.extend(!0,{},g(f).tweensContainer);for(var F in E)if("element"!==F){var G=E[F].startValue;E[F].startValue=E[F].currentValue=E[F].endValue,E[F].endValue=G,p.isEmptyObject(s)||(E[F].easing=h.easing),t.debug&&console.log("reverse tweensContainer ("+F+"): "+JSON.stringify(E[F]),f)}i=E}else if("start"===C){var E;g(f).tweensContainer&&g(f).isAnimating===!0&&(E=g(f).tweensContainer),m.each(q,function(b,c){if(RegExp("^"+v.Lists.colors.join("$|^")+"$").test(b)){var e=a(c,!0),f=e[0],g=e[1],h=e[2];if(v.RegEx.isHex.test(f)){for(var i=["Red","Green","Blue"],j=v.Values.hexToRgb(f),k=h?v.Values.hexToRgb(h):d,l=0;l<i.length;l++){var m=[j[l]];g&&m.push(g),k!==d&&m.push(k[l]),q[b+i[l]]=m}delete q[b]}}});for(var H in q){var K=a(q[H]),L=K[0],M=K[1],N=K[2];H=v.Names.camelCase(H);var O=v.Hooks.getRoot(H),P=!1;if(g(f).isSVG||"tween"===O||v.Names.prefixCheck(O)[1]!==!1||v.Normalizations.registered[O]!==d){(h.display!==d&&null!==h.display&&"none"!==h.display||h.visibility!==d&&"hidden"!==h.visibility)&&/opacity|filter/.test(H)&&!N&&0!==L&&(N=0),h._cacheValues&&E&&E[H]?(N===d&&(N=E[H].endValue+E[H].unitType),P=g(f).rootPropertyValueCache[O]):v.Hooks.registered[H]?N===d?(P=v.getPropertyValue(f,O),N=v.getPropertyValue(f,H,P)):P=v.Hooks.templates[O][1]:N===d&&(N=v.getPropertyValue(f,H));var Q,R,S,T=!1;if(Q=l(H,N),N=Q[0],S=Q[1],Q=l(H,L),L=Q[0].replace(/^([+-\/*])=/,function(a,b){return T=b,""}),R=Q[1],N=parseFloat(N)||0,L=parseFloat(L)||0,"%"===R&&(/^(fontSize|lineHeight)$/.test(H)?(L/=100,R="em"):/^scale/.test(H)?(L/=100,R=""):/(Red|Green|Blue)$/i.test(H)&&(L=L/100*255,R="")),/[\/*]/.test(T))R=S;else if(S!==R&&0!==N)if(0===L)R=S;else{e=e||n();var U=/margin|padding|left|right|width|text|word|letter/i.test(H)||/X$/.test(H)||"x"===H?"x":"y";switch(S){case"%":N*="x"===U?e.percentToPxWidth:e.percentToPxHeight;break;case"px":break;default:N*=e[S+"ToPx"]}switch(R){case"%":N*=1/("x"===U?e.percentToPxWidth:e.percentToPxHeight);break;case"px":break;default:N*=1/e[R+"ToPx"]}}switch(T){case"+":L=N+L;break;case"-":L=N-L;break;case"*":L=N*L;break;case"/":L=N/L}i[H]={rootPropertyValue:P,startValue:N,currentValue:N,endValue:L,unitType:R,easing:M},t.debug&&console.log("tweensContainer ("+H+"): "+JSON.stringify(i[H]),f)}else t.debug&&console.log("Skipping ["+O+"] due to a lack of browser support.")}i.element=f}i.element&&(v.Values.addClass(f,"velocity-animating"),J.push(i),""===h.queue&&(g(f).tweensContainer=i,g(f).opts=h),g(f).isAnimating=!0,y===x-1?(t.State.calls.push([J,o,h,null,B.resolver]),t.State.isTicking===!1&&(t.State.isTicking=!0,k())):y++)}var e,f=this,h=m.extend({},t.defaults,s),i={};switch(g(f)===d&&t.init(f),parseFloat(h.delay)&&h.queue!==!1&&m.queue(f,h.queue,function(a){t.velocityQueueEntryFlag=!0,g(f).delayTimer={setTimeout:setTimeout(a,parseFloat(h.delay)),next:a}}),h.duration.toString().toLowerCase()){case"fast":h.duration=200;break;case"normal":h.duration=r;break;case"slow":h.duration=600;break;default:h.duration=parseFloat(h.duration)||1}t.mock!==!1&&(t.mock===!0?h.duration=h.delay=1:(h.duration*=parseFloat(t.mock)||1,h.delay*=parseFloat(t.mock)||1)),h.easing=j(h.easing,h.duration),h.begin&&!p.isFunction(h.begin)&&(h.begin=null),h.progress&&!p.isFunction(h.progress)&&(h.progress=null),h.complete&&!p.isFunction(h.complete)&&(h.complete=null),h.display!==d&&null!==h.display&&(h.display=h.display.toString().toLowerCase(),"auto"===h.display&&(h.display=t.CSS.Values.getDisplayType(f))),h.visibility!==d&&null!==h.visibility&&(h.visibility=h.visibility.toString().toLowerCase()),h.mobileHA=h.mobileHA&&t.State.isMobile&&!t.State.isGingerbread,h.queue===!1?h.delay?setTimeout(a,h.delay):a():m.queue(f,h.queue,function(b,c){return c===!0?(B.promise&&B.resolver(o),!0):(t.velocityQueueEntryFlag=!0,void a(b))}),""!==h.queue&&"fx"!==h.queue||"inprogress"===m.queue(f)[0]||m.dequeue(f)}var h,i,n,o,q,s,u=arguments[0]&&(arguments[0].p||m.isPlainObject(arguments[0].properties)&&!arguments[0].properties.names||p.isString(arguments[0].properties));if(p.isWrapped(this)?(h=!1,n=0,o=this,i=this):(h=!0,n=1,o=u?arguments[0].elements||arguments[0].e:arguments[0]),o=f(o)){u?(q=arguments[0].properties||arguments[0].p,s=arguments[0].options||arguments[0].o):(q=arguments[n],s=arguments[n+1]);var x=o.length,y=0;if(!/^(stop|finish|finishAll)$/i.test(q)&&!m.isPlainObject(s)){var z=n+1;s={};for(var A=z;A<arguments.length;A++)p.isArray(arguments[A])||!/^(fast|normal|slow)$/i.test(arguments[A])&&!/^\d/.test(arguments[A])?p.isString(arguments[A])||p.isArray(arguments[A])?s.easing=arguments[A]:p.isFunction(arguments[A])&&(s.complete=arguments[A]):s.duration=arguments[A]}var B={promise:null,resolver:null,rejecter:null};h&&t.Promise&&(B.promise=new t.Promise(function(a,b){B.resolver=a,B.rejecter=b}));var C;switch(q){case"scroll":C="scroll";break;case"reverse":C="reverse";break;case"finish":case"finishAll":case"stop":m.each(o,function(a,b){g(b)&&g(b).delayTimer&&(clearTimeout(g(b).delayTimer.setTimeout),g(b).delayTimer.next&&g(b).delayTimer.next(),delete g(b).delayTimer),"finishAll"!==q||s!==!0&&!p.isString(s)||(m.each(m.queue(b,p.isString(s)?s:""),function(a,b){p.isFunction(b)&&b()}),m.queue(b,p.isString(s)?s:"",[]))});var D=[];return m.each(t.State.calls,function(a,b){b&&m.each(b[1],function(c,e){var f=s===d?"":s;return f===!0||b[2].queue===f||s===d&&b[2].queue===!1?void m.each(o,function(c,d){d===e&&((s===!0||p.isString(s))&&(m.each(m.queue(d,p.isString(s)?s:""),function(a,b){p.isFunction(b)&&b(null,!0)
}),m.queue(d,p.isString(s)?s:"",[])),"stop"===q?(g(d)&&g(d).tweensContainer&&f!==!1&&m.each(g(d).tweensContainer,function(a,b){b.endValue=b.currentValue}),D.push(a)):("finish"===q||"finishAll"===q)&&(b[2].duration=1))}):!0})}),"stop"===q&&(m.each(D,function(a,b){l(b,!0)}),B.promise&&B.resolver(o)),a();default:if(!m.isPlainObject(q)||p.isEmptyObject(q)){if(p.isString(q)&&t.Redirects[q]){var E=m.extend({},s),F=E.duration,G=E.delay||0;return E.backwards===!0&&(o=m.extend(!0,[],o).reverse()),m.each(o,function(a,b){parseFloat(E.stagger)?E.delay=G+parseFloat(E.stagger)*a:p.isFunction(E.stagger)&&(E.delay=G+E.stagger.call(b,a,x)),E.drag&&(E.duration=parseFloat(F)||(/^(callout|transition)/.test(q)?1e3:r),E.duration=Math.max(E.duration*(E.backwards?1-a/x:(a+1)/x),.75*E.duration,200)),t.Redirects[q].call(b,b,E||{},a,x,o,B.promise?B:d)}),a()}var H="Velocity: First argument ("+q+") was not a property map, a known action, or a registered redirect. Aborting.";return B.promise?B.rejecter(new Error(H)):console.log(H),a()}C="start"}var I={lastParent:null,lastPosition:null,lastFontSize:null,lastPercentToPxWidth:null,lastPercentToPxHeight:null,lastEmToPx:null,remToPx:null,vwToPx:null,vhToPx:null},J=[];m.each(o,function(a,b){p.isNode(b)&&e.call(b)});var K,E=m.extend({},t.defaults,s);if(E.loop=parseInt(E.loop),K=2*E.loop-1,E.loop)for(var L=0;K>L;L++){var M={delay:E.delay,progress:E.progress};L===K-1&&(M.display=E.display,M.visibility=E.visibility,M.complete=E.complete),w(o,"reverse",M)}return a()}};t=m.extend(w,t),t.animate=w;var x=b.requestAnimationFrame||o;return t.State.isMobile||c.hidden===d||c.addEventListener("visibilitychange",function(){c.hidden?(x=function(a){return setTimeout(function(){a(!0)},16)},k()):x=b.requestAnimationFrame||o}),a.Velocity=t,a!==b&&(a.fn.velocity=w,a.fn.velocity.defaults=t.defaults),m.each(["Down","Up"],function(a,b){t.Redirects["slide"+b]=function(a,c,e,f,g,h){var i=m.extend({},c),j=i.begin,k=i.complete,l={height:"",marginTop:"",marginBottom:"",paddingTop:"",paddingBottom:""},n={};i.display===d&&(i.display="Down"===b?"inline"===t.CSS.Values.getDisplayType(a)?"inline-block":"block":"none"),i.begin=function(){j&&j.call(g,g);for(var c in l){n[c]=a.style[c];var d=t.CSS.getPropertyValue(a,c);l[c]="Down"===b?[d,0]:[0,d]}n.overflow=a.style.overflow,a.style.overflow="hidden"},i.complete=function(){for(var b in n)a.style[b]=n[b];k&&k.call(g,g),h&&h.resolver(g)},t(a,l,i)}}),m.each(["In","Out"],function(a,b){t.Redirects["fade"+b]=function(a,c,e,f,g,h){var i=m.extend({},c),j={opacity:"In"===b?1:0},k=i.complete;i.complete=e!==f-1?i.begin=null:function(){k&&k.call(g,g),h&&h.resolver(g)},i.display===d&&(i.display="In"===b?"auto":"none"),t(this,j,i)}}),t}(window.jQuery||window.Zepto||window,window,document)});


/**
 * jquery.ripple.js
 * 
 * @version 0.0.1
 * @author SUSH <sush@sus-happy.ner>
 * https://github.com/sus-happy/jquery.ripple.js
 */

( function( $, U ) {
    // use border-radius
    $.support.borderRadius = false;
    // use transition
    $.support.transition = false;
    $( function() {
        $.each( [ 'borderRadius', 'BorderRadius', 'MozBorderRadius', 'WebkitBorderRadius', 'OBorderRadius', 'KhtmlBorderRadius' ], function( i, v ) {
            if( document.body.style[v] !== undefined ) $.support.borderRadius = true;
            return (! $.support.borderRadius );
        } );

        var el = $("<div>");
        $.support.transition = typeof el.css("transitionProperty") === "string";
    } );

    $.extend( {
        // jquery.ripple用の関数
        ripple: {
            // アニメーションの裏に隠れないようにするDOM
            $textSpan: $('<span class="text-wrap">').css( { position: 'relative', 'z-index': 2 } ),
            // アニメーション用のDOM
            $rippleWrap: $('<span>', { 'class': 'rippleWrap' } ).css( { position: 'absolute', 'z-index': 1, 'left': 0, 'top': 0, 'overflow': 'hidden' } ).append(
                            $('<span>', { 'class': 'rippleAnimate' } ).css( { position: 'absolute', 'left': 0, 'top': 0, 'width': 0, 'height': 0, 'border-radius': '50%' } )
                         ),
            // jquery.rippleが利用できるか？
            is: function() {
                return $.support.borderRadius && $.support.transition;
            },
            // coreクラス
            core: function( target, param ) {
                this.$target   = target;
                this._v_duration = 400;
                this._h_duration = 400;
                this._timer      = null;

                // paramに値があれば設定変更
                if( param !== U && Object.prototype.hasOwnProperty.call( param, 'v_duration' ) ) {
                    this.set_view_duration( param.v_duration );
                }
                if( param !== U && Object.prototype.hasOwnProperty.call( param, 'h_duration' ) ) {
                    this.set_hide_duration( param.h_duration );
                }

                // イベント初期設定
                this.init();
            }
        }
    } );

    // coreクラスを拡張しておく
    $.ripple.core.prototype = {
        // 設定変更
        set_view_duration: function( v_duration ) {
            this._v_duration = v_duration;
        },
        set_hide_duration: function( h_duration ) {
            this._h_duration = h_duration;
        },

        // イベント初期設定
        init: function() {
            var that = this;

            // position staticだったらrelativeにしておく
            if( this.$target.css( 'position' ) === 'static' ) {
                this.$target.css( 'position', 'relative' );
            }
            // スマホ端末のハイライトを切る
            this.$target.css( '-webkit-tap-highlight-color', 'rgba( 0, 0, 0, 0 )' );

            // 必要DOMを追加
           if(!this.$target.hasClass("rollover") && !this.$target.hasClass("rollover-video") && !this.$target.hasClass("post-rollover") && !this.$target.hasClass(("benefits-grid-ico"))){
            
           		this.$target.wrapInner( $.ripple.$textSpan );
           	}
            	this.$target.append( $.ripple.$rippleWrap.clone() );

            // 必要DOMを変数に入れておく
            this.$rippleWrap    = this.$target.find( '.rippleWrap' );
            this.$rippleAnimate = this.$target.find( '.rippleAnimate' );

            // マスクに関係するスタイルを反映する
            // border-radius
            this.$rippleWrap.css( 'border-radius', this.$target.css( 'border-radius' ) );

            // 色を指定
            this.$target.find( '.rippleAnimate' ).css( 'background-color', this.$target.attr( 'data-color' ) );

            // イベントを登録
            if( ('ontouchstart' in window) ) {
                this.$target.bind( 'touchstart.ripple', function( e ) {
                    that.view( e.originalEvent.touches[0] );
                } );
                this.$target.bind( 'touchend.ripple', function( e ) {
                    that.hidden( e.originalEvent.touches[0] );
                } );
                this.$target.bind( 'mouseleave.ripple', function( e ) {
                    that.hidden( e );
                } );
            } else {
                this.$target.bind( 'mousedown.ripple', function( e ) {
                    that.view( e );
                } );
                this.$target.bind( 'mouseup.ripple mouseleave.ripple', function( e ) {
                    that.hidden( e );
                } );
            }
        },

        // イベント廃止
        remove: function() {
        },

        // アニメーション開始
        view: function( e ) {
            // タイマーは切っておく
            clearTimeout( this._timer );

            // マスク要素のサイズを再取得（変わる可能性も考慮して）
            var width  = this.$target.outerWidth();
            var height = this.$target.outerHeight();
            this.$rippleWrap.stop( true, false ).width( width ).height( height ).css( { 'opacity': 1, 'transition': 'none' } );

            // サイズを指定（縦横の大きい値）
            var circleRatio      = 2.8;
            var size = Math.max( width, height );

            // マウスボタンの位置を取得
            // offsetX, offsetYがおかしいのでpageX, pageYから計算する
            var offsetX = e.pageX - this.$target.offset().left;
            var offsetY = e.pageY - this.$target.offset().top;
            this.$rippleAnimate.css( { 'width': size, 'height': size, 'transform': 'scale3d( 0, 0, 1 )', 'left': offsetX-size/2, 'top': offsetY-size/2, 'transition': 'none' } );

            var animateTo        = {};
            animateTo.transform  = 'scale3d( ' + circleRatio + ', ' + circleRatio + ', 1 )';
            animateTo.transition = ( this._v_duration/1000 )+'s ease-out';

            // アニメーション開始
            this.$rippleAnimate.show()
                .css( animateTo );
        },

        // アニメーション終了
        hidden: function( e ) {
            var that = this;
            // Wrapの透明度を下げて隠していく
            this.$rippleWrap.stop( true, false ).css( { 'opacity': 0, 'transition': 'opacity '+( this._h_duration/1000 )+'s ease-out' } );

            // アニメーション終了タイミングでサイズ変更
            clearTimeout( this._timer );
            this._timer = setTimeout( function() {
                that.$rippleWrap.css( { 'opacity': 1, 'transition': 'none' } );
                that.$rippleAnimate.css( { 'transform': 'scale3d( 0, 0, 1 )', 'transition': 'none' } );
            }, this._v_duration );
        }
    };

    $.fn.extend( {
        // jquery.ripple
        ripple: function( opt ) {
            // 必要条件に満たさなければ終了
            // border-radiusとtransitionが使えればたぶん動く
            if(! $.ripple.is() ) {
                return $(this);
            }

            // 対象DOMに対してイベントを登録する
            $(this).each( function() {
                new $.ripple.core( $(this), opt );
            } );

            return $(this);
        }
    } );
} )( jQuery );

/*!
 * Waves v0.6.0
 * http://fian.my.id/Waves 
 * 
 * Copyright 2014 Alfiana E. Sibuea and other contributors 
 * Released under the MIT license 
 * https://github.com/fians/Waves/blob/master/LICENSE 
 */

;(function(window) {
    //'use strict';

    if (!jQuery("html").hasClass("old-ie")){
        var Waves = Waves || {};
        var $$ = document.querySelectorAll.bind(document);

        // Find exact position of element
        function isWindow(obj) {
            return obj !== null && obj === obj.window;
        }

        function getWindow(elem) {
            return isWindow(elem) ? elem : elem.nodeType === 9 && elem.defaultView;
        }

        function offset(elem) {
            var docElem, win,
                box = {top: 0, left: 0},
                doc = elem && elem.ownerDocument;

            docElem = doc.documentElement;

            if (typeof elem.getBoundingClientRect !== typeof undefined) {
                box = elem.getBoundingClientRect();
            }
            win = getWindow(doc);
            return {
                top: box.top + win.pageYOffset - docElem.clientTop,
                left: box.left + win.pageXOffset - docElem.clientLeft
            };
        }

        function convertStyle(obj) {
            var style = '';

            for (var a in obj) {
                if (obj.hasOwnProperty(a)) {
                    style += (a + ':' + obj[a] + ';');
                }
            }

            return style;
        }

        var Effect = {

            // Effect delay
            duration: 300,

            show: function(e, element) {

                // Disable right click
                if (e.button === 2) {
                    return false;
                }

                var el = element || this;

                // Create ripple
                var ripple = document.createElement('div');
                ripple.className = 'waves-ripple';
                el.appendChild(ripple);

                // Get click coordinate and element witdh
                var pos         = offset(el);
                var relativeY   = (e.pageY - pos.top);
                var relativeX   = (e.pageX - pos.left);
              /*  var scale       = 'scale('+((el.clientWidth / 100) * 3)+')';*/
                var scale       = 'scale(1)';
                
                // Support for touch devices
                if ('touches' in e) {
                  relativeY   = (e.touches[0].pageY - pos.top);
                  relativeX   = (e.touches[0].pageX - pos.left);
                }

                // Attach data to element
                ripple.setAttribute('data-hold', Date.now());
                ripple.setAttribute('data-scale', scale);
                ripple.setAttribute('data-x', relativeX);
                ripple.setAttribute('data-y', relativeY);

                // Set ripple position
                var rippleStyle = {
                    'top': relativeY+'px',
                    'left': relativeX+'px'
                };
                
                ripple.className = ripple.className + ' waves-notransition';
                ripple.setAttribute('style', convertStyle(rippleStyle));
                ripple.className = ripple.className.replace('waves-notransition', '');

                // Scale the ripple
                rippleStyle['-webkit-transform'] = scale;
                rippleStyle['-moz-transform'] = scale;
                rippleStyle['-ms-transform'] = scale;
                rippleStyle['-o-transform'] = scale;
                rippleStyle.transform = scale;
                rippleStyle.opacity   = '1';

                rippleStyle['-webkit-transition-duration'] = Effect.duration + 'ms';
                rippleStyle['-moz-transition-duration']    = Effect.duration + 'ms';
                rippleStyle['-o-transition-duration']      = Effect.duration + 'ms';
                rippleStyle['transition-duration']         = Effect.duration + 'ms';

                ripple.setAttribute('style', convertStyle(rippleStyle));
            },

            hide: function(e) {
                TouchHandler.touchup(e);

                var el = this;
                var width = el.clientWidth * 1.4;
                
                // Get first ripple
                var ripple = null;
                var ripples = el.getElementsByClassName('waves-ripple');
                if (ripples.length > 0) {
                    ripple = ripples[ripples.length - 1];
                } else {
                    return false;
                }

                var relativeX   = ripple.getAttribute('data-x');
                var relativeY   = ripple.getAttribute('data-y');
                var scale       = ripple.getAttribute('data-scale');

                // Get delay beetween mousedown and mouse leave
                var diff = Date.now() - Number(ripple.getAttribute('data-hold'));
                var delay = 350 - diff;

                if (delay < 0) {
                    delay = 0;
                }

                // Fade out ripple after delay
                setTimeout(function() {
                    var style = {
                        'top': relativeY+'px',
                        'left': relativeX+'px',
                        'opacity': '0',

                        // Duration
                        '-webkit-transition-duration': Effect.duration + 'ms',
                        '-moz-transition-duration': Effect.duration + 'ms',
                        '-o-transition-duration': Effect.duration + 'ms',
                        'transition-duration': Effect.duration + 'ms',
                        '-webkit-transform': scale,
                        '-moz-transform': scale,
                        '-ms-transform': scale,
                        '-o-transform': scale,
                        'transform': scale,
                    };

                    ripple.setAttribute('style', convertStyle(style));

                    setTimeout(function() {
                        try {
                            el.removeChild(ripple);
                        } catch(e) {
                            return false;
                        }
                    }, Effect.duration);
                }, delay);
            },

            // Little hack to make <input> can perform waves effect
            wrapInput: function(elements) {
                for (var a = 0; a < elements.length; a++) {
                    var el = elements[a];
                    
                    if (el.tagName.toLowerCase() === 'input') {
                        var parent = el.parentNode;

                        // If input already have parent just pass through
                        if (parent.tagName.toLowerCase() === 'i' && parent.className.indexOf('waves-effect') !== -1) {
                            continue;
                        }

                        // Put element class and style to the specified parent
                        var wrapper = document.createElement('i');
                        wrapper.className = el.className + ' waves-input-wrapper';

                        var elementStyle = el.getAttribute('style');

                        if (!elementStyle) {
                            elementStyle = '';
                        }

                        wrapper.setAttribute('style', elementStyle);
                        
                        el.className = 'waves-button-input';
                        el.removeAttribute('style');

                        // Put element as child
                        parent.replaceChild(wrapper, el);
                        wrapper.appendChild(el);
                    }
                }
            }
        };


        /**
         * Disable mousedown event for 500ms during and after touch
         */
        var TouchHandler = {
            /* uses an integer rather than bool so there's no issues with
             * needing to clear timeouts if another touch event occurred
             * within the 500ms. Cannot mouseup between touchstart and
             * touchend, nor in the 500ms after touchend. */
            touches: 0,
            allowEvent: function(e) {
                var allow = true;

                if (e.type === 'touchstart') {
                    TouchHandler.touches += 1; //push
                } else if (e.type === 'touchend' || e.type === 'touchcancel') {
                    setTimeout(function() {
                        if (TouchHandler.touches > 0) {
                            TouchHandler.touches -= 1; //pop after 500ms
                        }
                    }, 500);
                } else if (e.type === 'mousedown' && TouchHandler.touches > 0) {
                    allow = false;
                }

                return allow;
            },
            touchup: function(e) {
                TouchHandler.allowEvent(e);
            }
        };


        /**
         * Delegated click handler for .waves-effect element.
         * returns null when .waves-effect element not in "click tree"
         */
        function getWavesEffectElement(e) {
            if (TouchHandler.allowEvent(e) === false) {
                return null;
            }

            var element = null;
            var target = e.target || e.srcElement;

            while (target.parentElement !== null) {
                if (!(target instanceof SVGElement) && target.className.indexOf('waves-effect') !== -1) {
                    element = target;
                    break;
                } else if (target.classList.contains('waves-effect')) {
                    element = target;
                    break;
                }
                target = target.parentElement;
            }

            return element;
        }

        /**
         * Bubble the click and show effect if .waves-effect elem was found
         */
        function showEffect(e) {
            var element = getWavesEffectElement(e);

            if (element !== null) {
                Effect.show(e, element);

                if ('ontouchstart' in window) {
                    element.addEventListener('touchend', Effect.hide, false);
                    element.addEventListener('touchcancel', Effect.hide, false);
                }

                element.addEventListener('mouseup', Effect.hide, false);
                element.addEventListener('mouseleave', Effect.hide, false);
            }
        }

        Waves.displayEffect = function(options) {
            options = options || {};

            if ('duration' in options) {
                Effect.duration = options.duration;
            }
            
            //Wrap input inside <i> tag
            Effect.wrapInput($$('.waves-effect'));
            
            if ('ontouchstart' in window) {
                document.body.addEventListener('touchstart', showEffect, false);
            }
            
            document.body.addEventListener('mousedown', showEffect, false);
        };

        /**
         * Attach Waves to an input element (or any element which doesn't
         * bubble mouseup/mousedown events).
         *   Intended to be used with dynamically loaded forms/inputs, or
         * where the user doesn't want a delegated click handler.
         */
        Waves.attach = function(element) {
            //FUTURE: automatically add waves classes and allow users
            // to specify them with an options param? Eg. light/classic/button
            if (element.tagName.toLowerCase() === 'input') {
                Effect.wrapInput([element]);
                element = element.parentElement;
            }

            if ('ontouchstart' in window) {
                element.addEventListener('touchstart', showEffect, false);
            }

            element.addEventListener('mousedown', showEffect, false);
        };

        window.Waves = Waves;
    }
})(window);

/* Lazy loading: begin */

// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
// MIT license

(function() {
  var lastTime = 0;
  var vendors = ['ms', 'moz', 'webkit', 'o'];
  for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
    window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
    window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
  }
 
  if (!window.requestAnimationFrame)
    window.requestAnimationFrame = function(callback, element) {
      var currTime = new Date().getTime();
      var timeToCall = Math.max(0, 16 - (currTime - lastTime));
      var id = window.setTimeout(function() { callback(currTime + timeToCall); }, 
        timeToCall);
      lastTime = currTime + timeToCall;
      return id;
    };
 
  if (!window.cancelAnimationFrame)
    window.cancelAnimationFrame = function(id) {
      clearTimeout(id);
    };
}());
  
// https://github.com/callmecavs/layzr.js
// CONSTRUCTOR
function Layzr(options) {
  // debounce
  this._lastScroll = 0;
  this._ticking    = false;

  // options
  options = options || {};

  this._optionsContainer  = document.querySelector(options.container) || window;
  this._optionsSelector = options.selector || '[data-layzr]';
  this._optionsAttr   = options.attr || 'data-layzr';
  this._optionsAttrSrcSet = options.attrSrcSet || 'data-layzr-srcset';
  this._optionsAttrRetina = options.retinaAttr || 'data-layzr-retina';
  this._optionsAttrBg   = options.bgAttr || 'data-layzr-bg';
  this._optionsAttrHidden = options.hiddenAttr || 'data-layzr-hidden';
  this._optionsThreshold  = options.threshold || 0;
  this._optionsBefore   = options.before || null;
  this._optionsAfter    = options.after || null;  
  this._optionsCallback = options.callback || null;

  // properties
  this._retina  = window.devicePixelRatio > 1;
  this._srcAttr = this._retina ? this._optionsAttrRetina : this._optionsAttr;

  // nodelist
  this._nodes = document.querySelectorAll(this._optionsSelector);

  // scroll and resize handler
  this._handlerBind = this._requestScroll.bind(this);

  // call to create
  this._create();
  
}

// DEBOUNCE HELPERS
// adapted from: http://www.html5rocks.com/en/tutorials/speed/animations/

Layzr.prototype._requestScroll = function() {
  if(this._optionsContainer === window) {
    this._lastScroll = window.pageYOffset;
  }
  else {
    this._lastScroll = this._optionsContainer.scrollTop + this._getOffset(this._optionsContainer);
  }

  this._requestTick();
};

Layzr.prototype._requestTick = function() {
  if(!this._ticking) {
    requestAnimationFrame(this.update.bind(this));
    this._ticking = true;
  }
};

// OFFSET HELPER
// remember, getBoundingClientRect is relative to the viewport

Layzr.prototype._getOffset = function(node) {
  return node.getBoundingClientRect().top + window.pageYOffset;
};

// HEIGHT HELPER

Layzr.prototype._getContainerHeight = function() {
  return this._optionsContainer.innerHeight
      || this._optionsContainer.offsetHeight;

}

// LAYZR METHODS

Layzr.prototype._create = function() {
  // fire scroll event once
  this._handlerBind();

  // bind scroll and resize event
  this._optionsContainer.addEventListener('scroll', this._handlerBind, false);
  this._optionsContainer.addEventListener('resize', this._handlerBind, false);
};

Layzr.prototype._destroy = function() {
  // unbind scroll and resize event
  this._optionsContainer.removeEventListener('scroll', this._handlerBind, false);
  this._optionsContainer.removeEventListener('resize', this._handlerBind, false);
};

Layzr.prototype._inViewport = function(node) {
  // get viewport top and bottom offset
  var viewportTop = this._lastScroll;
  var viewportBottom = viewportTop + this._getContainerHeight();

  // get node top and bottom offset
  var nodeTop = this._getOffset(node);
  var nodeBottom = nodeTop + this._getContainerHeight();

  // calculate threshold, convert percentage to pixel value
  var threshold = (this._optionsThreshold / 100) * window.innerHeight;

  // return if node in viewport
  return nodeBottom >= viewportTop - threshold
      && nodeTop <= viewportBottom + threshold
      && !node.hasAttribute(this._optionsAttrHidden);
  //console.log(this, node + "viewport")
};

Layzr.prototype._reveal = function(node) {
  // get node source
  var source = node.getAttribute(this._srcAttr) || node.getAttribute(this._optionsAttr),
    lazyrObj = this;
   // console.log( lazyrObj)

  // call the callback
  if(typeof this._optionsCallback === 'function') {
    // "this" will be the node in the callback
    node.addEventListener("load", function() {
      lazyrObj._optionsCallback.call(node);
    });
  }

  // before hook
  if(typeof this._optionsBefore === 'function') {
    // "this" will be the node in the callback
    this._optionsBefore.call(node);
  }

  // set node src or bg image
  if(node.hasAttribute(this._optionsAttrBg)) {
    node.style.backgroundImage = 'url(' + source + ')';
  }
  else {
    if (source) node.setAttribute('src', source);
    if (node.hasAttribute(this._optionsAttrSrcSet)) node.setAttribute('srcset', node.getAttribute(this._optionsAttrSrcSet));
  }

  // after hook
  if(typeof this._optionsAfter === 'function') {
    // "this" will be the node in the callback
    this._optionsAfter.call(node);
  }

  // remove node data attributes
  node.removeAttribute(this._optionsAttr);
  node.removeAttribute(this._optionsAttrSrcSet);
  node.removeAttribute(this._optionsAttrRetina);
  node.removeAttribute(this._optionsAttrBg);
  node.removeAttribute(this._optionsAttrHidden);
};

Layzr.prototype.updateSelector = function() {
  // update cached list of nodes matching selector
  this._nodes = document.querySelectorAll(this._optionsSelector);
};

Layzr.prototype.update = function() {
  // cache nodelist length
  var nodesLength = this._nodes.length;

  // loop through nodes
  for(var i = 0; i < nodesLength; i++) {
    // cache node
    var node = this._nodes[i];

    // check if node has mandatory attribute
    if(node.hasAttribute(this._optionsAttr) || node.hasAttribute(this._optionsAttrSrcSet) || node.hasAttribute(this._optionsAttrRetina)) {
      // check if node in viewport
      if(this._inViewport(node)) {
        // reveal node
        this._reveal(node);
        //console.log(node)
      }
    }
  }

  // allow for more animation frames
  this._ticking = false;
};

/* Lazy loading: end */


/*! Magnific Popup - v1.1.0 - 2016-02-20
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2016 Dmitry Semenov; */
;(function (factory) { 
if (typeof define === 'function' && define.amd) { 
 // AMD. Register as an anonymous module. 
 define(['jquery'], factory); 
 } else if (typeof exports === 'object') { 
 // Node/CommonJS 
 factory(require('jquery')); 
 } else { 
 // Browser globals 
 factory(window.jQuery || window.Zepto); 
 } 
 }(function($) { 

/*>>core*/
/**
 * 
 * Magnific Popup Core JS file
 * 
 */


/**
 * Private static constants
 */
var CLOSE_EVENT = 'Close',
	BEFORE_CLOSE_EVENT = 'BeforeClose',
	AFTER_CLOSE_EVENT = 'AfterClose',
	BEFORE_APPEND_EVENT = 'BeforeAppend',
	MARKUP_PARSE_EVENT = 'MarkupParse',
	OPEN_EVENT = 'Open',
	CHANGE_EVENT = 'Change',
	NS = 'mfp',
	EVENT_NS = '.' + NS,
	READY_CLASS = 'mfp-ready',
	REMOVING_CLASS = 'mfp-removing',
	PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


/**
 * Private vars 
 */
/*jshint -W079 */
var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
	MagnificPopup = function(){},
	_isJQ = !!(window.jQuery),
	_prevStatus,
	_window = $(window),
	_document,
	_prevContentType,
	_wrapClasses,
	_currPopupType;


/**
 * Private functions
 */
var _mfpOn = function(name, f) {
		mfp.ev.on(NS + name + EVENT_NS, f);
	},
	_getEl = function(className, appendTo, html, raw) {
		var el = document.createElement('div');
		el.className = 'mfp-'+className;
		if(html) {
			el.innerHTML = html;
		}
		if(!raw) {
			el = $(el);
			if(appendTo) {
				el.appendTo(appendTo);
			}
		} else if(appendTo) {
			appendTo.appendChild(el);
		}
		return el;
	},
	_mfpTrigger = function(e, data) {
		mfp.ev.triggerHandler(NS + e, data);

		if(mfp.st.callbacks) {
			// converts "mfpEventName" to "eventName" callback and triggers it if it's present
			e = e.charAt(0).toLowerCase() + e.slice(1);
			if(mfp.st.callbacks[e]) {
				mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
			}
		}
	},
	_getCloseBtn = function(type) {
		if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
			mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
			_currPopupType = type;
		}
		return mfp.currTemplate.closeBtn;
	},
	// Initialize Magnific Popup only when called at least once
	_checkInstance = function() {
		if(!$.magnificPopup.instance) {
			/*jshint -W020 */
			mfp = new MagnificPopup();
			mfp.init();
			$.magnificPopup.instance = mfp;
		}
	},
	// CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
	supportsTransitions = function() {
		var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
			v = ['ms','O','Moz','Webkit']; // 'v' for vendor

		if( s['transition'] !== undefined ) {
			return true; 
		}
			
		while( v.length ) {
			if( v.pop() + 'Transition' in s ) {
				return true;
			}
		}
				
		return false;
	};



/**
 * Public functions
 */
MagnificPopup.prototype = {

	constructor: MagnificPopup,

	/**
	 * Initializes Magnific Popup plugin. 
	 * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
	 */
	init: function() {
		var appVersion = navigator.appVersion;
		mfp.isLowIE = mfp.isIE8 = document.all && !document.addEventListener;
		mfp.isAndroid = (/android/gi).test(appVersion);
		mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
		mfp.supportsTransition = supportsTransitions();

		// We disable fixed positioned lightbox on devices that don't handle it nicely.
		// If you know a better way of detecting this - let me know.
		mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
		_document = $(document);

		mfp.popupsCache = {};
	},

	/**
	 * Opens popup
	 * @param  data [description]
	 */
	open: function(data) {

		var i;

		if(data.isObj === false) { 
			// convert jQuery collection to array to avoid conflicts later
			mfp.items = data.items.toArray();

			mfp.index = 0;
			var items = data.items,
				item;
			for(i = 0; i < items.length; i++) {
				item = items[i];
				if(item.parsed) {
					item = item.el[0];
				}
				if(item === data.el[0]) {
					mfp.index = i;
					break;
				}
			}
		} else {
			mfp.items = $.isArray(data.items) ? data.items : [data.items];
			mfp.index = data.index || 0;
		}

		// if popup is already opened - we just update the content
		if(mfp.isOpen) {
			mfp.updateItemHTML();
			return;
		}
		
		mfp.types = []; 
		_wrapClasses = '';
		if(data.mainEl && data.mainEl.length) {
			mfp.ev = data.mainEl.eq(0);
		} else {
			mfp.ev = _document;
		}

		if(data.key) {
			if(!mfp.popupsCache[data.key]) {
				mfp.popupsCache[data.key] = {};
			}
			mfp.currTemplate = mfp.popupsCache[data.key];
		} else {
			mfp.currTemplate = {};
		}



		mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data ); 
		mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

		if(mfp.st.modal) {
			mfp.st.closeOnContentClick = false;
			mfp.st.closeOnBgClick = false;
			mfp.st.showCloseBtn = false;
			mfp.st.enableEscapeKey = false;
		}
		

		// Building markup
		// main containers are created only once
		if(!mfp.bgOverlay) {

			// Dark overlay
			mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
				mfp.close();
			});

			mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
				if(mfp._checkIfClose(e.target)) {
					mfp.close();
				}
			});

			mfp.container = _getEl('container', mfp.wrap);
		}

		mfp.contentContainer = _getEl('content');
		if(mfp.st.preloader) {
			mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
		}


		// Initializing modules
		var modules = $.magnificPopup.modules;
		for(i = 0; i < modules.length; i++) {
			var n = modules[i];
			n = n.charAt(0).toUpperCase() + n.slice(1);
			mfp['init'+n].call(mfp);
		}
		_mfpTrigger('BeforeOpen');


		if(mfp.st.showCloseBtn) {
			// Close button
			if(!mfp.st.closeBtnInside) {
				mfp.wrap.append( _getCloseBtn() );
			} else {
				_mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
					values.close_replaceWith = _getCloseBtn(item.type);
				});
				_wrapClasses += ' mfp-close-btn-in';
			}
		}

		if(mfp.st.alignTop) {
			_wrapClasses += ' mfp-align-top';
		}

	

		if(mfp.fixedContentPos) {
			mfp.wrap.css({
				overflow: mfp.st.overflowY,
				overflowX: 'hidden',
				overflowY: mfp.st.overflowY
			});
		} else {
			mfp.wrap.css({ 
				top: _window.scrollTop(),
				position: 'absolute'
			});
		}
		if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
			mfp.bgOverlay.css({
				height: _document.height(),
				position: 'absolute'
			});
		}

		

		if(mfp.st.enableEscapeKey) {
			// Close on ESC key
			_document.on('keyup' + EVENT_NS, function(e) {
				if(e.keyCode === 27) {
					mfp.close();
				}
			});
		}

		_window.on('resize' + EVENT_NS, function() {
			mfp.updateSize();
		});


		if(!mfp.st.closeOnContentClick) {
			_wrapClasses += ' mfp-auto-cursor';
		}
		
		if(_wrapClasses)
			mfp.wrap.addClass(_wrapClasses);


		// this triggers recalculation of layout, so we get it once to not to trigger twice
		var windowHeight = mfp.wH = _window.height();

		
		var windowStyles = {};

		if( mfp.fixedContentPos ) {
            if(mfp._hasScrollBar(windowHeight)){
                var s = mfp._getScrollbarSize();
                if(s) {
                    windowStyles.marginRight = s;
                }
            }
        }

		if(mfp.fixedContentPos) {
			if(!mfp.isIE7) {
				windowStyles.overflow = 'hidden';
			} else {
				// ie7 double-scroll bug
				$('body, html').css('overflow', 'hidden');
			}
		}

		
		
		var classesToadd = mfp.st.mainClass;
		if(mfp.isIE7) {
			classesToadd += ' mfp-ie7';
		}
		if(classesToadd) {
			mfp._addClassToMFP( classesToadd );
		}

		// add content
		mfp.updateItemHTML();

		_mfpTrigger('BuildControls');

		// remove scrollbar, add margin e.t.c
		$('html').css(windowStyles);
		
		// add everything to DOM
		mfp.bgOverlay.add(mfp.wrap).prependTo( mfp.st.prependTo || $(document.body) );

		// Save last focused element
		mfp._lastFocusedEl = document.activeElement;
		
		// Wait for next cycle to allow CSS transition
		setTimeout(function() {
			
			if(mfp.content) {
				mfp._addClassToMFP(READY_CLASS);
				mfp._setFocus();
			} else {
				// if content is not defined (not loaded e.t.c) we add class only for BG
				mfp.bgOverlay.addClass(READY_CLASS);
			}
			
			// Trap the focus in popup
			_document.on('focusin' + EVENT_NS, mfp._onFocusIn);

		}, 16);

		mfp.isOpen = true;
		mfp.updateSize(windowHeight);
		_mfpTrigger(OPEN_EVENT);

		return data;
	},

	/**
	 * Closes the popup
	 */
	close: function() {
		if(!mfp.isOpen) return;
		_mfpTrigger(BEFORE_CLOSE_EVENT);

		mfp.isOpen = false;
		// for CSS3 animation
		if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
			mfp._addClassToMFP(REMOVING_CLASS);
			setTimeout(function() {
				mfp._close();
			}, mfp.st.removalDelay);
		} else {
			mfp._close();
		}
	},

	/**
	 * Helper for close() function
	 */
	_close: function() {
		_mfpTrigger(CLOSE_EVENT);

		var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

		mfp.bgOverlay.detach();
		mfp.wrap.detach();
		mfp.container.empty();

		if(mfp.st.mainClass) {
			classesToRemove += mfp.st.mainClass + ' ';
		}

		mfp._removeClassFromMFP(classesToRemove);

		if(mfp.fixedContentPos) {
			var windowStyles = {marginRight: ''};
			if(mfp.isIE7) {
				$('body, html').css('overflow', '');
			} else {
				windowStyles.overflow = '';
			}
			$('html').css(windowStyles);
		}
		
		_document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
		mfp.ev.off(EVENT_NS);

		// clean up DOM elements that aren't removed
		mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
		mfp.bgOverlay.attr('class', 'mfp-bg');
		mfp.container.attr('class', 'mfp-container');

		// remove close button from target element
		if(mfp.st.showCloseBtn &&
		(!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
			if(mfp.currTemplate.closeBtn)
				mfp.currTemplate.closeBtn.detach();
		}


		if(mfp.st.autoFocusLast && mfp._lastFocusedEl) {
			$(mfp._lastFocusedEl).focus(); // put tab focus back
		}
		mfp.currItem = null;	
		mfp.content = null;
		mfp.currTemplate = null;
		mfp.prevHeight = 0;

		_mfpTrigger(AFTER_CLOSE_EVENT);
	},
	
	updateSize: function(winHeight) {

		if(mfp.isIOS) {
			// fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
			var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
			var height = window.innerHeight * zoomLevel;
			mfp.wrap.css('height', height);
			mfp.wH = height;
		} else {
			mfp.wH = winHeight || _window.height();
		}
		// Fixes #84: popup incorrectly positioned with position:relative on body
		if(!mfp.fixedContentPos) {
			mfp.wrap.css('height', mfp.wH);
		}

		_mfpTrigger('Resize');

	},

	/**
	 * Set content of popup based on current index
	 */
	updateItemHTML: function() {
		var item = mfp.items[mfp.index];

		// Detach and perform modifications
		mfp.contentContainer.detach();

		if(mfp.content)
			mfp.content.detach();

		if(!item.parsed) {
			item = mfp.parseEl( mfp.index );
		}

		var type = item.type;

		_mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
		// BeforeChange event works like so:
		// _mfpOn('BeforeChange', function(e, prevType, newType) { });

		mfp.currItem = item;

		if(!mfp.currTemplate[type]) {
			var markup = mfp.st[type] ? mfp.st[type].markup : false;

			// allows to modify markup
			_mfpTrigger('FirstMarkupParse', markup);

			if(markup) {
				mfp.currTemplate[type] = $(markup);
			} else {
				// if there is no markup found we just define that template is parsed
				mfp.currTemplate[type] = true;
			}
		}

		if(_prevContentType && _prevContentType !== item.type) {
			mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
		}

		var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
		mfp.appendContent(newContent, type);

		item.preloaded = true;

		_mfpTrigger(CHANGE_EVENT, item);
		_prevContentType = item.type;

		// Append container back after its content changed
		mfp.container.prepend(mfp.contentContainer);

		_mfpTrigger('AfterChange');
	},


	/**
	 * Set HTML content of popup
	 */
	appendContent: function(newContent, type) {
		mfp.content = newContent;

		if(newContent) {
			if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
				mfp.currTemplate[type] === true) {
				// if there is no markup, we just append close button element inside
				if(!mfp.content.find('.mfp-close').length) {
					mfp.content.append(_getCloseBtn());
				}
			} else {
				mfp.content = newContent;
			}
		} else {
			mfp.content = '';
		}

		_mfpTrigger(BEFORE_APPEND_EVENT);
		mfp.container.addClass('mfp-'+type+'-holder');

		mfp.contentContainer.append(mfp.content);
	},


	/**
	 * Creates Magnific Popup data object based on given data
	 * @param  {int} index Index of item to parse
	 */
	parseEl: function(index) {
		var item = mfp.items[index],
			type;

		if(item.tagName) {
			item = { el: $(item) };
		} else {
			type = item.type;
			item = { data: item, src: item.src };
		}

		if(item.el) {
			var types = mfp.types;

			// check for 'mfp-TYPE' class
			for(var i = 0; i < types.length; i++) {
				if( item.el.hasClass('mfp-'+types[i]) ) {
					type = types[i];
					break;
				}
			}

			item.src = item.el.attr('data-mfp-src');
			if(!item.src) {
				item.src = item.el.attr('href');
			}
		}

		item.type = type || mfp.st.type || 'inline';
		item.index = index;
		item.parsed = true;
		mfp.items[index] = item;
		_mfpTrigger('ElementParse', item);

		return mfp.items[index];
	},


	/**
	 * Initializes single popup or a group of popups
	 */
	addGroup: function(el, options) {
		var eHandler = function(e) {
			e.mfpEl = this;
			mfp._openClick(e, el, options);
		};

		if(!options) {
			options = {};
		}

		var eName = 'click.magnificPopup';
		options.mainEl = el;

		if(options.items) {
			options.isObj = true;
			el.off(eName).on(eName, eHandler);
		} else {
			options.isObj = false;
			if(options.delegate) {
				el.off(eName).on(eName, options.delegate , eHandler);
			} else {
				options.items = el;
				el.off(eName).on(eName, eHandler);
			}
		}
	},
	_openClick: function(e, el, options) {
		var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


		if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey || e.altKey || e.shiftKey ) ) {
			return;
		}

		var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

		if(disableOn) {
			if($.isFunction(disableOn)) {
				if( !disableOn.call(mfp) ) {
					return true;
				}
			} else { // else it's number
				if( _window.width() < disableOn ) {
					return true;
				}
			}
		}

		if(e.type) {
			e.preventDefault();

			// This will prevent popup from closing if element is inside and popup is already opened
			if(mfp.isOpen) {
				e.stopPropagation();
			}
		}

		options.el = $(e.mfpEl);
		if(options.delegate) {
			options.items = el.find(options.delegate);
		}
		mfp.open(options);
	},


	/**
	 * Updates text on preloader
	 */
	updateStatus: function(status, text) {

		if(mfp.preloader) {
			if(_prevStatus !== status) {
				mfp.container.removeClass('mfp-s-'+_prevStatus);
			}

			if(!text && status === 'loading') {
				text = mfp.st.tLoading;
			}

			var data = {
				status: status,
				text: text
			};
			// allows to modify status
			_mfpTrigger('UpdateStatus', data);

			status = data.status;
			text = data.text;

			mfp.preloader.html(text);

			mfp.preloader.find('a').on('click', function(e) {
				e.stopImmediatePropagation();
			});

			mfp.container.addClass('mfp-s-'+status);
			_prevStatus = status;
		}
	},


	/*
		"Private" helpers that aren't private at all
	 */
	// Check to close popup or not
	// "target" is an element that was clicked
	_checkIfClose: function(target) {

		if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
			return;
		}

		var closeOnContent = mfp.st.closeOnContentClick;
		var closeOnBg = mfp.st.closeOnBgClick;

		if(closeOnContent && closeOnBg) {
			return true;
		} else {

			// We close the popup if click is on close button or on preloader. Or if there is no content.
			if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
				return true;
			}

			// if click is outside the content
			if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
				if(closeOnBg) {
					// last check, if the clicked element is in DOM, (in case it's removed onclick)
					if( $.contains(document, target) ) {
						return true;
					}
				}
			} else if(closeOnContent) {
				return true;
			}

		}
		return false;
	},
	_addClassToMFP: function(cName) {
		mfp.bgOverlay.addClass(cName);
		mfp.wrap.addClass(cName);
	},
	_removeClassFromMFP: function(cName) {
		this.bgOverlay.removeClass(cName);
		mfp.wrap.removeClass(cName);
	},
	_hasScrollBar: function(winHeight) {
		return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
	},
	_setFocus: function() {
		(mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
	},
	_onFocusIn: function(e) {
		if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
			mfp._setFocus();
			return false;
		}
	},
	_parseMarkup: function(template, values, item) {
		var arr;
		if(item.data) {
			values = $.extend(item.data, values);
		}
		_mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

		$.each(values, function(key, value) {
			if(value === undefined || value === false) {
				return true;
			}
			arr = key.split('_');
			if(arr.length > 1) {
				var el = template.find(EVENT_NS + '-'+arr[0]);

				if(el.length > 0) {
					var attr = arr[1];
					if(attr === 'replaceWith') {
						if(el[0] !== value[0]) {
							el.replaceWith(value);
						}
					} else if(attr === 'img') {
						if(el.is('img')) {
							el.attr('src', value);
						} else {
							el.replaceWith( $('<img>').attr('src', value).attr('class', el.attr('class')) );
						}
					} else {
						el.attr(arr[1], value);
					}
				}

			} else {
				template.find(EVENT_NS + '-'+key).html(value);
			}
		});
	},

	_getScrollbarSize: function() {
		// thx David
		if(mfp.scrollbarSize === undefined) {
			var scrollDiv = document.createElement("div");
			scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
			document.body.appendChild(scrollDiv);
			mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
			document.body.removeChild(scrollDiv);
		}
		return mfp.scrollbarSize;
	}

}; /* MagnificPopup core prototype end */




/**
 * Public static functions
 */
$.magnificPopup = {
	instance: null,
	proto: MagnificPopup.prototype,
	modules: [],

	open: function(options, index) {
		_checkInstance();

		if(!options) {
			options = {};
		} else {
			options = $.extend(true, {}, options);
		}

		options.isObj = true;
		options.index = index || 0;
		return this.instance.open(options);
	},

	close: function() {
		return $.magnificPopup.instance && $.magnificPopup.instance.close();
	},

	registerModule: function(name, module) {
		if(module.options) {
			$.magnificPopup.defaults[name] = module.options;
		}
		$.extend(this.proto, module.proto);
		this.modules.push(name);
	},

	defaults: {

		// Info about options is in docs:
		// http://dimsemenov.com/plugins/magnific-popup/documentation.html#options

		disableOn: 0,

		key: null,

		midClick: false,

		mainClass: '',

		preloader: true,

		focus: '', // CSS selector of input to focus after popup is opened

		closeOnContentClick: false,

		closeOnBgClick: true,

		closeBtnInside: true,

		showCloseBtn: true,

		enableEscapeKey: true,

		modal: false,

		alignTop: false,

		removalDelay: 0,

		prependTo: null,

		fixedContentPos: 'auto',

		fixedBgPos: 'auto',

		overflowY: 'auto',

		closeMarkup: '<button title="%title%" type="button" class="mfp-close">&#215;</button>',

		tClose: 'Close (Esc)',

		tLoading: 'Loading...',

		autoFocusLast: true

	}
};



$.fn.magnificPopup = function(options) {
	_checkInstance();

	var jqEl = $(this);

	// We call some API method of first param is a string
	if (typeof options === "string" ) {

		if(options === 'open') {
			var items,
				itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
				index = parseInt(arguments[1], 10) || 0;

			if(itemOpts.items) {
				items = itemOpts.items[index];
			} else {
				items = jqEl;
				if(itemOpts.delegate) {
					items = items.find(itemOpts.delegate);
				}
				items = items.eq( index );
			}
			mfp._openClick({mfpEl:items}, jqEl, itemOpts);
		} else {
			if(mfp.isOpen)
				mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
		}

	} else {
		// clone options obj
		options = $.extend(true, {}, options);

		/*
		 * As Zepto doesn't support .data() method for objects
		 * and it works only in normal browsers
		 * we assign "options" object directly to the DOM element. FTW!
		 */
		if(_isJQ) {
			jqEl.data('magnificPopup', options);
		} else {
			jqEl[0].magnificPopup = options;
		}

		mfp.addGroup(jqEl, options);

	}
	return jqEl;
};

/*>>core*/

/*>>inline*/

var INLINE_NS = 'inline',
	_hiddenClass,
	_inlinePlaceholder,
	_lastInlineElement,
	_putInlineElementsBack = function() {
		if(_lastInlineElement) {
			_inlinePlaceholder.after( _lastInlineElement.addClass(_hiddenClass) ).detach();
			_lastInlineElement = null;
		}
	};

$.magnificPopup.registerModule(INLINE_NS, {
	options: {
		hiddenClass: 'hide', // will be appended with `mfp-` prefix
		markup: '',
		tNotFound: 'Content not found'
	},
	proto: {

		initInline: function() {
			mfp.types.push(INLINE_NS);

			_mfpOn(CLOSE_EVENT+'.'+INLINE_NS, function() {
				_putInlineElementsBack();
			});
		},

		getInline: function(item, template) {

			_putInlineElementsBack();

			if(item.src) {
				var inlineSt = mfp.st.inline,
					el = $(item.src);

				if(el.length) {

					// If target element has parent - we replace it with placeholder and put it back after popup is closed
					var parent = el[0].parentNode;
					if(parent && parent.tagName) {
						if(!_inlinePlaceholder) {
							_hiddenClass = inlineSt.hiddenClass;
							_inlinePlaceholder = _getEl(_hiddenClass);
							_hiddenClass = 'mfp-'+_hiddenClass;
						}
						// replace target inline element with placeholder
						_lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
					}

					mfp.updateStatus('ready');
				} else {
					mfp.updateStatus('error', inlineSt.tNotFound);
					el = $('<div>');
				}

				item.inlineElement = el;
				return el;
			}

			mfp.updateStatus('ready');
			mfp._parseMarkup(template, {}, item);
			return template;
		}
	}
});

/*>>inline*/

/*>>ajax*/
var AJAX_NS = 'ajax',
	_ajaxCur,
	_removeAjaxCursor = function() {
		if(_ajaxCur) {
			$(document.body).removeClass(_ajaxCur);
		}
	},
	_destroyAjaxRequest = function() {
		_removeAjaxCursor();
		if(mfp.req) {
			mfp.req.abort();
		}
	};

$.magnificPopup.registerModule(AJAX_NS, {

	options: {
		settings: null,
		cursor: 'mfp-ajax-cur',
		tError: '<a href="%url%">The content</a> could not be loaded.'
	},

	proto: {
		initAjax: function() {
			mfp.types.push(AJAX_NS);
			_ajaxCur = mfp.st.ajax.cursor;

			_mfpOn(CLOSE_EVENT+'.'+AJAX_NS, _destroyAjaxRequest);
			_mfpOn('BeforeChange.' + AJAX_NS, _destroyAjaxRequest);
		},
		getAjax: function(item) {

			if(_ajaxCur) {
				$(document.body).addClass(_ajaxCur);
			}

			mfp.updateStatus('loading');

			var opts = $.extend({
				url: item.src,
				success: function(data, textStatus, jqXHR) {
					var temp = {
						data:data,
						xhr:jqXHR
					};

					_mfpTrigger('ParseAjax', temp);

					mfp.appendContent( $(temp.data), AJAX_NS );

					item.finished = true;

					_removeAjaxCursor();

					mfp._setFocus();

					setTimeout(function() {
						mfp.wrap.addClass(READY_CLASS);
					}, 16);

					mfp.updateStatus('ready');

					_mfpTrigger('AjaxContentAdded');
				},
				error: function() {
					_removeAjaxCursor();
					item.finished = item.loadError = true;
					mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src));
				}
			}, mfp.st.ajax.settings);

			mfp.req = $.ajax(opts);

			return '';
		}
	}
});

/*>>ajax*/

/*>>image*/
var _imgInterval,
	_getTitle = function(item) {
		if(item.data && item.data.title !== undefined)
			return item.data.title;

		var src = mfp.st.image.titleSrc;

		if(src) {
			if($.isFunction(src)) {
				return src.call(mfp, item);
			} else if(item.el) {
				return item.el.attr(src) || '';
			}
		}
		return '';
	};

$.magnificPopup.registerModule('image', {

	options: {
		markup: '<div class="mfp-figure">'+
					'<div class="mfp-close"></div>'+
					'<figure>'+
						'<div class="mfp-img"></div>'+
						'<figcaption>'+
							'<div class="mfp-bottom-bar">'+
								'<div class="mfp-title"></div>'+
								'<div class="mfp-counter"></div>'+
							'</div>'+
						'</figcaption>'+
					'</figure>'+
				'</div>',
		cursor: 'mfp-zoom-out-cur',
		titleSrc: 'title',
		verticalFit: true,
		tError: '<a href="%url%">The image</a> could not be loaded.'
	},

	proto: {
		initImage: function() {
			var imgSt = mfp.st.image,
				ns = '.image';

			mfp.types.push('image');

			_mfpOn(OPEN_EVENT+ns, function() {
				if(mfp.currItem.type === 'image' && imgSt.cursor) {
					$(document.body).addClass(imgSt.cursor);
				}
			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(imgSt.cursor) {
					$(document.body).removeClass(imgSt.cursor);
				}
				_window.off('resize' + EVENT_NS);
			});

			_mfpOn('Resize'+ns, mfp.resizeImage);
			if(mfp.isLowIE) {
				_mfpOn('AfterChange', mfp.resizeImage);
			}
		},
		resizeImage: function() {
			var item = mfp.currItem;
			if(!item || !item.img) return;

			if(mfp.st.image.verticalFit) {
				var decr = 0;
				// fix box-sizing in ie7/8
				if(mfp.isLowIE) {
					decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
				}
				item.img.css('max-height', mfp.wH-decr);
			}
		},
		_onImageHasSize: function(item) {
			if(item.img) {

				item.hasSize = true;

				if(_imgInterval) {
					clearInterval(_imgInterval);
				}

				item.isCheckingImgSize = false;

				_mfpTrigger('ImageHasSize', item);

				if(item.imgHidden) {
					if(mfp.content)
						mfp.content.removeClass('mfp-loading');

					item.imgHidden = false;
				}

			}
		},

		/**
		 * Function that loops until the image has size to display elements that rely on it asap
		 */
		findImageSize: function(item) {

			var counter = 0,
				img = item.img[0],
				mfpSetInterval = function(delay) {

					if(_imgInterval) {
						clearInterval(_imgInterval);
					}
					// decelerating interval that checks for size of an image
					_imgInterval = setInterval(function() {
						if(img.naturalWidth > 0) {
							mfp._onImageHasSize(item);
							return;
						}

						if(counter > 200) {
							clearInterval(_imgInterval);
						}

						counter++;
						if(counter === 3) {
							mfpSetInterval(10);
						} else if(counter === 40) {
							mfpSetInterval(50);
						} else if(counter === 100) {
							mfpSetInterval(500);
						}
					}, delay);
				};

			mfpSetInterval(1);
		},

		getImage: function(item, template) {

			var guard = 0,

				// image load complete handler
				onLoadComplete = function() {
					if(item) {
						if (item.img[0].complete) {
							item.img.off('.mfploader');

							if(item === mfp.currItem){
								mfp._onImageHasSize(item);

								mfp.updateStatus('ready');
							}

							item.hasSize = true;
							item.loaded = true;

							_mfpTrigger('ImageLoadComplete');

						}
						else {
							// if image complete check fails 200 times (20 sec), we assume that there was an error.
							guard++;
							if(guard < 200) {
								setTimeout(onLoadComplete,100);
							} else {
								onLoadError();
							}
						}
					}
				},

				// image error handler
				onLoadError = function() {
					if(item) {
						item.img.off('.mfploader');
						if(item === mfp.currItem){
							mfp._onImageHasSize(item);
							mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
						}

						item.hasSize = true;
						item.loaded = true;
						item.loadError = true;
					}
				},
				imgSt = mfp.st.image;


			var el = template.find('.mfp-img');
			if(el.length) {
				var img = document.createElement('img');
				img.className = 'mfp-img';
				if(item.el && item.el.find('img').length) {
					img.alt = item.el.find('img').attr('alt');
				}
				item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
				img.src = item.src;

				// without clone() "error" event is not firing when IMG is replaced by new IMG
				// TODO: find a way to avoid such cloning
				if(el.is('img')) {
					item.img = item.img.clone();
				}

				img = item.img[0];
				if(img.naturalWidth > 0) {
					item.hasSize = true;
				} else if(!img.width) {
					item.hasSize = false;
				}
			}

			mfp._parseMarkup(template, {
				title: _getTitle(item),
				img_replaceWith: item.img
			}, item);

			mfp.resizeImage();

			if(item.hasSize) {
				if(_imgInterval) clearInterval(_imgInterval);

				if(item.loadError) {
					template.addClass('mfp-loading');
					mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
				} else {
					template.removeClass('mfp-loading');
					mfp.updateStatus('ready');
				}
				return template;
			}

			mfp.updateStatus('loading');
			item.loading = true;

			if(!item.hasSize) {
				item.imgHidden = true;
				template.addClass('mfp-loading');
				mfp.findImageSize(item);
			}

			return template;
		}
	}
});

/*>>image*/

/*>>zoom*/
var hasMozTransform,
	getHasMozTransform = function() {
		if(hasMozTransform === undefined) {
			hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
		}
		return hasMozTransform;
	};

$.magnificPopup.registerModule('zoom', {

	options: {
		enabled: false,
		easing: 'ease-in-out',
		duration: 300,
		opener: function(element) {
			return element.is('img') ? element : element.find('img');
		}
	},

	proto: {

		initZoom: function() {
			var zoomSt = mfp.st.zoom,
				ns = '.zoom',
				image;

			if(!zoomSt.enabled || !mfp.supportsTransition) {
				return;
			}

			var duration = zoomSt.duration,
				getElToAnimate = function(image) {
					var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
						transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
						cssObj = {
							position: 'fixed',
							zIndex: 9999,
							left: 0,
							top: 0,
							'-webkit-backface-visibility': 'hidden'
						},
						t = 'transition';

					cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

					newImg.css(cssObj);
					return newImg;
				},
				showMainContent = function() {
					mfp.content.css('visibility', 'visible');
				},
				openTimeout,
				animatedImg;

			_mfpOn('BuildControls'+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);
					mfp.content.css('visibility', 'hidden');

					// Basically, all code below does is clones existing image, puts in on top of the current one and animated it

					image = mfp._getItemToZoom();

					if(!image) {
						showMainContent();
						return;
					}

					animatedImg = getElToAnimate(image);

					animatedImg.css( mfp._getOffset() );

					mfp.wrap.append(animatedImg);

					openTimeout = setTimeout(function() {
						animatedImg.css( mfp._getOffset( true ) );
						openTimeout = setTimeout(function() {

							showMainContent();

							setTimeout(function() {
								animatedImg.remove();
								image = animatedImg = null;
								_mfpTrigger('ZoomAnimationEnded');
							}, 16); // avoid blink when switching images

						}, duration); // this timeout equals animation duration

					}, 16); // by adding this timeout we avoid short glitch at the beginning of animation


					// Lots of timeouts...
				}
			});
			_mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);

					mfp.st.removalDelay = duration;

					if(!image) {
						image = mfp._getItemToZoom();
						if(!image) {
							return;
						}
						animatedImg = getElToAnimate(image);
					}

					animatedImg.css( mfp._getOffset(true) );
					mfp.wrap.append(animatedImg);
					mfp.content.css('visibility', 'hidden');

					setTimeout(function() {
						animatedImg.css( mfp._getOffset() );
					}, 16);
				}

			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {
					showMainContent();
					if(animatedImg) {
						animatedImg.remove();
					}
					image = null;
				}
			});
		},

		_allowZoom: function() {
			return mfp.currItem.type === 'image';
		},

		_getItemToZoom: function() {
			if(mfp.currItem.hasSize) {
				return mfp.currItem.img;
			} else {
				return false;
			}
		},

		// Get element postion relative to viewport
		_getOffset: function(isLarge) {
			var el;
			if(isLarge) {
				el = mfp.currItem.img;
			} else {
				el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
			}

			var offset = el.offset();
			var paddingTop = parseInt(el.css('padding-top'),10);
			var paddingBottom = parseInt(el.css('padding-bottom'),10);
			offset.top -= ( $(window).scrollTop() - paddingTop );


			/*

			Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

			 */
			var obj = {
				width: el.width(),
				// fix Zepto height+padding issue
				height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
			};

			// I hate to do this, but there is no another option
			if( getHasMozTransform() ) {
				obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
			} else {
				obj.left = offset.left;
				obj.top = offset.top;
			}
			return obj;
		}

	}
});



/*>>zoom*/

/*>>iframe*/

var IFRAME_NS = 'iframe',
	_emptyPage = '//about:blank',

	_fixIframeBugs = function(isShowing) {
		if(mfp.currTemplate[IFRAME_NS]) {
			var el = mfp.currTemplate[IFRAME_NS].find('iframe');
			if(el.length) {
				// reset src after the popup is closed to avoid "video keeps playing after popup is closed" bug
				if(!isShowing) {
					el[0].src = _emptyPage;
				}

				// IE8 black screen bug fix
				if(mfp.isIE8) {
					el.css('display', isShowing ? 'block' : 'none');
				}
			}
		}
	};

$.magnificPopup.registerModule(IFRAME_NS, {

	options: {
		markup: '<div class="mfp-iframe-scaler">'+
					'<div class="mfp-close"></div>'+
					'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+
				'</div>',

		srcAction: 'iframe_src',

		// we don't care and support only one default type of URL by default
		patterns: {
			youtube: {
				index: 'youtube.com',
				id: 'v=',
				src: '//www.youtube.com/embed/%id%?autoplay=1'
			},
			vimeo: {
				index: 'vimeo.com/',
				id: '/',
				src: '//player.vimeo.com/video/%id%?autoplay=1'
			},
			gmaps: {
				index: '//maps.google.',
				src: '%id%&output=embed'
			}
		}
	},

	proto: {
		initIframe: function() {
			mfp.types.push(IFRAME_NS);

			_mfpOn('BeforeChange', function(e, prevType, newType) {
				if(prevType !== newType) {
					if(prevType === IFRAME_NS) {
						_fixIframeBugs(); // iframe if removed
					} else if(newType === IFRAME_NS) {
						_fixIframeBugs(true); // iframe is showing
					}
				}// else {
					// iframe source is switched, don't do anything
				//}
			});

			_mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() {
				_fixIframeBugs();
			});
		},

		getIframe: function(item, template) {
			var embedSrc = item.src;
			var iframeSt = mfp.st.iframe;

			$.each(iframeSt.patterns, function() {
				if(embedSrc.indexOf( this.index ) > -1) {
					if(this.id) {
						if(typeof this.id === 'string') {
							embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length, embedSrc.length);
						} else {
							embedSrc = this.id.call( this, embedSrc );
						}
					}
					embedSrc = this.src.replace('%id%', embedSrc );
					return false; // break;
				}
			});

			var dataObj = {};
			if(iframeSt.srcAction) {
				dataObj[iframeSt.srcAction] = embedSrc;
			}
			mfp._parseMarkup(template, dataObj, item);

			mfp.updateStatus('ready');

			return template;
		}
	}
});



/*>>iframe*/

/*>>gallery*/
/**
 * Get looped index depending on number of slides
 */
var _getLoopedId = function(index) {
		var numSlides = mfp.items.length;
		if(index > numSlides - 1) {
			return index - numSlides;
		} else  if(index < 0) {
			return numSlides + index;
		}
		return index;
	},
	_replaceCurrTotal = function(text, curr, total) {
		return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
	};

$.magnificPopup.registerModule('gallery', {

	options: {
		enabled: false,
		arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
		preload: [0,2],
		navigateByImgClick: true,
		arrows: true,

		tPrev: 'Previous (Left arrow key)',
		tNext: 'Next (Right arrow key)',
		tCounter: '%curr% of %total%'
	},

	proto: {
		initGallery: function() {

			var gSt = mfp.st.gallery,
				ns = '.mfp-gallery';

			mfp.direction = true; // true - next, false - prev

			if(!gSt || !gSt.enabled ) return false;

			_wrapClasses += ' mfp-gallery';

			_mfpOn(OPEN_EVENT+ns, function() {

				if(gSt.navigateByImgClick) {
					mfp.wrap.on('click'+ns, '.mfp-img', function() {
						if(mfp.items.length > 1) {
							mfp.next();
							return false;
						}
					});
				}

				_document.on('keydown'+ns, function(e) {
					if (e.keyCode === 37) {
						mfp.prev();
					} else if (e.keyCode === 39) {
						mfp.next();
					}
				});
			});

			_mfpOn('UpdateStatus'+ns, function(e, data) {
				if(data.text) {
					data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
				}
			});

			_mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
				var l = mfp.items.length;
				values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
			});

			_mfpOn('BuildControls' + ns, function() {
				if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
					var markup = gSt.arrowMarkup,
						arrowLeft = mfp.arrowLeft = $( markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left') ).addClass(PREVENT_CLOSE_CLASS),
						arrowRight = mfp.arrowRight = $( markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right') ).addClass(PREVENT_CLOSE_CLASS);

					arrowLeft.click(function() {
						mfp.prev();
					});
					arrowRight.click(function() {
						mfp.next();
					});

					mfp.container.append(arrowLeft.add(arrowRight));
				}
			});

			_mfpOn(CHANGE_EVENT+ns, function() {
				if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

				mfp._preloadTimeout = setTimeout(function() {
					mfp.preloadNearbyImages();
					mfp._preloadTimeout = null;
				}, 16);
			});


			_mfpOn(CLOSE_EVENT+ns, function() {
				_document.off(ns);
				mfp.wrap.off('click'+ns);
				mfp.arrowRight = mfp.arrowLeft = null;
			});

		},
		next: function() {
			mfp.direction = true;
			mfp.index = _getLoopedId(mfp.index + 1);
			mfp.updateItemHTML();
		},
		prev: function() {
			mfp.direction = false;
			mfp.index = _getLoopedId(mfp.index - 1);
			mfp.updateItemHTML();
		},
		goTo: function(newIndex) {
			mfp.direction = (newIndex >= mfp.index);
			mfp.index = newIndex;
			mfp.updateItemHTML();
		},
		preloadNearbyImages: function() {
			var p = mfp.st.gallery.preload,
				preloadBefore = Math.min(p[0], mfp.items.length),
				preloadAfter = Math.min(p[1], mfp.items.length),
				i;

			for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
				mfp._preloadItem(mfp.index+i);
			}
			for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
				mfp._preloadItem(mfp.index-i);
			}
		},
		_preloadItem: function(index) {
			index = _getLoopedId(index);

			if(mfp.items[index].preloaded) {
				return;
			}

			var item = mfp.items[index];
			if(!item.parsed) {
				item = mfp.parseEl( index );
			}

			_mfpTrigger('LazyLoad', item);

			if(item.type === 'image') {
				item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
					item.hasSize = true;
				}).on('error.mfploader', function() {
					item.hasSize = true;
					item.loadError = true;
					_mfpTrigger('LazyLoadError', item);
				}).attr('src', item.src);
			}


			item.preloaded = true;
		}
	}
});

/*>>gallery*/

/*>>retina*/

var RETINA_NS = 'retina';

$.magnificPopup.registerModule(RETINA_NS, {
	options: {
		replaceSrc: function(item) {
			return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; });
		},
		ratio: 1 // Function or number.  Set to 1 to disable.
	},
	proto: {
		initRetina: function() {
			if(window.devicePixelRatio > 1) {

				var st = mfp.st.retina,
					ratio = st.ratio;

				ratio = !isNaN(ratio) ? ratio : ratio();

				if(ratio > 1) {
					_mfpOn('ImageHasSize' + '.' + RETINA_NS, function(e, item) {
						item.img.css({
							'max-width': item.img[0].naturalWidth / ratio,
							'width': '100%'
						});
					});
					_mfpOn('ElementParse' + '.' + RETINA_NS, function(e, item) {
						item.src = st.replaceSrc(item, ratio);
					});
				}
			}

		}
	}
});

/*>>retina*/
 _checkInstance(); }));

jQuery(document).ready(function($) {
	dtGlobals.magnificPopupBaseConfig = {
		type: 'image',
		tLoading: 'Loading image ...',
		mainClass: 'mfp-img-mobile',
		removalDelay: 300,
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return this.st.dt.getItemTitle(item);
			}
		},
		iframe: {
			markup: '<div class="mfp-iframe-scaler">'+
					'<div class="mfp-close"></div>'+
					'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
					'<div class="mfp-bottom-bar">'+
					'<div class="mfp-title"></div>'+
					'<div class="mfp-counter"></div>'+
					'</div>'+
					'</div>'
		},
		callbacks: {
			markupParse: function(template, values, item) {
				if ( 'iframe' == item.type ) {
					template.find('.mfp-title').html( this.st.dt.getItemTitle(item) );
				}

				if ( !this.ev.attr('data-pretty-share') ) {
					template.addClass("no-share-buttons");
				}
			},
			change: function() {
				if (this.isOpen) {
					/*transition between the images in the gallery*/
					this.wrap.addClass('mfp-open');
				}
			},
			beforeClose: function() {
				$('body, html').css('overflow','');
				this.wrap.removeClass('mfp-open');
				this.content.addClass('mfp-removing');
			},
			close: function() {
				this.content.removeClass('mfp-removing'); 
			},
			beforeOpen: function() {

				var magnificPopup = this;
				// create settings container
				if ( typeof this.st.dt == 'undefined' ) {
					this.st.dt = {};
				}

				// save share buttons array
				this.st.dt.shareButtonsList = this.ev.attr('data-pretty-share') ? this.ev.attr('data-pretty-share').split(',') : new Array();

				// share buttons template
				this.st.dt.shareButtonsTemplates = {
					twitter : '<a href="https://twitter.com/share?text={share_title}&url={location_href}" class="share-button twitter" target="_blank" title="twitter"> ' + '<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#twitter"></use></svg>' + '</a>',
					facebook : '<a href="http://www.facebook.com/sharer.php?u={location_href}&t={share_title}" class="share-button facebook" target="_blank" title="facebook">' + '<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#facebook"></use></svg>' + '</a>',
					google : '<a href="////plus.google.com/share?url={location_href}&title={share_title}" class="share-button google" target="_blank" title="google+">' + '<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#google"></use></svg>' + '</a>',
					pinterest : '<a href="//pinterest.com/pin/create/button/?url={location_href}&description={share_title}&media={image_src}" class="share-button pinterest" target="_blank" title="pin it">' + '<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#pinterest"></use></svg>' + '</a>',
					linkedin : '<a href="//www.linkedin.com/shareArticle?mini=true&url={location_href}&title={share_title}" class="share-button linkedin" target="_blank" >' + '<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#linkedin"></use></svg>' + '</a>'
				};

				// share buttons
				this.st.dt.getShareButtons = function ( itemData ) {

					var shareButtons = magnificPopup.st.dt.shareButtonsList,
						pinterestIndex = -1,
						shareButtonsLemgth = shareButtons.length,
						html = '';

					for( var i = 0; i < shareButtons.length; i++ ) {

						if ( 'pinterest' == shareButtons[i] ) {
							pinterestIndex = i;
							break;
						}
					}

					if ( shareButtonsLemgth <= 0 ) {
						return '';
					}

					for ( var i = 0; i < shareButtonsLemgth; i++ ) {

						// exclude pinterest button for iframes
						if ( 'iframe' == itemData['type'] && pinterestIndex == i ) {
							continue;
						}

						var	itemTitle = itemData['title'],
							itemSrc = itemData['src'],
							itemLocation = itemData['location'];

						if ( 'google' == shareButtons[i] ) {
							itemTitle = itemTitle.replace(' ', '+');
						}

						html += magnificPopup.st.dt.shareButtonsTemplates[ shareButtons[i] ].replace('{location_href}', encodeURIComponent(itemLocation)).replace('{share_title}', encodeURIComponent(itemTitle)).replace('{image_src}', encodeURIComponent(itemSrc));
					}

					return '<div class="entry-share"><div class="soc-ico">' + html + '<div></div>';
				}

				// item title
				this.st.dt.getItemTitle = function(item) {
					var imgTitle = item.el.attr('title') || '',
						imgSrc = item.el.attr('href'),
						imgDesc = item.el.attr('data-dt-img-description') || '',
						imgLocation = item.el.attr('data-dt-location') || location.href,
						shareButtons = magnificPopup.st.dt.getShareButtons( { 'title': imgDesc, 'src': imgSrc, 'type': item.type, 'location': imgLocation } );

					return '<div class="mfp-title-wrap">' + imgTitle + '<small>' + imgDesc + '</small>' + '</div>' + shareButtons;
				}
			}
		}
	};

	// trigger click on first anchor in the gallery container
	// work only for posts list
	$('.dt-gallery-mfp-popup, .dt-trigger-first-mfp').addClass('mfp-ready').on('click', function(){
		var $this = $(this),
			$container = $this.parents('article.post').first();
		//prevent click on moving scroller
		if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
		if ( $container.length > 0 ) {

			if($container.find('.dt-gallery-container').length > 0){
				//open gallery (more then one img)
				var $target = $container.find('.dt-gallery-container a.dt-mfp-item');
			}else{
				//open gallery (single img)
				var $target = $container.find('a.dt-mfp-item');
			}

			if ( $target.length > 0 ) {
				$target.first().trigger('click');
			}
		};

		return false;
	});

	// trigger click on first a.dt-mfp-item in the container
	// $('.dt-trigger-first-mfp').addClass('mfp-ready').on('click', function(){
	// 	var $this = $(this),
	// 		$container = $this.parents('article.post');
	// 	if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

	// 	if ( $container.length > 0 ) {
	// 		var $target = $container.find('a.dt-mfp-item');

	// 		if ( $target.length > 0 ) {
	// 			$target.first().trigger('click');
	// 		}
	// 	};

	// 	return false;
	// });

	// single image popup
	$('.dt-single-image').addClass('mfp-ready').magnificPopup({
		type: 'image'
	});

	// single video popup
	$('.dt-single-video').addClass('mfp-ready').magnificPopup({
		type: 'iframe'
	});

	// single image/video popup
	$('.dt-single-mfp-popup').on("click", function(e){
		var $this = $(this);
		//prevent click on moving scroller
		if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) {
			e.preventDefault();
			e.stopImmediatePropagation();
		};
		if($this.parents(".photo-scroller").length > 0){
			var parScroller = $this.parents(".photo-scroller"),
			parAutoPlay = parScroller.find(".auto-play-btn");

			if( parAutoPlay.hasClass("paused") ){
				parScroller.addClass("mfp-opened");
				parScroller.find(".auto-play-btn.paused").trigger("click");
			};
		};
		if($this.parents("#main-slideshow").length > 0){
			var parScroller = $this.parents("#main-slideshow"),
			parAutoPlay = parScroller.find(".progress-wrapper");

			if( !parAutoPlay.hasClass("paused") ){
				parScroller.addClass("mfp-opened");
				parScroller.find(".progress-wrapper").trigger("click");
			};
		};
		if($this.parents(".slider-wrapper").length > 0){
			var parScrollerShor = $this.parents(".slider-wrapper"),
				parAutoPlayShor = parScrollerShor.find(".auto-play-btn");

			if( parAutoPlayShor.hasClass("paused") ){
				parScrollerShor.addClass("mfp-opened");
				parScrollerShor.find(".auto-play-btn.paused").trigger("click");
			};
		}

	});

	$('.dt-single-mfp-popup').addClass('mfp-ready').magnificPopup($.extend( true, dtGlobals.magnificPopupBaseConfig, {
		callbacks: {
			close: function() {
				$(".photo-scroller.mfp-opened").find(".auto-play-btn").trigger("click");
				$(".photo-scroller").removeClass("mfp-opened");
				$("#main-slideshow.mfp-opened").find(".progress-wrapper").trigger("click");
				$("#main-slideshow").removeClass("mfp-opened");
				$(".slider-wrapper.mfp-opened").find(".auto-play-btn").trigger("click");
				$(".slider-wrapper").removeClass("mfp-opened");
			}
		}
	}));

	//gallery lightbox settings
	$(".dt-gallery-container").each(function(){
		if($(this).parents(".slider-wrapper").length > 0){
			var $this = $(this).parents(".slider-wrapper");
		}else{
			var $this = $(this);
		}
		var $thisPlay = $this.find(".auto-play-btn");
		$(this).addClass('mfp-ready').magnificPopup( $.extend( true, dtGlobals.magnificPopupBaseConfig, {
			delegate: 'a.dt-mfp-item',
			tLoading: 'Loading image #%curr%...',
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			callbacks: {
				open: function() {
					var stopAutoPlay = ( 'true' === $this.attr("data-autoslide") ) ? true : false;
					if(stopAutoPlay){
						if( $thisPlay.hasClass("paused") ){
							$this.addClass("mfp-opened");
							$this.find(".auto-play-btn.paused").trigger("click");
						};
					}
				},
				close: function() {
					if( $this.hasClass("mfp-opened") ){
						$this.find(".auto-play-btn").trigger("click");
						$this.removeClass("mfp-opened");
					}
				}
			}

		} ) );
	});
})

/*!-Before After*/
jQuery(document).ready(function($) {
	if($(".twentytwenty-container").length > 0){
		$.fn.twentytwenty = function(options) {
			var options = $.extend({
				default_offset_pct: 0.5,
				orientation: 'horizontal',
				navigation_follow: false
			}, options);
			return this.each(function() {

				var sliderPct = options.default_offset_pct;
				var container = $(this);
				var sliderOrientation = options.orientation;
				var beforeDirection = (sliderOrientation === 'vertical') ? 'down' : 'left';
				var afterDirection = (sliderOrientation === 'vertical') ? 'up' : 'right';
				var slideOnHover = options.navigation_follow;

				container.wrap("<div class='twentytwenty-wrapper twentytwenty-" + sliderOrientation + "'></div>");
				var beforeImg = container.find("img:first"),
					afterImg = container.find("img:last"),
					beforeImgAlt = beforeImg.attr("title"),
					afterImgAlt = afterImg.attr("title");
				container.append("<div class='twentytwenty-handle'></div>");
				var slider = container.find(".twentytwenty-handle");
				slider.append("<span class='twentytwenty-" + beforeDirection + "-arrow'></span>");
				slider.append("<span class='twentytwenty-" + afterDirection + "-arrow'></span>");
				container.addClass("twentytwenty-container");
				beforeImg.addClass("twentytwenty-before");
				afterImg.addClass("twentytwenty-after");
				if(typeof beforeImgAlt != 'undefined' && beforeImgAlt && beforeImgAlt.length > 0) {
					container.append("<div class='twentytwenty-before-label'>" + beforeImgAlt + "</div>");
				};
				if(typeof afterImgAlt != 'undefined' && afterImgAlt && afterImgAlt.length > 0) {
					container.append("<div class='twentytwenty-after-label'>" + afterImgAlt + "</div>");
				}

				var calcOffset = function(dimensionPct) {
					var w = beforeImg.width();
					var h = beforeImg.height();
					return {
						w: w+"px",
						h: h+"px",
						cw: (dimensionPct*w)+"px",
						ch: (dimensionPct*h)+"px"
					};
				};

				var adjustContainer = function(offset) {
					if (sliderOrientation === 'vertical') {
						beforeImg.css("clip", "rect(0,"+offset.w+","+offset.ch+",0)");
					}
					else {
						beforeImg.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
					}
					container.css("height", offset.h);
				};

				var adjustSlider = function(pct) {
					var offset = calcOffset(pct);
					slider.css((sliderOrientation==="vertical") ? "top" : "left", (sliderOrientation==="vertical") ? offset.ch : offset.cw);
					adjustContainer(offset);
				};

				$(window).on("resize.twentytwenty", function(e) {
					adjustSlider(sliderPct);
				});

				var offsetX = 0;
				var imgWidth = 0;
				slider.on("movestart", function(e) {
					if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && sliderOrientation !== 'vertical') {
						e.preventDefault();
					}
					else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && sliderOrientation === 'vertical') {
						e.preventDefault();
					}
					container.addClass("active");
					container.removeClass("active-click");
					offsetX = container.offset().left;
					offsetY = container.offset().top;
					imgWidth = beforeImg.width(); 
					imgHeight = beforeImg.height();
				});

				slider.on("moveend", function(e) {
					container.removeClass("active");
				});

				slider.on("move", function(e) {
					if (container.hasClass("active")) {
						sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
						if (sliderPct < 0) {
							sliderPct = 0;
						}
						if (sliderPct > 1) {
							sliderPct = 1;
						}
						adjustSlider(sliderPct);
					}
				});
				if (!slideOnHover && !container.hasClass("active")) {
					container.on("mouseup", function(e) {
						container.removeClass("active-click");
					});
					container.on("mousedown", function(e) {
						//container.addClass("active");
						container.addClass("active-click");
						offsetX = container.offset().left;
						offsetY = container.offset().top;
						imgWidth = beforeImg.width(); 
						imgHeight = beforeImg.height();
						sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
						if (sliderPct < 0) {
							sliderPct = 0;
						}
						if (sliderPct > 1) {
							sliderPct = 1;
						}
						adjustSlider(sliderPct);
					});
				};

				container.find("img").on("mousedown", function(event) {
					event.preventDefault();
				});

				if (slideOnHover) {
					container.on("mouseenter", function (e) {
						container.addClass("active");
						offsetX = container.offset().left;
						offsetY = container.offset().top;
						imgWidth = beforeImg.width();
						imgHeight = beforeImg.height()
					});
					container.on("mouseleave", function (e) {
						container.removeClass("active")
					});
					container.on("mousemove", function (e) {
						if (container.hasClass("active")) {
							sliderPct = sliderOrientation === "vertical" ? (e.pageY - offsetY) / imgHeight : (e.pageX - offsetX) / imgWidth;
							if (sliderPct < 0) {
								sliderPct = 0
							}
							if (sliderPct > 1) {
								sliderPct = 1
							}
							adjustSlider(sliderPct)
						}
					});
				};

				$(window).trigger("resize.twentytwenty");
			});
		};
	}
})

jQuery(document).ready(function ($) {
	if (!('ontouchstart' in window) && (dtLocal.themeSettings.smoothScroll == "on" || dtLocal.themeSettings.smoothScroll == "on_parallax" && $(".stripe-parallax-bg").length > 0)) {
		$("body").css({"scroll-behavior" : "smooth"});
	}

});



/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

jQuery(document).ready(function ($) {
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		var fixTimeout;
		
		//get the starting position of each element to have parallax applied to it    
		$this.each(function(){
				firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}
			
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
		
		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();        

			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((top - pos) * speedFactor) + "px");
			});
		}   

		$window.bind('scroll', update).resize(function() {
			update();
		}).bind("debouncedresize", function() {
			clearTimeout(fixTimeout);
			fixTimeout = setTimeout(function() {
				update();
			}, 20);
		});
		update();

		setTimeout(function() {
			if (!window.bgGlitchFixed && $.browser.webkit) {
				$window.scrollTop($window.scrollTop() + 1);
				window.bgGlitchFixed = true;
			}
		}, 20);

	};
});



/*!
 * Name    : Just Another Parallax [Jarallax]
 * Version : 1.1.0
 * Author  : _nK http://nkdev.info
 * GitHub  : https://github.com/nk-o/jarallax
 */


/*!
 * Name    : Just Another Parallax [Jarallax]
 * Version : 1.2.0
 * Author  : _nK http://nkdev.info
 * GitHub  : https://github.com/nk-o/jarallax
 */
(function(factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports !== 'undefined') {
        module.exports = factory(require('jquery'));
    } else {
        factory(jQuery);
    }
}(function($) {
    // Adapted from https://gist.github.com/paulirish/1579671
    if (!Date.now)
        Date.now = function() { return new Date().getTime(); };
    if(!window.requestAnimationFrame)
        (function() {
            'use strict';
            
            var vendors = ['webkit', 'moz'];
            for (var i = 0; i < vendors.length && !window.requestAnimationFrame; ++i) {
                var vp = vendors[i];
                window.requestAnimationFrame = window[vp+'RequestAnimationFrame'];
                window.cancelAnimationFrame = (window[vp+'CancelAnimationFrame']
                                           || window[vp+'CancelRequestAnimationFrame']);
            }
            if (/iP(ad|hone|od).*OS 6/.test(window.navigator.userAgent) // iOS6 is buggy
                || !window.requestAnimationFrame || !window.cancelAnimationFrame) {
                var lastTime = 0;
                window.requestAnimationFrame = function(callback) {
                    var now = Date.now();
                    var nextTime = Math.max(lastTime + 16, now);
                    return setTimeout(function() { callback(lastTime = nextTime); },
                                      nextTime - now);
                };
                window.cancelAnimationFrame = clearTimeout;
            }
        }());

    var supportTransform = (function() {
        var prefixes = 'transform WebkitTransform MozTransform OTransform msTransform'.split(' ');
        var div = document.createElement('div');
        for(var i = 0; i < prefixes.length; i++) {
            if(div && div.style[prefixes[i]] !== undefined) {
                return prefixes[i];
            }
        }
        return false;
    }());

    var support3dtransform = (function() {
        if (!window.getComputedStyle) {
            return false;
        }

        var el = document.createElement('p'), 
            has3d,
            transforms = {
                'webkitTransform':'-webkit-transform',
                'OTransform':'-o-transform',
                'msTransform':'-ms-transform',
                'MozTransform':'-moz-transform',
                'transform':'transform'
            };

        // Add it to the body to get the computed style.
        (document.body || document.documentElement).insertBefore(el, null);

        for (var t in transforms) {
            if (el.style[t] !== undefined) {
                el.style[t] = "translate3d(1px,1px,1px)";
                has3d = window.getComputedStyle(el).getPropertyValue(transforms[t]);
            }
        }

        (document.body || document.documentElement).removeChild(el);

        return (has3d !== undefined && has3d.length > 0 && has3d !== "none");
    }());
    
    var isAndroid = navigator.userAgent.toLowerCase().indexOf('android') > -1;
    var isOperaOld = !!window.opera;

    // list with all jarallax instances
    // need to render all in one scroll/resize event
    var jarallaxList = [];

    // Jarallax instance
    var Jarallax = (function() {
        var instanceID = 0;

        function Jarallax(item, userOptions) {
            var _this = this,
                dataOptions;

            _this.$item      = $(item);

            _this.defaults   = {
                speed             : 0.5,
                imgSrc            : null,
                imgWidth          : null,
                imgHeight         : null,
                enableTransform   : true,
                zIndex            : -100
            };
            dataOptions      = _this.$item.data('jarallax') || {};
            _this.options    = $.extend({}, _this.defaults, dataOptions, userOptions);

            // fix speed option [0.0, 1.0]
            _this.options.speed = Math.min(1, Math.max(-1, parseFloat(_this.options.speed)));

            _this.instanceID = instanceID++;

            _this.image      = {
                src        : _this.options.imgSrc || null,
                $container : null,
                $item      : null,
                width      : _this.options.imgWidth || null,
                height     : _this.options.imgHeight || null,
                // fix for Android devices
                // use <img> instead background image - more smoothly
                useImgTag  : isAndroid || isOperaOld
            }

            if(_this.initImg()) {
                _this.init();

                jarallaxList.push(_this);
            }
        }

        return Jarallax;
    }());

    Jarallax.prototype.initImg = function() {
        var _this = this;

        // get image src
        if(_this.image.src === null) {
            _this.image.src = _this.$item.css('background-image').replace(/^url\(['"]?/g,'').replace(/['"]?\)$/g,'');
        }
        if(!_this.image.src || _this.image.src === 'none') {
            return false;
        }
        return true;
    }

    Jarallax.prototype.init = function() {

        if($(".header-side-line").length > 0 ){
            var sideHW = $(".side-header-v-stroke").width();
        }else if(!$("body").hasClass("sticky-header") && !$("body").hasClass("overlay-navigation") && $(".side-header").length > 0){
            var sideHW = $(".side-header").width();
        }else{
            var sideHW = 0;
        }
        //if($(".move-header-animation").length > 0){
            var $position = "absolute";
        // }else{
        //     var $position = "fixed";
        // }
       
        var _this = this;
        if(_this.$item[0].classList[0] == 'stripe'){
            var stripePadL  = 2000 + sideHW;
        }else{
            var stripePadL  = $(".content").offset().left + 22;
        }

        var pageW = $("#page").width(),
            pageOfL  = stripePadL - $(".content").offset().left - 22,
             containerStylesStripe = {
                position         : 'absolute',
                top              : 0,
                left             : pageOfL,
                // 'marginLeft'     : pageOfL,

                width            : pageW,
                height           : '100%',
                overflow         : 'hidden',
                'pointer-events' : 'none',
                'transition'     : 'transform linear -1ms, -webkit-transform linear -1ms'
            },
            containerStyles = {
                position         : 'absolute',
                top              : 0,
                left             : 0,
                width            : '100%',
                height           : '100%',
                overflow         : 'hidden',
                'pointer-events' : 'none',
                'transition'     : 'transform linear -1ms, -webkit-transform linear -1ms'
            },
            imageStyles = {
                position              : $position,
                left             : 50 + '%',
            };

        // container for parallax image
        _this.image.$container = $('<div>')
            .css(containerStyles)
            .css({
                visibility : 'hidden',
                'z-index'  : _this.options.zIndex
            })
            .attr('id', 'jarallax-container-' + _this.instanceID)
            .prependTo(_this.$item);

        // use img tag
        if(_this.image.useImgTag && supportTransform) {
            _this.image.$item = $('<img>').attr('src', _this.image.src);
            imageStyles = $.extend({
                'max-width' : 'none'
            }, containerStyles, imageStyles)
        }

        // use div with background image
        else {
            _this.image.$item = $('<div>');
            imageStyles = $.extend({
                'background-position' : 'inherit',
                'background-repeat'   : 'inherit',
                'background-image'    : 'url("' + _this.image.src + '")'
            }, containerStyles, imageStyles)
        }

        // parallax image
        _this.image.$item.css(imageStyles)
            .prependTo(_this.image.$container);

        // cover image if width and height is ready
        function initAfterReady() {
            _this.coverImage();
            _this.clipContainer();
            _this.onScroll(true);

            // save default user styles
            _this.$item.data('jarallax-original-styles', _this.$item.attr('style'));

            // timeout to fix IE blinking
            setTimeout(function() {
                // remove default user background
                _this.$item.css({
                    'background-image'      : 'none',
                    'background-attachment' : 'scroll',
                    'background-size'       : 'auto'
                });
            }, 0);
        }

        if(_this.image.width && _this.image.height) {
            // init if width and height already exists
            initAfterReady();
        } else {
            // load image and get width and height
            _this.getImageSize(_this.image.src, function(width, height) {
                _this.image.width  = width;
                _this.image.height = height;
                initAfterReady();
            });
        }
    };

    Jarallax.prototype.destroy = function() {
        var _this = this;

        // remove from instances list
        for(var k = 0, len = jarallaxList.length; k < len; k++) {
            if(jarallaxList[k].instanceID === _this.instanceID) {
                jarallaxList.splice(k, 1);
                break;
            }
        }

        // remove additional styles for clip
        $('head #jarallax-clip-' + _this.instanceID).remove();

        _this.$item.attr('style', _this.$item.data('jarallax-original-styles'));
        _this.$item.removeData('jarallax-original-styles');

        _this.image.$container.remove();

        delete _this.$item[0].jarallax;
    }

    // round to 2 decimals
    Jarallax.prototype.round = function(num) {
        return Math.floor(num * 100) / 100;
    }

    Jarallax.prototype.getImageSize = function(src, callback) {
        if(!src || !callback) {
            return false;
        }

        var tempImg = new Image();
        tempImg.onload = function() {
            callback(tempImg.width, tempImg.height)
        }
        tempImg.src = src;
    }

    // it will remove some image overlapping
    // overlapping occur due to an image position fixed inside absolute possition element (webkit based browsers works without any fix)
    Jarallax.prototype.clipContainer = function() {
        var _this  = this,
            width  = _this.image.$container.outerWidth(true),
            height = _this.image.$container.outerHeight(true);

        var $styles = $('head #jarallax-clip-' + _this.instanceID);
        if(!$styles.length) {
            $('head').append('<style type="text/css" id="jarallax-clip-' + _this.instanceID + '"></style>');
            $styles = $('head #jarallax-clip-' + _this.instanceID);
        }

        var css = [
            '#jarallax-container-' + _this.instanceID + ' {',
            '   clip: rect(0px ' + width + 'px ' + height + 'px 0);',
            '   clip: rect(0px, ' + width + 'px, ' + height + 'px, 0);',
            '}'
        ].join('\n');

        // add clip styles inline (this method need for support IE8 and less browsers)
        if ($styles[0].styleSheet) {
            $styles[0].styleSheet.cssText = css;
        } else {
            $styles.html(css);
        }
    }

    Jarallax.prototype.coverImage = function() {
        var _this = this;

        if(!_this.image.width || !_this.image.height) {
            return;
        }
        if(!$("body").hasClass("transparent")){
            var headerH = $(".masthead:not(.side-header):not(.side-header-v-stroke)").height() + $("#wpadminbar").height();
        }else{
            var headerH = 0 + $("#wpadminbar").height();
        }
        if($(".side-header-v-stroke").length > 0){
            var headerW = $(".side-header-v-stroke").width();
        }else {

            var headerW = 0;
        }
        console.log(headerH + "headerH")

        var contW = _this.image.$container.outerWidth(true),
            contH = _this.image.$container.outerHeight(true),
            wndW  = $(window).outerWidth(true),
            whdH  = $(window).outerHeight(true),
            imgW  = _this.image.width,
            imgH  = _this.image.height,
            resultWidth, resultHeight;
        if(_this.$item[0].classList[0] == 'stripe'){
              var contW = _this.image.$container.outerWidth(true) - 4000
        }

        var css = {
            width  : Math.max(wndW, contW) * 1,
            height : Math.max(whdH, contH) * Math.max(_this.options.speed, 1) /*+ headerH*/
        };
        //  if(_this.image.$item.css("position") == "absolute"){
        // 	 var css = {
	       //      width  : Math.max(wndW, contW) * 1,
	       //      height : Math.max(whdH, contH) * Math.max(_this.options.speed, 1) * 1.5
	       //  };
        // }

        // cover by width
        if(css.width / css.height > imgW / imgH) {
            resultWidth = css.width;
            resultHeight = css.width * imgH / imgW;
        }

        // cover by height
        else {
            resultWidth = css.height * imgW / imgH;
            resultHeight = css.height;
        }
        
        // for img tag
        if(_this.image.useImgTag && supportTransform) {
            css.width = _this.round(resultWidth);
            css.height = _this.round(resultHeight);
            css.marginLeft = _this.round(- (resultWidth - contW) / 2);
            css.marginTop = _this.round(- (resultHeight - contH) / 2);
        }

        // for div with background image
        else {
            css.backgroundSize = _this.round(resultWidth) + 'px ' + _this.round(resultHeight) + 'px';
        }

        // apply to item
        _this.image.$item.css(css);
    };

    Jarallax.prototype.onScroll = function(force) {
        var _this = this;

        if(!_this.image.width || !_this.image.height) {
            return;
        }

        var scrollTop     = $(window).scrollTop(),
            scrollLeft    = $(window).scrollLeft(),
            wndWidth      = $(window).width(),
            wndHeight     = $(window).height(),
            // starting position of each element to have parallax applied to it
            sectionTop    = _this.$item.offset().top,
            sectionLeft    = _this.$item.offset().left,
            sectionHeight = _this.$item.outerHeight(true),
            css           = {
                visibility         : 'visible',
                backgroundPosition : 'inherit'
            };

        // if(_this.image.$item.css("position") == "absolute"){
        //      var sectionTop    = _this.$item.position().top - $(".side-header-h-stroke").height();
        // }

        // Check if totally above or totally below viewport
        var check = force ? false
                          : sectionTop + sectionHeight < scrollTop || sectionTop > scrollTop + wndHeight;
        if (check) {
            return;
        }

        // calculate parallax
        var positionY = - (scrollTop - sectionTop) * _this.options.speed;
        var positionX = - (scrollLeft - sectionLeft) * _this.options.speed;
            positionY = _this.round(positionY);
            positionX = _this.round(positionX);
            console.log(sectionTop + "top offset", _this.options.speed + " speed", _this.image.$item.css("position"))
       

        if(supportTransform && _this.options.enableTransform) {
            css.transform = 'translateY(' + positionY + 'px) translateX(' + positionX + 'px)';
            if(support3dtransform) {
                css.transform = 'translate3d(' + -50 + '%, ' + positionY + 'px, 0)';
            }
        } else {
            css.backgroundPosition = positionX + 'px ' + positionY + 'px';
        }

        _this.image.$item.css(css);
    };

    // init events
    (function() {
        $(window).on('scroll.jarallax', function() {
            window.requestAnimationFrame(function() {
                for(var k = 0, len = jarallaxList.length; k < len; k++) {
                    jarallaxList[k].onScroll();
                }
            });
        });

        var timeout;
        $(window).on('resize.jarallax orientationchange.jarallax load.jarallax', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                window.requestAnimationFrame(function() {
                    for(var k = 0, len = jarallaxList.length; k < len; k++) {
                        var _this = jarallaxList[k];
                        _this.coverImage();
                        _this.clipContainer();
                        _this.onScroll();
                    }
                });
            }, 100);
        });
    }());

    var oldJarallax = $.fn.jarallax;

    $.fn.jarallax = function() {
        var items = this,
            options = arguments[0],
            args = Array.prototype.slice.call(arguments, 1),
            len = items.length,
            k = 0,
            ret;

        for (k; k < len; k++) {
            if (typeof options === 'object' || typeof options === 'undefined') {
                if(!items[k].jarallax) {
                    items[k].jarallax = new Jarallax(items[k], options);
                }
            }
            else {
                ret = items[k].jarallax ? items[k].jarallax[options].apply(items[k].jarallax, args) : undefined;
            }
            if (typeof ret !== 'undefined') {
                return ret;
            }
        }

        return this;
    };

    // no conflict
    $.fn.jarallax.noConflict = function () {
        $.fn.jarallax = oldJarallax;
        return this;
    };

    // data-jarallax initialization
    $(document).on('ready.data-jarallax', function () {
        $('[data-jarallax]').jarallax();
    });
}));


 /* !- Tooltip*/  
 function simple_tooltip(e,t){jQuery(e).each(function(e){jQuery("body").append("<div class='"+t+"' id='"+t+e+"'>"+jQuery(this).find("span.tooltip-c").html()+"</div>");var n=jQuery("#"+t+e);jQuery(this).removeAttr("title").mouseover(function(){n.css({opacity:1,display:"none"}).fadeIn(400)}).mousemove(function(e){var t=jQuery(window).scrollTop();var r=jQuery(window).width();var i;var s;var o=15;if(r-o*2>=n.width()+e.pageX){i=e.pageX+o}else{i=r-n.width()-o}if(t+o*2>=e.pageY-n.height()){s=t+o}else{s=e.pageY-n.height()-2.2*o}n.css({left:i,top:s})}).mouseout(function(){n.css({left:"-9999px"})})})}
 

/*
== malihu jquery custom scrollbar plugin == 
Version: 3.0.9 
Plugin URI: http://manos.malihu.gr/jquery-custom-content-scroller 
Author: malihu
Author URI: http://manos.malihu.gr
License: MIT License (MIT)
*/

/*
Copyright 2010 Manos Malihutsakis (email: manos@malihu.gr)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

/*
The code below is fairly long, fully commented and should be normally used in development. 
For production, use either the minified jquery.mCustomScrollbar.min.js script or 
the production-ready jquery.mCustomScrollbar.concat.min.js which contains the plugin 
and dependencies (minified). 
*/

(function(factory){
	if(typeof module!=="undefined" && module.exports){
		module.exports=factory;
	}else{
		factory(jQuery,window,document);
	}
}(function($){
(function(init){
	var _rjs=typeof define==="function" && define.amd, /* RequireJS */
		_njs=typeof module !== "undefined" && module.exports, /* NodeJS */
		_dlp=("https:"==document.location.protocol) ? "https:" : "http:", /* location protocol */
		_url= dtLocal.themeUrl + "/js/atoms/plugins/jquery.mousewheel.min.js";
		
	if(!_rjs){
		if(_njs){
			require("jquery-mousewheel")($);
		}else{
			/* load jquery-mousewheel plugin (via CDN) if it's not present or not loaded via RequireJS 
			(works when mCustomScrollbar fn is called on window load) */
			$.event.special.mousewheel || $("head").append(decodeURI("%3Cscript src="+_url+"%3E%3C/script%3E"));
		}
	}
	init();
}(function(){
	
	/* 
	----------------------------------------
	PLUGIN NAMESPACE, PREFIX, DEFAULT SELECTOR(S) 
	----------------------------------------
	*/
	
	var pluginNS="mCustomScrollbar",
		pluginPfx="mCS",
		defaultSelector=".mCustomScrollbar",
	
	
		
	
	
	/* 
	----------------------------------------
	DEFAULT OPTIONS 
	----------------------------------------
	*/
	
		defaults={
			/*
			set element/content width/height programmatically 
			values: boolean, pixels, percentage 
				option						default
				-------------------------------------
				setWidth					false
				setHeight					false
			*/
			/*
			set the initial css top property of content  
			values: string (e.g. "-100px", "10%" etc.)
			*/
			setTop:0,
			/*
			set the initial css left property of content  
			values: string (e.g. "-100px", "10%" etc.)
			*/
			setLeft:0,
			/* 
			scrollbar axis (vertical and/or horizontal scrollbars) 
			values (string): "y", "x", "yx"
			*/
			axis:"y",
			/*
			position of scrollbar relative to content  
			values (string): "inside", "outside" ("outside" requires elements with position:relative)
			*/
			scrollbarPosition:"inside",
			/*
			scrolling inertia
			values: integer (milliseconds)
			*/
			scrollInertia:950,
			/* 
			auto-adjust scrollbar dragger length
			values: boolean
			*/
			autoDraggerLength:true,
			/*
			auto-hide scrollbar when idle 
			values: boolean
				option						default
				-------------------------------------
				autoHideScrollbar			false
			*/
			/*
			auto-expands scrollbar on mouse-over and dragging
			values: boolean
				option						default
				-------------------------------------
				autoExpandScrollbar			false
			*/
			/*
			always show scrollbar, even when there's nothing to scroll 
			values: integer (0=disable, 1=always show dragger rail and buttons, 2=always show dragger rail, dragger and buttons), boolean
			*/
			alwaysShowScrollbar:0,
			/*
			scrolling always snaps to a multiple of this number in pixels
			values: integer
				option						default
				-------------------------------------
				snapAmount					null
			*/
			/*
			when snapping, snap with this number in pixels as an offset 
			values: integer
			*/
			snapOffset:0,
			/* 
			mouse-wheel scrolling
			*/
			mouseWheel:{
				/* 
				enable mouse-wheel scrolling
				values: boolean
				*/
				enable:true,
				/* 
				scrolling amount in pixels
				values: "auto", integer 
				*/
				scrollAmount:"auto",
				/* 
				mouse-wheel scrolling axis 
				the default scrolling direction when both vertical and horizontal scrollbars are present 
				values (string): "y", "x" 
				*/
				axis:"y",
				/* 
				prevent the default behaviour which automatically scrolls the parent element(s) when end of scrolling is reached 
				values: boolean
					option						default
					-------------------------------------
					preventDefault				null
				*/
				/*
				the reported mouse-wheel delta value. The number of lines (translated to pixels) one wheel notch scrolls.  
				values: "auto", integer 
				"auto" uses the default OS/browser value 
				*/
				deltaFactor:"auto",
				/*
				normalize mouse-wheel delta to -1 or 1 (disables mouse-wheel acceleration) 
				values: boolean
					option						default
					-------------------------------------
					normalizeDelta				null
				*/
				/*
				invert mouse-wheel scrolling direction 
				values: boolean
					option						default
					-------------------------------------
					invert						null
				*/
				/*
				the tags that disable mouse-wheel when cursor is over them
				*/
				disableOver:["select","option","keygen","datalist","textarea"]
			},
			/* 
			scrollbar buttons
			*/
			scrollButtons:{ 
				/*
				enable scrollbar buttons
				values: boolean
					option						default
					-------------------------------------
					enable						null
				*/
				/*
				scrollbar buttons scrolling type 
				values (string): "stepless", "stepped"
				*/
				scrollType:"stepless",
				/*
				scrolling amount in pixels
				values: "auto", integer 
				*/
				scrollAmount:"auto"
				/*
				tabindex of the scrollbar buttons
				values: false, integer
					option						default
					-------------------------------------
					tabindex					null
				*/
			},
			/* 
			keyboard scrolling
			*/
			keyboard:{ 
				/*
				enable scrolling via keyboard
				values: boolean
				*/
				enable:true,
				/*
				keyboard scrolling type 
				values (string): "stepless", "stepped"
				*/
				scrollType:"stepless",
				/*
				scrolling amount in pixels
				values: "auto", integer 
				*/
				scrollAmount:"auto"
			},
			/*
			enable content touch-swipe scrolling 
			values: boolean, integer, string (number)
			integer values define the axis-specific minimum amount required for scrolling momentum
			*/
			contentTouchScroll:25,
			/*
			advanced option parameters
			*/
			advanced:{
				/*
				auto-expand content horizontally (for "x" or "yx" axis) 
				values: boolean
					option						default
					-------------------------------------
					autoExpandHorizontalScroll	null
				*/
				/*
				auto-scroll to elements with focus
				*/
				autoScrollOnFocus:"input,textarea,select,button,datalist,keygen,a[tabindex],area,object,[contenteditable='true']",
				/*
				auto-update scrollbars on content, element or viewport resize 
				should be true for fluid layouts/elements, adding/removing content dynamically, hiding/showing elements, content with images etc. 
				values: boolean
				*/
				updateOnContentResize:true,
				/*
				auto-update scrollbars each time each image inside the element is fully loaded 
				values: boolean
				*/
				updateOnImageLoad:true,
				/*
				auto-update scrollbars based on the amount and size changes of specific selectors 
				useful when you need to update the scrollbar(s) automatically, each time a type of element is added, removed or changes its size 
				values: boolean, string (e.g. "ul li" will auto-update scrollbars each time list-items inside the element are changed) 
				a value of true (boolean) will auto-update scrollbars each time any element is changed
					option						default
					-------------------------------------
					updateOnSelectorChange		null
				*/
				/*
				extra selectors that'll release scrollbar dragging upon mouseup, pointerup, touchend etc. (e.g. "selector-1, selector-2")
					option						default
					-------------------------------------
					releaseDraggableSelectors	null
				*/
				/*
				auto-update timeout 
				values: integer (milliseconds)
				*/
				autoUpdateTimeout:60
			},
			/* 
			scrollbar theme 
			values: string (see CSS/plugin URI for a list of ready-to-use themes)
			*/
			theme:"light",
			/*
			user defined callback functions
			*/
			callbacks:{
				/*
				Available callbacks: 
					callback					default
					-------------------------------------
					onInit						null
					onScrollStart				null
					onScroll					null
					onTotalScroll				null
					onTotalScrollBack			null
					whileScrolling				null
					onOverflowY					null
					onOverflowX					null
					onOverflowYNone				null
					onOverflowXNone				null
					onImageLoad					null
					onSelectorChange			null
					onUpdate					null
				*/
				onTotalScrollOffset:0,
				onTotalScrollBackOffset:0,
				alwaysTriggerOffsets:true
			}
			/*
			add scrollbar(s) on all elements matching the current selector, now and in the future 
			values: boolean, string 
			string values: "on" (enable), "once" (disable after first invocation), "off" (disable)
			liveSelector values: string (selector)
				option						default
				-------------------------------------
				live						false
				liveSelector				null
			*/
		},
	
	
	
	
	
	/* 
	----------------------------------------
	VARS, CONSTANTS 
	----------------------------------------
	*/
	
		totalInstances=0, /* plugin instances amount */
		liveTimers={}, /* live option timers */
		oldIE=(window.attachEvent && !window.addEventListener) ? 1 : 0, /* detect IE < 9 */
		touchActive=false,touchable, /* global touch vars (for touch and pointer events) */
		/* general plugin classes */
		classes=[
			"mCSB_dragger_onDrag","mCSB_scrollTools_onDrag","mCS_img_loaded","mCS_disabled","mCS_destroyed","mCS_no_scrollbar",
			"mCS-autoHide","mCS-dir-rtl","mCS_no_scrollbar_y","mCS_no_scrollbar_x","mCS_y_hidden","mCS_x_hidden","mCSB_draggerContainer",
			"mCSB_buttonUp","mCSB_buttonDown","mCSB_buttonLeft","mCSB_buttonRight"
		],
		
	
	
	
	
	/* 
	----------------------------------------
	METHODS 
	----------------------------------------
	*/
	
		methods={
			
			/* 
			plugin initialization method 
			creates the scrollbar(s), plugin data object and options
			----------------------------------------
			*/
			
			init:function(options){
				
				var options=$.extend(true,{},defaults,options),
					selector=_selector.call(this); /* validate selector */
				
				/* 
				if live option is enabled, monitor for elements matching the current selector and 
				apply scrollbar(s) when found (now and in the future) 
				*/
				if(options.live){
					var liveSelector=options.liveSelector || this.selector || defaultSelector, /* live selector(s) */
						$liveSelector=$(liveSelector); /* live selector(s) as jquery object */
					if(options.live==="off"){
						/* 
						disable live if requested 
						usage: $(selector).mCustomScrollbar({live:"off"}); 
						*/
						removeLiveTimers(liveSelector);
						return;
					}
					liveTimers[liveSelector]=setTimeout(function(){
						/* call mCustomScrollbar fn on live selector(s) every half-second */
						$liveSelector.mCustomScrollbar(options);
						if(options.live==="once" && $liveSelector.length){
							/* disable live after first invocation */
							removeLiveTimers(liveSelector);
						}
					},500);
				}else{
					removeLiveTimers(liveSelector);
				}
				
				/* options backward compatibility (for versions < 3.0.0) and normalization */
				options.setWidth=(options.set_width) ? options.set_width : options.setWidth;
				options.setHeight=(options.set_height) ? options.set_height : options.setHeight;
				options.axis=(options.horizontalScroll) ? "x" : _findAxis(options.axis);
				options.scrollInertia=options.scrollInertia>0 && options.scrollInertia<17 ? 17 : options.scrollInertia;
				if(typeof options.mouseWheel!=="object" &&  options.mouseWheel==true){ /* old school mouseWheel option (non-object) */
					options.mouseWheel={enable:true,scrollAmount:"auto",axis:"y",preventDefault:false,deltaFactor:"auto",normalizeDelta:false,invert:false}
				}
				options.mouseWheel.scrollAmount=!options.mouseWheelPixels ? options.mouseWheel.scrollAmount : options.mouseWheelPixels;
				options.mouseWheel.normalizeDelta=!options.advanced.normalizeMouseWheelDelta ? options.mouseWheel.normalizeDelta : options.advanced.normalizeMouseWheelDelta;
				options.scrollButtons.scrollType=_findScrollButtonsType(options.scrollButtons.scrollType); 
				
				_theme(options); /* theme-specific options */
				
				/* plugin constructor */
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if(!$this.data(pluginPfx)){ /* prevent multiple instantiations */
					
						/* store options and create objects in jquery data */
						$this.data(pluginPfx,{
							idx:++totalInstances, /* instance index */
							opt:options, /* options */
							scrollRatio:{y:null,x:null}, /* scrollbar to content ratio */
							overflowed:null, /* overflowed axis */
							contentReset:{y:null,x:null}, /* object to check when content resets */
							bindEvents:false, /* object to check if events are bound */
							tweenRunning:false, /* object to check if tween is running */
							sequential:{}, /* sequential scrolling object */
							langDir:$this.css("direction"), /* detect/store direction (ltr or rtl) */
							cbOffsets:null, /* object to check whether callback offsets always trigger */
							/* 
							object to check how scrolling events where last triggered 
							"internal" (default - triggered by this script), "external" (triggered by other scripts, e.g. via scrollTo method) 
							usage: object.data("mCS").trigger
							*/
							trigger:null
						});
						
						var d=$this.data(pluginPfx),o=d.opt,
							/* HTML data attributes */
							htmlDataAxis=$this.data("mcs-axis"),htmlDataSbPos=$this.data("mcs-scrollbar-position"),htmlDataTheme=$this.data("mcs-theme");
						 
						if(htmlDataAxis){o.axis=htmlDataAxis;} /* usage example: data-mcs-axis="y" */
						if(htmlDataSbPos){o.scrollbarPosition=htmlDataSbPos;} /* usage example: data-mcs-scrollbar-position="outside" */
						if(htmlDataTheme){ /* usage example: data-mcs-theme="minimal" */
							o.theme=htmlDataTheme;
							_theme(o); /* theme-specific options */
						}
						
						_pluginMarkup.call(this); /* add plugin markup */
						
						$("#mCSB_"+d.idx+"_container img:not(."+classes[2]+")").addClass(classes[2]); /* flag loaded images */
						
						methods.update.call(null,$this); /* call the update method */
					
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/* 
			plugin update method 
			updates content and scrollbar(s) values, events and status 
			----------------------------------------
			usage: $(selector).mCustomScrollbar("update");
			*/
			
			update:function(el,cb){
				
				var selector=el || _selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
						
						var d=$this.data(pluginPfx),o=d.opt,
							mCSB_container=$("#mCSB_"+d.idx+"_container"),
							mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")];
						
						if(!mCSB_container.length){return;}
						
						if(d.tweenRunning){_stop($this);} /* stop any running tweens while updating */
						
						/* if element was disabled or destroyed, remove class(es) */
						if($this.hasClass(classes[3])){$this.removeClass(classes[3]);}
						if($this.hasClass(classes[4])){$this.removeClass(classes[4]);}
						
						_maxHeight.call(this); /* detect/set css max-height value */
						
						_expandContentHorizontally.call(this); /* expand content horizontally */
						
						if(o.axis!=="y" && !o.advanced.autoExpandHorizontalScroll){
							mCSB_container.css("width",_contentWidth(mCSB_container.children()));
						}
						
						d.overflowed=_overflowed.call(this); /* determine if scrolling is required */
						
						_scrollbarVisibility.call(this); /* show/hide scrollbar(s) */
						
						/* auto-adjust scrollbar dragger length analogous to content */
						if(o.autoDraggerLength){_setDraggerLength.call(this);}
						
						_scrollRatio.call(this); /* calculate and store scrollbar to content ratio */
						
						_bindEvents.call(this); /* bind scrollbar events */
						
						/* reset scrolling position and/or events */
						var to=[Math.abs(mCSB_container[0].offsetTop),Math.abs(mCSB_container[0].offsetLeft)];
						if(o.axis!=="x"){ /* y/yx axis */
							if(!d.overflowed[0]){ /* y scrolling is not required */
								_resetContentPosition.call(this); /* reset content position */
								if(o.axis==="y"){
									_unbindEvents.call(this);
								}else if(o.axis==="yx" && d.overflowed[1]){
									_scrollTo($this,to[1].toString(),{dir:"x",dur:0,overwrite:"none"});
								}
							}else if(mCSB_dragger[0].height()>mCSB_dragger[0].parent().height()){
								_resetContentPosition.call(this); /* reset content position */
							}else{ /* y scrolling is required */
								_scrollTo($this,to[0].toString(),{dir:"y",dur:0,overwrite:"none"});
								d.contentReset.y=null;
							}
						}
						if(o.axis!=="y"){ /* x/yx axis */
							if(!d.overflowed[1]){ /* x scrolling is not required */
								_resetContentPosition.call(this); /* reset content position */
								if(o.axis==="x"){
									_unbindEvents.call(this);
								}else if(o.axis==="yx" && d.overflowed[0]){
									_scrollTo($this,to[0].toString(),{dir:"y",dur:0,overwrite:"none"});
								}
							}else if(mCSB_dragger[1].width()>mCSB_dragger[1].parent().width()){
								_resetContentPosition.call(this); /* reset content position */
							}else{ /* x scrolling is required */
								_scrollTo($this,to[1].toString(),{dir:"x",dur:0,overwrite:"none"});
								d.contentReset.x=null;
							}
						}
						
						/* callbacks: onImageLoad, onSelectorChange, onUpdate */
						if(cb && d){
							if(cb===2 && o.callbacks.onImageLoad && typeof o.callbacks.onImageLoad==="function"){
								o.callbacks.onImageLoad.call(this);
							}else if(cb===3 && o.callbacks.onSelectorChange && typeof o.callbacks.onSelectorChange==="function"){
								o.callbacks.onSelectorChange.call(this);
							}else if(o.callbacks.onUpdate && typeof o.callbacks.onUpdate==="function"){
								o.callbacks.onUpdate.call(this);
							}
						}
						
						_autoUpdate.call(this); /* initialize automatic updating (for dynamic content, fluid layouts etc.) */
						
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/* 
			plugin scrollTo method 
			triggers a scrolling event to a specific value
			----------------------------------------
			usage: $(selector).mCustomScrollbar("scrollTo",value,options);
			*/
		
			scrollTo:function(val,options){
				
				/* prevent silly things like $(selector).mCustomScrollbar("scrollTo",undefined); */
				if(typeof val=="undefined" || val==null){return;}
				
				var selector=_selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
					
						var d=$this.data(pluginPfx),o=d.opt,
							/* method default options */
							methodDefaults={
								trigger:"external", /* method is by default triggered externally (e.g. from other scripts) */
								scrollInertia:o.scrollInertia, /* scrolling inertia (animation duration) */
								scrollEasing:"mcsEaseInOut", /* animation easing */
								moveDragger:false, /* move dragger instead of content */
								timeout:60, /* scroll-to delay */
								callbacks:true, /* enable/disable callbacks */
								onStart:true,
								onUpdate:true,
								onComplete:true
							},
							methodOptions=$.extend(true,{},methodDefaults,options),
							to=_arr.call(this,val),dur=methodOptions.scrollInertia>0 && methodOptions.scrollInertia<17 ? 17 : methodOptions.scrollInertia;
						
						/* translate yx values to actual scroll-to positions */
						to[0]=_to.call(this,to[0],"y");
						to[1]=_to.call(this,to[1],"x");
						
						/* 
						check if scroll-to value moves the dragger instead of content. 
						Only pixel values apply on dragger (e.g. 100, "100px", "-=100" etc.) 
						*/
						if(methodOptions.moveDragger){
							to[0]*=d.scrollRatio.y;
							to[1]*=d.scrollRatio.x;
						}
						
						methodOptions.dur=dur;
						
						setTimeout(function(){ 
							/* do the scrolling */
							if(to[0]!==null && typeof to[0]!=="undefined" && o.axis!=="x" && d.overflowed[0]){ /* scroll y */
								methodOptions.dir="y";
								methodOptions.overwrite="all";
								_scrollTo($this,to[0].toString(),methodOptions);
							}
							if(to[1]!==null && typeof to[1]!=="undefined" && o.axis!=="y" && d.overflowed[1]){ /* scroll x */
								methodOptions.dir="x";
								methodOptions.overwrite="none";
								_scrollTo($this,to[1].toString(),methodOptions);
							}
						},methodOptions.timeout);
						
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/*
			plugin stop method 
			stops scrolling animation
			----------------------------------------
			usage: $(selector).mCustomScrollbar("stop");
			*/
			stop:function(){
				
				var selector=_selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
										
						_stop($this);
					
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/*
			plugin disable method 
			temporarily disables the scrollbar(s) 
			----------------------------------------
			usage: $(selector).mCustomScrollbar("disable",reset); 
			reset (boolean): resets content position to 0 
			*/
			disable:function(r){
				
				var selector=_selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
						
						var d=$this.data(pluginPfx);
						
						_autoUpdate.call(this,"remove"); /* remove automatic updating */
						
						_unbindEvents.call(this); /* unbind events */
						
						if(r){_resetContentPosition.call(this);} /* reset content position */
						
						_scrollbarVisibility.call(this,true); /* show/hide scrollbar(s) */
						
						$this.addClass(classes[3]); /* add disable class */
					
					}
					
				});
				
			},
			/* ---------------------------------------- */
			
			
			
			/*
			plugin destroy method 
			completely removes the scrollbar(s) and returns the element to its original state
			----------------------------------------
			usage: $(selector).mCustomScrollbar("destroy"); 
			*/
			destroy:function(){
				
				var selector=_selector.call(this); /* validate selector */
				
				return $(selector).each(function(){
					
					var $this=$(this);
					
					if($this.data(pluginPfx)){ /* check if plugin has initialized */
					
						var d=$this.data(pluginPfx),o=d.opt,
							mCustomScrollBox=$("#mCSB_"+d.idx),
							mCSB_container=$("#mCSB_"+d.idx+"_container"),
							scrollbar=$(".mCSB_"+d.idx+"_scrollbar");
					
						if(o.live){removeLiveTimers(o.liveSelector || $(selector).selector);} /* remove live timers */
						
						_autoUpdate.call(this,"remove"); /* remove automatic updating */
						
						_unbindEvents.call(this); /* unbind events */
						
						_resetContentPosition.call(this); /* reset content position */
						
						$this.removeData(pluginPfx); /* remove plugin data object */
						
						_delete(this,"mcs"); /* delete callbacks object */
						
						/* remove plugin markup */
						scrollbar.remove(); /* remove scrollbar(s) first (those can be either inside or outside plugin's inner wrapper) */
						mCSB_container.find("img."+classes[2]).removeClass(classes[2]); /* remove loaded images flag */
						mCustomScrollBox.replaceWith(mCSB_container.contents()); /* replace plugin's inner wrapper with the original content */
						/* remove plugin classes from the element and add destroy class */
						$this.removeClass(pluginNS+" _"+pluginPfx+"_"+d.idx+" "+classes[6]+" "+classes[7]+" "+classes[5]+" "+classes[3]).addClass(classes[4]);
					
					}
					
				});
				
			}
			/* ---------------------------------------- */
			
		},
	
	
	
	
		
	/* 
	----------------------------------------
	FUNCTIONS
	----------------------------------------
	*/
	
		/* validates selector (if selector is invalid or undefined uses the default one) */
		_selector=function(){
			return (typeof $(this)!=="object" || $(this).length<1) ? defaultSelector : this;
		},
		/* -------------------- */
		
		
		/* changes options according to theme */
		_theme=function(obj){
			var fixedSizeScrollbarThemes=["rounded","rounded-dark","rounded-dots","rounded-dots-dark"],
				nonExpandedScrollbarThemes=["rounded-dots","rounded-dots-dark","3d","3d-dark","3d-thick","3d-thick-dark","inset","inset-dark","inset-2","inset-2-dark","inset-3","inset-3-dark"],
				disabledScrollButtonsThemes=["minimal","minimal-dark"],
				enabledAutoHideScrollbarThemes=["minimal","minimal-dark"],
				scrollbarPositionOutsideThemes=["minimal","minimal-dark"];
			obj.autoDraggerLength=$.inArray(obj.theme,fixedSizeScrollbarThemes) > -1 ? false : obj.autoDraggerLength;
			obj.autoExpandScrollbar=$.inArray(obj.theme,nonExpandedScrollbarThemes) > -1 ? false : obj.autoExpandScrollbar;
			obj.scrollButtons.enable=$.inArray(obj.theme,disabledScrollButtonsThemes) > -1 ? false : obj.scrollButtons.enable;
			obj.autoHideScrollbar=$.inArray(obj.theme,enabledAutoHideScrollbarThemes) > -1 ? true : obj.autoHideScrollbar;
			obj.scrollbarPosition=$.inArray(obj.theme,scrollbarPositionOutsideThemes) > -1 ? "outside" : obj.scrollbarPosition;
		},
		/* -------------------- */
		
		
		/* live option timers removal */
		removeLiveTimers=function(selector){
			if(liveTimers[selector]){
				clearTimeout(liveTimers[selector]);
				_delete(liveTimers,selector);
			}
		},
		/* -------------------- */
		
		
		/* normalizes axis option to valid values: "y", "x", "yx" */
		_findAxis=function(val){
			return (val==="yx" || val==="xy" || val==="auto") ? "yx" : (val==="x" || val==="horizontal") ? "x" : "y";
		},
		/* -------------------- */
		
		
		/* normalizes scrollButtons.scrollType option to valid values: "stepless", "stepped" */
		_findScrollButtonsType=function(val){
			return (val==="stepped" || val==="pixels" || val==="step" || val==="click") ? "stepped" : "stepless";
		},
		/* -------------------- */
		
		
		/* generates plugin markup */
		_pluginMarkup=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				expandClass=o.autoExpandScrollbar ? " "+classes[1]+"_expand" : "",
				scrollbar=["<div id='mCSB_"+d.idx+"_scrollbar_vertical' class='mCSB_scrollTools mCSB_"+d.idx+"_scrollbar mCS-"+o.theme+" mCSB_scrollTools_vertical"+expandClass+"'><div class='"+classes[12]+"'><div id='mCSB_"+d.idx+"_dragger_vertical' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>","<div id='mCSB_"+d.idx+"_scrollbar_horizontal' class='mCSB_scrollTools mCSB_"+d.idx+"_scrollbar mCS-"+o.theme+" mCSB_scrollTools_horizontal"+expandClass+"'><div class='"+classes[12]+"'><div id='mCSB_"+d.idx+"_dragger_horizontal' class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' /></div><div class='mCSB_draggerRail' /></div></div>"],
				wrapperClass=o.axis==="yx" ? "mCSB_vertical_horizontal" : o.axis==="x" ? "mCSB_horizontal" : "mCSB_vertical",
				scrollbars=o.axis==="yx" ? scrollbar[0]+scrollbar[1] : o.axis==="x" ? scrollbar[1] : scrollbar[0],
				contentWrapper=o.axis==="yx" ? "<div id='mCSB_"+d.idx+"_container_wrapper' class='mCSB_container_wrapper' />" : "",
				autoHideClass=o.autoHideScrollbar ? " "+classes[6] : "",
				scrollbarDirClass=(o.axis!=="x" && d.langDir==="rtl") ? " "+classes[7] : "";
			if(o.setWidth){$this.css("width",o.setWidth);} /* set element width */
			if(o.setHeight){$this.css("height",o.setHeight);} /* set element height */
			o.setLeft=(o.axis!=="y" && d.langDir==="rtl") ? "989999px" : o.setLeft; /* adjust left position for rtl direction */
			$this.addClass(pluginNS+" _"+pluginPfx+"_"+d.idx+autoHideClass+scrollbarDirClass).wrapInner("<div id='mCSB_"+d.idx+"' class='mCustomScrollBox mCS-"+o.theme+" "+wrapperClass+"'><div id='mCSB_"+d.idx+"_container' class='mCSB_container' style='position:relative; top:"+o.setTop+"; left:"+o.setLeft+";' dir="+d.langDir+" /></div>");
			var mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container");
			if(o.axis!=="y" && !o.advanced.autoExpandHorizontalScroll){
				mCSB_container.css("width",_contentWidth(mCSB_container.children()));
			}
			if(o.scrollbarPosition==="outside"){
				if($this.css("position")==="static"){ /* requires elements with non-static position */
					$this.css("position","relative");
				}
				$this.css("overflow","visible");
				mCustomScrollBox.addClass("mCSB_outside").after(scrollbars);
			}else{
				mCustomScrollBox.addClass("mCSB_inside").append(scrollbars);
				mCSB_container.wrap(contentWrapper);
			}
			_scrollButtons.call(this); /* add scrollbar buttons */
			/* minimum dragger length */
			var mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")];
			mCSB_dragger[0].css("min-height",mCSB_dragger[0].height());
			mCSB_dragger[1].css("min-width",mCSB_dragger[1].width());
		},
		/* -------------------- */
		
		
		/* calculates content width */
		_contentWidth=function(el){
			return Math.max.apply(Math,el.map(function(){return $(this).outerWidth(true);}).get());
		},
		/* -------------------- */
		
		
		/* expands content horizontally */
		_expandContentHorizontally=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCSB_container=$("#mCSB_"+d.idx+"_container");
			if(o.advanced.autoExpandHorizontalScroll && o.axis!=="y"){
				/* 
				wrap content with an infinite width div and set its position to absolute and width to auto. 
				Setting width to auto before calculating the actual width is important! 
				We must let the browser set the width as browser zoom values are impossible to calculate.
				*/
				mCSB_container.css({"position":"absolute","width":"auto"})
					.wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />")
					.css({ /* set actual width, original position and un-wrap */
						/* 
						get the exact width (with decimals) and then round-up. 
						Using jquery outerWidth() will round the width value which will mess up with inner elements that have non-integer width
						*/
						"width":(Math.ceil(mCSB_container[0].getBoundingClientRect().right+0.4)-Math.floor(mCSB_container[0].getBoundingClientRect().left)),
						"position":"relative"
					}).unwrap();
			}
		},
		/* -------------------- */
		
		
		/* adds scrollbar buttons */
		_scrollButtons=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCSB_scrollTools=$(".mCSB_"+d.idx+"_scrollbar:first"),
				tabindex=!_isNumeric(o.scrollButtons.tabindex) ? "" : "tabindex='"+o.scrollButtons.tabindex+"'",
				btnHTML=[
					"<a href='#' class='"+classes[13]+"' oncontextmenu='return false;' "+tabindex+" />",
					"<a href='#' class='"+classes[14]+"' oncontextmenu='return false;' "+tabindex+" />",
					"<a href='#' class='"+classes[15]+"' oncontextmenu='return false;' "+tabindex+" />",
					"<a href='#' class='"+classes[16]+"' oncontextmenu='return false;' "+tabindex+" />"
				],
				btn=[(o.axis==="x" ? btnHTML[2] : btnHTML[0]),(o.axis==="x" ? btnHTML[3] : btnHTML[1]),btnHTML[2],btnHTML[3]];
			if(o.scrollButtons.enable){
				mCSB_scrollTools.prepend(btn[0]).append(btn[1]).next(".mCSB_scrollTools").prepend(btn[2]).append(btn[3]);
			}
		},
		/* -------------------- */
		
		
		/* detects/sets css max-height value */
		_maxHeight=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mh=$this.css("max-height") || "none",pct=mh.indexOf("%")!==-1,
				bs=$this.css("box-sizing");
			if(mh!=="none"){
				var val=pct ? $this.parent().height()*parseInt(mh)/100 : parseInt(mh);
				/* if element's css box-sizing is "border-box", subtract any paddings and/or borders from max-height value */
				if(bs==="border-box"){val-=(($this.innerHeight()-$this.height())+($this.outerHeight()-$this.innerHeight()));}
				mCustomScrollBox.css("max-height",Math.round(val));
			}
		},
		/* -------------------- */
		
		
		/* auto-adjusts scrollbar dragger length */
		_setDraggerLength=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
				ratio=[mCustomScrollBox.height()/mCSB_container.outerHeight(false),mCustomScrollBox.width()/mCSB_container.outerWidth(false)],
				l=[
					parseInt(mCSB_dragger[0].css("min-height")),Math.round(ratio[0]*mCSB_dragger[0].parent().height()),
					parseInt(mCSB_dragger[1].css("min-width")),Math.round(ratio[1]*mCSB_dragger[1].parent().width())
				],
				h=oldIE && (l[1]<l[0]) ? l[0] : l[1],w=oldIE && (l[3]<l[2]) ? l[2] : l[3];
			mCSB_dragger[0].css({
				"height":h,"max-height":(mCSB_dragger[0].parent().height()-10)
			}).find(".mCSB_dragger_bar").css({"line-height":l[0]+"px"});
			mCSB_dragger[1].css({
				"width":w,"max-width":(mCSB_dragger[1].parent().width()-10)
			});
		},
		/* -------------------- */
		
		
		/* calculates scrollbar to content ratio */
		_scrollRatio=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
				scrollAmount=[mCSB_container.outerHeight(false)-mCustomScrollBox.height(),mCSB_container.outerWidth(false)-mCustomScrollBox.width()],
				ratio=[
					scrollAmount[0]/(mCSB_dragger[0].parent().height()-mCSB_dragger[0].height()),
					scrollAmount[1]/(mCSB_dragger[1].parent().width()-mCSB_dragger[1].width())
				];
			d.scrollRatio={y:ratio[0],x:ratio[1]};
		},
		/* -------------------- */
		
		
		/* toggles scrolling classes */
		_onDragClasses=function(el,action,xpnd){
			var expandClass=xpnd ? classes[0]+"_expanded" : "",
				scrollbar=el.closest(".mCSB_scrollTools");
			if(action==="active"){
				el.toggleClass(classes[0]+" "+expandClass); scrollbar.toggleClass(classes[1]); 
				el[0]._draggable=el[0]._draggable ? 0 : 1;
			}else{
				if(!el[0]._draggable){
					if(action==="hide"){
						el.removeClass(classes[0]); scrollbar.removeClass(classes[1]);
					}else{
						el.addClass(classes[0]); scrollbar.addClass(classes[1]);
					}
				}
			}
		},
		/* -------------------- */
		
		
		/* checks if content overflows its container to determine if scrolling is required */
		_overflowed=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				contentHeight=d.overflowed==null ? mCSB_container.height() : mCSB_container.outerHeight(false),
				contentWidth=d.overflowed==null ? mCSB_container.width() : mCSB_container.outerWidth(false);
			return [contentHeight>mCustomScrollBox.height(),contentWidth>mCustomScrollBox.width()];
		},
		/* -------------------- */
		
		
		/* resets content position to 0 */
		_resetContentPosition=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")];
			_stop($this); /* stop any current scrolling before resetting */
			if((o.axis!=="x" && !d.overflowed[0]) || (o.axis==="y" && d.overflowed[0])){ /* reset y */
				mCSB_dragger[0].add(mCSB_container).css("top",0);
				_scrollTo($this,"_resetY");
			}
			if((o.axis!=="y" && !d.overflowed[1]) || (o.axis==="x" && d.overflowed[1])){ /* reset x */
				var cx=dx=0;
				if(d.langDir==="rtl"){ /* adjust left position for rtl direction */
					cx=mCustomScrollBox.width()-mCSB_container.outerWidth(false);
					dx=Math.abs(cx/d.scrollRatio.x);
				}
				mCSB_container.css("left",cx);
				mCSB_dragger[1].css("left",dx);
				_scrollTo($this,"_resetX");
			}
		},
		/* -------------------- */
		
		
		/* binds scrollbar events */
		_bindEvents=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt;
			if(!d.bindEvents){ /* check if events are already bound */
				_draggable.call(this);
				if(o.contentTouchScroll){_contentDraggable.call(this);}
				_selectable.call(this);
				if(o.mouseWheel.enable){ /* bind mousewheel fn when plugin is available */
					function _mwt(){
						mousewheelTimeout=setTimeout(function(){
							if(!$.event.special.mousewheel){
								_mwt();
							}else{
								clearTimeout(mousewheelTimeout);
								_mousewheel.call($this[0]);
							}
						},100);
					}
					var mousewheelTimeout;
					_mwt();
				}
				_draggerRail.call(this);
				_wrapperScroll.call(this);
				if(o.advanced.autoScrollOnFocus){_focus.call(this);}
				if(o.scrollButtons.enable){_buttons.call(this);}
				if(o.keyboard.enable){_keyboard.call(this);}
				d.bindEvents=true;
			}
		},
		/* -------------------- */
		
		
		/* unbinds scrollbar events */
		_unbindEvents=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				sb=".mCSB_"+d.idx+"_scrollbar",
				sel=$("#mCSB_"+d.idx+",#mCSB_"+d.idx+"_container,#mCSB_"+d.idx+"_container_wrapper,"+sb+" ."+classes[12]+",#mCSB_"+d.idx+"_dragger_vertical,#mCSB_"+d.idx+"_dragger_horizontal,"+sb+">a"),
				mCSB_container=$("#mCSB_"+d.idx+"_container");
			if(o.advanced.releaseDraggableSelectors){sel.add($(o.advanced.releaseDraggableSelectors));}
			if(d.bindEvents){ /* check if events are bound */
				/* unbind namespaced events from document/selectors */
				$(document).unbind("."+namespace);
				sel.each(function(){
					$(this).unbind("."+namespace);
				});
				/* clear and delete timeouts/objects */
				clearTimeout($this[0]._focusTimeout); _delete($this[0],"_focusTimeout");
				clearTimeout(d.sequential.step); _delete(d.sequential,"step");
				clearTimeout(mCSB_container[0].onCompleteTimeout); _delete(mCSB_container[0],"onCompleteTimeout");
				d.bindEvents=false;
			}
		},
		/* -------------------- */
		
		
		/* toggles scrollbar visibility */
		_scrollbarVisibility=function(disabled){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				contentWrapper=$("#mCSB_"+d.idx+"_container_wrapper"),
				content=contentWrapper.length ? contentWrapper : $("#mCSB_"+d.idx+"_container"),
				scrollbar=[$("#mCSB_"+d.idx+"_scrollbar_vertical"),$("#mCSB_"+d.idx+"_scrollbar_horizontal")],
				mCSB_dragger=[scrollbar[0].find(".mCSB_dragger"),scrollbar[1].find(".mCSB_dragger")];
			if(o.axis!=="x"){
				if(d.overflowed[0] && !disabled){
					scrollbar[0].add(mCSB_dragger[0]).add(scrollbar[0].children("a")).css("display","block");
					content.removeClass(classes[8]+" "+classes[10]);
				}else{
					if(o.alwaysShowScrollbar){
						if(o.alwaysShowScrollbar!==2){mCSB_dragger[0].css("display","none");}
						content.removeClass(classes[10]);
					}else{
						scrollbar[0].css("display","none");
						content.addClass(classes[10]);
					}
					content.addClass(classes[8]);
				}
			}
			if(o.axis!=="y"){
				if(d.overflowed[1] && !disabled){
					scrollbar[1].add(mCSB_dragger[1]).add(scrollbar[1].children("a")).css("display","block");
					content.removeClass(classes[9]+" "+classes[11]);
				}else{
					if(o.alwaysShowScrollbar){
						if(o.alwaysShowScrollbar!==2){mCSB_dragger[1].css("display","none");}
						content.removeClass(classes[11]);
					}else{
						scrollbar[1].css("display","none");
						content.addClass(classes[11]);
					}
					content.addClass(classes[9]);
				}
			}
			if(!d.overflowed[0] && !d.overflowed[1]){
				$this.addClass(classes[5]);
			}else{
				$this.removeClass(classes[5]);
			}
		},
		/* -------------------- */
		
		
		/* returns input coordinates of pointer, touch and mouse events (relative to document) */
		_coordinates=function(e){
			var t=e.type;
			switch(t){
				case "pointerdown": case "MSPointerDown": case "pointermove": case "MSPointerMove": case "pointerup": case "MSPointerUp":
					return e.target.ownerDocument!==document ? [e.originalEvent.screenY,e.originalEvent.screenX,false] : [e.originalEvent.pageY,e.originalEvent.pageX,false];
					break;
				case "touchstart": case "touchmove": case "touchend":
					var touch=e.originalEvent.touches[0] || e.originalEvent.changedTouches[0],
						touches=e.originalEvent.touches.length || e.originalEvent.changedTouches.length;
					return e.target.ownerDocument!==document ? [touch.screenY,touch.screenX,touches>1] : [touch.pageY,touch.pageX,touches>1];
					break;
				default:
					return [e.pageY,e.pageX,false];
			}
		},
		/* -------------------- */
		
		
		/* 
		SCROLLBAR DRAG EVENTS
		scrolls content via scrollbar dragging 
		*/
		_draggable=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				draggerId=["mCSB_"+d.idx+"_dragger_vertical","mCSB_"+d.idx+"_dragger_horizontal"],
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=$("#"+draggerId[0]+",#"+draggerId[1]),
				draggable,dragY,dragX,
				rds=o.advanced.releaseDraggableSelectors ? mCSB_dragger.add($(o.advanced.releaseDraggableSelectors)) : mCSB_dragger;
			mCSB_dragger.bind("mousedown."+namespace+" touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace,function(e){
				e.stopImmediatePropagation();
				e.preventDefault();
				if(!_mouseBtnLeft(e)){return;} /* left mouse button only */
				touchActive=true;
				if(oldIE){document.onselectstart=function(){return false;}} /* disable text selection for IE < 9 */
				_iframe(false); /* enable scrollbar dragging over iframes by disabling their events */
				_stop($this);
				draggable=$(this);
				var offset=draggable.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left,
					h=draggable.height()+offset.top,w=draggable.width()+offset.left;
				if(y<h && y>0 && x<w && x>0){
					dragY=y; 
					dragX=x;
				}
				_onDragClasses(draggable,"active",o.autoExpandScrollbar); 
			}).bind("touchmove."+namespace,function(e){
				e.stopImmediatePropagation();
				e.preventDefault();
				var offset=draggable.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left;
				_drag(dragY,dragX,y,x);
			});
			$(document).bind("mousemove."+namespace+" pointermove."+namespace+" MSPointerMove."+namespace,function(e){
				if(draggable){
					var offset=draggable.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left;
					if(dragY===y){return;} /* has it really moved? */
					_drag(dragY,dragX,y,x);
				}
			}).add(rds).bind("mouseup."+namespace+" touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace,function(e){
				if(draggable){
					_onDragClasses(draggable,"active",o.autoExpandScrollbar); 
					draggable=null;
				}
				touchActive=false;
				if(oldIE){document.onselectstart=null;} /* enable text selection for IE < 9 */
				_iframe(true); /* enable iframes events */
			});
			function _iframe(evt){
				var el=mCSB_container.find("iframe");
				if(!el.length){return;} /* check if content contains iframes */
				var val=!evt ? "none" : "auto";
				el.css("pointer-events",val); /* for IE11, iframe's display property should not be "block" */
			}
			function _drag(dragY,dragX,y,x){
				mCSB_container[0].idleTimer=o.scrollInertia<233 ? 250 : 0;
				if(draggable.attr("id")===draggerId[1]){
					var dir="x",to=((draggable[0].offsetLeft-dragX)+x)*d.scrollRatio.x;
				}else{
					var dir="y",to=((draggable[0].offsetTop-dragY)+y)*d.scrollRatio.y;
				}
				_scrollTo($this,to.toString(),{dir:dir,drag:true});
			}
		},
		/* -------------------- */
		
		
		/* 
		TOUCH SWIPE EVENTS
		scrolls content via touch swipe 
		Emulates the native touch-swipe scrolling with momentum found in iOS, Android and WP devices 
		*/
		_contentDraggable=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
				dragY,dragX,touchStartY,touchStartX,touchMoveY=[],touchMoveX=[],startTime,runningTime,endTime,distance,speed,amount,
				durA=0,durB,overwrite=o.axis==="yx" ? "none" : "all",touchIntent=[],touchDrag,docDrag,
				iframe=mCSB_container.find("iframe"),
				events=[
					"touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace, //start
					"touchmove."+namespace+" pointermove."+namespace+" MSPointerMove."+namespace, //move
					"touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace //end
				];
			mCSB_container.bind(events[0],function(e){
				_onTouchstart(e);
			}).bind(events[1],function(e){
				_onTouchmove(e);
			});
			mCustomScrollBox.bind(events[0],function(e){
				_onTouchstart2(e);
			}).bind(events[2],function(e){
				_onTouchend(e);
			});
			if(iframe.length){
				iframe.each(function(){
					$(this).load(function(){
						/* bind events on accessible iframes */
						if(_canAccessIFrame(this)){
							$(this.contentDocument || this.contentWindow.document).bind(events[0],function(e){
								_onTouchstart(e);
								_onTouchstart2(e);
							}).bind(events[1],function(e){
								_onTouchmove(e);
							}).bind(events[2],function(e){
								_onTouchend(e);
							});
						}
					});
				});
			}
			function _onTouchstart(e){
				if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){touchable=0; return;}
				touchable=1; touchDrag=0; docDrag=0;
				$this.removeClass("mCS_touch_action");
				var offset=mCSB_container.offset();
				dragY=_coordinates(e)[0]-offset.top;
				dragX=_coordinates(e)[1]-offset.left;
				touchIntent=[_coordinates(e)[0],_coordinates(e)[1]];
			}
			function _onTouchmove(e){
				if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){return;}
				e.stopImmediatePropagation();
				if(docDrag && !touchDrag){return;}
				runningTime=_getTime();
				var offset=mCustomScrollBox.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left,
					easing="mcsLinearOut";
				touchMoveY.push(y);
				touchMoveX.push(x);
				touchIntent[2]=Math.abs(_coordinates(e)[0]-touchIntent[0]); touchIntent[3]=Math.abs(_coordinates(e)[1]-touchIntent[1]);
				if(d.overflowed[0]){
					var limit=mCSB_dragger[0].parent().height()-mCSB_dragger[0].height(),
						prevent=((dragY-y)>0 && (y-dragY)>-(limit*d.scrollRatio.y) && (touchIntent[3]*2<touchIntent[2] || o.axis==="yx"));
				}
				if(d.overflowed[1]){
					var limitX=mCSB_dragger[1].parent().width()-mCSB_dragger[1].width(),
						preventX=((dragX-x)>0 && (x-dragX)>-(limitX*d.scrollRatio.x) && (touchIntent[2]*2<touchIntent[3] || o.axis==="yx"));
				}
				if(prevent || preventX){ /* prevent native document scrolling */
					e.preventDefault(); 
					touchDrag=1;
				}else{
					docDrag=1;
					$this.addClass("mCS_touch_action");
				}
				amount=o.axis==="yx" ? [(dragY-y),(dragX-x)] : o.axis==="x" ? [null,(dragX-x)] : [(dragY-y),null];
				mCSB_container[0].idleTimer=250;
				if(d.overflowed[0]){_drag(amount[0],durA,easing,"y","all",true);}
				if(d.overflowed[1]){_drag(amount[1],durA,easing,"x",overwrite,true);}
			}
			function _onTouchstart2(e){
				if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){touchable=0; return;}
				touchable=1;
				e.stopImmediatePropagation();
				_stop($this);
				startTime=_getTime();
				var offset=mCustomScrollBox.offset();
				touchStartY=_coordinates(e)[0]-offset.top;
				touchStartX=_coordinates(e)[1]-offset.left;
				touchMoveY=[]; touchMoveX=[];
			}
			function _onTouchend(e){
				if(!_pointerTouch(e) || touchActive || _coordinates(e)[2]){return;}
				e.stopImmediatePropagation();
				touchDrag=0; docDrag=0;
				endTime=_getTime();
				var offset=mCustomScrollBox.offset(),y=_coordinates(e)[0]-offset.top,x=_coordinates(e)[1]-offset.left;
				if((endTime-runningTime)>30){return;}
				speed=1000/(endTime-startTime);
				var easing="mcsEaseOut",slow=speed<2.5,
					diff=slow ? [touchMoveY[touchMoveY.length-2],touchMoveX[touchMoveX.length-2]] : [0,0];
				distance=slow ? [(y-diff[0]),(x-diff[1])] : [y-touchStartY,x-touchStartX];
				var absDistance=[Math.abs(distance[0]),Math.abs(distance[1])];
				speed=slow ? [Math.abs(distance[0]/4),Math.abs(distance[1]/4)] : [speed,speed];
				var a=[
					Math.abs(mCSB_container[0].offsetTop)-(distance[0]*_m((absDistance[0]/speed[0]),speed[0])),
					Math.abs(mCSB_container[0].offsetLeft)-(distance[1]*_m((absDistance[1]/speed[1]),speed[1]))
				];
				amount=o.axis==="yx" ? [a[0],a[1]] : o.axis==="x" ? [null,a[1]] : [a[0],null];
				durB=[(absDistance[0]*4)+o.scrollInertia,(absDistance[1]*4)+o.scrollInertia];
				var md=parseInt(o.contentTouchScroll) || 0; /* absolute minimum distance required */
				amount[0]=absDistance[0]>md ? amount[0] : 0;
				amount[1]=absDistance[1]>md ? amount[1] : 0;
				if(d.overflowed[0]){_drag(amount[0],durB[0],easing,"y",overwrite,false);}
				if(d.overflowed[1]){_drag(amount[1],durB[1],easing,"x",overwrite,false);}
			}
			function _m(ds,s){
				var r=[s*1.5,s*2,s/1.5,s/2];
				if(ds>90){
					return s>4 ? r[0] : r[3];
				}else if(ds>60){
					return s>3 ? r[3] : r[2];
				}else if(ds>30){
					return s>8 ? r[1] : s>6 ? r[0] : s>4 ? s : r[2];
				}else{
					return s>8 ? s : r[3];
				}
			}
			function _drag(amount,dur,easing,dir,overwrite,drag){
				if(!amount){return;}
				_scrollTo($this,amount.toString(),{dur:dur,scrollEasing:easing,dir:dir,overwrite:overwrite,drag:drag});
			}
		},
		/* -------------------- */
		
		
		/* 
		SELECT TEXT EVENTS 
		scrolls content when text is selected 
		*/
		_selectable=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,seq=d.sequential,
				namespace=pluginPfx+"_"+d.idx,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				action;
			mCSB_container.bind("mousedown."+namespace,function(e){
				if(touchable){return;}
				if(!action){action=1; touchActive=true;}
			}).add(document).bind("mousemove."+namespace,function(e){
				if(!touchable && action && _sel()){
					var offset=mCSB_container.offset(),
						y=_coordinates(e)[0]-offset.top+mCSB_container[0].offsetTop,x=_coordinates(e)[1]-offset.left+mCSB_container[0].offsetLeft;
					if(y>0 && y<wrapper.height() && x>0 && x<wrapper.width()){
						if(seq.step){_seq("off",null,"stepped");}
					}else{
						if(o.axis!=="x" && d.overflowed[0]){
							if(y<0){
								_seq("on",38);
							}else if(y>wrapper.height()){
								_seq("on",40);
							}
						}
						if(o.axis!=="y" && d.overflowed[1]){
							if(x<0){
								_seq("on",37);
							}else if(x>wrapper.width()){
								_seq("on",39);
							}
						}
					}
				}
			}).bind("mouseup."+namespace,function(e){
				if(touchable){return;}
				if(action){action=0; _seq("off",null);}
				touchActive=false;
			});
			function _sel(){
				return 	window.getSelection ? window.getSelection().toString() : 
						document.selection && document.selection.type!="Control" ? document.selection.createRange().text : 0;
			}
			function _seq(a,c,s){
				seq.type=s && action ? "stepped" : "stepless";
				seq.scrollAmount=10;
				_sequentialScroll($this,a,c,"mcsLinearOut",s ? 60 : null);
			}
		},
		/* -------------------- */
		
		
		/* 
		MOUSE WHEEL EVENT
		scrolls content via mouse-wheel 
		via mouse-wheel plugin (https://github.com/brandonaaron/jquery-mousewheel)
		*/
		_mousewheel=function(){
			if(!$(this).data(pluginPfx)){return;} /* Check if the scrollbar is ready to use mousewheel events (issue: #185) */
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_dragger=[$("#mCSB_"+d.idx+"_dragger_vertical"),$("#mCSB_"+d.idx+"_dragger_horizontal")],
				iframe=$("#mCSB_"+d.idx+"_container").find("iframe");
			if(iframe.length){
				iframe.each(function(){
					$(this).load(function(){
						/* bind events on accessible iframes */
						if(_canAccessIFrame(this)){
							$(this.contentDocument || this.contentWindow.document).bind("mousewheel."+namespace,function(e,delta){
								_onMousewheel(e,delta);
							});
						}
					});
				});
			}
			mCustomScrollBox.bind("mousewheel."+namespace,function(e,delta){
				_onMousewheel(e,delta);
			});
			function _onMousewheel(e,delta){
				_stop($this);
				if(_disableMousewheel($this,e.target)){return;} /* disables mouse-wheel when hovering specific elements */
				var deltaFactor=o.mouseWheel.deltaFactor!=="auto" ? parseInt(o.mouseWheel.deltaFactor) : (oldIE && e.deltaFactor<100) ? 100 : e.deltaFactor || 100;
				if(o.axis==="x" || o.mouseWheel.axis==="x"){
					var dir="x",
						px=[Math.round(deltaFactor*d.scrollRatio.x),parseInt(o.mouseWheel.scrollAmount)],
						amount=o.mouseWheel.scrollAmount!=="auto" ? px[1] : px[0]>=mCustomScrollBox.width() ? mCustomScrollBox.width()*0.9 : px[0],
						contentPos=Math.abs($("#mCSB_"+d.idx+"_container")[0].offsetLeft),
						draggerPos=mCSB_dragger[1][0].offsetLeft,
						limit=mCSB_dragger[1].parent().width()-mCSB_dragger[1].width(),
						dlt=e.deltaX || e.deltaY || delta;
				}else{
					var dir="y",
						px=[Math.round(deltaFactor*d.scrollRatio.y),parseInt(o.mouseWheel.scrollAmount)],
						amount=o.mouseWheel.scrollAmount!=="auto" ? px[1] : px[0]>=mCustomScrollBox.height() ? mCustomScrollBox.height()*0.9 : px[0],
						contentPos=Math.abs($("#mCSB_"+d.idx+"_container")[0].offsetTop),
						draggerPos=mCSB_dragger[0][0].offsetTop,
						limit=mCSB_dragger[0].parent().height()-mCSB_dragger[0].height(),
						dlt=e.deltaY || delta;
				}
				if((dir==="y" && !d.overflowed[0]) || (dir==="x" && !d.overflowed[1])){return;}
				if(o.mouseWheel.invert || e.webkitDirectionInvertedFromDevice){dlt=-dlt;}
				if(o.mouseWheel.normalizeDelta){dlt=dlt<0 ? -1 : 1;}
				if((dlt>0 && draggerPos!==0) || (dlt<0 && draggerPos!==limit) || o.mouseWheel.preventDefault){
					e.stopImmediatePropagation();
					e.preventDefault();
				}
				_scrollTo($this,(contentPos-(dlt*amount)).toString(),{dir:dir});
			}
		},
		/* -------------------- */
		
		
		/* checks if iframe can be accessed */
		_canAccessIFrame=function(iframe){
			var html=null;
			try{
				var doc=iframe.contentDocument || iframe.contentWindow.document;
				html=doc.body.innerHTML;
			}catch(err){/* do nothing */}
			return(html!==null);
		},
		/* -------------------- */
		
		
		/* disables mouse-wheel when hovering specific elements like select, datalist etc. */
		_disableMousewheel=function(el,target){
			var tag=target.nodeName.toLowerCase(),
				tags=el.data(pluginPfx).opt.mouseWheel.disableOver,
				/* elements that require focus */
				focusTags=["select","textarea"];
			return $.inArray(tag,tags) > -1 && !($.inArray(tag,focusTags) > -1 && !$(target).is(":focus"));
		},
		/* -------------------- */
		
		
		/* 
		DRAGGER RAIL CLICK EVENT
		scrolls content via dragger rail 
		*/
		_draggerRail=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				namespace=pluginPfx+"_"+d.idx,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				mCSB_draggerContainer=$(".mCSB_"+d.idx+"_scrollbar ."+classes[12]);
			mCSB_draggerContainer.bind("touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace,function(e){
				touchActive=true;
			}).bind("touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace,function(e){
				touchActive=false;
			}).bind("click."+namespace,function(e){
				if($(e.target).hasClass(classes[12]) || $(e.target).hasClass("mCSB_draggerRail")){
					_stop($this);
					var el=$(this),mCSB_dragger=el.find(".mCSB_dragger");
					if(el.parent(".mCSB_scrollTools_horizontal").length>0){
						if(!d.overflowed[1]){return;}
						var dir="x",
							clickDir=e.pageX>mCSB_dragger.offset().left ? -1 : 1,
							to=Math.abs(mCSB_container[0].offsetLeft)-(clickDir*(wrapper.width()*0.9));
					}else{
						if(!d.overflowed[0]){return;}
						var dir="y",
							clickDir=e.pageY>mCSB_dragger.offset().top ? -1 : 1,
							to=Math.abs(mCSB_container[0].offsetTop)-(clickDir*(wrapper.height()*0.9));
					}
					_scrollTo($this,to.toString(),{dir:dir,scrollEasing:"mcsEaseInOut"});
				}
			});
		},
		/* -------------------- */
		
		
		/* 
		FOCUS EVENT
		scrolls content via element focus (e.g. clicking an input, pressing TAB key etc.)
		*/
		_focus=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				namespace=pluginPfx+"_"+d.idx,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent();
			mCSB_container.bind("focusin."+namespace,function(e){
				var el=$(document.activeElement),
					nested=mCSB_container.find(".mCustomScrollBox").length,
					dur=0;
				if(!el.is(o.advanced.autoScrollOnFocus)){return;}
				_stop($this);
				clearTimeout($this[0]._focusTimeout);
				$this[0]._focusTimer=nested ? (dur+17)*nested : 0;
				$this[0]._focusTimeout=setTimeout(function(){
					var	to=[_childPos(el)[0],_childPos(el)[1]],
						contentPos=[mCSB_container[0].offsetTop,mCSB_container[0].offsetLeft],
						isVisible=[
							(contentPos[0]+to[0]>=0 && contentPos[0]+to[0]<wrapper.height()-el.outerHeight(false)),
							(contentPos[1]+to[1]>=0 && contentPos[0]+to[1]<wrapper.width()-el.outerWidth(false))
						],
						overwrite=(o.axis==="yx" && !isVisible[0] && !isVisible[1]) ? "none" : "all";
					if(o.axis!=="x" && !isVisible[0]){
						_scrollTo($this,to[0].toString(),{dir:"y",scrollEasing:"mcsEaseInOut",overwrite:overwrite,dur:dur});
					}
					if(o.axis!=="y" && !isVisible[1]){
						_scrollTo($this,to[1].toString(),{dir:"x",scrollEasing:"mcsEaseInOut",overwrite:overwrite,dur:dur});
					}
				},$this[0]._focusTimer);
			});
		},
		/* -------------------- */
		
		
		/* sets content wrapper scrollTop/scrollLeft always to 0 */
		_wrapperScroll=function(){
			var $this=$(this),d=$this.data(pluginPfx),
				namespace=pluginPfx+"_"+d.idx,
				wrapper=$("#mCSB_"+d.idx+"_container").parent();
			wrapper.bind("scroll."+namespace,function(e){
				if(wrapper.scrollTop()!==0 || wrapper.scrollLeft()!==0){
					$(".mCSB_"+d.idx+"_scrollbar").css("visibility","hidden"); /* hide scrollbar(s) */
				}
			});
		},
		/* -------------------- */
		
		
		/* 
		BUTTONS EVENTS
		scrolls content via up, down, left and right buttons 
		*/
		_buttons=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,seq=d.sequential,
				namespace=pluginPfx+"_"+d.idx,
				sel=".mCSB_"+d.idx+"_scrollbar",
				btn=$(sel+">a");
			btn.bind("mousedown."+namespace+" touchstart."+namespace+" pointerdown."+namespace+" MSPointerDown."+namespace+" mouseup."+namespace+" touchend."+namespace+" pointerup."+namespace+" MSPointerUp."+namespace+" mouseout."+namespace+" pointerout."+namespace+" MSPointerOut."+namespace+" click."+namespace,function(e){
				e.preventDefault();
				if(!_mouseBtnLeft(e)){return;} /* left mouse button only */
				var btnClass=$(this).attr("class");
				seq.type=o.scrollButtons.scrollType;
				switch(e.type){
					case "mousedown": case "touchstart": case "pointerdown": case "MSPointerDown":
						if(seq.type==="stepped"){return;}
						touchActive=true;
						d.tweenRunning=false;
						_seq("on",btnClass);
						break;
					case "mouseup": case "touchend": case "pointerup": case "MSPointerUp":
					case "mouseout": case "pointerout": case "MSPointerOut":
						if(seq.type==="stepped"){return;}
						touchActive=false;
						if(seq.dir){_seq("off",btnClass);}
						break;
					case "click":
						if(seq.type!=="stepped" || d.tweenRunning){return;}
						_seq("on",btnClass);
						break;
				}
				function _seq(a,c){
					seq.scrollAmount=o.snapAmount || o.scrollButtons.scrollAmount;
					_sequentialScroll($this,a,c);
				}
			});
		},
		/* -------------------- */
		
		
		/* 
		KEYBOARD EVENTS
		scrolls content via keyboard 
		Keys: up arrow, down arrow, left arrow, right arrow, PgUp, PgDn, Home, End
		*/
		_keyboard=function(){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,seq=d.sequential,
				namespace=pluginPfx+"_"+d.idx,
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				editables="input,textarea,select,datalist,keygen,[contenteditable='true']",
				iframe=mCSB_container.find("iframe"),
				events=["blur."+namespace+" keydown."+namespace+" keyup."+namespace];
			if(iframe.length){
				iframe.each(function(){
					$(this).load(function(){
						/* bind events on accessible iframes */
						if(_canAccessIFrame(this)){
							$(this.contentDocument || this.contentWindow.document).bind(events[0],function(e){
								_onKeyboard(e);
							});
						}
					});
				});
			}
			mCustomScrollBox.attr("tabindex","0").bind(events[0],function(e){
				_onKeyboard(e);
			});
			function _onKeyboard(e){
				switch(e.type){
					case "blur":
						if(d.tweenRunning && seq.dir){_seq("off",null);}
						break;
					case "keydown": case "keyup":
						var code=e.keyCode ? e.keyCode : e.which,action="on";
						if((o.axis!=="x" && (code===38 || code===40)) || (o.axis!=="y" && (code===37 || code===39))){
							/* up (38), down (40), left (37), right (39) arrows */
							if(((code===38 || code===40) && !d.overflowed[0]) || ((code===37 || code===39) && !d.overflowed[1])){return;}
							if(e.type==="keyup"){action="off";}
							if(!$(document.activeElement).is(editables)){
								e.preventDefault();
								e.stopImmediatePropagation();
								_seq(action,code);
							}
						}else if(code===33 || code===34){
							/* PgUp (33), PgDn (34) */
							if(d.overflowed[0] || d.overflowed[1]){
								e.preventDefault();
								e.stopImmediatePropagation();
							}
							if(e.type==="keyup"){
								_stop($this);
								var keyboardDir=code===34 ? -1 : 1;
								if(o.axis==="x" || (o.axis==="yx" && d.overflowed[1] && !d.overflowed[0])){
									var dir="x",to=Math.abs(mCSB_container[0].offsetLeft)-(keyboardDir*(wrapper.width()*0.9));
								}else{
									var dir="y",to=Math.abs(mCSB_container[0].offsetTop)-(keyboardDir*(wrapper.height()*0.9));
								}
								_scrollTo($this,to.toString(),{dir:dir,scrollEasing:"mcsEaseInOut"});
							}
						}else if(code===35 || code===36){
							/* End (35), Home (36) */
							if(!$(document.activeElement).is(editables)){
								if(d.overflowed[0] || d.overflowed[1]){
									e.preventDefault();
									e.stopImmediatePropagation();
								}
								if(e.type==="keyup"){
									if(o.axis==="x" || (o.axis==="yx" && d.overflowed[1] && !d.overflowed[0])){
										var dir="x",to=code===35 ? Math.abs(wrapper.width()-mCSB_container.outerWidth(false)) : 0;
									}else{
										var dir="y",to=code===35 ? Math.abs(wrapper.height()-mCSB_container.outerHeight(false)) : 0;
									}
									_scrollTo($this,to.toString(),{dir:dir,scrollEasing:"mcsEaseInOut"});
								}
							}
						}
						break;
				}
				function _seq(a,c){
					seq.type=o.keyboard.scrollType;
					seq.scrollAmount=o.snapAmount || o.keyboard.scrollAmount;
					if(seq.type==="stepped" && d.tweenRunning){return;}
					_sequentialScroll($this,a,c);
				}
			}
		},
		/* -------------------- */
		
		
		/* scrolls content sequentially (used when scrolling via buttons, keyboard arrows etc.) */
		_sequentialScroll=function(el,action,trigger,e,s){
			var d=el.data(pluginPfx),o=d.opt,seq=d.sequential,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				once=seq.type==="stepped" ? true : false,
				steplessSpeed=o.scrollInertia < 26 ? 26 : o.scrollInertia, /* 26/1.5=17 */
				steppedSpeed=o.scrollInertia < 1 ? 17 : o.scrollInertia;
			switch(action){
				case "on":
					seq.dir=[
						(trigger===classes[16] || trigger===classes[15] || trigger===39 || trigger===37 ? "x" : "y"),
						(trigger===classes[13] || trigger===classes[15] || trigger===38 || trigger===37 ? -1 : 1)
					];
					_stop(el);
					if(_isNumeric(trigger) && seq.type==="stepped"){return;}
					_on(once);
					break;
				case "off":
					_off();
					if(once || (d.tweenRunning && seq.dir)){
						_on(true);
					}
					break;
			}
			/* starts sequence */
			function _on(once){
				var c=seq.type!=="stepped", /* continuous scrolling */
					t=s ? s : !once ? 1000/60 : c ? steplessSpeed/1.5 : steppedSpeed, /* timer */
					m=!once ? 2.5 : c ? 7.5 : 40, /* multiplier */
					contentPos=[Math.abs(mCSB_container[0].offsetTop),Math.abs(mCSB_container[0].offsetLeft)],
					ratio=[d.scrollRatio.y>10 ? 10 : d.scrollRatio.y,d.scrollRatio.x>10 ? 10 : d.scrollRatio.x],
					amount=seq.dir[0]==="x" ? contentPos[1]+(seq.dir[1]*(ratio[1]*m)) : contentPos[0]+(seq.dir[1]*(ratio[0]*m)),
					px=seq.dir[0]==="x" ? contentPos[1]+(seq.dir[1]*parseInt(seq.scrollAmount)) : contentPos[0]+(seq.dir[1]*parseInt(seq.scrollAmount)),
					to=seq.scrollAmount!=="auto" ? px : amount,
					easing=e ? e : !once ? "mcsLinear" : c ? "mcsLinearOut" : "mcsEaseInOut",
					onComplete=!once ? false : true;
				if(once && t<17){
					to=seq.dir[0]==="x" ? contentPos[1] : contentPos[0];
				}
				_scrollTo(el,to.toString(),{dir:seq.dir[0],scrollEasing:easing,dur:t,onComplete:onComplete});
				if(once){
					seq.dir=false;
					return;
				}
				clearTimeout(seq.step);
				seq.step=setTimeout(function(){
					_on();
				},t);
			}
			/* stops sequence */
			function _off(){
				clearTimeout(seq.step);
				_delete(seq,"step");
				_stop(el);
			}
		},
		/* -------------------- */
		
		
		/* returns a yx array from value */
		_arr=function(val){
			var o=$(this).data(pluginPfx).opt,vals=[];
			if(typeof val==="function"){val=val();} /* check if the value is a single anonymous function */
			/* check if value is object or array, its length and create an array with yx values */
			if(!(val instanceof Array)){ /* object value (e.g. {y:"100",x:"100"}, 100 etc.) */
				vals[0]=val.y ? val.y : val.x || o.axis==="x" ? null : val;
				vals[1]=val.x ? val.x : val.y || o.axis==="y" ? null : val;
			}else{ /* array value (e.g. [100,100]) */
				vals=val.length>1 ? [val[0],val[1]] : o.axis==="x" ? [null,val[0]] : [val[0],null];
			}
			/* check if array values are anonymous functions */
			if(typeof vals[0]==="function"){vals[0]=vals[0]();}
			if(typeof vals[1]==="function"){vals[1]=vals[1]();}
			return vals;
		},
		/* -------------------- */
		
		
		/* translates values (e.g. "top", 100, "100px", "#id") to actual scroll-to positions */
		_to=function(val,dir){
			if(val==null || typeof val=="undefined"){return;}
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				t=typeof val;
			if(!dir){dir=o.axis==="x" ? "x" : "y";}
			var contentLength=dir==="x" ? mCSB_container.outerWidth(false) : mCSB_container.outerHeight(false),
				contentPos=dir==="x" ? mCSB_container[0].offsetLeft : mCSB_container[0].offsetTop,
				cssProp=dir==="x" ? "left" : "top";
			switch(t){
				case "function": /* this currently is not used. Consider removing it */
					return val();
					break;
				case "object": /* js/jquery object */
					var obj=val.jquery ? val : $(val);
					if(!obj.length){return;}
					return dir==="x" ? _childPos(obj)[1] : _childPos(obj)[0];
					break;
				case "string": case "number":
					if(_isNumeric(val)){ /* numeric value */
						return Math.abs(val);
					}else if(val.indexOf("%")!==-1){ /* percentage value */
						return Math.abs(contentLength*parseInt(val)/100);
					}else if(val.indexOf("-=")!==-1){ /* decrease value */
						return Math.abs(contentPos-parseInt(val.split("-=")[1]));
					}else if(val.indexOf("+=")!==-1){ /* inrease value */
						var p=(contentPos+parseInt(val.split("+=")[1]));
						return p>=0 ? 0 : Math.abs(p);
					}else if(val.indexOf("px")!==-1 && _isNumeric(val.split("px")[0])){ /* pixels string value (e.g. "100px") */
						return Math.abs(val.split("px")[0]);
					}else{
						if(val==="top" || val==="left"){ /* special strings */
							return 0;
						}else if(val==="bottom"){
							return Math.abs(wrapper.height()-mCSB_container.outerHeight(false));
						}else if(val==="right"){
							return Math.abs(wrapper.width()-mCSB_container.outerWidth(false));
						}else if(val==="first" || val==="last"){
							var obj=mCSB_container.find(":"+val);
							return dir==="x" ? _childPos(obj)[1] : _childPos(obj)[0];
						}else{
							if($(val).length){ /* jquery selector */
								return dir==="x" ? _childPos($(val))[1] : _childPos($(val))[0];
							}else{ /* other values (e.g. "100em") */
								mCSB_container.css(cssProp,val);
								methods.update.call(null,$this[0]);
								return;
							}
						}
					}
					break;
			}
		},
		/* -------------------- */
		
		
		/* calls the update method automatically */
		_autoUpdate=function(rem){
			var $this=$(this),d=$this.data(pluginPfx),o=d.opt,
				mCSB_container=$("#mCSB_"+d.idx+"_container");
			if(rem){
				/* 
				removes autoUpdate timer 
				usage: _autoUpdate.call(this,"remove");
				*/
				clearTimeout(mCSB_container[0].autoUpdate);
				_delete(mCSB_container[0],"autoUpdate");
				return;
			}
			var	wrapper=mCSB_container.parent(),
				scrollbar=[$("#mCSB_"+d.idx+"_scrollbar_vertical"),$("#mCSB_"+d.idx+"_scrollbar_horizontal")],
				scrollbarSize=function(){return [
					scrollbar[0].is(":visible") ? scrollbar[0].outerHeight(true) : 0, /* returns y-scrollbar height */
					scrollbar[1].is(":visible") ? scrollbar[1].outerWidth(true) : 0 /* returns x-scrollbar width */
				]},
				oldSelSize=sizesSum(),newSelSize,
				os=[mCSB_container.outerHeight(false),mCSB_container.outerWidth(false),wrapper.height(),wrapper.width(),scrollbarSize()[0],scrollbarSize()[1]],ns,
				oldImgsLen=imgSum(),newImgsLen;
			upd();
			function upd(){
				clearTimeout(mCSB_container[0].autoUpdate);
				if($this.parents("html").length===0){
					/* check element in dom tree */
					$this=null;
					return;
				}
				mCSB_container[0].autoUpdate=setTimeout(function(){
					/* update on specific selector(s) length and size change */
					if(o.advanced.updateOnSelectorChange){
						newSelSize=sizesSum();
						if(newSelSize!==oldSelSize){
							doUpd(3);
							oldSelSize=newSelSize;
							return;
						}
					}
					/* update on main element and scrollbar size changes */
					if(o.advanced.updateOnContentResize){
						ns=[mCSB_container.outerHeight(false),mCSB_container.outerWidth(false),wrapper.height(),wrapper.width(),scrollbarSize()[0],scrollbarSize()[1]];
						if(ns[0]!==os[0] || ns[1]!==os[1] || ns[2]!==os[2] || ns[3]!==os[3] || ns[4]!==os[4] || ns[5]!==os[5]){
							doUpd(ns[0]!==os[0] || ns[1]!==os[1]);
							os=ns;
						}
					}
					/* update on image load */
					if(o.advanced.updateOnImageLoad){
						newImgsLen=imgSum();
						if(newImgsLen!==oldImgsLen){
							mCSB_container.find("img").each(function(){
								imgLoader(this);
							});
							oldImgsLen=newImgsLen;
						}
					}
					if(o.advanced.updateOnSelectorChange || o.advanced.updateOnContentResize || o.advanced.updateOnImageLoad){upd();}
				},o.advanced.autoUpdateTimeout);
			}
			/* returns images amount */
			function imgSum(){
				var total=0
				if(o.advanced.updateOnImageLoad){total=mCSB_container.find("img").length;}
				return total;
			}
			/* a tiny image loader */
			function imgLoader(el){
				if($(el).hasClass(classes[2])){doUpd(); return;}
				var img=new Image();
				function createDelegate(contextObject,delegateMethod){
					return function(){return delegateMethod.apply(contextObject,arguments);}
				}
				function imgOnLoad(){
					this.onload=null;
					$(el).addClass(classes[2]);
					doUpd(2);
				}
				img.onload=createDelegate(img,imgOnLoad);
				img.src=el.src;
			}
			/* returns the total height and width sum of all elements matching the selector */
			function sizesSum(){
				if(o.advanced.updateOnSelectorChange===true){o.advanced.updateOnSelectorChange="*";}
				var total=0,sel=mCSB_container.find(o.advanced.updateOnSelectorChange);
				if(o.advanced.updateOnSelectorChange && sel.length>0){sel.each(function(){total+=$(this).height()+$(this).width();});}
				return total;
			}
			/* calls the update method */
			function doUpd(cb){
				clearTimeout(mCSB_container[0].autoUpdate); 
				methods.update.call(null,$this[0],cb);
			}
		},
		/* -------------------- */
		
		
		/* snaps scrolling to a multiple of a pixels number */
		_snapAmount=function(to,amount,offset){
			return (Math.round(to/amount)*amount-offset); 
		},
		/* -------------------- */
		
		
		/* stops content and scrollbar animations */
		_stop=function(el){
			var d=el.data(pluginPfx),
				sel=$("#mCSB_"+d.idx+"_container,#mCSB_"+d.idx+"_container_wrapper,#mCSB_"+d.idx+"_dragger_vertical,#mCSB_"+d.idx+"_dragger_horizontal");
			sel.each(function(){
				_stopTween.call(this);
			});
		},
		/* -------------------- */
		
		
		/* 
		ANIMATES CONTENT 
		This is where the actual scrolling happens
		*/
		_scrollTo=function(el,to,options){
			var d=el.data(pluginPfx),o=d.opt,
				defaults={
					trigger:"internal",
					dir:"y",
					scrollEasing:"mcsEaseOut",
					drag:false,
					dur:o.scrollInertia,
					overwrite:"all",
					callbacks:true,
					onStart:true,
					onUpdate:true,
					onComplete:true
				},
				options=$.extend(defaults,options),
				dur=[options.dur,(options.drag ? 0 : options.dur)],
				mCustomScrollBox=$("#mCSB_"+d.idx),
				mCSB_container=$("#mCSB_"+d.idx+"_container"),
				wrapper=mCSB_container.parent(),
				totalScrollOffsets=o.callbacks.onTotalScrollOffset ? _arr.call(el,o.callbacks.onTotalScrollOffset) : [0,0],
				totalScrollBackOffsets=o.callbacks.onTotalScrollBackOffset ? _arr.call(el,o.callbacks.onTotalScrollBackOffset) : [0,0];
			d.trigger=options.trigger;
			if(wrapper.scrollTop()!==0 || wrapper.scrollLeft()!==0){ /* always reset scrollTop/Left */
				$(".mCSB_"+d.idx+"_scrollbar").css("visibility","visible");
				wrapper.scrollTop(0).scrollLeft(0);
			}
			if(to==="_resetY" && !d.contentReset.y){
				/* callbacks: onOverflowYNone */
				if(_cb("onOverflowYNone")){o.callbacks.onOverflowYNone.call(el[0]);}
				d.contentReset.y=1;
			}
			if(to==="_resetX" && !d.contentReset.x){
				/* callbacks: onOverflowXNone */
				if(_cb("onOverflowXNone")){o.callbacks.onOverflowXNone.call(el[0]);}
				d.contentReset.x=1;
			}
			if(to==="_resetY" || to==="_resetX"){return;}
			if((d.contentReset.y || !el[0].mcs) && d.overflowed[0]){
				/* callbacks: onOverflowY */
				if(_cb("onOverflowY")){o.callbacks.onOverflowY.call(el[0]);}
				d.contentReset.x=null;
			}
			if((d.contentReset.x || !el[0].mcs) && d.overflowed[1]){
				/* callbacks: onOverflowX */
				if(_cb("onOverflowX")){o.callbacks.onOverflowX.call(el[0]);}
				d.contentReset.x=null;
			}
			if(o.snapAmount){to=_snapAmount(to,o.snapAmount,o.snapOffset);} /* scrolling snapping */
			switch(options.dir){
				case "x":
					var mCSB_dragger=$("#mCSB_"+d.idx+"_dragger_horizontal"),
						property="left",
						contentPos=mCSB_container[0].offsetLeft,
						limit=[
							mCustomScrollBox.width()-mCSB_container.outerWidth(false),
							mCSB_dragger.parent().width()-mCSB_dragger.width()
						],
						scrollTo=[to,to===0 ? 0 : (to/d.scrollRatio.x)],
						tso=totalScrollOffsets[1],
						tsbo=totalScrollBackOffsets[1],
						totalScrollOffset=tso>0 ? tso/d.scrollRatio.x : 0,
						totalScrollBackOffset=tsbo>0 ? tsbo/d.scrollRatio.x : 0;
					break;
				case "y":
					var mCSB_dragger=$("#mCSB_"+d.idx+"_dragger_vertical"),
						property="top",
						contentPos=mCSB_container[0].offsetTop,
						limit=[
							mCustomScrollBox.height()-mCSB_container.outerHeight(false),
							mCSB_dragger.parent().height()-mCSB_dragger.height()
						],
						scrollTo=[to,to===0 ? 0 : (to/d.scrollRatio.y)],
						tso=totalScrollOffsets[0],
						tsbo=totalScrollBackOffsets[0],
						totalScrollOffset=tso>0 ? tso/d.scrollRatio.y : 0,
						totalScrollBackOffset=tsbo>0 ? tsbo/d.scrollRatio.y : 0;
					break;
			}
			if(scrollTo[1]<0 || (scrollTo[0]===0 && scrollTo[1]===0)){
				scrollTo=[0,0];
			}else if(scrollTo[1]>=limit[1]){
				scrollTo=[limit[0],limit[1]];
			}else{
				scrollTo[0]=-scrollTo[0];
			}
			if(!el[0].mcs){
				_mcs();  /* init mcs object (once) to make it available before callbacks */
				if(_cb("onInit")){o.callbacks.onInit.call(el[0]);} /* callbacks: onInit */
			}
			clearTimeout(mCSB_container[0].onCompleteTimeout);
			if(!d.tweenRunning && ((contentPos===0 && scrollTo[0]>=0) || (contentPos===limit[0] && scrollTo[0]<=limit[0]))){return;}
			_tweenTo(mCSB_dragger[0],property,Math.round(scrollTo[1]),dur[1],options.scrollEasing);
			_tweenTo(mCSB_container[0],property,Math.round(scrollTo[0]),dur[0],options.scrollEasing,options.overwrite,{
				onStart:function(){
					if(options.callbacks && options.onStart && !d.tweenRunning){
						/* callbacks: onScrollStart */
						if(_cb("onScrollStart")){_mcs(); o.callbacks.onScrollStart.call(el[0]);}
						d.tweenRunning=true;
						_onDragClasses(mCSB_dragger);
						d.cbOffsets=_cbOffsets();
					}
				},onUpdate:function(){
					if(options.callbacks && options.onUpdate){
						/* callbacks: whileScrolling */
						if(_cb("whileScrolling")){_mcs(); o.callbacks.whileScrolling.call(el[0]);}
					}
				},onComplete:function(){
					if(options.callbacks && options.onComplete){
						if(o.axis==="yx"){clearTimeout(mCSB_container[0].onCompleteTimeout);}
						var t=mCSB_container[0].idleTimer || 0;
						mCSB_container[0].onCompleteTimeout=setTimeout(function(){
							/* callbacks: onScroll, onTotalScroll, onTotalScrollBack */
							if(_cb("onScroll")){_mcs(); o.callbacks.onScroll.call(el[0]);}
							if(_cb("onTotalScroll") && scrollTo[1]>=limit[1]-totalScrollOffset && d.cbOffsets[0]){_mcs(); o.callbacks.onTotalScroll.call(el[0]);}
							if(_cb("onTotalScrollBack") && scrollTo[1]<=totalScrollBackOffset && d.cbOffsets[1]){_mcs(); o.callbacks.onTotalScrollBack.call(el[0]);}
							d.tweenRunning=false;
							mCSB_container[0].idleTimer=0;
							_onDragClasses(mCSB_dragger,"hide");
						},t);
					}
				}
			});
			/* checks if callback function exists */
			function _cb(cb){
				return d && o.callbacks[cb] && typeof o.callbacks[cb]==="function";
			}
			/* checks whether callback offsets always trigger */
			function _cbOffsets(){
				return [o.callbacks.alwaysTriggerOffsets || contentPos>=limit[0]+tso,o.callbacks.alwaysTriggerOffsets || contentPos<=-tsbo];
			}
			/* 
			populates object with useful values for the user 
			values: 
				content: this.mcs.content
				content top position: this.mcs.top 
				content left position: this.mcs.left 
				dragger top position: this.mcs.draggerTop 
				dragger left position: this.mcs.draggerLeft 
				scrolling y percentage: this.mcs.topPct 
				scrolling x percentage: this.mcs.leftPct 
				scrolling direction: this.mcs.direction
			*/
			function _mcs(){
				var cp=[mCSB_container[0].offsetTop,mCSB_container[0].offsetLeft], /* content position */
					dp=[mCSB_dragger[0].offsetTop,mCSB_dragger[0].offsetLeft], /* dragger position */
					cl=[mCSB_container.outerHeight(false),mCSB_container.outerWidth(false)], /* content length */
					pl=[mCustomScrollBox.height(),mCustomScrollBox.width()]; /* content parent length */
				el[0].mcs={
					content:mCSB_container, /* original content wrapper as jquery object */
					top:cp[0],left:cp[1],draggerTop:dp[0],draggerLeft:dp[1],
					topPct:Math.round((100*Math.abs(cp[0]))/(Math.abs(cl[0])-pl[0])),leftPct:Math.round((100*Math.abs(cp[1]))/(Math.abs(cl[1])-pl[1])),
					direction:options.dir
				};
				/* 
				this refers to the original element containing the scrollbar(s)
				usage: this.mcs.top, this.mcs.leftPct etc. 
				*/
			}
		},
		/* -------------------- */
		
		
		/* 
		CUSTOM JAVASCRIPT ANIMATION TWEEN 
		Lighter and faster than jquery animate() and css transitions 
		Animates top/left properties and includes easings 
		*/
		_tweenTo=function(el,prop,to,duration,easing,overwrite,callbacks){
			if(!el._mTween){el._mTween={top:{},left:{}};}
			var callbacks=callbacks || {},
				onStart=callbacks.onStart || function(){},onUpdate=callbacks.onUpdate || function(){},onComplete=callbacks.onComplete || function(){},
				startTime=_getTime(),_delay,progress=0,from=el.offsetTop,elStyle=el.style,_request,tobj=el._mTween[prop];
			if(prop==="left"){from=el.offsetLeft;}
			var diff=to-from;
			tobj.stop=0;
			if(overwrite!=="none"){_cancelTween();}
			_startTween();
			function _step(){
				if(tobj.stop){return;}
				if(!progress){onStart.call();}
				progress=_getTime()-startTime;
				_tween();
				if(progress>=tobj.time){
					tobj.time=(progress>tobj.time) ? progress+_delay-(progress-tobj.time) : progress+_delay-1;
					if(tobj.time<progress+1){tobj.time=progress+1;}
				}
				if(tobj.time<duration){tobj.id=_request(_step);}else{onComplete.call();}
			}
			function _tween(){
				if(duration>0){
					tobj.currVal=_ease(tobj.time,from,diff,duration,easing);
					elStyle[prop]=Math.round(tobj.currVal)+"px";
				}else{
					elStyle[prop]=to+"px";
				}
				onUpdate.call();
			}
			function _startTween(){
				_delay=1000/60;
				tobj.time=progress+_delay;
				_request=(!window.requestAnimationFrame) ? function(f){_tween(); return setTimeout(f,0.01);} : window.requestAnimationFrame;
				tobj.id=_request(_step);
			}
			function _cancelTween(){
				if(tobj.id==null){return;}
				if(!window.requestAnimationFrame){clearTimeout(tobj.id);
				}else{window.cancelAnimationFrame(tobj.id);}
				tobj.id=null;
			}
			function _ease(t,b,c,d,type){
				switch(type){
					case "linear": case "mcsLinear":
						return c*t/d + b;
						break;
					case "mcsLinearOut":
						t/=d; t--; return c * Math.sqrt(1 - t*t) + b;
						break;
					case "easeInOutSmooth":
						t/=d/2;
						if(t<1) return c/2*t*t + b;
						t--;
						return -c/2 * (t*(t-2) - 1) + b;
						break;
					case "easeInOutStrong":
						t/=d/2;
						if(t<1) return c/2 * Math.pow( 2, 10 * (t - 1) ) + b;
						t--;
						return c/2 * ( -Math.pow( 2, -10 * t) + 2 ) + b;
						break;
					case "easeInOut": case "mcsEaseInOut":
						t/=d/2;
						if(t<1) return c/2*t*t*t + b;
						t-=2;
						return c/2*(t*t*t + 2) + b;
						break;
					case "easeOutSmooth":
						t/=d; t--;
						return -c * (t*t*t*t - 1) + b;
						break;
					case "easeOutStrong":
						return c * ( -Math.pow( 2, -10 * t/d ) + 1 ) + b;
						break;
					case "easeOut": case "mcsEaseOut": default:
						var ts=(t/=d)*t,tc=ts*t;
						return b+c*(0.499999999999997*tc*ts + -2.5*ts*ts + 5.5*tc + -6.5*ts + 4*t);
				}
			}
		},
		/* -------------------- */
		
		
		/* returns current time */
		_getTime=function(){
			if(window.performance && window.performance.now){
				return window.performance.now();
			}else{
				if(window.performance && window.performance.webkitNow){
					return window.performance.webkitNow();
				}else{
					if(Date.now){return Date.now();}else{return new Date().getTime();}
				}
			}
		},
		/* -------------------- */
		
		
		/* stops a tween */
		_stopTween=function(){
			var el=this;
			if(!el._mTween){el._mTween={top:{},left:{}};}
			var props=["top","left"];
			for(var i=0; i<props.length; i++){
				var prop=props[i];
				if(el._mTween[prop].id){
					if(!window.requestAnimationFrame){clearTimeout(el._mTween[prop].id);
					}else{window.cancelAnimationFrame(el._mTween[prop].id);}
					el._mTween[prop].id=null;
					el._mTween[prop].stop=1;
				}
			}
		},
		/* -------------------- */
		
		
		/* deletes a property (avoiding the exception thrown by IE) */
		_delete=function(c,m){
			try{delete c[m];}catch(e){c[m]=null;}
		},
		/* -------------------- */
		
		
		/* detects left mouse button */
		_mouseBtnLeft=function(e){
			return !(e.which && e.which!==1);
		},
		/* -------------------- */
		
		
		/* detects if pointer type event is touch */
		_pointerTouch=function(e){
			var t=e.originalEvent.pointerType;
			return !(t && t!=="touch" && t!==2);
		},
		/* -------------------- */
		
		
		/* checks if value is numeric */
		_isNumeric=function(val){
			return !isNaN(parseFloat(val)) && isFinite(val);
		},
		/* -------------------- */
		
		
		/* returns element position according to content */
		_childPos=function(el){
			var p=el.parents(".mCSB_container");
			return [el.offset().top-p.offset().top,el.offset().left-p.offset().left];
		};
		/* -------------------- */
		
	
	
	
	
	/* 
	----------------------------------------
	PLUGIN SETUP 
	----------------------------------------
	*/
	
	/* plugin constructor functions */
	$.fn[pluginNS]=function(method){ /* usage: $(selector).mCustomScrollbar(); */
		if(methods[method]){
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
		}else if(typeof method==="object" || !method){
			return methods.init.apply(this,arguments);
		}else{
			$.error("Method "+method+" does not exist");
		}
	};
	$[pluginNS]=function(method){ /* usage: $.mCustomScrollbar(); */
		if(methods[method]){
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
		}else if(typeof method==="object" || !method){
			return methods.init.apply(this,arguments);
		}else{
			$.error("Method "+method+" does not exist");
		}
	};
	
	/* 
	allow setting plugin default options. 
	usage: $.mCustomScrollbar.defaults.scrollInertia=500; 
	to apply any changed default options on default selectors (below), use inside document ready fn 
	e.g.: $(document).ready(function(){ $.mCustomScrollbar.defaults.scrollInertia=500; });
	*/
	$[pluginNS].defaults=defaults;
	
	/* 
	add window object (window.mCustomScrollbar) 
	usage: if(window.mCustomScrollbar){console.log("custom scrollbar plugin loaded");}
	*/
	window[pluginNS]=true;
	
	$(window).load(function(){
		
		$(defaultSelector)[pluginNS](); /* add scrollbars automatically on default selector */
		
		/* extend jQuery expressions */
		$.extend($.expr[":"],{
			/* checks if element is within scrollable viewport */
			mcsInView:$.expr[":"].mcsInView || function(el){
				var $el=$(el),content=$el.parents(".mCSB_container"),wrapper,cPos;
				if(!content.length){return;}
				wrapper=content.parent();
				cPos=[content[0].offsetTop,content[0].offsetLeft];
				return 	cPos[0]+_childPos($el)[0]>=0 && cPos[0]+_childPos($el)[0]<wrapper.height()-$el.outerHeight(false) && 
						cPos[1]+_childPos($el)[1]>=0 && cPos[1]+_childPos($el)[1]<wrapper.width()-$el.outerWidth(false);
			},
			/* checks if element is overflowed having visible scrollbar(s) */
			mcsOverflow:$.expr[":"].mcsOverflow || function(el){
				var d=$(el).data(pluginPfx);
				if(!d){return;}
				return d.overflowed[0] || d.overflowed[1];
			}
		});
	
	});

}))}));

/*!
 * jquery.customSelect() - v0.4.1
 * http://adam.co/lab/jquery/customselect/
 * 2013-05-13
 *
 * Copyright 2013 Adam Coulombe
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @license http://www.gnu.org/licenses/gpl.html GPL2 License
 */
jQuery(document).ready(function(a) {a.fn.extend({customSelect:function(c){if(typeof document.body.style.maxHeight==="undefined"){return this}var e={customClass:"customSelect",mapClass:true,mapStyle:true},c=a.extend(e,c),d=c.customClass,f=function(h,k){var g=h.find(":selected"),j=k.children(":first"),i=g.html()||"&nbsp;";j.html(i);if(g.attr("disabled")){k.addClass(b("DisabledOption"))}else{k.removeClass(b("DisabledOption"))}setTimeout(function(){k.removeClass(b("Open"));a(document).off("mouseup."+b("Open"))},60)},b=function(g){return d+g};return this.each(function(){var g=a(this),i=a("<span />").addClass(b("Inner")),h=a("<span />");g.after(h.append(i));h.addClass(d);if(c.mapClass){h.addClass(g.attr("class"))}if(c.mapStyle){h.attr("style",g.attr("style"))}g.addClass("hasCustomSelect").on("update",function(){f(g,h);var k=parseInt(g.outerWidth(),10)-(parseInt(h.outerWidth(),10)-parseInt(h.width(),10));h.css({display:"inline-block"});var j=h.outerHeight();if(g.attr("disabled")){h.addClass(b("Disabled"))}else{h.removeClass(b("Disabled"))}i.css({width:k,display:"inline-block"});g.css({"-webkit-appearance":"menulist-button",width:h.outerWidth(),position:"absolute",opacity:0,height:j,fontSize:h.css("font-size")})}).on("change",function(){h.addClass(b("Changed"));f(g,h)}).on("keyup",function(j){if(!h.hasClass(b("Open"))){g.blur();g.focus()}else{if(j.which==13||j.which==27){f(g,h)}}}).on("mousedown",function(j){h.removeClass(b("Changed"))}).on("mouseup",function(j){if(!h.hasClass(b("Open"))){if(a("."+b("Open")).not(h).length>0&&typeof InstallTrigger!=="undefined"){g.focus()}else{h.addClass(b("Open"));j.stopPropagation();a(document).one("mouseup."+b("Open"),function(k){if(k.target!=g.get(0)&&a.inArray(k.target,g.find("*").get())<0){g.blur()}else{f(g,h)}})}}}).focus(function(){h.removeClass(b("Changed")).addClass(b("Focus"))}).blur(function(){h.removeClass(b("Focus")+" "+b("Open"))}).hover(function(){h.addClass(b("Hover"))},function(){h.removeClass(b("Hover"))}).trigger("update")})}})});

/*!
 * Isotope PACKAGED v3.0.0
 *
 * Licensed GPLv3 for open source use
 * or Isotope Commercial License for commercial use
 *
 * http://isotope.metafizzy.co
 * Copyright 2016 Metafizzy
 */

/**
 * Bridget makes jQuery widgets
 * v2.0.0
 * MIT license
 */

/* jshint browser: true, strict: true, undef: true, unused: true */

( function( window, factory ) {
  'use strict';
  /* globals define: false, module: false, require: false */

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'jquery-bridget/jquery-bridget',[ 'jquery' ], function( jQuery ) {
      factory( window, jQuery );
    });
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      window,
      require('jquery')
    );
  } else {
    // browser global
    window.jQueryBridget = factory(
      window,
      window.jQuery
    );
  }

}( window, function factory( window, jQuery ) {
'use strict';

// ----- utils ----- //

var arraySlice = Array.prototype.slice;

// helper function for logging errors
// $.error breaks jQuery chaining
var console = window.console;
var logError = typeof console == 'undefined' ? function() {} :
  function( message ) {
    console.error( message );
  };

// ----- jQueryBridget ----- //

function jQueryBridget( namespace, PluginClass, $ ) {
  $ = $ || jQuery || window.jQuery;
  if ( !$ ) {
    return;
  }

  // add option method -> $().plugin('option', {...})
  if ( !PluginClass.prototype.option ) {
    // option setter
    PluginClass.prototype.option = function( opts ) {
      // bail out if not an object
      if ( !$.isPlainObject( opts ) ){
        return;
      }
      this.options = $.extend( true, this.options, opts );
    };
  }

  // make jQuery plugin
  $.fn[ namespace ] = function( arg0 /*, arg1 */ ) {
    if ( typeof arg0 == 'string' ) {
      // method call $().plugin( 'methodName', { options } )
      // shift arguments by 1
      var args = arraySlice.call( arguments, 1 );
      return methodCall( this, arg0, args );
    }
    // just $().plugin({ options })
    plainCall( this, arg0 );
    return this;
  };

  // $().plugin('methodName')
  function methodCall( $elems, methodName, args ) {
    var returnValue;
    var pluginMethodStr = '$().' + namespace + '("' + methodName + '")';

    $elems.each( function( i, elem ) {
      // get instance
      var instance = $.data( elem, namespace );
      if ( !instance ) {
        logError( namespace + ' not initialized. Cannot call methods, i.e. ' +
          pluginMethodStr );
        return;
      }

      var method = instance[ methodName ];
      if ( !method || methodName.charAt(0) == '_' ) {
        logError( pluginMethodStr + ' is not a valid method' );
        return;
      }

      // apply method, get return value
      var value = method.apply( instance, args );
      // set return value if value is returned, use only first value
      returnValue = returnValue === undefined ? value : returnValue;
    });

    return returnValue !== undefined ? returnValue : $elems;
  }

  function plainCall( $elems, options ) {
    $elems.each( function( i, elem ) {
      var instance = $.data( elem, namespace );
      if ( instance ) {
        // set options & init
        instance.option( options );
        instance._init();
      } else {
        // initialize new instance
        instance = new PluginClass( elem, options );
        $.data( elem, namespace, instance );
      }
    });
  }

  updateJQuery( $ );

}

// ----- updateJQuery ----- //

// set $.bridget for v1 backwards compatibility
function updateJQuery( $ ) {
  if ( !$ || ( $ && $.bridget ) ) {
    return;
  }
  $.bridget = jQueryBridget;
}

updateJQuery( jQuery || window.jQuery );

// -----  ----- //

return jQueryBridget;

}));

/**
 * EvEmitter v1.0.2
 * Lil' event emitter
 * MIT License
 */

/* jshint unused: true, undef: true, strict: true */

( function( global, factory ) {
  // universal module definition
  /* jshint strict: false */ /* globals define, module */
  if ( typeof define == 'function' && define.amd ) {
    // AMD - RequireJS
    define( 'ev-emitter/ev-emitter',factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS - Browserify, Webpack
    module.exports = factory();
  } else {
    // Browser globals
    global.EvEmitter = factory();
  }

}( this, function() {



function EvEmitter() {}

var proto = EvEmitter.prototype;

proto.on = function( eventName, listener ) {
  if ( !eventName || !listener ) {
    return;
  }
  // set events hash
  var events = this._events = this._events || {};
  // set listeners array
  var listeners = events[ eventName ] = events[ eventName ] || [];
  // only add once
  if ( listeners.indexOf( listener ) == -1 ) {
    listeners.push( listener );
  }

  return this;
};

proto.once = function( eventName, listener ) {
  if ( !eventName || !listener ) {
    return;
  }
  // add event
  this.on( eventName, listener );
  // set once flag
  // set onceEvents hash
  var onceEvents = this._onceEvents = this._onceEvents || {};
  // set onceListeners object
  var onceListeners = onceEvents[ eventName ] = onceEvents[ eventName ] || {};
  // set flag
  onceListeners[ listener ] = true;

  return this;
};

proto.off = function( eventName, listener ) {
  var listeners = this._events && this._events[ eventName ];
  if ( !listeners || !listeners.length ) {
    return;
  }
  var index = listeners.indexOf( listener );
  if ( index != -1 ) {
    listeners.splice( index, 1 );
  }

  return this;
};

proto.emitEvent = function( eventName, args ) {
  var listeners = this._events && this._events[ eventName ];
  if ( !listeners || !listeners.length ) {
    return;
  }
  var i = 0;
  var listener = listeners[i];
  args = args || [];
  // once stuff
  var onceListeners = this._onceEvents && this._onceEvents[ eventName ];

  while ( listener ) {
    var isOnce = onceListeners && onceListeners[ listener ];
    if ( isOnce ) {
      // remove listener
      // remove before trigger to prevent recursion
      this.off( eventName, listener );
      // unset once flag
      delete onceListeners[ listener ];
    }
    // trigger listener
    listener.apply( this, args );
    // get next listener
    i += isOnce ? 0 : 1;
    listener = listeners[i];
  }

  return this;
};

return EvEmitter;

}));

/*!
 * getSize v2.0.2
 * measure size of elements
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, module: false, console: false */

( function( window, factory ) {
  'use strict';

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'get-size/get-size',[],function() {
      return factory();
    });
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory();
  } else {
    // browser global
    window.getSize = factory();
  }

})( window, function factory() {
'use strict';

// -------------------------- helpers -------------------------- //

// get a number from a string, not a percentage
function getStyleSize( value ) {
  var num = parseFloat( value );
  // not a percent like '100%', and a number
  var isValid = value.indexOf('%') == -1 && !isNaN( num );
  return isValid && num;
}

function noop() {}

var logError = typeof console == 'undefined' ? noop :
  function( message ) {
    console.error( message );
  };

// -------------------------- measurements -------------------------- //

var measurements = [
  'paddingLeft',
  'paddingRight',
  'paddingTop',
  'paddingBottom',
  'marginLeft',
  'marginRight',
  'marginTop',
  'marginBottom',
  'borderLeftWidth',
  'borderRightWidth',
  'borderTopWidth',
  'borderBottomWidth'
];

var measurementsLength = measurements.length;

function getZeroSize() {
  var size = {
    width: 0,
    height: 0,
    innerWidth: 0,
    innerHeight: 0,
    outerWidth: 0,
    outerHeight: 0
  };
  for ( var i=0; i < measurementsLength; i++ ) {
    var measurement = measurements[i];
    size[ measurement ] = 0;
  }
  return size;
}

// -------------------------- getStyle -------------------------- //

/**
 * getStyle, get style of element, check for Firefox bug
 * https://bugzilla.mozilla.org/show_bug.cgi?id=548397
 */
function getStyle( elem ) {
  var style = getComputedStyle( elem );
  if ( !style ) {
    logError( 'Style returned ' + style +
      '. Are you running this code in a hidden iframe on Firefox? ' +
      'See http://bit.ly/getsizebug1' );
  }
  return style;
}

// -------------------------- setup -------------------------- //

var isSetup = false;

var isBoxSizeOuter;

/**
 * setup
 * check isBoxSizerOuter
 * do on first getSize() rather than on page load for Firefox bug
 */
function setup() {
  // setup once
  if ( isSetup ) {
    return;
  }
  isSetup = true;

  // -------------------------- box sizing -------------------------- //

  /**
   * WebKit measures the outer-width on style.width on border-box elems
   * IE & Firefox<29 measures the inner-width
   */
  var div = document.createElement('div');
  div.style.width = '200px';
  div.style.padding = '1px 2px 3px 4px';
  div.style.borderStyle = 'solid';
  div.style.borderWidth = '1px 2px 3px 4px';
  div.style.boxSizing = 'border-box';

  var body = document.body || document.documentElement;
  body.appendChild( div );
  var style = getStyle( div );

  getSize.isBoxSizeOuter = isBoxSizeOuter = getStyleSize( style.width ) == 200;
  body.removeChild( div );

}

// -------------------------- getSize -------------------------- //

function getSize( elem ) {
  setup();

  // use querySeletor if elem is string
  if ( typeof elem == 'string' ) {
    elem = document.querySelector( elem );
  }

  // do not proceed on non-objects
  if ( !elem || typeof elem != 'object' || !elem.nodeType ) {
    return;
  }

  var style = getStyle( elem );

  // if hidden, everything is 0
  if ( style.display == 'none' ) {
    return getZeroSize();
  }

  var size = {};
  size.width = elem.offsetWidth;
  size.height = elem.offsetHeight;

  var isBorderBox = size.isBorderBox = style.boxSizing == 'border-box';

  // get all measurements
  for ( var i=0; i < measurementsLength; i++ ) {
    var measurement = measurements[i];
    var value = style[ measurement ];
    var num = parseFloat( value );
    // any 'auto', 'medium' value will be 0
    size[ measurement ] = !isNaN( num ) ? num : 0;
  }

  var paddingWidth = size.paddingLeft + size.paddingRight;
  var paddingHeight = size.paddingTop + size.paddingBottom;
  var marginWidth = size.marginLeft + size.marginRight;
  var marginHeight = size.marginTop + size.marginBottom;
  var borderWidth = size.borderLeftWidth + size.borderRightWidth;
  var borderHeight = size.borderTopWidth + size.borderBottomWidth;

  var isBorderBoxSizeOuter = isBorderBox && isBoxSizeOuter;

  // overwrite width and height if we can get it from style
  var styleWidth = getStyleSize( style.width );
  if ( styleWidth !== false ) {
    size.width = styleWidth +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingWidth + borderWidth );
  }

  var styleHeight = getStyleSize( style.height );
  if ( styleHeight !== false ) {
    size.height = styleHeight +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingHeight + borderHeight );
  }

  size.innerWidth = size.width - ( paddingWidth + borderWidth );
  size.innerHeight = size.height - ( paddingHeight + borderHeight );

  size.outerWidth = size.width + marginWidth;
  size.outerHeight = size.height + marginHeight;

  return size;
}

return getSize;

});

/**
 * matchesSelector v2.0.1
 * matchesSelector( element, '.selector' )
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */

( function( window, factory ) {
  /*global define: false, module: false */
  'use strict';
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'desandro-matches-selector/matches-selector',factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory();
  } else {
    // browser global
    window.matchesSelector = factory();
  }

}( window, function factory() {
  'use strict';

  var matchesMethod = ( function() {
    var ElemProto = Element.prototype;
    // check for the standard method name first
    if ( ElemProto.matches ) {
      return 'matches';
    }
    // check un-prefixed
    if ( ElemProto.matchesSelector ) {
      return 'matchesSelector';
    }
    // check vendor prefixes
    var prefixes = [ 'webkit', 'moz', 'ms', 'o' ];

    for ( var i=0; i < prefixes.length; i++ ) {
      var prefix = prefixes[i];
      var method = prefix + 'MatchesSelector';
      if ( ElemProto[ method ] ) {
        return method;
      }
    }
  })();

  return function matchesSelector( elem, selector ) {
    return elem[ matchesMethod ]( selector );
  };

}));

/**
 * Fizzy UI utils v2.0.1
 * MIT license
 */

/*jshint browser: true, undef: true, unused: true, strict: true */

( function( window, factory ) {
  // universal module definition
  /*jshint strict: false */ /*globals define, module, require */

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'fizzy-ui-utils/utils',[
      'desandro-matches-selector/matches-selector'
    ], function( matchesSelector ) {
      return factory( window, matchesSelector );
    });
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      window,
      require('desandro-matches-selector')
    );
  } else {
    // browser global
    window.fizzyUIUtils = factory(
      window,
      window.matchesSelector
    );
  }

}( window, function factory( window, matchesSelector ) {



var utils = {};

// ----- extend ----- //

// extends objects
utils.extend = function( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
};

// ----- modulo ----- //

utils.modulo = function( num, div ) {
  return ( ( num % div ) + div ) % div;
};

// ----- makeArray ----- //

// turn element or nodeList into an array
utils.makeArray = function( obj ) {
  var ary = [];
  if ( Array.isArray( obj ) ) {
    // use object if already an array
    ary = obj;
  } else if ( obj && typeof obj.length == 'number' ) {
    // convert nodeList to array
    for ( var i=0; i < obj.length; i++ ) {
      ary.push( obj[i] );
    }
  } else {
    // array of single index
    ary.push( obj );
  }
  return ary;
};

// ----- removeFrom ----- //

utils.removeFrom = function( ary, obj ) {
  var index = ary.indexOf( obj );
  if ( index != -1 ) {
    ary.splice( index, 1 );
  }
};

// ----- getParent ----- //

utils.getParent = function( elem, selector ) {
  while ( elem != document.body ) {
    elem = elem.parentNode;
    if ( matchesSelector( elem, selector ) ) {
      return elem;
    }
  }
};

// ----- getQueryElement ----- //

// use element as selector string
utils.getQueryElement = function( elem ) {
  if ( typeof elem == 'string' ) {
    return document.querySelector( elem );
  }
  return elem;
};

// ----- handleEvent ----- //

// enable .ontype to trigger from .addEventListener( elem, 'type' )
utils.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

// ----- filterFindElements ----- //

utils.filterFindElements = function( elems, selector ) {
  // make array of elems
  elems = utils.makeArray( elems );
  var ffElems = [];

  elems.forEach( function( elem ) {
    // check that elem is an actual element
    if ( !( elem instanceof HTMLElement ) ) {
      return;
    }
    // add elem if no selector
    if ( !selector ) {
      ffElems.push( elem );
      return;
    }
    // filter & find items if we have a selector
    // filter
    if ( matchesSelector( elem, selector ) ) {
      ffElems.push( elem );
    }
    // find children
    var childElems = elem.querySelectorAll( selector );
    // concat childElems to filterFound array
    for ( var i=0; i < childElems.length; i++ ) {
      ffElems.push( childElems[i] );
    }
  });

  return ffElems;
};

// ----- debounceMethod ----- //

utils.debounceMethod = function( _class, methodName, threshold ) {
  // original method
  var method = _class.prototype[ methodName ];
  var timeoutName = methodName + 'Timeout';

  _class.prototype[ methodName ] = function() {
    var timeout = this[ timeoutName ];
    if ( timeout ) {
      clearTimeout( timeout );
    }
    var args = arguments;

    var _this = this;
    this[ timeoutName ] = setTimeout( function() {
      method.apply( _this, args );
      delete _this[ timeoutName ];
    }, threshold || 100 );
  };
};

// ----- docReady ----- //

utils.docReady = function( callback ) {
  if ( document.readyState == 'complete' ) {
    callback();
  } else {
    document.addEventListener( 'DOMContentLoaded', callback );
  }
};

// ----- htmlInit ----- //

// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
utils.toDashed = function( str ) {
  return str.replace( /(.)([A-Z])/g, function( match, $1, $2 ) {
    return $1 + '-' + $2;
  }).toLowerCase();
};

var console = window.console;
/**
 * allow user to initialize classes via [data-namespace] or .js-namespace class
 * htmlInit( Widget, 'widgetName' )
 * options are parsed from data-namespace-options
 */
utils.htmlInit = function( WidgetClass, namespace ) {
  utils.docReady( function() {
    var dashedNamespace = utils.toDashed( namespace );
    var dataAttr = 'data-' + dashedNamespace;
    var dataAttrElems = document.querySelectorAll( '[' + dataAttr + ']' );
    var jsDashElems = document.querySelectorAll( '.js-' + dashedNamespace );
    var elems = utils.makeArray( dataAttrElems )
      .concat( utils.makeArray( jsDashElems ) );
    var dataOptionsAttr = dataAttr + '-options';
    var jQuery = window.jQuery;

    elems.forEach( function( elem ) {
      var attr = elem.getAttribute( dataAttr ) ||
        elem.getAttribute( dataOptionsAttr );
      var options;
      try {
        options = attr && JSON.parse( attr );
      } catch ( error ) {
        // log error, do not initialize
        if ( console ) {
          console.error( 'Error parsing ' + dataAttr + ' on ' + elem.className +
          ': ' + error );
        }
        return;
      }
      // initialize
      var instance = new WidgetClass( elem, options );
      // make available via $().data('layoutname')
      if ( jQuery ) {
        jQuery.data( elem, namespace, instance );
      }
    });

  });
};

// -----  ----- //

return utils;

}));

/**
 * Outlayer Item
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /* globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD - RequireJS
    define( 'outlayer/item',[
        'ev-emitter/ev-emitter',
        'get-size/get-size'
      ],
      factory
    );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS - Browserify, Webpack
    module.exports = factory(
      require('ev-emitter'),
      require('get-size')
    );
  } else {
    // browser global
    window.Outlayer = {};
    window.Outlayer.Item = factory(
      window.EvEmitter,
      window.getSize
    );
  }

}( window, function factory( EvEmitter, getSize ) {
'use strict';

// ----- helpers ----- //

function isEmptyObj( obj ) {
  for ( var prop in obj ) {
    return false;
  }
  prop = null;
  return true;
}

// -------------------------- CSS3 support -------------------------- //


var docElemStyle = document.documentElement.style;

var transitionProperty = typeof docElemStyle.transition == 'string' ?
  'transition' : 'WebkitTransition';
var transformProperty = typeof docElemStyle.transform == 'string' ?
  'transform' : 'WebkitTransform';

var transitionEndEvent = {
  WebkitTransition: 'webkitTransitionEnd',
  transition: 'transitionend'
}[ transitionProperty ];

// cache all vendor properties that could have vendor prefix
var vendorProperties = {
  transform: transformProperty,
  transition: transitionProperty,
  transitionDuration: transitionProperty + 'Duration',
  transitionProperty: transitionProperty + 'Property',
  transitionDelay: transitionProperty + 'Delay'
};

// -------------------------- Item -------------------------- //

function Item( element, layout ) {
  if ( !element ) {
    return;
  }

  this.element = element;
  // parent layout class, i.e. Masonry, Isotope, or Packery
  this.layout = layout;
  this.position = {
    x: 0,
    y: 0
  };

  this._create();
}

// inherit EvEmitter
var proto = Item.prototype = Object.create( EvEmitter.prototype );
proto.constructor = Item;

proto._create = function() {
  // transition objects
  this._transn = {
    ingProperties: {},
    clean: {},
    onEnd: {}
  };

  this.css({
    position: 'absolute'
  });
};

// trigger specified handler for event type
proto.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

proto.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * apply CSS styles to element
 * @param {Object} style
 */
proto.css = function( style ) {
  var elemStyle = this.element.style;

  for ( var prop in style ) {
    // use vendor property if available
    var supportedProp = vendorProperties[ prop ] || prop;
    elemStyle[ supportedProp ] = style[ prop ];
  }
};

 // measure position, and sets it
proto.getPosition = function() {
  var style = getComputedStyle( this.element );
  var isOriginLeft = this.layout._getOption('originLeft');
  var isOriginTop = this.layout._getOption('originTop');
  var xValue = style[ isOriginLeft ? 'left' : 'right' ];
  var yValue = style[ isOriginTop ? 'top' : 'bottom' ];
  // convert percent to pixels
  var layoutSize = this.layout.size;
  var x = xValue.indexOf('%') != -1 ?
    ( parseFloat( xValue ) / 100 ) * layoutSize.width : parseInt( xValue, 10 );
  var y = yValue.indexOf('%') != -1 ?
    ( parseFloat( yValue ) / 100 ) * layoutSize.height : parseInt( yValue, 10 );

  // clean up 'auto' or other non-integer values
  x = isNaN( x ) ? 0 : x;
  y = isNaN( y ) ? 0 : y;
  // remove padding from measurement
  x -= isOriginLeft ? layoutSize.paddingLeft : layoutSize.paddingRight;
  y -= isOriginTop ? layoutSize.paddingTop : layoutSize.paddingBottom;

  this.position.x = x;
  this.position.y = y;
};

// set settled position, apply padding
proto.layoutPosition = function() {
  var layoutSize = this.layout.size;
  var style = {};
  var isOriginLeft = this.layout._getOption('originLeft');
  var isOriginTop = this.layout._getOption('originTop');

  // x
  var xPadding = isOriginLeft ? 'paddingLeft' : 'paddingRight';
  var xProperty = isOriginLeft ? 'left' : 'right';
  var xResetProperty = isOriginLeft ? 'right' : 'left';

  var x = this.position.x + layoutSize[ xPadding ];
  // set in percentage or pixels
  style[ xProperty ] = this.getXValue( x );
  // reset other property
  style[ xResetProperty ] = '';

  // y
  var yPadding = isOriginTop ? 'paddingTop' : 'paddingBottom';
  var yProperty = isOriginTop ? 'top' : 'bottom';
  var yResetProperty = isOriginTop ? 'bottom' : 'top';

  var y = this.position.y + layoutSize[ yPadding ];
  // set in percentage or pixels
  style[ yProperty ] = this.getYValue( y );
  // reset other property
  style[ yResetProperty ] = '';

  this.css( style );
  this.emitEvent( 'layout', [ this ] );
};

proto.getXValue = function( x ) {
  var isHorizontal = this.layout._getOption('horizontal');
  return this.layout.options.percentPosition && !isHorizontal ?
    ( ( x / this.layout.size.width ) * 100 ) + '%' : x + 'px';
};

proto.getYValue = function( y ) {
  var isHorizontal = this.layout._getOption('horizontal');
  return this.layout.options.percentPosition && isHorizontal ?
    ( ( y / this.layout.size.height ) * 100 ) + '%' : y + 'px';
};

proto._transitionTo = function( x, y ) {
  this.getPosition();
  // get current x & y from top/left
  var curX = this.position.x;
  var curY = this.position.y;

  var compareX = parseInt( x, 10 );
  var compareY = parseInt( y, 10 );
  var didNotMove = compareX === this.position.x && compareY === this.position.y;

  // save end position
  this.setPosition( x, y );

  // if did not move and not transitioning, just go to layout
  if ( didNotMove && !this.isTransitioning ) {
    this.layoutPosition();
    return;
  }

  var transX = x - curX;
  var transY = y - curY;
  var transitionStyle = {};
  transitionStyle.transform = this.getTranslate( transX, transY );

  this.transition({
    to: transitionStyle,
    onTransitionEnd: {
      transform: this.layoutPosition
    },
    isCleaning: true
  });
};

proto.getTranslate = function( x, y ) {
  // flip cooridinates if origin on right or bottom
  var isOriginLeft = this.layout._getOption('originLeft');
  var isOriginTop = this.layout._getOption('originTop');
  x = isOriginLeft ? x : -x;
  y = isOriginTop ? y : -y;
  return 'translate3d(' + x + 'px, ' + y + 'px, 0)';
};

// non transition + transform support
proto.goTo = function( x, y ) {
  this.setPosition( x, y );
  this.layoutPosition();
};

proto.moveTo = proto._transitionTo;

proto.setPosition = function( x, y ) {
  this.position.x = parseInt( x, 10 );
  this.position.y = parseInt( y, 10 );
};

// ----- transition ----- //

/**
 * @param {Object} style - CSS
 * @param {Function} onTransitionEnd
 */

// non transition, just trigger callback
proto._nonTransition = function( args ) {
  this.css( args.to );
  if ( args.isCleaning ) {
    this._removeStyles( args.to );
  }
  for ( var prop in args.onTransitionEnd ) {
    args.onTransitionEnd[ prop ].call( this );
  }
};

/**
 * proper transition
 * @param {Object} args - arguments
 *   @param {Object} to - style to transition to
 *   @param {Object} from - style to start transition from
 *   @param {Boolean} isCleaning - removes transition styles after transition
 *   @param {Function} onTransitionEnd - callback
 */
proto.transition = function( args ) {
  // redirect to nonTransition if no transition duration
  if ( !parseFloat( this.layout.options.transitionDuration ) ) {
    this._nonTransition( args );
    return;
  }

  var _transition = this._transn;
  // keep track of onTransitionEnd callback by css property
  for ( var prop in args.onTransitionEnd ) {
    _transition.onEnd[ prop ] = args.onTransitionEnd[ prop ];
  }
  // keep track of properties that are transitioning
  for ( prop in args.to ) {
    _transition.ingProperties[ prop ] = true;
    // keep track of properties to clean up when transition is done
    if ( args.isCleaning ) {
      _transition.clean[ prop ] = true;
    }
  }

  // set from styles
  if ( args.from ) {
    this.css( args.from );
    // force redraw. http://blog.alexmaccaw.com/css-transitions
    var h = this.element.offsetHeight;
    // hack for JSHint to hush about unused var
    h = null;
  }
  // enable transition
  this.enableTransition( args.to );
  // set styles that are transitioning
  this.css( args.to );

  this.isTransitioning = true;

};

// dash before all cap letters, including first for
// WebkitTransform => -webkit-transform
function toDashedAll( str ) {
  return str.replace( /([A-Z])/g, function( $1 ) {
    return '-' + $1.toLowerCase();
  });
}

var transitionProps = 'opacity,' + toDashedAll( transformProperty );

proto.enableTransition = function(/* style */) {
  // HACK changing transitionProperty during a transition
  // will cause transition to jump
  if ( this.isTransitioning ) {
    return;
  }

  // make `transition: foo, bar, baz` from style object
  // HACK un-comment this when enableTransition can work
  // while a transition is happening
  // var transitionValues = [];
  // for ( var prop in style ) {
  //   // dash-ify camelCased properties like WebkitTransition
  //   prop = vendorProperties[ prop ] || prop;
  //   transitionValues.push( toDashedAll( prop ) );
  // }
  // munge number to millisecond, to match stagger
  var duration = this.layout.options.transitionDuration;
  duration = typeof duration == 'number' ? duration + 'ms' : duration;
  // enable transition styles
  this.css({
    transitionProperty: transitionProps,
    transitionDuration: duration,
    transitionDelay: this.staggerDelay || 0
  });
  // listen for transition end event
  this.element.addEventListener( transitionEndEvent, this, false );
};

// ----- events ----- //

proto.onwebkitTransitionEnd = function( event ) {
  this.ontransitionend( event );
};

proto.onotransitionend = function( event ) {
  this.ontransitionend( event );
};

// properties that I munge to make my life easier
var dashedVendorProperties = {
  '-webkit-transform': 'transform'
};

proto.ontransitionend = function( event ) {
  // disregard bubbled events from children
  if ( event.target !== this.element ) {
    return;
  }
  var _transition = this._transn;
  // get property name of transitioned property, convert to prefix-free
  var propertyName = dashedVendorProperties[ event.propertyName ] || event.propertyName;

  // remove property that has completed transitioning
  delete _transition.ingProperties[ propertyName ];
  // check if any properties are still transitioning
  if ( isEmptyObj( _transition.ingProperties ) ) {
    // all properties have completed transitioning
    this.disableTransition();
  }
  // clean style
  if ( propertyName in _transition.clean ) {
    // clean up style
    this.element.style[ event.propertyName ] = '';
    delete _transition.clean[ propertyName ];
  }
  // trigger onTransitionEnd callback
  if ( propertyName in _transition.onEnd ) {
    var onTransitionEnd = _transition.onEnd[ propertyName ];
    onTransitionEnd.call( this );
    delete _transition.onEnd[ propertyName ];
  }

  this.emitEvent( 'transitionEnd', [ this ] );
};

proto.disableTransition = function() {
  this.removeTransitionStyles();
  this.element.removeEventListener( transitionEndEvent, this, false );
  this.isTransitioning = false;
};

/**
 * removes style property from element
 * @param {Object} style
**/
proto._removeStyles = function( style ) {
  // clean up transition styles
  var cleanStyle = {};
  for ( var prop in style ) {
    cleanStyle[ prop ] = '';
  }
  this.css( cleanStyle );
};

var cleanTransitionStyle = {
  transitionProperty: '',
  transitionDuration: '',
  transitionDelay: ''
};

proto.removeTransitionStyles = function() {
  // remove transition
  this.css( cleanTransitionStyle );
};

// ----- stagger ----- //

proto.stagger = function( delay ) {
  delay = isNaN( delay ) ? 0 : delay;
  this.staggerDelay = delay + 'ms';
};

// ----- show/hide/remove ----- //

// remove element from DOM
proto.removeElem = function() {
  this.element.parentNode.removeChild( this.element );
  // remove display: none
  this.css({ display: '' });
  this.emitEvent( 'remove', [ this ] );
};

proto.remove = function() {
  // just remove element if no transition support or no transition
  if ( !transitionProperty || !parseFloat( this.layout.options.transitionDuration ) ) {
    this.removeElem();
    return;
  }

  // start transition
  this.once( 'transitionEnd', function() {
    this.removeElem();
  });
  this.hide();
};

proto.reveal = function() {
  delete this.isHidden;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;

  var onTransitionEnd = {};
  var transitionEndProperty = this.getHideRevealTransitionEndProperty('visibleStyle');
  onTransitionEnd[ transitionEndProperty ] = this.onRevealTransitionEnd;

  this.transition({
    from: options.hiddenStyle,
    to: options.visibleStyle,
    isCleaning: true,
    onTransitionEnd: onTransitionEnd
  });
};

proto.onRevealTransitionEnd = function() {
  // check if still visible
  // during transition, item may have been hidden
  if ( !this.isHidden ) {
    this.emitEvent('reveal');
  }
};

/**
 * get style property use for hide/reveal transition end
 * @param {String} styleProperty - hiddenStyle/visibleStyle
 * @returns {String}
 */
proto.getHideRevealTransitionEndProperty = function( styleProperty ) {
  var optionStyle = this.layout.options[ styleProperty ];
  // use opacity
  if ( optionStyle.opacity ) {
    return 'opacity';
  }
  // get first property
  for ( var prop in optionStyle ) {
    return prop;
  }
};

proto.hide = function() {
  // set flag
  this.isHidden = true;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;

  var onTransitionEnd = {};
  var transitionEndProperty = this.getHideRevealTransitionEndProperty('hiddenStyle');
  onTransitionEnd[ transitionEndProperty ] = this.onHideTransitionEnd;

  this.transition({
    from: options.visibleStyle,
    to: options.hiddenStyle,
    // keep hidden stuff hidden
    isCleaning: true,
    onTransitionEnd: onTransitionEnd
  });
};

proto.onHideTransitionEnd = function() {
  // check if still hidden
  // during transition, item may have been un-hidden
  if ( this.isHidden ) {
    this.css({ display: 'none' });
    this.emitEvent('hide');
  }
};

proto.destroy = function() {
  this.css({
    position: '',
    left: '',
    right: '',
    top: '',
    bottom: '',
    transition: '',
    transform: ''
  });
};

return Item;

}));

/*!
 * Outlayer v2.1.0
 * the brains and guts of a layout library
 * MIT license
 */

( function( window, factory ) {
  'use strict';
  // universal module definition
  /* jshint strict: false */ /* globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD - RequireJS
    define( 'outlayer/outlayer',[
        'ev-emitter/ev-emitter',
        'get-size/get-size',
        'fizzy-ui-utils/utils',
        './item'
      ],
      function( EvEmitter, getSize, utils, Item ) {
        return factory( window, EvEmitter, getSize, utils, Item);
      }
    );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS - Browserify, Webpack
    module.exports = factory(
      window,
      require('ev-emitter'),
      require('get-size'),
      require('fizzy-ui-utils'),
      require('./item')
    );
  } else {
    // browser global
    window.Outlayer = factory(
      window,
      window.EvEmitter,
      window.getSize,
      window.fizzyUIUtils,
      window.Outlayer.Item
    );
  }

}( window, function factory( window, EvEmitter, getSize, utils, Item ) {
'use strict';

// ----- vars ----- //

var console = window.console;
var jQuery = window.jQuery;
var noop = function() {};

// -------------------------- Outlayer -------------------------- //

// globally unique identifiers
var GUID = 0;
// internal store of all Outlayer intances
var instances = {};


/**
 * @param {Element, String} element
 * @param {Object} options
 * @constructor
 */
function Outlayer( element, options ) {
  var queryElement = utils.getQueryElement( element );
  if ( !queryElement ) {
    if ( console ) {
      console.error( 'Bad element for ' + this.constructor.namespace +
        ': ' + ( queryElement || element ) );
    }
    return;
  }
  this.element = queryElement;
  // add jQuery
  if ( jQuery ) {
    this.$element = jQuery( this.element );
  }

  // options
  this.options = utils.extend( {}, this.constructor.defaults );
  this.option( options );

  // add id for Outlayer.getFromElement
  var id = ++GUID;
  this.element.outlayerGUID = id; // expando
  instances[ id ] = this; // associate via id

  // kick it off
  this._create();

  var isInitLayout = this._getOption('initLayout');
  if ( isInitLayout ) {
    this.layout();
  }
}

// settings are for internal use only
Outlayer.namespace = 'outlayer';
Outlayer.Item = Item;

// default options
Outlayer.defaults = {
  containerStyle: {
    position: 'relative'
  },
  initLayout: true,
  originLeft: true,
  originTop: true,
  resize: true,
  resizeContainer: true,
  // item options
  transitionDuration: '0.4s',
  hiddenStyle: {
    opacity: 0,
    transform: 'scale(0.001)'
  },
  visibleStyle: {
    opacity: 1,
    transform: 'scale(1)'
  }
};

var proto = Outlayer.prototype;
// inherit EvEmitter
utils.extend( proto, EvEmitter.prototype );

/**
 * set options
 * @param {Object} opts
 */
proto.option = function( opts ) {
  utils.extend( this.options, opts );
};

/**
 * get backwards compatible option value, check old name
 */
proto._getOption = function( option ) {
  var oldOption = this.constructor.compatOptions[ option ];
  return oldOption && this.options[ oldOption ] !== undefined ?
    this.options[ oldOption ] : this.options[ option ];
};

Outlayer.compatOptions = {
  // currentName: oldName
  initLayout: 'isInitLayout',
  horizontal: 'isHorizontal',
  layoutInstant: 'isLayoutInstant',
  originLeft: 'isOriginLeft',
  originTop: 'isOriginTop',
  resize: 'isResizeBound',
  resizeContainer: 'isResizingContainer'
};

proto._create = function() {
  // get items from children
  this.reloadItems();
  // elements that affect layout, but are not laid out
  this.stamps = [];
  this.stamp( this.options.stamp );
  // set container style
  utils.extend( this.element.style, this.options.containerStyle );

  // bind resize method
  var canBindResize = this._getOption('resize');
  if ( canBindResize ) {
    this.bindResize();
  }
};

// goes through all children again and gets bricks in proper order
proto.reloadItems = function() {
  // collection of item elements
  this.items = this._itemize( this.element.children );
};


/**
 * turn elements into Outlayer.Items to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - collection of new Outlayer Items
 */
proto._itemize = function( elems ) {

  var itemElems = this._filterFindItemElements( elems );
  var Item = this.constructor.Item;

  // create new Outlayer Items for collection
  var items = [];
  for ( var i=0; i < itemElems.length; i++ ) {
    var elem = itemElems[i];
    var item = new Item( elem, this );
    items.push( item );
  }

  return items;
};

/**
 * get item elements to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - item elements
 */
proto._filterFindItemElements = function( elems ) {
  return utils.filterFindElements( elems, this.options.itemSelector );
};

/**
 * getter method for getting item elements
 * @returns {Array} elems - collection of item elements
 */
proto.getItemElements = function() {
  return this.items.map( function( item ) {
    return item.element;
  });
};

// ----- init & layout ----- //

/**
 * lays out all items
 */
proto.layout = function() {
  this._resetLayout();
  this._manageStamps();

  // don't animate first layout
  var layoutInstant = this._getOption('layoutInstant');
  var isInstant = layoutInstant !== undefined ?
    layoutInstant : !this._isLayoutInited;
  this.layoutItems( this.items, isInstant );

  // flag for initalized
  this._isLayoutInited = true;
};

// _init is alias for layout
proto._init = proto.layout;

/**
 * logic before any new layout
 */
proto._resetLayout = function() {
  this.getSize();
};


proto.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * get measurement from option, for columnWidth, rowHeight, gutter
 * if option is String -> get element from selector string, & get size of element
 * if option is Element -> get size of element
 * else use option as a number
 *
 * @param {String} measurement
 * @param {String} size - width or height
 * @private
 */
proto._getMeasurement = function( measurement, size ) {
  var option = this.options[ measurement ];
  var elem;
  if ( !option ) {
    // default to 0
    this[ measurement ] = 0;
  } else {
    // use option as an element
    if ( typeof option == 'string' ) {
      elem = this.element.querySelector( option );
    } else if ( option instanceof HTMLElement ) {
      elem = option;
    }
    // use size of element, if element
    this[ measurement ] = elem ? getSize( elem )[ size ] : option;
  }
};

/**
 * layout a collection of item elements
 * @api public
 */
proto.layoutItems = function( items, isInstant ) {
  items = this._getItemsForLayout( items );

  this._layoutItems( items, isInstant );

  this._postLayout();
};

/**
 * get the items to be laid out
 * you may want to skip over some items
 * @param {Array} items
 * @returns {Array} items
 */
proto._getItemsForLayout = function( items ) {
  return items.filter( function( item ) {
    return !item.isIgnored;
  });
};

/**
 * layout items
 * @param {Array} items
 * @param {Boolean} isInstant
 */
proto._layoutItems = function( items, isInstant ) {
  this._emitCompleteOnItems( 'layout', items );

  if ( !items || !items.length ) {
    // no items, emit event with empty array
    return;
  }

  var queue = [];

  items.forEach( function( item ) {
    // get x/y object from method
    var position = this._getItemLayoutPosition( item );
    // enqueue
    position.item = item;
    position.isInstant = isInstant || item.isLayoutInstant;
    queue.push( position );
  }, this );

  this._processLayoutQueue( queue );
};

/**
 * get item layout position
 * @param {Outlayer.Item} item
 * @returns {Object} x and y position
 */
proto._getItemLayoutPosition = function( /* item */ ) {
  return {
    x: 0,
    y: 0
  };
};

/**
 * iterate over array and position each item
 * Reason being - separating this logic prevents 'layout invalidation'
 * thx @paul_irish
 * @param {Array} queue
 */
proto._processLayoutQueue = function( queue ) {
  this.updateStagger();
  queue.forEach( function( obj, i ) {
    this._positionItem( obj.item, obj.x, obj.y, obj.isInstant, i );
  }, this );
};

// set stagger from option in milliseconds number
proto.updateStagger = function() {
  var stagger = this.options.stagger;
  if ( stagger === null || stagger === undefined ) {
    this.stagger = 0;
    return;
  }
  this.stagger = getMilliseconds( stagger );
  return this.stagger;
};

/**
 * Sets position of item in DOM
 * @param {Outlayer.Item} item
 * @param {Number} x - horizontal position
 * @param {Number} y - vertical position
 * @param {Boolean} isInstant - disables transitions
 */
proto._positionItem = function( item, x, y, isInstant, i ) {
  if ( isInstant ) {
    // if not transition, just set CSS
    item.goTo( x, y );
  } else {
    item.stagger( i * this.stagger );
    item.moveTo( x, y );
  }
};

/**
 * Any logic you want to do after each layout,
 * i.e. size the container
 */
proto._postLayout = function() {
  this.resizeContainer();
};

proto.resizeContainer = function() {
  var isResizingContainer = this._getOption('resizeContainer');
  if ( !isResizingContainer ) {
    return;
  }
  var size = this._getContainerSize();
  if ( size ) {
    this._setContainerMeasure( size.width, true );
    this._setContainerMeasure( size.height, false );
  }
};

/**
 * Sets width or height of container if returned
 * @returns {Object} size
 *   @param {Number} width
 *   @param {Number} height
 */
proto._getContainerSize = noop;

/**
 * @param {Number} measure - size of width or height
 * @param {Boolean} isWidth
 */
proto._setContainerMeasure = function( measure, isWidth ) {
  if ( measure === undefined ) {
    return;
  }

  var elemSize = this.size;
  // add padding and border width if border box
  if ( elemSize.isBorderBox ) {
    measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
      elemSize.borderLeftWidth + elemSize.borderRightWidth :
      elemSize.paddingBottom + elemSize.paddingTop +
      elemSize.borderTopWidth + elemSize.borderBottomWidth;
  }

  measure = Math.max( measure, 0 );
  this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
};

/**
 * emit eventComplete on a collection of items events
 * @param {String} eventName
 * @param {Array} items - Outlayer.Items
 */
proto._emitCompleteOnItems = function( eventName, items ) {
  var _this = this;
  function onComplete() {
    _this.dispatchEvent( eventName + 'Complete', null, [ items ] );
  }

  var count = items.length;
  if ( !items || !count ) {
    onComplete();
    return;
  }

  var doneCount = 0;
  function tick() {
    doneCount++;
    if ( doneCount == count ) {
      onComplete();
    }
  }

  // bind callback
  items.forEach( function( item ) {
    item.once( eventName, tick );
  });
};

/**
 * emits events via EvEmitter and jQuery events
 * @param {String} type - name of event
 * @param {Event} event - original event
 * @param {Array} args - extra arguments
 */
proto.dispatchEvent = function( type, event, args ) {
  // add original event to arguments
  var emitArgs = event ? [ event ].concat( args ) : args;
  this.emitEvent( type, emitArgs );

  if ( jQuery ) {
    // set this.$element
    this.$element = this.$element || jQuery( this.element );
    if ( event ) {
      // create jQuery event
      var $event = jQuery.Event( event );
      $event.type = type;
      this.$element.trigger( $event, args );
    } else {
      // just trigger with type if no event available
      this.$element.trigger( type, args );
    }
  }
};

// -------------------------- ignore & stamps -------------------------- //


/**
 * keep item in collection, but do not lay it out
 * ignored items do not get skipped in layout
 * @param {Element} elem
 */
proto.ignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    item.isIgnored = true;
  }
};

/**
 * return item to layout collection
 * @param {Element} elem
 */
proto.unignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    delete item.isIgnored;
  }
};

/**
 * adds elements to stamps
 * @param {NodeList, Array, Element, or String} elems
 */
proto.stamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ) {
    return;
  }

  this.stamps = this.stamps.concat( elems );
  // ignore
  elems.forEach( this.ignore, this );
};

/**
 * removes elements to stamps
 * @param {NodeList, Array, or Element} elems
 */
proto.unstamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ){
    return;
  }

  elems.forEach( function( elem ) {
    // filter out removed stamp elements
    utils.removeFrom( this.stamps, elem );
    this.unignore( elem );
  }, this );
};

/**
 * finds child elements
 * @param {NodeList, Array, Element, or String} elems
 * @returns {Array} elems
 */
proto._find = function( elems ) {
  if ( !elems ) {
    return;
  }
  // if string, use argument as selector string
  if ( typeof elems == 'string' ) {
    elems = this.element.querySelectorAll( elems );
  }
  elems = utils.makeArray( elems );
  return elems;
};

proto._manageStamps = function() {
  if ( !this.stamps || !this.stamps.length ) {
    return;
  }

  this._getBoundingRect();

  this.stamps.forEach( this._manageStamp, this );
};

// update boundingLeft / Top
proto._getBoundingRect = function() {
  // get bounding rect for container element
  var boundingRect = this.element.getBoundingClientRect();
  var size = this.size;
  this._boundingRect = {
    left: boundingRect.left + size.paddingLeft + size.borderLeftWidth,
    top: boundingRect.top + size.paddingTop + size.borderTopWidth,
    right: boundingRect.right - ( size.paddingRight + size.borderRightWidth ),
    bottom: boundingRect.bottom - ( size.paddingBottom + size.borderBottomWidth )
  };
};

/**
 * @param {Element} stamp
**/
proto._manageStamp = noop;

/**
 * get x/y position of element relative to container element
 * @param {Element} elem
 * @returns {Object} offset - has left, top, right, bottom
 */
proto._getElementOffset = function( elem ) {
  var boundingRect = elem.getBoundingClientRect();
  var thisRect = this._boundingRect;
  var size = getSize( elem );
  var offset = {
    left: boundingRect.left - thisRect.left - size.marginLeft,
    top: boundingRect.top - thisRect.top - size.marginTop,
    right: thisRect.right - boundingRect.right - size.marginRight,
    bottom: thisRect.bottom - boundingRect.bottom - size.marginBottom
  };
  return offset;
};

// -------------------------- resize -------------------------- //

// enable event handlers for listeners
// i.e. resize -> onresize
proto.handleEvent = utils.handleEvent;

/**
 * Bind layout to window resizing
 */
proto.bindResize = function() {
  window.addEventListener( 'resize', this );
  this.isResizeBound = true;
};

/**
 * Unbind layout to window resizing
 */
proto.unbindResize = function() {
  window.removeEventListener( 'resize', this );
  this.isResizeBound = false;
};

proto.onresize = function() {
  this.resize();
};

utils.debounceMethod( Outlayer, 'onresize', 100 );

proto.resize = function() {
  // don't trigger if size did not change
  // or if resize was unbound. See #9
  if ( !this.isResizeBound || !this.needsResizeLayout() ) {
    return;
  }

  this.layout();
};

/**
 * check if layout is needed post layout
 * @returns Boolean
 */
proto.needsResizeLayout = function() {
  var size = getSize( this.element );
  // check that this.size and size are there
  // IE8 triggers resize on body size change, so they might not be
  var hasSizes = this.size && size;
  return hasSizes && size.innerWidth !== this.size.innerWidth;
};

// -------------------------- methods -------------------------- //

/**
 * add items to Outlayer instance
 * @param {Array or NodeList or Element} elems
 * @returns {Array} items - Outlayer.Items
**/
proto.addItems = function( elems ) {
  var items = this._itemize( elems );
  // add items to collection
  if ( items.length ) {
    this.items = this.items.concat( items );
  }
  return items;
};

/**
 * Layout newly-appended item elements
 * @param {Array or NodeList or Element} elems
 */
proto.appended = function( elems ) {
  var items = this.addItems( elems );
  if ( !items.length ) {
    return;
  }
  // layout and reveal just the new items
  this.layoutItems( items, true );
  this.reveal( items );
};

/**
 * Layout prepended elements
 * @param {Array or NodeList or Element} elems
 */
proto.prepended = function( elems ) {
  var items = this._itemize( elems );
  if ( !items.length ) {
    return;
  }
  // add items to beginning of collection
  var previousItems = this.items.slice(0);
  this.items = items.concat( previousItems );
  // start new layout
  this._resetLayout();
  this._manageStamps();
  // layout new stuff without transition
  this.layoutItems( items, true );
  this.reveal( items );
  // layout previous items
  this.layoutItems( previousItems );
};

/**
 * reveal a collection of items
 * @param {Array of Outlayer.Items} items
 */
proto.reveal = function( items ) {
  this._emitCompleteOnItems( 'reveal', items );
  if ( !items || !items.length ) {
    return;
  }
  var stagger = this.updateStagger();
  items.forEach( function( item, i ) {
    item.stagger( i * stagger );
    item.reveal();
  });
};

/**
 * hide a collection of items
 * @param {Array of Outlayer.Items} items
 */
proto.hide = function( items ) {
  this._emitCompleteOnItems( 'hide', items );
  if ( !items || !items.length ) {
    return;
  }
  var stagger = this.updateStagger();
  items.forEach( function( item, i ) {
    item.stagger( i * stagger );
    item.hide();
  });
};

/**
 * reveal item elements
 * @param {Array}, {Element}, {NodeList} items
 */
proto.revealItemElements = function( elems ) {
  var items = this.getItems( elems );
  this.reveal( items );
};

/**
 * hide item elements
 * @param {Array}, {Element}, {NodeList} items
 */
proto.hideItemElements = function( elems ) {
  var items = this.getItems( elems );
  this.hide( items );
};

/**
 * get Outlayer.Item, given an Element
 * @param {Element} elem
 * @param {Function} callback
 * @returns {Outlayer.Item} item
 */
proto.getItem = function( elem ) {
  // loop through items to get the one that matches
  for ( var i=0; i < this.items.length; i++ ) {
    var item = this.items[i];
    if ( item.element == elem ) {
      // return item
      return item;
    }
  }
};

/**
 * get collection of Outlayer.Items, given Elements
 * @param {Array} elems
 * @returns {Array} items - Outlayer.Items
 */
proto.getItems = function( elems ) {
  elems = utils.makeArray( elems );
  var items = [];
  elems.forEach( function( elem ) {
    var item = this.getItem( elem );
    if ( item ) {
      items.push( item );
    }
  }, this );

  return items;
};

/**
 * remove element(s) from instance and DOM
 * @param {Array or NodeList or Element} elems
 */
proto.remove = function( elems ) {
  var removeItems = this.getItems( elems );

  this._emitCompleteOnItems( 'remove', removeItems );

  // bail if no items to remove
  if ( !removeItems || !removeItems.length ) {
    return;
  }

  removeItems.forEach( function( item ) {
    item.remove();
    // remove item from collection
    utils.removeFrom( this.items, item );
  }, this );
};

// ----- destroy ----- //

// remove and disable Outlayer instance
proto.destroy = function() {
  // clean up dynamic styles
  var style = this.element.style;
  style.height = '';
  style.position = '';
  style.width = '';
  // destroy items
  this.items.forEach( function( item ) {
    item.destroy();
  });

  this.unbindResize();

  var id = this.element.outlayerGUID;
  delete instances[ id ]; // remove reference to instance by id
  delete this.element.outlayerGUID;
  // remove data for jQuery
  if ( jQuery ) {
    jQuery.removeData( this.element, this.constructor.namespace );
  }

};

// -------------------------- data -------------------------- //

/**
 * get Outlayer instance from element
 * @param {Element} elem
 * @returns {Outlayer}
 */
Outlayer.data = function( elem ) {
  elem = utils.getQueryElement( elem );
  var id = elem && elem.outlayerGUID;
  return id && instances[ id ];
};


// -------------------------- create Outlayer class -------------------------- //

/**
 * create a layout class
 * @param {String} namespace
 */
Outlayer.create = function( namespace, options ) {
  // sub-class Outlayer
  var Layout = subclass( Outlayer );
  // apply new options and compatOptions
  Layout.defaults = utils.extend( {}, Outlayer.defaults );
  utils.extend( Layout.defaults, options );
  Layout.compatOptions = utils.extend( {}, Outlayer.compatOptions  );

  Layout.namespace = namespace;

  Layout.data = Outlayer.data;

  // sub-class Item
  Layout.Item = subclass( Item );

  // -------------------------- declarative -------------------------- //

  utils.htmlInit( Layout, namespace );

  // -------------------------- jQuery bridge -------------------------- //

  // make into jQuery plugin
  if ( jQuery && jQuery.bridget ) {
    jQuery.bridget( namespace, Layout );
  }

  return Layout;
};

function subclass( Parent ) {
  function SubClass() {
    Parent.apply( this, arguments );
  }

  SubClass.prototype = Object.create( Parent.prototype );
  SubClass.prototype.constructor = SubClass;

  return SubClass;
}

// ----- helpers ----- //

// how many milliseconds are in each unit
var msUnits = {
  ms: 1,
  s: 1000
};

// munge time-like parameter into millisecond number
// '0.4s' -> 40
function getMilliseconds( time ) {
  if ( typeof time == 'number' ) {
    return time;
  }
  var matches = time.match( /(^\d*\.?\d*)(\w*)/ );
  var num = matches && matches[1];
  var unit = matches && matches[2];
  if ( !num.length ) {
    return 0;
  }
  num = parseFloat( num );
  var mult = msUnits[ unit ] || 1;
  return num * mult;
}

// ----- fin ----- //

// back in global
Outlayer.Item = Item;

return Outlayer;

}));

/**
 * Isotope Item
**/

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/item',[
        'outlayer/outlayer'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('outlayer')
    );
  } else {
    // browser global
    window.Isotope = window.Isotope || {};
    window.Isotope.Item = factory(
      window.Outlayer
    );
  }

}( window, function factory( Outlayer ) {
'use strict';

// -------------------------- Item -------------------------- //

// sub-class Outlayer Item
function Item() {
  Outlayer.Item.apply( this, arguments );
}

var proto = Item.prototype = Object.create( Outlayer.Item.prototype );

var _create = proto._create;
proto._create = function() {
  // assign id, used for original-order sorting
  this.id = this.layout.itemGUID++;
  _create.call( this );
  this.sortData = {};
};

proto.updateSortData = function() {
  if ( this.isIgnored ) {
    return;
  }
  // default sorters
  this.sortData.id = this.id;
  // for backward compatibility
  this.sortData['original-order'] = this.id;
  this.sortData.random = Math.random();
  // go thru getSortData obj and apply the sorters
  var getSortData = this.layout.options.getSortData;
  var sorters = this.layout._sorters;
  for ( var key in getSortData ) {
    var sorter = sorters[ key ];
    this.sortData[ key ] = sorter( this.element, this );
  }
};

var _destroy = proto.destroy;
proto.destroy = function() {
  // call super
  _destroy.apply( this, arguments );
  // reset display, #741
  this.css({
    display: ''
  });
};

return Item;

}));

/**
 * Isotope LayoutMode
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/layout-mode',[
        'get-size/get-size',
        'outlayer/outlayer'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('get-size'),
      require('outlayer')
    );
  } else {
    // browser global
    window.Isotope = window.Isotope || {};
    window.Isotope.LayoutMode = factory(
      window.getSize,
      window.Outlayer
    );
  }

}( window, function factory( getSize, Outlayer ) {
  'use strict';

  // layout mode class
  function LayoutMode( isotope ) {
    this.isotope = isotope;
    // link properties
    if ( isotope ) {
      this.options = isotope.options[ this.namespace ];
      this.element = isotope.element;
      this.items = isotope.filteredItems;
      this.size = isotope.size;
    }
  }

  var proto = LayoutMode.prototype;

  /**
   * some methods should just defer to default Outlayer method
   * and reference the Isotope instance as `this`
  **/
  var facadeMethods = [
    '_resetLayout',
    '_getItemLayoutPosition',
    '_manageStamp',
    '_getContainerSize',
    '_getElementOffset',
    'needsResizeLayout',
    '_getOption'
  ];

  facadeMethods.forEach( function( methodName ) {
    proto[ methodName ] = function() {
      return Outlayer.prototype[ methodName ].apply( this.isotope, arguments );
    };
  });

  // -----  ----- //

  // for horizontal layout modes, check vertical size
  proto.needsVerticalResizeLayout = function() {
    // don't trigger if size did not change
    var size = getSize( this.isotope.element );
    // check that this.size and size are there
    // IE8 triggers resize on body size change, so they might not be
    var hasSizes = this.isotope.size && size;
    return hasSizes && size.innerHeight != this.isotope.size.innerHeight;
  };

  // ----- measurements ----- //

  proto._getMeasurement = function() {
    this.isotope._getMeasurement.apply( this, arguments );
  };

  proto.getColumnWidth = function() {
    this.getSegmentSize( 'column', 'Width' );
  };

  proto.getRowHeight = function() {
    this.getSegmentSize( 'row', 'Height' );
  };

  /**
   * get columnWidth or rowHeight
   * segment: 'column' or 'row'
   * size 'Width' or 'Height'
  **/
  proto.getSegmentSize = function( segment, size ) {
    var segmentName = segment + size;
    var outerSize = 'outer' + size;
    // columnWidth / outerWidth // rowHeight / outerHeight
    this._getMeasurement( segmentName, outerSize );
    // got rowHeight or columnWidth, we can chill
    if ( this[ segmentName ] ) {
      return;
    }
    // fall back to item of first element
    var firstItemSize = this.getFirstItemSize();
    this[ segmentName ] = firstItemSize && firstItemSize[ outerSize ] ||
      // or size of container
      this.isotope.size[ 'inner' + size ];
  };

  proto.getFirstItemSize = function() {
    var firstItem = this.isotope.filteredItems[0];
    return firstItem && firstItem.element && getSize( firstItem.element );
  };

  // ----- methods that should reference isotope ----- //

  proto.layout = function() {
    this.isotope.layout.apply( this.isotope, arguments );
  };

  proto.getSize = function() {
    this.isotope.getSize();
    this.size = this.isotope.size;
  };

  // -------------------------- create -------------------------- //

  LayoutMode.modes = {};

  LayoutMode.create = function( namespace, options ) {

    function Mode() {
      LayoutMode.apply( this, arguments );
    }

    Mode.prototype = Object.create( proto );
    Mode.prototype.constructor = Mode;

    // default options
    if ( options ) {
      Mode.options = options;
    }

    Mode.prototype.namespace = namespace;
    // register in Isotope
    LayoutMode.modes[ namespace ] = Mode;

    return Mode;
  };

  return LayoutMode;

}));

/*!
 * Masonry v4.1.0
 * Cascading grid layout library
 * http://masonry.desandro.com
 * MIT License
 * by David DeSandro
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'masonry/masonry',[
        'outlayer/outlayer',
        'get-size/get-size'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('outlayer'),
      require('get-size')
    );
  } else {
    // browser global
    window.Masonry = factory(
      window.Outlayer,
      window.getSize
    );
  }

}( window, function factory( Outlayer, getSize ) {



// -------------------------- masonryDefinition -------------------------- //

  // create an Outlayer layout class
  var Masonry = Outlayer.create('masonry');
  // isFitWidth -> fitWidth
  Masonry.compatOptions.fitWidth = 'isFitWidth';

  Masonry.prototype._resetLayout = function() {
    this.getSize();
    this._getMeasurement( 'columnWidth', 'outerWidth' );
    this._getMeasurement( 'gutter', 'outerWidth' );
    this.measureColumns();

    // reset column Y
    this.colYs = [];
    for ( var i=0; i < this.cols; i++ ) {
      this.colYs.push( 0 );
    }

    this.maxY = 0;
  };

  Masonry.prototype.measureColumns = function() {
    this.getContainerWidth();
    // if columnWidth is 0, default to outerWidth of first item
    if ( !this.columnWidth ) {
      var firstItem = this.items[0];
      var firstItemElem = firstItem && firstItem.element;
      // columnWidth fall back to item of first element
      this.columnWidth = firstItemElem && getSize( firstItemElem ).outerWidth ||
        // if first elem has no width, default to size of container
        this.containerWidth;
    }

    var columnWidth = this.columnWidth += this.gutter;

    // calculate columns
    var containerWidth = this.containerWidth + this.gutter;
    var cols = containerWidth / columnWidth;
    // fix rounding errors, typically with gutters
    var excess = columnWidth - containerWidth % columnWidth;
    // if overshoot is less than a pixel, round up, otherwise floor it
    var mathMethod = excess && excess < 1 ? 'round' : 'floor';
    cols = Math[ mathMethod ]( cols );
    this.cols = Math.max( cols, 1 );
  };

  Masonry.prototype.getContainerWidth = function() {
    // container is parent if fit width
    var isFitWidth = this._getOption('fitWidth');
    var container = isFitWidth ? this.element.parentNode : this.element;
    // check that this.size and size are there
    // IE8 triggers resize on body size change, so they might not be
    var size = getSize( container );
    this.containerWidth = size && size.innerWidth;
  };

  Masonry.prototype._getItemLayoutPosition = function( item ) {
    item.getSize();
    // how many columns does this brick span
    var remainder = item.size.outerWidth % this.columnWidth;
    var mathMethod = remainder && remainder < 1 ? 'round' : 'ceil';
    // round if off by 1 pixel, otherwise use ceil
    var colSpan = Math[ mathMethod ]( item.size.outerWidth / this.columnWidth );
    colSpan = Math.min( colSpan, this.cols );

    var colGroup = this._getColGroup( colSpan );
    // get the minimum Y value from the columns
    var minimumY = Math.min.apply( Math, colGroup );
    var shortColIndex = colGroup.indexOf( minimumY );

    // position the brick
    var position = {
      x: this.columnWidth * shortColIndex,
      y: minimumY
    };

    // apply setHeight to necessary columns
    var setHeight = minimumY + item.size.outerHeight;
    var setSpan = this.cols + 1 - colGroup.length;
    for ( var i = 0; i < setSpan; i++ ) {
      this.colYs[ shortColIndex + i ] = setHeight;
    }

    return position;
  };

  /**
   * @param {Number} colSpan - number of columns the element spans
   * @returns {Array} colGroup
   */
  Masonry.prototype._getColGroup = function( colSpan ) {
    if ( colSpan < 2 ) {
      // if brick spans only one column, use all the column Ys
      return this.colYs;
    }

    var colGroup = [];
    // how many different places could this brick fit horizontally
    var groupCount = this.cols + 1 - colSpan;
    // for each group potential horizontal position
    for ( var i = 0; i < groupCount; i++ ) {
      // make an array of colY values for that one group
      var groupColYs = this.colYs.slice( i, i + colSpan );
      // and get the max value of the array
      colGroup[i] = Math.max.apply( Math, groupColYs );
    }
    return colGroup;
  };

  Masonry.prototype._manageStamp = function( stamp ) {
    var stampSize = getSize( stamp );
    var offset = this._getElementOffset( stamp );
    // get the columns that this stamp affects
    var isOriginLeft = this._getOption('originLeft');
    var firstX = isOriginLeft ? offset.left : offset.right;
    var lastX = firstX + stampSize.outerWidth;
    var firstCol = Math.floor( firstX / this.columnWidth );
    firstCol = Math.max( 0, firstCol );
    var lastCol = Math.floor( lastX / this.columnWidth );
    // lastCol should not go over if multiple of columnWidth #425
    lastCol -= lastX % this.columnWidth ? 0 : 1;
    lastCol = Math.min( this.cols - 1, lastCol );
    // set colYs to bottom of the stamp

    var isOriginTop = this._getOption('originTop');
    var stampMaxY = ( isOriginTop ? offset.top : offset.bottom ) +
      stampSize.outerHeight;
    for ( var i = firstCol; i <= lastCol; i++ ) {
      this.colYs[i] = Math.max( stampMaxY, this.colYs[i] );
    }
  };

  Masonry.prototype._getContainerSize = function() {
    this.maxY = Math.max.apply( Math, this.colYs );
    var size = {
      height: this.maxY
    };

    if ( this._getOption('fitWidth') ) {
      size.width = this._getContainerFitWidth();
    }

    return size;
  };

  Masonry.prototype._getContainerFitWidth = function() {
    var unusedCols = 0;
    // count unused columns
    var i = this.cols;
    while ( --i ) {
      if ( this.colYs[i] !== 0 ) {
        break;
      }
      unusedCols++;
    }
    // fit container to columns that have been used
    return ( this.cols - unusedCols ) * this.columnWidth - this.gutter;
  };

  Masonry.prototype.needsResizeLayout = function() {
    var previousWidth = this.containerWidth;
    this.getContainerWidth();
    return previousWidth != this.containerWidth;
  };

  return Masonry;

}));

/*!
 * Masonry layout mode
 * sub-classes Masonry
 * http://masonry.desandro.com
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/layout-modes/masonry',[
        '../layout-mode',
        'masonry/masonry'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode'),
      require('masonry-layout')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode,
      window.Masonry
    );
  }

}( window, function factory( LayoutMode, Masonry ) {
'use strict';

// -------------------------- masonryDefinition -------------------------- //

  // create an Outlayer layout class
  var MasonryMode = LayoutMode.create('masonry');

  var proto = MasonryMode.prototype;

  var keepModeMethods = {
    _getElementOffset: true,
    layout: true,
    _getMeasurement: true
  };

  // inherit Masonry prototype
  for ( var method in Masonry.prototype ) {
    // do not inherit mode methods
    if ( !keepModeMethods[ method ] ) {
      proto[ method ] = Masonry.prototype[ method ];
    }
  }

  var measureColumns = proto.measureColumns;
  proto.measureColumns = function() {
    // set items, used if measuring first item
    this.items = this.isotope.filteredItems;
    measureColumns.call( this );
  };

  // point to mode options for fitWidth
  var _getOption = proto._getOption;
  proto._getOption = function( option ) {
    if ( option == 'fitWidth' ) {
      return this.options.isFitWidth !== undefined ?
        this.options.isFitWidth : this.options.fitWidth;
    }
    return _getOption.apply( this.isotope, arguments );
  };

  return MasonryMode;

}));

/**
 * fitRows layout mode
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/layout-modes/fit-rows',[
        '../layout-mode'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode
    );
  }

}( window, function factory( LayoutMode ) {
'use strict';

var FitRows = LayoutMode.create('fitRows');

var proto = FitRows.prototype;

proto._resetLayout = function() {
  this.x = 0;
  this.y = 0;
  this.maxY = 0;
  this._getMeasurement( 'gutter', 'outerWidth' );
};

proto._getItemLayoutPosition = function( item ) {
  item.getSize();

  var itemWidth = item.size.outerWidth + this.gutter;
  // if this element cannot fit in the current row
  var containerWidth = this.isotope.size.innerWidth + this.gutter;
  if ( this.x !== 0 && itemWidth + this.x > containerWidth ) {
    this.x = 0;
    this.y = this.maxY;
  }

  var position = {
    x: this.x,
    y: this.y
  };

  this.maxY = Math.max( this.maxY, this.y + item.size.outerHeight );
  this.x += itemWidth;

  return position;
};

proto._getContainerSize = function() {
  return { height: this.maxY };
};

return FitRows;

}));

/**
 * vertical layout mode
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/layout-modes/vertical',[
        '../layout-mode'
      ],
      factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode
    );
  }

}( window, function factory( LayoutMode ) {
'use strict';

var Vertical = LayoutMode.create( 'vertical', {
  horizontalAlignment: 0
});

var proto = Vertical.prototype;

proto._resetLayout = function() {
  this.y = 0;
};

proto._getItemLayoutPosition = function( item ) {
  item.getSize();
  var x = ( this.isotope.size.innerWidth - item.size.outerWidth ) *
    this.options.horizontalAlignment;
  var y = this.y;
  this.y += item.size.outerHeight;
  return { x: x, y: y };
};

proto._getContainerSize = function() {
  return { height: this.y };
};

return Vertical;

}));

/*!
 * Isotope v3.0.0
 *
 * Licensed GPLv3 for open source use
 * or Isotope Commercial License for commercial use
 *
 * http://isotope.metafizzy.co
 * Copyright 2016 Metafizzy
 */

( function( window, factory ) {
  // universal module definition
  /* jshint strict: false */ /*globals define, module, require */
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( [
        'outlayer/outlayer',
        'get-size/get-size',
        'desandro-matches-selector/matches-selector',
        'fizzy-ui-utils/utils',
        './item',
        './layout-mode',
        // include default layout modes
        './layout-modes/masonry',
        './layout-modes/fit-rows',
        './layout-modes/vertical'
      ],
      function( Outlayer, getSize, matchesSelector, utils, Item, LayoutMode ) {
        return factory( window, Outlayer, getSize, matchesSelector, utils, Item, LayoutMode );
      });
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      window,
      require('outlayer'),
      require('get-size'),
      require('desandro-matches-selector'),
      require('fizzy-ui-utils'),
      require('./item'),
      require('./layout-mode'),
      // include default layout modes
      require('./layout-modes/masonry'),
      require('./layout-modes/fit-rows'),
      require('./layout-modes/vertical')
    );
  } else {
    // browser global
    window.Isotope = factory(
      window,
      window.Outlayer,
      window.getSize,
      window.matchesSelector,
      window.fizzyUIUtils,
      window.Isotope.Item,
      window.Isotope.LayoutMode
    );
  }

}( window, function factory( window, Outlayer, getSize, matchesSelector, utils,
  Item, LayoutMode ) {



// -------------------------- vars -------------------------- //

var jQuery = window.jQuery;

// -------------------------- helpers -------------------------- //

var trim = String.prototype.trim ?
  function( str ) {
    return str.trim();
  } :
  function( str ) {
    return str.replace( /^\s+|\s+$/g, '' );
  };

// -------------------------- isotopeDefinition -------------------------- //

  // create an Outlayer layout class
  var Isotope = Outlayer.create( 'isotope', {
    layoutMode: 'masonry',
    isJQueryFiltering: true,
    sortAscending: true
  });

  Isotope.Item = Item;
  Isotope.LayoutMode = LayoutMode;

  var proto = Isotope.prototype;

  proto._create = function() {
    this.itemGUID = 0;
    // functions that sort items
    this._sorters = {};
    this._getSorters();
    // call super
    Outlayer.prototype._create.call( this );

    // create layout modes
    this.modes = {};
    // start filteredItems with all items
    this.filteredItems = this.items;
    // keep of track of sortBys
    this.sortHistory = [ 'original-order' ];
    // create from registered layout modes
    for ( var name in LayoutMode.modes ) {
      this._initLayoutMode( name );
    }
  };

  proto.reloadItems = function() {
    // reset item ID counter
    this.itemGUID = 0;
    // call super
    Outlayer.prototype.reloadItems.call( this );
  };

  proto._itemize = function() {
    var items = Outlayer.prototype._itemize.apply( this, arguments );
    // assign ID for original-order
    for ( var i=0; i < items.length; i++ ) {
      var item = items[i];
      item.id = this.itemGUID++;
    }
    this._updateItemsSortData( items );
    return items;
  };


  // -------------------------- layout -------------------------- //

  proto._initLayoutMode = function( name ) {
    var Mode = LayoutMode.modes[ name ];
    // set mode options
    // HACK extend initial options, back-fill in default options
    var initialOpts = this.options[ name ] || {};
    this.options[ name ] = Mode.options ?
      utils.extend( Mode.options, initialOpts ) : initialOpts;
    // init layout mode instance
    this.modes[ name ] = new Mode( this );
  };


  proto.layout = function() {
    // if first time doing layout, do all magic
    if ( !this._isLayoutInited && this._getOption('initLayout') ) {
      this.arrange();
      return;
    }
    this._layout();
  };

  // private method to be used in layout() & magic()
  proto._layout = function() {
    // don't animate first layout
    var isInstant = this._getIsInstant();
    // layout flow
    this._resetLayout();
    this._manageStamps();
    this.layoutItems( this.filteredItems, isInstant );

    // flag for initalized
    this._isLayoutInited = true;
  };

  // filter + sort + layout
  proto.arrange = function( opts ) {
    // set any options pass
    this.option( opts );
    this._getIsInstant();
    // filter, sort, and layout

    // filter
    var filtered = this._filter( this.items );
    this.filteredItems = filtered.matches;

    this._bindArrangeComplete();

    if ( this._isInstant ) {
      this._noTransition( this._hideReveal, [ filtered ] );
    } else {
      this._hideReveal( filtered );
    }

    this._sort();
    this._layout();
  };
  // alias to _init for main plugin method
  proto._init = proto.arrange;

  proto._hideReveal = function( filtered ) {
    this.reveal( filtered.needReveal );
    this.hide( filtered.needHide );
  };

  // HACK
  // Don't animate/transition first layout
  // Or don't animate/transition other layouts
  proto._getIsInstant = function() {
    var isLayoutInstant = this._getOption('layoutInstant');
    var isInstant = isLayoutInstant !== undefined ? isLayoutInstant :
      !this._isLayoutInited;
    this._isInstant = isInstant;
    return isInstant;
  };

  // listen for layoutComplete, hideComplete and revealComplete
  // to trigger arrangeComplete
  proto._bindArrangeComplete = function() {
    // listen for 3 events to trigger arrangeComplete
    var isLayoutComplete, isHideComplete, isRevealComplete;
    var _this = this;
    function arrangeParallelCallback() {
      if ( isLayoutComplete && isHideComplete && isRevealComplete ) {
        _this.dispatchEvent( 'arrangeComplete', null, [ _this.filteredItems ] );
      }
    }
    this.once( 'layoutComplete', function() {
      isLayoutComplete = true;
      arrangeParallelCallback();
    });
    this.once( 'hideComplete', function() {
      isHideComplete = true;
      arrangeParallelCallback();
    });
    this.once( 'revealComplete', function() {
      isRevealComplete = true;
      arrangeParallelCallback();
    });
  };

  // -------------------------- filter -------------------------- //

  proto._filter = function( items ) {
    var filter = this.options.filter;
    filter = filter || '*';
    var matches = [];
    var hiddenMatched = [];
    var visibleUnmatched = [];

    var test = this._getFilterTest( filter );

    // test each item
    for ( var i=0; i < items.length; i++ ) {
      var item = items[i];
      if ( item.isIgnored ) {
        continue;
      }
      // add item to either matched or unmatched group
      var isMatched = test( item );
      // item.isFilterMatched = isMatched;
      // add to matches if its a match
      if ( isMatched ) {
        matches.push( item );
      }
      // add to additional group if item needs to be hidden or revealed
      if ( isMatched && item.isHidden ) {
        hiddenMatched.push( item );
      } else if ( !isMatched && !item.isHidden ) {
        visibleUnmatched.push( item );
      }
    }

    // return collections of items to be manipulated
    return {
      matches: matches,
      needReveal: hiddenMatched,
      needHide: visibleUnmatched
    };
  };

  // get a jQuery, function, or a matchesSelector test given the filter
  proto._getFilterTest = function( filter ) {
    if ( jQuery && this.options.isJQueryFiltering ) {
      // use jQuery
      return function( item ) {
        return jQuery( item.element ).is( filter );
      };
    }
    if ( typeof filter == 'function' ) {
      // use filter as function
      return function( item ) {
        return filter( item.element );
      };
    }
    // default, use filter as selector string
    return function( item ) {
      return matchesSelector( item.element, filter );
    };
  };

  // -------------------------- sorting -------------------------- //

  /**
   * @params {Array} elems
   * @public
   */
  proto.updateSortData = function( elems ) {
    // get items
    var items;
    if ( elems ) {
      elems = utils.makeArray( elems );
      items = this.getItems( elems );
    } else {
      // update all items if no elems provided
      items = this.items;
    }

    this._getSorters();
    this._updateItemsSortData( items );
  };

  proto._getSorters = function() {
    var getSortData = this.options.getSortData;
    for ( var key in getSortData ) {
      var sorter = getSortData[ key ];
      this._sorters[ key ] = mungeSorter( sorter );
    }
  };

  /**
   * @params {Array} items - of Isotope.Items
   * @private
   */
  proto._updateItemsSortData = function( items ) {
    // do not update if no items
    var len = items && items.length;

    for ( var i=0; len && i < len; i++ ) {
      var item = items[i];
      item.updateSortData();
    }
  };

  // ----- munge sorter ----- //

  // encapsulate this, as we just need mungeSorter
  // other functions in here are just for munging
  var mungeSorter = ( function() {
    // add a magic layer to sorters for convienent shorthands
    // `.foo-bar` will use the text of .foo-bar querySelector
    // `[foo-bar]` will use attribute
    // you can also add parser
    // `.foo-bar parseInt` will parse that as a number
    function mungeSorter( sorter ) {
      // if not a string, return function or whatever it is
      if ( typeof sorter != 'string' ) {
        return sorter;
      }
      // parse the sorter string
      var args = trim( sorter ).split(' ');
      var query = args[0];
      // check if query looks like [an-attribute]
      var attrMatch = query.match( /^\[(.+)\]$/ );
      var attr = attrMatch && attrMatch[1];
      var getValue = getValueGetter( attr, query );
      // use second argument as a parser
      var parser = Isotope.sortDataParsers[ args[1] ];
      // parse the value, if there was a parser
      sorter = parser ? function( elem ) {
        return elem && parser( getValue( elem ) );
      } :
      // otherwise just return value
      function( elem ) {
        return elem && getValue( elem );
      };

      return sorter;
    }

    // get an attribute getter, or get text of the querySelector
    function getValueGetter( attr, query ) {
      // if query looks like [foo-bar], get attribute
      if ( attr ) {
        return function getAttribute( elem ) {
          return elem.getAttribute( attr );
        };
      }

      // otherwise, assume its a querySelector, and get its text
      return function getChildText( elem ) {
        var child = elem.querySelector( query );
        return child && child.textContent;
      };
    }

    return mungeSorter;
  })();

  // parsers used in getSortData shortcut strings
  Isotope.sortDataParsers = {
    'parseInt': function( val ) {
      return parseInt( val, 10 );
    },
    'parseFloat': function( val ) {
      return parseFloat( val );
    }
  };

  // ----- sort method ----- //

  // sort filteredItem order
  proto._sort = function() {
    var sortByOpt = this.options.sortBy;
    if ( !sortByOpt ) {
      return;
    }
    // concat all sortBy and sortHistory
    var sortBys = [].concat.apply( sortByOpt, this.sortHistory );
    // sort magic
    var itemSorter = getItemSorter( sortBys, this.options.sortAscending );
    this.filteredItems.sort( itemSorter );
    // keep track of sortBy History
    if ( sortByOpt != this.sortHistory[0] ) {
      // add to front, oldest goes in last
      this.sortHistory.unshift( sortByOpt );
    }
  };

  // returns a function used for sorting
  function getItemSorter( sortBys, sortAsc ) {
    return function sorter( itemA, itemB ) {
      // cycle through all sortKeys
      for ( var i = 0; i < sortBys.length; i++ ) {
        var sortBy = sortBys[i];
        var a = itemA.sortData[ sortBy ];
        var b = itemB.sortData[ sortBy ];
        if ( a > b || a < b ) {
          // if sortAsc is an object, use the value given the sortBy key
          var isAscending = sortAsc[ sortBy ] !== undefined ? sortAsc[ sortBy ] : sortAsc;
          var direction = isAscending ? 1 : -1;
          return ( a > b ? 1 : -1 ) * direction;
        }
      }
      return 0;
    };
  }

  // -------------------------- methods -------------------------- //

  // get layout mode
  proto._mode = function() {
    var layoutMode = this.options.layoutMode;
    var mode = this.modes[ layoutMode ];
    if ( !mode ) {
      // TODO console.error
      throw new Error( 'No layout mode: ' + layoutMode );
    }
    // HACK sync mode's options
    // any options set after init for layout mode need to be synced
    mode.options = this.options[ layoutMode ];
    return mode;
  };

  proto._resetLayout = function() {
    // trigger original reset layout
    Outlayer.prototype._resetLayout.call( this );
    this._mode()._resetLayout();
  };

  proto._getItemLayoutPosition = function( item  ) {
    return this._mode()._getItemLayoutPosition( item );
  };

  proto._manageStamp = function( stamp ) {
    this._mode()._manageStamp( stamp );
  };

  proto._getContainerSize = function() {
    return this._mode()._getContainerSize();
  };

  proto.needsResizeLayout = function() {
    return this._mode().needsResizeLayout();
  };

  // -------------------------- adding & removing -------------------------- //

  // HEADS UP overwrites default Outlayer appended
  proto.appended = function( elems ) {
    var items = this.addItems( elems );
    if ( !items.length ) {
      return;
    }
    // filter, layout, reveal new items
    var filteredItems = this._filterRevealAdded( items );
    // add to filteredItems
    this.filteredItems = this.filteredItems.concat( filteredItems );
  };

  // HEADS UP overwrites default Outlayer prepended
  proto.prepended = function( elems ) {
    var items = this._itemize( elems );
    if ( !items.length ) {
      return;
    }
    // start new layout
    this._resetLayout();
    this._manageStamps();
    // filter, layout, reveal new items
    var filteredItems = this._filterRevealAdded( items );
    // layout previous items
    this.layoutItems( this.filteredItems );
    // add to items and filteredItems
    this.filteredItems = filteredItems.concat( this.filteredItems );
    this.items = items.concat( this.items );
  };

  proto._filterRevealAdded = function( items ) {
    var filtered = this._filter( items );
    this.hide( filtered.needHide );
    // reveal all new items
    this.reveal( filtered.matches );
    // layout new items, no transition
    this.layoutItems( filtered.matches, true );
    return filtered.matches;
  };

  /**
   * Filter, sort, and layout newly-appended item elements
   * @param {Array or NodeList or Element} elems
   */
  proto.insert = function( elems ) {
    var items = this.addItems( elems );
    if ( !items.length ) {
      return;
    }
    // append item elements
    var i, item;
    var len = items.length;
    for ( i=0; i < len; i++ ) {
      item = items[i];
      this.element.appendChild( item.element );
    }
    // filter new stuff
    var filteredInsertItems = this._filter( items ).matches;
    // set flag
    for ( i=0; i < len; i++ ) {
      items[i].isLayoutInstant = true;
    }
    this.arrange();
    // reset flag
    for ( i=0; i < len; i++ ) {
      delete items[i].isLayoutInstant;
    }
    this.reveal( filteredInsertItems );
  };

  var _remove = proto.remove;
  proto.remove = function( elems ) {
    elems = utils.makeArray( elems );
    var removeItems = this.getItems( elems );
    // do regular thing
    _remove.call( this, elems );
    // bail if no items to remove
    var len = removeItems && removeItems.length;
    // remove elems from filteredItems
    for ( var i=0; len && i < len; i++ ) {
      var item = removeItems[i];
      // remove item from collection
      utils.removeFrom( this.filteredItems, item );
    }
  };

  proto.shuffle = function() {
    // update random sortData
    for ( var i=0; i < this.items.length; i++ ) {
      var item = this.items[i];
      item.sortData.random = Math.random();
    }
    this.options.sortBy = 'random';
    this._sort();
    this._layout();
  };

  /**
   * trigger fn without transition
   * kind of hacky to have this in the first place
   * @param {Function} fn
   * @param {Array} args
   * @returns ret
   * @private
   */
  proto._noTransition = function( fn, args ) {
    // save transitionDuration before disabling
    var transitionDuration = this.options.transitionDuration;
    // disable transition
    this.options.transitionDuration = 0;
    // do it
    var returnValue = fn.apply( this, args );
    // re-enable transition for reveal
    this.options.transitionDuration = transitionDuration;
    return returnValue;
  };

  // ----- helper methods ----- //

  /**
   * getter method for getting filtered item elements
   * @returns {Array} elems - collection of item elements
   */
  proto.getFilteredItemElements = function() {
    return this.filteredItems.map( function( item ) {
      return item.element;
    });
  };

  // -----  ----- //

  return Isotope;

}));



/*!
# @author Fernando Lujan
#
# @title Filterade.js
# @url https://github.com/FernandoLujan/filterade-js
# @desc Filters and pagination with options, from Canada
# @desc Rewritten by Dream-Theme.com for The7 WordPress theme (the7.io)
*/

;(function ( $, window, document, undefined ) {
	return $.fn.Filterade = function(options) {
		var activeFilter, 
			activePage,
			activeSort,
			activeOrder,
			$container, 
			defaults,
			filterControls, 
			sortControls,
			orderControls,
			controlsSelecter,
			controlsSelecterChecked,
			filterResults, 
			getPageCount, 
			initialize, 
			$nodes,
			paginationMode,
			pageControls, 
			pageCount, 
			paginateControls, 
			paginateResults,
			updateView,
			sortNodes;
	
		defaults = {
			useFilters: false,
			useSorting: false,
			filterControls: '.filter-controls',
			sortControls: '.sort-controls',
			orderControls: '.order-controls',
			controlsSelecter: 'input',
			controlsSelecterChecked: 'input[checked="checked"]',
			defaultFilter: 'all',
			defaultSort: 'date',
			defaultOrder: 'desc',
			selectAll: 'all',
			paginationMode: 'pages',
			pageLimit: 15,
			pageControls: '.page-controls',
			//previousButtonClass: 'previous',
			previousButtonClass: 'nav-prev',
			//previousButtonLabel: 'Previous',
			previousButtonLabel: '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
			//nextButtonClass: 'next',
			nextButtonClass: 'nav-next',
			//nextButtonLabel: 'Next',
			nextButtonLabel: '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
			//loadMoreButtonClass: 'load-more',
			loadMoreButtonClass: 'button-load-more',
			loadMoreButtonLabel: 'Load more',
			pagerClass: 'page',
			//activeClass: 'active',
			activeClass: 'act',
			log: false
		};
	
		//$container = $(this.selector);
		$container = $(this);
		paginationMode = options.paginationMode || defaults.paginationMode;
		pageControls = $(options.pageControls || defaults.pageControls);
		filterControls = $(options.filterControls || defaults.filterControls);
		sortControls = $(options.sortControls || defaults.sortControls);
		orderControls = $(options.orderControls || defaults.orderControls);
		controlsSelecter = options.controlsSelecter || defaults.controlsSelecter;
		controlsSelecterChecked = options.controlsSelecterChecked || defaults.controlsSelecterChecked;
		activePage = 1;
	
		$nodes = $([]);
		$nodes.$nodesCache = $([]);
		$container.children("article").each(function() {
			var $this = $(this);
			$nodes.push({
				node: this,
				$node: $this,
				name: $this.attr("data-name"),
				date: new Date($this.attr("data-date"))
			});
			$nodes.$nodesCache.push(this);
		});
		pageCount = Math.ceil($nodes.length / options.pageLimit);
	
		/*
			# @getPageCount
			# Calculate page count
		*/
		getPageCount = function() {
		var nodeCount;
			if (paginationMode === "pages" || paginationMode === "load-more") {
				nodeCount = 0;
				$nodes.each(function() {
					if (this.$node.hasClass("visible")) {
						return nodeCount++;
					}
				});
	
				pageCount = Math.ceil(nodeCount / (options.pageLimit || defaults.pageLimit));
			}
		};
		
		/*
			# @paginateControls
			# Hide/display content based on pagination
		*/
		//Changed by Alla 13.09.2016 (remove li wrap from links)
		paginateControls = function() {
			if (paginationMode === "pages") {
				var i, _i;
				pageControls.empty();
				if (pageCount > 1) {
					if (activePage !== 1) {
					pageControls.prepend('<a href="#" class="' + (options.previousButtonClass || defaults.previousButtonClass) + '">' + (options.previousButtonLabel || defaults.previousButtonLabel) + '</a>');
					}

					var pagesToShow = 5;
                    var pagesToShowMinus1 = pagesToShow - 1;
					var pagesBefore = Math.floor(pagesToShowMinus1/2);
                    var pagesAfter = Math.ceil(pagesToShowMinus1/2);
                    var startPage = Math.max(activePage - pagesBefore, 1);
                    var endPage = activePage + pagesAfter;

                    if(startPage <= pagesBefore) {
                        endPage = startPage + pagesToShowMinus1;
                    }

                    if(endPage > pageCount) {
                        startPage = Math.max(pageCount - pagesToShowMinus1, 1);
                        endPage = pageCount;
                    }

                    var leftPagesPack = $('<div style="display: none;"></div>');
                    var rightPagesPack = $('<div style="display: none;"></div>');

					for (i = _i = 1; 1 <= pageCount ? _i <= pageCount : _i >= pageCount; i = 1 <= pageCount ? ++_i : --_i) {
					    if (i<startPage && i!=1) {
					        leftPagesPack.append('<a href="#" class="' + (options.pagerClass || defaults.pagerClass) + '" data-page="' + +i + '">' + i + '</a>');
                            continue;
                        }

                        if (i==startPage && leftPagesPack.children().length) {
                            pageControls.append(leftPagesPack);
                        }

                        if (i>endPage && i!=pageCount) {
                            rightPagesPack.append('<a href="#" class="' + (options.pagerClass || defaults.pagerClass) + '" data-page="' + +i + '">' + i + '</a>');
                            continue;
                        }

                        if (i==pageCount && rightPagesPack.children().length) {
                            pageControls.append(rightPagesPack);
                        }

					    pageControls.append('<a href="#" class="' + (options.pagerClass || defaults.pagerClass) + '" data-page="' + +i + '">' + i + '</a>');
					}

					if (activePage < pageCount) {
					pageControls.append('<a href="#" class="' + (options.nextButtonClass || defaults.nextButtonClass) + '">' + (options.nextButtonLabel || defaults.nextButtonLabel) + '</a>');
					}
					pageControls.find('a[data-page="' + activePage + '"]').addClass(options.activeClass || defaults.activeClass);
					pageControls.find('a.' + (options.pagerClass || defaults.pagerClass)).click(function(e) {
						e.preventDefault();
						activePage = parseInt($(this).attr('data-page'));
						pageControls.find('a.' + (options.activeClass || defaults.activeClass)).removeClass(options.activeClass || defaults.activeClass);
						pageControls.find('a[data-page="' + activePage + '"]').addClass(options.activeClass || defaults.activeClass);

						//Scroll to top of container
						var $scrollTo = $container.offset().top - 40;

						// if (!$scrollTo.exists()) {
						// 	$scrollTo = $container;
						// 	//paddingTop = 50;
						// }
						$("html, body").animate({
							scrollTop: $scrollTo - $("#phantom").height()
						}, 400);
						return updateView();

						
					});
					pageControls.find('a.' + (options.previousButtonClass || defaults.previousButtonClass)).click(function(e) {
					e.preventDefault();
					activePage--;
					//Scroll to top of container
					var $scrollTo = $container.offset().top - 40;

					
					$("html, body").animate({
						scrollTop: $scrollTo - $("#phantom").height()
					}, 400);
					return updateView();
					});
					return pageControls.find('a.' + (options.nextButtonClass || defaults.nextButtonClass)).click(function(e) {
					e.preventDefault();
					activePage++;
					//Scroll to top of container
					var $scrollTo = $container.offset().top - 40;

					// if (!$scrollTo.exists()) {
					// 	$scrollTo = $container;
					// 	//paddingTop = 50;
					// }
					$("html, body").animate({
						scrollTop: $scrollTo - $("#phantom").height()
					}, 400);
					return updateView();
					});
				}
			}
			else if (paginationMode === "load-more") {
				//var activeLoadClass = "";
				pageControls.empty();
				if (pageCount > 1) {

					if (activePage < pageCount) {
					pageControls.append('<a href="#" class="' + (options.loadMoreButtonClass || defaults.loadMoreButtonClass) + '"><span class="stick"></span><span class="button-caption">' + (options.loadMoreButtonLabel || defaults.loadMoreButtonLabel) + '</span></a>');
					}else{
						pageControls.css("display", "none");
					}

					return pageControls.find('a.' + (options.loadMoreButtonClass || defaults.loadMoreButtonClass)).click(function(e) {
						e.preventDefault();
						//var activeLoadClass = "animate-load";
						activePage++;
					//	$(this).addClass("animate-load");
						return updateView();
						
					});
					
				}
			}
		};
		
		/*
			# @paginateResults
			# Only displays results within the active page
		*/
		paginateResults = function() {
			if (paginationMode === "pages" || paginationMode === "load-more") {
				var nodeIndex = 0,
					$nodesHide = $([]),
					$nodesShow = $([]);
	
				 $nodes.each(function(i) {
					if (this.$node.hasClass("visible")) {
						nodeIndex++;
						if ((paginationMode === "pages") && nodeIndex > (activePage * (options.pageLimit || defaults.pageLimit) - (options.pageLimit || defaults.pageLimit)) && nodeIndex <= ((options.pageLimit || defaults.pageLimit) * activePage)) {
							$nodesShow.push(this.node);
						}
						else if ((paginationMode === "load-more") && nodeIndex <= ((options.pageLimit || defaults.pageLimit) * activePage)) {
							$nodesShow.push(this.node);
						} 
						else {
							$nodesHide.push(this.node);
						}
						//$nodesShow.layzrBlogInitialisation();
					}
				});
				$nodesHide.removeClass("visible").addClass("hidden");
				$nodesShow.removeClass("hidden").addClass("visible");
				$nodesShow.removeClass("first");
				$nodesShow.first().addClass("first");
				//console.log($nodesShow.first())

				
			}
		};
		
		/*
			# @filterResults
			# Hide/display content based on the active filter
		*/
		filterResults = function() {
			var $nodesHide = $([]),
				$nodesShow = $([]);
	
			if (options.useFilters || defaults.useFilters) {
				if (activeFilter === (options.selectAll || defaults.selectAll)) {
					$nodesShow = $nodes.$nodesCache;
				}
				else {
					$nodes.each(function(i) {
						if (!this.$node.hasClass(activeFilter)) {
							$nodesHide.push(this.node);
						}
						else {
							$nodesShow.push(this.node);
						}
					});
				}
			}
			else {
				$nodesShow = $nodes.$nodesCache;
			}
	
			$nodesHide.removeClass("visible").addClass("hidden");
			$nodesShow.removeClass("hidden").addClass("visible");
			//$nodesShow.layzrBlogInitialisation();
		};
	
		/*
			# @sortNodes
			# Sorts nodes and mekes changes to DOM
		*/
		sortNodes = function() {
			if (activeSort === "date" && activeOrder ==="desc") {
				$nodes.sort(function(a, b){return b.date - a.date});
			}
			else if (activeSort === "date" && activeOrder ==="asc") {
				$nodes.sort(function(a, b){return a.date - b.date});
			}
			else if (activeSort === "name" && activeOrder ==="desc") {
				$nodes.sort(function(a, b){
					var x = a.name.toLowerCase();
					var y = b.name.toLowerCase();
					if (x > y) {return -1;}
					if (x < y) {return 1;}
					return 0;
				});
			}
			else if (activeSort === "name" && activeOrder ==="asc") {
				$nodes.sort(function(a, b){
					var x = a.name.toLowerCase();
					var y = b.name.toLowerCase();
					if (x < y) {return -1;}
					if (x > y) {return 1;}
					return 0;
				});
			}
	
			$nodes.$nodesCache = $([]);
			$nodes.each(function() {
				$nodes.$nodesCache.push(this.node);
			});
			if($container.find(".paginator").length > 0){
				$nodes.$nodesCache.detach().insertBefore($container.find(".paginator"));
			}else{
	
				$nodes.$nodesCache.detach().appendTo($container);
			}
		};
	
		/*
			# @updateView
			# Update controls and containers
		*/
		updateView = function() {
			filterResults();
			getPageCount();
			paginateResults();
			paginateControls();
			$(".layzr-loading-on .blog-shortcode.jquery-filter .visible:not(.shown)").layzrBlogInitialisation();
		};
	
		/*
			# @initialize
			# Configures plugin defaults and updates the document when done
		*/
		initialize = function() {
			if (options.useFilters || defaults.useFilters) {
				activeFilter = (filterControls.find(controlsSelecterChecked).attr("data-filter") || options.defaultFilter || defaults.defaultFilter);
	
				filterControls.find(controlsSelecter).click(function(e) {
					activeFilter = $(this).attr("data-filter");
					activePage = 1;
					updateView();
				});
			}
	
			if (options.useSorting || defaults.useSorting) {
				activeSort = (sortControls.find(controlsSelecterChecked).attr("data-by") || options.defaultSort || defaults.defaultSort);
				activeOrder = (orderControls.find(controlsSelecterChecked).attr("data-sort") || options.defaultOrder || defaults.defaultOrder);
	
				sortControls.find(controlsSelecter).click(function(e) {
					if (this.getAttribute("data-by") === "date") activeSort = "date";
					else activeSort = "name";
	
					sortNodes();
					activePage = 1;
					updateView();
				});
	
				orderControls.find(controlsSelecter).click(function(e) {
					if (this.getAttribute("data-sort") === "desc") activeOrder = "desc";
					else activeOrder = "asc";
	
					sortNodes();
					activePage = 1;
					updateView();
				});
			}
			return updateView();
		};
		return initialize();
	};
})( jQuery, window, document );



jQuery(document).ready(function($) {
	//Cache variables
	var $document = $(document),
		$window = $(window),
		$html = $("html"),
		$body = $("body"),
		$page = $("#page");

	/*!- Custom resize function*/
	var dtResizeTimeout;
	if(dtGlobals.isMobile && !dtGlobals.isWindowsPhone){
		$window.bind("orientationchange", function(event) {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$window.trigger( "debouncedresize" );
			}, 200);
		});
	}else{
		$window.on("resize", function() {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$window.trigger( "debouncedresize" );
			}, 200);
		});
	}
	/* #Retina images using srcset polyfill
	================================================== */
	//Layzy img loading
	$.fn.layzrInitialisation = function(container) {
	  return this.each(function() {
	      var $this = $(this);

	      var layzr = new Layzr({
	        container: container,
	        selector: '.lazy-load',
	        attr: 'data-src',
	        attrSrcSet: 'data-srcset',
	        retinaAttr: 'data-src-retina',
	        hiddenAttr: 'data-src-hidden',
	        threshold: 30,
	        before: function() {
	          // For fixed-size images with srcset; or have to be updated on window resize.
	          this.setAttribute("sizes", this.width+"px");
			   var ext = $(this).attr("data-src").substring($(this).attr("data-src").lastIndexOf(".")+1);
			   if(ext == "png"){
			      $(this).parent().addClass("layzr-bg-transparent");
			  }
	        },
	        callback: function() {

	          	this.classList.add("is-loaded");
	         	var $this =  $(this);
	         	setTimeout(function(){
					$this.parent().removeClass("layzr-bg");
				}, 350)
	        }
	      });
	    });
	};
	$(".layzr-loading-on, .vc_single_image-img").layzrInitialisation();

	$.fn.layzrBlogInitialisation = function(container) {
	  return this.each(function() {
	      var $this = $(this);
	      $(".blog-shortcode.jquery-filter article").removeClass("shown");
	      $this.addClass("shown");
	      $this.find("img").addClass("blog-thumb-lazy-load-show");

	      var layzrBlog = new Layzr({
	        container: container,
	        selector: ".blog-thumb-lazy-load-show",
	        attr: 'data-src',
	        attrSrcSet: 'data-srcset',
	        retinaAttr: 'data-src-retina',
	        hiddenAttr: 'data-src-hidden',
	        threshold: 30,
	        before: function() {
	          // For fixed-size images with srcset; or have to be updated on window resize.
	          if($(this).parents(".post").first().hasClass("visible")){
	          	//console.log( $(this))
		          this.setAttribute("sizes", this.width+"px");
				   var ext = $(this).attr("data-src").substring($(this).attr("data-src").lastIndexOf(".")+1);
				   if(ext == "png"){
				      $(this).parent().addClass("layzr-bg-transparent");
				 	}
				 }
	        },
	        callback: function() {
	        	if($(this).parents(".post").first().hasClass("visible")){
	          		this.classList.add("is-loaded");

			 		//console.log( $(this))
		         	var $this =  $(this);
		         	setTimeout(function(){
						$this.parent().removeClass("layzr-bg");
					}, 350);
				}
	        }
	      });
	    });
	};
	$(".layzr-loading-on .blog-shortcode.jquery-filter .visible").layzrBlogInitialisation();

	/*Call visual composer function for preventing full-width row conflict */
	if($('div[data-vc-stretch-content="true"]').length > 0 && $('div[data-vc-full-width-init="false"]').length > 0){
		vc_rowBehaviour();

	}



/* #Custom touch events
================================================== */

	/* !(we need to add swipe events here) */

	dtGlobals.touches = {};
	dtGlobals.touches.touching = false;
	dtGlobals.touches.touch = false;
	dtGlobals.touches.currX = 0;
	dtGlobals.touches.currY = 0;
	dtGlobals.touches.cachedX = 0;
	dtGlobals.touches.cachedY = 0;
	dtGlobals.touches.count = 0;
	dtGlobals.resizeCounter = 0;

	$document.on("touchstart",function(e) {
		if (e.originalEvent.touches.length == 1) {
			dtGlobals.touches.touch = e.originalEvent.touches[0];

			// caching the current x
			dtGlobals.touches.cachedX = dtGlobals.touches.touch.pageX;
			// caching the current y
			dtGlobals.touches.cachedY = dtGlobals.touches.touch.pageY;
			// a touch event is detected      
			dtGlobals.touches.touching = true;

			// detecting if after 200ms the finger is still in the same position
			setTimeout(function() {

				dtGlobals.touches.currX = dtGlobals.touches.touch.pageX;
				dtGlobals.touches.currY = dtGlobals.touches.touch.pageY;

				if ((dtGlobals.touches.cachedX === dtGlobals.touches.currX) && !dtGlobals.touches.touching && (dtGlobals.touches.cachedY === dtGlobals.touches.currY)) {
					// Here you get the Tap event
					dtGlobals.touches.count++;
					//console.log(dtGlobals.touches.count)
					$(e.target).trigger("tap");
				}
			},200);
		}
	});

	$document.on("touchend touchcancel",function (e){
		// here we can consider finished the touch event
		dtGlobals.touches.touching = false;
	});

	$document.on("touchmove",function (e){
		dtGlobals.touches.touch = e.originalEvent.touches[0];

		if(dtGlobals.touches.touching) {
			// here you are swiping
		}
	});

	$document.on("tap", function(e) {
		$(".dt-hovered").trigger("mouseout");
	});


// jquery.event.move
//
// 1.3.6
//
// Stephen Band
//
// Triggers 'movestart', 'move' and 'moveend' events after
// mousemoves following a mousedown cross a distance threshold,
// similar to the native 'dragstart', 'drag' and 'dragend' events.
// Move events are throttled to animation frames. Move event objects
// have the properties:
//
// pageX:
// pageY:   Page coordinates of pointer.
// startX:
// startY:  Page coordinates of pointer at movestart.
// distX:
// distY:  Distance the pointer has moved since movestart.
// deltaX:
// deltaY:  Distance the finger has moved since last event.
// velocityX:
// velocityY:  Average velocity over last few events.


(function (module) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Register as an anonymous module.
		define(['jquery'], module);
	} else {
		// Browser globals
		module(jQuery);
	}
})(function(jQuery, undefined){

	var // Number of pixels a pressed pointer travels before movestart
			// event is fired.
			threshold = 6,
	
			add = jQuery.event.add,
	
			remove = jQuery.event.remove,

			// Just sugar, so we can have arguments in the same order as
			// add and remove.
			trigger = function(node, type, data) {
				jQuery.event.trigger(type, data, node);
			},

			// Shim for requestAnimationFrame, falling back to timer. See:
			// see http://paulirish.com/2011/requestanimationframe-for-smart-animating/
			requestFrame = (function(){
				return (
					window.requestAnimationFrame ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame ||
					window.oRequestAnimationFrame ||
					window.msRequestAnimationFrame ||
					function(fn, element){
						return window.setTimeout(function(){
							fn();
						}, 25);
					}
				);
			})(),
			
			ignoreTags = {
				textarea: true,
				input: true,
				select: true,
				button: true
			},
			
			mouseevents = {
				move: 'mousemove',
				cancel: 'mouseup dragstart',
				end: 'mouseup'
			},
			
			touchevents = {
				move: 'touchmove',
				cancel: 'touchend',
				end: 'touchend'
			};


	// Constructors
	
	function Timer(fn){
		var callback = fn,
				active = false,
				running = false;
		
		function trigger(time) {
			if (active){
				callback();
				requestFrame(trigger);
				running = true;
				active = false;
			}
			else {
				running = false;
			}
		}
		
		this.kick = function(fn) {
			active = true;
			if (!running) { trigger(); }
		};
		
		this.end = function(fn) {
			var cb = callback;
			
			if (!fn) { return; }
			
			// If the timer is not running, simply call the end callback.
			if (!running) {
				fn();
			}
			// If the timer is running, and has been kicked lately, then
			// queue up the current callback and the end callback, otherwise
			// just the end callback.
			else {
				callback = active ?
					function(){ cb(); fn(); } : 
					fn ;
				
				active = true;
			}
		};
	}


	// Functions
	
	function returnTrue() {
		return true;
	}
	
	function returnFalse() {
		return false;
	}
	
	function preventDefault(e) {
		e.preventDefault();
	}
	
	function preventIgnoreTags(e) {
		// Don't prevent interaction with form elements.
		if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }
		
		e.preventDefault();
	}

	function isLeftButton(e) {
		// Ignore mousedowns on any button other than the left (or primary)
		// mouse button, or when a modifier key is pressed.
		return (e.which === 1 && !e.ctrlKey && !e.altKey);
	}

	function identifiedTouch(touchList, id) {
		var i, l;

		if (touchList.identifiedTouch) {
			return touchList.identifiedTouch(id);
		}
		
		// touchList.identifiedTouch() does not exist in
		// webkit yet… we must do the search ourselves...
		
		i = -1;
		l = touchList.length;
		
		while (++i < l) {
			if (touchList[i].identifier === id) {
				return touchList[i];
			}
		}
	}

	function changedTouch(e, event) {
		var touch = identifiedTouch(e.changedTouches, event.identifier);

		// This isn't the touch you're looking for.
		if (!touch) { return; }

		// Chrome Android (at least) includes touches that have not
		// changed in e.changedTouches. That's a bit annoying. Check
		// that this touch has changed.
		if (touch.pageX === event.pageX && touch.pageY === event.pageY) { return; }

		return touch;
	}


	// Handlers that decide when the first movestart is triggered
	
	function mousedown(e){
		var data;

		if (!isLeftButton(e)) { return; }

		data = {
			target: e.target,
			startX: e.pageX,
			startY: e.pageY,
			timeStamp: e.timeStamp
		};

		add(document, mouseevents.move, mousemove, data);
		add(document, mouseevents.cancel, mouseend, data);
	}

	function mousemove(e){
		var data = e.data;

		checkThreshold(e, data, e, removeMouse);
	}

	function mouseend(e) {
		removeMouse();
	}

	function removeMouse() {
		remove(document, mouseevents.move, mousemove);
		remove(document, mouseevents.cancel, mouseend);
	}

	function touchstart(e) {
		var touch, template;

		// Don't get in the way of interaction with form elements.
		if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }

		touch = e.changedTouches[0];
		
		// iOS live updates the touch objects whereas Android gives us copies.
		// That means we can't trust the touchstart object to stay the same,
		// so we must copy the data. This object acts as a template for
		// movestart, move and moveend event objects.
		template = {
			target: touch.target,
			startX: touch.pageX,
			startY: touch.pageY,
			timeStamp: e.timeStamp,
			identifier: touch.identifier
		};

		// Use the touch identifier as a namespace, so that we can later
		// remove handlers pertaining only to this touch.
		add(document, touchevents.move + '.' + touch.identifier, touchmove, template);
		add(document, touchevents.cancel + '.' + touch.identifier, touchend, template);
	}

	function touchmove(e){
		var data = e.data,
				touch = changedTouch(e, data);

		if (!touch) { return; }

		checkThreshold(e, data, touch, removeTouch);
	}

	function touchend(e) {
		var template = e.data,
				touch = identifiedTouch(e.changedTouches, template.identifier);

		if (!touch) { return; }

		removeTouch(template.identifier);
	}

	function removeTouch(identifier) {
		remove(document, '.' + identifier, touchmove);
		remove(document, '.' + identifier, touchend);
	}


	// Logic for deciding when to trigger a movestart.

	function checkThreshold(e, template, touch, fn) {
		var distX = touch.pageX - template.startX,
				distY = touch.pageY - template.startY;

		// Do nothing if the threshold has not been crossed.
		if ((distX * distX) + (distY * distY) < (threshold * threshold)) { return; }

		triggerStart(e, template, touch, distX, distY, fn);
	}

	function handled() {
		// this._handled should return false once, and after return true.
		this._handled = returnTrue;
		return false;
	}

	function flagAsHandled(e) {
		e._handled();
	}

	function triggerStart(e, template, touch, distX, distY, fn) {
		var node = template.target,
				touches, time;

		touches = e.targetTouches;
		time = e.timeStamp - template.timeStamp;

		// Create a movestart object with some special properties that
		// are passed only to the movestart handlers.
		template.type = 'movestart';
		template.distX = distX;
		template.distY = distY;
		template.deltaX = distX;
		template.deltaY = distY;
		template.pageX = touch.pageX;
		template.pageY = touch.pageY;
		template.velocityX = distX / time;
		template.velocityY = distY / time;
		template.targetTouches = touches;
		template.finger = touches ?
			touches.length :
			1 ;

		// The _handled method is fired to tell the default movestart
		// handler that one of the move events is bound.
		template._handled = handled;
			
		// Pass the touchmove event so it can be prevented if or when
		// movestart is handled.
		template._preventTouchmoveDefault = function() {
			e.preventDefault();
		};

		// Trigger the movestart event.
		trigger(template.target, template);

		// Unbind handlers that tracked the touch or mouse up till now.
		fn(template.identifier);
	}


	// Handlers that control what happens following a movestart

	function activeMousemove(e) {
		var timer = e.data.timer;

		e.data.touch = e;
		e.data.timeStamp = e.timeStamp;
		timer.kick();
	}

	function activeMouseend(e) {
		var event = e.data.event,
				timer = e.data.timer;
		
		removeActiveMouse();

		endEvent(event, timer, function() {
			// Unbind the click suppressor, waiting until after mouseup
			// has been handled.
			setTimeout(function(){
				remove(event.target, 'click', returnFalse);
			}, 0);
		});
	}

	function removeActiveMouse(event) {
		remove(document, mouseevents.move, activeMousemove);
		remove(document, mouseevents.end, activeMouseend);
	}

	function activeTouchmove(e) {
		var event = e.data.event,
				timer = e.data.timer,
				touch = changedTouch(e, event);

		if (!touch) { return; }

		// Stop the interface from gesturing
		e.preventDefault();

		event.targetTouches = e.targetTouches;
		e.data.touch = touch;
		e.data.timeStamp = e.timeStamp;
		timer.kick();
	}

	function activeTouchend(e) {
		var event = e.data.event,
				timer = e.data.timer,
				touch = identifiedTouch(e.changedTouches, event.identifier);

		// This isn't the touch you're looking for.
		if (!touch) { return; }

		removeActiveTouch(event);
		endEvent(event, timer);
	}

	function removeActiveTouch(event) {
		remove(document, '.' + event.identifier, activeTouchmove);
		remove(document, '.' + event.identifier, activeTouchend);
	}


	// Logic for triggering move and moveend events

	function updateEvent(event, touch, timeStamp, timer) {
		var time = timeStamp - event.timeStamp;

		event.type = 'move';
		event.distX =  touch.pageX - event.startX;
		event.distY =  touch.pageY - event.startY;
		event.deltaX = touch.pageX - event.pageX;
		event.deltaY = touch.pageY - event.pageY;
		
		// Average the velocity of the last few events using a decay
		// curve to even out spurious jumps in values.
		event.velocityX = 0.3 * event.velocityX + 0.7 * event.deltaX / time;
		event.velocityY = 0.3 * event.velocityY + 0.7 * event.deltaY / time;
		event.pageX =  touch.pageX;
		event.pageY =  touch.pageY;
	}

	function endEvent(event, timer, fn) {
		timer.end(function(){
			event.type = 'moveend';

			trigger(event.target, event);
			
			return fn && fn();
		});
	}


	// jQuery special event definition

	function setup(data, namespaces, eventHandle) {
		// Stop the node from being dragged
		//add(this, 'dragstart.move drag.move', preventDefault);
		
		// Prevent text selection and touch interface scrolling
		//add(this, 'mousedown.move', preventIgnoreTags);
		
		// Tell movestart default handler that we've handled this
		add(this, 'movestart.move', flagAsHandled);

		// Don't bind to the DOM. For speed.
		return true;
	}
	
	function teardown(namespaces) {
		remove(this, 'dragstart drag', preventDefault);
		remove(this, 'mousedown touchstart', preventIgnoreTags);
		remove(this, 'movestart', flagAsHandled);
		
		// Don't bind to the DOM. For speed.
		return true;
	}
	
	function addMethod(handleObj) {
		// We're not interested in preventing defaults for handlers that
		// come from internal move or moveend bindings
		if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
			return;
		}
		
		// Stop the node from being dragged
		add(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid, preventDefault, undefined, handleObj.selector);
		
		// Prevent text selection and touch interface scrolling
		add(this, 'mousedown.' + handleObj.guid, preventIgnoreTags, undefined, handleObj.selector);
	}
	
	function removeMethod(handleObj) {
		if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
			return;
		}
		
		remove(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid);
		remove(this, 'mousedown.' + handleObj.guid);
	}
	
	jQuery.event.special.movestart = {
		setup: setup,
		teardown: teardown,
		add: addMethod,
		remove: removeMethod,

		_default: function(e) {
			var event, data;
			
			// If no move events were bound to any ancestors of this
			// target, high tail it out of here.
			if (!e._handled()) { return; }

			function update(time) {
				updateEvent(event, data.touch, data.timeStamp);
				trigger(e.target, event);
			}

			event = {
				target: e.target,
				startX: e.startX,
				startY: e.startY,
				pageX: e.pageX,
				pageY: e.pageY,
				distX: e.distX,
				distY: e.distY,
				deltaX: e.deltaX,
				deltaY: e.deltaY,
				velocityX: e.velocityX,
				velocityY: e.velocityY,
				timeStamp: e.timeStamp,
				identifier: e.identifier,
				targetTouches: e.targetTouches,
				finger: e.finger
			};

			data = {
				event: event,
				timer: new Timer(update),
				touch: undefined,
				timeStamp: undefined
			};
			
			if (e.identifier === undefined) {
				// We're dealing with a mouse
				// Stop clicks from propagating during a move
				add(e.target, 'click', returnFalse);
				add(document, mouseevents.move, activeMousemove, data);
				add(document, mouseevents.end, activeMouseend, data);
			}
			else {
				// We're dealing with a touch. Stop touchmove doing
				// anything defaulty.
				e._preventTouchmoveDefault();
				add(document, touchevents.move + '.' + e.identifier, activeTouchmove, data);
				add(document, touchevents.end + '.' + e.identifier, activeTouchend, data);
			}
		}
	};

	jQuery.event.special.move = {
		setup: function() {
			// Bind a noop to movestart. Why? It's the movestart
			// setup that decides whether other move events are fired.
			add(this, 'movestart.move', jQuery.noop);
		},
		
		teardown: function() {
			remove(this, 'movestart.move', jQuery.noop);
		}
	};
	
	jQuery.event.special.moveend = {
		setup: function() {
			// Bind a noop to movestart. Why? It's the movestart
			// setup that decides whether other move events are fired.
			add(this, 'movestart.moveend', jQuery.noop);
		},
		
		teardown: function() {
			remove(this, 'movestart.moveend', jQuery.noop);
		}
	};

	add(document, 'mousedown.move', mousedown);
	add(document, 'touchstart.move', touchstart);

	// Make jQuery copy touch event properties over to the jQuery event
	// object, if they are not already listed. But only do the ones we
	// really need. IE7/8 do not have Array#indexOf(), but nor do they
	// have touch events, so let's assume we can ignore them.
	if (typeof Array.prototype.indexOf === 'function') {
		(function(jQuery, undefined){
			var props = ["changedTouches", "targetTouches"],
					l = props.length;
			
			while (l--) {
				if (jQuery.event.props.indexOf(props[l]) === -1) {
					jQuery.event.props.push(props[l]);
				}
			}
		})(jQuery);
	};
});

/* !Animation Core */

/*
 * Viewport - jQuery selectors for finding elements in viewport
 *
 * Copyright (c) 2008-2009 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *  http://www.appelsiini.net/projects/viewport
 *
 */

	$.belowthefold = function(element, settings) {
		var fold = $window.height() + $window.scrollTop();
		return fold <= $(element).offset().top - settings.threshold;
	};
	$.abovethetop = function(element, settings) {
		var top = $window.scrollTop();
		return top >= $(element).offset().top + $(element).height() - settings.threshold;
	};
	$.rightofscreen = function(element, settings) {
		var fold = $window.width() + $window.scrollLeft();
		return fold <= $(element).offset().left - settings.threshold;
	};
	$.leftofscreen = function(element, settings) {
		var left = $window.scrollLeft();
		return left >= $(element).offset().left + $(element).width() - settings.threshold;
	};
	$.inviewport = function(element, settings) {
		return !$.rightofscreen(element, settings) && !$.leftofscreen(element, settings) && !$.belowthefold(element, settings) && !$.abovethetop(element, settings);
	};

	$.extend($.expr[':'], {
		"below-the-fold": function(a, i, m) {
			return $.belowthefold(a, {threshold : 0});
		},
		"above-the-top": function(a, i, m) {
			return $.abovethetop(a, {threshold : 0});
		},
		"left-of-screen": function(a, i, m) {
			return $.leftofscreen(a, {threshold : 0});
		},
		"right-of-screen": function(a, i, m) {
			return $.rightofscreen(a, {threshold : 0});
		},
		"in-viewport": function(a, i, m) {
			return $.inviewport(a, {threshold : -30});
		}
	});


	// !- Animation "onScroll" loop
	function doAnimation() {
		if(!dtGlobals.isMobile){
			if($(".animation-at-the-same-time").length > 0 || $(".animate-element").length > 0){
				var j = -1;
				$(".animation-at-the-same-time:in-viewport").each(function () {
					var $this = $(this),
						$thisElem = $this.find(".animate-element");
					//if (!$thisElem.hasClass("start-animation") && !$thisElem.hasClass("animation-triggered")) {
						$thisElem.addClass("animation-triggered");
						$this.find(".animate-element:not(.start-animation)").addClass("start-animation");
					//};
				});
				$(".animate-element:not(.start-animation):in-viewport").each(function () {
					var $this = $(this);
					if (!$this.parents(".animation-at-the-same-time").length > 0) {

						if (!$this.hasClass("start-animation") && !$this.hasClass("animation-triggered")) {
							$this.addClass("animation-triggered");
							j++;
							setTimeout(function () {
								$this.addClass("start-animation");
								if($this.hasClass("skills")){
									$this.animateSkills();
								};
							}, 200 * j);
						};
					};
				});
			}
		}
		else {
			$(".skills").animateSkills();
		};
	};


	// !- Fire animation
	setTimeout(function() {
		doAnimation();
	}, 50);

	if (!dtGlobals.isMobile ){
		$window.on("scroll", function () {
			doAnimation();
		});
	};


/* #Check if element exists
================================================== */
	$.fn.exists = function() {
		if ($(this).length > 0) {
			return true;
		} else {
			return false;
		}
	}

	/* !- Check if element is loaded */
	$.fn.loaded = function(callback, jointCallback, ensureCallback){
		var len	= this.length;
		if (len > 0) {
			return this.each(function() {
				var	el		= this,
					$el		= $(el),
					blank	= "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

				$el.on("load.dt", function(event) {
					$(this).off("load.dt");
					if (typeof callback == "function") {
						callback.call(this);
					}
					if (--len <= 0 && (typeof jointCallback == "function")){
						jointCallback.call(this);
					}
				});

				if (!el.complete || el.complete === undefined) {
					el.src = el.src;
				} else {
					$el.trigger("load.dt")
				}
			});
		} else if (ensureCallback) {
			if (typeof jointCallback == "function") {
				jointCallback.call(this);
			}
			return this;
		}
	};



/* #Photo slider core
================================================== */
// ;(function($){
	$.fn.exists = function() {
		if ($(this).length > 0) {
			return true;
		} else {
			return false;
		}
	}

	$.fn.loaded = function(callback, jointCallback, ensureCallback){
		var len = this.length;
		if (len > 0) {
			return this.each(function() {
				var el    = this,
					$el  = $(el),
					blank = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

				$el.on("load.dt", function(event) {
					$(this).off("load.dt");
					if (typeof callback == "function") {
						callback.call(this);
					}
					if (--len <= 0 && (typeof jointCallback == "function")){
						jointCallback.call(this);
					}
				});

				if (!el.complete || el.complete === undefined) {
					el.src = el.src;
				} else {
					$el.trigger("load.dt")
				}
			});
		} else if (ensureCallback) {
			if (typeof jointCallback == "function") {
				jointCallback.call(this);
			}
			return this;
		}
	};

	$.rsCSS3Easing = {
		easeOutSine: 'cubic-bezier(0.390, 0.575, 0.565, 1.000)',
		easeInOutSine: 'cubic-bezier(0.445, 0.050, 0.550, 0.950)'
	};

	$.extend(jQuery.easing, {
		easeInOutSine: function (x, t, b, c, d) {
			return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
		},
		easeOutSine: function (x, t, b, c, d) {
			return c * Math.sin(t/d * (Math.PI/2)) + b;
		},
		easeOutCubic: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		}
	});

	$.thePhotoSlider = function(element, settings) {
		var self = $(element).data("thePhotoSlider");

		if (!self) {
			this._init(element, settings);
		}
		else {
			self.update();
		};
	};

	$.thePhotoSlider.defaults = {
		mode: {
			type: "slider"
		},
		responsive: true,
		height: false,
		width: false,
		sidePaddings: 0,
		storeHTML: false,
		autoPlay: false,
		threshold: 20,
		resizeImg: false,
		imageScaleMode:"none",
		imageAlignCenter:false,
		collapsePoint: 700,
		transformEnable: true,
		calcAutoHeight :false,
		columBasedResize: false,
		resizeHeight: false
	};

	$.thePhotoSlider.prototype = {
		_init: function(element, settings) {
			var self = this;
			self.st = $.extend({}, $.thePhotoSlider.defaults, settings);
			self.ev = $(self);

			self.autoPlay = {
				enabled: false,
				delay: 2000,
				loop: true
			};

			self.currSlide = 0;
			self.noSlide = true;
			self.lockLeft = true;
			self.lockRight = true;

			self.sliderLock = false;
			self.lockTimeout = false;

			self.wrap = {};
			self.wrap.$el = $(element);
			self.wrap.width = 0;
			self.wrap.height = false;
			self.wrap.$el.data("thePhotoSlider", self);

			self.viewport = self.wrap.$el.find(".ts-viewport");

			self.cont = {};
			self.cont.$el = self.viewport.find(".ts-cont");
			self.cont.width = 0;
			self.cont.startX = 0;
			self.cont.instantX = 0;
	 
			self.slides = {};
			self.slides.$items = self.cont.$el.children();
			self.slides.number = self.slides.$items.length;
			self.slides.position = [];
			self.slides.width = [];
			self.slides.isLoaded = [];

			self.drag = {};
			self.drag.isMoving = false;
			self.drag.startX = 0;
			self.drag.startY = 0;
			self.drag.offsetX = 0;
			self.drag.offsetY = 0;
			self.drag.lockX = false;
			self.drag.lockY = false;

			self.features = {};
			self._featureDetection();

			if (self.st.storeHTML) self.origHTML = self.wrap.$el.html();
			self._buildHTML();

			self._calcSliderSize();
			self._resizeImage();
			if (!self.wrap.height) self.wrap.$el.addClass("ts-autoHeight");

			self._setSliderWidth();
			self._adjustSlides();
			self._setSliderHeight();

			/* if (self.st.mode.type === "centered") */ self.slideTo(0, true);

			if (!self.noSlide) self._bindEvents();

			setTimeout(function() {
				self.wrap.$el.addClass("ts-ready");
				self.ev.trigger("sliderReady");
			}, 20);

			if (self.st.responsive) {
				if (!("onorientationchange" in window)) {
					var dtResizeTimeout;

					$(window).on("resize", function(e) {
						clearTimeout(dtResizeTimeout);
						dtResizeTimeout = setTimeout(function() {
							self.update();
						}, 200);
					});
				}
				else {
					var scrOrientation = window.orientation;

					$(window).on("orientationchange", function(e) {
						var tempOrientation = window.orientation;

						if (tempOrientation !== scrOrientation) {
							scrOrientation = tempOrientation;
							self.update();
						};
					});
				};
			};

			if(self.st.autoPlay.enabled) {
				self.play();
			};
		},

		_featureDetection: function() {
			var self = this,
				tempStyle = document.createElement('div').style,
				vendors = ['webkit','Moz','ms','O'],
				tempV;
				self.features.vendor = '';


			for (i = 0; i < vendors.length; i++ ) {
				tempV = vendors[i];
				if (!self.features.vendor && (tempV + 'Transform') in tempStyle ) {
					self.features.vendor = "-"+tempV.toLowerCase()+"-";
				}
			}
			
			if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 && !('ontouchstart' in window)) {
				self.features.css3d = Modernizr.csstransforms3d;
				//self.features.css3d = false;
			}
			else if (typeof Modernizr != "undefined") {
				self.features.css3d = Modernizr.csstransforms3d;
				//self.features.css3d = false;
			}
		
		},

		_buildHTML: function() {
			var self = this;

			if (self.st.mode.type === "centered") {
				self.wrap.$el.addClass("ts-centered");
			};

			if (self.st.mode.type === "slider") {
				self.slides.$items.addClass("ts-slide");
			}
			else if (self.st.mode.type === "scroller" || self.st.mode.type === "centered" || self.st.mode.type === "carousel") {
				self.slides.$items.addClass("ts-cell");
			};
		},

		_calcSliderSize: function() {
			var self = this,
				typeofWidth = typeof self.st.width,
				typeofHeight = typeof self.st.height,
				tempWidth = false,
				tempHeight = false;

			self.wrap.width = self.wrap.$el.width();

			if (typeofWidth === "function") {
				tempWidth = self.st.width(this);
			}
			else if (typeofWidth === "number") {
				tempWidth = self.st.width;
			};

			if (typeofHeight === "function") {
				tempHeight = self.st.height(this);
			}
			else if (typeofHeight === "number") {
				tempHeight = self.st.height;
			};

			if (tempHeight && !tempWidth) { 
				// Calculate once or on resize (if typeofHeight === "function")
				self.wrap.height = tempHeight;
			}
			else if (tempHeight && tempWidth) {
				// Calculate on resize
				self.wrap.height = ( tempHeight * self.wrap.width ) / tempWidth;
			}
			else {
				// Calculate on every slide change and resize
				self.wrap.height = false;
			};
		},

		_resizeImage:function() {

			var self = this;
			var $slide = $(self.slides.$items[i]);

			if (self.st.resizeImg === true) {
				self.cont.width = 0;
				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};
					var img = $slide.find("img");
					var classToFind = 'rsMainSlideImage';
					var isVideo;
					var imgAlignCenter = self.st.imageAlignCenter,
						imgScaleMode = self.st.imageScaleMode,
						tempEl;

					if(!img) {
						return;
					}

					var baseImageWidth = parseInt(img.attr("width")),
						baseImageHeight = parseInt(img.attr("height"));


					//slideObject.isRendered = true;
					if(imgScaleMode === 'none') {
						return;
					}
					var containerWidth = self.wrap.width,
						containerHeight = self.wrap.height,
						hRatio,
						vRatio,
						ratio,
						nWidth,
						nHeight,
						cssObj = {};

					if(imgScaleMode === 'fit-if-smaller') {
						if(baseImageWidth > containerWidth || baseImageHeight > containerHeight) {
							imgScaleMode = 'fit';
						}
					}
					if(imgScaleMode === 'fill' || imgScaleMode === 'fit') {   
						hRatio = containerWidth / baseImageWidth;
						vRatio = containerHeight / baseImageHeight;

						if (imgScaleMode  == "fill") {
							ratio = hRatio > vRatio ? hRatio : vRatio;                          
						} else if (imgScaleMode  == "fit") {
							ratio = hRatio < vRatio ? hRatio : vRatio;                    
						} else {
							ratio = 1;
						}

						nWidth = Math.ceil(baseImageWidth * ratio, 10);
						nHeight = Math.ceil(baseImageHeight * ratio, 10);
					} else {                
						nWidth = baseImageWidth;
						nHeight = baseImageHeight;    

					}
					if(imgScaleMode !== 'none') {
						cssObj.width = nWidth;
						cssObj.height = nHeight;

					}
					if (imgAlignCenter) { 
						cssObj.marginLeft = Math.floor((containerWidth - nWidth) / 2);
						cssObj.marginTop = Math.floor((containerHeight - nHeight) / 2);
					}
					img.css(cssObj);
				})
			}
		},

		_setSliderWidth: function() {
			var self = this;

			if (self.st.mode.type !== "centered") {
				self.viewport.css({
					width: self.wrap.width
				});
			}
			else if (self.wrap.width > self.st.collapsePoint) {
				self.wrap.$el.removeClass("ts-collapsed");
			}
			else {
				self.wrap.$el.addClass("ts-collapsed");
			};
		},

		_setSliderHeight: function() {
			var self = this;

			if (typeof self.wrap.height === "number") {
				// Fixed & proportional height
				self.viewport.css({
					height: self.wrap.height
				});
			}
			else if (self.st.mode.type === "scroller" || self.st.mode.type === "centered" || self.st.mode.type === "carousel") {
				// Auto height; scroller and centered only
				//Aply responsive height 
				if(self.st.resizeHeight){
					var articleHeights = $(self.viewport).find("article").map(function() {
					    return $(this).height();
					}).get();

					// Math.max takes a variable number of arguments
					// `apply` is equivalent to passing each height as an argument
					var maxHeight = Math.max.apply(null, articleHeights);
					self.viewport.css({
						height: maxHeight
					});
					$(self.slides.$items).css({
						height: maxHeight
					});
				}
				if (self.viewport.css("height") === "0px" || self.viewport.css("height") == 0 || !self.viewport.css("height")) {
					self.viewport.css({
						height: Math.max.apply(null, self.slides.height)
					});
				};
			}
			else if (self.slides.isLoaded[self.currSlide]) {
				// Auto height; current slide is loaded
				var jsHeight = $(self.slides.$items[self.currSlide]).height();

				if (jsHeight > 0) {
					self.viewport.css({
						height: jsHeight
					});
				}
				else {
					// !This will cause "collapsed" slider
					self.viewport.css({
						height: "auto"
					});
				};
			}
			else {
				// Auto height; current slide is NOT loaded
				var jsHeight = $(self.slides.$items[self.currSlide]).height();

				if (jsHeight > 0) {
					self.viewport.css({
						height: jsHeight
					});
				}
				else {
					// !This will cause "collapsed" slider
					self.viewport.css({
						height: auto
					});
				};
				// !What this doing here (instead of _adjustSlides)
	/*
				self.slides.$items[self.currSlide].find("img").loaded(false, function() {
					$(self.slides.$items[self.currSlide]).addClass("ts-loaded");
					self._setSliderHeight();
				}, true);
	*/
			};
		},

		_adjustSlides: function() {
			var self = this;

			if (self.st.mode.type === "slider") {
				self.cont.width = 0;

				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};
					
					self.slides.position[i] = - self.cont.width - self.st.sidePaddings/2;
					self.cont.width = self.cont.width + self.wrap.width + self.st.sidePaddings;
					//if (self.wrap.height) tempCSS.height = self.wrap.height;
					tempCSS.left = -self.slides.position[i];

					if (!self.slides.isLoaded[i]) {
						$slide.find("img").loaded(false, function() {
							self.slides.isLoaded[i] = true;
							$slide.addClass("ts-loaded");
						}, true);
					} else {
					};

					$slide.css(tempCSS);
				});
			}
			else if (self.st.mode.type === "centered") {
					self.cont.width = 0;
					self.slides.contRatio = [];
					self.slides.ratio = [];

				if (self.st.mode.lsMinW || self.st.mode.lsMaxW) {
					var lsMinW = self.wrap.width/100 * self.st.mode.lsMinW,
						lsMaxW = self.wrap.width/100 * self.st.mode.lsMaxW;
				};

				if (self.st.mode.ptMinW || self.st.mode.ptMaxW) {
					var ptMinW = self.wrap.width/100 * self.st.mode.ptMinW,
						ptMaxW = self.wrap.width/100 * self.st.mode.ptMaxW;
				};

				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};

					var dataWidth = $slide.attr("data-width") ? parseFloat($slide.attr("data-width")) : $slide.width(),
						dataHeight = $slide.attr("data-height") ? parseFloat($slide.attr("data-height")) : $slide.height();
					

					if (!self.slides.contRatio[i]) {
						self.slides.contRatio[i] =  dataWidth / dataHeight;

						if (self.slides.contRatio[i] > 1) {
							$slide.addClass("ts-ls");
						}
						else {
							$slide.addClass("ts-pt");
						};
					};

					if (self.wrap.width > self.st.collapsePoint) {
						dataHeight = self.wrap.height;
						dataWidth = self.wrap.height * self.slides.contRatio[i];
	
						if ((lsMinW || lsMaxW) && (dataWidth > dataHeight)) {
							if (lsMinW === lsMaxW || dataWidth > lsMaxW) {
								dataWidth = lsMaxW;
							}
							else if (dataWidth < lsMinW) {
								dataWidth = lsMinW;
							};
						}
						else if ((ptMinW || ptMaxW) && (dataWidth <= dataHeight)) {
							if (ptMinW === ptMaxW || dataWidth > ptMaxW) {
								dataWidth = ptMaxW;
							}
							else if (dataWidth < ptMinW) {
								dataWidth = ptMinW;
							};            
						};
	
						self.slides.ratio[i] = dataWidth / dataHeight;

						tempCSS.height = self.wrap.height;
						tempCSS.width = self.slides.width[i] = dataWidth;
	
						self.slides.position[i] = - self.cont.width;
						self.cont.width = self.cont.width + self.slides.width[i] + self.st.sidePaddings;
						tempCSS.left = -self.slides.position[i];
					}
					else {
						dataHeight = tempCSS.height = self.wrap.height;
						dataWidth = self.slides.width[i] = tempCSS.width = self.wrap.width;
						self.slides.ratio[i] = dataWidth / dataHeight;

						self.slides.position[i] = - self.cont.width;
						self.cont.width = self.cont.width + self.slides.width[i];

						tempCSS.left = -self.slides.position[i];
					};

					// Adjust position to slide center
					self.slides.position[i] = self.slides.position[i] - (self.slides.width[i]/2);


					if (self.slides.ratio[i] > self.slides.contRatio[i]) {
						$slide.removeClass("ts-narrow");
						$slide.addClass("ts-wide");
					}
					else {
						$slide.removeClass("ts-wide");
						$slide.addClass("ts-narrow");
					};

					if (!self.slides.isLoaded[i]) {
						$slide.find("img").loaded(false, function() {
							self.slides.isLoaded[i] = true;
							$slide.addClass("ts-loaded");
						}, true);
					} 
					else {
					};

					$slide.css(tempCSS);

				});
			}
			else if (self.st.mode.type === "scroller") {
				self.cont.width = 0;
				self.slides.ratio = [];
				if (!(typeof self.wrap.height === "number")) {
					self.slides.height = [];
				}
				//determine if max-width has %
				if(typeof self.slides.$items.parents(".slider-wrapper").attr("data-max-width") != "undefined"){
					var dataMaxWidth = (self.slides.$items.parents(".slider-wrapper").width() * parseFloat(self.slides.$items.parents(".slider-wrapper").attr("data-max-width")))/100;
					
				}

				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};

					var dataWidth = $slide.attr("data-width") ? parseFloat($slide.attr("data-width")) : $slide.width(),
						dataHeight = $slide.attr("data-height") ? parseFloat($slide.attr("data-height")) : $slide.height();
					
					if(dataWidth > dataMaxWidth){
						var dataWidth = dataMaxWidth;
					}
	
					if (dataWidth > 0 && dataHeight > 0) {
						self.slides.ratio[i] =  dataWidth / dataHeight;
					}
					else {
						self.slides.ratio[i] = 1;
					};

	
					if (typeof self.wrap.height === "number") {
						// Fixed & proportional height
						self.slides.width[i] = self.wrap.height * self.slides.ratio[i];
	
						tempCSS.width = self.slides.width[i];
						tempCSS.height = self.slides.width[i] / self.slides.ratio[i]; 
					}
					else if (dataWidth > 0 && dataHeight > 0) {
						// Auto height;
						if (!self.slides.width[i]) tempCSS.width = self.slides.width[i] = dataWidth;
						if (!self.slides.height[i] && !self.st.resizeHeight) { 
							tempCSS.height = "100%";
						};
						self.slides.height[i] = dataHeight;
					}
					else {
						// Auto height;
						$slide.css("height", "auto");

						self.slides.width[i] = $slide.width();
						self.slides.height[i] = $slide.height();

						tempCSS.height = "100%";
					};
					if(self.st.columBasedResize) {
						self.slides.width[i] = $slide.width();
						
					}
					self.slides.position[i] = - self.cont.width;
					self.cont.width = self.cont.width + self.slides.width[i];
					if (i < self.slides.number - 1) self.cont.width += self.st.sidePaddings
					tempCSS.left = -self.slides.position[i] //+ self.st.sidePaddings/2;
					
	
					if (!self.slides.isLoaded[i]) {
						$slide.find("img").loaded(false, function() {
							self.slides.isLoaded[i] = true;
							$slide.addClass("ts-loaded");
						}, true);
					}
					else {
					};
	
					$slide.css(tempCSS);
				});
			}
			else if (self.st.mode.type === "carousel") {
				self.cont.width = 0;

				var perView =  self.st.mode.perView,
					minWidth = self.st.mode.minWidth,
					cellWidth = self.wrap.width/perView;
		
				while (cellWidth < minWidth && perView > 0.31) {
					perView--;
					if (perView < 1) perView = 1;
					cellWidth = self.wrap.width/perView;
				};

				self.perView = perView;
				//self.st.sidePaddings = 0;
		
				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};

					self.slides.position[i] = - self.cont.width;
					self.cont.width = self.cont.width + cellWidth;
					tempCSS.width = cellWidth - self.st.sidePaddings;
					tempCSS.left = -self.slides.position[i] + self.st.sidePaddings/2;

					$slide.css(tempCSS);
				});
			};

			// Adjusting slides conteiner position and updating navigation
			if ( (self.st.mode.type !== "centered") && (self.cont.width <= self.wrap.width) ) {
				self.noSlide = true;
				self._transitionStart(0, 0, "easeInOutSine", true);
				self.cont.$el.css( "left", (self.wrap.width - self.cont.width) / 2 );

				self.lockLeft = true;
				self.lockRight = true;
				self.ev.trigger("updateNav");
			}
			else if ( (self.st.mode.type === "centered") && (self.slides.number < 2) /* && (self.cont.width <= self.wrap.width / 2) */ ) {
				self.noSlide = true;
				self._transitionStart(0, 0, "easeInOutSine", true);
				self.cont.$el.css( "left", -(self.cont.width) / 2 );

				self.lockLeft = true;
				self.lockRight = true;
				self.ev.trigger("updateNav");
			}
			else {
				self.noSlide = false;
				self.cont.$el.css( "left", "" );

				if (self.lockRight) {
					self.lockLeft = false;
					self.lockRight = true;
					self.ev.trigger("lockRight").trigger("updateNav");
				}
				else if ( self.currSlide <= 0 ) {
					self.lockLeft = true;
					self.lockRight = false;
					self.ev.trigger("lockLeft").trigger("updateNav");
				}
				else if ( self.currSlide > 0 ) {
					self.lockLeft = false;
					self.lockRight = false;
					self.ev.trigger("updateNav");
				};
			};
		},

		_unifiedEvent: function(event) {
			if (event.originalEvent.touches !== undefined && event.originalEvent.touches[0]) {
				event.pageX = event.originalEvent.touches[0].pageX;
				event.pageY = event.originalEvent.touches[0].pageY;
			}
			return event;
		},

		_unifiedX: function() {
			var self = this,
				coord = 0,
				css3dTransform = self.cont.$el.css("transform");

			if (css3dTransform) {
				var css3dArray = css3dTransform.split(", ");
			}

			if (self.features.css3d && css3dTransform !== "none" && css3dArray[0] === "matrix(1") {
				coord = parseFloat(css3dArray[4]);
			}
			else if (self.features.css3d && css3dTransform !== "none" && css3dArray[0] === "matrix3d(1") {
				coord = parseFloat(css3dArray[12]);
			}
			else {
				//coord = self.cont.$el.position().left;
				coord = parseFloat(self.cont.$el.css("left"));
			};

			return coord;
		},

		_bindEvents: function() {
			var self = this;
			if(self.st.transformEnable){
				self.wrap.$el.on("mousedown.theSlider touchstart.theSlider", function(event) {
					if (event.type != "touchstart") event.preventDefault();

					self._onStart( self._unifiedEvent(event) );

					$(document).on("mousemove.theSlider touchmove.theSlider", function(event) {
						self._onMove( self._unifiedEvent(event) );
					});
					$(document).on("mouseup.theSlider mouseleave.theSlider touchend.theSlider touchcancel.theSlider", function(event) {
						$(document).off("mousemove.theSlider mouseup.theSlider mouseleave.theSlider touchmove.theSlider touchend.theSlider touchcancel.theSlider");
						self._onStop( self._unifiedEvent(event) );
					});
				});
			}
		},

		_unbindEvents: function() {
			var self = this;

			self.wrap.$el.off("mousedown.theSlider touchstart.theSlider");
			$(document).off("mousemove.theSlider mouseup.theSlider mouseleave.theSlider touchmove.theSlider touchend.theSlider touchcancel.theSlider");
		},

		_onStart: function(event) {
			var self = this;

			if (!self.drag.isMoving && !self.sliderLock) {
				//self._transitionEnd();

				self.drag.isMoving = true;
				self.drag.startX = event.pageX;
				self.drag.startY = event.pageY;
				self.cont.startX = self._unifiedX();

				self.drag.offsetX = 0;
				self.drag.offsetY = 0;
				self.drag.lockX = false;
				self.drag.lockY = false;
			}
			else {
				//self._transitionCancel();
			};
		},

		_onMove: function(event) {
			var self = this,
				coord = 0;
				//self.pause();
			self.ev.trigger('psOnMove');
			if (self.drag.isMoving) {
				self.drag.offsetX = event.pageX - self.drag.startX;
				self.drag.offsetY = event.pageY - self.drag.startY;

				if ( (Math.abs(self.drag.offsetX) >= self.st.threshold-1) && (Math.abs(self.drag.offsetX) > Math.abs(self.drag.offsetY)) && !self.drag.lockX ) {
					self.drag.lockX = false;
					self.drag.lockY = true;
					if (event.type == "touchmove") self.drag.offsetY = 0;
				} 
				else if( (Math.abs(self.drag.offsetY) >= self.st.threshold-1) && (Math.abs(self.drag.offsetX) < Math.abs(self.drag.offsetY)) && !self.drag.lockY ) {
					self.drag.lockX = true;
					self.drag.lockY = false;
					if (event.type == "touchmove") self.drag.offsetX = 0;
				};

				if (self.drag.lockX && event.type == "touchmove") self.drag.offsetX = 0;
				else if (self.drag.lockY && event.type == "touchmove") self.drag.offsetY = 0;

				if (self.drag.lockY) event.preventDefault();

				self.cont.instantX = self.cont.startX + self.drag.offsetX;

				if ( self.cont.instantX < 0 && self.cont.instantX > -self.cont.width + self.viewport.width()) {
					coord = self.cont.instantX;
				}
				else if (self.cont.instantX >= 0) {
					coord = self.cont.instantX/4;
				}
				else {
					coord = (-self.cont.width + self.viewport.width()) + ((self.cont.width - self.viewport.width() + self.cont.instantX) / 4);
				};

				self._doDrag(coord);
			};


			if (self.st.autoPlay.enabled) {
				self.pause();
			};
		},

		_onStop: function(event) {
			var self = this;
			//self.pause()
			self.ev.trigger('psOnStop');

			if (self.drag.isMoving) {
				self.cont.instantX = self.cont.startX + self.drag.offsetX;

				if (Math.abs(self.drag.offsetX) > self.st.threshold) {
					self.wrap.$el.addClass("ts-interceptClicks");
					self.wrap.$el.one("click.preventClick", function(e) {
						e.preventDefault();
						e.stopImmediatePropagation();
						e.stopPropagation();
					}); 
					window.setTimeout(function() {
						self.wrap.$el.off('click.preventClick');
						self.wrap.$el.removeClass("ts-interceptClicks");
					}, 301);
				};

				self._autoAdjust();
				self._setSliderHeight();

				self.cont.startX = 0;
				self.cont.instantX = 0;
		
				self.drag.isMoving = false;
				self.drag.startX = 0;
				self.drag.startY = 0;
				self.drag.offsetX = 0;
				self.drag.offsetY = 0;
				self.drag.lockX = false;
				self.drag.lockY = false;
			};

			if(self.st.autoPlay.enabled) {
				self.play();
			}

			return false;
		},

		_doDrag: function(coord) {
			var self = this;
		//	self.pause();
			if(self.st.transformEnable){
				if (self.features.css3d) {
					var tempCSS = {};

					tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
					tempCSS["transform"] = "translate3d("+coord+"px,0,0)";
					tempCSS[self.vendor+"transition"] = "";
					tempCSS["transition"] = "";

					self.cont.$el.css(tempCSS);
				}
				else {
					self.cont.$el.css({
						"left": coord
					});
				};
			}
		},

		_calcCurrSlide: function(coord) {
			var self = this,
				tempCurrSlide = self.slides.number - 1;

			self.slides.$items.each(function(i) {
				if ( coord > self.slides.position[i] ) {
					tempCurrSlide = i-1;
					return false;
				};
			});
			if (tempCurrSlide < 0) tempCurrSlide = 0;

			return tempCurrSlide;
		},

		_isRightExceed: function(coord) {
			var self = this,
				edge = 0;

			if (self.st.mode.type === "centered") {
				edge = self.slides.position[self.slides.number - 1];
			}
			else {
				edge = -self.cont.width + self.viewport.width();
			};

			if (coord < edge) {
				return true;
			}
			else {
				return false;
			};
		},

		_autoAdjust: function() {
			var self = this,
				adjustTo = 0,
				duration = 0,
				tempCurrSlide = self.slides.number - 1;

			/*
			if (self.drag.offsetX == 0) {
				console.log("No movement. Canceling _autoAdjust.");
				return false;
			}
			*/

			if (self.cont.instantX >= 0) {
				// leftmost edge reached
				adjustTo = self.slides.position[0];
				self.currSlide = 0;

				self.lockLeft = true;
				self.lockRight = false;
				self.ev.trigger("lockLeft").trigger("updateNav");
			}
			else if ( self._isRightExceed(self.cont.instantX) ) {
				// rightmost edge reached
				if (self.st.mode.type === "centered") {
					adjustTo = self.slides.position[self.slides.number-1];
				}
				else {
					adjustTo = -self.cont.width + self.viewport.width();
				};

				self.currSlide = self._calcCurrSlide(adjustTo);

				self.lockLeft = false;
				self.lockRight = true;
				self.ev.trigger("lockRight").trigger("updateNav");
			}
			else {
				// autoadjust to closest slide
				if (self.drag.offsetX < -self.st.threshold) {
					// flick from right to left
					tempCurrSlide = self._calcCurrSlide(self.cont.instantX) + 1;

					if (self._isRightExceed(self.slides.position[tempCurrSlide])) {
						adjustTo = -self.cont.width + self.viewport.width();

						for ( i = tempCurrSlide; i >= 0; i-- ) {
							if (!self._isRightExceed(self.slides.position[i])) {
								tempCurrSlide = i;
								break;
							}
						}

						self.lockLeft = false;
						self.lockRight = true;
						self.ev.trigger("lockRight").trigger("updateNav");
					}
					else {
						adjustTo = self.slides.position[tempCurrSlide];

						if  ( tempCurrSlide < self.slides.number - 1 ) {
							self.lockLeft = false;
							self.lockRight = false;
							self.ev.trigger("updateNav");
						}
						else {
							self.lockLeft = false;
							self.lockRight = true;
							self.ev.trigger("lockRight").trigger("updateNav");
						};
					};

					self.currSlide = tempCurrSlide;
				}
				else if (self.drag.offsetX > self.st.threshold) {
					// flick from left to right
					self.currSlide = self._calcCurrSlide(self.cont.instantX);
					adjustTo = self.slides.position[self.currSlide];

					if ( self.currSlide > 0 ) {
						self.lockLeft = false;
						self.lockRight = false;
						self.ev.trigger("updateNav");
					}
					else {
						self.lockLeft = true;
						self.lockRight = false;
						self.ev.trigger("lockLeft").trigger("updateNav");
					};
				}
				else {
					// flick cenceled, since it's to short
					adjustTo = self.cont.startX;
				};

			};


			//duration = Math.sqrt(Math.abs(self.cont.instantX - adjustTo)) * 15 + 50;
			// duration = Math.abs(self.cont.instantX - adjustTo)/2 + 100;
			duration = Math.sqrt(Math.abs(self.cont.instantX - adjustTo)) * 10 + 100;
			self._transitionStart(adjustTo, duration, "easeOutSine");
		},

		_transitionStart: function(coord, duration, easing, justSet) {
			var self = this,
				tempCSS = {},
				cssEasing = $.rsCSS3Easing[easing];

			self._transitionEnd();
			self.ev.trigger("beforeTransition");

			if (justSet) {
				if(self.st.transformEnable){
					if (self.features.css3d) {
						tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
						tempCSS["transform"] = "translate3d("+coord+"px,0,0)";
					}
					else {
						//console.log("and, here's the issue");
						tempCSS.left = coord;
					};
				}

				self.cont.$el.css(tempCSS);
				return false;
			}

			self.ev.trigger("beforeTransition");

			self.sliderLock = true;
			clearTimeout(self.lockTimeout);
			self.lockTimeout = setTimeout(function() {
				self.sliderLock = false;
				self.ev.trigger("afterTransition");
			}, duration);
			if(self.st.transformEnable){
				if (self.features.css3d) {
					tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
					tempCSS["transform"] = "translate3d("+coord+"px,0,0)";
					tempCSS[self.features.vendor+"transition"] = "all "+duration+"ms "+cssEasing;
					tempCSS["transition"] = "all "+duration+"ms "+cssEasing;

					self.cont.$el.css(tempCSS);

					self.cont.$el.one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function() {
						//self.sliderLock = false;
						//console.log("Release slider. sliderLock: "+self.sliderLock);

						//self._transitionEnd();
					});
				}
				else {
					//self.sliderLock = false;
					//console.log("Release slider. sliderLock: "+self.sliderLock);
					self.cont.$el.animate({
						"left": coord
					}, duration, easing);
				};
			}
		},

		_transitionEnd: function() {
			var self = this;
			self.ev.trigger('psTransitionEnd');
			if(self.st.transformEnable){
				if (self.features.css3d) {
					var tempCSS = {};
						tempCSS[self.vendor+"transition"] = "";
						tempCSS["transition"] = "";

					self.cont.$el.css(tempCSS);
				}
				else {
					self.cont.$el.stop();
				};
			}
		},

		_transitionCancel: function() {
			var self = this,
				coord = self.cont.$el.position().left,
				tempCSS = {};

			tempCSS[self.vendor+"transition"] = "";
			tempCSS["transition"] = "";

			self.cont.$el.off("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend");
			if(self.st.transformEnable){
				if (self.features.css3d) {
					var str = self.cont.$el.css("transform"),
						result = str.split(", ");

					coord = result[4];

					tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
					tempCSS["transform"] = "translate3d("+coord+"px,0,0)";

					self.cont.$el.css(tempCSS);
				}
				else {
					self.cont.$el.stop();
					self.cont.$el.animate({
						"left": coord
					}, duration, easing);
				};
			}
		},

		pause: function() {
			var self = this;
			self.ev.trigger('autoPlayPause');
			self._autoPlayRunning = false;
			if( self._autoPlayTimeout) {
				clearTimeout(self._autoPlayTimeout);
				self._autoPlayTimeout = null;
			}
			
		},

		slideTo: function(slideID, justSet) {
			var self = this,
				slideToX = self.slides.position[slideID],
				duration = 0,
				oldID = self.currSlide;
			 self.pause();
			self.ev.trigger('psBeforeAnimStart');

			if (self.noSlide) return false;

			self._transitionEnd();

			if (slideToX >= self.slides.position[0]) {
				// leftmost edge reached
				self.currSlide = 0;

				self.lockLeft = true;
				self.lockRight = false;
				self.ev.trigger("lockLeft").trigger("updateNav");
			}
			else if ( self._isRightExceed(slideToX) || slideID >= self.slides.number - 1 ) {
				// rightmost edge reached
				if (self.st.mode.type === "centered") {
					slideToX = self.slides.position[slideID];
					self.currSlide = slideID;
				}
				else {
					slideToX = -self.cont.width + self.viewport.width();
					self.currSlide = self._calcCurrSlide(slideToX);
				};

				self.lockLeft = false;
				self.lockRight = true;
				self.ev.trigger("lockRight").trigger("updateNav");
			}
			else {
				self.currSlide = slideID;

				self.lockLeft = false;
				self.lockRight = false;
				self.ev.trigger("updateNav");
			};

			//duration = Math.abs(self.slides.position[oldID] - slideToX)/2 + 100;
			duration = Math.sqrt(Math.abs(self.slides.position[oldID] - slideToX)) * 10 + 100;
			self._transitionStart(slideToX, duration, "easeInOutSine", justSet);

			if ( /*$(".auto-play-btn").hasClass('paused')*/self.st.autoPlay.enabled) {
				self.play();
			}
			if(self.st.calcAutoHeight){
				self._setSliderHeight();
			}
		},
		// stopAutoPlay: function() {
		// 	var self = this;
		// 	self._autoPlayPaused = self._autoPlayEnabled = false;
		// 	self.pause();
		// },
		startPlay: function() {
			var self = this;
			self.ev.trigger('autoPlayPlay');
			if (self.currSlide + 1 <= self.slides.number - 1 && !self.lockRight) {
				self.slideTo(self.currSlide + 1);
			}
			else if (self.currSlide >= self.slides.number-1 && self.st.autoPlay.loop) {
				self.slideTo(0);
			}
			else if (self.lockRight && self.st.autoPlay.loop) {
				self.slideTo(0);
			}
			// if(self.st.calcAutoHeight){
			// 	self._setSliderHeight();
			// }

			/*
			if (self.st.mode.type === "centered") {
				slideToX = self.slides.position[slideID];
				self.currSlide = slideID;
			}
			else {
				slideToX = -self.cont.width + self.viewport.width();
				self.currSlide = self._calcCurrSlide(slideToX);
			};
			*/
		},

		play: function() {
			var self = this;
			self.ev.trigger('autoPlayPlay');
			self._autoPlayRunning = true;
			if(self._autoPlayTimeout) {
				clearTimeout(self._autoPlayTimeout);
			}
			self._autoPlayTimeout = setTimeout( function() {
				self.startPlay();
			}, self.st.autoPlay.delay );
		},

		slideNext: function() {
			var self = this;

			if (self.currSlide + 1 <= self.slides.number - 1) {
				self.slideTo(self.currSlide + 1);
			}
			else {
				return false;
			};
		},

		slidePrev: function() {
			var self = this;

			if (self.currSlide - 1 >= 0) {
				self.slideTo(self.currSlide - 1);
			}
			else if (self.currSlide == 0 && self.lockLeft == false) {
				self.slideTo(self.currSlide);
			}
			else {
				return false;
			};
		},

		update: function() {
			var self = this;

			self._calcSliderSize();
			self._resizeImage();
			self._setSliderWidth();
			self._adjustSlides();
			self._setSliderHeight();
			self._doDrag();

			if (self.noSlide) {
				self.slideTo(0, true);
				self._unbindEvents();
			}
			else {
				self.slideTo(self.currSlide, true);
				self._bindEvents();
			}
		}
	};

	$.fn.thePhotoSlider = function(settings) {
		return this.each(function() {
			new $.thePhotoSlider(this, settings);
		});
	};

// })(jQuery);


/* #Shortcodes scroller
================================================== */
// jQuery(document).ready(function($) {
	$.fn.scrollerSlideSize = function() {

		return this.each(function() {
			//var $this = $(this);
	//$(".fullwidth-slider .fs-entry").not(".text-on-img .fullwidth-slider .fs-entry").each(function(i) {
			var $this = $(this),
				$img = $this.find("img").eq(0),
				imgW = parseInt($img.attr("width")),
				imgH = parseInt($img.attr("height")),
				$container = $this.parents(".slider-wrapper"),
				$containerWidth = $container.width(),
				$maxWidth = $container.attr("data-max-width"),
				 sideSpace = parseInt($container.attr("data-padding-side"));
			
			

			var leftPadding = parseInt($img.parents(".wf-td").eq(0).css("paddingLeft")),
				rightPadding = parseInt($img.parents(".wf-td").eq(0).css("paddingRight")),
				addedW = 0;

			if (leftPadding > 0 && rightPadding > 0) addedW = leftPadding + rightPadding;

			
			//determine if max width has px or %
			if(typeof $maxWidth != "undefined"){
				var dataMaxWidth = ($containerWidth * parseFloat($maxWidth))/100 - addedW - sideSpace;
			}

			if(imgW > dataMaxWidth){
				var colmnW = dataMaxWidth;
			}else{
				var colmnW = parseInt($img.attr("width"));
				if (!$img.exists()) colmnW = 280;
			}

		
			$this.attr("data-width", colmnW + addedW).css({
				width: colmnW + addedW,
				opacity: 1
			});

		
				var $imgPar = $img.parent("a, .rollover-video"),
					imgParW = $imgPar.width(),
					imgParH = (imgH * imgParW) / imgW;

				$img.parent("a, .rollover-video").css({
					height: imgParH
				});
				$(".fs-entry-content:not(.buttons-on-img)", $this).css("opacity", "1");
		})
	}
	$(".fullwidth-slider .fs-entry").not(".text-on-img .fullwidth-slider .fs-entry").scrollerSlideSize()
	//$(".fullwidth-slider .fs-entry").not(".text-on-img .fullwidth-slider .fs-entry").find("article").css("height", "100%");
	
	

	$window.on("debouncedresize", function( event ) {
		$(".fullwidth-slider .fs-entry").not(".text-on-img .fullwidth-slider .fs-entry").scrollerSlideSize();
		//$(".fullwidth-slider .fs-entry").not(".text-on-img .fullwidth-slider .fs-entry").find("article").css("height", "100%");
		$(".fullwidth-slider").find(".ts-wrap").each(function(){
			var scroller = $(this).data("thePhotoSlider");
			if(typeof scroller!= "undefined"){
				scroller.update();
			};
		});

		
		$(".text-on-img .fullwidth-slider .fs-entry, .description-on-hover .fs-entry, .dt-photos-shortcode .fs-entry").each(function() {
			var $this = $(this);

			$(".rollover-project", $this).css({
				"width": $this.attr("data-width"),
				"height": $this.attr("data-height")
			});
		});
		
	});

	//$(".slider-wrapper:not(.enable-mobile-arrows)").on( "touchmove", doStuff );



	$.fn.shortcodesScroller = function() {
		var $el = $(this),
			slides = {},
			thumbs = "";

			slides.$items = $el.children(".fs-entry"),
			slides.count = slides.$items.length;

		$el.addClass("ts-cont");
		$el.wrap('<div class="ts-wrap"><div class="ts-viewport"></div></div>');

		var scroller = $el.parents(".ts-wrap"),
			$this_par = $el.parents(".slider-wrapper"),
			windowW = $window.width(),
			paddings = $this_par.attr("data-padding-side") ? parseInt($this_par.attr("data-padding-side")) : 0,
			$sliderAutoslide = ( 'true' === $this_par.attr("data-autoslide") ) ? true : false,
			$sliderAutoslideDelay = $this_par.attr("data-delay") && parseInt($this_par.attr("data-delay")) > 999 ? parseInt($this_par.attr("data-delay")) : 5000,
			$sliderLoop = ( 'true' === $this_par.attr("data-loop") ) ? true : false,
			$enableTransform = dtGlobals.isMobile && !$this_par.hasClass("enable-mobile-arrows") ? false : true,
			$colmnResize = $this_par.hasClass("resize-by-browser-width") ? false : true,
			$resizeHeight = typeof $this_par.attr("data-max-width") != "undefined" ? true : false;


		var $sliderData = scroller.thePhotoSlider({
			mode: {
				type: "scroller"
			},
			columBasedResize: $resizeHeight,
			//resizeImg: false,
			//imageScaleMode: "fill",
			resizeHeight: $resizeHeight,
			sidePaddings: paddings,
			autoPlay: {
				enabled: $sliderAutoslide,
				delay: $sliderAutoslideDelay,
				loop: $sliderLoop
			},
			transformEnable: $enableTransform
		}).data("thePhotoSlider");

		$(".prev", $this_par).click(function() {
			if (!$sliderData.noSlide) $sliderData.slidePrev();
		});
		$(".next", $this_par).click(function() {
			if (!$sliderData.noSlide) $sliderData.slideNext();
		});

		$sliderData.ev.on("updateNav sliderReady", function() {
			if ($sliderData.lockRight) {
				$(".next", $this_par).addClass("disabled");
			} else {
				$(".next", $this_par).removeClass("disabled");
			};

			if ($sliderData.lockLeft) {
				$(".prev", $this_par).addClass("disabled");
			} else {
				$(".prev", $this_par).removeClass("disabled");
			};
			if ($sliderData.lockRight && $sliderData.lockLeft) {
				$this_par.addClass("hide-arrows");
			};
		});

		scroller.hover(
			function() {
				if($sliderAutoslide) {
					$sliderData._autoPlayPaused = false;
					$sliderData.pause();
					$sliderData._pausedByHover = true;
				}
			},
			function() {
				if($sliderAutoslide) {
					$sliderData._pausedByHover = false;
					if(!$sliderData._pausedByClick){
						$sliderData.play();
					}
				}
			}
		);
	};

	$(".slider-wrapper .blog-media").css({
		"height": ""
	});

	$(".fullwidth-slider ul.clearfix").each(function(){
		$(this).shortcodesScroller();
	});

	var $sliderWrapper = $(".slider-wrapper");

	$sliderWrapper.css("visibility", "visible");

	$sliderWrapper.each(function(){
		var $this = $(this),
			$thisUl = $this.find(".ts-wrap").data("thePhotoSlider");

		$this.append('<a href="#" class="auto-play-btn"></a>');

		$this.on("mouseenter", function(e) {
			$this.addClass("show-arrows");
		});
		$this.on("mouseleave", function(e) {
			//setTimeout(function(){
				$this.removeClass("show-arrows");
			//}, 200);
		});

		if( $thisUl.st.autoPlay.enabled ){
			$(".auto-play-btn", $this).addClass("paused");
		}
		$(".auto-play-btn", $this).on("click", function(e){
			e.preventDefault();
			var $this = $(this);
			if( $this.hasClass("paused")){
				$this.removeClass("paused");
				$thisUl._pausedByClick = true;
				if (!$thisUl.noSlide) $thisUl.pause();
				$thisUl.st.autoPlay.enabled = false;
			}else{
				$this.addClass("paused");
				$thisUl._pausedByClick = false;
				if (!$thisUl.noSlide) $thisUl.play();
				$thisUl.st.autoPlay.enabled = true;
			}
		});

	});


	//Scroller slideshow

	$.fn.postTypeScroller = function() {
		var $el = $(this),
			slides = {},
			thumbs = "";

			slides.$items = $el.children("li"),
			slides.count = slides.$items.length;

		$el.addClass("ts-cont");
		$el.wrap('<div class="ts-wrap"><div class="ts-viewport photoSlider-wrap"></div></div>');
		if($el.hasClass("shortcode-photo-slider")){
			$el.parents(".ts-wrap").addClass("shortcode-slider-wrap")
		}

		var $slider = $el.parents(".ts-wrap"),
			$this_par = $el,
			windowW = $window.width(),
			paddings = $this_par.attr("data-padding-side") ? parseInt($this_par.attr("data-padding-side")) : 0,
			$sliderAutoslideEnable = ( 'true' != $this_par.attr("data-paused") && typeof $this_par.attr("data-autoslide") != "undefined" ) ? true : false,
			$sliderAutoslide = ( 'true' === $this_par.attr("data-paused") ) ? false : true,
			$sliderAutoslideDelay = $this_par.attr("data-autoslide") && parseInt($this_par.attr("data-autoslide")) > 999 ? parseInt($this_par.attr("data-autoslide")) : 5000,
			$sliderLoop = (  typeof $this_par.attr("data-autoslide") != "undefined" ) ? true : false,
			$sliderWidth = $this_par.attr("data-width") ? parseInt($this_par.attr("data-width")) : 800,
			$sliderHight = $this_par.attr("data-height") ? parseInt($this_par.attr("data-height")) : 400,
			imgMode = $this_par.attr("data-img-mode") ? $this_par.attr("data-img-mode") : "fill";

		var $sliderData = $slider.thePhotoSlider({
			mode: {
				type: "slider"
			},
			height: $sliderHight,
			width: $sliderWidth,
			//sidePaddings: paddings,
			resizeImg: true,
			imageScaleMode: imgMode,
			imageAlignCenter:true,
			autoPlay: {
				enabled: $sliderAutoslideEnable,
				delay: $sliderAutoslideDelay,
				loop: $sliderLoop
			}
		}).data("thePhotoSlider");

		//Append slider navigation
		$('<div class="leftArrow"></div><div class="rightArrow"></div>').insertAfter($el);
		//Append slider play/pause btn
		if(typeof $this_par.attr("data-autoslide") != "undefined"){
			$('<div class="psPlay"></div>').insertAfter($el);
		}

		if( 'true' === $this_par.attr("data-paused") ){
			$(".psPlay", $slider).addClass("paused");
		};
		$(".psPlay", $slider).on("click", function(e){
			e.preventDefault();
			var $this = $(this);
			if( $this.hasClass("paused")){
				$this.removeClass("paused");
				if (!$sliderData.noSlide) $sliderData.play();
				$sliderData.st.autoPlay.enabled = true;
			}else{
				$this.addClass("paused");
				if (!$sliderData.noSlide) $sliderData.pause();
				$sliderData.st.autoPlay.enabled = false;
			}
		});

		$(".leftArrow", $slider).click(function() {
			if (!$sliderData.noSlide) $sliderData.slidePrev();
		});
		$(".rightArrow", $slider).click(function() {
			if (!$sliderData.noSlide) $sliderData.slideNext();
		});

		$sliderData.ev.on("updateNav sliderReady", function() {
			if ($sliderData.lockRight) {
				$(".rightArrow", $slider).addClass("disabled");
			} else {
				$(".rightArrow", $slider).removeClass("disabled");
			};

			if ($sliderData.lockLeft) {
				$(".leftArrow", $slider).addClass("disabled");
			} else {
				$(".leftArrow", $slider).removeClass("disabled");
			};
			if ($sliderData.lockRight && $sliderData.lockLeft) {
				$this_par.addClass("hide-arrows");
			};
		});

		// scroller.hover(
		// 	function() {
		// 		if($sliderAutoslide) {
		// 			$sliderData._autoPlayPaused = false;
		// 			$sliderData.pause();
		// 			$sliderData._pausedByHover = true;
		// 		}
		// 	},
		// 	function() {
		// 		if($sliderAutoslide) {
		// 			$sliderData._pausedByHover = false;
		// 			if(!$sliderData._pausedByClick){
		// 				$sliderData.play();
		// 			}
		// 		}
		// 	}
		// );
	};
	$("ul.photoSlider:not(.slider-masonry)").each(function(){
		$(this).postTypeScroller();
	});
	$("ul.photoSlider").css("visibility", "visible");


	
	$.fn.postTypeContentScroller = function() {
		var $el = $(this),
			slides = {},
			thumbs = "";

			slides.$items = $el.children("li"),
			slides.count = slides.$items.length;

		$el.addClass("ts-cont");
		$el.wrap('<div class="ts-wrap contentSlider-wrap"><div class="ts-viewport"></div></div>');
		// if($el.hasClass("shortcode-photo-slider")){
		// 	$el.parents(".ts-wrap").addClass("shortcode-slider-wrap")
		// }

		var $slider = $el.parents(".ts-wrap"),
			$this_par = $el,
			windowW = $window.width(),
			paddings = $this_par.attr("data-padding-side") ? parseInt($this_par.attr("data-padding-side")) : 0,
			$sliderAutoslideEnable = ( 'true' != $this_par.attr("data-paused") && typeof $this_par.attr("data-autoslide") != "undefined" ) ? true : false,
			$sliderAutoslide = ( 'true' === $this_par.attr("data-paused") ) ? false : true,
			$sliderAutoslideDelay = $this_par.attr("data-autoslide") && parseInt($this_par.attr("data-autoslide")) > 999 ? parseInt($this_par.attr("data-autoslide")) : 5000,
			$sliderLoop = (  typeof $this_par.attr("data-autoslide") != "undefined" ) ? true : false,
			$sliderWidth = $this_par.attr("data-width") ? parseInt($this_par.attr("data-width")) : 800,
			$sliderHight = $this_par.attr("data-height") ? parseInt($this_par.attr("data-height")) : 400,
			imgMode = $this_par.attr("data-img-mode") ? $this_par.attr("data-img-mode") : "none";

		var $sliderData = $slider.thePhotoSlider({
			mode: {
				type: "slider"
			},
			 height: "auto",
			// width: false,
			//sidePaddings: paddings,
			resizeImg: true,
			imageScaleMode: "none",
			imageAlignCenter:true,
			calcAutoHeight: true,
			autoPlay: {
				enabled: $sliderAutoslideEnable,
				delay: $sliderAutoslideDelay,
				loop: $sliderLoop
			}
		}).data("thePhotoSlider");

		//Append slider navigation
		$('<div class="leftArrow"></div><div class="rightArrow"></div>').insertAfter($el);
	

		$(".leftArrow", $slider).click(function() {
			if (!$sliderData.noSlide) $sliderData.slidePrev();
		});
		$(".rightArrow", $slider).click(function() {
			if (!$sliderData.noSlide) $sliderData.slideNext();
		});

		$sliderData.ev.on("updateNav sliderReady", function() {
			if ($sliderData.lockRight) {
				$(".rightArrow", $slider).addClass("disabled");
			} else {
				$(".rightArrow", $slider).removeClass("disabled");
			};

			if ($sliderData.lockLeft) {
				$(".leftArrow", $slider).addClass("disabled");
			} else {
				$(".leftArrow", $slider).removeClass("disabled");
			};
			if ($sliderData.lockRight && $sliderData.lockLeft) {
				$this_par.addClass("hide-arrows");
			};
		});

		//Bullets
		var itemHTML = '<div class="psBullet"></div>';

		$this_par.addClass('psWithBullets');
		var out = '<div class="psNav psBullets">';
		for(var i = 0; i < $sliderData.slides.$items.length; i++) {
			out += itemHTML;
		}
		$sliderData._controlNav = out = $(out + '</div>');
		out.appendTo($slider);

		
		$sliderData.ev.on("sliderReady beforeTransition", function() {
			

			$sliderData._controlNav.find(".psBullet").removeClass("act");
			$sliderData._controlNav.find(".psBullet").eq($sliderData.currSlide).addClass("act");

		});
		$sliderData._controlNav.find(".psBullet").each(function(i) {
			$(this).on("click", function(event) {
				var $this = $(this);
				if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
				$sliderData.slideTo(i);
				//$sliderData.update();
			});
		});
		
		
	
	}
	$(".slider-content").each(function(){
		$(this).postTypeContentScroller();
	});
	$(".slider-content").css("visibility", "visible");
// })


/* #Main menu
================================================== */
// jQuery(document).ready(function($) {
	/* We need to fine-tune timings and do something about the usage of jQuery "animate" function */ 

	//Menu decoration Underline > Left to right

	$(".l-to-r-line > li:not(.menu-item-language) > a > span").not(".l-to-r-line > li > a > span.mega-icon").append("<i class='underline'></i>");

	//Menu/Buttons decoration Animation on click
	$(".btn-material .dt-btn, .btn-material a.button, .no-touchevents .masthead:not(.sub-downwards) .animate-click-decoration > .menu-item > a:not(.not-clickable-item), .no-touchevents .masthead:not(.sub-downwards) .main-nav .hover-style-click-bg > li > a:not(.not-clickable-item)").each(function(){
		var $this = $(this),
			rippleTimer;
		$this.addClass("ripple");
		$this.ripple();
		var $thisRipple = $(".rippleWrap", $this)
		$this.on("click", function(e){
			if(!$thisRipple.parent('a[href^="#"]').length > 0){
				e.preventDefault();
			}
		})
		.on("mousedown", function(e){
			if (e.which == 3) {
			}else if(e.shiftKey || e.ctrlKey || e.metaKey){
				  window.open($this.attr("href"), '_blank');
			}else{
				e.preventDefault();
				var $thisTarget = $this.attr("target") ? $this.attr("target") : "_self";
				clearTimeout( rippleTimer );
          	 	rippleTimer = setTimeout( function() {
					if(!$thisRipple.parent('a[href^="#"]').length > 0){
						
						window.open($this.attr("href"), $thisTarget);
						return false;
					}else{
						$(this).parent("a").trigger("click");
						return false;
					}
          	 	}, 200)
			}
			
		});
	});
	$(".not-clickable-item").on("click", function(e){
		e.preventDefault();
		e.stopPropagation();
	});

	//Menu decoration Background / outline / line > Hover/Active line
	if($(".active-line-decoration").length > 0 || $(".hover-line-decoration").length > 0){
		$(".main-nav > .menu-item > a").append("<span class='decoration-line'></span>");
	};

	//declare vars
	var $mainNav = $(".main-nav, .mini-nav"),
		$mainMenu = $(".masthead:not(.sub-downwards) .main-nav, .mini-nav"),
		$mainNavMob = $(".main-nav"),
		$sideHeader = $(".side-header");

	/*Wpml menu item*/
	$(".menu-item-language").each(function(){
		var $this = $(this);
		if($this.children('.submenu-languages').length > 0){
			$this.addClass("has-children");
		}
	});

	//
	

	var	$mobileNav = $mainNavMob.clone();
	var	$mobileTopNav = $(".mini-nav").clone();
	

	$(".mini-nav select").change(function() {
		window.location.href = $(this).val();
	});

	dtGlobals.isHovering = false;
	$(".main-nav li", $sideHeader).each(function(){
		var $this = $(this);
		if($this.hasClass("new-column")){
			var $thisPrev = $this.prev().find(" > .sub-nav");
			$(" > .sub-nav > *", $this).appendTo($thisPrev)
		}
	})
	$(".sub-downwards .main-nav > li").each(function(){
		var $this = $(this),
			$this_sub = $this.find(" > .dt-mega-menu-wrap > .sub-nav");
			$this_sub.unwrap();
	});

	/*Top bar select type menu menu*/
	var droupdownCustomMenu = $(".select-type-menu");
	if($(".masthead").find(".sub-nav").length > 0){
		var subMenuClassList = $(".masthead").find(".sub-nav").attr("class");
	}else{
		var subMenuClassList = "sub-nav";
	}
	droupdownCustomMenu.find("> ul").addClass(subMenuClassList ).css("visibility", "visible");

	/*Sub menu*/
	$mainMenu.each(function() {
		var $this = $(this);
		$(".act", $this).parents("li").addClass("act");
		$(" li.has-children ", $this).each(function() {
			var $this = $(this);
			if($this.parent().hasClass("main-nav") && !$this.parents().hasClass("side-header")){
				var $thisHover = $this.find("> a");
			}else if($this.parent().hasClass("main-nav") && $this.parents().hasClass("side-header")){
				var $thisHover = $this;
			}else if($this.parent().hasClass("sub-nav") || $this.parents().hasClass("mini-nav")){
				var $thisHover = $this;
			};

			if(dtGlobals.isMobile || dtGlobals.isWindowsPhone){
				$this.find("> a").on("click", function(e) {
					if (!$(this).hasClass("dt-clicked")) {
						e.preventDefault();
						$mainNav.find(".dt-clicked").removeClass("dt-clicked");
						$(this).addClass("dt-clicked");
					} else {
						e.stopPropagation();
					}
				});
			};
			var menuTimeoutShow,
				menuTimeoutHide;


			$thisHover.on("mouseenter tap", function(e) {
				var $this = $(this);
				if(e.type == "tap") e.stopPropagation();
				if($this.parent("li").length > 0){
					var $thisPar = $this.parent(),
						$subMenu = $this.siblings("div, ul");
				}else{
					var $thisPar = $this,
						$this_a = $this.find("> a"),
						$subMenu = $this_a.siblings("div, ul");
						//$this_of_l = $this.offset().left,
						//$this_a = $this.find("> a").offset().left;
				}
				var $this_of_l = $this.offset().left,
					$this_a = $this.offset().left,
					$masthead = $this.parents(".masthead");
				

				$thisPar.addClass("dt-hovered");
				if($thisPar.hasClass("dt-mega-menu")) $thisPar.addClass("show-mega-menu");

				dtGlobals.isHovering = true;

				/*Right overflow menu*/
				if ($page.width() - ($subMenu.offset().left - $page.offset().left) - $subMenu.width() < 0) {
					$subMenu.addClass("right-overflow");
				}				
				/*Bottom overflow menu*/
				if ($window.height() - ($subMenu.offset().top - dtGlobals.winScrollTop) - $subMenu.innerHeight() < 0) {
					$subMenu.addClass("bottom-overflow");
				};

				/*Left position*/
				if(!$sideHeader.length > 0){
					$subMenu.not(".right-overflow").css({
						left: $this_a - $this_of_l
					});
				};

				/*Mega menu auto width */
				if($thisPar.hasClass("mega-auto-width")){
					var $_this_par_width = $thisPar.width(),
						$_this_par_of_l = $masthead.offset().left,
						$_this_of_l = $thisPar.offset().left;
						$_this_parents_ofs = $thisPar.offset().left - $_this_par_of_l;

					if(!$sideHeader.length){
						var $pageW = $page.width();
						if($(".boxed").length > 0){
							var $_this_of_l = $thisPar.position().left;
						}else{
							var $_this_of_l = $thisPar.offset().left;
						}	
						
						if($subMenu.width()  > ($pageW - $thisPar.position().left)){
							$subMenu.css({
								left: -( $subMenu.innerWidth()  - ($pageW - $_this_of_l) )
							});
						}
						if($subMenu.width() > $pageW){
							if($(".boxed").length > 0){
								$subMenu.css({
									width: $masthead.width(),
									left: -($thisPar.position().left)
								});
							}else{
								$subMenu.css({
									width: $masthead.width(),
									left: -($_this_of_l - $_this_par_of_l)
								});
							}
						}
					}
				};

				/*Mega menu -> full width*/
				if($thisPar.hasClass("mega-full-width")){
					var $_this_of_l = $thisPar.offset().left;
					if($this.parents(".header-bar").length > 0){
						var $_this_par_w = $this.parents(".header-bar").innerWidth(),
							$_this_par_of_l = $this.parents(".header-bar").offset().left;
					}else{
						var $_this_par_w = $this.parents(".ph-wrap").innerWidth(),
							$_this_par_of_l = $this.parents(".ph-wrap").offset().left;
						
					}
					if(!$sideHeader.length > 0){
						$subMenu.css({
							width: $_this_par_w,
							left: -($_this_of_l - $_this_par_of_l)
						})
					}
				}

				clearTimeout(menuTimeoutShow);
				clearTimeout(menuTimeoutHide);

				menuTimeoutShow = setTimeout(function() {
					if($thisPar.hasClass("dt-hovered")){
						$subMenu.stop().css("visibility", "visible").animate({
							"opacity": 1
						}, 150);
					}
				}, 100);


			});

			$this.on("mouseleave", function(e) {
				var $this = $(this),
					$thisLink = $this.find("> a"),
					$subMenu = $thisLink.siblings("div, ul");

				$this.removeClass("dt-hovered");
				dtGlobals.isHovering = false;
				clearTimeout(menuTimeoutShow);
				clearTimeout(menuTimeoutHide);

				menuTimeoutHide = setTimeout(function() {
					if(!$this.hasClass("dt-hovered")){
						$subMenu.stop().animate({
							"opacity": 0
						}, 150, function() {
							$(this).css("visibility", "hidden");
						});

						$this.removeClass("show-mega-menu");
						
						setTimeout(function() {
							if(!$this.hasClass("dt-hovered")){
								$subMenu.removeClass("right-overflow");
								$subMenu.removeClass("bottom-overflow");
								if($this.hasClass("mega-auto-width")){
									$subMenu.css({
										width: "",
										left: ""
									});
								}
							}
						}, 400);
					}
				}, 150);

				$this.find("> a").removeClass("dt-clicked");

			});

		});
	});


	var menuTimeoutShow,
		menuTimeoutHide;
	droupdownCustomMenu.on("mouseenter tap", function(e) {
		if(e.type == "tap") e.stopPropagation();

		var $this = $(this);
		$this.addClass("dt-hovered");

		if ($page.width() - ($this.children(".sub-nav").offset().left - $page.offset().left) - $this.find(" > .sub-nav").width() < 0) {
			$this.children(".sub-nav").addClass("right-overflow");
		}

		if ($window.height() - ($this.children(".sub-nav").offset().top - dtGlobals.winScrollTop) - $this.children(".sub-nav").height() < 0) {
			$this.children(".sub-nav").addClass("bottom-overflow");
		};

		dtGlobals.isHovering = true;
		clearTimeout(menuTimeoutShow);
		clearTimeout(menuTimeoutHide);

		menuTimeoutShow = setTimeout(function() {
			if($this.hasClass("dt-hovered")){
				$this.children('.sub-nav').stop().css("visibility", "visible").animate({
					"opacity": 1
				}, 150);
			}
		}, 100);
	});

	droupdownCustomMenu.on("mouseleave", function(e) {
		var $this = $(this);
		$this.removeClass("dt-hovered");

		dtGlobals.isHovering = false;
		clearTimeout(menuTimeoutShow);
		clearTimeout(menuTimeoutHide);

		menuTimeoutHide = setTimeout(function() {
			if(!$this.hasClass("dt-hovered")){
				if(!$this.parents().hasClass("dt-mega-menu")){
					$this.children(".sub-nav").stop().animate({
						"opacity": 0
					}, 150, function() {
						$(this).css("visibility", "hidden");
					});
				}
				
				setTimeout(function() {
					if(!$this.hasClass("dt-hovered")){
						$this.children(".sub-nav").removeClass("right-overflow");
						$this.children(".sub-nav").removeClass("bottom-overflow");
					}
				}, 400);
			}
		}, 150);

	//	$this.find("> a").removeClass("dt-clicked");
	});
// });
	
// })


/* #Header
================================================== */

	
	var $topBar = $(".top-bar"),
		$mastheadHeader = $(".masthead"),
		$overlayHeader = $(".overlay-navigation"),
		$stickyHeader = $(".sticky-header"),
		$mainSlider = $("#main-slideshow, .photo-scroller"),
		$leftHeader = $(".header-side-left").length > 0,
		$rightHeader = $(".header-side-right").length > 0,
		$main = $("#main, #main-slideshow, .photo-scroller, .page-title, .fancy-header, .footer"),
		$topHeader = $(".floating-logo.side-header-menu-icon .branding, .side-header-h-stroke, #phantom"),
		$sideHeader = $(".side-header"),
		$movesideHeader = $(".move-header-animation").length > 0,
		$onePage = $(".page-template-template-microsite").length > 0,
		dtScrollTimeout;
		if($(".side-header-v-stroke").length > 0){			
			var $sideHeaderW = $sideHeader.width() - $(".side-header-v-stroke").width(),
				$delay = 200;
		}else{
			var $sideHeaderW = $sideHeader.width(),
				$delay = 0;
		}

	/* !-overlap header for webkit*/
		$overlapContent = $(".overlap #content");
	if ( !$.browser.webkit || dtGlobals.isMobile ){
	}else{
		$overlapContent.find(">:first-child").css({
			position: "relative",
			"z-index": "4"
		});
		if( $overlapContent.find(">:first-child").height() < 36 ){
			$overlapContent.find("> :nth-child(2)").css({
				position: "relative",
				"z-index": "4"
			})
		};
	};


	$.closeSideHeader = function(){
		$page.removeClass("show-header");
		$page.addClass("closed-header");
		$body.removeClass("show-sticky-header");
		//$(".mobile-sticky-header-overlay, .dt-mobile-menu-icon, .menu-toggle").removeClass("active");
		$(".sticky-header-overlay").removeClass("active");
		if($movesideHeader){
			if($leftHeader){
				$sideHeader.velocity({
					translateX : -100 + "%"
				}, 400);
			}else{
				$sideHeader.velocity({
					translateX : 100 + "%"
				}, 400);
			}
			$main.velocity({
				translateX : ""
			}, 400, function() {
				$main.css({
					"transform": "none"
				});
			});
			$topHeader.velocity({
				translateX : ""
			}, 400);
			
		};
	}
	$.closeMobileHeader = function(){
		$page.removeClass("show-mobile-header");
		$page.addClass("closed-mobile-header");
		$body.removeClass("show-sticky-mobile-header show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
		$(".mobile-sticky-header-overlay, .dt-mobile-menu-icon, .menu-toggle").removeClass("active");
		//$(".sticky-header-overlay").removeClass("active");
		
	}


	/*!-Show Hide side header*/
	if($stickyHeader.length > 0 || $overlayHeader.length > 0 ) {
		$('<div class="lines-button x"><span class="lines"></span></div>').appendTo(".menu-toggle");
		if($stickyHeader.length > 0) {
			$body.append('<div class="sticky-header-overlay"></div>');
			if(!$(".side-header-h-stroke").length > 0 && !$(".header-under-side-line").length > 0 && $(".mixed-header").length > 0){
				var mixedMenuToggle = $(".mixed-header").find(".menu-toggle").position().top;
				$(".mixed-header").find(".menu-toggle").clone(true).prependTo(".side-header").css({
					top: mixedMenuToggle
				});
			}
		};
		/*hiding side header*/
		if($movesideHeader){
			if($leftHeader){
				$sideHeader.velocity({
					translateX : -100 + "%"
				}, 0);
			}else if($rightHeader){
				$sideHeader.velocity({
					translateX : 100 + "%"
				}, 0);
			}
		};

		if( $overlayHeader.length > 0 ) {
			$($sideHeader).append('<div class="hide-overlay"></div>');
			$('<div class="lines-button x"><span class="lines"></span></div>').appendTo(".hide-overlay");
			
		}

		var $hamburger = $(".menu-toggle .lines-button"),
			$menuToggle = $(".menu-toggle"),
			$overlay = $(".sticky-header-overlay");

		$hamburger.on("click", function (){
			if(!$(".header-under-side-line").length > 0){
				var $this = $(".side-header .menu-toggle");
			}else{
				var $this = $(".menu-toggle");
			}
			if ($this.hasClass("active")){
				$this.removeClass("active");
				$page.removeClass("show-header").addClass("closed-header");
				$this.parents("body").removeClass("show-sticky-header");
				$overlay.removeClass("active");
				$(".hide-overlay").removeClass("active");
				if($movesideHeader){
					if($leftHeader){
						$sideHeader.velocity({
							translateX : -100 + "%"
						},
						{
							 duration: 400,
							 delay: $delay
						});
					}else{
						$sideHeader.velocity({
							translateX : 100 + "%"
						},
						{
							 duration: 400,
							 delay: $delay
						} );
					}
					if(!$page.hasClass("boxed")){
						$main.velocity({
							translateX : ""
						}, 400, function() {
							$main.css({
								"transform": "none"
							});
						});
						$topHeader.velocity({
							translateX : ""
						}, 400);
					}
				};
	
			}else{
				$menuToggle.removeClass("active");
				$this.addClass('active');
				$page.addClass("show-header").removeClass("closed-header");
				$this.parents("body").addClass("show-sticky-header");
				
				$overlay.addClass("active");
				$(".hide-overlay").addClass("active");
				if($movesideHeader){
					if($leftHeader){
						$sideHeader.velocity({
							translateX : ""
						}, 400);
						if(!$page.hasClass("boxed")){
							$main.velocity({
								translateX : $sideHeaderW
							}, {
								 duration: 400,
								 delay: $delay
							});
							$topHeader.velocity({
								translateX : $sideHeaderW
							}, 
							{
								duration: 400,
								 delay: $delay
							});
						}
					}else {
						$sideHeader.velocity({
							translateX : ""
						}, 400);
						if(!$page.hasClass("boxed")){
							$main.velocity({
								translateX : -$sideHeaderW
							},
							{
								duration: 400,
								 delay: $delay
							});
							$topHeader.velocity({
								translateX : -$sideHeaderW
							},
							{
								 duration: 400,
								 delay: $delay
							} );
						}
					}
				}
				
			};
		});
		$overlay.on("click", function (){
			if($(this).hasClass("active")){
				$menuToggle.removeClass("active");
				$page.removeClass("show-header").addClass("closed-header");
				$body.removeClass("show-sticky-header");
				$overlay.removeClass("active");
				if($movesideHeader){
					if($leftHeader){
						$sideHeader.velocity({
							translateX : -100 + "%"
						}, 
						{
							 duration: 400,
							 delay: $delay
						});
					}else{
						$sideHeader.velocity({
							translateX : 100 + "%"
						}, 
						{
							 duration: 400,
							 delay: $delay
						});
					}
					$main.velocity({
						translateX : ""
					}, 400, function() {
						$main.css({
							"transform": "none"
						});
					});
					$topHeader.velocity({
						translateX : ""
					}, 400);
				}
			}
		});
		$(".hide-overlay").on("click", function (){
			if($(this).hasClass("active")){
				$menuToggle.removeClass("active");
				$page.removeClass("show-header");
				$page.addClass("closed-header");
				$body.removeClass("show-sticky-header");
				$overlay.removeClass("active");
				if($movesideHeader){
					if($leftHeader){
						$sideHeader.velocity({
							translateX : -100 + "%"
						},
						{
							 duration: 400,
							 delay: $delay
						} );
					}else{
						$sideHeader.velocity({
							translateX : 100 + "%"
						}, 
						{
							 duration: 400,
							 delay: $delay
						});
					}
					$main.velocity({
						translateX : ""
					}, 400, function() {
						$main.css({
							"transform": "none"
						});
					});
					$topHeader.velocity({
						translateX : ""
					}, 400);
				}
			}
		});
	};

	/* !- Right-side header + boxed layout */
	function ofX() {

		var $windowW = $window.width(),
			$boxedHeaderPos = ($windowW - $page.innerWidth())/2,
			$sideHeaderToggleExist = $(".side-header-menu-icon").length > 0;

		if ($body.hasClass("header-side-right") && $page.hasClass("boxed")) {
			if(!$stickyHeader.length > 0){
				$sideHeader.css({
					right: $boxedHeaderPos
				});
			};
			if($sideHeaderToggleExist){
				$menuToggle.css({
					right: $boxedHeaderPos
				});
				$(".branding").css({
					left: $boxedHeaderPos
				});
			}
		};
		if ($body.hasClass("header-side-left") && $page.hasClass("boxed")) {
			
			if($sideHeaderToggleExist){
				
				$(".floating-logo .branding").css({
					right: $boxedHeaderPos
				});
				$menuToggle.css({
					left: $boxedHeaderPos
				});
			}
		};
		if($overlayHeader.length > 0 && $sideHeaderToggleExist  && $page.hasClass("boxed")){
			$menuToggle.css({
				right: $boxedHeaderPos
			});
			$(".floating-logo .branding").css({
				left: $boxedHeaderPos
			});

		}
	};

	ofX();
	$window.on("resize", function() {
		ofX();
	});


	/*Default scroll for mobile*/
	if($(".mixed-header").length > 0){
		var $activeHeader = $(".mixed-header");
	}else{
		var $activeHeader = $(".masthead");
	}
	var position = 0;
	window.clickMenuToggle = function( $el, e ) {
	//$hamburger.on("click", function(e) {
		if($(".show-mobile-header").length > 0){
			var $menu = $(".dt-mobile-header");	
		}else{
			var $menu = $sideHeader;		
		}
		
		if(!$onePage) {
			if(!$html.hasClass("menu-open")) {
				position = dtGlobals.winScrollTop;
				$html.addClass("menu-open");
				// $(".dt-mobile-header").css({
				// 	'margin-top': $(".mobile-header-bar", $activeHeader).height() + $(".top-bar").height(),
				// 	'max-height': $window.height() - $(".mobile-header-bar", $activeHeader).height() - $(".top-bar").height()
				// });

				if (!dtGlobals.isiOS) {
					$body.css("margin-top", -position);
					// $(".dt-mobile-header").css({
					// 	'margin-top': $(".mobile-header-bar").height()
					// });
					
				}
				else {
					$window.on("touchstart.dt", function(e) {
						$window.off("touchmove.dt");

						if ($menu[0].offsetHeight >= $menu[0].scrollHeight) {
							$window.on("touchmove.dt", function(e) {
								e.preventDefault();
							});
						}
						else if ($menu[0].scrollTop <= 0) {
							$menu[0].scrollTop += 1;
						}
						else if ($menu[0].scrollTop + $menu[0].offsetHeight >= $menu[0].scrollHeight) {
							$menu[0].scrollTop -= 1;
						};
					});
				};
			}
			else {
				$html.removeClass("menu-open");
				// $(".dt-mobile-header").css({
				// 	'margin-top': "",
				// 	'max-height': ""
				// });
				if (!dtGlobals.isiOS) {
					$body.css("margin-top", 0);
					$window.scrollTop(position);
					// $(".sticky-mobile-header .dt-mobile-header").css({
					// 	top: ""
					// });
				} 
				else {
					$window.off("touchstart.dt");
					$window.off("touchmove.dt");	
				}
			};
		}else{
			if(!$html.hasClass("onepage-menu-open")) {
				$html.addClass("onepage-menu-open");
				// $(".dt-mobile-header").css({
				// 	'margin-top': $(".mobile-header-bar", $activeHeader).height() + $(".top-bar").height(),
				// 	'max-height': $window.height() - $(".mobile-header-bar", $activeHeader).height() - $(".top-bar").height()
				// });

				
			}
			else {
				$html.removeClass("onepage-menu-open");
				// $(".dt-mobile-header").css({
				// 	'margin-top': "",
				// 	'max-height': ""
				// });
				
			};
		}
	};
	$body.on( 'click', '.menu-toggle .lines-button, .sticky-header-overlay, .hide-overlay', function( e ) {
		clickMenuToggle( $( this ), e );
	});

	/*Side header scrollbar for desctop*/
	$(".side-header .header-bar").wrap("<div class='header-scrollbar-wrap'></div>");
	if($sideHeader.length > 0 && !dtGlobals.isMobile){
		$(".header-scrollbar-wrap").mCustomScrollbar({
			scrollInertia:150
		});

	};
	if($sideHeader.length > 0){
		if(!$(".mCSB_container").length > 0){
			$(".side-header .header-scrollbar-wrap .header-bar").wrap("<div class='mCSB_container'></div>");
		}
	}

		dtGlobals.desktopProcessed = false;
		dtGlobals.mobileProcessed = false;
	var headerBelowSliderExists = $(".floating-navigation-below-slider").exists(),
		bodyTransparent = $body.hasClass("transparent");

	$.headerBelowSlider = function(){
		if (headerBelowSliderExists) {
			var $header = $(".masthead:not(.side-header):not(#phantom)");

			if (window.innerWidth > dtLocal.themeSettings.mobileHeader.secondSwitchPoint && !dtGlobals.desktopProcessed) {
				dtGlobals.desktopProcessed = true;
				dtGlobals.mobileProcessed = false;

				if (bodyTransparent) {
					$header.insertAfter("#main-slideshow, .photo-scroller").velocity({
						translateY : -100 + '%'
					}, 0, function() {
						
					});
					$header.css({
						"visibility": "visible",
						"opacity": 1,
						"top" : "auto",
						// "transform" : "translateY(-100%)",
						// "-webkit-transform" : "translateY(-100%)"
					});
				}
				else {
					$header.insertAfter("#main-slideshow, .photo-scroller").css({
						"visibility": "visible",
						"opacity": 1
					});
				};
			}
			else if (window.innerWidth <= dtLocal.themeSettings.mobileHeader.secondSwitchPoint && !dtGlobals.mobileProcessed) {
				dtGlobals.desktopProcessed = false;
				dtGlobals.mobileProcessed = true;

				$header.insertBefore("#main-slideshow, .photo-scroller").css({
					"visibility": "visible",
					"opacity": 1,
					"transform": "",
					"-webkit-transform" : ""
				});

				if(!$(".mobile-header-space").length > 0){
					$("<div class='mobile-header-space'></div>").insertBefore($header);
					$(".mobile-header-space").css({
						height: $header.height()
					});
				};
			};
		};
	};
	$.headerBelowSlider();


	var stickyMobileHeaderExists = $(".sticky-mobile-header").exists();
	
	$window.scroll(function () {
		if(headerBelowSliderExists && stickyMobileHeaderExists){
			if($body.hasClass("transparent")){
				var fixedHeadMobAfter = dtGlobals.winScrollTop > ($mainSlider.height() - $(".masthead:not(.side-header)").height());
			}else{
				var fixedHeadMobAfter = dtGlobals.winScrollTop > ($mainSlider.height());
			}
			if(fixedHeadMobAfter){
				$body.addClass("fixed-mobile-header");
			}else{
				$body.removeClass("fixed-mobile-header");
			}
		}
	})





/* #Social icons svg
================================================== */
	/*!-svg icons array*/
	var icons = [
		'<g id="social-500px"><path d="M9.63,14.894c-0.984,0.068-1.756,0.847-1.756,1.771v2.645c0,0.358,0.373,0.358,0.495,0.358c0.328,0,0.495-0.121,0.495-0.358v-2.648c0-0.431,0.364-0.811,0.813-0.848c0.27-0.024,0.53,0.052,0.724,0.208c0.187,0.151,0.294,0.367,0.294,0.591c0,0.047-0.034,0.265-0.197,0.462c-0.191,0.227-0.464,0.341-0.823,0.341c-0.188,0-0.407,0.051-0.428,0.437c-0.014,0.159-0.038,0.425,0.315,0.472c0.35,0.043,0.712-0.017,1.055-0.179c0.601-0.276,1.006-0.812,1.057-1.399c0.042-0.507-0.162-1.004-0.561-1.364C10.717,15.034,10.187,14.846,9.63,14.894z"/><path d="M17.593,6.979c-1.642,0-2.977,1.411-2.977,3.146c0,1.735,1.335,3.146,2.977,3.146c1.643,0,2.979-1.412,2.979-3.146C20.572,8.391,19.235,6.979,17.593,6.979z M17.593,12.294c-1.12,0-2.031-0.973-2.031-2.169c0-1.195,0.911-2.167,2.031-2.167c1.121,0,2.033,0.972,2.033,2.167C19.626,11.321,18.714,12.294,17.593,12.294z"/><path d="M8.464,10.741C8.332,9.713,7.426,8.894,6.262,8.748C5.676,8.676,5.091,8.775,4.575,9.035v-1.02h2.917c0.356,0,0.362-0.355,0.364-0.487c0.003-0.171-0.035-0.296-0.117-0.379C7.64,7.046,7.515,7.046,7.468,7.046H4.061c-0.284,0-0.482,0.188-0.482,0.457v2.418c0,0.278,0.272,0.318,0.404,0.338l0.09,0.015c0.052,0.01,0.109,0.015,0.168,0.015c0.098,0,0.337-0.013,0.473-0.153c0.285-0.357,0.729-0.507,1.34-0.44c0.716,0.072,1.296,0.558,1.378,1.151c0.046,0.377-0.088,0.739-0.376,1.017c-0.295,0.286-0.72,0.45-1.165,0.45c-0.644,0-1.217-0.347-1.459-0.883c-0.062-0.143-0.176-0.215-0.338-0.215c-0.068,0-0.148,0.015-0.279,0.052c-0.124,0.038-0.295,0.106-0.361,0.257c-0.026,0.059-0.045,0.154,0.006,0.259c0.375,0.895,1.353,1.496,2.432,1.496c0.726,0,1.426-0.273,1.921-0.75C8.318,12.036,8.55,11.401,8.464,10.741z"/><path d="M14.407,10.125c0-1.734-1.337-3.146-2.979-3.146c-1.641,0-2.976,1.411-2.976,3.146c0,1.735,1.335,3.146,2.976,3.146C13.07,13.271,14.407,11.86,14.407,10.125z M11.428,12.294c-1.121,0-2.032-0.973-2.032-2.169c0-1.195,0.911-2.167,2.032-2.167c1.121,0,2.033,0.972,2.033,2.167C13.461,11.321,12.549,12.294,11.428,12.294z"/><path d="M16.013,15.422c-0.003-0.11-0.062-0.216-0.182-0.322c-0.125-0.112-0.387-0.251-0.603-0.068l-1.103,0.982l-1.092-0.98c-0.066-0.066-0.152-0.102-0.247-0.102c-0.141,0-0.257,0.086-0.341,0.161c-0.082,0.072-0.191,0.186-0.194,0.336c-0.002,0.092,0.036,0.175,0.117,0.251l1.068,0.956l-1.066,0.948c-0.034,0.033-0.113,0.11-0.113,0.241c0,0.158,0.113,0.277,0.201,0.355c0.074,0.063,0.188,0.147,0.33,0.147c0.133,0,0.22-0.074,0.269-0.115l1.071-0.969l1.086,0.96c0.042,0.055,0.136,0.118,0.262,0.118c0.153,0,0.275-0.091,0.361-0.166c0.117-0.113,0.174-0.223,0.173-0.336c-0.001-0.089-0.037-0.167-0.11-0.234l-1.076-0.959l1.076-0.956C15.931,15.64,16.016,15.558,16.013,15.422z"/></g>',
		'<g id="vk"><path d="M12.235 16.191c0.372 0 0.524-0.248 0.516-0.56c-0.017-1.17 0.438-1.797 1.258-0.978 c0.908 0.9 1.1 1.5 2.1 1.502c0.418 0 1.5 0 1.9 0c1.528 0 0.166-1.54-0.916-2.54c-1.024-0.952-1.071-0.979-0.189-2.123 c1.102-1.425 2.535-3.26 1.266-3.26c-0.246 0-0.072 0-2.428 0c-0.471 0-0.501 0.277-0.672 0.7 c-0.604 1.429-1.758 3.28-2.195 3.001c-0.46-0.295-0.248-1.3-0.213-3.038c0.014-0.459 0.01-0.774-0.694-0.94 c-1.92-0.447-3.578 0.431-2.9 0.537c0.954 0.2 0.9 2 0.6 2.98c-0.387 1.558-1.851-1.235-2.457-2.623 C7.25 8.5 7.2 8.3 6.7 8.277c-0.29 0-1.558 0-1.986 0c-0.382 0-0.569 0.177-0.434 0.531c0.133 0.3 1.7 3.8 3.4 5.8 c1.718 1.7 3.4 1.6 4.6 1.597H12.235L12.235 16.191z"/></g>',
		'<g id="tripedvisor"><path fill="none" d="M15.825 9.215c-1.584 0-2.873 1.291-2.873 2.874c0 1.6 1.3 2.9 2.9 2.876s2.873-1.292 2.873-2.876 C18.698 10.5 17.4 9.2 15.8 9.215z M15.879 13.729c-0.423 0-0.82-0.164-1.118-0.464c-0.299-0.301-0.465-0.697-0.465-1.121 c0-0.421 0.166-0.818 0.465-1.119c0.298-0.298 0.695-0.461 1.118-0.461c0.873 0 1.6 0.7 1.6 1.6 C17.464 13 16.8 13.7 15.9 13.729z"/><path fill="none" d="M8.26 9.251c-1.592 0-2.887 1.296-2.887 2.888c0 1.6 1.3 2.9 2.9 2.9 c1.591 0 2.886-1.299 2.886-2.887C11.146 10.5 9.9 9.3 8.3 9.251z M8.253 13.706c-0.421 0-0.816-0.163-1.113-0.461 c-0.3-0.296-0.462-0.691-0.462-1.114c0-0.419 0.164-0.814 0.462-1.113c0.297-0.296 0.693-0.457 1.113-0.462 c0.87 0 1.6 0.7 1.6 1.574S9.123 13.7 8.3 13.706z"/><path d="M8.253 10.556c-0.42 0.005-0.816 0.166-1.113 0.463c-0.299 0.299-0.462 0.694-0.462 1.113c0 0.4 0.2 0.8 0.5 1.1 c0.297 0.3 0.7 0.5 1.1 0.461c0.87 0 1.576-0.708 1.576-1.577S9.123 10.6 8.3 10.556z"/><path d="M15.879 10.563c-0.423 0-0.82 0.163-1.118 0.461c-0.299 0.301-0.465 0.698-0.465 1.119c0 0.4 0.2 0.8 0.5 1.1 c0.298 0.3 0.7 0.5 1.1 0.464c0.873 0 1.585-0.708 1.585-1.582S16.752 10.6 15.9 10.563z"/><path d="M20.172 8.047l-3.177 0.365c-0.042-0.013-0.085-0.021-0.127-0.034c-0.138-0.216-1.087-1.44-4.881-1.44 c-4.164 0-4.9 1.475-4.9 1.475l-3.165-0.35c0.339 0.3 1 1.3 1.1 1.733c-0.49 0.649-0.867 1.475-0.859 2.4 c0.016 1.8 0.7 3.9 3.7 4.338c1.375-0.019 2.048-0.344 3.064-1.133l1.109 2.461l1.169-2.439 c0.776 0.6 1.2 1 2.6 1.096c3.047-0.125 3.981-2.578 4.029-4.321c0.002-0.933-0.238-1.729-0.781-2.396 C19.256 9.3 19.9 8.4 20.2 8.047z M8.26 15.025c-1.592 0-2.887-1.299-2.887-2.887c0-1.592 1.295-2.888 2.887-2.888 c1.591 0 2.9 1.3 2.9 2.888C11.146 13.7 9.9 15 8.3 15.025z M15.825 14.965c-1.584 0-2.873-1.29-2.873-2.876 c0-1.583 1.289-2.874 2.873-2.874c1.586 0 2.9 1.3 2.9 2.874C18.698 13.7 17.4 15 15.8 14.965z"/></g>',
		'<g id="foursquare"><path d="M18.511 13.164l-5.351 5.353c-0.643 0.641-1.688 0.641-2.326 0L5.48 13.164c-0.639-0.645-0.639-1.688 0-2.329l5.354-5.354 c0.638-0.638 1.685-0.638 2.3 0l2.417 2.418l-3.631 3.631l-1.707-1.712c-0.239-0.24-0.57-0.377-0.907-0.377 c-0.339 0-0.667 0.137-0.907 0.375l-1.096 1.094c-0.243 0.243-0.378 0.565-0.378 0.909c0 0.3 0.1 0.7 0.4 0.906l3.707 3.7 c0.167 0.2 0.4 0.3 0.6 0.34l0.053 0.035l0.25 0.002c0.341 0 0.666-0.134 0.905-0.376l5.636-5.635h0.023 c0.689 0.7 0.7 1.6 0.1 2.333L18.511 13.164L18.511 13.164z"/><path d="M18.571 9.409l-6.367 6.373c-0.085 0.079-0.196 0.129-0.315 0.129l0 0c-0.002 0-0.002 0-0.004 0 c-0.017 0-0.034-0.002-0.048-0.005c-0.101-0.012-0.192-0.057-0.262-0.124l-3.547-3.558c-0.173-0.171-0.171-0.452 0-0.622 l1.049-1.048c0.083-0.081 0.195-0.128 0.311-0.129c0.117 0 0.2 0.1 0.3 0.131l2.191 2.195l5.009-5.009 c0.083-0.084 0.193-0.13 0.312-0.13c0.117 0 0.2 0 0.3 0.13l1.045 1.049c0.221 0.1 0.2 0.4 0.1 0.619L18.571 9.4 L18.571 9.409z"/></g>',
		'<g id="website"><path d="M8.639 10.095c0.251-0.252 0.53-0.46 0.827-0.625c1.654-0.912 3.778-0.425 4.8 1.187l-1.287 1.3 c-0.371-0.844-1.288-1.323-2.198-1.118c-0.342 0.077-0.67 0.249-0.936 0.512l-2.468 2.467c-0.75 0.748-0.75 2 0 2.7 c0.75 0.8 2 0.8 2.7 0l0.762-0.76c0.689 0.2 1.4 0.3 2.2 0.324l-1.679 1.682c-1.439 1.438-3.771 1.438-5.211 0 c-1.439-1.438-1.439-3.771 0-5.211L8.639 10.095z M12.557 6.177l-1.681 1.677c0.732-0.054 1.4 0.1 2.2 0.331l0.764-0.761 c0.75-0.749 1.97-0.749 2.7 0c0.75 0.8 0.8 2 0 2.717l-2.465 2.466c-0.753 0.752-1.974 0.744-2.719 0 c-0.173-0.174-0.323-0.393-0.417-0.604l-1.287 1.284c0.136 0.2 0.3 0.4 0.4 0.562c0.465 0.4 1.1 0.8 1.8 1 c0.882 0.2 1.9 0.1 2.644-0.354c0.298-0.16 0.577-0.369 0.828-0.621l2.47-2.465c1.437-1.439 1.437-3.773 0-5.21 c-1.479-1.438-3.761-1.438-5.292-0.008L12.557 6.177L12.557 6.177z"/></g>',
		'<g id="mail"><path d="M5 6.984v10.031h0.012h13.954H19V6.984H5z M17.414 8.134l-5.416 4.012L6.586 8.134H17.414 z M6.188 9.289l2.902 2.151L6.188 14.25V9.289z M6.2 15.864l3.842-3.719l1.957 1.45l1.946-1.442l3.834 3.712L6.2 15.864L6.2 15.864z M17.812 14.271l-2.916-2.824l2.916-2.159V14.271z"/></g>',
		'<g id="behance"><path d="M11.429 8.664c0.27 0.4 0.4 0.8 0.4 1.385c0 0.554-0.138 0.999-0.407 1.3 c-0.152 0.188-0.374 0.36-0.671 0.499c0.45 0.2 0.8 0.4 1 0.804c0.229 0.4 0.3 0.8 0.3 1.3 c0 0.535-0.133 1.021-0.39 1.397c-0.164 0.282-0.374 0.522-0.62 0.722c-0.282 0.217-0.61 0.363-0.992 0.5 c-0.381 0.076-0.794 0.128-1.236 0.128H4.836V7.694H9.07c1.156-0.03 1.9 0.4 2.4 0.97H11.429z M6.686 9.345v2.015h2.145 c0.382 0 0.694-0.078 0.931-0.227c0.241-0.149 0.36-0.417 0.36-0.804c0-0.422-0.159-0.707-0.475-0.841 C9.374 9.4 9 9.3 8.6 9.345l-1.92 0.017V9.345z M6.686 12.874v2.438h2.142c0.385 0 0.682-0.055 0.894-0.164 c0.387-0.201 0.581-0.573 0.581-1.137c0-0.479-0.188-0.812-0.563-0.984c-0.209-0.098-0.501-0.146-0.883-0.152L6.686 12.9 L6.686 12.874z M17.494 10.061c0.445 0.2 0.8 0.5 1.1 0.979c0.262 0.4 0.4 0.9 0.5 1.4 c0.041 0.3 0.1 0.7 0.1 1.312h-4.637c0.023 0.7 0.3 1.1 0.7 1.396c0.248 0.2 0.6 0.2 0.9 0.2 c0.383 0 0.688-0.104 0.924-0.309c0.133-0.104 0.188-0.164 0.289-0.354h1.734c-0.041 0.396-0.232 0.688-0.598 1.1 c-0.568 0.646-1.363 0.97-2.396 0.999c-0.848 0-1.596-0.271-2.236-0.812c-0.652-0.543-0.835-1.439-0.835-2.659 c0-1.144 0.147-2.012 0.735-2.621c0.584-0.611 1.344-0.916 2.275-0.916c0.559-0.023 1.1 0.1 1.5 0.293L17.494 10.061z M14.811 11.632c-0.232 0.256-0.328 0.775-0.391 1.198l3.064 0.034c-0.033-0.468-0.074-0.964-0.412-1.413 c-0.271-0.244-0.752-0.295-1.156-0.295c-0.438 0.003-0.818 0.203-1.113 0.477L14.811 11.632L14.811 11.632z M18.586 7.207h-4.707 v1.584h4.707V7.207z"/></g>',
		'<g id="stumbleupon"><path d="M12.719 10.35l0.917 0.499l1.456-0.477v-0.96c0-1.656-1.422-2.944-3.11-2.944 c-1.687 0-3.116 1.205-3.116 2.949c0 1.7 0 4.4 0 4.384c0 0.401-0.332 0.723-0.738 0.723c-0.409 0-0.74-0.318-0.74-0.723v-1.855 H5v1.896c0 1.7 1.4 3.1 3.2 3.034c1.71 0 3.096-1.336 3.121-2.991V9.517c0-0.396 0.331-0.718 0.74-0.718 c0.407 0 0.7 0.3 0.7 0.718v0.833H12.719z M16.573 11.918v1.943c0 0.396-0.33 0.719-0.738 0.7 c-0.41 0-0.737-0.32-0.737-0.723v-1.906l-1.459 0.478l-0.916-0.499v1.891c0.02 1.7 1.4 3.1 3.2 3.1 c1.719 0 3.117-1.362 3.117-3.032c0-0.025 0-1.887 0-1.887L16.573 11.918L16.573 11.918z"/></g>',
		'<g id="instagram"><rect x="3" y="3" display="none" opacity="0.7" fill="#27AAE1" enable-background="new    " width="16" height="16"/><path d="M15.121 11.582l3.023-0.032v4.181c0 1.334-1.095 2.42-2.437 2.42H8.283c-1.344 0-2.434-1.086-2.434-2.42v-4.173h3.097 c-0.08 0.677-0.096 0.745-0.056 1.052c0.233 1.8 1.8 2.6 3.2 2.652c1.672 0.1 2.703-0.996 3.123-2.927 c-0.045-0.729-0.017 0.085-0.017-0.752L15.121 11.582L15.121 11.582z M8.226 5.851C8.246 5.8 8.3 5.8 8.3 5.85h0.393 M8.279 5.85h7.431c1.343 0 2.4 1.1 2.4 2.421l0.002 2.33h-3.375c-0.527-0.672-1.499-1.71-2.784-1.674 c-1.755 0.048-2.28 1.089-2.663 1.727L5.85 10.56V8.271c0-0.816 0.317-2.02 1.821-2.419 M16.739 7.5 c0-0.191-0.155-0.342-0.345-0.342h-1.166c-0.19 0-0.34 0.15-0.34 0.342v1.181c0 0.2 0.1 0.3 0.3 0.343h1.164 c0.188 0 0.345-0.155 0.345-0.343V7.5l0.037 0.039V7.5z M10.207 12.054c0 1 0.8 1.8 1.8 1.9 c0.986 0 1.788-0.891 1.788-1.88c0-0.983-0.802-1.779-1.789-1.779c-1.029 0.011-1.867 0.823-1.867 1.779H10.207z"/></g>',
		'<g id="github"><path d="M15.604 5.666c-0.662 0.286-1.369 0.442-2.124 0.472C13 5.9 12.4 5.7 11.8 5.666c-1.562 0-3.112 1.052-3.177 2.8 c-0.047 1.3 0.5 2.2 1.6 2.788c-0.475 0.219-0.664 0.723-0.664 1.217c0 0.5 0.3 1 0.6 1.2 C9.041 14.2 8.4 14.9 8.4 15.889c0 3.2 7 3.3 7.004-0.136c0-1.271-0.875-2.188-3.03-2.538 c-0.852-0.118-1.304-1.413-0.046-1.647c1.803-0.296 3.015-1.998 2.38-3.867c0.269-0.04 0.537-0.105 0.801-0.196l0.097-1.818V5.666 H15.604z M12.002 14.818c0.982-0.02 1.6 0.3 1.6 0.951c0.014 0.674-0.539 0.979-1.482 0.9 c-1.049-0.003-1.643-0.292-1.664-0.986c0.004-0.549 0.484-0.861 1.631-0.902H12.002L12.002 14.818z M11.856 10 c-0.831 0.012-1.212-0.445-1.213-1.329c0-0.806 0.369-1.309 1.194-1.314c0.738-0.003 1.1 0.5 1.1 1.4 C13.041 9.5 12.6 10 11.8 9.98L11.856 9.96z"/></g>',
		'<g id="skype"><path d="M18.412 12.034c0-3.541-2.889-6.412-6.447-6.412c-0.353 0-0.7 0.028-1.038 0.083c-0.604-0.394-1.323-0.623-2.101-0.623 c-2.124 0-3.846 1.723-3.846 3.847c0 0.8 0.2 1.5 0.6 2.094c-0.053 0.33-0.079 0.667-0.079 1 c0 3.5 2.9 6.4 6.4 6.414c0.402 0 0.795-0.041 1.176-0.107c0.589 0.4 1.3 0.6 2 0.6 c2.126 0 3.849-1.725 3.849-3.848c0-0.803-0.246-1.551-0.668-2.167C18.391 12.6 18.4 12.3 18.4 12.034z M12.568 16.8 c-2.049 0.105-3.007-0.348-3.886-1.172c-0.98-0.918-0.587-1.969 0.213-2.021c0.798-0.053 1.3 0.9 1.7 1.2 c0.427 0.3 2 0.9 2.901-0.104c0.933-1.062-0.621-1.614-1.758-1.782C10.121 12.6 8.1 11.7 8.2 10 c0.159-1.729 1.468-2.617 2.847-2.742c1.757-0.159 2.9 0.3 3.8 1.037c1.046 0.9 0.5 1.89-0.187 2 c-0.664 0.079-1.411-1.468-2.874-1.49c-1.509-0.022-2.528 1.571-0.665 2.024c1.861 0.5 3.9 0.6 4.6 2.3 C16.455 14.8 14.6 16.7 12.6 16.76z"/></g>',
		'<g id="devian"><path d="M11.747 10.649c2.892-0.069 5.2 1.4 5.6 3.778l-2.893 0.058l-0.02-1.923c-0.629-0.337-0.83-0.45-1.492-0.523 l-0.035 3.913H20c-0.374-3.838-3.814-6.841-8.001-6.841c-0.073 0-0.146 0-0.216 0.001L11.8 7.1 c-0.66-0.056-1.126 0.276-1.757 0.629l-0.012 1.624C6.868 10.1 4.3 12.8 4 15.95h7.785v-5.301H11.747z M10.072 14.4 l-3.359 0.086c0.262-1.62 1.974-3.136 3.333-3.597L10.072 14.37z"/></g>',
		'<g id="pinterest"><path d="M8.317 13.361c0.703-1.242-0.227-1.515-0.372-2.416c-0.596-3.68 4.244-6.193 6.779-3.622 c1.754 1.8 0.6 7.256-2.229 6.687c-2.71-0.545 1.325-4.901-0.836-5.756c-1.757-0.696-2.689 2.126-1.856 3.5 c-0.489 2.411-1.541 4.682-1.114 7.708c1.381-1.002 1.847-2.924 2.228-4.924c0.695 0.4 1.1 0.9 2 0.9 c3.264 0.3 5.089-3.258 4.641-6.5c-0.396-2.872-3.259-4.335-6.313-3.992c-2.415 0.27-4.822 2.222-4.922 5 C6.211 11.7 6.7 13 8.3 13.361z"/></g>',
		'<g id="tumbler"><path d="M10.493 5.792c-0.073 0.618-0.211 1.126-0.41 1.526C9.884 7.7 9.6 8.1 9.3 8.35c-0.328 0.289-0.72 0.507-1.18 0.7 v1.71h1.285v4.198c0 0.5 0.1 0.9 0.2 1.252c0.111 0.3 0.3 0.5 0.6 0.828c0.289 0.2 0.6 0.4 1 0.6 c0.412 0.1 0.9 0.2 1.4 0.205c0.47 0 0.911-0.049 1.313-0.146c0.401-0.097 0.858-0.266 1.358-0.508v-1.896 c-0.586 0.396-1.176 0.589-1.771 0.589c-0.335 0-0.63-0.078-0.89-0.235c-0.195-0.117-0.331-0.281-0.405-0.479 c-0.068-0.196-0.106-0.641-0.106-1.336v-3.073h2.784V8.824H12.21V5.792H10.493z"/></g>',
		'<g id="vimeo"><path d="M17.732 9.417c-0.051 1.179-0.83 2.796-2.342 4.85c-1.561 2.144-2.878 3.215-3.959 3.258c-0.668 0-1.235-0.65-1.697-1.959 c-0.306-1.195-0.617-2.396-0.925-3.587c-0.34-1.373-0.678-1.984-1.085-1.984c-0.086 0-0.386 0.192-0.899 0.571L6.268 9.8 c0.565-0.526 1.15-1.036 1.66-1.576c0.754-0.688 1.321-1.053 1.7-1.088c0.893-0.091 1.4 0.5 1.6 1.9 c0.225 1.5 0.4 2.4 0.5 2.779c0.256 1.2 0.5 1.8 0.8 1.834c0.24 0 0.601-0.402 1.082-1.206 c0.481-0.802 0.739-1.413 0.772-1.834c0.066-0.689-0.188-1.037-0.772-1.037c-0.276 0-0.561 0.065-0.85 0.2 c0.565-1.953 1.645-2.901 3.232-2.846c1.198 0.1 1.8 0.9 1.7 2.447H17.732z"/></g>',
		'<g id="linkedin"><path d="M9.269 7.02c0 0.714-0.586 1.293-1.307 1.293c-0.722 0-1.307-0.579-1.307-1.293 c0-0.712 0.585-1.291 1.307-1.291C8.683 5.7 9.3 6.3 9.3 7.02H9.269z M9.061 9.279H6.873v7.392h2.188V9.279z M12.91 9.3 h-1.795l-0.027 7.392h2.044c0 0 0-2.742 0-3.879c0-1.04 0.775-1.79 1.7-1.665c0.824 0.1 1.1 0.6 1.1 1.7 c0 1.028-0.021 3.915-0.021 3.89h2.025c0 0 0.025-2.729 0.025-4.708c0-1.981-1.006-2.78-2.604-2.78 c-1.599 0-2.248 1.096-2.248 1.096v-1H12.91z"/></g>',
		'<g id="lastfm"><path d="M11.217 15.157l-0.538-1.458c0 0-0.87 0.972-2.177 0.972c-1.159 0-1.979-1.009-1.979-2.621c0-2.064 1.04-2.807 2.063-2.807 c1.475 0 1.9 1 2.3 2.185l0.538 1.678c0.535 1.6 1.5 2.9 4.4 2.938c2.082 0 3.488-0.638 3.488-2.318 c0-1.357-0.771-2.063-2.216-2.4l-1.071-0.233c-0.739-0.17-0.953-0.472-0.953-0.973c0-0.572 0.453-0.907 1.188-0.907 c0.808 0 1.2 0.3 1.3 1.023l1.681-0.201c-0.088-1.521-1.174-2.125-2.884-2.135c-1.512 0-2.987 0.571-2.987 2.4 c0 1.1 0.5 1.9 1.9 2.203l1.141 0.27c0.854 0.2 1.1 0.6 1.1 1.042c0 0.624-0.603 0.877-1.739 0.9 c-1.697 0-2.399-0.893-2.802-2.116l-0.555-1.677c-0.702-2.184-1.826-2.99-4.058-2.99c-2.467 0-3.771 1.562-3.771 4.2 c0 2.5 1.3 3.9 3.6 3.93c2.041-0.041 2.903-0.947 2.903-0.94h0.042V15.157z"/></g>',
		'<g id="forrst"><polygon points="11.404,15.574 9.438,13.961 10.031,13.381 11.404,14.055 11.404,10.815 12.492,10.815 12.492,12.521 14.07,12.043 14.365,12.904 12.596,13.67 12.596,14.715 15.158,13.766 15.548,14.625 12.596,16.053 12.596,17.771 17.913,17.771 12,4.229 6.087,17.771 11.404,17.771 "/></g>',
		'<g id="flickr"><circle cx="8.3" cy="12" r="2.8"/><circle cx="15.7" cy="12" r="2.8"/></g>',
		'<g id="delicious"><path d="M16.553 6H7.457C6.652 6 6 6.7 6 7.454v9.089c0 0.9 0.6 1.5 1.4 1.455h9.095c0.806 0 1.458-0.651 1.458-1.455 V7.454C18.014 6.7 17.4 6 16.6 6H16.553z M16.906 16.327c0 0.252-0.344 0.605-0.594 0.582H12V12H7.219L7.188 7.8 c0-0.251 0.407-0.646 0.656-0.646H12v4.844h4.938L16.906 16.327L16.906 16.327z"/></g>',
		'<g id="rss"><path d="M9.258 16.374c0 0.894-0.728 1.62-1.625 1.62s-1.625-0.729-1.625-1.62c0-0.896 0.729-1.618 1.625-1.618 c0.898-0.027 1.7 0.7 1.7 1.618H9.258z M6.007 10.099v2.4c3.026 0 5.4 2.5 5.6 5.496h2.408 c-0.075-4.356-3.594-7.841-7.949-7.896H6.007z M6.007 8.419c2.556 0 5 1 6.8 2.812c1.812 1.9 2.8 4.2 2.8 6.751H18 C17.982 11.4 12.6 6 6 6.005L6.007 8.419L6.007 8.419z"/></g>',
		'<g id="you-tube"><path d="M18.877 9.35c-0.22-1.924-0.96-2.189-2.438-2.292c-2.101-0.147-6.781-0.147-8.88 0C6.084 7.2 5.3 7.4 5.1 9.3 c-0.163 1.429-0.164 3.9 0 5.298c0.22 1.9 1 2.2 2.4 2.294c2.099 0.1 6.8 0.1 8.9 0 c1.477-0.104 2.217-0.369 2.437-2.294C19.041 13.2 19 10.8 18.9 9.35z M9.69 15.335v-6.65l5.623 3.324L9.69 15.335z"/></g>',
		'<g id="dribbble"><path d="M12.012 5C8.139 5 5 8.1 5 12c0 3.8 3.1 7 7 7C15.861 19 19 15.9 19 12c0.025-3.857-3.075-7-7.012-7H12.012 z M17.787 11.674c-1.506-0.246-2.889-0.259-4.15-0.043c-0.145-0.329-0.291-0.656-0.447-0.979c1.352-0.583 2.438-1.376 3.244-2.378 c0.787 1 1.3 2.1 1.4 3.401L17.787 11.674L17.787 11.674z M15.54 7.456c-0.701 0.907-1.671 1.624-2.91 2.1 c-0.595-1.086-1.273-2.143-2.038-3.173c0.455-0.115 0.928-0.185 1.42-0.185c1.331-0.066 2.5 0.4 3.5 1.18L15.54 7.456z M9.398 6.847c0.779 1 1.5 2.1 2.1 3.138c-1.419 0.418-3.115 0.631-5.073 0.688c0.405-1.743 1.56-3.118 3.037-3.826H9.398 z M6.217 12c0-0.052 0.007-0.1 0.01-0.151c2.247-0.004 4.187-0.263 5.812-0.771c0.136 0.3 0.3 0.6 0.4 0.8 c-1.975 0.615-3.603 1.877-4.868 3.781C6.725 14.7 6.2 13.4 6.2 12H6.217z M8.458 16.6 c1.15-1.799 2.619-2.971 4.437-3.512c0.543 1.4 1 2.8 1.2 4.354c-0.646 0.246-1.348 0.39-2.077 0.4 c-1.329-0.055-2.571-0.546-3.555-1.273L8.458 16.593z M15.229 16.807c-0.258-1.371-0.636-2.716-1.121-4.021 c1.094-0.157 2.305-0.112 3.6 0.112c-0.273 1.634-1.23 3.009-2.516 3.908H15.229L15.229 16.807z"/></g>',
		'<g id="google"><path d="M19.02 10.145h-1.953l0.021 1.958h-1.344l-0.021-1.937l-1.854-0.019l-0.023-1.258l1.896-0.008V6.864h1.343V8.86 l1.938 0.042v1.243H19.02z M13.254 15.303c0 1.217-1.107 2.698-3.899 2.698c-2.043 0-3.748-0.884-3.748-2.364 c0-1.146 0.725-2.624 4.107-2.624c-0.5-0.412-0.625-0.985-0.318-1.604c-1.98 0-2.995-1.166-2.995-2.645 c0-1.447 1.076-2.762 3.271-2.762c0.557 0 3.5 0 3.5 0l-0.809 0.823h-0.923c0.651 0.4 1 1.1 1 2 c0 0.778-0.427 1.407-1.036 1.874c-1.085 0.838-0.807 1.4 0.3 2.133c1.091 0.8 1.5 1.5 1.5 2.48L13.254 15.3 L13.254 15.303z M10.863 8.771C10.712 7.8 10 7.1 9.1 7.068c-0.872-0.021-1.457 0.687-1.307 1.6 c0.151 0.9 0.9 1.6 1.9 1.562c0.848 0.1 1.305-0.531 1.201-1.458L10.863 8.771z M11.544 15.5 c0-0.707-0.78-1.379-2.087-1.379c-1.178-0.017-2.179 0.615-2.179 1.354c0 0.7 0.8 1.4 2 1.4 c1.56-0.031 2.338-0.553 2.338-1.334H11.544z"/></g>',
		'<g id="twitter"><path d="M18.614 6.604c-0.556 0.325-1.171 0.561-1.822 0.688c-0.526-0.551-1.271-0.896-2.099-0.896 c-1.586 0-2.875 1.269-2.875 2.83c0 0.2 0 0.4 0.1 0.646c-2.385-0.119-4.5-1.247-5.916-2.959 C5.729 7.3 5.6 7.8 5.6 8.336c0 1 0.5 1.9 1.3 2.354c-0.47-0.014-0.912-0.141-1.3-0.354c0 0 0 0 0 0 c0 1.4 1 2.5 2.3 2.774c-0.241 0.062-0.495 0.102-0.756 0.102c-0.186 0-0.365-0.02-0.541-0.055 c0.365 1.1 1.4 1.9 2.7 1.971c-0.982 0.756-2.222 1.208-3.567 1.208c-0.232 0-0.461-0.016-0.686-0.04 c1.271 0.8 2.8 1.3 4.4 1.272c5.286 0 8.171-4.312 8.171-8.055c0-0.123-0.003-0.246-0.009-0.367 C18.127 8.8 18.6 8.3 19 7.72c-0.516 0.225-1.068 0.378-1.648 0.446C17.943 7.8 18.4 7.3 18.6 6.604z"/></g>',
		'<g id="facebook"><path d="M14.545 11.521l-1.74 0.002l0.052 6.648h-2.453l0.014-6.648H8.824V9.421h1.592l-0.001-1.236 c0-1.713 0.485-2.756 2.592-2.756h1.758V7.53h-1.098c-0.824 0-0.863 0.293-0.863 0.84l-0.004 1.051h1.975L14.545 11.521z"/></g>',
		'<g id="xing"><polygon points="18.2,5 15.3,5 10.6,13.4 13.7,19 16.6,19 13.4,13.4"/><polygon points="9.5,7.6 6.6,7.6 8.2,10.3 5.8,14.6 8.7,14.6 11.2,10.3"/></g>',
		'<g id="odnoklassniki"><path d="M12.001 12.212c1.819 0 3.299-1.542 3.299-3.442c0-1.897-1.479-3.442-3.299-3.442c-1.822 0-3.302 1.544-3.302 3.4 C8.699 10.7 10.2 12.2 12 12.212z M12.001 7.346c0.753 0 1.4 0.6 1.4 1.424c0 0.788-0.612 1.426-1.365 1.4 s-1.367-0.638-1.367-1.426C10.634 8 11.2 7.3 12 7.346z"/><path d="M15.557 12.802c-0.285-0.47-0.883-0.613-1.334-0.315c-1.353 0.888-3.094 0.886-4.444 0 c-0.454-0.298-1.049-0.155-1.333 0.315c-0.286 0.473-0.149 1.1 0.3 1.393c0.597 0.4 1.2 0.7 1.9 0.826l-1.847 1.9 c-0.376 0.393-0.376 1 0 1.426c0.19 0.2 0.4 0.3 0.7 0.295c0.25 0 0.498-0.101 0.685-0.295l1.815-1.894l1.812 1.9 c0.377 0.4 1 0.4 1.4 0c0.379-0.396 0.379-1.033 0-1.426l-1.849-1.929c0.675-0.156 1.319-0.437 1.918-0.826 C15.704 13.9 15.8 13.3 15.6 12.802z"/></g>',
		'<g id="weibo"><path fill="none" d="M10.852 10.982c-0.188 0.001-0.379 0.012-0.571 0.03c-2.466 0.231-4.341 1.763-4.188 3.4 c0.153 1.7 2.3 2.8 4.7 2.582c2.469-0.23 4.344-1.766 4.188-3.42C14.884 12.1 13.1 11 10.9 10.982z M11.108 16.211c-1.224 0.528-2.753 0.096-3.123-0.938c-0.37-1.034 0.026-2.414 1.641-2.95c0.216-0.071 0.472-0.111 0.736-0.112 c0.795 0 1.7 0.3 2.1 1.232C12.883 14.4 12.3 15.7 11.1 16.211z"/><path fill="none" d="M10.749 13.609c-0.063 0-0.129 0.016-0.192 0.048c-0.169 0.091-0.25 0.274-0.181 0.4 c0.067 0.1 0.3 0.2 0.4 0.086c0.169-0.092 0.251-0.274 0.182-0.41C10.943 13.7 10.9 13.6 10.7 13.609z"/><path fill="none" d="M9.57 13.982c-0.158 0-0.328 0.043-0.494 0.14c-0.443 0.257-0.518 0.696-0.329 1.1 c0.133 0.3 0.7 0.4 1.1 0.14c0.443-0.258 0.483-0.799 0.309-1.08C10.059 14.1 9.8 14 9.6 13.982z"/><path d="M16.672 10.558c0.605 0.2 0.823-0.293 0.791-1.008c-0.023-0.497-0.229-0.817-0.35-1.026 c-0.319-0.541-0.963-0.885-1.555-0.893c-0.109-0.001-0.218 0.008-0.32 0.031c-0.283 0.061-0.624 0.182-0.494 0.7 c0.143 0.5 0.9 0.2 1.3 0.427s0.374 0.4 0.4 0.714C16.499 9.9 16.2 10.4 16.7 10.558z"/><path d="M19.473 9.129c-0.088-1.024-0.719-2.061-1.505-2.708c-0.653-0.54-1.608-0.859-2.464-0.864 c-0.122 0-0.242 0.006-0.359 0.019c-0.463 0.049-0.938 0.153-0.945 0.692c-0.012 0.5 0.4 0.6 0.6 0.6 c0.859-0.037 1.621-0.222 2.6 0.649c0.574 0.5 1 1.5 0.9 2.076c-0.168 1.098-0.326 1.5 0.2 1.7 C19.574 11.6 19.5 9.9 19.5 9.129z"/><path d="M10.362 12.211c-0.266 0.001-0.52 0.04-0.736 0.112c-1.615 0.536-2.011 1.916-1.641 3 c0.37 1 1.9 1.5 3.1 0.938c1.223-0.529 1.774-1.787 1.344-2.768C12.063 12.6 11.2 12.2 10.4 12.211z M9.858 15.354c-0.442 0.256-0.979 0.144-1.111-0.14c-0.189-0.396-0.112-0.835 0.329-1.092c0.165-0.097 0.336-0.14 0.493-0.14 c0.263 0 0.5 0.1 0.6 0.291C10.34 14.6 10.3 15.1 9.9 15.354z"/><path d="M15.493 11.402c-0.163-0.054 0.651-1.638-0.241-2.087c-1.504-0.756-3.555 0.668-3.464 0.3 c0.168-0.719 0.526-2.196-0.743-2.264c-0.087-0.009-0.176-0.013-0.265-0.012c-2.777 0.022-6.688 4.516-6.246 6.9 c0.479 2.6 3.6 3.8 6.7 3.658c2.804 0 6.714-2.161 6.292-4.678C17.516 12.4 16.6 11.8 15.5 11.402z M10.837 17.016c-2.466 0.23-4.589-0.927-4.743-2.582c-0.153-1.657 1.72-3.188 4.188-3.419c0.193-0.019 0.383-0.029 0.571-0.03 c2.212-0.018 4 1.1 4.2 2.615C15.18 15.3 13.3 16.8 10.8 17.016z"/></g>',
		'<g id="research-gate"><path d="M11.338,16.022c-0.048-0.261-0.078-0.633-0.087-1.129c-0.007-0.49-0.033-0.906-0.07-1.242c-0.039-0.34-0.111-0.614-0.216-0.842c-0.104-0.221-0.252-0.387-0.44-0.501c-0.194-0.119-0.45-0.196-0.772-0.239v-0.027c0.531-0.114,0.922-0.365,1.174-0.758c0.252-0.394,0.377-0.901,0.377-1.522c0-0.808-0.215-1.404-0.651-1.8c-0.435-0.396-1.039-0.591-1.825-0.591H5.358v9.262h1.879v-3.916h0.994c0.384,0,0.66,0.101,0.821,0.312c0.165,0.209,0.253,0.494,0.271,0.856l0.053,1.774c0.007,0.188,0.024,0.357,0.051,0.523c0.024,0.17,0.089,0.318,0.185,0.449h2.057V16.56C11.495,16.463,11.386,16.28,11.338,16.022z M9.062,11.142c-0.244,0.214-0.592,0.317-1.041,0.317H7.237V8.787h0.887c0.869,0,1.302,0.428,1.302,1.285C9.426,10.574,9.306,10.932,9.062,11.142z"/><path d="M15.606,11.641v1.374h1.235v0.947c0,0.247-0.036,0.467-0.114,0.654c-0.08,0.188-0.177,0.338-0.295,0.458c-0.115,0.125-0.242,0.214-0.38,0.271c-0.131,0.066-0.256,0.096-0.368,0.096c-0.269,0-0.486-0.09-0.656-0.25c-0.174-0.17-0.299-0.414-0.396-0.73c-0.092-0.314-0.155-0.693-0.188-1.141c-0.033-0.446-0.051-0.95-0.051-1.509c0-1.162,0.1-1.991,0.305-2.491c0.193-0.502,0.521-0.753,0.973-0.753c0.193,0,0.357,0.05,0.49,0.147c0.133,0.102,0.246,0.225,0.332,0.376c0.088,0.152,0.148,0.319,0.189,0.506s0.057,0.361,0.057,0.525h1.801c0-0.943-0.225-1.666-0.678-2.172c-0.451-0.507-1.189-0.761-2.217-0.761c-0.601,0-1.103,0.101-1.5,0.302c-0.398,0.196-0.724,0.494-0.965,0.887c-0.242,0.394-0.416,0.885-0.513,1.473c-0.104,0.588-0.151,1.271-0.151,2.047c0,0.808,0.032,1.512,0.104,2.122c0.065,0.606,0.205,1.123,0.409,1.537c0.199,0.413,0.486,0.729,0.847,0.938c0.358,0.214,0.834,0.317,1.403,0.317c0.439,0,0.822-0.078,1.142-0.244c0.313-0.162,0.588-0.426,0.812-0.791h0.029v0.855h1.379v-4.991H15.606z"/></g>',
		'<g id="yelp"><path d="M8.378,5.342c0.739-0.581,2.159-0.747,2.743-0.633c0.586,0.112,0.891,0.439,0.895,0.838l0.034,5.08c0.003,0.399-0.205,0.767-0.461,0.815c-0.258,0.049-0.637-0.188-0.845-0.528L8.079,6.558C7.873,6.218,7.455,6.068,8.378,5.342 M7.493,15.003l2.684-0.949c0.373-0.134,0.708-0.504,0.746-0.823c0.036-0.32-0.235-0.701-0.604-0.847l-2.834-1.125c-0.369-0.146-0.795,0.2-0.907,0.767c0,0-0.068,1.972,0,2.379C6.645,14.812,7.119,15.135,7.493,15.003 M12.174,15.477c0.008-0.4-0.206-0.745-0.475-0.77c-0.27-0.025-0.696,0.205-0.951,0.51l-1.872,2.244c-0.256,0.305-0.129,1.021,0.243,1.157l1.957,0.68c0.373,0.137,1.028-0.266,1.036-0.664L12.174,15.477z M16.826,14.955l-2.347-0.676c-0.381-0.108-0.813-0.099-0.96,0.025c-0.146,0.122-0.108,0.51,0.082,0.857l1.481,2.712c0.192,0.349,0.958,0.289,1.169-0.05c0,0,0.893-1.317,1.057-1.811C17.473,15.519,17.207,15.063,16.826,14.955 M17.398,11.142c-0.105-0.343-0.841-1.354-1.237-1.698c-0.397-0.346-0.852-0.303-1.107,0.001l-1.514,1.802c-0.256,0.304-0.324,0.784-0.152,1.067c0.17,0.282,0.627,0.442,1.013,0.356l2.617-0.485C17.489,12.071,17.506,11.484,17.398,11.142"/></g>',
		'<g id="blogger"><path d="M6.031,14.114c0,2.131,1.739,3.854,3.882,3.854h4.179c2.145,0,3.877-1.724,3.877-3.854v-2.732c0-0.425-0.342-0.77-0.771-0.77h-0.654c-0.426,0-0.76-0.318-0.787-0.717c-0.004-2.14-1.742-3.865-3.886-3.865H9.913c-2.144,0-3.88,1.725-3.882,3.855V14.114z M13.086,10c0,0.62-0.345,1.125-0.77,1.125h-2.261c-0.423,0-0.768-0.505-0.768-1.125c0-0.623,0.345-1.125,0.768-1.125h2.261C12.741,8.875,13.086,9.376,13.086,10z M15.256,14.078c0,0.597-0.326,1.089-0.725,1.089h-4.523c-0.399,0-0.721-0.492-0.721-1.089S9.608,13,10.008,13h4.523C14.93,13,15.256,13.481,15.256,14.078z"/></g>',
		'<g id="soundcloud"><path d="M7.521,16.146h1.119V9.094c-0.42,0.119-0.798,0.335-1.119,0.618V16.146z M5.282,11.375v4.762l0.072,0.009h1.047v-4.778H5.354L5.282,11.375z M3.042,13.755c0,0.867,0.451,1.621,1.12,2.04v-4.076C3.493,12.138,3.042,12.891,3.042,13.755z M9.761,16.146h1.12V9.405c-0.335-0.209-0.715-0.346-1.12-0.399V16.146z M18.646,11.367h-0.629c0.032-0.194,0.051-0.393,0.051-0.596c0-1.979-1.552-3.583-3.467-3.583c-1.039,0-1.966,0.478-2.602,1.227v7.731h6.646c1.276,0,2.312-1.07,2.312-2.391C20.958,12.437,19.922,11.367,18.646,11.367z"/></g>'
		];


		var icons = $('<svg id="svg-source" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" style="position:absolute; margin-left: -100%" xmlns:xlink="http://www.w3.org/1999/xlink">'+icons+'</svg>');
		
		$(document.body).prepend($(icons));

		$(".soc-ico a").not(".entry-share .soc-ico a").html('<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#social-500px"></use></svg>');
		$(".entry-share .soc-ico a").append('<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#social-500px"></use></svg>')
		var svg_icon = $(".soc-ico a svg use");

		$(".px-500").find(svg_icon).attr("xlink:href", "#social-500px");
		$(".tripedvisor").find(svg_icon).attr("xlink:href", "#tripedvisor");
		$(".vk").find(svg_icon).attr("xlink:href", "#vk");
		$(".foursquare").find(svg_icon).attr("xlink:href", "#foursquare");
		$(".website").find(svg_icon).attr("xlink:href", "#website");
		$(".mail").find(svg_icon).attr("xlink:href", "#mail");
		$(".behance").find(svg_icon).attr("xlink:href", "#behance");
		$(".stumbleupon").find(svg_icon).attr("xlink:href", "#stumbleupon");
		$(".instagram").find(svg_icon).attr("xlink:href", "#instagram");
		$(".github").find(svg_icon).attr("xlink:href", "#github");
		$(".skype").find(svg_icon).attr("xlink:href", "#skype");
		$(".devian").find(svg_icon).attr("xlink:href", "#devian");
		$(".pinterest").find(svg_icon).attr("xlink:href", "#pinterest");
		$(".tumbler").find(svg_icon).attr("xlink:href", "#tumbler");
		$(".vimeo").find(svg_icon).attr("xlink:href", "#vimeo");
		$(".linkedin").find(svg_icon).attr("xlink:href", "#linkedin");
		$(".lastfm").find(svg_icon).attr("xlink:href", "#lastfm");
		$(".forrst").find(svg_icon).attr("xlink:href", "#forrst");
		$(".flickr").find(svg_icon).attr("xlink:href", "#flickr");
		$(".delicious").find(svg_icon).attr("xlink:href", "#delicious");
		$(".rss").find(svg_icon).attr("xlink:href", "#rss");
		$(".you-tube").find(svg_icon).attr("xlink:href", "#you-tube");
		$(".dribbble").find(svg_icon).attr("xlink:href", "#dribbble");
		$(".google").find(svg_icon).attr("xlink:href", "#google");
		$(".twitter").find(svg_icon).attr("xlink:href", "#twitter");
		$(".facebook").find(svg_icon).attr("xlink:href", "#facebook");
		$(".xing").find(svg_icon).attr("xlink:href", "#xing");
		$(".odnoklassniki").find(svg_icon).attr("xlink:href", "#odnoklassniki");
		$(".weibo").find(svg_icon).attr("xlink:href", "#weibo");
		$(".research-gate").find(svg_icon).attr("xlink:href", "#research-gate");
		$(".yelp").find(svg_icon).attr("xlink:href", "#yelp");
		$(".blogger").find(svg_icon).attr("xlink:href", "#blogger");
		$(".soundcloud").find(svg_icon).attr("xlink:href", "#soundcloud");	
	
	/*Show soc icons*/
	$(".soc-ico a").css("visibility", "visible");



/* #Mobile header
================================================== */
// jQuery(document).ready(function($) {
	
		var $mixedHeader = $(".mixed-header"),
			$mobileWidgets = $(".masthead:not(.side-header) .header-bar .mini-widgets > * ").clone(true),
			$mobileSideWidgets = $(".side-header .header-bar .mini-widgets ").clone(true),
			// $firstSwitchWidgetsInMenu = $(".masthead .in-menu-first-switch").clone(true),
			 $firstSwitchWidgetsNearLogo = $(".masthead .near-logo-first-switch").clone(true).addClass("show-on-first-switch"),
			// $secondSwitchWidgetsInMenu = $(".masthead .in-menu-second-switch").clone(true),
			 $secondSwitchWidgetsNearLogo = $(".masthead .near-logo-second-switch").clone(true).addClass("show-on-second-switch"),
			$mobileWidgetsInMenu = $mastheadHeader.find(".in-menu-first-switch, .in-menu-second-switch").clone(true),
			$mobileWidgetsNearLogo = $mastheadHeader.find(".near-logo-first-switch, .near-logo-second-switch ").clone(true).addClass("show-on-second-switch");

		if($mixedHeader.length > 0){
			var $mobileLogo = $mixedHeader.find(".branding > a, .branding > img").clone(true),
				$activeHeader = $mixedHeader
		}else{
			var $mobileLogo = $(".masthead:not(.mixed-header)").find(".branding > a, .branding > img").clone(true),
				$activeHeader = $mastheadHeader;
		}
		if($topBar.length > 0 && $topBar.css('display') != 'none'){
			var topBarH = $topBar.innerHeight();
		}else{
			var topBarH = 0;
		}

		/*Append mobile header-bar to masthead*/
		$("<div class='mobile-header-bar'><div class='mobile-navigation'></div><div class='mobile-mini-widgets'></div><div class='mobile-branding'></div></div>").appendTo(".masthead");
		/*Mobile menu toggle icon*/
		$(".mobile-header-bar .mobile-navigation").append("<a href='#' class='dt-mobile-menu-icon'><span class='lines'></span></a>");
		/*Append mini widgets to mobile header-bar*/
		$(".mobile-header-bar .mobile-mini-widgets").append($mobileWidgets);
		/*Append logo to mobile header-bar*/
		$(".mobile-header-bar .mobile-branding").append($mobileLogo);

		var $mobileMenu = $(".dt-mobile-header");
		if($mobileMenu.siblings().hasClass("dt-parent-menu-clickable")){
			$mobileMenu.addClass("dt-parent-menu-clickable");
		}

		/*Mobile widgets*/
		$($mobileWidgetsInMenu).appendTo(".mobile-mini-widgets-in-menu");
		//$($firstSwitchWidgetsNearLogo).appendTo(".mobile-mini-widgets");
		$($secondSwitchWidgetsNearLogo).appendTo(".mobile-mini-widgets");
		$mobileMenu.append($mobileSideWidgets);
		

		/*Remove mega menu settings from mobile*/
		$(".mobile-main-nav ").find("li").each(function(){
			var $this = $(this),
				$this_sub = $this.find(" > .dt-mega-menu-wrap > .sub-nav");
			if($this.hasClass("new-column")){
				var $thisPrev = $this.prev().find(" > .sub-nav");
				$(" > .sub-nav > *", $this).appendTo($thisPrev)
			}
			$this_sub.unwrap();		
		}).removeClass('dt-mega-menu dt-mega-parent hide-mega-title').find(" > .sub-nav").removeClass("hover-style-click-bg hover-style-bg");


		/*!-Show Hide mobile header*/
		if($mobileMenu.length > 0 ) {
			dtGlobals.mobileMenuPoint = 50;
			var $menu = $(".dt-mobile-header"),
				$Mobilehamburger = $(".dt-mobile-menu-icon");
			//$menu.wrap("<div class='mobile-header-scrollbar-wrap'></div>"); - working with new header

			/*Mobile floating menu toggle*/
			if(!$(".floating-btn").length > 0 && $(".floating-mobile-menu-icon").length > 0){
				var $hamburgerFloat = $Mobilehamburger.first().clone(true);
				$hamburgerFloat.insertBefore($Mobilehamburger).addClass("floating-btn");
			}
			var $floatMobBtn = $(".floating-btn");
			
			var mobilePhantomAnimate = false;

			//!--Working with new header
			// $window.scroll(function () {
			// 	dtGlobals.mobileMenuPoint = $activeHeader.offset().top + $activeHeader.height() + 50;
			// //	if (!$(".show-mobile-header").length > 0) {
			// 		if(dtGlobals.winScrollTop > dtGlobals.mobileMenuPoint){
			// 			//console.log("show float")
			// 			$floatMobBtn.parents(".masthead").addClass("show-floating-icon");
			// 			//$body.addClass("show-floating-icon");
			// 		}
			// 		else {
			// 			$floatMobBtn.parents(".masthead").removeClass("show-floating-icon");
			// 			//$body.removeClass("show-floating-icon");
			// 		}
			// 		if(dtGlobals.winScrollTop > (dtGlobals.mobileMenuPoint - 50)){
			// 			$body.addClass("stick-to-top");
			// 		}else{
			// 			$body.removeClass("stick-to-top");
			// 		}


			// 		//sticky mobile header && sticky desktop header (show/hide top bar)
			// 		if ($(".sticky-mobile-header").length > 0) {
			// 			if (dtGlobals.winScrollTop > topBarH && !mobilePhantomAnimate) {
			// 				mobilePhantomAnimate = true;
			// 				$(".mobile-header-scrollbar-wrap").css({
			// 					'padding-top': $(".mobile-header-bar", $activeHeader).height()
			// 				});
			// 				// $(".masthead-mobile")
			// 				// 	.stop(true, true)
			// 				// 	.velocity({
			// 				// 		translateY : -topBarH,
			// 				// 	}, 0);
			// 				$body.removeClass('mobile-sticky-off').addClass('mobile-sticky-on');
			// 				$body.addClass("fixed-mobile-menu");
			// 			}else if (dtGlobals.winScrollTop <= topBarH && mobilePhantomAnimate) {
			// 				mobilePhantomAnimate = false;
			// 				$(".mobile-header-scrollbar-wrap").css({
			// 					'padding-top': $(".mobile-header-bar", $activeHeader).height() + topBarH
			// 				});
			// 				// $(".masthead-mobile")
			// 				// 	.stop(true, true)
			// 				// 	.velocity({
			// 				// 		translateY : 0,
			// 				// 	}, 0);
			// 				$body.removeClass('mobile-sticky-on').addClass('mobile-sticky-off');
			// 				$body.removeClass("fixed-mobile-menu");
			// 			}
			// 		}
			// 		//floating mobile icon (show/hide header)
			// 		if(dtGlobals.winScrollTop <= ($(".mobile-header-bar", $activeHeader).height() + topBarH) && $(".floating-mobile-menu-icon").length > 0){
			// 			$(".mobile-header-scrollbar-wrap").css({
			// 				'padding-top': $(".mobile-header-bar", $activeHeader).height() + topBarH - dtGlobals.winScrollTop
			// 			});
			// 		}
			// 	//}
			// });

			$window.scroll(function () {
				dtGlobals.mobileMenuPoint = $activeHeader.offset().top + $activeHeader.height() + 50;

				if(dtGlobals.winScrollTop > dtGlobals.mobileMenuPoint){
					//console.log("show float")
					$floatMobBtn.parents(".masthead").addClass("show-floating-icon");
				}
				else {
					$floatMobBtn.parents(".masthead").removeClass("show-floating-icon");
				}
				if(dtGlobals.winScrollTop > $(".masthead:not(.side-header)").height()){
					$menu.addClass("stick-to-top");
				}else{
					$menu.removeClass("stick-to-top");
				}
			});
			var $Mobilehamburger = $(".dt-mobile-menu-icon");

			/*Append overlay for mobile menu*/
			if(!$(".mobile-sticky-header-overlay").length > 0){
				$body.append('<div class="mobile-sticky-header-overlay"></div>');
				
				//!--Working with new header
				//Prevent page scrolling when scrolling a overlay
				// var scrollableOverlay = document.querySelector('.mobile-sticky-header-overlay');

				// scrollableOverlay.addEventListener('wheel', function(event) {
				// 	var deltaY = event.deltaY;
				// 	var contentHeight = scrollableOverlay.scrollHeight;
				// 	var visibleHeight = scrollableOverlay.offsetHeight;
				// 	var scrollTop = scrollableOverlay.scrollTop;

				// 	if (scrollTop === 0 && deltaY < 0)
				// 		event.preventDefault();
				// 	else if (visibleHeight + scrollTop === contentHeight && deltaY > 0)
				// 		event.preventDefault();
				// });
			}
					
			 var $mobileOverlay = $(".mobile-sticky-header-overlay");

			/*Click on mobile menu toggle*/
			$Mobilehamburger.on("click", function (e){
				e.preventDefault();
				
				var $this = $(this);

				//!--Working with new header

				// if ($this.hasClass("active")){
				// 	$this.removeClass("active");
				// 	$Mobilehamburger.removeClass("active");
				// 	$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
				// 	$body.removeClass("show-mobile-overlay-header").addClass("closed-overlay-mobile-header");
				// 	$this.parents("body").removeClass("show-sticky-mobile-header");
				// 	$mobileOverlay.removeClass("active");
				// }else{
				// 	$Mobilehamburger.addClass("active");
				// 	$this.addClass('active');
				// 	$page.addClass("show-mobile-header").removeClass("closed-mobile-header");
				// 	$body.removeClass("closed-overlay-mobile-header").addClass("show-overlay-mobile-header");
				// 	$mobileOverlay.removeClass("active");
				// 	$this.parents("body").addClass("show-sticky-mobile-header");
					
				// 	$mobileOverlay.addClass("active");
				// };

				if ($this.hasClass("active")){
					$this.removeClass("active");
					$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
					$body.removeClass("show-mobile-overlay-header").addClass("closed-overlay-mobile-header");
					$this.parents("body").removeClass("show-sticky-mobile-header");
					$mobileOverlay.removeClass("active");
				}else{
					$Mobilehamburger.removeClass("active");
					$this.addClass('active');
					$page.addClass("show-mobile-header").removeClass("closed-mobile-header");
					$body.removeClass("closed-overlay-mobile-header").addClass("show-overlay-mobile-header");
					$mobileOverlay.removeClass("active");
					$this.parents("body").addClass("show-sticky-mobile-header");
					
					$mobileOverlay.addClass("active");
				};

			
			});
			$mobileOverlay.on("click", function (){
				if($(this).hasClass("active")){
					$Mobilehamburger.removeClass("active");
					$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
					$body.removeClass("show-sticky-mobile-header").addClass("closed-overlay-mobile-header").addClass("closed-overlay-mobile-header");
					$mobileOverlay.removeClass("active");
					
				}
			});
			$(".dt-close-mobile-menu-icon span").on("click", function (){
				
				$page.removeClass("show-mobile-header");
				$page.addClass("closed-mobile-header");
				$body.removeClass("show-sticky-mobile-header");
				$body.removeClass("show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
				$mobileOverlay.removeClass("active");
				$Mobilehamburger.removeClass("active");
								
			});
			
			////!--Return with old header
			$(".dt-mobile-header").wrapInner("<div class='mobile-header-scrollbar-wrap'></div>");
			if(!dtGlobals.isMobile){
				$(".mobile-header-scrollbar-wrap").mCustomScrollbar({
					scrollInertia:150
				});
			}

		};
		
		$.mobileHeader = function() {
			if($topBar.length > 0 && $topBar.css('display') != 'none'){
				var topBarH = $topBar.innerHeight()
			}else{
				var topBarH = 0;
			}

			if($(".sticky-mobile-header ").length > 0){
				if($(".mixed-header").length > 0){
					var headerH = $(".mixed-header").height();
				}else{
					var headerH = $mastheadHeader.height();
				}
				var stickyMobileHeader = $('.masthead').first();
				if(!$(".mobile-header-space").length > 0 && !$(".floating-navigation-below-slider").length > 0){
					$("<div class='mobile-header-space'></div>").insertBefore(stickyMobileHeader);
				}
				$(".mobile-header-space").css({
					height: headerH
				});
			}
			// $(".dt-mobile-header").css({
			// 	'margin-top': $(".mobile-header-bar", $activeHeader).height() + topBarH,
			// 	'max-height': $window.height() - $(".mobile-header-bar", $activeHeader).height() - topBarH
			// });
				// $(".mobile-header-scrollbar-wrap").css({
				// 	'padding-top': $(".mobile-header-bar", $activeHeader).height() + topBarH
				// });

			//$(".dt-mobile-header").mCustomScrollbar("update");
		}
		$.mobileHeader();


		//Prevent page scrolling when scrolling a div element
		// var scrollable = document.querySelector('.dt-mobile-header');

		// scrollable.addEventListener('wheel', function(event) {
		// 	var deltaY = event.deltaY;
		// 	var contentHeight = scrollable.scrollHeight;
		// 	var visibleHeight = scrollable.offsetHeight;
		// 	var scrollTop = scrollable.scrollTop;

		// 	if (scrollTop === 0 && deltaY < 0)
		// 		event.preventDefault();
		// 	else if (visibleHeight + scrollTop === contentHeight && deltaY > 0)
		// 		event.preventDefault();
		// });

		//!--Working with new header

		// $( '.dt-mobile-header' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
		//     var e0 = e.originalEvent,
		//         delta = e0.wheelDelta || -e0.detail;
		    
		//     this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
		//     e.preventDefault();
		// });

		// //Prevent page touch moving when move a div element
		// var touchStartEvent;
		// $('.dt-mobile-header, .mobile-sticky-header-overlay').on({
		//     touchstart: function(e) {
		//         touchStartEvent = e;
		//     },
		//     touchmove: function(e) {
		//         if ((e.originalEvent.pageY > touchStartEvent.originalEvent.pageY && this.scrollTop == 0) ||
		//             (e.originalEvent.pageY < touchStartEvent.originalEvent.pageY && this.scrollTop + this.offsetHeight >= this.scrollHeight))
		//             e.preventDefault();
		//     }
		// });
	
// })


/* #Floating menu
================================================== */
// jQuery(document).ready(function($) {
	
	/*--Set variable for floating menu*/
	if (dtGlobals.isMobile && !dtGlobals.isiPad) dtLocal.themeSettings.floatingHeader.showMenu = false;
	
	// var $body = $("body"),
	// 	$html  = $("html"),
	var bodyTransparent = $body.hasClass("transparent"),
		phantomStickyExists = $(".phantom-sticky").exists(),
		sideHeaderExists = $(".side-header").exists(),
		sideHeaderHStrokeExists = $(".side-header-h-stroke").exists(),
		floatingNavigationBelowSliderExists = $(".floating-navigation-below-slider").exists();


	/* Floating navigation -> Style -> Sticky */

	if(dtLocal.themeSettings.floatingHeader.showMenu) {
		if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists)){


			var $topBar = $(".top-bar"),
				topBarH = 0,
				stickyHeaderH = $(".masthead").height(),
				logoURL = $(".masthead:not(.side-header) .branding a").attr("href"),
				$stickyHeader = $(".masthead:not(.side-header)"),
				$stickyMenu = $stickyHeader.find(".header-bar"),
				$stickyLogo = $stickyHeader.find(".branding"),
				$topLine = $(".side-header-h-stroke"),
				topLineExists = $topLine.exists(),
				$headerSpace = $(".header-space"),
				$mainSlideshow = $("#main-slideshow, .photo-scroller"),
				$classHeaderExists = $(".classic-header").length > 0;
			if(!floatingNavigationBelowSliderExists) {
				if(!$classHeaderExists){
					$("<div class='animate-sticky'></div>").prependTo($stickyMenu);
				}
			}
			var $animatedLine = $(".animate-sticky");

			if (topLineExists) {
				// No real header - only a top line
				stickyHeaderH = $topLine.height(),
				$stickyHeader = $topLine;
			}

			// Append empty div for fixed header
			if (!$headerSpace.exists()) {
				$("<div class='header-space'></div>").insertBefore($stickyHeader);
				$headerSpace = $(".header-space");
			};

			if (topLineExists) {
				$headerSpace.addClass("top-line-space");
			};

			$headerSpace.css({
				height: stickyHeaderH
			});
			$animatedLine.css({
				height: $stickyMenu.height()
			});

			$body.addClass('sticky-off fixed-masthead');

			// Logo for sticky floating
			if(!$(".sticky-logo").length > 0) {
				if (dtLocal.themeSettings.floatingHeader.logo.html && dtLocal.themeSettings.floatingHeader.logo.showLogo) {
					if (logoURL == undefined) {

						//$('<img class="sticky-logo" src="'+dtLocal.themeSettings.floatingHeader.logo.src+'" height="'+dtLocal.themeSettings.floatingHeader.logo.h+'" width="'+dtLocal.themeSettings.floatingHeader.logo.w+'">').prependTo($stickyLogo);
						$(dtLocal.themeSettings.floatingHeader.logo.html).addClass("sticky-logo").prependTo($stickyLogo)
					}
					else {
						//$('<a class="sticky-logo" href="'+logoURL+'"><img src="'+dtLocal.themeSettings.floatingHeader.logo.src+'" height="'+dtLocal.themeSettings.floatingHeader.logo.h+'" width="'+dtLocal.themeSettings.floatingHeader.logo.w+'"></a>').prependTo($stickyLogo);
						$('<a class="sticky-logo" href="'+logoURL+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>').prependTo($stickyLogo);
					};
				};
			};
			var $stickyLogo = $(".phantom-custom-logo-on .sticky-logo"),
				$logo = $(".phantom-custom-logo-on").find(".branding > a:not(.sticky-logo), .branding > img:not(.sticky-logo)", $stickyHeader);


			var phantomAnimate = false,
				adminBarExists = $(".admin-bar").exists();

			if (adminBarExists) {
				var adminBarH = 32;
			}
			else {
				var adminBarH = 0;
			};

			if ($topBar.exists() && !$topBar.is( ":hidden" ) && !floatingNavigationBelowSliderExists) {
				topBarH = $topBar.innerHeight();
			};

			var stickyHeaderStartHeight = $stickyHeader.height();

			$window.on("scroll", function() {

				/*When sticky navigation should be shown*/
				var posScrollTop = dtGlobals.winScrollTop, //window scroll top position
					sliderH,
					showFloatingAfter;

				if (floatingNavigationBelowSliderExists && !bodyTransparent) {
					sliderH = $mainSlideshow.height();
					showFloatingAfter = posScrollTop > sliderH;
				}
				else if (floatingNavigationBelowSliderExists && bodyTransparent) {
					sliderH = $mainSlideshow.height() - adminBarH - stickyHeaderStartHeight;// + dtLocal.themeSettings.floatingHeader.height;
					showFloatingAfter = posScrollTop > sliderH;
				}
				else {
					showFloatingAfter = posScrollTop > dtLocal.themeSettings.floatingHeader.showAfter;
				};

				if (showFloatingAfter && !phantomAnimate && !dtGlobals.mobileProcessed) {
					phantomAnimate = true;

					if (!floatingNavigationBelowSliderExists) {
						$stickyHeader
							.stop(true, true)
							.velocity({
								translateY : -topBarH,
							}, 300);

						$animatedLine.stop()
							.velocity({
								height : dtLocal.themeSettings.floatingHeader.height,
							}, 300);
						

						if (!bodyTransparent) {	
							$headerSpace.css({
								height: stickyHeaderH// - topBarH
							});
						} 
						else {
							$headerSpace.css({
								display: "none",
							});
						};
					}
					else {
						if (!bodyTransparent) {
							$stickyHeader
								.stop(true, true)
								.velocity({
									translateY : -topBarH,
								}, 300);
							$animatedLine.stop()
								.velocity({
									height : dtLocal.themeSettings.floatingHeader.height,
								}, 300);
	
							$headerSpace.css({
								height: stickyHeaderH// - topBarH
							});
						} 
						else {
							$stickyHeader
							.velocity({
								translateY : ""
							}, 0, function() {
								$stickyHeader.css({
									top: adminBarH,
									"transform": "",
									"-webkit-transform" : "",
								});
							});
							$animatedLine.stop()
								.velocity({
									height : dtLocal.themeSettings.floatingHeader.height,
								}, 300);
							$headerSpace.css({
								display: "none",
							});
						};
					}
					$body.removeClass('sticky-off').addClass('sticky-on');
				}
				else if (!showFloatingAfter && phantomAnimate && !dtGlobals.mobileProcessed) {
					phantomAnimate = false;

					if (!floatingNavigationBelowSliderExists) {
						
						$stickyHeader
						//	.stop(true, true)
							.velocity({
								translateY : 0,
							}, 0);
						if(!$html.hasClass("menu-open")){
							$animatedLine.stop()
								.velocity({
									height : stickyHeaderH,
								}, 0);
						}
					
						if (!bodyTransparent) {
							$headerSpace.css({
								height: stickyHeaderH
							});
						}
						else {
							$headerSpace.css({
								display: "none",
							});
						};
					}
					else {
						if (!bodyTransparent) {
							$stickyHeader
								.stop(true, true)
								.velocity({
									translateY : -topBarH,
								}, 0);
							if(!$html.hasClass("menu-open")){
								$animatedLine.stop()
									.velocity({
										height : stickyHeaderH,
									}, 0);
							}
														
							$headerSpace.css({
								height: stickyHeaderH// - topBarH
							});
						} 
						else {

							if(!$html.hasClass("menu-open")){		
								$stickyHeader
									.css({
										bottom : "auto",
										top: "auto",
										"transform": "translateY(-100%)",
										"-webkit-transform" : "translateY(-100%)",
									});
								$headerSpace.css({
									display: "none",
								});

							}
						};
					};
					if(!$html.hasClass("menu-open")){									
						$body.removeClass('sticky-on').addClass('sticky-off');
						$animatedLine.stop()
							.velocity({
								height : $stickyMenu.height(),
							}, 0);
					}
				}
				else if (dtGlobals.mobileProcessed) {
					$stickyHeader
						.css({
							bottom : "auto",
							top: "auto",
							"transform": "",
							"-webkit-transform" : "",
						});
					$headerSpace.css({
						display: "none",
					});
					$body.removeClass('sticky-on').addClass('sticky-off');
				};
			});

		};
	};


	/* Floating navigation -> Style -> fade, Slide */

	if(dtLocal.themeSettings.floatingHeader.showMenu) {

		if ((dtLocal.themeSettings.floatingHeader.showMenu && !(sideHeaderExists && !phantomStickyExists)) || (dtLocal.themeSettings.floatingHeader.showMenu && (sideHeaderHStrokeExists && !phantomStickyExists ))) {

			var phantomFadeExists = $(".phantom-fade").exists(),
				phantomSlideExists = $(".phantom-slide").exists(),
				splitHeaderExists = $(".split-header").exists(),
				$mainSlideshow = $("#main-slideshow, .photo-scroller"),
				$mainHeader = $(".masthead:not(.side-header)");

			if( phantomFadeExists || phantomSlideExists) {

				var $headerMenu = $(".masthead:not(#phantom) .main-nav").clone(true),
					logoURL = $(".masthead:not(.side-header) .branding a").attr("href"),
					isMoved = false;

				if (sideHeaderHStrokeExists || splitHeaderExists) {
					var $headerTopLine = $(".side-header-h-stroke, .split-header"),
						headerClass = $headerTopLine.attr("class"),
						$parent = $headerMenu.parent(),
						$phantom = $('<div id="phantom" class="'+headerClass+'"><div class="ph-wrap"></div></div>').appendTo("body"),
						$menuBox = $phantom.find(".ph-wrap"),
						$widgetBox = $phantom.find(".widget-box"),
						$widget = $headerMenu.find(".mini-widgets"),
						$phantomLogo = $headerTopLine.find(".branding");
						//$headerMenu = $(".side-header-h-stroke .header-bar, .split-header .header-bar").clone(true);
					

					/*Phantom logo*/

					if($(".phantom-custom-logo-on").length > 0){

						if (dtLocal.themeSettings.floatingHeader.logo.html && dtLocal.themeSettings.floatingHeader.logo.showLogo) {
							if (logoURL == undefined){
								$(dtLocal.themeSettings.floatingHeader.logo.html).prependTo($phantomLogo)
							}
							else {
								$('<a class="phantom-top-line-logo" href="'+logoURL+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>').prependTo($phantomLogo);
							};
						};

						
					};
					//Generate floating content on load
					var $headerMenu = $(".side-header-h-stroke .header-bar, .split-header .header-bar").clone(true);
					$headerMenu.appendTo($menuBox);
				}
				else {
					var headerClass = $(".masthead").attr("class"),
						$parent = $headerMenu.parent(),
						$phantom = $('<div id="phantom" class="'+headerClass+'"><div class="ph-wrap"><div class="logo-box"></div><div class="menu-box"></div><div class="widget-box"></div></div></div>').appendTo("body"),
						$menuBox = $phantom.find(".menu-box"),
						$widgetBox = $phantom.find(".widget-box");

					if ($(".classic-header").length > 0) {
						var $widget = $(".header-bar .navigation .mini-widgets").clone(true);
					}
					else if (splitHeaderExists) {}
					else {
						var $widget = $(".header-bar .mini-widgets").clone(true);
					};
					//Generate floating content on load
					$headerMenu.appendTo($menuBox);
					$widget.appendTo($widgetBox);

					/*Phantom logo*/
					if (dtLocal.themeSettings.floatingHeader.logo.html && dtLocal.themeSettings.floatingHeader.logo.showLogo) {
						$phantom.find(".ph-wrap").addClass("with-logo");

						if(logoURL == undefined){
							$phantom.find(".logo-box").html(dtLocal.themeSettings.floatingHeader.logo.html);
						}
						else {
							$phantom.find(".logo-box").html('<a href="'+logoURL+'">' + dtLocal.themeSettings.floatingHeader.logo.html +' </a>');
						};
					};

					
				};
				
				if ($page.hasClass("boxed")) {
					$phantom.addClass("boxed").velocity({ translateX : "-50%" }, 0).find(".ph-wrap").addClass("boxed");
				}

				/* Hide floating on load */
				$body.removeClass('phantom-on').addClass('phantom-off');


				var phantomAnimate = false;

				var phantomTimeoutShow,
					phantomTimeoutHide;	

				if (phantomSlideExists) {
					$phantom.velocity({
						translateY : -$phantom.height(),
					}, 0);
				};

				$window.on("scroll", function() {
					
					var tempScrTop = dtGlobals.winScrollTop,
						sliderH = $mainSlideshow.height(),
						headerH = $mainHeader.height();

					if (floatingNavigationBelowSliderExists && bodyTransparent) {
						var showFloatingAfter = tempScrTop > sliderH && isMoved === false,
							hideFloatingAfter = tempScrTop <= sliderH && isMoved === true;

					}
					else if (floatingNavigationBelowSliderExists) {
						var showFloatingAfter = tempScrTop > (sliderH + headerH) && isMoved === false,
							hideFloatingAfter = tempScrTop <= (sliderH + headerH) && isMoved === true;
					}
					else {
						var showFloatingAfter = tempScrTop > dtLocal.themeSettings.floatingHeader.showAfter && isMoved === false,
							hideFloatingAfter = tempScrTop <= dtLocal.themeSettings.floatingHeader.showAfter && isMoved === true;
					};

					if (showFloatingAfter) {
						if(!$html.hasClass("menu-open")){	

							if( !dtGlobals.isHovering && !phantomAnimate ) {
								phantomAnimate = true;

								if (sideHeaderHStrokeExists || splitHeaderExists) {
									//$headerMenu.appendTo($menuBox);
								}
								else {
									if (splitHeaderExists) {}
									else {
										//$headerMenu.appendTo($menuBox);
										//$widget.appendTo($widgetBox);
									};
								};

								if (phantomFadeExists) {
									$phantom
									.stop()
									.css({
										"visibility" : "visible"
									})
									.velocity({
										"opacity" : 1
									}, 350);
								}
								else if (phantomSlideExists) {
									$phantom
									.stop(true, true)
									.css({
										"visibility" : "visible"
									})
									// .velocity("stop")
									.velocity({
										translateY : 0,
										opacity : 1
									}, {
										duration: 400,
										//delay: 100
									});
								};

								$body.removeClass('phantom-off').addClass('phantom-on');

								isMoved = true;
							};
						// }, 100);
						}


					}
					else if (hideFloatingAfter) {

						if(phantomAnimate) {

							// phantomTimeoutHide = setTimeout(function() {
							if(!$html.hasClass("menu-open")){	
								phantomAnimate = false;

								if(sideHeaderHStrokeExists || splitHeaderExists) {
									//$headerMenu.appendTo($parent);
								}
								else {
									if (splitHeaderExists) {
									 }
									else {
										//$headerMenu.appendTo($parent);
										//$widget.appendTo($parent);
									};
								};

								$body.removeClass('phantom-on').addClass('phantom-off');


								if (phantomFadeExists) {
									$phantom.stop().velocity({
										"opacity" : 0
									}, 120, function() {
										$phantom.css({
											"visibility": ""
										});
									});
								}
								else if (phantomSlideExists) {
									$phantom.velocity({
										opacity : 0
									}, 0, function() {
										$phantom
									//.stop(true, true)
											.css({
												"visibility": ""
											})
											.velocity({
												translateY : -$phantom.height(),
											}, 0);
									});
								}
				
								isMoved = false;
							// }, 100);
							}
						}

					};
					
				});
			};
		};
	};

// });


/* #Custom menu
================================================== */
// jQuery(document).ready(function($) {
	var customTimeoutShow;

	if($(".dt-parent-menu-clickable").length > 0){

		var item = $('.main-nav li.has-children > a, .mobile-main-nav li.has-children > a');
		$("<i class='next-level-button'></i>").insertAfter(item);

		$(".sub-downwards .main-nav li.has-children, .mobile-main-nav li.has-children").each(function(){
			var $this = $(this);
			// if($this.hasClass("dt-mega-menu")){
			// 	var subMenu = $this.find(" > .sub-nav, .sub-menu");
			// }else{
				var subMenu = $this.find(" > .sub-nav, .sub-menu");
		//	}
			if($this.find(".sub-nav li, .sub-menu li").hasClass("act")){
				$this.addClass('active');
			};

			if($this.find(".sub-nav li.act, .sub-menu li.act").hasClass("act")){
				$this.addClass('open-sub');
				subMenu.stop(true, true).slideDown(100);
			};
			$this.find(" > .next-level-button").on("click", function(e){
				var $this = $(this).parent();
				if ($this.hasClass("active")){
					subMenu.stop(true, true).slideUp(500);
					$this.removeClass("active");
					$this.removeClass('open-sub');
				}else{
					$this.siblings().find(" .sub-nav, .dt-mega-menu-wrap, .sub-menu").stop(true, true).slideUp(400);
					subMenu.stop(true, true).slideDown(500);
					$this.siblings().removeClass("active");
					$this.addClass('active');
					$this.siblings().removeClass('open-sub');
					$this.addClass('open-sub');
				};

				//$(".header-bar").mCustomScrollbar("update");
			})
		});

	}else{
		$(".sub-downwards .main-nav li > a, .mobile-main-nav li.has-children > a").each(function(){
			var $this = $(this);
			if($this.parent("li").find(".sub-nav li, .sub-menu li").hasClass("act")){
				$this.addClass('act');
			};
			if($this.parent("li").find(".sub-nav li.act, .sub-menu li.act").hasClass("act")){
				$this.parent("li").addClass('open-sub');
				$this.siblings(".sub-nav, .sub-menu").stop(true, true).slideDown(100);
			};
			$this.on("click", function(e){
				$menuItem = $this.parent();
				if ($menuItem.hasClass("has-children menu-item-language")) e.preventDefault();
				
				if ($this.hasClass("act")){
					$this.siblings(".sub-nav, .sub-menu").stop(true, true).slideUp(500);
					$this.removeClass("act");
					$this.parent("li").removeClass('open-sub');
				}else{
					$this.parent().siblings().find(".sub-nav, .dt-mega-menu-wrap, .sub-menu").stop(true, true).slideUp(400);
					$this.siblings(".sub-nav, .sub-menu").stop(true, true).slideDown(500);
					$this.parent().siblings().find("> a").removeClass("act");
					$this.addClass('act');
					$this.parent("li").siblings().removeClass('open-sub');
					$this.parent("li").addClass('open-sub');
				};
				$(".header-bar").mCustomScrollbar("update");
			});
		});

	};


	$(".custom-nav > li > a").click(function(e){
		$menuItem = $(this).parent();
		if ($menuItem.hasClass("has-children")) e.preventDefault();
		
		
			if ($(this).attr("class") != "active"){
					$(".custom-nav > li > ul").stop(true, true).slideUp(400);
					$(this).next().stop(true, true).slideDown(500);
					$(".custom-nav > li > a").removeClass("active");
					$(this).addClass('active');
			}else{
					$(this).next().stop(true, true).slideUp(500);
					$(this).removeClass("active");
			}

			$menuItem.siblings().removeClass("act");
			$menuItem.addClass("act");
	});

	$(".custom-nav > li > ul").each(function(){
		clearTimeout(customTimeoutShow);
		$this = $(this);
		$thisChildren = $this.find("li");
		if($thisChildren.hasClass("act")){
			$this.prev().addClass("active");
			$this.parent().siblings().removeClass("act");
			$this.parent().addClass("act");
			$(this).slideDown(500);
		}
	});
// })


/* #Filter
================================================== */
// jQuery(document).ready(function($) {

	/*!-categories filter*/
	$(".filter-categories").each(function() {
		var $self = $(this);
		
		$self.find("> a").on("click", function(e) {
			var $this = $(this);

			if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
				var $filter = $this.parents(".filter").first();

				if ( $filter.hasClass("without-isotope") ) {
					arguments.callee.dtPreventD = $filter.hasClass("with-ajax") ? true: false;
				} else {
					arguments.callee.dtPreventD = true;
				};
			};

			e.preventDefault();

			$this.trigger("mouseleave");

			if ($this.hasClass("act") && !$this.hasClass("show-all")) {
				e.stopImmediatePropagation();
				$this.removeClass("act");
				$this.siblings("a.show-all").trigger("click");//.addClass("act");
			} else {
				$this.siblings().removeClass("act");
				$this.addClass("act");

				if ( !arguments.callee.dtPreventD ) {
					window.location.href = $this.attr("href");
				}
			};
		});
	});

	/*!- ordering*/
	$(".filter-extras .filter-switch").each(function(){
		var $_this = $(this);
		if($_this.prev('.act').length > 0){
			$_this.addClass('left-act');
		}else if($_this.next('.act').length > 0){
			$_this.addClass('right-act');
		}else{
			$_this.removeClass('right-act');
			$_this.removeClass('left-act');
		};
	});

	$(".filter-extras").each(function(){
		$(this).find('a').on("click", function(e) {
			var $this = $(this);

			if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
				var $filter = $this.parents(".filter").first();

				if ( $filter.hasClass("without-isotope") ) {
					arguments.callee.dtPreventD = $filter.hasClass("with-ajax") ? true: false;
				} else {
					arguments.callee.dtPreventD = true;
				}
			};

			if ( arguments.callee.dtPreventD ) {
				e.preventDefault();
			};

			$this.siblings().removeClass("act");
			$this.addClass("act");

			$(".filter-extras .filter-switch").each(function(){
				var $_this = $(this);
				if($_this.prev($this).hasClass('act')){
					$_this.addClass('left-act');
					$_this.removeClass('right-act');
				}else if($_this.next($this).hasClass('act')){
					$_this.addClass('right-act');
					$_this.removeClass('left-act');
				}else{
					$_this.removeClass('right-act');
					$_this.removeClass('left-act');
				};
			});
		});
	});

	$(".filter-extras .filter-switch").each(function(){
		var $this = $(this);
		var $filter = $this.parents(".filter").first();
		$this.on("click", function(){
			if ( $filter.hasClass("without-isotope") ) {
				if($this.hasClass("right-act")){
					$this.prev("a")[0].click();
				}else if ($this.hasClass("left-act")){
					
					$this.next("a")[0].click();
				};
			}else{
				if($this.hasClass("right-act")){
					$this.prev("a").trigger("click");
				}else if ($this.hasClass("left-act")){
					$this.next("a").trigger("click");
				};
			};
		});
	});

	//List filter
	$(".mode-list .filter-categories > a:not(.show-all)").each(function(){
		$this = $(this),
		$dataFiltr = $this.attr("data-filter");
		$newDataFilter = $dataFiltr.substring(1, $dataFiltr.length);
		$this.attr("data-filter", $newDataFilter)
	})
	$.fn.shortcodesFilter = function() {
		var $el = $(this),
			$elFilter = $el.find(".filter-categories"),
			$elPaginator = $el.find(".paginator"),
			$elSort = $el.find(".filter-by"),
			$elOrder = $el.find(".filter-sorting"),
			$elDefaultSort = $el.find(".filter-by .act").attr('data-by'),
			$elDefaultOrder = $el.find(".filter-sorting .act").attr('data-sort'),
			$paginationMode = $el.attr("data-pagination-mode"),
			$postLimit = $el.attr("data-post-limit");
	// $('.blog-shortcode.mode-list').each(function(){
	// 	$this = $(this.selctor);

		$el.Filterade({
			// Pagination
			pageLimit: $postLimit,
			 paginationMode: $paginationMode,
			// Filters
			useFilters: true, 
			useSorting: true,
			filterControls: $elFilter,
			sortControls: $elSort,
			orderControls: $elOrder,
			pageControls: $elPaginator,
			controlsSelecter: 'a',
			controlsSelecterChecked: 'a.act',
			defaultFilter: '*',
			selectAll: '*',
		//	loadMoreButtonClass: 'button-load-more',
			defaultSort: $elDefaultSort,
			defaultOrder: $elDefaultOrder

		});
		function lazyLoading() {
			if($el.hasClass("lazy-loading-mode")){
				var buttonOffset = $el.find('.button-load-more').offset();
				if ( buttonOffset && $window.scrollTop() > (buttonOffset.top - $window.height()) / 2){
					$el.find('.button-load-more').trigger('click');
				
				}
				
			}
		}
		$window.on('scroll', function () {
			lazyLoading();
		});
		lazyLoading();

	}

	$('.blog-shortcode.jquery-filter').each(function(){
		var $this = $(this);
		$this.shortcodesFilter();
	});

// });


/* #One-page
================================================== */



// jQuery(document).ready(function($) {
	var $moveBody = $("html");

	/*Detect floating header*/
	if($(".phantom-sticky").length > 0){
		var $phantom = $(".masthead:not(.side-header):not(.side-header-v-stroke)"),
			$phantomVisibility = 1;
	}else{
		var $phantom = $("#phantom"),
			$phantomVisibility = $phantom.css("display")=="block";
	}


	// One page scrolling effect
	var phantomStickyExists = $(".phantom-sticky").exists(),
		sideHeaderExists = $(".side-header").exists(),
		sideHeaderHStrokeExists = $(".side-header-h-stroke").exists(),
		floatMenuH = 0;
	if ($(".mobile-header-bar").css('display') !== 'none') {
		var $headerBar = $(".mobile-header-bar");
		if($(".phantom-sticky").length > 0){
			if($(".sticky-header .masthead.side-header").length > 0 || $(".overlay-navigation .masthead.side-header").length > 0){
				var $phantom = $(".mobile-header-bar").parent(".masthead:not(.side-header)");
			}else{
				var $phantom = $(".mobile-header-bar").parent();
			}
		}
	}else{
		var $headerBar = $(".masthead:not(.side-header):not(.side-header-v-stroke) .header-bar");
	}

	/*Floating header height*/
	function set_sticky_header_height() {
		if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
			if($(".sticky-mobile-header").length > 0){
				floatMenuH = $phantom.height();
			}else{
				floatMenuH = 0;
			}
		}else{
			if($phantom.css("display")=="block" || (phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists)){			
				floatMenuH = $phantom.height();
			}else{
				floatMenuH = 0;
			}
		}
	}
	set_sticky_header_height();



	/*Set cuurent item on load*/
	jQuery(window).load(function(){
		var locHash = window.location.hash;
		if(locHash.match("^#!")){
			var urlHash = locHash.substring(3);
		}
		// else if(locHash.match("^#")){
		// 	var urlHash = locHash.substring(1);
		// }else{
		// 	var urlHash = undefined;
		// }
		if( typeof urlHash != 'undefined' && urlHash.length > 0 ) {
			if(urlHash == "up") {
				$.closeMobileHeader();
				$moveBody.stop().velocity("scroll", { 
					offset: 0,
					duration: 600,
					mobileHA: false,
					complete: function(elements) { $.closeSideHeader(); }
				});

			}else{
				setTimeout(function(){
					$moveBody.stop().velocity("scroll", { 
						offset: $("#" + urlHash).offset().top - floatMenuH,
						duration: 600,
						mobileHA: false,
						complete: function(elements) { 
						//	$.closeSideHeader();

							if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								if($(".sticky-mobile-header").length > 0){
								
									$moveBody.stop().velocity("scroll", { 
										offset: $("#" + urlHash).offset().top - $phantom.height(),
										duration: 650,
										mobileHA: false 
									});
								}
							}else{
								if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists )){
									
								
									$moveBody.stop().velocity("scroll", { 
										offset: $("#" + urlHash).offset().top - $($headerBar, $phantom).height(),
										duration: 650,
										mobileHA: false 
									});

								}
							}
						}
					});
				},300)
			}
			$('.menu-item a').parent("li").removeClass('act');
			$('.menu-item a[href="'+locHash+'"]').parent("li").addClass('act');
		}else {
			if(urlHash == 'undefined' && $( '.menu-item > a[href="#!/up"]' ).length > 0) {
				$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
			}
		}
	});


	jQuery( window ).on('resize', function() {
		set_sticky_header_height();
	});

	
	var $anchors = $( '.stripe' ),
		$menus = $( '.menu-item > a[href^="#!"]' );

	/*!-scroll to anchor*/
	window.clickAnchorLink = function( $a, e ) {
		var url = $a.attr( 'href' ),
			hash = url,
			$target = url.substring(3),
			base_speed  = 600,
			speed       = base_speed;
		
		set_sticky_header_height();

		if ( typeof $target != 'undefined' && $target && $target.length > 0 ) {
			location.hash = url;
			if($("#" + $target).length > 0) {
				var top = $("#" + $target).offset().top + 1,
					this_offset = $a.offset(),
					that_offset = $("#" + $target).offset(),
					offset_diff = Math.abs(that_offset.top - this_offset.top),
					speed = 150 * Math.log(offset_diff^2/1000 + 1.02);
				//	speed = 3400 * Math.log(offset_diff/8253 + 1.02);


					$newScrollPosition = top - floatMenuH;


					// targetPos = Math.abs( dtGlobals.winScrollTop + that_offset.top - this_offset.top );

				 //    distance = Math.abs( dtGlobals.winScrollTop - targetPos );
				 //    speed = ( distance / 1000 ) * 1000;
			};



			if($target == "up") {
				if($body.hasClass("overlay-navigation")){
					$.closeMobileHeader();
					$.closeSideHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: top - floatMenuH,
						duration: speed,
						mobileHA: false 
					});
				}else{
					$.closeMobileHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: 0,
						duration: speed,
						mobileHA: false,
						complete: function(elements) { $.closeSideHeader(); }
					});
				}
			}else {
				if($body.hasClass("overlay-navigation")){
					$.closeMobileHeader();
					$.closeSideHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: top - floatMenuH ,
						duration: speed,
						mobileHA: false,
						complete: function(elements) { 
							if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								if($(".sticky-mobile-header").length > 0){
									$newScrollPosition = ( top - $phantom.height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});

								}
							}else{
								if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists )){
									
									$newScrollPosition = ( top - $($headerBar, $phantom).height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});
								
								}
							}
						}
					});
				}else{
					$.closeMobileHeader();
					$moveBody.stop().velocity("scroll", { 
						offset: top - floatMenuH ,
						duration: speed,
						mobileHA: false,
						complete: function(elements) {
							$.closeSideHeader();

							if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								if($(".sticky-mobile-header").length > 0){
									$newScrollPosition = ( top - $phantom.height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});
								}
							}else{
								if((phantomStickyExists && !sideHeaderExists ) || (phantomStickyExists && sideHeaderHStrokeExists )){
									
									$newScrollPosition = ( top - $($headerBar, $phantom).height() );

									$moveBody.stop().velocity("scroll", { 
										offset: $newScrollPosition,
										duration: 650,
										mobileHA: false,
									});
								
								}
							}

						
						}
					});
				}
			};

			$('.menu-item a').parent("li").removeClass('act');
			$a.parent("li").addClass('act');
			e.preventDefault();
			return false;
		};

	};

	$body.on( 'click', '.anchor-link[href^="#!"], .anchor-link a[href^="#!"], .logo-box a[href^="#!"], .branding a[href^="#!"], #branding-bottom a[href^="#!"]', function( e ) {
		clickAnchorLink( $( this ), e );
	});

	$menus.on( 'click', function( e ) {
		clickAnchorLink( $( this ), e );
	});


	/*!-set active menu item on scroll*/
	//console.log($('.vc_row').attr('id').length)
	if(($('.one-page-row div[data-anchor^="#"]').length > 0 || $('.vc_row[id]').length > 0) && $(".one-page-row").length > 0){
		$window.scroll(function (e) {
			var currentNode = null;
			if(!$body.hasClass("is-scroll")){
				var currentNode;
				// $('.one-page-row div[data-anchor^="#"]').each(function(){
				// 	var $_this = $(this),
				// 		activeSection = $_this,
				// 		currentId = $_this.attr('data-anchor');
				// 	if(dtGlobals.winScrollTop >= ($(".one-page-row div[data-anchor='" + currentId + "']").offset().top - $phantom.height() - 1)){
				// 		currentNode = "#!/" + currentId.substring(1);
				// 	};
				// 	console.log(currentNode)
				// });
				//for vc row id
				$('.one-page-row .vc_row[id], .one-page-row div[data-anchor^="#"]').each(function(){
					var $_this = $(this),
						activeSection = $_this,
						currentId = $_this.attr('id');
						
					if(dtGlobals.winScrollTop >= ($(".one-page-row div[id='" + currentId + "']").offset().top - $phantom.height() - 1)){
						currentNode = "#!/" + currentId;
					};
				});

				


				

				if($(".one-page-row div[data-anchor^='#']").length > 0){
					if(dtGlobals.winScrollTop < ($(".one-page-row div[data-anchor^='#']").first().offset().top - $phantom.height())&& $( '.menu-item > a[href="#!/up"]' ).length > 0) {
						$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
					};
				}else if( $('.vc_row[id]').length > 0){
					//for vc row id
					if(dtGlobals.winScrollTop < ($('.one-page-row .vc_row[id]').first().offset().top - $phantom.height())&& $( '.menu-item > a[href="#!/up"]' ).length > 0) {
						$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
					};
				}
				$('.menu-item a[href^="#!"]').parent("li").removeClass('act');
				$('.menu-item a[href="'+currentNode+'"]').parent("li").addClass('act');

				
				if($('.menu-item a[href="#"]').length && currentNode == null){
					$('.menu-item a[href="#"]').parent("li").addClass('act');
				}
			};
		});
	};
// })

/* #Images Styling & Hovers
================================================== */
// jQuery(document).ready(function($) {

	/* !Append tag </i> to rolovers*/
	$.fn.addRollover = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			$this.append("<i></i>");
			if($this.find(".rollover-thumbnails").length){
				$this.addClass("rollover-thumbnails-on");
			}
			if($this.parent().find(".links-container").length){
				$this.addClass("rollover-buttons-on");
			}

			$this.addClass("this-ready");
		});
	};
	$(".rollover, .rollover-video, .post-rollover, .rollover-project .show-content, .vc-item .vc-inner > a").addRollover();

	/* !- Grayscale */
	$(".filter-grayscale .slider-masonry").on("mouseenter tap", function(e) {
		if(e.type == "tap") {
			e.stopPropagation();
		};
		$(this).addClass("dt-hovered");
	});

	$(".filter-grayscale .slider-masonry").on("mouseleave", function(e) {
		$(this).removeClass("dt-hovered");
	});


	/* #Hover layouts
	================================================== */

	/*!-Scale in hover*/
	$.fn.scaleInHover = function() {
		return this.each(function() {

			var $this = $(this);
			if ($this.hasClass("scale-ready")) {
				return;
			}
			var $img = $this.find("img.preload-me"),
				imgWidth = parseInt($img.attr('width')),
				imgHeight = parseInt($img.attr('height')),
				imgRatio = imgWidth/imgHeight;
			if(imgRatio < 2 && imgRatio >= 1.5){
				$this.addClass("ratio_3-2");
			}else if(imgRatio < 1.5 && imgRatio >= 1){
				$this.addClass("ratio_4-3");
			}else if(imgRatio < 1 && imgRatio >= 0.75){
				$this.addClass("ratio_3-4");
			}else if(imgRatio < 0.75 && imgRatio >= 0.6){
				$this.addClass("ratio_2-3");
			}else{
				$this.removeClass("ratio_2-3").removeClass("ratio_3-2").removeClass("ratio-2").removeClass("ratio_4-3").removeClass("ratio_3-4");
			};
			if(imgRatio >= 2){
				$this.addClass("ratio-2");
			};
			if(imgRatio == 1){
				$this.removeClass("ratio_2-3").removeClass("ratio-2").removeClass("ratio_3-2").removeClass("ratio_4-3").removeClass("ratio_3-4");
			};

			$this.addClass("scale-ready");
		});
	};
	$(".hover-scale .rollover-project").scaleInHover();
	/*TOUCH DEVICE*/
	/*!Description on hover show content on click(albums projects touch device)*/

	$.fn.touchNewHover = function() {
		return this.each(function() {
			var $this = $(this);
			if ($this.hasClass("this-ready")) {
				return;
			}

			if( $(".rollover-content", this).length > 0 || $(".woocom-rollover-content", this).length > 0){
				$body.on("touchend", function(e) {
					$(".mobile-true .rollover-content, .mobile-true .rollover-project, .mobile-true .woocom-rollover-content, .mobile-true .woocom-project").removeClass("is-clicked");
				});
				
				$this.on("touchstart", function(e) {
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
			
						if ($this.hasClass("is-clicked")) {
							if($this.find(".dt-gallery-container").length > 0){
								$this.find(".rollover-content").on("click.dtAlbums", function(e){
									$this.find(".rollover-content").off("click.dtAlbums");
									$(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-mfp-item").first().trigger('click');
								});
							}
							if($(this).find(".rollover-click-target.go-to").length > 0){
								window.location.href = $(this).find(".rollover-click-target.go-to").attr('href');
							}else if($(this).hasClass("woocom-project")){
								if ( $(e.target).is(".add_to_cart_button") ) {
									return true
								}else{
									window.location.href = $(this).find(" > a").attr('href');
								}
							}
						} else {

							$('.links-container > a', $this).on('touchend', function(e) {
								e.stopPropagation();
								$this.addClass("is-clicked");
							});
							e.preventDefault();
							$(".mobile-true .rollover-content, .mobile-true .rollover-project, .mobile-true .woocom-rollover-content, .mobile-true .woocom-project").removeClass("is-clicked");
							$this.addClass("is-clicked");
							$this.find(".rollover-content").addClass("is-clicked");
							$this.find(".woocom-rollover-content").addClass("is-clicked");
							return false;
						};
					};
				});
			};

			$this.addClass("this-ready");
		});
	};
	$(".mobile-true .rollover-project, .mobile-true .woocom-project").touchNewHover();

	/*Description on hover show content on click(albums projects touch device):end*/

	$(".hover-style-one article:not(.description-off) .rollover-project > a, .hover-style-two article:not(.description-off) .rollover-project > a, .mobile-true .cart-btn-on-img .buttons-on-img > a, .hover-style-three article:not(.description-off) .rollover-project > a").on("click", function(e){
		e.preventDefault();
	});
	$(".mobile-false .albums .rollover-content a:not(.portfolio-categories a), .mobile-false .media .rollover-content, .mobile-false .dt-gallery-container .rollover-content").on("click", function(e){
		if ( $(e.target).is("a") ) {return true};
		$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
	});
		

	$.fn.touchWooHoverImage = function() {
		return this.each(function() {
			var $img = $(this);
			if ($img.hasClass("woo-ready")) {
				return;
			}

			$body.on("touchend", function(e) {
				$(".mobile-true .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
			});
			var $this = $(this);
			$this.on("touchstart", function(e) { 
				origY = e.originalEvent.touches[0].pageY;
				origX = e.originalEvent.touches[0].pageX;
			});
			$this.on("touchend", function(e) {
				var touchEX = e.originalEvent.changedTouches[0].pageX,
					touchEY = e.originalEvent.changedTouches[0].pageY;
				if( origY == touchEY || origX == touchEX ){
					if ($this.hasClass("is-clicked")) {
						if($(e.target).parent().hasClass("woo-buttons")){								
							$(e.target).trigger('click');
						}else{
							window.location.href = $this.find("a").first().attr("href");
						}
					} else {

						// console.log($(e.target))
						e.preventDefault();
						$(".mobile-true .cart-btn-on-img .buttons-on-img").removeClass("is-clicked");
						$this.addClass("is-clicked");
						return false;
					};
				};
			});

			$img.addClass("woo-ready");
		});
	};
	$(".mobile-true .cart-btn-on-img .buttons-on-img").touchWooHoverImage();

	


/* #Comment form
================================================== */
// jQuery(document).ready(function($) {
	var $commentForm = $('#commentform');

	$commentForm.on('click', 'a.clear-form', function (e) {
		e.preventDefault();
		$commentForm.find('input[type="text"], textarea').val('');
		if($(".contact-form-material").length > 0){
			$commentForm.find('input[type="text"], textarea').parent().removeClass("is-focused");
		};
		return false;
	});

	$commentForm.on('click', ' a.dt-btn.dt-btn-m', function(e) {
		e.preventDefault();
		$commentForm.find('#submit').trigger('click');
		return false;
	});

	if ($.browser.msie) {
		$('input[type="text"][placeholder], textarea[placeholder]').each(function () {
			var obj = $(this);

			if (obj.attr('placeholder') != '') {
				obj.addClass('IePlaceHolder');

				if ($.trim(obj.val()) == '' && obj.attr('type') != 'password') {
					obj.val(obj.attr('placeholder'));
				}
			}
		});

		$('.IePlaceHolder').focus(function () {
			var obj = $(this);
			if (obj.val() == obj.attr('placeholder')) {
				obj.val('');
			}
		});

		$('.IePlaceHolder').blur(function () {
			var obj = $(this);
			if ($.trim(obj.val()) == '') {
				obj.val(obj.attr('placeholder'));
			}
		});
	}

	if($(".contact-form-material").length > 0){
		/*!- Material design form*/

		$(".form-fields input, textarea, .comment-form-author input, .comment-form-email input").each(function(c){
			var $this = $(this),
				$parent = $this.parent("span, p"),
				$bigParent = $this.parents(".dt-form");
			
			$bigParent.find( '.clear-form' ).on( 'click' ,function( ) {
				$parent.removeClass("is-focused").removeClass("active");
			} );
			$this.focus(function() {
				$parent.addClass("is-focused").addClass("active");
				$this.attr('placeholder','');
			});
			
			$this.change(function() {
				if(0 !== $this.val().length){
					$parent.addClass("is-focused").removeClass("active");
					$this.attr('placeholder','');
				}
			});

			$this.blur(function() {
				$parent.removeClass("active");
				if('' === $this.val()){
					$parent.removeClass("is-focused").removeClass("active");
				}
			});
		});
	}
// });


/* #Fullwidth row for shortcodes & templates
================================================== */
// jQuery(document).ready(function($) {
	function fullWidthWrap(){
		if( $(".full-width-wrap").length > 0 ){
			$(".full-width-wrap").each(function(){
				var $_this = $(this),
					windowInnerW = window.innerWidth,
					windowW = $window.width(),
					contentW = $('.content').width();

					var $offset_fs,
						$width_fs;
				 
					if ($('.boxed').length > 0) {
						$offset_fs = ((parseInt($('#main').width()) - parseInt(contentW)) / 2);
					}
					else if ($('.side-header-v-stroke').length && windowInnerW > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowInnerW <= parseInt(contentW)) ? parseInt(contentW) : (windowW - $('.side-header-v-stroke').width());
						$offset_fs = Math.ceil( (($windowWidth - parseInt(contentW)) / 2) );
					}
					else if ($('.sticky-header .side-header').length && windowInnerW > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowW <= parseInt(contentW)) ? parseInt(contentW) : windowW;
						$offset_fs = Math.ceil( ((windowW - parseInt(contentW)) / 2) );
					}
					else if (($('.header-side-left').length && windowInnerW || $('.header-side-right').length && windowInnerW ) > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowInnerW <= parseInt(contentW)) ? parseInt(contentW) : (windowW - $('.side-header').width());
						$offset_fs = Math.ceil( (($windowWidth - parseInt(contentW)) / 2) );
					}
					else {
						var $windowWidth = (windowW <= parseInt(contentW)) ? parseInt(contentW) : windowW;
						$offset_fs = Math.ceil( ((windowW - parseInt(contentW)) / 2) );
					};

					if($('.sidebar-left').length > 0 || $('.sidebar-right').length > 0){
						$width_fs = $(".content").width();
						$offset_fs = 0;
					}else{
						$width_fs = $("#main").innerWidth();
					}

					$_this.css({
						width: $width_fs,
						"margin-left": -$offset_fs,
						"opacity": 1
					});
					$_this.find(".full-width-wrap").css({
						width: "",
						"margin-left": "",
						"opacity": 1,
						"padding-left": $offset_fs
					});
					$_this.find(".ts-wrap").each(function(){
						var scroller = $(this).data("thePhotoSlider");
						if(typeof scroller!= "undefined"){
							scroller.update();
						};
					});
					
			});
		};
	};

	if( $(".full-width-wrap").length > 0 ){
		if(dtGlobals.isiOS){
			$window.bind("orientationchange", function() {
				fullWidthWrap();
			}).trigger( "orientationchange" );
		}
		else {
			$window.on("resize", function(){
				fullWidthWrap();
			});
			fullWidthWrap();
		};
	};
	//Rewrite vc functions for row behavior (fix issue with vc full-with row and box layout/side header)
	window.vc_rowBehaviour = function() {
	    function fullWidthRow() {
	        var $elements = $('[data-vc-full-width="true"]');
	        $.each($elements, function(key, item) {
	            var $el = $(this);
	            $el.addClass("vc_hidden");
	            var $el_full = $el.next(".vc_row-full-width");
	            $el_full.length || ($el_full = $el.parent().next(".vc_row-full-width"));
	            var el_margin_left = parseInt($el.css("margin-left"), 10)
	              , el_margin_right = parseInt($el.css("margin-right"), 10)
	              , offset = 0 - $el_full.offset().left - el_margin_left
	              , width = $(window).width();


	             var 
					windowInnerW = window.innerWidth,
					windowW = $window.width(),
					contentW = $('.content').width();

					var $offset_fs,
						$width_fs;
				 
					if ($('.boxed').length > 0) {
						$offset_fs = ((parseInt($('#main').width()) - parseInt(contentW)) / 2);
					}
					else if ($('.side-header-v-stroke').length && windowInnerW > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowInnerW <= parseInt(contentW)) ? parseInt(contentW) : (windowW - $('.side-header-v-stroke').width());
						$offset_fs = Math.ceil( (($windowWidth - parseInt(contentW)) / 2) );
					}
					else if ($('.sticky-header .side-header').length && windowInnerW > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowW <= parseInt(contentW)) ? parseInt(contentW) : windowW;
						$offset_fs = Math.ceil( ((windowW - parseInt(contentW)) / 2) );
					}
					else if (($('.header-side-left').length && windowInnerW || $('.header-side-right').length && windowInnerW ) > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
						var $windowWidth = (windowInnerW <= parseInt(contentW)) ? parseInt(contentW) : (windowW - $('.side-header').width());
						$offset_fs = Math.ceil( (($windowWidth - parseInt(contentW)) / 2) );
					}
					else {
						var $windowWidth = (windowW <= parseInt(contentW)) ? parseInt(contentW) : windowW;
						$offset_fs = Math.ceil( ((windowW - parseInt(contentW)) / 2) );
					};

					if($('.sidebar-left').length > 0 || $('.sidebar-right').length > 0){
						$width_fs = $(".content").width();
						$offset_fs = 0;
					}else{
						$width_fs = $("#main").innerWidth();
					}
					var offset = 0 - $offset_fs - el_margin_left


	            if ($el.css({
	                position: "relative",
	                left: offset,
	                "box-sizing": "border-box",
	                width: $width_fs
	            }),
	            !$el.data("vcStretchContent")) {
	                var padding = -1 * offset;
	                0 > padding && (padding = 0);
	                var paddingRight = $width_fs - padding - $el_full.width() + el_margin_left + el_margin_right;
	                0 > paddingRight && (paddingRight = 0),
	                $el.css({
	                    "padding-left": padding + "px",
	                    "padding-right": paddingRight + "px"
	                })
	            }
	            $el.attr("data-vc-full-width-init", "true"),
	            $el.removeClass("vc_hidden");
	            //Fix dt-scroller inside fullwidth vc row
	            $el.find(".ts-wrap").each(function(){
					var scroller = $(this).data("thePhotoSlider");
					if(typeof scroller!= "undefined"){
						scroller.update();
					};
				});
	        })
	    }
	   
	    function parallaxRow() {
	        var vcSkrollrOptions, callSkrollInit = !1;
	        return window.vcParallaxSkroll && window.vcParallaxSkroll.destroy(),
	        $(".vc_parallax-inner").remove(),
	        $("[data-5p-top-bottom]").removeAttr("data-5p-top-bottom data-30p-top-bottom"),
	        $("[data-vc-parallax]").each(function() {
	            var skrollrSpeed, skrollrSize, skrollrStart, skrollrEnd, $parallaxElement, parallaxImage, youtubeId;
	            callSkrollInit = !0,
	            "on" === $(this).data("vcParallaxOFade") && $(this).children().attr("data-5p-top-bottom", "opacity:0;").attr("data-30p-top-bottom", "opacity:1;"),
	            skrollrSize = 100 * $(this).data("vcParallax"),
	            $parallaxElement = $("<div />").addClass("vc_parallax-inner").appendTo($(this)),
	            $parallaxElement.height(skrollrSize + "%"),
	            parallaxImage = $(this).data("vcParallaxImage"),
	            youtubeId = vcExtractYoutubeId(parallaxImage),
	            youtubeId ? insertYoutubeVideoAsBackground($parallaxElement, youtubeId) : "undefined" != typeof parallaxImage && $parallaxElement.css("background-image", "url(" + parallaxImage + ")"),
	            skrollrSpeed = skrollrSize - 100,
	            skrollrStart = -skrollrSpeed,
	            skrollrEnd = 0,
	            $parallaxElement.attr("data-bottom-top", "top: " + skrollrStart + "%;").attr("data-top-bottom", "top: " + skrollrEnd + "%;")
	        }),
	        callSkrollInit && window.skrollr ? (vcSkrollrOptions = {
	            forceHeight: !1,
	            smoothScrolling: !1,
	            mobileCheck: function() {
	                return !1
	            }
	        },
	        window.vcParallaxSkroll = skrollr.init(vcSkrollrOptions),
	        window.vcParallaxSkroll) : !1
	    }
	    function fullHeightRow() {
	        $(".vc_row-o-full-height:first").each(function() {
	            var $window, windowHeight, offsetTop, fullHeight;
	            $window = $(window),
	            windowHeight = $window.height(),
	            offsetTop = $(this).offset().top,
	            windowHeight > offsetTop && (fullHeight = 100 - offsetTop / (windowHeight / 100),
	            $(this).css("min-height", fullHeight + "vh"))
	        })
	    }
	    function fixIeFlexbox() {
	        var ua = window.navigator.userAgent
	          , msie = ua.indexOf("MSIE ");
	        (msie > 0 || navigator.userAgent.match(/Trident.*rv\:11\./)) && $(".vc_row-o-full-height").each(function() {
	            "flex" === $(this).css("display") && $(this).wrap('<div class="vc_ie-flexbox-fixer"></div>')
	        })
	    }
	    var $ = window.jQuery;
	    $(window).off("resize.vcRowBehaviour").on("resize.vcRowBehaviour", fullWidthRow).on("resize.vcRowBehaviour", fullHeightRow),
	    fullWidthRow(),
	    fullHeightRow(),
	    fixIeFlexbox(),
	    vc_initVideoBackgrounds(),
	    parallaxRow()

	}
	 // vc_rowBehaviour()
// })


$window.trigger("dt.removeLoading");
/* #Misc
================================================== */

	/*--Prevent default dragstart event on images*/
	$("img").on("dragstart", function(event) { event.preventDefault(); });
	var $mainSlideshow = $("#main-slideshow");
	if(!$mainSlideshow.find("> div").length > 0){
		$mainSlideshow.addClass("empty-slider");
	};
	/*!-Revolution slider*/
	if ($(".rev_slider_wrapper").length > 0){

		//$("#main-slideshow").each(function(){
		//	var $this = $(this);
			if( $mainSlideshow.find("> .rev_slider_wrapper")){
				$mainSlideshow.addClass("fix rv-slider");
			};
			if ($(".rev_slider_wrapper").hasClass("fullscreen-container") || $(".rev_slider_wrapper").hasClass("fullwidthbanner-container")){
				$mainSlideshow.removeClass("fix");
			};
		//});
	};

	/* #Header elements
	================================================== */

		/*!Shopping cart top bar*/
		var cartTimeoutShow,
			cartTimeoutHide;
		$(".shopping-cart.show-sub-cart").find(".buttons").first().clone(true).addClass("top-position").insertBefore(".shopping-cart-inner .cart_list");
		$(".shopping-cart.show-sub-cart").each(function(){
			var $this = $(this),
				$dropCart = $this.children('.shopping-cart-wrap');

			if(dtGlobals.isMobile || dtGlobals.isWindowsPhone){
				$this.find("> a").on("click", function(e) {
					if (!$(this).hasClass("dt-clicked")) {
						e.preventDefault();
						$(".shopping-cart").find(".dt-clicked").removeClass("dt-clicked");
						$(this).addClass("dt-clicked");
					} else {
						e.stopPropagation();
					}

				});
			};
			
			$this.on("mouseenter tap", function(e) {
				if(e.type == "tap") e.stopPropagation();

				$this.addClass("dt-hovered");
				if ($page.width() - ($dropCart.offset().left - $page.offset().left) - $dropCart.width() < 0) {
					$dropCart.addClass("right-overflow");
				};
				/*Bottom overflow menu*/
				if ($window.height() - ($dropCart.offset().top - dtGlobals.winScrollTop) - $dropCart.innerHeight() < 0) {
					$dropCart.addClass("bottom-overflow");
				};
				if($this.parents(".dt-mobile-header").length > 0) {
					$dropCart.css({
						top: $this.position().top - 13 - $dropCart.height()
					});
				};
				/*move button to top if cart height is bigger then window*/
				if ($dropCart.height()  > ($window.height() - $dropCart.position().top)) {
					$dropCart.addClass("show-top-buttons");
				};

				/*hide search*/
				$(".searchform .submit", $header).removeClass("act");
				$(".mini-search").removeClass("act");
				//$(".mini-search .field", $header).fadeOut(100);
				$(".mini-search .field", $header).stop().animate({
					"opacity": 0
				}, 150, function() {
					$(this).css("visibility", "hidden");
				});

				clearTimeout(cartTimeoutShow);
				clearTimeout(cartTimeoutHide);

				cartTimeoutShow = setTimeout(function() {
					if($this.hasClass("dt-hovered")){
						$dropCart.stop().css("visibility", "visible").animate({
							"opacity": 1
						}, 150);
					}
				}, 100);
			});

			$this.on("mouseleave", function(e) {
				var $this = $(this),
				$dropCart = $this.children('.shopping-cart-wrap');
				$this.removeClass("dt-hovered");

				clearTimeout(cartTimeoutShow);
				clearTimeout(cartTimeoutHide);

				cartTimeoutHide = setTimeout(function() {
					if(!$this.hasClass("dt-hovered")){
						$dropCart.stop().animate({
							"opacity": 0
						}, 150, function() {
							$(this).css("visibility", "hidden");
						});
						setTimeout(function() {
							if(!$this.hasClass("dt-hovered")){
								$dropCart.removeClass("right-overflow");
								$dropCart.removeClass("bottom-overflow");
								/*move button to top if cart height is bigger then window*/
								
								$dropCart.removeClass("show-top-buttons");
								
							}
						}, 400);
					}
				}, 150);

			});
		});


		/*!-Search*/
		if($(".mini-search").length > 0){
			var $header = $(".masthead, .dt-mobile-header");

			$body.on("click", function(e){
				var target = $(e.target);
				if(!target.is(".mini-search .field", $header)) {
					$(".searchform .submit", $header).removeClass("act");
					$(".mini-search", $header).removeClass("act");
					//$(".mini-search .field", $header).fadeOut(100);
					$(".mini-search .field", $header).stop().animate({
						"opacity": 0
					}, 150, function() {
						$(this).css("visibility", "hidden");
					});
					setTimeout(function() {
						$(".mini-search .field", $header).removeClass("right-overflow");
						$(".mini-search .field", $header).removeClass("bottom-overflow");
					}, 400);
				}
			})
			$(".searchform .submit", $header).on("click", function(e){
				e.preventDefault();
				e.stopPropagation();
				var $_this = $(this);
				if($_this.hasClass("act")){
					$_this.removeClass("act");
					$_this.parents(".mini-search").removeClass("act");
					//$_this.siblings(".searchform-s").fadeOut(200);
					$_this.siblings(".searchform-s").stop().animate({
						"opacity": 0
					}, 150, function() {
						$(this).css("visibility", "hidden");
					});
					setTimeout(function() {						
						$_this.siblings(".searchform-s").removeClass("right-overflow");	
						$_this.siblings(".searchform-s").removeClass("bottom-overflow");						
					}, 400);
				}else{
					$_this.addClass("act");
					$_this.parents(".mini-search").addClass("act");
					if($_this.parents(".dt-mobile-header").length > 0) {
						$_this.siblings(".searchform-s").css({
							top: $_this.parents(".mini-search").position().top  - $_this.siblings(".searchform-s").height() - 18
						});

					}
					if ($page.width() - ($_this.siblings(".searchform-s").offset().left - $page.offset().left) - $_this.siblings(".searchform-s").width() < 0) {
						$_this.siblings(".searchform-s").addClass("right-overflow");
					};
					
					/*Bottom overflow menu*/
					if ($window.height() - ($_this.siblings(".searchform-s").offset().top - dtGlobals.winScrollTop) - $_this.siblings(".searchform-s").innerHeight() < 0) {
						$_this.siblings(".searchform-s").addClass("bottom-overflow");
					};
					$_this.siblings(".searchform-s").stop().css("visibility", "visible").animate({
						"opacity": 1
					}, 150).focus();
					
					//$_this.siblings(".searchform-s").fadeIn(250);
				}
			});
		};


	/* #Shortcodes
	================================================== */


		/*!-Before After*/
		$(".twentytwenty-container .preload-me").loaded(null, function() {
			$(".twentytwenty-container").each(function(){
				var $this = $(this),
					$thisOrient = $this.attr("data-orientation").length > 0 ? $this.attr("data-orientation") : 'horizontal',
					$pctOffset = (typeof $this.attr("data-offset") != 'undefined' && $this.attr("data-offset").length > 0) ? $this.attr("data-offset") : 0.5,
					$navigationType = $this.attr("data-navigation") ? true : false;
				$this.twentytwenty({
					default_offset_pct: $pctOffset,
					orientation: $thisOrient,
					navigation_follow: $navigationType
				});
			});
		}, true);

		/*!-Isotope fix for tabs*/
		if($('.wpb_tabs .iso-container').length > 0){
			var tabResizeTimeout;
			$('.wpb_tour_tabs_wrapper').each(function(){
				var $this = $(this),
					isoInside = $this.parents(".wpb_tabs").find(".iso-container");
				$this.tabs( {
					activate: function( event, ui ) {
						isoInside.isotope("layout");
					}
				});
				$this.find("li").each(function(){
					$(this).on("click", function(){
						clearTimeout(tabResizeTimeout);
						$window.trigger( "debouncedresize" );
						$(this).parents(".wpb_tabs").find(".iso-container").isotope("layout");
					});
				});
			});
		}
		/*!-tabs style four: click effect*/
		$(".tab-style-four .wpb_tabs_nav a").each(function(){
			var $this = $(this);
			$this.addClass("ripple");
			$this.ripple();
		});


	/* #Widgets
	================================================== */


		// /*!Instagram style photos*/

		$.fn.calcPics = function() {
				var $collection = $(".instagram-photos");
				if ($collection.length < 1) return false;

				return this.each(function() {
					var maxitemwidth = maxitemwidth ? maxitemwidth : parseInt($(this).attr("data-image-max-width")),
						itemmarg = parseInt($(this).find("> a").css("margin-left"));
					$(this).find(" > a").css({
						"max-width": maxitemwidth,
						"opacity": 1
					});

					// Cahce everything
					var $container = $(this),
						containerwidth = $container.width(),
						itemperc = (100/(Math.ceil(containerwidth/maxitemwidth)));
				
					$container.find("a").css({ "width": itemperc+'%' });
			});
		};
		$(".instagram-photos").calcPics();

		/* !- Accordion Tooltip */
		// $(".st-accordion").dtAccordion({
		// 	open: 0,
		// 	oneOpenedItem: true
		// });

		$('.st-accordion').each(function(){
			var accordion = $(this);
			accordion.find('ul > li > a').on("click", function(e){
				e.preventDefault();
				var $this = $(this),
					$thisNext = $this.next();
				$(".st-content", accordion).not($thisNext).slideUp('fast');
				$thisNext.slideToggle('fast');
			});
		});
		simple_tooltip(".shortcode-tooltip","shortcode-tooltip-content");

		/*!-search widget*/
		$('.widget .searchform .submit').on('click', function(e) {
			e.preventDefault();
			$(this).siblings('input.searchsubmit').click();
			return false;
		});

		// !- Skills
		$.fn.animateSkills = function() {
			$(".skill-value", this).each(function () {
				var $this = $(this),
					$this_data = $this.data("width");

				$this.css({
					width: $this_data + '%'
				});
			});
		};
		$.fn.animateSkills = function() {
			$(".skill-value", this).each(function () {
				var $this = $(this),
					$this_data = $this.data("width");

				$this.css({
					width: $this_data + '%'
				});
			});
		};

		// !- Animation "onScroll" loop
		function doSkillsAnimation() {
			
			if(dtGlobals.isMobile){
				$(".skills").animateSkills();
			}
		};
		// !- Fire animation
		doSkillsAnimation();


	/* #Posts
	================================================== */
		var socTimeoutShow,
			socTimeoutHide;

		/*!-Show share buttons*/
		$(".project-share-overlay.allways-visible-icons .share-button").on("click", function(e){
			e.preventDefault();
		});
		//Solve multiple window.onload conflict
		function addOnloadEvent(fnc){
		  if ( typeof window.addEventListener != "undefined" )
		    window.addEventListener( "load", fnc, false );
		  else if ( typeof window.attachEvent != "undefined" ) {
		    window.attachEvent( "onload", fnc );
		  }
		  else {
		    if ( window.onload != null ) {
		      var oldOnload = window.onload;
		      window.onload = function ( e ) {
		        oldOnload( e );
		        window[fnc]();
		      };
		    }
		    else 
		      window.onload = fnc;
		  }
		}
		function showShareBut() {
			$(".album-share-overlay, .project-share-overlay:not(.allways-visible-icons)").each(function(){
				var $this = $(this);
				$this.find(".share-button").on("click", function(e){
					e.preventDefault();
				});

				$this.on("mouseover tap", function(e) {
					if(e.type == "tap") e.stopPropagation();

					var $this = $(this);
					$this.addClass("dt-hovered");

					clearTimeout(socTimeoutShow);
					clearTimeout(socTimeoutHide);

					socTimeoutShow = setTimeout(function() {
						if($this.hasClass("dt-hovered")){
							$this.find('.soc-ico a').css("display", "inline-block");
							$this.find('.soc-ico').stop().css("visibility", "visible").animate({
								"opacity": 1
							}, 200);
						}
					}, 100);
				});

				$this.on("mouseleave ", function(e) {
					var $this = $(this);
					$this.removeClass("dt-hovered");

					clearTimeout(socTimeoutShow);
					clearTimeout(socTimeoutHide);

					socTimeoutHide = setTimeout(function() {
						if(!$this.hasClass("dt-hovered")){
							$this.find('.soc-ico').stop().animate({
								"opacity": 0
							}, 150, function() {
								$this.find('.soc-ico a').css("display", "none");
								$(this).css("visibility", "hidden");
							});
						}
					}, 50);

				});
			});
		};
		addOnloadEvent(function(){ showShareBut() });

	/*!-Project floating content*/
	var $floatContent = $(".floating-content"),
		projectPost = $(".project-post");
	var $parentHeight,
		$floatContentHeight,
		phantomHeight = 0;

	//var $scrollHeight;

	function setFloatinProjectContent() {
		$(".project-slider .preload-me").loaded(null, function() {
			var $sidebar = $(".floating-content");
			if ($(".floating-content").length > 0) {
				var offset = $sidebar.offset();
				if($(".top-bar").length > 0 && $(".phantom-sticky").length > 0){
					var topBarH = $(".top-bar").height();
				}else{
					var topBarH = 0;
				}
					//$scrollHeight = $(".project-post").height();
				var $scrollOffset = $(".project-post").offset();
				//var $headerHeight = $phantom.height();
				$window.on("scroll", function () {
					if (window.innerWidth > 1050) {
						if (dtGlobals.winScrollTop + $phantom.height() > offset.top) {
							if (dtGlobals.winScrollTop + $phantom.height() + $floatContentHeight + 40 < $scrollOffset.top + $parentHeight) {
								$sidebar.stop().velocity({
									translateY : dtGlobals.winScrollTop - offset.top + $phantom.height() + 5 - topBarH
								}, 300);
							} else {
								$sidebar.stop().velocity({
									translateY: $parentHeight - $floatContentHeight - 40 - topBarH
								}, 300)
							}
						} else {
							$sidebar.stop().velocity({
								translateY: 0
							}, 300)
						}
					} else {
						$sidebar
							.css({
								"transform": "translateY(0)",
								"-webkit-transform" : "translateY(0)",
							});
					}
				})
			}
		}, true);
	}
	setFloatinProjectContent();
	/* !Fancy header*/
	var fancyFeaderOverlap = $(".transparent #fancy-header").exists(),
		titleOverlap = $(".transparent .page-title").exists();


	$.fancyFeaderCalc = function() {
		$(".branding .preload-me").loaded(null, function() {
			if (fancyFeaderOverlap) {
				$(".transparent #fancy-header > .wf-wrap").css({
					"padding-top" : $(".masthead:not(.side-header)").height()
				});
			};
			if (titleOverlap) {
				$(".transparent .page-title > .wf-wrap").css({
					"padding-top" : $(".masthead:not(.side-header)").height()
				});
				$(".transparent .page-title").css("visibility", "visible");
			};
		}, true);
	};


	/*!-Paginator*/
	var $paginator = $('.paginator[role="navigation"]'),
		$dots = $paginator.find('a.dots');
	$dots.on('click', function() {
		$paginator.find('div:hidden').show().find('a').unwrap();
		$dots.remove();
	});

	// pin it
	$(".soc-ico a.pinit-marklet").click(function(event){
		event.preventDefault();
		$("#pinmarklet").remove();
		var e = document.createElement('script');
		e.setAttribute('type','text/javascript');
		e.setAttribute('charset','UTF-8');
		e.setAttribute('id','pinmarklet');
		e.setAttribute('async','async');
		e.setAttribute('defer','defer');
		e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e);
	});

	/*!-Scroll to Top*/
	$window.on("debouncedresize", function() {
		if(window.innerWidth  > dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
			if($(".masthead:not(.side-header):not(.mixed-header)").length > 0){
				dtGlobals.showTopBtn = $(".masthead:not(.side-header):not(.mixed-header)").height() + 150;
			}else if($(".masthead.side-header-h-stroke").length > 0){
				dtGlobals.showTopBtn = $(".side-header-h-stroke").height() + 150;
			}else{
				dtGlobals.showTopBtn = 500;
			}
		}else{
			if($(".masthead:not(.mixed-header)").length > 0){
				dtGlobals.showTopBtn = $(".masthead:not(.mixed-header)").height() + 150;
			}else if($(".masthead.mixed-header").length > 0){
				dtGlobals.showTopBtn = $(".mixed-header").height() + 150;
			}else{
				dtGlobals.showTopBtn = 500;
			}
		}
	});
	$window.scroll(function () {
		
		if (dtGlobals.winScrollTop > dtGlobals.showTopBtn) {
			$('.scroll-top').removeClass('off').addClass('on');
		}
		else {
			$('.scroll-top').removeClass('on').addClass('off');
		}
	});
	$(".scroll-top").click(function(e) {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});

	

	/*!-Custom select*/

	// Create the dropdown base
	$("<select />").prependTo("#bottom-bar .mini-nav .menu-select");

	// Create default option "Select"
	$("<option />", {
		"selected"  :  "selected",
		"value"     :  "",
		"text"      :  "———"
	}).appendTo(".mini-nav .menu-select select");

	// Populate dropdown with menu items
	$("#bottom-bar .mini-nav").each(function() {
		var elPar = $(this),
			thisSelect = elPar.find("select");
		$("a", elPar).each(function() {
			var el = $(this);
			$("<option />", {
				"value"   : el.attr("href"),
				"text"    : el.text(),
				"data-level": el.attr("data-level")
			}).appendTo(thisSelect);
		});
	});

	$(".mini-nav select").change(function() {
		window.location = $(this).find("option:selected").val();
	});
	$(".mini-nav select option").each(function(){
		var $this = $(this),
			winHref = window.location.href;
		 if($this.attr('value') == winHref){
			$this.attr('selected','selected');
		};
	})
	/*!-Appearance for custom select*/
	$('.woocommerce.widget_layered_nav select, .woocommerce-ordering-div select, #bottom-bar .mini-nav select, .widget_product_categories select').each(function(){
		$(this).customSelect();
	});
	$(".menu-select select, .mini-nav .customSelect1, .vc_pie_chart .vc_pie_wrapper").css("visibility", "visible");

	$(".mini-nav option").each(function(){
		var $this	= $(this),
			text	= $this.text(),

			prefix	= "";

		switch ( parseInt($this.attr("data-level"))) {
			case 1:
				prefix = "";
			break;
			case 2:
				prefix = "— ";
			break;
			case 3:
				prefix = "—— ";
			break;
			case 4:
				prefix = "——— ";
			break;
			case 5:
				prefix = "———— ";
			break;
		}
		$this.text(prefix+text);
	});

	/*!-Material click for menu and buttons*/
	var ua = navigator.userAgent,
		event = (ua.match(/iPhone/i)) ? "touchstart" : "click";

	$(".project-navigation a, .mobile-sticky-header-overlay").bind(event, function(e) {});
	$(".menu-material-style > li > a, .menu-material-style .sub-nav > ul > li > a, .menu-material-underline-style > li > a, .menu-material-underline-style .sub-nav > ul > li > a").each(function(){
		var $this = $(this);
		$this.addClass("ripple");
		$this.ripple();
	});

	$.fn.clickEffectPics = function() {

		return this.each(function() {
			$this = $(this);
			if($(".click-effect-on-img").length > 0){
				$this.addClass("material-click-effect");
			}
		});
	};
	$(".rollover, .post-rollover, .rollover-video").clickEffectPics();

	

	$(function(){
		$.fn.clickMaterialEffect = function() {
			return this.each(function() {
				var ink, d, x, y;
				var $this = $(this),
			        $this_timer = null,
			         $link_timer = null;
				if($this.find(".ink").length === 0){
					$this.prepend("<span class='ink'></span>");
				}
				
				$this.addClass("ripplelink");

				ink = $this.find(".ink");
				ink.removeClass("animate");

				if(!ink.height() && !ink.width()){
					d = Math.max($(this).outerWidth(), $this.outerHeight());
					ink.css({height: d, width: d});
				}
				
				$this.bind( 'mousedown', function( e ) {
					clearTimeout( $this_timer );
					x = e.pageX - $this.offset().left - ink.width()/2;
					y = e.pageY - $this.offset().top - ink.height()/2;

						ink.css({top: y+'px', left: x+'px'}).addClass("animate");

				} );
				$this.bind( 'mouseup mouseleave', function( e ) {
					clearTimeout( $link_timer );
					clearTimeout( $this_timer );
					$this._timer = setTimeout( function() {
						ink.removeClass("animate");
					},400)
				} );
				
			});
		};

		$(".rollover.material-click-effect, .post-rollover.material-click-effect, .rollover-video.material-click-effect").clickMaterialEffect();
	});
	/*!-Material design clickeffect*/
	if($(".small-portfolio-icons").length > 0){

		$('.links-container a').each(function(){
			var $this = $(this);
			$this.addClass("waves-effect");
		});
		Waves.displayEffect();
	}
	
	if($(".filter").length > 0){

		// $(".filter-categories a, .paginator .page-links a").each(function(){
		// 	var $this = $(this);
		// 	$this.addClass("ripple");
		// 	$this.ripple();
		// });
		$(".filter-switch").append("<span class='filter-switch-toggle'></span>");

		// $('.paginator .page-nav a').each(function(){
		// 	var $this = $(this);
		// 	$this.addClass("waves-effect");
		// });
		// Waves.displayEffect();

		//$(".filter-switch").append('<input class="tgl" type="checkbox">');
		if (Modernizr.touch) {
			$('.filter-switch').on('touchstart',function(e) {
				$('.filter-switch').removeClass("pressed")
				$(this).addClass('pressed');
			});
		} else {
			$('.filter-switch').on('mousedown',function(e) {
				$('.filter-switch').removeClass("pressed")
				$(this).addClass('pressed');
				setTimeout(function(){
					$(this).removeClass('pressed');
				},600);
			});
		}
		$('.filter-switch .filter-switch-toggle').on('animationend webkitAnimationEnd oanimationend MSAnimationEnd', function(e) {
			$(this).parent().removeClass('pressed');
		});
		if (Modernizr.touch) {
			$('.filter-extras a').on('touchstart',function(e) {
				$('.filter-extras').removeClass("pressed")
				$(this).parent(".filter-extras").addClass('pressed');
			});
		} else {
			$('.filter-extras a').each(function(){
				$(this).on('mousedown',function(e) {
					$('.filter-extras').removeClass("pressed")
					$(this).addClass('pressed');
					setTimeout(function(){
						$(this).removeClass('pressed');
					},600);
				});
			});
		}
		$('.filter-extras a').on('animationend webkitAnimationEnd oanimationend MSAnimationEnd', function(e) {
			$(this).removeClass('pressed');
		});
		

	};

	// Prevent a backgroung rendering glitch in Webkit.
	// if (!window.bgGlitchFixed && $.browser.webkit) {
	// 	setTimeout(function(){
	// 		$window.scrollTop(dtGlobals.winScrollTop + 1);
	// 		window.bgGlitchFixed = true;
	// 	},10)
	// }

	var waitForFinalEvent = (function () {
		var timers = {};
		return function (callback, ms, uniqueId) {
			if (!uniqueId) {
				uniqueId = "Don't call this twice without a uniqueId";
			}
			if (timers[uniqueId]) {
				clearTimeout (timers[uniqueId]);
			}
			timers[uniqueId] = setTimeout(callback, ms);
		};
	})();


	/* #Misc(desctop only)
	================================================== */
	
		
	if(!dtGlobals.isMobile){
		//setTimeout(function(){
			/*!-parallax initialisation*/
			$('.stripe-parallax-bg, .fancy-parallax-bg, .page-title-parallax-bg').each(function(){
				var $_this = $(this),
					speed_prl = $_this.data("prlx-speed");
				$_this.parallax("50%", speed_prl);
				$_this.addClass("parallax-bg-done");
				$_this.css("opacity", "1")
			});
		//}, 600)
	

		/*!-Animate fancy header elements*/
		var j = -1;
		$("#fancy-header .fancy-title:not(.start-animation), #fancy-header .fancy-subtitle:not(.start-animation), #fancy-header .breadcrumbs:not(.start-animation)").each(function () {
			var $this = $(this);
			var animateTimeout;
			if (!$this.hasClass("start-animation") && !$this.hasClass("start-animation-done")) {
				$this.addClass("start-animation-done");
				j++;
				setTimeout(function () {
					$this.addClass("start-animation");
					
				}, 300 * j);
			};
		});

		$("video.stripe-video-bg:in-viewport").each(function() {
			var $thisPar = $(this).parent(".stripe"),
				$video = $thisPar.find("video");

			if ( $video.length > 0 ) {
				$video.get(0).play();
			}
		});
		$window.on("scroll", function () {
			if($("video.stripe-video-bg").length > 0){
				$("video.stripe-video-bg").each(function(){
					//var stripeVideo = $("video.stripe-video-bg");
					// stripeVideo.each(function() {
						var $video = $(this);

						//if ( $video.length > 0 ) {

						if ( $video.is(':in-viewport') ) {

							$video.get(0).play();
						} else {

							$video.get(0).pause();
						}
						//}
					//});
				})
			}
		});

	};

	/* #Footer
	================================================== */

		/*!-Overlap Footer*/
		$(".footer-overlap .footer").css({
			'opacity': 1
		});

		/*Move side header out of page-inner (bug with sticky footer)*/

		//Commented new dev header
		// if($(".page-inner").length > 0 && $(".side-header").length > 0 || $(".page-inner").length > 0 && $(".dt-mobile-header").length > 0){
		// 	$(".side-header, .mixed-header, .mobile-header-scrollbar-wrap, .dt-close-mobile-menu-icon").insertBefore(".page-inner");
		// };
		if($(".page-inner").length > 0 && $(".side-header").length > 0 || $(".page-inner").length > 0 && $(".dt-mobile-header").length > 0){
			$(".side-header, .mixed-header, .dt-mobile-header, .dt-close-mobile-menu-icon").insertBefore(".page-inner");
		};

		/*Adding class if footer is empty*/
		if(!$(".footer .widget").length > 0) {
			$(".footer").addClass("empty-footer");
		};







/* #Masonry
================================================== */
// jQuery(document).ready(function($) {
	// var $html = $("html"),
	// 	$body = $("body");
	// !- Calculate columns size
	$.fn.calculateColumns = function(minWidth, colNum, padding, switchD, switchTH, switchTV, switchP, mode) {
		return this.each(function() {
			var $container = $(this),
				containerWidth = $container.width() - 1,
				containerPadding = (padding !== false) ? padding : 20,
				containerID = $container.attr("data-cont-id"),
				tempCSS = "",
				first = false;

			if(typeof(minWidth)==='undefined') minWidth = 200;
			if(typeof(colNum)==='undefined') colNum = 6;


			for ( ; Math.floor(containerWidth/colNum) < minWidth; ) {
				colNum--;
				if (colNum <= 1) break;
			}

			if (!$("#col-style-id-"+containerID).exists()) {

				//if(!$html.hasClass("old-ie")){// IE
				var jsStyle = document.createElement("style");
				jsStyle.id = "col-style-id-"+containerID;
				jsStyle.appendChild(document.createTextNode(""));
				document.head.appendChild(jsStyle);
					
				//}
			} else {
				var jsStyle = document.getElementById("col-style-id-"+containerID);
			}


			var $style = $("#col-style-id-"+containerID);

			var singleWidth,
				doubleWidth,
				columnsNum,
				normalizedPadding,
				normalizedMargin,
				normalizedPaddingTop;

			if (containerPadding < 10) {
				normalizedPadding = 0;
				normalizedPaddingTop = 0;
			}
			else {
				normalizedPaddingTop = containerPadding - 5;
				normalizedPadding = containerPadding - 10;
			};
			if (containerPadding == 0) {
				normalizedMargin = 0;
			}
			else {
				normalizedMargin = -containerPadding;
			};

			
			if($container.hasClass("resize-by-browser-width")){
				
				
				if (Modernizr.mq('only screen and (max-width:767px)')) {
					singleWidth = Math.floor(containerWidth / switchP)+"px";
					doubleWidth = Math.floor(containerWidth  / switchP)*2+"px";
					columnsNum = switchP;
				}else if(Modernizr.mq('(min-width:768px) and (max-width:991px)')){
					singleWidth = Math.floor(containerWidth / switchTV)+"px";
					doubleWidth = Math.floor(containerWidth  / switchTV)*2+"px";
					columnsNum = switchTV;
				}else if(Modernizr.mq('(min-width:992px) and (max-width:1199px)')){
					singleWidth = Math.floor(containerWidth / switchTH)+"px";
					doubleWidth = Math.floor(containerWidth  / switchTH)*2+"px";
					columnsNum = switchTH;
				}else {
					singleWidth = Math.floor(containerWidth / switchD)+"px";
					doubleWidth = Math.floor(containerWidth  / switchD)*2+"px";
					columnsNum = switchD;
				}

			}else{
				if (mode == "px") {
					singleWidth = Math.floor(containerWidth / colNum)+"px";
					doubleWidth = Math.floor(containerWidth  / colNum)*2+"px";
					columnsNum = colNum;
				}
				else {
					singleWidth = Math.floor(100000 / colNum)/1000+"%";
					doubleWidth = Math.floor(100000 / colNum)*2/1000+"%";
				};
			}

				if ( $(".cont-id-"+containerID+"").not(".bg-under-post, .content-bg-on").hasClass("description-under-image") ) {
					if (columnsNum > 1) {
						tempCSS = " \
							.cont-id-"+containerID+" { margin: -"+normalizedPaddingTop+"px  -"+containerPadding+"px -"+normalizedPadding+"px ; } \
							.full-width-wrap .cont-id-"+containerID+" { margin: "+(-normalizedPaddingTop)+"px "+containerPadding+"px "+(-normalizedPadding)+"px ; } \
							.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+normalizedPaddingTop +"px "+containerPadding+"px "+normalizedPadding+"px; } \
							.cont-id-"+containerID+" > .wf-cell.double-width { width: "+doubleWidth+"; } \
						";
					}
					else {
						tempCSS = " \
							.cont-id-"+containerID+" { margin: -"+normalizedPaddingTop+"px  -"+normalizedPadding+"px -"+containerPadding+"px ; } \
							.full-width-wrap .cont-id-"+containerID+" { margin: "+(-normalizedPaddingTop)+"px "+containerPadding+"px "+(-normalizedPadding)+"px ; } \
							.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+normalizedPaddingTop +"px "+normalizedPadding+"px "+containerPadding+"px; } \
						";
					};
				}else {
					if (columnsNum > 1) {
						tempCSS = " \
							.cont-id-"+containerID+" { margin: -"+containerPadding+"px; } \
							.full-width-wrap .cont-id-"+containerID+" { margin: "+normalizedMargin+"px  "+containerPadding+"px; } \
							.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+";  padding: "+containerPadding+"px; } \
							.cont-id-"+containerID+" > .wf-cell.double-width { width: "+doubleWidth+"; } \
						";
						
					}
					else {
						tempCSS = " \
							.cont-id-"+containerID+" { margin: -"+containerPadding+"px; } \
							.full-width-wrap .cont-id-"+containerID+" { margin: "+normalizedMargin+"px "+containerPadding+"px; } \
							.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+containerPadding+"px; } \
						";
					};
				};
			
			//if(!$html.hasClass("old-ie") ){''
			$style.html(tempCSS);
			var newRuleID = jsStyle.sheet.cssRules.length;
			jsStyle.sheet.insertRule(".webkit-hack { }", newRuleID);
			jsStyle.sheet.deleteRule(newRuleID);
				
			//}

			$container.trigger("columnsReady");

		});
	};

	// !- Initialise slider
	$.fn.initSlider = function() {
		return this.each(function() {
		
			var $_this = $(this),
				attrW = $_this.data('width'),
				attrH = $_this.data('height');

			if ($_this.hasClass("royalReady")) {
				return;
			}

			$_this.postTypeScroller();

			$_this.addClass("royalReady");
			
		});
	};
	//disable isotope animation
	var positionFunc = Isotope.prototype._positionItem;
	Isotope.prototype._positionItem = function( item, x, y, isInstant ) {
	  // ignore isInstant, pass in true;
	  positionFunc(item, x, y, true);
	};
	$.fn.IsoLayzrInitialisation = function(container) {

		return this.each(function() {
			var $this = $(this);

			var layzrMsnr = new Layzr({
				container: container,
				selector: '.iso-lazy-load',
				attr: 'data-src',
				attrSrcSet: 'data-srcset',
				retinaAttr: 'data-src-retina',
				threshold: 30,
				before: function() {
					var ext = $(this).attr("data-src").substring($(this).attr("data-src").lastIndexOf(".")+1);
				   if(ext == "png"){
				     $(this).parent().addClass("layzr-bg-transparent");
				  }
					// For fixed-size images with srcset; or have to be updated on window resize.
					this.setAttribute("sizes", this.width+"px");
				},
				callback: function() {
					this.classList.add("iso-layzr-loaded");
					var $this =  $(this);
		         	$this.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
						setTimeout(function(){
							$this.parent().removeClass("layzr-bg");
						}, 200)
					});
				}
			});
		});
		
	};

	/* !Containers of masonry and grid content */
	var	$isoCollection = $(".iso-container"),
		$gridCollection = $(".iso-grid:not(.jg-container, .iso-container), .blog.layout-grid .wf-container.description-under-image:not(.jg-container, .iso-container), .grid-masonry:not(.iso-container), .shortcode-blog-posts.iso-grid, .mode-grid"),
		//$flexGrid = $(".blog-grid-shortcode"),
		$combinedCollection = $isoCollection.add($gridCollection),
		$isoPreloader = dtGlobals.isoPreloader = $('<div class="iso-preloader pace pace-active"><div class="pace-activity"></div></div>').appendTo("body").hide();
		$combinedCollection.not(".blog-grid-shortcode").addClass("dt-isotope");

	/* !Smart responsive columns */
	if ($combinedCollection.exists()) {
		$combinedCollection.each(function(i) {
			var $container = $(this),
				contWidth = parseInt($container.attr("data-width")),
				contNum = parseInt($container.attr("data-columns")),
				desktopNum = parseInt($container.attr("data-desktop-columns-num")),
				tabletHNum = parseInt($container.attr("data-h-tablet-columns-num")),
				tabletVNum = parseInt($container.attr("data-v-tablet-columns-num")),
				phoneNum = parseInt($container.attr("data-phone-columns-num"));
			var contPadding = parseInt($container.attr("data-padding"));
			
			$container.addClass("cont-id-"+i).attr("data-cont-id", i);
			$container.calculateColumns(contWidth, contNum, contPadding, desktopNum, tabletHNum, tabletVNum, phoneNum, "px");
			if(contPadding > 10){
				$container.addClass("mobile-paddings");
			}

			$window.on("debouncedresize", function () {
				$container.calculateColumns(contWidth, contNum, contPadding, desktopNum, tabletHNum, tabletVNum, phoneNum, "px");

				if(contPadding > 10){
					$container.addClass("mobile-paddings");
				}
			});
		});
	}
	

	if(!dtGlobals.isPhone){
		// !- Responsive height hack
		$.fn.heightHack = function() {
			//if(!$(".layzr-loading-on").length > 0){

				return this.each(function() {
					var $img = $(this);
					if ($img.hasClass("height-ready") || $img.parents(".post-rollover").exists() || $img.parents(".slider-masonry").exists()) {
						return;
					}

					var	imgWidth = parseInt($img.attr('width')),
						imgHeight = parseInt($img.attr('height')),
						imgRatio = imgWidth/imgHeight;

					if($img.parents(".testimonial-vcard, .dt-format-gallery, .shortcode-blog-posts.iso-grid ").exists()) {
						$img.wrap("<div />");
					};

					$img.parent().css({
						"padding-bottom" : 100/imgRatio+"%",
						"height" : 0,
						"display" : "block"
					});

					$img.attr("data-ratio", imgRatio).addClass("height-ready");
					
				});
			//}
		};
			
		/* !Isotope initialization */
		$.fn.IsoInitialisation = function(item, mode, trans) {
			return this.each(function() {
				var $this = $(this);
				if ($this.hasClass("iso-item-ready")) {
					return;
				}
				$this.isotope({
					itemSelector : item,
					//transformsEnabled: false,
					//isResizeBound: false,
					layoutMode : mode,
					stagger: 30,
					resize: false,
					transitionDuration: 0,
					hiddenStyle: {
						opacity: 0
					},
					visibleStyle: {
						opacity: 1
					},
					//isInitLayout: false,
					/*animationEngine: typeOfAnimation,*/
					masonry: { columnWidth: 1 },
					getSortData : {
						date : function( $elem ) {
							return $($elem).attr('data-date');
						},
						name : function( $elem ) {
							return $($elem).attr('data-name');
						}
					}
				});
				$this.addClass("iso-item-ready");

			});
			
		};
		

		
		/* !Masonry and grid layout */

		/* !Filter: */
		//var $container = $('.iso-container, .portfolio-grid');
		$('.iso-container, .portfolio-grid').each(function(){
			var $container = $(this);
			$('.filter:not(.iso-filter, .without-isotope, .with-ajax) .filter-categories a').on('click.presscorFilterCategories', function(e) {
				var selector = $(this).attr('data-filter');

				$container.isotope({ filter: selector });
				return false;
			});

			// !- filtering
			$('.filter:not(.iso-filter, .without-isotope, .with-ajax) .filter-extras .filter-by a').on('click', function(e) {
				var sorting = $(this).attr('data-by'),
					sort = $(this).parents('.filter-extras').find('.filter-sorting > a.act').first().attr('data-sort');

				$container.isotope({ sortBy : sorting, sortAscending : 'asc' == sort });
				return false;
			});

			// !- sorting
			$('.filter:not(.iso-filter, .without-isotope, .with-ajax) .filter-extras .filter-sorting a').on('click', function(e) {
				var sort = $(this).attr('data-sort'),
					sorting = $(this).parents('.filter-extras').find('.filter-by > a.act').first().attr('data-by');

				$container.isotope({ sortBy : sorting, sortAscending : 'asc' == sort });
				return false;
			});
		});


		/* !Masonry layout */
		if ($isoCollection.exists() || $gridCollection.exists() ) {

			// Show preloader
			$isoPreloader.fadeIn(50);

			$combinedCollection.not(".blog-grid-shortcode").each(function() {
				var $isoContainer = $(this);

				// Hack to make sure that masonry will correctly calculate columns with responsive images height. 
				$(".preload-me", $isoContainer).heightHack();
				// Slider initialization
				$(".slider-masonry", $isoContainer).initSlider();
				

				// postsFilter.init(filterConfig);
				$isoContainer.one("columnsReady", function() {

					//Call isotope
					if($isoContainer.hasClass("iso-container")){
						$isoContainer.IsoInitialisation('.iso-item', 'masonry', 400);
					}else{
						$isoContainer.IsoInitialisation('.wf-cell', 'fitRows', 400);
					}

					$isoContainer.isotope('on', 'layoutComplete', function (objArray){
					    //callback isotope on load ...
					    for(var i = 0; i < objArray.length; i++){
					        var obj = objArray[i];
					        var  $container = $(this);
					       $isoContainer.trigger("IsoReady");
					    }
					});
					/* !Call layzr on isotope layoutComplete */
					$isoContainer.one("IsoReady", function() {
					
						//$(".iso-lazy-load", $isoContainer).deleteLayzrHack();
						$isoContainer.isotope("layout");

						/*Init layzr*/
						$isoContainer.IsoLayzrInitialisation();


					});

					// Recalculate everything on window resize
					$window.on("columnsReady", function () {
						if($(".slider-masonry", $isoContainer).hasClass("royalReady")){
							$(".slider-masonry", $isoContainer).each(function(){
								var scroller = $(this).parents(".ts-wrap").data("thePhotoSlider");
								if(typeof scroller!= "undefined"){
									scroller.update();
								};
							});
						}

						$isoContainer.isotope("layout");

						
					});
					
				});
			});

			// Hide preloader
			$isoPreloader.stop().fadeOut(300);


		};
	};

	/*!- Phone only*/
	if(dtGlobals.isPhone){
		$(".slider-masonry").initSlider();
		$window.on("columnsReady", function () {
			$(".slider-masonry").each(function(){
				var scroller = $(this).parents(".ts-wrap").data("thePhotoSlider");
				if(typeof scroller!= "undefined"){
					scroller.update();
				};
			});
		});

		$(".filter-extras").css("display", "none");

		var $container = $(".filter").next('.iso-container, .portfolio-grid'),
			$items = $(".iso-item, .wf-cell", $container),
			selector = null;
			$(".mobile-true .iso-container, .mobile-true .iso-grid").IsoLayzrInitialisation();

		$(".filter-categories:not(.iso-filter) a").each(function(){
			$(this).on('click', function(e) {
				e.preventDefault();
				selector = $(this).attr('data-filter');
				$items.css("display", "none");
				$items.filter(selector).css("display", "inline-block");
				$(".mobile-true .slider-masonry").IsoLayzrInitialisation();
			});
		});

	};
// })

// jQuery(document).ready(function($) {
	/* !Debounced resize event */

	/*!Change filter appearance when too much categories*/

	// function changeFilter(){
	// 	$(".filter-categories").each(function(){
	// 		var width = 0;
	// 		$(".filter-categories a").each(function(){
	// 			var $_this = $(this);
	// 			if($(".style-ios").length > 0){
	// 				width += ($_this.innerWidth()-1);
	// 			}else{
	// 				width += $_this.innerWidth();
	// 			}
	// 		});
	// 		if( width > $(this).width() ){
	// 			$(this).addClass("new-style")
	// 		}else{
	// 			$(this).removeClass("new-style")
	// 		}
	// 	});
	// };
	// changeFilter();

	$window.on("debouncedresize", function( event ) {
		dtGlobals.resizeCounter++;

		//Photos widget
		if ( $.isFunction($.fn.calcPics) ) {
			$(".instagram-photos").calcPics();
		}
		//Filter responsiveness
		//changeFilter();
		$.mobileHeader();
		$.headerBelowSlider();

		/*Mobile header*/
		if(window.innerWidth >= dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
			$page.removeClass("show-mobile-header");
			$page.addClass("closed-mobile-header");
			$body.removeClass("show-sticky-mobile-header");
			$body.removeClass("show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
			$(".mobile-sticky-header-overlay").removeClass("active");
			$(".dt-mobile-menu-icon").removeClass("active");
			$html.removeClass("menu-open");
			if (!headerBelowSliderExists ) {
				if (!bodyTransparent) {
					$('.masthead:not(.mixed-header):not(#phantom):not(.side-header)')
					//.stop(true, true)
					.velocity({
						translateY : "",
					}, 0);
				}
			}
		}
		if(window.innerWidth <= dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
			$('.masthead:not(.mixed-header):not(#phantom)').addClass("masthead-mobile");
		}else{
			$('.masthead:not(.mixed-header):not(#phantom)').removeClass("masthead-mobile");
		}
		
		//Custom select
		$('.mini-nav select').trigger('render');
		
		//Fancy headers
		$.fancyFeaderCalc();

		
		/*Detect first/last visible item microwidgets*/
		$(".mini-widgets, .mobile-mini-widgets").find(" > *").removeClass("first last");
		$(".mini-widgets, .mobile-mini-widgets").find(" > *:visible:first").addClass("first");
		$(".mini-widgets, .mobile-mini-widgets").find(" > *:visible:last").addClass("last");
	
		//Stripe Video bg
		$(".stripe-video-bg > video").each(function(){
			if($(".header-side-line").length > 0 && !$(".boxed").length > 0 ){
	            var sideHW = $(".side-header-v-stroke").width();
	        }else if(!$("body").hasClass("sticky-header") && !$("body").hasClass("overlay-navigation") && $(".side-header").length > 0){
	            var sideHW = $(".side-header").width();
	        }else{
	            var sideHW = 0;
	        }
	      	var stripePadL  = 2000 + sideHW,
	      		 pageOfL  = stripePadL - $(".content").position().left - 22;

			var $_this = $(this),
				$this_h = $_this.height(),
				$pageW = $("#page").width();
			$_this.css({
				// "marginTop": -$this_h/2,
				left: pageOfL,
				width: $pageW
			});
		});
		
		//Set full height stripe
		$(".stripe, .dt-default").each(function(){
			var $_this = $(this),
				$_this_min_height = $_this.attr("data-min-height");
			if($.isNumeric($_this_min_height)){
				$_this.css({
					"minHeight": $_this_min_height + "px"
				});
			}else if(!$_this_min_height){
				$_this.css({
					"minHeight": 0
				});
			}else if($_this_min_height.search( '%' ) > 0){
				$_this.css({
					"minHeight": $window.height() * (parseInt($_this_min_height)/100) + "px"
				});
			}else{
				$_this.css({
					"minHeight": $_this_min_height
				});
			};
		});

		/*Floating content*/
		
		//$(".project-slider .preload-me").loaded(null, function() {
			$parentHeight = $floatContent.parent().height();
			$floatContentHeight = $floatContent.height();
		//}, true);
		
		// if ( $floatContent.length > 0 && window.innerWidth > 1050 ){
		// 	//$(".project-slider .preload-me").loaded(null, function() {
		// 		if ( (dtGlobals.winScrollTop + $phantom.height() + $floatContentHeight + 40) > (projectPost.offset().top + $parentHeight)) {
		// 			$floatContent.css({
		// 				top: $parentHeight - $floatContentHeight - 40
		// 			});
		// 		};
		// 	//}, true);
		// };
	//	setFloatinProjectContent();
		

		/* Sticky footer */

		$(".mobile-false .footer-overlap .page-inner").css({
			'min-height': window.innerHeight - $(".footer").innerHeight(),
			'margin-bottom': $(".footer").innerHeight()
		});

	}).trigger( "debouncedresize" );

/*Custom resize function:end* })


/* #AJAX
================================================== */
// jQuery(document).ready(function($) {

	$.fn.inView = function(){
		//Window Object
		var win = $(window);
		//Object to Check
		obj = $(this);
		//the top Scroll Position in the page
		var scrollPosition = win.scrollTop();
		//the end of the visible area in the page, starting from the scroll position
		var visibleArea = win.scrollTop() + win.height();
		//the end of the object to check
		var objEndPos = (obj.offset().top + 20);
		return(visibleArea >= objEndPos && scrollPosition <= objEndPos ? true : false);
	};

	// 4 Alla & Danil: we need to unify all ajax and masonry and other stuff in this manner:
	function loadingEffects() {
		//if(dtGlobals.isiPhone) return;

		var $isotope = $(".dt-isotope"),
			$grid = $(".iso-grid .wf-cell:not(.shown)");

		if ($grid.exists()) {
			precessEffects($grid);
		}

		if (!$isotope.exists()) {
			var $isoFallback = $(".iso-item:not(.shown)");

			if (!$isoFallback.exists()) return;
			precessEffects($isoFallback);
		}
		else {
			var t = 0;

			$isotope.each(function() {
				t++;
				var $atoms = $(this).find(".wf-cell");
				if (!$atoms.exists()) return;
				precessEffects($atoms, function(){});
				
			});
		};
	};

	function precessEffects($atoms, callback) {
		var k = 0;

		$atoms.each(function () {
			var $this = $(this);
			if($(".mobile-true").length > 0 || $this.parents(".loading-effect-none").length > 0){
				if (!$this.hasClass("shown") && !$this.hasClass("animation-triggered")) {
					$this.addClass("animation-triggered");
					setTimeout(function () {
						if ($this.hasClass("animation-triggered")) { 
							$this.removeClass("animation-triggered").addClass("shown");
						};
					}, 200);
				};
			}else{
				if (!$this.hasClass("shown") && !$this.hasClass("animation-triggered") && $this.inView()) {
					$this.addClass("animation-triggered");
					k++;
					setTimeout(function () {
						if ($this.hasClass("animation-triggered")) { 
							$this.removeClass("animation-triggered").addClass("shown");
						};
					}, 100 * k);
				};

				
			}
			if (typeof callback == "function") {
					callback.call(this);
				}
		});
		
	};

	function resetEffects() {
		$(".iso-item.shown, .iso-grid .wf-cell.shown").removeClass("start-animation").removeClass("animation-triggered").removeClass("shown");
	};

	var dtAjaxing = {
		xhr: false,
		settings: false,
		lunch: function( settings ) {

			var ajaxObj = this;

			if ( settings ) {
				this.settings = settings;
			}

			if ( this.xhr ) {
				this.xhr.abort();
			}

			var action = 'presscore_template_ajax';

			this.xhr = $.post(
				settings.ajaxurl,
				{
					action : action,
					postID : settings.postID,
					paged : settings.paged,
					targetPage : settings.targetPage,
					term : settings.term,
					orderby : settings.orderBy,
					order : settings.order,
					nonce : settings.nonce,
					visibleItems : settings.visibleItems,
					contentType : settings.contentType,
					pageData : settings.pageData,
					sender : settings.sender
				},
				function( responce ) {

					if ( responce.success ) {

						var $responceItems = jQuery(responce.html),
							$isoContainer = settings.targetContainer,

							contWidth = parseInt($isoContainer.attr("data-width")),
							contMaxWidth = parseInt($isoContainer.attr("data-max-width")),
							contPadding = parseInt($isoContainer.attr("data-padding"));
							isIsotope = 'grid' == settings.layout || 'masonry' == settings.layout,
							itemsToDeleteLength = 0,
							trashItems = new Array(),
							sortBy = responce.orderby.replace('title', 'name'),
							sortAscending = ('asc' == responce.order.toString());

						if ( dtGlobals.isPhone ) {
							isIsotope = false;
						}

						if ( responce.newNonce ) {
							dtLocal.ajaxNonce = responce.newNonce;
						}

						if ( typeof responce.itemsToDelete != 'undefined' ) {
							itemsToDeleteLength = responce.itemsToDelete.length;
						}

						// if not mobile isotope with spare parts
						if ( isIsotope && itemsToDeleteLength > 0 ) {

							for( var i = 0; i < responce.itemsToDelete.length; i++ ) {
								trashItems.push('.wf-cell[data-post-id="' + responce.itemsToDelete[i] + '"]');
							}

							$isoContainer.isotope('remove', $isoContainer.find(trashItems.join(',')));

						// if mobile or not isotope and sender is filter or paginator
						} else if ( !isIsotope && ('filter' == settings.sender || 'paginator' == settings.sender) ) {

							$isoContainer.find('.wf-cell, article').remove();
						}

						if ( $responceItems.length > 0 ) {

							// append new items
							$isoContainer.append($responceItems);
							dtGlobals.ajaxContainerItems = $isoContainer.find('div.wf-cell, .project-even, .project-odd').not('.animation-triggered');

							// for isotope - insert new elements
							if ( isIsotope ) {

								$(".preload-me", $isoContainer).heightHack();
								$(".slider-masonry", $isoContainer).initSlider();
								$(".slider-masonry", $isoContainer).css("visibility", "visible");


								$isoContainer.isotope('addItems', $responceItems);

								if ( 'media' != settings.contentType ) {
									$isoContainer.isotope({ sortBy : sortBy, sortAscending : sortAscending });
								} else {
									$isoContainer.isotope({ sortBy: 'original-order' });
								}

								$isoContainer.isotope("layout");

								ajaxObj.init();

								
								$isoContainer.layzrInitialisation();

								$isoContainer.IsoLayzrInitialisation();

							// all other cases - append new elements
							} else {

								// mobile isotope filtering emulation
								if ( dtGlobals.isPhone && ('masonry' == settings.layout || 'grid' == settings.layout) ) {}

								$(".slider-masonry", $isoContainer).initSlider();
								$("ul.photoSlider:not(.slider-masonry)").each(function(){
						    		$(this).postTypeScroller();
						    	});
						    	$("ul.photoSlider").css("visibility", "visible");

								if ( 'jgrid' == settings.layout ) {
									$isoContainer.collagePlus(dtGlobals.jGrid);
								}

								ajaxObj.init();

								$isoContainer.layzrInitialisation();
								$isoContainer.IsoLayzrInitialisation(".mobile-true");

							}

							if ( typeof settings.afterSuccessInit != 'undefined' ) {
								settings.afterSuccessInit( responce );
							}

							$window.trigger('dt.ajax.content.appended');

						} else if ( isIsotope ) {

							// if no responce items - reorder isotope
							$isoContainer.isotope({ sortBy : sortBy, sortAscending : sortAscending });
						}

					}

					if ( typeof settings.afterResponce != 'undefined' ) {
						settings.afterResponce( responce );
					}

					loadingEffects();
				}
			);
		},
		init : function() {
			switch ( this.settings.contentType ) {
				case 'portfolio' :
					this.initPortfolio();
					break;

				case 'albums' :
					this.initAlbums();
					break;

				case 'media' :
					this.initMedia();
					break;

				case 'blog':
					this.basicInit();
					break;
				 case 'testimonials':
					this.basicInit();
					break;
			}
		},
		initPortfolio : function() {
			this.basicInit();
		},
		initAlbums : function() {
			this.basicInit();
		},
		initMedia : function() {
			this.basicInit();

			$(".mobile-false .albums .rollover-content, .mobile-false .media .rollover-content").on("click", function(e){
				if ( $(e.target).is("a") ) {
					return true;
				}
				$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
			});

		},
		basicInit : function() {
			//retinizer();

			var $container = this.settings.targetContainer;

			$('.dt-gallery-mfp-popup', $container).not('.mfp-ready').on('click', function(){
				var $this = $(this),
					$container = $this.parents('article.post');

				if ( $container.length > 0 ) {
					var $target = $container.find('.dt-gallery-container a.dt-mfp-item');

					if ( $target.length > 0 ) {
						$target.first().trigger('click');
					}
				}

				return false;
			}).addClass('mfp-ready');

			// trigger click on first a.dt-mfp-item in the container
			$('.dt-trigger-first-mfp', $container).not('.mfp-ready').on('click', function(){
				var $this = $(this),
					$container = $this.parents('article.post');

				if ( $container.length > 0 ) {
					var $target = $container.find('a.dt-mfp-item');

					if ( $target.length > 0 ) {
						$target.first().trigger('click');
					}
				}

				return false;
			}).addClass('mfp-ready');

			// single opup
			$('.dt-single-image', $container).not('.mfp-ready').magnificPopup({
				type: 'image'
			}).addClass('mfp-ready');

			$('.dt-single-video', $container).not('.mfp-ready').magnificPopup({
				type: 'iframe'
			}).addClass('mfp-ready');

			$('.dt-single-mfp-popup', $container).not('.mfp-ready').magnificPopup({
				type: 'image'
			}).addClass('mfp-ready');


			$(".dt-gallery-container", $container).not('.mfp-ready').each(function(){
				$(this).addClass('mfp-ready').magnificPopup( $.extend( {}, dtGlobals.magnificPopupBaseConfig, {
					delegate: 'a.dt-mfp-item',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					}
				}));
			});

			$(".rollover, .rollover-video, .post-rollover, .rollover-project .show-content", $container).addRollover();
			if ( $.isFunction($.fn.hoverdir) ) {
				$('.mobile-false .hover-grid .rollover-project').each( function() { $(this).hoverdir(); } );
			
				$('.mobile-false .hover-grid-reverse .rollover-project ').each( function() { $(this).hoverdir({
					inverse : true
				}); } );
			}
			$(".mobile-true .rollover-project a.link.show-content, .hover-style-one article:not(.description-off) .rollover-project > a, .hover-style-two article:not(.description-off) .rollover-project > a, .hover-style-three article:not(.description-off) .rollover-project > a").on("click", function(e){
				e.preventDefault();
			});
			$(".rollover, .post-rollover, .rollover-video").clickEffectPics();
			$(".rollover.material-click-effect, .post-rollover.material-click-effect, .rollover-video.material-click-effect").clickMaterialEffect();

			if($(".small-portfolio-icons").length > 0){

				$('.links-container a').each(function(){
					var $this = $(this);
					$this.addClass("waves-effect");
				});
				Waves.displayEffect();
			}


			$(".mobile-true .rollover-project").touchNewHover();
			if ( $.isFunction($.fn.triggerHoverClick) ) {
				// $(".touch .links-container > a").touchHoverLinks();
				$(".mobile-false .rollover-project:not(.rollover-active) .rollover-content, .buttons-on-img:not(.rollover-active) .rollover-content").triggerHoverClick();
			}
			if ( $.isFunction($.fn.triggerHoverClick) ) {
				$(".mobile-false .rollover-project.forward-post").triggerHoverClick();
			}
			if ( $.isFunction($.fn.triggerHoverClick) ) {
				$(".mobile-false .rollover-project.rollover-active, .mobile-false .buttons-on-img.rollover-active").followCurentLink();
			}
			if ( $.isFunction($.fn.triggerAlbumsClick) ) {
				$(".albums .rollover-project, .albums .buttons-on-img, .archive .type-dt_gallery .buttons-on-img").triggerAlbumsClick();
			}
			if ( $.isFunction($.fn.touchforwardToPost) ) {
				$(".mobile-true .rollover-project.forward-post").touchforwardToPost();
			}
			if ( $.isFunction($.fn.touchHoverImage) ) {
				$(".mobile-true .buttons-on-img").touchHoverImage();
			}

			$(".hover-scale .rollover-project").scaleInHover();
			if ( $.isFunction($.fn.hoverLinks) ) {
				$(".links-container a").hoverLinks();
			}
			if($(".style-material-design").length > 0) {
				$('.links-container a, .paginator .page-nav a').each(function(){
					var $this = $(this);
					$this.addClass("waves-effect");
				});
				Waves.displayEffect();
			}

		}
	};

	// get ajax data
	function dtGetAjaxData( $parentContainer ) {
		var	$filtersContainer = $parentContainer.find('.filter.with-ajax').first(),
			$itemsContainer = $parentContainer.find('.wf-container.with-ajax, .articles-list.with-ajax').first(),
			$currentCategory = $filtersContainer.find('.filter-categories a.act'),
			$currentOrderBy = $filtersContainer.find('.filter-by a.act'),
			$currentOrder = $filtersContainer.find('.filter-sorting a.act'),
			paged = parseInt($itemsContainer.attr('data-cur-page')),
			nonce = null,
			visibleItems = new Array(),
			term = ( $currentCategory.length > 0 ) ? $currentCategory.attr('data-filter').replace('.category-', '').replace('*', '') : '';

		if ( '0' == term ) {
			term = 'none';
		}

		if ( $itemsContainer.hasClass('dt-isotope') ) {

			$('.wf-cell', $itemsContainer).each( function(){
				visibleItems.push( $(this).attr('data-post-id') );
			});
		}

		return {
			visibleItems : visibleItems,
			postID : dtLocal.postID,
			paged : paged,
			term : term,
			orderBy : ( $currentOrderBy.length > 0 ) ? $currentOrderBy.attr('data-by') : '',
			order : ( $currentOrder.length > 0 ) ? $currentOrder.attr('data-sort') : '',
			ajaxurl : dtLocal.ajaxurl,
			nonce : dtLocal.ajaxNonce,
			pageData : dtLocal.pageData,
			layout : dtLocal.pageData.layout,
			targetContainer : $itemsContainer,
			isPhone : dtGlobals.isPhone
		}
	}

	// paginator
	$('#content').on('click', '.paginator.with-ajax a', function(e){
		e.preventDefault();

		//resetEffects();

		if ( $(e.target).hasClass('dots') || $(e.target).hasClass('disabled') ) {
			return;
		}

		var $this = $(this),
			$paginatorContainer = $this.closest('.paginator'),
			$parentContainer = $paginatorContainer.parent(),
			$itemsContainer = $parentContainer.find('.wf-container.with-ajax, .articles-list.with-ajax').first(),

			$loadMoreButton = $(".button-load-more"),
			loadMoreButtonCaption = $loadMoreButton.find('.button-caption').text(),

			paginatorType = $paginatorContainer.hasClass('paginator-more-button') ? 'more' : 'paginator',
			isMore = ('more' == paginatorType),

			ajaxData = dtGetAjaxData($parentContainer),
			targetPage = isMore ? ajaxData.paged + 1 : $this.attr('data-page-num'),
			isoPreloaderExists = dtGlobals.isoPreloader;

		$loadMoreButton.addClass("animate-load").find('.button-caption').text(dtLocal.moreButtonText.loading);

		// show preloader
		if ( isoPreloaderExists && !$(".paginator-more-button").length ) {
			dtGlobals.isoPreloader.fadeIn(50);
		}
		
		if ( !isMore ) {
			var $scrollTo = $parentContainer.find('.filter.with-ajax').first(),
				paddingTop = 44;

			if (!$scrollTo.exists()) {
				$scrollTo = $itemsContainer;
				paddingTop = 50;
			}

			// scroll to top
			$("html, body").animate({
				scrollTop: $scrollTo.offset().top - $("#phantom").height() - paddingTop
			}, 400);
		}else{
			$("html, body").scrollTop($window.scrollTop() + 1);
		}

		// lunch ajax
		dtAjaxing.lunch($.extend({}, ajaxData, {
			contentType : ajaxData.pageData.template,
			targetPage : targetPage,
			sender : paginatorType,
			visibleItems : isMore ? new Array() : ajaxData.visibleItems,
			afterResponce : function( responce ) {

				// we have paginator
				if ( $paginatorContainer.length > 0 ) {

					if ( responce.paginationHtml ) {

						// update paginator with responce content
						$paginatorContainer.html($(responce.paginationHtml).html()).show();
						if($(".filter-style-material").length > 0){
							$(".paginator .page-links a").each(function(){
								var $this = $(this);
								$this.addClass("ripple");
							});
							$( '.page-links a.ripple' ).ripple();

							$('.paginator .page-nav a').each(function(){
								var $this = $(this);
								$this.addClass("waves-effect");
							});
							Waves.displayEffect();
						}

					} else {

						if ( false && isMore ) {
							$paginatorContainer.html('<span class="loading-ready">' + dtLocal.moreButtonAllLoadedText + '</span>');
						} else {
							// clear paginator and hide it
							$paginatorContainer.html('').hide();
						}
					}
					setTimeout (function(){
						$(".button-load-more").removeClass("animate-load").find('.button-caption').text(loadMoreButtonCaption);
					}, 200);

				} else if ( responce.paginationHtml ) {

					// if there are no paginator on page but ajax responce have it
					$itemsContainer.parent().append($(responce.paginationHtml));
				}
				
 			
				// add dots onclick event handler
				$paginatorContainer.find('.dots').on('click', function() {
					$paginatorContainer.find('div:hidden').show().find('a').unwrap();
					$(this).remove();
				});

				// update current page field
				$itemsContainer.attr('data-cur-page', responce.currentPage);

				// hide preloader
				dtGlobals.isoPreloader.stop().fadeOut(300);

				// update load more button
				dtGlobals.loadMoreButton = $(".button-load-more");
			}
		}));
	});

	// filter
	$('.filter.with-ajax .filter-categories a, .filter.with-ajax .filter-extras a').on('click', function(e){
		e.preventDefault();

		resetEffects();

		var $this = $(this),
			$filterContainer = $this.closest('.filter'),
			$parentContainer = $filterContainer.parent(),
			$itemsContainer = $parentContainer.find('.wf-container.with-ajax').first(),
			$paginatorContainer = $parentContainer.find('.paginator').first(),

			ajaxData = dtGetAjaxData($parentContainer),
			isoPreloaderExists = dtGlobals.isoPreloader;

		// show preloader
		if ( isoPreloaderExists ) {
			dtGlobals.isoPreloader.fadeIn(50);
		}

		// lunch ajax
		dtAjaxing.lunch($.extend({}, ajaxData, {
			contentType : ajaxData.pageData.template,
			targetPage : 1,
			paged : 1,
			sender : 'filter',
			afterResponce : function( responce ) {

				// we have paginator
				if ( $paginatorContainer.length > 0 ) {

					if ( responce.paginationHtml ) {

						// update paginator with responce content
						$paginatorContainer.html($(responce.paginationHtml).html()).show();
					} else {

						// clear paginator and hide it
						$paginatorContainer.html('').hide();
					}

				} else if ( responce.paginationHtml ) {

					// if there are no paginator on page but ajax responce have it
					$itemsContainer.parent().append($(responce.paginationHtml));
				}
				

				// add dots onclick event handler
				$paginatorContainer.find('.dots').on('click', function() {
					$paginatorContainer.find('div:hidden').show().find('a').unwrap();
					$(this).remove();
				});

				// update current page field
				$itemsContainer.attr('data-cur-page', responce.currentPage);

				// hide preloader
				dtGlobals.isoPreloader.stop().fadeOut(300);

				// update load more button
				dtGlobals.loadMoreButton = $(".button-load-more");
			}
		}));
		
	});

	function lazyLoading() {
		if ( dtGlobals.loadMoreButton && dtGlobals.loadMoreButton.exists() ) {

			var buttonOffset = dtGlobals.loadMoreButton.offset();
			if ( buttonOffset && $window.scrollTop() > (buttonOffset.top - $window.height()) / 2 && !dtGlobals.loadMoreButton.hasClass('animate-load') ) {
				dtGlobals.loadMoreButton.trigger('click');
			}

		}
	}

	// lazy loading
	if ( typeof dtLocal.themeSettings.lazyLoading != 'undefined' && dtLocal.themeSettings.lazyLoading ) {

		dtGlobals.loadMoreButton = $(".button-load-more");
		var timer = null;
		$window.on('scroll', function () {
			lazyLoading();
		});
		lazyLoading();
	}

	// Prevent a backgroung rendering glitch in Webkit.
	// if (!window.bgGlitchFixed && $.browser.webkit) {
	// 	setTimeout(function(){
	// 		$window.scrollTop($window.scrollTop() + 1);
	// 		window.bgGlitchFixed = true;
	// 	},10)
	// }

	var waitForFinalEvent = (function () {
		var timers = {};
		return function (callback, ms, uniqueId) {
			if (!uniqueId) {
				uniqueId = "Don't call this twice without a uniqueId";
			}
			if (timers[uniqueId]) {
				clearTimeout (timers[uniqueId]);
			}
			timers[uniqueId] = setTimeout(callback, ms);
		};
	})();
	
	// Usage
	$window.resize(function () {
		
		/*Animate iso-items on resize*/
		$(".iso-item, .iso-grid .wf-cell").addClass("animate-position");
		waitForFinalEvent(function(){
			$(".iso-item, .iso-grid .wf-cell").removeClass("animate-position");
		}, 2500, "");

	});

	var $isotope = $(".dt-isotope"),
		$isoFallback = $(".iso-item:not(.shown):not(.is-visible)"),
		$grid = $(".iso-grid .wf-cell:not(.shown):not(.is-visible)");

	if ($isotope.exists() || $isoFallback.exists() || $grid.exists()) {
		setTimeout(function () {
			loadingEffects();
		}, 100);

		$window.on("scroll", function() {
			loadingEffects();
		});
	};
 //})


/* #Filter for posts shortcode
================================================== */
// jQuery(document).ready(function($) {
	var dtPostsJQueryFilter = {
		timeouts: {},

		init: function(settings) {
			this.config = {
				postsContainer: null,
				categoryContainer: null,
				paginatorContainer: null,
				curPage: 1,
				curCategory: '*',
				postsPerPage: -1,
				items: []
			};

			$.extend( this.config, settings );

			this._setPostsPerPage();
			this._setCategory();
			this._setCurPage();
			this._setItems();

			this.setup();
		},

		setup: function() {
			$('a', this.config.paginatorContainer).on('click.dtPostsPaginationFilter', {self: this}, this.paginationFilter);
			$('a', this.config.categoryContainer).on('click.dtPostsCategoryFilter', {self: this}, this.categoryFilter);

			this._getActiveElement(this.config.paginatorContainer).trigger('click.dtPostsPaginationFilter', { onSetup: true });

		},

		paginationFilter: function(event, onSetup) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setCurPage();

			if ( ! onSetup ) {
				self._scrollToTopOfContainer( self._filterPosts );
				
				
			} else {
				self._filterPosts();
			};
			
			
		},

		categoryFilter: function(event) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setCategory();
			self._setAsActive(self.config.paginatorContainer.find('a').first());
			self._setCurPage();

			self._showPagination();
			self._filterPosts();
		},

		_showPagination: function() {
			if ( this.config.curCategory && '*' != this.config.curCategory ) {
				var itemsCount = this.config.postsContainer.find(this.config.curCategory).length;
				var maxPage = Math.ceil( itemsCount / this.config.postsPerPage );
				if ( maxPage == 1 ) {
					this.config.paginatorContainer.find('a').hide();
				} else {
					this.config.paginatorContainer.find('a').each(function(index) {
						var $this = $(this);
						if ( (index + 1) > maxPage ) {
							$this.hide();
						} else {
							$this.show();
						}
					});
				}
			} else {
				this.config.paginatorContainer.find('a').show();
			}

		},

		_filterPosts: function() {
			var self = this;

			// category filter emulation
			self.config.items.css("display", "none");

			var itemsCount = 0;
			self.config.items.filter(self.config.curCategory).each(function() {
				if ( self._showOnCurPage(++itemsCount) ) {
					$(this).css("display", "block");
				}
			});

		},

		_setPostsPerPage: function() {
			this.config.postsPerPage = parseInt( this.config.postsContainer.attr('data-posts-per-page') );
		},

		_setCategory: function() {
			this.config.curCategory = this._getActiveElement(this.config.categoryContainer).attr('data-filter') || this.config.curCategory;
		},

		_setCurPage: function(page) {
			this.config.curPage = page ? page : this._getActiveElement(this.config.paginatorContainer).attr('data-page-num');
		},

		_setItems: function() {
			this.config.items = $(".wf-cell", this.config.postsContainer);

			
		},

		_showOnCurPage: function(index) {
			return this.config.postsPerPage <= 0 || ( this.config.postsPerPage*(this.config.curPage - 1) < index && index <= this.config.postsPerPage*this.config.curPage );
		},

		_setAsActive: function(item) {
			item.addClass('act').siblings().removeClass('act');
		},

		_getActiveElement: function(items) {
			return items.find('a.act').first();
		},

		_isActive: function(item) {
			return item.hasClass('act');
		},

		_scrollToTopOfContainer: function(onComplite) {
			var scrollTo = this.config.postsContainer.parent();

			$("html, body").animate({
				scrollTop: scrollTo.offset().top - $("#phantom").height() - 50
			}, 400, onComplite ? onComplite.bind(this) : undefined);

		},

		_setTimeout: function(id, handler, time) {
			var self = this;

			if ( ! id ) {
				handler.bind(self);
			}

			if ( this.timeouts[id] ) {
				window.clearTimeout( this.timeouts[id] );
			}

			this.timeouts[id] = window.setTimeout(handler.bind(self), time);
		}
	};

	var dtPostsIsotopeFilter = $.extend({}, dtPostsJQueryFilter, {
		init: function(settings) {
			this.config = {
				postsContainer: null,
				categoryContainer: null,
				orderByContainer: null,
				orderContainer: null,
				paginatorContainer: null,
				curPage: 1,
				curCategory: '*',
				initialOrder: '',
				order: '',
				orderBy: '',
				postsPerPage: -1,
				items: [],
				isPhone: false
			};

			$.extend( this.config, settings );

			this._setPostsPerPage();
			this._setCategory();
			this._setOrderBy();
			this._setOrder();
			this._setCurPage();
			this._setItems();

			this.config.initialOrder = this.config.order;

			this.setup();
		},

		setup: function() {
			$('a', this.config.paginatorContainer).on('click.dtPostsPaginationFilter', {self: this}, this.paginationFilter);
			$('a', this.config.categoryContainer).on('click.dtPostsCategoryFilter', {self: this}, this.categoryFilter);
			$('a', this.config.orderContainer).on('click.dtPostsOrderFilter', {self: this}, this.orderFilter);
			$('a', this.config.orderByContainer).on('click.dtPostsOrderByFilter', {self: this}, this.orderByFilter);

			this._getActiveElement(this.config.paginatorContainer).trigger('click.dtPostsPaginationFilter', { onSetup: true });
		},

		orderFilter: function(event) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setOrder();
			self._filterPosts();
		},

		orderByFilter: function(event) {
			event.preventDefault();

			var item = $(this);
			var self = event.data.self;

			self._setAsActive(item);
			self._setOrderBy();
			self._filterPosts();
		},

		_filterPosts: function() {
			var self = this;

			if ( self.config.isPhone ) {

				// category filter emulation
				self.config.items.css("display", "none");

				var itemsCount = 0;
				self.config.items.filter(self.config.curCategory).each(function() {
					if ( self._showOnCurPage(++itemsCount) ) {
						$(this).css("display", "inline-block");
					}
				});
				

			} else {
				self.config.postsContainer.isotope({ filter: self.config.curCategory, sortAscending: 'asc' == self.config.order, sortBy: self.config.orderBy });

				if ( self.config.curPage ) {
					self._filterByCurPage();
				}
				setTimeout(function(){
					$(".iso-container").isotope('layout');
				}, 800)
			}
		},

		_filterByCurPage: function() {
			var items = this.config.items.slice(0);
			if ( this.config.initialOrder && this.config.initialOrder != this.config.order ) {
				items.reverse();
			}

			var itemsCount = 0;
			items.map(function(item) {
				if ( ! item.isHidden && ! this._showOnCurPage(++itemsCount) ) {
					item.hide();
				}
			}, this);

			this.config.postsContainer.isotope('layout');
		},

		_setOrderBy: function() {
			this.config.orderBy = this._getActiveElement(this.config.orderByContainer).attr('data-by');
		},

		_setOrder: function() {
			this.config.order = this._getActiveElement(this.config.orderContainer).attr('data-sort');
		},

		_setItems: function() {
			if ( this.config.isPhone ) {
				this.config.items = $(".iso-item, .wf-cell", this.config.postsContainer);
			} else {
				this.config.items = this.config.postsContainer.isotope('getItemElements').map(function(item) { return this.config.postsContainer.isotope('getItem', item); }, this);
			}
		}
	});

	var dtPostsJGridFilter = $.extend({}, dtPostsJQueryFilter, {
		_filterPosts: function() {
			var self = this;

			// category filter emulation
			self.config.items.css("display", "none");

			var itemsCount = 0;
			var visibleItems = [];
			self.config.items.filter(self.config.curCategory).each(function() {
				if ( self._showOnCurPage( ++itemsCount ) ) {
					$(this).css("display", "block");
					visibleItems.push( this );
				}
			});

			visibleItems = $(visibleItems);
			self.config.postsContainer.data('visibleItems', visibleItems);
			self.config.postsContainer.collage({ images: visibleItems });
		},

		_setItems: function() {
			this.config.items = $(".wf-cell", this.config.postsContainer);
		}
	});

	$('.dt-shortcode.with-isotope').each(function() {
		var $this = $(this);
		var $container = $this.find('.wf-container');
		var filterConfig = {
			postsContainer: $container,
			categoryContainer: $this.find('.filter-categories'),
			paginatorContainer: $this.find('.iso-paginator')
		};

		if ( $container.hasClass('dt-isotope') ) {
			var postsFilter = Object.create(dtPostsIsotopeFilter);
			$.extend(filterConfig, {
				orderByContainer: $this.find('.filter-extras .filter-by'),
				orderContainer: $this.find('.filter-extras .filter-sorting'),
				isPhone: dtGlobals.isPhone
			});
		} else {
			var postsFilter = Object.create(dtPostsJGridFilter);
		}

		postsFilter.init(filterConfig);
	});
})


