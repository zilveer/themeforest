(function($){
	"use strict";
	$(document).ready(function(){

		// Loads the color pickers
		$('.colorpicker').wpColorPicker();

		var hash = window.location.hash;

		if( hash !== '' ){
			$('#page-' + hash.replace(/#/, '')).show();
			$('.stag-sidebar a[href="'+ hash +'"]').addClass('active');
		} else {
			$('.stag-main-content .page:first').show();
			$('.stag-sidebar a:first').addClass('active');
		}

		// StagFramework Admin Pages Switcher
		$('.stag-sidebar').find('a').on('click', function(){
			$('.stag-main-content .page').hide();
			var loc = $(this).attr('href');
			$('#page-' + loc.replace(/#/, '')).fadeIn(150).show();
			$('.stag-sidebar a').removeClass('active');
			$(this).addClass('active');

			resize_wpeditor();
		});

		// StagFrameowork Options Save

		$('#stag-form').submit(function(e){
			var form = $(this),
				button = $(this).find('#save-button'),
				buttonVal = button.val(),
				message = $('#stag-notification');

			e.preventDefault();

			form.trigger('stag-before-save');

			// Trigger tinyMCE save function to update any wp_editor text value
			tinyMCE.triggerSave();

			message.removeClass('stag-notification--error')

			var l = Ladda.create( document.querySelector( '#save-button' ) );
			l.start();

			$.post( form.attr('action'), form.serialize(), function(data){
				if(data.error){
					message.addClass('stag-notification--error');
					message.text(message.data('error'));
					message.fadeIn(100).delay(2000).fadeOut();
				}
				form.trigger('stag-saved');
			}, 'json' ).done(function(data){
				l.stop();
				if( !data.error){
					message.text(message.data('success'));
					message.fadeIn(100).delay(2000).fadeOut();
				}
			});

			return false;
		});

		// StagFramework Options Reset

		$('#stag-form').find('#reset-button').on('click', function(){
			if( confirm("Click to Reset. Any settings will be lost.") ) {
				$.post(ajaxurl, {action: 'stag_admin_reset', nonce: $('#stag_noncename').val()}, function(data){
					if(data.error){
						message.addClass('stag-notification--error');
						message.text(message.data('error'));
						message.fadeIn(100).delay(2000).fadeOut();
					}else{
						window.location.reload();
					}
				}, 'json');
			}
			return false;
		});

		function resize_wpeditor() {
			$('.wp-editor-wrap').each(function() {
				var editor_iframe = $(this).find('iframe');
				editor_iframe.height('128px');
				if ( editor_iframe.height() < 30 ) {
					editor_iframe.css({'height':'auto'});
				}
			});
		}
		resize_wpeditor();

	});
}(jQuery));


/*!
 * Copyright (c) 2011-2013 Felix Gnass
 * Licensed under the MIT license
 */
(function(t,e){if(typeof exports=="object")module.exports=e();else if(typeof define=="function"&&define.amd)define(e);else t.Spinner=e()})(this,function(){"use strict";var t=["webkit","Moz","ms","O"],e={},i;function o(t,e){var i=document.createElement(t||"div"),o;for(o in e)i[o]=e[o];return i}function n(t){for(var e=1,i=arguments.length;e<i;e++)t.appendChild(arguments[e]);return t}var r=function(){var t=o("style",{type:"text/css"});n(document.getElementsByTagName("head")[0],t);return t.sheet||t.styleSheet}();function s(t,o,n,s){var a=["opacity",o,~~(t*100),n,s].join("-"),f=.01+n/s*100,l=Math.max(1-(1-t)/o*(100-f),t),u=i.substring(0,i.indexOf("Animation")).toLowerCase(),d=u&&"-"+u+"-"||"";if(!e[a]){r.insertRule("@"+d+"keyframes "+a+"{"+"0%{opacity:"+l+"}"+f+"%{opacity:"+t+"}"+(f+.01)+"%{opacity:1}"+(f+o)%100+"%{opacity:"+t+"}"+"100%{opacity:"+l+"}"+"}",r.cssRules.length);e[a]=1}return a}function a(e,i){var o=e.style,n,r;if(o[i]!==undefined)return i;i=i.charAt(0).toUpperCase()+i.slice(1);for(r=0;r<t.length;r++){n=t[r]+i;if(o[n]!==undefined)return n}}function f(t,e){for(var i in e)t.style[a(t,i)||i]=e[i];return t}function l(t){for(var e=1;e<arguments.length;e++){var i=arguments[e];for(var o in i)if(t[o]===undefined)t[o]=i[o]}return t}function u(t){var e={x:t.offsetLeft,y:t.offsetTop};while(t=t.offsetParent)e.x+=t.offsetLeft,e.y+=t.offsetTop;return e}function d(t,e){return typeof t=="string"?t:t[e%t.length]}var p={lines:12,length:7,width:5,radius:10,rotate:0,corners:1,color:"#000",direction:1,speed:1,trail:100,opacity:1/4,fps:20,zIndex:2e9,className:"spinner",top:"auto",left:"auto",position:"relative"};function c(t){if(typeof this=="undefined")return new c(t);this.opts=l(t||{},c.defaults,p)}c.defaults={};l(c.prototype,{spin:function(t){this.stop();var e=this,n=e.opts,r=e.el=f(o(0,{className:n.className}),{position:n.position,width:0,zIndex:n.zIndex}),s=n.radius+n.length+n.width,a,l;if(t){t.insertBefore(r,t.firstChild||null);l=u(t);a=u(r);f(r,{left:(n.left=="auto"?l.x-a.x+(t.offsetWidth>>1):parseInt(n.left,10)+s)+"px",top:(n.top=="auto"?l.y-a.y+(t.offsetHeight>>1):parseInt(n.top,10)+s)+"px"})}r.setAttribute("role","progressbar");e.lines(r,e.opts);if(!i){var d=0,p=(n.lines-1)*(1-n.direction)/2,c,h=n.fps,m=h/n.speed,y=(1-n.opacity)/(m*n.trail/100),g=m/n.lines;(function v(){d++;for(var t=0;t<n.lines;t++){c=Math.max(1-(d+(n.lines-t)*g)%m*y,n.opacity);e.opacity(r,t*n.direction+p,c,n)}e.timeout=e.el&&setTimeout(v,~~(1e3/h))})()}return e},stop:function(){var t=this.el;if(t){clearTimeout(this.timeout);if(t.parentNode)t.parentNode.removeChild(t);this.el=undefined}return this},lines:function(t,e){var r=0,a=(e.lines-1)*(1-e.direction)/2,l;function u(t,i){return f(o(),{position:"absolute",width:e.length+e.width+"px",height:e.width+"px",background:t,boxShadow:i,transformOrigin:"left",transform:"rotate("+~~(360/e.lines*r+e.rotate)+"deg) translate("+e.radius+"px"+",0)",borderRadius:(e.corners*e.width>>1)+"px"})}for(;r<e.lines;r++){l=f(o(),{position:"absolute",top:1+~(e.width/2)+"px",transform:e.hwaccel?"translate3d(0,0,0)":"",opacity:e.opacity,animation:i&&s(e.opacity,e.trail,a+r*e.direction,e.lines)+" "+1/e.speed+"s linear infinite"});if(e.shadow)n(l,f(u("#000","0 0 4px "+"#000"),{top:2+"px"}));n(t,n(l,u(d(e.color,r),"0 0 1px rgba(0,0,0,.1)")))}return t},opacity:function(t,e,i){if(e<t.childNodes.length)t.childNodes[e].style.opacity=i}});function h(){function t(t,e){return o("<"+t+' xmlns="urn:schemas-microsoft.com:vml" class="spin-vml">',e)}r.addRule(".spin-vml","behavior:url(#default#VML)");c.prototype.lines=function(e,i){var o=i.length+i.width,r=2*o;function s(){return f(t("group",{coordsize:r+" "+r,coordorigin:-o+" "+-o}),{width:r,height:r})}var a=-(i.width+i.length)*2+"px",l=f(s(),{position:"absolute",top:a,left:a}),u;function p(e,r,a){n(l,n(f(s(),{rotation:360/i.lines*e+"deg",left:~~r}),n(f(t("roundrect",{arcsize:i.corners}),{width:o,height:i.width,left:i.radius,top:-i.width>>1,filter:a}),t("fill",{color:d(i.color,e),opacity:i.opacity}),t("stroke",{opacity:0}))))}if(i.shadow)for(u=1;u<=i.lines;u++)p(u,-2,"progid:DXImageTransform.Microsoft.Blur(pixelradius=2,makeshadow=1,shadowopacity=.3)");for(u=1;u<=i.lines;u++)p(u);return n(e,l)};c.prototype.opacity=function(t,e,i,o){var n=t.firstChild;o=o.shadow&&o.lines||0;if(n&&e+o<n.childNodes.length){n=n.childNodes[e+o];n=n&&n.firstChild;n=n&&n.firstChild;if(n)n.opacity=i}}}var m=f(o("group"),{behavior:"url(#default#VML)"});if(!a(m,"transform")&&m.adj)h();else i=false;return c});

/*!
 * Ladda 0.7.0 (2013-07-20, 00:49)
 * http://lab.hakim.se/ladda
 * MIT licensed
 *
 * Copyright (C) 2013 Hakim El Hattab, http://hakim.se
 */
 (function(a,b){if(typeof exports==="object"){module.exports=b()}else{if(typeof define==="function"&&define.amd){define(["spin"],b)}else{a.Ladda=b(a.Spinner)}}}(this,function(d){var e=[];function c(i){if(typeof i==="undefined"){console.warn("Ladda button target must be defined.");return}if(!i.querySelector(".ladda-label")){i.innerHTML='<span class="ladda-label">'+i.innerHTML+"</span>"}var k=f(i);var j=document.createElement("span");j.className="ladda-spinner";i.appendChild(j);var l;var h={start:function(){i.setAttribute("disabled","");i.setAttribute("data-loading","");clearTimeout(l);k.spin(j);this.setProgress(0);return this},startAfter:function(m){clearTimeout(l);l=setTimeout(function(){h.start()},m);return this},stop:function(){i.removeAttribute("disabled");i.removeAttribute("data-loading");clearTimeout(l);l=setTimeout(function(){k.stop()},1000);return this},toggle:function(){if(this.isLoading()){this.stop()}else{this.start()}return this},setProgress:function(m){m=Math.max(Math.min(m,1),0);var n=i.querySelector(".ladda-progress");if(m===0&&n&&n.parentNode){n.parentNode.removeChild(n)}else{if(!n){n=document.createElement("div");n.className="ladda-progress";i.appendChild(n)}n.style.width=((m||0)*i.offsetWidth)+"px"}},enable:function(){this.stop();return this},disable:function(){this.stop();i.setAttribute("disabled","");return this},isLoading:function(){return i.hasAttribute("data-loading")}};e.push(h);return h}function g(m,k){k=k||{};var j=[];if(typeof m==="string"){j=a(document.querySelectorAll(m))}else{if(typeof m==="object"&&typeof m.nodeName==="string"){j=[m]}}for(var l=0,h=j.length;l<h;l++){(function(){var n=j[l];if(typeof n.addEventListener==="function"){var i=c(n);var o=-1;n.addEventListener("click",function(){i.startAfter(1);if(typeof k.timeout==="number"){clearTimeout(o);o=setTimeout(i.stop,k.timeout)}if(typeof k.callback==="function"){k.callback.apply(null,[i])}},false)}})()}}function b(){for(var j=0,h=e.length;j<h;j++){e[j].stop()}}function f(k){var i=k.offsetHeight,n;if(i>32){i*=0.8}if(k.hasAttribute("data-spinner-size")){i=parseInt(k.getAttribute("data-spinner-size"),10)}if(k.hasAttribute("data-spinner-color")){n=k.getAttribute("data-spinner-color")}var j=12,h=i*0.2,m=h*0.6,l=h<7?2:3;return new d({color:n||"#fff",lines:j,radius:h,length:m,width:l,zIndex:"initial",top:"auto",left:"auto",className:""})}function a(j){var h=[];for(var k=0;k<j.length;k++){h.push(j[k])}return h}return{bind:g,create:c,stopAll:b}}));
