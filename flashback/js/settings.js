/*================================================================================================================

	Custom Settings

================================================================================================================*/



jQuery.noConflict();



/* After DOM is Initialized */

jQuery(document).ready(function(){



	// Global
	
	var body = jQuery("body");
	

	
	// Animation
	
	
		// Nav
		
		var nav = jQuery("#nav, #nav .nav");
		nav.delay(300).animate({top: 0}, 400);
		
		// Widgets
		
		var tog = jQuery(".tog");
		var widgets = jQuery("#widgets");
		var footer = jQuery("#footer");
		var open = jQuery(".open");
		var close = jQuery(".close");
		
		
		tog.toggle(
		
			function() {
				widgets.animate({height: "270px", paddingTop: "30px"});
				footer.animate({height: "376px", bottom: "0"});
				open.hide();
				close.show();
			},
			
			function() {
				widgets.animate({height: "0", paddingTop: "0"});
				footer.animate({height: "76px", bottom: "-40px"});
				close.hide();
				open.show();
			}
		
		);

	
	
	// Form Background Color
	
		jQuery("input[type=text], textarea").focus(function() {
		    jQuery(this).stop(true,true).animate({backgroundColor: "#323439"}, 200);
		});
		
		jQuery("input[type=text], textarea").blur(function() {
		    jQuery(this).stop(true,true).animate({backgroundColor:"#eaeaea"}, 200);
		});
	
	
	
	// Form Label Hide
	
		/* Focus & Blur */
			
			jQuery("#contact_form p input, #contact_form p textarea, #commentform input,  #commentform textarea, #searchform input").focus(function() {
				jQuery(this).css({color: "#ffffff"});
			    jQuery(this).parent().find("> label").fadeOut(200);
			});
			
			jQuery("#contact_form p input, #contact_form p textarea, #commentform input,  #commentform textarea, #searchform input").blur(function() {
				jQuery(this).css({color: "#323232"});
			    jQuery(this).parent().find("> label").fadeIn(200).css({color: "#a7abad"});
			});
		
		/* Empty & Full */
		
			var input = jQuery("#contact_form p input, #contact_form p textarea, #commentform input,  #commentform textarea, #searchform input");
			
			input.blur(function() {
			
				if ( jQuery(this).val() != '') {
				
					
					    jQuery(this).parent().find("> label").hide();
				
				} else {
				
					    jQuery(this).parent().find("> label").show();
				
				}
			
			});
			
			
			
	// Image Fade
	
		jQuery("#posts .post img").mouseover(function(){
			jQuery(this).stop(true,true);
			jQuery(this).fadeTo(300, 0.7);
		});
		
		jQuery("#posts .post img").mouseout(function(){
			jQuery(this).fadeTo(400, 1.0);
		});
		
		
		
	// Fades
		
		/* Projects */
		jQuery(function(){
			jQuery("#projects").delegate("li", "mouseover mouseout", function(e) {
				if (e.type == 'mouseover') {
				jQuery("#projects li").not(this).dequeue().animate({opacity: "0.3"}, 200);
		    	} else {
				jQuery("#projects li").not(this).dequeue().animate({opacity: "1"}, 200);
		   		}
			});
		});
		
		/* Similar Projects */
		jQuery(function(){
			jQuery("#similar_projects").delegate("li", "mouseover mouseout", function(e) {
				if (e.type == 'mouseover') {
				jQuery("#similar_projects li").not(this).dequeue().animate({opacity: "0.3"}, 200);
		    	} else {
				jQuery("#similar_projects li").not(this).dequeue().animate({opacity: "1"}, 200);
		   		}
			});
		});
		
		/* Blog Posts */
		jQuery(function(){
			jQuery("#posts").delegate("li", "mouseover mouseout", function(e) {
				if (e.type == 'mouseover') {
				jQuery("#posts li").not(this).dequeue().animate({opacity: "0.5"}, 200);
		    	} else {
				jQuery("#posts li").not(this).dequeue().animate({opacity: "1"}, 200);
		   		}
			});
		});
		
		/* Services */
		jQuery(function(){
			jQuery("#services").delegate("li", "mouseover mouseout", function(e) {
				if (e.type == 'mouseover') {
				jQuery("#services li").not(this).dequeue().animate({opacity: "0.5"}, 200);
		    	} else {
				jQuery("#services li").not(this).dequeue().animate({opacity: "1"}, 200);
		   		}
			});
		});
	
	
	
	// PrettyPhoto
	
		jQuery(".pretty").prettyPhoto({animation_speed:"fast",slideshow:7000});
		
		
		
	// Project Image Span
	
		jQuery(".single-project .project_thumb").hover(
		
			function()
		    {
		        jQuery(this).find("span").stop(true,true).fadeIn();
		    },
		    function()
		    {
		        jQuery(this).find("span").stop(true,true).fadeOut();
		    }
		
		);
					
	
	
	// Menu Animation
	
		/* Variables */
		
			var nav = jQuery("#nav, #nav .nav");
				navLink = jQuery("#nav li a, #nav .nav li a, #project_sort a, #archives ul li a, .widget ul li a").not(".current-menu-item a, .current_page_item a");
			
		/* CSS */
		
			if (body.hasClass('home')) {
		
				nav.find("li:first").addClass("active");
			
			}
		
			navLink.css({opacity: .5});
			jQuery("#nav li span, #nav .nav li span").css({opacity: .5});
		
		/* Hover */
		
			navLink.hover(
			    function()
			    {
			        jQuery(this).stop(true,true).animate({opacity: 1}, 200);
			    },
			    function()
			    {
			        jQuery(this).stop(true,true).animate({opacity: .5}, 200);
			    }
			);
	
	
	
	// Sub Menus
		
		jQuery("#header #nav ul li, #header #nav .nav ul li").hover(
		    function()
		    {
		        jQuery(this).find("> ul").stop(true,true).slideDown();
		    },
		    function()
		    {
		        jQuery(this).find("> ul").stop(true,true).slideUp();
		    }
		);
			
	
	
});



