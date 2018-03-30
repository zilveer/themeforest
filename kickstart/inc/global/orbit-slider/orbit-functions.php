<?php
/*	
*	---------------------------------------------------------------------
*	Orbit slider functions
*	--------------------------------------------------------------------- 
*/

add_action('wp_enqueue_scripts', 'orbit_slider_script');

function orbit_slider_script() {
	wp_enqueue_script('orbit-slider-js', MNKY_PATH . '/inc/global/orbit-slider/jquery.orbit-1.2.3.js', array('jquery'), '1.2.3', false);
}

$animation = ot_get_option('animation', 'horizontal-push'); 
$animationSpeed = ot_get_option('animationspeed', '600'); 
$advanceSpeed = ot_get_option('advancespeed', '4000'); 
$pauseOnHover = ot_get_option('pauseonhover', 'false'); 
$directionalNav = ot_get_option('directionalnav', 'true'); 
$bullets = ot_get_option('bullets', 'true'); 
?>

<script type="text/javascript">    
	    //Defaults to extend options
        var defaults = {  
            animation: '<?php echo $animation ?>', 		// fade, horizontal-slide, vertical-slide, horizontal-push
            animationSpeed: <?php echo $animationSpeed ?>, 				// how fast animtions are
            timer: true, 						// true or false to have the timer
            advanceSpeed: <?php echo $advanceSpeed ?>, 				// if timer is enabled, time between transitions 
            pauseOnHover: <?php echo $pauseOnHover ?>, 				// if you hover pauses the slider
            startClockOnMouseOut: true, 		// if clock should start on MouseOut
            startClockOnMouseOutAfter: '0', 	// how long after MouseOut should the timer start again
            directionalNav: <?php echo $directionalNav ?>, 				// manual advancing directional navs
            captions: false, 					// do you want captions?
            captionAnimation: 'fade', 			// fade, slideOpen, none
            captionAnimationSpeed: '600', 		// if so how quickly should they animate in
            bullets: <?php echo $bullets ?>,						// true or false to activate the bullet navigation
            bulletThumbs: false,				// thumbnails for the bullets
            bulletThumbLocation: '',			// location from this file where thumbs will be
            afterSlideChange: function(){} 		// empty function 
     	}; 
</script>