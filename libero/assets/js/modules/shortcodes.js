(function($) {
    'use strict';

    var shortcodes = {};

    mkd.modules.shortcodes = shortcodes;

    shortcodes.mkdInitCounter = mkdInitCounter;
    shortcodes.mkdInitProgressBars = mkdInitProgressBars;
    shortcodes.mkdInitCountdown = mkdInitCountdown;
    shortcodes.mkdInitTestimonials = mkdInitTestimonials;
    shortcodes.mkdInitCarousels = mkdInitCarousels;
    shortcodes.mkdInitPieChart = mkdInitPieChart;
    shortcodes.mkdInitTabs = mkdInitTabs;
    shortcodes.mkdInitTabIcons = mkdInitTabIcons;
    shortcodes.mkdCustomFontResize = mkdCustomFontResize;
    shortcodes.mkdCounterResize = mkdCounterResize;
    shortcodes.mkdIconListResize = mkdIconListResize;
    shortcodes.mkdInitImageGallery = mkdInitImageGallery;
    shortcodes.mkdInitImageSlider = mkdInitImageSlider;
    shortcodes.mkdInitAccordions = mkdInitAccordions;
    shortcodes.mkdShowGoogleMap = mkdShowGoogleMap;
    shortcodes.mkdInitPortfolioListMasonry = mkdInitPortfolioListMasonry;
    shortcodes.mkdInitPortfolioListPinterest = mkdInitPortfolioListPinterest;
    shortcodes.mkdInitPortfolio = mkdInitPortfolio;
    shortcodes.mkdInitPortfolioMasonryFilter = mkdInitPortfolioMasonryFilter;
    shortcodes.mkdInitPortfolioSlider = mkdInitPortfolioSlider;
    shortcodes.mkdInitPortfolioLoadMore = mkdInitPortfolioLoadMore;
    shortcodes.mkdInitListAnimation = mkdInitListAnimation;
    shortcodes.mkdInitInteractiveImage = mkdInitInteractiveImage;
    shortcodes.mkdInitIconSeparator = mkdInitIconSeparator;
    shortcodes.mkdInitImageWithHoverInfo = mkdInitImageWithHoverInfo;
    shortcodes.mkdInitSocialHover = mkdInitSocialHover;
    shortcodes.mkdInitInteractiveIcon = mkdInitInteractiveIcon;
    shortcodes.mkdInitTeam = mkdInitTeam;
    shortcodes.mkdInitInteractiveBanner = mkdInitInteractiveBanner;
    shortcodes.mkdInitVideoBoxHolderAppear = mkdInitVideoBoxHolderAppear;
    shortcodes.mkdInitFullWidthSlider = mkdInitFullWidthSlider;

    $(document).ready(function() {
        mkdInitCounter();
        mkdInitProgressBars();
        mkdInitCountdown();
        mkdIcon().init();
        mkdInitTestimonials();
        mkdInitCarousels();
        mkdInitPieChart();
		mkdInitTabs();
        mkdInitTabIcons();
        mkdButton().init();
		mkdCustomFontResize();
		mkdCounterResize();
		mkdIconListResize();
        mkdInitImageGallery();
        mkdInitImageSlider();
        mkdInitAccordions();
        mkdShowGoogleMap();
        mkdInitPortfolioListMasonry();
        mkdInitPortfolioListPinterest();
        mkdInitPortfolio();
        mkdInitPortfolioMasonryFilter();
        mkdInitPortfolioSlider();
        mkdInitPortfolioLoadMore();
        mkdInitListAnimation();
        mkdInitInteractiveImage();
        mkdInitIconSeparator();
        mkdInitImageWithHoverInfo();
        mkdInitSocialHover();
        mkdInitVideoBoxHolderAppear();
        mkdInitFullWidthSlider();
    });
    
    $(window).resize(function(){
		mkdCustomFontResize();
		mkdCounterResize();
		mkdIconListResize();
        mkdInitPortfolioListMasonry();
        mkdInitPortfolioListPinterest();
        mkdInitImageWithHoverInfo();
        mkdInitInteractiveIcon();
        mkdInitTeam();
        mkdInitInteractiveBanner();
    });

    $(window).load(function(){
        mkdInitInteractiveIcon();
        mkdInitTeam();
        mkdInitInteractiveBanner();
    });

    /**
     * Counter Shortcode
     */
    function mkdInitCounter() {

        var counters = $('.mkd-counter');


        if (counters.length) {
            counters.each(function() {
                var counter = $(this);
                counter.appear(function() {
                    counter.parents('.mkd-counter-holder').addClass('mkd-counter-holder-show');

                    //Counter zero type
                    if (counter.hasClass('zero')) {
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 2000,
                            refreshInterval: 100
                        });
                    } else {
                        counter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }

                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            });
        }

    }
	/*
	**	Counter Resizing
	*/
	function mkdCounterResize(){
		var counters = $('.mkd-counter-holder');
		if (counters.length){
			counters.each(function(){
				var thisCounter = $(this);
				var thisCounterDigit = thisCounter.find('.mkd-counter');
				var thisCounterCurrency = thisCounter.find('.mkd-counter-currency');
				var fontSize;
				var coef1 = 1;
				var coef2 = 1;

				if (mkd.windowWidth <= 1024){
					coef1 = 0.8;
					coef2 = 0.88;
				}

				if (mkd.windowWidth < 600){
					coef1 = 0.6;
					coef2 = 0.8;
				}

				if (mkd.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.6;
				}

				if (mkd.windowWidth < 320){
					coef1 = 0.3;
					coef2 = 0.5;
				}

				if (typeof thisCounter.data('digit-size') !== 'undefined' && thisCounter.data('digit-size') !== false) {
					fontSize = parseInt(thisCounter.data('digit-size'));

					if (fontSize > 90) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if(fontSize > 70) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCounterDigit.css('font-size',fontSize + 'px');
					thisCounterCurrency.css('font-size',fontSize + 'px');
				}

			});
		}
	}
	/*
	**	Icon List Item Resizing
	*/
	function mkdIconListResize(){
		var iconList = $('.mkd-icon-list-item');
		if (iconList.length){
			iconList.each(function(){
				var thisIconItem = $(this);
				var thisItemIcon = thisIconItem.find('.mkd-icon-list-icon-holder-inner');
				var thisItemText = thisIconItem.find('.mkd-icon-list-text');
				var fontSizeIcon;
				var fontSizeText;
				var coef1 = 1;

				if (mkd.windowWidth <= 1024){
					coef1 = 0.75;
				}

				if (mkd.windowWidth < 600){
					coef1 = 0.65;
				}

				if (mkd.windowWidth < 480){
					coef1 = 0.5;
				}

				if (typeof thisItemIcon.data('icon-size') !== 'undefined' && thisItemIcon.data('icon-size') !== false) {
					fontSizeIcon = parseInt(thisItemIcon.data('icon-size'));

					if (fontSizeIcon > 50) {
						fontSizeIcon = Math.round(fontSizeIcon*coef1);
					}

					thisItemIcon.children().css('font-size',fontSizeIcon + 'px');
				}

				if (typeof thisItemText.data('title-size') !== 'undefined' && thisItemText.data('title-size') !== false) {
					fontSizeText = parseInt(thisItemText.data('title-size'));

					if (fontSizeText > 50) {
						fontSizeText = Math.round(fontSizeText*coef1);
					}

					thisItemText.css('font-size',fontSizeText + 'px');
				}

			});
		}
	}

    /*
    **	Horizontal progress bars shortcode
    */
    function mkdInitProgressBars(){
        
        var progressBar = $('.mkd-progress-bar');
        
        if(progressBar.length){
            
            progressBar.each(function() {
                
                var thisBar = $(this);
                
                thisBar.appear(function() {
                    mkdInitToCounterProgressBar(thisBar);
                    if(thisBar.find('.mkd-floating.mkd-floating-inside') !== 0){
                        var floatingInsideMargin = thisBar.find('.mkd-progress-content').height();
                        floatingInsideMargin += parseFloat(thisBar.find('.mkd-progress-title-holder').css('padding-bottom'));
                        floatingInsideMargin += parseFloat(thisBar.find('.mkd-progress-title-holder').css('margin-bottom'));
                        thisBar.find('.mkd-floating-inside').css('margin-bottom',-(floatingInsideMargin)+'px');
                    }
                    var percentage = thisBar.find('.mkd-progress-content').data('percentage'),
                        progressContent = thisBar.find('.mkd-progress-content'),
                        progressNumber = thisBar.find('.mkd-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage+'%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage+'%'}, 1500);

                });
            });
        }
    }
    /*
    **	Counter for horizontal progress bars percent from zero to defined percent
    */
    function mkdInitToCounterProgressBar(progressBar){
        var percentage = parseFloat(progressBar.find('.mkd-progress-content').data('percentage'));
        var percent = progressBar.find('.mkd-progress-number .mkd-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.mkd-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }

    /**
     * Countdown Shortcode
     */
    function mkdInitCountdown() {

        var countdowns = $('.mkd-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel,
            monthLabelSingle,
            dayLabelSingle,
            hourLabelSingle,
            minuteLabelSingle,
            secondLabelSingle;

        if (countdowns.length) {

            countdowns.each(function(){

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#'+countdownId),
                    digitFontSize,
                    labelFontSize;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                monthLabelSingle = countdown.data('month-label-single');
                dayLabelSingle = countdown.data('day-label-single');
                hourLabelSingle = countdown.data('hour-label-single');
                minuteLabelSingle = countdown.data('minute-label-single');
                secondLabelSingle = countdown.data('second-label-single');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    labels1: ['Years', monthLabelSingle, 'Weeks', dayLabelSingle, hourLabelSingle, minuteLabelSingle, secondLabelSingle],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size' : digitFontSize+'px',
                        'line-height' : digitFontSize+'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size' : labelFontSize+'px'
                    });
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdIcon = mkd.modules.shortcodes.mkdIcon = function() {
        //get all icons on page
        var icons = $('.mkd-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('mkd-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.mkd-icon-animation-holder').addClass('mkd-icon-animation-show');
                }, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.mkd-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.find('.mkd-background').css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon.find('.mkd-background'), color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon.find('.mkd-background'), color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.find('.mkd-background').css('borderTopColor');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon.find('.mkd-background'), color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon.find('.mkd-background'), color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function mkdInitTestimonials(){

        var testimonial = $('.mkd-testimonials');
        if(testimonial.length){
            testimonial.each(function(){

                var thisTestimonial = $(this);

                //set three items in one column for 1x3 format
                var sliderItem = $(this).find('.mkd-testimonial-content');
                for(var i = 0; i < sliderItem.length; i+=3) {
                  sliderItem.slice(i, i+3).wrapAll("<div class='item-inner'></div>");
                }

                //opacity 1
                thisTestimonial.waitForImages(function() {
                    $(this).animate({opacity:1},1000);
                });

                thisTestimonial.appear(function() {
                    thisTestimonial.css('visibility','visible');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

                var interval = 5000;

                var items = [
                    [0,1],
                    [480,1],
                    [1024,1]
                ];

                thisTestimonial.owlCarousel({
                    items: 1,
                    itemsCustom: items,
                    autoPlay: interval,
                    addClassActive: true,
                    transitionStyle : 'mkdTransition', //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    paginationSpeed: 500
                });

            });

        }

    }

    /**
     * Init Carousel shortcode
     */
    function mkdInitCarousels() {

        var carouselHolders = $('.mkd-carousel-holder'),
            carousel;

        if (carouselHolders.length) {
            carouselHolders.each(function(){
                //Bullet Pagination
                var pagination = true;
                //Autoplay
                var autoplay = 4000;
                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3]
                ];
                var carouselHolder = $(this);
                carousel = carouselHolder.children('.mkd-carousel');
                
                //set two items in one column for 3x2 format
                var sliderItem = $(this).find('.mkd-carousel-item-holder');
                if (carousel.hasClass('mkd-carousel-grid')){
                    for(var i = 0; i < sliderItem.length; i+=2) {
                      sliderItem.slice(i, i+2).wrapAll("<div class='item-inner'></div>");
                    }
                }
                else{
                    sliderItem.wrap("<div class='item-inner'></div>");
                    pagination = false;
                    var itemsNumber = 6;
                    if (typeof carousel.data('items-shown') !== 'undefined'){
                    	itemsNumber = parseInt(carousel.data('items-shown'));
                    }
                    items = [
                        [0,1],
                        [480,2],
                        [768,4],
                        [1024,itemsNumber]
                    ];
                }
                if (carousel.data('autoplay') == 'no'){
                	autoplay = false;
                }

                //opacity 1
                carouselHolder.waitForImages(function() {
                    $(this).animate({opacity:1},2200);
                });


                carousel.owlCarousel({
                    autoPlay: autoplay,
                    items: 3,
                    itemsCustom: items,
                    addClassActive: true,
                    pagination: pagination,
                    navigation: false,
                    paginationSpeed: 400
                });



            });
        }

    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function mkdInitPieChart() {

        var pieCharts = $('.mkd-pie-chart-holder, .mkd-pie-chart-with-icon-holder');

        if (pieCharts.length) {

            pieCharts.each(function () {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.mkd-percentage, .mkd-percentage-with-icon'),
                    barColor = mkdGlobalVars.vars.mkdFirstMainColor,
                    trackColor = '#efefef',
                    lineWidth = 10,
                    size = 142;

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

            });

        }

    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart( pieChart ){

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.mkd-to-counter'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /*
    **	Init tabs shortcode
    */
    function mkdInitTabs(){

       var tabs = $('.mkd-tabs');
        if(tabs.length){
            tabs.each(function(){
                var thisTabs = $(this),
                    navLinks = thisTabs.find('.mkd-tabs-nav a');

                navLinks.each(function () {
                    var that = $(this),
                        link = that.attr('href'),
                        container = $(link),
                        linkSub = link.substr(1, link.length - 1),
                        customID = Math.floor(Math.random() * 10000);

                    if (container.length) {
                        container.attr({
                            'id' : linkSub + customID
                        });
                        that.attr({
                            'href' : link + customID
                        });
                    }
                });

                if(thisTabs.hasClass('mkd-horizontal')){
                    thisTabs.tabs();
                }
                else if(thisTabs.hasClass('mkd-vertical')){
                    thisTabs.tabs().addClass( 'ui-tabs-vertical ui-helper-clearfix' );
                    thisTabs.find('.mkd-tabs-nav > ul >li').removeClass( 'ui-corner-top' ).addClass( 'ui-corner-left' );
                }
            });
        }
    }

    /*
    **	Generate icons in tabs navigation
    */
    function mkdInitTabIcons(){

        var tabContent = $('.mkd-tab-container');
        if(tabContent.length){

            tabContent.each(function(){
                var thisTabContent = $(this);

                var id = thisTabContent.attr('id');
                var icon = '';
                if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
                    icon = thisTabContent.data('icon-html');
                }

                var tabNav = thisTabContent.parents('.mkd-tabs').find('.mkd-tabs-nav > li > a[href=#'+id+']');

                if(typeof(tabNav) !== 'undefined') {
                    tabNav.children('.mkd-icon-frame').append(icon);
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdButton = mkd.modules.shortcodes.mkdButton = function() {
        //all buttons on the page
        var buttons = $('.mkd-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
                button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
            }
        };



        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor');
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
                button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
            }
        };

        var buttonIconHoverBorderColor = function(button) {
            if(button.hasClass('mkd-btn-icon')) {
                if(typeof button.data('between-hover-border-color') !== 'undefined') {
                    var changeIconBorderColor = function(event) {
                        event.data.iconHolder.css('border-color', event.data.color);
                    };

                    var iconHolder = button.find('.mkd-btn-text');

                    var originalBorderColor = iconHolder.css('borderRightColor');

                    var hoverBorderColor = button.data('between-hover-border-color');

                    button.on('mouseenter', { iconHolder: iconHolder, color: hoverBorderColor }, changeIconBorderColor);
                    button.on('mouseleave', { iconHolder: iconHolder, color: originalBorderColor }, changeIconBorderColor);
                }
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                        buttonIconHoverBorderColor($(this));
                    });
                }
            }
        };
    };


	/*
	**	Custom Font resizing
	*/
	function mkdCustomFontResize(){
		var customFont = $('.mkd-custom-font-holder');
		if (customFont.length){
			customFont.each(function(){
				var thisCustomFont = $(this);
				var fontSize;
				var lineHeight;
				var coef1 = 1;
				var coef2 = 1;

				if (mkd.windowWidth < 1200){
					coef1 = 0.8;
				}

				if (mkd.windowWidth < 1000){
					coef1 = 0.7;
				}

				if (mkd.windowWidth < 768){
					coef1 = 0.6;
					coef2 = 0.7;
				}

				if (mkd.windowWidth < 600){
					coef1 = 0.5;
					coef2 = 0.6;
				}

				if (mkd.windowWidth < 480){
					coef1 = 0.4;
					coef2 = 0.5;
				}

				if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
					fontSize = parseInt(thisCustomFont.data('font-size'));

					if (fontSize > 70) {
						fontSize = Math.round(fontSize*coef1);
					}
					else if (fontSize > 35) {
						fontSize = Math.round(fontSize*coef2);
					}

					thisCustomFont.css('font-size',fontSize + 'px');
				}

				if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
					lineHeight = parseInt(thisCustomFont.data('line-height'));

					if (lineHeight > 70 && mkd.windowWidth < 1200) {
						lineHeight = '1.2em';
					}
					else if (lineHeight > 35 && mkd.windowWidth < 768) {
						lineHeight = '1.2em';
					}
					else{
						lineHeight += 'px';
					}

					thisCustomFont.css('line-height', lineHeight);
				}
			});
		}
	}

    /*
     **	Show Google Map
     */
    function mkdShowGoogleMap(){

        if($('.mkd-google-map').length){
            $('.mkd-google-map').each(function(){

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_"+ uniqueId;
                var geocoder = "geocoder_"+ uniqueId;
                var holderId = "mkd-map-"+ uniqueId;

                mkdInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
            });
        }

    }
    /*
     **	Init Google Map
     */
    function mkdInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [
            {
                stylers: [
                    {hue: color },
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if(customMapStyle){
            googleMapStyleId = 'mkd-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Mkd Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)){
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkd-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkd-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            mkdInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }
    /*
     **	Init Google Map Addresses
     */
    function mkdInitializeGoogleAddress(data, pin,  map, geocoder){
        if (data === '')
            return;
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<p>'+data+'</p>'+
            '</div>'+
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode( { 'address': data}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon:  pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function mkdInitAccordions(){
        var accordion = $('.mkd-accordion-holder');
        if(accordion.length){
            accordion.each(function(){

               var thisAccordion = $(this);

				if(thisAccordion.hasClass('mkd-accordion')){

					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('mkd-toggle')){

					var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.mkd-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
            });
        }
    }

    function mkdInitImageGallery() {

        var galleries = $('.mkd-image-gallery');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.mkd-image-gallery-slider'),
                    autoplay = gallery.data('autoplay'),
                    animation = (gallery.data('animation') == 'slide') ? false : gallery.data('animation'),
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes');

                gallery.owlCarousel({
                    singleItem: true,
                    autoPlay: autoplay * 1000,
                    navigation: navigation,
                    transitionStyle : animation, //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: pagination,
                    slideSpeed: 600,
                    navigationText: [
                        '<span class="mkd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="mkd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });
            });
        }

    }
    /**
     * Initializes portfolio list
     */
    function mkdInitPortfolio(){
        var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-standard, .mkd-portfolio-list-holder-outer.mkd-ptf-gallery');
        if(portList.length){            
            portList.each(function(){
                var thisPortList = $(this);
                thisPortList.appear(function(){
                    mkdInitPortMixItUp(thisPortList);
                });
            });
        }
    }
    /**
     * Initializes mixItUp function for specific container
     */
    function mkdInitPortMixItUp(container){
        var filterClass = '';
        if(container.hasClass('mkd-ptf-has-filter')){
            filterClass = container.find('.mkd-portfolio-filter-holder-inner ul li').data('class');
            filterClass = '.'+filterClass;
        }
        
        var holderInner = container.find('.mkd-portfolio-list-holder');
        holderInner.mixItUp({
            callbacks: {
                onMixLoad: function(){
                    holderInner.find('article').css('visibility','visible');
                },
                onMixStart: function(){
                    holderInner.find('article').css('visibility','visible');
                },
                onMixBusy: function(){
                    holderInner.find('article').css('visibility','visible');
                } 
            },           
            selectors: {
                filter: filterClass
            },
            animation: {
                effects: 'fade scale',
                duration: 300,
                easing: 'ease-out'
            }
            
        });
        
    }
     /*
    **	Init portfolio list masonry type
    */
    function mkdInitPortfolioListMasonry(){
        var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-masonry');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.mkd-portfolio-list-holder');
                var size = thisPortList.find('.mkd-portfolio-list-masonry-grid-sizer').width();
                mkdResizeMasonry(size,thisPortList);
                
                mkdInitMasonry(thisPortList);
                $(window).resize(function(){
                    mkdResizeMasonry(size,thisPortList);
                    mkdInitMasonry(thisPortList);
                });
            });
        }
    }
    
    function mkdInitMasonry(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.mkd-portfolio-item',
            masonry: {
                columnWidth: '.mkd-portfolio-list-masonry-grid-sizer'
            }
        });
    }
    
    function mkdResizeMasonry(size,container){
        
        var defaultMasonryItem = container.find('.mkd-default-masonry-item');
        var largeWidthMasonryItem = container.find('.mkd-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.mkd-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.mkd-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeWidthMasonryItem.css('height', size);
        
        
        if(mkd.windowWidth > 600){
            largeWidthHeightMasonryItem.css('height', Math.round(2*size));
            largeHeightMasonryItem.css('height', Math.round(2*size));
        }else{
            largeWidthHeightMasonryItem.css('height', size);
            largeHeightMasonryItem.css('height', size);
        }
    }
    /**
     * Initializes portfolio pinterest 
     */
    function mkdInitPortfolioListPinterest(){
        
        var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-pinterest');
        if(portList.length) {
            portList.each(function() {
                var thisPortList = $(this).children('.mkd-portfolio-list-holder');
                mkdInitPinterest(thisPortList);
                $(window).resize(function(){
                     mkdInitPinterest(thisPortList);
                });
            });
            
        }
    }
    
    function mkdInitPinterest(container){
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.mkd-portfolio-item',
            masonry: {
                columnWidth: '.mkd-portfolio-list-masonry-grid-sizer'
            }
        });
        
    }
    /**
     * Initializes portfolio masonry filter
     */
    function mkdInitPortfolioMasonryFilter(){
        
        var filterHolder = $('.mkd-portfolio-filter-holder.mkd-masonry-filter');
        
        if(filterHolder.length){
            filterHolder.each(function(){
               
                var thisFilterHolder = $(this);
                
                var portfolioIsotopeAnimation = null;
                
                var filter = thisFilterHolder.find('ul li').data('class');
                
                thisFilterHolder.find('.filter:first').addClass('current');
                
                thisFilterHolder.find('.filter').click(function(){

                    var currentFilter = $(this);
                    clearTimeout(portfolioIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');

                    portfolioIsotopeAnimation = setTimeout(function(){
                        $('.isotope, .isotope .isotope-item').css('transition-duration','0s'); 
                    },700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.siblings('.mkd-portfolio-list-holder-outer').find('.mkd-portfolio-list-holder').isotope({ filter: selector });

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });
                
            });
        }
    }
    /**
     * Initializes portfolio slider
     */
    
    function mkdInitPortfolioSlider(){
        var portSlider = $('.mkd-portfolio-list-holder-outer.mkd-portfolio-slider-holder');
        if(portSlider.length){
            portSlider.each(function(){
                var thisPortSlider = $(this);
                var sliderWrapper = thisPortSlider.children('.mkd-portfolio-list-holder');
                var numberOfItems = thisPortSlider.data('items');
                var navigation = true;

                //Responsive breakpoints
                var items = [
                    [0,1],
                    [480,2],
                    [768,3],
                    [1024,numberOfItems]
                ];

                sliderWrapper.owlCarousel({                    
                    autoPlay: 5000,
                    items: numberOfItems,
                    itemsCustom: items,
                    pagination: true,
                    navigation: navigation,
                    slideSpeed: 600,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    navigationText: [
                        '<span class="mkd-prev-icon"><i class="fa fa-angle-left"></i></span>',
                        '<span class="mkd-next-icon"><i class="fa fa-angle-right"></i></span>'
                    ]
                });
            });
        }
    }
    /**
     * Initializes portfolio load more function
     */
    function mkdInitPortfolioLoadMore(){
        var portList = $('.mkd-portfolio-list-holder-outer.mkd-ptf-load-more');
        if(portList.length){
            portList.each(function(){
                
                var thisPortList = $(this);
                var thisPortListInner = thisPortList.find('.mkd-portfolio-list-holder');
                var nextPage; 
                var maxNumPages;
                var loadMoreButton = thisPortList.find('.mkd-ptf-list-load-more a');
                
                if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {  
                    maxNumPages = thisPortList.data('max-num-pages');
                }
                
                loadMoreButton.on('click', function (e) {  
                    var loadMoreDatta = mkdGetPortfolioAjaxData(thisPortList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation(); 
                    if(nextPage <= maxNumPages){
                        var ajaxData = mkdSetPortfolioAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: mkdCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisPortList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = mkdConvertHTML(response.html); //convert response html into jQuery collection that Mixitup can work with
                                thisPortList.waitForImages(function(){
                                    setTimeout(function() {
                                        if(thisPortList.hasClass('mkd-ptf-masonry') || thisPortList.hasClass('mkd-ptf-pinterest') ){
                                            thisPortListInner.isotope().append( responseHtml ).isotope( 'appended', responseHtml ).isotope('reloadItems');
                                        } else {
                                            thisPortListInner.mixItUp('append',responseHtml);
                                        }
                                    },400);
                                });                           
                            }
                        });
                    }
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                });
                
            });
        }
    }
    
    function mkdConvertHTML ( html ) {
        var newHtml = $.trim( html ),
                $html = $(newHtml ),
                $empty = $();

        $html.each(function ( index, value ) {
            if ( value.nodeType === 1) {
                $empty = $empty.add ( this );
            }
        });

        return $empty;
    }
    /**
     * Initializes portfolio load more data params
     * @param portfolio list container with defined data params
     * return array
     */
    function mkdGetPortfolioAjaxData(container){
        var returnValue = {};
        
        returnValue.type = '';
        returnValue.columns = '';
        returnValue.gridSize = '';
        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.imageSize = '';
        returnValue.filter = '';
        returnValue.filterOrderBy = '';
        returnValue.category = '';
        returnValue.selectedProjectes = '';
        returnValue.showLoadMore = '';
        returnValue.titleTag = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        
        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.type = container.data('type');
        }
        if (typeof container.data('grid-size') !== 'undefined' && container.data('grid-size') !== false) {                    
            returnValue.gridSize = container.data('grid-size');
        }
        if (typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {                    
            returnValue.columns = container.data('columns');
        }
        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {                    
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {                    
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {                    
            returnValue.number = container.data('number');
        }
        if (typeof container.data('image-size') !== 'undefined' && container.data('image-size') !== false) {
            returnValue.imageSize = container.data('image-size');
        }
        if (typeof container.data('filter') !== 'undefined' && container.data('filter') !== false) {                    
            returnValue.filter = container.data('filter');
        }
        if (typeof container.data('filter-order-by') !== 'undefined' && container.data('filter-order-by') !== false) {                    
            returnValue.filterOrderBy = container.data('filter-order-by');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {                    
            returnValue.category = container.data('category');
        }
        if (typeof container.data('selected-projects') !== 'undefined' && container.data('selected-projects') !== false) {                    
            returnValue.selectedProjectes = container.data('selected-projects');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {                    
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {                    
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {                    
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {                    
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        return returnValue;
    }
     /**
     * Sets portfolio load more data params for ajax function
     * @param portfolio list container with defined data params
     * return array
     */
    function mkdSetPortfolioAjaxData(container){
        var returnValue = {
            action: 'mkd_core_portfolio_ajax_load_more',
            type: container.type,
            columns: container.columns,
            gridSize: container.gridSize,
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            imageSize: container.imageSize,
            filter: container.filter,
            filterOrderBy: container.filterOrderBy,
            category: container.category,
            selectedProjectes: container.selectedProjectes,
            showLoadMore: container.showLoadMore,
            titleTag: container.titleTag,
            nextPage: container.nextPage
        };
        return returnValue;
    }

	 /**
	 * Animate unordered list
	 */
	function mkdInitListAnimation(){

		var animateList = $('.mkd-animate-list');
		var animateOnTouch = $('.mkd-no-animations-on-touch');

		if(animateList.length && !animateOnTouch.length){
			animateList.each(function(){
				var thisList = $(this);
				var thisListLis = thisList.find("li");
				thisList.appear(function() {
					thisListLis.each(function (l) {
						var k = $(this);
						setTimeout(function () {
							k.animate({
								opacity: 1,
								top: 0
							}, 200);
						}, 220*l);
					});
				},{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
			});
		}
	}

    /**
    * Init Mkd Image Slider
    */
    function mkdInitImageSlider() {
        
        if ($('.mkd-image-slider').length) {
            $('.mkd-image-slider').each(function(){

                //vars
                var imageSlider = $(this);
                var animation = '';
                var thumbs = '';
                var navigation = '';
                var customNavigation = '';
                var navigationArrows = imageSlider.find(".mkd-slider-navigation a");


                //params
                if ($(this).hasClass('with-thumbs')) {
                    thumbs = "thumbnails";
                    navigation = false;
                    customNavigation = false;
                    animation = 'slide';
                } else {
                    thumbs = false;
                    navigation = true;
                    customNavigation = navigationArrows;
                    animation = 'fade';
                }



                imageSlider.waitForImages(function() {
                    $(this).animate({opacity:1},2200);
                });

                imageSlider.find('.flexslider').flexslider({
                    animation: animation,
                    controlNav: thumbs,
                    directionNav: navigation,
                    customDirectionNav: customNavigation,
                    animationLoop: false,
                    start: function(slider){
                        slider.find('.flex-control-nav .flex-active').parent('li').addClass('active-item').siblings().removeClass('active-item');

                        mkd.modules.common.mkdInitParallax();
                    },
                    after: function(slider){
                        slider.find('.flex-control-nav .flex-active').parent('li').addClass('active-item').siblings().removeClass('active-item');              
                    }
                });

                //hover effect elements
                imageSlider.find('.flex-control-thumbs li').append('<span class="mkd-image-slider-thumb-hover"></span>');

            });
        }

    }

    /**
    * Init Interactive Image shortcode - Checkmark animation
    */

    function mkdInitInteractiveImage() {

        var checkMarks = $('.mkd-interactive-image.mkd-checkmark');
        var rows = checkMarks.closest('.vc_row'); // checkmark parent row elements

        if (rows.length){
            rows.each(function(){

                var row = $(this); //current row

                if(checkMarks.length){
                    checkMarks.each(function(i){

                        var checkMark = $(this);
                        var n = row.find(checkMarks).length; // number of checkmark elements in current row

                        if (i>=n) {
                            i = i - n;
                        } //rewind delay coefficient after n elements

                        checkMark.appear(function() {
                            $(this).find('.tick').delay(i*300).animate({'width': '53px'}, 400);
                        },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

                    });
                }

            });
        }
    }

    /**
    * Init Icon Separator shortcode
    */

    function mkdInitIconSeparator() {
        var iconSeparators = $('.mkd-separator-with-icon.mkd-animate');

        if(iconSeparators.length){
            iconSeparators.each(function(){

                var iconSeparator = $(this);

                iconSeparator.appear(function() {
                    $(this).addClass('appeared');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

            });
        }
    }

    /**
    * Init Image With Hover Info shortcode
    */

    function mkdInitImageWithHoverInfo() {
        var imageWithHoverInfo = $('.mkd-image-with-hover-info');

        if(imageWithHoverInfo.length){
            imageWithHoverInfo.each(function(){

                var mask = $(this).find('.mkd-mask');
                var content = $(this).find('.mkd-info');
                var maskHeight = '';

                if ((mask.outerHeight()-150) < content.outerHeight()) {
                    maskHeight = content.outerHeight() + 150; // 150 - offset in pixels for the desired angle of mask element
                    mask.css({'height':maskHeight + 'px'});
                    mask.css({'top':-maskHeight + 'px'});
                }

            });
        }
    }


    /**
    * Init Social Share Hover
    */

	function mkdInitSocialHover() {
		var iconsSocial = $('.mkd-social-network-icon');

		iconsSocial.each(function(){
			var iconSocial = $(this);
			if(typeof iconSocial.data('hover-color') !== 'undefined' && iconSocial.data('hover-color') !== '') {


				var iconHoverHolder = iconSocial.parent();
				var hoverColor = iconSocial.data('hover-color');
				var originalColor = iconSocial.css('color');


				iconHoverHolder.on("mouseenter", function(){
					iconSocial.css('color',hoverColor);
				});

				iconHoverHolder.on("mouseleave", function(){
					iconSocial.css('color',originalColor);
				});
			}
		});
	}

    /**
    * Init Interactive Icon shortcode
    */

    function mkdInitInteractiveIcon() {
        var interactiveIcons = $('.mkd-interactive-icon');

        if(interactiveIcons.length){
            interactiveIcons.each(function(){

                //vars
                var interactiveIcon= $(this);
                var titleHeight;
                var initialContentHeight;
                var hoverContentHeight;

                interactiveIcon.animate({opacity:1}, 1000, 'easeOutSine');

                //heights
                titleHeight = interactiveIcon.find('.mkd-interactive-icon-title').outerHeight();
                initialContentHeight = interactiveIcon.find('.mkd-interactive-icon-initial-content').outerHeight();
                hoverContentHeight = interactiveIcon.find('.mkd-interactive-icon-hover-content').outerHeight() + titleHeight;

                //definitive height
                if ( initialContentHeight < hoverContentHeight) {
                    interactiveIcon.find('.mkd-interactive-icon-inner').css({'height': parseInt(hoverContentHeight) + 'px'});
                }

                //offset when hover content exceeds initial content
                var interactiveIconTopPosition = interactiveIcon.offset().top;
                var titleTopPosition = interactiveIcon.find('.mkd-interactive-icon-title').offset().top;
                var titleMovement = interactiveIconTopPosition - titleTopPosition - 10;

                interactiveIcon.find('.mkd-interactive-icon-hover-content').css({'top':parseInt(titleHeight)+'px'}); //hover content positioning just below the title

                //hovers
                interactiveIcon.on('mouseenter', interactiveIcon, function(){

                    interactiveIcon.find('.mkd-interactive-icon-title').css('-webkit-transform','translateY('+parseInt(titleMovement)+'px)');
                    interactiveIcon.find('.mkd-interactive-icon-title').css('transform','translateY('+parseInt(titleMovement)+'px)');

                });

                interactiveIcon.on('mouseleave', interactiveIcon, function(){

                   interactiveIcon.find('.mkd-interactive-icon-title').css('-webkit-transform','translateY(0px)');
                   interactiveIcon.find('.mkd-interactive-icon-title').css('transform','translateY(0px)');

                });

            });
        }
    }


    /**
    * Init Team shortcode
    */
    function mkdInitTeam() {

        var teamShortcodes = $('.mkd-team');

        if(teamShortcodes.length){
            teamShortcodes.each(function(){

                var teamShortcode = $(this);
                var infoHolder = teamShortcode.find('.mkd-team-info');
                var triangle = teamShortcode.find('.mkd-team-triangle ');
                var triangleTop = infoHolder.offset().top - teamShortcode.offset().top; 

                //calculate traingle position
                triangle.css({'top':triangleTop-12+'px'}); // 12 px is triangle height

                //social icons text 
                var teamSocialNetworks = ['blogger','delicious','deviantart','dribbble','facebook','flickr','googledrive','instagram','myspace','picassa','pinterest','rss','share','skype','spotify','stumbleupon','tumblr','twitter','linkedin','wordpress','youtube'];

                for (var i = teamSocialNetworks.length - 1; i >= 0; i--) {
                    var teamSocialNetwork = teamSocialNetworks[i];
                    var teamSocialIcon = teamShortcode.find('.mkd-icon-element[class*="'+teamSocialNetwork+'"]');
                    teamSocialIcon.parent('a').append('<span class="mkd-team-social-text">'+teamSocialNetwork+'</span>');
                }

            });
        }
    }

    /*
    * init Interactive Banner shortcode
    */
    function mkdInitInteractiveBanner() {
        var interactiveBanners = $('.mkd-interactive-banner');
        if(interactiveBanners.length){
            interactiveBanners.each(function(){

                var interactiveBanner = $(this);
                var infoHolder = interactiveBanner.find('.mkd-interactive-banner-info');
                var triangle = interactiveBanner.find('.mkd-interactive-banner-triangle ');
                var triangleTop = infoHolder.offset().top - interactiveBanner.offset().top; 
                
                //calculate traingle position
                triangle.css({'top':triangleTop-12+'px'}); // 12 px is triangle height
            });
        }
    }

    /*
    * Video Box appearing
    */
	function mkdInitVideoBoxHolderAppear(){
		var videoBox = $('.mkd-video-box');

		if (videoBox.length){
			videoBox.each(function(){
				var thisVideoBox = $(this);
				var thisVideoBoxText = thisVideoBox.find('.mkd-video-box-text');

				thisVideoBox.waitForImages(function() {
					thisVideoBoxText.addClass('mkd-vtext-appear');
				});
			});
		}

	}

    /**
     * Init fullwidth slider shortcode
     */

    function mkdInitFullWidthSlider(){

        var fullwidthSlider = $('.mkd-fullwidth-slider-slides');
        if(fullwidthSlider.length){
            fullwidthSlider.each(function(){

                var thisFullwidthSlider = $(this);

                thisFullwidthSlider.appear(function() {
                    thisFullwidthSlider.css('visibility','visible');
                },{accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});

                var interval = 5000;
                var controlNav = true;
                var directionNav = false;
                var animationSpeed = 600;
                if(typeof thisFullwidthSlider.data('animation-speed') !== 'undefined' && thisFullwidthSlider.data('animation-speed') !== false) {
                    animationSpeed = thisFullwidthSlider.data('animation-speed');
                }

                //var iconClasses = getIconClassesForNavigation(directionNavArrowsTestimonials); TODO

                thisFullwidthSlider.owlCarousel({
                    singleItem: true,
                    autoPlay: interval,
                    addClassActive: true,
                    navigation: directionNav,
                    transitionStyle : 'fade', //fade, fadeUp, backSlide, goDown
                    autoHeight: true,
                    pagination: controlNav,
                    slideSpeed: animationSpeed
                });

            });

        }

    }


})(jQuery);