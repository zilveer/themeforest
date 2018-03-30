<?php
/* map background header */

//require (get_template_directory () . '/inc/cb-theme/cb-theme-options.php');

$iframe_src='http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q='.$map_a.'&amp;hnear='.$map_a.'&amp;ie=UTF8&amp;hq=&amp;t='.$map_t.'&amp;z='.$map_z.'&amp;output=embed&amp;iwloc=near';
$iframe_src=str_replace(' ','%20',$iframe_src);
?>
<iframe
	class="cb5_media cb5_media_map" height="400"
	src="<?php echo $iframe_src;?>"></iframe>
