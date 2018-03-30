var $j = jQuery.noConflict();
var $scroll = 0;
var $window_width = $j(window).width();
var $window_height = $j(window).height();
var logo_height;
var logo_width;
var menu_dropdown_height_set = false;
var sticky_amount = 0;
var content_menu_position;
var content_menu_top;
var content_menu_top_add = 0;
var src;
var next_image;
var prev_image;
var $top_header_height;
var loadedPageFlag = true; //this flag is used in ajax logic to prevent multiple load of pages on multiple click. also to prevent hashClick double click also

var min_w = 1500; // minimum video width allowed
var video_width_original = 1280;  // original video dimensions
var video_height_original = 720;
var vid_ratio = 1280/720;
var skrollr_slider;
if($j('.widget_sticky-sidebar').length){
    var widgetTopOffset;
    var widgetParentOffset;
	var stickySidebarHeight;
}
var paspartu_width;


$j(document).ready(function() {
	"use strict";

	if($j('header').hasClass('regular')){
		content_menu_top = 0;
	}
	if($j('header').hasClass('fixed_top_header')){
		content_menu_top = header_height;
	}
	if($j('header').hasClass('fixed')){
		content_menu_top = min_header_height_scroll;
	}
	if($j('header').hasClass('fixed_hiding')){
		content_menu_top = min_header_height_fixed_hidden + 20; //20 is top and bottom margin of logo
	}
	if($j('header').hasClass('stick')){
		content_menu_top = 0;
	}
	if((!$j('header.page_header').hasClass('scroll_top')) && ($j('header.page_header').hasClass('has_top')) && ($j('header.page_header').hasClass('fixed') || $j('header.page_header').hasClass('fixed_hiding'))){
		content_menu_top_add = 36;
	}
    if($j('body').hasClass('vertical_menu_enabled')){
        content_menu_top = 0;
        content_menu_top_add = 0;
        var min_header_height_sticky = 0;
    }
	

    //check paspartu width depending on window size
    paspartu_width = $window_width < 1024 ? 0.02 : paspartu_width_init;

    setDropDownMenuPosition();
    initDropDownMenu();
	initVerticalMenu();
	initVerticalMobileMenu();
	initEdgeSlider();
	initSideMenu();
    initPopupMenu();
	initMessageHeight();
    initFullScreenTemplate();
	initToCounter();
	initCounter();
	initProgressBars();
	initListAnimation();
	initPieChart();
	initPieChartWithIcon();
	initParallaxTitle();
	initSideAreaScroll();
	initVerticalAreaMenuScroll();
	loadMore();
	prettyPhoto();
	initMobileMenu();
	initFlexSlider();
	fitVideo();
	initAccordion();
	initAccordionContentLink();
	initMessages();
	initProgressBarsIcon();
	initMoreFacts();
	placeholderReplace();
	backButtonShowHide();
	backToTop();
	showGoogleMap();
	initProgressBarsVertical();
	initElementsAnimation();
	initElementsHolderItemAnimation();
	updateShoppingCart();
	initHashClick();
    checkHeaderStyleOnScroll();
	initImageHover();
	initIconWithTextAnimation();
	initVideoBackground();
	initCheckSafariBrowser();
    initCheckFirefoxMacBrowser();
	initSearchButton();
	initCoverBoxes();
	createContentMenu();
	contentMenuScrollTo();
    initButtonHover();
    initSocialIconHover();
    initIconHover();
    initInteractiveBannersShader();
    showHideVerticalMenu();
    initPortfolioBlurEffect();
    initProcessHeightWidth();
	setTestimonialsEqualHeight();
    preloadBackgrounds();
    createTabIcons();
    initEdgeElementAnimationSkrollr();
    initPageTitleAnimation();
    initMasonryGallery();
    initBlogMasonryGallery();
    initMasonryBlogList();
    initPricingTableContentBackground();
    alterWPMLSwitcherHeaderBottom();
   
	$j([
		theme_root+'img/logo.png']).preload();

	$j('.widget #searchform').mousedown(function(){$j(this).addClass('form_focus');}).focusout(function(){$j(this).removeClass('form_focus');});
	$scroll = $j(window).scrollTop();
	checkTitleToShowOrHide(); //this has to be after setting $scroll since function uses $scroll variable
    checkVerticalMenuTransparency(); //this has to be after setting $scroll since function uses $scroll variable

	/* set header and content menu position and appearance on page load - START */
	if($j(window).width() > 982){ //982=1000-18, 18 is for scroll width
		headerSize($scroll);
	}else{
        logoSizeOnSmallScreens();
    }

	$j('header .edgt_logo a').css('visibility','visible');
	/* set header and content menu position and appearance on page load - END */

	if($j(window).width() > 1000){
		contentMenuPosition();
	}
	contentMenuCheckLastSection();

});

$j(window).load(function(){
	"use strict";
  
	$j('.touch .main_menu li:has(div.second)').doubleTapToGo(); // load script to close menu on touch devices
	setDropDownMenuPosition();
	initDropDownMenu();
	initPortfolio();  
	logoWidth();
	initPortfolioZIndex();
	initPortfolioSingleInfo();
	initTestimonials();
	setTestimonialsEqualHeight();
	initContentSlider();
	initVideoBackgroundSize();
	initPortfolioMasonry();
	initPortfolioMasonryFilter();
	initTabs();
    initVerticalTabsContentHeight();    
    initVerticalTabsWidth();
	animatedTextIconHeight();
	countAnimatedTextIconPerRow();
	countClientsPerRow();
	initTitleAreaAnimation();
	setContentBottomMargin();
    setVideoHeightAndWidth();
	if($j('nav.content_menu').length > 0){
		content_menu_position = $j('nav.content_menu').offset().top;
		contentMenuPosition();
		contentMenuOnScroll(); //only called on load to avoid double call id called on doc ready also
		contentMenuCheckLastSection();
		createSelectContentMenu();
	}
    initEdgeCarousel();
    initPortfolioSlider();
    initMasonryGalleryAppearance();
    initBlogSlider();
	setFooterHeight();    
	initImageGallerySliderNoSpace();
    initVerticalSplitSlider();
    initParallax(); //has to be here on last place since some function is interfering with parallax
    initSocialIconsSidebarEffect();
	if($j('.widget_sticky-sidebar').length){
        widgetTopOffset = $j('.widget_sticky-sidebar').offset().top;
        widgetParentOffset = $j('.widget_sticky-sidebar').position().top;
		stickySidebarHeight = $j('aside.sidebar').height();
    }
	if($j(window).width() > 600){
		stickySidebar($scroll, widgetTopOffset, widgetParentOffset, stickySidebarHeight);
	}
	stickySidebarWidth();
	removeStickySidebarClass();
    initEdgeElementAnimationSkrollr();
    setTimeout(function(){
        checkAnchorOnScroll();
        checkAnchorOnLoad(); // it has to be after content top margin initialization to know where to scroll
		if($j('.no-touch .carousel').length){skrollr_slider.refresh();} //in order to reload rest of scroll animation on same page after page loads
    },700); //timeout is set because of some function that interferes with calculating

});

$j(window).scroll(function() {
	"use strict";

	$scroll = $j(window).scrollTop();

	if($j(window).width() > 1000){
		headerSize($scroll);
		contentMenuPosition();
	}
	contentMenuCheckLastSection();
	
	if($j(window).width() > 600){
		stickySidebar($scroll, widgetTopOffset, widgetParentOffset, stickySidebarHeight);
	}

    checkVerticalMenuTransparency();
	logoWidth();

	$j('.touch .drop_down > ul > li').mouseleave();
	$j('.touch .drop_down > ul > li').blur();


});

$j(window).resize(function() {
	"use strict";


    $window_width = $j(window).width();
    $window_height = $j(window).height();

    //check paspartu width depending on window size
    paspartu_width = $window_width < 1024 ? 0.02 : paspartu_width_init;

	if($j(window).width() > 1000){
		headerSize($scroll);
	}else{
		logoSizeOnSmallScreens();
	}
	initMessageHeight();
	initTestimonials();
	initContentSlider();
	animatedTextIconHeight();
	countAnimatedTextIconPerRow();
	initVideoBackgroundSize();
	setContentBottomMargin();
	setFooterHeight();
    calculateHeights();
	countClientsPerRow();
	logoWidth();
    initImageGallerySliderNoSpace();
    $j('.vertical_split_slider').height($window_height); //used for vertical split slider holder
    initParallax();
	setTestimonialsEqualHeight();
	if($j(window).width() > 600){
		stickySidebarHeight = $j('aside.sidebar').height();
		stickySidebar($scroll, widgetTopOffset, widgetParentOffset, stickySidebarHeight);
	}
	stickySidebarWidth();
	removeStickySidebarClass();
    initBlogSlider();
    initMasonryGallery();
    initBlogMasonryGallery();
    initMasonryBlogList();
});

/*
 **	Calculating header size on page load and page scroll
 */
var sticky_animate;
function headerSize($scroll){
    "use strict";



    if(($j('header.page_header').hasClass('scroll_top')) && ($j('header.page_header').hasClass('has_top')) && ($j('header.page_header').hasClass('fixed'))){
        if($scroll >= 0 && $scroll <= 36){
            $j('header.page_header').css('top',-$scroll);
            $j('header.page_header').css('margin-top',0);
            $j('.header_top').show();
        }else if($scroll > 36){
            $j('header.page_header').css('top','-36px');
            $j('header.page_header').css('margin-top',36);
            $j('.header_top').hide();
        }
    }

    //is scroll amount for sticky set on page?
	if(typeof page_scroll_amount_for_sticky !== 'undefined') {
		sticky_amount = page_scroll_amount_for_sticky;
	}
	//do we have slider on the page?
	else if($j('.carousel.full_screen').length) {
		sticky_amount = $j('.carousel').height();
	}

	//take value from theme options
	else {
		sticky_amount = scroll_amount_for_sticky;
	}

    //set control class for Edge Slider in order to change header style
    if($j('.edgt_slider .carousel').length) {
        if($j('.carousel').height() < $scroll){
            $j('.carousel').addClass('disable_slider_header_style_changing');
        }else{
            $j('.carousel').removeClass('disable_slider_header_style_changing');
            checkSliderForHeaderStyle($j('.edgt_slider .carousel .active'),$j('.edgt_slider .carousel').hasClass('header_effect'));
        }
    }

    if($j('header.page_header').hasClass('regular')){
    	if(header_height - logo_height > 0){
            $j('.edgt_logo a').height(logo_height);
        }else{
            $j('.edgt_logo a').height(header_height);
        }

        $j('.edgt_logo a img').css('height','100%');
    }

    if($j('header.page_header').hasClass('fixed')){
        if($j('header.page_header').hasClass('scroll_top')){
            $top_header_height = 36;
        }else{
            $top_header_height = 0;
        }

        if((header_height - ($scroll - $top_header_height)/4 >= min_header_height_scroll) && ($scroll >= $top_header_height)){
            $j('header.page_header').removeClass('scrolled');
            $j('header nav.main_menu > ul > li > a').css('line-height', header_height - ($scroll - $top_header_height)/4+'px');
            $j('header .side_menu_button').css('height', header_height + large_menu_item_border - ($scroll - $top_header_height)/4+'px');
            $j('header .header_bottom_right_widget_holder').css('height', header_height + large_menu_item_border - ($scroll - $top_header_height)/4+'px');
            $j('header .shopping_cart_inner').css('height', header_height + large_menu_item_border  - ($scroll - $top_header_height)/4+'px');
            $j('header .logo_wrapper').css('height', header_height + large_menu_item_border - ($scroll - $top_header_height)/4 +'px');
            $j('.side_menu .close_side_menu_holder').css('height', header_height + large_menu_item_border - ($scroll - $top_header_height)/4 +'px');
            if(header_height - logo_height > 0){
                $j('header .edgt_logo a').css('height', logo_height +'px');
            }else{
                $j('header .edgt_logo a').css('height', (header_height + large_menu_item_border - ($scroll - $top_header_height)/4) +'px');
            }

        }else if($scroll < $top_header_height){
            $j('header.page_header').removeClass('scrolled');
            $j('header nav.main_menu > ul > li > a').css('line-height', header_height+'px');
            $j('header .side_menu_button').css('height', header_height+large_menu_item_border+'px');
            $j('header .header_bottom_right_widget_holder').css('height', header_height+large_menu_item_border+'px');
            $j('header .shopping_cart_inner').css('height', header_height+large_menu_item_border+'px');
            $j('header .logo_wrapper').css('height', header_height+large_menu_item_border+'px');
            $j('.side_menu .close_side_menu_holder').css('height', header_height+large_menu_item_border+'px');
            if(header_height - logo_height > 0){
                $j('header .edgt_logo a').css('height', logo_height +'px');
            }else{
                $j('header .edgt_logo a').css('height', header_height+large_menu_item_border +'px');
            }

        }else if((header_height - ($scroll - $top_header_height)/4) < min_header_height_scroll){
            $j('header.page_header').addClass('scrolled');
            $j('header nav.main_menu > ul > li > a').css('line-height', min_header_height_scroll+'px');
            $j('header .side_menu_button').css('height', min_header_height_scroll+large_menu_item_border+'px');
            $j('header .header_bottom_right_widget_holder').css('height', min_header_height_scroll+large_menu_item_border+'px');
            $j('header .shopping_cart_inner').css('height', min_header_height_scroll+large_menu_item_border+'px');
            $j('header .logo_wrapper').css('height', min_header_height_scroll+large_menu_item_border+'px');
            $j('.side_menu .close_side_menu_holder').css('height', min_header_height_scroll+large_menu_item_border+'px');
            if(min_header_height_scroll - logo_height > 0){
                $j('header .edgt_logo a').css('height', logo_height +'px');
            }else{
                $j('header .edgt_logo a').css('height', min_header_height_scroll+large_menu_item_border+'px');
            }
        }

        // logo part - start //

        //if($j('header.page_header').hasClass('centered_logo')){
            if((header_height - ($scroll - $top_header_height)/4 < logo_height) && (header_height - ($scroll - $top_header_height)/4 >= min_header_height_scroll) && (logo_height > min_header_height_scroll) && ($scroll >= $top_header_height)){
                $j('.edgt_logo a').height(header_height - ($scroll - $top_header_height)/4);
            }else if((header_height - ($scroll - $top_header_height)/4 < logo_height) && (header_height - ($scroll - $top_header_height)/4 >= min_header_height_scroll) && (logo_height > min_header_height_scroll) && ($scroll < $top_header_height)){
                $j('.edgt_logo a').height(header_height);
            }else if((header_height - ($scroll - $top_header_height)/4 < logo_height) && (header_height - ($scroll - $top_header_height)/4 < min_header_height_scroll) && (logo_height > min_header_height_scroll)){
                $j('.edgt_logo a').height(min_header_height_scroll);
            }else if((header_height - ($scroll - $top_header_height)/4 < logo_height) && (header_height - ($scroll - $top_header_height)/4 < min_header_height_scroll) && (logo_height < min_header_height_scroll)){
                $j('.edgt_logo a').height(logo_height);
            }else if((($scroll - $top_header_height)/4 === 0) && (logo_height > header_height)){
                $j('.edgt_logo a').height(logo_height);
            }else{
                $j('.edgt_logo a').height(logo_height);
            }

        //}else{
        //    $j('.edgt_logo img').height('100%');
        //}
        // logo part - end //
    }

    if($j('header.page_header').hasClass('fixed_hiding')){

        if($scroll < scroll_amount_for_fixed_hiding){
            $j('header.page_header').removeClass('scrolled');
        }else{
            $j('header.page_header').addClass('scrolled');
        }

        $j('.edgt_logo a').height(logo_height/2); //because of retina displays
        $j('.edgt_logo img').height('100%');
    }

    if($j('header.page_header').hasClass('stick') || $j('header.page_header').hasClass('stick_with_left_right_menu')){
        if($scroll > sticky_amount){
            if(!$j('header.page_header').hasClass('sticky')){
                if($j('header.page_header').hasClass('has_top')){
                    $top_header_height = 34;
                }else{
                    $top_header_height = 0;
                }
                var sticky_expanded_add = $j('header.page_header').hasClass('menu_bottom')? 60 : 0; //60 is height of menu on 'sticky advanced' header
                var padding_top = $j('header.page_header').hasClass('centered_logo') ? $j('header.page_header').height() : header_height + $top_header_height + large_menu_item_border + sticky_expanded_add;

                $j('header.page_header').addClass('sticky');
                $j('.side_menu').addClass('sticky');
                $j('.content').css('padding-top',padding_top);

                window.clearTimeout(sticky_animate);
                sticky_animate = window.setTimeout(function(){$j('header.page_header').addClass('sticky_animate');},100);

                //  logo part - start //
                if(min_header_height_sticky - logo_height/2 > 0){
                    $j('.edgt_logo a').height(logo_height/2);
                }else{
                    $j('.edgt_logo a').height(min_header_height_sticky);
                }

                //for sticky divided when scrolled - start
                if($j('header.page_header').hasClass('stick_with_left_right_menu')) {
                    
					//check if sticky image is loaded, if not, wait for it to load - this is chrome fix
					if($j('header .edgt_logo a img.sticky').get(0).complete){
						var logo_width_sticky_divided_scrolled = $j('header .edgt_logo a img.sticky').width();
						$j('.logo_wrapper').width(logo_width_sticky_divided_scrolled); // because of retina logo
						$j('nav.main_menu.left_side').attr('style','padding-right:' + logo_width_sticky_divided_scrolled/2 + "px !important;");
						$j('nav.main_menu.right_side').attr('style','padding-left:' + logo_width_sticky_divided_scrolled/2 + "px !important;");
					}else{
						$j('header .edgt_logo a img.sticky').load(function(){
							var logo_width_sticky_divided_scrolled = $j('header .edgt_logo a img.sticky').width();
							$j('.logo_wrapper').width(logo_width_sticky_divided_scrolled); // because of retina logo
							$j('nav.main_menu.left_side').attr('style','padding-right:' + logo_width_sticky_divided_scrolled/2 + "px !important;");
							$j('nav.main_menu.right_side').attr('style','padding-left:' + logo_width_sticky_divided_scrolled/2 + "px !important;");
						});
					}
					
                }
                //for sticky divided when scrolled - end

                //  logo part - end //

                if($j('header.page_header').hasClass('menu_bottom')){
                    initDropDownMenu(); //recalculate dropdown menu position
                }
            }

            //  logo part - start  called again since page could be scrolled on load//
            if(min_header_height_sticky - logo_height/2 > 0){
                $j('.edgt_logo a').height(logo_height/2);
            }else{
                $j('.edgt_logo a').height(min_header_height_sticky);
            }
            //  logo part - end //
        }else{
            if($j('header.page_header').hasClass('sticky')){
                $j('header').removeClass('sticky_animate');
                $j('header').removeClass('sticky');
                $j('.side_menu').removeClass('sticky');
                $j('.content').css('padding-top','0px');

                if($j('header.page_header').hasClass('menu_bottom')){
                    initDropDownMenu(); //recalculate dropdown menu position
                }
            }

            // logo part - start //
            if(!$j('header.page_header').hasClass('centered_logo')){
                if(header_height - logo_height/2 > 0){
                    $j('.edgt_logo a').height(logo_height/2);
                }else{
                    $j('.edgt_logo a').height(header_height);
                }
            }else{
                $j('.edgt_logo a').height(logo_height/2);
                $j('.edgt_logo img').height('auto');
            }
            $j('.edgt_logo a img').css('height','100%');

            //for sticky devided when scrolled - start
            if($j('header.page_header').hasClass('stick_with_left_right_menu')) {
                //var logo_width_sticky_divided_scrolled = $j('header .edgt_logo a img.normal').width() == 0 ? logo_width/2 : $j('header .edgt_logo a img.normal').width(); //because server sometimes returns 0 for logo width
                var logo_width_sticky_divided_scrolled = logo_width/2; //because server sometimes returns 0 for logo width
                $j('.logo_wrapper').width(logo_width_sticky_divided_scrolled); // because of retina logo
                $j('nav.main_menu.left_side').attr('style','padding-right:' + logo_width_sticky_divided_scrolled/2 + "px !important;");
                $j('nav.main_menu.right_side').attr('style','padding-left:' + logo_width_sticky_divided_scrolled/2 + "px !important;");
            }
            //for sticky devided when scrolled - end
            // logo part - end //

        }
    }
}

/*
** Sticky sidebar
*/
var headerHeightOffset = 0;

function stickySidebar($scroll, widgetTopOffset, widgetParentOffset, stickySidebarHeight){
	"use strict";
	if($j('.widget_sticky-sidebar').length){
	
		if($j('.content_right_from_sidebar').length){
			var sidebarWidth = $j('aside.sidebar').parent().innerWidth();
		}	
		
		if($j('header.page_header').hasClass('regular') || $j(window).width() <= 1000){
			
			headerHeightOffset =0;
			
		}else if($j('header.page_header').hasClass('fixed_top_header')){
		
			headerHeightOffset = $j('header.page_header .top_header').height();
		
		}else if($j('header.page_header').hasClass('stick') || $j('header.page_header').hasClass('stick_with_left_right_menu')) {
            if(sticky_amount > widgetTopOffset) {
                if (sticky_amount >= $scroll) {
                    headerHeightOffset = 0;
                    setTimeout(function () {
                        $j('.sidebar').removeClass('sticky_sidebar_animate_top');
                    }, 330); //because this needs delay until animation in css is finished (0.2s)

                } else {
                    headerHeightOffset = $j('header.page_header').height();
                    $j('.sidebar').addClass('sticky_sidebar_animate_top');
                }
            }else {
                headerHeightOffset = $j('header.page_header').height();
            }
        } else{
            headerHeightOffset = $j('header.page_header').height();
		}

		if($scroll >= widgetTopOffset - headerHeightOffset){
			var sidebarPosition= -(widgetParentOffset - headerHeightOffset);
			$j('.sidebar').addClass('sticky_sidebar');
			$j('.sidebar.sticky_sidebar').css('top',sidebarPosition + 'px');
			if($j('.content_right_from_sidebar').length){
				$j('.column2.content_right_from_sidebar').css('padding-left',sidebarWidth + 'px');
			}
			
			//move sidebar up when hits the footer
			
			var footer_in_viewport =0;
			var uncover_footer=0;
			if($j('.uncover').length){
				uncover_footer = parseInt($j('.content').css('margin-bottom'));
				footer_in_viewport = $j(document).height() - $window_height - uncover_footer;
			}else{
				footer_in_viewport = $j('footer').offset().top - $window_height;
			} 
			
			var sidebar_from_bottom_of_screen = $window_height - (stickySidebarHeight + 40 + sidebarPosition); //40 is for sidebar bottom margin
			
			if($scroll - footer_in_viewport > sidebar_from_bottom_of_screen){
				$j('.sidebar.sticky_sidebar').css('margin-top', -($scroll - footer_in_viewport - sidebar_from_bottom_of_screen));
			}else{
				$j('.sidebar.sticky_sidebar').css('margin-top',0);
			}
			
			
		} else{
			$j('.sidebar').removeClass('sticky_sidebar');
			$j('.sidebar').css('top','0');
			if($j('.content_right_from_sidebar').length){
				$j('.column2.content_right_from_sidebar').css('padding-left','0');
			}
		}	
			
	}
}


/*
** Sticky sidebar width
*/

function stickySidebarWidth(){
	"use strict";
	if($j('.widget_sticky-sidebar').length){
		var sidebarWidth = $j('aside.sidebar').parent().width();
		$j('.sidebar').css('width',sidebarWidth + 'px');
	}
}

function removeStickySidebarClass(){
	"use strict";
	if($j('.widget_sticky-sidebar').length){
		if($j(window).width() <= 600){
			if($j('.sidebar').hasClass('sticky_sidebar')){
				$j('.sidebar').removeClass('sticky_sidebar sticky_sidebar_animate_top');
				$j('.sidebar').css('width','auto');
				$j('.sidebar').css('top','auto');
				if($j('.content_right_from_sidebar').length){
					$j('.column2.content_right_from_sidebar').css('padding-left','0');
				}
			}
		}
	}
}

/*
**	Calculating logo width
*/
function logoWidth(){
	"use strict";
	if($j('.left_menu_position').length){
		if($j('header').hasClass('sticky')){
			var l_width = $j('header .edgt_logo a img.sticky').width();
			$j('header .logo_wrapper').css('width', l_width +'px');
		} else {
			var l_width = $j('header .edgt_logo a img.normal').width();
			$j('header .logo_wrapper').css('width', l_width +'px');
		}
	}
}

/*
**	Calculating logo size on smaller screens
*/
function logoSizeOnSmallScreens(){
	"use strict";

	$j('.edgt_logo a img').css('height','100%');

	$j('header.page_header').removeClass('sticky_animate sticky');
	$j('.content').css('padding-top','0px');
}

