// US g-alert
(function ($) {
	"use strict";

	$.fn.gAlert = function () {

		return this.each(function () {
			var alert = $(this),
				alertClose = alert.find('.g-alert-close');

			if (alertClose) {
				alertClose.click(function(){
					alert.animate({ height: '0', margin: 0}, 400, function(){
						alert.css('display', 'none');
						$(window).resize();
					});
				});
			}
		});
	};
})(jQuery);

jQuery(document).ready(function() {
	"use strict";

	jQuery('.g-alert').gAlert();
});

// US w-tabs
(function ($) {
	"use strict";

	$.fn.wTabs = function () {


		return this.each(function () {
			var tabs = $(this),
				itemsList = tabs.find('.w-tabs-list'),
				items = tabs.find('.w-tabs-item'),
				sections = tabs.find('.w-tabs-section'),
				resizeTimer = null,
				itemsWidth = 0,
				running = false,
				firstActiveItem = tabs.find('.w-tabs-item.active').first(),
				firstActiveSection = tabs.find('.w-tabs-section.active').first(),
				activeIndex = null;

			if (itemsList.length) {
				var itemsCount = itemsList.find('.w-tabs-item').length;
				if (itemsCount) {
					itemsList.addClass('items_'+itemsCount);
				}
			}

			if ( ! tabs.hasClass('layout_accordion')) {
				if ( ! firstActiveSection.length) {
					firstActiveItem = tabs.find('.w-tabs-item').first();
					firstActiveSection = tabs.find('.w-tabs-section').first();
				}

				tabs.find('.w-tabs-item.active').removeClass('active');
				tabs.find('.w-tabs-section.active').removeClass('active');

				firstActiveItem.addClass('active');
				firstActiveSection.addClass('active');

			} else {
				$(sections).each(function(sectionIndex, section) {
					if ($(section).hasClass('active')) {
						activeIndex = sectionIndex;
					}
				});
			}


			items.each(function(){
				itemsWidth += $(this).outerWidth(true);
			});

			function tabs_resize(){
				if ( ! (tabs.hasClass('layout_accordion') && ! tabs.data('accordionLayoutDynamic'))) {
					if (jQuery(window).width() < 768) {
						tabs.data('accordionLayoutDynamic', true);
						if ( ! tabs.hasClass('layout_accordion')) {
							tabs.addClass('layout_accordion');
						}
					} else {
						if (tabs.hasClass('layout_accordion')) {
							tabs.removeClass('layout_accordion');
						}
					}
				}
			}

			tabs_resize();

			$(window).resize(function(){
				window.clearTimeout(resizeTimer);
				resizeTimer = window.setTimeout(function(){
					tabs_resize();
				}, 50);

			});

			sections.each(function(index){
				var item = $(items[index]),
					section = $(sections[index]),
					section_title = section.find('.w-tabs-section-header'),
					section_content = section.find('.w-tabs-section-content');

				if (section.hasClass('active')) {
					section_content.slideDown();
				}

				section_title.click(function(){
					var currentHeight = 0;

					if (tabs.hasClass('type_toggle')) {
						if ( ! running) {
							if (section.hasClass('active')) {
								running = true;
								if (item) {
									item.removeClass('active');
								}
								section_content.slideUp(null, function(){
									section.removeClass('active');
									running = false;
									$(window).resize();
								});
							} else {
								running = true;
								if (item) {
									item.addClass('active');
								}
								section_content.slideDown(null, function(){
									section.addClass('active');
									running = false;
									section.find('.w-map').each(function(map){
										var mapObj = jQuery(this).data('gMap.reference'),
											center = mapObj.getCenter();

										google.maps.event.trigger(jQuery(this)[0], 'resize');
										if (jQuery(this).data('gMap.infoWindows').length) {
											jQuery(this).data('gMap.infoWindows')[0].open(mapObj, jQuery(this).data('gMap.overlays')[0]);
										}
										mapObj.setCenter(center);
									});
									$(window).resize();
								});
							}
						}


					} else if (( ! section.hasClass('active')) && ( ! running)) {
						running = true;
						items.each(function(){
							if ($(this).hasClass('active')) {
								$(this).removeClass('active');
							}
						});
						if (item) {
							item.addClass('active');
						}

						sections.each(function(){
							if ($(this).hasClass('active')) {
								currentHeight = $(this).find('.w-tabs-section-content').height();
								if ( ! tabs.hasClass('layout_accordion')) {
									tabs.css({'height': tabs.height(), 'overflow': 'hidden'});
									setTimeout(function(){ tabs.css({'height': '', 'overflow': ''}); }, 300);
								}
								$(this).find('.w-tabs-section-content').slideUp();
							}
						});



						section_content.slideDown(null, function(){
							sections.each(function(){
								if ($(this).hasClass('active')) {
									$(this).removeClass('active');
								}
							});
							section.addClass('active');
							activeIndex = index;

							if (tabs.hasClass('layout_accordion')) {
								jQuery("html, body").animate({
									scrollTop: section.offset().top-(window.headerHeight-1)+"px"
								}, {
									duration: 1200,
									easing: "easeInOutQuint"
								});
							}

							running = false;
							section.find('.w-map').each(function(map){
								var mapObj = jQuery(this).data('gMap.reference'),
									center = mapObj.getCenter();

								google.maps.event.trigger(jQuery(this)[0], 'resize');
								if (jQuery(this).data('gMap.infoWindows').length) {
									jQuery(this).data('gMap.infoWindows')[0].open(mapObj, jQuery(this).data('gMap.overlays')[0]);
								}
								mapObj.setCenter(center);
							});

							$(window).resize();
						});



					}

				});

				if (item)
				{
					item.click(function(){
						section_title.click();
					});
				}


			});

		});
	};
})(jQuery);

