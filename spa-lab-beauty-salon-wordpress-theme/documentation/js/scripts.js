(function($){

    "use strict";
	
    /* ---------------------------------------------------------------------------
	 * Sticky header
	 * --------------------------------------------------------------------------- */
	function mfn_sticky(){
		var mfn_header_height = $('#Header').innerHeight();
		var mfn_menu_height = $('#Categories').innerHeight();
		
		if( $('body').hasClass('sticky-header') ){	
			var start_y = mfn_header_height;
			var window_y = $(window).scrollTop();
	
			if( window_y > start_y ){
				if( ! ($('#Categories').hasClass('is-sticky')) ){
					$('.header_placeholder').css('margin-top', mfn_menu_height);
					$('#Categories').addClass('is-sticky');
				}
			}
			else {
				if( $('#Categories').hasClass('is-sticky') ){
					$('.header_placeholder').css('margin-top',0);
					$('#Categories').removeClass('is-sticky');
				}
			}
		}
	}

	
	/* --------------------------------------------------------------------------------------------------------------------------
	 * $(document).ready
	 * ----------------------------------------------------------------------------------------------------------------------- */
	$(document).ready(function(){
		
		/* ---------------------------------------------------------------------------
		 * Main menu
		 * --------------------------------------------------------------------------- */
		$("#Categories .group").muffingroup_menu({
			arrows	: true
		});	
		
		mfn_sticky();
		
		
		/* ---------------------------------------------------------------------------
		 * Anchor Fix for Sticky header + Smooth scroll
		 * --------------------------------------------------------------------------- */
		function active(el){
			$('#Categories .group > li').removeClass('active');
			el.closest('.group > li').addClass('active');
		}
		
		var hash = window.location.hash;
		if( hash && $(hash).length ){	
			
			var stickyH = $('.sticky-header #Top_bar').innerHeight();
			
			$('html, body').animate({ 
				scrollTop: $(hash).offset().top - stickyH - 20
			}, 500);
			
			active($('#Categories').find('a[href="'+ hash +'"]'));
		}
	
		$('#Categories .group a').click(function(){
			var url = $(this).attr('href');
			var hash = '#' + url.split('#')[1];
			
			var stickyH = $('.sticky-header #Top_bar').innerHeight();
			
			if( hash && $(hash).length ){
				$('html, body').animate({ 
					scrollTop: $(hash).offset().top - stickyH - 20
				}, 500);
			}
			
			active($(this));
		});	
		
		
		/* ---------------------------------------------------------------------------
		 * PrettyPhoto
		 * --------------------------------------------------------------------------- */
		if( $(window).width() >= 768 ){
			$('a[rel^="prettyphoto"], .prettyphoto').prettyPhoto({
				show_title		: false,
				deeplinking		: false,
				social_tools	: false
			});
		}
		
	});
	
	
	/* --------------------------------------------------------------------------------------------------------------------------
	 * $(window).scroll
	 * ----------------------------------------------------------------------------------------------------------------------- */
	$(window).scroll(function(){
		mfn_sticky();
	});
	
	
})(jQuery);