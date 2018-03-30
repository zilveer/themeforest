jQuery(document).ready(function($) {    


 //GALLERY IMAGES HOVER SCRIPT        
	//add span that will be shown on hover on gallery item
	$(".gallery li a.image, .columns a.image, .lightbox_blog").append('<span class="image_hover"></span>'); //add span to images
	$(".gallery  li a.video, .columns a.video").append('<span class="video_hover"></span>'); //add span to videos

	$('.gallery  li a span, .columns a span').css('opacity', '0').css('display', 'block');
	$('.eventon_list_event a span').css('opacity', '1').css('display', 'block');
	$('.products span').css('opacity', '1').css('display', 'inline-block');
	$('.woocommerce-review-link span').css('opacity', '1').css('display', 'inline-block');
	$('.vc_tta.vc_general .vc_tta-tab span').css('opacity', '1').css('display', 'inline-block');
	$('.next-post span, .prev-post span').css('opacity', '1').css('display', 'inline-block');
	$('.edd-add-to-cart span.edd-add-to-cart-label').css('opacity', '1').css('display', 'inline-block');
	$('.edd-page h2 span').css('opacity', '1').css('display', 'inline-block');
	
	// show / hide span on hover
	$(".gallery li a, .columns a, .lightbox_blog").hover(
		function () {
			 $(this).find('.image_hover, .video_hover').stop().fadeTo('slow', .7); }, 
		function () {
			 $('.image_hover, .video_hover').stop().fadeOut('slow', 0);
	});	
	

	//Remove the lightbox from Blog
	$(".lightbox_not").hover( function(){
	   $('.image_hover').stop().fadeTo('fast', 0); 
	   $('.image_hover').css('display', 'none');
	});
		
	//Lazy Loader 
	if($('.lazy').length) {
		$("img.lazy").lazyload({
			effect: "fadeIn"
		});
	}



	//FORM (CONTACT & COMMENTS) SCRIPTS

		//set variables
		var nameVal = $("#form_name").val();
		var emailVal = $("#form_email").val();
		var websiteVal = $("#form_website").val();
		var messageVal = $("#form_message").val();
				
		//if name field is empty, show label in it
		if(nameVal == '') {
		$("#form_name").parent().find('label').css('display', 'block');	
		}
		
		//if email field is empty, show label in it
		if(emailVal == '') {
		$("#form_email").parent().find('label').css('display', 'block');	
		}
		
		//if website field is empty, show label in it
		if(websiteVal == '') {
		$("#form_website").parent().find('label').css('display', 'block');	
		}
					
		
		//if message field is empty, show label in it
		if(messageVal == '') {
		$("#form_message").parent().find('label').css('display', 'block');	
		}

		$('#contact_form input, #contact_form textarea').parent().find('label').hide();		
		//hide labels on focus		
		$('#contact_form input, #contact_form textarea, #comment_form input, #comment_form textarea').focus(function(){
			//$(this).parent().find('label').fadeOut('fast');		
			if($(this).val() == $(this).parent().find('label').text()){
				$(this).val('');
			}
			//if($(this).is('input')){}
		});		

		$('#subscribe-label, #subscribe-blog-label').css('display', 'block');
		
		//show labels when field is not focused - only if there are no text
		$('#contact_form input, #contact_form textarea, #comment_form input, #comment_form textarea').blur(function(){
			var currentInput = 	$(this);	
			if (currentInput.val() == ""){
   			 //$(this).parent().find('label').fadeIn('fast');
			 currentInput.val($(this).parent().find('label').text());
 			 }
		});		
		
		
	// CONTACT FORM HANDLING SCRIPT - WHEN USER CLICKS "SUBMIT"
	$("#contact_form #form_submit").click(function(){		
				   				 		
		// hide all error messages
		$(".error").hide();
		
		// remove "error" class from text fields
		$("#contact_form input, #contact_form textarea, #comment_form input, #comment_form textarea").focus(function() {
 			$(this).removeClass('error_input');
			$(this).css('border-color','#333');
			});
		
		// remove error messages when user starts typing		
		$("#contact_form input, #contact_form textarea, #comment_form input, #comment_form textarea").keypress(function() {
 			$(this).parent().find('span').fadeOut();	
		});
		
		$("#form_message").keypress(function() {	
			$(this).stop().animate({ 
  			  width: "380px"
 			 }, 100); 
		});
		
		// set variables
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		
		// validate "name" field
		var nameVal = $("#form_name").val();
		if(nameVal == '' || nameVal == $("#form_name").parent().find('label').text()) {
			$("#form_name")
			.after('<span class="error">'+contact_form_name+'</span>')
			.addClass('error_input');
			$('#form_name').css('border-color','#ff0000');
			hasError = true;
		}

	
		// validate "e-mail" field - andd error message and animate border to red color on error
		var emailVal = $("#form_email").val();
		if(emailVal == '') {
			$("#form_email")
			.after('<span class="error">'+contact_form_email+'</span>')
			.addClass('error_input');
			$('#form_email').css('border-color','#ff0000');
			hasError = true; 
				
		} else if(!emailReg.test(emailVal)) {	
			$("#form_email")
			.after('<span class="error">'+contact_form_valid_email+'</span>')
			.addClass('error_input');
			$('#form_email').css('border-color','#ff0000');
			hasError = true;
		}
		
				
		// validate "message" field
		var messageVal = $("#form_message").val();
		if(messageVal == ''|| messageVal == $("#form_message").parent().find('label').text()) {
			
			$("#form_message").stop().animate({ 
  			  	width: "250px"
 			 }, 100 )
			.after('<span class="error comment_error">'+contact_form_message+'</span>')
			.addClass('error_input');
			$('#form_message').css('border-color','#ff0000');
			hasError = true;
		}
		
       // if the are errors - return false
       if(hasError == true) { return false; }
            
		// if no errors are found - submit the form with AJAX
		if(hasError == false) {
			
		var dataString = $('#contact_form').serialize();

			//hide the submit button and show the loader image	
			$("#form_submit").fadeOut('fast', function () {
			$('#contact_form').append('<span id="loader"></span>'); 
			});
			       
			
		// make an Ajax request
        $.ajax({
            type: "POST",
            url: template_directory+"/php/contact-send.php",
            data: dataString,
            success: function(){ 
           
          // on success fade out the form and show the success message
          $('#loader').remove();
          $('#contact_form').children().fadeOut('fast');
          $('.contact_info').fadeOut('fast');
           $('.success').fadeIn();    	
            }
        }); // end ajax

		 return false;  
		} 	
		
	});		
	
	//CONTACT PAGE MAP - CHANGE OPACITY ON HOVER
		$('img.map').css('opacity', '.5');
		
		$('img.map').hover(function(){
			$(this).fadeTo('fast', 1);	
		},
		function(){
			$(this).fadeTo('fast', .5);	
		});
	
	
	// FOOTER TOOLTIPS
	$('.tooltip_link').tipsy({gravity: 's', fade: 'true' });	
	
	
	
//SHORTCODES & ELEMENTS
	
//tabs
$(".tab_content").hide();
$(".tabs_wrap ul.tabs").each(function() {
    $(this).find('li:first').addClass("active");
    $(this).next('.tab_container').find('.tab_content:first').show();
});

$(".tabs_wrap ul.tabs li a").click(function() {
    var cTab = $(this).closest('li');
    cTab.siblings('li').removeClass("active");
    cTab.addClass("active");
    cTab.closest('ul.tabs').nextAll('.tab_container:first').find('.tab_content').hide();

    var activeTab = $(this).attr("href"); //Find the href attribute value to identify the active tab + content
    $(activeTab).fadeIn(); //Fade in the active ID content
    return false;
});


// accordion
	 
$('.accordion div.accordion_content').hide();

$('.accordion div.active_acc').next().show();

$('.accordion div.accordion_head a').click(function(){
	//console.log($(this).parent().next().height());
	if ($(this).parent().hasClass('active_acc')){		
		$(this).parent().removeClass('active_acc').next().slideUp('1000');
	}else {
		$(this).closest('.accordion').find('.active_acc').removeClass('active_acc');
	 	$(this).closest('.accordion').find('.accordion_content').slideUp(); 
		$(this).parent().addClass('active_acc');		
		$(this).parent().next().slideDown('1000');
	}
    return false;
});
  
  
  	//toggls
  	$(".hide").hide();
  	 
  	$(".toggle").click(function(){
  	 
  	$(this).closest(".toggle_box").find(".hide").toggle("fast");
  	
	$(this).toggleClass('active');
  	
  	return false;
  	}); 
	

	//changing class name of comment child class 8/1/2014 Added KS
	$("ul.children").attr('class', 'children no-bullet blog_comments');
	
	// editing padding of parent for grid columns gallery ----
	$('.columns.grid_columns').parent('.pV0H10').css('padding','0 14px');
	
}); //document.ready function ends here

