


(function(a,b){

	// EASINGS
	jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(a,b,c,d,e){return jQuery.easing[jQuery.easing.def](a,b,c,d,e)},easeInQuad:function(a,b,c,d,e){return d*(b/=e)*b+c},easeOutQuad:function(a,b,c,d,e){return-d*(b/=e)*(b-2)+c},easeInOutQuad:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b+c;return-d/2*(--b*(b-2)-1)+c},easeInCubic:function(a,b,c,d,e){return d*(b/=e)*b*b+c},easeOutCubic:function(a,b,c,d,e){return d*((b=b/e-1)*b*b+1)+c},easeInOutCubic:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b+c;return d/2*((b-=2)*b*b+2)+c},easeInQuart:function(a,b,c,d,e){return d*(b/=e)*b*b*b+c},easeOutQuart:function(a,b,c,d,e){return-d*((b=b/e-1)*b*b*b-1)+c},easeInOutQuart:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b+c;return-d/2*((b-=2)*b*b*b-2)+c},easeInQuint:function(a,b,c,d,e){return d*(b/=e)*b*b*b*b+c},easeOutQuint:function(a,b,c,d,e){return d*((b=b/e-1)*b*b*b*b+1)+c},easeInOutQuint:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b*b+c;return d/2*((b-=2)*b*b*b*b+2)+c},easeInSine:function(a,b,c,d,e){return-d*Math.cos(b/e*(Math.PI/2))+d+c},easeOutSine:function(a,b,c,d,e){return d*Math.sin(b/e*(Math.PI/2))+c},easeInOutSine:function(a,b,c,d,e){return-d/2*(Math.cos(Math.PI*b/e)-1)+c},easeInExpo:function(a,b,c,d,e){return b==0?c:d*Math.pow(2,10*(b/e-1))+c},easeOutExpo:function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c},easeInOutExpo:function(a,b,c,d,e){if(b==0)return c;if(b==e)return c+d;if((b/=e/2)<1)return d/2*Math.pow(2,10*(b-1))+c;return d/2*(-Math.pow(2,-10*--b)+2)+c},easeInCirc:function(a,b,c,d,e){return-d*(Math.sqrt(1-(b/=e)*b)-1)+c},easeOutCirc:function(a,b,c,d,e){return d*Math.sqrt(1-(b=b/e-1)*b)+c},easeInOutCirc:function(a,b,c,d,e){if((b/=e/2)<1)return-d/2*(Math.sqrt(1-b*b)-1)+c;return d/2*(Math.sqrt(1-(b-=2)*b)+1)+c},easeInElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return-(h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g))+c},easeOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return h*Math.pow(2,-10*b)*Math.sin((b*e-f)*2*Math.PI/g)+d+c},easeInOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e/2)==2)return c+d;if(!g)g=e*.3*1.5;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);if(b<1)return-.5*h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)+c;return h*Math.pow(2,-10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)*.5+d+c},easeInBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*(b/=e)*b*((f+1)*b-f)+c},easeOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*((b=b/e-1)*b*((f+1)*b+f)+1)+c},easeInOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;if((b/=e/2)<1)return d/2*b*b*(((f*=1.525)+1)*b-f)+c;return d/2*((b-=2)*b*(((f*=1.525)+1)*b+f)+2)+c},easeInBounce:function(a,b,c,d,e){return d-jQuery.easing.easeOutBounce(a,e-b,0,d,e)+c},easeOutBounce:function(a,b,c,d,e){if((b/=e)<1/2.75){return d*7.5625*b*b+c}else if(b<2/2.75){return d*(7.5625*(b-=1.5/2.75)*b+.75)+c}else if(b<2.5/2.75){return d*(7.5625*(b-=2.25/2.75)*b+.9375)+c}else{return d*(7.5625*(b-=2.625/2.75)*b+.984375)+c}},easeInOutBounce:function(a,b,c,d,e){if(b<e/2)return jQuery.easing.easeInBounce(a,b*2,0,d,e)*.5+c;return jQuery.easing.easeOutBounce(a,b*2-e,0,d,e)*.5+d*.5+c}})


	// WAIT FOR IMAGES
	/*
	* waitForImages 1.4
	* -----------------
	* Provides a callback when all images have loaded in your given selector.
	* http://www.alexanderdickson.com/
	*
	*
	* Copyright (c) 2011 Alex Dickson
	* Licensed under the MIT licenses.
	* See website for more info.
	*
	*/
	a.waitForImages={hasImageProperties:["backgroundImage","listStyleImage","borderImage","borderCornerImage"]};a.expr[":"].uncached=function(b){var c=document.createElement("img");c.src=b.src;return a(b).is('img[src!=""]')&&!c.complete};a.fn.waitForImages=function(b,c,d){if(a.isPlainObject(arguments[0])){c=b.each;d=b.waitForAll;b=b.finished}b=b||a.noop;c=c||a.noop;d=!!d;if(!a.isFunction(b)||!a.isFunction(c)){throw new TypeError("An invalid callback was supplied.")}return this.each(function(){var e=a(this),f=[];if(d){var g=a.waitForImages.hasImageProperties||[],h=/url\((['"]?)(.*?)\1\)/g;e.find("*").each(function(){var b=a(this);if(b.is("img:uncached")){f.push({src:b.attr("src"),element:b[0]})}a.each(g,function(a,c){var d=b.css(c);if(!d){return true}var e;while(e=h.exec(d)){f.push({src:e[2],element:b[0]})}})})}else{e.find("img:uncached").each(function(){f.push({src:this.src,element:this})})}var i=f.length,j=0;if(i==0){b.call(e[0])}a.each(f,function(d,f){var g=new Image;a(g).bind("load error",function(a){j++;c.call(f.element,j,i,a.type=="load");if(j==i){b.call(e[0]);return false}});g.src=f.src})})}


	// CSS ANIMATE
	/**************************************\
	 *  cssAnimate 1.1.5 for jQuery       *
	 *  (c) 2012 - Clemens Damke          *
	 *  Licensed under MIT License        *
	 *  Works with jQuery >=1.4.3         *
	/**************************************/
	var b=["Webkit","Moz","O","Ms","Khtml",""];var c=["borderRadius","boxShadow","userSelect","transformOrigin","transformStyle","transition","transitionDuration","transitionProperty","transitionTimingFunction","backgroundOrigin","backgroundSize","animation","filter","zoom","columns","perspective","perspectiveOrigin","appearance"];a.fn.cssSetQueue=function(e,t){v=this;var n=v.data("cssQueue")?v.data("cssQueue"):[];var r=v.data("cssCall")?v.data("cssCall"):[];var i=0;var s={};a.each(t,function(e,t){s[e]=t});while(1){if(!r[i]){r[i]=s.complete;break}i++}s.complete=i;n.push([e,s]);v.data({cssQueue:n,cssRunning:true,cssCall:r})};a.fn.cssRunQueue=function(){v=this;var e=v.data("cssQueue")?v.data("cssQueue"):[];if(e[0])v.cssEngine(e[0][0],e[0][1]);else v.data("cssRunning",false);e.shift();v.data("cssQueue",e)};a.cssMerge=function(e,t,n){a.each(t,function(t,r){a.each(n,function(n,i){e[i+t]=r})});return e};a.fn.cssAnimationData=function(e,t){var n=this;var r=n.data("cssAnimations");if(!r)r={};if(!r[e])r[e]=[];r[e].push(t);n.data("cssAnimations",r);return r[e]};a.fn.cssAnimationRemove=function(){var e=this;if(e.data("cssAnimations")!=undefined){var t=e.data("cssAnimations");var n=e.data("identity");a.each(t,function(e,r){t[e]=r.splice(n+1,1)});e.data("cssAnimations",t)}};a.css3D=function(e){a("body").data("cssPerspective",isFinite(e)?e:e?1e3:0).cssOriginal(a.cssMerge({},{TransformStyle:e?"preserve-3d":"flat"},b))};a.cssPropertySupporter=function(e){a.each(c,function(t,n){if(e[n])a.each(b,function(t,r){var i=n.substr(0,1);e[r+i[r?"toUpperCase":"toLowerCase"]()+n.substr(1)]=e[n]})});return e};a.cssAnimateSupport=function(){var e=false;a.each(b,function(t,n){e=document.body.style[n+"AnimationName"]!==undefined?true:e});return e};a.fn.cssEngine=function(e,t){function n(e){return String(e).replace(/([A-Z])/g,"-jQuery1").toLowerCase()}var r=this;var r=this;if(typeof t.complete=="number")r.data("cssCallIndex",t.complete);var i={linear:"linear",swing:"ease",easeIn:"ease-in",easeOut:"ease-out",easeInOut:"ease-in-out"};var s={};var o=a("body").data("cssPerspective");if(e.transform)a.each(b,function(t,i){var u=i+(i?"T":"t")+"ransform";var a=r.cssOriginal(n(u));var f=e.transform;if(!a||a=="none")s[u]="scale(1)";e[u]=(o&&!/perspective/gi.test(f)?"perspective("+o+") ":"")+f});e=a.cssPropertySupporter(e);var u=[];a.each(e,function(e,t){u.push(n(e))});var f=false;var l=[];var c=[];if(u!=undefined){for(var h=0;h<u.length;h++){l.push(String(t.duration/1e3)+"s");var p=i[t.easing];c.push(p?p:t.easing)}l=r.cssAnimationData("dur",l.join(", ")).join(", ");c=r.cssAnimationData("eas",c.join(", ")).join(", ");var d=r.cssAnimationData("prop",u.join(", "));r.data("identity",d.length-1);d=d.join(", ");var v={TransitionDuration:l,TransitionProperty:d,TransitionTimingFunction:c};var m={};m=a.cssMerge(m,v,b);var g=e;a.extend(m,e);if(m.display=="callbackHide")f=true;else if(m.display)s["display"]=m.display;r.cssOriginal(s)}setTimeout(function(){r.cssOriginal(m);var e=r.data("runningCSS");e=!e?g:a.extend(e,g);r.data("runningCSS",e);setTimeout(function(){r.data("cssCallIndex","a");if(f)r.cssOriginal("display","none");r.cssAnimationRemove();if(t.queue)r.cssRunQueue();if(typeof t.complete=="number"){r.data("cssCall")[t.complete].call(r);r.data("cssCall")[t.complete]=0}else t.complete.call(r)},t.duration)},0)};a.str2Speed=function(e){return isNaN(e)?e=="slow"?1e3:e=="fast"?200:600:e};a.fn.cssAnimate=function(e,t,n,r){var i=this;var s={duration:0,easing:"swing",complete:function(){},queue:true};var o={};o=typeof t=="object"?t:{duration:t};o[n?typeof n=="function"?"complete":"easing":0]=n;o[r?"complete":0]=r;o.duration=a.str2Speed(o.duration);a.extend(s,o);if(a.cssAnimateSupport()){i.each(function(t,n){n=a(n);if(s.queue){var r=!n.data("cssRunning");n.cssSetQueue(e,s);if(r)n.cssRunQueue()}else n.cssEngine(e,s)})}else i.animate(e,s);return i};a.cssPresetOptGen=function(e,t){var n={};n[e?typeof e=="function"?"complete":"easing":0]=e;n[t?"complete":0]=t;return n};a.fn.cssFadeTo=function(e,t,n,r){var i=this;opt=a.cssPresetOptGen(n,r);var s={opacity:t};opt.duration=e;if(a.cssAnimateSupport()){i.each(function(e,n){n=a(n);if(n.data("displayOriginal")!=n.cssOriginal("display")&&n.cssOriginal("display")!="none")n.data("displayOriginal",n.cssOriginal("display")?n.cssOriginal("display"):"block");else n.data("displayOriginal","block");s.display=t?n.data("displayOriginal"):"callbackHide";n.cssAnimate(s,opt)})}else i.fadeTo(e,opt);return i};a.fn.cssFadeOut=function(e,t,n){if(a.cssAnimateSupport()){if(!this.cssOriginal("opacity"))this.cssOriginal("opacity",1);this.cssFadeTo(e,0,t,n)}else this.fadeOut(e,t,n);return this};a.fn.cssFadeIn=function(e,t,n){if(a.cssAnimateSupport()){if(this.cssOriginal("opacity"))this.cssOriginal("opacity",0);this.cssFadeTo(e,1,t,n)}else this.fadeIn(e,t,n);return this};a.cssPx2Int=function(e){return e.split("p")[0]*1};a.fn.cssStop=function(){var e=this,t=0;e.data("cssAnimations",false).each(function(n,r){r=a(r);var i={TransitionDuration:"0s"};var s=r.data("runningCSS");var o={};if(s)a.each(s,function(e,t){t=isFinite(a.cssPx2Int(t))?a.cssPx2Int(t):t;var n=[0,1];var r={color:["#000","#fff"],background:["#000","#fff"],"float":["none","left"],clear:["none","left"],border:["none","0px solid #fff"],position:["absolute","relative"],family:["Arial","Helvetica"],display:["none","block"],visibility:["hidden","visible"],transform:["translate(0,0)","scale(1)"]};a.each(r,function(t,r){if((new RegExp(t,"gi")).test(e))n=r});o[e]=n[0]!=t?n[0]:n[1]});else s={};i=a.cssMerge(o,i,b);r.cssOriginal(i);setTimeout(function(){var n=a(e[t]);n.cssOriginal(s).data({runningCSS:{},cssAnimations:{},cssQueue:[],cssRunning:false});if(typeof n.data("cssCallIndex")=="number")n.data("cssCall")[n.data("cssCallIndex")].call(n);n.data("cssCall",[]);t++},0)});return e};a.fn.cssDelay=function(e){return this.cssAnimate({},e)};if(a.fn.cssOriginal!=undefined)a.fn.css=a.fn.cssOriginal;a.fn.cssOriginal=a.fn.css;var LEFT="left",RIGHT="right",UP="up",DOWN="down",IN="in",OUT="out",NONE="none",AUTO="auto",HORIZONTAL="horizontal",VERTICAL="vertical",ALL_FINGERS="all",PHASE_START="start",PHASE_MOVE="move",PHASE_END="end",PHASE_CANCEL="cancel",SUPPORTS_TOUCH="ontouchstart"in window,PLUGIN_NS="TouchSwipe";var defaults={fingers:1,threshold:75,maxTimeThreshold:null,swipe:null,swipeLeft:null,swipeRight:null,swipeUp:null,swipeDown:null,swipeStatus:null,pinchIn:null,pinchOut:null,pinchStatus:null,click:null,triggerOnTouchEnd:true,allowPageScroll:"auto",fallbackToMouseEvents:true,excludedElements:"button, input, select, textarea, a, .noSwipe"}


	/*
* touchSwipe - jQuery Plugin
* https://github.com/mattbryson/TouchSwipe-Jquery-Plugin
* http://labs.skinkers.com/touchSwipe/
* http://plugins.jquery.com/project/touchSwipe
*
* Copyright (c) 2010 Matt Bryson (www.skinkers.com)
* Dual licensed under the MIT or GPL Version 2 licenses.
*
* jQueryversion: 1.5.1
*
* Changelog
* jQueryDate: 2010-12-12 (Wed, 12 Dec 2010) jQuery
* jQueryversion: 1.0.0
* jQueryversion: 1.0.1 - removed multibyte comments
*
* jQueryDate: 2011-21-02 (Mon, 21 Feb 2011) jQuery
* jQueryversion: 1.1.0 	- added allowPageScroll property to allow swiping and scrolling of page
*					- changed handler signatures so one handler can be used for multiple events
* jQueryDate: 2011-23-02 (Wed, 23 Feb 2011) jQuery
* jQueryversion: 1.2.0 	- added click handler. This is fired if the user simply clicks and does not swipe. The event object and click target are passed to handler.
*					- If you use the http://code.google.com/p/jquery-ui-for-ipad-and-iphone/ plugin, you can also assign jQuery mouse events to children of a touchSwipe object.
* jQueryversion: 1.2.1 	- removed console log!
*
* jQueryversion: 1.2.2 	- Fixed bug where scope was not preserved in callback methods.
*
* jQueryDate: 2011-28-04 (Thurs, 28 April 2011) jQuery
* jQueryversion: 1.2.4 	- Changed licence terms to be MIT or GPL inline with jQuery. Added check for support of touch events to stop non compatible browsers erroring.
*
* jQueryDate: 2011-27-09 (Tues, 27 September 2011) jQuery
* jQueryversion: 1.2.5 	- Added support for testing swipes with mouse on desktop browser (thanks to https://github.com/joelhy)
*
* jQueryDate: 2012-14-05 (Mon, 14 May 2012) jQuery
* jQueryversion: 1.2.6 	- Added timeThreshold between start and end touch, so user can ignore slow swipes (thanks to Mark Chase). Default is null, all swipes are detected
*
* jQueryDate: 2012-05-06 (Tues, 05 June 2012) jQuery
* jQueryversion: 1.2.7 	- Changed time threshold to have null default for backwards compatibility. Added duration param passed back in events, and refactored how time is handled.
*
* jQueryDate: 2012-05-06 (Tues, 05 June 2012) jQuery
* jQueryversion: 1.2.8 	- Added the possibility to return a value like null or false in the trigger callback. In that way we can control when the touch start/move should take effect or not (simply by returning in some cases return null; or return false;) This effects the ontouchstart/ontouchmove event.
*
* jQueryDate: 2012-06-06 (Wed, 06 June 2012) jQuery
* jQueryversion: 1.3.0 	- Refactored whole plugin to allow for methods to be executed, as well as exposed defaults for user override. Added 'enable', 'disable', and 'destroy' methods
*
* jQueryDate: 2012-05-06 (Fri, 05 June 2012) jQuery
* jQueryversion: 1.3.1 	- Bug fixes  - bind() with false as last argument is no longer supported in jQuery 1.6, also, if you just click, the duration is now returned correctly.
*
* jQueryDate: 2012-29-07 (Sun, 29 July 2012) jQuery
* jQueryversion: 1.3.2	- Added fallbackToMouseEvents option to NOT capture mouse events on non touch devices.
* 			- Added "all" fingers value to the fingers property, so any combinatin of fingers triggers the swipe, allowing event handlers to check the finger count
*
* jQueryDate: 2012-09-08 (Thurs, 9 Aug 2012) jQuery
* jQueryversion: 1.3.3	- Code tidy prep for minified version
*
* jQueryDate: 2012-04-10 (wed, 4 Oct 2012) jQuery
* jQueryversion: 1.4.0	- Added pinch support, pinchIn and pinchOut
*
* jQueryDate: 2012-11-10 (Thurs, 11 Oct 2012) jQuery
* jQueryversion: 1.5.0	- Added excludedElements, a jquery selector that specifies child elements that do NOT trigger swipes. By default, this is one select that removes all form, input select, button and anchor elements.
*
* jQueryDate: 2012-22-10 (Mon, 22 Oct 2012) jQuery
* jQueryversion: 1.5.1	- Fixed bug with jQuery 1.8 and trailing comma in excludedElements
*
* A jQuery plugin to capture left, right, up and down swipes on touch devices.
* You can capture 2 finger or 1 finger swipes, set the threshold and define either a catch all handler, or individual direction handlers.
* Options: The defaults can be overridden by setting them in jQuery.fn.swipe.defaults
* 		swipe 			Function 	A catch all handler that is triggered for all swipe directions. Handler is passed 3 arguments, the original event object, the direction of the swipe : "left", "right", "up", "down" , the distance of the swipe, the duration of the swipe and the finger count.
* 		swipeLeft		Function 	A handler that is triggered for "left" swipes. Handler is passed 3 arguments, the original event object, the direction of the swipe : "left", "right", "up", "down"  , the distance of the swipe, the duration of the swipe and the finger count.
* 		swipeRight		Function 	A handler that is triggered for "right" swipes. Handler is passed 3 arguments, the original event object, the direction of the swipe : "left", "right", "up", "down"  , the distance of the swipe, the duration of the swipe and the finger count.
* 		swipeUp			Function 	A handler that is triggered for "up" swipes. Handler is passed 3 arguments, the original event object, the direction of the swipe : "left", "right", "up", "down" , the distance of the swipe, the duration of the swipe and the finger count.
* 		swipeDown		Function 	A handler that is triggered for "down" swipes. Handler is passed 3 arguments, the original event object, the direction of the swipe : "left", "right", "up", "down"  , the distance of the swipe, the duration of the swipe and the finger count.
*		swipeStatus 	Function 	A handler triggered for every phase of the swipe. Handler is passed 4 arguments: event : The original event object, phase:The current swipe phase, either "start", "move", "end" or "cancel". direction : The swipe direction, either "up?, "down?, "left " or "right?.distance : The distance of the swipe.Duration : The duration of the swipe :  The finger count
*
* 		pinchIn			Function 	A handler triggered when the user pinch zooms inward. Handler is passed
* 		pinchOut		Function 	A handler triggered when the user pinch zooms outward. Handler is passed
* 		pinchStatus		Function 	A handler triggered for every phase of a pinch. Handler is passed 4 arguments: event : The original event object, phase:The current swipe face, either "start", "move", "end" or "cancel". direction : The swipe direction, either "in" or "out". distance : The distance of the pinch, zoom: the pinch zoom level
*
* 		click			Function	A handler triggered when a user just clicks on the item, rather than swipes it. If they do not move, click is triggered, if they do move, it is not.
*
* 		fingers 		int 		Default 1. 	The number of fingers to trigger the swipe, 1 or 2.
* 		threshold 		int  		Default 75.	The number of pixels that the user must move their finger by before it is considered a swipe.
* 		maxTimeThreshold 	int  		Default null. Time, in milliseconds, between touchStart and touchEnd must NOT exceed in order to be considered a swipe.
*		triggerOnTouchEnd Boolean Default true If true, the swipe events are triggered when the touch end event is received (user releases finger).  If false, it will be triggered on reaching the threshold, and then cancel the touch event automatically.
*		allowPageScroll String Default "auto". How the browser handles page scrolls when the user is swiping on a touchSwipe object.
*										"auto" : all undefined swipes will cause the page to scroll in that direction.
*										"none" : the page will not scroll when user swipes.
*										"horizontal" : will force page to scroll on horizontal swipes.
*										"vertical" : will force page to scroll on vertical swipes.
*		fallbackToMouseEvents 	Boolean		Default true	if true mouse events are used when run on a non touch device, false will stop swipes being triggered by mouse events on non tocuh devices
*
*		excludedElements	String 	jquery selector that specifies child elements that do NOT trigger swipes. By default, this is one select that removes all input, select, textarea, button and anchor elements as well as any .noSwipe classes.
*
* Methods: To be executed as strings, jQueryel.swipe('disable');
*		disable		Will disable all touch events until enabled again
*		enable		Will re-enable the touch events
*		destroy		Will kill the plugin, and it must be re-instantiated if it needs to be used again
*
* This jQuery plugin will only run on devices running Mobile Webkit based browsers (iOS 2.0+, android 2.2+)
*/


	function init(e){if(e&&e.allowPageScroll===undefined&&(e.swipe!==undefined||e.swipeStatus!==undefined)){e.allowPageScroll=NONE}if(!e){e={}}e=jQuery.extend({},jQuery.fn.swipe.defaults,e);return this.each(function(){var t=jQuery(this);var n=t.data(PLUGIN_NS);if(!n){n=new touchSwipe(this,e);t.data(PLUGIN_NS,n)}})}function touchSwipe(e,t){function E(e){if(q())return;if(jQuery(e.target).closest(t.excludedElements,d).length>0)return;e=e.originalEvent;var n,r=SUPPORTS_TOUCH?e.touches[0]:e;v=PHASE_START;if(SUPPORTS_TOUCH){m=e.touches.length}else{e.preventDefault()}u=0;a=null;p=null;f=0;l=0;c=0;h=1;g=U();if(!SUPPORTS_TOUCH||m===t.fingers||t.fingers===ALL_FINGERS||F()){g[0].start.x=g[0].end.x=r.pageX;g[0].start.y=g[0].end.y=r.pageY;y=B();if(m==2){g[1].start.x=g[1].end.x=e.touches[1].pageX;g[1].start.y=g[1].end.y=e.touches[1].pageY;l=c=O(g[0].start,g[1].start)}if(t.swipeStatus||t.pinchStatus){n=N(e,v)}}else{T(e);n=false}if(n===false){v=PHASE_CANCEL;N(e,v);return n}else{R(true);d.bind(i,S);d.bind(s,x)}}function S(e){e=e.originalEvent;if(v===PHASE_END||v===PHASE_CANCEL)return;var n,r=SUPPORTS_TOUCH?e.touches[0]:e;g[0].end.x=SUPPORTS_TOUCH?e.touches[0].pageX:r.pageX;g[0].end.y=SUPPORTS_TOUCH?e.touches[0].pageY:r.pageY;b=B();a=H(g[0].start,g[0].end);if(SUPPORTS_TOUCH){m=e.touches.length}v=PHASE_MOVE;if(m==2){if(l==0){g[1].start.x=e.touches[1].pageX;g[1].start.y=e.touches[1].pageY;l=c=O(g[0].start,g[1].start)}else{g[1].end.x=e.touches[1].pageX;g[1].end.y=e.touches[1].pageY;c=O(g[0].end,g[1].end);p=_(g[0].end,g[1].end)}h=M(l,c)}if(m===t.fingers||t.fingers===ALL_FINGERS||!SUPPORTS_TOUCH){L(e,a);u=D(g[0].start,g[0].end);f=A(g[0].start,g[0].end);if(t.swipeStatus||t.pinchStatus){n=N(e,v)}if(!t.triggerOnTouchEnd){var i=!k();if(C()===true){v=PHASE_END;n=N(e,v)}else if(i){v=PHASE_CANCEL;N(e,v)}}}else{v=PHASE_CANCEL;N(e,v)}if(n===false){v=PHASE_CANCEL;N(e,v)}}function x(e){e=e.originalEvent;if(e.touches&&e.touches.length>0)return true;e.preventDefault();b=B();if(l!=0){c=O(g[0].end,g[1].end);h=M(l,c);p=_(g[0].end,g[1].end)}u=D(g[0].start,g[0].end);a=H(g[0].start,g[0].end);f=A();if(t.triggerOnTouchEnd||t.triggerOnTouchEnd===false&&v===PHASE_MOVE){v=PHASE_END;var n=I()||!F();var r=m===t.fingers||t.fingers===ALL_FINGERS||!SUPPORTS_TOUCH;var o=g[0].end.x!==0;var y=r&&o&&n;if(y){var w=k();var E=C();if((E===true||E===null)&&w){N(e,v)}else if(!w||E===false){v=PHASE_CANCEL;N(e,v)}}else{v=PHASE_CANCEL;N(e,v)}}else if(v===PHASE_MOVE){v=PHASE_CANCEL;N(e,v)}d.unbind(i,S,false);d.unbind(s,x,false);R(false)}function T(){m=0;b=0;y=0;l=0;c=0;h=1;R(false)}function N(e,n){var r=undefined;if(t.swipeStatus){r=t.swipeStatus.call(d,e,n,a||null,u||0,f||0,m)}if(t.pinchStatus&&I()){r=t.pinchStatus.call(d,e,n,p||null,c||0,f||0,m,h)}if(n===PHASE_CANCEL){if(t.click&&(m===1||!SUPPORTS_TOUCH)&&(isNaN(u)||u===0)){r=t.click.call(d,e,e.target)}}if(n==PHASE_END){if(t.swipe){r=t.swipe.call(d,e,a,u,f,m)}switch(a){case LEFT:if(t.swipeLeft){r=t.swipeLeft.call(d,e,a,u,f,m)}break;case RIGHT:if(t.swipeRight){r=t.swipeRight.call(d,e,a,u,f,m)}break;case UP:if(t.swipeUp){r=t.swipeUp.call(d,e,a,u,f,m)}break;case DOWN:if(t.swipeDown){r=t.swipeDown.call(d,e,a,u,f,m)}break}switch(p){case IN:if(t.pinchIn){r=t.pinchIn.call(d,e,p||null,c||0,f||0,m,h)}break;case OUT:if(t.pinchOut){r=t.pinchOut.call(d,e,p||null,c||0,f||0,m,h)}break}}if(n===PHASE_CANCEL||n===PHASE_END){T(e)}return r}function C(){if(t.threshold!==null){return u>=t.threshold}return null}function k(){var e;if(t.maxTimeThreshold){if(f>=t.maxTimeThreshold){e=false}else{e=true}}else{e=true}return e}function L(e,n){if(t.allowPageScroll===NONE||F()){e.preventDefault()}else{var r=t.allowPageScroll===AUTO;switch(n){case LEFT:if(t.swipeLeft&&r||!r&&t.allowPageScroll!=HORIZONTAL){e.preventDefault()}break;case RIGHT:if(t.swipeRight&&r||!r&&t.allowPageScroll!=HORIZONTAL){e.preventDefault()}break;case UP:if(t.swipeUp&&r||!r&&t.allowPageScroll!=VERTICAL){e.preventDefault()}break;case DOWN:if(t.swipeDown&&r||!r&&t.allowPageScroll!=VERTICAL){e.preventDefault()}break}}}function A(){return b-y}function O(e,t){var n=Math.abs(e.x-t.x);var r=Math.abs(e.y-t.y);return Math.round(Math.sqrt(n*n+r*r))}function M(e,t){var n=t/e*1;return n.toFixed(2)}function _(){if(h<1){return OUT}else{return IN}}function D(e,t){return Math.round(Math.sqrt(Math.pow(t.x-e.x,2)+Math.pow(t.y-e.y,2)))}function P(e,t){var n=e.x-t.x;var r=t.y-e.y;var i=Math.atan2(r,n);var s=Math.round(i*180/Math.PI);if(s<0){s=360-Math.abs(s)}return s}function H(e,t){var n=P(e,t);if(n<=45&&n>=0){return LEFT}else if(n<=360&&n>=315){return LEFT}else if(n>=135&&n<=225){return RIGHT}else if(n>45&&n<135){return DOWN}else{return UP}}function B(){var e=new Date;return e.getTime()}function j(){d.unbind(r,E);d.unbind(o,T);d.unbind(i,S);d.unbind(s,x);R(false)}function F(){return t.pinchStatus||t.pinchIn||t.pinchOut}function I(){return p&&F()}function q(){return d.data(PLUGIN_NS+"_intouch")===true?true:false}function R(e){e=e===true?true:false;d.data(PLUGIN_NS+"_intouch",e)}function U(){var e=[];for(var t=0;t<=5;t++){e.push({start:{x:0,y:0},end:{x:0,y:0},delta:{x:0,y:0}})}return e}var n=SUPPORTS_TOUCH||!t.fallbackToMouseEvents,r=n?"touchstart":"mousedown",i=n?"touchmove":"mousemove",s=n?"touchend":"mouseup",o="touchcancel";var u=0;var a=null;var f=0;var l=0;var c=0;var h=1;var p=0;var d=jQuery(e);var v="start";var m=0;var g=null;var y=0;var b=0;try{d.bind(r,E);d.bind(o,T)}catch(w){jQuery.error("events not supported "+r+","+o+" on jQuery.swipe")}this.enable=function(){d.bind(r,E);d.bind(o,T);return d};this.disable=function(){j();return d};this.destroy=function(){j();d.data(PLUGIN_NS,null);return d};}jQuery.fn.swipe=function(e){var t=jQuery(this),n=t.data(PLUGIN_NS);if(n&&typeof e==="string"){if(n[e]){return n[e].apply(this,Array.prototype.slice.call(arguments,1))}else{jQuery.error("Method "+e+" does not exist on jQuery.swipe")}}else if(!n&&(typeof e==="object"||!e)){return init.apply(this,arguments)}return t};jQuery.fn.swipe.defaults=defaults;jQuery.fn.swipe.phases={PHASE_START:PHASE_START,PHASE_MOVE:PHASE_MOVE,PHASE_END:PHASE_END,PHASE_CANCEL:PHASE_CANCEL};jQuery.fn.swipe.directions={LEFT:LEFT,RIGHT:RIGHT,UP:UP,DOWN:DOWN,IN:IN,OUT:OUT};jQuery.fn.swipe.pageScroll={NONE:NONE,HORIZONTAL:HORIZONTAL,VERTICAL:VERTICAL,AUTO:AUTO};jQuery.fn.swipe.fingers={ONE:1,TWO:2,THREE:3,ALL:ALL_FINGERS}


})(jQuery)

