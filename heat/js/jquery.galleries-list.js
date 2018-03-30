jQuery(document).ready(function(){
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
  
		// cache jQuery window
		var $window = jQuery(window);
  
		// cache container
		var $container = jQuery('#galleries-list');
  
		// start up isotope with default settings
		$container.imagesLoaded( function(){
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
					  columnWidth: $container.width() / 4
					};
				break;
				case 'big' :
					masonryOpts = {
					  columnWidth: $container.width() / 4
					};
				break;
				
				case 'medium' :
					masonryOpts = {
					  columnWidth: $container.width() / 4
					};
				break;
				
				case 'small' :
					masonryOpts = {
						columnWidth: $container.width() / 2
					};
				break;
				
				case 'tiny' :
				masonryOpts = {
				  columnWidth: $container.width() / 1
				};
				break;
			}

			$container.isotope({
			  resizable: false, // disable resizing by default, we'll trigger it manually
			  itemSelector : '.hentry',
			  masonry: masonryOpts
			}).isotope( 'reLayout' );

		}

		// filter items when filter link is clicked
		jQuery('#filters a').click(function() {
			var selector = jQuery(this).attr('data-filter');
			$container.isotope({ filter: selector });
			return false;
		});
		
		// set selected menu items
		var $optionSets = jQuery('.option-set'),
			$optionLinks = $optionSets.find('a');
 
			$optionLinks.click(function(){
				var $this = jQuery(this);
				// don't proceed if already selected
				if ( $this.hasClass('selected') ) {
					return false;
				}
				var $optionSet = $this.parents('.option-set');
				$optionSet.find('.selected').removeClass('selected');
				$this.addClass('selected'); 
			});
});
