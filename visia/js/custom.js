jQuery( document ).ready( function( $ ) {

	if ( $( '.peThemeContactForm' ).length > 0 ) {

		$( '.peThemeContactForm' ).peThemeContactForm();

	}
	
	var contact = false;
	$('nav a[href=#footer]').on("click",function(e) {
		e.preventDefault();
		e.stopImmediatePropagation();
		if (!contact) {
			$("#contact-open").trigger("click");
			contact = true;
		}
	});

	$( '.post-media' ).each( function() {

		if( ! $.trim( $( this ).html() ) )
			$( this ).siblings( '.post-title' ).addClass( 'nopostmedia' );

	});

	$( '.pagination li.disabled a' ).attr( 'href', 'javascript:void(0);' ).css( 'cursor', 'default' );

	jQuery('.slider').bxSlider({
		mode: 'horizontal',
		touchEnabled: true,
		swipeThreshold: 50,
		oneToOneTouch: true,
		pagerSelector: '.slider-pager',
		nextSelector: ".project-gallery-next",
		prevSelector: ".project-gallery-prev",
		nextText: jQuery( '.project-gallery-next a' ).text(),
		prevText: jQuery( '.project-gallery-prev a' ).text(),
		controls: true,
		tickerHover: true
	});

	jQuery(".nav a").click(function () {

		var $href = $( this ).attr( 'href' );

		if ( $href == window.location.href && $href == _visia.home_url && window.location.href == _visia.home_url ) {

			return jQuery("body,html").stop().animate({
				scrollTop: 0
			}, 800, "easeOutCubic"), !1;

		}


	});

});

// Slider homepage
if ( jQuery( '.hidden_overlay' ).length ) {

	var hslides = [];

	jQuery( '.hiddenslide').each( function() {

		var $this = jQuery( this );
		hslides.push( { src: $this.attr('data-src'), fade:2500 } );

	});

	jQuery.vegas('slideshow', {
		backgrounds: hslides
		})('overlay', {
		src:jQuery( '.hidden_overlay' ).data( 'src' )
	});

}