jQuery(document).ready(function() {
	"use strict";

	jQuery('.w-tabs').wTabs();
});

// US w-portfolio
(function ($) {
	"use strict";

	$.fn.wPortfolio = function () {

		return this.each(function () {
			var portfolio = $(this),
				items = portfolio.find('.w-portfolio-item'),
				running = false,
				activeIndex,
				details = $('<div class="l-portfolio"></div>').appendTo('body'),
				detailsLoading = $('<div class="l-portfolio-loading"><div class="w-preloader'+window.preloaderType+'"><div class="w-preloader-h"></div></div></div>').appendTo(details),
				detailsContent = $('<div class="l-portfolio-content g-html i-cf"></div>').appendTo(details),
				detailsControls = $('<div class="l-portfolio-controls">').appendTo(details),
				detailsPrev = $('<div class="l-portfolio-arrow to_prev"><i class="fa fa-angle-left"></i></div>').appendTo(detailsControls),
				detailsNext = $('<div class="l-portfolio-arrow to_next"><i class="fa fa-angle-right"></i></div>').appendTo(detailsControls),
				detailsClose = $('<div class="l-portfolio-close"><span>&#10005</span></div>').appendTo(detailsControls);

			detailsClose.click(function(){

				$('body').removeClass('display_portfolio');
				$('body').addClass('close_portfolio');
				window.setTimeout(function(){
					$('body').removeClass('close_portfolio');
					details.removeClass('show');
				}, 500);
				var activeItem = portfolio.find('.w-portfolio-item.active');
				activeItem.removeClass('active');
			});

			detailsNext.click(function(){

			});

			items.each(function(itemIndex, item){
				var anchor = $(item).find('.w-portfolio-item-anchor'),
//					detailsContentHTML = $('<div class="w-portfolio-hidden-content" style="display:none"></div>').appendTo(item),
					nextItem = $(item).next(),
					prevItem = $(item).prev();


				anchor.click(function(){
					if (( ! $(item).hasClass('active')) && ( ! anchor.hasClass('external-link')) && ( ! running)){
						running = true;

						detailsContent.removeClass('show');
						details.addClass('show');

						if (nextItem.length) {
							detailsNext.removeClass('disabled');
							detailsNext.off('click').click(function(){
								nextItem.find('.w-portfolio-item-anchor').click();
							});
						} else {
							detailsNext.addClass('disabled');
						}

						if (prevItem.length) {
							detailsPrev.removeClass('disabled');
							detailsPrev.off('click').click(function(){
								prevItem.find('.w-portfolio-item-anchor').click();
							});
						} else {
							detailsPrev.addClass('disabled');
						}

						if ($('body').hasClass('display_portfolio')) {

							detailsLoading.addClass('show');
							$.ajax({
								type: "POST",
								url: window.ajaxURL,
								data: {
									action: "usAjaxPortfolio",
									project_id: anchor.data('id')
								},
								success: function(data, textStatus, XMLHttpRequest){
									detailsLoading.removeClass('show');
									var activeItem = portfolio.find('.w-portfolio-item.active');
									activeItem.removeClass('active');

									detailsContent.html(data);

									detailsContent.addClass('show');
									detailsControls.addClass('show');

									/* re-init js plugins */
									var settings = {};

									if ( typeof _wpmejsSettings !== 'undefined' ) {
										settings.pluginPath = _wpmejsSettings.pluginPath;
									}

									settings.success = function (mejs) {
										var autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
										if ( 'flash' === mejs.pluginType && autoplay ) {
											mejs.addEventListener( 'canplay', function () {
												mejs.play();
											}, false );
										}
									};

									detailsContent.find('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer( settings );

									detailsContent.find('.w-gallery').magnificPopup(window.magnificPopupGalleryOptions);

									detailsContent.find('.w-tabs').wTabs();

									detailsContent.find('.w-counter').waypoint(window.counterFunction, window.counterOptions);
									if (jQuery.wpcf7InitForm)
									{
										detailsContent.find('div.wpcf7 > form').find('img.ajax-loader').remove();
										detailsContent.find('div.wpcf7 > form').wpcf7InitForm();
									}


									detailsContent.find(".w-gallery.type_slider .slides").each(function() {
										var slider = jQuery(this),
											arrows = slider.attr('data-arrows'),
											autoPlay = slider.attr('data-autoPlay'),
											autoPlaySpeed = slider.attr('data-autoPlaySpeed');
										if (autoPlay == 1) {
											autoPlay = true;
										} else {
											autoPlay = false;
										}
										if (arrows == 1) {
											arrows = true;
										} else {
											arrows = false;
										}
										slider.slick({
											arrows: arrows,
											dots: true,
											infinite: true,
											speed: 300,
											cssEase: 'linear',
											autoplay: true,
											autoplaySpeed: 3000
										});
									});

									/* end re-init js plugins */

									$(item).addClass('active');
									activeIndex = itemIndex;
									running = false;
								},
								error: function(MLHttpRequest, textStatus, errorThrown){
									detailsLoading.hide();

								}
							});


							return;
						}


						detailsControls.removeClass('show');
						$('body').addClass('open_portfolio');
						window.setTimeout(function(){
							$('body').removeClass('open_portfolio');
							$('body').addClass('display_portfolio');


							detailsLoading.addClass('show');
							$.ajax({
								type: "POST",
								url: window.ajaxURL,
								data: {
									action: "usAjaxPortfolio",
									project_id: anchor.data('id')
								},
								success: function(data, textStatus, XMLHttpRequest){
									detailsLoading.removeClass('show');
//                                    detailsContentHTML.html(data);
									var activeItem = portfolio.find('.w-portfolio-item.active');
									activeItem.removeClass('active');

									detailsContent.html(data);

									detailsContent.addClass('show');
									detailsControls.addClass('show');

									/* re-init js plugins */
									var settings = {};

									if ( typeof _wpmejsSettings !== 'undefined' ) {
										settings.pluginPath = _wpmejsSettings.pluginPath;
									}

									settings.success = function (mejs) {
										var autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
										if ( 'flash' === mejs.pluginType && autoplay ) {
											mejs.addEventListener( 'canplay', function () {
												mejs.play();
											}, false );
										}
									};

									detailsContent.find('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer( settings );

									detailsContent.find('.w-gallery').magnificPopup(window.magnificPopupGalleryOptions);

									detailsContent.find('.w-tabs').wTabs();

									detailsContent.find('.w-counter').waypoint(window.counterFunction, window.counterOptions);

									detailsContent.find(".w-gallery.type_slider .slides").each(function() {
										var slider = jQuery(this),
											arrows = slider.attr('data-arrows'),
											autoPlay = slider.attr('data-autoPlay'),
											autoPlaySpeed = slider.attr('data-autoPlaySpeed');
										if (autoPlay == 1) {
											autoPlay = true;
										} else {
											autoPlay = false;
										}
										if (arrows == 1) {
											arrows = true;
										} else {
											arrows = false;
										}
										slider.slick({
											arrows: arrows,
											dots: true,
											infinite: true,
											speed: 300,
											cssEase: 'linear',
											autoplay: true,
											autoplaySpeed: 3000
										});
									});

									/* end re-init js plugins */

									$(item).addClass('active');
									activeIndex = itemIndex;
									running = false;
								},
								error: function(MLHttpRequest, textStatus, errorThrown){
									detailsLoading.hide();

								}
							});

						}, 500);

					}
				});

			});
		});
	};
})(jQuery);

jQuery(document).ready(function() {
	"use strict";

	jQuery('.w-portfolio').wPortfolio();
});
