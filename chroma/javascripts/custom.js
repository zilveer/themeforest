// Utilities
;(function($) {
  $.fn.removeWhitespace = function()  {
    this.contents().filter(
      function() {
        return (this.nodeType == 3 && !/\S/.test(this.nodeValue));
      }
    ).remove();
    return this;
  }
	// modified Isotope methods for gutters in masonry
	$.Isotope.prototype._getMasonryGutterColumns = function() {
	  var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
	      containerWidth = this.element.width();

	  this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth ||
	                // or use the size of the first item
	                this.$filteredAtoms.outerWidth(true) ||
	                // if there's no items, use size of container
	                containerWidth;

	  this.masonry.columnWidth += gutter;

	  this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
	  this.masonry.cols = Math.max( this.masonry.cols, 1 );
	};

	$.Isotope.prototype._masonryReset = function() {
	  // layout-specific props
	  this.masonry = {};
	  // FIXME shouldn't have to call this again
	  this._getMasonryGutterColumns();
	  var i = this.masonry.cols;
	  this.masonry.colYs = [];
	  while (i--) {
	    this.masonry.colYs.push( 0 );
	  }
	};

	$.Isotope.prototype._masonryResizeChanged = function() {
	  var prevSegments = this.masonry.cols;
	  // update cols/rows
	  this._getMasonryGutterColumns();
	  // return if updated cols/rows is not equal to previous
	  return ( this.masonry.cols !== prevSegments );
	};

	$(window).load(function() {
		// $("#loader").fadeOut("fast");

		// Main masonry function
		function initializeMasonry(this_elem, options) {
		  var $masonry_container = $(this_elem);     

		  var items = $masonry_container.children();
		  
		  $masonry_container.imagesLoaded( function(){

		    $masonry_container.isotope(options).isotope( 'insert', items);

		    $masonry_container.css("visibility", "visible");
		    $(".imgLiquidFill").imgLiquid();
		  });
		}

		// Column heights
		var services = $(".services").find(".article");
		var maxHeight = -1;

		services.each(function() {
			maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height() + 20;
		});

		services.each(function() {
			var new_height = maxHeight - $(this).height();
		 	$(this).find(".service_content").css("margin-bottom", new_height+"px");
		});

		// Portfolio heights
		$(window).resize(function(){
			var items = $(".portfolio").find(".element");
			var maxHeight = -1;

			items.each(function() {
				$(this).height("");
				maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height() + 20;
			});

			items.each(function() {
			 	$(this).css("height", maxHeight+"px");
			});
		}).trigger("resize");

		// Album filtering
		$(".albums, .portfolio").each(function() {
			if($(this).find(".filter_list").length > 0) {

				var this_album = $(this);

				var $container = this_album.find(".filter_content");

				initializeMasonry($container, {
					itemSelector : '.filter_content .element',
				  resizable: true,
				  masonry : {	
				  	gutterWidth : 35
				  },
				});

				// filter items when filter link is clicked
				this_album.find('.filter_list a').click(function(){
				  var selector = $(this).attr('data-filter');
				  $container.isotope({ filter: selector });
					this_album.find('.filter_list li a').removeClass('active');
			  	$(this).addClass('active');
				  return false;
				});

			}
		});

	  // Masonry
	  $(".masonry").each(function() {
			initializeMasonry($(this), {
	      itemSelector : $("> div", this),
	      resizable: true,
			  masonry : {	
			  	gutterWidth : 15
			  }
	    });
	  });

	  // Grid - full width
	  $(".grid_full").each(function() {
	  	initializeMasonry($(this), {
	      itemSelector : $(".wall_entry", this),
	      layoutMode: "perfectMasonry",
	      perfectMasonry: {
	        liquid: true
	      }
	    });
		});

		// Masonry - full width
	  $(".masonry_full").each(function() {
			initializeMasonry($(this), {
	      itemSelector : $(".wall_entry", this),
	      layoutMode: "perfectMasonry",
				perfectMasonry: {
				   liquid: true
				}
	    });
		});

		// $("body").addClass("run_animations");
	});
})(jQuery);
						
