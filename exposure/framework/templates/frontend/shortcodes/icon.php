<?php
	$class = (array) $class;

	if( !in_array($align, $class) ) {
		$class[] = $align;
	}

?>

<?php if( !empty($url) ) : ?>
	<img src="<?php echo $url; ?>" alt="" class="thb-icon <?php echo implode(' ', $class); ?>">
<?php endif; ?>