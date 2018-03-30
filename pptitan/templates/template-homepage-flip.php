<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

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

?>

<div id="tf_loading" class="tf_loading"></div>
<div id="tf_bg" class="tf_bg">
	<?php
	    foreach($all_photo_arr as $key => $photo)
	    {
	        $small_image_url = get_template_directory_uri().'/images/000_70.png';
	        $hyperlink_url = get_permalink($photo->ID);
	        
	        if(!empty($photo->guid))
	        {
	        	$image_url[0] = $photo->guid;
	        
	        	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'thumbnail');
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
    	$small_image_url = wp_get_attachment_image_src( $all_photo_arr[0]->ID, 'thumbnail');
    	
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