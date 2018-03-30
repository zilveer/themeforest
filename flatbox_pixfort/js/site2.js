jQuery.noConflict();
//*** Progress Bar Jquery ***//
function progress(percent, element, color) {
var progressBarWidth = percent * element.width() / 100;
element.find('div').css('background', color);
element.find('div').animate({ width: progressBarWidth }, 6000).html("<div class='progress-meter'>"+percent+"%&nbsp;</div>");

}



jQuery(document).ready(function(){

var heights = jQuery(".tiledesc").map(function ()
    {
        return jQuery(this).height();
    }).get();

    maxHeight = Math.max.apply(null, heights);
    
jQuery('.tiledesc').stop(true,true).animate({
				'height' : maxHeight
			},{queue:false, duration:450, easing: 'easeOutCubic'});	


//	Twitter Feeds :
//3 = date
		//var tid = '377205624066433024';
		var src2 = jQuery('img[alt="tval"]').attr('twitterids');
		tid = src2;
		if(tid != ""){
      			twitterFetcher.fetch(tid, '', 3, true, true, false, '', false, handleTweets);
  		}
      function handleTweets(tweets){
          var x = tweets.length;
          var n = 0;
          var element = document.getElementById('ftwitter');
          var html = '<ul class="ftwitt">';
          while(n < x) {
            html += '<li>' + tweets[n] + '</li>';
            n++;
          }
          if(n==1) {html += '<li>' + tweets[n-1] + '</li>';}
          html += '</ul>';
          element.innerHTML = html;

          jQuery('#ftwitter a').attr ('target', '_blank');

          jQuery('.flattwitter').fadeIn(1500);

			 jQuery('.ftwitt').list_ticker({
						speed:4000,
						effect:'fade'
					});

         
      }



jQuery('audio,video').mediaelementplayer();



var src = jQuery('img[alt="quote_back"]').attr('src');
jQuery('.flatquote').css('background-image', 'url(' + src + ')');

	 jQuery('.fade').list_ticker({
			speed:6000,
			effect:'fade'
		});

	
	});


