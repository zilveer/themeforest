jQuery.noConflict(); jQuery(document).ready(function(){

	//VAR SETUP
	var rightBg = jQuery('#rightBg'),
		boxStuff = jQuery('.boxStuff'),
		bgControls = jQuery("#bgControls"),
		nextImg = jQuery('#nextImg'),
		prevImg = jQuery('#prevImg'),
		blogNav = jQuery('#blogNav'),
		navBox = jQuery("#navBox"),
		navBoxa = jQuery("#navBox a"),
		navHeight = navBox.height(),
		firstImg = jQuery('.wrapperli:first-child'),
		lastImg = jQuery('.wrapperli:last-child');
	
	//CLOSE FUNCTION
	function closeSesame(){
		jQuery('.activeBox').fadeOut(600,function(){
			navBox.animate({right:"0%",marginRight:"20px"},800).removeClass('openNav');
			jQuery(".activeNav").removeClass('activeNav');
			rightBg.animate({width:"0%"},800);//HIDE RIGHT BG
			bgControls.fadeIn(600);
		}).removeClass('activeBox');
	}
	
	//OPEN FUNCTION
	function openSesame(){
		navBox.addClass("openNav").animate({right:"50%",marginRight:"2px"},800);//ADD OPEN NAV
		rightBg.animate({width:"50%"},800,function(){//SHOW RIGHT BG
			jQuery('.activeBox').fadeIn(600);//ADD ACTIVE BOX & FADE IN
			navBox.fadeIn(600);
		});
		bgControls.fadeOut(300);
	}
	
	//OPACITY STUFF
	rightBg.css({opacity:".85"});
	
	//REMOVE TITLE ATTRIBUTE
	jQuery("#dropmenu a").removeAttr("title");

	//MENU
	jQuery("#dropmenu ul").css("display", "none"); // Opera Fix
	jQuery("#dropmenu li").hover(function(){
		jQuery(this).find('ul:first').show();
	},function(){
		jQuery(this).find('ul:first').hide();
	});
	jQuery("#dropmenu ul li ul").parent().children("a").prepend("<span style='float:right;'>&rsaquo;</span>");
		
		
	//WINDOW LOAD
	jQuery(window).load(function(){
		//REMOVE WIDTH AND HEIGHT ATTRIBUTES FROM IMAGES
		jQuery('.attachment-full, .attachment-post-thumbnail, .attachment-gallery').removeAttr('height').removeAttr('width');
		
		//LOAD MESH BG
		jQuery('#mesh').fadeIn(600);
		
		//HIDE LOADER
		jQuery('.pace').fadeOut(1000);
		
		//IF GALLERY PAGE
		if(jQuery('body').hasClass('page-template-page_gallery-php')){
			navBox.fadeIn(600);
			bgControls.fadeIn(600);
			jQuery(".wrapperli:first-child a").click();
		//IF NOT GALLERY PAGE
		} else { 
			openSesame();			
		}
	});
	
	//FADE CRUMBS IN/OUT ON SCROLL
	jQuery('#pageContent').scroll(function(){
		if(jQuery('#pageContent').scrollTop()>150){
			blogNav.fadeOut(300);
		} else {	
			blogNav.fadeIn(300);
		}
	});	

	//NAV BOX STUFF
	navBox.css({marginTop:"-"+navHeight/2+"px"});
	boxStuff.css({marginTop:"-"+navHeight/2+"px"});

	//NAV BUTTON CLICK
	navBoxa.click(function(){
		
		//VAR SETUP
		var thisBox = jQuery(this).attr('href');
			
		//IF ACTIVE LINK, CLOSE STUFF
		if(jQuery(this).hasClass('activeNav')){
			closeSesame();
			return false;
		
		//IF NOT ACTIVE LINK
		}else{
			
			//IF CONTENT OPEN
			if(navBox.hasClass("openNav")){
				navBoxa.removeClass('activeNav');//REMOVE CURRENT ACTIVE NAV
				jQuery(this).addClass('activeNav');//ADD NEW ACTIVE NAV
				jQuery('.activeBox').removeClass('activeBox').fadeOut(300,function(){//REMOVE CURRENT ACTIVE BOX & FADE OUT
					jQuery(thisBox).addClass('activeBox').fadeIn(300);//ADD NEW ACTIVE BOX & FADE IN
				});
			
			//IF CONTENT NOT OPEN
			} else {
				jQuery(this).addClass('activeNav');//ADD ACTIVE NAV
				jQuery(thisBox).addClass('activeBox');
				openSesame();
			}
		}
	});
	
	//CLICKING GALLERY IMG
	jQuery(".wrapperli a").click(function(){
		
		//GET HREF
		var galleryHref = jQuery(this).attr('href'),
			galleryTitle = jQuery(this).attr('title'),
			imageInfo = jQuery('#imgInfo'),
			itemNumber = jQuery(this).parent().index() + 1;
			numberItems = jQuery('.wrapperli').length;
				
		//CHANGE TITLE INFO	
		if(galleryTitle){
			imageInfo.hide().html(galleryTitle + "&nbsp / &nbsp"+ itemNumber + " of " + numberItems).fadeIn(150);
		} else {
			imageInfo.hide();
		}
		
		//CHANGE CLASSES
		jQuery(".wrapperli").not(this).removeClass('activeImg');
		jQuery(this).parent().addClass('activeImg');
		
		//IF MENU OPEN, CLOSE IT
		if(navBox.hasClass("openNav")){ closeSesame(); }
		
		//CHANGE BACKGROUND
		jQuery.backstretch(galleryHref, {speed: 300});

		return false;
	});
	
	//NEXT CONTROLS
	nextImg.click(function(){
		var activeImg = jQuery('.activeImg');
		if(activeImg.length > 0){
			if(activeImg.next().length > 0){
				activeImg.removeClass('activeImg').next().addClass('activeImg').children().click();
			} else {
				activeImg.removeClass('activeImg');
				firstImg.addClass('activeImg').children().click();
			}
		} else {
			firstImg.addClass('activeImg').children().click();
		}
		return false;
	});
	
	//PREV CONTROLS
	prevImg.click(function(){
		var activeImg = jQuery('.activeImg');
		if(activeImg.length > 0){
			if(activeImg.prev().length > 0){
				activeImg.removeClass('activeImg').prev().addClass('activeImg').children().click();
			} else {
				activeImg.removeClass('activeImg');
				lastImg.addClass('activeImg').children().click();
			}
		} else {
			firstImg.addClass('activeImg').children().click();
		}
		return false;
	});
	
	// Keyboard shortcuts
    jQuery(document).keydown(function(e) {
    	var unicode = e.charCode ? e.charCode : e.keyCode;    	
        if (unicode == 39) { nextImg.click();} // right arrow
        else if (unicode == 37) {prevImg.click();} // left arrow
    });
    
});