<?php

$width_style= $width>0 ? "width:{$width}px" : "" ;
$height_style= $height>0 ? "height:{$height}px" : "" ;

$style_container="";
$style_iframe="";
//check if width or height is not empty
if($width_style || $height_style){

    $style_iframe="style='{$width_style};{$height_style};'";   //style for iframe

    // if height is not empty set container with same height of iframe
    if($height_style){
        $style_container="style='".$height_style.";padding-bottom:0'";
    }
}

?>

<div class="post_video dailymotion" <?php echo $style_container;?>>
    <iframe frameborder="0" width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="http://www.dailymotion.com/embed/video/<?php echo$video_id; ?>" <?php echo $style_iframe; ?>></iframe>
</div>