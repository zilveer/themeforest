/*  Table of Contents 
01. MENU ACTIVATION
02. GALLERY JAVASCRIPT
03. FITVIDES RESPONSIVE VIDEOS
04. HEADER OPACITY
05. Header Scroll to Fixed Option 
*/
/*
=============================================== 01. MENU ACTIVATION  ===============================================
*/
jQuery(document).ready(function($) {
	 'use strict';
	jQuery("ul.sf-menu").supersubs({ 
	        minWidth:   4,   // minimum width of sub-menus in em units 
	        maxWidth:    16,   // maximum width of sub-menus in em units 
	        extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
	                           // due to slight rounding differences and font-family 
	    }).superfish({ 
			animationOut:  {opacity:'show'},
			speed:         200,           // speed of the opening animation. Equivalent to second parameter of jQuery’s .animate() method
			speedOut:      'fast',
			autoArrows:    true,               // if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance 
			dropShadows:   false,               // completely disable drop shadows by setting this to false 
			delay:     400               // 1.2 second delay on mouseout 
		});
});


/*
=============================================== 02. GALLERY JAVASCRIPT  ===============================================
*/
jQuery(document).ready(function($) {
	 'use strict';
    $('.gallery-progression').flexslider({
		animation: "fade",      
		slideDirection: "horizontal", 
		slideshow: false,         
		slideshowSpeed: 7000,  
		animationDuration: 200,        
		directionNav: true,             
		controlNav: true               
    });
});


/*
=============================================== 03. FITVIDES RESPONSIVE VIDEOS  ===============================================
*/
jQuery(document).ready(function($) {  
	 'use strict';
	 $("body").fitVids();
});


/*
=============================================== 04. TRANPARENT SLIDER BUTTON + PORTFOLIO  ===============================================
*/

/*
jQuery(window).load(function() {
*/

jQuery(document).ready(function($) {
	 'use strict';
	$('#page-title').transify({opacityOrig:0.80, percentWidth:'100%'});
	$('#page-title-portfolio').transify({opacityOrig:0.80, percentWidth:'100%'});
});

/*
});
*/


/*
=============================================== 05. Header Scroll to Fixed Option  ===============================================
*/
jQuery(document).ready(function($) {
	 'use strict';
    $('#fixed-header-pro').scrollToFixed({ 
		spacerClass: 'pro-header-spacing',
		zIndex:'99', dontSetWidth:'false'});
});
