var $j = jQuery.noConflict();
var firstLoad = true;
var image_src_regex = /url\(["']?([^'")]+)['"]?\)/;

function perPageBindings() {
    "use strict";

    $j('.edgt_slider_preloader .ajax_loader').hide();
    content = $j('.content');
    initEdgeSlider();
    initEdgeCarousel();
    initMessageHeight();
    initToCounter();
    initCounter();
    initContentSlider();
    initProgressBars();
    initListAnimation();
    initPieChart();
    initPieChartWithIcon();
    initParallaxTitle();
    loadMore();
    prettyPhoto();
    initFlexSlider();
    fitVideo();
    initAccordion();
    initAccordionContentLink();
    initMessages();
    fitAudio();
    initProgressBarsIcon();
    initMoreFacts();
    placeholderReplace();
    initPortfolio();
    initPortfolioZIndex();
    initPortfolioMasonry();
    initPortfolioMasonryFilter();
    initTabs();
    initVerticalTabsContentHeight();
    initVerticalTabsWidth();
    initTestimonials();
    initBlog();
    initBlogMasonryFullWidth();
    backButtonShowHide();
    backToTop();
    updateShoppingCart();
    initProgressBarsVertical();
    initImageHover();
    checkAnchorOnScroll();
    checkHeaderStyleOnScroll();
    initVideoBackground();
    initVideoBackgroundSize();
    initIconWithTextAnimation();
    initPortfolioSlider();
    initBlogSlider();
    initCoverBoxes();
    ajaxSubmitCommentForm();
    createContentMenu();
    contentMenuScrollTo();
    contentMenuCheckLastSection();
    createSelectContentMenu();
    initButtonHover();
    initSocialIconHover();
    initIconHover();
    setFooterHeight();
    initImageGallerySliderNoSpace();
    initPortfolioBlurEffect();
    initSocialIconsSidebarEffect();
    initVerticalSplitSlider();
    countClientsPerRow();
    setContentBottomMargin();
    createTabIcons();
    initEdgeElementAnimationSkrollr();
    initPageTitleAnimation();
    initMasonryGallery();
    initBlogMasonryGallery();
    initMasonryBlogList();
    initMasonryGalleryAppearance();
	stickySidebarWidth();
    initPricingTableContentBackground();
    initProcessHeightWidth();
    //these two functions are for landing page
    if($j('.landing_holder').length){
        initFancybox();
        initExamplesFilter();
    }
}

function ajaxSetActiveState(me){
    "use strict";

    $j('.main_menu a, .mobile_menu a, .vertical_menu a, .popup_menu a').parent().removeClass('active');

    if(me.closest('.second').length === 0){
        me.parent().addClass('active');
    }else{
        me.closest('.second').parent().addClass('active');
    }

    if(me.closest('.mobile_menu').length > 0){
        me.parent().addClass('active');
    }

    $j('.main_menu a, .mobile_menu a, .vertical_menu a, .popup_menu a').removeClass('current');
    me.addClass('current');

}

function setPageMeta(meta_data) {
    "use strict";

    // set up title, meta description and meta keywords
    var newTitle = meta_data.find(".seo_title").text();
    var newDescription = meta_data.find(".seo_description").text();
    var newKeywords = meta_data.find(".seo_keywords").text();
    $j('head meta[name="description"]').attr('content', newDescription);
    $j('head meta[name="keywords"]').attr('content', newKeywords);
    document.title = newTitle;

    var newBodyClasses = meta_data.find(".body_classes").text();
    var myArray = newBodyClasses.split(',');
    $j("body").removeClass();
    for(var i=0;i<myArray.length;i++){
        if (myArray[i] !== "page_not_loaded"){
            $j("body").addClass(myArray[i]);
        }
    }
}

function setToolBarEditLink(pageId) {
    "use strict";

    if($j("#wp-admin-bar-edit").length > 0){
        // set up edit link when wp toolbar is enabled
        var old_link = $j('#wp-admin-bar-edit a').attr("href");
        var new_link = old_link.replace(/(post=).*?(&)/,'$1' + pageId + '$2');
        $j('#wp-admin-bar-edit a').attr("href", new_link);
    }
}

/* function for managing effect transition */
function balanceNavArrows () {
    "use strict";

    var navLinks;
    if($j('.vertical_menu a').length){
        navLinks = $j('.vertical_menu a');
    } else {
        navLinks = $j('.main_menu a');
    }

    var seenCurrent = false;
    navLinks.each(function (link) {
        var me = $j(this);
        if (me.hasClass('current')) {
            seenCurrent = true;
            return;
        }
        if (seenCurrent) {
            me.removeClass('up');
            me.removeClass('right');
            me.addClass('down');
            me.addClass('left');
        } else {
            me.removeClass('down');
            me.removeClass('left');
            me.addClass('up');
            me.addClass('right');
        }
    });
}

function callCallback(callbacks, name, self, args) {
    "use strict";

    if (callbacks[name]) {
        callbacks[name].apply(self, args);
    }
	
	$j('.paspartu_outer').removeAttr('style'); //remove min height in order to prevent white space below content
	if($j('.no-touch .carousel').length){skrollr_slider.refresh();} //in order to reload rest of scroll animation on same page after page loads
}

//sliding in current page
function slideInNewPage(content, text, direction, direction2, animationTime, callbacks, url) {
    "use strict";

    var newHTML = $j(text);
    var animation;
    var header_style;
    var pageId = newHTML.find('#edgt_page_id').text();

    if(newHTML.find('.content_inner').hasClass('updown')){
        animation = 'ajax_updown';
    }else if(newHTML.find('.content_inner').hasClass('fade')){
        animation = 'ajax_fade';
    }else if(newHTML.find('.content_inner').hasClass('updown_fade')){
        animation = 'ajax_updown_fade';
    }else if(newHTML.find('.content_inner').hasClass('leftright')){
        animation = 'ajax_leftright';
    }else if(newHTML.find('.content_inner').hasClass('no_animation')){
        animation = 'ajax_no_animation';
    }else if($j('body').hasClass('ajax_updown')){
        animation = 'ajax_updown';
    }else if($j('body').hasClass('ajax_fade')){
        animation = 'ajax_fade';
    }else if($j('body').hasClass('ajax_updown_fade')){
        animation = 'ajax_updown_fade';
    }else if($j('body').hasClass('ajax_leftright')){
        animation = 'ajax_leftright';
    }

    if(newHTML.find('header.page_header').hasClass('light')){
        header_style = 'light';
    }else if(newHTML.find('header.page_header').hasClass('dark')){
        header_style = 'dark';
    }else{
        header_style = header_style_admin;
    }

    var header_color;
    if(newHTML.find('.header_bottom').attr('style')){
        header_color = newHTML.find('.header_bottom').attr('style');
    } else {
        header_color="";
    }

    var header_color_top;
    if(newHTML.find('.header_top').attr('style')){
        header_color_top = newHTML.find('.header_top').attr('style');
    } else {
        header_color_top="";
    }

    var transparent;
    if(newHTML.find('header').hasClass('transparent')) {
        transparent = ' transparent';
    } else {
        transparent = '';
    }

    var vertical_menu_background;
    if(newHTML.find('.header_top').attr('style')){
        vertical_menu_background = newHTML.find('.aside.vertical_menu_area').attr('style');
    } else {
        vertical_menu_background="";
    }

    var vertical_menu_background_image;
    if(newHTML.find('aside.vertical_menu_area .vertical_area_background').attr('style')){
        vertical_menu_background_image = newHTML.find('aside.vertical_menu_area .vertical_area_background').attr('style');
    } else {
        vertical_menu_background_image="";
    }

    var footer_triangle_hide;
    if(newHTML.find('footer .row_triangle').hasClass('disable_footer_triangle')){
        footer_triangle_hide = true;
    } else {
        footer_triangle_hide = false;
    }

    var meta_data = newHTML.find('.meta');

    var newContent = newHTML.find('.content').css({position: 'relative'});
    newContent.find('.animate_title_text .title h1, .animate_title_text .title .subtitle span, .animate_title_text .breadcrumbs_title .breadcrumb').css({visibility: 'hidden'});
    content.after("<div class='content_wrapper'></div>");
    newContent.appendTo('.content_wrapper');

	//set margin top on header only for fixed top header height
	$j('header').hasClass('fixed_top_header') ? $j('.content_wrapper').css('margin-top',$j('header.fixed_top_header').outerHeight()) : null;

    $j('.side_menu_button a').removeClass('opened');
    newHTML.filter('script').each(function(){
        $j.globalEval(this.text || this.textContent || this.innerHTML || '');
    });

    if($j('.carousel').length){
        $j('.carousel').carousel('pause');
    }

    //remove vertical split slider navigation if there is any
    if($j('#multiscroll-nav').length){
        $j('#multiscroll-nav').remove();
    }

    $j('.ajax_loader').fadeIn();

    //since out effect of those two animation types need to be fadeout before new page loads, this stays here
    if (animation === "ajax_fade" || animation === "ajax_updown_fade") {
        $j('header.page_header.ajax_header_animation .drop_down > ul > li').mouseout(); // remove hover event from menu elements
		$j('header.page_header.ajax_header_animation').stop().fadeTo(animationTime,0);
		content.stop().fadeTo(animationTime,0);
    }

    newContent.waitForImages(function() {

        //after load of all pictures show sliders/portfolios
        $j('.flexslider, .slider_small, .portfolio_outer').css('visibility','visible');

        //remove preload background class
        $j('.vertical_area_background, .title, .parallax_section_holder').removeClass('preload_background');

        var contentHeight = content.height();
        var targetHeight = Math.max(contentHeight, $j(window).height());
        content.css({position: 'relative', height: contentHeight});

        var newHeight = newContent.height();
        //set footer top value in order to prevent footer 'jumping', padding is animated since window scroll bar is not aware of top and it is hidden
        //if($j(window).height() > newHeight){
        //    $j('footer').css('padding-top',newHeight);
        //    $j('footer.uncover').css('top',0);
        //}else{
        $j('footer').css('padding-top',$j(window).height());
        $j('footer.uncover').css('top',0);
        //}
		$j('.paspartu_outer').css('min-height', newHeight); // set min height for paspartu holder
        var windowWidth = $j(window).width();

        var hash = '#'+url.split('#')[1];
        if($j('.ajax_loader').length) {
            $j('.ajax_loader').fadeOut(400);
        };

        /* check for dark/light class - start */
        if($j('header.page_header').hasClass('light')){
            if(header_style === "dark" || header_style === ""){
                $j('header').removeClass('light').addClass(header_style);
                $j('aside.vertical_menu_area').removeClass('light').addClass(header_style);
            }
        }else if($j('header.page_header').hasClass('dark')){
            if(header_style === "light" || header_style === ""){
                $j('header').removeClass('dark').addClass(header_style);
                $j('aside.vertical_menu_area').removeClass('dark').addClass(header_style);
            }
        }else if(header_style === "light" || header_style === "dark" || header_style === ""){
            $j('header.page_header').addClass(header_style);
            $j('aside.vertical_menu_area').addClass(header_style);
        }else{
            $j('header.page_header').removeClass("left right").addClass(header_style);
            $j('aside.vertical_menu_area').removeClass("left right").addClass(header_style);
        }
        if($j('.carousel').length){
            checkSliderForHeaderStyle($j('.carousel .active'));
        }
        /* check for dark/light class - end */

        /* check for footer style class - start */

        if(footer_triangle_hide){
            $j('footer .row_triangle').addClass('disable_footer_triangle');
        }
        else{
            $j('footer .row_triangle').removeClass('disable_footer_triangle');
        }

        /* check for footer style class - end */

        /* check for page background color - start */

        if(header_color !== ""){
            $j('.header_bottom').attr('style', header_color);
        } else {
            $j('.header_bottom').removeAttr("style");
        }

        if(header_color_top !== ""){
            $j('.header_top').attr('style', header_color_top);
        } else {
            $j('.header_top').removeAttr("style");
        }

        /* check for page background color - end */

        if(transparent !== "") {
            $j('header').addClass(transparent);
        } else {
            $j('header').removeClass('transparent');
        }

        /* check for vertical menu background color and image - start */

        if(vertical_menu_background !== ""){
            $j('aside.vertical_menu_area').attr('style', vertical_menu_background);
        } else {
            $j('aside.vertical_menu_area').removeAttr("style");
        }

        if(vertical_menu_background_image !== ""){
            $j('aside.vertical_menu_area .vertical_area_background').css('opacity', 0);

            var src = image_src_regex.exec(vertical_menu_background_image);
            var backImg = new Image();
            backImg.src = src[1];
            $j(backImg).load(function(){
                setTimeout(function(){
                    $j('aside.vertical_menu_area .vertical_area_background').attr('style', vertical_menu_background_image).css('opacity', 1);
                },600); //600 is time in css transition for vertical_area_background
            });


        } else {
            $j('aside.vertical_menu_area .vertical_area_background').removeAttr("style");
        }

        /* check for vertical menu background color and image - end */

        $j('html, body').animate({scrollTop: 0}, 400, function() {

            if (animation === "ajax_updown" || animation === "ajax_updown_fade") {

                var targetTop;
                if ('down' === direction) {
                    targetTop = 0 - contentHeight;
                } else {
                    targetTop = targetHeight;
                }

                if ('down' === direction) {
                    $j('.content_wrapper').css({top: viewport.height()});
                } else {
                    $j('.content_wrapper').css({top: -newHeight});
                }

                if (animation === "ajax_updown_fade") {
                    $j('header.page_header.ajax_header_animation .drop_down > ul > li').mouseout(); // remove hover event from menu elements
					$j('header.page_header.ajax_header_animation').stop().fadeTo(animationTime, 0, function(){
						$j('header.page_header.ajax_header_animation').stop().fadeTo(animationTime, 1);
					});
					
					content.stop().fadeTo(animationTime, 0, function () {
                        $j(this).hide().remove();

                        setPageMeta(meta_data); // this function is called here since there need to be set new classes on body, before all function are called (ex. transparency class and edgt slider width)
                        $j('.content_wrapper').css({visibility: 'visible', opacity: 1}).stop().animate({top: 0}, animationTime, function () {
                            $j('.content_wrapper').find('.content').unwrap();
                            perPageBindings();
                            anchorAjaxScroll(hash);
                            initElementsAnimation();
                            initElementsHolderItemAnimation();
                            initPortfolioSingleInfo();
                            initTitleAreaAnimation();
                            initFullScreenTemplate();
                            showGoogleMap();
                            $j('.animate_title_text .title h1, .animate_title_text .title .subtitle span, .animate_title_text .breadcrumbs_title .breadcrumb').css({visibility: 'visible'});
							$j('.blog_holder.masonry').isotope('layout');
                            $j('.blog_holder.masonry_full_width').isotope('layout');
                            $j('footer').css('padding-top',0).css('top','auto'); //return top value do default because on the begining of the animation footer is moved down
                            if ($j('nav.content_menu').length > 0) {
                                content_menu_position = $j('nav.content_menu').offset().top;
                                contentMenuPosition();
								contentMenuOnScroll();
                            }
                            initParallax(); //has to be here on last place since some function is interfering with parallax
                            callCallback(callbacks, "oncomplete", null, []);
                        });
                    });
                } else {
                    content.stop().animate({top: targetTop}, animationTime, function () {
                        $j(this).hide().remove();

                        setPageMeta(meta_data); // this function is called here since there need to be set new classes on body, before all function are called (ex. transparency class and edgt slider width)
                        $j('.content_wrapper').css({visibility: 'visible', opacity: 1}).stop().animate({top: 0}, animationTime, function () {
                            $j('.content_wrapper').find('.content').unwrap();
                            perPageBindings();
                            anchorAjaxScroll(hash);
                            initElementsAnimation();
                            initElementsHolderItemAnimation();
                            initPortfolioSingleInfo();
                            initTitleAreaAnimation();
                            initFullScreenTemplate();
                            showGoogleMap();
                            $j('.animate_title_text .title h1, .animate_title_text .title .subtitle span, .animate_title_text .breadcrumbs_title .breadcrumb').css({visibility: 'visible'});
							$j('.blog_holder.masonry').isotope('layout');
                            $j('.blog_holder.masonry_full_width').isotope('layout');
                            $j('footer').css('padding-top',0).css('top','auto'); //return top value do default because on the begining of the animation footer is moved down
                            if ($j('nav.content_menu').length > 0) {
                                content_menu_position = $j('nav.content_menu').offset().top;
                                contentMenuPosition();
								contentMenuOnScroll();
                            }
                            initParallax(); //has to be here on last place since some function is interfering with parallax
                            callCallback(callbacks, "oncomplete", null, []);
                        });
                    });
                }


            } else if (animation === "ajax_fade") {
				$j('header.page_header.ajax_header_animation .drop_down > ul > li').mouseout(); // remove hover event from menu elements
				$j('header.page_header.ajax_header_animation').stop().fadeTo(animationTime, 0, function(){
					$j('header.page_header.ajax_header_animation').stop().fadeTo(animationTime, 1);
				});
				
                content.stop().fadeTo(animationTime, 0, function () {
                    $j(this).hide().remove();

                    setPageMeta(meta_data); // this function is called here since there need to be set new classes on body, before all function are called (ex. transparency class and edgt slider width)
                    $j('.content_wrapper').css({visibility: 'visible', opacity: 1, display: 'none'}).stop().fadeIn(animationTime, function () {
                        $j('.content_wrapper').find('.content').unwrap();
                        perPageBindings();
                        anchorAjaxScroll(hash);
                        initElementsAnimation();
                        initElementsHolderItemAnimation();
                        initPortfolioSingleInfo();
                        initTitleAreaAnimation();
                        initFullScreenTemplate();
                        showGoogleMap();
                        $j('.animate_title_text .title h1, .animate_title_text .title .subtitle span, .animate_title_text .breadcrumbs_title .breadcrumb').css({visibility: 'visible'});
						$j('.blog_holder.masonry').isotope('layout');
                        $j('.blog_holder.masonry_full_width').isotope('layout');
                        $j('footer').css('padding-top',0).css('top','auto'); //return top value do default because on the begining of the animation footer is moved down
                        if ($j('nav.content_menu').length > 0) {
                            content_menu_position = $j('nav.content_menu').offset().top;
                            contentMenuPosition();
							contentMenuOnScroll();
                        }
                        initParallax(); //has to be here on last place since some function is interfering with parallax
                        callCallback(callbacks, "oncomplete", null, []);
                    });
                });
            } else if (animation === "ajax_no_animation") {

                setPageMeta(meta_data); // this function is called here since there need to be set new classes on body, before all function are called (ex. transparency class and edgt slider width)
                $j('.content_wrapper').css({visibility: 'visible', opacity: 1, display: 'none'}).stop().fadeIn(0, function () {
                    $j('.content_wrapper').find('.content').unwrap();
                    perPageBindings();
                    anchorAjaxScroll(hash);
                    initElementsAnimation();
                    initElementsHolderItemAnimation();
                    initPortfolioSingleInfo();
                    initTitleAreaAnimation();
                    initFullScreenTemplate();
                    showGoogleMap();
                    $j('.animate_title_text .title h1, .animate_title_text .title .subtitle span, .animate_title_text .breadcrumbs_title .breadcrumb').css({visibility: 'visible'});
					$j('.blog_holder.masonry').isotope('layout');
                    $j('.blog_holder.masonry_full_width').isotope('layout');
                    $j('footer').css('padding-top',0).css('top','auto'); //return top value do default because on the begining of the animation footer is moved down
                    if ($j('nav.content_menu').length > 0) {
                        content_menu_position = $j('nav.content_menu').offset().top;
                        contentMenuPosition();
						contentMenuOnScroll();
                    }
                    initParallax(); //has to be here on last place since some function is interfering with parallax
                    callCallback(callbacks, "oncomplete", null, []);
                });
            }
            else if (animation === "ajax_leftright") {
                setPageMeta(meta_data); // this function is called here since there need to be set new classes on body, before all function are called (ex. transparency class and edgt slider width)

                var targetLeft;
                if ('left' === direction2) {
                    targetLeft = 0 - windowWidth;
                } else {
                    targetLeft = windowWidth;
                }
                content.stop().animate({left: targetLeft}, animationTime, function () {
                    $j(this).hide().remove();
                });
                //animate slider if it is on the page
                if(content.find('.carousel-inner:not(.relative_position)').length) {
                    content.find('.carousel-inner').animate({marginLeft: targetLeft}, animationTime);
                }

                if ('left' === direction2) {
                    $j('.content_wrapper').css({left: windowWidth});
                    if($j('.content_wrapper').find('.carousel-inner:not(.relative_position)').length) {
                        $j('.content_wrapper').find('.carousel-inner').css({left: windowWidth});
                    }
                } else {
                    $j('.content_wrapper').css({left: -windowWidth});
                    if($j('.content_wrapper').find('.carousel-inner:not(.relative_position)').length) {
                        $j('.content_wrapper').find('.carousel-inner').css({left: windowWidth});
                    }
                }
                $j('.content_wrapper').css({visibility: 'visible', opacity: 1}).stop().animate({left: 0}, animationTime, function () {
                    $j('.content_wrapper').find('.content').unwrap();
                    perPageBindings();
                    anchorAjaxScroll(hash);
                    initElementsAnimation();
                    initElementsHolderItemAnimation();
                    initPortfolioSingleInfo();
                    initTitleAreaAnimation();
                    initFullScreenTemplate();
                    showGoogleMap();
                    $j('.animate_title_text .title h1, .animate_title_text .title .subtitle span, .animate_title_text .breadcrumbs_title .breadcrumb').css({visibility: 'visible'});
					$j('.blog_holder.masonry').isotope('layout');
                    $j('.blog_holder.masonry_full_width').isotope('layout');
                    $j('footer').css('padding-top',0).css('top','auto'); //return top value do default because on the begining of the animation footer is moved down
                    if ($j('nav.content_menu').length > 0) {
                        content_menu_position = $j('nav.content_menu').offset().top;
                        contentMenuPosition();
						contentMenuOnScroll();
                    }
                    initParallax(); //has to be here on last place since some function is interfering with parallax
                    callCallback(callbacks, "oncomplete", null, []);
                });
                if($j('.content_wrapper').find('.carousel-inner:not(.relative_position)').length) {
                    $j('.content_wrapper').find('.carousel-inner').animate({left: 0}, animationTime);
                }

            }
        });
    });

    setToolBarEditLink(pageId);
}

function anchorAjaxScroll(hash){
    var scrollToAmount;
    if(hash !== undefined && $j('[data-edgt_id="'+hash+'"]').length > 0){
        
		if($window_width > 1000){
			if($j('header.page_header').hasClass('fixed') && !$j('body').hasClass('vertical_menu_enabled')){
				if($j('header.page_header').hasClass('scroll_top')){
					var top_header_height = 36;
				}else{
					var top_header_height = 0;
				}

				if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')){
					var min_header_height = $j('header.page_header').hasClass('centered_logo') ? min_header_height_scroll*2 + 20 : min_header_height_scroll; // multiple 2 times because of the logo and 20 is top+bottom margin on logo
					if(header_height - ($j('[data-edgt_id="' + hash + '"]').offset().top + top_header_height)/4 >= min_header_height){
                        var diff_of_header_and_section = $j('[data-edgt_id="' + hash + '"]').offset().top -  header_height - large_menu_item_border;
                        scrollToAmount = diff_of_header_and_section + (diff_of_header_and_section/4) + (diff_of_header_and_section/16) + (diff_of_header_and_section/64) + 1; //several times od dividing to minimize the error, because fixed header is shrinking while scroll, 1 is just to ensure
                    }else{
                        scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top -  min_header_height - large_menu_item_border;
                    }
				}else{
					scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top;
				}
			} else if($j('header.page_header').hasClass('fixed_top_header') && !$j('body').hasClass('vertical_menu_enabled')){
				if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')){
					scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top -  header_height - large_menu_item_border;
				}else{
					scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top;
				}
			} else if($j('header.page_header').hasClass('fixed_hiding') && !$j('body').hasClass('vertical_menu_enabled')){
				if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')) {
					if ($j('[data-edgt_id="' + hash + '"]').offset().top - (header_height + logo_height / 2 + 20) <= scroll_amount_for_fixed_hiding) {
						scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top - header_height - logo_height / 2 - 20; //20 is top/bottom margin of logo
					} else {
						scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top - min_header_height_fixed_hidden - 20; //20 is top/bottom margin of logo
					}
				}else{
					scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top;
				}
			}else if($j('header.page_header').hasClass('stick') || $j('header.page_header').hasClass('stick_with_left_right_menu') && !$j('body').hasClass('vertical_menu_enabled')) {
				if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')) {
					if (sticky_amount >= $j('[data-edgt_id="' + hash + '"]').offset().top) {
						scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top + 1; // 1 is to show sticky menu
					} else {
						scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top - min_header_height_sticky;
					}
				}else{
					scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top;
				}
			} else{
				scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top;
			}
		}else{
			scrollToAmount = $j('[data-edgt_id="' + hash + '"]').offset().top;
		}
        $j('html, body').animate({
            scrollTop: Math.round(scrollToAmount)
        }, 1500, function() {});
    }
}

