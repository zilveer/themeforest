/*
 * QueryLoader v2 - A simple script to create a preloader for images
 *
 * For instructions read the original post:
 * http://www.gayadesign.com/diy/queryloader2-preload-your-images-with-ease/
 *
 * Copyright (c) 2011 - Gaya Kessler
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Version:  2.9.0
 * Last update: 2014-01-31
 */!function(e){function t(e){this.parent=e,this.container,this.loadbar,this.percentageContainer,this.logo}function n(e){this.toPreload=[],this.parent=e,this.container}function r(e){this.element,this.parent=e}function i(r,i){this.element=r,this.$element=e(r),this.options=i,this.foundUrls=[],this.destroyed=!1,this.imageCounter=0,this.imageDone=0,this.alreadyLoaded=!1,this.preloadContainer=new n(this),this.overlayLoader=new t(this),this.defaultOptions={onComplete:function(){},onLoadComplete:function(){},backgroundColor:"#000",barColor:"#fff",overlayId:"qLoverlay",barHeight:1,percentage:!1,deepSearch:!0,completeAnimation:"fade",minimumTime:500},this.init()}!function(e){"use strict";function t(t){var n=e.event;return n.target=n.target||n.srcElement||t,n}var n=document.documentElement,r=function(){};n.addEventListener?r=function(e,t,n){e.addEventListener(t,n,!1)}:n.attachEvent&&(r=function(e,n,r){e[n+r]=r.handleEvent?function(){var n=t(e);r.handleEvent.call(r,n)}:function(){var n=t(e);r.call(e,n)},e.attachEvent("on"+n,e[n+r])});var i=function(){};n.removeEventListener?i=function(e,t,n){e.removeEventListener(t,n,!1)}:n.detachEvent&&(i=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(r){e[t+n]=void 0}});var s={bind:r,unbind:i};"function"==typeof define&&define.amd?define(s):"object"==typeof exports?module.exports=s:e.eventie=s}(this),function(){"use strict";function e(){}function t(e,t){for(var n=e.length;n--;)if(e[n].listener===t)return n;return-1}function n(e){return function(){return this[e].apply(this,arguments)}}var r=e.prototype,i=this,s=i.EventEmitter;r.getListeners=function(e){var t,n,r=this._getEvents();if(e instanceof RegExp){t={};for(n in r)r.hasOwnProperty(n)&&e.test(n)&&(t[n]=r[n])}else t=r[e]||(r[e]=[]);return t},r.flattenListeners=function(e){var t,n=[];for(t=0;t<e.length;t+=1)n.push(e[t].listener);return n},r.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},r.addListener=function(e,n){var r,i=this.getListenersAsObject(e),s="object"==typeof n;for(r in i)i.hasOwnProperty(r)&&-1===t(i[r],n)&&i[r].push(s?n:{listener:n,once:!1});return this},r.on=n("addListener"),r.addOnceListener=function(e,t){return this.addListener(e,{listener:t,once:!0})},r.once=n("addOnceListener"),r.defineEvent=function(e){return this.getListeners(e),this},r.defineEvents=function(e){for(var t=0;t<e.length;t+=1)this.defineEvent(e[t]);return this},r.removeListener=function(e,n){var r,i,s=this.getListenersAsObject(e);for(i in s)s.hasOwnProperty(i)&&(r=t(s[i],n),-1!==r&&s[i].splice(r,1));return this},r.off=n("removeListener"),r.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},r.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},r.manipulateListeners=function(e,t,n){var r,i,s=e?this.removeListener:this.addListener,o=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(r=n.length;r--;)s.call(this,t,n[r]);else for(r in t)t.hasOwnProperty(r)&&(i=t[r])&&("function"==typeof i?s.call(this,r,i):o.call(this,r,i));return this},r.removeEvent=function(e){var t,n=typeof e,r=this._getEvents();if("string"===n)delete r[e];else if(e instanceof RegExp)for(t in r)r.hasOwnProperty(t)&&e.test(t)&&delete r[t];else delete this._events;return this},r.removeAllListeners=n("removeEvent"),r.emitEvent=function(e,t){var n,r,i,s,o=this.getListenersAsObject(e);for(i in o)if(o.hasOwnProperty(i))for(r=o[i].length;r--;)n=o[i][r],n.once===!0&&this.removeListener(e,n.listener),s=n.listener.apply(this,t||[]),s===this._getOnceReturnValue()&&this.removeListener(e,n.listener);return this},r.trigger=n("emitEvent"),r.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},r.setOnceReturnValue=function(e){return this._onceReturnValue=e,this},r._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},r._getEvents=function(){return this._events||(this._events={})},e.noConflict=function(){return i.EventEmitter=s,e},"function"==typeof define&&define.amd?define(function(){return e}):"object"==typeof module&&module.exports?module.exports=e:this.EventEmitter=e}.call(this),function(e,t){"use strict";"function"==typeof define&&define.amd?define(["eventEmitter/EventEmitter","eventie/eventie"],function(n,r){return t(e,n,r)}):"object"==typeof exports?module.exports=t(e,require("eventEmitter"),require("eventie")):e.imagesLoaded=t(e,e.EventEmitter,e.eventie)}(this,function(e,t,n){"use strict";function r(e,t){for(var n in t)e[n]=t[n];return e}function i(e){return"[object Array]"===h.call(e)}function s(e){var t=[];if(i(e))t=e;else if("number"==typeof e.length)for(var n=0,r=e.length;r>n;n++)t.push(e[n]);else t.push(e);return t}function o(e,t,n){if(!(this instanceof o))return new o(e,t);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=s(e),this.options=r({},this.options),"function"==typeof t?n=t:r(this.options,t),n&&this.on("always",n),this.getImages(),f&&(this.jqDeferred=new f.Deferred);var i=this;setTimeout(function(){i.check()})}function u(e){this.img=e}function a(e){this.src=e,p[e]=this}var f=e.jQuery,l=e.console,c="undefined"!=typeof l,h=Object.prototype.toString;o.prototype=new t,o.prototype.options={},o.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);for(var r=n.querySelectorAll("img"),i=0,s=r.length;s>i;i++){var o=r[i];this.addImage(o)}}},o.prototype.addImage=function(e){var t=new u(e);this.images.push(t)},o.prototype.check=function(){function e(e){return t.options.debug&&c,t.progress(e),n++,n===r&&t.complete(),!0}var t=this,n=0,r=this.images.length;if(this.hasAnyBroken=!1,!r)return this.complete(),void 0;for(var i=0;r>i;i++){var s=this.images[i];s.on("confirm",e),s.check()}},o.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded;var t=this;setTimeout(function(){t.emit("progress",t,e),t.jqDeferred&&t.jqDeferred.notify&&t.jqDeferred.notify(t,e)})},o.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";this.isComplete=!0;var t=this;setTimeout(function(){if(t.emit(e,t),t.emit("always",t),t.jqDeferred){var n=t.hasAnyBroken?"reject":"resolve";t.jqDeferred[n](t)}})},f&&(f.fn.imagesLoaded=function(e,t){var n=new o(this,e,t);return n.jqDeferred.promise(f(this))}),u.prototype=new t,u.prototype.check=function(){var e=p[this.img.src]||new a(this.img.src);if(e.isConfirmed)return this.confirm(e.isLoaded,"cached was confirmed"),void 0;if(this.img.complete&&void 0!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void 0;var t=this;e.on("confirm",function(e,n){return t.confirm(e.isLoaded,n),!0}),e.check()},u.prototype.confirm=function(e,t){this.isLoaded=e,this.emit("confirm",this,t)};var p={};return a.prototype=new t,a.prototype.check=function(){if(!this.isChecked){var e=new Image;n.bind(e,"load",this),n.bind(e,"error",this),e.src=this.src,this.isChecked=!0}},a.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},a.prototype.onload=function(e){this.confirm(!0,"onload"),this.unbindProxyEvents(e)},a.prototype.onerror=function(e){this.confirm(!1,"onerror"),this.unbindProxyEvents(e)},a.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},a.prototype.unbindProxyEvents=function(e){n.unbind(e.target,"load",this),n.unbind(e.target,"error",this)},o}),t.prototype.createOverlay=function(){var t="absolute";if("body"==this.parent.element.tagName.toLowerCase())t="fixed";else{var n=this.parent.$element.css("position");("fixed"!=n||"absolute"!=n)&&this.parent.$element.css("position","relative")}this.container=e("<div id='"+this.parent.options.overlayId+"'><div  class='qLlogo'><img src="+this.parent.options.logo+"></img></div></div>").css({width:"100%",height:"100%",backgroundColor:this.parent.options.backgroundColor,backgroundPosition:"fixed",position:t,zIndex:666999,top:0,left:0}).appendTo(this.parent.$element),this.loadbar=e("<div id='qLbar'></div>").css({height:this.parent.options.barHeight+"px",marginTop:"-"+this.parent.options.barHeight/2+"px",backgroundColor:this.parent.options.barColor,width:"0%",position:"absolute",top:"50%"}).appendTo(this.container),1==this.parent.options.percentage&&(this.percentageContainer=e("<div id='qLpercentage'></div>").text("0%").css({height:"50px",width:"130px",position:"absolute",fontSize:"50px",fontWeight:"300",top:"50%",left:"50%",marginTop:"-"+(59+this.parent.options.barHeight)+"px",textAlign:"center",marginLeft:"-60px",color:this.parent.options.textColor}).appendTo(this.container)),this.parent.preloadContainer.toPreload.length&&1!=this.parent.alreadyLoaded||this.parent.destroyContainers();},t.prototype.updatePercentage=function(e){this.loadbar.stop().animate({width:e+"%",minWidth:e+"%"},200),1==this.parent.options.percentage&&this.percentageContainer.text(Math.ceil(e)+"%")},n.prototype.create=function(){this.container=e("<div></div>").appendTo("body").css({display:"none",width:0,height:0,overflow:"hidden"}),this.processQueue()},n.prototype.processQueue=function(){for(var e=0;this.toPreload.length>e;e++)this.parent.destroyed||this.preloadImage(this.toPreload[e])},n.prototype.addImage=function(e){this.toPreload.push(e)},n.prototype.preloadImage=function(e){var t=new r;t.addToPreloader(this,e),t.bindLoadEvent()},r.prototype.addToPreloader=function(t,n){this.element=e("<img />").attr("src",n),this.element.appendTo(t.container),this.parent=t.parent},r.prototype.bindLoadEvent=function(){this.parent.imageCounter++,this.element[0].ref=this,new imagesLoaded(this.element,function(e){e.elements[0].ref.completeLoading()})},r.prototype.completeLoading=function(){this.parent.imageDone++;var e=100*(this.parent.imageDone/this.parent.imageCounter);this.parent.overlayLoader.updatePercentage(e),(this.parent.imageDone==this.parent.imageCounter||e>=100)&&this.parent.endLoader()},i.prototype.init=function(){if(this.options=e.extend({},this.defaultOptions,this.options),this.findImageInElement(this.element),1==this.options.deepSearch)for(var t=this.$element.find("*:not(script)"),n=0;n<t.length;n++)this.findImageInElement(t[n]);this.preloadContainer.create(),this.overlayLoader.createOverlay()},i.prototype.findImageInElement=function(t){var n="",i=e(t),s="normal";if("none"!=i.css("background-image")?(n=i.css("background-image"),s="background"):"undefined"!=typeof i.attr("src")&&"img"==t.nodeName.toLowerCase()&&(n=i.attr("src")),!this.hasGradient(n)){n=this.stripUrl(n);for(var o=n.split(", "),u=0;u<o.length;u++)if(this.validUrl(o[u])&&this.urlIsNew(o[u])){var f="";if(this.isIE()||this.isOpera())f="?rand="+Math.random(),this.preloadContainer.addImage(o[u]+f);else if("background"==s)this.preloadContainer.addImage(o[u]+f);else{var l=new r(this);l.element=i,l.bindLoadEvent()}this.foundUrls.push(o[u])}}},i.prototype.hasGradient=function(e){return-1==e.indexOf("gradient")?!1:!0},i.prototype.stripUrl=function(e){return e=e.replace(/url\(\"/g,""),e=e.replace(/url\(/g,""),e=e.replace(/\"\)/g,""),e=e.replace(/\)/g,"")},i.prototype.isIE=function(){return navigator.userAgent.match(/msie/i)},i.prototype.isOpera=function(){return navigator.userAgent.match(/Opera/i)},i.prototype.validUrl=function(e){return e.length>0&&!e.match(/^(data:)/i)?!0:!1},i.prototype.urlIsNew=function(e){return-1==this.foundUrls.indexOf(e)?!0:!1},i.prototype.destroyContainers=function(){this.destroyed=!0,this.preloadContainer.container.remove(),this.overlayLoader.container.remove()},i.prototype.endLoader=function(){this.destroyed=!0,this.onLoadComplete()},i.prototype.onLoadComplete=function(){if(this.options.onLoadComplete(),"grow"==this.options.completeAnimation){var t=this.options.minimumTime;this.overlayLoader.loadbar[0].parent=this,this.overlayLoader.loadbar.stop().animate({width:"100%"},t,function(){e(this).animate({top:"0%",width:"100%",height:"100%"},500,function(){this.parent.overlayLoader.container[0].parent=this.parent,this.parent.overlayLoader.container.fadeOut(500,function(){this.parent.destroyContainers(),this.parent.options.onComplete()})})})}else{var t=this.options.minimumTime;this.overlayLoader.container[0].parent=this,this.overlayLoader.container.fadeOut(t,function(){this.parent.destroyContainers(),this.parent.options.onComplete()})}},Array.prototype.indexOf||(Array.prototype.indexOf=function(e){var t=this.length>>>0,n=Number(arguments[1])||0;for(n=0>n?Math.ceil(n):Math.floor(n),0>n&&(n+=t);t>n;n++)if(n in this&&this[n]===e)return n;return-1}),e.fn.queryLoader2=function(e){return this.each(function(){new i(this,e)})}}(jQuery);


(function($) {


"use strict";

/* Gets IE version */
/* -------------------------------------------------------------------- */

function mk_detect_ie() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf('MSIE ');
    var trident = ua.indexOf('Trident/');
    if (msie > 0) {
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }
    if (trident > 0) {
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }
    return false;
}



/* Page Loader */
/* -------------------------------------------------------------------- */

function mk_query_loader() {

    if (mk_detect_ie() == false) {
         $("body").queryLoader2({
            showbar: "on",
            barColor: mk_preloader_bar_color,
            textColor: mk_preloader_txt_color,
            backgroundColor: mk_preloader_bg_color,
            barHeight: 2,
            logo: mk_preloader_logo,
            percentage: true,
            completeAnimation: "fade",
            minimumTime: 700,
            onComplete: function() {
                $(".mk-body-loader-overlay").fadeOut(600, "easeInOutExpo", function() {
                    $(this).remove();
                });
            }
        });
    }

    if (mk_detect_ie() > 7) {
        $('.mk-body-loader-overlay').hide();
    }
}


$(document).ready(function () {
   	mk_query_loader();
});


})(jQuery);