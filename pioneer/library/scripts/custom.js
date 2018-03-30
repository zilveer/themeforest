var $ = jQuery.noConflict();

document.createElement("figure");
document.createElement("article");
document.createElement("aside");
document.createElement("footer");
document.createElement("header");
document.createElement("hgroup");
document.createElement("section");
document.createElement("nav");






/*
 *  Cookies
=========================================*/
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}


/* -------------------------------------------------------------------------*/
/*
function hoverPortfolio(){
	jQuery('.portfolio-items li ').hover(function(){
		width = jQuery('.portfolio-items li ').width() - 60;
		offset = width + 80;
		jQuery(this).find('.post-info').css({'left':-offset, 'width':width});
		
		jQuery(this).find('.p-enlarge').fadeIn(300);
		jQuery(this).find('.portfolio-meta').fadeIn(300);
		jQuery(this).find('img').stop().fadeTo('300',0.1);
		jQuery(this).find('.post-info').stop().animate({'left':'20','opacity':'1'},500, 'easeOutQuad');
		},function(){
		//jQuery(this).find('.post-info').fadeOut('fast');
		jQuery(this).find('img').stop().fadeTo('fast',1);
		jQuery(this).find('.portfolio-meta').fadeOut();
		jQuery(this).find('.p-enlarge').fadeOut();
		jQuery(this).find('.post-info').stop().animate({'opacity':'0'},300, function(){
			jQuery(this).css({'left':-offset});
			});
		});
}

function hidecontent(){
		jQuery('#wrapper:visible').fadeOut('fast');
		jQuery('#hidecontent').hide();
		jQuery('#showcontent').show();		
	}

function showcontent(){
		jQuery('#wrapper:hidden').fadeIn('fast');
		jQuery('#showcontent').hide();
		jQuery('#hidecontent').show();
	}

*/






/* Document ready 
====================================*/

jQuery(document).ready(function($){



jQuery("#primary_select > select").uniform();
jQuery('#primary-select').change(function(){
    //alert('url = ' + this.value);
    window.location.href = this.value;
  })


jQuery('#fader').hide();

jQuery('#fader').fadeIn(500); 
jQuery('.preloader').delay(300).hide(); 


var ix = 0;
jQuery('#menu-primary > li > a').each(function(){
		ix++;
		var startIndex = 50;
		var newIndex = startIndex - ix;
		jQuery(this).css({'zIndex': newIndex});
		});


jQuery('#menu-primary li .sub-menu').hover(function(){
	 
	 if (jQuery(this).parent().find('li').children().length > 0 ) {
	 
	 curIndex = jQuery(this).parent().find('a').css('zIndex');
	 newIndex = jQuery(this).parent().prev().find('a').css('zIndex');
	 jQuery(this).parent().find('a').css({'zIndex': newIndex + 1});
	 }
	 },function() {
	 jQuery(this).parent().find('a').css({'zIndex': curIndex});
	 
  	});


jQuery('#menu-primary li a').hover(function(){
	 
	curIndex = jQuery(this).css('zIndex');
	newIndex = jQuery(this).parent().prev().find('a').css('zIndex');
	//nextIndex = jQuery(this).parent().next().find('a').css('zIndex');
	jQuery(this).parent().next().find('#menu-primary li.current-menu-item a').css({'zIndex': newIndex + 10});
	
	
	 	 jQuery(this).css({'zIndex': newIndex + 2});
	 /*	 
	 if ( jQuery(this).parent().find('li').children().length == 0 ) {
	 	jQuery(this).addClass('noSub');
	 	 }
	 */
	 },function() {
	 jQuery(this).css({'zIndex': curIndex});
	
  	});

var prevIndex = jQuery('#menu-primary li.current-menu-item a').parent().prev().find('a').css('zIndex');	
jQuery('#menu-primary li.current-menu-item a, #menu-primary li.current-menu-ancestor a').css({'zIndex': prevIndex + 5 });





jQuery('.module-teaserpages .page').hover(function(){
	
	jQuery(this).find('img').animate({rotate: '360deg'}, 400);
	 },function() {
  	jQuery(this).find('img').animate({rotate: '0deg'}, 0);
 });



jQuery('a#goback').click(function(){
	
	history.back();
	return false;

	});
	
jQuery('#registertoggle').click(function(){
	
	jQuery('#registerform:hidden').slideDown();
	return false;

	});
	

jQuery('.infobtn').click(function(){
	
	jQuery(this).parent().parent().find('.post-meta-popup').slideDown();
	return false;
	});
	
jQuery('.close-info-popup').click(function(){
	
	jQuery(this).parent().slideUp();
	return false;
	});


jQuery('#hidecontent').click(function(){
	
	hidecontent();
	return false;
	});
	
	
	
jQuery('#showcontent').click(function(){ 
	
		showcontent();
		return false;
	});
		
	

jQuery("a[data-rel^='prettyPhoto[gall]']").prettyPhoto();


jQuery('.epicgallery').each(function () {
        jQuery(this).epicGallery();
    });

jQuery('.fullscreen_gallery_container').epicGalleryFullscreen(); 

jQuery.fn.equalizeHeights = function(){
  return this.height( Math.max.apply(this, jQuery(this).map(function(i,e){ return jQuery(e).height() }).get() ) )
}

jQuery.fn.setAllToMaxHeight = function(){
return this.height( Math.max.apply(this, jQuery.map( this , function(e){ return jQuery(e).height()}) ) );
}		
		
//jQuery('div.equal').equalizeHeights();
//jQuery('.portfolio-items li .post-info').setAllToMaxHeight();
		
				
				
jQuery('.portfoliofilter li:first').addClass('current-menu-item');

// get the action filter option item on page load
  var $filterType = jQuery('.portfoliofilter li.current-menu-item a').attr('class');
  var $holder = jQuery('ul.portfolio-items');
  var $data = $holder.clone();
  var $link = $('.portfoliofilter li a')

  // attempt to call Quicksand when a filter option
  // item is clicked
  $link.click(function(e) {
   
    // reset the active class on all the buttons
    jQuery('.portfoliofilter li').removeClass('current-menu-item');

    var $filterType = jQuery(this).attr('class');
    
    jQuery(this).parent().addClass('current-menu-item');
    
    if ($filterType == 'showall') {
       var $filteredData = $data.find('li');
    }
    else {
      var $filteredData = $data.find('li[data-type~=' + $filterType + ']');
    }

    // call quicksand and assign transition parameters
    $holder.quicksand($filteredData, {
      duration: 800,
      adjustHeight: 'dynamic',
      easing: 'easeInOutQuad',
      enhancement: function() {
      	//hoverPortfolio();
      	jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    	}
      });
    
    
    return false;
  });

	//hoverPortfolio();
			

var sidebarHeight = jQuery(".slider-widget").height();
var slideHeight =  jQuery(".slide").height();

  jQuery(".slider-widget").height(slideHeight - 30);





// Add tooltip to social media icons
jQuery('.socialicons > li > a').simpletooltip();





jQuery('span.caption').setAllToMaxHeight();	




jQuery('.breakline a').click(function(){
	jQuery('html, body').animate({scrollTop: jQuery("#wrapper").offset().top}, 1000);
	return false;
});





jQuery('span.caption').setAllToMaxHeight();

/*
jQuery('#epic_gallery_wrap').hover(function(){

	jQuery('#epic_gallery_nav').fadeIn();
	},function(){
	jQuery('#epic_gallery_nav').fadeOut();
	});
*/


jQuery('#epic_gallery_nav li a').css({'opacity':'0.4'});
jQuery('#epic_gallery_nav li.activeSlide a').css({'opacity':'1'});

jQuery('#epic_gallery_nav li a').click(function(){
	jQuery('#epic_gallery_nav li a').css({'opacity':'0.4'});
	jQuery('#epic_gallery_nav li.activeSlide a').css({'opacity':'1'});
});




primaryHover();





}); /* End document.ready */


