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
$portfolio_items = -1;

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => $portfolio_items, 
	'post_status' => null, 
	'post_parent' => $post->ID,
	'order' => 'ASC',
	'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );

$pp_display_image_title = get_option('pp_display_image_title');

foreach($all_photo_arr as $key => $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo->ID, 'full' );
	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'large' );
?>
<a id="fancy_gallery<?php echo $key; ?>" href="<?php echo $full_image_url[0]; ?>" rel="gallery" <?php if(!empty($pp_display_image_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>><img src="<?php echo get_template_directory_uri(); ?>/images/white_slider_handle.png" alt=""/></a>
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
imf.create("imageFlow", '<?php echo get_template_directory_uri(); ?>/imageFlowXML.php?gallery_id=<?php echo $post->ID; ?>', 0.6, 0.4, 0, 10, 8, 4);

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