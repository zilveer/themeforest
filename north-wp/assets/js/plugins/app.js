var menuscroll, cartscroll;
(function ($, window,_) {
	'use strict';
    
	var $doc = $(document),
			win = $(window),
			thb_ease = new BezierEasing(0.25,0.46,0.45,0.94),
			thb_md = new MobileDetect(window.navigator.userAgent);

	var SITE = SITE || {};
	
	SITE = {
		init: function() {
			var self = this,
					obj;
			
			for (obj in self) {
				if ( self.hasOwnProperty(obj)) {
					var _method =  self[obj];
					if ( _method.selector !== undefined && _method.init !== undefined ) {
						if ( $(_method.selector).length > 0 ) {
							_method.init();
						}
					}
				}
			}
		},
		headRoom: {
			selector: '.snap_scroll_off .header',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				win.scroll(function(){
					base.scroll(container);
				});
			},
			scroll: function (container) {
				var animationOffset = 0,
						wOffset = win.scrollTop(),
						stick = 'hover',
						unstick = 'unhover';
						
				if (wOffset > animationOffset) {
					container.removeClass(unstick);
					if (!container.hasClass(stick)) {
						setTimeout(function () {
							container.addClass(stick);
						}, 10);
					}
				} else if ((wOffset < animationOffset && (wOffset > 0))) {
					if(container.hasClass(stick)) {
						container.removeClass(stick);
						container.addClass(unstick);
					}
				} else {
					container.removeClass(stick);
					container.removeClass(unstick);
				}
			}
			
		},
		responsiveNav: {
			selector: '#wrapper',
			init: function() {
				var base = this,
					container = $(base.selector),
					cc = $('.click-capture'),
					menu = $('#mobile-menu'),
					cart = $('#side-cart'),
					cc_close = $('.thb-close'),
					children = menu.find('.mobile-menu>li'),
					menu_items = menu.find('.mobile-menu>li,.mobile-secondary-menu>li, .social-links, .thb-close'),
					span = menu.find('.mobile-menu li:has(".sub-menu")>a span'),
					tlMainNav = new TimelineLite({ paused: true, onStart: function() { container.addClass('open-menu'); }, onReverseComplete: function() {container.removeClass('open-menu'); } }),
					tlCartNav = new TimelineLite({ paused: true, onStart: function() { container.addClass('open-cart'); }, onReverseComplete: function() {container.removeClass('open-cart'); } });
				
				tlMainNav
					.staggerFromTo(menu_items, 0.25, { delay: 0.25, x: "-30", opacity:0, ease: thb_ease}, { delay: 0.25, x: "0", opacity:1}, 0.05);
					
				tlCartNav
					.staggerFrom($('#side-cart').find('.item'), 0.25, { delay: 0.25, x: "30", opacity:0, ease: thb_ease}, 0.05);
				
				$('.header').on('click', '.mobile-toggle', function() {
					tlMainNav.play();
					return false;
				});
				$('.header').on('click', '#quick_cart', function() {
					tlCartNav.play();
					return false;
				});
				
				cc.add(cc_close).on('click', function() {
					tlMainNav.reverse();
					tlCartNav.reverse();
					return false;
				});
				$('body').on('wc_fragments_refreshed', function() {
					$('.thb-close').on('click', function() {
						tlMainNav.reverse();
						tlCartNav.reverse();
						return false;
					});
				});
				span.on('click', function(e){
					var that = $(this),
							parent = that.parents('a'),
							menu = parent.next('.sub-menu');
					
					if (parent.hasClass('active')) {
						parent.removeClass('active');
						menu.slideUp('200', function() {
							window.menuscroll.refresh();
						});
					} else {
						parent.addClass('active');
						menu.slideDown('200', function() {
							window.menuscroll.refresh();
						});
					}
					e.stopPropagation();
					e.preventDefault();
				});
				
			}
		},
		updateCart: {
			selector: '#quick_cart',
			init: function() {
				var base = this,
					container = $(base.selector);
				$('body').bind('added_to_cart', SITE.updateCart.update_cart_dropdown);
			},
			update_cart_dropdown: function(event) {
				if ($('body').hasClass('woocommerce-cart')) {
					location.reload();	
				} else {
					$('#quick_cart').trigger('click');
					SITE.custom_scroll.init();	
				}
			}
		},
		categoryMenu: {
			selector: '.sf-menu',
			init: function() {
				var base = this,
					container = $(base.selector),
					children = container.find('.menu-item-has-children');
							 
				children.each(function() {
					var _this = $(this),
							menu = _this.find('>.sub-menu:not(.thb_mega_submenu),>.thb_mega_holder'),
							h = 0,
							dropdown_offset_left = 0;

					_this.imagesLoaded( function() {
						h = menu.outerHeight();
					}).hoverIntent(
						function() {
							var dropdown_offset_left = _this.hasClass('menu-item-mega-parent') ? parseInt(_this.offset().left, 10) : 'inherit';
							_this.addClass('sfHover');
							TweenLite.fromTo(menu, 0.25, {height: 0, autoAlpha: 0}, {height: h, autoAlpha: 1, ease: thb_ease, onStart: function() { 
								menu.css({
									'left': -dropdown_offset_left,
									'display': 'block'
								}); 
							}, onComplete: function() {
								menu.css({
									'overflow': 'visible'
								});
							}});
						},
						function() {
							_this.removeClass('sfHover');
							TweenLite.fromTo(menu, 0.25, {height: h, autoAlpha: 1}, {height: 0, autoAlpha: 0, ease: thb_ease, onStart: function() { 							
								menu.css({
									'overflow': 'hidden'
								}); 
							}, onComplete: function() { 
								menu.hide(); 
							}});
						}
					);
				});
			}
		},
		carousel: {
			selector: '.slick',
			init: function(el) {
				var base = this,
					container = el ? el : $(base.selector);
				
				container.each(function() {
					var that = $(this),
						columns = that.data('columns'),
						navigation = (that.data('navigation') === true ? true : false),
						autoplay = (that.data('autoplay') === false ? false : true),
						pagination = (that.data('pagination') === true ? true : false),
						center = (that.data('center') ? that.data('center') : false),
						disablepadding = (that.data('disablepadding') ? that.data('disablepadding') : false),
						vertical = (that.data('vertical') === true ? true : false),
						asNavFor = that.data('asnavfor'),
						rtl = $('body').hasClass('rtl');
					
					var args = {
						dots: pagination,
						arrows: navigation,
						infinite: true,
						speed: 1000,
						centerMode: false,
						slidesToShow: columns,
						slidesToScroll: 1,
						rtl: rtl,
						autoplay: autoplay,
						centerPadding: (disablepadding ? 0 : '50px'),
						autoplaySpeed: 4000,
						pauseOnHover: true,
						vertical: vertical,
						verticalSwiping: vertical,
						focusOnSelect: true,
						prevArrow: '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="slick-nav thb-prev" x="0" y="0" width="50" height="40" viewBox="0 0 50 40" enable-background="new 0 0 50 40" xml:space="preserve"><path class="border" fill-rule="evenodd" clip-rule="evenodd" d="M0 0v40h50V0H0zM48 38H2V2h46V38z"/><path d="M15.3 19.2c0 0 0 0-0.1 0.1 0 0 0 0 0 0 0 0 0 0 0 0 -0.1 0.2-0.2 0.4-0.2 0.7 0 0.2 0.1 0.5 0.2 0.7 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0.1l3.8 3.9c0.4 0.4 1.1 0.4 1.5 0 0.4-0.4 0.4-1.1 0-1.6l-2-2h15.3c0.6 0 1.1-0.5 1.1-1.1 0-0.6-0.5-1.1-1.1-1.1H18.6l2-2c0.4-0.4 0.4-1.1 0-1.6 -0.4-0.4-1.1-0.4-1.5 0l-3.8 3.9C15.3 19.2 15.3 19.2 15.3 19.2z"/></svg>',
						nextArrow: '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="slick-nav thb-next" x="0" y="0" width="50" height="40" viewBox="0 0 50 40" enable-background="new 0 0 50 40" xml:space="preserve"><path class="border" fill-rule="evenodd" clip-rule="evenodd" d="M0 0v40h50V0H0zM2 2h46v36H2V2z"/><path d="M34.7 19.2L30.9 15.3c-0.4-0.4-1.1-0.4-1.5 0 -0.4 0.4-0.4 1.1 0 1.6l2 2H16.1c-0.6 0-1.1 0.5-1.1 1.1 0 0.6 0.5 1.1 1.1 1.1h15.3l-2 2c-0.4 0.4-0.4 1.1 0 1.6 0.4 0.4 1.1 0.4 1.5 0l3.8-3.9c0 0 0 0 0.1-0.1 0 0 0 0 0 0 0 0 0 0 0 0 0.1-0.2 0.2-0.4 0.2-0.7 0-0.2-0.1-0.5-0.2-0.7 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0-0.1-0.1C34.7 19.2 34.7 19.2 34.7 19.2z"/></svg>',
						responsive: [
							{
								breakpoint: 1440,
								settings: {
									slidesToShow: (columns < 6 ? columns : (vertical ? columns-1 :6)),
									centerPadding: (disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 1200,
								settings: {
									slidesToShow: (columns < 4 ? columns : (vertical ? columns-1 :4)),
									centerPadding: (disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 1025,
								settings: {
									slidesToShow: (columns < 3 ? columns : (vertical ? columns-1 :3)),
									centerPadding: (disablepadding ? 0 : '40px')
								}
							},
							{
								breakpoint: 780,
								settings: {
									slidesToShow: (columns < 2 ? columns : (vertical ? columns-1 :2)),
									centerPadding: (disablepadding ? 0 : '30px')
								}
							},
							{
								breakpoint: 640,
								settings: {
									slidesToShow: 1,
									centerPadding: (disablepadding ? 0 : '15px')
								}
							}
						]
					};
					if (asNavFor && $(asNavFor).is(':visible')) {
						args.asNavFor = asNavFor;	
					}
					if (that.data('fade')) {
						args.fade = true;
					}
					if ($('#infinitescroll').length > 0) {
						that.on('init', function(event, slick, currentSlide, nextSlide){
							if ($('#infinitescroll').data('isotope')) {
								$('#infinitescroll').isotope( 'layout' );
							}
							win.trigger('resize');
						});
					}
					if (that.hasClass('lookbook-container')) {
						args.variableWidth = true;	
					}
					that.slick(args).imagesLoaded(function() {
						that.slick('setPosition');
						win.trigger('resize');
					});
				});
			}
		},
		masonry: {
			selector: '.masonry',
			init: function() {
				var base = this,
				container = $(base.selector);
								
				container.each(function() {
					var _this = $(this);
					
					_this.imagesLoaded( function() {
						_this.isotope({
							itemSelector : '.item',
							transitionDuration : '0.5s',
							stagger: 150,
							layoutMode: 'packery',
							masonry: {
								columnWidth: '.item'
							},
							hiddenStyle: {
						    opacity: 0,
						    transform: 'translateY(30px)'
						  },
						  visibleStyle: {
						    opacity: 1,
						    transform: 'translateY(0px)'
						  }
						});
					});
				});
			}
		},
		grid: {
			selector: '.grid',
			init: function() {
				var base = this,
				container = $(base.selector);
								
				container.each(function() {
					var _this = $(this);
 
					_this.imagesLoaded( { background: true }, function() {
						_this.isotope({						
							itemSelector : '.item',
							transitionDuration : '0.5s',
							layoutMode: 'packery',
						});
					});
				});
			}
		},
		infiniteScroll: {
			selector: '#infinitescroll',
			init: function() {
				var base = this,
					container = $(base.selector),
					loading = container.data('loading'),
					nomore = container.data('nomore'),
					count = container.data('count'),
					total = container.data('total'),
					style = container.data('type'),
					page = 2;
				
				var scrollFunction = _.debounce(function(){
					if (win.scrollTop() >= $doc.height() - win.height() - 60) {
						win.off("scroll", scrollFunction);
						container.addClass('thb-loading');
						$.post( themeajax.url, { 
							action: 'thb_ajax',
							count : count,
							page : page,
							style : style
						}, function(data){
							
							var d = $.parseHTML(data),
									l = ($(d).length - 1) / 2;
							
							container.removeClass('thb-loading');
							win.on('scroll', scrollFunction);
									
							if (page > total) {
								win.off('scroll', scrollFunction);
								return false;
							} else {
								page++;
								$(d).appendTo(container).hide().imagesLoaded( function() {
									$(d).show();
									if (container.data('isotope')) {
										container.isotope( 'appended', $(d) );
										container.isotope( 'layout' );
									}
								});
							}
							
						});
					}
				}, 30);
				
				win.scroll(scrollFunction);
	
			}
		},
		shareArticleDetail: {
			selector: '#product_share',
			init: function() {
				var base = this,
						container = $(base.selector),
						social = container.find('.social');
						
				
				social.on('click', function() {
					var left = (screen.width/2)-(640/2),
							top = (screen.height/2)-(440/2)-100;
					window.open($(this).attr('href'), 'mywin', 'left='+left+',top='+top+',width=640,height=440,toolbar=0');
					return false;
				});
			}
		},
		accordion: {
			selector: '.accordion',
			init: function() {
				var base = this,
						container = $(base.selector);
						
				
				container.each(function() {
					var _this = $(this),
							active = ( !(_this.data('active-tab')) ? 1 : _this.data('active-tab'));
					
					_this.find('li').eq(active -1).addClass('active');
					
					_this.find('li').on('click', function () {
						var p = $(this).parent(),
								flyout = $(this).children('.content').first(),
								active = p.data('active');
					  $('.content', p).not(flyout).slideUp(400, 'linear', function() {
					  	$(this).parent('li').removeClass('active'); //changed this
					  });
					  flyout.slideDown({ 
					  	duration: '500',
					  	complete: function() {
					  		window.productscroll.refresh();
					  	}
					  }).parent('li').addClass('active');
					});
				});
			}
		},
		parallax_bg: {
			selector: 'div[role="main"]',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				if (!thb_md.mobile()) {
					$.stellar({
						horizontalScrolling: false,
						verticalOffset: 40
					});
				}
			}
		},
		custom_scroll: {
			selector: '.custom_scroll',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.each(function() {
					var _this = $(this);
					
					
					if ( _this.attr('id') !== 'product-information' || !thb_md.mobile() ) {
						var newScroll = new IScroll('#'+_this.attr('id'), {
							scrollbars: true,
							mouseWheel: true,
							click: _this.attr('id') === 'product-information'? false : true,
							shrinkScrollbars: 'scale'
						});
					
						if (_this.attr('id') === 'menu-scroll') {
							window.menuscroll = newScroll;	
						}
						if (_this.attr('id') === 'side-cart-scroll') {
							window.cartscroll = newScroll;	
						}
						if (_this.attr('id') === 'product-information') {
							window.productscroll = newScroll;	
						}
					}
				});		 
				
			}
		},
		wpml: {
			selector: '#thb_language_selector, #category-selection',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.on('change', function () {
				var url = $(this).val(); // get selected value
					if (url) { // require a URL
						window.location = url; // redirect
					}
					return false;
				});
			}
		},
		login_register: {
			selector: '#customer_login',
			init: function() {
				
				var create = $('#create-account'),
						login = $('#login-account');
				
				
				create.on('click', function() {
						login.removeClass('active');
						create.addClass('active');
						TweenMax.fromTo($('.login-container'), 0.2, {opacity:1, display:'block'}, {opacity:0,display:'none', onComplete: function() { 
								TweenMax.fromTo($('.register-container'), 0.2, {opacity:0, display:'none'}, {opacity:1,display:'block'});
							}
						});
						return false;
				});
				
				login.on('click', function() {
					create.removeClass('active');
					login.addClass('active');
						TweenMax.fromTo($('.register-container'), 0.2, {opacity:1, display:'block'}, {opacity:0,display:'none',
							onComplete: function() { 
								TweenMax.fromTo($('.login-container'), 0.2, {opacity:0, display:'none'}, {opacity:1,display:'block'});
							}	
						});
						return false;
				});
			}
		},
		shop: {
			selector: '.products .product',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var that = $(this);
					
					that
					.find('.add_to_cart_button').on('click', function() {
						if ($(this).data('added-text') !== '') {
							$(this).text($(this).data('added-text'));
						}
					});
					
				}); // each
	
			}
		},
		variations: {
			selector: '.variations_form input[name=variation_id]',
			init: function() {
				var base = this,
					container = $(base.selector),
					org = $('[itemprop="offers"] .price').html();
				
				container.on('change', function() {
					var that = $(this),
						val = that.val(),
						phtml,
						images = $('#product-images');

					setTimeout(function(){
						if (val) {
							phtml = that.parents('.variations_form').find('.single_variation span.price').html();
						} else {
							phtml = org;	
						}
						$('[itemprop="offers"] .price').html(phtml);
					}, 100);
					
					if ($('.variations_form').length) {
						var variations = [],
								values;
						
						$('.variations_form').find('select').each(function(){
							variations.push(this.value);
						});
						values = variations.join(",");
						if ($('.variations_form').find('select').length) {
							var v = ($('.variations_form select option:selected').val()),
									i = images.find('figure[data-variation*="'+values+'"]').data('slick-index');

							if (v) {
								images.slick('slickGoTo', i);
							}
						}
					}
				});
			}
		},
		quantity: {
			selector: '.quantity',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				// Quantity buttons
				$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
				$('.plus, .minus').on('click', function() {
					// Get values
					var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
						currentVal	= parseFloat( $qty.val() ),
						max			= parseFloat( $qty.attr( 'max' ) ),
						min			= parseFloat( $qty.attr( 'min' ) ),
						step		= $qty.attr( 'step' );
			
					// Format values
					if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) { currentVal = 0; }
					if ( max === '' || max === 'NaN' ) { max = ''; }
					if ( min === '' || min === 'NaN' ) { min = 0; }
					if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) { step = 1; }
			
					// Change the value
					if ( $( this ).is( '.plus' ) ) {
			
						if ( max && ( max === currentVal || currentVal > max ) ) {
							$qty.val( max );
						} else {
							$qty.val( currentVal + parseFloat( step ) );
						}
			
					} else {
			
						if ( min && ( min === currentVal || currentVal < min ) ) {
							$qty.val( min );
						} else if ( currentVal > 0 ) {
							$qty.val( currentVal - parseFloat( step ) );
						}
			
					}
			
					// Trigger change event
					$qty.trigger( 'change' );
					return false;
				});
			}	
		},
		reviews: {
			selector: '#comment_popup',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.on( 'click', 'p.stars a', function(){
					var that = $(this);
					
					setTimeout(function(){ that.prevAll().addClass('active'); }, 10);
				});
			}
		},
		checkout: {
			selector: '.woocommerce-checkout',
			init: function() {
				$('#shippingsteps a').on('click', function() {
					var that = $(this),
							target = (that.data('target') ? $('#'+that.data('target')) : false);

					if (target) {
						$('#shippingsteps li').removeClass('active');
						that.parents('li').addClass('active');
						$('.section').hide();
						target.show();
						SITE.magnificInline.init();
					}
					$('body').trigger( 'country_to_state_changed');
					return false;
				});

				$('.continue_shipping').on('click', function() {
					$('#shippingsteps a').eq(1).trigger('click');
					
					return false;
				});
				$('#ship-to-different-address-checkbox').on('change', function() {
					$('.shipping_address').slideToggle('slow', function() {
						if($('.shipping_address').is(':hidden')) {
							$('form.checkout .shipping_address').find('p.form-row').removeClass('woocommerce-invalid-required-field, woocommerce-invalid');
						}
						$('body').trigger( 'country_to_state_changed');
					});
					
					return false;
				});

			}
		},

		magnificImage: {
			selector: '[rel="magnific"], .wp-caption a',
			init: function() {
				var base = this,
						container = $(base.selector),
						stype;
				
				container.each(function() {
					if ($(this).hasClass('video')) {
						stype = 'iframe';
					} else {
						stype = 'image';
					}
					$(this).magnificPopup({
						type: stype,
						closeOnContentClick: true,
						fixedContentPos: true,
						closeBtnInside: false,
						closeMarkup: '<button title="%title%" class="mfp-close"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="12" height="12" viewBox="1.1 1.1 12 12" enable-background="new 1.1 1.1 12 12" xml:space="preserve"><path d="M8.3 7.1l4.6-4.6c0.3-0.3 0.3-0.8 0-1.2 -0.3-0.3-0.8-0.3-1.2 0L7.1 5.9 2.5 1.3c-0.3-0.3-0.8-0.3-1.2 0 -0.3 0.3-0.3 0.8 0 1.2L5.9 7.1l-4.6 4.6c-0.3 0.3-0.3 0.8 0 1.2s0.8 0.3 1.2 0L7.1 8.3l4.6 4.6c0.3 0.3 0.8 0.3 1.2 0 0.3-0.3 0.3-0.8 0-1.2L8.3 7.1z"/></svg></button>',
						mainClass: 'mfp',
						removalDelay: 250,
						overflowY: 'scroll',
						image: {
							verticalFit: false
						}
					});
				});
	
			}
		},
		magnificInline: {
			selector: '[rel="inline"]',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var _this = $(this), 
							eclass = (_this.data('class') ? _this.data('class') : '');

					_this.magnificPopup({
						type:'inline',
						midClick: true,
						mainClass: 'mfp ' + eclass,
						removalDelay: 250,
						closeBtnInside: true,
						overflowY: 'scroll',
						closeMarkup: '<button title="%title%" class="mfp-close"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="12" height="12" viewBox="1.1 1.1 12 12" enable-background="new 1.1 1.1 12 12" xml:space="preserve"><path d="M8.3 7.1l4.6-4.6c0.3-0.3 0.3-0.8 0-1.2 -0.3-0.3-0.8-0.3-1.2 0L7.1 5.9 2.5 1.3c-0.3-0.3-0.8-0.3-1.2 0 -0.3 0.3-0.3 0.8 0 1.2L5.9 7.1l-4.6 4.6c-0.3 0.3-0.3 0.8 0 1.2s0.8 0.3 1.2 0L7.1 8.3l4.6 4.6c0.3 0.3 0.8 0.3 1.2 0 0.3-0.3 0.3-0.8 0-1.2L8.3 7.1z"/></svg></button>',
						callbacks: {
							open: function() {
								var that = this;
								if (eclass === 'quick-search') {
									setTimeout(function(){ 
										$(that.content[0]).find('.s').focus(); 
									}, 0);
								}
							}
						}
					});
				});
	
			}
		},
		magnificGallery: {
			selector: '[rel="gallery"]',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					$(this).magnificPopup({
						delegate: 'a',
						type: 'image',
						closeOnContentClick: true,
						fixedContentPos: true,
						mainClass: 'mfp',
						removalDelay: 250,
						closeMarkup: '<button title="%title%" class="mfp-close"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="12" height="12" viewBox="1.1 1.1 12 12" enable-background="new 1.1 1.1 12 12" xml:space="preserve"><path d="M8.3 7.1l4.6-4.6c0.3-0.3 0.3-0.8 0-1.2 -0.3-0.3-0.8-0.3-1.2 0L7.1 5.9 2.5 1.3c-0.3-0.3-0.8-0.3-1.2 0 -0.3 0.3-0.3 0.8 0 1.2L5.9 7.1l-4.6 4.6c-0.3 0.3-0.3 0.8 0 1.2s0.8 0.3 1.2 0L7.1 8.3l4.6 4.6c0.3 0.3 0.8 0.3 1.2 0 0.3-0.3 0.3-0.8 0-1.2L8.3 7.1z"/></svg></button>',
						closeBtnInside: false,
						overflowY: 'scroll',
						gallery: {
							enabled: true,
							navigateByImgClick: false,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						},
						image: {
							verticalFit: false,
							titleSrc: function(item) {
								return item.el.attr('title');
							}
						}
					});
				});
				
			}
		},
		magnificAuto: {
			selector: '[rel="inline-auto"]',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				
				container.each(function() {
					var _this = $(this),
							eclass = (_this.data('class') ? _this.data('class') : ''),
							target = '#'+ _this.attr('id');
					$.magnificPopup.open({
						type:'inline',
						items: {
							src: target,
							type: 'inline'
						},
						midClick: true,
						mainClass: 'mfp ' + eclass,
						removalDelay: 250,
						closeBtnInside: true,
						overflowY: 'scroll',
						closeMarkup: '<button title="%title%" class="mfp-close"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="12" height="12" viewBox="1.1 1.1 12 12" enable-background="new 1.1 1.1 12 12" xml:space="preserve"><path d="M8.3 7.1l4.6-4.6c0.3-0.3 0.3-0.8 0-1.2 -0.3-0.3-0.8-0.3-1.2 0L7.1 5.9 2.5 1.3c-0.3-0.3-0.8-0.3-1.2 0 -0.3 0.3-0.3 0.8 0 1.2L5.9 7.1l-4.6 4.6c-0.3 0.3-0.3 0.8 0 1.2s0.8 0.3 1.2 0L7.1 8.3l4.6 4.6c0.3 0.3 0.8 0.3 1.2 0 0.3-0.3 0.3-0.8 0-1.2L8.3 7.1z"/></svg></button>',
					});
				});
				
			}
		},
		newsletterForm: {
			selector: '#newsletter-form',
			init: function() {
				var base = this,
						container = $(base.selector),
						url = container.data('target');
				
				container.submit(function() {
					container.find('.result').load(url, {email: $('#widget_subscribe').val()},
					function() {
						$(this).fadeIn(200).delay(3000).fadeOut(200);
					});
					return false;
				});
				
			}
		},
		easyZoom: {
			selector: '.easyzoom',
			init: function() {
				var base = this,
					container = $(base.selector);
					
				if (!thb_md.mobile()) {
					container.easyZoom(); 
				}
			}
		},
		shopSidebar: {
			selector: '.woo.sidebar .widget.woocommerce',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.each(function() {
					var that = $(this),
							t = that.find('>h6');
					
					t.append($('<span/>')).on('click', function() {
						t.toggleClass('active');
						t.next().animate({
							height: "toggle",
							opacity: "toggle"
						}, 300);
					});
				});
			}
		},
		page_scroll: {
			selector: '.page_scroll',
			init: function() {
				var base = this,
						container = $(base.selector),
						nav = $('.header nav'),
						offset = $('.header.style1').outerHeight();
				
				nav.onePageNav({
					currentClass: 'current-menu-item',
					changeHash: false,
					topOffset: offset,
					scrollSpeed: 750
				});
			}	
		},
		colorCheck: {
			selector: '.header',
			check: function() {
				var container = $('.header'),
						body = $('body'),
						pagi = $('#fp-nav ul');
						
				_.defer(function() {
					if (container.hasClass("background--light")) {
						body.addClass("background--light").removeClass("background--dark");
					} else if (container.hasClass("background--dark")) {
						body.addClass("background--dark").removeClass("background--light");
					} else {
						body.removeClass("background--dark background--light");
					}
				});
			}
		},
		revslider: {
			selector: '#home-slider',
			init: function() {
				var base = this,
						container = $(base.selector),
						id = $('body').data('revslider'),
						revid = "revapi" + id,
						node;
				
				if (id) {
					window[revid].bind("revolution.slide.onloaded",function (e) {
						BackgroundCheck.init({
							targets: '.header',
							images: '.tp-bgimg',
							minComplexity: 80,
							maxDuration: 1500,
							minOverlap: 0
						});
						_.delay(SITE.colorCheck.check, 10);
					});
					window[revid].bind("revolution.slide.onchange",function (e,data) {
						node = '.rev_slider ul li:nth-child('+data.slideIndex+') .tp-bgimg';
					});
					window[revid].bind("revolution.slide.onafterswap",function (e,data) {
						BackgroundCheck.set('images', node);
						BackgroundCheck.refresh();
						_.delay(SITE.colorCheck.check, 10);
					});
					container.find('.thb-arrow').each(function(){
						var _that = $(this),
								cursor_area = _that.parents('.thb-cursor-area');
						
						container.bind('mousemove', function(e){
							var offset = cursor_area.offset(),
									mouseX = Math.min(e.pageX - offset.left, cursor_area.width()),
									mouseY = e.pageY - offset.top;
							if (mouseX < 0) { mouseX = 0; }
							if (mouseY < 0) { mouseY = 0; }

							TweenMax.set(_that, {x:mouseX -25, y:mouseY -20, force3D:true});

						});
						cursor_area.on('click', function() {
							if (cursor_area.hasClass('left')) {
								window[revid].revprev();
							} else {
								window[revid].revnext();
							} 
						});
					});
				}
			}
		},
		snap_scroll: {
			selector: '.snap_scroll_on [role="main"]',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				container.imagesLoaded( { background: true }, function() {
					container
						.fullpage({
							//Navigation
							menu: '#menu',
							lockAnchors: false,
							anchors:[],
							navigation: true,
							navigationPosition: 'right',
							slidesNavigation: true,
							slidesNavPosition: 'bottom',
							
							//Scrolling
							scrollingSpeed: 700,
							autoScrolling: true,
							fitToSection: true,
							fitToSectionDelay: 1000,
							scrollBar: false,
							easing: 'easeInOutCubic',
							easingcss3: 'ease',
							loopHorizontal: false,
							continuousVertical: false,
							
							//Accessibility
							keyboardScrolling: true,
							animateAnchor: true,
							recordHistory: false,
							
							//Design
							verticalCentered: false,
							responsiveWidth: '1024',
							
							//Custom selectors
							sectionSelector: '.wpb_row:not(".vc_inner")',
							
							//events
							afterLoad: function(anchorLink, index){
								BackgroundCheck.refresh();
								
								SITE.animation.control();
								SITE.colorCheck.check();
							},
							afterRender: function(){
								$('body').addClass('onepage-loaded');
								BackgroundCheck.init({
									targets: '.header',
									images: '.snap_scroll_on .fp-section',
									minComplexity: 80,
									maxDuration: 1250,
									threshold: 50,
									minOverlap: 10
								});
								SITE.animation.control();
								
								_.delay(SITE.colorCheck.check, 500);
							}
					});
				});
				
			}
		},
		contact: {
			selector: '.contact_map',
			init: function() {
				var base = this,
					container = $(base.selector);
				
				container.each(function() {
					var that = $(this),
						mapzoom = that.data('map-zoom'),
						maplat = that.data('map-center-lat'),
						maplong = that.data('map-center-long'),
						pinlatlong = that.data('latlong'),
						pinimage = that.data('pin-image'),
						style = that.data('map-style'),
						mapstyle;
						
						switch(style) {
							case 0:
								break;
							case 1:
								mapstyle = [{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]},{},{"featureType":"road.highway","stylers":[{"weight":0.6},{"saturation":-85},{"lightness":61}]},{"featureType":"road"},{},{"featureType":"landscape","stylers":[{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]}];
								break;
							case 2:
								mapstyle = [{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]}];
								break;
							case 3:
								mapstyle = [{"featureType":"poi","stylers":[{"visibility":"off"}]},{"stylers":[{"saturation":-70},{"lightness":37},{"gamma":1.15}]},{"elementType":"labels","stylers":[{"gamma":0.26},{"visibility":"off"}]},{"featureType":"road","stylers":[{"lightness":0},{"saturation":0},{"hue":"#ffffff"},{"gamma":0}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"lightness":50},{"saturation":0},{"hue":"#ffffff"}]},{"featureType":"administrative.province","stylers":[{"visibility":"on"},{"lightness":-50}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":20}]}];
								break;
							case 4:
								mapstyle = [{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}];
								break;
							case 5:
								mapstyle = [{"featureType":"landscape","stylers":[{"hue":"#F1FF00"},{"saturation":-27.4},{"lightness":9.4},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#0099FF"},{"saturation":-20},{"lightness":36.4},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#00FF4F"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FFB300"},{"saturation":-38},{"lightness":11.2},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#00B6FF"},{"saturation":4.2},{"lightness":-63.4},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#9FFF00"},{"saturation":0},{"lightness":0},{"gamma":1}]}];
								break;
							case 6:
								mapstyle = [{"stylers":[{"hue":"#2c3e50"},{"saturation":250}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":50},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]}];
								break;
							case 7:
								mapstyle = [{"stylers":[{"hue":"#16a085"},{"saturation":0}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]}];
								break;
						}
					
					var centerlatLng = new google.maps.LatLng(maplat,maplong);
					
					var mapOptions = {
						center: centerlatLng,
						styles: mapstyle,
						zoom: mapzoom,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						scrollwheel: false,
						panControl: false,
						zoomControl: false,
						mapTypeControl: false,
						scaleControl: false,
						streetViewControl: false
					};
					
					var map = new google.maps.Map(document.getElementById("contact-map"), mapOptions);
					
					google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
						if(pinimage.length > 0) {
							var pinimageLoad = new Image();
							pinimageLoad.src = pinimage;
							
							$(pinimageLoad).load(function(){
								base.setMarkers(map, pinlatlong, pinimage);
							});
						}
						else {
							base.setMarkers(map, pinlatlong, pinimage);
						}
					});
				});
			},
			setMarkers: function(map, pinlatlong, pinimage) {
				var infoWindows = [];
				
				function showPin (i) {
					var latlong_array = pinlatlong[i].lat_long.split(','),
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(latlong_array[0],latlong_array[1]),
							map: map,
							animation: google.maps.Animation.DROP,
							icon: pinimage,
							optimized: false
						}),
						contentString = '<div class="marker-info-win">'+
						'<img src="'+pinlatlong[i].image+'" class="image" />' +
						'<div class="marker-inner-win">'+
						'<h1 class="marker-heading">'+pinlatlong[i].title+'</h1>'+
						'<p>'+pinlatlong[i].information+'</p>'+ 
						'</div></div>';
					
					// info windows 
					var infowindow = new InfoBox({
							alignBottom: true,
							content: contentString,
							disableAutoPan: false,
							maxWidth: 380,
							closeBoxMargin: "10px 10px 10px 10px",
							closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
							pixelOffset: new google.maps.Size(-195, -43),
							zIndex: null,
							infoBoxClearance: new google.maps.Size(1, 1)
					});
					infoWindows.push(infowindow);
					
					google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
							infoWindows[i].open(map, this);
						};
					})(marker, i));
				}
				
				for (var i = 0; i + 1 <= pinlatlong.length; i++) {  
					setTimeout(showPin, i * 250, i);
				}
			}
		},
		footerProducts: {
			selector: '#footer',
			init: function() {
				var base = this,
					container = $(base.selector),
					footer = $('#footer'),
					wrapper = $('#wrapper'),
					cc = $('.click-capture'),
					products = $('#footer_products'),
					section = products.find('.carousel-container'),
					links = $('#footer_tabs').find('a');
				
				$('#footer-toggle').on('click', function() {
					footer.toggleClass('active');
					wrapper.toggleClass('open-footer');
					return false;
				});
				
				links.on('click', function() {
					var that = $(this),
						type = that.data('type');
					
					if (!that.hasClass('active')) {
						links.removeClass('active');
						that.addClass('active');
						section.addClass('loading').height(section.outerHeight());
						
						$.post( themeajax.url, { 
						
								action: 'thb_product_ajax',
								type : type
								
						}, function(data){
							
							var d = $.parseHTML(data);
							
							$(d).imagesLoaded( function() {
								section.html(d);
								SITE.carousel.init();
								section.removeClass('loading');
							});
							
							
						});
					}
					return false;
				});
				
				cc.on('click', function() {
					wrapper.removeClass('open-footer');
					footer.removeClass('active');
				});
			}
		},
		animation: {
			selector: '#content-container .animation',
			init: function() {
				var base = this,
						container = $(base.selector);
				
				base.control(container);
				
				win.scroll(function(){
					base.control(container);
				});
			},
			control: function(element) {
				var t = -1,
					snap = $(SITE.snap_scroll.selector);
				
				if (snap.length > 0) {
					snap.find('.fp-section.active').find('.animation').each(function () {

						var that = $(this);
							t++;
						setTimeout(function () {
							that.addClass("animate");
						}, 200 * t);
					});
				} else {
					element.filter(':in-viewport').each(function () {
						var that = $(this);
								t++;
						
						setTimeout(function () {
							that.addClass("animate");
						}, 200 * t);
						
					});
				}
			}
		}
	};
	
	$doc.ready(function() {
		SITE.init();
	});

})(jQuery, this, _);