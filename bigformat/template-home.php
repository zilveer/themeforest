<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>

<!-- Mobile Fade Element -->
<div class="bottomfade"><span></span></div>

<!-- Mobile Lines (Also Used as play/stop in custom.js.php -->
<div class="linesmobile"></div>

<!-- Non-Mobile Lines Overlay -->
<div class="lines"></div>

<!-- Initialize Fullscreen Slider
================================================== -->
<script type="text/javascript">
			
			jQuery(function($){
				$.supersized({
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	<?php echo of_get_option('of_home_autoplay', '1'); ?>,		
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   <?php echo of_get_option('of_homepage_autoplay_delay', '5'); ?>000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade
					transition_speed		:	1000,		// Speed of transition
					new_window				:	0,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	<?php if ( $imageprotect = get_option('of_image_protect') ) { echo $imageprotect; } else { echo '1'; }?>,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   0,			// Portrait images will not exceed browser height
					fit_landscape			:   0,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	1,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 					:  	[			// Slideshow Images
												 
				<?php 
				global $ag_loopcounter; $ag_loopcounter = 0; $images = '';
				
					   $loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page'=>-1) ); 
						while ( $loop->have_posts() ) : $loop->the_post(); // Start the Loop
						
							/* #Get Homepage Image Option Information
							======================================================*/
							get_homepage_info ($post->ID); //located in functions.php

							/* #Display Post Featured Image and Captions
							======================================================*/								 
							if ($home_display == 'Yes' && has_post_thumbnail()) { 
							 
								 // Full Size Image						 
							 	 $images .= "{image : '". $full[0] ."', title : '";
								 
								 $images .= '<div class="';
								 
								 // Set title placement
								 if($title_place) { $images .= $title_place . ' '; } else { $images .= 'Center '; }
								 
								 // Set title color
								 if($title_color) { $images .= $title_color . ' '; } else {  $images .= 'White '; }
								 
								 // Set title background
								 if($title_bg) { $images .= $title_bg . ' '; }
								 
								 // Set project id
								 $images .=  'caption" id="project-' . get_the_ID() . '">';
								 
								 // Set subtitle
								 if ($sub_title !== '') { $images .= '<div class="subheadline"><span>' . $sub_title .'</span></div>';} 
								 
								 // Set title
								 if ($title !== '') { $images .= '<div class="bgwrap"><h2><strong>' . $title . '</strong></h2></div>';} 
								 
								 // Set more button
								 if($more_button) { if($optional_link) { $images .= '<div class="captionbutton"><a href="'.$optional_link.'" class="button">'.htmlspecialchars($more_button, ENT_QUOTES).'</a></div>'; } else {  $images .= '<div class="captionbutton"><a href="'.$post_url.'" class="button">'.htmlspecialchars($more_button, ENT_QUOTES).'</a></div>'; } } 
								
								 // Clear 
								 $images .= '</div><div class="clear"></div>';
								 
								 // Set thumbnail and URL
								 $images .= "', thumb : '" . $thumb[0] . "', url : '" . $post_url . "'},"; 

							 } 

						endwhile; // End the Loop ?>

						 <?php $images = rtrim($images, ','); 
						 echo $images;
						 ?>
						 
						 ],
												
					// Theme Options			   
					progress_bar			:	<?php if ( $progressbar = of_get_option('of_progress_bar') ) { echo $progressbar; } else { echo '1'; }?>,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
		    });
</script>
<!-- End Fullscreen Slider -->  
     
<?php ag_loophide($ag_loopcounter); //Hide Controls if Only 1 Slide. Located in functions.php?>
        
<!--Slide captions displayed here-->
<div id="captioncontainer">
	<div id="slidecaption"></div>
</div>
<!-- End slide captions -->            

<!-- Start the Footer-->	  
<?php get_footer(); ?>
<!-- End Footer -->