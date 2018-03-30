<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="qodef-blockquote-shortcode" <?php suprema_qodef_inline_style($blockquote_style); ?> >
	<<?php echo esc_attr($blockquote_title_tag); ?> class="qodef-blockquote-text">
	<span><?php echo esc_attr($text); ?></span>
	</<?php echo esc_attr($blockquote_title_tag);?>>
</blockquote>