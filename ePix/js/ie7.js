/* IE7 FIX FOR IMG WIDTH / HTML5*/

// For discussion and comments, see: http://remysharp.com/2009/01/07/html5-enabling-script/
(function(){if(!/*@cc_on!@*/0)return;var e = "abbr,article,aside,audio,bb,canvas,datagrid,datalist,details,dialog,eventsource,figure,footer,header,hgroup,mark,menu,meter,nav,output,progress,section,time,video".split(',');for(var i=0;i<e.length;i++){document.createElement(e[i])}})()

jQuery(document).ready(function($) {
	
	var browser_width = $(window).width();
	$('.tva-wide-layout .main-wrap,.tva-wide-layout .slider-wrap').not('.tva-wide-layout.horizontal-layout .main-wrap,..tva-wide-layout.horizontal-layout .slider-wrap').css("max-width", browser_width-300 );
	$('.columns:last-child').addClass('last');
	
});


jQuery(window).load(function() {	
	if( jQuery.browser.msie && jQuery.browser.version < 8 )
	{
		
		var headerSkin = jQuery('.header-skin-wrap').clone(true),
			headerSkin_height = jQuery('.header-wrap').height();
			
			if( jQuery('.header-wrap').hasClass('gallery') )
			{
				headerSkin_height = 300;
			}
		
		headerSkin.insertBefore('.header-wrap').addClass('display').css('height',headerSkin_height);
	}
	
});