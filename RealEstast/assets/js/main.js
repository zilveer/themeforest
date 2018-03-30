jQuery(function ($) {
	/**
	 * Script for back-to-top button effect
	 */
	$(window).scroll(function () {
		if ($(this).scrollTop() != 0) {
			$('#bttop').fadeIn();
		} else {
			$('#bttop').fadeOut();
		}
	});
	$('#bttop').click(function () {
		$('body,html').animate({scrollTop: 0}, 800);
	});

    //sticky nav
    nav_wrapper = $('.header').first();
    $('.header.fixed .navbar').first().waypoint({
        handler: function(direction){
            if(direction === 'down'){
                nav_wrapper.height($(this).outerHeight());
                $(this).addClass('navbar-fixed-top navbar-floating');
                $(this).css("top", -$(this).height()).animate({"top" : 0});
            }
        },
        offset: function() {
            return -$(this).height();
        },
        wrapper: '.header'
    }).waypoint({
        handler: function(direction){
            if(direction === 'up'){
                nav_wrapper.height('');
                $(this).removeClass('navbar-fixed-top navbar-floating');
            }
        },
        offset: -1,
        wrapper: '.header'
    });
});