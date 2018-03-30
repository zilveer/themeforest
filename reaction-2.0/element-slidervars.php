<?php if(ot_get_option('frontpage_slider') == 'on') { ?>
		
	<script type="text/javascript">	
	/*-----------------------------------------------------------------------------------*/
	/*	FlexSlider - http://flex.madebymufffin.com/
	/*-----------------------------------------------------------------------------------*/
	
			jQuery('#frontpage_slider').flexslider({
				animation: "<?php echo get_option_tree('fpslider_fx'); ?>",              //Select your animation type (fade/slide)
				slideshow: <?php echo get_option_tree('fpslider_auto'); ?>,                //Should the slider animate automatically by default? (true/false)
				slideshowSpeed: <?php echo get_option_tree('fpslider_autoduration'); ?>,           //Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 500,         //Set the speed of animations, in milliseconds
				directionNav: true,             //Create navigation for previous/next navigation? (true/false)
				controlNav: true,               //Create navigation for paging control of each clide? (true/false)
				keyboardNav: true,              //Allow for keyboard navigation using left/right keys (true/false)
				touchSwipe: true,               //Touch swipe gestures for left/right slide navigation (true/false)
				prevText: "Previous",           //Set the text for the "previous" directionNav item
				nextText: "Next",               //Set the text for the "next" directionNav item
				randomize: false,                //Randomize slide order on page load? (true/false)
				slideToStart: 0,                //The slide that the slider should start on. Array notation (0 = first slide)
				pauseOnAction: true,            //Pause the slideshow when interacting with control elements, highly recommended. (true/false)
				pauseOnHover: false,            //Pause the slideshow when hovering over slider, then resume when no longer hovering (true/false)
				controlsContainer: ".flexslider-container"           //Advanced property: Can declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
			});
			
	</script>
	
<?php }  ?>


<!-- Page Conditionals (check for the page variable from header.php) -->
<?php if(isset($GLOBALS['isapage']) && $GLOBALS[ 'isapage' ] == 'yes') : 
	
	$postid = $GLOBALS[ 'ourpostid' ]; ?>
		
	<?php if(get_post_meta($postid, 'image_slider', true) == 'on') { ?>
		
		<script type="text/javascript">	
		/*-----------------------------------------------------------------------------------*/
		/*	FlexSlider - http://flex.madebymufffin.com/
		/*-----------------------------------------------------------------------------------*/
		
				jQuery('#page_slider').flexslider({
					animation: "<?php echo get_post_meta($postid, 'slider_fx', true); ?>",              //Select your animation type (fade/slide)
					slideshow: <?php echo get_post_meta($postid, 'slider_auto', true); ?>,                //Should the slider animate automatically by default? (true/false)
					slideshowSpeed: <?php echo get_post_meta($postid, 'slider_autoduration', true); ?>,           //Set the speed of the slideshow cycling, in milliseconds
					animationDuration: 500,         //Set the speed of animations, in milliseconds
					directionNav: true,             //Create navigation for previous/next navigation? (true/false)
					controlNav: true,               //Create navigation for paging control of each clide? (true/false)
					keyboardNav: true,              //Allow for keyboard navigation using left/right keys (true/false)
					touchSwipe: true,               //Touch swipe gestures for left/right slide navigation (true/false)
					prevText: "Previous",           //Set the text for the "previous" directionNav item
					nextText: "Next",               //Set the text for the "next" directionNav item
					randomize: false,                //Randomize slide order on page load? (true/false)
					slideToStart: 0,                //The slide that the slider should start on. Array notation (0 = first slide)
					pauseOnAction: true,            //Pause the slideshow when interacting with control elements, highly recommended. (true/false)
					pauseOnHover: false,            //Pause the slideshow when hovering over slider, then resume when no longer hovering (true/false)
					controlsContainer: ".flexslider-container"           //Advanced property: Can declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
				});
				
		</script>
		
	<?php } ?>

<?php endif; ?>


<!-- Page Conditionals (check for the page variable from header.php) -->
<?php if(isset($GLOBALS['isapost']) && $GLOBALS[ 'isapost' ] == 'yes') : 

	$postid = $GLOBALS[ 'ourpostid' ]; ?>
		
	<?php if(get_post_meta($postid, 'image_slider', true) == 'on') { ?>
		
		<script type="text/javascript">	
			/*-----------------------------------------------------------------------------------*/
			/*	FlexSlider - http://flex.madebymufffin.com/
			/*-----------------------------------------------------------------------------------*/
			
					jQuery('#post_slider').flexslider({
						animation: "<?php echo get_post_meta($postid, 'slider_fx', true); ?>",              //Select your animation type (fade/slide)
						slideshow: <?php echo get_post_meta($postid, 'slider_auto', true); ?>,                //Should the slider animate automatically by default? (true/false)
						slideshowSpeed: <?php echo get_post_meta($postid, 'slider_autoduration', true); ?>,           //Set the speed of the slideshow cycling, in milliseconds
						animationDuration: 500,         //Set the speed of animations, in milliseconds
						directionNav: true,             //Create navigation for previous/next navigation? (true/false)
						controlNav: true,               //Create navigation for paging control of each clide? (true/false)
						keyboardNav: true,              //Allow for keyboard navigation using left/right keys (true/false)
						touchSwipe: true,               //Touch swipe gestures for left/right slide navigation (true/false)
						prevText: "Previous",           //Set the text for the "previous" directionNav item
						nextText: "Next",               //Set the text for the "next" directionNav item
						randomize: false,                //Randomize slide order on page load? (true/false)
						slideToStart: 0,                //The slide that the slider should start on. Array notation (0 = first slide)
						pauseOnAction: true,            //Pause the slideshow when interacting with control elements, highly recommended. (true/false)
						pauseOnHover: false,            //Pause the slideshow when hovering over slider, then resume when no longer hovering (true/false)
						controlsContainer: ".flexslider-container"           //Advanced property: Can declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
					});
					
			</script>
			
	<?php } ?>

<?php endif; ?>