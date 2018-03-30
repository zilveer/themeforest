/* ====== INTERNAL FUNCTIONS ====== */

/* --- NICESCROLL --- */
function niceScrollInit() {
	if (globalDebug) {console.log("NiceScroll Init");}

	var smoothScroll = $('body').data('smoothscrolling') !== undefined;

	if (smoothScroll && ww > 899 && !touch && !is_OSX) {
		$('html').addClass('nicescroll');
		$('[data-smoothscrolling]').niceScroll({
			zindex: 9999,
			cursorcolor: '#000000',
			cursoropacitymin: 0.1,
			cursoropacitymax: 0.5,
			cursorwidth: 4,
			cursorborder: 0,
			railpadding: { right : 2 },
			mousescrollstep: 40,
			scrollspeed: 100,
			hidecursordelay: 100
		});
	}

}

function scrollToTopInit() {
	if (!empty($('.up-link'))) {
		if (globalDebug) {console.log("ScrollToTop Init");}

		var offset = 220,
			duration = 500;

		$(window).scroll(function() {
			if ($(this).scrollTop() > offset) {
				$('.up-link').fadeIn(duration);
			} else {
				$('.up-link').fadeOut(duration);
			}
		});

		$('.up-link a').click(function(e) {
			e.preventDefault();
			$('html, body').animate({scrollTop: 0}, duration);
			return false;
		});
	}
}

function menuTrigger(){
	$(document).on('click', '.js-nav-trigger', function(e) {
		var windowHeigth = $(window).height();

		e.preventDefault();
		e.stopPropagation();

		if($('html').hasClass('navigation--is-visible')){
			$('#page').css('height', '');
			$('html').removeClass('navigation--is-visible');
		} else {
			$('#page').height(windowHeigth);
			$('html').addClass('navigation--is-visible');
		}
	});
}

// Menu Hover with delay
function menusHover() {
  $('.menu-item-has-children').hoverIntent({
	interval: 0,
	timeout: 300,
	over: showMenu,
	out: hideMenu
  })

  function showMenu() {
	var self = $(this);
	self.removeClass('hidden');
	setTimeout(function(){
	  self.addClass('open');

		//if( !self.hasClass('.sub-menu')) {
			var $subMenu = self.find('> .sub-menu');

			var remainingHeight = wh - self.offset().top;

			if( remainingHeight < $subMenu.height() ) {
				$subMenu.addClass('big-one');
			}
		//}
	}, 150);
  }
  function hideMenu() {
	var self = $(this);
	self.removeClass('open');
	setTimeout(function(){
	  self.addClass('hidden');
	}, 150);
  }
}

/* --- Progressbar Init --- */
function progressbarInit() {
	if (globalDebug) {console.log("ProgressBar Init");}

	var progressbar_shc = $('.progressbar');

	progressbar_shc.addClass('is-visible');
	if (progressbar_shc.length) {
		progressbar_shc.each(function() {
			var self = $(this).find('.progressbar__progress');
			self.css({'width': self.data('value')});
		});
	}
}


/* --- $VIDEOS --- */

function initVideos() {

    var videos = $('iframe:not(.twitter-tweet), video');

    // Figure out and save aspect ratio for each video
    videos.each(function() {
        $(this).data('aspectRatio', this.width / this.height)
            // and remove the hard coded width/height
            .removeAttr('height')
            .removeAttr('width');
    });

    // Firefox Opacity Video Hack
    //$('iframe').each(function(){
		//var url = $(this).attr("src");
	    //if ( !empty(url) )
			//$(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
	//});
}


function resizeVideos() {
    
    var videos = $('iframe:not(.twitter-tweet), video');

    videos.each(function() {
        var video = $(this),
            ratio = video.data('aspectRatio'),
            w = video.css('width', '100%').width(),
            h = w/ratio;
        video.height(h); 
    });
}

function containerPlacement() {
	var $stickyHeader = $('.js-sticky');

	var containerPadding = parseInt($('.js-container').css('padding-top'), 10);
	var newPadding = $stickyHeader.height();

	if( newPadding > containerPadding ) {
		$('.js-container').css('padding-top', $stickyHeader.height() + 'px');
	}

	$stickyHeader.addClass('is--fixed');
}

function stickyHeader(){

	var	$header = $('.site-header__wrapper'),
		stickyHeight = $('.js-sticky').height();

	$(window).scroll(function() {
	    if ( $(window).scrollTop() > stickyHeight + 150){
	    	if(!$('body').hasClass('header--small')){
	    		$('body').addClass('header--small');
	    	}
	    } else {
			//containerPlacement();
	        $('body').removeClass('header--small');
	    }

	});

	if($('body').hasClass('nav-scroll-hide')){
		$header.hoverIntent({
			interval: 0,
			timeout: 300,
			over: function(){
				$header.addClass('header--active');
				setTimeout(function(){
					$header.addClass('visible');
				}, 200);
			},
			out: function(){
				$header.removeClass('visible');
				$header.removeClass('header--active');
				setTimeout(function(){
				}, 200);
			}
		});
	}
}

