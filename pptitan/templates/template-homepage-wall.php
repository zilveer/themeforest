<div id="photo_wall_wrapper" class="fade-in two">
<?php
    //Check if enable image title
	$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
	
	//Get homepage gallery images
	$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');
	
	//Get gallery images
	$args = array( 
	    'post_type' => 'attachment', 
	    'numberposts' => -1, 
	    'post_status' => null, 
	    'post_parent' => $pp_homepage_slideshow_cat,
	    'order' => 'ASC',
		'orderby' => 'menu_order',
	); 
	$all_photo_arr = get_posts( $args );
	$count_photo = count($all_photo_arr); 

    foreach($all_photo_arr as $key => $photo)
    {
    	$small_image_url = get_template_directory_uri().'/images/000_70.png';
    	$hyperlink_url = get_permalink($photo->ID);
    	$thumb_image_url = '';
    	
    	if(!empty($photo->guid))
    	{
    		$image_url[0] = $photo->guid;
    	    $small_image_url = wp_get_attachment_image_src($photo->ID, 'gallery_wall', true);
    	}
    	
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
    	<div class="wall_thumbnail">
    		<img src="<?php echo $thumb_image_url; ?>" alt="" class="portfolio_img"/>
    		<a <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>data-title="<?php echo $photo->post_title; ?><?php if(!empty($photo->post_content)) { ?> - <?php echo $photo->post_content; ?><?php } ?>"<?php } ?> class="fancy-gallery" data-fancybox-group="fancybox-thumb" href="<?php echo $image_url[0]; ?>">
    			<div class="mask">
		             <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>
		                 <h6><?php echo $photo->post_title; ?></h6>
		                 <span class="caption"><?php echo $photo->post_excerpt; ?></span>
		             <?php } ?>
		         </div>
    		</a>
    	</div>
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