function onLinkClicked(me) {
    "use strict";

    //check if menu is regular menu href or select menu value
    var url;

    if(me.attr('href') === undefined){
        url = me.attr('value').split(edgt_root)[1];
    }else{
        url = me.attr('href').split(edgt_root)[1];
    }

    //do nothing if active link is clicked
    if(!me.hasClass('current')){
        loadedPageFlag = false;
        return loadResource(url);
    }
}

//load new page, url:href of clicked link,
function loadResource(url) {
    "use strict";

    var me = $j("nav a[href='"+edgt_root+url+"']");

    var animationTime = $j('body').hasClass('page_not_loaded') ? 0 : PAGE_TRANSITION_SPEED;
    var direction = me.hasClass('up') ? 'up' : 'down';
    var direction2 = me.hasClass('left') ? 'left' : 'right';

    $j.ajax({
        url: edgt_root+url,
        dataType: 'html',
        async : true,
        success: function (text, status, request) {
            function insertNewPage () {
                slideInNewPage(content, text, direction, direction2, animationTime, {
                    oncomplete: function () {
                        ajaxSetActiveState(me);
                        balanceNavArrows();
                        loadedPageFlag = true;
                    }
                }, url);
            }
            insertNewPage();
            firstLoad = false;
            if (window.history.pushState) {
                var pageurl = edgt_root + url;
                if(pageurl!==window.location){
                    window.history.pushState({path:pageurl},'',pageurl);
                }

                //does Google Analytics code exists on page?
                if(typeof _gaq !== 'undefined') {
                    //add new url to Google Analytics so it can be tracked
                    _gaq.push(['_trackPageview', edgt_root+url]);
                }
            } else {
                document.location.href = edgt_root + '#/' + url;
            }
        },
        error: function () {

        },
        statusCode: {
            404: function() {
                alert('Page not found!');
            }
        }
    });

    if($j('body').hasClass('page_not_loaded')){$j('body').removeClass('page_not_loaded');}

}

