<?php
/**
 * Dropcaps shortcode template
 */
?>

<span class="mkd-dropcaps <?php echo esc_attr($dropcaps_class);?>" <?php libero_mikado_inline_style($dropcaps_style);?>>
	<?php echo esc_html($letter);?>
</span>