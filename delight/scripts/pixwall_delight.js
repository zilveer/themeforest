// Pixwall slideshow v1.0.0 - a jQuery slideshow with many effects, transitions, easy to customize, using canvas and mobile ready, based on jQuery 1.4+
// Copyright (c) 2011 by Manuel Masia - www.pixedelic.com
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
;(function($){$.fn.pixwall_delight = function(opts, callback) {
	
	var defaults = {
		target				: '#pixwall_delight_target',	//if you don't want fullscreen iamges, but if you prefer that your images resize according with a div, type here its name: '.my_divs' or '#my_div'
				
		fx					: 'random',
//'random','simpleFade','scrollLeft','scrollRight','scrollTop','scrollBottom','scrollHorz'
		
//you can also use more than one effect: 'simpleFade, scrollRight, scrollBottom'

		mobileFx			: '',	//leave empty if you want to display the same effect on mobile devices and on desktop etc.

		slideOn				: 'random',	//next, prev, random: decide if the transition effect will be applied to the current (prev) or the next slide
				
		gridDifference		: 250,	//to make the grid blocks slower than the slices, this value must be smaller than transPeriod
		
		easing				: 'easeInOutExpo',	//for the complete list http://jqueryui.com/demos/effect/easing.html
		
		mobileEasing		: '',	//leave empty if you want to display the same easing on mobile devices and on desktop etc.
		
		loader				: 'bar',	//pie, bar, none (even if you choose "pie", old browsers like IE8- can't display it... they will display always a loading bar)
		
		loaderOpacity		: .8,	//0, .1, .2, .3, .4, .5, .6, .7, .8, .9, 1
		
		loaderColor			: '#ffff00', 
		
		loaderBgColor		: '#222222', 
		
		pieDiameter			: 50,
		
		pieContainer		: '#pixwall_delight_pie',
		
		pieStroke			: 8,
		
		barContainer		: '#pixwall_delight_bar',
		
		barDirection		: 'bottomToTop',	//'leftToRight', 'rightToLeft', 'topToBottom', 'bottomToTop'
		
		prevNav				: '#pixwall_delight_prev',	//true, false. It enables the previous and the next buttons, their IDs are #pixwall_delight_prev and #pixwall_delight_next
		
		nextNav				: '#pixwall_delight_next',	//true, false. It enables the previous and the next buttons, their IDs are #pixwall_delight_prev and #pixwall_delight_next
		
		commands			: '#pixwall_delight_commands',	//true, false. It enables stop and play buttons
		
		mobileCommands		: true,	//true, false. It enables stop and play buttons on mobile devices
				
		pagination			: '#pixwall_delight_pag',	//It enables the pagination numbers. This is the appended code: 
									//<div id="pixwall_delight_pag">
										//<ul id="pixwall_delight_pag_ul">
											//<li id="pag_nav_0"><span><span>0</span></span></li>
											//<li id="pag_nav_1"><span><span>1</span></span></li>
											//<li id="pag_nav_2"><span><span>2</span></span></li>
											//...etc.
										//</ul>
									//</div>
		
		mobilePagination	: '#pixwall_delight_pag',	//It enables the pagination numbers on mobile devices
		
		thumbs				: '#pixwall_delight_thumbs',	//It shows the thumbnails (if available) when the mouse is on the pagination buttons. Not available for mobile devices
		
		hover				: true,	//true, false. Puase on state hover. Not available for mobile devices
		
		pauseOnClick		: true,	//true, false. It stops the slideshow when you click the sliders.
		
		rows				: 4,
		
		cols				: 6,
		
		slicedRows			: 8,	//if 0 the same value of rows
		
		slicedCols			: 12,	//if 0 the same value of cols
		
		opacityOnGrid		: false,	//true, false. Decide to apply a fade effect to blocks and slices: if your slideshow is fullscreen or simply big, I recommend to set it false to have a smoother effect 
		
		time				: 7000,	//milliseconds between the end of the sliding effect and the start of the nex one
		
		transPeriod			: 1500,	//lenght of the sliding effect in milliseconds
		
		autoAdvance			: true,	//true, false
		
		mobileAutoAdvance	: true, //true, false. Auto-advancing for mobile devices
		
		portrait			: false, //true, false. Select true if you don't want that your images are cropped
		
		alignment			: 'center', //topLeft, topCenter, topRight, centerLeft, center, centerRight, bottomLeft, bottomCenter, bottomRight
		
		onStartLoading		: function() {  },

		afterChange		: function() {  },

		beforeChange		: function() {  },
		
		onLoaded			: function() {  }

    };
	
	
	function isMobile() {	//sniff a mobile browser
		if( navigator.userAgent.match(/Android/i) ||
			navigator.userAgent.match(/webOS/i) ||
			navigator.userAgent.match(/iPad/i) ||
			navigator.userAgent.match(/iPhone/i) ||
			navigator.userAgent.match(/iPod/i)
			){
				return true;
		}	
	}
	
	var opts = $.extend({}, defaults, opts);
	
	var elem = $(this);

	var target = $(opts.target);	//the target element
	
	var w = target.width();
	var h = target.height();
	
	var allImg = new Array();	//I create an array for the images of the slideshow
	$('> div', elem).each( function() { 
		allImg.push($(this).attr('data-src'));	//all the images are pushed in the array
	});
	
	var amountSlide = allImg.length;    //how many sliders

	var allThumbs = new Array();
	$('> div', elem).each( function() { 
		allThumbs.push($(this).attr('data-thumb'));
	});
	
	target.append('<div id="pixwallDelightCont" />');	//I append the container for the slides
	var pixwall_delightCont = $('#pixwallDelightCont');
	

	
	var loop;
	for (loop=0;loop<amountSlide;loop++)
	{
		pixwall_delightCont.append('<div class="pixwall_delightSlide" id="pixwall_delightSlide_'+loop+'" />');	//I create as many slides as the a tags in elem
		var div = $('> div:eq('+loop+')',elem);
		$('#pixwall_delightSlide_'+loop).clone(div);
	}
	
	
	if($(opts.thumbs).length) {
		$(opts.thumbs).before('<div id="pixwall_delight_prevThumbs" />').after('<div id="pixwall_delight_nextThumbs" />');
		$('#pixwall_delight_prevThumbs, #pixwall_delight_nextThumbs').animate({opacity:.7},0);
		$(opts.thumbs).append('<div />');
		$('>div',opts.thumbs).append('<ul />');
		jQuery.each(allThumbs, function(i, val) {
			var newImg = new Image();
			newImg.src = val;
			$('ul',opts.thumbs).append('<li class="pix_thumb" id="pix_thumb_'+i+'" />');
			$('li#pix_thumb_'+i).append($(newImg).attr('class','pix_thumb'));
		});
	}
	
	function thumbnailVisible() {
	}
	
	$(window).bind('load resize',function(){
		thumbnailVisible();
	});

	function thumbnailPos() {
	}


	pixwall_delightCont.append('<div class="pixwall_delightSlide" id="pixwall_delightSlide_'+loop+'" />');	//hack to get the size of the last prepended image, do not remove
	
	
	var started; 
	$(window).bind('resize',function(){
		if(started == true) {
			resizeImage();
		}
		$('ul', opts.thumbs).animate({'margin-top':0},0,thumbnailPos);
	});
	
	function resizeImage(){	//The name explains the function
		w = target.width();
		h = target.height();
		$('.pixwall_delightrelative',elem).css({'width':w,'height':h});
		$('.imgLoaded', target).each(function(){
			var t = $(this),
				wT = t.attr('width'),
				hT = t.attr('height'),
				mTop,
				mLeft,
				alignment = t.attr('data-alignment');
				
				if(typeof alignment === 'undefined' || alignment === false){
					alignment = opts.alignment;
				}
				
				if(opts.portrait==false){
					if((wT/hT)<(w/h)) {
						var r = w / wT;
						var d = (Math.abs(h - (hT*r)))*0.5;
						switch(alignment){
							case 'topLeft':
								mTop = 0;
								break;
							case 'topCenter':
								mTop = 0;
								break;
							case 'topRight':
								mTop = 0;
								break;
							case 'centerLeft':
								mTop = '-'+d+'px';
								break;
							case 'center':
								mTop = '-'+d+'px';
								break;
							case 'centerRight':
								mTop = '-'+d+'px';
								break;
							case 'bottomLeft':
								mTop = '-'+d*2+'px';
								break;
							case 'bottomCenter':
								mTop = '-'+d*2+'px';
								break;
							case 'bottomRight':
								mTop = '-'+d*2+'px';
								break;
						}
						t.css({
							'height' : hT*r,
							'margin-left' : 0,
							'margin-top' : mTop,
							'position' : 'absolute',
							'width' : w
						});
					}
					else {
						var r = h / hT;
						var d = (Math.abs(w - (wT*r)))*0.5;
						switch(alignment){
							case 'topLeft':
								mLeft = 0;
								break;
							case 'topCenter':
								mLeft = '-'+d+'px';
								break;
							case 'topRight':
								mLeft = '-'+d*2+'px';
								break;
							case 'centerLeft':
								mLeft = 0;
								break;
							case 'center':
								mLeft = '-'+d+'px';
								break;
							case 'centerRight':
								mLeft = '-'+d*2+'px';
								break;
							case 'bottomLeft':
								mLeft = 0;
								break;
							case 'bottomCenter':
								mLeft = '-'+d+'px';
								break;
							case 'bottomRight':
								mLeft = '-'+d*2+'px';
								break;
						}
						t.css({
							'height' : h,
							'margin-left' : mLeft,
							'margin-top' : 0,
							'position' : 'absolute',
							'width' : wT*r
						});
					}
				} else {
					if((wT/hT)<(w/h)) {
						var r = h / hT;
						var d = (Math.abs(w - (wT*r)))*0.5;
						t.css({
							'height' : h,
							'margin-left' : d+'px',
							'margin-top' : 0,
							'position' : 'absolute',
							'width' : wT*r
						});
					}
					else {
						var r = w / wT;
						var d = (Math.abs(h - (hT*r)))*0.5;
						t.css({
							'height' : hT*r,
							'margin-left' : 0,
							'margin-top' : d+'px',
							'position' : 'absolute',
							'width' : w
						});
					}
				}
		});
		
		started = true;
	}
	
	
	var u;

//Define some difference if is a mobile device or not
	var clickEv,
		autoAdv,
		navHover,
		commands,
		pagination;

	clickEv = 'click';
	
	autoAdv = opts.autoAdvance;
	
	if(autoAdv==false){
		elem.addClass('stopped');
		$('#pixwall_delight_stop').fadeOut(0);
	} else {
		$('#pixwall_delight_play').fadeOut(0);
	}

	navHover = opts.navigationHover;

	commands = opts.commands;

	pagination = opts.pagination;

	if(elem.length!=0){
			
		var selector = $('.pixwall_delightSlide');
		selector.wrapInner('<div class="pixwall_delightrelative" />');	//wrap a div for the position of absolute elements
		
		var nav;	//nextSlide(nav)
		
		function imgFake() {	//this function replace elements such as iframes or objects with an image stored in data-fake attribute
			$('*[data-fake]',elem).each(function(){
				var t = $(this);
				var imgFakeUrl = t.attr('data-fake');
				var imgFake = new Image();
				imgFake.src = imgFakeUrl;
				t.after($(imgFake).attr('class','imgFake'));	//the image has class imgFake
				var clone = t.clone();
				t.remove();	//I remove the element after cloning so it is initialized only when it appears
				$('.elemToHide').show();
				$(imgFake).click(function(){
					$(this).hide().after(clone);
					$('.elemToHide').hide();
				});
			});
		}
		
		imgFake();
		
		
		if(opts.hover==true){	//if the option "hover" is true I stop the slideshow on mouse over and I resume it on mouse out
			if(!isMobile()){
				elem.hoverIntent({	
					over: function(){
							elem.addClass('stopped');
						},
					out: function(){
							if(autoAdv!=false){
								elem.removeClass('stopped');
							}									
						},
					timeout: 0
				});
			}
		}

		if(navHover==true){	//if the option is true I show the next and prev button only on mouse over
			elem.hover(function(){
				$('#pixwall_delight_prev, #pixwall_delight_next').stop(true,false).animate({opacity:1},200);
			},function(){
				$('#pixwall_delight_prev, #pixwall_delight_next').stop(true,false).animate({opacity:0},200);
			});
		}
	
	
		$.fn.pixwall_delightStop = function() {
			autoAdv = false;
			elem.addClass('stopped');
			if($('#pixwall_delight_stop').length){
				$('#pixwall_delight_stop').fadeOut(100,function(){
					$('#pixwall_delight_play').fadeIn(100);
					if(opts.loader!='none'){
						$('#pixwall_delight_canvas').fadeOut(100);
					}
				});
			} else {
				if(opts.loader!='none'){
					$('#pixwall_delight_canvas').fadeOut(100);
				}
			}
		}

		$('#pixwall_delight_stop').live('click',function(){	//stop function
			elem.pixwall_delightStop();
		});
	
		$.fn.pixwall_delightPlay = function() {
			autoAdv = true;
			elem.removeClass('stopped');
			if($('#pixwall_delight_play').length){
				$('#pixwall_delight_play').fadeOut(100,function(){
					$('#pixwall_delight_stop').fadeIn(100);
					if(opts.loader!='none'){
						$('#pixwall_delight_canvas').fadeIn(100);
					}
				});
			} else {
				if(opts.loader!='none'){
					$('#pixwall_delight_canvas').fadeIn(100);
				}
			}
		}

		$('#pixwall_delight_play').live('click',function(){	//play function
			elem.pixwall_delightPlay();
		});
	
		if(opts.pauseOnClick==true){	//if option is true I stop the slideshow if the user clicks on the slider
			selector.click(function(){
				autoAdv = false;
				elem.addClass('stopped');
				$('#pixwall_delight_stop').fadeOut(100,function(){
					$('#pixwall_delight_play').fadeIn(100);
					$('#pixwall_delight_canvas').fadeOut(100);
				});
			});
		}
		
		
	}
	
	
		function shuffle(arr) {	//to randomize the effect
			for(
			  var j, x, i = arr.length; i;
			  j = parseInt(Math.random() * i),
			  x = arr[--i], arr[i] = arr[j], arr[j] = x
			);
			return arr;
		}
	
		function isInteger(s) {	//to check if a number is integer
			return Math.ceil(s) == Math.floor(s);
		}	
	
		if (($.browser.msie && $.browser.version < 9) || opts.loader == 'bar') {	//IE8- has some problems with canvas, I prefer to use a simple loading bar in CSS
			$('#pixwall_delight_bar').append('<span id="pixwall_delight_bar_cont" />');
			$('#pixwall_delight_bar_cont')
				.animate({opacity:opts.loaderOpacity},0)
				.css({'position':'absolute', 'left':0, 'right':0, 'top':0, 'bottom':0, 'background-color':opts.loaderBgColor})
				.append('<span id="pixwall_delight_canvas" />');
			$('#pixwall_delight_canvas').animate({opacity:0},0);
			var canvas = $("#pixwall_delight_canvas");
			canvas.css({'position':'absolute', 'left':0, 'right':0, 'top':0, 'bottom':0, 'background-color':opts.loaderColor});
		} else {
			$('#pixwall_delight_pie').append('<canvas id="pixwall_delight_canvas"></canvas>');
			var G_vmlCanvasManager;
			var canvas = document.getElementById("pixwall_delight_canvas");
			canvas.setAttribute("width", opts.pieDiameter);
			canvas.setAttribute("height", opts.pieDiameter);
			canvas.setAttribute("style", "position:absolute; z-index:1002; "+opts.piePosition);
			var rad;
			var radNew;
	
			if (canvas && canvas.getContext) {
				var ctx = canvas.getContext("2d");
				ctx.rotate(Math.PI*(3/2));
				ctx.translate(-opts.pieDiameter,0);
			}
		
		}
		if(opts.loader=='none' || autoAdv==false) {	//hide the loader if you want
			$('#pixwall_delight_canvas, #pixwall_delight_canvas_wrap').hide();
		}
		
		if($(pagination).length) {
			$(pagination).append('<ul id="pixwall_delight_pag_ul" />');
			var li;
			for (li = 0; li < amountSlide; li++){
				$('#pixwall_delight_pag_ul').append('<li id="pag_nav_'+li+'" style="position:relative; z-index:1002"><span><span>'+li+'</span></span></li>');
			}
		}
			
	
	
		if($(commands).length) {
			$(commands).append('<div id="pixwall_delight_play" />').append('<div id="pixwall_delight_stop" />');
			if(autoAdv==true){
				$('#pixwall_delight_play').hide();
				$('#pixwall_delight_stop').show();
			} else {
				$('#pixwall_delight_stop').hide();
				$('#pixwall_delight_play').show();
			}
		}
			


		if(navHover==true){
			$('#pixwall_delight_prev, #pixwall_delight_next').animate({opacity:0},0);
		}
			
		function canvasLoader() {
			rad = 0;
			if (($.browser.msie && $.browser.version < 9) || opts.loader == 'bar') {
				switch(opts.barDirection){
					case 'leftToRight':
						$('#pixwall_delight_canvas').css({'right':'auto'});
						break;
					case 'rightToLeft':
						$('#pixwall_delight_canvas').css({'left':'auto'});
						break;
					case 'topToBottom':
						$('#pixwall_delight_canvas').css({'bottom':'auto'});
						break;
					case 'bottomToTop':
						$('#pixwall_delight_canvas').css({'top':'auto'});
						break;
				}
			} else {
				ctx.clearRect(0,0,opts.pieDiameter,opts.pieDiameter); // clear canvas
			}
		}
		
		
		canvasLoader();
		
		
		$('.fromLeft, .fromRight, .fromTop, .fromBottom, .fadeIn').each(function(){
			$(this).css('visibility','hidden');
		});
		
		opts.onStartLoading.call(this);
		
		nextSlide();
		
	
	/*************************** FUNCTION nextSlide() ***************************/
	
	function nextSlide(nav){    //funzione per il fading delle immagini
		elem.addClass('pixwall_delightsliding');	//aggiunge una classe che mi dice che il fading  in corso
		
		var vis = parseFloat($('div.pixwall_delightcurrent').index());    //la variabile il numero del div partendo da 0

		if(nav>0){ 
			var slideI = nav-1;
		} else if (vis == amountSlide-1) { 
			var slideI = 0;
		} else {
			var slideI = vis+1;
		}
				
		var slide = $('.pixwall_delightSlide:eq('+slideI+')',target);
		$('.pixwall_delightContent').fadeOut(600);

		if(!$('.imgLoaded',slide).length){
			var imgUrl = allImg[slideI];
			var imgLoaded = new Image();
			imgLoaded.src = imgUrl/* +"?"+ new Date().getTime();*/;
			slide.css('visibility','hidden');
			slide.prepend($(imgLoaded).attr('class','imgLoaded'));
			var wT, hT;
			if (!$(imgLoaded).get(0).complete || wT == '0' || hT == '0' || typeof wT === 'undefined' || wT === false || typeof hT === 'undefined' || hT === false) {
				opts.onLoaded.call(this);
				$('#pixwall_delight_loader').delay(500).fadeIn(400);
				imgLoaded.onload = function() {
					wT = imgLoaded.naturalWidth;
					hT = imgLoaded.naturalHeight;
					$(imgLoaded).attr('width',wT);
					$(imgLoaded).attr('height',hT);
					$('#pixwall_delightSlide_'+slideI).hide().css('visibility','visible');
					resizeImage();
					nextSlide(slideI+1);
				};
			} else {
				wT = imgLoaded.naturalWidth;
				hT = imgLoaded.naturalHeight;
				$(imgLoaded).attr('width',wT);
				$(imgLoaded).attr('height',hT);
				$('#pixwall_delightSlide_'+slideI).hide().css('visibility','visible');
				resizeImage();
				imgLoaded.onload = function() {
					nextSlide(slideI+1);
				}
			}
		} else {
			if($('#pixwall_delight_loader').is(':visible')){
				$('#pixwall_delight_loader').fadeOut(400);
			} else {
				$('#pixwall_delight_loader').css({'visibility':'hidden'});
				$('#pixwall_delight_loader').fadeOut(400,function(){
					$('#pixwall_delight_loader').css({'visibility':'visible'});
				});
			}
			var rows = opts.rows,
				cols = opts.cols,
				couples = 1,
				difference = 0,
				dataSlideOn,
				time,
				fx,
				easing,
				randomFx = new Array('simpleFade','curtainTopLeft','curtainTopRight','curtainBottomLeft','curtainBottomRight','curtainSliceLeft','curtainSliceRight','blindCurtainTopLeft','blindCurtainTopRight','blindCurtainBottomLeft','blindCurtainBottomRight','blindCurtainSliceBottom','blindCurtainSliceTop','stampede','mosaic','mosaicReverse','mosaicRandom','mosaicSpiral','mosaicSpiralReverse','topLeftBottomRight','bottomRightTopLeft','bottomLeftTopRight','bottomLeftTopRight','scrollLeft','scrollRight','scrollTop','scrollBottom','scrollHorz');
				marginLeft = 0,
				marginTop = 0,
				opacityOnGrid = 0;
				
				if(opts.opacityOnGrid==true){
					opacityOnGrid = 0;
				} else {
					opacityOnGrid = 1;
				}
 
			
			
			if(isMobile()){
				var dataFx = selector.eq(slideI).attr('data-fx');
			} else {
				var dataFx = selector.eq(slideI).attr('data-mobslideIleFx');
			}
			if(typeof dataFx !== 'undefined' && dataFx!== false){
				fx = dataFx;
			} else {
				if(isMobile()&&opts.mobileFx!=''){
					fx = opts.mobileFx;
				} else {
					fx = opts.fx;
				}
				if(fx=='random') {
					fx = shuffle(randomFx);
					fx = fx[0];
				} else {
					fx = fx;
					if(fx.indexOf(',')>0){
						fx = fx.replace(/ /g,'');
						fx = fx.split(',');
						fx = shuffle(fx);
						fx = fx[0];
					}
				}
			}
			
			if(isMobile()&&opts.mobileEasing!=''){
				easing = opts.mobileEasing;
			} else {
				easing = opts.easing;
			}
	
			dataSlideOn = selector.eq(slideI).attr('data-slideOn');
			if(typeof dataSlideOn !== 'undefined' && dataSlideOn!== false){
				slideOn = dataSlideOn;
			} else {
				if(opts.slideOn=='random'){
					var slideOn = new Array('next','prev');
					slideOn = shuffle(slideOn);
					slideOn = slideOn[0];
				} else {
					slideOn = opts.slideOn;
				}
			}
				
			time = selector.eq(slideI).attr('data-time');
			if(typeof time !== 'undefined' && time!== false){
				time = time;
			} else {
				time = opts.time;
			}
				
			if(!$(elem).hasClass('pixwall_delightstarted')){
				fx = 'simpleFade';
				slideOn = 'next';
				$(elem).addClass('pixwall_delightstarted')
			}
	
			switch(fx){
				case 'simpleFade':
					cols = 1;
					rows = 1;
						break;
				case 'curtainTopLeft':
					if(opts.slicedCols == 0) {
						cols = opts.cols;
					} else {
						cols = opts.slicedCols;
					}
					rows = 1;
						break;
				case 'curtainTopRight':
					if(opts.slicedCols == 0) {
						cols = opts.cols;
					} else {
						cols = opts.slicedCols;
					}
					rows = 1;
						break;
				case 'curtainBottomLeft':
					if(opts.slicedCols == 0) {
						cols = opts.cols;
					} else {
						cols = opts.slicedCols;
					}
					rows = 1;
						break;
				case 'curtainBottomRight':
					if(opts.slicedCols == 0) {
						cols = opts.cols;
					} else {
						cols = opts.slicedCols;
					}
					rows = 1;
						break;
				case 'curtainSliceLeft':
					if(opts.slicedCols == 0) {
						cols = opts.cols;
					} else {
						cols = opts.slicedCols;
					}
					rows = 1;
						break;
				case 'curtainSliceRight':
					if(opts.slicedCols == 0) {
						cols = opts.cols;
					} else {
						cols = opts.slicedCols;
					}
					rows = 1;
						break;
				case 'blindCurtainTopLeft':
					if(opts.slicedRows == 0) {
						rows = opts.rows;
					} else {
						rows = opts.slicedRows;
					}
					cols = 1;
						break;
				case 'blindCurtainTopRight':
					if(opts.slicedRows == 0) {
						rows = opts.rows;
					} else {
						rows = opts.slicedRows;
					}
					cols = 1;
						break;
				case 'blindCurtainBottomLeft':
					if(opts.slicedRows == 0) {
						rows = opts.rows;
					} else {
						rows = opts.slicedRows;
					}
					cols = 1;
						break;
				case 'blindCurtainBottomRight':
					if(opts.slicedRows == 0) {
						rows = opts.rows;
					} else {
						rows = opts.slicedRows;
					}
					cols = 1;
						break;
				case 'blindCurtainSliceTop':
					if(opts.slicedRows == 0) {
						rows = opts.rows;
					} else {
						rows = opts.slicedRows;
					}
					cols = 1;
						break;
				case 'blindCurtainSliceBottom':
					if(opts.slicedRows == 0) {
						rows = opts.rows;
					} else {
						rows = opts.slicedRows;
					}
					cols = 1;
						break;
				case 'stampede':
					difference = '-'+opts.transPeriod;
						break;
				case 'mosaic':
					difference = opts.gridDifference;
						break;
				case 'mosaicReverse':
					difference = opts.gridDifference;
						break;
				case 'mosaicRandom':
						break;
				case 'mosaicSpiral':
					difference = opts.gridDifference;
					couples = 1.7;
						break;
				case 'mosaicSpiralReverse':
					difference = opts.gridDifference;
					couples = 1.7;
						break;
				case 'topLeftBottomRight':
					difference = opts.gridDifference;
					couples = 6;
						break;
				case 'bottomRightTopLeft':
					difference = opts.gridDifference;
					couples = 6;
						break;
				case 'bottomLeftTopRight':
					difference = opts.gridDifference;
					couples = 6;
						break;
				case 'topRightBottomLeft':
					difference = opts.gridDifference;
					couples = 6;
						break;
				case 'scrollLeft':
					cols = 1;
					rows = 1;
						break;
				case 'scrollRight':
					cols = 1;
					rows = 1;
						break;
				case 'scrollTop':
					cols = 1;
					rows = 1;
						break;
				case 'scrollBottom':
					cols = 1;
					rows = 1;
						break;
				case 'scrollHorz':
					cols = 1;
					rows = 1;
						break;
			}
			
			var cycle = 0;
			var blocks = rows*cols;	//number of squares
			var leftScrap = w-(Math.floor(w/cols)*cols);	//difference between rounded widths and total width
			var topScrap = h-(Math.floor(h/rows)*rows);	//difference between rounded heights and total height
			var addLeft;	//1 optional pixel to the widths
			var addTop;	//1 optional pixel to the heights
			var tAppW = 0;	//I need it to calculate the margin left for the widths
			var tAppH = 0;	//I need it to calculate the margin right for the widths
			var arr = new Array();
			var delay = new Array();
			var order = new Array();
			while(cycle < blocks){
				arr.push(cycle);
				delay.push(cycle);
				pixwall_delightCont.append('<div class="pixwall_delightappended" style="display:none; overflow:hidden; position:absolute; z-index:1000" />');
				var tApp = $('.pixwall_delightappended:eq('+cycle+')');
				if(fx=='scrollLeft' || fx=='scrollRight' || fx=='scrollTop' || fx=='scrollBottom' || fx=='scrollHorz'){
					selector.eq(slideI).clone().show().appendTo(tApp);
				} else {
					if(slideOn=='next'){
						selector.eq(slideI).clone().show().appendTo(tApp);
					} else {
						selector.eq(vis).clone().show().appendTo(tApp);
					}
				}

				if(cycle%cols<leftScrap){
					addLeft = 1;
				} else {
					addLeft = 0;
				}
				if(cycle%cols==0){
					tAppW = 0;
				}
				if(Math.floor(cycle/cols)<topScrap){
					addTop = 1;
				} else {
					addTop = 0;
				}
				tApp.css({
					'height': Math.floor((h/rows)+addTop+1),
					'left': tAppW,
					'top': tAppH,
					'width': Math.floor((w/cols)+addLeft+1)
				});
				$('> .pixwall_delightSlide', tApp).css({
					'height': h,
					'margin-left': '-'+tAppW+'px',
					'margin-top': '-'+tAppH+'px',
					'width': w
				});
				tAppW = tAppW+tApp.width()-1;
				if(cycle%cols==cols-1){
					tAppH = tAppH + tApp.height() - 1;
				}
				cycle++;
			}
			

			
			switch(fx){
				case 'curtainTopLeft':
						break;
				case 'curtainBottomLeft':
						break;
				case 'curtainSliceLeft':
						break;
				case 'curtainTopRight':
					arr = arr.reverse();
						break;
				case 'curtainBottomRight':
					arr = arr.reverse();
						break;
				case 'curtainSliceRight':
					arr = arr.reverse();
						break;
				case 'blindCurtainTopLeft':
						break;
				case 'blindCurtainBottomLeft':
					arr = arr.reverse();
						break;
				case 'blindCurtainSliceTop':
						break;
				case 'blindCurtainTopRight':
						break;
				case 'blindCurtainBottomRight':
					arr = arr.reverse();
						break;
				case 'blindCurtainSliceBottom':
					arr = arr.reverse();
						break;
				case 'stampede':
					arr = shuffle(arr);
						break;
				case 'mosaic':
						break;
				case 'mosaicReverse':
					arr = arr.reverse();
						break;
				case 'mosaicRandom':
					arr = shuffle(arr);
						break;
				case 'mosaicSpiral':
					var rows2 = rows/2, x, y, z, n=0;
						for (z = 0; z < rows2; z++){
							y = z;
							for (x = z; x < cols - z - 1; x++) {
								order[n++] = y * cols + x;
							}
							x = cols - z - 1;
							for (y = z; y < rows - z - 1; y++) {
								order[n++] = y * cols + x;
							}
							y = rows - z - 1;
							for (x = cols - z - 1; x > z; x--) {
								order[n++] = y * cols + x;
							}
							x = z;
							for (y = rows - z - 1; y > z; y--) {
								order[n++] = y * cols + x;
							}
						}
						
						arr = order;

						break;
				case 'mosaicSpiralReverse':
					var rows2 = rows/2, x, y, z, n=blocks-1;
						for (z = 0; z < rows2; z++){
							y = z;
							for (x = z; x < cols - z - 1; x++) {
								order[n--] = y * cols + x;
							}
							x = cols - z - 1;
							for (y = z; y < rows - z - 1; y++) {
								order[n--] = y * cols + x;
							}
							y = rows - z - 1;
							for (x = cols - z - 1; x > z; x--) {
								order[n--] = y * cols + x;
							}
							x = z;
							for (y = rows - z - 1; y > z; y--) {
								order[n--] = y * cols + x;
							}
						}

						arr = order;
						
						break;
				case 'topLeftBottomRight':
					for (var y = 0; y < rows; y++)
					for (var x = 0; x < cols; x++) {
						order.push(x + y);
					}
						delay = order;
						break;
				case 'bottomRightTopLeft':
					for (var y = 0; y < rows; y++)
					for (var x = 0; x < cols; x++) {
						order.push(x + y);
					}
						delay = order.reverse();
						break;
				case 'bottomLeftTopRight':
					for (var y = rows; y > 0; y--)
					for (var x = 0; x < cols; x++) {
						order.push(x + y);
					}
						delay = order;
						break;
				case 'topRightBottomLeft':
					for (var y = 0; y < rows; y++)
					for (var x = cols; x > 0; x--) {
						order.push(x + y);
					}
						delay = order;
						break;
			}
			
			
						
			$.each(arr, function(index, value) {

				if(value%cols<leftScrap){
					addLeft = 1;
				} else {
					addLeft = 0;
				}
				if(value%cols==0){
					tAppW = 0;
				}
				if(Math.floor(value/cols)<topScrap){
					addTop = 1;
				} else {
					addTop = 0;
				}
				
				$('.interval').text(fx);
			
				switch(fx){
					case 'simpleFade':
						height = h;
						width = w;
						opacityOnGrid = 0;
							break;
					case 'curtainTopLeft':
						height = 0,
						width = Math.floor((w/cols)+addLeft+1),
						marginTop = '-'+Math.floor((h/rows)+addTop+1)+'px';
							break;
					case 'curtainTopRight':
						height = 0,
						width = Math.floor((w/cols)+addLeft+1),
						marginTop = '-'+Math.floor((h/rows)+addTop+1)+'px';
							break;
					case 'curtainBottomLeft':
						height = 0,
						width = Math.floor((w/cols)+addLeft+1),
						marginTop = Math.floor((h/rows)+addTop+1)+'px';
							break;
					case 'curtainBottomRight':
						height = 0,
						width = Math.floor((w/cols)+addLeft+1),
						marginTop = Math.floor((h/rows)+addTop+1)+'px';
							break;
					case 'curtainSliceLeft':
						height = 0,
						width = Math.floor((w/cols)+addLeft+1);
						if(value%2==0){
							marginTop = Math.floor((h/rows)+addTop+1)+'px';					
						} else {
							marginTop = '-'+Math.floor((h/rows)+addTop+1)+'px';					
						}
							break;
					case 'curtainSliceRight':
						height = 0,
						width = Math.floor((w/cols)+addLeft+1);
						if(value%2==0){
							marginTop = Math.floor((h/rows)+addTop+1)+'px';					
						} else {
							marginTop = '-'+Math.floor((h/rows)+addTop+1)+'px';					
						}
							break;
					case 'blindCurtainTopLeft':
						height = Math.floor((h/rows)+addTop+1),
						width = 0,
						marginLeft = '-'+Math.floor((w/cols)+addLeft+1)+'px';
							break;
					case 'blindCurtainTopRight':
						height = Math.floor((h/rows)+addTop+1),
						width = 0,
						marginLeft = Math.floor((w/cols)+addLeft+1)+'px';
							break;
					case 'blindCurtainBottomLeft':
						height = Math.floor((h/rows)+addTop+1),
						width = 0,
						marginLeft = '-'+Math.floor((w/cols)+addLeft+1)+'px';
							break;
					case 'blindCurtainBottomRight':
						height = Math.floor((h/rows)+addTop+1),
						width = 0,
						marginLeft = Math.floor((w/cols)+addLeft+1)+'px';
							break;
					case 'blindCurtainSliceBottom':
						height = Math.floor((h/rows)+addTop+1),
						width = 0;
						if(value%2==0){
							marginLeft = '-'+Math.floor((w/cols)+addLeft+1)+'px';
						} else {
							marginLeft = Math.floor((w/cols)+addLeft+1)+'px';
						}
							break;
					case 'blindCurtainSliceTop':
						height = Math.floor((h/rows)+addTop+1),
						width = 0;
						if(value%2==0){
							marginLeft = '-'+Math.floor((w/cols)+addLeft+1)+'px';
						} else {
							marginLeft = Math.floor((w/cols)+addLeft+1)+'px';
						}
							break;
					case 'stampede':
						height = 0;
						width = 0;					
						marginLeft = (w*0.2)*(((index)%cols)-(cols-(Math.floor(cols/2))))+'px';					
						marginTop = (h*0.2)*((Math.floor(index/cols)+1)-(rows-(Math.floor(rows/2))))+'px';	
							break;
					case 'mosaic':
						height = 0;
						width = 0;					
							break;
					case 'mosaicReverse':
						height = 0;
						width = 0;					
						marginLeft = Math.floor((w/cols)+addLeft+1)+'px';					
						marginTop = Math.floor((h/rows)+addTop+1)+'px';					
							break;
					case 'mosaicRandom':
						height = 0;
						width = 0;					
						marginLeft = Math.floor((w/cols)+addLeft+1)*0.5+'px';					
						marginTop = Math.floor((h/rows)+addTop+1)*0.5+'px';					
							break;
					case 'mosaicSpiral':
						height = 0;
						width = 0;
						marginLeft = Math.floor((w/cols)+addLeft+1)*0.5+'px';					
						marginTop = Math.floor((h/rows)+addTop+1)*0.5+'px';					
							break;
					case 'mosaicSpiralReverse':
						height = 0;
						width = 0;
						marginLeft = Math.floor((w/cols)+addLeft+1)*0.5+'px';					
						marginTop = Math.floor((h/rows)+addTop+1)*0.5+'px';					
							break;
					case 'topLeftBottomRight':
						height = 0;
						width = 0;					
							break;
					case 'bottomRightTopLeft':
						height = 0;
						width = 0;					
						marginLeft = Math.floor((w/cols)+addLeft+1)+'px';					
						marginTop = Math.floor((h/rows)+addTop+1)+'px';					
							break;
					case 'bottomLeftTopRight':
						height = 0;
						width = 0;					
						marginLeft = 0;					
						marginTop = Math.floor((h/rows)+addTop+1)+'px';					
							break;
					case 'topRightBottomLeft':
						height = 0;
						width = 0;					
						marginLeft = Math.floor((w/cols)+addLeft+1)+'px';					
						marginTop = '-'+Math.floor((h/rows)+addTop+1)+'px';					
							break;
					case 'scrollRight':
						height = h;
						width = w;
						marginLeft = -w;					
							break;
					case 'scrollLeft':
						height = h;
						width = w;
						marginLeft = w;					
							break;
					case 'scrollTop':
						height = h;
						width = w;
						marginTop = h;					
							break;
					case 'scrollBottom':
						height = h;
						width = w;
						marginTop = -h;					
							break;
					case 'scrollHorz':
						height = h;
						width = w;
						if(vis==0 && slideI==amountSlide-1) {
							marginLeft = -w;	
						} else if(vis<slideI  || (vis==amountSlide-1 && slideI==0)) {
							marginLeft = w;	
						} else {
							marginLeft = -w;	
						}
							break;
					}
					
			
				var tApp = $('.pixwall_delightappended:eq('+value+')');
								
				if(typeof u !== 'undefined'){
					clearInterval(u);
					setTimeout(canvasLoader,opts.transPeriod+difference);
				}
				
				
				if($(pagination).length){
					$('#pixwall_delight_pag li').removeClass('pixwall_delightcurrent');
					$('#pixwall_delight_pag li').eq(slideI).addClass('pixwall_delightcurrent');
				}
						
				if($(opts.thumbs).length){
					$('li', opts.thumbs).removeClass('pixwall_delightcurrent');
					$('li', opts.thumbs).eq(slideI).addClass('pixwall_delightcurrent');
					$('li', opts.thumbs).not('.pixwall_delightcurrent').find('img').animate({opacity:.5},0);
					$('li.pixwall_delightcurrent img', opts.thumbs).animate({opacity:1},0);
					$('li', opts.thumbs).hover(function(){
						$('img',this).stop(true,false).animate({opacity:1},150);
					},function(){
						if(!$(this).hasClass('pixwall_delightcurrent')){
							$('img',this).stop(true,false).animate({opacity:.5},150);
						}
					});
				}
				
				
						

				function pixwall_delighteased() {
					opts.afterChange.call(this);
					$(this).addClass('pixwall_delighteased');
					$('#pix_credits_pictures').html($('> div', elem).eq(slideI).attr('data-content'));
					if($('.pixwall_delighteased').length>=0){
						thumbnailPos();
					}
					if($('.pixwall_delighteased').length==blocks){
						
						$('.fromLeft, .fromRight, .fromTop, .fromBottom, .fadeIn').each(function(){
							$(this).css('visibility','hidden');
						});
		
						selector.eq(slideI).show().css('z-index','999').addClass('pixwall_delightcurrent');
						selector.eq(vis).css('z-index','1').removeClass('pixwall_delightcurrent');
						$('.pixwall_delightContent').eq(slideI).addClass('pixwall_delightcurrent');
						$('.pixwall_delightContent').eq(vis).removeClass('pixwall_delightcurrent');

						
						$('.pixwall_delightappended').remove();
						elem.removeClass('pixwall_delightsliding');	//I remove this class, that means the effect is finished
							selector.eq(vis).hide();

							$('#pixwall_delight_canvas').animate({opacity:1},0);
							u = setInterval(
								function(){
									if (($.browser.msie && $.browser.version < 9) || opts.loader == 'bar') {
										if(rad<=1.002 && !elem.hasClass('stopped')){
											rad = rad+0.005;
										} else if (rad<=1 && (elem.hasClass('stopped'))){
											rad = rad;
										} else {
											if(!elem.hasClass('stopped'))
												imgFake();
												clearInterval(u);
												$('#pixwall_delight_canvas').animate({opacity:0},200,function(){
													setTimeout(canvasLoader,opts.transPeriod+difference);
													nextSlide();
													opts.onStartLoading.call(this);
												});
										}
										switch(opts.barDirection){
											case 'leftToRight':
												$('#pixwall_delight_canvas').css({'right':$('#pixwall_delight_bar_cont').width()-($('#pixwall_delight_bar_cont').width()*rad)});
												break;
											case 'rightToLeft':
												$('#pixwall_delight_canvas').css({'left':$('#pixwall_delight_bar_cont').width()-($('#pixwall_delight_bar_cont').width()*rad)});
												break;
											case 'topToBottom':
												$('#pixwall_delight_canvas').css({'bottom':$('#pixwall_delight_bar_cont').height()-($('#pixwall_delight_bar_cont').height()*rad)});
												break;
											case 'bottomToTop':
												$('#pixwall_delight_canvas').css({'top':$('#pixwall_delight_bar_cont').height()-($('#pixwall_delight_bar_cont').height()*rad)});
												break;
										}
										
									} else {
										radNew = rad;
										ctx.clearRect(0,0,opts.pieDiameter,opts.pieDiameter);
										ctx.globalCompositeOperation = 'destination-over';
										ctx.beginPath();
										ctx.arc((opts.pieDiameter)/2, (opts.pieDiameter)/2, (opts.pieDiameter)/2-opts.pieStroke,0,Math.PI*2,false);
										ctx.lineWidth = opts.pieStroke;
										ctx.strokeStyle = opts.loaderBgColor;
										ctx.stroke();
										ctx.closePath();
										ctx.globalCompositeOperation = 'source-over';
										ctx.beginPath();
										ctx.arc((opts.pieDiameter)/2, (opts.pieDiameter)/2, (opts.pieDiameter)/2-opts.pieStroke,0,Math.PI*2*radNew,false);
										ctx.lineWidth = opts.pieStroke-4;
										ctx.strokeStyle = opts.loaderColor;
										ctx.stroke();
										ctx.closePath();
												
										if(rad<=1 && !elem.hasClass('stopped')){
											rad = rad+0.005;
										} else if (rad<=1 && (elem.hasClass('stopped'))){
											rad = rad;
										} else {
											if(!elem.hasClass('stopped'))
												imgFake();
												clearInterval(u);
												$('#pixwall_delight_canvas, #pixwall_delight_canvas_wrap').animate({opacity:0},200,function(){
													setTimeout(canvasLoader,opts.transPeriod+difference);
													nextSlide();
													opts.onStartLoading.call(this);
												});
										}
									}
								},(time)*0.005
							);
						}

				}


				
					opts.beforeChange.call(this);
					if(slideOn=='next'){
						tApp.delay((((opts.transPeriod+difference)/blocks)*delay[index]*couples)*0.5).css({
								'display' : 'block',
								'height': height,
								'margin-left': marginLeft,
								'margin-top': marginTop,
								'width': width,
								'opacity' : opacityOnGrid
							}).animate({
								'height': Math.floor((h/rows)+addTop+1),
								'margin-top' : 0,
								'margin-left' : 0,
								'opacity' : 1,
								'width' : Math.floor((w/cols)+addLeft+1)
							},(opts.transPeriod-difference),easing,pixwall_delighteased);
					} else {
						selector.eq(slideI).show().css('z-index','999').addClass('pixwall_delightcurrent');
						selector.eq(vis).css('z-index','1').removeClass('pixwall_delightcurrent');
						$('.pixwall_delightContent').eq(slideI).addClass('pixwall_delightcurrent');
						$('.pixwall_delightContent').eq(vis).removeClass('pixwall_delightcurrent');
						tApp.delay((((opts.transPeriod+difference)/blocks)*delay[index]*couples)*0.5).css({
								'display' : 'block',
								'height': Math.floor((h/rows)+addTop+1),
								'margin-top' : 0,
								'margin-left' : 0,
								'opacity' : 1,
								'width' : Math.floor((w/cols)+addLeft+1)
							}).animate({
								'height': height,
								'margin-left': marginLeft,
								'margin-top': marginTop,
								'width': width,
								'opacity' : opacityOnGrid
							},(opts.transPeriod-difference),easing,pixwall_delighteased);
					}





			});
				
				
				
	 
		}
	}


				if($(opts.prevNav).length){
					$(opts.prevNav).click(function(){
						if(!elem.hasClass('pixwall_delightsliding')){
							var idNum = parseFloat($('.pixwall_delightcurrent',target).index());
							clearInterval(u);
							imgFake();
							canvasLoader();
							if(idNum!=0){
								nextSlide(idNum);
							} else {
								nextSlide(amountSlide);
						   }
						   opts.onStartLoading.call(this);
						}
					});
				}
			
				if($(opts.nextNav).length){
					$(opts.nextNav).click(function(){
						if(!elem.hasClass('pixwall_delightsliding')){
							var idNum = parseFloat($('.pixwall_delightcurrent',target).index()); 
							clearInterval(u);
							imgFake();
							canvasLoader();
							if(idNum==amountSlide-1){
								nextSlide(1);
							} else {
								nextSlide(idNum+2);
						   }
						   opts.onStartLoading.call(this);
						}
					});
				}


				if($(pagination).length){
					$('#pixwall_delight_pag li').click(function(){
						if(!elem.hasClass('pixwall_delightsliding')){
							var idNum = parseFloat($(this).index());
							var curNum = parseFloat($('.pixwall_delightcurrent',target).index());
							if(idNum!=curNum) {
								clearInterval(u);
								imgFake();
								canvasLoader();
								nextSlide(idNum+1);
								opts.onStartLoading.call(this);
							}
						}
					});
				}

				if($(opts.thumbs).length) {

					$('#navgallery_wrapper .pix_thumb img').click(function(){
						if(!elem.hasClass('pixwall_delightsliding')){
							var idNum = parseFloat($(this).parents('li').index());
							var curNum = parseFloat($('.pixwall_delightcurrent').index());
							if(idNum!=curNum) {
								clearInterval(u);
								imgFake();
								$('#pixwall_delight_thumbs .pix_thumb').removeClass('pixwall_delightcurrent');
								$(this).parents('li').addClass('pixwall_delightcurrent');
								canvasLoader();
								nextSlide(idNum+1);
								thumbnailPos();
								opts.onStartLoading.call(this);
							}
						}
					});
				}
		
		
	
}

})(jQuery);
