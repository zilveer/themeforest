/**
 * Fullscreenr - lightweight full screen background jquery plugin
 * By Jan Schneiders
 * Version 1.0
 * www.nanotux.com
 **/

(function($){$.fn.fullscreenr=function(options){if(options.height===undefined)alert('Please supply the background image height, default values will now be used. These may be very inaccurate.');if(options.width===undefined)alert('Please supply the background image width, default values will now be used. These may be very inaccurate.');if(options.bgID===undefined)alert('Please supply the background image ID, default #bgimg will now be used.');var defaults={width:1280,height:1024,bgID:'bgimg'};var options=$.extend({},defaults,options);$(document).ready(function(){$(options.bgID).fullscreenrResizer(options);});$(window).bind("resize",function(){$(options.bgID).fullscreenrResizer(options);});return this;};$.fn.fullscreenrResizer=function(options){var ratio=options.height/options.width;var browserwidth=$(window).width();var browserheight=$(window).height();if((browserheight/browserwidth)>ratio){$(this).height(browserheight);$(this).width(browserheight/ratio);}else{$(this).width(browserwidth);$(this).height(browserwidth*ratio);}
	$(this).css('left',(browserwidth-$(this).width())/2);$(this).css('top',(browserheight-$(this).height())/2);return this;};})(jQuery);