/*
**	Initialize Edge Slider
*/
var default_header_style;
function initEdgeSlider(){
	"use strict";

	var image_regex = /url\(["']?([^'")]+)['"]?\)/;
	default_header_style = "";
	if($j('header.page_header').hasClass('light')){ default_header_style = 'light';}
	if($j('header.page_header').hasClass('dark')){ default_header_style = 'dark';}

	if($j('.carousel').length){
		var matrixArray = { zoom_center : '1.2, 0, 0, 1.2, 0, 0', zoom_top_left: '1.2, 0, 0, 1.2, -150, -150', zoom_top_right : '1.2, 0, 0, 1.2, 150, -150', zoom_bottom_left: '1.2, 0, 0, 1.2, -150, 150', zoom_bottom_right: '1.2, 0, 0, 1.2, 150, 150'};
		
		// Function for translating image in slide - START //
		(function ($) {
			//
			// regular expression for parsing out the matrix
			// components from the matrix string
			//
			var matrixRE = /\([0-9epx\.\, \t\-]+/gi;

			//
			// parses a matrix string of the form
			// "matrix(n1,n2,n3,n4,n5,n6)" and
			// returns an array with the matrix
			// components
			//
			var parseMatrix = function (val) {
				return val.match(matrixRE)[0].substr(1).
						  split(",").map(function (s) {
					return parseFloat(s);
				});
			};
			
			//
			// transform css property names with vendor prefixes;
			// the plugin will check for values in the order the 
			// names are listed here and return as soon as there
			// is a value; so listing the W3 std name for the
			// transform results in that being used if its available
			//
			var transformPropNames = [
				"transform",
				"-webkit-transform"
			];

			var getTransformMatrix = function (el) {
				//
				// iterate through the css3 identifiers till we
				// hit one that yields a value
				//
				var matrix = null;
				transformPropNames.some(function (prop) {
					matrix = el.css(prop);
					return (matrix !== null && matrix !== "");
				});

				//
				// if "none" then we supplant it with an identity matrix so
				// that our parsing code below doesn't break
				//
				matrix = (!matrix || matrix === "none") ?
							  "matrix(1,0,0,1,0,0)" : matrix;
				return parseMatrix(matrix);
			};

			//
			// set the given matrix transform on the element; note that we
			// apply the css transforms in reverse order of how its given
			// in "transformPropName" to ensure that the std compliant prop
			// name shows up last
			//
			var setTransformMatrix = function (el, matrix) {
				var m = "matrix(" + matrix.join(",") + ")";
				for (var i = transformPropNames.length - 1; i >= 0; --i) {
					el.css(transformPropNames[i], m);
				}
			};
			
			//
			// interpolates a value between a range given a percent
			//
			var interpolate = function (from, to, percent) {
				return from + ((to - from) * (percent / 100));
			};

			$.fn.transformAnimate = function (opt) {
				//
				// extend the options passed in by caller
				//
				var options = {
					transform: "matrix(1,0,0,1,0,0)"
				};
				$.extend(options, opt);

				//
				// initialize our custom property on the element
				// to track animation progress
				//
				this.css("percentAnim", 0);

				//
				// supplant "options.step" if it exists with our own
				// routine
				//
				var sourceTransform = getTransformMatrix(this);
				var targetTransform = parseMatrix(options.transform);
				options.step = function (percentAnim, fx) {
					//
					// compute the interpolated transform matrix for
					// the current animation progress
					//
					var $this = $(this);
					var matrix = sourceTransform.map(function (c, i) {
						return interpolate(c, targetTransform[i], 
								 percentAnim);
					});

					//
					// apply the new matrix
					//
					setTransformMatrix($this, matrix);

					//
					// invoke caller's version of "step" if one
					// was supplied;
					//
					if (opt.step) {
						opt.step.apply(this, [matrix, fx]);
					}
				};

				//
				// animate!
				//
				return this.stop().animate({ percentAnim: 100 }, options);
			};
		})(jQuery);
		// Function for translating image in slide - END //
		
		$j('.carousel').each(function(){
			var $this = $j(this);
			var mobile_header = $window_width < 1000 ? $j('header.page_header').height() : 0;
            var header_height_add_for_paspartu = $window_width > 1000 && !$j('header.page_header').hasClass('transparent') ? $j('header.page_header').height() : 0;
            var paspartu_amount_with_top_bottom = $j('.paspartu_outer:not(.disable_top_paspartu):not(.paspartu_on_bottom_slider)').length > 0 ? Math.round($window_width*paspartu_width*2 + header_height_add_for_paspartu) : 0; // paspartu_width * 2 times top and bottom paspartu
            var paspartu_amount_with_bottom = $j('.paspartu_outer.paspartu_on_bottom_slider').length > 0 ? Math.round($window_width*paspartu_width) : 0;
            var slider_graphic_coefficient;
            var slider_title_coefficient;
            var slider_subtitle_coefficient;
            var slider_text_coefficient;
            var slider_button_coefficient;

            var responsive_breakpoint_set = [1600,1200,900,650,500,320];
            if($this.data('edgt_responsive_breakpoints')){
                if($this.data('edgt_responsive_breakpoints') == 'set2'){
                    responsive_breakpoint_set = [1600,1300,1000,768,567,320];
                }
            }

            var coefficients_graphic_array = $this.data('edgt_responsive_graphic_coefficients').split(',');
            var coefficients_title_array = $this.data('edgt_responsive_title_coefficients').split(',');
            var coefficients_subtitle_array = $this.data('edgt_responsive_subtitle_coefficients').split(',');
            var coefficients_text_array = $this.data('edgt_responsive_text_coefficients').split(',');
            var coefficients_button_array = $this.data('edgt_responsive_button_coefficients').split(',');

            //calculate heights for slider holder and slide item, depending on size, but only if slider is set to be responsive and not full screen
            function setSliderHeight($this, $def_height){
                var slider_height = $def_height;
                if($window_width > responsive_breakpoint_set[0]){
                    slider_height = $def_height;
                }else if($window_width > responsive_breakpoint_set[1]){
                    slider_height = $def_height * 0.75;
                }else if($window_width > responsive_breakpoint_set[2]){
                    slider_height = $def_height * 0.6;
                }else if($window_width > responsive_breakpoint_set[3]){
                    slider_height = $def_height * 0.55;
                }else if($window_width <= responsive_breakpoint_set[3]){
                    slider_height = $def_height * 0.45;
                }

                $this.css({'height': (slider_height) + 'px'});
                $this.find('.edgt_slider_preloader').css({'height': (slider_height) + 'px'});
                $this.find('.edgt_slider_preloader .ajax_loader').css({'display': 'block'});
                $this.find('.item').css({'height': (slider_height) + 'px'});
            }

            function resetSliderHeight($def_height){
                $this.css({'height': ($def_height) + 'px'});
                $this.find('.edgt_slider_preloader').css({'height': ($def_height) + 'px'});
                $this.find('.edgt_slider_preloader .ajax_loader').css({'display': 'block'});
                $this.find('.item').css({'height': ($def_height) + 'px'});
            }

            function setSliderInitialElementsSize($item,i){
                window["slider_graphic_width_" + i] = [];
                window["slider_graphic_height_" + i] = [];
                window["slider_svg_width_" + i] = [];
                window["slider_svg_height_" + i] = [];
                window["slider_title_" + i] = [];
                window["slider_subtitle_" + i] = [];
                window["slider_text_" + i] = [];
                window["slider_text_separator_" + i] = [];
                window["slider_text_separator_width_" + i] = [];
                window["slider_button1_" + i] = [];
                window["slider_button2_" + i] = [];
                window["slider_top_separator_" + i] = [];
                window["slider_bottom_separator_" + i] = [];

                //graphic size
                window["slider_graphic_width_" + i].push(parseFloat($item.find('.thumb img').data("width")));
                window["slider_graphic_height_" + i].push(parseFloat($item.find('.thumb img').data("height")));
                window["slider_svg_width_" + i].push(parseFloat($item.find('.edgt_slide-svg-holder svg').attr("width")));
                window["slider_svg_height_" + i].push(parseFloat($item.find('.edgt_slide-svg-holder svg').attr("height")));

                // font-size (0)
                window["slider_title_" + i].push(parseFloat($item.find('.edgt_slide_title').css("font-size")));
                window["slider_subtitle_" + i].push(parseFloat($item.find('.edgt_slide_subtitle').css("font-size")));
                window["slider_text_" + i].push(parseFloat($item.find('.edgt_slide_text').css("font-size")));
                window["slider_button1_" + i].push(parseFloat($item.find('.qbutton:eq(0)').css("font-size")));
                window["slider_button2_" + i].push(parseFloat($item.find('.qbutton:eq(1)').css("font-size")));
                window["slider_text_separator_" + i].push(parseFloat($item.find('.separator_content').css("font-size")));

                // line-height (1)
                window["slider_title_" + i].push(parseFloat($item.find('.edgt_slide_title').css("line-height")));
                window["slider_subtitle_" + i].push(parseFloat($item.find('.edgt_slide_subtitle').css("line-height")));
                window["slider_text_" + i].push(parseFloat($item.find('.edgt_slide_text').css("line-height")));
                window["slider_button1_" + i].push(parseFloat($item.find('.qbutton:eq(0)').css("line-height")));
                window["slider_button2_" + i].push(parseFloat($item.find('.qbutton:eq(1)').css("line-height")));
                window["slider_text_separator_" + i].push(parseFloat($item.find('.separator_content').css("line-height")));

                // letter-spacing (2)
                window["slider_title_" + i].push(parseFloat($item.find('.edgt_slide_title').css("letter-spacing")));
                window["slider_subtitle_" + i].push(parseFloat($item.find('.edgt_slide_subtitle').css("letter-spacing")));
                window["slider_text_" + i].push(parseFloat($item.find('.edgt_slide_text').css("letter-spacing")));
                window["slider_button1_" + i].push(parseFloat($item.find('.qbutton:eq(0)').css("letter-spacing")));
                window["slider_button2_" + i].push(parseFloat($item.find('.qbutton:eq(1)').css("letter-spacing")));
                window["slider_text_separator_" + i].push(parseFloat($item.find('.separator_content').css("letter-spacing")));

                // margin-bottom (3)
                window["slider_title_" + i].push(parseFloat($item.find('.edgt_slide_title').css("margin-bottom")));
                window["slider_subtitle_" + i].push(parseFloat($item.find('.edgt_slide_subtitle').css("margin-bottom")));

                // slider_button height(3), width(4), padding(5)
                window["slider_button1_" + i].push(parseFloat($item.find('.qbutton:eq(0)').css("height")));
                window["slider_button2_" + i].push(parseFloat($item.find('.qbutton:eq(1)').css("height")));
                if(parseFloat($item.find('.qbutton:eq(0)').css("width")) != 0){
                    window["slider_button1_" + i].push(parseFloat($item.find('.qbutton:eq(0)').css("width")));
                }else{
                    window["slider_button1_" + i].push(0);
                }
                if(parseFloat($item.find('.qbutton:eq(1)').css("width")) != 0){
                    window["slider_button2_" + i].push(parseFloat($item.find('.qbutton:eq(1)').css("width")));
                }else{
                    window["slider_button2_" + i].push(0);
                }
                window["slider_button1_" + i].push(parseFloat($item.find('.qbutton:eq(0)').css("padding-left")));
                window["slider_button2_" + i].push(parseFloat($item.find('.qbutton:eq(1)').css("padding-left")));

                // margin separator top margin top(0), margin bottom(1)
                window["slider_top_separator_" + i].push(parseFloat($item.find('.separator_top').css("margin-top")));
                window["slider_top_separator_" + i].push(parseFloat($item.find('.separator_top').css("margin-bottom")));

                // margin separator bottom margin top(0), margin bottom(1)
                window["slider_bottom_separator_" + i].push(parseFloat($item.find('.separator_bottom').css("margin-top")));
                window["slider_bottom_separator_" + i].push(parseFloat($item.find('.separator_bottom').css("margin-bottom")));

                //text separator width
                window["slider_text_separator_width_" + i].push(parseFloat($item.find('.edgt_line_before').css("width")));
            }

            //calculate size for slider title, subtitle and text, depending on window size
            function setSliderElementsSize($item,i){

                if($window_width > responsive_breakpoint_set[0]) {
                    slider_graphic_coefficient = coefficients_graphic_array[0];
                    slider_title_coefficient = coefficients_title_array[0];
                    slider_subtitle_coefficient = coefficients_subtitle_array[0];
                    slider_text_coefficient = coefficients_text_array[0];
                    slider_button_coefficient = coefficients_button_array[0];
                }else if($window_width > responsive_breakpoint_set[1]){
                    slider_graphic_coefficient = coefficients_graphic_array[1];
                    slider_title_coefficient = coefficients_title_array[1];
                    slider_subtitle_coefficient = coefficients_subtitle_array[1];
                    slider_text_coefficient = coefficients_text_array[1];
                    slider_button_coefficient = coefficients_button_array[1];
                }else if($window_width > responsive_breakpoint_set[2]){
                    slider_graphic_coefficient = coefficients_graphic_array[2];
                    slider_title_coefficient = coefficients_title_array[2];
                    slider_subtitle_coefficient = coefficients_subtitle_array[2];
                    slider_text_coefficient = coefficients_text_array[2];
                    slider_button_coefficient = coefficients_button_array[2];
                }else if($window_width > responsive_breakpoint_set[3]){
                    slider_graphic_coefficient = coefficients_graphic_array[3];
                    slider_title_coefficient = coefficients_title_array[3];
                    slider_subtitle_coefficient = coefficients_subtitle_array[3];
                    slider_text_coefficient = coefficients_text_array[3];
                    slider_button_coefficient = coefficients_button_array[3];
                }else if ($window_width > responsive_breakpoint_set[4]) {
                    slider_graphic_coefficient = coefficients_graphic_array[4];
                    slider_title_coefficient = coefficients_title_array[4];
                    slider_subtitle_coefficient = coefficients_subtitle_array[4];
                    slider_text_coefficient = coefficients_text_array[4];
                    slider_button_coefficient = coefficients_button_array[4];
                }else if ($window_width > responsive_breakpoint_set[5]){
                    slider_graphic_coefficient = coefficients_graphic_array[5];
                    slider_title_coefficient = coefficients_title_array[5];
                    slider_subtitle_coefficient = coefficients_subtitle_array[5];
                    slider_text_coefficient = coefficients_text_array[5];
                    slider_button_coefficient = coefficients_button_array[5];
                }
                else{
                    slider_graphic_coefficient = coefficients_graphic_array[6];
                    slider_title_coefficient = coefficients_title_array[6];
                    slider_subtitle_coefficient = coefficients_subtitle_array[6];
                    slider_text_coefficient = coefficients_text_array[6];
                    slider_button_coefficient = coefficients_button_array[6];
                }

                // letter-spacing decrease quicker
                var slider_title_coefficient_letter_spacing = slider_title_coefficient;
                var slider_subtitle_coefficient_letter_spacing = slider_subtitle_coefficient;
                var slider_text_coefficient_letter_spacing = slider_text_coefficient;
                if($window_width <= responsive_breakpoint_set[0]) {
                    slider_title_coefficient_letter_spacing = slider_title_coefficient/2;
                    slider_subtitle_coefficient_letter_spacing = slider_subtitle_coefficient/2;
                    slider_text_coefficient_letter_spacing = slider_text_coefficient/2;
                }

                $item.find('.thumb').css({"width": Math.round(window["slider_graphic_width_" + i][0]*slider_graphic_coefficient) + 'px'}).css({"height": Math.round(window["slider_graphic_height_" + i][0]*slider_graphic_coefficient) + 'px'});
                $item.find('.edgt_slide-svg-holder svg').css({"width": Math.round(window["slider_svg_width_" + i][0]*slider_graphic_coefficient) + 'px'}).css({"height": Math.round(window["slider_svg_height_" + i][0]*slider_graphic_coefficient) + 'px'});

                $item.find('.edgt_slide_title').css({"font-size": Math.round(window["slider_title_" + i][0]*slider_title_coefficient) + 'px'});
                $item.find('.edgt_slide_title').css({"line-height": Math.round(window["slider_title_" + i][1]*slider_title_coefficient) + 'px'});
                $item.find('.edgt_slide_title').css({"letter-spacing": Math.round(window["slider_title_" + i][2]*slider_title_coefficient_letter_spacing) + 'px'});
                $item.find('.edgt_slide_title').css({"margin-bottom": Math.round(window["slider_title_" + i][3]*slider_title_coefficient) + 'px'});

                $item.find('.edgt_slide_subtitle').css({"font-size": Math.round(window["slider_subtitle_" + i][0]*slider_subtitle_coefficient) + 'px'});
                $item.find('.edgt_slide_subtitle').css({"line-height": Math.round(window["slider_subtitle_" + i][1]*slider_subtitle_coefficient) + 'px'});
                $item.find('.edgt_slide_subtitle').css({"letter-spacing": Math.round(window["slider_subtitle_" + i][2]*slider_subtitle_coefficient_letter_spacing) + 'px'});
                $item.find('.edgt_slide_subtitle').css({"margin-bottom": Math.round(window["slider_subtitle_" + i][3]*slider_subtitle_coefficient) + 'px'});

                $item.find('.edgt_slide_text').css({"font-size": Math.round(window["slider_text_" + i][0]*slider_text_coefficient) + 'px'});
                $item.find('.edgt_slide_text').css({"line-height": Math.round(window["slider_text_" + i][1]*slider_text_coefficient) + 'px'});
                $item.find('.edgt_slide_text').css({"letter-spacing": Math.round(window["slider_text_" + i][2]*slider_text_coefficient_letter_spacing) + 'px'});

                $item.find('.separator_content').css({"font-size": Math.round(window["slider_text_separator_" + i][0]*slider_text_coefficient) + 'px'});
                $item.find('.separator_content').css({"line-height": Math.round(window["slider_text_separator_" + i][1]*slider_text_coefficient) + 'px'});
                $item.find('.separator_content').css({"letter-spacing": Math.round(window["slider_text_separator_" + i][2]*slider_text_coefficient_letter_spacing) + 'px'});

                $item.find('.edgt_line_before').css({"width": Math.round(window["slider_text_separator_width_" + i][0]*slider_text_coefficient) + 'px'});
                $item.find('.edgt_line_after').css({"width": Math.round(window["slider_text_separator_width_" + i][0]*slider_text_coefficient) + 'px'});

                $item.find('.qbutton:eq(0)').css({"font-size": Math.round(window["slider_button1_" + i][0]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(1)').css({"font-size": Math.round(window["slider_button2_" + i][0]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(0)').css({"line-height": Math.round(window["slider_button1_" + i][1]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(1)').css({"line-height": Math.round(window["slider_button2_" + i][1]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(0)').css({"letter-spacing": Math.round(window["slider_button1_" + i][2]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(1)').css({"letter-spacing": Math.round(window["slider_button2_" + i][2]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(0)').css({"height": Math.round(window["slider_button1_" + i][3]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(1)').css({"height": Math.round(window["slider_button2_" + i][3]*slider_button_coefficient) + 'px'});
                if(window["slider_button1_" + i][4] != 0) {
                    $item.find('.qbutton:eq(0)').css({"width": Math.round(window["slider_button1_" + i][4]*slider_button_coefficient) + 'px'});
                }else{
                    $item.find('.qbutton:eq(0)').css({"width": 'auto'});
                }
                if(window["slider_button2_" + i][4] != 0) {
                    $item.find('.qbutton:eq(1)').css({"width": Math.round(window["slider_button2_" + i][4]*slider_button_coefficient) + 'px'});
                }else{
                    $item.find('.qbutton:eq(1)').css({"width": 'auto'});
                }
                $item.find('.qbutton:eq(0)').css({"padding-left": Math.round(window["slider_button1_" + i][5]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(1)').css({"padding-left": Math.round(window["slider_button2_" + i][5]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(0)').css({"padding-right": Math.round(window["slider_button1_" + i][5]*slider_button_coefficient) + 'px'});
                $item.find('.qbutton:eq(1)').css({"padding-right": Math.round(window["slider_button2_" + i][5]*slider_button_coefficient) + 'px'});

                $item.find('.separator_top').css({"margin-top": Math.round(window["slider_top_separator_" + i][0]*slider_title_coefficient) + 'px'});
                $item.find('.separator_top').css({"margin-bottom": Math.round(window["slider_top_separator_" + i][1]*slider_title_coefficient) + 'px'});

                $item.find('.separator_bottom').css({"margin-top": Math.round(window["slider_bottom_separator_" + i][0]*slider_title_coefficient) + 'px'});
                $item.find('.separator_bottom').css({"margin-bottom": Math.round(window["slider_bottom_separator_" + i][1]*slider_title_coefficient) + 'px'});

            }

            function resetSliderElementsSize($item,i){
                $item.find('.thumb').css({"width": Math.round(window["slider_graphic_width_" + i][0]) + 'px'}).css({"height": Math.round(window["slider_graphic_height_" + i][0]) + 'px'});
                $item.find('.edgt_slide-svg-holder svg').css({"width": Math.round(window["slider_svg_width_" + i][0]) + 'px'}).css({"height": Math.round(window["slider_svg_height_" + i][0]) + 'px'});

                $item.find('.edgt_slide_title').css({"font-size": Math.round(window["slider_title_" + i][0]) + 'px'});
                $item.find('.edgt_slide_title').css({"line-height": Math.round(window["slider_title_" + i][1]) + 'px'});
                $item.find('.edgt_slide_title').css({"letter-spacing": Math.round(window["slider_title_" + i][2]) + 'px'});
                $item.find('.edgt_slide_title').css({"margin-bottom": Math.round(window["slider_title_" + i][3]) + 'px'});

                $item.find('.edgt_slide_subtitle').css({"font-size": Math.round(window["slider_subtitle_" + i][0]) + 'px'});
                $item.find('.edgt_slide_subtitle').css({"line-height": Math.round(window["slider_subtitle_" + i][1]) + 'px'});
                $item.find('.edgt_slide_subtitle').css({"letter-spacing": Math.round(window["slider_subtitle_" + i][2]) + 'px'});
                $item.find('.edgt_slide_subtitle').css({"margin-bottom": Math.round(window["slider_subtitle_" + i][3]) + 'px'});

                $item.find('.edgt_slide_text').css({"font-size": Math.round(window["slider_text_" + i][0]) + 'px'});
                $item.find('.edgt_slide_text').css({"line-height": Math.round(window["slider_text_" + i][1]) + 'px'});
                $item.find('.edgt_slide_text').css({"letter-spacing": Math.round(window["slider_text_" + i][2]) + 'px'});

                $item.find('.qbutton:eq(0)').css({"font-size": Math.round(window["slider_button1_" + i][0]) + 'px'});
                $item.find('.qbutton:eq(1)').css({"font-size": Math.round(window["slider_button2_" + i][0]) + 'px'});
                $item.find('.qbutton:eq(0)').css({"line-height": Math.round(window["slider_button1_" + i][1]) + 'px'});
                $item.find('.qbutton:eq(1)').css({"line-height": Math.round(window["slider_button2_" + i][1]) + 'px'});
                $item.find('.qbutton:eq(0)').css({"letter-spacing": Math.round(window["slider_button1_" + i][2]) + 'px'});
                $item.find('.qbutton:eq(1)').css({"letter-spacing": Math.round(window["slider_button2_" + i][2]) + 'px'});
                $item.find('.qbutton:eq(0)').css({"height": Math.round(window["slider_button1_" + i][3]) + 'px'});
                $item.find('.qbutton:eq(1)').css({"height": Math.round(window["slider_button2_" + i][3]) + 'px'});
                if(window["slider_button1_" + i][4] != 0) {
                    $item.find('.qbutton:eq(0)').css({"width": Math.round(window["slider_button1_" + i][4]) + 'px'});
                }else{
                    $item.find('.qbutton:eq(0)').css({"width": 'auto'});
                }
                if(window["slider_button2_" + i][4] != 0) {
                    $item.find('.qbutton:eq(1)').css({"width": Math.round(window["slider_button2_" + i][4]) + 'px'});
                }else{
                    $item.find('.qbutton:eq(1)').css({"width": 'auto'});
                }
                $item.find('.qbutton:eq(0)').css({"padding-left": Math.round(window["slider_button1_" + i][5]) + 'px'});
                $item.find('.qbutton:eq(1)').css({"padding-left": Math.round(window["slider_button2_" + i][5]) + 'px'});
                $item.find('.qbutton:eq(0)').css({"padding-right": Math.round(window["slider_button1_" + i][5]) + 'px'});
                $item.find('.qbutton:eq(1)').css({"padding-right": Math.round(window["slider_button2_" + i][5]) + 'px'});

                $item.find('.separator_top').css({"margin-top": Math.round(window["slider_top_separator_" + i][0]) + 'px'});
                $item.find('.separator_top').css({"margin-bottom": Math.round(window["slider_top_separator_" + i][1]) + 'px'});

                $item.find('.separator_bottom').css({"margin-top": Math.round(window["slider_bottom_separator_" + i][0]) + 'px'});
                $item.find('.separator_bottom').css({"margin-bottom": Math.round(window["slider_bottom_separator_" + i][1]) + 'px'});
            }

			if($this.hasClass('full_screen')){
                $this.css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top_bottom - paspartu_amount_with_bottom) + 'px'});
				$this.find('.edgt_slider_preloader').css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top_bottom - paspartu_amount_with_bottom) + 'px'});
                $this.find('.edgt_slider_preloader .ajax_loader').css({'display': 'block'});
				$this.find('.item').css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top_bottom - paspartu_amount_with_bottom) + 'px'});

                if($j('.paspartu_outer:not(.disable_top_paspartu):not(.paspartu_on_bottom_slider)').length){
                    if(!$j('body').hasClass('paspartu_on_top_fixed')){
						$this.closest('.edgt_slider').css('padding-top', Math.round(header_height_add_for_paspartu + $window_width * paspartu_width));
					}
                    $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                }

                if($j('.paspartu_outer.paspartu_on_bottom_slider').length){
                    $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                }

                $j(window).resize(function() {
					mobile_header = $j(window).width() < 1000 ? $j('header.page_header').height() : 0;
                    header_height_add_for_paspartu = $window_width > 1000 && !$j('header.page_header').hasClass('transparent') ? $j('header.page_header').height() : 0;
                    paspartu_amount_with_top_bottom = $j('.paspartu_outer:not(.disable_top_paspartu):not(.paspartu_on_bottom_slider)').length > 0 ? Math.round($window_width*paspartu_width*2 + header_height_add_for_paspartu) : 0; // paspartu_width * 2 times top and bottom paspartu
                    paspartu_amount_with_bottom = $j('.paspartu_outer.paspartu_on_bottom_slider').length > 0 ? Math.round($window_width*paspartu_width) : 0;
                    $this.css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top_bottom - paspartu_amount_with_bottom) + 'px'});
                    $this.find('.edgt_slider_preloader .ajax_loader').css({'display': 'block'});
					$this.find('.item').css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top_bottom - paspartu_amount_with_bottom) + 'px'});

                    if($j('.paspartu_outer:not(.disable_top_paspartu):not(.paspartu_on_bottom_slider)').length){
                        if(!$j('body').hasClass('paspartu_on_top_fixed')){
							$this.closest('.edgt_slider').css('padding-top', Math.round(header_height_add_for_paspartu + $window_width * paspartu_width));
						}
                        $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                    }
                    if($j('.paspartu_outer.paspartu_on_bottom_slider').length){
                        $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                    }

                    $this.find('.item').each(function(i){
                        setSliderElementsSize($j(this),i);
                    });
				});
			}else if($this.hasClass('responsive_height')){
                var $def_height = $this.data('height');

                $this.find('.edgt_slider_preloader').css({'height': ($this.height() - mobile_header - paspartu_amount_with_top_bottom - paspartu_amount_with_bottom) + 'px', 'display': 'block'});
                if($j('.paspartu_outer:not(.disable_top_paspartu):not(.paspartu_on_bottom_slider)').length){
                    if(!$j('body').hasClass('paspartu_on_top_fixed')){
						$this.closest('.edgt_slider').css('padding-top', Math.round(header_height_add_for_paspartu + $window_width * paspartu_width));
					}
                    $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                }
                if($j('.paspartu_outer.paspartu_on_bottom_slider').length){
                    $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                }
                setSliderHeight($this, $def_height);

                $j(window).resize(function() {
                    if($j('.paspartu_outer:not(.disable_top_paspartu):not(.paspartu_on_bottom_slider)').length){
                        header_height_add_for_paspartu = $window_width > 1000 && !$j('header.page_header').hasClass('transparent') ? $j('header.page_header').height() : 0;
                        if(!$j('body').hasClass('paspartu_on_top_fixed')){
							$this.closest('.edgt_slider').css('padding-top', Math.round(header_height_add_for_paspartu + $window_width * paspartu_width));
						}
                        $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                    }
                    if($j('.paspartu_outer.paspartu_on_bottom_slider').length){
                        $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                    }
                    setSliderHeight($this, $def_height);
                    $this.find('.item').each(function(i){
                        setSliderElementsSize($j(this),i);
                    });
                });
            }else {
                var $def_height = $this.data('height');

                $this.find('.edgt_slider_preloader').css({'height': ($this.height() - mobile_header) + 'px', 'display': 'block'});
                $this.find('.edgt_slider_preloader .ajax_loader').css({'display': 'block'});
                if($j('.paspartu_outer:not(.disable_top_paspartu):not(.paspartu_on_bottom_slider)').length){
                    if(!$j('body').hasClass('paspartu_on_top_fixed')){
						$this.closest('.edgt_slider').css('padding-top', Math.round(header_height_add_for_paspartu + $window_width * paspartu_width));
					}
                    $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                }
                if($j('.paspartu_outer.paspartu_on_bottom_slider').length){
                    $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                }
                $this.find('.item').each(function(i){
                    setSliderInitialElementsSize($j(this),i);
                    setSliderElementsSize($j(this),i);
                });
                $window_width < 1000 ? setSliderHeight($this, $def_height) : resetSliderHeight($def_height);
                $j(window).resize(function() {
                    if($j('.paspartu_outer:not(.disable_top_paspartu):not(.paspartu_on_bottom_slider)').length){
                        header_height_add_for_paspartu = $window_width > 1000 && !$j('header.page_header').hasClass('transparent') ? $j('header.page_header').height() : 0;
                        if(!$j('body').hasClass('paspartu_on_top_fixed')){
							$this.closest('.edgt_slider').css('padding-top', Math.round(header_height_add_for_paspartu + $window_width * paspartu_width));
						}
                        $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                    }
                    if($j('.paspartu_outer.paspartu_on_bottom_slider').length){
                        $this.closest('.edgt_slider').css('padding-bottom', Math.round($window_width * paspartu_width));
                    }
                    if($window_width < 1000){
                        setSliderHeight($this, $def_height);
                        $this.find('.item').each(function(i){
                            setSliderElementsSize($j(this),i);
                        });
                    }else{
                        resetSliderHeight($def_height);
                        $this.find('.item').each(function(i){
                            resetSliderElementsSize($j(this),i);
                        });
                    }
                });
			}

			if($j('body:not(.boxed):not(.vertical_menu_transparency):not(.vertical_menu_background_opacity):not(.vertical_menu_hidden):not(.page-template-landing_page-php)').hasClass('vertical_menu_enabled') && $window_width > 1000){
                var vertical_menu_width = 290;
                if($j('.vertical_menu_width_350').length){ var vertical_menu_width = 350; }
                if($j('.vertical_menu_width_400').length){ var vertical_menu_width = 400; }
                $this.find('.carousel-inner').width($window_width - vertical_menu_width);
				$j(window).resize(function() {
					if($j(window).width() > 1000){
						$this.find('.carousel-inner').width($window_width - vertical_menu_width);
					} else {
						$this.find('.carousel-inner').css('width','100%');
					}
				});
			}

            if($j('body:not(.boxed):not(.vertical_menu_transparency):not(.vertical_menu_background_opacity):not(.page-template-landing_page-php)').hasClass('vertical_menu_hidden') && $window_width > 1000){
                $this.find('.carousel-inner').width($window_width - 40);
                $j(window).resize(function() {
                    if($j(window).width() > 1000){
                        $this.find('.carousel-inner').width($window_width - 40);
                    } else {
                        $this.find('.carousel-inner').css('width','100%');
                    }
                });
            }

			$j(window).scroll(function(){
                if($this.hasClass('full_screen') && $scroll + Math.round($window_width*paspartu_width) > $window_height && $window_width > 1000){
                    $this.find('.carousel-inner, .carousel-indicators, button').hide();
                }else if(!$this.hasClass('full_screen') && $scroll + Math.round($window_width*paspartu_width) > $this.height() && $window_width > 1000){
                    $this.find('.carousel-inner, .carousel-indicators, button').hide();
                }else{
                    $this.find('.carousel-inner, .carousel-indicators, button').show();
                }
			});

			var $slide_animation = $this.data('slide_animation');
			if($slide_animation === ""){
				$slide_animation = 6000;
			}

			// function for setting prev/next numbers on arrows
			var all_items_count = $j('div.item').length;
			function setPrevNextNumbers(curr_item, all_items_count){
				if(curr_item == 1){
					$this.find('.left.carousel-control .prev').html(all_items_count);
					$this.find('.right.carousel-control .next').html(curr_item + 1);
				}else if(curr_item == all_items_count){
					$this.find('.left.carousel-control .prev').html(curr_item - 1);
					$this.find('.right.carousel-control .next').html(1);
				}else{
					$this.find('.left.carousel-control .prev').html(curr_item - 1);
					$this.find('.right.carousel-control .next').html(curr_item + 1);
				}
			}

			function initSlider(){
				//set active class on first item
				$this.find('.carousel-inner .item:first-child').addClass('active');
				checkSliderForHeaderStyle($j('.carousel .active'), $this.hasClass('header_effect'));

                // setting numbers on carousel controls
                if($this.hasClass('slider_numbers')) {
                    setPrevNextNumbers(1, all_items_count);
                }

				if($this.hasClass('slider_thumbs')){
					// initial state of prev/next numbers
					setPrevNextNumbers(1, all_items_count);

					//set prev and next thumb on load
					if($this.find('.active').next('div').find('.image').length){
						src = image_regex.exec($this.find('.active').next('div').find('.image').attr('style'));
						next_image = new Image();
						next_image.src = src[1];
					}else{
						next_image = $this.find('.active').next('div').find('> .video').clone();
						next_image.find('.video-overlay').remove();
						next_image.find('.video-wrap').width(170).height(95);
						next_image.find('.mejs-container').width(170).height(95);
						next_image.find('video').width(170).height(95);
					}
					$this.find('.right.carousel-control .img').html(next_image).find('img, div.video').addClass('old');

					if($this.find('.carousel-inner .item:last-child .image').length){
						src = image_regex.exec($this.find('.carousel-inner .item:last-child .image').attr('style'));
						prev_image = new Image();
						prev_image.src = src[1];
					}else{
						prev_image = $this.find('.carousel-inner .item:last-child > .video').clone();
						prev_image.find('.video-overlay').remove();
						prev_image.find('.video-wrap').width(170).height(95);
						prev_image.find('.mejs-container').width(170).height(95);
						prev_image.find('video').width(170).height(95);
					}
					$this.find('.left.carousel-control .img').html(prev_image).find('img, div.video').addClass('old');
				}

				if($this.hasClass('edgt_auto_start')){
					$this.carousel({
						interval: $slide_animation,
						pause: false
					});

                    //pause slider when hover slider button
                    $this.find('.slide_buttons_holder .qbutton')
                    .mouseenter(function() {
                        $this.carousel('pause');
                    })
                    .mouseleave(function() {
                        $this.carousel('cycle');
                    });
				} else {
					$this.carousel({
						interval: 0,
						pause: false
					});
				}
				if($this.find('.item video').length){
					initVideoBackgroundSize();
				}

                if($this.hasClass('responsive_height') || $this.hasClass('full_screen')){
                    $this.find('.item').each(function (i) {
                        setSliderInitialElementsSize($j(this), i);
                        setSliderElementsSize($j(this), i);
                    });
                }
				
				//initiate image animation
				if($j('.carousel-inner .item:first-child').hasClass('animate_image') && $window_width > 1000){
					$this.find('.carousel-inner .item.animate_image:first-child .image').transformAnimate({
						transform: "matrix("+matrixArray[$j('.carousel-inner .item:first-child').data('animate_image')]+")",
						duration: 30000,
						complete: function () {
							$j(this).transformAnimate({
								transform: "matrix(1, 0, 0, 1, 0, 0)",
								duration: 30000
							});
						}
					});
				}
			}

			if($j('html').hasClass('touch')){
				if($this.find('.item:first-child .mobile-video-image').length > 0){
					src = image_regex.exec($this.find('.item:first-child .mobile-video-image').attr('style'));
					if (src) {
						var backImg = new Image();
						backImg.src = src[1];
						$j(backImg).load(function(){
							$j('.edgt_slider_preloader').fadeOut(500);
							initSlider();
                            checkSVG($this);
						});
					}
				}
				else{
					src = image_regex.exec($this.find('.item:first-child .image').attr('style'));
					if (src) {
						var backImg = new Image();
						backImg.src = src[1];
						$j(backImg).load(function(){
							$j('.edgt_slider_preloader').fadeOut(500);
							initSlider();
                            checkSVG($this);
						});
					}
				}
			} else {
				if($this.find('.item:first-child video').length > 0){
					$this.find('.item:first-child video').get(0).addEventListener('loadeddata',function(){
						$j('.edgt_slider_preloader').fadeOut(500);
						initSlider();
                        checkSVG($this);
					});
				}else{
					src = image_regex.exec($this.find('.item:first-child .image').attr('style'));
					if (src) {
						var backImg = new Image();
						backImg.src = src[1];
						$j(backImg).load(function(){
							$j('.edgt_slider_preloader').fadeOut(500);
							initSlider();
                            checkSVG($this);
						});
					}
				}
			}
			$this.on('slide.bs.carousel', function () {
				$this.addClass('in_progress');
				$this.find('.active .slider_content_outer').fadeTo(250,0);
			});
			$this.on('slid.bs.carousel', function () {
				$this.removeClass('in_progress');
				$this.find('.active .slider_content_outer').fadeTo(0,1);
                checkSVG($this);

                // setting numbers on carousel controls
                if($this.hasClass('slider_numbers')) {
                    var curr_item = $j('div.item').index($j('div.item.active')[0]) + 1;
                    setPrevNextNumbers(curr_item, all_items_count);
                }
				
				// initiate image animation on active slide and reset all others
				$j('div.item.animate_image .image').stop().css({'transform':'', '-webkit-transform':''});
				if($j('div.item.active').hasClass('animate_image') && $window_width > 1000){
					$j('div.item.animate_image.active .image').transformAnimate({
						transform: "matrix("+matrixArray[$j('div.item.animate_image.active').data('animate_image')]+")",
						duration: 30000,
						complete: function () {
							$j(this).transformAnimate({
								transform: "matrix(1, 0, 0, 1, 0, 0)",
								duration: 30000
							});
						}
					});
				}

				if($this.hasClass('slider_thumbs')){
					var curr_item = $j('div.item').index($j('div.item.active')[0]) + 1;
					setPrevNextNumbers(curr_item, all_items_count);

					// prev thumb
					if($this.find('.active').prev('div.item').length){
						if($this.find('.active').prev('div').find('.image').length){
							src = image_regex.exec($this.find('.active').prev('div').find('.image').attr('style'));
							prev_image = new Image();
							prev_image.src = src[1];
						}else{
							prev_image = $this.find('.active').prev('div').find('> .video').clone();
							prev_image.find('.video-overlay').remove();
							prev_image.find('.video-wrap').width(170).height(95);
							prev_image.find('.mejs-container').width(170).height(95);
							prev_image.find('video').width(170).height(95);
						}
						$this.find('.left.carousel-control .img .old').fadeOut(300,function(){
							$j(this).remove();
						});
						$this.find('.left.carousel-control .img').append(prev_image).find('img, div.video').fadeIn(300).addClass('old');

					}else{
						if($this.find('.carousel-inner .item:last-child .image').length){
							src = image_regex.exec($this.find('.carousel-inner .item:last-child .image').attr('style'));
							prev_image = new Image();
							prev_image.src = src[1];
						}else{
							prev_image = $this.find('.carousel-inner .item:last-child > .video').clone();
							prev_image.find('.video-overlay').remove();
							prev_image.find('.video-wrap').width(170).height(95);
							prev_image.find('.mejs-container').width(170).height(95);
							prev_image.find('video').width(170).height(95);
						}
						$this.find('.left.carousel-control .img .old').fadeOut(300,function(){
							$j(this).remove();
						});
						$this.find('.left.carousel-control .img').append(prev_image).find('img, div.video').fadeIn(300).addClass('old');
					}

					// next thumb
					if($this.find('.active').next('div.item').length){
						if($this.find('.active').next('div').find('.image').length){
							src = image_regex.exec($this.find('.active').next('div').find('.image').attr('style'));
							next_image = new Image();
							next_image.src = src[1];
						}else{
							next_image = $this.find('.active').next('div').find('> .video').clone();
							next_image.find('.video-overlay').remove();
							next_image.find('.video-wrap').width(170).height(95);
							next_image.find('.mejs-container').width(170).height(95);
							next_image.find('video').width(170).height(95);
						}

						$this.find('.right.carousel-control .img .old').fadeOut(300,function(){
							$j(this).remove();
						});
						$this.find('.right.carousel-control .img').append(next_image).find('img, div.video').fadeIn(300).addClass('old');

					}else{
						if($this.find('.carousel-inner .item:first-child .image').length){
							src = image_regex.exec($this.find('.carousel-inner .item:first-child .image').attr('style'));
							next_image = new Image();
							next_image.src = src[1];
						}else{
							next_image = $this.find('.carousel-inner .item:first-child > .video').clone();
							next_image.find('.video-overlay').remove();
							next_image.find('.video-wrap').width(170).height(95);
							next_image.find('.mejs-container').width(170).height(95);
							next_image.find('video').width(170).height(95);
						}
						$this.find('.right.carousel-control .img .old').fadeOut(300,function(){
							$j(this).remove();
						});
						$this.find('.right.carousel-control .img').append(next_image).find('img, div.video').fadeIn(300).addClass('old');
					}
				}
			});

            $this.swipe( {
                swipeLeft: function(event, direction, distance, duration, fingerCount){ $this.carousel('next'); },
                swipeRight: function(event, direction, distance, duration, fingerCount){ $this.carousel('prev'); },
                threshold:20
            });

		});

        if ($j('.no-touch .carousel').length) {
            skrollr_slider = skrollr.init({
                smoothScrolling: false,
                forceHeight: false
            });
            skrollr_slider.refresh();
        }
	}
}

