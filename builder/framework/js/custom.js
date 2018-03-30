jQuery.noConflict()(function($){
"use strict";
	//$('.oi_header_menu_fixed').css('margin-top',(($('.oi_logo_holder').height()- $('.oi_header_menu_fixed').outerHeight())/2))
	// makes sure the whole site is loaded
	jQuery("#status").css('display','block');
	jQuery("#preloader").css('display','block');
	

	
	$(document).ready(function() {
		$('.oi_page_holder').css('visibility','visible');
		// will first fade out the loading animation
		jQuery("#status").fadeOut("slow");
		// will fade out the whole DIV that covers the website.
		jQuery("#preloader").fadeOut("slow");
		$('.oi_content_holder').css('margin-top',$('.oi_head_holder').outerHeight())
		
		if(oi_theme.page_layout!='fullwidth'){
		$('.vc_row[data-vc-full-width="true"]').addClass('oi_full_row_vc');
		$('.vc_row[data-vc-full-width="true"]').css('left',-(($('.oi_content_holder').width() - $('.container').width()))/2);
		$('.vc_row[data-vc-full-width="true"]').css('padding-left',(($('.oi_content_holder').width() - $('.container').width()))/2);
		$('.vc_row[data-vc-full-width="true"]').css('padding-right',(($('.oi_content_holder').width() - $('.container').width()))/2);
		$('.vc_row[data-vc-stretch-content="true"]').css('padding-right','0px');
		$('.vc_row[data-vc-stretch-content="true"]').css('padding-left','0px');
		$('.vc_row[data-vc-full-width="true"]').css('margin-left','0px');
		$( window ).resize(function() {
			$('.vc_row[data-vc-full-width="true"]').addClass('oi_full_row_vc');
			$('.vc_row[data-vc-full-width="true"]').css('left',-(($('.oi_content_holder').width() - $('.container').width()))/2);
			$('.vc_row[data-vc-full-width="true"]').css('padding-left',(($('.oi_content_holder').width() - $('.container').width()))/2);
			$('.vc_row[data-vc-full-width="true"]').css('padding-right',(($('.oi_content_holder').width() - $('.container').width()))/2);
			$('.vc_row[data-vc-stretch-content="true"]').css('padding-right','0px');
			$('.vc_row[data-vc-stretch-content="true"]').css('padding-left','0px');
			$('.vc_row[data-vc-full-width="true"]').css('margin-left','0px');
		});
		}
		
	});


	$('.oi_xs_menu').click(function(){
		$('.oi_header_menu_mobile').toggleClass('oi_v_menu');
	});
	
	$('.wp-smiley').removeClass('img-responsive')
	$('.wp-caption img').removeAttr('height');
	$('.wp-caption img').removeAttr('width')
	$('.wp-caption').removeAttr('style');
	$('.oi_widget img').addClass('img-responsive');
	$('.alignnone').addClass('img-responsive');
	$('.alignnone img').addClass('img-responsive')
	$('table:not(#wp-calendar)').addClass('table table-striped table-bordered');
	$('.oi_blog_post_content_holder a').addClass('colored');
	$('.oi_single_post_content_holder a').addClass('colored');

	$(document).on('opening', '.remodal', function () {
	  $('.oi_head_holder').addClass('oi_modal_open');
	});
	$(document).on('closed', '.remodal', function () {
		 $('.oi_head_holder').removeClass('oi_modal_open');
		 $('.oi_head_holder').addClass('oi_modal_closed');
		 setInterval(function() {$('.oi_head_holder').removeClass('oi_modal_closed') }, 1000);

	});
	
$(document).ready(function() {	
var $container = $('.oi_mas_container');
		
if($container.length) {
	$container.waitForImages(function() {
		
		// initialize isotope
		$container.isotope({
		  itemSelector : '.oi_mas_item',
		  layoutMode : 'masonry',
		});
		
		
	},null,true);
};
});
	
	$(".oi_gallery_slider").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		loop: true,
		navigation : true,
        rewindNav : true,
        scrollPerPage : false,
        pagination : true,
        paginationNumbers : true,
		lazyLoad: false,
		navText:[,],
		autoplay: true,
		stopOnHover : true,
		smartSpeed:1000,
		autoplayTimeout: 3000,
		autoplayHoverPause:true,
		responsive: {
				0: {
					margin: 0,
					items: 1
				},
				600: {
					margin: 0,
					items: 1
				},
				800: {
					margin: 0,
					items: 1
				},
				1200: {
					margin: 0,
					items: 1
				}
			}
		
	});
	
});


jQuery.noConflict()(function($){
if($('body').outerWidth()>1000){
// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.oi_head_holder').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 0);

function hasScrolled() {
    var st = $(this).scrollTop();
    
	if(st>navbarHeight){
		$('.oi_head_holder .oi_logo_holder').addClass('oi_scrolled')
		$('.oi_head_holder').css('margin-top')
	}else{
		$('.oi_head_holder .oi_logo_holder').removeClass('oi_scrolled')
		$('.oi_head_holder').css('margin-top','0px')
	}
	
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('.oi_head_holder').removeClass('nav-down').addClass('nav-up').css('top',-$('.oi_head_holder').outerHeight());
		
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('.oi_head_holder').removeClass('nav-up').addClass('nav-down').css('top',0);
			
        }
    }
    
    lastScrollTop = st;
}

};
$(window).load(function() {
		$( '<i class="fa fa-angle-right fa-fw"></i>' ).appendTo( $('.oi_gallery_slider .owl-next') );
		$( '<i class="fa fa-angle-left fa-fw"></i>' ).appendTo( $('.oi_gallery_slider .owl-prev') );
	
	
		$('.oi_blog_chess').each(function(index, element) {
			$( this ).find($('.oi_chess_content')).css('height',$( this ).find($('.oi_chess_img_holder')).height())
		});
	});

});