if (window.history.pushState) {
    /* the below code is to override back button to get the ajax content without reload*/
    $j(window).bind('popstate', function() {
        "use strict";

        var url = location.href;
        url = url.split(edgt_root)[1];
        if (!firstLoad) {
            loadResource(url);
        }
    });
}

//show active page
function showActivePage(){
    "use strict";

    var page_id = '';
    if ((document.location.href.indexOf("?s=") >= 0) || (document.location.href.indexOf("?animation=") >= 0) || (document.location.href.indexOf("?menu=") >= 0) || (document.location.href.indexOf("?footer=") >= 0)) {
        $j("body").removeClass("page_not_loaded");
        ajaxSetActiveState($j("nav a[href='"+edgt_root+"']"));
        return;
    }

    if (document.location.href === edgt_root) {
        if (window.history.pushState) {
        } else {
            loadResource("");
        }
    }

    if (typeof document.location.href.split("#/")[1] === "undefined") {
        ajaxSetActiveState($j("a.current"));
        $j('body').removeClass('page_not_loaded');
    } else {
        page_id = document.location.href.split("#/")[1];
        if (window.history.pushState) {
        } else {
            loadResource(page_id);
        }
    }


}

var content;
var viewport;
var PAGE_TRANSITION_SPEED;
var disableHashChange = true;

