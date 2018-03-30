jQuery(document).ready(function ($) {

	
	// Filter items when filter link is clicked
	$('.portfolio-filter a').click(function(){
	  var selector = $(this).attr('data-filter');
		$('.portfolio-filter a').removeClass('selected-portfolio-filter');
		$(this).addClass('selected-portfolio-filter');
	  $container.isotope({ filter: selector });
	  return false;
	});

	// Portfolio container
	var $container = $('.portfolio-content');
	$container.imagesLoaded(function() {
		$container.isotope({
			layoutMode : 'fitRows'	// masonry, fitRows
	  });
	});
	
		$(".portfolio-content").infinitescroll({
			navSelector  : '.gallery-navi',    // selector for the paged navigation 
			nextSelector : '.gallery-navi a.next',  // selector for the NEXT link (to page 2)
			itemSelector : '.portfolio-content .one-third, .portfolio-content .four',     // selector for all items you'll retrieve
			animate      : true,
			loading: {
				finishedMsg: 'No more pages to load.',
				img: df.imageUrl+'loading.gif'
			}
		},
			function(newElements) {
				$(newElements).imagesLoaded(function(){

					//portfolio image load
					$( ".gallery-image",newElements ).each(function() {
						$(".gallery-image").fadeIn('slow');
						$(".waiter-portfolio").removeClass("loading").addClass("loaded");
					
					});

					// Hover images
					$(".hover-image").hover(function() {
						$(this).find("img").stop().animate({'opacity' : 0.2});
					}, function(){
						$(this).find("img").stop().animate({'opacity' : 1});
					});

					$(".portfolio-content").isotope('insert', $(newElements));	


				});  
	
				
			}
		);
});