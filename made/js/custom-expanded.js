jQuery.noConflict();

//DOCUMENT.READY
jQuery(document).ready(function() { 	
	// SUPERFISH
	jQuery('#top-menu ul').superfish({
		hoverClass:  'over', 						// the class applied to hovered list items 
		delay:       400,                            // one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
		speed:       150,                          // faster animation speed 
		autoArrows:  true,                           // disable generation of arrow mark-up 
		dropShadows: true                            // disable drop shadows 
	}); 	
	jQuery('#cat-menu ul').superfish({
		hoverClass:  'over', 						// the class applied to hovered list items 
		delay:       400,                            // one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
		speed:       150,                          // faster animation speed 
		autoArrows:  true,                           // disable generation of arrow mark-up 
		dropShadows: true                            // disable drop shadows 
	}); 	
	jQuery('#main-menu ul').superfish({
		hoverClass:  'over', 						// the class applied to hovered list items 
		delay:       400,                            // one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
		speed:       150,                          // faster animation speed 
		autoArrows:  true,                           // disable generation of arrow mark-up 
		dropShadows: true                            // disable drop shadows 
	});
	
	//toggle functions
	jQuery('.toggle-content').hide();
		//switch plus with minus image
	jQuery(".toggle").toggle(function(){
		jQuery(this).addClass("active");
		}, function () {
		jQuery(this).removeClass("active");
	});			
	//slide up and down on click
	jQuery(".toggle").click(function(){
		jQuery(this).next(".toggle-content").slideToggle();
	});
				
	jQuery('#post-1').click(function() { 
		jQuery('#slider1').cycle(0); 
		return false; 
	});
	jQuery('#post-2').click(function() { 
		jQuery('#slider1').cycle(1); 
		return false; 
	});
	jQuery('#post-3').click(function() { 
		jQuery('#slider1').cycle(2); 
		return false; 
	});
	jQuery('#post-4').click(function() { 
		jQuery('#slider1').cycle(3); 
		return false; 
	});
	jQuery('#post-5').click(function() { 
		jQuery('#slider1').cycle(4); 
		return false; 
	});
	jQuery('#post-6').click(function() { 
		jQuery('#slider1').cycle(5); 
		return false; 
	});
	
	//jQuery tabs
	jQuery('#tabs-frontpage').tabs({ fx: { opacity: 'toggle', duration: 150 } });
	jQuery('#tabbed-posts').tabs({ fx: { opacity: 'toggle', duration: 150 } });
	jQuery('#tabbed-archives').tabs({ fx: { opacity: 'toggle', duration: 150 } });
	jQuery('#tabbed-reviews').tabs({ fx: { opacity: 'toggle', duration: 150 } });
	jQuery('#tabbed-reviews-compact').tabs({ fx: { opacity: 'toggle', duration: 150 } });
	jQuery('.tabs-shortcode').tabs({ fx: { opacity: 'toggle', duration: 150 } });
	jQuery('#related').tabs({ fx: { opacity: 'toggle', duration: 150 } });
	//Review Categories tabs are setup in the footer.php file
	
	if(!jQuery.browser.msie){button_hover_shortcode();}	
	
	//colorpickers
	//main color
	jQuery('#forecolorSelector').ColorPicker({
		color: '#C32C0D',
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(300);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(300);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#logo-bar-wrapper').css('backgroundColor', '#' + hex);
			jQuery('#dontmiss-header').css('color', '#' + hex);
			jQuery('#forecolorSelector div').css('backgroundColor', '#' + hex);
		}
	});
	//demo background color
	jQuery('#colorSelector').ColorPicker({
		color: '#E1E1E1',
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(300);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(300);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('body').css('backgroundColor', '#' + hex);
			jQuery('#colorSelector div').css('backgroundColor', '#' + hex);
		}
	});
	
});

//WINDOW.LOAD
jQuery(window).load(function() {
	//latest slider	
	jQuery(function() {
		jQuery("#latest-wrapper .latest").jCarouselLite({		
			btnNext: ".latest-next",		
			btnPrev: ".latest-prev",
			easing: "easeInOutExpo",
			speed: 700,
			visible: 5,
			scroll: 2		
		});	
	});
	//trending	
	jQuery(function() {
		jQuery(".main-content-left #trending").jCarouselLite({		
			btnNext: ".trending-next",		
			btnPrev: ".trending-prev",
			easing: "easeInOutExpo",
			speed: 300,
			visible: 5,
			scroll: 2			
		});	
	});
	jQuery(function() {
		jQuery(".main-content #trending").jCarouselLite({		
			btnNext: ".trending-next",		
			btnPrev: ".trending-prev",
			easing: "easeInOutExpo",
			speed: 300,
			visible: 8,
			scroll: 2		
		});	
	});	
	//shortcode slider
	jQuery(function() {
		jQuery("#shortcode-slider").jCarouselLite({		
			btnNext: ".shortcode-slider-next",		
			btnPrev: ".shortcode-slider-prev",
			easing: "easeInOutExpo",
			speed: 300,
			visible: 1			
		});	
	});
	//BRIGHTEN AND DARKEN IMAGE HOVERS (OR ANY OTHER ELEMENT)
	jQuery(function() {
		// BRIGHTEN
		// OPACITY OF BUTTON SET TO 75%
		jQuery(".brighten").css("opacity","0.75");			
		// ON MOUSE OVER
		jQuery(".brighten").hover(function () {											  
			// SET OPACITY TO 100%
			jQuery(this).stop().animate({
			opacity: 1.0
			}, 70);
		},			
		// ON MOUSE OUT
		function () {				
			// SET OPACITY BACK TO 75%
			jQuery(this).stop().animate({
			opacity: 0.75
			}, 700);
		});
		
		// DARKEN
		// ON MOUSE OVER
		jQuery(".darken img").hover(function () {											  
			// SET OPACITY TO 100%
			jQuery(this).stop().animate({
			opacity: .28
			}, 150);
		},			
		// ON MOUSE OUT
		function () {				
			// SET OPACITY BACK TO 75%
			jQuery(this).stop().animate({
			opacity: 1.0
			}, 600);
		});	
	});	
});

