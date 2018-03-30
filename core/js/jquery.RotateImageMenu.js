var $j = jQuery.noConflict();

$j(function() {
		//our 4 items	
	var $jlistItems 		= $j('#rm_container > ul > li'),
		totalItems		= $jlistItems.length,
		
		//the controls
		$jrm_next		= $j('#rm_next'),
		$jrm_prev		= $j('#rm_prev'),
		$jrm_play		= $j('#rm_play'),
		$jrm_pause		= $j('#rm_pause'),
		
		//the masks and corners of the slider
		$jrm_mask_left	= $j('#rm_mask_left'),
		$jrm_mask_right	= $j('#rm_mask_right'),
		$jrm_corner_left	= $j('#rm_corner_left'),
		$jrm_corner_right= $j('#rm_corner_right'),
		
		//check if the browser is <= IE8
		ieLte8			= ($j.browser.msie && parseInt($j.browser.version) <= 8),
		
		RotateImageMenu	= (function() {
				//difference of animation time between the items
			var	timeDiff			= 300,
				//time between each image animation (slideshow)
				slideshowTime		= 3000,
				slideshowInterval,	
				//checks if the images are rotating
				isRotating			= false,
				//how many images completed each slideshow iteration
				completed			= 0,
				/*
				all our images have 310 of width and 465 of height.
				this could / should be dynamically calculated 
				if we would have different image sizes.
				
				we will set the rotation origin at 
				x = width/2 and y = height*2
				*/
				origin				= ['155px', '930px'],
				init				= function() {
					configure();
					initEventsHandler();
				},
				//initialize some events
				initEventsHandler	= function() {
					/*
					next and previous arrows:
					we will stop the slideshow if active,
					and rotate each items images.
					1 	rotate right
					-1 	rotate left
					*/
					$jrm_next.bind('click', function(e) {
						stopSlideshow();
						rotateImages(1);
						return false;
					});
					$jrm_prev.bind('click', function(e) {
						stopSlideshow();
						rotateImages(-1);
						return false;
					});
					/*
					start and stop the slideshow
					*/
					$jrm_play.bind('click', function(e) {
						startSlideshow();
						return false;
					});
					$jrm_pause.bind('click', function(e) {
						stopSlideshow();
						return false;
					});
					/*
					adds events to the mouse and left / right keys
					*/
					$j(document).bind('mousewheel', function(e, delta) {
						if(delta > 0) {
							stopSlideshow();
							rotateImages(0);
						}	
						else {
							stopSlideshow();
							rotateImages(1);
						}	
						return false;
					}).keydown(function(e){
						switch(e.which){
							case 37:
								stopSlideshow();
								rotateImages(0);
								break;
							case 39:
								stopSlideshow();
								rotateImages(1);
								break;
						}
					});
				},
				/*
				rotates each items images.
				we set a delay between each item animation
				*/
				rotateImages		= function(dir) {
					//if the animation is in progress return
					if(isRotating) return false;
					
					isRotating = true;
					
					$jlistItems.each(function(i) {
						var $jitem 				= $j(this),
							/*
							the delay calculation.
							if rotation is to the right, 
							then the first item to rotate is the first one,
							otherwise the last one
							*/
							interval			= (dir === 1) ? i * timeDiff : (totalItems - 1 - i) * timeDiff;
						
						setTimeout(function() {
								//the images associated to this item
							var	$jotherImages		= $j('#' + $jitem.data('images')).children('img'),
								totalOtherImages	= $jotherImages.length;
								
								//the current one
								$jimg				= $jitem.children('img:last'),
								//keep track of each items current image
								current				= $jitem.data('current');
								//out of bounds 
								if(current > totalOtherImages - 1)
									current = 0;
								else if(current < 0)
									current = totalOtherImages - 1;
								
								//the next image to show and its initial rotation (depends on dir)
								var otherRotation	= (dir === 1) ? '-30deg' : '30deg',
									$jother			= $jotherImages.eq(current).clone();
									
								//for IE <= 8 we will not rotate, but fade out / fade in ... 
								//better than nothing :)	
								if(!ieLte8)
									$jother.css({
										rotate	: otherRotation,
										origin	: origin
									});
								
								(dir === 1) ? ++current : --current;
								
								//prepend the next image to the <li>
								$jitem.data('current', current).prepend($jother);
								
								//the final rotation for the current image 
								var rotateTo		= (dir === 1) ? '80deg' : '-80deg';
								
								if(!ieLte8) {
									$jimg.animate({
										rotate	: rotateTo
									}, 1200, function(){
										$j(this).remove();
										++completed;
										if(completed === 4) {
											completed = 0;
											isRotating = false;
										}
									});
									$jother.animate({
										rotate	: '0deg'
									}, 600);
								}
								else {
									$jimg.fadeOut(1200, function(){
										$j(this).remove();
										++completed;
										if(completed === 4) {
											completed = 0;
											isRotating = false;
										}
									});
								}
								
						}, interval );	
					});
					
				},
				//set initial rotations
				configure			= function() {
					if($j.browser.msie && !ieLte8)
						rotateMaskCorners();
					else if(ieLte8)
						hideMaskCorners();
						
					$jlistItems.each(function(i) {
						//the initial current is 1 
						//since we already showing the first image
						var $jitem = $j(this).data('current', 1);
						
						if(!ieLte8)
						$jitem.transform({rotate: $jitem.data('rotation') + 'deg'})
							 .find('img')
							 .transform({origin: origin});
					});
				},
				//rotates the masks and corners
				rotateMaskCorners	= function() {
					$jrm_mask_left.transform({rotate: '-3deg'});
					$jrm_mask_right.transform({rotate: '3deg'});
					$jrm_corner_left.transform({rotate: '45deg'});
					$jrm_corner_right.transform({rotate: '-45deg'});
				},
				//hides the masks and corners
				hideMaskCorners		= function() {
					$jrm_mask_left.hide();
					$jrm_mask_right.hide();
					$jrm_corner_left.hide();
					$jrm_corner_right.hide();
				},
				startSlideshow		= function() {
					clearInterval(slideshowInterval);
					rotateImages(1);
					slideshowInterval	= setInterval(function() {
						rotateImages(1);
					}, slideshowTime);
					//show the pause button and hide the play button
					$jrm_play.hide();
					$jrm_pause.show();
				},
				stopSlideshow		= function() {
					clearInterval(slideshowInterval);
					//show the play button and hide the pause button
					$jrm_pause.hide();
					$jrm_play.show();
				};
			
			return {init : init};
		})();
		
	RotateImageMenu.init();
});