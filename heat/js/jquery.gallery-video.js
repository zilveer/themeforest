jQuery(document).ready(function(){
	var $containerVideo = jQuery('.videos-gallery');
		
		// Isotope
		// modified Isotope methods for gutters in masonry
		jQuery.Isotope.prototype._getMasonryGutterColumns = function() {
			var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
				containerWidth = this.element.width();
  
		this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth ||
                  // or use the size of the first item
                  this.$filteredAtoms.outerWidth(true) ||
                  // if there's no items, use size of container
                  containerWidth;

		this.masonry.columnWidth += gutter;

		this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
		this.masonry.cols = Math.max( this.masonry.cols, 1 );
		};

		jQuery.Isotope.prototype._masonryReset = function() {
			// layout-specific props
			this.masonry = {};
			// FIXME shouldn't have to call this again
			this._getMasonryGutterColumns();
			var i = this.masonry.cols;
			this.masonry.colYs = [];
			while (i--) {
				this.masonry.colYs.push( 0 );
			}
		};

		jQuery.Isotope.prototype._masonryResizeChanged = function() {
			var prevSegments = this.masonry.cols;
			// update cols/rows
			this._getMasonryGutterColumns();
			// return if updated cols/rows is not equal to previous
			return ( this.masonry.cols !== prevSegments );
		};
		
		var vid_per_page = parseInt($containerVideo.attr('data-offset'));
		var currentcount = vid_per_page;
		var total = parseInt($containerVideo.attr('data-total'));
		var pageid = parseInt($containerVideo.attr('data-pageid'));
		
		// cache jQuery window
		var $window = jQuery(window);
		
		// start up isotope with default settings
		$containerVideo.imagesLoaded( function(){
			reLayout();
			$window.smartresize( reLayout );
		});
		
		function reLayout() {
  
			var mediaQueryId = getComputedStyle( document.body, ':after' ).getPropertyValue('content');
			// fix for firefox, remove double quotes "
			if (navigator.userAgent.match('MSIE 8') == null) {
				mediaQueryId = mediaQueryId.replace( /"/g, '' );
			}
			//console.log( mediaQueryId );
			var windowSize = $window.width();
			var masonryOpts;
			// update sizing options 
			switch ( mediaQueryId ) {
				case 'large' :
					masonryOpts = {
					  columnWidth: $containerVideo.width() / 3
					};
				break;
				case 'big' :
					masonryOpts = {
					  columnWidth: $containerVideo.width() / 3
					};
				break;
				
				case 'medium' :
					masonryOpts = {
					  columnWidth: $containerVideo.width() / 3
					};
				break;
				
				case 'small' :
				masonryOpts = {
				  columnWidth: $containerVideo.width() / 2
				};
				break;
				
				case 'tiny' :
				masonryOpts = {
				  columnWidth: $containerVideo.width() / 1
				};
				break;
			}

			$containerVideo.isotope({
			  resizable: false, // disable resizing by default, we'll trigger it manually
			  itemSelector : '.video-gallery-item',
			  masonry: masonryOpts
			},function(){
				jQuery(window).bind({scroll: function(){mega_addVideosScroll();}});
				if ( ( $containerVideo.height() < jQuery(window).height() ) &&  ( currentcount < total ) ){
					mega_loadMoreVideos();	
				}
			}).isotope( 'reLayout' );

		}
		
		function mega_addVideosScroll(){
			if ( ($containerVideo.height() - jQuery(window).height() <= jQuery(window).scrollTop()) &&  (currentcount < total) ){	
				mega_loadMoreVideos();				 
			}
		}
		
		function mega_loadMoreVideos(){
				jQuery('#ajax-loading').show();
				jQuery(window).unbind("scroll");
				
				jQuery('.media-image a').unbind('click.fb');
				jQuery('.media-image a').click(function(e){
					e.preventDefault();
				});
		
		
                jQuery.ajax({
                    type: 'POST',
					url: megaAjax.ajaxurl,
					data: {
						action: 'mega_ajax_video_gallery',
						nonce : megaAjax.nonce,							
						offset: currentcount,
						numberposts : vid_per_page,
						pageid : pageid
					},
                    success: function( data ) {
						var $newElems = jQuery(data);
						// ensure that images load before adding to masonry layout
						$newElems.imagesLoaded( function(){
							jQuery('#ajax-loading').hide();
							$containerVideo.append($newElems).isotope( 'appended', $newElems);		
							
							currentcount = currentcount + vid_per_page;
							if (currentcount >= total) {										
								jQuery('#ajax-loading').remove();
							} else {
								jQuery(window).bind({scroll: function(){ mega_addVideosScroll();}});
								if ($containerVideo.height() < jQuery(window).height())
									mega_loadMoreVideos();
							}						
						});
					}
				});
            return false;
		}
});
