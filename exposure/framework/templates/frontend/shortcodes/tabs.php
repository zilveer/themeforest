<?php
	$tabs = array();
	preg_match_all('/thb_tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
	if( isset($matches[1]) && !empty($matches[1]) ) {
		$tabs = $matches[1];
	}
	else {
		return;
	}

	if( !in_array('vertical', $class) ) {
		$class[] = 'horizontal';
	}

	if( isset($type) && $type != '' ) {
		$class[] = $type;
	}

?>

<div class="thb-shortcode thb-tabs <?php echo implode(' ', $class); ?>" data-open="<?php echo isset($open) ? (int) $open - 1 : 0; ?>">
	<ul class="thb-tabs-nav">
		<?php $i=0; foreach( $tabs as $tab ) : ?>
			<li>
				<a href="#<?php echo thb_text_slugify($tab[0]); ?>-<?php echo $i; ?>"><?php echo $tab[0]; ?></a>
			</li>
		<?php $i++; endforeach; ?>
	</ul>

	<div class="thb-tabs-contents">
		<?php echo thb_do_shortcode($content); ?>
	</div>
</div>