function checkSliderForHeaderStyle($this, header_effect){
	"use strict";

    if($j('.edgt_slider .carousel').not('.disable_slider_header_style_changing').length > 0) {

        var slide_header_style = "";
        if ($this.hasClass('light')) { slide_header_style = 'light'; }
        if ($this.hasClass('dark')) { slide_header_style = 'dark'; }

        if (slide_header_style !== "") {
            if (header_effect) {
                $j('header.page_header').removeClass('dark light').addClass(slide_header_style);
                $j('aside.vertical_menu_area').removeClass('dark light').addClass(slide_header_style);
            }
            $j('.carousel .carousel-control, .carousel .carousel-indicators').removeClass('dark light').addClass(slide_header_style);
        } else {
            if (header_effect) {
                $j('header.page_header').removeClass('dark light').addClass(default_header_style);
                $j('aside.vertical_menu_area').removeClass('dark light').addClass(default_header_style);
            }
            $j('.carousel .carousel-control, .carousel .carousel-indicators').removeClass('dark light').addClass(default_header_style);
        }
    }
}

/*
 ** Set heights for edgt carousel, portfolio slider and blog slider
 */
function calculateHeights(){
    if($j('.portfolio_slides').length){
        $j('.portfolio_slides').each(function(){
            $j(this).parents('.caroufredsel_wrapper').css({'height' : ($j(this).find('li.item').outerHeight()-3) + 'px'}); //3 is because of the white line bellow the slider
        });
    }

    if($j('.edgt_carousels .slides').length){
        $j('.edgt_carousels .slides').each(function(){
            $j(this).parents('.caroufredsel_wrapper').css({'height' : ($j(this).find('li.item').outerHeight()) + 'px'});
        });
    }

    if($j('.blog_slides').length){
        $j('.blog_slides').each(function(){
            $j(this).parents('.caroufredsel_wrapper').css({'height' : ($j(this).find('li.item').outerHeight()-3) + 'px'});
        });
    }
}

/*
 ** Init Edge Carousel
 */
function initEdgeCarousel(){
    "use strict";

    if($j('.edgt_carousels').length){
        $j('.edgt_carousels').each(function(){

            var number_of_items;
            var items_number_set;
            var fullWidth  = (!($j(this).parents('.grid_section').length == 1) && ($j(this).parents('.page-template-full-width').length == 1)) ? true : false;

            if(typeof $j(this).data('number_of_items') !== 'undefined') {
                number_of_items = $j(this).data('number_of_items');
                items_number_set = true;
            }
            else {
                number_of_items = 5;
                items_number_set = false;
            }

            var itemWidth = ($j(this).parents('.grid_section').length == 1) ? 216 : 380;

            var maxItems = number_of_items;

            var itemWidthTemp;            

            if (fullWidth) {
                switch (number_of_items) {
                    case 3:
                        itemWidthTemp = 660;
                    break;
                    case 4:
                        itemWidthTemp = 500;
                    break;
                    case 5:
                        itemWidthTemp = 400;
                    break;
                    default:
                        itemWidthTemp = 400;

                    break;
                }
            }
            else {
                switch (number_of_items) {
                    case 3:
                        itemWidthTemp = 380;
                    break;
                    case 4:
                        itemWidthTemp = 275;
                    break;
                    case 5:
                        itemWidthTemp = 216;
                    break;
                    default:
                        itemWidthTemp = 380;

                    break;
                }
            }

            itemWidth = (items_number_set) ? itemWidthTemp : itemWidth;

			var instance = this;
            $j(this).find('.slides').carouFredSel({
                circular: true,
                responsive: true,
                scroll : {
                    items           : 1,
                    duration        : 1000,
                    pauseOnHover    : false
                },
				prev : {
					button : function() {
						return $j(this).parent().siblings('.caroufredsel-direction-nav').find('.edgt_carousel_prev');
					}
				},
				next : {
					button : function() {
						return $j(this).parent().siblings('.caroufredsel-direction-nav').find('.edgt_carousel_next');
					}
				},
                items: {
                    width: itemWidth,
                    visible: {
                        min: 1,
                        max: maxItems
                    }
                },
                auto: true,
                mousewheel: false,
                swipe: {
                    onMouse: true,
                    onTouch: true
                }

            }).animate({'opacity': 1},1000);
        });
        calculateHeights();
    }
}

/*
** Init Portfolio Slider
*/
function initPortfolioSlider(){
    "use strict";

    if($j('.portfolio_slider').length){

        $j('.portfolio_slider').each(function(){


            var portfolios_shown;
            if(typeof $j(this).data('portfolios_shown') !== 'undefined') {
                portfolios_shown = $j(this).data('portfolios_shown');
            }
            else {
                portfolios_shown = 'auto';
            }

            var maxItems = ($j(this).parents('.grid_section').length == 1) ? 3 : portfolios_shown;
            var itemWidthTemp;            

            switch (portfolios_shown) {
                case 4:
                    itemWidthTemp = 500;
                break;
                case 5:
                    itemWidthTemp = 400;
                break;
                case 6:
                    itemWidthTemp = 334;
                break;
                default:
                    itemWidthTemp = 500;

                break;
            }

            var itemWidth = ($j(this).parents('.grid_section').length == 1) ? 353 : itemWidthTemp;


            $j(this).find('.portfolio_slides').carouFredSel({
                circular: true,
                responsive: true,
                scroll: 1,
                prev : {
					button : function() {
						return $j(this).parent().siblings('.caroufredsel-direction-nav').find('#caroufredsel-prev');
					}
				},
				next : {
					button : function() {
						return $j(this).parent().siblings('.caroufredsel-direction-nav').find('#caroufredsel-next');
					}
				},
                items: {
                    width: itemWidth,
                    visible: {
                        min: 1,
                        max: maxItems
                    }
                },
                auto: false,
                mousewheel: false,
                swipe: {
                    onMouse: true,
                    onTouch: true
                }
            }).animate({'opacity': 1},1000);
        });

        calculateHeights();

        $j('.portfolio_slider .flex-direction-nav a').click(function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();
        });
    }
}

    /*
     ** Make Masonry Gallery Visible after page load
     */
    function initMasonryGalleryAppearance(){
        "use strict";

        if($j('.masonry_gallery_holder, .blog_masonry_gallery, .projects_masonry_holder').length){

            $j('.masonry_gallery_holder, .blog_masonry_gallery, .projects_masonry_holder').addClass('loaded');
        }

    }


/*
** Calculate responsiveness for Blog Slider
*/
function responsiveNumberSlides(maxItems){
    "use strict";

    var windowWidth = window.innerWidth;

    if (windowWidth > 1200){
        return maxItems;
    }
    else if (windowWidth < 1200 && windowWidth >= 800){
        return 3;
    }
    else if (windowWidth < 800 && windowWidth > 500){
        return 2;
    }
    else if (windowWidth <= 500){
        return 1;
    }
}

/*
 ** Init Blog Slider
 */
function initBlogSlider(){
    "use strict";

    if($j('.blog_slider').length){

        $j('.blog_slider').each(function(){


            var blogs_shown;
            if(typeof $j(this).data('blogs_shown') !== 'undefined') {
                blogs_shown = $j(this).data('blogs_shown');
            }
            else {
                blogs_shown = 'auto';
            }

            var maxItems = ($j(this).parents('.grid_section').length == 1) ? 3 : blogs_shown;
            var itemWidthTemp;

            switch (blogs_shown) {
                case 3:
                    itemWidthTemp = 667;
                    break;
                case 4:
                    itemWidthTemp = 500;
                    break;
                case 5:
                    itemWidthTemp = 400;
                    break;
                case 6:
                    itemWidthTemp = 334;
                    break;
                default:
                    itemWidthTemp = 500;

                    break;
            }

            var itemWidth = ($j(this).parents('.grid_section').length == 1) ? 353 : itemWidthTemp;


            $j(this).find('.blog_slides').carouFredSel({
                circular: true,
                responsive: true,
                scroll: 1,
                prev : {
                    button : function() {
                        return $j(this).parent().siblings('.caroufredsel-direction-nav').find('#caroufredsel-prev');
                    }
                },
                next : {
                    button : function() {
                        return $j(this).parent().siblings('.caroufredsel-direction-nav').find('#caroufredsel-next');
                    }
                },
                pagination: function() {
                        return $j(this).parent().siblings('.blog_slider_pager');
                    },
                items: {
                    width: itemWidth,
                    visible: {
                        min: responsiveNumberSlides(maxItems),
                        max: maxItems
                    }
                },
                auto: false,
                mousewheel: false,
                swipe: {
                    onMouse: true,
                    onTouch: true
                }
            }).animate({'opacity': 1},1000);
        });

        calculateHeights();

        $j('.blog_slider .flex-direction-nav a').click(function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();
        });
    }
}


/* insert start */
/*
**    Opening side menu on "menu button" click (different types)
*/
var current_scroll;
function initSideMenu(){
    "use strict";

    if ($j('body').hasClass('side_menu_slide_with_content')) {
			$j('.side_menu_button_wrapper a.side_menu_button_link, a.close_side_menu').click(function(e){
			e.preventDefault();

			if(!$j('.side_menu_button_wrapper a.side_menu_button_link').hasClass('opened')){
				$j(this).addClass('opened');
				$j('body').addClass('side_menu_open');
				current_scroll = $j(window).scrollTop();
				$j(window).scroll(function() {

					if(Math.abs($scroll - current_scroll) > 400){
						$j('body').removeClass('side_menu_open');
						$j('.side_menu_button_wrapper a').removeClass('opened');
					}
				});
			}else{//hamburger icon has class open on its click
				$j('body').removeClass('side_menu_open');


				$j('.side_menu_button_wrapper a.side_menu_button_link').removeClass('opened');
				$j('body').removeClass('side_menu_open');

			}

			e.stopPropagation();
			$j('.wrapper').click(function() {
				e.preventDefault();
				$j('body').removeClass('side_menu_open');
				$j('.side_menu_button_wrapper a.side_menu_button_link').removeClass('opened');
				$j('body').removeClass('side_menu_open');
			});
		});
	}

if ($j('body').hasClass('side_menu_slide_from_right')) {
        $j('.wrapper').prepend('<div class="cover"/>');
        $j('.side_menu_button_wrapper a.side_menu_button_link, a.close_side_menu').click(function(e){
        e.preventDefault();

        if(!$j('.side_menu_button_wrapper a.side_menu_button_link').hasClass('opened')){
            $j(this).addClass('opened');
            $j('body').addClass('right_side_menu_opened');

            $j(' .wrapper .cover').click(function() {
                $j('.side_menu_button_wrapper a.side_menu_button_link').removeClass('opened');
                $j('body').removeClass('right_side_menu_opened');
                $j('.side_menu_button_wrapper a').removeClass('opened');
            });
            current_scroll = $j(window).scrollTop();
            $j(window).scroll(function() {
                if(Math.abs($scroll - current_scroll) > 400){
                    $j('body').removeClass('right_side_menu_opened');
                    $j('.side_menu_button_wrapper a').removeClass('opened');
                }
            });
        }else{
            $j('.side_menu_button_wrapper a.side_menu_button_link').removeClass('opened');
            $j('body').removeClass('right_side_menu_opened');
        }
    });
}

}

/* insert end */
/*
**    Opening DropDown Menus Position
*/

function setDropDownMenuPosition(){
	"use strict";

	var menu_items = $j(".drop_down > ul > li.narrow");
	menu_items.each( function(i) {

		var browser_width = $j(window).width()-16; // 16 is width of scroll bar
		var boxed_layout = 1150; // boxed layout width
		var menu_item_position = $j(menu_items[i]).offset().left;
		var sub_menu_width = $j(menu_items[i]).find('.second .inner ul').width();
		var menu_item_from_left = 0;
		if($j('body').hasClass('boxed')){
			menu_item_from_left = boxed_layout - (menu_item_position - (browser_width - boxed_layout)/2) + 24; // 24 is right padding between menu elements
		} else {
			menu_item_from_left = browser_width - menu_item_position + 24; // 24 is right padding between menu elements
		}

		var sub_menu_from_left;

		if($j(menu_items[i]).find('li.sub').length > 0){
			sub_menu_from_left = menu_item_from_left - sub_menu_width;
		}

		if(menu_item_from_left < sub_menu_width || sub_menu_from_left < sub_menu_width){
			$j(menu_items[i]).find('.second').addClass('right');
			$j(menu_items[i]).find('.second .inner ul').addClass('right');
		}
	});
}

function initDropDownMenu(){
	"use strict";

	var menu_items = $j('.drop_down > ul > li');

	menu_items.each( function(i) {
		if ($j(menu_items[i]).find('.second').length > 0) {
			if($j(menu_items[i]).hasClass('wide')){
                var dropdown = $j(this).find('.inner > ul');
                var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));

				if(!$j(this).hasClass('left_position') && !$j(this).hasClass('right_position')){
					$j(this).find('.second').css('left',0);
				}

				var tallest = 0;
				$j(this).find('.second > .inner > ul > li').each(function() {
					var thisHeight = $j(this).height();
					if(thisHeight > tallest) {
						tallest = thisHeight;
					}
				});

				$j(this).find('.second > .inner > ul > li').height(tallest);

				var row_number;
				if($j(this).find('.second > .inner > ul > li').length > 4){
					row_number = 4;
				}else{
					row_number = $j(this).find('.second > .inner > ul > li').length;
				}

				var width = row_number*($j(this).find('.second > .inner > ul > li').outerWidth());
				$j(this).find('.second > .inner > ul').width(width);

				if(!$j(this).hasClass('left_position') && !$j(this).hasClass('right_position')){
					var left_position = ($j(window).width() - 2 * ($j(window).width()-$j(this).find('.second').offset().left))/2 + (width+dropdownPadding)/2;
					$j(this).find('.second').css('left',-left_position);
				}
			}

			if(!menu_dropdown_height_set){
				$j(menu_items[i]).data('original_height', $j(menu_items[i]).find('.second').height() + 'px');
				$j(menu_items[i]).find('.second').height(0);
			}

			if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
				$j(menu_items[i]).on("touchstart mouseenter",function(){
					$j(menu_items[i]).find('.second').css({'height': $j(menu_items[i]).data('original_height'), 'overflow': 'visible', 'visibility': 'visible', 'opacity': '1'});
				}).on("mouseleave", function(){
					$j(menu_items[i]).find('.second').css({'height': '0px','overflow': 'hidden', 'visibility': 'hidden', 'opacity': '0'});
				});

			}else{
			
				if($j('.drop_down.animate_height ').length){
				
					$j(menu_items[i]).mouseenter(function() {
						$j(menu_items[i]).find('.second').css({
							'visibility': 'visible',
							'height': '0px',
							'opacity': '0',
							'display': 'block'
						});
						$j(menu_items[i]).find('.second').stop().animate({
							'height': $j(menu_items[i]).data('original_height'),
							opacity: 1
						}, 400, function() {
							$j(menu_items[i]).find('.second').css('overflow', 'visible')
						});
						
					}).mouseleave(function() {
						$j(menu_items[i]).find('.second').stop().animate({
							'height': '0px'
						}, 0, function() {
							$j(menu_items[i]).find('.second').css({
								'overflow': 'hidden',
								'visivility': 'hidden',
								'display': 'none'
							});
						});
					});
					
				}else{
				
					var config = {
						interval: 0,
						over: function(){
							setTimeout(function() {
								$j(menu_items[i]).find('.second').addClass('drop_down_start');
								$j(menu_items[i]).find('.second').stop().css({'height': $j(menu_items[i]).data('original_height')});
							}, 150);
						},
						timeout: 150,
						out: function(){
							$j(menu_items[i]).find('.second').stop().css({'height': '0px'});
							$j(menu_items[i]).find('.second').removeClass('drop_down_start');
						}
					};
				}
				
				$j(menu_items[i]).hoverIntent(config);
			}
		}
	});
	$j('.drop_down ul li.wide ul li a').on('click',function(){
		var $this = $j(this);
		setTimeout(function() {
			$this.mouseleave();
		}, 500);

	});

	menu_dropdown_height_set = true;
}


/*
 **	Vertical menu toggle dropdown
 */

