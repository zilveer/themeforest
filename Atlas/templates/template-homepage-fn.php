<?php
$initial_image = $all_photo_arr[0]->guid;

?>

<?php
    $pp_homepage_logo = get_option('pp_homepage_logo');
    				
    if(empty($pp_homepage_logo))
    {
    	$pp_homepage_logo = '/images/cover.png';
    }
    else
    {
    	$pp_homepage_logo = '/data/'.$pp_homepage_logo;
    }
?>
		<div id="cover_content"><img src="<?php echo get_stylesheet_directory_uri().$pp_homepage_logo; ?>"></div>

		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/supersized.css" type="text/css" media="screen" />
		

		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/supersized.3.1.3.min.js"></script>
		
		<script type="text/javascript">  
			
			jQuery(function($){
				$.supersized({
				
					//Functionality
					slideshow               :   1,		//Slideshow on/off
					autoplay				:	1,		//Slideshow starts playing automatically
					start_slide             :   1,		//Start slide (0 is random)
					random					: 	0,		//Randomize slide order (Ignores start slide)
					slide_interval          :   <?php echo $pp_slideshow_timer*1000; ?>,	//Length between transitions
					transition              :   1, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	1000,	//Speed of transition
					new_window				:	1,		//Image links open in new window/tab
					pause_hover             :   0,		//Pause slideshow on hover
					keyboard_nav            :   1,		//Keyboard navigation on/off
					performance				:	1,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,		//Disables image dragging and right click with Javascript
					image_path				:	'img/', //Default image path

					//Size & Position
					min_width		        :   0,		//Min width allowed (in pixels)
					min_height		        :   0,		//Min height allowed (in pixels)
					vertical_center         :   1,		//Vertically center background
					horizontal_center       :   1,		//Horizontally center background
					fit_portrait         	:   0,		//Portrait images will not exceed browser height
					fit_landscape			:   0,		//Landscape images will not exceed browser width
					
					//Components
					navigation              :   0,		//Slideshow controls on/off
					thumbnail_navigation    :   0,		//Thumbnail navigation
					slide_counter           :   0,		//Display slide numbers
					slide_captions          :   0,		//Slide caption (Pull from "title" in slides array)
					slides 					:  	[		//Slideshow Images
														  
	

		<?php
			foreach($all_photo_arr as $key => $photo)
			{
			    $small_image_url = get_stylesheet_directory_uri().'/images/000_70.png';
			    $hyperlink_url = get_permalink($photo->ID);
			    
			    if(!empty($photo->guid))
			    {
			    	$image_url[0] = $photo->guid;
			    
			    	$small_image_url = get_stylesheet_directory_uri().'/timthumb.php?src='.$image_url[0].'&amp;h=50&amp;w=50&amp;zc=1';
			    }

		?>

        	<?php $homeslides .= '{image : \''.$image_url[0].'\'},'; ?>
        	
        <?php
        	}
        ?>

						<?php $homeslides = substr($homeslides,0,-1);
						echo $homeslides; ?>						]
												
				}); 
		    });
		    
	if(BrowserDetect.browser != 'Explorer')
 	{
		$j('body').hover(
			function(){ //mouse over
				$j('#menu_wrapper').stop().fadeTo("slow", 1);
			},
			function(){ //mouse out
				$j('#menu_wrapper').stop().fadeTo("slow", 0);
			}
		);
	}
	else
	{
		$j('#menu_wrapper').css('display', 'block');
	}
		    
		</script>