<div id="imageFlow">
	<div class="text">
		<div class="title">Loading</div>
		<div class="legend">Please wait...</div>
	</div>
	<div class="scrollbar">
		<?php
			if(isset($_SESSION['pp_skin']))
			{
			    $pp_skin = $_SESSION['pp_skin'];
			}
			else
			{
			    $pp_skin = get_option('pp_skin');
			}
	
			if($pp_skin == 'light')
			{
		?>
			<img class="track" src="<?php echo get_template_directory_uri(); ?>/images/white_slider_bg.png" alt="">
			<img class="bar" src="<?php echo get_template_directory_uri(); ?>/images/white_slider_handle.png" alt="">
		<?php
			}
			else
			{
		?>
			<img class="track" src="<?php echo get_template_directory_uri(); ?>/images/dark_slider_bg.png" alt="">
			<img class="bar" src="<?php echo get_template_directory_uri(); ?>/images/white_slider_handle.png" alt="">
		<?php
			}
		?>
		<img class="arrow-left" src="<?php echo get_template_directory_uri(); ?>/images/sl.gif" alt="">
		<img class="arrow-right" src="<?php echo get_template_directory_uri(); ?>/images/sr.gif" alt="">
	</div>
</div>

<div id="fancy_gallery" style="display:none">
<?php
$args = array(
    'numberposts' => -1,
    'order' => 'ASC',
    'orderby' => 'date',
    'post_type' => array('portfolios'),
);
$all_photo_arr = get_posts( $args );

$pp_display_image_title = get_option('pp_display_image_title');

foreach($all_photo_arr as $key => $photo)
{
	$portfolio_type = get_post_meta($photo->ID, 'portfolio_type', true);
	$portfolio_video_id = get_post_meta($photo->ID, 'portfolio_video_id', true);
	
	switch($portfolio_type)
	{
		case 'Youtube Video':
?>
    	<a id="fancy_gallery<?php echo $key; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox" <?php if(!empty($pp_display_image_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>><img src="<?php echo get_template_directory_uri(); ?>/images/white_slider_handle.png" alt=""/></a>
    								
		<div style="display:none;">
		    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:536px">
		        
		        <iframe title="YouTube video player" width="900" height="536" src="http://www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe>
		        
		    </div>	
		</div>
    							
<?php
    	break;
    	case 'Vimeo Video':
?>
		<a id="fancy_gallery<?php echo $key; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox" <?php if(!empty($pp_display_image_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>><img src="<?php echo get_template_directory_uri(); ?>/images/white_slider_handle.png" alt=""/></a>
																
		<div style="display:none;">
		    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:506px">
		        
		        <iframe src="http://player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		        
		    </div>	
		</div>
															
<?php
    	break;
	}
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
imf.create("imageFlow", '<?php echo get_template_directory_uri(); ?>/videoFlowXML.php', 0.6, 0.4, 0, 10, 8, 4);

jQuery(document).ready(function(){ 
	jQuery('#footer').css('position', 'fixed');
	jQuery('#footer').css('bottom', '20px');
	jQuery('#footer').css('width', '100%');
	jQuery('#footer').css('textAlign', 'center');
});
</script>
<?php
}

get_footer();
?>