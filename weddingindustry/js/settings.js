/*
	Author: nicdark
	Author URI: http://www.nicdarkthemes.com/
*/



(function($) {
	"use strict";



	//isotope
	$( window ).load(function() {
		
		//create btns filter
		$('.nicdark_masonry_btns div a').on('click',function() {
			var filterValue = $( this ).attr('data-filter');
			$container_filter.isotope({ filter: filterValue });
		});
		  
		//create masonry
		var $container_masonry = $('.nicdark_masonry_container').isotope({
			itemSelector: '.nicdark_masonry_item'
		});
		var $container_filter = $('.nicdark_masonry_container.nicdark_filter').isotope({});

		$( '.nicdark_simulate_click' ).trigger( "click" );
	
	});
	///////////


	//sidebar fixed 
	$( window ).load(function() {
	
		var window_Width = $(window).width(); 
		var window_Height = $(window).height();
		var nicdark_sidebar_fixed_height = $('.nicdark_sidebar_fixed').height();

		
		//chaeck if element exists
		if ( nicdark_sidebar_fixed_height > 0 ){

			//condition
			if (window_Width < 1199 || window_Height < nicdark_sidebar_fixed_height+90 ){}else{

				$(window).scroll(function () {

					//do
					var nicdark_sidebar_fixed_container = $('.nicdark_sidebar_fixed_container').offset().top;
			        var nicdark_scroll = $(this).scrollTop();
			        var nicdark_sidebar_fixed_width = $('.nicdark_sidebar_fixed').width() + 'px';

			        //get height
					var nicdark_sidebar_fixed_container_height = $('.nicdark_sidebar_fixed_container').height() - 20;
					var nicdark_difference_height = nicdark_sidebar_fixed_container_height - nicdark_sidebar_fixed_height - 90;
					var nicdark_sidebar_fixed_margin_top = nicdark_sidebar_fixed_container_height - nicdark_sidebar_fixed_height;


			        if (nicdark_scroll > nicdark_sidebar_fixed_container-90 && nicdark_scroll < nicdark_sidebar_fixed_container+nicdark_difference_height) {

			            $('.nicdark_sidebar_fixed').css({
			                'position': 'fixed',
			                'top': '90px',
			                'margin-top': '0px',
			                'width': nicdark_sidebar_fixed_width
			            });


			        }else if  ( nicdark_scroll >= nicdark_sidebar_fixed_container+nicdark_difference_height)    {

			            $('.nicdark_sidebar_fixed').css({
			                'position': 'static',
			                'margin-top': nicdark_sidebar_fixed_margin_top
			            });

			        } else {

			            $('.nicdark_sidebar_fixed').css({
			                'position': 'static',
			                'margin-top': '0px'
			            });

			        }
					//end do

				});

			}
			//end condition

		}
	
	});
	//sidebar fixed
	




	//inview
	var windowWidth = $(window).width(); 

	if (windowWidth < 400){
		
		$('.fade-left, .fade-up, .fade-down, .fade-right, .bounce-in, .rotate-In-Down-Left, .rotate-In-Down-Right').css('opacity','1');
			
	}else{
		
		$('.fade-up').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated fadeInUp'); } });
		$('.fade-down').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated fadeInDown'); } });
		$('.fade-left').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated fadeInLeft'); } });
		$('.fade-right').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated fadeInRight'); } });
		$('.bounce-in').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated bounceIn'); } });
		$('.rotate-In-Down-Left').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated rotateInDownLeft'); } });
		$('.rotate-In-Down-Right').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated rotateInDownRight'); } });	

	}
	///////////

		

	//menu	
	$('.nicdark_navigation .menu').superfish({});	
	//megamenu
	$('.nicdark_megamenu ul a').removeClass('sf-with-ul');
	$($('.nicdark_megamenu ul li').find('ul').get().reverse()).each(function(){
	  $(this).replaceWith($('<ol>'+$(this).html()+'</ol>'))
	})
	///////////


	
	//fixed menu
	jQuery(window).scroll(function(){
		add_class_scroll();
	});
	add_class_scroll();
	function add_class_scroll() {
		if(jQuery(window).scrollTop() > 750) {
			jQuery('.nicdark_navigation_sticky').addClass('slowup');
			jQuery('.nicdark_navigation_sticky').removeClass('slowdown');
		} else {
			jQuery('.nicdark_navigation_sticky').addClass('slowdown');
			jQuery('.nicdark_navigation_sticky').removeClass('slowup');
		}
	}
	///////////
	
	
	
	//tooltip
    $( '.nicdark_tooltip' ).tooltip({ 
    	position: {
    		my: "center top",
    		at: "center+0 top-50"
  		}
    });
    //basic calendar
	$( '.nicdark_calendar' ).datepicker({ });


	//calendar from and to
	$( ".nicdark_calendar_range.nicdark_calendar_from" ).datepicker({
      changeMonth: false,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( ".nicdark_calendar_to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( ".nicdark_calendar_range.nicdark_calendar_to" ).datepicker({
      changeMonth: false,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( ".nicdark_calendar_from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });


    //slider-range
	$( ".nicdark_slider_range" ).slider({
		range: true,
		min: 0,
		max: 10000,
		values: [ 1000, 9000 ],
		slide: function( event, ui ) {
			$( ".nicdark_slider_amount" ).val( "$ " + ui.values[ 0 ] + " - $ " + ui.values[ 1 ] );
		}
	});
	$( ".nicdark_slider_amount" ).val( "$ " + $( ".nicdark_slider_range" ).slider( "values", 0 ) + " - $ " + $( ".nicdark_slider_range" ).slider( "values", 1 ) );
 

	//alerts
	$('.nicdark_alerts').on('click',function(event){
		$(this).css({
			'display': 'none',
		});
	});
	///////////


	//internal-link
	$('.nicdark_front_page .nicdark_internal_link > a').on('click',function(event){

		event.preventDefault();
		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
	
		$('html,body').animate({scrollTop:target_top -73}, 900);
	
	});
	///////////



	//counter
	$('.nicdark_counter').data('countToOptions', {
		formatter: function (value, options) {
			return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
		}
	});
	// start all the timers
	$('.nicdark_counter').bind('inview', function(event, visible) {
		if (visible == true) {
			$('.nicdark_counter').each(count);
		} 
	});
	function count(options) {
		var $this = $(this);
		options = $.extend({}, options || {}, $this.data('countToOptions') || {});
		$this.countTo(options);
	}
	///////////


	//nicescrool
	$(".nicdark_nicescrool").niceScroll({
		touchbehavior:false,
		cursoropacitymax:1,
		cursorwidth:0,
		autohidemode:false,
		cursorborder:0
	});
	$(".nicdark_nicescrool_hand").niceScroll({
		touchbehavior:true,
		cursoropacitymax:1,
		cursorwidth:2,
		autohidemode:true,
		cursorborder: "1px solid #eee",
		cursorcolor:"#eee"
	});
	///////////

		

	//left sidebar OPEN		
	$('.nicdark_left_sidebar_btn_open').on('click',function(event){
		$('.nicdark_left_sidebar').css({
			'left': '0px',
		});
		$('.nicdark_site, .nicdark_navigation').css({
			'margin-left': '300px',
		});
		$('.nicdark_overlay').addClass('nicdark_overlay_on');
	});
	//left sidebar CLOSE	
	$('.nicdark_left_sidebar_btn_close, .nicdark_overlay').on('click',function(event){
		$('.nicdark_left_sidebar').css({
			'left': '-300px'
		});
		$('.nicdark_site, .nicdark_navigation').css({
			'margin-left': '0px'
		});
		$('.nicdark_overlay').removeClass('nicdark_overlay_on');
	});
	//right sidebar OPEN		
	$('.nicdark_right_sidebar_btn_open').on('click',function(event){
		$('.nicdark_right_sidebar').css({
			'right': '0px',
		});
		$('.nicdark_site, .nicdark_navigation').css({
			'margin-left': '-300px',
		});
		$('.nicdark_overlay').addClass('nicdark_overlay_on');
	});
	//right sidebar CLOSE	
	$('.nicdark_right_sidebar_btn_close, .nicdark_overlay').on('click',function(event){
		$('.nicdark_right_sidebar').css({
			'right': '-300px'
		});
		$('.nicdark_site, .nicdark_navigation').css({
			'margin-left': '0px'
		});
		$('.nicdark_overlay').removeClass('nicdark_overlay_on');
	});
	///////////
	


	//nicdark_mpopup_gallery
	$('.nicdark_mpopup_gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-fade',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
	//nicdark_mpopup_iframe
	$('.nicdark_mpopup_iframe').magnificPopup({
		disableOn: 200,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false
	});
	//nicdark_mpopup_window
	$('.nicdark_mpopup_window').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});
	//nicdark_mpopup_ajax
	$('.nicdark_mpopup_ajax').magnificPopup({
		type: 'ajax',
		alignTop: false,
		overflowY: 'scroll'
	});
	//////////



	//pagination
	$('.nicdark_pagination .nicdark_btn').on('click',function(){
	   $('.nicdark_pagination .nicdark_btn').removeClass('active');
	    $(this).addClass('active');
	});
	//end pagination



})(jQuery);