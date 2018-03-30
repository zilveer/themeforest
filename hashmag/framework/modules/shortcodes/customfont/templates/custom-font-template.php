<?php
/**
 * Custom Font shortcode template
 */
?>

<<?php echo esc_attr($custom_font_tag);?> class="mkdf-custom-font-holder" <?php hashmag_mikado_inline_style($custom_font_style); echo esc_attr($custom_font_data);?>>
	<?php echo esc_html($content_custom_font);?>
</<?php echo esc_attr($custom_font_tag);?>>