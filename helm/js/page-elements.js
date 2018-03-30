jQuery(window).bind("load", function() {
	jQuery('.preload-image:hidden').fadeIn(800);
	jQuery('.portfolio-ajax').css('opacity','1');
	jQuery('.portfolio-columns').css('opacity','1');
	jQuery('ul.portfolio-four li,ul.portfolio-three li,ul.portfolio-two li,ul.portfolio-one li').css('background','none');
});
jQuery(function($){
	//Detect Orientaiton change
	window.onload = orientationchange;
	window.onorientationchange = orientationchange;
	function orientationchange() {
		jQuery('ul.portfolio-list').css('height','auto');
	}
	
	jQuery.fn.equalCols = function(){
		//Array Sorter
		var sortNumber = function(a,b){return b - a;};
		var heights = [];
		//Push each height into an array
		jQuery(this).each(function(){
			heights.push($(this).height());
		});
		
		heights.sort(sortNumber);
		var maxHeight = heights[0];
		return this.each(function(){
			//Set each column to the max height
			jQuery(this).css({'height': maxHeight});
		});
	};
	// Set equal height for grid columns
	jQuery('.gridfour_col1,.gridfour_col2,.gridfour_col3,.gridfour_col4').equalCols();
	// Check on window resize and set equal height for responsive change
	jQuery(window).resize(function(){
		jQuery('.gridfour_col1,.gridfour_col2,.gridfour_col3,.gridfour_col4').css('height','auto');
		jQuery('.gridfour_col1,.gridfour_col2,.gridfour_col3,.gridfour_col4').equalCols();
	
	});
		
	var ajaxLoading=0;
	
	AjaxPortfolio = function(e) {
		// Initialize
	    var page = 1;
	    var loading = true;
		var loaded = false;
	    var $window = jQuery(window);
	    var $content = jQuery("body #ajax-portfolio-wrap");
	    var $contentData = jQuery("body #ajax-portfolio-content");
		var total = jQuery('.portfolio-ajax').length;
		var index;
		var nextStatus=true;
		var prevStatus=true;
		
		var isiPhone = navigator.userAgent.toLowerCase().indexOf("iphone");
		var isiPad = navigator.userAgent.toLowerCase().indexOf("ipad");
		var isiPod = navigator.userAgent.toLowerCase().indexOf("ipod");

		var altTotal=total-1;


	jQuery(".portfolio-ajax").click(function(){

		//Store this index
		index=jQuery(".portfolio-ajax").index(this);
		//Store the navigation ID as the current element
		jQuery('.ajax-gallery-navigation').attr('id', index);
		
		if (index==0) {
			jQuery('.ajax-prev').addClass('ajax-nav-disabled').css('cursor','default');
		}

		if (index==altTotal) {
			jQuery('.ajax-next').addClass('ajax-nav-disabled').css('cursor','default');
		}

		if (index>0) {
			jQuery('.ajax-prev').removeClass('ajax-nav-disabled').css('cursor','pointer');
		}			

		if (index<altTotal) {
			jQuery('.ajax-next').removeClass('ajax-nav-disabled').css('cursor','pointer');
		}
		

		//Get postID from rel attribute of link
		var postID = jQuery(this).attr("rel");
		//Grab the current displayed ID
		var DisplayedID = jQuery('.ajax-gallery-navigation').attr("rel");
		
		// Compare clicked and Displayed ID. Acts as Gatekeeper
		if (postID!=DisplayedID) {

			// Remove previous displayed set class
			jQuery('li').removeClass("portfolio-displayed");
		
			//Add portfolio post ID to attribute
			jQuery('.ajax-gallery-navigation').attr('rel', postID);
		
			//Add the class to currently viewing
			jQuery( '[data-portfolio=portfolio-'+postID+']').addClass('portfolio-displayed');

			// If iphone then scroll to Ajax nav bar - otherwise top of page
			if(isiPhone > -1) {
				jQuery('html, body').animate({
				    scrollTop: jQuery(".page-container").offset().top
				}, 2000);
			} else {
				jQuery('html, body').delay(500).animate({scrollTop:0}, 'slow');
			}
			
			jQuery(".ajax-portfolio-data").fadeOut('fast');
			jQuery(".ajax-portfolio-window").delay(500).slideUp('slow', function() {

				jQuery('#ajax-portfolio-loading').show();

				jQuery.ajax({
	                type       : "GET",
	                data       : { thepostID: postID },
	                dataType   : "html",
	                url        : mtheme_uri + "/includes/portfolio/ajax-loader.php",
	                beforeSend : function(){
						jQuery("#ajax-portfolio-content").remove();
	                },
	                success    : function(data){
						loaded = true;
						jQuery('#ajax-portfolio-loading').hide();
						jQuery("#ajax-portfolio-content").remove();
	                    $data = $(data);

	                    if($data.length){

	                        $content.append($data);
							jQuery(".ajax-portfolio-window").hide();
							jQuery('.ajax-portfolio-image-wrap').hide();
							jQuery(".ajax-portfolio-data").hide();
	                        jQuery('.ajax-portfolio-window').fadeIn(500, function(){
								jQuery(".ajax-portfolio-image-wrap").fadeTo(500, 1);
								jQuery(".ajax-portfolio-data").fadeTo(500, 1);
	                            loading = false;
	                        });
							jQuery('.ajax-portfolio-image-wrap img').bind('load', function() {
								jQuery('.ajax-portfolio-image-wrap img').delay(1000).fadeTo(1000, 1);
							});

								jQuery("#flex1").flexslider({
									slideshow: false,
									pauseOnAction: true,
									pauseOnHover: true,
									controlsContainer: "flexslider-container1",
									before: function(){
										jQuery('.flexslider-container-page').css('background-image','none');
									}
								});
								
							
	                    } else {
	                        jQuery('#ajax-portfolio-loading').hide();
	                    }
	                },
	                error     : function(jqXHR, textStatus, errorThrown) {
	                    jQuery('#ajax-portfolio-loading').hide();
	                    alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
	                }
	        	});
			});

			return false;
			}
		});
	
	}
	
	function AjaxNavigation() {
		
		// Next Clicked
		jQuery('.ajax-next').click(function(){
			
			if ( jQuery(".ajax-portfolio-window").is(':animated') || jQuery(".ajax-portfolio-image-wrap").is(':animated') ) return;
			
			var total = jQuery('.portfolio-ajax').length;
			var index = jQuery('.ajax-gallery-navigation').attr("id");

			currindex=parseInt(index);
			nextIndex=currindex+1;
			if (nextIndex!=total) {
				jQuery('.portfolio-ajax').eq(nextIndex).trigger('click');
			}
			
			return false;
			

		});

		// Clicked Prev	

		jQuery('.ajax-prev').click(function(){
			
			if ( jQuery(".ajax-portfolio-window").is(':animated') || jQuery(".ajax-portfolio-image-wrap").is(':animated') ) return;
			
			var index = jQuery('.ajax-gallery-navigation').attr("id");
			if (index=='-1') { index='0'; }
			currindex=parseInt(index);
			prevIndex=currindex-1;
			if (prevIndex!=-1) {
				jQuery('.portfolio-ajax').eq(prevIndex).trigger('click');
			}
			
			return false;
		});	
	}
	
	
	function QuickSandInit() {
		// Clone portfolio items to get a second collection for Quicksand plugin
		var $portfolioClone = jQuery(".portfolio-list").clone();

		// Attempt to call Quicksand on every click event handler
		jQuery(".portfolio-filter a").click(function(e){
		
			// Change filtered text upon click. This is displayed on top of the filterable choices.
			var SelectedFilterText = jQuery(this).text();
			jQuery('#filter-selected').text(SelectedFilterText);
		
			// Set index to zero and disable prev
			jQuery('.ajax-gallery-navigation').attr('id', '-1');
			jQuery('.ajax-prev').css('opacity','0.8');
			jQuery('.ajax-prev').css('cursor','default');
		
			jQuery(".portfolio-filter li").removeClass("current");	
		
			// Get the class attribute value of the clicked link
			var $filterClass = jQuery(this).parent().attr("class");

		
			if ( $filterClass == "all" ) {
				var $filteredPortfolio = $portfolioClone.find("li");
			} else {
				var $filteredPortfolio = $portfolioClone.find("li[data-type~=" + $filterClass + "]");
			}
		
			// Call quicksand
			jQuery(".portfolio-list").quicksand( $filteredPortfolio, { 
				duration: 800,
				adjustHeight: 'dynamic',
          	    easing: 'easeInOutQuad',
				enhancement: function() {
					//get stored value to highlight
					var portfolioID = jQuery('.ajax-gallery-navigation').attr("rel");
					jQuery( '[data-portfolio=portfolio-'+portfolioID+']').addClass('portfolio-displayed');
					jQuery('.portfolio-ajax').css('opacity','1');
					jQuery('a.portfolio-columns').css('opacity','1');
					jQuery('.preload-image:hidden').show();
					PrettyPhotoLightbox();
				}
			}, function(){
			 	AjaxPortfolio();
				HoverEffect();
				
			});
	

			jQuery(this).parent().addClass("current");

			// Prevent the browser jump to the link anchor
			e.preventDefault();
		});
	}
	
	function PrettyPhotoLightbox() {
		jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			opacity: 0.9,
			theme: 'dark_square',
			deeplinking: false,
			default_width: 700,
			default_height: 444,
			overlay_gallery: false,
			show_title: false,
			social_tools: false
		});
	}
	
	function HoverEffect() {
		jQuery("a.portfolio-image-link").hover(
		function () {
			jQuery(this).find("span.column-portfolio-icon").stop().animate({"top": "20px", "opacity" : "1"}, 500);
		},
		function () {
			jQuery(this).find("span.column-portfolio-icon").stop().animate({"top": "-30px", "opacity" : "0"}, 300);
		});
	}
	
	AjaxPortfolio();
	AjaxNavigation();
	QuickSandInit();
	HoverEffect();
	PrettyPhotoLightbox();
	
});

jQuery(window).bind("load", function() {
	jQuery('.portfolio-ajax').eq(0).trigger('click');
});