<script type="text/javascript">  

<?php
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
    
</script>

<div id="kenburns_overlay"></div>
<canvas id="kenburns">
    <p>Your browser doesn't support canvas!</p>
</canvas>
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