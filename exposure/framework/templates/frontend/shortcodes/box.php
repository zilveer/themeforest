<?php
	$class = (array) $class;

	if( !in_array($align, $class) ) {
		$class[] = $align;
	}

	if( !empty($icon) ) {
		$class[] = 'w-icon';
	}

?>

<section class="thb-shortcode thb-box <?php echo implode(' ', $class); ?>">
	<?php
		echo thb_do_shortcode('[thb_icon url="'.$icon.'" align="'.$align.'"]');
	?>

	<?php if( !empty($title) ) : ?>
		<h1 class="thb-shortcode-title"><?php echo wptexturize($title); ?></h1>
	<?php endif; ?>

	<div class="thb-text">
		<?php echo thb_text_format($content, true); ?>
	</div>
</section>