/* =Main INIT Functions
-------------------------------------------------------------- */
function initializeVisia() {

	var $window = jQuery( window );

	"use strict";

	//IE9 RECOGNITION
	if (jQuery.browser.msie && jQuery.browser.version == 9) {

		jQuery('html').addClass('ie9');
	}

	//NAVIGATION CUSTOM FUNCTION
	jQuery(document).aetherNavigation();

	//LOCAL SCROLL
	jQuery('.navigation, .call-to-action').localScroll({
		offset: -50
	});

	jQuery("#top").click(function () {

		if ( window.location.href == _visia.home_url ) {

			return jQuery("body,html").stop().animate({
				scrollTop: 0
			}, 800, "easeOutCubic"), !1;

		}


	});

	//RESPONSIVE HEADINGS
	jQuery("h1").fitText(1.8, { minFontSize: '30px', maxFontSize: '52px' });
	jQuery("h2").fitText(1.5, { minFontSize: '20px', maxFontSize: '36px' });


	//HERO DIMENSTION AND CENTER
	(function() {
	    function heroInit(){
	       var hero = jQuery('.hero'),
				ww = $window.width(),
				wh = $window.height(),
				heroHeight = wh;

			hero.css({
				height: heroHeight+"px",
			});

			var heroContent = jQuery('.hero .content'),
				contentHeight = heroContent.height(),
				parentHeight = hero.height(),
				topMargin = (parentHeight - contentHeight) / 2;

			heroContent.css({
				"margin-top" : topMargin+"px"
			});
	    }

	    $window.on("resize", heroInit);
	    jQuery(document).on("ready", heroInit);
	})();

	//HERO TICKER
	var current = 1; 
	var height = jQuery('.ticker').height(); 
	var numberDivs = jQuery('.ticker').children().length; 
	var first = jQuery('.ticker h1:nth-child(1)'); 
	setInterval(function() {
	    var number = current * -height;
	    first.css('margin-top', number + 'px');
	    if (current === numberDivs) {
	        first.css('margin-top', '0px');
	        current = 1;
	    } else current++;
	}, 2500);

	//SERVICES TOOLTIP
	(function() {
		function tooltipInit(){
			var tooltip = jQuery('.tooltip'),
				target = jQuery('.feature-icon'),
				arrow = jQuery ('.arrow-down'),
				mobile = $window.width() < 960,
				desktop = $window.width() > 960

			if (mobile) {

				jQuery( ".overview:odd" ).addClass('pull-left');

				target.click(function(){
					target.css({ "background-position": "top" });
					jQuery(this).css({ "background-position": "bottom" });

					tooltip.removeClass('visible'); arrow.removeClass('visible');
					jQuery(this).siblings('.tooltip, .arrow-down').addClass('visible');
				});

				tooltip.click(function(){
					jQuery(this).removeClass('visible');
					jQuery(this).siblings('.arrow-down').removeClass('visible');
					jQuery(this).siblings('.icon').css({
						"background-position": "top"
					});
				});

				target.unbind('mouseenter');
				target.unbind('mouseleave');
			}

			if (desktop) {
				jQuery('.pull-left').removeClass('pull-left');
				target.css({"background-position" : "top"})
				tooltip.removeClass('visible');
				arrow.removeClass('visible');
				target.bind('mouseenter', function(){
					jQuery(this).siblings('.tooltip, .arrow-down').addClass('visible');
					jQuery(this).css({"background-position" : "bottom"});

					var removeTooltip = function(){ tooltip.removeClass('visible'); arrow.removeClass('visible'); };
					target.bind( 'mouseleave', removeTooltip );
					target.bind( 'mouseleave', function(){
						jQuery(this).css({"background-position" : "top"});
					});
				});
			}

		}

		$window.on("resize", tooltipInit);
	    jQuery(document).on("ready", tooltipInit);

	})();

	//ANIMATIONS
	jQuery('.animated').appear();

	var $html = jQuery( 'html' );

	jQuery( document.body ).on('appear', '.fade', function() {
		if ( ! $html.hasClass( 'desktop' ) ) return;
		jQuery(this).each(function(){ jQuery(this).addClass('ae-animation-fade') });
	}).on('appear', '.slide', function() {
		if ( ! $html.hasClass( 'desktop' ) ) return;
		jQuery(this).each(function(){ jQuery(this).addClass('ae-animation-slide') });
	}).on('appear', '.hatch', function() {
		if ( ! $html.hasClass( 'desktop' ) ) return;
		jQuery(this).each(function(){ jQuery(this).addClass('ae-animation-hatch') });
	}).on('appear', '.entrance', function() {
		if ( ! $html.hasClass( 'desktop' ) ) return;
		jQuery(this).each(function(){ jQuery(this).addClass('ae-animation-entrance') });
	});

	//TIMER
	jQuery('.timer').appear();
	jQuery(document.body).on('appear', '.timer', function() {
		jQuery(this).countTo();
	});

	jQuery(document.body).on('disappear', '.timer', function() {
		jQuery(this).removeClass('timer');
	});

	//QUOTES
	jQuery('.bxslider').each( function() {

		var $this = jQuery( this ),
			$section = $this.closest( 'section' );

		$this.bxSlider({
			mode: 'fade',
			touchEnabled: true,
			oneToOneTouch: true,
			pagerCustom: $section.find( '.id-bx-pager' ),
			nextSelector: $section.find( '.id-bx-next' ),
			prevSelector: $section.find( '.id-bx-prev' ),
			nextText: 'next',
			prevText: 'prev'
		});

	});

	//CONTACT-FORM
	jQuery('#contact-open').click(function (e) {
		e.preventDefault();
		if ( jQuery('#contact-form').is(':hidden') ) {
			jQuery('#contact-form').show();
			jQuery('html, body').animate({ 
				scrollTop: jQuery('#contact-form').offset().top 
			}, 1000);
			/*
			jQuery('#contact-form').slideDown(200,function () {
				console.log(jQuery('#contact-form').offset().top);
				return;
				jQuery('html, body').animate({ 
					scrollTop: jQuery('#contact-form').offset().top 
				}, 1000);
			});
			 */
			
		} else {
			jQuery('#contact-form').slideUp();
		}
	});

	//PARALLAX EFFECTS
	$window.load( function() {

		jQuery('.desktop .parallax').not(".parallax-disabled").each( function() {

			var $this = jQuery( this ),
				image = $this.css( 'background-image' ).replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, '');

			$this.parallax({ imageSrc: image });

			$this
				.closest( '.slider-cover' )
					.addClass( 'has-parallax' )
					.end()
				.css({
					'background-color': 'transparent',
					'background-image': ''
				});

		});

		$window.resize().scroll();

		setTimeout( function() {

			$window.resize().scroll();

		}, 100);

	});

	//PORTFOLIO FILTER
	jQuery(function(){
		jQuery('.projectlist').each( function() {

			var $this = jQuery( this );

			$this.mixitup({
				effects        : ['fade','scale','rotateX'],
				easing         : 'snap',
				filterSelector : $this.closest( 'section') .find( '.filter' )
			});

		});
	});

	//RESPONSIVE VIDEO
	jQuery(".container").fitVids();
	
	//BLOG SLIDER
	jQuery(".gallery.clearfix").each( function() {
		jQuery(this).bxSlider({
			pager: false,
			nextSelector: jQuery(this).closest( '.post-media' ).children( ".gallery-next" ),
			prevSelector: jQuery(this).closest( '.post-media' ).children( ".gallery-prev" ),
			nextText: "next",
			prevText: "prev"
		});
	});
	
	// test this
	jQuery("li.bx-clone img[src^='data:image']").peLazyLoading();

	//FULLSCREEN SLIDER CONTROLS
	jQuery('#vegas-next').click(function(){
		jQuery.vegas('next');

		return false;
	});
	jQuery('#vegas-prev').click(function(){
		jQuery.vegas('previous');

		return false;
	});

	//FULLSCREEN VIDEO
	jQuery(function() {
		if ( jQuery( '.hero-video' ).length === 0 ) return;
		
		var ua = navigator.userAgent.toLowerCase();
		var iDev = ua.match(/(iphone|ipod|ipad)/) !== null;
		var android = !iDev && ua.match(/android ([^;]+)/);
		var mobile = (iDev || android || ua.match(/(android|blackberry|webOS|opera mobi)/) !== null) || $window.width() < 960;


		var videomp4 = jQuery( '.hero-video' ).data( 'video' ),
			videoogv = videomp4.replace( '.mp4', '.ogv' ),
	  mobilejpg = videomp4.replace( '.mp4', '.jpg' );
		
	    var BV = new jQuery.BigVideo({useFlashForFirefox:false});
	    if ( mobile ) {
			jQuery('.hero-video').css("background","url('"+mobilejpg+"')");
		} else {
			BV.init();
	    	BV.show(videomp4,{altSource:videoogv, ambient:true});
		}
	});
};

