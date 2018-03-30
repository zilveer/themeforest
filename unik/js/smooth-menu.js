jQuery(document).ready(function($){	
	var cloneMenu = $('#main-menu').clone().removeClass('sf-menu').addClass('smooth-menu').removeAttr('id');
	$('.main-nav').append(cloneMenu);
	$('.smooth-menu').wrap('<div class="responsive-nav"></div>');
	
	$('.header-main .container').prepend('<button type="button" value="" class="menu-switch btn action"><i class="tello-icon-menu"></i></button>');
	//switch click func
	var Switch = $('.menu-switch');
	var Smenu = $('.smooth-menu');
	Switch.click(function(){
		if(Smenu.hasClass('active')){
			Smenu.removeClass('active').slideUp(400);
		}
		else{
			Smenu.addClass('active').slideDown(400);
		}
	});
});