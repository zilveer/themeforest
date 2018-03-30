<?php header("content-type: application/x-javascript"); ?>
<?php
require_once( '../../../../wp-load.php' );
?>
<?php
	$pp_gallery_cat = '';
	
	if(isset($_GET['gallery_id']))
	{
		$pp_gallery_cat = $_GET['gallery_id'];
	}
	
	//Get gallery images
	$all_photo_arr = get_post_meta($pp_gallery_cat, 'wpsimplegallery_gallery', true);
	
	//Get global gallery sorting
	$all_photo_arr = pp_resort_gallery_img($all_photo_arr);
	$count_photo = count($all_photo_arr);

	//Get timer setting				
    $pp_slideshow_timer = get_option('pp_slideshow_timer'); 

	if(empty($pp_slideshow_timer))
	{
	    $pp_slideshow_timer = 5;
	}
    
    if(empty($pp_slideshow_timer))
    {
    	$pp_slideshow_timer = 5000;
    }
    else
    {
    	$pp_slideshow_timer = $pp_slideshow_timer*1000;
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
	$j('#kenburns_overlay').css('width', $j(window).width() + 'px');
	$j('#kenburns_overlay').css('height', $j(window).height() + 'px');
	$j('#kenburns').attr('width', $j(window).width());
	$j('#kenburns').attr('height', $j(window).height());
	$j(window).resize(function() {
		$j('#kenburns').remove();
		$j('#kenburns_overlay').remove();
		
		$j('body').append('<canvas id="kenburns"></canvas>');
		$j('body').append('<div id="kenburns_overlay"></div>');
	
	  	$j('#kenburns_overlay').css('width', $j(window).width() + 'px');
		$j('#kenburns_overlay').css('height', $j(window).height() + 'px');
		$j('#kenburns').attr('width', $j(window).width());
		$j('#kenburns').attr('height', $j(window).height());
		
			$j('#kenburns').kenburns({
			images:[
			<?php
			    foreach($all_photo_arr as $key => $photo_id)
			    {
				    if(!empty($photo_id))
				    {
				        $image_url = wp_get_attachment_image_src($photo_id, 'full', true);
				    }
			
			?>
					'<?php echo $image_url[0]; ?>'
			<?php
					if($count_photo > ($key+1))
					{
						echo ',';
					}
				}
			?>
					],
			frames_per_second: <?php echo $pp_kenburns_frames_rate; ?>,
			display_time: <?php echo $pp_slideshow_timer; ?>,
			fade_time: 1000,
			zoom: 1.2,
			background_color:'#000000'
		});
	});
	$j('#kenburns').kenburns({
		images:[
		<?php
		    foreach($all_photo_arr as $key => $photo_id)
			{
			    if(!empty($photo_id))
			    {
			        $image_url = wp_get_attachment_image_src($photo_id, 'full', true);
			    }
		
		?>
				'<?php echo $image_url[0]; ?>'
		<?php
				if($count_photo > ($key+1))
				{
					echo ',';
				}
			}
		?>
				],
		frames_per_second: <?php echo $pp_kenburns_frames_rate; ?>,
		display_time: <?php echo $pp_slideshow_timer; ?>,
		fade_time: 1000,
		zoom: 1.2,
		background_color:'#000000'
	});				
});