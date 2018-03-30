(function($) {

	
$(window).load(function(){

if(typeof navigation_text === 'undefined') {
	var navigation_text;
	navigation_text = 'Navigation';
}

if(typeof menu_text === 'undefined') {
	var menu_text;
	menu_text = 'Menu';
}


	$('#main-navigation .mega_main_menu .menu_inner>ul.mega_main_menu_ul').tinyNav({
		active: 'current-item',
		header: navigation_text,
		indent: '→',
		label: menu_text
	});
	
	

			
});	


})(jQuery);	



