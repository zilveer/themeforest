// QuickSand
jQuery(document).ready(function() {
	
	function product_quicksand() {
		
		var $filter;
		var $container;
		var $containerClone;
		var $filterLink;
		var $filteredItems
		
		$filter = $('#tbQuickSand li.active a').attr('class');
		$filterLink = $('#tbQuickSand li a');
		$container = $('#productHolder');
		$containerClone = $container.clone();
		
		$filterLink.click(function(e) 
		{
			e.preventDefault();
			
			$('#tbQuickSand li').removeClass('active');
			$filter = $(this).attr('class').split(' ');
			$(this).parent().addClass('active');
			
			if ($filter == 'all') {
				$filteredItems = $containerClone.find('.singleItem'); 
			}
			else {
				$filteredItems = $containerClone.find('.singleItem[data-type~=' + $filter + ']'); 
			}
			
			$container.quicksand($filteredItems, 
			{	
				duration: 700,
				easing: 'easeInOutQuad',
				adjustHeight: false,
				useScaling: true
			}, function() {
				$('.singleItem > .thumb > a').hover(function()	{
					$(this).append('<span class="magnifier"></span>');
					$(this).children('img').stop().animate({opacity: 0.5}, 400);
				}, function() {
					$(this).children('img').stop().animate({opacity: 1}, 400);
				});
			});
			
		});
	}
	
	if(jQuery().quicksand) {
		product_quicksand();	
	}
});
