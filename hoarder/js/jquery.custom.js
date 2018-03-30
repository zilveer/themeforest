/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/
 
 jQuery(document).ready(function($) {

    /* Javascript YAY */
    $('body').removeClass('no-js');


    /* Superfish for awesome menus ----------------------------------*/
    var mobileMenuClone = $('#primary-menu').clone().attr('id', 'zilla-mobile-menu'); // For use in our mobile menu
	$('#primary-menu')
        .superfish({
    		delay: 200,
    		animation: {opacity:'show', height:'show'},
    		speed: 'fast',
    		cssArrows: false,
    		disableHI: true
    	});
	

	/* Zilla MobileMenu ----------------------------------------------*/
    function zilla_mobilemenu() {
        var windowWidth = $(window).width();
        
        if( windowWidth < 1000 ) {
            // Show the mobile menu, hide the main menu
            if( !$('#zilla-menu-dropdown').length ) {
                // add our button and cloned menu if they don't already exist
                $('<a id="zilla-menu-dropdown" href="#zilla-mobile-menu" />').prependTo('#primary-nav');
                mobileMenuClone.appendTo('#primary-nav');
                zilla_menu_listener();
            }
        } else {
            mobileMenuClone.css('display', 'none');
        }
    }
    zilla_mobilemenu();

    // Fire the event listener
    function zilla_menu_listener() {
        $('#zilla-menu-dropdown').click(function(e) {
            if( $('body').hasClass('ie8') ) {

                var mobileMenu = $('#zilla-mobile-menu');

                if( mobileMenu.css('display') === 'block' ) {
                    mobileMenu.css({
                        'display' : 'none'
                    });
                } else {
                    mobileMenu.css({
                        'display' : 'block',
                        'height' : 'auto',
                        'z-index' : 999,
                        'position' : 'absolute' 
                    });
                }

            } else {

                $('#zilla-mobile-menu').stop().slideToggle(500);

            }

            e.preventDefault();
        });
    }

    if( !$('body').hasClass('ie8') ) {    
        window.addEventListener( "orientationchange", function() {
            $('#primary-nav > ul').removeAttr('style');
        }, false );
    }
	    

    /* Isotope the blog and 2 col layout --------------------------------*/
    var $isotope = $('.isotope-container');
    
    $isotope.imagesLoaded( function() {
        $isotope.isotope({
            itemSelector: '.post',
            transformsEnabled: false,
            animationOptions: {
                duration: 400,
                easing: 'swing',
                queue: false
            }
        });
    });
    

    /* Load more items -----------------------------------------------*/
    var load_more = $('#load-more'),
		orig_text = load_more.text(),
		archive = load_more.attr('rel'),
		width = load_more.attr('data-width'),
		page = 1;

	load_more.click(function(){
		page++;
		load_more.text( zilla.loading );
		$.post(zilla.ajaxurl, { action:'zilla_load_more', nonce:zilla.nonce, page:page, archive:archive, width:width }, function(data) {
			var content = $(data.content);
			$(content).imagesLoaded(function() {
    			$('#primary').append( content ).isotope( 'appended', content, function() {
                    var $body = $('body');
                    if( $body.hasClass( 'page-template-template-home-blog-php' ) || $body.hasClass( 'archive' ) || $body.hasClass( 'search' ) ) {
                        zilla_resize_media();
                    }
    			    $('.isotope-container').isotope('reLayout');
    			});
    			load_more.text(orig_text);
			});

			if(page >= data.pages) load_more.fadeOut();
		}, 'json');

		return false;
	});
    
    
    /*	Make Video/Audio Responsive - Portfolio ----------------------*/
    function zilla_resize_media() {
    	if($().jPlayer && $('.jp-jplayer').length){

    		$(window).resize(function(){
    			$('.jp-jplayer').each(function(){
    				var player = $(this),
    					orig_width = player.attr('data-orig-width'),
    					orig_height = player.attr('data-orig-height'),
    					new_width = orig_width,
    					new_height = orig_height;
    					win_width = $(window).width(),
                        $body = $('body');

    				// Set responsive width breakpoints here
    				if( $body.hasClass('blog') ) {
                        new_width = 260;
                    }
    				else if( $body.hasClass('page-template-template-home-2col-php') ) {
                        new_width = 260;
                    } 
                    else if( $body.hasClass('page-template-template-home-blog-php') || $body.hasClass( 'search' ) || $body.hasClass( 'archive' ) ) {
                        if( win_width <= 480 ) {
                            new_width = 260;
                        }
                        else {
                            new_width = 580;
                        }
                    }
                    else if( $body.hasClass('single-post') ) {
                        if( win_width <= 480 ) {
                            new_width = 260;
                        }
                        else {
                            new_width = 580;
                        }
                    }

    				new_height = Math.round((new_width / orig_width) * orig_height);
    				if(player.hasClass('jp-jplayer')) player.jPlayer('option', 'size', { width: new_width, height: new_height });
    				if(player.hasClass('embed-video')) player.width(new_width).height(new_height);
    			});
    		});
    		$(window).trigger('resize'); // inital resize
    	}
	}
	zilla_resize_media();


    /* Scroll to top -------------------------------------------------*/
    function zilla_scroll_to_top() {
        var windowWidth = $(window).width(),
            didScroll = false;

        if( windowWidth > 1000 ) {
            var $freeride = $('#back-to-top');

            $freeride.hover(function() {
                $(this).animate({
                        opacity: 1
                    }, 300);
                }, function() {
                $(this).animate({
                    opacity: 0.7
                }, 300);
            });

            $freeride.click(function(e) {
                $('body,html').animate({ scrollTop: "0" });
                e.preventDefault();
            })

            $(window).scroll(function() {
                didScroll = true;
            });

            setInterval(function() {
                if( didScroll ) {
                    didScroll = false;

                    if( $(window).scrollTop() > 200 ) {
                        $freeride.css('display', 'block');
                    } else {
                        $freeride.css('display', 'none');
                    }
                }
            }, 250);
        }
    }
    zilla_scroll_to_top();


    /* Fire all resize code ------------------------------------------*/
    $(window).resize(function() {
        zilla_mobilemenu();
        $isotope.isotope('reLayout');
        zilla_scroll_to_top();
    });


   	/* FitVids magic for resizing video iframes ----------------------*/
    $("#content").fitVids();
 	
});