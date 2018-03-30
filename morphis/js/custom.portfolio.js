var morphisGetPortfolio;
jQuery(document).ready(function( $ ) {
	"use strict";
	/* Portfolio Page Loading using Ajax */
	function initializePortfolio() {
   
		var urlQuery = location.search;
		urlQuery = urlQuery.replace('?', '');
		var split = urlQuery.split('=');
   
		var intRegex = /^\d+$/;
   
		if(intRegex.test(split[1])) {			
			var item_id = split[1];
       
			var item_to_initialize = $("#items").find("a[data-post_id='" + item_id + "']:first");
       
			$(item_to_initialize).trigger("click");			
	    }
    }    
	
	var active_post_id = '';
	var $portfolioDetail = $("#portfolio-content-detail"); 
   		
   	morphisGetPortfolio = function(e) {
      	
		var post_id = $( this ).attr( "data-post_id" );
		active_post_id = post_id;
      
		var $next = '';
		var $prev = '';

		var  $parentElement = '';
		var $the_portfolio_data ='';
		var $portfolio_first_child ='';
		var $portfolio_last_child ='';
		var $possiblePrev, $possibleNext, $notPrev, $notNext;
	  
		$the_portfolio_data = $( '.portfolio-content-link[data-post_id="' + post_id + '"]' ).closest('.portfolio-data');
	  
		var $parentElementCopy = $('#items').clone();
		$parentElementCopy.children('li.clearer').detach();
	  
		$portfolio_first_child = $parentElementCopy.find('li:first-child');
		$portfolio_last_child = $parentElementCopy.find('li:last-child');
	  
		if($the_portfolio_data.hasClass('omega')) {			
			$notNext = $the_portfolio_data.next('li:not(.portfolio-data)');
			$possibleNext = $notNext.next('.portfolio-data');
			$possiblePrev = $the_portfolio_data.prev('.portfolio-data');

			//if this is the last item, add first item link to its next link.
			if( $the_portfolio_data.find('.portfolio-content-link').attr( "data-post_id" ) == $portfolio_last_child.find('.portfolio-content-link').attr( "data-post_id" ) ){
				$next = $portfolio_first_child;
			} else {
				$next = $possibleNext;
			}

			//if this is the first item, add last item link to its previous link. 
			if( $the_portfolio_data.find('.portfolio-content-link').attr( "data-post_id" ) == $portfolio_first_child.find('.portfolio-content-link').attr( "data-post_id" ) ){
				$prev = $portfolio_last_child;
			} else {
				$prev = $possiblePrev;
			}			 
		} else if($the_portfolio_data.hasClass('alpha')) {			
			$notPrev = $the_portfolio_data.prev('li:not(.portfolio-data)');
			$possiblePrev = $notPrev.prev('.portfolio-data');
			$possibleNext = $the_portfolio_data.next('.portfolio-data');

			//if this is the last item, add first item link to its next link.
			if( $the_portfolio_data.find('.portfolio-content-link').attr( "data-post_id" ) == $portfolio_last_child.find('.portfolio-content-link').attr( "data-post_id" ) ){
				$next = $portfolio_first_child;
			} else {
				$next = $possibleNext;
			}

			//if this is the first item, add last item link to its previous link. 
			if( $the_portfolio_data.find('.portfolio-content-link').attr( "data-post_id" ) == $portfolio_first_child.find('.portfolio-content-link').attr( "data-post_id" ) ){
				$prev = $portfolio_last_child;
			} else {
				$prev = $possiblePrev;
			}			 
		} else {
			$possiblePrev = $the_portfolio_data.prev('.portfolio-data');
			$possibleNext = $the_portfolio_data.next('.portfolio-data');
			
			//if this is the last item, add first item link to its next link.
			if( $the_portfolio_data.find('.portfolio-content-link').attr( "data-post_id" ) == $portfolio_last_child.find('.portfolio-content-link').attr( "data-post_id" ) ){
				$next = $portfolio_first_child;
			} else {
				$next = $possibleNext;
			}

			//if this is the first item, add last item link to its previous link. 
			if( $the_portfolio_data.find('.portfolio-content-link').attr( "data-post_id" ) == $portfolio_first_child.find('.portfolio-content-link').attr( "data-post_id" ) ){
				$prev = $portfolio_last_child;
			} else {
				$prev = $possiblePrev;
			}			
		}
	  
      	var previous_item_id = '';
      	var next_item_id = '';
      	
      	// Get the id's of previous and next projects
      	if ( $prev.length !== 0 && $next.length !== 0 ) {
      		previous_item_id = $prev.find('.portfolio-content-link').attr( "data-post_id" );
      		next_item_id = $next.find('.portfolio-content-link').attr( "data-post_id" );
      	}
      	else if ( $prev.length !== 0 ) {
      		previous_item_id = $prev.find('.portfolio-content-link').attr( "data-post_id" );
      	}
      	else if ( $next.length !== 0 ) {
      		next_item_id = $next.find('.portfolio-content-link').attr( "data-post_id" );
      	}	
      	
		closePortfolioItem();		
		
		// add current-portfolio class if this is a currently opened item
		$the_portfolio_data.addClass('current-portfolio');
		
		$.ajax({        	      
			dataType: "html",
			type: "get",
         	url : customAjax.ajaxurl + "?action=retrieve_portfolio_item&nonce=" + customAjax.nonce,
			data : { post_id : post_id, prev_post_id : previous_item_id, next_post_id : next_item_id },
         	beforeSend: function() {         		
				$("html, body").animate({ scrollTop: 0 }, "slow");			
         	},
         	success: function(response) {
				$portfolioDetail.html( response );				
            	$("#shownPortfolio").load(function () { 
            		$(this).stop().animate({ opacity: 1 }, 300); 
            		
            	});				
         	},
         	complete: function() {				
				initializeSlider(post_id);
				initializeVideo();
				openProject($portfolioDetail);
				$( ".previous-portfolio, .next-portfolio" ).click( morphisGetPortfolio );
				$( '.previous-portfolio, .next-portfolio' ).click( displayLoading );
				$( ".close-portfolio" ).click( closePortfolioItem );				
				$( '#loader-img' ).fadeOut(500);
				$portfolioDetail.find('#shownPortfolio').stop().animate({ opacity: 1 }, 400);
								
				if($( '.next-portfolio' ).attr( "data-post_id" ) == '') {
					$( '.next-portfolio' ).css("display", "none");
				}
				if($( '.previous-portfolio' ).attr( "data-post_id" ) == '') {
					$( '.previous-portfolio' ).css("display", "none");
				}
				
				$('.slide-hover-effect').find('img').hover(
					function(){
						$(this).stop().animate({opacity: 0.8}, 750, 'easeOutCubic');					
					},function(){
						$(this).stop().animate({opacity: 1}, 750, 'easeOutCubic');										
					}
				);	
				
				$("a[rel^='prettyPhoto']").prettyPhoto({	
					callback: function() {},
					changepicturecallback: function(){					
						$pp_pic_holder = $(".pp_pic_holder");		
						var $media_src = encodeURI($pp_pic_holder.find('#pp_full_res').children(':first-child').attr('src'));		
						var $encoded_URL = encodeURI(location.origin + location.pathname);
						$('.pp_social').append('<div class="pinterest-posts"><a href="http://pinterest.com/pin/create/button/?url=' + $encoded_URL + '&media=' + $media_src + '" class="pin-it-button" count-layout="horizontal">Pin It</a><script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script></div>');
					}, /* Called everytime an item is shown/changed */			
				});	
				
				/* -------------- Image Overlay Effects  --------------*/			
				$('.overlay').hover(			
					function(){				
						$(this).find('img').animate({ opacity:'0.8' }, 450, 'easeInOutCubic');
						$(this).find('.icon-view').stop(true, true).animate({ opacity: '0.75' }, 10, 'swing'); //, marginTop: '-0.5em'
						$(this).find('.icon-link').stop(true, true).animate({ opacity: '0.75' }, 10, 'swing'); //, marginTop: '-0.5em'
						$(this).find('h5').animate({ opacity: '1' }, 10, 'linear');
					},function(){					
						$(this).find('h5').animate({ opacity: '0.0' }, 300, 'linear');
						$(this).find('.icon-view').stop(true, true).animate({ opacity: '0.0' }, 10, 'swing'); //, marginTop: parentHeight
						$(this).find('.icon-link').stop(true, true).animate({ opacity: '0.0' }, 10, 'swing');//, marginTop: parentHeight					
						$(this).find('img').animate({ opacity: '1' }, 450, 'easeInOutCubic');
					}
				);	
				/* Overlay icons hover effect */
				$('.overlay .icon-view, .overlay .icon-link').hover(			
					function(){				
						$(this).stop(true, true).animate({ opacity: '1' }, 20);					
					},function(){
						$(this).stop(true, true).animate({ opacity: '0.75' }, 20);	
					}
				);						
				
				/* -------------- Accordion  --------------*/					
				// Hide first All Div Content
				$(".accordion-content").hide();				
				//Add Inactive Class To All Accordion Headers
				$('.accordion-button').toggleClass('inactive-header');						
				//Open The First Accordion Section When Page Loads
				$('.accordion-button').first().toggleClass('active-header').toggleClass('inactive-header');
				$('.accordion-content').first().slideDown().toggleClass('open-content');				
				//The Accordion Effect
				$('.accordion-button').click(function ( event ) {
					event.preventDefault();
					if($(this).is('.inactive-header')) {
						$('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
						$(this).toggleClass('active-header').toggleClass('inactive-header');
						$(this).next().slideToggle().toggleClass('open-content');
					}					
					else {
						$(this).toggleClass('active-header').toggleClass('inactive-header');
						$(this).next().slideToggle().toggleClass('open-content');
					}
				});
				
				/* Tabs Activiation
				================================================== */
				var tabs = $('ul.tabs');
				tabs.each(function(i) {
					//Get all tabs
					var tab = $(this).find('> li > a');
					$($(tab).first().attr('href')).show().addClass('active').siblings().hide().removeClass('active');
					tab.click(function(e) {

						//Get Location of tab's content
						var contentLocation = $(this).attr('href');
						//Let go if not a hashed one
						if(contentLocation.charAt(0)=="#") {
							e.preventDefault();
							//Make Tab Active
							tab.removeClass('active');
							$(this).addClass('active');
							//Show Tab Content & add active class
							$(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
						}
					});
				});				
			} /* end complete method */
      	});
      	
      	e.preventDefault();   		
   	}
   	
 	$( ".portfolio-content-link" ).on( 'click', morphisGetPortfolio );   		
	
	initializePortfolio();
		   	
   	function closePortfolioItem() {   		
		//$.scrollTo(0, 600, { easing: 'easeOutCubic' });
		$("html, body").animate({ scrollTop: 0 }, "slow");
		
   		var $clickedObject = $(this);   		
   		if( $clickedObject.hasClass('close-current-post') ) {
   			$portfolioDetail.addClass('closedPortfolio');
   		}
   		
		$portfolioDetail.find('#shownPortfolio, #shownPortfolioMeta').stop().animate({ opacity: 0 }, 200);			
		$portfolioDetail.stop().animate({ height: 0 }, 800, 'easeOutQuart', function() { $(this).css('overflow', 'hidden');			
			if( $clickedObject.hasClass('close-current-post') ) {
   				$(this).empty();
   			}
		});		
		
		var $currentItem = $('#items').find('.current-portfolio');
		$currentItem.removeClass('current-portfolio');		
	}
	
	function openProject(portfolioDoor) {		
		var portfolioHeight = 0;
			portfolioDoor.imagesLoaded( function( $images, $proper, $broken ) {
			portfolioHeight = portfolioDoor.find('#shownPortfolio').outerHeight( true ) + portfolioDoor.find('.portfolio-single').next('hr').outerHeight(true);

			$portfolioDetail.animate({
				height: portfolioHeight
			}, 2000, 'easeOutQuart', function() {
				$(this).css({ 'height': 'auto' });
			});
		});	
	}
   	
    /* Initialize carouFredSel slider for Portfolio */	
   	function initializeSlider(the_post_id) {	
		/* -------------- "Portfolio Page" Gallery slider --------------*/
		if(jQuery().carouFredSel) {						
				$("#post-format-slides img:first").load(function() {					
					$('#post-format-slides').carouFredSel({							
						responsive: true,						
						items 		: { 
							width : 520,
							height: 'variable',
							visible: 1
						},						
						prev	: {	
							button	: "#slider-down",
							key		: "down"
						},
						next	: { 
							button	: "#slider-up",
							key		: "up"
						},
						pagination: "#slider-pagination",
						auto : {
							easing		: "easeInOutBack",
							duration	: 1000,
							pauseDuration: 5000,
							pauseOnHover: true
						},
						scroll : {
							fx : 'crossfade'
						}
					});		
				});
		}		
	}
	
	/* Initialize fitVids for videos */	
   	function initializeVideo() {
		if(jQuery().fitVids) {
			$(".video-figure").fitVids();
		}
	}
	
	/* Display Loading Image  */
	
	function displayLoading() {
		$( '#loader-img' ).css('visibility', 'visible').fadeIn(1200); }
		$( '.portfolio-content-link' ).click( displayLoading );
	
	/*---*/	
	initializeSlider();
	initializeVideo();
	
	$( ".close-portfolio, .previous-portfolio, .next-portfolio" ).click( function() {			
		if ( !$( 'html' ).hasClass('ie8') ) {			
			var $clickedObject = $(this);			
			if( $clickedObject.hasClass('close-current-post') ) {
	   			$portfolioDetail.addClass('closedPortfolio');
	   		}	   		
			$portfolioDetail.find('#shownPortfolio, #shownPortfolioMeta').stop().animate({
				opacity: 0
			}, 200);
				
			$portfolioDetail.stop().animate({
				height: 0
			}, 600, 'easeOutQuart', function() {
				$(this).css('overflow', 'hidden');
				
				if( $clickedObject.hasClass('close-current-post') ) {
   					$(this).empty();
   				}
			});		
		}		
	});
	
	if ( !$( 'html' ).hasClass('ie8') ) {
		$( ".previous-portfolio, .next-portfolio" ).click( morphisGetPortfolio );	
	}
	
	$( '.previous-portfolio, .next-portfolio' ).click( displayLoading );
});