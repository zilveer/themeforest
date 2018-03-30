<?php
	$color = isset($color) && $color != '' ? 'style="background-color: '.$color.'; color: #fff;"' : '';

	if( isset($color) && $color != '' ) { $class[] = 'color'; }
	if( isset($size) && $size != '' ) { $class[] = $size; }
?>

<span class="thb-dropcap <?php echo implode(' ', $class); ?>" <?php echo $color; ?>>
	<?php echo wptexturize($content); ?>
</span>