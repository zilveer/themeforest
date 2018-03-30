<?php 
header("content-type: application/x-javascript"); 
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );

$pp_gallery_cat = '';
	
if(isset($_GET['gallery_id']))
{
    $pp_gallery_cat = $_GET['gallery_id'];
}

$pp_slideshow_timer = get_option('pp_slideshow_timer'); 
if(empty($pp_slideshow_timer))
{
    $pp_slideshow_timer = 5;
}

$pp_full_slideshow_trans_speed = get_option('pp_full_slideshow_trans_speed');
if(empty($pp_full_slideshow_trans_speed))
{
    $pp_full_slideshow_trans_speed = 400;
}

$all_photo_arr = get_post_meta($pp_gallery_cat, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

$count_photo = count($all_photo_arr);

$homeslides = '';

//if image is not empty
if(!empty($count_photo))
{
?>

jQuery(function($){
    	$.supersized({
    	
    		<?php						
    			$pp_full_slideshow_timer = get_option('pp_full_slideshow_timer');
    			
    			if(empty($pp_full_slideshow_timer))
    			{
    				$pp_full_slideshow_timer = 5;
    			}
    			$pp_full_autoplay = get_option('pp_full_autoplay');
    			
    			if(empty($pp_full_autoplay))
    			{
    				$pp_full_autoplay = 0;
    			}
    		?>
    		//Functionality
    		slideshow               :   1,		//Slideshow on/off
    		autoplay				:	<?php echo $pp_full_autoplay; ?>,		//Slideshow starts playing automatically
    		start_slide             :   1,		//Start slide (0 is random)
    		random					: 	0,		//Randomize slide order (Ignores start slide)
    		slide_interval          :   <?php echo $pp_full_slideshow_timer*1000; ?>,	//Length between transitions
    		<?php						
    			$pp_full_slideshow_trans = get_option('pp_full_slideshow_trans');
    			
    			if(empty($pp_full_slideshow_trans))
    			{
    				$pp_full_slideshow_trans = 1;
    			}
    		?>
    		transition              :   <?php echo $pp_full_slideshow_trans; ?>, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
    		transition_speed		:	<?php echo $pp_full_slideshow_trans_speed; ?>,	//Speed of transition
    		new_window				:	1,		//Image links open in new window/tab
    		pause_hover             :   1,		//Pause slideshow on hover
    		keyboard_nav            :   1,		//Keyboard navigation on/off
    		performance				:	1,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
    		image_protect			:	0,		//Disables image dragging and right click with Javascript

    		//Size & Position
    		min_width		        :   0,		//Min width allowed (in pixels)
    		min_height		        :   0,		//Min height allowed (in pixels)
    		vertical_center         :   1,		//Vertically center background
    		horizontal_center       :   1,		//Horizontally center background
    		<?php						
    			$pp_enable_fit_image = get_option('pp_enable_fit_image');
    			
    			if(empty($pp_enable_fit_image))
    			{
    				$pp_enable_fit_image = 1;
    			}
    			else
    			{
    				$pp_enable_fit_image = 0;
    			}
    		?>
    		fit_portrait         	:   <?php echo $pp_enable_fit_image; ?>,		//Portrait images will not exceed browser height
    		fit_landscape			:   <?php echo $pp_enable_fit_image; ?>,		//Landscape images will not exceed browser width
    		fit_always				: 	<?php echo $pp_enable_fit_image; ?>,
    		
    		//Components
    		navigation              :   0,		//Slideshow controls on/off
    		thumbnail_navigation    :  	0,		//Thumbnail navigation
    		slide_counter           :   0,		//Display slide numbers
    		slide_captions          :   0,		//Slide caption (Pull from "title" in slides array)
    		progress_bar			:	0,
    		slides 					:  	[		//Slideshow Images
<?php
	
    foreach($all_photo_arr as $photo_id)
	{
        $image_url = wp_get_attachment_image_src($photo_id, 'original', true);
        $small_image_url = wp_get_attachment_image_src($photo_id, 'thumbnail', true);
        
        //Get image meta data
		$image_title = get_the_title($photo_id);
		$image_desc = get_post_field('post_content', $photo_id);
?>
<?php $homeslides .= '{image : \''.$image_url[0].'\', thumb: \''.$small_image_url[0].'\', title: \'<div id="gallery_caption"><h2>'.pp_substr(addslashes(strip_tags($image_title)),30).'</h2><div class="gallery_desc">'.pp_substr(addslashes(trim(preg_replace('/\s+/', ' ', $image_desc))),80).'</div></div>\'},'; ?>
<?php
	}
?>

    	<?php $homeslides = substr($homeslides,0,-1);
    	echo $homeslides; ?>						]
    									
    	}); 
    });
<?php
}
?>