/* After page is loaded */

jQuery(window).load(function(){



	// Projects - Isotope
	
		jQuery(function(){
	
		    var $projects = jQuery('#projects');
	
			$projects.imagesLoaded(function(){
				$projects.isotope({
					itemSelector : '.project',
					resizable: false,
					masonry: { columnWidth: $projects.width() / 3 }
				});
			});
			
			$projects.infinitescroll({
			
					navSelector  : '#project_nav',
					nextSelector : '#project_nav a',
					itemSelector : '.project',
					loading: {
						finishedMsg: 'No more projects.',
						msgText: "Loading more projects ...",
						img: 'wp-content/themes/flashback/images/loader.gif'
					}
					
				},
	
				function( newElements ) {
				
					var $newElems = jQuery( newElements ).css({ opacity: 0 });
					
					$newElems.imagesLoaded(function(){
					
						$newElems.animate({ opacity: 1 });
						$projects.isotope( 'appended', $newElems, true ); 
						
						// Project Overlay Title
		
							jQuery(".project_overlay").each(function() {
							
								var overlay = jQuery(this).parent();
								
									tl = jQuery(this).find(".tl");
									tlH = tl.height();
									overlayH = overlay.height();
									tlM = (overlayH / 2) - (11);
							
								tl.css({marginTop: tlM + "px" });
							
							});
					
						// Project Overlays
					
							jQuery(".project").hover(
								function()
								{
									jQuery(this).find(".project_overlay").stop(true,true).fadeTo(300, 1);
								},
								function()
								{
									jQuery(this).find(".project_overlay").stop(true,true).fadeTo(700, 0);
								}
							);
						
					});
				
				}
		      
		    );
		    
		    // update columnWidth on window resize
				jQuery(window).smartresize(function(){
				   $projects.isotope({
				     resizable: false, // disable normal resizing
				     masonry: { columnWidth: $projects.width() / 3 }
				   });
				   // trigger resize to trigger isotope
				}).smartresize();
				
				// trigger isotope again after images have loaded
				$projects.imagesLoaded( function(){
				  jQuery(window).smartresize();
				});
		    
		    // filter isotope items
		    
				jQuery('.filter li a, #filter_drop option').not("#shuffle").click(function(){
					
					jQuery('.filter li a, #filter_drop option').removeClass('active');
					jQuery(this).addClass('active');
					
					var selector = jQuery(this).attr('data-filter');
					$projects.isotope({ filter: selector });
					
					return false;
					
				});
				
			// select filter
			
				jQuery("#filter_drop").change(function() {
			        var filters = jQuery(this).val();
			        $projects.isotope({
			            filter: filters
			        });
			    });
				
			// shuffle isotope items
				
				jQuery('#shuffle').click(function(){
			
					$projects.isotope('shuffle');
					
				});
		
		});
		
		// Project Overlay Title
		
			jQuery(".project_overlay").each(function() {
			
				var overlay = jQuery(this).parent();
				
					tl = jQuery(this).find(".tl");
					tlH = tl.height();
					overlayH = overlay.height();
					tlM = (overlayH / 2) - (11);
			
				tl.css({marginTop: tlM + "px" });
			
			});
	
		// Project Overlays
	
			jQuery(".project").hover(
				function()
				{
					jQuery(this).find(".project_overlay").stop(true,true).fadeTo(300, 1);
				},
				function()
				{
					jQuery(this).find(".project_overlay").stop(true,true).fadeTo(700, 0);
				}
			);
		

});