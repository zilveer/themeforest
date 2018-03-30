(function($) {
	"use strict";

	var $header_height, scrollPosition;

	function update_headerHeight() {
		$header_height = $("header.site-header").outerHeight();
	}

	var $width 				= $(window).outerWidth();
	var $height 			= $(window).outerHeight();
	var $container_width 	= $(".container:first-child").width();

	$(window).on('resize scroll', function() {
		setTimeout(function() {
			$width 		= $(window).outerWidth();
			$height 	= $(window).outerHeight();
		}, 250);
	});

	$(window).on('load', function() {
		$(".preloader").fadeOut(500);

		// Header
			$header_height = $("header.site-header").outerHeight();

			setTimeout(function() {
				$header_height = $("header.site-header").outerHeight();
				$("#mobile-menu").css("top", $header_height);
			}, 300);

			$(window).on('resize scroll', function() {
				setTimeout(function() {
					$header_height = $("header.site-header").outerHeight();
					$("#mobile-menu").css("top", $header_height);
				}, 300);
			});

			$("#mobile-menu ul > li.menu-item-has-children > a").on('click', function() {
				var jthis = this;

				if ($(this).parent().hasClass("slideme")) {
					$(jthis).parent().removeClass("slideme");
					$(jthis).parent().find("ul").slideUp();
				} else {
					$("#mobile-menu ul li.slideme").removeClass("slideme");
					$(jthis).parent().addClass("slideme");
					$("#mobile-menu ul li ul").slideUp();
					$(jthis).parent().find("ul").slideDown();
				}
			});

			$(".open-mm").on('click', function() {
				$("body").toggleClass("mm-visible");
			});

			function SVGMenu( el, options ) {
				this.el = el;
				this.init();
			}

			SVGMenu.prototype.init = function() {
				if ($(".open-mm").length > 1) {
					if ($width > 767) {
						this.trigger = document.getElementById( 'open-mm-btn-2' );
					} else {
						this.trigger = document.getElementById( 'open-mm-btn' );
					}
				} else {
					this.trigger = document.getElementById( 'open-mm-btn' );
				}

				this.shapeEl = document.getElementById( 'morph-shape' );

				var s = Snap( this.shapeEl.querySelector( 'svg' ) );
				this.pathEl = s.select( 'path' );
				this.paths = {
					reset : this.pathEl.attr( 'd' ),
					open : this.shapeEl.getAttribute( 'data-morph-open' ),
					close : this.shapeEl.getAttribute( 'data-morph-close' )
				};

				this.isOpen = false;

				this.initEvents();

			};

			SVGMenu.prototype.initEvents = function() {
				this.trigger.addEventListener( 'click', this.toggle.bind(this) );
			};

			SVGMenu.prototype.toggle = function() {
				var self = this;

				if (this.isOpen==false) {
					setTimeout(function() {
						self.pathEl.stop().animate( { 'path' : self.paths.open }, 1000, mina.elastic );
					}, 50);
				} else {
					setTimeout(function() {
						self.pathEl.stop().animate( { 'path' : self.paths.close }, 1200, mina.elastic );
					}, 300);
				}

				this.isOpen = !this.isOpen;
			};

			new SVGMenu( document.getElementById( 'mobile-menu' ) );

			// Style 1
				if ($("header.site-header.style-1").length) {
					var $ul_site_height = $("nav.site-nav ul.site").outerHeight();
					var $ul_height = $("nav.site-nav .nav-wrapper").outerHeight();
					var $ul_wrapper_width = $("nav.site-nav .nav-wrapper").outerWidth();
					var $ul_nav_site_width = $("nav.site-nav ul.site").outerWidth();
					var $ul_nav_social_width = $("nav.site-nav ul.social").outerWidth();
					var $ul_allowed_width = $ul_wrapper_width - $ul_nav_social_width;

					if ($ul_site_height > $ul_height) {
						$("nav.site-nav ul.site").append("<li class='viewmore'><a href='javascript:void(null);'><span data-hover='More'>More</span></a><ul></ul></li>");

			    		var liCount=1;
			    		$("nav.site-nav ul.site li:not(.viewmore, .main-nav ul li ul li)").each(function() {
			    			$(this).attr("li-no", liCount);
			    			liCount++;
			    		});

			    		liCount += -1;

			    		for (var i = liCount; i >= 0; i--) {
			    			$ul_site_height = $("nav.site-nav ul.site").outerHeight();
			    			$ul_height = $("nav.site-nav .nav-wrapper").outerHeight();
			    			$ul_wrapper_width = $("nav.site-nav .nav-wrapper").outerWidth();
			    			$ul_nav_site_width = $("nav.site-nav ul.site").outerWidth();
			    			$ul_nav_social_width = $("nav.site-nav ul.social").outerWidth();
			    			$ul_allowed_width = $ul_wrapper_width - $ul_nav_social_width;

							if ($ul_site_height > $ul_height || $ul_nav_site_width > $ul_allowed_width) {

								if ($("li[li-no='"+i+"']").hasClass("hassubmenu")) {
								} else {
									$("*[li-no='"+i+"']").prependTo(".viewmore ul");
								}
							}
			    		};
					}

					if ($width < 767) {
						update_headerHeight();
						$("header.site-header").wrapAll('<div class="header-height-holder" style="height: '+$header_height+'px"></div>');
					}
				}

			// Style 2
				$(".show-search-overlay").on('click', function(e) {
					$("header.site-header .search-overlay").addClass("showme");
					$("header.site-header .search-overlay form input").focus();
				});

				$(".hide-search-overlay").on('click', function() {
					$("header.site-header .search-overlay").removeClass("showme");
				});

				if ($("header.site-header.style-2").length) {
					var $ul_site_height = $("header.site-header nav").outerHeight();
					var $ul_wrapper_width = $("header.site-header .actual-container").outerWidth();
					var $ul_nav_site_width = $("header.site-header nav").outerWidth();
					var $ul_nav_links_width = $("header.site-header .links-wrapper").outerWidth() + 100;
					var $ul_allowed_width = $ul_wrapper_width - $ul_nav_links_width;

					if ($ul_nav_site_width > $ul_allowed_width) {
						$("header.site-header nav > ul").append("<li class='viewmore'><a href='javascript:void(null);'><span data-hover='More'>More</span></a><ul></ul></li>");

			    		var liCount=1;
			    		$("header.site-header nav > ul > li:not(.viewmore)").each(function() {
			    			$(this).attr("li-no", liCount);
			    			liCount++;
			    		});

			    		liCount += -1;

			    		for (var i = liCount; i >= 0; i--) {
			    			$ul_site_height = $("header.site-header nav").outerHeight();
							$ul_wrapper_width = $("header.site-header .actual-container").outerWidth();
							$ul_nav_site_width = $("header.site-header nav").outerWidth();
							$ul_nav_links_width = $("header.site-header .links-wrapper").outerWidth() + 100;
							$ul_allowed_width = $ul_wrapper_width - $ul_nav_links_width;

							if ($ul_nav_site_width > $ul_allowed_width) {

								if ($("li[li-no='"+i+"']").hasClass("menu-item-has-children")) {
								} else {
									$("*[li-no='"+i+"']").prependTo(".viewmore ul");
								}
							}
			    		};
					}

					update_headerHeight();
					$("header.site-header.style-2").wrapAll('<div class="header-height-holder" style="height: '+$header_height+'px"></div>');
				}

			// Style 3
				if ($("header.site-header.style-3").length) {
					if ($width < 767) {
						update_headerHeight();
						$("header.site-header").wrapAll('<div class="header-height-holder" style="height: '+$header_height+'px"></div>');
					}
				}

			// Style 4
				if ($("header.site-header.style-4").length) {
					var $ul_site_height = $("header.site-header nav").outerHeight();
					var $ul_logo_width = $("header.site-header .logo-wrapper").outerWidth();
					var $ul_wrapper_width = $("header.site-header .container").outerWidth();
					var $ul_nav_site_width = $("header.site-header nav").outerWidth();
					var $ul_nav_links_width = $("header.site-header .links-wrapper").outerWidth() + 100;
					var $ul_allowed_width = $ul_wrapper_width - ($ul_nav_links_width + $ul_logo_width);

					if ($ul_nav_site_width > $ul_allowed_width) {
						$("header.site-header nav > ul").append("<li class='viewmore'><a href='javascript:void(null);'><span data-hover='More'>More</span></a><ul></ul></li>");

			    		var liCount=1;
			    		$("header.site-header nav > ul > li:not(.viewmore)").each(function() {
			    			$(this).attr("li-no", liCount);
			    			liCount++;
			    		});

			    		liCount += -1;

			    		for (var i = liCount; i >= 0; i--) {
			    			var $ul_site_height = $("header.site-header nav").outerHeight();
							var $ul_logo_width = $("header.site-header .logo-wrapper").outerWidth();
							var $ul_wrapper_width = $("header.site-header .container").outerWidth();
							var $ul_nav_site_width = $("header.site-header nav").outerWidth();
							var $ul_nav_links_width = $("header.site-header .links-wrapper").outerWidth() + 100;
							var $ul_allowed_width = $ul_wrapper_width - ($ul_nav_links_width + $ul_logo_width);

							if ($ul_nav_site_width > $ul_allowed_width) {

								if ($("li[li-no='"+i+"']").hasClass("menu-item-has-children")) {
								} else {
									$("*[li-no='"+i+"']").prependTo(".viewmore ul");
								}
							}
			    		};
					}

					setTimeout(function() {
						scrollPosition = $(this).scrollTop();
						if (scrollPosition >= $header_height) { $("header.site-header").addClass("scrolled"); } else { $("header.site-header").removeClass("scrolled"); }
					}, 50);

					$(window).on('scroll', function() {
					    scrollPosition = $(this).scrollTop();
					    if (scrollPosition >= $header_height) { $("header.site-header").addClass("scrolled"); } else { $("header.site-header").removeClass("scrolled"); }
					});

					update_headerHeight();
					$("header.site-header.style-4").wrapAll('<div class="header-height-holder" style="height: '+$header_height+'px"></div>');

					$("header.site-header.style-4 .bottom-cut").css("border-width", "70px "+$width+"px 0 0");
				}

			// Style 4
				if ($("header.site-header.style-6").length) {
					scrollPosition = $(this).scrollTop();
					if (scrollPosition >= $header_height) { $("header.site-header").addClass("scrolled"); } else { $("header.site-header").removeClass("scrolled"); }

					$(window).on('scroll', function() {
					    scrollPosition = $(this).scrollTop();
					    if (scrollPosition >= $header_height) { $("header.site-header").addClass("scrolled"); } else { $("header.site-header").removeClass("scrolled"); }
					});

					update_headerHeight();
					$("header.site-header.style-6").wrapAll('<div class="header-height-holder" style="height: '+$header_height+'px"></div>');
				}

			// SECTIONS

				// responsive iframes
					$(".post-single iframe:not(.twitter-tweet), .singlePost iframe").each(function() {
						$(this).wrapAll('<div class="embed-responsive embed-responsive-16by9"></div>')
					});

				// single gallery
					if ($(".post-image.gallery").length) {
						$(".post-image.gallery .pig-slider").slick({
							adaptiveHeight: true
						});
					}

					if ($(".singlePost .content-img.gallery").length) {
						$(".singlePost .content-img.gallery .pig-slider").slick({
							adaptiveHeight: true
						});
					}

				$(".sameHeight").each(function() {
					var height = $(this).outerWidth();

					$(this).css({
						'height': height,
						'min-height': height,
					});
				});

				if ($(".featured-posts").length) {
					$(".featured-posts .fp-slider").slick({
						slidesToShow: 2,
						slideToScroll: 2,
						draggable: false,
						responsive: [
						    {
						      breakpoint: 768,
						      settings: {
						        slidesToShow: 1,
						        slidesToScroll: 1,
						      }
						    }
						]
					});
				}

			// HOT NEWS TICKER
				if ($(".hot-ticker").length) {
					$('.hot-ticker .ht-container').marquee({
						pauseOnHover: true,
						duration: 10000,
					});
				}

			// BOXED CONTENT
				if ($width>992) {
					$(".boxed-content > .container > .row > div").matchHeight();

					setTimeout(function() {
						$(".boxed-content > .container > .row > div").matchHeight();
					}, 10);
				}

			// blogPosts
				$(".blogPosts > .row > div").matchHeight();

			// editorsChoice
				$(".editorsChoice .row > div").matchHeight();
				if ($width > 768) {
					$(".editorsChoice .row > div").each(function() {
						var height = $(this).outerHeight();
						$(this).addClass("YOYOYOY");
						$(this).children(".single-post").css("height", height);
					});
				}

			// events-list
				if ($(".events-list").length) {
					$(".events-list div.list").slick({
						slidesToShow: 4,
						draggable: false,
						infinite: false,
						adaptiveHeight: true,
						appendArrows: $(".events-list .section-title h3 .arrows"),
						responsive: [
						    {
						      breakpoint: 1200,
						      settings: {
						        slidesToShow: 3,
						      }
						    },
						    {
						      breakpoint: 768,
						      settings: {
						        slidesToShow: 2,
						      }
						    },
						    {
						      breakpoint: 640,
						      settings: {
						        slidesToShow: 1,
						      }
						    }
						]
					});

					var ini_index = $(".events-list").find(".single.current").data("slick-index");
					$(".events-list div.list").slick('slickGoTo', ini_index); // set to current day

					$(".events-list div.list .single").each(function() {
						var jthis = this;
						var count = $(this).find("li").length;

						if (count>1) {
							$(jthis).find(".emptyList").remove();
						}
					});

					if ($width > 640) {
						$(".events-list .container > div").matchHeight();
					}
				}

				// Events Archive
					$(".archive-events-holder .single").each(function() {
						var jthis = this;
						var count = $(this).find("li").length;

						if (count>1) {
							$(jthis).find(".emptyList").remove();
						}
					});

				// shopItems
					if ($(".shopItems").length) {
						$(".shopItems .shopitems-slider").slick({
							slidesToShow: 4,
							infinite: false,
							draggable: false,
							appendArrows: $(".shopItems .shopitems-slider-arrows"),
							responsive: [
							    {
							      breakpoint: 640,
							      settings: {
							        slidesToShow: 2,
							      }
							  }
							]
						});
					}

				// upcomingEvents
					if ($(".upcomingEvents").length) {
						$(".upcomingEvents .upcomingevents-slider").slick({
							slidesToShow: 3,
							infinite: false,
							draggable: false,
							appendArrows: $(".upcomingEvents .upcomingevents-slider-arrows"),
							responsive: [
								{
							      breakpoint: 768,
							      settings: {
							        slidesToShow: 2,
							      }
							  },
							    {
							      breakpoint: 640,
							      settings: {
							        slidesToShow: 1,
							      }
							  }
							]
						});
					}

				// popular-galleries
					if ($(".popular-galleries").length) {
						$(".popular-galleries .popular-galleries-slider").slick({
							slidesToShow: 1,
							infinite: false,
							draggable: false,
							appendArrows: $(".popular-galleries .slider-arrows"),
						});
					}

				// most-popular
					if ($(".most-popular").length) {
						if ($(".most-popular.full-width").length) {
							$(".most-popular.full-width .popular-slider").slick({
								slidesToShow: 4,
								infinite: false,
								draggable: false,
								responsive: [
								    {
								      breakpoint: 1200,
								      settings: {
								        slidesToShow: 2,
								      }
								  	},
								  	{
								  	    breakpoint: 768,
								  	    settings: {
								  	      slidesToShow: 1,
								  	    }
								  	},

								]
							});
						} else {
							$(".most-popular .container > div").matchHeight();
							$(".most-popular .popular-slider").slick({
								slidesToShow: 3,
								infinite: false,
								draggable: false,
								responsive: [
								    {
								      breakpoint: 1200,
								      settings: {
								        slidesToShow: 2,
								      }
								  	},
								  	{
								  	    breakpoint: 768,
								  	    settings: {
								  	      slidesToShow: 1,
								  	    }
								  	},

								]
							});
						}
					}

				// sticky-slider-holder
					if ($(".sticky-slider-holder").length) {
						$(".sticky-slider-holder .sticky-slider").slick({
							slidesToShow: 1,
							infinite: false,
							draggable: false,
						});
					}

				// latest-news
					if ($width > 1200) {
						$(".latest-news .single > div").matchHeight();
					}

				// white-content
					$(".white-content .matchMe > div").matchHeight();

				// popular-news
					if ($width > 992) {
						$(".white-content .popular-news .single > div").matchHeight();
					}

				// latest-news
					if ($(".latest-videos").length) {
						$(".latest-videos .latest-videos-slider-actual").slick({
							slidesToShow: 4,
							infinite: false,
							draggable: false,
							appendArrows: $(".latest-videos .section-title"),
							responsive: [
							    {
							      breakpoint: 992,
							      settings: {
							        slidesToShow: 3,
							      }
							 	},
						 	   {
						 	     breakpoint: 768,
						 	     settings: {
						 	       slidesToShow: 2,
						 	     }
						 		},
						 		{
						 	     breakpoint: 640,
						 	     settings: {
						 	       slidesToShow: 1,
						 	     }
						 		}
							]
						});
					}

				// great-news-slider
					if ($(".great-news-slider").length) {
						$(".great-news-slider-container .gns-choose-slider").slick({
							slidesToShow: 1,
							infinite: false,
							appendArrows: $(".great-news-slider-container .gns-choose .arrows"),
						});

						var gns_padding = ($width - $container_width) / 2;
						$(".great-news-slider").css("padding-right", gns_padding);

						$(".great-news-slider-container > div").matchHeight();

						$(".great-news-slider-container .gns-slider-actual").slick({
							slidesToShow: 2,
							infinite: true,
							responsive: [
							    {
							      breakpoint: 992,
							      settings: {
							        slidesToShow: 1,
							      }
							 	},
							]
						});

						var gns_index = 0;
						$(".great-news-slider-container .gns-choose a").each(function() {
							$(this).attr("data-index", gns_index);
							gns_index++;
						});

						$(".great-news-slider-container .gns-choose a[data-index="+0+"]").addClass("active");

						$(".great-news-slider-container .gns-choose a").on('click', function() {
							var index = $(this).data("index");
							$('.great-news-slider-container .gns-slider-actual').slick('slickGoTo',index);

							var current_index = [];
							$(".great-news-slider-container .gns-slider-actual .slick-active").each(function() {
								current_index.push($(this).data("slick-index"));
							});

							// remove and add new active class to gns-choose
							$(".great-news-slider-container .gns-choose a").removeClass("active");
							$(".great-news-slider-container .gns-choose a[data-index="+current_index[0]+"]").addClass("active");
						});

						$(".great-news-slider-container .gns-slider-actual").on('beforeChange', function(event, slick, currentSlide, nextSlide){

							// remove and add new active class to gns-choose
							$(".great-news-slider-container .gns-choose a").removeClass("active");
						  	$(".great-news-slider-container .gns-choose a[data-index="+nextSlide+"]").addClass("active");

						  	var go_index = $(".great-news-slider-container .gns-choose a[data-index="+nextSlide+"]").parents(".single").data("slick-index");
						  	$('.great-news-slider-container .gns-choose-slider').slick('slickGoTo',go_index);

						});
					}

				// latest-videos-slider
					if ($width > 992) {
						$(".latest-videos-slider .actual-container > div").matchHeight();
					}

					if ($(".latest-videos-slider").length) {
						$(".latest-videos-slider .lvs-slider").slick({
							fade: true,
							autoplay: true,
							autoplaySpeed: 3500,
							draggable: false,
							arrows: false
						});
					}

				// whatspopular
					if ($width > 640) {
						$(".whatspopular .wp-blocks .single > div").matchHeight();
					}

				// big-latest
					if ($(".big-latest").length) {
						$(".big-latest .boxed-news .row > div").matchHeight();

						if ($width > 992) {
							var mc_height = $(".big-latest .middle-content").outerHeight();
							$(".big-latest .white-sidebar, .big-latest .black-sidebar").css("height", mc_height);

							$(".big-latest .black-sidebar .box .scrollable, .big-latest .white-sidebar .box .scrollable").css("max-height", (mc_height/2)-15);
						}

						$(".big-latest .scrollable").mCustomScrollbar();
					}

				// video-posts-holder
					if ($(".video-posts-holder").length) {
						$(".video-posts-holder .vph-slider").slick({
							slidesToShow: 4,
							infinite: false,
							draggable: false,
							responsive: [
							    {
							      breakpoint: 992,
							      settings: {
							        slidesToShow: 3,
							      }
							 	},
							 	{
							      breakpoint: 768,
							      settings: {
							        slidesToShow: 2,
							      }
							 	},
						 		{
						 	     breakpoint: 640,
						 	     settings: {
						 	       slidesToShow: 1,
						 	     }
						 		},
							]
						});
					}

					$(".lightGallery-videos-1").lightGallery({
						selector: ".lightGallery-videos-1 .single .play-video",
						exThumbImage: "data-thumb-src",
						lang: { allPhotos: 'All Videos' }
					});

					$(".lightGallery-videos-2").lightGallery({
						selector: ".lightGallery-videos-2 .single .play-video",
						exThumbImage: "data-thumb-src",
						lang: { allPhotos: 'All Videos' }
					});

					$(".lightGallery-videos-3").lightGallery({
						selector: ".lightGallery-videos-3 .single-gallery a",
						exThumbImage: "data-thumb-src",
						lang: { allPhotos: 'All Videos' }
					});

					$(".lightGallery-videos-4").lightGallery({
						selector: ".lightGallery-videos-4 .single a.plus-hover",
						exThumbImage: "data-thumb-src",
						lang: { allPhotos: 'All Videos' }
					});

					$(".lightGallery-videos-4 .single a.post-title").on('click', function() {
						$(this).parent().parent().find(".plus-hover").trigger("click");
					});

				// news-splitted
					$(".news-splitted > .container > .actual-container > .row > div").matchHeight();
					$(".news-splitted .posts-holder.bunch > div").matchHeight();
					$(".news-splitted .posts-holder.bunch.blogpg .row > div").matchHeight();

					setTimeout(function() {
						$(window).trigger('resize');
					}, 100);

					$(".post-image.gallery .pig-slider").on('afterChange', function() {
						$(".news-splitted > .container > .actual-container > .row > div").matchHeight();
					});

				// big-gallery-slider
					if ($(".big-gallery-slider").length) {
						$(".big-gallery-slider .bgs-slider").slick();
					}

				// boxeditems
					$(".boxeditems > div").matchHeight();

				// news-stylish-block
					$(".news-stylish-block .box-wrapper .fouritems > div").matchHeight();

				// latest-galleries-slider
					if ($(".latest-galleries-slider").length) {
						$(".latest-galleries-slider").slick({
							slidesToShow: 5,
							draggable: false,
							infinite: false,
							responsive: [
							    {
							      breakpoint: 1200,
							      settings: {
							        slidesToShow: 4,
							      }
							 	},
							 	{
							      breakpoint: 992,
							      settings: {
							        slidesToShow: 3,
							      }
							 	},
						 		{
						 	     breakpoint: 640,
						 	     settings: {
						 	       slidesToShow: 2,
						 	     }
						 		},
						 		{
						 	     breakpoint: 480,
						 	     settings: {
						 	       slidesToShow: 1,
						 	     }
						 		},
							]
						});
					}

				// big-cat-latest-post
					if ($(".big-cat-latest-post").length) {
						$(".big-cat-latest-post .bclp-slider").slick({
							slidesToShow: 1,
							infinite: false,
							draggable: false,
							appendArrows: ".big-cat-latest-post .arrows-holder",
						});
					}

				// category-chooser show-more
					$(".category-chooser .show-more").on('click', function() {
						$(this).toggleClass("clicked");
						$(".category-chooser .more-links").toggleClass("showme");
					});

					$('.cat-choose').bind('change', function () {
				        var url = $(this).val(); // get selected value
				        if (url) { // require a URL
				            window.location = url; // redirect
				        }
				        return false;
				    });

				// maineditor-list
					if ($width>767) {
						$(".maineditor-list .single > div").matchHeight();
					}

				// instagram_feed
					$(".instagram_feed > a").matchHeight();

				// catPosts
					$(".catPosts .margin-top-992 .row > div").matchHeight();

				// shop-page
					if ($(".shop-page").length) {
						$(".shop-page > .row > div").matchHeight();

						$(".woocommerce-tabs li a").on('click', function() {
							$(".shop-page > .row > div").matchHeight();
						});
					}

				// authorsList
					$(".authorsList .single > div").matchHeight();

				// tpl
					$(".news-stylish-block .tpl > div").matchHeight();

			// END OF SECTIONS


		$(".back-to-top").on('click', function() {
			var target = $("body");

			$("html, body").animate({
				scrollTop: target.offset().top
			}, 500);
		});

		scrollPosition = $(this).scrollTop();
		if (scrollPosition >= $height) { $(".back-to-top").removeClass("hideme").addClass("showme"); } else { $(".back-to-top").removeClass("showme").addClass("hideme"); }

		$(window).on('scroll', function() {
		    scrollPosition = $(this).scrollTop();
		    if (scrollPosition >= $height) { $(".back-to-top").removeClass("hideme").addClass("showme"); } else { $(".back-to-top").removeClass("showme").addClass("hideme"); }
		});

		$(".wpcf7-form").find("br").remove();

	});

})(jQuery);