var $g = jQuery.noConflict();

$g(function(){
	$g('ul#portfolio-filter a').click(function() {
		$g(this).css('outline','none');
		$g('ul#portfolio-filter .active').removeClass('active');
		$g(this).parent().addClass('active');
		
		var filterVal = $g(this).text().toLowerCase().replace(/ /g,'-');
				
		if(filterVal == 'all') {
			$g('ul#portfolio-list li.hidden').fadeIn('slow').removeClass('hidden');
		} else {
			
			$g('ul#portfolio-list li').each(function() {
				if(!$g(this).hasClass(filterVal)) {
					$g(this).fadeOut(600).addClass('hidden');
				} else {
					$g(this).fadeIn(600).removeClass('hidden');
				}
			});
		}
		
		return false;
	});
});