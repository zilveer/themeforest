<?php

echo $before_widget;
if ( $title)
	echo $before_title . $title . $after_title;

for($i=1; $i<=$count; $i++):
	$image = isset($instance['ad_image'][$i]) ? $instance['ad_image'][$i] : '';
	$link = isset($instance['ad_link'][$i]) ? $instance['ad_link'][$i] : '';
	if(empty($image))
		$image = WPV_THEME_IMAGES.'ad.png';
?>
	<a href="<?php echo $link ?>" rel="nofollow" target="_blank" title="<?php _e('Advertisment', 'health-center') ?>"><?php wpv_url_to_image( $image )?></a>
<?php
endfor;

echo $after_widget;
