<?php
/**
 * Custom Font shortcode template
 */
?>

<<?php echo esc_attr($custom_font_tag);?> class="eltd-custom-font-holder" <?php flow_elated_inline_style($custom_font_style);?> <?php echo esc_attr($custom_font_data);?>>
	<?php echo esc_html($content_custom_font);?>
</<?php echo esc_attr($custom_font_tag);?>>