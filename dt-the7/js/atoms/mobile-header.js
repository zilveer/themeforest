
/* #Mobile header
================================================== */
// jQuery(document).ready(function($) {
	
		var $mixedHeader = $(".mixed-header"),
			$mobileWidgets = $(".masthead:not(.side-header) .header-bar .mini-widgets > * ").clone(true),
			$mobileSideWidgets = $(".side-header .header-bar .mini-widgets ").clone(true),
			// $firstSwitchWidgetsInMenu = $(".masthead .in-menu-first-switch").clone(true),
			 $firstSwitchWidgetsNearLogo = $(".masthead .near-logo-first-switch").clone(true).addClass("show-on-first-switch"),
			// $secondSwitchWidgetsInMenu = $(".masthead .in-menu-second-switch").clone(true),
			 $secondSwitchWidgetsNearLogo = $(".masthead .near-logo-second-switch").clone(true).addClass("show-on-second-switch"),
			$mobileWidgetsInMenu = $mastheadHeader.find(".in-menu-first-switch, .in-menu-second-switch").clone(true),
			$mobileWidgetsNearLogo = $mastheadHeader.find(".near-logo-first-switch, .near-logo-second-switch ").clone(true).addClass("show-on-second-switch");

		if($mixedHeader.length > 0){
			var $mobileLogo = $mixedHeader.find(".branding > a, .branding > img").clone(true),
				$activeHeader = $mixedHeader
		}else{
			var $mobileLogo = $(".masthead:not(.mixed-header)").find(".branding > a, .branding > img").clone(true),
				$activeHeader = $mastheadHeader;
		}
		if($topBar.length > 0 && $topBar.css('display') != 'none'){
			var topBarH = $topBar.innerHeight();
		}else{
			var topBarH = 0;
		}

		/*Append mobile header-bar to masthead*/
		$("<div class='mobile-header-bar'><div class='mobile-navigation'></div><div class='mobile-mini-widgets'></div><div class='mobile-branding'></div></div>").appendTo(".masthead");
		/*Mobile menu toggle icon*/
		$(".mobile-header-bar .mobile-navigation").append("<a href='#' class='dt-mobile-menu-icon'><span class='lines'></span></a>");
		/*Append mini widgets to mobile header-bar*/
		$(".mobile-header-bar .mobile-mini-widgets").append($mobileWidgets);
		/*Append logo to mobile header-bar*/
		$(".mobile-header-bar .mobile-branding").append($mobileLogo);

		var $mobileMenu = $(".dt-mobile-header");
		if($mobileMenu.siblings().hasClass("dt-parent-menu-clickable")){
			$mobileMenu.addClass("dt-parent-menu-clickable");
		}

		/*Mobile widgets*/
		$($mobileWidgetsInMenu).appendTo(".mobile-mini-widgets-in-menu");
		//$($firstSwitchWidgetsNearLogo).appendTo(".mobile-mini-widgets");
		$($secondSwitchWidgetsNearLogo).appendTo(".mobile-mini-widgets");
		$mobileMenu.append($mobileSideWidgets);
		

		/*Remove mega menu settings from mobile*/
		$(".mobile-main-nav ").find("li").each(function(){
			var $this = $(this),
				$this_sub = $this.find(" > .dt-mega-menu-wrap > .sub-nav");
			if($this.hasClass("new-column")){
				var $thisPrev = $this.prev().find(" > .sub-nav");
				$(" > .sub-nav > *", $this).appendTo($thisPrev)
			}
			$this_sub.unwrap();		
		}).removeClass('dt-mega-menu dt-mega-parent hide-mega-title').find(" > .sub-nav").removeClass("hover-style-click-bg hover-style-bg");


		/*!-Show Hide mobile header*/
		if($mobileMenu.length > 0 ) {
			dtGlobals.mobileMenuPoint = 50;
			var $menu = $(".dt-mobile-header"),
				$Mobilehamburger = $(".dt-mobile-menu-icon");
			//$menu.wrap("<div class='mobile-header-scrollbar-wrap'></div>"); - working with new header

			/*Mobile floating menu toggle*/
			if(!$(".floating-btn").length > 0 && $(".floating-mobile-menu-icon").length > 0){
				var $hamburgerFloat = $Mobilehamburger.first().clone(true);
				$hamburgerFloat.insertBefore($Mobilehamburger).addClass("floating-btn");
			}
			var $floatMobBtn = $(".floating-btn");
			
			var mobilePhantomAnimate = false;

			//!--Working with new header
			// $window.scroll(function () {
			// 	dtGlobals.mobileMenuPoint = $activeHeader.offset().top + $activeHeader.height() + 50;
			// //	if (!$(".show-mobile-header").length > 0) {
			// 		if(dtGlobals.winScrollTop > dtGlobals.mobileMenuPoint){
			// 			//console.log("show float")
			// 			$floatMobBtn.parents(".masthead").addClass("show-floating-icon");
			// 			//$body.addClass("show-floating-icon");
			// 		}
			// 		else {
			// 			$floatMobBtn.parents(".masthead").removeClass("show-floating-icon");
			// 			//$body.removeClass("show-floating-icon");
			// 		}
			// 		if(dtGlobals.winScrollTop > (dtGlobals.mobileMenuPoint - 50)){
			// 			$body.addClass("stick-to-top");
			// 		}else{
			// 			$body.removeClass("stick-to-top");
			// 		}


			// 		//sticky mobile header && sticky desktop header (show/hide top bar)
			// 		if ($(".sticky-mobile-header").length > 0) {
			// 			if (dtGlobals.winScrollTop > topBarH && !mobilePhantomAnimate) {
			// 				mobilePhantomAnimate = true;
			// 				$(".mobile-header-scrollbar-wrap").css({
			// 					'padding-top': $(".mobile-header-bar", $activeHeader).height()
			// 				});
			// 				// $(".masthead-mobile")
			// 				// 	.stop(true, true)
			// 				// 	.velocity({
			// 				// 		translateY : -topBarH,
			// 				// 	}, 0);
			// 				$body.removeClass('mobile-sticky-off').addClass('mobile-sticky-on');
			// 				$body.addClass("fixed-mobile-menu");
			// 			}else if (dtGlobals.winScrollTop <= topBarH && mobilePhantomAnimate) {
			// 				mobilePhantomAnimate = false;
			// 				$(".mobile-header-scrollbar-wrap").css({
			// 					'padding-top': $(".mobile-header-bar", $activeHeader).height() + topBarH
			// 				});
			// 				// $(".masthead-mobile")
			// 				// 	.stop(true, true)
			// 				// 	.velocity({
			// 				// 		translateY : 0,
			// 				// 	}, 0);
			// 				$body.removeClass('mobile-sticky-on').addClass('mobile-sticky-off');
			// 				$body.removeClass("fixed-mobile-menu");
			// 			}
			// 		}
			// 		//floating mobile icon (show/hide header)
			// 		if(dtGlobals.winScrollTop <= ($(".mobile-header-bar", $activeHeader).height() + topBarH) && $(".floating-mobile-menu-icon").length > 0){
			// 			$(".mobile-header-scrollbar-wrap").css({
			// 				'padding-top': $(".mobile-header-bar", $activeHeader).height() + topBarH - dtGlobals.winScrollTop
			// 			});
			// 		}
			// 	//}
			// });

			$window.scroll(function () {
				dtGlobals.mobileMenuPoint = $activeHeader.offset().top + $activeHeader.height() + 50;

				if(dtGlobals.winScrollTop > dtGlobals.mobileMenuPoint){
					//console.log("show float")
					$floatMobBtn.parents(".masthead").addClass("show-floating-icon");
				}
				else {
					$floatMobBtn.parents(".masthead").removeClass("show-floating-icon");
				}
				if(dtGlobals.winScrollTop > $(".masthead:not(.side-header)").height()){
					$menu.addClass("stick-to-top");
				}else{
					$menu.removeClass("stick-to-top");
				}
			});
			var $Mobilehamburger = $(".dt-mobile-menu-icon");

			/*Append overlay for mobile menu*/
			if(!$(".mobile-sticky-header-overlay").length > 0){
				$body.append('<div class="mobile-sticky-header-overlay"></div>');
				
				//!--Working with new header
				//Prevent page scrolling when scrolling a overlay
				// var scrollableOverlay = document.querySelector('.mobile-sticky-header-overlay');

				// scrollableOverlay.addEventListener('wheel', function(event) {
				// 	var deltaY = event.deltaY;
				// 	var contentHeight = scrollableOverlay.scrollHeight;
				// 	var visibleHeight = scrollableOverlay.offsetHeight;
				// 	var scrollTop = scrollableOverlay.scrollTop;

				// 	if (scrollTop === 0 && deltaY < 0)
				// 		event.preventDefault();
				// 	else if (visibleHeight + scrollTop === contentHeight && deltaY > 0)
				// 		event.preventDefault();
				// });
			}
					
			 var $mobileOverlay = $(".mobile-sticky-header-overlay");

			/*Click on mobile menu toggle*/
			$Mobilehamburger.on("click", function (e){
				e.preventDefault();
				
				var $this = $(this);

				//!--Working with new header

				// if ($this.hasClass("active")){
				// 	$this.removeClass("active");
				// 	$Mobilehamburger.removeClass("active");
				// 	$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
				// 	$body.removeClass("show-mobile-overlay-header").addClass("closed-overlay-mobile-header");
				// 	$this.parents("body").removeClass("show-sticky-mobile-header");
				// 	$mobileOverlay.removeClass("active");
				// }else{
				// 	$Mobilehamburger.addClass("active");
				// 	$this.addClass('active');
				// 	$page.addClass("show-mobile-header").removeClass("closed-mobile-header");
				// 	$body.removeClass("closed-overlay-mobile-header").addClass("show-overlay-mobile-header");
				// 	$mobileOverlay.removeClass("active");
				// 	$this.parents("body").addClass("show-sticky-mobile-header");
					
				// 	$mobileOverlay.addClass("active");
				// };

				if ($this.hasClass("active")){
					$this.removeClass("active");
					$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
					$body.removeClass("show-mobile-overlay-header").addClass("closed-overlay-mobile-header");
					$this.parents("body").removeClass("show-sticky-mobile-header");
					$mobileOverlay.removeClass("active");
				}else{
					$Mobilehamburger.removeClass("active");
					$this.addClass('active');
					$page.addClass("show-mobile-header").removeClass("closed-mobile-header");
					$body.removeClass("closed-overlay-mobile-header").addClass("show-overlay-mobile-header");
					$mobileOverlay.removeClass("active");
					$this.parents("body").addClass("show-sticky-mobile-header");
					
					$mobileOverlay.addClass("active");
				};

			
			});
			$mobileOverlay.on("click", function (){
				if($(this).hasClass("active")){
					$Mobilehamburger.removeClass("active");
					$page.removeClass("show-mobile-header").addClass("closed-mobile-header");
					$body.removeClass("show-sticky-mobile-header").addClass("closed-overlay-mobile-header").addClass("closed-overlay-mobile-header");
					$mobileOverlay.removeClass("active");
					
				}
			});
			$(".dt-close-mobile-menu-icon span").on("click", function (){
				
				$page.removeClass("show-mobile-header");
				$page.addClass("closed-mobile-header");
				$body.removeClass("show-sticky-mobile-header");
				$body.removeClass("show-overlay-mobile-header").addClass("closed-overlay-mobile-header");
				$mobileOverlay.removeClass("active");
				$Mobilehamburger.removeClass("active");
								
			});
			
			////!--Return with old header
			$(".dt-mobile-header").wrapInner("<div class='mobile-header-scrollbar-wrap'></div>");
			if(!dtGlobals.isMobile){
				$(".mobile-header-scrollbar-wrap").mCustomScrollbar({
					scrollInertia:150
				});
			}

		};
		
		$.mobileHeader = function() {
			if($topBar.length > 0 && $topBar.css('display') != 'none'){
				var topBarH = $topBar.innerHeight()
			}else{
				var topBarH = 0;
			}

			if($(".sticky-mobile-header ").length > 0){
				if($(".mixed-header").length > 0){
					var headerH = $(".mixed-header").height();
				}else{
					var headerH = $mastheadHeader.height();
				}
				var stickyMobileHeader = $('.masthead').first();
				if(!$(".mobile-header-space").length > 0 && !$(".floating-navigation-below-slider").length > 0){
					$("<div class='mobile-header-space'></div>").insertBefore(stickyMobileHeader);
				}
				$(".mobile-header-space").css({
					height: headerH
				});
			}
			// $(".dt-mobile-header").css({
			// 	'margin-top': $(".mobile-header-bar", $activeHeader).height() + topBarH,
			// 	'max-height': $window.height() - $(".mobile-header-bar", $activeHeader).height() - topBarH
			// });
				// $(".mobile-header-scrollbar-wrap").css({
				// 	'padding-top': $(".mobile-header-bar", $activeHeader).height() + topBarH
				// });

			//$(".dt-mobile-header").mCustomScrollbar("update");
		}
		$.mobileHeader();


		//Prevent page scrolling when scrolling a div element
		// var scrollable = document.querySelector('.dt-mobile-header');

		// scrollable.addEventListener('wheel', function(event) {
		// 	var deltaY = event.deltaY;
		// 	var contentHeight = scrollable.scrollHeight;
		// 	var visibleHeight = scrollable.offsetHeight;
		// 	var scrollTop = scrollable.scrollTop;

		// 	if (scrollTop === 0 && deltaY < 0)
		// 		event.preventDefault();
		// 	else if (visibleHeight + scrollTop === contentHeight && deltaY > 0)
		// 		event.preventDefault();
		// });

		//!--Working with new header

		// $( '.dt-mobile-header' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
		//     var e0 = e.originalEvent,
		//         delta = e0.wheelDelta || -e0.detail;
		    
		//     this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
		//     e.preventDefault();
		// });

		// //Prevent page touch moving when move a div element
		// var touchStartEvent;
		// $('.dt-mobile-header, .mobile-sticky-header-overlay').on({
		//     touchstart: function(e) {
		//         touchStartEvent = e;
		//     },
		//     touchmove: function(e) {
		//         if ((e.originalEvent.pageY > touchStartEvent.originalEvent.pageY && this.scrollTop == 0) ||
		//             (e.originalEvent.pageY < touchStartEvent.originalEvent.pageY && this.scrollTop + this.offsetHeight >= this.scrollHeight))
		//             e.preventDefault();
		//     }
		// });
	
// })