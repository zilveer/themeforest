<div id="photo_wall_wrapper">
<?php
    //Check if enable image title
	$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
	
	//Get homepage gallery images
	$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');
	
	//Get gallery images
	$all_photo_arr = get_post_meta($pp_homepage_slideshow_cat, 'wpsimplegallery_gallery', true);
	
	//Get global gallery sorting
	$all_photo_arr = pp_resort_gallery_img($all_photo_arr);
	$count_photo = count($all_photo_arr); 

    foreach($all_photo_arr as $key => $photo_id)
    { 	
    	$small_image_url = '';
	    $hyperlink_url = get_permalink($photo_id);
	    
	    if(!empty($photo_id))
	    {
	        $image_url = wp_get_attachment_image_src($photo_id, 'full', true);
	        $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_wall', true);
	    }
	    
	    //Get image meta data
	    $image_title = get_post_field('post_title', $photo_id);
	    $image_desc = get_post_field('post_content', $photo_id);
    	
    	$last_class = '';
    	$thumb_image_url = $small_image_url[0];
    	$thumb_width = 336;
    	$thumb_height = 336;
?>

<div class="wall_entry">
    <?php 
    	if(!empty($thumb_image_url))
    	{
    ?>		
    		<a <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>title="<?php echo $image_title; ?> - <?php echo $image_desc; ?>"<?php } ?> class="fancy-gallery" data-fancybox-group="fancybox-thumb" href="<?php echo $image_url[0]; ?>">
    			<img src="<?php echo $thumb_image_url; ?>" alt="" class="portfolio_img"/>
    		</a>
    <?php
    	}		
    ?>

</div>

<?php
    }
?>
</div>

<?php
$pp_homepage_music_mp3 = get_option('pp_homepage_music_mp3');

if(!empty($pp_homepage_music_mp3))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="120" height="30" src="'.$pp_homepage_music_mp3.'"]'); ?>
</div>
<?php
}
?>