/*!
 * Masonry
 * We use the same script for all post types that uses masonry
 */
var WolfThemeParams =  WolfThemeParams || {},
	WolfThemeUi = WolfThemeUi || {},
	WolfThemeMasonry = WolfThemeMasonry || {},
	WolfThemeLikesViews = WolfThemeLikesViews || {},
	console = console || {};

/* jshint -W062 */
WolfThemeMasonry = function ( $ ) {

	'use strict';

	return {

		winHeight : $( window ).height(),
		extraScrollPx : 2000,
		clock : 0,
		timer : null,
		resizeTime : null,
		resizeClock : 0,

		/**
		 * Init blog
		 */
		init : function () {
			
			var _this = this;

			if ( $( 'body' ).hasClass( 'masonry' ) ) {
				this.masonry();
				this.resizeTimer();
			}

			if ( $( 'body' ).hasClass( this.getPostType() + '-infinite-scroll' ) ) {

				this.infiniteScroll();
			}

			// Resize event
			$( window ).resize( function() {

				_this.winHeight = $( window ).height();

			} ).resize();
		},

		/**
		 * Trigger isotope layout on load for elements fired after the whole page
		 */
		resizeTimer : function () {

			var _this = this,
				$container = $( 'body.masonry #' + this.getPostType() + 's-content' );

			_this.resizeTime = setInterval( function() {
				_this.resizeClock++;

				$container.isotope( 'layout' );

				if ( _this.resizeClock === 3 ) {
					_this.clearResizeTime();
				}
				// console.log( _this.resizeClock );
			}, 2000 );
		},

		/**
		 * Clear resize time
		 */
		clearResizeTime : function () {
			clearInterval( this.resizeTime );
		},

		/**
		 * masonry
		 */
		masonry : function () {
			var _this = this,
				$container = $( 'body.masonry #' + this.getPostType() + 's-content' ),
				OptionFilter = $( '#' + this.getPostType() + '-filter' ),
				OptionFilterLinks = OptionFilter.find( 'a' ),
				selector, layoutMode = 'masonry';

			//$container.addClass( this.getPostType() );

			if ( 'post' !== this.getPostType() && $( 'body' ).hasClass( this.getPostType() + '-isotope' ) ) {

				OptionFilterLinks.click( function() {

					selector = $( this ).attr( 'data-filter' );
					OptionFilterLinks.attr( 'href', '#' );
					
					$container.isotope( {
						filter : '.' + selector,
						itemSelector : '.' + _this.getPostType() + '-item-container',
						animationEngine : 'best-available'
					} );

					OptionFilterLinks.removeClass( 'active' );
					$( this ).addClass( 'active' );
					return false;
				} );
			}

			if ( 'masonry-horizontal' === WolfThemeParams.workType && 'work' === this.getPostType() ) {

				layoutMode = 'packery';
			}

			$container.imagesLoaded( function() {
				$container.isotope( {
					itemSelector : '.' + _this.getPostType() + '-item-container',
					animationEngine : 'none',
					layoutMode: layoutMode
				} );
			} );
		},

		/**
		 * Infinite Scroll
		 */
		infiniteScroll : function () {

			var  _this = this,
				$container = $( '#' + this.getPostType() + 's-content' ),
				i = 1, // pagination
				$trigger = $( '#' + this.getPostType() + '-trigger' ),
				$button = $( '#' + this.getPostType() + '-trigger a' );

			$container.isotope( {
				itemSelector : '.' + this.getPostType() + '-item-container'
			} );

			if ( ! WolfThemeParams.currentPostType.trigger ) {
				$container.infinitescroll( {
					navSelector  : '.nav-previous',
					nextSelector : '.nav-previous a',
					itemSelector : '.' + _this.getPostType() + '-item-container',
					loading: {
						finishedMsg: WolfThemeParams.infiniteScrollEndMsg,
						msgText : WolfThemeParams.infiniteScrollMsg,
						img: WolfThemeParams.infiniteScrollEmptyLoad,
						extraScrollPx: _this.extraScrollPx
					}
				}, function( newElements ) { // call Isotope as a callback

					var $newElems = $( newElements ).css( { opacity: 0 } );
					
					$newElems.imagesLoaded( function() {
						
						_this.callBack( $newElems );
				
						$container.isotope( 'appended', $newElems );
						
						$newElems.animate( { opacity: 1 } );
						_this.resizeTimer();
					} );
				} );
			} else {
				$button.html( WolfThemeParams.loadMoreMsg );

				$trigger.find( 'a' ).on( 'click', function(event) {
					event.preventDefault();
				} );
				
				$trigger.on('click', function()  {
					
					var link = $( this ).find( 'a' ).attr('href'),
						$content = '.item-grid',
						$anchor = '#' + _this.getPostType() + '-trigger a',
						$next_href = $( $anchor ).attr( 'href' ),
						$newElems;

					if ( $( this ).hasClass( 'trigger-loading' ) ) {
						return false;
					}

					$( this ).addClass( 'trigger-loading' );
					$button.html( WolfThemeParams.infiniteScrollMsg );
					
					$.get( link + '' , function( data ) {
						
						var newElements = $( $content, data ).wrapInner( '' ).html();
						$next_href = $( $anchor, data ).attr( 'href' );

						$newElems = $( newElements ).css( { opacity: 0 } );
					
						$container.append( $newElems ).isotope( 'reloadItems' ).isotope( { sortBy: 'original-order' } );
						
						_this.callBack( $newElems );
						
						setTimeout( function() {
							$container.isotope( 'layout' );
							$newElems.animate( { opacity: 1 } );
							_this.resizeTimer();
							$trigger.removeClass( 'trigger-loading' );
							$button.html( WolfThemeParams.loadMoreMsg );
						}, 400 );

						if ( $trigger.data( 'max' ) > i ) {
							
							$button.attr( 'href', $next_href ); // Change the next URL
						} else {
							
							$trigger.remove();
						}
					} );
					i++;
				} );
			}
		},

		/**
		 * Refresh everything after posts load
		 */
		callBack : function ( $newElems ) {
			WolfThemeUi.fluidVideos( $newElems );
			WolfThemeUi.youtubeWmode();
			WolfThemeUi.removeVimeoTitle();
			WolfThemeUi.flexSlider();
			WolfThemeUi.lightbox();
			WolfThemeLikesViews.likes();
			WolfThemeUi.videoGridHoverEffect();
			WolfThemeUi.videoShortcode();

			if ( $newElems.find( '.twitter-tweet' ).length ) {
				$.getScript( 'http://platform.twitter.com/widgets.js' );
			}

			if ( $newElems.find( 'audio,video' ).length ) {
				$newElems.find( 'audio,video' ).mediaelementplayer();
			}

			WolfThemeUi.loadInstagram();
			WolfThemeUi.loadTwitter();
		},

		/**
		 * Get the current post type slug from theme global variables
		 */
		getPostType : function () {
			return WolfThemeParams.currentPostType.postType;
		}
	};

}( jQuery );


;( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfThemeMasonry.init();
	} );
	
} )( jQuery );