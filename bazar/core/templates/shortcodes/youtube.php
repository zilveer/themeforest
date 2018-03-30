<?php

$video_id = preg_replace( '/[&|&amp;]feature=([\w\-]*)/', '', $video_id );
$width_style= $width>0 ? "width:{$width}px" : "" ;
$height_style= $height>0 ? "height:{$height}px" : "" ;

$style_container="";
$style_iframe="";
//check if width or height is not empty
if($width_style || $height_style){

    $style_iframe="style='{$width_style};{$height_style};'";   //style for iframe

     // if height is not empty set container with same height of iframe
    if($height_style){
        $style_container="style='".$height_style.";'";
    }
}

?>
<div class="post_video youtube" <?php echo $style_container;?>>
    <iframe wmode="transparent" width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="http://www.youtube.com/embed/<?php echo $video_id; ?>?wmode=transparent" frameborder="0" allowfullscreen <?php echo $style_iframe; ?>></iframe>
</div>