$j(document).ready(function() {
    "use strict";

    PAGE_TRANSITION_SPEED = 1000;
    viewport = $j('.content');
    content = $j('.content');

    balanceNavArrows();
    //if (!window.history.pushState) {
    showActivePage();
    //}

    if($j('body').hasClass('woocommerce') || $j('body').hasClass('woocommerce-page')){
        return false;
    }else{
        $j(document).on('click','a[target!="_blank"]:not(.no_ajax):not(.no_link)',function(click){
            if(click.ctrlKey == 1) {
                window.open($j(this).attr('href'), '_blank');
                return false;
            }

            if($j(this).parent().hasClass('load_more')){ return false; }
            if($j(this).parent().parent().hasClass('blog_load_more_button')){ return false; }
			if($j(this).parent().hasClass('comments_number')){ var hash = $j(this).attr('href').split("#")[1];  $j('html, body').scrollTop( $j("#"+hash).offset().top );  return false;  }
            if(window.location.href.split('#')[0] == $j(this).attr('href').split('#')[0]){ return false; };
			if($j(this).closest('.no_animation').length === 0){
                if(document.location.href.indexOf("?s=") >= 0){
                    return true;
                }
                if($j(this).attr('href').indexOf("wp-admin") >= 0){
                    return true;
                }
                if($j(this).attr('href').indexOf("wp-content") >= 0){
                    return true;
                }
                if(jQuery.inArray($j(this).attr('href'), no_ajax_pages) !== -1){
                    document.location.href = $j(this).attr('href');
                    return false;
                }
				if($j(this).hasClass('remove_item_from_dropdown_cart')){
					document.location.href = $j(this).attr('href');
					return false;
				}
                if(($j(this).attr('href') !== "http://#") && ($j(this).attr('href') !== "#")){
                    disableHashChange = true;

                    var url = $j(this).attr('href');
                    var start = url.indexOf(edgt_root);

                    if(start === 0){
                        if(!loadedPageFlag){ return false; } //if page is not loaded don't load next one
                        click.preventDefault();
                        click.stopImmediatePropagation();
                        click.stopPropagation();
                        onLinkClicked($j(this));
                    }

                }else{
                    return false;
                }
            }
        });
    }
});