<?php
	if( isset($type) && $type != '' ) { $class[] = $type; }
?>

<div class="thb-text message <?php echo implode(' ', $class); ?>">
	<?php echo thb_text_format($content, true); ?>
</div>