function initVerticalMenu(){
	"use strict";

    if($j('.no-touch .vertical_menu').hasClass('click')){
        //show dropdown on menu item click, no link available on menu item click if it has dropdown

        var menu_items = $j('.no-touch .vertical_menu_toggle > ul > li > a');
        var menu_items_2 = $j('.no-touch .vertical_menu_toggle ul li ul li a');
        menu_items.each( function(i) {
            if($j(menu_items[i]).parent().hasClass('has_sub')){

                $j(menu_items[i]).on('click',function(e) {
                    e.preventDefault();
                    if(!$j(this).parent().hasClass('open') && !$j(this).parent().hasClass('current-menu-ancestor')) {

                        $j('.no-touch .vertical_menu_toggle > ul > li').removeClass('open current-menu-ancestor');
                        $j('.no-touch .vertical_menu_toggle > ul > li').find('.second').slideUp('fast');

                        $j(this).parent().addClass('open');
                        $j(this).parent().find('.second').slideDown('slow', function () {
                            $j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
                        });
                    }else{

                        $j(this).parent().removeClass('open');
                        $j(this).parent().find('.second').slideUp('fast', function () {
                            $j(this).parent().removeClass('current-menu-ancestor');
                            $j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
                        });
                    }
                    return false;
                });
            }

        });

        menu_items_2.each( function(i) {
            if($j(menu_items_2[i]).parent().hasClass('menu-item-has-children')){
                $j(menu_items_2[i]).on('click',function(e) {
                    e.preventDefault();
                    if(!$j(this).parent().hasClass('open') && !$j(this).parent().hasClass('current_page_parent')) {
                        $j('.no-touch .vertical_menu_toggle ul li ul li').removeClass('open current_page_parent');
                        $j('.no-touch .vertical_menu_toggle ul li ul li').find('ul').slideUp('fast');

                        $j(this).parent().addClass('open');
                        $j(this).parent().find('ul').slideDown('slow', function () {
                            $j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
                        });
                    }else{
                        $j(this).parent().removeClass('open');
                        $j(this).parent().find('ul').slideUp('fast', function () {
                            $j(this).parent().removeClass('current_page_parent');
                            $j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
                        });
                    }
                    return false;
                });
            }
        });

    }
    else if($j('.vertical_menu').hasClass('vertical_menu_side')) {

        if($j('body').hasClass('vertical_menu_right')){
            var animateOpen = {'right' : '0%'};
            var animateClose = {'right' : '-150%'};
        }else{
            var animateOpen = {'left' : '0%'};
            var animateClose = {'left' : '-150%'};
        }

        //show dropdown on menu item hover, link is available on menu item click
        var menu_items = $j('.vertical_menu_side > ul > li > a');
        var menu_items_2 = $j('.vertical_menu_side ul li ul li a');
        menu_items.each( function(i) {
            if($j(menu_items[i]).parent().hasClass('has_sub')){

                //add parent item to sub menu - start//
                var menu_url = $j(this).attr("href");
                var menu_text = $j(this).text();
                var li = $j("<li />", {"class": 'prev_level'});
                var link = $j("<a />", {"href": menu_url, "html": '<i class="edgt_menu_arrow fa fa-angle-left"></i>'+menu_text}).appendTo(li);
                $j(this).parent().find('.second > div > ul').prepend(li);
                //add parent item to sub menu - end//

                $j(menu_items[i]).on('click',function(e) {
                    e.preventDefault();

                    $j('.vertical_menu_side > ul > li').removeClass('open current-menu-ancestor');
                    $j(this).parent().addClass('open');
                    if(!$j(this).parent().hasClass('prev_level')) {
                        $j(this).parent().find('.second').css('display','block').animate(animateOpen, 500, function() {
                            $j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
                        });
                    }
                    return false;
                });
            }
        });

        //return to the first level menu
        $j('.vertical_menu_side ul li ul > li.prev_level > a').on('click',function(e) {
            e.preventDefault();
            $j(this).closest('.second').animate(animateClose, 500, function() {
                $j(this).css('display','none');
                $j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
            });
            return false;
        });

        menu_items_2.each( function(i) {
            if($j(menu_items_2[i]).parent().hasClass('menu-item-has-children')){

                //add parent item to sub menu - start//
                var menu_url = $j(this).attr("href");
                var menu_text = $j(this).text();
                var li = $j("<li />", {"class": 'prev_level'});
                var link = $j("<a />", {"href": menu_url, "html": '<i class="edgt_menu_arrow fa fa-angle-left"></i>'+menu_text}).appendTo(li);
                $j(this).next('ul').prepend(li);
                //add parent item to sub menu - end//

                $j(menu_items_2[i]).on('click',function(e) {
                    e.preventDefault();
                    $j('.vertical_menu_toggle ul li ul li').removeClass('open current_page_parent');
                    $j(this).parent().addClass('open');
                    if(!$j(this).parent().hasClass('prev_level')) {
                        $j(this).next('ul').css('display','block').animate(animateOpen, 500, function() {
                            $j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
                        });
                    }
                    return false;
                });
            }
        });

        //return to the second level menu
        $j('.vertical_menu_side ul li ul li ul li.prev_level a').on('click',function(e) {
            e.preventDefault();
            $j(this).closest('ul').animate(animateClose, 500, function() {
                $j(this).css('display','none');
                $j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
            });
            return false;
        });
    }
    else if($j('.vertical_menu').hasClass('vertical_menu_to_content')){
        //show dropdown to content on menu item hover, link is available on menu item click
        var menu_items = $j('.no-touch .vertical_menu_to_content > ul > li');
        var menu_items_2 = $j('.no-touch .vertical_menu_to_content ul li ul li');
        menu_items.each( function(i) {
            if($j(menu_items[i]).hasClass('has_sub')){
                var subitems_number = $j(menu_items[i]).find('.inner > ul > li').length;
                $j(menu_items[i]).hoverIntent({
                   over: function() {
                        $j(menu_items[i]).addClass('open');
                        $j(menu_items[i]).find('.second').addClass('vertical_menu_start');
                    },
                    out: function() {
                        //if(!$j(menu_items[i]).hasClass('active')){
                        $j(menu_items[i]).removeClass('open');                        
                        $j(menu_items[i]).find('.second').removeClass('vertical_menu_start');
                    },
                    timeout: 1000
                });
            }
        });

        menu_items_2.each( function(i) {
            if($j(menu_items_2[i]).hasClass('menu-item-has-children')){
                var subitems_number = $j(menu_items_2[i]).find('ul > li').length;
                $j(menu_items_2[i]).hoverIntent({
                    over: function() {
                        $j(menu_items_2[i]).addClass('open');
                        $j(menu_items_2[i]).find('ul').addClass('vertical_submenu_start');
                    },
                    out: function() {
                        $j(menu_items_2[i]).removeClass('open');
                        $j(menu_items_2[i]).find('ul').removeClass('vertical_submenu_start');
                    },
                    timeout: 1000
                });
            }
        });
    }
    else{
        //show dropdown on menu item hover, link is available on menu item click
        var menu_items = $j('.no-touch .vertical_menu_toggle > ul > li');
        var menu_items_2 = $j('.no-touch .vertical_menu_toggle ul li ul li');
        menu_items.each( function(i) {
            if($j(menu_items[i]).hasClass('has_sub')){
                var subitems_number = $j(menu_items[i]).find('.inner > ul > li').length;
                $j(menu_items[i]).hoverIntent({
                   over: function() {
                       $j(menu_items[i]).addClass('open');
                		$j(menu_items[i]).find('.second').slideDown(subitems_number*40, 'easeInOutSine', function(){
                			$j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
                		});
                	},
                	out: function() {
                		//if(!$j(menu_items[i]).hasClass('active')){
                		$j(menu_items[i]).removeClass('open');
                		$j(menu_items[i]).find('.second').slideUp(subitems_number*40, 'easeInOutSine');
                		//}
                	},
                	timeout: 1000
                });
            }
        });

        menu_items_2.each( function(i) {
            if($j(menu_items_2[i]).hasClass('menu-item-has-children')){
                var subitems_number = $j(menu_items_2[i]).find('ul > li').length;
                $j(menu_items_2[i]).hoverIntent({
                    over: function() {
                        $j(menu_items_2[i]).addClass('open');
                        $j(menu_items_2[i]).find('ul').slideDown(subitems_number*40, 'easeInOutSine', function(){
                            $j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
                        });
                    },
                    out: function() {
                        $j(menu_items_2[i]).removeClass('open');
                        $j(menu_items_2[i]).find('ul').slideUp(subitems_number*40, 'easeInOutSine');
                    },
                    timeout: 1000
                });
            }
        });
    }



}

/*
 **	Show/Hide Vertical menu for mobile
 */
function initVerticalMobileMenu(){
    "use strict";

    //register tap / click event for main menu item plus icon
    $j('.touch .vertical_menu_toggle > ul > li.has_sub > a').on('tap click', function(e){
        //first prevent event propagation and it's default behavior
        e.stopPropagation();
        e.preventDefault();

        //is dropdown for clicked item visible?
        if($j(this).next('div.second').is(":visible")){
            //if it is remove 'open' class and slide it up
            $j(this).parents('.touch .vertical_menu_toggle > ul > li.has_sub').removeClass('open');
            $j(this).next('div.second').slideUp(200);
        } else {
            //if it's not visible add 'open' class and slide it down
            $j(this).parents('.touch .vertical_menu_toggle > ul > li.has_sub').addClass('open');
            $j(this).next('div.second').slideDown(200);
        }
    });

    //register tap / click event for second level main menu item plus icon
    $j('.touch .vertical_menu_toggle ul li ul li.sub > a').on('tap click', function(e){
        //first prevent event propagation and it's default behavior
        e.stopPropagation();
        e.preventDefault();

        //is dropdown for clicked item visible?
        if($j(this).next('ul').is(":visible")){
            //if it is remove 'open' class and slide it up
            $j(this).parents('.touch .vertical_menu_toggle ul li ul li').removeClass('open');
            $j(this).next('ul').slideUp(200);
        } else {
            //if it's not visible add 'open' class and slide it down
            $j(this).parents('.touch .vertical_menu_toggle ul li ul li').addClass('open');
            $j(this).next('ul').slideDown(200);
        }
    });
}

/*
 **	Set transparency for left menu area
 */
function checkVerticalMenuTransparency(){
	"use strict";

    if($scroll !== 0){
        $j('body.vertical_menu_transparency').removeClass('vertical_menu_transparency_on');
        $j('body.vertical_menu_transparency').addClass('vertical_menu_transparency_off');
    }else{
        $j('body.vertical_menu_transparency').addClass('vertical_menu_transparency_on');
		$j('body.vertical_menu_transparency').removeClass('vertical_menu_transparency_off');
    }
}


/*
 **	Show/Hide hidden Vertical menu
 */
function showHideVerticalMenu(){

    if($j('.vertical_menu_hidden').length) {
        var vertical_menu = $j('aside.vertical_menu_area');
        var vertical_menu_bottom_logo = $j('.vertical_menu_area_bottom_logo');
        var hovered_flag = true;
        $j(document).on('click',".vertical_menu_hidden_button, .vertical_menu_area_bottom_logo a, .vertical_menu_hidden .active nav.vertical_menu.vertical_menu_side ul li:not(.has_sub):not(.menu-item-has-children):not(.prev_level) a:not([href='#']), .vertical_menu_hidden .active nav.vertical_menu.click ul li:not(.has_sub):not(.menu-item-has-children) a:not([href='#']),  .vertical_menu_hidden .active nav.vertical_menu_toggle:not(.click) ul li a:not([href='#'])",function(e){
		   if(!$j(this).closest('.vertical_menu').length) {
                e.preventDefault();
            }
            if(hovered_flag) {
                hovered_flag = false;
                current_scroll = $j(window).scrollTop(); //current scroll is defined in front of "initSideMenu" function
                vertical_menu.addClass('active');
                vertical_menu_bottom_logo.addClass('active');
				vertical_menu.find('.menu_icon_wrapper').width(vertical_menu.find('.menu_icon_wrapper i').width()-3); //3 is because some icon can be larger, so icons should align
            }else{
                hovered_flag = true;
                vertical_menu.removeClass('active');
                vertical_menu_bottom_logo.removeClass('active');
				vertical_menu.find('.menu_icon_wrapper').width('');
				
            }
        });

        $j(window).scroll(function() {
            if(Math.abs($scroll - current_scroll) > 400){
                hovered_flag = true;
                vertical_menu.removeClass('active');
                vertical_menu_bottom_logo.removeClass('active');
            }
        });

        //take click outside vertical left/rifgt area and close it
        (function() {
            var Outclick, outclick,
                _this = this;
            Outclick = (function() {
                OutclickFunction.name = 'Outclick';
                function OutclickFunction() {
                    this.objects = [];
                }
                OutclickFunction.prototype.check = function(element, event) {
                    return !element.is(event.target) && element.has(event.target).length === 0;
                };
                OutclickFunction.prototype.trigger = function(e) {
                    var execute,
                        _this = this;
                    execute = false;
                    return $j.each(this.objects, function(index, el) {
                        if (_this.check(el.container, e)) {
                            if (el.related.length < 1) {
                                execute = true;
                            } else {
                                $j.each(el.related, function(index, relation) {
                                    if (_this.check(relation, e)) {
                                        return execute = true;
                                    } else {
                                        execute = false;
                                        return false;
                                    }
                                });
                            }
                            if (execute) {
                                return el.callback.call(el.container);
                            }
                        }
                    });
                };
                return OutclickFunction;
            })();
            outclick = new Outclick;
            $j.fn.outclick = function(options) {
                var _this = this;
                if (options == null) {
                    options = {};
                }
                options.related || (options.related = []);
                options.callback || (options.callback = function() {
                    return _this.hide();
                });
                return outclick.objects.push({
                    container: this,
                    related: options.related,
                    callback: options.callback
                });
            };
            $j(document).mouseup(function(e) {
                return outclick.trigger(e);
            });
        }).call(this);
        $j(vertical_menu).outclick({
            callback: function() {
                hovered_flag = true;
                vertical_menu.removeClass('active');
                vertical_menu_bottom_logo.removeClass('active');
				vertical_menu.find('.menu_icon_wrapper').width('');
            }
        });
    }
}

/*
**	Plugin for counter shortcode
*/
(function($) {
	"use strict";

	$.fn.countTo = function(options) {
		// merge the default plugin settings with the custom options
		options = $.extend({}, $.fn.countTo.defaults, options || {});

		// how many times to update the value, and how much to increment the value on each update
		var loops = Math.ceil(options.speed / options.refreshInterval),
		increment = (options.to - options.from) / loops;

		return $(this).each(function() {
			var _this = this,
			loopCount = 0,
			value = options.from,
			interval = setInterval(updateTimer, options.refreshInterval);

			function updateTimer() {
				value += increment;
				loopCount++;
				$(_this).html(value.toFixed(options.decimals));

				if (typeof(options.onUpdate) === 'function') {
					options.onUpdate.call(_this, value);
				}

				if (loopCount >= loops) {
					clearInterval(interval);
					value = options.to;

					if (typeof(options.onComplete) === 'function') {
						options.onComplete.call(_this, value);
					}
				}
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,  // the number the element should start at
		to: 100,  // the number the element should end at
		speed: 1000,  // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,  // the number of decimal places to show
		onUpdate: null,  // callback method for every time the element is updated,
		onComplete: null  // callback method for when the element finishes updating
	};
})(jQuery);

/*
**	Counter from zero to defined number
*/
function initToCounter(){
	"use strict";

	if($j('.counter.zero').length){
		$j('.counter.zero').each(function() {
			if(!$j(this).hasClass('executed')){
				$j(this).addClass('executed');
				$j(this).appear(function() {
					$j(this).parent().css('opacity', '1');
					var $max = parseFloat($j(this).text());
					$j(this).countTo({
						from: 0,
						to: $max,
						speed: 1500,
						refreshInterval: 100
					});
				},{accX: 0, accY: element_appear_amount});
			}
		});
	}
}

/*
**	Counter with random effect
*/
function initCounter(){
	"use strict";

	if($j('.counter.random').length){
		$j('.counter.random').each(function() {
			if(!$j(this).hasClass('executed')){
				$j(this).addClass('executed');
				$j(this).appear(function() {
					$j(this).parent().css('opacity', '1');
					$j(this).absoluteCounter({
						speed: 2000,
						fadeInDelay: 1000
					});
				},{accX: 0, accY: element_appear_amount});
			}
		});
	}
}

/*
**	Horizontal progress bars shortcode
*/
function initProgressBars(){
    "use strict";

    if($j('.edgt_progress_bar').length){
        if($j('.vertical_split_slider').length){
            var acc = 0;
        }else{
            var acc = element_appear_amount;
        }

        $j('.edgt_progress_bar').each(function() {
            if($j(this).parents('.vertical_split_slider').length){
            
                initToCounterHorizontalProgressBar($j(this));
                var percentage = $j(this).find('.progress_content').data('percentage');
                $j(this).find('.progress_content').css('width', '0%');
                $j(this).find('.progress_content').animate({'width': percentage+'%'}, 1500);
                $j(this).find('.progress_number').css('left', '0%');
                $j(this).find('.progress_number').animate({'left': percentage+'%'}, 1500);
            }
            else{
            $j(this).appear(function() {
                initToCounterHorizontalProgressBar($j(this));
                if($j(this).find('.floating.floating_inside') !== 0){
                    var floatingInsideMargin = $j(this).find('.progress_content_outer').height();
                    floatingInsideMargin += parseFloat($j(this).find('.progress_title_holder').css('padding-bottom'));
                    floatingInsideMargin += parseFloat($j(this).find('.progress_title_holder').css('margin-bottom'));
                    $j(this).find('.floating_inside').css('margin-bottom',-(floatingInsideMargin)+'px')

                }
                var percentage = $j(this).find('.progress_content').data('percentage');
                $j(this).find('.progress_content').css('width', '0%');
                $j(this).find('.progress_content').animate({'width': percentage+'%'}, 1500);
                $j(this).find('.progress_number').css('left', '0%');
                $j(this).find('.progress_number').animate({'left': percentage+'%'}, 1500);

            },{accX: 0, accY: acc});
            }
        });
    }
}

/*
**	Counter for horizontal progress bars percent from zero to defined percent
*/
function initToCounterHorizontalProgressBar($this){
	"use strict";

    var percentage = parseFloat($this.find('.progress_content').data('percentage'));
	if($this.find('.progress_number span.percent').length) {
		$this.find('.progress_number span.percent').each(function() {
			$j(this).parents('.progress_number_wrapper').css('opacity', '1');
			$j(this).countTo({
				from: 0,
				to: percentage,
				speed: 1500,
				refreshInterval: 50
			});
		});
	}
}

/*
**	Unordered list animation effect
*/
function initListAnimation(){
	"use strict";

	if($j('.animate_list').length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.animate_list').each(function(){
			$j(this).appear(function() {
				$j(this).find("li").each(function (l) {
					var k = $j(this);
					setTimeout(function () {
						k.animate({
							opacity: 1,
							top: 0
						}, 1500);
					}, 100*l);
				});
			},{accX: 0, accY: element_appear_amount});
		});
	}
}

/*
**	Pie Chart shortcode
*/
function initPieChart(){
	"use strict";

	if($j('.edgt_percentage').length){
		$j('.edgt_percentage').each(function() {

			var $barColor = piechartcolor;

			if($j(this).data('active') !== ""){
				$barColor = $j(this).data('active');
			}

			var $trackColor = '#f6f6f5';

			if($j(this).data('noactive') !== ""){
				$trackColor = $j(this).data('noactive');
			}

			var $line_width = 10;

			if($j(this).data('linewidth') !== ""){
				$line_width = $j(this).data('linewidth');
			}

			var $size = 145;

            if($j(this).data('size') !== ""){
                $size = $j(this).data('size');
            }

            if($j(this).data('alignment') !== ""){
                var $alignment = $j(this).data('alignment');
                if($alignment == 'left'){
                    $j(this).css('margin-left', '0');
                }
                else if($alignment == 'right'){
                    $j(this).css('margin-right', '0');
                }
            }

			$j(this).appear(function() {
				initToCounterPieChart($j(this));
				$j(this).parent().css('opacity', '1');

				$j(this).easyPieChart({
					barColor: $barColor,
					trackColor: $trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: $line_width,
					animate: 1500,
					size: $size
				});
			},{accX: 0, accY: element_appear_amount});
		});
	}
}

/*
**	Pie Chart shortcode
*/
function initPieChartWithIcon(allowInit){
	"use strict";

    if (typeof(allowInit)==='undefined'){
        allowInit = false; // in some case element should not be initialized on document ready
    }

	if($j('.edgt_percentage_with_icon').length){
		$j('.edgt_percentage_with_icon').each(function() {

			var $barColor = piechartcolor;

			if($j(this).data('active') !== ""){
				$barColor = $j(this).data('active');
			}

			var $trackColor = '#f6f6f5';

			if($j(this).data('noactive') !== ""){
				$trackColor = $j(this).data('noactive');
			}

			var $line_width = 10;

			if($j(this).data('linewidth') !== ""){
				$line_width = $j(this).data('linewidth');
			}

			var $size = 145;
            if($j(this).data('size') !== ""){
                $size = $j(this).data('size');
            }

            if((!$j(this).parents('.more_facts_holder').length) || allowInit !== false) {
                $j(this).appear(function () {
                    $j(this).parent().css('opacity', '1');
                    $j(this).css('opacity', '1');
                    $j(this).easyPieChart({
                        barColor: $barColor,
                        trackColor: $trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: $line_width,
                        animate: 1500,
                        size: $size
                    });
                }, {accX: 0, accY: element_appear_amount});
            }

		});
	}
}
/*
**	Counter for pie chart number from zero to defined number
*/
function initToCounterPieChart($this){
	"use strict";

	$j($this).css('opacity', '1');
	var $max = parseFloat($j($this).find('.tocounter').text());
	$j($this).find('.tocounter').countTo({
		from: 0,
		to: $max,
		speed: 1500,
		refreshInterval: 50
	});
}

/*
**	Init Portfolio list and Portfolio Filter
*/
function initPortfolio(){
	"use strict";

	if($j('.projects_holder_outer:not(.masonry_with_space)').length){
		$j('.projects_holder_outer').each(function(){

			$j('.filter_holder .filter').on('click',function(){
				var $this = $j(this).text();
				var dropLabels = $j('.filter_holder').find('.label span');
				dropLabels.each(function(){
					$j(this).text($this);
				});
			});
			
			
			var currentPortfolio = $j(this).find('.projects_holder');
			
			currentPortfolio.mixitup({
				showOnLoad: 'all',
				transitionSpeed: 600,
				minHeight: 150,
                onMixLoad: function(){
                    $j('.projects_holder').addClass('hideItems');
                    $j('.projects_holder article').css('visibility','visible');
					
					if(currentPortfolio.hasClass('portfolio_one_by_one')) {
						currentPortfolio.find('article').each(function(l) {
							var currentPortfolioItem = $j(this);
							if($j('.vertical_split_slider').length){
								var acc = 0;
							}else{
								var acc = -150;
							}

							setTimeout(function() {
								currentPortfolioItem.addClass('show');
							}, 100*l);
						});
					}
                },
                onMixEnd: function() {
                    initParallax();
                }
			});
		});
	}
}

/*
 **	Init z-index for portfolio items
 */
function initPortfolioZIndex(){
	"use strict";

	if($j('.projects_holder_outer.portfolio_no_space').length){
		$j('.no_space.hover_text article').each(function(i){
			$j(this).css('z-index', i +10);
		});
	}
}

function initPortfolioMasonry(){
	"use strict";

    if($j('.projects_masonry_holder, .masonry_with_space').length) {

        $j('.projects_masonry_holder, .masonry_with_space .projects_holder').each(function () {
            var $this = $j(this);
            $this.waitForImages(function () {
                $this.animate({opacity: 1});
                if($j('.projects_masonry_holder').length){
                    resizeMasonry($j('.portfolio_masonry_grid_sizer').width());
                }
                $this.isotope({
                    itemSelector: '.portfolio_masonry_item, .masonry_with_space .mix',
                    masonry: {
                        columnWidth: '.portfolio_masonry_grid_sizer'
                    }
                });
            });
        });

        setPortfolioMasZIndex();

        if ($j('.projects_masonry_holder').length) {
            setPortfolioMasZIndex();
            $j(window).resize(function () {
                resizeMasonry($j('.portfolio_masonry_grid_sizer').width());
                $j('.projects_masonry_holder, .masonry_with_space').isotope('reloadItems');
                setPortfolioMasZIndex();
            });

        }

    }

}

function resizeMasonry(size){
	"use strict";

    var portfolio_masonry_item_default = $j('.portfolio_main_holder .portfolio_masonry_item.default');
    var portfolio_masonry_item_large_width = $j('.portfolio_main_holder .portfolio_masonry_item.large_width');
    var portfolio_masonry_item_large_height = $j('.portfolio_main_holder .portfolio_masonry_item.large_height');
    var portfolio_masonry_item_large_width_height = $j('.portfolio_main_holder .portfolio_masonry_item.large_width_height');

    portfolio_masonry_item_default.css('height', size);

    portfolio_masonry_item_large_width.css('height', size);
    if (portfolio_masonry_item_large_width.width() <= 480) {
        portfolio_masonry_item_large_width.css('height', size/2);
    }

    portfolio_masonry_item_large_height.css('height', 2*size);

    portfolio_masonry_item_large_width_height.css('height', Math.round(2*size));
    if (portfolio_masonry_item_large_width_height.width() <= 480) {
        portfolio_masonry_item_large_width_height.css('height', size);
    }

}


function setPortfolioMasZIndex(){
	"use strict";

    var $elemXPos = {};
    var $elemZIndex = {};

    $j('.projects_masonry_holder article').each(function(){
        $elemXPos[$j(this).index()] = getPortfolioXPos($j(this).css('left'));
    });

    var $elemXPosArray = $j.map($elemXPos, function (value) { return value; });
    $elemXPosArray = cleanPortfolioMasXArray($elemXPosArray);
    $elemXPosArray.sort(function(x,y){return x-y});

    for(var i = 0; i < $elemXPosArray.length; i++){
        $elemZIndex[$elemXPosArray[i]] = i*10;
    }

    $j.each($elemXPos,function(key,val){

        var $zi;
        var $bgd = val;
        $j.each($elemZIndex,function(key,val){
            if($bgd == key) {
                $zi = val;
            }
        });

        $j('.projects_masonry_holder article:eq('+key+')').css('z-index',$zi);
    });
}

function getPortfolioXPos(css) {
    //return css.substr(7, css.length - 8).split(', ')[4];
    return css.substr(0, css.length - 2);
}

function cleanPortfolioMasXArray($elemXPosArray) {
    var i;
    var length = $elemXPosArray.length;
    var $elemXPosOutArray = [];
    var tmp = {};

    for (i = 0; i < length; i++) {
        tmp[$elemXPosArray[i]] = 0;
    }
    for (i in tmp) {
        $elemXPosOutArray.push(i);
    }
    return $elemXPosOutArray;
}

function initPortfolioMasonryFilter(){
	"use strict";

    var portfolioIsotopeAnimation = null;
	$j('.filter:first').addClass('current');
	$j('.filter').click(function(){

        clearTimeout(portfolioIsotopeAnimation);
        $j('.isotope, .isotope .isotope-item').css('transition-duration','0.8s');
        portfolioIsotopeAnimation = setTimeout(function(){  $j('.isotope, .isotope .isotope-item').css('transition-duration','0s'); },700);

        var selector = $j(this).attr('data-filter');
        $j('.projects_masonry_holder, .masonry_with_space .projects_holder').isotope({ filter: selector });

		$j(".filter").removeClass("current");
		$j(this).addClass("current");

        setTimeout(setPortfolioMasZIndex(),700);

		return false;
	});

}

/*
 **	Load more portfolios
 */
function loadMore(){
    "use strict";

    var i = 1;

    $j('.load_more a').on('click', function(e)  {
        e.preventDefault();

        var link = $j(this).attr('href');
        var $content = '.projects_holder';
        var $anchor = '.portfolio_paging .load_more a';
        var $elem = '.mix';
        var $next_href = $j($anchor).attr('href'); // Get URL for the next set of posts
        var filler_num = $j('.projects_holder .filler').length;
		var load_more_holder = $j('.portfolio_paging');
		var loading_holder   = $j('.portfolio_paging_loading');

		load_more_holder.hide();
		loading_holder.show();
        $j.get(link+'', function(data){
            $j('.projects_holder .filler').slice(-filler_num).remove();

            var $new_content = $j($content, data).wrapInner('').html(); // Grab just the content
            $next_href = $j($anchor, data).attr('href'); // Get the new href

            $j($content, data).waitForImages(function() {

                $j('article.mix:last').after($new_content); // Append the new content

                $j('.projects_holder article').css('visibility','visible');
                $j('article:not(.show)').each(function(l){
                    $j(this).addClass('show');
                });

                if($j('.masonry_with_space').length){
                    $j('.masonry_with_space .projects_holder').isotope('reloadItems').isotope();
                }else{
                    var min_height = $j('article.mix:first').height();
                    $j('article.mix').css('min-height',min_height);
                    $j('.projects_holder').mixitup('remix','all');
                }

                setTimeout(function() { //wait for portfolios to rearange and call necesary functions
                    prettyPhoto();
                    initParallax(); //reinitialize parallax and set new image positions
                }, 800); //800 is arbitrarily

                if($j('.load_more').data('rel') > i) {
                    $j('.load_more a').attr('href', $next_href); // Change the next URL
                } else {
                    $j('.load_more').remove();
                }
                $j('.projects_holder .portfolio_paging:last').remove(); // Remove the original navigation
                $j('article.mix').css('min-height',0);
				load_more_holder.show();
				loading_holder.hide();
            });
        });
        i++;
    });
}

/*
 **	Picture popup for portfolio lists and portfolio single
 */
function prettyPhoto(){
    "use strict";

    var iconClasses = getIconClassesForNavigation(directionNavArrows);

    var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="'+iconClasses.rightIconClass+'"></span></a> \
                                            <a class="pp_previous" href="#"><span class="'+iconClasses.leftIconClass+'"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

    $j('a[data-rel]').each(function() {
        $j(this).attr('rel', $j(this).data('rel'));
    });


    $j("a[rel^='prettyPhoto']").prettyPhoto({
        animation_speed: 'normal', /* fast/slow/normal */
        slideshow: false, /* false OR interval time in ms */
        autoplay_slideshow: false, /* true/false */
        opacity: 0.80, /* Value between 0 and 1 */
        show_title: true, /* true/false */
        allow_resize: true, /* Resize the photos bigger than viewport. true/false */
        horizontal_padding: 0,
        default_width: 960,
        default_height: 540,
        counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
        theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
        hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
        wmode: 'opaque', /* Set the flash wmode attribute */
        autoplay: true, /* Automatically start videos: True/False */
        modal: false, /* If set to true, only the close button will close the window */
        overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
        keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
        deeplinking: false,        
        custom_markup: '',
        social_tools: false,
        markup: markupWhole
    });
}

function checkTitleToShowOrHide(){
	if($j('.title_outer.animate_title_area').length){
		var title_area_height = $j('.title_outer').data('height');
		if($scroll > $j('.title').height()){
			$j('.title_outer').css({'height':title_area_height, 'opacity':'1', 'overflow':'visible'});
		}
	}
}

/*
**	Title area animation
*/
function initTitleAreaAnimation(){
	if($j('.title_outer.animate_title_area').length){

		var title_area_height = $j('.title_outer').data('height');
		if($j('.title_outer').hasClass('with_image')){
			title_area_height = $j('.image.responsive').height();
		}
		if($scroll < $j('.title').height()){
			$j('.title_outer').animate({ height: title_area_height, opacity: 1}, 500, function(){
				$j(this).css({'overflow':'visible'});
				initPortfolioSingleInfo();
				if($j('nav.content_menu').length > 0){
					content_menu_position = $j('nav.content_menu').offset().top;
					contentMenuPosition();
					contentMenuOnScroll();
				}
			});
		}
	}
}

/*
**	Title image with parallax effect
*/
function initParallaxTitle(){
	"use strict";

	if(($j('.title').length > 0) && ($j('.touch').length === 0)){

		if($j('.title.has_fixed_background').length){

			var $background_size_width = parseInt($j('.title.has_fixed_background').css('background-size').match(/\d+/));

			var title_holder_height = $j('.title.has_fixed_background').height();
			var title_rate = (title_holder_height / 10000) * 7;
			var title_bpos = -($scroll * title_rate);

			$j('.title.has_fixed_background').css({'background-position': 'center '+ (title_bpos+add_for_admin_bar) +'px' });

			if($j('.title.has_fixed_background').hasClass('zoom_out')){
				$j('.title.has_fixed_background').css({'background-size': $background_size_width-$scroll + 'px auto'});
			}
		}

		$j(window).on('scroll', function() {
			if($j('.title.has_fixed_background').length){

				var title_bpos = -($scroll * title_rate);
				$j('.title.has_fixed_background').css({'background-position': 'center ' + (title_bpos+add_for_admin_bar) + 'px' });
				if($j('.title.has_fixed_background').hasClass('zoom_out')){
					$j('.title.has_fixed_background').css({'background-size': $background_size_width-$scroll + 'px auto'});
				}
			}
		});
	}
}

/*
 Plugin: jQuery Parallax
 Version 1.1.3
 Author: Ian Lunn
 Twitter: @IanLunn
 Author URL: http://www.ianlunn.co.uk/
 Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

 Dual licensed under the MIT and GPL licenses:
 http://www.opensource.org/licenses/mit-license.php
 http://www.gnu.org/licenses/gpl.html
 */

(function( $ ){
    var $window = $(window);
    var windowHeight = $window.height();

    $window.resize(function () {
        windowHeight = $window.height();
    });

    $.fn.parallax = function(xpos, speedFactor, outerHeight) {
        var $this = $(this);
        var getHeight;
        var firstTop;
        var paddingTop = 0;

        //get the starting position of each element to have parallax applied to it
        $this.each(function(){
            firstTop = $this.offset().top;
        });

        if (outerHeight) {
            getHeight = function(jqo) {
                return jqo.outerHeight(true);
            };
        } else {
            getHeight = function(jqo) {
                return jqo.height();
            };
        }

        // setup defaults if arguments aren't specified
        if (arguments.length < 1 || xpos === null) xpos = "50%";
        if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
        if (arguments.length < 3 || outerHeight === null) outerHeight = true;

        // function to be called whenever the window is scrolled or resized
        function update(){
            var pos = $window.scrollTop();

            $this.each(function(){
                var $element = $(this);
                var top = $element.offset().top;
                var height = getHeight($element);

                // Check if totally above or totally below viewport
                if (top + height < pos || top > pos + windowHeight) {
                    return;
                }

                $this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
            });
        }

        $window.bind('scroll', update).resize(update);
        update();
    };
})(jQuery);


/*
 **	Sections with parallax background image
 */
function initParallax(){
    "use strict";

    if($j('.parallax_section_holder').length){
        $j('.parallax_section_holder').each(function() {
            if($j(this).hasClass('full_screen_height_parallax')){ $j(this).height($window_height); $j(this).find('.parallax_content_outer').css('padding',0); }
            var speed = $j(this).data('speed')*0.4;
            $j(this).parallax("50%", speed);
        });
    }
}

/*
**	Smooth scroll functionality for Side Area
*/
function initSideAreaScroll(){
	"use strict";

	if($j('.side_menu').length){
		$j(".side_menu").niceScroll({
			scrollspeed: 60,
			mousescrollstep: 40,
			cursorwidth: 0,
			cursorborder: 0,
			cursorborderradius: 0,
			cursorcolor: "transparent",
			autohidemode: false,
			horizrailenabled: false
		});
	}
}

/*
 **	Smooth scroll functionality for Vertical Menu Area Toogle style
 */
function initVerticalAreaMenuScroll(){
	"use strict";

	if($j('.vertical_menu_area.with_scroll').length){
		$j(".vertical_menu_area.with_scroll").niceScroll({
			scrollspeed: 60,
			mousescrollstep: 40,
			cursorwidth: 0,
			cursorborder: 0,
			cursorborderradius: 0,
			cursorcolor: "transparent",
			autohidemode: false,
			horizrailenabled: false
		});

	}
}

/*
**	Show/Hide Mobile menu
*/
function initMobileMenu(){
	"use strict";

	$j(".mobile_menu_button > span").on('tap click', function(e){
        e.preventDefault();

        if ($j(".mobile_menu > ul").is(":visible")){
			$j(".mobile_menu > ul").slideUp(200);
		} else {
			$j(".mobile_menu > ul").slideDown(200);
		}
	});

	$j(".mobile_menu > ul > li.has_sub > span.mobile_arrow, .mobile_menu > ul > li.has_sub > h3, .mobile_menu > ul > li.has_sub > a[href*='#']").on('tap click', function(e){
        e.preventDefault();

        if ($j(this).closest('li.has_sub').find("> ul.sub_menu").is(":visible")){
			$j(this).closest('li.has_sub').find("> ul.sub_menu").slideUp(200);
			$j(this).closest('li.has_sub').removeClass('open_sub');
		} else {
			$j(this).closest('li.has_sub').addClass('open_sub');
			$j(this).closest('li.has_sub').find("> ul.sub_menu").slideDown(200);
		}
	});

	$j(".mobile_menu > ul > li.has_sub > ul.sub_menu > li.has_sub > span.mobile_arrow, .mobile_menu > ul > li.has_sub > ul.sub_menu > li.has_sub > h3, .mobile_menu > ul > li.has_sub > ul.sub_menu > li.has_sub > a[href*='#']").on('tap click', function(e){
        e.preventDefault();

        if ($j(this).parent().find("ul.sub_menu").is(":visible")){
			$j(this).parent().find("ul.sub_menu").slideUp(200);
			$j(this).parent().removeClass('open_sub');
		} else {
			$j(this).parent().addClass('open_sub');
			$j(this).parent().find("ul.sub_menu").slideDown(200);
		}
	});

	$j(".mobile_menu ul li > a, .edgt_logo a").on('click', function(){

        if(($j(this).attr('href') !== "http://#") && ($j(this).attr('href') !== "#")){
            $j(".mobile_menu > ul").slideUp();
		}
	});
}

/*
**	Init flexslider for portfolio single
*/
function initFlexSlider(){
    "use strict";
    $j('.flexslider').each(function(){
        var interval = 8000;
        if(typeof $j(this).data('interval') !== 'undefined' && $j(this).data('interval') !== false) {
            interval = parseFloat($j(this).data('interval')) * 1000;
        }

        var slideshow = true;
        if(interval === 0) {
            slideshow = false;
        }

        var animation = 'slide';
        if(typeof $j(this).data('flex_fx') !== 'undefined' && $j(this).data('flex_fx') !== false) {
            animation = $j(this).data('flex_fx');
        }

        var directionNav = true;
        if(typeof $j(this).data('disable-navigation-arrows') !== 'undefined') {
            directionNav = $j(this).data('disable-navigation-arrows') == 'yes' ? false : true;
        }

        var controlNav = false;
        if(typeof $j(this).data('show-navigation-controls') !== 'undefined') {
            controlNav = $j(this).data('show-navigation-controls') == 'no' ? false : true;
        }

        var iconClasses = getIconClassesForNavigation(directionNavArrows);

        $j(this).flexslider({
            animationLoop: true,
            controlNav: controlNav,
            directionNav: directionNav,
            useCSS: false,
            pauseOnAction: true,
            pauseOnHover: true,
            slideshow: slideshow,
            animation: animation,
            prevText: '<span class="'+iconClasses.leftIconClass+'"></span>',
            nextText: '<span class="'+iconClasses.rightIconClass+'"></span>',
            animationSpeed: 600,
            slideshowSpeed: interval,
            start: function(){
                setTimeout(function(){$j(".flexslider").fitVids();},100);
            }
        });

        $j('.flex-direction-nav a').click(function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();
        });
    });
}

