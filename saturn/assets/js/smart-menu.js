(function($) {
  "use strict";
	/** headroom  **/
	try {
		$('.header').headroom();
	} catch (e) {
		// TODO: handle exception
		console.log('Can not load headroom.min.js');
	} 
})(jQuery);