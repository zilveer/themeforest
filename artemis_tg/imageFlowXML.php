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
	$homepage_items = -1;

	$args = array( 
	    'post_type' => 'attachment', 
	    'numberposts' => $homepage_items, 
	    'post_status' => null, 
	    'post_parent' => $pp_homepage_slideshow_cat,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	); 
	$all_photo_arr = get_posts( $args );
}
else
{
	$portfolio_items = -1;

	$args = array( 
	    'post_type' => 'attachment', 
	    'numberposts' => $portfolio_items, 
	    'post_status' => null, 
	    'post_parent' => $_GET['gallery_id'],
	     'order' => 'ASC',
	    'orderby' => 'menu_order',
	); 
	$all_photo_arr = get_posts( $args );
}

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>
		<bank>';
		
foreach($all_photo_arr as $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo->ID, 'full' );
	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'large' );

	echo '<img>';
	echo '<src>'.$small_image_url[0].'</src>';
	echo '<link>'.$full_image_url[0].'</link>';
	echo '<title></title>';
	echo '<caption></caption>';
	echo '</img>';
}
		
echo '</bank>';
?>
