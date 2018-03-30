///////////////////////////
// MOLITOR SCRIPTS
///////////////////////////
this.molitorscripts = function () {
	
	////////////////
	//VAR SETUP
	////////////////
	var theWindow = jQuery(window),
		htmlBody = jQuery("html,body"),
		backTop = jQuery("a.backTop");
			
	////////////////
	//BACK TOP
	////////////////
	backTop.click(function(){
		htmlBody.animate({scrollTop:0},700);
		return false;
	});
	
	////////////////
	//SEARCH ANIMATION
	////////////////
	jQuery('#searchform').slidinglabels({
        className    : 'slider', // the class you're wrapping the label & input with -> default = slider
		topPosition  : '15px',  // how far down you want each label to start
		leftPosition : '15px',  // how far left you want each label to start
		axis         : 'x',    // can take 'x' or 'y' for slide direction
		speed        : 'fast'  // can take 'fast', 'slow', or a numeric value
	});
	
	////////////////
	//SLIDER ANIMATION
	////////////////
	jQuery(".slider label").fadeIn(300);
	
	///////////////
	//MOLITOR DUAL SLIDER
	//////////////
	var slideSpeed = 800,
		carSlide = jQuery('.slide'),
		firstSlide = carSlide.first(),
		lastSlide = carSlide.last(),
		carNav = jQuery('.sliderNav'),
		carNext = jQuery('.paging .next'),
		carPrev = jQuery('.paging .prev'),
		carPause = jQuery('#molitorCarousel .pause'),
		carPlay = jQuery('#molitorCarousel .play'),
		carNumbers = jQuery('#numbers');
	var sliderTime;
	
	//SELECT FIRST SLIDE
	firstSlide.addClass('selected');
	
	//CREATE SLIDER NUMBERS
	carSlide.each(function(){
		thisSlideID = jQuery(this).attr('id');
		
		carNumbers.append('<a href="#" class="slideLink" id="'+thisSlideID+'Link"></a>');
	});
	
	//SLIDER NUMBERS VAR SETUP
	var slideLink = jQuery('.slideLink'),
		firstSlideLink = slideLink.first(),
		lastSlideLink = slideLink.last();
	
	//SELECT FIRST SLIDER NUMBER
	firstSlideLink.addClass('selected');
	
	//SLIDER NUMBERS CLICK
	slideLink.click(function(){
		var thisLink = jQuery(this),
			thisIndex = thisLink.index(),
			selectedLinkIndex = jQuery('.slideLink.selected').index(),
			selectedSlide = jQuery('.slide.selected'),
			nextSlide = carSlide.eq(thisIndex);
		
		if(thisIndex > selectedLinkIndex){
			pauseSlides();
			selectedSlide.removeClass('selected').find('.slideDetailsWrapper').stop(true,true).fadeOut(slideSpeed);
			selectedSlide.find('.slideMedia').stop(true,true).animate({left:'-100%'},slideSpeed);
			nextSlide.find('.slideDetailsWrapper').stop(true,true).css({display:'none'}).fadeIn(slideSpeed);
			nextSlide.find('.slideMedia').stop(true,true).css({left:'100%'}).animate({left:0},slideSpeed);
		} 
		if(thisIndex < selectedLinkIndex) {
			pauseSlides();
			selectedSlide.removeClass('selected').find('.slideDetailsWrapper').stop(true,true).fadeOut(slideSpeed);
			selectedSlide.find('.slideMedia').stop(true,true).animate({left:'100%'},slideSpeed);
			nextSlide.find('.slideDetailsWrapper').stop(true,true).css({display:'none'}).fadeIn(slideSpeed);
			nextSlide.find('.slideMedia').stop(true,true).css({left:'-100%'}).animate({left:0},slideSpeed);
		}
		
		slideLink.removeClass('selected');
		thisLink.addClass('selected');
		nextSlide.addClass('selected').stop(true,true).css({left:0});
		
		return false;
	});
	
	//NEXT SLIDE FUNCTION
	function nextSlide(){
	var selectedSlide = jQuery('.slide.selected'),
			nextSlide = selectedSlide.next('.slide'),
			selectedNumber = jQuery('.slideLink.selected'),
			nextNumber = selectedNumber.next('.slideLink');
					
		selectedSlide.removeClass('selected').find('.slideDetailsWrapper').stop(true,true).fadeOut(slideSpeed);
		selectedSlide.find('.slideMedia').stop(true,true).animate({left:'-100%'},slideSpeed);
		slideLink.removeClass('selected');
				
		if(nextSlide.length > 0){
			nextSlide.addClass('selected').stop(true,true).css({left:0});
			nextSlide.find('.slideDetailsWrapper').stop(true,true).css({display:'none'}).fadeIn(slideSpeed);
			nextSlide.find('.slideMedia').stop(true,true).css({left:'100%'}).animate({left:0},slideSpeed);
		}else{
			firstSlide.addClass('selected').stop(true,true).css({left:0});
			firstSlide.find('.slideDetailsWrapper').stop(true,true).css({display:'none'}).fadeIn(slideSpeed);
			firstSlide.find('.slideMedia').stop(true,true).css({left:'100%'}).animate({left:0},slideSpeed);
		}
		
		if(nextNumber.length > 0){
			nextNumber.addClass('selected');
		} else {
			firstSlideLink.addClass('selected');
		}
	}
	
	//PREV SLIDE FUNCTION
	function prevSlide(){
		var selectedSlide = jQuery('.slide.selected'),
			prevSlide = selectedSlide.prev('.slide'),
			selectedNumber = jQuery('.slideLink.selected'),
			prevNumber = selectedNumber.prev('.slideLink');
					
		selectedSlide.removeClass('selected').find('.slideDetailsWrapper').stop(true,true).fadeOut(slideSpeed);
		selectedSlide.find('.slideMedia').stop(true,true).animate({left:'100%'},slideSpeed);
		slideLink.removeClass('selected');
				
		if(prevSlide.length > 0){
			prevSlide.addClass('selected').stop(true,true).css({left:0});
			prevSlide.find('.slideDetailsWrapper').stop(true,true).css({display:'none'}).fadeIn(slideSpeed);
			prevSlide.find('.slideMedia').stop(true,true).css({left:'-100%'}).animate({left:0},slideSpeed);
		}else{
			lastSlide.addClass('selected').stop(true,true).css({left:0});
			lastSlide.find('.slideDetailsWrapper').stop(true,true).css({display:'none'}).fadeIn(slideSpeed);
			lastSlide.find('.slideMedia').stop(true,true).css({left:'-100%'}).animate({left:0},slideSpeed);
		}
		
		if(prevNumber.length > 0){
			prevNumber.addClass('selected');
		} else {
			lastSlideLink.addClass('selected');
		}
	}
	
	//NEXT CLICK
	carNext.click(function(){
		nextSlide();
		pauseSlides();
		return false;
	});
	
	//PREV CLICK
	carPrev.click(function(){
		prevSlide();
		pauseSlides();		
		return false;
	});
		
	//PLAY FUNCTION
	function playSlides(){
		sliderTime = setInterval(nextSlide,8000);
   		carPause.show();
		carPlay.hide();
   	}
   	
   	//RUN PLAY FUNCTION
   	playSlides();
   		
   	//PAUSE FUNCTION
   	function pauseSlides(){
   		clearInterval(sliderTime);
		carPause.hide();
		carPlay.show();
   	}
      	
   	//PAUSE CLICK
   	carPause.click(function(){
		pauseSlides();
		return false;
	});
	
	//PLAY CLICK
   	carPlay.click(function(){
   		playSlides();
		return false;
	});	
		
	//SLIDE MEDIA CLICK
	carSlide.find('.slideMedia').click(function(){
		pauseSlides();
	});	
	
	//SLIDER NAV HOVER EFFECT
	carNav.css("opacity",.4).hover(function(){
		jQuery(this).stop(true,true).animate({opacity:1},200);
	},function() {
		jQuery(this).stop(true,true).animate({opacity:.4},200);
	});
	
	////////////////
	//MENU STUFF
	////////////////
	jQuery("#dropmenu ul").css("display", "none"); // Opera Fix
	jQuery("#dropmenu li").hover(function(){
		jQuery(this).find('ul:first').stop(true,true).slideDown(100);
		},function(){
		jQuery(this).find('ul:first').stop(true,true).slideUp(100);
	});
	
	////////////////
	//RESPONSIVE MENU
	////////////////
	// Create the dropdown base
	jQuery("<select id='selectMenu'><select />").appendTo("#navigation");

	// Create default option "Go to..."
	jQuery("<option />", {
	   "selected": "selected",
	   "value"   : "",
	   "text"    : "Menu"
	}).appendTo("#navigation select");

	// Populate dropdown with menu items
	jQuery("#dropmenu a").removeAttr("title").each(function() {
	 	var el = jQuery(this);
	 	
	 	el.parents('.sub-menu').each(function(){
	 		el.prepend('<span class="navDash">-</span>');
	 	});
	 	
	 	jQuery("<option />", {
	  	   "value"   : el.attr("href"),
	     	"text"    : el.text()
	 	}).appendTo("#navigation select");
	});
	
	// Load url when selected
	jQuery("#selectMenu").change(function() {
  		window.location = jQuery(this).find("option:selected").val();
	});
	
	//////////////////
	//RESPONSIVE FUNCTION
	//////////////////
	function responsive(){
		if(theWindow.width() < 960){
			carPause.click();
		}
	}	
	//RUN FUNCTION
	responsive();
	
	//////////////////
	//WINDOW RESIZE
	//////////////////
	theWindow.resize(function(){
		responsive();
	});
}