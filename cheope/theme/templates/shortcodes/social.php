<?php	
	    
    if( $size != 'small' )
        $size = '';
    
    if( $size != '' ) $size = '-' . $size;
    
    if( is_null($title) || $title == '' ) $title = ucfirst($type);
	
	$target = (isset($target) && $target != '') ? 'target="' . $target . '"' : '';
    
?>
<div class="fade-socials<?php echo $size . ' ' . $type . $size; ?>">
<a href="<?php echo $href; ?>" class="fade-socials<?php echo $size . ' ' . $type . $size; ?>" title="<?php echo $title; ?>" <?php echo $target; ?> style="display: none;" ></a>
</div>