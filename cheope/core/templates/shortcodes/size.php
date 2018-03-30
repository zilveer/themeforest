<?php
	if ( ! is_null( $px ) )
		$size = "{$px}px";
	
	elseif ( ! is_null( $perc ) )
		$size = "{$perc}%";
	
	elseif ( ! is_null( $em ) )
		$size = "{$em}em";
?>		
<span style="font-size: <?php echo $size;?>;"><?php echo do_shortcode( $content ); ?></span>