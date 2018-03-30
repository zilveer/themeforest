jQuery(document).ready(function($) {
	$(".accordion").accordion({
	autoHeight: false,
	collapsible: true,
	active: false,
	heightStyle: "content"
	 });
});
jQuery(document).ready(function($) {
	$(".tabs").tabs();
});
jQuery(document).ready(function($) {
	$("a[rel=fancyimg]").fancybox();
});
jQuery(document).ready(function($) {
	$(".bxslider").bxSlider();
});
jQuery(document).ready(function($) { 
	$('ul.sf-menu').superfish({
	delay:       1000,                            // one second delay on mouseout 
	animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
	speed:       'fast',                          // faster animation speed 
	autoArrows:  true,                            // generation of arrow mark-up 
	dropShadows: true                             // drop shadows 
	
	});
});
jQuery(document).ready(function($) {
	/* For zebra striping */
	$("table tr:nth-child(odd)").addClass("odd-row");
	/* For cell text alignment */
	$("table td:first-child, table th:first-child").addClass("first");
	/* For removing the last border */
	$("table td:last-child, table th:last-child").addClass("last");
});
jQuery(document).ready(function($) {
	$("a.menu-toggle").click( function () {
		$('div.menu-mobile-container').toggleClass("menuslide");
	});						
});
jQuery(document).ready(function($) {
	$( ".datepicker" ).datepicker({dateFormat: 'mm-dd-yy'});
});
jQuery(document).ready(function($) {
	$( ".timepicker" ).timepicker({ timeFormat: 'h:mm p', interval:30, scrollbar:true, minHour: 8, maxHour: 17 });
});