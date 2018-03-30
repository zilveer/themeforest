/**
 * Created by ThemeVan.
 * SimpleKey Jquery functions.
 */
 
var is_admin;

jQuery(function ($) { 
  /*Loading HomePage*/
  if(isLoad==1){
	$('body').css('display','none');
    $('body').jpreLoader({
		loaderVPos: '50%'
	});
  } 

});
 
jQuery(document).ready(function($){
  
  function initPrimaryNavi(){
	    if($(window).width() >= 640) {
		   /*Fix the primary navi when scrolling*/
           if(is_admin==1){
		        $("#sticky-top").sticky({topSpacing:32});
		   }else{
			    $("#sticky-top").sticky({topSpacing:0});
		   }
	   }
	   
       /*Sub menu*/
	   $("ul.sf-menu").superfish({
	       pathLevels:    4 ,
		   delay:         100,
		   autoArrows:    false
	   });
	   
	   
	   /*Mobile menu*/
	   $('#mobileMenu').html($('#primary-menu-container').html());
	   $('#mobileMenu').mobileMenu({
				defaultText: mobileMenuText,
				className: 'select-menu',
				subMenuDash: '&nbsp;&nbsp;'
	   });
	   $(".select-menu").each(function(){  
			$(this).wrap('<div class="css3-selectbox">');
		});
   }
   
   $('#primary-menu-container li').each(function() {
			var i=1;
			if($(this).hasClass('none')) {
			  $(this).remove();
			}
   });
   
   initPrimaryNavi();
   
   /*Init Portfolio block*/
   $('.overlay').hide();
   function initPortfolioBlocks(){
	   $('.portfolio-item').fadeIn();

       var MobileDetect = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/);
	   if(MobileDetect) {
	      $(window).load(function(){
	           $('.portfolio-item').fadeIn();
	      });
	      $('.home .portfolio-item').add('.page .portfolio-item').add('.archive .portfolio-item').click(function(){
	           var permalink=$(this).attr('data-url');
	           $(this).attr('href',permalink);
	           location.href=permalink;
	      });
	   }else{
		   /*Show Portfolios detail*/
		   function portfolioHoverIn(){
		     if($(this).attr('data-hover-image')!==''){
		       $(this).children('.item').find('img').attr('src',$(this).attr('data-hover-image'));
		     }
			 $(this).children('.overlay').fadeIn(200);
			 $(this).children('.tools').fadeIn(200);
		   }
		   /*Hide Portfolios detail*/
		   function portfolioHoverOut(){
		     if($(this).attr('data-hover-image')!==''){
		       $(this).children('.item').find('img').attr('src',$(this).attr('data-original-image'));
		     }
			 $(this).children('.overlay').fadeOut();
		     $(this).children('.tools').fadeOut();
		   }
	       $('.portfolio-item').hoverIntent({
				 sensitivity: 2,
				 interval: 20,
				 over: portfolioHoverIn,
				 timeout: 0,
				 out: portfolioHoverOut
		   });
		   $('.portfolio-item a.overlay').click(function(){
		       $(this).fadeOut();
			   $(this).next('.tools').fadeOut();
		   });
	   }
	   
	   function portfolio_isotope(){
		 if($(window).width() <= 1024 && isResponsive==1) {
				//Set Portfolio Height on Mobile
				var portfolioWidth=$('.portfolio-item').width();
				$('.portfolio-item').css('height',portfolioWidth+'px');
		 }
	   }
	   $(window).load(function(){portfolio_isotope();});
	   $(window).resize(function(){portfolio_isotope();});
	   
		
		//Ajax load content
		if(!MobileDetect) {
		  $('.portfolio-item a.ajax').click(function(){
			 var url=$(this).parent().attr('data-url');
			 if(url!==''){
				if(isNiceScroll==1){
				   if($(window).width() >= 640) {
					$("body").getNiceScroll().hide();
				   }
				}
				portfolioTop = $(this).parent().offset().top;
				$("#ajax-load").slideDown();
				ajaxload('#ajax-content',url,'#single-content');
				//Load effects
				$('.flexslider').flexslider();
			 }
		  });
		}
			$("#ajax-load #close").click(function(){
				$('html,body').animate({scrollTop:portfolioTop-100},'slow');
				$("#ajax-load").slideUp();
				$('#ajax-content').html('');
				if(isNiceScroll==1){
				 if($(window).width() >= 640) {
					$("body").getNiceScroll().show();
				 }
				}else{
					$("body").css('overflow','auto');
				};
			});

		
   }initPortfolioBlocks();
   
   /*Init Team block*/
   function initTeamBlocks(){
	   /*Show Portfolio's detail*/
	   function TeamHoverIn(){
		   $(this).children('.overlay').fadeIn();
	   }
	   /*Hide Portfolio's detail*/
	   function TeamHoverOut(){
		   $(this).children('.overlay').fadeOut();
	   }
	   $('.member .avatar').hoverIntent({
			 sensitivity: 2,
			 interval: 100,
			 over: TeamHoverIn,
			 timeout: 0,
			 out: TeamHoverOut
	   })
   }initTeamBlocks();
  
   /*Parallax Effect*/
   if(isParallax==1){
	   $('.parallax').each(function(){
			 if($(window).width()>768){
			   $(this).parallax("50%", 0.5);
			 }else{
			    $(this).css("background-attachment%", "scroll");
			 }
	   });
	   
	   function getSectionHeight(){
		   $('.parallax[style*="background"]').each(function(){
			 if($(window).width()>1024){
			   $(this).parallax("50%", 0.5);
			 }else{
			    $(this).css("background-attachment", "scroll");
				$(this).css("background-size", "auto");
			 }
		   });
	   }   
	   $(window).scroll(function() {getSectionHeight();}); 
	   $(window).resize(function() {getSectionHeight();});  
	   $(window).load(function() {getSectionHeight();}); 
   }


   function initPageScroll(){
	   /*Smooth Scroll to section*/
	   $('#primary-menu').localScroll({
		target:'body',
		duration:1000,
		queue:true,
		hash:true,
		easing:'easeInOutExpo',
		offset: {left: 0, top: -55}
	   });
	   
	//Detecting page scroll and set the navigation link active status
	if($('body').hasClass('home')){
		$(window).scroll(function() {
	
			var currentNode = null;
			$('.page-area').each(function(){
				var currentId = $(this).attr('id');	
				if($(window).scrollTop() >= $('#'+currentId).offset().top - 79)
				{
					currentNode = currentId;
				}
			});
			$('#primary-menu li').removeClass('current-menu-item').find('a[href="#'+currentNode+'"]').parent().addClass('current-menu-item').closest('.sub-menu').parent().addClass('current-menu-item');
		});
	}
	   
	   /*Smooth scroll event*/
	   if(isNiceScroll==1){
		 if($(window).width() >= 640) {
			$("body,html").niceScroll({
			   cursorcolor:"#000",
			   scrollspeed:50,
			   mousescrollstep:50,
			   horizrailenabled:false,
			   autohidemode:false,
			   cursorwidth:8,
			   zindex:999
			});
	     }	
	   }
	 
	 /*Top shrink*/
	 $(window).scroll(function() {
	        if($(document).scrollTop() > $('#top').height()-90){
		      $('#primary-menu').addClass('shrink');
			}else{
			  $('#primary-menu').removeClass('shrink');
			}
			if($('#top').height()==0 || $('#top').height()==69)$('#primary-menu').removeClass('shrink');
	 });
   }initPageScroll();
   
   /*Flex slider*/
   $('.flexslider').flexslider({
	   slideshow:true,
	   video: true,
	   keyboard: true,
	   smoothHeight:true,
       multipleKeyboard: true,
       prevText: "",
	   nextText: ""
   });

   /*Display the slider background on mobile & tablet*/
   $(window).load(function() {
	  if(isResponsive==1){
	   if($(window).width() <= 1024 && $(window).width() >= 768) {
		 replaceSliderBg('data-ipad');
	   }
	   if($(window).width() <= 640) {
		 replaceSliderBg('data-mobile');
	   }
	  }
   });
   
   function replaceSliderBg(data){
     $('.slide_bg').each(function() {
         var newSrc=$(this).children('img').attr(data);
	     if(newSrc!==''){
           $(this).children('img').attr('src',newSrc);
	     }
     });
   }
   
   /*Lightbox*/
   $('a.lightbox').colorbox({
      maxWidth:"100%"
   });
   
   $('.wpb_single_image a').colorbox({
	  maxWidth:"98%"
   });
   
   $('.attachment a').colorbox({
	  maxWidth:"98%"
   });
   $('.gallery-icon a').colorbox({
	  maxWidth:"98%",
	  onComplete:function(){
	     $('body').css('overflow','auto');
	  }
   });
   $(".iframe_window").colorbox({iframe:true, width:"98%", height:"98%"});
   
   /*Lazyload*/
   if (navigator.platform == "iPad") return;
   $("img").lazyload({
       effect:"fadeIn",
       placeholder: pixel
   });
   
   /*Placeholder for IE*/
   $("input, textarea").placeholder();
   
   /*Display back to top button*/
	$(window).scroll(function(){
	  if($(document).scrollTop()==0){
		  $('#backtoTop').hide();
	  }else{
	      $('#backtoTop').show();
	  }
	});
	/*Back to Top*/
	$('#backtoTop').click(function(){
		$('body').animate({scrollTop:0},'slow');
		return false;
	});
	
	function resizeCenterWrapper(){
	  if($(window).width()<=640){
	    $('.centerWrapper').css('width','100%');
	  }
	}
	$(window).load(function(){resizeCenterWrapper();});
	$(window).resize(function(){resizeCenterWrapper();});

   
   /*Ajax load*/
   function ajaxload(id,url,object) { 
	$(id).addClass("loader"); 
	$.ajax({ 
		type: "get", 
		url: url, 
		cache: false, 
		error: function() {(id).html('Loading error!');}, 
		success: function(data) { 
			$(id).removeClass("loader"); 
            $("body").css({"overflow":"hidden"});
			$("#ajax-load").css({"overflow":"auto"});
			$content=$(data).find(object).html();
			$(id).append($content);
			//Load effects
			$('.flexslider').flexslider({prevText: "",nextText: ""});
			$('.attachment a').colorbox({ maxWidth:"98%",onComplete:function(){ $('body').css('overflow','auto'); }});
            $('#ajax-content .gallery-icon a').colorbox({ maxWidth:"98%",onComplete:function(){ $('body').css('overflow','auto'); }});
            $('#ajax-content a.lightbox').colorbox({ maxWidth:"98%",onComplete:function(){ $('body').css('overflow','auto'); }});
		}
	}); 
   }
   
   /*Reset Custom heading Style*/
	function rep_heading_style(obj){
		$('.vc_custom_heading').children(obj).each(function(){  
		 var heading_style=$(this).attr('style');
		  var new_style="";
	
		  if(heading_style.indexOf('right')>0){
			   new_style=";float:right;margin-top:0;padding-right:0;";
		  }
		  if(heading_style.indexOf('left')>0){
			   new_style=";padding-left:0;";
		  }
		  if(heading_style.indexOf('center')>0){
			   new_style=";float:none;margin:auto";
		  }
		  $(this).attr('style',heading_style+new_style);
		});
	}
	rep_heading_style('h2');
	rep_heading_style('h3');
	rep_heading_style('h4');
	rep_heading_style('h5');
	rep_heading_style('h6');
	rep_heading_style('div');
	rep_heading_style('p');
	
	/*Woocommerce cart*/
	$('.woocommerce ul.products li.product a img').hover(function(){
		$(this).parent().next().show();
	},function(){
		$(this).parent().next().hide();
	});
	$('.woocommerce ul.products li.product .button.add_to_cart_button').hover(function(){
		$(this).show();
	},function(){
		$(this).hide();
	});
    
    /*Force the slider width to 100%*/
    $('.fullwidthbanner-container').css('width','100%');
})