jQuery(document).ready(function($) {

	$("nav ul li:has(ul)").addClass("with_dropdown");

	$(".menu .with_dropdown").stop(true,true).hoverIntent(function() {
		var this_sub_menu = $(this).find(".sub-menu").first();
		if(this_sub_menu.is(":visible")) {
			this_sub_menu.slideUp("normal");	
		} else {
			this_sub_menu.slideDown("normal");	
		}
	});

	// Menu settings default
	$('body').on('click', "#menuToggle, .menu-close", function(){
		$('#menuToggle').toggleClass('active');
		$('body').toggleClass('body-push-toleft');
		$('#theMenu').toggleClass('menu-open');
	});
	
	// Menu settings for displaying the menu on the left
	$('#menuToggleLeft, .menu-close-left').on('click', function(){
		$('#menuToggle').toggleClass('active');
		$('body').toggleClass('body-push-toleft');
		$('#theMenu').toggleClass('menu-open');
	});

	$(".backstretch").each(function() {
		var bg = $(this).attr("data-background-image");
		if(bg) {
			$(this).backstretch(bg, {fade: 750});
		}
	});

  // Page content
  if($("header#horizontal").length > 0) {

  	$("header#horizontal").clone().addClass("stuck").insertAfter("header#horizontal");

		function mainmenu(){
		  $("header#horizontal nav ul li ul li:has(ul)").addClass("with_dropdown");
		  
		  $("header#horizontal nav ul li").hover(function(){
		  	$(this).find('ul:first').stop(true,true).fadeIn();
		  },function(){
		  	$(this).find('ul:first').stop(true,true).fadeOut();
		  });
	  }
	  mainmenu();

  	$("header#horizontal").waypoint(function(direction) {
  		if(direction == "down" && $("header#horizontal.stuck").not(":visible")) {
  	    $("header#horizontal.stuck").removeClass("slideUp").addClass("slideDown");
  		} else {
  			$("header#horizontal.stuck").removeClass("slideDown").addClass("slideUp");
  		}
  	}, {
  	    offset: -120
  	})
  }

	// Retina logo
	$('.logo-retina').retinise();
	
	// Tipsy
	$('a[rel=tipsy]').tipsy({fade: true, gravity: 's', offset: 0});

	$("footer .toggle a").click(function() {
		$(this).fadeOut();
		var sidebar_container = $("#footer-sidebar");
		if(sidebar_container.is(":visible")) {
		} else {
			sidebar_container.fadeIn(2000);
			$("html, body").animate({ scrollTop: $(document).height() }, 2000, 'jswing');
		}
	});
	
	// Fancyboxes
	if($.isFunction($.fancybox)) {
		$(".fancybox").fancybox({
			padding     : 0,
			openEffect  : 'fade',
			closeEffect : 'fade',
			prevEffect	: 'fade',
			nextEffect	: 'fade',
			helpers	: {
				title	: {
					type: 'inside'
				},
				thumbs	: {
					width	 : 50,
					height : 50
				},
				buttons	: {}
			}
		});
	}

	$("#photo .info a").click(function() {

		var photo_container = $("#photo");
		var this_a = $(this);

		if(photo_container.find(".sidebar").is(":visible")) {
			$("#photo .sidebar").hide("slide", { direction : "right" }, 600);
			photo_container.find(".page_content").animate({
				"width" : "100%"
			}, 600);
			this_a.removeClass().addClass("icon ionicon-arrow-shrink");
		} else {
			$("#photo .sidebar").show("slide", { direction : "right" }, 600);
			photo_container.find(".page_content").animate({
				"width" : "70%"
			}, 600);
			this_a.removeClass().addClass("icon ionicon-arrow-expand");
		}
	});

	if($(".attachment_nav .prev a").length == 0) {
		$(".attachment_nav .prev .placeholder").show();
	}

	if($(".attachment_nav .next a").length == 0) {
		$(".attachment_nav .next .placeholder").show();
	}

	if($("#photo").length > 0) {
		if($("#photo").attr("data-hide-sidebar") == "true") {
			$("#photo .info a").trigger("click");
		}
		$(document).keydown(function(e){
	    if (e.keyCode == 37) { 
	    	window.location = $(".attachment_nav .prev a").attr("href");
	    }
	    if (e.keyCode == 39) { 
	    	window.location = $(".attachment_nav .next a").attr("href");
	    }
		});
	}

	// Album hovers
	function albumHovers() {
		$(".wall_entry, .element").each(function() {

			var icon = $(this).find(".hover .icons");

			if(icon.length > 0) {
				var image_height = $(this).height();
				var image_width = $(this).width();

				var hover_css = "display: inline-block !important; height: "+(image_width/9)+"px !important; width: "+(image_width/9)+"px !important;";
				var hover_a_css = hover_css+" font-size: "+(image_width/13)+"px !important; line-height: "+(image_width/9)+"px !important;";
				var hover_span_css = hover_css+" font-size: "+(image_width/15)+"px !important; line-height: "+(image_width/10)+"px !important;";

				icon.find("a").css('cssText', hover_a_css);
				icon.find("span").css('cssText', hover_span_css);

				var icon_height = icon.height();
				var icon_width = icon.width();
				
				icon.css({
					"margin-top"  : "-"+(icon_height/2)+"px",
					"margin-left" : "-"+(icon_width/2)+"px"
				});
			}

		});

		$(".album .wall_entry, .albums.thumbnail_default .element").on({
			mouseenter: function() {
				$(this).find(".hover").stop(true, true).animate({ "opacity" : 1 }, 400);
				$(this).find(".hover .icons").stop(true, true).animate({
					"top" : "50%"
				}, 400);
			},
			mouseleave: function() {
				$(this).find(".hover").stop(true, true).animate({ "opacity" : 0 }, 400);
				$(this).find(".hover .icons").stop(true, true).animate({
					"top" : "0%"
				}, 400);
			}
		});

		$(".albums.thumbnail_caption_overlay .element").on({
			mouseenter: function() {
				$(".caption", this).stop(true, true).fadeIn(500);
			},
			mouseleave: function() {
				$(".caption", this).stop(true, true).fadeOut(500);
			}
		});
	}
	albumHovers();

	// Hide the sectin tag if it has no content
	function fixSections() {
		$("section.container .page_content").each(function() {
			if($.trim($(this).html()) == "" || $.trim($(this).html()) == '<div class="clear"></div>') {
				$(this).parent().hide();
			}

			if($("body").hasClass("fullscreen")) {
				$("section:visible").eq(0).css({
					"margin-top" : ($(".sl-slider-wrapper, .ei-slider, .flexslider").height() - 30)
				});
			}
		});

		if($("section:visible").length == 0) {
			$("footer").css({
				"margin-top" : ($(".sl-slider-wrapper, .ei-slider, .flexslider").height() - 70)
			});
		}
	}
	fixSections();

	$(window).resize(function() {
		fixSections();
	});

	$(".widget ul.menu").removeClass("menu").addClass("widget_menu");
	
	$().UItoTop({ 
		text: '<span class="entypo-up-open"></span>',
		easingType: 'easeOutQuart' 
	});

});			