/*
// Fix z-indexing issues in internet explorer 8.0
if(jQuery.browser.msie && jQuery.browser.version=="8.0"){
jQuery(function() {
	var zIndexNumber = 1000;
	jQuery('div').not('#slideshow-fixed div').each(function() {
		jQuery(this).css('zIndex', zIndexNumber);
		zIndexNumber -= 10;
	});
});
}

*/

  
  
 
function primaryHover(){
	
		jQuery("#menu-primary .sub-menu").hover(function(){
			jQuery(this).parent().find("a").addClass("active");
			},function(){
			jQuery(this).parent().find("a").removeClass("active");
			
		});
	
}


/*********************
//* jQuery Multi Level CSS Menu #2- By Dynamic Drive: http://www.dynamicdrive.com/
//* Last update: Nov 7th, 08': Limit # of queued animations to minmize animation stuttering
//* Menu avaiable at DD CSS Library: http://www.dynamicdrive.com/style/
*********************/

//Update: April 12th, 10: Fixed compat issue with jquery 1.4x

//Specify full URL to down and right arrow images (23 is padding-right to add to top level LIs with drop downs):


// Run the script...
//var siteurl = jQuery("meta[name=siteurl]").attr('content');
var arrowimages={down:['downarrowclass', '/library/images/arrow_down.png', 18], right:['rightarrowclass', '/library/images/arrow_right.png']}

var jqueryslidemenu={

animateduration: {over: 200, out: 100}, //duration of slide in/ out animation, in milliseconds

buildmenu:function(menuid, arrowsvar){
	jQuery(document).ready(function($){
		var $mainmenu= jQuery("#"+menuid+">ul")
		var $headers= $mainmenu.find("ul").parent()
		$headers.each(function(i){
			var $curobj=$(this)
			var $subul=$(this).find('ul:eq(0)')
			this._dimensions={w:this.offsetWidth, h:this.offsetHeight, subulw:$subul.outerWidth(), subulh:$subul.outerHeight()}
			this.istopheader=$curobj.parents("ul").length==1? true : false
			$subul.css({top:this.istopheader? this._dimensions.h+"px" : 0})
			/*
			$curobj.children("a:eq(0)").css(this.istopheader? {paddingRight: arrowsvar.down[2]} : {}).append(
				'<img src="'+ (this.istopheader? arrowsvar.down[1] : arrowsvar.right[1])
				+'" class="' + (this.istopheader? arrowsvar.down[0] : arrowsvar.right[0])
				+ '" style="border:0;" />'
			)
			*/
			$curobj.hover(
				function(e){
					var $targetul=$(this).children("ul:eq(0)")
					this._offsets={left:jQuery(this).offset().left, top:jQuery(this).offset().top}
					var menuleft=this.istopheader? 0 : this._dimensions.w
					menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>$(window).width())? (this.istopheader? -this._dimensions.subulw+this._dimensions.w : -this._dimensions.w) : menuleft
					if ($targetul.queue().length<=1) //if 1 or less queued animations
						$targetul.css({left:menuleft+"px", width:this._dimensions.subulw+'px'}).slideDown(jqueryslidemenu.animateduration.over)
				},
				function(e){
					var $targetul=$(this).children("ul:eq(0)")
					$targetul.slideUp(jqueryslidemenu.animateduration.out)
				}
			) //end hover
			$curobj.click(function(){
				jQuery(this).children("ul:eq(0)").hide()
			})
		}) //end $headers.each()
		$mainmenu.find("ul").css({display:'none', visibility:'visible'})
	}) //end document.ready
}
}

//build menu with ID="primary" on page:
//jqueryslidemenu.buildmenu("primary", arrowimages),
//jqueryslidemenu.buildmenu("secondary", arrowimages);








/* 
 * Cross-browser event handling, by Scott Andrew
 */
function addEvent(element, eventType, lamdaFunction, useCapture) {
    if (element.addEventListener) {
        element.addEventListener(eventType, lamdaFunction, useCapture);
        return true;
    } else if (element.attachEvent) {
        var r = element.attachEvent('on' + eventType, lamdaFunction);
        return r;
    } else {
        return false;
    }
}

/*
 * Clear Default Text: functions for clearing and replacing default text in
 * <input> elements.
 *
 * by Ross Shannon, http://www.yourhtmlsource.com/
 */

addEvent(window, 'load', init, false);

function init() {
    var formInputs = document.getElementsByTagName('input');
    for (var i = 0; i < formInputs.length; i++) {
        var theInput = formInputs[i];
        
        if (theInput.type == 'text' && theInput.className.match(/\bcleardefault\b/)) {  
            /* Add event handlers */          
            addEvent(theInput, 'focus', clearDefaultText, false);
            addEvent(theInput, 'blur', replaceDefaultText, false);
            
            /* Save the current value */
            if (theInput.value != '') {
                theInput.defaultText = theInput.value;
            }
        }
    }
}

function clearDefaultText(e) {
    var target = window.event ? window.event.srcElement : e ? e.target : null;
    if (!target) return;
    
    if (target.value == target.defaultText) {
        target.value = '';
    }
}

function replaceDefaultText(e) {
    var target = window.event ? window.event.srcElement : e ? e.target : null;
    if (!target) return;
    
    if (target.value == '' && target.defaultText) {
        target.value = target.defaultText;
    }
}



// OPEN LINKS IN NEW WINDOW
jQuery(function() {
	jQuery('a[rel*=external]').click( function() {
		window.open(this.href);
		return false;
	});
});


