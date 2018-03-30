jQuery.noConflict();

/*
TABLE OF CONTENTS:
-------------------------------------
1 - SIDEBAR
2 - HEADER HEIGHT ADJUSTER
3 - SCREEN HEIGHT ADJUSTER
4 - SHOW POST TITLE IN HEADER / FADE POST TITLE
5 - NANO SCROLLER
6 - FITVID
7 - READ MORE BUTTON
8 - POST TILE LINKING
9 - WOOKMARK (A better Masonry)
10 - INFINITE SCROLL
*/

jQuery(document).ready(function(){

	/*-----------------------------------------------*/
	/*- Setup screen target element according to browser --*/
	/*---------------------------------------------*/

	if(jQuery.browser.msie || jQuery.browser.mozilla)
		{Screen = jQuery("html");}
	else
		{Screen = jQuery("body");}


	/*--------------------------------------------*/
	/*- 1- SIDEBAR --------------------------------*/
	/*-------------------------------------------*/

	jQuery("#menu-drop-button").bind("click", function(e){
		jQuery(" #sidebar-container , #wrapper").toggleClass( 'open' );
		e.stopPropagation();
		return false;
	});

	jQuery( "#sidebar-container" ).bind("click", function(e){
		e.stopPropagation();
	});

	jQuery("body").bind("click", function(){
		if( jQuery( "#sidebar-container" ).hasClass("open") ){
			jQuery(" #sidebar-container , #wrapper").removeClass( 'open' );
		}
	});

	/*-------------------------------------------*/
	/* 2 - HEADER HEIGHT ADJUSTER ----------------*/
	/*------------------------------------------*/

	$headerheight = jQuery("#header-container").outerHeight();
	jQuery("#content-container").css( { "paddingTop": $headerheight } );
	jQuery(".sidebar-content").css( { "top": +jQuery("#header-container").outerHeight() } );


	/*-------------------------------------------*/
	/* 3 - SCREEN HEIGHT ADJUSTER ----------------*/
	/*------------------------------------------*/

	jQuery('.has-title-background .title-container').css({ height: jQuery(window).height() - $headerheight });

	jQuery(window).resize(function(){
		jQuery('.has-title-background .title-container').css({ height: jQuery(window).height() - $headerheight });
	});

	/*-----------------------------------------------*/
	/* 4 - SHOW POST TITLE IN HEADER / FADE POST TITLE -*/
	/*---------------------------------------------*/

	if( undefined !== jQuery('.has-title-background .title').css('bottom') ) {
		$post_title_position = jQuery('.has-title-background .title').css('bottom').toString().replace("px", "");
	};
	jQuery(window).scroll(function(){

		var $screen_scrolled = Screen.scrollTop();
		if( $screen_scrolled > +jQuery(".title-container").scrollTop()+jQuery(".title-container").outerHeight() )
			jQuery(".logo small").fadeIn();
		else
			jQuery(".logo small").fadeOut();

		$scroll_diff = ( $screen_scrolled / jQuery(".title-container").outerHeight() ) ;

		if( jQuery( window ).width() > 600 && undefined !== jQuery('.has-title-background .title').css('bottom') ){
			jQuery('.has-title-background .title').css( 'bottom', +$post_title_position+( $post_title_position * ( $scroll_diff * 2 ) ) ); // Move title 2 times percentage of scroll amount
			jQuery('.has-title-background .title').css( 'opacity', ( 1 - ( $scroll_diff * 2 ) ) ); // Fade title 2 times percentage of scroll amount
		};

	});

	jQuery( '.logo small' ).bind( "click" , function(e){
		e.preventDefault();
		Screen.animate({ scrollTop: 0, duration: 750 });
	})

	/*--------------------------------------------*/
	/*- 5 - NANO SCROLLER ------------------------*/
	/*-------------------------------------------*/

	jQuery( ".nano" ).nanoScroller({
		contentClass: 'sidebar-content',
		preventPageScrolling: 'true',

	});

	/*--------------------------------------------*/
	/*- 6 - FITVID ---------------------------------*/
	/*-------------------------------------------*/

	if( !jQuery('body').hasClass('home') ) {
		jQuery(".fitvid").fitVids();
	}

	/*--------------------------------------------*/
	/*- 7 - READ MORE BUTTON ---------------------*/
	/*-------------------------------------------*/

	jQuery(".single .title, .page .title").bind( "click" , function(e){
		$scroll_to = jQuery(".copy").position().top;
		Screen.animate({scrollTop: $scroll_to - 30, duration: 750})
		e.preventDefault();
	});

	// Apply the post tile linking function
	apply_post_tile_links();
});

/*--------------------------------------------*/
/*- 8 - POST LIST TILE LINKING -------------------*/
/*-------------------------------------------*/
function apply_post_tile_links(){
	jQuery(".post-list .book-cover").bind( "click" , function(e){
		if( undefined !== jQuery(this).data( 'href' ) )
			{ window.location = jQuery(this).data( 'href' ); }
	});
}

/*----------------------------------------------*/
/* 9 - WOOKMARK -------------------------------*/
/*---------------------------------------------*/

function applyLayout( $container ){
	if( undefined === $container ) {
		var $container = jQuery( '.post-list .post' );
	}
	$container.find('script').remove();
	$container.wookmark({
		align: 'left',
		autoResize: true, // This will auto-update the layout when the browser window is resized.
		container: jQuery('.post-list'), // Optional, used for some extra CSS styling
		// offset: 16, Optional, the distance between grid items
		flexibleWidth: true, // Optional, the maximum width of a grid item,
		itemWidth: '32.7%'
	});

	jQuery( '.post-list li' ).imagesLoaded( function() { jQuery( 'ul.post-list' ).animate({ opacity: 1.0 }, 750); } );
}

jQuery(window).load(function(){
	if( jQuery( window ).width() > 600 && !jQuery("body").hasClass( 'single' ) && !jQuery("body").hasClass( 'page' ) ){
		jQuery( '.post-list li' ).imagesLoaded( function() { applyLayout(); } );
	} else if( undefined !== jQuery( '.post-list li' ) ) {
		jQuery( 'ul.post-list' ).css('opacity', 1.0);
		if( jQuery( window ).width() > 600 ) {
			jQuery( '.post-list li' ).imagesLoaded( function() { applyLayout(); } );
		}
	} else {
		jQuery( 'ul.post-list' ).css('opacity', 1.0);
	}
});

/*----------------------------------------------*/
/* 10 - INFINITE SCROLL ---------------------------*/
/*---------------------------------------------*/
( function( $ ) {
    jQuery( document.body ).on( 'post-load', function () {
	jQuery( '.post-list li' ).imagesLoaded( function() { applyLayout(); } );
    } );
} )( jQuery );