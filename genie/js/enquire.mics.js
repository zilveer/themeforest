(function($) {

	// Enquire
			
    enquire.register("screen and (min-width: 0px) and (max-width: 1025px)", {

        match: function () {

            // Set menu
            $('.mainNav').css('display','none').before('<span class="menuToggler"></span>');
            $('.menuToggler').click(function() {
                $(this).toggleClass('on').next().toggleClass('open').slideToggle(250);
            });

            $('.mainNav ul li ul').css('display','none').before('<span class="subToggler"></span>');

            $('.subToggler').click(function() {
                $(this).toggleClass('on').next().slideToggle(250);
            });

        },
        unmatch: function () {

            // Unset menu
            $('.mainNav, .mainNav ul li ul').removeAttr('style').removeClass('open');
            $('.menuToggler, .subToggler').unbind('click').removeClass('on').remove();

            /* Undo header tools
            $('.socNtools li.search').unwrap().appendTo('.sntList');
            $('.toolsToggler').unbind('click').removeClass('on').remove();
            $('.sntList').removeClass('open'); */

        }

    })

    enquire.register("screen and (min-width: 0px) and (max-width: 740px)", {

        match: function () {

            // Side column toggle
			setTimeout(function() { 
				$('aside.side').before('<span class="sideToggler"></span>').css('display','none');
				$('.sideToggler').text($('aside.side').data('toggler-label'));
				$('.sideToggler').click(function () {
					$(this).toggleClass('on').next('aside').slideToggle(300, function(){
						$( '.sbPort' ).slick({
							arrows: true,
							infinite: true,
							dots: false,
							slidesToShow: 1,
							slidesToScroll: 1
						});
					});
				});				
			}, 750 )
        },
        unmatch: function () {

            // Undo side column toggle
            $('.sideToggler').unbind('click').remove();
            $('aside.side').removeAttr('style');

        }

    })

})( jQuery );