//toggle the demo settings - you can disregard this, it is only used for the made demo
function hidedemo() {
	jQuery('.demo-wrapper').animate({				 
		 "right": "-=128px"				 
		}, 300, "easeInOutExpo" );	
	jQuery('.hide-demo').hide();
	jQuery('.show-demo').show();		
}
function showdemo() {
	jQuery('.demo-wrapper').animate({				 
		 "right": "0px"				 
		}, 300, "easeInOutExpo" );	
	jQuery('.hide-demo').show();
	jQuery('.show-demo').hide();		
}
function changebg(id, repeat, image) {
	jQuery('.bg').css("opacity","1");
	jQuery('.bg').css("border-color","#FFF");
	jQuery('#'+id+'').css("opacity","0.5");
	jQuery('#'+id+'').css("border-color","#000");
	jQuery('body').css("background-image", "url("+image+")");
	jQuery('body').css("background-repeat", ""+repeat+"");
}
function changeskin(addclass, removeclass) {	
	jQuery('.bg').css("opacity","1");
	jQuery('.bg').css("border-color","#FFF");
	jQuery('body').removeClass(removeclass);
	jQuery('body').addClass(addclass);
}

//button hovers
function button_hover_shortcode(){
	jQuery('.button_link,.more-button a,.comment-reply-link,button[type=submit],button,input[type=submit],input[type=button],input[type=reset],input[type=image]').hover(
		function() {
				jQuery(this).stop().animate({opacity:0.80},300);
			},
			function() {
				jQuery(this).stop().animate({opacity:1},300);
		});
}

//makes background position animations work in firefox
(function($) {
if(!document.defaultView || !document.defaultView.getComputedStyle){
    var oldCurCSS = jQuery.css;
    jQuery.css = function(elem, name, force){
        if(name === 'background-position'){
            name = 'backgroundPosition';
        }
        if(name !== 'backgroundPosition' || !elem.currentStyle || elem.currentStyle[ name ]){
            return oldCurCSS.apply(this, arguments);
        }
        var style = elem.style;
        if ( !force && style && style[ name ] ){
            return style[ name ];
        }
        return oldCurCSS(elem, 'backgroundPositionX', force) +' '+ oldCurCSS(elem, 'backgroundPositionY', force);
    };
}

var oldAnim = $.fn.animate;
$.fn.animate = function(prop){
    if('background-position' in prop){
        prop.backgroundPosition = prop['background-position'];
        delete prop['background-position'];
    }
    if('backgroundPosition' in prop){
        prop.backgroundPosition = '('+ prop.backgroundPosition + ')';
    }
    return oldAnim.apply(this, arguments);
};

function toArray(strg){
    strg = strg.replace(/left|top/g,'0px');
    strg = strg.replace(/right|bottom/g,'100%');
    strg = strg.replace(/([0-9\.]+)(\s|\)|$)/g,"$1px$2");
    var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);
    return [parseFloat(res[1],10),res[2],parseFloat(res[3],10),res[4]];
}

$.fx.step.backgroundPosition = function(fx) {
    if (!fx.bgPosReady) {
        var start = $.css(fx.elem,'backgroundPosition');

        if(!start){//FF2 no inline-style fallback
            start = '0px 0px';
        }

        start = toArray(start);

        fx.start = [start[0],start[2]];

        var end = toArray(fx.end);
        fx.end = [end[0],end[2]];

        fx.unit = [end[1],end[3]];
        fx.bgPosReady = true;
    }

    var nowPosX = [];
    nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0];
    nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1];
    fx.elem.style.backgroundPosition = nowPosX[0]+' '+nowPosX[1];
};
})(jQuery);
jQuery("select#select-menu-top-menu").change(function() {
  window.location = jQuery(this).find("option:selected").val();
});
jQuery("select#select-menu-main-menu").change(function() {
  window.location = jQuery(this).find("option:selected").val();
});
jQuery(document).ready( function() {
	jQuery("select#select-menu-top-menu, select#select-menu-main-menu, select#rating").selectBox();
});