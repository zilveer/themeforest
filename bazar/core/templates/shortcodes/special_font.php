<?php
$style = '';
	if ( ! is_null( $size ) )
		$style = ' style="font-size:' . $size . $unit . ';"';
?>	

<span class="special-font"<?php echo $style; ?>><?php echo do_shortcode( $content ); ?></span>