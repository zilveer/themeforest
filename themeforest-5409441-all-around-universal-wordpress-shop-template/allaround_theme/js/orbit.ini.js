jQuery(document).ready(function($){

/***************** Sliders ******************/

	var sliderAdvanceSpeed = parseInt($('#featured').attr('data-advance-speed'));
	var sliderAnimationSpeed = parseInt($('#featured').attr('data-animation-speed'));
	var sliderAutoplay = parseInt($('#featured').attr('data-autoplay'));
	
	if( isNaN(sliderAdvanceSpeed) ) { sliderAdvanceSpeed = 5500;}
	if( isNaN(sliderAnimationSpeed) ) { sliderAnimationSpeed = 800;}
	
	var $yPos;
	
		    controlsAndInfoPos();

			$('body:not(.mobile) .orbit-wrapper #featured .slide article').css({'background-position': 'center ' + ((- $scrollTop / 5)+logoHeight+headerPadding2+extraHeight-extraDef)  + 'px' });
	
	var img_urls=[];
	$('[style*="background"]').each(function() {
	    var style = $(this).attr('style');
	    var pattern = /background.*?url\('(.*?)'\)/g
	    var match = pattern.exec(style);
	    if (match) {        
	        img_urls.push(match[1]);
	    }
	});
	
	var imgArray = [];
	
	for(i=0;i<img_urls.length;i++){
		imgArray[i] = new Image();
		imgArray[i].src = img_urls[i];
	}
	

	$(window).load(function(){
		
		//home slider
		 $('#featured').orbit({
         	 animation: 'fade',
         	 advanceSpeed: sliderAdvanceSpeed,
         	 animationSpeed: sliderAnimationSpeed, 
         	 timer: sliderAutoplay
    	 });
    	 
    	 $('#featured article .post-title h2 span').show();
    	

    	////swipe for home slider
    	$('#featured').swipe({
    		swipeLeft : function(e) {
				$('.left').trigger('click');
				e.stopImmediatePropagation();
				return false;
			 },
			 swipeRight : function(e) {
				$('.right').trigger('click');
				e.stopImmediatePropagation();
				return false;
			 }    
    	})
    	
    	customSliderHeight();
		sliderAfterSetup();
    	
    	////gallery slider span add
		$('.flex-gallery .flex-direction-nav li a').append('<span>');

	});
	
	
	//home slider height
	var sliderHeight = parseInt($('#featured').attr('data-slider-height'));
	if( isNaN(sliderHeight) ) { sliderHeight = 650 } else { sliderHeight = sliderHeight -12 }; 

	function customSliderHeight(){
		if(!$('body').hasClass('mobile')){
			$('#featured').attr('style', 'height: '+sliderHeight+'px !important');
			$('#featured article').css('height',sliderHeight+'px')
		}
		else {
			$('#featured').attr('style', 'height: '+sliderHeight+'px');
		}
	}
	
	customSliderHeight();
	
	
	//home slider bg color
	if( $('#featured').length > 0 ){
		var sliderBackgroundColor = $('#featured').attr('data-bg-color');
		if( sliderBackgroundColor.length == 0 ) sliderBackgroundColor = '#000000'; 
		
		$('#featured article').css('background-color',sliderBackgroundColor);
	}
	
/***************** Parallax Slider ******************/
	
	//take into account header height when calculating the controls and info positioning 
	var logoHeight = parseInt($('#header-outer').attr('data-logo-height'));
	var headerPadding = parseInt($('#header-outer').attr('data-padding'));
	var headerPadding2 = parseInt($('#header-outer').attr('data-padding'));
	var extraDef = 15;
	var headerResize = $('#header-outer').attr('data-header-resize');
	var extraHeight = ($('#wpadminbar').length > 0) ? 28 : 0; //admin bar
	var usingLogoImage = true;

	if( isNaN(logoHeight) ) { usingLogoImage = false; logoHeight = 30;}
	if( isNaN(headerPadding) ) { headerPadding = 28; headerPadding2 = 28;}
	if( headerResize.length == 0 ) {headerPadding2 = headerPadding*2; extraDef = 0;}

	var $captionPos = (((sliderHeight-70)/2 - $('div.slider-nav span.left span.white').height()/2) + logoHeight + headerPadding*2 + extraHeight) - 50;
	var $controlsPos = (((sliderHeight-70)/2 - $('div.slider-nav span.left span.white').height()/2) + logoHeight + headerPadding*2 + extraHeight) -70;
	
	var $scrollTop;
	
	//inital load
	function sliderAfterSetup(){
		$('body:not(.mobile) .orbit-wrapper #featured .orbit-slide article .container').css('top', $captionPos +"px");
		$('body:not(.mobile) .orbit-wrapper .slider-nav > span').css('top', $controlsPos +"px");	
		$('body:not(.mobile) .orbit-wrapper #featured .slide article').css({'background-position': 'center ' + ((- $scrollTop / 5)+logoHeight+headerPadding2+extraHeight-extraDef)  + 'px' });
	}
	
	//dynamic controls and info positioning
	function controlsAndInfoPos(){
		$scrollTop = $(window).scrollTop();
		
		$('body:not(.mobile) .orbit-wrapper #featured .orbit-slide article .container').css({ 
			'opacity' : 1-($scrollTop/400),
			'top' : ($scrollTop*-0.4) + $captionPos +"px"
		});
		
		$('body:not(.mobile) .orbit-wrapper .slider-nav > span').css({ 
			'opacity' : 1-($scrollTop/400),
			'top' : ($scrollTop*-0.4) + $controlsPos +"px"
		});
	}
	
	if( $('#featured').length > 0 ){
	
		$(window).scroll(function(){
		   
		    controlsAndInfoPos();

			$('body:not(.mobile) .orbit-wrapper #featured .slide article').css({'background-position': 'center ' + ((- $scrollTop / 5)+logoHeight+headerPadding2+extraHeight-extraDef)  + 'px' });	
		});
		
		//disable parallax for mobile
		$(window).resize(function(){
			if($('body').hasClass('mobile')){
				$('.orbit-wrapper #featured article').css('backgroundPosition','center 60%');
			}
			
			else {
				$('.orbit-wrapper #featured article').css('backgroundPosition','center ' + ((- $scrollTop / 5)+logoHeight+headerPadding2+extraHeight-extraDef)  + 'px');
			}
			
			customSliderHeight();
		});
		
	}
});