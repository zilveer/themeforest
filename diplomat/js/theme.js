(function($, window, Modernizr, document) {
	'use strict';

	var Tmm_theme = function() {
		var self = {
			$window : $(window),
			el : $('body'),
			navMobile: $('#mobile-advanced'),
			navMain : $('#navigation'),
			wrapper: $('#wrapper'),
			header : $('#header'),
			headerBottom : $('.header-bottom'),
			headerTop : $('.header-top'),
			headerMiddle : $('.header-middle'),
			navButton: $(),
			touch : Modernizr.touch,
			support : Modernizr.cssanimations && Modernizr.csstransitions,
			eventtype : this.touch ? 'touchstart' : 'click',
			touchMoving : false,
			backTopButton : $('#back-top'),

			init: function () {

				this.navButton = $('<a/>', {
					id: 'responsive-nav-button',
					'class': 'responsive-nav-button',
					href: '#'
				}).insertBefore(self.navMain);

				this.navHide = $('<a/>', {
					id: 'advanced-menu-hide',
					href: '#'
				}).insertBefore(self.navMobile);

				self.navInit();
			},
			stickyHeader: function() {
				if ($(window).width() > 767) {
					if ($(window).scrollTop() > (self.headerTop.outerHeight(true) + self.headerMiddle.outerHeight(true))) {
						self.header.addClass('shrink-bottom-line');
					} else {
						self.header.removeClass('shrink-bottom-line');
					}
				}
			},
			navInit: function () {
				self.mainNav(self, self.$window);
				self.touchNav(self, self.$window);

				self.$window.on('resize.nav', function (e) {
					var timer = setTimeout(function () {
						clearTimeout(timer);
						self.mainNav(self, e.currentTarget);
						self.touchNav(self, e.currentTarget);
					}, 30);
				});
			},

			mainNav: function (self, target) {

				var noTouchWidth = $(target).width() > 992;

				if (noTouchWidth) {

					self.navMain.children('div').children('ul').children('li').each(function (idx, val) {

						var $this = $(val),
							megaMenu = $this.children('.mega-menu');

						if (!megaMenu.length) {

							$this.find('ul').parent().each(function () {
								var $el = $(this);

								$el.data('is', $el.parents('ul').length === 1 ? true : false)
									.addClass(!$el.data('is') ? 'arrowright' : '');
							});
						}

						if (megaMenu.length) {

							var list = megaMenu.children('ul').find('ul.sub-menu'),
								headerWidth = self.navMain.width(),
								columns = megaMenu.children('ul').find('li>span'),
								empty_li = megaMenu.children('ul').children('li'),
								length = list.length,
								dataColumn,
								li, size = [];

							if (columns.length > length) {

								empty_li.css({width: Math.ceil(headerWidth / empty_li.length)});
							} else {

								list.each(function (idx, value) {

									var $this = $(this),
										item_width;
									dataColumn = $this.parent().find('span').data('column');
									if (dataColumn) {
										switch (dataColumn) {
											case 'one_fourth' :
												item_width = Math.ceil(headerWidth * 25 / 100);
												break;
											case 'one_third' :
												item_width = Math.ceil(headerWidth * 33.33333333333333 / 100);
												break;
											case 'one_half' :
												item_width = Math.ceil(headerWidth / 2);
												break;
											case 'two_thirds' :
												item_width = Math.ceil(headerWidth * 66.66666666666666 / 100);
												break;
											case 'three_fourth' :
												item_width = Math.ceil(headerWidth * 75 / 100);
												break;
											default :
												item_width = headerWidth;
												break;
										}

										$this.css({width: item_width}).addClass(dataColumn);

									} else {
										$this.css({width: Math.ceil(headerWidth / length)});
									}

									li = $(value).children('li');
									size.push(li.length);
								});
							}

							$this.addClass('is-mega-menu');

						}

					});
				} else {
					self.navMobile.find('.mega-menu')
						.children('ul')
						.find('ul')
						.attr('style', '')
						.find('li:has(.nothing)').remove();
				}
			},

			touchNav: function (self, target) {
				if (self.touch || $(target).width() < 993) {

					if (!self.navMobile.children('div').length) {
						self.navMobile.append(self.navMain.html());
						self.navMobile.find('.inner-tooltip').attr('style', '');
					}

					self.navButton.on(self.eventtype, function (e) {
						e.preventDefault();
						if (!self.wrapper.is('.active')) {
							$('html, body').animate({scrollTop: 0}, 0, function () {
								self.wrapper.css({
									height: self.navMobile.find('div').outerHeight(true) +
									self.navMobile.children('.search-box').outerHeight(true)
								}).addClass('active');
							});
						}
						var folio_items = self.navMobile.find('.portfolio-items article');
						if (folio_items.length) {
							folio_items.slideFade({
								find: '.item-overlay'
							});
						}

					});
					self.navHide.on(self.eventtype, function (e) {
						e.preventDefault();
						if (self.wrapper.is('.active')) {
							self.wrapper.css({height: 'auto'}).removeClass('active');
						}
					});
				} else {
					self.navMobile.children('ul').remove().next().remove();
				}
			},
			portfolioInit: function (wrapper) {
				var $items_wrapper_id = wrapper.find('.portfolio-items').attr('id'),
					uniqid = $items_wrapper_id.replace('portfolio_items_', ''),
					$filter = wrapper.find('#portfolio_filter_'+uniqid),
					$loadMore = wrapper.find('.load-more'),
					$spinner = wrapper.find('.spinner'),
					$items_wrapper = $('#'+$items_wrapper_id),
					$filter_items = $filter.find('.filter');

				$items_wrapper.mixItUp({
					selectors: {
						filter: '#portfolio_filter_' + uniqid + ' .filter'
					}
				}).on('mixLoad', function(){
					$spinner.hide();
				});

				if ($loadMore.length) {

					$loadMore.on('click', function (e) {
						e.preventDefault();
						var $this = $(this);
						var loaded = $this.data('loaded');
						var category = $this.data('category');
						var posts_perload = $this.data('perload');
						var show_categories = $this.data('showcategories');
						var active_tab = $filter.find('.filter.active');
						var active_category = active_tab.length ? active_tab.data('filter') : '';
						var display = wrapper.find('.portfolio-items').data('display');

						if (active_category) {
							active_category = active_category.replace('.', '');
						}

						var data = {
							action: "gallery_get_more",
							loaded: loaded,
							posts_perload : posts_perload,
							category : category,
							active_category : active_category,
							show_categories : show_categories,
							display : display
						};

						$.post(ajaxurl, data, function(response) {
							response = $.parseJSON(response);

							var html = response.article;

							if (html){
								$items_wrapper.find('article:last').after(html);
								$items_wrapper.mixItUp('append', html);

								var loaded = $this.data('loaded'),
									post_key = response.post_key;

								loaded = loaded !== '' ? loaded + ',' + post_key : post_key;

								$loadMore.data('loaded', loaded);

								if (response.next_post) {
									$loadMore.fadeIn();
								} else {
									$loadMore.fadeOut();
								}

							}else{

								if (response.next_post) {
									$loadMore.fadeIn();
								} else {
									$loadMore.fadeOut();
								}

							}

						});

					});

				}

				if ($filter_items.length) {

					$filter_items.on('click', function (e) {
						e.preventDefault();

						$loadMore = wrapper.find('.load-more');

						var $this = $(this);

						if ($loadMore.length) {
							var loaded = $loadMore.data('loaded');
							var category = $loadMore.data('category');
							var posts_perload = $loadMore.data('perpage');
							var total = $loadMore.data('total');
							var show_categories = $loadMore.data('showcategories');
							var active_category = $this.data('filter');
							var display = wrapper.find('.portfolio-items').data('display');

							if (active_category) {
								active_category = active_category.replace('.', '');
							}

							var article_length = $items_wrapper.find('.mix').length,
								active_article_length = $items_wrapper.find('.mix.'+active_category).length;

							if (active_category !== 'all' && article_length < total) {

								if (active_article_length === 0) {
									$spinner.show();
								}

								var load_count = active_article_length > posts_perload ? 0 : (posts_perload - active_article_length);

								var data = {
									action: "gallery_get_more",
									loaded: loaded,
									posts_perload : load_count,
									category : category,
									active_category : active_category,
									show_categories : show_categories,
									display : display
								};

								$.post(ajaxurl, data, function(response) {
									response = $.parseJSON(response);

									var html = response.article;

									if (html){

										if (active_article_length < posts_perload) {

											$items_wrapper.find('article:last').after(html);

											setTimeout(function(){
												$items_wrapper.mixItUp('append', html);
												$spinner.hide();
											}, 600);

											var loaded = $loadMore.data('loaded'),
												post_key = response.post_key;

											loaded = loaded !== '' ? loaded + ',' + post_key : post_key;

											$loadMore.data('loaded', loaded);

											if (response.next_post) {
												$loadMore.fadeIn();
											} else {
												$loadMore.fadeOut();
											}

										} else {
											$loadMore.fadeIn();
											$spinner.hide();
										}

									}else{

										if (response.next_post) {
											$loadMore.fadeIn();
										} else {
											$loadMore.fadeOut();
										}

										$spinner.hide();

									}

								});

							} else if (active_category === 'all' && article_length < total) {
								$loadMore.fadeIn();
							}
						}

					});
				}
			},

			magnificPopupInitStapel: function(a){
				a.magnificPopup({
					type: 'image',
					removalDelay: 500,
					tLoading: 'Loading image #%curr%...',
					callbacks: {
						beforeOpen: function() {

							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
							this.st.mainClass = 'mfp-move-horizontal';
						},
						buildControls: function() {
							// re-appends controls inside the main container
							this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
						}
					},
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0, 1]
					},
					closeOnContentClick: true,
					midClick: true
				});
			},

			magnificPopupGall: function(a){
				a.magnificPopup({
					delegate: 'article[style="display: inline-block;"] .popup-link',
					type: 'image',
					removalDelay: 500,
					tLoading: 'Loading image #%curr%...',
					callbacks: {
						beforeOpen: function() {

							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
							this.st.mainClass = 'mfp-move-horizontal';
						},
						buildControls: function() {

							// re-appends controls inside the main container
							if ($('article[style="display: inline-block;"] .popup-link').length > 1)
								this.contentContainer.append(this.arrowLeft.add(this.arrowRight));

							}
					},
					gallery: {
						enabled: true
					},
					closeOnContentClick: true,
					midClick: true
				});
			},
			magnificPopupImage: function(a){
				a.magnificPopup({
					type: 'image',
					removalDelay: 500,
					tLoading: 'Loading image #%curr%...',
					gallery: {
						enabled: true
					},
					closeOnContentClick: true,
					midClick: true
				});
			},
			magnificPopupPostGall: function(a){
				a.magnificPopup({
					type: 'image',
					removalDelay: 500,
					tLoading: 'Loading image #%curr%...',
					callbacks: {
						beforeOpen: function() {

							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
							this.st.mainClass = 'mfp-move-horizontal';
						},
						buildControls: function() {
							// re-appends controls inside the main container
							this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
						}
					},
					gallery: {
						enabled: true
					},
					closeOnContentClick: true,
					midClick: true
				});
			},

			masonryReload: function () {

				$('.masonry').masonry('reload');

				var old_post_key = 0,
					masonryjaxloader = $('.load-more'),
					posts = masonryjaxloader.data('posts'),
					posts_per_load = masonryjaxloader.data('posts-per-load'),
					page_load = masonryjaxloader.data('page-load'),
					category = masonryjaxloader.data('category'),
					buttons = masonryjaxloader.data('buttons'),
					columns = $('.masonry').data('columns'),
					title_symbols = $('.masonry').data('titlesymbols'),
					excerpt_symbols = $('.masonry').data('excerptsymbols'),
					show_excerpt = $('.masonry').data('showexcerpt'),
					image_background = $('.masonry').data('imagebackground'),
					image_opacity = $('.masonry').data('imageopacity'),
					masonrySpiner = $('.spinner');

				if (posts) {

					if ((old_post_key != posts)) {
						masonrySpiner.animate({opacity: 'show'}, 300);
						var data = {
							action: "get_post_masonry_piece",
							posts: posts,
							category: category,
							buttons: buttons,
							posts_per_load: posts_per_load,
							title_symbols:title_symbols,
							excerpt_symbols:excerpt_symbols,
							show_excerpt:show_excerpt,
							page_load: page_load,
							image_background:image_background,
							image_opacity:image_opacity,
							columns: columns
						};

						$.post(ajaxurl, data, function(response) {

							response = $.parseJSON(response);
							var response_lm = response.load_more,
								response_lm_posts = $(response_lm).data('posts'),
								postLoadMore = $('.post-load-more');

							postLoadMore.empty().append(response_lm);

							response = response.article;
							old_post_key = response_lm_posts;

							$('.masonry').masonry('reload');

							$('.masonry').imagesLoaded(function(){

								for (var post in response) {

									if (post) {

										var el = $(response[post]);

										$(".masonry").append(el).masonry('appended', el);

										$('.masonry').masonry('reload');


										$(".masonry").effect({
											effect: 'slideUp',
											speed: 300
										});
										if ($('video').length) {
											$('video').mediaelementplayer({
												videoWidth: '',
												videoHeight: ''
											});
											$('.masonry').masonry('reload');
										}
										$('.masonry').masonry('reload');

									}
								}

								setTimeout(function(){
									$('.masonry').masonry('reload');
								},400);


								masonrySpiner.animate({opacity: 'hide'}, 800);

								if (response_lm_posts) {

									$(".masonry").next('.post-load-more').empty();
									$(".masonry").next('.post-load-more').append(response_lm);
								} else {
									$(".masonry").next().next('.post-load-more').remove();
								}

								$('#wrapper').fitVids();

								if ($('audio').length) {
									$('audio').mediaelementplayer({
										audioWidth: '100%',
										audioHeight: 45
									});
								}



								if ($('.post-type-gallery').length) {

									$('.post-type-gallery').each(function () {

										$(this).owlCarousel({
											autoPlay: 5000,
											stopOnHover: true,
											navigation: true,
											slideSpeed: 300,
											paginationSpeed: 400,
											singleItem: true,
											theme: "owl-theme",
											transitionStyle: "fadeUp"
										});
									});
								}

								$("a.social-like").click(function () {

									var heart = $(this);
									var post_id = heart.data("post_id");

									$.ajax({
										type: "post",
										url: ajaxurl,
										data: "action=post-like&nonce=" + ajax_nonce + "&post_like=&post_id=" + post_id,
										success: function (count) {
											if (count != "already") {
												heart.addClass("voted");
												heart.find(".count").text(count);
											}
										}
									});
									return false;
								});

							});

						});

					}

				}
			},
			animateElements: function () {
				if ($('.elementFade').length) {
					$('.elementFade').appear({
						accX: 0,
						accY: -150,
						data: 'elementFade',
						speedAddClass: 0
					});
				}

				if ($('.slideUp').length) {
					$('.slideUp').appear({
						accX: 0,
						accY: -150,
						data: 'slideUp'
					});
				}

				if ($('.slideLeft').length) {
					$('.slideLeft').appear({
						accX: 0,
						accY: -150,
						data: 'slideLeft'
					});
				}

				if ($('.slideRight').length) {
					$('.slideRight').appear({
						accX: 0,
						accY: -150,
						data: 'slideRight'
					});
				}
				if ($('.slideDown').length) {
					$('.slideDown').appear({
						accX: 0,
						accY: -150,
						data: 'slideDown'
					});
				}

				if ($('.opacity').length) {
					$('.opacity').appear({
						accX: 0,
						accY: 300,
						data: 'opacity'
					});
				}

				if ($('.opacity2x').length) {
					$('.opacity2x').appear({
						accX: 0,
						accY: 150,
						data: 'opacity2x'
					});
				}

				if ($('.slideUp2x').length) {
					$('.slideUp2x').appear({
						accX: 0,
						accY: 300,
						data: 'slideUp2x',
						speedAddClass: 200
					});
				}

				if ($('.scale').length) {
					$('.scale').appear({
						accX: 0,
						accY: 150,
						data: 'scale'
					});
				}

				if ($('.extraRadius').length) {
					$('.extraRadius').appear({
						accX: 0,
						accY: -150,
						data: 'extraRadius'
					});
				}
			},
			backTopClickHandler : function(){
				self.backTopButton.life('click', function (e) {
					e.preventDefault();
					$('html, body').animate({ scrollTop: 0 }, 800);
				});
			},
			backTopScrollHandler: function () {

				var backTop = self.el.find('#back-top');
				if ($(window).scrollTop() > 200){
					backTop.fadeIn(400);
				}else{
					backTop.fadeOut(400);
				}
			}
		};
		return self;
	};

	var Tmm_ext_theme = null;

	$(function() {

		Tmm_ext_theme = new Tmm_theme();
		Tmm_ext_theme.init();

		/* ---------------------------------------------------- */
		/*	    OnTouchmove                                     */
		/* ---------------------------------------------------- */

		var nAgt = navigator.userAgent;
		jQuery.browser.ios = /iPhone|iPad|iPod|webOS/i.test(nAgt);
		jQuery.browser.android = /Android/i.test(nAgt);
		var browserMobile =jQuery.browser.android || jQuery.browser.ios;

		if (browserMobile)
		{
			document.ontouchmove = function()
			{
				Tmm_ext_theme.touchMoving = true;
			};

			document.ontouchend = function()
			{
				Tmm_ext_theme.touchMoving = false;
			};
		}

		/* ---------------------------------------------------- */
		/*	Tmm Loader                                          */
		/* ---------------------------------------------------- */

		var tmm_loader = {
			screen_1 : $('.tmm_loader'),

			init : function(){
				var $this = this,
					wrapper = $('#wrapper');
					wrapper.addClass('translate');
				function runLoader(){
					setTimeout(function(){
						$this.screen_1.addClass('fade');
						wrapper.addClass('translateRun');

					},600);

					setTimeout(function(){
						$this.screen_1.remove();
						wrapper.removeClass('translateRun').removeClass('translate');
					},1300);
				}

				if (browserMobile){
					$(document).ready(function() {
						runLoader();
					});
				}else{
					$(window).load(function() {
						runLoader();
					});
				}

			}
		};

		tmm_loader.init();


		/* ---------------------------------------------------- */
		/*	Back to Top											*/
		/* ---------------------------------------------------- */

		Tmm_ext_theme.el.append('<a href="#" id="back-top" title="Back To Top"></a>');
		Tmm_ext_theme.backTopClickHandler();

		/* ---------------------------------------------------- */
		/*	Fixed Menu											*/
		/* ---------------------------------------------------- */

		if (jQuery('.header-fixed').length){
			$(window).on('scroll', function (e) {
				Tmm_ext_theme.stickyHeader();
				Tmm_ext_theme.backTopScrollHandler();
			});
		}

		/* ---------------------------------------------------- */
		/*	FitVids                                             */
		/* ---------------------------------------------------- */

		$('#wrapper').fitVids();

		/* ---------------------------------------------------- */
		/*	Animate Elements									*/
		/* ---------------------------------------------------- */

		Tmm_ext_theme.animateElements();
		window.Tmm_animateElements = Tmm_ext_theme.animateElements;

		/* ---------------------------------------------------- */
		/*	MixItUp												*/
		/* ---------------------------------------------------- */

		if ($('.portfolio-items').length) {
			$('.portfolio-holder').each(function(){
				Tmm_ext_theme.portfolioInit( $(this) );
			});
		}

		/*---------------------------------------------------- */
		/*	Alert Boxes Init 							 	   */
		/*---------------------------------------------------- */

		var $notifications = $('.error, .success, .info, .notice, .transparent');

		if ($notifications.length) {
			$notifications.notifications({speed: 300});
		}

		/* ---------------------------------------------------- */
		/*	Stapel												*/
		/* ---------------------------------------------------- */

		if($('#tp-grid').length) {
			var $grid = $( '#tp-grid' ),
				$name = $( '#name' ),
				$close = $( '#gallery-close' ),
				$loader = $( '<div class="loader"><i></i><i></i><i></i><i></i><i></i><i></i><span>Loading...</span></div>' ).insertBefore( $grid ),
				stapel = $grid.stapel( {
					onLoad : function() {
						$loader.remove();
					},
					onBeforeOpen : function( pileName ) {
						$name.html( pileName );
						var groups = $('.tp_groups').val();
						for (var i=1; i<=groups; i++){
							Tmm_ext_theme.magnificPopupInitStapel($('.popup-link-'+i));
						}
					},
					onAfterOpen : function() {
						$close.show();
					},
					gutter : 45

				});

			$close.on( 'click', function() {
				$close.hide();
				$name.empty();
				stapel.closePile();
			} );
		}

		/* ---------------------------------------------------- */
		/* Post Like										*/
		/* ---------------------------------------------------- */

		$('body').on('click', 'a.post-like', function (e) {
			e.preventDefault();
			var heart = $(this),
				post_id = heart.data("post_id");

			$.ajax({
				type: "post",
				url: ajaxurl,
				data: "action=post-like&nonce="+ ajax_nonce +"&post_like=&post_id=" + post_id,
				success: function (count) {
					if (count != "already") {
						heart.addClass("voted");
						heart.children(".vote-count").text(count);
					}
				}
			});
		});

		/* ---------------------------------------------------- */
		/*	Magnific Popup										*/
		/* ---------------------------------------------------- */

		if ($('.popup-gallery').length) {
			Tmm_ext_theme.magnificPopupGall($('.popup-gallery'));
		}
		if ($('.single-image-link').length){
			Tmm_ext_theme.magnificPopupImage($('.single-image-link'));
		}
		if ($('div:not(.cloned)>.image-link').length){
			Tmm_ext_theme.magnificPopupPostGall($('div:not(.cloned)>.image-link'));
		}

		/* ---------------------------------------------------- */
		/*	Media Element Player								*/
		/* ---------------------------------------------------- */

		var $player = $('audio, video');

		if ($player.length) {
			$player.mediaelementplayer({
				audioWidth: '100%',
				audioHeight: 45,
				videoWidth: '',
				videoHeight: ''
			});
		}

		/* ---------------------------------------------------- */
		/*	Masonry                                             */
		/* ---------------------------------------------------- */

		if ($('.masonry').length){
			var k;
			var more_button = $('.load-more');
			var load_by_scroll = more_button.data('loadbyscroll');

			if (more_button.length){
				if (load_by_scroll){
					$(window).scroll(function() {
						var win_scroll = $(window).scrollTop();
						var button_top = more_button.offset().top;

						if (win_scroll > (button_top-800)) {

							var posts_load = $('.load-more').data('posts');

							if (posts_load!=k){

								Tmm_ext_theme.masonryReload();
								k = posts_load;

							}
						}
					});
				}else{
					more_button.life('click', function(){
						var posts_load = $(this).data('posts');
						if (posts_load!=k){
							Tmm_ext_theme.masonryReload();
							k=posts_load;
						}
						return false;
					});
				}
			}
		}

	});

	/*----------------------------------------------------*/
	/*	Accordion and Toggle							  */
	/*----------------------------------------------------*/

	if ($('.accordion').length) {

		var	$trigger = $('.accordion-navigation .acc-trigger');

		$trigger.on('click', function() {

			if (Tmm_ext_theme.touchMoving) return false;

			var $thisTrigger = $(this).parents('.accordion').find('.acc-trigger');

			var $this = $(this);
			if ($this.data('mode') === 'toggle') {
				$this.toggleClass('active').next().stop(true, true).slideToggle(300);
			} else {
				if ($this.hasClass('active')) {
					$this.removeClass('active').next().stop(true, true).slideUp(300);
				} else {
					$thisTrigger.removeClass('active').next().slideUp(300);
					$this.addClass('active').next().slideDown(300);
				}
			}
			return false;
		});
	}

	/* ---------------------------------------------------- */
	/*	Tabs												*/
	/* ---------------------------------------------------- */

	if ($('.tabs-holder').length) {

		var $tabsHolder = $('.tabs-holder');

		$tabsHolder.each(function(i, val) {

			var $tabsNav = $('.tabs-nav', val),
				eventtype = Modernizr.touch ? 'touchstart' : 'click';

			$tabsNav.each(function() {
				$(this).next().children('.tab-content').first().stop(true, true).show();
				$(this).children('li').first().addClass('active').stop(true, true).show();
			});

			$tabsNav.on(eventtype, 'h3', function(e) {

				var $this = $(this).parent('li'),
					$index = $this.index();
				$this.siblings().removeClass('active').end().addClass('active');
				$this.parent().next().children('.tab-content').stop(true, true).hide().eq($index).stop(true, true).fadeIn(250);
				e.preventDefault();
			});
		});
	}


	/* ---------------------------------------------------- */
	/*	Facebook comments									*/
	/* ---------------------------------------------------- */

	if ($('.fb-comments').length) {
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id))
				return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_EN/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	}

    /* ---------------------------------------------------- */
    /*	FitVids												*/
    /* ---------------------------------------------------- */

    $.fn.fitVids = function(options) {
        var settings = {
            customSelector: null
        };

        if (!document.getElementById('fit-vids-style')) {

            var div = document.createElement('div'),
                ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0],
                cssStyles = '&shy;<style>.fluid-width-video-wrapper{width:100%; position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>';

            div.className = 'fit-vids-style';
            div.id = 'fit-vids-style';
            div.style.display = 'none';
            div.innerHTML = cssStyles;

            ref.parentNode.insertBefore(div, ref);

        }

        if (options) {
            $.extend(settings, options);
        }

        return this.each(function() {
            var selectors = [
                "iframe[src*='player.vimeo.com'].fitwidth",
                "iframe[src*='youtube.com'].fitwidth",
                "iframe[src*='youtube-nocookie.com'].fitwidth",
                "iframe[src*='kickstarter.com'][src*='video.html'].fitwidth",
                "object",
                "embed"
            ];

            if (settings.customSelector) {
                selectors.push(settings.customSelector);
            }

            var $allVideos = $(this).find(selectors.join(','));
            $allVideos = $allVideos.not("object object"); // SwfObj conflict patch


            $allVideos.each(function() {
                var $this = $(this);
                if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) {
                    return;
                }
                var height = (this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10)))) ? parseInt($this.attr('height'), 10) : $this.height(),
                    width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
                    aspectRatio = height / width;
                if (!$this.attr('id')) {
                    var videoID = 'fitvid' + Math.floor(Math.random() * 999999);
                    $this.attr('id', videoID);
                }
                $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100) + "%");
                $this.removeAttr('height').removeAttr('width');

            });
        });

    };

	/* ---------------------------------------------------- */
	/*	Init Masonry    									*/
	/* ---------------------------------------------------- */

	$.fn.init_masonry=function(columns){
		var $container = jQuery('.masonry'),
			containerWidth = $container.width(),
			masonrySpiner = $('.spinner');

		$container.imagesLoaded(function() {
			$container.masonry({
				itemSelector: '.post-item',
				columnWidth: containerWidth / columns,
				hiddenStyle: {
					'opacity': '0'
				}
			});
		});

		$container.addClass('loaded');

		$container.animate({'opacity': 1}, 777, function() {
			masonrySpiner.animate({opacity: 'hide'}, 333);
		});
	};


	/* ---------------------------------------------------- */
	/*	Checkboxes and radio buttons    					*/
	/* ---------------------------------------------------- */

	$(function() {

		var form = $('form');

		form.find('input[type="checkbox"]').each(function(){

			if (!$(this).hasClass('tmm-checkbox')) {

				var id = $(this).attr('id'),
					index = $(this).index('input[type="checkbox"]'),
					_this = $(this).get(0),
					next = _this.nextSibling;

				if (id === undefined) {
					id = 'tmm_cb_' + index;
					$(this).attr('id', id);
				}

				if ($(next).length) {
					if (next.nodeType === 3 && $.trim(next.nodeValue) !== '') {
						$(next).wrap('<label for="'+id+'"></label>');
					} else if($(next).prop("tagName") === 'LABEL') {
						$(next).attr('for', id);
					}
				}

				$(this).addClass('tmm-checkbox');
			}

		});

		form.find('input[type="radio"]').each(function(){

			if (!$(this).hasClass('tmm-radio')) {

				var id = $(this).attr('id'),
					index = $(this).index('input[type="radio"]'),
					_this = $(this).get(0),
					next = _this.nextSibling;

				if (id === undefined) {
					id = 'tmm_rb_' + index;
					$(this).attr('id', id);
				}

				if ($(next).length) {
					if (next.nodeType === 3 && $.trim(next.nodeValue) !== '') {
						$(next).wrap('<label for="'+id+'"></label>');
					} else if($(next).prop("tagName") === 'LABEL') {
						$(next).attr('for', id);
					}
				}

				$(this).addClass('tmm-radio');
			}

		});

		$('.seamless-donations-forms-engine').find('input[type="text"]').each(function(){

			var id = $(this).attr('id'),
				index = $(this).index('input[type="text"]'),
				_this = $(this).get(0),
				prev = _this.previousSibling;

			if (id === undefined) {
				id = $(this).attr('name') + index;
				$(this).attr('id', id);
			}

			if ($(prev).length) {
				if (prev.nodeType === 3 && $.trim(prev.nodeValue) !== '') {
					$(prev).wrap('<label for="'+id+'"></label>');
				} else if($(prev).prop("tagName") === 'LABEL') {
					$(prev).attr('for', id);
				}
			}

		});

		$('.seamless-donations-forms-engine').find('select').each(function(){

			var id = $(this).attr('id'),
				index = $(this).index('select'),
				_this = $(this).get(0),
				prev = _this.previousSibling;

			if (id === undefined) {
				id = $(this).attr('name') + index;
				$(this).attr('id', id);
			}

			if ($(prev).length) {
				if (prev.nodeType === 3 && $.trim(prev.nodeValue) !== '') {
					$(prev).wrap('<label for="'+id+'"></label>');
				} else if($(prev).prop("tagName") === 'LABEL') {
					$(prev).attr('for', id);
				}
			}

		});

	});

}(jQuery, window, Modernizr, document));