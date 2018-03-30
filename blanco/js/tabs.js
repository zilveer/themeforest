/* Product Page tabs accordion */
jQuery(document).ready(function(){
    jQuery('.product-tabs').each(function(){
	    var tabs = jQuery(this);
	    
	    tabs.children('li').first().children('a').addClass('active')
        .next().addClass('is-open').show();
	    
		tabs.on('click', 'li > a', function(e) {
			
			e.preventDefault();
			
			if (!jQuery(this).hasClass('active')) {
				tabs.find('.is-open').removeClass('is-open').hide();
				jQuery(this).next().toggleClass('is-open').toggle();
				
				tabs.find('.active').removeClass('active');
				jQuery(this).addClass('active');
			} else {
				tabs.find('.is-open').removeClass('is-open').hide();
				jQuery(this).removeClass('active');
			}
		});
		
    });
});