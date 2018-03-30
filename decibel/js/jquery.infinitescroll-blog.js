/*!
 * Infinite scroll blog
 *
 */

var WolfThemeParams =  WolfThemeParams || {},
	WolfThemeUi = WolfThemeUi || {},
	WolfThemeBlog = WolfThemeBlog || {},
	console = console || {};

/* jshint -W062 */
WolfThemeBlog = function ( $ ) {

	'use strict';

	return {

		extraScrollPx : 2000,

		/**
		 * Init blog
		 */
		init : function () {

			if ( $( 'body' ).hasClass('blog-infinite-scroll') ) {
				
				this.infiniteScroll();
			}
		},

		/**
		 * Infinite Scroll
		 */
		infiniteScroll : function () {

			var  $this = this,
				$container = $('#content');

			$container.infinitescroll( {
				navSelector  : '.nav-previous',
				nextSelector : '.nav-previous a',
				itemSelector : 'article.post',
				loading: {
					finishedMsg: WolfThemeParams.infiniteScrollEndMsg,
					msgText : WolfThemeParams.infiniteScrollMsg,
					img: WolfThemeParams.infiniteScrollEmptyLoad,
					extraScrollPx: $this.extraScrollPx
				}
			// callback
			}, function( newElements ) {
				WolfThemeUi.fluidVideos( $( newElements ) );
				WolfThemeUi.flexSlider();
				WolfThemeUi.lightbox();
				if ( $( newElements ).find( '.twitter-tweet' ).length ) {
					$.getScript( 'http://platform.twitter.com/widgets.js' );
				}
				if ( $( newElements ).find( 'audio,video' ).length ) {
					$( newElements ).find( 'audio,video' ).mediaelementplayer();
				}
			} );
		}
	};

}( jQuery );

;( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfThemeBlog.init();
	} );


} )( jQuery );