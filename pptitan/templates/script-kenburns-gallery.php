<?php header("content-type: application/x-javascript"); ?> 

<?php
define('WP_DEBUG', false);
@ini_set('log_errors','On'); 
@ini_set('display_errors','Off'); 
require_once( '../../../../wp-load.php' );
?>

<?php
	//Get global gallery sorting
	$pp_orderby = 'menu_order';
	$pp_order = 'ASC';
	$pp_gallery_sort = get_option('pp_gallery_sort');
	
	if(!empty($pp_gallery_sort))
	{
		switch($pp_gallery_sort)
		{
			case 'post_date':
				$pp_orderby = 'post_date';
				$pp_order = 'DESC';
			break;
			
			case 'post_date_old':
				$pp_orderby = 'post_date';
				$pp_order = 'ASC';
			break;
			
			case 'rand':
				$pp_orderby = 'rand';
				$pp_order = 'ASC';
			break;
			
			case 'title':
				$pp_orderby = 'title';
				$pp_order = 'ASC';
			break;
		}
	}

	$pp_gallery_cat = '';
	
	if(isset($_GET['gallery_id']))
	{
		$pp_gallery_cat = $_GET['gallery_id'];
	}
	$args = array( 
	    'post_type' => 'attachment', 
	    'numberposts' => -1, 
	    'post_status' => null, 
	    'post_parent' => $pp_gallery_cat,
	    'order' => $pp_order,
		'orderby' => $pp_orderby,
	); 
	$all_photo_arr = get_posts( $args );
	$count_photo = count($all_photo_arr);

	//Get timer setting				
    $pp_homepage_slideshow_timer = get_option('pp_homepage_slideshow_timer');
    
    if(empty($pp_homepage_slideshow_timer))
    {
    	$pp_homepage_slideshow_timer = 5000;
    }
    else
    {
    	$pp_homepage_slideshow_timer = $pp_homepage_slideshow_timer*1000;
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
			    foreach($all_photo_arr as $key => $photo)
			    {
			        if(!empty($photo->guid))
			        {
			        	$image_url[0] = $photo->guid;
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
			display_time: <?php echo $pp_homepage_slideshow_timer; ?>,
			fade_time: 1000,
			zoom: 1.2,
			background_color:'#000000'
		});
	});
	$j('#kenburns').kenburns({
		images:[
		<?php
		    foreach($all_photo_arr as $key => $photo)
		    {
		        if(!empty($photo->guid))
		        {
		        	$image_url[0] = $photo->guid;
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
		display_time: <?php echo $pp_homepage_slideshow_timer; ?>,
		fade_time: 1000,
		zoom: 1.2,
		background_color:'#000000'
	});				
});