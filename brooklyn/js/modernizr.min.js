
/*!
 * modernizr v3.2.0
 * Build http://modernizr.com/download?-applicationcache-audio-backgroundsize-bgsizecover-borderimage-borderradius-boxshadow-canvas-canvastext-cssanimations-csscolumns-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-flexbox-fontface-generatedcontent-geolocation-hashchange-history-hsla-indexeddb-inlinesvg-input-inputtypes-localstorage-multiplebgs-opacity-postmessage-preserve3d-requestanimationframe-rgba-sessionstorage-smil-svg-svgclippaths-svgfilters-textshadow-touchevents-video-webgl-webglextensions-websockets-websqldatabase-webworkers-addtest-domprefixes-hasevent-mq-prefixed-prefixes-shiv-testallprops-testprop-teststyles-dontmin
 *
 * Copyright (c)
 *  Faruk Ates
 *  Paul Irish
 *  Alex Sexton
 *  Ryan Seddon
 *  Patrick Kettner
 *  Stu Cox
 *  Richard Herrera

 * MIT License
 */
(function(N,d,l){var f=[];var Y=d.documentElement;var a=Y.nodeName.toLowerCase()==="svg";var L;if(!a){(function(ai,ak){var ae="3.7.3";var ab=ai.html5||{};var af=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i;var aa=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i;var ap;var ag="_html5shiv";var i=0;var am={};var ac;(function(){try{var at=ak.createElement("a");at.innerHTML="<xyz></xyz>";ap=("hidden" in at);ac=at.childNodes.length==1||(function(){(ak.createElement)("a");var av=ak.createDocumentFragment();return(typeof av.cloneNode=="undefined"||typeof av.createDocumentFragment=="undefined"||typeof av.createElement=="undefined")}())}catch(au){ap=true;ac=true}}());function ad(at,av){var aw=at.createElement("p"),au=at.getElementsByTagName("head")[0]||at.documentElement;aw.innerHTML="x<style>"+av+"</style>";return au.insertBefore(aw.lastChild,au.firstChild)}function aj(){var at=ah.elements;return typeof at=="string"?at.split(" "):at}function an(at,au){var av=ah.elements;if(typeof av!="string"){av=av.join(" ")}if(typeof at!="string"){at=at.join(" ")}ah.elements=av+" "+at;Z(au)}function ao(at){var au=am[at[ag]];if(!au){au={};i++;at[ag]=i;am[i]=au}return au}function al(aw,at,av){if(!at){at=ak}if(ac){return at.createElement(aw)}if(!av){av=ao(at)}var au;if(av.cache[aw]){au=av.cache[aw].cloneNode()}else{if(aa.test(aw)){au=(av.cache[aw]=av.createElem(aw)).cloneNode()}else{au=av.createElem(aw)}}return au.canHaveChildren&&!af.test(aw)&&!au.tagUrn?av.frag.appendChild(au):au}function aq(av,ax){if(!av){av=ak}if(ac){return av.createDocumentFragment()}ax=ax||ao(av);var ay=ax.frag.cloneNode(),aw=0,au=aj(),at=au.length;for(;aw<at;aw++){ay.createElement(au[aw])}return ay}function ar(at,au){if(!au.cache){au.cache={};au.createElem=at.createElement;au.createFrag=at.createDocumentFragment;au.frag=au.createFrag()}at.createElement=function(av){if(!ah.shivMethods){return au.createElem(av)}return al(av,at,au)};at.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+aj().join().replace(/[\w\-:]+/g,function(av){au.createElem(av);au.frag.createElement(av);return'c("'+av+'")'})+");return n}")(ah,au.frag)}function Z(at){if(!at){at=ak}var au=ao(at);if(ah.shivCSS&&!ap&&!au.hasCSS){au.hasCSS=!!ad(at,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")}if(!ac){ar(at,au)}return at}var ah={elements:ab.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",version:ae,shivCSS:(ab.shivCSS!==false),supportsUnknownElements:ac,shivMethods:(ab.shivMethods!==false),type:"default",shivDocument:Z,createElement:al,createDocumentFragment:aq,addElements:an};ai.html5=ah;Z(ak);if(typeof module=="object"&&module.exports){module.exports=ah}}(typeof N!=="undefined"?N:this,d))}var p=[];var R={_version:"3.2.0",_config:{classPrefix:"",enableClasses:true,enableJSClass:true,usePrefixes:true},_q:[],on:function(aa,i){var Z=this;setTimeout(function(){i(Z[aa])},0)},addTest:function(Z,aa,i){p.push({name:Z,fn:aa,options:i})},addAsyncTest:function(i){p.push({name:null,fn:i})}};var I=function(){};I.prototype=R;I=new I();function b(aa){var ab=Y.className;var Z=I._config.classPrefix||"";if(a){ab=ab.baseVal}if(I._config.enableJSClass){var i=new RegExp("(^|\\s)"+Z+"no-js(\\s|$)");ab=ab.replace(i,"$1"+Z+"js$2")}if(I._config.enableClasses){ab+=" "+Z+aa.join(" "+Z);a?Y.className.baseVal=ab:Y.className=ab}}
/*!
{
  "name": "Application Cache",
  "property": "applicationcache",
  "caniuse": "offline-apps",
  "tags": ["storage", "offline"],
  "notes": [{
    "name": "MDN documentation",
    "href": "https://developer.mozilla.org/en/docs/HTML/Using_the_application_cache"
  }],
  "polyfills": ["html5gears"]
}
!*/
I.addTest("applicationcache","applicationCache" in N);
/*!
{
  "name": "Geolocation API",
  "property": "geolocation",
  "caniuse": "geolocation",
  "tags": ["media"],
  "notes": [{
    "name": "MDN documentation",
    "href": "https://developer.mozilla.org/en-US/docs/WebAPI/Using_geolocation"
  }],
  "polyfills": [
    "joshuabell-polyfill",
    "webshims",
    "geo-location-javascript",
    "geolocation-api-polyfill"
  ]
}
!*/
I.addTest("geolocation","geolocation" in navigator);
/*!
{
  "name": "History API",
  "property": "history",
  "caniuse": "history",
  "tags": ["history"],
  "authors": ["Hay Kranen", "Alexander Farkas"],
  "notes": [{
    "name": "W3C Spec",
    "href": "http://www.w3.org/TR/html51/browsers.html#the-history-interface"
  }, {
    "name": "MDN documentation",
    "href": "https://developer.mozilla.org/en-US/docs/Web/API/window.history"
  }],
  "polyfills": ["historyjs", "html5historyapi"]
}
!*/
I.addTest("history",function(){var i=navigator.userAgent;if((i.indexOf("Android 2.")!==-1||(i.indexOf("Android 4.0")!==-1))&&i.indexOf("Mobile Safari")!==-1&&i.indexOf("Chrome")===-1&&i.indexOf("Windows Phone")===-1){return false}return(N.history&&"pushState" in N.history)});
/*!
{
  "name": "postMessage",
  "property": "postmessage",
  "caniuse": "x-doc-messaging",
  "notes": [{
    "name": "W3C Spec",
    "href": "http://www.w3.org/TR/html5/comms.html#posting-messages"
  }],
  "polyfills": ["easyxdm", "postmessage-jquery"]
}
!*/
I.addTest("postmessage","postMessage" in N);
/*!
{
  "name": "SVG",
  "property": "svg",
  "caniuse": "svg",
  "tags": ["svg"],
  "authors": ["Erik Dahlstrom"],
  "polyfills": [
    "svgweb",
    "raphael",
    "amplesdk",
    "canvg",
    "svg-boilerplate",
    "sie",
    "dojogfx",
    "fabricjs"
  ]
}
!*/
I.addTest("svg",!!d.createElementNS&&!!d.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect);
/*!
{
  "name": "WebSockets Support",
  "property": "websockets",
  "authors": ["Phread [fearphage]", "Mike Sherov [mikesherov]", "Burak Yigit Kaya [BYK]"],
  "caniuse": "websockets",
  "tags": ["html5"],
  "warnings": [
    "This test will reject any old version of WebSockets even if it is not prefixed such as in Safari 5.1"
  ],
  "notes": [{
    "name": "CLOSING State and Spec",
    "href": "http://www.w3.org/TR/websockets/#the-websocket-interface"
  }],
  "polyfills": [
    "sockjs",
    "socketio",
    "kaazing-websocket-gateway",
    "websocketjs",
    "atmosphere",
    "graceful-websocket",
    "portal",
    "datachannel"
  ]
}
!*/
I.addTest("websockets","WebSocket" in N&&N.WebSocket.CLOSING===2);
/*!
{
  "name": "Local Storage",
  "property": "localstorage",
  "caniuse": "namevalue-storage",
  "tags": ["storage"],
  "knownBugs": [],
  "notes": [],
  "warnings": [],
  "polyfills": [
    "joshuabell-polyfill",
    "cupcake",
    "storagepolyfill",
    "amplifyjs",
    "yui-cacheoffline"
  ]
}
!*/
I.addTest("localstorage",function(){var i="modernizr";try{localStorage.setItem(i,i);localStorage.removeItem(i);return true}catch(Z){return false}});
/*!
{
  "name": "Session Storage",
  "property": "sessionstorage",
  "tags": ["storage"],
  "polyfills": ["joshuabell-polyfill", "cupcake", "sessionstorage"]
}
!*/
I.addTest("sessionstorage",function(){var i="modernizr";try{sessionStorage.setItem(i,i);sessionStorage.removeItem(i);return true}catch(Z){return false}});
/*!
{
  "name": "Web SQL Database",
  "property": "websqldatabase",
  "caniuse": "sql-storage",
  "tags": ["storage"]
}
!*/
I.addTest("websqldatabase","openDatabase" in N);
/*!
{
  "name": "SVG filters",
  "property": "svgfilters",
  "caniuse": "svg-filters",
  "tags": ["svg"],
  "builderAliases": ["svg_filters"],
  "authors": ["Erik Dahlstrom"],
  "notes": [{
    "name": "W3C Spec",
    "href": "http://www.w3.org/TR/SVG11/filters.html"
  }]
}
!*/
I.addTest("svgfilters",function(){var i=false;try{i="SVGFEColorMatrixElement" in N&&SVGFEColorMatrixElement.SVG_FECOLORMATRIX_TYPE_SATURATE==2}catch(Z){}return i});
/*!
{
  "name": "Web Workers",
  "property": "webworkers",
  "caniuse" : "webworkers",
  "tags": ["performance", "workers"],
  "notes": [{
    "name": "W3C Reference",
    "href": "http://www.w3.org/TR/workers/"
  }, {
    "name": "HTML5 Rocks article",
    "href": "http://www.html5rocks.com/en/tutorials/workers/basics/"
  }, {
    "name": "MDN documentation",
    "href": "https://developer.mozilla.org/en-US/docs/Web/Guide/Performance/Using_web_workers"
  }],
  "polyfills": ["fakeworker", "html5shims"]
}
!*/
I.addTest("webworkers","Worker" in N);var o=(R._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):[]);R._prefixes=o;function D(Z,i){return typeof Z===i}function W(){var ac;var ad;var aa;var i;var Z;var ab;var af;for(var ae in p){if(p.hasOwnProperty(ae)){ac=[];ad=p[ae];if(ad.name){ac.push(ad.name.toLowerCase());if(ad.options&&ad.options.aliases&&ad.options.aliases.length){for(aa=0;aa<ad.options.aliases.length;aa++){ac.push(ad.options.aliases[aa].toLowerCase())}}}i=D(ad.fn,"function")?ad.fn():ad.fn;for(Z=0;Z<ac.length;Z++){ab=ac[Z];af=ab.split(".");if(af.length===1){I[af[0]]=i}else{if(I[af[0]]&&!(I[af[0]] instanceof Boolean)){I[af[0]]=new Boolean(I[af[0]])}I[af[0]][af[1]]=i}f.push((i?"":"no-")+af.join("-"))}}}}var m="Moz O ms Webkit";var U=(R._config.usePrefixes?m.toLowerCase().split(" "):[]);R._domPrefixes=U;function G(){if(typeof d.createElement!=="function"){return d.createElement(arguments[0])}else{if(a){return d.createElementNS.call(d,"http://www.w3.org/2000/svg",arguments[0])}else{return d.createElement.apply(d,arguments)}}}var y=(function(aa){var Z=!("onblur" in d.documentElement);function i(ab,ad){var ac;if(!ab){return false}if(!ad||typeof ad==="string"){ad=G(ad||"div")}ab="on"+ab;ac=ab in ad;if(!ac&&Z){if(!ad.setAttribute){ad=G("div")}ad.setAttribute(ab,"");ac=typeof ad[ab]==="function";if(ad[ab]!==aa){ad[ab]=aa}ad.removeAttribute(ab)}return ac}return i})();R.hasEvent=y;
/*!
{
  "name": "Hashchange event",
  "property": "hashchange",
  "caniuse": "hashchange",
  "tags": ["history"],
  "notes": [{
    "name": "MDN documentation",
    "href": "https://developer.mozilla.org/en-US/docs/Web/API/window.onhashchange"
  }],
  "polyfills": [
    "jquery-hashchange",
    "moo-historymanager",
    "jquery-ajaxy",
    "hasher",
    "shistory"
  ]
}
!*/
I.addTest("hashchange",function(){if(y("hashchange",N)===false){return false}return(d.documentMode===l||d.documentMode>7)});
/*!
{
  "name" : "HTML5 Audio Element",
  "property": "audio",
  "tags" : ["html5", "audio", "media"]
}
!*/
I.addTest("audio",function(){var Z=G("audio");var i=false;try{if(i=!!Z.canPlayType){i=new Boolean(i);i.ogg=Z.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,"");i.mp3=Z.canPlayType('audio/mpeg; codecs="mp3"').replace(/^no$/,"");i.opus=Z.canPlayType('audio/ogg; codecs="opus"').replace(/^no$/,"");i.wav=Z.canPlayType('audio/wav; codecs="1"').replace(/^no$/,"");i.m4a=(Z.canPlayType("audio/x-m4a;")||Z.canPlayType("audio/aac;")).replace(/^no$/,"")}}catch(aa){}return i});
/*!
{
  "name": "Canvas",
  "property": "canvas",
  "caniuse": "canvas",
  "tags": ["canvas", "graphics"],
  "polyfills": ["flashcanvas", "excanvas", "slcanvas", "fxcanvas"]
}
!*/
I.addTest("canvas",function(){var i=G("canvas");return !!(i.getContext&&i.getContext("2d"))});
/*!
{
  "name": "Canvas text",
  "property": "canvastext",
  "caniuse": "canvas-text",
  "tags": ["canvas", "graphics"],
  "polyfills": ["canvastext"]
}
!*/
I.addTest("canvastext",function(){if(I.canvas===false){return false}return typeof G("canvas").getContext("2d").fillText=="function"});
/*!
{
  "name": "HTML5 Video",
  "property": "video",
  "caniuse": "video",
  "tags": ["html5"],
  "knownBugs": [
    "Without QuickTime, `Modernizr.video.h264` will be `undefined`; http://github.com/Modernizr/Modernizr/issues/546"
  ],
  "polyfills": [
    "html5media",
    "mediaelementjs",
    "sublimevideo",
    "videojs",
    "leanbackplayer",
    "videoforeverybody"
  ]
}
!*/
I.addTest("video",function(){var Z=G("video");var i=false;try{if(i=!!Z.canPlayType){i=new Boolean(i);i.ogg=Z.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,"");i.h264=Z.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,"");i.webm=Z.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,"");i.vp9=Z.canPlayType('video/webm; codecs="vp9"').replace(/^no$/,"");i.hls=Z.canPlayType('application/x-mpegURL; codecs="avc1.42E01E"').replace(/^no$/,"")}}catch(aa){}return i});
/*!
{
  "name": "WebGL",
  "property": "webgl",
  "caniuse": "webgl",
  "tags": ["webgl", "graphics"],
  "polyfills": ["jebgl", "cwebgl", "iewebgl"]
}
!*/
I.addTest("webgl",function(){var Z=G("canvas");var i="probablySupportsContext" in Z?"probablySupportsContext":"supportsContext";if(i in Z){return Z[i]("webgl")||Z[i]("experimental-webgl")}return"WebGLRenderingContext" in N});
/*!
{
  "name": "CSS Gradients",
  "caniuse": "css-gradients",
  "property": "cssgradients",
  "tags": ["css"],
  "knownBugs": ["False-positives on webOS (https://github.com/Modernizr/Modernizr/issues/202)"],
  "notes": [{
    "name": "Webkit Gradient Syntax",
    "href": "http://webkit.org/blog/175/introducing-css-gradients/"
  },{
    "name": "Mozilla Linear Gradient Syntax",
    "href": "http://developer.mozilla.org/en/CSS/-moz-linear-gradient"
  },{
    "name": "Mozilla Radial Gradient Syntax",
    "href": "http://developer.mozilla.org/en/CSS/-moz-radial-gradient"
  },{
    "name": "W3C Gradient Spec",
    "href": "dev.w3.org/csswg/css3-images/#gradients-"
  }]
}
!*/
I.addTest("cssgradients",function(){var af="background-image:";var ae="gradient(linear,left top,right bottom,from(#9f9),to(white));";var ab="";var ag;for(var aa=0,Z=o.length-1;aa<Z;aa++){ag=(aa===0?"to ":"");ab+=af+o[aa]+"linear-gradient("+ag+"left top, #9f9, white);"}if(I._config.usePrefixes){ab+=af+"-webkit-"+ae}var ad=G("a");var ac=ad.style;ac.cssText=ab;return(""+ac.backgroundImage).indexOf("gradient")>-1});
/*!
{
  "name": "CSS Multiple Backgrounds",
  "caniuse": "multibackgrounds",
  "property": "multiplebgs",
  "tags": ["css"]
}
!*/
I.addTest("multiplebgs",function(){var i=G("a").style;i.cssText="background:url(https://),url(https://),red url(https://)";return(/(url\s*\(.*?){3}/).test(i.background)});
/*!
{
  "name": "CSS Opacity",
  "caniuse": "css-opacity",
  "property": "opacity",
  "tags": ["css"]
}
!*/
I.addTest("opacity",function(){var i=G("a").style;i.cssText=o.join("opacity:.55;");return(/^0.55$/).test(i.opacity)});
/*!
{
  "name": "CSS rgba",
  "caniuse": "css3-colors",
  "property": "rgba",
  "tags": ["css"],
  "notes": [{
    "name": "CSSTricks Tutorial",
    "href": "http://css-tricks.com/rgba-browser-support/"
  }]
}
!*/
I.addTest("rgba",function(){var i=G("a").style;i.cssText="background-color:rgba(150,255,150,.5)";return(""+i.backgroundColor).indexOf("rgba")>-1});
/*!
{
  "name": "Inline SVG",
  "property": "inlinesvg",
  "caniuse": "svg-html5",
  "tags": ["svg"],
  "notes": [{
    "name": "Test page",
    "href": "http://paulirish.com/demo/inline-svg"
  }, {
    "name": "Test page and results",
    "href": "http://codepen.io/eltonmesquita/full/GgXbvo/"
  }],
  "polyfills": ["inline-svg-polyfill"],
  "knownBugs": ["False negative on some Chromia browsers."]
}
!*/
I.addTest("inlinesvg",function(){var i=G("div");i.innerHTML="<svg/>";return(typeof SVGRect!="undefined"&&i.firstChild&&i.firstChild.namespaceURI)=="http://www.w3.org/2000/svg"});
/*!
{
  "name": "WebGL Extensions",
  "property": "webglextensions",
  "tags": ["webgl", "graphics"],
  "builderAliases": ["webgl_extensions"],
  "async" : true,
  "authors": ["Ilmari Heikkinen"],
  "knownBugs": [],
  "notes": [{
    "name": "Kronos extensions registry",
    "href": "http://www.khronos.org/registry/webgl/extensions/"
  }]
}
!*/
I.addAsyncTest(function(){I.webglextensions=new Boolean(false);if(!I.webgl){return}var ab;var aa;var ad;try{ab=G("canvas");aa=ab.getContext("webgl")||ab.getContext("experimental-webgl");ad=aa.getSupportedExtensions()}catch(ae){return}if(aa!==l){I.webglextensions=new Boolean(true)}for(var ac=-1,Z=ad.length;++ac<Z;){I.webglextensions[ad[ac]]=true}ab=l});var J;(function(){var i=({}).hasOwnProperty;if(!D(i,"undefined")&&!D(i.call,"undefined")){J=function(Z,aa){return i.call(Z,aa)}}else{J=function(Z,aa){return((aa in Z)&&D(Z.constructor.prototype[aa],"undefined"))}}})();R._l={};R.on=function(Z,i){if(!this._l[Z]){this._l[Z]=[]}this._l[Z].push(i);if(I.hasOwnProperty(Z)){setTimeout(function(){I._trigger(Z,I[Z])},0)}};R._trigger=function(aa,Z){if(!this._l[aa]){return}var i=this._l[aa];setTimeout(function(){var ac,ab;for(ac=0;ac<i.length;ac++){ab=i[ac];ab(Z)}},0);delete this._l[aa]};function C(Z,ac){if(typeof Z=="object"){for(var i in Z){if(J(Z,i)){C(i,Z[i])}}}else{Z=Z.toLowerCase();var ab=Z.split(".");var aa=I[ab[0]];if(ab.length==2){aa=aa[ab[1]]}if(typeof aa!="undefined"){return I}ac=typeof ac=="function"?ac():ac;if(ab.length==1){I[ab[0]]=ac}else{if(I[ab[0]]&&!(I[ab[0]] instanceof Boolean)){I[ab[0]]=new Boolean(I[ab[0]])}I[ab[0]][ab[1]]=ac}b([(!!ac&&ac!=false?"":"no-")+ab.join("-")]);I._trigger(Z,ac)}return I}I._q.push(function(){R.addTest=C});function z(i){return i.replace(/([a-z])-([a-z])/g,function(ab,aa,Z){return aa+Z.toUpperCase()}).replace(/^-/,"")}function H(Z,i){return !!~(""+Z).indexOf(i)}
/*!
{
  "name": "CSS HSLA Colors",
  "caniuse": "css3-colors",
  "property": "hsla",
  "tags": ["css"]
}
!*/
I.addTest("hsla",function(){var i=G("a").style;i.cssText="background-color:hsla(120,40%,100%,.5)";return H(i.backgroundColor,"rgba")||H(i.backgroundColor,"hsla")});var X=G("input");
/*!
{
  "name": "Input attributes",
  "property": "input",
  "tags": ["forms"],
  "authors": ["Mike Taylor"],
  "notes": [{
    "name": "WHATWG spec",
    "href": "http://www.whatwg.org/specs/web-apps/current-work/multipage/the-input-element.html#input-type-attr-summary"
  }],
  "knownBugs": ["Some blackberry devices report false positive for input.multiple"]
}
!*/
var O="autocomplete autofocus list placeholder max min multiple pattern required step".split(" ");var j={};I.input=(function(ab){for(var aa=0,Z=ab.length;aa<Z;aa++){j[ab[aa]]=!!(ab[aa] in X)}if(j.list){j.list=!!(G("datalist")&&N.HTMLDataListElement)}return j})(O);
/*!
{
  "name": "Form input types",
  "property": "inputtypes",
  "caniuse": "forms",
  "tags": ["forms"],
  "authors": ["Mike Taylor"],
  "polyfills": [
    "jquerytools",
    "webshims",
    "h5f",
    "webforms2",
    "nwxforms",
    "fdslider",
    "html5slider",
    "galleryhtml5forms",
    "jscolor",
    "html5formshim",
    "selectedoptionsjs",
    "formvalidationjs"
  ]
}
!*/
var s="search tel url email datetime date month week time datetime-local number range color".split(" ");var t={};I.inputtypes=(function(ad){var Z=ad.length;var ab=":)";var af;var ae;var aa;for(var ac=0;ac<Z;ac++){X.setAttribute("type",af=ad[ac]);aa=X.type!=="text"&&"style" in X;if(aa){X.value=ab;X.style.cssText="position:absolute;visibility:hidden;";if(/^range$/.test(af)&&X.style.WebkitAppearance!==l){Y.appendChild(X);ae=d.defaultView;aa=ae.getComputedStyle&&ae.getComputedStyle(X,null).WebkitAppearance!=="textfield"&&(X.offsetHeight!==0);Y.removeChild(X)}else{if(/^(search|tel)$/.test(af)){}else{if(/^(url|email|number)$/.test(af)){aa=X.checkValidity&&X.checkValidity()===false}else{aa=X.value!=ab}}}}t[ad[ac]]=!!aa}return t})(s);
/*!
{
  "name": "CSS Supports",
  "property": "supports",
  "caniuse": "css-featurequeries",
  "tags": ["css"],
  "builderAliases": ["css_supports"],
  "notes": [{
    "name": "W3 Spec",
    "href": "http://dev.w3.org/csswg/css3-conditional/#at-supports"
  },{
    "name": "Related Github Issue",
    "href": "github.com/Modernizr/Modernizr/issues/648"
  },{
    "name": "W3 Info",
    "href": "http://dev.w3.org/csswg/css3-conditional/#the-csssupportsrule-interface"
  }]
}
!*/
var F="CSS" in N&&"supports" in N.CSS;var A="supportsCSS" in N;I.addTest("supports",F||A);var x=({}).toString;
/*!
{
  "name": "SVG clip paths",
  "property": "svgclippaths",
  "tags": ["svg"],
  "notes": [{
    "name": "Demo",
    "href": "http://srufaculty.sru.edu/david.dailey/svg/newstuff/clipPath4.svg"
  }]
}
!*/
I.addTest("svgclippaths",function(){return !!d.createElementNS&&/SVGClipPath/.test(x.call(d.createElementNS("http://www.w3.org/2000/svg","clipPath")))});
/*!
{
  "name": "SVG SMIL animation",
  "property": "smil",
  "caniuse": "svg-smil",
  "tags": ["svg"],
  "notes": [{
  "name": "W3C Synchronised Multimedia spec",
  "href": "http://www.w3.org/AudioVideo/"
  }]
}
!*/
I.addTest("smil",function(){return !!d.createElementNS&&/SVGAnimate/.test(x.call(d.createElementNS("http://www.w3.org/2000/svg","animate")))});var Q=(R._config.usePrefixes?m.split(" "):[]);R._cssomPrefixes=Q;var e=function(af){var ab=o.length;var ad=N.CSSRule;var ae;if(typeof ad==="undefined"){return l}if(!af){return false}af=af.replace(/^@/,"");ae=af.replace(/-/g,"_").toUpperCase()+"_RULE";if(ae in ad){return"@"+af}for(var Z=0;Z<ab;Z++){var ac=o[Z];var aa=ac.toUpperCase()+"_"+ae;if(aa in ad){return"@-"+ac.toLowerCase()+"-"+af}}return false};R.atRule=e;function V(){var i=d.body;if(!i){i=G(a?"svg":"body");i.fake=true}return i}function r(af,ai,aa,ah){var ag="modernizr";var Z;var ae;var ab;var ac;var i=G("div");var ad=V();if(parseInt(aa,10)){while(aa--){ab=G("div");ab.id=ah?ah[aa]:ag+(aa+1);i.appendChild(ab)}}Z=G("style");Z.type="text/css";Z.id="s"+ag;(!ad.fake?i:ad).appendChild(Z);ad.appendChild(i);if(Z.styleSheet){Z.styleSheet.cssText=af}else{Z.appendChild(d.createTextNode(af))}i.id=ag;if(ad.fake){ad.style.background="";ad.style.overflow="hidden";ac=Y.style.overflow;Y.style.overflow="hidden";Y.appendChild(ad)}ae=ai(i,af);if(ad.fake){ad.parentNode.removeChild(ad);Y.style.overflow=ac;Y.offsetHeight}else{i.parentNode.removeChild(i)}return !!ae}var k=(function(){var i=N.matchMedia||N.msMatchMedia;if(i){return function(aa){var Z=i(aa);return Z&&Z.matches||false}}return function(aa){var Z=false;r("@media "+aa+" { #modernizr { position: absolute; } }",function(ab){Z=(N.getComputedStyle?N.getComputedStyle(ab,null):ab.currentStyle)["position"]=="absolute"});return Z}})();R.mq=k;var w=R.testStyles=r;
/*!
{
  "name": "Touch Events",
  "property": "touchevents",
  "caniuse" : "touch",
  "tags": ["media", "attribute"],
  "notes": [{
    "name": "Touch Events spec",
    "href": "http://www.w3.org/TR/2013/WD-touch-events-20130124/"
  }],
  "warnings": [
    "Indicates if the browser supports the Touch Events spec, and does not necessarily reflect a touchscreen device"
  ],
  "knownBugs": [
    "False-positive on some configurations of Nokia N900",
    "False-positive on some BlackBerry 6.0 builds – https://github.com/Modernizr/Modernizr/issues/372#issuecomment-3112695"
  ]
}
!*/
I.addTest("touchevents",function(){var i;if(("ontouchstart" in N)||N.DocumentTouch&&d instanceof DocumentTouch){i=true}else{var Z=["@media (",o.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");w(Z,function(aa){i=aa.offsetTop===9})}return i});
/*!
{
  "name": "@font-face",
  "property": "fontface",
  "authors": ["Diego Perini", "Mat Marquis"],
  "tags": ["css"],
  "knownBugs": [
    "False Positive: WebOS http://github.com/Modernizr/Modernizr/issues/342",
    "False Postive: WP7 http://github.com/Modernizr/Modernizr/issues/538"
  ],
  "notes": [{
    "name": "@font-face detection routine by Diego Perini",
    "href": "http://javascript.nwbox.com/CSSSupport/"
  },{
    "name": "Filament Group @font-face compatibility research",
    "href": "https://docs.google.com/presentation/d/1n4NyG4uPRjAA8zn_pSQ_Ket0RhcWC6QlZ6LMjKeECo0/edit#slide=id.p"
  },{
    "name": "Filament Grunticon/@font-face device testing results",
    "href": "https://docs.google.com/spreadsheet/ccc?key=0Ag5_yGvxpINRdHFYeUJPNnZMWUZKR2ItMEpRTXZPdUE#gid=0"
  },{
    "name": "CSS fonts on Android",
    "href": "http://stackoverflow.com/questions/3200069/css-fonts-on-android"
  },{
    "name": "@font-face and Android",
    "href": "http://archivist.incutio.com/viewlist/css-discuss/115960"
  }]
}
!*/
var K=(function(){var ab=navigator.userAgent;var i=ab.match(/applewebkit\/([0-9]+)/gi)&&parseFloat(RegExp.$1);var aa=ab.match(/w(eb)?osbrowser/gi);var ac=ab.match(/windows phone/gi)&&ab.match(/iemobile\/([0-9])+/gi)&&parseFloat(RegExp.$1)>=9;var Z=i<533&&ab.match(/android/gi);return aa||Z||ac}());if(K){I.addTest("fontface",false)}else{w('@font-face {font-family:"font";src:url("https://")}',function(ac,ad){var ab=d.getElementById("smodernizr");var Z=ab.sheet||ab.styleSheet;var aa=Z?(Z.cssRules&&Z.cssRules[0]?Z.cssRules[0].cssText:Z.cssText||""):"";var i=/src/i.test(aa)&&aa.indexOf(ad.split(" ")[0])===0;I.addTest("fontface",i)})}
/*!
{
  "name": "CSS Generated Content",
  "property": "generatedcontent",
  "tags": ["css"],
  "warnings": ["Android won't return correct height for anything below 7px #738"],
  "notes": [{
    "name": "W3C CSS Selectors Level 3 spec",
    "href": "http://www.w3.org/TR/css3-selectors/#gen-content"
  },{
    "name": "MDN article on :before",
    "href": "https://developer.mozilla.org/en-US/docs/Web/CSS/::before"
  },{
    "name": "MDN article on :after",
    "href": "https://developer.mozilla.org/en-US/docs/Web/CSS/::before"
  }]
}
!*/
w('#modernizr{font:0/0 a}#modernizr:after{content:":)";visibility:hidden;font:7px/1 a}',function(i){I.addTest("generatedcontent",i.offsetHeight>=7)});var T={elem:G("modernizr")};I._q.push(function(){delete T.elem});var P={style:T.elem.style};I._q.unshift(function(){delete P.style});function B(i,Z){return function(){return i.apply(Z,arguments)}}function v(aa,ad,ac){var ab;for(var Z in aa){if(aa[Z] in ad){if(ac===false){return aa[Z]}ab=ad[aa[Z]];if(D(ab,"function")){return B(ab,ac||ad)}return ab}}return false}function h(i){return i.replace(/([A-Z])/g,function(aa,Z){return"-"+Z.toLowerCase()}).replace(/^ms-/,"-ms-")}function E(aa,ab){var Z=aa.length;if("CSS" in N&&"supports" in N.CSS){while(Z--){if(N.CSS.supports(h(aa[Z]),ab)){return true}}return false}else{if("CSSSupportsRule" in N){var ac=[];while(Z--){ac.push("("+h(aa[Z])+":"+ab+")")}ac=ac.join(" or ");return r("@supports ("+ac+") { #modernizr { position: absolute; } }",function(i){return getComputedStyle(i,null).position=="absolute"})}}return l}function M(ag,ac,aj,ah){ah=D(ah,"undefined")?false:ah;if(!D(aj,"undefined")){var al=E(ag,aj);if(!D(al,"undefined")){return al}}var ak,ad,Z,ab,ai;var aa=["modernizr","tspan"];while(!P.style){ak=true;P.modElem=G(aa.shift());P.style=P.modElem.style}function ae(){if(ak){delete P.style;delete P.modElem}}Z=ag.length;for(ad=0;ad<Z;ad++){ab=ag[ad];ai=P.style[ab];if(H(ab,"-")){ab=z(ab)}if(P.style[ab]!==l){if(!ah&&!D(aj,"undefined")){try{P.style[ab]=aj}catch(af){}if(P.style[ab]!=ai){ae();return ac=="pfx"?ab:true}}else{ae();return ac=="pfx"?ab:true}}}ae();return false}var g=R.testProp=function(aa,Z,i){return M([aa],l,Z,i)};
/*!
{
  "name": "CSS textshadow",
  "property": "textshadow",
  "caniuse": "css-textshadow",
  "tags": ["css"],
  "knownBugs": ["FF3.0 will false positive on this test"]
}
!*/
I.addTest("textshadow",g("textShadow","1px 1px"));function q(ae,i,ab,ac,ad){var Z=ae.charAt(0).toUpperCase()+ae.slice(1),aa=(ae+" "+Q.join(Z+" ")+Z).split(" ");if(D(i,"string")||D(i,"undefined")){return M(aa,i,ac,ad)}else{aa=(ae+" "+(U).join(Z+" ")+Z).split(" ");return v(aa,i,ab)}}R.testAllProps=q;function n(aa,i,Z){return q(aa,l,l,i,Z)}R.testAllProps=n;
/*!
{
  "name": "CSS Animations",
  "property": "cssanimations",
  "caniuse": "css-animation",
  "polyfills": ["transformie", "csssandpaper"],
  "tags": ["css"],
  "warnings": ["Android < 4 will pass this test, but can only animate a single property at a time"],
  "notes": [{
    "name" : "Article: 'Dispelling the Android CSS animation myths'",
    "href": "http://goo.gl/OGw5Gm"
  }]
}
!*/
I.addTest("cssanimations",n("animationName","a",true));
/*!
{
  "name": "Background Size",
  "property": "backgroundsize",
  "tags": ["css"],
  "knownBugs": ["This will false positive in Opera Mini - http://github.com/Modernizr/Modernizr/issues/396"],
  "notes": [{
    "name": "Related Issue",
    "href": "http://github.com/Modernizr/Modernizr/issues/396"
  }]
}
!*/
I.addTest("backgroundsize",n("backgroundSize","100%",true));
/*!
{
  "name": "Background Size Cover",
  "property": "bgsizecover",
  "tags": ["css"],
  "builderAliases": ["css_backgroundsizecover"],
  "notes": [{
    "name" : "MDN Docs",
    "href": "http://developer.mozilla.org/en/CSS/background-size"
  }]
}
!*/
I.addTest("bgsizecover",n("backgroundSize","cover"));
/*!
{
  "name": "Border Image",
  "property": "borderimage",
  "caniuse": "border-image",
  "polyfills": ["css3pie"],
   "knownBugs": ["Android < 2.0 is true, but has a broken implementation"],
  "tags": ["css"]
}
!*/
I.addTest("borderimage",n("borderImage","url() 1",true));
/*!
{
  "name": "Border Radius",
  "property": "borderradius",
  "caniuse": "border-radius",
  "polyfills": ["css3pie"],
  "tags": ["css"],
  "notes": [{
    "name": "Comprehensive Compat Chart",
    "href": "http://muddledramblings.com/table-of-css3-border-radius-compliance"
  }]
}
!*/
I.addTest("borderradius",n("borderRadius","0px",true));
/*!
{
  "name": "Box Shadow",
  "property": "boxshadow",
  "caniuse": "css-boxshadow",
  "tags": ["css"],
  "knownBugs": [
    "WebOS false positives on this test.",
    "The Kindle Silk browser false positives"
  ]
}
!*/
I.addTest("boxshadow",n("boxShadow","1px 1px",true));
/*!
{
  "name": "CSS Columns",
  "property": "csscolumns",
  "caniuse": "multicolumn",
  "polyfills": ["css3multicolumnjs"],
  "tags": ["css"]
}
!*/
(function(){I.addTest("csscolumns",function(){var i=false;var ae=n("columnCount");try{if(i=!!ae){i=new Boolean(i)}}catch(ad){}return i});var ab=["Width","Span","Fill","Gap","Rule","RuleColor","RuleStyle","RuleWidth","BreakBefore","BreakAfter","BreakInside"];var Z,ac;for(var aa=0;aa<ab.length;aa++){Z=ab[aa].toLowerCase();ac=n("column"+ab[aa]);if(Z==="breakbefore"||Z==="breakafter"||Z=="breakinside"){ac=ac||n(ab[aa])}I.addTest("csscolumns."+Z,ac)}})();
/*!
{
  "name": "Flexbox",
  "property": "flexbox",
  "caniuse": "flexbox",
  "tags": ["css"],
  "notes": [{
    "name": "The _new_ flexbox",
    "href": "http://dev.w3.org/csswg/css3-flexbox"
  }],
  "warnings": [
    "A `true` result for this detect does not imply that the `flex-wrap` property is supported; see the `flexwrap` detect."
  ]
}
!*/
I.addTest("flexbox",n("flexBasis","1px",true));
/*!
{
  "name": "CSS Reflections",
  "caniuse": "css-reflections",
  "property": "cssreflections",
  "tags": ["css"]
}
!*/
I.addTest("cssreflections",n("boxReflect","above",true));
/*!
{
  "name": "CSS Transforms",
  "property": "csstransforms",
  "caniuse": "transforms2d",
  "tags": ["css"]
}
!*/
I.addTest("csstransforms",function(){return navigator.userAgent.indexOf("Android 2.")===-1&&n("transform","scale(1)",true)});
/*!
{
  "name": "CSS Transforms 3D",
  "property": "csstransforms3d",
  "caniuse": "transforms3d",
  "tags": ["css"],
  "warnings": [
    "Chrome may occassionally fail this test on some systems; more info: https://code.google.com/p/chromium/issues/detail?id=129004"
  ]
}
!*/
I.addTest("csstransforms3d",function(){var Z=!!n("perspective","1px",true);var i=I._config.usePrefixes;if(Z&&(!i||"webkitPerspective" in Y.style)){var aa;var ab="#modernizr{width:0;height:0}";if(I.supports){aa="@supports (perspective: 1px)"}else{aa="@media (transform-3d)";if(i){aa+=",(-webkit-transform-3d)"}}aa+="{#modernizr{width:7px;height:18px;margin:0;padding:0;border:0}}";w(ab+aa,function(ac){Z=ac.offsetWidth===7&&ac.offsetHeight===18})}return Z});
/*!
{
  "name": "CSS Transform Style preserve-3d",
  "property": "preserve3d",
  "authors": ["edmellum"],
  "tags": ["css"],
  "notes": [{
    "name": "MDN Docs",
    "href": "https://developer.mozilla.org/en-US/docs/Web/CSS/transform-style"
  },{
    "name": "Related Github Issue",
    "href": "https://github.com/Modernizr/Modernizr/issues/762"
  }]
}
!*/
I.addTest("preserve3d",n("transformStyle","preserve-3d"));
/*!
{
  "name": "CSS Transitions",
  "property": "csstransitions",
  "caniuse": "css-transitions",
  "tags": ["css"]
}
!*/
I.addTest("csstransitions",n("transition","all",true));var u=R.prefixed=function(aa,Z,i){if(aa.indexOf("@")===0){return e(aa)}if(aa.indexOf("-")!=-1){aa=z(aa)}if(!Z){return q(aa,"pfx")}else{return q(aa,Z,i)}};
/*!
{
  "name": "IndexedDB",
  "property": "indexeddb",
  "caniuse": "indexeddb",
  "tags": ["storage"],
  "polyfills": ["indexeddb"]
}
!*/
var c=u("indexedDB",N);I.addTest("indexeddb",!!c);if(!!c){I.addTest("indexeddb.deletedatabase","deleteDatabase" in c)}
/*!
{
  "name": "requestAnimationFrame",
  "property": "requestanimationframe",
  "aliases": ["raf"],
  "caniuse": "requestanimationframe",
  "tags": ["animation"],
  "authors": ["Addy Osmani"],
  "notes": [{
    "name": "W3C spec",
    "href": "http://www.w3.org/TR/animation-timing/"
  }],
  "polyfills": ["raf"]
}
!*/
I.addTest("requestanimationframe",!!u("requestAnimationFrame",N),{aliases:["raf"]});W();b(f);delete R.addTest;delete R.addAsyncTest;for(var S=0;S<I._q.length;S++){I._q[S]()}N.Modernizr=I})(window,document);