/**
*
*	simpleTooltip jQuery plugin, by Marius ILIE
*	visit http://dev.mariusilie.net for details
*
**/
(function($){ $.fn.simpletooltip = function(){
	return this.each(function() {
		var text = $(this).attr("title");
		$(this).attr("title", "");
		if(text != undefined) {
			$(this).hover(function(e){
				var tipX = e.pageX - 100;
				var tipY = e.pageY - 70;
				$(this).attr("title", ""); 
				$("body").append("<div id='simpleTooltip' style='position:absolute; z-index: 9999; display: none;'><p>" + text + "</p></div>");
				if($.browser.msie) var tipWidth = $("#simpleTooltip").outerWidth(true)
				else var tipWidth = $("#simpleTooltip").width()
				$("#simpleTooltip").width(tipWidth);
				$("#simpleTooltip").css("left", tipX).css("top", tipY).fadeIn("medium");
			}, function(){
				$("#simpleTooltip").remove();
				$(this).attr("title", text);
			});
			
			$(this).mousemove(function(e){
				var tipX = e.pageX - 100;
				var tipY = e.pageY - 70;
				var tipWidth = $("#simpleTooltip").outerWidth(true);
				var tipHeight = $("#simpleTooltip").outerHeight(true);
				if(tipX + tipWidth > $(window).scrollLeft() + $(window).width()) tipX = e.pageX - tipWidth;
				if($(window).height()+$(window).scrollTop() < tipY + tipHeight) tipY = e.pageY - tipHeight;
				$("#simpleTooltip").css("left", tipX).css("top", tipY).fadeIn("medium");
			});
			
		}
	});
}})(jQuery);



/**
 * jQuery.ScrollTo - Easy element scrolling using jQuery.
 * Copyright © 2007-2009 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 5/25/2009
 * @author Ariel Flesler
 * @version 1.4.2
 *
 * http://flesler.blogspot.com/2007/10/jqueryscrollto.html
 */
;(function(d){var k=d.scrollTo=function(a,i,e){d(window).scrollTo(a,i,e)};k.defaults={axis:'xy',duration:parseFloat(d.fn.jquery)>=1.3?0:1};k.window=function(a){return d(window)._scrollable()};d.fn._scrollable=function(){return this.map(function(){var a=this,i=!a.nodeName||d.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!i)return a;var e=(a.contentWindow||a).document||a.ownerDocument||a;return d.browser.safari||e.compatMode=='BackCompat'?e.body:e.documentElement})};d.fn.scrollTo=function(n,j,b){if(typeof j=='object'){b=j;j=0}if(typeof b=='function')b={onAfter:b};if(n=='max')n=9e9;b=d.extend({},k.defaults,b);j=j||b.speed||b.duration;b.queue=b.queue&&b.axis.length>1;if(b.queue)j/=2;b.offset=p(b.offset);b.over=p(b.over);return this._scrollable().each(function(){var q=this,r=d(q),f=n,s,g={},u=r.is('html,body');switch(typeof f){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)){f=p(f);break}f=d(f,this);case'object':if(f.is||f.style)s=(f=d(f)).offset()}d.each(b.axis.split(''),function(a,i){var e=i=='x'?'Left':'Top',h=e.toLowerCase(),c='scroll'+e,l=q[c],m=k.max(q,i);if(s){g[c]=s[h]+(u?0:l-r.offset()[h]);if(b.margin){g[c]-=parseInt(f.css('margin'+e))||0;g[c]-=parseInt(f.css('border'+e+'Width'))||0}g[c]+=b.offset[h]||0;if(b.over[h])g[c]+=f[i=='x'?'width':'height']()*b.over[h]}else{var o=f[h];g[c]=o.slice&&o.slice(-1)=='%'?parseFloat(o)/100*m:o}if(/^\d+$/.test(g[c]))g[c]=g[c]<=0?0:Math.min(g[c],m);if(!a&&b.queue){if(l!=g[c])t(b.onAfterFirst);delete g[c]}});t(b.onAfter);function t(a){r.animate(g,j,b.easing,a&&function(){a.call(this,n,b)})}}).end()};k.max=function(a,i){var e=i=='x'?'Width':'Height',h='scroll'+e;if(!d(a).is('html,body'))return a[h]-d(a)[e.toLowerCase()]();var c='client'+e,l=a.ownerDocument.documentElement,m=a.ownerDocument.body;return Math.max(l[h],m[h])-Math.min(l[c],m[c])};function p(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);


/*
 * Pause jQuery plugin v0.1
 *
 * Copyright 2010 by Tobia Conforto <tobia.conforto@gmail.com>
 *
 * Based on Pause-resume-animation jQuery plugin by Joe Weitzel
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or(at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 */
 

(function(){var e=jQuery,f="jQuery.pause",d=1,b=e.fn.animate,a={};function c(){return new Date().getTime()}e.fn.animate=function(k,h,j,i){var g=e.speed(h,j,i);g.complete=g.old;return this.each(function(){if(!this[f]){this[f]=d++}var l=e.extend({},g);b.apply(e(this),[k,e.extend({},l)]);a[this[f]]={run:true,prop:k,opt:l,start:c(),done:0}})};e.fn.pause=function(){return this.each(function(){if(!this[f]){this[f]=d++}var g=a[this[f]];if(g&&g.run){g.done+=c()-g.start;if(g.done>g.opt.duration){delete a[this[f]]}else{e(this).stop();g.run=false}}})};e.fn.resume=function(){return this.each(function(){if(!this[f]){this[f]=d++}var g=a[this[f]];if(g&&!g.run){g.opt.duration-=g.done;g.done=0;g.run=true;g.start=c();b.apply(e(this),[g.prop,e.extend({},g.opt)])}})}})();


// Epic gallery