/*
**	Init fitVideo function for responsive video files
*/
function fitVideo(){
	"use strict";

	$j(".portfolio_images").fitVids();
	$j(".video_holder").fitVids();
	$j(".format-video .post_image").fitVids();
	$j(".format-video .edgt_masonry_blog_post_image").fitVids();
}

/*
**	Function for follow portfolio single descripton
*/
var $scrollHeight;
function initPortfolioSingleInfo(){
	"use strict";

	var $sidebar = $j(".portfolio_single_follow");
	if($j(".portfolio_single_follow").length > 0){

		var offset = $sidebar.offset();
		$scrollHeight = $j(".portfolio_container").height();
		var $scrollOffset = $j(".portfolio_container").offset();
		var $window = $j(window);

		var $headerHeight = parseInt($j('header.page_header').css('height'), 10);

		$window.scroll(function() {
            $headerHeight = parseInt($j('header.page_header').css('height'), 10);
			if($window.width() > 960){
				if ($window.scrollTop() + $headerHeight > offset.top) {
					if ($window.scrollTop() + $headerHeight + $sidebar.height() + 24 < $scrollOffset.top + $scrollHeight) {
						$sidebar.stop().animate({
							marginTop: $window.scrollTop() - offset.top + $headerHeight
						});
					} else {
						$sidebar.stop().animate({
							marginTop: $scrollHeight - $sidebar.height() - 24
						});
					}
				} else {
					$sidebar.stop().animate({
						marginTop: 0
					});
				}
			}else{
				$sidebar.css('margin-top',0);
			}
		});
	}
}

/*
**	Plugin for preload hover image
*/
$j.fn.preload = function() {
	"use strict";

	this.each(function(){
		$j('<img/>')[0].src = this;
	});
};

/*
**	Init tabs shortcodes
*/
function initTabs(){
	"use strict";
	if($j('.edgt_tabs').length){
		$j('.edgt_tabs').appear(function() {
			$j('.edgt_tabs').css('visibility', 'visible');
		},{accX: 0, accY: element_appear_amount});
		var $tabsNav = $j('.tabs-nav');
		var $tabsNavLis = $tabsNav.children('li');
		$tabsNav.each(function() {
			var $this = $j(this);
			$this.next().children('.tab-content').stop(true,true).hide().first().show();
			$this.children('li').first().addClass('active').stop(true,true).show();
		});
		$tabsNavLis.on('click', function(e) {
			var $this = $j(this);
			$this.siblings().removeClass('active').end().addClass('active');
			$this.parent().next().children('.tab-content').stop(true,true).hide().siblings( $this.find('a').attr('href') ).fadeIn();
			e.preventDefault();
		});
	}
}

/*
 **	Init accordion and toogle shortcodes
 */
function initAccordion() {
	"use strict";

	if($j(".edgt_accordion_holder").length){
		$j(".edgt_accordion_holder").appear(function() {
			$j(".edgt_accordion_holder").css('visibility', 'visible');
		},{accX: 0, accY: element_appear_amount});

		if ($j(".accordion").length) {
			$j(".accordion").accordion({
				animate: "swing",
				collapsible: true,
				active: false,
				icons: "",
				heightStyle: "content"
			});

            //define custom options for each accordion
            $j(".accordion").each(function() {
                var activeTab = parseInt($j(this).data('active-tab'));
                if(activeTab !== "") {
                    activeTab = activeTab - 1; // - 1 because active tab is set in 0 index base
                    $j(this).accordion('option', 'active', activeTab);
                }
				var borderRadius = parseInt($j(this).data('border-radius'));

				if(borderRadius !== "") {
					$j(this).find('.accordion_mark').css('border-radius', borderRadius+"px");
				}
                var collapsible = ($j(this).data('collapsible') == 'yes') ? true : false;
                $j(this).accordion('option', 'collapsible', collapsible);
                $j(this).accordion('option', 'collapsible', collapsible);
            });
		}
		$j(".toggle").addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset")
		.find(".title-holder")
		.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom")
		.hover(function() {
			$j(this).toggleClass("ui-state-hover");
		})
		.click(function() {
			$j(this)
				.toggleClass("ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom")
				.next().toggleClass("ui-accordion-content-active").slideToggle(400);
			return false;
		})
		.next()
		.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom")
		.hide();

        $j(".toggle").each(function() {
            var activeTab = parseInt($j(this).data('active-tab'));
            if(activeTab !== "" && activeTab >= 1) {
                activeTab = activeTab - 1; // - 1 because active tab is set in 0 index base
                $j(this).find('.ui-accordion-content').eq(activeTab).show();
                $j(this).find('.ui-accordion-header').eq(activeTab).addClass('ui-state-active'); //set active accordion header
            }

        });
	}
}

/*
**	Function to enable link in accordion
*/
function initAccordionContentLink(){
	"use strict";

	if($j(".accordion").length){
		$j('.accordion_holder .accordion_inner .accordion_content a').click(function(){
			if($j(this).attr('target') === '_blank'){
				window.open($j(this).attr('href'),'_blank');
			}else{
				window.open($j(this).attr('href'),'_self');
			}
			return false;
		});
	}
}

/*
**	Init testimonials shortcode
*/
function initTestimonials(){
	"use strict";

    if($j('.testimonials_carousel').length){
        $j('.testimonials_carousel').each(function(){
            $j(this).appear(function() {
                $j(this).css('visibility','visible');
            },{accX: 0, accY: element_appear_amount});

            var interval = 5000;
            if(typeof $j(this).data('auto-rotate-slides') !== 'undefined' && $j(this).data('auto-rotate-slides') !== false) {
                interval = parseFloat($j(this).data('auto-rotate-slides')) * 1000;
            }

            var slideshow = true;
            if(interval === 0) {
                slideshow = false;
            }


            var controlNav = true;
            if(typeof $j(this).data('show-navigation') !== 'undefined') {
                controlNav = $j(this).data('show-navigation') == 'no' ? false : true;
            }

			var directionNav = true;
            if(typeof $j(this).data('show-navigation-arrows') !== 'undefined') {
                directionNav = $j(this).data('show-navigation-arrows') == 'no' ? false : true;
            }

            var animationSpeed = 600;
            if(typeof $j(this).data('animation-speed') !== 'undefined' && $j(this).data('animation-speed') !== false) {
                animationSpeed = $j(this).data('animation-speed');
            }

            var iconClasses = getIconClassesForNavigation(directionNavArrowsTestimonials);

            $j(this).flexslider({
                animationLoop: true,
                controlNav: controlNav,
                directionNav: directionNav,
                useCSS: false,
                pauseOnAction: true,
                pauseOnHover: false,
                slideshow: slideshow,
                animation: 'fade',
                itemMargin: 25,
                minItems: 1,
                maxItems: 1,
				prevText: '<span class="'+iconClasses.leftIconClass+'"></span>',
				nextText: '<span class="'+iconClasses.rightIconClass+'"></span>',
                animationSpeed: animationSpeed,
                slideshowSpeed: interval,
                start: function(slider){
                    initParallax();
                }
            });
        });

    }
}


/*
** Testimonials slider height (only for image absolute position)
*/

function setTestimonialsEqualHeight(){
	"use strict";
	
	if($j('.testimonials .slides li.absolute_position').length){
		var heights = new Array();

		$j('.testimonials .slides li.absolute_position').each(function(){
			$j(this).css('min-height', '0');
			$j(this).css('max-height', 'none');
			$j(this).css('height', 'auto');

			heights.push($j(this).height());
		});

		var max = Math.max.apply( Math, heights );
		
		$j('.testimonials .slides li.absolute_position').each(function(){
				$j(this).css('height', max + 'px');
		}); 
	}
}

/*
 **	Init content slider shortcode
 * Flexslider action and data parameters for it
 */
function initContentSlider(){
	"use strict";

	if($j('.content_flexslider').length){
		$j('.content_flexslider').each(function(){

			var controlNav = true;
			if(typeof $j(this).data('show-navigation') !== 'undefined') {
				controlNav = $j(this).data('show-navigation') == 'no' ? false : true;
			}

			var directionNav = true;
			if(typeof $j(this).data('show-navigation-arrows') !== 'undefined') {
				directionNav = $j(this).data('show-navigation-arrows') == 'no' ? false : true;
			}

			var animationSpeed = 600;
			if(typeof $j(this).data('animation-speed') !== 'undefined' && $j(this).data('animation-speed') !== false) {
				animationSpeed = $j(this).data('animation-speed');
			}
			var iconClasses = getIconClassesForNavigation(directionNavArrows);


			$j(this).flexslider({
				animationLoop: true,
				controlNav: controlNav,
				directionNav: directionNav,
				useCSS: false,
				pauseOnAction: true,
				pauseOnHover: false,
				slideshow: true,
				minItems: 1,
				maxItems: 1,
				animation: 'slide',
				animationSpeed: animationSpeed,
				slideshowSpeed: 8000,
				prevText: '<span class="'+iconClasses.leftIconClass+'"></span>',
				nextText: '<span class="'+iconClasses.rightIconClass+'"></span>',
				smoothHeight: true,
				start: function(slider){
					$j(this).find('.content_slide').show();
				}
			});
		});

	}
}

/*
**	Function to close message shortcode
*/
function initMessages(){
	"use strict";

	if($j('.edgt_message').length){
		$j('.edgt_message').each(function(){
			$j(this).find('.close').click(function(e){
				e.preventDefault();
				$j(this).parent().parent().fadeOut(500);
			});
		});
	}
}
/*
**	Init Element Animations
*/
function initElementsAnimation(){
	"use strict";

	if($j(".element_from_fade").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_fade').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_fade_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".element_from_left").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_left').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_left_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".element_from_right").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_right').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_right_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".element_from_top").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_top').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_top_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".element_from_bottom").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_bottom').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_bottom_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".element_transform").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_transform').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_transform_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}
}

/*
 **	Init Elements Holder Item Animation
 */

function initElementsHolderItemAnimation(){
	"use strict";

	if($j(".flip_in").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.flip_in').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('flip_in_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".grow_in").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.grow_in').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('grow_in_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".x_rotate").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.x_rotate').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('x_rotate_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".z_rotate").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.z_rotate').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('z_rotate_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".y_translate").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.y_translate').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('y_translate_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".fade_in").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.fade_in').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('fade_in_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".fade_in_down").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.fade_in_down').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('fade_in_down_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}

	if($j(".fade_in_left_x_rotate").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.fade_in_left_x_rotate').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('fade_in_left_x_rotate_on');
			},{accX: 0, accY: element_appear_amount});
		});
	}
}

/*
**	Init progress bar with icon
*/
var timeOuts = [];
function initProgressBarsIcon(){
	"use strict";

	if($j('.edgt_progress_bars_icons_holder').length){
		$j('.edgt_progress_bars_icons_holder').each(function() {
			var $this = $j(this);
			$this.appear(function() {
				$this.find('.edgt_progress_bars_icons').css('opacity','1');
				$this.find('.edgt_progress_bars_icons').each(function() {
					var number = $j(this).find('.edgt_progress_bars_icons_inner').data('number');
					var size = $j(this).find('.edgt_progress_bars_icons_inner').data('size');

					if(size !== ""){
						$j(this).find('.edgt_progress_bars_icons_inner.custom_size .bar').css({'width': size+'px','height':size+'px'});
						$j(this).find('.edgt_progress_bars_icons_inner.custom_size .bar .edgt_icon_stack').css({'font-size': size/2+'px'});
					}

					var bars = $j(this).find('.bar');

					bars.each(function(i){
						if(i < number){
							var time = (i + 1)*150;
							timeOuts[i] = setTimeout(function(){
								$j(bars[i]).addClass('active');
							},time);
						}
					});
				});
			},{accX: 0, accY: element_appear_amount});
		});
	}
}

/*
**	Init more facts shortcode
*/
function initMoreFacts(){
	"use strict";

	if($j('.more_facts_holder').length){
		$j('.more_facts_holder').each(function(){
			var $this = $j(this);

			var $more_label = 'More Facts';

			if($this.find('.more_facts_button').data('morefacts') !== ""){
				$more_label = $this.find('.more_facts_button').data('morefacts');
			}

			var $less_label = 'Less Facts';

			if($this.find('.more_facts_button').data('lessfacts') !== ""){
				$less_label = $this.find('.more_facts_button').data('lessfacts');
			}

			var height = $this.find('.more_facts_inner').height() + 70;

			var speed;
			if(height > 0 && height < 601){
				speed = 500;
			} else if(height > 600 && height < 1201){
				speed = 800;
			} else{
				speed = 1500;
			}
			$this.find('.more_facts_inner_holder').css({'height':'0px','display':'none','opacity':'0'});

			$this.find('.more_facts_button').on("mouseenter",function(){
				$j(this).css('color',$j(this).data('hovercolor'));
			}).on("mouseleave",function() {
				if(!$this.find('.more_facts_inner_holder').is(':visible')){
					$j(this).css('color',$j(this).data('color'));
				}
			});

			$this.find('.more_facts_button').click(function(){
				if(!$this.find('.more_facts_inner_holder').is(':visible')){
					$this.find('.more_facts_fake_arrow').fadeIn(speed);
					$this.addClass('more_fact_opened');
					$j(this).parent().parent().find('.more_facts_inner_holder').css({'display':'block','opacity':'1'}).stop().animate({'height': height+30}, speed, function() {
						if($j('.parallax_section_holder').length) {
							initParallax();
						}
					});
					$j(this).find('.more_facts_button_text').text($less_label);
					$j(this).find('.more_facts_button_arrow').addClass('rotate_arrow');
                    initPieChartWithIcon(true);
				} else {
					$this.find('.more_facts_fake_arrow').fadeOut(speed);
					$j(this).parent().parent().find('.more_facts_inner_holder').stop().animate({'height': '0px'}, speed,function(){
						$j(this).css({'display':'none','opacity':'0'});

						if(!$this.find('.more_facts_button').is(":hover")){$this.find('.more_facts_button').css('color',$this.find('.more_facts_button').data('color'));}
						$this.removeClass('more_fact_opened');
						if($j('.parallax_section_holder').length) {
							initParallax();
						}
					});
					$j(this).find('.more_facts_button_text').text($more_label);
					$j(this).find('.more_facts_button_arrow').removeClass('rotate_arrow');
				}
			});
		});
	}
}

/*
**	Replace plceholder
*/
function placeholderReplace(){
	"use strict";

	$j('#contact-form [placeholder]').focus(function() {
		var input = $j(this);
		if (input.val() === input.attr('placeholder')) {
			if (this.originalType) {
				this.type = this.originalType;
				delete this.originalType;
			}
			input.val('');
			input.removeClass('placeholder');
		}
	}).blur(function() {
		var input = $j(this);
		if (input.val() === '') {
			if (this.type === 'password') {
				this.originalType = this.type;
				this.type = 'text';
			}
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		}
	}).blur();

	$j('#contact-form [placeholder]').parents('form').submit(function () {
		$j(this).find('[placeholder]').each(function () {
			var input = $j(this);
			if (input.val() === input.attr('placeholder')) {
				input.val('');
			}
		});
	});
}

function totop_button(a) {
	"use strict";

	var b = $j("#back_to_top");
	b.removeClass("off on");
	if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
}

function backButtonShowHide(){
	"use strict";

	$j(window).scroll(function () {
		var b = $j(this).scrollTop();
		var c = $j(this).height();
		var d;
		if (b > 0) { d = b + c / 2; } else { d = 1; }
		if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
	});
}

function backToTop(){
	"use strict";

	$j(document).on('click','#back_to_top, .back_to_top_icon',function(e){
		e.preventDefault();

		$j('body,html').animate({scrollTop: 0}, $j(window).scrollTop()/3, 'linear');
	});
}

/*
 **	Init message height
 */
function initMessageHeight(){
    "use strict";
    if($j('.edgt_message.with_icon').length){
        $j('.edgt_message.with_icon').each(function(){
			if($j(this).find('.message_text_holder').height() > $j(this).find('.edgt_message_icon_holder').height()) {
				$j(this).find('.edgt_message_icon_holder').height($j(this).find('.message_text').height());
			} else {
				$j(this).find('.message_text').height($j(this).find('.edgt_message_icon_holder').height());
			}
        });
    }
}

/**
 * Init image hover
 */
function initImageHover() {
    "use strict";
	if($j('.image_hover').length){
		$j('.image_hover').each(function(){
			$j(this).appear(function() {

                var default_visible_time = 300;
                var transition_delay = $j(this).attr('data-transition-delay');
                var real_transition_delay = default_visible_time + parseFloat(transition_delay);
                var object = $j(this);

                //wait for other hovers to complete
                setTimeout(function() {
                    object.addClass('show');
                }, parseFloat(transition_delay));

                //hold that image a little, than remove class
                setTimeout(function() {
                    object.removeClass('show');
                }, real_transition_delay);

			},{accX: 0, accY: element_appear_amount});
		});
	}
}

/*
 * Initializes vertical progress bars
 */
function initProgressBarsVertical(){
	"use strict";

	if($j('.edgt_progress_bars_vertical').length){
		$j('.edgt_progress_bars_vertical').each(function() {
			$j(this).appear(function() {
				initToCounterVerticalProgressBar($j(this));
					var percentage = $j(this).find('.progress_content').data('percentage');
					$j(this).find('.progress_content').css('height', '0%');
					$j(this).find('.progress_content').animate({
						height: percentage+'%'
					}, 1500);
			},{accX: 0, accY: element_appear_amount});
		});
	}
}

/*
 * Initializes vertical progress bar count to max value
 */
function initToCounterVerticalProgressBar($this){
	"use strict";

	if($this.find('.progress_number span').length){
		$this.find('.progress_number span').each(function() {
			var $max = parseFloat($j(this).text());
			$j(this).countTo({
				from: 0,
				to: $max,
				speed: 1500,
				refreshInterval: 50
			});
		});
	}
}

