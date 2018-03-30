(function($) {
	'use strict';

	var portfolio = {};
	mkd.modules.portfolio = portfolio;

	portfolio.mkdOnDocumentReady = mkdOnDocumentReady;
	portfolio.mkdOnWindowLoad = mkdOnWindowLoad;
	portfolio.mkdOnWindowResize = mkdOnWindowResize;
	portfolio.mkdOnWindowScroll = mkdOnWindowScroll;

	portfolio.mkdPortfolioSingleMasonryImages = mkdPortfolioSingleMasonryImages;

	$(document).ready(mkdOnDocumentReady);
	$(window).load(mkdOnWindowLoad);
	$(window).resize(mkdOnWindowResize);
	$(window).scroll(mkdOnWindowScroll);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdOnDocumentReady() {
		portfolio.mkdPortfolioSlider();
	}

	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdOnWindowLoad() {
		mkdPortfolioSingleMasonryImages().init();
		mkdPortfolioSingleFollow().init();
	}

	/*
	 All functions to be called on $(window).resize() should be in this function
	 */
	function mkdOnWindowResize() {

	}

	/*
	 All functions to be called on $(window).scroll() should be in this function
	 */
	function mkdOnWindowScroll() {

	}

	portfolio.mkdPortfolioSlider = function() {
		var sliders = $('.mkd-portfolio-slider-holder');
		if(sliders.length) {
			sliders.each(function() {
				var slider = $(this).find('.mkd-portfolio-slider-list');
				var numberOfItems = slider.data('columns');
				var autoPlay = slider.data('enable-autoplay');
				var pagination = slider.data('enable-pagination');

				slider.waitForImages(function() {
					slider.css('visibility', 'visible');
				});

				if(!slider.hasClass('owl-carousel')) {
					slider.addClass('owl-carousel');
				}


				if(pagination !== undefined) {
					if(pagination == 'yes') {
						pagination = true;
					} else {
						pagination = false;
					}
				}

				if(autoPlay !== undefined) {
					if(autoPlay == 'yes') {
						autoPlay = true;
					} else {
						autoPlay = false;
					}
				}

				slider.owlCarousel({
					responsive: {
						0: {
							items: 1,
						},
						768: {
							items: 2,
						},
						1024: {
							items: numberOfItems - 1,
						},
						1280: {
							items: numberOfItems,
						}
					},
					items: numberOfItems,
					autoHeight: true,
					autoplay: autoPlay,
					autoplayTimeout: 3000,
					autoplayHoverPause: true,
					loop: true,
					nav: false,
					dots: pagination,
					smartSpeed: 400,
				});

			});
		}
	};


	var mkdPortfolioSingleFollow = function() {

		var info = $('.mkd-follow-portfolio-info .small-images.mkd-portfolio-single-holder .mkd-portfolio-info-holder, ' +
			'.mkd-follow-portfolio-info .small-slider.mkd-portfolio-single-holder .mkd-portfolio-info-holder');

		if(info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.mkd-portfolio-media'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .mkd-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0;
		}

		var infoHolderPosition = function() {

			if(info.length) {

				if(mediaHolderHeight > infoHolderHeight) {
					if(mkd.scroll > infoHolderOffset) {
						info.animate({
							marginTop: (mkd.scroll - (infoHolderOffset) + mkdGlobalVars.vars.mkdAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
						});
					}
				}

			}
		};

		var recalculateInfoHolderPosition = function() {

			if(info.length) {
				if(mediaHolderHeight > infoHolderHeight) {
					if(mkd.scroll > infoHolderOffset) {

						if(mkd.scroll + headerHeight + mkdGlobalVars.vars.mkdAddForAdminBar + infoHolderHeight + 20 < infoHolderOffset + mediaHolderHeight) {    //20 px is for styling, spacing between header and info holder

							//Calculate header height if header appears
							if($('.header-appear, .mkd-fixed-wrapper').length) {
								headerHeight = $('.header-appear, .mkd-fixed-wrapper').height();
							}
							info.stop().animate({
								marginTop: (mkd.scroll - (infoHolderOffset) + mkdGlobalVars.vars.mkdAddForAdminBar + headerHeight + 20) //20 px is for styling, spacing between header and info holder
							});
							//Reset header height
							headerHeight = 0;
						}
						else {
							info.stop().animate({
								marginTop: mediaHolderHeight - infoHolderHeight
							});
						}
					} else {
						info.stop().animate({
							marginTop: 0
						});
					}
				}
			}
		};

		return {

			init: function() {
				if(!mkd.modules.common.mkdIsTouchDevice()) {
					infoHolderPosition();
					$(window).scroll(function() {
						recalculateInfoHolderPosition();
					});
				}
			}

		};

	};

	function mkdPortfolioSingleMasonryImages() {

		var holder = $('.mkd-portfolio-single-holder.masonry');
		var ptfGallery = holder.find('.mkd-ptf-gallery');
		var coeficient = 1.48; //in order to make images to be landscape
		var sizerWidth = ptfGallery.find('.mkd-ptf-gallery-sizer').outerWidth();

		var size = sizerWidth / coeficient + 23; //23px is spacing between items

		var resizeMasonryImages = function() {

			sizerWidth = ptfGallery.find('.mkd-ptf-gallery-sizer').outerWidth();
			size = sizerWidth / coeficient + 23; //23px is spacing between items

			var defaultItem = ptfGallery.find('.mkd-ptf-gallery-item.default');
			var largeHeightItem = ptfGallery.find('.mkd-ptf-img-large-height');
			var largeHeightWidthItem = ptfGallery.find('.mkd-ptf-img-large-height-width');

			defaultItem.css('height', size);
			largeHeightItem.css('height', Math.round(2 * size));
			largeHeightWidthItem.css('height', Math.round(2 * size));


		};

		var initMasonryItems = function() {

			ptfGallery.isotope({
				itemSelector: '.mkd-ptf-gallery-item',
				masonry: {
					columnWidth: '.mkd-ptf-gallery-sizer',
					gutter: '.mkd-ptf-gallery-gutter'
				}
			});

		};

		return {

			init: function() {

				resizeMasonryImages();
				initMasonryItems();

				$(window).resize(function() {
					resizeMasonryImages();
				});

			}

		};

	}

})(jQuery);