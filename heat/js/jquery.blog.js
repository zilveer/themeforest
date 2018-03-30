jQuery(document).ready(function($){
	var $container = $('#hentry-wrapper');
		
		// Isotope
		// modified Isotope methods for gutters in masonry
		$.Isotope.prototype._getMasonryGutterColumns = function() {
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

		$.Isotope.prototype._masonryReset = function() {
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

		$.Isotope.prototype._masonryResizeChanged = function() {
			var prevSegments = this.masonry.cols;
			// update cols/rows
			this._getMasonryGutterColumns();
			// return if updated cols/rows is not equal to previous
			return ( this.masonry.cols !== prevSegments );
		};
		
		var loadMore = $('#load-more');
		var posts_per_page = parseInt(loadMore.attr('data-perpage'));
		var offset = posts_per_page;
		var totalPosts = parseInt(loadMore.attr('data-total-posts'));
		var author = parseInt(loadMore.attr('data-author'));
		var category = parseInt(loadMore.attr('data-category'));
		var tag = loadMore.attr('data-tag');
		var datemonth = loadMore.attr('data-month');
		var dateyear = loadMore.attr('data-year');
		var search = loadMore.attr('data-search');
		var loader = $('#posts-count').attr('data-loader');
		
		if (!author) author = 0;
		if (!category) category = 0;
		if (!tag) tag = '';
		if (!datemonth) datemonth = 0;
		if (!dateyear) dateyear = 0;
		if (!search) search = '';
		
		// cache jQuery window
		var $window = $(window);
		
		// start up isotope with default settings
		$(window).load(function(){
			reLayout();
			$window.smartresize( reLayout );
			if (offset < totalPosts) {
				$('#nav-pagination-load-more').fadeIn(200);
				mega_initLoadMore();
			}
		});
		
		function reLayout() {
  
			var mediaQueryId = getComputedStyle( document.body, ':after' ).getPropertyValue('content');
			// fix for firefox, remove double quotes "
			//mediaQueryId = mediaQueryId.replace( /"/g, '' );
			//console.log( mediaQueryId );
			var windowSize = $window.width();
			var masonryOpts;
			// update sizing options 
			switch ( mediaQueryId ) {
				case 'large' :
					masonryOpts = {
					  gutterWidth: 0
					};
				break;
				
				case 'big' :
					masonryOpts = {
					  //columnWidth: 297,
					  gutterWidth: 0
					};
				break;
				
				case 'medium' :
					masonryOpts = {
					  //columnWidth: 269,
					  gutterWidth: 0
					};
				break;
				
				case 'small' :
				masonryOpts = {
				  //columnWidth: $container.width() / 4,
				  gutterWidth: 0
				};
				break;
				
				case 'tiny' :
				masonryOpts = {
				  //columnWidth: $container.width() / 1,
				  gutterWidth: 0
				};
				break;
			}

			$container.isotope({
			  resizable: false, // disable resizing by default, we'll trigger it manually
			  itemSelector : '.type-post',
			  transformsEnabled: false, // Firefox Vimeo issue
			  masonry: masonryOpts
			}).isotope( 'reLayout' );

		}
		
		function mega_initLoadMore(){
			loadMore.click(function(e) {
				$(this).unbind("click").addClass('active');	
				$('#posts-count').html('<img src="'+ loader +'"/>');	
				e.preventDefault();
				mega_loadMorePosts();
			});
		}
		
		function mega_reLayout(){
			$container.isotope( 'reLayout' );	
		}
		
		function mega_loadMorePosts(){
                jQuery.ajax({
                    url: megaAjax.ajaxurl,
                    type: 'POST',
                    data: {
						action : 'mega_ajax_blog',
						nonce : megaAjax.nonce,
						category: category,
						author: author,
						tag: tag,
						datemonth: datemonth,
						dateyear: dateyear,
						search: search,
						offset: offset
					},
                    success: function( data ) {
						var $newElems = $(data);
						// ensure that images load before adding to masonry layout
						$newElems.imagesLoaded( function(){
							// FitVids
							$('.fluid-video, .entry-content', $newElems).fitVids();
							
							$container.append($newElems).isotope( 'appended', $newElems );
							
							// Flex Slider
							$('.flexslider', $newElems).flexslider({
								animation: "fade",
								slideshow: false,
								keyboard: false,
								directionNav: true,
								touch: true,
								prevText: "",
								nextText: ""
							});
							
							setTimeout(function(){
								mega_reLayout();
							}, 1000);
							
							offset = offset + posts_per_page;
							loadMore.removeClass('active');
							if (offset < totalPosts){
								$('#posts-count').text('');
								loadMore.bind("click", mega_initLoadMore());
							}
							else {
								setTimeout(function(){
									loadMore.parent().remove();
								}, 1000 );	
							}							
						});
					}
				});
            return false;
		}
});
