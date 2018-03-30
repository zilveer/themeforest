<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/supersized.css" type="text/css" media="screen" />

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/supersized.3.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/supersized.shutter.js"></script>

<script type="text/javascript">  
    
jQuery(function($){
	$.supersized({
	
		//Functionality
		slideshow               :   1,		//Slideshow on/off
		autoplay				:	1,		//Slideshow starts playing automatically
		start_slide             :   1,		//Start slide (0 is random)
		random					: 	0,		//Randomize slide order (Ignores start slide)
		<?php						
			$pp_homepage_slideshow_timer = get_option('pp_homepage_slideshow_timer');
			
			if(empty($pp_homepage_slideshow_timer))
			{
				$pp_homepage_slideshow_timer = 5000;
			}
			else
			{
				$pp_homepage_slideshow_timer = $pp_homepage_slideshow_timer*1000;
			}
		?>
		slide_interval          :   <?php echo $pp_homepage_slideshow_timer; ?>,	//Length between transitions
		<?php						
			$pp_homepage_slideshow_trans = get_option('pp_homepage_slideshow_trans');
			
			if(empty($pp_homepage_slideshow_trans))
			{
				$pp_homepage_slideshow_trans = 1;
			}
		?>
		transition              :   <?php echo $pp_homepage_slideshow_trans; ?>, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
		transition_speed		:	500,	//Speed of transition
		new_window				:	1,		//Image links open in new window/tab
		pause_hover             :   0,		//Pause slideshow on hover
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
		
		//Components
		navigation              :   1,		//Slideshow controls on/off
		thumbnail_navigation    :   0,		//Thumbnail navigation
		slide_counter           :   0,		//Display slide numbers
		slide_captions          :   1,		//Slide caption (Pull from "title" in slides array)
		progress_bar			:	1,
		slides 					:  	[		//Slideshow Images
    											  
<?php
	$homeslides = '';
    foreach($all_photo_arr as $key => $photo)
    {
        $hyperlink_url = get_permalink($photo->ID);
        
        if(!empty($photo->guid))
        {
        	$image_url[0] = $photo->guid;
        }
        $small_image_url = get_stylesheet_directory_uri().'/timthumb.php?src='.$image_url[0].'&amp;h=80&amp;w=130&amp;zc=1';

?>

	<?php $homeslides .= '{image : \''.$image_url[0].'\', thumb: \''.$small_image_url.'\'},'; ?>
	
<?php
	}
?>

    			<?php $homeslides = substr($homeslides,0,-1);
    			echo $homeslides; ?>						]
    									
    	}); 
    });
    
</script>

<div id="thumb-tray" class="load-item">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
    <a id="prevslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<div id="progress-back" class="load-item">
	<div id="progress-bar"></div>
</div>

<?php
    $pp_enable_slideshow_title = get_option('pp_enable_slideshow_title');
    			
    if(!empty($pp_enable_slideshow_title))
    {
?>
    <!--Slide captions displayed here--> 
    <div id="slidecaption"></div>
<?php
    }
?>

<!--Control Bar-->
<div id="controls-wrapper" class="load-item">
   
    
</div>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_stylesheet_directory_uri(); ?>/images/"/>

<?php
	//Get Music Player
    $pp_homepage_music_m4a = get_option('pp_homepage_music_m4a');
    $pp_homepage_music_ogg = get_option('pp_homepage_music_ogg');
    $pp_homepage_music_mp3 = get_option('pp_homepage_music_mp3');
    			
    if(!empty($pp_homepage_music_m4a) && !empty($pp_homepage_music_mp3) && !empty($pp_homepage_music_ogg))
    {
?>
<!-- Audio Player -->
<div id="jquery_jplayer_1"></div>
<div id="jp_interface_1">
	<a href="#" class="jp-play">Play</a>
    <a href="#" class="jp-pause">Pause</a>
</div>
<?php
	}
?>     	
		
<script>
$j(document).ready(function() {
	<?php
	    if(!empty($pp_homepage_music_m4a) && !empty($pp_homepage_music_mp3) && !empty($pp_homepage_music_ogg))
	    {
	    	$pp_homepage_music_play_script = '';
			 $pp_homepage_music_play = get_option('pp_homepage_music_play');
			 
			 if(!empty($pp_homepage_music_play))
			 {
			 	$pp_homepage_music_play_script = '.jPlayer("play")';
			 }
	?>
    $j("#jquery_jplayer_1").jPlayer({
   	    ready: function () {
   	        $j(this).jPlayer("setMedia", {
   	        	mp3: "<?php echo $pp_homepage_music_mp3; ?>",
   	           	m4a: "<?php echo $pp_homepage_music_m4a; ?>",
   	            oga: "<?php echo $pp_homepage_music_ogg; ?>",
   	            end: ""
   	        })<?php echo $pp_homepage_music_play_script; ?>
   	    },
   	    //solution: "flash, html", // Flash with an HTML5 fallback.
   	   	swfPath: "<?php echo get_stylesheet_directory_uri(); ?>/js/",
   	    supplied: "mp3,m4a,oga"
   	});
   	<?php
   		}
   	?>
});
</script>
<?php
if(isset($wp_galleries[$pp_homepage_slideshow_cat]['title']))
{
?>
<div id="kenburns_title"><?php echo $wp_galleries[$pp_homepage_slideshow_cat]['title']; ?></div>
<?php
}

if(isset($wp_galleries[$pp_homepage_slideshow_cat]['desc']))
{
?>
<div id="kenburns_desc"><?php echo $wp_galleries[$pp_homepage_slideshow_cat]['desc']; ?></div>
<?php
}
?>