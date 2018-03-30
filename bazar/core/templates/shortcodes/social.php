<?php	
	    
    if( $size != 'small' )
        $size = '';
    
    if( $size != '' ) $size = '-' . $size;
    
    if( is_null($title) || $title == '' ) $title = ucfirst($type);
    
    // other attrs
    $extra_atts = array();
    foreach ( $other_atts as $att => $v ) $extra_atts[] = "$att=\"$v\"";
    
?>

<a href="<?php echo $href; ?>" class="socials<?php echo $size . ' ' . $type . $size; ?>" title="<?php echo $title; ?>"<?php echo implode(' ', $extra_atts) ?>><?php echo $type; ?></a>