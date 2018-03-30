<?php
if(file_exists('../../../wp-load.php'))
{
	require_once( '../../../wp-load.php' );
}
else
{
	require_once( '../../../../wp-load.php' );
}


if(!isset($_GET['gallery_id']) OR empty($_GET['gallery_id']))
{
	$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');
	$all_photo_arr = get_post_meta($pp_homepage_slideshow_cat, 'wpsimplegallery_gallery', true);
}
else
{
	$all_photo_arr = get_post_meta($_GET['gallery_id'], 'wpsimplegallery_gallery', true);
}

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>
		<bank>';
		
$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
		
foreach($all_photo_arr as $photo_id)
{
	$full_image_url = wp_get_attachment_image_src( $photo_id, 'full' );
	$small_image_url = wp_get_attachment_image_src( $photo_id, 'large' );
	
	//Get image meta data
	$image_title = get_post_field('post_title', $photo_id);
	$image_caption = get_post_field('post_excerpt', $photo_id);
	$image_desc = get_post_field('post_content', $photo_id);

	echo '<img>';
	echo '<src>'.$small_image_url[0].'</src>';
	echo '<link>'.$full_image_url[0].'</link>';
	
	if(!empty($pp_portfolio_enable_slideshow_title))
	{
		echo '<title>'.$image_title.'</title>';
	}
	else
	{
		echo '<title></title>';
	}
	
	echo '<caption>'.$image_desc.'</caption>';
	echo '</img>';
}
		
echo '</bank>';
?>