jQuery(document).ready(function() {

jQuery('.gn-menu-wrapper').stop(true,true).animate({
				'top' : 135
			},{queue:false, duration:450, easing: 'easeOutCubic'});	

jQuery('#closesearch').hide();
 jQuery('.searchbar').css('display','none'); //hide the searchbar when page first load

jQuerytesto = true;
 jQuery('.search_butt').click(function() {
  jQuery('.searchbar').slideToggle('fast'); //set it to slide down and up fastly

if (jQuerytesto) {
	 jQuery('#opensearch').hide();
     jQuery('#closesearch').show();
     

	jQuery('.gn-menu-wrapper').stop(true,true).animate({
				'top' : 202
			},{queue:false, duration:450, easing: 'easeOutCubic'});	

	 jQuerytesto=false;
 }else{
 	jQuery('#closesearch').hide();
     jQuery('#opensearch').show();
     
     jQuery('.gn-menu-wrapper').stop(true,true).animate({
				'top' : 134
			},{queue:false, duration:450, easing: 'easeOutCubic'});	
     jQuerytesto=true;
 };


 });
 
 jQuery(".search_input").focus(function(){
	jQuery(this).filter(function(){
		return jQuery(this).val() == "" || jQuery(this).val() == "Search..."
	}).val("").css("color","#000");
 });

 jQuery(".search_input").blur(function(){
	jQuery(this).filter(function(){
	return jQuery(this).val() == ""
	}).val("Search...").css("color","#808080");
 });


	jQuery('html').removeClass('no-js');

	jQuery('#menu li').hover(
		function () { jQuery(this).addClass("hover"); },
		function () { jQuery(this).removeClass("hover"); }
	);

	jQuery('#menu li.arrow a').click( function (e) {
		jQueryel = jQuery(this).parent();
		if (jQueryel.hasClass('arrow')) {
			jQueryel.toggleClass("hover");
			if (jQueryel.parents('#menu').hasClass('mobile')) {
				jQueryel.toggleClass('show-menu');
				e.preventDefault();
			}
			//e.preventDefault();
		}
	});

	jQuery('#switch').click(function(e){
		jQuery(this).toggleClass('on');
		jQuery('#menu').toggleClass('mobile');
		return false;
	});

	jQuery('.accordion .accordion-title').click(function(e){
		jQueryli = jQuery(this).parent('li');
		jQueryul = jQueryli.parent('.accordion');
		if (jQueryul.hasClass('only-one-visible')) {
			jQuery('li',jQueryul).not(jQueryli).removeClass('active');
		}
		jQueryli.toggleClass('active');
		e.preventDefault();
	});

	jQuery(document).click(function(e){
		if (jQuery(e.target).parents('#menu').length > 0) return;
		jQuery('#menu #switch').removeClass('on');
		jQuery('#menu').removeClass('mobile');
	});

	jQuery('#top-link').click(function(e){
		jQuery('html, body').animate({scrollTop:0}, 750, 'linear');
		e.preventDefault();
		return false;
	});

	var window_width = jQuery('.container').width();
	jQuery(window).smartresize(function() {
		if (jQuery('.container').width() != window_width) {
			window_width = jQuery('.container').width();
			jQuery('#menu #switch').removeClass('on');
			jQuery('#menu').removeClass('mobile');
			if (jQuery('.isotope').length > 0) {
				jQuery('.isotope').isotope("reLayout");
			}
		}
	});

charts = jQuery(".progress-bar");
jQuery(window).scroll(function(d,h) {
    charts.each(function(i) {
        a = jQuery(this).offset().top + jQuery(this).height();
        b = jQuery(window).scrollTop() + jQuery(window).height();
        if (a < b){ 
		var bar = jQuery(this);
		var percentage = jQuery(this).attr('data-percent');
		var p_color = jQuery(this).attr('data-color');
		progress(percentage, bar,p_color);
        }   	
    });
});


charts2 = jQuery(".firaschart");

jQuery(".circular-bar").donutchart({'size': 150});
jQuery(window).scroll(function(d,h) {
    charts2.each(function(i) {
        a = jQuery(this).offset().top + jQuery(this).height();
        b = jQuery(window).scrollTop() + jQuery(window).height();
        if (a < b){ 
var c_color = jQuery(this).attr('data-color');
jQuery(this).donutchart({'size': 150, 'fgColor': c_color });
jQuery(this).donutchart("animate");
jQuery(this).removeClass('firaschart');
charts2 = jQuery(".firaschart");
        }   	
    });
});



tiles2 = jQuery(".fadeitin");
 tiles2.each(function(i) {
  a = jQuery(this).offset().top + jQuery(this).height();
        b = jQuery(window).scrollTop() + jQuery(window).height();
        if (a > b) jQuery(this).fadeTo(0, 0);
    });

jQuery(window).scroll(function(d,h) {
    tiles2.each(function(i) {
        a = jQuery(this).offset().top + jQuery(this).height();
        b = jQuery(window).scrollTop() + jQuery(window).height();
        if (a < b){ jQuery(this).stop(true,false).fadeTo(600,1);
        	jQuery(this).removeClass('fadeitin');
        	tiles2 = jQuery(".fadeitin");
        }
    	
    });
});

if (true) {
jQuery(window).bind('scroll',smallNav);
};
	function smallNav(){

		var jQueryoffset = jQuery(window).scrollTop();
		var jQuerywindowWidth = jQuery(window).width();
		
		if(jQueryoffset > 65 && jQuerywindowWidth >= 1000) {
	 jQuery('.searchbar').hide(450);

if (jQuerytesto === false) {
 	jQuery('#closesearch').hide();
     jQuery('#opensearch').show();
     jQuerytesto=true;
 };
	}

		if(jQueryoffset > 200 && jQuerywindowWidth >= 1000) {

jQuery('.gn-menu-main').stop(true,true).animate({
						'height' : 71,
						'z-index' : 1000
					},{queue:false, duration:450, easing: 'easeOutCubic'});	

jQuery('.gn-menu-wrapper').stop(true,true).animate({
					'top' : 97,
					'z-index' : 1000
				},{queue:false, duration:450, easing: 'easeOutCubic'});	


			jQuery('.flatheader').stop(true,true).animate({
				'margin-top' : -1
			},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('#menu').stop(true,true).animate({
				'height' : 50
			},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('.searchimg').stop(true,true).animate({
				'margin-top' : 1
			},{queue:false, duration:450, easing: 'easeOutCubic'});	
			
			jQuery('#menu > a').stop(true,true).animate({
				'height' : 65,
				'line-height' : '60px'
			},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('#menu > ul > li > a').stop(true,true).animate({
				'height' : 65,
				'line-height' : '60px'
			},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('#logo h1').stop(true,true).animate({
						'line-height' : '15px',
						'margin-top' : '7px',
						'margin-bottom' : '15px',
						'max-height' : '50px',
					},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('#logo p.text-version').stop(true,true).animate({
						'line-height' : '30px',
						'margin-bottom' : '20px'
					},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('#logo h1 a img').stop(true,true).animate({
						'max-height' : '50px'
					},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('#header #logo h5').fadeOut('fast');

			jQuery(window).unbind('scroll',smallNav);
			jQuery(window).bind('scroll',bigNav);
		}
	}
	
	function bigNav(){

		var jQueryoffset = jQuery(window).scrollTop();
		var jQuerywindowWidth = jQuery(window).width();

		if(jQueryoffset > 65 && jQuerywindowWidth >= 1000) {
	 jQuery('.searchbar').hide(700);

if (jQuerytesto === false) {
 	jQuery('#closesearch').hide();
     jQuery('#opensearch').show();
     jQuerytesto=true;
 };
	}
		if(jQueryoffset == 0 && jQuerywindowWidth >= 1000) {
			

			jQuery('#menu').stop(true,true).animate({
				'height' : 100
			},{queue:false, duration:250, easing: 'easeOutCubic'});	
		

				jQuery('.flatheader').stop(true,true).animate({
				'margin-top' : 0,
				'opacity' : '1',
				'filter' : 'alpha(opacity=100)'
			},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('.searchimg').stop(true,true).animate({
							'margin-top' : 15
						},{queue:false, duration:450, easing: 'easeOutCubic'});	


			jQuery('.gn-menu-main').stop(true,true).animate({
						'height' : 106
					},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('.gn-menu-wrapper').stop(true,true).animate({
							'top' : 134
						},{queue:false, duration:450, easing: 'easeOutCubic'});	

			jQuery('#menu > a').stop(true,true).animate({
				'height' : 100,
				'line-height' : '96px',
			},{queue:false, duration:250, easing: 'easeOutCubic'});	

			jQuery('#menu > ul > li > a').stop(true,true).animate({
				'height' : 100,
				'line-height' : '96px',
			},{queue:false, duration:250, easing: 'easeOutCubic'});	


			jQuery('#logo h1').stop(true,true).animate({
						'line-height' : '27px',
						'margin-top' : '21px',
						'margin-bottom' : '19px',
						'max-height' : '67px',
					},{queue:false, duration:250, easing: 'easeOutCubic'});	

			jQuery('#logo p.text-version').stop(true,true).animate({
						'line-height' : '45px',
						'margin-top' : '20px',
						'margin-bottom' : '5px'
					},{queue:false, duration:250, easing: 'easeOutCubic'});	

			jQuery('#logo h1 a img').stop(true,true).animate({
						'max-height' : '67px'
					},{queue:false, duration:250, easing: 'easeOutCubic'});	

			jQuery('#header #logo h5').fadeIn('fast');

			jQuery(window).unbind('scroll',bigNav);
			jQuery(window).bind('scroll',smallNav);
		}
	}


jQuery('a[href*=#href]').click(function() {

     if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {

             var jQuerytarget = jQuery(this.hash);

             jQuerytarget = jQuerytarget.length && jQuerytarget || jQuery('[name=' + this.hash.slice(1) +']');

             if (jQuerytarget.length) {

                 var targetOffset = jQuerytarget.offset().top;

                 jQuery('html,body').animate({scrollTop: targetOffset-90}, 1000);

                 return false;

            }

       }

   });
	
	
	jQuery(window).scroll(function() {

    		// jQuery('.flatblog_paralax').stop(true,true).animate({
				// 		'background-position-y' : parseInt(jQuery(this).scrollTop()*-0.06)
				// 	},{queue:false, duration:250, easing: 'linear'});	

		jQueryel = jQuery('#top-link');

		if (jQuery(window).scrollTop() >= 300) {
			jQueryel.fadeIn(500);
		} else {
			jQueryel.fadeOut(250);	
		}
		
	});

	jQuery('.tabs').tabify();

	if (jQuery('#contact_form').length > 0) {
		jQuery('#contact_form').ajaxForm({ target: '#contact_alert' });
	}

	if (jQuery('.lightbox, .button-fullsize, .fullsize').length > 0) {
		jQuery('.lightbox, .button-fullsize, .fullsize').fancybox({
			padding    : 0,
			maxHeight  : '90%',
			maxWidth   : '90%',
			loop       : true,
			fitToView  : true,
			mouseWheel : false,
			autoSize   : false,
			closeClick : false,
			overlay    : { showEarly  : true },
			helpers    : { media : {} }
		});
	}

	if (jQuery('.isotope').length > 0) {
		jQueryisotope = jQuery('.isotope');
		jQueryisotope.imagesLoaded(function(){
			jQueryisotope.isotope({
				itemSelector    : '.isotope .isotope-item:visible',
				animationEngine : 'jquery',
				resizable       : true
			});
		});
		jQuery('.isotope.infinitescroll').infinitescroll({
			navSelector  : '.pagination',
			nextSelector : '.pagination a.next',
			itemSelector : '.isotope .isotope-item',
			bufferPx     : 140,
			loading      : {
				finishedMsg: 'No more items to load.',
				msgText : "Loading new posts...",
				img: 'http://i.imgur.com/6RMhx.gif'
			}
		}, function( newElements ) {
			var jQuerynewElems = jQuery(newElements);
			jQuerynewElems.each(function() {
				jQuery(this).css({ opacity: 0 });
				var selector = jQuery('.isotope-filter a.active').data('value');
				if (selector != 'all') {
					if (jQuery(this).data('type') != selector) jQuery(this).hide();
				}
			});
			jQuerynewElems.imagesLoaded(function(){
				jQuerynewElems.animate({ opacity: 1 });
				jQueryisotope.isotope( 'appended', jQuerynewElems, true );
			});
		});

		jQuery('.isotope-filter a').click(function(ev) {
			jQuerythis = jQuery(this);
			if (jQuerythis.hasClass('active')) return;
			jQuerythis.parent().children('a').removeClass('active');
			jQuerythis.addClass('active');
			var selector = jQuerythis.data('value');
			if (selector == 'all') {
				selector = '.col';
			} else {
				selector = '.col[data-type~=' + selector + ']';
			}
			jQuery('.isotope').isotope({ filter: selector });
			return false;
		});
	}

});