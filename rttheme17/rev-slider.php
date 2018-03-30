<?php
/* 
* rt-theme slider
*/
global $group_id,$sidebar,$this_item_layout,$rttheme_slider_width,$boxNumber,$logo_container,$header_background_image,$header_text,$rev_slider_shortcode ;

#
#	uniqueness
#
$slider_unique_name 	= "unique_".$group_id."_slider"; 
 

#
#	slider css
#
 
$css 		= ($boxNumber != 1  ||  (is_front_page() && (trim($header_text) || $header_background_image))) ? 'style="top:0px !important;margin:0 auto !important;"' : ""; 
?>

<!-- slider area -->	
<div class="slider_area box-shadow  <?php if(!$logo_container) echo "no-logo-container";?>" <?php echo $css;?>>


<?php 
echo do_shortcode($rev_slider_shortcode);
?>

</div><!-- / end div #slider_area -->   