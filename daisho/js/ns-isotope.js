/**
 * Contains functions necessary to run Isotope.
 */
( function( $ ) {

	'use strict';
	
/* 	var now = Date.now || function() {
    return new Date().getTime();
  }; */
  
	// Returns a function, that, as long as it continues to be invoked, will not
  // be triggered. The function will be called after it stops being called for
  // N milliseconds. If `immediate` is passed, trigger the function on the
  // leading edge, instead of the trailing.
/*   var debounce = function(func, wait, immediate) {
    var timeout, args, context, timestamp, result;

    var later = function() {
      var last = now() - timestamp;

      if (last < wait && last > 0) {
        timeout = setTimeout(later, wait - last);
      } else {
        timeout = null;
        if (!immediate) {
          result = func.apply(context, args);
          if (!timeout) context = args = null;
        }
      }
    };

    return function() {
      context = this;
      args = arguments;
      timestamp = now();
      var callNow = immediate && !timeout;
      if (!timeout) timeout = setTimeout(later, wait);
      if (callNow) {
        result = func.apply(context, args);
        context = args = null;
      }

      return result;
    };
  }; */
	
	/**
	 *
	 * @TODO: If you slowly scale any browser, pixel by pixel then sometimes when JavaScript
	 *        returns some width, the actual width is 1px lower and thumbnails have a tendency
	 *        to move the last column to previous columns on some resolutions.
	 * @TODO: Breakpoint for 2 columns should be 445px but I set this to 440px to have 3 columns
	 *        on 480px screens (0.92 * 480 = 441.6). Maybe instead of doing that we should adjust
	 *        the width: 92%; value for all the containers in style.css to have less white space.
	 * @TODO: This function executes for each thumbnail because Isotope calls it like that.
	 *        It needs to execute only once on window resize.
	 */
	function columnWidth($container){
		var w = $container.width(),
			w = Math.floor( parseFloat( window.getComputedStyle( $container[0] ).width ) ), // TODO: This is possible fix for the first TODO item.
			columnNum = 5,
			columnWidth = 220;
		
		if (w <= 1795 || w > 1795) {
			columnNum  = 8;
		}
		if (w <= 1570) {
			columnNum  = 7;
		}
		if (w <= 1345) {
			columnNum  = 6;
		}
		if (w <= 1120) {
			columnNum  = 5;
		}
		if (w <= 900) {
			columnNum  = 4;
		}
		if (w <= 670) {
			columnNum  = 3;
		}
		if (w <= 440) { // TODO: This should be 445px but to have 3 columns on 480px screen (mobile phones) I made it 440px.
			columnNum  = 2;
		}
		if (w <= 220) {
			columnNum  = 1;
		}
		
		columnWidth = Math.floor(w/columnNum) - Math.ceil( (((columnNum - 1) * 5) / columnNum) );
		
		$container.find('.item').each(function() {
			var $item = $(this),
				multiplier_w = $item.attr('class').match(/width(\d)/),
				multiplier_h = $item.attr('class').match(/height(\d)/);
				
			if(columnWidth <= 160){
				$item.removeClass('item-meta-data-medium');
				$item.addClass('item-meta-data-small');
			}else if(columnWidth <= 190){
				$item.removeClass('item-meta-data-small');
				$item.addClass('item-meta-data-medium');
			}else if(columnWidth > 190){
				$item.removeClass('item-meta-data-small');
				$item.removeClass('item-meta-data-medium');
			}
			
			if(multiplier_w && w <= 440){
				multiplier_w[1] = 2;
			}
			if(multiplier_w && w <= 220){
				multiplier_w[1] = 1;
			}
			if(multiplier_h && w <= 220){
				multiplier_h[1] = 1;
			}
			if(!$container.hasClass('variable-sizes')){
				multiplier_w = null;
				multiplier_h = null;
			}
				
			var width = multiplier_w ? ( multiplier_w[1] * columnWidth + ( (multiplier_w[1] - 1) * 5 ) ) : columnWidth,
				height = (multiplier_h) ? ( ( Math.round( columnWidth * 150 / 220 ) * multiplier_h[1] ) + ( ( multiplier_h[1] - 1 ) * 5 ) ) : Math.round( columnWidth * 150 / 220 );
			$item.css({
				width: width,
				height: height
			});
		});
		return columnWidth;
	}
	
	$(document).ready(function(){
    
		var $container = $('.ns-container');
		
		if(!$container.length){
			return;
		}
		
		$container.isotope({
			itemSelector: '.item',
			isOriginLeft: !($('body').hasClass('rtl')),
			masonry: {
				//columnWidth: 220,
				columnWidth: columnWidth($container),
				gutter: 5
			},
			transitionDuration: '0.8s'
		});
		
		//$container.isotope( 'on', 'layoutComplete', function( isoInstance, laidOutItems ) {
			//$container.find('.item').removeClass('no-transition');
		//});
		
		var updateIsotope = function(){
			$container.isotope({
				itemSelector: '.item',
				isOriginLeft: !($('body').hasClass('rtl')),
				masonry: {
					//columnWidth: 220,
					columnWidth: columnWidth($container),
					gutter: 5
				},
				transitionDuration: '0.8s'
			});
			//$container.find('.item').addClass('no-transition');
			//$container.isotope( 'on', 'layoutComplete', function( isoInstance, laidOutItems ) {
				//$container.find('.item').removeClass('no-transition');
			//});
		};
		
		$(window).resize(updateIsotope);
		
		var $optionSets = $('.ns-filters .ns-filter-category'),
		$optionLinks = $optionSets.find('a');
		$optionLinks.on('click', function(){
			var $this = $(this);
			var $container = $this.closest('.ns-isotope').find('.ns-container');
			
			// Don't proceed if already selected.
			if ( $this.hasClass('selected') ) {
				return false;
			}
			
			var $optionSet = $this.parents('.ns-filter-category');
			$optionSet.find('.selected').removeClass('selected');
			$this.addClass('selected');

			// make option object dynamically, i.e. { filter: '.my-filter-class' }
			var options = {},
				key = $optionSet.attr('data-option-key'),
				value = $this.attr('data-option-value');
			// parse 'false' as false boolean
			value = value === 'false' ? false : value;
			options[ key ] = value;

			$container.isotope( options );

			return false;
		});

		// Toggle variable sizes of all elements.
		$('.ns-isotope').on('click', '.ns-filter-size a', function(){
			var $container = $(this).closest('.ns-isotope').find('.ns-container');
			if($(this).hasClass('toggle-selected')){
				return false;
			}
			$(this).closest('.ns-isotope').find('.ns-filter-size a').removeClass('toggle-selected');
			$(this).addClass('toggle-selected');
			$container.toggleClass('variable-sizes');
			columnWidth($container);
			$container.isotope('layout');
			centerIsotopeImages();
			return false;
		});
		
		// Exclude '#' link thumbnails
		$container.on('click', '.item .thumbnail-link', function(event){
			console.log("$(this).attr('href')", $(this).attr('href'));
			if($(this).attr('href') == '#'){
				event.preventDefault();
			}
		});
	});
	
	/**
	 * Center images inside Isotope's thumbnails.
	 */
	function centerIsotopeImages(){
		$('.ns-container .item').each(function(){
			var $this = $(this);

			if($this.find('img').get(0) === undefined){
				return;
			}
			
			var cont_ratio = $this.width() / $this.height();
			var img_ratio = $this.find('img').get(0).width / $this.find('img').get(0).height;
			if(cont_ratio <= img_ratio){
				$this.find('img').css({ 'width' : 'auto', 'height' : '100%', 'top' : 0 }).css({ 'left' : ~(($this.find('img').width()-$this.width())/2)+1 });
				$this.find('img').addClass('project-img-visible');
			}else{
				$this.find('img').css({ 'width' : '100%', 'height' : 'auto', 'left' : 0 }).css({ 'top' : ~(($this.find('img').height()-$this.height())/2)+1 });
				$this.find('img').addClass('project-img-visible');
			}
		});
		
		return;
	}
	
	function centerIsotopeImagesOnLoad() {
		$('.project-img').one('load', function(){
			var $this = $(this);
			var cont_ratio = $this.parent().width() / $this.parent().height();
			var img_ratio = $this.get(0).width / $this.get(0).height;

			if(cont_ratio <= img_ratio){
				$this.css({ 'width' : 'auto', 'height' : '100%', 'top' : 0 }).css({ 'left' : ~(($this.width()-$this.parent().width())/2)+1 });
				$this.addClass('project-img-visible');
			}else{
				$this.css({ 'width' : '100%', 'height' : 'auto', 'left' : 0 }).css({ 'top' : ~(($this.height()-$this.parent().height())/2)+1 });
				$this.addClass('project-img-visible');
			}
		});
	}

	$(window).load(function(){
		centerIsotopeImages();
	});

	$(document).ready(function(){
	
		// Center images inside thumbnails on window resize
		$(window).bind('resize.nsCenterIsotopeImages', function(){
			centerIsotopeImages();
		});
		centerIsotopeImagesOnLoad();
	});
	
} )( jQuery );