(function ($) {
    // Fetch the image
    $.fn.image = function (src, f) {
        return this.each(function () {
            var i = new Image();
            i.onload = f;
            i.src = src;
            this.appendChild(i);
        });
    }
    

    $.fn.epicGallery = function (targetId) {
        var target = $(this),
            targetId = $(this).attr('id'),
            targetObj = "#" + targetId,
            loaderObj = "#" + targetId + "-loader",
            loader = '.loader';
        // Load First image
        var $imageNum = 0;
        var $maxslides = $(this).find('.inlinegallery li').size(); // Get number of images
        var imageurl = $(this).find('.' + targetId + '-link_0 a').attr('href');
        var imageheight = $(this).find('.' + targetId + '-link_0 a').attr('data-rel');
		 
        var previousBtn = '.button_prev'; // Previous slide button
        var nextBtn = '.button_next'; // Previous slide button
        
        $('#nav li a:first').addClass('active');
        
        // Inline gallery initial setup
        $(targetObj + ' .postgallery').append('<div class="gallery_backdrop"></div><div id="' + loaderObj + '" class="loader"></div>');
        
       
        
        $(targetObj).find('.loader').image(imageurl, function () {
        $('.loader').find('img').clone().appendTo('.gallery_backdrop').css({'width': '100%', 'height':'100%'});	
        });
        $(targetObj).find('.loader img').animate({
            'height': imageheight + 'px'
        },500, function(){
			   
			  });
        //$(".gallery_caption").html('<p><span class="captiontitle">' + imagecaption + '</span>' + imagedescription + '</p>' );
        //galleryCaptionIn();
        $('#' + targetId).find('.button_next').click(function (e) {
            $imageNum++;
            if ($imageNum == $maxslides) {
                $imageNum = 0;
            }
            slide();
            return false;
        });
        $('#' + targetId).find('.button_prev').click(function (e) {
            $imageNum--;
            if ($imageNum < 0) {
                $imageNum = $maxslides - 1;
            }
            slide();
            return false;
        });
        
        $('#nav li a').click(function(e) {
        	
        	//$(this).addClass('active');
        	$imageNum = $(this).attr('data-rel');
        		slide();
            return false;
        });
        
        
        // This is where the actual slide is done

        function slide() {
        		$('#nav li a').removeClass('active');
        		
        		
			    var previmageheight = $('.' + targetId + '-link_' + $imageNum - 1 + ' a').html();
				imageheight = $('.' + targetId + '-link_' + $imageNum + ' a').attr('data-rel');
				imageurl = $('.' + targetId + '-link_' + $imageNum + ' a').attr('href');
				            
            //$(targetObj).find('.button_prev').fadeOut('fast');
			//$(targetObj).find('.button_down').fadeOut('fast');
            
            
            $(targetObj).find('.loader').animate({
                'opacity': '0'
            }, 300, function () {
			 
					
					document.getElementById(loaderObj).innerHTML = ''; // Clear image
					 
                	$(targetObj).find('.loader').image(imageurl, function () {
                		
                											
                        $(targetObj).find('.loader').animate({
                            'opacity': '1'
                        }, 500, function(){
                        	$(targetObj).animate({'height': imageheight + 'px'}, 300, function(){
                        	$('.gallery_backdrop').find('img').remove();
                        	$('.loader').find('img').clone().appendTo('.gallery_backdrop');
                        	
                        });
						//$(targetObj).find('.button_prev').fadeIn('fast');
						//$(targetObj).find('.button_down').fadeIn('fast');
                     	$('#nav .' + targetId + '-link_' + $imageNum + ' a').addClass('active');
                     	
                });
                																	  
			  });
               
            });
        }

    };
})(jQuery);



/* Fullscreen gallery */

(function ($) {
    // Fetch the image
    $.fn.image = function (src, f) {
        return this.each(function () {
            var i = new Image();
            i.onload = f;
            i.src = src;
            this.appendChild(i);
        });
    }
    

    $.fn.epicGalleryFullscreen = function (targetId) {
        var target = $(this),
            targetId = $(this).attr('id'),
            targetObj = "#" + targetId,
            loaderObj = "#" + targetId + "-loader",
            loader = '.loader';
        // Load First image
        var $imageNum = 0;
        var $maxslides = $(this).find('.inlinegallery li').size(); // Get number of images
        var imageurl = $(this).find('.' + targetId + '-link_0 a').attr('href');
                
		
		var imagecaption =  $(this).find('.' + targetId + '-link_0 a').attr('data-title');
		var imagedescription = $(this).find('.' + targetId + '-link_0 a').attr('data-description');
		
        var previousBtn = '.fg_prev'; // Previous slide button
        var nextBtn = '.fg_next'; // Previous slide button
        
        $('.inlinegallery li a:first').addClass('active');
        
        // Inline gallery initial setup
        $(targetObj + ' .postgallery').append('<div class="gallery_backdrop"></div><div id="' + loaderObj + '" class="loader"></div>');
        
        $(targetObj).find('.loader').image(imageurl, function () {
        	$('.loader > img').clone().appendTo('.gallery_backdrop');
        	$(".gallery_backdrop img").fullBg();
        	$(".loader img").fullBg();
        		
        });
      
        $(".gallery_caption").html('<h3>' + imagecaption + '</h3><p>' + imagedescription + '</p>' );
        
        //galleryCaptionIn();
        $('#' + targetId).find('.fg_next').click(function (e) {
        	$('.inlinegallery li a').removeClass('active');
        	
            $imageNum++;
           
            if ($imageNum == $maxslides) {
                $imageNum = 0;
            }
            
             $('.inlinegallery li:nth-child('+ ($imageNum + 1) +') a').addClass('active');
             
            hidecontent();
        	$('#showcontent').fadeIn();
            slide();
            return false;
        });
        $('#' + targetId).find('.fg_prev').click(function (e) {
        	
        	$('.inlinegallery li a').removeClass('active');
        	
            $imageNum--;
            
            if ($imageNum < 0) {
                $imageNum = $maxslides - 1;
            }
            $('.inlinegallery li:nth-child('+ ($imageNum + 1) + ') a').addClass('active');
            hidecontent();
        	$('#showcontent').fadeIn();
            slide();
            return false;
        });
        
        
        
        $('.inlinegallery li a').click(function(e) {
        	
        	$('.inlinegallery li a').removeClass('active');
        	$(this).addClass('active');
        	$imageNum = $(this).attr('data-count');
        	hidecontent();
        	$('#hidecontent, #showcontent').fadeIn();
        	slide();
        	
            return false;
        });
        
        
        // This is where the actual slide is done

        function slide() {
        
        	$(".gallery_caption").html('');
        	
        	var imagecaption =  $('.' + targetId + '-link_' + $imageNum + ' a').attr('data-title');
			var imagedescription = $('.' + targetId + '-link_' + $imageNum + ' a').attr('data-description');
		
        	$(".gallery_caption").html('<h3>' + imagecaption + '</h3><p>' + imagedescription + '</p>' );
        	
        	
        	$('#preloader').fadeIn();
        	$(".gallery_backdrop img").fullBg();
        	
        	//$('#nav li a').removeClass('active');
        		
        	imageurl = $('.' + targetId + '-link_' + $imageNum + ' a').attr('href');
		            
            $(targetObj).find('.loader').animate({
                'opacity': '0'
            }, 200, function () {
				
					$('.loader > img').remove();
					
					 
                	$(targetObj).find('.loader').image(imageurl, function () {
                		$('#preloader').fadeOut('fast'); 
                		$(".loader img").fullBg();
                		   											
                        $(targetObj).find('.loader').animate({
                            'opacity': '1'
                        }, 1000, function(){
                                
                                                
                        	$('.gallery_backdrop').find('img').remove();
                        	$('.loader > img').clone().appendTo('.gallery_backdrop');
                        	$(".gallery_backdrop img").fullBg();
                        });
 	
                });
   
            });
        }

    };
})(jQuery);

