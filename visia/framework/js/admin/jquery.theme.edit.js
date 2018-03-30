/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity,ajaxurl,tinymce,JSON,wp */

jQuery(function ($) {
    
	var featured = {
			get: function() {
				return wp.media.view.settings.post.featuredImageId;
			},

			set: function( id ) {
				var settings = wp.media.view.settings;

				settings.post.featuredImageId = id;

				wp.media.post( 'pe_theme_featured_image', {
					postID:      settings.post.id,
					ID: id
				}).done( function(response) {
					if (response && response.img) {
						settings.post.target.html(response.img);
					}
				});
			},

			frame: function() {
				if ( this._frame )
					return this._frame;

				this._frame = wp.media({
					state: 'featured-image',
					states: [ new wp.media.controller.FeaturedImage() ]
				});

				this._frame.on( 'toolbar:create:featured-image', function( toolbar ) {
					this.createSelectToolbar( toolbar, {
						text: wp.media.view.l10n.setFeaturedImage
					});
				}, this._frame );

				this._frame.state('featured-image').on( 'select', this.select );
				return this._frame;
			},

			select: function() {
				var selection = this.get('selection').single();				
				featured.set( selection ? selection.id : -1 );
			},

			init: function() {
				$('a.pe-set-featured').on( 'click',function(e) {                
					e.preventDefault();
					e.stopPropagation();
					
					var target = $(e.currentTarget);
					
					wp.media.view.settings.post = {
						target: target,
						featuredImageId: target.attr("data-feat-id"),
						id: target.attr("data-post-id")
					};
					featured.frame().open();
				});
			}
		};

    featured.init();

});


