(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false */ 
	/*global jQuery,Image */
	
	
	var a = (new Image()).style,b = 'ransition',c,e,d='nimation',t; 

	t = $.support.csstransitions = 
		(c = 't' + b) in a && c ||
		(c = 'webkitT' + b) in a && c || 
		(c = 'MozT' + b) in a && c || 
		(c = 'OT' + b) in a && c ||
		(c = 'MST' + b) in a && c || 
		false;
	
	$.support.cssanimation = 
		(e = 'a' + d) in a && e ||
		(e = 'webkitA' + d) in a && e || 
		(e = 'MozA' + d) in a && e || 
		(e = 'OA' + d) in a && e ||
		(e = 'MSA' + d) in a && e || 
		false;
	
	$.support.csstransitionsEnd = (t == "MozTransition" && "transitionend") || (t == "OTransition" && (parseInt(jQuery.browser.version,10) >= 12 ? "otransitionend" : "oTransitionEnd")) || (t == "transition" && "transitionend") || (t && t+"End");
	$.support.csstransitionsPrefix = {
		"MozTransition" : "-moz-",
		"webkitTransition" : "-webkit-",
		"OTransition" : "-o-",
		"MSTransition" : "-ms-"
	}[t] || "";
	var an = $.support.cssanimation;
	$.support.cssanimationEnd = an ? (an === "animation" ? "animationend" : an+'End') : false;
		
	//(t == "MozTransition" && "-moz-") || (t == "OTransition" && "-o-") || (t && t+"End");
		
	
}(jQuery));

		

