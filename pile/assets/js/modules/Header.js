var Header = (function() {

	var $header, heroHeight, headerHeight,
		above,
		initialized = false;

	function init() {
		above = undefined;
		$header = $('.js-transparent-header');
		heroHeight = $('.js-hero:visible').outerHeight() || $('.single-product .js-post-gallery').outerHeight();
		headerHeight = $('.header-height').outerHeight();

		if ( heroHeight && ! $body.is('.page-template-contact') ) {
			initialized = true;
			update();
		} else {
			initialized = false;
			$header.removeClass('site-header--transparent');
		}
	}

	function update() {
		if ( ! initialized ) return;

		if ( above !== true && latestKnownScrollY <= heroHeight - headerHeight/2 ) {
			$header.addClass('site-header--transparent');
			above = true;
		}

		if ( above !== false && latestKnownScrollY > heroHeight - headerHeight/2 ) {
			$header.removeClass('site-header--transparent');
			above = false;
		}
	}

	return {
		init: init,
		update: update
	}

})(undefined);