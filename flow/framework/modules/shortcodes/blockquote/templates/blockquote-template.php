<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="eltd-blockquote-shortcode" <?php flow_elated_inline_style($blockquote_style); ?> >
	<span class="eltd-blockquote-block">
	</span>
	<p class="eltd-blockquote-text">
		<span><?php echo esc_attr($text); ?></span>
	</p>
</blockquote>