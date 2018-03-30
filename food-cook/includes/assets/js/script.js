(function($){

dahzMasonry = {
   
   init: function(){
   var  _gridFit = $('.latest-blog, .recipe-content');

    	_gridFit.hover(function(){
			_gridFit.isotope('layout');
    	});

        if( _gridFit.length ){
           
	        dahzMasonry.gridFit();

	    	_gridFit.imagesLoaded( function() {
				_gridFit.isotope('layout');
	        });

        }  
 
    },

    gridFit: function (){
		if( $('.latest-blog, .recipe-content').length ){
	        $('.latest-blog, .recipe-content').isotope({
	            itemSelector: '.blog-item, .recipe-grid-item',
	            layoutMode: 'fitRows',
	        });
	    }
    },
 

    };
  

})(jQuery);


var DAHZ = DAHZ || {};

(function($){
	"use strict";

    DAHZ.$win = $(window);
    DAHZ.$body = $('body');
    DAHZ.$rtl = $('body').hasClass('rtl');

	DAHZ.init = {

		initSite: function(){
        	
        	var init = this;

        	/*masonry init*/
   			dahzMasonry.init();

	        DAHZ.$win.load(function(){
	        	dahzMasonry.init();
	        });

	        // FitVids - Responsive Videos
			$( ".post, .widget, .panel" ).fitVids();
			$( '.entry' ).fitVids();

			// Add parent class to nav parents 
			jQuery("ul.sub-menu, ul.children").parents().addClass('parent');

			// Print page code
	
			$('#print-page').click(function(){
				window.print();
				return false;	
			});

			/*modal*/
			$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });	

			// Pretty Photo Relation Target
			$("a[rel^='prettyPhoto']").prettyPhoto(); 	

			// Recipe submit form
			$('#recipe-form').validate();

			/*all js init*/
       		init.owlCarousel();
       		init.mobileMenu();
       		init.tooltip();
       		init.goTop();
       		init.mobileFullWidth();
       		init.parallax();
       		init.focusAndBlur();
       		init.megaMenu();
       		init.fontSizeSingleRecipe();
       		init.mobileToggleMenu();
       		init.contactAjaxValidation();
       		init.tabed();
		 	init.accordion();
	 		init.toggle();
	 		init.bookmark();
	 		init.submitRecipe();
       		init.flexSlider();
       		init.ajaxSearch();
	 		init.ratingRecipe();
	 		init.resTabs();


	 		DAHZ.$win.load(function(){
       			init.owlCarousel();
	        });
		}, /*initSite*/

		owlCarousel: function(){
			// If grab get max height
			function findHeight(){
			    var max 		  = -1,
			    	slider_active = '.recipe-item .owl-item.active, .featured-slider .owl-item.active, .sc-rlp-slider-1 .owl-item.active',
			    	slider_outer  = '.recipe-item .owl-stage-outer, .featured-slider .owl-stage-outer, .sc-rlp-slider-1 .owl-stage-outer';
			    jQuery( slider_active ).each(function( i ) {
			        var h = jQuery(this).height(); 
			        max = h > max ? h : max;
			    });
			    jQuery( slider_outer ).css( 'height', max );
			}; /*findHeight*/

			var flag 		= false,
				duration 	= 300;

			// slider recipes grid + list template
			$( '.recipe-item' ).owlCarousel({
				margin: 0,
				items: 1,
				dots: true,
				onTranslated: findHeight,
				nav: true,
				navText: [
		            "<i class='fa fa-angle-left'></i>",
		            "<i class='fa fa-angle-right'></i>"
		        ]
			}).on('changed.owl.carousel', function(e) {

				if (!flag) {

					flag = true;
					$( '.recipe-pagination' ).trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}

			});

			$( '.recipe-pagination' ).owlCarousel({
				margin: 10,
				items: 6,
				dots: true
			}).on('click', '.owl-item', function() {
				$( '.recipe-item' ).trigger( 'to.owl.carousel', [$(this).index(), duration, true]);
			}).on('changed.owl.carousel', function(e) {

				if (!flag) {

					flag = true;		
					$( '.recipe-item' ).trigger('to.owl.carousel', [e.item.index, duration, true]);
					flag = false;
				}

			});

			// related recipe
			$( '.related-recipe' ).owlCarousel({
				margin: 10,
				items: $( 'body' ).hasClass( 'one-col' ) ? 3 : 2,
				dots: true,
				onTranslated: findHeight,
				
			});

			// slider for single recipe featured image
			$( '.featured-slider, .sc-rlp-slider-1, .sc-rlp-slider-2' ).owlCarousel({
				margin: 0,
				items: 1,
				nav: true,
				onTranslated: findHeight,
				navText: [
		            "<i class='fa fa-angle-left'></i>",
		            "<i class='fa fa-angle-right'></i>"
		        ]
			});

			// slider for method
			$( '.method-slider' ).owlCarousel({
				margin: 0,
				items: 1,
				nav: true,
				onTranslated: findHeight
			});

			findHeight();

		},/*owlCarousel*/

		mobileMenu : function(){
		  	// Show/hide the main navigation
		  	$('.nav-toggle').click(function() {
			  $('#navigation').slideToggle('fast', function() {
			  	return false;
			    // Animation complete.
			  });
			});
			
			// Stop the navigation link moving to the anchor (Still need the anchor for semantic markup)
			$('.nav-toggle a').click(function(e) {
		        e.preventDefault();
		    });
		}, /*mobileMenu*/

		tooltip : function(){

			$('.star-rating, ul.cart a.cart-contents, .cart a.remove, .added_to_cart, a.tiptip').tipTip({
				defaultPosition: "top",
				delay: 0
			});

			$('.tooltip').hide();

			$('.tip, .tip2, .tip3, .tip4, .tip5, .tip6, .tip7, .tip8').hover(function () {
			    $(this).find('.tooltip').fadeToggle('fast');
			});

		},/*tooltip*/

		goTop : function(){
			// Animate the scroll to top
			$('.go-top').click(function(e) {
				e.preventDefault();
				$('html, body').animate({scrollTop: 0}, 300);
			});

			DAHZ.$win.scroll(function() { 

				if ($(this).scrollTop() > 200) {

					$('.go-top').fadeIn(200);

				} else {

					$('.go-top').fadeOut(200);
				}

			});

		}, /*goTop*/

		mobileFullWidth : function(){
			function fullWidthWrap(){

				if( $(".full-width-wrap").length ){

						$(".full-width-wrap").each(function(){
							
						var $_this = $(this),
						offset_wrap = $_this.position().left;

						$_this.css({
							width: $('#wrapper').width(),
							marginLeft: -offset_wrap
						});
					});

				};

				if( $(".full-width-wrap").length && !fcGlobals.isiPhone ){

				 	if(fcGlobals.isMobile){

					    $(window).bind("orientationchange", function() {
					      	fullWidthWrap();
					    }).trigger( "orientationchange" );

				  	} else {

					    $(window).on("resize", function(){
					        fullWidthWrap();
					    }).trigger("resize");

				  }
				};
			};/*fullWidthWrap*/
		}, /*mobileFullWidht*/

		parallax : function(){
			/* Fancy Header Parallax */
			if (!fcGlobals.isMobile) {
			    $('.df-fancy-header-parallax').each(function() {
			        var $_this = $(this),
			        	speed_prl = $_this.data("fancy-prlx-speed");

			        $(this).parallax("50%", speed_prl);
			        $('.df-fancy-header-parallax').addClass("fancy-header-parallax-done");

			    });
			}
				
			/* Row Parallax */
			if(!fcGlobals.isMobile){
			   	$('.parallax_out').each(function(){
			    	var $_this = $(this),
			      		speed_prl = $_this.data("prlx-speed");

			    	$(this).parallax("50%", speed_prl);
			   		$('.parallax_out').addClass("parallax-bg-done");

			  	});
			}
		}, /*parallax*/

		focusAndBlur : function(){
			var addFocusAndBlur = function($input, $val){
				
				$input.focus(function(){
					if (this.value == $val) {this.value = '';}
				});
				
				$input.blur(function(){
					if (this.value == '') {this.value = $val;}
				});
			}

			// example code to attach the events
			addFocusAndBlur($('#s'),'Search for');
			addFocusAndBlur($('#cname'),'Name here');
			addFocusAndBlur($('#cemail'),'Email here');
			addFocusAndBlur($('#cmessage'),'Message');
			addFocusAndBlur($('#message'), 'Type your comments here');
		}, /*focusAndBlur*/

		megaMenu : function(){
	 		var windowWidth = jQuery(window).width(),
			    mega_menu  = $('.df-mega-menu').length;

			if (mega_menu != '0') {
			    $('body').addClass('has-mega-menu');     
			}


			if (windowWidth > 959) {
				megaMenuCenter();
				megaMenuRight();
				megaBackground();
			}/*window width*/

	       	$(window).resize(function(e) {
				var winWidth = $(window).width();
				if (winWidth > 959) {
					megaMenuCenter();
					megaMenuRight();
					megaBackground();
				}/*window width*/
			});

			function megaBackground(){
				jQuery('.df-mega-menu').each(function() {
			        if ($(this).find('> a > .mega-icon > img').length != '0') {
			            $(this).addClass('df-mega-menu-img');
			            var background_megamenu = $(this).find('> a > .mega-icon > img').attr('src');
			            background_megamenu = 'url("' +background_megamenu+'")' 
			            $(this).find('> .sub-nav ').css('background-image', background_megamenu);
			            $(this).find('ul ul').css('background', 'transparent');
			        };
			    });
			}/*megaBackground*/

		    function megaMenuRight(){
				if ($('.mega-position-right').length) {
					jQuery('#main-nav').each(function() {
						$(this).find('.mega-position-right').hover( function(){
			                var menu_right = $(this),
			                	left_position = menu_right.position().left,
			                	mega_right = menu_right.parent(),
			                	mega_menu_width = findWidth(mega_right),
			                	half = 1;

			                   	position(left_position, menu_right, mega_menu_width, half);
			            });
					});
				} 
		    }/*megaMenuRight*/

		    function megaMenuCenter(){
			    if ($('.mega-position-center').length) {
			    	jQuery('#main-nav').each(function() {
			            $(this).find('.mega-position-center').hover( function(){
			                var menu_center = $(this),
			                	left_position = menu_center.position().left,
			                	mega_center = menu_center.parent(),
			                	mega_menu_width = findWidth(mega_center),
			                	half = 0.5;

			                   	position(left_position, menu_center, mega_menu_width, half);
			            });
			        });
			    }
		    }/*megaMenuCenter*/

		    function position(left_position, menu, width, half){
				var nav_width = $('#main-nav').width(),
					menu_width = nav_width * width - menu.width();

	            left_position = left_position - menu_width * half;
	            menu.find('> .sub-nav').css('left', left_position + 'px');
	            
	        }/*position*/

	        function findWidth(mega_menu_width){
	        	var width = 0;
	        	if (mega_menu_width.find('.mega-column-2').length) {
	                return width = 0.4;
	            }else if(mega_menu_width.find('.mega-column-3').length){
	                return width = 0.6;
	            }else if(mega_menu_width.find('.mega-column-4').length){
	                return width = 0.8;
	            }
	        }/*findWidth*/

	 	},/*megaMenu*/

	 	fontSizeSingleRecipe : function(){
			var tb = $('div.boxinc');

			$('button.increase').on('click', function(){
				tb.css('font-size', '+=2')
			});

			$('button.decrease').on('click', function(){
				tb.css('font-size', '-=1')
			});
	 	}, /*fontSizeSingleRecipe*/

	 	mobileToggleMenu : function(){
			var windowWidth = jQuery(window).width();
			if (windowWidth < 800) {
				jQuery('<span class="btnshow_nav"></span>').insertBefore('#navigation .sub-nav');
				 
				jQuery('#navigation .sub-nav').hide();

				jQuery('span.btnshow_nav').click(function() {

					//REMOVE THE ON CLASS FROM ALL BUTTONS
					$(this).removeClass('onacc_nav');
					  
					//NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
				 	$(this).next().slideUp('normal');

					//IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
					if($(this).next().is(':hidden') == true) {
						
						//ADD THE ON CLASS TO THE BUTTON
						$(this).addClass('onacc_nav');

						//OPEN THE SLIDE
						$(this).next().slideDown('normal');
					 }  
				});
			}
	 	}, /*mobileToggleMenu*/

	 	contactAjaxValidation : function(){
 			$('#contact-form').validate({
				submitHandler: function(form) {
			   			$(form).ajaxSubmit(contact_options);
			   }
			});
	 	}, /*contactAjaxValidation*/

	 	tabed : function(){
	 		$('.tabed .tabs li:first-child').addClass('current');
			$('.tabed .block:first').addClass('current');
			
			$('.tabed .tabs li').click(function(){
					var tabNumber = $(this).index();
					$(this).parent('ul').siblings('.block').removeClass('current');
					$(this).siblings('li').removeClass('current');
					$(this).addClass('current');
					$(this).parent('ul').parent('.tabed').children('.block:eq('+ tabNumber +')').addClass('current');
			});

			var $tabs = $( "#recipe-tabs" );
			    $tabs.tabs({ fx: { opacity: 'toggle' } }).tabs();
			    var offst = 0;
			    $('#recipe-tabs > div').each(function(index, elem) {
			        if ($(elem).html().trim() === '') {
			             $('.recipe_how_to').hide();
			        }
			    });

			$('.menuLink').click(function(){

		    $('a').removeClass('active');
		    $(this).addClass('active');
			});

	 	}, /*tabed*/

	 	accordion : function(){

			$('.accordion h5').click(function(){
				if(!$(this).hasClass('current')){
					var tabNumber = $(this).index();
					$('.accordion .pane.current').slideUp(700, function(){ $(this).removeClass('current'); });
					$(this).next('.pane').show('blind',700,function(){ $(this).addClass('current'); });
					$('.accordion h5.current').removeClass('current');
					$(this).addClass('current');
				}
			});

			$('.accordionContent').hide();
		 
		  //ACCORDION BUTTON ACTION (ON CLICK DO THE FOLLOWING)
			$('.accordionButton').click(function() {

				//REMOVE THE ON CLASS FROM ALL BUTTONS
				$('.accordionButton').removeClass('onacc');
				  
				//NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
			 	$('.accordionContent').slideUp('normal');
		   
				//IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
				if($(this).next().is(':hidden') == true) {
					
					//ADD THE ON CLASS TO THE BUTTON
					$(this).addClass('onacc');
					  
					//OPEN THE SLIDE
					$(this).next().slideDown('normal');

					$('.recipe-content').isotope('layout');
				 } 
				  
			 });
			
			//ADDS THE .OVER CLASS FROM THE STYLESHEET ON MOUSEOVER 
			$('.accordionButton ').mouseover(function() {
				$(this).addClass('overacc');
				
			//ON MOUSEOUT REMOVE THE OVER CLASS
			}).mouseout(function() {
				$(this).removeClass('overacc');										
			});
	 	}, /*accordion*/

	 	toggle : function(){
			$('.toggle-box ul li p').slideUp('slow');
			$('.toggle-box ul li h5').click(function(){
					if($(this).parent('li').hasClass('active')){
					  		$(this).stop(true, true).siblings('p').slideUp('slow');
							$(this).parent('li').removeClass('active');
					} else {
							$(this).stop(true, true).siblings('p').show('blind', 500);
							$(this).parent('li').addClass('active');
					}
			}); 		
	 	}, /*toggle*/

	 	rating : function(){
			// Rating System Code
			var rate_status;
			$('#rate-product .rates span').hover(function(){
				var itemCount = $(this).index()+2;
				var i = 0;
				while(i<itemCount){
						$('#rate-product .rates span:nth-child('+ i +')').removeClass('off');
						i++;
				}
				
			},function(){
				var i = 0;
				$('#rate-product .rates span').addClass('off');
				while(i<rate_status){
						$('#rate-product .rates span:nth-child('+ i +')').removeClass('off');
						i++;
				}
			});
			$('#rate-product .rates span').click(function(){
					
				rate_status = $(this).index()+2;
				
				$('#selected_rating').attr('value',rate_status-1);
				
				var options = { 
				        target:        '#output',   // target element(s) to be updated with server response 
				        beforeSubmit:  function(){},  // pre-submit callback 
				        success:       function(){
														$('#rate-product').fadeOut('slow',function(){
															$('#output').fadeIn('slow');	
														});
												}
				    };

				$('#rate-product').ajaxSubmit(options);
					
			});
	 	}, /*rating*/

	 	bookmark : function(){
	        $('#bookmarkme').click(function() {
	            if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark

	                window.sidebar.addPanel(document.title,window.location.href,'');

	            } else if(window.external && window.external.AddFavorite) { // IE Favorite

	                window.external.AddFavorite(location.href,document.title); 

	            } else if(window.opera && window.print) { // Opera Hotlist

	                this.title=document.title;
	                return true;

	            } else { // webkit - safari/chrome

	                alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != - 1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
	            }
	        });
	 	}, /*bookmark*/

	 	submitRecipe : function(){
		// Add more clones
			$( '.add-clone' ).click( function (){
				$( '.remove-clone' ).show();
				var	$input      = $( this ).parents( '.rwmb-input' ),
					$clone_last = $input.find( '.rwmb-clone:last' ),
					$clone      = $clone_last.clone( true );

				$clone.insertAfter( $clone_last );

				// Reset value
				$clone.find( ':input' ).val( '' );

				// Toggle remove buttons
				return false;
			} );
				
			// Remove clones
			$( '.remove-clone').click(function(){
				var $this  = $( this ),
					$input = $this.parents( '.rwmb-input' );

		 		if ( $( '.remove-clone' ).length <= 1 ){
					$( '.remove-clone' ).hide();
				}

				// Remove clone only if there're 2 or more of them
				if ( $input.find( '.rwmb-clone' ).length > 1 ){
					$this.parent().remove();

				}

				return false;
			} );

	 	}, /*submitRecipe*/

	 	flexSlider : function(){
	 		// flexslider
		        $('.fxslider').flexslider({
		        animation: "slide",
		         controlNav: false,
		        start: function(slider){
		          $('body').removeClass('loading');
		        }
		      });
		      
		 $('#carousel').flexslider({
		        animation: "slide",
		        controlNav: false,
		        animationLoop: false,
		        slideshow: false,
		        itemWidth: 210,
		        itemMargin: 5,
		        asNavFor: '#slider'
		      });
	 	}, /*flexSlider*/
	 	resTabs: function() {
			$('.woocommerceTabs').easyResponsiveTabs({
				type: 'default', 
				width: 'auto', 
				fit: true     
			});
	 	},
	 	ajaxSearch: function(){

			ajaxSearchStart();

			// ajax search show
			$(".df-ajax-search").click(ajaxSearchShow);
			
			// ajax search hide click
			$(".universe-search-close, .container-search-close, .search-container-close").click(ajaxSearchHide);
			
			// ajax search hide esc pressed
			$(document).keyup(function(e) {
		        if (e.keyCode == 27) {  
					ajaxSearchHide();
				}
			});

			// function ajax search
		    function ajaxSearchStart(){
				$('#searchfrm').keypress(function(e) {
		            var value = $(this).val(),
		        		length = value.length;

		            if(length > 1 && e.keyCode == 13) {
		    			$(".universe-search-results").removeClass('hide');
		    			$(".universe-search-results").addClass('animated fadeIn');
		                
		                $.post(ajaxurl, { action: 'ajax_search', s: value}, function(output) {
		                    $('.universe-search-results .nano-content').html(output);
		    				$(".search-results-scroller").nanoScroller();

		                });
		            }
		            nano_init();
		        });
		    }/*ajaxSearchStart function*/

		    function ajaxSearchShow(){
		    	$(".universe-search").fadeIn(300).css('display','block').addClass('ajax-search-active');
		    	$(".universe-search-form .universe-search-input").focus().val('');
		    	$(".universe-search-results").addClass('hide');
		    }/*ajaxSearchShow function*/

		    function ajaxSearchHide(){
		        $(".universe-search").fadeOut(300).removeClass('ajax-search-active');
		    }/*ajaxSearchHide function*/

		    function nano_init(){

		        var containerNano = jQuery('.universe-search-results'),
		        window_height= $(window).height();
		        var nano_height = window_height - 250;

		        if (fcGlobals.isAndroid) {
		            var nano_height = window_height - 91 - 44;
		            nano_height = nano_height + 250;
		        }
		        
		        containerNano.css('height', nano_height);
		      
		    }/*jsp_init function*/
		},/*ajaxSearch function*/
		
		ratingRecipe : function() {
				$('#rate-product .df-rating-star').on( 'click', function(e){
			  		if( e.target.tagName === "INPUT" ) {

						var rate_status = $('.df-rating-star input[name=rating]:checked').val()
						$('#selected_rating').attr('value',rate_status);
						
						var options = { 
						        target:        '#output',   // target element(s) to be updated with server response 
						        beforeSubmit:  function(){},  // pre-submit callback 
						        success:       function(){
																$('#rate-product').fadeOut('slow',function(){
																	$('#output').fadeIn('slow');	
																});
														}
						    };
					
						$('#rate-product').ajaxSubmit(options);
			   		}
				});
		}, /*rating*/
		 
	}/*DAHZ.init*/

}(jQuery));

(function($) {
	DAHZ.init.initSite();
})(jQuery);

 