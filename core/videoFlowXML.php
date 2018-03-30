<?php
require_once( '../../../wp-load.php' );

$args = array(
    'numberposts' => -1,
    'order' => 'ASC',
    'orderby' => 'date',
    'post_type' => array('portfolios'),
);
$all_photo_arr = get_posts( $args );

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>
		<bank>';
		
foreach($all_photo_arr as $photo)
{
	if(has_post_thumbnail($photo->ID, 'full'))
	{
	    $image_id = get_post_thumbnail_id($photo->ID);
	    $full_image_url = wp_get_attachment_image_src($image_id, 'full', true);
	    $small_image_url = wp_get_attachment_image_src($image_id, 'large', true);
	}

	echo '<img>';
	echo '<src>'.$small_image_url[0].'</src>';
	echo '<link>'.$full_image_url[0].'</link>';
	echo '<title></title>';
	echo '<caption></caption>';
	echo '</img>';
}
		
echo '</bank>';
?>
