/*!
 * imagesLoaded PACKAGED v3.1.8
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */
(function(){function e(){}function t(e,t){for(var n=e.length;n--;)if(e[n].listener===t)return n;return-1}function n(e){return function(){return this[e].apply(this,arguments)}}var i=e.prototype,r=this,o=r.EventEmitter;i.getListeners=function(e){var t,n,i=this._getEvents();if("object"==typeof e){t={};for(n in i)i.hasOwnProperty(n)&&e.test(n)&&(t[n]=i[n])}else t=i[e]||(i[e]=[]);return t},i.flattenListeners=function(e){var t,n=[];for(t=0;e.length>t;t+=1)n.push(e[t].listener);return n},i.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},i.addListener=function(e,n){var i,r=this.getListenersAsObject(e),o="object"==typeof n;for(i in r)r.hasOwnProperty(i)&&-1===t(r[i],n)&&r[i].push(o?n:{listener:n,once:!1});return this},i.on=n("addListener"),i.addOnceListener=function(e,t){return this.addListener(e,{listener:t,once:!0})},i.once=n("addOnceListener"),i.defineEvent=function(e){return this.getListeners(e),this},i.defineEvents=function(e){for(var t=0;e.length>t;t+=1)this.defineEvent(e[t]);return this},i.removeListener=function(e,n){var i,r,o=this.getListenersAsObject(e);for(r in o)o.hasOwnProperty(r)&&(i=t(o[r],n),-1!==i&&o[r].splice(i,1));return this},i.off=n("removeListener"),i.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},i.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},i.manipulateListeners=function(e,t,n){var i,r,o=e?this.removeListener:this.addListener,s=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(i=n.length;i--;)o.call(this,t,n[i]);else for(i in t)t.hasOwnProperty(i)&&(r=t[i])&&("function"==typeof r?o.call(this,i,r):s.call(this,i,r));return this},i.removeEvent=function(e){var t,n=typeof e,i=this._getEvents();if("string"===n)delete i[e];else if("object"===n)for(t in i)i.hasOwnProperty(t)&&e.test(t)&&delete i[t];else delete this._events;return this},i.removeAllListeners=n("removeEvent"),i.emitEvent=function(e,t){var n,i,r,o,s=this.getListenersAsObject(e);for(r in s)if(s.hasOwnProperty(r))for(i=s[r].length;i--;)n=s[r][i],n.once===!0&&this.removeListener(e,n.listener),o=n.listener.apply(this,t||[]),o===this._getOnceReturnValue()&&this.removeListener(e,n.listener);return this},i.trigger=n("emitEvent"),i.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},i.setOnceReturnValue=function(e){return this._onceReturnValue=e,this},i._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},i._getEvents=function(){return this._events||(this._events={})},e.noConflict=function(){return r.EventEmitter=o,e},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return e}):"object"==typeof module&&module.exports?module.exports=e:this.EventEmitter=e}).call(this),function(e){function t(t){var n=e.event;return n.target=n.target||n.srcElement||t,n}var n=document.documentElement,i=function(){};n.addEventListener?i=function(e,t,n){e.addEventListener(t,n,!1)}:n.attachEvent&&(i=function(e,n,i){e[n+i]=i.handleEvent?function(){var n=t(e);i.handleEvent.call(i,n)}:function(){var n=t(e);i.call(e,n)},e.attachEvent("on"+n,e[n+i])});var r=function(){};n.removeEventListener?r=function(e,t,n){e.removeEventListener(t,n,!1)}:n.detachEvent&&(r=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(i){e[t+n]=void 0}});var o={bind:i,unbind:r};"function"==typeof define&&define.amd?define("eventie/eventie",o):e.eventie=o}(this),function(e,t){"function"==typeof define&&define.amd?define(["eventEmitter/EventEmitter","eventie/eventie"],function(n,i){return t(e,n,i)}):"object"==typeof exports?module.exports=t(e,require("wolfy87-eventemitter"),require("eventie")):e.imagesLoaded=t(e,e.EventEmitter,e.eventie)}(window,function(e,t,n){function i(e,t){for(var n in t)e[n]=t[n];return e}function r(e){return"[object Array]"===d.call(e)}function o(e){var t=[];if(r(e))t=e;else if("number"==typeof e.length)for(var n=0,i=e.length;i>n;n++)t.push(e[n]);else t.push(e);return t}function s(e,t,n){if(!(this instanceof s))return new s(e,t);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=o(e),this.options=i({},this.options),"function"==typeof t?n=t:i(this.options,t),n&&this.on("always",n),this.getImages(),a&&(this.jqDeferred=new a.Deferred);var r=this;setTimeout(function(){r.check()})}function f(e){this.img=e}function c(e){this.src=e,v[e]=this}var a=e.jQuery,u=e.console,h=u!==void 0,d=Object.prototype.toString;s.prototype=new t,s.prototype.options={},s.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);var i=n.nodeType;if(i&&(1===i||9===i||11===i))for(var r=n.querySelectorAll("img"),o=0,s=r.length;s>o;o++){var f=r[o];this.addImage(f)}}},s.prototype.addImage=function(e){var t=new f(e);this.images.push(t)},s.prototype.check=function(){function e(e,r){return t.options.debug&&h&&u.log("confirm",e,r),t.progress(e),n++,n===i&&t.complete(),!0}var t=this,n=0,i=this.images.length;if(this.hasAnyBroken=!1,!i)return this.complete(),void 0;for(var r=0;i>r;r++){var o=this.images[r];o.on("confirm",e),o.check()}},s.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded;var t=this;setTimeout(function(){t.emit("progress",t,e),t.jqDeferred&&t.jqDeferred.notify&&t.jqDeferred.notify(t,e)})},s.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";this.isComplete=!0;var t=this;setTimeout(function(){if(t.emit(e,t),t.emit("always",t),t.jqDeferred){var n=t.hasAnyBroken?"reject":"resolve";t.jqDeferred[n](t)}})},a&&(a.fn.imagesLoaded=function(e,t){var n=new s(this,e,t);return n.jqDeferred.promise(a(this))}),f.prototype=new t,f.prototype.check=function(){var e=v[this.img.src]||new c(this.img.src);if(e.isConfirmed)return this.confirm(e.isLoaded,"cached was confirmed"),void 0;if(this.img.complete&&void 0!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void 0;var t=this;e.on("confirm",function(e,n){return t.confirm(e.isLoaded,n),!0}),e.check()},f.prototype.confirm=function(e,t){this.isLoaded=e,this.emit("confirm",this,t)};var v={};return c.prototype=new t,c.prototype.check=function(){if(!this.isChecked){var e=new Image;n.bind(e,"load",this),n.bind(e,"error",this),e.src=this.src,this.isChecked=!0}},c.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},c.prototype.onload=function(e){this.confirm(!0,"onload"),this.unbindProxyEvents(e)},c.prototype.onerror=function(e){this.confirm(!1,"onerror"),this.unbindProxyEvents(e)},c.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},c.prototype.unbindProxyEvents=function(e){n.unbind(e.target,"load",this),n.unbind(e.target,"error",this)},s});