/*
*	Check if there is anchor on load and scroll to it
*/
function checkAnchorOnLoad(){
    "use strict";

    var hash = window.location.hash;
    var scrollToAmount;
    if(hash !== "" && $j('[data-edgt_id="'+hash+'"]').length > 0){
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
        $j('html, body').animate({
            scrollTop: Math.round(scrollToAmount)
        }, 1500, function() {});
    }
	
	//remove active state on anchors if section is not visible
	$j(".main_menu a, .vertical_menu a, .popup_menu a, .mobile_menu a").each(function(){
        var i = $j(this).prop("hash");        
		if(i !== "" && ($j('[data-edgt_id="' + i + '"]').length > 0) && ($j('[data-edgt_id="' + i + '"]').offset().top >= $window_height) && $scroll == 0){
			$j(this).parent().removeClass('active');
			$j(this).removeClass('current');
		}
    });

}

/*
*	Check active state of anchor links on scroll
*/

function changeActiveState(id){
    "use strict";
	
	$j('.main_menu a').parent().removeClass('active');
	$j(".main_menu a").each(function(){
		var i = $j(this).prop("hash");
		if(i === id){
			if($j(this).closest('.second').length === 0){
				$j(this).parent().addClass('active');
			}else{
				$j(this).closest('.second').parent().addClass('active');
			}
			$j('.main_menu a').removeClass('current');
			$j(this).addClass('current');
		}
	});
	
	$j('.vertical_menu a').parent().removeClass('active');
	$j(".vertical_menu a").each(function(){
		var i = $j(this).prop("hash");
		if(i === id){
			if($j(this).closest('.second').length === 0){
				$j(this).parent().addClass('active');
			}else{
				$j(this).closest('.second').parent().addClass('active');
			}
			$j('.vertical_menu a').removeClass('current');
			$j(this).addClass('current');
		}
	});
	
	$j('.popup_menu a').parent().removeClass('active');
	 $j(".popup_menu a").each(function(){
		var i = $j(this).prop("hash");
		if(i === id){
			if($j(this).closest('.second').length === 0){
				$j(this).parent().addClass('active');
			}else{
				$j(this).closest('.second').parent().addClass('active');
			}
			$j('.popup_menu a').removeClass('current');
			$j(this).addClass('current');
		}
	});

	$j('.mobile_menu a').parent().removeClass('active');
	$j(".mobile_menu a").each(function(){
		var i = $j(this).prop("hash");
		if(i === id){
			if($j(this).closest('.sub_menu').length === 0){
				$j(this).parent().addClass('active');
			}else{
				$j(this).closest('.sub_menu').parent().addClass('active');
			}
			$j('.mobile_menu a').removeClass('current');
			$j(this).addClass('current');
		}
	});
}

function checkAnchorOnScroll(){
    "use strict";
    if($j('[data-edgt_id]').length){
        
        $j('[data-edgt_id]').waypoint( function(direction) {
            if(direction === 'down') {
                changeActiveState($j(this).data("edgt_id"));
            }
        }, { offset: '50%' });

        $j('[data-edgt_id]').waypoint( function(direction) {
            if(direction === 'up') {
                changeActiveState($j(this).data("edgt_id"));
            }
        }, { offset: function(){
            return -($j(this).outerHeight() - 150);
        } });

    }
}

/*
*	Init scroll to section link if that link has hash value
*/
function initHashClick(){
    "use strict";

    var $doc = $j('html, body');
    var scrollToAmount;
    $j(document).on( "click", ".main_menu a, .vertical_menu a, .popup_menu a, .qbutton, .anchor, .widget li.anchor a", function(){
        var $this = $j(this);
        var hash = $j(this).prop("hash");
        if(loadedPageFlag == true && ((hash !== "" && $j(this).attr('href').split('#')[0] === "") || (hash !== "" && $j(this).attr('href').split('#')[0] !== "" && hash === window.location.hash) || (hash !== "" && $j(this).attr('href').split('#')[0] == window.location.href.split('#')[0]))){ //in third condition 'hash !== ""' stays to prevent reload of page when link is active and ajax enabled
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


            if($j('[data-edgt_id="'+hash+'"]').length > 0){
                $doc.stop().animate({
                    scrollTop: Math.round(scrollToAmount)
                }, 1500, function() {
                    anchorActiveState($this);
                });

            }

            if(history.pushState) {
                history.pushState(null, null, hash);
            }
            return false;
        }

    });
    $j(document).on( "click", ".mobile_menu a", function(){
        var $this = $j(this);
        var hash = $j(this).prop("hash");
        if((hash !== "" && $j(this).attr('href').split('#')[0] === "") || (hash !== "" && $j(this).attr('href').split('#')[0] !== "" && hash === window.location.hash) || (hash !== "" && $j(this).attr('href').split('#')[0] == window.location.href.split('#')[0])){ //in third condition 'hash !== ""' stays to prevent reload of page when link is active and ajax enabled

            if($j('[data-edgt_id="'+hash+'"]').length > 0){
                $doc.animate({
                    scrollTop: Math.round($j('[data-edgt_id="'+hash+'"]').offset().top - $j('.mobile_menu').height())
                }, 500,function(){
                    anchorActiveState($this);
                });

            }
            if(history.pushState) {
                history.pushState(null, null, hash);
            }
            return false;
        }

    });
}

/*
**	Calculate height for animated text icon shortcode
*/
function animatedTextIconHeight(){
	"use strict";

	if($j('.animated_icons_with_text').length){
		var $icons = $j('.animated_icons_with_text');
		var maxHeight;

		$icons.find('.animated_text p').each(function() {
			maxHeight = maxHeight > $j(this).height() ? maxHeight : $j(this).height();
		});

		if(maxHeight < 155) {
			maxHeight = 155;

		}
		$icons.find('.animated_icon_with_text_inner').height(maxHeight);
	}
}

/*
**	Add class to items in last row in animated text icon shortcode
*/
function countAnimatedTextIconPerRow(){
	"use strict";

	if($j('.animated_icons_with_text').length){
		$j('.animated_icons_with_text').each(function() {
			var $icons = $j(this);
			var edgt_icons_height = $icons.height();
			var edgt_icons_width = $icons.width();
			var maxHeightIcons;
			var iconWidth = $icons.find('.animated_icon_with_text_holder').width() + 1; // 1px because safari round on smaller number
			var countIcons = $icons.find('.animated_icon_with_text_holder').length;
			$icons.find('.animated_icon_with_text_holder').each(function() {
				maxHeightIcons = maxHeightIcons > $j(this).height() ? maxHeightIcons : $j(this).height();
			});
			maxHeightIcons = maxHeightIcons + 30; //margin for client is 30
			var numberOfIconsPerRow =  Math.ceil((edgt_icons_width/iconWidth));
			var numberOffullRows = Math.floor(countIcons / numberOfIconsPerRow);
			var numberOfIconsInLastRow = countIcons - (numberOfIconsPerRow * numberOffullRows);
			if(numberOfIconsInLastRow === 0){
				numberOfIconsInLastRow = numberOfIconsPerRow;
			}
			$icons.find( ".animated_icon_with_text_holder" ).removeClass('border-bottom-none');
			var item_start_from = countIcons - numberOfIconsInLastRow - 1;
			$icons.find( ".animated_icon_with_text_holder:gt("+ item_start_from +")" ).addClass('border-bottom-none');
		});
	}
}


/*
**	Add class to items in last row in clients shortcode
*/
function countClientsPerRow(){
	"use strict";

	if($j('.edgt_clients').length){

		$j('.edgt_clients').each(function() {
			var $clients = $j(this);
			var edgt_clients_height = $clients.height();
			var edgt_clients_width = $clients.width();
			var maxHeightClient;
			var clientWidth = $clients.find('.edgt_client_holder').width();
			var countClient = $clients.find('.edgt_client_holder').length;
			$clients.find('.edgt_client_holder').each(function() {
				maxHeightClient = maxHeightClient > $j(this).height() ? maxHeightClient : $j(this).height();
			});
			maxHeightClient = maxHeightClient + 35; //margin for client is 35
			var numberOfRows  = Math.ceil(edgt_clients_height / maxHeightClient);
			var numberOfClientsPerRow =  Math.ceil(edgt_clients_width/clientWidth);
			var numberOffullRows = Math.floor(countClient / numberOfClientsPerRow);
			var numberOfClientsInLastRow = countClient - (numberOfClientsPerRow * numberOffullRows);
			if(numberOfClientsInLastRow === 0){
				numberOfClientsInLastRow = numberOfClientsPerRow;
			}
			$clients.find( ".edgt_client_holder" ).removeClass('border-bottom-none');
			var item_start_from = countClient - numberOfClientsInLastRow - 1;
			$clients.find( ".edgt_client_holder:gt("+ item_start_from +")" ).addClass('border-bottom-none');
		});
	}
}

/*
*	Set active state in maim menu on anchor click
*/

function anchorActiveState(me){
	if(me.closest('.main_menu').length > 0){
		$j('.main_menu a').parent().removeClass('active');
	}
	
	if(me.closest('.popup_menu').length > 0){
		$j('.popup_menu a').parent().removeClass('active');
	}

    if(me.closest('.vertical_menu').length > 0){
        $j('.vertical_menu a').parent().removeClass('active');
    }

	if(me.closest('.second').length === 0){
		me.parent().addClass('active');
	}else{
		me.closest('.second').parent().addClass('active');
	}
	if(me.closest('.mobile_menu').length > 0){
		$j('.mobile_menu a').parent().removeClass('active');
		me.parent().addClass('active');
	}

	$j('.mobile_menu a, .main_menu a, .vertical_menu a, .popup_menu a').removeClass('current');
	me.addClass('current');
}

/*
**	Video background initialization
*/
function initVideoBackground(){
	"use strict";

	$j('.video-wrap .video').mediaelementplayer({
		enableKeyboard: false,
		iPadUseNativeControls: false,
		pauseOtherPlayers: false,
		// force iPhone's native controls
		iPhoneUseNativeControls: false,
		// force Android's native controls
		AndroidUseNativeControls: false
	});

	//mobile check
		if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
			initVideoBackgroundSize();
			$j('.mobile-video-image').show();
			$j('.video-wrap').remove();
		}
}

/*
**	Calculate video background size
*/
function initVideoBackgroundSize(){
	"use strict";

	$j('.section .video-wrap').each(function(i){

		var $sectionWidth = $j(this).closest('.section').outerWidth();
		$j(this).width($sectionWidth);

		var $sectionHeight = $j(this).closest('.section').outerHeight();
		min_w = vid_ratio * ($sectionHeight+20);
		$j(this).height($sectionHeight);

		var scale_h = $sectionWidth / video_width_original;
		var scale_v = ($sectionHeight - header_height) / video_height_original;
		var scale =  scale_v;
		if (scale_h > scale_v)
			scale =  scale_h;
		if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

		$j(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
		$j(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
		$j(this).scrollLeft(($j(this).find('video').width() - $sectionWidth) / 2);
		$j(this).find('.mejs-overlay, .mejs-poster').scrollTop(($j(this).find('video').height() - ($sectionHeight)) / 2);
		$j(this).scrollTop(($j(this).find('video').height() - ($sectionHeight)) / 2);
	});

	$j('.carousel .item .video .video-wrap').each(function(i){

		var $slideWidth = $j(window).width();
		$j(this).width($slideWidth);

		var mob_header = $j(window).width() < 1000 ? $j('header.page_header').height() - 6 : 0; // 6 is because of the display: inline-block
		var $slideHeight = $j(this).closest('.carousel.slide').height() - mob_header;

		min_w = vid_ratio * ($slideHeight+20);
		$j(this).height($slideHeight);

		var scale_h = $slideWidth / video_width_original;
		var scale_v = ($slideHeight - header_height) / video_height_original;
		var scale =  scale_v;
		if (scale_h > scale_v)
			scale =  scale_h;
		if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

		$j(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
		$j(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
		$j(this).scrollLeft(($j(this).find('video').width() - $slideWidth) / 2);
		$j(this).find('.mejs-overlay, .mejs-poster').scrollTop(($j(this).find('video').height() - ($slideHeight)) / 2);
		$j(this).scrollTop(($j(this).find('video').height() - ($slideHeight)) / 2);
	});

	$j('.portfolio_single .video .video-wrap, .blog_holder .video .video-wrap').each(function(i){

		var $this = $j(this);

		var $videoWidth = $j(this).closest('.video').outerWidth();
		$j(this).width($videoWidth);
		var $videoHeight = ($videoWidth*9)/16;

		if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
			$this.parent().width($videoWidth);
			$this.parent().height($videoHeight);
		}

		min_w = vid_ratio * ($videoHeight+20);
		$j(this).height($videoHeight);

		var scale_h = $videoWidth / video_width_original;
		var scale_v = ($videoHeight - header_height) / video_height_original;
		var scale =  scale_v;
		if (scale_h > scale_v)
			scale =  scale_h;
		if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

		$j(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
		$j(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
		$j(this).scrollLeft(($j(this).find('video').width() - $videoWidth) / 2);
		$j(this).find('.mejs-overlay, .mejs-poster').scrollTop(($j(this).find('video').height() - ($videoHeight)) / 2);
		$j(this).scrollTop(($j(this).find('video').height() - ($videoHeight)) / 2);
	});

}

/*
**	Icon With Text animation effect
*/
function initIconWithTextAnimation(){
	"use strict";
	if($j('.edgt_icon_animation').length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.edgt_icon_animation').each(function(){
			$j(this).appear(function() {
				$j(this).addClass('edgt_show_animation');
			},{accX: 0, accY: element_appear_amount});
		});
	}
}

/*
**	Add class on body if browser is Safari
*/
function initCheckSafariBrowser(){
	"use strict";

	if (navigator.userAgent.indexOf('Safari') !== -1 && navigator.userAgent.indexOf('Chrome') === -1) {
		$j('body').addClass('safari_browser');
	}
}
/*
 **	Add class on body if browser is Firefox Mac
 */
function initCheckFirefoxMacBrowser(){
    "use strict";

    var browser = navigator.userAgent.toLowerCase();
    var os = navigator.appVersion.toLowerCase();

    if (browser.indexOf('firefox') > -1 && os.indexOf("mac") > -1) {
        $j('body').addClass('firefox_mac_browser');
    }
}


/* insert start */
/*
**    Initialize Edge search form
*/
function initSearchButton(){

    //search type - search_slides_from_header_bottom
    if($j('.search_slides_from_header_bottom').length){

        $j('.search_slides_from_header_bottom').click(function(e){

            e.preventDefault();

            if($j('html').hasClass('touch')){
                if ($j('.edgt_search_form_2').height() == "0") {
                    $j('.edgt_search_form_2 input[type="text"]').onfocus = function () {
                        window.scrollTo(0, 0);
                        document.body.scrollTop = 0;
                    };
                    $j('.edgt_search_form_2 input[type="text"]').onclick = function () {
                        window.scrollTo(0, 0);
                        document.body.scrollTop = 0;
                    };
                    $j('.edgt_search_form_2').css('height','50px');
                } else {
                    $j('.edgt_search_form_2').css('height','0');

                }

                $j(window).scroll(function() {
                    if ($j('.edgt_search_form_2').height() != "0" && $scroll > 50) {
                        $j('.edgt_search_form_2').css('height','0');
                    }
                });

            } else {
                    if($j('.edgt_search_form_2').hasClass('animated')) {
                        $j('.edgt_search_form_2').removeClass('animated');
                        $j('.edgt_search_form_2').css('bottom','0');
                    } else {
                        $j('.edgt_search_form input[type="text"]').focus();
                        $j('.edgt_search_form_2').addClass('animated');
                        var search_form_height = $j('.edgt_search_form_2').height();
                        $j('.edgt_search_form_2').css('bottom',-search_form_height);

                    }

					$j('.edgt_search_form_2').addClass('disabled');
					$j('.edgt_search_form_2 input[type="submit"]').attr('disabled','disabled');
					if(($j('.edgt_search_form_2 .edgt_search_field').val() !== '') && ($j('.edgt_search_form_2 .edgt_search_field').val() !== ' ')) {
							$j('.edgt_search_form_2 input[type="submit"]').removeAttr('disabled');
							$j('.edgt_search_form_2').removeClass('disabled');
						}
						else {
							$j('.edgt_search_form_2').addClass('disabled');
							$j('.edgt_search_form_2 input[type="submit"]').attr('disabled','disabled');
						}

					$j('.edgt_search_form_2 .edgt_search_field').keyup(function() {
						if(($j(this).val() !== '') && ($j(this).val() != ' ')) {
							$j('.edgt_search_form_2 input[type="submit"]').removeAttr('disabled');
							$j('.edgt_search_form_2').removeClass('disabled');
						}
						else {
							$j('.edgt_search_form_2 input[type="submit"]').attr('disabled','disabled');
							$j('.edgt_search_form_2').addClass('disabled');
						}
					});


					$j('.content, footer').click(function(e){
							e.preventDefault();
							$j('.edgt_search_form_2').removeClass('animated');
							$j('.edgt_search_form_2').css('bottom','0');
					});
                }
            });
        }

    //search type - search covers header
    if($j('.search_covers_header').length){

        $j('.search_covers_header').click(function(e){

            e.preventDefault();
			
			if($j(".fixed_top_header").length){
				var headerHeight = $j('.top_header').height();
			}else{
				var headerHeight = $j('.header_top_bottom_holder').height();
			}
			
			
			$j('.edgt_search_form_3 .form_holder_outer').height(headerHeight);
			$j('.edgt_search_form_3').stop(true).fadeIn(600,'easeOutExpo');
			$j('.edgt_search_form_3 input[type="text"]').focus();


			$j(window).scroll(function() {
				if($j(".fixed_top_header").length){
					var headerHeight = $j('.top_header').height();
				}else{
					var headerHeight = $j('.header_top_bottom_holder').height();
				}
				$j('.edgt_search_form_3 .form_holder_outer').height(headerHeight);
			});

			$j('.edgt_search_close, .content, footer').click(function(e){
					e.preventDefault();
					$j('.edgt_search_form_3').stop(true).fadeOut(450,'easeOutExpo');
			});

			$j('.edgt_search_form_3').blur(function(e){
					$j('.edgt_search_form_3').stop(true).fadeOut(450,'easeOutExpo');
			});


            });

    }
		
		//search type - fullscreen search
    if($j('.fullscreen_search').length){
		  $j('.fullscreen_search').on('click',function(e){
            e.preventDefault();
			//search type Fade Appear
				if($j('.fullscreen_search_holder').hasClass('animate')) {
					$j('body').removeClass('fullscreen_search_opened');
					$j('.fullscreen_search_holder').removeClass('animate');
					$j('body').removeClass('search_fade_out');
					$j('body').removeClass('search_fade_in');
					if(!$j('body').hasClass('page-template-full_screen-php')){
						enable_scroll();
					}
				} else {
					$j('body').addClass('fullscreen_search_opened');
					$j('body').removeClass('search_fade_out');
					$j('body').addClass('search_fade_in');
					$j('.fullscreen_search_holder').addClass('animate');
					if(!$j('body').hasClass('page-template-full_screen-php')){
						disable_scroll();
					}
				}
			//Text input focus change
			$j('.fullscreen_search_holder .search_field').focus(function(){
				$j('.fullscreen_search_holder .field_holder .line').css("width","100%");
			});
			$j('.fullscreen_search_holder .search_field').blur(function(){
				$j('.fullscreen_search_holder .field_holder .line').css("width","0");
			});
        });
		$j('.fullscreen_search_close').on('click',function(e){
			e.preventDefault();
			$j('body').removeClass('fullscreen_search_opened');
			$j('.fullscreen_search_holder').removeClass('animate');
			$j('body').removeClass('search_fade_in');
			$j('body').addClass('search_fade_out');
			if(!$j('body').hasClass('page-template-full_screen-php')){
				enable_scroll();
			}
		});

    }


}

/* insert end */


/*
**	Init update Shopping Cart
*/
function updateShoppingCart(){
	"use strict";

		$j('body').bind('added_to_cart', add_to_cart);
		function add_to_cart(event, parts, hash) {
			var miniCart = $j('.shopping_cart_header_holder');
			if ( parts['div.widget_shopping_cart_content'] ) {
				var $cartContent = jQuery(parts['div.widget_shopping_cart_content']),
				$itemsList = $cartContent .find('.cart_list'),
				$total = $cartContent.find('.total').contents(':not(strong)').text();
			miniCart.find('.shopping_cart_dropdown_inner').html('').append($itemsList);
			miniCart.find('.total span').html('').append($total);
			}
		}
}

/*
**	Set content bottom margin because of the uncovering footer
*/
function setContentBottomMargin(){
	"use strict";

	if($j('.uncover').length){
		$j('.content').css('margin-bottom', $j('.footer_inner').height());
	}
}

/*
 **	Init footer height for left border line
 */
function setFooterHeight(){
	"use strict";

	if($window_width > 600){
        if($j('.footer_top > div').hasClass('container')){
            $j(".footer_top .edgt_column").css('min-height', 0).css('min-height', $j('.footer_top > .container > .container_inner > div ').innerHeight());
        }
        else{
            $j(".footer_top .edgt_column").css('min-height', 0).css('min-height', $j('.footer_top > div').innerHeight());
        }
	}
}

/*
 **	Show Google Map
 */
function showGoogleMap(){
	"use strict";

	if($j('.edgt_google_map').length){
		$j('.edgt_google_map').each(function(){

			var custom_map_style;
			if(typeof $j(this).data('custom-map-style') !== 'undefined') {
				custom_map_style = $j(this).data('custom-map-style');
			}

			var color_overlay;
			if(typeof $j(this).data('color-overlay') !== 'undefined' && $j(this).data('color-overlay') !== false) {
				color_overlay = $j(this).data('color-overlay');
			}

			var saturation;
			if(typeof $j(this).data('saturation') !== 'undefined' && $j(this).data('saturation') !== false) {
				saturation = $j(this).data('saturation');
			}

			var lightness;
			if(typeof $j(this).data('lightness') !== 'undefined' && $j(this).data('lightness') !== false) {
				lightness = $j(this).data('lightness');
			}

			var zoom;
			if(typeof $j(this).data('zoom') !== 'undefined' && $j(this).data('zoom') !== false) {
				zoom = $j(this).data('zoom');
			}

			var pin;
			if(typeof $j(this).data('pin') !== 'undefined' && $j(this).data('pin') !== false) {
				pin = $j(this).data('pin');
			}

			var map_height;
			if(typeof $j(this).data('map-height') !== 'undefined' && $j(this).data('map-height') !== false) {
				map_height = $j(this).data('map-height');
			}

			var unique_id;
			if(typeof $j(this).data('unique-id') !== 'undefined' && $j(this).data('unique-id') !== false) {
				unique_id = $j(this).data('unique-id');
			}

			var google_maps_scroll_wheel;
			if(typeof $j(this).data('google-maps-scroll-wheel') !== 'undefined') {
				google_maps_scroll_wheel = $j(this).data('google-maps-scroll-wheel');
			}
			var addresses;
			if(typeof $j(this).data('addresses') !== 'undefined' && $j(this).data('addresses') !== false) {
				addresses = $j(this).data('addresses');
			}
            var show_address_box;
            if(typeof $j(this).data('show-address-info-box') !== 'undefined' && $j(this).data('show-address-info-box') !== false) {
                show_address_box = $j(this).data('show-address-info-box');
            }


			var map = "map_"+ unique_id;
			var geocoder = "geocoder_"+ unique_id;
			var holderId = "map_canvas_"+ unique_id;

			initializeGoogleMap(custom_map_style, color_overlay, saturation, lightness, google_maps_scroll_wheel, zoom, holderId, map_height, pin,  map, geocoder, addresses, show_address_box)
		});
	}

}
/*
 **	Init Google Map
 */
function initializeGoogleMap(custom_map_style, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data, show_address_box){
	"use strict";

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

	var google_map_type_id;

	if(custom_map_style){
		google_map_type_id = 'edgt_style'
	} else {
		google_map_type_id = google.maps.MapTypeId.ROADMAP
	}

	var edgtMapType = new google.maps.StyledMapType(mapStyles,
		{name: "Edge Google Map"});

	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(-34.397, 150.644);

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
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'edgt_style'],
			style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		mapTypeId: google_map_type_id
	};
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('edgt_style', edgtMapType);

		var index;

		for (index = 0; index < data.length; ++index) {
			initializeGoogleAddress(data[index], pin, map, geocoder, show_address_box);
		}

		var holder_element = document.getElementById(holderId);
		holder_element.style.height = height + "px";




}
/*
 **	Init Google Map Addresses
 */
function initializeGoogleAddress(data, pin,  map, geocoder, show_address_box){
	"use strict";
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

            if(show_address_box == 'yes'){
    			google.maps.event.addDomListener(window, 'load', function() {
    				infowindow.open(map,marker);
    			});
            }

			google.maps.event.addDomListener(window, 'resize', function() {
				map.setCenter(results[0].geometry.location);
			});
			//infowindow.open(map,marker);
		}
	});
}

/*
**	Boxes which reveal text on hover
*/
function initCoverBoxes(){
    if($j('.cover_boxes').length) {
        $j('.cover_boxes').each(function(){
            var active_element = 0;
            var data_active_element = 1;
            if(typeof $j(this).data('active-element') !== 'undefined' && $j(this).data('active-element') !== false) {
                data_active_element = parseFloat($j(this).data('active-element'));
                active_element = data_active_element - 1;
            }

            var number_of_columns = 3;

            //validate active element
            active_element = data_active_element > number_of_columns ? 0 : active_element;

            $j(this).find('li').eq(active_element).addClass('act');
            var cover_boxed = $j(this);
            $j(this).find('li').each(function(){
                $j(this).hover(function() {
                    $j(cover_boxed).find('li').removeClass('act');
                    $j(this).addClass('act');
                });

            });
        });
    }
}

/*
**	Create content menu from selected rows
*/
function createContentMenu(){
	"use strict";

	var content_menu = $j(".content_menu");
	content_menu.each(function(){

		if($j(this).css('background-color') !== ""){
			var background_color = $j(this).css('background-color');
		}

		var content_menu_ul = $j(this).find("ul.menu");

		var sections = $j(this).siblings('.in_content_menu');

		if(sections.length){
			sections.each(function(){
								
				var section_href = $j(this).data("edgt_id");
				var section_title = $j(this).data('edgt_title');
				var section_icon = $j(this).data('icon_html');

				var li = $j("<li />");
				var link = $j("<a />", {"href": section_href, "html": "<span>" + section_title + "</span>"});
				var arrow;
				if(background_color !== ""){
					arrow = $j("<div />", {"class": 'arrow', "style": 'border-color: '+background_color+' transparent transparent transparent'});
				} else {
					arrow = $j("<div />", {"class": 'arrow'});
				}

				link.prepend(section_icon);
				li.append(link);
				li.appendTo(content_menu_ul);

			});
		}
		
	});
}

