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

$all_photo_arr = get_post_meta($pp_gallery_cat, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);
$count_photo = count($all_photo_arr);

//Get timer setting				
$pp_kenburns_timer = get_option('pp_kenburns_timer');

if(empty($pp_kenburns_timer))
{
	$pp_kenburns_timer = 5000;
}
else
{
	$pp_kenburns_timer = $pp_kenburns_timer*1000;
}

//Get zoom level
$pp_kenburns_zoom = get_option('pp_kenburns_zoom');
if(empty($pp_kenburns_zoom))
{
	$pp_kenburns_zoom = 1.1;
}
else
{
	$pp_kenburns_zoom = 1+($pp_kenburns_zoom/10);
}

//Get transition speed
$pp_kenburns_trans = get_option('pp_kenburns_trans');
if(empty($pp_kenburns_trans))
{
	$pp_kenburns_trans = 1000;
}

//Check if iPad or iPhone
$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
$isiPhone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
$isFirefox = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Mozilla');

if($isiPad || $isiPhone || $isFirefox) 
{
	$pp_kenburns_frames_rate = 10;
}
else
{
	$pp_kenburns_frames_rate = 30;
}
?>
							  
$j(document).ready(function(){ 
	var $canvas = $j('#kenburns');

    $canvas.attr('width', $j(window).width());
    $canvas.attr('height', $j(window).height());

    var kb = $canvas.kenburned({
        images : [
        <?php
	    	$key = 0;
	        foreach($all_photo_arr as $photo_id)
	        {
	            $image_url = wp_get_attachment_image_src($photo_id, 'original', true);
	    
	    ?>
	    		'<?php echo $image_url[0]; ?>'
	    <?php
	    		if($count_photo > ($key+1))
	    		{
	    			echo ',';
	    		}
	    		$key++;
	    	}
	    ?>
        ],
        frames_per_second: <?php echo $pp_kenburns_frames_rate; ?>,
	    display_time: <?php echo $pp_kenburns_timer; ?>,
	    zoom: <?php echo $pp_kenburns_zoom; ?>,
	    fade_time: <?php echo $pp_kenburns_trans; ?>,
    });
    
    $j(window).resize(function() {
		$j('#kenburns').remove();
		$j('#kenburns_overlay').remove();
		
		$j('body').append('<canvas id="kenburns"></canvas>');
		$j('body').append('<div id="kenburns_overlay"></div>');
	
	  	var $canvas = $j('#kenburns');

	    $canvas.attr('width', $j(window).width());
	    $canvas.attr('height', $j(window).height());
	
	    var kb = $canvas.kenburned({
	        images : [
	        <?php
		    	$key = 0;
		        foreach($all_photo_arr as $photo_id)
		        {
		            $image_url = wp_get_attachment_image_src($photo_id, 'original', true);
		    
		    ?>
		    		'<?php echo $image_url[0]; ?>'
		    <?php
		    		if($count_photo > ($key+1))
		    		{
		    			echo ',';
		    		}
		    		$key++;
		    	}
		    ?>
	        ],
	        frames_per_second: <?php echo $pp_kenburns_frames_rate; ?>,
		    display_time: <?php echo $pp_kenburns_timer; ?>,
		    zoom: <?php echo $pp_kenburns_zoom; ?>,
		    fade_time: <?php echo $pp_kenburns_trans; ?>,
	    });
	});
    
    $j('#kb-prevslide ').click(function(ev) {
        ev.preventDefault();
        kb.prevSlide();
    });

    $j('#kb-nextslide').click(function(ev) {
        ev.preventDefault();
        kb.nextSlide();
    });
		
});