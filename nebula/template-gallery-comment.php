<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if gallery template
global $page_gallery_id;
if(!empty($page_gallery_id))
{
	$current_page_id = $page_gallery_id;
}

//Check if password protected
$gallery_password = get_post_meta($current_page_id, 'gallery_password', true);
if(!empty($gallery_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-password");
		exit;
	}
}

//Get gallery images
$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

get_header();
?>
<br class="clear"/>

<div id="page_caption">
	<?php
		$gallery_post_title = get_post_field('post_title', $current_page_id);
	?>
	<h1><?php echo $gallery_post_title; ?></h1>
	<?php
		$gallery_tagline = get_post_meta($current_page_id, 'gallery_tagline', true);
		
		if(!empty($gallery_tagline))
		{
	?>
		<div class="page_caption_desc"><?php echo $gallery_tagline; ?></div>
	<?php
		}
	?>
</div>

<!-- Begin content -->
<div id="photo_wall_wrapper">
<?php
    $key = 0;
    foreach($all_photo_arr as $photo_id)
	{
	    $small_image_url = '';
	    $hyperlink_url = get_permalink($photo_id);
	    
	    if(!empty($photo_id))
	    {
	    	$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
	        $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_m_fh', true);
	    }
	    
	    $last_class = '';
	    if(($key+1)%4==0)
	    {
	    	$last_class = 'last';
	    }
	    
	    $current_image_arr = wp_get_attachment_image_src($photo_id, 'gallery_m_fh');
	    
	    //Get image meta data
	    $image_title = get_the_title($photo_id);
	    $image_desc = get_post_field('post_content', $photo_id);
?>

<div class="wall_entry">
    <?php 
    	if(!empty($small_image_url[0]))
    	{
    		$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
    ?>		
    	<div class="wall_thumbnail dynamic_height gallery_type animated<?php echo $key+1; ?>">
    		<a href="<?php echo $hyperlink_url; ?>">
    			<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
    		</a>
    	</div>
    <?php
    	}		
    ?>

</div>

<?php
		$key++;
    }
?>
</div>

<?php
    //Get Social Share
    get_template_part("/templates/template-share");
?>

<?php
$gallery_audio = get_post_meta($current_page_id, 'gallery_audio', true);

if(!empty($gallery_audio))
{
?>
<div class="gallery_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$gallery_audio.'"]'); ?>
</div>
<?php
}
?>
<br class="clear"/><br/>
<?php
	get_footer();
?>