/**
 * jQuery.fullBg
 * Version 1.0
 * Copyright (c) 2010 c.bavota - http://bavotasan.com
 * Dual licensed under MIT and GPL.
 * Date: 02/23/2010
**/
(function($) {
  $.fn.fullBg = function(){
    var bgImg = $(this);		
 
    function resizeImg() {
      var imgwidth = bgImg.width();
      var imgheight = bgImg.height();
 
      var winwidth = $(window).width();
      var winheight = $(window).height();
 
      var widthratio = winwidth / imgwidth;
      var heightratio = winheight / imgheight;
 
      var widthdiff = heightratio * imgwidth;
      var heightdiff = widthratio * imgheight;
 
      if(heightdiff>winheight) {
        bgImg.css({
          width: winwidth+'px',
          height: heightdiff+'px'
        });
      } else {
        bgImg.css({
          width: widthdiff+'px',
          height: winheight+'px'
        });		
      }
    } 
    resizeImg();
    $(window).resize(function() {
      resizeImg();
    }); 
  };
})(jQuery)

jQuery(function(){
    //Get our elements for faster access and set overlay width
    var div = jQuery('#thumbs'),
                 ul = jQuery('ul.inlinegallery'),
                 // unordered list's left margin
                 ulPadding = 10;

    //Get menu width
    var divWidth = div.width();

    //Remove scrollbars
    div.css({overflow: 'hidden'});

    //Find last image container
    var lastLi = ul.find('li:last-child');

    //When user move mouse over menu
    div.mousemove(function(e){

      //As images are loaded ul width increases,
      //so we recalculate it each time
      var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + ulPadding;
      var left = (e.pageX - div.offset().left) * (ulWidth-divWidth) / divWidth;
      div.scrollLeft(left);
    });
});

