(function ($) {
	'use strict';

$('.mk-faq-wrapper').each( function() {
	var $this = $(this);
	var $filter = $this.find('.filter-faq');
	var $filterItem = $filter.find('a');
	var $faq = $this.find('.mk-faq-container > div');
	var currentFilter = '';

	$filterItem.on('click', function(e) {
		var $this = $(this);

		currentFilter = $this.data('filter');
		$filterItem.removeClass('current');
		$this.addClass('current');

		filterItems( currentFilter );

		e.preventDefault();
	});

	function filterItems( cat ) {
		if( cat === '' ) {
			$faq.slideDown(200).removeClass('hidden');
			return;
		}
		$faq.not( '.' + cat ).slideUp(200).addClass('hidden');
		$faq.filter( '.' + cat ).slideDown(200).removeClass('hidden');
	}
});
}( jQuery ));