jQuery(window).load(function ($){	
	if(jQuery('body').hasClass('body_about')){
		jQuery('body').append('<div class="grid"></div>');		
	}	
});



//hide tooltip
function hideTips(event) {  
    var saveAlt = $(this).attr('alt');
    var saveTitle = $(this).attr('title');
    if (event.type == 'mouseenter') {
        $(this).attr('title','');
        $(this).attr('alt','');
    } else {
        if (event.type == 'mouseleave'){
            $(this).attr('alt',saveAlt);
            $(this).attr('title',saveTitle);
        }
   }
}

jQuery(document).ready(function($){


	/* Responsive V5 */	
	
	/*
		Code for generating mobile navigation from desktop one ----
	*/	


	$( ".sub-menu > li" ).removeClass('mainNav'); //Fixed for empty child nav in mobile version removing class from child nav "li"	Done By Kumar 8/5/2014
	$( ".sub-menu > li" ).removeClass('no_desc'); //Fixed for empty child nav in mobile version removing class from child nav "li"	Done By Kumar 8/5/2014

	$( "body" ).removeClass('blog'); //Fixed for spacing issue in mobile version header area	Done By Kumar 8/5/2014

	$( "#mainNavigation > ul" ).clone().appendTo( "#cssmenu" );
	
	$('#cssmenu li.mainNav').each(function(i){
		// to set the menu active ----
		//if($(this).children('a').hasClass('current')){
		$(this).find('a.current').parents('li').addClass('active');
		$(this).find('li').each(function(j){
			$(this).find('a').css('margin-left',($(this).parents('li').length)*10);
		});
		//}
		$(this).removeClass('mainNav');
		$(this).children('li a').each(function(i){
			$(this).html('<span>'+$(this).children('h5').text()+'</span>');
		});
		
		
	});	
	// to add a li if the menu item having submenu has link to it----ajay 05112014
	$('#cssmenu li a').each(function(){
		if($(this).next('ul').length && $(this).attr('href')!="#" && $(this).attr('href')!= undefined){
			$(this).next('ul').each(function(){
				//console.log($(this).prev().clone());
				//var aClone = $(this).prev().clone();
				var aLink = $(this).prev().attr('href');
				var aText = $(this).prev().html();
				$(this).prepend('<li class="for-mobile-only"><a href="'+aLink+'" style="margin-left: 10px;">'+aText+'</a></li>');
			});
		}
	});
	//console.log('UL::-- '+mobileUL.html());
	//	$('div#cssmenu > ul').append(mobileUL.html());
	/*
		Mobile nav events handling code ----
	*/	
	$('#cssmenu > ul > li ul').each(function(index, e){
	  var count = $(e).find('>li').length;
	  var content = '<span class="cnt">' + count + '</span>';
	  $(e).closest('li').children('a').append(content);
	});
	$('#cssmenu ul ul li:odd').addClass('odd');
	$('#cssmenu ul ul li:even').addClass('even');
	// to set the selected nav always active ----
	var activeEle = $('#cssmenu li.active');
	
	$('#cssmenu ul li > a').click(function() {
	  //$('#cssmenu li').removeClass('active');	  
	  $(this).closest('li').siblings().removeClass('active');	  
	  $(this).closest('li').siblings().children('li').removeClass('active');
	  activeEle.addClass('active');	  
	  $(this).parent('li').addClass('active');	
	  var checkElement = $(this).next();
	  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
		$(this).parent('li').removeClass('active');
		activeEle.addClass('active');
		checkElement.slideUp('normal');
	  }
	  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {		
		checkElement.closest('li').siblings().children('ul:visible').slideUp('normal');		
		checkElement.slideDown('normal');
	  }
	  if($(this).closest('li').find('ul').children().length == 0) {
		return true;
	  } else {
		return false;	
	  }		
	});
	
	/*
		To show / hide the desktop navigation on arrow button click ----		
	*/
	var isUp = false;
	var navHeight = $('#navContainer').height();
	var hideHeight = navHeight - 50; 

	$('#arrowLink a').click(function(e){
		e.preventDefault();
		navHeight = $('#navContainer').height();
		hideHeight = navHeight - 50; 
		
		$('.tooltip').remove();
		if(!isUp){			
			$(this).find('img').attr('src',template_directory+'/images/menu_hide_arrow_bottom.png');
			$(this).find('img').attr('title',showNav);
			$( "#navContainer" ).animate({			
				top: '-='+ hideHeight + 'px'
			}, 500, "swing", function() {
				isUp = true;
			});	
		}else{
			$(this).find('img').attr('src',template_directory+'/images/menu_hide_arrow_top.png');
			$(this).find('img').attr('title',hideNav);
			$( "#navContainer" ).animate({			
				top: "0"
			}, 500, "swing", function() {
				isUp = false;
			});				


			if($('body').hasClass('body_show_content'))
			{
				 $('#mainContainer').fadeIn();	
			}	
		}
	});

	/* AUTO HIDE MENU @ KS */
	if ($('body').hasClass('body_hiding_menu'))
	{	
		$('#arrowLink a').click();
	}
	
	
	// Tooltip only Text
    $('.masterTooltip').hover(function(){
          // Hover over code
          var title = $(this).attr('title');
          $(this).data('tipText', title).removeAttr('title');
          $('<p class="tooltip"></p>')
          .text(title)
          .appendTo('body')
          .fadeIn('slow');
    }, function() {
          // Hover out code
		  var title = $(this).attr('title');
		  if (typeof title !== 'undefined' && title !== false) {
			 $(this).attr('title', title);	
  		  }else{
			  $(this).attr('title', $(this).data('tipText'));
		  }
          $('.tooltip').remove();
    }).mousemove(function(e) {
          var mousex = e.pageX + 20; //Get X coordinates
          var mousey = e.pageY + 0; //Get Y coordinates
          $('.tooltip').css({ top: mousey, left: mousex })
    });		
	
	
	// to set the content column width 100% in case the content is too short for the screen--
	//var height = $('#mainContainer>.container').height();
	//$(document).bind('DOMSubtreeModified', function() {		
	/*setInterval(function(){
		if($('#mainContainer>.container').height() != height) {
			resizeCustom();
		}
	},500);*/
	//});
	 
	resizeCustom();
	// to make the 50% columns clear left---
	
	$('div.clearColumn').each(function(i){
		if(i % 2 == 0){
			$(this).css('clear', 'left');	
		}else{
			$(this).css('clear', 'none');	
		}
	});

	
});
//--To add wmode in iframes having youtube videos---
function playerReady(){
  
  if(navigator.appName.indexOf("Internet Explorer")!=-1){     //yeah, he's using IE
	setTimeout(function(){
	$("#container iframe").each(function(){
        var ifr_source = $(this).attr('src');
        var wmode = "wmode=opaque";
        if(ifr_source.indexOf('?') != -1) {
            var getQString = ifr_source.split('?');
            var oldString = getQString[1];
            var newString = getQString[0];
            $(this).attr('src',newString+'?'+wmode+'&'+oldString);
        }
        else $(this).attr('src',ifr_source+'?'+wmode);
    });
	},2000);
  }
}


