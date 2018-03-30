(function($) {
    'use strict';

    // Move header to last wrapper of page section if its added into page section. 
    $('.js-header-shortcode').each(function() {
	    var $this = $(this),
	        $parent_page_section = $this.parents('.mk-page-section'),
	        $is_inside = $parent_page_section.attr('id');

	    if ($is_inside) {
	        $this.detach().appendTo($parent_page_section);
	    }
    });
})(jQuery);