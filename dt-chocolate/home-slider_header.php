<?php
define('GAL_HOME', 1);
?>

<?php if( is_page_template('home-slider.php') ):
$arr = dt_get_images_for_sliders( 'homeslider_new' );
$images = $options = array();
if( !empty($arr) ) {
	$images = $arr['images'];
	$options = $arr['options'];
}
?>

<script type="text/javascript">
	jQuery(function($){
		$.supersized({

					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	<?php echo isset($options['dt_autoplay'])?intval($options['dt_autoplay']):0; ?>,			// Slideshow starts playing automatically
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   <?php echo isset($options['dt_interval'])?intval($options['dt_interval']):0; ?>,		// Length between transitions
					transition              :   <?php echo isset($options['dt_transition'])?intval($options['dt_transition']):0; ?>, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	700,		// Speed of transition
					new_window				:	1,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	0,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   <?php echo intval(!empty($options['portrait'])); ?>,			// Portrait images will not exceed browser height
					fit_landscape			:   <?php echo intval(!empty($options['landscape'])); ?>,			// Landscape images will not exceed browser width
															   
					// Components							
					thumb_links				:	1,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
													   
			// Components							
			slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
			slides 					:  	[			// Slideshow Images
											<?php echo implode(', ', $images); ?>
										]
			
		});

	});
	Cufon('#slidecounter > span', {
		color: '-linear-gradient(#4a443c, #7a6d5c)', textShadow: '1px 1px #000'
	});
	Cufon('#slidecaption', {
		color: '-linear-gradient(#bfbcb7, #f5f2eb)', textShadow: '1px 1px #000'
	});
</script>
<?php elseif( is_page_template('home-3d.php') ):
$arr = dt_get_images_for_sliders( 'homeslider_3d' );
$images = array();
if( !empty($arr) ) $images = $arr['images'];
?>
<script>
window.slides3D = [<?php echo implode(', ', $images); ?>]
</script>
<?php endif; ?>