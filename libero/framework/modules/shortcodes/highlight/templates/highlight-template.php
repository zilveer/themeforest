<?php
/**
 * Highlight shortcode template
 */
?>

<span class="mkd-highlight" <?php libero_mikado_inline_style($highlight_style);?>>
	<?php echo do_shortcode($content);?>
</span>