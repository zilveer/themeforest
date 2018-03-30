<?php
	if ( $width )
	   $width = ' width="'.$width.'"';
	
	if ( $height )
	   $height = ' height="'.$height.'"';
	
	$src = esc_url( $src );
?>

<img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>"<?php echo $width.$height; ?> />