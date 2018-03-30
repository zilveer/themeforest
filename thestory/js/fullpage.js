var PEXETO = PEXETO || {};

(function($){

"use strict";


	/**
	 * Fullscreen slider functionality - uses the fullpage.js library
	 * to display the slideshow and change the slides.
	 * @param {string} selector the parent element selector
	 * @param {object} options  the options for the slider (check the defaults
	 * below to see the default options available)
	 */
	PEXETO.Fullpage = function(selector, options){
		// return;
		var defaults = {
			animateElements : true,
			animateElSel : '.anim-el',
			paddingTop : 75,
			paddingBottom : 35,
			fixedElements : '#header, #wpadminbar, .fullpage-data',
			eventNs : '.pexetofull',
			autoplay : false,
			horizontalAutoplay : false,
			autoplayInterval : 5000,
			animationAliases : {
				'section-textimg' : 'fadeIn',
				'section-imgtext' : 'fadeIn',
				'section-slider' : 'slideInRightFast',
				'layout-cc' : 'slideInUp',
				'layout-ct' : 'slideInUp',
				'layout-cb' : 'slideInUp',
				'layout-lc' : 'slideInLeft',
				'layout-lt' : 'slideInLeft',
				'layout-lb' : 'slideInLeft',
				'layout-rc' : 'slideInRight',
				'layout-rt' : 'slideInRight',
				'layout-rb' : 'slideInRight'
			}
		};
		this.sel = selector;
		this.o = $.extend(defaults, options);
	};

	PEXETO.Fullpage.prototype = {

		init : function(){
			var $sections = $(this.sel),
				self = this;

			this.$sections = $sections;
			this.$wrapper = $('.fullpage-wrapper');
			this.secNum = $sections.length;

			if(this.secNum){
				this.$doc = $(document);
				this.$win = $(window);
				this.slides = [];
				this.mobile = PEXETO.utils.checkIfMobile();
				this.animationCaller = null;

				if(this.mobile || (this.secNum<=1 && this.getSectionType(0)!=='slider')){
					this.o.autoplay = false;
				}
				if(!this.o.autoplay){
					this.o.horizontalAutoplay = false;
				}

				this.current = this.getCurrentSlideIndex();

				this.lastIndex = this.secNum - 1;
				this.scrollers = [];
				this.$sections.each(function(i){
					var sectionType = self.getSectionTypeByElement($(this));
					if(sectionType=='textimg'){
						self.scrollers[i]={};
					}else if(self.mobile && sectionType=='video'){
						self.setMobileVideoFallbackBg($(this));
					}
				});

				this.animatedElements = [];
				this.inAnimation = false;

				this.$nav = $('.fullpage-nav');
				this.$dataWrapper = $('.fullpage-data');

				this.buildNavigation();
				this.loadSlider();
				this.bindEventHandlers();
				
				this.initFullpagejs();

				if(this.mobile){
					var userAgent = navigator.userAgent.toLowerCase();
					$('html').css({overflow:'visible'});

					if(userAgent.indexOf('windows phone')!==-1 ){
						$('#main-container').unwrap();
					}
				}

				this.setContentScroll();

				if(this.mobile){
					this.$sections.each(function(i){
						$(this).attr('id', (i+1));
					});
				}

			}

		},

		initFullpagejs : function(){
			$.fn.fullpage({
				navigation : false,
				css3:true,
				resize:false,
				fixedElements:this.o.fixedElements,
				verticalCentered: false,
				paddingTop: this.o.paddingTop+'px',
				paddingBottom: this.o.paddingBottom+'px',
				anchors : this.generateAnchors(),
				autoScrolling: true,
				scrollOverflow:false,
				keyboardScrolling:false,
				afterLoad: $.proxy(this.doOnAfterLoad, this), 
				afterSlideLoad : $.proxy(this.doOnSlideLoad, this),
				onLeave : $.proxy(this.doOnLeave, this),
				animateAnchor : false
			});

			if(this.mobile){
				this.setSectionsMinHeight(true);
			}
			$.fn.fullpage.setAllowScrolling(false);
		},

		loadSlider : function(){
			var self = this;

			this.loader = new PEXETO.Loader(this.$sections, {bgElements : '.slide'});

			this.loader.onLoaded(this.current).done(function(){
				self.bindNavigationEvents();
				self.$wrapper.removeClass('loading');
				if(self.current===0){
					self.setupSlide(0);
					if(self.o.animateElements){
						self.animateElements(0);
					}
				}

				if(self.o.autoplay){
					self.addAutoplayControls();
					self.startAnimation();
				}
			});

		},


		setSectionsMinHeight : function(smallScreen){
			var winHeight;
			if(smallScreen){
				winHeight = this.$win.height()+70;

				this.$sections.css({minHeight:winHeight});
			}else{
				this.$sections.css({minHeight:''});
			}
		},


		bindEventHandlers : function(){
			var self = this,
				resizeId;

			this.$win.on('resize', function() {
				clearTimeout(resizeId);
				resizeId = setTimeout($.proxy(self.doOnResize, self), 500);
			}).on('orientationchange', $.proxy(self.doOnResize, self));

			this.$doc.on('videoloaded', 'video', function(){
				self.setVideoSize($(this));
			});
		},

		bindNavigationEvents : function(){
			var self = this;
			
			if(!this.mobile){
				this.$doc.on('mousewheel'+self.o.eventNs, $.proxy(this.doOnMouseWheel, this))
				.on('keydown'+self.o.eventNs, $.proxy(this.doOnKeydown, this));
				this.$nav.on('click'+self.o.eventNs, 'li', $.proxy(this.doOnNavClick, this));

				this.$win.on('load'+self.o.eventNs, function(){
					self.setContentScroll();
				});

				if(this.o.autoplay){
					this.$wrapper.on('click', '.controlArrow', function(){
						//pause the autoplay when navigating trough the horizontal slider
						self.pauseAnimation(true);
					});
				}
				

				this.eventsBound = true;
			}
		},

		doOnResize : function(){
			var $section, $video;

			if(this.mobile){
				this.setSectionsMinHeight(true);
			}else{
				this.setContentScroll();
				$section = this.$sections.eq(this.current);
				 if(this.getSectionTypeByElement($section)=='video'){
					$video = $section.find('video');
					this.setVideoSize($video);
				}
			}
		},

		doOnMouseWheel : function(e){
			if($(e.target).parents('.jspScrollable').length){
				//do not change the slide when the inner content has been scrolled
				return;
			}

			if(e.deltaY < 0){
				//scroll down
				this.doOnNextTrigger();
			}else if(e.deltaY > 0){
				//scroll up
				this.doOnPrevTrigger();
			}
		},

		doOnKeydown : function(e){
			if(e.keyCode==38){
				this.doOnPrevTrigger();
			}else if(e.keyCode==40){
				this.doOnNextTrigger();
			}
		},

		doOnNextTrigger : function(){
			if(this.hasNextSlide()){
				this.moveTo(this.current+1);
			}
		},

		doOnPrevTrigger : function(){
			if(this.hasPrevSlide()){
				this.moveTo(this.current-1);
			}
		},


		doOnNavClick : function(e){
			var $li = $(e.target),
				index = parseInt($li.data('link'), 10);
			if(!this.inAnimation && index && index-1 !== this.current){
				this.moveTo(index-1);
			}
		},

		moveTo : function(index){
			var self = this,
				showSlide = function(){
					var slideIndex = self.slides[index] || 0;
					if(self.o.autoplay && self.o.horizontalAutoplay && !self.manualPause){
						//set the index to 0 when autoplay is enabled so that when
						//it opens the first slide when the section is loaded
						self.animationCaller = 'section';
						slideIndex = 0;
					}

					self.current = index;
					$.fn.fullpage.moveTo(index+1, slideIndex);
					
					if(self.o.animateElements){
						self.animateElements(index);
					}

					self.setContentScroll(index);
					self.lastScrollIndex = index;
					
				};

			if(self.o.autoplay){
				self.pauseAnimation(false);
			}
			if(!this.inAnimation){
				this.inAnimation = true;
				if(this.loader.isLoaded(index)){
					showSlide();
				}else{
					this.showLoading();
					this.loader.onLoaded(index).done(showSlide);
				}
				
			}
		},

		setContentScroll : function(){
			if(this.mobile){
				return;
			}
			var maxHeight,
				index = this.current,
				self = this,
				scroller = this.scrollers[index],
				$content,
				defaultHeight,
				winHeight,
				getContentElem = function(){
					return self.$sections.eq(index).find('.section-wrapper');
				};

			if(typeof(scroller)==='undefined'){
				//this section has no scrolling elements
				return;
			}

			winHeight = this.$win.height();

			$content = getContentElem();
			defaultHeight = $content.height();

			maxHeight = winHeight - this.o.paddingTop - this.o.paddingBottom;

			if(scroller && scroller.jspApi){
				//destroy the scroller
				scroller.jspApi.destroy();
				this.scrollers[index].jspApi = null;
				getContentElem().css({'maxHeight': 'none'});
				$content = getContentElem();
				defaultHeight = $content.height();
			}


			if(maxHeight>defaultHeight){
				return;
			}

			$content.css({maxHeight:maxHeight});

			//initialize the scroller
			this.scrollers[index] = {
				jspApi: $content.jScrollPane().data('jsp')
			};
		},

		startAnimation : function(){
			if(!this.autoplayControls){
				//autoplay controls haven't been added
				return;
			}

			this.$pause.removeClass('fp-no-click');
			if(this.manualPause){
				return;
			}
			this.inAutoplay = true;
			this.$autoplayControl.addClass('fp-playing');
			this.$pause.addClass('fp-playing');
			this.timer = window.setInterval($.proxy(this.doOnNextAutoplay, this), this.o.autoplayInterval);
		},

		pauseAnimation : function(changeIcon){
			window.clearInterval(this.timer);
			this.inAutoplay = false;
			this.$autoplayControl.removeClass('fp-playing');
			if(changeIcon){
				this.$pause.removeClass('fp-playing');
			}else{
				this.$pause.addClass('fp-no-click');
			}
		},

		togglePause : function(){
			if(this.inAutoplay){
				this.pauseAnimation(true);
				this.manualPause = true;
			}else{
				this.manualPause = false;
				this.startAnimation();
			}
		},


		doOnNextAutoplay : function(){
			var slideType = this.getSectionType(this.current),
				innerSlideIndex;

			if(this.o.horizontalAutoplay && slideType=='slider' && (innerSlideIndex = this.getNextInnerSlideIndex())!==-1){
				this.pauseAnimation(false);
				this.animationCaller = 'slide';
				$.fn.fullpage.moveTo(this.current+1, innerSlideIndex);

				
			}else{
				if(this.hasNextSlide()){
					this.moveTo(this.current+1);
				}else{
					this.moveTo(0);
				}
			}
			
		},

		getSectionType : function(index){
			var $section = this.$sections.eq(index);
			return this.getSectionTypeByElement($section);
		},

		getSectionTypeByElement : function($section){
			var types = ['video', 'text', 'textimg', 'slider'];
			for(var i = 0, len = types.length; i<len; i++){
				if($section.hasClass('section-'+types[i])){
					return types[i];
				}
			}
		},


		buildNavigation : function(){
			var lis = '';
			for(var i = 1; i<=this.secNum; i++){
				lis +='<li data-link="'+i+'"></li>';
			}

			this.$nav.append(lis);
			this.$navLis = this.$nav.find('li');
			this.setSelectedNav();
		},

		addAutoplayControls : function(){
			this.$autoplayControl = $('<div />', {'class':'fullpage-autoplay',
				html:' <span class="fp-side fp-sp-left"><span class="fp-fill"></span></span><span class="fp-side fp-sp-right"><span class="fp-fill"></span></span>'})
				// html:'<span class="side sp_left"><span class="fill"></span></span><span class="side sp_right"><span class="fill"></span></span>'})
				.insertAfter(this.$nav);

			this.$pause = $('<div />', {'class':'fullpage-pause'})
				.appendTo(this.$autoplayControl)
				.on('click', $.proxy(this.togglePause, this));

			this.autoplayControls = true;

			if(this.o.autoplayInterval!==5000){
				$('.fp-sp-right .fp-fill, .fp-sp-left .fp-fill').css({animationDuration:this.o.autoplayInterval/1000+'s'});
			}
		},

		setSelectedNav : function(){
			this.$navLis.filter('.current')
					.removeClass('current');
				this.$navLis.eq(this.current).addClass('current');
		},

		generateAnchors : function(){
			var anchors = [], i;

			for(i=1; i<=this.secNum; i++){
				anchors.push(i);
			}

			return anchors;
		},

		doOnAfterLoad : function(link, index){
			var self = this,
				secIndex = index-1, //set the indexing start from 0
				slideType = this.getSectionType(secIndex),
				autoplaySlide = this.o.horizontalAutoplay && slideType=='slider';

			this.hideLoading();
			self.setupSlide(secIndex);
			if(this.current!==secIndex){
				this.current = secIndex;
			}

			if(this.lastScrollIndex!==secIndex){
				self.setContentScroll(secIndex);
			}
			
			this.setSelectedNav();
			
			if(this.o.autoplay && !this.inAutoplay && !autoplaySlide && slideType!=='video'){
				this.startAnimation();
			}

			setTimeout(function(){
				//delay the animation set to prevent accidental overscroll
				self.inAnimation = false;
			}, 500);
			
		},

		setupSlide : function(index){
			var $section = this.$sections.eq(index),
				video,
				$video,
				sectionType = this.getSectionTypeByElement($section),
				self = this;

			if(sectionType=='slider'){
				this.animateCaption(index, 0);
			}else if(sectionType=='video'){
				if(PEXETO.supportsVideo()){
					$video = $section.find('video');
					video = $video.get(0);

					this.setVideoSize($video);
					this.showLoading();
					
					video.addEventListener("playing", function(){
						self.hideLoading();
						if(self.o.autoplay && !self.inAutoplay){
							self.startAnimation();
						}
					});

					video.addEventListener("waiting", function(){
						self.showLoading();
					});

					$video.get(0).play();
				}
			}

		},

		doOnLeave : function(index, nextIndex, direction){

			var self = this,
				secIndex = index-1,
				$section = this.$sections.eq(secIndex),
				$video = $section.find('video');

			if($video.length && PEXETO.supportsVideo()){
				$video.get(0).pause();
			}


		},

		setVideoSize : function($video){
			var winWidth = this.$win.width(),
				winHeight = this.$win.height(),
				videoWidth = $video.get(0).videoWidth,
				videoHeight = $video.get(0).videoHeight,
				videoRatio = videoWidth/videoHeight,
				displayWidth, displayHeight,
				marginLeft = 0,
				marginTop = 0;

			displayHeight = winWidth*videoHeight/videoWidth;
			if(displayHeight>=winHeight){
				displayWidth = winWidth;
				marginTop = - (displayHeight-winHeight)/2;
			}else{
				displayHeight = winHeight;
				displayWidth = winHeight*videoWidth/videoHeight;
				marginLeft = - (displayWidth-winWidth)/2;
			}

			$video.css({width:displayWidth, height: displayHeight,
				marginTop:marginTop, marginLeft:marginLeft, opacity:1});
		},

		animateElements : function(index){
			var $section,
				sectionClass;

			if(Array.prototype.indexOf && this.animatedElements.indexOf(index)===-1){
				$section = this.$sections.eq(index);
				sectionClass = $section.get(0).className;
				
				$section.find(this.o.animateElSel).addClass('element-animated '+this.getAnimationClass(sectionClass));

				this.animatedElements.push(index);
			}
		},

		doOnSlideLoad : function(anchorLink, index, slideAnchor, slideIndex){
			var secIndex = index-1, //make the indexing start from 0
				lastCallerSection = slideIndex!==0 && this.animationCaller=='section'; //this slide was last loaded by a section

			this.slides[secIndex] = slideIndex;

			this.animateCaption(secIndex, slideIndex);
			if(this.o.autoplay && this.o.horizontalAutoplay && !this.inAutoplay && !lastCallerSection){
				this.startAnimation();
			}
			
		},

		animateCaption : function(secIndex, slideIndex){
			this.$sections.eq(secIndex)
				.find('.slide:eq('+slideIndex+')')
				.find('.slide-caption')
				.addClass('element-animated '+this.o.animationAliases['section-slider']);
		},

		setMobileVideoFallbackBg : function($section){
			var $videoWrap = $section.find('.fullpage-video-wrap:first');
			if($videoWrap.length && $videoWrap.data('mobilebg')){
				$section.css({backgroundImage:'url('+$videoWrap.data('mobilebg')+')'});
			}
		},


		showLoading : function(){
			this.loading = true;
			this.$dataWrapper.addClass('loading');
		},

		hideLoading : function(){
			if(this.loading){
				this.$dataWrapper.removeClass('loading');
				this.loading = false;
			}
		},

		getCurrentSlideIndex : function(){
			this.sanitizeHash();
			var hash = window.location.hash;

			if(hash){
				hash = parseInt(hash.replace('#', ''), 10);
				if(hash){
					hash--;
				}
			}

			return hash || 0;
		},

		sanitizeHash : function(){
			var hash = window.location.hash;

			if(hash){
				hash = hash.replace('#', '');
				if(hash.match(/^[0-9\/]+$/) === null){
					window.location.hash = '';
				}
			}
		},

		getCurrentInnerSlideIndex : function(){
			var hash = window.location.hash, parts, len, index;

			if(hash){
				parts = hash.split('/');
				len = parts.length;

				if(len){
					index = parseInt(parts[len-1], 10);
				}
			}

			return index || 0;
		},

		getAnimationClass : function(sectionClass){
			var animation = 'fadeIn',
				reg = /section\-textimg|section-imgtext|section-slider|layout-[clr][ctb]/gi,
				match = sectionClass.match(reg);

			if(match && match.length && this.o.animationAliases[match[0]]){
				return this.o.animationAliases[match[0]];
			}

			return animation;
		},

		hasNextSlide : function(){
			return this.current<this.lastIndex && !this.inAnimation;
		},

		hasPrevSlide : function(){
			return this.current !==0 && !this.inAnimation;
		},

		getNextInnerSlideIndex : function(){
			var $section = this.$sections.eq(this.current),
				currentIndex, num;

			if(this.getSectionTypeByElement($section)=='slider'){
				currentIndex = this.getCurrentInnerSlideIndex();
				if($.isNumeric(currentIndex)){
					num = $section.find('.slide').length;
					if(currentIndex < num-1){
						return ++currentIndex;
					}
				}
			}
			return -1;
		}

	};


	PEXETO.Loader = function($elements, options){
		var defaults = {
			loadImg : true,
			loadBg : true,
			onAllLoaded : null
		};

		this.o = $.extend({}, defaults, options);
		this.$elements = $elements;

		this.init();
	};

	PEXETO.Loader.prototype = {

		init : function(){
			var self = this;

			this.num = this.$elements.length;
			
			this.elements = [];

			this.$elements.each(function(i){
				self.elements.push({
					$el : $(this),
					loaded : false,
					bgElements : '',
					callbacks : []
				});
			});

		},

		isLoaded : function(index){
			return this.elements[index].loaded;
		},

		loadAll : function(){
			var i;

			if(!this.loadingAll){
				this.loadingAll = true;

				for(i=0; i<this.num; i++){
					this._loadElement(i);
				}
			}
		},

		_getElementSrc : function($element){
			var srcs = [],
				self = this,
				bgImage,
				$bgElements;

			if(this.o.loadImg){
				$element.find('img').each(function(){
					srcs.push($(this).attr('src'));
				});
			}
			
			if(this.o.loadBg){
				bgImage = this._getBgImageSrc($element);

				if(bgImage){
					srcs.push(bgImage);
				}

				if(this.o.bgElements){

					//get the background images of the elements with the specified
					//selectors
					$bgElements = $element.find(this.o.bgElements);
					if($bgElements.length){
						$bgElements.each(function(){
							var bgImage = self._getBgImageSrc($(this));
							if(bgImage){
								srcs.push(bgImage);
							}
						});
					}

				}
			}
			
			return srcs;

		},

		_getBgImageSrc : function($element){
			var bgImage = $element.css('background-image');
			if(bgImage && bgImage!='none'){
				return bgImage.replace(/"/g,"").replace(/url\(|\)$/ig, "");
			}
			return null;
		},

		_loadElement : function(index){
			var srcs = this._getElementSrc(this.elements[index].$el),
				imgNum = srcs.length,
				self = this,
				imagesToLoad = [],
				videosToLoad = this.elements[index].$el.find('video'),
				videoNumToLoad = videosToLoad.length,
				videoNumLoaded = 0,
				imagesLoaded = false,
				videosLoaded = false,
				i, img, 
				el = self.elements[index],
				resolveDeferred = function(){
					el.loaded = true;
					if(el.pendingDeferred){
						el.pendingDeferred.resolve();
					}
				};

			if(!PEXETO.supportsVideo()){
				videoNumToLoad = 0;
			}

			for(i=0; i<imgNum; i++){
				img = new Image();
				img.src = srcs[i];
				imagesToLoad.push(img);
			}

			$(imagesToLoad).pexetoOnImgLoaded({callback:function(){
				// setTimeout(function(){
					imagesLoaded = true;
					if(!videoNumToLoad || (videoNumToLoad && videosLoaded)){
						resolveDeferred();
					}

				// }, 2000);
			
			}});


			var doOnVideoLoaded = function($video){
				if(++videoNumLoaded >= videoNumLoaded){
					videosLoaded = true;
					if(!imgNum || (imgNum && imagesLoaded)){
						resolveDeferred();
					}
					$video.trigger('videoloaded');
				}
			};

			if(videoNumToLoad){
				videosToLoad.each(function(){
					var $video = $(this),
						video = this;

					if(video.readyState==4){
						doOnVideoLoaded($video);
						return;
					}else{
						if(!PEXETO.getBrowser().chrome){
							//reload the video
							video.load();
						}
						video.addEventListener("loadedmetadata", function(){
								doOnVideoLoaded($video);
						});
						video.addEventListener("canplay", function(){
								doOnVideoLoaded($video);
						});
					}

					setTimeout(function(){
						if(typeof video['networkState'] !== 'undefined' && video['networkState']===3){
							//the video cannot be loaded
								doOnVideoLoaded($video);
						}
					}, 1000);
					

				});
			}

		},

		onLoaded : function(index){
			var deferred = new $.Deferred();

			if(this.elements[index].loaded){
				deferred.resolve();
			}else{
				this.elements[index].pendingDeferred = deferred;
				if(!this.loadingAll){
					this._loadElement(index);
				}
			}

			return deferred.promise();
		}
	};


})(jQuery);


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




/**
 * fullPage 1.8.4
 * https://github.com/alvarotrigo/fullPage.js
 * MIT licensed
 *
 * Copyright (C) 2013 alvarotrigo.com - A project by Alvaro Trigo
 */
(function(b){b.fn.fullpage=function(c){function X(a){if(c.autoScrolling){a.preventDefault();var f=a.originalEvent;a=b(".section.active");if(!r&&!s)if(f=K(f),v=f.y,y=f.x,a.find(".slides").length&&Math.abs(z-y)>Math.abs(w-v))Math.abs(z-y)>b(window).width()/100*c.touchSensitivity&&(z>y?a.find(".controlArrow.next:visible").trigger("click"):a.find(".controlArrow.prev:visible").trigger("click"));else if(a=a.find(".slides").length?a.find(".slide.active").find(".scrollable"):a.find(".scrollable"),Math.abs(w-
v)>b(window).height()/100*c.touchSensitivity)if(w>v)if(0<a.length)if(A("bottom",a))b.fn.fullpage.moveSectionDown();else return!0;else b.fn.fullpage.moveSectionDown();else if(v>w)if(0<a.length)if(A("top",a))b.fn.fullpage.moveSectionUp();else return!0;else b.fn.fullpage.moveSectionUp()}}function Y(a){c.autoScrolling&&(a=K(a.originalEvent),w=a.y,z=a.x)}function p(a){if(c.autoScrolling){a=window.event||a;a=Math.max(-1,Math.min(1,a.wheelDelta||-a.deltaY||-a.detail));var f;f=b(".section.active");if(!r)if(f=
f.find(".slides").length?f.find(".slide.active").find(".scrollable"):f.find(".scrollable"),0>a)if(0<f.length)if(A("bottom",f))b.fn.fullpage.moveSectionDown();else return!0;else b.fn.fullpage.moveSectionDown();else if(0<f.length)if(A("top",f))b.fn.fullpage.moveSectionUp();else return!0;else b.fn.fullpage.moveSectionUp();return!1}}function h(a,f,d){var e={},g=a.position();if("undefined"!==typeof g){var g=g.top,l=F(a),q=a.data("anchor"),G=a.index(".section"),k=a.find(".slide.active"),m=b(".section.active"),
C=B;if(k.length)var s=k.data("anchor"),p=k.index();if(c.autoScrolling&&c.continuousVertical&&"undefined"!==typeof d&&(!d&&"up"==l||d&&"down"==l)){d?b(".section.active").before(m.nextAll(".section")):b(".section.active").after(m.prevAll(".section").get().reverse());x(b(".section.active").position().top);var h=m,g=a.position(),g=g.top,l=F(a)}m=m.index(".section")+1;a.addClass("active").siblings().removeClass("active");r=!0;"undefined"!==typeof q&&L(p,s,q);c.autoScrolling?(e.top=-g,a="#superContainer"):
(e.scrollTop=g,a="html, body");var n=function(){h&&h.length&&(d?b(".section:first").before(h):b(".section:last").after(h),x(b(".section.active").position().top))};c.css3&&c.autoScrolling?(b.isFunction(c.onLeave)&&!C&&c.onLeave.call(this,m,l),M("translate3d(0px, -"+g+"px, 0px)",!0),setTimeout(function(){n();b.isFunction(c.afterLoad)&&!C&&c.afterLoad.call(this,q,G+1);setTimeout(function(){r=!1;b.isFunction(f)&&f.call(this)},N)},c.scrollingSpeed)):(b.isFunction(c.onLeave)&&!C&&c.onLeave.call(this,m,
l),b(a).animate(e,c.scrollingSpeed,c.easing,function(){n();b.isFunction(c.afterLoad)&&!C&&c.afterLoad.call(this,q,G+1);setTimeout(function(){r=!1;b.isFunction(f)&&f.call(this)},N)}));t=q;c.autoScrolling&&(O(q),P(q,G))}}function n(a,f){var d=f.position(),e=a.find(".slidesContainer").parent(),g=f.index(),l=a.closest(".section"),q=l.index(".section"),h=l.data("anchor"),k=l.find(".fullPage-slidesNav"),m=f.data("anchor"),n=B;if(c.onSlideLeave){var p=l.find(".slide.active").index(),r;r=p==g?"none":p>g?
"left":"right";n||b.isFunction(c.onSlideLeave)&&c.onSlideLeave.call(this,h,q+1,p,r)}f.addClass("active").siblings().removeClass("active");"undefined"===typeof m&&(m=g);l.hasClass("active")&&(c.loopHorizontal||(l.find(".controlArrow.prev").toggle(0!=g),l.find(".controlArrow.next").toggle(!f.is(":last-child"))),L(g,m,h));c.css3?(d="translate3d(-"+d.left+"px, 0px, 0px)",a.find(".slidesContainer").toggleClass("easing",0<c.scrollingSpeed).css(Q(d)),setTimeout(function(){n||b.isFunction(c.afterSlideLoad)&&
c.afterSlideLoad.call(this,h,q+1,m,g);s=!1},c.scrollingSpeed,c.easing)):e.animate({scrollLeft:d.left},c.scrollingSpeed,c.easing,function(){n||b.isFunction(c.afterSlideLoad)&&c.afterSlideLoad.call(this,h,q+1,m,g);s=!1});k.find(".active").removeClass("active");k.find("li").eq(g).find("a").addClass("active")}function R(){B=!0;var a=b(window).width();k=b(window).height();c.resize&&Z(k,a);b(".section").each(function(){parseInt(b(this).css("padding-bottom"));parseInt(b(this).css("padding-top"));c.verticalCentered&&
b(this).find(".tableCell").css("height",S(b(this))+"px");b(this).css("height",k+"px");if(c.scrollOverflow){var a=b(this).find(".slide");a.length?a.each(function(){D(b(this))}):D(b(this))}a=b(this).find(".slides");a.length&&n(a,a.find(".slide.active"))});b(".section.active").position();a=b(".section.active");a.index(".section")&&h(a);B=!1}function Z(a,c){var d=825,e=a;825>a||900>c?(900>c&&(e=c,d=900),d=(100*e/d).toFixed(2),b("body").css("font-size",d+"%")):b("body").css("font-size","100%")}function P(a,
f){c.navigation&&(b("#fullPage-nav").find(".active").removeClass("active"),a?b("#fullPage-nav").find('a[href="#'+a+'"]').addClass("active"):b("#fullPage-nav").find("li").eq(f).find("a").addClass("active"))}function O(a){c.menu&&(b(c.menu).find(".active").removeClass("active"),b(c.menu).find('[data-menuanchor="'+a+'"]').addClass("active"))}function A(a,b){if("top"===a)return!b.scrollTop();if("bottom"===a)return b.scrollTop()+b.innerHeight()>=b[0].scrollHeight}function F(a){var c=b(".section.active").index(".section");
a=a.index(".section");return c>a?"up":"down"}function D(a){a.css("overflow","hidden");var b=a.closest(".section"),d=a.find(".scrollable");if(d.length)var e=a.find(".scrollable").get(0).scrollHeight;else e=a.get(0).scrollHeight,c.verticalCentered&&(e=a.find(".tableCell").get(0).scrollHeight);b=k-parseInt(b.css("padding-bottom"))-parseInt(b.css("padding-top"));e>b?d.length?d.css("height",b+"px").parent().css("height",b+"px"):(c.verticalCentered?a.find(".tableCell").wrapInner('<div class="scrollable" />'):
a.wrapInner('<div class="scrollable" />'),a.find(".scrollable").slimScroll({height:b+"px",size:"10px",alwaysVisible:!0})):(a.find(".scrollable").children().first().unwrap().unwrap(),a.find(".slimScrollBar").remove(),a.find(".slimScrollRail").remove());a.css("overflow","")}function T(a){a.addClass("table").wrapInner('<div class="tableCell" style="height:'+S(a)+'px;" />')}function S(a){var b=k;if(c.paddingTop||c.paddingBottom)b=a,b.hasClass("section")||(b=a.closest(".section")),a=parseInt(b.css("padding-top"))+
parseInt(b.css("padding-bottom")),b=k-a;return b}function M(a,c){b("#superContainer").toggleClass("easing",c);b("#superContainer").css(Q(a))}function H(a,c){"undefined"===typeof c&&(c=0);var d=isNaN(a)?b('[data-anchor="'+a+'"]'):b(".section").eq(a-1);a===t||d.hasClass("active")?U(d,c):h(d,function(){U(d,c)})}function U(a,b){if("undefined"!=typeof b){var c=a.find(".slides"),e=c.find('[data-anchor="'+b+'"]');e.length||(e=c.find(".slide").eq(b));e.length&&n(c,e)}}function $(a,b){a.append('<div class="fullPage-slidesNav"><ul></ul></div>');
var d=a.find(".fullPage-slidesNav");d.addClass(c.slidesNavPosition);for(var e=0;e<b;e++)d.find("ul").append('<li><a href="#"><span></span></a></li>');d.css("margin-left","-"+d.width()/2+"px");d.find("li").first().find("a").addClass("active")}function L(a,b,d){var e="";c.anchors.length&&(a?("undefined"!==typeof d&&(e=d),"undefined"===typeof b&&(b=a),I=b,location.hash=e+"/"+b):("undefined"!==typeof a&&(I=b),location.hash=d))}function aa(){var a=document.createElement("p"),b,c={webkitTransform:"-webkit-transform",
OTransform:"-o-transform",msTransform:"-ms-transform",MozTransform:"-moz-transform",transform:"transform"};document.body.insertBefore(a,null);for(var e in c)void 0!==a.style[e]&&(a.style[e]="translate3d(1px,1px,1px)",b=window.getComputedStyle(a).getPropertyValue(c[e]));document.body.removeChild(a);return void 0!==b&&0<b.length&&"none"!==b}function K(a){var b=[];window.navigator.msPointerEnabled?(b.y=a.pageY,b.x=a.pageX):(b.y=a.touches[0].pageY,b.x=a.touches[0].pageX);return b}function x(a){c.css3?
M("translate3d(0px, -"+a+"px, 0px)",!1):b("#superContainer").css("top",-a)}function Q(a){return{"-webkit-transform":a,"-moz-transform":a,"-ms-transform":a,transform:a}}c=b.extend({verticalCentered:!0,resize:!0,slidesColor:[],anchors:[],scrollingSpeed:700,easing:"easeInQuart",menu:!1,navigation:!1,navigationPosition:"right",navigationColor:"#000",navigationTooltips:[],slidesNavigation:!1,slidesNavPosition:"bottom",controlArrowColor:"#fff",loopBottom:!1,loopTop:!1,loopHorizontal:!0,autoScrolling:!0,
scrollOverflow:!1,css3:!1,paddingTop:0,paddingBottom:0,fixedElements:null,normalScrollElements:null,keyboardScrolling:!0,touchSensitivity:5,continuousVertical:!1,animateAnchor:!0,afterLoad:null,onLeave:null,afterRender:null,afterSlideLoad:null,onSlideLeave:null},c);c.continuousVertical&&(c.loopTop||c.loopBottom)&&(c.continuousVertical=!1,console&&console.log&&console.log("Option loopTop/loopBottom is mutually exclusive with continuousVertical; continuousVertical disabled"));var N=600;b.fn.fullpage.setAutoScrolling=
function(a){c.autoScrolling=a;a=b(".section.active");c.autoScrolling?(b("html, body").css({overflow:"hidden",height:"100%"}),a.length&&x(a.position().top)):(b("html, body").css({overflow:"auto",height:"auto"}),x(0),b("html, body").scrollTop(a.position().top))};b.fn.fullpage.setScrollingSpeed=function(a){c.scrollingSpeed=a};b.fn.fullpage.setMouseWheelScrolling=function(a){a?document.addEventListener?(document.addEventListener("mousewheel",p,!1),document.addEventListener("wheel",p,!1)):document.attachEvent("onmousewheel",
p):document.addEventListener?(document.removeEventListener("mousewheel",p,!1),document.removeEventListener("wheel",p,!1)):document.detachEvent("onmousewheel",p)};b.fn.fullpage.setAllowScrolling=function(a){a?(b.fn.fullpage.setMouseWheelScrolling(!0),E&&(b(document).off("touchstart MSPointerDown").on("touchstart MSPointerDown",Y),b(document).off("touchmove MSPointerMove").on("touchmove MSPointerMove",X))):(b.fn.fullpage.setMouseWheelScrolling(!1),E&&(b(document).off("touchstart MSPointerDown"),b(document).off("touchmove MSPointerMove")))};
b.fn.fullpage.setKeyboardScrolling=function(a){c.keyboardScrolling=a};var s=!1,E=navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|Windows Phone)/),k=b(window).height(),r=!1,B=!1,t,I;b.fn.fullpage.setAllowScrolling(!0);c.css3&&(c.css3=aa());b("body").wrapInner('<div id="superContainer" />');if(c.navigation){b("body").append('<div id="fullPage-nav"><ul></ul></div>');var u=b("#fullPage-nav");u.css("color",c.navigationColor);u.addClass(c.navigationPosition)}b(".section").each(function(a){var f=
b(this),d=b(this).find(".slide"),e=d.length;a||0!==b(".section.active").length||b(this).addClass("active");b(this).css("height",k+"px");(c.paddingTop||c.paddingBottom)&&b(this).css("padding",c.paddingTop+" 0 "+c.paddingBottom+" 0");"undefined"!==typeof c.slidesColor[a]&&b(this).css("background-color",c.slidesColor[a]);"undefined"!==typeof c.anchors[a]&&b(this).attr("data-anchor",c.anchors[a]);if(c.navigation){var g="";c.anchors.length&&(g=c.anchors[a]);a=c.navigationTooltips[a];"undefined"===typeof a&&
(a="");u.find("ul").append('<li data-tooltip="'+a+'"><a href="#'+g+'"><span></span></a></li>')}if(0<e){var g=100*e,h=100/e;d.wrapAll('<div class="slidesContainer" />');d.parent().wrap('<div class="slides" />');b(this).find(".slidesContainer").css("width",g+"%");b(this).find(".slides").after('<div class="controlArrow prev"></div><div class="controlArrow next"></div>');"#fff"!=c.controlArrowColor&&(b(this).find(".controlArrow.next").css("border-color","transparent transparent transparent "+c.controlArrowColor),
b(this).find(".controlArrow.prev").css("border-color","transparent "+c.controlArrowColor+" transparent transparent"));c.loopHorizontal||b(this).find(".controlArrow.prev").hide();c.slidesNavigation&&$(b(this),e);d.each(function(a){a||0!=f.find(".slide.active").length||b(this).addClass("active");b(this).css("width",h+"%");c.verticalCentered&&T(b(this))})}else c.verticalCentered&&T(b(this))}).promise().done(function(){b.fn.fullpage.setAutoScrolling(c.autoScrolling);var a=b(".section.active").find(".slide.active");
if(a.length&&(0!=b(".section.active").index(".section")||0==b(".section.active").index(".section")&&0!=a.index())){var f=c.scrollingSpeed;b.fn.fullpage.setScrollingSpeed(0);n(b(".section.active").find(".slides"),a);b.fn.fullpage.setScrollingSpeed(f)}c.fixedElements&&c.css3&&b(c.fixedElements).appendTo("body");c.navigation&&(u.css("margin-top","-"+u.height()/2+"px"),u.find("li").eq(b(".section.active").index(".section")).find("a").addClass("active"));c.menu&&c.css3&&b(c.menu).appendTo("body");if(c.scrollOverflow)b(window).on("load",
function(){b(".section").each(function(){var a=b(this).find(".slide");a.length?a.each(function(){D(b(this))}):D(b(this))});b.isFunction(c.afterRender)&&c.afterRender.call(this)});else b.isFunction(c.afterRender)&&c.afterRender.call(this);a=window.location.hash.replace("#","").split("/")[0];a.length&&(f=b('[data-anchor="'+a+'"]'),!c.animateAnchor&&f.length&&(x(f.position().top),b.isFunction(c.afterLoad)&&c.afterLoad.call(this,a,f.index(".section")+1),f.addClass("active").siblings().removeClass("active")));
b(window).on("load",function(){var a=window.location.hash.replace("#","").split("/"),b=a[0],a=a[1];b&&H(b,a)})});var V,J=!1;b(window).scroll(function(a){if(!c.autoScrolling){var f=b(window).scrollTop();a=b(".section").map(function(){if(b(this).offset().top<f+100)return b(this)});a=a[a.length-1];if(!a.hasClass("active")){J=!0;var d=F(a);b(".section.active").removeClass("active");a.addClass("active");var e=a.data("anchor");b.isFunction(c.onLeave)&&c.onLeave.call(this,a.index(".section"),d);b.isFunction(c.afterLoad)&&
c.afterLoad.call(this,e,a.index(".section")+1);O(e);P(e,0);c.anchors.length&&!r&&(t=e,location.hash=e);clearTimeout(V);V=setTimeout(function(){J=!1},100)}}});var w=0,z=0,v=0,y=0;b.fn.fullpage.moveSectionUp=function(){var a=b(".section.active").prev(".section");a.length||!c.loopTop&&!c.continuousVertical||(a=b(".section").last());a.length&&h(a,null,!0)};b.fn.fullpage.moveSectionDown=function(){var a=b(".section.active").next(".section");a.length||!c.loopBottom&&!c.continuousVertical||(a=b(".section").first());
(0<a.length||!a.length&&(c.loopBottom||c.continuousVertical))&&h(a,null,!1)};b.fn.fullpage.moveTo=function(a,c){var d="",d=isNaN(a)?b('[data-anchor="'+a+'"]'):b(".section").eq(a-1);"undefined"!==c?H(a,c):0<d.length&&h(d)};b(window).on("hashchange",function(){if(!J){var a=window.location.hash.replace("#","").split("/"),b=a[0],a=a[1],c="undefined"===typeof t,e="undefined"===typeof t&&"undefined"===typeof a;(b&&b!==t&&!c||e||!s&&I!=a)&&H(b,a)}});b(document).keydown(function(a){if(c.keyboardScrolling&&
!r)switch(a.which){case 38:case 33:b.fn.fullpage.moveSectionUp();break;case 40:case 34:b.fn.fullpage.moveSectionDown();break;case 37:b(".section.active").find(".controlArrow.prev:visible").trigger("click");break;case 39:b(".section.active").find(".controlArrow.next:visible").trigger("click")}});b(document).on("click","#fullPage-nav a",function(a){a.preventDefault();a=b(this).parent().index();h(b(".section").eq(a))});b(document).on({mouseenter:function(){var a=b(this).data("tooltip");b('<div class="fullPage-tooltip '+
c.navigationPosition+'">'+a+"</div>").hide().appendTo(b(this)).fadeIn(200)},mouseleave:function(){b(this).find(".fullPage-tooltip").fadeOut().remove()}},"#fullPage-nav li");c.normalScrollElements&&(b(document).on("mouseover",c.normalScrollElements,function(){b.fn.fullpage.setMouseWheelScrolling(!1)}),b(document).on("mouseout",c.normalScrollElements,function(){b.fn.fullpage.setMouseWheelScrolling(!0)}));b(".section").on("click",".controlArrow",function(){if(!s){s=!0;var a=b(this).closest(".section").find(".slides"),
c=a.find(".slide.active"),d=null,d=b(this).hasClass("prev")?c.prev(".slide"):c.next(".slide");d.length||(d=b(this).hasClass("prev")?c.siblings(":last"):c.siblings(":first"));n(a,d)}});b(".section").on("click",".toSlide",function(a){a.preventDefault();a=b(this).closest(".section").find(".slides");a.find(".slide.active");var c=null,c=a.find(".slide").eq(b(this).data("index")-1);0<c.length&&n(a,c)});if(!E){var W;b(window).resize(function(){clearTimeout(W);W=setTimeout(R,500)})}var ba="onorientationchange"in
window?"orientationchange":"resize";b(window).bind(ba,function(){E&&R()});b(document).on("click",".fullPage-slidesNav a",function(a){a.preventDefault();a=b(this).closest(".section").find(".slides");var c=a.find(".slide").eq(b(this).closest("li").index());n(a,c)})}})(jQuery);


