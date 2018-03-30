jQuery(document).ready(function($) {    
	"use strict";
	
	// filtering subcategories
	var theFilter = $(".filter");
	var containerFrame = $(theFilter).closest(".container-frame")
	var filterHeight = $(".filter").children("li").first().find("a").outerHeight(true);
	
	function addFilterHeight( addHeight, op ) {
		$(containerFrame).animate( { marginBottom: op + addHeight + "px" }, 1200);
	}
		
	$(theFilter).children("li").children("a").on( "click", 	
			function() {	
				var thisChildren = $(this).siblings('.children');
				var thisChildrenDisplay = $(thisChildren).css("display");
				var activeFilter = $(this).closest('li');				
				$(this).closest('.filter').find('li').removeClass('active-sub-filter');
				$(activeFilter).addClass('active-sub-filter');				
				// spacing for multi-line filters
				var spacingMultiLine = ($(theFilter).height() - $(activeFilter).height() - $(this).position().top);
				
				if(thisChildrenDisplay == "block") { // block: already clicked
				
				} else if(thisChildrenDisplay == "none") { // none: first time clicked				
					$(theFilter).find('.children').slideUp("fast");					
					// normalize spacing
					$(theFilter).find('.children').css("marginTop", 10);
					// first level spacing					
					addFilterHeight(60 + $(thisChildren).outerHeight(true), "");										 
					// first level filters spacing 
					$(thisChildren).css("marginTop", "+=" + spacingMultiLine);
					// show first level children filters
					$(thisChildren).slideDown("fast");											
					
					// all the children filters click function
					$(this).siblings(".children").find("li").find("a").on( "click", 
						function() {	
							var nestedChildren = $(this).siblings('.children');	
							var nestedChildrenHeight = parseInt(filterHeight);// $(nestedChildren).outerHeight(true); since 1.7
							var activeSubFilter = $(this).closest('li');
							
							// remove highlight
							$(this).closest(".children").find("li").removeClass('active-sub-filter');
							// hide all children .children
							$(this).closest(".children").find('.children').hide();							
							// add highlight
							$(activeSubFilter).addClass('active-sub-filter');
							
							if($(nestedChildren).css("display") != "block") { // first time or no children
								if($(nestedChildren).css("display") == "none") {
									$(nestedChildren).slideDown("fast", function() {
										// add spacing when first time
											$multiplier = $(theFilter).find('ul.children:visible').size();
											addFilterHeight((nestedChildrenHeight * $multiplier) + 60, "");										
									});
									
								} else { // no children
									$multiplier = $(theFilter).find('ul.children:visible').size();
									//nestedChildrenHeight = $(this).closest("ul.children").outerHeight(true); since 1.7
									addFilterHeight((nestedChildrenHeight * $multiplier) + 60, "");
								}
							} else { // already clicked
								
								//hide all siblings "li" children
								$(this).closest("li").siblings("li").find("ul.children").hide();
							
								$(nestedChildren).slideDown("fast", function() {
									// add spacing when first time									
										$multiplier = $(theFilter).find('ul.children:visible').size();
										addFilterHeight((nestedChildrenHeight * $multiplier) + 60, "");										
								});								
							}
						}
					);
					
				} else { // undefined  no children
				    // first level filters spacing 
					$(theFilter).find('.children').css("marginTop", 10);
					$(theFilter).find('.children').slideUp("fast");					
					// set to default spacing
					addFilterHeight(60, "");
				}
			}
	);				
	// end filtering subcategories
	
	// Initialize prettyPhoto
	$(".portfolio a[rel^='prettyPhoto']").prettyPhoto({
		theme:'pp_default', 
		autoplay_slideshow: false, 
		overlay_gallery: false, 
		show_title: false,
		counter_separator_label: '/',
		social_tools: false
	});

	// clone portfolio items 
	var $portfolioClone = $(".portfolio").clone();
	
	// Attempt to call Quicksand on every click event handler
	$(".filter li a").click(function(e){		
		// remove "current" class from currently selected filter
		$(".filter li a").removeClass("current");			
		// Get Filter type
		var $filterClass = $(this).attr("class");

		if ( $filterClass == "all" ) {
			var $filteredPortfolio = $portfolioClone.find("li");
		} else {
			var $filteredPortfolio = $portfolioClone.find("li[data-type~=" + $filterClass + "]");
		}
		
		//Set variable for items in a row; default is 4
		var items_in_a_row = 4;		
		// Remove current class 
		$( ".filter li a" ).removeClass( "current" ); 
		
		// no. of columns will depend on portfolio layout for mobile, tablet or screen view
		if ( $( '#items' ).hasClass('three-columns') ) { items_in_a_row = 3	}
		else if ( $( '#items' ).hasClass('with-sidebar') ) { items_in_a_row = 3 }
		else if ( $( '#items' ).hasClass('two-columns') ) { items_in_a_row = 2 }
		else { items_in_a_row = 4 }
		
		var $filterType = $(this).attr("class").split(" ")[0]; 
		$(this).addClass("current"); 
		
		if ($filterType == "all") { 
			var $filteredDataType = $portfolioClone.find("li[data-type]"); 
			var i = 1; 
			
			$filteredDataType.each(function() {
				var $self = $(this);
				$self.removeClass("alpha omega");
				
				if(i === 1) {
					$self.addClass("alpha");
				}
				else if( i === items_in_a_row ) {
					$self.addClass("omega");		
					
				}
				
				if ( i === items_in_a_row ) {
					i = 1;
				}
				else {
					i++;
				}
			});
		
		}
		else {
			var $filteredDataType = $portfolioClone.find("li[data-type~=" + $filterClass + "]");
			var i = 1;
			$filteredDataType.each(function() {
				var $self = $(this);
				$self.removeClass("alpha omega");
				
				if ( i === 1 ) {
					$self.addClass("alpha");
				}
				else if ( i === items_in_a_row ) {
					var $html = $self.html();
					$self.addClass("omega");		
					
				}
				
				if( i === items_in_a_row ) {
					i = 1;
				}
				else {
					i++;
				}
			});
		}
		
		// Call quicksand
		$(".portfolio").quicksand( $filteredPortfolio, { 
			duration: 800,
			easing: 'linear',
			adjustHeight: 'dynamic',
			useScaling: true,
			enhancement: function() {
				// portfolio item rounded 			
				$(document).ready(function(){		
					if(jQuery().roundThis){
							$(".portfolio-items").find('.overlay').find('img').roundThis($(this).width());						
					}
				});			
	        }
		}, function(){
		
			//add prettyPhoto to cloned items
			$(".portfolio a[rel^='prettyPhoto']").prettyPhoto({
				autoplay_slideshow: false, 
				overlay_gallery: false, 
				show_title: true
			});
			
			if( $filterClass != 'all'){
				jQuery('.portfolio-items ul#items li.omega').after('<li class="clearer"><div class="clear"></div></li>');
			}
			jQuery('.portfolio').css('height', 'auto');			
			
			//portfolio item hover function
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
			
			$('.overlay .icon-view, .overlay .icon-link').hover(			
				function(){				
					$(this).stop(true, true).animate({ opacity: '1' }, 20);					
				},function(){
					$(this).stop(true, true).animate({ opacity: '0.75' }, 20);	
				}
			);			
			
			// portfolio callback
			$( '.portfolio-content-link' ).click( function() {
				$( '#loader-img' ).css('visibility', 'visible').fadeIn(1200); 
			});
			
			// add click event for each item		
			$( ".portfolio-content-link" ).on( 'click', morphisGetPortfolio );				
		});
		
		$(this).addClass("current");
		e.preventDefault();
	})
});