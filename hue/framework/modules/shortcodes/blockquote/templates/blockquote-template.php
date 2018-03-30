<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="mkd-blockquote-shortcode" <?php hue_mikado_inline_style($blockquote_style); ?> >
	<h6 class="mkd-blockquote-text <?php echo esc_attr($dash_gradient_style); ?>">
		<span><?php echo esc_attr($text); ?></span>
	</h6>
</blockquote>