/*! skrollr 0.6.27 (2014-09-28) | Alexander Prinzhorn - https://github.com/Prinzhorn/skrollr | Free to use under terms of MIT license */
(function(e,t,r){"use strict";function n(r){if(o=t.documentElement,a=t.body,K(),it=this,r=r||{},ut=r.constants||{},r.easing)for(var n in r.easing)U[n]=r.easing[n];yt=r.edgeStrategy||"set",ct={beforerender:r.beforerender,render:r.render,keyframe:r.keyframe},ft=r.forceHeight!==!1,ft&&(Vt=r.scale||1),mt=r.mobileDeceleration||x,dt=r.smoothScrolling!==!1,gt=r.smoothScrollingDuration||E,vt={targetTop:it.getScrollTop()},Gt=(r.mobileCheck||function(){return/Android|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent||navigator.vendor||e.opera)})(),Gt?(st=t.getElementById("skrollr-body"),st&&at(),X(),Dt(o,[y,S],[T])):Dt(o,[y,b],[T]),it.refresh(),St(e,"resize orientationchange",function(){var e=o.clientWidth,t=o.clientHeight;(t!==$t||e!==Mt)&&($t=t,Mt=e,_t=!0)});var i=Y();return function l(){Z(),bt=i(l)}(),it}var o,a,i={get:function(){return it},init:function(e){return it||new n(e)},VERSION:"0.6.26"},l=Object.prototype.hasOwnProperty,s=e.Math,c=e.getComputedStyle,f="touchstart",u="touchmove",m="touchcancel",p="touchend",d="skrollable",g=d+"-before",v=d+"-between",h=d+"-after",y="skrollr",T="no-"+y,b=y+"-desktop",S=y+"-mobile",k="linear",w=1e3,x=.004,E=200,A="start",F="end",C="center",D="bottom",H="___skrollable_id",I=/^(?:input|textarea|button|select)$/i,P=/^\s+|\s+$/g,N=/^data(?:-(_\w+))?(?:-?(-?\d*\.?\d+p?))?(?:-?(start|end|top|center|bottom))?(?:-?(top|center|bottom))?$/,O=/\s*(@?[\w\-\[\]]+)\s*:\s*(.+?)\s*(?:;|$)/gi,V=/^(@?[a-z\-]+)\[(\w+)\]$/,z=/-([a-z0-9_])/g,q=function(e,t){return t.toUpperCase()},L=/[\-+]?[\d]*\.?[\d]+/g,M=/\{\?\}/g,$=/rgba?\(\s*-?\d+\s*,\s*-?\d+\s*,\s*-?\d+/g,_=/[a-z\-]+-gradient/g,B="",G="",K=function(){var e=/^(?:O|Moz|webkit|ms)|(?:-(?:o|moz|webkit|ms)-)/;if(c){var t=c(a,null);for(var n in t)if(B=n.match(e)||+n==n&&t[n].match(e))break;if(!B)return B=G="",r;B=B[0],"-"===B.slice(0,1)?(G=B,B={"-webkit-":"webkit","-moz-":"Moz","-ms-":"ms","-o-":"O"}[B]):G="-"+B.toLowerCase()+"-"}},Y=function(){var t=e.requestAnimationFrame||e[B.toLowerCase()+"RequestAnimationFrame"],r=Pt();return(Gt||!t)&&(t=function(t){var n=Pt()-r,o=s.max(0,1e3/60-n);return e.setTimeout(function(){r=Pt(),t()},o)}),t},R=function(){var t=e.cancelAnimationFrame||e[B.toLowerCase()+"CancelAnimationFrame"];return(Gt||!t)&&(t=function(t){return e.clearTimeout(t)}),t},U={begin:function(){return 0},end:function(){return 1},linear:function(e){return e},quadratic:function(e){return e*e},cubic:function(e){return e*e*e},swing:function(e){return-s.cos(e*s.PI)/2+.5},sqrt:function(e){return s.sqrt(e)},outCubic:function(e){return s.pow(e-1,3)+1},bounce:function(e){var t;if(.5083>=e)t=3;else if(.8489>=e)t=9;else if(.96208>=e)t=27;else{if(!(.99981>=e))return 1;t=91}return 1-s.abs(3*s.cos(1.028*e*t)/t)}};n.prototype.refresh=function(e){var n,o,a=!1;for(e===r?(a=!0,lt=[],Bt=0,e=t.getElementsByTagName("*")):e.length===r&&(e=[e]),n=0,o=e.length;o>n;n++){var i=e[n],l=i,s=[],c=dt,f=yt,u=!1;if(a&&H in i&&delete i[H],i.attributes){for(var m=0,p=i.attributes.length;p>m;m++){var g=i.attributes[m];if("data-anchor-target"!==g.name)if("data-smooth-scrolling"!==g.name)if("data-edge-strategy"!==g.name)if("data-emit-events"!==g.name){var v=g.name.match(N);if(null!==v){var h={props:g.value,element:i,eventType:g.name.replace(z,q)};s.push(h);var y=v[1];y&&(h.constant=y.substr(1));var T=v[2];/p$/.test(T)?(h.isPercentage=!0,h.offset=(0|T.slice(0,-1))/100):h.offset=0|T;var b=v[3],S=v[4]||b;b&&b!==A&&b!==F?(h.mode="relative",h.anchors=[b,S]):(h.mode="absolute",b===F?h.isEnd=!0:h.isPercentage||(h.offset=h.offset*Vt))}}else u=!0;else f=g.value;else c="off"!==g.value;else if(l=t.querySelector(g.value),null===l)throw'Unable to find anchor target "'+g.value+'"'}if(s.length){var k,w,x;!a&&H in i?(x=i[H],k=lt[x].styleAttr,w=lt[x].classAttr):(x=i[H]=Bt++,k=i.style.cssText,w=Ct(i)),lt[x]={element:i,styleAttr:k,classAttr:w,anchorTarget:l,keyFrames:s,smoothScrolling:c,edgeStrategy:f,emitEvents:u,lastFrameIndex:-1},Dt(i,[d],[])}}}for(Et(),n=0,o=e.length;o>n;n++){var E=lt[e[n][H]];E!==r&&(J(E),et(E))}return it},n.prototype.relativeToAbsolute=function(e,t,r){var n=o.clientHeight,a=e.getBoundingClientRect(),i=a.top,l=a.bottom-a.top;return t===D?i-=n:t===C&&(i-=n/2),r===D?i+=l:r===C&&(i+=l/2),i+=it.getScrollTop(),0|i+.5},n.prototype.animateTo=function(e,t){t=t||{};var n=Pt(),o=it.getScrollTop();return pt={startTop:o,topDiff:e-o,targetTop:e,duration:t.duration||w,startTime:n,endTime:n+(t.duration||w),easing:U[t.easing||k],done:t.done},pt.topDiff||(pt.done&&pt.done.call(it,!1),pt=r),it},n.prototype.stopAnimateTo=function(){pt&&pt.done&&pt.done.call(it,!0),pt=r},n.prototype.isAnimatingTo=function(){return!!pt},n.prototype.isMobile=function(){return Gt},n.prototype.setScrollTop=function(t,r){return ht=r===!0,Gt?Kt=s.min(s.max(t,0),Ot):e.scrollTo(0,t),it},n.prototype.getScrollTop=function(){return Gt?Kt:e.pageYOffset||o.scrollTop||a.scrollTop||0},n.prototype.getMaxScrollTop=function(){return Ot},n.prototype.on=function(e,t){return ct[e]=t,it},n.prototype.off=function(e){return delete ct[e],it},n.prototype.destroy=function(){var e=R();e(bt),wt(),Dt(o,[T],[y,b,S]);for(var t=0,n=lt.length;n>t;t++)ot(lt[t].element);o.style.overflow=a.style.overflow="",o.style.height=a.style.height="",st&&i.setStyle(st,"transform","none"),it=r,st=r,ct=r,ft=r,Ot=0,Vt=1,ut=r,mt=r,zt="down",qt=-1,Mt=0,$t=0,_t=!1,pt=r,dt=r,gt=r,vt=r,ht=r,Bt=0,yt=r,Gt=!1,Kt=0,Tt=r};var X=function(){var n,i,l,c,d,g,v,h,y,T,b,S;St(o,[f,u,m,p].join(" "),function(e){var o=e.changedTouches[0];for(c=e.target;3===c.nodeType;)c=c.parentNode;switch(d=o.clientY,g=o.clientX,T=e.timeStamp,I.test(c.tagName)||e.preventDefault(),e.type){case f:n&&n.blur(),it.stopAnimateTo(),n=c,i=v=d,l=g,y=T;break;case u:I.test(c.tagName)&&t.activeElement!==c&&e.preventDefault(),h=d-v,S=T-b,it.setScrollTop(Kt-h,!0),v=d,b=T;break;default:case m:case p:var a=i-d,k=l-g,w=k*k+a*a;if(49>w){if(!I.test(n.tagName)){n.focus();var x=t.createEvent("MouseEvents");x.initMouseEvent("click",!0,!0,e.view,1,o.screenX,o.screenY,o.clientX,o.clientY,e.ctrlKey,e.altKey,e.shiftKey,e.metaKey,0,null),n.dispatchEvent(x)}return}n=r;var E=h/S;E=s.max(s.min(E,3),-3);var A=s.abs(E/mt),F=E*A+.5*mt*A*A,C=it.getScrollTop()-F,D=0;C>Ot?(D=(Ot-C)/F,C=Ot):0>C&&(D=-C/F,C=0),A*=1-D,it.animateTo(0|C+.5,{easing:"outCubic",duration:A})}}),e.scrollTo(0,0),o.style.overflow=a.style.overflow="hidden"},j=function(){var e,t,r,n,a,i,l,c,f,u,m,p=o.clientHeight,d=At();for(c=0,f=lt.length;f>c;c++)for(e=lt[c],t=e.element,r=e.anchorTarget,n=e.keyFrames,a=0,i=n.length;i>a;a++)l=n[a],u=l.offset,m=d[l.constant]||0,l.frame=u,l.isPercentage&&(u*=p,l.frame=u),"relative"===l.mode&&(ot(t),l.frame=it.relativeToAbsolute(r,l.anchors[0],l.anchors[1])-u,ot(t,!0)),l.frame+=m,ft&&!l.isEnd&&l.frame>Ot&&(Ot=l.frame);for(Ot=s.max(Ot,Ft()),c=0,f=lt.length;f>c;c++){for(e=lt[c],n=e.keyFrames,a=0,i=n.length;i>a;a++)l=n[a],m=d[l.constant]||0,l.isEnd&&(l.frame=Ot-l.offset+m);e.keyFrames.sort(Nt)}},W=function(e,t){for(var r=0,n=lt.length;n>r;r++){var o,a,s=lt[r],c=s.element,f=s.smoothScrolling?e:t,u=s.keyFrames,m=u.length,p=u[0],y=u[u.length-1],T=p.frame>f,b=f>y.frame,S=T?p:y,k=s.emitEvents,w=s.lastFrameIndex;if(T||b){if(T&&-1===s.edge||b&&1===s.edge)continue;switch(T?(Dt(c,[g],[h,v]),k&&w>-1&&(xt(c,p.eventType,zt),s.lastFrameIndex=-1)):(Dt(c,[h],[g,v]),k&&m>w&&(xt(c,y.eventType,zt),s.lastFrameIndex=m)),s.edge=T?-1:1,s.edgeStrategy){case"reset":ot(c);continue;case"ease":f=S.frame;break;default:case"set":var x=S.props;for(o in x)l.call(x,o)&&(a=nt(x[o].value),0===o.indexOf("@")?c.setAttribute(o.substr(1),a):i.setStyle(c,o,a));continue}}else 0!==s.edge&&(Dt(c,[d,v],[g,h]),s.edge=0);for(var E=0;m-1>E;E++)if(f>=u[E].frame&&u[E+1].frame>=f){var A=u[E],F=u[E+1];for(o in A.props)if(l.call(A.props,o)){var C=(f-A.frame)/(F.frame-A.frame);C=A.props[o].easing(C),a=rt(A.props[o].value,F.props[o].value,C),a=nt(a),0===o.indexOf("@")?c.setAttribute(o.substr(1),a):i.setStyle(c,o,a)}k&&w!==E&&("down"===zt?xt(c,A.eventType,zt):xt(c,F.eventType,zt),s.lastFrameIndex=E);break}}},Z=function(){_t&&(_t=!1,Et());var e,t,n=it.getScrollTop(),o=Pt();if(pt)o>=pt.endTime?(n=pt.targetTop,e=pt.done,pt=r):(t=pt.easing((o-pt.startTime)/pt.duration),n=0|pt.startTop+t*pt.topDiff),it.setScrollTop(n,!0);else if(!ht){var a=vt.targetTop-n;a&&(vt={startTop:qt,topDiff:n-qt,targetTop:n,startTime:Lt,endTime:Lt+gt}),vt.endTime>=o&&(t=U.sqrt((o-vt.startTime)/gt),n=0|vt.startTop+t*vt.topDiff)}if(Gt&&st&&i.setStyle(st,"transform","translate(0, "+-Kt+"px) "+Tt),ht||qt!==n){zt=n>qt?"down":qt>n?"up":zt,ht=!1;var l={curTop:n,lastTop:qt,maxTop:Ot,direction:zt},s=ct.beforerender&&ct.beforerender.call(it,l);s!==!1&&(W(n,it.getScrollTop()),qt=n,ct.render&&ct.render.call(it,l)),e&&e.call(it,!1)}Lt=o},J=function(e){for(var t=0,r=e.keyFrames.length;r>t;t++){for(var n,o,a,i,l=e.keyFrames[t],s={};null!==(i=O.exec(l.props));)a=i[1],o=i[2],n=a.match(V),null!==n?(a=n[1],n=n[2]):n=k,o=o.indexOf("!")?Q(o):[o.slice(1)],s[a]={value:o,easing:U[n]};l.props=s}},Q=function(e){var t=[];return $.lastIndex=0,e=e.replace($,function(e){return e.replace(L,function(e){return 100*(e/255)+"%"})}),G&&(_.lastIndex=0,e=e.replace(_,function(e){return G+e})),e=e.replace(L,function(e){return t.push(+e),"{?}"}),t.unshift(e),t},et=function(e){var t,r,n={};for(t=0,r=e.keyFrames.length;r>t;t++)tt(e.keyFrames[t],n);for(n={},t=e.keyFrames.length-1;t>=0;t--)tt(e.keyFrames[t],n)},tt=function(e,t){var r;for(r in t)l.call(e.props,r)||(e.props[r]=t[r]);for(r in e.props)t[r]=e.props[r]},rt=function(e,t,r){var n,o=e.length;if(o!==t.length)throw"Can't interpolate between \""+e[0]+'" and "'+t[0]+'"';var a=[e[0]];for(n=1;o>n;n++)a[n]=e[n]+(t[n]-e[n])*r;return a},nt=function(e){var t=1;return M.lastIndex=0,e[0].replace(M,function(){return e[t++]})},ot=function(e,t){e=[].concat(e);for(var r,n,o=0,a=e.length;a>o;o++)n=e[o],r=lt[n[H]],r&&(t?(n.style.cssText=r.dirtyStyleAttr,Dt(n,r.dirtyClassAttr)):(r.dirtyStyleAttr=n.style.cssText,r.dirtyClassAttr=Ct(n),n.style.cssText=r.styleAttr,Dt(n,r.classAttr)))},at=function(){Tt="translateZ(0)",i.setStyle(st,"transform",Tt);var e=c(st),t=e.getPropertyValue("transform"),r=e.getPropertyValue(G+"transform"),n=t&&"none"!==t||r&&"none"!==r;n||(Tt="")};i.setStyle=function(e,t,r){var n=e.style;if(t=t.replace(z,q).replace("-",""),"zIndex"===t)n[t]=isNaN(r)?r:""+(0|r);else if("float"===t)n.styleFloat=n.cssFloat=r;else try{B&&(n[B+t.slice(0,1).toUpperCase()+t.slice(1)]=r),n[t]=r}catch(o){}};var it,lt,st,ct,ft,ut,mt,pt,dt,gt,vt,ht,yt,Tt,bt,St=i.addEvent=function(t,r,n){var o=function(t){return t=t||e.event,t.target||(t.target=t.srcElement),t.preventDefault||(t.preventDefault=function(){t.returnValue=!1,t.defaultPrevented=!0}),n.call(this,t)};r=r.split(" ");for(var a,i=0,l=r.length;l>i;i++)a=r[i],t.addEventListener?t.addEventListener(a,n,!1):t.attachEvent("on"+a,o),Yt.push({element:t,name:a,listener:n})},kt=i.removeEvent=function(e,t,r){t=t.split(" ");for(var n=0,o=t.length;o>n;n++)e.removeEventListener?e.removeEventListener(t[n],r,!1):e.detachEvent("on"+t[n],r)},wt=function(){for(var e,t=0,r=Yt.length;r>t;t++)e=Yt[t],kt(e.element,e.name,e.listener);Yt=[]},xt=function(e,t,r){ct.keyframe&&ct.keyframe.call(it,e,t,r)},Et=function(){var e=it.getScrollTop();Ot=0,ft&&!Gt&&(a.style.height=""),j(),ft&&!Gt&&(a.style.height=Ot+o.clientHeight+"px"),Gt?it.setScrollTop(s.min(it.getScrollTop(),Ot)):it.setScrollTop(e,!0),ht=!0},At=function(){var e,t,r=o.clientHeight,n={};for(e in ut)t=ut[e],"function"==typeof t?t=t.call(it):/p$/.test(t)&&(t=t.slice(0,-1)/100*r),n[e]=t;return n},Ft=function(){var e=st&&st.offsetHeight||0,t=s.max(e,a.scrollHeight,a.offsetHeight,o.scrollHeight,o.offsetHeight,o.clientHeight);return t-o.clientHeight},Ct=function(t){var r="className";return e.SVGElement&&t instanceof e.SVGElement&&(t=t[r],r="baseVal"),t[r]},Dt=function(t,n,o){var a="className";if(e.SVGElement&&t instanceof e.SVGElement&&(t=t[a],a="baseVal"),o===r)return t[a]=n,r;for(var i=t[a],l=0,s=o.length;s>l;l++)i=It(i).replace(It(o[l])," ");i=Ht(i);for(var c=0,f=n.length;f>c;c++)-1===It(i).indexOf(It(n[c]))&&(i+=" "+n[c]);t[a]=Ht(i)},Ht=function(e){return e.replace(P,"")},It=function(e){return" "+e+" "},Pt=Date.now||function(){return+new Date},Nt=function(e,t){return e.frame-t.frame},Ot=0,Vt=1,zt="down",qt=-1,Lt=Pt(),Mt=0,$t=0,_t=!1,Bt=0,Gt=!1,Kt=0,Yt=[];"function"==typeof define&&define.amd?define([],function(){return i}):"undefined"!=typeof module&&module.exports?module.exports=i:e.skrollr=i})(window,document);