function searchTrigger(){
	$(document).on('click', '.js-search-trigger', function(event){
		event.preventDefault();

		$('body').addClass('is--active-search');
		$('.js-search-input').focus();
	});

	$(document).on('click', '.js-search-close', function(){
		$('body').removeClass('is--active-search');
	});

	$(document).keyup(function(e) {
		if (e.keyCode == 27  &&  $('body').hasClass('is--active-search') ) {
		$('body').removeClass('is--active-search');
		} // esc
	});
}

function sidebarHeight(){
	if(ww > 899){
		var $sidebar = $('aside.sidebar--main');
		var $pageContent = $('.page-content');
		
		if($sidebar.height() <= $pageContent.height()){
			$sidebar.css('min-height', $sidebar.parent().height() + 'px');
		}
		else{
			$sidebar.css('min-height', '');
		}
	}
}


/* ====== INTERNAL FUNCTIONS END ====== */

function init(){
	if (globalDebug) {console.group("Init");}

	// /* GLOBAL VARS */
	touch = false;

	//  GET BROWSER DIMENSIONS
	browserSize();

	// /* DETECT PLATFORM */
	platformDetect();

	loadAddThisScript();

	if (is_android || window.opera) {
		$('html').addClass('android-browser').removeClass('no-android-browser');
	}

	$('html').addClass('loaded');
	stickyHeader();

	/* ONE TIME EVENT HANDLERS */
	eventHandlersOnce();

	/* INSTANTIATE EVENT HANDLERS */
	eventHandlers();

	if( $('.site-logo--image img').length ) {
		// Make sure to place the content after the header image has been loaded
		// http://stackoverflow.com/questions/3877027/jquery-callback-on-image-load-even-when-the-image-is-cached#answer-3877079
		$(".site-logo--image img").one("load", function() {
			containerPlacement();
		}).each( function() {
			if(this.complete) $(this).load();
		});
	} else {
		containerPlacement();
	}

	if (globalDebug) {console.groupEnd();}
}


/* ====== CONDITIONAL LOADING ====== */

function loadUp(){
	if (globalDebug) {console.group("LoadUp");}

	// always
	niceScrollInit();

	royalSliderInit();

	isotopeInit();

	if($(".classic-infinitescroll-wrapper").length) classicInfiniteScrollingInit($(".classic-infinitescroll-wrapper"));

	progressbarInit();
	menusHover();


	magnificPopupInit();

	initVideos();
	resizeVideos();

	searchTrigger();
	// sidebarHeight();

	//Set textarea from contact page to autoresize
	if($("textarea").length) { $("textarea").autosize(); }

	$(".pixcode--tabs").organicTabs();

	if (globalDebug) {console.groupEnd();}
}


/* ====== EVENT HANDLERS ====== */

function eventHandlersOnce() {
	if (globalDebug) {console.group("Event Handlers Once");}

	menuTrigger();

	if (globalDebug) {console.groupEnd();}
}

function eventHandlers() {
	if (globalDebug) {console.group("Event Handlers");}


	//Magnific Popup arrows
	$('body').off('click', '.js-arrow-popup-prev', magnificPrev).on('click', '.js-arrow-popup-prev', magnificPrev);
	$('body').off('click', '.js-arrow-popup-next', magnificNext).on('click', '.js-arrow-popup-next', magnificNext);

	// if ( typeof woocommerce_scripts_load == 'function') {
	// 	woocommerce_scripts_load();
	// }

	if (globalDebug) {console.groupEnd();}
}


/* --- GLOBAL EVENT HANDLERS --- */

function magnificPrev(e) {
	if (globalDebug) {console.log("Magnific Popup Prev");}

	e.preventDefault();
	var magnificPopup = $.magnificPopup.instance;
	magnificPopup.prev();
	return false;
}

function magnificNext(e) {
	if (globalDebug) {console.log("Magnific Popup Next");}

	e.preventDefault();
	var magnificPopup = $.magnificPopup.instance;
	magnificPopup.next();
	return false;
}


/* ====== ON DOCUMENT READY ====== */

$(document).ready(function(){

	if (globalDebug) {console.group("OnDocumentReady");}

	/* --- INITIALIZE --- */
	init();
	loadUp();

	if (globalDebug) {console.groupEnd();}
});


/* ====== ON WINDOW LOAD ====== */

$(window).load(function(){
	if (globalDebug) {console.group("OnWindowLoad");}

	//if we have twitter widgets then we need to update the layout once they are loaded
	if ( typeof twttr != "undefined" ) {
		twttr.ready(
			function (twttr) {
				// bind events here
				twttr.events.bind(
					'loaded',
					function( event ) {
						if ( globalDebug ) {console.log( "Twitter API - Loaded" );}

						isotopeUpdateLayout();
					}
				);
			}
		);
	} else {
		isotopeUpdateLayout();
	}

	$('.pixcode--tabs').organicTabs();

});

/* ====== ON RESIZE ====== */

$(window).on("debouncedresize", function(e){
	if (globalDebug) {console.group("OnResize");}

	royalSliderInit();
	niceScrollInit();
	resizeVideos();
	isotopeUpdateLayout();
	containerPlacement();

	if (globalDebug) {console.groupEnd();}
});
