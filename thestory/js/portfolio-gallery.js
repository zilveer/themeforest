/*!
 * jScrollPane - v2.0.22 - 2015-04-25
 * http://jscrollpane.kelvinluck.com/
 *
 * Copyright (c) 2014 Kelvin Luck
 * Dual licensed under the MIT or GPL licenses.
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){a.fn.jScrollPane=function(b){function c(b,c){function d(c){var f,h,j,k,l,o,p=!1,q=!1;if(N=c,void 0===O)l=b.scrollTop(),o=b.scrollLeft(),b.css({overflow:"hidden",padding:0}),P=b.innerWidth()+ra,Q=b.innerHeight(),b.width(P),O=a('<div class="jspPane" />').css("padding",qa).append(b.children()),R=a('<div class="jspContainer" />').css({width:P+"px",height:Q+"px"}).append(O).appendTo(b);else{if(b.css("width",""),p=N.stickToBottom&&A(),q=N.stickToRight&&B(),k=b.innerWidth()+ra!=P||b.outerHeight()!=Q,k&&(P=b.innerWidth()+ra,Q=b.innerHeight(),R.css({width:P+"px",height:Q+"px"})),!k&&sa==S&&O.outerHeight()==T)return void b.width(P);sa=S,O.css("width",""),b.width(P),R.find(">.jspVerticalBar,>.jspHorizontalBar").remove().end()}O.css("overflow","auto"),S=c.contentWidth?c.contentWidth:O[0].scrollWidth,T=O[0].scrollHeight,O.css("overflow",""),U=S/P,V=T/Q,W=V>1,X=U>1,X||W?(b.addClass("jspScrollable"),f=N.maintainPosition&&($||ba),f&&(h=y(),j=z()),e(),g(),i(),f&&(w(q?S-P:h,!1),v(p?T-Q:j,!1)),F(),C(),L(),N.enableKeyboardNavigation&&H(),N.clickOnTrack&&m(),J(),N.hijackInternalLinks&&K()):(b.removeClass("jspScrollable"),O.css({top:0,left:0,width:R.width()-ra}),D(),G(),I(),n()),N.autoReinitialise&&!pa?pa=setInterval(function(){d(N)},N.autoReinitialiseDelay):!N.autoReinitialise&&pa&&clearInterval(pa),l&&b.scrollTop(0)&&v(l,!1),o&&b.scrollLeft(0)&&w(o,!1),b.trigger("jsp-initialised",[X||W])}function e(){W&&(R.append(a('<div class="jspVerticalBar" />').append(a('<div class="jspCap jspCapTop" />'),a('<div class="jspTrack" />').append(a('<div class="jspDrag" />').append(a('<div class="jspDragTop" />'),a('<div class="jspDragBottom" />'))),a('<div class="jspCap jspCapBottom" />'))),ca=R.find(">.jspVerticalBar"),da=ca.find(">.jspTrack"),Y=da.find(">.jspDrag"),N.showArrows&&(ha=a('<a class="jspArrow jspArrowUp" />').bind("mousedown.jsp",k(0,-1)).bind("click.jsp",E),ia=a('<a class="jspArrow jspArrowDown" />').bind("mousedown.jsp",k(0,1)).bind("click.jsp",E),N.arrowScrollOnHover&&(ha.bind("mouseover.jsp",k(0,-1,ha)),ia.bind("mouseover.jsp",k(0,1,ia))),j(da,N.verticalArrowPositions,ha,ia)),fa=Q,R.find(">.jspVerticalBar>.jspCap:visible,>.jspVerticalBar>.jspArrow").each(function(){fa-=a(this).outerHeight()}),Y.hover(function(){Y.addClass("jspHover")},function(){Y.removeClass("jspHover")}).bind("mousedown.jsp",function(b){a("html").bind("dragstart.jsp selectstart.jsp",E),Y.addClass("jspActive");var c=b.pageY-Y.position().top;return a("html").bind("mousemove.jsp",function(a){p(a.pageY-c,!1)}).bind("mouseup.jsp mouseleave.jsp",o),!1}),f())}function f(){da.height(fa+"px"),$=0,ea=N.verticalGutter+da.outerWidth(),O.width(P-ea-ra);try{0===ca.position().left&&O.css("margin-left",ea+"px")}catch(a){}}function g(){X&&(R.append(a('<div class="jspHorizontalBar" />').append(a('<div class="jspCap jspCapLeft" />'),a('<div class="jspTrack" />').append(a('<div class="jspDrag" />').append(a('<div class="jspDragLeft" />'),a('<div class="jspDragRight" />'))),a('<div class="jspCap jspCapRight" />'))),ja=R.find(">.jspHorizontalBar"),ka=ja.find(">.jspTrack"),_=ka.find(">.jspDrag"),N.showArrows&&(na=a('<a class="jspArrow jspArrowLeft" />').bind("mousedown.jsp",k(-1,0)).bind("click.jsp",E),oa=a('<a class="jspArrow jspArrowRight" />').bind("mousedown.jsp",k(1,0)).bind("click.jsp",E),N.arrowScrollOnHover&&(na.bind("mouseover.jsp",k(-1,0,na)),oa.bind("mouseover.jsp",k(1,0,oa))),j(ka,N.horizontalArrowPositions,na,oa)),_.hover(function(){_.addClass("jspHover")},function(){_.removeClass("jspHover")}).bind("mousedown.jsp",function(b){a("html").bind("dragstart.jsp selectstart.jsp",E),_.addClass("jspActive");var c=b.pageX-_.position().left;return a("html").bind("mousemove.jsp",function(a){r(a.pageX-c,!1)}).bind("mouseup.jsp mouseleave.jsp",o),!1}),la=R.innerWidth(),h())}function h(){R.find(">.jspHorizontalBar>.jspCap:visible,>.jspHorizontalBar>.jspArrow").each(function(){la-=a(this).outerWidth()}),ka.width(la+"px"),ba=0}function i(){if(X&&W){var b=ka.outerHeight(),c=da.outerWidth();fa-=b,a(ja).find(">.jspCap:visible,>.jspArrow").each(function(){la+=a(this).outerWidth()}),la-=c,Q-=c,P-=b,ka.parent().append(a('<div class="jspCorner" />').css("width",b+"px")),f(),h()}X&&O.width(R.outerWidth()-ra+"px"),T=O.outerHeight(),V=T/Q,X&&(ma=Math.ceil(1/U*la),ma>N.horizontalDragMaxWidth?ma=N.horizontalDragMaxWidth:ma<N.horizontalDragMinWidth&&(ma=N.horizontalDragMinWidth),_.width(ma+"px"),aa=la-ma,s(ba)),W&&(ga=Math.ceil(1/V*fa),ga>N.verticalDragMaxHeight?ga=N.verticalDragMaxHeight:ga<N.verticalDragMinHeight&&(ga=N.verticalDragMinHeight),Y.height(ga+"px"),Z=fa-ga,q($))}function j(a,b,c,d){var e,f="before",g="after";"os"==b&&(b=/Mac/.test(navigator.platform)?"after":"split"),b==f?g=b:b==g&&(f=b,e=c,c=d,d=e),a[f](c)[g](d)}function k(a,b,c){return function(){return l(a,b,this,c),this.blur(),!1}}function l(b,c,d,e){d=a(d).addClass("jspActive");var f,g,h=!0,i=function(){0!==b&&ta.scrollByX(b*N.arrowButtonSpeed),0!==c&&ta.scrollByY(c*N.arrowButtonSpeed),g=setTimeout(i,h?N.initialDelay:N.arrowRepeatFreq),h=!1};i(),f=e?"mouseout.jsp":"mouseup.jsp",e=e||a("html"),e.bind(f,function(){d.removeClass("jspActive"),g&&clearTimeout(g),g=null,e.unbind(f)})}function m(){n(),W&&da.bind("mousedown.jsp",function(b){if(void 0===b.originalTarget||b.originalTarget==b.currentTarget){var c,d=a(this),e=d.offset(),f=b.pageY-e.top-$,g=!0,h=function(){var a=d.offset(),e=b.pageY-a.top-ga/2,j=Q*N.scrollPagePercent,k=Z*j/(T-Q);if(0>f)$-k>e?ta.scrollByY(-j):p(e);else{if(!(f>0))return void i();e>$+k?ta.scrollByY(j):p(e)}c=setTimeout(h,g?N.initialDelay:N.trackClickRepeatFreq),g=!1},i=function(){c&&clearTimeout(c),c=null,a(document).unbind("mouseup.jsp",i)};return h(),a(document).bind("mouseup.jsp",i),!1}}),X&&ka.bind("mousedown.jsp",function(b){if(void 0===b.originalTarget||b.originalTarget==b.currentTarget){var c,d=a(this),e=d.offset(),f=b.pageX-e.left-ba,g=!0,h=function(){var a=d.offset(),e=b.pageX-a.left-ma/2,j=P*N.scrollPagePercent,k=aa*j/(S-P);if(0>f)ba-k>e?ta.scrollByX(-j):r(e);else{if(!(f>0))return void i();e>ba+k?ta.scrollByX(j):r(e)}c=setTimeout(h,g?N.initialDelay:N.trackClickRepeatFreq),g=!1},i=function(){c&&clearTimeout(c),c=null,a(document).unbind("mouseup.jsp",i)};return h(),a(document).bind("mouseup.jsp",i),!1}})}function n(){ka&&ka.unbind("mousedown.jsp"),da&&da.unbind("mousedown.jsp")}function o(){a("html").unbind("dragstart.jsp selectstart.jsp mousemove.jsp mouseup.jsp mouseleave.jsp"),Y&&Y.removeClass("jspActive"),_&&_.removeClass("jspActive")}function p(a,b){W&&(0>a?a=0:a>Z&&(a=Z),void 0===b&&(b=N.animateScroll),b?ta.animate(Y,"top",a,q):(Y.css("top",a),q(a)))}function q(a){void 0===a&&(a=Y.position().top),R.scrollTop(0),$=a||0;var c=0===$,d=$==Z,e=a/Z,f=-e*(T-Q);(ua!=c||wa!=d)&&(ua=c,wa=d,b.trigger("jsp-arrow-change",[ua,wa,va,xa])),t(c,d),O.css("top",f),b.trigger("jsp-scroll-y",[-f,c,d]).trigger("scroll")}function r(a,b){X&&(0>a?a=0:a>aa&&(a=aa),void 0===b&&(b=N.animateScroll),b?ta.animate(_,"left",a,s):(_.css("left",a),s(a)))}function s(a){void 0===a&&(a=_.position().left),R.scrollTop(0),ba=a||0;var c=0===ba,d=ba==aa,e=a/aa,f=-e*(S-P);(va!=c||xa!=d)&&(va=c,xa=d,b.trigger("jsp-arrow-change",[ua,wa,va,xa])),u(c,d),O.css("left",f),b.trigger("jsp-scroll-x",[-f,c,d]).trigger("scroll")}function t(a,b){N.showArrows&&(ha[a?"addClass":"removeClass"]("jspDisabled"),ia[b?"addClass":"removeClass"]("jspDisabled"))}function u(a,b){N.showArrows&&(na[a?"addClass":"removeClass"]("jspDisabled"),oa[b?"addClass":"removeClass"]("jspDisabled"))}function v(a,b){var c=a/(T-Q);p(c*Z,b)}function w(a,b){var c=a/(S-P);r(c*aa,b)}function x(b,c,d){var e,f,g,h,i,j,k,l,m,n=0,o=0;try{e=a(b)}catch(p){return}for(f=e.outerHeight(),g=e.outerWidth(),R.scrollTop(0),R.scrollLeft(0);!e.is(".jspPane");)if(n+=e.position().top,o+=e.position().left,e=e.offsetParent(),/^body|html$/i.test(e[0].nodeName))return;h=z(),j=h+Q,h>n||c?l=n-N.horizontalGutter:n+f>j&&(l=n-Q+f+N.horizontalGutter),isNaN(l)||v(l,d),i=y(),k=i+P,i>o||c?m=o-N.horizontalGutter:o+g>k&&(m=o-P+g+N.horizontalGutter),isNaN(m)||w(m,d)}function y(){return-O.position().left}function z(){return-O.position().top}function A(){var a=T-Q;return a>20&&a-z()<10}function B(){var a=S-P;return a>20&&a-y()<10}function C(){R.unbind(za).bind(za,function(a,b,c,d){ba||(ba=0),$||($=0);var e=ba,f=$,g=a.deltaFactor||N.mouseWheelSpeed;return ta.scrollBy(c*g,-d*g,!1),e==ba&&f==$})}function D(){R.unbind(za)}function E(){return!1}function F(){O.find(":input,a").unbind("focus.jsp").bind("focus.jsp",function(a){x(a.target,!1)})}function G(){O.find(":input,a").unbind("focus.jsp")}function H(){function c(){var a=ba,b=$;switch(d){case 40:ta.scrollByY(N.keyboardSpeed,!1);break;case 38:ta.scrollByY(-N.keyboardSpeed,!1);break;case 34:case 32:ta.scrollByY(Q*N.scrollPagePercent,!1);break;case 33:ta.scrollByY(-Q*N.scrollPagePercent,!1);break;case 39:ta.scrollByX(N.keyboardSpeed,!1);break;case 37:ta.scrollByX(-N.keyboardSpeed,!1)}return e=a!=ba||b!=$}var d,e,f=[];X&&f.push(ja[0]),W&&f.push(ca[0]),O.bind("focus.jsp",function(){b.focus()}),b.attr("tabindex",0).unbind("keydown.jsp keypress.jsp").bind("keydown.jsp",function(b){if(b.target===this||f.length&&a(b.target).closest(f).length){var g=ba,h=$;switch(b.keyCode){case 40:case 38:case 34:case 32:case 33:case 39:case 37:d=b.keyCode,c();break;case 35:v(T-Q),d=null;break;case 36:v(0),d=null}return e=b.keyCode==d&&g!=ba||h!=$,!e}}).bind("keypress.jsp",function(a){return a.keyCode==d&&c(),!e}),N.hideFocus?(b.css("outline","none"),"hideFocus"in R[0]&&b.attr("hideFocus",!0)):(b.css("outline",""),"hideFocus"in R[0]&&b.attr("hideFocus",!1))}function I(){b.attr("tabindex","-1").removeAttr("tabindex").unbind("keydown.jsp keypress.jsp"),O.unbind(".jsp")}function J(){if(location.hash&&location.hash.length>1){var b,c,d=escape(location.hash.substr(1));try{b=a("#"+d+', a[name="'+d+'"]')}catch(e){return}b.length&&O.find(d)&&(0===R.scrollTop()?c=setInterval(function(){R.scrollTop()>0&&(x(b,!0),a(document).scrollTop(R.position().top),clearInterval(c))},50):(x(b,!0),a(document).scrollTop(R.position().top)))}}function K(){a(document.body).data("jspHijack")||(a(document.body).data("jspHijack",!0),a(document.body).delegate("a[href*=#]","click",function(b){var c,d,e,f,g,h,i=this.href.substr(0,this.href.indexOf("#")),j=location.href;if(-1!==location.href.indexOf("#")&&(j=location.href.substr(0,location.href.indexOf("#"))),i===j){c=escape(this.href.substr(this.href.indexOf("#")+1));try{d=a("#"+c+', a[name="'+c+'"]')}catch(k){return}d.length&&(e=d.closest(".jspScrollable"),f=e.data("jsp"),f.scrollToElement(d,!0),e[0].scrollIntoView&&(g=a(window).scrollTop(),h=d.offset().top,(g>h||h>g+a(window).height())&&e[0].scrollIntoView()),b.preventDefault())}}))}function L(){var a,b,c,d,e,f=!1;R.unbind("touchstart.jsp touchmove.jsp touchend.jsp click.jsp-touchclick").bind("touchstart.jsp",function(g){var h=g.originalEvent.touches[0];a=y(),b=z(),c=h.pageX,d=h.pageY,e=!1,f=!0}).bind("touchmove.jsp",function(g){if(f){var h=g.originalEvent.touches[0],i=ba,j=$;return ta.scrollTo(a+c-h.pageX,b+d-h.pageY),e=e||Math.abs(c-h.pageX)>5||Math.abs(d-h.pageY)>5,i==ba&&j==$}}).bind("touchend.jsp",function(a){f=!1}).bind("click.jsp-touchclick",function(a){return e?(e=!1,!1):void 0})}function M(){var a=z(),c=y();b.removeClass("jspScrollable").unbind(".jsp"),O.unbind(".jsp"),b.replaceWith(ya.append(O.children())),ya.scrollTop(a),ya.scrollLeft(c),pa&&clearInterval(pa)}var N,O,P,Q,R,S,T,U,V,W,X,Y,Z,$,_,aa,ba,ca,da,ea,fa,ga,ha,ia,ja,ka,la,ma,na,oa,pa,qa,ra,sa,ta=this,ua=!0,va=!0,wa=!1,xa=!1,ya=b.clone(!1,!1).empty(),za=a.fn.mwheelIntent?"mwheelIntent.jsp":"mousewheel.jsp";"border-box"===b.css("box-sizing")?(qa=0,ra=0):(qa=b.css("paddingTop")+" "+b.css("paddingRight")+" "+b.css("paddingBottom")+" "+b.css("paddingLeft"),ra=(parseInt(b.css("paddingLeft"),10)||0)+(parseInt(b.css("paddingRight"),10)||0)),a.extend(ta,{reinitialise:function(b){b=a.extend({},N,b),d(b)},scrollToElement:function(a,b,c){x(a,b,c)},scrollTo:function(a,b,c){w(a,c),v(b,c)},scrollToX:function(a,b){w(a,b)},scrollToY:function(a,b){v(a,b)},scrollToPercentX:function(a,b){w(a*(S-P),b)},scrollToPercentY:function(a,b){v(a*(T-Q),b)},scrollBy:function(a,b,c){ta.scrollByX(a,c),ta.scrollByY(b,c)},scrollByX:function(a,b){var c=y()+Math[0>a?"floor":"ceil"](a),d=c/(S-P);r(d*aa,b)},scrollByY:function(a,b){var c=z()+Math[0>a?"floor":"ceil"](a),d=c/(T-Q);p(d*Z,b)},positionDragX:function(a,b){r(a,b)},positionDragY:function(a,b){p(a,b)},animate:function(a,b,c,d){var e={};e[b]=c,a.animate(e,{duration:N.animateDuration,easing:N.animateEase,queue:!1,step:d})},getContentPositionX:function(){return y()},getContentPositionY:function(){return z()},getContentWidth:function(){return S},getContentHeight:function(){return T},getPercentScrolledX:function(){return y()/(S-P)},getPercentScrolledY:function(){return z()/(T-Q)},getIsScrollableH:function(){return X},getIsScrollableV:function(){return W},getContentPane:function(){return O},scrollToBottom:function(a){p(Z,a)},hijackInternalLinks:a.noop,destroy:function(){M()}}),d(c)}return b=a.extend({},a.fn.jScrollPane.defaults,b),a.each(["arrowButtonSpeed","trackClickSpeed","keyboardSpeed"],function(){b[this]=b[this]||b.speed}),this.each(function(){var d=a(this),e=d.data("jsp");e?e.reinitialise(b):(a("script",d).filter('[type="text/javascript"],:not([type])').remove(),e=new c(d,b),d.data("jsp",e))})},a.fn.jScrollPane.defaults={showArrows:!1,maintainPosition:!0,stickToBottom:!1,stickToRight:!1,clickOnTrack:!0,autoReinitialise:!1,autoReinitialiseDelay:500,verticalDragMinHeight:0,verticalDragMaxHeight:99999,horizontalDragMinWidth:0,horizontalDragMaxWidth:99999,contentWidth:void 0,animateScroll:!1,animateDuration:300,animateEase:"linear",hijackInternalLinks:!1,verticalGutter:4,horizontalGutter:4,mouseWheelSpeed:3,arrowButtonSpeed:0,arrowRepeatFreq:50,arrowScrollOnHover:!1,trackClickSpeed:0,trackClickRepeatFreq:70,verticalArrowPositions:"split",horizontalArrowPositions:"split",enableKeyboardNavigation:!0,hideFocus:!1,keyboardSpeed:0,initialDelay:300,speed:30,scrollPagePercent:.8}});



(function($) {
	"use strict";

	var sliderId = 0;

	/**
	 * Pexeto Portfolio Slider. Displays an image slider with content on the side
	 * or below it.
	 * Dependencies:
	 * - jQuery
	 * - jQuery Easing : http://gsgd.co.uk/sandbox/jquery/easing/
	 * - Images Loaded : http://github.com/desandro/imagesloaded
	 * - Touchwipe by Andreas Waltl, netCU Internetagentur (http://www.netcu.de)
	 * - jScrollPane : http://jscrollpane.kelvinluck.com/
	 * - MouseWheel : http://adomas.org/javascript-mouse-wheel/
	 *
	 * @author Pexeto
	 * http://pexetothemes.com
	 */
	$.fn.pexetoPortfolioSlider = function(options) {
		sliderId++;

		var defaults = {
			images            : [],
			navigation        : null,
			easing            : 'easeOutExpo',
			//number of images to load on portions
			loadPortions      : 5,
			animationSpeed    : 700,
			//events namespace
			namespace         : 'pexslider' + sliderId,
			minHeight         : 200,
			
			//selectors, IDs and classes
			imgContainerSel   : '.ps-images:first',
			contentSel        : '.ps-content:first',
			contentTexSel     : '.ps-content-text:first',
			leftArrowClass    : 'ps-left-arrow',
			rightArrowClass   : 'ps-right-arrow',
			loadingClass      : 'ps-loading',
			navigationSel     : '.ps-navigation',
			fullwidthClass    : 'ps-fullwidth',
			navLoadingClass   : 'ps-nav-loading',
			descClass         : 'ps-desc',
			numClass          : 'ps-imgnum',
			videoContainerSel : '.ps-video:first',
			shareSel          : '.ps-share'
		},
			//define some helper variables that will be used globally by the plugin
		o                 = $.extend(defaults, options),
		$root             = this,
		$mediaContainer   = $root.find(o.imgContainerSel),
		$contentContainer = $root.find(o.contentSel),
		$navWrapper       = $('.pg-nav-wrapper'),
		inAnimation       = false,
		$larrow           = null,
		$rarrow           = null,
		images            = o.images,
		imgContWidth      = $mediaContainer.width(),
		imgContHeight     = 0,
		lastLoaded        = 0,
		imgNum            = images.length,
		pendingImg        = -1,
		current           = 0,
		fullwidth         = $root.hasClass(o.fullwidthClass),
		contentPadding    = parseInt($contentContainer.css('paddingTop'), 10) + parseInt($contentContainer.css('border-top-width'), 10),
		$desc             = $('<div />', {
		'class'           : o.descClass
		}).appendTo($mediaContainer),
		$numContainer     = null,
		video             = false,
		jscrollApi        = null;

		/**
		 * Inits the main functionality - calls the initialization functions.
		 */
		function init() {

			PEXETO.init.tabs();

			var $share = $contentContainer.find(o.shareSel);
			if($share.length) {
				PEXETO.init.share($share);
			}

			if(!$mediaContainer.length) {
				//it's a video slider
				$mediaContainer = $root.find(o.videoContainerSel);
				video = true;

				$root.trigger("sliderLoaded");
				PEXETO.init.ieIframeFix();

			} else {
				//it's an image slider, load the images
				loadSlider();
				if(imgNum > 1) {
					addNavigation();
				}
				loadNextImages();
			}

			bindEventHandlers();

			PEXETO.init.lightbox(null, {deeplinking:false});
		}

		/**
		 * Loads the slider once all the images are loaded.
		 */
		function loadSlider() {
			var img, $img, doOnImgLoaded;

			//add the first image
			img = new Image();
			img.setAttribute("src", images[0].img);
			$img = $(img);
			images[0].el = $img;

			$mediaContainer.append($img, false);
			
			doOnImgLoaded = function() {
				//the first image has been loaded, show the slider
				$root.css({
					opacity: 0,
					display: 'block'
				});
				imgContWidth = $mediaContainer.width();

				$img.css({
					opacity: 1
				});
				setContainerHeight($img, true);
				$root.trigger("sliderLoaded");
				showDescription(images[0].desc);
			};

			$mediaContainer.find('img').pexetoOnImgLoaded({callback: doOnImgLoaded});

			if(imgNum > 1) {
				$numContainer = $('<div />', {
					'class': o.numClass,
					'html': '1 / ' + imgNum
				}).appendTo($mediaContainer);
			}

		}


		/**
		 * Binds event handlers.
		 */
		function bindEventHandlers() {
			if(!video && imgNum > 1) {
				//navigation event handlers
				$larrow.on('click.' + o.namespace, doOnPreviousClicked);
				$rarrow.on('click.' + o.namespace, doOnNextClicked);

				$mediaContainer.touchwipe({
					wipeLeft: doOnNextClicked,
					wipeRight: doOnPreviousClicked,
					preventDefaultEvents: false
				});
			}

			$(window).on('resize.' + o.namespace, doOnWindowResize);
			$root.on('destroy.' + o.namespace, destroySlider);
			

			var obj = video ? null : $root.find('img').eq(0);
			$root.on('sliderVisible.' + o.namespace, function() {
				addSliderNavigation();
				setContainerHeight(obj, false);
			});

			
		}

		function addSliderNavigation(){
			if(o.navigation){

				$navWrapper.append(o.navigation).find(o.navigationSel).on('click.' + o.namespace, 'a', doOnNavigationClick);
				
			}
		}

		/**
		 * Loads the next portion of images. The images are loaded in background
		 * on portions of n-images.
		 * - creates an image element
		 * - binds on images loaded event
		 */
		function loadNextImages() {
			var i, image, len = (lastLoaded + o.loadPortions >= imgNum) ? 
				(imgNum - 1) : (lastLoaded + o.loadPortions);

			for(i = lastLoaded + 1; i <= len; i += 1) {
				if(!images[i].loaded) {
					image = new Image();
					image.setAttribute("src", images[i].img);

					(function(i) {
						images[i].el = $(image).imagesLoaded(function() {
							images[i].loaded = true;
							if(pendingImg === i) {
								//image has been selected to show, but wasn't loaded yet
								pendingImg = -1;
								hideLoading();
								showImage(true);
							}
						});
					})(i);
				}
			}

			lastLoaded = len;
		}

		/**
		 * Displays an image in the slider.
		 * @param  {boolean} next sets whether it is the next image (when it
		 * is set to true) or the previous one (when it is set to false)
		 */
		function showImage(next) {
			inAnimation = true;
			var i = next ? 1 : -1,
				$img = images[current + i].el.appendTo($mediaContainer).css({
					left: imgContWidth * i
				});

			setContainerHeight($img, true);

			if(imgNum > 1) {
				$numContainer.html((current + i + 1) + ' / ' + imgNum);
			}

			//hide the current image
			images[current].el.animate({
				opacity: 0.5,
				left: -imgContWidth * i
			}, o.animationSpeed, o.easing, function() {
				$(this).detach();
			});

			//show the next umage
			$img.animate({
				left: 0,
				opacity: 1
			}, o.animationSpeed, o.easing, function() {
				current = current + i;
				inAnimation = false;
			});

			showDescription(images[current + i].desc);
		}

		/**
		 * Displays the descriptuon of the current image.
		 * @param  {string} desc the description text
		 */
		function showDescription(desc) {
			if(desc) {
				$desc.html(desc).fadeIn();
			} else {
				$desc.fadeOut();
			}
		}

		/**
		 * Calculates and sets the container height according to the current
		 * image height.
		 * @param {object} $img    the current image displayed, it can be null
		 * if it is a video currently displayed.
		 * @param {boolean} animate sets whether to animate the container to the
		 * new height or just change it with CSS.
		 */
		function setContainerHeight($img, animate) {
			var height = video ? $mediaContainer.height() : Math.max($img.get(0).clientHeight, o.minHeight),
				func = animate ? $.fn.animate : $.fn.css,
				args = [{
					height: height
				}],
				width, infoHeight = 0,
				textHeight, full = fullwidth || $contentContainer.css('width') == $mediaContainer.css('width');

			if(!video && full && PEXETO.utils.checkIfMobile()){
				args[0]['height'] = $img.get(0).clientHeight;
			}


			if(animate) {
				args.push(o.animationSpeed);
			}

			if(!video) {
				func.apply($mediaContainer, args);
			}

			if($img && PEXETO.getBrowser().msie && (PEXETO.getBrowser().version=='10.0' ||  PEXETO.getBrowser().version=='9.0')){
				//fix a stretching image problem on IE
				var params = PEXETO.url.getCustomUrlParameters($img.attr('src'));
				if(params.h && parseInt(params.h,10)<height){
					$mediaContainer.css({maxHeight:params.h+'px'});
					$img.css({maxHeight:params.h+'px'});
				}
			}

			if(!full) {

				//it is not in a full-width layout
				width = $contentContainer.width();
				$contentContainer.children().not(o.contentTexSel).each(function() {
					infoHeight += $(this).outerHeight();
				});

				func.apply($root, args);
				textHeight = height - infoHeight - 2 * contentPadding;

				//init the scrolling plugin for longer texts in the description
				jscrollApi = $contentContainer.find(o.contentTexSel).css({
					height: textHeight,
					width: width
				}).jScrollPane().data('jsp');

				if(!fullwidth) {
				$root.find('img').on('imgmasonryloaded.'+ o.namespace,function(){
					jscrollApi = $contentContainer.find(o.contentTexSel).jScrollPane().data('jsp');
				});
			}

			} else {

				if(jscrollApi) {
					var $text = $contentContainer.find(o.contentTexSel).clone();
					//disable the scrolling plugin
					jscrollApi.destroy();
					if(!$contentContainer.find(o.contentTexSel).length){
						
						$text.insertAfter($contentContainer.find('.ps-categories'));
					}
				}

				//set an automatic height to the text area
				$contentContainer.find(o.contentTexSel).css({
					height: 'auto',
					width: 'auto'
				});

			}
		}

		/**
		 * Displays a loader on the current image.
		 */
		function showLoading() {
			$mediaContainer.append('<div class="' + o.loadingClass + '"></div>');
		}

		/**
		 * Hides the loader on the current image.
		 */
		function hideLoading() {
			$mediaContainer.find("." + o.loadingClass).remove();
		}


		/**
		 * Adds the navigation elements.
		 */
		function addNavigation() {
			//previous/next arrows
			$larrow = $('<div class="' + o.leftArrowClass + '" ></div>').appendTo($mediaContainer);
			$rarrow = $('<div class="' + o.rightArrowClass + '" ></div>').appendTo($mediaContainer);

		}

		/**
		 * On next arrow click event handler. Shows the next image if there is 
		 * one.
		 */
		function doOnNextClicked() {
			if(!inAnimation) {
				if((current + 1) < imgNum) {
					//show next image
					if(images[current + 1].loaded) {
						showImage(images[current + 1].el);
					} else {
						pendingImg = current + 1;
						showLoading();
					}
					if(current + 1 === lastLoaded && lastLoaded + 1 < imgNum) {
						loadNextImages();
					}
				} else {
					animateLastImage(true);
				}
			}
		}

		/**
		 * On previous arrow click event handler. Shows the previous one if
		 * there is one.
		 */
		function doOnPreviousClicked() {
			if(!inAnimation) {
				if(current !== 0) {
					//show previous image
					showImage(false);
				} else {
					animateLastImage(false);
				}
			}
		}

		/**
		 * Animates the slider in a way to show that there isn't anymore images
		 * to display.
		 * @param  {boolean} last sets whether it is the last image (when set 
		 * to true) or whether it is the first image (when set to false)
		 */
		function animateLastImage(last) {
			var i = last ? -1 : 1;
			images[current].el.stop().animate({
				left: i * 10
			}, 100, function() {
				$(this).stop().animate({
					left: 0
				}, 300);
			});
		}

		/**
		 * On window resize event handler. Resets the container size.
		 */
		function doOnWindowResize() {
			var currentObj = video ? null : images[current].el;
			setContainerHeight(currentObj, false);
		}

		/**
		 * On navigation click event handler. Fired when one of the 
		 * "next project", "previous project" or "back to gallery" buttons
		 * is clicked.
		 * @param  {object} e the even object
		 */
		function doOnNavigationClick(e) {
			e.preventDefault();

			if(!$(this).hasClass('disabled')) {
				$root.trigger('navigationClick', [$(this).attr('rel')]);
				$(e.delegateTarget).addClass(o.navLoadingClass);
			}
		}

		/**
		 * Destroys the slider. Removes all the registered event handlers.
		 */
		function destroySlider() {
			$(window).off('.' + o.namespace);
			$root.off('.' + o.namespace).children().off('.' + o.namespace);
			$navWrapper.off('.' + o.namespace).find(o.navigationSel).eq(0).remove();
		}

		init();


	};
}(jQuery));