/*! http://mths.be/placeholder v2.0.7 by @mathias */
(function(e,t,n){function l(e){var t={};var r=/^jQuery\d+$/;n.each(e.attributes,function(e,n){if(n.specified&&!r.test(n.name)){t[n.name]=n.value}});return t}function c(e,t){var r=this;var i=n(r);if(r.value==i.attr("placeholder")&&i.hasClass("placeholder")){if(i.data("placeholder-password")){i=i.hide().next().show().attr("id",i.removeAttr("id").data("placeholder-id"));if(e===true){return i[0].value=t}i.focus()}else{r.value="";i.removeClass("placeholder");r==p()&&r.select()}}}function h(){var e;var t=this;var r=n(t);var i=this.id;if(t.value==""){if(t.type=="password"){if(!r.data("placeholder-textinput")){try{e=r.clone().attr({type:"text"})}catch(s){e=n("<input>").attr(n.extend(l(this),{type:"text"}))}e.removeAttr("name").data({"placeholder-password":r,"placeholder-id":i}).bind("focus.placeholder",c);r.data({"placeholder-textinput":e,"placeholder-id":i}).before(e)}r=r.removeAttr("id").hide().prev().attr("id",i).show()}r.addClass("placeholder");r[0].value=r.attr("placeholder")}else{r.removeClass("placeholder")}}function p(){try{return t.activeElement}catch(e){}}var r="placeholder"in t.createElement("input");var i="placeholder"in t.createElement("textarea");var s=n.fn;var o=n.valHooks;var u=n.propHooks;var a;var f;if(r&&i){f=s.placeholder=function(){return this};f.input=f.textarea=true}else{f=s.placeholder=function(){var e=this;e.filter((r?"textarea":":input")+"[placeholder]").not(".placeholder").bind({"focus.placeholder":c,"blur.placeholder":h}).data("placeholder-enabled",true).trigger("blur.placeholder");return e};f.input=r;f.textarea=i;a={get:function(e){var t=n(e);var r=t.data("placeholder-password");if(r){return r[0].value}return t.data("placeholder-enabled")&&t.hasClass("placeholder")?"":e.value},set:function(e,t){var r=n(e);var i=r.data("placeholder-password");if(i){return i[0].value=t}if(!r.data("placeholder-enabled")){return e.value=t}if(t==""){e.value=t;if(e!=p()){h.call(e)}}else if(r.hasClass("placeholder")){c.call(e,true,t)||(e.value=t)}else{e.value=t}return r}};if(!r){o.input=a;u.value=a}if(!i){o.textarea=a;u.value=a}n(function(){n(t).delegate("form","submit.placeholder",function(){var e=n(".placeholder",this).each(c);setTimeout(function(){e.each(h)},10)})});n(e).bind("beforeunload.placeholder",function(){n(".placeholder").each(function(){this.value=""})})}})(this,document,jQuery)

