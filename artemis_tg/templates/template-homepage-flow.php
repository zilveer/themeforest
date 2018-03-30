<?php
if(!empty($all_photo_arr))
{
?>
<div id="imageFlow">
	<div class="text">
		<div class="title">Loading</div>
		<div class="legend">Please wait...</div>
	</div>
</div>
<?php
}
else
{
?>
<div id="imageFlow">
	<div class="text">
		<div class="title">Homepage gallery is empty. You can setup homepage gallery using Theme Setting > Homepage</div>
	</div>
</div>
<?php
}
?>

<div id="fancy_gallery" style="display:none">
<?php
$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');

foreach($all_photo_arr as $key => $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo->ID, 'full' );
	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'large' );
?>
<a id="fancy_gallery<?php echo $key; ?>" href="<?php echo $full_image_url[0]; ?>" class="fancy-gallery" <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>></a>
<?php
}
?>
</div>

<?php
if(!empty($all_photo_arr))
{
?>
<script>
/* ==== create imageFlow ==== */
//          div ID, imagesbank, horizon, size, zoom, border, autoscroll_start, autoscroll_interval
imf.create("imageFlow", '<?php echo get_stylesheet_directory_uri(); ?>/imageFlowXML.php', 0.6, 0.4, 0, 0, 8, 4);
</script>
<?php
}
?>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_stylesheet_directory_uri(); ?>/images/"/>
<?php
	$pp_enable_reflection = get_option('pp_enable_reflection');
?>
<input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo $pp_enable_reflection; ?>"/>

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