function initializePortfolio() {

	var $window = jQuery( window );

	"use strict";

	var current,
		next, 
		prev,
		target, 
		hash,
		url,
		page,
		title,	  	  	  
		projectIndex,
		scrollPostition,
		projectLength,
		ajaxLoading = false,
		wrapperHeight,
		pageRefresh = true,
		content =false,
		correction = 30,
		headerH = jQuery('.logo').height()+correction,
		portfolioGrid = jQuery('.projectlist'),
		easing = 'easeOutExpo',
		folderName ='projects';

		jQuery('.project-navigation ul').hide();
		jQuery('.closeProject a').hide();

	jQuery('.projectlist').on( 'click', '.project a', function(e) {

		if ( jQuery( this ).closest( '.project' ).hasClass( 'doajax' ) ) {
			window.location.hash = ("!/" + jQuery(this).attr("data-slug"));
			e.preventDefault();

			portfolioGrid = jQuery( this ).closest( '.projectlist' );

			var $portfolio = portfolioGrid.closest( '.portfolio' );

			url = jQuery( this ).attr( 'href' );

			portfolioGrid.find('.project.current').children().removeClass('active');
			portfolioGrid.find('.project.current').removeClass('current');
			$portfolio.find('.projectlist.active-folio').removeClass('active-folio');
			$portfolio.find('.ajax-content.active-ajax, .project-navigation.active-ajax, .closeProject.active-ajax, .loader.active-ajax').removeClass('active-ajax');

			portfolioGrid.find('.project a[href="' + url + '"]' ).parent().addClass( 'current' );
		 	portfolioGrid.find('.project.current').find('a[href="' + url + '"]').addClass('active');

		 	portfolioGrid.find('.project a[href="' + url + '"]' ).parents('.projectlist').addClass( 'active-folio' );
		 	portfolioGrid.siblings('.ajax-section').children('.ajax-content, .project-navigation, .closeProject, .loader').addClass('active-ajax');

		 	var projectContainer = $portfolio.find('.ajax-content.active-ajax');
		 	var loader = $portfolio.find('.loader.active-ajax');
		 	var projectNav = $portfolio.find('.project-navigation.active-ajax ul');
		 	var exitProject = $portfolio.find('.closeProject.active-ajax a');
			
			var done = false;
			jQuery('html,body').stop().animate({scrollTop: (projectContainer.offset().top-headerH)+'px'},800,'easeOutExpo', function(){
			if (done) {
				return;
			}
			done = true;
																																
			if(content == false){						
				loadProject( $portfolio );							
			}else{	
				projectContainer.animate({opacity:0,height:wrapperHeight},function(){
					loadProject( $portfolio );
				});
			}
					
			projectNav.fadeOut('100');
			exitProject.fadeOut('100');
					
			});
		}

	});

	function loadProject( $portfolio ){

		var loader = $portfolio.find('.loader.active-ajax');

		loader.show().removeClass('projectError').html('');

		if(!ajaxLoading) {				
			ajaxLoading = true;

			var projectContainer = $portfolio.find('.ajax-content.active-ajax');

			projectContainer.load( url +' div#ajaxpage', function(xhr, statusText, request){

				if(statusText == "success"){				

				ajaxLoading = false;

				page = projectContainer.children().first();
					
				page.find("img[data-original]:not(img.pe-lazyload-inited)").peLazyLoading();

				setTimeout( function() {

					page.find("img[data-original]:not(img.pe-lazyload-inited)").peLazyLoading();

					$window.scroll().resize();

				}, 1500 );

				$portfolio.find('.accordion').each(function(){
					var acc = jQuery(this).attr("rel") * 2;
					jQuery(this).find('.accordion-inner:nth-child(' + acc + ')').show();
					jQuery(this).find('.accordion-inner:nth-child(' + acc + ')').prev().addClass("active");
				});

				$portfolio.find('.accordion .accordion-title').click(function() {
					if(jQuery(this).next().is(':hidden')) {
						jQuery(this).parent().find('.accordion-title').removeClass('active').next().slideUp(200);
						jQuery(this).toggleClass('active').next().slideDown(200);
					}
				return false;
				});

				$portfolio.find( '.tabs' ).not( '.tabs-init' ).each( function() {

					var $this = jQuery( this );

					$this.addClass( '.tabs-init' );

					$this
						.find( 'div' )
							.hide()
							.end()
						.find( 'div:first' )
							.show()
							.end()
						.find( 'ul li:first' )
							.addClass('active');

					$this
						.find( 'ul li a' )
							.click( function(){

								var $_this = jQuery( this );

								$this.find( 'ul li' ).removeClass('active');

								$_this.parent().addClass('active');

								var currentTab = $_this.attr('href');

								$this.find( 'div' ).hide();

								jQuery( currentTab ).show();

								return false;

							});

				});
					
				$portfolio.find('.slider').bxSlider({
					mode: 'horizontal',
					touchEnabled: true,
					swipeThreshold: 50,
					oneToOneTouch: true,
					pagerSelector: page.find( '.slider-pager' ),
					nextSelector: page.find( '.project-gallery-next' ),
					prevSelector: page.find( '.project-gallery-prev' ),
					nextText: page.find( '.project-gallery-next a' ).text(),
					prevText: page.find( '.project-gallery-prev a' ).text(),
					tickerHover: true
				});
					
				// test this
				$portfolio.find("li.bx-clone img[src^='data:image']").addClass("pe-lazyloading-forceload").peLazyLoading();
				$window.trigger("pe-lazyloading-refresh");

				page.waitForImages(function() {
					hideLoader( $portfolio, page );  
				});

				$portfolio.find(".container").fitVids();

				}

			});

		}
			
	}

	function hideLoader( $portfolio, page ){
		var loader = $portfolio.find('.loader.active-ajax');

		loader.delay(400).fadeOut( function(){

			showProject( $portfolio, page );

		});			 
	}

	function showProject( $portfolio, page ){

		var projectContainer = $portfolio.find('.ajax-content.active-ajax');
		var projectNav = $portfolio.find('.project-navigation.active-ajax ul');
		var exitProject = $portfolio.find('.closeProject.active-ajax a');

		wrapperHeight = page.outerHeight()+'px';
		
		if(content==false){

			wrapperHeight = page.outerHeight()+'px';

			projectContainer.animate({opacity:1,height:wrapperHeight}, function(){
				$portfolio.find(".container").fitVids();
				scrollPostition = jQuery('html,body').scrollTop();
				projectNav.fadeIn();
				exitProject.fadeIn();
				content = true;	

				$window.resize();

			});

		} else {
			wrapperHeight = page.outerHeight()+'px';

			projectContainer.animate({opacity:1,height:wrapperHeight}, function(){
				$portfolio.find(".container").fitVids();																		  
				scrollPostition = jQuery('html,body').scrollTop();
				projectNav.fadeIn();
				exitProject.fadeIn();

				$window.resize();

			});					
		}


		projectIndex = $portfolio.find('.project.current').index();
		projectLength = $portfolio.find('.project a').length-1;


		if(projectIndex == projectLength){

			$portfolio.find('.nextProject a').addClass('disabled');
			$portfolio.find('.prevProject a').removeClass('disabled');

		} else if(projectIndex == 0) {

			$portfolio.find('.prevProject a').addClass('disabled');
			$portfolio.find('.nextProject a').removeClass('disabled');

		} else {

			$portfolio.find('.nextProject a, .prevProject a').removeClass('disabled');

		}

		setTimeout( function() {

			page.find("img[data-original]:not(img.pe-lazyload-inited)").peLazyLoading();

			$window.scroll().resize();

		}, 1500 );
	
  	}

  	function deleteProject( closeURL, $portfolio ){

  		var projectContainer = $portfolio.find('.ajax-content.active-ajax');
  		var projectNav = $portfolio.find('.project-navigation.active-ajax ul');
  		var exitProject = $portfolio.find('.closeProject.active-ajax a');

		projectNav.fadeOut();
		exitProject.fadeOut();

		if(typeof closeURL!='undefined' && closeURL!='') {
			window.location.hash = '#_';
		}

		projectContainer.animate({opacity:0,height:'0px'},800,'easeOutExpo');
		projectContainer.empty();
		jQuery('html,body').stop().animate({
			scrollTop: (projectContainer.offset().top-headerH-100)+'px'},600
		);

		$portfolio.find('.projectlist.active-folio').removeClass('active-folio');
		$portfolio.find('.ajax-content.active-ajax, .project-navigation.active-ajax, .closeProject.active-ajax').removeClass('active-ajax');
		$portfolio.find('.project.current').children().removeClass('active');
		$portfolio.find('.project.current').removeClass('current');

		setTimeout( function() {

			$window.trigger( 'resize' ).trigger( 'scroll' );

		}, 800);

		setTimeout( function() {

			$window.trigger( 'resize' ).trigger( 'scroll' );

		}, 1000);
 	}

 	jQuery('.nextProject a').on('click',function (e) {

 		e.preventDefault();

 		var $portfolio = jQuery( this ).closest( '.portfolio' );

		current = $portfolio.find('.project.current');
		next = current.nextAll('.project.doajax').first();

		target = jQuery(next).children('a');
		

		if (next.length === 0) { 
			return false;			  
		} 

		current.removeClass('current'); 
		current.children().removeClass('active');
		next.addClass('current');
		next.children().addClass('active');

		jQuery(target).click();
	   
	});

	jQuery('.prevProject a').on('click',function (e) {

		e.preventDefault();

		var $portfolio = jQuery( this ).closest( '.portfolio' );

		current = $portfolio.find('.project.current');
		prev = current.prevAll('.project.doajax').first();

		target = jQuery(prev).children('a');
		

		if (prev.length === 0) { 
			return false;			  
		} 

		current.removeClass('current'); 
		current.children().removeClass('active');
		prev.addClass('current');
		prev.children().addClass('active');

		jQuery(target).click();

	});

	jQuery('.closeProject a').on('click',function () {

		var $portfolio = jQuery( this ).closest( '.portfolio' );

		var loader = $portfolio.find('.loader.active-ajax'); 
							
		deleteProject(jQuery(this).attr('href'), $portfolio);					
		
		$portfolio.find('.project.current').children().removeClass('active');
		loader.fadeOut();

		return false;
	});

	pageRefresh = false;
};
/* END ------------------------------------------------------- */


/* =Window Load Trigger
-------------------------------------------------------------- */
jQuery( window ).load(function(){

	var $window = jQuery( window );

	$window.trigger( 'hashchange' );
	$window.trigger( 'resize' );
	var p = window.location.hash.match(/\/(.+)/);
	if (p && p[1]) {
		jQuery("a[data-slug='"+p[1]+"']").trigger("click");
	}
  	jQuery('[data-spy="scroll"]').each(function () {
    	var $spy = $(this).scrollspy('refresh');
	});

});
/* END ------------------------------------------------------- */


/* =Document Ready Trigger
-------------------------------------------------------------- */
jQuery(document).ready(function(){

	initializeVisia();
	initializePortfolio();

});
/* END ------------------------------------------------------- */