(function(a,b){function g(a,b){return(new Date(a,b+1,0)).getDate()}function h(a,b){a=""+a,b=b||2;while(a.length<b)a="0"+a;return a}function k(a,b,c){var d=a.getDate(),e=a.getDay(),g=a.getMonth(),k=a.getFullYear(),l={d:d,dd:h(d),ddd:f[c].shortDays[e],dddd:f[c].days[e],m:g+1,mm:h(g+1),mmm:f[c].shortMonths[g],mmmm:f[c].months[g],yy:String(k).slice(2),yyyy:k},m=b.replace(i,function(a){return a in l?l[a]:a.slice(1,a.length-1)});return j.html(m).html()}function l(a){return parseInt(a,10)}function m(a,b){return a.getFullYear()===b.getFullYear()&&a.getMonth()==b.getMonth()&&a.getDate()==b.getDate()}function n(a){if(a===b)return;if(a.constructor==Date)return a;if(typeof a=="string"){var c=a.split("-");if(c.length==3)return new Date(l(c[0]),l(c[1])-1,l(c[2]));if(!/^-?\d+$/.test(a))return;a=l(a)}var d=new Date;return d.setDate(d.getDate()+a),d}function o(d,h){function M(b,c,e){z=b,w=b.getFullYear(),x=b.getMonth(),y=b.getDate(),e=e||a.Event("api"),e.type="beforeChange",G.trigger(e,[b]);if(e.isDefaultPrevented())return;d.val(k(b,c.format,c.lang)),e.type="change",G.trigger(e),d.data("date",b),i.hide(e)}function N(b){b.type="onShow",G.trigger(b),a(document).bind("keydown.d",function(b){if(b.ctrlKey)return!0;var c=b.keyCode;if(c==8)return d.val(""),i.hide(b);if(c==27||c==9)return i.hide(b);if(a(e).index(c)>=0){if(!C)return i.show(b),b.preventDefault();var f=a("#"+p.weeks+" a"),g=a("."+p.focus),h=f.index(g);g.removeClass(p.focus);if(c==74||c==40)h+=7;else if(c==75||c==38)h-=7;else if(c==76||c==39)h+=1;else if(c==72||c==37)h-=1;return h>41?(i.addMonth(),g=a("#"+p.weeks+" a:eq("+(h-42)+")")):h<0?(i.addMonth(-1),g=a("#"+p.weeks+" a:eq("+(h+42)+")")):g=f.eq(h),g.addClass(p.focus),b.preventDefault()}return c==34?i.addMonth():c==33?i.addMonth(-1):c==36?i.today():(c==13&&(a(b.target).is("select")||a("."+p.focus).click()),a([16,17,18,9]).index(c)>=0)}),a(document).bind("click.d",function(b){var c=b.target;!a(c).parents("#"+p.root).length&&c!=d[0]&&(!t||c!=t[0])&&i.hide(b)})}var i=this,j=new Date,o=j.getFullYear(),p=h.css,q=f[h.lang],r=a("#"+p.root),s=r.find("#"+p.title),t,u,v,w,x,y,z=d.attr("data-value")||h.value||d.val(),A=d.attr("min")||h.min,B=d.attr("max")||h.max,C,D;A===0&&(A="0"),z=n(z)||j,A=n(A||new Date(o+h.yearRange[0],1,1)),B=n(B||new Date(o+h.yearRange[1]+1,1,-1));if(!q)throw"Dateinput: invalid language: "+h.lang;if(d.attr("type")=="date"){var D=d.clone(),E=D.wrap("<div/>").parent().html(),F=a(E.replace(/type/i,"type=text data-orig-type"));h.value&&F.val(h.value),d.replaceWith(F),d=F}d.addClass(p.input);var G=d.add(i);if(!r.length){r=a("<div><div><a/><div/><a/></div><div><div/><div/></div></div>").hide().css({position:"absolute"}).attr("id",p.root),r.children().eq(0).attr("id",p.head).end().eq(1).attr("id",p.body).children().eq(0).attr("id",p.days).end().eq(1).attr("id",p.weeks).end().end().end().find("a").eq(0).attr("id",p.prev).end().eq(1).attr("id",p.next),s=r.find("#"+p.head).find("div").attr("id",p.title);if(h.selectors){var H=a("<select/>").attr("id",p.month),I=a("<select/>").attr("id",p.year);s.html(H.add(I))}var J=r.find("#"+p.days);for(var K=0;K<7;K++)J.append(a("<span/>").text(q.shortDays[(K+h.firstDay)%7]));a("body").append(r)}h.trigger&&(t=a("<a/>").attr("href","#").addClass(p.trigger).click(function(a){return h.toggle?i.toggle():i.show(),a.preventDefault()}).insertAfter(d));var L=r.find("#"+p.weeks);I=r.find("#"+p.year),H=r.find("#"+p.month),a.extend(i,{show:function(b){if(d.attr("readonly")||d.attr("disabled")||C)return;b=b||a.Event(),b.type="onBeforeShow",G.trigger(b);if(b.isDefaultPrevented())return;a.each(c,function(){this.hide()}),C=!0,H.unbind("change").change(function(){i.setValue(I.val(),a(this).val())}),I.unbind("change").change(function(){i.setValue(a(this).val(),H.val())}),u=r.find("#"+p.prev).unbind("click").click(function(a){return u.hasClass(p.disabled)||i.addMonth(-1),!1}),v=r.find("#"+p.next).unbind("click").click(function(a){return v.hasClass(p.disabled)||i.addMonth(),!1}),i.setValue(z);var e=d.offset();return/iPad/i.test(navigator.userAgent)&&(e.top-=a(window).scrollTop()),r.css({top:e.top+d.outerHeight({margins:!0})+h.offset[0],left:e.left+h.offset[1]}),h.speed?r.show(h.speed,function(){N(b)}):(r.show(),N(b)),i},setValue:function(c,d,e){var f=l(d)>=-1?new Date(l(c),l(d),l(e==b||isNaN(e)?1:e)):c||z;f<A?f=A:f>B&&(f=B),typeof c=="string"&&(f=n(c)),c=f.getFullYear(),d=f.getMonth(),e=f.getDate(),d==-1?(d=11,c--):d==12&&(d=0,c++);if(!C)return M(f,h),i;x=d,w=c,y=e;var k=new Date(c,d,1-h.firstDay),o=k.getDay(),r=g(c,d),t=g(c,d-1),D;if(h.selectors){H.empty(),a.each(q.months,function(b,d){A<new Date(c,b+1,1)&&B>new Date(c,b,0)&&H.append(a("<option/>").html(d).attr("value",b))}),I.empty();var E=j.getFullYear();for(var F=E+h.yearRange[0];F<E+h.yearRange[1];F++)A<new Date(F+1,0,1)&&B>new Date(F,0,0)&&I.append(a("<option/>").text(F));H.val(d),I.val(c)}else s.html(q.months[d]+" "+c);L.empty(),u.add(v).removeClass(p.disabled);for(var G=o?0:-7,J,K;G<(o?42:35);G++)J=a("<a/>"),G%7===0&&(D=a("<div/>").addClass(p.week),L.append(D)),G<o?(J.addClass(p.off),K=t-o+G+1,f=new Date(c,d-1,K)):G>=o+r?(J.addClass(p.off),K=G-r-o+1,f=new Date(c,d+1,K)):(K=G-o+1,f=new Date(c,d,K),m(z,f)?J.attr("id",p.current).addClass(p.focus):m(j,f)&&J.attr("id",p.today)),A&&f<A&&J.add(u).addClass(p.disabled),B&&f>B&&J.add(v).addClass(p.disabled),J.attr("href","#"+K).text(K).data("date",f),D.append(J);return L.find("a").click(function(b){var c=a(this);return c.hasClass(p.disabled)||(a("#"+p.current).removeAttr("id"),c.attr("id",p.current),M(c.data("date"),h,b)),!1}),p.sunday&&L.find(p.week).each(function(){var b=h.firstDay?7-h.firstDay:0;a(this).children().slice(b,b+1).addClass(p.sunday)}),i},setMin:function(a,b){return A=n(a),b&&z<A&&i.setValue(A),i},setMax:function(a,b){return B=n(a),b&&z>B&&i.setValue(B),i},today:function(){return i.setValue(j)},addDay:function(a){return this.setValue(w,x,y+(a||1))},addMonth:function(a){var b=x+(a||1),c=g(w,b),d=y<=c?y:c;return this.setValue(w,b,d)},addYear:function(a){return this.setValue(w+(a||1),x,y)},destroy:function(){d.add(document).unbind("click.d").unbind("keydown.d"),r.add(t).remove(),d.removeData("dateinput").removeClass(p.input),D&&d.replaceWith(D)},hide:function(b){if(C){b=a.Event(),b.type="onHide",G.trigger(b),a(document).unbind("click.d").unbind("keydown.d");if(b.isDefaultPrevented())return;r.hide(),C=!1}return i},toggle:function(){return i.isOpen()?i.hide():i.show()},getConf:function(){return h},getInput:function(){return d},getCalendar:function(){return r},getValue:function(a){return a?k(z,a,h.lang):z},isOpen:function(){return C}}),a.each(["onBeforeShow","onShow","change","onHide"],function(b,c){a.isFunction(h[c])&&a(i).bind(c,h[c]),i[c]=function(b){return b&&a(i).bind(c,b),i}}),h.editable||d.bind("focus.d click.d",i.show).keydown(function(b){var c=b.keyCode;return!C&&a(e).index(c)>=0?(i.show(b),b.preventDefault()):b.shiftKey||b.ctrlKey||b.altKey||c==9?!0:b.preventDefault()}),n(d.val())&&M(z,h)}a.tools=a.tools||{version:"1.2.6"};var c=[],d,e=[75,76,38,39,74,72,40,37],f={};d=a.tools.dateinput={conf:{format:"mm/dd/yy",selectors:!1,yearRange:[-5,5],lang:"en",offset:[0,0],speed:0,firstDay:0,min:b,max:b,trigger:0,toggle:0,editable:0,css:{prefix:"cal",input:"date",root:0,head:0,title:0,prev:0,next:0,month:0,year:0,days:0,body:0,weeks:0,today:0,current:0,week:0,off:0,sunday:0,focus:0,disabled:0,trigger:0}},localize:function(b,c){a.each(c,function(a,b){c[a]=b.split(",")}),f[b]=c}},d.localize("en",{months:"January,February,March,April,May,June,July,August,September,October,November,December",shortMonths:"Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec",days:"Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday",shortDays:"Sun,Mon,Tue,Wed,Thu,Fri,Sat"});var i=/d{1,4}|m{1,4}|yy(?:yy)?|"[^"]*"|'[^']*'/g,j=a("<a/>");a.expr[":"].date=function(b){var c=b.getAttribute("type");return c&&c=="date"||!!a(b).data("dateinput")},a.fn.dateinput=function(b){if(this.data("dateinput"))return this;b=a.extend(!0,{},d.conf,b),a.each(b.css,function(a,c){!c&&a!="prefix"&&(b.css[a]=(b.css.prefix||"")+(c||a))});var e;return this.each(function(){var d=new o(a(this),b);c.push(d);var f=d.getInput().data("dateinput",d);e=e?e.add(f):f}),e?e:this}})(jQuery),function(a){function e(a,b){var c=Math.pow(10,b);return Math.round(a*c)/c}function f(a,b){var c=parseInt(a.css(b),10);if(c)return c;var d=a[0].currentStyle;return d&&d.width&&parseInt(d.width,10)}function g(a){var b=a.data("events");return b&&b.onSlide}function h(b,c){function y(a,f,g,h){g===undefined?g=f/m*q:h&&(g-=c.min),r&&(g=Math.round(g/r)*r);if(f===undefined||r)f=g*m/q;if(isNaN(g))return d;f=Math.max(0,Math.min(f,m)),g=f/m*q;if(h||!j)g+=c.min;j&&(h?f=m-f:g=c.max-g),g=e(g,s);var i=a.type=="click";if(x&&k!==undefined&&!i){a.type="onSlide",w.trigger(a,[g,f]);if(a.isDefaultPrevented())return d}var l=i?c.speed:0,t=i?function(){a.type="change",w.trigger(a,[g])}:null;return j?(o.animate({top:f},l,t),c.progress&&p.animate({height:m-f+o.height()/2},l)):(o.animate({left:f},l,t),c.progress&&p.animate({width:f+o.width()/2},l)),k=g,n=f,b.val(g),d}function z(){j=c.vertical||f(i,"height")>f(i,"width"),j?(m=f(i,"height")-f(o,"height"),l=i.offset().top+m):(m=f(i,"width")-f(o,"width"),l=i.offset().left)}function A(){z(),d.setValue(c.value!==undefined?c.value:c.min)}var d=this,h=c.css,i=a("<div><div/><a href='#'/></div>").data("rangeinput",d),j,k,l,m,n;b.before(i);var o=i.addClass(h.slider).find("a").addClass(h.handle),p=i.find("div").addClass(h.progress);a.each("min,max,step,value".split(","),function(a,d){var e=b.attr(d);parseFloat(e)&&(c[d]=parseFloat(e,10))});var q=c.max-c.min,r=c.step=="any"?0:c.step,s=c.precision;if(s===undefined)try{s=r.toString().split(".")[1].length}catch(t){s=0}if(b.attr("type")=="range"){var u=b.clone().wrap("<div/>").parent().html(),v=a(u.replace(/type/i,"type=text data-orig-type"));v.val(c.value),b.replaceWith(v),b=v}b.addClass(h.input);var w=a(d).add(b),x=!0;a.extend(d,{getValue:function(){return k},setValue:function(b,c){return z(),y(c||a.Event("api"),undefined,b,!0)},getConf:function(){return c},getProgress:function(){return p},getHandle:function(){return o},getInput:function(){return b},step:function(b,e){e=e||a.Event();var f=c.step=="any"?1:c.step;d.setValue(k+f*(b||1),e)},stepUp:function(a){return d.step(a||1)},stepDown:function(a){return d.step(-a||-1)}}),a.each("onSlide,change".split(","),function(b,e){a.isFunction(c[e])&&a(d).bind(e,c[e]),d[e]=function(b){return b&&a(d).bind(e,b),d}}),o.drag({drag:!1}).bind("dragStart",function(){z(),x=g(a(d))||g(b)}).bind("drag",function(a,c,d){if(b.is(":disabled"))return!1;y(a,j?c:d)}).bind("dragEnd",function(a){a.isDefaultPrevented()||(a.type="change",w.trigger(a,[k]))}).click(function(a){return a.preventDefault()}),i.click(function(a){if(b.is(":disabled")||a.target==o[0])return a.preventDefault();z();var c=j?o.height()/2:o.width()/2;y(a,j?m-l-c+a.pageY:a.pageX-l-c)}),c.keyboard&&b.keydown(function(c){if(b.attr("readonly"))return;var e=c.keyCode,f=a([75,76,38,33,39]).index(e)!=-1,g=a([74,72,40,34,37]).index(e)!=-1;if((f||g)&&!(c.shiftKey||c.altKey||c.ctrlKey))return f?d.step(e==33?10:1,c):g&&d.step(e==34?-10:-1,c),c.preventDefault()}),b.blur(function(b){var c=a(this).val();c!==k&&d.setValue(c,b)}),a.extend(b[0],{stepUp:d.stepUp,stepDown:d.stepDown}),A(),m||a(window).load(A)}a.tools=a.tools||{version:"1.2.6"};var b;b=a.tools.rangeinput={conf:{min:0,max:100,step:"any",steps:0,value:0,precision:undefined,vertical:0,keyboard:!0,progress:!1,speed:100,css:{input:"range",slider:"slider",progress:"progress",handle:"handle"}}};var c,d;a.fn.drag=function(b){return document.ondragstart=function(){return!1},b=a.extend({x:!0,y:!0,drag:!0},b),c=c||a(document).bind("mousedown mouseup",function(e){var f=a(e.target);if(e.type=="mousedown"&&f.data("drag")){var g=f.position(),h=e.pageX-g.left,i=e.pageY-g.top,j=!0;c.bind("mousemove.drag",function(a){var c=a.pageX-h,e=a.pageY-i,g={};b.x&&(g.left=c),b.y&&(g.top=e),j&&(f.trigger("dragStart"),j=!1),b.drag&&f.css(g),f.trigger("drag",[e,c]),d=f}),e.preventDefault()}else try{d&&d.trigger("dragEnd")}finally{c.unbind("mousemove.drag"),d=null}}),this.data("drag",!0)},a.expr[":"].range=function(b){var c=b.getAttribute("type");return c&&c=="range"||!!a(b).filter("input").data("rangeinput")},a.fn.rangeinput=function(c){if(this.data("rangeinput"))return this;c=a.extend(!0,{},b.conf,c);var d;return this.each(function(){var b=new h(a(this),a.extend(!0,{},c)),e=b.getInput().data("rangeinput",b);d=d?d.add(e):e}),d?d:this}}(jQuery),function(a){function h(b,c,d){var e=b.offset().top,f=b.offset().left,g=d.position.split(/,?\s+/),h=g[0],i=g[1];e-=c.outerHeight()-d.offset[0],f+=b.outerWidth()+d.offset[1],/iPad/i.test(navigator.userAgent)&&(e-=a(window).scrollTop());var j=c.outerHeight()+b.outerHeight();h=="center"&&(e+=j/2),h=="bottom"&&(e+=j);var k=b.outerWidth();return i=="center"&&(f-=(k+c.outerWidth())/2),i=="left"&&(f-=k),{top:e,left:f}}function i(a){function b(){return this.getAttribute("type")==a}return b.key="[type="+a+"]",b}function l(b,c,e){function l(b,c,d){if(!e.grouped&&b.length)return;var f;if(d===!1||a.isArray(d)){f=g.messages[c.key||c]||g.messages["*"],f=f[e.lang]||g.messages["*"].en;var h=f.match(/\$\d/g);h&&a.isArray(d)&&a.each(h,function(a){f=f.replace(this,d[a])})}else f=d[e.lang]||d;b.push(f)}var f=this,i=c.add(f);b=b.not(":button, :image, :reset, :submit"),c.attr("novalidate","novalidate"),a.extend(f,{getConf:function(){return e},getForm:function(){return c},getInputs:function(){return b},reflow:function(){return b.each(function(){var b=a(this),c=b.data("msg.el");if(c){var d=h(b,c,e);c.css({top:d.top,left:d.left})}}),f},invalidate:function(c,d){if(!d){var g=[];a.each(c,function(a,c){var d=b.filter("[name='"+a+"']");d.length&&(d.trigger("OI",[c]),g.push({input:d,messages:[c]}))}),c=g,d=a.Event()}return d.type="onFail",i.trigger(d,[c]),d.isDefaultPrevented()||k[e.effect][0].call(f,c,d),f},reset:function(c){return c=c||b,c.removeClass(e.errorClass).each(function(){var b=a(this).data("msg.el");b&&(b.remove(),a(this).data("msg.el",null))}).unbind(e.errorInputEvent||""),f},destroy:function(){return c.unbind(e.formEvent+".V").unbind("reset.V"),b.unbind(e.inputEvent+".V").unbind("change.V"),f.reset()},checkValidity:function(c,g){c=c||b,c=c.not(":disabled");if(!c.length)return!0;g=g||a.Event(),g.type="onBeforeValidate",i.trigger(g,[c]);if(g.isDefaultPrevented())return g.result;var h=[];c.not(":radio:not(:checked)").each(function(){var b=[],c=a(this).data("messages",b),k=d&&c.is(":date")?"onHide.v":e.errorInputEvent+".v";c.unbind(k),a.each(j,function(){var a=this,d=a[0];if(c.filter(d).length){var h=a[1].call(f,c,c.val());if(h!==!0){g.type="onBeforeFail",i.trigger(g,[c,d]);if(g.isDefaultPrevented())return!1;var j=c.attr(e.messageAttr);if(j)return b=[j],!1;l(b,d,h)}}}),b.length&&(h.push({input:c,messages:b}),c.trigger("OI",[b]),e.errorInputEvent&&c.bind(k,function(a){f.checkValidity(c,a)}));if(e.singleError&&h.length)return!1});var m=k[e.effect];if(!m)throw'Validator: cannot find effect "'+e.effect+'"';return h.length?(f.invalidate(h,g),!1):(m[1].call(f,c,g),g.type="onSuccess",i.trigger(g,[c]),c.unbind(e.errorInputEvent+".v"),!0)}}),a.each("onBeforeValidate,onBeforeFail,onFail,onSuccess".split(","),function(b,c){a.isFunction(e[c])&&a(f).bind(c,e[c]),f[c]=function(b){return b&&a(f).bind(c,b),f}}),e.formEvent&&c.bind(e.formEvent+".V",function(a){if(!f.checkValidity(null,a))return a.preventDefault();a.target=c,a.type=e.formEvent}),c.bind("reset.V",function(){f.reset()}),b[0]&&b[0].validity&&b.each(function(){this.oninvalid=function(){return!1}}),c[0]&&(c[0].checkValidity=f.checkValidity),e.inputEvent&&b.bind(e.inputEvent+".V",function(b){f.checkValidity(a(this),b)}),b.filter(":checkbox, select").filter("[required]").bind("change.V",function(b){var c=a(this);(this.checked||c.is("select")&&a(this).val())&&k[e.effect][1].call(f,c,b)});var m=b.filter(":radio").change(function(a){f.checkValidity(m,a)});a(window).resize(function(){f.reflow()})}a.tools=a.tools||{version:"1.2.6"};var b=/\[type=([a-z]+)\]/,c=/^-?[0-9]*(\.[0-9]+)?$/,d=a.tools.dateinput,e=/^([a-z0-9_\.\-\+]+)@([\da-z\.\-]+)\.([a-z\.]{2,6})$/i,f=/^(https?:\/\/)?[\da-z\.\-]+\.[a-z\.]{2,6}[#&+_\?\/\w \.\-=]*$/i,g;g=a.tools.validator={conf:{grouped:!1,effect:"default",errorClass:"invalid",inputEvent:null,errorInputEvent:"keyup",formEvent:"submit",lang:"en",message:"<div/>",messageAttr:"data-message",messageClass:"error",offset:[0,0],position:"center right",singleError:!1,speed:"normal"},messages:{"*":{en:"Please correct this value"}},localize:function(b,c){a.each(c,function(a,c){g.messages[a]=g.messages[a]||{},g.messages[a][b]=c})},localizeFn:function(b,c){g.messages[b]=g.messages[b]||{},a.extend(g.messages[b],c)},fn:function(c,d,e){a.isFunction(d)?e=d:(typeof d=="string"&&(d={en:d}),this.messages[c.key||c]=d);var f=b.exec(c);f&&(c=i(f[1])),j.push([c,e])},addEffect:function(a,b,c){k[a]=[b,c]}};var j=[],k={"default":[function(b){var c=this.getConf();a.each(b,function(b,d){var e=d.input;e.addClass(c.errorClass);var f=e.data("msg.el");f||(f=a(c.message).addClass(c.messageClass).appendTo(document.body),e.data("msg.el",f)),f.css({visibility:"hidden"}).find("p").remove(),a.each(d.messages,function(b,c){a("<p/>").html(c).appendTo(f)}),f.outerWidth()==f.parent().width()&&f.add(f.find("p")).css({display:"inline"});var g=h(e,f,c);f.css({visibility:"visible",position:"absolute",top:g.top,left:g.left}).fadeIn(c.speed)})},function(b){var c=this.getConf();b.removeClass(c.errorClass).each(function(){var b=a(this).data("msg.el");b&&b.css({visibility:"hidden"})})}]};a.each("email,url,number".split(","),function(b,c){a.expr[":"][c]=function(a){return a.getAttribute("type")===c}}),a.fn.oninvalid=function(a){return this[a?"bind":"trigger"]("OI",a)},g.fn(":email","Please enter a valid email address",function(a,b){return!b||e.test(b)}),g.fn(":url","Please enter a valid URL",function(a,b){return!b||f.test(b)}),g.fn(":number","Please enter a numeric value.",function(a,b){return c.test(b)}),g.fn("[max]","Please enter a value no larger than $1",function(a,b){if(b===""||d&&a.is(":date"))return!0;var c=a.attr("max");return parseFloat(b)<=parseFloat(c)?!0:[c]}),g.fn("[min]","Please enter a value of at least $1",function(a,b){if(b===""||d&&a.is(":date"))return!0;var c=a.attr("min");return parseFloat(b)>=parseFloat(c)?!0:[c]}),g.fn("[required]","Please complete this mandatory field.",function(a,b){return a.is(":checkbox")?a.is(":checked"):!!b}),g.fn("[pattern]",function(a){var b=new RegExp("^"+a.attr("pattern")+"$");return b.test(a.val())}),a.fn.validator=function(b){var c=this.data("validator");return c&&(c.destroy(),this.removeData("validator")),b=a.extend(!0,{},g.conf,b),this.is("form")?this.each(function(){var d=a(this);c=new l(d.find(":input"),d,b),d.data("validator",c)}):(c=new l(this,this.eq(0).closest("form"),b),this.data("validator",c))}}(jQuery)


