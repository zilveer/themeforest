jQuery(document).ready(function($) { 
    
		//Flex Slider	
	    $('.flexslider').flexslider({
	      slideshow: false
	    });
    
		// Toggle Menu   
        function togglemenu(){
            if ($(".sub-menu-toggle")[0] == undefined){
                $( '.main-nav .sub-menu' ).before( '<span class="sub-menu-toggle" role="button" aria-pressed="false"></span>' );
            }
            $( '.sub-menu-toggle' ).on( 'click', function() {
                var $this = $( this );
                $this.attr( 'aria-pressed', function( index, value ) {
                    return 'false' === value ? 'true' : 'false';
                });
                $this.toggleClass( 'activated' );
                $this.next( '.main-nav, .sub-menu' ).slideToggle( 'fast' );
            });
        }	
        togglemenu();
    
        // Custom Scrollbar
        $("#leftsidebar").mCustomScrollbar({
            theme:"minimal-dark",
            mouseWheel:{ deltaFactor: 150 }
        });

		// Lightbox
		$(".lightbox").fancybox({
			'titlePosition'		: 'outside',
			'overlayColor'		: '#ddd',
			'overlayOpacity'	: 0.9,
			'titleShow'			: 'false',
			'speedIn' : '1400',
			'speedOut' : '1400'
		});
    
        // Mobile menu
        if( $(window).width() <= 320) {
            $("#sdbr-trigger").click(function() {
                $("#leftsidebar").css({'display': 'block'});
                $("#wrapper").css({'margin-left': '280px'});
                $("#sdbr-trigger").css({'display': 'none'});
                $("#open-sidebar-overlay").css({'display': 'block'});
            });
            $("#open-sidebar-overlay").click(function() {
                $("#leftsidebar").css({'display': 'none'});
                $("#wrapper").css({'margin-left': '0px'});
                $("#sdbr-trigger").css({'display': 'block'});
                $("#open-sidebar-overlay").css({'display': 'none'});
            }); 
        } else {
            $("#sdbr-trigger").click(function() {
                $("#leftsidebar").css({'display': 'block'});
                $("#wrapper").css({'margin-left': '330px'});
                $("#sdbr-trigger").css({'display': 'none'});
                $("#open-sidebar-overlay").css({'display': 'block'});
            });
            $("#open-sidebar-overlay").click(function() {
                $("#leftsidebar").css({'display': 'none'});
                $("#wrapper").css({'margin-left': '0px'});
                $("#sdbr-trigger").css({'display': 'block'});
                $("#open-sidebar-overlay").css({'display': 'none'});
            });
        }
		
		
		//Back To Top
		jQuery(document).ready(function() {
			jQuery().UItoTop({ 
				text: '<i class="fa fa-chevron-up"></i>',
				scrollSpeed: 600
			});
			
		});
    	
		// FitVids
		jQuery('.crvideo, .masonr .post-content p, .widget').fitVids();
    
        // Footer
        function footermargin(){ 
            var dochght = $(document).height();
            var admhght = 0;
            var admhght = $('#wpadminbar').outerHeight();
            var mlghgt = 0;
            if ($('.mobile-logo-wrap').is(':visible')){
                var mlghgt = $('.mobile-logo-wrap').outerHeight();
            }
            var mnhght = $('#main').height();
            var ftrhgt = $('#footer').outerHeight();
            var mrpdng = 0;
            if ($('.masonr').is(':visible')){
                var mrpdng = $('.masonr').first().css('paddingBottom').replace('px', '');
            }
            var ftrmrgn = dochght - admhght - mnhght - mlghgt - mrpdng - ftrhgt;
            if(ftrmrgn > 0) {
               $('#footer').css('margin-top', ftrmrgn);
            }    
        }
        var $body = $('body');
        if ( $body.hasClass('search') || $body.hasClass('error404')) {
        footermargin();
        }
    
        // Masonry First Load
        var $container = $('.masonrycontainer');
        $container.imagesLoaded(function() {
            $container.isotope({
                itemSelector : '.masonr'
            });
            $('.masonrycontainer').css('opacity', 1.0);
        });

        // Masonry Load More
        var morebutton = $('#load-more'),
            archive = morebutton.attr('rel'),
            deftext = morebutton.text(),
            page = 1;

        morebutton.click(function(){
            page++; 
            morebutton.text(ajax_custom.loading);
            $.post(ajax_custom.ajaxurl, {action:'cr_load_more', nonce:ajax_custom.nonce, page:page, archive:archive}, function(data){
                var newcontent = $(data.content);
                $(newcontent).imagesLoaded(function() {
                    $('.masonrycontainer').append(newcontent).isotope('appended',newcontent);
                    $('.flexslider').flexslider();
                    $('.crvideo, .masonr .post-content p').fitVids();
                    setTimeout(
                        function(){
                            $('.masonrycontainer').isotope('layout');
                        }, 400
                    );
                    morebutton.text(deftext);
                });


                if(page>=data.pages){
                    morebutton.fadeOut();
                }
            },'json');
            return false;
        });

});