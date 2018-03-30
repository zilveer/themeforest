$(document).ready(function(){
	
	/* ---------------------------------------------------- */
	/* Filterable											*/
	/* ---------------------------------------------------- */
	
	// cache container
	var $container = $('#container');
	// initialize isotope
	$container.isotope({
		animationEngine : 'best-available',
	  	animationOptions: {
	     	duration: 200,
	     	easing: 'easeInOutQuad',
	     	queue: false
	   	}
	});
	
	// filter items when filter link is clicked
	$('#filters a').click(function(){
		$('#filters a').removeClass('active');
		$(this).addClass('active');
		var selector = $(this).attr('data-filter');
	  	$container.isotope({ filter: selector });
	  	return false;
	});

});