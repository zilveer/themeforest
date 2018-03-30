(function( $ ) {
	'use strict';

	var utils = MK.utils,
		core  = MK.core,
		path  = MK.core.path;

	MK.component.PhotoAlbum = function( el ) {
		this.album = el;
		this.initialOpen = false;
	};


	MK.component.PhotoAlbum.prototype = { 
		dom: {
			gallery 			: '.slick-slider-wrapper',
			title 				: '.slick-title',
			galleryContainer 	: '.slick-slides',
			closeBtn 			: '.slick-close-icon',
			thumbList 			: '.slick-dots',
			thumbs 				: '.slick-dots li',
			imagesData  		: 'photoalbum-images',
			titleData  			: 'photoalbum-title',
			idData  			: 'photoalbum-id',
			urlData  			: 'photoalbum-url',
			activeClass 		: 'is-active'
		},
 
		tpl: {
			gallery: '#tpl-photo-album',
			slide: '<div class="slick-slide"></div>'
		},

		init: function() {  
			this.cacheElements();
			this.bindEvents();
			this.openByLink();
		},

		cacheElements: function() {
			this.$album = $( this.album );
			this.imagesSrc = this.$album.data( this.dom.imagesData );

			this.albumLength = this.imagesSrc.length; 

			this.title = this.$album.data( this.dom.titleData );
			this.id = this.$album.data( this.dom.idData );
			this.url = this.$album.data( this.dom.urlData );

			this.images = []; // stores dom objects to insert into gallery instance
		},

		bindEvents: function() {
			this.$album.not('[data-photoalbum-images="[null]"]').on( 'click', this.albumClick.bind( this ) );
			$( document ).on( 'click', this.dom.closeBtn, this.closeClick.bind( this ) );
			$( window ).on( 'resize', this.thumbsVisibility.bind( this ) );
			$( window ).on( 'resize', this.makeArrows.bind( this ) );
		},

		albumClick: function( e ) {
			e.preventDefault();
			this.open();
			MK.ui.loader.add(this.album);
		},

		closeClick: function( e ) {
			e.preventDefault();

			// Because one close btn rules them all 
			if( this.slider ) {
				this.removeGallery();
				this.slider.exitFullScreen();  
			}
		},

		thumbsVisibility: function() {
			if( !this.thumbsWidth ) return;
			if( window.matchMedia( '(max-width:'+ (this.thumbsWidth + 260) +'px)' ).matches ) this.hideThumbs(); // 260 is 2 * 120 - right corner buttons width + scrollbar
			else this.showThumbs();
		},

		hideThumbs: function() {
			if( ! this.$thumbList ) return;
			this.$thumbList.hide();
		},

		showThumbs: function() {
			if( ! this.$thumbList ) return;
			this.$thumbList.show();
		},

		open: function() {
			var self = this;
			core.loadDependencies([ path.plugins + 'slick.js' ], function() {
				self.createGallery();
				self.loadImages();
			});
		},

		createGallery: function() {
			// only one per page
			if( ! $( this.dom.gallery ).length ) {
				var tpl = $( this.tpl.gallery ).eq( 0 ).html();
				$( 'body' ).append( tpl );
			}
			// and cache obj
			this.$gallery = $( this.dom.gallery ); 
			this.$closeBtn = $( this.dom.closeBtn );
		},

		createSlideshow : function() {
			var self = this;

			this.slider = new MK.ui.FullScreenGallery( this.dom.galleryContainer, {
				id: this.id,
				url: this.url
			});
			this.slider.init();

			$(window).trigger('resize');
			this.makeArrows();

			this.$thumbList = $( this.dom.thumbList );
			this.$thumbs = $( this.dom.thumbs ); 
			this.thumbsWidth = (this.$thumbs.length) * 95;
			this.thumbsVisibility();

			setTimeout(function() {
				MK.ui.loader.remove(self.album);
			}, 100);

			MK.utils.eventManager.publish('photoAlbum-open');
		},

		makeArrows: function() {
			if (this.arrowsTimeout) clearTimeout(this.arrowsTimeout);
			this.arrowsTimeout = setTimeout(function() {
				var $prev = $('.slick-prev').find('svg');
				var $next = $('.slick-next').find('svg');

				$prev.wrap('<div class="slick-nav-holder"></div>');
				$next.wrap('<div class="slick-nav-holder"></div>');

				if(matchMedia("(max-width: 1024px)").matches) {
					$prev.attr({width: 12, height: 22}).find('polyline').attr('points', '12,0 0,11 12,22');
					$next.attr({width: 12, height: 22}).find('polyline').attr('points', '0,0 12,11 0,22');
				} else {
					$prev.attr({width: 33, height: 65}).find('polyline').attr('points', '0.5,0.5 32.5,32.5 0.5,64.5');
					$next.attr({width: 33, height: 65}).find('polyline').attr('points', '0.5,0.5 32.5,32.5 0.5,64.5');
				}
			}, 0);
		},

		loadImages: function() {
			var self = this,
				n = 0;

			// cache images on first load. 
			if( ! this.images.length ) {
				this.imagesSrc.forEach( function( src ) {
					if(src === null) return; // protect from nulls
					var img = new Image(); 

					img.onload = function() {
						self.onLoad( n += 1 );
					};

					img.src = src; 
					self.images.push( img );
				});
			} else {
				this.onLoad( this.albumLength );
			}
		},

		onLoad : function( n ) {
			if( n === this.albumLength ) {
				this.insertImages(); 
				this.showGallery();
				this.createSlideshow();
			}
		},

		insertImages : function() {
			var $galleryContainer = this.$gallery.find( this.dom.galleryContainer ),
				$title = $( this.dom.title ),
				slide = this.tpl.slide;

			// clear first
			$galleryContainer.html( '' ); 
			$title.html( this.title );

			this.images.forEach( function( img ) {
				var $slide = $( slide );
				$slide.html( img );
				$galleryContainer.prepend( $slide );
			});
		},

		showGallery : function() {
			var self = this;

			this.$gallery.addClass( this.dom.activeClass );

			utils.scroll.disable();
 
		},

		removeGallery : function() {
			var self = this;

			this.$gallery.removeClass( this.dom.activeClass );

			setTimeout( function() {
				self.$gallery.remove();	
			}, 300 );

			utils.scroll.enable();
		},

		openByLink : function() {
			var loc = window.location,
				hash = loc.hash,
				id;

			if ( hash.length && hash.substring(1).length ) {
				id = hash.substring(1);
				id = id.replace( '!loading', '' );
				if( id == this.id && !this.initialOpen ) {
					this.initialOpen = true;
					this.open();
				}
			}
		}
	};


	// Barts note; Rifat duplication and coupling here. Remove it when have time
	MK.component.PhotoAlbumBlur = function( el ) {
         var init = function(){
			core.loadDependencies([ path.plugins + 'pixastic.js' ], function() {
         		blurImage($('.mk-album-item figure')); 
         	});
         };

         var blurImage = function($item) {
         	return $item.each(function() {
				var $_this = $(this);
				var img = $_this.find('.album-cover-image');
				img.clone().addClass("blur-effect item-blur-thumbnail").removeClass('album-cover-image').prependTo(this);

				var blur_this = $(".blur-effect", this);
				blur_this.each(function(index, element){
					if (img[index].complete === true) {
						Pixastic.process(blur_this[index], "blurfast", {amount:0.5});
					}
					else {
						blur_this.load(function () {
							Pixastic.process(blur_this[index], "blurfast", {amount:0.5});
						});
					}
				});
			});
         };

         return {
         	init : init
         };
    };

})( jQuery );