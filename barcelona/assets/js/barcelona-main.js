!function(a){a.extend({lockfixed:function(b,c){if(c&&c.offset?("function"!=typeof c.offset.bottom&&(c.offset.bottom=parseInt(c.offset.bottom,10)),"function"!=typeof c.offset.top&&(c.offset.top=parseInt(c.offset.top,10))):c.offset={bottom:100,top:0},c&&c.stuck_class||(c.stuck_class="is_stuck"),c&&"undefined"!=typeof c.screen_limit||(c.screen_limit=767),b&&b.offset()){var d=b.css("position"),e=parseInt(b.css("marginTop"),10),f=b.css("top"),g=b.offset().top,h=!1;(c.forcemargin===!0||navigator.userAgent.match(/\bMSIE (4|5|6)\./)||navigator.userAgent.match(/\bOS ([0-9])_/)||navigator.userAgent.match(/\bAndroid ([0-9])\./i))&&(g-=100),b.wrap("<div class='navbar-wrapper' style='height:"+b.outerHeight()+"px;display:"+b.css("display")+"'></div>"),a(window).bind("DOMContentLoaded load scroll resize orientationchange lockfixed:pageupdate",b,function(){if(a(window).width()<c.screen_limit)return b.removeAttr("style"),b.parents(".navbar-wrapper").removeAttr("style"),void b.removeClass(c.stuck_class);if(!h||!document.activeElement||"INPUT"!==document.activeElement.nodeName){var i="function"==typeof c.offset.top?c.offset.top():c.offset.top,j="function"==typeof c.offset.bottom?c.offset.bottom():c.offset.bottom,k=0,l=b.outerHeight(),m=b.parent().innerWidth()-parseInt(b.css("marginLeft"),10)-parseInt(b.css("marginRight"),10),n=a(document).height()-j,o=a(window).scrollTop();"fixed"===b.css("position")||h||(g=b.offset().top,f=b.css("top")),g-(e?e:0)-i>o?"function"==typeof c.on_unstick&&b.hasClass(c.stuck_class)&&c.on_unstick.call(this):h||"function"!=typeof c.on_stick||b.hasClass(c.stuck_class)||c.on_stick.call(this),o>=g-(e?e:0)-i?(k=o+l+e+i>n?o+l+e+i-n:0,h?b.css({marginTop:parseInt(o-g-k,10)+2*i+"px"}):b.css({position:"fixed",top:i-k+"px",width:m+"px"}).addClass(c.stuck_class)):b.css({position:d,top:f,width:m+"px",marginTop:(e&&!h?e:0)+"px"}).removeClass(c.stuck_class),b.parents(".navbar-wrapper").css("height",b.outerHeight())}})}}})}(jQuery),!function(a){a.fn.theiaStickySidebar=function(b){var c={containerSelector:"",additionalMarginTop:0,additionalMarginBottom:0,updateSidebarHeight:!0,minWidth:0};b=a.extend(c,b),b.additionalMarginTop=parseInt(b.additionalMarginTop)||0,b.additionalMarginBottom=parseInt(b.additionalMarginBottom)||0,a("head").append(a('<style>.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>')),this.each(function(){function c(){e.fixedScrollTop=0,e.sidebar.css({"min-height":"1px"}),e.stickySidebar.css({position:"static",width:""})}function d(b){var c=b.height();return b.children().each(function(){c=Math.max(c,a(this).height())}),c}var e={};e.sidebar=a(this),e.options=b||{},e.container=a(e.options.containerSelector),0==e.container.size()&&(e.container=e.sidebar.parent()),e.sidebar.parents().css("-webkit-transform","none"),e.sidebar.css({position:"relative",overflow:"visible","-webkit-box-sizing":"border-box","-moz-box-sizing":"border-box","box-sizing":"border-box"}),e.stickySidebar=e.sidebar.find(".theiaStickySidebar"),0==e.stickySidebar.length&&(e.sidebar.find("script").remove(),e.stickySidebar=a("<div>").addClass("theiaStickySidebar").append(e.sidebar.children()),e.sidebar.append(e.stickySidebar)),e.marginTop=parseInt(e.sidebar.css("margin-top")),e.marginBottom=parseInt(e.sidebar.css("margin-bottom")),e.paddingTop=parseInt(e.sidebar.css("padding-top")),e.paddingBottom=parseInt(e.sidebar.css("padding-bottom"));var f=e.stickySidebar.offset().top,g=e.stickySidebar.outerHeight();e.stickySidebar.css("padding-top",1),e.stickySidebar.css("padding-bottom",1),f-=e.stickySidebar.offset().top,g=e.stickySidebar.outerHeight()-g-f,0==f?(e.stickySidebar.css("padding-top",0),e.stickySidebarPaddingTop=0):e.stickySidebarPaddingTop=1,0==g?(e.stickySidebar.css("padding-bottom",0),e.stickySidebarPaddingBottom=0):e.stickySidebarPaddingBottom=1,e.previousScrollTop=null,e.fixedScrollTop=0,c(),e.onScroll=function(e){if(e.stickySidebar.is(":visible")){if(a("body").width()<e.options.minWidth)return void c();if(e.sidebar.outerWidth(!0)+50>e.container.width())return void c();var f=a(document).scrollTop(),g="static";if(f>=e.container.offset().top+(e.paddingTop+e.marginTop-e.options.additionalMarginTop)){var h,i=e.paddingTop+e.marginTop+b.additionalMarginTop,j=e.paddingBottom+e.marginBottom+b.additionalMarginBottom,k=e.container.offset().top,l=e.container.offset().top+d(e.container),m=0+b.additionalMarginTop,n=e.stickySidebar.outerHeight()+i+j<a(window).height();h=n?m+e.stickySidebar.outerHeight():a(window).height()-e.marginBottom-e.paddingBottom-b.additionalMarginBottom;var o=k-f+e.paddingTop+e.marginTop,p=l-f-e.paddingBottom-e.marginBottom,q=e.stickySidebar.offset().top-f,r=e.previousScrollTop-f;"fixed"==e.stickySidebar.css("position")&&(q+=r),q=r>0?Math.min(q,m):Math.max(q,h-e.stickySidebar.outerHeight()),q=Math.max(q,o),q=Math.min(q,p-e.stickySidebar.outerHeight());var s=e.container.height()==e.stickySidebar.outerHeight();g=!s&&q==m||!s&&q==h-e.stickySidebar.outerHeight()?"fixed":f+q-e.sidebar.offset().top-e.paddingTop<=b.additionalMarginTop?"static":"absolute"}if("fixed"==g)e.stickySidebar.css({position:"fixed",width:e.sidebar.width(),top:q,left:e.sidebar.offset().left+parseInt(e.sidebar.css("padding-left"))+parseInt(e.sidebar.css("border-left"))});else if("absolute"==g){var t={};"absolute"!=e.stickySidebar.css("position")&&(t.position="absolute",t.top=f+q-e.sidebar.offset().top-e.stickySidebarPaddingTop-e.stickySidebarPaddingBottom),t.width=e.sidebar.width(),t.left="",e.stickySidebar.css(t)}else"static"==g&&c();"static"!=g&&1==e.options.updateSidebarHeight&&e.sidebar.css({"min-height":e.stickySidebar.outerHeight()+e.stickySidebar.offset().top-e.sidebar.offset().top+e.paddingBottom}),e.previousScrollTop=f}},e.onScroll(e),a(document).scroll(function(a){return function(){a.onScroll(a)}}(e)),a(window).resize(function(a){return function(){a.stickySidebar.css({position:"static"}),a.onScroll(a)}}(e))})}}(jQuery),!function(a,b,c){a.fn.backstretch=function(d,e){return(d===c||0===d.length)&&a.error("No images were supplied for Backstretch"),0===a(b).scrollTop()&&b.scrollTo(0,0),this.each(function(){var b=a(this),c=b.data("backstretch");if(c){if("string"==typeof d&&"function"==typeof c[d])return void c[d](e);e=a.extend(c.options,e),c.destroy(!0)}c=new f(this,d,e),b.data("backstretch",c)})},a.backstretch=function(b,c){return a("body").backstretch(b,c).data("backstretch")},a.expr[":"].backstretch=function(b){return a(b).data("backstretch")!==c},a.fn.backstretch.defaults={centeredX:!0,centeredY:!0,duration:5e3,fade:0};var d={left:0,top:0,overflow:"hidden",margin:0,padding:0,height:"100%",width:"100%",zIndex:-999999},e={position:"absolute",display:"none",margin:0,padding:0,border:"none",width:"auto",height:"auto",maxHeight:"none",maxWidth:"none",zIndex:-999999},f=function(c,e,f){this.options=a.extend({},a.fn.backstretch.defaults,f||{}),this.images=a.isArray(e)?e:[e],a.each(this.images,function(){a("<img />")[0].src=this}),this.isBody=c===document.body,this.$container=a(c),this.$root=this.isBody?a(g?b:document):this.$container,c=this.$container.children(".backstretch").first(),this.$wrap=c.length?c:a('<div class="backstretch"></div>').css(d).appendTo(this.$container),this.isBody||(c=this.$container.css("position"),e=this.$container.css("zIndex"),this.$container.css({position:"static"===c?"relative":c,zIndex:"auto"===e?0:e,background:"none"}),this.$wrap.css({zIndex:-999998})),this.$wrap.css({position:this.isBody&&g?"fixed":"absolute"}),this.index=0,this.show(this.index),a(b).on("resize.backstretch",a.proxy(this.resize,this)).on("orientationchange.backstretch",a.proxy(function(){this.isBody&&0===b.pageYOffset&&(b.scrollTo(0,1),this.resize())},this))};f.prototype={resize:function(){try{var a,c={left:0,top:0},d=this.isBody?this.$root.width():this.$root.innerWidth(),e=d,f=this.isBody?b.innerHeight?b.innerHeight:this.$root.height():this.$root.innerHeight(),g=e/this.$img.data("ratio");g>=f?(a=(g-f)/2,this.options.centeredY&&(c.top="-"+a+"px")):(g=f,e=g*this.$img.data("ratio"),a=(e-d)/2,this.options.centeredX&&(c.left="-"+a+"px")),this.$wrap.css({width:d,height:f}).find("img:not(.deleteable)").css({width:e,height:g}).css(c)}catch(a){}return this},show:function(b){if(!(Math.abs(b)>this.images.length-1)){var c=this,d=c.$wrap.find("img").addClass("deleteable"),f={relatedTarget:c.$container[0]};return c.$container.trigger(a.Event("backstretch.before",f),[c,b]),this.index=b,clearInterval(c.interval),c.$img=a("<img />").css(e).bind("load",function(e){var g=this.width||a(e.target).width();e=this.height||a(e.target).height(),a(this).data("ratio",g/e),a(this).fadeIn(c.options.speed||c.options.fade,function(){d.remove(),c.paused||c.cycle(),a(["after","show"]).each(function(){c.$container.trigger(a.Event("backstretch."+this,f),[c,b])})}),c.resize()}).appendTo(c.$wrap),c.$img.attr("src",c.images[b]),c}},next:function(){return this.show(this.index<this.images.length-1?this.index+1:0)},prev:function(){return this.show(0===this.index?this.images.length-1:this.index-1)},pause:function(){return this.paused=!0,this},resume:function(){return this.paused=!1,this.next(),this},cycle:function(){return 1<this.images.length&&(clearInterval(this.interval),this.interval=setInterval(a.proxy(function(){this.paused||this.next()},this),this.options.duration)),this},destroy:function(c){a(b).off("resize.backstretch orientationchange.backstretch"),clearInterval(this.interval),c||this.$wrap.remove(),this.$container.removeData("backstretch")}};var g,h=navigator.userAgent,i=navigator.platform,j=h.match(/AppleWebKit\/([0-9]+)/),j=!!j&&j[1],k=h.match(/Fennec\/([0-9]+)/),k=!!k&&k[1],l=h.match(/Opera Mobi\/([0-9]+)/),m=!!l&&l[1],n=h.match(/MSIE ([0-9]+)/),n=!!n&&n[1];g=!((-1<i.indexOf("iPhone")||-1<i.indexOf("iPad")||-1<i.indexOf("iPod"))&&j&&534>j||b.operamini&&"[object OperaMini]"==={}.toString.call(b.operamini)||l&&7458>m||-1<h.indexOf("Android")&&j&&533>j||k&&6>k||"palmGetResource"in b&&j&&534>j||-1<h.indexOf("MeeGo")&&-1<h.indexOf("NokiaBrowser/8.5.0")||n&&6>=n)}(jQuery,window),!function(a,b){var c=function(){return c.get.apply(c,arguments)},d=c.utils={isArray:Array.isArray||function(a){return"[object Array]"===Object.prototype.toString.call(a)},isPlainObject:function(a){return!!a&&"[object Object]"===Object.prototype.toString.call(a)},toArray:function(a){return Array.prototype.slice.call(a)},getKeys:Object.keys||function(a){var b=[],c="";for(c in a)a.hasOwnProperty(c)&&b.push(c);return b},escape:function(a){return String(a).replace(/[,;"\\=\s%]/g,function(a){return encodeURIComponent(a)})},retrieve:function(a,b){return null==a?b:a}};c.defaults={},c.expiresMultiplier=86400,c.set=function(c,e,f){if(d.isPlainObject(c))for(var g in c)c.hasOwnProperty(g)&&this.set(g,c[g],e);else{f=d.isPlainObject(f)?f:{expires:f};var h=f.expires!==b?f.expires:this.defaults.expires||"",i=typeof h;"string"===i&&""!==h?h=new Date(h):"number"===i&&(h=new Date(+new Date+1e3*this.expiresMultiplier*h)),""!==h&&"toGMTString"in h&&(h=";expires="+h.toGMTString());var j=f.path||this.defaults.path;j=j?";path="+j:"";var k=f.domain||this.defaults.domain;k=k?";domain="+k:"";var l=f.secure||this.defaults.secure?";secure":"";a.cookie=d.escape(c)+"="+d.escape(e)+h+j+k+l}return this},c.remove=function(a){a=d.isArray(a)?a:d.toArray(arguments);for(var b=0,c=a.length;b<c;b++)this.set(a[b],"",-1);return this},c.empty=function(){return this.remove(d.getKeys(this.all()))},c.get=function(a,c){c=c||b;var e=this.all();if(d.isArray(a)){for(var f={},g=0,h=a.length;g<h;g++){var i=a[g];f[i]=d.retrieve(e[i],c)}return f}return d.retrieve(e[a],c)},c.all=function(){if(""===a.cookie)return{};for(var b=a.cookie.split("; "),c={},d=0,e=b.length;d<e;d++){var f=b[d].split("=");c[decodeURIComponent(f[0])]=decodeURIComponent(f[1])}return c},c.enabled=function(){if(navigator.cookieEnabled)return!0;var a="_"===c.set("_","_").get("_");return c.remove("_"),a},"function"==typeof define&&define.amd?define(function(){return c}):"undefined"!=typeof exports?exports.cookie=c:window.cookie=c}(document),!function(a){"use strict";a.fn.fitVids=function(b){var c={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var d=document.head||document.getElementsByTagName("head")[0],e=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}",f=document.createElement("div");f.innerHTML='<p>x</p><style id="fit-vids-style">'+e+"</style>",d.appendChild(f.childNodes[1])}return b&&a.extend(c,b),this.each(function(){var b=['iframe[src*="player.vimeo.com"]','iframe[src*="youtube.com"]','iframe[src*="youtube-nocookie.com"]','iframe[src*="kickstarter.com"][src*="video.html"]',"object","embed"];c.customSelector&&b.push(c.customSelector);var d=".fitvidsignore";c.ignore&&(d=d+", "+c.ignore);var e=a(this).find(b.join(","));e=e.not("object object"),e=e.not(d),e.each(function(b){var c=a(this);if(!(c.parents(d).length>0||"embed"===this.tagName.toLowerCase()&&c.parent("object").length||c.parent(".fluid-width-video-wrapper").length)){c.css("height")||c.css("width")||!isNaN(c.attr("height"))&&!isNaN(c.attr("width"))||(c.attr("height",9),c.attr("width",16));var e="object"===this.tagName.toLowerCase()||c.attr("height")&&!isNaN(parseInt(c.attr("height"),10))?parseInt(c.attr("height"),10):c.height(),f=isNaN(parseInt(c.attr("width"),10))?c.width():parseInt(c.attr("width"),10),g=e/f;if(!c.attr("id")){var h="fitvid"+b;c.attr("id",h)}c.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*g+"%"),c.removeAttr("height").removeAttr("width")}})})}}(window.jQuery||window.Zepto),!function(a){"use strict";a.fn.equalHeight=function(){var b=[];return a.each(this,function(c,d){var e,f=a(d),g="border-box"===f.css("box-sizing")||"border-box"===f.css("-moz-box-sizing");e=g?f.innerHeight():f.height(),b.push(e)}),this.css("height",Math.max.apply(window,b)+"px"),this},a.fn.equalHeightGrid=function(b){var c=this.filter(":visible");c.css("height","auto");for(var d=0;d<c.length;d++)if(d%b===0){for(var e=a(c[d]),f=1;b>f;f++)e=e.add(c[d+f]);e.equalHeight()}return this},a.fn.detectGridColumns=function(){var b=0,c=0,d=this.filter(":visible");return d.each(function(d,e){var f=a(e).offset().top;return(0===b||f===b)&&(c++,void(b=f))}),c};var b=0;a.fn.responsiveEqualHeightGrid=function(){function c(){var a=d.detectGridColumns();d.equalHeightGrid(a)}var d=this,e=".grids_"+b;return d.data("grids-event-namespace",e),a(window).bind("resize"+e+" load"+e,c),c(),b++,this},a.fn.responsiveEqualHeightGridDestroy=function(){var b=this;return b.css("height","auto"),a(window).unbind(b.data("grids-event-namespace")),this}}(window.jQuery),!function(a,b){"use strict";"function"==typeof define&&define.amd?define("jquery-bridget/jquery-bridget",["jquery"],function(c){b(a,c)}):"object"==typeof module&&module.exports?module.exports=b(a,require("jquery")):a.jQueryBridget=b(a,a.jQuery)}(window,function(a,b){"use strict";function c(c,f,h){function i(a,b,d){var e,f="$()."+c+'("'+b+'")';return a.each(function(a,i){var j=h.data(i,c);if(!j)return void g(c+" not initialized. Cannot call methods, i.e. "+f);var k=j[b];if(!k||"_"==b.charAt(0))return void g(f+" is not a valid method");var l=k.apply(j,d);e=void 0===e?l:e}),void 0!==e?e:a}function j(a,b){a.each(function(a,d){var e=h.data(d,c);e?(e.option(b),e._init()):(e=new f(d,b),h.data(d,c,e))})}h=h||b||a.jQuery,h&&(f.prototype.option||(f.prototype.option=function(a){h.isPlainObject(a)&&(this.options=h.extend(!0,this.options,a))}),h.fn[c]=function(a){if("string"==typeof a){var b=e.call(arguments,1);return i(this,a,b)}return j(this,a),this},d(h))}function d(a){!a||a&&a.bridget||(a.bridget=c)}var e=Array.prototype.slice,f=a.console,g="undefined"==typeof f?function(){}:function(a){f.error(a)};return d(b||a.jQuery),c}),function(a,b){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",b):"object"==typeof module&&module.exports?module.exports=b():a.EvEmitter=b()}(this,function(){function a(){}var b=a.prototype;return b.on=function(a,b){if(a&&b){var c=this._events=this._events||{},d=c[a]=c[a]||[];return-1==d.indexOf(b)&&d.push(b),this}},b.once=function(a,b){if(a&&b){this.on(a,b);var c=this._onceEvents=this._onceEvents||{},d=c[a]=c[a]||{};return d[b]=!0,this}},b.off=function(a,b){var c=this._events&&this._events[a];if(c&&c.length){var d=c.indexOf(b);return-1!=d&&c.splice(d,1),this}},b.emitEvent=function(a,b){var c=this._events&&this._events[a];if(c&&c.length){var d=0,e=c[d];b=b||[];for(var f=this._onceEvents&&this._onceEvents[a];e;){var g=f&&f[e];g&&(this.off(a,e),delete f[e]),e.apply(this,b),d+=g?0:1,e=c[d]}return this}},a}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("get-size/get-size",[],function(){return b()}):"object"==typeof module&&module.exports?module.exports=b():a.getSize=b()}(window,function(){"use strict";function a(a){var b=parseFloat(a),c=-1==a.indexOf("%")&&!isNaN(b);return c&&b}function b(){}function c(){for(var a={width:0,height:0,innerWidth:0,innerHeight:0,outerWidth:0,outerHeight:0},b=0;j>b;b++){var c=i[b];a[c]=0}return a}function d(a){var b=getComputedStyle(a);return b||h("Style returned "+b+". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"),b}function e(){if(!k){k=!0;var b=document.createElement("div");b.style.width="200px",b.style.padding="1px 2px 3px 4px",b.style.borderStyle="solid",b.style.borderWidth="1px 2px 3px 4px",b.style.boxSizing="border-box";var c=document.body||document.documentElement;c.appendChild(b);var e=d(b);f.isBoxSizeOuter=g=200==a(e.width),c.removeChild(b)}}function f(b){if(e(),"string"==typeof b&&(b=document.querySelector(b)),b&&"object"==typeof b&&b.nodeType){var f=d(b);if("none"==f.display)return c();var h={};h.width=b.offsetWidth,h.height=b.offsetHeight;for(var k=h.isBorderBox="border-box"==f.boxSizing,l=0;j>l;l++){var m=i[l],n=f[m],o=parseFloat(n);h[m]=isNaN(o)?0:o}var p=h.paddingLeft+h.paddingRight,q=h.paddingTop+h.paddingBottom,r=h.marginLeft+h.marginRight,s=h.marginTop+h.marginBottom,t=h.borderLeftWidth+h.borderRightWidth,u=h.borderTopWidth+h.borderBottomWidth,v=k&&g,w=a(f.width);w!==!1&&(h.width=w+(v?0:p+t));var x=a(f.height);return x!==!1&&(h.height=x+(v?0:q+u)),h.innerWidth=h.width-(p+t),h.innerHeight=h.height-(q+u),h.outerWidth=h.width+r,h.outerHeight=h.height+s,h}}var g,h="undefined"==typeof console?b:function(a){console.error(a)},i=["paddingLeft","paddingRight","paddingTop","paddingBottom","marginLeft","marginRight","marginTop","marginBottom","borderLeftWidth","borderRightWidth","borderTopWidth","borderBottomWidth"],j=i.length,k=!1;return f}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("desandro-matches-selector/matches-selector",b):"object"==typeof module&&module.exports?module.exports=b():a.matchesSelector=b()}(window,function(){"use strict";var a=function(){var a=Element.prototype;if(a.matches)return"matches";if(a.matchesSelector)return"matchesSelector";for(var b=["webkit","moz","ms","o"],c=0;c<b.length;c++){var d=b[c],e=d+"MatchesSelector";if(a[e])return e}}();return function(b,c){return b[a](c)}}),function(a,b){"function"==typeof define&&define.amd?define("fizzy-ui-utils/utils",["desandro-matches-selector/matches-selector"],function(c){return b(a,c)}):"object"==typeof module&&module.exports?module.exports=b(a,require("desandro-matches-selector")):a.fizzyUIUtils=b(a,a.matchesSelector)}(window,function(a,b){var c={};c.extend=function(a,b){for(var c in b)a[c]=b[c];return a},c.modulo=function(a,b){return(a%b+b)%b},c.makeArray=function(a){var b=[];if(Array.isArray(a))b=a;else if(a&&"number"==typeof a.length)for(var c=0;c<a.length;c++)b.push(a[c]);else b.push(a);return b},c.removeFrom=function(a,b){var c=a.indexOf(b);-1!=c&&a.splice(c,1)},c.getParent=function(a,c){for(;a!=document.body;)if(a=a.parentNode,b(a,c))return a},c.getQueryElement=function(a){return"string"==typeof a?document.querySelector(a):a},c.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},c.filterFindElements=function(a,d){a=c.makeArray(a);var e=[];return a.forEach(function(a){if(a instanceof HTMLElement){if(!d)return void e.push(a);b(a,d)&&e.push(a);for(var c=a.querySelectorAll(d),f=0;f<c.length;f++)e.push(c[f])}}),e},c.debounceMethod=function(a,b,c){var d=a.prototype[b],e=b+"Timeout";a.prototype[b]=function(){var a=this[e];a&&clearTimeout(a);var b=arguments,f=this;this[e]=setTimeout(function(){d.apply(f,b),delete f[e]},c||100)}},c.docReady=function(a){"complete"==document.readyState?a():document.addEventListener("DOMContentLoaded",a)},c.toDashed=function(a){return a.replace(/(.)([A-Z])/g,function(a,b,c){return b+"-"+c}).toLowerCase()};var d=a.console;return c.htmlInit=function(b,e){c.docReady(function(){var f=c.toDashed(e),g="data-"+f,h=document.querySelectorAll("["+g+"]"),i=document.querySelectorAll(".js-"+f),j=c.makeArray(h).concat(c.makeArray(i)),k=g+"-options",l=a.jQuery;j.forEach(function(a){var c,f=a.getAttribute(g)||a.getAttribute(k);try{c=f&&JSON.parse(f)}catch(b){return void(d&&d.error("Error parsing "+g+" on "+a.className+": "+b))}var h=new b(a,c);l&&l.data(a,e,h)})})},c}),function(a,b){"function"==typeof define&&define.amd?define("outlayer/item",["ev-emitter/ev-emitter","get-size/get-size"],b):"object"==typeof module&&module.exports?module.exports=b(require("ev-emitter"),require("get-size")):(a.Outlayer={},a.Outlayer.Item=b(a.EvEmitter,a.getSize))}(window,function(a,b){"use strict";function c(a){for(var b in a)return!1;return b=null,!0}function d(a,b){a&&(this.element=a,this.layout=b,this.position={x:0,y:0},this._create())}function e(a){return a.replace(/([A-Z])/g,function(a){return"-"+a.toLowerCase()})}var f=document.documentElement.style,g="string"==typeof f.transition?"transition":"WebkitTransition",h="string"==typeof f.transform?"transform":"WebkitTransform",i={WebkitTransition:"webkitTransitionEnd",transition:"transitionend"}[g],j={transform:h,transition:g,transitionDuration:g+"Duration",transitionProperty:g+"Property",transitionDelay:g+"Delay"},k=d.prototype=Object.create(a.prototype);k.constructor=d,k._create=function(){this._transn={ingProperties:{},clean:{},onEnd:{}},this.css({position:"absolute"})},k.handleEvent=function(a){var b="on"+a.type;this[b]&&this[b](a)},k.getSize=function(){this.size=b(this.element)},k.css=function(a){var b=this.element.style;for(var c in a){var d=j[c]||c;b[d]=a[c]}},k.getPosition=function(){var a=getComputedStyle(this.element),b=this.layout._getOption("originLeft"),c=this.layout._getOption("originTop"),d=a[b?"left":"right"],e=a[c?"top":"bottom"],f=this.layout.size,g=-1!=d.indexOf("%")?parseFloat(d)/100*f.width:parseInt(d,10),h=-1!=e.indexOf("%")?parseFloat(e)/100*f.height:parseInt(e,10);g=isNaN(g)?0:g,h=isNaN(h)?0:h,g-=b?f.paddingLeft:f.paddingRight,h-=c?f.paddingTop:f.paddingBottom,this.position.x=g,this.position.y=h},k.layoutPosition=function(){var a=this.layout.size,b={},c=this.layout._getOption("originLeft"),d=this.layout._getOption("originTop"),e=c?"paddingLeft":"paddingRight",f=c?"left":"right",g=c?"right":"left",h=this.position.x+a[e];b[f]=this.getXValue(h),b[g]="";var i=d?"paddingTop":"paddingBottom",j=d?"top":"bottom",k=d?"bottom":"top",l=this.position.y+a[i];b[j]=this.getYValue(l),b[k]="",this.css(b),this.emitEvent("layout",[this])},k.getXValue=function(a){var b=this.layout._getOption("horizontal");return this.layout.options.percentPosition&&!b?a/this.layout.size.width*100+"%":a+"px"},k.getYValue=function(a){var b=this.layout._getOption("horizontal");return this.layout.options.percentPosition&&b?a/this.layout.size.height*100+"%":a+"px"},k._transitionTo=function(a,b){this.getPosition();var c=this.position.x,d=this.position.y,e=parseInt(a,10),f=parseInt(b,10),g=e===this.position.x&&f===this.position.y;if(this.setPosition(a,b),g&&!this.isTransitioning)return void this.layoutPosition();var h=a-c,i=b-d,j={};j.transform=this.getTranslate(h,i),this.transition({to:j,onTransitionEnd:{transform:this.layoutPosition},isCleaning:!0})},k.getTranslate=function(a,b){var c=this.layout._getOption("originLeft"),d=this.layout._getOption("originTop");return a=c?a:-a,b=d?b:-b,"translate3d("+a+"px, "+b+"px, 0)"},k.goTo=function(a,b){this.setPosition(a,b),this.layoutPosition()},k.moveTo=k._transitionTo,k.setPosition=function(a,b){this.position.x=parseInt(a,10),this.position.y=parseInt(b,10)},k._nonTransition=function(a){this.css(a.to),a.isCleaning&&this._removeStyles(a.to);for(var b in a.onTransitionEnd)a.onTransitionEnd[b].call(this)},k.transition=function(a){if(!parseFloat(this.layout.options.transitionDuration))return void this._nonTransition(a);var b=this._transn;for(var c in a.onTransitionEnd)b.onEnd[c]=a.onTransitionEnd[c];for(c in a.to)b.ingProperties[c]=!0,a.isCleaning&&(b.clean[c]=!0);if(a.from){this.css(a.from);var d=this.element.offsetHeight;d=null}this.enableTransition(a.to),this.css(a.to),this.isTransitioning=!0};var l="opacity,"+e(h);k.enableTransition=function(){if(!this.isTransitioning){var a=this.layout.options.transitionDuration;a="number"==typeof a?a+"ms":a,this.css({transitionProperty:l,transitionDuration:a,transitionDelay:this.staggerDelay||0}),this.element.addEventListener(i,this,!1)}},k.onwebkitTransitionEnd=function(a){this.ontransitionend(a)},k.onotransitionend=function(a){this.ontransitionend(a)};var m={"-webkit-transform":"transform"};k.ontransitionend=function(a){if(a.target===this.element){var b=this._transn,d=m[a.propertyName]||a.propertyName;if(delete b.ingProperties[d],c(b.ingProperties)&&this.disableTransition(),d in b.clean&&(this.element.style[a.propertyName]="",delete b.clean[d]),d in b.onEnd){var e=b.onEnd[d];e.call(this),delete b.onEnd[d]}this.emitEvent("transitionEnd",[this])}},k.disableTransition=function(){this.removeTransitionStyles(),this.element.removeEventListener(i,this,!1),this.isTransitioning=!1},k._removeStyles=function(a){var b={};for(var c in a)b[c]="";this.css(b)};var n={transitionProperty:"",transitionDuration:"",transitionDelay:""};return k.removeTransitionStyles=function(){this.css(n)},k.stagger=function(a){a=isNaN(a)?0:a,this.staggerDelay=a+"ms"},k.removeElem=function(){this.element.parentNode.removeChild(this.element),this.css({display:""}),this.emitEvent("remove",[this])},k.remove=function(){return g&&parseFloat(this.layout.options.transitionDuration)?(this.once("transitionEnd",function(){this.removeElem()}),void this.hide()):void this.removeElem()},k.reveal=function(){delete this.isHidden,this.css({display:""});var a=this.layout.options,b={},c=this.getHideRevealTransitionEndProperty("visibleStyle");b[c]=this.onRevealTransitionEnd,this.transition({from:a.hiddenStyle,to:a.visibleStyle,isCleaning:!0,onTransitionEnd:b})},k.onRevealTransitionEnd=function(){this.isHidden||this.emitEvent("reveal")},k.getHideRevealTransitionEndProperty=function(a){var b=this.layout.options[a];if(b.opacity)return"opacity";for(var c in b)return c},k.hide=function(){this.isHidden=!0,this.css({display:""});var a=this.layout.options,b={},c=this.getHideRevealTransitionEndProperty("hiddenStyle");b[c]=this.onHideTransitionEnd,this.transition({from:a.visibleStyle,to:a.hiddenStyle,isCleaning:!0,onTransitionEnd:b})},k.onHideTransitionEnd=function(){this.isHidden&&(this.css({display:"none"}),this.emitEvent("hide"))},k.destroy=function(){this.css({position:"",left:"",right:"",top:"",bottom:"",transition:"",transform:""})},d}),function(a,b){"use strict";"function"==typeof define&&define.amd?define("outlayer/outlayer",["ev-emitter/ev-emitter","get-size/get-size","fizzy-ui-utils/utils","./item"],function(c,d,e,f){return b(a,c,d,e,f)}):"object"==typeof module&&module.exports?module.exports=b(a,require("ev-emitter"),require("get-size"),require("fizzy-ui-utils"),require("./item")):a.Outlayer=b(a,a.EvEmitter,a.getSize,a.fizzyUIUtils,a.Outlayer.Item)}(window,function(a,b,c,d,e){"use strict";function f(a,b){var c=d.getQueryElement(a);if(!c)return void(i&&i.error("Bad element for "+this.constructor.namespace+": "+(c||a)));this.element=c,j&&(this.$element=j(this.element)),this.options=d.extend({},this.constructor.defaults),this.option(b);var e=++l;this.element.outlayerGUID=e,m[e]=this,this._create();var f=this._getOption("initLayout");f&&this.layout()}function g(a){function b(){a.apply(this,arguments)}return b.prototype=Object.create(a.prototype),b.prototype.constructor=b,b}function h(a){if("number"==typeof a)return a;var b=a.match(/(^\d*\.?\d*)(\w*)/),c=b&&b[1],d=b&&b[2];if(!c.length)return 0;c=parseFloat(c);var e=o[d]||1;return c*e}var i=a.console,j=a.jQuery,k=function(){},l=0,m={};f.namespace="outlayer",f.Item=e,f.defaults={containerStyle:{position:"relative"},initLayout:!0,originLeft:!0,originTop:!0,resize:!0,resizeContainer:!0,transitionDuration:"0.4s",hiddenStyle:{opacity:0,transform:"scale(0.001)"},visibleStyle:{opacity:1,transform:"scale(1)"}};var n=f.prototype;d.extend(n,b.prototype),n.option=function(a){d.extend(this.options,a)},n._getOption=function(a){var b=this.constructor.compatOptions[a];return b&&void 0!==this.options[b]?this.options[b]:this.options[a]},f.compatOptions={initLayout:"isInitLayout",horizontal:"isHorizontal",layoutInstant:"isLayoutInstant",originLeft:"isOriginLeft",originTop:"isOriginTop",resize:"isResizeBound",resizeContainer:"isResizingContainer"},n._create=function(){this.reloadItems(),this.stamps=[],this.stamp(this.options.stamp),d.extend(this.element.style,this.options.containerStyle);var a=this._getOption("resize");a&&this.bindResize()},n.reloadItems=function(){this.items=this._itemize(this.element.children)},n._itemize=function(a){for(var b=this._filterFindItemElements(a),c=this.constructor.Item,d=[],e=0;e<b.length;e++){var f=b[e],g=new c(f,this);d.push(g)}return d},n._filterFindItemElements=function(a){return d.filterFindElements(a,this.options.itemSelector)},n.getItemElements=function(){return this.items.map(function(a){return a.element})},n.layout=function(){this._resetLayout(),this._manageStamps();var a=this._getOption("layoutInstant"),b=void 0!==a?a:!this._isLayoutInited;this.layoutItems(this.items,b),this._isLayoutInited=!0},n._init=n.layout,n._resetLayout=function(){this.getSize()},n.getSize=function(){this.size=c(this.element)},n._getMeasurement=function(a,b){var d,e=this.options[a];e?("string"==typeof e?d=this.element.querySelector(e):e instanceof HTMLElement&&(d=e),this[a]=d?c(d)[b]:e):this[a]=0},n.layoutItems=function(a,b){a=this._getItemsForLayout(a),this._layoutItems(a,b),this._postLayout()},n._getItemsForLayout=function(a){return a.filter(function(a){return!a.isIgnored})},n._layoutItems=function(a,b){if(this._emitCompleteOnItems("layout",a),a&&a.length){var c=[];a.forEach(function(a){var d=this._getItemLayoutPosition(a);d.item=a,d.isInstant=b||a.isLayoutInstant,c.push(d)},this),this._processLayoutQueue(c)}},n._getItemLayoutPosition=function(){return{x:0,y:0}},n._processLayoutQueue=function(a){this.updateStagger(),a.forEach(function(a,b){this._positionItem(a.item,a.x,a.y,a.isInstant,b)},this)},n.updateStagger=function(){var a=this.options.stagger;return null===a||void 0===a?void(this.stagger=0):(this.stagger=h(a),this.stagger)},n._positionItem=function(a,b,c,d,e){d?a.goTo(b,c):(a.stagger(e*this.stagger),a.moveTo(b,c))},n._postLayout=function(){this.resizeContainer()},n.resizeContainer=function(){var a=this._getOption("resizeContainer");if(a){var b=this._getContainerSize();b&&(this._setContainerMeasure(b.width,!0),this._setContainerMeasure(b.height,!1))}},n._getContainerSize=k,n._setContainerMeasure=function(a,b){if(void 0!==a){var c=this.size;c.isBorderBox&&(a+=b?c.paddingLeft+c.paddingRight+c.borderLeftWidth+c.borderRightWidth:c.paddingBottom+c.paddingTop+c.borderTopWidth+c.borderBottomWidth),a=Math.max(a,0),this.element.style[b?"width":"height"]=a+"px"}},n._emitCompleteOnItems=function(a,b){function c(){e.dispatchEvent(a+"Complete",null,[b])}function d(){g++,g==f&&c()}var e=this,f=b.length;if(!b||!f)return void c();var g=0;b.forEach(function(b){b.once(a,d)})},n.dispatchEvent=function(a,b,c){
    var d=b?[b].concat(c):c;if(this.emitEvent(a,d),j)if(this.$element=this.$element||j(this.element),b){var e=j.Event(b);e.type=a,this.$element.trigger(e,c)}else this.$element.trigger(a,c)},n.ignore=function(a){var b=this.getItem(a);b&&(b.isIgnored=!0)},n.unignore=function(a){var b=this.getItem(a);b&&delete b.isIgnored},n.stamp=function(a){a=this._find(a),a&&(this.stamps=this.stamps.concat(a),a.forEach(this.ignore,this))},n.unstamp=function(a){a=this._find(a),a&&a.forEach(function(a){d.removeFrom(this.stamps,a),this.unignore(a)},this)},n._find=function(a){return a?("string"==typeof a&&(a=this.element.querySelectorAll(a)),a=d.makeArray(a)):void 0},n._manageStamps=function(){this.stamps&&this.stamps.length&&(this._getBoundingRect(),this.stamps.forEach(this._manageStamp,this))},n._getBoundingRect=function(){var a=this.element.getBoundingClientRect(),b=this.size;this._boundingRect={left:a.left+b.paddingLeft+b.borderLeftWidth,top:a.top+b.paddingTop+b.borderTopWidth,right:a.right-(b.paddingRight+b.borderRightWidth),bottom:a.bottom-(b.paddingBottom+b.borderBottomWidth)}},n._manageStamp=k,n._getElementOffset=function(a){var b=a.getBoundingClientRect(),d=this._boundingRect,e=c(a),f={left:b.left-d.left-e.marginLeft,top:b.top-d.top-e.marginTop,right:d.right-b.right-e.marginRight,bottom:d.bottom-b.bottom-e.marginBottom};return f},n.handleEvent=d.handleEvent,n.bindResize=function(){a.addEventListener("resize",this),this.isResizeBound=!0},n.unbindResize=function(){a.removeEventListener("resize",this),this.isResizeBound=!1},n.onresize=function(){this.resize()},d.debounceMethod(f,"onresize",100),n.resize=function(){this.isResizeBound&&this.needsResizeLayout()&&this.layout()},n.needsResizeLayout=function(){var a=c(this.element),b=this.size&&a;return b&&a.innerWidth!==this.size.innerWidth},n.addItems=function(a){var b=this._itemize(a);return b.length&&(this.items=this.items.concat(b)),b},n.appended=function(a){var b=this.addItems(a);b.length&&(this.layoutItems(b,!0),this.reveal(b))},n.prepended=function(a){var b=this._itemize(a);if(b.length){var c=this.items.slice(0);this.items=b.concat(c),this._resetLayout(),this._manageStamps(),this.layoutItems(b,!0),this.reveal(b),this.layoutItems(c)}},n.reveal=function(a){if(this._emitCompleteOnItems("reveal",a),a&&a.length){var b=this.updateStagger();a.forEach(function(a,c){a.stagger(c*b),a.reveal()})}},n.hide=function(a){if(this._emitCompleteOnItems("hide",a),a&&a.length){var b=this.updateStagger();a.forEach(function(a,c){a.stagger(c*b),a.hide()})}},n.revealItemElements=function(a){var b=this.getItems(a);this.reveal(b)},n.hideItemElements=function(a){var b=this.getItems(a);this.hide(b)},n.getItem=function(a){for(var b=0;b<this.items.length;b++){var c=this.items[b];if(c.element==a)return c}},n.getItems=function(a){a=d.makeArray(a);var b=[];return a.forEach(function(a){var c=this.getItem(a);c&&b.push(c)},this),b},n.remove=function(a){var b=this.getItems(a);this._emitCompleteOnItems("remove",b),b&&b.length&&b.forEach(function(a){a.remove(),d.removeFrom(this.items,a)},this)},n.destroy=function(){var a=this.element.style;a.height="",a.position="",a.width="",this.items.forEach(function(a){a.destroy()}),this.unbindResize();var b=this.element.outlayerGUID;delete m[b],delete this.element.outlayerGUID,j&&j.removeData(this.element,this.constructor.namespace)},f.data=function(a){a=d.getQueryElement(a);var b=a&&a.outlayerGUID;return b&&m[b]},f.create=function(a,b){var c=g(f);return c.defaults=d.extend({},f.defaults),d.extend(c.defaults,b),c.compatOptions=d.extend({},f.compatOptions),c.namespace=a,c.data=f.data,c.Item=g(e),d.htmlInit(c,a),j&&j.bridget&&j.bridget(a,c),c};var o={ms:1,s:1e3};return f.Item=e,f}),function(a,b){"function"==typeof define&&define.amd?define(["outlayer/outlayer","get-size/get-size"],b):"object"==typeof module&&module.exports?module.exports=b(require("outlayer"),require("get-size")):a.Masonry=b(a.Outlayer,a.getSize)}(window,function(a,b){var c=a.create("masonry");return c.compatOptions.fitWidth="isFitWidth",c.prototype._resetLayout=function(){this.getSize(),this._getMeasurement("columnWidth","outerWidth"),this._getMeasurement("gutter","outerWidth"),this.measureColumns(),this.colYs=[];for(var a=0;a<this.cols;a++)this.colYs.push(0);this.maxY=0},c.prototype.measureColumns=function(){if(this.getContainerWidth(),!this.columnWidth){var a=this.items[0],c=a&&a.element;this.columnWidth=c&&b(c).outerWidth||this.containerWidth}var d=this.columnWidth+=this.gutter,e=this.containerWidth+this.gutter,f=e/d,g=d-e%d,h=g&&1>g?"round":"floor";f=Math[h](f),this.cols=Math.max(f,1)},c.prototype.getContainerWidth=function(){var a=this._getOption("fitWidth"),c=a?this.element.parentNode:this.element,d=b(c);this.containerWidth=d&&d.innerWidth},c.prototype._getItemLayoutPosition=function(a){a.getSize();var b=a.size.outerWidth%this.columnWidth,c=b&&1>b?"round":"ceil",d=Math[c](a.size.outerWidth/this.columnWidth);d=Math.min(d,this.cols);for(var e=this._getColGroup(d),f=Math.min.apply(Math,e),g=e.indexOf(f),h={x:this.columnWidth*g,y:f},i=f+a.size.outerHeight,j=this.cols+1-e.length,k=0;j>k;k++)this.colYs[g+k]=i;return h},c.prototype._getColGroup=function(a){if(2>a)return this.colYs;for(var b=[],c=this.cols+1-a,d=0;c>d;d++){var e=this.colYs.slice(d,d+a);b[d]=Math.max.apply(Math,e)}return b},c.prototype._manageStamp=function(a){var c=b(a),d=this._getElementOffset(a),e=this._getOption("originLeft"),f=e?d.left:d.right,g=f+c.outerWidth,h=Math.floor(f/this.columnWidth);h=Math.max(0,h);var i=Math.floor(g/this.columnWidth);i-=g%this.columnWidth?0:1,i=Math.min(this.cols-1,i);for(var j=this._getOption("originTop"),k=(j?d.top:d.bottom)+c.outerHeight,l=h;i>=l;l++)this.colYs[l]=Math.max(k,this.colYs[l])},c.prototype._getContainerSize=function(){this.maxY=Math.max.apply(Math,this.colYs);var a={height:this.maxY};return this._getOption("fitWidth")&&(a.width=this._getContainerFitWidth()),a},c.prototype._getContainerFitWidth=function(){for(var a=0,b=this.cols;--b&&0===this.colYs[b];)a++;return(this.cols-a)*this.columnWidth-this.gutter},c.prototype.needsResizeLayout=function(){var a=this.containerWidth;return this.getContainerWidth(),a!=this.containerWidth},c});

