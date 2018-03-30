/**
 * Boot 
 * -----------------------------------------------------------------------------
 */
var thb_page_loaded = false;

jQuery.thb.config.set('thb_lightbox', 'prettyPhoto', {
	theme: 'pp_thb'
});

(function($) {
	$(document).ready(function() {
		// Layout
		$.thb.exposure_layout('init');

		// Menu
		$("#main-nav > div").menu({
			speed: 150
		});
	});

	$(window).load(function() {
		if( $("body").hasClass("thb-expand-info-box") ) {
			$(".thb-control-info a").trigger("click");
		}
	});
})(jQuery);

/**
 * Layout
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.exposure_layout = function(mode) {
		this.header = $("#header");
		this.footer = $("#footer");
		this.fullbg = $("#thb-full-background");
		this.fullbgWrapper = $(".thb-full-background-wrapper");
		this.thbControls = $("#thb-controls");
		this.mainSidebar = $(".thb-main-sidebar");
		this.content = $("#content");
		this.mobileNav = $("#mobile-nav");

		this.isMobile = $("body").hasClass("thb-mobile");

		/**
		 * Responsive
		 * ---------------------------------------------------------------------
		 */
		var mobile_step = 480,
			tablet_step = 768,
			self = this;

		this.adjustCarousel = function( resize ) {
			var window_width = $(window).width();
			this.displayed_items = 3;

			if( window_width < mobile_step ) {
				this.pace = window_width;
			}
			else if( window_width < tablet_step ) {
				this.pace = window_width / 2;
			}
			else {
				this.pace = 560;
			}

			$(".hentry").css('width', this.pace );

			var container_width = this.pace * this.displayed_items,
				current_index = $(".hentry.current").index(),
				hentry_height = $(window).height() - this.headerHeight() - this.footerHeight(),
				container_css = {};

			if( resize ) {
				container_width = this.pace * $(".hentry").length;
				container_css['margin-left'] = this.pace * current_index * -1;
			}

			container_css['width'] = container_width;

			$('.thb-content-wrapper').css(container_css);

			$(".page-template-template-portfolio-carousel-php .hentry").css('height', hentry_height);

			if( !resize ) {
				setTimeout(function() {
					$("#content").addClass("thb-content-loaded");
				}, 10);
			}
		};

		this.headerHeight = function() {
			var h = this.header.outerHeight();
			if( $("#wpadminbar").length > 0 ) {
				this.header.css('top', 28);
				if(this.content.css('position') === "fixed" ) {
					h = this.header.outerHeight() + 28;
				}
			}

			return h;
		};

		this.footerHeight = function() {
			return this.footer.outerHeight();
		};

		this.adjustNav = function() {
			$("#mobile-nav-trigger").on("click", function() {
				if( !$('body').hasClass("mobile-nav-active") ) {
					$('body').scrollTo(0);
				}

				$('body').toggleClass("mobile-nav-active");

				return false;
			});
		};

		this.adjustHeights = function() {
			var header_height = this.headerHeight(),
				footer_height = this.footerHeight(),
				content_height = $(window).height() - header_height - footer_height,
				content_style = {},
				mobile_nav_style = {},
				main_sidebar_style = {};

			// Content
			// -----------------------------------------------------------------

			if(this.content.css('position') === "fixed" ) {
				content_style = {
					'top': header_height,
					'bottom': footer_height
				};

				mobile_nav_style = {
					'top': header_height - ($("#wpadminbar").length ? 28 : 0),
					'padding-bottom': footer_height
				};

				main_sidebar_style = {
					'top': header_height + 20,
					'bottom': footer_height + 20
				};
			}
			else {
				content_style = {
					'margin-top': header_height,
					'margin-bottom': footer_height
				};

				mobile_nav_style = {
					'top': 0,
					'padding-bottom': footer_height
				};

				main_sidebar_style = {
					'top': header_height + 20 + ($("#wpadminbar").length ? 28 : 0),
					'bottom': footer_height + 20
				};
			}

			// Main sidebar
			// -----------------------------------------------------------------

			this.content.css(content_style);
			this.mobileNav.css(mobile_nav_style);
			this.mainSidebar.css(main_sidebar_style);

			// Full BG wrapper
			// -----------------------------------------------------------------

			var fullbgWrapperCss = {
				bottom: footer_height,
				top: header_height
			};

			if( $('body').hasClass('page-template-template-showcase-php') || $('body').hasClass('single-works') ) {
				fullbgWrapperCss.top += ($("#wpadminbar").length ? 28 : 0);
			}

			this.fullbgWrapper.css(fullbgWrapperCss);

			// Controls
			// -----------------------------------------------------------------

			var controls_bottom = $(window).width() < 768 ? footer_height : footer_height + 20;

			this.thbControls.css({
				bottom: controls_bottom
			});

			// Single work details wrapper
			// -----------------------------------------------------------------

			var details_position = {
				'top': header_height + 20 + ($("#wpadminbar").length ? 28 : 0),
				'bottom': footer_height + 20
			};

			if( !$("body").hasClass("thb-responsive-mobile-off") && $(window).width() < 768 ) {
				details_position.bottom = 56 + footer_height;
			}

			$(".single-work-details-wrapper").css(details_position);
		};


		this.init = function() {
			var self = this;

			var overlay_off = $("body").hasClass("thb-overlay-off");

			var templates = {
				"blog-a": $('body').hasClass('page-template-template-blog-timeline-php'),
				"blog-b": $('body').hasClass('page-template-template-blog-classic-php'),
				"blog-d": $('body').hasClass('page-template-template-blog-carousel-php'),
				"default": $('body').hasClass('page-template-default'),
				"archives": $('body').hasClass('page-template-template-archives-php'),
				"wp-search": $('body').hasClass('search-results'),
				"wp-archives": $('body').hasClass('archive'),
				"contact": $('body').hasClass('page-template-template-contact-php'),
				"full": $('body').hasClass('page-template-template-page-full-php'),
				"portfolio-masonry": $('body').hasClass('page-template-template-portfolio-masonry-php'),
				"portfolio-b": $('body').hasClass('page-template-template-portfolio-carousel-php'),
				"showcase": $('body').hasClass('page-template-template-showcase-php'),
				"photogallery": $('body').hasClass('page-template-template-photogallery-php'),
				"single-post": $('body').hasClass('single-post'),
				"single-work": $('body').hasClass('single-works')
			};

			this.adjustHeights();
			this.adjustNav();

			if( templates['portfolio-b'] || templates['blog-d'] ) {
				this.adjustCarousel();
			}

			$(window).bind("resize orientationchange", function() {
				self.adjustHeights();

				if( templates['portfolio-b'] || templates['blog-d'] ) {
					self.adjustCarousel(true);
				}

				if( !thb_page_loaded ) {
					return;
				}

				thb_page_loaded = true;
			});

			$("#thb-controls .thb-control-toggle a").on("click", function() {
				$(this).parent().toggleClass("active");
			});

			$(".thb-control-info a").on("click", function() {
				if( !$("body").hasClass("thb-info") ) {
					$(".single-work-details-wrapper").css('display', 'block');
					setTimeout(function() {
						if( !self.isMobile ) {
							self.jScrollPane = $(".single-work-details-wrapper").jScrollPane( self.jScrollPaneOptions ).data().jsp;
						}
						$("body").addClass("thb-info");
					}, 1);
				}
				else {
					$("body").removeClass("thb-info");

					$.thb.transition(".single-work-details-wrapper", function( el ) {
						// if( !$("body").hasClass("thb-info") ) {
							// if( !self.isMobile ) {
								// self.jScrollPane.destroy();
							// }
							$(el).css('display', 'none');
						// }
					});
				}

				return false;
			});

			$.thb.transition("#thb-full-background-captions", function( el ) {
				if( $("body").hasClass("thb-overlay-off") ) {
					$('#thb-full-background-captions').css('display', 'none');
				}
			}, true);

			$(".thb-control-fit a").on("click", function() {
				if( !$("body").hasClass("thb-full-background-fit") ) {
					$(this).attr('data-icon', 2);
					$.thb.fullbackground("fit", $.thb.config.get('fullbackground'));
					setTimeout(function() {
						$(window).trigger("resize");
					}, 1);

					if( !overlay_off ) {
						$("body").addClass("thb-overlay-off");
					}
				}
				else {
					if( !overlay_off ) {
						$("body").removeClass("thb-overlay-off");
					}

					$(this).attr('data-icon', 3);
					$.thb.fullbackground("unfit", $.thb.config.get('fullbackground'));
				}

				return false;
			});

			$(".thb-control-drawer a").on("click", function() {
				$.thb.transition("#thb-full-background-carousel");

				return false;
			});

			// Page templates --------------------------------------------------

			this.debounceTime = 200;

			this.jScrollPaneOptions = {
				autoReinitialise: true
			};

			this.jScrollPane = null;
			this.sidebarjScrollPane = null;


			// Main sidebar 

			$("a.thb-main-sidebar-toggle").on("click", function() {
				if( !$("body").hasClass("thb-main-sidebar-active") ) {
					self.mainSidebar.css('display', 'block');
					setTimeout(function() {
						if( !self.isMobile ) {
							self.sidebarjScrollPane = self.mainSidebar.jScrollPane( self.jScrollPaneOptions ).data().jsp;
						}
						$("body").addClass("thb-main-sidebar-active");
					}, 1);
				}
				else {
					$("body").removeClass("thb-main-sidebar-active");

					$.thb.transition(self.mainSidebar, function( el ) {
						// if( !$("body").hasClass("thb-main-sidebar-active") ) {
							// if( !self.isMobile ) {
							// 	self.sidebarjScrollPane.destroy();
							// }
							self.mainSidebar.css('display', 'none');
						// }
					});
				}


				return false;
			});

			if( templates['blog-a'] || templates['blog-b'] || templates['blog-d'] || templates['default'] || templates['single-post'] || templates['contact'] || templates['archives'] || templates['full'] || templates['photogallery'] || templates['portfolio-masonry'] ) {
				$("#thb-full-background").thb_stretcher({
					adapt: false,
					slides: '.slide',
					onSlidesLoaded: function() {
						setTimeout(function() {
							$("#thb-full-background").addClass("thb-loaded");
						}, 50);
					}
				});
			}

			if( templates['blog-a'] ) {
				var featured_image = $("#content .hentry").data('fullbackground'),
					slide_img = this.fullbg.find("> .slide img");

				slide_img.addClass("thb-img-hidden");

				setTimeout(function() {
					self.changeBackground(featured_image, function() {
						thb_page_loaded = true;
					});
					self.pageBlogA();
				}, 10);
			}

			if( templates['blog-b'] ) {
				this.pageBlogB();
			}
			else if( templates['blog-d'] ) {
				this.pageBlogD();
			}
			else if( templates['portfolio-masonry'] ) {
			}
			else if( templates['portfolio-b'] ) {
				this.pagePortfolioB();
			}
			else if( templates['showcase'] ) {
				this.pageShowcase();
			}
			else if( templates['photogallery'] ) {
				this.pagePhotogallery();
			}
			else if( templates['default'] || templates['full'] || templates['archives'] || templates['wp-archives'] || templates['wp-search'] || templates['contact'] ) {
			}
			else if( templates['single-post'] ) {
			}
			else if( templates['single-work'] ) {
				this.pageSingleWork();
				if( !self.isMobile ) {
					this.jScrollPane = $(".single-work-details-wrapper").jScrollPane( this.jScrollPaneOptions ).data().jsp;
				}
				$(window).resize(function() {
					if( !$("body").hasClass("thb-responsive-mobile-off") && $(window).width() < 768 ) {
						$(".single-work-details-wrapper").width( $(window).width() - 40);
					} else {
						$(".single-work-details-wrapper").width( ($(window).width() - 80) / 2 );
					}
				});
			}
		};

		this.changeBackground = function( new_src, callback ) {
			var slide_img = this.fullbg.find("> .slide img");

			if( new_src !== '' ) {
				$("body").addClass("thb-image-loading");
				var temp_img = $("<img src='" + new_src + "' />");

				$.thb.loadImage(temp_img, {
					allLoaded: function() {
						slide_img.replaceWith(temp_img);

						self.fullbg.thb_stretcher({
							adapt: false
						});

						$.thb.transition(temp_img, function() {
							if( callback ) {
								callback();
							}
						});

						setTimeout(function() {
							$("body").removeClass("thb-image-loading");
							temp_img.removeClass('thb-img-hidden');
						}, 0);
					}
				});
			}
			else {
				// $.thb.transition(slide_img, function() {
					// slide_img.attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
				// });

				slide_img.addClass('thb-img-hidden');

				if( callback ) {
					callback();
				}
			}
		};

		/**
		 * Showcase
		 * ---------------------------------------------------------------------
		 */
		this.pageShowcase = function() {
			$("body").css("height", $(window).height() - this.headerHeight() - this.footerHeight);

			$(window).load(function() {
				if( self.isMobile ) {
					$.scrollTo(1, 1);
				}
			});
		};

		/**
		 * Single work
		 * ---------------------------------------------------------------------
		 */
		this.pageSingleWork = function() {
			$("body").css("height", $(window).height() - this.headerHeight() - this.footerHeight);

			$(window).load(function() {
				if( self.isMobile ) {
					$.scrollTo(1, 1);
				}
			});
		};

		/**
		 * Photogallery
		 * ---------------------------------------------------------------------
		 */
		this.pagePhotogallery = function() {
			var container = $('.thb-photogallery-container'),
				load_more = $('#thb-infinite-scroll-button');

			if( container.prettyPhoto ) {
				$(".thb-photogallery-container li a")
					.attr('rel', '')
					.each(function() {
						$(this).attr('rel', 'prettyPhoto[gal]');
					});

				var objects = $("a[rel^='prettyPhoto']");
				objects.prettyPhoto( $.thb.config.get('thb_lightbox', 'prettyPhoto') );
			}

			$.thb.isotope({
				filter: '',
				itemsContainer: '.thb-photogallery-container',
				itemsClass: 'li',
				pagContainer: ''
			});

			load_more.on("click dblclick", function() {
				var url = container.attr('data-url');

				$.thb.loadUrl(url, {
					filter: '.thb-content-wrapper',
					after: function(data) {
						var html = $( $(data).outerHTML() ),
							ctn = html.find('.thb-photogallery-container');

						if( ctn.length ) {
							container.attr('data-url', ctn.data('url'));
							container.isotope('insert', $( ctn.html() ), function() {
								if( container.prettyPhoto ) {
									$(".thb-photogallery-container li a")
										.attr('rel', '')
										.each(function() {
											$(this).attr('rel', 'prettyPhoto[gal]');
										});

									var objects = $("a[rel^='prettyPhoto']");
									if( objects.prettyPhoto ) {
										objects.prettyPhoto($.thb.config.get('thb_lightbox', 'prettyPhoto'));
									}
								}
							});

							if( !html.find('#thb-infinite-scroll-button').length ) {
								load_more.hide();
							}
						}
					}
				});

				return false;
			});
		};

		/**
		 * Blog A
		 * ---------------------------------------------------------------------
		 */
		this.timeline = function( index, load ) {
			if( !load ) {
				$("#timeline li").removeClass("current");
				$("#timeline li").eq(index).addClass("current");
			}

			$("#timeline a").removeClass("hover");

			var current_index = $("#timeline li.current").index(),
				step = 150,
				shift = (step * current_index) + step/2;

			$("#timeline ul")
				.css('margin-left', -1 * shift);
		};

		this.timelineNext = function() {
			var current = $("#timeline li.current"),
				current_index = current.index(),
				next = current.next();

			if( next.length > 0 ) {
				this.timeline( current_index + 1 );
			}
		};

		this.timelinePrev = function() {
			var current = $("#timeline li.current"),
				current_index = current.index(),
				prev = current.prev();

			if( prev.length > 0 ) {
				this.timeline( current_index - 1 );
			}
		};

		this.pageBlogAPageChange = function( href, callback ) {
			if( !thb_page_loaded ) {
				return;
			}

			thb_page_loaded = false;

			var self = this,
				content_wrapper = ".thb-content-wrapper",
				hentry_wrapper = ".thb-hentry-wrapper";

			$.thb.pageChange( href, {
				preload: true,
				filter: '.thb-content-wrapper',
				waitfor: '.thb-hentry-wrapper .hentry',
				before: function() {
					self.changeBackground('');

					$.thb.transition(".thb-hentry-wrapper .hentry", function( el ) {
						el.remove();
					});

					$.thb.transition(".thb-content-wrapper .thb-navigation", function( el ) {
						el.remove();
					});
				},
				complete: function( data ) {
					var hentry = $( $(data).find('.hentry').outerHTML() );
					var featured_image = hentry.data('fullbackground');

					self.changeBackground(featured_image, function() {
						thb_page_loaded = true;
					});
				},
				after: function( data ) {
					var hentry = $( $(data).find('.hentry').outerHTML() );
					var featured_image = hentry.data('fullbackground');
					var navigation = $( $(data).find('.thb-navigation').outerHTML() );

					hentry.addClass('thb-01');
					navigation.addClass('thb-01');

					if( $(hentry_wrapper).find(".jspPane").length && !self.isMobile ) {
						$(hentry_wrapper).find(".jspPane").append(hentry);
					}
					else {
						$(hentry_wrapper).append(hentry);
					}

					$(content_wrapper).append(navigation);

					setTimeout(function() {
						$.thb.transition(".thb-hentry-wrapper .hentry", function( el ) {
							thb_boot_frontend(hentry);

							if( callback ) {
								callback();
							}
						});

						$(".thb-content-wrapper .thb-navigation").removeClass("thb-01");
						$(".thb-hentry-wrapper .hentry").removeClass("thb-01");
					}, 0);
				}
			});
		};

		this.pageBlogA = function() {
			var self = this;

			this.timeline(0, true);
			thb_page_loaded = true;

			if( !self.isMobile ) {
				self.jScrollPane = $('.thb-hentry-wrapper').jScrollPane( self.jScrollPaneOptions ).data().jsp;
			}

			$("#timeline a")
				.mouseenter(function() {
					$(this).parent().addClass("hover");
				})
				.mouseleave(function() {
					$(this).parent().removeClass("hover");
				});

			$("#timeline a").on("click", function() {
				if( !$("body").hasClass("thb-responsive-mobile-off") && $(window).width() < 768 ) {
					return true;
				}

				if( !thb_page_loaded ) {
					return;
				}

				var link = $(this);

				self.pageBlogAPageChange( $(this).attr('href'), function() {
					self.timeline( link.parent().index() );
				} );

				return false;
			});

			$(document).on('click', '#content .thb-navigation a', function() {
				if( !$("body").hasClass("thb-responsive-mobile-off") && $(window).width() < 768 ) {
					return true;
				}

				if( !thb_page_loaded ) {
					return;
				}

				var link = $(this),
					has_next = link.parent().hasClass('nav-next');

				self.pageBlogAPageChange( $(this).attr('href'), function() {
					if( has_next ) {
						self.timelineNext();
					}
					else {
						self.timelinePrev();
					}
				} );

				return false;
			});

			/**
			 * Keyboard navigation
			 */
			$.thb.key("left", function() {
				if( !thb_page_loaded ) {
					return;
				}

				var link = $('.thb-navigation .nav-previous a');

				if( link.length ) {
					self.pageBlogAPageChange(link.attr('href'), function() {
						self.timelinePrev();
					});
				}
			}.debounce(this.debounceTime));

			$.thb.key("right", function() {
				if( !thb_page_loaded ) {
					return;
				}

				var link = $('.thb-navigation .nav-next a');

				if( link.length ) {
					self.pageBlogAPageChange(link.attr('href'), function() {
						self.timelineNext();
					});
				}
			}.debounce(this.debounceTime));
		};

		/**
		 * Page blog B
		 * ---------------------------------------------------------------------
		 */
		this.pageBlogB = function() {
			thb_page_loaded = true;
		};

		/**
		 * Page blog D + Portfolio non-masonry
		 * ---------------------------------------------------------------------
		 */
		this.pageBackward = function( callback ) {
			if( !$(".hentry.current").prev().length ) {
				thb_page_loaded = true;
				return;
			}

			if( !$(".hentry.current").prev().prev().length ) {
				$("#thb-controls .thb-control-prev").addClass("thb-disabled");
			}

			$("#thb-controls .thb-control-next").removeClass("thb-disabled");

			var content = $(".thb-content-wrapper");

			$.thb.transition(content, function() {
				thb_page_loaded = true;
			});

			content.css('margin-left', '+=' + this.pace);

			var current_idx = $(".hentry.current").index();
			$(".hentry").eq(current_idx).removeClass("current");
			$(".hentry").eq(current_idx).prev()
				.addClass("current")
				.removeClass("old");
			$(".hentry").eq(current_idx).prev().prev()
				.addClass("old");

			if( callback ) {
				callback();
			}
		};

		this.pageForward = function( callback ) {
			if( !$(".hentry.current").next().length ) {
				thb_page_loaded = true;
				return;
			}

			if( !$(".hentry.current").next().next().length ) {
				$("#thb-controls .thb-control-next").addClass("thb-disabled");
			}

			$("#thb-controls .thb-control-prev").removeClass("thb-disabled");

			var content = $(".thb-content-wrapper"),
				self = this;

			content.css('margin-left', '-=' + this.pace);

			var current_idx = $(".hentry.current").index();
			$(".hentry").eq(current_idx)
				.removeClass("current")
				.addClass("old");
			$(".hentry").eq(current_idx).next().addClass("current");

			if( !$(".hentry").eq(current_idx + 3).length && this.forward_count < total_posts - 3 ) {
				content.css('width', content.outerWidth() + this.pace);

				$.thb.loadUrl(load_url, {
					preload: true,
					filter: ".thb-content-wrapper",
					after: function( data ) {
						self.forward_count++;

						var hentry = $( $(data).find('.hentry').eq(self.clicked_index).outerHTML() );

						if( self.clicked_index == 2 ) {
							load_url = hentry.data('pager');
							self.clicked_index = 0;
						}
						else {
							self.clicked_index++;
						}

						hentry.addClass('thb-01');

						content.append(hentry);

						setTimeout(function() {
							thb_page_loaded = true;
						}, parseFloat(hentry.css('transitionDuration')) * 1000);

						$.thb.transition(hentry, function() {
							thb_page_loaded = true;
						});

						setTimeout(function() {
							hentry.removeClass('thb-01');
						}, 0);

						self.adjustCarousel(true);
						thb_boot_frontend(hentry);

						if( callback ) {
							callback( hentry );
						}
					}
				});
			}
			else {
				$.thb.transition(content, function() {
					thb_page_loaded = true;
				});
			}
		};

		this.pageBlogD = function() {
			var self = this;

			thb_page_loaded = true;
			this.clicked_index = 0;
			this.forward_count = 0;

			$(".hentry").first().addClass("current");

			/**
			 * Direction navigation
			 */
			$("#thb-controls .thb-control-prev a").on("click", function() {
				if( !thb_page_loaded ) {
					return false;
				}

				thb_page_loaded = false;

				self.pageBackward();

				return false;
			});

			$("#thb-controls .thb-control-next a").on("click", function() {
				if( !thb_page_loaded ) {
					return false;
				}

				thb_page_loaded = false;

				self.pageForward();

				return false;
			});

			/**
			 * Keyboard navigation
			 */
			$.thb.key("left", function() {
				if( !thb_page_loaded ) {
					return;
				}

				thb_page_loaded = false;

				self.pageBackward();
			}.debounce(this.debounceTime));

			$.thb.key("right", function() {
				if( !thb_page_loaded ) {
					return;
				}

				thb_page_loaded = false;

				self.pageForward();
			}.debounce(this.debounceTime));

			/**
			 * Swipe navigation
			 */
			$('body').hammer().bind('swipeleft', function(e) {
				if( !thb_page_loaded ) {
					return;
				}

				thb_page_loaded = false;

				self.pageForward();
			});

			$('body').hammer().bind('swiperight', function(e) {
				if( !thb_page_loaded ) {
					return;
				}

				thb_page_loaded = false;

				self.pageBackward();
			});

			return true;
		};

		/**
		 * Template portfolio non-masonry
		 * ---------------------------------------------------------------------
		 */
		this.pagePortfolioB = function() {
			var self = this;
			thb_page_loaded = true;

			$(".hentry .item-thumb-stretch").thb_stretcher({
				adapt: false,
				slides: '> .slide'
			});

			this.clicked_index = 0;
			this.forward_count = 0;

			$(".hentry").first().addClass("current");

			$(window).load(function() {
				if( self.isMobile ) {
					$.scrollTo(1, 1);
				}
			});

			$(document).bind('mousewheel', function(event, delta, deltaX, deltaY) {
				if( !thb_page_loaded ) {
					return;
				}

				if( delta > 0 ) {
					thb_page_loaded = false;

					self.pageForward(function( hentry ) {
						$(".hentry").css('height', $(window).height() - self.headerHeight() - self.footerHeight() );

						hentry.find(".item-thumb-stretch").thb_stretcher({
							adapt: false,
							slides: '> .slide'
						});
					});
				}
				else {
					self.pageBackward();
				}
			}.debounce(this.debounceTime));

			/**
			 * Direction navigation
			 */
			$("#thb-controls .thb-control-prev a").on("click", function() {
				if( !thb_page_loaded ) {
					return;
				}

				self.pageBackward();

				return false;
			});

			$("#thb-controls .thb-control-next a").on("click", function() {
				if( !thb_page_loaded ) {
					return;
				}

				thb_page_loaded = false;

				self.pageForward(function( hentry ) {
					$(".hentry").css('height', $(window).height() - self.headerHeight() - self.footerHeight() );

					hentry.find(".item-thumb-stretch").thb_stretcher({
						adapt: false,
						slides: '> .slide'
					});
				});

				return false;
			});

			/**
			 * Keyboard navigation
			 */
			$.thb.key("left", function() {
				if( !thb_page_loaded ) {
					return;
				}

				self.pageBackward();
			}.debounce(this.debounceTime));

			$.thb.key("right", function() {
				if( !thb_page_loaded ) {
					return;
				}

				thb_page_loaded = false;

				self.pageForward(function( hentry ) {
					$(".hentry").css('height', $(window).height() - self.headerHeight() - self.footerHeight() );

					hentry.find(".item-thumb-stretch").thb_stretcher({
						adapt: false,
						slides: '> .slide'
					});
				});
			}.debounce(this.debounceTime));

			/**
			 * Swipe navigation
			 */
			$('body').hammer().bind('swipeleft', function(e) {
				if( !thb_page_loaded ) {
					return;
				}

				thb_page_loaded = false;

				self.pageForward(function( hentry ) {
					$(".hentry").css('height', $(window).height() - self.headerHeight() - self.footerHeight() );

					hentry.find(".item-thumb-stretch").thb_stretcher({
						adapt: false,
						slides: '> .slide'
					});
				});
			});

			$('body').hammer().bind('swiperight', function(e) {
				if( !thb_page_loaded ) {
					return;
				}

				self.pageBackward();
			});
		};

		if( this[mode] ) {
			this[mode]();
		}
	};
})(jQuery);