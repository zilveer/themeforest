<?php
	$class[] = $size;
	$style = '';

	// Color
	if( thb_text_startsWith($color, '#') ) {
		$style .= 'background-color: ' . $color;
	}
	else {
		$class[] = $color;
	}
?>

<a class="<?php echo implode(' ', $class); ?>" href="<?php echo $url; ?>" style="<?php echo $style; ?>">
	<?php echo thb_text_format($text); ?>
</a>