jQuery(document).ready(function() { 
	
	// Get the action filter option item on page load
	var $filterType = jQuery( "#filter li.active a" ).attr( "class" ); 
	
	// Get and assign the ourHolder element to the
	// $holder varible for use later
	var $holder = jQuery("#filterable-gallery"); 
	
	// Clone all items within the pre-assigned $holder element
	var $data = $holder.clone(); 
	
	// Attempt to call Quicksand when a filter option
	// item is clicked
	jQuery( "#filter li a" ).click( function(e) { 
		
		// Reset the active class on all the buttons
		jQuery( "#filter li" ).removeClass( "active" ); 
		var items_per_row = parseInt( quicksand.numberOfProjectsPerRow );
		
		// assign the class of the clicked filter option
		// element to our $filterType variable
		var $filterType = jQuery(this).attr("class").split(" ")[0]; 
		jQuery(this).parent().addClass("active"); 
		
		if ($filterType == "all") { 
			// assign all li items to the $filteredData var when
			// the 'All' filter option is clicked
			var $filteredData = $data.find("li[data-group]"); 
			var i = 1; 
			
			$filteredData.each(function() {
				var $self = jQuery(this);
				$self.removeClass("alpha omega");
				
				if(i === 1) {
					$self.addClass("alpha");
				}
				else if( i === items_per_row ) {
					$self.addClass("omega");
				}
				
				if ( i === items_per_row ) {
					i = 1;
				}
				else {
					i++;
				}
			});
		
		}
		else {
			// find all li elements that have our required $filterType
			// values for the data-type element
			var $filteredData = $data.find("li[data-group*=" + $filterType + "]");
			var i = 1;
			
			$filteredData.each(function() {
				var $self = jQuery(this);
				$self.removeClass("alpha omega");
				
				if ( i === 1 ) {
					$self.addClass("alpha");
				}
				else if ( i === items_per_row ) {
					var $html = $self.html();
					$self.addClass("omega");
				}
				
				if( i === items_per_row ) {
					i = 1;
				}
				else {
					i++;
				}
			});
		}
		
		$holder.quicksand($filteredData, {
			duration: 800,
			easing: "easeInOutQuad"
		}, function() { // Callback 
		       	var numberOfImagesPerRow = parseInt( quicksand.numberOfProjectsPerRow );
				var positionFromTop = '210px';
				var moveOnHoverOver = '73px';
				var moveOnHoverOut = '-58px';
				
				// Override defaults
				if(numberOfImagesPerRow == 4) {
					positionFromTop = '175px';
					moveOnHoverOver = '57px';
					moveOnHoverOut = '-58px';
				}
				else if(numberOfImagesPerRow == 2) {
					positionFromTop = '330px';
					moveOnHoverOver = '127px';
					moveOnHoverOut = '-58px';
				}
			
				var hoverOverFunction = function() {
					var $this = jQuery( this );
		
					if( $this.is( 'h3' ) ) {
						$this = jQuery( this ).prev();
					}
					
					$this.find( 'img' ).stop().animate( { opacity: 0.05 }, 600, 'easeInOutExpo' );
					$this.find( 'span:first' ).stop().animate( { opacity: 1, top: moveOnHoverOver }, 900, 'easeInOutExpo' );
				} 
				
				var hoverOutFunction = function() {
					var $this = jQuery( this );
		
					if( $this.is( 'h3' ) ) {
						$this = jQuery( this ).prev();
					}
					
					$this.find( 'img' ).stop().animate( { opacity: 1 }, 1500, 'easeInOutCubic' );
					$this.find( 'span:first' ).stop().animate( { opacity: 0, top: moveOnHoverOut }, 900, 'easeInOutExpo', function() { jQuery(this).css( 'top', positionFromTop ); } );
				}
				
				var config = {    
			    	over: hoverOverFunction,    
			     	timeout: 20, 
			     	interval: 130,  
			     	out: hoverOutFunction    
				};
				
				jQuery('.project-link, .project-link + h3').hoverIntent(config);
		});
		return false;
	});
});