/**
 * Portfolio gallery.
 *
 * Dependencies:
 * - jQuery
 * - jQuery Masonry : http://masonry.desandro.com
 * - PEXETO.init.masonry
 * - Images Loaded : http://github.com/desandro/imagesloaded
 * - jQuery Easing : http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * @author Pexeto
 * http://pexetothemes.com
 */
(function($) {
	"use strict";

	$.fn.pexetoGallery = function(options) {
		var defaults         = {
			ajaxUrl              : '',
			itemsPerPage         : 10,
			currentPage          : 1,
			currentCat           : '-1',
			imgheight            : 200,
			additionalWidth      : 8,
			columns              : 3,
			filterCats           : [],
			filterType           : 'exclude',
			masonry              : false,
			enableAJAX           : true,
			animationSpeed       : 800,
			sliderAnimationSpeed : 700,
			pageUrl              : '',
			singleItem           : false,
			relatedLightbox      : false,
			categoryFilter       : true,
			itemsMap             : [],
			easing               : 'easeOutExpo',
			
			//selectors, classes and IDs
			itemSel              : '.pg-item',
			imgWrapperSel        : '.pg-img-wrapper',
			itemInfoSel          : '.pg-details',
			paginationSel        : '.pg-pagination:first',
			categorySel          : '.pg-cat-filter:first',
			itemsContainerSel    : '.pg-items:first',
			itemsWrapperSel      : '.pg-items-wrapper:first',
			pageWrapperClass     : 'pg-page-wrapper',
			parentSel            : '#full-width',
			currentClass         : 'current',
			loadingClass         : 'pg-loading',
			elementLoadingClass  : 'pg-element-loading',
			sliderSel            : '.ps-wrapper',
			carItemClass         : 'pc-item',
			carSel               : '.portfolio-carousel:first',
			noCatLoadingClass    : 'pg-nocat-loading',
			filterBtnSel         : '.pg-filter-btn',
			openedClass          : 'filter-opened',
			galleryHiddenClass   : 'pg-gallery-hidden'
		},
		o                    = $.extend(defaults, options),
		$root                = this,
		$itemsContainer      = null,
		$categoryContainer   = null,
		$paginationContainer = null,
		$itemsWrapper        = null,
		$parent              = $root.parent(),
		$loadingContainer    = null,
		currentPage          = o.currentPage,
		previousPage         = currentPage,
		cachedItems          = [],
		cachedSliderItems    = [],
		currentXhr           = null,
		$currentPage         = null,
		containerWidth       = 0,
		supportsHistory      = (window.history && window.history.pushState) ? true : false,
		currentCat           = o.currentCat,
		currentItem          = o.itemId || 0,
		inAnimation          = false,
		$slider              = null,
		$prevSlider          = null,
		$carousel            = null,
		$prevCarousel        = null,
		pendingLoadings      = [],
		$filterBtn           = $(o.filterBtnSel),
		filterDisplayed      = false,
		filterInAnimation    = false,
		galleryView          = false,
		$navWrapper          = $('.pg-nav-wrapper'),
		resizeManager        = null,
		$pageTop             = null,
		$itemTop             = null,
		scrollOffset         = 0;
		


		/**
		 * Inits the main functionality - inits a gallery view if the gallery
		 * has been selected or a slider view if a slider has been selected.
		 */
		function init() {
			var $pageWrapper = null,
				data,
				catName;

			if(!o.singleItem) {
				//load the main gallery elements
				$itemsContainer = $root.find(o.itemsContainerSel);
				$categoryContainer = $(o.categorySel);
				$paginationContainer = $root.find(o.paginationSel);
				$itemsWrapper = $root.find(o.itemsWrapperSel);
			}

			setScrollTop();
			bindEventHandlers();

			if(!o.singleItem) {
				//it is a gallery view
				$pageWrapper = $root.find('.' + o.pageWrapperClass);
				galleryView = true;

				//add the currently loaded items to the cache
				addCachedItem({
					cat: currentCat,
					page: currentPage
				}, {
					pageWrapper: $pageWrapper,
					paginationUl: $paginationContainer.find('ul')
				});


				$currentPage = $pageWrapper;
				setContainerWidth($currentPage);

				//display the gallery view
				showCurrentItems(false);
				$loadingContainer = $categoryContainer.length ? $categoryContainer : $('<div />', {
					'class': o.noCatLoadingClass
				}).insertBefore($parent);


				addLoadingTo($loadingContainer, null);

				//init masonry
				resizeManager = new PEXETO.utils.resizableImageGallery(o.itemSel, {
					parent: $currentPage,
					masonry : o.masonry
				}).init();

				//init lightbox
				initLightbox($currentPage);

				//set the current category name to the filter button
				if(o.categoryFilter){
					catName = $categoryContainer.find('a[data-cat="'+currentCat+'"]').html();
					setFilterBtnText(catName);
				}

			} else {
				//it is a single slider item, load the slider and the images
				$slider = $root.find(o.sliderSel);
				$carousel = $root.find(o.carSel);

				if(o.video) {
					initSlider([], null);
					$slider.trigger('sliderVisible');
				} else {
					//load the slider images
					data = {
						action: 'pexeto_get_slider_images',
						itemid: o.itemId
					};

					getJsonAjax(data).done(function(res) {
						var images = res || [];

						initSlider(images, null);
					});
				}
			}


		}


		/***********************************************************************
		 * GENERAL FUNCTIONS
		 **********************************************************************/


		 /**
		  * Retrieves the current page items depending on the category and page
		  * selected. First checks if these items have been already opened and
		  * added to the cache and if so, loads the items from the cache. If not,
		  * makes an AJAX request to load the items.
		  * @param  {object} args containing the arguments for the page:
		  * - cat : setting the category to load
		  * - page : setting the number of the page to load
		  * Once the items are retrieved, calls a function to display them.
		  */
		function getPageItems(args) {
			var data, callback = (args.cat && !args.page) ? showCatItems : showPageItems,
				page = args.page || 1,
				cat = args.cat || '-1',
				cachedItem = getCachedItem(args),
				requireNav = (cachedItem && cachedItem.pagination) ? false : true,
				$newPagination = null,
				callbackArgs = {};

			if(cachedItem && cachedItem.pages[page]) {
				//the items with these arguments are already loaded
				//show the cached items
				if(cat !== currentCat) {
					callbackArgs.pagination = cachedItem.pagination;
				}
				callbackArgs.page = cachedItem.pages[page];
				callbackArgs.cached = true;
				setCurrentVars(args);
				callback.call(null, callbackArgs);
			} else {
				//prepare the data for an AJAX request
				data = {
					page: page,
					number: o.itemsPerPage,
					imgheight: o.imgheight,
					columns: o.columns,
					filter_cats: o.filterCats,
					filter_type: o.filterType,
					page_url: o.pageUrl,
					require_nav: requireNav,
					orderby: o.orderby,
					order: o.order,
					action: 'pexeto_get_portfolio_items'
				};

				if(cat !== '-1') {
					data.cat = cat;
				}

				//make the AJAX request
				getJsonAjax(data).done(function(res) {
					//the AJAX request was successfull
					var cacheItems = {},
						$pagination = null,
						$newPage = null,
						args = {
							cat: cat,
							page: page
						};


					if(res.items !== undefined) {
						setCurrentVars(args);
						$newPage = $('<div />', {
							'class': o.pageWrapperClass
						}).append(res.items);

						$newPage.find(o.itemSel).css({
							opacity: 1
						});
						cacheItems.pageWrapper = $newPage;
						callbackArgs.page = $newPage;

						if(requireNav) {
							//set the navigation
							$pagination = $(res.pagination);
							cacheItems.paginationUl = $pagination;
							callbackArgs.pagination = $pagination;
						}

						initLightbox($newPage);
						addCachedItem(args, cacheItems);
						callback.call(null, callbackArgs);
					}
				});
			}
		}

		/**
		 * Loads a slider item. Checks if the item has been already loaded
		 * and added to the cache and if so, uses the cached item. If not,
		 * makes an AJAX request to load the slider data. After the data
		 * is loaded, adds the slider element to the content wrapper and
		 * initializes it.
		 * @param  {int} itemId the ID of the item to be displayed as a slider
		 */
		function loadSliderItem(itemId) {
			var data, doOnSliderContentLoaded;

			if(!inAnimation && currentItem !== itemId) {
				abortPendingRequests();

				data = {
					itemid: itemId,
					single: o.singleItem,
					action: 'pexeto_get_portfolio_slider_item'
				};

				if(!o.singleItem && getSiblingId(true, itemId) === -1) {
					data.next = false;
				}

				if(!o.singleItem && getSiblingId(false, itemId) === -1) {
					data.prev = false;
				}

				//set a callback function that will be called when the slider
				//data is retrieved
				doOnSliderContentLoaded = function(res) {
					var images, itemLink, navigation;

					if(res) {
						$prevSlider = $slider || null;
						$prevCarousel = $carousel || null;
						currentItem = itemId;

						if(supportsHistory) {
							//change the URL in the browser
							itemLink = res.permalink;
							if($prevSlider) {
								window.history.replaceState({
									item: itemId
								}, null, itemLink);
							} else {
								window.history.pushState({
									item: itemId
								}, null, itemLink);
							}
						}

						//create the slider object
						$slider = $(res.slider).appendTo($root).eq(0);

						//create the carousel object
						if(res.carousel) {
							$carousel = $(res.carousel);
							$carousel.insertAfter($slider);
						}
						images = res.images || [];
						navigation = res.slider_nav || null;
						initSlider(images, navigation);



						if(!cachedSliderItems[itemId]) {
							//cache the result
							cachedSliderItems[itemId] = res;
						}

					}
				};

				if(cachedSliderItems[itemId]) {
					//the slider item is cached, use the cache data
					doOnSliderContentLoaded(cachedSliderItems[itemId]);
				} else {
					//load the data with AJAX
					getJsonAjax(data).done(doOnSliderContentLoaded);
				}
			}
		}

		/**
		 * Initializes the slider and carousel script.
		 * @param  {array} images the images that the slider will display
		 */
		function initSlider(images, navigation) {
			//init the slider
			$slider.pexetoPortfolioSlider({
				images: images,
				navigation : navigation
			});
			//init the carousel
			if($carousel) {
				$carousel.pexetoCarousel({
					selfDisplay: false
				});
			}
		}

		
		/***********************************************************************
		 * EVENT HANDLER FUNCTIONS
		 **********************************************************************/

		/**
		 * Binds the event handlers.
		 */
		function bindEventHandlers() {

			if(o.enableAJAX) {

				if(!o.singleItem) {
					//pagination events
					$paginationContainer.on('click', 'a', doOnPaginationClick);

					if(o.categoryFilter){
						//category events
						$categoryContainer.on('click', 'a', doOnCategoryClick);

					}
				}

				//item click events
				$root.on('click', 
					o.itemSel + '[data-type="smallslider"],.' 
						+ o.carItemClass + '[data-type="smallslider"], ' 
						+ o.itemSel + '[data-type="fullslider"],.' 
						+ o.carItemClass + '[data-type="fullslider"]', 
					doOnItemSliderClick)
				.on('click', 
					o.itemSel + '[data-type="smallvideo"],.' 
						+ o.carItemClass + '[data-type="smallvideo"], ' 
						+ o.itemSel + '[data-type="fullvideo"],.' 
						+ o.carItemClass + '[data-type="fullvideo"]', 
					doOnItemVideoClick)
				.on('navigationClick', o.sliderSel, doOnNavigationClick);

				if(supportsHistory) {
					window.onpopstate = function(e) {
						if(!galleryView && !o.singleItem) {
							backToGallery();
						}
					};
				}
			}

			if(o.categoryFilter){
				$filterBtn.on('click', doOnFilterClick);
			}

			//lightbox click events
			$root.on('click', 
				o.itemSel + '[data-type="lightbox"],.' 
					+ o.carItemClass + '[data-type="lightbox"]', 
				doOnItemLightboxClick)
			.on('sliderLoaded', o.sliderSel, showSlider);

			$(window).on('resize', function() {
				if($currentPage) {
					setContainerWidth($currentPage);
				}

				if(o.categoryFilter){
					setFilterVisibility();
				}
			});
		}

		/**
		 * On pagination click handler. If a new page has been requested, calls
		 * a function to load the items from that page.
		 * @param  {e} e the event object
		 */
		function doOnPaginationClick(e) {
			e.preventDefault();
			var page = $(this).data('page') || 1;

			if(page !== currentPage && !inAnimation) {
				abortPendingRequests();
				addLoadingTo($paginationContainer, null);
				getPageItems({
					page: page,
					cat: currentCat
				});

				//set the current CSS class to the selected page
				$paginationContainer.find("." + o.currentClass).removeClass(o.currentClass);
				$(this).addClass(o.currentClass);

				if(supportsHistory) {
					//change the URL in the browser
					window.history.replaceState({
						gallery: true
					}, null, $(this).attr('href'));
				}
			}
		}

		/**
		 * On category click handler. If a new category has been requested, 
		 * calls a function to load the items from that category.
		 * @param  {e} e the event object
		 */
		function doOnCategoryClick(e) {
			e.preventDefault();
			var cat = $(this).data('cat') || '-1';
			cat = String(cat);

			if(cat !== currentCat && !inAnimation) {
				abortPendingRequests();

				addLoadingTo($categoryContainer, null);
				getPageItems({
					cat: cat
				});

				//set the current CSS class to the selected category
				$categoryContainer.find("." + o.currentClass).removeClass(o.currentClass);
				$(this).addClass(o.currentClass);
				
				setFilterBtnText($(this).html());

				if(filterDisplayed){
					hideFilter();
				}

				if(supportsHistory) {
					//change the URL in the browser
					window.history.replaceState({
						gallery: true
					}, null, $(this).attr('href'));
				}
			}
		}

		
		/**
		 * On slider item click event handler. Calls a function to load the 
		 * slider data of this item.
		 * @param  {object} e the event object
		 */
		function doOnItemSliderClick(e) {
			e.preventDefault();

			var itemId = parseInt($(this).data('itemid'), 10);

			loadSliderItem(itemId);

			addLoadingTo(null, $(this));
		}

		/**
		 * On video item click event handler. Calls a function to load the 
		 * video slider data of this item.
		 * @param  {object} e the event object
		 */
		function doOnItemVideoClick(e) {
			e.preventDefault();

			var itemId = parseInt($(this).data('itemid'), 10);

			loadSliderItem(itemId);

			addLoadingTo(null, $(this));
		}

		/**
		 * On lightbox item click event handler. Calls a function to load the 
		 * lightbox preview image of this item.
		 * @param  {object} e the event object
		 */
		function doOnItemLightboxClick(e) {
			var data,
				$el;

			if(!o.relatedLightbox || $(this).hasClass(o.carItemClass)) {
				e.preventDefault();

				data = {
					action: 'pexeto_get_slider_images',
					itemid: $(this).data('itemid')
				};

				addLoadingTo(null, $(this));

				//load the item images with an AJAX request
				getJsonAjax(data).done(function(res) {
					var images = res || [],
						pp_images = [],
						pp_titles = [],
						pp_descs = [],
						i, len;

					for(i = 0, len = images.length; i < len; i++) {
						pp_images[i] = images[i].img;
						pp_titles[i] = '';
						pp_descs[i] = images[i].desc;
					}

					removeLoading();

					$.prettyPhoto.open(pp_images, pp_titles, pp_descs);
				});
			}
		}

		/**
		 * Slider navigation click event handler - fired when one of the
		 * "next project", "previous project" or "back to gallery" button
		 * was clicked.
		 * @param  {object} e   the event object
		 * @param  {string} rel the rel attribute of the clicked button which
		 * sets the type of the action to perform.
		 */
		function doOnNavigationClick(e, rel) {
			var newItemId;

			switch(rel) {
			case 'back':
				//back to gallery
				backToGallery();
				break;
			case 'prev':
				//load the previous item
				newItemId = getSiblingId(false, currentItem);
				if(newItemId !== -1) {
					loadSliderItem(newItemId);
				}
				break;
			case 'next':
				//load the next item
				newItemId = getSiblingId(true, currentItem);
				if(newItemId !== -1) {
					loadSliderItem(newItemId);
				}
				break;
			}
		}

		function doOnFilterClick() {
			var that = $(this);

			if(filterDisplayed){
				hideFilter();
			}else{
				showFilter();
			}
		}

		function hideFilter(){
			if (!filterInAnimation) {
				filterInAnimation = true;
				$filterBtn.removeClass(o.openedClass);
				$categoryContainer.find('ul').animate({height:'hide'}, function() {
					filterInAnimation = false;
					filterDisplayed = false;
				});
			}
		}

		function showFilter(){
			if (!filterInAnimation) {
				filterInAnimation = true;
				$filterBtn.addClass(o.openedClass);
				$categoryContainer.find('ul').animate({height:'show'}, function() {
					filterInAnimation = false;
					filterDisplayed = true;
				});
			}
		}


		/***********************************************************************
		 * AJAX FUNCTIONS
		 **********************************************************************/

		/**
		 * Makes a JSON AJAX request with the specified data.
		 * @param  {object} data the data that will be sent in the request.
		 * @return {object}      the XHR object of the request
		 */
		function getJsonAjax(data) {
			if(!currentXhr) {
				currentXhr = $.ajax({
					url: o.ajaxUrl,
					data: data,
					dataType: 'json',
					type: 'GET'
				}).always(function() {
					currentXhr = null;
				});
			}

			return currentXhr;
		}

		/***********************************************************************
		 * ELEMENT ACCESS AND CHANGE FUNCTIONS
		 **********************************************************************/


		/**
		 * Displays the slider. Hides the current elements (can be a gallery
		 * or another slider) and then displays the slider with its carousel
		 * (if there is one set).
		 */
		function showSlider() {
			galleryView = false;
			removeLoading();

			//set the display slider animation
			var displaySlider = function() {
				$slider.css({
					opacity: 0,
					display: 'block',
					marginTop: 200
				}).trigger('sliderVisible').animate({
					opacity: 1,
					marginTop: 0
				}, o.sliderAnimationSpeed);
				PEXETO.init.quickGallery();
				setTimeout(function() {
					

					if(PEXETO.getBrowser().msie){
						$carousel.css({
							marginTop: 0,
							opacity: 1
						});
					}else{
						$carousel.css({
						opacity: 0,
						marginTop: 200
					}).animate({
							opacity: 1,
							marginTop: 0
						}, o.sliderAnimationSpeed);
					}
				}, o.sliderAnimationSpeed / 2);

			};

			if(o.singleItem && !$prevSlider) {
				//it is a single item page where just the slider should be
				//displayed
				displaySlider();
			} else {
				//scroll to the top, in case the slider has been opened
				//from the bottom of a long gallery
				$.scrollTo($pageTop, {
					duration: 500
					,offset: {
						top: scrollOffset
					}
				});



				if($prevSlider) {
					//a slider is currently displayed, hide its elements
					
					//hide the carousel
					if($prevCarousel) {
						$prevCarousel.animate({
							opacity: 0
						}, o.sliderAnimationSpeed - 100, function() {
							$prevCarousel.trigger('destroy').remove();
						});
					}

					//hide the slider
					$prevSlider.animate({
						marginTop: 500,
						opacity: 0
					}, o.sliderAnimationSpeed, function() {
						displaySlider();
						$(this).trigger('destroy').remove();
					});

				} else {
					//a gallery is currently displayed, hide the gallery
					$itemsWrapper.animate({
						marginTop: 500,
						opacity: 0,
						height: 'hide'
					}, o.sliderAnimationSpeed, function() {
						$('body').addClass(o.galleryHiddenClass);
						displaySlider();
						if($categoryContainer.length){
							$categoryContainer.hide();
						}
						if(resizeManager){
							resizeManager.pause();
						}
					});
				}
			}
		}

		/**
		 * Shows the gallery after a slider's back to gallery button has been
		 * clickec.
		 */
		function backToGallery() {
			if(o.singleItem || !$slider) {
				return false;
			}

			removeLoading();

			//hide the slider
			$slider.animate({
				marginTop: 500,
				opacity: 0
			}, o.sliderAnimationSpeed, function() {
				$slider.trigger('destroy').remove();
				$slider = null;
				currentItem = 0;
				galleryView = true;

				if($categoryContainer.length){
					$categoryContainer.fadeIn();
				}

				//show the gallery items
				$itemsWrapper.animate({
					height: 'show'
				}, 0);
				setContainerWidth($currentPage);

				setMasonry($currentPage, false);

				$itemsWrapper.animate({
					marginTop: 0,
					opacity: 1,
					height: 'show'
				}, o.sliderAnimationSpeed);

				$('body').removeClass(o.galleryHiddenClass);
			});

			//hide the carousel
			if($carousel) {
				$carousel.animate({
					marginTop: 500,
					opacity: 0
				}, o.sliderAnimationSpeed, function() {
					$carousel.trigger('destroy').remove();
					$carousel = null;
				});
			}

			if(supportsHistory) {
				//change the URL of the current page in the browser address bar
				window.history.pushState({
					back: true
				}, null, o.pageUrl);
			}
		}

		/**
		 * Shows a new set of items to be displayed.
		 * @param  {boolean} cached setting whether the items have been cached
		 * (loaded earlier) or they have been just loaded to the page.
		 * @return {object}        a $.Deferred object, which will be resolved
		 * once the animation has finished and the items are displayed.
		 */
		function showCurrentItems(cached) {

			var loadedItems = [],
				$items = $currentPage.find(o.itemSel).css({
					opacity: 0
				}),
				itemNum = $items.length,
				pendingIndex = 0,
				def = new $.Deferred(),
				//timer animation function that will display the items one by one
				//with a delay after each item's animation
				timeoutAnimation = function(index) {
					setTimeout(function() {
						showItem(index);
					}, 100);
					if(index + 1 === itemNum) {
						def.resolve();
						removeLoading();
					}
				},
				//displays an item with the index set
				showItem = function(index) {
					var initArgs = o.masonry ? {marginTop:100} : {top:100},
						endArgs = o.masonry ? {marginTop:0} : {top:0};

					endArgs.opacity = 1;

					$items.eq(index).css(initArgs).animate(endArgs, function(){
						if(o.masonry && resizeManager){
							//refresh the masonry layout to position the items better
							resizeManager.refresh();
						}
					});

					if(cached || loadedItems[index + 1]) {
						timeoutAnimation(index + 1);
					} else {
						pendingIndex = index + 1;
					}
				};

			if(!cached) {
				$currentPage.find('img').on('imgmasonryloaded', function() {
					//an item's image has been loaded, set its index as loaded
					var $parent = $(this).parents(o.itemSel),
						index = $items.index($parent);

					loadedItems[index] = true;

					if(pendingIndex == index) {
						timeoutAnimation(index);
					}
				});
			} else {
				timeoutAnimation(0);
			}

			return def.promise();
		}


		/**
		 * Displays a set of items after a new category has been selected.
		 * @param  {object} args arguments setting:
		 * - page - the jQuery page wrapper object
		 * - cached - boolean setting whether the items have been cached or just
		 * loaded to the page
		 * - pagination - a juery pagination object
		 */
		function showCatItems(args) {
			var $newPage = args.page,
				cached = args.cached,
				$pagination = args.pagination,
				def;

			inAnimation = true;

			//hide the current pagination
			$paginationContainer.css({
				opacity: 0
			});

			//hide the current page
			$currentPage.animate({
				opacity: 0
			}, function() {
				//insert the new page
				$newPage.insertAfter($currentPage).css({
					opacity: 1,
					marginLeft: 0
				});

				setContainerWidth($newPage);

				$currentPage.detach();
				$currentPage = $newPage;

				//animate the items in the page
				def = showCurrentItems(cached).done(function() {
					inAnimation = false;
					if($pagination) {
						$paginationContainer.css({
							opacity: 1
						}).html($pagination);
					}
				});
				$paginationContainer.find("." + o.currentClass).removeClass(o.currentClass);
				$paginationContainer.find('li:first a').addClass(o.currentClass);

				setMasonry($newPage, false);
			});
		}

		/**
		 * Displays a set of items after a new page has been selected.
		 * @param  {object} args arguments setting:
		 * - page - the jQuery page wrapper object
		 * - cached - boolean setting whether the items have been cached or just
		 * loaded to the page
		 */
		function showPageItems(args) {
			var $newPage = args.page,
				cached = args.cached,
				showNext = parseInt(previousPage, 10) > parseInt(currentPage, 10) ? false : true,
				currentHeight = 0,
				newPageMargin = showNext ? 0 : -containerWidth,
				currentPageMargin = showNext ? -containerWidth : 0;


			inAnimation = true;

			$newPage.find('img').pexetoOnImgLoaded({callback:function() {
				//the images are loaded, show the new page
				//set the new page initial position for the animation
				//hide the loadings
				removeLoading();

				setContainerWidth($newPage);
				$newPage.show().css({
					marginLeft: newPageMargin,
					opacity: 0
				});		

				$.scrollTo($itemTop, {
					duration: 600,
					offset: {
						top: scrollOffset
					},
					onAfter : function(){
						//insert the new page
						if(showNext) {
							$newPage.insertAfter($currentPage).animate({
								opacity: 1
							});
						} else {
							$newPage.insertBefore($currentPage).animate({
								marginLeft: 0,
								opacity: 1
							}, o.animationSpeed, o.easing);
						}

						$newPage.find(o.itemSel).css({opacity:1});	

						setMasonry($newPage, false);

						//set the container height according to the new page height
						setContainerHeight($newPage, true);

						//animate the current page to get hidden
						$currentPage.animate({
							marginLeft: currentPageMargin,
							opacity: 0
						}, o.animationSpeed, o.easing, function() {
							$(this).detach();
							inAnimation = false;
						});

						$currentPage = $newPage;

					}});
			}});
		}

		/**
		 * Sets the containerWidth variable and refreshes the current page 
		 * width with this value.
		 * @param {object} $page a jQuery object of the current page element
		 */
		function setContainerWidth($page) {
			if(galleryView) {
				containerWidth = $parent.width() + o.additionalWidth;
				$page.width(containerWidth);
			}
		}

		/**
		 * Sets the items container height according to the wrapping page 
		 * height.
		 * @param {object} $page   a jQuery object of the current page element
		 * @param {boolean} animate sets whether to animate the height change
		 * or to just apply it with CSS.
		 */
		function setContainerHeight($page, animate) {
			var pageHeight = $page.height();
			if(animate) {
				$itemsContainer.animate({
					height: pageHeight
				}, o.animationSpeed);
			} else {
				$itemsContainer.css({
					height: pageHeight
				});
			}
		}

		/**
		 * Populates the filter button text with the currently selected category
		 * name. This button is displayed on small screen devices only.
		 * @param {string} catName the name of the selected category
		 */
		function setFilterBtnText(catName){
			$filterBtn.find("span:first").html(catName);
		}

		function setFilterVisibility(){
			if(galleryView && !$filterBtn.is(':visible') && !$categoryContainer.find('ul').is(':visible')){
				$categoryContainer.find('ul').css({display:'inline-block'});
			}
		}

		/***********************************************************************
		 * HELPER FUNCTIONS
		 **********************************************************************/

		/**
		 * Inits the Masonry script to the page wrapper element.
		 * @param {object} $page  jQuery page wrapper element that contains
		 * the masonry items
		 * @param {boolean} cached sets whether the items have been already
		 * cached and in this case will just refresh the script or whether
		 * they have been just loaded (will initialize the script)
		 */
		function setMasonry($page, cached) {
			if(cached && resizeManager) {
				//refresh the masonry
				resizeManager.resume();
				resizeManager.refresh();
			} else {
				//init the masonry
				resizeManager = new PEXETO.utils.resizableImageGallery(o.itemSel, {
					parent: $page,
					masonry : o.masonry
				}).init();
			}
		}


		/**
		 * Retrieves the ID of the next/previous sibling element.
		 * @param  {boolean} next   sets if it is the next item or the previous
		 * whose ID should be retrieved
		 * @param  {int}   itemId the ID of the current item
		 * @return {int}          the ID of the next/previous item if
		 * there is one or -1 of there isn't such an item.
		 */
		function getSiblingId(next, itemId) {
			var i = next ? 1 : -1,
				itemIndex = $.inArray(itemId, o.itemsMap),
				newItemId = -1;
			if(itemIndex !== -1 && o.itemsMap[itemIndex + i]) {
				newItemId = o.itemsMap[itemIndex + i];
			}
			return newItemId;
		}

		/**
		 * Inits the lightbox when the preview images of all the items are set 
		 * to be related to each other in the lightbox.
		 * @param  {object} $wrapper a jQuery wrapper object that contains all
		 * the items
		 */
		function initLightbox($wrapper) {
			if(o.relatedLightbox) {
				PEXETO.init.lightbox($wrapper.find(o.itemSel 
					+ '[data-type="lightbox"] a,.' + o.carItemClass 
					+ '[data-type="lightbox"] a'), {deeplinking:false});
			}
		}

		/**
		 * Sets the current page and category variables.
		 * @param {object} args containing the new variables that should be set:
		 * - page : the current page number
		 * - cat : the current category ID
		 */
		function setCurrentVars(args) {
			previousPage = currentPage;
			currentPage = args.page || 1;
			currentCat = args.cat || '-1';
		}

		/**
		 * Adss a loaded page with items to the cache.
		 * @param {object} args  setting the current page and category:
		 * - page : the current page number
		 * - cat : the current category ID
		 * @param {object} items object containing the elements that will be
		 * cached with the following keys:
		 * - pageWrapper : the page wrapper object
		 * - paginationUL : the pagination object
		 */
		function addCachedItem(args, items) {
			var cat = args.cat || '-1',
				page = args.page || 1,
				cachedItem = null;

			if(!cachedItems[cat]) {
				//add a cached item for this category
				cachedItems[cat] = {
					pages: [],
					pagination: null
				};
			}
			cachedItem = cachedItems[cat];
			if(!cachedItem.pages[page]) {
				//add a cached item for this page
				cachedItem.pages[page] = items.pageWrapper;
			}

			if(items.paginationUl && !cachedItem.pagination) {
				//cache the pagination
				cachedItem.pagination = items.paginationUl;
			}

		}

		/**
		 * Retrieves an item from a cache according to the selected page and
		 * category.
		 * @param {object} args setting the current page and category:
		 * - page : the current page number
		 * - cat : the current category ID
		 * @return the cached object if it exists or null if it doesn't exist
		 */
		function getCachedItem(args) {
			var cat = args.cat || '-1',
				page = args.page || 1;

			return cachedItems[cat] || null;
		}

		/**
		 * Aborts the current pending requests.
		 */
		function abortPendingRequests() {
			if(currentXhr) {
				//there is a request pending, abort it and execute this one
				currentXhr.abort();
			}
			removeLoading();
		}

		/**
		 * Appends a loader element to the specified element.
		 * @param {object} $el a jQuery element to which to append the loading
		 * @param {object} $parent the parent element to which to assign a loading
		 * class. If set to null, the loading class will be assigned to the $el
		 * element.
		 */
		function addLoadingTo($el, $parent) {
			var loadingEl = {};

			if($el){
				var $pendingLoading = $('<div />', {
					"class": o.loadingClass
				});
				$el.append($pendingLoading).addClass(o.elementLoadingClass);
				loadingEl.loading = $pendingLoading;
			}
			

			$parent = $parent || $el;
			$parent.addClass(o.elementLoadingClass);
			loadingEl.el = $parent;

			pendingLoadings.push(loadingEl);
		}

		/**
		 * Removes a loader element.
		 * @return {object} the jQuery loader element to remove.
		 */
		function removeLoading() {
			var pendingItem = null;

			while(pendingLoadings.length) {
				pendingItem = pendingLoadings.pop();
				if(pendingItem.loading){
					pendingItem.loading.remove();
				}
				
				pendingItem.el.removeClass(o.elementLoadingClass);

			}
		}

		function setScrollTop(){
			$pageTop  = $navWrapper.length ? $navWrapper :  $('#content-container');
			$itemTop = $navWrapper;

			if($('body').hasClass('fixed-header')){
				scrollOffset = -90;
			}else{
				scrollOffset = -15;
			}

		}

		init();

		return this;

	};
}(jQuery));
