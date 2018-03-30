/*
*	jQuery HoverEx Script
*	by hkeyjun
*   http://codecanyon.net/user/hkeyjun	
*/
;(function($){
	var HoverEx = {
		fn:{
			moveZoom:function(obj,e)
			{
				var h =obj.height(),w=obj.width(),t=e.pageY-obj.offset().top,l=e.pageX-obj.offset().left;
				var $largeImg = obj.find("img");
				var dataZoom = obj.data("zoom");
				if(dataZoom&&dataZoom!="auto")
				{
					var zoomNum = parseFloat(dataZoom);
					$largeImg.css({"width":w*zoomNum+"px","height":h*zoomNum+"px","top":-t*(zoomNum-1)+"px","left":-l*(zoomNum-1)+"px"});
				}
				else
				{
					var zoomNum = $largeImg.width()/w;
					$largeImg.css({"top":-t*(zoomNum-1)+"px","left":-l*(zoomNum-1)+"px"});
				}
			},
			changeZoom:function(obj,e,delta, deltaX, deltaY)
			{
				var $largeImg = obj.find("img");
				var currentZoom = obj.data("zoom");
				currentZoom = currentZoom=="auto"?$largeImg.width()/obj.width():parseFloat(currentZoom);
				var zoomStep = obj.data("zoomstep");
				zoomStep = zoomStep?parseFloat(zoomStep):0.5;
				var zoomRange = obj.data("zoomrange");
				zoomRange = zoomRange?zoomRange.split(","):"1,4";
				var zoomMin = parseFloat(zoomRange[0]),zoomMax = parseFloat(zoomRange[1])>currentZoom?parseFloat(zoomRange[1]):currentZoom;
				var op = deltaY>0?1:-1;
				var	nextZoom =Math.round((currentZoom+zoomStep*op)*10)/10.0;
				if(nextZoom >=zoomMin&& nextZoom <=zoomMax)
				{
					obj.data("zoom",nextZoom);
					HoverEx.fn.showZoomState(obj,nextZoom);
					HoverEx.fn.moveZoom(obj,e);
				}
				
			},
			showZoomState:function(obj,state)
			{
				var $zoomState =obj.find(".he-zoomstate");
				if($zoomState.length == 0)
				{
					$zoomState = $('<span class="he-zoomstate">'+state+'X</span>').appendTo(obj);
				}
				$zoomState.text(state+"X").stop(true,true).fadeIn(300).delay(200).fadeOut(300);
			},
			switchImg:function(slider,type)
			{
				var animation = slider.data("animate");
				animation = animation?animation:"random";
				if(animation =="random")
				{
					var animations =["fadeIn","fadeInLeft","fadeInRight","fadeInUp","fadeInDown","rotateIn","rotateInLeft","rotateInRight","rotateInUp","rotateInDown","bounce","bounceInLeft","bounceInRight","bounceInUp","bounceInDown","elasticInLeft","elasticInRight","elasticInUp","elasticInDown","zoomIn","zoomInLeft","zoomInRight","zoomInUp","zoomInDown","jellyInLeft","jellyInRight","jellyInDown","jellyInUp","flipInLeft","flipInRight","flipInUp","flipInDown","flipInV","flipInH"];
					animation =animations[Math.floor(Math.random()*animations.length)];
				}
				var $imgs =slider.find("img"); 
				if($imgs.length>1)
				{
					if(type>0)
					{
						$imgs.eq(0).attr("class","a1").appendTo(slider);
						$imgs.eq(1).attr("class","a1 "+animation);
					}
					else
					{
						$imgs.eq($imgs.length-1).attr("class","a1 "+animation).prependTo(slider);
						$imgs.eq(0).attr("class","a1");
					}
				}
			}
		}
	};
	
	$(function(){	   
		$(".wz-wrap").live({
		   mouseenter:function(){
				var $view = $(this).find(".he-view").addClass("he-view-show");
				$("[data-animate]",$view).each(function(){
					var animate = $(this).data("animate");
					$(this).addClass(animate);
				});
				$(this).find(".he-zoom").addClass("he-view-show");
		   },
		   mouseleave:function(){
				var $view = $(this).find(".he-view").removeClass("he-view-show");
				$("[data-animate]",$view).each(function(){
					var animate = $(this).data("animate");
					$(this).removeClass(animate);
				});
				$(this).find(".he-zoom").removeClass("he-view-show");
		   },
		   mousewheel:function(e,delta, deltaX, deltaY){
				if($(this).find(".he-sliders").length==1)
				{
					var $slider = $(this).find(".he-sliders");
					var op = deltaY>0?1:-1;
					HoverEx.fn.switchImg($slider,op);
					e.preventDefault();
				}
				else if($(this).find(".he-zoom").length==1)
				{
					var $zoom =$(this).find(".he-zoom");
					HoverEx.fn.changeZoom($zoom,e,delta,deltaX,deltaY);
					e.preventDefault();
				}
			}
		});
		$(".he-zoom").live({mousemove:function(e){
			HoverEx.fn.moveZoom($(this),e);
		}});
		$(".he-pre").live("click",function(){
			var $slider =$(this).parents(".he-wrap").find(".he-sliders");
			HoverEx.fn.switchImg($slider,-1);
		});
		$(".he-next").live("click",function(){
			var $slider =$(this).parents(".he-wrap").find(".he-sliders");
			HoverEx.fn.switchImg($slider,1);
		});
		
	});
})(jQuery);

/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
 * Requires: 1.2.2+
 */

(function($) {

var types = ['DOMMouseScroll', 'mousewheel'];

if ($.event.fixHooks) {
    for ( var i=types.length; i; ) {
        $.event.fixHooks[ types[--i] ] = $.event.mouseHooks;
    }
}

$.event.special.mousewheel = {
    setup: function() {
        if ( this.addEventListener ) {
            for ( var i=types.length; i; ) {
                this.addEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = handler;
        }
    },
    
    teardown: function() {
        if ( this.removeEventListener ) {
            for ( var i=types.length; i; ) {
                this.removeEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = null;
        }
    }
};

$.fn.extend({
    mousewheel: function(fn) {
        return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
    },
    
    unmousewheel: function(fn) {
        return this.unbind("mousewheel", fn);
    }
});


function handler(event) {
    var orgEvent = event || window.event, args = [].slice.call( arguments, 1 ), delta = 0, returnValue = true, deltaX = 0, deltaY = 0;
    event = $.event.fix(orgEvent);
    event.type = "mousewheel";
    
    // Old school scrollwheel delta
    if ( orgEvent.wheelDelta ) { delta = orgEvent.wheelDelta/120; }
    if ( orgEvent.detail     ) { delta = -orgEvent.detail/3; }
    
    // New school multidimensional scroll (touchpads) deltas
    deltaY = delta;
    
    // Gecko
    if ( orgEvent.axis !== undefined && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
        deltaY = 0;
        deltaX = -1*delta;
    }
    
    // Webkit
    if ( orgEvent.wheelDeltaY !== undefined ) { deltaY = orgEvent.wheelDeltaY/120; }
    if ( orgEvent.wheelDeltaX !== undefined ) { deltaX = -1*orgEvent.wheelDeltaX/120; }
    
    // Add event and delta to the front of the arguments
    args.unshift(event, delta, deltaX, deltaY);
    
    return ($.event.dispatch || $.event.handle).apply(this, args);
}

})(jQuery);