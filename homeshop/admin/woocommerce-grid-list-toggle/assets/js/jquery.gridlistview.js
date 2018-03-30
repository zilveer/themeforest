// The toggle

jQuery(document).ready(function(){

    jQuery('#grid').click(function() {
		jQuery(this).addClass('active');
		jQuery('#list').removeClass('active');
		jQuery.cookie('gridcookie','grid', { path: '/' });
		jQuery('ul.products').fadeOut(300, function() {
			jQuery(this).addClass('grid').removeClass('list').fadeIn(300);
			
		});
		return false;
	});

	jQuery('#list').click(function() {
		jQuery(this).addClass('active');
		jQuery('#grid').removeClass('active');
		jQuery.cookie('gridcookie','list', { path: '/' });
		jQuery('ul.products').fadeOut(300, function() {
			jQuery(this).removeClass('grid').addClass('list').fadeIn(300);

		});
		return false;
	});

	if (jQuery.cookie('gridcookie')) {
        jQuery('ul.products, .category-buttons').addClass(jQuery.cookie('gridcookie'));
    }

    if (jQuery.cookie('gridcookie') == 'grid') {
        jQuery('.category-buttons #grid').addClass('active');
        jQuery('.category-buttons #list').removeClass('active');
    }

    if (jQuery.cookie('gridcookie') == 'list') {
        jQuery('.category-buttons #list').addClass('active');
        jQuery('.category-buttons #grid').removeClass('active');
    }

	jQuery('#category-buttons a').click(function(event) {
	    event.preventDefault();
	});

})