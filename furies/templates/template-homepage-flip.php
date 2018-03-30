<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

//Get homepage gallery images
$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');

//Get gallery images
$all_photo_arr = get_post_meta($pp_homepage_slideshow_cat, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);
$count_photo = count($all_photo_arr); 

?>

<div id="tf_loading" class="tf_loading"></div>
<div id="tf_bg" class="tf_bg">
	<?php
	    foreach($all_photo_arr as $key => $photo_id)
	    {
	        $small_image_url = '';
		    $hyperlink_url = get_permalink($photo_id);
		    
		    if(!empty($photo_id))
		    {
		        $image_url = wp_get_attachment_image_src($photo_id, 'full', true);
		        $small_image_url = wp_get_attachment_image_src($photo_id, 'thumbnail', true);
		    }
	?>
    	<img src="<?php echo $image_url[0]; ?>" alt="" longdesc="<?php echo $small_image_url[0]; ?>" />
    <?php
        }
       ?>
</div>
<div id="tf_thumbs" class="tf_thumbs">
    <span id="tf_zoom" class="tf_zoom"></span>
    <?php
    if(isset($all_photo_arr[0]))
    {
    	$small_image_url = wp_get_attachment_image_src( $all_photo_arr[0], 'thumbnail');
    	
    	if(isset($small_image_url[0]))
    	{
    ?>
    <img src="<?php echo $small_image_url[0]; ?>" alt=""/>
    <?php
    	}
    }
    ?>
</div>

<div id="tf_next" class="tf_next"></div>
<div id="tf_prev" class="tf_prev"></div>

<?php
$pp_homepage_music_mp3 = get_option('pp_homepage_music_mp3');

if(!empty($pp_homepage_music_mp3))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$pp_homepage_music_mp3.'"]'); ?>
</div>
<?php
}
?>