/*
**	Create content menu (select menu for responsiveness)from selected rows
*/
function createSelectContentMenu(){
	"use strict";

	var content_menu = $j(".content_menu");
	content_menu.each(function(){

		var $this = $j(this);

		var $menu_select = $j("<ul></ul>");
		$menu_select.appendTo($j(this).find('.nav_select_menu'));


		$j(this).find("ul.menu li a").each(function(){

			var menu_url = $j(this).attr("href");
			var menu_text = $j(this).text();
			var menu_icon = $j(this).find('i').clone();

			if ($j(this).parents("li").length === 2) { menu_text = "&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).parents("li").length === 3) { menu_text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).parents("li").length > 3) { menu_text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + menu_text; }

			var li = $j("<li />");
			var link = $j("<a />", {"href": menu_url, "html": menu_text});
			menu_icon.prependTo(link);
			link.appendTo(li);
			li.appendTo($menu_select);
		});


		$this.find(".nav_select_button").on('click', function() {
			if ($this.find('.nav_select_menu ul').is(":visible")){
				$this.find('.nav_select_menu ul').slideUp();
			} else {
				$this.find('.nav_select_menu ul').slideDown();
			}
			return false;
		});

		$this.find(".nav_select_menu ul li a").on('click',function () {
			
			var $link = $j(this);

			var $target = $link.attr("href");
			var targetOffset = $j('[data-edgt_id="' + $target + '"]').offset().top - $j('.nav_select_menu ul').outerHeight();
			$this.find('.nav_select_menu ul').slideUp();
			$j('html,body').stop().animate({scrollTop: targetOffset }, 1500, function(){
				$j('nav.content_menu ul li').removeClass('active');
				$link.parent().addClass('active');
			});

			return false;
		});
	});
}

/*
**	Calculate content menu position and fix it when needed
*/
function contentMenuPosition(){
	"use strict";

	if($j('nav.content_menu').length){

		
		var header_add_sticky = content_menu_position > sticky_amount ? min_header_height_sticky : 0;
		var header_add_fixed_hidden = content_menu_position > scroll_amount_for_fixed_hiding ? min_header_height_fixed_hidden + 20 : header_height + min_header_height_fixed_hidden + 20; //20 is logo top and bottom margin
		var content_height = $j('nav.content_menu').height();

		if(content_menu_position - header_add_sticky - content_menu_top_add - $scroll <= 0 && ($j('header').hasClass('stick') || $j('header').hasClass('stick_with_left_right_menu'))){
			
			if(content_menu_position < sticky_amount){
				if($scroll > sticky_amount){
					$j('nav.content_menu').css({'position': 'fixed', 'top': min_header_height_sticky + content_menu_top_add}).addClass('fixed');

				}else{
					$j('nav.content_menu').css({'position': 'fixed', 'top': 0, transition:'none'}).addClass('fixed');
				}
			}else{
				$j('nav.content_menu').css({'position': 'fixed', 'top': min_header_height_sticky + content_menu_top_add}).addClass('fixed');
			}
			$j('header.sticky').addClass('no_shadow');
			$j('.content > .content_inner > .container > .container_inner').css('margin-top',content_height);
			$j('.content > .content_inner > .full_width').css('margin-top',content_height);

		}else if(content_menu_position - header_add_fixed_hidden - content_menu_top_add - $scroll <= 0 && $j('header').hasClass('fixed_hiding')){
			if(content_menu_position < scroll_amount_for_fixed_hiding){
				if($scroll > scroll_amount_for_fixed_hiding){
					$j('nav.content_menu').css({'position': 'fixed', 'top': min_header_height_fixed_hidden + 20 + content_menu_top_add}).addClass('fixed'); //20 is logo top and bottom margin

				}else{
					$j('nav.content_menu').css({'position': 'fixed', 'top': header_height + min_header_height_fixed_hidden + 20 + content_menu_top_add}).addClass('fixed'); //20 is logo top and bottom margin
				}
			}else{
				$j('nav.content_menu').css({'position': 'fixed', 'top': min_header_height_fixed_hidden + 20 + content_menu_top_add}).addClass('fixed'); //20 is logo top and bottom margin
			}
			$j('.content > .content_inner > .container > .container_inner').css('margin-top',content_height);
			$j('.content > .content_inner > .full_width').css('margin-top',content_height);
			
		}else if(content_menu_position - content_menu_top - content_menu_top_add - $scroll <= 0 && !$j('header').hasClass('stick') && !$j('header').hasClass('fixed_hidden')) {
			$j('nav.content_menu').css({'position': 'fixed', 'top': content_menu_top + content_menu_top_add}).addClass('fixed');
			$j('.content > .content_inner > .container > .container_inner').css('margin-top',content_height);
			$j('.content > .content_inner > .full_width').css('margin-top',content_height);
		} else {
			$j('nav.content_menu').css({'position': 'relative', 'top': '0px'}).removeClass('fixed');
			$j('header.sticky').removeClass('no_shadow');
			$j('.content > .content_inner > .container > .container_inner').css('margin-top','0px');
			$j('.content > .content_inner > .full_width').css('margin-top','0px');
		}
		
	}
}

/*
**	Calculate content menu position and fix it when needed
*/
function contentMenuOnScroll(){
	if($j('nav.content_menu').length){
		$j('.content .in_content_menu').waypoint( function(direction) {
            if(direction === 'down') {
				var id = $j(this).data("edgt_id");
				$j("nav.content_menu.fixed li a").each(function(){
					var i = $j(this).attr("href");
					if(i === id){
						$j(this).parent().addClass('active');
					}else{
						$j(this).parent().removeClass('active');
					}
				});
            }
        }, { offset: '80%' });

        $j('.content .in_content_menu').waypoint( function(direction) {
            if(direction === 'up') {
                var id = $j(this).data("edgt_id");
                $j("nav.content_menu.fixed li a").each(function(){
					var i = $j(this).attr("href");
					if(i === id){
						$j(this).parent().addClass('active');
					}else{
						$j(this).parent().removeClass('active');
					}
				});
            }
        }, { offset: function(){
            return -($j(this).outerHeight() - 250);
        } });
	}
}

/*
**	Check first and last content menu included rows for active state in content menu
*/
var scrollPos = 0;
function contentMenuCheckLastSection(){
	"use strict";

	if($j('.content .in_content_menu').length){
		
		var curScrollPos = $scroll;
		var last_from_top = $j('.content .in_content_menu:last').offset().top + $j('.content .in_content_menu:last').height();
		var first_from_top = $j('.content .in_content_menu:first').offset().top - $window_height/2; //divided with 2, when half of section is out of viewport
		
		if (curScrollPos > scrollPos) {
			if(last_from_top < $scroll){
				$j("nav.content_menu.fixed li").removeClass('active');
			}
		} else {
			if(first_from_top > $scroll){
				$j('nav.content_menu li:first, nav.content_menu ul.menu li:first').removeClass('active');
			}
		}
		scrollPos = curScrollPos;
		
	}
}


/*
**	Scroll to section when item in content menu is clicked
*/
function contentMenuScrollTo(){
	"use strict";
	
	var $doc = $j('html, body');
    var scrollToAmount;
    $j("nav.content_menu ul.menu li a").on('click', function(e){
		e.preventDefault();
        var $this = $j(this);
        var $target = $this.attr("href");
        
		if($j(this).parent().hasClass('active')){
			return false;
		}
		
		if($j('header.page_header').hasClass('fixed') && !$j('body').hasClass('vertical_menu_enabled')){
			
			if(!$j('header.page_header').hasClass('transparent')){
				if(header_height - ($j('[data-edgt_id="' + $target + '"]').offset().top + content_menu_top_add)/4 >= min_header_height_scroll){
					var diff_of_header_and_section = $j('[data-edgt_id="' + $target + '"]').offset().top -  header_height - large_menu_item_border;
					scrollToAmount = diff_of_header_and_section + (diff_of_header_and_section/4) + (diff_of_header_and_section/16) + (diff_of_header_and_section/64) + 1; //several times od dividing to minimize the error, because fixed header is shrinking while scroll, 1 is just to ensure
				}else{
					scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top -  min_header_height_scroll - large_menu_item_border;
				}
			}else{
				scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top;
			}
		} else if($j('header.page_header').hasClass('fixed_top_header') && !$j('body').hasClass('vertical_menu_enabled')){
			if(!$j('header.page_header').hasClass('transparent')){
				scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top -  header_height - large_menu_item_border;
			}else{
				scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top;
			}
		} else if($j('header.page_header').hasClass('fixed_hiding') && !$j('body').hasClass('vertical_menu_enabled')){
			if(!$j('header.page_header').hasClass('transparent')) {
				if ($j('[data-edgt_id="' + $target + '"]').offset().top - (header_height + content_menu_top_add + logo_height / 2 + 20) <= scroll_amount_for_fixed_hiding) {
					scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top - content_menu_top_add - header_height - logo_height / 2 - 20; //20 is top/bottom margin of logo
				} else {
					scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top - content_menu_top_add - min_header_height_fixed_hidden - 20; //20 is top/bottom margin of logo
				}
			}else{
				scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top;
			}
		}else if($j('header.page_header').hasClass('stick') || $j('header.page_header').hasClass('stick_with_left_right_menu') && !$j('body').hasClass('vertical_menu_enabled')) {
			if(!$j('header.page_header').hasClass('transparent')) {
				if (sticky_amount >= $j('[data-edgt_id="' + $target + '"]').offset().top) {
					scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top + 1; // 1 is to show sticky menu
				} else {
					scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top - min_header_height_sticky;
				}
			}else{
				scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top;
			}
		} else{
			scrollToAmount = $j('[data-edgt_id="' + $target + '"]').offset().top;
		}
		
		if($j('[data-edgt_id="'+$target+'"]').length > 0){
			$doc.stop().animate({
				scrollTop: Math.round(scrollToAmount - $j('nav.content_menu').height())
			}, 1500, function() {
				$j('nav.content_menu ul li').removeClass('active');
				$this.parent().addClass('active');
			});

		}
		
		return false;

    });
}

function initButtonHover() {
	"use strict";

    if($j('.qbutton').length) {
        $j('.qbutton').each(function() {

            //hover background color
            if(typeof $j(this).data('hover-background-color') !== 'undefined' && $j(this).data('hover-background-color') !== false) {
                var hover_background_color = $j(this).data('hover-background-color');
                var initial_background_color = $j(this).css('background-color');
                $j(this).hover(
                function() {
                    $j(this).css('background-color', hover_background_color);
                },
                function() {
                    $j(this).css('background-color', initial_background_color);
                });
            }

            //hover border color
            if(typeof $j(this).data('hover-border-color') !== 'undefined' && $j(this).data('hover-border-color') !== false) {
                var hover_border_color = $j(this).data('hover-border-color');
                var initial_border_color = $j(this).css('border-top-color');
                $j(this).hover(
                    function() {
                        $j(this).css('border-color', hover_border_color);
                    },
                    function() {
                        $j(this).css('border-color', initial_border_color);
                    });
            }

            //hover color
            if(typeof $j(this).data('hover-color') !== 'undefined' && $j(this).data('hover-color') !== false) {
                var hover_color = $j(this).data('hover-color');
                var initial_color = $j(this).css('color');
                $j(this).hover(
                    function() {
                        $j(this).css('color', hover_color);
                    },
                    function() {
                        $j(this).css('color', initial_color);
                    });
            }

            //icon background hover color
            if(typeof $j(this).data('icon-background-hover-color') !== 'undefined' && $j(this).data('icon-background-hover-color') !== false) {
                var icon_background_hover_color = $j(this).data('icon-background-hover-color');
                var initial_icon_background_color = $j(this).find("i").css('background-color');
                $j(this).hover(
                    function() {
                        $j(this).find("i").css('background-color', icon_background_hover_color);
                    },
                    function() {
                        $j(this).find("i").css('background-color', initial_icon_background_color);
                    });
            }
        });
    }
}

function initSocialIconHover() {
	"use strict";

    if($j('.edgt_social_icon_holder').length) {
        $j('.edgt_social_icon_holder').each(function() {

        	var hover_style   = '';
			var initial_style = '';

			//hover background color
			if(typeof $j(this).data('hover-background-color') !== 'undefined' && $j(this).data('hover-background-color') !== false && $j(this).find('.simple_social').length === 0) {
				var hover_background_color = $j(this).data('hover-background-color');
				hover_style += 'background-color: '+ hover_background_color + '!important;';
			}

			if($j(this).find('.simple_social').length === 0){
				var initial_background_color = $j(this).find('.edgt_icon_stack').css('background-color');
				initial_style += 'background-color: '+ initial_background_color + '!important;';
			}

			//hover border color
			if(typeof $j(this).data('hover-border-color') !== 'undefined' && $j(this).data('hover-border-color') !== false && $j(this).find('.simple_social').length === 0) {
				var hover_border_color = $j(this).data('hover-border-color');
				hover_style += 'border-color: '+ hover_border_color + '!important;';
			}

			if($j(this).find('.simple_social').length === 0){
				var initial_border_color = $j(this).find('.edgt_icon_stack').css('border-color');
				initial_style += 'border-color: '+ initial_border_color + '!important;';
			}

			//hover color
			if(typeof $j(this).data('hover-color') !== 'undefined' && $j(this).data('hover-color') !== false) {
				var hover_color = $j(this).data('hover-color');
				hover_style += 'color: '+ hover_color + '!important;';
			}

			var initial_color = $j(this).css('color');

			if($j(this).find('.edgt_icon_stack .social_icon').length) {
				initial_color = $j(this).find('.edgt_icon_stack').css('color');
			} else if($j(this).find('.simple_social').length) {
				initial_color = $j(this).find('.simple_social').css('color');
			}

			initial_style += 'color: '+ initial_color + '!important;';

			if(hover_style !== ""){
				if($j(this).find('.edgt_icon_stack .social_icon').length) {
					$j(this).find('.edgt_icon_stack').hover(
						function() {
							$j(this).attr('style', function() { return hover_style; });
						},
						function() {
							$j(this).attr('style', function() { return initial_style; });
						});
				} else if($j(this).find('.simple_social').length) {
					$j(this).find('.simple_social').hover(
						function() {
							$j(this).attr('style', function() { return hover_style; });
						},
						function() {
							$j(this).attr('style', function() { return initial_style; });
						});
				}
			}
        });
    }
}

function initIconHover() {
    "use strict";

    if($j('.edgt_icon_shortcode').length) {
        $j('.edgt_icon_shortcode').each(function() {

            if((typeof $j(this).data('hover-background-color') !== 'undefined')
                || (typeof $j(this).data('hover-border-color') !== 'undefined')
                || (typeof $j(this).find('i, span').data('hover-color') !== 'undefined')){

                // define element style for icon and for shape
                var hover_style   = '';
                var icon_hover_style   = '';
                var initial_style = '';
                var icon_initial_style = '';

                // shape css start

                //hover background color
                if(typeof $j(this).data('hover-background-color') !== 'undefined' && $j(this).data('hover-background-color') !== false && $j(this).find('.normal').length === 0) {
                    var hover_background_color = $j(this).data('hover-background-color');
                    hover_style += 'background-color: '+ hover_background_color + '!important;';
                }

                if($j(this).find('.normal').length === 0){
                    var initial_background_color = $j(this).css('background-color');
                    initial_style += 'background-color: '+ initial_background_color + '!important;';
                }

                //hover border color
                if(typeof $j(this).data('hover-border-color') !== 'undefined' && $j(this).data('hover-border-color') !== false && $j(this).find('.normal').length === 0) {
                    var hover_border_color = $j(this).data('hover-border-color');
                    hover_style += 'border-color: '+ hover_border_color + '!important;';
                }

                if($j(this).find('.normal').length === 0){
                    var initial_border_color = $j(this).css('border-left-color');
                    initial_style += 'border-color: '+ initial_border_color + '!important;';
                }

                //rest of the possible options for shape
                var initial_width = $j(this).css('width');
                if(initial_width !== ''){
                    hover_style += 'width: '+ initial_width + ';';
                    initial_style += 'width: '+ initial_width + ';';
                }
                var initial_height = $j(this).css('height');
                if(initial_height !== ''){
                    hover_style += 'height: '+ initial_height + ';';
                    initial_style += 'height: '+ initial_height + ';';
                }
                var initial_line_height = $j(this).css('line-height');
                if(initial_line_height !== ''){
                    hover_style += 'line-height: '+ initial_line_height + ';';
                    initial_style += 'line-height: '+ initial_line_height + ';';
                }
                var initial_border_style = $j(this).css('border-left-style');
                if(initial_border_style !== ''){
                    hover_style += 'border-style: '+ initial_border_style + ';';
                    initial_style += 'border-style: '+ initial_border_style + ';';
                }
                var initial_border_width = $j(this).css('border-left-width');
                if(initial_border_width !== ''){
                    hover_style += 'border-width: '+ initial_border_width + '!important;';
                    initial_style += 'border-width: '+ initial_border_width + '!important;';
                }
                var initial_border_radius = $j(this).css('border-top-left-radius');
                if(initial_border_radius !== ''){
                    hover_style += 'border-radius: '+ initial_border_radius +'; -moz-border-radius: '+ initial_border_radius +'; -webkit-border-radius: '+ initial_border_radius+ ';';
                    initial_style += 'border-radius: '+ initial_border_radius +'; -moz-border-radius: '+ initial_border_radius +'; -webkit-border-radius: '+ initial_border_radius+ ';';
                }
                var initial_margin_right = $j(this).css('margin-right');
                if(initial_margin_right !== ''){
                    hover_style += 'margin-right: '+ initial_margin_right + ';';
                    initial_style += 'margin-right: '+ initial_margin_right + ';';
                }
                var initial_margin_left = $j(this).css('margin-left');
                if(initial_margin_left !== ''){
                    hover_style += 'margin-left: '+ initial_margin_left + ';';
                    initial_style += 'margin-left: '+ initial_margin_left + ';';
                }
                var initial_margin_top = $j(this).css('margin-top');
                if(initial_margin_top !== ''){
                    hover_style += 'margin-top: '+ initial_margin_top + ';';
                    initial_style += 'margin-top: '+ initial_margin_top + ';';
                }
                var initial_margin_bottom = $j(this).css('margin-bottom');
                if(initial_margin_bottom !== ''){
                    hover_style += 'margin-bottom: '+ initial_margin_bottom + ';';
                    initial_style += 'margin-bottom: '+ initial_margin_bottom + ';';
                }

                if($j(this).hasClass("icon_shadow")) {
                    var shadow_color_style='';

                    if (typeof $j(this).data('shadow-color') !== 'undefined' && $j(this).data('shadow-color') !== false) {
                        var shadow_color = $j(this).data('shadow-color');
                        shadow_color_style = 'text-shadow:1px 1px '+shadow_color;
                        for(var i=2;i<100;i++){
                            shadow_color_style += ','+i+'px '+i+'px '+shadow_color+''
                        }
                        shadow_color_style += ';';

                        initial_style += shadow_color_style;
                    }

                    if (typeof $j(this).data('hover-shadow-color') !== 'undefined' && $j(this).data('hover-shadow-color') !== false) {
                        var hover_shadow_color = $j(this).data('hover-shadow-color');

                        shadow_color_style = 'text-shadow:1px 1px '+hover_shadow_color;
                        for(var i=2;i<100;i++){
                            shadow_color_style += ','+i+'px '+i+'px '+hover_shadow_color+''
                        }
                        shadow_color_style += ';';

                        hover_style += shadow_color_style;
                    }
                }

                // shape css end

                // icon css start

                //hover color
                if(typeof $j(this).find('i, span').data('hover-color') !== 'undefined' && $j(this).find('i, span').data('hover-color') !== false) {
                    var hover_color = $j(this).find('i, span').data('hover-color');
                    icon_hover_style += 'color: '+ hover_color + '!important;';
                }

                var initial_color = $j(this).find('i, span').css('color');
                    icon_initial_style += 'color: '+ initial_color + ';';


                var initial_icon_line_height = $j(this).find('i, span').css('line-height');
                if(initial_icon_line_height !== ''){
                    icon_hover_style += 'line-height: '+ initial_icon_line_height + ';';
                    icon_initial_style += 'line-height: '+ initial_icon_line_height + ';';
                }

                if($j(this).find('.normal').length == 0 && $j(this).find('span').length == 0) {
                    var initial_icon_vertical_align = $j(this).find('i').css('vertical-align');

                    if (initial_icon_vertical_align != 'undefined') {
                        icon_hover_style += 'vertical-align: ' + initial_icon_vertical_align + ';';
                        icon_initial_style += 'vertical-align: ' + initial_icon_vertical_align + ';';
                    }
                }

                // icon css end

                // for both icon and shape start

                var initial_icon_font_size = $j(this).find('i, span').css('font-size');
                if(initial_icon_font_size !== ''){
                    icon_hover_style += 'font-size: '+ initial_icon_font_size + ';';
                    icon_initial_style += 'font-size: '+ initial_icon_font_size + ';';
                }

                var icon_animation_delay = $j(this).css('transition-delay');
                if(icon_animation_delay !== '0s, 0s, 0s'){
                    hover_style += 'transition-delay: '+ icon_animation_delay +'; -webkit-transition-delay: '+ icon_animation_delay +'; -moz-transition-delay: '+ icon_animation_delay+ '; -o-transition-delay: '+icon_animation_delay+';';
                    initial_style += 'transition-delay: '+ icon_animation_delay +'; -webkit-transition-delay: '+ icon_animation_delay +'; -moz-transition-delay: '+ icon_animation_delay+ '; -o-transition-delay: '+icon_animation_delay+';';
                    icon_hover_style += 'transition-delay: '+ icon_animation_delay +'; -webkit-transition-delay: '+ icon_animation_delay +'; -moz-transition-delay: '+ icon_animation_delay+ '; -o-transition-delay: '+icon_animation_delay+';';
                    icon_initial_style += 'transition-delay: '+ icon_animation_delay +'; -webkit-transition-delay: '+ icon_animation_delay +'; -moz-transition-delay: '+ icon_animation_delay+ '; -o-transition-delay: '+icon_animation_delay+';';
                }

                // for both icon and shape start

                if(typeof hover_background_color !== 'undefined' || typeof hover_border_color !== 'undefined' || typeof hover_color !== 'undefined'){
                    $j(this).hover(
                        function() {
                            if($j(this).hasClass('square') || $j(this).hasClass('circle')){

                                $j(this).attr('style', function() { return hover_style; });

                            }
                            if(typeof hover_color !== 'undefined'){
                                $j(this).find('i, span').attr('style', function() { return icon_hover_style; });
                            }

                        },
                        function() {
                            if($j(this).hasClass('square') || $j(this).hasClass('circle')){

                                $j(this).attr('style', function() { return initial_style; });
                            }
                                $j(this).find('i, span').attr('style', function() { return icon_initial_style; });
                    });
                }
            }
        });
    }
}

/*
 **	Set Interactive Banners
 */

function initInteractiveBannersShader() {
    "use strict";

    if($j('.edgt_image_with_text_over').length) {
        $j('.edgt_image_with_text_over').each(function() {

            //hover background color
            if(typeof $j(this).children('.shader').data('hover-background-color') !== 'undefined' && $j(this).data('hover-background-color') !== false) {
                var hover_background_color = $j(this).children('.shader').data('hover-background-color');
                var initial_background_color = $j(this).children('.shader').css('background-color');
                $j(this).hover(
                    function() {
                        $j(this).children('.shader').css('background-color', hover_background_color);
                    },
                    function() {
                        $j(this).children('.shader').css('background-color', initial_background_color);
                    });
            }
        });
    }
}


function initPricingTableContentBackground() {
    "use strict";

    if($j('.edgt_pricing_tables .title_on_top').length) {
        $j('.edgt_pricing_tables .title_on_top').each(function() {

            //even and odd background color
            var even_background_color;
            var odd_background_color;
            var even_border_color;
            var odd_border_color;
            
            if(typeof $j(this).find('.pricing_table_content').data('even-background-color') !== 'undefined' && $j(this).data('even-background-color') !== false) {
                even_background_color = $j(this).find('.pricing_table_content').data('even-background-color');                
            }
            if(typeof $j(this).find('.pricing_table_content').data('odd-background-color') !== 'undefined' && $j(this).data('odd-background-color') !== false) {
                odd_background_color = $j(this).find('.pricing_table_content').data('odd-background-color');                
            }
            if(typeof $j(this).find('.pricing_table_content').data('even-border-color') !== 'undefined' && $j(this).data('even-border-color') !== false) {
                even_border_color = $j(this).find('.pricing_table_content').data('even-border-color');                
            }
            if(typeof $j(this).find('.pricing_table_content').data('odd-border-color') !== 'undefined' && $j(this).data('odd-border-color') !== false) {
                odd_border_color = $j(this).find('.pricing_table_content').data('odd-border-color');                
            }
            
            $j(this).find('.pricing_table_content ul li:nth-child(even)').css('background-color', even_background_color);
            $j(this).find('.pricing_table_content ul li:nth-child(even)').css('border-color', even_border_color);
            $j(this).find('.pricing_table_content ul li:nth-child(odd)').css('background-color', odd_background_color);           
            $j(this).find('.pricing_table_content ul li:nth-child(odd)').css('border-color', odd_border_color);
        });
    }
}

function initProcessHeightWidth() {
    "use strict";

    if($j('.edgt_circles_shortcode').length) {
        $j('.edgt_circles_shortcode').each(function() {

            //process height and width
            var proces_height;
            var proces_width;
            var top_position;
            
            if(typeof $j(this).find('.edgt_circles_holder').data('proces-height') !== 'undefined' && $j(this).find('.edgt_circles_holder').data('proces-height') !== false) {                         
                proces_height = $j(this).find('.edgt_circles_holder').data('proces-height'); 
                top_position = proces_height/2;
                proces_height += 'px'; 
                top_position += 'px'; 
                $j(this).find('.edgt_circles_holder.with_lines .circle_line_holder').css('top', top_position);
                $j(this).find('.edgt_circles_holder .edgt_circle_inner').css('height', proces_height);
            }
            
            if(typeof $j(this).find('.edgt_circles_holder').data('proces-width') !== 'undefined' && $j(this).find('.edgt_circles_holder').data('proces-width') !== false) {                         
                proces_width = $j(this).find('.edgt_circles_holder').data('proces-width');  
                proces_width += 'px';
                $j(this).find('.edgt_circles_holder .edgt_circle_inner').css('width', proces_width);
            }
        });
    }
}

/*
 **	Popup menu initialization
 */

// disabling scroll function
// left: 37, up: 38, right: 39, down: 40,
// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
var keys = [37, 38, 39, 40];

function preventDefaultValue(e) {
    e = e || window.event;
    if (e.preventDefault)
        e.preventDefault();
    e.returnValue = false;
}

function keydown(e) {
    for (var i = keys.length; i--;) {
        if (e.keyCode === keys[i]) {
            preventDefaultValue(e);
            return;
        }
    }
}

function wheel(e) {
    preventDefaultValue(e);
}

function disable_scroll() {
    if (window.addEventListener) {
        window.addEventListener('DOMMouseScroll', wheel, false);
    }
    window.onmousewheel = document.onmousewheel = wheel;
    document.onkeydown = keydown;

    if($j('body').hasClass('smooth_scroll')){
        window.removeEventListener('mousewheel', smoothScrollListener, false);
        window.removeEventListener('DOMMouseScroll', smoothScrollListener, false);
    }
}

function enable_scroll() {
    if (window.removeEventListener) {
        window.removeEventListener('DOMMouseScroll', wheel, false);
    }
    window.onmousewheel = document.onmousewheel = document.onkeydown = null;

    if($j('body').hasClass('smooth_scroll')){
        window.addEventListener('mousewheel', smoothScrollListener, false);
        window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
    }
}

function initPopupMenu(){
    "use strict";

    if($j('a.popup_menu').length){
        //var body_top;

        //set height of popup holder and initialize nicescroll
        $j(".popup_menu_holder_outer").height($window_height).niceScroll({
            scrollspeed: 30,
            mousescrollstep: 20,
            cursorwidth: 0,
            cursorborder: 0,
            cursorborderradius: 0,
            cursorcolor: "transparent",
            autohidemode: false,
            horizrailenabled: false
        }); //200 is top and bottom padding of holder

        //set height of popup holder on resize
        $j(window).resize(function() {$j(".popup_menu_holder_outer").height($window_height)});

        //set delays on nav items and widget area
        if($j('body').hasClass('fade_push_text_right') || $j('body').hasClass('fade_push_text_top')) {
            if ($j('.fullscreen_above_menu_widget_holder > div').length) {
                $j('.popup_menu_holder_outer nav > ul > li > a').each(function (i) {
                    $j(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                $j('.fullscreen_menu_widget_holder > div').css({
                    '-webkit-animation-delay': ($j('.popup_menu_holder_outer nav > ul > li > a').length+1)*70 + 'ms',
                    'animation-delay': ($j('.popup_menu_holder_outer nav > ul > li > a').length+1)*70 + 'ms'
                });
                $j('.fullscreen_above_menu_widget_holder > div').css({
                    '-webkit-animation-delay': 0 + 'ms',
                    'animation-delay': 0 + 'ms'
                });
            }
            else {
                $j('.popup_menu_holder_outer nav > ul > li > a').each(function (i) {
                    $j(this).css({
                        '-webkit-animation-delay': i * 70 + 'ms',
                        'animation-delay': i * 70 + 'ms'
                    });
                });
                $j('.fullscreen_menu_widget_holder > div').css({
                    '-webkit-animation-delay': ($j('.popup_menu_holder_outer nav > ul > li > a').length+1)*70 + 'ms',
                    'animation-delay': ($j('.popup_menu_holder_outer nav > ul > li > a').length+1)*70 + 'ms'
                });
            }
        }

        // Open popup menu
        $j('a.popup_menu').on('click',function(e){
            e.preventDefault();

            if(!$j(this).hasClass('opened')){
                $j(this).addClass('opened');
                $j('body').addClass('popup_menu_opened');

                if($j(this).hasClass('fade_push_text_right')) {
                    $j('body').addClass('fade_in').removeClass('fade_out');
                    $j('body').removeClass('push_nav_right');
                }
                else if($j(this).hasClass('fade_push_text_top')) {
                    $j('body').addClass('fade_in').removeClass('fade_out');
                    $j('body').removeClass('push_text_top');
                }
                else if($j(this).hasClass('fade_text_scaledown')) {
                    $j('body').addClass('fade_in').removeClass('fade_out');
                }

                if(!$j('body').hasClass('page-template-full_screen-php')){
                    disable_scroll();
                }
            }else{
                $j(this).removeClass('opened');
                $j('body').removeClass('popup_menu_opened');

                if($j(this).hasClass('fade_push_text_right') || $j(this).hasClass('fade_push_text_top') || $j(this).hasClass('fade_text_scaledown')) {
                    $j('body').removeClass('fade_in').addClass('fade_out');
                }

                if($j(this).hasClass('fade_push_text_right')) {
                    $j('body').addClass('push_nav_right');
                }
                else if($j(this).hasClass('fade_push_text_top')) {
                    $j('body').addClass('push_text_top');
                }

                if(!$j('body').hasClass('page-template-full_screen-php')){
                    enable_scroll();
                }
                $j("nav.popup_menu ul.sub_menu").slideUp(200, function(){
                    $j('nav.popup_menu').getNiceScroll().resize();
                });

            }
        });

        //logic for open sub menus in popup menu
        $j(".popup_menu > ul > li.has_sub > a, .popup_menu > ul > li.has_sub > h6").on('tap click', function (e) {
            e.preventDefault();

            if ($j(this).closest('li.has_sub').find("> ul.sub_menu").is(":visible")){
                $j(this).closest('li.has_sub').find("> ul.sub_menu").slideUp(200, function(){
                    $j('.popup_menu_holder_outer').getNiceScroll().resize();
                });
                $j(this).closest('li.has_sub').removeClass('open_sub');
            } else {
                $j(this).closest('li.has_sub').addClass('open_sub');
                $j(this).closest('li.has_sub').find("> ul.sub_menu").slideDown(200, function(){
                    $j('.popup_menu_holder_outer').getNiceScroll().resize();
                });
            }

            return false;
        });

        //if link has no submenu and if it's not dead, than open that link
        $j(".popup_menu ul li:not(.has_sub) a").click(function () {
            if(($j(this).attr('href') !== "http://#") && ($j(this).attr('href') !== "#")){
                $j('a.popup_menu').removeClass('opened  ');
                $j('body').removeClass('popup_menu_opened');

                if($j('a.popup_menu').hasClass('fade_push_text_right') || $j('a.popup_menu').hasClass('fade_push_text_top') || $j('a.popup_menu').hasClass('fade_text_scaledown')) {
                    $j('body').removeClass('fade_in').addClass('fade_out');
                }

                if($j('a.popup_menu').hasClass('fade_push_text_right')) {
                    $j('body').addClass('push_nav_right');
                }
                else if($j('a.popup_menu').hasClass('fade_push_text_top')) {
                    $j('body').addClass('push_text_top');
                }

                $j("nav.popup_menu ul.sub_menu").slideUp(200, function(){
                    $j('nav.popup_menu').getNiceScroll().resize();
                });
                enable_scroll();
            }else{
                return false;
            }
        });
    }
}

/*
 **	Image Gallery Slider with no space initialization
 */
function initImageGallerySliderNoSpace(){
	"use strict";

    if($j('.edgt_image_gallery_no_space').length){
        $j('.edgt_image_gallery_no_space').each(function(){
            if($j(this).hasClass('full_screen_height')){

                $j(this).find('ul li img').each(function(){
                    var proportion = $window_height / $j(this).height();
                    var image_width = Math.ceil($j(this).width() * proportion) -1; //-1 is because of the rounding on higher number
                    $j(this).closest('div').width(image_width);
                });
                $j(this).find('.edgt_image_gallery_holder').height($window_height);
                $j(this).find('.edgt_image_gallery_holder ul li div').height($window_height);

            }
            $j(this).animate({'opacity': 1},1000);
            $j(this).find('.edgt_image_gallery_holder').lemmonSlider({infinite: true});
        });

		//disable click on non active image
		$j('.edgt_image_gallery_no_space').on('click', 'li:not(.active) a', function() {
			return false;
		});
    }
}

function initFullScreenTemplate(){
    "use strict";

    if($j('.full_screen_section_slide').length){
        $j('.full_screen_section_slide').closest('.full_screen_section').addClass('full_screen_section_slides');
    }

    if($j('.full_screen_holder').length && $window_width > 600){

        // used for header style on changing sections, in checkFullScreenSectionsForHeaderStyle functions - START //
        var default_header_style = '';
        if ($j('header.page_header').hasClass('light')) {
            default_header_style = 'light';
        } else if ($j('header.page_header').hasClass('dark')) {
            default_header_style = 'dark';
        } else {
            default_header_style = header_style_admin;
        }
        // used for header style on changing sections, in checkFullScreenSectionsForHeaderStyle functions - START //

        $j('.full_screen_preloader').css('height', ($window_height));

        $j('#up_fs_button').on('click', function() {
            $j.fn.fullpage.moveSectionUp();
            return false;
        });

        $j('#down_fs_button').on('click', function() {
            $j.fn.fullpage.moveSectionDown();
            return false;
        });

        var section_number = $j('.full_screen_inner > .full_screen_section').length;
        $j('.full_screen_inner').fullpage({
            sectionSelector: '.full_screen_section',
            slideSelector: '.full_screen_section_slide',
            scrollOverflow: true,
            afterLoad: function(anchorLink, index){
                checkActiveArrowsOnFullScrrenTemplate(section_number, index);
                checkFullScreenSectionsForHeaderStyle(index, default_header_style);
            },
            afterRender: function(){
                checkActiveArrowsOnFullScrrenTemplate(section_number, 1);
                checkFullScreenSectionsForHeaderStyle(1, default_header_style);
                $j('.full_screen_holder').find('.full_screen_navigation_holder').css('visibility','visible');
                $j('.full_screen_holder').find('.full_screen_inner').css('visibility','visible');
                $j('.full_screen_preloader').hide();
                if($j('.full_screen_holder video.full_screen_sections_video').length){
                    $j('.full_screen_holder video.full_screen_sections_video').each(function(){
                        $j(this).get(0).play();
                    });
                }
            }
        });
    }
}

function checkActiveArrowsOnFullScrrenTemplate(section_number, index){
    "use strict";

    if(index === 1){
        $j('.full_screen_navigation_holder #up_fs_button').hide();
        if(index != section_number){
            $j('.full_screen_navigation_holder #down_fs_button').show();
        }
    }else if(index === section_number){
        if(section_number === 2){
            $j('.full_screen_navigation_holder #up_fs_button').show();
        }
        $j('.full_screen_navigation_holder #down_fs_button').hide();
    }else{
        $j('.full_screen_navigation_holder #up_fs_button').show();
        $j('.full_screen_navigation_holder #down_fs_button').show();
    }
}

function checkFullScreenSectionsForHeaderStyle(index, default_header_style){
    if($j('[data-edgt_header_style]').length > 0 && $j('header').hasClass('header_style_on_scroll')) {

        if ($j($j('.full_screen_holder .full_screen_inner .full_screen_section')[index-1]).data("edgt_header_style") !== undefined) {
            var header_style = $j($j('.full_screen_holder .full_screen_inner .full_screen_section')[index-1]).data("edgt_header_style");
            $j('header').removeClass('dark light').addClass(header_style);
        } else {
            $j('header').removeClass('dark light').addClass(default_header_style);
        }
    }
}

/*
 **	Portfolio blur effect
 */

function initPortfolioBlurEffect(){
    "use strict";

    var  $projectItemHolder = $j('.prominent_blur_hover');

    $projectItemHolder .on('mouseenter', function( event ) {
        $projectItemHolder.addClass('active');
        $projectItemHolder.not($j(this)).removeClass('active').addClass('blur');
    });

    $projectItemHolder .on('mouseleave', function( event ) {
        $projectItemHolder.removeClass('blur');
        $projectItemHolder.removeClass('active');

    });
}

/* in developement
function portfolio_blur_effect(){
    "use strict";

    var  $projectItemHolder = $j('.prominent_blur_hover');

    $j(document).on('mouseenter',$projectItemHolder, function( event ) {
        $projectItemHolder.addClass('active');
        $projectItemHolder.not($j(this)).removeClass('active').addClass('blur');
    });

    $j(document).on('mouseleave',$projectItemHolder, function( event ) {
        $projectItemHolder.removeClass('blur');
        $projectItemHolder.removeClass('active');

    });
}
*/

/*
**	Social Icons Widget
*/

function initSocialIconsSidebarEffect(){
    "use strict";

    var  $social_icons_widget = $j('#social_icons_widget');
    $social_icons_widget.addClass('loaded');
}

/*
 **	Vertical Split Slider
 */

function initVerticalSplitSlider(){
    "use strict";
	
	if($j('html').hasClass('vertical_split_screen_initalized')){
		$j('html').removeClass('vertical_split_screen_initalized');
		$j.fn.multiscroll.destroy();
	}
	
    if($j('.vertical_split_slider').length) {
		
        var default_header_style = '';
        if ($j('header.page_header').hasClass('light')) {
            default_header_style = 'light';
        } else if ($j('header.page_header').hasClass('dark')) {
            default_header_style = 'dark';
        } else {
            default_header_style = header_style_admin;
        }
		
        $j('.vertical_split_slider_preloader').fadeOut(500);
        $j('.vertical_split_slider').height($window_height).animate({opacity:1},300);
        $j('.vertical_split_slider').multiscroll({
            scrollingSpeed: 500,
            navigation: true,
            useAnchorsOnLoad: false,
            afterRender: function(){
				if($j('.ms-right .ms-section:last-child').data('header_style') != ""){
					$j('header.page_header').removeClass('dark light').addClass($j('.ms-right .ms-section:last-child').data('header_style'));
					$j('#multiscroll-nav').removeClass('dark light').addClass($j('.ms-right .ms-section:last-child').data('header_style'));
				}else{
					$j('header.page_header').removeClass('dark light').addClass(default_header_style);
					$j('#multiscroll-nav').removeClass('dark light').addClass(default_header_style);
				}

				$j('html').addClass('vertical_split_screen_initalized');
                initButtonHover(); // this function need to be initialized after initVerticalSplitSlider (initButtonHover is in ready, initVerticalSplitSlider in load)
                initSocialIconHover(); // this function need to be initialized after initVerticalSplitSlider (initSocialIconHover is in ready, initVerticalSplitSlider in load)
                initIconHover(); // this function need to be initialized after initVerticalSplitSlider (initIconHover is in ready, initVerticalSplitSlider in load)
				if($j('div.wpcf7 > form').length){$j('div.wpcf7 > form').wpcf7InitForm();} // this function need to be initialized after initVerticalSplitSlider in order to initialize
            },
			onLeave: function(index, nextIndex, direction){
				if($j($j('.ms-right .ms-section')[$j(".ms-right .ms-section").length-nextIndex]).data('header_style') != ""){
					$j('header.page_header').removeClass('dark light').addClass($j($j('.ms-right .ms-section')[$j(".ms-right .ms-section").length-nextIndex]).data('header_style'));
					$j('#multiscroll-nav').removeClass('dark light').addClass($j($j('.ms-right .ms-section')[$j(".ms-right .ms-section").length-nextIndex]).data('header_style'));
				}else{
					$j('header.page_header').removeClass('dark light').addClass(default_header_style);
					$j('#multiscroll-nav').removeClass('dark light').addClass(default_header_style);
				}
			}
        });
    }else{
        if(!$j('.full_screen_holder').length) { //because this is not necessary on pages if there are full screen sections
            $j('html,body').css('height', 'auto');
        }
    }
}

/*
 *	Check header style on scroll
 */

function checkHeaderStyleOnScroll(){
    if($j('[data-edgt_header_style]').length > 0 && $j('header').hasClass('header_style_on_scroll')){

        //var offset = $j('header.page_header').height();
        var default_header_style = '';
        if($j('header.page_header').hasClass('light')){
            default_header_style = 'light';
        }else if($j('header.page_header').hasClass('dark')){
            default_header_style = 'dark';
        }else{
            default_header_style = header_style_admin;
        }

        $j('.full_width_inner > .wpb_row.section, .full_width_inner > .parallax_section_holder, .container_inner > .wpb_row.section, .container_inner > .parallax_section_holder').waypoint( function(direction) {
            if(direction === 'down') {
                if ($j(this).data("edgt_header_style") !== undefined) {
                    var header_style = $j(this).data("edgt_header_style");
                    $j('header').removeClass('dark light').addClass(header_style);
                } else {
                    $j('header').removeClass('dark light').addClass(default_header_style);
                }
            }

        }, { offset: 0 });

        $j('.full_width_inner > .wpb_row.section, .full_width_inner > .parallax_section_holder, .container_inner > .wpb_row.section, .container_inner > .parallax_section_holder').waypoint( function(direction) {

            if(direction === 'up') {
                if ($j(this).data("edgt_header_style") !== undefined) {
                    var header_style = $j(this).data("edgt_header_style");
                    $j('header').removeClass('dark light').addClass(header_style);
                } else {
                    $j('header').removeClass('dark light').addClass(default_header_style);
                }
            }

        }, { offset: function(){
            return -$j(this).outerHeight();
        } });
    }
}

function checkHolderWidth(){
	"use strict";

	if($j('.full_width').length){
		if($j('.edgt_elements_holder').length && !$j('.edgt_elements_holder').parents('.grid_section').length){
			$j('.edgt_elements_holder').each(function(){
				var element_holder_width = $j(this).width();
				var number_of_items_inside = $j(this).find('.edgt_elements_item').length;
				if((element_holder_width % number_of_items_inside) !== 0){
//					console.log(element_holder_width);
//					console.log(number_of_items_inside);
//					console.log(element_holder_width % number_of_items_inside);
					var new_element_width = element_holder_width + (number_of_items_inside - (element_holder_width % number_of_items_inside));
					//	console.log(new_element_width);
					$j(this).width(new_element_width);
				}else{
					$j(this).removeStyle('width');
				}
			})
		}
	}
}

function initVerticalTabsContentHeight(){
	"use strict";    
	
    $j('.edgt_tabs.vertical').each(function() {
        $j(this).find('.tabs-container').css('min-height', $j(this).find('.tabs-nav').height());
    });

}

function initVerticalTabsWidth(){
	"use strict";    
    $j('.edgt_tabs.vertical:not(.default)').each(function() {
        var $this = $j(this);
        var $tabs_nav_width = $this.find('.tabs-nav').width();
        $this.find('.tabs-nav li a').css('min-width', $tabs_nav_width);
    });
}

/*
 *	Preload backgrounds on predefined elements
 */

function preloadBackgrounds(){
    "use strict";

    $j(".preload_background ").each(function() {
        var $this = $j(this);
        if($this.css("background-image") != "" && $this.css("background-image") != "none") {

            var bg_url = $this.attr('style');

            bg_url = bg_url.match(/url\(["']?([^'")]+)['"]?\)/);
            bg_url = bg_url ? bg_url[1] : "";
            if (bg_url) {
                var backImg = new Image();
                backImg.src = bg_url;
                $j(backImg).load(function(){
                    $this.removeClass('preload_background');
                    initParallaxTitle(); //make sure that new image loaded and init parallax is properly loaded
                });
            }
        }else{
            $j(window).load(function(){ $this.removeClass('preload_background') }); //make sure that preload_background class is removed from elements with forced background none in css
        }
    });
}

function setVideoHeightAndWidth() {
  "use strict";
  
 $j('div.wp-video .wp-video-shortcode video').each(function(){
    var $this = $j(this);
    var vidWidth = $this.attr('width');
    var vidHeight = $this.attr('height');
    var id = $this.attr('id');

    
   $this.parent('.wp-video-shortcode').css('height', vidHeight);
   $this.parent('.wp-video-shortcode').css('width', vidWidth);   
 }); 
}

function createTabIcons() {
    "use strict";
    
    //var tabs = $j('.edgt_tabs > ul.tabs-nav > li > a');
    var tabContent = $j('.tabs-container > .tab-content');
    
    tabContent.each(function(){

        var id = $j(this).attr('id');
        
        var icon = '';
        if(typeof($j(this).data('icon-html')) !== 'undefined') {
            icon = $j(this).data('icon-html');
        }
        
        var tabNav = $j(this).parents('.edgt_tabs').find('ul.tabs-nav > li > a[href="#'+id+'"]');
        
        if(typeof(tabNav) !== 'undefined') {
            tabNav.children().append(icon);
        }
    });    
}

function checkSVG(element) {
    "use strict";

    var el = element.find('.active .edgt_slide-svg-holder');
    var drawing_enabled = el.data('svg-drawing');

    if (drawing_enabled == 'yes') {
        drawSVG(el);
    }
}

/**
 * Function for drawing slider svgs. Based on Codrops article 'SVG Drawing Animation'
 */
function drawSVG(svg) {
    "use strict";
    var svgs = Array.prototype.slice.call( svg.find('svg') ),
        svgArr = new Array(),
        resizeTimeout;
    // the svgs already shown...
    svgs.forEach( function( el, i ) {
        var svg = new SVGEl( el );
        svgArr[i] = svg;
        setTimeout(function( el ) {
            return function() {
                svg.render();
            };
        }( el ), 0 );//0ms pause before drawing
    } );
}

var docElem = window.document.documentElement;
window.requestAnimFrame = function(){
    return (
    window.requestAnimationFrame       ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame    ||
    window.oRequestAnimationFrame      ||
    window.msRequestAnimationFrame     ||
    function(/* function */ callback){
        window.setTimeout(callback, 1000 / 60);
    }
    );
}();
window.cancelAnimFrame = function(){
    return (
    window.cancelAnimationFrame       ||
    window.webkitCancelAnimationFrame ||
    window.mozCancelAnimationFrame    ||
    window.oCancelAnimationFrame      ||
    window.msCancelAnimationFrame     ||
    function(id){
        window.clearTimeout(id);
    }
    );
}();
function SVGEl( el ) {
    this.el = el;
    var frameRate = $j(this.el).closest('.edgt_slide-svg-holder').data('svg-frames');
    this.image = this.el.previousElementSibling;
    this.current_frame = 0;
    this.total_frames = frameRate;//number of frames defines speed of drawing
    this.path = new Array();
    this.length = new Array();
    this.handle = 0;
    this.init();
}
SVGEl.prototype.init = function() {
    var self = this;
    [].slice.call( this.el.querySelectorAll( 'path' ) ).forEach( function( path, i ) {
        self.path[i] = path;
        var l = self.path[i].getTotalLength();
        self.length[i] = l;
        self.path[i].style.strokeDasharray = l + ' ' + l;
        self.path[i].style.strokeDashoffset = l;
    } );
};
SVGEl.prototype.render = function() {
    if( this.rendered ) return;
    this.rendered = true;
    this.draw();
};
SVGEl.prototype.draw = function() {
    var self = this,
        progress = this.current_frame/this.total_frames;
    if (progress > 1) {
        window.cancelAnimFrame(this.handle);
    } else {
        this.current_frame++;
        for(var j=0, len = this.path.length; j<len;j++){
            this.path[j].style.strokeDashoffset = Math.floor(this.length[j] * (1 - progress));
        }
        this.handle = window.requestAnimFrame(function() { self.draw(); });
    }
};


function initEdgeElementAnimationSkrollr() {
    "use strict";
    if($j('.no-touch .carousel').length == 0) {

        var elementItemAnimation = $j('.edgt_elements_holder > .edgt_elements_item');
        elementItemAnimation.each(function(){

            if((typeof($j(this).data('animation')) !== 'undefined' || typeof($j('.title_outer').data('animation')) !== 'undefined') && $j(this).data('animation') == 'yes') {
                var skr = skrollr.init({
                    smoothScrolling: false,
                    forceHeight: false
                });
                skr.refresh();
                return false;
            }

        });
    }

}

/**
 * Creates css classes for flexslider arrows used for navigation
 *
 * @param iconClass
 * @returns {{leftIconClass: string, rightIconClass: string}}
 */
function getIconClassesForNavigation(iconClass) {
    "use strict";

    var leftIconClass = '';
    var rightIconClass = '';

    switch(iconClass) {
        case 'arrow_carrot-left_alt2':
            leftIconClass = 'arrow_carrot-left_alt2';
            rightIconClass = 'arrow_carrot-right_alt2';
            break;
        case 'arrow_carrot-2left_alt2':
            leftIconClass = 'arrow_carrot-2left_alt2';
            rightIconClass = 'arrow_carrot-2right_alt2';
            break;
        case 'arrow_triangle-left_alt2':
            leftIconClass = 'arrow_triangle-left_alt2';
            rightIconClass = 'arrow_triangle-right_alt2';
            break;
        case 'icon-arrows-drag-left-dashed':
            leftIconClass = 'icon-arrows-drag-left-dashed';
            rightIconClass = 'icon-arrows-drag-right-dashed';
            break;
        case 'icon-arrows-drag-left-dashed':
            leftIconClass = 'icon-arrows-drag-left-dashed';
            rightIconClass = 'icon-arrows-drag-right-dashed';
            break;
        case 'icon-arrows-left-double-32':
            leftIconClass = 'icon-arrows-left-double-32';
            rightIconClass = 'icon-arrows-right-double';
            break;
        case 'icon-arrows-slide-left1':
            leftIconClass = 'icon-arrows-slide-left1';
            rightIconClass = 'icon-arrows-slide-right1';
            break;
        case 'icon-arrows-slide-left2':
            leftIconClass = 'icon-arrows-slide-left2';
            rightIconClass = 'icon-arrows-slide-right2';
            break;
        case 'icon-arrows-slim-left-dashed':
            leftIconClass = 'icon-arrows-slim-left-dashed';
            rightIconClass = 'icon-arrows-slim-right-dashed';
            break;
        case 'ion-arrow-left-a':
            leftIconClass = 'ion-arrow-left-a';
            rightIconClass = 'ion-arrow-right-a';
            break;
        case 'ion-arrow-left-b':
            leftIconClass = 'ion-arrow-left-b';
            rightIconClass = 'ion-arrow-right-b';
            break;
        case 'ion-arrow-left-c':
            leftIconClass = 'ion-arrow-left-c';
            rightIconClass = 'ion-arrow-right-c';
            break;
        case 'ion-ios-arrow-':
            leftIconClass = iconClass+'back';
            rightIconClass = iconClass+'forward';
            break;
        case 'ion-ios-fastforward':
            leftIconClass = 'ion-ios-rewind';
            rightIconClass = 'ion-ios-fastforward';
            break;
        case 'ion-ios-fastforward-outline':
            leftIconClass = 'ion-ios-rewind-outline';
            rightIconClass = 'ion-ios-fastforward-outline';
            break;
        case 'ion-ios-skipbackward':
            leftIconClass = 'ion-ios-skipbackward';
            rightIconClass = 'ion-ios-skipforward';
            break;
        case 'ion-ios-skipbackward-outline':
            leftIconClass = 'ion-ios-skipbackward-outline';
            rightIconClass = 'ion-ios-skipforward-outline';
            break;
        case 'ion-android-arrow-':
            leftIconClass = iconClass+'back';
            rightIconClass = iconClass+'forward';
            break;
        case 'ion-android-arrow-dropleft-circle':
            leftIconClass = 'ion-android-arrow-dropleft-circle';
            rightIconClass = 'ion-android-arrow-dropright-circle';
            break;
        default:
            leftIconClass = iconClass+'left';
            rightIconClass = iconClass+'right';
    }

    var iconClasses = {
        leftIconClass: leftIconClass,
        rightIconClass: rightIconClass
    };

    return iconClasses;
}

function initPageTitleAnimation(){
    "use strict";

    if($j('.title_outer').data('animation') == 'yes' && $j('.title_outer').length > 0) {
        var skrollr_title = skrollr.init({
            smoothScrolling: false,
            forceHeight: false
        });
        skrollr_title.refresh();

    }
}

/**
 * Masonry gallery, init masonry and resize pictures in grid
 */
function initMasonryGallery(){
    "use strict";

    resizeMasonryGallery($j('.grid-sizer').width());

    if($j('.masonry_gallery_holder').length){

        $j('.masonry_gallery_holder').each(function(){
            var $this = $j(this);
            $this.waitForImages(function(){
                $this.animate({opacity:1});
                $this.isotope({
                    itemSelector: '.masonry_gallery_item',
                    masonry: {
                        columnWidth: '.grid-sizer'
                    }
                });
            });
        });
        $j(window).resize(function(){
            resizeMasonryGallery($j('.grid-sizer').width());
            $j('.masonry_gallery_holder').isotope('reloadItems');
        });
    }
}

function resizeMasonryGallery(size){
    "use strict";

    var rectangle_portrait = $j('.masonry_gallery_holder .rectangle_portrait');
    var rectangle_landscape = $j('.masonry_gallery_holder .rectangle_landscape');
    var square_big = $j('.masonry_gallery_holder .square_big');
    var square_small = $j('.masonry_gallery_holder .square_small');

    rectangle_portrait.css('height', 2*size);
    if (window.innerWidth < 600) {
        rectangle_landscape.css('height', size/2);
    }
    else {
        rectangle_landscape.css('height', size);
    }
    square_big.css('height', 2*size);
    if (window.innerWidth < 600) {
        square_big.css('height', square_big.width());
    }
    square_small.css('height', size);
}

/**
 * Blog Masonry gallery, init masonry and resize pictures in grid
 */
function initBlogMasonryGallery(){
    "use strict";

    resizeBlogMasonryGallery($j('.blog_holder_grid_sizer').width());

    if($j('.blog_holder.blog_masonry_gallery').length){

        $j('.blog_holder.blog_masonry_gallery').each(function(){
            var $this = $j(this);
            $this.waitForImages(function(){
                $this.animate({opacity:1});
                $this.isotope({
                    itemSelector: 'article',
                    masonry: {
                        columnWidth: '.blog_holder_grid_sizer'
                    }
                });
            });
        });
        $j(window).resize(function(){
            resizeBlogMasonryGallery($j('.blog_holder_grid_sizer').width());
            $j('.blog_holder.blog_masonry_gallery').isotope('reloadItems');
        });
    }
}

function resizeBlogMasonryGallery(size){
    "use strict";

    var rectangle_portrait = $j('.blog_holder.blog_masonry_gallery .rectangle_portrait');
    var rectangle_landscape = $j('.blog_holder.blog_masonry_gallery .rectangle_landscape');
    var square_big = $j('.blog_holder.blog_masonry_gallery .square_big');
    var square_small = $j('.blog_holder.blog_masonry_gallery .square_small');

    rectangle_portrait.css('height', 2*size);
    rectangle_landscape.css('height', size);
    square_big.css('height', 2*size);
    if (square_big.width() < 350) {
        square_big.css('height', square_big.width());
    }
    square_small.css('height', size);
}

/*
 * Masonry Blog List shortcode
 */
function initMasonryBlogList() {
    'use strict';

    if($j('.latest_post_holder.masonry .post_list').length){

        $j('.latest_post_holder.masonry .post_list').each(function(){
            var $this = $j(this);
            $this.waitForImages(function(){
                $this.animate({opacity:1});
                $this.isotope({
                    itemSelector: '.blog-list-masonry-item',
                    masonry: {
                        columnWidth: '.blog-list-masonry-grid-sizer',
                        gutter: '.blog-list-masonry-grid-sizer-gutter'
                    }
                });
            });
        });

    }
}

function alterWPMLSwitcherHeaderBottom() {
    "use strict";

    if($j('.header_bottom li.menu-item-language').length) {
        var langDropdown = $j('.header_bottom .menu-item-language').find('.submenu-languages');

        if(typeof langDropdown !== 'undefined') {
            langDropdown.parent('li').addClass('narrow');
            langDropdown.wrap('<div class="second"><div class="inner"></div></div>');
            langDropdown.show();
        }

        $j('.header_bottom .menu-item-language').each(function() {
            $j(this).find('> a').first().wrapInner('<span class="item_inner"><span class="item_text"></span></span>');
            //$j(this).wrap('<span class="item_inner"><span class="item_text"></span></span>');
        });
    }
}