jQuery(document).ready(function ($) {
    "use strict";

    var _conf = typeof barcelonaParams == 'object' ? barcelonaParams : {},
        _b = $('body'),
        _col_resp = [
            '.sidebar-widget .posts-box-sidebar .col',
            '.footer-widget .posts-box-sidebar .col',
            '.posts-box-6 .col',
            '.posts-box-8 .col',
            '.posts-box-9 .col'
        ],
        _el = {
            root: $('html, body'),
            navbar: $('.navbar'),
            navbar_sticky: $('.navbar-sticky'),
            navbar_nav: $('.navbar-nav'),
            navbar_header: $('.navbar-header'),
            wp_bar: $('#wpadminbar'),
            main: $('#main'),
            footer: $('.footer'),
            breadcrumb: $('.breadcrumb-wrapper'),
            par_wrapper: $('.barcelona-parallax-wrapper'),
            par_inner: $('.barcelona-parallax-inner'),
            fimg_sp: $('.fimg-sp'),
            fimg_fp: $('.fimg-fp'),
            fimg_fs: $('.fimg-fs'),
            pgn_infinite: $('.pagination-infinite')
        };

    window.requestAnimFrame = (function () {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (callback) {
                window.setTimeout(callback, 1000 / 60);
            };
    })();

    /*
     * Main menu add caret icons
     */
    _el.navbar_nav.find('li').each(function () {
        var t = $(this);
        if (t.hasClass('menu-item-has-children') && !t.hasClass('menu-item-mega-menu')) {
            t.children('a').append($('<span>').addClass('fa fa-caret-right')).append($('<span>').addClass('fa fa-caret-down'));
        }
    });

    /*
     * Mobile nav menu
     */
    _b.on('click', '.navbar-nav li a', function (e) {

        var t = $(this),
            li = t.parent();

        if (!_el.navbar.find('.navbar-toggle').is(':hidden')
            && li.hasClass('menu-item-has-children')
            && !li.hasClass('menu-item-mega-menu')) {

            e.preventDefault();

            if (!li.hasClass('barcelona-tap')) {
                li.addClass('barcelona-tap').children('.sub-menu').show();
            } else {
                li.removeClass('barcelona-tap').find('.sub-menu').hide();
            }

        }

    });


    /*
    * Masonry Layout
    */
    var grid;
    if (_conf.masonry_layout == 'on') {
        jQuery(window).load(function () {
            grid = $('.posts-wrapper').masonry({
                itemSelector: '.mas-item',
                columnWidth: '.mas-item',
                percentPosition: true,
                transitionDuration: '0.2s'
            });
        });

        $(document).ajaxComplete(function () {
            setTimeout(function(){
                $('.posts-wrapper').masonry('reloadItems');
                $('.posts-wrapper').masonry('layout');
            }, 200);
        });
    } else {
        $(document).ajaxComplete(function () {
                setTimeout(function(){
                    for( var i in _col_resp ) {
                        $(_col_resp[i]).responsiveEqualHeightGrid();
                    }
            }, 200);
        });
    }

    /*
     * Sticky Navbar
     */
    if (_el.navbar.length && _el.navbar.hasClass('navbar-sticky')) {

        $.lockfixed(_el.navbar, {
            offset: {
                top: function () {
                    var el_wpbar_offset = ( _el.wp_bar.length && _el.wp_bar.css('position') == 'fixed' ) ? _el.wp_bar.height() : 0,
                        el_navbar_offset = _el.navbar.find('.navbar-toggle').is(':hidden') ? ( _el.navbar.find('.container').innerHeight() - _el.navbar.find('.navbar-collapse').outerHeight() ) : 0;
                    return -1 * ( el_navbar_offset - el_wpbar_offset );
                },
                bottom: function () {
                    return _el.navbar.find('.navbar-toggle').is(':hidden') ? _el.footer.height() : 0;
                }
            },
            stuck_class: 'navbar-stuck',
            screen_limit: 0,
            on_stick: function () {

                var fixLogoSpace = function () {

                    var h = _el.navbar_header.outerHeight();
                    _el.navbar_header.css('height', h);

                    var el_sticky_logo = $('.logo-location-sticky_nav');
                    if (!el_sticky_logo.length) {
                        el_sticky_logo = $('.logo-location-header');
                    }

                    if (el_sticky_logo.length) {
                        var prop_name = _b.hasClass('rtl') ? 'padding-right' : 'padding-left',
                            cl_name = 'logov-stuck';
                        if (el_sticky_logo.hasClass('logo-location-header'))
                            el_sticky_logo.addClass(cl_name);
                        _el.navbar_nav.css(prop_name, el_sticky_logo.width() + 15);
                        el_sticky_logo.removeClass(cl_name);
                    }

                };

                if (_el.navbar.hasClass('header-style-c')) {
                    setTimeout(fixLogoSpace, 10);
                } else {
                    fixLogoSpace.call(this);
                }

            },
            on_unstick: function () {
                var prop_name = _b.hasClass('rtl') ? 'padding-right' : 'padding-left';
                _el.navbar_header.css('height', 'auto');
                _el.navbar_nav.css(prop_name, 0);
            }
        });

    }


    /*
     * Sticky Sidebar
     */
    $('.sidebar-sticky').theiaStickySidebar({
        containerSelector: '.row-primary',
        additionalMarginTop: ( _el.wp_bar.length && _el.navbar.length ) ? 100 : 68,
        additionalMarginBottom: 0,
        minWidth: 977
    });

    $(window).load(function() {
        /*
         * Responsive Equal Height
         */
        for( var i in _col_resp ) {
            $(_col_resp[i]).responsiveEqualHeightGrid();
        }

    });

    /*
     * Featured Video fix
     */
    $('.fimg-media-video').fitVids().find('.post-meta').css('visibility', 'visible');

    /*
     * Post sharing buttons
     */
    _b.on('click', '.post-sharing ul li a', function (e) {

        e.preventDefault();

        var href = $(this).attr('href'),
            title = $(this).attr('title');

        window.open(href, title, 'width=600,height=300');

    });

    /*
     * Activate Boxer Lightbox
     */
    $('.boxer').boxer({
        fixed: true
    });

    $('.gal-img').each(function () {

        var s = $(this),
            t = s.attr('title'),
            p = s.parents('a'),
            pc = p.parents('.gallery-icon'),
            g = s.data('gallery');

        s.removeAttr('data-gallery');

        pc.click(function () {
            $(this).find('a').trigger('click');
        });

        p.attr({'title': t, 'data-gallery': g}).boxer({
            fixed: true
        });

    });

    $('.post-content a').each(function () {

        var childImg = $(this).children('img');

        if (childImg.length > 0) {

            var hrefExt = $(this).attr('href').split('.').pop(),
                captionText = $(this).siblings('.wp-caption-text');

            if (['jpg', 'jpeg', 'png', 'bmp', 'gif'].indexOf(hrefExt) != -1) {

                $(this).removeAttr('rel');

                var elGal = $(this).parents('.gallery'),
                    imgTitle = childImg.attr('title');

                if (elGal.length > 0) {
                    $(this).attr('data-gallery', elGal.attr('id'));
                }

                if (captionText.length > 0) {
                    $(this).attr('title', captionText.text());
                } else if (typeof imgTitle != 'undefined') {
                    $(this).attr('title', imgTitle);
                }

                $(this).boxer({
                    fixed: true
                });

            }

        }

    });

    /*
     * Post Vote
     */
    $('.btn-vote').on('click', function (e) {

        e.preventDefault();

        var btn = $(this),
            type = btn.data('type'),
            vote_type = btn.data('vote-type'),
            vote_id = vote_type == 'post' ? _conf.post_id : btn.data('vote-id'),
            unique_id = vote_type + '_' + vote_id,
            cookie_key = 'barcelona_voted_' + ( vote_type == 'post' ? 'posts' : 'comments' ),
            voted_data = {};

        try {
            voted_data = $.parseJSON(cookie.get(cookie_key)) || {};
        } catch (e) {
        }

        if (unique_id == null || typeof voted_data[unique_id] != 'undefined' || typeof type == 'undefined' || ['up', 'down'].indexOf(type) == -1) {
            return voted_data;
        }

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: _conf.ajaxurl,
            data: {
                action: 'barcelona_vote',
                barcelona_nonce: btn.data('nonce'),
                barcelona_post_id: vote_id,
                barcelona_type: type,
                barcelona_vote_type: vote_type
            },
            success: function (r) {

                if (typeof r != 'object') {

                    var vp = btn.parents('.' + vote_type + '-vote'),
                        el = vp.find('.vote-login'),
                        cl = vote_type == 'post' ? ' col col-sm-12' : '';

                    if (vote_type == 'comment' && el.length == 0) {
                        vp = vp.siblings('.comment-vote');
                        el = vp.find('.vote-login');
                    }

                    if (el.length == 0) {
                        el = $('<div>').addClass('vote-login' + cl);
                        vp.prepend(el);
                    }

                    el.text(_conf.i18n.login_to_vote);

                    return;

                }

                if (r.status) {

                    var elVal = vote_type == 'post' ? $('.post_vote_' + type + '_val') : btn.find('.vote-num'),
                        voteVal = r['vote_' + type];

                    if (elVal.length > 0 && typeof voteVal != 'undefined') {
                        elVal.text(voteVal);
                    }

                    btn.addClass('btn-voted');

                    var k = '.' + vote_type + '-vote',
                        p = btn.parents(k);

                    p.add(p.siblings(k)).addClass(vote_type + '-vote-disabled').find('.btn-vote').off('click');

                    if (cookie.enabled()) {
                        voted_data[unique_id] = type;
                        var cookie_params = {};
                        cookie_params[cookie_key] = JSON.stringify(voted_data);
                        cookie.set(cookie_params, {expires: 30});
                    }

                }

            }
        });

    });

    /*
     * Owl Carousel
     */
    var owlEvent = function () {

        var t = $(this),
            c = t.data('controls'),
            owlParams = {
                items: 1,
                slideBy: 1,
                loop: true,
                center: true,
                mouseDrag: false,
                dots: true,
                nav: false,
                navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
                autoplay: false,
                autoplayHoverPause: true,
                autoplayTimeout: 5000,
                dotsSpeed: 400,
                smartSpeed: 300,
                rtl: false
            }, i;

        for (i in owlParams) {
            var z = i.toLowerCase(),
                d = t.data(z);
            if (typeof d != 'undefined') {
                owlParams[i] = d;
            }
        }

        owlParams.responsive = {0: {items: 1}};

        var bp = t.data('breakpoint');
        if (typeof bp != 'undefined') {
            var bpx = bp.split(','),
                j;
            for (j in bpx) {
                var kx = bpx[j].split(':');
                if (kx.length == 2) {
                    owlParams.responsive[kx[0]] = {items: parseInt(kx[1])};
                }
            }
        } else {
            owlParams.responsive[560] = {items: owlParams.items};
        }

        if (typeof c != 'undefined') {
            var cp = t.find(c + ' li').length == 0 ? _b : t;
            cp.on('click', c + ' li', function (e) {
                e.preventDefault();
                var j = $(this).index(),
                    d = j == 0 ? 'next' : 'prev';
                t.trigger(d + '.owl.carousel');
            });
        }

        t.owlCarousel(owlParams);

        t.on('resized.owl.carousel', function (e) {
            $(e.target).find('.fp-box').each(function () {
                var bg = $(this).data('bg');
                if (typeof bg != 'undefined') {
                    $(this).backstretch(bg);
                }
            });
        });

    };

    $('.owl-carousel').each(owlEvent);

    /*
     * Minimize button group on small screens
     */
    var toggle_btn_group = function (e) {

        var t = $(this),
            p = t.parents('.btn-group'),
            b = t.siblings('.btn:not(.active)'),
            ch = typeof p.data('closed-height') == 'undefined' ? p.outerHeight() : p.data('closed-height'), // closed height
            oh = typeof p.data('opened-height') == 'undefined' ? ch + b.outerHeight() * b.length - 1 : p.data('opened-height');

        p.data('closed-height', ch);
        p.data('opened-height', oh);

        var current_status = p.data('current-status');
        if (typeof current_status == 'undefined') {
            current_status = 'closed';
        }

        var new_status = current_status == 'closed' ? 'opened' : 'closed';
        p.data('current-status', new_status);

        p.css({
            '-webkit-transition': 'height 0.2s',
            '-moz-transition': 'height 0.2s',
            '-ms-transition': 'height 0.2s',
            '-o-transition': 'height 0.2s',
            'transition': 'height 0.2s'
        });

        p.css('height', p.data(new_status + '-height'));

    };

    /*
     * Organize Tab Shortcut
     */
    $('.barcelona-sc-tab').each(function () {

        var t = $(this),
            el_bg = t.find('.box-header'),
            el_con = t.find('.tab-content');

        if (el_bg.length == 0) {
            el_bg = $('<div>').addClass('box-header').html($('<div>').addClass('btn-group btn-group-items-' + el_con.length).attr('role', 'group'));
            t.prepend(el_bg);
        }

        el_con.each(function () {
            var el_btn = $(this).find('.btn:first-child');
            el_bg.find('.btn-group').append(el_btn);
        });

        el_bg = el_bg.find('.btn-group');
        el_bg.find('.btn:first-child').addClass('active');
        el_bg.append($('<button>').addClass('btn-toggle').html($('<span>').addClass('fa fa-navicon')));
        t.show();

    });

    _b.on('click', '.barcelona-sc-tab .btn-group .btn', function (e) {

        e.preventDefault();

        var self = this,
            t = $(self),
            c = t.data('controls');

        if (typeof c != 'undefined') {
            $('.tab-content' + c).show().siblings('.tab-content').hide();
            t.addClass('active').siblings('.btn').removeClass('active');
        }

        if (!t.siblings('.btn-toggle').is(':hidden')) {
            toggle_btn_group.call(self, e);
        }

    });

    /*
     * Module Tabs
     */
    _b.on('click', '.btn-group .btn-toggle', toggle_btn_group);

    _b.on('click', '.posts-box .btn-group .btn', function (e) {

        e.preventDefault();

        var self = this,
            btn = $(self),
            parent = btn.parents('.posts-box'),
            type = parent.data('type');

        if (btn.hasClass('active')) {

            if (!btn.siblings('.btn-toggle').is(':hidden')) {
                toggle_btn_group.call(self, e);
            }

            return;
        }

        if (typeof type != 'undefined' && /^t[0-9]_[0-9]+$/.test(type)) {

            var t = type.split('_'),
                ajaxData = {
                    action: 'barcelona_pb',
                    barcelona_tab: t[0],
                    barcelona_module: t[1],
                    barcelona_page_id: _conf.post_id,
                    barcelona_item_id: btn.data('catid') || btn.index()
                },
                pn = parent.data('post-not');

            if (typeof pn != 'undefined') {
                ajaxData.barcelona_post_not = pn;
            }

            btn.addClass('active').siblings('.btn').removeClass('active');

            if (!btn.siblings('.btn-toggle').is(':hidden')) {
                toggle_btn_group.call(self, e);
            }

            var elLoaderName = 'loader-overlay',
                wrapper = parent.find('.posts-wrapper'),
                elLoader = wrapper.find('.' + elLoaderName);

            if (elLoader.length == 0) {

                var conWrap = $('<div>').addClass('preload-wrap pos-cc'),
                    con = $('<div>').addClass(elLoaderName).append(conWrap).hide(),
                    rots = [null, 90, 180, 270],
                    i, rot;

                for (i in rots) {
                    rot = rots[i] != null ? ' rot-' + rots[i] : '';
                    conWrap.append($('<div>').addClass('preload' + rot)
                        .append($('<div>').addClass('ln-anim-8')));
                }

                wrapper.prepend(con.fadeIn(200));

            } else if (elLoader.is(':hidden')) {

                elLoader.fadeIn(200);

            }

            $.ajax({
                type: 'post',
                dataType: 'html',
                url: _conf.ajaxurl,
                data: ajaxData,
                success: function (r) {

                    if ([0, '0', ''].indexOf(r) != -1) {
                        return;
                    }

                    wrapper.children().not('.' + elLoaderName).fadeOut(200);
                    wrapper.html(r).children().hide();
                    wrapper.children().fadeIn(200, function () {
                        wrapper.children('.owl-carousel').each(owlEvent);
                    });

                }
            });

        }

    });

    var module_pgn_load = function (e, cb) {

        if (e) {
            e.preventDefault();
        }

        var self = this,
            btn = $(self),
            el_pgn = $(self).parents('.pagination'),
            parent = el_pgn.prev('.posts-box'),
            wrapper = parent.find('.posts-wrapper'),
            type = parent.data('type'),
            paged = btn.data('paged'),
            max_pages = btn.data('max-pages');

        if (typeof paged != 'undefined' && typeof max_pages != 'undefined') {

            if (paged >= max_pages) {
                return;
            }

            paged++;

            var ajaxData = {
                action: 'barcelona_pb',
                barcelona_paged: paged
            };

            if (typeof type != 'undefined' && /^(t[0-9]|none)_[0-9]+$/.test(type)) {

                var t = type.split('_'),
                    pn = parent.data('post-not');

                ajaxData.barcelona_tab = t[0];
                ajaxData.barcelona_module = t[1];
                ajaxData.barcelona_page_id = _conf.post_id;

                if (typeof pn != 'undefined') {
                    ajaxData.barcelona_post_not = pn;
                }

            } else if (typeof _conf.query != 'undefined'
                && typeof _conf.posts_layout != 'undefined'
                && typeof _conf.post_meta_choices != 'undefined') {

                ajaxData.barcelona_query = _conf.query;
                ajaxData.barcelona_posts_layout = _conf.posts_layout;
                ajaxData.barcelona_post_meta_choices = _conf.post_meta_choices;

            } else {

                return false;

            }

            btn.prop('disabled', true).find('.btn-loader').show();

            $.ajax({
                type: 'post',
                dataType: 'html',
                url: _conf.ajaxurl,
                data: ajaxData,
                success: function (r) {

                    if (paged >= max_pages) {
                        el_pgn.hide();
                    }

                    if (el_pgn.hasClass('pagination-loadmore')) {
                        btn.prop('disabled', false).find('.btn-loader').hide();
                    }

                    if ([0, '0', ''].indexOf(r) != -1) {
                        return;
                    }

                    btn.data('paged', paged);

                    wrapper.append(r);

                    setTimeout(function(){
                        var i;
                        for(i in _col_resp) {
                            wrapper.children('.col').responsiveEqualHeightGrid();
                        }
                    }, 200);


                    if (typeof cb == 'function') {
                        cb.call(self);
                    }

                }
            });

        }

    };

    /*
     * Modules "Load More" Action Button.
     */
    _b.on('click', '.pagination-loadmore .btn', module_pgn_load);

    /*
     * Search modal
     */
    var searchForm = $('.search-form-full'),
        searchFormClose = searchForm.find('.barcelona-sc-close');

    $('.btn-search').click(function (e) {
        e.preventDefault();
        searchForm.fadeIn(50);
    });

    var closeSearchForm = function () {
        searchForm.fadeOut(50);
    };

    searchForm.add(searchFormClose).click(function () {
        closeSearchForm();
    });

    searchForm.find('.search-form-inner').click(function (e) {
        e.stopPropagation();
    });

    /*
     * Window key & resize events
     */
    $(window).keyup(function (e) {

        if (e.which == 27) {
            closeSearchForm();
        }

    });

    var aggTicking = false,
        aggScrollTop = 0,
        infLoading = false;

    function aggOnResize() {
        aggUpdateElements('resize');
    }

    function aggOnScroll() {

        if (!aggTicking) {
            aggTicking = true;
            requestAnimFrame(aggUpdateElements);
            aggScrollTop = window.pageYOffset;
        }

    }

    function aggUpdateElements(ev) {

        var aggWinHg = window.innerHeight,
            aggWinWd = window.innerWidth,
            aggWpBarHg = _el.wp_bar.length ? (aggWinWd <= 782 ? 46 : 32) : 0;

        if (ev == 'resize' && aggWinHg >= 560) {
            _el.par_wrapper.css('height', aggWinHg);
        }

        if (aggWinWd > 782 && aggScrollTop < aggWinHg && (_el.fimg_sp.length || _el.fimg_fp.length)) {

            var yPos = Math.round(aggScrollTop / 2 * 100) / 100;

            aggPrefix(_el.par_inner.find('img'), 'transform', 'translate3d(0, ' + yPos + 'px, 0)');

        }

        if (_el.fimg_fp.length || _el.fimg_fs.length) {

            var aggFimgHg = _el.par_wrapper.outerHeight() - _el.navbar.height() - aggWpBarHg;

            if (_el.breadcrumb.length) {
                aggFimgHg -= _el.breadcrumb.height();
            }

            if (_el.fimg_fp.length) {
                _el.fimg_fp.find('.fimg-inner').css('height', aggFimgHg);
            }

            if (_el.fimg_fs.length) {
                _el.fimg_fs.find('.fimg-inner').css('height', aggFimgHg);
            }

        }

        if (_el.pgn_infinite.length) {

            var pgnOffTop = _el.pgn_infinite.offset().top,
                infInitPos = aggScrollTop + aggWinHg - ( _el.pgn_infinite.height() * 2 );

            if (infInitPos >= pgnOffTop && !infLoading) {

                infLoading = true;

                var el_inf_btn = _el.pgn_infinite.find('.btn');
                el_inf_btn.css('visibility', 'visible');

                module_pgn_load.call(el_inf_btn[0], false, function () {
                    infLoading = false;
                    el_inf_btn.css('visibility', 'hidden');
                });

            }

        }

        aggTicking = false;

    }

    function aggPrefix(obj, prop, value) {
        var prefs = ['webkit', 'moz', 'o', 'ms', ''];
        for (var pref in prefs) {
            obj.css('-' + prefs[pref] + '-' + prop, value);
        }
    }

    (function () {

        aggUpdateElements('resize');
        _el.fimg_fp.find('.fimg-inner').show();
        _el.fimg_fs.find('.fimg-inner').show();

    })();

    window.addEventListener('resize', aggOnResize, false);
    window.addEventListener('scroll', aggOnScroll, false);

    _el.root.on('mousewheel DOMMouseScroll', function () {
        _el.root.stop();
    });

});