/* countUp.js by @inorganik v 1.1.1 */
function countUp(a,b,c,d,e,f){for(var g=0,h=["webkit","moz","ms"],i=0;i<h.length&&!window.requestAnimationFrame;++i)window.requestAnimationFrame=window[h[i]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[h[i]+"CancelAnimationFrame"]||window[h[i]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(a){var c=(new Date).getTime(),d=Math.max(0,16-(c-g)),e=window.setTimeout(function(){a(c+d)},d);return g=c+d,e}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(a){clearTimeout(a)}),this.options=f||{useEasing:!0,useGrouping:!0,separator:",",decimal:"."},""==this.options.separator&&(this.options.useGrouping=!1);var j=this;this.d="string"==typeof a?document.getElementById(a):a,this.startVal=Number(b),this.endVal=Number(c),this.countDown=this.startVal>this.endVal?!0:!1,this.startTime=null,this.timestamp=null,this.remaining=null,this.frameVal=this.startVal,this.rAF=null,this.decimals=Math.max(0,d||0),this.dec=Math.pow(10,this.decimals),this.duration=1e3*e||2e3,this.version=function(){return"1.1.1"},this.easeOutExpo=function(a,b,c,d){return 1024*c*(-Math.pow(2,-10*a/d)+1)/1023+b},this.count=function(a){null===j.startTime&&(j.startTime=a),j.timestamp=a;var b=a-j.startTime;if(j.remaining=j.duration-b,j.options.useEasing)if(j.countDown){var c=j.easeOutExpo(b,0,j.startVal-j.endVal,j.duration);j.frameVal=j.startVal-c}else j.frameVal=j.easeOutExpo(b,j.startVal,j.endVal-j.startVal,j.duration);else if(j.countDown){var c=(j.startVal-j.endVal)*(b/j.duration);j.frameVal=j.startVal-c}else j.frameVal=j.startVal+(j.endVal-j.startVal)*(b/j.duration);j.frameVal=Math.round(j.frameVal*j.dec)/j.dec,j.frameVal=j.countDown?j.frameVal<j.endVal?j.endVal:j.frameVal:j.frameVal>j.endVal?j.endVal:j.frameVal,j.d.innerHTML=j.formatNumber(j.frameVal.toFixed(j.decimals)),b<j.duration?j.rAF=requestAnimationFrame(j.count):null!=j.callback&&j.callback()},this.start=function(a){return j.callback=a,isNaN(j.endVal)||isNaN(j.startVal)?(console.log("countUp error: startVal or endVal is not a number"),j.d.innerHTML="--"):j.rAF=requestAnimationFrame(j.count),!1},this.stop=function(){cancelAnimationFrame(j.rAF)},this.reset=function(){j.startTime=null,cancelAnimationFrame(j.rAF),j.d.innerHTML=j.formatNumber(j.startVal.toFixed(j.decimals))},this.resume=function(){j.startTime=null,j.duration=j.remaining,j.startVal=j.frameVal,requestAnimationFrame(j.count)},this.formatNumber=function(a){a+="";var b,c,d,e;if(b=a.split("."),c=b[0],d=b.length>1?j.options.decimal+b[1]:"",e=/(\d+)(\d{3})/,j.options.useGrouping)for(;e.test(c);)c=c.replace(e,"$1"+j.options.separator+"$2");return c+d},j.d.innerHTML=j.formatNumber(j.startVal.toFixed(j.decimals))}

/* covervid.min.js */
jQuery.fn.extend({coverVid:function(a,b){function c(){var c=d.parent().height(),e=d.parent().width(),f=a,g=b,h=c/g,i=e/f;d.css({position:"absolute",top:"50%",left:"50%","-webkit-transform":"translate(-50%, -50%)","-moz-transform":"translate(-50%, -50%)","-ms-transform":"translate(-50%, -50%)","-o-transform":"translate(-50%, -50%)",transform:"translate(-50%, -50%)"}),d.parent().css("overflow","hidden"),d.css(i>h?{height:"auto",width:e}:{height:c,width:"auto"})}jQuery(document).ready(c),jQuery(window).smartresize(c);var d=this}});
/*
 * jQuery Superfish Menu Plugin - v1.7.4
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *	http://www.opensource.org/licenses/mit-license.php
 *	http://www.gnu.org/licenses/gpl.html
 */

;(function(e){"use strict";var s=function(){var s={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",menuArrowClass:"sf-arrows"},o=function(){var s=/iPhone|iPad|iPod/i.test(navigator.userAgent);return s&&e(window).load(function(){e("body").children().on("click",e.noop)}),s}(),n=function(){var e=document.documentElement.style;return"behavior"in e&&"fill"in e&&/iemobile/i.test(navigator.userAgent)}(),t=function(e,o){var n=s.menuClass;o.cssArrows&&(n+=" "+s.menuArrowClass),e.toggleClass(n)},i=function(o,n){return o.find("li."+n.pathClass).slice(0,n.pathLevels).addClass(n.hoverClass+" "+s.bcClass).filter(function(){return e(this).children(n.popUpSelector).hide().show().length}).removeClass(n.pathClass)},r=function(e){e.children("a").toggleClass(s.anchorClass)},a=function(e){var s=e.css("ms-touch-action");s="pan-y"===s?"auto":"pan-y",e.css("ms-touch-action",s)},l=function(s,t){var i="li:has("+t.popUpSelector+")";e.fn.hoverIntent&&!t.disableHI?s.hoverIntent(u,p,i):s.on("mouseenter.superfish",i,u).on("mouseleave.superfish",i,p);var r="MSPointerDown.superfish";o||(r+=" touchend.superfish"),n&&(r+=" mousedown.superfish"),s.on("focusin.superfish","li",u).on("focusout.superfish","li",p).on(r,"a",t,h)},h=function(s){var o=e(this),n=o.siblings(s.data.popUpSelector);n.length>0&&n.is(":hidden")&&(o.one("click.superfish",!1),"MSPointerDown"===s.type?o.trigger("focus"):e.proxy(u,o.parent("li"))())},u=function(){var s=e(this),o=d(s);clearTimeout(o.sfTimer),s.siblings().superfish("hide").end().superfish("show")},p=function(){var s=e(this),n=d(s);o?e.proxy(f,s,n)():(clearTimeout(n.sfTimer),n.sfTimer=setTimeout(e.proxy(f,s,n),n.delay))},f=function(s){s.retainPath=e.inArray(this[0],s.$path)>-1,this.superfish("hide"),this.parents("."+s.hoverClass).length||(s.onIdle.call(c(this)),s.$path.length&&e.proxy(u,s.$path)())},c=function(e){return e.closest("."+s.menuClass)},d=function(e){return c(e).data("sf-options")};return{hide:function(s){if(this.length){var o=this,n=d(o);if(!n)return this;var t=n.retainPath===!0?n.$path:"",i=o.find("li."+n.hoverClass).add(this).not(t).removeClass(n.hoverClass).children(n.popUpSelector),r=n.speedOut;s&&(i.show(),r=0),n.retainPath=!1,n.onBeforeHide.call(i),i.stop(!0,!0).animate(n.animationOut,r,function(){var s=e(this);n.onHide.call(s)})}return this},show:function(){var e=d(this);if(!e)return this;var s=this.addClass(e.hoverClass),o=s.children(e.popUpSelector);return e.onBeforeShow.call(o),o.stop(!0,!0).animate(e.animation,e.speed,function(){e.onShow.call(o)}),this},destroy:function(){return this.each(function(){var o,n=e(this),i=n.data("sf-options");return i?(o=n.find(i.popUpSelector).parent("li"),clearTimeout(i.sfTimer),t(n,i),r(o),a(n),n.off(".superfish").off(".hoverIntent"),o.children(i.popUpSelector).attr("style",function(e,s){return s.replace(/display[^;]+;?/g,"")}),i.$path.removeClass(i.hoverClass+" "+s.bcClass).addClass(i.pathClass),n.find("."+i.hoverClass).removeClass(i.hoverClass),i.onDestroy.call(n),n.removeData("sf-options"),void 0):!1})},init:function(o){return this.each(function(){var n=e(this);if(n.data("sf-options"))return!1;var h=e.extend({},e.fn.superfish.defaults,o),u=n.find(h.popUpSelector).parent("li");h.$path=i(n,h),n.data("sf-options",h),t(n,h),r(u),a(n),l(n,h),u.not("."+s.bcClass).superfish("hide",!0),h.onInit.call(this)})}}}();e.fn.superfish=function(o){return s[o]?s[o].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof o&&o?e.error("Method "+o+" does not exist on jQuery.fn.superfish"):s.init.apply(this,arguments)},e.fn.superfish.defaults={popUpSelector:"ul,.sf-mega",hoverClass:"sfHover",pathClass:"overrideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},animationOut:{opacity:"hide"},speed:"normal",speedOut:"fast",cssArrows:!0,disableHI:!1,onInit:e.noop,onBeforeShow:e.noop,onShow:e.noop,onBeforeHide:e.noop,onHide:e.noop,onIdle:e.noop,onDestroy:e.noop},e.fn.extend({hideSuperfishUl:s.hide,showSuperfishUl:s.show})})(jQuery);

// debouncing function from John Hann
// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
(function(e,t){var n=function(e,t,n){var r;return function(){function u(){if(!n)e.apply(s,o);r=null}var s=this,o=arguments;if(r)clearTimeout(r);else if(n)e.apply(s,o);r=setTimeout(u,t||100)}};jQuery.fn[t]=function(e){return e?this.bind("resize",n(e)):this.trigger(t)}})(jQuery,"smartresize")

// getComputedStyle for IE8
	if (!window.getComputedStyle) {
		window.getComputedStyle = function(el, pseudo) {
			this.el = el;
			this.getPropertyValue = function(prop) {
				var re = /(\-([a-z]){1})/g;
				if (prop == 'float') prop = 'styleFloat';
				if (re.test(prop)) {
					prop = prop.replace(re, function () {
						return arguments[2].toUpperCase();
					});
				}
				return el.currentStyle[prop] ? el.currentStyle[prop] : null;
			}
			return this;
		}
	}

/* Waypoints magic
---------------------------------------------------------- */
if ( typeof window['vc_waypoints'] !== 'function' ) {
  function vc_waypoints() {
	if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
	if (typeof jQuery.fn.waypoint !== 'undefined') {
	    jQuery('.wpb_animate_when_almost_visible').waypoint(function() {
			jQuery(this).addClass('wpb_start_animation');
		}, { offset: '85%' });
	}
	} else {
		jQuery('.wpb_animate_when_almost_visible').removeClass('wpb_animate_when_almost_visible');
	}
  }
}