//############# Thumbnail Mouseover Error / HTML FIX ############# //
jQuery(function($) {
		$('a.image, .gallery_colorbox a, .gallery_fancybox a, .gallery_prettyphoto a, .assorted a').hover(function() {
			
			var title = $(this).prop('title'); //getting title attribute  

			var myrRegexp = /<p>(.*?)<\/p>/i,  //regular exp to get between tags text
			match = myrRegexp.exec(title); //executing the march from title
			
			var regex = /(<([^>]+)>)/ig; //regular exp
			var result = title.replace(regex, ""); //removing the html tags
			
			if(match)
			{
			result = result.replace(match[1], ""); //removing the text of p tag (description text)
			}

			$(this).data('orig-title', title).prop('title', result);
		}, function() {  
			$(this).prop('title', $(this).data('orig-title'));
		});

		$("a.image, .gallery_colorbox a, .gallery_fancybox a, .gallery_prettyphoto a, .assorted a").click(function() {
			$(this).prop('title', $(this).data('orig-title'));
		});
});

jQuery(window).resize(resizeCustom);
function resizeCustom(){
	/*if($('#mainContainer>.container').height() <= window.innerHeight){
		$('#mainContainer').height('100%');	
	}else{
		$('#mainContainer').height('auto');	
	}*/
	$('#mainContainer>.container').css('min-height', window.innerHeight);
}

//video aspect ratio 31/3/2015
jQuery(document).ready(function($){
    
	//https://css-tricks.com/NetMag/FluidWidthVideo/Article-FluidWidthVideo.php
	// Find all YouTube videos
    var $allVideos = $("iframe[src^='//player.vimeo.com'], iframe[src^='//www.youtube.com'], object, embed"),


		// The element that is fluid width
		$fluidEl = $("body");

	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {

	  $(this)
		.data('aspectRatio', this.height / this.width)

		// and remove the hard coded width/height
		.removeAttr('height')
		.removeAttr('width');

	});

	// When the window is resized
	$(window).resize(function() {

	  var newWidth = $fluidEl.width();

	  // Resize all videos according to their own aspect ratio
	  $allVideos.each(function() {

		var $el = $(this);
		$el
		  .width(newWidth)
		  .height(newWidth * $el.data('aspectRatio'));

	  });

	// Kick off one resize to fix all videos on page load
	}).resize();
});
