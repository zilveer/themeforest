<?php
if(file_exists('../../../wp-load.php'))
{
	require_once( '../../../wp-load.php' );
}
else
{
	require_once( '../../../../wp-load.php' );
}


$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');
$homepage_items = -1;

$args = array( 
    'post_type' => 'gallery', 
    'numberposts' => $homepage_items, 
    'post_status' => null, 
    'order' => 'ASC',
    'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>
		<bank>';
		
$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');

foreach($all_photo_arr as $photo)
{
	$image_id = get_post_thumbnail_id($photo->ID);
	$image_thumb = wp_get_attachment_image_src($image_id, 'full', true);

	echo '<img>';
	echo '<src>'.$image_thumb[0].'</src>';
	echo '<link>'.$image_thumb[0].'</link>';
	
	if(!empty($pp_portfolio_enable_slideshow_title))
	{
		echo '<title>'.$photo->post_title.'</title>';
	}
	else
	{
		echo '<title></title>';
	}
	
	echo '<caption>'.$photo->post_content.'</caption>';
	echo '</img>';
}
		
echo '</bank>';
?>
