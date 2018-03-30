/*
 * jScrollPane - v2.0.0beta11 - 2011-07-04
 * http://jscrollpane.kelvinluck.com/
 *
 * Copyright (c) 2010 Kelvin Luck
 * Dual licensed under the MIT and GPL licenses.
 */
(function(b,a,c){b.fn.jScrollPane=function(e){function d(D,O){var az,Q=this,Y,ak,v,am,T,Z,y,q,aA,aF,av,i,I,h,j,aa,U,aq,X,t,A,ar,af,an,G,l,au,ay,x,aw,aI,f,L,aj=true,P=true,aH=false,k=false,ap=D.clone(false,false).empty(),ac=b.fn.mwheelIntent?"mwheelIntent.jsp":"mousewheel.jsp";aI=D.css("paddingTop")+" "+D.css("paddingRight")+" "+D.css("paddingBottom")+" "+D.css("paddingLeft");f=(parseInt(D.css("paddingLeft"),10)||0)+(parseInt(D.css("paddingRight"),10)||0);function at(aR){var aM,aO,aN,aK,aJ,aQ,aP=false,aL=false;az=aR;if(Y===c){aJ=D.scrollTop();aQ=D.scrollLeft();D.css({overflow:"hidden",padding:0});ak=D.innerWidth()+f;v=D.innerHeight();D.width(ak);Y=b('<div class="jspPane" />').css("padding",aI).append(D.children());am=b('<div class="jspContainer" />').css({width:ak+"px",height:v+"px"}).append(Y).appendTo(D)}else{D.css("width","");aP=az.stickToBottom&&K();aL=az.stickToRight&&B();aK=D.innerWidth()+f!=ak||D.outerHeight()!=v;if(aK){ak=D.innerWidth()+f;v=D.innerHeight();am.css({width:ak+"px",height:v+"px"})}if(!aK&&L==T&&Y.outerHeight()==Z){D.width(ak);return}L=T;Y.css("width","");D.width(ak);am.find(">.jspVerticalBar,>.jspHorizontalBar").remove().end()}Y.css("overflow","auto");if(aR.contentWidth){T=aR.contentWidth}else{T=Y[0].scrollWidth}Z=Y[0].scrollHeight;Y.css("overflow","");y=T/ak;q=Z/v;aA=q>1;aF=y>1;if(!(aF||aA)){D.removeClass("jspScrollable");Y.css({top:0,width:am.width()-f});n();E();R();w();ai()}else{D.addClass("jspScrollable");aM=az.maintainPosition&&(I||aa);if(aM){aO=aD();aN=aB()}aG();z();F();if(aM){N(aL?(T-ak):aO,false);M(aP?(Z-v):aN,false)}J();ag();ao();if(az.enableKeyboardNavigation){S()}if(az.clickOnTrack){p()}C();if(az.hijackInternalLinks){m()}}if(az.autoReinitialise&&!aw){aw=setInterval(function(){at(az)},az.autoReinitialiseDelay)}else{if(!az.autoReinitialise&&aw){clearInterval(aw)}}aJ&&D.scrollTop(0)&&M(aJ,false);aQ&&D.scrollLeft(0)&&N(aQ,false);D.trigger("jsp-initialised",[aF||aA])}function aG(){if(aA){am.append(b('<div class="jspVerticalBar" />').append(b('<div class="jspCap jspCapTop" />'),b('<div class="jspTrack" />').append(b('<div class="jspDrag" />').append(b('<div class="jspDragTop" />'),b('<div class="jspDragBottom" />'))),b('<div class="jspCap jspCapBottom" />')));U=am.find(">.jspVerticalBar");aq=U.find(">.jspTrack");av=aq.find(">.jspDrag");if(az.showArrows){ar=b('<a class="jspArrow jspArrowUp" />').bind("mousedown.jsp",aE(0,-1)).bind("click.jsp",aC);af=b('<a class="jspArrow jspArrowDown" />').bind("mousedown.jsp",aE(0,1)).bind("click.jsp",aC);if(az.arrowScrollOnHover){ar.bind("mouseover.jsp",aE(0,-1,ar));af.bind("mouseover.jsp",aE(0,1,af))}al(aq,az.verticalArrowPositions,ar,af)}t=v;am.find(">.jspVerticalBar>.jspCap:visible,>.jspVerticalBar>.jspArrow").each(function(){t-=b(this).outerHeight()});av.hover(function(){av.addClass("jspHover")},function(){av.removeClass("jspHover")}).bind("mousedown.jsp",function(aJ){b("html").bind("dragstart.jsp selectstart.jsp",aC);av.addClass("jspActive");var s=aJ.pageY-av.position().top;b("html").bind("mousemove.jsp",function(aK){V(aK.pageY-s,false)}).bind("mouseup.jsp mouseleave.jsp",ax);return false});o()}}function o(){aq.height(t+"px");I=0;X=az.verticalGutter+aq.outerWidth();Y.width(ak-X-f);try{if(U.position().left===0){Y.css("margin-left",X+"px")}}catch(s){}}function z(){if(aF){am.append(b('<div class="jspHorizontalBar" />').append(b('<div class="jspCap jspCapLeft" />'),b('<div class="jspTrack" />').append(b('<div class="jspDrag" />').append(b('<div class="jspDragLeft" />'),b('<div class="jspDragRight" />'))),b('<div class="jspCap jspCapRight" />')));an=am.find(">.jspHorizontalBar");G=an.find(">.jspTrack");h=G.find(">.jspDrag");if(az.showArrows){ay=b('<a class="jspArrow jspArrowLeft" />').bind("mousedown.jsp",aE(-1,0)).bind("click.jsp",aC);x=b('<a class="jspArrow jspArrowRight" />').bind("mousedown.jsp",aE(1,0)).bind("click.jsp",aC);
if(az.arrowScrollOnHover){ay.bind("mouseover.jsp",aE(-1,0,ay));x.bind("mouseover.jsp",aE(1,0,x))}al(G,az.horizontalArrowPositions,ay,x)}h.hover(function(){h.addClass("jspHover")},function(){h.removeClass("jspHover")}).bind("mousedown.jsp",function(aJ){b("html").bind("dragstart.jsp selectstart.jsp",aC);h.addClass("jspActive");var s=aJ.pageX-h.position().left;b("html").bind("mousemove.jsp",function(aK){W(aK.pageX-s,false)}).bind("mouseup.jsp mouseleave.jsp",ax);return false});l=am.innerWidth();ah()}}function ah(){am.find(">.jspHorizontalBar>.jspCap:visible,>.jspHorizontalBar>.jspArrow").each(function(){l-=b(this).outerWidth()});G.width(l+"px");aa=0}function F(){if(aF&&aA){var aJ=G.outerHeight(),s=aq.outerWidth();t-=aJ;b(an).find(">.jspCap:visible,>.jspArrow").each(function(){l+=b(this).outerWidth()});l-=s;v-=s;ak-=aJ;G.parent().append(b('<div class="jspCorner" />').css("width",aJ+"px"));o();ah()}if(aF){Y.width((am.outerWidth()-f)+"px")}Z=Y.outerHeight();q=Z/v;if(aF){au=Math.ceil(1/y*l);if(au>az.horizontalDragMaxWidth){au=az.horizontalDragMaxWidth}else{if(au<az.horizontalDragMinWidth){au=az.horizontalDragMinWidth}}h.width(au+"px");j=l-au;ae(aa)}if(aA){A=Math.ceil(1/q*t);if(A>az.verticalDragMaxHeight){A=az.verticalDragMaxHeight}else{if(A<az.verticalDragMinHeight){A=az.verticalDragMinHeight}}av.height(A+"px");i=t-A;ad(I)}}function al(aK,aM,aJ,s){var aO="before",aL="after",aN;if(aM=="os"){aM=/Mac/.test(navigator.platform)?"after":"split"}if(aM==aO){aL=aM}else{if(aM==aL){aO=aM;aN=aJ;aJ=s;s=aN}}aK[aO](aJ)[aL](s)}function aE(aJ,s,aK){return function(){H(aJ,s,this,aK);this.blur();return false}}function H(aM,aL,aP,aO){aP=b(aP).addClass("jspActive");var aN,aK,aJ=true,s=function(){if(aM!==0){Q.scrollByX(aM*az.arrowButtonSpeed)}if(aL!==0){Q.scrollByY(aL*az.arrowButtonSpeed)}aK=setTimeout(s,aJ?az.initialDelay:az.arrowRepeatFreq);aJ=false};s();aN=aO?"mouseout.jsp":"mouseup.jsp";aO=aO||b("html");aO.bind(aN,function(){aP.removeClass("jspActive");aK&&clearTimeout(aK);aK=null;aO.unbind(aN)})}function p(){w();if(aA){aq.bind("mousedown.jsp",function(aO){if(aO.originalTarget===c||aO.originalTarget==aO.currentTarget){var aM=b(this),aP=aM.offset(),aN=aO.pageY-aP.top-I,aK,aJ=true,s=function(){var aS=aM.offset(),aT=aO.pageY-aS.top-A/2,aQ=v*az.scrollPagePercent,aR=i*aQ/(Z-v);if(aN<0){if(I-aR>aT){Q.scrollByY(-aQ)}else{V(aT)}}else{if(aN>0){if(I+aR<aT){Q.scrollByY(aQ)}else{V(aT)}}else{aL();return}}aK=setTimeout(s,aJ?az.initialDelay:az.trackClickRepeatFreq);aJ=false},aL=function(){aK&&clearTimeout(aK);aK=null;b(document).unbind("mouseup.jsp",aL)};s();b(document).bind("mouseup.jsp",aL);return false}})}if(aF){G.bind("mousedown.jsp",function(aO){if(aO.originalTarget===c||aO.originalTarget==aO.currentTarget){var aM=b(this),aP=aM.offset(),aN=aO.pageX-aP.left-aa,aK,aJ=true,s=function(){var aS=aM.offset(),aT=aO.pageX-aS.left-au/2,aQ=ak*az.scrollPagePercent,aR=j*aQ/(T-ak);if(aN<0){if(aa-aR>aT){Q.scrollByX(-aQ)}else{W(aT)}}else{if(aN>0){if(aa+aR<aT){Q.scrollByX(aQ)}else{W(aT)}}else{aL();return}}aK=setTimeout(s,aJ?az.initialDelay:az.trackClickRepeatFreq);aJ=false},aL=function(){aK&&clearTimeout(aK);aK=null;b(document).unbind("mouseup.jsp",aL)};s();b(document).bind("mouseup.jsp",aL);return false}})}}function w(){if(G){G.unbind("mousedown.jsp")}if(aq){aq.unbind("mousedown.jsp")}}function ax(){b("html").unbind("dragstart.jsp selectstart.jsp mousemove.jsp mouseup.jsp mouseleave.jsp");if(av){av.removeClass("jspActive")}if(h){h.removeClass("jspActive")}}function V(s,aJ){if(!aA){return}if(s<0){s=0}else{if(s>i){s=i}}if(aJ===c){aJ=az.animateScroll}if(aJ){Q.animate(av,"top",s,ad)}else{av.css("top",s);ad(s)}}function ad(aJ){if(aJ===c){aJ=av.position().top}am.scrollTop(0);I=aJ;var aM=I===0,aK=I==i,aL=aJ/i,s=-aL*(Z-v);if(aj!=aM||aH!=aK){aj=aM;aH=aK;D.trigger("jsp-arrow-change",[aj,aH,P,k])}u(aM,aK);Y.css("top",s);D.trigger("jsp-scroll-y",[-s,aM,aK]).trigger("scroll")}function W(aJ,s){if(!aF){return}if(aJ<0){aJ=0}else{if(aJ>j){aJ=j}}if(s===c){s=az.animateScroll}if(s){Q.animate(h,"left",aJ,ae)
}else{h.css("left",aJ);ae(aJ)}}function ae(aJ){if(aJ===c){aJ=h.position().left}am.scrollTop(0);aa=aJ;var aM=aa===0,aL=aa==j,aK=aJ/j,s=-aK*(T-ak);if(P!=aM||k!=aL){P=aM;k=aL;D.trigger("jsp-arrow-change",[aj,aH,P,k])}r(aM,aL);Y.css("left",s);D.trigger("jsp-scroll-x",[-s,aM,aL]).trigger("scroll")}function u(aJ,s){if(az.showArrows){ar[aJ?"addClass":"removeClass"]("jspDisabled");af[s?"addClass":"removeClass"]("jspDisabled")}}function r(aJ,s){if(az.showArrows){ay[aJ?"addClass":"removeClass"]("jspDisabled");x[s?"addClass":"removeClass"]("jspDisabled")}}function M(s,aJ){var aK=s/(Z-v);V(aK*i,aJ)}function N(aJ,s){var aK=aJ/(T-ak);W(aK*j,s)}function ab(aW,aR,aK){var aO,aL,aM,s=0,aV=0,aJ,aQ,aP,aT,aS,aU;try{aO=b(aW)}catch(aN){return}aL=aO.outerHeight();aM=aO.outerWidth();am.scrollTop(0);am.scrollLeft(0);while(!aO.is(".jspPane")){s+=aO.position().top;aV+=aO.position().left;aO=aO.offsetParent();if(/^body|html$/i.test(aO[0].nodeName)){return}}aJ=aB();aP=aJ+v;if(s<aJ||aR){aS=s-az.verticalGutter}else{if(s+aL>aP){aS=s-v+aL+az.verticalGutter}}if(aS){M(aS,aK)}aQ=aD();aT=aQ+ak;if(aV<aQ||aR){aU=aV-az.horizontalGutter}else{if(aV+aM>aT){aU=aV-ak+aM+az.horizontalGutter}}if(aU){N(aU,aK)}}function aD(){return -Y.position().left}function aB(){return -Y.position().top}function K(){var s=Z-v;return(s>20)&&(s-aB()<10)}function B(){var s=T-ak;return(s>20)&&(s-aD()<10)}function ag(){am.unbind(ac).bind(ac,function(aM,aN,aL,aJ){var aK=aa,s=I;Q.scrollBy(aL*az.mouseWheelSpeed,-aJ*az.mouseWheelSpeed,false);return aK==aa&&s==I})}function n(){am.unbind(ac)}function aC(){return false}function J(){Y.find(":input,a").unbind("focus.jsp").bind("focus.jsp",function(s){ab(s.target,false)})}function E(){Y.find(":input,a").unbind("focus.jsp")}function S(){var s,aJ,aL=[];aF&&aL.push(an[0]);aA&&aL.push(U[0]);Y.focus(function(){D.focus()});D.attr("tabindex",0).unbind("keydown.jsp keypress.jsp").bind("keydown.jsp",function(aO){if(aO.target!==this&&!(aL.length&&b(aO.target).closest(aL).length)){return}var aN=aa,aM=I;switch(aO.keyCode){case 40:case 38:case 34:case 32:case 33:case 39:case 37:s=aO.keyCode;aK();break;case 35:M(Z-v);s=null;break;case 36:M(0);s=null;break}aJ=aO.keyCode==s&&aN!=aa||aM!=I;return !aJ}).bind("keypress.jsp",function(aM){if(aM.keyCode==s){aK()}return !aJ});if(az.hideFocus){D.css("outline","none");if("hideFocus" in am[0]){D.attr("hideFocus",true)}}else{D.css("outline","");if("hideFocus" in am[0]){D.attr("hideFocus",false)}}function aK(){var aN=aa,aM=I;switch(s){case 40:Q.scrollByY(az.keyboardSpeed,false);break;case 38:Q.scrollByY(-az.keyboardSpeed,false);break;case 34:case 32:Q.scrollByY(v*az.scrollPagePercent,false);break;case 33:Q.scrollByY(-v*az.scrollPagePercent,false);break;case 39:Q.scrollByX(az.keyboardSpeed,false);break;case 37:Q.scrollByX(-az.keyboardSpeed,false);break}aJ=aN!=aa||aM!=I;return aJ}}function R(){D.attr("tabindex","-1").removeAttr("tabindex").unbind("keydown.jsp keypress.jsp")}function C(){if(location.hash&&location.hash.length>1){var aL,aJ,aK=escape(location.hash);try{aL=b(aK)}catch(s){return}if(aL.length&&Y.find(aK)){if(am.scrollTop()===0){aJ=setInterval(function(){if(am.scrollTop()>0){ab(aK,true);b(document).scrollTop(am.position().top);clearInterval(aJ)}},50)}else{ab(aK,true);b(document).scrollTop(am.position().top)}}}}function ai(){b("a.jspHijack").unbind("click.jsp-hijack").removeClass("jspHijack")}function m(){ai();b("a[href^=#]").addClass("jspHijack").bind("click.jsp-hijack",function(){var s=this.href.split("#"),aJ;if(s.length>1){aJ=s[1];if(aJ.length>0&&Y.find("#"+aJ).length>0){ab("#"+aJ,true);return false}}})}function ao(){var aK,aJ,aM,aL,aN,s=false;am.unbind("touchstart.jsp touchmove.jsp touchend.jsp click.jsp-touchclick").bind("touchstart.jsp",function(aO){var aP=aO.originalEvent.touches[0];aK=aD();aJ=aB();aM=aP.pageX;aL=aP.pageY;aN=false;s=true}).bind("touchmove.jsp",function(aR){if(!s){return}var aQ=aR.originalEvent.touches[0],aP=aa,aO=I;Q.scrollTo(aK+aM-aQ.pageX,aJ+aL-aQ.pageY);aN=aN||Math.abs(aM-aQ.pageX)>5||Math.abs(aL-aQ.pageY)>5;
return aP==aa&&aO==I}).bind("touchend.jsp",function(aO){s=false}).bind("click.jsp-touchclick",function(aO){if(aN){aN=false;return false}})}function g(){var s=aB(),aJ=aD();D.removeClass("jspScrollable").unbind(".jsp");D.replaceWith(ap.append(Y.children()));ap.scrollTop(s);ap.scrollLeft(aJ)}b.extend(Q,{reinitialise:function(aJ){aJ=b.extend({},az,aJ);at(aJ)},scrollToElement:function(aK,aJ,s){ab(aK,aJ,s)},scrollTo:function(aK,s,aJ){N(aK,aJ);M(s,aJ)},scrollToX:function(aJ,s){N(aJ,s)},scrollToY:function(s,aJ){M(s,aJ)},scrollToPercentX:function(aJ,s){N(aJ*(T-ak),s)},scrollToPercentY:function(aJ,s){M(aJ*(Z-v),s)},scrollBy:function(aJ,s,aK){Q.scrollByX(aJ,aK);Q.scrollByY(s,aK)},scrollByX:function(s,aK){var aJ=aD()+Math[s<0?"floor":"ceil"](s),aL=aJ/(T-ak);W(aL*j,aK)},scrollByY:function(s,aK){var aJ=aB()+Math[s<0?"floor":"ceil"](s),aL=aJ/(Z-v);V(aL*i,aK)},positionDragX:function(s,aJ){W(s,aJ)},positionDragY:function(aJ,s){V(aJ,s)},animate:function(aJ,aM,s,aL){var aK={};aK[aM]=s;aJ.animate(aK,{duration:az.animateDuration,easing:az.animateEase,queue:false,step:aL})},getContentPositionX:function(){return aD()},getContentPositionY:function(){return aB()},getContentWidth:function(){return T},getContentHeight:function(){return Z},getPercentScrolledX:function(){return aD()/(T-ak)},getPercentScrolledY:function(){return aB()/(Z-v)},getIsScrollableH:function(){return aF},getIsScrollableV:function(){return aA},getContentPane:function(){return Y},scrollToBottom:function(s){V(i,s)},hijackInternalLinks:function(){m()},destroy:function(){g()}});at(O)}e=b.extend({},b.fn.jScrollPane.defaults,e);b.each(["mouseWheelSpeed","arrowButtonSpeed","trackClickSpeed","keyboardSpeed"],function(){e[this]=e[this]||e.speed});return this.each(function(){var f=b(this),g=f.data("jsp");if(g){g.reinitialise(e)}else{g=new d(f,e);f.data("jsp",g)}})};b.fn.jScrollPane.defaults={showArrows:false,maintainPosition:true,stickToBottom:false,stickToRight:false,clickOnTrack:true,autoReinitialise:false,autoReinitialiseDelay:500,verticalDragMinHeight:0,verticalDragMaxHeight:99999,horizontalDragMinWidth:0,horizontalDragMaxWidth:99999,contentWidth:c,animateScroll:false,animateDuration:300,animateEase:"linear",hijackInternalLinks:false,verticalGutter:4,horizontalGutter:4,mouseWheelSpeed:0,arrowButtonSpeed:0,arrowRepeatFreq:50,arrowScrollOnHover:false,trackClickSpeed:0,trackClickRepeatFreq:70,verticalArrowPositions:"split",horizontalArrowPositions:"split",enableKeyboardNavigation:true,hideFocus:false,keyboardSpeed:0,initialDelay:300,speed:30,scrollPagePercent:0.8}})(jQuery,this);




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
		$root             = $(this),
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
					//disable the scrolling plugin
					jscrollApi.destroy();
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
			excludeCats          : [],
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
			openedClass          : 'filter-opened'
		},
		o                    = $.extend(defaults, options),
		$root                = $(this),
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
				}).appendTo($navWrapper);

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
					exclude_cats: o.excludeCats,
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

						$filterBtn.on('click', doOnFilterClick);

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
			if(cat != currentCat && !inAnimation) {
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

					$items.eq(index).css(initArgs).animate(endArgs);

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
			$pageTop  = $navWrapper.length ? $navWrapper :  $('.page-title');
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
