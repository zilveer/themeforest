/*global  trizzy */
/* ----------------- Start Document ----------------- */
(function($){
	"use strict";

	$(document).ready(function(){

		// Top Bar Dropdown
		//----------------------------------------//

		$('.top-bar-dropdown').click(function(event) {
			$('.top-bar-dropdown').not(this).removeClass('active');
			if ($(event.target).parent().parent().attr('class') == 'options' ) {
				hideDD();
			} else {
				if($(this).hasClass('active') &&  $(event.target).is( "span" )) {
					hideDD();
				} else {
					$(this).toggleClass('active');
				}
			}
			event.stopPropagation();
		});

		$(document).click(function() { hideDD(); });

		$('ul.options li,ul.curr_list_vertical li').click(function() {
			var opt = $(this);
			var text = opt.text();
			$('.top-bar-dropdown.active span').text(text);
			hideDD();
		});

		function hideDD(){
			$('.top-bar-dropdown').removeClass('active');
		}



		// Cart
		//----------------------------------------//

		$("#cart").hoverIntent({
			sensitivity: 3,
			interval: 60,
			over: function () {
				$('.cart-list', this).fadeIn(200);
				$('.cart-btn a.button', this).addClass('hovered');
			},
			timeout: 220,
			out: function () {
				$('.cart-list', this).fadeOut(100);
				$('.cart-btn a.button', this).removeClass('hovered');
			}
		});



		// Initialise Superfish
		//----------------------------------------//

		$('ul.menu').superfish({
			delay:       400,                    // delay on mouseout
			speed:       200,                    // faster animation speed
			speedOut:    100,                    // speed of the closing animation
			autoArrows:  true,                    // disable generation of arrow mark-up
			onBeforeShow: function(){
				$($('ul.menu > li.no-megamenu').find('ol').get().reverse()).each(function(){
					$(this).prev().addClass('with-ul');
				  	$(this).replaceWith($('<ul>'+$(this).html()+'</ul>'))
				})
			}
		});
		$('ul#shop-menu').superfish({
			delay:       400,                    // delay on mouseout
			speed:       200,                    // faster animation speed
			speedOut:    100,                    // speed of the closing animation
			autoArrows:  true                    // disable generation of arrow mark-up
		});



		// Mobile Navigation
		//----------------------------------------//

		var jPanelMenu = $.jPanelMenu({
			menu: '#responsive',
			animated: false,
			keyboardShortcuts: true
		});
		jPanelMenu.on();

		$(document).on('click',jPanelMenu.menu + ' li a',function(e){
			if ( jPanelMenu.isOpen() && $(e.target).attr('href').substring(0,1) === '#' ) { jPanelMenu.close(); }
		});

		$(document).on('touchend','.menu-trigger',function(e){
			jPanelMenu.triggerMenu();
			e.preventDefault();
			return false;
		});

			// Removes SuperFish Styles
			$('#jPanelMenu-menu').removeClass('menu');
			$('ul#jPanelMenu-menu li').removeClass('dropdown');
			$('ul#jPanelMenu-menu li ul').removeAttr('style');
			$('ul#jPanelMenu-menu li div').removeClass('mega');
			$('ul#jPanelMenu-menu li div').removeAttr('style');
			$('ul#jPanelMenu-menu li div div').removeClass('mega-container');


			$(window).resize(function (){
				var winWidth = $(window).width();
				if( winWidth> trizzy.breakpoint ) {
					jPanelMenu.close();
				}
			});


		// ShowBiz Carousel
		//----------------------------------------//
		$('.new-arrivals').showbizpro({
			dragAndScroll:"on",
			visibleElementsArray:[4,4,3,1],
			carousel:"off",
			entrySizeOffset:0,
			allEntryAtOnce:"off",
			rewindFromEnd:"off",
			autoPlay:"off",
			delay:2000,
			speed:400,
			easing:'Back.easeOut'
		});		

		$('#recent-blog-carousel').showbizpro({
			dragAndScroll:"on",
			visibleElementsArray:[4,4,3,1],
			carousel:"off",
			entrySizeOffset:0,
			allEntryAtOnce:"off",
			rewindFromEnd:"off",
			autoPlay:"off",
			delay:2000,
			speed:400,
			easing:'Back.easeOut'
		});

		$('#happy-clients').showbizpro({
			dragAndScroll:"off",
			visibleElementsArray:[1,1,1,1],
			carousel:"off",
			entrySizeOffset:0,
			allEntryAtOnce:"off"
		});

		$('#our-clients').showbizpro({
			dragAndScroll:"off",
			visibleElementsArray:[5,4,3,1],
			carousel:"off",
			entrySizeOffset:0,
			allEntryAtOnce:"off"
		});



		// Parallax Banner
		//----------------------------------------//
		$(".parallax-banner").pureparallax({
			overlayBackgroundColor: '#000',
			overlayOpacity : '0.45',
			timeout: 200
		});

		$(".parallax-titlebar").pureparallax({
			timeout: 100
		});



		function addLevelClass($parent, level) {
		    $parent.addClass('parent-'+level);
		    var $children = $parent.children('li');
		    $children.addClass('child-'+level).data('level',level);
		    $children.each(function() {
		        var $sublist = $(this).children('ul');
		        if ($sublist.length > 0) {
		            $(this).addClass('has-sublist');
		            addLevelClass($sublist, level+1);
		        }
		    });
		}

		addLevelClass($('.trizzy_woocommerce .product-categories'), 1);

		//----------------------------------------//
		$('.trizzy_woocommerce .product-categories > li a').click(function(e){
			var curlvl = '';
			if($(this).parent().hasClass('has-sublist')) {
				e.preventDefault();
			}
			if ($(this).attr('class') != 'active'){
				$(this).parent().siblings().find('ul').slideUp();
				$(this).next().slideToggle();
				if($(this).parent().hasClass("has-sublist")){

					$(this).parent().siblings().find('a').removeClass('active');
					$(this).addClass('active');
				} else {
					curlvl = $(this).parent().data('level');
					if(curlvl){
						$('.trizzy_woocommerce .product-categories li.child-'+curlvl+' a').removeClass('active');
					}
				}

			} else {
				$(this).next().slideToggle();
				$(this).parent().find('ul').slideUp();
				 curlvl = $(this).parent().data('level');
				console.log(curlvl);
				if(curlvl){
					$('.trizzy_woocommerce .product-categories li.child-'+curlvl+' a').removeClass('active');
				}
			}
		});




		// Product Slider
		//----------------------------------------//

		$('#product-slider').royalSlider({
			autoScaleSlider: true,
			autoScaleSliderWidth: 560,
			autoHeight: true,

			loop: false,
			slidesSpacing: 0,


			imageScaleMode: 'none',
			imageAlignCenter:false,

			navigateByClick: false,
			numImagesToPreload : 10,

			/* Arrow Navigation */
			arrowsNav:true,
			arrowsNavAutoHide: false,
			arrowsNavHideOnTouch: true,
			keyboardNavEnabled: true,
			fadeinLoadedSlide: true,

			/* Thumbnail Navigation */
			controlNavigation: 'thumbnails',
			thumbs: {
				orientation: 'horizontal',
				firstMargin: false,
				appendSpan: true,
				autoCenter: false,
				spacing: 10,
				paddingTop: 10,
			}
		});		
		$('#product-slider-no-thumbs').royalSlider({
			autoScaleSlider: true,
			autoScaleSliderWidth: 560,
			autoHeight: true,

			loop: false,
			slidesSpacing: 0,


			imageScaleMode: 'none',
			imageAlignCenter:false,

			navigateByClick: false,
			numImagesToPreload : 10,

			/* Arrow Navigation */
			arrowsNav:true,
			arrowsNavAutoHide: false,
			arrowsNavHideOnTouch: true,
			keyboardNavEnabled: true,
			fadeinLoadedSlide: true,

		
		});


		$('#product-slider-vertical').royalSlider({

			autoScaleSlider: true,
			autoScaleSliderWidth: 560,
			autoHeight: true,


			loop: false,
			slidesSpacing: 0,

			imageScaleMode: 'none',
			imageAlignCenter:false,

			navigateByClick: false,
			numImagesToPreload:10,

			/* Arrow Navigation */
			arrowsNav:true,
			arrowsNavAutoHide: false,
			arrowsNavHideOnTouch: true,
			keyboardNavEnabled: true,
			fadeinLoadedSlide: true,

			/* Thumbnail Navigation */
			controlNavigation: 'thumbnails',
			thumbs: {
				orientation: 'vertical',
				firstMargin: false,
				appendSpan: true,
				autoCenter: false,
				spacing: 10,
				paddingTop: 10,
			}

		});
		/*var slider = $("#product-slider-vertical").data('royalSlider');
		slider.ev.on('rsAfterSlideChange', function(event) {
		    var newheight = $("#product-slider-vertical .rsContainer").height();
		    $('#product-slider-vertical').css({'height' : newheight});
		});*/


		$('.basic-slider').royalSlider({

			autoScaleSlider: true,
			autoScaleSliderHeight: "auto",
			autoHeight: true,

			loop: false,
			slidesSpacing: 0,

			imageScaleMode: 'none',
			imageAlignCenter:false,

			navigateByClick: false,
			numImagesToPreload:10,

			/* Arrow Navigation */
			arrowsNav:true,
			arrowsNavAutoHide: false,
			arrowsNavHideOnTouch: true,
			keyboardNavEnabled: true,
			fadeinLoadedSlide: true,

		});



		// Product Quantity
		//----------------------------------------//

		


		// Tabs
		//----------------------------------------//
		var $tabsNav    = $('.tabs-nav'),
		$tabsNavLis = $tabsNav.children('li');
		// $tabContent = $('.tab-content');

		$tabsNav.each(function() {
			var $this = $(this);
			$this.next().children('.tab-content').stop(true,true).hide().first().show();
			$this.children('li').first().addClass('active').stop(true,true).show();
		});
		$tabsNavLis.on('click', function(e) {
			var $this = $(this);
			if($tabsNavLis.length > 1 ) {
				$this.siblings().removeClass('active').end().addClass('active');
				$this.parent().next().children('.tab-content').stop(true,true).hide().siblings( $this.find('a').attr('href') ).fadeIn();
			}
			e.preventDefault();
		});



		// Accordion
		//----------------------------------------//

		var $accor = $('.accordion');

		$accor.each(function() {
			$(this).addClass('ui-accordion ui-widget ui-helper-reset');
			$(this).find('h3').addClass('ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all');
			$(this).find('div').addClass('ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom');
			$(this).find("div").hide().first().show();
			$(this).find("h3").first().removeClass('ui-accordion-header-active ui-state-active ui-corner-top').addClass('ui-accordion-header-active ui-state-active ui-corner-top');
			$(this).find("span").first().addClass('ui-accordion-icon-active');
		});

		var $trigger = $accor.find('h3');

		$trigger.on('click', function(e) {
			var location = $(this).parent();

			if( $(this).next().is(':hidden') ) {
				var $triggerloc = $('h3',location);
				$triggerloc.removeClass('ui-accordion-header-active ui-state-active ui-corner-top').next().slideUp(300);
				$triggerloc.find('span').removeClass('ui-accordion-icon-active');
				$(this).find('span').addClass('ui-accordion-icon-active');
				$(this).addClass('ui-accordion-header-active ui-state-active ui-corner-top').next().slideDown(300);
			}
			e.preventDefault();
		});


		// Toggles
		//----------------------------------------//
		$(".toggle-container").hide();
		$(".trigger").toggle(function(){
			$(this).addClass("active");
		}, function () {
			$(this).removeClass("active");
		});
		$(".trigger").click(function(){
			$(this).next(".toggle-container").slideToggle();
		});

		$(".trigger.opened").toggle(function(){
			$(this).removeClass("active");
		}, function () {
			$(this).addClass("active");
		});

		$(".trigger.opened").addClass("active").next(".toggle-container").show();


		// Notification Boxes
		//----------------------------------------//

		$('.counter').counterUp({
			delay: 10,
			time: 2000
		});



		// Notification Boxes
		//----------------------------------------//

		$("a.close").removeAttr("href").click(function(){
			$(this).parent().fadeOut(200);
		});



		// Tooltips
		//----------------------------------------//

		$(".tooltip.top").tipTip({
			defaultPosition: "top"
		});

		$(".tooltip.bottom").tipTip({
			defaultPosition: "bottom"
		});

		$(".tooltip.left").tipTip({
			defaultPosition: "left"
		});

		$(".tooltip.right").tipTip({
			defaultPosition: "right"
		});



		// Magnific Popup
		//----------------------------------------//


			$('body').magnificPopup({
				type: 'image',
				delegate: 'a.mfp-gallery',

				fixedContentPos: true,
				fixedBgPos: true,

				overflowY: 'auto',

				closeBtnInside: true,
				preloader: true,

				removalDelay: 0,
				mainClass: 'mfp-fade',

				gallery:{enabled:true},

				callbacks: {
					buildControls: function() {
						console.log('inside'); this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
					}

				}
			});

			$('#basic-slider').magnificPopup({
				type: 'image',
				delegate: 'a.mfp-image',
				closeOnContentClick: true,
				mainClass: 'mfp-fade',
				image: {
					verticalFit: true
				}
			});


			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',

				fixedContentPos: false,
				fixedBgPos: true,

				overflowY: 'auto',

				closeBtnInside: true,
				preloader: false,

				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});


			$('.mfp-image').magnificPopup({
				type: 'image',
				closeOnContentClick: true,
				mainClass: 'mfp-fade',
				image: {
					verticalFit: true
				}
			});

			$('#product-slider-no-thumbs .rsSlide, #product-slider .rsSlide').magnificPopup({
	          delegate: 'a',
	          mainClass: 'mfp-fade',
	          type: 'image',
	          closeOnContentClick: true,
	          image: {
	            verticalFit: true
	          }
	        });




			$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,

				fixedContentPos: false
			});



		// Skill Bars Animation
		//----------------------------------------//

		if($('#skillzz').length !==0){
			var skillbar_active = false;
			$('.skill-bar-value').hide();

			if($(window).scrollTop() === 0 && isScrolledIntoView($('#skillzz')) === true){
				skillbarActive();
				skillbar_active = true;
			}
			else if(isScrolledIntoView($('#skillzz')) === true){
				skillbarActive();
				skillbar_active = true;
			}
			$(window).bind('scroll', function(){
				if(skillbar_active === false && isScrolledIntoView($('#skillzz')) === true ){
					skillbarActive();
					skillbar_active = true;
				}
			});
		}

		function isScrolledIntoView(elem) {
			var docViewTop = $(window).scrollTop();
			var docViewBottom = docViewTop + $(window).height();

			var elemTop = $(elem).offset().top;
			var elemBottom = elemTop + $(elem).height();

			return ((elemBottom <= (docViewBottom + $(elem).height())) && (elemTop >= (docViewTop - $(elem).height())));
		}

		function skillbarActive(){
			setTimeout(function(){

				$('.skill-bar-value').each(function() {
					$(this)
					.data("origWidth", $(this)[0].style.width)
					.css('width','1%').show();
					$(this)
					.animate({
						width: $(this).data("origWidth")
					}, 1200);
				});

				$('.skill-bar-value .dot').each(function() {
					var me = $(this);
					var perc = me.attr("data-percentage");

					var current_perc = 0;

					var progress = setInterval(function() {
						if (current_perc>=perc) {
							clearInterval(progress);
						} else {
							current_perc +=1;
							me.text((current_perc)+'%');
						}
					}, 10);
				});
			}, 10);}



		// Custom Select Boxes
		//----------------------------------------//

		$('.orderby').selectric();


		$('.stars a').on( "click", function() {
			$('.stars a').removeClass('prevactive');
		 	$(this).prevAll().addClass('prevactive');
		}).hover(
		  function() {
		  	$('.stars a').removeClass('prevactive');
	    	$(this).addClass('prevactive').prevAll().addClass('prevactive');
		  }, function() {
		  	$('.stars a').removeClass('prevactive');
		  	$('.stars a.active').prevAll().addClass('prevactive');
		  }
		);


		// Dynamic Grid Filters
		//----------------------------------------//

		$('.option-set li').click(function(event) {
			event.preventDefault();
			var item = $(".og-grid li"),
			image = item.find('a.grid-item-image img');
			item.removeClass('clickable unclickable');
			image.stop().animate({opacity: 1});
			var filter = $(this).children('a').data('filter');
			item.filter(filter).addClass('clickable');
			item.filter(':not('+filter+')').addClass('unclickable');
			item.filter(':not('+filter+')').find('a.grid-item-image im').stop().animate({opacity: 0.2});
		});





		// Retina Images
		//----------------------------------------//

		var pixelRatio = !!window.devicePixelRatio ? window.devicePixelRatio : 1;

		$(window).on("load", function() {
			if (pixelRatio > 1) {
				if(trizzy.retinalogo) {
					$('#logo img').attr('src',trizzy.retinalogo);
				}
			}
		});

		



		// Portfolio Isotope
		//----------------------------------------//

		$(window).load(function(){
			var $container = $('#portfolio-wrapper, #masonry-wrapper, .full-width-class .products, .columns-4 .products, .archive .twelve.columns .products');
			$container.isotope({ itemSelector: '.portfolio-item, .masonry-item, .masonry-shop-item, .products-categories', layoutMode: trizzy.isotope });

			var $percontainer = $('.percent.masonry');
			$percontainer.isotope({ itemSelector: '.masonry-shop-item',layoutMode: 'fitRows' });

		});


		$(window).load(function(){
			var $mascontainer = $('.recent-blog-posts.masonry');
			$mascontainer.isotope({ itemSelector: '.recent-blog',layoutMode: 'fitRows' });
		});

		$('#filters a').click(function(e){
			e.preventDefault();

			var selector = $(this).attr('data-filter');
			$('#portfolio-wrapper').isotope({ filter: selector });

			$(this).parents('ul').find('a').removeClass('selected');
			$(this).addClass('selected');
		});



		// Share Buttons
		//----------------------------------------//

		var $Filter = $('.share-buttons');
		var FilterTimeOut;
		$Filter.find('ul li:first').addClass('active');
		$Filter.find('ul li:not(.active)').hide();
		$Filter.hover(function(){
			clearTimeout(FilterTimeOut);
			if( $(window).width() < 959 )
			{
				return;
			}
			FilterTimeOut=setTimeout(function(){
				$Filter.find('ul li:not(.active)').stop(true, true).animate({width: 'show' }, 250, 'swing');
				$Filter.find('ul li:first-child a').addClass('share-hovered');
			}, 100);

		},function(){
			if( $(window).width() < 960 )
			{
				return;
			}
			clearTimeout(FilterTimeOut);
			FilterTimeOut=setTimeout(function(){
				$Filter.find('ul li:not(.active)').stop(true, true).animate({width: 'hide'}, 250, 'swing');
				$Filter.find('ul li:first-child a').removeClass('share-hovered');

			}, 250);
		});
		$(window).resize(function() {
			if( $(window).width() < 960 )
			{
				$Filter.find('ul li:not(.active)').show();
			}
			else
			{
				$Filter.find('ul li:not(.active)').hide();
			}
		});
		$(window).resize();



		// Responsive Tables
		//----------------------------------------//
		$('.responsive-table').stacktable();

	
		$(".small-only  #coupon_code").on( "change", function() {
				var value = $(this).val();
				var name = $(this).attr('name');
				$(".large-only").find("input[name*='"+name+"']").val(value);
			});

		//	Back To Top Button
		//----------------------------------------//

		var pxShow = 600; // height on which the button will show
		var fadeInTime = 400; // how slow / fast you want the button to show
		var fadeOutTime = 400; // how slow / fast you want the button to hide
		var scrollSpeed = 400; // how slow / fast you want the button to scroll to top.

		$(window).scroll(function(){
			if($(window).scrollTop() >= pxShow){
				$("#backtotop_trizzy").fadeIn(fadeInTime);
			} else {
				$("#backtotop_trizzy").fadeOut(fadeOutTime);
			}
		});

		$('#backtotop_trizzy a').click(function(){
			$('html, body').animate({scrollTop:0}, scrollSpeed);
			return false;
		});

		// Contact Form
		//----------------------------------------//


			//reset previously set border colors and hide all comment on .keyup()
			$("#contactform input, #contactform textarea").keyup(function() {
				$("#contactform input, #contactform textarea").removeClass('error');
				$("#result").slideUp();
			});

			var bankheader = $('.order_details.bacs_details').prev('h2').text();
			if(bankheader){
				$('.order_details.bacs_details').prev('h2').replaceWith('<h3 class="headline margin-top-30">'+bankheader+'</h3><span class="line margin-bottom-20"></span><div class="clearfix"></div>');
			}
			var oostext = $('.product-page .out-of-stock').text();
			$('.product-page .out-of-stock').replaceWith('<a class="button gray">'+oostext+'</a>');
			$("body.single-product").bind("DOMNodeInserted", function() {
			   $(this).find('.product-page .out-of-stock').replaceWith('<a class="button gray">' + trizzy.out_of_stock + '</a>');
			});


			$(".woo-search-elements select").multipleSelect({
	            placeholder: "Here is the placeholder",

	        });

			$('.advanced-search-btn').toggle(function() {
				$( '.woo-search-elements').fadeIn();
			}, function() {
				$( '.woo-search-elements').fadeOut();
			});

			$('#search-in-menu .fa').on('click',function(){
				 $('li#search-in-menu input[type="text"]').focus();
			});

			$( ".widget_layered_nav ul li" ).each(function( index ) {
			    var count = $(this).find('span').html();
			    $(this).find('a').append(' <span class="count">'+count+'</span>')
			})
			$(".small-only input.input-text.qty.text").on( "change", function() {
				var value = $(this).val();
				var name = $(this).attr('name');
				$(".large-only").find(".quantity.buttons_added .qty[name*='"+name+"']").val(value);
			});


   // ------------------ End Document ------------------ //
});

})(this.jQuery);


jQuery( function( $ ) {

	// Quantity buttons

	$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
		$('.plus').val('\uf067');
		$('.minus').val('\uf068');
	$( document ).on( 'click', '.plus, .minus', function() {

		// Get values
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event
		$qty.trigger( 'change' );

	});

});

