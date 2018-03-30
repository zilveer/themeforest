/**
 * Portfolio controller.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package JS
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Boot
 * -----------------------------------------------------------------------------
 */
(function($) {
	$(document).ready(function() {
		var portfolioConfig = $.thb.config.get('portfolio', $.thb.config.themeKeyName),
			isotopeConfig = $.thb.config.get('isotope', $.thb.config.themeKeyName);

		$.thb_portfolio(portfolioConfig, isotopeConfig);
	});
})(jQuery);

/**
 * Configuration
 * -----------------------------------------------------------------------------
 */
jQuery.thb.config.set('isotope', jQuery.thb.config.defaultKeyName, {
	animationOptions: {
		duration: 250,
		easing: 'linear',
		queue: false
	}
});

/**
 * Portfolio
 * -----------------------------------------------------------------------------
 */
(function($) {
	/**
	 * Run the portfolio.
	 *
	 * @param Object config The portfolio configuration.
	 * @param Object config The Isotope configuration.
	 * @return void
	 */
	$.thb_portfolio = function( portfolioConfig, isotopeConfig ) {

		if( !$.fn.isotope ) {
			return;
		}

		if( !portfolioConfig ) {
			portfolioConfig = $.thb.config.get('portfolio');
		}

		if( !isotopeConfig ) {
			isotopeConfig = $.thb.config.get('isotope');
		}

		$.thb.isotope( portfolioConfig, isotopeConfig );

	};
})(jQuery);