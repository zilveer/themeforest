<?php
/**

 * The main template file for display portfolio page.
 *
 * Template Name: Gallery Flip
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

//Check if password protected
$portfolio_password = get_post_meta($current_page_id, 'portfolio_password', true);
if(!empty($portfolio_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-password");
		exit;
	}
}

//Get content gallery
$gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

//Get gallery images
$all_photo_arr = get_post_meta($gallery_id, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

get_header();

wp_enqueue_script("script-flip-gallery", get_template_directory_uri()."/templates/script-flip-gallery.php?gallery_id=".$gallery_id, false, THEMEVERSION, true);
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
	    	
	    	//Get image meta data
	    	$image_title = get_post_field('post_title', $photo_id);
	    	$image_caption = get_post_field('post_excerpt', $photo_id);
	    	$image_desc = get_post_field('post_content', $photo_id);
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
$page_audio = get_post_meta($current_page_id, 'page_audio', true);

if(!empty($page_audio))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$page_audio.'"]'); ?>
</div>
<?php
}
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>