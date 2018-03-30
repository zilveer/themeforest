/*global $:false */

jQuery(document).ready(function($){'use strict';

    // portfolio filter
	$(window).load(function(){'use strict';
		var $portfolio_selectors = $('.portfolio-filter >li>a');
		var $portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});
		
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});
	
    // Sticky Nav
    $(window).on('scroll', function(){
        if ( $(window).scrollTop() > 130 ) {
            $('#masthead').addClass('sticky');
            
            $("#main").css("padding-top",""+$( "#masthead" ).height()+"px");
        } else {
            $('#masthead').removeClass('sticky');
            $("#main").css("padding-top","0px");
        }

        if ( $(window).scrollTop() > 131 ) {
            $('body').addClass('down');
        }else{
            $('body').removeClass('down');
        }
    });
	
	/* -------------------------------------- */
	// 		RTL Support Visual Composer
	/* -------------------------------------- */	
	var delay = 1;
	function themeum_rtl() {
		if( jQuery("html").attr("dir") == 'rtl' ){
			if( jQuery( ".entry-content > div" ).attr( "data-vc-full-width" ) =='true' )	{
				jQuery('.entry-content > div').css({'left':'auto','right':jQuery('.entry-content > div').css('left')});	
			}
		}
	}
	setTimeout( themeum_rtl , delay);

	jQuery( window ).resize(function() {
		setTimeout( themeum_rtl , delay);
	});	


	// Search onclick

	$('.hd-search-btn').on('click', function(event) {
		event.preventDefault();
		var $searchBox = $('.home-search');
		if ($searchBox.hasClass('show')) {
			$searchBox.removeClass('show');
			$searchBox.fadeOut('fast');
		}else{
			$searchBox.addClass('show');
			$searchBox.fadeIn('slow');
		}
	});

	$('.hd-search-btn-close').on('click', function(event) {
		event.preventDefault();

		var $searchBox = $('.home-search');
		$searchBox.removeClass('show');
		$searchBox.fadeOut('fast');
	});


	// Parallax section
	$(window).bind('load', function () {
		parallaxInit();						  
	});
	function parallaxInit() {
		$(document).find('.parallax-section').each(function() {
			$(this).parallax("50%", 0.3);
		});
	}	
	parallaxInit();

	$( window ).resize(function() {
		parallaxInit();
	});


	// Add extra class on iframe
	$("iframe").addClass("embed-responsive-item");
	

	$("a[data-rel]").prettyPhoto();

	// Owl Carousel
	$("#themeum-client").owlCarousel({
		autoPlay: 3000,
		items : 5,
		itemsDesktop : [1000,5],
		itemsDesktopSmall : [900,5],
		itemsTablet: [600,3],
		pagination : false,
		navigation : false,
		itemsMobile : false

	});

	$(window).load(function(){
		$('.masonery_area').isotope({
			animationEngine: 'jquery',
			animationOptions: {
				duration: 400,
				queue: false
			},
			itemSelector : '.masonery-post'
		});
	});

	// Load More Pagination
	$('#post-loadmore').on('click',function(event){
		event.preventDefault();

		var $that = $(this);
		if($that.hasClass('disable')){
			return false;
		}

		var container = $('#themeum-area'), // item container
			perpage = $that.data('per_page'), // post per page number
			total_posts = $that.data('total_posts'), // total posts count
			col_grid = $that.data('col_grid'), // output column grid
			ajaxUrl = $that.data('url');

		var items = container.find('.themeum-post-item'),
			itemNumbers = items.length,
			paged = ( itemNumbers / perpage ) + 1; // paged number

		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			data: {perpage: perpage,paged:paged,col_grid:col_grid},
			beforeSend: function(){
				$that.addClass('disable');
				$('<i class="fa fa-spinner fa-spin" style="margin-left:10px"></i>').appendTo( "#post-loadmore" ).fadeIn(100);
			},
			complete:function(){
				$('#post-loadmore .fa-spinner ').remove();
			}
		})
		.done(function(data) {
			var $newItems = $(data);
			container.isotope('insert', $newItems,function(){
				container.isotope('reLayout',{
					animationEngine: 'jquery',
					animationOptions: {
						duration: 400,
						queue: false
					}
				});
				var newLenght  = container.find('.themeum-post-item').length;
				if(total_posts <= newLenght){
					$('.load-wrap').fadeOut(400,function(){
						$('.load-wrap').remove();
					});
				}
				$that.removeClass('disable');
			});
			$("a[data-rel]").prettyPhoto();
		})
		.fail(function() {
			alert('failed');
			console.log("error");
		});
	});

	//WOW JS
	var wow = new WOW(
	{
	    boxClass:     'wow',
	    animateClass: 'animated',
	    offset:       0,
	    mobile:       true,
	    live:         true
	}
	);
	wow.init();

});



