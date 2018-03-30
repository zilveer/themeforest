<?php require_once( '../../../wp-load.php' );
$segments = get_option('pp_segments');
$tweentime = get_option('pp_tween_time');
$tweendelay = get_option('pp_tween_delay');
$tweentype = get_option('pp_tween_type');
$zdistance = get_option('pp_z_distance');
$pp_slider_timer = get_option('pp_slider_timer');
?>
<?php header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>
<Piecemaker>
  <Settings>
	<imageWidth>960</imageWidth>
	<imageHeight>340</imageHeight>';
	
echo '<segments>'. $segments . '</segments>';
echo '<tweenTime>'. $tweentime . '</tweenTime>';
echo '<tweenDelay>'. $tweendelay/1000 . '</tweenDelay>';
echo '<tweenType>'. $tweentype . '</tweenType>';
echo '<zDistance>'. $zdistance . '</zDistance>';
echo '<expand>9</expand>';
echo '<innerColor>0x000000</innerColor>';
echo '<textBackground>0x000000</textBackground>';
echo '<textDistance>25</textDistance>';
echo '<shadowDarknent></shadowDarknent>';
echo '<autoplay>' . $pp_slider_timer .  '</autoplay>'; 
echo '</Settings>'; ?>

<?php
$pp_slider_sort = get_option('pp_slider_sort'); 
if(empty($pp_slider_sort))
{
    $pp_slider_sort = 'ASC';
}

$slider_arr = get_posts('numberposts='.$pp_slider_items.'&order='.$pp_slider_sort.'&orderby=date&post_type=slides');

if(!empty($slider_arr))
{
	foreach($slider_arr as $key => $gallery_item)
	{
	    $image_url = '';
	
	    if(has_post_thumbnail($gallery_item->ID, 'large'))
	    {
	    	$image_id = get_post_thumbnail_id($gallery_item->ID);
	    	$image_url = wp_get_attachment_image_src($image_id, 'full', true);
	    }
	    				
	    $hyperlink_url = get_post_meta($gallery_item->ID, 'gallery_link_url', true);
?>
	
<Image Filename="<?php echo $image_url[0]; ?>?src=<?php echo $image_url[0]; ?>&amp;h=340&amp;w=960&amp;zc=1"></Image>
<?php 
	}
}
?>
<?php wp_reset_query(); ?>
<?php echo '</Piecemaker>'; ?>