<?php
	$type  = ( empty( $type ) ) ? '' : '' . str_replace('icon-', '', $type);
    $width = ( $size != '' ) ? ';width:' . $size.$unit : ';';
    $height = ( $size != '' ) ? ';height:' . $size.$unit : ';';
    $size  = ( $size != '' ) ? ';font-size:' . $size.$unit : ';';
?>

<i class="icon-<?php echo $type; ?>" style="color:<?php echo $color . $size . $width . $height; ?>"></i>