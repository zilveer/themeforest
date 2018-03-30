/*!
 * Likes and views
 *
 */
/* jshint -W062 */
var WolfThemeLikesViews =  WolfThemeLikesViews || {},
	WolfThemeParams =  WolfThemeParams || {},
	WolfThemeUi =  WolfThemeUi || {},
	console =  console || {};

WolfThemeLikesViews = function( $ ) {

	'use strict';

	return {

		init : function () {
			this.views();
			this.likes();
			this.shares();
		},

		/**
		 * Views feature
		 */
		views : function () {

			var $item = $( '.single-work .work, .single .post, .single-video .video' ),
				itemId = $item.data( 'post-id' ),
				data = {
					action: 'wolf_view_ajax',
					id : itemId
				};

			if ( $( 'body' ).hasClass( 'single-work' ) || $( 'body' ).hasClass( 'single' ) ) {
				$.post( WolfThemeParams.ajaxUrl , data, function( response ) {
					console.log( response );
				} );
			}
		},

		/**
		 * Likes feature
		 */
		likes : function () {

			var item = '.work-item-container, .post, .video, .modern-item, .plugin, .theme, .work',
				$item = $( item ),
				postId, loader, $container, nbContainer, data, $this;

			$item.each( function () {
				if ( $.cookie( 'likes-' +  $( this ).data( 'post-id' ) ) ) {
					$( this ).find( '.item-like' ).addClass( 'liked' );
				}
			} );
			
			$item.on( 'click', '.item-like', function() {
				
				$container = $( this ).parents( '[data-post-id]' );
				postId = $container.data( 'post-id' );

				$this = $( this );
				
				if ( $this.hasClass( 'liked' ) || $.cookie( 'likes-' + postId ) ) {
					
					return;
					
				} else {
					loader = '';
					nbContainer = $container.find( '.item-likes-count' );
					data = {
						action: 'wolf_like_ajax',
						id: postId
					};
					
					$.post( WolfThemeParams.ajaxUrl, data, function( response ) {
						// console.log( postId );
						nbContainer.empty().html( response );
						$this.addClass( 'liked' );
						$.cookie( 'likes-' + postId, 'liked', { path: '/', expires: 5 } );
					} );
				}

				return false;
			} );
		},

		/**
		 * Likes feature
		 */
		shares : function () {

			$( '.share-link, .share-link-video' ).click( function() {

				var $this = $( this ),
					postId, loader, $container, nbContainer, data,
					url = $this.attr( 'href' ),
					height = $this.data( 'height' ) || 250,
					width = $this.data( 'width' ) || 500,
					popup = window.open( url,'null', 'height=' + height + ',width=' + width + ', top=150, left=150' );

				$container = $( this ).parents( 'article' );
				postId = $container.data( 'post-id' );
				
				loader = '';
				nbContainer = $container.find( '.item-shares-count' );
				data = {
					action: 'wolf_share_ajax',
					id: postId
				};
				
				$.post( WolfThemeParams.ajaxUrl, data, function( response ) {
					console.log( response );
					nbContainer.empty().html( response );
				} );

				if ( $( this ).data( 'popup' ) === true && ! WolfThemeUi.isMobile ){
					
					if ( window.focus ) {
						popup.focus();
					}
					return false;
				}
			} );
		}
	};

}( jQuery );

;( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfThemeLikesViews.init();
	} );

} )( jQuery );