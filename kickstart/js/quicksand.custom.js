var $j = jQuery.noConflict();

$j(function(){		
		// Setting Up Our Variables
		var $jfilter;
		var $jcontainer;
		var $jcontainerClone;
		var $jfilterLink;
		var $jfilteredItems
		
		// Set Our Filter
		$jfilter = $j('.pf-filter li.active a').attr('class');
		
		// Set Our Filter Link
		$jfilterLink = $j('.pf-filter li a');
		
		// Set Our Container
		$jcontainer = $j('ul.filterable-grid');
		
		// Clone Our Container
		$jcontainerClone = $jcontainer.clone();
		
		// Apply our Quicksand to work on a click function
		// for each for the filter li link elements
		$jfilterLink.click(function(e) 
		{
			// Remove the active class
			$j('.pf-filter li').removeClass('active');
			
			// Split each of the filter elements and override our filter
			$jfilter = $j(this).attr('class').split(' ');
			
			// Apply the 'active' class to the clicked link
			$j(this).parent().addClass('active');
			
			// If 'all' is selected, display all elements
			// else output all items referenced to the data-type
			if ($jfilter == 'all') {
				$jfilteredItems = $jcontainerClone.find('li'); 
			}
			else {
				$jfilteredItems = $jcontainerClone.find('li[data-type~=' + $jfilter + ']'); 
			}
			
			// Finally call the Quicksand function
			$jcontainer.quicksand($jfilteredItems, 
			{
				// The Duration for animation
				duration: 750,
				// the easing effect when animation
				easing: 'easeInOutCirc',
				// height adjustment becomes dynamic
				adjustHeight: 'dynamic' 
			});			
		});
	});