jQuery(document).ready(function($) {
	
/* Teaser grid: isotope
---------------------------------------------------------- */
// cache jQuery window
var $window = jQuery(window);
  
// cache container
jQuery('.wpb_grid-alternative .teaser_grid_container:not(.wpb_carousel), .wpb_filtered_grid .teaser_grid_container:not(.wpb_carousel)').each(function(){
	var $icontainer = jQuery(this);
	var $isotopeItems = jQuery(this).find('.isotope-item');
	$isotopeItems.css({ opacity: 0 });
			
	// start up isotope with default settings
	$icontainer.imagesLoaded( function(){
		vc_teaserGrid_alternative();
		$window.smartresize( vc_teaserGrid_alternative );
		
		$('.mt-loader').stop(true,true).fadeOut(200);
		var $ithumbs = $icontainer.find('.wpb_thumbnails-alternative');
		$ithumbs.css({ opacity: 1 });
		$isotopeItems.each(function(i){
			jQuery(this).delay(i*125).animate({'opacity':1},700);
		});
	});
});

function vc_teaserGrid_alternative() {
	//var mediaQueryId = getComputedStyle( document.body, ':after' ).getPropertyValue('content');
	// fix for firefox, remove double quotes "
	//if (navigator.userAgent.match('MSIE 8') == null) {
		//mediaQueryId = mediaQueryId.replace( /"/g, '' );
	//}
	//console.log( mediaQueryId );
	jQuery('.wpb_grid-alternative .teaser_grid_container:not(.wpb_carousel), .wpb_filtered_grid .teaser_grid_container:not(.wpb_carousel)').each(function(){
		var $container = jQuery(this);
		var $thumbs = $container.find('.wpb_thumbnails-alternative');
		var teaser_grid = $thumbs.closest('.wpb_teaser_grid');
			if ( !teaser_grid.hasClass('columns_count_1') ) {
				$thumbs.isotope({
					// options
					itemSelector : '.isotope-item',
					//resizable: false, // disable normal resizing
					masonry: {
						columnWidth: '.grid-sizer',
						gutter: '.gutter-sizer'
					}
				}).isotope( 'layout' );
					
			}
	});
}

	// Superfish
	var $megaMenu = $('#megaMenu');
	var $pageMenu = $('.page-menu');
	
	if ($pageMenu.length && !$megaMenu.length) {
		$pageMenu.children('ul').addClass('sf-menu');
	}
	
	if (!$megaMenu.length) {
		$('ul.sf-menu').superfish({
			delay: 100,
			animation: {height:'show'},
			speed: 0,
			speedOut: 0,
		});
	}
	
	// cache jQuery window
	var $window = $(window);
	
	// custom toggle function
	//var animateToggle = function( $obj, time ) {
		//if ( $obj.is(':visible') ) {
			//var h = $obj.height();
			//$obj.stop().transition({height: 0}, time, function(){
				//$obj.css({display: 'none', height: h});
			//});
		//} else {
			//var h = $obj.stop().css({display: 'block', overflow: 'hidden'}).height();
			//$obj.css({height: 0}).transition({height: h}, time);
		//}
	//}
	
	// Mobile Menu
	var mobileMenu = $('#access-mobile');
	var menuOpenedTime = 0;
    (function mega_menu_listener() {
		var $megaMenuDropdown = $('#mobile-menu-dropdown');
		// toggle on click
        $megaMenuDropdown.click(function(e) {
            e.preventDefault();
			var tempTime =  new Date().getTime();
			if ( menuOpenedTime + 300 <  tempTime ) {
				mobileMenu.stop().slideToggle(0);
				menuOpenedTime = new Date().getTime();		
			}
        });
    })(); // self calling
	
	var mobileMenuLink = $('#access-mobile li a');
	mobileMenuLink.each(function(){
		if(typeof $(this).attr('href') == 'undefined') {
			$(this).addClass('collapsible');
			$(this).next( '.sub-menu' ).css( 'display', 'none' );
			var menuOpenedTimeMenuLink = 0;
			$(this).click(function(e) {
				e.preventDefault();
				var tempTimeMenuLink =  new Date().getTime();
				if ( menuOpenedTimeMenuLink + 300 <  tempTimeMenuLink ) {
					$(this).toggleClass('m-hover');
					$(this).next( '.sub-menu' ).stop().slideToggle(0);
					menuOpenedTimeMenuLink = new Date().getTime();		
				}
			});
		} 
	});
	
	// Skrollr
	if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
		var s = skrollr.init({
			forceHeight: false
		});
		var $header= $('#branding');
		$header.imagesLoaded(function(){
			s.refresh();
		});
		
		var $parallax = $('.parallax');
		if ($parallax.length) {
			jQuery(window).load(function() {
				setTimeout(function(){
					s.refresh();
				}, 100);
			});
		}
		
		var $window = $(window);
		$window.smartresize(function() {
			setTimeout(function(){
				s.refresh();
			}, 100);
		});
		
	}
	
	// countUp.js
	var $countWrapper = $('.count-wrapper');
	if ($countWrapper.length) {
		$( '.count-wrapper' ).each(function( i, el ) {
			var $el = $( el ),
				target = $el.data( 'count' ),
				startVal = 0,
				endVal = $el.data( 'end' ),
				decimals = 0;

			var theAnimation = new countUp( target, startVal, endVal, decimals, 3.5, {
				useEasing : true, 
				useGrouping : false, 
				separator : '', 
				decimal : '.',
			});

			if (typeof jQuery.fn.waypoint !== 'undefined') {
				$( '#' + target ).waypoint(function( direction ) {
					theAnimation.start();
				}, { offset: '85%' });
			}
		});
	}
	
	// covervid.min.js init
	$('.covervid-video').coverVid(1920, 1080);
	
	// FlexSlider
	var $testimonials = $('.testimonialsslider');
	if ($testimonials.length) {
	var $randomize_testimonial_order = $testimonials.attr( "data-randomize-testimonial-order" );
		if ($testimonials.attr('data-dot-navigation-color')) {
			var $dot_navigation_color = $testimonials.attr( "data-dot-navigation-color" );
		}
	
		$testimonials.imagesLoaded(function(){
			$testimonials.flexslider({
				touch: true,
				directionNav: true,
				smoothHeight: true,
				prevText: "",
				nextText: "",
				animationSpeed: 350,
				randomize: $randomize_testimonial_order,
				start: function(){
					$testimonials.find( '.flex-control-nav li a' ).css({ 'background': $dot_navigation_color, 'color': $dot_navigation_color });
				},
				slideshow: false,
				animation: "slide",
				keyboard: false,
				useCSS: true
			});
		});
	}
	
	// Magnific Popup
	var $magnificpopup = $('.magnific-popup');
	if ($magnificpopup.length) {
		
		$('.single_column_ul, .wpb_image_grid_ul, .magnific-popup').each(function() {
			$(this).magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery:{
					enabled:true,
					tCounter: '<span>%curr% / %total%</span>', // markup of counter
				},
				image: {
					titleSrc: 'data-attribute-caption'
				},
				overflowY: 'hidden',
				//removalDelay: 150,
				//mainClass: 'mfp-fade',
				closeBtnInside: false,
					
				mainClass: 'mfp-zoom-in',
				tLoading: '',
				removalDelay: 500, //delay removal by X to allow out-animation
				callbacks: {
					open: function() {
						 $( '.mfp-preloader' ).append( '<div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div>' );
					},
					change: function() {
						if (this.isOpen) {
							this.wrap.addClass('mfp-open');
						}
					},
					imageLoadComplete: function() {
					  var self = this;
						setTimeout(function() {
						self.wrap.addClass('mfp-image-loaded');
						}, 16);
					},
					beforeClose: function() {
						if (this.isOpen) {
							this.wrap.removeClass('mfp-open');
						}
					},
					close: function() {
						 this.wrap.removeClass('mfp-image-loadedn');
					},
				},
						
			});
		});
	}
	
	// fancyBox
	var $fbLightbox = $('.fb-lightbox');
	if ($fbLightbox.length) {
		(function ($, F) {
			F.transitions.resizeIn = function() {
				var previous = F.previous,
					current  = F.current,
					startPos = previous.wrap.stop(true).position(),
					endPos   = $.extend({opacity : 1}, current.pos);

				startPos.width  = previous.wrap.width();
				startPos.height = previous.wrap.height();

				previous.wrap.stop(true).trigger('onReset').remove();

				delete endPos.position;

				current.inner.hide();

				current.wrap.css(startPos).animate(endPos, {
					duration : current.nextSpeed,
					easing   : current.nextEasing,
					step     : F.transitions.step,
					complete : function() {
						F._afterZoomIn();

						current.inner.fadeIn("fast");
					}
				});
			};

		}(jQuery, jQuery.fancybox));
	
	
		$('.fb-lightbox').fancybox({
			mouseWheel: false,
			padding: 0,
			margin: [36, 60, 14, 60],
			width: 940,
			height: 530,
			scrolling: 'auto',
			iframe : {
			  preload: false
			},
			fitToView: true,
			aspectRatio: true,
			nextMethod : 'resizeIn',
			nextSpeed  : 250,
			prevMethod : false,
			nextClick: true,
			helpers : {
				overlay : {
					locked : false
				},
				title: {
					type: 'outside'
				},
				media: true
			},
			afterLoad: function() {
				if (this.group.length > 1) {
					this.title = this.title + '<div class="fancybox-counter">' + (this.index + 1) + ' / ' + this.group.length + '</div>';
				}
			},
			beforeLoad: function() {
				this.title = $(this.element).attr('data-caption');
			},
		});
	
	}
	
	// R Slider
	// cache container
	var $Slider = jQuery('.gallery-slider');
	
	if ($Slider.length) {
				
		var getMediaQueryId = function() {
			var mediaQueryId = getComputedStyle(document.body, ':after').getPropertyValue('content');
			if ( navigator.userAgent.match('MSIE 8') == null ) { 
				mediaQueryId = mediaQueryId.replace( /"/g, '' );
			}
			return mediaQueryId;
		}
					
		// changing slider height depending on screen size
		var changeHeightToFit = function() {
			var mediaQueryId = getMediaQueryId();
			if ( mediaQueryId == 'tiny' || mediaQueryId == 'small' || mediaQueryId == 'medium' ) {	
				$Slider.css({top: $('#header').outerHeight(true)});
			} else {
				var $left_menu = jQuery('.left-menu');
				if ($left_menu.length) {
					$Slider.css({top: 0});	
				} else {
					$Slider.css({top: 78});	
				}
			}					
		}				
					
		//var getImageScalePadding = function() {		
			//var mediaQueryId = getMediaQueryId();			
			//if ( mediaQueryId == 'tiny' ) {	
				//return 0;
			//} else {
				//return 0;
			//}
		//}
		
		$Slider.royalSlider({
			arrowsNav: true,
			numImagesToPreload: 3,
			keyboardNavEnabled: true,
			controlsInside: false,
			imageScaleMode: 'fit-if-smaller',
			imageScalePadding: 0,
			arrowsNavAutoHide: false,
			autoScaleSlider: false,
			autoHeight: false,
			usePreloader: true,
			controlNavigation: 'none',
			//thumbs: {
				//arrows: false,
				//spacing: 0,
				//firstMargin: false,
				//autoCenter:	true,
				//fitInViewport: true
			//},
			navigateByClick: true,
			startSlideId: 0,
			//autoPlay: {
				//enabled: <?php echo $royal_autoplay; ?>,
				//pauseOnHover: <?php echo $pause_on_hover; ?>,
				//delay: <?php echo $delay; ?>
			//},
			transitionType: 'move',
			sliderDrag: false,
			globalCaption: false,
			fadeinLoadedSlide: true,
			loop: true,
			slidesSpacing: 0,
			fullscreen: {
				enabled: false,
				nativeFS: true
			}
		});
					
		$('#header-wrapper').imagesLoaded(function(){
			changeHeightToFit();
			var slider = $Slider.data('royalSlider');
			// force updating size by adding "true" to updateSliderSize method
			slider.updateSliderSize(true);
		});
							
		// updating imageScaleMode and height depending on screen size
		jQuery(window).smartresize(function(){
			var slider = $Slider.data('royalSlider');
			//slider.st.imageScalePadding = getImageScalePadding();
			changeHeightToFit();
			// force updating size by adding "true" to updateSliderSize method
			slider.updateSliderSize(true);
		});
	
	}
	
	// Search form (header)
	$(document).click(function(event) {
		if (!$(event.target).closest("i, .search-wrapper").length) {
			$('#search-header-icon').removeClass('search-form-active');
			$('.search-wrapper').removeClass("active");
		}
	});

	$('#search-header-icon').on('click', function(event){
		if (!$(this).hasClass("search-form-active")) {
			$(this).addClass("search-form-active");
			$('#header-wrapper .search-wrapper, #top-bar-wrapper .search-wrapper').addClass("active");
		} else {
			$(this).removeClass("search-form-active");
			$('#header-wrapper .search-wrapper, #top-bar-wrapper .search-wrapper').removeClass("active");
		}
		if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
			setTimeout(function() {
				$('#header-wrapper #s, #top-bar-wrapper #s').focus();
			}, 200);
		} else {
			$('#header-wrapper #s, #top-bar-wrapper #s').focus();
		}
		//$('#header-wrapper #s').focus();
		event.preventDefault();
	});
	
	$('#remove-search').on('click', function(event){
		if ($('#search-header-icon').hasClass("search-form-active")) {
			$('#search-header-icon').removeClass("search-form-active");
			$('#header-wrapper .search-wrapper, #top-bar-wrapper .search-wrapper').removeClass("active");
		}
		event.preventDefault();
	});
	
	/* Remove portfilio image title */
	$('.type-portfolio img').removeAttr( "title" )
	
	/* To Top */
	var to_top_settings = {
		button: '#to-top',
		scrollSpeed: 600
	};

	$(to_top_settings.button).on('click', function( e ) {
		$('html, body').animate({ scrollTop : 0 }, to_top_settings.scrollSpeed );
		
		e.preventDefault();
	});
	
	/* WPML */
	var $langSelSel = $('#top-bar .lang_sel_sel');
	$langSelSel.on('click', function( e ) {
		e.preventDefault();
	});
	
	// HTML5 Placeholder jQuery Plugin
	$('input, textarea').placeholder();
	
	// ShowBiz
	var cat;
	jQuery('.showbiz .entry-meta').each(function() {
		cat = jQuery(this).find('a');
		if(cat.length > 1) cat.each(catEach);
	});
	
	function catEach(i) {
		if(i > 0) {
			jQuery('<span />&nbsp;</span>').insertBefore(jQuery(this));
		}
	}
	
	// The slider being synced must be initialized first
	var $singleProduct = $( '.single-product' );
	if ($singleProduct.length) {
	$('#carousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 119,
		itemMargin: 14,
		asNavFor: '#slider',
		move: 1,
		maxItems: 3
	});
	 
	$('#slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#carousel",
		animationSpeed: 350
	});
	}

}); // END jQuery(document).ready