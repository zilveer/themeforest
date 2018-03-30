<?php
	$content = str_replace( '<ul>', '', $content );
	$content = str_replace( '</ul>', '', $content );
?>

<ul class="short <?php echo $type; ?>"><?php echo do_shortcode($content); ?></ul>